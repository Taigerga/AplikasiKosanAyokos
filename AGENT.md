# AGENT.md — Aplikasi Web Manajemen Kos “AyoKos” (Enhanced)

1. Gambaran Umum

Bangun ulang struktur backend aplikasi kosan berbasis Laravel dengan pendekatan database-first, di mana seluruh desain sistem mengacu pada file sumber utama:
kosan.sql.

Proses ini mencakup:

Transformasi skema SQL → Laravel Migration
Penyesuaian Model, Controller, View, dan Routes
Implementasi RESTful API untuk seluruh entitas database

Tujuan utama:

Menjamin konsistensi antara database dan aplikasi
Menghasilkan arsitektur yang scalable dan maintainable
Menyediakan API yang siap dikonsumsi frontend (web/mobile)
2. Input Utama

Gunakan file dan struktur berikut sebagai referensi:

kosan.sql → sumber utama struktur database
app/Http/Controllers/
app/Models/
resources/views/
routes/
database/migrations/
database/seeders/
3. Transformasi Database (Wajib)
3.1 Migration
Konversi seluruh tabel dari kosan.sql menjadi file migration Laravel
Setiap tabel harus memiliki:
Primary Key (id atau custom sesuai SQL)
Foreign Key (gunakan constrained() atau relasi eksplisit)
Timestamps (created_at, updated_at) jika relevan
Ikuti konvensi Laravel:
snake_case untuk nama kolom
plural untuk nama tabel
3.2 Seeder
Buat seeder untuk data awal (jika ada di SQL dump)
Gunakan:
DatabaseSeeder
Seeder per entitas (misal: UserSeeder, KamarSeeder, dll)
4. Layer Aplikasi
4.1 Model (Eloquent ORM)

Untuk setiap tabel:

Buat model di app/Models
Definisikan:
$fillable atau $guarded
Relasi:
hasMany
belongsTo
hasOne
belongsToMany (jika ada pivot)

Contoh:

Penghuni → belongsTo Kamar
Kamar → hasMany Penghuni
4.2 Controller
a. Web Controller
Digunakan untuk render Blade (resources/views)
Mengelola:
CRUD
Validasi form
Redirect & session
b. API Controller

Gunakan struktur:

app/Http/Controllers/Api/

Gunakan response JSON:

{
  "success": true,
  "data": ...,
  "message": "..."
}
Terapkan:
Resource Controller (php artisan make:controller --api)
Form Request Validation
4.3 Views (Blade)
Sesuaikan semua view dengan perubahan struktur database
Pastikan:
Field form sesuai kolom terbaru
Relasi ditampilkan dengan benar
Gunakan:
Layouting (Blade template)
Komponen reusable jika perlu
4.4 Routes
a. Web Routes (web.php)
Untuk halaman berbasis Blade
Gunakan middleware:
auth
role-based access (admin, pemilik, penghuni)
b. API Routes (api.php)

Gunakan prefix:

/api/

Gunakan:

Route::apiResource('kamar', KamarController::class);
Tambahkan endpoint:
Auth API (login/logout jika ada)
Custom endpoint jika diperlukan
5. REST API (Wajib Lengkap)

Untuk setiap entitas database:

Endpoint standar:
GET /api/{resource} → list
GET /api/{resource}/{id} → detail
POST /api/{resource} → create
PUT/PATCH /api/{resource}/{id} → update
DELETE /api/{resource}/{id} → delete

Tambahan:

Pagination
Filtering (opsional)
Relasi (eager loading dengan with())
6. Validasi & Keamanan
Gunakan:
Form Request (php artisan make:request)
Validasi:
required
unique
exists (foreign key)
Proteksi:
CSRF (web)
Auth middleware (API jika perlu, misal Sanctum)
7. Output yang Diharapkan

Agent harus menghasilkan:

File migration lengkap untuk semua tabel
Seeder untuk data awal
Model dengan relasi lengkap
Controller:
Web Controller
API Controller
Routes:
web.php
api.php
View Blade yang sudah disesuaikan
REST API fully functional untuk semua entitas
8. Constraint & Rules
Jangan mengubah struktur inti dari kosan.sql kecuali diperlukan untuk kompatibilitas Laravel
Semua relasi harus konsisten antara:
Migration
Model
Controller
Gunakan standar Laravel (clean architecture)
