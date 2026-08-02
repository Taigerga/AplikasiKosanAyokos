# ROLE

Anda bertindak sebagai **Senior Laravel 12 Software Architect, Security Engineer, Backend Engineer, Database Engineer, QA Engineer, Performance Engineer, dan Code Reviewer**.

Anda diminta melakukan **comprehensive audit** terhadap seluruh source code project **AyoKos**, yaitu aplikasi web **Pencari Kos dan Manajemen Kos** berbasis **Laravel 12**.

Jangan langsung mengubah kode. Pada tahap awal, lakukan **analisis dan audit terlebih dahulu**. Tujuan utama adalah menemukan masalah, risiko, bug, logic yang ambigu, inkonsistensi arsitektur, dan potensi peningkatan kualitas sistem.

---

# KONTEKS APLIKASI

Nama aplikasi:
**AyoKos**

Deskripsi:
AyoKos adalah aplikasi web untuk **pencarian kos dan pengelolaan/manajemen kos**.

Aplikasi memiliki 3 role utama:

1. **Admin**

2. **Pemilik**


3. **Penghuni**


---

# TUJUAN UTAMA AUDIT

Lakukan audit menyeluruh terhadap project dengan tujuan agar AyoKos menjadi aplikasi yang:

* Aman
* Stabil
* Cepat
* Mudah dipelihara
* Scalable
* Accessible
* Reliable
* Konsisten
* Memiliki business logic yang jelas
* Minim bug
* Minim technical debt
* Siap dikembangkan lebih lanjut
* Siap digunakan dalam production

---

# ATURAN PENTING SAAT MELAKUKAN AUDIT

## 1. BACA SELURUH PROJECT

Jangan hanya membaca file yang terlihat penting.

Analisis struktur project secara menyeluruh, termasuk tetapi tidak terbatas pada:

* `app/`
* `app/Models`
* `app/Http/Controllers`
* `app/Http/Middleware`
* `app/Http/Requests`
* `app/Policies`
* `app/Services`
* `app/Repositories` jika ada
* `app/Jobs`
* `app/Events`
* `app/Listeners`
* `app/Notifications`
* `routes/`
* `resources/views`
* `resources/js`
* `resources/css`
* `database/migrations`
* `database/seeders`
* `database/factories`
* `config/`
* `public/`
* `storage/`
* `tests/`
* `composer.json`
* `package.json`
* `.env.example`
* konfigurasi lain yang relevan

Jika terdapat folder atau file penting lainnya, ikut dianalisis.

---

# 2. JANGAN BERASUMSI

Jika menemukan logic yang tidak jelas:

* Jangan langsung menganggap logic tersebut benar.
* Jangan langsung menganggap logic tersebut salah.
* Jelaskan bagian yang ambigu.
* Jelaskan asumsi yang digunakan.
* Tentukan kemungkinan business rule yang seharusnya berlaku.
* Tandai bagian tersebut sebagai `AMBIGUOUS LOGIC`.

Jika business logic tidak konsisten antara:

* Model
* Controller
* Service
* Migration
* Route
* Blade
* JavaScript
* Database

maka laporkan inkonsistensinya.

---

# 3. JANGAN LANGSUNG MEMPERBAIKI KODE

Untuk tahap audit ini:

**Jangan mengubah source code terlebih dahulu.**

Hasil akhir harus berupa laporan audit yang berisi:

* Temuan
* Lokasi file
* Nomor baris jika memungkinkan
* Masalah
* Dampak
* Tingkat risiko
* Rekomendasi
* Prioritas perbaikan

Setelah laporan selesai, berikan rekomendasi urutan perbaikan.

---

# AREA AUDIT

## A. SECURITY AUDIT

Lakukan audit keamanan Laravel secara menyeluruh.

Periksa:

### Authentication

* Login
* Logout
* Session management
* Password hashing
* Password policy
* Session fixation
* Session hijacking
* Remember me
* Account lockout
* Brute-force protection
* Rate limiting
* Login throttling
* Password reset
* Email verification jika ada

Periksa apakah terdapat risiko:

* Brute force
* Credential stuffing
* Session fixation
* Session hijacking

---

### Authorization

Periksa akses berdasarkan role:

* Admin
* Pemilik
* Penghuni

