<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\BaseUser;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * UserMedia
 *
 * @ORM\Table(name="user_media")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserMediaRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields = "username", targetClass = "UserBundle\Entity\BaseUser", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "UserBundle\Entity\BaseUser", message="fos_user.email.already_used")
 */
class UserMedia extends BaseUser
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
     * @ORM\Column(name="company_name", type="string", length=255)
     * @Assert\Length( max=255, maxMessage="Il faut saisir au maximum {{ limit }} caractères.")
     */
    private $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="url_blog", type="string", length=255)
     * @Assert\Length( max=255, maxMessage="Il faut saisir au maximum {{ limit }} caractères.")
     */
    private $urlBlog;

    /**
     * @var string
     *
     * @ORM\Column(name="id_presse", type="string", length=255)
     * @Assert\Length( max=255, maxMessage="Il faut saisir au maximum {{ limit }} caractères.")
     */
    private $idPresse;

    public function __construct()
    {
        parent::__construct();
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
     * @ORM\PrePersist
     */
    public function setRegisterRole(){
        $this->addRole('ROLE_MEDIA');
    }

    /**
     * @ORM\PrePersist
     */
    public function disableUser(){
        $this->enabled = false;
    }

    /**
     * Get discr
     *
     * @return string
     */
    public function getDiscr()
    {
        return 'media';
    }
}

