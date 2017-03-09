<?php
/**
 * Created by PhpStorm.
 * User: cam2
 * Date: 27/01/17
 * Time: 14:52
 */

namespace UserBundle\Controller;

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

/**
 * @Route("/cart")
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

            $rightQuantityList = Array();
            $quantityListError = Array();
            $productError = Array();
            $products = Array();
            $products_pictures = Array();
            $products_pictures_error = Array();

            $model->removeUserReservation($this->getUser());

            $em->flush();

            for($i = 0; $i < count($idList); $i++ ){
                if($model->find($idList[$i]) == null)
                {
                    return $this->render('UserBundle:Default:error.html.twig');
                }else if($model->getQuantityById($idList[$i]) < $quantityList[$i])
                {
                    array_push($productError, $model->find($idList[$i]));
                    array_push($quantityListError, $quantityList[$i]);
                    array_push($products_pictures_error, $model->find($idList[$i])->getPictures());
                }else
                {
                    $product = $rep->find($idList[$i]);
                    $prodPurchase = new ProductPurchase();
                    $prodPurchase->setProduct($product);
                    $prodPurchase->setPurchase($commande);
                    $prodPurchase->setStock($quantityList[$i]);
                    $commande->addProduct($prodPurchase);


                    array_push($products, $model->find($idList[$i]));
                    array_push($products_pictures, $model->find($idList[$i])->getPictures());
                    array_push($rightQuantityList, $quantityList[$i]);

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
            $rep = $em->getRepository('AppBundle:Parameters');
            $tva = $rep->findByName('TVA');

            return $this->render('UserBundle:Default:panier.html.twig', [
                'commande' => $commande,
                'tva' => $tva[0]->getValue(),
                'products' => $products,
                'amount' => $request->request->get('amount'),
                'quantity_list' => $rightQuantityList,
                'quantityListError' => $quantityListError,
                'productError' => $productError,
                'products_pictures_error' => $products_pictures_error
            ]);

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

        $panier = $request->get('panier');

        for($i = 0; $i < count($panier); $i++ )
        {
            $nouvelleQuantite = $model->getQuantityById((int)$panier[$i]['id']) + (int)$model->getQuantityReservationById((int)$panier[$i]['id'], $this->getUser()) - (int)$panier[$i]['quantity'];
            $model->setQuantityById((int)$panier[$i]['id'], $nouvelleQuantite);

            $reservation = new Reservation();
            $reservation->setQuantity((int)$panier[$i]['quantity']);
            $reservation->setDate(new \DateTime);
            $reservation->setUser($this->getUser());
            $reservation->setProduct((int)$panier[$i]['id']);
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