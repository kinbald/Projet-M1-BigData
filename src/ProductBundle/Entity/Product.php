<?php

namespace ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ProductBundle\Entity\PictureProduct;
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
     * @var PictureProduct
     *
     * @ORM\OneToMany(targetEntity="\ProductBundle\Entity\PictureProduct", mappedBy="product")
     */
    protected $pictures;

    /**
     * @var Universe
     * @ORM\ManyToMany(targetEntity="\ProductBundle\Entity\Universe", inversedBy="products")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $universes;

    /**
     * @var ProductPurchase
     * @ORM\OneToMany(targetEntity="ProductBundle\Entity\ProductPurchase", mappedBy="product")
     */
    protected $purchases;

    /**
     * @var ProductEvaluation
     * @ORM\OneToMany(targetEntity="ProductBundle\Entity\ProductEvaluation", mappedBy="product")
     */
    protected $users;

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
        $this->pictures = new \Doctrine\Common\Collections\ArrayCollection();
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
    public function getDiscr()
    {
        return null;
    }


    /**
     * Add picture
     *
     * @param \ProductBundle\Entity\PictureProduct $picture
     *
     * @return Product
     */
    public function addPicture(\ProductBundle\Entity\PictureProduct $picture)
    {
        $this->pictures[] = $picture;

        return $this;
    }

    /**
     * Remove picture
     *
     * @param \ProductBundle\Entity\PictureProduct $picture
     */
    public function removePicture(\ProductBundle\Entity\PictureProduct $picture)
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
    public function addUniverse(\ProductBundle\Entity\Universe $universe)
    {
        $this->universes[] = $universe;
        return $this;
    }

    /**
     * Remove universe
     *
     * @param \ProductBundle\Entity\Universe $universe
     */
    public function removeUniverse(\ProductBundle\Entity\Universe $universe)
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
    public function addPurchase(\ProductBundle\Entity\ProductPurchase $purchase)
    {
        $this->purchases[] = $purchase;

        return $this;
    }

    /**
     * Remove purchase
     *
     * @param \ProductBundle\Entity\ProductPurchase $purchase
     */
    public function removePurchase(\ProductBundle\Entity\ProductPurchase $purchase)
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
    public function addUser(\ProductBundle\Entity\ProductEvaluation $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \ProductBundle\Entity\ProductEvaluation $user
     */
    public function removeUser(\ProductBundle\Entity\ProductEvaluation $user)
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
}
