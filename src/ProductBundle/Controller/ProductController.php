<?php

namespace ProductBundle\Controller;

use ProductBundle\Entity\Product;
use ProductBundle\Entity\Wine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


abstract class ProductController extends Controller
{


    public function indexAction($product_type)
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('ProductBundle:'.ucfirst($product_type))->findAll();
        //\Doctrine\Common\Util\Debug::dump($product_type);
        return $this->render('ProductBundle:' . $product_type . ':index.html.twig', array(
            'products' => $products,
        ));
    }



    public function newAction(Request $request, Product $product = null, $product_type = '')
    {
        $form = $this->createForm('ProductBundle\Form\\' . ucfirst($product_type) .  'Type', $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            \Doctrine\Common\Util\Debug::dump($product->getUniverses());
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush($product);

            return $this->render('ProductBundle:' . $product_type . ':empty.html.twig', array());
            //return $this->redirectToRoute('wine_show', array('id' => $product_type->getId()));
        }

        return $this->render('ProductBundle:' . $product_type . ':new.html.twig', array(
            'form' => $form->createView(),
        ));
    }



    public function editAction(Request $request, Product $product, $product_type = '')
    {
        $deleteForm = $this->createDeleteForm($product, $product_type);
        $editForm = $this->createForm('ProductBundle\Form\\' . ucfirst($product_type) .  'Type', $product);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute($product_type . '_edit', array('id' => $product->getId()));
        }

        return $this->render('ProductBundle:' . $product_type . ':edit.html.twig', array(
            $product_type => $product,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function deleteAction(Request $request, Product $product, $product_type = '')
    {
        $form = $this->createDeleteForm($product, $product_type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush($product);
        }

        return $this->redirectToRoute($product_type . '_index');
    }


    protected function createDeleteForm(Product $product, $product_type)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl($product_type.'_delete', array('id' => $product->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }



    public function showAction(Product $product, $product_type)
    {
        $deleteForm = $this->createDeleteForm($product, $product_type);

        return $this->render('ProductBundle:' . $product_type . ':show.html.twig', array(
            'product' => $product,
            'delete_form' => $deleteForm->createView(),
            'product_pictures' => $product->getPictures()
        ));
    }

}
