<?php

namespace App\Models;

use App\Trait\Searchable;
use Illuminate\Database\Eloquent\Model;

class ExecuteDotationEpi extends Model
{
    use Searchable;
    
    protected $searchableColumns = ['firstName', 'lastName', 'middleName'];

    protected $searchableRelations = [
        'enrollment' => ['firstName', 'lastName', 'middleName'],
    ];
    
    protected $fillable = [
        'enrollment_id', 'month_dotation_epi_id', 'dotationEPI'
    ];

    //relationShip
    public function monthDotation()
    {
        return $this->hasOne(MonthDotationEpi::class);
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}
