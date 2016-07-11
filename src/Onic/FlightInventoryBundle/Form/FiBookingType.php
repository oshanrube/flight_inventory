<?php

namespace Onic\FlightInventoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class FiBookingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idflight', null, array('label' => 'Flight'))
            ->add('idpassenger', null, array('label' => 'Passenger'))
            ->add('save', SubmitType::class, array(
                'attr' => array('back-url' => 'onic_flight_inventory_homepage', 'class' => 'btn btn-primary'),
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Onic\FlightInventoryBundle\Entity\FiBooking'
        ));
    }
}
