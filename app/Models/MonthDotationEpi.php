<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthDotationEpi extends Model
{
    protected $fillable = [
        'monthYear'
    ];

    //relationShip
    public function executeDotation()
    {
        return $this->belongsTo(ExecuteDotationEpi::class);
    }
}
