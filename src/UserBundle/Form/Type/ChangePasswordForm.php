<?php
namespace UserBundle\Form\Type;

use \FOS\UserBundle\Form\Type\ChangePasswordFormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use UserBundle\Entity\BaseUser;
use UserBundle\Entity\UserConsumer;



class ChangePasswordForm extends ChangePasswordFormType
{
    public function __construct()
    {
        parent::__construct(BaseUser::class);
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
    }

    public function getName()
    {
        return 'me_user_change_password';
    }
}