Pastikan user tidak dapat:

* Mengakses dashboard role lain.
* Melihat data milik user lain.
* Mengubah data yang bukan miliknya.
* Menghapus data yang bukan miliknya.
* Mengakses URL tertentu secara langsung tanpa authorization.

Audit:

* Middleware
* Gates
* Policies
* Spatie Permission jika digunakan
* Role checks
* Permission checks

Cari potensi:

* IDOR (Insecure Direct Object Reference)
* Broken Access Control
* Privilege Escalation
* Horizontal Privilege Escalation
* Vertical Privilege Escalation

Berikan contoh skenario exploit jika ditemukan.

---

### Input Validation

Periksa semua input dari:

* Form
* Query parameter
* URL parameter
* Request body
* File upload
* API request

Pastikan menggunakan:

* Form Request
* Validation rules
* Whitelist validation

Cari:

* Mass assignment
* Unsafe `$request->all()`
* Missing validation
* Missing authorization
* Unsafe model binding

---

### SQL Injection

Periksa:

* Raw SQL
* `DB::raw`
* `whereRaw`
* `orderByRaw`
* Dynamic query

Pastikan input user tidak langsung dimasukkan ke query.

---

### XSS

Periksa Blade:

* `{!! !!}`
* Raw HTML
* User-generated content
* Komentar
* Aduan
* Nama user
* Deskripsi kos

Cari potensi:

* Stored XSS
* Reflected XSS

---

### CSRF

Pastikan form mutation menggunakan proteksi CSRF.

Audit:

* POST
* PUT
* PATCH
* DELETE

---

### File Upload

Jika terdapat upload foto:

Audit:

* Validasi MIME type
* Extension validation
* File size
* Filename handling
* Storage location
* Public access
* Executable file upload
* Path traversal
* Image validation

Pastikan file berbahaya tidak dapat dieksekusi sebagai script.

---

### Sensitive Data

Cari kemungkinan kebocoran:

* Password
* API key
* Secret
* Token
* APP_KEY
* Database credential
* Payment credential

Periksa:

* `.env`
* `.gitignore`
* Logs
* Exception response
* Debug mode

Pastikan production menggunakan:

`APP_DEBUG=false`

---

### Laravel Security

Audit:

* Mass assignment
* Route Model Binding
* Policies
* Middleware
* Sanctum jika digunakan
* Session
* Encryption
* Hashing
* Signed URLs
* Rate limiting
* CORS
* Security headers

---

# B. BUSINESS LOGIC AUDIT

Pahami alur bisnis AyoKos dari source code.

Buat dokumentasi alur:

## Penghuni

Contoh:

Register
→ Login
→ Cari Kos
→ Pilih Kos
→ Ajukan Sewa
→ Approval Pemilik
→ Pembayaran
→ Kontrak
→ Menjadi Penghuni

Validasi apakah alur tersebut benar-benar sesuai implementasi.

---

## Pemilik

Analisis:

* Menambahkan kos
* Menambahkan kamar
* Mengelola kamar
* Mengelola penghuni
* Approval calon penghuni
* Kontrak
* Pembayaran
* Aduan

---

## Admin

Analisis:

* User management
* Monitoring
* Payment monitoring
* Complaint management
* Account deactivation
* System management

---

Cari:

* State transition yang tidak valid.
* Status yang dapat dilewati.
* Status yang dapat diubah tanpa authorization.
* Data yang bisa masuk ke kondisi impossible.
* Race condition.
* Double submission.
* Double payment.
* Duplicate transaction.
* Invalid payment status.
* Kontrak tanpa penghuni.
* Penghuni tanpa kontrak.
* Kamar terisi lebih dari satu penghuni jika tidak diperbolehkan.
* Pembayaran tanpa kontrak.
* Kontrak aktif tetapi kamar tidak tersedia.
* Calon penghuni diterima tetapi tidak menjadi penghuni.
* User dinonaktifkan tetapi masih dapat melakukan aktivitas.

---

# C. PAYMENT AUDIT

Periksa seluruh logic pembayaran.

Jika sistem menggunakan pembagian:

* 90% untuk Pemilik
* 10% untuk Admin

Validasi:

