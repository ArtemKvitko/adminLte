<?php

namespace Web\AmortizationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AmortizationType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('period', DateType::class, array('attr' => array('class' => 'form-control')))
                ->add('asetId', IntegerType::class, array('attr' => array('class' => 'form-control')))
                ->add('amortization', MoneyType::class, array('attr' => array('class' => 'form-control')))
                ->add('createTime', DateTimeType::class)
                ->add('updateTime', DateTimeType::class)
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Web\AmortizationBundle\Entity\Amortization'
        ));
    }

}
