-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2023 at 03:05 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` bigint(20) UNSIGNED NOT NULL,
  `car_name` varchar(500) NOT NULL,
  `slug` text NOT NULL,
  `description` text DEFAULT NULL,
  `image` text NOT NULL,
  `car_type` tinyint(3) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `is_sold` tinyint(1) NOT NULL DEFAULT 0,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `car_name`, `slug`, `description`, `image`, `car_type`, `price`, `expiry_date`, `is_sold`, `category_id`, `brand_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Honda BR-V', 'honda-br-v', 'test', 'Honda-BR-V-front-three-quarters-VX-Diesel-Review.jpg', 1, 500, '2023-04-17', 0, 4, 2, 2, '2023-03-20 12:48:47', '2023-04-01 13:46:52'),
(3, 'Honda CH-R', 'honda-ch-r', 'test', 'cmj1nbdpfbgd8xppmmfw.jpg', 1, 10000, '2023-04-26', 0, 7, 2, 2, '2023-03-20 13:01:30', '2023-04-01 13:47:14'),
(4, 'Toyota Vitz', 'toyota-vitz', 'Test', '1F09978F-50F4-42E0-BBEB-FAC28C029572.jpeg.5fc1c60a494d6a987613cf68eb51c18f.jpeg', 0, 100, '2023-04-27', 0, 5, 1, 2, '2023-03-26 06:49:29', '2023-04-01 13:47:29'),
(5, 'Suzuki Cultus', 'suzuki-cultus', 'Test', 'Suzuki-Cultus-2017.jpg', 0, 1500, '2023-04-01', 1, 5, 3, 3, '2023-03-27 16:19:28', '2023-03-27 16:19:28'),
(6, 'Honda vezel', 'honda-vezel', 'Test', '1681053354504.jpg', 1, 2000, '2023-04-08', 1, 7, 2, 5, '2023-04-09 10:15:54', '2023-04-09 11:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `car_bids`
--

CREATE TABLE `car_bids` (
  `bid_id` bigint(20) UNSIGNED NOT NULL,
  `bid_amount` bigint(20) UNSIGNED NOT NULL,
  `is_winner` tinyint(1) NOT NULL DEFAULT 0,
  `is_rejected` tinyint(1) NOT NULL DEFAULT 0,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `paid_at` timestamp NULL DEFAULT NULL,
  `car_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_bids`
--

INSERT INTO `car_bids` (`bid_id`, `bid_amount`, `is_winner`, `is_rejected`, `is_paid`, `paid_at`, `car_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2300, 0, 0, 0, NULL, 5, 2, '2023-03-30 13:48:25', '2023-04-01 15:34:56'),
(2, 2000, 0, 0, 0, NULL, 5, 4, '2023-03-30 13:59:14', '2023-03-30 13:59:14'),
(3, 2400, 1, 0, 1, '2023-04-07 11:12:30', 5, 5, '2023-03-31 02:05:59', '2023-04-07 11:12:30'),
(4, 400, 0, 0, 0, NULL, 4, 5, '2023-04-08 14:05:34', '2023-04-08 14:05:34'),
(5, 800, 0, 0, 0, NULL, 1, 5, '2023-04-08 14:05:51', '2023-04-08 14:05:51'),
(6, 10200, 1, 0, 0, NULL, 3, 5, '2023-04-08 14:06:11', '2023-04-08 14:06:11'),
(9, 2200, 1, 0, 1, '2023-04-09 11:04:49', 6, 3, '2023-04-09 10:26:49', '2023-04-09 11:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `car_brands`
--

CREATE TABLE `car_brands` (
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(500) NOT NULL,
  `slug` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_brands`
--

INSERT INTO `car_brands` (`brand_id`, `brand_name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Honda', 'honda', '2023-04-16 16:44:10', '2023-04-16 16:44:10'),
(2, 'Toyota', 'toyota', '2023-04-16 16:44:21', '2023-04-16 16:44:21'),
(3, 'Suzuki', 'suzuki', '2023-04-16 16:44:25', '2023-04-16 16:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `car_categories`
--

CREATE TABLE `car_categories` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(500) NOT NULL,
  `slug` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_categories`
--

INSERT INTO `car_categories` (`category_id`, `category_name`, `slug`, `created_at`, `updated_at`) VALUES
(4, 'Sedan', 'sedan', '2023-03-20 04:32:50', '2023-03-20 04:32:50'),
(5, 'Hatchback', 'hatchback', '2023-03-20 04:32:59', '2023-03-20 04:32:59'),
(6, 'SUV', 'suv', '2023-03-20 04:33:55', '2023-03-20 04:33:55'),
(7, 'Crossover', 'crossover', '2023-03-20 04:37:19', '2023-03-20 04:37:19');

-- --------------------------------------------------------

--
-- Table structure for table `car_comments`
--

CREATE TABLE `car_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `comment` text NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `car_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_comments`
--

INSERT INTO `car_comments` (`id`, `name`, `email`, `comment`, `user_id`, `car_id`, `created_at`, `updated_at`) VALUES
(1, 'Test Guest', 'Test@guest.com', 'Test Comment', NULL, 3, '2023-04-18 18:28:26', '2023-04-18 18:28:26'),
(2, NULL, NULL, 'Test user', 2, 3, '2023-04-18 18:33:20', '2023-04-18 18:33:20'),
(3, 'Test2@guset.com', NULL, 'Test from guset 2', NULL, 3, '2023-04-18 14:52:54', '2023-04-18 14:52:54');

-- --------------------------------------------------------

--
-- Table structure for table `car_galleries`
--

CREATE TABLE `car_galleries` (
  `car_gallery_id` bigint(20) UNSIGNED NOT NULL,
  `image` text NOT NULL,
  `car_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_galleries`
--

INSERT INTO `car_galleries` (`car_gallery_id`, `image`, `car_id`, `created_at`, `updated_at`) VALUES
(5, '1679335290586.jpg', 3, '2023-03-20 13:01:30', '2023-03-20 13:01:30'),
(6, '1679335290452.jpg', 3, '2023-03-20 13:01:30', '2023-03-20 13:01:30'),
(7, '1679831069471.png', 3, '2023-03-26 06:44:29', '2023-03-26 06:44:29'),
(8, '1679831245212.png', 1, '2023-03-26 06:47:25', '2023-03-26 06:47:25'),
(9, '1679831245168.jpg', 1, '2023-03-26 06:47:25', '2023-03-26 06:47:25'),
(10, '1679831369343.jpg', 4, '2023-03-26 06:49:29', '2023-03-26 06:49:29'),
(11, '1679831369234.jpg', 4, '2023-03-26 06:49:29', '2023-03-26 06:49:29'),
(12, '1679831369601.jpg', 4, '2023-03-26 06:49:29', '2023-03-26 06:49:29'),
(13, '1679831369482.jpg', 4, '2023-03-26 06:49:29', '2023-03-26 06:49:29'),
(14, '1679951968125.jpg', 5, '2023-03-27 16:19:28', '2023-03-27 16:19:28'),
(15, '1679951968689.jpg', 5, '2023-03-27 16:19:28', '2023-03-27 16:19:28'),
(16, '1679951968531.jpg', 5, '2023-03-27 16:19:28', '2023-03-27 16:19:28'),
(17, '1679951968576.jpg', 5, '2023-03-27 16:19:28', '2023-03-27 16:19:28'),
(18, '1679951968473.jpg', 5, '2023-03-27 16:19:28', '2023-03-27 16:19:28');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_09_24_104104_create_forms_table', 1),
(6, '2023_03_16_174125_create_cars_table', 2),
(7, '2023_03_16_175635_create_car_galleries', 3),
(8, '2023_03_16_181122_create_car_categories', 4),
(10, '2023_03_20_102618_create_car_brands', 5),
(11, '2023_04_16_213711_create_user_registration_payments_table', 6),
(12, '2023_04_18_180500_create_car_comments_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_initial_paid` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role`, `is_active`, `is_initial_paid`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@auction.com', '2023-03-15 00:41:03', 'Admin', 1, 1, '$2y$10$tqBU0qDBo5oFtgICOTJrUeK8BYvNnWI37NZlTx6U0T8BJUelovRvO', 'fBv1An2R4Jjt3EWEK9ETafUv7oAYpMyO07sNEI9PcdbMdO6OUhnPkSRWukkv', '2023-03-15 00:41:04', '2023-03-15 00:41:04'),
(2, 'Kirk Luettgen', 'user@auction.com', '2023-03-15 00:51:35', 'User', 1, 0, '$2y$10$tqBU0qDBo5oFtgICOTJrUeK8BYvNnWI37NZlTx6U0T8BJUelovRvO', 'P4Vcm4AaAS9QHnVJEMcxnkG9wSIHFj9GX9mHJJQFpiTY8zSh7QFJJTUVgJ6N', '2023-03-15 00:51:36', '2023-04-16 14:42:28'),
(3, 'user2', 'user2@auction.com', NULL, 'User', 1, 0, '$2y$10$nQPqbMXl.sPoX0PSkQHOdeGva1OpFsAC2oImkX8Tez9nrVStMgA5e', NULL, '2023-03-27 16:16:53', '2023-04-16 14:22:37'),
(4, 'user3', 'user3@auction.com', NULL, 'User', 1, 0, '$2y$10$.voKCb0vk8fDItZhk4/0JesDgbryzAd7todNc8TKQg9/J8aHkbtBO', NULL, '2023-03-30 13:58:28', '2023-03-30 13:58:28'),
(5, 'user4', 'user4@auction.com', NULL, 'User', 1, 0, '$2y$10$PhXvJxhsIoiJWdtAUw1o0ufoM1qic.C9/9HVMnrD25hlSVcILAKpe', NULL, '2023-03-31 01:58:28', '2023-03-31 01:58:28'),
(6, 'user5', 'user5@auction.com', NULL, 'User', 1, 0, '$2y$10$sai20CcPiPXdpkEDJbyKOu4YSjgS74X878d194Sby9cLxQvLNAZpq', NULL, '2023-04-16 14:42:15', '2023-04-16 14:42:15'),
(7, 'user6', 'user6@auction.com', NULL, 'User', 1, 1, '$2y$10$H/d9MByaN.3EYSw9h1E7H.iKdEU4KM/MSELJvm1c1udzeD3IJ2RL.', NULL, '2023-04-16 17:15:28', '2023-04-17 12:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `user_registration_amounts`
--

CREATE TABLE `user_registration_amounts` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_registration_amounts`
--

INSERT INTO `user_registration_amounts` (`id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 500, '2023-04-16 20:08:18', '2023-04-16 15:42:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_registration_payments`
--

CREATE TABLE `user_registration_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_registration_payments`
--

INSERT INTO `user_registration_payments` (`id`, `user_id`, `paid_amount`, `created_at`, `updated_at`) VALUES
(1, 7, '500.00', '2023-04-16 17:15:30', '2023-04-16 17:15:30'),
(2, 7, '500.00', '2023-04-17 12:04:03', '2023-04-17 12:04:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `car_bids`
--
ALTER TABLE `car_bids`
  ADD PRIMARY KEY (`bid_id`);

--
-- Indexes for table `car_brands`
--
ALTER TABLE `car_brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `car_categories`
--
ALTER TABLE `car_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `car_comments`
--
ALTER TABLE `car_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_comments_user_id_foreign` (`user_id`),
  ADD KEY `car_comments_car_id_foreign` (`car_id`);

--
-- Indexes for table `car_galleries`
--
ALTER TABLE `car_galleries`
  ADD PRIMARY KEY (`car_gallery_id`),
  ADD KEY `car_galleries_car_id_foreign` (`car_id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_registration_amounts`
--
ALTER TABLE `user_registration_amounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_registration_payments`
--
ALTER TABLE `user_registration_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_registration_payments_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `car_bids`
--
ALTER TABLE `car_bids`
  MODIFY `bid_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `car_brands`
--
ALTER TABLE `car_brands`
  MODIFY `brand_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `car_categories`
--
ALTER TABLE `car_categories`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `car_comments`
--
ALTER TABLE `car_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `car_galleries`
--
ALTER TABLE `car_galleries`
  MODIFY `car_gallery_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_registration_amounts`
--
ALTER TABLE `user_registration_amounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_registration_payments`
--
ALTER TABLE `user_registration_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car_comments`
--
ALTER TABLE `car_comments`
  ADD CONSTRAINT `car_comments_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `car_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `car_galleries`
--
ALTER TABLE `car_galleries`
  ADD CONSTRAINT `car_galleries_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_registration_payments`
--
ALTER TABLE `user_registration_payments`
  ADD CONSTRAINT `user_registration_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
