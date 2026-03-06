<?php

use App\Enums\CivilStateEnum;
use App\Enums\ContractTypeEnum;
use App\Enums\DotationEpiEnum;
use App\Enums\EmployeeStatusEnum;
use App\Enums\GenderEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {

            //Personnal info
            $table->id();
            $table->enum('employeeStatus', EmployeeStatusEnum::values())->default(EmployeeStatusEnum::ENABLE->value); 
            $table->string('firstName')->nullable(); 
            $table->string('middleName')->nullable(); 
            $table->string('lastName')->nullable();
            $table->enum('gender', GenderEnum::values());
            $table->enum('civilState', CivilStateEnum::values());
            $table->string('nationality')->nullable();
            $table->string('address')->nullable();
            $table->date('birthDate')->nullable();
            $table->string('birthPlace')->nullable();
            

            //Professionnal info
            $table->string('phone')->nullable();
            $table->string('studyLevel')->nullable();
            $table->string('obtainingDate')->nullable();
            $table->string('nationalNumber')->nullable();
            $table->string('faculty')->nullable();
            $table->string('otherProfession')->nullable();
            $table->string('lastJob')->nullable();

            //enrollment info
            $table->date('startDate')->nullable(); 
            // $table->date('endDate')->nullable(); 
            $table->string('matricule')->nullable(); 
            $table->foreignId('function_type_id')->constrained()->onDelete('restrict');
            // $table->enum('contractType', ContractTypeEnum::values()); 
            $table->foreignId('site_id')->constrained()->onDelete('restrict');
            $table->string('desseaseHistory')->nullable();
            $table->string('ownerPassport')->nullable();
            $table->string('copyNationalCard')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('restrict');

            //dotation
            $table->enum('dodationEPI', DotationEpiEnum::values())->default(DotationEpiEnum::YES->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
