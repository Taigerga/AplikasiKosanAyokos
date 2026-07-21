# TUGAS: ANALISIS DAN PENGEMBANGAN FITUR WEB AYOKOS

## 1. KONTEKS PROYEK

Saya sedang mengembangkan aplikasi web **AyoKos**, yaitu platform **pencarian kos dan manajemen kos**.

Sistem AyoKos memiliki 3 stakeholder utama yang masing-masing memiliki dashboard dan hak akses berbeda:

1. **Admin**
2. **Pemilik Kos**
3. **Penghuni**

Sebelum melakukan perubahan atau menambahkan fitur apa pun, Anda **WAJIB membaca, memahami, dan menganalisis terlebih dahulu seluruh struktur proyek yang relevan**.

Jangan langsung melakukan coding sebelum memahami arsitektur dan alur sistem yang sudah berjalan.

---

# 2. TAHAP 1 — ANALISIS SISTEM YANG SUDAH ADA

Sebelum melakukan implementasi, lakukan analisis terhadap project AyoKos secara menyeluruh.

## A. Analisis Struktur Folder dan Arsitektur

Baca dan pahami:

- Struktur folder project.
- Framework dan versi yang digunakan.
- Arsitektur aplikasi.
- Routing.
- Controller.
- Model.
- Migration.
- Seeder.
- Middleware.
- Policy/Gate jika ada.
- Service/Repository jika digunakan.
- Event/Listener jika digunakan.
- Notification jika digunakan.
- Queue/Job jika digunakan.
- API jika tersedia.
- Frontend/UI.
- Dashboard Admin.
- Dashboard Pemilik.
- Dashboard Penghuni.
- Sistem autentikasi.
- Sistem role dan permission.
- Sistem upload dan penyimpanan file.
- Sistem pembayaran yang sudah ada.
- Sistem notifikasi yang sudah ada.

Jangan hanya membaca nama file. Baca isi kode yang relevan untuk memahami hubungan antarfitur.

---

## B. Analisis Database

Baca dan pahami seluruh struktur database yang berhubungan dengan fitur yang akan dikembangkan, termasuk:

- Tabel user/akun.
- Tabel role dan permission.
- Tabel Pemilik.
- Tabel Penghuni.
- Tabel kos.
- Tabel kamar.
- Tabel registrasi/pengajuan penghuni.
- Tabel kontrak/sewa.
- Tabel pembayaran.
- Tabel transaksi.
- Tabel notifikasi.
- Tabel file/media jika ada.
- Tabel lain yang berhubungan.

Analisis:

- Primary key.
- Foreign key.
- Relasi antar tabel.
- One-to-One.
- One-to-Many.
- Many-to-Many.
- Status/status transition.
- Soft delete jika ada.
- Audit trail jika ada.

Sebelum membuat tabel baru, pastikan tidak ada tabel atau struktur yang sebenarnya sudah dapat digunakan kembali.

---

# 3. TAHAP 2 — PAHAMI ALUR BISNIS YANG SUDAH BERJALAN

Pelajari dan dokumentasikan terlebih dahulu alur bisnis AyoKos yang sudah ada.

Khususnya pahami alur:

## Alur Registrasi Penghuni ke Kos

Contoh:

1. Calon Penghuni mencari kos.
2. Calon Penghuni memilih Kos Bagus.
3. Calon Penghuni melakukan registrasi/pengajuan untuk menempati kos.
4. Pengajuan menunggu persetujuan Pemilik Kos.
5. Pemilik Kos menyetujui atau menolak pengajuan.
6. Jika disetujui, Penghuni dapat melakukan pembayaran kos.
7. Pembayaran dapat dilakukan berdasarkan periode yang didukung sistem, misalnya:
   - Mingguan.
   - Bulanan.
   - Tahunan.
8. Setelah pembayaran berhasil, sistem mencatat transaksi pembayaran.
9. Sistem harus mencatat pembagian dana antara Pemilik Kos dan Admin.

**Catatan penting:**

