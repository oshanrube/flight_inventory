<?php

namespace Onic\FlightInventoryBundle\Entity;

/**
 * FiFlight
 */
class FiFlight
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var float
     */
    private $price;

    /**
     * @var \DateTime
     */
    private $departure;

    /**
     * @var \DateTime
     */
    private $arrival;

    /**
     * @var \Onic\FlightInventoryBundle\Entity\FiAircraft
     */
    private $idaircraft;


    public function __toString()
    {
        return $this->getIdaircraft()->__toString();
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
     * Set price
     * @param float $price
     * @return FiFlight
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set departure
     * @param \DateTime $departure
     * @return FiFlight
     */
    public function setDeparture($departure)
    {
        $this->departure = $departure;

        return $this;
    }

    /**
     * Get departure
     * @return \DateTime
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * Set arrival
     * @param \DateTime $arrival
     * @return FiFlight
     */
    public function setArrival($arrival)
    {
        $this->arrival = $arrival;

        return $this;
    }

    /**
     * Get arrival
     * @return \DateTime
     */
    public function getArrival()
    {
        return $this->arrival;
    }

    /**
     * Set idaircraft
     * @param \Onic\FlightInventoryBundle\Entity\FiAircraft $idaircraft
     * @return FiFlight
     */
    public function setIdaircraft(\Onic\FlightInventoryBundle\Entity\FiAircraft $idaircraft = null)
    {
        $this->idaircraft = $idaircraft;

        return $this;
    }

    /**
     * Get idaircraft
     * @return \Onic\FlightInventoryBundle\Entity\FiAircraft
     */
    public function getIdaircraft()
    {
        return $this->idaircraft;
    }

    /**
     * @var \Onic\FlightInventoryBundle\Entity\FiLocation
     */
    private $iddestination;

    /**
     * @var \Onic\FlightInventoryBundle\Entity\FiLocation
     */
    private $idorigin;


    /**
     * Set iddestination
     * @param \Onic\FlightInventoryBundle\Entity\FiLocation $iddestination
     * @return FiFlight
     */
    public function setIddestination(\Onic\FlightInventoryBundle\Entity\FiLocation $iddestination = null)
    {
        $this->iddestination = $iddestination;

        return $this;
    }

    /**
     * Get iddestination
     * @return \Onic\FlightInventoryBundle\Entity\FiLocation
     */
    public function getIddestination()
    {
        return $this->iddestination;
    }

    /**
     * Set idorigin
     * @param \Onic\FlightInventoryBundle\Entity\FiLocation $idorigin
     * @return FiFlight
     */
    public function setIdorigin(\Onic\FlightInventoryBundle\Entity\FiLocation $idorigin = null)
    {
        $this->idorigin = $idorigin;

        return $this;
    }

    /**
     * Get idorigin
     * @return \Onic\FlightInventoryBundle\Entity\FiLocation
     */
    public function getIdorigin()
    {
        return $this->idorigin;
    }

    public function getAvailableSeats()
    {
        $seats = $this->getIdaircraft()->getSeatsCount();
        //get bookings
        //remove the seating
        $seats -= $this->getBookings()->count();
        return $seats;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $Bookings;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Bookings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add booking
     * @param \Onic\FlightInventoryBundle\Entity\FiBooking $booking
     * @return FiFlight
     */
    public function addBooking(\Onic\FlightInventoryBundle\Entity\FiBooking $booking)
    {
        $this->Bookings[] = $booking;

        return $this;
    }

    /**
     * Remove booking
     * @param \Onic\FlightInventoryBundle\Entity\FiBooking $booking
     */
    public function removeBooking(\Onic\FlightInventoryBundle\Entity\FiBooking $booking)
    {
        $this->Bookings->removeElement($booking);
    }

    /**
     * Get bookings
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBookings()
    {
        return $this->Bookings;
    }

    /**
     * Get duration
     * @return string
     */
    public function getDuration()
    {
        $diff = $this->getDeparture()->diff($this->getArrival());
        return sprintf('%d days, %d hours, %d minutes', $diff->d, $diff->h, $diff->i);
    }
}
