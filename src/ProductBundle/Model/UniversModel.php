<?php
/**
 * Created by PhpStorm.
 * User: pierre
 * Date: 09/12/16
 * Time: 15:08
 */

namespace ProductBundle\Model;
use Doctrine\Common\Persistence\ObjectManager;


class UniversModel
{
    protected $repositoryUniverse;

    public function __construct(ObjectManager $entityManager)
    {
        $this->repositoryUniverse = $entityManager->getRepository('ProductBundle:Universe');
    }

    public function findProductsByName($name)
    {
        return $this->repositoryUniverse->findProductsByName($name);
    }

}