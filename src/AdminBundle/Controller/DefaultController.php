<?php

namespace AdminBundle\Controller;

use AdminBundle\Model\AdminModel;
use Doctrine\Common\Util\Debug;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\BaseUser;
use UserBundle\Entity\UserMedia;
use UserBundle\Model\UserModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class DefaultController
 * @package AdminBundle\Controller
 * @Security("has_role('ROLE_ADMIN')")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="admin_index")
     */
    public function indexAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig');
    }

    /**
     * @Route("/validationPresse/{page}", name="validationPresse", requirements={"page": "\d+"})
     */
    public function validationPresseAction(Request $request, $page=0)
    {
        $em = $this->getDoctrine()->getManager();
        $userModel = new UserModel($em);

        $users = $userModel->getAllUserMedia(30, $page);

        $bform = $this->createFormBuilder();
        $name = array();
        foreach ($users as $user)
        {
            array_push($name, strtolower(str_replace(' ', '-', $user->getCompanyName())));
            $bform->add('media_' . $user->getId(), CheckboxType::class,
                array("label" => $user->getCompanyName(), 'required' => false, "attr" => ["checked" => ($user->isEnabled())]));
        }

        $bform->add('save', SubmitType::class, array('attr' => array('class' => 'save')));

        if('POST' === $request->getMethod())
        {
            $data = $request->request->all()['form'];

            foreach ($users as $user)
            {
                $enabled = false;
                foreach ($data as $key=>$value) {
                    if($key == 'media_' . $user->getId())
                        $enabled = true;
                }
                $user->setEnabled($enabled);
                $em->persist($user);
            }
            $em->flush();
            return $this->redirectToRoute('validationPresse');
        }


        return $this->render('AdminBundle:Default:validationPresse.html.twig', array(
            'form' => $bform->getForm()->createView(),
            'medias' => $users
        ));
    }

    /**
     * Deletes a productConditioning entity.
     *
     * @Route("/deletemedia/{id}", name="media_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, UserMedia $userMedia)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($userMedia);
        $em->flush();
        return $this->redirectToRoute('validationPresse');
    }

    /**
     * @Route("/validationProducer/{page}", name="validationProducer", requirements={"page": "\d+"})
     */
    public function validationProducer(Request $request, $page=0)
    {
        $em = $this->getDoctrine()->getManager();
        $userModel = new UserModel($em);

        $users = $userModel->getAllUserProducer(30, $page);

        $bform = $this->createFormBuilder();
        $name = array();
        foreach ($users as $user)
        {
            array_push($name, strtolower(str_replace(' ', '-', $user->getCompanyName())));
            $bform->add('producer_' . $user->getId(), CheckboxType::class,
                array("label" => $user->getCompanyName(), 'required' => false, "attr" => ["checked" => ($user->isEnabled())]));
        }

        $bform->add('save', SubmitType::class, array('attr' => array('class' => 'save')));

        if('POST' === $request->getMethod())
        {
            $data = $request->request->all()['form'];

            foreach ($users as $user)
            {
                $enabled = false;
                foreach ($data as $key=>$value) {
                    if($key == 'producer_' . $user->getId())
                        $enabled = true;
                }
                $user->setEnabled($enabled);
                $em->persist($user);
            }
            $em->flush();
            return $this->redirectToRoute('validationProducer');
        }


        return $this->render('AdminBundle:Default:validationProducer.html.twig', array(
            'form' => $bform->getForm()->createView(),
            'producers' => $users
        ));
    }


    /**
     * @Route("/importationPresse", name="importationPresse")
     */
    public function importationPresseAction()
    {
        return $this->render('AdminBundle:Default:importationPresse.html.twig');
    }


}
