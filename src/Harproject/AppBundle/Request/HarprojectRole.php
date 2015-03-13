<?php

namespace Harproject\AppBundle\Request;

/**
 * @Annotation
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */
class HarprojectRole {

    private $role; 
    
    public function  __construct(array $data) {
        
        if (isset($data['value'])) {
            $data['role'] = $data['value'];
            unset($data['value']);
        }

        foreach ($data as $key => $value) {
            $method = 'set' . $key;
            if (!method_exists($this, $method)) {
                throw new \BadMethodCallException(sprintf("Unknown property '%s' on annotation '%s'.", $key, get_class($this)));
            }
            $this->$method($value);
        }
    }

    public function setRole($role){
        $this->role = $role;
        return $this;
    }
    
    public function getRole(){
        return $this->role;
    }
}
