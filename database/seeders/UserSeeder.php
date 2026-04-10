<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run(): void {
        User::create(['name'=>'Super Admin','email'=>'superadmin@rshamori.co.id','password'=>Hash::make('admin123'),'role'=>'super_admin','is_active'=>true]);
        User::create(['name'=>'Admin Marketing','email'=>'marketing@rshamori.co.id','password'=>Hash::make('marketing123'),'role'=>'admin_marketing','is_active'=>true]);
        User::create(['name'=>'Admin SDM','email'=>'sdm@rshamori.co.id','password'=>Hash::make('sdm123456'),'role'=>'admin_sdm','is_active'=>true]);
    }
}
