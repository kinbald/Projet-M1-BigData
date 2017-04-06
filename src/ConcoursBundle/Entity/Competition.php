<?php

namespace ConcoursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ConcoursBundle\Entity\CompetitionWine;

/**
 * Competition
 *
 * @ORM\Table(name="competition")
 * @ORM\Entity(repositoryClass="ConcoursBundle\Repository\CompetitionRepository")
 */
class Competition
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_competition", type="date")
     */
    private $dateCompetition;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var CompetitionProduct
     * @ORM\OneToMany(targetEntity="ConcoursBundle\Entity\CompetitionProduct", mappedBy="competition")
     */
    private $products;


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
     * @return Competition
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
     * Set dateCompetition
     *
     * @param \DateTime $dateCompetition
     *
     * @return Competition
     */
    public function setDateCompetition($dateCompetition)
    {
        $this->dateCompetition = $dateCompetition;

        return $this;
    }

    /**
     * Get dateCompetition
     *
     * @return \DateTime
     */
    public function getDateCompetition()
    {
        return $this->dateCompetition;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Competition
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add product
     *
     * @param \ConcoursBundle\Entity\Competition $product
     *
     * @return Competition
     */
    public function addWine(\ConcoursBundle\Entity\Competition $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \ConcoursBundle\Entity\Competition $product
     */
    public function removeWine(\ConcoursBundle\Entity\Competition $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWines()
    {
        return $this->products;
    }
}
