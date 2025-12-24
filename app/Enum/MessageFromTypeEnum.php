<?php

namespace App\Enum;

enum MessageFromTypeEnum: string
{
    case INDIRAYAKTHUMBA = 'indira-yakthumba';
    case GYANBAHADURYAKTHUMBA = 'gyan-bahadur-yakthumba';

    public static function map($status): string
    {
        $statusEnum = self::tryFrom($status);
        return match ($statusEnum) {
            self::INDIRAYAKTHUMBA => 'Indira Yakthumba',
            self::GYANBAHADURYAKTHUMBA => 'Gyan Bahadur Yakthumba',
        };
    }
}
