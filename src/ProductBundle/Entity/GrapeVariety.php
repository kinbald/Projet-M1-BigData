<?php

namespace ProductBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GrapeVariety
 *
 * @ORM\Table(name="grape_variety")
 * @ORM\Entity(repositoryClass="ProductBundle\Repository\GrapeVarietyRepository")
 */
class GrapeVariety
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="\ProductBundle\Entity\Wine", mappedBy="grappeVariety")
     */
    private $wines;


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
     * @return GrapeVariety
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
     * Constructor
     */
    public function __construct()
    {
        $this->wines = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add wine
     *
     * @param \ProductBundle\Entity\Wine $wine
     *
     * @return GrapeVariety
     */
    public function addWine(\ProductBundle\Entity\Wine $wine)
    {
        $this->wines[] = $wine;

        return $this;
    }

    /**
     * Remove wine
     *
     * @param \ProductBundle\Entity\Wine $wine
     */
    public function removeWine(\ProductBundle\Entity\Wine $wine)
    {
        $this->wines->removeElement($wine);
    }

    /**
     * Get wines
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWines()
    {
        return $this->wines;
    }
}
