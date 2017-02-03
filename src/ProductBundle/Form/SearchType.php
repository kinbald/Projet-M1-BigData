<?php

namespace ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use ProductBundle\Form\ProductType;

class SearchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('type');
        $builder->add('prix_max');
        $builder->add('region');
        $builder->add('cepage');
    }



    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'productbundle_product';
    }


}
