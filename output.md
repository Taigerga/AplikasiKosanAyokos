# ANALISIS KOMPUTASI AWAN PADA APLIKASI SISTEM INFORMASI MANAJEMEN KOS BERBASIS WEB (AYOKOS)

---

# BAB I: ANALISIS FITUR SISTEM

## 1.1 Fitur Pemilik Kos

Berdasarkan analisis source code pada direktori `app/Http/Controllers/API/Pemilik/`, `app/Http/Controllers/Web/Pemilik/`, dan `app/Services/`, berikut adalah seluruh fitur yang telah tersedia untuk role Pemilik Kos:

### 1.1.1 Dashboard Pemilik

**Controller:** `PemilikDashboardController` (API) dan `DashboardController` (Web)

Fitur dashboard menyajikan ringkasan data bisnis pemilik secara real-time melalui endpoint:
- `GET /api/pemilik/dashboard` — Statistik utama: total kos, total kamar, kamar tersedia, jumlah penghuni aktif
- `GET /api/pemilik/dashboard/stats/kos` — Statistik per kos (jumlah kamar, kamar terisi, pendapatan)
- `GET /api/pemilik/dashboard/pendapatan/{tahun?}` — Grafik pendapatan bulanan sepanjang tahun
- `GET /api/pemilik/dashboard/aktivitas` — Aktivitas terbaru (pembayaran masuk, pengajuan kontrak baru)

**Service:** `AnalisisService::getPemilikDashboardStats()` dan `AnalisisService::getPendapatanTahunan()`

Dashboard ini memberikan gambaran menyeluruh tentang kondisi bisnis kos yang dikelola, memungkinkan pemilik mengambil keputusan berbasis data.

### 1.1.2 Manajemen Kos

**Controller:** `PemilikKosController` (API) — full CRUD via `apiResource`

**Endpoint:**
- `GET /api/pemilik/kos` — Daftar kos milik pemilik, di-scope berdasarkan `id_pemilik`
- `POST /api/pemilik/kos` — Tambah kos baru (dengan validasi `StoreKosRequest`)
- `GET /api/pemilik/kos/{id}` — Detail kos
- `PUT /api/pemilik/kos/{id}` — Update data kos (`UpdateKosRequest`)
- `DELETE /api/pemilik/kos/{id}` — Hapus kos

**Service:** `KosService` — method `getOwnerKos()`, `createKos()`, `updateKos()`, `deleteKos()`

**FormRequest Validation:**
- `StoreKosRequest` — Validasi: `nama_kos` (required), `alamat` (required), `kecamatan` (required), `kota` (required), `provinsi` (required), `jenis_kos` (putra/putri/campuran), `tipe_sewa` (harian/mingguan/bulanan/tahunan), `foto` (image max 2MB), `fasilitas` (array)
- `UpdateKosRequest` — Sama dengan store, ditambah `status_kos` (aktif/nonaktif/pending)

**Fitur:** Pemilik dapat menambahkan, mengedit, melihat daftar, dan menghapus properti kos. Setiap kos memiliki alamat lengkap, koordinat geografis (latitude/longitude) untuk pemetaan, jenis kos, tipe sewa, dan status.

### 1.1.3 Manajemen Kamar

**Controller:** `PemilikKamarController` (API) — full CRUD via `apiResource`

**Endpoint:**
- `GET /api/pemilik/kamar` — Daftar kamar dengan statistik (total/tersedia/terisi/maintenance)
- `POST /api/pemilik/kamar` — Tambah kamar baru (`StoreKamarRequest`)
- `GET /api/pemilik/kamar/{id}` — Detail kamar
- `PUT /api/pemilik/kamar/{id}` — Update kamar (`UpdateKamarRequest`)
- `DELETE /api/pemilik/kamar/{id}` — Hapus kamar

**Service:** `KamarService` — method `getOwnerKamar()`, `createKamar()`, `updateKamar()`, `deleteKamar()`

**FormRequest Validation:** `StoreKamarRequest` — `id_kos` (required, exists), `nomor_kamar` (required, unique per kos), `tipe_kamar` (Standar/Deluxe/VIP/Superior/Ekonomi), `harga` (required, numeric), `luas`, `kapasitas`, `fasilitas_kamar` (array), `foto` (image), `status_kamar`

**Fitur:** Pemilik dapat mengelola kamar per kos dengan nomor unik, tipe kamar, harga sewa, luas, kapasitas, dan fasilitas. Nomor kamar dipastikan unik dalam satu kos melalui method `isNomorKamarUnique()`.

### 1.1.4 Manajemen Fasilitas Kos

**Controller:** `KosFasilitasController` (API) — CRUD untuk pivot `kos_fasilitas`

**Endpoint:**
- `GET /api/kos-fasilitas` — Daftar fasilitas per kos
- `GET /api/kos-fasilitas/kos/{idKos}` — Fasilitas spesifik berdasarkan kos
- `POST /api/kos-fasilitas` — Tambah fasilitas ke kos (`StoreKosFasilitasRequest`)
- `PUT /api/kos-fasilitas/{id}` — Update jumlah/keterangan fasilitas
- `DELETE /api/kos-fasilitas/{id}` — Hapus fasilitas dari kos

**Service:** `KosService` (via method `getAllFasilitas()` untuk data master fasilitas)

**Relasi:** Many-to-Many antara `Kos` dan `Fasilitas` melalui tabel pivot `kos_fasilitas`. Model `KosFasilitas` extends Pivot.

**Fitur:** Pemilik dapat memilih fasilitas dari master data (kategori: umum, kamar_mandi, dapur, parkir, keamanan, lainnya) dan menetapkannya ke kos dengan jumlah serta keterangan. Fasilitas yang tersedia: 48+ jenis (AC, WiFi, Kasur, Lemari, Kamar Mandi Dalam, Parkir Motor, CCTV, dll).

### 1.1.5 Pengaturan Kos

**Controller:** `PengaturanKosController` (API) — CRUD

**Endpoint:**
- `GET /api/pengaturan-kos` — Daftar pengaturan
- `GET /api/pengaturan-kos/kos/{idKos}` — Pengaturan spesifik per kos
- `POST /api/pengaturan-kos` — Tambah pengaturan (`StorePengaturanKosRequest`)
- `PUT /api/pengaturan-kos/{id}` — Update pengaturan (`UpdatePengaturanKosRequest`)
- `DELETE /api/pengaturan-kos/{id}` — Hapus pengaturan

**Service:** Terintegrasi via `KosService` dan controller langsung ke model `PengaturanKos`

**Relasi:** One-to-One antara `Kos` dan `PengaturanKos`

**Fitur:** Pemilik dapat mengatur aturan check-in/check-out, jam bertamu, kebijakan pembatalan untuk setiap kos. ID kos bersifat unique pada tabel pengaturan (satu kos hanya punya satu pengaturan).

### 1.1.6 Foto Kos

**Controller:** `FotoKosController` (API)

**Endpoint:**
- `GET /api/foto-kos` — Semua foto
- `GET /api/foto-kos/kos/{idKos}` — Foto per kos
- `POST /api/foto-kos` — Upload foto kos
- `DELETE /api/foto-kos/{id}` — Hapus foto kos

**Service:** `FotoKosService` — method `getAll()`, `getByKos()`, `getById()`, `create()`, `delete()`

**Fitur:** Pemilik dapat mengupload dan menghapus foto properti kos untuk memperkaya halaman detail kos. Foto disimpan di direktori `storage/app/public/kos/` dan diakses melalui rute `/storage/kos/{filename}`.

### 1.1.7 Manajemen Kontrak Sewa

**Controller:** `PemilikKontrakController` (API)

**Endpoint:**
- `GET /api/pemilik/kontrak` — Daftar kontrak dengan filter status (pending/aktif/selesai/ditolak)
- `GET /api/pemilik/kontrak/{id}` — Detail kontrak termasuk data penghuni, kos, kamar, dan riwayat pembayaran
- `POST /api/pemilik/kontrak/{id}/approve` — Menyetujui kontrak
- `POST /api/pemilik/kontrak/{id}/reject` — Menolak kontrak
- `POST /api/pemilik/kontrak/{id}/selesai` — Menandai kontrak selesai
- `DELETE /api/pemilik/kontrak/{id}` — Hapus kontrak (hanya untuk status selesai/ditolak)

**Service:** `KontrakService` — method kompleks:

**Approve Kontrak (`approveKontrak()`):**
1. Update `status_kontrak` menjadi `aktif`
2. Update `status_penghuni` menjadi `aktif`
3. Update `status_kamar` menjadi `terisi`
4. Tolak otomatis kontrak pending lain untuk kamar yang sama
5. Kirim notifikasi email + in-app ke penghuni dan pemilik

**Reject Kontrak (`rejectKontrak()`):**
1. Update `status_kontrak` menjadi `ditolak` dengan alasan
2. Hapus pembayaran deposit yang pending
3. Kembalikan status kamar ke `tersedia`
4. Kirim notifikasi email + in-app

**Selesai Kontrak (`selesaiKontrak()`):**
1. Update `status_kontrak` menjadi `selesai`
2. Opsional nonaktifkan penghuni
3. Kembalikan status kamar ke `tersedia`

**Fitur:** Pemilik memiliki kontrol penuh atas siklus hidup kontrak sewa — dari penerimaan pengajuan hingga penyelesaian. Setiap aksi memicu notifikasi otomatis dan update status terkait.

### 1.1.8 Manajemen Pembayaran

**Controller:** `PemilikPembayaranController` (API)

**Endpoint:**
- `GET /api/pemilik/pembayaran` — Daftar pembayaran dengan statistik status (lunas/belum/terlambat/pending)
- `POST /api/pemilik/pembayaran/{id}/approve` — Verifikasi dan setujui pembayaran
- `POST /api/pemilik/pembayaran/{id}/reject` — Tolak pembayaran

**Service:** `PembayaranService`

**Approve Pembayaran (`approvePembayaran()`):**
1. Set `status_pembayaran = 'lunas'`, catat tanggal bayar
2. Jika pembayaran pertama (`tanggal_mulai` kontrak masih null): set tanggal mulai dan selesai kontrak
3. Jika pembayaran berikutnya: perpanjang `tanggal_selesai` kontrak
4. Kirim notifikasi persetujuan

**Reject Pembayaran (`rejectPembayaran()`):**
1. Set `status_pembayaran = 'belum'`
2. Kirim notifikasi penolakan

**Fitur:** Pemilik dapat memverifikasi bukti pembayaran yang diupload penghuni, menyetujui atau menolaknya. Persetujuan pembayaran secara otomatis memperpanjang masa kontrak penghuni.

### 1.1.9 Review & Rating

**Controller:** `PemilikReviewController` (API)

**Endpoint:**
- `GET /api/pemilik/reviews` — Daftar review untuk semua kos milik pemilik, mencakup rata-rata rating dan review terbaru

**Service:** `ReviewService::getPemilikReviews()`

**Fitur:** Pemilik dapat memantau rating dan ulasan yang diberikan penghuni untuk setiap properti kos mereka. Data ini membantu pemilik mengevaluasi kualitas layanan.

### 1.1.10 Analisis Bisnis

**Controller:** `PemilikAnalisisController` (API)

**Endpoint:**
- `GET /api/pemilik/analisis` — Analisis komprehensif

**Service:** `AnalisisService::getPemilikAnalisis()` — menghasilkan:
1. **Pendapatan per bulan** — Tren pendapatan sepanjang tahun
2. **Status kamar** — Jumlah terisi vs tersedia vs maintenance
3. **Tipe kos** — Distribusi putra/putri/campuran
4. **Status kontrak** — pending/aktif/selesai/ditolak
5. **Penghuni per kos** — Jumlah penghuni aktif per properti
6. **Tipe kamar** — Distribusi tipe kamar yang disewa
7. **Distribusi rating** — Persentase rating 1-5
8. **Pendapatan per kos** — Properti dengan pendapatan tertinggi

**Fitur:** Dashboard analitik yang memberikan wawasan bisnis mendalam bagi pemilik untuk mengoptimalkan strategi pricing dan manajemen properti.

### 1.1.11 Manajemen Profil

**Controller:** `PemilikProfileController` (API)

**Endpoint:**
- `GET /api/pemilik/profile` — Tampilkan data profil (dengan statistik kos, kamar, rating)
- `PUT /api/pemilik/profile/update` — Update data profil (`UpdatePemilikProfileRequest`)
- `POST /api/pemilik/profile/upload-photo` — Upload foto profil
- `POST /api/pemilik/profile/change-password` — Ganti password (`ChangePasswordRequest`)

