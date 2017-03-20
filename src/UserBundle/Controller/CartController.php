<?php
/**
 * Created by PhpStorm.
 * User: cam2
 * Date: 27/01/17
 * Time: 14:52
 */

namespace UserBundle\Controller;

use AppBundle\Payment\Configuration;
use PayPal\CoreComponentTypes\BasicAmountType;
use PayPal\EBLBaseComponents\AddressType;
use PayPal\EBLBaseComponents\BillingAgreementDetailsType;
use PayPal\EBLBaseComponents\PaymentDetailsItemType;
use PayPal\EBLBaseComponents\PaymentDetailsType;
use PayPal\EBLBaseComponents\SetExpressCheckoutRequestDetailsType;
use PayPal\PayPalAPI\SetExpressCheckoutReq;
use PayPal\PayPalAPI\SetExpressCheckoutRequestType;
use PayPal\Service\PayPalAPIInterfaceServiceService;
use ProductBundle\Entity\ProductPurchase;
use ProductBundle\Entity\Purchase;
use ProductBundle\Entity\Reservation;
use AppBundle\Entity\Parameters;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Model\CartModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * @Route("/cart")
 * @Security("has_role('ROLE_CONSUMER')")
 */

class CartController extends Controller
{
    /**
     * @Route("/", name="cart_view")
     * @Security("has_role('ROLE_CONSUMER')")
     * @Method({"POST"})
     */

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('ProductBundle:Product');
        $commande = new Purchase();
        $model = new CartModel($this->getDoctrine()->getManager());
        $em = $this->getDoctrine()->getManager();

        $idList = explode(",", $request->get('id_list'));
        $quantityList = explode(",", $request->get('quantity_list'));


        $model->removeUserReservation($this->getUser());

        $em->flush();

        for($i = 0; $i < count($idList); $i++ ){
            if($model->find($idList[$i]) == null)
            {
                return $this->render('UserBundle:Default:error.html.twig');
            }else
            {
                $product = $rep->find($idList[$i]);
                $prodPurchase = new ProductPurchase();
                $prodPurchase->setProduct($product);
                $prodPurchase->setPurchase($commande);
                $prodPurchase->setStock($quantityList[$i]);
                $em->persist($prodPurchase);
                $commande->addProduct($prodPurchase);
                $reservation = new Reservation();
                $reservation->setQuantity($quantityList[$i]);
                $reservation->setDate(new \DateTime);
                $reservation->setUser($this->getUser());
                $reservation->setProduct($model->find($idList[$i]));
                $em->persist($reservation);
                $em->flush();
            }
        }
        $commande->setUser($this->getUser());
        $em->persist($commande);
        $em->flush();

