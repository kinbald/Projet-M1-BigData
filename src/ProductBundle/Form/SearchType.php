<?php

namespace ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use ProductBundle\Form\ProductType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class SearchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $ranges = $options['data']['ranges'];
        $regions = $options['data']['regions'];
        $builder->add('name', TextType::class, array('required' => false));
        $builder->add('price_max', RangeType::class, array('required' => false, 'attr' => array('min' => 1, 'max' => 1000)));
        $builder->add('category', ChoiceType::class, ['choices' => $ranges,  'choice_label' => function($range, $key, $index) {
            return $range->getName();
        }]);
        $builder->add('region', ChoiceType::class, ['choices' => $regions,  'choice_label' => function($region, $key, $index) {
            return $region->getRegion();
        }]);













        //$builder->add('region', TextType::class, array('required' => false));
        //$builder->add('cepage', TextType::class, array('required' => false));
    }


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'productbundle_product';
    }

}