**Service:** `ProfileService` — method `getPemilikProfileData()`, `updatePemilik()`, `uploadPhotoPemilik()`, `changePassword()`

**Fitur:** Pemilik dapat mengelola data diri, foto profil, informasi bank (nama bank, nomor rekening), dan keamanan akun.

---

## 1.2 Fitur Penghuni

Berdasarkan analisis source code pada direktori `app/Http/Controllers/API/Penghuni/`, `app/Http/Controllers/Web/Penghuni/`, dan `app/Services/`, berikut fitur untuk role Penghuni:

### 1.2.1 Dashboard Penghuni

**Controller:** `PenghuniDashboardController` (API)

**Endpoint:**
- `GET /api/penghuni/dashboard` — Statistik dashboard: kontrak aktif dengan progress bar, pembayaran terbaru, total pengeluaran
- `GET /api/penghuni/dashboard/notifikasi-tenggat` — Notifikasi tenggat waktu sewa (menghitung sisa hari)

**Service:** `AnalisisService::getPenghuniDashboardStats()`

**Fitur:** Penghuni dapat melihat status kontrak aktif, berapa lama masa sewa tersisa, riwayat pembayaran, dan pengingat tenggat waktu.

### 1.2.2 Pencarian & Eksplorasi Kos

**Controller:** `PenghuniKontrakController` (via endpoint `cari-kos`) dan `Public/KosController`

**Endpoint:**
- `GET /api/penghuni/cari-kos` — Pencarian kos dengan filter
- `GET /api/public/kos` — Daftar kos publik dengan filter
- `GET /api/public/kos/{id}` — Detail kos lengkap dengan kamar tersedia, fasilitas, review, dan foto
- `GET /api/public/peta` — Data kos untuk ditampilkan di peta interaktif

**Service:** `KosService::getPublicKosWithFilters()` — mendukung filter:
- Pencarian teks (nama, alamat, kota, kecamatan)
- Filter jenis kos (putra/putri/campuran)
- Filter kota
- Filter tipe sewa
- Filter ketersediaan kamar
- Range harga
- Filter rating minimum
- Filter fasilitas (multiple)
- Sorting (termurah, termahal, rating tertinggi, terbaru)

**Fitur:** Penghuni dapat mencari kos dengan berbagai kriteria, melihat detail properti termasuk kamar yang tersedia, fasilitas, review, dan lokasi di peta.

### 1.2.3 Pengajuan Kontrak Sewa

**Controller:** `PenghuniKontrakController` (API)

**Endpoint:**
- `GET /api/penghuni/kontrak` — Daftar kontrak milik penghuni
- `GET /api/penghuni/kontrak/{id}` — Detail kontrak
- `GET /api/penghuni/kontrak/create/{kosId}` — Data form untuk pengajuan baru
- `POST /api/penghuni/kontrak` — Buat pengajuan kontrak baru (`StoreKontrakRequest`)

**Service:** `KontrakService::createKontrak()`

**Alur Pengajuan:**
1. Penghuni memilih kamar yang tersedia dari detail kos
2. Mengisi formulir: upload foto KTP, tanggal mulai sewa, durasi sewa
3. Sistem menghitung tanggal selesai berdasarkan tipe sewa (harian/mingguan/bulanan/tahunan)
4. Kontrak dibuat dengan status `pending`
5. Notifikasi dikirim ke pemilik (pengajuan baru) dan penghuni (menunggu persetujuan)

**FormRequest Validation:** `StoreKontrakRequest` — `id_kos` (required), `id_kamar` (required, exists, tersedia), `foto_ktp` (required, image), `durasi_sewa` (required, numeric), `tanggal_mulai` (required, date, >= hari ini)

**Fitur:** Penghuni dapat mengajukan sewa kamar secara online dengan upload KTP, memilih durasi, dan menunggu persetujuan pemilik.

### 1.2.4 Pembayaran Sewa

**Controller:** `PenghuniPembayaranController` (API)

**Endpoint:**
- `GET /api/penghuni/pembayaran` — Daftar pembayaran milik penghuni (terkait kontrak aktif)
- `GET /api/penghuni/pembayaran/{id}` — Detail pembayaran
- `POST /api/penghuni/pembayaran` — Buat pembayaran baru (`StorePembayaranRequest`)

**Service:** `PembayaranService`

**Alur Pembayaran:**
1. Penghuni memilih kontrak aktif dan jumlah waktu yang akan dibayar
2. Sistem menghitung opsi pembayaran berdasarkan tipe sewa:
   - Harian: 1-7, 14, 30 hari (maks 365)
   - Mingguan: 1-12 minggu (maks 52)
   - Bulanan: 1-12 bulan (maks 12)
   - Tahunan: 1-5 tahun
3. Penghuni memilih metode (transfer/qris) dan upload bukti pembayaran
4. Sistem menentukan jenis pembayaran: `rutin` (dalam periode kontrak) atau `advance` (perpanjangan)
5. Pembayaran dibuat dengan status `pending`
6. Notifikasi dikirim ke pemilik dan penghuni

**FormRequest Validation:** `StorePembayaranRequest` — `id_kontrak` (required, exists), `jumlah_waktu` (required, numeric), `metode_pembayaran` (in: transfer/cash/qris), `bukti_pembayaran` (required, image, max 5MB)

**Fitur:** Penghuni dapat melakukan pembayaran sewa secara online dengan memilih periode pembayaran, metode pembayaran, dan mengupload bukti transfer.

### 1.2.5 Review Kos

**Controller:** `PenghuniReviewController` (API)

**Endpoint:**
- `GET /api/penghuni/reviews` — Daftar review milik penghuni
- `GET /api/penghuni/reviews/{review}` — Detail review
- `GET /api/penghuni/reviews/create/{kos}` — Data form review
- `GET /api/penghuni/reviews/history` — Riwayat review
- `POST /api/penghuni/reviews` — Buat review baru (`StoreReviewRequest`)
- `PUT /api/penghuni/reviews/{review}` — Update review (`UpdateReviewRequest`)
- `DELETE /api/penghuni/reviews/{review}` — Hapus review

**Service:** `ReviewService` — method `canReview()`, `createReview()`, `updateReview()`, `deleteReview()`

**Syarat Review:**
- `canReview()`: Penghuni harus memiliki kontrak yang sudah `aktif` atau `selesai` di kos tersebut
- Tidak boleh ada review duplikat (satu penghuni hanya bisa review satu kali per kos)
- Rating 1-5 (decimal), komentar 10-1000 karakter

**Fitur:** Penghuni dapat memberikan rating dan ulasan untuk kos yang pernah/telah mereka tempati, membantu penghuni lain dalam memilih kos.

### 1.2.6 Analisis Pengeluaran

**Controller:** `PenghuniAnalisisController` (API)

**Endpoint:**
- `GET /api/penghuni/analisis` — Analisis umum
- `GET /api/penghuni/analisis/spending` — Analisis pengeluaran detail

**Service:** `AnalisisService::getPenghuniAnalisis()` dan `getPenghuniSpendingAnalysis()`

**Output Analisis:**
1. **Riwayat kontrak** — Timeline kontrak yang pernah dibuat
2. **Pembayaran bulanan** — Tren pembayaran per bulan
3. **Status pembayaran** — Persentase lunas vs terlambat vs pending
4. **Kategori durasi** — Distribusi durasi sewa
5. **Preferensi tipe kos** — putra/putri/campuran
6. **Preferensi tipe kamar** — Standar/Deluxe/VIP/Superior/Ekonomi
7. **Statistik review** — Rata-rata rating yang diberikan
8. **Pengeluaran bulanan** — Grafik pengeluaran sewa
9. **Tren harga** — Perbandingan harga antar kos

**Fitur:** Penghuni dapat memonitor pola pengeluaran sewa, melihat riwayat kontrak dan pembayaran, serta menganalisis preferensi tempat tinggal mereka.

### 1.2.7 Manajemen Profil

**Controller:** `PenghuniProfileController` (API)

**Endpoint:**
- `GET /api/penghuni/profile` — Tampilkan data profil (dengan kontrak aktif, review, pembayaran)
- `PUT /api/penghuni/profile/update` — Update data profil (`UpdatePenghuniProfileRequest`)
- `POST /api/penghuni/profile/upload-photo` — Upload foto profil
- `POST /api/penghuni/profile/change-password` — Ganti password (`ChangePasswordRequest`)

**Service:** `ProfileService` — method `getPenghuniProfileData()`, `updatePenghuni()`, `uploadPhotoPenghuni()`, `changePassword()`

**Fitur:** Penghuni dapat mengelola data diri, foto profil, informasi bank, dan keamanan akun.

---

## 1.3 Fitur Admin

### 1.3.1 Kondisi Saat Ini

Berdasarkan source code pada `app/Http/Controllers/API/Admin/` dan `app/Http/Controllers/Web/Admin/`, fitur Admin yang sudah tersedia masih terbatas pada:

| Controller | Endpoint | Fungsi |
|---|---|---|
| `AdminDashboardController` | `GET /api/admin/dashboard` | Statistik dasar dashboard |
| `PemilikController` | `GET/POST /api/admin/data-pemilik` | CRUD data pemilik |
| `PemilikController` | `GET/PUT/DELETE /api/admin/data-pemilik/{id}` | CRUD detail pemilik |
| `PenghuniController` | `GET/POST /api/admin/data-penghuni` | CRUD data penghuni |
| `PenghuniController` | `GET/PUT/DELETE /api/admin/data-penghuni/{id}` | CRUD detail penghuni |
| `KontrakSewaController` | `GET /api/admin/data-kontrak` | Read-only daftar kontrak |
| `KontrakSewaController` | `GET /api/admin/data-kontrak/{id}` | Read-only detail kontrak |
| `PembayaranController` | `GET /api/admin/data-pembayaran` | Read-only daftar pembayaran |
| `PembayaranController` | `GET /api/admin/data-pembayaran/{id}` | Read-only detail pembayaran |
| `AdminController` | `GET/POST /api/admin/admin-users` | CRUD admin users |
| `AdminController` | `GET/PUT/DELETE /api/admin/admin-users/{id}` | CRUD detail admin user |

Web Controller: `DashboardController` di `Web/Admin/` — hanya satu halaman dashboard sederhana.

### 1.3.2 Analisis Kebutuhan Fitur Admin

Berdasarkan arsitektur SaaS dan skala sistem, berikut fitur Admin yang seharusnya dikembangkan:

#### A. Dashboard Monitoring Sistem (Prioritas: Tinggi)

**Tujuan:** Memberikan gambaran real-time tentang kesehatan sistem, aktivitas pengguna, dan metrik bisnis utama.

**Fitur yang diusulkan:**
- Grafik jumlah pengguna aktif (pemilik/penghuni) per hari/minggu/bulan
- Total properti kos terdaftar (aktif/nonaktif/pending)
- Total transaksi pembayaran hari ini/bulan ini
- Pendapatan platform (jika ada biaya layanan)
- Jumlah kontrak aktif
- Notifikasi sistem (error logs, queue failures)
- Peta sebaran kos di seluruh kota

**Manfaat:**
- Memantau pertumbuhan platform secara real-time
- Deteksi dini masalah sistem
- Pengambilan keputusan strategis berbasis data
- Evaluasi performa bisnis secara keseluruhan

**Hubungan SaaS:** Dashboard multi-tenant adalah fitur wajib bagi penyedia SaaS untuk memonitor penggunaan resource oleh seluruh tenant.

#### B. Manajemen User (Prioritas: Tinggi)

**Tujuan:** Mengelola seluruh akun pengguna (pemilik, penghuni, admin) dari satu panel terpusat.

**Fitur yang diusulkan:**
- Tabel daftar user dengan filter: role, status, tanggal daftar, verifikasi email
- Search dan sorting berdasarkan nama, username, email
- Lihat detail user: data profil, riwayat kontrak, riwayat pembayaran, riwayat login
- Edit data user (bantuan teknis)
- Nonaktifkan / aktifkan akun
- Hapus akun (dengan konfirmasi dan cascading)

**Manfaat:**
- Kemudahan administrasi pengguna
- Penanganan laporan masalah akun
- Kontrol atas akun yang melanggar aturan
- Audit trail aktivitas pengguna

