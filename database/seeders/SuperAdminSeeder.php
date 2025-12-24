<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmins = [
            [
                'name' => 'System Creator',
                'email' => 'shishir@predictionit.com',
                'password' => 'StrongPassword123@',
            ],
        ];

        foreach ($superAdmins as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make($data['password']),
                ]
            );

            $user->assignRole('super_admin');
        }
    }
}
