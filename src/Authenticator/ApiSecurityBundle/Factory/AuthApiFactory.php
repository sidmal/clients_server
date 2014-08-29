<?php
/**
 * Created by PhpStorm.
 * User: dmitriysinichkin
 * Date: 27.08.14
 * Time: 23:31
 */

namespace Authenticator\ApiSecurityBundle\Factory;

use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;

class AuthApiFactory implements SecurityFactoryInterface
{
    public function create(ContainerBuilder $container, $id, $config, $userProvider, $defaultEntryPoint)
    {
        $providerId = 'security.authentication.provider.auth_clients_api.'.$id;

        $container
            ->setDefinition(
                $providerId,
                new DefinitionDecorator('auth_clients_api.security.authentication.provider')
            )
            ->replaceArgument(0, new Reference($userProvider));

        $listenerId = 'security.authentication.listener.auth_clients_api.'.$id;
        $container->setDefinition(
            $listenerId,
            new DefinitionDecorator('auth_clients_api.security.authentication.listener')
        );

        return [$providerId, $listenerId, $defaultEntryPoint];
    }

    public function getPosition()
    {
        return 'pre_auth';
    }

    public function getKey()
    {
        return 'wsse';
    }

    public function addConfiguration(NodeDefinition $node){}
} 