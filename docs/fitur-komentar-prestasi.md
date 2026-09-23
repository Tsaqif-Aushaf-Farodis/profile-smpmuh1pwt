# Rencana Implementasi: Kolom Komentar di Halaman Prestasi

## 1. Tujuan

Menambahkan fitur komentar pada halaman detail prestasi (`/prestasi/{slug}`, view: `resources/views/prestasiDetail.blade.php`), dengan konsep yang **sama persis** dengan fitur komentar di halaman Berita (lihat [fitur-komentar-berita.md](fitur-komentar-berita.md)) — hanya beda konten yang dikomentari (Prestasi, bukan Post/Berita).

## 2. Keputusan Desain

Mengikuti keputusan yang sudah disetujui & terbukti berjalan di fitur komentar Berita:

| Keputusan | Ketentuan |
|---|---|
| Siapa yang bisa komentar | Tamu, cukup **Nama + Komentar**. Tidak ada field email |
| Moderasi | Tidak langsung tampil (`is_approved = false` default). Admin toggle tampil/sembunyikan kapan saja |
| Hapus komentar | Admin bisa hapus permanen dari panel (untuk spam/tidak layak) |
| Balasan berjenjang | Tidak ada, flat/linear |
| Proteksi spam | Honeypot field tersembunyi + rate limit 5x/menit per IP |
| Notifikasi | Tidak ada |

## 3. Kenapa Tabel & Resource Terpisah (Bukan Reuse Tabel `comments` Berita)

Tabel `comments` yang sudah ada terikat langsung ke `blog_posts` (`post_id`) dan sudah dipakai di production dengan data asli. Supaya:
- Tidak perlu migrasi ubah struktur tabel yang sudah punya data production,
- Tidak berisiko terhadap fitur komentar Berita yang sudah berjalan,

dibuat set model/tabel/resource **terpisah** khusus Prestasi, dengan pola identik (copy-paste-adapt), bukan tabel polymorphic gabungan. Konsekuensinya: kalau nanti ingin ditambah lagi di Program/halaman lain, pola yang sama diulang lagi (trade-off sederhana vs sedikit duplikasi, dipilih karena project ini lebih mengutamakan kesederhanaan & risiko rendah dibanding DRY).

## 4. Perubahan Database

Migrasi baru `create_prestasi_comments_table`:

```php
Schema::create('prestasi_comments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('prestasi_id')->constrained('prestasis')->cascadeOnDelete();
    $table->string('name');
    $table->text('content');
    $table->boolean('is_approved')->default(false);
    $table->string('ip_address', 45)->nullable();
    $table->timestamps();
});
```

## 5. Perubahan Backend

- **Model baru** `app/Models/PrestasiComment.php` — `belongsTo(Prestasi::class)`, scope `approved()`.
- **Controller baru** `app/Http/Controllers/PrestasiCommentController.php` — method `store()`: validasi `name` (maks 100), `content` (maks 2000), honeypot `website` harus kosong; simpan `ip_address`.
- **Route** (`routes/web.php`):
  ```php
  Route::post('/prestasi/{slug}/komentar', [PrestasiCommentController::class, 'store'])
      ->name('prestasi.comment.store')
      ->middleware('throttle:5,1');
  ```
- **`HomeController@prestasi`**: tambah `$comments = PrestasiComment::approved()->where('prestasi_id', $detail->id)->latest()->get();` dikirim ke view.
- **Panel Admin (Filament)**: `PrestasiCommentResource` baru (grup navigasi "Konten", dekat menu Prestasi) — kolom: judul prestasi, nama, cuplikan komentar, toggle "Tampilkan", tanggal; aksi Delete. Permission di-generate via `shield:generate`.

## 6. Perubahan Frontend

Di `resources/views/prestasiDetail.blade.php`, setelah bagian konten prestasi, tambahkan blok daftar komentar + form kirim komentar — struktur & class CSS sama persis dengan yang dipakai di `article.blade.php` (`.blog-details__comment`, `.blog-details__comment-form`, dst. — class ini sudah ada di tema `eduact.css`, tidak perlu CSS baru).

## 7. Keamanan

Sama seperti fitur komentar Berita: escape output (`{{ }}`, bukan `{!! !!}`), CSRF token, rate limiting per IP, honeypot, moderasi wajib sebelum tampil publik, validasi panjang input.

## 8. Rencana Pengujian

- Isi form komentar di halaman prestasi → tersimpan `is_approved = false`, tidak langsung tampil.
- Admin approve via toggle di `PrestasiCommentResource` → komentar muncul di halaman publik.
- Validasi kosong → error, tidak tersimpan.
- Delete komentar dari panel → hilang permanen.
- Verifikasi visual di browser.

## 9. Tahapan Implementasi

1. Migration `prestasi_comments` + `php artisan migrate`
2. Model `PrestasiComment`
3. `PrestasiCommentController@store` + route
4. Update `HomeController@prestasi` + `prestasiDetail.blade.php`
5. `PrestasiCommentResource` + `shield:generate`
6. Uji end-to-end via browser

## 10. Bug Tambahan yang Ditemukan & Diperbaiki Saat Implementasi

Saat membuat data uji coba, ditemukan bug pre-existing (tidak berkaitan dengan fitur komentar): kolom `published_at` di tabel `prestasis` wajib diisi (`NOT NULL` tanpa default), tapi form "Prestasi" di panel admin (`PrestasiResource`) **tidak punya field untuk mengisinya**. Akibatnya, membuat data Prestasi baru lewat panel admin akan selalu gagal dengan error SQL (`Field 'published_at' doesn't have a default value`).

Karena kolom ini juga tidak dipakai di query manapun (tidak ada logic publish-terjadwal yang membacanya), perbaikan paling aman adalah menjadikannya nullable lewat migration baru (`make_published_at_nullable_on_prestasis_table`), tanpa mengubah perilaku aplikasi. Setelah ini, membuat Prestasi baru dari panel admin berfungsi normal.

**Update setelah deploy ke production (2026-09-23):** migrasi ini sempat gagal di server production dengan error `There is no column with name "published_at" on table "prestasis"`. Penyebabnya: tabel `prestasis` di production ternyata **tidak punya kolom `published_at` sama sekali** — kemungkinan besar migrasi `create_prestasis_table` sudah pernah dijalankan di server itu *sebelum* kolom `published_at`/`published_until` ditambahkan ke file migrasinya (Laravel hanya mencatat nama file migrasi yang sudah jalan, bukan isi/hash-nya, jadi perubahan pada file migration lama tidak otomatis diterapkan ke database yang migration-nya sudah pernah dijalankan). Migrasi perbaikan ini sudah dibuat lebih aman: cek dulu apakah kolomnya ada (`Schema::hasColumn`) — kalau ada, diubah jadi nullable; kalau belum ada sama sekali, langsung ditambahkan sebagai kolom nullable. Dengan begini migrasi ini aman dijalankan baik di database yang skemanya lengkap (lokal) maupun yang skemanya "ketinggalan" seperti production.

## 11. Status

Diimplementasikan dan diverifikasi end-to-end pada 2026-09-23 (submit komentar → tersimpan pending → admin approve via toggle di `PrestasiCommentResource` → tampil publik dengan jam WIB yang benar).
