<?php

namespace ProductBundle\Controller;

use ProductBundle\Entity\ProductConditioning;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Productconditioning controller.
 *
 * @Route("conditioning")
 */
class ProductConditioningController extends Controller
{
    /**
     * Lists all productConditioning entities.
     *
     * @Route("/", name="conditioning_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productConditionings = $em->getRepository('ProductBundle:ProductConditioning')->findAll();

        return $this->render('ProductBundle:productconditioning:index.html.twig', array(
            'productConditionings' => $productConditionings,
        ));
    }

    /**
     * Creates a new productConditioning entity.
     *
     * @Route("/new", name="conditioning_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $productConditioning = new Productconditioning();
        $form = $this->createForm('ProductBundle\Form\ProductConditioningType', $productConditioning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($productConditioning);
            $em->flush($productConditioning);

            return $this->redirectToRoute('conditioning_show', array('id' => $productConditioning->getId()));
        }

        return $this->render('ProductBundle:productconditioning:new.html.twig', array(
            'productConditioning' => $productConditioning,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a productConditioning entity.
     *
     * @Route("/{id}", name="conditioning_show")
     * @Method("GET")
     */
    public function showAction(ProductConditioning $productConditioning)
    {
        $deleteForm = $this->createDeleteForm($productConditioning);

        return $this->render('ProductBundle:productconditioning:show.html.twig', array(
            'productConditioning' => $productConditioning,
            'delete_form' => $deleteForm->createView(),
            'has_purchases' => count($productConditioning->getPurchases()) > 0
        ));
    }

    /**
     * Displays a form to edit an existing productConditioning entity.
     *
     * @Route("/{id}/edit", name="conditioning_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProductConditioning $productConditioning)
    {
        $deleteForm = $this->createDeleteForm($productConditioning);
        $editForm = $this->createForm('ProductBundle\Form\ProductConditioningType', $productConditioning);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('conditioning_edit', array('id' => $productConditioning->getId()));
        }

        return $this->render('ProductBundle:productconditioning:edit.html.twig', array(
            'productConditioning' => $productConditioning,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Deletes a productConditioning entity.
     *
     * @Route("/{id}", name="conditioning_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProductConditioning $productConditioning)
    {
        $form = $this->createDeleteForm($productConditioning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && count($productConditioning->getPurchases()) == 0) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($productConditioning);
            $em->flush();
        }

        return $this->redirectToRoute('conditioning_index');
    }

    /**
     * Creates a form to delete a productConditioning entity.
     *
     * @param ProductConditioning $productConditioning The productConditioning entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProductConditioning $productConditioning)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('conditioning_delete', array('id' => $productConditioning->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
