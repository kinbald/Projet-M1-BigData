<?php

namespace ProductBundle\Repository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{
    public function findProductsByName($name)
    {
        $name_lower = strtolower($name);
        $queryBuilder = $this->createQueryBuilder('p');
        $queryBuilder->where($queryBuilder->expr()->like('LOWER(p.name)', '\'%'.$name_lower.'%\''));  //pour enlever la sensibilité à la casse LOWER et strtolower
        $query = $queryBuilder->getQuery();
        return $query->getResult();

    }

    public function findProductsByPrice($price)
    {
        $queryBuilder = $this->createQueryBuilder('p');
        $queryBuilder->where($queryBuilder->expr()->lte('p.price', $price));
        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }


}
