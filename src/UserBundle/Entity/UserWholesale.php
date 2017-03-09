<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\BaseUser;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * UserMedia
 *
 * @ORM\Table(name="user_wholesale")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserWholesaleRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields = "username", targetClass = "UserBundle\Entity\BaseUser", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "UserBundle\Entity\BaseUser", message="fos_user.email.already_used")
 */
class UserWholesale extends BaseUser
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
     */
    private $companyName;



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
     * @return UserWholesale
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
     * @ORM\PrePersist
     */
    public function setRegisterRole(){
        $this->addRole('ROLE_WHOLESALE');
    }
}

