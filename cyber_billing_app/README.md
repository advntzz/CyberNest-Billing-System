# Cyber Billing - Internet Cafe Simulator Billing System

Aplikasi web dinamis berbasis CRUD untuk mengelola billing warnet / internet cafe. Tema dibuat neon hijau dan hitam.

## Fitur
- Dashboard statistik pelanggan, komputer, PC dipakai, dan pendapatan.
- CRUD data pelanggan.
- CRUD data komputer.
- CRUD sesi billing.
- Perhitungan total otomatis menggunakan JavaScript/DOM.
- Pencarian tabel menggunakan JavaScript.
- Laporan pendapatan harian.
- Responsive Design menggunakan Bootstrap 5.
- PHP Native + MySQL.

## Teknologi
- HTML5
- CSS3
- Bootstrap 5 CDN
- JavaScript DOM
- PHP Native
- MySQL

## Cara Menjalankan di XAMPP
1. Copy folder `cyber_billing_app` ke folder `htdocs`.
2. Jalankan Apache dan MySQL di XAMPP.
3. Buka phpMyAdmin.
4. Import file `database.sql`.
5. Buka browser: `http://localhost/cyber_billing_app/`

## Struktur Folder
```text
cyber_billing_app/
├── assets/
│   ├── css/style.css
│   └── js/script.js
├── config/database.php
├── includes/header.php
├── includes/footer.php
├── includes/functions.php
├── pages/dashboard.php
├── pages/pelanggan.php
├── pages/komputer.php
├── pages/billing.php
├── pages/laporan.php
├── database.sql
└── index.php
```