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
     * @var CompetitionWine
     * @ORM\OneToMany(targetEntity="ConcoursBundle\Entity\CompetitionWine", mappedBy="competition")
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
        $this->wines = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add wine
     *
     * @param \ConcoursBundle\Entity\CompetitionWine $wine
     *
     * @return Competition
     */
    public function addWine(\ConcoursBundle\Entity\CompetitionWine $wine)
    {
        $this->wines[] = $wine;

        return $this;
    }

    /**
     * Remove wine
     *
     * @param \ConcoursBundle\Entity\CompetitionWine $wine
     */
    public function removeWine(\ConcoursBundle\Entity\CompetitionWine $wine)
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
