<?php

namespace App\Enums;

enum EmployeeStatusEnum :string
{
    case ENABLE = 'Actif';
    case DISABLE = 'Inactif';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
