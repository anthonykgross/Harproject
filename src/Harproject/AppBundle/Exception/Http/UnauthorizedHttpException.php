<?php

namespace Harproject\AppBundle\Exception\Http;
use Harproject\AppBundle\Exception\Http\HttpException;

class UnauthorizedHttpException extends HttpException{
    
    public function __construct($challenge, $message = null, \Exception $previous = null, $code = 0)
    {
        $headers = array('WWW-Authenticate' => $challenge);

        parent::__construct(401, $message, $previous, $headers, $code);
    }
}
