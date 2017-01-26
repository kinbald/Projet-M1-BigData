<?php

namespace UserBundle\Model;
use Doctrine\Common\Persistence\ObjectManager;

class UserModel
{
    protected $repositoryUserMedia;
    protected $repositoryUserProducer;

    public function __construct(ObjectManager $entityManager)
    {
        $this->repositoryUserMedia = $entityManager->getRepository('UserBundle:UserMedia');
        $this->repositoryUserProducer = $entityManager->getRepository('UserBundle:UserProducer');
    }

    public function getAllUserMedia($limit = 30, $page = 0)
    {
        $offset = $limit*$page;
        return $this->repositoryUserMedia->findAllMedia($limit, $offset);
    }

    public function getAllUserProducer($limit = 30, $page = 0)
    {
        $offset = $limit*$page;
        return $this->repositoryUserProducer->findAllProducer($limit, $offset);
    }

    public function getAllUserMediaEnabled($limit = 30, $page = 0)
    {
        $offset = $limit*$page;
        return $this->repositoryUserMedia->UserMediaEnabled($limit, $offset);
    }

    public function getAllUserMediaDisabled($limit = 30, $page = 0)
    {
        $offset = $limit*$page;
        return $this->repositoryUserMedia->UserMediaDisabled($limit, $offset);
    }
}