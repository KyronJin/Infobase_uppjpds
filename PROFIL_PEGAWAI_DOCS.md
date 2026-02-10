# 📚 SISTEM PROFIL PEGAWAI - DOKUMENTASI LENGKAP

## 🎯 OVERVIEW

Sistem Profil Pegawai adalah modul komprehensif untuk menampilkan struktur organisasi perpustakaan dengan dukungan:
- **Organization Chart** - Tampilan hierarki pegawai dengan foto, nama, dan jabatan
- **Slider View** - Menampilkan profil pegawai dalam bentuk slide
- **Admin Management** - CRUD lengkap untuk mengelola pegawai dan jabatan

---

## 📋 TABLE OF CONTENTS

1. [Struktur Database](#database)
2. [Model & Relationships](#models)
3. [Controllers & Routes](#controllers)
4. [Views & Templates](#views)
5. [Fitur-Fitur](#fitur)
6. [Setup & Installation](#setup)
7. [Testing](#testing)

---

## 🗄️ Database {#database}

### Tables

#### **jabatans**
```
id (bigint) - Primary Key
name (string) - Nama jabatan
order (integer) - Urutan dalam org chart
created_at (timestamp)
updated_at (timestamp)
```

#### **profil_pegawais**
```
id (bigint) - Primary Key
nama (string) - Nama pegawai
jabatan_id (bigint) - Foreign Key to jabatans
deskripsi (text) - Deskripsi/bio pegawai
foto_path (string, nullable) - Path foto profil
created_at (timestamp)
updated_at (timestamp)
```

**Relasi**: One Jabatan → Many ProfilPegawai

---

## 🔗 Models & Relationships {#models}

### ProfilPegawai Model
```php
namespace App\Models;

class ProfilPegawai extends Model {
    protected $table = 'profil_pegawais';
    
    protected $fillable = [
        'nama',
        'jabatan_id',
        'deskripsi',
        'foto_path',
    ];
    
    // Relasi ke Jabatan
    public function jabatan() {
        return $this->belongsTo(Jabatan::class);
    }
    
    // Search scope
    public function scopeSearch($query, $keyword) {
        return $query->where('nama', 'like', "%{$keyword}%")
                    ->orWhere('deskripsi', 'like', "%{$keyword}%")
                    ->orWhereHas('jabatan', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
    }
}
```

### Jabatan Model
```php
namespace App\Models;

class Jabatan extends Model {
    protected $table = 'jabatans';
    protected $fillable = ['name', 'order'];
    
    // Relasi ke ProfilPegawai
    public function profilPegawais() {
        return $this->hasMany(ProfilPegawai::class);
    }
    
    // Order scope
    public function scopeOrdered($query) {
        return $query->orderBy('order', 'asc');
    }
}
```

---

## 🎮 Controllers & Routes {#controllers}

### ProfilPegawaiController
**File**: `app/Http/Controllers/ProfilPegawaiController.php`

**Methods**:
- `index()` - Admin list profil pegawai
- `create()` - Admin form tambah pegawai
- `store()` - Simpan pegawai baru
- `edit($id)` - Admin form edit pegawai
- `update($id)` - Update pegawai
- `destroy($id)` - Hapus pegawai
- `storeJabatan()` - Add jabatan baru
- `updateOrder()` - Reorder jabatans
- `publicIndex()` - Display slider & org chart

### InfobaseController
**File**: `app/Http/Controllers/InfobaseController.php`

**Method**: `profilPegawai()`
- Menampilkan profil pegawai di halaman public
- Return: slides (grouped per 5), allPegawai, jabatans

### Routes
**File**: `routes/web.php`

```php
// Public Routes
Route::get('profil-pegawai', [InfobaseController::class, 'profilPegawai'])
    ->name('profil-pegawai');

// Admin Routes (Protected)
Route::resource('admin/profil-pegawai', ProfilPegawaiController::class)
    ->names('admin.profil_pegawai')->middleware('auth');

Route::post('admin/profil-pegawai/store-jabatan', 
    [ProfilPegawaiController::class, 'storeJabatan'])
    ->name('admin.profil_pegawai.store-jabatan')->middleware('auth');

Route::post('admin/profil-pegawai/update-order', 
    [ProfilPegawaiController::class, 'updateOrder'])
    ->name('admin.profil_pegawai.update-order')->middleware('auth');
```

---

## 🖼️ Views & Templates {#views}

### Public Views

#### **profil-pegawai.blade.php**
`resources/views/infobase/profil-pegawai.blade.php`

**Features**:
- Toggle antara Slider View dan Org Chart View
- Slider: menampilkan 5 pegawai per slide
- Org Chart: hirarki sampai 4+ level
- Search functionality
- Responsive design

**Data diterima**:
```php
$slides       // Collection of profiles grouped by 5
$allPegawai   // All profiles
$jabatans     // All jabatans
$search       // Search query
```

### Admin Views

#### **index.blade.php**
- Tabel semua profil pegawai
- Search & filter
- Admin CRUD buttons
- Modal untuk add jabatan

#### **create.blade.php**
- Form tambah profil pegawai baru
- Input: nama, jabatan, deskripsi, foto
- Image cropper component
- Validation

#### **edit.blade.php**
- Form edit profil pegawai
- Same fields sebagai create

---

## ✨ Fitur-Fitur {#fitur}

### 1. **Organization Chart**
- Tampilan hierarki pegawai dengan garis penghubung
- Support multi-level (4+ level)
- Setiap kartu menampilkan: Foto + Nama + Jabatan
- Responsive pada semua ukuran layar

### 2. **Slider View**
- Carousel otomatis 5 pegawai per slide
- Navigation buttons (prev/next)
- Dot indicators
- Auto-rotate setiap 6 detik
- Manual navigation

### 3. **Search**
- Pencarian berdasarkan: nama, jabatan, deskripsi
- Filter real-time
- Result counter

### 4. **Admin Management**
- **CRUD Operations**: Create, Read, Update, Delete
- **Photo Management**: Upload, crop, delete foto
- **Jabatan Management**: Add/edit jabatan
- **Ordering**: Drag-drop reorder jabatan dalam org chart
- **Pagination**: List dengan pagination 12 items per page

### 5. **Validation**
```php
Nama       : required, string, max 255
Jabatan    : required, exists in jabatans
Deskripsi  : required, string
Foto       : optional, image, mimes (jpeg,png,jpg,gif), max 2MB
```

### 6. **Responsive Design**
- Desktop: Full org chart dengan spacing optimal
- Tablet: Reduced spacing, adjusted card sizes
- Mobile: Horizontal scroll untuk org chart, maintained visibility

---

## 🚀 Setup & Installation {#setup}

### 1. Database Migration
```bash
php artisan migrate
```

### 2. Run Seeder (Data Demo)
```bash
php artisan db:seed --class=ProfilPegawaiSeeder
```

Seeder membuat:
- 5 Jabatan sesuai struktur org chart
- 16 Profil Pegawai dengan nama-nama aktual

### 3. Start Development Server
```bash
php artisan serve --port=8000
```

### 4. Access
- **Public**: http://localhost:8000/profil-pegawai
- **Admin**: http://localhost:8000/admin/profil-pegawai

---

## 🧪 Testing {#testing}

### Manual Testing Checklist

**Public Page**:
- [ ] Load halaman `/profil-pegawai`
- [ ] Slider berfungsi (next/prev/dots)
- [ ] Org chart ditampilkan dengan struktur benar
- [ ] Toggle antar view bekerja
- [ ] Search functionality bekerja
- [ ] Responsive pada mobile/tablet

**Admin Page**:
- [ ] Login ke admin panel
- [ ] List profil pegawai ditampilkan
- [ ] Create profil baru dengan foto
- [ ] Edit profil pegawai
- [ ] Delete profil
- [ ] Add jabatan baru
- [ ] Reorder jabatan pada org chart
- [ ] Image cropper berfungsi

### Database Check Commands
```bash
# Check migration status
php artisan migrate:status

# Check model relationships
php artisan tinker
> App\Models\Jabatan::with('profilPegawais')->get()
> App\Models\ProfilPegawai::with('jabatan')->get()

# Check data count
> App\Models\Jabatan::count()
> App\Models\ProfilPegawai::count()
```

### Test Routes
```bash
# Test public route
curl http://localhost:8000/profil-pegawai

# Test admin routes
curl http://localhost:8000/admin/profil-pegawai
```

---

## 📊 Data Structure Example

### Jabatan Hierarchy
```
1. Kepala Perpustakaan (order: 1)
   └─ Direktur Utama (order: 2)
      └─ Wakil Direktur (order: 3)
         └─ Kepala Bagian (order: 4)
            └─ Staff (order: 5)
```

### Sample Profile
```
Nama: Ahmad Alfariz
Jabatan: Kepala Bagian (Sekretaris Perusahaan)
Deskripsi: Sekretaris Perusahaan yang mengelola administrasi kantor pusat.
Foto: storage/profil_pegawai/ahmad-alfariz.jpg
```

---

## 🔧 Troubleshooting

**Masalah**: Foto tidak tampil
- Pastikan storage link sudah dibuat: `php artisan storage:link`
- Check foto_path di database
- Verify file ada di `storage/app/public/profil_pegawai/`

**Masalah**: Org chart cards tidak align
- Jalankan ulang browser atau refresh cache
- Check responsive breakpoints
- Verify CSS tidak ter-override

**Masalah**: Seeder gagal
- Pastikan database sudah migrated
- Drop dan recreate database jika perlu
- Check error message di console

---

## 📝 File Structure

```
app/
├── Models/
│   ├── ProfilPegawai.php
│   └── Jabatan.php
├── Http/
│   └── Controllers/
│       ├── ProfilPegawaiController.php
│       └── InfobaseController.php
└── Services/

database/
├── migrations/
│   ├── 2026_01_29_172134_create_jabatan_table.php
│   └── 2026_01_29_172155_create_profile_pegawai_table.php
└── seeders/
    └── ProfilPegawaiSeeder.php

resources/
└── views/
    ├── infobase/
    │   └── profil-pegawai.blade.php
    └── admin/
        └── profil_pegawai/
            ├── index.blade.php
            ├── create.blade.php
            └── edit.blade.php

routes/
└── web.php

storage/
└── app/
    └── public/
        └── profil_pegawai/  (Foto profil)
```

---

## 🎯 Performance Tips

1. **Image Optimization**: Compress foto sebelum upload (max 2MB)
2. **Database Indexing**: Indexes sudah optimal pada FK
3. **Pagination**: Admin list menggunakan pagination untuk performa
4. **Lazy Loading**: Org chart query di-optimize dengan `with('jabatan')`
5. **Caching**: Dapat ditambahkan untuk jabatan yang statis

---

## 📞 Support & Support Commands

```bash
# View all profil-pegawai routes
php artisan route:list | grep profil

# Check database structure
php artisan schema:dump --database=mysql

# Reset & reseed data
php artisan migrate:fresh --seed

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

---

**Created**: 2026-02-10  
**Version**: 1.0.0  
**Status**: ✅ Production Ready
