# Setup Hero Banner/Background Halaman Beranda

## Deskripsi Fitur
Fitur ini memungkinkan admin untuk mengelola background/hero banner halaman beranda melalui halaman gallery admin. Semua foto hero banner dapat diupload dan diatur melalui interface yang user-friendly tanpa perlu mengubah kode.

## Struktur & Implementasi

### 1. Database Schema
```php
// Table: gallery_photos
- id (primary key)
- title (string) - Judul/nama slide
- description (text) - Deskripsi slide
- image_path (string) - Path ke gambar yang diupload
- category (string) - Kategori foto (perpustakaan, koleksi, aktivitas, dll)
- location (enum: 'home', 'about', 'both', 'hero') - Lokasi tampilan
- is_active (boolean) - Status aktif/nonaktif
- order (integer) - Urutan tampilan
- button_text (string) - Teks tombol/headline
- button_link (string) - Link tombol (opsional)
- created_at, updated_at
```

### 2. Model (GalleryPhoto.php)

#### Scopes yang tersedia:
- **`active()`** - Filter foto yang aktif
- **`byCategory($category)`** - Filter berdasarkan kategori
- **`byLocation($location)`** - Filter berdasarkan lokasi
- **`hero()`** - Khusus untuk hero banner (location: 'hero' atau 'both')
- **`home()`** - Khusus untuk halaman home (location: 'home' atau 'both')
- **`about()`** - Khusus untuk halaman about (location: 'about' atau 'both')

#### Penggunaan:
```php
// Ambil hero images
$heroImages = GalleryPhoto::hero()->orderBy('order')->get();

// Ambil foto halaman home
$homePhotos = GalleryPhoto::home()->limit(6)->get();

// Ambil foto halaman about
$aboutPhotos = GalleryPhoto::about()->get();

// Kombinasi scopes
$photos = GalleryPhoto::active()
    ->byCategory('building')
    ->orderBy('order')
    ->get();
```

### 3. Controller Methods

#### InfobaseController.php
```php
public function home(): View
{
    // Ambil hero images dari database
    $heroImages = GalleryPhoto::hero()
        ->orderBy('order')
        ->get();
    
    // Ambil home gallery photos
    $homePhotos = GalleryPhoto::home()
        ->orderBy('order')
        ->limit(6)
        ->get();
    
    return view('home', [
        'heroImages' => $heroImages,
        'homePhotos' => $homePhotos,
    ]);
}
```

#### GalleryPhotoController.php (Admin)
- **index()** - Tampilkan semua foto (dengan pagination)
- **create()** - Form tambah foto baru
- **store()** - Simpan foto ke database
- **edit()** - Form edit foto
- **update()** - Update foto di database
- **destroy()** - Hapus foto dari database

Validation untuk location field:
```php
'location' => 'required|string|in:home,about,both,hero'
```

### 4. Routes

#### Public Routes
```
GET /                          - Halaman beranda (menampilkan hero images)
GET /about                     - Halaman tentang (menampilkan about photos)
```

#### Admin Routes (Protected by Auth)
```
GET    /admin/gallery          - Index/daftar foto
GET    /admin/gallery/create   - Form tambah foto
POST   /admin/gallery          - Store foto baru
GET    /admin/gallery/{id}/edit - Form edit foto
PUT    /admin/gallery/{id}     - Update foto
DELETE /admin/gallery/{id}     - Hapus foto
```

### 5. Views

#### Admin Gallery Views
- **resources/views/admin/gallery/index.blade.php** - Daftar semua foto dengan opsi edit/delete
- **resources/views/admin/gallery/create.blade.php** - Form upload foto baru
- **resources/views/admin/gallery/edit.blade.php** - Form edit foto existing

#### Home View
- **resources/views/home.blade.php** - Menampilkan hero images dalam carousel/slider
  - Jika ada heroImages dari DB → tampilkan images dari database
  - Jika tidak ada heroImages → tampilkan default slides (hardcoded)

### 6. Form Fields untuk Hero Banner

Saat admin membuat/edit foto di halaman gallery admin:
- **Judul Foto** - Nama/title untuk hero banner
- **Deskripsi** - Deskripsi yang tampil di banner
- **Foto** - Upload image (JPEG, PNG, GIF, WebP | Max 5MB)
- **Kategori** - Pilih kategori (building, interior, collection, service, facility, activity)
- **Lokasi Tampilan** - Pilih lokasi:
  - Halaman Beranda (home)
  - Halaman Tentang (about)
  - Hero Banner Beranda (hero) ← **Untuk hero banner/background**
  - Kedua Halaman (both)
- **Urutan Tampilan** - Angka untuk menentukan urutan slide
- **Status Aktif** - Checkbox untuk mengaktifkan/nonaktifkan foto
- **Teks Tombol** (opsional) - Headline/text untuk tombol
- **Link Tombol** (opsional) - URL tujuan saat tombol diklik

## Cara Penggunaan

