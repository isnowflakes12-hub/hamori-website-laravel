<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminMenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_menus')->delete();
        
        \DB::table('admin_menus')->insert(array (
            0 => 
            array (
                'id' => 16,
                'parent_id' => NULL,
                'name' => 'Profile Rumah Sakit',
                'route_name' => NULL,
                'url' => NULL,
                'icon' => 'bi-hospital',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 9,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            1 => 
            array (
                'id' => 17,
                'parent_id' => 16,
                'name' => 'Edit Profile RS',
                'route_name' => 'admin.profil-rs.edit',
                'url' => NULL,
                'icon' => 'bi-hospital',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 0,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            2 => 
            array (
                'id' => 18,
                'parent_id' => 16,
                'name' => 'Sejarah / Milestone',
                'route_name' => 'admin.milestone.index',
                'url' => NULL,
                'icon' => 'bi-flag-fill',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 1,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            3 => 
            array (
                'id' => 19,
                'parent_id' => NULL,
                'name' => 'SDM & Rekrutmen',
                'route_name' => NULL,
                'url' => NULL,
                'icon' => 'bi-people-fill',
                'roles' => '["super_admin","admin_sdm"]',
                'order' => 10,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            4 => 
            array (
                'id' => 20,
                'parent_id' => 19,
                'name' => 'Lowongan Kerja',
                'route_name' => 'admin.karir.index',
                'url' => NULL,
                'icon' => 'bi-briefcase-fill',
                'roles' => '["super_admin","admin_sdm"]',
                'order' => 0,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            5 => 
            array (
                'id' => 21,
                'parent_id' => 19,
                'name' => 'Lamaran Masuk',
                'route_name' => 'admin.lamaran.index',
                'url' => NULL,
                'icon' => 'bi-person-lines-fill',
                'roles' => '["super_admin","admin_sdm"]',
                'order' => 1,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            6 => 
            array (
                'id' => 22,
                'parent_id' => NULL,
                'name' => 'FAQ & Kebijakan Privasi',
                'route_name' => NULL,
                'url' => NULL,
                'icon' => 'bi-info-circle-fill',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 11,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            7 => 
            array (
                'id' => 23,
                'parent_id' => 22,
                'name' => 'FAQ',
                'route_name' => 'admin.faq.index',
                'url' => NULL,
                'icon' => 'bi-question-circle-fill',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 0,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            8 => 
            array (
                'id' => 24,
                'parent_id' => 22,
                'name' => 'Kebijakan Privasi',
                'route_name' => 'admin.privacy-policy.index',
                'url' => NULL,
                'icon' => 'bi-shield-lock-fill',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 1,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            9 => 
            array (
                'id' => 4,
                'parent_id' => NULL,
                'name' => 'Banner',
                'route_name' => 'admin.banner.index',
                'url' => NULL,
                'icon' => 'bi-image-fill',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 0,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            10 => 
            array (
                'id' => 1,
                'parent_id' => NULL,
                'name' => 'Pesan & Kritik Saran',
                'route_name' => NULL,
                'url' => NULL,
                'icon' => 'bi-envelope',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 1,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            11 => 
            array (
                'id' => 2,
                'parent_id' => 1,
                'name' => 'Kritik & Saran',
                'route_name' => 'admin.kritik-saran.index',
                'url' => NULL,
                'icon' => 'bi-envelope-paper-fill',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 0,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            12 => 
            array (
                'id' => 3,
                'parent_id' => 1,
                'name' => 'Pesan Masuk',
                'route_name' => 'admin.kontak.index',
                'url' => NULL,
                'icon' => 'bi-chat-text-fill',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 1,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            13 => 
            array (
                'id' => 5,
                'parent_id' => NULL,
                'name' => 'Promo & Paket',
                'route_name' => 'admin.promo.index',
                'url' => NULL,
                'icon' => 'bi-gift-fill',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 2,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            14 => 
            array (
                'id' => 6,
                'parent_id' => NULL,
                'name' => 'Layanan Unggulan',
                'route_name' => 'admin.layanan.index',
                'url' => NULL,
                'icon' => 'bi-award-fill',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 3,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            15 => 
            array (
                'id' => 8,
                'parent_id' => NULL,
                'name' => 'Partner & Mitra',
                'route_name' => 'admin.partner.index',
                'url' => NULL,
                'icon' => 'bi-building-fill-add',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 4,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            16 => 
            array (
                'id' => 7,
                'parent_id' => NULL,
                'name' => 'Dokter & Jadwal',
                'route_name' => 'admin.dokter.index',
                'url' => NULL,
                'icon' => 'bi-person-badge-fill',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 5,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            17 => 
            array (
                'id' => 25,
                'parent_id' => NULL,
                'name' => 'Informasi Bed',
                'route_name' => 'admin.bed-availability.index',
                'url' => NULL,
                'icon' => 'bi bi-segmented-nav',
                'roles' => '["super_admin"]',
                'order' => 6,
                'is_active' => true,
                'created_at' => '2026-07-27 17:26:12',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            18 => 
            array (
                'id' => 9,
                'parent_id' => NULL,
                'name' => 'Manajemen Artikel',
                'route_name' => NULL,
                'url' => NULL,
                'icon' => 'bi-newspaper',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 7,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            19 => 
            array (
                'id' => 10,
                'parent_id' => 9,
                'name' => 'Konten Artikel',
                'route_name' => 'admin.artikel.index',
                'url' => NULL,
                'icon' => 'bi-file-text-fill',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 0,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            20 => 
            array (
                'id' => 11,
                'parent_id' => 9,
                'name' => 'Kategori Artikel',
                'route_name' => 'admin.kategori-artikel.index',
                'url' => NULL,
                'icon' => 'bi-folder-fill',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 1,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            21 => 
            array (
                'id' => 12,
                'parent_id' => NULL,
                'name' => 'Manajemen Fasilitas',
                'route_name' => NULL,
                'url' => NULL,
                'icon' => 'bi-building',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 8,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            22 => 
            array (
                'id' => 13,
                'parent_id' => 12,
                'name' => 'Fasilitas',
                'route_name' => 'admin.fasilitas.index',
                'url' => NULL,
                'icon' => 'bi-building',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 0,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            23 => 
            array (
                'id' => 14,
                'parent_id' => 12,
                'name' => 'Kategori Fasilitas',
                'route_name' => 'admin.kategori-fasilitas.index',
                'url' => NULL,
                'icon' => 'bi-folder-fill',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 1,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            24 => 
            array (
                'id' => 15,
                'parent_id' => 12,
                'name' => 'Info Tempat Tidur',
                'route_name' => 'admin.bed-availability.index',
                'url' => NULL,
                'icon' => 'bi-hospital',
                'roles' => '["super_admin","admin_marketing"]',
                'order' => 2,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:50',
                'updated_at' => '2026-07-27 17:29:59',
            ),
            25 => 
            array (
                'id' => 26,
                'parent_id' => 19,
                'name' => 'Kategori Pekerjaan',
                'route_name' => 'admin.karir-kategori.index',
                'url' => NULL,
                'icon' => 'bi-tags-fill',
                'roles' => '["super_admin","admin_sdm"]',
                'order' => 2,
                'is_active' => true,
                'created_at' => '2026-08-20 10:00:00',
                'updated_at' => '2026-08-20 10:00:00',
            ),
            26 => 
            array (
                'id' => 27,
                'parent_id' => 19,
                'name' => 'Tipe Pekerjaan',
                'route_name' => 'admin.karir-tipe.index',
                'url' => NULL,
                'icon' => 'bi-funnel-fill',
                'roles' => '["super_admin","admin_sdm"]',
                'order' => 3,
                'is_active' => true,
                'created_at' => '2026-08-20 10:00:00',
                'updated_at' => '2026-08-20 10:00:00',
            ),
        ));
        
        
    }
}