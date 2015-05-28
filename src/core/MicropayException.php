<?php

namespace tanlabs\micropay\core;

class MicropayException extends \Exception
{
    protected $errorCode;

    public function __construct($errorCode = 0, $message = null, $code = 0, \Exception $previous = null)
    {
        $this->errorCode = $errorCode;
        parent::__construct($message, $code, $previous);
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }
}

