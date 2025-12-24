<?php

namespace App\Enum;

enum LinkTypeEnum: string
{
    case MENU = 'menu';
    case EXTERNALLINK = 'external_link';

    public static function map(?string $status = null): string|array
    {
        $map = [
            self::MENU->value => 'Menu',
            self::EXTERNALLINK->value => 'External Link',
        ];

        if ($status) {
            return $map[$status] ?? $status;
        }

        return $map;
    }
}
