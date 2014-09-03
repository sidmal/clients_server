<?php

namespace Authenticator\ApplicationsUsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * IndividualPersonalData
 *
 * @ORM\Table(name="individual_personal_data")
 * @ORM\Entity
 *
 * @ORM\HasLifecycleCallbacks
 */
class IndividualPersonalData
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
     * @ORM\Column(name="last_name", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'last_name' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'last_name' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'last_name' имеет не корректный тип данных.")
     * @Assert\Length(
     *      min=2,
     *      max=255,
     *      minMessage="Значение параметра 'last_name' содержит менее допустимого количества символов.",
     *      maxMessage="Значение параметра 'last_name' содержит более допустимого количества символов."
     * )
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'first_name' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'first_name' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'first_name' имеет не корректный тип данных.")
     * @Assert\Length(
     *      min=2,
     *      max=255,
     *      minMessage="Значение параметра 'first_name' содержит менее допустимого количества символов.",
     *      maxMessage="Значение параметра 'first_name' содержит более допустимого количества символов."
     * )
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="middle_name", type="string", length=255, nullable=true)
     */
    private $middleName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date")
     *
     * @Assert\NotBlank(message="Параметр 'birthday' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'birthday' не может быть равным null.")
     * @Assert\Date(message="Значение параметра 'birthday' имеет не корректный тип данных.")
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="passport_series", type="string", length=4)
     *
     * @Assert\NotBlank(message="Параметр 'passport_series' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'passport_series' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'passport_series' имеет не корректный тип данных.")
     * @Assert\Length(
     *      min=4,
     *      max=4,
     *      minMessage="Значение параметра 'passport_series' не может быть меньше 4-х цифр.",
     *      maxMessage="Значение параметра 'passport_series' не может быть больше 4-х цифр."
     * )
     */
    private $passportSeries;

    /**
     * @var string
     *
     * @ORM\Column(name="passport_number", type="string", length=6)
     *
     * @Assert\NotBlank(message="Параметр 'passport_number' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'passport_number' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'passport_number' имеет не корректный тип данных.")
     * @Assert\Length(
     *      min=6,
     *      max=6,
     *      minMessage="Значение параметра 'passport_number' не может быть меньше 6-и цифр.",
     *      maxMessage="Значение параметра 'passport_number' не может быть больше 6-и цифр."
     * )
     */
    private $passportNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_of_issue", type="date")
     *
     * @Assert\NotBlank(message="Параметр 'date_of_issue' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'date_of_issue' не может быть равным null.")
     * @Assert\Date(message="Значение параметра 'date_of_issue' имеет не корректный тип данных.")
     */
    private $dateOfIssue;

    /**
     * @var string
     *
     * @ORM\Column(name="place_of_issue", type="text")
     *
     * @Assert\NotBlank(message="Параметр 'place_of_issue' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'place_of_issue' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'place_of_issue' имеет не корректный тип данных.")
     */
    private $placeOfIssue;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_phone", type="string", length=128)
     *
     * @Assert\NotBlank(message="Параметр 'contact_phone' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'contact_phone' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'passport_number' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=128,
     *      maxMessage="Значение параметра 'contact_phone' превышает допустимую длинну."
     * )
     */
    private $contactPhone;

    /**
     * @ORM\OneToOne(targetEntity="ApplicationsUsers", inversedBy="accountIndividual")
     * @ORM\JoinColumn(name="applications_user_id", referencedColumnName="id")
     */
    private $applicationsUser;

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
     * Set lastName
     *
     * @param string $lastName
     * @return IndividualPersonalData
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return IndividualPersonalData
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set middleName
     *
     * @param string $middleName
     * @return IndividualPersonalData
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;

        return $this;
    }

    /**
     * Get middleName
     *
     * @return string 
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return IndividualPersonalData
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set passportSeries
     *
     * @param string $passportSeries
     * @return IndividualPersonalData
     */
    public function setPassportSeries($passportSeries)
    {
        $this->passportSeries = $passportSeries;

        return $this;
    }

    /**
     * Get passportSeries
     *
     * @return string 
     */
    public function getPassportSeries()
    {
        return $this->passportSeries;
    }

    /**
     * Set passportNumber
     *
     * @param string $passportNumber
     * @return IndividualPersonalData
     */
    public function setPassportNumber($passportNumber)
    {
        $this->passportNumber = $passportNumber;

        return $this;
    }

    /**
     * Get passportNumber
     *
     * @return string 
     */
    public function getPassportNumber()
    {
        return $this->passportNumber;
    }

    /**
     * Set dateOfIssue
     *
     * @param \DateTime $dateOfIssue
     * @return IndividualPersonalData
     */
    public function setDateOfIssue($dateOfIssue)
    {
        $this->dateOfIssue = $dateOfIssue;

        return $this;
    }

    /**
     * Get dateOfIssue
     *
     * @return \DateTime 
     */
    public function getDateOfIssue()
    {
        return $this->dateOfIssue;
    }

    /**
     * Set placeOfIssue
     *
     * @param string $placeOfIssue
     * @return IndividualPersonalData
     */
    public function setPlaceOfIssue($placeOfIssue)
    {
        $this->placeOfIssue = $placeOfIssue;

        return $this;
    }

    /**
     * Get placeOfIssue
     *
     * @return string 
     */
    public function getPlaceOfIssue()
    {
        return $this->placeOfIssue;
    }

    /**
     * Set contactPhone
     *
     * @param string $contactPhone
     * @return IndividualPersonalData
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    /**
     * Get contactPhone
     *
     * @return string 
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * Set applicationsUser
     *
     * @param \Authenticator\ApplicationsUsersBundle\Entity\ApplicationsUsers $applicationsUser
     * @return IndividualPersonalData
     */
    public function setApplicationsUser(\Authenticator\ApplicationsUsersBundle\Entity\ApplicationsUsers $applicationsUser = null)
    {
        $this->applicationsUser = $applicationsUser;

        return $this;
    }

    /**
     * Get applicationsUser
     *
     * @return \Authenticator\ApplicationsUsersBundle\Entity\ApplicationsUsers 
     */
    public function getApplicationsUser()
    {
        return $this->applicationsUser;
    }

    /**
     * @ORM\PreUpdate
     */
    public function beforeUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return IndividualPersonalData
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
     * @return IndividualPersonalData
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
}
