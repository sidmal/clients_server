<?php

namespace Authenticator\ApiSecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Clients
 *
 * @ORM\Table(name="clients")
 * @ORM\Entity(repositoryClass="Authenticator\ApiSecurityBundle\Entity\Repository\ClientsRepository")
 *
 * @ORM\HasLifecycleCallbacks
 */
class Clients implements UserInterface, EquatableInterface
{
    /**
     * @var integer
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
     * @var string
     *
     * @ORM\Column(name="secret_key", type="string", length=255)
     */
    private $secretKey;

    /**
     * @var integer
     *
     * @ORM\Column(name="auth_life_time", type="integer")
     */
    private $authLifeTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="Authenticator\ApplicationsUsersBundle\Entity\ApplicationsUsers", mappedBy="applicationId")
     */
    private $applicationAccounts;

    public function __construct()
    {
        $this->createdAt = $this->updatedAt = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Clients
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
     * Set secretKey
     *
     * @param string $secretKey
     * @return Clients
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;

        return $this;
    }

    /**
     * Get secretKey
     *
     * @return string 
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * Set authLifeTime
     *
     * @param integer $authLifeTime
     * @return Clients
     */
    public function setAuthLifeTime($authLifeTime)
    {
        $this->authLifeTime = $authLifeTime;

        return $this;
    }

    /**
     * Get authLifeTime
     *
     * @return integer 
     */
    public function getAuthLifeTime()
    {
        return $this->authLifeTime;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Clients
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Clients
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PreUpdate
     */
    public function beforeUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    public function getUserName()
    {
        $this->getId();
    }

    public function getRoles(){ return []; }

    public function getPassword()
    {
        return $this->getSecretKey();
    }

    public function getSalt(){ return ''; }

    public function eraseCredentials(){}

    public function isEqualTo(UserInterface $client)
    {
        if(!$client instanceof Clients){
            return false;
        }

        if($this->secretKey !== $client->getSecretKey()){
            return false;
        }

        if ($this->name !== $client->getName()){
            return false;
        }

        return true;
    }

    /**
     * Add applicationAccounts
     *
     * @param \Authenticator\ApplicationsUsersBundle\Entity\ApplicationsUsers $applicationAccounts
     * @return Clients
     */
    public function addApplicationAccount(\Authenticator\ApplicationsUsersBundle\Entity\ApplicationsUsers $applicationAccounts)
    {
        $this->applicationAccounts[] = $applicationAccounts;

        return $this;
    }

    /**
     * Get applicationAccounts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getApplicationAccounts()
    {
        return $this->applicationAccounts;
    }
}
