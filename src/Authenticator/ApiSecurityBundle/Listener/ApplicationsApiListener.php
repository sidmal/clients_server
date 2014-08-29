<?php
/**
 * Created by PhpStorm.
 * User: dmitriysinichkin
 * Date: 22.08.14
 * Time: 0:45
 */

namespace Authenticator\ApiSecurityBundle\Listener;

use Authenticator\ApiSecurityBundle\Exception\ApiSecurityException;
use Authenticator\ApiSecurityBundle\Token\ApiClientToken;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;

class ApplicationsApiListener implements ListenerInterface
{
    /**
     * @var \Symfony\Component\Security\Core\SecurityContextInterface
     */
    protected $securityContext;

    /**
     * @var \Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface
     */
    protected $authenticationManager;

    /**
     * @var string
     */
    protected $apiHeaderName;

    public function __construct(SecurityContextInterface $securityContext, AuthenticationManagerInterface $authenticationManager)
    {
        $this->securityContext = $securityContext;
        $this->authenticationManager = $authenticationManager;
    }

    /**
     * @inheritdoc
     */
    public function handle(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        $response = (new Response())->setStatusCode(Response::HTTP_FORBIDDEN);

        $apiSignatureRegexp = '/^ApiToken secretKeyDigest="([^\.]+)", Nonce="([^\.]+)", Created="([^\.]+)"$/';

        if(!$request->headers->has($this->getApiHeaderName())
            || 1 !== preg_match($apiSignatureRegexp, $request->headers->get($this->getApiHeaderName()), $matches)){
            return $event->setResponse(
                $response->setContent('Заголовок с подписью не задан или имеет не корректный формат.')
            );
        }

        try{
            new \DateTime($matches[3]);
        }
        catch(\Exception $e){
            return $event->setResponse(
                $response->setContent('Поле "Created" задано не верно или имеет не корректный формат.')
            );
        }

        $token = new ApiClientToken();
        $token->setUser($request->attributes->get('application_id'));

        $token->setPasswordDigest($matches[1]);
        $token->setNonce($matches[2]);
        $token->setCreated($matches[3]);

        try{
            $authToken = $this->authenticationManager->authenticate($token);
            $this->securityContext->setToken($authToken);

            return true;
        }
        catch(AuthenticationException $e){
            $response->setContent($e->getMessage());
        }

        $event->setResponse($response);
    }

    /**
     * @param $apiHeaderName
     * @return $this
     */
    public function setApiHeaderName($apiHeaderName)
    {
        $this->apiHeaderName = $apiHeaderName;

        return $this;
    }

    /**
     * @return string
     * @throws \Authenticator\ApiSecurityBundle\Exception\ApiSecurityException
     */
    public function getApiHeaderName()
    {
        if(!$this->apiHeaderName)
        {
            throw new ApiSecurityException('Applications API header name not configured.');
        }

        return $this->apiHeaderName;
    }
} 