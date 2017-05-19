<?php

namespace ProductBundle\Controller;

use ProductBundle\Entity\PictureUniverse;
use ProductBundle\Entity\Universe;
use ProductBundle\Model\UniversModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Universe controller.
 *
 * @Route("/universe")
 */
class UniverseController extends Controller
{
    /**
     * Lists all universe entities.
     *
     * @Route("/", name="universe_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $universes = $em->getRepository('ProductBundle:Universe')->findAll();

        return $this->render('ProductBundle:universe:index.html.twig', array(
            'universes' => $universes,
        ));
    }

    /**
     * Creates a new universe entity.
     *
     * @Route("/new", name="universe_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $universe = new Universe();
        $form = $this->createForm('ProductBundle\Form\UniverseType', $universe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($universe);
            $em->flush();

            $urlImg = $request->get('urlImg');
            $pictUniv = new PictureUniverse();
            $pictUniv->setUrl($urlImg);
            $pictUniv->setAlt($universe->getName());
            $pictUniv->setUniverse($universe);

            $em->persist($pictUniv);
            $em->flush();

            return $this->redirectToRoute('universe_show', array('id' => $universe->getId()));
        }

        return $this->render('ProductBundle:universe:new.html.twig', array(
            'universe' => $universe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a universe entity with a query.
     *
     * @Route("/{id}", name="universe_show",
     *     requirements={
     *         "id": "\d+",
     *     })
     * @Method({"GET", "POST"})
     */
    public function showAction(Request $request, Universe $universe)
    {
        $model = new UniversModel($this->getDoctrine()->getManager());
        $pictureArray = array();
        $temp = null;
        $products = $universe->getProducts();
        $formResult=null;
        $options=array('price_max' => $model->getMaxConditionningPrice(), 'array_color' => $model->getColors()); //options du formulaire
        $searchForm = $this->createForm('ProductBundle\Form\SearchType', $options);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted() && $searchForm->isValid()) { // si le formulaire est rempli et valide, alors on retourne les résultats de la recherche
            $formResult= $searchForm->getData(); //On récupère les données du formulaire puis on exécute la recherche et on renvoie les résultats dans products pour affichage
            if($formResult['name']!=null){
                $products = $model->findProductsByName($formResult['name']);
            }

            if($formResult['price_max']!=null && $formResult['name']==null && $formResult['color'] ==null) {
                $products = null;
                $products = array();
                $temps = $model->findProductConditionningByPrice($formResult['price_max']);
                foreach ($temps as $temp) {
                    array_push($products, $temp->getProduct());
                }
            }

            if($formResult['price_max']!=null && $formResult['name']==null && $formResult['color']!=null) {
                $products = null;
                $products = array();
                $temps = $model->findProductConditionningByColor($formResult['color']);
                foreach ($temps as $temp) {
                    array_push($products, $temp);
                }
            }


        }
        foreach ($products as $product) { // pour récupérer les photos des produits
            $pictures=$product->getPictures();
            array_push($pictureArray, $pictures[0]);
        }
        return $this->render('ProductBundle:universe:show.html.twig', array(
            'universe' => $universe,
            'search_form' => $searchForm->createView(),
            'products' => $products,
            'query' => $formResult, //pour le débug
            'prix_max' => $model->getColors()
        ));
    }




    /**
     * Displays a form to edit an existing universe entity.
     *
     * @Route("/{id}/edit", name="universe_edit",
     *     requirements={
     *         "id": "\d+",
     *     })
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Universe $universe)
    {
        $deleteForm = $this->createDeleteForm($universe);
        $editForm = $this->createForm('ProductBundle\Form\UniverseType', $universe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $urlImg = $request->get('urlImg');
            if ($urlImg) {
                $pictUniv = new PictureUniverse();
                $pictUniv->setUrl($urlImg);
                $pictUniv->setAlt($universe->getName());
                $pictUniv->setUniverse($universe);
                $em->persist($pictUniv);
            }

            $em->flush();

            return $this->redirectToRoute('universe_index');
        }

        return $this->render('ProductBundle:universe:edit.html.twig', array(
            'universe' => $universe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a universe entity.
     *
     * @Route("/{id}", name="universe_delete",
     *     requirements={
     *         "id": "\d+",
     *     })
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Universe $universe)
    {
        $form = $this->createDeleteForm($universe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if(!$universe->hasProducts()){
                $em = $this->getDoctrine()->getManager();
                $em->remove($universe);
                $em->flush($universe);
            }

        }

        return $this->redirectToRoute('universe_index');
    }

    /**
     * Creates a form to delete a universe entity.
     *
     * @param Universe $universe The universe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    protected function createDeleteForm(Universe $universe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('universe_delete', array('id' => $universe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
