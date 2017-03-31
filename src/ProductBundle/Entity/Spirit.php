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
}

