<?php
/**
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */
namespace Harproject\AppBundle\Entity\Repository;

use Harproject\OverrideBundle\Doctrine\EntityRepository;

class Task extends EntityRepository {
    
    public function findTasks(Array $member_ids) {
        return $this->getEntityManager()
                ->createQuery(
                    '   SELECT t 
                        FROM HarprojectAppBundle:Task t
                            JOIN t.project p
                            JOIN p.members m 
                        WHERE m.id IN (:member_ids)'
                )
                ->setParameter(":member_ids", $member_ids)
                ->getResult();
    }
}