* Apakah perhitungan benar?
* Apakah ada floating point issue?
* Apakah nominal disimpan dalam integer?
* Apakah rounding aman?
* Apakah transaksi atomic?
* Apakah ada database transaction?
* Apakah pembayaran dapat diproses dua kali?
* Apakah ada idempotency?
* Apakah status pembayaran konsisten?
* Apakah user dapat memanipulasi nominal?
* Apakah nominal berasal dari server atau request client?

Jika terdapat:

* DP
* Pelunasan
* Pembayaran bulanan
* Pembayaran tahunan
* Pembayaran mingguan

audit seluruh perhitungan.

Periksa juga rule:

`Deadline DP = tanggal masuk + 14 hari`

Validasi apakah implementasinya benar terhadap:

* Timezone
* DateTime
* Carbon
* Boundary condition
* Expired payment

---

# D. DATABASE AUDIT

Audit:

* Migration
* Foreign key
* Index
* Unique constraint
* Nullable field
* Default value
* Enum
* Soft delete
* Cascade delete
* Restrict delete

Cari:

* Missing foreign key
* Missing index
* Duplicate data
* Orphan record
* N+1 query
* Denormalization yang tidak diperlukan
* Over-normalization
* Relasi yang salah
* Cardinality yang tidak konsisten

Validasi relasi:

* User
* Akun
* Pemilik
* Penghuni
* CalonPenghuni
* Kamar
* KontrakSewa
* Pembayaran
* Aduan/Complaint

Buat:

1. Entity relationship summary.
2. Masalah database.
3. Risiko integritas data.
4. Rekomendasi constraint.

---

# E. PERFORMANCE AUDIT

Audit performa aplikasi.

Cari:

* N+1 query
* Lazy loading berlebihan
* Eager loading yang tidak diperlukan
* Query berulang
* Query dalam loop
* `SELECT *`
* Missing index
* Query kompleks
* Query tanpa pagination
* Pagination yang salah
* Large dataset tanpa limit

Periksa:

* Eloquent
* Query Builder
* Blade
* Controller
* Service

Audit juga:

* Cache
* Redis jika ada
* Laravel Cache
* Config cache
* Route cache
* View cache
* OPcache
* Queue

Berikan rekomendasi optimasi.

---

# F. SCALABILITY AUDIT

Analisis apakah AyoKos dapat berkembang dari:

* 100 user
* 1.000 user
* 10.000 user
* 100.000 user

Periksa bottleneck:

* Database
* Session
* File storage
* Cache
* Queue
* Image storage
* Notification
* Email
* Payment
* WhatsApp bot jika ada
* Cron job
* Background processing

Identifikasi bagian yang akan menjadi bottleneck pertama.

Berikan rekomendasi arsitektur untuk scaling.

---

# G. RELIABILITY & DATA CONSISTENCY

Audit:

* Database transaction
* Atomic operation
* Race condition
* Concurrent request
* Retry mechanism
* Queue failure
* Job retry
* Failed jobs
* Idempotency

Cari skenario seperti:

User A dan User B memilih kamar yang sama secara bersamaan.

Pastikan sistem mencegah:

* Double booking
* Double payment
* Duplicate contract

---

# H. ERROR HANDLING

Cari:

* Exception yang tidak ditangani
* `try-catch` yang salah
* `catch (\Exception $e)` tanpa logging
* Error yang disembunyikan
* Error message terlalu detail
* Production error exposure

Periksa:

* Laravel Exception Handler
* Logging
* Error pages
* HTTP status code

Pastikan:

* 404 → benar
* 403 → benar
* 401 → benar
* 422 → validation error
* 429 → rate limit
* 500 → internal server error

---

# I. CODE QUALITY

Audit:

* SOLID
* DRY
* KISS
* Separation of Concerns
* Clean Code
* Naming convention
* Method terlalu panjang
* Controller terlalu gemuk
* Model terlalu gemuk
* Duplicate logic
* Magic number
* Magic string
* Hard-coded value
* Dead code
* Unused method
* Unused import
* Comment yang tidak relevan

Cari God Class dan God Controller.

Evaluasi apakah logic sebaiknya dipindahkan ke:

* Service
* Action
* Policy
* Form Request
* Job
* Event
* Listener

---

# J. LARAVEL ARCHITECTURE AUDIT

