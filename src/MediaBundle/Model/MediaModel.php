<?php

namespace MediaBundle\Model;
use Doctrine\Common\Persistence\ObjectManager;

class MediaModel
{
    protected $repository;

    public function __construct(ObjectManager $entityManager)
    {
        $this->repository = $entityManager->getRepository('MediaBundle:Files');
    }

    public function getAllMedias()
    {
        return $this->repository->findAll();
    }

    public function getMediasByName($name)
    {
        return $this->repository->findByName($name);
    }

    public function getMediasAfterADate(\DateTime $date, $limit)
    {
        return $this->repository->findMediasAfterADate($date, $limit);
    }

    public function getMediasBetweenTwoDates(\DateTime $beginDate, \DateTime $endDate, $limit)
    {
        return $this->repository->findMediasBetweenTwoDates($beginDate, $endDate, $limit);
    }
}