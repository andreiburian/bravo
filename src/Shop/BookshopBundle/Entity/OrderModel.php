<?php

namespace Shop\BookshopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Shop\BookshopBundle\Entity\Repository\OrderModelRepository")
 * @ORM\Table(name="orders")
 */
class OrderModel
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
     * @ORM\ManyToOne(targetEntity="Address")
     * @ORM\JoinColumn(name="billing_address_id", referencedColumnName="id")
     */
    protected $billing_address;
    
    /**
     * @ORM\ManyToOne(targetEntity="Address")
     * @ORM\JoinColumn(name="shipping_address_id", referencedColumnName="id", nullable=true)
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
     * @ORM\ManyToOne(targetEntity="State")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id")
     */
    protected $state;
      
    /**
     * @ORM\ManyToOne(targetEntity="ShippingMethod")
     * @ORM\JoinColumn(name="shipping_method_id", referencedColumnName="id", nullable=true)
     */
    protected $shippingMethod;
    
    /**
     * @ORM\ManyToOne(targetEntity="PaymentMethod")
     * @ORM\JoinColumn(name="payment_method_id", referencedColumnName="id", nullable=true)
     */
    protected $paymentMethod;
    


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
     * @return OrderModel
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
     * @return OrderModel
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
     * Set user
     *
     * @param \Shop\BookshopBundle\Entity\User $user
     * @return OrderModel
     */
    public function setUser(\Shop\BookshopBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Shop\BookshopBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set billing_address
     *
     * @param \Shop\BookshopBundle\Entity\Address $billingAddress
     * @return OrderModel
     */
    public function setBillingAddress(\Shop\BookshopBundle\Entity\Address $billingAddress = null)
    {
        $this->billing_address = $billingAddress;
    
        return $this;
    }

    /**
     * Get billing_address
     *
     * @return \Shop\BookshopBundle\Entity\Address 
     */
    public function getBillingAddress()
    {
        return $this->billing_address;
    }

    /**
     * Set shipping_address
     *
     * @param \Shop\BookshopBundle\Entity\Address $shippingAddress
     * @return OrderModel
     */
    public function setShippingAddress(\Shop\BookshopBundle\Entity\Address $shippingAddress = null)
    {
        $this->shipping_address = $shippingAddress;
    
        return $this;
    }

    /**
     * Get shipping_address
     *
     * @return \Shop\BookshopBundle\Entity\Address 
     */
    public function getShippingAddress()
    {
        return $this->shipping_address;
    }

    /**
     * Set cart
     *
     * @param \Shop\BookshopBundle\Entity\Cart $cart
     * @return OrderModel
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
     * @return OrderModel
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
     * Set shippingMethod
     *
     * @param \Shop\BookshopBundle\Entity\ShippingMethod $shippingMethod
     * @return OrderModel
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
     * @return OrderModel
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