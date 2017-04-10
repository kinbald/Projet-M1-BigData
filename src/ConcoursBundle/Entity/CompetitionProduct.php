<?php

namespace ConcoursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ConcoursBundle\Entity\Competition;
use ConcoursBundle\Entity\Medal;
use ProductBundle\Entity\Product;
use ProductBundle\Entity\Universe;

/**
 * CompetitionWine
 *
 * @ORM\Table(name="competition_product")
 * @ORM\Entity(repositoryClass="ConcoursBundle\Repository\CompetitionProductRepository")
 */
class CompetitionProduct
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
     * @var integer
     *
     * @ORM\Column(name="points", type="integer")
     */
    private $points;

    /**
     * @var Competition
     * @ORM\ManyToOne(targetEntity="ConcoursBundle\Entity\Competition", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $competition;

    /**
     * @var Product
     * @ORM\ManyToOne(targetEntity="ProductBundle\Entity\Product", inversedBy="competitions")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $product;


    /**
     * @var Universe
     * @ORM\ManyToOne(targetEntity="ProductBundle\Entity\Universe", inversedBy="competitions")
     * @ORM\JoinColumn(nullable=false )
     */
    private $universe;

    /**
     * Medal
     * @ORM\OneToOne(targetEntity="ConcoursBundle\Entity\Medal", mappedBy="competition")
     */
    private $medal;


    /**
     * Get id
     *
     * @return integer
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
     * @return CompetitionProduct
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
     * Set points
     *
     * @param integer $points
     *
     * @return CompetitionProduct
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set competition
     *
     * @param \ConcoursBundle\Entity\Competition $competition
     *
     * @return CompetitionProduct
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
     * Set product
     *
     * @param \ProductBundle\Entity\Product $product
     *
     * @return CompetitionProduct
     */
    public function setProduct(\ProductBundle\Entity\Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \ProductBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set universe
     *
     * @param \ProductBundle\Entity\Universe $universe
     *
     * @return CompetitionProduct
     */
    public function setUniverse(\ProductBundle\Entity\Universe $universe)
    {
        $this->universe = $universe;

        return $this;
    }

    /**
     * Get universe
     *
     * @return \ProductBundle\Entity\Universe
     */
    public function getUniverse()
    {
        return $this->universe;
    }

    /**
     * Set medal
     *
     * @param \ConcoursBundle\Entity\Medal $medal
     *
     * @return CompetitionProduct
     */
    public function setMedal(\ConcoursBundle\Entity\Medal $medal = null)
    {
        $this->medal = $medal;

        return $this;
    }

    /**
     * Get medal
     *
     * @return \ConcoursBundle\Entity\Medal
     */
    public function getMedal()
    {
        return $this->medal;
    }
}
