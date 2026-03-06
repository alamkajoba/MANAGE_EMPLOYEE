<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'ALAM KAJOBA',
            'email' => 'test@email.com',
            'password' => Hash::make('password')
        ]);


        $adminRole = Role::firstOrCreate(['name' => 'AGENT IT']);
        $adminRole->syncPermissions(Permission::all());
        $user->assignRole($adminRole);
    }
}
