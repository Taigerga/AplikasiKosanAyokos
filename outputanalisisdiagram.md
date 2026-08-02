# ANALISIS SKPL DAN DDPL — AyoKos

## A. Ringkasan Proyek

**AyoKos** adalah platform manajemen kos berbasis web yang menghubungkan tiga aktor: **Admin** (pengelola platform), **Pemilik** (pemilik kos), dan **Penghuni** (penyewa). Sistem mencakup pencarian kos, pengajuan dan pengelolaan kontrak sewa, pembayaran dengan bagi hasil (90% pemilik / 10% platform), sistem review dan rating, dashboard analitik, sistem aduan/pengaduan, notifikasi in-app & email, serta peta interaktif.

---

## B. Teknologi dan Stack

| Komponen | Teknologi | Versi/Bukti |
|---|---|---|
| **Framework** | Laravel | 12.x (`"laravel/framework": "^12.0"`) |
| **PHP** | PHP | ^8.2 (`composer.json`) |
| **Database** | MySQL (development), SQLite (testing) | `config/database.php` |
| **Frontend** | Blade + Tailwind CSS v4 + Vite 7 | `package.json`, `vite.config.js` |
| **CSS Framework** | Tailwind CSS | v4 (`app.css` — `@import "tailwindcss"`) |
| **Icons** | Font Awesome 6 | `@fortawesome/fontawesome-free` |
| **Auth API** | Laravel Sanctum | v4.3 (`"laravel/sanctum": "^4.3"`) |
| **JavaScript** | Vanilla JS + Axios + Chart.js + Leaflet + jsPDF + html2canvas | `package.json` |
| **Maps** | Leaflet.js + OpenStreetMap + Nominatim + Overpass API | `map-picker.js` |
| **Charts** | Chart.js | v4 (via CDN) |
| **PDF Export** | jsPDF + html2canvas | `modules/analisis/pdf-export.js` |
| **DOM PDF** | barryvdh/laravel-dompdf | `"barryvdh/laravel-dompdf": "^3.1"` |
| **Queue** | Database driver | `config/queue.php`, `.env QUEUE_CONNECTION=database` |
| **Cache** | Database driver | `config/cache.php`, `.env CACHE_STORE=database` |
| **Session** | Cookie driver, encrypted, same_site=strict | `config/session.php`, `.env SESSION_DRIVER=cookie` |
| **Mail** | SMTP Gmail | `.env MAIL_MAILER=smtp` |
| **Payment Gateway** | Xendit (terintegrasi) | `config/services.php`, `PaymentCallbackController` |
| **Web Server** | Laragon (development) | `.env APP_URL=http://localhost` |
| **Code Style** | Laravel Pint (PSR-12) | `composer.json` require-dev |

---

## C. Role / Stakeholder

Berdasarkan source code (model `User`, middleware, routes, views), terdapat **3 aktor**:

1. **Admin** — `role = 'admin'` — Model `Admin` (tabel `admin`). Mengelola platform secara keseluruhan.
2. **Pemilik** — `role = 'pemilik'` — Model `Pemilik` (tabel `pemilik`). Pemilik/pengelola kos.
3. **Penghuni** — `role = 'penghuni'` — Model `Penghuni` (tabel `penghuni`). Penyewa kamar kos.

Selain itu terdapat **Pengunjung (Guest)** — belum login, dapat browsing publik.

---

## D. SKPL

### D.1 Kebutuhan Fungsional

#### D.1.1 Guest / Publik (Belum Login)

| # | Kebutuhan Fungsional | Route/Bukti | Controller | Service |
|---|---|---|---|---|
| GF-01 | Pengunjung dapat melihat halaman utama/home | `GET /` (web: `public.home`) | `Web\Public\HomeController::index` | `KosService::getRecommendedKos` |
| GF-02 | Pengunjung dapat mencari kos dengan filter | `GET /kos` (web), `GET api/public/kos` | `KosController::index` (API) | `KosService::getPublicKosWithFilters` |
| GF-03 | Pengunjung dapat melihat detail kos | `GET /kos/{id}` (web), `GET api/public/kos/{id}` | `KosController::show` (API) | `KosService::getPublicKosDetail` |
| GF-04 | Pengunjung dapat melihat peta kos interaktif | `GET /peta` (web), `GET api/public/peta` | `KosController::peta` (API) | `KosService::getKosForMap` |
| GF-05 | Pengunjung dapat melihat halaman About, How-to, Terms, Privacy | `GET /pages/about`, `/how-to`, `/terms`, `/privacy` | `PageController` | — |
| GF-06 | Pengunjung dapat mendaftar akun (penghuni/pemilik) | `POST /register` (web), `POST api/auth/register`, `api/auth/register/penghuni`, `api/auth/register/pemilik` | `Auth\AuthController::register` | `Auth\AuthService::register` |
| GF-07 | Pengunjung dapat login | `POST /login` (web), `POST api/auth/login` | `LoginController::login`, `AuthController::login` | `Auth\AuthService::login` |
| GF-08 | Pengunjung dapat meminta reset password | `GET/POST /forgot-password`, `POST api/auth/forgot-password` | `ForgotPasswordController`, `AuthController::sendResetLink` | `Auth\AuthService::sendPasswordReset` |
| GF-09 | Pengunjung dapat mereset password | `GET/POST /reset-password/{token}`, `POST api/auth/reset-password` | `ResetPasswordController`, `AuthController::resetPassword` | `Auth\AuthService::resetPassword` |
| GF-10 | Pengunjung dapat melihat dan mencari review publik | `GET api/reviews` | `API\Public\ReviewController::indexByKos` | `ReviewService::listByKos` |
| GF-11 | Pengunjung dapat melihat fasilitas yang tersedia | `GET api/fasilitas` | `API\Public\FasilitasController::index` | — |
| GF-12 | Pengunjung dapat melihat data wilayah (provinsi, kota, kecamatan, kelurahan) | `GET api/public/provinces`, `/cities`, `/districts`, `/villages` | `API\Public\PublicController` | — |

**Bukti implementasi untuk GF-01 s.d GF-05:** `routes/web.php:12-24`, `routes/api.php:33-43`, `resources/views/public/` (8 file view).

#### D.1.2 Penghuni

| # | Kebutuhan Fungsional | Route/Bukti | Controller | Service |
|---|---|---|---|---|
| GF-13 | Penghuni dapat melihat dashboard | `GET /penghuni/dashboard` | `Web\Penghuni\DashboardController::index` | `AnalisisService::getPenghuniDashboardStats` |
| GF-14 | Penghuni dapat mencari kos | `GET /penghuni/cari-kos` | `Web\Penghuni\KontrakController::cariKos` | — |
| GF-15 | Penghuni dapat mengajukan kontrak sewa baru | `GET/POST /penghuni/kontrak/create/{kosId}` | `PenghuniKontrakController::create/store` | `KontrakService::createKontrak` |
| GF-16 | Penghuni dapat melihat daftar kontrak | `GET /penghuni/kontrak` | `PenghuniKontrakController::index` | `KontrakService::getPenghuniKontrak` |
| GF-17 | Penghuni dapat melihat detail kontrak | `GET /penghuni/kontrak/{id}` | `PenghuniKontrakController::show` | `KontrakService::getPenghuniKontrakDetail` |
| GF-18 | Penghuni dapat melihat notifikasi tenggat kontrak | `GET /penghuni/kontrak/notifikasi-tenggat` | `PenghuniKontrakController::notifikasiTenggat` | `KontrakService::getNotifikasiTenggat` |
| GF-19 | Penghuni dapat melakukan pembayaran | `GET/POST /penghuni/pembayaran/create` | `Web\Penghuni\PembayaranController::create/store` | `PembayaranService::createPembayaran` |
| GF-20 | Penghuni dapat melihat riwayat pembayaran | `GET /penghuni/pembayaran` | `Web\Penghuni\PembayaranController::index` | `PembayaranService::getPenghuniPembayaran` |
| GF-21 | Penghuni dapat melihat detail pembayaran | `GET /penghuni/pembayaran/{id}` | `Web\Penghuni\PembayaranController::show` | `PembayaranService::getPenghuniPembayaranDetail` |
| GF-22 | Penghuni dapat membuat review | `GET/POST /penghuni/reviews/create/{kos}` | `Web\Penghuni\ReviewController::create/store` | `ReviewService::createReview` |
| GF-23 | Penghuni dapat mengedit review | `GET/PUT /penghuni/reviews/{review}/edit` | `Web\Penghuni\ReviewController::edit/update` | `ReviewService::updateReview` |
| GF-24 | Penghuni dapat menghapus review | `DELETE /penghuni/reviews/{review}` | `Web\Penghuni\ReviewController::destroy` | `ReviewService::deleteReview` |
| GF-25 | Penghuni dapat melihat riwayat review | `GET /penghuni/reviews/history` | `Web\Penghuni\ReviewController::history` | `ReviewService::getPenghuniReviewHistory` |
| GF-26 | Penghuni dapat melihat analisis pribadi | `GET /penghuni/analisis` | `Web\Penghuni\AnalisisController::index` | `AnalisisService::getPenghuniAnalisis` |
| GF-27 | Penghuni dapat melihat analisis pengeluaran | `GET /penghuni/analisis/spending` | `Web\Penghuni\AnalisisController::getSpendingAnalysis` | `AnalisisService::getPenghuniSpendingAnalysis` |
| GF-28 | Penghuni dapat mengajukan aduan | `GET/POST /penghuni/aduan` | `Web\Penghuni\AduanController::create/store` | `AduanService::createAduan` |
| GF-29 | Penghuni dapat melihat aduan | `GET /penghuni/aduan/{id}` | `Web\Penghuni\AduanController::show` | `AduanService::getAduanDetail` |
| GF-30 | Penghuni dapat menambah komentar aduan | `POST /penghuni/aduan/{id}/komentar` | `Web\Penghuni\AduanController::tambahKomentar` | `AduanService::tambahKomentar` |
| GF-31 | Penghuni dapat melihat profil | `GET /penghuni/profile` | `Web\ProfileController::showPenghuni` | `ProfileService::getPenghuniProfileData` |
| GF-32 | Penghuni dapat mengedit profil | `GET/PUT /penghuni/profile/edit` | `Web\ProfileController::editPenghuni/updatePenghuni` | `ProfileService::updatePenghuni` |
| GF-33 | Penghuni dapat mengupload foto profil | `POST /penghuni/profile/upload-photo` | `Web\ProfileController::uploadPhotoPenghuni` | `ProfileService::uploadPhotoPenghuni` |
| GF-34 | Penghuni dapat mengganti password | `POST /penghuni/profile/change-password` (API) | `API\Penghuni\PenghuniProfileController::changePassword` | `ProfileService::changePassword` |
| GF-35 | Penghuni dapat melihat notifikasi | `GET /notifications` | `Web\NotificationController::index` | `NotificationService` |
| GF-36 | Penghuni dapat logout | `POST /logout` | `Web\Auth\LoginController::logout` | `Auth\AuthService::logout` |

