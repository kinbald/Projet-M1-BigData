<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ProductBundle\Entity\Purchase;
use Symfony\Component\Validator\Constraints\Date;
use UserBundle\Entity\UserConsumer;
use UserBundle\Entity\UserMedia;
use FOS\UserBundle\Model\User as FosUser;


/**
 * BaseUser
 *
 * @ORM\Table(name="base_user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\BaseUserRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"consumer" = "UserConsumer", "media" = "UserMedia", "producer" = "UserProducer", "wholesale" = "UserWholesale"})
 */
abstract class BaseUser extends FosUser
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
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sub_date", type="datetime")
     */
    private $subDate;

    /**
     * @var Purchase
     *
     * @ORM\OneToMany(targetEntity="\ProductBundle\Entity\Purchase", mappedBy="user")
     */
    private $purchases;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="\ProductBundle\Entity\Reservation", mappedBy="user_id")
     */
    private $reservations;


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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return BaseUser
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return BaseUser
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set subDate
     *
     * @param \DateTime $subDate
     *
     * @return BaseUser
     */
    public function setSubDate($subDate)
    {
        $this->subDate = $subDate;

        return $this;
    }

    /**
     * Get subDate
     *
     * @return \DateTime
     */
    public function getSubDate()
    {
        return $this->subDate;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->purchases = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reservations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subDate = new \DateTime();
    }

    /**
     * Add purchase
     *
     * @param \ProductBundle\Entity\Purchase $purchase
     *
     * @return BaseUser
     */
    public function addPurchase(\ProductBundle\Entity\Purchase $purchase)
    {
        $this->purchases[] = $purchase;

        return $this;
    }

    /**
     * Remove purchase
     *
     * @param \ProductBundle\Entity\Purchase $purchase
     */
    public function removePurchase(\ProductBundle\Entity\Purchase $purchase)
    {
        $this->purchases->removeElement($purchase);
    }

    /**
     * Get purchases
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPurchases()
    {
        return $this->purchases;
    }

    /**
     * Add reservation
     *
     * @param \ProductBundle\Entity\Reservation $reservation
     *
     * @return BaseUser
     */
    public function addReservation(\ProductBundle\Entity\Reservation $reservation)
    {
        $this->reservations[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation
     *
     * @param \ProductBundle\Entity\Reservation $reservation
     */
    public function removeReservation(\ProductBundle\Entity\Reservation $reservation)
    {
        $this->reservations->removeElement($reservation);
    }

    /**
     * Get reservation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservation()
    {
        return $this->reservations;
    }
}
