<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AdminMenu;

class AdminMenuSeederV2 extends Seeder
{
    /**
     * Seeder navigasi admin panel (versi baru — bersih & terstruktur).
     * Jalankan dengan: php artisan db:seed --class=AdminMenuSeederV2
     */
    public function run(): void
    {
        DB::table('admin_menus')->truncate();

        // ─────────────────────────────────────────────
        // 1. Banner (standalone)
        // ─────────────────────────────────────────────
        AdminMenu::create([
            'name'       => 'Banner',
            'route_name' => 'admin.banner.index',
            'icon'       => 'bi-image-fill',
            'roles'      => ['super_admin', 'admin_marketing'],
            'order'      => 1,
            'is_active'  => true,
        ]);

        // ─────────────────────────────────────────────
        // 2. Pesan & Kritik Saran (group)
        // ─────────────────────────────────────────────
        $pesan = AdminMenu::create([
            'name'      => 'Pesan & Kritik Saran',
            'icon'      => 'bi-envelope',
            'roles'     => ['super_admin', 'admin_marketing'],
            'order'     => 2,
            'is_active' => true,
        ]);
        AdminMenu::create(['parent_id' => $pesan->id, 'name' => 'Kritik & Saran', 'route_name' => 'admin.kritik-saran.index', 'icon' => 'bi-envelope-paper-fill', 'roles' => ['super_admin', 'admin_marketing'], 'order' => 1, 'is_active' => true]);
        AdminMenu::create(['parent_id' => $pesan->id, 'name' => 'Pesan Masuk',    'route_name' => 'admin.kontak.index',       'icon' => 'bi-chat-text-fill',       'roles' => ['super_admin', 'admin_marketing'], 'order' => 2, 'is_active' => true]);

        // ─────────────────────────────────────────────
        // 3. Promo & Paket (standalone)
        // ─────────────────────────────────────────────
        AdminMenu::create([
            'name'       => 'Promo & Paket',
            'route_name' => 'admin.promo.index',
            'icon'       => 'bi-gift-fill',
            'roles'      => ['super_admin', 'admin_marketing'],
            'order'      => 3,
            'is_active'  => true,
        ]);

        // ─────────────────────────────────────────────
        // 4. Layanan Unggulan (standalone)
        // ─────────────────────────────────────────────
        AdminMenu::create([
            'name'       => 'Layanan Unggulan',
            'route_name' => 'admin.layanan.index',
            'icon'       => 'bi-award-fill',
            'roles'      => ['super_admin', 'admin_marketing'],
            'order'      => 4,
            'is_active'  => true,
        ]);

        // ─────────────────────────────────────────────
        // 5. Partner & Mitra (standalone)
        // ─────────────────────────────────────────────
        AdminMenu::create([
            'name'       => 'Partner & Mitra',
            'route_name' => 'admin.partner.index',
            'icon'       => 'bi-building-fill-add',
            'roles'      => ['super_admin', 'admin_marketing'],
            'order'      => 5,
            'is_active'  => true,
        ]);

        // ─────────────────────────────────────────────
        // 6. Dokter & Jadwal (standalone)
        // ─────────────────────────────────────────────
        AdminMenu::create([
            'name'       => 'Dokter & Jadwal',
            'route_name' => 'admin.dokter.index',
            'icon'       => 'bi-person-badge-fill',
            'roles'      => ['super_admin', 'admin_marketing'],
            'order'      => 6,
            'is_active'  => true,
        ]);

        // ─────────────────────────────────────────────
        // 7. Informasi Bed (standalone)
        // ─────────────────────────────────────────────
        AdminMenu::create([
            'name'       => 'Informasi Bed',
            'route_name' => 'admin.bed-availability.index',
            'icon'       => 'bi-segmented-nav',
            'roles'      => ['super_admin'],
            'order'      => 7,
            'is_active'  => true,
        ]);

        // ─────────────────────────────────────────────
        // 8. Manajemen Artikel (group)
        // ─────────────────────────────────────────────
        $artikel = AdminMenu::create([
            'name'      => 'Manajemen Artikel',
            'icon'      => 'bi-newspaper',
            'roles'     => ['super_admin', 'admin_marketing'],
            'order'     => 8,
            'is_active' => true,
        ]);
        AdminMenu::create(['parent_id' => $artikel->id, 'name' => 'Konten Artikel',   'route_name' => 'admin.artikel.index',          'icon' => 'bi-file-text-fill', 'roles' => ['super_admin', 'admin_marketing'], 'order' => 1, 'is_active' => true]);
        AdminMenu::create(['parent_id' => $artikel->id, 'name' => 'Kategori Artikel', 'route_name' => 'admin.kategori-artikel.index', 'icon' => 'bi-folder-fill',    'roles' => ['super_admin', 'admin_marketing'], 'order' => 2, 'is_active' => true]);

        // ─────────────────────────────────────────────
        // 9. Manajemen Fasilitas (group)
        // ─────────────────────────────────────────────
        $fasilitas = AdminMenu::create([
            'name'      => 'Manajemen Fasilitas',
            'icon'      => 'bi-building',
            'roles'     => ['super_admin', 'admin_marketing'],
            'order'     => 9,
            'is_active' => true,
        ]);
        AdminMenu::create(['parent_id' => $fasilitas->id, 'name' => 'Fasilitas',          'route_name' => 'admin.fasilitas.index',          'icon' => 'bi-building',   'roles' => ['super_admin', 'admin_marketing'], 'order' => 1, 'is_active' => true]);
        AdminMenu::create(['parent_id' => $fasilitas->id, 'name' => 'Kategori Fasilitas', 'route_name' => 'admin.kategori-fasilitas.index', 'icon' => 'bi-folder-fill', 'roles' => ['super_admin', 'admin_marketing'], 'order' => 2, 'is_active' => true]);
        AdminMenu::create(['parent_id' => $fasilitas->id, 'name' => 'Info Tempat Tidur',  'route_name' => 'admin.bed-availability.index',  'icon' => 'bi-hospital',    'roles' => ['super_admin', 'admin_marketing'], 'order' => 3, 'is_active' => true]);

        // ─────────────────────────────────────────────
        // 10. Profile Rumah Sakit (group)
        // ─────────────────────────────────────────────
        $profil = AdminMenu::create([
            'name'      => 'Profile Rumah Sakit',
            'icon'      => 'bi-hospital',
            'roles'     => ['super_admin', 'admin_marketing'],
            'order'     => 10,
            'is_active' => true,
        ]);
        AdminMenu::create(['parent_id' => $profil->id, 'name' => 'Edit Profile RS',    'route_name' => 'admin.profil-rs.edit',  'icon' => 'bi-hospital',  'roles' => ['super_admin', 'admin_marketing'], 'order' => 1, 'is_active' => true]);
        AdminMenu::create(['parent_id' => $profil->id, 'name' => 'Sejarah / Milestone','route_name' => 'admin.milestone.index', 'icon' => 'bi-flag-fill', 'roles' => ['super_admin', 'admin_marketing'], 'order' => 2, 'is_active' => true]);

        // ─────────────────────────────────────────────
        // 11. SDM & Rekrutmen (group)
        // ─────────────────────────────────────────────
        $sdm = AdminMenu::create([
            'name'      => 'SDM & Rekrutmen',
            'icon'      => 'bi-people-fill',
            'roles'     => ['super_admin', 'admin_sdm'],
            'order'     => 11,
            'is_active' => true,
        ]);
        AdminMenu::create(['parent_id' => $sdm->id, 'name' => 'Lowongan Kerja',     'route_name' => 'admin.karir.index',          'icon' => 'bi-briefcase-fill',    'roles' => ['super_admin', 'admin_sdm'], 'order' => 1, 'is_active' => true]);
        AdminMenu::create(['parent_id' => $sdm->id, 'name' => 'Lamaran Masuk',      'route_name' => 'admin.lamaran.index',        'icon' => 'bi-person-lines-fill', 'roles' => ['super_admin', 'admin_sdm'], 'order' => 2, 'is_active' => true]);
        AdminMenu::create(['parent_id' => $sdm->id, 'name' => 'Kategori Pekerjaan', 'route_name' => 'admin.karir-kategori.index', 'icon' => 'bi-tags-fill',         'roles' => ['super_admin', 'admin_sdm'], 'order' => 3, 'is_active' => true]);
        AdminMenu::create(['parent_id' => $sdm->id, 'name' => 'Tipe Pekerjaan',     'route_name' => 'admin.karir-tipe.index',     'icon' => 'bi-funnel-fill',       'roles' => ['super_admin', 'admin_sdm'], 'order' => 4, 'is_active' => true]);

        // ─────────────────────────────────────────────
        // 12. FAQ & Kebijakan Privasi (group)
        // ─────────────────────────────────────────────
        $content = AdminMenu::create([
            'name'      => 'FAQ & Kebijakan Privasi',
            'icon'      => 'bi-info-circle-fill',
            'roles'     => ['super_admin', 'admin_marketing'],
            'order'     => 12,
            'is_active' => true,
        ]);
        AdminMenu::create(['parent_id' => $content->id, 'name' => 'FAQ',              'route_name' => 'admin.faq.index',            'icon' => 'bi-question-circle-fill', 'roles' => ['super_admin', 'admin_marketing'], 'order' => 1, 'is_active' => true]);
        AdminMenu::create(['parent_id' => $content->id, 'name' => 'Kebijakan Privasi','route_name' => 'admin.privacy-policy.index', 'icon' => 'bi-shield-lock-fill',     'roles' => ['super_admin', 'admin_marketing'], 'order' => 2, 'is_active' => true]);

        // ─────────────────────────────────────────────
        // 13. Pengaturan Web (super_admin only, standalone)
        // ─────────────────────────────────────────────
        AdminMenu::create([
            'name'       => 'Pengaturan Web',
            'route_name' => 'admin.settings.edit',
            'icon'       => 'bi-gear-fill',
            'roles'      => ['super_admin'],
            'order'      => 13,
            'is_active'  => true,
        ]);

        // ─────────────────────────────────────────────
        // 14. Akun (group, super_admin only)
        // ─────────────────────────────────────────────
        $akun = AdminMenu::create([
            'name'      => 'Akun',
            'icon'      => 'bi-person-gear',
            'roles'     => ['super_admin'],
            'order'     => 14,
            'is_active' => true,
        ]);
        AdminMenu::create(['parent_id' => $akun->id, 'name' => 'Kelola Admin',  'route_name' => 'admin.users.index',        'icon' => 'bi-people',        'roles' => ['super_admin'], 'order' => 1, 'is_active' => true]);
        AdminMenu::create(['parent_id' => $akun->id, 'name' => 'Log Aktivitas', 'route_name' => 'admin.activity-log.index', 'icon' => 'bi-clock-history', 'roles' => ['super_admin'], 'order' => 2, 'is_active' => true]);
    }
}
