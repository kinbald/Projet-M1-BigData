<?php

namespace ConcoursBundle\Controller;

use ConcoursBundle\Model\CompetitionModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/competitions")
     */
    public function indexAction()
    {
        $model = new CompetitionModel($this->getDoctrine()->getManager());
        return $this->render('ConcoursBundle:Default:concours.html.twig', [
            'competitions' => $model->getAllCompetitions()
        ]);
    }
}
