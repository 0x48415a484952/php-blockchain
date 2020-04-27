<?php

declare(strict_types=1);

namespace Hazhir;

class BlockStructure
{
    public int $timestamp;
    public string $message;
    public float $amount;
    public int $blockHeight;
    public int $nonce;
    public string $hash;
    public ?string $previousHash;

    public function __construct(float $amount, int $blockHeight, string $previousHash, ?string $message)
    {
        if ($message === null ) {
            $message = 'new block in hazhir blockchain';
        }
        $this->nonce = 0;
        $this->timestamp = time();
        $this->message = $message;
        $this->amount = $amount;
        $this->blockHeight = $blockHeight;
        $this->previousHash = $previousHash;
        $this->hash = $this->mine();
    }

    private function mine(): string
    {
        $hash = null;
        while (strpos(Hash::doubleSha256($this->prepareToBeHashed()), '00') !== 0) {
            $this->nonce++;
            $hash = Hash::doubleSha256($this->prepareToBeHashed());
        }
        return $hash;
    }

    private function prepareToBeHashed(): string
    {
        return $this->blockHeight.
            $this->timestamp.
            $this->message.
            $this->amount.
            $this->blockHeight.
            $this->previousHash.
            $this->nonce;
    }
}
