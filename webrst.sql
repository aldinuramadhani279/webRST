-- SQL Dump for webRST
-- Generated: 2026-07-30
-- Compatible with all Laravel Migrations in codebase

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webrst`
--

-- --------------------------------------------------------
-- Table structure for `users`
--
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@gmail.com', NULL, '$2y$12$.xgDWjRypGJ65R8JykKf7OFjgKBjxp2OG9jx75/W9pisq2l0ySs/K', NULL, '2025-12-10 04:39:47', '2025-12-10 04:39:47');

-- --------------------------------------------------------
-- Table structure for `password_reset_tokens`
--
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `failed_jobs`
--
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `personal_access_tokens`
--
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
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

-- --------------------------------------------------------
-- Table structure for `specializations`
--
DROP TABLE IF EXISTS `specializations`;
CREATE TABLE `specializations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `specializations_name_index` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `specializations` (`id`, `name`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Dokter Umum', 'fa-user-md', '2025-12-10 05:04:04', '2025-12-10 05:04:04'),
(2, 'Dokter Gigi', 'fa-tooth', '2025-12-10 05:04:04', '2025-12-10 05:04:04'),
(3, 'Dokter Anak', 'fa-baby', '2025-12-10 05:04:04', '2025-12-10 05:04:04'),
(4, 'Dokter Kulit', 'fa-allergies', '2025-12-10 05:04:04', '2025-12-10 05:04:04'),
(5, 'Dokter Jantung', 'fa-heart', '2025-12-10 05:04:04', '2025-12-10 05:04:04'),
(6, 'Dokter Mata', 'fa-eye', '2025-12-10 05:04:04', '2025-12-10 05:04:04'),
(7, 'Dokter THT', 'fa-head-side-cough', '2025-12-10 05:04:04', '2025-12-10 05:04:04'),
(8, 'Dokter Kandungan', 'fa-baby-carriage', '2025-12-10 05:04:04', '2025-12-10 05:04:04');

-- --------------------------------------------------------
-- Table structure for `doctors`
--
DROP TABLE IF EXISTS `doctors`;
CREATE TABLE `doctors` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `specialization_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sip_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doctors_specialization_id_index` (`specialization_id`),
  KEY `doctors_is_active_index` (`is_active`),
  CONSTRAINT `doctors_specialization_id_foreign` FOREIGN KEY (`specialization_id`) REFERENCES `specializations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `doctors` (`id`, `specialization_id`, `name`, `sip_number`, `bio`, `photo`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'dr. Budi Santoso', 'SIP.449/001/DU/2023', '<p>Dokter umum dengan pengalaman pelayanan kesehatan primer lebih dari 8 tahun.</p>', NULL, 1, '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(2, 1, 'dr. Siti Rahmawati', 'SIP.449/002/DU/2023', '<p>Dokter umum yang berfokus pada pencegahan penyakit dan kesehatan keluarga.</p>', NULL, 1, '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(3, 2, 'drg. Maya Indah', 'SIP.449/010/DG/2022', '<p>Spesialis perawatan kesehatan gigi dan mulut untuk anak maupun dewasa.</p>', NULL, 1, '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(4, 3, 'dr. Hendra Wijaya, Sp.A', 'SIP.449/015/SPA/2021', '<p>Spesialis kesehatan anak dan tumbuh kembang balita.</p>', NULL, 1, '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(5, 4, 'dr. Anita Setyowati, Sp.DV', 'SIP.449/020/SPDV/2022', '<p>Spesialis dermatologi dan estetika kulit.</p>', NULL, 1, '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(6, 5, 'dr. Bambang Pratama, Sp.JP', 'SIP.449/025/SPJP/2020', '<p>Spesialis jantung dan pembuluh darah dengan kualifikasi kardiovaskular.</p>', NULL, 1, '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(7, 6, 'dr. Rina Kurnia, Sp.M', 'SIP.449/030/SPM/2021', '<p>Spesialis kesehatan mata dan operasi katarak.</p>', NULL, 1, '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(8, 7, 'dr. Ahmad Fauzi, Sp.THT-KL', 'SIP.449/035/THT/2022', '<p>Spesialis Telinga Hidung Tenggorokan dan Kepala Leher.</p>', NULL, 1, '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(9, 8, 'dr. Dewi Lestari, Sp.OG', 'SIP.449/040/SPOG/2020', '<p>Spesialis Kebidanan dan Kandungan untuk kehamilan dan kesehatan reproduksi wanita.</p>', NULL, 1, '2026-07-30 00:00:00', '2026-07-30 00:00:00');

-- --------------------------------------------------------
-- Table structure for `schedules`
--
DROP TABLE IF EXISTS `schedules`;
CREATE TABLE `schedules` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `doctor_id` bigint UNSIGNED NOT NULL,
  `day` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedules_doctor_id_foreign` (`doctor_id`),
  CONSTRAINT `schedules_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `schedules` (`id`, `doctor_id`, `day`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 1, 'Senin', '08:00:00', '12:00:00', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(2, 1, 'Selasa', '08:00:00', '12:00:00', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(3, 1, 'Rabu', '08:00:00', '12:00:00', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(4, 2, 'Rabu', '08:00:00', '12:00:00', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(5, 2, 'Kamis', '08:00:00', '12:00:00', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(6, 3, 'Jumat', '08:00:00', '12:00:00', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(7, 3, 'Sabtu', '08:00:00', '12:00:00', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(8, 4, 'Senin', '08:00:00', '12:00:00', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(9, 5, 'Selasa', '08:00:00', '12:00:00', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(10, 6, 'Rabu', '08:00:00', '12:00:00', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(11, 7, 'Kamis', '08:00:00', '12:00:00', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(12, 8, 'Jumat', '08:00:00', '12:00:00', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(13, 9, 'Sabtu', '08:00:00', '12:00:00', '2026-07-30 00:00:00', '2026-07-30 00:00:00');

-- --------------------------------------------------------
-- Table structure for `services`
--
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` enum('rawat_jalan','rawat_inap','penunjang') COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_category_index` (`category`),
  KEY `services_slug_index` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `services` (`id`, `title`, `slug`, `category`, `content`, `contact_link`, `contact_icon`, `upload_type`, `image`, `file_path`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, 'Pemeriksaan Umum', 'pemeriksaan-umum', 'rawat_jalan', 'Deskripsi lengkap untuk layanan Pemeriksaan Umum dengan fasilitas lengkap dan dokter ahli.', NULL, NULL, 'image', 'services/01KC6GNSN1HR4VDK7AJ4769RRZ.png', NULL, 1, '2025-12-10 05:05:20', '2025-12-11 03:52:56'),
(2, 'Vaksinasi', 'vaksinasi', 'rawat_jalan', 'Deskripsi lengkap untuk layanan Vaksinasi akan segera tersedia. Kami menyediakan layanan Vaksinasi dengan dukungan tenaga medis profesional dan peralatan modern.', NULL, NULL, 'image', 'services/01KC6HD6JAXE8K648EJ7C8VWAD.png', NULL, 1, '2025-12-10 05:05:20', '2025-12-11 04:05:43'),
(3, 'Radiologi', 'radiologi', 'penunjang', 'Deskripsi lengkap untuk layanan Radiologi akan segera tersedia. Kami menyediakan layanan Radiologi dengan dukungan tenaga medis profesional dan peralatan modern.', NULL, NULL, 'image', 'services/01KC6HRMBZ95HAKQQ2E29P8PR5.png', NULL, 1, '2025-12-10 05:05:20', '2025-12-11 04:11:58'),
(4, 'Konsultasi Gigi', 'konsultasi-gigi', 'rawat_jalan', 'Deskripsi lengkap untuk layanan Konsultasi Gigi akan segera tersedia. Kami menyediakan layanan Konsultasi Gigi dengan dukungan tenaga medis profesional.', NULL, NULL, 'image', 'services/01KC6HM6ZHTBM98P24GYAACZK0.png', NULL, 1, '2025-12-11 02:09:33', '2025-12-11 04:09:33'),
(5, 'Test Laboratorium', 'test-laboratorium', 'penunjang', 'Deskripsi lengkap untuk layanan Test Laboratorium akan segera tersedia. Kami menyediakan layanan Test Laboratorium dengan dukungan peralatan presisi.', NULL, NULL, 'image', 'services/01KC6JESTQWQRJWV5DTY2CYX2R.png', NULL, 1, '2025-12-11 02:09:33', '2025-12-11 04:24:04'),
(6, 'Fisioterapi', 'fisioterapi', 'rawat_jalan', 'Ini adalah layanan terapi bagi penderita sakit fisik dengan instruktur profesional.', NULL, NULL, 'image', 'services/01KC6GNSN1HR4VDK7AJ4769RRZ.png', NULL, 1, '2025-12-11 03:52:56', '2025-12-11 03:52:56'),
(7, 'Rawat Inap VIP', 'rawat-inap-vip', 'rawat_inap', 'Fasilitas kamar rawat inap VIP dengan pelayanan 24 jam dan kamar mandi dalam.', NULL, NULL, 'image', NULL, NULL, 0, '2026-07-30 00:00:00', '2026-07-30 00:00:00');

-- --------------------------------------------------------
-- Table structure for `service_images`
--
DROP TABLE IF EXISTS `service_images`;
CREATE TABLE `service_images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_images_service_id_foreign` (`service_id`),
  CONSTRAINT `service_images_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `articles`
--
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','published') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articles_status_index` (`status`),
  KEY `articles_published_at_index` (`published_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `articles` (`id`, `title`, `slug`, `content`, `contact_link`, `contact_icon`, `thumbnail`, `status`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Tips Menjaga Kesehatan Jantung di Usia Produktif', 'tips-menjaga-kesehatan-jantung-di-usia-produktif', '<p>Menjaga kesehatan jantung sangat penting sejak usia muda. Lakukan olahraga teratur minimal 30 menit sehari, konsumsi makanan bergizi seimbang, hindari merokok, dan kelola stres dengan baik.</p>', NULL, NULL, '01KC62CVVC8H9TPYR2RR64FBQW.jpg', 'published', '2025-12-10 23:56:19', '2025-12-10 23:43:24', '2025-12-10 23:56:19'),
(2, 'Pentingnya Imunisasi Rutin Bagi Tumbuh Kembang Anak', 'pentingnya-imunisasi-rutin-bagi-tumbuh-kembang-anak', '<p>Imunisasi merupakan langkah efektif untuk melindungi anak dari berbagai penyakit berbahaya seperti campak, polio, dan hepatitis. Pastikan anak mendapatkan vaksinasi sesuai jadwal rekomendasi dokter anak.</p>', NULL, NULL, NULL, 'published', '2026-07-30 00:00:00', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(3, 'Cara Mencegah Gigi Berlubang pada Anak dan Dewasa', 'cara-mencegah-gigi-berlubang-pada-anak-dan-dewasa', '<p>Gigi berlubang dapat dicegah dengan menyikat gigi dua kali sehari menggunakan pasta gigi berfluoride, membatasi konsumsi makanan manis, dan rutin memeriksakan gigi ke dokter setiap 6 bulan sekali.</p>', NULL, NULL, NULL, 'published', '2026-07-30 00:00:00', '2026-07-30 00:00:00', '2026-07-30 00:00:00');

-- --------------------------------------------------------
-- Table structure for `article_images`
--
DROP TABLE IF EXISTS `article_images`;
CREATE TABLE `article_images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `article_images_article_id_foreign` (`article_id`),
  CONSTRAINT `article_images_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `albums`
--
DROP TABLE IF EXISTS `albums`;
CREATE TABLE `albums` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `albums_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `albums` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Kegiatan Pelayanan Kesehatan', 'kegiatan-pelayanan-kesehatan', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(2, 'Fasilitas Rumah Sakit', 'fasilitas-rumah-sakit', '2026-07-30 00:00:00', '2026-07-30 00:00:00');

-- --------------------------------------------------------
-- Table structure for `photos`
--
DROP TABLE IF EXISTS `photos`;
CREATE TABLE `photos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `album_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `photos_album_id_foreign` (`album_id`),
  CONSTRAINT `photos_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `photos` (`id`, `album_id`, `title`, `path`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pemeriksaan Kesehatan Gratis', 'photos/pelayanan-1.jpg', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(2, 2, 'Gedung Rawat Jalan', 'photos/fasilitas-1.jpg', '2026-07-30 00:00:00', '2026-07-30 00:00:00');

-- --------------------------------------------------------
-- Table structure for `videos`
--
DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `youtube_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `videos` (`id`, `title`, `youtube_link`, `created_at`, `updated_at`) VALUES
(1, 'Profil RS dr. Asmir Salatiga', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(2, 'Edukasi Kesehatan Jantung', 'https://www.youtube.com/watch?v=3JZ_D3ELwOQ', '2026-07-30 00:00:00', '2026-07-30 00:00:00');

-- --------------------------------------------------------
-- Table structure for `settings`
--
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES
(1, 'emergency_number', '(0298) 324568', 'string', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(2, 'hospital_name', 'RST dr. Asmir Salatiga', 'string', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(3, 'hospital_address', 'Jl. Muwardi No.9, Salatiga, Jawa Tengah', 'string', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(4, 'hospital_phone', '(0298) 324568', 'string', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(5, 'hospital_email', 'info@rstdrasmirsalatiga.co.id', 'string', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(6, 'banner_image', '', 'image', '2026-07-30 00:00:00', '2026-07-30 00:00:00'),
(7, 'logo', '', 'image', '2026-07-30 00:00:00', '2026-07-30 00:00:00');

-- --------------------------------------------------------
-- Table structure for `page_visits`
--
DROP TABLE IF EXISTS `page_visits`;
CREATE TABLE `page_visits` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `referer` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `page_visits_created_at_index` (`created_at`),
  KEY `page_visits_url_index` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for `migrations`
--
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_12_10_073359_create_specializations_table', 1),
(6, '2025_12_10_073516_create_doctors_table', 1),
(7, '2025_12_10_073529_create_schedules_table', 1),
(8, '2025_12_10_073544_create_services_table', 1),
(9, '2025_12_10_073559_create_articles_table', 1),
(10, '2025_12_10_073612_create_settings_table', 1),
(11, '2025_12_10_124635_add_indexes_to_tables', 2),
(12, '2025_12_11_071305_add_is_featured_to_services_table', 3),
(13, '2025_12_16_035715_add_contact_fields_to_services_table', 4),
(14, '2025_12_16_035925_create_service_images_table', 5),
(15, '2025_12_16_041724_add_contact_fields_to_articles_table', 6),
(16, '2025_12_16_041919_create_article_images_table', 7),
(17, '2025_12_17_040649_create_albums_table', 8),
(18, '2025_12_17_040756_create_photos_table', 9),
(19, '2025_12_17_040859_create_videos_table', 10),
(20, '2026_01_05_022622_make_type_nullable_in_settings_table', 11),
(21, '2026_01_07_000002_make_image_column_nullable_in_services_table', 12),
(22, '2026_01_07_000003_add_upload_type_and_file_path_to_services_table', 12),
(23, '2026_01_22_135626_add_second_time_slot_to_schedules_table', 13),
(24, '2026_04_02_000001_create_page_visits_table', 14),
(25, '2026_04_02_131416_create_page_visits_table', 14),
(26, '2026_04_07_110006_fix_nullable_thumbnail_in_articles_table', 15),
(27, '2026_04_08_000001_migrate_and_drop_session2_from_schedules', 15);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
