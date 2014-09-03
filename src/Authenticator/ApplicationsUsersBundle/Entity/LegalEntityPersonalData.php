<?php

namespace Authenticator\ApplicationsUsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * LegalEntityPersonalData
 *
 * @ORM\Table(name="legal_entity_personal_data")
 * @ORM\Entity
 *
 * @ORM\HasLifecycleCallbacks
 */
class LegalEntityPersonalData
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
     * @ORM\Column(name="organisation_type", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'organisation_type' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'organisation_type' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'organisation_type' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Значение параметра 'organisation_type' содержит более допустимого количества символов."
     * )
     */
    private $organisationType;

    /**
     * @var string
     *
     * @ORM\Column(name="organisation_name", type="text")
     *
     * @Assert\NotBlank(message="Параметр 'organisation_name' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'organisation_name' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'organisation_name' имеет не корректный тип данных.")
     */
    private $organisationName;

    /**
     * @var string
     *
     * @ORM\Column(name="legal_address_zip", type="string", length=6)
     *
     * @Assert\NotBlank(message="Параметр 'legal_address->zip' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'legal_address->zip' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'legal_address->zip' имеет не корректный тип данных.")
     * @Assert\Length(
     *      min=6,
     *      max=6,
     *      minMessage="Значение параметра 'legal_address->zip' не может быть меньше 6-и цифр.",
     *      maxMessage="Значение параметра 'legal_address->zip' не может быть более 6-и цифр."
     * )
     */
    private $legalAddressZip;

    /**
     * @var string
     *
     * @ORM\Column(name="legal_address_country", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'legal_address->country' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'legal_address->country' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'legal_address->country' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Параметр 'legal_address->country' имеет не допустимую длину."
     * )
     */
    private $legalAddressCountry;

    /**
     * @var string
     *
     * @ORM\Column(name="legal_address_state", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'legal_address->state' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'legal_address->state' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'legal_address->state' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Параметр 'legal_address->state' имеет не допустимую длину."
     * )
     */
    private $legalAddressState;

    /**
     * @var string
     *
     * @ORM\Column(name="legal_address_city", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'legal_address->city' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'legal_address->city' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'legal_address->city' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Параметр 'legal_address->city' имеет не допустимую длину."
     * )
     */
    private $legalAddressCity;

    /**
     * @var string
     *
     * @ORM\Column(name="legal_address_street", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'legal_address->street' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'legal_address->street' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'legal_address->street' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Параметр 'legal_address->street' имеет не допустимую длину."
     * )
     */
    private $legalAddressStreet;

    /**
     * @var integer
     *
     * @ORM\Column(name="legal_address_house", type="integer")
     *
     * @Assert\NotBlank(message="Параметр 'legal_address->house' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'legal_address->house' не может быть равным null.")
     * @Assert\Type(type="numeric", message="Значение параметра 'legal_address->house' имеет не корректный тип данных.")
     */
    private $legalAddressHouse;

    /**
     * @var string
     *
     * @ORM\Column(name="legal_address_build", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'legal_address->build' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'legal_address->build' не может быть равным null.")
     * @Assert\Type(type="scalar", message="Значение параметра 'legal_address->build' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Параметр 'legal_address->build' имеет не допустимую длину."
     * )
     */
    private $legalAddressBuild;

    /**
     * @var string
     *
     * @ORM\Column(name="legal_address_office", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'legal_address->office' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'legal_address->office' не может быть равным null.")
     * @Assert\Type(type="scalar", message="Значение параметра 'legal_address->office' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Параметр 'legal_address->office' имеет не допустимую длину."
     * )
     */
    private $legalAddressOffice;

    /**
     * @var string
     *
     * @ORM\Column(name="actual_address_zip", type="string", length=6)
     *
     * @Assert\NotBlank(message="Параметр 'actual_address->zip' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'actual_address->zip' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'actual_address->zip' имеет не корректный тип данных.")
     * @Assert\Length(
     *      min=6,
     *      max=6,
     *      minMessage="Значение параметра 'actual_address->zip' не может быть меньше 6-и цифр.",
     *      maxMessage="Значение параметра 'actual_address->zip' не может быть более 6-и цифр."
     * )
     */
    private $actualAddressZip;

    /**
     * @var string
     *
     * @ORM\Column(name="actual_address_country", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'actual_address->country' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'actual_address->country' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'actual_address->country' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Параметр 'actual_address->country' имеет не допустимую длину."
     * )
     */
    private $actualAddressCountry;

    /**
     * @var string
     *
     * @ORM\Column(name="actual_address_state", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'actual_address->state' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'actual_address->state' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'actual_address->state' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Параметр 'actual_address->state' имеет не допустимую длину."
     * )
     */
    private $actualAddressState;

    /**
     * @var string
     *
     * @ORM\Column(name="actual_address_city", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'actual_address->city' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'actual_address->city' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'actual_address->city' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Параметр 'actual_address->city' имеет не допустимую длину."
     * )
     */
    private $actualAddressCity;

    /**
     * @var string
     *
     * @ORM\Column(name="actual_address_street", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'actual_address->street' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'actual_address->street' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'actual_address->street' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Параметр 'actual_address->street' имеет не допустимую длину."
     * )
     */
    private $actualAddressStreet;

    /**
     * @var integer
     *
     * @ORM\Column(name="actual_address_house", type="integer")
     *
     * @Assert\NotBlank(message="Параметр 'actual_address->house' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'actual_address->house' не может быть равным null.")
     * @Assert\Type(type="numeric", message="Значение параметра 'actual_address->house' имеет не корректный тип данных.")
     */
    private $actualAddressHouse;

    /**
     * @var string
     *
     * @ORM\Column(name="actual_address_build", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'actual_address->build' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'actual_address->build' не может быть равным null.")
     * @Assert\Type(type="scalar", message="Значение параметра 'actual_address->build' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Параметр 'actual_address->build' имеет не допустимую длину."
     * )
     */
    private $actualAddressBuild;

    /**
     * @var string
     *
     * @ORM\Column(name="actual_address_office", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'actual_address->office' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'actual_address->office' не может быть равным null.")
     * @Assert\Type(type="scalar", message="Значение параметра 'actual_address->office' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Параметр 'actual_address->office' имеет не допустимую длину."
     * )
     */
    private $actualAddressOffice;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'email' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'email' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'email' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Параметр 'email' имеет не допустимую длину."
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=128, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="inn", type="string", length=12)
     *
     * @Assert\NotBlank(message="Параметр 'inn' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'inn' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'inn' имеет не корректный тип данных.")
     * @Assert\Length(
     *      min=10,
     *      max=12,
     *      minMessage="Параметр 'inn' имеет не допустимую длину.",
     *      maxMessage="Параметр 'inn' имеет не допустимую длину."
     * )
     */
    private $inn;

    /**
     * @var string
     *
     * @ORM\Column(name="kpp", type="string", length=9)
     *
     * @Assert\NotBlank(message="Параметр 'kpp' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'kpp' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'kpp' имеет не корректный тип данных.")
     * @Assert\Length(
     *      min=9,
     *      max=9,
     *      minMessage="Параметр 'kpp' имеет не допустимую длину.",
     *      maxMessage="Параметр 'kpp' имеет не допустимую длину."
     * )
     */
    private $kpp;

    /**
     * @var string
     *
     * @ORM\Column(name="okved", type="string", length=128)
     *
     * @Assert\NotBlank(message="Параметр 'okved' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'okved' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'okved' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=128,
     *      maxMessage="Параметр 'okved' имеет не допустимую длину."
     * )
     */
    private $okved;

    /**
     * @var string
     *
     * @ORM\Column(name="okpo", type="string", length=8)
     *
     * @Assert\NotBlank(message="Параметр 'okpo' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'okpo' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'okpo' имеет не корректный тип данных.")
     * @Assert\Length(
     *      min=8,
     *      max=8,
     *      minMessage="Параметр 'okpo' имеет не допустимую длину.",
     *      maxMessage="Параметр 'okpo' имеет не допустимую длину."
     * )
     */
    private $okpo;

    /**
     * @var string
     *
     * @ORM\Column(name="bank_name", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'bank->name' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'bank->name' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'bank->name' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Параметр 'bank->name' имеет не допустимую длину."
     * )
     */
    private $bankName;

    /**
     * @var string
     *
     * @ORM\Column(name="bank_bik", type="string", length=9)
     *
     * @Assert\NotBlank(message="Параметр 'bank->bik' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'bank->bik' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'bank->bik' имеет не корректный тип данных.")
     * @Assert\Length(
     *      min=9,
     *      max=9,
     *      minMessage="Параметр 'bank->bik' имеет не допустимую длину.",
     *      maxMessage="Параметр 'bank->bik' имеет не допустимую длину."
     * )
     */
    private $bankBik;

    /**
     * @var string
     *
     * @ORM\Column(name="bank_correspondent_account", type="string", length=20)
     *
     * @Assert\NotBlank(message="Параметр 'bank->correspondent_account' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'bank->correspondent_account' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'bank->correspondent_account' имеет не корректный тип данных.")
     * @Assert\Length(
     *      min=20,
     *      max=20,
     *      minMessage="Параметр 'bank->correspondent_account' имеет не допустимую длину.",
     *      maxMessage="Параметр 'bank->correspondent_account' имеет не допустимую длину."
     * )
     */
    private $bankCorrespondentAccount;

    /**
     * @var string
     *
     * @ORM\Column(name="bank_checking_account", type="string", length=20)
     *
     * @Assert\NotBlank(message="Параметр 'bank->checking_account' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'bank->checking_account' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'bank->checking_account' имеет не корректный тип данных.")
     * @Assert\Length(
     *      min=20,
     *      max=20,
     *      minMessage="Параметр 'bank->checking_account' имеет не допустимую длину.",
     *      maxMessage="Параметр 'bank->checking_account' имеет не допустимую длину."
     * )
     */
    private $bankCheckingAccount;

    /**
     * @var string
     *
     * @ORM\Column(name="organisation_head_last_name", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'organisation_head->last_name' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'organisation_head->last_name' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'organisation_head->last_name' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Параметр 'organisation_head->last_name' имеет не допустимую длину."
     * )
     */
    private $organisationHeadLastName;

    /**
     * @var string
     *
     * @ORM\Column(name="organisation_head_first_name", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'organisation_head->first_name' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'organisation_head->first_name' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'organisation_head->first_name' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Параметр 'organisation_head->first_name' имеет не допустимую длину."
     * )
     */
    private $organisationHeadFirstName;

    /**
     * @var string
     *
     * @ORM\Column(name="organisation_head_middle_name", type="string", length=255, nullable=true)
     */
    private $organisationHeadMiddleName;

    /**
     * @var string
     *
     * @ORM\Column(name="organisation_head_base_activities", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'organisation_head->base_activities' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'organisation_head->base_activities' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'organisation_head->base_activities' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Параметр 'organisation_head->base_activities' имеет не допустимую длину."
     * )
     */
    private $organisationHeadBaseActivities;

    /**
     * @var string
     *
     * @ORM\Column(name="organisation_head_post", type="string", length=255)
     *
     * @Assert\NotBlank(message="Параметр 'organisation_head->post' не может быть пуст.")
     * @Assert\NotNull(message="Параметр 'organisation_head->post' не может быть равным null.")
     * @Assert\Type(type="string", message="Значение параметра 'organisation_head->post' имеет не корректный тип данных.")
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Параметр 'organisation_head->post' имеет не допустимую длину."
     * )
     */
    private $organisationHeadPost;

    /**
     * @ORM\OneToOne(targetEntity="ApplicationsUsers", inversedBy="accountLegalEntity")
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
     * Set organisationType
     *
     * @param string $organisationType
     * @return LegalEntityPersonalData
     */
    public function setOrganisationType($organisationType)
    {
        $this->organisationType = $organisationType;

        return $this;
    }

    /**
     * Get organisationType
     *
     * @return string 
     */
    public function getOrganisationType()
    {
        return $this->organisationType;
    }

    /**
     * Set organisationName
     *
     * @param string $organisationName
     * @return LegalEntityPersonalData
     */
    public function setOrganisationName($organisationName)
    {
        $this->organisationName = $organisationName;

        return $this;
    }

    /**
     * Get organisationName
     *
     * @return string 
     */
    public function getOrganisationName()
    {
        return $this->organisationName;
    }

    /**
     * Set legalAddressZip
     *
     * @param string $legalAddressZip
     * @return LegalEntityPersonalData
     */
    public function setLegalAddressZip($legalAddressZip)
    {
        $this->legalAddressZip = $legalAddressZip;

        return $this;
    }

    /**
     * Get legalAddressZip
     *
     * @return string 
     */
    public function getLegalAddressZip()
    {
        return $this->legalAddressZip;
    }

    /**
     * Set legalAddressCountry
     *
     * @param string $legalAddressCountry
     * @return LegalEntityPersonalData
     */
    public function setLegalAddressCountry($legalAddressCountry)
    {
        $this->legalAddressCountry = $legalAddressCountry;

        return $this;
    }

    /**
     * Get legalAddressCountry
     *
     * @return string 
     */
    public function getLegalAddressCountry()
    {
        return $this->legalAddressCountry;
    }

    /**
     * Set legalAddressState
     *
     * @param string $legalAddressState
     * @return LegalEntityPersonalData
     */
    public function setLegalAddressState($legalAddressState)
    {
        $this->legalAddressState = $legalAddressState;

        return $this;
    }

    /**
     * Get legalAddressState
     *
     * @return string 
     */
    public function getLegalAddressState()
    {
        return $this->legalAddressState;
    }

    /**
     * Set legalAddressCity
     *
     * @param string $legalAddressCity
     * @return LegalEntityPersonalData
     */
    public function setLegalAddressCity($legalAddressCity)
    {
        $this->legalAddressCity = $legalAddressCity;

        return $this;
    }

    /**
     * Get legalAddressCity
     *
     * @return string 
     */
    public function getLegalAddressCity()
    {
        return $this->legalAddressCity;
    }

    /**
     * Set legalAddressStreet
     *
     * @param string $legalAddressStreet
     * @return LegalEntityPersonalData
     */
    public function setLegalAddressStreet($legalAddressStreet)
    {
        $this->legalAddressStreet = $legalAddressStreet;

        return $this;
    }

    /**
     * Get legalAddressStreet
     *
     * @return string 
     */
    public function getLegalAddressStreet()
    {
        return $this->legalAddressStreet;
    }

    /**
     * Set legalAddressHouse
     *
     * @param integer $legalAddressHouse
     * @return LegalEntityPersonalData
     */
    public function setLegalAddressHouse($legalAddressHouse)
    {
        $this->legalAddressHouse = $legalAddressHouse;

        return $this;
    }

    /**
     * Get legalAddressHouse
     *
     * @return integer 
     */
    public function getLegalAddressHouse()
    {
        return $this->legalAddressHouse;
    }

    /**
     * Set legalAddressBuild
     *
     * @param string $legalAddressBuild
     * @return LegalEntityPersonalData
     */
    public function setLegalAddressBuild($legalAddressBuild)
    {
        $this->legalAddressBuild = $legalAddressBuild;

        return $this;
    }

    /**
     * Get legalAddressBuild
     *
     * @return string 
     */
    public function getLegalAddressBuild()
    {
        return $this->legalAddressBuild;
    }

    /**
     * Set legalAddressOffice
     *
     * @param string $legalAddressOffice
     * @return LegalEntityPersonalData
     */
    public function setLegalAddressOffice($legalAddressOffice)
    {
        $this->legalAddressOffice = $legalAddressOffice;

        return $this;
    }

    /**
     * Get legalAddressOffice
     *
     * @return string 
     */
    public function getLegalAddressOffice()
    {
        return $this->legalAddressOffice;
    }

    /**
     * Set actualAddressZip
     *
     * @param string $actualAddressZip
     * @return LegalEntityPersonalData
     */
    public function setActualAddressZip($actualAddressZip)
    {
        $this->actualAddressZip = $actualAddressZip;

        return $this;
    }

    /**
     * Get actualAddressZip
     *
     * @return string 
     */
    public function getActualAddressZip()
    {
        return $this->actualAddressZip;
    }

    /**
     * Set actualAddressCountry
     *
     * @param string $actualAddressCountry
     * @return LegalEntityPersonalData
     */
    public function setActualAddressCountry($actualAddressCountry)
    {
        $this->actualAddressCountry = $actualAddressCountry;

        return $this;
    }

    /**
     * Get actualAddressCountry
     *
     * @return string 
     */
    public function getActualAddressCountry()
    {
        return $this->actualAddressCountry;
    }

    /**
     * Set actualAddressState
     *
     * @param string $actualAddressState
     * @return LegalEntityPersonalData
     */
    public function setActualAddressState($actualAddressState)
    {
        $this->actualAddressState = $actualAddressState;

        return $this;
    }

    /**
     * Get actualAddressState
     *
     * @return string 
     */
    public function getActualAddressState()
    {
        return $this->actualAddressState;
    }

    /**
     * Set actualAddressCity
     *
     * @param string $actualAddressCity
     * @return LegalEntityPersonalData
     */
    public function setActualAddressCity($actualAddressCity)
    {
        $this->actualAddressCity = $actualAddressCity;

        return $this;
    }

    /**
     * Get actualAddressCity
     *
     * @return string 
     */
    public function getActualAddressCity()
    {
        return $this->actualAddressCity;
    }

    /**
     * Set actualAddressStreet
     *
     * @param string $actualAddressStreet
     * @return LegalEntityPersonalData
     */
    public function setActualAddressStreet($actualAddressStreet)
    {
        $this->actualAddressStreet = $actualAddressStreet;

        return $this;
    }

    /**
     * Get actualAddressStreet
     *
     * @return string 
     */
    public function getActualAddressStreet()
    {
        return $this->actualAddressStreet;
    }

    /**
     * Set actualAddressHouse
     *
     * @param integer $actualAddressHouse
     * @return LegalEntityPersonalData
     */
    public function setActualAddressHouse($actualAddressHouse)
    {
        $this->actualAddressHouse = $actualAddressHouse;

        return $this;
    }

    /**
     * Get actualAddressHouse
     *
     * @return integer 
     */
    public function getActualAddressHouse()
    {
        return $this->actualAddressHouse;
    }

    /**
     * Set actualAddressBuild
     *
     * @param string $actualAddressBuild
     * @return LegalEntityPersonalData
     */
    public function setActualAddressBuild($actualAddressBuild)
    {
        $this->actualAddressBuild = $actualAddressBuild;

        return $this;
    }

    /**
     * Get actualAddressBuild
     *
     * @return string 
     */
    public function getActualAddressBuild()
    {
        return $this->actualAddressBuild;
    }

    /**
     * Set actualAddressOffice
     *
     * @param string $actualAddressOffice
     * @return LegalEntityPersonalData
     */
    public function setActualAddressOffice($actualAddressOffice)
    {
        $this->actualAddressOffice = $actualAddressOffice;

        return $this;
    }

    /**
     * Get actualAddressOffice
     *
     * @return string 
     */
    public function getActualAddressOffice()
    {
        return $this->actualAddressOffice;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return LegalEntityPersonalData
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return LegalEntityPersonalData
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

    /**
     * Set inn
     *
     * @param string $inn
     * @return LegalEntityPersonalData
     */
    public function setInn($inn)
    {
        $this->inn = $inn;

        return $this;
    }

    /**
     * Get inn
     *
     * @return string 
     */
    public function getInn()
    {
        return $this->inn;
    }

    /**
     * Set kpp
     *
     * @param string $kpp
     * @return LegalEntityPersonalData
     */
    public function setKpp($kpp)
    {
        $this->kpp = $kpp;

        return $this;
    }

    /**
     * Get kpp
     *
     * @return string 
     */
    public function getKpp()
    {
        return $this->kpp;
    }

    /**
     * Set okved
     *
     * @param string $okved
     * @return LegalEntityPersonalData
     */
    public function setOkved($okved)
    {
        $this->okved = $okved;

        return $this;
    }

    /**
     * Get okved
     *
     * @return string 
     */
    public function getOkved()
    {
        return $this->okved;
    }

    /**
     * Set okpo
     *
     * @param string $okpo
     * @return LegalEntityPersonalData
     */
    public function setOkpo($okpo)
    {
        $this->okpo = $okpo;

        return $this;
    }

    /**
     * Get okpo
     *
     * @return string 
     */
    public function getOkpo()
    {
        return $this->okpo;
    }

    /**
     * Set bankName
     *
     * @param string $bankName
     * @return LegalEntityPersonalData
     */
    public function setBankName($bankName)
    {
        $this->bankName = $bankName;

        return $this;
    }

    /**
     * Get bankName
     *
     * @return string 
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * Set bankBik
     *
     * @param string $bankBik
     * @return LegalEntityPersonalData
     */
    public function setBankBik($bankBik)
    {
        $this->bankBik = $bankBik;

        return $this;
    }

    /**
     * Get bankBik
     *
     * @return string 
     */
    public function getBankBik()
    {
        return $this->bankBik;
    }

    /**
     * Set bankCorrespondentAccount
     *
     * @param string $bankCorrespondentAccount
     * @return LegalEntityPersonalData
     */
    public function setBankCorrespondentAccount($bankCorrespondentAccount)
    {
        $this->bankCorrespondentAccount = $bankCorrespondentAccount;

        return $this;
    }

    /**
     * Get bankCorrespondentAccount
     *
     * @return string 
     */
    public function getBankCorrespondentAccount()
    {
        return $this->bankCorrespondentAccount;
    }

    /**
     * Set bankCheckingAccount
     *
     * @param string $bankCheckingAccount
     * @return LegalEntityPersonalData
     */
    public function setBankCheckingAccount($bankCheckingAccount)
    {
        $this->bankCheckingAccount = $bankCheckingAccount;

        return $this;
    }

    /**
     * Get bankCheckingAccount
     *
     * @return string 
     */
    public function getBankCheckingAccount()
    {
        return $this->bankCheckingAccount;
    }

    /**
     * Set organisationHeadLastName
     *
     * @param string $organisationHeadLastName
     * @return LegalEntityPersonalData
     */
    public function setOrganisationHeadLastName($organisationHeadLastName)
    {
        $this->organisationHeadLastName = $organisationHeadLastName;

        return $this;
    }

    /**
     * Get organisationHeadLastName
     *
     * @return string 
     */
    public function getOrganisationHeadLastName()
    {
        return $this->organisationHeadLastName;
    }

    /**
     * Set organisationHeadFirstName
     *
     * @param string $organisationHeadFirstName
     * @return LegalEntityPersonalData
     */
    public function setOrganisationHeadFirstName($organisationHeadFirstName)
    {
        $this->organisationHeadFirstName = $organisationHeadFirstName;

        return $this;
    }

    /**
     * Get organisationHeadFirstName
     *
     * @return string 
     */
    public function getOrganisationHeadFirstName()
    {
        return $this->organisationHeadFirstName;
    }

    /**
     * Set organisationHeadMiddleName
     *
     * @param string $organisationHeadMiddleName
     * @return LegalEntityPersonalData
     */
    public function setOrganisationHeadMiddleName($organisationHeadMiddleName)
    {
        $this->organisationHeadMiddleName = $organisationHeadMiddleName;

        return $this;
    }

    /**
     * Get organisationHeadMiddleName
     *
     * @return string 
     */
    public function getOrganisationHeadMiddleName()
    {
        return $this->organisationHeadMiddleName;
    }

    /**
     * Set organisationHeadBaseActivities
     *
     * @param string $organisationHeadBaseActivities
     * @return LegalEntityPersonalData
     */
    public function setOrganisationHeadBaseActivities($organisationHeadBaseActivities)
    {
        $this->organisationHeadBaseActivities = $organisationHeadBaseActivities;

        return $this;
    }

    /**
     * Get organisationHeadBaseActivities
     *
     * @return string 
     */
    public function getOrganisationHeadBaseActivities()
    {
        return $this->organisationHeadBaseActivities;
    }

    /**
     * Set organisationHeadPost
     *
     * @param string $organisationHeadPost
     * @return LegalEntityPersonalData
     */
    public function setOrganisationHeadPost($organisationHeadPost)
    {
        $this->organisationHeadPost = $organisationHeadPost;

        return $this;
    }

    /**
     * Get organisationHeadPost
     *
     * @return string 
     */
    public function getOrganisationHeadPost()
    {
        return $this->organisationHeadPost;
    }

    /**
     * Set applicationsUser
     *
     * @param \Authenticator\ApplicationsUsersBundle\Entity\ApplicationsUsers $applicationsUser
     * @return LegalEntityPersonalData
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
     * @return LegalEntityPersonalData
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
     * @return LegalEntityPersonalData
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
