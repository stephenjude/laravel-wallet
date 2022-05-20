<?php

namespace Stephenjude\Wallet\Exceptions;

use Exception;

class InvalidAmountException extends Exception
{
    /**
     * @var string
     */
    protected $message = "invalid amount";
}
