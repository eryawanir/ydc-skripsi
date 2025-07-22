<?php

namespace App\Enums;

enum UserRole: int
{
    case Admin = 1;
    case Manajemen = 2;
    case Dokter = 3;

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Admin',
            self::Manajemen => 'Manajemen',
            self::Dokter => 'Dokter',
        };
    }

    public static function options(): array
    {
        return [
            self::Admin => 'Admin',
            self::Manajemen => 'Manajemen',
            self::Dokter => 'Dokter',
        ];
    }
}
