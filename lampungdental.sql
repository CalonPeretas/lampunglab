-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for lampungdental
CREATE DATABASE IF NOT EXISTS `lampungdental` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lampungdental`;

-- Dumping structure for table lampungdental.dokters
CREATE TABLE IF NOT EXISTS `dokters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_klinik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lampungdental.dokters: ~2 rows (approximately)
INSERT INTO `dokters` (`id`, `nama`, `nama_klinik`, `alamat`, `no_hp`, `created_at`, `updated_at`) VALUES
	(1, 'ALAN RAMA ZUFRI', NULL, 'Medan Amplas', '082176772714', '2025-06-27 01:11:04', '2025-06-27 01:11:04'),
	(2, 'SEPTIANA', NULL, 'Bandar Lampung', '082176772714', '2025-06-27 01:25:34', '2025-06-27 01:25:34');

-- Dumping structure for table lampungdental.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lampungdental.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table lampungdental.jenis_gigis
CREATE TABLE IF NOT EXISTS `jenis_gigis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lampungdental.jenis_gigis: ~0 rows (approximately)
INSERT INTO `jenis_gigis` (`id`, `nama`, `harga`, `created_at`, `updated_at`) VALUES
	(1, 'Crown Akrilik', 1300000, '2025-06-27 01:11:24', '2025-06-27 01:11:24');

-- Dumping structure for table lampungdental.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lampungdental.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2025_06_21_122012_create_dokters_table', 1),
	(6, '2025_06_21_164630_add_nama_klinik_to_dokters_table', 1),
	(7, '2025_06_21_165842_create_jenis_gigis_table', 1),
	(8, '2025_06_21_173844_create_transaksis_table', 1),
	(9, '2025_06_21_195657_add_status_pembarayan_and_tgl_selesai_to_transaksis_table', 1),
	(10, '2025_06_27_075911_add_ongkir_to_transaksis_table', 1);

-- Dumping structure for table lampungdental.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lampungdental.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table lampungdental.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lampungdental.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table lampungdental.transaksis
CREATE TABLE IF NOT EXISTS `transaksis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `dokter_id` bigint unsigned NOT NULL,
  `jenis_gigi_id` bigint unsigned NOT NULL,
  `jumlah` int NOT NULL,
  `ongkir` int NOT NULL DEFAULT '0',
  `total_harga` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Belum Lunas',
  `tgl_selesai` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksis_dokter_id_foreign` (`dokter_id`),
  KEY `transaksis_jenis_gigi_id_foreign` (`jenis_gigi_id`),
  CONSTRAINT `transaksis_dokter_id_foreign` FOREIGN KEY (`dokter_id`) REFERENCES `dokters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaksis_jenis_gigi_id_foreign` FOREIGN KEY (`jenis_gigi_id`) REFERENCES `jenis_gigis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lampungdental.transaksis: ~2 rows (approximately)
INSERT INTO `transaksis` (`id`, `dokter_id`, `jenis_gigi_id`, `jumlah`, `ongkir`, `total_harga`, `created_at`, `updated_at`, `status_pembayaran`, `tgl_selesai`) VALUES
	(1, 1, 1, 3, 110000, 4010000, '2025-06-27 01:11:40', '2025-06-27 01:15:54', 'Belum Lunas', '2025-06-30'),
	(2, 1, 1, 2, 120000, 2720000, '2025-06-27 01:13:46', '2025-06-27 01:13:46', 'Lunas', '2025-06-29');

-- Dumping structure for table lampungdental.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lampungdental.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', 'admin@gmail.com', NULL, '$2y$12$u7D33X2RgQc8LGXAOVPVSe.KuuODEceIAQAX709fCUuBPDQRcmggG', NULL, '2025-06-27 01:10:45', '2025-06-27 01:10:45');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
