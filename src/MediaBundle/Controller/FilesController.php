<?php

namespace MediaBundle\Controller;

use MediaBundle\Entity\Files;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Jérémy Tablet
 * File controller.
 *
 * @Route("files")
 */
class FilesController extends Controller
{
    /**
     * Lists all file entities.
     *
     * @Route("/", name="files_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $files = $em->getRepository('MediaBundle:Files')->findAll();

        return $this->render('MediaBundle:Files:index.html.twig', array(
            'files' => $files,
        ));
    }

    /**
     * Creates a new file entity.
     *
     * @Route("/new", name="files_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $file = new Files();
        $form = $this->createForm('MediaBundle\Form\FilesType', $file);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $urlFile = $request->get('urlFile');
            $file->setUrl($urlFile);
            $file->setDate(date_create(date("Y-m-d H:i:s")));
            $em->persist($file);
            $em->flush($file);

            return $this->redirectToRoute('files_index');
        }

        return $this->render('MediaBundle:Files:new.html.twig', array(
            'file' => $file,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a file entity.
     *
     * @Route("/{id}", name="files_show")
     * @Method("GET")
     */
    public function showAction(Files $file)
    {
        $deleteForm = $this->createDeleteForm($file);

        return $this->render('MediaBundle:Files:show.html.twig', array(
            'file' => $file,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing file entity.
     *
     * @Route("/{id}/edit", name="files_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Files $file)
    {
        $deleteForm = $this->createDeleteForm($file);
        $editForm = $this->createForm('MediaBundle\Form\FilesType', $file);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $urlFile = $request->get('urlFile');
            if ($urlFile != '') {
                $file->setDate(date_create(date("Y-m-d H:i:s")));
                $file->setUrl($urlFile);
            }
            $em->flush();

            return $this->redirectToRoute('files_edit', array('id' => $file->getId()));
        }

        return $this->render('MediaBundle:Files:edit.html.twig', array(
            'file' => $file,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a file entity.
     *
     * @Route("/{id}", name="files_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Files $file)
    {
        $form = $this->createDeleteForm($file);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($file);
            $em->flush($file);
        }

        return $this->redirectToRoute('files_index');
    }

    /**
     * Creates a form to delete a file entity.
     *
     * @param Files $file The file entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Files $file)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('files_delete', array('id' => $file->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
