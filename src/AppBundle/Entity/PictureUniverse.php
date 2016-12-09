<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PictureUniverse
 *
 * @ORM\Table(name="picture_universe", uniqueConstraints={@ORM\UniqueConstraint(name="picture_universe_url_key", columns={"url"})}, indexes={@ORM\Index(name="IDX_9F5AD3931EED4A0", columns={"id_universe"})})
 * @ORM\Entity
 */
class PictureUniverse
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
     * @ORM\SequenceGenerator(sequenceName="picture_universe_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Universe
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Universe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_universe", referencedColumnName="id")
     * })
     */
    private $idUniverse;



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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idUniverse
     *
     * @param \AppBundle\Entity\Universe $idUniverse
     *
     * @return PictureUniverse
     */
    public function setIdUniverse(\AppBundle\Entity\Universe $idUniverse = null)
    {
        $this->idUniverse = $idUniverse;

        return $this;
    }

    /**
     * Get idUniverse
     *
     * @return \AppBundle\Entity\Universe
     */
    public function getIdUniverse()
    {
        return $this->idUniverse;
    }
}
