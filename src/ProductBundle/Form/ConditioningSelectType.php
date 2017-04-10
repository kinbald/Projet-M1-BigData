<?php

namespace ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use ProductBundle\Form\ProductType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
class ConditioningSelectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if(isset($options['data']['values']) && count($options['data']['values']) > 0)
            $builder->add('conditioning', ChoiceType::class, array('choices' => $options['data']['values'], 'required' => true, 'label' => false, 'attr' => array('maxlength' => 255,
            'class' => 'champ conditioning rounded')));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'productbundle_conditioningselect';
    }

}
