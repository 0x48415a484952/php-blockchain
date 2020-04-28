<?php

declare(strict_types=1);

namespace Hazhir;

class Block
{
    public BlockStructure $blockStructure;

    public array $block;

    public function __construct(BlockStructure $blockStructure)
    {
        $this->blockStructure = $blockStructure;
    }

    public static function generateGenesisBlock(): Block
    {
        $blockStructure = new BlockStructure(
            0,
            0,
            '',
            'genesis block in the hazhir blockchain'
        );
        return new Block($blockStructure);
    }
}
