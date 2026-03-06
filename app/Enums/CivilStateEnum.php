<?php

namespace App\Enums;

enum CivilStateEnum :string
{
    case MARIED = 'marié(e)';
    case SINGLE = 'célibataire';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
