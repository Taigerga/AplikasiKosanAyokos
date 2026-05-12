# Perbaikan Sistem Kontrak dan Pembayaran Kos

## Tujuan Perbaikan
Melakukan revisi pada sistem kontrak dan pembayaran kos agar:
- Durasi sewa mengikuti `tipe_sewa`
- Pengguna tetap bisa memilih lama durasi sewa
- Tanggal selesai otomatis dihitung berdasarkan:
  - `tanggal_mulai`
  - `durasi`
  - `tipe_sewa`

---

# Analisis Awal yang Wajib Dilakukan

Sebelum melakukan perubahan kode, pelajari terlebih dahulu:

## Database & Migrasi
Pelajari:
- `database/migrations/`

Fokus memahami:
- Struktur tabel kontrak
- Struktur tabel pembayaran
- Struktur tabel kamar
- Relasi foreign key
- Field:
  - `tanggal_mulai`
  - `tanggal_selesai`
  - `durasi`
  - `tipe_sewa`
  - `status_kontrak`
  - `status_pembayaran`

---

## Model
Pelajari:
- `app/Models/`

Fokus:
- Relasi model
- Fillable
- Casting tanggal
- Accessor/mutator

Terutama:
- `Kontrak`
- `Pembayaran`
- `Kamar`
- `Penghuni`

---

## Controller
Pelajari:
- `app/Http/Controllers/Penghuni/KontrakController.php`
- `app/Http/Controllers/Pemilik/KontrakController.php`
- `app/Http/Controllers/Penghuni/`
- `app/Http/Controllers/Pemilik/`
- `app/Http/Controllers/Public/`

Fokus memahami:
- Alur pendaftaran kontrak
- Approval kontrak
- Validasi kontrak
- Pembuatan pembayaran pertama
- Perpanjangan kontrak
- Relasi pembayaran dengan kontrak

---

# Revisi Form Kontrak

## File yang Direvisi
- `resources/views/penghuni/kontrak/create.blade.php`

---

# Konsep Lama
Sistem lama:
- Pengguna memilih durasi bebas/manual
- Tidak menyesuaikan tipe sewa kamar

Konsep ini harus direvisi.

---

# Konsep Baru

## Input yang Digunakan

Pengguna harus memilih:
1. `tanggal_mulai`
2. `durasi`
3. kamar dengan `tipe_sewa`

---

# Tipe Sewa yang Didukung

Nilai `tipe_sewa`:
- `harian`
- `mingguan`
- `bulanan`
- `tahunan`

---

# Aturan Durasi Berdasarkan Tipe Sewa

Pilihan durasi harus mengikuti tipe sewa kamar.

## Jika tipe_sewa = harian
Pilihan durasi:
- 1 hari
- 2 hari
- 3 hari
- dst

---

## Jika tipe_sewa = mingguan
Pilihan durasi:
- 1 minggu
- 2 minggu
- 3 minggu
- dst

---

## Jika tipe_sewa = bulanan
Pilihan durasi:
- 1 bulan
- 2 bulan
- 3 bulan
- dst

---

## Jika tipe_sewa = tahunan
Pilihan durasi:
- 1 tahun
- 2 tahun
- dst

---

# Perhitungan Tanggal Selesai

Tanggal selesai harus otomatis dihitung berdasarkan:
- `tanggal_mulai`
- `durasi`
- `tipe_sewa`

---

# Contoh Perhitungan

## Contoh 1
- Tanggal mulai: 11 Mei 2026
- Tipe sewa: bulanan
- Durasi: 1 bulan

Maka:
- Tanggal selesai: 11 Juni 2026

---

## Contoh 2
- Tanggal mulai: 11 Mei 2026
- Tipe sewa: bulanan
- Durasi: 3 bulan

Maka:
- Tanggal selesai: 11 Agustus 2026

---

## Contoh 3
- Tanggal mulai: 11 Mei 2026
- Tipe sewa: mingguan
- Durasi: 2 minggu

