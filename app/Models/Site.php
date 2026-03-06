<?php

namespace App\Models;

use App\Trait\Searchable;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use Searchable;
    
    protected $searchableColumns = ['nameSite'];

    protected $fillable = [
        'nameSite', 'description', 'user_id'
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
