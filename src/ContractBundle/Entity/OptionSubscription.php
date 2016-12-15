<?php

namespace ContractBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
}

