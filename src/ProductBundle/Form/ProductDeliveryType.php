<?php

namespace ProductBundle\Form;

use Doctrine\Common\Util\Debug;
use ProductBundle\Entity\Purchase;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductDeliveryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $ids_products = array();
        foreach ($builder->getData()->getProducts() as $product){
            array_push($ids_products, $product->getConditioningType()->getId());
        }
        /*foreach ($builder->getData()->getProducts() as $product){
            Debug::dump($product->getConditioningType());
        }*/
//        Debug::dump($builder->getData()->getProducts());
        $builder->add('products', CollectionType::class, array(
            'entry_type' => ProductPurchaseType::class,
            'entry_options' => array(
                'ids_product' => $ids_products
            )
        ))
        ->add('Valider', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Purchase::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'productbundle_productdelivery';
    }


}
