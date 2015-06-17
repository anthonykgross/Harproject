<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Harproject\AppBundle\Entity\Harproject;

/**
 * Role
 *
 * @ORM\Table(name="harp_Project")
 * @ORM\Entity
 */
class Project extends Harproject
{
    
    /**
     * @ORM\OneToMany(targetEntity="Member", mappedBy="project", cascade={"remove", "persist"})
     */
    private $members;
    
    /**
     * Define the relation between this projects and its related tasks
     * 
     * @ORM\OneToMany(targetEntity="Task", mappedBy="project")
     */
    private $tasks;
    
    /**
     * @var string
     *
     * @ORM\Column(name="site_url", type="string", length=45, nullable=true)
     */
    private $site_url;
    
    /**
     * @var string
     *
     * @ORM\Column(name="git", type="string", length=45, nullable=true)
     */
    private $git;
    
    /**
     * @var string
     *
     * @ORM\Column(name="svn", type="string", length=45, nullable=true)
     */
    private $svn;
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->members  = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tasks    = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set site_url
     *
     * @param string $siteUrl
     * @return Project
     */
    public function setSiteUrl($siteUrl)
    {
        $this->site_url = $siteUrl;

        return $this;
    }

    /**
     * Get site_url
     *
     * @return string 
     */
    public function getSiteUrl()
    {
        return $this->site_url;
    }

    /**
     * Set git
     *
     * @param string $git
     * @return Project
     */
    public function setGit($git)
    {
        $this->git = $git;

        return $this;
    }

    /**
     * Get git
     *
     * @return string 
     */
    public function getGit()
    {
        return $this->git;
    }

    /**
     * Set svn
     *
     * @param string $svn
     * @return Project
     */
    public function setSvn($svn)
    {
        $this->svn = $svn;

        return $this;
    }

    /**
     * Get svn
     *
     * @return string 
     */
    public function getSvn()
    {
        return $this->svn;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Project
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
     * @return Project
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
     * Add members
     *
     * @param \Harproject\AppBundle\Entity\Member $members
     * @return Project
     */
    public function addMember(\Harproject\AppBundle\Entity\Member $members)
    {
        $this->members[] = $members;

        return $this;
    }

    /**
     * Remove members
     *
     * @param \Harproject\AppBundle\Entity\Member $members
     */
    public function removeMember(\Harproject\AppBundle\Entity\Member $members)
    {
        $this->members->removeElement($members);
    }

    /**
     * Get members
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Add tasks
     *
     * @param \Harproject\AppBundle\Entity\Task $tasks
     * @return Project
     */
    public function addTask(\Harproject\AppBundle\Entity\Task $tasks)
    {
        $this->tasks[] = $tasks;

        return $this;
    }

    /**
     * Remove tasks
     *
     * @param \Harproject\AppBundle\Entity\Task $tasks
     */
    public function removeTask(\Harproject\AppBundle\Entity\Task $tasks)
    {
        $this->tasks->removeElement($tasks);
    }

    /**
     * Get tasks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTasks()
    {
        return $this->tasks;
    }
}
