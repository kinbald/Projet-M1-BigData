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
            //$data = $request->request->all()['form'];
            $model = new CartModel($this->getDoctrine()->getManager());

            $idList = explode(",", $request->get('id_list'));
            $quantityList = explode(",", $request->get('quantity_list'));
            $quantityListError = Array();

            for($i = 0; $i < count($idList); $i++ ){
                if($model->find($idList[$i]) == null)
                {
                    return $this->render('UserBundle:Default:error.html.twig');
                }else if($model->getQuantityById($idList[$i]) < $quantityList[$i])
                {
                    array_push($quantityListError, $model->find($idList[$i]));
                }
            }

            return $this->render('UserBundle:Default:panier.html.twig', [
                'request' => $request,
                'error_quantity' => $quantityListError
            ]);
        }


    }
}