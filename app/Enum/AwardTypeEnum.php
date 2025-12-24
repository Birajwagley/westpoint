<?php

namespace App\Enum;

enum AwardTypeEnum: string
{
    case GOLD = 'gold';
    case SILVER = 'silver';
    case BRONZE = 'bronze';

    public static function map(?string $status = null): string|array
    {
        $map = [
            self::GOLD->value => 'Gold',
            self::SILVER->value => 'Silver',
            self::BRONZE->value => 'Bronze',
        ];

        if ($status) {
            return $map[$status] ?? $status;
        }

        return $map;
    }
}
