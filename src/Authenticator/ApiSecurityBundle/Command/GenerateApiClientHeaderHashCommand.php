<?php
/**
 * Created by PhpStorm.
 * User: dmitriysinichkin
 * Date: 28.08.14
 * Time: 22:38
 */

namespace Authenticator\ApiSecurityBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateApiClientHeaderHashCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('clients:api-client:generate_header_hash')
            ->setDescription('Генерация подписи запроса от имени клиента API')
            ->addOption(
                'secret_key', null, InputOption::VALUE_REQUIRED, 'Секретное слово клиента API для формирования подписи запросов.'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $secretKey = $input->getOption('secret_key');

        $created = (new \DateTime())->format('c');
        $nonce = substr(md5(uniqid('nonce_', true)), 0, 16);

        $nonceBase64 = base64_encode($nonce);
        $secretKeyDigest = base64_encode(sha1($nonce.$created.$secretKey));

        $output->writeln(
            "ApiToken secretKeyDigest=\"{$secretKeyDigest}\", Nonce=\"{$nonceBase64}\", Created=\"{$created}\""
        );
    }
} 