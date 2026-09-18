# Rencana Implementasi: Kolom Komentar di Halaman Berita/Artikel

## 1. Tujuan

Menambahkan fitur komentar pada halaman detail berita/artikel (`/berita/{slug}`, view: `resources/views/article.blade.php`) agar pengunjung web dapat memberikan komentar pada artikel, dan admin dapat memoderasi komentar tersebut lewat panel Filament.

## 2. Kondisi Saat Ini

- Artikel dikelola oleh package `stephenjude/filament-blog`, model `Stephenjude\FilamentBlog\Models\Post` (tabel `blog_posts`).
- Halaman detail artikel: `HomeController@article` -> view `article.blade.php`. Belum ada bagian komentar sama sekali.
- Situs **tidak punya sistem login untuk pengunjung publik** (User model hanya dipakai untuk panel admin Filament). Artinya siapa pun yang berkomentar adalah tamu/anonim.
- Tidak ada proteksi spam/captcha di form publik manapun saat ini.

## 3. Keputusan Desain (Final, sudah dikonfirmasi)

| Keputusan | Ketentuan | Alasan |
|---|---|---|
| Siapa yang bisa komentar | Tamu, cukup isi **Nama + Komentar**. **Tidak ada field email sama sekali** | Form sesederhana mungkin, tidak ada sistem akun publik |
| Moderasi | Komentar **tidak langsung tampil**, harus di-approve admin dulu (`is_approved = false` by default). Admin bisa toggle tampil/sembunyikan kapan saja, bukan cuma sekali approve | Mengurangi risiko spam; admin tetap punya kendali penuh kapan komentar tayang |
| Hapus komentar | Admin bisa hapus permanen komentar (spam/tidak layak) dari panel | Permintaan eksplisit: admin bisa hapus komentar spam |
| Balasan berjenjang (nested reply) | **Tidak** di versi ini, komentar flat/linear | Menyederhanakan scope |
| Proteksi spam | Honeypot field (hidden) + rate limit per IP (throttle) | Ringan, tidak perlu API key pihak ketiga (captcha tidak diminta) |
| Notifikasi ke admin | **Tidak ada** | Diminta agar tidak menambah kerumitan |
| Edit/hapus komentar oleh pengirim | Tidak (anonim, tidak ada cara verifikasi kepemilikan) | Konsisten dengan tidak adanya akun publik |

## 4. Perubahan Database

Migrasi baru `create_comments_table`:

```php
Schema::create('comments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('post_id')->constrained('blog_posts')->cascadeOnDelete();
    $table->string('name');
    $table->text('content');
    $table->boolean('is_approved')->default(false);
    $table->string('ip_address', 45)->nullable(); // hanya untuk referensi admin melihat pola spam, tidak ditampilkan publik
    $table->timestamps();
});
```

## 5. Perubahan Backend

- **Model baru** `app/Models/Comment.php`
  - `belongsTo(Post::class)` ke `Stephenjude\FilamentBlog\Models\Post`
  - Scope `approved()`
- **Controller**
  - Tambah method `storeComment(Request $request, string $slug)` di `HomeController` (atau `CommentController` terpisah agar rapi — direncanakan file baru `app/Http/Controllers/CommentController.php`)
  - Validasi: `name` wajib (maks 100 karakter), `content` wajib (maks 2000 karakter), honeypot field harus kosong
  - Simpan `ip_address` dari request untuk referensi admin
- **Route** (`routes/web.php`)
  ```php
  Route::post('/berita/{slug}/komentar', [CommentController::class, 'store'])
      ->name('article.comment.store')
      ->middleware('throttle:5,1'); // maks 5 submit per menit per IP
  ```
- **Panel Admin (Filament)**
  - `CommentResource` baru di `app/Filament/Resources/CommentResource.php` untuk moderasi:
    - Kolom tabel: nama pengirim, cuplikan komentar, judul artikel terkait, tanggal, dan **Toggle "Tampilkan"** (`is_approved`) yang bisa diklik langsung dari list untuk tayang/sembunyikan kapan saja
    - Aksi **Delete** (hapus permanen) untuk komentar spam/tidak layak
  - Generate permission via `shield:generate` supaya konsisten dengan resource lain

## 6. Perubahan Frontend

Di `resources/views/article.blade.php`, setelah bagian tags, tambahkan:
- Daftar komentar yang sudah `is_approved = true`, urut terbaru
- Form komentar (hanya **Nama** dan **Komentar**) dengan:
  - `@csrf`
  - Honeypot field tersembunyi (mis. `<input type="text" name="website" class="d-none">`)
  - Pesan sukses "Komentar Anda telah dikirim dan menunggu persetujuan admin" (karena tidak langsung tayang)
  - Menampilkan error validasi bila ada (`@error`)

Konten komentar akan di-escape dengan `{{ }}` (bukan `{!! !!}`) supaya tidak rentan XSS, karena input murni dari publik/anonim.

## 7. Keamanan

- Escape output komentar (`{{ }}`) — **wajib**, tidak boleh render HTML mentah dari input tamu.
- CSRF token pada form (bawaan Laravel).
- Rate limiting per IP pada endpoint submit.
- Honeypot sederhana untuk bot spam dasar.
- Moderasi wajib sebelum tampil publik.
- Validasi panjang input (`content` maks, misalnya 2000 karakter) untuk mencegah abuse.

## 8. Rencana Pengujian

- Isi form komentar di halaman artikel → pastikan tersimpan dengan `is_approved = false` dan tidak langsung muncul di halaman publik.
- Login admin → buka `CommentResource` → approve komentar → refresh halaman artikel publik → komentar muncul.
- Uji validasi: submit form kosong → muncul pesan error, tidak tersimpan ke DB.
- Uji honeypot: isi field tersembunyi via script → request ditolak diam-diam (redirect balik tanpa error mencolok, tidak tersimpan).
- Uji rate limit: submit berkali-kali cepat dari IP yang sama → request ke-6 dst kena HTTP 429.
- Verifikasi tampilan di browser (desktop) sesuai styling tema yang sudah ada.

## 9. Tahapan Implementasi

1. Buat migration `comments` + jalankan `php artisan migrate`
2. Buat model `Comment`
3. Buat `CommentController@store` + route + form request validation
4. Update `article.blade.php`: daftar komentar (approved) + form submit
5. Buat `CommentResource` (Filament) untuk moderasi + generate shield permissions
6. Uji end-to-end sesuai §8 (termasuk verifikasi visual via browser)

## 10. Status

Plan dikonfirmasi oleh pemilik proyek dan **sudah diimplementasikan serta diverifikasi end-to-end** pada 2026-09-18 (submit komentar → tersimpan pending → admin approve via toggle di panel → tampil publik; termasuk uji delete komentar spam).
