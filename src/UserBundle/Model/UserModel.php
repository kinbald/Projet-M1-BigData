<?php

namespace UserBundle\Model;
use Doctrine\Common\Persistence\ObjectManager;

class UserModel
{
    protected $repositoryUserMedia;

    public function __construct(ObjectManager $entityManager)
    {
        $this->repositoryUserMedia = $entityManager->getRepository('UserBundle:UserMedia');
    }

    public function getAllUserMedia()
    {
        return $this->repositoryUserMedia->findAll();
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