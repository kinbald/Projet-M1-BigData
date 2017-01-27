<?php


namespace ProductBundle\Controller;

use ProductBundle\Entity\Product;
use ProductBundle\Entity\Spirit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;



/**
 * Lists all spirit entities
 * @Route("/spirit")
 */


class SpiritController extends \ProductBundle\Controller\ProductController
{

    /**
     * Lists all spirit entities.
     *
     * @Route("/", name="spirit_index")
     * @Method("GET")
     */
    public function indexAction($product_type = 'spirit')
    {
        return parent::indexAction($product_type);
    }

    /**
     * Creates a new spirit entity.
     *
     * @Route("/new", name="spirit_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Product $spirit = null, $prod = 'spirit')
    {
        return parent::newAction($request, new Spirit(), $prod);
    }


    /**
     * Displays a form to edit an existing spirit entity.
     *
     * @Route("/{id}/edit", name="spirit_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Product $spirit , $prod = 'spirit')
    {
        return parent::editAction($request, $spirit, $prod);
    }



    /**
     * Deletes a spirit entity.
     *
     * @Route("/{id}/delete", name="spirit_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Product $spirit , $prod = 'spirit') {

        return parent::deleteAction($request, $spirit, $prod);
    }




/**
 * Creates a form to delete a spirit entity.
 *
 * @param Spirit $spirit The spirit entity
 *
 * @return \Symfony\Component\Form\Form The form
 */
protected function createDeleteForm(Product $spirit, $prod = 'spirit')
{
    return parent::createDeleteForm( $spirit, $prod);
}





    /**
     * Finds and displays a spirit entity.
     *
     * @Route("/{id}", name="spirit_show")
     * @Method("GET")
     */
    public function showAction(Product $spirit, $prod = 'spirit')
    {
        return parent::showAction( $spirit, $prod);
    }


}


