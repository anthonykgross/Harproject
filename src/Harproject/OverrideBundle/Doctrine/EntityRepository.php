<?php

namespace Harproject\OverrideBundle\Doctrine;

use Harproject\AppBundle\Entity\HarprojectInterface;

use Doctrine\ORM\EntityRepository as BaseEntityRepository;
use Doctrine\DBAL\LockMode;


class EntityRepository extends BaseEntityRepository
{
    
    /**
     * Creates a new QueryBuilder instance that is prepopulated for this entity name.
     *
     * @param string $alias
     *
     * @return QueryBuilder
     */
    public function createQueryBuilder($alias)
    {
        $query_builder = $this->_em->createQueryBuilder()
            ->select($alias)
            ->from($this->_entityName, $alias);
        
        if(is_subclass_of($this->getClassName(),  "Harproject\AppBundle\Entity\HarprojectInterface")) {
            $query_builder->andWhere($alias.".deleted_at is NULL");
        }
        return $query_builder;
    }
    
    /**
     * Creates a new QueryBuilder instance that is prepopulated for this entity name.
     *
     * @param string $alias
     *
     * @return QueryBuilder
     */
    public function rawCreateQueryBuilder($alias)
    {
        return $this->_em->createQueryBuilder()
            ->select($alias)
            ->from($this->_entityName, $alias);
    }
    
    /**
     * Finds an entity by its primary key / identifier.
     *
     * @param mixed    $id          The identifier.
     * @param int      $lockMode    The lock mode.
     * @param int|null $lockVersion The lock version.
     *
     * @return object|null The entity instance or NULL if the entity can not be found.
     */
    public function find($id, $lockMode = LockMode::NONE, $lockVersion = null)
    {
    	if(  is_subclass_of( $this->getClassName(),  "Harproject\AppBundle\Entity\HarprojectInterface" ) ) {
        	return parent::findOneBy( array( 'id' => $id ) );
        }
        else {
        	return parent::find($id, $lockMode, $lockVersion );
        }
    }

    /**
     * Finds all entities in the repository.
     *
     * @return array The entities.
     */
    public function findAll()
    {
        return $this->findBy(array());
    }

    /**
     * Finds entities by a set of criteria.
     * It also does a smart check to see if an entity of type Harproject\AppBundle\Entity\HarprojectInterface
     * is considered as deleted (using the delted_at field). If so this type of entities are not returned
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return array The objects.
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
    	if(  is_subclass_of( $this->getClassName(),  "Harproject\AppBundle\Entity\HarprojectInterface" ) ) {
    		$criteria['deleted_at'] = null;
    	}

        $persister = $this->_em->getUnitOfWork()->getEntityPersister($this->_entityName);

        return $persister->loadAll($criteria, $orderBy, $limit, $offset);
    }

    /**
     * Finds entities by a set of criteria.
     * As opposed to findBy, does not do any check concerning deleted states
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return array The objects.
     */
    public function rawFindBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        $persister = $this->_em->getUnitOfWork()->getEntityPersister($this->_entityName);

        return $persister->loadAll($criteria, $orderBy, $limit, $offset);
    }


    /**
     * Finds a single entity by a set of criteria.
     * It also does a smart check to see if an entity of type Harproject\AppBundle\Entity\HarprojectInterface
     * is considered as deleted (using the delted_at field). If so this type of entities are not returned
     *
     * @param array $criteria
     * @param array|null $orderBy
     *
     * @return object|null The entity instance or NULL if the entity can not be found.
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
    	if(  is_subclass_of( $this->getClassName(),  "Harproject\AppBundle\Entity\HarprojectInterface" ) ) {
    		$criteria['deleted_at'] = null;
    	}


        $persister = $this->_em->getUnitOfWork()->getEntityPersister($this->_entityName);

        return $persister->load($criteria, null, null, array(), 0, 1, $orderBy);
    }


    /**
     * Finds a single entity by a set of criteria.
     * As opposed to findBy, does not do any check concerning deleted states
     *
     * @param array $criteria
     * @param array|null $orderBy
     *
     * @return object|null The entity instance or NULL if the entity can not be found.
     */
    public function rawFindOneBy(array $criteria, array $orderBy = null)
    {
        $persister = $this->_em->getUnitOfWork()->getEntityPersister($this->_entityName);

        return $persister->load($criteria, null, null, array(), 0, 1, $orderBy);
    }
}