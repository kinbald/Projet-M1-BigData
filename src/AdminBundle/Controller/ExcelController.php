<?php

namespace AdminBundle\Controller;

use ConcoursBundle\Entity\CompetitionProduct;
use ProductBundle\Entity\Continent;
use ProductBundle\Entity\Country;
use ProductBundle\Entity\Delivery;
use ProductBundle\Entity\Pack;
use ProductBundle\Entity\ProductConditioning;
use ProductBundle\Entity\Range;
use ProductBundle\Entity\Recipe;
use ProductBundle\Entity\Spirit;
use ProductBundle\Entity\Wine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use ProductBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\ProducerStatus;
use UserBundle\Entity\UserProducer;
use AdminBundle\Service\Excel;

/**
 *
 * @Route("/excel")
 */
class ExcelController extends Controller
{


    /**
     * Display excel imported file
     *
     * @Route("/", name="excel_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $excelForm = $this->createForm('AdminBundle\Form\ExcelType');
        $excelForm->handleRequest($request);

        if ($excelForm->isSubmitted() && $excelForm->isValid()) {
            $file = $excelForm->getData()['excel'];
            $params = $this->get('admin.excel')->insert($file);
            return $this->render('AdminBundle:Default:importDbTransact.html.twig', $params);
        }

        return $this->render('AdminBundle:Default:importationDb.html.twig', array(
            'excel_form' => $excelForm->createView(),
        ));



    }

}