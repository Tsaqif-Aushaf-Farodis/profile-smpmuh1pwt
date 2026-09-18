# Tombol Share & Thumbnail Preview WhatsApp di Halaman Berita

## 1. Apa yang Ditambahkan

1. **Tombol share** di halaman detail berita (`resources/views/article.blade.php`), setelah bagian Tags: WhatsApp, Facebook, Twitter/X, dan tombol "Salin Tautan".
2. **Meta tag Open Graph & Twitter Card** yang dinamis per halaman (judul, deskripsi, gambar artikel), agar saat link berita dibagikan ke WhatsApp/Facebook/Telegram, muncul kartu preview lengkap dengan thumbnail, judul, dan cuplikan teks — bukan cuma link polos.

## 2. Kenapa Thumbnail WhatsApp Sebelumnya Tidak Muncul

WhatsApp (dan Facebook, Telegram, dll.) menampilkan preview link dengan cara **mengambil tag Open Graph** (`<meta property="og:...">`) dari halaman yang dibagikan — bukan dengan "menebak" gambar dari halaman secara otomatis. Sebelumnya, `resources/views/layout/header.blade.php` (dipakai bersama oleh semua halaman: home, berita, program, prestasi, halaman biasa) **sama sekali tidak punya tag Open Graph**, hanya `<title>` dan `<meta name="description">` statis yang sama untuk semua halaman. Karena itu, semua aplikasi chat/social media tidak tahu gambar mana yang harus ditampilkan sebagai thumbnail.

## 3. Perubahan yang Dilakukan

### a. `resources/views/layout/header.blade.php`

Sekarang menerima variabel opsional (dengan nilai default supaya halaman lama tidak perlu diubah):

| Variabel | Default | Kegunaan |
|---|---|---|
| `$metaTitle` | "SMP Muhammadiyah 1 Purwokerto" | `<title>` dan `og:title` |
| `$metaDescription` | "SMP Muhammadiyah 1 Purwokerto" | `meta description` dan `og:description` |
| `$metaImage` | logo sekolah (`assets/images/logo.png`) | `og:image` — **inilah yang jadi thumbnail** |
| `$metaType` | `website` | `og:type` (artikel pakai `article`) |
| `$metaUrl` | URL halaman saat ini | `og:url` |

Tag yang ditambahkan ke `<head>`: `og:type`, `og:site_name`, `og:title`, `og:description`, `og:url`, `og:image`, plus `twitter:card` (summary_large_image), `twitter:title`, `twitter:description`, `twitter:image`.

### b. `resources/views/article.blade.php`

Saat me-render halaman berita, sekarang mengirim data spesifik artikel ke header:

```php
@include('layout.header', [
    'metaTitle' => $article->title . ' - SMP Muhammadiyah 1 Purwokerto',
    'metaDescription' => $article->excerpt ?: Str::limit(strip_tags($article->content), 155),
    'metaImage' => $article->banner_url ?: asset('assets/images/logo.png'),
    'metaType' => 'article',
    'metaUrl' => $shareUrl,
])
```

- `$article->banner_url` sudah disediakan oleh package `filament-blog` dan otomatis menghasilkan **URL absolut** (mis. `http://domain.com/storage/blog/foto.jpg`) — ini wajib absolut karena WhatsApp mengambil gambar dari server, bukan dari browser pengunjung.
- Jika artikel belum punya banner, fallback ke logo sekolah supaya tetap ada thumbnail (bukan kosong).
- Deskripsi memakai kolom `excerpt` kalau diisi penulis, kalau tidak diambil otomatis dari 155 karakter pertama isi artikel (tag HTML dibuang).

### c. Tombol Share

