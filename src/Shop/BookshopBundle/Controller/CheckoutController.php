<?php

namespace Shop\BookshopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Shop\BookshopBundle\Entity\Address;
use Shop\BookshopBundle\Entity\OrderModel;
use Shop\BookshopBundle\Form\Type\BillingFormType;
use Shop\BookshopBundle\Form\Type\ShippingFormType;
use Shop\BookshopBundle\Form\Type\ShippingMethodFormType;
use Shop\BookshopBundle\Form\Type\PaymentMethodFormType;
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
        if ($orderModel == null)
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

        $orderModel = $em->getRepository('ShopBookshopBundle:OrderModel')->getOrderByUser($userId);

        $shippingAddress = new Address();

        if ($orderModel->getShippingAddress() != null) {
            $oldShippingAddress = $orderModel->getShippingAddress();
            $this->copyAddress($oldShippingAddress, $shippingAddress);
        }

        $request = $this->getRequest();

        $form = $this->createForm(new ShippingFormType(), $shippingAddress);
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
        }

        if ($form->isValid()) {
            $em->persist($shippingAddress);
            $em->flush($shippingAddress);
            if ($shippingAddress->getShipTo() == true) {
                $orderModel->setShippingAddress($orderModel->getBillingAddress());
                $user->setShippingAddress($orderModel->getBillingAddress());
            } else {
                $orderModel->setShippingAddress($shippingAddress);
                $user->setShippingAddress($shippingAddress);
            }
            $em->persist($orderModel);
            $em->flush($orderModel);
            $em->flush($user);
            return $this->redirect($this->generateUrl('shop_bookshop_checkoutStep3'));
        }
        return $this->render('ShopBookshopBundle:Checkout:step2.html.twig', array('form' => $form->createView()));
    }

    public function step3Action()
    {
        $user = $this->getUser();
        $userId = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $shippingMethod = $em->getRepository('ShopBookshopBundle:ShippingMethod')->findAll();
        $orderModel = $em->getRepository('ShopBookshopBundle:OrderModel')->getOrderByUser($userId);
        $check = (($orderModel->getShippingMethod() == null) ? null : ($orderModel->getShippingMethod()->getId()));

        $request = $this->getRequest();

        $form = $this->createForm(new ShippingMethodFormType($em), array($shippingMethod, $check));

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
        }

        if ($form->isValid()) {
            $data = $form->getData();
            $shippingMethod = $data['shippingMethod'];
            $orderModel->setTotal($orderModel->getCart()->getTotal() + $shippingMethod->getPrice());
            $orderModel->setShippingMethod($shippingMethod);
            $em->persist($orderModel);
            $em->flush($orderModel);
            return $this->redirect($this->generateUrl('shop_bookshop_checkoutStep4'));
        }

        return $this->render('ShopBookshopBundle:Checkout:step3.html.twig', array('form' => $form->createView()));
    }

    public function step4Action()
    {
        $user = $this->getUser();
        $userId = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $paymentMethod = $em->getRepository('ShopBookshopBundle:PaymentMethod')->findAll();
        $orderModel = $em->getRepository('ShopBookshopBundle:OrderModel')->getOrderByUser($userId);
        $check = ($orderModel->getPaymentMethod() != null ? $orderModel->getPaymentMethod()->getId() : null);

        $request = $this->getRequest();
        $form = $this->createForm(new PaymentMethodFormType($em), array($paymentMethod, $check));
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
        }

        if ($form->isValid()) {
            $data = $form->getData();
            $paymentMethod = $data['paymentMethod'];
            $orderModel->setPaymentMethod($paymentMethod);
            $em->persist($orderModel);
            $em->flush($orderModel);
            return $this->redirect($this->generateUrl('shop_bookshop_checkoutStep5'));
        }
        return $this->render('ShopBookshopBundle:Checkout:step4.html.twig', array('form' => $form->createView()));
    }

    public function step5Action()
    {
        $user = $this->getUser();
        $userId = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $orderModel = $em->getRepository('ShopBookshopBundle:OrderModel')->getOrderByUser($userId);
     

        
        return $this->render('ShopBookshopBundle:Checkout:step5.html.twig', array('order' => $orderModel));
    }

    public function step6Action()
    {
        return $this->render('ShopBookshopBundle:Checkout:step6.html.twig');
    }
    
    public function cancelAction()
    {
        $user = $this->getUser();
        $userId = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $orderModel = $em->getRepository('ShopBookshopBundle:OrderModel')->getOrderByUser($userId);
        $state = $em->getRepository('ShopBookshopBundle:State')->find(5);
        $orderModel->setState($state);
        $em->persist($orderModel);
        $em->flush($orderModel);
        return $this->redirect($this->generateUrl('shop_bookshop_homepage'));
    }

    private function copyAddress($from, $to)
    {
        $to->setAddressDetail($from->getAddressDetail());
        $to->setCountry($from->getCountry());
        $to->setFirstname($from->getFirstname());
        $to->setLastname($from->getLastname());
        $to->setEmail($from->getEmail());
    }

}