**Hubungan SaaS:** Manajemen user terpusat penting untuk customer support dan compliance.

#### C. Verifikasi Pemilik Kos (Prioritas: Tinggi)

**Tujuan:** Memastikan bahwa setiap pemilik kos yang terdaftar adalah pihak yang sah dan terverifikasi.

**Fitur yang diusulkan:**
- Daftar pemilik dengan status verifikasi (pending/terverifikasi/ditolak)
- Review dokumen: foto KTP, NPWP, SIUP/NIB, foto diri
- Sistem approval/rejection dengan catatan
- Notifikasi email ke pemilik saat status berubah
- Integrasi dengan pengaturan status_pemilik (aktif/nonaktif/pending) yang sudah ada di database

**Manfaat:**
- Meningkatkan kepercayaan penghuni
- Mencegah penipuan dan akun palsu
- Menjaga kualitas platform
- Kepatuhan terhadap regulasi

**Hubungan SaaS:** Verifikasi adalah komponen trust & safety yang krusial dalam platform marketplace.

#### D. Moderasi Data Kos (Prioritas: Sedang)

**Tujuan:** Memastikan data kos yang ditampilkan akurat, sesuai aturan, dan tidak mengandung konten yang tidak pantas.

**Fitur yang diusulkan:**
- Review daftar kos dengan status pending (kos baru menunggu moderasi)
- Lihat detail kos: foto, fasilitas, harga, deskripsi
- Setujui / tolak / minta revisi data kos
- Nonaktifkan kos yang melanggar aturan
- Riwayat moderasi per kos
- Flag otomatis untuk kos dengan data mencurigakan

**Manfaat:**
- Kontrol kualitas konten platform
- Perlindungan konsumen (penghuni)
- Kepatuhan terhadap standar platform
- Mencegah informasi palsu atau menyesatkan

**Hubungan SaaS:** Moderasi konten adalah tanggung jawab penyedia platform SaaS.

#### E. Monitoring Pembayaran (Prioritas: Sedang)

**Tujuan:** Memantau seluruh transaksi pembayaran yang terjadi di platform untuk memastikan tidak ada penyimpangan.

**Fitur yang diusulkan:**
- Tabel real-time seluruh transaksi pembayaran (dengan filter status, tanggal, metode)
- Detail transaksi: penghuni, pemilik, kos, jumlah, bukti bayar
- Flag transaksi mencurigakan (nominal tidak wajar, frekuensi tinggi)
- Rekonsiliasi pembayaran
- Export data pembayaran ke CSV/Excel
- Laporan pendapatan platform

**Manfaat:**
- Deteksi fraud dan transaksi mencurigakan
- Rekonsiliasi keuangan
- Transparansi platform
- Bahan laporan keuangan

**Hubungan SaaS:** Monitoring payment penting untuk sistem yang menangani transaksi keuangan antara pengguna.

#### F. Audit Log Aktivitas (Prioritas: Sedang)

**Tujuan:** Mencatat dan memantau seluruh aktivitas penting dalam sistem untuk keperluan keamanan dan audit.

**Fitur yang diusulkan:**
- Pencatatan otomatis untuk: login, logout, create/update/delete data sensitif, perubahan status kontrak, perubahan status pembayaran
- Tabel audit log dengan filter: user, aksi, entity, tanggal
- Detail log: IP address, user agent, timestamp, data sebelum/sesudah
- Export log
- Retensi dan purge otomatis

**Manfaat:**
- Investigasi insiden keamanan
- Pelacakan perubahan data
- Kepatuhan terhadap standar (ISO 27001, GDPR)
- Accountability pengguna

**Hubungan SaaS:** Audit log diperlukan untuk sertifikasi keamanan dan kepatuhan platform SaaS.

#### G. Statistik & Laporan Pengguna (Prioritas: Rendah - Sedang)

**Tujuan:** Menyediakan analisis mendalam tentang pertumbuhan dan perilaku pengguna.

**Fitur yang diusulkan:**
- Grafik pertumbuhan pengguna per bulan
- Demografi: sebaran kota, jenis kelamin, kelompok usia
- Rasio pemilik:penghuni
- Tingkat konversi pendaftaran → kontrak aktif
- Tingkat retensi penghuni
- Kos terpopuler (berdasarkan jumlah review/kontrak)
- Rate okupansi rata-rata seluruh kos

**Manfaat:**
- Evaluasi strategi pemasaran
- Identifikasi pasar potensial
- Pengembangan fitur yang sesuai kebutuhan
- Laporan investor/stakeholder

**Hubungan SaaS:** Data analytics adalah fitur advanced yang membedakan platform SaaS profesional.

#### H. Backup dan Restore Data (Prioritas: Tinggi)

**Tujuan:** Menjamin keamanan dan ketersediaan data melalui mekanisme backup otomatis.

**Fitur yang diusulkan:**
- Backup database terjadwal (harian/mingguan/bulanan)
- Backup file storage (foto, dokumen)
- Restore point dengan timestamp
- Download backup
- Monitoring status backup (sukses/gagal)
- Integrasi cloud storage (S3, Google Cloud Storage)

**Manfaat:**
- Pencegahan kehilangan data akibat disaster
- Recovery cepat saat terjadi kegagalan sistem
- Kepatuhan terhadap regulasi perlindungan data
- Kepercayaan pengguna terhadap platform

**Hubungan SaaS:** Backup automation adalah layanan fundamental yang harus dimiliki penyedia SaaS.

#### I. Monitoring Server (Prioritas: Tinggi)

**Tujuan:** Memantau kesehatan server dan infrastruktur untuk menjaga ketersediaan layanan.

**Fitur yang diusulkan:**
- CPU, RAM, disk usage real-time
- Response time API
- Uptime monitoring
- Alert otomatis (email/notifikasi) saat threshold terlampaui
- Log error dan exception
- Queue monitoring (jumlah job pending/failed)
- Integrasi dengan Laravel Pulse atau Telescope

**Manfaat:**
- Deteksi bottleneck performa
- Pencegahan downtime
- Capacity planning
- Root cause analysis saat incident

**Hubungan SaaS:** Server monitoring adalah kebutuhan operasional utama untuk menjaga SLA.

#### J. Pengelolaan Paket SaaS (Prioritas: Masa Depan)

**Tujuan:** Mengelola model bisnis subscription dengan berbagai tingkatan layanan.

**Fitur yang diusulkan:**
- CRUD paket langganan: nama, harga, fitur, batasan (jumlah kos, kamar, dll)
- Manajemen subscription pemilik: aktif/nonaktif, trial period, auto-renewal
- Pembatasan fitur berdasarkan paket (misal: pemilik gratis max 1 kos, premium unlimited)
- Integrasi payment gateway untuk subscription
- Invoice dan riwayat tagihan
- Upgrade/downgrade paket

**Manfaat:**
- Monetisasi platform
- Segmentasi pengguna berdasarkan kebutuhan
- Skalabilitas bisnis
- Model revenue berkelanjutan (recurring revenue)

**Hubungan SaaS:** Subscription management adalah inti dari model bisnis SaaS.

---

# BAB II: ANALISIS CLOUD COMPUTING

## 2.1 Konsep Sistem

### 2.1.1 Tujuan Aplikasi

AyoKos adalah Sistem Informasi Manajemen Kos berbasis web yang bertujuan untuk menghubungkan pemilik kos dengan pencari kos (penghuni) dalam satu platform terintegrasi. Aplikasi ini memfasilitasi seluruh siklus hidup penyewaan kos — mulai dari pencarian properti, pengajuan sewa, pembayaran, hingga review — secara digital dan paperless.

### 2.1.2 Permasalahan yang Diselesaikan

Berdasarkan analisis fitur, berikut permasalahan utama yang diselesaikan:

1. **Informasi Kos Tersebar**: Sebelumnya, pencarian kos dilakukan secara manual (brosur, dari mulut ke mulut, grup Facebook). AyoKos menyediakan direktori kos terpusat dengan filter lengkap, peta interaktif, dan informasi detail.

2. **Proses Sewa Manual & Tidak Terdokumentasi**: Proses sewa konvensional menggunakan kertas dan tidak memiliki sistem tracking. AyoKos mendigitalkan seluruh proses: pengajuan kontrak (upload KTP), approval pemilik, pembayaran online dengan bukti upload, hingga perpanjangan otomatis.

3. **Sulitnya Monitoring Pembayaran**: Pemilik kesulitan melacak siapa yang sudah/ belum bayar. Sistem menyediakan dashboard pembayaran dengan status (lunas/belum/terlambat/pending) dan jatuh tempo.

4. **Tidak Ada Sistem Review**: Penghuni tidak memiliki referensi kualitas kos. AyoKos menyediakan sistem rating dan review untuk membantu keputusan calon penghuni.

5. **Rendahnya Transparansi**: Pemilik tidak memiliki visibilitas terhadap performa bisnis mereka. AyoKos menyediakan dashboard analitik: pendapatan per bulan, tingkat okupansi, distribusi rating, dll.

### 2.1.3 Target Pengguna

| Role | Deskripsi | Kebutuhan Utama |
|---|---|---|
| **Pemilik Kos** | Individu atau badan yang memiliki properti kos | Mengelola properti, menerima penghuni, memantau pembayaran, analisis bisnis |
| **Penghuni** | Pencari kos (mahasiswa, pekerja, umum) | Mencari kos, mengajukan sewa, membayar sewa, memberi review |
| **Admin** | Pengelola platform | Memantau aktivitas, mengelola pengguna, moderasi konten, menjaga kestabilan sistem |

### 2.1.4 Alur Bisnis Utama

```
[Penghuni] → Cari Kos (filter, peta) → Lihat Detail → Ajukan Sewa (upload KTP)
       ↓
[Pemilik]  → Terima Notifikasi → Review Pengajuan → Approve / Reject
       ↓
[Penghuni] → Bayar Sewa (upload bukti) → Menunggu Verifikasi
       ↓
[Pemilik]  → Verifikasi Pembayaran → Approve → Kontrak Aktif
       ↓
[Penghuni] → Menempati Kos → Bayar Periodik → Review (setelah/selama sewa)
       ↓
[Pemilik]  → Monitoring Pembayaran → Perpanjangan / Selesai Kontrak
```

---

## 2.2 SaaS Analysis

### 2.2.1 Apakah AyoKos Dapat Dikategorikan sebagai SaaS?

**Ya**, AyoKos memenuhi kriteria sebagai **Software as a Service (SaaS)**. Berikut analisisnya:

### 2.2.2 Karakteristik SaaS yang Terpenuhi

#### A. Akses Melalui Browser (Thin Client)

**Terpenuhi.** Seluruh aplikasi diakses melalui web browser. Tidak ada instalasi perangkat lunak di sisi klien. Teknologi yang digunakan:
- Frontend: Blade templates + Tailwind CSS — fully server-rendered
- API: RESTful JSON — dapat dikonsumsi oleh aplikasi mobile/thin client
- Semua logika bisnis berjalan di server (Laravel backend)

#### B. Multi-Tenant Architecture

**Terpenuhi Sebagian.** Sistem menggunakan model **soft multi-tenancy** (owner-scoped):
- Satu database, satu tabel untuk semua tenant
- Isolasi data dilakukan di application layer melalui Eloquent scoping: setiap query pemilik menggunakan `where('id_pemilik', $pemilikId)`, setiap query penghuni menggunakan `where('id_penghuni', $penghuniId)`
- Setiap pengguna memiliki role (`admin`, `pemilik`, `penghuni`) yang menentukan scope akses data
- Tidak ada tenant_id column eksplisit — isolasi dilakukan melalui foreign key relationships

**Rekomendasi:** Untuk true multi-tenancy di masa depan, perlu ditambahkan column `tenant_id` dan implementasi global scope.

#### C. Centralized Management

**Terpenuhi.** Sistem memiliki:
- Satu codebase terpusat
- Admin panel untuk manajemen pengguna dan data
- Semua pembaruan dan maintenance dilakukan di sisi server
- Konfigurasi terpusat melalui file `.env` dan `config/`

#### D. Subscription-Based Pricing Model (Potensial)

**Belum Terpenuhi.** Saat ini sistem belum memiliki model subscription/pricing. Fitur ini direkomendasikan untuk tahap pengembangan berikutnya:
- Paket dasar (gratis): 1 kos, fitur terbatas
- Paket premium: unlimited kos, analitik lanjutan, prioritas support
- Paket enterprise: API akses, kustomisasi, dedicated support

