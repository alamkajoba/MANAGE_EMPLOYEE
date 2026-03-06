<?php

namespace Database\Factories;

use App\Enums\CivilStateEnum;
use App\Enums\DotationEpiEnum;
use App\Enums\EmployeeStatusEnum;
use App\Enums\GenderEnum;
use App\Enums\StudyLevelEnum;
use App\Models\Enrollment;
use App\Models\FunctionType;
use App\Models\Site;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enrollment>
 */
class EnrollmentFactory extends Factory
{


    protected $model = Enrollment::class;

    public function definition(): array
    {
        return [
            'employeeStatus' => EmployeeStatusEnum::ENABLE->value,
            'firstName' => fake()->firstName(),
            'middleName' => fake()->lastName(),
            'lastName' => fake()->lastName(),
            'gender' => fake()->randomElement(GenderEnum::values()),
            'civilState' => fake()->randomElement(CivilStateEnum::values()),
            'nationality' => fake()->country(),
            'address' => fake()->address(),
            'birthDate' => fake()->date('Y-m-d', '-20 years'),
            'birthPlace' => fake()->city(),

            // Professional info
            'phone' => fake()->phoneNumber(),
            'studyLevel' => fake()->randomElement(StudyLevelEnum::values()),
            'obtainingDate' => fake()->year(),
            'nationalNumber' => fake()->bothify('ID-#####-??'),
            'faculty' => fake()->word() . ' University',
            'otherProfession' => fake()->jobTitle(),
            'lastJob' => fake()->company(),

            // Enrollment info
            'startDate' => fake()->date(),
            'matricule' => fake()->unique()->bothify('CSCC-####'),
            'function_type_id' => FunctionType::inRandomOrder()->first()->id ?? FunctionType::factory(),
            'site_id' => Site::inRandomOrder()->first()->id ?? Site::factory(),
            'desseaseHistory' => fake()->sentence(),
            'ownerPassport' => fake()->word() . '.pdf',
            'copyNationalCard' => fake()->word() . '.jpg',
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),

            // Dotation
            'dodationEPI' => fake()->randomElement(DotationEpiEnum::values()),
        ];
    }
}
