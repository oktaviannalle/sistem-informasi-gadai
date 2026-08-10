# 💎 Sistem Informasi Gadai - Gadai Startech

[![Laravel Version](https://img.shields.io/badge/Laravel-v12.0-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-%5E8.2-777BB4?style=for-the-badge&logo=php)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v3.4-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com)
[![Pest PHP](https://img.shields.io/badge/Testing-Pest_PHP-8B5CF6?style=for-the-badge&logo=pest)](https://pestphp.com)
[![REST API](https://img.shields.io/badge/API-REST_Sanctum-009688?style=for-the-badge&logo=openapi-initiative)](https://laravel.com/docs/sanctum)

Aplikasi Web **Sistem Informasi Gadai** yang dirancang khusus untuk memenuhi kebutuhan operasional usaha pegadaian modern (**Gadai Startech**). Aplikasi ini mengelola transaksi penaksiran barang, pencatatan gadai, perhitungan bunga & denda otomatis, pencetakan bukti transaksi (SPK), hingga integrasi simulasi notifikasi WhatsApp.

---

## 🚀 Fitur Utama Sistem

### 1. 👥 Manajemen Nasabah & Barang Jaminan
- **Pencatatan Data Nasabah**: Menyimpan nomor KTP unik, nomor telepon, dan alamat nasabah.
- **Inventaris Barang Gadai**: Mendukung berbagai kategori (Elektronik, Gadget, Perhiasan Emas, Kendaraan) lengkap dengan nilai taksiran harga pasar.

### 2. 💰 Transaksi Gadai & Perhitungan Otomatis
- **Penetapan Tenor & Bunga**: Perhitungan otomatis `tanggal_jatuh_tempo` berdasarkan tenor bulan dan persen bunga bulanan.
- **Kalkulasi Denda Keterlambatan**: Deteksi otomatis status terlambat dan perhitungan denda harian (0.5%/hari) secara *real-time*.
- **Total Tebusan**: Mengkalkulasi akumulasi `Pinjaman Pokok + Total Bunga + Denda Keterlambatan`.

### 3. 🖨️ Cetak Surat Perjanjian Kredit (SPK) / Nota Transaksi
- Halaman cetak bukti gadai siap print (CSS `@media print`) berstandar resmi dengan rincian identitas nasabah, barang jaminan, rincian pembayaran, serta kolom tanda tangan nasabah & petugas admin.

### 4. 📲 Integrasi WhatsApp Notification Gateway (API 3rd Party)
- Service simulasi pengiriman notifikasi pesan pengingat jatuh tempo & penagihan denda langsung ke nomor WhatsApp nasabah.

### 5. 🔐 Manajemen Admin / Multi-Petugas (Internal Management)
- Fitur terpusat untuk mendaftarkan akun admin/petugas cabang baru, memperbarui informasi profil admin, reset password, dan menghapus akun petugas dengan proteksi *self-deletion*.

### 6. 🔑 RESTful API dengan Laravel Sanctum
- Menyediakan endpoint API yang aman untuk integrasi aplikasi mobile atau pihak ketiga:
  - Autentikasi API Token (`/api/login`, `/api/logout`).
  - Endpoint resource data Nasabah, Barang Gadai, dan Transaksi Gadai (`/api/nasabah`, `/api/barang-gadai`, `/api/transaksi`).

### 7. 🧪 Automated Testing Suite
- Dilengkapi dengan 34 pengujian otomatis (Unit & Feature Test) menggunakan **Pest PHP** untuk menjamin kestabilan dan keandalan kode (*maintainability*).

---

## 🛠️ Teknologi & Tools

- **Backend**: PHP 8.2+, Laravel 12.x Framework
- **Frontend**: Blade Templating, Tailwind CSS, Alpine.js (Laravel Breeze)
- **Database**: MySQL / SQLite Relational Database
- **API Auth**: Laravel Sanctum (Bearer Token)
- **Testing**: Pest PHP & PHPUnit

---

## 📦 Cara Instalasi & Menjalankan Project

### 1. Clone Repository
```bash
git clone https://github.com/username/sistem-gadai.git
cd sistem-gadai
```

### 2. Install Dependensi PHP & Node.js
```bash
composer install
npm install
```

### 3. Konfigurasi Environment File
Salin file `.env.example` menjadi `.env` dan generate application key:
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Jalankan Migrasi Database & Seeder Data Demo
Jalankan migrasi serta seeder untuk mengisi data dummy realistis (nasabah, barang gadai, dan transaksi):
```bash
php artisan migrate:fresh --seed
```

### 5. Jalankan Server Lokal
```bash
php artisan serve
# Dan di terminal terpisah jalankan Asset Build:
npm run dev
```

Buka browser di `http://localhost:8000`.

---

## 🔐 Kredensial Akun Demo (Seeder)

Setelah menjalankan `php artisan db:seed`, Anda dapat langsung masuk dengan akun administrator:

- **Email**: `admin@gadaistartech.com`
- **Password**: `password`

---

## 📡 Dokumentasi Endpoint REST API

Semua endpoint API memerlukan header `Accept: application/json`. Untuk endpoint terproteksi, tambahkan header `Authorization: Bearer <your_sanctum_token>`.

| Method | Endpoint | Proteksi | Deskripsi |
| :--- | :--- | :---: | :--- |
| `POST` | `/api/login` | Publik | Autentikasi & mendapatkan Sanctum Bearer Token |
| `POST` | `/api/logout` | Token | Revoke/menghapus token autentikasi |
| `GET` | `/api/nasabah` | Token | Mendapatkan daftar seluruh nasabah |
| `GET` | `/api/nasabah/{id}` | Token | Detail data nasabah spesifik |
| `GET` | `/api/barang-gadai` | Token | Mendapatkan daftar barang gadai |
| `GET` | `/api/transaksi` | Token | Mendapatkan daftar seluruh transaksi gadai |
| `POST` | `/api/transaksi` | Token | Membuat transaksi gadai baru |

### Contoh Response REST API (`GET /api/transaksi`):
```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "nama_barang": "Laptop ASUS ROG Strix G15",
      "nama_nasabah": "Budi Santoso",
      "jumlah_pinjaman": "12000000.00",
      "bunga_persen": "5.00",
      "tanggal_jatuh_tempo": "2026-09-04",
      "status": "aktif"
    }
  ]
}
```

---

## 🧪 Menjalankan Automated Tests

Jalankan pengujian otomatis untuk memverifikasi kualitas kode:
```bash
php artisan test
```

---

## 📄 Lisensi & Hak Cipta

Project ini dikembangkan sebagai aplikasi portofolio profesional untuk posisi **Web Developer di Gadai Startech**.