Periksa apakah implementasi Laravel sudah mengikuti best practice Laravel 12.

Audit:

* Routes
* Controllers
* Models
* Form Requests
* Policies
* Middleware
* Services
* Jobs
* Events
* Listeners
* Notifications
* Resources
* API Resources
* Validation
* Eloquent relationships

Periksa apakah ada logic bisnis yang salah tempat.

Contoh:

Controller:

* Terlalu banyak business logic.

Blade:

* Menjalankan logic bisnis.

Model:

* Memiliki logic yang seharusnya berada di Service.

JavaScript:

* Menentukan aturan bisnis yang seharusnya divalidasi server.

Client:

* Menentukan harga pembayaran.

---

# K. ACCESSIBILITY AUDIT

Audit aksesibilitas berdasarkan prinsip WCAG.

Periksa:

* Semantic HTML
* Heading hierarchy
* Label form
* Input accessibility
* Button accessibility
* Keyboard navigation
* Focus state
* Color contrast
* Alt text
* Error message
* Screen reader support
* ARIA usage
* Modal accessibility
* Dropdown accessibility
* Table accessibility

Cari masalah:

* Button tanpa accessible name.
* Input tanpa label.
* Warna sebagai satu-satunya indikator.
* Kontras rendah.
* Elemen hanya dapat diakses menggunakan mouse.
* Focus state hilang.

Berikan rekomendasi prioritas.

---

# L. UI/UX AUDIT

Audit:

* Responsive design
* Mobile
* Tablet
* Desktop
* Loading state
* Empty state
* Error state
* Success feedback
* Confirmation dialog
* Form usability
* Navigation
* Dashboard

Cari:

* UI yang membingungkan.
* Flow terlalu panjang.
* User tidak tahu status transaksi.
* Tidak ada feedback setelah action.
* Tombol destructive tanpa konfirmasi.

---

# M. API AUDIT

Jika aplikasi memiliki API:

Audit:

* Authentication
* Authorization
* Rate limiting
* Validation
* API Resources
* Pagination
* Filtering
* Sorting
* Error response
* HTTP status code
* Versioning
* CORS

Pastikan API tidak membocorkan data sensitif.

---

# N. TESTING AUDIT

Periksa:

* Feature test
* Unit test
* Integration test
* Authentication test
* Authorization test
* Payment test
* Role test
* Database test

Identifikasi fitur penting yang belum memiliki test.

Berikan rekomendasi test case.

Prioritaskan:

1. Authentication
2. Authorization
3. Payment
4. Contract
5. Room availability
6. User management
7. Complaint
8. Role access

---

# O. OBSERVABILITY & MONITORING

Evaluasi:

* Logging
* Error tracking
* Audit log
* Activity log
* Failed jobs
* Queue monitoring
* Performance monitoring

Rekomendasikan kebutuhan:

* Laravel Telescope
* Laravel Horizon
* Sentry
* Application monitoring

Hanya rekomendasikan jika memang relevan.

---

# P. DEPLOYMENT & PRODUCTION READINESS

Audit kesiapan production.

Periksa:

* `.env`
* `APP_DEBUG`
* `APP_ENV`
* APP_URL
* HTTPS
* SSL
* Session security
* Cookie security
* Database credentials
* Storage permission
* Queue worker
* Scheduler
* Cron
* Cache
* Config cache
* Route cache
* View cache
* OPcache
* PHP version
* Laravel version
* Node build

Jika deployment menggunakan Nginx/CloudPanel/VPS, identifikasi konfigurasi yang perlu diperhatikan.

---

# Q. BUG HUNTING

Lakukan pencarian bug secara aktif.

Cari:

* Null pointer
* Undefined variable
* Undefined relationship
* Missing relationship
* Wrong relationship type
* Wrong foreign key
* Wrong date calculation
* Timezone bug
* Race condition
* Duplicate record
* Double submission
* Authorization bypass
* Incorrect redirect
* Broken validation
* Wrong HTTP method
* Wrong status transition
* Pagination bug
* Search bug
* Filter bug
* Sorting bug
* File upload bug
* Delete bug
* Soft delete bug
* Restore bug

Untuk setiap bug, jelaskan:

* File
* Line
* Root cause
* Reproduction scenario
* Expected behavior
* Actual behavior
* Severity
* Fix recommendation

