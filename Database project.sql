-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for databasenew
-- DROP DATABASE IF EXISTS `databasenew`;
-- CREATE DATABASE IF NOT EXISTS `databasenew` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
-- USE `databasenew`;

-- -- Dumping structure for table databasenew.cache
-- DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table databasenew.cache: ~0 rows (approximately)

-- Dumping structure for table databasenew.cache_locks
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table databasenew.cache_locks: ~0 rows (approximately)

-- Dumping structure for table databasenew.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
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

-- Dumping data for table databasenew.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table databasenew.jobs
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table databasenew.jobs: ~0 rows (approximately)

-- Dumping structure for table databasenew.job_batches
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
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

-- Dumping data for table databasenew.job_batches: ~0 rows (approximately)

-- Dumping structure for table databasenew.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table databasenew.migrations: ~7 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_01_02_113046_create_vendors_table', 1),
	(5, '2025_12_11_120256_create_products_table', 1),
	(6, '2025_12_12_120215_create_transactionheaders_table', 1),
	(7, '2026_01_11_123847_create_transactionitems_table', 1);

-- Dumping structure for table databasenew.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `Product_ID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Vendor_ID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` int NOT NULL,
  `stock` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Product_ID`),
  KEY `products_vendor_id_foreign` (`Vendor_ID`),
  CONSTRAINT `products_vendor_id_foreign` FOREIGN KEY (`Vendor_ID`) REFERENCES `vendors` (`Vendor_ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table databasenew.products: ~3 rows (approximately)
INSERT INTO `products` (`Product_ID`, `Vendor_ID`, `name`, `description`, `price`, `stock`, `image`, `created_at`, `updated_at`) VALUES
	('1ab2fe39-16ad-4cf9-9510-31af64957fa0', '360739c3-16f7-4c0c-b2db-e738415a0f9b', 'Ayam betutu', 'rasa lezat', 15000, 0, '61966f20-c50d-488e-9123-5a5f96850bcb.jpg', '2026-01-04 00:54:50', '2026-01-04 02:26:18'),
	('4f287b39-2ca4-4bf2-8422-f8e394f54b76', '360739c3-16f7-4c0c-b2db-e738415a0f9b', 'Ayam taliwang', 'memberikan rasa yang mantap segar rasakann sekarang juga', 123412, 9, 'cdd7998e-ba11-484c-9d5d-0a6e8d8e5728.jpg', '2026-01-04 01:02:59', '2026-01-04 02:26:34'),
	('d9b5aab9-37f3-44ee-ab86-4dbb971c739a', '360739c3-16f7-4c0c-b2db-e738415a0f9b', 'baso ayam', 'baso malang enak bergiizi', 12300000, 12, '50455552-31ea-4774-824b-ebdf748a8a95.jpg', '2026-01-04 01:02:37', '2026-01-04 01:45:41');

