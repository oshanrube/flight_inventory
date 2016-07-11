<?php

namespace Onic\FlightInventoryBundle\Entity;

/**
 * FiBooking
 */
class FiBooking
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Onic\FlightInventoryBundle\Entity\FiFlight
     */
    private $idflight;

    /**
     * @var \Onic\FlightInventoryBundle\Entity\FiPassenger
     */
    private $idpassenger;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idflight
     *
     * @param \Onic\FlightInventoryBundle\Entity\FiFlight $idflight
     *
     * @return FiBooking
     */
    public function setIdflight(\Onic\FlightInventoryBundle\Entity\FiFlight $idflight = null)
    {
        $this->idflight = $idflight;

        return $this;
    }

    /**
     * Get idflight
     *
     * @return \Onic\FlightInventoryBundle\Entity\FiFlight
     */
    public function getIdflight()
    {
        return $this->idflight;
    }

    /**
     * Set idpassenger
     *
     * @param \Onic\FlightInventoryBundle\Entity\FiPassenger $idpassenger
     *
     * @return FiBooking
     */
    public function setIdpassenger(\Onic\FlightInventoryBundle\Entity\FiPassenger $idpassenger = null)
    {
        $this->idpassenger = $idpassenger;

        return $this;
    }

    /**
     * Get idpassenger
     *
     * @return \Onic\FlightInventoryBundle\Entity\FiPassenger
     */
    public function getIdpassenger()
    {
        return $this->idpassenger;
    }
}
