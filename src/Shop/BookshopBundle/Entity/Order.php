<?php

namespace Shop\BookshopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Shop\BookshopBundle\Entity\Repository\OrderRepository")
 * @ORM\Table(name="order")
 */
class Order
{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="order")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    /**
     * @ORM\OneToOne(targetEntity="Address", inversedBy="orderBilling")
     * @ORM\JoinColumn(name="billing_address_id", referencedColumnName="id")
     */
    protected $billing_address;
    
    /**
     * @ORM\OneToOne(targetEntity="Address", inversedBy="orderShipping")
     * @ORM\JoinColumn(name="shipping_address_id", referencedColumnName="id")
     */
    protected $shipping_address;
    
    /**
     * @ORM\OneToOne(targetEntity="Cart")
     * @ORM\JoinColumn(name="cart_id", referencedColumnName="id")
     */
    protected $cart;
    
    /**
     *
     * @ORM\Column(type="integer") 
     */
    protected $total;
    
    /**
     *
     * @ORM\Column(type="datetime") 
     */
    protected $date;
    
    /**
     * @ORM\OneToOne(targetEntity="State", inversedBy="order")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id")
     */
    protected $state;
      
    /**
     * @ORM\OneToOne(targetEntity="ShippingMethod", inversedBy="order")
     * @ORM\JoinColumn(name="shipping_method_id", referencedColumnName="id")
     */
    protected $shippingMethod;
    
    /**
     * @ORM\OneToOne(targetEntity="PaymentMethod", inversedBy="order")
     * @ORM\JoinColumn(name="payment_method_id", referencedColumnName="id")
     */
    protected $paymentMethod;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
        $this->billing_address = new \Doctrine\Common\Collections\ArrayCollection();
        $this->shipping_address = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set total
     *
     * @param integer $total
     * @return Order
     */
    public function setTotal($total)
    {
        $this->total = $total;
    
        return $this;
    }

    /**
     * Get total
     *
     * @return integer 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Order
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add user
     *
     * @param \Shop\BookshopBundle\Entity\User $user
     * @return Order
     */
    public function addUser(\Shop\BookshopBundle\Entity\User $user)
    {
        $this->user[] = $user;
    
        return $this;
    }

    /**
     * Remove user
     *
     * @param \Shop\BookshopBundle\Entity\User $user
     */
    public function removeUser(\Shop\BookshopBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add billing_address
     *
     * @param \Shop\BookshopBundle\Entity\Address $billingAddress
     * @return Order
     */
    public function addBillingAddres(\Shop\BookshopBundle\Entity\Address $billingAddress)
    {
        $this->billing_address[] = $billingAddress;
    
        return $this;
    }

    /**
     * Remove billing_address
     *
     * @param \Shop\BookshopBundle\Entity\Address $billingAddress
     */
    public function removeBillingAddres(\Shop\BookshopBundle\Entity\Address $billingAddress)
    {
        $this->billing_address->removeElement($billingAddress);
    }

    /**
     * Get billing_address
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBillingAddress()
    {
        return $this->billing_address;
    }

    /**
     * Add shipping_address
     *
     * @param \Shop\BookshopBundle\Entity\Address $shippingAddress
     * @return Order
     */
    public function addShippingAddres(\Shop\BookshopBundle\Entity\Address $shippingAddress)
    {
        $this->shipping_address[] = $shippingAddress;
    
        return $this;
    }

    /**
     * Remove shipping_address
     *
     * @param \Shop\BookshopBundle\Entity\Address $shippingAddress
     */
    public function removeShippingAddres(\Shop\BookshopBundle\Entity\Address $shippingAddress)
    {
        $this->shipping_address->removeElement($shippingAddress);
    }

    /**
     * Get shipping_address
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getShippingAddress()
    {
        return $this->shipping_address;
    }

    /**
     * Set cart
     *
     * @param \Shop\BookshopBundle\Entity\Cart $cart
     * @return Order
     */
    public function setCart(\Shop\BookshopBundle\Entity\Cart $cart = null)
    {
        $this->cart = $cart;
    
        return $this;
    }

    /**
     * Get cart
     *
     * @return \Shop\BookshopBundle\Entity\Cart 
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Set state
     *
     * @param \Shop\BookshopBundle\Entity\State $state
     * @return Order
     */
    public function setState(\Shop\BookshopBundle\Entity\State $state = null)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return \Shop\BookshopBundle\Entity\State 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set billing_address
     *
     * @param \Shop\BookshopBundle\Entity\Address $billingAddress
     * @return Order
     */
    public function setBillingAddress(\Shop\BookshopBundle\Entity\Address $billingAddress = null)
    {
        $this->billing_address = $billingAddress;
    
        return $this;
    }

    /**
     * Set shipping_address
     *
     * @param \Shop\BookshopBundle\Entity\Address $shippingAddress
     * @return Order
     */
    public function setShippingAddress(\Shop\BookshopBundle\Entity\Address $shippingAddress = null)
    {
        $this->shipping_address = $shippingAddress;
    
        return $this;
    }

    /**
     * Set user
     *
     * @param \Shop\BookshopBundle\Entity\User $user
     * @return Order
     */
    public function setUser(\Shop\BookshopBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Set shippingMethod
     *
     * @param \Shop\BookshopBundle\Entity\ShippingMethod $shippingMethod
     * @return Order
     */
    public function setShippingMethod(\Shop\BookshopBundle\Entity\ShippingMethod $shippingMethod = null)
    {
        $this->shippingMethod = $shippingMethod;
    
        return $this;
    }

    /**
     * Get shippingMethod
     *
     * @return \Shop\BookshopBundle\Entity\ShippingMethod 
     */
    public function getShippingMethod()
    {
        return $this->shippingMethod;
    }

    /**
     * Set paymentMethod
     *
     * @param \Shop\BookshopBundle\Entity\PaymentMethod $paymentMethod
     * @return Order
     */
    public function setPaymentMethod(\Shop\BookshopBundle\Entity\PaymentMethod $paymentMethod = null)
    {
        $this->paymentMethod = $paymentMethod;
    
        return $this;
    }

    /**
     * Get paymentMethod
     *
     * @return \Shop\BookshopBundle\Entity\PaymentMethod 
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }
}