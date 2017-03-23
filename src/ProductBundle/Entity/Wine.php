<?php

namespace ProductBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
    protected $id;

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
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255)
     */
    private $region;

    /**
     * @var Product
     * @ORM\ManyToMany(targetEntity="\ProductBundle\Entity\GrapeVariety", cascade={"persist"}, mappedBy="wines")
     * @ORM\JoinColumn(name="grape_variety", referencedColumnName="id")
     */
    private $grapeVariety;


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->grapeVariety = new ArrayCollection();
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
     * Get discr
     *
     * @return string
     */
    public function getDiscr()
    {
        return 'wine';
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
     * Set region
     *
     * @param string $region
     *
     * @return Wine
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Add GrapeVariety
     *
     * @param \ProductBundle\Entity\GrapeVariety $grape
     *
     * @return Product
     */
    public function addGrapeVariety(GrapeVariety $grape)
    {
        $this->grapeVariety[] = $grape;
        return $this;
    }

    /**
     * Remove GrapeVariety
     *
     * @param \ProductBundle\Entity\GrapeVariety $grape
     */
    public function removeGrapeVariety(GrapeVariety $grape)
    {
        $this->grapeVariety->removeElement($grape);
    }

    /**
     * Get GrapeVarietys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGrapeVariety()
    {
        return $this->grapeVariety;
    }

}
