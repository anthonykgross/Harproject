<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Harproject\AppBundle\Entity\Harproject;

/**
 * Relation
 *
 * @ORM\Table(name="harp_Relation", uniqueConstraints={@ORM\UniqueConstraint(name="idxUnique", columns={"Task_A_id", "Task_B_id", "Relation_Type_id"})})
 * @ORM\Entity
 */
class Relation extends Harproject
{
    /**
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="relationAs" )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Task_A_id", referencedColumnName="id", nullable=false)
     * }) 
     */
    private $task_a;
    
    /**
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="relationBs" )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Task_B_id", referencedColumnName="id", nullable=false)
     * }) 
     */
    private $task_b;
    
    /**
     * @ORM\ManyToOne(targetEntity="RelationType", inversedBy="relations" )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Relation_Type_id", referencedColumnName="id", nullable=false)
     * }) 
     */
    private $relationType;

    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Set task_a
     *
     * @param \Harproject\AppBundle\Entity\Task $taskA
     * @return Relation
     */
    public function setTaskA(\Harproject\AppBundle\Entity\Task $taskA)
    {
        $this->task_a = $taskA;

        return $this;
    }

    /**
     * Get task_a
     *
     * @return \Harproject\AppBundle\Entity\Task 
     */
    public function getTaskA()
    {
        return $this->task_a;
    }

    /**
     * Set task_b
     *
     * @param \Harproject\AppBundle\Entity\Task $taskB
     * @return Relation
     */
    public function setTaskB(\Harproject\AppBundle\Entity\Task $taskB)
    {
        $this->task_b = $taskB;

        return $this;
    }

    /**
     * Get task_b
     *
     * @return \Harproject\AppBundle\Entity\Task 
     */
    public function getTaskB()
    {
        return $this->task_b;
    }

    /**
     * Set relationType
     *
     * @param \Harproject\AppBundle\Entity\RelationType $relationType
     * @return Relation
     */
    public function setRelationType(\Harproject\AppBundle\Entity\RelationType $relationType)
    {
        $this->relationType = $relationType;

        return $this;
    }

    /**
     * Get relationType
     *
     * @return \Harproject\AppBundle\Entity\RelationType 
     */
    public function getRelationType()
    {
        return $this->relationType;
    }
}
