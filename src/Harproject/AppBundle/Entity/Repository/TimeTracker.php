<?php
/**
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */
namespace Harproject\AppBundle\Entity\Repository;

use Harproject\OverrideBundle\Doctrine\EntityRepository;
use Harproject\AppBundle\Entity\User;

class TimeTracker extends EntityRepository {
    
    public function findTimeTrackerForTask($task_id, User $user) {
        return $this->getEntityManager()
                ->createQuery(
                    '   SELECT ti 
                        FROM HarprojectAppBundle:TimeTracker ti
                            JOIN ti.memberHasTask mht
                            JOIN mht.member m
                            JOIN m.user u
                            JOIN mht.task ta
                        WHERE u.id = :user_id
                        AND ti.deleted_at is NULL
                        AND ta.deleted_at is NULL
                        AND mht.deleted_at is NULL
                        AND ta.id = :task_id'
                )
                ->setParameter(":user_id", $user)
                ->setParameter(":task_id", $task_id)
                ->getResult();
    }
    
    public function findTimetrackerExceptOne($task_id, User $user){
        return $this->getEntityManager()
                ->createQuery(
                    '   SELECT ti 
                        FROM HarprojectAppBundle:TimeTracker ti
                            JOIN ti.memberHasTask mht
                            JOIN mht.member m
                            JOIN m.user u
                            JOIN mht.task ta
                        WHERE u.id = :user_id
                        AND ti.deleted_at is NULL
                        AND ta.deleted_at is NULL
                        AND mht.deleted_at is NULL
                        AND ta.id <> :task_id'
                )
                ->setParameter(":user_id", $user)
                ->setParameter(":task_id", $task_id)
                ->getResult();
    }
}