<?php
/**
 * Created by PhpStorm.
 * User: dmitriysinichkin
 * Date: 22.08.14
 * Time: 0:27
 */

namespace Authenticator\ApiSecurityBundle\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class ApiClientToken extends AbstractToken
{
    /**
     * @var string
     */
    protected $created;

    /**
     * @var string
     */
    protected $passwordDigest;

    /**
     * @var string
     */
    protected $nonce;

    public function __construct(array $roles = [])
    {
        parent::__construct($roles);

        $this->setAuthenticated(count($roles) > 0);
    }

    /**
     * @inheritdoc
     */
    public function getCredentials()
    {
        return '';
    }

    /**
     * @param string $created
     * @return $this
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param string $passwordDigest
     * @return $this
     */
    public function setPasswordDigest($passwordDigest)
    {
        $this->passwordDigest = $passwordDigest;

        return $this;
    }

    /**
     * @return string
     */
    public function getPasswordDigest()
    {
        return $this->passwordDigest;
    }

    /**
     * @param string $nonce
     * @return $this
     */
    public function setNonce($nonce)
    {
        $this->nonce = $nonce;

        return $this;
    }

    /**
     * @return string
     */
    public function getNonce()
    {
        return $this->nonce;
    }
} 