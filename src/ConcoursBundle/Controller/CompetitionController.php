<?php
/**
 * Created by PhpStorm.
 * User: pierre
 * Date: 13/01/17
 * Time: 20:16
 */
namespace ConcoursBundle\Controller;

use ConcoursBundle\Model\CompetitionModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CompetitionController extends Controller
{
    /**
     * @Route("/competitions", name="concours_index")
     */
    public function indexAction()
    {

        $d = new \DateTime();
        $model = new CompetitionModel($this->getDoctrine()->getManager());
        return $this->render('ConcoursBundle:Default:concours.html.twig', [
            'competitions' => $model-> getFutureCompetitions($d, 2, 0)
        ]);
    }
}
