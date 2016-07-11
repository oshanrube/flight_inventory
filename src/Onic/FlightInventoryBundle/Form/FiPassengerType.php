<?php

namespace Onic\FlightInventoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class FiPassengerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('passportNumber')
            ->add('email', EmailType::class)
            ->add('paymentMethod', ChoiceType::class, array(
                'choices' => array(
                    'Credit Card' => 'credit_card',
                    'Cash'        => "cash",
                )))
            ->add('dob', DateType::class, array('widget' => 'single_text', 'html5' => false, 'attr' => array('class' => 'datepicker col-md-6')))
            ->add('save', SubmitType::class, array(
                'attr' => array('back-url' => 'flight_index', 'class' => 'btn btn-primary'),
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Onic\FlightInventoryBundle\Entity\FiPassenger'
        ));
    }
}
