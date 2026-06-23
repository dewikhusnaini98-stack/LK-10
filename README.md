# Perpustakaan Digital (LK-10 & LK-11)

Aplikasi Perpustakaan Digital berbasis web yang dibangun dengan framework **Laravel 12** dan menggunakan **WorkOS OAuth** untuk sistem autentikasi aman, serta fitur CRUD lengkap untuk pengelolaan data buku dan sampul (cover).

---

## Anggota Tim / Pembuat
* **Nama**: DEWI NAFIATUL KHUSNAINI
* **NIM**: 24102031

---

## Fitur Utama
1. **Autentikasi WorkOS**: Login yang aman menggunakan Single Sign-On (SSO) / OAuth dari penyedia layanan WorkOS.
2. **Manajemen Buku (CRUD)**:
   - Menampilkan daftar buku beserta sampul (cover), judul, penulis, penerbit, tahun terbit, kategori, dan deskripsi.
   - Menambahkan data buku baru disertai upload gambar sampul.
   - Mengubah informasi buku dan memperbarui gambar sampul (menghapus sampul lama secara otomatis dari penyimpanan).
   - Menghapus data buku beserta berkas gambar sampul terkait.
3. **Penyimpanan Berkas (File Storage)**: Integrasi dengan Local Storage Laravel untuk mengelola berkas sampul buku secara dinamis.
4. **Validasi Formulir Aman**: Menggunakan custom Form Request Laravel (`BookRequest`) untuk validasi input formulir tambah dan edit buku guna meningkatkan keamanan dan integritas data.

---

## Teknologi yang Digunakan
- **Framework Core**: Laravel 12.x
- **Bahasa Pemrograman**: PHP 8.3+
- **Database**: SQLite (untuk testing/lokal) atau MySQL
- **CSS Framework**: Tailwind CSS (melalui Vite)
- **Autentikasi**: WorkOS User Management API
- **Testing Tool**: PHPUnit / Artisan Test Suite

---

## Panduan Instalasi dan Menjalankan Proyek

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek di lingkungan lokal Anda (misalnya menggunakan Laragon atau Apache lokal):

### 1. Prasyarat
Pastikan sistem Anda sudah terinstal:
- PHP >= 8.2 (Disarankan PHP 8.3)
- Composer
- Node.js & NPM
- Database server (MySQL/MariaDB) jika tidak menggunakan SQLite

### 2. Kloning dan Persiapan Berkas
Buka terminal dan masuk ke direktori proyek:
```bash
# Salin file konfigurasi env
cp .env.example .env
```

### 3. Konfigurasi Environment (`.env`)
Buka file `.env` dan sesuaikan pengaturan database serta WorkOS OAuth Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lk-10
DB_USERNAME=root
DB_PASSWORD=

# Kredensial WorkOS
WORKOS_CLIENT_ID=client_xxx
WORKOS_API_KEY=key_xxx
WORKOS_REDIRECT_URI=http://127.0.0.1:8000/auth/callback
```

### 4. Instalasi Dependensi PHP & Node.js
Jalankan perintah berikut untuk menginstal seluruh dependensi:
```bash
# Instal dependensi PHP
composer install

# Instal dependensi JavaScript/CSS
npm install
```

### 5. Generate Application Key & Migrasi Database
Jalankan perintah berikut untuk menghasilkan key enkripsi aplikasi dan menjalankan migrasi database:
```bash
# Generate Key
php artisan key:generate

# Jalankan migrasi database
php artisan migrate
```

### 6. Buat Symbolic Link Storage
Guna memastikan gambar sampul buku yang diunggah dapat diakses secara publik melalui browser, buat tautan penyimpanan:
```bash
php artisan storage:link
```

### 7. Jalankan Server Pengembangan
Jalankan server lokal Laravel dan compiler Vite secara bersamaan:
```bash
# Jalankan Vite compiler (untuk styling Tailwind)
npm run dev

# Jalankan Laravel development server (di terminal terpisah)
php artisan serve
```
Aplikasi sekarang dapat diakses melalui browser di alamat `http://127.0.0.1:8000`.

---

## Panduan Pengujian (Testing)

Untuk memastikan seluruh rute aplikasi, penanganan autentikasi, serta pembatasan rute berfungsi dengan baik, Anda dapat menjalankan suite pengujian otomatis bawaan proyek ini:

```bash
php artisan test
```

Suite pengujian mencakup:
- Pengujian pengalihan rute root `/` ke halaman login (`/login`).
- Pengujian respons sukses halaman login (`200 OK`).
- Pengujian pembatasan rute detail buku (`/books/{id}`) yang menghasilkan status `405 Method Not Allowed` karena rute tampilan individual dinonaktifkan secara sengaja untuk keamanan.
