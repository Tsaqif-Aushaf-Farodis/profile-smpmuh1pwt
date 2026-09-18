# Investigasi & Perbaikan: Panel Admin Filament Selalu Lambat

## 1. Gejala

Halaman admin (panel Filament, `/kelola-admin/...`) terasa lambat setiap kali dimuat.

## 2. Metode Investigasi

Diukur menggunakan Playwright (browser otomatis) yang login ke panel admin lalu membuka beberapa halaman berulang kali, sambil merekam **setiap request jaringan** beserta waktu mulai/selesainya — bukan cuma waktu total halaman, supaya kelihatan persis request mana yang jadi penyebab.

## 3. Penyebab yang Ditemukan

### a. OPcache PHP tidak aktif sama sekali (penyebab utama #1)

Dicek lewat `php -m` dan `phpinfo()` — modul **Zend OPcache tidak ter-load** di instalasi PHP Laragon (`php.ini` di `C:\laragon\bin\php\php-8.3.31-nts-Win32-vs16-x64\php.ini`, baris `zend_extension=opcache` dalam keadaan di-comment).

**Kenapa ini bikin Filament lambat:** tanpa OPcache, PHP harus mem-parse dan meng-compile ulang **semua file PHP dari awal di setiap request** — dan Filament v2 + Livewire memuat sangat banyak class per halaman (semua Resource, Page, komponen form, komponen Livewire, package Spatie, dll). Total ada **9.518 file PHP** di folder `vendor/` proyek ini. Framework biasa (tanpa Filament) jauh lebih ringan, makanya masalah ini terasa lebih parah khusus di panel admin dibanding halaman publik.

**Perbaikan:** mengaktifkan OPcache di `php.ini`:

```ini
zend_extension=opcache

[opcache]
opcache.enable=1
opcache.enable_cli=0
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=20000
opcache.validate_timestamps=1
opcache.revalidate_freq=0
```

Catatan penting soal setting di atas:
- `opcache.validate_timestamps=1` + `opcache.revalidate_freq=0` sengaja dipasang supaya PHP **selalu cek perubahan file** sebelum pakai cache — jadi tetap aman dipakai saat development aktif (edit kode langsung kepakai, tidak perlu clear cache manual). Untuk server production nanti, kombinasi `validate_timestamps=0` bisa dipakai untuk performa maksimal, tapi butuh proses deploy yang me-restart PHP/opcache setiap ada perubahan kode.
- File `php.ini` ini **milik instalasi Laragon di komputer ini**, bukan bagian dari repo Git proyek. Kalau proyek ini dibuka di komputer lain (developer lain, atau server production), OPcache harus dicek/diaktifkan ulang secara terpisah di sana. Ini bukan sesuatu yang bisa "ikut ter-commit".
- Setelah mengubah `php.ini`, Apache/PHP-nya wajib di-restart (lewat Laragon) supaya konfigurasi baru kebaca.

### b. Favicon panel admin menunjuk ke domain eksternal yang mati (penyebab utama #2, paling signifikan)

Ini penyebab paling besar dan paling jelas cocok dengan keluhan "loading selalu lama". Di `config/filament.php`:

```php
'favicon' => 'https://prabubimatech.com/uploads/logo.png',
```

Baris ini kemungkinan sisa dari template/boilerplate awal proyek (mengarah ke domain milik developer sebelumnya), dan domain tersebut sekarang **tidak merespons sama sekali**. Favicon ini dimuat lewat tag `<link rel="icon">` di **setiap** halaman panel admin — jadi browser mencoba mengambil gambar itu di setiap kunjungan halaman, menunggu sampai koneksi **timeout (sekitar 21 detik)** sebelum akhirnya menyerah. Selama menunggu itu, tab browser menampilkan indikator "masih loading" walau isi halamannya sendiri sebenarnya sudah tampil dalam < 1 detik — persis seperti yang dikeluhkan.

Dikonfirmasi lewat rekaman request jaringan:
```
GET https://prabubimatech.com/uploads/logo.png
start=118ms  end=21316ms  durasi=21198ms  [GAGAL: net::ERR_CONNECTION_TIMED_OUT]
```

**Perbaikan:** favicon diarahkan ke aset lokal milik sekolah sendiri:

