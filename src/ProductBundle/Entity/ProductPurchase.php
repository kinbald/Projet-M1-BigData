<?php

namespace ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ProductBundle\Entity\ProductConditioning;
use ProductBundle\Entity\Product;
use ProductBundle\Entity\Purchase;
use ProductBundle\Repository\DeliveryRepository;

/**
 * ProductPurchase
 *
 * @ORM\Table(name="product_purchase")
 * @ORM\Entity(repositoryClass="ProductBundle\Repository\ProductPurchaseRepository")
 */
class ProductPurchase
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
     * @var int
     *
     * @ORM\Column(name="stock", type="integer")
     */
    private $stock;

    /**
     * @var Product
     * @ORM\ManyToOne(targetEntity="\ProductBundle\Entity\Product", inversedBy="purchases")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $product;

    /**
     * @var Purchase
     * @ORM\ManyToOne(targetEntity="\ProductBundle\Entity\Purchase", inversedBy="products", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $purchase;

    /**
     * @var ProductConditioning
     *
     * @ORM\ManyToOne(targetEntity="\ProductBundle\Entity\ProductConditioning", inversedBy="purchases")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="conditioning_type", referencedColumnName="id")
     * })
     */
    private $conditioningType;

    /**
     * @var Delivery
     *
     * @ORM\ManyToOne(targetEntity="\ProductBundle\Entity\Delivery", inversedBy="purchases")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="delivery", referencedColumnName="id")
     * })
     */
    private $delivery;


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
     * Set stock
     *
     * @param integer $stock
     *
     * @return ProductPurchase
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
     * Set conditioningType
     *
     * @param \ProductBundle\Entity\ProductConditioning $type
     *
     * @return ProductPurchase
     */
    public function setConditioningType(ProductConditioning $type)
    {
        $this->conditioningType = $type;
        return $this;
    }

    /**
     * Get conditioningType
     *
     * @return ProductConditioning
     */
    public function getConditioningType()
    {
        return $this->conditioningType;
    }

    /**
     * Set delivery
     *
     * @param \ProductBundle\Entity\Delivery $delivery
     *
     * @return ProductPurchase
     */
    public function setDelivery(Delivery $delivery)
    {
        $this->delivery = $delivery;
        return $this;
    }

    /**
     * Get delivery
     *
     * @return Delivery
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * Set product
     *
     * @param \ProductBundle\Entity\Product $product
     *
     * @return ProductPurchase
     */
    public function setProduct(Product $product)
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
     * Set purchase
     *
     * @param \ProductBundle\Entity\Purchase $purchase
     *
     * @return ProductPurchase
     */
    public function setPurchase(\ProductBundle\Entity\Purchase $purchase)
    {
        $this->purchase = $purchase;

        return $this;
    }

    /**
     * Get purchase
     *
     * @return \ProductBundle\Entity\Purchase
     */
    public function getPurchase()
    {
        return $this->purchase;
    }
}
