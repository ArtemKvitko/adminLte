<?php

namespace Web\CitiesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CitiesType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', TextType::class, array('label' => 'City name',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ))
                ->add('postalcode', TextType::class, array('attr' => array(
                        'class' => 'form-control'
                    )
                ))
                ->add('country', TextType::class, array('attr' => array(
                        'class' => 'form-control'
                    )
                ))
                ->add('user_id', EntityType::class, array('required'=>false,'placeholder' => "Choose administrative user", 'class' => 'WebSecurityBundle:User', 'attr' => array(
                        'class' => 'form-control'
                    )
                ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Web\CitiesBundle\Entity\Cities'
        ));
    }

}