#### D.1.3 Pemilik

| # | Kebutuhan Fungsional | Route/Bukti | Controller | Service |
|---|---|---|---|---|
| GF-37 | Pemilik dapat melihat dashboard | `GET /pemilik/dashboard` | `Web\Pemilik\DashboardController::index` | `AnalisisService::getPemilikDashboardStats` |
| GF-38 | Pemilik dapat mengelola kos (CRUD) | `GET/POST/PUT/DELETE /pemilik/kos` | `Web\Pemilik\KosController` | `KosService` |
| GF-39 | Pemilik dapat mengelola foto kos | `POST/DELETE api/pemilik/foto-kos` | `API\Pemilik\FotoKosController` | `FotoKosService` |
| GF-40 | Pemilik dapat mengelola fasilitas kos | `POST/PUT/DELETE api/pemilik/kos-fasilitas` | `API\Pemilik\KosFasilitasController` | — |
| GF-41 | Pemilik dapat mengelola pengaturan kos | `POST/PUT api/pemilik/pengaturan-kos` | `API\Pemilik\PengaturanKosController` | — |
| GF-42 | Pemilik dapat mengelola kamar (CRUD) | `GET/POST/PUT/DELETE /pemilik/kamar` | `Web\Pemilik\KamarController` | `KamarService` |
| GF-43 | Pemilik dapat melihat daftar kontrak | `GET /pemilik/kontrak` | `Web\Pemilik\KontrakController::index` | `KontrakService::getPemilikKontrak` |
| GF-44 | Pemilik dapat menyetujui kontrak | `POST /pemilik/kontrak/{id}/approve` | `Web\Pemilik\KontrakController::approve` | `KontrakService::approveKontrak` |
| GF-45 | Pemilik dapat menolak kontrak | `POST /pemilik/kontrak/{id}/reject` | `Web\Pemilik\KontrakController::reject` | `KontrakService::rejectKontrak` |
| GF-46 | Pemilik dapat menyelesaikan kontrak | `POST /pemilik/kontrak/{id}/selesai` | `Web\Pemilik\KontrakController::selesai` | `KontrakService::selesaiKontrak` |
| GF-47 | Pemilik dapat menghapus kontrak (selesai/ditolak) | `DELETE /pemilik/kontrak/{id}` | `Web\Pemilik\KontrakController::destroy` | `KontrakService::destroyKontrak` |
| GF-48 | Pemilik dapat melihat pembayaran | `GET /pemilik/pembayaran` | `Web\Pemilik\PembayaranController::index` | `PembayaranService::getPemilikPembayaran` |
| GF-49 | Pemilik dapat menyetujui pembayaran | `POST /pemilik/pembayaran/{id}/approve` | `Web\Pemilik\PembayaranController::approve` | `PembayaranService::approvePembayaran` |
| GF-50 | Pemilik dapat menolak pembayaran | `POST /pemilik/pembayaran/{id}/reject` | `Web\Pemilik\PembayaranController::reject` | `PembayaranService::rejectPembayaran` |
| GF-51 | Pemilik dapat melihat review | `GET /pemilik/reviews` | `Web\Pemilik\ReviewController::index` | `ReviewService::getPemilikReviews` |
| GF-52 | Pemilik dapat melihat analisis | `GET /pemilik/analisis` | `Web\Pemilik\AnalisisController::index` | `AnalisisService::getPemilikAnalisis` |
| GF-53 | Pemilik dapat mengajukan aduan | `GET/POST /pemilik/aduan` | `Web\Pemilik\AduanController::create/store` | `AduanService::createAduan` |
| GF-54 | Pemilik dapat melihat aduan | `GET /pemilik/aduan/{id}` | `Web\Pemilik\AduanController::show` | `AduanService::getAduanDetail` |
| GF-55 | Pemilik dapat menambah komentar aduan | `POST /pemilik/aduan/{id}/komentar` | `Web\Pemilik\AduanController::tambahKomentar` | `AduanService::tambahKomentar` |
| GF-56 | Pemilik dapat melihat profil | `GET /pemilik/profile` | `Web\ProfileController::showPemilik` | `ProfileService::getPemilikProfileData` |
| GF-57 | Pemilik dapat mengedit profil | `GET/PUT /pemilik/profile/edit` | `Web\ProfileController::editPemilik/updatePemilik` | `ProfileService::updatePemilik` |
| GF-58 | Pemilik dapat mengupload foto profil | `POST /pemilik/profile/upload-photo` | `Web\ProfileController::uploadPhotoPemilik` | `ProfileService::uploadPhotoPemilik` |
| GF-59 | Pemilik dapat mengganti password | `POST /api/pemilik/profile/change-password` | `API\Pemilik\PemilikProfileController::changePassword` | `ProfileService::changePassword` |
| GF-60 | Pemilik dapat melihat notifikasi | `GET /notifications` | `Web\NotificationController::index` | `NotificationService` |
| GF-61 | Pemilik dapat melakukan export analisis PDF | `#exportPdfBtn` (JS) | `modules/analisis/pdf-export.js` | — |

#### D.1.4 Admin

| # | Kebutuhan Fungsional | Route/Bukti | Controller | Service |
|---|---|---|---|---|
| GF-62 | Admin dapat melihat dashboard platform | `GET /admin/dashboard` | `Web\Admin\DashboardController::index` | `AnalisisService` |
| GF-63 | Admin dapat mengelola user admin (CRUD) | `GET/POST/PUT/DELETE /admin/users` | `Web\Admin\UserController` | — |
| GF-64 | Admin dapat melihat data pemilik (read-only) | `GET /admin/data-pemilik` | `Web\Admin\UserController::dataPemilik/showPemilik` | — |
| GF-65 | Admin dapat mengupdate status pemilik | `POST /admin/data-pemilik/{id}/status` | `Web\Admin\UserController::updateStatusPemilik` | — |
| GF-66 | Admin dapat melihat data penghuni (read-only) | `GET /admin/data-penghuni` | `Web\Admin\UserController::dataPenghuni/showPenghuni` | — |
| GF-67 | Admin dapat mengupdate status penghuni | `POST /admin/data-penghuni/{id}/status` | `Web\Admin\UserController::updateStatusPenghuni` | — |
| GF-68 | Admin dapat melihat semua kos | `GET /admin/kos` | `Web\Admin\KosController::index` | — |
| GF-69 | Admin dapat memoderasi review (hapus) | `GET/DELETE /admin/reviews` | `Web\Admin\ReviewController::index/destroy` | — |
| GF-70 | Admin dapat mengelola aduan (lihat, update status, komentar) | `GET/POST /admin/aduan` | `Web\Admin\AduanController` | `AduanService` |
| GF-71 | Admin dapat melihat analisis platform | `GET /admin/analisis` | `Web\Admin\AnalisisController::index` | `AnalisisService` |
| GF-72 | Admin dapat melihat laporan | `GET /admin/laporan` | `Web\Admin\LaporanController::index` | — |
| GF-73 | Admin dapat melihat keuangan platform | `GET /admin/keuangan` | `Web\Admin\KeuanganController::index` | `KeuanganService` |
| GF-74 | Admin dapat mensimulasikan pembayaran (testing) | `GET /api/admin/payment/simulate/{externalId}` | `PaymentCallbackController::simulatePayment` | — |

#### D.1.5 Lintas Role / Sistem

| # | Kebutuhan Fungsional | Route/Bukti |
|---|---|---|
| GF-75 | Sistem mengirim notifikasi email kontrak baru ke pemilik | `KontrakNotificationService::sendPengajuanBaru` |
| GF-76 | Sistem mengirim notifikasi email persetujuan kontrak ke penghuni | `KontrakNotificationService::sendPersetujuanDiterima` |
| GF-77 | Sistem mengirim notifikasi email penolakan kontrak ke penghuni | `KontrakNotificationService::sendPersetujuanDitolak` |
| GF-78 | Sistem mengirim notifikasi email pengingat tenggat (H-7, H-3, H-1, H-0, terlambat) | `KontrakNotificationService::checkAndSendTenggatWaktuNotifications`, scheduled `notifications:send-emails` setiap 08:00 & 18:00 WIB |
| GF-79 | Sistem mengirim notifikasi in-app untuk semua event di atas | `KontrakNotificationService::createInApp` |
| GF-80 | Sistem mengirim notifikasi pembayaran (pending, approved, rejected) | `PembayaranNotificationService::sendDualPaymentNotification` |
| GF-81 | Sistem menghitung bagi hasil 90% pemilik / 10% platform | `PembayaranService::approvePembayaran` |
| GF-82 | Sistem menerima callback payment gateway (HMAC-SHA256) | `POST /api/payment/callback` → `PaymentCallbackController::handleCallback` |
| GF-83 | Sistem mengupdate status kamar ke 'tersedia' saat kontrak selesai | `KontrakSewa::booted()` (model event `updated`) |
| GF-84 | Sistem menyajikan file storage melalui route aman | `GET /storage/{folder}/{filename}` — validasi folder & path traversal |
| GF-85 | Sistem menyediakan endpoint API untuk semua fitur (Sanctum-protected) | `routes/api.php` (233 line) |

