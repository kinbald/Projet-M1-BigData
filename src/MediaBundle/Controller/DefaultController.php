<?php

namespace MediaBundle\Controller;

use MediaBundle\Entity\Files;
use MediaBundle\Model\MediaModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="media_index")
     */
    public function indexAction()
    {
        $model = new MediaModel($this->getDoctrine()->getManager());
        return $this->render('MediaBundle:Default:media.html.twig', [
            'medias' => $model->getAllMedias(20, 0)
        ]);
    }
}
