<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ProductBundle\Entity\Purchase;
use UserBundle\Entity\UserConsumer;

/**
 * BaseUser
 *
 * @ORM\Table(name="base_user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\BaseUserRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"consumer" = "UserConsumer", "media" = "UserMedia", "producer" = "UserProducer"})
 */
abstract class BaseUser
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
        $this->purchases = new \Doctrine\Common\Collections\ArrayCollection();
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
}
