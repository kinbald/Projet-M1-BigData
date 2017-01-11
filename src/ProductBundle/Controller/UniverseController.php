<?php

namespace ProductBundle\Controller;

use ProductBundle\Entity\Universe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Universe controller.
 *
 * @Route("universe")
 */
class UniverseController extends Controller
{
    /**
     * Lists all universe entities.
     *
     * @Route("/", name="universe_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $universes = $em->getRepository('ProductBundle:Universe')->findAll();

        return $this->render('universe/index.html.twig', array(
            'universes' => $universes,
        ));
    }

    /**
     * Creates a new universe entity.
     *
     * @Route("/new", name="universe_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $universe = new Universe();
        $form = $this->createForm('ProductBundle\Form\UniverseType', $universe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($universe);
            $em->flush($universe);

            return $this->redirectToRoute('universe_show', array('id' => $universe->getId()));
        }

        return $this->render('universe/new.html.twig', array(
            'universe' => $universe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a universe entity.
     *
     * @Route("/{id}", name="universe_show")
     * @Method("GET")
     */
    public function showAction(Universe $universe)
    {
        $deleteForm = $this->createDeleteForm($universe);

        return $this->render('universe/show.html.twig', array(
            'universe' => $universe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing universe entity.
     *
     * @Route("/{id}/edit", name="universe_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Universe $universe)
    {
        $deleteForm = $this->createDeleteForm($universe);
        $editForm = $this->createForm('ProductBundle\Form\UniverseType', $universe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('universe_edit', array('id' => $universe->getId()));
        }

        return $this->render('universe/edit.html.twig', array(
            'universe' => $universe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a universe entity.
     *
     * @Route("/{id}", name="universe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Universe $universe)
    {
        $form = $this->createDeleteForm($universe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($universe);
            $em->flush($universe);
        }

        return $this->redirectToRoute('universe_index');
    }

    /**
     * Creates a form to delete a universe entity.
     *
     * @param Universe $universe The universe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Universe $universe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('universe_delete', array('id' => $universe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
