<?php

use Illuminate\Support\Facades\Schema;
use Stephenjude\Wallet\Exceptions\InsufficientFundException;
use Stephenjude\Wallet\Exceptions\InvalidAmountException;
use Stephenjude\Wallet\Tests\Models\User;

/**
 * @return void
 */
test('migration has added wallet_balance column to users table', function () {
    expect(Schema::hasColumn('users', 'wallet_balance'))->toBe(true);
});

/**
 * @return void
 */
test('user can deposit fund', function () {
    $user = User::factory()->create();

    $user->deposit(200.22);

    $user->deposit(200);

    expect($user->wallet_balance)->toBe(400.22);
});
/**
 * @return void
 */
test('user can withdraw fund', function () {
    $user = User::factory()->create();

    $user->deposit(200);

    $user->withdraw(150);

    $user->withdraw(0.5);

    expect($user->wallet_balance)->toBe(49.5);
});

/**
 * @return void
 */
test('deposit invalid amount should throw exception', function () {
    $user = User::factory()->create();

    $user->deposit(0);
})->throws(InvalidAmountException::class);

/**
 * @return void
 */
test('withdraw invalid amount should throw exception', function () {
    $user = User::factory()->create();

    $user->withdraw(-1);
})->throws(InvalidAmountException::class);

/**
 * @return void
 */
test('insufficent balance should throw exception', function () {
    $user = User::factory()->create();

    $user->withdraw(1000);
})->throws(InsufficientFundException::class);
