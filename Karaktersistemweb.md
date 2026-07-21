# KARAKTER SISTEM WEB — AyoKos

> Hasil audit menyeluruh terhadap project Laravel 12 AyoKos  
> Tanggal: Juli 2026  
> Auditor: Senior Software Architect

---

## 1. ARSITEKTUR PROJECT

### Pola yang Digunakan
- **MVC** — Laravel standar (Controller → Model → View)
- **Service Layer** — 14 service class di `app/Services/` (9 folder)
- **FormRequest** — 19 centralized validation class
- **Sanctum Auth** — Dual auth (Web session + API token)
- **Role-Based Access** — Middleware `penghuni`, `pemilik`, `admin`
- **Monolith** — Single codebase, bukan microservice

### Struktur Direktori Utama
```
app/
├── Console/Commands/          (3 file)
├── Events/                    (1 file)
├── Http/
│   ├── Controllers/
│   │   ├── API/              (26 controller)
│   │   │   ├── Admin/        (6)
│   │   │   ├── Auth/         (1)
│   │   │   ├── Pemilik/      (11)
│   │   │   ├── Penghuni/     (6)
│   │   │   └── Public/       (5)
│   │   └── Web/              (19 controller)
│   │       ├── Admin/        (1)
│   │       ├── Auth/         (2)
│   │       ├── Pemilik/      (7)
│   │       ├── Penghuni/     (5)
│   │       └── Public/       (3)
│   ├── Middleware/            (5 file)
│   └── Requests/             (19 file)
├── Listeners/                 (1 file)
├── Mail/                      (9 file)
├── Models/                    (14 file)
├── Policies/                  (1 file)
├── Providers/                 (1 file)
└── Services/                  (14 file)
    ├── Analisis/
    ├── Auth/
    ├── Kamar/
    ├── Kontrak/
    ├── Kos/
    ├── Notification/         (5 file)
    ├── Pembayaran/
    ├── Profile/
    └── Review/

database/
├── migrations/               (21 file)
├── factories/                (10 file)
└── seeders/                  (9 file)

routes/
├── web.php                   (218 baris)
├── api.php                   (197 baris)
└── console.php               (8 baris)

resources/
├── views/                    (55 blade file)
│   ├── admin/                (1)
│   ├── auth/                 (2)
│   ├── layouts/              (4)
│   ├── notifications/        (1)
│   ├── pemilik/              (14)
│   ├── penghuni/             (13)
│   ├── public/               (7)
│   └── emails/               (10)
├── js/                       (21 file)
└── css/                      (5 file)

tests/                        (8 file)
├── Feature/Api/              (4)
└── Unit/Services/            (3)
```

---

## 2. DAFTAR FITUR

| Fitur | Status | Lokasi |
|-------|--------|--------|
| Registrasi User (penghuni/pemilik) | ✅ | `AuthController`, `RegisterRequest` |
| Login (Web + API) | ✅ | `LoginController`, `AuthController` |
| Logout | ✅ | `LoginController`, `AuthController` |
| Role: admin, pemilik, penghuni | ✅ | `CheckPenghuni`, `CheckPemilik`, `CheckAdmin` middleware |
| Public browsing kos (filter, search) | ✅ | `Public/KosController`, `KosService` |
| Peta interaktif kos (Leaflet) | ✅ | `resources/views/public/kos/peta.blade.php` |
| Detail kos (fasilitas, kamar, review) | ✅ | `PublicController@kosShow` |
| Dashboard Admin (statistik) | ✅ | `Admin/DashboardController` |
| CRUD Kos (Pemilik) | ✅ | `PemilikKosController`, `KosService` |
| CRUD Kamar (Pemilik) | ✅ | `PemilikKamarController`, `KamarService` |
| Manajemen Foto Kos | ✅ | `FotoKosController`, `FotoKosService` |
| Manajemen Fasilitas Kos | ✅ | `KosFasilitasController` |
| Pengaturan Kos (denda, toleransi) | ✅ | `PengaturanKosController` |
| Pengajuan Kontrak Sewa | ✅ | `PenghuniKontrakController`, `KontrakService` |
| Approve/Reject Kontrak (Pemilik) | ✅ | `PemilikKontrakController` |
| Pembayaran (upload bukti) | ✅ | `PenghuniPembayaranController` |
| Approve/Reject Pembayaran | ✅ | `PemilikPembayaranController` |
| Review & Rating Kos | ✅ | `PenghuniReviewController`, `ReviewService` |
| Notifikasi In-App | ✅ | `NotificationController`, `NotificationService` |
| Notifikasi Email | ✅ | 10 email template + `NotificationEmailService` |
| Dashboard Pemilik (stats, chart) | ✅ | `PemilikDashboardController`, `AnalisisService` |
| Dashboard Penghuni (progress kontrak) | ✅ | `PenghuniDashboardController` |
| Analisis Pemilik (chart pendapatan) | ✅ | `PemilikAnalisisController`, `charts.js` |
| Analisis Penghuni (spending) | ✅ | `PenghuniAnalisisController`, `charts-penghuni.js` |
| CRUD Admin (users, pemilik, penghuni) | ✅ | `API/Admin/` controllers |
| Payment Callback Webhook | ⚠️ | Simulasi saja (`simulatePayment`) |
| Export PDF | ✅ | `barryvdh/laravel-dompdf` package |
| Map Picker (Lokasi Kos) | ✅ | `map-picker.js` (Leaflet + Nominatim) |

