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

    public function getAllUserMediaEnabled($limit)
    {
        return $this->repositoryUserMedia->UserMediaEnabled($limit);
    }

    public function getAllUserMediaDisabled($limit)
    {
        return $this->repositoryUserMedia->UserMediaDisabled($limit);
    }
}