#### E. Automatic Updates & Patch Management

**Terpenuhi.** Sebagai aplikasi web terpusat:
- Update fitur dan security patch cukup dilakukan sekali di server
- Semua pengguna langsung mendapatkan versi terbaru tanpa perlu update manual
- Dukungan Composer untuk dependency management
- Laravel memiliki sistem maintenance mode untuk deployment

#### F. Scalability

**Terpenuhi.** Arsitektur Laravel mendukung scaling horizontal:
- Database connection pooling
- Queue system (database driver, dapat diupgrade ke Redis)
- Cache system (database driver, dapat diupgrade ke Redis/Memcached)
- Session management (cookie driver, dapat diubah ke Redis/database)
- Vite untuk asset bundling dan cache busting

### 2.2.3 Cara Pengguna Menggunakan Layanan

1. **Pemilik Kos:**
   - Registrasi melalui web → verifikasi admin (manual)
   - Login → Dashboard → Tambah Kos → Tambah Kamar → Atur Fasilitas
   - Menerima notifikasi pengajuan → Review → Approve/Reject
   - Verifikasi pembayaran → Pantau pendapatan via dashboard analitik

2. **Penghuni:**
   - Registrasi → Login → Cari Kos (filter, peta)
   - Lihat detail → Pilih kamar → Ajukan Sewa (upload KTP)
   - Tunggu persetujuan → Bayar (upload bukti) → Menempati kos
   - Bayar periodik → Beri review → Perpanjang/selesai kontrak

3. **Admin:**
   - Login → Dashboard → Kelola pengguna → Moderasi konten
   - Pantau transaksi → Export laporan

### 2.2.4 Keuntungan Model SaaS bagi AyoKos

1. **Biaya Rendah bagi Pengguna**: Tidak perlu investasi server, database, atau maintenance IT. Cukup punya koneksi internet dan browser.

2. **Aksesibilitas 24/7**: Pengguna dapat mengakses dari mana saja, kapan saja, melalui perangkat apa pun (laptop, tablet, smartphone).

3. **Data Terpusat & Aman**: Data properti, kontrak, dan pembayaran tersimpan aman di server terpusat dengan backup otomatis.

4. **Ecosystem Effect**: Semakin banyak pemilik mendaftarkan kos, semakin banyak pilihan bagi penghuni, semakin berharga platform (network effect).

5. **Revenue Berkelanjutan**: Model subscription memberikan pendapatan berulang yang dapat diprediksi dibanding penjualan lisensi satu kali.

6. **Iterasi Cepat**: Fitur baru dapat dirilis kapan saja. Contoh: penambahan endpoint analitik, sistem notifikasi, filter pencarian tidak memerlukan instalasi ulang oleh pengguna.

---

## 2.3 Cloud Computing Characteristics (NIST SP 800-146)

### 2.3.1 On-demand Self Service

**Definisi:** Pengguna dapat secara mandiri menyediakan dan mengelola sumber daya komputasi tanpa perlu interaksi manusia dengan penyedia layanan.

**Implementasi pada AyoKos:**
- **Registrasi Mandiri**: Pengguna dapat mendaftar sebagai pemilik atau penghuni tanpa perlu persetujuan admin (registrasi langsung aktif dengan role default penghuni).
- **Manajemen Kos Mandiri**: Pemilik dapat menambah, mengedit, atau menghapus properti kos secara langsung dari dashboard tanpa bantuan admin.
- **Pengajuan Sewa Mandiri**: Penghuni dapat mencari kos, melihat detail, dan mengajukan sewa secara self-service.
- **Self-service Password Change**: Pengguna dapat mengganti password sendiri melalui fitur change password.
- **Upload Dokumen Mandiri**: Pengguna dapat mengupload KTP, foto, bukti pembayaran tanpa melalui admin.

**Analisis:** Sistem telah menerapkan on-demand self service dengan baik untuk fitur inti. Namun, untuk beberapa aksi seperti aktivasi akun pemilik, masih memerlukan intervensi admin — ini adalah keputusan desain untuk keamanan.

### 2.3.2 Broad Network Access

**Definisi:** Sumber daya dapat diakses melalui jaringan standar oleh berbagai perangkat (mobile, laptop, desktop).

**Implementasi pada AyoKos:**
- **Dual Access Pattern**: Sistem mendukung dua metode akses:
  1. **Web (Blade views)**: Untuk akses melalui browser desktop/laptop — diakses melalui route `web.php`
  2. **API (REST JSON)**: Untuk akses melalui aplikasi mobile atau SPA — diakses melalui route `api.php`
- **Sanctum Token Auth**: API menggunakan Laravel Sanctum yang mendukung token-based authentication, memungkinkan integrasi dengan aplikasi mobile (Android/iOS/Flutter/React Native).
- **Responsive Design**: Tailwind CSS v4 memberikan tampilan responsif yang dapat diakses dari tablet dan smartphone melalui browser.
- **API Publik**: Endpoint publik (`/api/public/*`, `/api/kos/*`, `/api/kamar/*`) dapat diakses tanpa autentikasi, memungkinkan integasi third-party.

**Analisis:** Broad network access telah diimplementasikan dengan baik melalui arsitektur API + Web. Mobile-readiness sudah siap tinggal dibangun aplikasi frontend mobile yang mengkonsumsi API.

### 2.3.3 Resource Pooling

**Definisi:** Sumber daya komputasi (storage, memory, CPU) digabungkan untuk melayani banyak pengguna secara multi-tenant.

**Implementasi pada AyoKos:**
- **Single Database**: Semua tenant (pemilik dan penghuni) berbagi satu database yang sama. Resource pool tunggal untuk seluruh pengguna.
- **Shared Application Server**: Satu instance aplikasi Laravel melayani semua permintaan dari seluruh pengguna.
- **File Storage Pooling**: Semua file (foto kos, KTP, bukti pembayaran, foto profil) disimpan dalam satu sistem file terpusat (`storage/app/public/`).
- **Queue Pooling**: Semua job (notifikasi email, reminder) diproses oleh satu queue worker.

**Analisis:** Resource pooling telah diimplementasikan. Tantangannya adalah bagaimana mengelola pool secara efisien saat jumlah pengguna bertambah. Rekomendasi: Redis untuk caching dan queue, read replica untuk database.

### 2.3.4 Rapid Elasticity

**Definisi:** Sumber daya dapat dengan cepat diskalakan (naik atau turun) sesuai permintaan, seringkali secara otomatis.

**Implementasi pada AyoKos:**
- **Vertical Scaling**: Aplikasi Laravel dapat diskalakan vertikal dengan menambah resource server (CPU, RAM) — relatif mudah karena tidak ada perubahan kode.
- **Queue-based Async Processing**: Penggunaan queue (`database` driver) memungkinkan pemrosesan asynchronous untuk task berat (notifikasi email, reminder) — mengurangi beban server pada request synchronous.
- **Stateless API**: API menggunakan token-based auth (Sanctum), memungkinkan horizontal scaling dengan menambah instance server di belakang load balancer.
- **Session Management**: Cookie-based session dapat dipindahkan ke Redis/database untuk mendukung multiple server.

**Analisis:** Aplikasi memiliki kapasitas elastic yang baik karena arsitektur stateless API. Untuk true rapid elasticity, perlu diimplementasikan auto-scaling group di cloud provider (AWS Auto Scaling, GCP Managed Instance Group).

### 2.3.5 Measured Service

**Definisi:** Penggunaan sumber daya cloud dapat dimonitor, dikontrol, dan dilaporkan — memberikan transparansi bagi provider dan pengguna.

**Implementasi pada AyoKos:**
- **Dashboard Analitik**: Pemilik memiliki dashboard yang mengukur:
  - Pendapatan bulanan (dalam rupiah)
  - Tingkat okupansi kamar (persentase)
  - Distribusi rating
  - Jumlah penghuni per kos
- **Penghuni Analytics**: Penghuni dapat melihat:
  - Total pengeluaran sewa
  - Riwayat pembayaran per bulan
  - Progress masa sewa
- **Admin Monitoring** (terbatas): Statistik dasar dashboard admin.
- **Logging Exception**: Error handling di `bootstrap/app.php` mencatat semua exception.

**Analisis:** Measured service untuk pengguna (pemilik/penghuni) sudah cukup baik. Namun, measured service untuk operasional cloud (resource usage, API calls per tenant, response time) belum diimplementasikan. Rekomendasi: integrasi dengan Laravel Pulse, atau implementasi custom metering.

---

## 2.4 Service Model

### 2.4.1 SaaS (Software as a Service)

**Level: PRIMARY SERVICE MODEL**

AyoKos adalah **SaaS murni** berdasarkan definisi NIST:

- **Pengguna mengakses aplikasi jadi**: Pemilik dan penghuni tidak perlu mengelola server, database, atau infrastruktur. Mereka tinggal login melalui browser dan menggunakan fitur.
- **Kontrol terbatas**: Pengguna hanya bisa mengkonfigurasi pengaturan dalam aplikasi (profil, pengaturan kos) — tidak bisa mengubah kode atau infrastruktur.
- **Satu instance untuk banyak pengguna**: Arsitektur multi-tenant dengan sharing database dan aplikasi.
- **Akses melalui thin client**: Browser web atau API client.

**Basis bukti dari source code:**
- Semua logika bisnis ada di server (`app/Services/`), tidak ada yang dijalankan di client
- Client hanya menampilkan data (Blade + Tailwind) atau mengkonsumsi API (JSON)
- Semua validasi dilakukan di server (`app/Http/Requests/`)
- Keamanan dan session management sepenuhnya di sisi server

### 2.4.2 PaaS (Platform as a Service)

**Level: DEPLOYMENT & INFRASTRUCTURE LAYER**

AyoKos sebagai aplikasi Laravel secara alami akan di-deploy di atas PaaS:

- **Laravel Forge** / **Vapor**: Platform manajemen server Laravel yang menyediakan deployment, queue management, cron job, SSL, dan database management.
- **Heroku** / **Railway** / **DigitalOcean App Platform**: PaaS yang mendukung PHP/Laravel deployment dengan managed database, caching, dan queue.
- **Docker + Kubernetes**: Containerization memungkinkan portabilitas antar cloud provider dan orchestration otomatis.

**Mengapa PaaS cocok:**
- Laravel membutuhkan environment spesifik (PHP 8.2+, Composer, Node.js, database)
- Queue worker membutuhkan process manager (Supervisor)
- Scheduled tasks (reminder notifications) membutuhkan cron job management
- Environment variables untuk konfigurasi multi-environment

### 2.4.3 IaaS (Infrastructure as a Service)

**Level: HARDWARE & NETWORKING LAYER**

Untuk skala besar (10.000+ pengguna), AyoKos mungkin memerlukan IaaS:

- **AWS EC2** / **GCP Compute Engine** / **Azure VMs**: Virtual machines untuk aplikasi server
- **AWS RDS** / **GCP Cloud SQL**: Managed database MySQL
- **AWS ElastiCache** / **GCP Memorystore**: Managed Redis untuk caching dan queue
- **AWS S3** / **GCP Cloud Storage**: Object storage untuk file upload (foto, dokumen)
- **AWS CloudFront** / **GCP Cloud CDN**: Content Delivery Network untuk static assets

**Mengapa IaaS diperlukan:**
- Kontrol penuh atas konfigurasi server
- Custom auto-scaling policy
- Isolasi resource antar komponen (app server, database, cache, queue)
- Network security (VPC, security groups, WAF)

---

## 2.5 Deployment Model

### 2.5.1 Public Cloud (Rekomendasi Utama)

**Sangat Sesuai.** AyoKos sebaiknya di-deploy di public cloud.

**Alasan:**
1. **Multi-tenant by design**: Semua tenant berbagi infrastruktur yang sama — tidak perlu private cloud
2. **Biaya lebih rendah**: Pay-as-you-go pricing, tidak perlu investasi hardware
3. **Skalabilitas elastis**: Public cloud menyediakan auto-scaling untuk menangani lonjakan traffic
4. **Managed services**: Database, cache, queue sebagai managed service mengurangi beban运维
5. **Global reach**: CDN dan multi-region deployment untuk pengguna di berbagai kota
6. **Kompatibilitas SaaS**: Model SaaS paling cocok di public cloud

