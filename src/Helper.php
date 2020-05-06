<?php

declare(strict_types=1);

namespace Hazhir;

use Tuupola\Base58;

class Helper
{
    public static function doubleSha256(string $hex): string
    {
        return hash('sha256', hash('sha256', hex2bin($hex), true));
    }

    public static function doubleSha256InputString(string $input): string
    {
        return hash('sha256', hash('sha256', $input, true));
    }

    public static function toSha256(string $hex): string
    {
        return hash('sha256', hex2bin($hex));
    }

    public static function toRipemd160(string $hex): string
    {
        return hash('ripemd160', hex2bin($hex));
    }

    public static function toBase58(string $hex): string
    {
        $base58 = new Base58(['characters' => Base58::BITCOIN]);
        return $base58->encode(hex2bin($hex));
    }

    public static function dd($input): void
    {
        var_dump($input);
        die();
    }

    public static function breakLine(): void
    {
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
    }
}
