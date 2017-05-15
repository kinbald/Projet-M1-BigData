<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExcelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('excel', TextType::class, array('required'=> true, 'label' => false, 'attr' => array('id'=>'chemin')))
            ->add('submit', SubmitType::class, array('attr' =>array('class'=>'btn btn-primary btn-circle')));

    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'excel_form';
    }


}
