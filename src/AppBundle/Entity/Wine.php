<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wine
 *
 * @ORM\Table(name="wine")
 * @ORM\Entity
 */
class Wine
{
    /**
     * @var integer
     *
     * @ORM\Column(name="vintage", type="integer", nullable=false)
     */
    private $vintage;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=2000, nullable=true)
     */
    private $color;

    /**
     * @var \AppBundle\Entity\Product
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_product", referencedColumnName="id")
     * })
     */
    private $idProduct;



    /**
     * Set vintage
     *
     * @param integer $vintage
     *
     * @return Wine
     */
    public function setVintage($vintage)
    {
        $this->vintage = $vintage;

        return $this;
    }

    /**
     * Get vintage
     *
     * @return integer
     */
    public function getVintage()
    {
        return $this->vintage;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Wine
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set idProduct
     *
     * @param \AppBundle\Entity\Product $idProduct
     *
     * @return Wine
     */
    public function setIdProduct(\AppBundle\Entity\Product $idProduct)
    {
        $this->idProduct = $idProduct;

        return $this;
    }

    /**
     * Get idProduct
     *
     * @return \AppBundle\Entity\Product
     */
    public function getIdProduct()
    {
        return $this->idProduct;
    }
}
