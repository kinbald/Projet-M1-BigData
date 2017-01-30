<?php

namespace AppBundle\Controller;

use ProductBundle\Entity\PictureUniverse;
use ProductBundle\Entity\Universe;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IdentityController extends Controller
{
    /**
     * @Route("/qui_sommes_nous", name="qui_sommes_nous")
     */
    public function indexAction(Request $request)
    {
        $pictureArray = array();
        $em = $this->getDoctrine()->getManager();
        $universes = $em->getRepository('ProductBundle:Universe')->findAll();
        foreach ($universes as $universe) {
            $pictures=$universe->getPictures();
            array_push($pictureArray, $pictures[0]);

        }


        return $this->render('AppBundle:Identity:identity.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
            'universes' => $universes,
            'product_pictures' => $pictureArray,
        ]);
    }


}
