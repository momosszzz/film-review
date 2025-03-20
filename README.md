# ReadMe - Aplikasi Review Film

## Pendahuluan
Aplikasi Review Film adalah platform berbasis web yang memungkinkan pengguna untuk mencari, menambahkan, dan memberikan ulasan terhadap film favorit mereka. Aplikasi ini dikembangkan menggunakan Laravel 11.

## Persyaratan Sistem
Sebelum menginstal dan menjalankan aplikasi, pastikan sistem Anda memenuhi persyaratan berikut:

- **PHP**: Versi 8.1 atau lebih baru
- **Composer**: Versi terbaru
- **Laravel**: Versi 11
- **Database**: MySQL 8 / PostgreSQL / SQLite / MariaDB
- **Node.js**: Versi 16 atau lebih baru
- **NPM/Yarn**: Versi terbaru
- **Web Server**: Apache/Nginx

## Instalasi

1. **Clone Repository**
   ```sh
   git clone https://github.com/momosszzz/film-review.git
   cd film-review
   ```

2. **Instal Dependensi Backend**
   ```sh
   composer install
   ```

3. **Konfigurasi File .env**
   Salin file `.env.example` menjadi `.env` dan atur konfigurasi database:
   ```sh
   cp .env.example .env
   ```
   Sesuaikan konfigurasi database pada file `.env`

4. **Generate Key Aplikasi**
   ```sh
   php artisan key:generate
   ```

5. **Migrasi dan Seeder Database**
   ```sh
   php artisan migrate --seed
   ```

6. **Instal Dependensi Frontend**
   ```sh
   npm install
   ```

7. **Kompilasi Assets**
   ```sh
   npm run dev  # Untuk mode pengembangan
   npm run build # Untuk mode produksi
   ```

8. **Menjalankan Aplikasi**
   ```sh
   php artisan serve
   ```
   Aplikasi akan berjalan di `http://127.0.0.1:8000`

## Ekstensi/Library yang Digunakan

### Backend:
- Laravel 11

### Frontend:
- Vite
- TailwindCSS

---
