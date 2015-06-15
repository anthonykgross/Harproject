<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Status
 *
 * @ORM\Table(name="harp_Status")
 * @ORM\Entity
 */
class Status
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
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=32)
     */
    private $label;
    

    /**
     * @ORM\OneToMany(targetEntity="TaskHasStatus", mappedBy="status", cascade={"remove", "persist"})
     */
    private $taskHasStatuss;
    
    /**
     * @var datetime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->taskHasStatuss = new \Doctrine\Common\Collections\ArrayCollection();
        $this->created_at           = new \DateTime();
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
     * Set label
     *
     * @param string $label
     * @return Status
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Status
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
     * Add taskHasStatuss
     *
     * @param \Harproject\AppBundle\Entity\TaskHasStatus $taskHasStatuss
     * @return Status
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
}
