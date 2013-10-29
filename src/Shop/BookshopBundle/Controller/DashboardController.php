<?php

namespace Shop\BookshopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Shop\BookshopBundle\Form\Type\AccountFormType;
use Shop\BookshopBundle\Form\Type\BillingFormType;
use Shop\BookshopBundle\Form\Type\ShippingFormType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DashboardController extends Controller
{
    public function sidebarAction()
    {
        return $this->render('ShopBookshopBundle:Dashboard:dashboardSidebar.html.twig');
    }

    public function indexAction()
    {
        $user = $this->checkUser();
        return $this->render('ShopBookshopBundle:Dashboard:dashboardIndex.html.twig', array('user' => $user));
    }
    public function viewAllOrdersAction()
    {
        $user = $this->checkUser();
        return $this->render('ShopBookshopBundle:Dashboard:allOrders.html.twig', array('orders' => $user->getOrder()));
    }
    public function viewOrderAction($id)
    {
        $user = $this->checkUser();
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('ShopBookshopBundle:OrderModel')->find($id);
        return $this->render('ShopBookshopBundle:Dashboard:viewOrder.html.twig', array('order' => $order));
    }
    public function editAccountAction(Request $request)
    {
        $user = $this->checkUser();
        $form = $this->createForm(new AccountFormType(), $user);
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            //process form - update user
        }
        
        return $this->render('ShopBookshopBundle:Dashboard:editAccount.html.twig', array('form' => $form->createView()));
    }
    public function editBillingAddressAction()
    {
        $user = $this->checkUser();
        $billingAddress = $user->getBillingAddress();
        $form = $this->createForm(new BillingFormType(), $billingAddress);
        
        return $this->render('ShopBookshopBundle:Dashboard:editBillingAddress.html.twig', array('form' => $form->createView()));
    }
    public function editShippingAddressAction()
    {
        $user = $this->checkUser();
        $shippingAddress = $user->getShippingAddress();
        $form = $this->createForm(new ShippingFormType(), $shippingAddress);
        
        return $this->render('ShopBookshopBundle:Dashboard:editShippingAddress.html.twig', array('form' => $form->createView()));
    }
    private function checkUser()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) ) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        return $user;
    }

}