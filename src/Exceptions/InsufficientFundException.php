<?php

namespace Stephenjude\Wallet\Exceptions;

use Exception;

class InsufficientFundException extends Exception
{
    /**
     * @var string
     */
    protected $message = "insufficient fund";
}