---

## 3. ANALISIS DATABASE

### Daftar Tabel (20 unique)

| # | Tabel | PK | FK | Unique | Soft Delete |
|---|-------|----|----|--------|-------------|
| 1 | `users` | `id` | - | `username` | ❌ |
| 2 | `sessions` | `id` | `user_id → users.id` (SET NULL) | - | ❌ |
| 3 | `cache` | `key` | - | - | ❌ |
| 4 | `cache_locks` | `key` | - | - | ❌ |
| 5 | `jobs` | `id` | - | - | ❌ |
| 6 | `job_batches` | `id` | - | - | ❌ |
| 7 | `failed_jobs` | `id` | - | `uuid` | ❌ |
| 8 | `pemilik` | `id_pemilik` | `user_id → users.id` CASCADE | - | ❌ |
| 9 | `penghuni` | `id_penghuni` | `user_id → users.id` CASCADE | - | ❌ |
| 10 | `admin` | `id_admin` | `user_id → users.id` CASCADE | - | ❌ |
| 11 | `kos` | `id_kos` | `id_pemilik → pemilik` CASCADE | - | ❌ |
| 12 | `fasilitas` | `id_fasilitas` | - | `nama_fasilitas` | ❌ |
| 13 | `kamar` | `id_kamar` | `id_kos → kos` CASCADE | `(id_kos, nomor_kamar)` | ❌ |
| 14 | `kos_fasilitas` | `id_kos_fasilitas` | 2 FK ke kos & fasilitas CASCADE | `(id_kos, id_fasilitas)` | ❌ |
| 15 | `kontrak_sewa` | `id_kontrak` | 3 FK (penghuni, kos, kamar) CASCADE | - | ❌ |
| 16 | `pembayaran` | `id_pembayaran` | 2 FK (kontrak, penghuni) CASCADE | - | ❌ |
| 17 | `reviews` | `id_review` | 3 FK (kos, penghuni, kontrak) CASCADE | - | ❌ |
| 18 | `notifications` | `id_notifikasi` (UUID) | `id_user → users.id` CASCADE | - | ❌ |
| 19 | `personal_access_tokens` | `id` | - (polymorphic) | `token` | ❌ |
| 20 | `permissions/roles` (Spatie) | `id` | Standar Spatie | `(name, guard_name)` | ❌ |

### Relasi Utama
```
User (1) ── (1) Pemilik / Penghuni / Admin
Pemilik (1) ── (N) Kos
Kos (1) ── (N) Kamar
Kos (1) ── (N) KontrakSewa
Kos (1) ── (N) Review
Kos (N) ── (N) Fasilitas (via kos_fasilitas)
Kamar (1) ── (N) KontrakSewa
Penghuni (1) ── (N) KontrakSewa
Penghuni (1) ── (N) Pembayaran
Penghuni (1) ── (N) Review
KontrakSewa (1) ── (N) Pembayaran
KontrakSewa (1) ── (N) Review
```

### Masalah Database
| Masalah | Detail | Prioritas |
|---------|--------|-----------|
| ❌ **Missing migration** | Tabel `foto_kos` & `pengaturan_kos` tidak memiliki migration file | **Critical** |
| ❌ **Tidak ada soft delete** | Semua tabel — data hilang permanen saat `delete()` | **High** |
| ⚠️ **Kurang index** | Tidak ada index pada kolom pencarian (`kota`, `kecamatan`, `status_kontrak`, `bulan_tahun`) | **Medium** |
| ⚠️ **Tidak ada cascade update** | Semua FK hanya ON DELETE CASCADE, tanpa ON UPDATE | **Low** |

