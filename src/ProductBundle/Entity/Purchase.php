<?php

namespace ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ProductBundle\Entity\Product;
use DateTime;
use UserBundle\Entity\BaseUser;

/**
 * Purchase
 *
 * @ORM\Table(name="purchase")
 * @ORM\Entity(repositoryClass="ProductBundle\Repository\PurchaseRepository")
 */
class Purchase
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
     * @ORM\Column(name="address", type="text", nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_code", type="string", length=10, nullable=true)
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=100, nullable=true)
     */
    private $country;

    /**
     * @var bool
     *
     * @ORM\Column(name="done", type="boolean", nullable=true)
     */
    private $done;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_order", type="datetime")
     */
    private $dateOrder;

    /**
     * @var bool
     * @ORM\Column(name="paid", type="boolean", nullable = true)
     */
    private $paid;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=15)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;


    /**
     * @var BaseUser
     * @ORM\ManyToOne(targetEntity="\UserBundle\Entity\BaseUser", inversedBy="purchases")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @var Product
     * @ORM\OneToMany(targetEntity="ProductBundle\Entity\ProductPurchase", mappedBy="purchase")
     */
    private $products;


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
     * Set address
     *
     * @param string $address
     *
     * @return Purchase
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Purchase
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     *
     * @return Purchase
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Purchase
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set done
     *
     * @param boolean $done
     *
     * @return Purchase
     */
    public function setDone($done)
    {
        $this->done = $done;

        return $this;
    }

    /**
     * Get done
     *
     * @return bool
     */
    public function getDone()
    {
        return $this->done===null?false:$this->done;
    }

    /**
     * Set dateOrder
     *
     * @param \DateTime $dateOrder
     *
     * @return Purchase
     */
    public function setDateOrder($dateOrder)
    {
        $this->dateOrder = $dateOrder;

        return $this;
    }

    /**
     * Get dateOrder
     *
     * @return \DateTime
     */
    public function getDateOrder()
    {
        return $this->dateOrder;
    }



    /**
     * Set user
     *
     * @param \UserBundle\Entity\BaseUser $user
     *
     * @return Purchase
     */
    public function setUser(\UserBundle\Entity\BaseUser $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\BaseUser
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dateOrder = new DateTime();
        $this->paid = false;
        $this->address = 'addr';
        $this->city = 'Toulon';
        $this->postalCode = '83000';
        $this->country = 'FR';
        $this->done = false;
        $this->firstname = 'Jérémy';
        $this->lastname = 'Tablet';
        $this->phone = '1111111111';
    }

    /**
     * Add product
     *
     * @param \ProductBundle\Entity\ProductPurchase $product
     *
     * @return Purchase
     */
    public function addProduct(\ProductBundle\Entity\ProductPurchase $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \ProductBundle\Entity\ProductPurchase $product
     */
    public function removeProduct(\ProductBundle\Entity\ProductPurchase $product)
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
     * Get purchase amount
     * @return int
     */
    public function getAmount(){
        $amount = 0;
        foreach ($this->products as $product){
            $amount += $product->getStock()*$product->getProduct()->getPrice();
        }
        return $amount;
    }

    /**
     * Get purchase number of articles
     * @return int
     */
    public function getNbArticles(){
        $nbArticles = 0;
        foreach ($this->products as $product){
            $nbArticles += $product->getStock();
        }
        return $nbArticles;
    }


    /**
     * Set paid
     *
     * @param boolean $paid
     *
     * @return Purchase
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;

        return $this;
    }

    /**
     * Get paid
     *
     * @return boolean
     */
    public function getPaid()
    {
        return $this->paid===null?false:$this->paid;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Purchase
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Purchase
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Purchase
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

}
