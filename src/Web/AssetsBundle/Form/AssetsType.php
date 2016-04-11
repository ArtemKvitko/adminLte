<?php

namespace Web\AssetsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AssetsType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title', TextType::class, array('label' => 'Asset name:',
                    'attr' => array('class' => 'form-control')
                ))
                ->add('category', EntityType::class, array('required' => true,
                    'placeholder' => "Choose category:",
                    'class' => 'WebAmortizationBundle:Categories', 'attr' => array(
                        'class' => 'form-control')
                ))
                ->add('inventaryNumber', TextType::class, array('label' => 'Inventary number:',
                    'attr' => array('class' => 'form-control')
                ))
                ->add('initialcost', TextType::class, array('label' => 'Initial cost:',
                    'attr' => array('class' => 'form-control')
                ))
                ->add('replacementcost', TextType::class, array('label' => 'Replacement cost:',
                    'attr' => array('class' => 'form-control')
                ))
                ->add('city', EntityType::class, array('required' => false,
                    'placeholder' => "Choose asset city:",
                    'class' => 'WebCitiesBundle:Cities', 'attr' => array(
                        'class' => 'form-control')
                ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Web\AssetsBundle\Entity\Assets'
        ));
    }

}
