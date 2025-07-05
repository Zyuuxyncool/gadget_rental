
<h1 align="center">
  <span style="color:#FF5733">G</span>
  <span style="color:#FF8D1A">a</span>
  <span style="color:#FFC300">d</span>
  <span style="color:#DAF7A6">g</span>
  <span style="color:#33FFBD">e</span>
  <span style="color:#33FFF0">t</span>
  <span style="color:#33C4FF"> </span>
  <span style="color:#339BFF">R</span>
  <span style="color:#3371FF">e</span>
  <span style="color:#7A33FF">n</span>
  <span style="color:#B833FF">t</span>
  <span style="color:#E533FF">a</span>
  <span style="color:#FF33D4">l</span>
  <span style="color:#FF3399"> </span>
  <span style="color:#FF3366">M</span>
  <span style="color:#FF3333">a</span>
  <span style="color:#FF6F33">n</span>
  <span style="color:#FFA533">a</span>
  <span style="color:#FFD133">g</span>
  <span style="color:#D4FF33">e</span>
  <span style="color:#98FF33">m</span>
  <span style="color:#66FF33">e</span>
  <span style="color:#33FF57">n</span>
  <span style="color:#33FF8A">t</span>
  <span style="color:#33FFBD"> </span>
  <span style="color:#33FFF0">S</span>
  <span style="color:#33C4FF">y</span>
  <span style="color:#339BFF">s</span>
  <span style="color:#3371FF">t</span>
  <span style="color:#7A33FF">e</span>
  <span style="color:#B833FF">m</span>
</h1>

---

## 🚀 Fitur Utama

### 📊 Dashboard Ringkasan
- Menampilkan total penghasilan (hanya dari transaksi yang telah selesai).
- Statistik jumlah item, pelanggan, dan transaksi.
- Daftar pengembalian gadget yang dijadwalkan hari ini.

### 🔄 Manajemen Transaksi
- Tambah, edit, dan hapus transaksi penyewaan.
- Filter transaksi berdasarkan:
  - Status: Belum Kembali, Terlambat, Dibatalkan, History (selesai).
  - Nama pelanggan, nama item, dan tanggal transaksi.

### 📤 Export Data
- Ekspor data transaksi ke file Excel.
- Dapat difilter berdasarkan status, tanggal, pelanggan, dan item.

### 👥 Manajemen Pelanggan & Item
- Tambah, edit, dan hapus data pelanggan.
- Tambah, edit, dan hapus item gadget yang disewakan.

---

## 🛠️ Teknologi yang Digunakan

| Komponen   | Teknologi                        |
|------------|----------------------------------|
| Backend    | [Laravel](https://laravel.com/) (PHP) |
| Frontend   | Blade Template + jQuery + Ajax   |
| Database   | MySQL                            |
| Ekspor Data | [Laravel Excel (Maatwebsite)](https://laravel-excel.com/) |

---

## ⚙️ Cara Menjalankan Proyek

1. **Clone Repository**
   ```bash
   git clone https://github.com/username/gadget-rental.git
   cd gadget-rental
   ```

2. **Install Dependency**
   ```bash
   composer install
   npm install
   ```

3. **Copy File Environment dan Konfigurasi**
   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Atur Koneksi Database di File `.env`**

6. **Migrasi Database**
   ```bash
   php artisan migrate
   ```

7. **(Opsional) Jalankan Development Server**
   ```bash
   php artisan serve
   ```

---

## 📸 Cuplikan Tampilan *

Not Found.

---

## 🤝 Kontribusi

Kontribusi sangat terbuka! Silakan buat `issue` atau `pull request` jika Anda ingin menambahkan fitur atau melaporkan bug.

---



<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
