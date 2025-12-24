<?php

namespace App\Enum;

enum AwardAchivementTypeEnum: string
{
    case AWARD = 'award';
    case ACHIVEMENT = 'achivement';

    public static function map(?string $status = null): string|array
    {
        $map = [
            self::AWARD->value => 'Award',
            self::ACHIVEMENT->value => 'Achivement',
        ];

        if ($status) {
            return $map[$status] ?? $status;
        }

        return $map;
    }
}
