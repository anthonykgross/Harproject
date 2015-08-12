<?php

namespace Harproject\AppBundle\Entity;

use Harproject\AppBundle\Entity\HarprojectInterface;
use Doctrine\ORM\Mapping as ORM;
use Harproject\OverrideBundle\Entity\FOSUserBundle\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="harp_User")
 */
class User extends BaseUser implements HarprojectInterface {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=32)
     */    
    private $apiKey;
    
    /**
     * @ORM\Column(type="string", length=32)
     */    
    private $apiSecret;
    
    /**
     * @ORM\OneToMany(targetEntity="Member", mappedBy="user", cascade={"remove", "persist"})
     */
    private $members;

    /**
     * @var datetime
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deleted_at;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->members      = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set apiKey
     *
     * @param string $apiKey
     * @return User
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Get apiKey
     *
     * @return string 
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set apiSecret
     *
     * @param string $apiSecret
     * @return User
     */
    public function setApiSecret($apiSecret)
    {
        $this->apiSecret = $apiSecret;

        return $this;
    }

    /**
     * Get apiSecret
     *
     * @return string 
     */
    public function getApiSecret()
    {
        return $this->apiSecret;
    }

    /**
     * Add members
     *
     * @param \Harproject\AppBundle\Entity\Member $members
     * @return User
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
     * Set deleted_at
     *
     * @param \DateTime $deletedAt
     * @return Harproject
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deleted_at = $deletedAt;

        return $this;
    }

    /**
     * Get deleted_at
     *
     * @return \DateTime 
     */
    public function getDeletedAt()
    {
        return $this->deleted_at;
    }

    /**
     * Check if this entity is deleted or not
     *
     * @return boolean 
     */
    public function isDeleted()
    {
        return $this->deleted_at != null;
    }
}
