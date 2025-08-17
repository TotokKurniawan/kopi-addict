<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/username/laravel12-projek/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

## 🚀 Tentang Project

Ini adalah project berbasis **Laravel 12**.  
Project ini digunakan untuk [jelaskan fungsi aplikasi kamu, misalnya: sistem manajemen cafe, aplikasi pemesanan taman, dsb].

---

## ⚡ Cara Menggunakan

### 1. Clone Repository

```bash
git clone git remote add origin https://github.com/TotokKurniawan/kopi-addict.git
cd laravel12-projek
```

### 2. Install Dependencies

composer install
npm install && npm run dev

### 3. Konfingurasi ENV

cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=

### 4. Generate APP KEY dan Migrate

php artisan migrate
php artisan key:generate

### 5. Masukkan data dummy

php artisan migrate --seed

### 6. Jalankan Server

php artisan serve

Laravel versi 12 php versi 8.2 minimal
