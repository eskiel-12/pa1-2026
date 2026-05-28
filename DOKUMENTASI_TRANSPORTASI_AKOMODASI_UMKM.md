# Dokumentasi Fitur Transportasi, Akomodasi & UMKM pada Destinasi

## 🎯 Ringkasan Perubahan

Telah berhasil membuat fitur lengkap untuk menampilkan dan mengelola Transportasi, Akomodasi, dan UMKM yang terhubung dengan Destinasi secara dinamis.

## 📋 Perubahan yang Dilakukan

### 1. **Database Migrations** ✅
- `2026_05_28_000001_add_destinasi_id_to_akomodasis_table.php` - Menambah foreign key `destinasi_id` ke tabel `akomodasis`
- `2026_05_28_000002_add_destinasi_id_to_transportasis_table.php` - Menambah foreign key `destinasi_id` ke tabel `transportasis`

**Perintah untuk menjalankan:**
```bash
php artisan migrate
```

### 2. **Models Updated** ✅

#### `app/Models/Destinasi.php`
- Tambah relationship `akomodasis()`, `transportasis()`, `umkms()`
- Hubungan many-to-one dengan Akomodasi, Transportasi, dan Umkm

#### `app/Models/Akomodasi.php`
- Tambah relationship `destinasi()` dan `user()`
- Tambah `destinasi_id` ke fillable

#### `app/Models/Transportasi.php`
- Tambah relationship `destinasi()` dan `user()`
- Tambah `destinasi_id` ke fillable

#### `app/Models/Umkm.php`
- Tambah relationship `user()`
- `destinasi_id` sudah ada (dari migration sebelumnya)

### 3. **Admin Controllers Updated** ✅

#### `app/Http/Controllers/Admin/AkomodasiController.php`
- Method `create()` & `edit()` sekarang pass `$destinasis` ke view
- Validation untuk `destinasi_id`
- Status checkbox handling

#### `app/Http/Controllers/Admin/TransportasiController.php`
- Method `create()` & `edit()` sekarang pass `$destinasis` ke view
- Validation untuk `destinasi_id`
- Status checkbox handling

#### `app/Http/Controllers/Admin/UmkmController.php`
- Method `create()` & `edit()` sekarang pass `$destinasis` ke view
- Validation untuk `destinasi_id`

### 4. **Admin Views Updated** ✅

#### Form Create & Edit:
- `resources/views/admin/akomodasi/create.blade.php` - Tambah dropdown Destinasi
- `resources/views/admin/akomodasi/edit.blade.php` - Tambah dropdown Destinasi
- `resources/views/admin/transportasi/create.blade.php` - Tambah dropdown Destinasi
- `resources/views/admin/transportasi/edit.blade.php` - Tambah dropdown Destinasi
- `resources/views/admin/umkm/create.blade.php` - Tambah dropdown Destinasi
- `resources/views/admin/umkm/edit.blade.php` - Tambah dropdown Destinasi

#### Index Lists:
- `resources/views/admin/akomodasi/index.blade.php` - Tambah kolom Destinasi di tabel
- `resources/views/admin/transportasi/index.blade.php` - Tambah kolom Destinasi di tabel
- `resources/views/admin/umkm/index.blade.php` - Tambah kolom Destinasi di tabel

### 5. **Frontend Controller Updated** ✅

#### `app/Http/Controllers/DestinasiController.php`
- Method `show()` sekarang menggunakan relationship `$destinasi->akomodasis()`, `$destinasi->transportasis()`, `$destinasi->umkms()`
- Fallback ke query by `lokasi` jika relationship kosong
- Otomatis pull items yang terhubung dengan destinasi

### 6. **Frontend Views** ✅
- `resources/views/destinasi/detail.blade.php` - Sudah menampilkan Akomodasi, Transportasi, UMKM secara dinamis

## 🚀 Cara Menggunakan

### Step 1: Jalankan Migrations
```bash
php artisan migrate
```

### Step 2: Admin - Tambah Akomodasi/Transportasi/UMKM
1. Login ke admin panel
2. Buka menu Akomodasi / Transportasi / UMKM
3. Klik "Tambah" 
4. Isi form dan **pilih Destinasi** dari dropdown
5. Simpan

