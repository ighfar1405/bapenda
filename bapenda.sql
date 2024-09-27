-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 03, 2024 at 06:24 PM
-- Server version: 8.0.12
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bapenda`
--
CREATE DATABASE IF NOT EXISTS `bapenda` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `bapenda`;

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `kode`, `nama`, `created_at`, `updated_at`) VALUES
(1, '4.1.2.02.01', 'Badan Keuangan dan Aset Daerah', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(2, '1.1.1.03.60', 'Kas Bank di Bendahara Penerimaan', '2024-01-31 15:00:01', '2024-01-31 15:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pembayaran`
--

CREATE TABLE `jenis_pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_jurnal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `formulir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_pembayaran`
--

INSERT INTO `jenis_pembayaran` (`id`, `kode_jurnal`, `formulir`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'TBP-OA', 'TBP', 'Digunakan di TBP untuk penerimaan pembayaran berdasarkan penetapan SKRD khusus tahun aktif saat ini', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(2, 'TBP-PUTG', 'TBP', 'Digunakan di TBP untuk penerimaan pembayaran berdasarkan penetapan SKRD khusus tahun lalu < tahun aktif saat ini', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(3, 'TBP-SA', 'TBP', 'Digunakan di TBP untuk penerimaan tidak berdasarkan SKRD', '2024-01-31 15:00:01', '2024-01-31 15:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_tanaman`
--

