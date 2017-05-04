<?php
/**
 * Created by PhpStorm.
 * User: cam2
 * Date: 27/01/17
 * Time: 14:52
 */

namespace UserBundle\Controller;

use AppBundle\Payment\Configuration;
use Doctrine\Common\Util\Debug;
use ProductBundle\Entity\ProductPurchase;
use ProductBundle\Entity\Purchase;
use ProductBundle\Entity\Reservation;
use ProductBundle\Form\ProductDeliveryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use UserBundle\Entity\Address;
use UserBundle\Form\AddressType;
use UserBundle\Form\Type\DeliveryPurchaseType;
use UserBundle\Model\CartModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @Route("/cart")
 * @Security("has_role('ROLE_CONSUMER')")
 */

class CartController extends Controller
{

    /**
     * @Route("/address", name="purchase_informations")
     * @Security("has_role('ROLE_CONSUMER')")
     * @Method({"POST", "GET"})
     */
    public function purchaseAction(Request $request)
    {
        $purchase = new Purchase();
        $addresse = new Address();
        $form = $this->createForm(AddressType::class, $addresse);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $session = new Session();
            //$session->start();
            /*if(!$session->isStarted()){
                $session->start();
            }*/
            $purchase_id = $session->get('commande');
            $rep = $em->getRepository('ProductBundle:Purchase');
            $purchase = $rep->find($purchase_id);
            if($purchase === null or $purchase->getPaid()){
                throw new NotFoundHttpException();
            }
            $purchase->setFirstname($addresse->getFirstName())
                ->setLastname($addresse->getLastName())
                ->setAddress($addresse->getAddress())
                ->setCity($addresse->getCity())
                ->setCountry($addresse->getCountry())
                ->setDateOrder(new \DateTime())
                ->setPostalCode($addresse->getPostalCode())
                ->setState($addresse->getState());
            $em->persist($purchase);
            $em->flush();

            return $this->redirectToRoute('choose_delivery', array(
                //'id' => $purchase->getId()
            ));
        }

        return $this->render('UserBundle:Default:purchase.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/", name="cart_view")
     * @Security("has_role('ROLE_CONSUMER')")
     * @Method({"POST"})
     */

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('ProductBundle:Product');
        $repConditioning = $em->getRepository('ProductBundle:ProductConditioning');
        $commande = new Purchase();
        $model = new CartModel($this->getDoctrine()->getManager());
        $em = $this->getDoctrine()->getManager();

        $idList = explode(",", $request->get('id_list'));
        $quantityList = explode(",", $request->get('quantity_list'));
        $conditioningTypeList = explode(",", $request->get('conditioning_type_list'));


        $model->removeUserReservation($this->getUser());

        $em->flush();

        for($i = 0; $i < count($idList); $i++ ){
            if($model->find($idList[$i]) == null)
            {
                return $this->render('UserBundle:Default:error.html.twig');
            }else
            {
                $conditioningType = $repConditioning->find($conditioningTypeList[$i]);
                $prodPurchase = new ProductPurchase();
                $prodPurchase->setPurchase($commande);
                $prodPurchase->setConditioningType($conditioningType);
                $prodPurchase->setStock($quantityList[$i]);
                $em->persist($prodPurchase);
                $commande->addProduct($prodPurchase);
                $reservation = new Reservation();
                $reservation->setQuantity($quantityList[$i]);
                $reservation->setDate(new \DateTime);
                $reservation->setUser($this->getUser());
                $reservation->setProductConditioning($conditioningType);
                $em->persist($reservation);
                $em->flush();
            }
        }
        $commande->setUser($this->getUser());
        /*$em->persist($commande);
        $em->flush();*/

        $session = new Session();
        /*if(!$session->isStarted()){
            $session->start();
        }*/

        $em->persist($commande);
        $em->flush();
        $session->set('commande', $commande->getId());

        return $this->redirectToRoute('purchase_informations');

        /*return $this->redirectToRoute('show_cart', array(
            'id' => $commande->getId()
        ));*/
    }

    /**
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_CONSUMER')")
     * @Route("/delivery", name="choose_delivery")
     */
    public function chooseDeliveryAction(Request $request){
        $session = new Session();
        $purchase = new Purchase();
        $em = $this->getDoctrine()->getManager();
        //if($request->getMethod() === 'GET'){

            $purchase_id = $session->get('commande');
            $rep = $em->getRepository('ProductBundle:Purchase');
            $purchase = $rep->find($purchase_id);
        //}

        if($purchase === null or $purchase->getPaid()){
            throw new NotFoundHttpException();
        }

        $form = $this->createForm(ProductDeliveryType::class, $purchase)
            ->add('Valider', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($purchase);
            $em->flush();
            return $this->redirectToRoute('show_cart', array('id' => $purchase->getId()));
        }

        return $this->render('ProductBundle:delivery:choose.html.twig', array(
            'form' => $form->createView(),
            'purchase' => $purchase->getProducts()
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



    /**
     * @Route("/refresh", name="refresh")
     * @Method({"POST"})
     */
    public function refreshAction(Request $request)
    {
        $model = new CartModel($this->getDoctrine()->getManager());
        $em = $this->getDoctrine()->getManager();
        $model->removeUserReservation($this->getUser());
        $repConditioning = $em->getRepository('ProductBundle:ProductConditioning');

        $panier = $request->get('panier');

        for($i = 0; $i < count($panier); $i++ )
        {
            $reservation = new Reservation();
            $reservation->setQuantity((int)$panier[$i]['quantity']);
            $reservation->setDate(new \DateTime);
            $reservation->setUser($this->getUser());
            $reservation->setProductConditioning($repConditioning->find((int)$panier[$i]['conditioningTypeId']));
            $em->persist($reservation);
            $em->flush();
        }

        $response = new JsonResponse();
        $response->setData(array(
            null
        ));
        return $response;
    }
}