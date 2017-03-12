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
        $this->repositoryUniverse = $entityManager->getRepository('ProductBundle:Product');
    }

    public function searchEngine($name, $price)
    {
        return $this->repositoryUniverse->searchEngine($name, $price);
    }



}