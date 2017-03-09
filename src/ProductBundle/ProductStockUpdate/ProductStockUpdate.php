<?php

namespace ProductBundle\ProductStockUpdate;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ProductStockUpdate implements EventSubscriber
{

    private $preUpdateStock;
    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(
            'preRemove',
            'postPersist',
            'preUpdate',
            'postUpdate'
        );
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $reservation = $args->getEntity();
        $em = $args->getEntityManager();

        if ($reservation instanceof \ProductBundle\Entity\Reservation)
        {
            $product = $reservation->getProduct();
            $product->setStock($product->getStock() + $reservation->getQuantity());

            $em->persist($product);
            $em->flush();
        }
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $reservation = $args->getEntity();
        $em = $args->getEntityManager();

        if ($reservation instanceof \ProductBundle\Entity\Reservation)
        {
            $product = $reservation->getProduct();
            $product->setStock($product->getStock() - $reservation->getQuantity());

            $em->persist($product);
            $em->flush();
        }
    }
    public function preUpdate(LifecycleEventArgs $args)
    {
        $reservation = $args->getEntity();

        if ($reservation instanceof \ProductBundle\Entity\Reservation) {
            $this->preUpdateStock = $reservation->getQuantity();
        }
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $reservation = $args->getEntity();
        $em = $args->getEntityManager();

        if ($reservation instanceof \ProductBundle\Entity\Reservation)
        {
            $product = $reservation->getProduct();
            $product->setStock($product->getStock() + $this->preUpdateStock - $reservation->getQuantity());

            $em->persist($product);
            $em->flush();
        }
    }
}