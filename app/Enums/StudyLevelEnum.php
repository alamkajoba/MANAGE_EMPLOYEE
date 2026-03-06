<?php

namespace App\Enums;

enum StudyLevelEnum :string
{
    case PRIMARY = 'Primaire';
    case BAC = 'Secondaire';
    case LICENCE = 'Licence';
    case MASTER = 'Master';
    case DOCTOR = 'Doctorat';
    case NONE = 'Aucun';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
