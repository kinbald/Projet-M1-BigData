<?php

namespace AppBundle\Controller;

use Doctrine\Common\Util\Debug;
use function PHPSTORM_META\type;
use ProductBundle\Entity\PictureUniverse;
use ProductBundle\Entity\Universe;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('lastName', TextType::class)
            ->add('firstName', TextType::class)
            ->add('email', EmailType::class)
            ->add('topic', TextType::class)
            ->add('userType', ChoiceType::class, array(
                'choices' => array(
                    'customer' => 'customer',
                    'producer' => 'producer',
                    'press' => 'press',
                    'professional' => 'professional'
                )))
            ->add('gender', ChoiceType::class, array(
                'choices' => array(
                    'M' => 'm',
                    'F' => 'f'
                )
            ))
            ->add('message', TextareaType::class)
            ->add('submit', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if($request->getMethod() === 'POST'){
            if($form->isSubmitted()){
                $validator = $this->get('app.contact');
                $datas = $validator->validateForm($form);
                if ($form->isValid()){
                    $em = $this->getDoctrine()->getManager();
                    $rep = $em->getRepository('AppBundle:Parameters');
                    $mail = current($rep->findByName('mail'))->getValue();
                    $message = \Swift_Message::newInstance()
                        ->setSubject($datas['topic'])
                        ->setFrom($datas['email'])
                        ->setTo($mail)
                        ->setBody(
                            $this->renderView('mail/contact.html.twig', array(
                                'data' => $datas,
                                'sent_at' => new \DateTime()
                            )),
                            'text/html'
                        );
                    $this->get('mailer')->send($message);
                    $request->getSession()
                        ->getFlashBag()
                        ->add('success', 'Message sent');
                    return $this->redirectToRoute("homepage");
                }
            }
        }


        return $this->render('AppBundle:Contact:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }


}
