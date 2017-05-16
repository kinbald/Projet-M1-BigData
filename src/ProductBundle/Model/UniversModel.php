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
        $this->repositoryProductConditioning = $entityManager->getRepository('ProductBundle:ProductConditioning');
    }
    public function findProductsByName($name)
    {
        return $this->repositoryUniverse->findProductsByName($name);
    }
    public function findProductConditionningByPrice($price)
    {
        return $this->repositoryProductConditioning->findProductConditionningByPrice($price);
    }

    public function getMaxConditionningPrice()
    {
        return $this->repositoryProductConditioning->getMaxConditionningPrice();
    }

}





