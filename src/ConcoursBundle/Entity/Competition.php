<?php

namespace ConcoursBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ProductBundle\Entity\Product;

/**
 * Competition
 *
 * @ORM\Table(name="competition")
 * @ORM\Entity
 */
class Competition
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=2000, nullable=true)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_competition", type="date", nullable=true)
     */
    private $dateCompetition;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=2000, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="competition_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Product", inversedBy="idCompetition")
     * @ORM\JoinTable(name="competition_wine",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_competition", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_product", referencedColumnName="id")
     *   }
     * )
     */
    private $idProduct;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idProduct = new ArrayCollection();
    }


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Competition
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
     * Set dateCompetition
     *
     * @param \DateTime $dateCompetition
     *
     * @return Competition
     */
    public function setDateCompetition($dateCompetition)
    {
        $this->dateCompetition = $dateCompetition;

        return $this;
    }

    /**
     * Get dateCompetition
     *
     * @return \DateTime
     */
    public function getDateCompetition()
    {
        return $this->dateCompetition;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Competition
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add idProduct
     *
     * @param Product $idProduct
     *
     * @return Competition
     */
    public function addIdProduct(Product $idProduct)
    {
        $this->idProduct[] = $idProduct;

        return $this;
    }

    /**
     * Remove idProduct
     *
     * @param Product $idProduct
     */
    public function removeIdProduct(Product $idProduct)
    {
        $this->idProduct->removeElement($idProduct);
    }

    /**
     * Get idProduct
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdProduct()
    {
        return $this->idProduct;
    }
}