---

## 4. ANALISIS BACKEND

### Authentication
| Aspek | Status | Detail |
|-------|--------|--------|
| Login Web | ✅ | Session-based `web` guard |
| Login API | ✅ | Sanctum token-based |
| Register | ✅ | Dual role (penghuni/pemilik) via `AuthService` |
| Logout | ✅ | Session invalidate + token revoke |
| Password Reset | ❌ | **Tidak ada fitur lupa password / reset password** |
| Email Verification | ❌ | **Tidak ada verifikasi email** |
| Remember Me | ✅ | Opsional di login |

### Authorization
| Aspek | Status | Detail |
|-------|--------|--------|
| Role Middleware | ✅ | `CheckPemilik`, `CheckPenghuni`, `CheckAdmin` |
| Policy | ❌ | `KosanPolicy` rusak (pakai model salah) dan tidak digunakan |
| Gate | ❌ | Tidak ada Gate definitions |
| Ownership Check | ⚠️ | Manual di controller (e.g., `$pemilik->id_pemilik`) |

### Validation
| Aspek | Status | Detail |
|-------|--------|--------|
| FormRequest | ✅ | 19 class centralized |
| Unique Validation | ✅ | `unique:table,column,except,id` pattern |
| Custom Messages | ⚠️ | Hanya di `RegisterRequest` |
| Array Validation | ⚠️ | `fasilitas.*` validasi ada |
| Image Validation | ✅ | `image|mimes:jpeg,png,jpg|max:2048` |

### Error Handling
| Aspek | Status | Detail |
|-------|--------|--------|
| API Exception Handler | ✅ | Di `bootstrap/app.php` (JSON responses) |
| Web Exception Handler | ✅ | Laravel default |
| Custom Exceptions | ❌ | Tidak ada custom exception class |
| Logging | ✅ | Log channel `stack` → `single` |
| Graceful Failure | ⚠️ | Try-catch dengan return generic error |

---

## 5. ANALISIS FRONTEND

### Blade Templates (55 file)
| Aspek | Status | Detail |
|-------|--------|--------|
| Layout System | ✅ | `layouts.app` extended by all views |
| Component Reusability | ⚠️ | Sidebar partials, tapi banyak duplikasi HTML |
| Role-Specific Views | ✅ | `pemilik/`, `penghuni/`, `admin/` terpisah |
| Email Templates | ✅ | 10 file lengkap |

### CSS (5 file)
| Aspek | Status | Detail |
|-------|--------|--------|
| Tailwind v4 | ✅ | `@import 'tailwindcss'` |
| Custom Utilities | ✅ | `shadow-hard`, `shadow-hard-lg`, dll |
| Neobrutalism Theme | ✅ | Hitam-kuning konsisten |
| Responsive | ✅ | Mobile breakpoints di 640px, 768px, 1024px |
| **Duplikasi** | ⚠️ | `pemilik.css` duplikasi ~300 baris identik (create/edit) |

### JavaScript (21 file)

| Modul | File | Fungsi |
|-------|------|--------|
| Core | `app.js`, `init.js` | Init modal, file preview, auto-dismiss |
| API Client | `api-client.js` | Axios + CSRF + Bearer token + retry |
| AJAX Forms | `ajax-form.js` | `data-ajax="true"` handler |
| Notifications | `notifications.js` | Toast + error handler |
| Auth | `login-form.js`, `register-form.js` | Multi-step register |
| Charts | `charts.js`, `charts-penghuni.js` | Chart.js dashboard |
| Map | `map-picker.js` | Leaflet + Nominatim autocomplete |
| Pembayaran | `payment-form.js` | Payment option calculator |
| Review | `star-rating.js` | Star rating widget |
| Kontrak | `create-form.js`, `kontrak-modal.js`, `kontrak-tabs.js` | Contract forms |
| Profile | `photo-upload.js` | Preview before upload |
| UI | `searchable-select.js` | Searchable dropdowns |

---

## 6. ANALISIS DETAIL PER ASPEK

