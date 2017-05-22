<?php

namespace AppBundle\Controller;

use Doctrine\Common\Util\Debug;
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
                $em->flush();

                return $this->redirectToRoute('homepage', array('newsletter' => true));
            }
        }

        $em = $this->getDoctrine()->getManager();
        $universes = $em->getRepository('ProductBundle:Universe')->findAll();

        $rep = $em->getRepository('ProductBundle:Recipe');
        $query = $rep->createQueryBuilder('p')
            ->setMaxResults(3)
            ->getQuery();
        $recipes = $query->getResult();


        return $this->render('AppBundle:Default:index.html.twig', [
            'universes' => $universes,
            'newsletterForm' => $form->createView(),
            'recipes' => $recipes
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
                $em->flush();

                return $this->redirectToRoute('homepage', array('newsletter' => true));
            }
            else
                return $this->redirectToRoute('homepage', array('newsletter' => false));
        }

        return $this->render('AppBundle:Newsletter:newsletterForm.html.twig', array(
            'newsletterForm' => $form->createView()));
}


}
