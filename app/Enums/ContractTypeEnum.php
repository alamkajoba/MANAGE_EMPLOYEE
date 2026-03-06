<?php

namespace App\Enums;

enum ContractTypeEnum :string
{
    case CDD = 'CDD';
    case CDI = 'CDI';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
