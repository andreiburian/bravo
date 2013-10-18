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
     * @ORM\OneToOne(targetEntity="Order", mappedBy="billing_address")
     * 
     */
    protected $orderBilling;
    
    /**
     * @ORM\OneToOne(targetEntity="Order", mappedBy="shipping_address")
     * 
     */
    protected $orderShipping;
    
    /**
     * @ORM\OneToOne(targetEntity="User", mappedBy="billingAddress")
     * 
     */
    protected $userForBilling;
    
    /**
     * @ORM\OneToOne(targetEntity="User", mappedBy="shippingAddress")
     * 
     */
    protected $userForShipping;
    
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

    /**
     * Set orderBilling
     *
     * @param \Shop\BookshopBundle\Entity\Order $orderBilling
     * @return Address
     */
    public function setOrderBilling(\Shop\BookshopBundle\Entity\Order $orderBilling = null)
    {
        $this->orderBilling = $orderBilling;
    
        return $this;
    }

    /**
     * Get orderBilling
     *
     * @return \Shop\BookshopBundle\Entity\Order 
     */
    public function getOrderBilling()
    {
        return $this->orderBilling;
    }

    /**
     * Set orderShipping
     *
     * @param \Shop\BookshopBundle\Entity\Order $orderShipping
     * @return Address
     */
    public function setOrderShipping(\Shop\BookshopBundle\Entity\Order $orderShipping = null)
    {
        $this->orderShipping = $orderShipping;
    
        return $this;
    }

    /**
     * Get orderShipping
     *
     * @return \Shop\BookshopBundle\Entity\Order 
     */
    public function getOrderShipping()
    {
        return $this->orderShipping;
    }

    /**
     * Set userForBilling
     *
     * @param \Shop\BookshopBundle\Entity\Address $userForBilling
     * @return Address
     */
    public function setUserForBilling(\Shop\BookshopBundle\Entity\Address $userForBilling = null)
    {
        $this->userForBilling = $userForBilling;
    
        return $this;
    }

    /**
     * Get userForBilling
     *
     * @return \Shop\BookshopBundle\Entity\Address 
     */
    public function getUserForBilling()
    {
        return $this->userForBilling;
    }

    /**
     * Set userForShipping
     *
     * @param \Shop\BookshopBundle\Entity\Address $userForShipping
     * @return Address
     */
    public function setUserForShipping(\Shop\BookshopBundle\Entity\Address $userForShipping = null)
    {
        $this->userForShipping = $userForShipping;
    
        return $this;
    }

    /**
     * Get userForShipping
     *
     * @return \Shop\BookshopBundle\Entity\Address 
     */
    public function getUserForShipping()
    {
        return $this->userForShipping;
    }
}