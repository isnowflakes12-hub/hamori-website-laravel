<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\AdminMenu;

class MenuSeeder extends Seeder {
    public function run() {
        AdminMenu::updateOrCreate(
            ['route_name' => 'admin.activity-log.index'],
            [
                'name' => 'Log Aktivitas',
                'icon' => 'bi-clock-history',
                'roles' => ['super_admin'],
                'is_active' => true,
                'order' => 99
            ]
        );
    }
}
