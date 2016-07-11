<?php

namespace Onic\FlightInventoryBundle\Entity;

/**
 * FiLocation
 */
class FiLocation
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
     * @return FiLocation
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
    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $iata;

    /**
     * @var string
     */
    private $icao;


    /**
     * Set city
     *
     * @param string $city
     *
     * @return FiLocation
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return FiLocation
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set iata
     *
     * @param string $iata
     *
     * @return FiLocation
     */
    public function setIata($iata)
    {
        $this->iata = $iata;

        return $this;
    }

    /**
     * Get iata
     *
     * @return string
     */
    public function getIata()
    {
        return $this->iata;
    }

    /**
     * Set icao
     *
     * @param string $icao
     *
     * @return FiLocation
     */
    public function setIcao($icao)
    {
        $this->icao = $icao;

        return $this;
    }

    /**
     * Get icao
     *
     * @return string
     */
    public function getIcao()
    {
        return $this->icao;
    }
}
