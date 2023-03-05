-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.2.0.6576
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_artikel
CREATE DATABASE IF NOT EXISTS `db_artikel` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_artikel`;

-- Dumping structure for table db_artikel.artikel
CREATE TABLE IF NOT EXISTS `artikel` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `judul` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_artikel.artikel: ~3 rows (approximately)
DELETE FROM `artikel`;
INSERT INTO `artikel` (`id`, `judul`, `deskripsi`, `kategori`, `created_at`, `updated_at`) VALUES
	(2, 'Belajar Laravel Fundamental', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,', 'Berbayar', NULL, NULL),
	(3, 'Belajar Pyton Advance', 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 'Berbayar', NULL, NULL),
	(4, 'Belajar CSS Fundamental', 'SS (Cascading Style Sheets) is the code that styles web content. CSS basics walks through what you need to get started. We\'ll answer questions like: How do I make text red? How do I make content display at a certain location in the (webpage) layout? How do I decorate my webpage with background images and colors?', 'Free', NULL, NULL);

-- Dumping structure for table db_artikel.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_artikel.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table db_artikel.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_artikel.migrations: ~7 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2023_03_02_160001_create_artikel_table', 2),
	(5, '2023_03_05_110934_create_orders_table', 3),
	(6, '2023_03_05_111835_create_orders_table', 4),
	(7, '2023_03_05_121054_create_orders_table', 5);

-- Dumping structure for table db_artikel.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `artikel_id` int(11) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `status` enum('Unpaid','Paid') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_artikel.orders: ~1 rows (approximately)
DELETE FROM `orders`;
INSERT INTO `orders` (`id`, `name`, `artikel_id`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
	(2, 'jeri', 2, 30000, 'Paid', '2023-03-05 08:44:17', '2023-03-05 08:44:17');

-- Dumping structure for table db_artikel.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_artikel.password_resets: ~0 rows (approximately)
DELETE FROM `password_resets`;

-- Dumping structure for table db_artikel.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(23) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_artikel.users: ~6 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `role`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin', 'admin@gmail.com', NULL, '$2y$10$/CRjMC2ARLlQwpkSJB0ZWOKHtmNvdnjAeaU1VMW/gWvSRVou4Czvy', NULL, '2023-03-02 08:04:38', '2023-03-02 08:04:38'),
	(2, 'user', 'Wildan', 'wildan@gmail.com', NULL, '$2y$10$LMMdAQ/Avjg6FC1dya7aCeI8DzpQ2KZbu5CgJ7oYK4LEOHa.QTusm', NULL, '2023-03-04 02:09:32', '2023-03-04 02:09:32'),
	(3, 'user', 'aldi', 'aldi@gmail.com', NULL, '$2y$10$JPm1wc8mG4.949yZ/ryJZO9ixQPNttTG.aF8OlAFNdXhSSDyRxmyK', NULL, '2023-03-05 08:22:47', '2023-03-05 08:22:47'),
	(4, 'user', 'sri', 'sri@gmail.com', NULL, '$2y$10$cUEVsuo6k0p93q1eUq3OW.hu1x6LGL/wEo/Qgszi4KgTc2hYOqxFW', NULL, '2023-03-05 08:40:05', '2023-03-05 08:40:05'),
	(5, 'user', 'dewi', 'dewi@gmail.com', NULL, '$2y$10$X0YbzvoQexMhJRM3p/Mg4e4rXYNJzUDStcsnEQKuNff2EsV174ppe', NULL, '2023-03-05 08:41:07', '2023-03-05 08:41:07'),
	(6, 'user', 'jeri', 'jeri@gmail.com', NULL, '$2y$10$W0mi9j8vHw6jPG4qdNOFaOD.95sY5tmc788ZDn77iaf1t4cPg/m5e', NULL, '2023-03-05 08:43:17', '2023-03-05 08:43:17');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
