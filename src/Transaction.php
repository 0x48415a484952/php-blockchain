<?php

declare(strict_types=1);

namespace Hazhir;

class Transaction
{
    public array $transactions;
    public const MINING_REWARD = 50;

    public function __construct(array $transactions)
    {
        $this->transactions = $transactions;
    }
}