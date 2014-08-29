<?php
/**
 * Created by PhpStorm.
 * User: dmitriysinichkin
 * Date: 27.08.14
 * Time: 22:54
 */

namespace Authenticator\ApiSecurityBundle\Provider;

use Authenticator\ApiSecurityBundle\Token\ApiClientToken;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\NonceExpiredException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class ClientsApiProvider implements AuthenticationProviderInterface
{
    private $clientProvider;

    private $cacheDir;

    public function __construct(UserProviderInterface $clientProvider, $cacheDir)
    {
        $this->clientProvider = $clientProvider;
        $this->cacheDir = $cacheDir;
    }

    public function authenticate(TokenInterface $token)
    {
        $client = $this->clientProvider->loadUserByUsername($token->getUsername());

        if($client && $this->validateDigest($token->getPasswordDigest(), $token->getNonce(), $token->getCreated(), $client->getSecretKey(), $client->getAuthLifeTime())){
            $authenticatedToken = new ApiClientToken();
            $authenticatedToken->setUser($client);

            return $authenticatedToken;
        }

        throw new AuthenticationException('Подпись запроса не верна.');
    }

    protected function validateDigest($digest, $nonce, $created, $secret, $authLifeTime)
    {
        $createdDigestTime = (new \DateTime($created))->getTimestamp();
        $currentTime = (new \DateTime())->getTimestamp();

        $nonceDir = $this->cacheDir.'/'.$nonce;

        if($createdDigestTime > $currentTime){ return false; }

        if($currentTime - $createdDigestTime > $authLifeTime){ return false; }

        if(file_exists($nonceDir) && (integer)file_get_contents($nonceDir) + $authLifeTime > $currentTime){
            throw new NonceExpiredException('Обнаруженно дублирование уникального параметра "Nonce".');
        }

        if(!is_dir($this->cacheDir)){
            mkdir($this->cacheDir, 0777, true);
        }

        file_put_contents($this->cacheDir.'/'.$nonce, $currentTime);

        $expected = base64_encode(sha1(base64_decode($nonce).$created.$secret));

        return $digest === $expected;
    }

    public function supports(TokenInterface $token)
    {
        return $token instanceof ApiClientToken;
    }
} 