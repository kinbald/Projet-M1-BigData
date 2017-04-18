<?php

namespace ProductBundle\Form;

use Doctrine\Common\Util\Debug;
use Doctrine\ORM\EntityRepository;
use ProductBundle\Entity\Delivery;
use ProductBundle\Entity\ProductConditioning;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductPurchaseType extends AbstractType
{
    private static $count = 0;

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        Debug::dump($options['ids_product'][self::$count]);
        $builder->add('delivery', EntityType::class, array(
            'class' => Delivery::class,
            'query_builder' => function (EntityRepository $er) use ($options){
                return $er->createQueryBuilder('d')
                    ->join('d.conditioningTypes', 'c', 'WITH', 'c.id=:id')
                    ->setParameter('id', $options['ids_product'][self::$count++]);
            },
            'choice_label' => 'name'
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProductBundle\Entity\ProductPurchase',
            'ids_product' => ''
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'productbundle_productpurchase';
    }


}
