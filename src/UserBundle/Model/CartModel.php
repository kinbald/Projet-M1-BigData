<?php
/**
 * Created by PhpStorm.
 * User: cam2
 * Date: 02/02/17
 * Time: 11:44
 */

namespace UserBundle\Model;
use Doctrine\Common\Persistence\ObjectManager;
use ProductBundle\Entity\Reservation;
use UserBundle\Entity\BaseUser;


class CartModel
{
    protected $repositoryProduct;
    protected $repositoryReservation;
    protected $em;

    public function __construct(ObjectManager $entityManager)
    {
        $this->em = $entityManager;
        $this->repositoryProduct = $entityManager->getRepository('ProductBundle:Product');
        $this->repositoryReservation = $entityManager->getRepository('ProductBundle:Reservation');
        $this->repositoryConditioning = $entityManager->getRepository('ProductBundle:ProductConditioning');
    }

    public function setStockConditioningFromReservationByUser($user)
    {
        $reservations = $this->repositoryReservation->findByUser($user);
        foreach ($reservations as $reservation){
            $conditioning = $this->repositoryConditioning->find($reservation->getProductConditioning());
            $conditioning->setStock($conditioning->getStock() - $reservation->getQuantity());
        }
        $this->em->flush();
    }

    public function getQuantityById($id)
    {
        return $this->repositoryConditioning->find($id)->getStock();
    }

    public function getQuantityReservationById($id, $user)
    {
        return $this->repositoryReservation->getQuantityReservation($id, $user);
    }

    public function setQuantityById($id, $quantity)
    {
        return $this->repositoryConditioning->find($id)->setStock($quantity);
    }

    public function find($id)
    {
        return $this->repositoryProduct->find($id);
    }

    public function findAllReservation($user)
    {
        return $this->repositoryReservation->AllReservation($user);
    }

    public function removeUserReservation(BaseUser $user)
    {
        $results = $this->repositoryReservation->findByUser($user);
        foreach ($results as $result){
            $this->em->remove($result);
        }
        $this->em->flush();
    }
}