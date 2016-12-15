<?php

namespace ProductBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ProductBundle\Entity\Universe;

/**
 * PictureUniverse
 *
 * @ORM\Table(name="picture_universe")
 * @ORM\Entity(repositoryClass="ProductBundle\Repository\PictureUniverseRepository")
 */
class PictureUniverse
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
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var Universe
     * @ORM\ManyToOne(targetEntity="\ProductBundle\Entity\Universe", inversedBy="pictures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $universe;
    

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
     * Set alt
     *
     * @param string $alt
     *
     * @return PictureUniverse
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
     * @return PictureUniverse
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
     * Set universe
     *
     * @param \ProductBundle\Universe $universe
     *
     * @return PictureUniverse
     */
    public function setUniverse(\ProductBundle\Universe $universe)
    {
        $this->universe = $universe;

        return $this;
    }

    /**
     * Get universe
     *
     * @return \ProductBundle\Universe
     */
    public function getUniverse()
    {
        return $this->universe;
    }

}
