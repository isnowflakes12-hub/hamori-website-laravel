# 🏥 RS Hamori - Website Laravel

Website resmi Rumah Sakit Hamori dibangun dengan Laravel 12.

---

## 🚀 Cara Setup (Fresh Install dari GitHub)

### 1. Clone Repository
```bash
git clone https://github.com/isnowflakes12-hub/hamori-website-laravel.git
cd hamori-website-laravel
```

### 2. Install Dependencies PHP
```bash
composer install
```

### 3. Install Dependencies Node.js
```bash
npm install
```

### 4. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Buat Database SQLite
```bash
# Buat file database kosong
type nul > database/database.sqlite   # Windows
# atau
touch database/database.sqlite       # Mac/Linux
```

### 6. Jalankan Migrasi
```bash
php artisan migrate
```

### 7. Jalankan Seeder (Import Semua Data)
```bash
php artisan db:seed
```

### 8. Link Storage (untuk file upload/gambar)
```bash
php artisan storage:link
```

### 9. Build Asset Frontend
```bash
npm run build
# atau untuk development dengan hot-reload:
npm run dev
```

### 10. Jalankan Server
```bash
php artisan serve
```

Akses di: **http://localhost:8000**

---

## 🔐 Akun Default Admin

Setelah seeder berjalan, gunakan akun berikut untuk login ke dashboard admin:

| Role | Email | Password |
|------|-------|----------|
| Super Admin | *(cek seeder UsersTableSeeder)* | *(cek seeder)* |

Akses admin panel di: **http://localhost:8000/admin**

---

## 📁 Struktur Menu Admin

| Menu | Role yang Bisa Akses |
|------|---------------------|
| Dashboard | Super Admin, Marketing |
| Banner | Super Admin, Marketing |
| Promo | Super Admin, Marketing |
| Artikel & Kategori | Super Admin, Marketing |
| Layanan Unggulan | Super Admin, Marketing |
| Kritik & Saran | Super Admin, Marketing |
| Fasilitas | Super Admin |
| Dokter & Jadwal | Super Admin |
| Karir | Super Admin |
| Pengaturan Umum | Super Admin |
| Profil RS | Super Admin |
| FAQ | Super Admin |

---

## 🗄️ Database

Proyek ini menggunakan **SQLite** secara default untuk kemudahan development.

Untuk production dengan MySQL, ubah di `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hamori_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

---

## 🛠 Tech Stack

- **Backend:** Laravel 12 (PHP 8.2+)
- **Database:** SQLite (dev) / MySQL (prod)
- **Frontend:** Bootstrap 5, Blade Templates, Vanilla CSS
- **Charts:** Chart.js
- **Rich Text Editor:** Quill.js
- **Image Upload:** Laravel Storage (local disk)

---

## ⚠️ Catatan Penting

- File gambar/upload **tidak** ikut ke GitHub (ada di `storage/app/public/`). Pastikan untuk transfer manual atau gunakan cloud storage.
- Setelah `git pull` di mesin yang sudah ada, cukup jalankan:
  ```bash
  php artisan migrate
  php artisan db:seed --class=SiteSettingsTableSeeder
  ```

---

## 📞 Kontak

RS Hamori - Jalan Raya Pagaden-Subang, Ds. Jabong Kec. Pagaden Kab. Subang Jawa Barat 41251
