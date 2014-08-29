<?php

namespace Authenticator\ApiSecurityBundle\Entity\Repository;

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * ClientsRepository
 */
class ClientsRepository extends EntityRepository implements UserProviderInterface
{
    public function loadUserByUsername($clientId)
    {
        $query = $this
            ->createQueryBuilder('c')
            ->where('c.id = :client_id')
            ->setParameter('client_id', $clientId, Type::INTEGER)
            ->getQuery();

        try{
            $client = $query->getSingleResult();
        }
        catch(NoResultException $e){
            $message = sprintf(
                'Пользователь с указанным идентификаторм "%s" не найден.', $clientId
            );

            throw new UsernameNotFoundException($message, 0, $e);
        }

        return $client;
    }

    public function refreshUser(UserInterface $client)
    {
        $class = get_class($client);

        if(!$this->supportsClass($class)){
            throw new UnsupportedUserException(
                sprintf(
                    'Instances of "%s" are not supported.', $class
                )
            );
        }

        return $this->find($client->getUsername());
    }

    public function supportsClass($class)
    {
        return $this->getEntityName() === $class || is_subclass_of($class, $this->getEntityName());
    }
}