Jangan mengubah alur bisnis yang sudah berjalan secara sembarangan. Pertahankan kompatibilitas dengan fitur lama dan integrasikan fitur baru ke dalam alur yang sudah ada.

---

# 4. FITUR 1 — SISTEM ADUAN/PENGADUAN

Tambahkan fitur **Aduan/Pengaduan** yang dapat digunakan oleh:

- Pemilik Kos.
- Penghuni.

Tujuan fitur ini adalah agar Pemilik maupun Penghuni dapat melaporkan masalah atau menyampaikan aduan kepada Admin.

## A. Pengajuan Aduan

Pemilik dan Penghuni dapat membuat aduan melalui dashboard masing-masing.

Form aduan minimal memiliki:

- Judul aduan.
- Kategori aduan.
- Deskripsi/isi aduan.
- Foto/lampiran jika diperlukan.
- Status aduan.
- Waktu pengajuan.

Kategori aduan dapat disesuaikan dengan kebutuhan sistem, misalnya:

- Masalah fasilitas kos.
- Masalah pembayaran.
- Masalah akun.
- Masalah transaksi.
- Masalah pengguna.
- Pelanggaran aturan.
- Masalah teknis aplikasi.
- Lainnya.

Jangan membuat kategori secara berlebihan jika sistem sudah memiliki kategori yang relevan. Sesuaikan dengan struktur aplikasi yang sudah ada.

---

## B. Sistem Komentar/Discussion pada Aduan

Setiap aduan harus memiliki fitur komunikasi antara pelapor dan Admin dalam bentuk komentar atau percakapan.

Komentar dapat berisi:

- Teks.
- Foto/lampiran.

Contoh alur:

1. Penghuni membuat aduan.
2. Penghuni menulis deskripsi masalah.
3. Penghuni dapat melampirkan foto sebagai bukti.
4. Admin menerima aduan.
5. Admin memberikan komentar/tanggapan.
6. Penghuni dapat membalas komentar Admin.
7. Admin dapat memberikan komentar lanjutan.
8. Percakapan tersimpan sebagai riwayat aduan.

Jika diperlukan, gunakan konsep **threaded discussion/comment** agar seluruh komunikasi terkait satu masalah tetap berada dalam satu aduan.

---

## C. Status Aduan

Sistem harus memiliki status aduan yang jelas.

Contoh status:

- `Diajukan`
- `Dalam Peninjauan`
- `Diproses`
- `Menunggu Informasi`
- `Selesai`
- `Ditolak`
- `Ditutup`

Sesuaikan status dengan arsitektur sistem yang sudah ada.

Admin harus dapat mengubah status aduan.

Ketika status berubah, tampilkan riwayat/status yang jelas agar pelapor mengetahui perkembangan aduannya.

---

## D. Dashboard Admin — Manajemen Aduan

Tambahkan halaman khusus pada Dashboard Admin untuk mengelola aduan.

Admin dapat:

- Melihat seluruh aduan.
- Melihat detail aduan.
- Mengetahui pengirim aduan.
- Mengetahui apakah aduan berasal dari Pemilik atau Penghuni.
- Melihat foto/lampiran.
- Membaca seluruh komentar.
- Membalas komentar.
- Mengubah status aduan.
- Melihat riwayat aduan.
- Melakukan pencarian.
- Melakukan filter berdasarkan:
  - Status.
  - Kategori.
  - Pengirim.
  - Role pengirim.
  - Tanggal.

---

# 5. FITUR 2 — SISTEM PEMBAYARAN DAN PEMBAGIAN PENDAPATAN

Integrasikan sistem pembayaran yang sudah ada dengan mekanisme pembagian pendapatan.

Saat Penghuni melakukan pembayaran kos, sistem harus mencatat transaksi pembayaran dan melakukan pencatatan pembagian dana.

Pembagian pendapatan:

- **90% untuk Pemilik Kos**
- **10% untuk Admin/platform AyoKos**

Contoh:

Jika Penghuni membayar:

**Rp1.000.000**

Maka:

- Pendapatan Pemilik Kos = Rp900.000
- Pendapatan Admin/AyoKos = Rp100.000

