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
use PayPal\EBLBaseComponents\DoExpressCheckoutPaymentRequestDetailsType;
use PayPal\EBLBaseComponents\PaymentDetailsItemType;
use PayPal\EBLBaseComponents\PaymentDetailsType;
use PayPal\EBLBaseComponents\SetExpressCheckoutRequestDetailsType;
use PayPal\PayPalAPI\DoExpressCheckoutPaymentReq;
use PayPal\PayPalAPI\DoExpressCheckoutPaymentRequestType;
use PayPal\PayPalAPI\GetExpressCheckoutDetailsReq;
use PayPal\PayPalAPI\GetExpressCheckoutDetailsRequestType;
use PayPal\PayPalAPI\GetExpressCheckoutDetailsResponseType;
use PayPal\PayPalAPI\SetExpressCheckoutReq;
use PayPal\PayPalAPI\SetExpressCheckoutRequestType;
use PayPal\Service\PayPalAPIInterfaceServiceService;
use ProductBundle\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;
use ProductBundle\Entity\Purchase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;

class Payment
{
    private $em;
    private $router;
    private $cancelUrl;
    private $returnUrl;
    private $paypalUrl;
    private $currencyCode;
    private $itemTotal;
    private $taxTotal;

    public function __construct(Router $router, $env, EntityManager $em)
    {
        //initialisation des services
        $this->em = $em;
        $this->router = $router;
        //paramètres différents en fonction de l'environnement
        if($env === "dev"){
            $url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'];
            $this->paypalUrl = 'https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=';
        }else{
            $url = 'https://'.$_SERVER['SERVER_NAME'];
            $this->paypalUrl = '';
        }
        $this->returnUrl = $url.$router->generate('paypal_return');
        $this->cancelUrl = $url.$router->generate('paypal_cancel');

        $this->currencyCode = 'EUR';
    }

    /**
     * @param Purchase $commande
     * @return RedirectResponse
     * @throws \Exception
     */
    public function pay(Purchase $commande){
        //initialisation du paiement
        $rep = $this->em->getRepository('AppBundle:Parameters');
        $tva = current($rep->findBy(array('name' => 'TVA')));
        $tva = (float)$tva->getValue();

        // total shipping amount
        $shippingTotal = new BasicAmountType($this->currencyCode, 0);

        //total handling amount if any
        $handlingTotal = new BasicAmountType($this->currencyCode, 0);

        //total insurance amount if any
        $insuranceTotal = new BasicAmountType($this->currencyCode, 0);

        $address = $this->initAdresse($commande);

        //ajout items + prix + taxes
        $paymentDetails = $this->initPaymentDetails($commande, $tva);
        // prix au bon format
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
        $setECReq = $this->initECReq($setECReqDetails);

        /*
         * 	 ## Creating service wrapper object
        Creating service wrapper object to make API call and loading
        Configuration::getAcctAndConfig() returns array that contains credential and config parameters
        */
        $paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
        try {
            /* wrap API method calls on the service object with a try catch */
            $setECResponse = $paypalService->SetExpressCheckout($setECReq);
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
        if($setECResponse->Ack =='Success') {
            $token = $setECResponse->Token;
            return new RedirectResponse($this->paypalUrl.$token);
            // Redirect to paypal.com here
            // echo' <a href="'.$this->paypalUrl.$token.'"><b>* Redirect to PayPal to login </b></a><br>';
        }
        throw new \Exception("Error with payment");

    }

    /**
     * @param string $token
     * @param string $payerID
     * @return RedirectResponse
     * @throws \Exception
     */
    public function validatePayment(string $token, string $payerID){
        //validation du paiement

        //récupération des infos du paiement
        if(!($paymentInfo = $this->getPaymentInfo($token, $payerID))){
            throw new \Exception("Cannot validate payment");
        }
        /*
         * The total cost of the transaction to the buyer. If shipping cost (not applicable to digital goods) and tax charges are known, include them in this value. If not, this value should be the current sub-total of the order. If the transaction includes one or more one-time purchases, this field must be equal to the sum of the purchases. Set this field to 0 if the transaction does not include a one-time purchase such as when you set up a billing agreement for a recurring payment that is not immediately charged. When the field is set to 0, purchase-specific fields are ignored.
         */
        $paymentDetails= $paymentInfo->PaymentDetails[0];


        $DoECRequestDetails = new DoExpressCheckoutPaymentRequestDetailsType();
        $DoECRequestDetails->PayerID = $payerID;
        $DoECRequestDetails->Token = $token;
        $DoECRequestDetails->PaymentAction = 'Sale';
        $DoECRequestDetails->PaymentDetails[0] = $paymentDetails;

        $DoECRequest = new DoExpressCheckoutPaymentRequestType();
        $DoECRequest->DoExpressCheckoutPaymentRequestDetails = $DoECRequestDetails;


        $DoECReq = new DoExpressCheckoutPaymentReq();
        $DoECReq->DoExpressCheckoutPaymentRequest = $DoECRequest;
        $paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
        try {
            /* wrap API method calls on the service object with a try catch */
            $DoECResponse = $paypalService->DoExpressCheckoutPayment($DoECReq);
            $rep = $this->em->getRepository('ProductBundle:Purchase');
            $commande = $rep->find($paymentInfo->InvoiceID);
            if($commande === null){
                throw new \Exception("wrong purchase id");
            }
            //la commande a été payée
            $commande->setPaid(true);
            $this->em->persist($commande);
            $this->em->flush();
        } catch (\Exception $ex) {
            $error = true;
        }
        if(!isset($DoECResponse) or $DoECResponse->Ack !== 'Success' or isset($error)) {
            throw new \Exception("Payment not accepted");
        }
        return new RedirectResponse($this->router->generate('paypal_paid'));
    }

    /**
     * @param string $token
     * @param string $payerID
     * @return bool|GetExpressCheckoutDetailsResponseType
     */
    private function getPaymentInfo(string $token, string $payerID){
        $getExpressCheckoutDetailsRequest = new GetExpressCheckoutDetailsRequestType($token);
        $getExpressCheckoutReq = new GetExpressCheckoutDetailsReq();
        $getExpressCheckoutReq->GetExpressCheckoutDetailsRequest = $getExpressCheckoutDetailsRequest;

        $paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
        try {
            /* wrap API method calls on the service object with a try catch */
            $getECResponse = $paypalService->GetExpressCheckoutDetails($getExpressCheckoutReq);
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
        if($getECResponse->Ack === 'Success'){
            return $getECResponse->GetExpressCheckoutDetailsResponseDetails;
        }
        else{
            return false;
        }

    }

    /**
     * @param Purchase $commande
     * @return AddressType
     */
    private function initAdresse(Purchase $commande):AddressType{
        // shipping address
        $address = new AddressType();
        $address->CityName = $commande->getCity();
        $address->Name = $commande->getFirstname().' '.$commande->getLastname();
        $address->Street1 = $commande->getAddress();
        $address->StateOrProvince = '';
        $address->PostalCode = $commande->getPostalCode();
        $address->Country = $commande->getCountry();
        $address->Phone = $commande->getPhone();
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
        $paymentDetails->InvoiceID = $commande->getId();
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

    private function initECReq(SetExpressCheckoutRequestDetailsType $setECReqDetails){
        $setECReqType = new SetExpressCheckoutRequestType();
        $setECReqType->SetExpressCheckoutRequestDetails = $setECReqDetails;
        $setECReq = new SetExpressCheckoutReq();
        $setECReq->SetExpressCheckoutRequest = $setECReqType;
        return $setECReq;
    }
}