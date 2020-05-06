<?php

declare(strict_types=1);

namespace Hazhir;

class TransactionStructure
{
    public float $amount;
    public string $fromAddress;
    public string $toAddress;

    public function __construct(string $fromAddress, string $toAddress, float $amount)
    {
        $this->fromAddress = $fromAddress;
        $this->toAddress = $toAddress;
        $this->amount = $amount;
    }
}