**Provider yang cocok:**
- **AWS**: Laravel成熟, RDS MySQL, ElastiCache Redis, S3 storage, SQS queue
- **Google Cloud**: Cloud SQL MySQL, Memorystore Redis, Cloud Storage, Cloud Tasks
- **DigitalOcean**: Lebih sederhana dan cost-effective untuk skala kecil-menengah

### 2.5.2 Private Cloud (Kurang Sesuai)

**Tidak direkomendasikan** untuk tahap awal.

**Alasan:**
- Biaya investasi hardware tinggi
- Membutuhkan tim infrastruktur khusus
- Tidak memberikan keuntungan signifikan untuk aplikasi multi-tenant publik
- Skalabilitas terbatas oleh kapasitas hardware

**Kapan relevan:** Jika ada regulasi spesifik (misal: data harus berada di server di Indonesia untuk kepatuhan UU PDP) dan memilih dedicated server daripada cloud.

### 2.5.3 Hybrid Cloud (Potensial untuk Masa Depan)

**Potensial** untuk skenario tertentu di masa depan.

**Skenario penggunaan:**
- **Data sensitif di private cloud**: Data finansial atau identitas pengguna disimpan di private cloud untuk kepatuhan
- **Aplikasi di public cloud**: Logika bisnis dan API tetap di public cloud untuk skalabilitas
- **Bursting**: Saat traffic melonjak (musim sewa), komputasi tambahan dari public cloud

**Kelemahan:** Kompleksitas manajemen dan latency antar cloud.

### 2.5.4 Kesimpulan Deployment Model

**Model Terpilih: Public Cloud** dengan strategi:
- **Tahap 1 (100-1.000 users)**: VPS (DigitalOcean/Linode) atau all-in-one PaaS (Laravel Forge + VPS)
- **Tahap 2 (1.000-10.000 users)**: AWS/GCP dengan managed services, load balancer, auto-scaling
- **Tahap 3 (10.000+ users)**: Multi-region deployment, CDN, read replicas, microservices migration

---

## 2.6 Security Analysis

### 2.6.1 Authentication

| Aspek | Implementasi | Analisis |
|---|---|---|
| **Metode Auth** | Session-based (web) + Token-based (API via Sanctum) | Dual auth pattern sesuai untuk hybrid web+mobile |
| **Credential** | Username + password (hashed with bcrypt via Laravel) | Standar keamanan industri |
| **Login Flow** | `AuthService::login()` — attempt web guard, login role guard, create Sanctum token | Single login untuk dual auth mode |
| **Registration** | `RegisterRequest` validasi + `AuthService::register()` — creates user + profile + auto-login | Validasi password confirmation, minimum age 17 |
| **Logout** | Revoke current token + logout all guards + invalidate session | Clean session management |
| **Password Change** | `ChangePasswordRequest` — requires old password, min 8 chars, confirmed | Proteksi terhadap unauthorized password change |
| **Token Management** | Sanctum personal access tokens — each request authenticated via `auth:sanctum` middleware | Token dapat direvoke individual |

**Kekuatan:**
- Penggunaan bcrypt (Laravel default) untuk hashing password
- Sanctum menyediakan token-based auth yang aman untuk SPA dan mobile
- Password change memerlukan verifikasi password lama
- Session di-invalidate saat logout

**Kelemahan:**
- Belum ada rate limiting pada endpoint login (potensi brute force) — meski Laravel menyediakan `RateLimiter` di kernel
- Belum ada two-factor authentication (2FA)
- Registrasi tanpa verifikasi email (potensi akun palsu)
- Belum ada logout dari semua device

### 2.6.2 Authorization

| Aspek | Implementasi | Analisis |
|---|---|---|
| **Role-based Access** | Middleware `penghuni`, `pemilik`, `admin` — check `Auth::user()->role` | Sederhana dan efektif |
| **API Authorization** | `auth:sanctum` middleware + owner-scoped queries | Owner check ada di setiap service layer |
| **Web Authorization** | `auth` middleware + `penghuni`/`pemilik` middleware pada route group | Role terisolasi per route group |
| **Policies** | Tidak menggunakan Laravel Policy | Belum ada otorisasi berbasis model |

**Kekuatan:**
- Middleware berbasis role melindungi route group
- Setiap service method melakukan owner-scoping (tidak bisa akses data milik user lain)
- Dual guard (web + sanctum) untuk dual access pattern

**Kelemahan:**
- Tidak menggunakan Laravel Policy/Gates — semua otorisasi bersifat imperatif
- Spatie permission tables (permissions, roles) sudah ada di database tetapi tidak digunakan
- Tidak ada fine-grained permissions (misal: pemilik A tidak bisa akses data pemilik B secara horizontal)
- Owner checks dilakukan manual di setiap method, rawan miss

### 2.6.3 Session Management

| Aspek | Implementasi | Analisis |
|---|---|---|
| **Session Driver** | `cookie` driver — session disimpan di client dalam cookie terenkripsi | Sesuai untuk Sanctum SPA |
| **Guard Isolation** | Multiple guards: `web`, `penghuni`, `pemilik`, `admin` — semua pakai provider `users` yang sama | Role-specific guard memudahkan middleware check |
| **Session Lifespan** | Laravel default — configurable di `config/session.php` | Dapat disesuaikan |
| **Sanctum Middleware** | `EnsureFrontendRequestsAreStateful` — memungkinkan session-based auth untuk SPA | Bridge antara session web dan API token |

**Kekuatan:**
- Cookie session terenkripsi dan signed — aman dari tampering
- Sanctum middleware memungkinkan satu sesi untuk web dan API
- Session dihapus saat logout

**Kelemahan:**
- Cookie driver memiliki batasan ukuran (4KB)
- Tidak ada session locking untuk mencegah race condition
- Session tidak dipisah per device — logout dari satu device logout semua

### 2.6.4 Validation

| Aspek | Implementasi | Analisis |
|---|---|---|
| **Form Request** | 19 centralized FormRequest classes | Validasi terpisah dari controller, reusable |
| **Input Sanitization** | Laravel automatic — semua input melewati middleware `TrimStrings` dan `ConvertEmptyStringsToNull` | Proteksi dasar terhadap whitespace injection |
| **File Upload Validation** | Extension, mime type, max size (2MB untuk KTP/foto, 5MB untuk bukti pembayaran) | Proteksi terhadap upload berbahaya |
| **Custom Rules** | Minimum age 17 tahun, unique constraint per kos-kamar | Validasi bisnis spesifik |
| **Error Messages** | Bahasa Indonesia, spesifik per field | User experience yang baik |

**Kekuatan:**
- Semua input tervalidasi sebelum masuk ke service layer
- File upload terbatas ukuran dan tipe
- Unique constraints di level database (nomor_kamar unique per kos)
- Foto KTP required untuk pengajuan kontrak

**Kelemahan:**
- Belum ada rate limiting pada file upload
- Tidak ada virus scanning pada file upload
- Validasi hanya di server-side (client-side validation terbatas)
- Beberapa validasi bisnis ada di service layer, tidak semua di FormRequest

### 2.6.5 Middleware

| Middleware | File | Fungsi |
|---|---|---|
| `auth` | `Authenticate.php` | Redirect unauthenticated user ke login |
| `penghuni` | `CheckPenghuni.php` | 403 jika role bukan penghuni |
| `pemilik` | `CheckPemilik.php` | 403 jika role bukan pemilik |
| `admin` | `CheckAdmin.php` | 403 jika role bukan admin |
| `guest` | `RedirectIfAuthenticated.php` | Redirect ke dashboard jika sudah login |

**Kekuatan:**
- Middleware stack terdefinisi dengan baik di `bootstrap/app.php`
- Exception handling untuk JSON response di semua endpoint API
- Guest middleware mencegah akses ganda ke halaman login

**Kelemahan:**
- Belum ada middleware untuk logging aktivitas (audit trail)
- Belum ada middleware untuk throttling/rate limiting
- Belum ada maintenance mode middleware (built-in Laravel tapi belum dikonfigurasi)
- CORS middleware tidak terlihat (mungkin menggunakan default Laravel)

### 2.6.6 CSRF Protection

| Aspek | Implementasi | Analisis |
|---|---|---|
| **Web Routes** | Laravel `VerifyCsrfToken` middleware aktif — semua POST/PUT/DELETE memerlukan CSRF token | Proteksi terhadap CSRF attacks |
| **CSRF Token** | Disertakan di Blade via `@csrf` atau di Axios via `axios.defaults.headers.common['X-CSRF-TOKEN']` | Double submit cookie pattern |
| **API Routes** | CSRF dikecualikan — menggunakan token-based auth | Standar REST API |
| **API Client** | `api-client.js` — mengirim CSRF token di header | Integrasi antara web SPA dan server |

**Kekuatan:**
- CSRF protection aktif untuk semua web routes
- API menggunakan token auth, bukan CSRF
- Axios interceptor mengirim CSRF token secara otomatis

**Kelemahan:**
- Tidak ada same-site cookie attribute yang dikonfigurasi secara eksplisit
- CSRF token expiration tidak terkonfigurasi

### 2.6.7 Ringkasan Keamanan

| Aspek | Skor (1-5) | Catatan |
|---|---|---|
| Authentication | 4/5 | Kecuali 2FA dan rate limiting |
| Authorization | 3/5 | Tidak menggunakan Policy/Gates |
| Session Management | 3/5 | Cookie driver ada batasan |
| Validation | 4/5 | Kecuali file scanning |
| Middleware | 4/5 | Kecuali audit trail |
| CSRF Protection | 4/5 | Kecuali same-site config |

**Rekomendasi prioritas keamanan:**
1. Implementasi rate limiting pada login dan API endpoint
2. Aktivasi Laravel Policy/Gates untuk fine-grained authorization
3. Migrasi session driver ke Redis/database untuk session sharing
4. Implementasi audit trail middleware
5. Penambahan 2FA untuk akun pemilik/admin

---

## 2.7 Scalability Analysis

### 2.7.1 Skala 100 Pengguna

**Karakteristik Beban:**
- 50 pemilik, 50 penghuni
- Rata-rata 5 request/detik
- Database < 1 GB
- File storage < 5 GB (foto kos, KTP, bukti bayar)

**Arsitektur yang Cukup:**
```
[Single VPS (2GB RAM, 2 vCPU)]
  ├── Nginx + PHP-FPM
  ├── Laravel Application
  ├── MySQL Database
  ├── Queue Worker (database driver)
  └── File Storage (local)
```

**Rekomendasi:**
- **Caching**: Mulai gunakan `cache` driver dengan database atau file untuk menyimpan:
  - Konfigurasi (`config:cache`)
  - Route cache (`route:cache`)
  - View cache
  - Query cache untuk data statis (fasilitas, tipe kamar)
- **Queue**: Database driver sudah cukup untuk 100 pengguna
- **VPS**: DigitalOcean $12/bulan atau setara

**Performa yang Diharapkan:**
- Response time: < 500ms
- Uptime: 99.9%
- Tidak perlu load balancer

### 2.7.2 Skala 1.000 Pengguna

**Karakteristik Beban:**
- 400 pemilik, 600 penghuni
- Rata-rata 50 request/detik
- Database ~ 5-10 GB
- File storage ~ 50 GB
- Lonjakan traffic saat jam sibuk (pagi, malam)

**Arsitektur yang Direkomendasikan:**
```
[Load Balancer]
  ├── App Server 1 (4GB RAM, 2 vCPU)
  ├── App Server 2 (4GB RAM, 2 vCPU)
  └── [Auto-scaling: +1 server saat CPU > 70%]
       ↓
[Managed MySQL] (AWS RDS / GCP Cloud SQL)
[Redis Cluster]  (Cache + Queue + Session)
[CDN]            (CloudFront untuk static assets)
[Object Storage] (S3 untuk file upload)
```

**Rekomendasi Pengembangan:**

#### A. Load Balancer
- **Mekanisme**: Round-robin atau least connections
- **Session Affinity**: Tidak diperlukan karena session dapat disimpan di Redis
- **Health Check**: Endpoint `/health` atau `/up` (Laravel built-in)
- **SSL Termination**: Di load balancer untuk mengurangi beban app server

#### B. Caching (Redis)
- **Cache Driver**: Migrasi dari `database` ke `redis`
- **Query Cache**: Cache hasil query mahal (dashboard pemilik, pencarian kos dengan filter)
- **Fragment Cache**: Cache partial Blade views
- **Rate Limiter**: Redis-backed rate limiting untuk API
- **Data yang perlu di-cache:**
  - Daftar fasilitas (jarang berubah)
  - Rekomendasi kos (cache 1 jam)
  - Statistik dashboard (cache 5 menit)
  - Data peta kos (cache 30 menit)

