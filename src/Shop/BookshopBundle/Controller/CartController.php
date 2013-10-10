<?php

// src/Shop/BookshopBundle/Controller/CartController.php

namespace Shop\BookshopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class CartController extends Controller
{

    public function cartSidebarAction()
    {
        $em = $this->getDoctrine()
                ->getManager();

        $userId = 1;

        $cart = $em->getRepository('ShopBookshopBundle:Cart')
                ->getCartByUser($userId);
        
        return $this->render('ShopBookshopBundle:Cart:cartSidebar.html.twig', array(
                    'cart' => $cart));
    }

    public function cartPageAction()
    {
        $em = $this->getDoctrine()
                ->getManager();

        $userId = 1;

        $cart = $em->getRepository('ShopBookshopBundle:Cart')
                ->getCartByUser($userId);

        return $this->render('ShopBookshopBundle:Cart:cartPage.html.twig', array(
                    'cart' => $cart));
    }

    public function removeProductAction($cartItemId)
    {
        $em = $this->getDoctrine()->getManager();

        $userId = 1;
        $cart = $em->getRepository('ShopBookshopBundle:Cart')->getCartByUser($userId);
        $cartItems = $cart[0]->getCartItems();

        if (!(empty($cartItems))) {
            foreach ($cartItems as $cartItem) {
                if ($cartItem->getId() == $cartItemId) {
                    $em->remove($cartItem);
                    $em->flush();
                }
            }
        }

        $this->updateTotal($cart[0]->getId());
        return $this->redirect($this->getRequest()->headers->get('referer'));
    }

    public function emptyCartAction($cartId)
    {
        $em = $this->getDoctrine()->getManager();
        $cart = $em->getRepository('ShopBookshopBundle:Cart')->getCartById($cartId);
        $cartItems = $cart[0]->getCartItems();

        if (!(empty($cartItems))) {
            foreach ($cartItems as $cartItem) {
                $em->remove($cartItem);
                $em->flush();
            }
        }

        $this->updateTotal($cart[0]->getId());
        return $this->redirect($this->getRequest()->headers->get('referer'));
    }

    public function addProductAction()
    {
        if (isset($_POST['productId']))
            if (ctype_digit($_POST['productId']))
                $productId = $_POST['productId'];
        if (isset($_POST['qty']))
            if (ctype_digit($_POST['qty']))
                $quantity = $_POST['qty'];

        $userId = 1;
        $em = $this->getDoctrine()->getManager();
        $cart = $em->getRepository('ShopBookshopBundle:Cart')->getCartByUser($userId);
        $product = $em->getRepository('ShopBookshopBundle:Product')->find($productId);
        $cartItems = $cart[0]->getCartItems();

        foreach ($cartItems as $cartItem) {
            if ($cartItem->getProduct()->getId() == $productId)
                $existingItem = $cartItem;
        }

        if (empty($existingItem)) {
            if ($quantity <= $product->getStock()) {
                $cartItem = new \Shop\BookshopBundle\Entity\CartItem($cart[0], $product, $product->getTitle(), $quantity, $product->getPrice());
                $cart[0]->addCartItem($cartItem);
                $em->persist($cartItem);
                $em->flush();
            }
        } else {
            if ($quantity + $existingItem->getQuantity() <= $product->getStock()) {
                $existingItem->setQuantity($existingItem->getQuantity() + $quantity);
                $em->persist($existingItem);
                $em->flush();
            }
        }

        $this->updateTotal($cart[0]->getId());
        return $this->redirect($this->getRequest()->headers->get('referer'));
    }

    public function updateCartAction()
    {
        $em = $this->getDoctrine()->getManager();
        $userId = 1;
        $cart = $em->getRepository('ShopBookshopBundle:Cart')->getCartByUser($userId);
        $cartItems = $cart[0]->getCartItems();
        foreach ($_POST['qty'] as $key => $value)
            foreach ($cartItems as $cartItem)
                if ($cartItem->getId() == $key && ctype_digit($value) && $value >= 0 && $value <= $cartItem->getProduct()->getStock()) {
                    $cartItem->setQuantity($value);
                    $em->persist($cartItem);
                }
        $em->flush();
        $this->updateTotal($cart[0]->getId());
        return $this->redirect($this->getRequest()->headers->get('referer'));
    }

    private function updateTotal($cartId)
    {
        $em = $this->getDoctrine()->getManager();
        $cart = $em->getRepository('ShopBookshopBundle:Cart')->getCartById($cartId);
        $cartItems = $cart[0]->getCartItems();
        $cart[0]->setTotal(0.00);
        foreach ($cartItems as $cartItem) {
            $cart[0]->setTotal($cartItem->getQuantity() * $cartItem->getPrice() + $cart[0]->getTotal());
        }
        $em->persist($cart[0]);
        $em->flush();
    }

}

