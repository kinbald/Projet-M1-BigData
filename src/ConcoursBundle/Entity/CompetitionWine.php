<?php

namespace ConcoursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompetitionWine
 *
 * @ORM\Table(name="competition_wine")
 * @ORM\Entity(repositoryClass="ConcoursBundle\Repository\CompetitionWineRepository")
 */
class CompetitionWine
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
     * @ORM\Column(name="prime_name", type="string", length=255)
     */
    private $primeName;


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
     * Set primeName
     *
     * @param string $primeName
     *
     * @return CompetitionWine
     */
    public function setPrimeName($primeName)
    {
        $this->primeName = $primeName;

        return $this;
    }

    /**
     * Get primeName
     *
     * @return string
     */
    public function getPrimeName()
    {
        return $this->primeName;
    }
}