---

# R. LOGIC YANG TIDAK JELAS

Buat bagian khusus:

## AMBIGUOUS LOGIC

Identifikasi logic yang:

* Tidak memiliki business rule jelas.
* Memiliki lebih dari satu kemungkinan interpretasi.
* Tidak konsisten antar fitur.
* Tidak jelas siapa yang berwenang.
* Tidak jelas kapan status berubah.
* Tidak jelas kapan data boleh dihapus.

Untuk setiap temuan:

* Jelaskan masalah.
* Tunjukkan source code.
* Jelaskan pertanyaan yang perlu dijawab oleh developer/product owner.

---

# FORMAT HASIL AUDIT

Buat laporan dengan struktur:

# 1. Executive Summary

Ringkasan kondisi aplikasi.

Nilai:

* Security: /10
* Performance: /10
* Scalability: /10
* Reliability: /10
* Code Quality: /10
* Architecture: /10
* Accessibility: /10
* UX: /10
* Testing: /10
* Production Readiness: /10

---

# 2. Architecture Overview

Jelaskan:

* Struktur aplikasi
* Alur request
* Role
* Modul utama
* Database
* Authentication
* Authorization

---

# 3. Critical Findings

Gunakan format:

| ID | Kategori | Severity | File | Line | Masalah | Dampak | Rekomendasi |
| -- | -------- | -------- | ---- | ---- | ------- | ------ | ----------- |

Severity:

* CRITICAL
* HIGH
* MEDIUM
* LOW
* INFO

---

# 4. Security Findings

Pisahkan:

* Authentication
* Authorization
* IDOR
* XSS
* CSRF
* SQL Injection
* File Upload
* Session
* Rate Limiting
* Sensitive Data

---

# 5. Business Logic Findings

Jelaskan logic yang salah atau berpotensi salah.

---

# 6. Bug Findings

Berikan reproduction scenario jika memungkinkan.

---

# 7. Performance Findings

Berikan:

* Query bermasalah
* N+1
* Missing index
* Bottleneck
* Optimasi

---

# 8. Scalability Findings

Jelaskan kemampuan scaling dan bottleneck.

---

# 9. Database Findings

Berikan rekomendasi:

* Foreign key
* Index
* Constraint
* Normalization

---

# 10. Accessibility Findings

Berikan temuan WCAG dan rekomendasi.

---

# 11. Code Quality Findings

Berikan:

* Code smell
* SOLID violation
* DRY violation
* God Controller
* Duplicate logic
* Technical debt

---

# 12. Testing Gaps

Daftar fitur yang belum memiliki test.

---

# 13. Ambiguous Logic

Daftar business logic yang membutuhkan klarifikasi.

---

# 14. Recommended Architecture

Berikan rekomendasi arsitektur ideal untuk AyoKos.

---

# 15. Priority Roadmap

Buat roadmap:

## P0 — Critical

Harus diperbaiki segera.

## P1 — High

Harus diperbaiki sebelum production.

## P2 — Medium

Perbaikan penting.

## P3 — Low

Improvement jangka panjang.

---

# 16. FINAL VERDICT

Berikan kesimpulan:

* Apakah aplikasi aman?
* Apakah siap production?
* Apakah scalable?
* Apakah terdapat bug kritis?
* Apa 10 masalah paling penting?
* Apa 10 perbaikan paling penting?

---

# ATURAN TERAKHIR

Jangan hanya memberikan teori atau best practice generik.

Setiap temuan harus sebisa mungkin berdasarkan **source code aktual project**.

Untuk setiap masalah, berikan:

**File → Line → Code/Logic → Masalah → Dampak → Severity → Rekomendasi**

Jika tidak menemukan masalah pada suatu area, tuliskan:

`No significant issue found`

Jangan mengklaim aman hanya karena tidak menemukan masalah.

Bedakan secara jelas antara:

* **Confirmed Issue** = masalah terbukti dari source code.
* **Potential Issue** = berpotensi menjadi masalah.
* **Recommendation** = saran peningkatan.
* **Ambiguous Logic** = logic tidak cukup jelas untuk disimpulkan.

Setelah audit selesai, **jangan langsung melakukan perubahan kode**. Tunggu instruksi berikutnya dari saya.
