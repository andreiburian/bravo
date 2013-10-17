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
     * @ORM\OneToMany(targetEntity="Order", mappedBy="user")
     */
    protected $order;
    
   
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
     * @param \Shop\BookshopBundle\Entity\Order $order
     * @return User
     */
    public function addOrder(\Shop\BookshopBundle\Entity\Order $order)
    {
        $this->order[] = $order;
    
        return $this;
    }

    /**
     * Remove order
     *
     * @param \Shop\BookshopBundle\Entity\Order $order
     */
    public function removeOrder(\Shop\BookshopBundle\Entity\Order $order)
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
}