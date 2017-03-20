<?php
/**
 * Created by PhpStorm.
 * User: rgrisot
 * Date: 21/02/17
 * Time: 15:14
 */

namespace AppBundle\Payment;
use AppBundle\Entity\Parameters;
use Doctrine\ORM\EntityManager;
use PayPal\CoreComponentTypes\BasicAmountType;
use PayPal\EBLBaseComponents\AddressType;
use PayPal\EBLBaseComponents\BillingAgreementDetailsType;
use PayPal\EBLBaseComponents\PaymentDetailsItemType;
use PayPal\EBLBaseComponents\PaymentDetailsType;
use PayPal\EBLBaseComponents\SetExpressCheckoutRequestDetailsType;
use ProductBundle\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;
use ProductBundle\Entity\Purchase;
use Symfony\Component\Routing\Router;

class Payment
{
    private $em;
    private $cancelUrl;
    private $returnUrl;
    private $currencyCode;
    private $itemTotal;
    private $taxTotal;

    public function __construct(Router $router, $env, EntityManager $em)
    {
        $this->em = $em;
        if($env === "dev"){
            $url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'];
        }else{
            $url = 'https://'.$_SERVER['SERVER_NAME'];
        }
        $this->returnUrl = $url.$router->generate('paypal_return');
        $this->cancelUrl = $url.$router->generate('paypal_cancel');
        $this->currencyCode = 'EUR';
    }

    /**
     * @param Purchase $commande
     * @throws \Exception
     */
    public function pay(Purchase $commande){
        $rep = $this->em->getRepository('AppBundle:Parameters');
        $tva = current($rep->findBy(array('name' => 'TVA')));

        // total shipping amount
        $shippingTotal = new BasicAmountType($this->currencyCode, 0);

        //total handling amount if any
        $handlingTotal = new BasicAmountType($this->currencyCode, 0);

        //total insurance amount if any
        $insuranceTotal = new BasicAmountType($this->currencyCode, 0);

        $address = $this->initAdresse($commande);

        $paymentDetails = $this->initPaymentDetails($commande, $tva);

        $this->formatPrices();

        /*
         * The total cost of the transaction to the buyer. If shipping cost and tax charges are known, include them in this value. If not, this value should be the current subtotal of the order. If the transaction includes one or more one-time purchases, this field must be equal to the sum of the purchases. If the transaction does not include a one-time purchase such as when you set up a billing agreement for a recurring payment, set this field to 0.
         */
        $orderTotalValue = $shippingTotal->value + $handlingTotal->value +
            $insuranceTotal->value +
            $this->itemTotal + $this->taxTotal;

        $paymentDetails->ShipToAddress = $address;
        $paymentDetails->ItemTotal = new BasicAmountType($this->currencyCode, $this->itemTotal);
        $paymentDetails->TaxTotal = new BasicAmountType($this->currencyCode, $this->taxTotal);
        $paymentDetails->OrderTotal = new BasicAmountType($this->currencyCode, $orderTotalValue);
        $paymentDetails->InvoiceID = $commande->getId();


        /*
         * How you want to obtain payment. When implementing parallel payments, this field is required and must be set to Order. When implementing digital goods, this field is required and must be set to Sale. If the transaction does not include a one-time purchase, this field is ignored. It is one of the following values:

            Sale � This is a final sale for which you are requesting payment (default).

            Authorization � This payment is a basic authorization subject to settlement with PayPal Authorization and Capture.

            Order � This payment is an order authorization subject to settlement with PayPal Authorization and Capture.

         */
        $paymentDetails->PaymentAction = 'Sale';

        $paymentDetails->HandlingTotal = $handlingTotal;
        $paymentDetails->InsuranceTotal = $insuranceTotal;
        $paymentDetails->ShippingTotal = $shippingTotal;
        $setECReqDetails = $this->initECReqDetails($paymentDetails);
    }

    /**
     * @param Purchase $commande
     * @return AddressType
     */
    private function initAdresse(Purchase $commande):AddressType{
        // shipping address
        $address = new AddressType();
        $address->CityName = $commande->getCity();
        $address->Name = $commande->getUser()->getFirstname().' '.$commande->getUser()->getLastname();
        $address->Street1 = $commande->getAddress();
        $address->StateOrProvince = '';
        $address->PostalCode = $commande->getPostalCode();
        $address->Country = $commande->getCountry();
        $address->Phone = '';
        return $address;
    }

