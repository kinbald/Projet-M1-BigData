<?php

namespace ProductBundle\Controller;

use ProductBundle\Entity\Product;
use ProductBundle\Entity\Wine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Lists all product entities
 * @Route("/")
 */
class ProductController extends Controller
{

    /**
     * Lists all wine entities.
     *
     * @Route("/", name="product_index")
     * @Method("GET")
     */

    public function indexAction()
    {
        return $this->redirectToRoute('homepage');
    }

    /**
     * Lists all wine entities.
     *
     * @Route("/list/{type}", name="product_list")
     * @Method("GET")
     */

    public function listAction($type)
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('ProductBundle:'.ucfirst($type))->findAll();
        //\Doctrine\Common\Util\Debug::dump($product->getDiscr());
        return $this->render('ProductBundle:' . $type . ':index.html.twig', array(
            'products' => $products,
        ));
    }

    /**
     * Creates a new product entity.
     *
     * @Route("/new/{type}", name="product_new")
     * @Method({"GET", "POST"})
     */

    public function newAction(Request $request, $type, Product $product = null)
    {
        $form = $this->createForm('ProductBundle\Form\\' . ucfirst($type) .  'Type', $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            \Doctrine\Common\Util\Debug::dump($product->getUniverses());
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush($product);

            return $this->render('ProductBundle:' . $product->getDiscr() . ':empty.html.twig', array());
            //return $this->redirectToRoute('wine_show', array('id' => $product->getDiscr()->getId()));
        }

        return $this->render('ProductBundle:' . $type . ':new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing wine entity.
     *
     * @Route("/{id}/edit", name="product_edit")
     * @Method({"GET", "POST"})
     */

    public function editAction(Request $request, Product $product)
    {
        $deleteForm = $this->createDeleteForm($product, $product->getDiscr());
        $editForm = $this->createForm('ProductBundle\Form\\' . ucfirst($product->getDiscr()) .  'Type', $product);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_edit', array('id' => $product->getId()));
        }

        return $this->render('ProductBundle:' . $product->getDiscr() . ':edit.html.twig', array(
            $product->getDiscr() => $product,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a wine entity.
     *
     * @Route("/{id}/delete", name="product_delete")
     * @Method("DELETE")
     */

    public function deleteAction(Request $request, Product $product)
    {
        $form = $this->createDeleteForm($product, $product->getDiscr());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush($product);
        }

        return $this->redirectToRoute($product->getDiscr() . '_index');
    }

    /**
     * Creates a form to delete a Product entity.
     *
     * @param Product $product The product entity
     *
     * @return \Symfony\Component\Form\Form The form
     */


    protected function createDeleteForm(Product $product)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_delete', array('id' => $product->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    /**
     * Finds and displays a wine entity.
     *
     * @Route("/{id}", name="product_show")
     * @Method("GET")
     */

    public function showAction(Product $product)
    {
        $deleteForm = $this->createDeleteForm($product, $product->getDiscr());

        return $this->render('ProductBundle:' . $product->getDiscr() . ':show.html.twig', array(
            'product' => $product,
            'delete_form' => $deleteForm->createView(),
            'product_pictures' => $product->getPictures()
        ));
    }

}
