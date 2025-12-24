<?php

namespace App\Enum;

enum GenderTypeEnum: string
{
    case MALE = 'male';
    case FEMALE = 'female';
    case OTHERS = 'others';

    public static function map(?string $gender = null): string|array
    {
        $map = [
            self::MALE->value   => 'Male',
            self::FEMALE->value => 'Female',
            self::OTHERS->value => 'Others',
        ];

        if ($gender) {
            return $map[$gender] ?? $gender;
        }

        return $map;
    }
}
