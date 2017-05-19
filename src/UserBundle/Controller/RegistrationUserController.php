<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class RegistrationUserController extends Controller
{
    /**
     * @Route("/inscription", name="inscription_choix")
     */
    public function inscriptionChoix()
    {
        return $this->render('UserBundle:Registration:inscription.html.twig');
    }

    /**
     * @Route("/register", name="user_consumer_registration")
     */
    public function registerConsumerAction(Request $request)
    {
        if ($request == 'POST'){
            $captcha = $this->get('app.captcha.validator');
            if(!isset($_POST['g-recaptcha-response']) or !$captcha->validateCaptcha($_POST['g-recaptcha-response'])){
                return $this->redirectToRoute("user_consumer_registration");
            }
        }

        return $this->container
            ->get('pugx_multi_user.registration_manager')
            ->register('UserBundle\Entity\UserConsumer');
    }

    /**
     * @Route("/register-media", name="user_media_registration")
     */
    public function registerMediaAction(Request $request){
        if ($request == 'POST') {
            $captcha = $this->get('app.captcha.validator');
            if (!isset($_POST['g-recaptcha-response']) or !$captcha->validateCaptcha($_POST['g-recaptcha-response'])) {
                return $this->redirectToRoute("user_media_registration");
            }
        }
        return $this->container
            ->get('pugx_multi_user.registration_manager')
            ->register('UserBundle\Entity\UserMedia');
    }

    /**
     * @Route("/register-producer", name="user_producer_registration")
     */
    public function registerProducerAction(Request $request){
        if ($request == 'POST') {
            $captcha = $this->get('app.captcha.validator');
            if (!isset($_POST['g-recaptcha-response']) or !$captcha->validateCaptcha($_POST['g-recaptcha-response'])) {
                return $this->redirectToRoute("user_producer_registration");
            }
        }
        return $this->container
            ->get('pugx_multi_user.registration_manager')
            ->register('UserBundle\Entity\UserProducer');
    }

    /**
     * @Route("/register-wholesale", name="user_wholesale_registration")
     */
    public function registerWholesaleAction(){
        return $this->container
            ->get('pugx_multi_user.registration_manager')
            ->register('UserBundle\Entity\UserWholesale');
    }

}
