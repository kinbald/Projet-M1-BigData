<?php

namespace ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ProductBundle\Entity\Product;

/**
 * Spirit
 *
 * @ORM\Table(name="spirit")
 * @ORM\Entity(repositoryClass="ProductBundle\Repository\SpiritRepository")
 */
class Spirit extends Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var float
     *
     * @ORM\Column(name="alcohol_degree", type="float")
     */
    private $alcoholDegree;


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
     * Get discr
     *
     * @return string
     */
    public function getDiscr()
    {
        return 'spirit';
    }

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
}

