# Rencana Perbaikan AyoKos

## 🔴 PRIORITAS TINGGI (Sprint 1)

| # | Item | Status | Alasan |
|---|------|--------|--------|
| 1 | **Forgot / Reset Password** | ❌ Belum | Security critical — tidak ada flow reset password sama sekali. User tidak bisa login kembali jika lupa password. |
| 2 | **Rate Limiting di Auth** | ❌ Belum | Tidak ada proteksi brute force di `/login` dan `/register` — riskan dictionary attack. |
| 3 | **Integrasi Midtrans Sandbox** | ❌ Belum | Core fitur pembayaran — endpoint callback sudah ada, tinggal disambungkan ke Snap Midtrans. |
| 4 | **Testing Coverage (min. 50%)** | ❌ Kurang (3/10) | Saat ini cuma ~19 test untuk 52+ controller. Testing wajib untuk nilai tugas dan menjamin fitur jalan. |
| 5 | **Email Verification** | ❌ Belum | Kolom `email_verified_at` sudah ada di DB tapi tidak dipakai. Perlu untuk memperkuat keamanan akun. |
| 6 | **Soft Deletes** | ❌ Belum | Semua hard delete — data hilang permanen. Risiko tinggi. |

## 🟡 PRIORITAS SEDANG (Sprint 2)

| # | Item | Status | Alasan |
|---|------|--------|--------|
| 7 | **Admin Web Dashboard** | ❌ Kurang | Admin cuma punya 1 view web + API saja — tidak praktis dikelola lewat browser. |
| 8 | **Export Report PDF/Excel** | ❌ Belum | `barryvdh/laravel-dompdf` sudah terinstall tapi tidak ada fitur export. |
| 9 | **Polish Mobile Friendly** | ⚠️ Perlu | Dashboard padat di layar kecil, optimasi `sm:` breakpoint masih kurang. |
| 10 | **Split Service Class Besar** | ⚠️ Perlu | `NotificationService` (600 baris), `PembayaranService` (340), `AnalisisService` (311) — perlu dipecah. |
| 11 | **Caching Strategy** | ❌ Belum | Cache driver `database` tidak digunakan sama sekali. |
| 12 | **API Documentation (Swagger)** | ❌ Belum | Tidak ada dokumentasi API — menyulitkan integrasi mobile. |

## 🔵 PRIORITAS RENDAH (Sprint 3+ / Optional)

| # | Item | Status | Alasan |
|---|------|--------|--------|
| 13 | **Fitur Wishlist / Favorit** | ❌ Belum | Penghuni tidak bisa bookmark kos favorit. |
| 14 | **Chat / Messaging** | ❌ Belum | Komunikasi penghuni-pemilik masih di luar platform. |
| 15 | **OAuth / Social Login** | ❌ Belum | Login via Google — nice to have. |
| 16 | **Search by Map Radius** | ❌ Belum | Filter geospasial di peta. |
| 17 | **Activity Log / Audit Trail** | ❌ Belum | Mencatat siapa melakukan apa. |
| 18 | **API Versioning** | ❌ Belum | `/api/v1/...` untuk backward compatibility. |
| 19 | **API Resources / Transformers** | ❌ Belum | Standarisasi response JSON. |
| 20 | **Type Declarations & Interfaces** | ❌ Belum | Return types, contract binding untuk services. |

---

*Dibuat: 7 Juni 2026*
