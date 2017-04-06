<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProductBundle\Entity\Purchase;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

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
        $products = array();
        $purchaseProduct = $purchase->getProducts();
        foreach ($purchaseProduct as $product) {
            array_push($products, $product->getProduct());
        }

        return $this->render('UserBundle:Profile:show_products.html.twig', array(
            'products' => $products,
            'purchase' => $purchase,
            'purchaseProduct' => $purchaseProduct
        ));
    }
}
