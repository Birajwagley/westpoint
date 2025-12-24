<?php

namespace App\Enum;

enum DrawerNavigationType: string
{
    case MENU = 'menu';
    case EXTERNALLINK = 'external_link';
    case TEL = 'tel';

    public static function map(?string $status = null): string|array
    {
        $map = [
            self::MENU->value => 'Menu',
            self::EXTERNALLINK->value => 'External Link',
            self::TEL->value => 'Telephone No.',
        ];

        if ($status) {
            return $map[$status] ?? $status;
        }

        return $map;
    }
}
