<?php

namespace Shop\BookshopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{

    public function indexAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()
                ->getManager();
        $user = $em->getRepository('ShopBookshopBundle:User')->find($user->getId());

        return $this->render('ShopBookshopBundle:Dashboard:dashboardIndex.html.twig', array('user' => $user));
    }

}