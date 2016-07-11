<?php
/**
 * Created by PhpStorm.
 * User: Oshan
 * Date: 7/11/2016
 * Time: 12:47 PM
 */
namespace Onic\FlightInventoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Tests\Extension\Core\Type\NumberTypeTest;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\Common\Persistence\ObjectManager;
use Onic\FlightInventoryBundle\Form\DataTransformer\FiLocationTransformer;

class FiFlightFilterType extends AbstractType
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
            ->add('idorigin', TextType::class, array('required' => true, 'label' => 'Origin', 'attr' => array('class' => 'autocomplete', 'data-autocomplete-url' => 'location_autocomplete')))
            ->add('iddestination', TextType::class, array('required' => true, 'label' => 'Destination', 'attr' => array('class' => 'autocomplete', 'data-autocomplete-url' => 'location_autocomplete')))
            ->add('departure', DateType::class, array('required' => true, 'widget' => 'single_text', 'html5' => false, 'attr' => array('class' => 'datepicker col-md-6')))
            ->add('arrival', DateType::class, array('required' => false, 'widget' => 'single_text', 'html5' => false, 'attr' => array('class' => 'datepicker col-md-6')))
            ->add('num_passengers', IntegerType::class, array('required' => true))
            ->add('filter', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-primary'),
            ));
        $builder->get('idorigin')
            ->addModelTransformer(new FiLocationTransformer($this->entityManager));

        $builder->get('iddestination')
            ->addModelTransformer(new FiLocationTransformer($this->entityManager));
    }
}