### Untuk Admin: Upload Hero Banner Baru

1. Login ke admin dashboard
2. Navigasi ke **Admin → Kelola Galeri Foto** (http://127.0.0.1:8000/admin/gallery)
3. Klik tombol **"Tambah Foto"**
4. Isi form:
   - Judul: contoh "Selamat Datang ke Perpustakaan"
   - Deskripsi: contoh "Belajar, Berkarya, dan Bertumbuh"
   - Upload foto dari komputer
   - Kategori: Pilih sesuai kebutuhan
   - **Lokasi Tampilan: Pilih "Hero Banner Beranda"**
   - Urutan: 1 (untuk slide pertama), 2 (untuk slide kedua), dst
   - Aktifkan checkbox "Aktif"
   - Teks Tombol: "Jelajahi" (optional)
   - Link Tombol: "#announcements" atau URL lain (optional)
5. Klik **"Simpan"**
6. Foto akan langsung tampil di halaman beranda!

### Untuk Admin: Mengubah Hero Banner Existing

1. Ke halaman **Kelola Galeri Foto** (http://127.0.0.1:8000/admin/gallery)
2. Cari foto dengan Lokasi "Hero Banner Beranda"
3. Klik tombol **"Edit"**
4. Update data yang diperlukan
5. Klik **"Perbarui"**

### Untuk Admin: Menghapus Hero Banner

1. Ke halaman **Kelola Galeri Foto**
2. Klik tombol **"Hapus"** pada foto yang ingin dihapus
3. Foto akan dihapus dan tidak tampil di beranda

### Untuk Admin: Mengatur Urutan Slide

- Set field "Urutan Tampilan" dengan angka berbeda
- Angka lebih kecil akan tampil lebih dulu
- Contoh: Foto 1 (urutan: 1), Foto 2 (urutan: 2), dst

## Fallback Behavior

Jika tidak ada hero images di database yang aktif:
- Halaman beranda akan menampilkan **4 default slides** yang hardcoded
- Slides ini menggunakan unsplash images
- Default slides tetap berfungsi sebagai backup

## File yang Dimodifikasi

1. **app/Models/GalleryPhoto.php**
   - Menambah scopes: `hero()`, `home()`, `about()`

2. **app/Http/Controllers/InfobaseController.php**
   - Update `home()` method untuk fetch hero images dari database

3. **app/Http/Controllers/Admin/GalleryPhotoController.php**
   - Update validation untuk mendukung 'hero' location
   - Update enum schema untuk mendukung 'hero' value

4. **resources/views/home.blade.php**
   - Update hero section untuk menampilkan database images
   - Tambah kondisional untuk fallback ke default slides

## Query Examples

```php
// Ambil semua hero images yang aktif
$heroImages = GalleryPhoto::hero()->get();

// Ambil hero images dengan urutan tertentu
$heroImages = GalleryPhoto::hero()
    ->orderBy('order')
    ->limit(10)
    ->get();

// Ambil foto building category untuk hero banner
$heroPhotos = GalleryPhoto::hero()
    ->byCategory('building')
    ->orderBy('order')
    ->get();

// Check apakah ada hero images
if (GalleryPhoto::hero()->exists()) {
    // Ada hero images
}

// Ambil total hero images
$count = GalleryPhoto::hero()->count();
```

## Troubleshooting

### Hero images tidak tampil di halaman beranda

1. **Cek database:**
   - Pastikan ada data di table `gallery_photos`
   - Cek kolom `location` memiliki value 'hero'
   - Cek kolom `is_active` bernilai true (1)

2. **Cek controller:**
   - Verifikasi `InfobaseController::home()` di-call dengan benar
   - Cek variable `$heroImages` di-pass ke view

3. **Cek view:**
   - Verifikasi `home.blade.php` memiliki kondisional untuk `$heroImages`
   - Cek image path di database valid

### Upload foto gagal

- Pastikan ukuran file < 5MB
- Format file: JPG, PNG, GIF, WebP
- Cek permissions folder `storage/app/public/gallery`

### Database migration tidak berjalan

```bash
# Jalankan migration
php artisan migrate

# Jika ada error, rollback dan re-run
php artisan migrate:rollback
php artisan migrate
```

## Performance Tips

1. **Limit hero images:** Batasi ke 5-10 slides max untuk performa optimal
2. **Image optimization:** Compress images sebelum upload
3. **Caching:** Pertimbangkan cache hero images jika traffic tinggi:
   ```php
   $heroImages = Cache::remember('hero_images', 3600, function () {
       return GalleryPhoto::hero()->orderBy('order')->get();
   });
   ```

## Future Enhancements

- [ ] Add image lazy loading
- [ ] Add image compression on upload
- [ ] Add drag-drop reorder untuk slides
- [ ] Add hero banner preview sebelum save
- [ ] Add schedule publish (auto show/hide by date)
- [ ] Add analytics untuk track hero banner clicks

---

**Last Updated:** 2026-02-11
**Version:** 1.0
