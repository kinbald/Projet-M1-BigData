<?php

namespace ContractBundle\Controller;

use ContractBundle\Model\OptionModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $model = new OptionModel($this->getDoctrine()->getManager());
        return $this->render('ContractBundle:Default:index.html.twig', [
            'options' => $model->getOptionSubscriptionsBetweenTwoDates(new \DateTime('2016-05-13 03:38:05'),
                new \DateTime('2016-07-13 03:38:05'), 10)
        ]);
    }
}