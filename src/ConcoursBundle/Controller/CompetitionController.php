<?php

namespace ConcoursBundle\Controller;

use ConcoursBundle\Entity\Competition;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Competition controller.
 *
 * @Route("competition")
 */
class CompetitionController extends Controller
{
    /**
     * Lists all competition entities.
     *
     * @Route("/", name="competition_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $competitions = $em->getRepository('ConcoursBundle:Competition')->findAll();

        return $this->render('ConcoursBundle:competition:index.html.twig', array(
            'competitions' => $competitions,
        ));
    }

    /**
     * Creates a new competition entity.
     *
     * @Route("/new", name="competition_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $competition = new Competition();
        $form = $this->createForm('ConcoursBundle\Form\CompetitionType', $competition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($competition);
            $em->flush();

            return $this->redirectToRoute('competition_show', array('id' => $competition->getId()));
        }

        return $this->render('ConcoursBundle:competition:new.html.twig', array(
            'competition' => $competition,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a competition entity.
     *
     * @Route("/{id}", name="competition_show")
     * @Method("GET")
     */
    public function showAction(Competition $competition)
    {
        $deleteForm = $this->createDeleteForm($competition);

        return $this->render('ConcoursBundle:competition:show.html.twig', array(
            'competition' => $competition,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing competition entity.
     *
     * @Route("/{id}/edit", name="competition_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Competition $competition)
    {
        $deleteForm = $this->createDeleteForm($competition);
        $editForm = $this->createForm('ConcoursBundle\Form\CompetitionType', $competition);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('competition_edit', array('id' => $competition->getId()));
        }

        return $this->render('ConcoursBundle:competition:edit.html.twig', array(
            'competition' => $competition,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a competition entity.
     *
     * @Route("/{id}", name="competition_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Competition $competition)
    {
        $form = $this->createDeleteForm($competition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($competition);
            $em->flush();
        }

        return $this->redirectToRoute('competition_index');
    }

    /**
     * Creates a form to delete a competition entity.
     *
     * @param Competition $competition The competition entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Competition $competition)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('competition_delete', array('id' => $competition->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
