<?php

namespace Shop\BookshopBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Shop\BookshopBundle\Entity\Cart;

/**
 * CartRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CartRepository extends EntityRepository
{

    public function getCartByUser($id)
    {
        $qb = $this->createQueryBuilder('c')
                ->select('c')
                ->where('c.user = :id')->setParameter('id', $id)
                ->orderBy('c.id', 'DESC');
        $result = $qb->getQuery()->getResult();
        if (count($result) > 0)
            return $result[0];
        else
            return null;
    }

    public function getCartById($id)
    {
        $qb = $this->createQueryBuilder('c')
                        ->select('c')
                        ->where('c.id = :id')->setParameter('id', $id);
        $result = $qb->getQuery()->getResult();
        if (count($result) > 0)
            return $result[0];
        else
            return null;
    }

}