#### C. Queue (Redis)
- **Driver**: Migrasi dari `database` ke `redis`
- **Job Types**:
  - Email notifications (high priority)
  - In-app notifications
  - Reminder checks (scheduled)
  - Data analytics computation (low priority)
- **Worker**: Multiple queue workers untuk masing-masing priority level
- **Failed Jobs**: Monitoring via dashboard (tabel `failed_jobs` sudah ada)

#### D. Database Optimization
- **Read Replica**: Database read replica untuk query SELECT (pencarian kos, dashboard)
- **Indexing**: Pastikan kolom yang sering di-query memiliki index:
  - `kos`: id_pemilik, kota, jenis_kos, tipe_sewa, status_kos
  - `kamar`: id_kos, status_kamar, harga
  - `kontrak_sewa`: id_penghuni, id_kos, id_kamar, status_kontrak
  - `pembayaran`: id_kontrak, id_penghuni, status_pembayaran
  - `notifications`: id_user, is_read, created_at
- **Query Optimization**:
  - Gunakan eager loading untuk menghindari N+1 queries
  - Implementasi pagination untuk semua list endpoints (sudah ada)
  - Hindari `SELECT *` untuk data besar

#### E. CDN (Content Delivery Network)
- **Static Assets**: CSS, JS via Vite build disajikan melalui CDN
- **User Uploads**: Foto kos, foto profil, bukti pembayaran via CDN dengan signed URL
- **Cache Strategy**: Cache static assets selamanya (fingerprinted filename), cache images for 24h
- **Provider**: CloudFlare (gratis), AWS CloudFront, atau GCP Cloud CDN

### 2.7.3 Skala 10.000 Pengguna

**Karakteristik Beban:**
- 3.000 pemilik, 7.000 penghuni
- Rata-rata 500 request/detik
- Database ~ 50-100 GB
- File storage ~ 500 GB
- Perlu multi-region untuk menangani pengguna di seluruh Indonesia

**Arsitektur Lanjutan:**
```
[Global Load Balancer] (Route53 / Cloud DNS)
  ├── Region 1 (Jawa Barat)
  │   ├── [ALB/HTTPS Load Balancer]
  │   ├── App Server Fleet (10-20 instance, auto-scaling)
  │   ├── Redis Cluster (Cache + Session + Queue)
  │   └── ...
  ├── Region 2 (Jawa Timur)
  │   └── [Mirror of Region 1]
  └── [Global CDN]
       ↓
[Primary Database] (RDS Multi-AZ)
  ├── Read Replica 1 (Reports & Analytics)
  ├── Read Replica 2 (Public queries)
  └── Read Replica 3 (Admin queries)
[Object Storage] (S3 with Cross-Region Replication)
[ElastiCache Redis] (Cluster mode, multi-AZ)
```

**Rekomendasi Tambahan:**

1. **Microservices Migration** (Opsional):
   - Pisahkan menjadi: Auth Service, Kos Service, Payment Service, Notification Service
   - Communication via message queue atau REST internal
   - Setiap service dapat di-scale independently

2. **Database Sharding**:
   - Shard berdasarkan region atau range ID
   - Atau gunakan database terpisah per tenant (true multi-tenant)

3. **Search Engine**:
   - Elasticsearch / Meilisearch untuk full-text search kos
   - Lebih cepat dari MySQL `LIKE` untuk pencarian dengan filter kompleks

4. **Content Delivery**:
   - Image optimization pipeline (WebP conversion, resize, lazy loading)
   - Video streaming untuk virtual tour kos

5. **Monitoring & Observability**:
   - APM: Laravel Telescope, New Relic, Datadog
   - Metrics: Prometheus + Grafana
   - Logging: ELK Stack (Elasticsearch, Logstash, Kibana)
   - Alerting: PagerDuty / OpsGenie

---

# BAB III: REKOMENDASI PENGEMBANGAN

## 3.1 Multi Tenant (Prioritas: Tinggi)

**Deskripsi:** Implementasi true multi-tenancy dengan isolasi data antar tenant.

**Rekomendasi:**
- Tambahkan `tenant_id` column pada tabel utama (kos, kamar, kontrak, pembayaran)
- Implementasi Global Scope di Eloquent untuk otomatis filter berdasarkan tenant
- Buat Tenant model dan TenantService
- Pisahkan konfigurasi per tenant (branding, payment gateway credentials)
- Pertimbangkan single database (shared) vs separate database per tenant

**Manfaat Cloud Computing:** Resource pooling yang lebih terstruktur, isolasi data, dan keamanan multi-tenant yang lebih baik.

## 3.2 Subscription System (Prioritas: Tinggi)

**Deskripsi:** Model bisnis berbasis langganan dengan berbagai paket.

**Rekomendasi:**
- Tabel: `packages` (id, name, price, max_kos, max_kamar, features JSON, duration)
- Tabel: `subscriptions` (id, id_pemilik, id_package, start_date, end_date, status)
- Integrasi dengan payment gateway untuk recurring billing
- Middleware untuk ngecek subscription status di route pemilik
- Trial period (14/30 hari) untuk pengguna baru

**Manfaat Cloud Computing:** Measured service — pengguna membayar sesuai resource yang digunakan.

## 3.3 Online Payment Gateway (Prioritas: Tinggi)

**Deskripsi:** Integrasi payment gateway untuk pembayaran sewa otomatis.

**Rekomendasi:**
- Integrasi Midtrans / Xendit / Tripay
- Automated callback handling (endpoint `/api/payment/callback` sudah ada, perlu diintegrasikan)
- Dukungan berbagai metode: transfer bank, e-wallet (GoPay, OVO, Dana), QRIS, kartu kredit
- Auto-approve pembayaran saat payment gateway mengkonfirmasi status settled
- Refund handling

**Manfaat Cloud Computing:** Broad network access — pembayaran dari berbagai channel.

## 3.4 Monitoring Cloud (Prioritas: Sedang)

**Deskripsi:** Implementasi monitoring infrastruktur dan aplikasi.

**Rekomendasi:**
- **Laravel Pulse**: Monitoring real-time untuk performa aplikasi (routes, queue, slow queries)
- **Laravel Horizon**: Dashboard untuk Redis queue monitoring
- Integrasi dengan Sentry / Flare untuk error tracking
- Custom health check endpoint
- Uptime monitoring dengan cron job

**Manfaat Cloud Computing:** Measured service dan visibility penuh ke dalam sistem.

## 3.5 Backup Automation (Prioritas: Tinggi)

**Deskripsi:** Backup database dan file storage otomatis.

**Rekomendasi:**
- Daily database backup ke cloud storage (S3, Google Cloud Storage)
- Backup file storage (foto, dokumen) incremental
- Retention policy: daily (30 hari), weekly (12 minggu), monthly (12 bulan)
- Point-in-time recovery untuk database
- Notifikasi jika backup gagal
- Restore drill otomatis

**Manfaat Cloud Computing:** High availability dan disaster recovery.

## 3.6 Notification Service - Real-time (Prioritas: Sedang)

**Deskripsi:** Push notification real-time untuk pengguna.

**Rekomendasi:**
- **WebSocket**: Pusher / Laravel WebSockets / Soketi untuk real-time notification
- **Firebase Cloud Messaging**: Push notification ke mobile app
- **Email**: Tetap gunakan Laravel Mail (sudah ada)
- **WhatsApp API**: Integrasi untuk notifikasi pembayaran dan kontrak
- Notification preferences per user (email/push/in-app/mana yang diaktifkan)

**Manfaat Cloud Computing:** Broad network access — notifikasi reach pengguna di mana saja.

## 3.7 API Integration & Public API (Prioritas: Sedang)

**Deskripsi:** Membuka API untuk third-party developer.

**Rekomendasi:**
- Dokumentasi API dengan Laravel Swagger/OpenAPI atau Scribe
- API versioning (`/api/v1/`, `/api/v2/`)
- API key management untuk third-party apps
- Rate limiting per API key
- Webhook untuk event (kontrak baru, pembayaran, review)

**Manfaat Cloud Computing:** Broad network access dan ekosistem platform.

## 3.8 Mobile App Integration (Prioritas: Sedang)

**Deskripsi:** Aplikasi mobile native atau cross-platform.

**Rekomendasi:**
- **Flutter** atau **React Native** untuk cross-platform
- Memanfaatkan API yang sudah ada (auth:sanctum mendukung token-based auth)
- Fitur mobile-specific: push notification, camera (upload foto), GPS (cari kos terdekat), biometric login
- Offline capability untuk browsing kos (caching)

**Manfaat Cloud Computing:** Broad network access — akses dari perangkat mobile.

## 3.9 Laporan PDF / Invoice Otomatis (Prioritas: Rendah)

**Deskripsi:** Generate invoice dan laporan dalam format PDF.

**Rekomendasi:**
- Manfaatkan `barryvdh/laravel-dompdf` yang sudah terinstall
- Generate invoice otomatis untuk setiap pembayaran
- Laporan bulanan untuk pemilik (rekap pendapatan)
- Laporan tahunan untuk keperluan pajak
- Download laporan dari dashboard

**Manfaat Cloud Computing:** Measured service — transparansi data untuk pengguna.

## 3.10 AI/ML Recommendations (Prioritas: Rendah)

**Deskripsi:** Rekomendasi kos berbasis machine learning.

**Rekomendasi:**
- Recommendation engine: collaborative filtering (pengguna dengan preferensi mirip)
- Price prediction: estimasi harga sewa berdasarkan lokasi, fasilitas, tipe kamar
- Occupancy prediction: prediksi tingkat okupansi untuk membantu pemilik menentukan harga
- Fraud detection: deteksi pola pembayaran mencurigakan

**Manfaat Cloud Computing:** Rapid elasticity — komputasi berat untuk training model dapat diskalakan sesuai kebutuhan.

---

# BAB IV: REKOMENDASI JUDUL PROYEK

## 4.1 Daftar 10+ Alternatif Judul

| No | Judul | Keterangan |
|---|---|---|
| 1 | **Analisis dan Implementasi Cloud Computing pada Sistem Informasi Manajemen Kos Berbasis SaaS** | Judul langsung mencerminkan konten |
| 2 | **Pengembangan Aplikasi Manajemen Kos Multi-Tenant Menggunakan Arsitektur Cloud Computing** | Fokus pada multi-tenant |
| 3 | **Implementasi Arsitektur Layanan Cloud pada Platform Digital Sewa Menyewa Kos (AyoKos)** | Fokus pada platform digital |
| 4 | **Rancang Bangun Sistem Informasi Manajemen Kos Berbasis SaaS dengan Pendekatan Cloud-Native** | Fokus pada pendekatan cloud-native |
| 5 | **Analisis Penerapan Karakteristik Cloud Computing pada Aplikasi Marketplace Kos Online** | Fokus pada marketplace |
| 6 | **Perancangan Arsitektur SaaS untuk Sistem Informasi Penyewaan Kos Berbasis Web** | Fokus pada desain arsitektur |
| 7 | **Penerapan Model SaaS pada Platform Digital Manajemen Properti Kos Berbasis Cloud** | Fokus pada model SaaS |
| 8 | **Analisis Skalabilitas dan Keamanan pada Aplikasi Manajemen Kos Menggunakan Layanan Cloud Computing** | Fokus pada skalabilitas dan keamanan |
| 9 | **Pengembangan Sistem Informasi Kos dengan Pendekatan Software as a Service (SaaS)** | Sederhana dan langsung |
| 10 | **Optimalisasi Manajemen Properti Kos melalui Platform Cloud Computing dengan Arsitektur Multi-Tenant** | Fokus pada optimalisasi |
| 11 | **Perancangan dan Implementasi Sistem Manajemen Sewa Kos Terintegrasi Berbasis Cloud** | Fokus pada integrasi |
| 12 | **Analisis Kinerja Aplikasi Manajemen Kos Menggunakan Infrastruktur Cloud Computing** | Fokus pada kinerja |
| 13 | **Sistem Informasi Manajemen Kos Berbasis SaaS: Studi Kasus Implementasi Cloud Computing pada Sektor Properti** | Judul formal akademik |
| 14 | **Pengembangan Platform Digital Ekonomi Berbagi untuk Sektor Kos dengan Arsitektur Cloud Computing** | Fokus pada sharing economy |

