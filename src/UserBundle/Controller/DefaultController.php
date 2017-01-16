<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use UserBundle\Model\UserModel;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $model = new UserModel($this->getDoctrine()->getManager());
        return $this->render('UserBundle:Default:index.html.twig', [
            'userMedia' => $model->getAllUserMediaEnabled()
        ]);
    }
}