```php
'favicon' => '/assets/images/logo-single.png',
```

Sambil di situ, juga ditemukan & diperbaiki satu baris lagi di file yang sama:

```php
// sebelum (mengarah ke localhost:8000 — port default `php artisan serve`, tidak relevan untuk setup Laragon ini)
'home_url' => 'http://127.0.0.1:8000/',

// sesudah (kembali ke default paket Filament — link "kembali ke situs" selalu ke domain yang sedang dipakai)
'home_url' => '/',
```

`home_url` ini bukan penyebab lambat (cuma link yang diklik manual, bukan resource yang otomatis dimuat), tapi tetap salah/tidak sesuai untuk environment mana pun kalau di-hardcode `127.0.0.1:8000`.

⚠️ **Catatan teknis:** sempat dicoba `'favicon' => asset('assets/images/logo-single.png')`, tapi ini bikin `php artisan config:cache` / `config:clear` error (`UrlGenerator::__construct(): Argument #2 ($request) must be of type Request, null given`) — karena helper `asset()`/`url()` butuh objek Request yang belum tersedia saat file config dievaluasi lewat perintah Artisan. Solusinya pakai path relatif dari root (`/assets/...`) langsung sebagai string biasa, bukan lewat helper.

## 4. Hasil Sebelum vs Sesudah

Diukur dengan browser otomatis, waktu sampai jaringan benar-benar selesai (`networkidle`), rata-rata dari beberapa kali percobaan:

| Halaman | Sebelum | Sesudah |
|---|---|---|
| `/kelola-admin` (Dashboard) | ~22.000 ms (22 detik) | ~1.000 ms |
| `/kelola-admin/home-setting` | ~22.000 ms* | ~1.300 ms |
| `/kelola-admin/comments` | ~22.000 ms* | ~1.300 ms |
| `/kelola-admin/login` (sebelum OPcache saja) | 580–1.800 ms | 250–500 ms |

\*Semua halaman panel admin kena dampak yang sama karena favicon dimuat di setiap halaman, bukan cuma dashboard.

Total peningkatan: **halaman admin yang tadinya terasa "menggantung" ~22 detik, sekarang selesai dalam ~1 detik** — sekitar 20x lebih cepat.

## 5. Rekomendasi Tambahan (Belum Diterapkan, Opsional)

1. **Cache config & route untuk production** (`php artisan config:cache`, `php artisan route:cache`). Belum diterapkan di environment development ini karena proyek sedang aktif dikembangkan — kalau di-cache, perubahan `.env` atau file route tidak akan kepakai sampai cache di-clear lagi, yang bisa membingungkan saat development. **Untuk server production nanti, ini sangat disarankan** dan wajib dijalankan ulang setiap kali deploy.
2. **Avatar admin memanggil layanan eksternal `ui-avatars.com`** (dipakai Filament secara default untuk membuat avatar dari inisial nama, kalau user belum upload foto profil). Saat ini responsnya cepat (~300ms), tapi tetap sebuah dependency eksternal yang bisa lambat/gagal kalau ada gangguan jaringan/internet. Kalau mau dihilangkan total, bisa ganti `default_avatar_provider` di `config/filament.php` atau isi foto profil admin secara manual.
3. Windows Defender (atau antivirus lain) yang melakukan *real-time scanning* pada folder proyek (`C:\laragon\www\...`) bisa menambah overhead I/O saat PHP membaca ribuan file di `vendor/`. Kalau performa masih terasa kurang optimal setelah perbaikan di atas, menambahkan folder proyek ke pengecualian (exclusion) antivirus bisa membantu — tidak dilakukan di sesi ini karena butuh akses ke pengaturan sistem operasi.

## 6. File yang Diubah

- `C:\laragon\bin\php\php-8.3.31-nts-Win32-vs16-x64\php.ini` — mengaktifkan OPcache (**di luar repo Git**, khusus instalasi Laragon di komputer ini)
- `config/filament.php` — memperbaiki `favicon` (dari URL eksternal mati → aset lokal) dan `home_url` (dari `127.0.0.1:8000` → `/`)

Status: **sudah diterapkan dan diverifikasi** dengan pengukuran sebelum/sesudah pada 2026-09-18.
