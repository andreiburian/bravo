<?php

namespace Shop\BookshopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Shop\BookshopBundle\Entity\Repository\CartRepository")
 * @ORM\Table(name="cart")
 */
class Cart
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="CartItem", mappedBy="cart")
     */
    protected $cartItems;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="cart")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\Column(type="string")
     */
    protected $date;

    /**
     * @ORM\Column(type="integer") 
     */
    protected $active;

    /**
     * @ORM\Column(type="integer") 
     */
    protected $total;

    /**
     * Constructor
     */
    public function __construct($user, $date, $active, $total)
    {
        $this->setUser($user);
        $this->setDate($date);
        $this->setActive($active);
        $this->setTotal($total);
        $this->cartItems = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set date
     *
     * @param string $date
     * @return Cart
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set active
     *
     * @param integer $active
     * @return Cart
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set total
     *
     * @param integer $total
     * @return Cart
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
     * Add cartItems
     *
     * @param \Shop\BookshopBundle\Entity\CartItem $cartItems
     * @return Cart
     */
    public function addCartItem(\Shop\BookshopBundle\Entity\CartItem $cartItems)
    {
        $this->cartItems[] = $cartItems;

        return $this;
    }

    /**
     * Remove cartItems
     *
     * @param \Shop\BookshopBundle\Entity\CartItem $cartItems
     */
    public function removeCartItem(\Shop\BookshopBundle\Entity\CartItem $cartItems)
    {
        $this->cartItems->removeElement($cartItems);
    }

    /**
     * Get cartItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCartItems()
    {
        return $this->cartItems;
    }

    /**
     * Set user
     *
     * @param \Shop\BookshopBundle\Entity\User $user
     * @return Cart
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

}