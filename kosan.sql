-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 30 Apr 2026 pada 11.16
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
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `foto_profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_admin` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `user_id`, `nama`, `no_hp`, `email`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `foto_profil`, `status_admin`, `created_at`, `updated_at`) VALUES
(1, 1, 'Administrator', '08123456789', 'admin@ayokos.com', 'L', NULL, NULL, NULL, 'aktif', '2026-04-29 07:18:35', '2026-04-29 07:18:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'WiFi', 'umum', 'wifi', '2026-04-29 07:18:34', '2026-04-29 07:18:34'),
(2, 'Laundry', 'umum', 'laundry', '2026-04-29 07:18:34', '2026-04-29 07:18:34'),
(3, 'Dapur Bersama', 'umum', 'kitchen', '2026-04-29 07:18:34', '2026-04-29 07:18:34'),
(4, 'Kamar Mandi Dalam', 'kamar_mandi', 'bath', '2026-04-29 07:18:34', '2026-04-29 07:18:34'),
(5, 'Air Panas', 'kamar_mandi', 'hot-water', '2026-04-29 07:18:34', '2026-04-29 07:18:34'),
(6, 'Parkir Motor', 'parkir', 'motorcycle', '2026-04-29 07:18:34', '2026-04-29 07:18:34'),
(7, 'Parkir Mobil', 'parkir', 'car', '2026-04-29 07:18:34', '2026-04-29 07:18:34'),
(8, 'CCTV', 'keamanan', 'cctv', '2026-04-29 07:18:35', '2026-04-29 07:18:35'),
(9, 'Security 24 Jam', 'keamanan', 'security', '2026-04-29 07:18:35', '2026-04-29 07:18:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
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
(1, 1, 'A1', 'Deluxe', 1500000.00, '3x4', 1, 'AC, Tempat Tidur, Meja Belajar', NULL, 'tersedia', '2026-04-29 07:18:35', '2026-04-29 07:18:35'),
(2, 1, 'A2', 'Standar', 1200000.00, '3x3', 1, 'Tempat Tidur, Meja Belajar', NULL, 'tersedia', '2026-04-29 07:18:35', '2026-04-29 07:18:35'),
(3, 2, 'B1', 'VIP', 2000000.00, '4x5', 2, 'AC, Kulkas, TV, Tempat Tidur King Size', NULL, 'tersedia', '2026-04-29 07:18:36', '2026-04-29 07:18:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontrak_sewa`
--

CREATE TABLE `kontrak_sewa` (
  `id_kontrak` bigint UNSIGNED NOT NULL,
  `id_penghuni` bigint UNSIGNED NOT NULL,
  `id_kos` bigint UNSIGNED NOT NULL,
  `id_kamar` bigint UNSIGNED NOT NULL,
  `foto_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_daftar` date NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `durasi_sewa` int NOT NULL DEFAULT '1',
  `harga_sewa` decimal(12,2) NOT NULL,
  `status_kontrak` enum('pending','aktif','selesai','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `alasan_ditolak` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `tipe_sewa` enum('harian','mingguan','bulanan','tahunan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bulanan',
  `foto_utama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_kos` enum('aktif','nonaktif','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kos`
--

INSERT INTO `kos` (`id_kos`, `id_pemilik`, `nama_kos`, `alamat`, `kecamatan`, `kota`, `provinsi`, `kode_pos`, `latitude`, `longitude`, `deskripsi`, `peraturan`, `jenis_kos`, `tipe_sewa`, `foto_utama`, `status_kos`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kos Gracia Putri', 'Jalan Merdeka No. 123, Jakarta Selatan', 'Kebayoran Baru', 'Jakarta Selatan', 'DKI Jakarta', NULL, -6.20880000, 106.84560000, 'Kos nyaman dengan fasilitas lengkap dan lingkungan yang asri.', NULL, 'putri', 'bulanan', NULL, 'aktif', '2026-04-29 07:18:35', '2026-04-29 07:18:35'),
(2, 1, 'Kos Bahagia Putra', 'Jalan Sudirman No. 456, Jakarta Pusat', 'Tanah Abang', 'Jakarta Pusat', 'DKI Jakarta', NULL, -6.19090000, 106.82200000, 'Kos strategis dekat pusat kota dengan akses transportasi mudah.', NULL, 'putra', 'bulanan', NULL, 'aktif', '2026-04-29 07:18:35', '2026-04-29 07:18:35');

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
(1, 1, 5, '2026-04-29 07:18:36', '2026-04-29 07:18:36'),
(2, 2, 5, '2026-04-29 07:18:36', '2026-04-29 07:18:36'),
(3, 1, 8, '2026-04-29 07:18:36', '2026-04-29 07:18:36'),
(4, 2, 8, '2026-04-29 07:18:36', '2026-04-29 07:18:36'),
(5, 1, 3, '2026-04-29 07:18:36', '2026-04-29 07:18:36'),
(6, 2, 3, '2026-04-29 07:18:36', '2026-04-29 07:18:36'),
(7, 1, 4, '2026-04-29 07:18:36', '2026-04-29 07:18:36'),
(8, 2, 4, '2026-04-29 07:18:36', '2026-04-29 07:18:36'),
(9, 1, 2, '2026-04-29 07:18:36', '2026-04-29 07:18:36'),
(10, 2, 2, '2026-04-29 07:18:36', '2026-04-29 07:18:36'),
(11, 1, 7, '2026-04-29 07:18:36', '2026-04-29 07:18:36'),
(12, 2, 7, '2026-04-29 07:18:36', '2026-04-29 07:18:36'),
(13, 1, 6, '2026-04-29 07:18:36', '2026-04-29 07:18:36'),
(14, 2, 6, '2026-04-29 07:18:36', '2026-04-29 07:18:36'),
(15, 1, 9, '2026-04-29 07:18:37', '2026-04-29 07:18:37'),
(16, 2, 9, '2026-04-29 07:18:37', '2026-04-29 07:18:37'),
(17, 1, 1, '2026-04-29 07:18:37', '2026-04-29 07:18:37'),
(18, 2, 1, '2026-04-29 07:18:37', '2026-04-29 07:18:37');

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
(4, '2026_04_29_130901_create_pemilik_table', 1),
(5, '2026_04_29_130902_create_penghuni_table', 1),
(6, '2026_04_29_130903_create_admin_table', 1),
(7, '2026_04_29_130904_create_kos_table', 1),
(8, '2026_04_29_130905_create_fasilitas_table', 1),
(9, '2026_04_29_130906_create_kamar_table', 1),
(10, '2026_04_29_130907_create_kos_fasilitas_table', 1),
(11, '2026_04_29_130908_create_kontrak_sewa_table', 1),
(12, '2026_04_29_130909_create_pembayaran_table', 1),
(13, '2026_04_29_130910_create_reviews_table', 1),
(14, '2026_04_29_130920_create_notifications_table', 1),
(15, '2026_04_29_130921_create_sessions_table', 1),
(16, '2026_04_29_130922_create_cache_locks_table', 1),
(17, '2026_04_29_132520_create_permission_tables', 1),
(18, '2026_04_29_132520_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` json NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `denda` decimal(12,2) NOT NULL DEFAULT '0.00',
  `total_bayar` decimal(12,2) DEFAULT NULL,
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metode_pembayaran` enum('transfer','cash','qris') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'transfer',
  `status_pembayaran` enum('belum','lunas','terlambat','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum',
  `jenis_pembayaran` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'rutin',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilik`
--

CREATE TABLE `pemilik` (
  `id_pemilik` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `foto_profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_pemilik` enum('aktif','nonaktif','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `nama_bank` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_rekening` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pemilik`
--

INSERT INTO `pemilik` (`id_pemilik`, `user_id`, `nama`, `no_hp`, `email`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `foto_profil`, `status_pemilik`, `nama_bank`, `nomor_rekening`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pemilik Sample', '08123456789', 'pemilik@sample.com', 'L', NULL, NULL, NULL, 'aktif', NULL, NULL, '2026-04-29 07:18:35', '2026-04-29 07:18:35'),
(2, 2, 'Yanto', '082121730722', 'mrizkiaksel@gmail.com', 'L', NULL, NULL, NULL, 'pending', NULL, NULL, '2026-04-29 17:47:55', '2026-04-29 17:47:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penghuni`
--

CREATE TABLE `penghuni` (
  `id_penghuni` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `foto_profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_penghuni` enum('calon','aktif','nonaktif','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'calon',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penghuni`
--

INSERT INTO `penghuni` (`id_penghuni`, `user_id`, `nama`, `no_hp`, `email`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `foto_profil`, `status_penghuni`, `created_at`, `updated_at`) VALUES
(1, 3, 'Rizki', '082121730722', 'mrizkiaksel@gmail.com', 'L', NULL, NULL, NULL, 'calon', '2026-04-30 04:12:38', '2026-04-30 04:12:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('0caLHThb5uV6ajvRmQX1TTCvUBaFB0Em8Il2tEGg', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJIcVdKUEJ6U3dGRWJmTTNZTVRzb1hZNzNZbDFCQ1gwRk1wYTVUZU05IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL3BlbmdodW5pXC9kYXNoYm9hcmQiLCJyb3V0ZSI6InBlbmdodW5pLmRhc2hib2FyZCJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6M30=', 1777547598),
('Zq9rOwFzC01yWxnx6GB4sfD4S08ZuKZdbl8Os9QZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidnUyNmNPUWVYMVlibnlrb01ucVU1VDZ2U05MWHRKRDliVWh4ZU1hUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czoxMToicHVibGljLmhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1777547769);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','pemilik','penghuni') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$cYEkpBeLcLZDZUSdk3fRbOKWd3TE2HF6rsOtx2JTugkCu3ElmO876', 'admin', NULL, '2026-04-29 07:18:35', '2026-04-29 07:18:35'),
(2, 'Yanto27', '$2y$12$e1j.OqK3qpSUmnu62SSKlOJraCSYjpB4e.wfTrqeh3ok2bLM.z6XK', 'pemilik', NULL, '2026-04-29 17:47:55', '2026-04-29 17:47:55'),
(3, 'rizki1', '$2y$12$QuNisqBU1wBaNFfp5ohm2Otm/zLdXFgOU0bx.JNrSQsEx7UBI07Aa', 'penghuni', NULL, '2026-04-30 04:12:38', '2026-04-30 04:12:38');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `admin_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`),
  ADD UNIQUE KEY `fasilitas_nama_fasilitas_unique` (`nama_fasilitas`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

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
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
  ADD PRIMARY KEY (`id_pemilik`),
  ADD KEY `pemilik_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `penghuni`
--
ALTER TABLE `penghuni`
  ADD PRIMARY KEY (`id_penghuni`),
  ADD KEY `penghuni_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indeks untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `reviews_id_kos_foreign` (`id_kos`),
  ADD KEY `reviews_id_penghuni_foreign` (`id_penghuni`),
  ADD KEY `reviews_id_kontrak_foreign` (`id_kontrak`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kontrak_sewa`
--
ALTER TABLE `kontrak_sewa`
  MODIFY `id_kontrak` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kos`
--
ALTER TABLE `kos`
  MODIFY `id_kos` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kos_fasilitas`
--
ALTER TABLE `kos_fasilitas`
  MODIFY `id_kos_fasilitas` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pemilik`
--
ALTER TABLE `pemilik`
  MODIFY `id_pemilik` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `penghuni`
--
ALTER TABLE `penghuni`
  MODIFY `id_penghuni` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id_review` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_id_kontrak_foreign` FOREIGN KEY (`id_kontrak`) REFERENCES `kontrak_sewa` (`id_kontrak`) ON DELETE CASCADE,
  ADD CONSTRAINT `pembayaran_id_penghuni_foreign` FOREIGN KEY (`id_penghuni`) REFERENCES `penghuni` (`id_penghuni`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemilik`
--
ALTER TABLE `pemilik`
  ADD CONSTRAINT `pemilik_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penghuni`
--
ALTER TABLE `penghuni`
  ADD CONSTRAINT `penghuni_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_id_kontrak_foreign` FOREIGN KEY (`id_kontrak`) REFERENCES `kontrak_sewa` (`id_kontrak`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_id_kos_foreign` FOREIGN KEY (`id_kos`) REFERENCES `kos` (`id_kos`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_id_penghuni_foreign` FOREIGN KEY (`id_penghuni`) REFERENCES `penghuni` (`id_penghuni`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
