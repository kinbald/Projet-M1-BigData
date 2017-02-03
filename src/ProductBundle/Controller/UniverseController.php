<?php

namespace ProductBundle\Controller;


use \ProductBundle\Entity\Universe;
use ProductBundle\Model\UniversModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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
     */
    public function newAction(Request $request)
    {
        $universe = new Universe();
        $form = $this->createForm('ProductBundle\Form\UniverseType', $universe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($universe);
            $em->flush($universe);

            return $this->redirectToRoute('universe_show', array('id' => $universe->getId()));
        }

        return $this->render('ProductBundle:universe:new.html.twig', array(
            'universe' => $universe,
            'form' => $form->createView(),
        ));
    }

    /**
     * //////////OLD \\\\\\\\\\\\Finds and displays all of a universe entity.
     *
     * @Route("/{id}/old", name="universe_show",
     *     requirements={
     *         "id": "\d+",
     *     })
     * @Method("GET")

    public function showAction(Universe $universe)
    {
        $pictureArray = array();
        $products = $universe->getProducts();
                    foreach ($products as $product) {
                        $pictures=$product->getPictures();
                        array_push($pictureArray, $pictures[0]);
                    }

        return $this->render('ProductBundle:universe:show.html.twig', array(
            'universe' => $universe,
            'products' => $products,
            'product_pictures' => $pictureArray,
        ));
    }*/





    /**
     * Finds and displays a universe entity with a query.
     *
     * @Route("/{id}", name="universe_show",
     *     requirements={
     *         "id": "\d+",
     *     })
     * @Method({"GET", "POST"})
     */
    public function showActionQuery(Request $request, Universe $universe)
    {
        $pictureArray = array();
        $products = $universe->getProducts();
        $formResult=null;
        $options=array(); //options du formulaire
        $searchForm = $this->createForm('ProductBundle\Form\SearchType', $options);
        $model = new UniversModel($this->getDoctrine()->getManager());


        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) { // si le formulaire est rempli et valide, alors on retourne les résultats de la recherche

            $formResult= $searchForm->getData(); //On récupère les données du formulaire puis on exécute la recherche et on renvoie les résultats dans products pour affichage

            if($formResult['name']!=null){
                $products = $model->findProductsByName($formResult['name']);
            }

            if($formResult['price_max']!=null) {
                $products = $model->findProductsByPrice($formResult['price_max']);
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
            'product_pictures' => $pictureArray,
            'query' => $formResult //pour le débug
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
     */
    public function editAction(Request $request, Universe $universe)
    {
        $deleteForm = $this->createDeleteForm($universe);
        $editForm = $this->createForm('ProductBundle\Form\UniverseType', $universe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('universe_edit', array('id' => $universe->getId()));
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
     */
    public function deleteAction(Request $request, Universe $universe)
    {
        $form = $this->createDeleteForm($universe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($universe);
            $em->flush($universe);
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
