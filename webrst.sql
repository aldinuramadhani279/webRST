-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 12, 2025 at 07:51 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('draft','published') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `content`, `thumbnail`, `status`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'IT RS Asmir Hack Nasa', 'it-rs-asmir-hack-nasaba', '<p>icikiwir</p>', '01KC62CVVC8H9TPYR2RR64FBQW.jpg', 'published', '2025-12-10 23:56:19', '2025-12-10 23:43:24', '2025-12-10 23:56:19');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint UNSIGNED NOT NULL,
  `specialization_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sip_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `specialization_id`, `name`, `sip_number`, `bio`, `photo`, `is_active`, `created_at`, `updated_at`) VALUES
(4, 3, 'Aldi Nur Ramadhani', '0858127361234', '<p>saya dokter</p>', 'doctors/01KC44AF6SPH2E837QNW40E6WN.jpg', 1, '2025-12-10 05:38:33', '2025-12-10 05:38:33'),
(5, 3, 'Aldi Nur Ramadhani', '0858127361234', '<p>saya dokter</p>', 'doctors/01KC44ME5C8PMVJ62GRZB293AH.jpeg', 1, '2025-12-10 05:44:00', '2025-12-10 05:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

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
(12, '2025_12_11_071305_add_is_featured_to_services_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `doctor_id` bigint UNSIGNED NOT NULL,
  `day` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` enum('rawat_jalan','rawat_inap','penunjang') COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `slug`, `category`, `content`, `image`, `is_featured`, `created_at`, `updated_at`) VALUES
(2, 'Vaksinasi', 'vaksinasi', 'rawat_jalan', 'Deskripsi lengkap untuk layanan Vaksinasi akan segera tersedia. Kami menyediakan layanan Vaksinasi dengan dukungan tenaga medis profesional dan peralatan modern untuk memastikan Anda mendapatkan penanganan terbaik.', 'services/01KC6HD6JAXE8K648EJ7C8VWAD.png', 1, '2025-12-10 05:05:20', '2025-12-11 04:05:43'),
(4, 'Radiologi', 'radiologi', 'penunjang', 'Deskripsi lengkap untuk layanan Radiologi akan segera tersedia. Kami menyediakan layanan Radiologi dengan dukungan tenaga medis profesional dan peralatan modern untuk memastikan Anda mendapatkan penanganan terbaik.', 'services/01KC6HRMBZ95HAKQQ2E29P8PR5.png', 1, '2025-12-10 05:05:20', '2025-12-11 04:11:58'),
(8, 'Konsultasi Gigi', 'konsultasi-gigi', 'rawat_jalan', 'Deskripsi lengkap untuk layanan Konsultasi Gigi akan segera tersedia. Kami menyediakan layanan Konsultasi Gigi dengan dukungan tenaga medis profesional dan peralatan modern untuk memastikan Anda mendapatkan penanganan terbaik.', 'services/01KC6HM6ZHTBM98P24GYAACZK0.png', 1, '2025-12-11 02:09:33', '2025-12-11 04:09:33'),
(9, 'Test Laboratorium', 'test-laboratorium', 'rawat_jalan', 'Deskripsi lengkap untuk layanan Test Laboratorium akan segera tersedia. Kami menyediakan layanan Test Laboratorium dengan dukungan tenaga medis profesional dan peralatan modern untuk memastikan Anda mendapatkan penanganan terbaik.', 'services/01KC6JESTQWQRJWV5DTY2CYX2R.png', 1, '2025-12-11 02:09:33', '2025-12-11 04:24:04'),
(11, 'Fisioterapi', 'fisioterapi', 'rawat_jalan', 'Ini adalah layanan terapi bagi penderita sakit fisik', 'services/01KC6GNSN1HR4VDK7AJ4769RRZ.png', 1, '2025-12-11 03:52:56', '2025-12-11 03:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specializations`
--

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

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@gmail.com', NULL, '$2y$12$.xgDWjRypGJ65R8JykKf7OFjgKBjxp2OG9jx75/W9pisq2l0ySs/K', NULL, '2025-12-10 04:39:47', '2025-12-10 04:39:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_status_index` (`status`),
  ADD KEY `articles_published_at_index` (`published_at`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_specialization_id_index` (`specialization_id`),
  ADD KEY `doctors_is_active_index` (`is_active`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedules_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_category_index` (`category`),
  ADD KEY `services_slug_index` (`slug`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specializations_name_index` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `specializations`
--
ALTER TABLE `specializations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_specialization_id_foreign` FOREIGN KEY (`specialization_id`) REFERENCES `specializations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
