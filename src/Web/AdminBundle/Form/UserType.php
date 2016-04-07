<?php

namespace Web\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class,array(
                'attr'=>array(
                    'class'=> 'form-control'
                )
            ))
            ->add('email',TextType::class,array(
                'attr'=>array(
                    'class'=> 'form-control'
                )
            ))
            ->add('password',TextType::class,array(
                'attr'=>array(
                    'class'=> 'form-control'
                )
            ))
            ->add('name',TextType::class,array(
                'attr'=>array(
                    'class'=> 'form-control'
                )
            ))
            ->add('surname',TextType::class,array(
                'attr'=>array(
                    'class'=> 'form-control'
                )
            ))
            ->add('isActive',CheckboxType::class
            )
            ->add('role', ChoiceType::class, array(
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
        
            ->add('avatar', FileType::class, array(
                'label' => 'Avatar (JPEG file)',
               'data_class' => null,
                'required' => false))
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