-- Dumping structure for table databasenew.transactionheaders
DROP TABLE IF EXISTS `transactionheaders`;
CREATE TABLE IF NOT EXISTS `transactionheaders` (
  `Transaction_ID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Customer_ID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Vendor_ID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` int NOT NULL,
  `status` enum('pending','paid','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Transaction_ID`),
  KEY `transactionheaders_customer_id_foreign` (`Customer_ID`),
  KEY `transactionheaders_vendor_id_foreign` (`Vendor_ID`),
  CONSTRAINT `transactionheaders_customer_id_foreign` FOREIGN KEY (`Customer_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE,
  CONSTRAINT `transactionheaders_vendor_id_foreign` FOREIGN KEY (`Vendor_ID`) REFERENCES `vendors` (`Vendor_ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table databasenew.transactionheaders: ~4 rows (approximately)
INSERT INTO `transactionheaders` (`Transaction_ID`, `Customer_ID`, `Vendor_ID`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
	('00a89ada-7746-4738-854d-6fb9584ab0c3', '46d10b30-7578-4bae-88d5-7a9138f01829', '360739c3-16f7-4c0c-b2db-e738415a0f9b', 30000, 'cancelled', '2026-01-04 01:25:48', '2026-01-04 02:24:03'),
	('4af8ef3c-710e-4cde-a413-5a8ebd7f9da6', '46d10b30-7578-4bae-88d5-7a9138f01829', '360739c3-16f7-4c0c-b2db-e738415a0f9b', 370236, 'paid', '2026-01-04 02:26:34', '2026-01-04 02:26:34'),
	('8c4d1776-5106-4285-8810-5a0731d7b1dc', '46d10b30-7578-4bae-88d5-7a9138f01829', '360739c3-16f7-4c0c-b2db-e738415a0f9b', 45000, 'completed', '2026-01-04 02:26:18', '2026-01-04 02:26:54'),
	('ab371e5e-6fc3-48e7-ba6e-e4afedf1a460', '46d10b30-7578-4bae-88d5-7a9138f01829', '360739c3-16f7-4c0c-b2db-e738415a0f9b', 105000, 'cancelled', '2026-01-04 01:19:38', '2026-01-04 02:24:01');

-- Dumping structure for table databasenew.transactionitems
DROP TABLE IF EXISTS `transactionitems`;
CREATE TABLE IF NOT EXISTS `transactionitems` (
  `Transaction_Item_ID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Transaction_ID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Product_ID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  `subtotal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Transaction_Item_ID`),
  KEY `transactionitems_transaction_id_foreign` (`Transaction_ID`),
  KEY `transactionitems_product_id_foreign` (`Product_ID`),
  CONSTRAINT `transactionitems_product_id_foreign` FOREIGN KEY (`Product_ID`) REFERENCES `products` (`Product_ID`) ON DELETE CASCADE,
  CONSTRAINT `transactionitems_transaction_id_foreign` FOREIGN KEY (`Transaction_ID`) REFERENCES `transactionheaders` (`Transaction_ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table databasenew.transactionitems: ~4 rows (approximately)
INSERT INTO `transactionitems` (`Transaction_Item_ID`, `Transaction_ID`, `Product_ID`, `quantity`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
	('89f300ed-c181-4c3e-a156-c82bd9d06929', 'ab371e5e-6fc3-48e7-ba6e-e4afedf1a460', '1ab2fe39-16ad-4cf9-9510-31af64957fa0', 7, 15000, 105000, '2026-01-04 01:19:38', '2026-01-04 01:19:38'),
	('cadb4394-c93e-4f9f-9b6d-9635b1410278', '00a89ada-7746-4738-854d-6fb9584ab0c3', '1ab2fe39-16ad-4cf9-9510-31af64957fa0', 2, 15000, 30000, '2026-01-04 01:25:48', '2026-01-04 01:25:48'),
	('d60f4365-1ac1-4e1a-806c-759fc241dde6', '4af8ef3c-710e-4cde-a413-5a8ebd7f9da6', '4f287b39-2ca4-4bf2-8422-f8e394f54b76', 3, 123412, 370236, '2026-01-04 02:26:34', '2026-01-04 02:26:34'),
	('ffc01274-dea4-4b7c-99d3-5276330907f2', '8c4d1776-5106-4285-8810-5a0731d7b1dc', '1ab2fe39-16ad-4cf9-9510-31af64957fa0', 3, 15000, 45000, '2026-01-04 02:26:18', '2026-01-04 02:26:18');

-- Dumping structure for table databasenew.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `User_ID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','vendor') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`User_ID`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table databasenew.users: ~13 rows (approximately)
INSERT INTO `users` (`User_ID`, `name`, `email`, `phone`, `password`, `role`, `created_at`, `updated_at`) VALUES
	('36d638c1-dbb5-4476-8e56-acd9bc17be61', 'Christiansen Group', 'pbrown@example.org', '+16369629182', '$2y$12$5xwqRA9YMrkFPF30xgQ9degLH.QGVMydPdpqLUxLJGyUn1ItzjkMu', 'vendor', '2026-01-02 22:35:22', '2026-01-02 22:35:22'),
	('3b8e3a4c-91d1-44a7-bc3e-cdaf20611993', 'Haley, Kovacek and Welch', 'cole.ariane@example.org', '(307) 481-4775', '$2y$12$47JzrR5.Fe6ZMCZiM/xaQeGV/c9VFdut885jvTHrqG0riQw49.3s.', 'vendor', '2026-01-02 22:35:21', '2026-01-02 22:35:21'),
	('46d10b30-7578-4bae-88d5-7a9138f01829', 'Rhevell Herliman Senewe', 'ray123@gmail.com', '081806170710', '$2y$12$HC1FZJJMVGioCbVwrSLxjuXDX3mRMAZwAUvympQHUTHGpCSUndfvS', 'user', '2026-01-02 05:15:11', '2026-01-02 05:15:11'),
	('7f4abd57-470f-4b76-808a-2c9bcd4133d4', 'Stehr Inc', 'bnader@example.net', '857.405.2873', '$2y$12$n9H7CSc9rBagJpweg4GVPuERednMACybVfo4zxq84O.i2JqPBneXy', 'vendor', '2026-01-02 22:35:23', '2026-01-02 22:35:23'),
	('8dfb6230-a3e2-47ef-a9fb-4c70d1232203', 'Witting Inc', 'reyna20@example.org', '+1-651-487-9321', '$2y$12$mPBGODWMj8wJafkMM3OjDO.C/QP1GRpMMPQ1gKa7WUuLBfwJHmrzO', 'vendor', '2026-01-02 22:35:23', '2026-01-02 22:35:23'),
	('9e987035-6fcc-4521-8ec6-6f5717b7ad87', 'Heathcote-Dietrich', 'mayer.melyssa@example.net', '+1 (517) 952-6321', '$2y$12$pBQmmXdgJpmiqw9L7uTS4ufW06dcMYdT/WqSTXAWMrkxTptbQZG9e', 'vendor', '2026-01-02 22:35:22', '2026-01-02 22:35:22'),
	('a31be703-56ee-45aa-893b-e2402b050198', 'McCullough-Cole', 'ronaldo29@example.org', '1-325-581-6079', '$2y$12$rO0oJcnciQQtjINEqYR3t.SLddxunlOXemG8JKk/9Juvnd74IC5XW', 'vendor', '2026-01-02 22:35:20', '2026-01-02 22:35:20'),
	('b21e1d43-3ba1-4610-bbc7-5f3051665c6e', 'Braun, Hackett and Hartmann', 'sbergnaum@example.com', '+19794424834', '$2y$12$8laArpK9ZQp9HLoiSwR9Sezz10eueQDjfnnNvFjwOfkx4z.zbzCnO', 'vendor', '2026-01-02 22:35:24', '2026-01-02 22:35:24'),
	('b7ce585c-dd11-4487-9ac3-062c9c29286b', 'Mills-Friesen', 'uriah.weissnat@example.net', '+14698656938', '$2y$12$G6Xt3l4vnswcMcIcqn55QeakXRQfOcOvxUOWChycTvYvXp8ptKHjG', 'vendor', '2026-01-02 22:35:24', '2026-01-02 22:35:24'),
	('c72c857d-4cd7-41c6-9e28-e5f378fc3236', 'Anderson-Cronin', 'myriam.welch@example.net', '+1 (571) 408-7057', '$2y$12$FPue2QmVj0/yGv2PcC75EuBIELML/9tXMvaxaGCI1Xzs7t1OBXNRa', 'vendor', '2026-01-02 22:35:21', '2026-01-02 22:35:21'),
	('e33d7bfd-5510-4fda-b8f0-819e6ca713e7', 'Test Vendor', 'vendor@test.com', '081234567890', '$2y$12$X7mKFy3aQz9xCcLjYX99Ke7ffYEiHKbuMAvEZY8QGJ.O1tZhTTXsS', 'vendor', '2026-01-02 22:35:25', '2026-01-02 22:35:25'),
	('f15a0d34-a79b-4590-99fd-1b1ed6bba1bb', 'Bailey, Dicki and Friesen', 'jerrod.schaefer@example.com', '815-496-7870', '$2y$12$Nl0eX/TQYBXRxjB8aUD/QeJddd51Lb3tJKqZre1udQdRW3xj8J4UC', 'vendor', '2026-01-02 22:35:20', '2026-01-02 22:35:20'),
	('f21cdecc-ffec-4068-b8ee-1e20417afa7f', 'Bob', 'bob@gmail.com', '08180617071021', '$2y$12$9QTrTGSzwvDmG1lvo7giGeuwfQUDY09JKg4A6ig916.2.ZbpDaHnG', 'user', '2026-01-02 05:15:58', '2026-01-02 05:15:58');

-- Dumping structure for table databasenew.vendors
DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `Vendor_ID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `User_ID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Vendor_ID`),
  KEY `vendors_user_id_foreign` (`User_ID`),
  CONSTRAINT `vendors_user_id_foreign` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table databasenew.vendors: ~11 rows (approximately)
INSERT INTO `vendors` (`Vendor_ID`, `User_ID`, `address`, `image`, `created_at`, `updated_at`) VALUES
	('0c7fe1b6-3ccc-4b91-99df-c21c1094a45f', 'b21e1d43-3ba1-4610-bbc7-5f3051665c6e', '539 McGlynn Islands Suite 950\nDenesikshire, HI 02944-3438', 'vendor.png', '2026-01-02 22:35:24', '2026-01-02 22:35:24'),
	('251f4105-43e6-409d-9962-14b32629933c', '3b8e3a4c-91d1-44a7-bc3e-cdaf20611993', '56644 Wisozk Dale Apt. 605\nSouth Diana, UT 37447-7100', 'vendor.png', '2026-01-02 22:35:21', '2026-01-02 22:35:21'),
	('34645c29-99cb-49c9-a08b-8a02d6b4df25', '9e987035-6fcc-4521-8ec6-6f5717b7ad87', '94940 Kovacek Tunnel Apt. 010\nSouth Dawnland, WI 05711-0568', 'vendor.png', '2026-01-02 22:35:22', '2026-01-02 22:35:22'),
	('360739c3-16f7-4c0c-b2db-e738415a0f9b', 'a31be703-56ee-45aa-893b-e2402b050198', '412 Sawayn Gateway Suite 546\nBlockberg, MN 41033', 'vendor.png', '2026-01-02 22:35:20', '2026-01-02 22:35:20'),
	('3a7e0d23-5019-4d2a-aef4-c40b74ae1d41', 'f15a0d34-a79b-4590-99fd-1b1ed6bba1bb', '427 Keeling Parkways Apt. 225\nLelandburgh, MO 04893-7634', 'vendor.png', '2026-01-02 22:35:20', '2026-01-02 22:35:20'),
	('6bbbfd3e-13fd-4949-94f3-496998b5aa99', 'e33d7bfd-5510-4fda-b8f0-819e6ca713e7', 'Jl. Test Vendor No. 123', 'vendor.png', '2026-01-02 22:35:25', '2026-01-02 22:35:25'),
	('862694dc-4f2e-47c0-b702-abdc32b9e9f8', '36d638c1-dbb5-4476-8e56-acd9bc17be61', '483 Nicolas Green Suite 743\nStreichfort, DC 56270', 'vendor.png', '2026-01-02 22:35:22', '2026-01-02 22:35:22'),
	('864574c4-2ca1-43ae-9aff-69ae689f7177', '8dfb6230-a3e2-47ef-a9fb-4c70d1232203', '88651 Noe Pass\nNorth Alize, NV 20067-1416', 'vendor.png', '2026-01-02 22:35:23', '2026-01-02 22:35:23'),
	('a2c3447a-5c61-46e8-87a4-345ee90e26e8', '7f4abd57-470f-4b76-808a-2c9bcd4133d4', '930 Ankunding Estates Apt. 784\nSadieborough, HI 80959', 'vendor.png', '2026-01-02 22:35:23', '2026-01-02 22:35:23'),
	('d1bed8ee-f8c7-44bd-8bd2-a40e9d67eaeb', 'c72c857d-4cd7-41c6-9e28-e5f378fc3236', '7257 Eveline Port\nWest Tomasaport, OK 28634-2232', 'vendor.png', '2026-01-02 22:35:21', '2026-01-02 22:35:21'),
	('ef3d2cda-3866-4c92-9fca-9316544cdcb1', 'b7ce585c-dd11-4487-9ac3-062c9c29286b', '246 Addie Junctions\nPort Joychester, GA 09318', 'vendor.png', '2026-01-02 22:35:24', '2026-01-02 22:35:24');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