### D.2 Kebutuhan Nonfungsional

#### D.2.1 Keamanan (Security)

| # | Kebutuhan | Implementasi | Bukti | Status |
|---|---|---|---|---|
| NF-01 | Password di-hash | `User` model casts `password => 'hashed'`, `Hash::check()` di `ProfileService::changePassword` | `app/Models/User.php:16` | **Implemented** |
| NF-02 | Proteksi CSRF | Sanctum SPA `EnsureFrontendRequestsAreStateful`, Axios `X-XSRF-TOKEN`, `api-client.js` auto-fetch `sanctum/csrf-cookie` | `bootstrap/app.php:22`, `resources/js/services/api-client.js` | **Implemented** |
| NF-03 | Security Headers | CSP, HSTS, X-Frame-Options (DENY), X-Content-Type-Options, X-XSS-Protection, Referrer-Policy, Permissions-Policy | `app/Http/Middleware/SecurityHeaders.php` | **Implemented** |
| NF-04 | Path Traversal Protection pada file storage | Validasi `basename()`, cek `..`, `/`, `\` dalam filename, cek `realpath()` | `routes/web.php:56-70` | **Implemented** |
| NF-05 | Proteksi XSS | CSP membatasi sumber script (`'self'`, `'unsafe-inline'`, CDN tertentu), Blade auto-escape | `SecurityHeaders.php` | **Implemented** |
| NF-06 | Rate Limiting | API: 120/menit/IP (`api-global`), Web: 60/menit/IP (`web-global`), Login: throttle khusus | `bootstrap/app.php:26,30` | **Implemented** |
| NF-07 | Session Security | Cookie driver, HTTP-only, SameSite=strict, enkripsi session | `config/session.php` | **Implemented** |
| NF-08 | Account Status Check | Middleware `CheckAccountStatus` mencegah akses user diblokir/dibatasi | `app/Http/Middleware/CheckAccountStatus.php` | **Implemented** |
| NF-09 | Callback Signature | Payment callback menggunakan HMAC-SHA256 via header `X-Callback-Signature` | `PaymentCallbackController`, `services.php PAYMENT_CALLBACK_TOKEN` | **Implemented** |
| NF-10 | Bcrypt rounds = 12 | `BCRYPT_ROUNDS=12` di `.env` | `.env:17` | **Implemented** |

#### D.2.2 Performa (Performance)

| # | Kebutuhan | Implementasi | Bukti | Status |
|---|---|---|---|---|
| NF-11 | Caching analitik | `AnalisisService` menggunakan Cache dengan TTL 300 detik | `app/Services/Analisis/AnalisisService.php` | **Implemented** |
| NF-12 | Database indexes | 16+ composite/single-column indexes pada tabel utama | `migrations/2026_07_22_000001_add_performance_indexes.php` | **Implemented** |
| NF-13 | Database queue driver | Queue menggunakan database driver untuk job processing | `config/queue.php`, `.env` | **Implemented** |
| NF-14 | Pagination pada semua list data | Seluruh list menggunakan `paginate()` | Semua Service | **Implemented** |

#### D.2.3 Ketersediaan & Keandalan (Availability & Reliability)

| # | Kebutuhan | Implementasi | Bukti | Status |
|---|---|---|---|---|
| NF-15 | Session management | Cookie driver dengan lifetime 120 menit | `config/session.php` | **Implemented** |
| NF-16 | Queue retry mechanism | Queue `retry_after=90`, tries=1 | `config/queue.php` | **Implemented** |
| NF-17 | Scheduled task tanpa overlapping | `withoutOverlapping()` pada cron job | `app/Console/Kernel.php` | **Implemented** |
| NF-18 | Logging aktivitas | LOG_CHANNEL=stack, LOG_LEVEL=debug | `.env` | **Implemented** |
| NF-19 | Error handling JSON API | Exception handler untuk 401, 403, 404, 422, 429, 500 | `bootstrap/app.php:34-102` | **Implemented** |

#### D.2.4 Kegunaan (Usability)

| # | Kebutuhan | Implementasi | Bukti | Status |
|---|---|---|---|---|
| NF-20 | Desain responsif | Tailwind CSS dengan kelas responsif | Semua view Blade | **Implemented** |
| NF-21 | Loading state pada AJAX | NProgress, button spinner (`setLoading`), skeleton loading komponen | `api-client.js`, `loading.js`, `components/skeleton-*.blade.php` | **Implemented** |
| NF-22 | Toast notifications untuk feedback | `showSuccess`, `showError`, `showWarning`, `showInfo` | `resources/js/utils/notifications.js` | **Implemented** |
| NF-23 | Form validation client-side & server-side | `FormRequest` (21 class) + JS validation | `app/Http/Requests/`, `register-form.js`, `create-form.js` | **Implemented** |
| NF-24 | Peta interaktif dengan Leaflet | Map picker, clustering, nearby places, reverse geocode | `modules/kos/map-picker.js`, `public/kos/peta.blade.php` | **Implemented** |
| NF-25 | AJAX-first form submission | Forms menggunakan `data-ajax="true"` + `ajax-form.js` | `resources/js/utils/ajax-form.js` | **Implemented** |
| NF-26 | Searchable select dropdown | Custom dropdown component | `modules/ui/searchable-select.js` | **Implemented** |
| NF-27 | Password visibility toggle | Show/hide password button | `utils/password-toggle.js` | **Implemented** |
| NF-28 | File upload preview | Image preview sebelum upload | `app.js`, `form.js` | **Implemented** |
| NF-29 | Auto-dismiss alerts | Notifikasi otomatis menghilang | `app.js:48-52` | **Implemented** |

#### D.2.5 Maintainability

| # | Kebutuhan | Implementasi | Bukti | Status |
|---|---|---|---|---|
| NF-30 | Service layer pattern | Business logic terpisah di Services, Controller hanya delegasi | `app/Services/` (11 folder, 14 class) | **Implemented** |
| NF-31 | Form Request validation | Validasi terpusat di FormRequest classes | `app/Http/Requests/` (21 class) | **Implemented** |
| NF-32 | API + Web dual implementation | API dan Web controllers berbagi Service layer yang sama | `Controllers/API/` + `Controllers/Web/` | **Implemented** |
| NF-33 | PSR-4 autoloading | Namespace sesuai konvensi | `composer.json` | **Implemented** |
| NF-34 | Testing | PHPUnit test (7 Feature + 5 Unit) + Vitest (1 file) | `tests/`, `resources/js/tests/` | **Partial** |
| NF-35 | Seeders untuk data development | 9 seeder classes | `database/seeders/` | **Implemented** |
| NF-36 | Factories untuk testing | 9 factory classes | `database/factories/` | **Implemented** |

#### D.2.6 Privacy & Data Protection

| # | Kebutuhan | Implementasi | Bukti | Status |
|---|---|---|---|---|
| NF-37 | Foto KTP hanya bisa diakses oleh pemilik & admin terkait | Disimpan di storage dan disajikan melalui route terproteksi | `routes/web.php` | **Implemented** |
| NF-38 | Password tidak pernah dikembalikan dalam response | `$hidden = ['password', 'remember_token']` | `User.php` | **Implemented** |

### D.3 Ketentuan Use Case Diagram

**Aktor:**
1. **Pengunjung** (Guest) — Belum login
2. **Penghuni** — Penyewa kamar (role `penghuni`)
3. **Pemilik** — Pemilik kos (role `pemilik`)
4. **Admin** — Pengelola platform (role `admin`)
5. **Sistem** — Actor otomatis (notifikasi, callback payment, scheduler)

**Use Case per Aktor:**

**Pengunjung:**
- UC-01: Melihat Halaman Utama
- UC-02: Mencari Kos (dengan filter)
- UC-03: Melihat Detail Kos
- UC-04: Melihat Peta Kos
- UC-05: Melihat Halaman Informasi (About, How-to, Terms, Privacy)
- UC-06: Mendaftar Akun
- UC-07: Login
- UC-08: Melakukan Reset Password
- UC-09: Melihat Review Publik

**Penghuni** (extends Pengunjung, inherit UC-02, UC-03, UC-04, UC-09):
- UC-10: Melihat Dashboard
- UC-11: Mencari Kos (dari dashboard)
- UC-12: Mengajukan Kontrak Sewa
- UC-13: Melihat Daftar Kontrak
- UC-14: Melihat Detail Kontrak
- UC-15: Melakukan Pembayaran
- UC-16: Melihat Riwayat Pembayaran
- UC-17: Membuat Review
- UC-18: Mengedit Review
- UC-19: Menghapus Review
- UC-20: Melihat Analisis Pribadi
- UC-21: Mengajukan Aduan
- UC-22: Menambah Komentar Aduan
- UC-23: Mengelola Profil
- UC-24: Melihat Notifikasi
- UC-25: Logout

**Pemilik** (extends Pengunjung, inherit UC-02, UC-03, UC-09):
- UC-26: Melihat Dashboard
- UC-27: Mengelola Kos (CRUD)
- UC-28: Mengelola Foto Kos
- UC-29: Mengelola Fasilitas Kos
- UC-30: Mengelola Pengaturan Kos
- UC-31: Mengelola Kamar (CRUD)
- UC-32: Melihat Daftar Kontrak
- UC-33: Menyetujui Kontrak
- UC-34: Menolak Kontrak
- UC-35: Menyelesaikan Kontrak
- UC-36: Menghapus Kontrak
- UC-37: Melihat Pembayaran
- UC-38: Menyetujui Pembayaran
- UC-39: Menolak Pembayaran
- UC-40: Melihat Review
- UC-41: Melihat Analisis
- UC-42: Mengajukan Aduan
- UC-43: Menambah Komentar Aduan
- UC-44: Mengelola Profil
- UC-45: Melihat Notifikasi
- UC-46: Logout
- UC-47: Export Analisis PDF

**Admin:**
- UC-48: Melihat Dashboard Platform
- UC-49: Mengelola User Admin (CRUD)
- UC-50: Melihat Data Pemilik
- UC-51: Mengupdate Status Pemilik
- UC-52: Melihat Data Penghuni
- UC-53: Mengupdate Status Penghuni
- UC-54: Melihat Semua Kos
- UC-55: Memoderasi Review (Hapus)
- UC-56: Mengelola Aduan (Lihat, Update Status, Komentar)
- UC-57: Melihat Analisis Platform
- UC-58: Melihat Laporan
- UC-59: Melihat Keuangan Platform
- UC-60: Logout

**Sistem:**
- UC-61: Mengirim Notifikasi Email (kontrak, pembayaran, tenggat)
- UC-62: Mengirim Notifikasi In-App
- UC-63: Menghitung Bagi Hasil (90/10)
- UC-64: Menerima Callback Payment Gateway
- UC-65: Mengupdate Status Kamar saat Kontrak Selesai
- UC-66: Menjalankan Scheduled Task (pengingat tenggat setiap 08:00 & 18:00 WIB)

**Relasi <<include>>:**
- UC-06 (Daftar) <<include>> UC-07 (Login) — setelah daftar auto-login
- UC-12 (Ajukan Kontrak) <<include>> UC-02 (Cari Kos) — kontrak dimulai dari pencarian
- UC-15 (Pembayaran) <<include>> UC-13 (Lihat Kontrak) — pembayaran terkait kontrak
- UC-33 (Setujui Kontrak) <<include>> UC-61 (Kirim Notifikasi Email) — otomatis
- UC-38 (Setujui Pembayaran) <<include>> UC-63 (Hitung Bagi Hasil) — otomatis

**Relasi <<extend>>:**
- UC-13 (Lihat Kontrak) <<extend>> UC-14 (Detail Kontrak) — optional
- UC-16 (Riwayat Pembayaran) <<extend>> UC-15 (Pembayaran) — dari detail bisa bayar

**Generalization:**
- Penghuni → Pengunjung (inherit browsing capabilities)
- Pemilik → Pengunjung (inherit browsing capabilities)

**System Boundary:** Seluruh sistem AyoKos.

### D.4 Ketentuan Activity Diagram

Proses-proses yang **wajib** dibuat Activity Diagram (10 proses utama):

| # | Nama Proses | Aktor | Trigger | Sukses | Gagal |
|---|---|---|---|---|---|
| AD-01 | Registrasi Akun | Pengunjung → Sistem | Klik "Daftar" | Redirect ke dashboard | Validasi gagal |
| AD-02 | Login | Pengunjung → Sistem | Submit form login | Redirect ke dashboard role-based | Username/password salah, akun diblokir/dibatasi |
| AD-03 | Pengajuan Kontrak Sewa | Penghuni → Pemilik | Pilih kamar + upload KTP | Notifikasi ke pemilik (email + in-app) | Kamar terisi, validasi gagal |
| AD-04 | Persetujuan Kontrak oleh Pemilik | Pemilik → Sistem → Penghuni | Klik "Setujui" | Status kontrak aktif, kamar terisi, notifikasi | Klik "Tolak" → kontrak ditolak + alasan |
| AD-05 | Pembayaran Sewa | Penghuni → Sistem → Pemilik | Upload bukti bayar | Status pending menunggu approval | Validasi gagal |
| AD-06 | Approval Pembayaran oleh Pemilik | Pemilik → Sistem | Klik "Setujui" | Bagi hasil 90/10, status lunas, notifikasi | Klik "Tolak" → status kembali ke 'belum' |
| AD-07 | Penyelesaian Kontrak | Pemilik → Sistem | Klik "Selesai" | Kontrak selesai, kamar tersedia, notifikasi | — |
| AD-08 | Pengajuan Aduan | Penghuni/Pemilik → Admin | Isi form aduan | Notifikasi ke admin, status 'diajukan' | Validasi gagal |
| AD-09 | Penanganan Aduan oleh Admin | Admin → Sistem | Update status | Status berubah, notifikasi ke pengadu | — |
| AD-10 | Reset Password | Pengunjung → Sistem | Klik "Lupa Password" | Email reset terkirim, password berubah | Email tidak ditemukan |

Detail untuk AD-01 (Registrasi):
- **Kondisi awal:** Pengunjung di halaman register
- **Trigger:** Submit form registrasi 3-step
- **Langkah:** Isi data pribadi → Isi data akun → Pilih role → Validasi server → Buat User + Profil (Penghuni/Pemilik) → Auto-login → Redirect dashboard
- **Decision:** Role penghuni → status `calon`; Role pemilik → status `pending`
- **Backend:** `AuthService::register` → create User → create Penghuni/Pemilik → login
- **Database:** INSERT ke `users`, INSERT ke `penghuni`/`pemilik`

Detail untuk AD-04 (Persetujuan Kontrak):
- **Kondisi awal:** Kontrak berstatus `pending`
- **Trigger:** Pemilik klik "Setujui"
- **Langkah:** Validasi kepemilikan → Validasi status pending → DB Transaction → Update kontrak jadi `aktif` → Update penghuni jadi `aktif` → Update kamar jadi `terisi` → Tolak kontrak lain di kamar sama → Kirim notifikasi (email + in-app)
- **Decision:** Jika kamar sudah terisi → gagal. Jika sukses → notifikasi ke penghuni
- **Backend:** `KontrakService::approveKontrak` (DB transaction)
- **Database:** UPDATE `kontrak_sewa`, UPDATE `penghuni`, UPDATE `kamar`, UPDATE kontrak lain

---

## E. DDPL

### E.1 Ketentuan Arsitektur Sistem

```
[User Device (Browser)]
       |
       v
  [Internet]
       |
       v
  [Web Server: Laragon / Apache/Nginx]
       |
       +---> [AyoKos Web App (Blade + Tailwind)]
       |         |
       |         +---> [Vite Dev Server :5173] (development)
       |
       +---> [AyoKos API (Sanctum)]
                |
                +---> [Auth: Session-based + Sanctum Token]
                |
                +---> [Middleware Stack]
                |         - Authenticate
                |         - CheckAccountStatus
                |         - CheckPenghuni / CheckPemilik / CheckAdmin
                |         - SecurityHeaders
                |         - Rate Limiter (api-global: 120/min, web-global: 60/min)
                |
                +---> [Controllers]
                |         - API Controllers (35) → JSON Response
                |         - Web Controllers (24) → Blade View
                |
                +---> [Service Layer] (14 classes, ~153 methods)
                |         - Auth, Kos, Kamar, Kontrak, Pembayaran,
                |           Review, Profile, Analisis, Keuangan,
                |           Aduan, Notification (5 services)
                |
                +---> [Form Requests] (21 validasi class)
                |
                +---> [Models] (16 models)
                |
                +---> [Database: MySQL]
                |
                +----> [Queue: Database driver] → [Worker: php artisan queue:listen]
                |         → Email notifications, job processing
                |
                +----> [Cache: Database driver] → Analisis caching (300s TTL)
                |
                +----> [File Storage: local disk `storage/app/public/`]
                |         → Foto kos, kamar, KTP, bukti bayar, profil, dll
                |
                +----> [External Services]
                          - Xendit (Payment Gateway)
                          - SMTP Gmail (Email)
                          - OpenStreetMap / Nominatim (Geocoding)
                          - Overpass API (Nearby places)
                          - CartoDB (Map tiles)
                          - OSRM (Route planning di peta)

