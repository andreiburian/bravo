<?php

namespace Shop\BookshopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class CheckoutController extends Controller
{

    public function step1Action()
    {
        $userId = (is_null($this->getUser()) ? 0 : $this->getUser()->getId() );

        if ($userId == 0)
            return $this->redirect('../login');
        else {
            $em = $this->getDoctrine()->getManager();
            if($this->getUser()->getBillingAddress() !=null )
            {
                $billingAddress = $em->getRepository('ShopBookshopBundle:Address')
                    ->getAddressById($this->getUser()->getBillingAddress()->getId() );
            }
            else{
                $billingAddress = new \Shop\BookshopBundle\Entity\Address();
             }
            return $this->render('ShopBookshopBundle:Checkout:step1.html.twig', array('address' => $billingAddress));
        }
    }

    public function step2Action()
    {
        if(isset($_POST['step1']))
        {   
            $em = $this->getDoctrine()->getManager();
            
            $billingAddress = new \Shop\BookshopBundle\Entity\Address();
            $this->getUser()->setBillingAddress($billingAddress);
            $em->persist($billingAddress);
            $em->flush();
        }
        return $this->render('ShopBookshopBundle:Checkout:step2.html.twig');
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