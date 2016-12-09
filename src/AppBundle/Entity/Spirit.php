<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Spirit
 *
 * @ORM\Table(name="spirit")
 * @ORM\Entity
 */
class Spirit
{
    /**
     * @var float
     *
     * @ORM\Column(name="alcohol_degree", type="float", precision=10, scale=0, nullable=true)
     */
    private $alcoholDegree;

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
     * Set alcoholDegree
     *
     * @param float $alcoholDegree
     *
     * @return Spirit
     */
    public function setAlcoholDegree($alcoholDegree)
    {
        $this->alcoholDegree = $alcoholDegree;

        return $this;
    }

    /**
     * Get alcoholDegree
     *
     * @return float
     */
    public function getAlcoholDegree()
    {
        return $this->alcoholDegree;
    }

    /**
     * Set idProduct
     *
     * @param \AppBundle\Entity\Product $idProduct
     *
     * @return Spirit
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
