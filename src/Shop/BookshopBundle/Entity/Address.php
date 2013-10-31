<?php

namespace Shop\BookshopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Shop\BookshopBundle\Entity\Repository\AddressRepository")
 * @ORM\Table(name="address")
 */
class Address 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     *
     * @ORM\Column(type="string") 
     */
    protected $addressDetail;
        
    /**
     *
     * @ORM\Column(type="string") 
     */
    protected $country;
    
    /**
     *
     * @ORM\Column(type="string") 
     */
    protected $firstname;
    
    /**
     *
     * @ORM\Column(type="string") 
     */
    protected $lastname;
    
    /**
     *
     * @ORM\Column(type="string") 
     */
    protected $email;
 
    /**
     * @var boolean
     * 
     */
    private $shipTo;
    
    public function getShipTo(){
        return $this->shipTo;
    }
    
    public function setShipTo($shipTo){
        $this->shipTo = $shipTo;
    }
    
    public function copyAddress($address)
    {
        $this->setAddressDetail($address->getAddressDetail());
        $this->setCountry($address->getCountry());
        $this->setFirstname($address->getFirstname());
        $this->setLastname($address->getLastname());
        $this->setEmail($address->getEmail());
    }
    
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
     * Set addressDetail
     *
     * @param string $addressDetail
     * @return Address
     */
    public function setAddressDetail($addressDetail)
    {
        $this->addressDetail = $addressDetail;
    
        return $this;
    }

    /**
     * Get addressDetail
     *
     * @return string 
     */
    public function getAddressDetail()
    {
        return $this->addressDetail;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Address
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
     * Set firstname
     *
     * @param string $firstname
     * @return Address
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Address
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Address
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
}