### 6.1 Security
| Sub-aspek | Status | Bukti |
|-----------|--------|-------|
| ✅ Authentication | OK | `AuthService::login()`, `Auth::guard('web')` |
| ✅ Authorization (RBAC) | OK | 3 middleware + role column |
| ✅ Validation | OK | 19 FormRequest |
| ✅ CSRF | OK | Sanctum SPA middleware active |
| ✅ XSS Protection | OK | Blade auto-escape |
| ✅ SQL Injection | OK | Eloquent ORM |
| ✅ Password Hashing | OK | `Hash::make()`, cast `'hashed'` |
| ⚠️ HTTPS Ready | Sebagian | Config ada, `SESSION_SECURE_COOKIE` tidak di-set |
| ⚠️ Rate Limiting | Sebagian | Hanya API group (`ThrottleRequests::class.':api'`) |
| ⚠️ File Upload | OK | Validasi mimes + max size |
| ✅ Mass Assignment | OK | `$fillable` di semua model |
| ❌ Policy/Gate | Tidak | `KosanPolicy` rusak, tidak digunakan |
| ❌ Security Headers | Tidak | HSTS, CSP, X-Frame-Options tidak ada |
| ⚠️ Environment | Sebagian | `.env.example` tidak ada |

**Risiko:** Password SMTP di `.env` (hardcoded & ter-commit). Web routes tanpa rate limiting.

---

### 6.2 Performance
| Sub-aspek | Status | Detail |
|-----------|--------|--------|
| ✅ Eager Loading | OK | `with()` digunakan |
| ✅ Pagination | OK | `paginate()` konsisten |
| ✅ Queue | OK | `database` driver |
| ⚠️ N+1 Query | Sebagian | Beberapa controller akses relasi tanpa eager load |
| ❌ Caching | Tidak | Tidak ada `Cache::remember()` satupun |
| ❌ Redis | Tidak | Config ada, tidak terpakai |
| ❌ Index Database | Tidak | Kolom pencarian (`kota`, `kecamatan`) tidak di-index |
| ❌ Image Optimization | Tidak | Upload langsung simpan, tidak ada thumbnail |

---

### 6.3 Maintainability
| Sub-aspek | Status | Detail |
|-----------|--------|--------|
| ✅ Folder Structure | OK | Hierarki jelas |
| ✅ Naming Convention | OK | Indonesian snake_case |
| ✅ Service Layer | OK | 14 service class |
| ✅ SOLID (SRP) | OK | Service memiliki tanggung jawab jelas |
| ✅ PSR-12 | OK | Laravel Pint |
| ⚠️ DRY | Sebagian | CSS duplikasi, blade partials belum optimal |
| ⚠️ SOLID (OCP) | Sebagian | Payment gateway hardcoded |
| ❌ Repository | Tidak | Tidak ada |
| ❌ Documentation | Tidak | Minimal PHPDoc |

---

### 6.4 Testability
| Sub-aspek | Status | Detail |
|-----------|--------|--------|
| ⚠️ Unit Test | 3 file | `ProfileServiceTest`, `KosServiceTest`, `AnalisisServiceTest` |
| ⚠️ Feature Test | 4 file | `AuthTest`, `KosTest`, `KontrakTest`, `PembayaranTest` |
| ❌ Integration | Tidak | Tidak ada |
| ❌ Coverage | <10% | Dari ~150 class, hanya 7 di-test |

---

## 7. DAFTAR ERROR / BUG DITEMUKAN

| # | Severity | Lokasi | Masalah | Dampak |
|---|----------|--------|---------|--------|
| 1 | 🔴 **Critical** | `app/Console/Kernel.php:14` | `$commands` register `SendContractReminders` (tidak ada) | Scheduler error, artisan error |
| 2 | 🔴 **Critical** | `database/migrations/` | Tidak ada migration untuk tabel `foto_kos` & `pengaturan_kos` | Migration error di environment baru |
| 3 | 🔴 **High** | `.env` | Password SMTP hardcoded (`MAIL_PASSWORD="..."`) | **Security breach** - credential terekspos |
| 4 | 🔴 **High** | `app/Http/Controllers/Web/Admin/DashboardController.php:25` | `$stats['total_pembayaran_bulan_ini']` pakai `jumlah_bayar` (kolom tidak ada) | Error 500 di admin dashboard |
| 5 | 🔴 **High** | `app/Policies/KosanPolicy.php` | Parameter model `Penghuni` (bukan `User`), model `kosan` tidak ada | Policy tidak pernah berfungsi |
| 6 | 🔴 **High** | `app/Listeners/SendOrderCreatedNotification.php` | Reference `OrderCreated` event (tidak ada) | Listener tidak pernah terpanggil |
| 7 | 🟡 **Medium** | `app/Services/Notification/PembayaranNotificationService.php` | Di-register sebagai singleton di `AppServiceProvider` | Potensi memory leak |
| 8 | 🟡 **Medium** | `routes/web.php` | Route `pemilik.kontrak.destroy` adalah DELETE, tapi form mungkin POST | Method mismatch |
| 9 | 🟡 **Medium** | `resources/css/pages/pemilik.css` | ~300 baris CSS duplikasi (create/edit identik) | Maintenance burden |
| 10 | 🟢 **Low** | `app/Providers/AppServiceProvider.php:9` | Import `KontrakNotificationService` tidak terpakai | Code smell |

