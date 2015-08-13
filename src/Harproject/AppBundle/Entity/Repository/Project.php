<?php
/**
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */
namespace Harproject\AppBundle\Entity\Repository;

use Harproject\OverrideBundle\Doctrine\EntityRepository;
use Harproject\AppBundle\Entity\User;

class Project extends EntityRepository {
    
    public function findProjects(User $user) {
        return $this->getEntityManager()
                ->createQuery(
                    '   SELECT p 
                        FROM HarprojectAppBundle:Project p 
                            JOIN p.members m 
                            JOIN m.user u
                        WHERE u.id = :user_id
                        AND m.deleted_at IS NULL
                        AND p.deleted_at IS NULL'
                )
                ->setParameter(":user_id", $user->getId())
                ->getResult();
    }
}