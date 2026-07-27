<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AdminMenu;

class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('admin_menus')->truncate();

        // 1. Marketing
        $marketing = AdminMenu::create([
            'name'      => 'Marketing',
            'roles'     => ['super_admin', 'admin_marketing'],
            'order'     => 1,
            'is_active' => true,
        ]);
        AdminMenu::create(['parent_id' => $marketing->id, 'name' => 'Kritik & Saran', 'route_name' => 'admin.kritik-saran.index', 'icon' => 'bi-envelope-paper-fill', 'roles' => ['super_admin', 'admin_marketing'], 'order' => 1]);
        AdminMenu::create(['parent_id' => $marketing->id, 'name' => 'Pesan Masuk', 'route_name' => 'admin.kontak.index', 'icon' => 'bi-chat-text-fill', 'roles' => ['super_admin', 'admin_marketing'], 'order' => 2]);
        AdminMenu::create(['parent_id' => $marketing->id, 'name' => 'Banner', 'route_name' => 'admin.banner.index', 'icon' => 'bi-image-fill', 'roles' => ['super_admin', 'admin_marketing'], 'order' => 3]);
        AdminMenu::create(['parent_id' => $marketing->id, 'name' => 'Promo & Paket', 'route_name' => 'admin.promo.index', 'icon' => 'bi-gift-fill', 'roles' => ['super_admin', 'admin_marketing'], 'order' => 4]);
        AdminMenu::create(['parent_id' => $marketing->id, 'name' => 'Layanan Unggulan', 'route_name' => 'admin.layanan.index', 'icon' => 'bi-award-fill', 'roles' => ['super_admin', 'admin_marketing'], 'order' => 5]);

        // 2. Dokter & Jadwal
        AdminMenu::create([
            'name'       => 'Dokter & Jadwal',
            'route_name' => 'admin.dokter.index',
            'icon'       => 'bi-person-badge-fill',
            'roles'      => ['super_admin', 'admin_marketing'],
            'order'      => 2,
            'is_active'  => true,
        ]);

        // 3. Partner & Mitra
        AdminMenu::create([
            'name'       => 'Partner & Mitra',
            'route_name' => 'admin.partner.index',
            'icon'       => 'bi-building-fill-add',
            'roles'      => ['super_admin', 'admin_marketing'],
            'order'      => 3,
            'is_active'  => true,
        ]);

        // 4. Manajemen Artikel
        $artikel = AdminMenu::create([
            'name'      => 'Manajemen Artikel',
            'icon'      => 'bi-newspaper',
            'roles'     => ['super_admin', 'admin_marketing'],
            'order'     => 4,
            'is_active' => true,
        ]);
        AdminMenu::create(['parent_id' => $artikel->id, 'name' => 'Konten Artikel', 'route_name' => 'admin.artikel.index', 'icon' => 'bi-file-text-fill', 'roles' => ['super_admin', 'admin_marketing'], 'order' => 1]);
        AdminMenu::create(['parent_id' => $artikel->id, 'name' => 'Kategori Artikel', 'route_name' => 'admin.kategori-artikel.index', 'icon' => 'bi-folder-fill', 'roles' => ['super_admin', 'admin_marketing'], 'order' => 2]);

        // 5. Manajemen Fasilitas
        $fasilitas = AdminMenu::create([
            'name'      => 'Manajemen Fasilitas',
            'icon'      => 'bi-building',
            'roles'     => ['super_admin', 'admin_marketing'],
            'order'     => 5,
            'is_active' => true,
        ]);
        AdminMenu::create(['parent_id' => $fasilitas->id, 'name' => 'Fasilitas', 'route_name' => 'admin.fasilitas.index', 'icon' => 'bi-building', 'roles' => ['super_admin', 'admin_marketing'], 'order' => 1]);
        AdminMenu::create(['parent_id' => $fasilitas->id, 'name' => 'Kategori Fasilitas', 'route_name' => 'admin.kategori-fasilitas.index', 'icon' => 'bi-folder-fill', 'roles' => ['super_admin', 'admin_marketing'], 'order' => 2]);
        AdminMenu::create(['parent_id' => $fasilitas->id, 'name' => 'Info Tempat Tidur', 'route_name' => 'admin.bed-availability.index', 'icon' => 'bi-hospital', 'roles' => ['super_admin', 'admin_marketing'], 'order' => 3]);

        // 6. Profile Rumah Sakit
        $profil = AdminMenu::create([
            'name'      => 'Profile Rumah Sakit',
            'icon'      => 'bi-hospital',
            'roles'     => ['super_admin', 'admin_marketing'],
            'order'     => 6,
            'is_active' => true,
        ]);
        AdminMenu::create(['parent_id' => $profil->id, 'name' => 'Edit Profile RS', 'route_name' => 'admin.profil-rs.edit', 'icon' => 'bi-hospital', 'roles' => ['super_admin', 'admin_marketing'], 'order' => 1]);
        AdminMenu::create(['parent_id' => $profil->id, 'name' => 'Sejarah / Milestone', 'route_name' => 'admin.milestone.index', 'icon' => 'bi-flag-fill', 'roles' => ['super_admin', 'admin_marketing'], 'order' => 2]);

        // 7. SDM & Rekrutmen
        $sdm = AdminMenu::create([
            'name'      => 'SDM & Rekrutmen',
            'icon'      => 'bi-people-fill',
            'roles'     => ['super_admin', 'admin_sdm'],
            'order'     => 7,
            'is_active' => true,
        ]);
        AdminMenu::create(['parent_id' => $sdm->id, 'name' => 'Lowongan Kerja', 'route_name' => 'admin.karir.index', 'icon' => 'bi-briefcase-fill', 'roles' => ['super_admin', 'admin_sdm'], 'order' => 1]);
        AdminMenu::create(['parent_id' => $sdm->id, 'name' => 'Lamaran Masuk', 'route_name' => 'admin.lamaran.index', 'icon' => 'bi-person-lines-fill', 'roles' => ['super_admin', 'admin_sdm'], 'order' => 2]);

        // 8. FAQ & Kebijakan Privasi
        $content = AdminMenu::create([
            'name'      => 'FAQ & Kebijakan Privasi',
            'icon'      => 'bi-info-circle-fill',
            'roles'     => ['super_admin', 'admin_marketing'],
            'order'     => 8,
            'is_active' => true,
        ]);
        AdminMenu::create(['parent_id' => $content->id, 'name' => 'FAQ', 'route_name' => 'admin.faq.index', 'icon' => 'bi-question-circle-fill', 'roles' => ['super_admin', 'admin_marketing'], 'order' => 1]);
        AdminMenu::create(['parent_id' => $content->id, 'name' => 'Kebijakan Privasi', 'route_name' => 'admin.privacy-policy.index', 'icon' => 'bi-shield-lock-fill', 'roles' => ['super_admin', 'admin_marketing'], 'order' => 2]);
    }
}
