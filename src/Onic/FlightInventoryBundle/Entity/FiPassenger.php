<?php

namespace Onic\FlightInventoryBundle\Entity;

/**
 * FiPassenger
 */
class FiPassenger
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $passportNumber;

    /**
     * @var \DateTime
     */
    private $dob;

    public function __toString()
    {
        return sprintf("%s %s", $this->getFirstname(), $this->getLastname());
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
     * Set firstname
     * @param string $firstname
     * @return FiPassenger
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     * @param string $lastname
     * @return FiPassenger
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set passportNumber
     * @param string $passportNumber
     * @return FiPassenger
     */
    public function setPassportNumber($passportNumber)
    {
        $this->passportNumber = $passportNumber;

        return $this;
    }

    /**
     * Get passportNumber
     * @return string
     */
    public function getPassportNumber()
    {
        return $this->passportNumber;
    }

    /**
     * Set dob
     * @param \DateTime $dob
     * @return FiPassenger
     */
    public function setDob($dob)
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Get dob
     * @return \DateTime
     */
    public function getDob()
    {
        return $this->dob;
    }
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $paymentMethod;


    /**
     * Set email
     *
     * @param string $email
     *
     * @return FiPassenger
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set paymentMethod
     *
     * @param string $paymentMethod
     *
     * @return FiPassenger
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * Get paymentMethod
     *
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }
}
