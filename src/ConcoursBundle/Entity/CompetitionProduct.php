<?php

namespace ConcoursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ConcoursBundle\Entity\Competition;
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
     * Set primeName
     *
     * @param integer $points
     *
     * @return CompetitionWine
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get primeName
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
     * @param \ProductBundle\Entity\Product $product
     *
     * @return CompetitionWine
     */
    public function setProduct(\ProductBundle\Entity\Product $product)
    {
        $this->product = $product;
        return $this;
    }

    /**
     * Get wine
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
     * @return CompetitionWine
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
}
