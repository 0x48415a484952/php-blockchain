<?php

declare(strict_types=1);

namespace Hazhir;

use Elliptic\EC;
use Exception;
use JsonException;

class Address
{
    private array $wallet;

    private const POOL = 'abcdefghijklmnopqrstuvwxyz0123456789';

    public function __construct()
    {

    }

    private function generateSeed(): string
    {
        $seed = [];
        $randomNumber = null;
        for ($i = 0; $i < 12; $i++) {
            try {
                $randomNumber =  random_int(5, 20);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            $shuffledPool = str_shuffle(self::POOL);
            $randomWord = str_split($shuffledPool, $randomNumber);
            $seed[] = $randomWord[0];
        }
        return implode('', $seed);
    }

    private function generatePrivateKey(): string
    {
        $seed = $this->generateSeed();
        $this->wallet['seed'] = $seed;
        $this->wallet['privateKey'] = hash('sha256', $seed);
        $privateKey = Helper::doubleSha256('80'.$this->wallet['privateKey'].'01');
        $checksum = substr($privateKey, 0, 8);
        $privateKey = '80'.hash('sha256', $seed). '01' .$checksum;
        $this->wallet['privateKeyInBase58'] = Helper::toBase58($privateKey);
        return $this->wallet['privateKey'];
    }

    private function generatePublicKeyFromPrivateKey(string $privateKey): void
    {
        $ellipticCurve = new EC('secp256k1');

//        while (
//            strpos($ellipticCurve->keyFromPrivate($privateKey)->getPublic(true, 'hex'), '1h') !== 0
//        ) {
//            $privateKey = $this->generatePrivateKey();
//        }


        $publicKey = $ellipticCurve->keyFromPrivate($privateKey)->getPublic(true, 'hex');
        $publicKey = Helper::toRipemd160(Helper::toSha256($publicKey));
        $checksum = substr(Helper::doubleSha256('00'.$publicKey), 0, 8);
        $publicKey = '00'.$publicKey.$checksum;
        $this->wallet['publicKeyInBase58'] = Helper::toBase58($publicKey);
    }

    public function generateWallet(): void
    {
        $this->generatePrivateKey();
        $this->generatePublicKeyFromPrivateKey($this->wallet['privateKey']);
    }

    public function getWallet(): string
    {
        try {
            return json_encode($this->wallet, JSON_THROW_ON_ERROR, 512);
        } catch (JsonException $e) {
            return $e->getMessage();
        }
    }

    public function getPrivateKey(): ?string
    {
        return $this->wallet['privateKeyInBase58'];
    }

    public function getPublicKey(): string
    {
        return $this->wallet['publicKeyInBase58'];
    }
}
