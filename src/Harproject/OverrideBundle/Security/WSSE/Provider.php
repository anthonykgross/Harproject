<?php

namespace Harproject\OverrideBundle\Security\WSSE;

use Symfony\Component\Security\Core\User\UserInterface;
use Escape\WSSEAuthenticationBundle\Security\Core\Authentication\Provider\Provider as BaseProvider;

use Harproject\AppBundle\Entity\User;

/**
 * Description of Provider
 *
 * @author cvidal
 */
class Provider extends BaseProvider {
    
    protected function getSecret(UserInterface $user) {
        
        if( !( $user instanceof User) ) {
            // Handle type exception here
        }
        
        return $user->getApiSecret();
    }

    protected function getSalt(UserInterface $user) {
        return "";
    }

}
