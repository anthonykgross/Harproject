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
    
}
