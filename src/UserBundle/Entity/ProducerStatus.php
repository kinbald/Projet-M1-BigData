<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ProducerStatus
 *
 * @ORM\Table(name="producer_status")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\ProducerStatusRepository")
 */
class ProducerStatus
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
     * @var Collection
     * @ORM\OneToMany(targetEntity="\UserBundle\Entity\UserProducer", mappedBy="status")
     */
    private $userProducer;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userProducer = new ArrayCollection();
    }


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
     * @return ProducerStatus
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
     * Add product
     *
     * @param UserProducer $user
     *
     * @return ProducerStatus
     */
    public function addUserProducer(UserProducer $user)
    {
        $this->userProducer[] = $user;
        return $this;
    }

    /**
     * Remove product
     *
     * @param UserProducer $user
     */
    public function removeUserProducer(UserProducer $user)
    {
        $this->userProducer->removeElement($user);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserProducers()
    {
        return $this->userProducer;
    }


}

