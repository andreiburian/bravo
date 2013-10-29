<?php

namespace Shop\BookshopBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * AddressRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AddressRepository extends EntityRepository
{
    public function getAddressById($id)
    {
        $qb = $this->createQueryBuilder('ad')
                        ->select('ad')
                        ->where('ad.id = :id')->setParameter('id', $id);
        return $qb->getQuery()->getOneOrNullResult();
    }
}