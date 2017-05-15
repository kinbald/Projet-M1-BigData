<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProductBundle\Entity\Purchase;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\UserMedia;

class ProfileCommandController extends Controller
{
    /**
     * @Route("/profil", name="profil")
     * Show the user.
     */
    public function showAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $purchases = $user->getPurchases();

        return $this->render('UserBundle:Profile:show_content.html.twig', array(
            'user' => $user,
            'purchases' => $purchases
        ));
    }

    /**
     * @Route("/{id}/profil_products", name="profil_products")
     * Show the details of the User's purchases
     */
    public function showProductsAction(Purchase $purchase)
    {
        return $this->render('UserBundle:Profile:show_products.html.twig', array(
            'purchase' => $purchase
        ));
    }

    /**
     * @Route("/edit", name="edit_profile")
     * Edit Profile
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        $editForm = $this->createForm('UserBundle\Form\Type\User'. ucfirst($user->getDiscr()) .'EditType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profil');
        }

        return $this->render('UserBundle:Profile:edit_content.html.twig', array(
            'form' => $editForm->createView(),
        ));

    }
}