---

## 8. SKOR AKHIR

| Aspek | Skor |
|-------|------|
| Security | 70/100 |
| Performance | 50/100 |
| Scalability | 55/100 |
| Availability | 45/100 |
| Reliability | 65/100 |
| Maintainability | 75/100 |
| Extensibility | 75/100 |
| Usability | 80/100 |
| Accessibility | 40/100 |
| Compatibility | 80/100 |
| Portability | 50/100 |
| Interoperability | 60/100 |
| Observability | 40/100 |
| Testability | 35/100 |
| Data Integrity | 70/100 |
| Data Privacy | 65/100 |
| Backup & Recovery | 20/100 |
| Fault Tolerance | 40/100 |
| Auditability | 45/100 |
| Compliance | 65/100 |

---

## 9. KEKUATAN UTAMA

1. **Service Layer terstruktur** — Separation of concerns terjaga baik dengan 14 service class
2. **Dual auth (Web + API)** — Sanctum SPA + token-based auth bekerja optimal
3. **FormRequest validation** — 19 class centralized, DRY untuk validasi
4. **Role-based middleware** — 3 role (admin, pemilik, penghuni) terdefinisi jelas
5. **Neobrutalism UI konsisten** — Desain hitam-kuning dengan Tailwind CSS v4
6. **AJAX-first forms** — `data-ajax="true"` pattern untuk seamless UX
7. **Notifikasi dual channel** — In-app + email coverage lengkap
8. **Database transactions** — Digunakan di approve/reject kontrak & pembayaran
9. **Error handling API** — Centralized exception handler di `bootstrap/app.php`
10. **Map integration** — Leaflet + Nominatim untuk pencarian lokasi

---

## 10. KELEMAHAN UTAMA (Prioritas Perbaikan)

| Prioritas | Masalah | Solusi |
|-----------|---------|--------|
| 🔴 **Critical** | `Console/Kernel` panggil command tidak ada | Hapus `SendContractReminders` dari `$commands`, ganti dengan `SendEmailNotifications` |
| 🔴 **Critical** | Missing migration `foto_kos` & `pengaturan_kos` | Buat migration file baru |
| 🔴 **High** | Password SMTP di `.env` committed | Hapus dari git, gunakan env variable, regenerate key |
| 🔴 **High** | Admin dashboard error (`jumlah_bayar`) | Ganti `jumlah_bayar` → `jumlah` |
| 🟡 **High** | Tidak ada caching | Implement `Cache::remember()` untuk query berat dashboard |
| 🟡 **High** | Rate limiting hanya di API | Tambahkan throttle ke web routes (login, register) |
| 🟡 **High** | Tidak ada soft delete | Tambahkan `softDeletes()` ke semua business table |
| 🟡 **Medium** | Coverage test rendah | Tambah test untuk edge cases (reject, error, authorization) |
| 🟡 **Medium** | Tidak ada `.env.example` | Buat `.env.example` dari `.env` (tanpa secret) |
| 🟢 **Medium** | CSS duplikasi | Ekstrak shared styles ke file terpisah |
| 🟢 **Low** | Tidak ada email verification | Tambahkan `MustVerifyEmail` |

---

## 11. STATISTIK PROYEK

| Metrik | Nilai |
|--------|-------|
| Total File | ~236 |
| PHP Files | ~100 |
| Blade Templates | 55 |
| JavaScript Files | 21 |
| CSS Files | 5 |
| Migration Files | 21 |
| Test Files | 8 |
| Routes (web) | ~35 |
| Routes (api) | ~60 |
| Packages (composer) | ~10 |
| Packages (npm) | ~12 |
