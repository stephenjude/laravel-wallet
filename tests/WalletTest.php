<?php

use Illuminate\Support\Facades\Schema;
use Stephenjude\Wallet\Exceptions\InsufficientFundException;
use Stephenjude\Wallet\Exceptions\InvalidAmountException;
use Stephenjude\Wallet\Tests\Models\User;

use const Stephenjude\Wallet\Tests\Models\User;

test('migration has added wallet_balance column to users table', function () {
    expect(Schema::hasColumn('users', 'wallet_balance'))->toBe(true);
});

test('user can deposit fund', function () {
    $user =  User::factory()->create();

    $user->deposit(200);

    expect($user->wallet_balance)->toBe(200);
});

test('user can withdraw fund', function () {
    $user =  User::factory()->create();

    $user->deposit(200);

    $user->withdraw(150);

    expect($user->wallet_balance)->toBe(50);
});

test('deposit invalid amount should throw exception', function () {
    $user =  User::factory()->create();

    $user->deposit(0);
})->throws(InvalidAmountException::class);

test('withdraw invalid amount should throw exception', function () {
    $user =  User::factory()->create();

    $user->withdraw(-1);
})->throws(InvalidAmountException::class);

test('insufficent balance should throw exception', function () {
    $user =  User::factory()->create();

    $user->withdraw(1000);
})->throws(InsufficientFundException::class);

