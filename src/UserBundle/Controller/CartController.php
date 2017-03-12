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
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('ProductBundle:Product');
        $commande = new Purchase();
        if('POST' === $request->getMethod())
        {
            $model = new CartModel($this->getDoctrine()->getManager());

            $idList = explode(",", $request->get('id_list'));
            $quantityList = explode(",", $request->get('quantity_list'));

            $rightQuantityList = Array();
            $quantityListError = Array();
            $productError = Array();
            $products = Array();
            $products_pictures = Array();
            $products_pictures_error = Array();

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
                }
            }
            $commande->setUser($this->getUser());
            $rep = $em->getRepository('AppBundle:Parameters');
            $tva = $rep->findByName('TVA');

            return $this->render('UserBundle:Default:panier.html.twig', [
                'commande' => $commande,
                'tva' => $tva[0]->getValue(),
                'quantityListError' => $quantityListError,
                'productError' => $productError,
                'products_pictures_error' => $products_pictures_error
            ]);
        }


    }
}