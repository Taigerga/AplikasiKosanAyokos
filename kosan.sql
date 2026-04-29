-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 27 Jan 2026 pada 14.51
-- Versi server: 8.4.3
-- Versi PHP: 8.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `kosan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` bigint UNSIGNED NOT NULL,
  `nama_fasilitas` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` enum('umum','kamar_mandi','dapur','parkir','keamanan','lainnya') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'umum',
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `fasilitas`
--

INSERT INTO `fasilitas` (`id_fasilitas`, `nama_fasilitas`, `kategori`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'WiFi', 'umum', 'wifi', '2026-01-26 07:50:41', NULL),
(2, 'Laundry', 'umum', 'laundry', '2026-01-26 07:50:41', NULL),
(3, 'Dapur Bersama', 'umum', 'kitchen', '2026-01-26 07:50:41', NULL),
(4, 'Kamar Mandi Dalam', 'kamar_mandi', 'bath', '2026-01-26 07:50:41', NULL),
(5, 'Air Panas', 'kamar_mandi', 'hot-water', '2026-01-26 07:50:41', NULL),
(6, 'Parkir Motor', 'parkir', 'motorcycle', '2026-01-26 07:50:41', NULL),
(7, 'Parkir Mobil', 'parkir', 'car', '2026-01-26 07:50:41', NULL),
(8, 'CCTV', 'keamanan', 'cctv', '2026-01-26 07:50:41', NULL),
(9, 'Security 24 Jam', 'keamanan', 'security', '2026-01-26 07:50:41', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto_kos`
--

CREATE TABLE `foto_kos` (
  `id_foto` bigint UNSIGNED NOT NULL,
  `id_kos` bigint UNSIGNED NOT NULL,
  `nama_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` bigint UNSIGNED NOT NULL,
  `id_kos` bigint UNSIGNED NOT NULL,
  `nomor_kamar` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_kamar` enum('Standar','Deluxe','VIP','Superior','Ekonomi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `luas_kamar` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kapasitas` int NOT NULL DEFAULT '1',
  `fasilitas_kamar` text COLLATE utf8mb4_unicode_ci,
  `foto_kamar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_kamar` enum('tersedia','terisi','maintenance') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `id_kos`, `nomor_kamar`, `tipe_kamar`, `harga`, `luas_kamar`, `kapasitas`, `fasilitas_kamar`, `foto_kamar`, `status_kamar`, `created_at`, `updated_at`) VALUES