CREATE TABLE `jenis_tanaman` (
  `id` int(11) NOT NULL,
  `nama` char(100) NOT NULL,
  `tarif` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_tanaman`
--

INSERT INTO `jenis_tanaman` (`id`, `nama`, `tarif`) VALUES
(1, 'MOBIL BUS', 80000),
(2, 'MOBIL TREK', 120000),
(3, 'SEPEDA MOTOR', 30000),
(4, 'SPEED BOAD', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_administratif` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `kode_administratif`, `nama`, `created_at`, `updated_at`) VALUES
(1, '81.71.01', 'Nusaniwe', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(2, '81.71.02', 'Sirimau', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(6, '81.71.03', 'Baguala', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(7, '81.71.04', 'Teluk Ambon', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(8, '81.71.05', 'Leitimur Selatan', '2024-01-31 15:00:01', '2024-01-31 15:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `kelurahan`
--

CREATE TABLE `kelurahan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_administratif` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelurahan`
--

INSERT INTO `kelurahan` (`id`, `kode_administratif`, `kecamatan_id`, `nama`, `created_at`, `updated_at`) VALUES
(59, '81.71.01', 1, 'Benteng', '2024-08-22 00:31:48', '2024-08-22 00:31:48'),
(60, '81.71.01', 1, 'Kudamati', '2024-08-22 00:32:22', '2024-08-22 00:32:22'),
(61, '81.71.01', 1, 'Mangga Dua', '2024-08-22 00:32:51', '2024-08-22 00:32:51'),
(62, '81.71.01', 1, 'Nusaniwe', '2024-08-22 00:33:23', '2024-08-22 00:33:23'),
(63, '81.71.01', 1, 'Silale', '2024-08-22 00:33:46', '2024-08-22 00:33:46'),
(64, '81.71.01', 1, 'Urimessing', '2024-08-22 00:34:18', '2024-08-22 00:34:18'),
(65, '81.71.01', 1, 'Waihaong', '2024-08-22 00:34:47', '2024-08-22 00:34:47'),
(66, '81.71.01', 1, 'Wainitu', '2024-08-22 00:35:15', '2024-08-22 00:35:15'),
(67, '81.71.02', 2, 'Ahusen', '2024-08-22 00:37:09', '2024-08-22 00:37:09'),
(68, '81.71.02', 2, 'Amalatu', '2024-08-22 00:37:37', '2024-08-22 00:37:37'),
(69, '81.71.02', 2, 'Batu Gajah', '2024-08-22 00:37:59', '2024-08-22 00:37:59'),
(70, '81.71.02', 2, 'Batu meja', '2024-08-22 00:38:19', '2024-08-22 00:38:19'),
(71, '81.71.02', 2, 'Honipopu', '2024-08-22 00:38:44', '2024-08-22 00:38:44'),
(72, '81.71.02', 2, 'Karang Panjang', '2024-08-22 00:39:20', '2024-08-22 00:39:20'),
(73, '81.71.02', 2, 'Kasturi', '2024-08-22 00:41:13', '2024-08-22 00:41:13'),
(74, '81.71.02', 2, 'Rijali', '2024-08-22 00:41:35', '2024-08-22 00:41:35'),
(75, '81.71.02', 2, 'Uritetu', '2024-08-22 00:42:01', '2024-08-22 00:42:01'),
(76, '81.71.01', 2, 'Waihoka', '2024-08-22 00:42:25', '2024-08-22 00:42:25'),
(77, '81.71.03', 6, 'Lateri', '2024-08-22 00:45:25', '2024-08-22 00:48:02'),
(78, '81.71.04', 7, 'Tihu', '2024-08-22 00:47:12', '2024-08-22 00:47:12'),
(79, '81.71.05', 8, 'Negeri Hutumuri', '2024-08-22 00:50:33', '2024-08-22 00:50:33');

-- --------------------------------------------------------

--
-- Table structure for table `klasifikasi_pemakaian`
--

CREATE TABLE `klasifikasi_pemakaian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_klasifikasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `klasifikasi_pemakaian`
--

INSERT INTO `klasifikasi_pemakaian` (`id`, `jenis_klasifikasi`, `created_at`, `updated_at`) VALUES
(1, 'Tempat Tinggal', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(2, 'Kegiatan Industri', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(3, 'Usaha Toko / Kios', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(4, 'SPBU / Pom Bensin', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(5, 'Pendidikan', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(6, 'Sosial', '2024-01-31 15:00:01', '2024-01-31 15:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `list_opd`
--

CREATE TABLE `list_opd` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_opd` varchar(255) DEFAULT NULL,
  `jenis_retribusi` varchar(255) DEFAULT NULL,
  `objek_retribusi` text,
  `rincian_objek` varchar(255) DEFAULT NULL,
  `sub_rincian_objek` varchar(255) DEFAULT NULL,
  `sub_sub_rincian_objek` varchar(255) DEFAULT NULL,
  `detail_rincian` text,
  `tarif` decimal(15,2) DEFAULT NULL,
  `satuan` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `list_opd`
--

INSERT INTO `list_opd` (`id`, `nama_opd`, `jenis_retribusi`, `objek_retribusi`, `rincian_objek`, `sub_rincian_objek`, `sub_sub_rincian_objek`, `detail_rincian`, `tarif`, `satuan`, `status`, `link`, `created_at`, `updated_at`) VALUES
(1, 'Rino', 'Parkiran', 'Pemanfaatan Aset Daerah Yang Tidak Mengganggu Penyelenggaraan Tugas dan Fungsi Organisasi Perangkat Daerah dan/atau Optimalisasi Aset Daerah Dengan Tidak Mengubah Status Kepemilikan Sesuai Dengan Ketentuan Perundang-Undangan', 'parkiran jln', 'Sewa Baileo Siwalima', NULL, NULL, 7500000.00, '/ hari', 'Tidak Diketahui', NULL, '2024-08-29 12:17:01', '2024-09-03 16:19:47');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Entity\\User\\User', 1),
(2, 'App\\Entity\\User\\User', 2),
(1, 'App\\Entity\\User\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `objek_retribusi`
--

CREATE TABLE `objek_retribusi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pemakai_id` bigint(20) UNSIGNED NOT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `luas` double(8,2) NOT NULL,
  `tarif_retribusi_id` bigint(20) UNSIGNED NOT NULL,
  `kelurahan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `opd`
--

CREATE TABLE `opd` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `opd`
--

INSERT INTO `opd` (`id`, `kode`, `nama`, `created_at`, `updated_at`) VALUES
(1, '01', 'Badan Keuangan dan Anggaran Daerah', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(2, '02', 'Badan Pendapatan Daerah', '2024-08-20 11:09:10', '2024-08-22 06:58:31'),
(3, '03', 'Kantor DPRD Provinsi Maluku', '2024-08-20 14:38:48', '2024-08-22 06:58:46'),
(4, '04', 'Badan Pengembangan Sumber Daya Manusia Provinsi Maluku', '2024-08-20 14:39:23', '2024-08-22 06:59:03'),
(5, '05', 'Balai Pelatihan Kesehatan Provinsi Maluku', '2024-08-20 14:40:25', '2024-08-22 06:59:23'),
(6, '06', 'UPTD Balai Keselamatan Kerja dan Hiperkes Kelas (A) Provinsi Maluku', '2024-08-20 14:41:29', '2024-08-22 06:59:48'),
(7, '07', 'Dinas Pariwisata Provinsi Maluku', '2024-08-20 14:42:07', '2024-08-22 07:00:22'),
(8, '08', 'Balai Pendidikan dan Pelatihan Pertanian Provinsi Maluku', '2024-08-20 14:42:34', '2024-08-22 07:00:38'),
(9, '09', 'Badan Kepegawaian Daerah', '2024-08-20 14:43:10', '2024-08-22 07:00:56'),
(10, '10', 'Sekolah Pertanian Pembangunan/SPMA Passo', '2024-08-20 14:43:49', '2024-08-20 14:43:49'),
(11, '11', 'Taman Budaya', '2024-08-20 14:44:31', '2024-08-20 14:44:31'),
(12, '12', 'Dinas Komunikasi dan Informatika Provinsi Maluku', '2024-08-20 14:45:00', '2024-08-20 14:45:00'),
(13, '13', 'Dinas Perpustakaan dan Kearsipan DaerahProvinsi Maluku', '2024-08-20 14:45:38', '2024-08-20 14:45:38'),
(14, '14', 'Dinas Kelautan dan Perikanan', '2024-08-20 14:46:22', '2024-08-20 14:46:22'),
(15, '15', 'Balai Pengawasan dan Sertifikasi Benih dan Bibit Pertanian/Peternakan', '2024-08-20 14:46:59', '2024-08-20 14:46:59'),
(16, '16', 'Dinas Pekerjaan Umum  dan Penataan Ruang Provinsi Maluku', '2024-08-20 14:47:36', '2024-08-20 14:47:36'),
(17, '17', 'UPTD Laboratorium Pekerjaan Umum  dan Penataan Ruang Provinsi Maluku', '2024-08-20 14:48:08', '2024-08-20 14:48:08'),
(18, '18', 'Dinas Kesehatan Provinsi Maluku', '2024-08-20 14:49:08', '2024-08-20 14:49:08'),
(19, '19', 'RSUD Dr Ishak Umarela', '2024-08-20 14:49:33', '2024-08-20 14:49:33'),
(20, '20', 'Rumah Sakit Khusus Daerah', '2024-08-20 14:50:01', '2024-08-20 14:50:01'),
(21, '21', 'Museum Siwalima', '2024-08-20 14:50:22', '2024-08-20 14:50:22'),
(22, '22', 'Dinas Perhubungan', '2024-08-20 14:50:45', '2024-08-20 14:50:45'),
(23, '23', 'Dinas Perindustrian dan Perdagangan Provinsi Maluku', '2024-08-20 14:51:10', '2024-08-20 14:51:10'),
(24, '24', 'UPTD. Balai Pengujian dan Sertifikasi Mutu Barang Dinas Perindustrian dan Perdagangan', '2024-08-20 14:51:43', '2024-08-20 14:51:43'),
(25, '25', 'Badan Penghubung Provinsi Maluku', '2024-08-20 14:52:25', '2024-08-20 14:52:25'),
(26, '26', 'Dinas Pertanian Provinsi Maluku', '2024-08-20 14:53:00', '2024-08-20 14:53:00'),
(27, '27', 'Dinas Lingkungan Hidup Provinsi Maluku', '2024-08-20 14:53:35', '2024-08-20 14:53:35'),
(28, '28', 'Dinas Tenaga Kerja dan Transmigrasi Provinsi Maluku', '2024-08-20 14:54:03', '2024-08-20 14:54:03');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemakai`
--

CREATE TABLE `pemakai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_urut` int(10) UNSIGNED NOT NULL,
  `kelurahan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode_arsip` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemindahan_pemakaian`
--

CREATE TABLE `pemindahan_pemakaian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `objek_retribusi_id` bigint(20) UNSIGNED NOT NULL,
  `pemakai_lama` bigint(20) UNSIGNED NOT NULL,
  `pemakai_baru` bigint(20) UNSIGNED NOT NULL,
  `tanggal_sk` date NOT NULL,
  `no_sk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `klasifikasi_pemakaian_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penomoran`
--

CREATE TABLE `penomoran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `formulir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `format_penomoran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penomoran`
--

INSERT INTO `penomoran` (`id`, `formulir`, `format_penomoran`, `created_at`, `updated_at`) VALUES
(1, 'skrd', '{nomor:1}/SKRD/0001/{tahun}', '2024-01-31 15:00:01', '2024-08-23 21:28:53'),
(2, 'tbp', '{nomor:1}/TBP/0001{tahun}', '2024-01-31 15:00:01', '2024-08-23 21:28:32');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'penomoran-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(2, 'penomoran-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(3, 'penomoran-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(4, 'penomoran-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(5, 'opd-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(6, 'opd-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(7, 'opd-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(8, 'opd-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(9, 'wilayah-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(10, 'wilayah-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(11, 'wilayah-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(12, 'wilayah-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(13, 'akun-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(14, 'akun-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(15, 'akun-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(16, 'akun-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(17, 'jenis_pembayaran-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(18, 'jenis_pembayaran-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(19, 'jenis_pembayaran-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(20, 'jenis_pembayaran-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(21, 'rekening_bank-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(22, 'rekening_bank-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(23, 'rekening_bank-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(24, 'rekening_bank-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(25, 'tahun-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(26, 'tahun-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(27, 'tahun-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(28, 'tahun-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(29, 'klasifikasi-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(30, 'klasifikasi-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(31, 'klasifikasi-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(32, 'klasifikasi-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(33, 'tarif_retribusi-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(34, 'tarif_retribusi-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(35, 'tarif_retribusi-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(36, 'tarif_retribusi-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(37, 'pemakai-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(38, 'pemakai-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(39, 'pemakai-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(40, 'pemakai-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(41, 'object_retribusi-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(42, 'object_retribusi-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(43, 'object_retribusi-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(44, 'object_retribusi-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(45, 'skrd-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(46, 'skrd-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(47, 'skrd-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(48, 'skrd-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(49, 'tbp-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(50, 'tbp-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(51, 'tbp-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(52, 'tbp-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(53, 'monitoring_piutang-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(54, 'monitoring_piutang-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(55, 'monitoring_piutang-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(56, 'monitoring_piutang-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(57, 'salin_skrd-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(58, 'salin_skrd-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(59, 'salin_skrd-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(60, 'salin_skrd-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(61, 'lahan_pertanian-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(62, 'lahan_pertanian-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(63, 'lahan_pertanian-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(64, 'lahan_pertanian-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(65, 'laporan', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55');

-- --------------------------------------------------------

--
-- Table structure for table `pertanian`
--

CREATE TABLE `pertanian` (
  `id` bigint(20) NOT NULL,
  `no_perjanjian_sewa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penyewa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_tanaman_id` int(11) NOT NULL,
  `luas` double(8,2) NOT NULL,
  `nominal` bigint(20) UNSIGNED NOT NULL,
  `nominal_bayar` bigint(20) NOT NULL,
  `sisa_bayar` bigint(20) UNSIGNED DEFAULT '0',
  `tanggal_sewa` date NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kecamatan_id` bigint(20) UNSIGNED NOT NULL,
  `kelurahan_id` bigint(20) UNSIGNED NOT NULL,
  `tgl_selesai` date NOT NULL,
  `nomor_sertifikat` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_bayar` datetime DEFAULT NULL,
  `no_bukti_bayar` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_bayar` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_penyewa` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `opd_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `opd_id`, `nama`, `nip`, `jabatan`, `pangkat`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'MISBAHUL ANAM, SH', '19630403 198503 1 015', 'PPTK', 'Penata', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'EMMIE RISTANTIEN, SE, M.Si', '19670814 198903 2 010', 'PPK-SKPD', 'Pembina', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'SATRIA YUDHA P., S.STP', '19910805 201406 1 001', 'Bendahara Pengeluaran', 'Penata Muda Tk. I', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 'FETI MAISAROH', '19670225 200701 2 005', 'Bendahara Penerimaan', 'Pengatur', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 'BAIHAQI, S,Pd., SE., M.Si', '19670317 199202 1 001', 'Pejabat Pembuat Komitmen', 'Pembina Tk. I', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 'DEWI PRATIWININGRUM, SE, MM', '19670516 199503 2 001', 'PPTK', 'Pembina', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 'ONY SETIAWAN, SE., MM', '19740829 200312 1 006', 'PPTK', 'Penata Tk. I', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rekening_bank`
--

CREATE TABLE `rekening_bank` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `akun_bendahara_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekening_bank`
--

INSERT INTO `rekening_bank` (`id`, `nama_bank`, `no_rekening`, `akun_bendahara_id`, `created_at`, `updated_at`) VALUES
(1, 'Bank Maluku', '0041048484', 2, '2024-01-31 15:00:01', '2024-01-31 15:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-06-18 20:32:55', '2024-06-18 20:32:55'),
(2, 'petugas', 'web', '2024-06-18 20:32:55', '2024-06-18 20:32:55');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(33, 2),
(34, 2),
(35, 2),
(37, 2),
(38, 2),
(39, 2),
(41, 2),
(42, 2),
(43, 2),
(45, 2),
(46, 2),
(47, 2),
(49, 2),
(50, 2),
(51, 2),
(53, 2),
(54, 2),
(55, 2),
(57, 2),
(58, 2),
(59, 2),
(61, 2),
(62, 2),
(63, 2),
(65, 2);

-- --------------------------------------------------------

--
-- Table structure for table `skrd`
--

CREATE TABLE `skrd` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_otomatis` tinyint(1) NOT NULL,
  `tanggal` date NOT NULL,
  `pemakai_id` bigint(20) UNSIGNED NOT NULL,
  `nominal` decimal(13,2) NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `object_retribusi_id` bigint(20) UNSIGNED NOT NULL,
  `skrd_wa` datetime DEFAULT NULL,
  `monitor_piutang` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tahun`
--

CREATE TABLE `tahun` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahun` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tahun`
--

INSERT INTO `tahun` (`id`, `tahun`, `created_at`, `updated_at`) VALUES
(1, 2024, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2025, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2026, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2027, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 2028, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tarif_retribusi`
--

CREATE TABLE `tarif_retribusi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `golongan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_tarif` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `klasifikasi_pemakaian_id` bigint(20) UNSIGNED NOT NULL,
  `range_njop` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tarif_meter` decimal(13,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbp`
--

CREATE TABLE `tbp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_otomatis` tinyint(1) NOT NULL,
  `tanggal` date NOT NULL,
  `rekening_bank_id` bigint(20) UNSIGNED NOT NULL,
  `akun_id` bigint(20) UNSIGNED NOT NULL,
  `pemakai_id` bigint(20) UNSIGNED NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbp_detail`
--

CREATE TABLE `tbp_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tbp_id` bigint(20) UNSIGNED NOT NULL,
  `skrd_id` bigint(20) UNSIGNED DEFAULT NULL,
  `objek_retribusi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jenis_pembayaran_id` bigint(20) UNSIGNED NOT NULL,
  `nominal` decimal(13,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbp_insidentils`
--

CREATE TABLE `tbp_insidentils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_pembayaran_id` bigint(20) UNSIGNED NOT NULL,
  `rekening_bank_id` bigint(20) UNSIGNED NOT NULL,
  `akun_id` bigint(20) UNSIGNED NOT NULL,
  `no_surat_izin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_izin` date NOT NULL,
  `pemakai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_objek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_objek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tarif` decimal(13,2) NOT NULL,
  `tinggi` int(10) UNSIGNED NOT NULL,
  `luas` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin@super.id', '$2y$10$Owt9T2dPnLb31nL7GYS.i.4.Vz9oo2WTE.JBziO.9Pu5a7oSBBMCS', 'S7nYyry0Oewzj0p9cNW3QDfCH7OTmlzNyknIImMhNbof1QNqh34qgasFj4cU', '0000-00-00 00:00:00', '2024-09-02 09:19:53'),
(2, 'Staff', 'staff', 'staff@user.id', '$2y$10$qQGLE0abi2EZd56CL45p3OyTrk0n38AUKjR0eWFjwFyaNV1eNxzFa', 'kw1RQqOkXXcK412Oq4YIOQnfQXWPfM6a4uSBDsxyfzgehTYRoHKyhOqPv8UR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Fred', 'fred', 'fred@support.id', '$2y$10$RQCnMDi40bhxMXANQ0aeTOv4/Z.iVkXMGhWa7zZk21Wg19qlUvoOC', 'fJOjBgKOBpN9eTV4titBFP4vPrf45VrkiZxYXUKAVIdYSWPKNhp17RlZlziu', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_tanaman`
--
ALTER TABLE `jenis_tanaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelurahan_kecamatan_id_foreign` (`kecamatan_id`);

--
-- Indexes for table `klasifikasi_pemakaian`
--
ALTER TABLE `klasifikasi_pemakaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_opd`
--
ALTER TABLE `list_opd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `objek_retribusi`
--
ALTER TABLE `objek_retribusi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `objek_retribusi_tarif_retribusi_id_foreign` (`tarif_retribusi_id`),
  ADD KEY `objek_retribusi_kelurahan_id_foreign` (`kelurahan_id`),
  ADD KEY `objek_retribusi_pemakai_id_tarif_retribusi_id_kelurahan_id_index` (`pemakai_id`,`tarif_retribusi_id`,`kelurahan_id`);

--
-- Indexes for table `opd`
--
ALTER TABLE `opd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pemakai`
--
ALTER TABLE `pemakai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemakai_kelurahan_id_foreign` (`kelurahan_id`),
  ADD KEY `pemakai_nama_index` (`nama`);

--
-- Indexes for table `pemindahan_pemakaian`
--
ALTER TABLE `pemindahan_pemakaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemindahan_pemakaian_objek_retribusi_id_foreign` (`objek_retribusi_id`),
  ADD KEY `pemindahan_pemakaian_pemakai_lama_foreign` (`pemakai_lama`),
  ADD KEY `pemindahan_pemakaian_pemakai_baru_foreign` (`pemakai_baru`),
  ADD KEY `pemindahan_pemakaian_klasifikasi_pemakaian_id_foreign` (`klasifikasi_pemakaian_id`);

--
-- Indexes for table `penomoran`
--
ALTER TABLE `penomoran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penomoran_formulir_unique` (`formulir`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pertanian`
--
ALTER TABLE `pertanian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_tanaman_id` (`jenis_tanaman_id`),
  ADD KEY `kecamatan_id` (`kecamatan_id`,`kelurahan_id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `petugas_opd_id_foreign` (`opd_id`);

--
-- Indexes for table `rekening_bank`
--
ALTER TABLE `rekening_bank`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekening_bank_akun_bendahara_id_foreign` (`akun_bendahara_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `skrd`
--
ALTER TABLE `skrd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skrd_pemakai_id_foreign` (`pemakai_id`),
  ADD KEY `skrd_object_retribusi_id_foreign` (`object_retribusi_id`),
  ADD KEY `skrd_tanggal_pemakai_id_object_retribusi_id_index` (`tanggal`,`pemakai_id`,`object_retribusi_id`);

--
-- Indexes for table `tahun`
--
ALTER TABLE `tahun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tarif_retribusi`
--
ALTER TABLE `tarif_retribusi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tarif_retribusi_klasifikasi_pemakaian_id_index` (`klasifikasi_pemakaian_id`);

--
-- Indexes for table `tbp`
--
ALTER TABLE `tbp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbp_rekening_bank_id_foreign` (`rekening_bank_id`),
  ADD KEY `tbp_akun_id_foreign` (`akun_id`),
  ADD KEY `tbp_pemakai_id_foreign` (`pemakai_id`),
  ADD KEY `tbp_tanggal_pemakai_id_rekening_bank_id_akun_id_index` (`tanggal`,`pemakai_id`,`rekening_bank_id`,`akun_id`);

--
-- Indexes for table `tbp_detail`
--
ALTER TABLE `tbp_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbp_detail_skrd_id_foreign` (`skrd_id`),
  ADD KEY `tbp_detail_objek_retribusi_id_foreign` (`objek_retribusi_id`),
  ADD KEY `tbp_detail_jenis_pembayaran_id_foreign` (`jenis_pembayaran_id`),
  ADD KEY `tbp_detail_tbp_id_skrd_id_jenis_pembayaran_id_index` (`tbp_id`,`skrd_id`,`jenis_pembayaran_id`);

--
-- Indexes for table `tbp_insidentils`
--
ALTER TABLE `tbp_insidentils`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbp_insidentils_rekening_bank_id_foreign` (`rekening_bank_id`),
  ADD KEY `tbp_insidentils_jenis_pembayaran_id_foreign` (`jenis_pembayaran_id`),
  ADD KEY `tbp_insidentils_akun_id_foreign` (`akun_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jenis_tanaman`
--
ALTER TABLE `jenis_tanaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kelurahan`
--
ALTER TABLE `kelurahan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `klasifikasi_pemakaian`
--
ALTER TABLE `klasifikasi_pemakaian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `list_opd`
--
ALTER TABLE `list_opd`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `objek_retribusi`
--
ALTER TABLE `objek_retribusi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `opd`
--
ALTER TABLE `opd`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pemakai`
--
ALTER TABLE `pemakai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pemindahan_pemakaian`
--
ALTER TABLE `pemindahan_pemakaian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penomoran`
--
ALTER TABLE `penomoran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `pertanian`
--
ALTER TABLE `pertanian`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rekening_bank`
--
ALTER TABLE `rekening_bank`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `skrd`
--
ALTER TABLE `skrd`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tahun`
--
ALTER TABLE `tahun`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tarif_retribusi`
--
ALTER TABLE `tarif_retribusi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbp`
--
ALTER TABLE `tbp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbp_detail`
--
ALTER TABLE `tbp_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbp_insidentils`
--
ALTER TABLE `tbp_insidentils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_opd_id_foreign` FOREIGN KEY (`opd_id`) REFERENCES `opd` (`id`);

--
-- Constraints for table `rekening_bank`
--
ALTER TABLE `rekening_bank`
  ADD CONSTRAINT `rekening_bank_akun_bendahara_id_foreign` FOREIGN KEY (`akun_bendahara_id`) REFERENCES `akun` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tarif_retribusi`
--
ALTER TABLE `tarif_retribusi`
  ADD CONSTRAINT `tarif_retribusi_klasifikasi_pemakaian_id_foreign` FOREIGN KEY (`klasifikasi_pemakaian_id`) REFERENCES `klasifikasi_pemakaian` (`id`);
--
-- Database: `disperindag`
--
CREATE DATABASE IF NOT EXISTS `disperindag` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `disperindag`;

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `kode`, `nama`, `created_at`, `updated_at`) VALUES
(1, '4.1.2.02.01', 'Badan Keuangan dan Aset Daerah', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(2, '1.1.1.03.60', 'Kas Bank di Bendahara Penerimaan', '2024-01-31 15:00:01', '2024-01-31 15:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pembayaran`
--

CREATE TABLE `jenis_pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_jurnal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `formulir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_pembayaran`
--

INSERT INTO `jenis_pembayaran` (`id`, `kode_jurnal`, `formulir`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'TBP-OA', 'TBP', 'Digunakan di TBP untuk penerimaan pembayaran berdasarkan penetapan SKRD khusus tahun aktif saat ini', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(2, 'TBP-PUTG', 'TBP', 'Digunakan di TBP untuk penerimaan pembayaran berdasarkan penetapan SKRD khusus tahun lalu < tahun aktif saat ini', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(3, 'TBP-SA', 'TBP', 'Digunakan di TBP untuk penerimaan tidak berdasarkan SKRD', '2024-01-31 15:00:01', '2024-01-31 15:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_tanaman`
--

CREATE TABLE `jenis_tanaman` (
  `id` int(11) NOT NULL,
  `nama` char(100) NOT NULL,
  `tarif` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_tanaman`
--

INSERT INTO `jenis_tanaman` (`id`, `nama`, `tarif`) VALUES
(1, 'MOBIL BUS', 80000),
(2, 'MOBIL TREK', 120000),
(3, 'SEPEDA MOTOR', 30000),
(4, 'SPEED BOAD', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_administratif` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `kode_administratif`, `nama`, `created_at`, `updated_at`) VALUES
(1, '81.71.01', 'Nusaniwe', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(2, '81.71.02', 'Sirimau', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(6, '81.71.03', 'Baguala', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(7, '81.71.04', 'Teluk Ambon', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(8, '81.71.05', 'Leitimur Selatan', '2024-01-31 15:00:01', '2024-01-31 15:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `kelurahan`
--

CREATE TABLE `kelurahan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_administratif` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelurahan`
--

INSERT INTO `kelurahan` (`id`, `kode_administratif`, `kecamatan_id`, `nama`, `created_at`, `updated_at`) VALUES
(59, '81.71.01', 1, 'Benteng', '2024-08-22 00:31:48', '2024-08-22 00:31:48'),
(60, '81.71.01', 1, 'Kudamati', '2024-08-22 00:32:22', '2024-08-22 00:32:22'),
(61, '81.71.01', 1, 'Mangga Dua', '2024-08-22 00:32:51', '2024-08-22 00:32:51'),
(62, '81.71.01', 1, 'Nusaniwe', '2024-08-22 00:33:23', '2024-08-22 00:33:23'),
(63, '81.71.01', 1, 'Silale', '2024-08-22 00:33:46', '2024-08-22 00:33:46'),
(64, '81.71.01', 1, 'Urimessing', '2024-08-22 00:34:18', '2024-08-22 00:34:18'),
(65, '81.71.01', 1, 'Waihaong', '2024-08-22 00:34:47', '2024-08-22 00:34:47'),
(66, '81.71.01', 1, 'Wainitu', '2024-08-22 00:35:15', '2024-08-22 00:35:15'),
(67, '81.71.02', 2, 'Ahusen', '2024-08-22 00:37:09', '2024-08-22 00:37:09'),
(68, '81.71.02', 2, 'Amalatu', '2024-08-22 00:37:37', '2024-08-22 00:37:37'),
(69, '81.71.02', 2, 'Batu Gajah', '2024-08-22 00:37:59', '2024-08-22 00:37:59'),
(70, '81.71.02', 2, 'Batu meja', '2024-08-22 00:38:19', '2024-08-22 00:38:19'),
(71, '81.71.02', 2, 'Honipopu', '2024-08-22 00:38:44', '2024-08-22 00:38:44'),
(72, '81.71.02', 2, 'Karang Panjang', '2024-08-22 00:39:20', '2024-08-22 00:39:20'),
(73, '81.71.02', 2, 'Kasturi', '2024-08-22 00:41:13', '2024-08-22 00:41:13'),
(74, '81.71.02', 2, 'Rijali', '2024-08-22 00:41:35', '2024-08-22 00:41:35'),
(75, '81.71.02', 2, 'Uritetu', '2024-08-22 00:42:01', '2024-08-22 00:42:01'),
(76, '81.71.01', 2, 'Waihoka', '2024-08-22 00:42:25', '2024-08-22 00:42:25'),
(77, '81.71.03', 6, 'Lateri', '2024-08-22 00:45:25', '2024-08-22 00:48:02'),
(78, '81.71.04', 7, 'Tihu', '2024-08-22 00:47:12', '2024-08-22 00:47:12'),
(79, '81.71.05', 8, 'Negeri Hutumuri', '2024-08-22 00:50:33', '2024-08-22 00:50:33');

-- --------------------------------------------------------

--
-- Table structure for table `klasifikasi_pemakaian`
--

CREATE TABLE `klasifikasi_pemakaian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_klasifikasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `klasifikasi_pemakaian`
--

INSERT INTO `klasifikasi_pemakaian` (`id`, `jenis_klasifikasi`, `created_at`, `updated_at`) VALUES
(1, 'Tempat Tinggal', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(2, 'Kegiatan Industri', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(3, 'Usaha Toko / Kios', '2024-01-31 15:00:01', '2024-01-31 15:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `list_opd`
--

CREATE TABLE `list_opd` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_opd` varchar(255) DEFAULT NULL,
  `jenis_retribusi` varchar(255) DEFAULT NULL,
  `objek_retribusi` text,
  `rincian_objek` varchar(255) DEFAULT NULL,
  `sub_rincian_objek` varchar(255) DEFAULT NULL,
  `sub_sub_rincian_objek` varchar(255) DEFAULT NULL,
  `detail_rincian` text,
  `tarif` decimal(15,2) DEFAULT NULL,
  `satuan` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `list_opd`
--

INSERT INTO `list_opd` (`id`, `nama_opd`, `jenis_retribusi`, `objek_retribusi`, `rincian_objek`, `sub_rincian_objek`, `sub_sub_rincian_objek`, `detail_rincian`, `tarif`, `satuan`, `status`, `link`, `created_at`, `updated_at`) VALUES
(1, 'Rino', 'Parkir Basement Lapangan Merdeka', 'Pemanfaatan Aset Daerah Yang Tidak Mengganggu Penyelenggaraan Tugas dan Fungsi Organisasi Perangkat Daerah dan/atau Optimalisasi Aset Daerah Dengan Tidak Mengubah Status Kepemilikan Sesuai Dengan Ketentuan Perundang-Undangan', 'Sewa Gedung', 'Sewa Baileo Siwalima', NULL, NULL, 1000000.00, '/ hari', 'Tidak Diketahui', NULL, '2024-08-29 12:17:01', '2024-09-03 15:45:40');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Entity\\User\\User', 1),
(2, 'App\\Entity\\User\\User', 2),
(1, 'App\\Entity\\User\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `objek_retribusi`
--

CREATE TABLE `objek_retribusi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pemakai_id` bigint(20) UNSIGNED NOT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `luas` double(8,2) NOT NULL,
  `tarif_retribusi_id` bigint(20) UNSIGNED NOT NULL,
  `kelurahan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `opd`
--

CREATE TABLE `opd` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `opd`
--

INSERT INTO `opd` (`id`, `kode`, `nama`, `created_at`, `updated_at`) VALUES
(1, '01', 'Badan Keuangan dan Anggaran Daerah', '2024-01-31 15:00:01', '2024-01-31 15:00:01'),
(2, '02', 'Badan Pendapatan Daerah', '2024-08-20 11:09:10', '2024-08-22 06:58:31'),
(3, '03', 'Kantor DPRD Provinsi Maluku', '2024-08-20 14:38:48', '2024-08-22 06:58:46'),
(4, '04', 'Badan Pengembangan Sumber Daya Manusia Provinsi Maluku', '2024-08-20 14:39:23', '2024-08-22 06:59:03'),
(5, '05', 'Balai Pelatihan Kesehatan Provinsi Maluku', '2024-08-20 14:40:25', '2024-08-22 06:59:23'),
(6, '06', 'UPTD Balai Keselamatan Kerja dan Hiperkes Kelas (A) Provinsi Maluku', '2024-08-20 14:41:29', '2024-08-22 06:59:48'),
(7, '07', 'Dinas Pariwisata Provinsi Maluku', '2024-08-20 14:42:07', '2024-08-22 07:00:22'),
(8, '08', 'Balai Pendidikan dan Pelatihan Pertanian Provinsi Maluku', '2024-08-20 14:42:34', '2024-08-22 07:00:38'),
(9, '09', 'Badan Kepegawaian Daerah', '2024-08-20 14:43:10', '2024-08-22 07:00:56'),
(10, '10', 'Sekolah Pertanian Pembangunan/SPMA Passo', '2024-08-20 14:43:49', '2024-08-20 14:43:49'),
(11, '11', 'Taman Budaya', '2024-08-20 14:44:31', '2024-08-20 14:44:31'),
(12, '12', 'Dinas Komunikasi dan Informatika Provinsi Maluku', '2024-08-20 14:45:00', '2024-08-20 14:45:00'),
(13, '13', 'Dinas Perpustakaan dan Kearsipan DaerahProvinsi Maluku', '2024-08-20 14:45:38', '2024-08-20 14:45:38'),
(14, '14', 'Dinas Kelautan dan Perikanan', '2024-08-20 14:46:22', '2024-08-20 14:46:22'),
(15, '15', 'Balai Pengawasan dan Sertifikasi Benih dan Bibit Pertanian/Peternakan', '2024-08-20 14:46:59', '2024-08-20 14:46:59'),
(16, '16', 'Dinas Pekerjaan Umum  dan Penataan Ruang Provinsi Maluku', '2024-08-20 14:47:36', '2024-08-20 14:47:36'),
(17, '17', 'UPTD Laboratorium Pekerjaan Umum  dan Penataan Ruang Provinsi Maluku', '2024-08-20 14:48:08', '2024-08-20 14:48:08'),
(18, '18', 'Dinas Kesehatan Provinsi Maluku', '2024-08-20 14:49:08', '2024-08-20 14:49:08'),
(19, '19', 'RSUD Dr Ishak Umarela', '2024-08-20 14:49:33', '2024-08-20 14:49:33'),
(20, '20', 'Rumah Sakit Khusus Daerah', '2024-08-20 14:50:01', '2024-08-20 14:50:01'),
(21, '21', 'Museum Siwalima', '2024-08-20 14:50:22', '2024-08-20 14:50:22'),
(22, '22', 'Dinas Perhubungan', '2024-08-20 14:50:45', '2024-08-20 14:50:45'),
(23, '23', 'Dinas Perindustrian dan Perdagangan Provinsi Maluku', '2024-08-20 14:51:10', '2024-08-20 14:51:10'),
(24, '24', 'UPTD. Balai Pengujian dan Sertifikasi Mutu Barang Dinas Perindustrian dan Perdagangan', '2024-08-20 14:51:43', '2024-08-20 14:51:43'),
(25, '25', 'Badan Penghubung Provinsi Maluku', '2024-08-20 14:52:25', '2024-08-20 14:52:25'),
(26, '26', 'Dinas Pertanian Provinsi Maluku', '2024-08-20 14:53:00', '2024-08-20 14:53:00'),
(27, '27', 'Dinas Lingkungan Hidup Provinsi Maluku', '2024-08-20 14:53:35', '2024-08-20 14:53:35'),
(28, '28', 'Dinas Tenaga Kerja dan Transmigrasi Provinsi Maluku', '2024-08-20 14:54:03', '2024-08-20 14:54:03');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemakai`
--

CREATE TABLE `pemakai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_urut` int(10) UNSIGNED NOT NULL,
  `kelurahan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode_arsip` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemindahan_pemakaian`
--

CREATE TABLE `pemindahan_pemakaian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `objek_retribusi_id` bigint(20) UNSIGNED NOT NULL,
  `pemakai_lama` bigint(20) UNSIGNED NOT NULL,
  `pemakai_baru` bigint(20) UNSIGNED NOT NULL,
  `tanggal_sk` date NOT NULL,
  `no_sk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `klasifikasi_pemakaian_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penomoran`
--

CREATE TABLE `penomoran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `formulir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `format_penomoran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penomoran`
--

INSERT INTO `penomoran` (`id`, `formulir`, `format_penomoran`, `created_at`, `updated_at`) VALUES
(1, 'skrd', '{nomor:1}/SKRD/0001/{tahun}', '2024-01-31 15:00:01', '2024-08-23 21:28:53'),
(2, 'tbp', '{nomor:1}/TBP/0001{tahun}', '2024-01-31 15:00:01', '2024-08-23 21:28:32');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'penomoran-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(2, 'penomoran-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(3, 'penomoran-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(4, 'penomoran-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(5, 'opd-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(6, 'opd-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(7, 'opd-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(8, 'opd-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(9, 'wilayah-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(10, 'wilayah-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(11, 'wilayah-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(12, 'wilayah-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(13, 'akun-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(14, 'akun-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(15, 'akun-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(16, 'akun-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(17, 'jenis_pembayaran-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(18, 'jenis_pembayaran-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(19, 'jenis_pembayaran-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(20, 'jenis_pembayaran-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(21, 'rekening_bank-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(22, 'rekening_bank-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(23, 'rekening_bank-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(24, 'rekening_bank-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(25, 'tahun-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(26, 'tahun-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(27, 'tahun-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(28, 'tahun-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(29, 'klasifikasi-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(30, 'klasifikasi-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(31, 'klasifikasi-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(32, 'klasifikasi-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(33, 'tarif_retribusi-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(34, 'tarif_retribusi-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(35, 'tarif_retribusi-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(36, 'tarif_retribusi-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(37, 'pemakai-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(38, 'pemakai-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(39, 'pemakai-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(40, 'pemakai-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(41, 'object_retribusi-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(42, 'object_retribusi-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(43, 'object_retribusi-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(44, 'object_retribusi-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(45, 'skrd-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(46, 'skrd-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(47, 'skrd-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(48, 'skrd-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(49, 'tbp-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(50, 'tbp-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(51, 'tbp-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(52, 'tbp-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(53, 'monitoring_piutang-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(54, 'monitoring_piutang-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(55, 'monitoring_piutang-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(56, 'monitoring_piutang-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(57, 'salin_skrd-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(58, 'salin_skrd-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(59, 'salin_skrd-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(60, 'salin_skrd-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(61, 'lahan_pertanian-show', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(62, 'lahan_pertanian-create', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(63, 'lahan_pertanian-update', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(64, 'lahan_pertanian-delete', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55'),
(65, 'laporan', 'web', '2024-06-18 11:32:55', '2024-06-18 11:32:55');

-- --------------------------------------------------------

--
-- Table structure for table `pertanian`
--

CREATE TABLE `pertanian` (
  `id` bigint(20) NOT NULL,
  `no_perjanjian_sewa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penyewa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_tanaman_id` int(11) NOT NULL,
  `luas` double(8,2) NOT NULL,
  `nominal` bigint(20) UNSIGNED NOT NULL,
  `nominal_bayar` bigint(20) NOT NULL,
  `sisa_bayar` bigint(20) UNSIGNED DEFAULT '0',
  `tanggal_sewa` date NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kecamatan_id` bigint(20) UNSIGNED NOT NULL,
  `kelurahan_id` bigint(20) UNSIGNED NOT NULL,
  `tgl_selesai` date NOT NULL,
  `nomor_sertifikat` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_bayar` datetime DEFAULT NULL,
  `no_bukti_bayar` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_bayar` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_penyewa` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `opd_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `opd_id`, `nama`, `nip`, `jabatan`, `pangkat`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'MISBAHUL ANAM, SH', '19630403 198503 1 015', 'PPTK', 'Penata', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'EMMIE RISTANTIEN, SE, M.Si', '19670814 198903 2 010', 'PPK-SKPD', 'Pembina', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'SATRIA YUDHA P., S.STP', '19910805 201406 1 001', 'Bendahara Pengeluaran', 'Penata Muda Tk. I', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 'FETI MAISAROH', '19670225 200701 2 005', 'Bendahara Penerimaan', 'Pengatur', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 'BAIHAQI, S,Pd., SE., M.Si', '19670317 199202 1 001', 'Pejabat Pembuat Komitmen', 'Pembina Tk. I', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 'DEWI PRATIWININGRUM, SE, MM', '19670516 199503 2 001', 'PPTK', 'Pembina', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 'ONY SETIAWAN, SE., MM', '19740829 200312 1 006', 'PPTK', 'Penata Tk. I', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rekening_bank`
--

CREATE TABLE `rekening_bank` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `akun_bendahara_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekening_bank`
--

INSERT INTO `rekening_bank` (`id`, `nama_bank`, `no_rekening`, `akun_bendahara_id`, `created_at`, `updated_at`) VALUES
(1, 'Bank Maluku', '0041048484', 2, '2024-01-31 15:00:01', '2024-01-31 15:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-06-18 20:32:55', '2024-06-18 20:32:55'),
(2, 'petugas', 'web', '2024-06-18 20:32:55', '2024-06-18 20:32:55');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(33, 2),
(34, 2),
(35, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(53, 2),
(54, 2),
(55, 2),
(57, 2),
(58, 2),
(59, 2),
(61, 2),
(62, 2),
(63, 2),
(65, 2);

-- --------------------------------------------------------

--
-- Table structure for table `skrd`
--

CREATE TABLE `skrd` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_otomatis` tinyint(1) NOT NULL,
  `tanggal` date NOT NULL,
  `pemakai_id` bigint(20) UNSIGNED NOT NULL,
  `nominal` decimal(13,2) NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `object_retribusi_id` bigint(20) UNSIGNED NOT NULL,
  `skrd_wa` datetime DEFAULT NULL,
  `monitor_piutang` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tahun`
--

CREATE TABLE `tahun` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahun` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tahun`
--

INSERT INTO `tahun` (`id`, `tahun`, `created_at`, `updated_at`) VALUES
(1, 2024, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2025, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2026, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2027, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 2028, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tarif_retribusi`
--

CREATE TABLE `tarif_retribusi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `golongan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_tarif` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `klasifikasi_pemakaian_id` bigint(20) UNSIGNED NOT NULL,
  `range_njop` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tarif_meter` decimal(13,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tarif_retribusi`
--

INSERT INTO `tarif_retribusi` (`id`, `kelas`, `golongan`, `kode_tarif`, `klasifikasi_pemakaian_id`, `range_njop`, `created_at`, `updated_at`, `tarif_meter`) VALUES
(42, 'A', '1', 'A1', 3, 'Toko Pasar Oleh-Oleh', '2024-09-02 19:42:20', '2024-09-02 19:42:20', 1000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbp`
--

CREATE TABLE `tbp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_otomatis` tinyint(1) NOT NULL,
  `tanggal` date NOT NULL,
  `rekening_bank_id` bigint(20) UNSIGNED NOT NULL,
  `akun_id` bigint(20) UNSIGNED NOT NULL,
  `pemakai_id` bigint(20) UNSIGNED NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbp_detail`
--

CREATE TABLE `tbp_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tbp_id` bigint(20) UNSIGNED NOT NULL,
  `skrd_id` bigint(20) UNSIGNED DEFAULT NULL,
  `objek_retribusi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jenis_pembayaran_id` bigint(20) UNSIGNED NOT NULL,
  `nominal` decimal(13,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbp_insidentils`
--

CREATE TABLE `tbp_insidentils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_pembayaran_id` bigint(20) UNSIGNED NOT NULL,
  `rekening_bank_id` bigint(20) UNSIGNED NOT NULL,
  `akun_id` bigint(20) UNSIGNED NOT NULL,
  `no_surat_izin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_izin` date NOT NULL,
  `pemakai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_objek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_objek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tarif` decimal(13,2) NOT NULL,
  `tinggi` int(10) UNSIGNED NOT NULL,
  `luas` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin@super.id', '$2y$10$pWXQREvsWQTCKkyikZd7tO7UsxJ8J4R7o19jlJm9NNjAjgIsnX7fC', 'KjbS7KVSY3sGz3eHyaps93ulVakPdDvOGCVyISvGJyqhNNGr8SRNbIyhKjgK', '0000-00-00 00:00:00', '2024-09-02 08:23:56'),
(2, 'Staff', 'staff', 'staff@user.id', '$2y$10$qQGLE0abi2EZd56CL45p3OyTrk0n38AUKjR0eWFjwFyaNV1eNxzFa', 'kw1RQqOkXXcK412Oq4YIOQnfQXWPfM6a4uSBDsxyfzgehTYRoHKyhOqPv8UR', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Fred', 'fred', 'fred@support.id', '$2y$10$RQCnMDi40bhxMXANQ0aeTOv4/Z.iVkXMGhWa7zZk21Wg19qlUvoOC', 'fJOjBgKOBpN9eTV4titBFP4vPrf45VrkiZxYXUKAVIdYSWPKNhp17RlZlziu', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_tanaman`
--
ALTER TABLE `jenis_tanaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelurahan_kecamatan_id_foreign` (`kecamatan_id`);

--
-- Indexes for table `klasifikasi_pemakaian`
--
ALTER TABLE `klasifikasi_pemakaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_opd`
--
ALTER TABLE `list_opd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `objek_retribusi`
--
ALTER TABLE `objek_retribusi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `objek_retribusi_tarif_retribusi_id_foreign` (`tarif_retribusi_id`),
  ADD KEY `objek_retribusi_kelurahan_id_foreign` (`kelurahan_id`),
  ADD KEY `objek_retribusi_pemakai_id_tarif_retribusi_id_kelurahan_id_index` (`pemakai_id`,`tarif_retribusi_id`,`kelurahan_id`);

--
-- Indexes for table `opd`
--
ALTER TABLE `opd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pemakai`
--
ALTER TABLE `pemakai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemakai_kelurahan_id_foreign` (`kelurahan_id`),
  ADD KEY `pemakai_nama_index` (`nama`);

--
-- Indexes for table `pemindahan_pemakaian`
--
ALTER TABLE `pemindahan_pemakaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemindahan_pemakaian_objek_retribusi_id_foreign` (`objek_retribusi_id`),
  ADD KEY `pemindahan_pemakaian_pemakai_lama_foreign` (`pemakai_lama`),
  ADD KEY `pemindahan_pemakaian_pemakai_baru_foreign` (`pemakai_baru`),
  ADD KEY `pemindahan_pemakaian_klasifikasi_pemakaian_id_foreign` (`klasifikasi_pemakaian_id`);

--
-- Indexes for table `penomoran`
--
ALTER TABLE `penomoran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penomoran_formulir_unique` (`formulir`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pertanian`
--
ALTER TABLE `pertanian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_tanaman_id` (`jenis_tanaman_id`),
  ADD KEY `kecamatan_id` (`kecamatan_id`,`kelurahan_id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `petugas_opd_id_foreign` (`opd_id`);

--
-- Indexes for table `rekening_bank`
--
ALTER TABLE `rekening_bank`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekening_bank_akun_bendahara_id_foreign` (`akun_bendahara_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `skrd`
--
ALTER TABLE `skrd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skrd_pemakai_id_foreign` (`pemakai_id`),
  ADD KEY `skrd_object_retribusi_id_foreign` (`object_retribusi_id`),
  ADD KEY `skrd_tanggal_pemakai_id_object_retribusi_id_index` (`tanggal`,`pemakai_id`,`object_retribusi_id`);

--
-- Indexes for table `tahun`
--
ALTER TABLE `tahun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tarif_retribusi`
--
ALTER TABLE `tarif_retribusi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tarif_retribusi_klasifikasi_pemakaian_id_index` (`klasifikasi_pemakaian_id`);

--
-- Indexes for table `tbp`
--
ALTER TABLE `tbp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbp_rekening_bank_id_foreign` (`rekening_bank_id`),
  ADD KEY `tbp_akun_id_foreign` (`akun_id`),
  ADD KEY `tbp_pemakai_id_foreign` (`pemakai_id`),
  ADD KEY `tbp_tanggal_pemakai_id_rekening_bank_id_akun_id_index` (`tanggal`,`pemakai_id`,`rekening_bank_id`,`akun_id`);

--
-- Indexes for table `tbp_detail`
--
ALTER TABLE `tbp_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbp_detail_skrd_id_foreign` (`skrd_id`),
  ADD KEY `tbp_detail_objek_retribusi_id_foreign` (`objek_retribusi_id`),
  ADD KEY `tbp_detail_jenis_pembayaran_id_foreign` (`jenis_pembayaran_id`),
  ADD KEY `tbp_detail_tbp_id_skrd_id_jenis_pembayaran_id_index` (`tbp_id`,`skrd_id`,`jenis_pembayaran_id`);

--
-- Indexes for table `tbp_insidentils`
--
ALTER TABLE `tbp_insidentils`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbp_insidentils_rekening_bank_id_foreign` (`rekening_bank_id`),
  ADD KEY `tbp_insidentils_jenis_pembayaran_id_foreign` (`jenis_pembayaran_id`),
  ADD KEY `tbp_insidentils_akun_id_foreign` (`akun_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jenis_tanaman`
--
ALTER TABLE `jenis_tanaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kelurahan`
--
ALTER TABLE `kelurahan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `klasifikasi_pemakaian`
--
ALTER TABLE `klasifikasi_pemakaian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `list_opd`
--
ALTER TABLE `list_opd`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `objek_retribusi`
--
ALTER TABLE `objek_retribusi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `opd`
--
ALTER TABLE `opd`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pemakai`
--
ALTER TABLE `pemakai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pemindahan_pemakaian`
--
ALTER TABLE `pemindahan_pemakaian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penomoran`
--
ALTER TABLE `penomoran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `pertanian`
--
ALTER TABLE `pertanian`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rekening_bank`
--
ALTER TABLE `rekening_bank`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `skrd`
--
ALTER TABLE `skrd`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tahun`
--
ALTER TABLE `tahun`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tarif_retribusi`
--
ALTER TABLE `tarif_retribusi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbp`
--
ALTER TABLE `tbp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbp_detail`
--
ALTER TABLE `tbp_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbp_insidentils`
--
ALTER TABLE `tbp_insidentils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_opd_id_foreign` FOREIGN KEY (`opd_id`) REFERENCES `opd` (`id`);

--
-- Constraints for table `rekening_bank`
--
ALTER TABLE `rekening_bank`
  ADD CONSTRAINT `rekening_bank_akun_bendahara_id_foreign` FOREIGN KEY (`akun_bendahara_id`) REFERENCES `akun` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tarif_retribusi`
--
ALTER TABLE `tarif_retribusi`
  ADD CONSTRAINT `tarif_retribusi_klasifikasi_pemakaian_id_foreign` FOREIGN KEY (`klasifikasi_pemakaian_id`) REFERENCES `klasifikasi_pemakaian` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
