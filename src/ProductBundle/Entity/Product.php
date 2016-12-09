<?php

namespace ProductBundle\Entity;

use ConcoursBundle\Entity\Order;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ProductBundle\Entity\Competition;
use ProductBundle\Entity\Universe;
use UserBundle\Entity\User;

/**
 * Product
 *
 * @ORM\Table(name="product", indexes={@ORM\Index(name="IDX_D34A04ADA8866FD5", columns={"id_user_product"})})
 * @ORM\Entity
 */
class Product
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=2000, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=2000, nullable=true)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="volume", type="float", precision=10, scale=0, nullable=false)
     */
    private $volume;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=15, scale=3, nullable=false)
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock", type="integer", nullable=true)
     */
    private $stock;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="product_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_product", referencedColumnName="id")
     * })
     */
    private $idUserProduct;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Competition", mappedBy="idProduct")
     */
    private $idCompetition;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Order", mappedBy="idProduct")
     */
    private $idOrder;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Universe", inversedBy="idProduct")
     * @ORM\JoinTable(name="product_universe",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_product", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_universe", referencedColumnName="id")
     *   }
     * )
     */
    private $idUniverse;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", inversedBy="idProduct")
     * @ORM\JoinTable(name="product_evaluation",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_product", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     *   }
     * )
     */
    private $idUser;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCompetition = new ArrayCollection();
        $this->idOrder = new ArrayCollection();
        $this->idUniverse = new ArrayCollection();
        $this->idUser = new ArrayCollection();
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
     * @param string $price
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
     * @return string
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
     * @return integer
     */
    public function getStock()
    {
        return $this->stock;
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
     * Set idUserProduct
     *
     * @param User $idUserProduct
     *
     * @return Product
     */
    public function setIdUserProduct(User $idUserProduct = null)
    {
        $this->idUserProduct = $idUserProduct;

        return $this;
    }

    /**
     * Get idUserProduct
     *
     * @return User
     */
    public function getIdUserProduct()
    {
        return $this->idUserProduct;
    }

    /**
     * Add idCompetition
     *
     * @param Competition $idCompetition
     *
     * @return Product
     */
    public function addIdCompetition(Competition $idCompetition)
    {
        $this->idCompetition[] = $idCompetition;

        return $this;
    }

    /**
     * Remove idCompetition
     *
     * @param Competition $idCompetition
     */
    public function removeIdCompetition(Competition $idCompetition)
    {
        $this->idCompetition->removeElement($idCompetition);
    }

    /**
     * Get idCompetition
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdCompetition()
    {
        return $this->idCompetition;
    }

    /**
     * Add idOrder
     *
     * @param Order $idOrder
     *
     * @return Product
     */
    public function addIdOrder(Order $idOrder)
    {
        $this->idOrder[] = $idOrder;

        return $this;
    }

    /**
     * Remove idOrder
     *
     * @param Order $idOrder
     */
    public function removeIdOrder(Order $idOrder)
    {
        $this->idOrder->removeElement($idOrder);
    }

    /**
     * Get idOrder
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdOrder()
    {
        return $this->idOrder;
    }

    /**
     * Add idUniverse
     *
     * @param Universe $idUniverse
     *
     * @return Product
     */
    public function addIdUniverse(Universe $idUniverse)
    {
        $this->idUniverse[] = $idUniverse;

        return $this;
    }

    /**
     * Remove idUniverse
     *
     * @param Universe $idUniverse
     */
    public function removeIdUniverse(Universe $idUniverse)
    {
        $this->idUniverse->removeElement($idUniverse);
    }

    /**
     * Get idUniverse
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdUniverse()
    {
        return $this->idUniverse;
    }

    /**
     * Add idUser
     *
     * @param User $idUser
     *
     * @return Product
     */
    public function addIdUser(User $idUser)
    {
        $this->idUser[] = $idUser;

        return $this;
    }

    /**
     * Remove idUser
     *
     * @param User $idUser
     */
    public function removeIdUser(User $idUser)
    {
        $this->idUser->removeElement($idUser);
    }

    /**
     * Get idUser
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}