(1, 1, 'A1', 'VIP', 2000000.00, '5x8', 1, '\"[\\\"Kamar mandi dalam\\\",\\\"AC\\\",\\\"TV\\\",\\\"WiFi\\\",\\\"Kasur\\\",\\\"Lemari\\\",\\\"Meja belajar\\\",\\\"Kursi\\\",\\\"Dapur\\\",\\\"Jendela\\\",\\\"Balkon\\\"]\"', 'kamar/kamar_1769438465_69777d01b44d9.jpg', 'terisi', '2026-01-26 07:41:05', '2026-01-26 08:28:30'),
(2, 1, 'A2', 'Standar', 1000000.00, '4x5', 1, '\"[\\\"Kamar mandi dalam\\\",\\\"Kipas angin\\\",\\\"WiFi\\\",\\\"Kasur\\\",\\\"Lemari\\\",\\\"Meja belajar\\\",\\\"Kursi\\\",\\\"Jendela\\\"]\"', 'kamar/kamar_1769438525_69777d3d2d69d.jpg', 'terisi', '2026-01-26 07:42:05', '2026-01-26 08:06:11'),
(3, 1, 'A3', 'Standar', 80000.00, '3x5', 1, '\"[\\\"Kamar mandi dalam\\\",\\\"Kipas angin\\\",\\\"WiFi\\\",\\\"Kasur\\\",\\\"Lemari\\\",\\\"Meja belajar\\\",\\\"Kursi\\\"]\"', 'kamar/kamar_1769441186_697787a27e7e1.jpg', 'tersedia', '2026-01-26 08:26:26', '2026-01-26 08:26:26'),
(4, 3, 'BD21', 'VIP', 2000000.00, '4x7', 1, '\"[\\\"Kamar mandi dalam\\\",\\\"AC\\\",\\\"WiFi\\\",\\\"Kasur\\\",\\\"Lemari\\\",\\\"Meja belajar\\\",\\\"Kursi\\\"]\"', 'kamar/kamar_1769493835_6978554b71e9a.jpg', 'tersedia', '2026-01-26 23:03:56', '2026-01-26 23:03:56'),
(5, 3, 'BD22', 'Standar', 1000000.00, '3x4', 1, '\"[\\\"Kamar mandi dalam\\\",\\\"Meja belajar\\\",\\\"Kursi\\\",\\\"Kulkas mini\\\"]\"', NULL, 'terisi', '2026-01-26 23:10:41', '2026-01-27 06:03:42'),
(6, 2, 'B11', 'Standar', 1000000.00, '3x5', 3, 'null', NULL, 'terisi', '2026-01-26 23:23:34', '2026-01-27 05:42:49'),
(7, 2, 'BD11', 'Standar', 1000000.00, '3x5', 3, 'null', NULL, 'tersedia', '2026-01-26 23:24:11', '2026-01-26 23:24:11'),
(8, 2, 'BD12', 'Standar', 1000000.00, '3x6', 2, '\"[\\\"WiFi\\\"]\"', NULL, 'tersedia', '2026-01-26 23:25:41', '2026-01-26 23:25:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontrak_sewa`
--

CREATE TABLE `kontrak_sewa` (
  `id_kontrak` bigint UNSIGNED NOT NULL,
  `id_penghuni` bigint UNSIGNED NOT NULL,
  `id_kos` bigint UNSIGNED NOT NULL,
  `id_kamar` bigint UNSIGNED NOT NULL,
  `foto_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `durasi_sewa` int NOT NULL DEFAULT '1',
  `harga_sewa` decimal(12,2) NOT NULL,
  `status_kontrak` enum('pending','aktif','selesai','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `alasan_ditolak` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notif_menunggu_dikirim` timestamp NULL DEFAULT NULL,
  `notif_disetujui_dikirim` timestamp NULL DEFAULT NULL,
  `notif_tolak_dikirim` timestamp NULL DEFAULT NULL,
  `notif_5hari_dikirim` timestamp NULL DEFAULT NULL,
  `notif_habis_dikirim` timestamp NULL DEFAULT NULL,
  `notif_7hari_dikirim` timestamp NULL DEFAULT NULL,
  `notif_3hari_dikirim` timestamp NULL DEFAULT NULL,
  `notif_h1_dikirim` timestamp NULL DEFAULT NULL,
  `notif_hari_ini_dikirim` timestamp NULL DEFAULT NULL,
  `notif_terlambat_dikirim` timestamp NULL DEFAULT NULL,
  `notif_perpanjangan_dikirim` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kontrak_sewa`
--

INSERT INTO `kontrak_sewa` (`id_kontrak`, `id_penghuni`, `id_kos`, `id_kamar`, `foto_ktp`, `tanggal_daftar`, `tanggal_mulai`, `tanggal_selesai`, `durasi_sewa`, `harga_sewa`, `status_kontrak`, `alasan_ditolak`, `created_at`, `updated_at`, `notif_menunggu_dikirim`, `notif_disetujui_dikirim`, `notif_tolak_dikirim`, `notif_5hari_dikirim`, `notif_habis_dikirim`, `notif_7hari_dikirim`, `notif_3hari_dikirim`, `notif_h1_dikirim`, `notif_hari_ini_dikirim`, `notif_terlambat_dikirim`, `notif_perpanjangan_dikirim`) VALUES
(1, 2, 1, 2, 'ktp/FDEpqnZYO4DRu77g7htChgjUavQ3c47PiiHCM378.jpg', '2026-01-26', '2026-01-26', '2026-02-25', 1, 1000000.00, 'aktif', NULL, '2026-01-26 07:55:58', '2026-01-26 10:48:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 1, 1, 'ktp/CTbJyaNZSDMd1QEOkjfK3PSD96a30sf0ewq0s1Mk.jpg', '2026-01-26', '2026-01-26', '2026-03-25', 1, 2000000.00, 'aktif', NULL, '2026-01-26 08:27:30', '2026-01-26 10:51:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 2, 6, 'ktp/DVdP5ryHIjik0w2CCot1ttJOzfRl4ucwHR0JIfT1.jpg', '2026-01-27', NULL, NULL, 1, 1000000.00, 'aktif', NULL, '2026-01-27 05:40:53', '2026-01-27 05:42:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 3, 5, 'ktp/dHgqZ6eOG0fkMdWbuG6Y5jV9jFsrFBEXXlXGLpk2.jpg', '2026-01-27', '2026-01-27', '2027-01-26', 1, 1000000.00, 'aktif', NULL, '2026-01-27 06:02:53', '2026-01-27 06:07:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kos`
--

CREATE TABLE `kos` (
  `id_kos` bigint UNSIGNED NOT NULL,
  `id_pemilik` bigint UNSIGNED NOT NULL,
  `nama_kos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_pos` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `peraturan` text COLLATE utf8mb4_unicode_ci,
  `jenis_kos` enum('putra','putri','campuran') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_sewa` enum('harian','mingguan','bulanan','tahunan') COLLATE utf8mb4_unicode_ci DEFAULT 'bulanan',
  `foto_utama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_kos` enum('aktif','nonaktif','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kos`
--

INSERT INTO `kos` (`id_kos`, `id_pemilik`, `nama_kos`, `alamat`, `kecamatan`, `kota`, `provinsi`, `kode_pos`, `latitude`, `longitude`, `deskripsi`, `peraturan`, `jenis_kos`, `tipe_sewa`, `foto_utama`, `status_kos`, `created_at`, `updated_at`) VALUES
(1, 1, 'SetiaA', 'Dago, Coblong, Kota Bandung, Jawa Barat, Jawa, 40135, Indonesia', 'Dago', 'Kota Bandung', 'Jawa Barat', '40135', -6.87549400, 107.61658500, 'Kosan hanya untuk perempuan, tidak untuk femboy, kalau tomboy boleh', 'Tidak Boleh keluar lebih dari jam 10 \r\nGak boleh bawa LAKI\r\nSisa nya bebas', 'putri', 'bulanan', 'kos/kos_1769438121.jpg', 'aktif', '2026-01-26 07:35:21', '2026-01-27 04:06:18'),
(2, 2, 'Budi1', 'SPBU Batutulis, Jalan Batu Tulis, Batu Tulis, Bogor Selatan, Bogor, Jawa Barat, Jawa, 16131, Indonesia', 'Bogor Selatan', 'Bogor', 'Jawa Barat', '16131', -6.62061600, 106.80706400, 'sefgwe', 'gawfwg', 'campuran', 'mingguan', 'kos/kos_1769492283.jpg', 'aktif', '2026-01-26 22:38:03', '2026-01-26 22:38:03'),
(3, 2, 'Budi2', 'Jalan Muria Tanjakan, RW 12, Pasar Manggis, Setiabudi, Jakarta Selatan, Daerah Khusus Ibukota Jakarta, Jawa, 12970, Indonesia', 'Setiabudi', 'Jakarta Selatan', 'Jawa', '12970', -6.21214100, 106.83762400, 'dvsz', 'vszvzsv', 'campuran', 'tahunan', 'kos/kos_1769493780.jpg', 'aktif', '2026-01-26 23:03:00', '2026-01-26 23:03:00'),
(4, 1, 'SetiaB', 'Dago, Coblong, Kota Bandung, Jawa Barat, Jawa, 40135, Indonesia', 'Dago', 'Kota Bandung', 'Jawa Barat', '40135', -6.87549400, 107.61658500, NULL, NULL, 'campuran', 'bulanan', 'kos/kos_1769510452.jpg', 'aktif', '2026-01-27 03:40:53', '2026-01-27 03:40:53'),
(5, 1, 'SetiaC', 'Dago, Coblong, Kota Bandung, Jawa Barat, Jawa, 40135, Indonesia', 'Dago', 'Kota Bandung', 'Jawa Barat', '40135', -6.87549400, 107.61658500, 'AVgasgwg', 'fawfaccc', 'putri', 'bulanan', 'kos/kos_1769516937.jpg', 'aktif', '2026-01-27 05:28:57', '2026-01-27 05:28:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kos_fasilitas`
--

CREATE TABLE `kos_fasilitas` (
  `id_kos_fasilitas` bigint UNSIGNED NOT NULL,
  `id_kos` bigint UNSIGNED NOT NULL,
  `id_fasilitas` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kos_fasilitas`
--

INSERT INTO `kos_fasilitas` (`id_kos_fasilitas`, `id_kos`, `id_fasilitas`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 1, 5, NULL, NULL),
(6, 1, 6, NULL, NULL),
(7, 1, 7, NULL, NULL),
(8, 1, 8, NULL, NULL),
(9, 1, 9, NULL, NULL),
(10, 2, 1, NULL, NULL),
(11, 2, 2, NULL, NULL),
(12, 2, 4, NULL, NULL),
(13, 3, 1, NULL, NULL),
(14, 3, 2, NULL, NULL),
(15, 3, 3, NULL, NULL),
(16, 3, 4, NULL, NULL),
(17, 3, 5, NULL, NULL),
(18, 3, 6, NULL, NULL),
(19, 3, 7, NULL, NULL),
(20, 3, 8, NULL, NULL),
(21, 3, 9, NULL, NULL),
(22, 4, 1, NULL, NULL),
(23, 4, 2, NULL, NULL),
(24, 4, 3, NULL, NULL),
(25, 4, 4, NULL, NULL),
(26, 4, 5, NULL, NULL),
(27, 4, 6, NULL, NULL),
(28, 4, 7, NULL, NULL),
(29, 4, 8, NULL, NULL),
(30, 4, 9, NULL, NULL),
(31, 5, 1, NULL, NULL),
(32, 5, 2, NULL, NULL),
(33, 5, 3, NULL, NULL),
(34, 5, 4, NULL, NULL),
(35, 5, 5, NULL, NULL),
(36, 5, 6, NULL, NULL),
(37, 5, 7, NULL, NULL),
(38, 5, 8, NULL, NULL),
(39, 5, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_03_134753_create_pemilik_table', 1),
(5, '2025_11_03_134943_create_penghuni_table', 1),
(6, '2025_11_03_134952_create_kos_table', 1),
(7, '2025_11_03_134958_create_kamar_table', 1),
(8, '2025_11_03_135003_create_fasilitas_table', 1),
(9, '2025_11_03_135022_create_kos_fasilitas_table', 1),
(10, '2025_11_03_135027_create_foto_kos_table', 1),
(11, '2025_11_03_135031_create_kontrak_sewa_table', 1),
(12, '2025_11_03_135035_create_pembayaran_table', 1),
(13, '2025_11_03_135039_create_reviews_table', 1),
(14, '2025_11_03_135044_create_notifications_table', 1),
(15, '2025_11_03_135047_create_pengaturan_kos_table', 1),
(16, '2025_11_07_050212_add_remember_token_to_penghuni_and_pemilik_tables', 1),
(17, '2025_11_11_102436_create_kosans_table', 1),
(18, '2025_11_24_150904_migration_add_whatsapp_notification_columns_to_kontrak_sewa', 1),
(19, '2025_12_20_112346_add_notification_tracking_to_kontrak_sewa', 1),
(20, '2026_01_10_000001_add_fields_to_pemilik_table', 1),
(21, '2026_01_10_000002_drop_nik_from_kontrak_sewa_table', 1),
(22, '2026_01_10_000003_add_nik_to_pemilik_table', 1),
(23, '2026_01_10_000004_drop_foto_ktp_from_users', 1),
(24, '2026_01_13_000001_make_bukti_pembayaran_nullable_on_kontrak_sewa_table', 1),
(25, '2026_01_13_999999_remove_bukti_pembayaran_from_kontrak_sewa_table', 1),
(26, '2026_01_18_060129_add_bank_details_to_pemilik_and_dates_to_pembayaran_table', 1),
(27, '2026_01_18_060256_add_jenis_pembayaran_to_pembayaran_table', 1),
(28, '2026_01_18_130500_update_payment_and_owner_tables', 1),
(29, '2026_01_18_131000_add_jenis_pembayaran_to_pembayaran_table', 1),
(30, '2026_01_25_000001_remove_unique_constraints_from_pemilik_table', 1),
(31, '2026_01_25_000002_remove_unique_constraints_from_penghuni_table', 1),
(32, 'migration remove_nik_from_penghuni_and_pemilik_tables', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` bigint UNSIGNED NOT NULL,
  `id_kontrak` bigint UNSIGNED NOT NULL,
  `id_penghuni` bigint UNSIGNED NOT NULL,
  `bulan_tahun` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_mulai_sewa` date DEFAULT NULL,
  `tanggal_akhir_sewa` date DEFAULT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `jumlah` decimal(12,2) NOT NULL,
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metode_pembayaran` enum('transfer','cash','qris') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'transfer',
  `status_pembayaran` enum('belum','lunas','terlambat','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum',
  `jenis_pembayaran` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'rutin',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_kontrak`, `id_penghuni`, `bulan_tahun`, `tanggal_mulai_sewa`, `tanggal_akhir_sewa`, `tanggal_jatuh_tempo`, `tanggal_bayar`, `jumlah`, `bukti_pembayaran`, `metode_pembayaran`, `status_pembayaran`, `jenis_pembayaran`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '2026-01', '2026-01-26', '2026-02-25', '2026-01-26', '2026-01-26', 2000000.00, 'bukti_pembayaran/1769449388_2_6977a7ac5285f.jpg', 'transfer', 'lunas', 'rutin', 'Pembayaran rutin (1 bulanan)', '2026-01-26 10:43:08', '2026-01-26 10:44:24'),
(2, 1, 2, '2026-01', '2026-01-26', '2026-02-25', '2026-01-26', '2026-01-26', 1000000.00, 'bukti_pembayaran/1769449637_2_6977a8a56d415.jpg', 'transfer', 'lunas', 'rutin', 'Pembayaran rutin (1 bulanan)', '2026-01-26 10:47:17', '2026-01-26 10:48:14'),
(3, 2, 2, '2026-02', '2026-02-26', '2026-03-25', '2026-02-26', '2026-01-26', 2000000.00, 'bukti_pembayaran/1769449831_2_6977a9675c0bd.jpg', 'transfer', 'lunas', 'advance', 'Pembayaran di muka (perpanjangan otomatis) (1 bulanan)', '2026-01-26 10:50:31', '2026-01-26 10:51:05'),
(4, 3, 2, '2026-01', '2026-01-27', '2026-02-02', '2026-01-27', NULL, 1000000.00, 'bukti_pembayaran/1769517841_2_6978b3118f140.jpg', 'transfer', 'belum', 'rutin', 'Pembayaran rutin (1 mingguan)', '2026-01-27 05:44:01', '2026-01-27 05:44:40'),
(5, 3, 2, '2026-01', '2026-01-27', '2026-02-02', '2026-01-27', NULL, 1000000.00, 'bukti_pembayaran/1769518736_2_6978b690b8d25.jpg', 'transfer', 'belum', 'rutin', 'Pembayaran rutin (1 mingguan)', '2026-01-27 05:58:56', '2026-01-27 05:59:30'),
(6, 4, 1, '2026-01', '2026-01-27', '2027-01-26', '2026-01-27', '2026-01-27', 1000000.00, 'bukti_pembayaran/1769519239_1_6978b8872f0be.jpg', 'transfer', 'lunas', 'rutin', 'Pembayaran rutin (1 tahunan)', '2026-01-27 06:07:19', '2026-01-27 06:07:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilik`
--

CREATE TABLE `pemilik` (
  `id_pemilik` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `foto_profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `status_pemilik` enum('aktif','nonaktif','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `role` enum('pemilik') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pemilik',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notif_pengajuan_baru_dikirim` timestamp NULL DEFAULT NULL,
  `nama_bank` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_rekening` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pemilik`
--

INSERT INTO `pemilik` (`id_pemilik`, `nama`, `no_hp`, `email`, `jenis_kelamin`, `tanggal_lahir`, `foto_profil`, `username`, `password`, `remember_token`, `alamat`, `status_pemilik`, `role`, `created_at`, `updated_at`, `notif_pengajuan_baru_dikirim`, `nama_bank`, `nomor_rekening`) VALUES
(1, 'Yanto', '6282121730722', 'mrizkiaksel@gmail.com', NULL, '2009-01-26', NULL, 'Yanto27', '$2y$12$PAmjTjWwo9gfUSEl6IKooOR7.rOLgPAeOo.FRiVO6lsLBYVhOo/.W', NULL, 'Dago, Coblong, Bandung City, West Java, Java, Indonesia', 'pending', 'pemilik', '2026-01-26 07:32:49', '2026-01-26 09:38:43', NULL, 'BCA', '1927481293'),
(2, 'Layn', '6282121730722', 'mrizkiaksel@gmail.com', NULL, '2009-01-04', NULL, 'Layn1', '$2y$12$2seODjsqNw5jJ2nBjoK..u5OIVtC6ZEL1FcBf0o3hUA/6dU2Rzd42', NULL, 'Dago, Coblong, Bandung City, West Java, Java, Indonesia', 'pending', 'pemilik', '2026-01-26 22:23:25', '2026-01-26 22:23:25', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan_kos`
--

CREATE TABLE `pengaturan_kos` (
  `id_pengaturan` bigint UNSIGNED NOT NULL,
  `id_kos` bigint UNSIGNED NOT NULL,
  `notifikasi_pembayaran_h_min` int NOT NULL DEFAULT '5',
  `denda_keterlambatan` decimal(5,2) NOT NULL DEFAULT '0.00',
  `toleransi_keterlambatan` int NOT NULL DEFAULT '7',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penghuni`
--

CREATE TABLE `penghuni` (
  `id_penghuni` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `foto_profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_penghuni` enum('calon','aktif','nonaktif','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'calon',
  `role` enum('penghuni') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'penghuni',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penghuni`
--

INSERT INTO `penghuni` (`id_penghuni`, `nama`, `no_hp`, `email`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `foto_profil`, `username`, `password`, `remember_token`, `status_penghuni`, `role`, `created_at`, `updated_at`) VALUES
(1, 'GAGA', '6282121730722', 'iluminati270306@gmail.com', 'L', '2009-01-19', 'Dago, Coblong, Bandung City, West Java, Java, Indonesia', NULL, 'GAGX', '$2y$12$F4hIBw9s/Iq97A4OkoBlMeUM8RxtdqG3JLsSLDRaqoytWRPGyEkPS', NULL, 'aktif', 'penghuni', '2026-01-26 07:46:06', '2026-01-27 06:03:42'),
(2, 'Luna', '6282121730722', 'mrizkiaksel@gmail.com', 'P', '2009-01-05', 'Dago, Coblong, Bandung City, West Java, Java, Indonesia', NULL, 'Luna1', '$2y$12$vPo/lO32AHLrRpDfcO39j.A9JfZO1Pyu/5X.3WqQYmY53B5VKgd9C', NULL, 'aktif', 'penghuni', '2026-01-26 07:53:35', '2026-01-27 05:42:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reviews`
--

CREATE TABLE `reviews` (
  `id_review` bigint UNSIGNED NOT NULL,
  `id_kos` bigint UNSIGNED NOT NULL,
  `id_penghuni` bigint UNSIGNED NOT NULL,
  `id_kontrak` bigint UNSIGNED NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci,
  `foto_review` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `reviews`
--

INSERT INTO `reviews` (`id_review`, `id_kos`, `id_penghuni`, `id_kontrak`, `rating`, `komentar`, `foto_review`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 4.0, 'Meh lumayan untuk harga segitu', 'reviews/review_1769450249.png', '2026-01-26 10:57:29', '2026-01-26 10:57:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CpYgun83JnCE9cBJ9sWW8ogJjy3B7VmlssETDRxR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUlJtbm1uNVRYSElSOUo1ZWFabDVYNGgzZmpyQ0E4M0VQd3lvWjE4ZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rb3MvMSI7czo1OiJyb3V0ZSI7czoxNToicHVibGljLmtvcy5zaG93Ijt9czo1NToibG9naW5fcGVuZ2h1bmlfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1769521899);

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`),
  ADD UNIQUE KEY `fasilitas_nama_fasilitas_unique` (`nama_fasilitas`);

--
-- Indeks untuk tabel `foto_kos`
--
ALTER TABLE `foto_kos`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `foto_kos_id_kos_foreign` (`id_kos`);

--
-- Indeks untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`),
  ADD UNIQUE KEY `kamar_id_kos_nomor_kamar_unique` (`id_kos`,`nomor_kamar`);

--
-- Indeks untuk tabel `kontrak_sewa`
--
ALTER TABLE `kontrak_sewa`
  ADD PRIMARY KEY (`id_kontrak`),
  ADD KEY `kontrak_sewa_id_penghuni_foreign` (`id_penghuni`),
  ADD KEY `kontrak_sewa_id_kos_foreign` (`id_kos`),
  ADD KEY `kontrak_sewa_id_kamar_foreign` (`id_kamar`);

--
-- Indeks untuk tabel `kos`
--
ALTER TABLE `kos`
  ADD PRIMARY KEY (`id_kos`),
  ADD KEY `kos_id_pemilik_foreign` (`id_pemilik`);

--
-- Indeks untuk tabel `kos_fasilitas`
--
ALTER TABLE `kos_fasilitas`
  ADD PRIMARY KEY (`id_kos_fasilitas`),
  ADD UNIQUE KEY `kos_fasilitas_id_kos_id_fasilitas_unique` (`id_kos`,`id_fasilitas`),
  ADD KEY `kos_fasilitas_id_fasilitas_foreign` (`id_fasilitas`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `pembayaran_id_kontrak_foreign` (`id_kontrak`),
  ADD KEY `pembayaran_id_penghuni_foreign` (`id_penghuni`);

--
-- Indeks untuk tabel `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`id_pemilik`);

--
-- Indeks untuk tabel `pengaturan_kos`
--
ALTER TABLE `pengaturan_kos`
  ADD PRIMARY KEY (`id_pengaturan`),
  ADD UNIQUE KEY `pengaturan_kos_id_kos_unique` (`id_kos`);

--
-- Indeks untuk tabel `penghuni`
--
ALTER TABLE `penghuni`
  ADD PRIMARY KEY (`id_penghuni`);

--
-- Indeks untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `reviews_id_kos_foreign` (`id_kos`),
  ADD KEY `reviews_id_penghuni_foreign` (`id_penghuni`),
  ADD KEY `reviews_id_kontrak_foreign` (`id_kontrak`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `foto_kos`
--
ALTER TABLE `foto_kos`
  MODIFY `id_foto` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `kontrak_sewa`
--
ALTER TABLE `kontrak_sewa`
  MODIFY `id_kontrak` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kos`
--
ALTER TABLE `kos`
  MODIFY `id_kos` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kos_fasilitas`
--
ALTER TABLE `kos_fasilitas`
  MODIFY `id_kos_fasilitas` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pemilik`
--
ALTER TABLE `pemilik`
  MODIFY `id_pemilik` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pengaturan_kos`
--
ALTER TABLE `pengaturan_kos`
  MODIFY `id_pengaturan` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penghuni`
--
ALTER TABLE `penghuni`
  MODIFY `id_penghuni` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id_review` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `foto_kos`
--
ALTER TABLE `foto_kos`
  ADD CONSTRAINT `foto_kos_id_kos_foreign` FOREIGN KEY (`id_kos`) REFERENCES `kos` (`id_kos`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_id_kos_foreign` FOREIGN KEY (`id_kos`) REFERENCES `kos` (`id_kos`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kontrak_sewa`
--
ALTER TABLE `kontrak_sewa`
  ADD CONSTRAINT `kontrak_sewa_id_kamar_foreign` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE CASCADE,
  ADD CONSTRAINT `kontrak_sewa_id_kos_foreign` FOREIGN KEY (`id_kos`) REFERENCES `kos` (`id_kos`) ON DELETE CASCADE,
  ADD CONSTRAINT `kontrak_sewa_id_penghuni_foreign` FOREIGN KEY (`id_penghuni`) REFERENCES `penghuni` (`id_penghuni`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kos`
--
ALTER TABLE `kos`
  ADD CONSTRAINT `kos_id_pemilik_foreign` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id_pemilik`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kos_fasilitas`
--
ALTER TABLE `kos_fasilitas`
  ADD CONSTRAINT `kos_fasilitas_id_fasilitas_foreign` FOREIGN KEY (`id_fasilitas`) REFERENCES `fasilitas` (`id_fasilitas`) ON DELETE CASCADE,
  ADD CONSTRAINT `kos_fasilitas_id_kos_foreign` FOREIGN KEY (`id_kos`) REFERENCES `kos` (`id_kos`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_id_kontrak_foreign` FOREIGN KEY (`id_kontrak`) REFERENCES `kontrak_sewa` (`id_kontrak`) ON DELETE CASCADE,
  ADD CONSTRAINT `pembayaran_id_penghuni_foreign` FOREIGN KEY (`id_penghuni`) REFERENCES `penghuni` (`id_penghuni`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengaturan_kos`
--
ALTER TABLE `pengaturan_kos`
  ADD CONSTRAINT `pengaturan_kos_id_kos_foreign` FOREIGN KEY (`id_kos`) REFERENCES `kos` (`id_kos`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_id_kontrak_foreign` FOREIGN KEY (`id_kontrak`) REFERENCES `kontrak_sewa` (`id_kontrak`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_id_kos_foreign` FOREIGN KEY (`id_kos`) REFERENCES `kos` (`id_kos`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_id_penghuni_foreign` FOREIGN KEY (`id_penghuni`) REFERENCES `penghuni` (`id_penghuni`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
