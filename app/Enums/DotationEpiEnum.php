<?php

namespace App\Enums;

enum DotationEpiEnum :string
{
    case NONE = 'non';
    case YES = 'oui';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
