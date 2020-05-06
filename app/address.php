<?php

declare(strict_types=1);

use Endroid\QrCode\QrCode;
use Endroid\QrCode\LabelAlignment;
use Hazhir\Address;


require '../vendor/autoload.php';

$address = new Address();
$address->generateWallet();


$publicKey = new QrCode($address->getPublicKey());
$publicKey->setLabel('your public key', 16, null, LabelAlignment::CENTER);
$publicKey->setSize(300);
$dataUri['publicKey'] = $publicKey->writeDataUri();

$privateKey = new QrCode($address->getPrivateKey());
$privateKey->setSize(300);
$privateKey->setLabel('your private key', 16, null, LabelAlignment::CENTER);
$dataUri['privateKey'] = $privateKey->writeDataUri();

try {
    echo json_encode($dataUri, JSON_THROW_ON_ERROR);
} catch (JsonException $e) {
    echo $e->getMessage();
}

