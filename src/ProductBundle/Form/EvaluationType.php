<?php
/**
 * Created by PhpStorm.
 * User: cam2
 * Date: 31/03/17
 * Time: 17:35
 */

namespace ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class EvaluationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('mark', HiddenType::class)
            ->add('review', TextareaType::class, array('required' => true, 'label' => false, 'attr' => array('maxlength' => 255,
                'class' => 'field-long field-textarea', 'placeholder' => 'Votre commentaire')))
            ->add('submit', SubmitType::class);
    }
}