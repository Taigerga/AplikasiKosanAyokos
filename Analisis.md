# Prompt Analisis Menyeluruh Proyek Laravel 12 Ayokos (Aplikasi Pencari dan Manajemen Kos)

## Peran

Anda adalah **Senior Software Architect**, **Senior Laravel 12 Developer**, **UI/UX Expert**, **Web Security Specialist**, **Cloud Architect**, **Performance Engineer**, **Database Engineer**, **DevOps Engineer**, dan **Software Quality Assurance Lead** yang memiliki pengalaman lebih dari 15 tahun dalam membangun aplikasi SaaS berbasis Laravel.

Tugas Anda adalah melakukan **audit menyeluruh (Full Project Audit)** terhadap project Laravel 12 saya bernama **Ayokos**, yaitu aplikasi SaaS untuk pencarian kos dan manajemen kos.

Jangan langsung memberikan saran tanpa terlebih dahulu membaca seluruh source code.

---

# Tujuan

Lakukan analisis secara menyeluruh terhadap seluruh project dan hasilkan laporan profesional mengenai:

- Apa saja fitur yang sudah selesai.
- Apa saja fitur yang belum selesai.
- Apa saja fitur yang masih setengah jadi.
- Apa saja yang perlu diperbaiki.
- Apa saja yang perlu ditambahkan.
- Apa saja yang dapat dioptimalkan.
- Prioritas pengerjaan berdasarkan tingkat urgensi.

Saya ingin mengetahui kondisi project secara objektif seolah-olah project ini sedang diaudit sebelum dipublikasikan ke production.

---

# Instruksi Penting

## WAJIB membaca seluruh project terlebih dahulu.

Jangan hanya membaca folder:

- resources/views
- resources/js

Tetapi baca SEMUA folder project termasuk:

```
app/
bootstrap/
config/
database/
lang/
public/
resources/
routes/
storage/
tests/
vendor (jika diperlukan)
```

Selain itu baca seluruh:

- Controller
- Model
- Migration
- Seeder
- Factory
- Middleware
- Service
- Repository
- Policy
- Gate
- Observer
- Request Validation
- Event
- Listener
- Notification
- Mail
- Queue
- Job
- Exception Handler
- API Resource
- Helper
- Trait
- Command
- Schedule
- Config
- Blade
- JavaScript
- CSS
- Tailwind
- Vite
- Routes
- API
- Web
- Storage
- Environment Configuration
- Composer
- Package.json

Jangan memberikan kesimpulan sebelum seluruh project dipahami.

---

# Pahami Sistem Terlebih Dahulu

Identifikasi:

- Arsitektur project
- Struktur folder
- Flow aplikasi
- Role pengguna
- Hak akses
- Modul
- Relasi database
- Alur bisnis
- API
- Middleware
- Authentication
- Authorization

Kemudian jelaskan bagaimana seluruh sistem bekerja.

---

# Analisis Fitur

Buat daftar seluruh fitur yang ada.

Contoh:

## Sudah selesai

✔ Login

✔ Register

✔ Cari Kos

✔ Detail Kos

✔ Dashboard Admin

✔ Dashboard Penghuni

dll

---

## Masih Belum Ada / Belum dibuat sama sekali

Contoh:

Dashboard Admin

Misal fitur belum ada 
- Monitoring Admin
- Dashboard analytics Admin
- Dan yang lainnya

Jelaskan dengan rinci bagian mana yang belum selesai.

---


# Analisis Dashboard

Analisis setiap dashboard.

Misalnya:

## Dashboard Admin

Apa saja fitur yang tersedia.

Apa yang kurang.

Apa yang perlu ditambahkan.

---


# Analisis UI / UX

Lakukan audit UI/UX secara menyeluruh.

Periksa:

- Layout
- Konsistensi
- Warna
- Typography
- White space
- Icon
- Button
- Form
- Navbar
- Sidebar
- Dashboard
- Card
- Modal
- Dialog
- Toast
- Alert
- Loading
- Skeleton
- Empty State
- Error State

---

## Mobile Friendly

Audit secara khusus apakah UI sudah benar-benar responsif.

Periksa:

- Smartphone
- Tablet
- Desktop

Cari halaman yang:

- Overflow
- Pecah
- Horizontal Scroll
- Button terlalu kecil
- Form terlalu sempit
- Font terlalu kecil
- Sidebar bermasalah
- Navbar rusak
- Card tidak responsive

Jika ada, sebutkan file yang bermasalah.

Berikan rekomendasi perbaikannya.

---

# Audit Berdasarkan 8 Golden Rules of Interface Design (Ben Shneiderman)

Evaluasi apakah aplikasi telah memenuhi prinsip-prinsip berikut:

## 1. Strive for Consistency

- Konsistensi warna
- Konsistensi ikon
- Konsistensi tombol
- Konsistensi navigasi
- Konsistensi istilah
- Konsistensi layout