Ditambahkan di bawah bagian Tags, memakai ikon Font Awesome yang sudah ter-load di tema:
- **WhatsApp**: `https://wa.me/?text=judul - link`
- **Facebook**: `https://www.facebook.com/sharer/sharer.php?u=link`
- **Twitter/X**: `https://twitter.com/intent/tweet?text=judul&url=link`
- **Salin Tautan**: tombol JS yang menyalin link ke clipboard, dengan **fallback otomatis** untuk situs yang masih berjalan di HTTP (bukan HTTPS) — karena `navigator.clipboard` browser modern **hanya berfungsi di HTTPS atau localhost**. Tanpa fallback ini, tombol salin-tautan akan error di situs yang belum pakai HTTPS.

## 4. PENTING: Syarat Agar Thumbnail Benar-Benar Muncul di WhatsApp

Menambahkan tag Open Graph saja **tidak cukup** kalau kondisi berikut belum terpenuhi:

1. **Situs harus bisa diakses dari internet publik**, bukan cuma dari jaringan lokal/`.test` domain. WhatsApp perlu mengambil (fetch) halaman dan gambarnya dari server, jadi domain `profile_smpmuh1pwt.test` yang dipakai saat development **tidak akan pernah menampilkan preview** — ini normal dan bukan bug, karena domain itu hanya bisa diakses dari komputer developer sendiri.
2. **`APP_URL` di file `.env` harus diisi domain publik yang benar** (mis. `https://smpmuh1pwt.my.id`), bukan `http://profile_smpmuh1pwt.test/` seperti saat ini di environment lokal — karena semua URL absolut (`og:image`, `og:url`, link share) dibangun dari `APP_URL`.
3. **Sebaiknya situs sudah pakai HTTPS** di production. WhatsApp bisa menampilkan preview dari HTTP, tapi HTTPS lebih disarankan dan dibutuhkan supaya tombol "Salin Tautan" bisa pakai Clipboard API modern (meski sudah ada fallback-nya).
4. Ukuran gambar artikel idealnya minimal 300x200 px, dan rasio mendekati 1.91:1 (mis. 1200x630) supaya tampil maksimal di kartu preview.
5. **WhatsApp meng-cache preview per URL.** Kalau sebelumnya link yang sama pernah dibagikan tanpa thumbnail, WhatsApp/perangkat penerima bisa saja masih menampilkan versi cache lama. Untuk testing ulang setelah deploy, gunakan [Facebook Sharing Debugger](https://developers.facebook.com/tools/debug/) (WhatsApp pakai crawler yang sama seperti Facebook) untuk memaksa refresh cache, atau bagikan ke chat/nomor yang belum pernah menerima link tersebut.

## 5. Cara Menguji Setelah Deploy ke Server Publik

1. Pastikan `.env` production: `APP_URL=https://domain-asli-sekolah.com` (tanpa trailing slash bermasalah, dan sudah HTTPS).
2. Buka salah satu URL berita, mis. `https://domain-asli-sekolah.com/berita/nama-slug`.
3. Tempel URL tersebut ke [Facebook Sharing Debugger](https://developers.facebook.com/tools/debug/) → klik "Scrape Again" → pastikan gambar, judul, dan deskripsi muncul benar.
4. Bagikan link tersebut ke chat WhatsApp → thumbnail seharusnya muncul dalam beberapa detik.

## 6. Catatan

- Mekanisme meta tag dinamis ini (`$metaTitle`, `$metaDescription`, `$metaImage`, dst.) sengaja dibuat generik di `layout/header.blade.php`, jadi bisa dipakai ulang dengan mudah untuk halaman lain (Program, Prestasi, Halaman biasa) kalau nanti dibutuhkan preview yang lebih spesifik juga — saat ini baru diterapkan di halaman Berita sesuai permintaan.
- Status: **sudah diimplementasikan dan diverifikasi** (meta tag ter-render benar per artikel, semua link share terbentuk dengan format & URL absolut yang benar, tombol salin tautan berfungsi termasuk di HTTP) pada 2026-09-18. Verifikasi *thumbnail benar-benar tampil di aplikasi WhatsApp* baru bisa dilakukan setelah situs online di domain publik (lihat §4 dan §5).
