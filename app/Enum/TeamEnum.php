<?php

namespace App\Enum;

enum TeamEnum: string
{
    case SCHOOLMANAGEMENTCOMMITTEE = 'school management committee';
    case CORECOMMITTEEMEMBER = 'core committee member';
    case ADMINISTRATION = 'administration';
    case TEACHINGSTAFF = 'teaching staff';
    case NONTEACHINGSTAFF = 'non teaching staff';

    public static function map(?string $status = null): string|array
    {
        $map = [
            self::SCHOOLMANAGEMENTCOMMITTEE->value => 'School management committee',
            self::CORECOMMITTEEMEMBER->value => 'Core committee member',
            self::ADMINISTRATION->value => 'Administration',
            self::TEACHINGSTAFF->value => 'Teaching staff',
            self::NONTEACHINGSTAFF->value => 'Non teaching staff',
        ];

        if ($status) {
            return $map[$status] ?? $status;
        }

        return $map;
    }
}
