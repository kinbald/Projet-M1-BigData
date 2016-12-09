<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_product", referencedColumnName="id")
     * })
     */
    private $idUserProduct;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Competition", mappedBy="idProduct")
     */
    private $idCompetition;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Order", mappedBy="idProduct")
     */
    private $idOrder;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Universe", inversedBy="idProduct")
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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", inversedBy="idProduct")
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
        $this->idCompetition = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idOrder = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idUniverse = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idUser = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param \AppBundle\Entity\User $idUserProduct
     *
     * @return Product
     */
    public function setIdUserProduct(\AppBundle\Entity\User $idUserProduct = null)
    {
        $this->idUserProduct = $idUserProduct;

        return $this;
    }

    /**
     * Get idUserProduct
     *
     * @return \AppBundle\Entity\User
     */
    public function getIdUserProduct()
    {
        return $this->idUserProduct;
    }

    /**
     * Add idCompetition
     *
     * @param \AppBundle\Entity\Competition $idCompetition
     *
     * @return Product
     */
    public function addIdCompetition(\AppBundle\Entity\Competition $idCompetition)
    {
        $this->idCompetition[] = $idCompetition;

        return $this;
    }

    /**
     * Remove idCompetition
     *
     * @param \AppBundle\Entity\Competition $idCompetition
     */
    public function removeIdCompetition(\AppBundle\Entity\Competition $idCompetition)
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
     * @param \AppBundle\Entity\Order $idOrder
     *
     * @return Product
     */
    public function addIdOrder(\AppBundle\Entity\Order $idOrder)
    {
        $this->idOrder[] = $idOrder;

        return $this;
    }

    /**
     * Remove idOrder
     *
     * @param \AppBundle\Entity\Order $idOrder
     */
    public function removeIdOrder(\AppBundle\Entity\Order $idOrder)
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
     * @param \AppBundle\Entity\Universe $idUniverse
     *
     * @return Product
     */
    public function addIdUniverse(\AppBundle\Entity\Universe $idUniverse)
    {
        $this->idUniverse[] = $idUniverse;

        return $this;
    }

    /**
     * Remove idUniverse
     *
     * @param \AppBundle\Entity\Universe $idUniverse
     */
    public function removeIdUniverse(\AppBundle\Entity\Universe $idUniverse)
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
     * @param \AppBundle\Entity\User $idUser
     *
     * @return Product
     */
    public function addIdUser(\AppBundle\Entity\User $idUser)
    {
        $this->idUser[] = $idUser;

        return $this;
    }

    /**
     * Remove idUser
     *
     * @param \AppBundle\Entity\User $idUser
     */
    public function removeIdUser(\AppBundle\Entity\User $idUser)
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