Berikan nilai dan penjelasan.

---

## 2. Enable Frequent Users to Use Shortcuts

Periksa apakah aplikasi menyediakan shortcut atau efisiensi untuk pengguna yang sering menggunakan sistem, misalnya:

- Keyboard shortcut
- Pencarian cepat
- Filter cepat
- Bulk action
- Auto-complete
- Default value
- Quick navigation
- Command palette
- Shortcut dashboard

Jika belum ada, berikan rekomendasi.

---

## 3. Offer Informative Feedback

Periksa apakah aplikasi selalu memberikan feedback kepada pengguna seperti:

- Loading indicator
- Progress bar
- Success message
- Warning
- Error message
- Toast notification
- Status proses
- Feedback setelah submit

Nilai apakah feedback sudah cukup informatif.

---

## 4. Design Dialogs to Yield Closure

Evaluasi apakah setiap proses memiliki penutupan yang jelas, misalnya:

- Konfirmasi berhasil
- Ringkasan hasil
- Halaman sukses
- Redirect yang tepat
- Pesan setelah aksi selesai

Jelaskan bagian yang masih kurang.

---

## 5. Offer Simple Error Handling

Periksa bagaimana aplikasi menangani kesalahan:

- Validasi form
- Error server
- Error API
- Error autentikasi
- Error database
- Error jaringan
- Pesan error yang mudah dipahami
- Penanganan exception

Berikan rekomendasi agar pengguna dapat memperbaiki kesalahan dengan mudah.

---

## 6. Permit Easy Reversal for Actions

Evaluasi apakah aplikasi menyediakan cara membatalkan atau mengembalikan tindakan, seperti:

- Undo
- Cancel
- Konfirmasi sebelum hapus
- Soft delete
- Restore data
- Batalkan transaksi
- Edit setelah submit

Jelaskan fitur yang sudah ada dan yang masih kurang.

---

## 7. Support Internal Locus of Control

Pastikan pengguna merasa memiliki kendali terhadap sistem, misalnya:

- Navigasi yang jelas
- Tidak ada proses yang membingungkan
- Pengguna bebas memilih tindakan
- Tidak ada aksi otomatis yang mengejutkan
- Kontrol penuh terhadap data

Berikan evaluasi.

---

## 8. Reduce Short-Term Memory Load

Periksa apakah aplikasi membantu mengurangi beban ingatan pengguna, seperti:

- Breadcrumb
- Label yang jelas
- Placeholder informatif
- Default value
- Auto-fill
- Riwayat pencarian
- Navigasi konsisten
- Informasi kontekstual

Berikan penilaian.

---

# Audit Keamanan (Security Audit)

Analisis keamanan Laravel secara mendalam.

Periksa apakah project telah menerapkan:

## Authentication

- Login aman
- Logout
- Session
- Remember Me
- Email Verification
- Password Reset

---

## Authorization

- Role
- Permission
- Middleware
- Gate
- Policy

---

## Validasi

Pastikan seluruh input menggunakan:

- Form Request Validation
- Rule Validation
- Sanitasi Input

Cari endpoint yang belum divalidasi.

---

## SQL Injection

Periksa apakah masih ada query raw yang berpotensi SQL Injection.

---

## XSS

Periksa:

- Blade escaping
- {!! !!}
- InnerHTML
- Javascript Injection

---

## CSRF

Pastikan seluruh form telah menggunakan CSRF Protection.

---

## File Upload

Audit:

- Validasi mime
- Validasi ukuran
- Rename file
- Penyimpanan aman
- Pencegahan executable upload

---

## Password

Periksa:

- Hash
- Rehash
- Password policy

---

## Session Security

Periksa:

- Secure Cookie
- HttpOnly
- SameSite
- Session Timeout
- Session Fixation

---

## API Security

Audit:

- Sanctum
- Token
- Authentication
- Authorization
- Expired Token
- Revocation

---

## Rate Limiting

Periksa apakah project telah menerapkan pembatasan terhadap:

- Login
- Register
- Forgot Password
- OTP
- API Endpoint
- Upload
- Pencarian

Jika belum ada, rekomendasikan implementasi menggunakan Laravel Rate Limiter.

Contoh rekomendasi:

- Maksimal 3 kali login gagal.
- Setelah itu akun/IP harus menunggu sekitar 30 detik sebelum dapat mencoba kembali (silakan sesuaikan waktu terbaik berdasarkan praktik keamanan dan pengalaman pengguna).
- Terapkan progressive delay jika diperlukan.
- Gunakan pesan error yang informatif tanpa membocorkan informasi sensitif.

---

## Headers

Periksa apakah sudah menggunakan:

- CSP
- HSTS
- X-Frame
- XSS Protection
- Referrer Policy
- Permissions Policy

