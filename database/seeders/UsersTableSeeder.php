<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 3,
                'name' => 'Admin SDM',
                'email' => 'sdm@rshamori.co.id',
                'password' => '$2y$12$vhet6EkVC664LOFtdLZfm.RipIAn8atu6J791L1m6qi2utF.fu23i',
                'role' => 'admin_sdm',
                'is_active' => true,
                'avatar' => NULL,
                'last_login_at' => '2026-07-27 09:22:06',
                'remember_token' => NULL,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-07-27 09:22:06',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Admin Marketing',
                'email' => 'marketing@rshamori.co.id',
                'password' => '$2y$12$.944NfUSgzWZ2IlI.y/P8efAsLlHhgE7NgA2LQy4xycqhcalQ26Sm',
                'role' => 'admin_marketing',
                'is_active' => true,
                'avatar' => NULL,
                'last_login_at' => '2026-07-27 09:38:44',
                'remember_token' => NULL,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-07-27 09:38:44',
            ),
            2 => 
            array (
                'id' => 1,
                'name' => 'Super Admin',
                'email' => 'superadmin@rshamori.co.id',
                'password' => '$2y$12$se9y6bnLNd.MULBcaoTJoOzkhSrTNATAOZr2ODgLoViIFDEu.oSrG',
                'role' => 'super_admin',
                'is_active' => true,
                'avatar' => NULL,
                'last_login_at' => '2026-07-27 16:58:52',
                'remember_token' => NULL,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-07-27 16:58:52',
            ),
        ));
        
        
    }
}