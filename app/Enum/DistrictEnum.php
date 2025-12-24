<?php

namespace App\Enum;

enum DistrictEnum: string
{
    case KTM = 'kathmandu';
    case BKT = 'bhaktapur';
    case LP = 'lalitpur';

    public static function map(?string $status = null): string|array
    {
        $map = [
            self::KTM => 'Kathmandu',
            self::BKT => 'Bhaktapur',
            self::LP => 'Lalitpur',
        ];

        if ($status) {
            return $map[$status] ?? $status;
        }

        return $map;
    }
}