## 4.2 Tiga Judul Terbaik

### Judul 1: **Analisis dan Implementasi Cloud Computing pada Sistem Informasi Manajemen Kos Berbasis SaaS**

**Alasan:**
- **Komprehensif**: Mencakup seluruh aspek analisis (SaaS, karakteristik cloud, security, scalability) yang dibahas dalam dokumen ini
- **Akurat**: AyoKos sudah memenuhi kriteria SaaS, tinggal dianalisis dari perspektif cloud computing
- **Akademik**: Format judul sesuai standar skripsi/tesis — "Analisis dan Implementasi X pada Y Berbasis Z"
- **Relevan**: Langsung mencerminkan isi dokumen dan tujuan presentasi

### Judul 2: **Pengembangan Aplikasi Manajemen Kos Multi-Tenant Menggunakan Arsitektur Cloud Computing**

**Alasan:**
- **Fokus pada Multi-Tenant**: Aspek multi-tenant adalah karakteristik kunci SaaS yang membedakannya dari aplikasi tradisional
- **Teknis**: Menarik bagi audiens yang tertarik pada arsitektur teknis
- **Menonjolkan Inovasi**: Multi-tenant architecture menunjukkan skalabilitas dan efisiensi resource
- **Orisinalitas**: Topik multi-tenant masih jarang dibahas di konteks manajemen kos Indonesia

### Judul 3: **Perancangan Arsitektur SaaS untuk Sistem Informasi Penyewaan Kos Berbasis Web**

**Alasan:**
- **Fokus pada Perancangan**: Cocok jika presentasi menekankan pada bagaimana sistem dirancang dari awal
- **SaaS sebagai Core**: Menempatkan SaaS sebagai fokus utama, bukan hanya pelengkap
- **Sederhana & Mudah Dipahami**: Tidak terlalu panjang, mudah diingat
- **Luas**: Mencakup aspek arsitektur tanpa terikat implementasi spesifik

**Rekomendasi Akhir: Judul 1** — karena paling sesuai dengan isi dokumen yang mencakup analisis komprehensif cloud computing pada aplikasi SaaS yang sudah ada.

---

# BAB V: MATERI PRESENTASI

## Slide 1: Judul Presentasi

**Judul Slide:** Analisis dan Implementasi Cloud Computing pada Sistem Informasi Manajemen Kos Berbasis SaaS

**Isi Slide:**
```
Analisis dan Implementasi Cloud Computing
pada Sistem Informasi Manajemen Kos
Berbasis SaaS

───
AyoKos
───

Nama Mahasiswa
NIM
Program Studi
Universitas

Tahun 2026
```

**Penjelasan Presenter:**
"Selamat pagi/siang, saya akan mempresentasikan analisis dan implementasi cloud computing pada AyoKos, sebuah sistem informasi manajemen kos berbasis web. Dalam presentasi ini, saya akan membahas bagaimana AyoKos menerapkan konsep cloud computing dan bagaimana sistem ini dapat dikategorikan sebagai Software as a Service."

---

## Slide 2: Agenda Presentasi

**Judul Slide:** Agenda

**Isi Slide:**
```
1. Latar Belakang & Tujuan
2. Gambaran Umum Sistem (AyoKos)
3. Arsitektur Sistem
4. Analisis Fitur per Role
5. SaaS Analysis
6. Karakteristik Cloud Computing
7. Service & Deployment Model
8. Analisis Keamanan
9. Analisis Skalabilitas
10. Rekomendasi Pengembangan
11. Kesimpulan & Judul Proyek
12. Sesi Tanya Jawab
```

**Penjelasan Presenter:**
"Ada 12 poin utama yang akan saya sampaikan. Mulai dari latar belakang masalah hingga rekomendasi pengembangan ke depannya. Saya akan fokus pada bagaimana konsep cloud computing diterapkan dalam sistem ini."

---

## Slide 3: Latar Belakang

**Judul Slide:** Latar Belakang Masalah

**Isi Slide:**
```
Permasalahan yang Diidentifikasi:

• Pencarian kos masih manual (brosur, mulut ke mulut, Facebook)
• Tidak ada database terpusat informasi kos
• Proses sewa tidak terdokumentasi digital
• Pemilik kesulitan memonitor pembayaran
• Tidak ada sistem review & rating
• Transparansi bisnis rendah bagi pemilik

Dampak:
❌ Informasi terfragmentasi
❌ Sewa menyewa tidak efisien
❌ Risiko penipuan
```

**Penjelasan Presenter:**
"Berdasarkan survei, banyak pencari kos kesulitan mendapatkan informasi properti yang akurat. Pemilik kos juga kesulitan mengelola administrasi sewa. AyoKos hadir untuk menjembatani kedua pihak ini melalui platform digital."

---

## Slide 4: Gambaran Umum AyoKos

**Judul Slide:** Gambaran Umum Sistem

**Isi Slide:**
```
AyoKos — Sistem Informasi Manajemen Kos

Tujuan:
• Menghubungkan pemilik kos dengan pencari kos
• Mendigitalkan seluruh siklus sewa
• Menyediakan dashboard manajemen & analitik

Target Pengguna:
┌──────────┬──────────────────────────────┐
│   Role   │        Kebutuhan Utama        │
├──────────┼──────────────────────────────┤
│ Pemilik  │ Manajemen properti,           │
│          │ monitoring pendapatan         │
├──────────┼──────────────────────────────┤
│ Penghuni │ Cari kos, sewa, bayar, review │
├──────────┼──────────────────────────────┤
│ Admin    │ Manajemen platform, moderasi  │
└──────────┴──────────────────────────────┘

Tech Stack: Laravel 12, PHP 8.2+, MySQL, 
Tailwind CSS, Sanctum, Vite
```

**Penjelasan Presenter:**
"AyoKos dibangun dengan Laravel 12, menggunakan MySQL untuk database dan Tailwind CSS untuk frontend. Ada tiga role pengguna: pemilik kos, penghuni, dan admin. Masing-masing memiliki fitur yang berbeda."

---

## Slide 5: Arsitektur Sistem

**Judul Slide:** Arsitektur Sistem

**Isi Slide:**
```
┌─────────────────────────────────────────┐
│           Client Layer                  │
│  ┌──────────┐  ┌──────────┐            │
│  │  Browser │  │  Mobile  │            │
│  │  (Blade) │  │  (API)   │            │
│  └────┬─────┘  └────┬─────┘            │
└───────┼──────────────┼──────────────────┘
        │              │
┌───────┼──────────────┼──────────────────┐
│       ▼              ▼                  │
│  ┌──────────────────────────┐          │
│  │   Laravel Application    │          │
│  │  ┌────┐ ┌────┐ ┌─────┐ │          │
│  │  │Web │ │API │ │Queue│ │          │
│  │  │Rtes│ │Rtes│ │Job  │ │          │
│  │  └────┘ └────┘ └─────┘ │          │
│  │  ┌──────────────────┐   │          │
│  │  │   Services       │   │          │
│  │  │ (Business Logic) │   │          │
│  │  └──────────────────┘   │          │
│  │  ┌──────────────────┐   │          │
│  │  │     Models       │   │          │
│  │  └──────────────────┘   │          │
│  └──────────┬───────────────┘          │
└─────────────┼──────────────────────────┘
              │
┌─────────────┼──────────────────────────┐
│             ▼                          │
│  ┌──────────────────────────┐          │
│  │       Database           │          │
│  │    (MySQL / SQLite)      │          │
│  └──────────────────────────┘          │
│  ┌──────────────────────────┐          │
│  │    Storage (Files)       │          │
│  └──────────────────────────┘          │
└────────────────────────────────────────┘
```

**Penjelasan Presenter:**
"Arsitektur AyoKos menggunakan三层架构: client layer (browser dan mobile), application layer (Laravel dengan Web routes, API routes, queue, services, dan models), dan data layer (database dan file storage). API menggunakan Sanctum untuk autentikasi dual-mode: session-based untuk web dan token-based untuk mobile."

---

## Slide 6: Fitur Pemilik Kos

**Judul Slide:** Fitur Pemilik Kos

**Isi Slide:**
```
Fitur untuk Pemilik Kos (11 kelompok fitur):

📋 Manajemen Kos        → CRUD properti + upload foto
🚪 Manajemen Kamar      → Kelola kamar per kos
🏷️ Fasilitas Kos        → Pilih fasilitas dari master data
⚙️ Pengaturan Kos       → Aturan check-in, jam bertamu
📄 Kontrak Sewa         → Approve/reject/selesai kontrak
💰 Pembayaran           → Verifikasi bukti bayar
⭐ Review & Rating      → Pantau rating properti
📊 Analisis Bisnis      → Pendapatan, okupansi, tren
📈 Dashboard            → Statistik real-time
👤 Profil              → Data diri, bank, password

Total: 30+ endpoint API
```

**Penjelasan Presenter:**
"Pemilik kos mendapatkan 11 kelompok fitur yang mencakup seluruh aspek manajemen properti, mulai dari pendaftaran kos, pengelolaan kamar dan fasilitas, verifikasi kontrak dan pembayaran, hingga analitik bisnis. Total ada lebih dari 30 endpoint API yang melayani pemilik."

---

## Slide 7: Fitur Penghuni

**Judul Slide:** Fitur Penghuni

**Isi Slide:**
```
Fitur untuk Penghuni (7 kelompok fitur):

🔍 Cari Kos         → Filter lengkap, peta interaktif
📝 Ajukan Sewa      → Upload KTP, pilih durasi
💳 Bayar Sewa       → Upload bukti, pilih metode
⭐ Beri Review      → Rating 1-5, komentar
📊 Dashboard        → Progress sewa, sisa hari
📈 Analisis         → Pengeluaran, riwayat pembayaran
👤 Profil           → Data diri, ganti password, bank

Alur Bisnis:
Cari → Lihat Detail → Ajukan → Disetujui → Bayar → Huni → Review
```

**Penjelasan Presenter:**
"Penghuni memiliki 7 fitur utama. Alur bisnisnya dimulai dari pencarian kos, melihat detail, mengajukan sewa, menunggu persetujuan pemilik, membayar, menempati, dan memberikan review. Semua proses digital tanpa kertas."

---

## Slide 8: Analisis SaaS

**Judul Slide:** Analisis SaaS (Software as a Service)

**Isi Slide:**
```
AyoKos sebagai SaaS — Checklist:

✅ Akses via Browser    → Blade + Tailwind, responsive
✅ Thin Client          → Semua logika di server
✅ Multi-Tenant         → Soft multi-tenant (owner-scoped)
✅ Central Management   → Satu codebase, admin panel
✅ Auto Updates         → Update di server, semua kena
✅ Scalability          → Arsitektur siap scale

❌ Subscription Model   → Belum ada (rekomendasi)
⚠️ True Multi-Tenant    → Perlu tenant_id column

Karakteristik SaaS NIST:
✓ On-demand self-service
✓ Broad network access
✓ Resource pooling
✓ Rapid elasticity
✓ Measured service
```

**Penjelasan Presenter:**
"AyoKos memenuhi hampir semua karakteristik SaaS menurut standar NIST. Pengguna mengakses via browser, semua logika bisnis di server, mendukung multi-tenant, dan skalabel. Yang belum ada adalah model subscription untuk monetisasi."

---

## Slide 9: Karakteristik Cloud Computing (Bagian 1)

**Judul Slide:** Karakteristik Cloud Computing

**Isi Slide:**
```
1. On-demand Self Service
   • Registrasi mandiri (tanpa admin)
   • CRUD kos, kamar, fasilitas secara mandiri
   • Upload dokumen tanpa bantuan teknisi

2. Broad Network Access
   • Web via browser (desktop/tablet/mobile)
   • REST API untuk integrasi aplikasi mobile
   • Token-based auth (Sanctum) untuk multi-platform

3. Resource Pooling
   • Satu database untuk semua tenant
   • Satu aplikasi server melayani semua user
   • File storage terpusat
   ❗ Perlu true multi-tenancy untuk isolasi lebih baik
```

**Penjelasan Presenter:**
"Tiga karakteristik pertama: pengguna bisa self-service, sistem bisa diakses dari berbagai perangkat, dan resource komputasi dipool untuk melayani banyak pengguna secara bersamaan."

---

## Slide 10: Karakteristik Cloud Computing (Bagian 2)

**Judul Slide:** Karakteristik Cloud Computing (Lanjutan)