Gunakan istilah yang baku dan sesuai konteks sistem, misalnya:

- Total Pembayaran.
- Bagian Pemilik Kos.
- Pendapatan Platform.
- Komisi Platform.
- Pembagian Pendapatan.
- Status Pembayaran.
- Status Pembagian Dana.
- Riwayat Transaksi.

---

## A. Pencatatan Transaksi

Setiap pembayaran yang berhasil harus memiliki data transaksi yang jelas.

Minimal mencatat:

- ID transaksi.
- Penghuni.
- Pemilik Kos.
- Kos.
- Kamar jika relevan.
- Kontrak sewa jika relevan.
- Jumlah pembayaran.
- Periode pembayaran.
- Tanggal pembayaran.
- Metode pembayaran.
- Status pembayaran.
- Nominal bagian Pemilik Kos.
- Nominal bagian Admin/AyoKos.
- Waktu transaksi.

Pastikan struktur ini menyesuaikan database dan sistem pembayaran yang sudah ada.

**Jangan membuat sistem pembayaran baru jika sistem pembayaran sudah tersedia. Integrasikan fitur pembagian pendapatan ke sistem pembayaran yang sudah berjalan.**

---

## B. Dashboard Admin — Keuangan dan Transaksi

Tambahkan fitur pada Dashboard Admin untuk memantau transaksi dan pendapatan platform.

Gunakan istilah yang sesuai, misalnya:

### "Keuangan Platform"

atau

### "Transaksi dan Pendapatan"

Admin dapat melihat:

- Total transaksi.
- Total nilai pembayaran.
- Total pendapatan Pemilik Kos.
- Total pendapatan AyoKos.
- Total komisi platform.
- Jumlah transaksi berhasil.
- Jumlah transaksi pending.
- Jumlah transaksi gagal.
- Riwayat transaksi.

Tambahkan filter berdasarkan:

- Tanggal.
- Bulan.
- Tahun.
- Status pembayaran.
- Pemilik Kos.
- Kos.
- Periode pembayaran.

Jika memungkinkan, tambahkan ringkasan statistik pada dashboard Admin.

Contoh:

- Total Pendapatan Platform.
- Total Transaksi.
- Transaksi Berhasil.
- Transaksi Pending.
- Transaksi Gagal.

---

# 6. FITUR 3 — PENONAKTIFAN DAN PEMBATASAN AKUN

Tambahkan fitur untuk Admin agar dapat melakukan tindakan terhadap akun pengguna yang bermasalah.

Target pengguna:

- Pemilik Kos.
- Penghuni.

Admin dapat melakukan:

- Menonaktifkan akun.
- Mengaktifkan kembali akun.
- Membatasi akses akun.
- Memberikan alasan penonaktifan/pembatasan.

Jika sistem membutuhkan tingkat pembatasan yang lebih detail, gunakan status akun seperti:

- `Aktif`
- `Dinonaktifkan`
- `Dibatasi`
- `Ditangguhkan`
- `Diblokir`

Gunakan struktur yang paling sesuai dengan sistem yang sudah ada. Jangan menambahkan terlalu banyak status jika tidak diperlukan.

---

# 7. PERILAKU AKUN PEMILIK YANG DINONAKTIFKAN/DIBATASI

Jika akun Pemilik Kos dinonaktifkan atau dibatasi, sistem harus menerapkan pembatasan sesuai status akun.

Contoh:

### Saat Pemilik Kos dinonaktifkan:

- Tidak dapat menggunakan fitur tertentu pada dashboard.
- Kos miliknya tidak ditampilkan dalam hasil pencarian publik.
- Kos miliknya tidak dapat menerima pendaftaran baru.
- Tidak dapat menerima transaksi baru jika sesuai aturan bisnis.
- Tidak dapat melakukan aktivitas yang seharusnya tidak boleh dilakukan oleh akun yang dinonaktifkan.
- Admin tetap dapat melihat data dan riwayat Pemilik tersebut.

Perhatikan bahwa data lama **tidak boleh langsung dihapus** hanya karena akun dinonaktifkan.

Data historis seperti:

