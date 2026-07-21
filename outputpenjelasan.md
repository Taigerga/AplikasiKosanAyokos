# Analisis Proyek Laravel 12 — AYOKOS: Platform Pencarian & Manajemen Kos Berbasis SaaS

---

## Daftar Isi

1. [Analisis Sistem Secara Keseluruhan](#1-analisis-sistem-secara-keseluruhan)
2. [Apa yang Sudah Dikerjakan](#2-apa-yang-sudah-dikerjakan)
3. [Apa yang Sedang Dikerjakan](#3-apa-yang-sedang-dikerjakan)
4. [Apa yang Perlu Dikerjakan Selanjutnya](#4-apa-yang-perlu-dikerjakan-selanjutnya)
5. [Analisis Komputasi Awan (SaaS)](#5-analisis-komputasi-awan-saas)
6. [Evaluasi Kualitas Kode](#6-evaluasi-kualitas-kode)
7. [Kesimpulan](#7-kesimpulan)

---

## 1. Analisis Sistem Secara Keseluruhan

### 1.1 Tujuan Sistem

**AYOKOS** adalah platform SaaS (Software as a Service) pencarian dan manajemen kos yang dirancang untuk menghubungkan tiga aktor utama dalam satu ekosistem digital:

- **Pemilik Kos** — mengelola properti kos, kamar, kontrak sewa, dan pembayaran
- **Penghuni Kos** — mencari kos, mengajukan kontrak, melakukan pembayaran, dan memberikan ulasan
- **Admin** — mengawasi seluruh aktivitas platform, mengelola data pengguna, dan memastikan operasional berjalan lancar

### 1.2 Arsitektur Aplikasi

| Komponen | Teknologi |
|----------|-----------|
| Backend Framework | Laravel 12 (PHP 8.2+) |
| Database | MySQL (local), SQLite (test) |
| Frontend | Blade + Vanilla JavaScript + Tailwind CSS v4 |
| Build Tool | Vite 7.2 |
| Autentikasi | Laravel Sanctum (SPA + Token) |
| Desain UI | Neobrutalism (hard shadows, bold borders, high contrast) |
| Peta | Leaflet 1.9.4 + Nominatim + OSRM |
| Grafik | Chart.js + jsPDF (export PDF) |
| Ikon | Font Awesome 7.2 (via npm) |

### 1.3 Aktor yang Terlibat

| Aktor | Role | Keterangan |
|-------|------|------------|
| **Admin** | `admin` | Mengelola seluruh data pengguna, kos, kontrak, pembayaran. Dashboard + API |
| **Pemilik Kos** | `pemilik` | Membuat/mengedit/menghapus kos dan kamar, menyetujui/menolak kontrak dan pembayaran, melihat analisis |
| **Penghuni Kos** | `penghuni` | Mencari kos, membuat kontrak, mengunggah bukti pembayaran, memberi ulasan, melihat analisis pengeluaran |

Sistem menggunakan **satu model User** dengan kolom `role` (enum: `admin`, `pemilik`, `penghuni`) — bukan multi-user model. Setiap user memiliki relasi `hasOne` ke profil spesifik role (Admin, Pemilik, atau Penghuni).

### 1.4 Alur Kerja Aplikasi

```
┌─────────────────────────────────────────────────────────────────┐
│                        ALUR KERJA UTAMA                         │
├─────────────────────────────────────────────────────────────────┤
│                                                                 │
│  1. REGISTER → Lengkapi Profil → Status: calon/pending         │
│                                                                 │
│  2. PEMILIK: Buat Kos → Tambah Kamar → Atur Fasilitas         │
│                                                                 │
│  3. PENGHUNI: Cari Kos → Lihat Detail → Ajukan Kontrak        │
│                                                                 │
│  4. PEMILIK: Review Pengajuan → Setujui / Tolak                │
│     ├─ Setujui → Status: aktif, kamar: terisi                  │
│     └─ Tolak → Status: ditolak, kamar: tersedia                │
│                                                                 │
│  5. PENGHUNI: Bayar Sewa → Upload Bukti Pembayaran             │
│                                                                 │
│  6. PEMILIK: Verifikasi → Setujui / Tolak                      │
│     ├─ Setujui → Status: lunas                                 │
│     └─ Tolak → Status: belum                                   │
│                                                                 │
│  7. PENGHUNI: Beri Ulasan (rating + komentar + foto)           │
│                                                                 │
└─────────────────────────────────────────────────────────────────┘
```

### 1.5 Hubungan Antar Modul (Entity Relationship)

```
User (1) ──────> (1) Admin
User (1) ──────> (1) Pemilik
User (1) ──────> (1) Penghuni

Pemilik (1) ───> (*) Kos
Kos (1) ───────> (*) Kamar
Kos (1) ───────> (1) PengaturanKos
Kos (*) <──────> (*) Fasilitas  [via kos_fasilitas pivot]
Kos (1) ───────> (*) FotoKos
Kos (1) ───────> (*) KontrakSewa
Kos (1) ───────> (*) Review

Penghuni (1) ──> (*) KontrakSewa
Penghuni (1) ──> (*) Pembayaran
Penghuni (1) ──> (*) Review

Kamar (1) ─────> (*) KontrakSewa

KontrakSewa (*) > (*) Pembayaran
KontrakSewa (*) > (*) Review

User (1) ──────> (*) Notification (UUID PK, custom table)
```

### 1.6 Pola Desain yang Digunakan

| Pola | Implementasi |
|------|-------------|
| **MVC** | Controller → Service → Model (sebagian besar alur) |
| **Service Pattern** | 14 service class di `app/Services/` — semua business logic terpusat |
| **FormRequest Validation** | 18 class terpusat di `app/Http/Requests/` |
| **Role-Based Access Control** | Middleware custom (`CheckPenghuni`, `CheckPemilik`, `CheckAdmin`) |
| **AJAX-First Form** | Form mendukung AJAX (`data-ajax="true"`) dengan fallback的传统 submission |
| **Dual Auth Architecture** | Session-based (web guard) + Token-based (Sanctum) dalam satu aplikasi |

### 1.7 Statistik Proyek

| Kategori | Jumlah File |
|----------|-------------|
| Controller API | 32 |
| Controller Web | 20 |
| Model | 14 |
| Service | 14 |
| FormRequest | 18 |
| Migrasi | 21 |
| Blade View | 56 |
| Middleware | 5 |
| Seeder | 9 |
| Factory | 10 |
| Test | 8 |
| JavaScript | 21 |
| **Total** | **~243 file** |

**Total Routes:**
- Web: ~72 route
- API: ~82 endpoint
- **Grand Total: ~154 route**

---

## 2. Apa yang Sudah Dikerjakan

### 2.1 Autentikasi dan Otorisasi

| Komponen | Status | File |
|----------|--------|------|
| Login (Web) | ✅ Selesai | `Web\Auth\LoginController`, `auth/login.blade.php` |
| Register (Web) | ✅ Selesai | `Web\Auth\RegisterController`, `auth/register.blade.php` (3-step wizard) |
| Logout (Web) | ✅ Selesai | `Web\Auth\LoginController::logout` |
| Login (API) | ✅ Selesai | `API\Auth\AuthController::login` — Sanctum token |
| Register (API) | ✅ Selesai | `API\Auth\AuthController::register` — Sanctum token + role |
| Register by Role (API) | ✅ Selesai | `registerPenghuni`, `registerPemilik` — route terpisah |
| Me (API) | ✅ Selesai | `API\Auth\AuthController::me` |
| Role-Based Middleware | ✅ Selesai | `CheckPenghuni`, `CheckPemilik`, `CheckAdmin` |
| Redirect After Login | ✅ Selesai | `RedirectIfAuthenticated` — role-aware |

**Alur Kerja:**
1. User submit username + password via form AJAX ke `/api/auth/login`
2. AuthService melakukan autentikasi via `web` guard
3. Sanctum membuat session cookie untuk SPA auth
4. Redirect berdasarkan role: penghuni → `/penghuni/dashboard`, pemilik → `/pemilik/dashboard`

### 2.2 Manajemen Profil

| Komponen | Status | File |
|----------|--------|------|
| Lihat Profil Penghuni | ✅ Selesai | `Web\ProfileController::showPenghuni`, `penghuni/profile/show.blade.php` |
| Edit Profil Penghuni | ✅ Selesai | `Web\ProfileController::editPenghuni` + `updatePenghuni`, `penghuni/profile/edit.blade.php` |
| Upload Foto Profil Penghuni | ✅ Selesai | `Web\ProfileController::uploadPhotoPenghuni` |
| Lihat Profil Pemilik | ✅ Selesai | `Web\ProfileController::showPemilik`, `pemilik/profile/show.blade.php` |
| Edit Profil Pemilik | ✅ Selesai | `Web\ProfileController::editPemilik` + `updatePemilik`, `pemilik/profile/edit.blade.php` |
| Upload Foto Profil Pemilik | ✅ Selesai | `Web\ProfileController::uploadPhotoPemilik` |
| Ganti Password | ✅ Selesai | `ProfileService::changePassword` |
| Profil (API) | ✅ Selesai | `PemilikProfileController`, `PenghuniProfileController` — full CRUD + photo + password |

**Service:** `ProfileService` — 7 method, menangani update username, password, profil fields, dan foto dengan replacement + cleanup.

### 2.3 Manajemen Kos (CRUD)

| Komponen | Status | File |
|----------|--------|------|
| Daftar Kos Pemilik (Web) | ✅ Selesai | `Web\Pemilik\KosController::index` + `pemilik/kos/index.blade.php` |
| Buat Kos (Web) | ✅ Selesai | `create` — form + Leaflet map picker |
| Lihat Detail Kos (Web) | ✅ Selesai | `show` — detail + kamar + fasilitas + reviews |
| Edit Kos (Web) | ✅ Selesai | `edit` — form + Leaflet map picker |
| Hapus Kos (Web) | ✅ Selesai | `destroy` — via KosService |
| Kos Publik (Web) | ✅ Selesai | `Web\Public\KosController` — index (search/filter), show (detail), peta (map) |
| Kos (API) | ✅ Selesai | `PemilikKosController` — full apiResource + `Public\KosController` — index + show |
| Foto Kos | ✅ Selesai | `FotoKosController` (API) + `FotoKosService` — CRUD foto galery |
| Fasilitas Kos | ✅ Selesai | `KosFasilitasController` (API) — CRUD many-to-many |
| Pengaturan Kos | ✅ Selesai | `PengaturanKosController` (API) — notifikasi, denda, toleransi |

**Service:** `KosService` — 13 method termasuk:
- `getPublicKosWithFilters()` — filter lanjutan: keyword, jenis, kota, harga, rating, fasilitas, ketersediaan, sorting
- `getSimilarKos()` — cascading similarity: same owner → same type → same city → random
- `getKosForMap()` — data untuk Leaflet peta interaktif
- `getRecommendedKos()` — rekomendasi untuk homepage

### 2.4 Manajemen Kamar

| Komponen | Status | File |
|----------|--------|------|
| Daftar Kamar (Web) | ✅ Selesai | `Web\Pemilik\KamarController::index` + filter + stats |
| Buat Kamar (Web) | ✅ Selesai | `create` — form + upload foto |
| Edit Kamar (Web) | ✅ Selesai | `edit` — form + foto replacement |
| Hapus Kamar (Web) | ✅ Selesai | `destroy` — file cleanup |
| Kamar (API) | ✅ Selesai | `PemilikKamarController` — full apiResource |
| Kamar Publik (API) | ✅ Selesai | `Public\KamarController` — index + show |

**Service:** `KamarService` — 6 method termasuk uniqueness check nomor kamar per kos.

### 2.5 Manajemen Kontrak Sewa

| Komponen | Status | File |
|----------|--------|------|
| Buat Kontrak (Web) | ✅ Selesai | `Web\Penghuni\KontrakController::create` + `store` |
| Daftar Kontrak Penghuni (Web) | ✅ Selesai | `index` — paginated |
| Detail Kontrak Penghuni (Web) | ✅ Selesai | `show` |
| Daftar Kontrak Pemilik (Web) | ✅ Selesai | `index` — tabbed: pending/aktif/selesai/ditolak |
| Detail Kontrak Pemilik (Web) | ✅ Selesai | `show` — with approve/reject modals |
| Setujui Kontrak (Web) | ✅ Selesai | `approve` — via KontrakService |
| Tolak Kontrak (Web) | ✅ Selesai | `reject` — with alasan |
| Tandai Selesai (Web) | ✅ Selesai | `selesai` |
| Kontrak (API) | ✅ Selesai | `PenghuniKontrakController` + `PemilikKontrakController` — full lifecycle |
| Notifikasi Tenggat | ✅ Selesai | `notifikasiTenggat` — deadline reminders |

**Service:** `KontrakService` — 9 method. Implementasi penting:
- `approveKontrak()` — DB transaction: set kontrak aktif, penghuni aktif, kamar terisi, tolak kontrak pending lain untuk kamar yang sama, kirim 4+ notifikasi
- `rejectKontrak()` — set ditolak, hapus pembayaran pending, bebaskan kamar
- `createKontrak()` — hitung tanggal selesai otomatis berdasarkan `tipe_sewa`, upload foto_ktp

### 2.6 Manajemen Pembayaran

| Komponen | Status | File |
|----------|--------|------|
| Buat Pembayaran (Web) | ✅ Selesai | `Web\Penghuni\PembayaranController::create` + `store` |
| Daftar Pembayaran Penghuni (Web) | ✅ Selesai | `index` |
| Detail Pembayaran Penghuni (Web) | ✅ Selesai | `show` |
| Daftar Pembayaran Pemilik (Web) | ✅ Selesai | `index` — with stats |
| Setujui Pembayaran (Web) | ✅ Selesai | `approve` — via PembayaranService |
| Tolak Pembayaran (Web) | ✅ Selesai | `reject` |
| Pembayaran (API) | ✅ Selesai | Full apiResource untuk Penghuni + custom actions untuk Pemilik |
| Payment Callback (API) | ✅ Selesai | `PaymentCallbackController` — webhook settled/paid/expired/failed |
| Simulate Payment (API) | ✅ Selesai | `simulatePayment` — testing endpoint |

**Service:** `PembayaranService` — 7 method. Implementasi penting:
- `approvePembayaran()` — DB transaction: set lunas, handle pembayaran pertama (set tanggal kontrak), perpanjang tanggal berakhir untuk pembayaran berikutnya
- `getPaymentOptions()` — generate opsi durasi pembayaran berdasarkan tipe_sewa
- `createPembayaran()` — auto-calculated start date setelah pembayaran terakhir berakhir

### 2.7 Sistem Ulasan (Review)

| Komponen | Status | File |
|----------|--------|------|
| Buat Ulasan (Web) | ✅ Selesai | `Web\Penghuni\ReviewController::create` + `store` |
| Edit Ulasan (Web) | ✅ Selesai | `edit` + `update` — ownership check |
| Hapus Ulasan (Web) | ✅ Selesai | `destroy` — file cleanup |
| Riwayat Ulasan (Web) | ✅ Selesai | `history` |
| Ulasan Pemilik (Web) | ✅ Selesai | `Web\Pemilik\ReviewController::index` — all reviews across owner's kos |
| Ulasan (API) | ✅ Selesai | Full apiResource + custom actions `create`, `history` |

**Service:** `ReviewService` — 5 method. Fitur:
- `canReview()` — cek: belum pernah review + punya kontrak (aktif/selesai) di kos tersebut
- Rating divalidasi di model boot: harus 1-5
- Foto review dengan upload + replacement

### 2.8 Dashboard

| Komponen | Status | File |
|----------|--------|------|
| Dashboard Penghuni (Web) | ✅ Selesai | `Web\Penghuni\DashboardController` — stats, kontrak aktif, pembayaran terakhir |
| Dashboard Pemilik (Web) | ✅ Selesai | `Web\Pemilik\DashboardController` — total kos/kamar/kontrak/pendapatan |
| Dashboard Admin (API) | ✅ Selesai | `API\Admin\AdminDashboardController` — 7 statistik |
| Dashboard (API) | ✅ Selesai | `PemilikDashboardController` + `PenghuniDashboardController` |

### 2.9 Analisis dan Grafik

| Komponen | Status | File |
|----------|--------|------|
| Analisis Pemilik (Web) | ✅ Selesai | `pemilik/analisis/index.blade.php` — Chart.js + PDF export |
| Analisis Penghuni (Web) | ✅ Selesai | `penghuni/analisis/index.blade.php` — Chart.js |
| Analisis (API) | ✅ Selesai | `PemilikAnalisisController` + `PenghuniAnalisisController` |
| Export PDF | ✅ Selesai | `pdf-export.js` — jsPDF export chart |

**Service:** `AnalisisService` — 7 method. Grafik yang tersedia:
- **Pemilik:** Pendapatan bulanan (12 bulan), status kamar (doughnut), tipe kos (bar), status kontrak (pie), rating (bar), tipe kamar (doughnut), pendapatan per kos, penghuni aktif per kos
- **Penghuni:** Riwayat kontrak, pembayaran bulanan (6 bulan), status pembayaran (doughnut), durasi menginap, tipe kos disewa, rating, tipe kamar

### 2.10 Sistem Notifikasi

| Komponen | Status | File |
|----------|--------|------|
| Notifikasi In-App | ✅ Selesai | `notifications/index.blade.php` — AJAX read/mark-read |
| Notifikasi API | ✅ Selesai | `API\NotificationController` — 8 endpoint |
| Email: Kontrak Diterima | ✅ Selesai | Template `penghuni/kontrak_diterima.blade.php` |
| Email: Kontrak Ditolak | ✅ Selesai | Template `penghuni/kontrak_ditolak.blade.php` |
| Email: Pengajuan Baru | ✅ Selesai | Template `pemilik/pengajuan_baru.blade.php` |
| Email: Tenggat Waktu | ✅ Selesai | Template untuk penghuni + pemilik |
| Email: Pembayaran | ✅ Selesai | Template untuk penghuni + pemilik |
| Email: Menunggu Persetujuan | ✅ Selesai | Template `penghuni/menunggu_persetujuan.blade.php` |

**Service:** 5 kelas notifikasi:
- `KontrakNotificationService` — dual-channel (email + in-app), digunakan oleh `KontrakService`
- `PembayaranNotificationService` — dual-channel, digunakan oleh `PembayaranService`
- `NotificationService` — email-only, legacy
- `NotificationEmailService` — low-level email helper
- `ALLNotificationService` — generic utility

### 2.11 Halaman Publik

| Halaman | Status | File |
|---------|--------|------|
| Homepage | ✅ Selesai | `public/home.blade.php` — hero, stats, rekomendasi, FAQ, pricing tiers |
| Pencarian Kos | ✅ Selesai | `public/kos/index.blade.php` — filter lanjutan, card grid |
| Detail Kos | ✅ Selesai | `public/kos/show.blade.php` — gallery, info, kamar, reviews, peta |
| Peta Interaktif | ✅ Selesai | `public/kos/peta.blade.php` — Leaflet, routing OSRM, nearby search |
| About | ✅ Selesai | `public/pages/about.blade.php` |
| Cara Pesan | ✅ Selesai | `public/pages/howto.blade.php` — 5-step guide |
| Syarat & Ketentuan | ✅ Selesai | `public/pages/terms.blade.php` |
| Kebijakan Privasi | ✅ Selesai | `public/pages/privacy.blade.php` |

### 2.12 File Storage

| Komponen | Status | File |
|----------|--------|------|
| Custom Storage Route | ✅ Selesai | `routes/web.php` — `GET /storage/{folder}/{filename}` |
| Backward-Compat Redirect | ✅ Selesai | `GET /files/{folder}/{filename}` |
| Allowlist Folder | ✅ Selesai | `kos, kamar, ktp, bukti, pembayaran, profiles, reviews, kontrak, foto_profil, bukti_pembayaran` |

### 2.13 API RESTful

| Grup | Jumlah Endpoint | Status |
|------|-----------------|--------|
| Public API (home, kos, kamar, fasilitas, reviews) | 16 | ✅ Semua selesai |
| Auth API (login, register, logout, me) | 6 | ✅ Semua selesai |
| Penghuni API (dashboard, analisis, profile, kontrak, pembayaran, reviews) | 21 | ✅ Semua selesai |
| Pemilik API (dashboard, analisis, profile, kos, kamar, kontrak, pembayaran, reviews, pengaturan, foto, fasilitas) | 33 | ✅ Semua selesai |
| Admin API (dashboard, admin-users, data-pemilik, data-penghuni, data-kontrak, data-pembayaran) | 26 | ✅ Semua selesai |
| Notification API | 8 | ✅ Semua selesai |
| Payment Callback | 2 | ✅ Semua selesai |
| **Total** | **~82** | |

### 2.14 Pengujian

| File Test | Status |
|-----------|--------|
| `tests/Feature/Api/AuthTest.php` | ✅ |
| `tests/Feature/Api/KontrakTest.php` | ✅ |
| `tests/Feature/Api/KosTest.php` | ✅ |
| `tests/Feature/Api/PembayaranTest.php` | ✅ |
| `tests/Unit/Services/AnalisisServiceTest.php` | ✅ |
| `tests/Unit/Services/KosServiceTest.php` | ✅ |
| `tests/Unit/Services/ProfileServiceTest.php` | ✅ |

### 2.15 Seeders dan Factories

| File | Fungsi |
|------|--------|
| `UsersSeeder` | 3 user: admin, pemilik (Yanto27), penghuni (rizki1) |
| `FasilitasSeeder` | 9 fasilitas (WiFi, Laundry, Dapur, dll) |
| `PemilikSeeder` | 2 pemilik |
| `PenghuniSeeder` | 1 penghuni |
| `AdminSeeder` | 1 admin |
| `KosSeeder` | 2 kos contoh |
| `KamarSeeder` | 3 kamar |
| `KosFasilitasSeeder` | 18 pivot records |
| 10 Factory | Semua model — siap untuk testing |

---

## 3. Apa yang Sedang Dikerjakan

Berdasarkan analisis mendalam terhadap seluruh source code, ditemukan beberapa bagian yang masih dalam tahap pengembangan atau belum sepenuhnya selesai:

### 3.1 Admin Web Dashboard — Belum Ada Route

**Status:** ⚠️ Sebagian

**Temuan:**
- Controller `Web\Admin\DashboardController` sudah ada di `app/Http/Controllers/Web/Admin/DashboardController.php` dengan method `index()` yang sudah diimplementasikan (query User, Kos, KontrakSewa, Pembayaran)
- View `admin/dashboard.blade.php` sudah ada
- **Namun tidak ada route di `web.php` yang mengarah ke controller ini**

**Alasan kesimpulan:** Route untuk admin web tidak didefinisikan sama sekali di `routes/web.php`. Admin sidebar mereferensikan halaman-halaman yang belum memiliki route.

### 3.2 Admin CRUD Views — Belum Lengkap

**Status:** ⚠️ Sebagian

**Temuan:**
- Sidebar admin di `layouts/partials/dashboard-admin.blade.php` mereferensikan menu: Dashboard, Kelola User, Kelola Kos, Kelola Kontrak, Pembayaran, Moderasi Review, Laporan
- Hanya `admin/dashboard.blade.php` yang ada sebagai view
- **Belum ada view untuk:**
  - Kelola Data Penghuni (CRUD view)
  - Kelola Data Pemilik (CRUD view)
  - Kelola Data Kontrak (read-only view)
  - Kelola Data Pembayaran (read-only view)
  - Moderasi Review
  - Laporan

**Alasan kesimpulan:** Sidebar sudah terdefinisi dengan menu lengkap, namun view untuk halaman-halaman tersebut belum dibuat. Controller API sudah lengkap untuk admin (6 controller), tapi web views belum diimplementasikan.

### 3.3 Penghuni Analisis Spending — Belum Lengkap di Web

**Status:** ⚠️ Sebagian

**Temuan:**
- `Web\Penghuni\AnalisisController::getSpendingAnalysis()` hanya melakukan redirect ke `penghuni.analisis.index` — **tidak ada logika spending-specific**
- `API\Penghuni\PenghuniAnalisisController::getSpendingAnalysis()` sudah **sepenuhnya diimplementasikan** dengan monthly spending trend dan price trend by year

**Alasan kesimpulan:** Versi Web dari analisis spending belum diimplementasikan, hanya redirect ke halaman analisis umum. Versi API sudah lengkap.

### 3.4 Duplikasi Migrasi Notifications

**Status:** ⚠️ Potensi Bug

**Temuan:**
- Dua file migrasi untuk tabel `notifications`:
  - `2026_04_29_130920_create_notifications_table.php`
  - `2026_05_15_122541_create_notifications_table.php`
- Keduanya membuat tabel `notifications` dengan schema yang berbeda

**Alasan kesimpulan:** Dua migrasi untuk tabel yang sama akan menyebabkan error saat menjalankan `php artisan migrate:fresh`. Salah satu harus dihapus atau digabung.

### 3.5 Migrasi `pengaturan_kos` Hilang

**Status:** ⚠️ Potensi Bug

**Temuan:**
- Model `PengaturanKos` ada di `app/Models/PengaturanKos.php`
- Route API sudah terdefinisi: `PengaturanKosController` dengan full CRUD
- Service sudah ada: `KosService` dan `PengaturanKosController` menggunakan model ini
- **Namun tidak ditemukan migrasi khusus untuk tabel `pengaturan_kos`** di direktori `database/migrations/`

**Alasan kesimpulan:** Tabel `pengaturan_kos` mungkin dibuat melalui mekanisme lain atau migrasinya hilang/tidak tercommit.

### 3.6 Ketidakcocokan Nama Kolom pada Admin Dashboard

**Status:** ⚠️ Potensi Bug

**Temuan:**
- `Web\Admin\DashboardController` (line 25): menggunakan `->sum('jumlah_bayar')`
- `API\Admin\AdminDashboardController` (line 25): menggunakan `->sum('jumlah')`
- Keduanya query tabel `pembayaran` untuk total bulan ini

**Alasan kesimpulan:** Salah satu controller pasti menggunakan nama kolom yang salah. Kolom yang benar di tabel `pembayaran` adalah `jumlah` (berdasarkan migrasi), sehingga `jumlah_bayar` di Web Admin Dashboard Controller kemungkinan besar salah.

### 3.7 `ExtendKontrakRequest` Tidak Ditemukan

**Status:** ⚠️ Missing

**Temuan:**
- `AGENTS.md` mereferensikan `ExtendKontrakRequest.php` di `app/Http/Requests/Penghuni/`
- File ini **tidak ditemukan** di codebase

**Alasan kesimpulan:** Form request untuk perpanjangan kontrak belum dibuat, atau sudah direncanakan tapi belum diimplementasikan.

### 3.8 Admin API Stub Methods (Intentional)

**Status:** ℹ️ Disengaja

**Temuan:** 19 method di API controllers sengaja return error 400 dengan pesan deskriptif. Ini bukan bug, melainkan disengaja karena `apiResource` generate route CRUD otomatis, tapi beberapa action tidak diizinkan:

| Controller | Method | Pesan |
|-----------|--------|-------|
| `Admin\PemilikController` | `store` | "Create pemilik via register endpoint." |
| `Admin\PenghuniController` | `store` | "Create penghuni via register endpoint." |
| `Admin\KontrakSewaController` | `store`, `update`, `destroy` | "Not available via admin endpoint." |
| `Admin\PembayaranController` | `store`, `update`, `destroy` | "Not available via admin endpoint." |
| `Pemilik\PemilikKontrakController` | `store` | "Use create kontrak via Penghuni endpoint." |
| `Pemilik\PemilikKontrakController` | `update` | "Method not supported. Use approve/reject/selesai." |
| `Pemilik\PemilikPembayaranController` | `store` | "Use create payment via Penghuni endpoint." |
| `Pemilik\PemilikPembayaranController` | `update`, `destroy` | "Method not supported. Use approve/reject." |
| `Pemilik\PemilikReviewController` | `store`, `update`, `destroy` | "Use endpoint via Penghuni." |
| `Pemilik\FotoKosController` | `update` | "Update not supported. Delete and re-upload." |
| `Penghuni\PenghuniPembayaranController` | `update`, `destroy` | "Not supported." |

### 3.9 Orphaned Controller dan Unused Method

| Temuan | Keterangan |
|--------|------------|
| `Web\Admin\DashboardController` | Controller terimplementasi tapi tidak ada route di `web.php` |
| `Web\Pemilik\KontrakController::testEmail()` | Method terimplementasi (kirim email test) tapi tidak ada route |
| `PenghuniReviewController::history()` | Method duplikat dari `index()` — panggil service yang sama |

---

## 4. Apa yang Perlu Dikerjakan Selanjutnya

### 4.1 Prioritas Tinggi

| No | Tugas | Alasan | Manfaat | Estimasi Kompleksitas | Modul Terpengaruh |
|----|-------|--------|---------|----------------------|-------------------|
| 1 | **Tambahkan Route Admin di `web.php`** | Controller dan view dashboard sudah ada, tapi tidak ada route | Admin bisa mengakses dashboard via web | Mudah | `routes/web.php` |
| 2 | **Buat View Admin CRUD** | Sidebar admin sudah ada, tapi halaman manajemen data belum ada | Admin bisa mengelola pengguna, kos, kontrak, pembayaran via web | Sedang | `resources/views/admin/`, `Web\Admin\*` |
| 3 | **Hapus/Gabung Migrasi Duplikat** | Dua migrasi `notifications` akan error saat fresh migrate | Menghindari error migrasi | Mudah | `database/migrations/` |
| 4 | **Buat Migrasi `pengaturan_kos`** | Model dan route ada tapi tabel tidak ada | Menghindari error saat akses pengaturan kos | Mudah | `database/migrations/` |
| 5 | **Perbaiki Kolom `jumlah_bayar` → `jumlah`** | Salah satu controller pasti salah query | Menghitung total pembayaran dengan benar | Mudah | `Web\Admin\DashboardController` |
| 6 | **Lengkapi Web Penghuni Analisis Spending** | Versi API sudah lengkap, Web belum | Penghuni bisa melihat analisis pengeluaran di web | Mudah | `Web\Penghuni\AnalisisController` |

### 4.2 Prioritas Sedang

| No | Tugas | Alasan | Manfaat | Estimasi Kompleksitas | Modul Terpengaruh |
|----|-------|--------|---------|----------------------|-------------------|
| 7 | **Buat `ExtendKontrakRequest`** | Direferensikan di AGENTS.md tapi belum ada | Validasi terpusat untuk perpanjangan kontrak | Mudah | `app/Http/Requests/Penghuni/` |
| 8 | **Aktifkan Spatie Permission** | Tabel permission/roles sudah ada di migrasi tapi tidak digunakan | Permission-based access control yang lebih granular | Sedang | Auth, Middleware |
| 9 | **Tambah Test Coverage** | Hanya 8 test file dari ~52 controller | Memastikan stabilitas kode | Sedang | `tests/` |
| 10 | **Tambah Rate Limiting API** | Belum ada rate limit pada API routes | Mencegah abuse API | Mudah | `routes/api.php`, `bootstrap/app.php` |
| 11 | **Tambah Logging/Audit Trail** | Tidak ada audit log untuk aksi penting (approve kontrak, bayar, dll) | Traceability untuk aksi kritis | Sedang | Service layer |

### 4.3 Prioritas Rendah

| No | Tugas | Alasan | Manfaat | Estimasi Kompleksitas | Modul Terpengaruh |
|----|-------|--------|---------|----------------------|-------------------|
| 12 | **Sistem Subscription/Billing** | Untuk model SaaS yang sesungguhnya | Monetisasi platform | Kompleks | Billing, Payment |
| 13 | **Multi-Tenant Isolation** | Pemilik hanya bisa lihat data sendiri (sudah ada, tapi bisa diperkuat) | Keamanan data | Sedang | Security |
| 14 | **Konfigurasi Email Production** | Mail driver belum dikonfigurasi untuk production | Notifikasi email berfungsi di production | Mudah | `config/mail.php` |
| 15 | **CDN untuk Static Assets** | Performa loading halaman | Load time lebih cepat | Sedang | Frontend, Performance |
| 16 | **Queue Job Monitoring** | Queue sudah dikonfigurasi (database driver) tapi belum ada monitoring | Visibilitas proses background | Sedang | Queue, Admin |
| 17 | **Backup System** | Belum ada otomasi backup database | Data safety | Sedang | DevOps |

---

## 5. Analisis Komputasi Awan (SaaS)

### 5.1 Identifikasi Implementasi SaaS

Berdasarkan analisis source code, proyek AYOKOS **sudah menerapkan beberapa konsep SaaS** namun belum sepenuhnya SaaS-ready. Berikut analisis mendalam:

| Konsep SaaS | Status | Penjelasan |
|-------------|--------|------------|
| Multi User | ✅ Ya | Satu tabel `users` menampung semua role (admin, pemilik, penghuni) |
| Multi Role | ✅ Ya | Kolom `role` enum pada model User, middleware role-based |
| Shared Infrastructure | ✅ Ya | Satu aplikasi, satu database, satu server untuk semua pengguna |
| Authentication | ✅ Ya | Sanctum SPA + token auth, session-based + token-based |
| Authorization | ⚠️ Parsial | Role-based middleware ada, tapi belum pakai Spatie Permission |
| Self Service | ✅ Ya | Pengguna bisa register, kelola profil, kelola kos sendiri |
| Scalability | ⚠️ Parsial | Horizontal scaling terbatas (belum ada queue worker terpisah, cache belum optimal) |
| Configurability | ⚠️ Parsial | Pengaturan kos ada (denda, toleransi, notifikasi), tapi belum ada configurability per tenant |
| Subscription | ❌ Tidak | Belum ada sistem langganan/billing |
| Tenant Isolation | ❌ Tidak | Tidak ada isolasi data per tenant (semua data di satu database tanpa tenant_id) |
| Centralized Database | ✅ Ya | Satu database untuk seluruh aplikasi |

### 5.2 Bukti Implementasi SaaS

#### 1. Multi-User dan Multi-Role

**File:** `app/Models/User.php`

```php
protected $fillable = ['username', 'password', 'role'];
// role enum: 'admin', 'pemilik', 'penghuni'
```

**File:** `app/Http/Middleware/CheckPemilik.php`

```php
if (Auth::check() && Auth::user()->role !== 'pemilik') {
    return redirect()->route('login')->withErrors([...]);
}
```

**Mengapa ini SaaS:** Satu basis data pengguna mendukung berbagai jenis pengguna dengan hak akses berbeda — ciri khas multi-tenant SaaS.

#### 2. Self-Service Registration

**File:** `app/Services/Auth/AuthService.php`

```php
public function register($data) {
    $user = User::create([...]);
    if ($data['role'] === 'penghuni') {
        Penghuni::create(['user_id' => $user->id, 'status_penghuni' => 'calon']);
    } elseif ($data['role'] === 'pemilik') {
        Pemilik::create(['user_id' => $user->id, 'status_pemilik' => 'pending']);
    }
    Auth::login($user);
}
```

**Mengapa ini SaaS:** Pengguna dapat mendaftar sendiri tanpa intervensi admin — model self-service yang menjadi fondasi SaaS.

#### 3. Shared Infrastructure

**File:** `config/database.php` — satu database untuk seluruh aplikasi
**File:** `config/session.php` — cookie-based sessions untuk semua pengguna
**File:** `config/queue.php` — database queue driver untuk background jobs

**Mengapa ini SaaS:** Seluruh pengguna berbagi infrastruktur yang sama (server, database, queue) — characteristic shared infrastructure SaaS.

#### 4. Role-Based Dashboard

**File:** `resources/views/layouts/partials/dashboard-pemilik.blade.php`
**File:** `resources/views/layouts/partials/dashboard-penghuni.blade.php`
**File:** `resources/views/layouts/partials/dashboard-admin.blade.php`

Setiap role memiliki dashboard terpisah dengan sidebar, statistik, dan akses yang berbeda.

### 5.3 Fitur SaaS yang Sudah Ada

| Fitur SaaS | Status | Bukti pada Source Code | Penjelasan |
|------------|--------|------------------------|------------|
| Multi User | ✅ | `users` table, `User` model | Satu tabel menampung semua pengguna |
| Multi Role | ✅ | `role` column, `CheckPenghuni/Pemilik/Admin` middleware | Role-based access control |
| Shared Infrastructure | ✅ | `config/database.php`, `config/queue.php`, `config/session.php` | Satu server, database, queue |
| Authentication | ✅ | `AuthController`, `LoginController`, Sanctum | Autentikasi ganda (session + token) |
| Authorization | ⚠️ | `CheckPemilik`, `CheckPenghuni`, `CheckAdmin` middleware | Role checking belum granular |
| Self Service | ✅ | `AuthService::register`, `ProfileService` | Pendaftaran dan pengelolaan profil mandiri |
| API Access | ✅ | 82 endpoint RESTful, Sanctum auth | Akses programatik untuk integrasi |
| Notification System | ✅ | 5 service class, 10 template email | Notifikasi in-app + email |

### 5.4 Fitur SaaS yang Belum Ada

| Fitur SaaS | Status | Alasan Penting |
|------------|--------|----------------|
| Subscription Plan | ❌ | Tanpa sistem langganan, tidak ada monetas SaaS. Diperlukan tier (Basic/Premium/VIP) dengan batasan berbeda |
| Tenant Isolation | ❌ | Saat ini semua data pemilik bercampur di satu tabel. Idealnya ada isolasi per pemilik (tenant_id) |
| Billing System | ❌ | Tidak ada otomasi tagihan untuk penggunaan platform |
| Usage Analytics | ❌ | Tidak ada tracking penggunaan resource per tenant |
| Admin SaaS Dashboard | ❌ | Admin dashboard baru menampilkan statistik dasar, belum ada monitoring SaaS |
| Rate Limiting | ❌ | API belum dilindungi rate limiting |
| Audit Log | ❌ | Tidak ada log untuk aksi-aksi penting |
| Backup System | ❌ | Tidak ada otomasi backup |
| Email Service (Production) | ⚠️ | Konfigurasi mail belum diatur untuk production |
| Queue Worker Monitoring | ❌ | Queue driver sudah ada tapi tidak ada monitoring |
| CDN | ❌ | Aset statis belum dikirim via CDN |
| Cache Strategy | ⚠️ | Cache driver `database` sudah dikonfigurasi tapi belum dimanfaatkan secara optimal |

### 5.5 Kesiapan Deploy ke Cloud

| Aspek | Status | Keterangan |
|-------|--------|------------|
| Environment Config | ✅ | `.env` sudah terstruktur dengan benar |
| Database | ✅ | MySQL (production) + SQLite (test) |
| Session | ✅ | Cookie driver (Sanctum SPA compatible) |
| Queue | ⚠️ | Database driver — bisa diganti ke Redis/SQS di cloud |
| Cache | ⚠️ | Database driver — sebaiknya diganti ke Redis/Memcached di cloud |
| Storage | ⚠️ | Public disk — perlu cloud storage (S3, GCS) untuk production |
| Mail | ⚠️ | Perlu konfigurasi SMTP/SES/Mailgun untuk production |
| Logging | ✅ | Stack + daily channels sudah dikonfigurasi |

**Platform Cloud yang Direkomendasikan:**
- **Laravel Cloud** — paling ideal untuk Laravel 12, zero-config deployment
- **Railway** — mudah deploy, mendukung MySQL + queue
- **DigitalOcean** — App Platform atau VPS dengan Forge
- **AWS** — EC2 + RDS + SQS + S3 (paling fleksibel tapi kompleks)

---

## 6. Evaluasi Kualitas Kode

### 6.1 Struktur Project — 8/10

**Kekuatan:**
- Struktur folder terorganisir dengan baik: Controllers terpisah Web/API, Services terpisah per domain, Views terorganisir per role
- Konsisten mengikuti konvensi Laravel 12
- Service Layer terpisah dari Controller — business logic tidak tersebar

**Kelemahan:**
- 5 kelas notifikasi yang overlapping (seharusnya bisa disederhanakan menjadi 1-2)
- Tidak ada `Policies` atau `Gate` untuk authorization — semua di service layer

### 6.2 Clean Code — 7/10

**Kekuatan:**
- Kode konsisten dan terbaca
- Naming yang jelas menggunakan Bahasa Indonesia
- Method-method di service layer terorganisir

**Kelemahan:**
- Duplikasi logic antara 5 notification service
- Beberapa controller melakukan direct model query tanpa service (Admin controllers)
- Tidak ada komentar pada kode kompleks

### 6.3 Readability — 8/10

**Kekuatan:**
- Kode sangat mudah diikuti
- Nama variable dan method deskriptif
- Struktur controller konsisten: validasi → service call → response

**Kelemahan:**
- Beberapa method di AnalisisService cukup panjang dan bisa dipecah
- Kode JavaScript vanilla tanpa struktur module yang konsisten

### 6.4 Naming Convention — 8/10

**Kekuatan:**
- Konsisten pakai Bahasa Indonesia untuk nama model, kolom, dan method
- Snake_case untuk kolom database, camelCase untuk method PHP
- File naming konsisten: `PemilikKosController`, `KosService`, `KamarFactory`

**Kelemahan:**
- Ketidakcocokan kolom `jumlah_bayar` vs `jumlah` pada admin dashboard
- Beberapa migration file naming kurang konsisten

### 6.5 Security — 7/10

**Kekuatan:**
- Sanctum auth (session + token)
- Role-based middleware
- Ownership check di service layer (pemilik hanya akses data sendiri)
- Password hashing otomatis
- Validation semua input via FormRequest

**Kelemahan:**
- Tidak ada rate limiting pada API routes
- Tidak ada CSRF protection yang eksplisit untuk API routes (mengandalkan Sanctum SPA)
- File upload validation belum ketat (hanya mengecek `image` type)
- Tidak ada audit trail untuk aksi sensitif

### 6.6 Authentication — 8/10

**Kekuatan:**
- Dual auth: session-based (web) + token-based (API/mobile)
- Sanctum SPA middleware (`EnsureFrontendRequestsAreStateful`) aktif
- Role-based redirect setelah login
- `RedirectIfAuthenticated` middleware role-aware

**Kelemahan:**
- Guard check tidak konsisten (ada `auth('penghuni')` di beberapa tempat vs `auth()` di tempat lain)
- Tidak ada email verification
- Tidak ada password reset

### 6.7 Authorization — 7/10

**Kekuatan:**
- Ownership check di service layer (pemilik hanya lihat own data)
- Role-based middleware mencegah akses halaman yang salah
- `canReview()` check memastikan hanya penghuni yang pernah menyewa yang bisa review

**Kelemahan:**
- Tidak menggunakan `Policies` atau `Gate` Laravel
- Authorization logic tersebar di service layer, bukan terpusat
- Tidak ada spatie/laravel-permission (tabel sudah ada tapi unused)

### 6.8 Validasi — 8/10

**Kekuatan:**
- 18 FormRequest class terpusat
- Validasi terorganisir: Auth, Pemilik, Penghuni, Profile
- Custom validation messages dalam Bahasa Indonesia

**Kelemahan:**
- Beberapa controller masih inline validation (Admin controllers)
- `ExtendKontrakRequest` belum ada

### 6.9 Error Handling — 7/10

**Kekuatan:**
- JSON error responses terkonfigurasi di `bootstrap/app.php`
- Handle: ValidationException (422), AuthException (401), AuthorizationException (403), NotFound (404), RateLimit (429)
- AJAX error handler di `notifications.js` mapping HTTP status ke pesan user-friendly

**Kelemahan:**
- Tidak ada global exception handler untuk semua case
- Beberapa service method tidak try-catch (mengandalkan DB transaction rollback)
- Tidak ada structured error logging

### 6.10 Database Design — 8/10

**Kekuatan:**
- Relasi jelas dengan foreign key cascade
- Unique constraint pada kolom penting (nomor_kamar per kos, username)
- Enum values terdefinisi di migrasi
- Index pada kolom yang sering di-query

**Kelemahan:**
- Duplikasi migrasi notifications (2 file)
- Migrasi `pengaturan_kos` hilang
- Tidak ada soft delete pada model penting (Kos, Kontrak, Pembayaran)

### 6.11 Optimasi Query — 6/10

**Kekuatan:**
- Scope aktif pada model Kos, KontrakSewa, Pembayaran
- Eager loading pada beberapa controller

**Kelemahan:**
- N+1 query di beberapa tempat (misal: loop kamar tanpa eager load fasilitas)
- Beberapa analisis query kompleks tanpa caching
- Subselect untuk harga minimum dan jumlah kamar tersedia bisa dioptimasi

### 6.12 Performance — 6/10

**Kekuatan:**
- Pagination digunakan secara konsisten
- File storage di public disk (cepat)

**Kelemahan:**
- Cache belum dimanfaatkan (driver database ada tapi jarang dipakai)
- Tidak ada CDN untuk aset statis
- Chart.js dan jsPDF dimuat dari CDN tanpa fallback
- Image optimization belum ada (no resize/compress saat upload)

### 6.13 Scalability — 5/10

**Kekuatan:**
- Queue driver sudah dikonfigurasi (database)
- Service layer memudahkan refactoring

**Kelemahan:**
- Tidak ada multi-tenant architecture sebenarnya
- Session driver cookie — sulit scale horizontal
- Database single-server — tidak ada read replica
- Tidak ada queue worker terpisah

### 6.14 Maintainability — 7/10

**Kekuatan:**
- Service layer terorganisir dan terpisah dari controller
- FormRequest validation terpusat
- Konsisten dalam pattern dan naming

**Kelemahan:**
- 5 notification service yang overlapping — confusing untuk developer baru
- Tidak ada documentation (README kosong)
- Tidak ada API documentation (Swagger/OpenAPI)

### Ringkasan Penilaian

| Aspek | Skor |
|-------|------|
| Struktur Project | 8/10 |
| Clean Code | 7/10 |
| Readability | 8/10 |
| Naming Convention | 8/10 |
| Security | 7/10 |
| Authentication | 8/10 |
| Authorization | 7/10 |
| Validasi | 8/10 |
| Error Handling | 7/10 |
| Database Design | 8/10 |
| Optimasi Query | 6/10 |
| Performance | 6/10 |
| Scalability | 5/10 |
| Maintainability | 7/10 |
| **Rata-rata** | **7.1/10** |

---

## 7. Kesimpulan

### Yang Sudah Selesai

Proyek AYOKOS memiliki **fitur inti yang sudah berfungsi dengan baik** (~80% dari total fitur yang direncanakan):

- ✅ **Autentikasi & Otorisasi** — Login, register, logout dengan role-based access (admin, pemilik, penghuni)
- ✅ **Manajemen Kos** — CRUD lengkap dengan foto, fasilitas, pengaturan, dan pencarian lanjutan
- ✅ **Manajemen Kamar** — CRUD dengan foto, status, dan uniqueness check
- ✅ **Lifecycle Kontrak** — Penghuni buat → Pemilik setujui/tolak → Selesai
- ✅ **Lifecycle Pembayaran** — Penghuni bayar → Upload bukti → Pemilik verifikasi
- ✅ **Sistem Ulasan** — Review dengan rating, foto, dan eligibility check
- ✅ **Dashboard & Analisis** — Chart.js grafik + export PDF untuk pemilik dan penghuni
- ✅ **Notifikasi** — Dual-channel (in-app + email) dengan 10 template
- ✅ **Halaman Publik** — Homepage, pencarian, detail, peta interaktif, about, howto, terms, privacy
- ✅ **API RESTful** — 82 endpoint dengan Sanctum auth
- ✅ **Pengujian** — 8 test file (feature + unit)

### Yang Sedang Dikerjakan

- ⚠️ **Admin Web Dashboard** — Controller dan view sudah ada, tapi route belum ditambahkan di `web.php`
- ⚠️ **Admin CRUD Views** — Sidebar sudah ada, tapi view untuk manajemen data belum diimplementasikan
- ⚠️ **Penghuni Analisis Spending** — Versi Web belum lengkap (hanya redirect)
- ⚠️ **Perbaikan Bug** — Duplikasi migrasi, migrasi `pengaturan_kos` hilang, kolom `jumlah_bayar` vs `jumlah`

### Yang Harus Dikerjakan Selanjutnya

**Prioritas Tinggi:**
1. Tambahkan route admin di `web.php`
2. Buat view admin CRUD (data penghuni, pemilik, kontrak, pembayaran)
3. Perbaiki duplikasi migrasi notifications
4. Buat migrasi `pengaturan_kos`
5. Perbaiki kolom `jumlah_bayar` → `jumlah`
6. Lengkapi analisis spending versi Web

**Prioritas Sedang:**
7. Buat `ExtendKontrakRequest`
8. Aktifkan Spatie Permission
9. Tambah test coverage
10. Tambah rate limiting API
11. Tambah audit trail/logging

**Prioritas Rendah:**
12. Sistem subscription/billing
13. Multi-tenant isolation
14. Konfigurasi email production
15. CDN untuk static assets
16. Queue job monitoring
17. Backup system

### Implementasi SaaS

Proyek AYOKOS **sudah menerapkan konsep SaaS secara parsial**:
- ✅ Multi-user, multi-role, shared infrastructure, self-service, authentication, API access
- ⚠️ Authorization (belum granular), scalability (terbatas), configurability (basic)
- ❌ Subscription, tenant isolation, billing, rate limiting, audit log

**Untuk menjadi SaaS sesungguhnya**, fitur yang paling kritis untuk ditambahkan adalah **sistem subscription/billing** dan **tenant isolation**.

### Tingkat Kesiapan Proyek

**Estimasi Penyelesaian: ~75-80%**

**Alasan:**
- Fitur inti (auth, CRUD, pembayaran, kontrak, ulasan, notifikasi, dashboard, analisis) sudah berfungsi
- Admin web belum lengkap (route + views)
- Bug-bug kecil perlu diperbaiki (migrasi duplikat, kolom salah)
- Fitur SaaS lanjutan (subscription, tenant isolation) belum ada
- Infrastructure production (email, cache, queue, CDN) belum dioptimasi

**Dengan penambahan admin web views dan perbaikan bug yang ada, proyek dapat mencapai ~85-90% kesiapan untuk deployment MVP.**

---

*Dokumen ini disusun berdasarkan analisis seluruh source code AYOKOS per tanggal 1 Juli 2026.*