Maka:
- Tanggal selesai: 25 Mei 2026

---

## Contoh 4
- Tanggal mulai: 11 Mei 2026
- Tipe sewa: harian
- Durasi: 5 hari

Maka:
- Tanggal selesai: 16 Mei 2026

---

# Ketentuan Frontend

## Pada:
- `resources/views/penghuni/kontrak/create.blade.php`

Lakukan perubahan:

### Hapus
- Input durasi bebas yang tidak mengikuti tipe sewa

---

### Tambahkan
- Input `tanggal_mulai`
- Dropdown `durasi`
- Preview otomatis `tanggal_selesai`

---

# Ketentuan Dropdown Durasi

Dropdown durasi harus berubah otomatis berdasarkan `tipe_sewa`.

Contoh:
- Jika kamar bertipe `bulanan`
  maka dropdown berisi:
  - 1 bulan
  - 2 bulan
  - 3 bulan
  - dst

---

# JavaScript Frontend

Gunakan JavaScript untuk:
- Mengubah isi dropdown durasi berdasarkan tipe sewa
- Menghitung otomatis tanggal selesai saat:
  - tanggal mulai berubah
  - durasi berubah
  - kamar berubah

---

# Ketentuan Backend

## Pada Controller Kontrak

Lakukan validasi:
- tipe sewa valid
- durasi sesuai tipe sewa
- tanggal mulai valid

---

# Perhitungan Backend

Backend wajib:
- Menghitung ulang tanggal selesai
- Tidak boleh hanya mengandalkan JavaScript frontend

---

# Revisi Sistem Pembayaran Pertama

## File yang Direvisi
- `resources/views/penghuni/pembayaran/create.blade.php`

---

# Ketentuan Pembayaran Pertama

Saat kontrak pertama kali disetujui pemilik:

Penghuni:
- Tidak boleh memilih durasi tambahan
- Tidak boleh memperpanjang langsung
- Hanya membayar sesuai durasi kontrak awal

---

# Contoh

## Saat Daftar Kontrak
- Tanggal mulai: 11 Mei
- Tipe sewa: bulanan
- Durasi: 1 bulan

Maka:
- Pembayaran pertama hanya untuk periode:
  - 11 Mei — 11 Juni

Tidak boleh:
- bayar 2 bulan
- bayar 3 bulan
- tambah durasi

---

# Tampilan Pembayaran Pertama

Pada halaman pembayaran pertama:
- Hilangkan selection durasi
- Hilangkan pilihan perpanjangan
- Tampilkan:
  - tanggal mulai
  - tanggal selesai
  - total pembayaran
  - tombol bayar

---

# Perpanjangan Kontrak Berikutnya

## Ketentuan

Untuk pembayaran/perpanjangan selanjutnya:

Penghuni:
- Bebas memilih durasi tambahan
- Durasi tetap mengikuti tipe sewa kamar

---

# Contoh Perpanjangan

Jika tipe_sewa = bulanan:
- bisa tambah:
  - 1 bulan
  - 2 bulan
  - 3 bulan
  - dst

Jika tipe_sewa = mingguan:
- bisa tambah:
  - 1 minggu
  - 2 minggu
  - dst

---

# Hal yang Wajib Dijaga

Jangan merusak:
- approval kontrak
- status kamar
- status penghuni
- riwayat pembayaran
- validasi kontrak aktif
- dashboard penghuni
- dashboard pemilik
- sistem notifikasi

---

# Hasil Akhir yang Diharapkan

## Sistem Kontrak
- Durasi mengikuti tipe sewa
- Pengguna tetap bisa memilih lama sewa
- Tanggal selesai otomatis dihitung

---

## Sistem Pembayaran
- Pembayaran pertama sesuai kontrak awal
- Perpanjangan lebih fleksibel

---

## Sistem Keseluruhan
- Tetap kompatibel dengan flow lama
- Tidak merusak fitur existing
- Validasi frontend dan backend sinkron