<?php

namespace App\Models;

use App\Enums\CivilStateEnum;
use App\Enums\EmployeeStatusEnum;
use App\Enums\GenderEnum;
use App\Enums\StudyLevelEnum;
use App\Trait\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use Searchable;

    use HasFactory;
    
    protected $searchableColumns = ['firstName', 'lastName', 'middleName', 'matricule'];

    protected $searchableRelations = [
        'functionType' => ['nameFunction'],
        'site' => ['nameSite'],
    ];
    
    protected $fillable = [
        //Personnal info
        'firstName', 'middleName', 'lastName', 'gender', 'address', 
        'birthDate', 'birthPlace', 'employeeStatus', 'civilState', 'address', 'nationality',
        
        //Professionnal info
        'faculty', 'studyLevel', 'obtainingDate', 'otherProfession', 'lastJob', 'phone', 'nationalNumber',

        //enrollment info
        'startDate', 'matricule', 'function_type_id', 'site_id', 
        'desseaseHistory', 'ownerPassport', 'copyNationalCard', 'user_id',

        //dotation EPI
        'dotationEPI'
    ];

    protected $casts = [
        'birthDate' => 'date',
        'lastStartDate' => 'date',
        'endDate' => 'date',
        'startDate' => 'date',
        'gender' => GenderEnum::class,
        'civilState' => CivilStateEnum::class,
        'studyLevel' => StudyLevelEnum::class,
        'employeeStatus' => EmployeeStatusEnum::class,
    ];

    //Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function functionType()
    {
        return $this->belongsTo(FunctionType::class);
    }
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
    public function rest()
    {
        return $this->hasMany(Rest::class);
    }
    public function executeDotation()
    {
        return $this->hasOne(ExecuteDotationEpi::class);
    }
}