    /**
     * @param Purchase $commande
     * @param float $tva
     * @return PaymentDetailsType
     */
    private function initPaymentDetails(Purchase $commande, float $tva):PaymentDetailsType{
        $paymentDetails = new PaymentDetailsType();
        $this->itemTotal = 0;
        $this->taxTotal = 0;
        /*
         * iterate through each item and add to item details
         */
        foreach ($commande->getProducts() as $key=>$productPurchase){
            $productPrice = $productPurchase->getProduct()->getPrice();
            $productStock = $productPurchase->getStock();
            $itemAmount = new BasicAmountType($this->currencyCode, number_format($productPrice, 2, '.', ''));

            $this->itemTotal += $productPrice * $productStock;
            $this->taxTotal += round($tva/100 * $productPrice * $productStock, 2);
            $itemDetails = new PaymentDetailsItemType();
            $itemDetails->Name = $productPurchase->getProduct()->getName();
            $itemDetails->Amount = $itemAmount;
            $itemDetails->Quantity = $productStock;
            /*
             * Indicates whether an item is digital or physical. For digital goods, this field is required and must be set to Digital. It is one of the following values:

            Digital

            Physical

             */
            $itemDetails->ItemCategory = 'Physical';
            $itemDetails->Tax = new BasicAmountType($this->currencyCode, round($tva/100 * $productPrice, 2));

            $paymentDetails->PaymentDetailsItem[$key] = $itemDetails;
        }
        return $paymentDetails;
    }

    private function formatPrices(){
        $this->itemTotal = number_format(round($this->itemTotal, 2), 2, '.', '');
        $this->taxTotal = number_format(round($this->taxTotal, 2), 2, '.', '');
    }

    private function initECReqDetails(PaymentDetailsType $paymentDetails):SetExpressCheckoutRequestDetailsType{
        $setECReqDetails = new SetExpressCheckoutRequestDetailsType();
        $setECReqDetails->PaymentDetails[0] = $paymentDetails;
        /*
         * (Required) URL to which the buyer is returned if the buyer does not approve the use of PayPal to pay you. For digital goods, you must add JavaScript to this page to close the in-context experience.
         */
        $setECReqDetails->CancelURL = $this->cancelUrl;
        /*
         * (Required) URL to which the buyer's browser is returned after choosing to pay with PayPal. For digital goods, you must add JavaScript to this page to close the in-context experience.
         */
        $setECReqDetails->ReturnURL = $this->returnUrl;

        /*
         * Determines where or not PayPal displays shipping address fields on the PayPal pages. For digital goods, this field is required, and you must set it to 1. It is one of the following values:

            0 � PayPal displays the shipping address on the PayPal pages.

            1 � PayPal does not display shipping address fields whatsoever.

            2 � If you do not pass the shipping address, PayPal obtains it from the buyer's account profile.

         */
        $setECReqDetails->NoShipping = 0;
        /*
         *  (Optional) Determines whether or not the PayPal pages should display the shipping address set by you in this SetExpressCheckout request, not the shipping address on file with PayPal for this buyer. Displaying the PayPal street address on file does not allow the buyer to edit that address. It is one of the following values:

            0 � The PayPal pages should not display the shipping address.

            1 � The PayPal pages should display the shipping address.

         */
        $setECReqDetails->AddressOverride = 1;

        /*
         * Indicates whether or not you require the buyer's shipping address on file with PayPal be a confirmed address. For digital goods, this field is required, and you must set it to 0. It is one of the following values:

            0 � You do not require the buyer's shipping address be a confirmed address.

            1 � You require the buyer's shipping address be a confirmed address.

         */
        $setECReqDetails->ReqConfirmShipping = 0;

        // Billing agreement details
        $billingAgreementDetails = new BillingAgreementDetailsType('None');
        $billingAgreementDetails->BillingAgreementDescription = '';
        $setECReqDetails->BillingAgreementDetails = array($billingAgreementDetails);

        // Display options
        $setECReqDetails->cppheaderimage = '';
        $setECReqDetails->cppheaderbordercolor = '';
        $setECReqDetails->cppheaderbackcolor = '';
        $setECReqDetails->cpppayflowcolor = '';
        $setECReqDetails->cppcartbordercolor = '';
        $setECReqDetails->cpplogoimage = '';
        $setECReqDetails->PageStyle = '';
        $setECReqDetails->BrandName = 'Box Office Wines';

        // Advanced options
        $setECReqDetails->AllowNote = '0';
        return $setECReqDetails;
    }
}