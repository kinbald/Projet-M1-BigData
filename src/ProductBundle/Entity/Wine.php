<?php

namespace ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ProductBundle\Entity\Product;
use ConcoursBundle\Entity\CompetitionWine;

/**
 * Wine
 *
 * @ORM\Table(name="wine")
 * @ORM\Entity(repositoryClass="ProductBundle\Repository\WineRepository")
 */
class Wine extends Product
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
     * @var \DateTime
     *
     * @ORM\Column(name="vintage", type="date")
     */
    private $vintage;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=50)
     */
    private $color;

    /**
     * @var CompetitionWine
     * @ORM\OneToMany(targetEntity="ConcoursBundle\Entity\CompetitionWine", mappedBy="wine")
     */
    private $competitions;


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
     * Set vintage
     *
     * @param \DateTime $vintage
     *
     * @return Wine
     */
    public function setVintage($vintage)
    {
        $this->vintage = $vintage;

        return $this;
    }

    /**
     * Get vintage
     *
     * @return \DateTime
     */
    public function getVintage()
    {
        return $this->vintage;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Wine
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Add competition
     *
     * @param \ConcoursBundle\Entity\CompetitionWine $competition
     *
     * @return Wine
     */
    public function addCompetition(\ConcoursBundle\Entity\CompetitionWine $competition)
    {
        $this->competitions[] = $competition;

        return $this;
    }

    /**
     * Remove competition
     *
     * @param \ConcoursBundle\Entity\CompetitionWine $competition
     */
    public function removeCompetition(\ConcoursBundle\Entity\CompetitionWine $competition)
    {
        $this->competitions->removeElement($competition);
    }

    /**
     * Get competitions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompetitions()
    {
        return $this->competitions;
    }
}
