<?php
/**
 * Created by PhpStorm.
 * User: cam2
 * Date: 02/02/17
 * Time: 11:44
 */

namespace UserBundle\Model;
use Doctrine\Common\Persistence\ObjectManager;


class CartModel
{
    protected $repositoryProduct;

    public function __construct(ObjectManager $entityManager)
    {
        $this->repositoryProduct = $entityManager->getRepository('ProductBundle:Product');
    }

    public function getQuantityById($id)
    {
        return $this->repositoryProduct->find($id)->getStock();
    }

    public function find($id)
    {
        return $this->repositoryProduct->find($id);
    }
}