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
        $this->repositoryWine = $entityManager->getRepository('ProductBundle:Wine');
    }
    public function findProductsByName($name)
    {
        return $this->repositoryUniverse->findProductsByName($name);
    }
    public function findProductConditionningByPrice($price)
    {
        return $this->repositoryProductConditioning->findProductConditionningByPrice($price);
    }

    public function findProductConditionningByColor($color)
    {
        return $this->repositoryWine->findProductConditionningByColor($color);
    }

    public function getMaxConditionningPrice()
    {
        return $this->repositoryProductConditioning->getMaxConditionningPrice();
    }

    public function getColors()
    {
        $array = $this->repositoryWine->getColors();
        $colors = array(""=>"");
        foreach ($array as $color)
            $colors[$color['color']] = $color['color'];
        return $colors;
    }



}





