<?php

namespace Onic\FlightInventoryBundle\Entity;

use Doctrine\ORM\EntityRepository;

class FiFlightRepository extends EntityRepository
{
    public function findAllByFilters($filters)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT f FROM OnicFlightInventoryBundle:FiFlight f
                WHERE
                f.idorigin = :idorigin AND
                f.iddestination = :iddestination AND
                DATE(f.departure) = :departure ' .
                (isset($filters['arrival']) ? 'AND DATE(f.arrival) = :arrival ' : '') .
                'ORDER BY f.departure ASC'
            )
            ->setParameter(':idorigin', $filters['idorigin'])
            ->setParameter(':iddestination', $filters['iddestination'])
            ->setParameter(':departure', $filters['departure']->format("Y-m-d"));


        if (isset($filters['arrival']))
        {
            $query->setParameter(':arrival', $filters['arrival']->format("Y-m-d"));
        }
        $flights = $query->getResult();
        //check for seating
        foreach ($flights as $key => $flight/* @var $flight FiFlight */)
        {
            if ($flight->getAvailableSeats() < $filters['num_passengers'])
            {
                array_splice($flights, $key, 1);
            }
        }

        return $flights;
    }
}