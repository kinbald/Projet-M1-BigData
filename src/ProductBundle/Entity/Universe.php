<?php

namespace ProductBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ProductBundle\Entity\PictureUniverse;
use ProductBundle\Entity\Product;

/**
 * Universe
 *
 * @ORM\Table(name="universe")
 * @ORM\Entity(repositoryClass="ProductBundle\Repository\UniverseRepository")
 */
class Universe
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var PictureUniverse
     *
     * @ORM\OneToMany(targetEntity="\ProductBundle\Entity\PictureUniverse", mappedBy="universe")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $pictures;

    /**
     * @var Product
     * @ORM\ManyToMany(targetEntity="\ProductBundle\Entity\Product", cascade={"persist"}, mappedBy="universes")
     * @ORM\JoinColumn(name="universe_id", referencedColumnName="id")
     */
    private $products;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="ConcoursBundle\Entity\CompetitionWine", mappedBy="universe")
     */
    private $competitions;


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
     * Constructor
     */
    public function __construct()
    {
        $this->pictures = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Add picture
     *
     * @param \ProductBundle\Entity\PictureUniverse $picture
     *
     * @return Universe
     */
    public function addPicture(\ProductBundle\Entity\PictureUniverse $picture)
    {
        $this->pictures[] = $picture;

        return $this;
    }

    /**
     * Remove picture
     *
     * @param \ProductBundle\Entity\PictureUniverse $picture
     */
    public function removePicture(\ProductBundle\Entity\PictureUniverse $picture)
    {
        $this->pictures->removeElement($picture);
    }

    /**
     * Get pictures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * Add product
     *
     * @param \ProductBundle\Entity\Product $product
     *
     * @return Universe
     */
    public function addProduct(\ProductBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \ProductBundle\Entity\Product $product
     */
    public function removeProduct(\ProductBundle\Entity\Product $product)
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
     * Add competition
     *
     * @param \ConcoursBundle\Entity\CompetitionWine $competition
     *
     * @return Universe
     */
    public function addCompetition(\ConcoursBundle\Entity\CompetitionWine $competition)
    {
        $this->competitions[] = $competition;

        return $this;
    }

    /**
     * Remove competition
     *
     * @param \ConcoursBundle\Entity\CompetitionWine $competition
     */
    public function removeCompetition(\ConcoursBundle\Entity\CompetitionWine $competition)
    {
        $this->competitions->removeElement($competition);
    }

    /**
     * Get Collection
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompetitions()
    {
        return $this->competitions;
    }



}
