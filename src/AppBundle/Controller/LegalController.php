<?php

namespace AppBundle\Controller;

use ProductBundle\Entity\PictureUniverse;
use ProductBundle\Entity\Universe;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LegalController extends Controller
{
    /**
     * @Route("/mentions_legales", name="mentions_legales")
     */
    public function indexAction(Request $request)
    {
        return $this->render('AppBundle:Legal:legal.html.twig');
    }

}
