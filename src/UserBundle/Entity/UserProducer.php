<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ProductBundle\Entity\Product;
use Symfony\Bridge\Doctrine\Tests\Fixtures\User;
use UserBundle\Entity\BaseUser;
use ContractBundle\Entity\Option;
use ContractBundle\Entity\OptionSubscription;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * UserProducer
 *
 * @ORM\Table(name="user_producer")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserProducerRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields = "username", targetClass = "UserBundle\Entity\BaseUser", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "UserBundle\Entity\BaseUser", message="fos_user.email.already_used")
 */
class UserProducer extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="siret", type="string", length=14)
     * @Assert\Length( max=14, maxMessage="Il faut saisir au maximum {{ limit }} caractères.")
     *
     */
    private $siret;

    /**
     * @var string
     *
     * @ORM\Column(name="billing_email", nullable=true, type="string", length=255)
     * @Assert\Length( max=255, maxMessage="Il faut saisir au maximum {{ limit }} caractères.")
     */
    private $billingEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="website", nullable=true, type="string", length=255)
     * @Assert\Length( max=255, maxMessage="Il faut saisir au maximum {{ limit }} caractères.")
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", nullable=true, type="string", length=255)
     * @Assert\Length( max=255, maxMessage="Il faut saisir au maximum {{ limit }} caractères.")
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", nullable=true, type="string", length=255)
     * @Assert\Length( max=255, maxMessage="Il faut saisir au maximum {{ limit }} caractères.")
     */
    private $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="company_name", nullable=true, type="string", length=255)
     * @Assert\Length( max=255, maxMessage="Il faut saisir au maximum {{ limit }} caractères.")
     */
    private $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="business_name", type="string", length=255)
     * @Assert\Length( max=255, maxMessage="Il faut saisir au maximum {{ limit }} caractères.")
     */
    private $businessName;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     * @Assert\Length( max=255, maxMessage="Il faut saisir au maximum {{ limit }} caractères.")
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     * @Assert\Length( max=255, maxMessage="Il faut saisir au maximum {{ limit }} caractères.")
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     * @Assert\Length( max=255, maxMessage="Il faut saisir au maximum {{ limit }} caractères.")
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_code", type="string", length=10)
     * @Assert\Length( max=10, maxMessage="Il faut saisir au maximum {{ limit }} caractères.")
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=40, nullable=true)
     * @Assert\Length( max=40, maxMessage="Il faut saisir au maximum {{ limit }} caractères.")
     */
    private $state;



    /**
     * @var OptionSubscription
     * @ORM\OneToMany(targetEntity="ContractBundle\Entity\OptionSubscription", mappedBy="user")
     */
    private $options;

    /**
     * @var string
     * @ORM\Column(name="phone", type="string", length=16)
     * @Assert\Regex(
     *     pattern="/^\+?[0-9]{10,15}$/",
     *     message="Only use number, no space, except the '+' for country calling codes"
     * )
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(name="fax", nullable=true, type="string", length=15)
     * @Assert\Length( max=15, maxMessage="Il faut saisir au maximum {{ limit }} caractères.")
     */
    private $fax;

    /**
     * @var string
     * @ORM\Column(name="tva", nullable=true, type="string", length=30)
     * @Assert\Length( max=30, maxMessage="Il faut saisir au maximum {{ limit }} caractères.")

     */
    private $tvaIC;

    /**
     * @var ProducerStatus
     *
     * @ORM\ManyToOne(targetEntity="\UserBundle\Entity\ProducerStatus", inversedBy="userProducer")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="status", referencedColumnName="id", nullable=true)
     * })
     */
    private $status;


    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="\ProductBundle\Entity\Product", mappedBy="producer")
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
     * Set siret
     *
     * @param string $siret
     *
     * @return UserProducer
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret
     *
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return UserProducer
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return UserProducer
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     *
     * @return UserProducer
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     *
     * @return UserProducer
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
     * Set businessName
     *
     * @param string $businessName
     *
     * @return UserProducer
     */
    public function setBusinessName($businessName)
    {
        $this->businessName = $businessName;

        return $this;
    }

    /**
     * Get businessName
     *
     * @return string
     */
    public function getBusinessName()
    {
        return $this->businessName;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return UserProducer
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return UserProducer
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return UserProducer
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     *
     * @return UserProducer
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Add option
     *
     * @param \ContractBundle\Entity\OptionSubscription $option
     *
     * @return UserProducer
     */
    public function addOption(\ContractBundle\Entity\OptionSubscription $option)
    {
        $this->options[] = $option;

        return $this;
    }

    /**
     * Remove option
     *
     * @param \ContractBundle\Entity\OptionSubscription $option
     */
    public function removeOption(\ContractBundle\Entity\OptionSubscription $option)
    {
        $this->options->removeElement($option);
    }

    /**
     * Get options
     *
     * @return OptionSubscription
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @ORM\PrePersist
     */
    public function setRegisterRole(){
        $this->addRole('ROLE_PRODUCER');
    }

    /**
     * @ORM\PrePersist
     */
    public function disableUser(){
        $this->enabled = false;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return UserProducer
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

    public function setBillingEmail($billing)
    {
        $this->$this->setBilling($billing);
        return $this;
    }

    public function getBillingEmail()
    {
        return $this->getBilling();
    }

    /**
     * Set billingEmail
     *
     * @param string $billing
     *
     * @return UserProducer
     */
    public function setBilling($billing)
    {
        $this->billingEmail = $billing;

        return $this;
    }

    /**
     * Get billingEmail
     *
     * @return string
     */
    public function getBilling()
    {
        return $this->billingEmail;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return UserProducer
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set tvaIC
     *
     * @param string $tva
     *
     * @return UserProducer
     */
    public function setTvaIC($tva)
    {
        $this->tvaIC = $tva;
        return $this;
    }

    /**
     * Get tvaIC
     *
     * @return string
     */
    public function getTvaIC()
    {
        return $this->tvaIC;
    }

    /**
     * Set status
     *
     * @param ProducerStatus $status
     * @return UserProducer
     */
    public function setStatus(ProducerStatus $status = null)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return ProducerStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function getProvince()
    {
        return $this->getState();
    }

    public function setProvince($province)
    {
        $this->setState($province);
        return $this;
    }

    /**
     * Get State
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }



    /**
     * Add product
     *
     * @param Product $product
     *
     * @return UserProducer
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
        return $this;
    }

    /**
     * Remove product
     *
     * @param Product $product
     */
    public function removeProduct(Product $product)
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

    /**
     * Get displayName
     *
     * @return string
     */
    public function getDisplayName()
    {
        return ($this->companyName == null) ? $this->businessName : $this->companyName;
    }

    /**
     * Get discr
     *
     * @return string
     */
    public function getDiscr()
    {
        return 'producer';
    }

    public function getFullName(){
        return $this->getLastname().' '.$this->getFirstname();
    }

}
