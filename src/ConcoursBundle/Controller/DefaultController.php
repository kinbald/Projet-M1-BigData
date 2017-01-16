<?php

namespace ConcoursBundle\Controller;

use ConcoursBundle\Model\CompetitionModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
<<<<<<< HEAD

=======
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
>>>>>>> d7b3ade6767db72f3dfd692c8acb3c41e3981c34
}
