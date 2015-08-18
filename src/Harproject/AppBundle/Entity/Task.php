<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Harproject\AppBundle\Entity\Harproject;

/**
 * Task
 *
 * @ORM\Table(name="harp_Task")
 * @ORM\Entity(repositoryClass="Harproject\AppBundle\Entity\Repository\Task")
 */
class Task extends Harproject{
    /**
     * Define the relation between this task and users that are attributed to it
     * 
     * @ORM\OneToMany(targetEntity="MemberHasTask", mappedBy="task", cascade={"remove", "persist"})
     */
    private $memberHasTasks;

    /**
     * Define the relation between this task and it's attached project
     * 
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="tasks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Project_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $project;

    /**
     * Define the relation between this task and it's owner (i.e: it's author)
     * 
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="createdTasks" )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Author_id", referencedColumnName="id")
     * }) 
     */
    private $author;
    
    /**
     * @ORM\OneToMany(targetEntity="Relation", mappedBy="task_a", cascade={"remove", "persist"})
     */
    private $relationAs;
    
    /**
     * @ORM\OneToMany(targetEntity="Relation", mappedBy="task_b", cascade={"remove", "persist"})
     */
    private $relationBs;
   
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", nullable=true)
     */
    private $description;

    /**
     * Estimated task duration in hour or fraction of hour
     * 
     * @var float
     *
     * @ORM\Column(name="estimated_time", type="float")
     */
    private $estimated_time;

    /**
     * Time spended on this task in hour or fraction of hour.
     * Could be 1,2,3... or 0.1, 0.2 ...
     * 
     * @var float
     *
     * @ORM\Column(name="spent_time", type="float")
     */
    private $spent_time;

    /**
     * @ORM\OneToMany(targetEntity="TaskHasStatus", mappedBy="task", cascade={"remove", "persist"})
     */
    private $taskHasStatuss;
    
    /**
     * @ORM\OneToMany(targetEntity="TaskHasTicket", mappedBy="task", cascade={"remove", "persist"})
     */
    private $taskHasTickets;
    
    /**
     * @ORM\OneToMany(targetEntity="TaskHasTag", mappedBy="task", cascade={"remove", "persist"})
     */
    private $taskHasTags;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->memberHasTasks   = new \Doctrine\Common\Collections\ArrayCollection();
        $this->relationAs       = new \Doctrine\Common\Collections\ArrayCollection();
        $this->relationBs       = new \Doctrine\Common\Collections\ArrayCollection();
        $this->taskHasStatuss   = new \Doctrine\Common\Collections\ArrayCollection();
        $this->taskHasTickets   = new \Doctrine\Common\Collections\ArrayCollection();
        $this->taskHasTags      = new \Doctrine\Common\Collections\ArrayCollection();
        $this->spent_time       = 0;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Task
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Task
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set estimated_time
     *
     * @param float $estimatedTime
     * @return Task
     */
    public function setEstimatedTime($estimatedTime)
    {
        $this->estimated_time = $estimatedTime;

        return $this;
    }

    /**
     * Get estimated_time
     *
     * @return float 
     */
    public function getEstimatedTime()
    {
        return $this->estimated_time;
    }

    /**
     * Set spent_time
     *
     * @param float $spentTime
     * @return Task
     */
    public function setSpentTime($spentTime)
    {
        $this->spent_time = $spentTime;

        return $this;
    }

    /**
     * Get spent_time
     *
     * @return float 
     */
    public function getSpentTime()
    {
        return $this->spent_time;
    }

    /**
     * Add memberHasTasks
     *
     * @param \Harproject\AppBundle\Entity\MemberHasTask $memberHasTasks
     * @return Task
     */
    public function addMemberHasTask(\Harproject\AppBundle\Entity\MemberHasTask $memberHasTasks)
    {
        $this->memberHasTasks[] = $memberHasTasks;

        return $this;
    }

    /**
     * Remove memberHasTasks
     *
     * @param \Harproject\AppBundle\Entity\MemberHasTask $memberHasTasks
     */
    public function removeMemberHasTask(\Harproject\AppBundle\Entity\MemberHasTask $memberHasTasks)
    {
        $this->memberHasTasks->removeElement($memberHasTasks);
    }

