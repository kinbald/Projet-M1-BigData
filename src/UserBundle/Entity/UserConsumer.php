<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ProductBundle\Entity\ProductEvaluation;
use UserBundle\Entity\BaseUser;

/**
 * UserConsumer
 *
 * @ORM\Table(name="user_consumer")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserConsumerRepository")
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
     * @ORM\Column(name="sex", type="string", length=2)
     */
    private $sex;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth_date", type="date")
     */
    private $birthDate;

    /**
     * @var ProductEvaluation
     *
     * @ORM\OneToMany(targetEntity="ProductBundle\Entity\ProductEvaluation", mappedBy="user")
     */
    private $products;


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
     * @param \ProductBundle\Entity\ProductEvaluation $product
     *
     * @return UserConsumer
     */
    public function addProduct(\ProductBundle\Entity\ProductEvaluation $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \ProductBundle\Entity\ProductEvaluation $product
     */
    public function removeProduct(\ProductBundle\Entity\ProductEvaluation $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }
}
