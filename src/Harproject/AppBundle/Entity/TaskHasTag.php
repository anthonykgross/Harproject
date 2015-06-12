<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TaskHasTag
 *
 * @ORM\Table(name="harp_Task_has_Tag", uniqueConstraints={@ORM\UniqueConstraint(name="idxUnique", columns={"Tag_id", "Task_id"})})
 * @ORM\Entity
 */
class TaskHasTag
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


    /**
     * @var datetime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;
    

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

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return TaskHasTag
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
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
