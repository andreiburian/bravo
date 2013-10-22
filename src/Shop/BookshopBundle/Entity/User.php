<?php

namespace Shop\BookshopBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Shop\BookshopBundle\Entity\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
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
    protected $firstname;

    /**
     *
     * @ORM\Column(type="string")
     */
    protected $lastname;

    /**
     *
     * @ORM\Column(type="integer", length=9)
     */
    protected $phone;

    /**
     *
     * @ORM\Column(type="integer", length=1)
     */
    protected $gender;

    /**
     * @ORM\OneToMany(targetEntity="Cart", mappedBy="user")
     */
    protected $cart;
    
    /**
     * @ORM\OneToMany(targetEntity="OrderModel", mappedBy="user")
     */
    protected $order;
    
    /**
     * @ORM\OneToOne(targetEntity="Address")
     * @ORM\JoinColumn(name="billing_address_id", referencedColumnName="id")
     */
    protected $billingAddress;
    
    /**
     * @ORM\OneToOne(targetEntity="Address")
     * @ORM\JoinColumn(name="shipping_address_id", referencedColumnName="id")
     */
    protected $shippingAddress;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
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
     * Set firstname
     *
     * @param string $firstname
     * @return User
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
     * @return User
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
     * Set phone
     *
     * @param integer $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return integer 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set gender
     *
     * @param integer $gender
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    
        return $this;
    }

    /**
     * Get gender
     *
     * @return integer 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Add cart
     *
     * @param \Shop\BookshopBundle\Entity\Cart $cart
     * @return User
     */
    public function addCart(\Shop\BookshopBundle\Entity\Cart $cart)
    {
        $this->cart[] = $cart;
    
        return $this;
    }

    /**
     * Remove cart
     *
     * @param \Shop\BookshopBundle\Entity\Cart $cart
     */
    public function removeCart(\Shop\BookshopBundle\Entity\Cart $cart)
    {
        $this->cart->removeElement($cart);
    }

    /**
     * Get cart
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Add order
     *
     * @param \Shop\BookshopBundle\Entity\OrderModel $order
     * @return User
     */
    public function addOrder(\Shop\BookshopBundle\Entity\OrderModel $order)
    {
        $this->order[] = $order;
    
        return $this;
    }

    /**
     * Remove order
     *
     * @param \Shop\BookshopBundle\Entity\OrderModel $order
     */
    public function removeOrder(\Shop\BookshopBundle\Entity\OrderModel $order)
    {
        $this->order->removeElement($order);
    }

    /**
     * Get order
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set billingAddress
     *
     * @param \Shop\BookshopBundle\Entity\Address $billingAddress
     * @return User
     */
    public function setBillingAddress(\Shop\BookshopBundle\Entity\Address $billingAddress = null)
    {
        $this->billingAddress = $billingAddress;
    
        return $this;
    }

    /**
     * Get billingAddress
     *
     * @return \Shop\BookshopBundle\Entity\Address 
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * Set shippingAddress
     *
     * @param \Shop\BookshopBundle\Entity\Address $shippingAddress
     * @return User
     */
    public function setShippingAddress(\Shop\BookshopBundle\Entity\Address $shippingAddress = null)
    {
        $this->shippingAddress = $shippingAddress;
    
        return $this;
    }

    /**
     * Get shippingAddress
     *
     * @return \Shop\BookshopBundle\Entity\Address 
     */
    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }
}