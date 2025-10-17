# 🚀 Panduan Menjalankan Project Laravel

## Persiapan Awal

Sebelum memulai, pastikan Anda sudah menginstal alat-alat berikut di komputer:

| Alat | Fungsi | Cara Cek |
|------|---------|----------|
| **PHP ≥ 8.1** | Menjalankan framework Laravel | `php -v` |
| **Composer** | Mengelola dependency Laravel | `composer -V` |
| **Node.js & NPM** | Untuk build frontend (Vite) | `node -v` dan `npm -v` |
| **MySQL / MariaDB** | Menyimpan data aplikasi | — |
| **Text Editor** | Menulis kode (misalnya VS Code) | — |

> 💡 **Tips:**  
> Unduh Composer dari [https://getcomposer.org/download/](https://getcomposer.org/download/)  
> Unduh Node.js dari [https://nodejs.org](https://nodejs.org)

---

## 📦 2. Menjalankan Laravel

1. Ekstrak masuk ke projek
2. Jalankn composer install
3. npm install
4. copy .env.example .env
5. buat database MySql ydc-skripsi
6. php artisan migrate
7. php artisan db:seed
8. Jalankan aplikasi dengan composer run dev

 No | Nama             | Email                   | Password  | Role       | Keterangan     |
|----|------------------|--------------------------|------------|-------------|----------------|
| 1  | Admin YDC        | admin@gmail.com          | password   | Admin (1)   | Pengelola utama sistem |
| 2  | Manajemen YDC    | manajemen@gmail.com      | password   | Manajemen (2) | Pengelola operasional |
| 3  | drg. Yustika     | drg.yustika@gmail.com    | password   | Dokter (3)  | Terhubung dengan data dokter |
