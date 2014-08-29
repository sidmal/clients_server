<?php
/**
 * Created by PhpStorm.
 * User: dmitriysinichkin
 * Date: 28.08.14
 * Time: 22:21
 */

namespace Authenticator\ApiSecurityBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AuthenticatorListenerTest extends WebTestCase
{
    public function testCorrectAuth()
    {
        $client = static::createClient();
        $container = $client->getContainer();

        $em = $container->get('doctrine.orm.entity_manager');

        $apiClient = $em->getRepository('AuthenticatorApiSecurityBundle:Clients')->find(1);

        if(!$apiClient){
            return true;
        }

        $applicationId = $apiClient->getId();
        $secretKey = $apiClient->getSecretKey();

        $created = (new DateTime())->format('c');
        $nonce = substr(md5(uniqid('nonce_', true)), 0, 16);

        $nonceBase64 = base64_encode($nonce);
        $secretKeyDigest = base64_encode(sha1($nonce.$created.$secretKey));

        $token = "ApiToken secretKeyDigest=\"{$secretKeyDigest}\", Nonce=\"{$nonceBase64}\", Created=\"{$created}\"";

        $crawler = $client->request('GET', "/clients/api/v1/{$applicationId}/ololo", [], [], ['X-Api-Hash' => $token]);

        $this->assertEquals(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
} 