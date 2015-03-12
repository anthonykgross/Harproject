<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MemberHasTask
 *
 * @ORM\Table(name="harp_member_has_task", uniqueConstraints={@ORM\UniqueConstraint(name="idxUnique", columns={"Member_id", "Task_id"})})
 * @ORM\Entity
 */
class MemberHasTask
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var datetime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;
     
    /**
     * @var \Member
     *
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="memberHasTasks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Member_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $member;
         
    /**
     * @var \Task
     *
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="memberHasTasks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Task_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $task;

    public function __construct() {
        $this->created_at = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

}
