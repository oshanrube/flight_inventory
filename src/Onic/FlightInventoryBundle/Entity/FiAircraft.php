<?php

namespace Onic\FlightInventoryBundle\Entity;

/**
 * FiAircraft
 */
class FiAircraft
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $flightNumber;

    /**
     * @var integer
     */
    private $seatsCount;

    /**
     * @var \Onic\FlightInventoryBundle\Entity\FiAirline
     */
    private $idairline;


    public function __toString()
    {
        return $this->getFlightNumber() . " (" . $this->getIdairline() . ")";
    }

    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set flightNumber
     * @param string $flightNumber
     * @return FiAircraft
     */
    public function setFlightNumber($flightNumber)
    {
        $this->flightNumber = $flightNumber;

        return $this;
    }

    /**
     * Get flightNumber
     * @return string
     */
    public function getFlightNumber()
    {
        return $this->flightNumber;
    }

    /**
     * Set seatsCount
     * @param integer $seatsCount
     * @return FiAircraft
     */
    public function setSeatsCount($seatsCount)
    {
        $this->seatsCount = $seatsCount;

        return $this;
    }

    /**
     * Get seatsCount
     * @return integer
     */
    public function getSeatsCount()
    {
        return $this->seatsCount;
    }

    /**
     * Set idairline
     * @param \Onic\FlightInventoryBundle\Entity\FiAirline $idairline
     * @return FiAircraft
     */
    public function setIdairline(\Onic\FlightInventoryBundle\Entity\FiAirline $idairline = null)
    {
        $this->idairline = $idairline;

        return $this;
    }

    /**
     * Get idairline
     * @return \Onic\FlightInventoryBundle\Entity\FiAirline
     */
    public function getIdairline()
    {
        return $this->idairline;
    }
}
