<?php
/**
 * Created by PhpStorm.
 * User: dmitriysinichkin
 * Date: 28.08.14
 * Time: 21:36
 */

namespace Authenticator\ApiSecurityBundle\Command;

use Authenticator\ApiSecurityBundle\Entity\Clients;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateApiClientCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('clients:api-client:create')
            ->setDescription('Создание клиента API.')
            ->addOption(
                'name', null, InputOption::VALUE_REQUIRED, 'Наименование клиента API'
            )
            ->addOption(
                'secret_key', null, InputOption::VALUE_REQUIRED, 'Секретное слово клиента API для формирования подписи запросов.'
            )
            ->addOption(
                'auth_life_time', null, InputOption::VALUE_OPTIONAL, 'Время жизни авторизации для клиента', 300
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new Clients();
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');

        $client->setName($input->getOption('name'));
        $client->setSecretKey($input->getOption('secret_key'));
        $client->setAuthLifeTime($input->getOption('auth_life_time'));

        $entityManager->persist($client);
        $entityManager->flush($client);

        $output->writeln(
            sprintf('Пользователь %s успешно создан.', $input->getOption('name'))
        );
    }
} 