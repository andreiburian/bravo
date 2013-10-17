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

        if($userId == 0)
            return $this->redirect('../login');
        else    
            return $this->render('ShopBookshopBundle:Checkout:step1.html.twig');
    }
    
    public function step2Action()
    {
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