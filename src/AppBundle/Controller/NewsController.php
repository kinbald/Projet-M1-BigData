<?php

namespace AppBundle\Controller;

use AppBundle\Entity\News;
use AppBundle\Model\NewsModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Newsletter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * News controller.
 *
 * @Route("/news")
 */
class NewsController extends Controller
{
    /**
     * Lists all news entities.
     *
     * @Route("/", name="news_index")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $news = $em->getRepository('AppBundle:News')->findAll();

        return $this->render('AppBundle:News:index.html.twig', array(
            'news' => $news,
        ));
    }

    /**
     * Creates a new news entity.
     *
     * @Route("/new", name="news_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $news = new News();
        $form = $this->createForm('AppBundle\Form\NewsType', $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush($news);

            return $this->redirectToRoute('news_show', array('id' => $news->getId()));
        }

        return $this->render('AppBundle:News:new.html.twig', array(
            'news' => $news,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a news entity.
     *
     * @Route("/{id}", name="news_show",
     * requirements={
     *         "id": "\d+",
     *     })
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction(News $news)
    {
        $deleteForm = $this->createDeleteForm($news);

        return $this->render('AppBundle:News:show.html.twig', array(
            'news' => $news,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing news entity.
     *
     * @Route("/{id}/edit", name="news_edit",
     * requirements={
     *         "id": "\d+",
     *     })
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, News $news)
    {
        $deleteForm = $this->createDeleteForm($news);
        $editForm = $this->createForm('AppBundle\Form\NewsType', $news);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('news_edit', array('id' => $news->getId()));
        }

        return $this->render('AppBundle:News:edit.html.twig', array(
            'news' => $news,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a news entity.
     *
     * @Route("/{id}/delete", name="news_delete",
     * requirements={
     *         "id": "\d+",
     *     })
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, News $news)
    {
        $form = $this->createDeleteForm($news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($news);
            $em->flush($news);
        }

        return $this->redirectToRoute('news_index');
    }

    /**
     * Creates a form to delete a news entity.
     *
     * @param News $news The news entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(News $news)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('news_delete', array('id' => $news->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @Route("/public", name="news_public")
     */
    public function publicNews()
    {
        $model = new NewsModel($this->getDoctrine()->getManager());
        return $this->render('AppBundle:News:public_news.html.twig', [
            'news' => $model-> getAllNews( 10, 0)
        ]);
    }

    /**
     * @Route("/newsRegistration", name="news_letter_registration")
     * @Method({"POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newsRegistrationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $newsLetter = new Newsletter();
        $newsLetter->setMail($request->get('email'));
        $em->persist($newsLetter);
        $em->flush();

        return $this->render('AppBundle:Newsletter:confirmation.html.twig');
    }
}
