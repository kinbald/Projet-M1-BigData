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
use UserBundle\Entity\UserConsumer;

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
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    protected $price;

    /**
     * @var int
     *
     * @ORM\Column(name="stock", type="integer")
     */
    protected $stock;

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
     * @var Collection
     * @ORM\OneToMany(targetEntity="ConcoursBundle\Entity\CompetitionProduct", mappedBy="product")
     */
    private $competitions;


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
     * @ORM\ManyToMany(targetEntity="\ProductBundle\Entity\ConditioningType", mappedBy="products")
     */
    protected $conditioningTypes;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="ProductBundle\Entity\ProductPurchase", mappedBy="product")
     */
    protected $purchases;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="ProductBundle\Entity\ProductEvaluation", mappedBy="product")
     */
    protected $users;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="\ProductBundle\Entity\Reservation", mappedBy="product")
     */
    protected $reservations;

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
        return $this->displayName;
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
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     *
     * @return Product
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->aDecanter = false;
        $this->contactBois = false;
        $this->demarcheQualite = false;
        $this->contactLies = false;
        $this->nonFiltre = false;
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
     * Add purchase
     *
     * @param \ProductBundle\Entity\ProductPurchase $purchase
     *
     * @return Product
     */
    public function addPurchase(ProductPurchase $purchase)
    {
        $this->purchases[] = $purchase;

        return $this;
    }

    /**
     * Remove purchase
     *
     * @param \ProductBundle\Entity\ProductPurchase $purchase
     */
    public function removePurchase(ProductPurchase $purchase)
    {
        $this->purchases->removeElement($purchase);
    }

    /**
     * Get purchases
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPurchases()
    {
        return $this->purchases;
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
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \ProductBundle\Entity\ProductEvaluation $user
     */
    public function removeUser(ProductEvaluation $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
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
     * @param \ProductBundle\Entity\ConditioningType $conditioningType
     *
     * @return Product
     */
    public function addConditioningType(\ProductBundle\Entity\ConditioningType $conditioningType)
    {
        $this->conditioningTypes[] = $conditioningType;

        return $this;
    }

    /**
     * Remove conditioningType
     *
     * @param \ProductBundle\Entity\ConditioningType $conditioningType
     */
    public function removeConditioningType(\ProductBundle\Entity\ConditioningType $conditioningType)
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
     * Add reservations
     *
     * @param \ProductBundle\Entity\Reservation $reservation
     *
     * @return Product
     */
    public function addReservation(\ProductBundle\Entity\Reservation $reservation)
    {
        $this->reservations[] = $reservation;

        return $this;
    }

    /**
     * Remove reservations
     *
     * @param \ProductBundle\Entity\Reservation $reservation
     */
    public function removeReservation(\ProductBundle\Entity\Reservation $reservation)
    {
        $this->reservations->removeElement($reservation);
    }

    /**
     * Get reservations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservations()
    {
        return $this->reservations;
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

}
