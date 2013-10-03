<?php

// src/Blogger/BlogBundle/Controller/DefaultController.php

namespace Shop\BookshopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;


class PageController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()
                ->getManager();

        $latestProd = $em->getRepository('ShopBookshopBundle:Product')
                ->getLatestProducts(6);

        return $this->render('ShopBookshopBundle:Homepage:index.html.twig', array(
                    'latestProd' => $latestProd));
    }

    public function categoryAction()
    {
        
        $request = $this->get('request');

        $em = $this->getDoctrine()
                ->getManager();
        
        $products = $em->getRepository('ShopBookshopBundle:Product')->getProducts($request->query->get('sortBy'),
                                                                                  $request->query->get('direction'), 
                                                                                  $request->query->get('cid'), 
                                                                                  $request->query->get('st'), 
                                                                                  $request->query->get('pr'), 
                                                                                  $request->query->get('search'),
                                                                                  $request->query->get('cat'));
        
        $helper = $this->get('helper');
        $cat = $helper->getCategoryForProducts($products);
                
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $products, $this->get('request')->query->get('page', 1)/* page number */, 3/* limit per page */
        );
        
        return $this->render('ShopBookshopBundle:Page:category.html.twig', array('products' => $pagination, 'categories' => $cat));
    }
    
    public function ajaxSearch()
    {
        
        $res = "no match";
            echo '<li>'.$res.'</li>';
        
        /* $products = getProductsByTitle;
        if (sizeof($products) == 0)
        {
            $res = "no match";
            echo '<li>'.$res.'</li>';
        } else
        {
            $res = $products;
            for ($i = 0; $i < 5 && $i< sizeof($res); $i++)
            {
                echo '<li><a style="text-decoration: none" href=' . url('product', array( 'pid' => $res[$i]['id'], 'cid'=>$res[$i]['category_id'])) . '>' . $res[$i]['title'] . '</a></li>';
            }
        }
        */
    }
    
}
