<?php

namespace AdminBundle\Controller;

use AdminBundle\Model\AdminModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig');
    }

    /**
     * @Route("/validationPresse")
     */
    public function validationPresseAction()
    {
        return $this->render('AdminBundle:Default:validationPresse.html.twig');
    }


    /**
     * @Route("/importationPresse")
     */
    public function importationPresseAction()
    {
        return $this->render('AdminBundle:Default:importationPresse.html.twig');
    }

    /**
     * @Route("/importationDb")
     */
    public function importationDbAction()
    {
        return $this->render('AdminBundle:Default:importationDb.html.twig');
    }

}
