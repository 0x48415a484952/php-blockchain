<?php

declare(strict_types=1);

namespace Hazhir;

class Blockchain
{
    private array $chain;

    public function __construct()
    {
        $this->chain[] = Block::generateGenesisBlock();
    }

    private function addBlockToTheChain(Block $block): void
    {
        $this->chain[] = $block;
    }

    private function getLatestBlockInTheChain(): Block
    {
        return $this->chain[count($this->chain) - 1];
    }

    public function addBlock(float $amount, ?string $message): array
    {
        $newBlockHeight = $this->getLatestBlockInTheChain()->blockStructure->blockHeight + 1;
        $previousHash = $this->getLatestBlockInTheChain()->blockStructure->hash;
        $newBlockData = new BlockStructure($amount, $newBlockHeight, $previousHash, $message);
        $newBlock = new Block($newBlockData);
        $this->addBlockToTheChain($newBlock);
        return $this->chain;
    }

    public function getChain(): array
    {
        return $this->chain;
    }
}
