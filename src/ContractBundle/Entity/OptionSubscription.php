<?php

namespace ContractBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContractBundle\Entity\Option;
use UserBundle\Entity\UserProducer;

/**
 * OptionSubscription
 *
 * @ORM\Table(name="option_subscription")
 * @ORM\Entity(repositoryClass="ContractBundle\Repository\OptionSubscriptionRepository")
 */
class OptionSubscription
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_subscription", type="datetime")
     */
    private $dateSubscription;


    /**
     * @var Option
     * @ORM\ManyToOne(targetEntity="ContractBundle\Entity\Option", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $option;

    /**
     * @var UserProducer
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\UserProducer", inversedBy="options")
     * @ORM\JoinColumn(nullable=false)
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
     * Set dateSubscription
     *
     * @param \DateTime $dateSubscription
     *
     * @return OptionSubscription
     */
    public function setDateSubscription($dateSubscription)
    {
        $this->dateSubscription = $dateSubscription;

        return $this;
    }

    /**
     * Get dateSubscription
     *
     * @return \DateTime
     */
    public function getDateSubscription()
    {
        return $this->dateSubscription;
    }

    /**
     * Set option
     *
     * @param \ContractBundle\Entity\Option $option
     *
     * @return OptionSubscription
     */
    public function setOption(\ContractBundle\Entity\Option $option)
    {
        $this->option = $option;

        return $this;
    }

    /**
     * Get option
     *
     * @return \ContractBundle\Entity\Option
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\UserProducer $user
     *
     * @return OptionSubscription
     */
    public function setUser(\UserBundle\Entity\UserProducer $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\UserProducer
     */
    public function getUser()
    {
        return $this->user;
    }
}
