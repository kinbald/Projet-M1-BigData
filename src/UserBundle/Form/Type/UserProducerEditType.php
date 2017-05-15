<?php

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use FOS\UserBundle\Form\Type\RegistrationFormType;


class UserProducerEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('siret', TextType::class)
            ->add('businessName', TextType::class)
            ->add('address', TextareaType::class)
            ->add('city', TextType::class)
            ->add('postalCode', TextType::class)
            ->add('country', CountryType::class)
            ->add('province', TextType::class, array('required' => false))
            ->add('state', TextType::class, array('required' => false))
            ->add('phone', TextType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\UserProducer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_userproducer';
    }


}
