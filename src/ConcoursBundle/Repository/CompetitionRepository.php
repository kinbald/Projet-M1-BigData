<?php

namespace ConcoursBundle\Repository;

/**
 * CompetitionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CompetitionRepository extends \Doctrine\ORM\EntityRepository
{
    public function findCompetitionsBetweenTwoDates(\DateTime $beginDate, \DateTime $endDate, $limit, $offset)
    {
        return $this->createQueryBuilder('m')
            ->where("m.dateCompetition > ?1")
            ->andWhere("m.dateCompetition < ?2")
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->setParameter(1, $beginDate)
            ->setParameter(2, $endDate)
            ->getQuery()
            ->getResult();
    }

    public function findCompetitionsAfterADate(\DateTime $beginDate, $limit, $offset)
    {
        return $this->createQueryBuilder('m')
            ->where("m.dateCompetition > ?1")
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->setParameter(1, $beginDate)
            ->getQuery()
            ->getResult();
    }
}
