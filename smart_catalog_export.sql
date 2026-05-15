-- ============================================
-- Smart-Catalog Database Export
-- Generated: 2026-05-14 17:04:43
-- Database : smart_catalog
-- ============================================

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
SET time_zone = '+00:00';

CREATE DATABASE IF NOT EXISTS `smart_catalog` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `smart_catalog`;

-- ----------------------------
-- Table: `cache`
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table: `cache_locks`
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table: `failed_jobs`
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
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

-- ----------------------------
-- Table: `job_batches`
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
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
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table: `jobs`
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table: `kategoris`
-- ----------------------------
DROP TABLE IF EXISTS `kategoris`;
CREATE TABLE `kategoris` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `kategoris` (`id`, `nama_kategori`, `deskripsi`, `created_at`, `updated_at`) VALUES
('1', 'Makanan & Minuman', 'Produk makanan dan minuman segar maupun kemasan.', '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('2', 'Pakaian & Fashion', 'Berbagai pilihan pakaian, baju, celana, dan aksesoris fashion.', '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('3', 'Elektronik', 'Gadget, perangkat elektronik, dan aksesori pendukungnya.', '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('4', 'Kesehatan & Kecantikan', 'Produk perawatan tubuh, kesehatan, dan kecantikan.', '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('5', 'Perlengkapan Rumah', 'Furnitur, peralatan dapur, dan kebutuhan rumah tangga.', '2026-05-10 15:54:53', '2026-05-10 15:54:53');

-- ----------------------------
-- Table: `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
('1', '0001_01_01_000000_create_users_table', '1'),
('2', '0001_01_01_000001_create_cache_table', '1'),
('3', '0001_01_01_000002_create_jobs_table', '1'),
('4', '2026_05_10_083052_create_kategoris_table', '1'),
('5', '2026_05_10_084246_create_produks_table', '1'),
('6', '2026_05_10_105447_create_transaksis_table', '2');

-- ----------------------------
-- Table: `password_reset_tokens`
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table: `produks`
-- ----------------------------
DROP TABLE IF EXISTS `produks`;
CREATE TABLE `produks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori_id` bigint unsigned NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `foto_produk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produks_kategori_id_foreign` (`kategori_id`),
  CONSTRAINT `produks_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `produks` (`id`, `kategori_id`, `nama_produk`, `harga`, `stok`, `deskripsi`, `foto_produk`, `created_at`, `updated_at`) VALUES
('1', '1', 'Keripik Singkong Pedas', '15000.00', '120', 'Keripik singkong renyah dengan bumbu pedas pilihan, cocok untuk camilan sehari-hari.', 'produk/TMai3KJCvcCOJSTcaT5bzXehHpmwJYLfQbeVYG3j.jpg', '2026-05-10 15:54:53', '2026-05-14 16:53:59'),
('2', '1', 'Kopi Arabika Toraja', '75000.00', '85', 'Biji kopi arabika dari pegunungan Toraja, kaya aroma dan cita rasa.', NULL, '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('3', '1', 'Sambal Bajak Homemade', '25000.00', '60', 'Sambal bajak buatan sendiri dengan rasa autentik dan pedas yang pas.', NULL, '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('4', '1', 'Teh Hijau Premium', '35000.00', '200', 'Teh hijau organik pilihan, menyegarkan dan menyehatkan.', NULL, '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('5', '2', 'Batik Tulis Motif Parang', '350000.00', '30', 'Batik tulis tangan motif parang klasik, cocok untuk acara formal maupun kasual.', NULL, '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('6', '2', 'Kaos Polos Premium Cotton', '85000.00', '150', 'Kaos polos bahan cotton combed 30s, nyaman dan tahan lama.', NULL, '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('7', '2', 'Tas Rajut Handmade', '120000.00', '25', 'Tas rajut buatan tangan dengan desain unik dan modern.', NULL, '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('8', '3', 'Earphone Wireless Bluetooth', '180000.00', '45', 'Earphone nirkabel dengan konektivitas Bluetooth 5.0 dan baterai tahan lama.', NULL, '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('9', '3', 'Power Bank 10000mAh', '150000.00', '70', 'Power bank kapasitas besar 10.000mAh dengan fitur fast charging.', NULL, '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('10', '3', 'Lampu LED Philips 10W', '45000.00', '200', 'Lampu LED hemat energi 10 watt, terang dan tahan lama.', NULL, '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('11', '4', 'Masker Wajah Clay', '55000.00', '90', 'Masker clay untuk membersihkan pori-pori dan menjaga kulit tetap sehat.', NULL, '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('12', '4', 'Vitamin C Effervescent', '40000.00', '300', 'Suplemen vitamin C 1000mg dalam bentuk effervescent yang menyegarkan.', NULL, '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('13', '5', 'Tumbler Stainless 500ml', '95000.00', '55', 'Tumbler anti bocor bahan stainless steel, menjaga minuman tetap dingin atau panas.', NULL, '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('14', '5', 'Lilin Aromaterapi Lavender', '65000.00', '40', 'Lilin aromaterapi wangi lavender untuk relaksasi dan suasana rumah yang nyaman.', NULL, '2026-05-10 15:54:53', '2026-05-10 15:54:53');

-- ----------------------------
-- Table: `sessions`
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table: `transaksis`
-- ----------------------------
DROP TABLE IF EXISTS `transaksis`;
CREATE TABLE `transaksis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `produk_id` bigint unsigned NOT NULL,
  `jumlah` int NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `status` enum('pending','diproses','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transaksis_kode_transaksi_unique` (`kode_transaksi`),
  KEY `transaksis_produk_id_foreign` (`produk_id`),
  CONSTRAINT `transaksis_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `transaksis` (`id`, `kode_transaksi`, `produk_id`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`) VALUES
('1', 'TRX-20260510-NYX9Q', '1', '5', '75000.00', 'selesai', '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('2', 'TRX-20260510-AM2KC', '2', '2', '150000.00', 'selesai', '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('3', 'TRX-20260510-S6WPY', '5', '1', '350000.00', 'diproses', '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('4', 'TRX-20260510-ZQ5V2', '6', '3', '255000.00', 'selesai', '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('5', 'TRX-20260510-SVEIW', '8', '1', '180000.00', 'pending', '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('6', 'TRX-20260510-A8K98', '9', '2', '300000.00', 'selesai', '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('7', 'TRX-20260510-N6QJ4', '3', '4', '100000.00', 'diproses', '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('8', 'TRX-20260510-IGB3V', '12', '6', '240000.00', 'pending', '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('9', 'TRX-20260510-SLHOW', '13', '2', '190000.00', 'selesai', '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('10', 'TRX-20260510-ZLSML', '11', '3', '165000.00', 'selesai', '2026-05-10 15:54:53', '2026-05-10 15:54:53');

-- ----------------------------
-- Table: `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
('1', 'Toko Iza', 'iza@gmail.com', NULL, '$2y$12$FqmnCWAOlogMhCYFoRzKw.w8rbngOq8c0RR6m47NiHxeGNGZ19Kbu', NULL, '2026-05-10 10:00:54', '2026-05-10 10:00:54'),
('2', 'Admin Utama', 'admin@smartcatalog.com', NULL, '$2y$12$JMpf4tOpUOeGVLPKihCa8OpTRjDrV/HiPsRtXX2VAuufPS34S5du.', NULL, '2026-05-10 10:02:50', '2026-05-10 15:54:53'),
('3', 'Toko Berkah Jaya', 'toko@umkm.com', NULL, '$2y$12$Mj7iCZtynQz80M.qtYuA2.suUCx0jRxxGsT0ANwmFZRAb.Y8g8WWG', NULL, '2026-05-10 15:54:53', '2026-05-10 15:54:53'),
('4', 'Warung Bu Sari', 'merchant@smartcatalog.com', NULL, '$2y$12$bCXhDd5iIU/fXrCIg.kgYOW/EjBIgwcdf01qUwEEWlmwFy7ANZFAe', NULL, '2026-05-10 15:54:53', '2026-05-10 15:54:53');

SET FOREIGN_KEY_CHECKS=1;
