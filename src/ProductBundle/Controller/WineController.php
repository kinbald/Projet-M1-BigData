<?php


namespace ProductBundle\Controller;

use ProductBundle\Entity\Product;
use ProductBundle\Entity\Wine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;



/**
 * Lists all wine entities
 * @Route("/wine")
 */


class WineController extends \ProductBundle\Controller\ProductController
{

    /**
     * Lists all wine entities.
     *
     * @Route("/", name="wine_index")
     * @Method("GET")
     */
    public function indexAction($product_type = 'wine')
    {
        return parent::indexAction($product_type);
    }

    /**
     * Creates a new product entity.
     *
     * @Route("/new", name="wine_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Product $wine = null, $prod = 'wine')
    {
        return parent::newAction($request, new wine(), $prod);
    }


    /**
     * Displays a form to edit an existing wine entity.
     *
     * @Route("/{id}/edit", name="wine_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Product $wine , $prod = 'wine')
    {
        return parent::editAction($request, $wine, $prod);
    }



    /**
     * Deletes a wine entity.
     *
     * @Route("/{id}/delete", name="wine_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Product $wine , $prod = 'wine') {

        return parent::deleteAction($request, $wine, $prod);
    }




    /**
     * Creates a form to delete a wine entity.
     *
     * @param Wine $wine The wine entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    protected function createDeleteForm(Product $wine, $prod = 'wine')
    {
        return parent::createDeleteForm( $wine, $prod);
    }





    /**
     * Finds and displays a wine entity.
     *
     * @Route("/{id}", name="wine_show")
     * @Method("GET")
     */
    public function showAction(Product $wine, $prod = 'wine')
    {
        return parent::showAction( $wine, $prod);
    }


}
