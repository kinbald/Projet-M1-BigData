<?php

namespace UserBundle\Controller;

use UserBundle\Entity\UserConsumer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Userconsumer controller.
 *
 * @Route("userconsumer")
 */
class UserConsumerController extends Controller
{
    /**
     * Lists all userConsumer entities.
     *
     * @Route("/", name="userconsumer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $userConsumers = $em->getRepository('UserBundle:UserConsumer')->findAll();

        return $this->render('UserBundle:userconsumer:index.html.twig', array(
            'userConsumers' => $userConsumers,
        ));
    }

    /**
     * Creates a new userConsumer entity.
     *
     * @Route("/new", name="userconsumer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $userConsumer = new Userconsumer();
        $form = $this->createForm('UserBundle\Form\UserConsumerType', $userConsumer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($userConsumer);
            $em->flush($userConsumer);

            return $this->redirectToRoute('userconsumer_show', array('id' => $userConsumer->getId()));
        }

        return $this->render('UserBundle:userconsumer:new.html.twig', array(
            'userConsumer' => $userConsumer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a userConsumer entity.
     *
     * @Route("/{id}", name="userconsumer_show")
     * @Method("GET")
     */
    public function showAction(UserConsumer $userConsumer)
    {
        $deleteForm = $this->createDeleteForm($userConsumer);

        return $this->render('UserBundle:userconsumer:show.html.twig', array(
            'userConsumer' => $userConsumer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing userConsumer entity.
     *
     * @Route("/{id}/edit", name="userconsumer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UserConsumer $userConsumer)
    {
        $deleteForm = $this->createDeleteForm($userConsumer);
        $editForm = $this->createForm('UserBundle\Form\UserConsumerType', $userConsumer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('userconsumer_edit', array('id' => $userConsumer->getId()));
        }

        return $this->render('UserBundle:userconsumer:edit.html.twig', array(
            'userConsumer' => $userConsumer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a userConsumer entity.
     *
     * @Route("/{id}", name="userconsumer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, UserConsumer $userConsumer)
    {
        $form = $this->createDeleteForm($userConsumer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userConsumer);
            $em->flush($userConsumer);
        }

        return $this->redirectToRoute('userconsumer_index');
    }

    /**
     * Creates a form to delete a userConsumer entity.
     *
     * @param UserConsumer $userConsumer The userConsumer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UserConsumer $userConsumer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('userconsumer_delete', array('id' => $userConsumer->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
