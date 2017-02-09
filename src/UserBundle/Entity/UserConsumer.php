<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ProductBundle\Entity\ProductEvaluation;
use UserBundle\Entity\BaseUser;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * UserConsumer
 *
 * @ORM\Table(name="user_consumer")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserConsumerRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields = "username", targetClass = "UserBundle\Entity\BaseUser", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "UserBundle\Entity\BaseUser", message="fos_user.email.already_used")
 */
class UserConsumer extends BaseUser
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
     * @ORM\Column(name="sex", type="string", length=10)
     */
    private $sex;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth_date", type="date")
     */
    private $birthDate;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=15)
     */
    private $phone;

    /**
     * @var ProductEvaluation
     *
     * @ORM\OneToMany(targetEntity="ProductBundle\Entity\ProductEvaluation", mappedBy="user")
     */
    private $products;

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
     * Set sex
     *
     * @param string $sex
     *
     * @return UserConsumer
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return UserConsumer
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Add product
     *
     * @param ProductEvaluation $product
     *
     * @return UserConsumer
     */
    public function addProduct(ProductEvaluation $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param ProductEvaluation $product
     */
    public function removeProduct(ProductEvaluation $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return ProductEvaluation
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @ORM\PrePersist
     */
    public function setRegisterRole(){
        $this->addRole('ROLE_CONSUMER');
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return UserConsumer
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
}
