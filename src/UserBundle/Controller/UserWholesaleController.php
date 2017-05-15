<?php

namespace UserBundle\Controller;

use UserBundle\Entity\UserWholesale;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Userwholesale controller.
 *
 * @Route("userwholesale")
 */
class UserWholesaleController extends Controller
{
    /**
     * Lists all userWholesale entities.
     *
     * @Route("/", name="userwholesale_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $userWholesales = $em->getRepository('UserBundle:UserWholesale')->findAll();

        return $this->render('UserBundle:userwholesale:index.html.twig', array(
            'userWholesales' => $userWholesales,
        ));
    }

    /**
     * Creates a new userWholesale entity.
     *
     * @Route("/new", name="userwholesale_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $userWholesale = new Userwholesale();
        $form = $this->createForm('UserBundle\Form\UserWholesaleType', $userWholesale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($userWholesale);
            $em->flush();

            return $this->redirectToRoute('userwholesale_show', array('id' => $userWholesale->getId()));
        }

        return $this->render('UserBundle:userwholesale:new.html.twig', array(
            'userWholesale' => $userWholesale,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a userWholesale entity.
     *
     * @Route("/{id}", name="userwholesale_show")
     * @Method("GET")
     */
    public function showAction(UserWholesale $userWholesale)
    {
        $deleteForm = $this->createDeleteForm($userWholesale);

        return $this->render('UserBundle:userwholesale:show.html.twig', array(
            'userWholesale' => $userWholesale,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing userWholesale entity.
     *
     * @Route("/{id}/edit", name="userwholesale_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UserWholesale $userWholesale)
    {
        $deleteForm = $this->createDeleteForm($userWholesale);
        $editForm = $this->createForm('UserBundle\Form\UserWholesaleType', $userWholesale);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('userwholesale_edit', array('id' => $userWholesale->getId()));
        }

        return $this->render('UserBundle:userwholesale:edit.html.twig', array(
            'userWholesale' => $userWholesale,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a userWholesale entity.
     *
     * @Route("/{id}", name="userwholesale_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, UserWholesale $userWholesale)
    {
        $form = $this->createDeleteForm($userWholesale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userWholesale);
            $em->flush();
        }

        return $this->redirectToRoute('userwholesale_index');
    }

    /**
     * Creates a form to delete a userWholesale entity.
     *
     * @param UserWholesale $userWholesale The userWholesale entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UserWholesale $userWholesale)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('userwholesale_delete', array('id' => $userWholesale->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
