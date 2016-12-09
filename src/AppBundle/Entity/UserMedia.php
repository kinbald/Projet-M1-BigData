<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserMedia
 *
 * @ORM\Table(name="user_media")
 * @ORM\Entity
 */
class UserMedia
{
    /**
     * @var string
     *
     * @ORM\Column(name="company_name", type="string", length=2000, nullable=true)
     */
    private $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="url_blog", type="string", length=2000, nullable=true)
     */
    private $urlBlog;

    /**
     * @var string
     *
     * @ORM\Column(name="id_presse", type="string", length=2000, nullable=true)
     */
    private $idPresse;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;



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

    /**
     * Set idUser
     *
     * @param \AppBundle\Entity\User $idUser
     *
     * @return UserMedia
     */
    public function setIdUser(\AppBundle\Entity\User $idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \AppBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}