**Isi Slide:**
```
4. Rapid Elasticity
   • Vertical scaling: upgrade VPS (mudah)
   • Horizontal scaling: multiple app servers via load balancer
   • Queue async processing untuk task berat
   • Stateless API memungkinkan auto-scaling

5. Measured Service
   • Dashboard pendapatan pemilik (per bulan/tahun)
   • Statistik okupansi kamar
   • Analisis pengeluaran penghuni
   • Admin dashboard (terbatas)
   ❗ Perlu metering lebih detail: API calls, storage used, active users

Cloud Computing memungkinkan:
Skalabilitas tanpa batas — bayar sesuai pemakaian
```

**Penjelasan Presenter:**
"Dua karakteristik terakhir: elastisitas memungkinkan sistem tumbuh sesuai kebutuhan, dan measured service memberikan transparansi penggunaan. Cloud computing membuat semua ini mungkin tanpa investasi hardware awal."

---

## Slide 11: Service & Deployment Model

**Judul Slide:** Service Model & Deployment Model

**Isi Slide:**
```
Service Model:

┌────────────────────────────────────────────┐
│  SaaS (Software as a Service) ⬅ PRIMER    │
│  AyoKos sebagai aplikasi jadi yang         │
│  diakses pengguna via browser              │
├────────────────────────────────────────────┤
│  PaaS (Platform as a Service)              │
│  Laravel Forge / Vapor untuk deployment    │
│  Managed database, queue, cache            │
├────────────────────────────────────────────┤
│  IaaS (Infrastructure as a Service)        │
│  AWS/GCP untuk skala 10.000+ users        │
└────────────────────────────────────────────┘

Deployment Model:

🏆 Public Cloud (Paling Sesuai)
   • Biaya rendah (pay-as-you-go)
   • Skalabilitas elastis
   • Managed services
   
⚠️ Private Cloud (Tidak Direkomendasikan)
💡 Hybrid Cloud (Potensial untuk masa depan)
```

**Penjelasan Presenter:**
"Dari sisi service model, AyoKos adalah SaaS murni. Deployment model yang paling sesuai adalah public cloud karena biaya lebih rendah dan skalabilitas lebih baik. Private cloud tidak direkomendasikan karena biaya tinggi, hybrid cloud bisa jadi opsi di masa depan untuk data sensitif."

---

## Slide 12: Analisis Keamanan

**Judul Slide:** Analisis Keamanan Sistem

**Isi Slide:**
```
┌─────────────────┬──────────┬──────────────────┐
│    Aspek        │  Skor    │  Status          │
├─────────────────┼──────────┼──────────────────┤
│ Authentication  │  ★★★★☆  │ Sanctum (session  │
│                 │          │ + token-based)   │
├─────────────────┼──────────┼──────────────────┤
│ Authorization   │  ★★★☆☆  │ Middleware role,  │
│                 │          │ owner-scoped     │
├─────────────────┼──────────┼──────────────────┤
│ Session Mgmt    │  ★★★☆☆  │ Cookie driver    │
├─────────────────┼──────────┼──────────────────┤
│ Validation      │  ★★★★☆  │ 19 FormRequests  │
├─────────────────┼──────────┼──────────────────┤
│ Middleware       │  ★★★★☆  │ 5 custom +       │
│                 │          │ auth:sanctum     │
├─────────────────┼──────────┼──────────────────┤
│ CSRF Protection │  ★★★★☆  │ Active for web   │
└─────────────────┴──────────┴──────────────────┘

Rekomendasi Prioritas:
1. Rate limiting login & API
2. Laravel Policies & Gates
3. Audit trail middleware
4. Two-factor authentication (2FA)
```

**Penjelasan Presenter:**
"Analisis keamanan menunjukkan nilai baik di authentication, validation, dan CSRF. Nilai agak kurang di authorization karena belum menggunakan Laravel Policy. Rekomendasi utama: tambah rate limiting, implementasi policy, dan audit trail."

---

## Slide 13: Analisis Skalabilitas (100 Users)

**Judul Slide:** Skalabilitas — 100 Pengguna

**Isi Slide:**
```
Skala 100 Pengguna (50 Pemilik + 50 Penghuni)

Beban:
• ~5 request/detik
• Database < 1 GB
• File storage < 5 GB

Arsitektur Cukup:
┌────────────────────┐
│   Single VPS       │
│   (2GB RAM, 2CPU)  │
├────────────────────┤
│ Nginx + PHP-FPM    │
│ Laravel App        │
│ MySQL              │
│ Queue (database)   │
│ File Storage (lokal)│
└────────────────────┘

Estimasi Biaya: ~$12-20/bulan (DigitalOcean/Linode)
Response Time: < 500ms
✅ Load balancer belum diperlukan
✅ Database queue cukup
```

**Penjelasan Presenter:**
"Untuk 100 pengguna, satu VPS dengan 2GB RAM sudah cukup. Queue dengan database driver masih memadai. Estimasi biaya sekitar 12-20 dolar per bulan."

---

## Slide 14: Skalabilitas (1.000 Users)

**Judul Slide:** Skalabilitas — 1.000 Pengguna

**Isi Slide:**
```
Skala 1.000 Pengguna (400 Pemilik + 600 Penghuni)

Beban:
• ~50 request/detik
• Database 5-10 GB
• File storage ~50 GB

Arsitektur:
┌─────────────┐
│ Load Balancer│
├──────┬───────┤
│ App1 │ App2  │ ← Auto-scaling
├──────┴───────┤
│ Managed MySQL│ → Read Replica
│ Redis Cluster│ → Cache + Queue + Session
│ CDN          │ → Static assets
│ Object Store │ → File upload (S3)
└──────────────┘

Rekomendasi:
• Redis untuk cache & queue
• Eager loading & indexing
• CDN untuk gambar & assets
• Read replica database
```

**Penjelasan Presenter:**
"Untuk 1.000 pengguna, diperlukan load balancer dengan 2-3 app server, Redis untuk caching dan queue, CDN untuk aset statis, serta object storage untuk file upload. Managed MySQL dengan read replica untuk memisahkan query baca dan tulis."

---

## Slide 15: Skalabilitas (10.000+ Users)

**Judul Slide:** Skalabilitas — 10.000+ Pengguna

**Isi Slide:**
```
Skala 10.000 Pengguna (3.000 Pemilik + 7.000 Penghuni)

Arsitektur Enterprise:
┌─────────────────┐
│ Global Load      │
│ Balancer (DNS)   │
├────────┬────────┤
│ Region1│ Region2│ ← Multi-region
├────────┴────────┤
│ App Fleet 10-20 │ ← Auto-scaling group
│ Redis Cluster   │ ← Multi-AZ
│ MySQL Multi-AZ  │ → 3x Read Replicas
│ Search Engine   │ → Elasticsearch
│ CDN Global      │ → CloudFront
│ Object Storage  │ → S3 Cross-Region
└─────────────────┘

Rekomendasi Tambahan:
• Microservices: pisahkan Auth, Kos, Payment, Notification
• Database sharding per region
• APM: Laravel Telescope + Prometheus + Grafana
• Auto-scaling policy berdasarkan CPU/RAM/request count
```

**Penjelasan Presenter:**
"Untuk 10.000+ pengguna, diperlukan arsitektur multi-region dengan auto-scaling, database read replicas, Elasticsearch untuk pencarian, dan CDN global. Pada skala ini, migrasi ke microservices mungkin perlu dipertimbangkan untuk isolasi dan skalabilitas yang lebih baik."

---

## Slide 16: Rekomendasi Pengembangan

**Judul Slide:** Rekomendasi Pengembangan

**Isi Slide:**
```
Prioritas Tinggi (Tahap 1):
┌──────────────────────────────────────────────┐
│ 🏢 Multi-Tenant     → Isolasi data per tenant │
│ 💳 Subscription     → Model bisnis SaaS       │
│ 💰 Payment Gateway  → Midtrans/Xendit         │
│ 💾 Backup Auto      → Daily ke cloud storage  │
└──────────────────────────────────────────────┘

Prioritas Sedang (Tahap 2):
┌──────────────────────────────────────────────┐
│ 📱 Mobile App      → Flutter / React Native  │
│ 🔔 Notif Real-time → Pusher / WebSocket      │
│ 📊 Monitoring Cloud→ Laravel Pulse/Telescope │
│ 🔌 Public API      → Untuk third-party       │
└──────────────────────────────────────────────┘

Prioritas Rendah (Tahap 3):
┌──────────────────────────────────────────────┐
│ 🤖 AI Recommendations → Rekomendasi kos       │
│ 📄 PDF Reports        → Invoice & laporan     │
└──────────────────────────────────────────────┘
```

**Penjelasan Presenter:**
"Rekomendasi pengembangan dibagi tiga prioritas. Tahap 1 fokus pada fondasi bisnis: multi-tenant, subscription, payment gateway, dan backup. Tahap 2 fokus pada engagement: mobile app, real-time notification, dan API publik. Tahap 3 untuk advanced features seperti AI dan laporan PDF."

---

## Slide 17: Judul Proyek

**Judul Slide:** Rekomendasi Judul Proyek

**Isi Slide:**
```
3 Judul Terbaik:

1️⃣ Analisis dan Implementasi Cloud Computing
   pada Sistem Informasi Manajemen Kos
   Berbasis SaaS
   → Komprehensif, sesuai isi presentasi

2️⃣ Pengembangan Aplikasi Manajemen Kos
   Multi-Tenant Menggunakan Arsitektur
   Cloud Computing
   → Fokus multi-tenant, inovatif

3️⃣ Perancangan Arsitektur SaaS untuk
   Sistem Informasi Penyewaan Kos
   Berbasis Web
   → Fokus perancangan, mudah dipahami

🏆 Rekomendasi: Judul 1
```

**Penjelasan Presenter:**
"Tiga judul terbaik yang direkomendasikan. Judul pertama paling sesuai dengan isi presentasi karena mencakup analisis dan implementasi cloud computing secara komprehensif."

---

## Slide 18: Kesimpulan

**Judul Slide:** Kesimpulan

**Isi Slide:**
```
Kesimpulan:

1. AyoKos adalah aplikasi SaaS yang memenuhi
   5 karakteristik cloud computing NIST

2. Sistem mendukung 3 role dengan fitur lengkap:
   Pemilik (11 fitur) | Penghuni (7 fitur) | Admin

3. Arsitektur siap scale dari 100 → 10.000+ users

4. Security: authentication baik, authorization
   perlu ditingkatkan dengan Laravel Policy

5. Public cloud adalah deployment model terbaik

6. Model bisnis SaaS perlu subscription system
   untuk monetisasi berkelanjutan

7. Fitur Admin perlu dikembangkan: dashboard
   monitoring, verifikasi pemilik, audit log
```

**Penjelasan Presenter:**
"Kesimpulan dari presentasi ini: AyoKos adalah SaaS yang memenuhi standar cloud computing. Siap diskalakan, dengan keamanan yang baik namun masih bisa ditingkatkan. Model bisnis ke depan perlu subscription system."

---

## Slide 19: Saran

**Judul Slide:** Saran

**Isi Slide:**
```
Saran untuk Pengembangan ke Depan:

1. Implementasi true multi-tenancy dengan
   tenant_id column dan Global Scope

2. Aktifkan Laravel Policy/Gates untuk
   authorization yang lebih terstruktur

3. Migrasi cache & queue ke Redis untuk
   performa lebih baik

4. Integrasi payment gateway otomatis
   (Midtrans/Xendit)

5. Kembangkan dashboard admin dengan
   monitoring real-time

6. Implementasi backup automation ke
   cloud storage

7. Buat API documentation (Swagger/Scribe)
   untuk memudahkan integrasi
```

**Penjelasan Presenter:**
"Saran saya untuk pengembangan ke depan: fokus pada true multi-tenancy, perbaiki authorization dengan Laravel Policy, migrasi ke Redis untuk performa, dan integrasi payment gateway. Jangan lupa backup automation dan dokumentasi API."

---

## Slide 20: Penutup

**Judul Slide:** Terima Kasih

**Isi Slide:**
```
Terima Kasih

───

Pertanyaan & Diskusi

───

Kontak:
Nama: [Nama Mahasiswa]
Email: [email@example.com]

───

"AyoKos — Solusi Manajemen Kos
di Era Cloud Computing"
```

**Penjelasan Presenter:**
"Demikian presentasi saya. Saya siap menerima pertanyaan dan diskusi. Terima kasih atas perhatiannya."
