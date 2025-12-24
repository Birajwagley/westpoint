<?php

namespace App\Enum;

enum ClubEnum: string
{
    case CLUB = 'clubs';
    case FACILITIES = 'facilities';
    case UNIQUESELLINGPOINT = 'uniquesellingpoint';

    public static function map(?string $status = null): string|array
    {
        $map = [
            self::CLUB->value => 'Club',
            self::FACILITIES->value => 'Facilities',
            self::UNIQUESELLINGPOINT->value => 'Unique Selling Point',
        ];

        if ($status) {
            return $map[$status] ?? $status;
        }

        return $map;
    }
}