- Kos.
- Kamar.
- Kontrak.
- Penghuni.
- Pembayaran.
- Transaksi.

Harus tetap tersimpan untuk kebutuhan administrasi, audit, dan riwayat transaksi.

---

# 8. PERILAKU AKUN PENGHUNI YANG DINONAKTIFKAN/DIBATASI

Jika akun Penghuni dinonaktifkan atau dibatasi:

- Penghuni tidak dapat menggunakan fitur yang membutuhkan akun aktif.
- Penghuni hanya dapat melihat data yang diizinkan oleh sistem.
- Penghuni tidak dapat melakukan transaksi baru jika status akun tidak mengizinkan.
- Penghuni tidak dapat melakukan pendaftaran baru ke kos lain.
- Penghuni tidak dapat menggunakan fitur yang berpotensi mengubah data penting.
- Data historis Penghuni tetap tersimpan.
- Riwayat pembayaran dan kontrak tetap dapat diakses sesuai kebijakan sistem.

Contoh:

Jika akun Penghuni berstatus `Dibatasi`, Penghuni hanya dapat:

- Login.
- Melihat dashboard.
- Melihat informasi akun.
- Melihat riwayat kontrak.
- Melihat riwayat pembayaran.
- Melihat status aduan.

Namun tidak dapat melakukan aktivitas tertentu yang dibatasi.

Sesuaikan pembatasan dengan struktur dan fitur AyoKos yang sudah ada.

---

# 9. PERILAKU SAAT LOGIN

Implementasikan pemeriksaan status akun saat proses login dan/atau saat mengakses fitur.

Jangan hanya menyembunyikan tombol di frontend.

Validasi harus diterapkan pada backend menggunakan mekanisme yang sesuai, misalnya:

- Middleware.
- Policy.
- Gate.
- Authorization.
- Service layer.

Pastikan pengguna yang akunnya dibatasi tidak dapat melewati pembatasan hanya dengan mengakses URL secara langsung.

Contoh:

Jika Pemilik memiliki status akun `Dibatasi`, maka:

- Login tetap dapat dilakukan jika kebijakan sistem mengizinkan.
- Sistem menampilkan informasi bahwa akun sedang dibatasi.
- Fitur yang tidak diizinkan harus ditolak oleh backend.
- Frontend juga harus menyesuaikan tampilan fitur yang tersedia.

Jika akun `Dinonaktifkan` atau `Diblokir` dan kebijakan sistem mengharuskan pengguna tidak dapat login, maka:

- Login harus ditolak.
- Tampilkan pesan yang informatif.
- Jelaskan bahwa akun telah dinonaktifkan/diblokir.
- Jika memungkinkan, arahkan pengguna untuk menghubungi Admin melalui fitur Aduan atau mekanisme bantuan yang tersedia.

---

# 10. DASHBOARD ADMIN — MANAJEMEN PENGGUNA

Tambahkan atau sesuaikan fitur Admin untuk mengelola status akun pengguna.

Admin dapat:

- Melihat daftar Pemilik.
- Melihat daftar Penghuni.
- Melihat status akun.
- Melihat detail pengguna.
- Menonaktifkan akun.
- Mengaktifkan kembali akun.
- Membatasi akun.
- Membuka pembatasan akun.
- Melihat alasan penonaktifan/pembatasan.
- Melihat waktu perubahan status.
- Melihat Admin yang melakukan perubahan jika sistem memiliki audit trail.

Sediakan konfirmasi sebelum Admin melakukan tindakan yang berdampak pada akun.

---

# 11. NOTIFIKASI

Jika sistem AyoKos sudah memiliki sistem notifikasi, integrasikan fitur baru ke dalam sistem tersebut.

Pertimbangkan notifikasi untuk:

### Aduan

- Aduan berhasil dibuat.
- Admin membalas aduan.
- Ada komentar baru.
- Status aduan berubah.

### Pembayaran

- Pembayaran berhasil.
- Pembayaran gagal.
- Pembayaran diproses.
- Transaksi tercatat.

### Status Akun