---

## Logging

Periksa apakah logging sudah cukup baik.

---

# Audit Performa

Audit performa secara menyeluruh.

Periksa:

- N+1 Query
- Lazy Loading
- Eager Loading
- Cache
- Route Cache
- Config Cache
- View Cache
- Query Optimization
- Pagination
- Index Database
- Queue
- Lazy Collection
- Redis
- OPcache
- Compression
- Image Optimization
- Asset Optimization
- Vite Build
- Bundle Size
- Code Splitting

Berikan rekomendasi lengkap.

---

# Audit Skalabilitas

Evaluasi apakah project siap berkembang.

Periksa:

- Modular Architecture
- Service Layer
- Repository Pattern
- Queue
- Event Driven
- Cache
- CDN
- Load Balancer
- Horizontal Scaling
- Vertical Scaling
- Database Optimization
- Read Replica
- Storage
- SaaS Readiness
- Multi Tenant Readiness

---

# Audit Database

Periksa:

- Struktur tabel
- Normalisasi
- Foreign Key
- Cascade
- Index
- Constraint
- Migration
- Seeder

---

# Audit API

Periksa:

- RESTful
- Status Code
- Resource
- Versioning
- Pagination
- Filtering
- Sorting
- Error Response
- Validation

---

# Audit Kualitas Kode

Evaluasi:

- SOLID
- DRY
- KISS
- Clean Code
- Naming Convention
- PSR
- Laravel Best Practice
- Dependency Injection
- Type Hint
- Return Type
- Reusable Component
- Service Class
- Repository
- Helper
- Trait

---

# Audit Testing

Periksa apakah project memiliki:

- Unit Test
- Feature Test
- Integration Test
- Browser Test
- API Test

Jika belum ada, rekomendasikan.

---

# Audit SEO (Jika Relevan)

Periksa:

- Meta
- Open Graph
- Sitemap
- Robots
- Canonical
- Structured Data

---

# Audit Accessibility

Periksa:

- Kontras warna
- Keyboard Navigation
- Alt Image
- ARIA
- Screen Reader
- Focus Indicator

---

# Audit DevOps

Periksa:

- Environment
- CI/CD
- Docker
- Backup
- Scheduler
- Queue Worker
- Monitoring
- Log Rotation

---

# Prioritas Perbaikan

Di akhir laporan, buat tabel prioritas seperti berikut:

| Prioritas | Temuan | Dampak | Rekomendasi |
|----------|--------|---------|-------------|
| Sangat Tinggi | ... | ... | ... |
| Tinggi | ... | ... | ... |
| Sedang | ... | ... | ... |
| Rendah | ... | ... | ... |

---

# Checklist

Buat checklist seperti berikut.

| Item | Status | Keterangan |
|------|--------|------------|
| Authentication | ✅ / ⚠️ / ❌ | ... |
| Authorization | | |
| Dashboard Admin | | |
| Dashboard Pemilik | | |
| Dashboard Penghuni | | |
| Responsive UI | | |
| Rate Limiting | | |
| API Security | | |
| Validation | | |
| Queue | | |
| Cache | | |
| Logging | | |
| Performance | | |
| Scalability | | |
| Accessibility | | |
| Testing | | |
| Clean Code | | |
| SOLID | | |
| DRY | | |
| Laravel Best Practice | | |

---

# Format Laporan

Gunakan format berikut:

1. Ringkasan Project
2. Arsitektur Sistem
3. Analisis Struktur Kode
4. Daftar Fitur yang Sudah Ada
5. Daftar Fitur yang Belum Ada
6. Daftar Fitur yang Masih Setengah Jadi
7. Audit Dashboard
8. Audit UI/UX
9. Evaluasi 8 Golden Rules
10. Audit Keamanan
11. Audit API
12. Audit Database
13. Audit Performa
14. Audit Skalabilitas
15. Audit Kualitas Kode
16. Audit Testing
17. Audit Accessibility
18. Audit DevOps
19. Rekomendasi Perbaikan
20. Roadmap Pengembangan (Jangka Pendek, Menengah, Panjang)
21. Prioritas Pengerjaan
22. Checklist Kesiapan Produksi (Production Readiness)

---

# Aturan Jawaban

- Jangan berasumsi.
- Jangan mengarang fitur yang tidak ada.
- Selalu sertakan bukti berupa lokasi file, class, method, route, atau potongan kode yang relevan.
- Jelaskan alasan teknis untuk setiap temuan.
- Bedakan dengan jelas antara **sudah diterapkan**, **diterapkan sebagian**, dan **belum diterapkan**.
- Untuk setiap kekurangan, berikan solusi yang mengikuti best practice Laravel 12, PHP modern, OWASP Top 10, prinsip Clean Architecture, dan praktik pengembangan SaaS yang siap digunakan di lingkungan production.