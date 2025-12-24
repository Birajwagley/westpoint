<?php

namespace App\Enum;

enum PerspectiveFromEnum: string
{
    case ALUMNI = 'alumni';
    case GUARDIAN = 'guardian';
    case FACULTY = 'faculty';

    public static function map(?string $status = null): string|array
    {
        $map = [
            self::ALUMNI->value => 'Alumni',
            self::GUARDIAN->value => 'Guardian',
            self::FACULTY->value => 'Faculty Member',
        ];

        if ($status) {
            return $map[$status] ?? $status;
        }

        return $map;
    }
}
