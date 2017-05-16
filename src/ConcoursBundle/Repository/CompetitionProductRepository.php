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
class CompetitionProductRepository extends \Doctrine\ORM\EntityRepository
{
    public function findCompetitionsByUniverse(Universe $universe, Product $product)
    {
        return $this->createQueryBuilder('m')
            ->where("m.universe = ?1")
            ->andWhere("m.product = ?2")
            ->setParameter(1, $universe->getId())
            ->setParameter(2, $product->getId())
            ->getQuery()
            ->getResult();
    }
    public function findCompetitionsByProduct(Product $product)
    {
        return $this->createQueryBuilder('m')
            ->where("m.product = ?1")
            ->setParameter(1, $product->getId())
            ->getQuery()
            ->getResult();
    }
}
