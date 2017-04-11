<?php

namespace ProductBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\BaseUser;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="ProductBundle\Repository\ReservationRepository")
 */
class Reservation
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
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


    /**
     * @var ProductConditioning
     * @ORM\ManyToOne(targetEntity="\ProductBundle\Entity\ProductConditioning", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     * })
     */
    private $productConditioning;

    /**
     * @var BaseUser
     *
     * @ORM\ManyToOne(targetEntity="\UserBundle\Entity\BaseUser", inversedBy="reservations")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;


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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Reservation
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Reservation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set productConditioning
     *
     * @param \ProductBundle\Entity\ProductConditioning $productConditioning
     *
     * @return Reservation
     */
    public function setProductConditioning(\ProductBundle\Entity\ProductConditioning $productConditioning)
    {
        $this->productConditioning = $productConditioning;
        return $this;
    }

    /**
     * Get productConditioning
     *
     * @return ProductConditioning
     */
    public function getProductConditioning()
    {
        return $this->productConditioning;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\BaseUser $user
     *
     * @return Reservation
     */
    public function setUser(\UserBundle\Entity\BaseUser $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\BaseUser
     */
    public function getUser()
    {
        return $this->user;
    }
}
