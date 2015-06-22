<?php
/**
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */
namespace Harproject\AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class Project extends EntityRepository {
    
    public function findProjects(Array $member_ids) {
        return $this->getEntityManager()
                ->createQuery(
                    '   SELECT p 
                        FROM HarprojectAppBundle:Project p 
                            JOIN p.members m 
                        WHERE m.id IN (:member_ids)'
                )
                ->setParameter(":member_ids", $member_ids)
                ->getResult();
    }
}