### Step 3: Lihat di Frontend
1. Buka halaman destinasi di frontend (`/destinasi/{id}`)
2. Scroll ke bagian "Akomodasi", "Transportasi", "UMKM"
3. Items yang terhubung dengan destinasi akan tampil otomatis

## 📊 Logic Alur Data

### Untuk Admin:
```
Admin Input → Controller validation → destinasi_id saved → DB update
                    ↓
            Relationship terbentuk
```

### Untuk Frontend:
```
User buka /destinasi/{id}
    ↓
DestinasiController->show() run
    ↓
Query: $destinasi->akomodasis()->where('status', true)->latest()->take(6)->get()
    ↓
Jika kosong: Query fallback by lokasi
    ↓
Pass ke view
    ↓
Tampil di halaman detail
```

## ✅ Features Termasuk

1. ✅ Foreign key relationship (destinasi_id)
2. ✅ Form dropdown untuk memilih destinasi
3. ✅ Validation untuk destinasi_id
4. ✅ Display destinasi di admin index table
5. ✅ Dynamic display di frontend (by relationship + fallback by lokasi)
6. ✅ Status checkbox untuk enable/disable items
7. ✅ Image upload handling
8. ✅ User tracking (user_id)

## 🔧 Environment yang Diperlukan

- PHP 8.1+
- MySQL/MariaDB running on port 3307 (sesuai .env)
- Laravel 10+

## 📝 Query Examples

```php
// Get destinasi dengan semua akomodasi
$dest = Destinasi::with('akomodasis')->find(1);

// Get akomodasi untuk destinasi tertentu
$akomodasis = Destinasi::find(1)->akomodasis;

// Filter by status
$active = Destinasi::find(1)->akomodasis()->where('status', true)->get();

// Count
$count = Destinasi::find(1)->akomodasis()->count();
```

## 🛠️ Troubleshooting

### Jika destinasi_id tidak muncul di kolom:
1. Cek apakah migration sudah dijalankan: `php artisan migrate:status`
2. Jika belum, jalankan: `php artisan migrate`
3. Jika sudah, cek database schema dengan command: `php artisan db:show`

### Jika dropdown destinasi tidak muncul di form:
1. Pastikan ada destinasi dengan `status = true` di database
2. Cek controller method `create()` mepass `$destinasis`
3. Cek view file ada dropdown select `name="destinasi_id"`

### Jika frontend tidak menampilkan items:
1. Pastikan items punya `status = true`
2. Cek relationship di model sudah benar
3. Buka browser console cek ada JS error

## 📚 File yang Dimodifikasi

### Created:
- `database/migrations/2026_05_28_000001_add_destinasi_id_to_akomodasis_table.php`
- `database/migrations/2026_05_28_000002_add_destinasi_id_to_transportasis_table.php`

### Updated:
- `app/Models/Destinasi.php`
- `app/Models/Akomodasi.php`
- `app/Models/Transportasi.php`
- `app/Models/Umkm.php`
- `app/Http/Controllers/Admin/AkomodasiController.php`
- `app/Http/Controllers/Admin/TransportasiController.php`
- `app/Http/Controllers/Admin/UmkmController.php`
- `app/Http/Controllers/DestinasiController.php`
- `resources/views/admin/akomodasi/create.blade.php`
- `resources/views/admin/akomodasi/edit.blade.php`
- `resources/views/admin/akomodasi/index.blade.php`
- `resources/views/admin/transportasi/create.blade.php`
- `resources/views/admin/transportasi/edit.blade.php`
- `resources/views/admin/transportasi/index.blade.php`
- `resources/views/admin/umkm/create.blade.php`
- `resources/views/admin/umkm/edit.blade.php`
- `resources/views/admin/umkm/index.blade.php`

## 🎓 Next Steps

Setelah migration berhasil, features sudah siap digunakan!

---
**Created on**: May 28, 2026  
**Project**: PA1-2026 (Geosite Danau Toba)
