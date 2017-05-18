<?php

namespace ProductBundle\Controller;

use ProductBundle\Entity\Product;
use ProductBundle\Entity\ProductConditioning;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Productconditioning controller.
 *
 * @Route("conditioning")
 * @Security("has_role('ROLE_ADMIN')")
 */
class ProductConditioningController extends Controller
{
    /**
     * Lists all productConditioning entities.
     *
     * @Route("/{id}", name="conditioning_index")
     * @Method("GET")
     */
    public function indexAction(Request $request, Product $product)
    {
        $em = $this->getDoctrine()->getManager();

        $productConditionings = $em->getRepository('ProductBundle:ProductConditioning')->findByProduct($product);

        return $this->render('ProductBundle:productconditioning:index.html.twig', array(
            'productConditionings' => $productConditionings,
            'product' => $product
        ));
    }

    /**
     * Creates a new productConditioning entity.
     *
     * @Route("/{product}/new", name="conditioning_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Product $product)
    {
        $productConditioning = new Productconditioning();
        $form = $this->createForm('ProductBundle\Form\ProductConditioningType', $productConditioning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $productConditioning->setProduct($product);
            $em->persist($productConditioning);
            $em->flush($productConditioning);

            return $this->redirectToRoute('conditioning_index', array('id' => $product->getId()));
        }

        return $this->render('ProductBundle:productconditioning:new.html.twig', array(
            'productConditioning' => $productConditioning,
            'form' => $form->createView(),
            'product' => $product
        ));
    }

    /**
     * Finds and displays a productConditioning entity.
     *
     * @Route("/{product}/{id}", name="conditioning_show")
     * @Method("GET")
     */
    public function showAction(Product $product, ProductConditioning $productConditioning)
    {
        $deleteForm = $this->createDeleteForm($product, $productConditioning);

        return $this->render('ProductBundle:productconditioning:show.html.twig', array(
            'productConditioning' => $productConditioning,
            'delete_form' => $deleteForm->createView(),
            'has_purchases' => count($productConditioning->getPurchases()) > 0,
            'product' => $product
        ));
    }

    /**
     * Displays a form to edit an existing productConditioning entity.
     *
     * @Route("/{product}/{id}/edit", name="conditioning_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Product $product, ProductConditioning $productConditioning)
    {
        $deleteForm = $this->createDeleteForm($product, $productConditioning);
        $editForm = $this->createForm('ProductBundle\Form\ProductConditioningType', $productConditioning);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('conditioning_index', array('id' => $product->getId()));
        }

        return $this->render('ProductBundle:productconditioning:edit.html.twig', array(
            'productConditioning' => $productConditioning,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'product' => $product
        ));
    }

    /**
     * Deletes a productConditioning entity.
     *
     * @Route("/{product}/{id}", name="conditioning_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Product $product, ProductConditioning $productConditioning)
    {
        $form = $this->createDeleteForm($product, $productConditioning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && count($productConditioning->getPurchases()) == 0) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($productConditioning);
            $em->flush();
        }

        return $this->redirectToRoute('conditioning_index', array('id' => $product->getId()));
    }

    /**
     * Creates a form to delete a productConditioning entity.
     *
     * @param ProductConditioning $productConditioning The productConditioning entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Product $product, ProductConditioning $productConditioning)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('conditioning_delete', array('product' => $product->getId(), 'id' => $productConditioning->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
