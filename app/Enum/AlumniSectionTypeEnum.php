<?php

namespace App\Enum;

enum AlumniSectionTypeEnum: string
{
    case PRIMARYSECTION = 'primary_section';
    case SECONDARYSECTION = 'secondary_section';
    case TERNARYSECTION = 'ternary_section';

    public static function map(?string $status = null): string|array
    {
        $map = [
            self::PRIMARYSECTION->value => 'Primary Section',
            self::SECONDARYSECTION->value => 'Secondary Section',
            self::TERNARYSECTION->value => 'Ternary Section',
        ];

        if ($status) {
            return $map[$status] ?? $status;
        }

        return $map;
    }
}
