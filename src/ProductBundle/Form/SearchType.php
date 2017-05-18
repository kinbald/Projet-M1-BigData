<?php

namespace ProductBundle\Form;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use ProductBundle\Form\ProductType;

class SearchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('name', TextType::class, array('required' => false));
        $builder->add('price_max', RangeType::class, array('required' => false, 'attr' => array('id' => 'slider', 'min' => 1, 'max' => $options['data']['price_max'])));
        $builder->add('color', ChoiceType::class, [
        'choices' => $options['data']['array_color'],
            'required' => false
        ]);
    }


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'productbundle_product';
    }

}