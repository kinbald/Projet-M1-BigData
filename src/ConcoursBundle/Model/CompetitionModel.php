<?php

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



    public function getFutureCompetitions(\DateTime $beginDate, $limit, $page)
    {
        $offset = $limit*$page;
        return $this->repository->findCompetitionsAfterADate($beginDate, $limit, $offset);
    }

    public function getCompetitionsBetweenTwoDates(\DateTime $beginDate, \DateTime $endDate, $limit = 30, $page = 0)
    {
        $offset = $limit*$page;
        return $this->repository->findCompetitionsBetweenTwoDates($beginDate, $endDate, $limit, $offset);
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