<?php

namespace ProductBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Delivery
 *
 * @ORM\Table(name="delivery")
 * @ORM\Entity(repositoryClass="ProductBundle\Repository\DeliveryRepository")
 */
class Delivery
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="\ProductBundle\Entity\ProductConditioning", cascade={"persist"}, inversedBy="deliveries")
     */
    private $conditioningTypes;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="\ProductBundle\Entity\ProductPurchase", mappedBy="delivery")
     */
    private $purchases;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->conditioningTypes = new \Doctrine\Common\Collections\ArrayCollection();
    }



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Delivery
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Delivery
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Add conditioningType
     *
     * @param \ProductBundle\Entity\ProductConditioning $conditioningType
     *
     * @return Delivery
     */
    public function addConditioningType(\ProductBundle\Entity\ProductConditioning $conditioningType)
    {
        $this->conditioningTypes[] = $conditioningType;

        return $this;
    }

    /**
     * Remove conditioningType
     *
     * @param \ProductBundle\Entity\ProductConditioning $conditioningType
     */
    public function removeConditioningType(\ProductBundle\Entity\ProductConditioning $conditioningType)
    {
        $this->conditioningTypes->removeElement($conditioningType);
    }

    /**
     * Get conditioningTypes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConditioningTypes()
    {
        return $this->conditioningTypes;
    }

    /**
     * Add purchase
     *
     * @param \ProductBundle\Entity\ProductPurchase $purchase
     *
     * @return Delivery
     */
    public function addPurchase(\ProductBundle\Entity\ProductPurchase $purchase)
    {
        $this->purchases[] = $purchase;

        return $this;
    }

    /**
     * Remove purchase
     *
     * @param \ProductBundle\Entity\ProductPurchase $purchase
     */
    public function removePurchase(\ProductBundle\Entity\ProductPurchase $purchase)
    {
        $this->purchases->removeElement($purchase);
    }

    /**
     * Get purchases
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPurchases()
    {
        return $this->purchases;
    }

    public function __toString()
    {
        return $this->name;
    }
}
