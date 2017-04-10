<?php

namespace ConcoursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ConcoursBundle\Entity\CompetitionProduct;

/**
 * Medal
 *
 * @ORM\Table(name="medal")
 * @ORM\Entity(repositoryClass="ConcoursBundle\Repository\MedalRepository")
 */
class Medal
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
     * @var int
     *
     * @ORM\Column(name="annee", type="integer")
     */
    private $annee;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * Competition Product
     * @ORM\OneToOne(targetEntity="ConcoursBundle\Entity\CompetitionProduct", inversedBy="medal")
     * @ORM\JoinColumn(name="competition_id", referencedColumnName="id")
     */
    private $competition;


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
     * @return Medal
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
     * Set annee
     *
     * @param integer $annee
     *
     * @return Medal
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return int
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Medal
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set competition
     *
     * @param \ConcoursBundle\Entity\CompetitionProduct $competition
     *
     * @return Medal
     */
    public function setCompetition(\ConcoursBundle\Entity\CompetitionProduct $competition = null)
    {
        $this->competition = $competition;

        return $this;
    }

    /**
     * Get competition
     *
     * @return \ConcoursBundle\Entity\CompetitionProduct
     */
    public function getCompetition()
    {
        return $this->competition;
    }
}
