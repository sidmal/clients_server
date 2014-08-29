<?php
/**
 * Created by PhpStorm.
 * User: dmitriysinichkin
 * Date: 28.08.14
 * Time: 23:00
 */

namespace Authenticator\ApiSecurityBundle\Logger;

use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpKernel\Event\PostResponseEvent;

class LoggerListener
{
    use LoggerAwareTrait;

    /**
     * @var \Symfony\Component\Security\Core\SecurityContext
     */
    protected $securityContext;

    protected $logDir;

    /**
     * @param mixed $securityContext
     */
    public function setSecurityContext($securityContext)
    {
        $this->securityContext = $securityContext;
    }

    public function setLogDir($logDir)
    {
        $this->logDir = $logDir;
    }

    public function onKernelTerminate(PostResponseEvent $event)
    {
        if(!$controller = $event->getRequest()->get('_controller')){
            return false;
        }

        $controllerClass = substr($controller, 0, strpos($controller, '::'));
        $reflection = new \ReflectionClass('\\' . $controllerClass);

        if(!array_key_exists('Authenticator\\ApiSecurityBundle\\Logger\\LoggingInterface', $reflection->getInterfaces())){
            return false;
        }

        $params = array_filter(
            [
                'request_datetime' => (new \DateTime())->format('c'),
                'request_method' => $event->getRequest()->getMethod(),
                'request_remote_ip' => $event->getRequest()->getClientIp(),
                'request_content' => $event->getRequest()->getContent(),
                'request_query' => $event->getRequest()->getQueryString(),
                'request_headers' => $event->getRequest()->headers->all(),
                'request_post' => $event->getRequest()->request->all(),
                'request_attributes' => $event->getRequest()->attributes->all(),
                'application_client' => $event->getRequest()->attributes->get('application_id'),
                'response' => $event->getResponse()->getContent()
            ]
        );

        if($this->logDir){
            if(!file_exists($this->logDir)){
                mkdir($this->logDir);
            }

            $logFile = $this->logDir.'/'.date('Y-m-d').'.log';
            fwrite(fopen($logFile, 'a'), json_encode($params)."\n");
        }
        else{
            $this->logger->info($params);
        }
    }
} 