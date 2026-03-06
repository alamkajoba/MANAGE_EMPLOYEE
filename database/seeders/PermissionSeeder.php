<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'Employee' =>
            [
                'AddEmployee',
                'ListEmployee',
                'DisableEmployee',
                'ShowDisableEmployee',
                'PrintList',
                'PrintAllDoc',
                'EditEmployee',
            ],
            'User' =>
            [
                'AddUser',
                'ListUser',
            ],
            'Rest doc' =>
            [
                'ListRest',
                'GiveRest',
            ],
            'EPI' =>
            [
                'EecuteEPI',
                'ListEPI',
                'CreateEPI',
            ],
            'Function' =>
            [
                'AddFunction',
                'ListFunction',
            ],
            'Site' =>
            [
                'AddSite',
                'ListSite',
            ],
        ];

        foreach ($permissions as $group => $perms) {
            foreach ($perms as $permission) {
                Permission::firstOrCreate([
                    'name' => $permission,
                    'group_name' => $group,
                ]);
            }
        }
    }
}