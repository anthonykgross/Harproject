<?php

namespace Harproject\OverrideBundle\Doctrine;

use Harproject\AppBundle\Entity\HarprojectInterface;

use Doctrine\ORM\EntityManager as BaseEntityManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\ORMException;

use Doctrine\Common\EventManager;
use Doctrine\DBAL\Connection;
/**
 *
 */
class EntityManager extends BaseEntityManager
{
    public static function create($conn, Configuration $config, EventManager $eventManager = null) {
        if ( ! $config->getMetadataDriverImpl()) {
            throw ORMException::missingMappingDriverImpl();
        }

        switch (true) {
            case (is_array($conn)):
                $conn = \Doctrine\DBAL\DriverManager::getConnection(
                    $conn, $config, ($eventManager ?: new EventManager())
                );
                break;

            case ($conn instanceof Connection):
                if ($eventManager !== null && $conn->getEventManager() !== $eventManager) {
                     throw ORMException::mismatchedEventManager();
                }
                break;

            default:
                throw new \InvalidArgumentException("Invalid argument: " . $conn);
        }

        return new EntityManager($conn, $config, $conn->getEventManager());
    }

    public function rawRemove($entity)
    {
        parent::remove($entity);
    }

    public function remove($entity)
    {
        if(  is_subclass_of( $entity,  "Harproject\AppBundle\Entity\HarprojectInterface" ) ) {
            $entity->setDeletedAt(new \DateTime());
        }
        else {
            parent::remove($entity);
        }

    }
}
