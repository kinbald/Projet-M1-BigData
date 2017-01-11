<?php

namespace ContractBundle\Model;
use Doctrine\Common\Persistence\ObjectManager;

class OptionModel
{
    protected $repository;
    protected $repositorySubscription;

    public function __construct(ObjectManager $entityManager)
    {
        $this->repository = $entityManager->getRepository('ContractBundle:Option');
        $this->repositorySubscription = $entityManager->getRepository('ContractBundle:OptionSubscription');
    }

    public function getAllOptions()
    {
        return $this->repository->findAll();
    }

    public function getOptionsByName($name)
    {
        return $this->repository->findByName($name);
    }

    public function getAllOptionSubscriptions()
    {
        return $this->repositorySubscription->findAll();
    }

    public function getFutureOptionSubscriptions(\DateTime $beginDate, $limit)
    {
        return $this->repositorySubscription->findOptionSubscriptionsAfterADate($beginDate, $limit);
    }

    public function getOptionSubscriptionsBetweenTwoDates(\DateTime $beginDate, \DateTime $endDate, $limit)
    {
        return $this->repositorySubscription->findOptionSubscriptionsBetweenTwoDates($beginDate, $endDate, $limit);
    }
}