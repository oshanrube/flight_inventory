<?php

namespace Onic\FlightInventoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Doctrine\Common\Persistence\ObjectManager;
use Onic\FlightInventoryBundle\Form\DataTransformer\FiLocationTransformer;

class FiFlightType extends AbstractType
{

    private $entityManager;

    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price', MoneyType::class)
            ->add('departure', DateTimeType::class, array('date_widget' => 'single_text', 'html5' => false, 'attr' => array('class' => 'has_datepicker col-md-6')))
            ->add('arrival', DateTimeType::class, array('date_widget' => 'single_text', 'html5' => false, 'attr' => array('class' => 'has_datepicker col-md-6')))
            ->add('idorigin', TextType::class, array('label' => 'Origin', 'attr' => array('class' => 'autocomplete', 'data-autocomplete-url' => 'location_autocomplete')))
            ->add('iddestination', TextType::class, array('label' => 'Destination', 'attr' => array('class' => 'autocomplete', 'data-autocomplete-url' => 'location_autocomplete')))
            ->add('idaircraft', null, array('label' => 'Flight'))
            ->add('save', SubmitType::class, array(
                'attr' => array('back-url' => 'flight_index', 'class' => 'btn btn-primary'),
            ));
        $builder->get('idorigin')
            ->addModelTransformer(new FiLocationTransformer($this->entityManager));

        $builder->get('iddestination')
            ->addModelTransformer(new FiLocationTransformer($this->entityManager));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Onic\FlightInventoryBundle\Entity\FiFlight'
        ));
    }
}
