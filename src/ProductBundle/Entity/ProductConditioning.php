<?php

namespace ProductBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ProductBundle\Entity\Delivery;
use ProductBundle\Entity\Pack;
use ProductBundle\Entity\Product;
use ProductBundle\Entity\ProductPurchase;
use UserBundle\Entity\BaseUser;
use UserBundle\Entity\UserWholesale;

/**
 * ProductConditioning
 *
 * @ORM\Table(name="product_conditioning")
 * @ORM\Entity(repositoryClass="ProductBundle\Repository\ProductConditioningRepository")
 */
class ProductConditioning
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
     * @var float
     *
     * @ORM\Column(name="pub_price", type="float")
     */
    private $pubPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="pro_price", type="float")
     */
    private $proPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="volume_value", type="float")
     */
    private $volumeValue;

    /**
     * @var string
     *
     * @ORM\Column(name="volume_unit", type="string", length=25)
     */
    private $volumeUnit;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock", type="integer")
     */
    private $stock;

    /**
     *@ORM\OneToOne(targetEntity="\ProductBundle\Entity\Pack", cascade={"persist"})
     *
     */
    private $pack;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="\ProductBundle\Entity\Product", cascade={"persist"}, mappedBy="conditioningTypes")
     */
    private $products;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="\ProductBundle\Entity\ProductPurchase", mappedBy="conditioningType")
     */
    private $purchases;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="\ProductBundle\Entity\Delivery", mappedBy="conditioningTypes")
     */
    protected $deliveries;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->purchases = new ArrayCollection();
        $this->deliveries = new ArrayCollection();
    }

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
     * Set price
     * @deprecated
     *
     * @param float $price
     *
     * @return ProductConditioning
     */
    public function setPrice($price)
    {
        $this->pubPrice = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice($user = null)
    {
        return ($user instanceof UserWholesale)?$this->proPrice:$this->pubPrice;
    }


    /**
     * Set name
     *
     * @param string $name
     *
     * @return ProductConditioning
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
     * Set pubPrice
     *
     * @param float $pubPrice
     *
     * @return ProductConditioning
     */
    public function setPubPrice($pubPrice)
    {
        $this->pubPrice = $pubPrice;

        return $this;
    }

    /**
     * Get pubPrice
     *
     * @return float
     */
    public function getPubPrice()
    {
        return $this->pubPrice;
    }

    /**
     * Set proPrice
     *
     * @param float $proPrice
     *
     * @return ProductConditioning
     */
    public function setProPrice($proPrice)
    {
        $this->proPrice = $proPrice;

        return $this;
    }

    /**
     * Get proPrice
     *
     * @return float
     */
    public function getProPrice()
    {
        return $this->proPrice;
    }

    /**
     * Set volumeValue
     *
     * @param float $volumeValue
     *
     * @return ProductConditioning
     */
    public function setVolumeValue($volumeValue)
    {
        $this->volumeValue = $volumeValue;

        return $this;
    }

    /**
     * Get volumeValue
     *
     * @return float
     */
    public function getVolumeValue()
    {
        return $this->volumeValue;
    }

    /**
     * Set volumeUnit
     *
     * @param string $volumeUnit
     *
     * @return ProductConditioning
     */
    public function setVolumeUnit($volumeUnit)
    {
        $this->volumeUnit = $volumeUnit;

        return $this;
    }

    /**
     * Get volumeUnit
     *
     * @return string
     */
    public function getVolumeUnit()
    {
        return $this->volumeUnit;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     *
     * @return ProductConditioning
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer
     */
    public function getStock()
    {
        return $this->stock;
    }



    /**
     * Add product
     *
     * @param Product $product
     *
     * @return ProductConditioning
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param Product $product
     */
    public function removeProduct(Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Add purchase
     *
     * @param ProductPurchase $purchase
     *
     * @return ProductConditioning
     */
    public function addPurchase(ProductPurchase $purchase)
    {
        $this->purchases[] = $purchase;

        return $this;
    }

    /**
     * Remove purchase
     *
     * @param ProductPurchase $purchase
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
     * Add delivery
     *
     * @param Delivery $delivery
     *
     * @return ProductConditioning
     */
    public function addDelivery(Delivery $delivery)
    {
        $this->deliveries[] = $delivery;

        return $this;
    }

    /**
     * Remove delivery
     *
     * @param Delivery $delivery
     */
    public function removeDelivery(Delivery $delivery)
    {
        $this->deliveries->removeElement($delivery);
    }

    /**
     * Get deliveries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDeliveries()
    {
        return $this->deliveries;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Set pack
     *
     * @param Pack $pack
     *
     * @return ProductConditioning
     */
    public function setPack(Pack $pack = null)
    {
        $this->pack = $pack;

        return $this;
    }

    /**
     * Get pack
     *
     * @return Pack
     */
    public function getPack()
    {
        return $this->pack;
    }
}
