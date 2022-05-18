<?php

namespace Stephenjude\Wallet\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Stephenjude\Wallet\Exceptions\InsufficientFundException;
use Stephenjude\Wallet\Exceptions\InvalidAmountException;

trait HasWallet
{
    protected string $walletColumnName = 'wallet_balance';

    protected function getBalanceValue(): float|int
    {
        return $this->{$this->walletColumnName} ?? 0;
    }

    public function balance(): Attribute
    {
        return Attribute::get(fn() => $this->getBalanceValue());
    }

    /**
     * @param int|float $amount
     * @return float|int
     * @throws InvalidAmountException
     */
    public function deposit(int|float $amount): float|int
    {
        $this->throwExceptionIfAmountIsInvalid($amount);
        $this->{$this->walletColumnName} += $amount;
        $this->save();
        return $this->getBalanceValue();
    }

    /**
     * @param int|float $amount
     * @return float|int
     * @throws InsufficientFundException
     * @throws InvalidAmountException
     */
    public function withdraw(int|float $amount): float|int
    {
        $this->throwExceptionIfAmountIsInvalid($amount);
        $this->throwExceptionIfFundIsInsufficient($amount);
        $this->{$this->walletColumnName} -= $amount;
        $this->save();
        return $this->getBalanceValue();
    }

    /**
     * @throws InvalidAmountException
     */
    public function canWithdraw(int|float $amount): bool
    {
        $this->throwExceptionIfAmountIsInvalid($amount);
        return $this->getBalanceValue() >= $amount;
    }

    /**
     * @throws InvalidAmountException
     */
    public function throwExceptionIfAmountIsInvalid(int|float $amount): void
    {
        if ($amount <= 0) {
            throw new InvalidAmountException();
        }
    }

    /**
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


