<?php

namespace ConcoursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ConcoursBundle\Entity\Competition;
use ProductBundle\Entity\Wine;

/**
 * CompetitionWine
 *
 * @ORM\Table(name="competition_wine")
 * @ORM\Entity(repositoryClass="ConcoursBundle\Repository\CompetitionWineRepository")
 */
class CompetitionWine
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
     * @ORM\Column(name="prime_name", type="string", length=255)
     */
    private $primeName;

    /**
     * @var Competition
     * @ORM\ManyToOne(targetEntity="ConcoursBundle\Entity\Competition", inversedBy="wines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $competition;

    /**
     * @var Wine
     * @ORM\ManyToOne(targetEntity="ProductBundle\Entity\Wine", inversedBy="competitions")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $wine;


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
     * Set primeName
     *
     * @param string $primeName
     *
     * @return CompetitionWine
     */
    public function setPrimeName($primeName)
    {
        $this->primeName = $primeName;

        return $this;
    }

    /**
     * Get primeName
     *
     * @return string
     */
    public function getPrimeName()
    {
        return $this->primeName;
    }

    /**
     * Set competition
     *
     * @param \ConcoursBundle\Entity\Competition $competition
     *
     * @return CompetitionWine
     */
    public function setCompetition(\ConcoursBundle\Entity\Competition $competition)
    {
        $this->competition = $competition;

        return $this;
    }

    /**
     * Get competition
     *
     * @return \ConcoursBundle\Entity\Competition
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * Set wine
     *
     * @param \ProductBundle\Entity\Wine $wine
     *
     * @return CompetitionWine
     */
    public function setWine(\ProductBundle\Entity\Wine $wine)
    {
        $this->wine = $wine;

        return $this;
    }

    /**
     * Get wine
     *
     * @return \ProductBundle\Entity\Wine
     */
    public function getWine()
    {
        return $this->wine;
    }
}
