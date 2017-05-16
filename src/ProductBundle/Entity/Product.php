<?php

namespace ProductBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ProductBundle\Entity\Country;
use ProductBundle\Entity\PictureProduct;
use ProductBundle\Entity\Recipe;
use ProductBundle\Entity\Universe;
use ProductBundle\Entity\Purchase;
use ProductBundle\Entity\ProductPurchase;
use ProductBundle\Entity\ProductEvaluation;
use Symfony\Bridge\Doctrine\Tests\Fixtures\User;
use UserBundle\Entity\UserConsumer;
use UserBundle\Entity\UserProducer;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="ProductBundle\Repository\ProductRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"wine" = "Wine", "spirit" = "Spirit"})
 */
abstract class Product
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="display_name", nullable=true, type="string", length=255)
     */
    protected $displayName;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @var float
     *
     * @ORM\Column(name="volume", type="float")
     */
    protected $volume;


    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="ConcoursBundle\Entity\CompetitionProduct", mappedBy="product")
     */
    private $competitions;

    /**
     * @var float
     *
     * @ORM\Column(name="alcohol_degree", type="float")
     */
    private $alcoholDegree;

    /**
     * @var float
     *
     * @ORM\Column(name="sugar", type="float")
     */
    private $sugar;

    /**
     * @var Continent
     *
     * @ORM\ManyToOne(targetEntity="\ProductBundle\Entity\Continent", inversedBy="products")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="origin_continent", referencedColumnName="id", nullable=true)
     * })
     */
    private $originContinent;

    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="\ProductBundle\Entity\Country", inversedBy="products")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="origin_country", referencedColumnName="id", nullable=true)
     * })
     */
    private $originCountry;

    /**
     * @var UserProducer
     *
     * @ORM\ManyToOne(targetEntity="\UserBundle\Entity\UserProducer", inversedBy="products")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="producer", referencedColumnName="id", nullable=true)
     * })
     */
    private $producer;

    /**
     * @var Range
     *
     * @ORM\ManyToOne(targetEntity="\ProductBundle\Entity\Range", inversedBy="products")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="range", referencedColumnName="id", nullable=true)
     * })
     */
    private $range;

    /**
     * @var PictureProduct
     *
     * @ORM\OneToMany(targetEntity="\ProductBundle\Entity\PictureProduct", mappedBy="product")
     */
    protected $pictures;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="\ProductBundle\Entity\Universe", inversedBy="products")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $universes;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="\ProductBundle\Entity\Recipe", mappedBy="products")
     */
    protected $recipes;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="\ProductBundle\Entity\ProductConditioning", mappedBy="product")
     */
    protected $conditioningTypes;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="ProductBundle\Entity\ProductEvaluation", mappedBy="product")
     */
    protected $evaluations;

    /**
     * @var boolean
     *
     * @ORM\Column(name="on_sale", type="boolean", options={"default" : true})
     */
    protected $onSale;

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
     * @return Product
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
     * Set displayName
     *
     * @param string $name
     *
     * @return Product
     */
    public function setDisplayName($name)
    {
        $this->displayName = $name;
        return $this;
    }

    /**
     * Get displayName
     *
     * @return string
     */
    public function getDisplayName()
    {
        return !empty($this->displayName)?$this->displayName:$this->getName() ;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
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
     * Set volume
     *
     * @param float $volume
     *
     * @return Product
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return float
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Set alcoholDegree
     *
     * @param float $alcoholDegree
     *
     * @return Product
     */
    public function setAlcoholDegree($alcoholDegree)
    {
        $this->alcoholDegree = $alcoholDegree;

        return $this;
    }

    /**
     * Get alcoholDegree
     *
     * @return float
     */
    public function getAlcoholDegree()
    {
        return $this->alcoholDegree;
    }

    /**
     * Set sugar
     *
     * @param float $sugar
     *
     * @return Product
     */
    public function setSugar($sugar)
    {
        $this->sugar = $sugar;

        return $this;
    }

    /**
     * Get sugar
     *
     * @return float
     */
    public function getSugar()
    {
        return $this->sugar;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get discr
     *
     * @return string
     */
    abstract public function getDiscr();

    /**
     * Add picture
     *
     * @param \ProductBundle\Entity\PictureProduct $picture
     *
     * @return Product
     */
    public function addPicture(PictureProduct $picture)
    {
        $this->pictures[] = $picture;

        return $this;
    }

    /**
     * Remove picture
     *
     * @param \ProductBundle\Entity\PictureProduct $picture
     */
    public function removePicture(PictureProduct $picture)
    {
        $this->pictures->removeElement($picture);
    }

    /**
     * Get pictures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * Add universe
     *
     * @param \ProductBundle\Entity\Universe $universe
     *
     * @return Product
     */
    public function addUniverse(Universe $universe)
    {
        $this->universes[] = $universe;
        return $this;
    }

    /**
     * Remove universe
     *
     * @param \ProductBundle\Entity\Universe $universe
     */
    public function removeUniverse(Universe $universe)
    {
        $this->universes->removeElement($universe);
    }

    /**
     * Get universes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUniverses()
    {
        return $this->universes;
    }

    /**
     * Add user
     *
     * @param \ProductBundle\Entity\ProductEvaluation $user
     *
     * @return Product
     */
    public function addUser(ProductEvaluation $user)
    {
        $this->evaluations[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \ProductBundle\Entity\ProductEvaluation $user
     */
    public function removeUser(ProductEvaluation $user)
    {
        $this->evaluations->removeElement($user);
    }

    /**
     * Get evaluations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvaluations()
    {
        return $this->evaluations;
    }

    /**
     * Get average evaluations
     * @return int
     */
    public function getAverageMarks(){
        $evaluations = $this->getEvaluations();
        $sommeNotes = 0;
        $nbEval = 0;
        $noteProduit = 0;
        foreach ($evaluations as $evaluation){
            $sommeNotes += $evaluation->getMark();
            $nbEval++;
        }
        if($nbEval > 0){
            $noteProduit = $sommeNotes / $nbEval;
        }

        return round($noteProduit);
    }

    /**
     * Add recipe
     *
     * @param \ProductBundle\Entity\Recipe $recipe
     *
     * @return Product
     */
    public function addRecipe(\ProductBundle\Entity\Recipe $recipe)
    {
        $this->recipes[] = $recipe;

        return $this;
    }

    /**
     * Remove recipe
     *
     * @param \ProductBundle\Entity\Recipe $recipe
     */
    public function removeRecipe(\ProductBundle\Entity\Recipe $recipe)
    {
        $this->recipes->removeElement($recipe);
    }

    /**
     * Get recipes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRecipes()
    {
        return $this->recipes;
    }

    /**
     * Add conditioningType
     *
     * @param \ProductBundle\Entity\ProductConditioning $conditioningType
     *
     * @return Product
     */
    public function addConditioningType(\ProductBundle\Entity\ProductConditioning $conditioningType)
    {
        $this->conditioningTypes[] = $conditioningType;

        return $this;
    }

    /**
     * Remove conditioningType
     *
     * @param \ProductBundle\Entity\ProductConditioning $conditioningType
     */
    public function removeConditioningType(\ProductBundle\Entity\ProductConditioning $conditioningType)
    {
        $this->conditioningTypes->removeElement($conditioningType);
    }

    /**
     * Get conditioningTypes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConditioningTypes()
    {
        return $this->conditioningTypes;
    }

    /**
     * Set origin_country
     *
     * @param Country $country
     * @return Product
     */
    public function setOriginCountry(Country $country = null)
    {
        $this->originCountry = $country;
        return $this;
    }

    /**
     * Get origin_country
     *
     * @return Country
     */
    public function getOriginCountry()
    {
        return $this->originCountry;
    }

    /**
     * Set origin_continent
     *
     * @param Continent $continent
     * @return Product
     */
    public function setOriginContinent(Continent $continent = null)
    {
        $this->originContinent = $continent;
        return $this;
    }

    /**
     * Get origin_continent
     *
     * @return Continent
     */
    public function getOriginContinent()
    {
        return $this->originContinent;
    }

    /**
     * Set range
     *
     * @param Range $range
     * @return Product
     */
    public function setRange(Range $range = null)
    {
        $this->range = $range;
        return $this;
    }

    /**
     * Get range
     *
     * @return Range
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * Add competition
     *
     * @param \ConcoursBundle\Entity\CompetitionProduct $competition
     *
     * @return Product
     */
    public function addCompetition(\ConcoursBundle\Entity\CompetitionProduct $competition)
    {
        $this->competitions[] = $competition;

        return $this;
    }

    /**
     * Remove competition
     *
     * @param \ConcoursBundle\Entity\CompetitionProduct $competition
     */
    public function removeCompetition(\ConcoursBundle\Entity\CompetitionProduct $competition)
    {
        $this->competitions->removeElement($competition);
    }

    /**
     * Get Collection
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompetitions()
    {
        return $this->competitions;
    }

    /**
     * Set producer
     *
     * @param UserProducer $producer
     * @return Product
     */
    public function setProducer(UserProducer $producer = null)
    {
        $this->producer = $producer;
        return $this;
    }

    /**
     * Set aDecanter
     *
     * @param boolean $onSale
     *
     * @return Product
     */
    public function setOnSale($onSale)
    {
        $this->onSale = $onSale;

        return $this;
    }

    /**
     * Get onSale
     *
     * @return boolean
     */
    public function isOnSale()
    {
        return $this->onSale;
    }

    /**
     * Get producer
     *
     * @return UserProducer
     */
    public function getProducer()
    {
        return $this->producer;
    }

    public function getMinPrice()
    {
        $prixMin = null;
        foreach ($this->getConditioningTypes() as $conditioning)
        {
            if($prixMin == null) {
                $prixMin = $conditioning->getPrice();
                continue;
            }
            if($conditioning->getPrice() < $prixMin)
                $prixMin = $conditioning->getPrice();
        }
        return $prixMin;
    }
}
