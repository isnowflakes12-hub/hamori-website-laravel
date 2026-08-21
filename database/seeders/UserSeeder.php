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
                'email' => 'superadmin@rs-hamori.co.id',
                'role' => 'super_admin',
                'password' => 'Hamori@22#33'
            ],
            [
                'name' => 'Admin Marketing',
                'email' => 'marketing@rs-hamori.co.id',
                'role' => 'admin_marketing',
                'password' => 'marketing123'
            ],
            [
                'name' => 'Admin SDM',
                'email' => 'sdm@rs-hamori.co.id',
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
