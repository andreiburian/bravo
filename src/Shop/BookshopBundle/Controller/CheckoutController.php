<?php

namespace Shop\BookshopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Shop\BookshopBundle\Entity\Address;
use Shop\BookshopBundle\Entity\OrderModel;
use Shop\BookshopBundle\Form\Type\BillingFormType;
use Shop\BookshopBundle\Entity\State;
use Shop\BookshopBundle\Entity\ShippingMethod;
use Shop\BookshopBundle\Entity\PaymentMethod;

class CheckoutController extends Controller
{

    public function step1Action()
    {
        $userId = (is_null($this->getUser()) ? 0 : $this->getUser()->getId() );

        if ($userId == 0)
            return $this->redirect('../login');

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        if ($this->getUser()->getBillingAddress() != null) {
            $billingAddress = $em->getRepository('ShopBookshopBundle:Address')
                    ->getAddressById($this->getUser()->getBillingAddress()->getId());
        } else {
            $billingAddress = new Address();
        }

        $cart = $em->getRepository('ShopBookshopBundle:Cart')->getCartByUser($userId);
        $orderModel = $em->getRepository('ShopBookshopBundle:OrderModel')->getOrderByUser($userId);
        if($orderModel == null)
            $orderModel = new OrderModel();
        $state = $em->getRepository('ShopBookshopBundle:State')->find(1);

        $request = $this->getRequest();

        $form = $this->createForm(new BillingFormType(), $billingAddress);
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
        }

        if ($form->isValid()) {
            
            $em->persist($billingAddress);
            $em->flush($billingAddress);
            $orderModel->setBillingAddress($billingAddress);
            if ($billingAddress->getShipTo() == 1) {
                $orderModel->setShippingAddress($billingAddress);
                $user->setShippingAddress($billingAddress);
            }
            $orderModel->setUser($user);
            $orderModel->setCart($cart);
            $orderModel->setTotal($cart->getTotal());
            $orderModel->setDate(new \DateTime());
            $orderModel->setState($state);
            $em->persist($orderModel);
            $em->flush($orderModel);
            $user->setBillingAddress($billingAddress);
            $em->flush($user);
            
            if ($billingAddress->getShipTo() == 0)
                return $this->redirect($this->generateUrl('shop_bookshop_checkoutStep2'));
            else
                return $this->redirect($this->generateUrl('shop_bookshop_checkoutStep3'));
        }

        return $this->render('ShopBookshopBundle:Checkout:step1.html.twig', array('form' => $form->createView()));
    }

    public function step2Action()
    {
        $user = $this->getUser();
        $userId = $user->getId();
        $em = $this->getDoctrine()->getManager();
        if ($this->getUser()->getShippingAddress() != null) {
            $shippingAddress = $em->getRepository('ShopBookshopBundle:Address')
                    ->getAddressById($this->getUser()->getShippingAddress()->getId());
        } else {
            $shippingAddress = new Address();
        }

        $cart = $em->getRepository('ShopBookshopBundle:Cart')->getCartByUser($userId);
        $orderModel = $em->getRepository('ShopBookshopBundle:OrderModel')->getOrderByUser($userId);

        $request = $this->getRequest();

        $form = $this->createForm(new BillingFormType(), $shippingAddress);
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
        }

        if ($form->isValid()) {
            
            $em->persist($shippingAddress);
            $em->flush($shippingAddress);
            $orderModel->setShippingAddress($shippingAddress);
            $em->persist($orderModel);
            $em->flush($orderModel);
            $user->setShippingAddress($shippingAddress);
            $em->flush($user);
            return $this->redirect($this->generateUrl('shop_bookshop_checkoutStep3'));
        }
        return $this->render('ShopBookshopBundle:Checkout:step2.html.twig', array('form' => $form->createView()));
    }

    public function step3Action()
    {
        return $this->render('ShopBookshopBundle:Checkout:step3.html.twig');
    }

    public function step4Action()
    {
        return $this->render('ShopBookshopBundle:Checkout:step4.html.twig');
    }

    public function step5Action()
    {
        return $this->render('ShopBookshopBundle:Checkout:step5.html.twig');
    }

    public function step6Action()
    {
        return $this->render('ShopBookshopBundle:Checkout:step6.html.twig');
    }

}