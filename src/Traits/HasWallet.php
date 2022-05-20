<?php

namespace Stephenjude\Wallet\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Stephenjude\Wallet\Exceptions\InsufficientFundException;
use Stephenjude\Wallet\Exceptions\InvalidAmountException;

trait HasWallet
{
    /**
     * @param int|float $amount
     *
     * @return float|int
     * @throws InvalidAmountException
     */
    public function deposit(int|float $amount): float|int
    {
        $this->throwExceptionIfAmountIsInvalid($amount);

        $balance = $this->wallet_balance ?? 0;

        $balance += $amount;

        $this->forceFill(['wallet_balance' => $balance])->save();

        return $balance;
    }

    /**
     * @param int|float $amount
     *
     * @return float|int
     * @throws InsufficientFundException
     * @throws InvalidAmountException
     */
    public function withdraw(int|float $amount): float|int
    {
        $this->throwExceptionIfAmountIsInvalid($amount);

        $this->throwExceptionIfFundIsInsufficient($amount);

        $balance = $this->wallet_balance - $amount;

        $this->forceFill(['wallet_balance' => $balance])->save();

        return $balance;
    }

    /**
     * @param int|float $amount
     *
     * @return bool
     * @throws InvalidAmountException
     */
    public function canWithdraw(int|float $amount): bool
    {
        $this->throwExceptionIfAmountIsInvalid($amount);

        $balance = $this->wallet_balance ?? 0;

        return $balance >= $amount;
    }

    /**
     * @return Attribute
     */
    public function balance(): Attribute
    {
        return Attribute::get(fn() => $this->wallet_balance ?? 0);
    }

    /**
     * @param int|float $amount
     *
     * @return void
     * @throws InvalidAmountException
     */
    public function throwExceptionIfAmountIsInvalid(int|float $amount): void
    {
        if ($amount <= 0) {
            throw new InvalidAmountException();
        }
    }

    /**
     * @param int|float $amount
     *
     * @return void
     * @throws InsufficientFundException
     * @throws InvalidAmountException
     */
    public function throwExceptionIfFundIsInsufficient(int|float $amount): void
    {
        if (!$this->canWithdraw($amount)) {
            throw new InsufficientFundException();
        }
    }
}
