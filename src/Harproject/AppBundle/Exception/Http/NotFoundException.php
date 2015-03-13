<?php

namespace Harproject\AppBundle\Exception\Http;
use Harproject\AppBundle\Exception\Http\HttpException;

class NotFoundException extends HttpException{
    
    public function __construct($message = null, \Exception $previous = null, $code = 0)
    {
        parent::__construct(404, $message, $previous, array(), $code);
    }
}
