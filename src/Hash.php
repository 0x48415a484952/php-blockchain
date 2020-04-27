<?php

declare(strict_types=1);

namespace Hazhir;

class Hash
{
    public static function doubleSha256(string $input): string
    {
        return hash('sha256', hash('sha256', $input, true));
    }
}
