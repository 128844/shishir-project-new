<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $guard = 'api';

        Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => $guard]);
        Role::firstOrCreate(['name' => 'employer', 'guard_name' => $guard]);
        Role::firstOrCreate(['name' => 'job_seeker', 'guard_name' => $guard]);
    }
}
