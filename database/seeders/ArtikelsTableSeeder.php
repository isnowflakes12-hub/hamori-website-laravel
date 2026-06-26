<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ArtikelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('artikels')->delete();
        
        
        
    }
}