<?php

namespace AWeberForLaravel\Exceptions;

class AWeberAPINotAvailableException extends \Exception
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        $trace = $this->getTrace();
        $cls = $trace[0]['class'];
        $message = $cls . ": $message";
        parent::__construct($message, $code, $previous);
    }
}
