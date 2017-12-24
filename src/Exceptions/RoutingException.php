<?php

namespace Eskirex\Component\Web\Exceptions;

use Throwable;

class RoutingException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}