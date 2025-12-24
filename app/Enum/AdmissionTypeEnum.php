<?php

namespace App\Enum;

enum AdmissionTypeEnum: string
{
    case BOARDER       = 'boarder';
    case DAY_BOARDER   = 'day_boarder';
    case DAY_SCHOLAR   = 'day_scholar';

    /**
     * Map enum values to human-readable labels
     */
    public static function map(?string $admissionType = null): string|array
    {
        $map = [
            self::BOARDER->value      => 'Boarder',
            self::DAY_BOARDER->value  => 'Day Boarder',
            self::DAY_SCHOLAR->value  => 'Day Scholar',
        ];

        if ($admissionType) {
            return $map[$admissionType] ?? $admissionType;
        }

        return $map;
    }
}