- Akun dinonaktifkan.
- Akun dibatasi.
- Akun diaktifkan kembali.
- Pembatasan akun dicabut.

Gunakan sistem notifikasi yang sudah tersedia jika ada.

---

# 12. KEAMANAN DAN OTORISASI

Pastikan setiap fitur mengikuti Role-Based Access Control (RBAC) yang sudah digunakan oleh AyoKos.

Aturan dasar:

### Admin

Dapat:

- Mengelola aduan.
- Melihat transaksi.
- Melihat pendapatan platform.
- Mengelola status akun.
- Melihat data pengguna.
- Mengelola data administratif sesuai permission.

### Pemilik

Dapat:

- Membuat aduan.
- Melihat aduan miliknya.
- Berkomentar pada aduannya.
- Mengunggah foto/lampiran.
- Melihat data transaksi yang berkaitan dengan kos miliknya sesuai hak akses.

### Penghuni

Dapat:

- Membuat aduan.
- Melihat aduan miliknya.
- Berkomentar pada aduannya.
- Mengunggah foto/lampiran.
- Melakukan pembayaran jika akun dan status registrasinya memenuhi syarat.
- Melihat riwayat pembayaran miliknya.

Pastikan:

- Pemilik tidak dapat melihat aduan pribadi Penghuni lain.
- Penghuni tidak dapat melihat aduan Penghuni lain.
- Pengguna tidak dapat mengakses transaksi milik pengguna lain.
- Pengguna tidak dapat mengubah status akun sendiri.
- Pengguna tidak dapat mengubah pembagian pendapatan.
- Hanya Admin yang memiliki hak untuk mengubah status akun pengguna.

Semua pembatasan harus diterapkan di backend, bukan hanya pada tampilan frontend.

---

# 13. ATURAN PENTING IMPLEMENTASI

Sebelum coding:

1. Baca seluruh struktur project.
2. Identifikasi framework dan versi.
3. Identifikasi arsitektur aplikasi.
4. Identifikasi database dan relasi.
5. Identifikasi alur autentikasi.
6. Identifikasi sistem role/permission.
7. Identifikasi sistem pembayaran yang sudah ada.
8. Identifikasi sistem upload file/media yang sudah ada.
9. Identifikasi sistem notifikasi yang sudah ada.
10. Identifikasi dashboard Admin, Pemilik, dan Penghuni.
11. Identifikasi fitur yang sudah tersedia dan dapat digunakan kembali.
12. Identifikasi potensi konflik dengan fitur lama.

Setelah itu buat analisis terlebih dahulu sebelum melakukan implementasi.

---

# 14. OUTPUT ANALISIS SEBELUM IMPLEMENTASI

Sebelum mengubah kode, berikan laporan analisis yang berisi:

## A. Struktur Sistem Saat Ini

Jelaskan:

- Framework.
- Arsitektur.
- Struktur frontend.
- Struktur backend.
- Sistem autentikasi.
- Sistem role/permission.

## B. Struktur Database Saat Ini

Jelaskan tabel dan relasi yang berkaitan dengan:

- User.
- Pemilik.
- Penghuni.
- Kos.
- Kamar.
- Registrasi.
- Kontrak.
- Pembayaran.
- Transaksi.

## C. Fitur yang Sudah Tersedia

Identifikasi fitur yang dapat digunakan kembali.

## D. Perubahan Database yang Dibutuhkan

Jelaskan:

- Tabel baru.
- Kolom baru.
- Relasi baru.
- Migration yang diperlukan.

Jangan membuat perubahan database yang tidak diperlukan.

## E. Perubahan Backend

Jelaskan:

- Model.
- Controller.
- Service.
- Middleware.
- Policy.
- Route.
- Validation.
- Notification.

## F. Perubahan Frontend

Jelaskan halaman dan komponen yang perlu ditambahkan atau diubah pada:

- Dashboard Admin.
- Dashboard Pemilik.
- Dashboard Penghuni.

## G. Dampak terhadap Fitur Lama

Identifikasi risiko perubahan terhadap:

