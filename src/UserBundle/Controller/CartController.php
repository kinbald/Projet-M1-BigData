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
        /*
         * Vérifie que l'utilisateur correspond à la commande
         * */
        if($this->getUser() !== $commande->getUser()){
            throw new AccessDeniedHttpException();
        }
        /*
         *Appel du service et début du paiement
         *  */
        $paypal = $this->get('app.paypal');
        /*
         * Redirection vers paypal
         * */
        return $paypal->pay($commande);
        // return $this->render('UserBundle:Default:empty.html.twig');
//        return $this->redirect($paypal->pay($commande, $tva[0]->getValue()));
    }

    /**
     * @Method("GET")
     * @Route("/return", name="paypal_return")
     */
    public function returnAction(){
        /*
         * L'utilisateur a rentré ses informations de paiement sur Paypal
         * */
        if(!isset($_REQUEST['token']) or !isset($_REQUEST['PayerID'])
            or empty($_REQUEST['token']) or empty($_REQUEST['PayerID'])){
            throw new \HttpInvalidParamException();
        }
        $token =urlencode( $_REQUEST['token']);
        $payerId=urlencode(  $_REQUEST['PayerID']);
        /*
         * Récupération du service
         * */
        $paypal = $this->get('app.paypal');
        /*
         * Validation du paiement
         * */
        return $paypal->validatePayment($token, $payerId);
    }

    /**
     * @Method("GET")
     * @Route("/cancel", name="paypal_cancel")
     */
    public function cancelAction(){
        //annulation du paiement
        return $this->render('AppBundle:Paypal:cancel.html.twig');
    }

    /**
     * @Method("GET")
     * @Route("/paid", name="paypal_paid")
     */
    public function paidAction(){
        //paiement effectué ==> panier remis à 0
        return $this->render('AppBundle:Paypal:paid.html.twig');
    }
}