<?php

namespace App\Enum;

enum GalleryTypeEnum: string
{
    case IMAGE = 'image';
    case VIDEO = 'video';

    public static function map(?string $status = null): string|array
    {
        $map = [
            self::IMAGE->value => 'Image',
            self::VIDEO->value => 'Video',
        ];

        if ($status) {
            return $map[$status] ?? $status;
        }

        return $map;
    }
}