[Storage Folder Structure:]
storage/app/public/
  ├── kos/           → Foto utama kos & foto kos
  ├── kamar/         → Foto kamar
  ├── ktp/           → Foto KTP penghuni
  ├── bukti/         → Bukti pembayaran (legacy)
  ├── pembayaran/    → Bukti pembayaran
  ├── profiles/      → Foto profil user
  ├── reviews/       → Foto review
  ├── kontrak/       → Dokumen kontrak
  ├── foto_profil/   → Foto profil (alternatif)
  ├── bukti_pembayaran/ → Bukti pembayaran (alternatif)
  └── aduan/         → Lampiran aduan
```

### E.2 Ketentuan ERD

**Entitas Utama (17 tabel):**

| # | Entitas | PK | FK | Tabel pivot? |
|---|---|---|---|---|
| 1 | `users` | `id` | — | — |
| 2 | `admin` | `id_admin` | `user_id` → users(id) | — |
| 3 | `pemilik` | `id_pemilik` | `user_id` → users(id) | — |
| 4 | `penghuni` | `id_penghuni` | `user_id` → users(id) | — |
| 5 | `kos` | `id_kos` | `id_pemilik` → pemilik(id_pemilik) | — |
| 6 | `kamar` | `id_kamar` | `id_kos` → kos(id_kos) | — |
| 7 | `fasilitas` | `id_fasilitas` | — | — |
| 8 | `kos_fasilitas` | `id_kos_fasilitas` | `id_kos` → kos, `id_fasilitas` → fasilitas | **Ya** (Many-to-Many Kos ↔ Fasilitas) |
| 9 | `foto_kos` | `id_foto` | `id_kos` → kos(id_kos) | — |
| 10 | `pengaturan_kos` | `id_pengaturan` | `id_kos` → kos(id_kos) | — |
| 11 | `kontrak_sewa` | `id_kontrak` | `id_penghuni`, `id_kos`, `id_kamar` | — |
| 12 | `pembayaran` | `id_pembayaran` | `id_kontrak`, `id_penghuni` | — |
| 13 | `reviews` | `id_review` | `id_kos`, `id_penghuni`, `id_kontrak` | — |
| 14 | `notifications` (custom) | `id_notifikasi` (UUID) | `id_user` → users(id) | — |
| 15 | `aduan` | `id_aduan` | `id_pengirim` → users(id) | — |
| 16 | `aduan_komentar` | `id_komentar` | `id_aduan` → aduan, `id_pengirim` → users | — |
| 17 | `password_reset_tokens` | `email` | — | — |

**Catatan:** Tabel `foto_kos` dan `pengaturan_kos` TIDAK memiliki file migrasi, tetapi memiliki Model. Gap ini perlu dicatat—tabel mungkin dibuat secara manual atau melalui mekanisme lain.

**Tabel Sistem (tidak perlu di ERD utama):** `sessions`, `cache`, `cache_locks`, `jobs`, `job_batches`, `failed_jobs`, `personal_access_tokens`, `permissions`, `roles`, `model_has_permissions`, `model_has_roles`, `role_has_permissions`.

**Relasi:**

| # | Entitas 1 | Entitas 2 | Tipe | Keterangan |
|---|---|---|---|---|
| R-01 | `users` | `admin` | **1:1** | Satu user memiliki satu admin |
| R-02 | `users` | `pemilik` | **1:1** | Satu user memiliki satu pemilik |
| R-03 | `users` | `penghuni` | **1:1** | Satu user memiliki satu penghuni |
| R-04 | `pemilik` | `kos` | **1:N** | Satu pemilik memiliki banyak kos |
| R-05 | `kos` | `kamar` | **1:N** | Satu kos memiliki banyak kamar |
| R-06 | `kos` | `fasilitas` | **M:N** | Melalui `kos_fasilitas` (pivot) |
| R-07 | `kos` | `foto_kos` | **1:N** | Satu kos memiliki banyak foto |
| R-08 | `kos` | `pengaturan_kos` | **1:1** | Satu kos memiliki satu pengaturan |
| R-09 | `penghuni` | `kontrak_sewa` | **1:N** | Satu penghuni memiliki banyak kontrak |
| R-10 | `kos` | `kontrak_sewa` | **1:N** | Satu kos memiliki banyak kontrak |
| R-11 | `kamar` | `kontrak_sewa` | **1:N** | Satu kamar memiliki banyak kontrak (riwayat) |
| R-12 | `kontrak_sewa` | `pembayaran` | **1:N** | Satu kontrak memiliki banyak pembayaran |
| R-13 | `penghuni` | `pembayaran` | **1:N** | Satu penghuni memiliki banyak pembayaran |
| R-14 | `penghuni` | `reviews` | **1:N** | Satu penghuni memiliki banyak review |
| R-15 | `kos` | `reviews` | **1:N** | Satu kos memiliki banyak review |
| R-16 | `kontrak_sewa` | `reviews` | **1:N** | Satu kontrak memiliki satu review (opsional) |
| R-17 | `users` | `aduan` | **1:N** | Satu user mengajukan banyak aduan |
| R-18 | `aduan` | `aduan_komentar` | **1:N** | Satu aduan memiliki banyak komentar |
| R-19 | `users` | `aduan_komentar` | **1:N** | Satu user menulis banyak komentar |
| R-20 | `users` | `notifications` | **1:N** | Satu user menerima banyak notifikasi |

**Ketentuan ERD:**
- ERD Utama WAJIB menampilkan 17 entitas inti (tabel bisnis), tidak perlu tabel sistem
- Relasi M:N antara `kos` dan `fasilitas` harus ditampilkan dengan tabel pivot `kos_fasilitas`
- Semua kardinalitas harus sesuai R-01 s.d R-20
- Tabel `foto_kos` dan `pengaturan_kos` harus dimasukkan meskipun migrasi tidak ditemukan (model ada)

### E.3 Ketentuan Class Diagram

**Class yang WAJIB dimasukkan dalam Class Diagram Utama (dikelompokkan):**

#### Model Layer (16 classes):
1. **User** — `id`, `username`, `password`, `role`, `remember_token`, `status_updated_at`, `status_updated_by`, `status_alasan`. Method: `profile()`, `statusAktif()`, `isDiblokir()`, `isDibatasi()`, `getStatusAkunAttribute()`. Relasi: `hasOne(Pemilik)`, `hasOne(Penghuni)`, `hasOne(Admin)`, `hasMany(Aduan)`, `hasMany(AduanKomentar)`.
2. **Penghuni** — `id_penghuni`, `user_id`, `nama`, `no_hp`, `email`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `foto_profil`, `status_penghuni`, `nama_bank`, `nomor_rekening`. Relasi: `belongsTo(User)`, `hasMany(KontrakSewa)`, `hasMany(Pembayaran)`, `hasMany(Review)`.
3. **Pemilik** — `id_pemilik`, `user_id`, `nama`, `no_hp`, `email`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `foto_profil`, `status_pemilik`, `nama_bank`, `nomor_rekening`. Relasi: `belongsTo(User)`, `hasMany(Kos)`.
4. **Admin** — `id_admin`, `user_id`, `nama`, `no_hp`, `email`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `foto_profil`, `status_admin`. Relasi: `belongsTo(User)`.
5. **Kos** — `id_kos`, `id_pemilik`, `nama_kos`, `alamat`, `kecamatan`, `kota`, `provinsi`, `kode_pos`, `latitude`, `longitude`, `deskripsi`, `peraturan`, `jenis_kos`, `tipe_sewa`, `foto_utama`, `status_kos`. Relasi: `belongsTo(Pemilik)`, `hasMany(Kamar)`, `belongsToMany(Fasilitas)`, `hasMany(KontrakSewa)`, `hasMany(Review)`, `hasOne(PengaturanKos)`.
6. **Kamar** — `id_kamar`, `id_kos`, `nomor_kamar`, `tipe_kamar`, `harga`, `luas_kamar`, `kapasitas`, `fasilitas_kamar`, `foto_kamar`, `status_kamar`. Relasi: `belongsTo(Kos)`, `hasMany(KontrakSewa)`, `hasManyThrough(Penghuni)`.
7. **Fasilitas** — `id_fasilitas`, `nama_fasilitas`, `kategori`, `icon`. Relasi: `belongsToMany(Kos)`.
8. **KosFasilitas (Pivot)** — `id_kos_fasilitas`, `id_kos`, `id_fasilitas`. Extends `Pivot`.
9. **FotoKos** — `id_foto`, `id_kos`, `nama_file`, `urutan`. Accessor: `getUrlAttribute()`. Relasi: `belongsTo(Kos)`.
10. **PengaturanKos** — `id_pengaturan`, `id_kos`, `notifikasi_pembayaran_h_min`, `denda_keterlambatan`, `toleransi_keterlambatan`. Relasi: `belongsTo(Kos)`.
11. **KontrakSewa** — `id_kontrak`, `id_penghuni`, `id_kos`, `id_kamar`, `foto_ktp`, `tanggal_daftar`, `tanggal_mulai`, `tanggal_selesai`, `durasi_sewa`, `harga_sewa`, `status_kontrak`, `alasan_ditolak`. Model event: `updated` → set kamar tersedia. Relasi: `belongsTo(Penghuni)`, `belongsTo(Kos)`, `belongsTo(Kamar)`, `hasMany(Pembayaran)`, `hasMany(Review)`.
12. **Pembayaran** — `id_pembayaran`, `id_kontrak`, `id_penghuni`, `bulan_tahun`, `tanggal_mulai_sewa`, `tanggal_akhir_sewa`, `tanggal_jatuh_tempo`, `tanggal_bayar`, `jumlah`, `denda`, `total_bayar`, `bagian_pemilik`, `bagian_platform`, `bukti_pembayaran`, `metode_pembayaran`, `status_pembayaran`, `jenis_pembayaran`, `keterangan`. Method: `markAsPaid()`, `isOverdue()`. Relasi: `belongsTo(KontrakSewa)`, `belongsTo(Penghuni)`.
13. **Review** — `id_review`, `id_kos`, `id_penghuni`, `id_kontrak`, `rating`, `komentar`, `foto_review`. Model event: `creating/updating` validasi rating 1-5. Relasi: `belongsTo(Kos)`, `belongsTo(Penghuni)`, `belongsTo(KontrakSewa)`.
14. **Notification** — `id_notifikasi` (UUID), `id_user`, `type`, `title`, `body`, `link`, `is_read`. Method: `markAsRead()`. Relasi: `belongsTo(User)`.
15. **Aduan** — `id_aduan`, `id_pengirim`, `pengirim_role`, `judul`, `kategori`, `deskripsi`, `lampiran`, `status_aduan`. Relasi: `belongsTo(User)`, `hasMany(AduanKomentar)`.
16. **AduanKomentar** — `id_komentar`, `id_aduan`, `id_pengirim`, `isi`, `lampiran`. Relasi: `belongsTo(Aduan)`, `belongsTo(User)`.

#### Service Layer (14 classes, cukup sebutkan dependensi):
- `AuthService`, `KosService`, `FotoKosService`, `KamarService`, `KontrakService` (→ `KontrakNotificationService`), `PembayaranService` (→ `PembayaranNotificationService`), `ReviewService`, `ProfileService`, `AnalisisService`, `KeuanganService`, `AduanService`, `NotificationService`, `NotificationEmailService`, `ALLNotificationService`

Controller Layer dan FormRequest Layer cukup disebutkan di Class Diagram sekunder atau tidak perlu ditampilkan di diagram utama.

**Relasi ketergantungan:**
- Controller → Service → Model
- Service → NotificationService (untuk event notifikasi)
- Controller → FormRequest (validasi)

### E.4 Ketentuan Sequence Diagram

Proses yang **wajib** dibuat Sequence Diagram (8 proses):

| # | Nama Proses | Actor | Boundary | Controller | Service | Model | DB |
|---|---|---|---|---|---|---|---|
| SD-01 | Login | Pengunjung | `login.blade.php` | `AuthController::login` / `LoginController::login` | `AuthService::login` | `User` | SELECT + UPDATE session |
| SD-02 | Registrasi | Pengunjung | `register.blade.php` | `AuthController::register` / `RegisterController::register` | `AuthService::register` | `User`, `Penghuni`/`Pemilik` | INSERT users + INSERT penghuni/pemilik |
| SD-03 | Ajukan Kontrak Sewa | Penghuni | `penghuni/kontrak/create.blade.php` | `PenghuniKontrakController::store` | `KontrakService::createKontrak` | `KontrakSewa`, `Kamar`, `Kos` | INSERT kontrak_sewa + file upload KTP |
| SD-04 | Setujui Kontrak | Pemilik | `pemilik/kontrak/index.blade.php` | `PemilikKontrakController::approve` | `KontrakService::approveKontrak` | `KontrakSewa`, `Penghuni`, `Kamar` | DB Transaction: UPDATE kontrak, UPDATE penghuni, UPDATE kamar, UPDATE kontrak lain |
| SD-05 | Pembayaran + Approval | Penghuni + Pemilik | `penghuni/pembayaran/create.blade.php` + `pemilik/pembayaran/index.blade.php` | `PenghuniPembayaranController::store` + `PemilikPembayaranController::approve` | `PembayaranService::createPembayaran` + `PembayaranService::approvePembayaran` | `Pembayaran`, `KontrakSewa` | INSERT pembayaran + UPDATE pembayaran (bagi hasil) |
| SD-06 | Ajukan Aduan | Penghuni/Pemilik | `penghuni/aduan/create.blade.php` / `pemilik/aduan/create.blade.php` | `AduanController::store` | `AduanService::createAduan` | `Aduan`, `User` (admin), `Notification` | INSERT aduan + INSERT notifications |
| SD-07 | Callback Pembayaran | Sistem Eksternal (Xendit) | — | `PaymentCallbackController::handleCallback` | `PembayaranService::handleCallback` | `Pembayaran`, `KontrakSewa` | UPDATE pembayaran (lunas) |
| SD-08 | Scheduled Tenggat Notifikasi | Sistem (Cron) | — | — | `KontrakNotificationService::checkAndSendTenggatWaktuNotifications` | `KontrakSewa`, `Notification` | SELECT kontrak aktif + INSERT notifications + send email |

**Format interaksi untuk SD-01 (Login):**
1. Actor (Pengunjung) → Boundary (`login.blade.php`): Isi username + password + klik Login
2. Boundary → Controller (`AuthController::login` via AJAX `POST api/auth/login`): Kirim credentials
3. Controller → Middleware (`throttle:api-login`): Cek rate limit
4. Controller → Request (`LoginRequest`): Validasi input (username required, password required)
5. Controller → Service (`AuthService::login`): Delegasi autentikasi
6. Service → Model (`User`): `where('username', $credentials['username'])->first()`
7. Service: `Hash::check($password, $user->password)`
8. Service: Cek `isDiblokir()` / `isDibatasi()` → return error jika terblokir
9. Service: `Auth::login($user, $remember)` → regenerate session
10. Service → Response: return `['success' => true, 'redirect' => route based on role]`
11. Controller → Response: JSON `{ success, message, redirect }`
12. Boundary: Redirect ke dashboard sesuai role

### E.5 Ketentuan Desain API

Semua API di `routes/api.php` (233 line). Berikut ringkasan per modul:

#### Public API (No Auth)
| Method | Endpoint | Auth | Controller | Fungsi |
|---|---|---|---|---|
| GET | `api/public/home` | No | `PublicController::home` | Data homepage |
| GET | `api/public/kos` | No | `PublicController::kosIndex` | List kos publik |
| GET | `api/public/kos/{id}` | No | `PublicController::kosShow` | Detail kos publik |
| GET | `api/public/peta` | No | `PublicController::peta` | Data peta |
| GET | `api/public/about` | No | `PublicController::about` | Halaman about |
| GET | `api/public/how-to` | No | `PublicController::howto` | Panduan |
| GET | `api/public/terms` | No | `PublicController::terms` | Syarat ketentuan |
| GET | `api/public/privacy` | No | `PublicController::privacy` | Kebijakan privasi |
| GET | `api/kos` | No | `KosController::index` | List kos (API resource) |
| GET | `api/kos/{id}` | No | `KosController::show` | Detail kos |
| GET | `api/kamar` | No | `KamarController::index` | List kamar |
| GET | `api/kamar/{id}` | No | `KamarController::show` | Detail kamar |
| GET | `api/fasilitas` | No | `FasilitasController::index` | List fasilitas |
| GET | `api/reviews` | No | `ReviewController::index` | List review |

#### Auth API (No Auth, throttled)
| Method | Endpoint | Throttle | Controller | Fungsi |
|---|---|---|---|---|
| POST | `api/auth/login` | `api-login` | `AuthController::login` | Login |
| POST | `api/auth/register` | `api-register` | `AuthController::register` | Register |
| POST | `api/auth/register/penghuni` | `api-register` | `AuthController::registerPenghuni` | Register sebagai penghuni |
| POST | `api/auth/register/pemilik` | `api-register` | `AuthController::registerPemilik` | Register sebagai pemilik |
| POST | `api/auth/forgot-password` | `forgot-password` | `AuthController::sendResetLink` | Kirim link reset password |
| POST | `api/auth/reset-password` | `reset-password` | `AuthController::resetPassword` | Reset password |

#### Auth API (Sanctum-protected)
| Method | Endpoint | Middleware | Controller | Fungsi |
|---|---|---|---|---|
| POST | `api/auth/logout` | `auth:sanctum, account.status` | `AuthController::logout` | Logout |
| GET | `api/auth/me` | `auth:sanctum, account.status` | `AuthController::me` | Data user saat ini |

#### Notifications API
| Method | Endpoint | Middleware | Controller | Fungsi |
|---|---|---|---|---|
| GET | `api/notifications` | Sanctum + account.status | `NotificationController::index` | List notifikasi |
| GET | `api/notifications/unread-count` | Sanctum + account.status | `NotificationController::unreadCount` | Jumlah notifikasi belum dibaca |
| POST | `api/notifications/{id}/read` | Sanctum + account.status | `NotificationController::markAsRead` | Tandai sudah dibaca |
| POST | `api/notifications/mark-all-read` | Sanctum + account.status | `NotificationController::markAllAsRead` | Tandai semua sudah dibaca |
| POST | `api/notifications/menunggu-persetujuan/{kontrakId}` | Sanctum | `NotificationController::sendMenungguPersetujuan` | Kirim notifikasi |
| POST | `api/notifications/persetujuan-diterima/{kontrakId}` | Sanctum | `NotificationController::sendPersetujuanDiterima` | Kirim notifikasi |
| POST | `api/notifications/persetujuan-ditolak/{kontrakId}` | Sanctum | `NotificationController::sendPersetujuanDitolak` | Kirim notifikasi |
| POST | `api/notifications/pengajuan-baru/{kontrakId}` | Sanctum | `NotificationController::sendPengajuanBaru` | Kirim notifikasi |

#### Admin API (auth:sanctum + account.status + admin)
| Method | Endpoint | Controller | Fungsi |
|---|---|---|---|
| GET | `api/admin/dashboard` | `AdminDashboardController::index` | Dashboard admin |
| GET/POST | `api/admin/data-pemilik` | `PemilikController::index/store` | CRUD data pemilik |
| GET/PUT/DELETE | `api/admin/data-pemilik/{id}` | `PemilikController::show/update/destroy` | Detail/update/hapus pemilik |
| POST | `api/admin/data-pemilik/{id}/status` | `AdminStatusAkunController::updateStatusPemilik` | Update status pemilik |
| GET/POST | `api/admin/data-penghuni` | `PenghuniController::index/store` | CRUD data penghuni |
| GET/PUT/DELETE | `api/admin/data-penghuni/{id}` | `PenghuniController::show/update/destroy` | Detail/update/hapus penghuni |
| POST | `api/admin/data-penghuni/{id}/status` | `AdminStatusAkunController::updateStatusPenghuni` | Update status penghuni |
| GET/POST | `api/admin/admin-users` | `AdminController::index/store` | CRUD admin users |
| GET/PUT/DELETE | `api/admin/admin-users/{id}` | `AdminController::show/update/destroy` | Detail/update/hapus admin |
| GET/POST | `api/admin/data-kontrak` | `KontrakSewaController::index/store` | CRUD kontrak |
| GET/PUT/DELETE | `api/admin/data-kontrak/{id}` | `KontrakSewaController::show/update/destroy` | Detail kontrak |
| GET/POST | `api/admin/data-pembayaran` | `PembayaranController::index/store` | CRUD pembayaran |
| GET/PUT/DELETE | `api/admin/data-pembayaran/{id}` | `PembayaranController::show/update/destroy` | Detail pembayaran |
| GET | `api/admin/aduan` | `AdminAduanController::index` | List aduan |
| GET | `api/admin/aduan/statistik` | `AdminAduanController::statistik` | Statistik aduan |
| GET | `api/admin/aduan/{id}` | `AdminAduanController::show` | Detail aduan |
| POST | `api/admin/aduan/{id}/status` | `AdminAduanController::updateStatus` | Update status aduan |
| POST | `api/admin/aduan/{id}/komentar` | `AdminAduanController::tambahKomentar` | Tambah komentar aduan |
| GET | `api/admin/keuangan` | `KeuanganController::ringkasan` | Ringkasan keuangan |
| GET | `api/admin/keuangan/pendapatan-bulanan` | `KeuanganController::pendapatanBulanan` | Pendapatan bulanan |
| GET | `api/admin/keuangan/transaksi-terbaru` | `KeuanganController::transaksiTerbaru` | Transaksi terbaru |
| GET | `api/admin/keuangan/statistik-pemilik` | `KeuanganController::statistikPemilik` | Statistik per pemilik |
| GET | `api/admin/payment/simulate/{externalId}` | `PaymentCallbackController::simulatePayment` | Simulasi callback payment |

#### Pemilik API (auth:sanctum + account.status)
| Method | Endpoint | Controller | Fungsi |
|---|---|---|---|
| GET | `api/pemilik/dashboard` | `PemilikDashboardController::index` | Dashboard |
| GET | `api/pemilik/dashboard/stats/kos` | `PemilikDashboardController::getKosStats` | Statistik kos |
| GET | `api/pemilik/dashboard/pendapatan/{tahun?}` | `PemilikDashboardController::getPendapatanTahunan` | Pendapatan tahunan |
| GET | `api/pemilik/dashboard/aktivitas` | `PemilikDashboardController::getAktivitasTerbaru` | Aktivitas terbaru |
| GET/POST | `api/pemilik/kos` | `PemilikKosController::index/store` | CRUD kos |
| GET/PUT/DELETE | `api/pemilik/kos/{id}` | `PemilikKosController::show/update/destroy` | Detail/update/hapus kos |
| GET/POST | `api/pemilik/kamar` | `PemilikKamarController::index/store` | CRUD kamar |
| GET/PUT/DELETE | `api/pemilik/kamar/{id}` | `PemilikKamarController::show/update/destroy` | Detail/update/hapus kamar |
| GET | `api/pemilik/kontrak` | `PemilikKontrakController::index` | List kontrak |
| GET | `api/pemilik/kontrak/{id}` | `PemilikKontrakController::show` | Detail kontrak |
| POST | `api/pemilik/kontrak/{id}/approve` | `PemilikKontrakController::approve` | Setujui kontrak |
| POST | `api/pemilik/kontrak/{id}/reject` | `PemilikKontrakController::reject` | Tolak kontrak |
| POST | `api/pemilik/kontrak/{id}/selesai` | `PemilikKontrakController::selesai` | Selesaikan kontrak |
| GET | `api/pemilik/pembayaran` | `PemilikPembayaranController::index` | List pembayaran |
| GET | `api/pemilik/pembayaran/{id}` | `PemilikPembayaranController::show` | Detail pembayaran |
| POST | `api/pemilik/pembayaran/{id}/approve` | `PemilikPembayaranController::approve` | Setujui pembayaran |
| POST | `api/pemilik/pembayaran/{id}/reject` | `PemilikPembayaranController::reject` | Tolak pembayaran |
| GET | `api/pemilik/reviews` | `PemilikReviewController::index` | List review |
| GET | `api/pemilik/analisis` | `PemilikAnalisisController::index` | Analisis |
| GET/PUT | `api/pemilik/profile` | `PemilikProfileController::show/edit/update` | Profil |
| POST | `api/pemilik/profile/upload-photo` | `PemilikProfileController::uploadPhoto` | Upload foto profil |
| POST | `api/pemilik/profile/change-password` | `PemilikProfileController::changePassword` | Ganti password |
| GET/POST | `api/pemilik/aduan` | `PemilikAduanController::index/store` | CRUD aduan |
| GET | `api/pemilik/aduan/{id}` | `PemilikAduanController::show` | Detail aduan |
| POST | `api/pemilik/aduan/{id}/komentar` | `PemilikAduanController::tambahKomentar` | Tambah komentar |

#### Penghuni API (auth:sanctum + account.status)
| Method | Endpoint | Controller | Fungsi |
|---|---|---|---|
| GET | `api/penghuni/dashboard` | `PenghuniDashboardController::index` | Dashboard |
| GET | `api/penghuni/dashboard/notifikasi-tenggat` | `PenghuniDashboardController::notifikasiTenggat` | Notifikasi tenggat |
| GET/POST | `api/penghuni/kontrak` | `PenghuniKontrakController::index/store` | CRUD kontrak |
| GET | `api/penghuni/kontrak/{id}` | `PenghuniKontrakController::show` | Detail kontrak |
| GET | `api/penghuni/kontrak/create/{kosId}` | `PenghuniKontrakController::create` | Form kontrak baru |
| GET | `api/penghuni/cari-kos` | `PenghuniKontrakController::cariKos` | Cari kos |
| GET/POST | `api/penghuni/pembayaran` | `PenghuniPembayaranController::index/store` | CRUD pembayaran |
| GET | `api/penghuni/pembayaran/{id}` | `PenghuniPembayaranController::show` | Detail pembayaran |
| GET/POST | `api/penghuni/reviews` | `PenghuniReviewController::index/store` | CRUD review |
| GET/PUT/DELETE | `api/penghuni/reviews/{id}` | `PenghuniReviewController::show/update/destroy` | Detail/update/hapus review |
| GET | `api/penghuni/reviews/create/{kos}` | `PenghuniReviewController::create` | Form review baru |
| GET | `api/penghuni/reviews/history` | `PenghuniReviewController::history` | Riwayat review |
| GET | `api/penghuni/analisis` | `PenghuniAnalisisController::index` | Analisis |
| GET | `api/penghuni/analisis/spending` | `PenghuniAnalisisController::getSpendingAnalysis` | Analisis pengeluaran |
| GET/PUT | `api/penghuni/profile` | `PenghuniProfileController::show/edit/update` | Profil |
| POST | `api/penghuni/profile/upload-photo` | `PenghuniProfileController::uploadPhoto` | Upload foto |
| POST | `api/penghuni/profile/change-password` | `PenghuniProfileController::changePassword` | Ganti password |
| GET/POST | `api/penghuni/aduan` | `AduanController::index/store` | CRUD aduan |
| GET | `api/penghuni/aduan/{id}` | `AduanController::show` | Detail aduan |
| POST | `api/penghuni/aduan/{id}/komentar` | `AduanController::tambahKomentar` | Tambah komentar |

#### Payment Callback (No Auth — webhook)
| Method | Endpoint | Controller | Fungsi |
|---|---|---|---|
| POST | `api/payment/callback` | `PaymentCallbackController::handleCallback` | Menerima callback dari Xendit |

### E.6 Ketentuan UI/Mockup

**Halaman yang WAJIB dibuat UI/Mockup untuk DDPL (dikelompokkan per role):**

#### Guest / Public (6 halaman):
| # | Halaman | Tujuan | Komponen UI Utama |
|---|---|---|---|
| UI-01 | Home (Landing Page) | Memperkenalkan platform | Hero banner, search bar, statistik, rekomendasi kos card grid, fasilitas grid, pricing, testimoni, FAQ, CTA, footer |
| UI-02 | Cari Kos (List) | Menampilkan daftar kos dengan filter | Search form, filter panel (jenis, kota, harga, rating, fasilitas), card grid, pagination, active filter tags |
| UI-03 | Detail Kos | Menampilkan detail informasi kos | Gallery slider, info card, fasilitas tags, daftar kamar + harga, review section, peta lokasi, sidebar booking |
| UI-04 | Peta Kos | Menampilkan lokasi kos di peta | Leaflet peta, filter sidebar, marker cluster, legend, geolocation, route planner |
| UI-05 | Register (3-step) | Mendaftar akun baru | Step indicator (3 langkah), form data pribadi, form akun, role selection card, preview foto |
| UI-06 | Login | Login ke platform | Form username + password, link register, link lupa password |

#### Penghuni (9 halaman):
| # | Halaman | Komponen UI Utama |
|---|---|---|
| UI-07 | Dashboard Penghuni | Stats cards, active contract progress bars, recent payments table, quick actions, auto-refresh indicator |
| UI-08 | Cari Kos (dari dashboard) | Search form, kos card grid, filter |
| UI-09 | Ajukan Kontrak | Pilih kamar dropdown, durasi slider, perhitungan biaya real-time, preview tanggal, upload KTP, drag-and-drop |
| UI-10 | Daftar Kontrak | Tabs (pending, aktif, selesai, ditolak), table, status badges |
| UI-11 | Detail Kontrak | Status badge, info kontrak card, payment history table, timeline, action buttons |
| UI-12 | Pembayaran | Pilih kontrak, pilih durasi opsi, input jumlah, upload bukti bayar, preview |
| UI-13 | Riwayat Pembayaran | Filter status + date range, stats cards, table invoice, action buttons |
| UI-14 | Review | Star rating interactive, komentar textarea, upload foto review, history list |
| UI-15 | Aduan | Form aduan (judul, kategori, deskripsi, lampiran), list aduan, detail + komentar thread |

#### Pemilik (10 halaman):
| # | Halaman | Komponen UI Utama |
|---|---|---|
| UI-16 | Dashboard Pemilik | Stats grid (kos, kamar, penghuni, revenue), quick actions, recent kontrak, recent payments, charts (occupancy, revenue) |
| UI-17 | Kelola Kos | Table kos dengan search, action buttons (show, edit, delete), tambah kos button |
| UI-18 | Tambah/Edit Kos | Form multi-section: info dasar, peta picker lokasi, fasilitas checklist, upload foto utama, foto tambahan |
| UI-19 | Detail Kos | Status badge, info card, fasilitas list, rooms table, photos gallery, action buttons |
| UI-20 | Kelola Kamar | Filter by kos, table kamar, stats (total, tersedia, terisi, maintenance), tambah kamar (single/bulk) |
| UI-21 | Kelola Kontrak | Tabs (pending, aktif, selesai, ditolak), stats cards, table, modal approve/reject |
| UI-22 | Pembayaran | Filter (status, period, kos), stats cards, table, approve/reject actions |
| UI-23 | Review | Filter by kos, rating stats, review cards |
| UI-24 | Analisis | Charts (6 jenis: pendapatan, status kamar, jenis kos, status kontrak, rating, tipe kamar), export PDF |
| UI-25 | Aduan | Stats by status, table, form aduan, detail + komentar thread |

#### Admin (8 halaman):
| # | Halaman | Komponen UI Utama |
|---|---|---|
| UI-26 | Dashboard Admin | Stats cards (users, kos, complaints, revenue), charts (user growth, payment, contract), quick actions |
| UI-27 | Kelola User Admin | Table CRUD, search, create/edit form |
| UI-28 | Data Pemilik | Table read-only, filter status, detail page with status update form |
| UI-29 | Data Penghuni | Table read-only, filter status, detail page with status update form |
| UI-30 | Moderasi Review | Filter rating, table, delete action |
| UI-31 | Kelola Aduan | Stats by status, filter, table, detail page with status update + komentar form |
| UI-32 | Keuangan Platform | Summary cards, monthly revenue table (pemilik 90% / platform 10%), year filter |
| UI-33 | Analisis Platform | Charts (6 jenis: pendapatan, status kos, aduan, user growth, role distribution, top pemilik), export PDF |

**Spesifikasi UI:**
- **Design:** Neobrutalism (black borders `border-2 border-black`, hard shadows `shadow-[4px_4px_0px_#000]`, bold typography)
- **Framework:** Tailwind CSS v4
- **Icons:** Font Awesome 6
- **Loading states:** Skeleton components (`<x-skeleton-table>`, `<x-skeleton-card>`), NProgress bar, button spinner
- **Error states:** `<x-error-state>` component
- **Responsive:** Mobile-friendly dengan sidebar collapse
- **Bentuk form:** AJAX-first (`data-ajax="true"`), fallback ke method/action tradisional

### E.7 Ketentuan Deployment Diagram

Berdasarkan source code dan konfigurasi yang ditemukan:

| Node | Keterangan | Bukti |
|---|---|---|
| **User Device** | Browser modern (Chrome, Firefox, Edge) | Frontend menggunakan Tailwind + Vite |
| **Web Server** | Laragon (development) / Apache/Nginx (production) | `.env` tidak menentukan production server |
| **Application Server** | PHP 8.2+ dengan Laravel 12 | `composer.json` |
| **Database Server** | MySQL 8+ (production) / SQLite (testing) | `config/database.php` |
| **Mail Server** | SMTP Gmail (`smtp.gmail.com:587`) | `.env` |
| **Payment Gateway** | Xendit (`api.xendit.co`) | `config/services.php` |
| **Map Services** | OpenStreetMap (Nominatim, Overpass, OSRM, CartoDB tiles) | `map-picker.js`, `public/kos/peta.blade.php` |
| **Queue Worker** | Database driver (`php artisan queue:listen`) | `config/queue.php`, `composer.json` script `dev` |
| **Scheduler** | `php artisan schedule:run` setiap menit | `app/Console/Kernel.php` |
| **File Storage** | Local disk (`storage/app/public/`) | `config/filesystems.php` |
| **Cache** | Database driver | `config/cache.php` |
| **Session** | Cookie driver | `config/session.php` |

**Informasi deployment TIDAK ditemukan:**
- Domain production
- VPS/Cloud provider
- SSL/TLS certificate
- Docker configuration
- CI/CD pipeline
- Load balancer
- CDN

**Node hubungan:**
```
[User Browser]
    | HTTPS
[Web Server: Apache/Nginx]
    |── [Laravel App (PHP 8.2+)]
    |     |── [Queue Worker] → [Database: jobs table]
    |     |── [Scheduler] → [Schedule::command setiap 08:00 & 18:00]
    |     |── [File Storage: storage/app/public/]
    |── [Database: MySQL]
    |── [External Services]
          |── [Xendit API]
          |── [SMTP Gmail]
          |── [OpenStreetMap / Nominatim / Overpass]
          |── [CartoDB Tile Server]
```

---

## F. Gap Analysis

### F.1 Fitur yang Ada di Source Code Tapi Tidak Terdokumentasi di Kebutuhan (Found but undocumented)
1. **Peta interaktif dengan fitur lengkap** (route planning, marker clustering, nearby places) — sudah diimplementasi tapi bukan kebutuhan eksplisit di dokumen
2. **Export PDF analisis** (jsPDF + html2canvas) — sudah ada di JS tapi tidak ada route backend khusus
3. **File serving dengan security checks** (path traversal protection) — route khusus `/storage/{folder}/{filename}`
4. **Simulasi payment callback** untuk testing — `GET /api/admin/payment/simulate/{externalId}`
5. **Scheduled task** untuk pengingat tenggat kontrak 2x sehari (08:00 & 18:00 WIB)

### F.2 Fitur yang Terdokumentasi di AGENTS.md Tapi Tidak Ada Implementasinya (Documented but not found)
1. **`ExtendKontrakRequest`** disebut di `AGENTS.md` tapi tidak ada file `app/Http/Requests/Penghuni/ExtendKontrakRequest.php`
2. **Fitur perpanjangan kontrak** oleh penghuni — ada `sendNotifikasiPermintaanPerpanjangan` di service, tapi tidak ada route/web form untuk memperpanjang kontrak
3. **`KosanPolicy`** menggunakan model `kosan` (huruf kecil) yang tidak ada — hanya ada model `Kos`

### F.3 Fitur yang Hanya Sebagian Diimplementasikan (Partial implementation)
1. **Permission/Role tables** — migrasi membuat tabel `permissions`, `roles`, `model_has_permissions`, `model_has_roles`, `role_has_permissions` tapi tidak ada seeder, middleware, atau kode yang menggunakan tabel ini. Authorisasi hanya menggunakan middleware role-based sederhana (`CheckPenghuni`, `CheckPemilik`, `CheckAdmin`).
2. **Payment gateway integration** — ada `config/services.php` dengan konfigurasi Xendit (`base_url`, `api_key`, `secret_key`), ada `PaymentCallbackController`, tapi tidak ada implementasi pembayaran via gateway di frontend (pembayaran dilakukan via upload bukti transfer manual).
3. **Listener `SendOrderCreatedNotification`** — mereferensi `OrderCreated` event yang tidak ada di codebase. Juga menggunakan `NotificationService::sendNotification` method yang tidak ditemukan di service tersebut.
4. **Fitur `perpanjangan kontrak`** — service memiliki method notifikasi perpanjangan, tapi tidak ada controller/route untuk penghuni mengajukan perpanjangan.

### F.4 Ketidaksesuaian Antar Komponen (Cross-component inconsistencies)
1. **Tabel `foto_kos` dan `pengaturan_kos`** — Model-nya ada (`FotoKos.php`, `PengaturanKos.php`) dan direferensi di performance indexes migration, tapi **tidak ada migration file** yang membuat tabel tersebut. Ini akan menyebabkan error saat fresh migration.
2. **`CheckPenghuni` dan `CheckPemilik` middleware** — tidak menangani API/JSON requests; selalu redirect. Berbeda dengan `CheckAdmin` dan `CheckAccountStatus` yang mendukung format JSON. Artinya API routes yang menggunakan middleware ini secara tidak langsung akan gagal untuk response JSON.
3. **Dua tabel notifications** — migrasi `2026_04_29_130920_create_notifications_table.php` membuat tabel `notifications` standar Laravel, lalu migrasi `2026_05_15_122541_create_notifications_table.php` Drop tabel tersebut dan membuat ulang dengan struktur kustom. Ini berpotensi konflik jika migrasi dijalankan di database yang belum memiliki tabel notifications (drop akan gagal).
4. **`OrderCreated` Event** — direferensi di `app/Listeners/SendOrderCreatedNotification.php` tapi tidak ada filenya (class `OrderCreated` tidak ditemukan).

### F.5 Catatan Tambahan
1. **Tidak ada unit test untuk Services** yang memadai — hanya 5 unit test untuk 14 service classes
2. **Tidak ada feature test untuk Web Controllers** — hanya ada test untuk API controllers
3. **Kurangnya dokumentasi API** — tidak ada OpenAPI/Swagger spec
4. **`CheckAccountStatus` middleware** mengizinkan admin bypass semua status check — ini sengaja, tapi perlu dicatat bahwa admin bisa mengakses sistem meskipun akunnya diblokir/dibatasi (karena admin yang melakukan blocking)

---

## G. Tabel Ringkasan Ketentuan SKPL dan DDPL

| Dokumen | Bagian | Perlu Dibuat | Sumber/Bukti | Status |
|---|---|---|---|---|
| **SKPL** | Kebutuhan Fungsional (85 item) | Ya | Source Code (Routes, Controllers, Services, Views) | **Sudah dianalisis** |
| **SKPL** | Kebutuhan Nonfungsional (37 item) | Ya | Source Code + Config + Middleware | **Sudah dianalisis** |
| **SKPL** | Use Case Diagram (66 use case) | Ya | Role & Feature analysis | **Ketentuan sudah diberikan** |
| **SKPL** | Activity Diagram (10 proses) | Ya | Business Process analysis | **Ketentuan sudah diberikan** |
| **DDPL** | Arsitektur Sistem | Ya | Architecture from code | **Sudah dianalisis** |
| **DDPL** | ERD (17 entitas utama) | Ya | Migrations + Models | **Ketentuan sudah diberikan** |
| **DDPL** | Class Diagram (16 Model + Service) | Ya | Source Code | **Ketentuan sudah diberikan** |
| **DDPL** | Sequence Diagram (8 proses) | Ya | Flow/Controller/Service | **Ketentuan sudah diberikan** |
| **DDPL** | Desain API (85+ endpoint) | Ya | routes/api.php | **Ketentuan sudah diberikan** |
| **DDPL** | UI/Mockup (33 halaman) | Ya | resources/views/ (82 Blade files) | **Ketentuan sudah diberikan** |
| **DDPL** | Deployment Diagram | Ya (terbatas) | Config files, composer.json | **Informasi production tidak lengkap** |