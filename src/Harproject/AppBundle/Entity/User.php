<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Harproject\OverrideBundle\Entity\FOSUserBundle\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="harp_user")
 */
class User extends BaseUser {
    
    /**
     * @ORM\Column(type="string", length=32)
     */    
    private $apiKey;
    
    /**
     * @ORM\Column(type="string", length=32)
     */    
    private $apiSecret;
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
