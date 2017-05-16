<?php

namespace UserBundle\Controller;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProductBundle\Entity\Purchase;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\UserMedia;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;

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

        $editPasswordForm = $this->createForm('UserBundle\Form\Type\ChangePasswordForm', $user);
        $editPasswordForm->handleRequest($request);

        $dispatcher = $this->get('event_dispatcher');

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profil');
        }
        elseif ($editPasswordForm->isSubmitted() && $editPasswordForm->isValid()) {
            /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($editPasswordForm, $request);
            $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                //here you set the url to go to after changing the password
                //for example i am redirecting back to the page  that triggered the change password process
                //$url = $this->generateUrl('showProfileAccount');
                //$response = new RedirectResponse($url);
                return $this->redirectToRoute('profil');
            }

            $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }


        return $this->render('UserBundle:Profile:edit_content.html.twig', array(
            'form' => $editForm->createView(),
            'formPW' => $editPasswordForm->createView(),
        ));

    }
}

