<?php

namespace Stephenjude\Wallet\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Stephenjude\Wallet\Interfaces\Wallet;
use Stephenjude\Wallet\Tests\Database\Factories\UserFactory;
use Stephenjude\Wallet\Traits\HasWallet;

class User extends Authenticatable implements Wallet
{
    use HasFactory;
    use HasWallet;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return mixed
     */
    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
