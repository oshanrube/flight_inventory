<?php
/**
 * Created by PhpStorm.
 * User: Oshan
 * Date: 7/11/2016
 * Time: 11:56 AM
 */

namespace Onic\FlightInventoryBundle\Validator\Constraints;

use Onic\FlightInventoryBundle\Entity\FiFlight;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\Common\Persistence\ObjectManager;

class uniqueFlightValidator extends ConstraintValidator
{

    private $entityManager;

    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function validate($value, Constraint $constraint)
    {

        /* @var $value FiFlight */
        //arrival cannot be before departure
        if ($value->getDeparture() > $value->getArrival())
        {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
        //same aircraft cannot be used during the time
        $aircrafts = $this->entityManager->getRepository('OnicFlightInventoryBundle:FiFlight')
            ->findBy(array(
                'idaircraft' => $value->getIdaircraft()
            ));
        foreach ($aircrafts as $aircraft/* @var $aircraft FiFlight */)
        {
            //this flight cannot conflict with other trips of the same flight, in reality there should be timegaps for maintainance, loading and uploading as well
            if (
                $value->getId() != $aircraft->getId() &&
                (
                    ($value->getDeparture() < $aircraft->getArrival() && $value->getDeparture() > $aircraft->getDeparture())
                    ||
                    ($value->getArrival() < $aircraft->getArrival() && $value->getArrival() > $aircraft->getDeparture())
                )
            )
            {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('%string%', $value)
                    ->addViolation();
            }
        }
    }
}