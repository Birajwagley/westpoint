<?php

namespace App\Enum;

enum DailyAvailabilityEnum: string

{
    case FULLTIME = 'full time';
    case PARTTIME = 'part time';


    public static function map(?string $status = null): string|array
    {
        $map = [
            self::FULLTIME->value   => 'Full Time',
            self::PARTTIME->value => 'Part Time',
        ];

        if ($status) {
            return $map[$status] ?? $status;
        }

        return $map;
    }
}

