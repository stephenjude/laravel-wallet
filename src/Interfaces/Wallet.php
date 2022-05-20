<?php

namespace Stephenjude\Wallet\Interfaces;

interface Wallet
{
    /**
     * @param int|float $amount
     *
     * @return int|float
     */
    public function deposit(int|float $amount): int|float;

    /**
     * @param int|float $amount
     *
     * @return int|float
     */
    public function withdraw(int|float $amount): int|float;

    /**
     * @param int|float $amount
     *
     * @return bool
     */
    public function canWithdraw(int|float $amount): bool;

    /**
     * @param int|float $amount
     *
     * @return void
     */
    public function throwExceptionIfAmountIsInvalid(int|float $amount): void;

    /**
     * @param int|float $amount
     *
     * @return void
     */
    public function throwExceptionIfFundIsInsufficient(int|float $amount): void;
}
