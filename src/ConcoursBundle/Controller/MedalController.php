<?php

namespace ConcoursBundle\Controller;

use ConcoursBundle\Entity\Medal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Medal controller.
 *
 * @Route("medal")
 */
class MedalController extends Controller
{
    /**
     * Lists all medal entities.
     *
     * @Route("/", name="medal_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $medals = $em->getRepository('ConcoursBundle:Medal')->findAll();

        return $this->render('medal/index.html.twig', array(
            'medals' => $medals,
        ));
    }

    /**
     * Creates a new medal entity.
     *
     * @Route("/new", name="medal_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $medal = new Medal();
        $form = $this->createForm('ConcoursBundle\Form\MedalType', $medal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($medal);
            $em->flush();

            return $this->redirectToRoute('medal_show', array('id' => $medal->getId()));
        }

        return $this->render('medal/new.html.twig', array(
            'medal' => $medal,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a medal entity.
     *
     * @Route("/{id}", name="medal_show")
     * @Method("GET")
     */
    public function showAction(Medal $medal)
    {
        $deleteForm = $this->createDeleteForm($medal);

        return $this->render('medal/show.html.twig', array(
            'medal' => $medal,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing medal entity.
     *
     * @Route("/{id}/edit", name="medal_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Medal $medal)
    {
        $deleteForm = $this->createDeleteForm($medal);
        $editForm = $this->createForm('ConcoursBundle\Form\MedalType', $medal);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medal_edit', array('id' => $medal->getId()));
        }

        return $this->render('medal/edit.html.twig', array(
            'medal' => $medal,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a medal entity.
     *
     * @Route("/{id}", name="medal_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Medal $medal)
    {
        $form = $this->createDeleteForm($medal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($medal);
            $em->flush();
        }

        return $this->redirectToRoute('medal_index');
    }

    /**
     * Creates a form to delete a medal entity.
     *
     * @param Medal $medal The medal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Medal $medal)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('medal_delete', array('id' => $medal->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
