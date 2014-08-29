<?php

namespace Authenticator\ApiSecurityBundle;

use Authenticator\ApiSecurityBundle\Factory\AuthApiFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AuthenticatorApiSecurityBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new AuthApiFactory());
    }
}
