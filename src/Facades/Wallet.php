<?php

namespace Stephenjude\Wallet\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Stephenjude\Wallet\Interfaces\Wallet
 */
class Wallet extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'wallet';
    }
}
