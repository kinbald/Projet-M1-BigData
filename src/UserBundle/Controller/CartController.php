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

            return $this->render('UserBundle:Default:panier.html.twig', [
                'request' => $request
            ]);
        }


    }
}