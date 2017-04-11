<?php

namespace ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ProductBundle\Entity\Product;
use UserBundle\Entity\UserConsumer;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * ProductEvaluation
 *
 * @ORM\Table(name="product_evaluation")
 * @ORM\Entity(repositoryClass="ProductBundle\Repository\ProductEvaluationRepository")
 * @UniqueEntity(
 *     fields={"user", "product"},
 *     errorPath="user",
 *     message="You have already commented this product, motherfucker"
 * )
 */
class ProductEvaluation
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
     * @var int
     * @Assert\NotBlank(message="mark should not be empty")
     * @ORM\Column(name="mark", type="integer")
     */
    private $mark;

    /**
     * @var string
     * @Assert\NotBlank(message="review should not be empty")
     * @ORM\Column(name="review", type="string", length=255)
     */
    private $review;

    /**
     * @var Product
     * @ORM\ManyToOne(targetEntity="ProductBundle\Entity\Product", inversedBy="evaluations")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $product;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;



    /**
     * @var UserConsumer
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\UserConsumer", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


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
     * Set mark
     *
     * @param integer $mark
     *
     * @return ProductEvaluation
     */
    public function setMark($mark)
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * Get mark
     *
     * @return int
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set review
     *
     * @param string $review
     *
     * @return ProductEvaluation
     */
    public function setReview($review)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Get review
     *
     * @return string
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return ProductEvaluation
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set product
     *
     * @param \ProductBundle\Entity\Product $product
     *
     * @return ProductEvaluation
     */
    public function setProduct(\ProductBundle\Entity\Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \ProductBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\UserConsumer $user
     *
     * @return ProductEvaluation
     */
    public function setUser(\UserBundle\Entity\UserConsumer $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\UserConsumer
     */
    public function getUser()
    {
        return $this->user;
    }
}
