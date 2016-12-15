<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserMedia
 *
 * @ORM\Table(name="user_media")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserMediaRepository")
 */
class UserMedia
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
     * @ORM\Column(name="company_name", type="string", length=255)
     */
    private $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="url_blog", type="string", length=255)
     */
    private $urlBlog;

    /**
     * @var string
     *
     * @ORM\Column(name="id_presse", type="string", length=255)
     */
    private $idPresse;


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
     * Set companyName
     *
     * @param string $companyName
     *
     * @return UserMedia
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set urlBlog
     *
     * @param string $urlBlog
     *
     * @return UserMedia
     */
    public function setUrlBlog($urlBlog)
    {
        $this->urlBlog = $urlBlog;

        return $this;
    }

    /**
     * Get urlBlog
     *
     * @return string
     */
    public function getUrlBlog()
    {
        return $this->urlBlog;
    }

    /**
     * Set idPresse
     *
     * @param string $idPresse
     *
     * @return UserMedia
     */
    public function setIdPresse($idPresse)
    {
        $this->idPresse = $idPresse;

        return $this;
    }

    /**
     * Get idPresse
     *
     * @return string
     */
    public function getIdPresse()
    {
        return $this->idPresse;
    }
}

