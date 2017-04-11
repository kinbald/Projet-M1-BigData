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
        $conditioningList = array();
        foreach ($options['data']['values'] as $conditioning)
            if($conditioning->getStock() > 0)
                $conditioningList[$conditioning->getName()] = $conditioning->getId();

        if(count($conditioningList) > 0)
            $builder->add('conditioning', ChoiceType::class, array('choices' => $conditioningList,
                'required' => true, 'label' => false, 'attr' => array('maxlength' => 255, 'class' => 'champ conditioning rounded')));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'productbundle_conditioningselect';
    }

}
