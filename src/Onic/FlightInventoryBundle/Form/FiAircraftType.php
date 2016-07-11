<?php

namespace Onic\FlightInventoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FiAircraftType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('flightNumber')
            ->add('seatsCount')
            ->add('idairline', null, array('label' => 'Airline'))
            ->add('save', SubmitType::class, array(
                'attr' => array('back-url' => 'aircraft_index', 'class' => 'btn btn-primary'),
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Onic\FlightInventoryBundle\Entity\FiAircraft'
        ));
    }
}
