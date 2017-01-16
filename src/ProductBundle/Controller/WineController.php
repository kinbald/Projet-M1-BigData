<?php

namespace ProductBundle\Controller;

use ProductBundle\Entity\Wine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Wine controller.
 *
 * @Route("/wine")
 */
class WineController extends Controller
{
    /**
     * Lists all wine entities.
     *
     * @Route("/", name="wine_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $wines = $em->getRepository('ProductBundle:Wine')->findAll();
        //\Doctrine\Common\Util\Debug::dump($wines);
        return $this->render('ProductBundle:wine:index.html.twig', array(
            'wines' => $wines,
        ));
    }

    /**
     * Creates a new wine entity.
     *
     * @Route("/new", name="wine_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $wine = new Wine();
        $form = $this->createForm('ProductBundle\Form\WineType', $wine);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            \Doctrine\Common\Util\Debug::dump($wine->getUniverses());
            $em = $this->getDoctrine()->getManager();
            $em->persist($wine);
            $em->flush($wine);

            return $this->render('ProductBundle:wine:empty.html.twig', array());
            //return $this->redirectToRoute('wine_show', array('id' => $wine->getId()));
        }

        return $this->render('ProductBundle:wine:new.html.twig', array(
            'wine' => $wine,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a wine entity.
     *
     * @Route("/{id}", name="wine_show")
     * @Method("GET")
     */
    public function showAction(Wine $wine)
    {
        $deleteForm = $this->createDeleteForm($wine);

        return $this->render('ProductBundle:wine:show.html.twig', array(
            'wine' => $wine,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing wine entity.
     *
     * @Route("/{id}/edit", name="wine_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Wine $wine)
    {
        $deleteForm = $this->createDeleteForm($wine);
        $editForm = $this->createForm('ProductBundle\Form\WineType', $wine);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('wine_edit', array('id' => $wine->getId()));
        }

        return $this->render('ProductBundle:wine:edit.html.twig', array(
            'wine' => $wine,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a wine entity.
     *
     * @Route("/{id}", name="wine_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Wine $wine)
    {
        $form = $this->createDeleteForm($wine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($wine);
            $em->flush($wine);
        }

        return $this->redirectToRoute('wine_index');
    }

    /**
     * Creates a form to delete a wine entity.
     *
     * @param Wine $wine The wine entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Wine $wine)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('wine_delete', array('id' => $wine->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
