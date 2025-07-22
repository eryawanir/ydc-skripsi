<?php

namespace App\Enums;

enum TipeDokter: int
{
    case SIP = 1;
    case NonSIP = 2;

    public function label(): string
    {
        return match ($this) {
            self::SIP => 'SIP',
            self::NonSIP => 'Non-SIP',
        };
    }

    public static function options(): array
    {
        return [
            self::SIP => 'SIP',
            self::NonSIP => 'Non-SIP',
        ];
    }
}
