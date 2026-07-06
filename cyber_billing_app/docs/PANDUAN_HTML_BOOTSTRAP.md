# Panduan HTML + Bootstrap Cyber Billing

Project ini sudah digabung menjadi aplikasi PHP Native. Di dalam file `.php`, struktur HTML tetap digunakan dan dipadukan dengan Bootstrap.

## File HTML Bootstrap utama

- `includes/header.php`  
  Berisi awal HTML, meta viewport responsive, Bootstrap CDN, CSS custom, dan navbar responsive.

- `includes/footer.php`  
  Berisi footer, Bootstrap JS, dan file JavaScript custom.

- `pages/dashboard.php`  
  Berisi tampilan dashboard/landing aplikasi.

- `pages/pelanggan.php`  
  Berisi form tambah/edit pelanggan dan tabel data pelanggan.

- `pages/komputer.php`  
  Berisi form tambah/edit komputer dan tabel status komputer.

- `pages/billing.php`  
  Berisi form sesi billing, preview total otomatis dengan JavaScript, dan tabel riwayat billing.

- `pages/laporan.php`  
  Berisi rekap pendapatan harian.

## File preview HTML biasa

- `ui_preview.html`  
  File ini bisa dibuka langsung di browser atau VS Code Live Server untuk melihat desain Bootstrap tanpa menjalankan XAMPP. Namun fitur CRUD tidak berjalan di file ini karena CRUD membutuhkan PHP dan MySQL.

## Bootstrap yang dipakai

Bootstrap dipasang lewat CDN:

```html
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
```

## CSS tema neon

CSS custom ada di:

```text
assets/css/style.css
```

Warna utama:

- Background hitam: `#050807`
- Hijau neon: `#39ff88`
- Card gelap: `#0b1411`

## Cara menjalankan aplikasi CRUD

1. Copy folder `cyber_billing_app` ke `htdocs`.
2. Nyalakan Apache dan MySQL di XAMPP.
3. Buka phpMyAdmin.
4. Import `database.sql`.
5. Buka `http://localhost/cyber_billing_app/`.

## Cara melihat UI saja

Buka file:

```text
ui_preview.html
```

File ini cocok untuk mengecek tampilan responsive Bootstrap sebelum aplikasi PHP dijalankan.
