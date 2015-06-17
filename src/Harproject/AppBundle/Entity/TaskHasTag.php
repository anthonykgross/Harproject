<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Harproject\AppBundle\Entity\Harproject;

/**
 * TaskHasTag
 *
 * @ORM\Table(name="harp_Task_has_Tag", uniqueConstraints={@ORM\UniqueConstraint(name="idxUnique", columns={"Tag_id", "Task_id"})})
 * @ORM\Entity
 */
class TaskHasTag extends Harproject
{
    /**
     * @var \Task
     *
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="taskHasTags")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Task_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $task;
         
    /**
     * @var \Tag
     *
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="taskHasTags")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tag_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $tag;

    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Set task
     *
     * @param \Harproject\AppBundle\Entity\Task $task
     * @return TaskHasTag
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
     * Set tag
     *
     * @param \Harproject\AppBundle\Entity\Tag $tag
     * @return TaskHasTag
     */
    public function setTag(\Harproject\AppBundle\Entity\Tag $tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \Harproject\AppBundle\Entity\Tag 
     */
    public function getTag()
    {
        return $this->tag;
    }
}
