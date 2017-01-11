<?php

namespace MediaBundle\Controller;

use MediaBundle\Entity\Files;
use MediaBundle\Model\MediaModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        /*$product = new Files();
        $product->setUrl('http://blablabla.bla');
        $product->setName('Blala?');
        $product->setDate(new \DateTime());

        $em = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();
        */
        $model = new MediaModel($this->getDoctrine()->getManager());
        return $this->render('MediaBundle:Default:index.html.twig', [
            'medias' => $model->getMediasByName('Blala?')
        ]);
    }
}
