<?php

namespace ProductBundle\Controller;

use ProductBundle\Entity\Purchase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Purchase controller.
 *
 * @Route("purchase")
 */
class PurchaseController extends Controller
{
    /**
     * Lists all purchase entities.
     *
     * @Route("/", name="purchase_index")
     * @Method("GET")
     *
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $purchases = $em->getRepository('ProductBundle:Purchase')->findAll();

        return $this->render('ProductBundle:purchase:index.html.twig', array(
            'purchases' => $purchases,
        ));
    }

    /**
     * Creates a new purchase entity.
     *
     * @Route("/new", name="purchase_new")
     * @Method({"GET", "POST"})
     *
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $purchase = new Purchase();
        $form = $this->createForm('ProductBundle\Form\PurchaseType', $purchase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($purchase);
            $em->flush($purchase);

            return $this->redirectToRoute('purchase_show', array('id' => $purchase->getId()));
        }

        return $this->render('ProductBundle:purchase:new.html.twig', array(
            'purchase' => $purchase,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a purchase entity.
     *
     * @Route("/{id}", name="purchase_show"),
     *     requirements={
     *         "id": "\d+",
     *     })
     * @Method("GET")
     *
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction(Purchase $purchase)
    {
        $user = $purchase->getUser();

        $deleteForm = $this->createDeleteForm($purchase);
        return $this->render('ProductBundle:purchase:show.html.twig', array(
            'purchase' => $purchase,
            'base_user' => $user,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing purchase entity.
     *
     * @Route("/{id}/edit", name="purchase_edit",
     *     requirements={
     *         "id": "\d+",
     *     })
     * @Method({"GET", "POST"})
     *
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Purchase $purchase)
    {
        $deleteForm = $this->createDeleteForm($purchase);
        $editForm = $this->createForm('ProductBundle\Form\PurchaseType', $purchase);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('purchase_edit', array('id' => $purchase->getId()));
        }

        return $this->render('ProductBundle:purchase:edit.html.twig', array(
            'purchase' => $purchase,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a purchase entity.
     *
     * @Route("/{id}", name="purchase_delete",
     *     requirements={
     *         "id": "\d+",
     *     })
     * @Method("DELETE")
     *
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Purchase $purchase)
    {
        $form = $this->createDeleteForm($purchase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($purchase);
            $em->flush($purchase);
        }

        return $this->redirectToRoute('purchase_index');
    }

    /**
     * Creates a form to delete a purchase entity.
     *
     * @param Purchase $purchase The purchase entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Purchase $purchase)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('purchase_delete', array('id' => $purchase->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
