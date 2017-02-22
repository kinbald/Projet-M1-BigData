<?php

namespace ConcoursBundle\Repository;
use ProductBundle\Entity\Product;
use ProductBundle\Entity\Universe;

/**
 * CompetitionWineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CompetitionWineRepository extends \Doctrine\ORM\EntityRepository
{





    public function findCompetitionsByUniverse(Universe $universe, Product $product)
    {
        return $this->createQueryBuilder('m')
            ->where("m.universe = ?1")
            ->andWhere("m.wine = ?2")
            ->setParameter(1, $universe->getId())
            ->setParameter(2, $product->getId())
            ->getQuery()
            ->getResult();
    }








}
