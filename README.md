# Lab TEL Activity Management System

Aplikasi **Lab TEL Activity Management System** adalah platform berbasis web yang dirancang untuk mengelola seluruh ekosistem kegiatan di Laboratorium TEL. Sistem ini mempermudah mahasiswa dalam mengajukan izin penggunaan lab, membantu dosen dan admin dalam mengelola jadwal, serta menyediakan galeri dokumentasi terintegrasi untuk mengarsipkan berbagai kegiatan laboratorium yang telah selesai dilaksanakan.

---

## 👥 Anggota Kelompok 4 (PMPL)

Berikut adalah kontributor dalam pengembangan sistem ini:
* **Ismail Tegar Rwatma Bhumi** - `245150601111016`
* **Hafiidz Rifqiy Syafera** - `245150607111011`
* **Samuel Aryasatya Widiono** - `245150607111018`

---

## ✨ Fitur Utama

Sistem ini dirancang secara komprehensif untuk mendukung efisiensi operasional laboratorium melalui fitur-fitur berikut:

1. **Sistem Multi-role Authentication**
   * Pembagian hak akses yang jelas dan aman untuk 3 pengguna utama: **Mahasiswa**, **Dosen**, dan **Admin**.
2. **Manajemen Kegiatan Knowledge & Riset**
   * Fasilitas pengajuan dan pengelolaan berbagai aktivitas akademik, proyek penelitian (riset), serta agenda transfer *knowledge* di lingkungan Lab TEL.
3. **Upload Dokumentasi**
   * Fitur unggah foto dokumentasi pasca-kegiatan oleh Dosen yang dilengkapi otomatisasi pengisian metadata berkas (nama file asli, tipe file, jenis mime, ukuran berkas, judul kegiatan, dan nama pengunggah).
4. **Dashboard Monitoring**
   * Halaman pemantauan visual yang menampilkan status pengajuan, kartu ringkasan kegiatan, jadwal lab mendatang, serta galeri dokumentasi terbaru secara *real-time*.
5. **Validasi Kegiatan oleh Dosen**
   * Alur kerja persetujuan (*approval system*) terintegrasi yang memungkinkan Dosen memeriksa, menerima, atau menolak pengajuan kegiatan dari mahasiswa secara langsung.
6. **Laporan & Statistik**
   * Penyajian ringkasan data penggunaan laboratorium dalam bentuk angka statistik (Total Pengajuan, *Pending Approval*, dan Kegiatan Disetujui) untuk mempermudah evaluasi aktivitas berkala.

---

## 🛠️ Spesifikasi Teknis (Tech Stack)

Aplikasi ini dibangun menggunakan teknologi modern dengan spesifikasi sebagai berikut:
* **Framework Backend:** Laravel v13.12.0
* **Bahasa Pemrograman:** PHP v8.5.0
* **Frontend Framework:** Laravel Blade + Tailwind CSS
* **Database Engine:** MySQL v8.0+

---

## 🚀 Panduan Instalasi (Getting Started)

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi ini di lingkungan lokal (*localhost*) Anda:

### 1. Prasyarat (Prerequisites)
Pastikan Anda sudah menginstal alat-alat berikut di komputer Anda:
* PHP >= 8.5.0
* Composer
* Node.js & NPM
* MySQL / XAMPP

### 2. Kloning Repositori
Jalankan perintah berikut di terminal Anda untuk mengkloning proyek:
```bash
git clone https://github.com/ismailtgr/LAB-TEL-PMPL-KELOMPOK-4.git
cd LAB-TEL-PMPL-KELOMPOK-4
```

### 3. Instalasi Dependensi (Package)
Instal semua dependensi PHP (Composer) dan JavaScript (NPM) yang dibutuhkan aplikasi:
```bash
composer install
npm install
```

### 4. Konfigurasi Environment `(.env)`
```bash
cp .env.example .env
```
Buka file `.env` yang baru dibuat menggunakan kode editor, lalu sesuaikan bagian konfigurasi database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=LAB-TEL-PMPL-KELOMPOK-4
DB_USERNAME=root
DB_PASSWORD=
```
Catatan: Pastikan Anda sudah membuat database kosong bernama LAB-TEL-PMPL-KELOMPOK-4 di phpMyAdmin sebelum melangkah ke tahap berikutnya.

### 5. Generate Application Key
Buat kunci keamanan enkripsi unik untuk aplikasi Anda:
```bash
php artisan key:generate
```

### 6. Migrasi Database & Seeding
Jalankan migrasi untuk membuat seluruh struktur tabel di database beserta data awalnya (jika ada):
```bash
php artisan migrate
# atau jika memiliki seeder data akun contoh:
php artisan migrate --seed
```

### 7. Hubungkan Storage Link (Penting untuk Fitur Dokumentasi)
Langkah ini wajib dijalankan agar foto dokumentasi yang diunggah oleh Dosen dapat diakses secara publik dan muncul di halaman Mahasiswa:
```bash
php artisan storage:link
```

### 8. Kompilasi Frontend & Jalankan Server
Jalankan proses compile aset Tailwind CSS dan hidupkan server lokal Laravel secara bersamaan:
- Di terminal 1 (Jalankan server Laravel):
```bash
php artisan serve
```
- Di terminal 2 (Jalankan kompilasi Tailwind CSS):
```bash
npm run dev
```
Buka browser Anda dan akses aplikasi melalui tautan: `http://127.0.0.1:8000`

### 📄 Lisensi
Hak Cipta © 2026 - Kelompok 4 PMPL. Seluruh hak cipta dilindungi undang-undang.
