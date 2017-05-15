<?php

namespace UserBundle\Controller;

use UserBundle\Entity\UserProducer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Userproducer controller.
 *
 * @Route("userproducer")
 */
class UserProducerController extends Controller
{
    /**
     * Lists all userProducer entities.
     *
     * @Route("/", name="userproducer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $userProducers = $em->getRepository('UserBundle:UserProducer')->findAll();

        return $this->render('UserBundle:userproducer:index.html.twig', array(
            'userProducers' => $userProducers,
        ));
    }

    /**
     * Creates a new userProducer entity.
     *
     * @Route("/new", name="userproducer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $userProducer = new Userproducer();
        $form = $this->createForm('UserBundle\Form\UserProducerType', $userProducer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($userProducer);
            $em->flush();

            return $this->redirectToRoute('userproducer_show', array('id' => $userProducer->getId()));
        }

        return $this->render('UserBundle:userproducer:new.html.twig', array(
            'userProducer' => $userProducer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a userProducer entity.
     *
     * @Route("/{id}", name="userproducer_show")
     * @Method("GET")
     */
    public function showAction(UserProducer $userProducer)
    {
        $deleteForm = $this->createDeleteForm($userProducer);

        return $this->render('UserBundle:userproducer:show.html.twig', array(
            'userProducer' => $userProducer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing userProducer entity.
     *
     * @Route("/{id}/edit", name="userproducer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UserProducer $userProducer)
    {
        $deleteForm = $this->createDeleteForm($userProducer);
        $editForm = $this->createForm('UserBundle\Form\UserProducerType', $userProducer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('userproducer_edit', array('id' => $userProducer->getId()));
        }

        return $this->render('UserBundle:userproducer:edit.html.twig', array(
            'userProducer' => $userProducer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a userProducer entity.
     *
     * @Route("/{id}", name="userproducer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, UserProducer $userProducer)
    {
        $form = $this->createDeleteForm($userProducer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userProducer);
            $em->flush();
        }

        return $this->redirectToRoute('userproducer_index');
    }

    /**
     * Creates a form to delete a userProducer entity.
     *
     * @param UserProducer $userProducer The userProducer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UserProducer $userProducer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('userproducer_delete', array('id' => $userProducer->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