    /**
     * Get memberHasTasks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMemberHasTasks()
    {
        return $this->memberHasTasks;
    }

    /**
     * Set project
     *
     * @param \Harproject\AppBundle\Entity\Project $project
     * @return Task
     */
    public function setProject(\Harproject\AppBundle\Entity\Project $project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \Harproject\AppBundle\Entity\Project 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set author
     *
     * @param \Harproject\AppBundle\Entity\Member $author
     * @return Task
     */
    public function setAuthor(\Harproject\AppBundle\Entity\Member $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Harproject\AppBundle\Entity\Member 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add relationAs
     *
     * @param \Harproject\AppBundle\Entity\Relation $relationAs
     * @return Task
     */
    public function addRelationA(\Harproject\AppBundle\Entity\Relation $relationAs)
    {
        $this->relationAs[] = $relationAs;

        return $this;
    }

    /**
     * Remove relationAs
     *
     * @param \Harproject\AppBundle\Entity\Relation $relationAs
     */
    public function removeRelationA(\Harproject\AppBundle\Entity\Relation $relationAs)
    {
        $this->relationAs->removeElement($relationAs);
    }

    /**
     * Get relationAs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRelationAs()
    {
        return $this->relationAs;
    }

    /**
     * Add relationBs
     *
     * @param \Harproject\AppBundle\Entity\Relation $relationBs
     * @return Task
     */
    public function addRelationB(\Harproject\AppBundle\Entity\Relation $relationBs)
    {
        $this->relationBs[] = $relationBs;

        return $this;
    }

    /**
     * Remove relationBs
     *
     * @param \Harproject\AppBundle\Entity\Relation $relationBs
     */
    public function removeRelationB(\Harproject\AppBundle\Entity\Relation $relationBs)
    {
        $this->relationBs->removeElement($relationBs);
    }

    /**
     * Get relationBs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRelationBs()
    {
        return $this->relationBs;
    }

    /**
     * Add taskHasStatuss
     *
     * @param \Harproject\AppBundle\Entity\TaskHasStatus $taskHasStatuss
     * @return Task
     */
    public function addTaskHasStatuss(\Harproject\AppBundle\Entity\TaskHasStatus $taskHasStatuss)
    {
        $this->taskHasStatuss[] = $taskHasStatuss;

        return $this;
    }

    /**
     * Remove taskHasStatuss
     *
     * @param \Harproject\AppBundle\Entity\TaskHasStatus $taskHasStatuss
     */
    public function removeTaskHasStatuss(\Harproject\AppBundle\Entity\TaskHasStatus $taskHasStatuss)
    {
        $this->taskHasStatuss->removeElement($taskHasStatuss);
    }

    /**
     * Get taskHasStatuss
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTaskHasStatuss()
    {
        return $this->taskHasStatuss;
    }

    /**
     * Add taskHasTickets
     *
     * @param \Harproject\AppBundle\Entity\TaskHasTicket $taskHasTickets
     * @return Task
     */
    public function addTaskHasTicket(\Harproject\AppBundle\Entity\TaskHasTicket $taskHasTickets)
    {
        $this->taskHasTickets[] = $taskHasTickets;

        return $this;
    }

    /**
     * Remove taskHasTickets
     *
     * @param \Harproject\AppBundle\Entity\TaskHasTicket $taskHasTickets
     */
    public function removeTaskHasTicket(\Harproject\AppBundle\Entity\TaskHasTicket $taskHasTickets)
    {
        $this->taskHasTickets->removeElement($taskHasTickets);
    }

    /**
     * Get taskHasTickets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTaskHasTickets()
    {
        return $this->taskHasTickets;
    }

    /**
     * Add taskHasTags
     *
     * @param \Harproject\AppBundle\Entity\TaskHasTag $taskHasTags
     * @return Task
     */
    public function addTaskHasTag(\Harproject\AppBundle\Entity\TaskHasTag $taskHasTags)
    {
        $this->taskHasTags[] = $taskHasTags;

        return $this;
    }

    /**
     * Remove taskHasTags
     *
     * @param \Harproject\AppBundle\Entity\TaskHasTag $taskHasTags
     */
    public function removeTaskHasTag(\Harproject\AppBundle\Entity\TaskHasTag $taskHasTags)
    {
        $this->taskHasTags->removeElement($taskHasTags);
    }

    /**
     * Get taskHasTags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTaskHasTags()
    {
        return $this->taskHasTags;
    }
}
