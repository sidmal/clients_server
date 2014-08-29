<?php

namespace Authenticator\ApplicationsUsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * ApplicationsUsers
 *
 * @ORM\Table(name="applications_users")
 * @ORM\Entity
 *
 * @ORM\HasLifecycleCallbacks
 */
class ApplicationsUsers
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
     * @var integer
     *
     * @ORM\Column(name="application_user_id", type="integer")
     *
     * @Assert\NotBlank(message="Параметр 'id' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'id' не может быть равным null.")
     * @Assert\Type(type="integer", message="Значение параметра 'id' имеет не корректный тип данных.")
     */
    private $applicationUserId;

    /**
     * @var integer
     *
     * @ORM\Column(name="account_type", type="integer")
     *
     * @Assert\NotBlank(message="Параметр 'account_type' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'account_type' не может быть равным null.")
     * @Assert\Type(type="integer", message="Значение параметра 'account_type' имеет не корректный тип данных.")
     * @Assert\Choice(choices = {0, 1}, message = "Значение параметра 'account_type' указано не верно.")
     */
    private $accountType;

    /**
     * @var string
     *
     * @ORM\Column(name="account_name", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'account_name' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'account_name' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'account_name' имеет не корректный тип данных.")
     * @Assert\Length(
     *      min=2,
     *      max=255,
     *      minMessage="Значение параметра 'account_name' содержит менее допустимого количества символов.",
     *      maxMessage="Значение параметра 'account_name' содержит более допустимого количества символов."
     * )
     */
    private $accountName;

    /**
     * @var string
     *
     * @ORM\Column(name="account_value", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'account_value' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'account_value' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'account_value' имеет не корректный тип данных.")
     * @Assert\Length(
     *      min=2,
     *      max=255,
     *      minMessage="Значение параметра 'account_value' содержит менее допустимого количества символов.",
     *      maxMessage="Значение параметра 'account_value' содержит более допустимого количества символов."
     * )
     */
    private $accountValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="authorisation_type", type="integer")
     *
     * @Assert\NotBlank(message="Параметр 'authorisation_type' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'authorisation_type' не может быть равным null.")
     * @Assert\Type(type="integer", message="Значение параметра 'authorisation_type' имеет не корректный тип данных.")
     * @Assert\Choice(choices = {0, 1}, message = "Значение параметра 'authorisation_type' указано не верно.")
     */
    private $authorisationType;

    /**
     * @var string
     *
     * @ORM\Column(name="password_hash", type="string", length=255)
     */
    private $passwordHash;

    /**
     * @var string
     *
     * @ORM\Column(name="password_hash_type", type="string", length=255)
     */
    private $passwordHashType;

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
     * @ORM\OneToOne(targetEntity="IndividualPersonalData", mappedBy="applicationsUser")
     */
    private $accountIndividual;

    /**
     * @ORM\OneToOne(targetEntity="LegalEntityPersonalData", mappedBy="applicationsUser")
     */
    private $accountLegalEntity;

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
     * Set applicationUserId
     *
     * @param integer $applicationUserId
     * @return ApplicationsUsers
     */
    public function setApplicationUserId($applicationUserId)
    {
        $this->applicationUserId = $applicationUserId;

        return $this;
    }

    /**
     * Get applicationUserId
     *
     * @return integer 
     */
    public function getApplicationUserId()
    {
        return $this->applicationUserId;
    }

    /**
     * Set accountType
     *
     * @param integer $accountType
     * @return ApplicationsUsers
     */
    public function setAccountType($accountType)
    {
        $this->accountType = $accountType;

        return $this;
    }

    /**
     * Get accountType
     *
     * @return integer 
     */
    public function getAccountType()
    {
        return $this->accountType;
    }

    /**
     * Set accountName
     *
     * @param string $accountName
     * @return ApplicationsUsers
     */
    public function setAccountName($accountName)
    {
        $this->accountName = $accountName;

        return $this;
    }

    /**
     * Get accountName
     *
     * @return string 
     */
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     * Set accountValue
     *
     * @param string $accountValue
     * @return ApplicationsUsers
     */
    public function setAccountValue($accountValue)
    {
        $this->accountValue = $accountValue;

        return $this;
    }

    /**
     * Get accountValue
     *
     * @return string 
     */
    public function getAccountValue()
    {
        return $this->accountValue;
    }

    /**
     * Set authorisationType
     *
     * @param integer $authorisationType
     * @return ApplicationsUsers
     */
    public function setAuthorisationType($authorisationType)
    {
        $this->authorisationType = $authorisationType;

        return $this;
    }

    /**
     * Get authorisationType
     *
     * @return integer 
     */
    public function getAuthorisationType()
    {
        return $this->authorisationType;
    }

    /**
     * Set passwordHash
     *
     * @param string $passwordHash
     * @return ApplicationsUsers
     */
    public function setPasswordHash($passwordHash)
    {
        $this->passwordHash = $passwordHash;

        return $this;
    }

    /**
     * Get passwordHash
     *
     * @return string 
     */
    public function getPasswordHash()
    {
        return $this->passwordHash;
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

    /**
     * Set passwordHashType
     *
     * @param string $passwordHashType
     * @return ApplicationsUsers
     */
    public function setPasswordHashType($passwordHashType)
    {
        $this->passwordHashType = $passwordHashType;

        return $this;
    }

    /**
     * Get passwordHashType
     *
     * @return string 
     */
    public function getPasswordHashType()
    {
        return $this->passwordHashType;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ApplicationsUsers
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return ApplicationsUsers
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if($this->getAuthorisationType() == 1){
            return true;
        }

        if(!$this->getPasswordHash()){
            $context->buildViolation("Параметр 'password_hash' не может быть пуст.")
                ->atPath('passwordHash')
                ->addViolation();
        }

        if(!$this->getPasswordHashType()){
            $context->buildViolation("Параметр 'password_hash_type' не может быть пуст.")
                ->atPath('passwordHashType')
                ->addViolation();
        }

        return true;
    }

    /**
     * Set accountIndividual
     *
     * @param \Authenticator\ApplicationsUsersBundle\Entity\IndividualPersonalData $accountIndividual
     * @return ApplicationsUsers
     */
    public function setAccountIndividual(\Authenticator\ApplicationsUsersBundle\Entity\IndividualPersonalData $accountIndividual = null)
    {
        $this->accountIndividual = $accountIndividual;

        return $this;
    }

    /**
     * Get accountIndividual
     *
     * @return \Authenticator\ApplicationsUsersBundle\Entity\IndividualPersonalData 
     */
    public function getAccountIndividual()
    {
        return $this->accountIndividual;
    }

    /**
     * Set accountLegalEntity
     *
     * @param \Authenticator\ApplicationsUsersBundle\Entity\LegalEntityPersonalData $accountLegalEntity
     * @return ApplicationsUsers
     */
    public function setAccountLegalEntity(\Authenticator\ApplicationsUsersBundle\Entity\LegalEntityPersonalData $accountLegalEntity = null)
    {
        $this->accountLegalEntity = $accountLegalEntity;

        return $this;
    }

    /**
     * Get accountLegalEntity
     *
     * @return \Authenticator\ApplicationsUsersBundle\Entity\LegalEntityPersonalData 
     */
    public function getAccountLegalEntity()
    {
        return $this->accountLegalEntity;
    }
}
