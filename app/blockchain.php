<?php

declare(strict_types=1);

use Hazhir\Blockchain;

require '../vendor/autoload.php';

$blockchain = new Blockchain();
$blockchain->addBlock(50, null);
$blockchain->addBlock(12.5, 'sending to satoshi');

echo $blockchain->getChain();
