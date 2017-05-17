<?php

namespace ProductBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ProductBundle\Entity\Product;
use ConcoursBundle\Entity\CompetitionWine;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank()
     */
    private $vintage;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=50)
     * @Assert\NotBlank()
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255, nullable=true)
     */
    private $region;

    /**
     * @var Product
     * @ORM\ManyToMany(targetEntity="\ProductBundle\Entity\GrapeVariety", cascade={"persist"}, mappedBy="wines")
     * @ORM\JoinColumn(name="grape_variety", referencedColumnName="id")
     */
    private $grapeVariety;

    /**
     * @var boolean
     *
     * @ORM\Column(name="a_decanter", type="boolean", options={"default" : false})
     */
    protected $aDecanter;

    /**
     * @var boolean
     *
     * @ORM\Column(name="contact_lies", type="boolean", options={"default" : false})
     */
    protected $contactLies;

    /**
     * @var boolean
     *
     * @ORM\Column(name="contact_bois", type="boolean", options={"default" : false})
     */
    protected $contactBois;

    /**
     * @var boolean
     *
     * @ORM\Column(name="non_filtre", type="boolean", options={"default" : false})
     */
    protected $nonFiltre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="demarche_qualite", type="boolean", options={"default" : false})
     */
    protected $demarcheQualite;

    /**
     * @var float
     *
     * @ORM\Column(name="overpressure", type="float", nullable=true)
     */
    protected $overpressure;


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->grapeVariety = new ArrayCollection();
        $this->aDecanter = false;
        $this->contactBois = false;
        $this->demarcheQualite = false;
        $this->contactLies = false;
        $this->nonFiltre = false;
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
     * Set aDecanter
     *
     * @param boolean $aDecanter
     *
     * @return Wine
     */
    public function setADecanter($aDecanter)
    {
        $this->aDecanter = $aDecanter;

        return $this;
    }

    /**
     * Get aDecanter
     *
     * @return boolean
     */
    public function getADecanter()
    {
        return $this->aDecanter;
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
     * Set contactLies
     *
     * @param boolean $contactLies
     *
     * @return Wine
     */
    public function setContactLies($contactLies)
    {
        $this->contactLies = $contactLies;

        return $this;
    }

    /**
     * Get contactLies
     *
     * @return boolean
     */
    public function getContactLies()
    {
        return $this->contactLies;
    }

    /**
     * Set contactBois
     *
     * @param boolean $contactBois
     *
     * @return Wine
     */
    public function setContactBois($contactBois)
    {
        $this->contactBois = $contactBois;

        return $this;
    }

    /**
     * Get contactBois
     *
     * @return boolean
     */
    public function getContactBois()
    {
        return $this->contactBois;
    }

    /**
     * Set nonFiltre
     *
     * @param boolean $nonFiltre
     *
     * @return Wine
     */
    public function setNonFiltre($nonFiltre)
    {
        $this->nonFiltre = $nonFiltre;

        return $this;
    }

    /**
     * Get nonFiltre
     *
     * @return boolean
     */
    public function getNonFiltre()
    {
        return $this->nonFiltre;
    }

    /**
     * Set demarcheQualite
     *
     * @param boolean $demarcheQualite
     *
     * @return Wine
     */
    public function setDemarcheQualite($demarcheQualite)
    {
        $this->demarcheQualite = $demarcheQualite;

        return $this;
    }

    /**
     * Get demarcheQualite
     *
     * @return boolean
     */
    public function getDemarcheQualite()
    {
        return $this->demarcheQualite;
    }

    /**
     * Set overpressure
     *
     * @param float $overpressure
     *
     * @return Wine
     */
    public function setOverpressure($overpressure)
    {
        $this->overpressure = $overpressure;

        return $this;
    }

    /**
     * Get overpressure
     *
     * @return float
     */
    public function getOverpressure()
    {
        return $this->overpressure;
    }
}
