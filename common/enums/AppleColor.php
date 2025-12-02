<?php

namespace common\enums;

enum AppleColor: string
{
    case Red = 'red';
    case Yellow = 'yellow';
    case Green = 'green';

    public static function random(): self
    {
        $cases = self::cases();

        return $cases[mt_rand(0, count($cases) - 1)];
    }
}