        return $this->redirectToRoute('show_cart', array(
            'id' => $commande->getId()
        ));
    }


    /**
     * @Method("GET")
     * @Route("/{id}", requirements={"id" = "\d+"}, name="show_cart")
     */
    public function viewAction(Purchase $commande){
        if($this->getUser() !== $commande->getUser()){
            throw new AccessDeniedHttpException();
        }
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('AppBundle:Parameters');
        $tva = $rep->findByName('TVA');

        return $this->render('UserBundle:Default:panier.html.twig', [
            'commande' => $commande,
            'tva' => $tva[0]->getValue()
        ]);
    }

    /**
     * @Method("GET")
     * @Route("/pay/{id}", name="pay_cart")
     * @param Purchase $commande
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function payAction(Purchase $commande){
        $this->get('app.paypal');
        if($this->getUser() !== $commande->getUser()){
            throw new AccessDeniedHttpException();
        }
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('AppBundle:Parameters');
        $tva = $rep->findByName('TVA');


        $url = dirname('http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI']);
        $returnUrl = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$this->generateUrl("paypal_return");
        $cancelUrl = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$this->generateUrl("paypal_cancel");
        $currencyCode = 'EUR';

        // total shipping amount
        $shippingTotal = new BasicAmountType($currencyCode, 0);
        //total handling amount if any
        $handlingTotal = new BasicAmountType($currencyCode, 0);
        //total insurance amount if any
        $insuranceTotal = new BasicAmountType($currencyCode, 0);

        // shipping address
        $address = new AddressType();
        $address->CityName = 'Toulon';
        $address->Name = 'test';
        $address->Street1 = 'isen';
        $address->StateOrProvince = '';
        $address->PostalCode = '83000';
        $address->Country = 'FR';
        $address->Phone = '0101010101';

        // details about payment
        $paymentDetails = new PaymentDetailsType();
        $itemTotalValue = 0;
        $taxTotalValue = 0;

        /*
         * iterate through each item and add to item details
         */
        foreach ($commande->getProducts() as $key=>$productPurchase){
            $itemAmount = new BasicAmountType($currencyCode, number_format($productPurchase->getProduct()->getPrice(), 2, '.', ''));

            $itemTotalValue += $productPurchase->getProduct()->getPrice() * $productPurchase->getStock();
            $taxTotalValue += round($tva[0]->getValue()/100 * $productPurchase->getProduct()->getPrice() * $productPurchase->getStock(), 2);
            $itemDetails = new PaymentDetailsItemType();
            $itemDetails->Name = $productPurchase->getProduct()->getName();
            $itemDetails->Amount = $itemAmount;
            $itemDetails->Quantity = $productPurchase->getStock();
            /*
             * Indicates whether an item is digital or physical. For digital goods, this field is required and must be set to Digital. It is one of the following values:

            Digital

            Physical

             */
            $itemDetails->ItemCategory = 'Physical';
            $itemDetails->Tax = new BasicAmountType($currencyCode, round($tva[0]->getValue()/100 * $productPurchase->getProduct()->getPrice(), 2));

            $paymentDetails->PaymentDetailsItem[$key] = $itemDetails;
        }
        $itemTotalValue = round($itemTotalValue, 2);
        $taxTotalValue = round($taxTotalValue, 2);
        $itemTotalValue = number_format($itemTotalValue, 2, '.', '');
        $taxTotalValue = number_format($taxTotalValue, 2, '.', '');



        /*
         * The total cost of the transaction to the buyer. If shipping cost and tax charges are known, include them in this value. If not, this value should be the current subtotal of the order. If the transaction includes one or more one-time purchases, this field must be equal to the sum of the purchases. If the transaction does not include a one-time purchase such as when you set up a billing agreement for a recurring payment, set this field to 0.
         */
        $orderTotalValue = $shippingTotal->value + $handlingTotal->value +
            $insuranceTotal->value +
            $itemTotalValue + $taxTotalValue;

        //Payment details
        $paymentDetails->ShipToAddress = $address;
        $paymentDetails->ItemTotal = new BasicAmountType($currencyCode, $itemTotalValue);
        $paymentDetails->TaxTotal = new BasicAmountType($currencyCode, $taxTotalValue);
        $paymentDetails->OrderTotal = new BasicAmountType($currencyCode, $orderTotalValue);
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


        $setECReqDetails = new SetExpressCheckoutRequestDetailsType();
        $setECReqDetails->PaymentDetails[0] = $paymentDetails;
        /*
         * (Required) URL to which the buyer is returned if the buyer does not approve the use of PayPal to pay you. For digital goods, you must add JavaScript to this page to close the in-context experience.
         */
        $setECReqDetails->CancelURL = $cancelUrl;
        /*
         * (Required) URL to which the buyer's browser is returned after choosing to pay with PayPal. For digital goods, you must add JavaScript to this page to close the in-context experience.
         */
        $setECReqDetails->ReturnURL = $returnUrl;

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
        $setECReqDetails->BrandName = 'Vinasse';

        // Advanced options
        $setECReqDetails->AllowNote = '0';
        /*
         * Stopped here
         * */
        $setECReqType = new SetExpressCheckoutRequestType();
        $setECReqType->SetExpressCheckoutRequestDetails = $setECReqDetails;
        $setECReq = new SetExpressCheckoutReq();
        $setECReq->SetExpressCheckoutRequest = $setECReqType;

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
        if(isset($setECResponse)) {
            echo "<table>";
            echo "<tr><td>Ack :</td><td><div id='Ack'>$setECResponse->Ack</div> </td></tr>";
            echo "<tr><td>Token :</td><td><div id='Token'>$setECResponse->Token</div> </td></tr>";
            echo "</table>";
            echo '<pre>';
            print_r($setECResponse);
            echo '</pre>';
            if($setECResponse->Ack =='Success') {
                $token = $setECResponse->Token;
                // Redirect to paypal.com here
                $payPalURL = 'https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=' . $token;
                echo" <a href=$payPalURL><b>* Redirect to PayPal to login </b></a><br>";
            }
        }





        return $this->render('UserBundle:Default:empty.html.twig');
//        return $this->redirect($paypal->pay($commande, $tva[0]->getValue()));
    }

    /**
     * @Method("GET")
     * @Route("/return", name="paypal_return")
     */
    public function returnAction(){
        $token = htmlentities($_GET['token'], ENT_QUOTES);
        $paypal = $this->get('app.paypal');
        throw new \Exception(print_r($paypal->getDetails($token)));

        $id_commande=0;
        $rep = $this->getDoctrine()->getRepository('ProductBundle:Purchase');
        $commande = $rep->find($id_commande);

        if($paypal->validatePayment($commande, $token, htmlentities($_GET['PayerID'], ENT_QUOTES))){
            $this->get('session')->getFlashBag()->add('notice', 'commande commandée');
        }
        else{
            $this->get('session')->getFlashBag()->add('error', 'erreur lors du paiement');
        }
        return $this->redirectToRoute('homepage');

    }

    /**
     * @Method("GET")
     * @Route("/return", name="paypal_cancel")
     */
    public function cancelAction(){
        return $this->render('Paypal:cancel.html.twig');
    }
}