- Registrasi Penghuni.
- Persetujuan Pemilik.
- Kontrak sewa.
- Pembayaran.
- Pencarian kos.
- Manajemen kos.
- Hak akses.

---

# 15. IMPLEMENTASI

Setelah analisis selesai, implementasikan fitur secara bertahap.

Urutan yang disarankan:

1. Database dan migration.
2. Model dan relasi.
3. Enum/status jika diperlukan.
4. Service/business logic.
5. Authorization dan permission.
6. Backend/controller.
7. Route.
8. Upload foto/lampiran.
9. Sistem aduan dan komentar.
10. Sistem transaksi dan pembagian pendapatan.
11. Sistem status akun dan pembatasan akses.
12. Dashboard Admin.
13. Dashboard Pemilik.
14. Dashboard Penghuni.
15. Notifikasi.
16. Validasi.
17. Testing.

Jangan merusak fitur lama yang sudah berjalan.

---

# 16. TESTING DAN VALIDASI

Setelah implementasi, lakukan pengujian menyeluruh.

Minimal uji:

### Aduan

- Pemilik membuat aduan.
- Penghuni membuat aduan.
- Upload foto.
- Admin melihat aduan.
- Admin membalas aduan.
- Pengguna membalas komentar.
- Perubahan status aduan.

### Pembayaran

- Penghuni melakukan pembayaran setelah disetujui Pemilik.
- Pembayaran berhasil.
- Pembayaran gagal.
- Perhitungan 90% Pemilik.
- Perhitungan 10% Admin.
- Transaksi tercatat di Dashboard Admin.

### Penonaktifan Akun

- Admin menonaktifkan Pemilik.
- Pemilik tidak dapat menggunakan fitur yang dibatasi.
- Kos Pemilik tidak muncul dalam pencarian sesuai aturan.
- Admin tetap dapat melihat data Pemilik.
- Admin mengaktifkan kembali Pemilik.

### Pembatasan Penghuni

- Admin membatasi Penghuni.
- Penghuni hanya dapat mengakses fitur yang diizinkan.
- Penghuni tidak dapat melakukan aktivitas yang dilarang.
- Admin dapat mengaktifkan kembali akun.

### Keamanan

- Coba akses URL secara langsung.
- Pastikan authorization backend tetap berjalan.
- Pastikan pengguna tidak dapat mengakses data pengguna lain.
- Pastikan pengguna tidak dapat memanipulasi status akun.
- Pastikan pengguna tidak dapat memanipulasi nominal pembagian pendapatan.

---

# 17. HASIL AKHIR YANG DIHARAPKAN

Tujuan akhir adalah mengembangkan AyoKos dengan 3 kelompok fitur utama:

1. **Sistem Aduan/Pengaduan** antara Pemilik/Penghuni dengan Admin yang mendukung komentar, teks, foto/lampiran, status, dan riwayat.
2. **Sistem Transaksi dan Pembagian Pendapatan** dengan skema 90% untuk Pemilik Kos dan 10% sebagai pendapatan/komisi platform AyoKos, serta dapat dipantau melalui Dashboard Admin.
3. **Sistem Manajemen Status Akun** untuk menonaktifkan, membatasi, mengaktifkan kembali, atau memblokir akun Pemilik/Penghuni dengan pembatasan akses yang diterapkan secara aman di backend.

Prioritaskan:

- Konsistensi dengan arsitektur kode yang sudah ada.
- Reuse kode dan tabel yang sudah tersedia.
- Keamanan.
- RBAC dan authorization.
- Integritas data.
- Konsistensi database.
- UX yang baik.
- Tidak merusak fitur lama.
- Tidak melakukan perubahan yang tidak diperlukan.

Jika terdapat keputusan teknis yang ambigu, **jangan langsung memilih implementasi yang berpotensi merusak sistem**. Identifikasi masalahnya, jelaskan pilihan yang tersedia, lalu pilih solusi yang paling konsisten dengan arsitektur AyoKos yang sudah ada.

Mulai dengan **ANALISIS SISTEM DAN DATABASE TERLEBIH DAHULU**, kemudian tampilkan hasil analisis sebelum masuk ke tahap implementasi.