<?php

namespace AppBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use ProductBundle\Entity\PictureUniverse;
use ProductBundle\Entity\Universe;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Newsletter;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $newsletter = new Newsletter();
        $form = $this->createFormBuilder($newsletter)
            ->add('mail', TextType::class, array(
                'label' => false,
                'required' => true
            ))->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            if($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($newsletter);
                $em->flush($newsletter);

                return $this->redirectToRoute('homepage', array('newsletter' => true));
            }
            else
                return $this->redirectToRoute('homepage', array('newsletter' => false));
        }

        $pictureArray = array();
        $em = $this->getDoctrine()->getManager();
        $universes = $em->getRepository('ProductBundle:Universe')->findAll();
        foreach ($universes as $universe) {
            $pictures=$universe->getPictures();
            array_push($pictureArray, $pictures[0]);

        }


        return $this->render('AppBundle:Default:index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
            'universes' => $universes,
            'product_pictures' => $pictureArray,
            'newsletterForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/newsletter-add", name="inscription_newsletter")
     */
    public function newsletterFormAction(Request $request)
    {
        $newsletter = new Newsletter();
        $form = $this->createFormBuilder($newsletter)
            ->setAction($this->generateUrl('inscription_newsletter'))
            ->add('mail', TextType::class, array(
                'label' => false,
                'required' => true
            ))->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            if($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($newsletter);
                $em->flush($newsletter);

                return $this->redirectToRoute('homepage', array('newsletter' => true));
            }
            else
                return $this->redirectToRoute('homepage', array('newsletter' => false));
        }

        return $this->render('AppBundle:Newsletter:newsletterForm.html.twig', array(
            'newsletterForm' => $form->createView()));
}


}
