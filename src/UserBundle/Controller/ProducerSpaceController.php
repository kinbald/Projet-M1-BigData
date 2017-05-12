<?php
/**
 * Created by PhpStorm.
 * User: pierre
 * Date: 13/01/17
 * Time: 20:16
 */

namespace UserBundle\Controller;

use ConcoursBundle\Model\CompetitionModel;
use ProductBundle\Entity\Product;
use ProductBundle\Entity\ProductConditioning;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use UserBundle\Entity\UserProducer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\HttpFoundation\Request;


/**
 * @Security("has_role('ROLE_PRODUCER')")
 */
class ProducerSpaceController extends Controller
{
    /**
     * @Route("/producer_space", name="producer_space")
     */
    public function indexAction(Request $request)
    {
        return $this->render('UserBundle:producer:producer_space.html.twig', [
            'products' => $this->getUser()->getProducts()
        ]);
    }

    /**
     * @Route("/producer_space/{id}", name="producer_space_conditioning",
     * requirements={
     *      "id": "\d+",
     * })
     */
    public function conditioningAction(Request $request, Product $product)
    {
        return $this->render('UserBundle:producer:producer_space_conditioning.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @Route("/producer_space/edit/{id}", name="producer_space_conditioning_edit",
     * requirements={
     *      "id": "\d+",
     * })
     */
    public function conditioningEditAction(Request $request, ProductConditioning $productConditioning)
    {
        $form = $this->createForm('ProductBundle\Form\ProductConditioningType', $productConditioning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($productConditioning);
            $em->flush();

            return $this->redirectToRoute('producer_space');
        }
        return $this->render('UserBundle:producer:producer_space_conditioning_edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
