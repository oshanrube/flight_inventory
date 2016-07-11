<?php

namespace Onic\FlightInventoryBundle\Entity;

/**
 * FiAirline
 */
class FiAirline
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;


    public function __toString()
    {
        return $this->getName();
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
     * Set name
     * @param string $name
     * @return FiAirline
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
