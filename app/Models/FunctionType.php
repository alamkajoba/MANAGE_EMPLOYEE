<?php

namespace App\Models;

use App\Trait\Searchable;
use Illuminate\Database\Eloquent\Model;

class FunctionType extends Model
{

    use Searchable;
    
    protected $searchableColumns = ['nameFunction'];
    
    protected $fillable = [
        'nameFunction', 'workDay', 'salary', 'user_id'
    ];

    //Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function enrollment()
    {
        return $this->hasMany(Enrollment::class);
    }
}
