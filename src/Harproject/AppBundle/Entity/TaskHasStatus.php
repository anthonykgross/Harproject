<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TaskHasStatus
 *
 * @ORM\Table(name="harp_task_has_status", uniqueConstraints={@ORM\UniqueConstraint(name="idxUnique", columns={"Task_id", "Status_id"})})
 * @ORM\Entity
 */
class TaskHasStatus
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;


    /**
     * @var \Task
     *
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="taskHasStatuss")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Task_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $task;
         
    /**
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status", inversedBy="taskHasStatuss")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Status_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $status;
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return TaskHasStatus
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set task
     *
     * @param \Harproject\AppBundle\Entity\Task $task
     * @return TaskHasStatus
     */
    public function setTask(\Harproject\AppBundle\Entity\Task $task)
    {
        $this->task = $task;

        return $this;
    }

    /**
     * Get task
     *
     * @return \Harproject\AppBundle\Entity\Task 
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * Set status
     *
     * @param \Harproject\AppBundle\Entity\Status $status
     * @return TaskHasStatus
     */
    public function setStatus(\Harproject\AppBundle\Entity\Status $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Harproject\AppBundle\Entity\Status 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
