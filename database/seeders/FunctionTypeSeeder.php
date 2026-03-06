<?php

namespace Database\Seeders;

use App\Models\FunctionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FunctionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $functionType = FunctionType::create([
            'nameFunction' => 'Soudeur',
            'workDay' => '28',
            'salary' => '600',
            'user_id' => '1'
        ]);
    }
}
