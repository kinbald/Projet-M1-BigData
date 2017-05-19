<?php

namespace ProductBundle\Controller;

use ProductBundle\Entity\Delivery;
use ProductBundle\Entity\ProductConditioning;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Productconditioning controller.
 *
 * @Route("delivery")
 * @Security("has_role('ROLE_ADMIN')")
 */
class DeliveryController extends Controller
{
    /**
     * Lists all delivery entities.
     *
     * @Route("/", name="delivery_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $delivery = $em->getRepository('ProductBundle:Delivery')->findAll();

        return $this->render('ProductBundle:delivery:index.html.twig', array(
            'deliveries' => $delivery,
        ));
    }

    /**
     * Creates a new delivery entity.
     *
     * @Route("/new", name="delivery_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $delivery = new Delivery();
        $form = $this->createForm('ProductBundle\Form\DeliveryType', $delivery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($delivery);
            $em->flush($delivery);

            return $this->redirectToRoute('delivery_show', array('id' => $delivery->getId()));
        }

        return $this->render('ProductBundle:delivery:new.html.twig', array(
            'delivery' => $delivery,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a delivery entity.
     *
     * @Route("/{id}", name="delivery_show")
     * @Method("GET")
     */
    public function showAction(Delivery $delivery)
    {
        $deleteForm = $this->createDeleteForm($delivery);

        return $this->render('ProductBundle:delivery:show.html.twig', array(
            'delivery' => $delivery,
            'delete_form' => $deleteForm->createView(),
            'has_purchases' => count($delivery->getPurchases()) > 0
        ));
    }

    /**
     * Displays a form to edit an existing delivery entity.
     *
     * @Route("/{id}/edit", name="delivery_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Delivery $delivery)
    {
        $deleteForm = $this->createDeleteForm($delivery);
        $editForm = $this->createForm('ProductBundle\Form\DeliveryType', $delivery);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('delivery_index');
        }

        return $this->render('ProductBundle:delivery:edit.html.twig', array(
            'delivery' => $delivery,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Deletes a delivery entity.
     *
     * @Route("/{id}", name="delivery_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Delivery $delivery)
    {
        $form = $this->createDeleteForm($delivery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && count($delivery->getPurchases()) == 0) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($delivery);
            $em->flush();
        }

        return $this->redirectToRoute('delivery_index');
    }

    /**
     * Creates a form to delete a productConditioning entity.
     *
     * @param Delivery $delivery The delivery entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Delivery $delivery)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delivery_delete', array('id' => $delivery->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
