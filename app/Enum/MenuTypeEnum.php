<?php

namespace App\Enum;

enum MenuTypeEnum: string
{
    case SLUG = 'slug';
    case EXTERNAL = 'external';

    public static function map($status): string
    {
        $statusEnum = self::tryFrom($status);
        return match ($statusEnum) {
            self::SLUG => 'Slug',
            self::EXTERNAL => 'External Link',
        };
    }

    public static function linkMap($status): string
    {
        $statusEnum = self::tryFrom($status);
        return match ($statusEnum) {
            self::SLUG => 'Menu',
            self::EXTERNAL => 'External Link',
        };
    }
}
