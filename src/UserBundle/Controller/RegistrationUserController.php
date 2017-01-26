<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
    public function registerConsumerAction()
    {
        return $this->container
            ->get('pugx_multi_user.registration_manager')
            ->register('UserBundle\Entity\UserConsumer');
    }

    /**
     * @Route("/register-media", name="user_media_registration")
     */
    public function registerMediaAction(){
        return $this->container
            ->get('pugx_multi_user.registration_manager')
            ->register('UserBundle\Entity\UserMedia');
    }

    /**
     * @Route("/register-producer", name="user_producer_registration")
     */
    public function registerProducerAction(){
        return $this->container
            ->get('pugx_multi_user.registration_manager')
            ->register('UserBundle\Entity\UserProducer');
    }

}
