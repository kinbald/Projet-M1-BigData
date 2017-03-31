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
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="\ProductBundle\Entity\ConditioningType", cascade={"persist"}, inversedBy="deliveries")
     */
    private $conditioningTypes;



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
     * @param integer $price
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
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Add product
     *
     * @param \ProductBundle\Entity\ConditioningType $conditioningType
     *
     * @return Delivery
     */
    public function addProduct(\ProductBundle\Entity\ConditioningType $conditioningType)
    {
        $this->conditioningTypes[] = $conditioningType;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \ProductBundle\Entity\ConditioningType $conditioningType
     */
    public function removeProduct(\ProductBundle\Entity\ConditioningType $conditioningType)
    {
        $this->conditioningTypes->removeElement($conditioningType);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->conditioningTypes;
    }
}

