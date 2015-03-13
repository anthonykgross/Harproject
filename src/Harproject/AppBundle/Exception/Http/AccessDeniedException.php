<?php

namespace Harproject\AppBundle\Exception\Http;
use Harproject\AppBundle\Exception\Http\HttpException;

class AccessDeniedException extends HttpException{
    
    public function __construct($message = null, \Exception $previous = null, $code = 0)
    {
        parent::__construct(403, $message, $previous, array(), $code);
    }
}
