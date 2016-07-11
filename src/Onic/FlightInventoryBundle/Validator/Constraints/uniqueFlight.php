<?php
namespace Onic\FlightInventoryBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Created by PhpStorm.
 * User: Oshan
 * Date: 7/11/2016
 * Time: 11:54 AM
 */
class uniqueFlight extends Constraint
{
    public $message = 'The flight "%string%" must not overlap with other trips of this same airplane.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    public function validatedBy()
    {
        return get_class($this) . 'Validator';
    }
}