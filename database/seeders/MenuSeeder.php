<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder {
    public function run() {
        // Cek apakah sudah ada agar tidak duplikat
        $exists = DB::table('admin_menus')
            ->where('route_name', 'admin.activity-log.index')
            ->exists();

        if (!$exists) {
            DB::table('admin_menus')->insert([
                'name'       => 'Log Aktivitas',
                'route_name' => 'admin.activity-log.index',
                'icon'       => 'bi-clock-history',
                'roles'      => json_encode(['super_admin']),
                'is_active'  => true,
                'order'      => 99,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            DB::table('admin_menus')
                ->where('route_name', 'admin.activity-log.index')
                ->update([
                    'name'      => 'Log Aktivitas',
                    'icon'      => 'bi-clock-history',
                    'roles'     => json_encode(['super_admin']),
                    'is_active' => true,
                    'order'     => 99,
                    'updated_at'=> now(),
                ]);
        }
    }
}
