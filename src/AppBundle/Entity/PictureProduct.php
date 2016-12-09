<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PictureProduct
 *
 * @ORM\Table(name="picture_product", uniqueConstraints={@ORM\UniqueConstraint(name="picture_product_url_key", columns={"url"})}, indexes={@ORM\Index(name="IDX_CE6CF07FDD7ADDD", columns={"id_product"})})
 * @ORM\Entity
 */
class PictureProduct
{
    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=2000, nullable=false)
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=2000, nullable=false)
     */
    private $url;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="picture_product_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_product", referencedColumnName="id")
     * })
     */
    private $idProduct;



    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return PictureProduct
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return PictureProduct
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
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
     * Set idProduct
     *
     * @param \AppBundle\Entity\Product $idProduct
     *
     * @return PictureProduct
     */
    public function setIdProduct(\AppBundle\Entity\Product $idProduct = null)
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
