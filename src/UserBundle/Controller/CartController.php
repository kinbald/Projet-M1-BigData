<?php
/**
 * Created by PhpStorm.
 * User: cam2
 * Date: 27/01/17
 * Time: 14:52
 */

namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Model\CartModel;

/**
 * @Route("/cart")
 */

class CartController extends Controller
{
    /**
     * @Route("/", name="cart_view")
     */
    public function indexAction(Request $request)
    {
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
                    array_push($products, $model->find($idList[$i]));
                    array_push($products_pictures, $model->find($idList[$i])->getPictures());
                    array_push($rightQuantityList, $quantityList[$i]);
                }
            }

            return $this->render('UserBundle:Default:panier.html.twig', [
                'request' => $request->request,
                'products' => $products,
                'amount' => $request->request->get('amount'),
                'quantity_list' => $rightQuantityList,
                'quantityListError' => $quantityListError,
                'productError' => $productError,
                'products_pictures' => $products_pictures,
                'products_pictures_error' => $products_pictures_error
            ]);
        }


    }
}