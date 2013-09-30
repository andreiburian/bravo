<?php

namespace Shop\BookshopBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends EntityRepository
{

    public function getLatestProducts($limit = null)
    {
        $qb = $this->createQueryBuilder('p')
                ->select('p, c')
                ->join('p.category', 'c')
                ->addOrderBy('p.id', 'DESC');

        if (false === is_null($limit))
            $qb->setMaxResults($limit);

        return $qb->getQuery()
                        ->getResult();
    }
   
    public function getProducts($orderBy, $direction, $cid=0, $stock=null, $price=null, $str='', $cat)
    {       
        
        $orderBy == null ? $orderBy='title' : $orderBy;
        $direction == null ? $direction='asc' : $direction;
        
        $qb = $this->createQueryBuilder('p')
                ->select('p, c')
                ->join('p.category', 'c')
                ->addOrderBy('p.'.$orderBy, $direction);
        $qb->add('where', 'p.title LIKE ?1')
           ->setParameter(1, '%'.$str.'%');
        if($cat != null)
            $qb->andWhere ('c.label = :cat')->setParameter('cat', $cat);
        
        if($cid != 0)
            $qb->andWhere ('c.id = :cid')->setParameter('cid', $cid);
        
        if ($stock=='1')
            $qb->andWhere ('p.active= :active')->setParameter('active', $stock);
        elseif ($stock == '0')
            $qb->andWhere ('p.active= :active')->setParameter('active', $stock);
        
        if($price=='1')
            $qb->andWhere ('p.price < 20 ');
        if($price=='2') 
            $qb->andWhere ('p.price >= 20 AND p.price < 40');
        if($price=='3')
            $qb->andWhere ('p.price > 40 ');
                      
        return $qb->getQuery()
                  ->getResult();
    }
    

    public function getRandomProd($category, $limit = null)
    {

        $qb = $this->createQueryBuilder('p')
                ->select('p')
                ->where('p.category = :category')
                ->setParameter('category', $category);

        $qb2 = $this->getEntityManager()->createQueryBuilder()->select('COUNT(p.id)')
                                                              ->from('ShopBookshopBundle:Product', 'p')
                                                               ->where('p.category = :category')
                                                               ->setParameter('category', $category);
        $number = $qb2->getQuery()->getSingleScalarResult();
        
        if (false === is_null($limit)){
            $qb->setMaxResults($limit)->setFirstResult(rand(0, $number-$limit));
        }
        
        return $qb->getQuery()
                        ->getResult();
    }

    public function getRandomProd($category, $limit = null)
    {

        $qb = $this->createQueryBuilder('p')
                ->select('p')
                ->where('p.category = :category')
                ->setParameter('category', $category);

        $qb2 = $this->getEntityManager()->createQueryBuilder()->select('COUNT(p.id)')
                                                              ->from('ShopBookshopBundle:Product', 'p')
                                                               ->where('p.category = :category')
                                                               ->setParameter('category', $category);
        $number = $qb2->getQuery()->getSingleScalarResult();
        
        if (false === is_null($limit)){
            $qb->setMaxResults($limit)->setFirstResult(rand(0, $number-$limit));
        }
        
        return $qb->getQuery()
                        ->getResult();
    }

}
