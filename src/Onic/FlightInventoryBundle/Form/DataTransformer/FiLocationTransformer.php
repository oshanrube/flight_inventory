<?php
namespace Onic\FlightInventoryBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Exception\TransformationFailedException;

class FiLocationTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function transform($filocation)
    {
        if (null === $filocation)
        {
            return '';
        }

        return $filocation->getName();
    }

    public function reverseTransform($idlocation)
    {
        if (!$idlocation)
        {
            return;
        }

        $filocation = $this->entityManager
            ->getRepository('OnicFlightInventoryBundle:FiLocation')->findOneBy(array('id' => $idlocation));

        if (null === $filocation)
        {
            throw new TransformationFailedException(sprintf('There is no "%s" exists',
                $idlocation
            ));
        }

        return $filocation;
    }
}