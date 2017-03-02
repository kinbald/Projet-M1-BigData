<?php

namespace ProductBundle\Repository;

use UserBundle\Entity\BaseUser;

/**
 * ReservationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReservationRepository extends \Doctrine\ORM\EntityRepository
{
    public function getReservationUser(BaseUser $user)
    {
        return $this->createQueryBuilder('m')
            ->where('m.user = :id')
            ->setParameter('id',$user->getId())
            ->getQuery()
            ->getResult();
    }

    public function AllReservation(BaseUser $user)
    {
        return $this->createQueryBuilder('m')
            ->where('m.user = :id')
            ->setParameter('id',$user->getId())
            ->getQuery()
            ->getResult();
    }

    public function getQuantityReservation($id, $user)
    {
        return $this->createQueryBuilder('m')
            ->where('m.user = :user')
            ->andWhere('m.product = :id')
            ->setParameter('user',$user->getId())
            ->setParameter('id',$id)
            ->getQuery()
            ->getResult();
    }
}
