<?php
/**
 * Created by PhpStorm.
 * User: cam2
 * Date: 16/03/17
 * Time: 10:35
 */

namespace AppBundle\Model;
use Doctrine\Common\Persistence\ObjectManager;

class NewsModel
{
    protected $repository;

    public function __construct(ObjectManager $entityManager)
    {
        $this->repository = $entityManager->getRepository('AppBundle:News');
    }

    public function getAllNews($limit = 10, $page = 0)
    {
        $offset = $limit*$page;
        return $this->repository->findAllNews($limit, $offset);
    }
}