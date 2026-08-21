<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run(): void {
        $users = [
            [
                'name' => 'Super Admin IT',
                'email' => 'superadmin@rshamori.co.id',
                'role' => 'super_admin',
                'password' => 'admin123'
            ],
            [
                'name' => 'Admin Marketing',
                'email' => 'marketing@rshamori.co.id',
                'role' => 'admin_marketing',
                'password' => 'marketing123'
            ],
            [
                'name' => 'Admin SDM',
                'email' => 'sdm@rshamori.co.id',
                'role' => 'admin_sdm',
                'password' => 'sdm123456'
            ]
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                    'role' => $user['role'],
                    'is_active' => true
                ]
            );
        }
    }
}
