<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    protected $fillable = [
        'enrollment_id', 'startDate', 'endDate', 'motif'
    ];

    protected $casts = [
        'startDate' => 'date',
        'endDate' => 'date'
    ];

    //Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}
