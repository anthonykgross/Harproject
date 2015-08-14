<?php
/**
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */
namespace Harproject\AppBundle\Entity\Repository;

use Harproject\OverrideBundle\Doctrine\EntityRepository;
use Harproject\AppBundle\Entity\User;

class Task extends EntityRepository {
    
    public function findTasks(User $user) {
        return $this->getEntityManager()
                ->createQuery(
                    '   SELECT t 
                        FROM HarprojectAppBundle:Task t
                            JOIN t.project p
                            JOIN p.members m 
                            JOIN m.user u
                        WHERE u.id = :user_id'
                )
                ->setParameter(":user_id", $user)
                ->getResult();
    }
    
    public function findSelectedTasks(User $user) {
        return $this->getEntityManager()
                ->createQuery(
                    '   SELECT mht 
                        FROM HarprojectAppBundle:MemberHasTask mht
                            JOIN mht.task t
                            JOIN mht.member m
                            JOIN m.user u
                        WHERE u.id = :user_id
                        AND t.deleted_at is NULL
                        AND mht.deleted_at is NULL'
                )
                ->setParameter(":user_id", $user)
                ->getResult();
    }
    
    public function findSelectedTask(User $user, $member_has_task_id) {
        return $this->getEntityManager()
                ->createQuery(
                    '   SELECT mht 
                        FROM HarprojectAppBundle:MemberHasTask mht
                            JOIN mht.task t
                            JOIN mht.member m
                            JOIN m.user u
                        WHERE u.id = :user_id
                        AND t.deleted_at is NULL
                        AND mht.deleted_at is NULL
                        AND mht.id = :member_has_task_id'
                )
                ->setParameter(":user_id", $user)
                ->setParameter(":member_has_task_id", $member_has_task_id)
                ->getOneOrNullResult();
    }
}