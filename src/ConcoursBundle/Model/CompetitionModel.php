<?php
/**
 * Created by PhpStorm.
 * User: cam2
 * Date: 16/12/16
 * Time: 13:02
 */

namespace ConcoursBundle\Model;
use Doctrine\Common\Persistence\ObjectManager;

class CompetitionModel
{
    protected $repository;
    protected $repositoryWine;

    public function __construct(ObjectManager $entityManager)
    {
        $this->repository = $entityManager->getRepository('ConcoursBundle:Competition');
        $this->repositoryWine = $entityManager->getRepository('ConcoursBundle:CompetitionWine');
    }

    public function getAllCompetitions()
    {
        return $this->repository->findAll();
    }

    public function getFutureCompetitions(\DateTime $beginDate, $limit)
    {
        return $this->repository->findCompetitionsAfterADate($beginDate, $limit);
    }

    public function getCompetitionsBetweenTwoDates(\DateTime $beginDate, \DateTime $endDate, $limit)
    {
        return $this->repository->findCompetitionsBetweenTwoDates($beginDate, $endDate, $limit);
    }

    public function getCompetitionsByName($name)
    {
        return $this->repository->findByName($name);
    }

    public function getCompetitionsWineByName($name)
    {
        return $this->repositoryWine->findByPrime_name($name);
    }
}