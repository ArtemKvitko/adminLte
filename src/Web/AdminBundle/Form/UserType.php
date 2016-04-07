<?php

namespace Web\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username','text',array(
                'attr'=>array(
                    'class'=> 'form-control'
                )
            ))
            ->add('email','text',array(
                'attr'=>array(
                    'class'=> 'form-control'
                )
            ))
            ->add('name','text',array(
                'attr'=>array(
                    'class'=> 'form-control'
                )
            ))
            ->add('surname','text',array(
                'attr'=>array(
                    'class'=> 'form-control'
                )
            ))
            ->add('isActive','text',array(
                'attr'=>array(
                    'class'=> 'form-control'
                )
            ))
            ->add('role', 'choice', array(
                    'choices' => array(
                        'User' => 'ROLE_USER',
                        'Admin' => 'ROLE_ADMIN',
                        'Operator' => 'ROLE_OPERATOR',
                        'ROOT' => 'ROLE_ROOT',
                        'Team' => 'ROLE_TEAM'
                    ),
                    'choices_as_values' => true,
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Web\SecurityBundle\Entity\User'
        ));
    }
}
