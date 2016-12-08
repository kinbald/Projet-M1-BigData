<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Universe
 *
 * @ORM\Table(name="universe")
 * @ORM\Entity
 */
class Universe
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
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="universe_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Product", mappedBy="idUniverse")
     */
    private $idProduct;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idProduct = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Universe
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
     * @return Universe
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
     * @param \AppBundle\Entity\Product $idProduct
     *
     * @return Universe
     */
    public function addIdProduct(\AppBundle\Entity\Product $idProduct)
    {
        $this->idProduct[] = $idProduct;

        return $this;
    }

    /**
     * Remove idProduct
     *
     * @param \AppBundle\Entity\Product $idProduct
     */
    public function removeIdProduct(\AppBundle\Entity\Product $idProduct)
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
