-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 22, 2024 at 12:15 AM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbjemberfnbloker`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `user_id`) VALUES
(1, 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`) VALUES
(1, 'KENCONG'),
(2, 'GUMUKMAS'),
(3, 'PUGER'),
(4, 'WULUHAN'),
(5, 'AMBULU'),
(6, 'TEMPUREJO'),
(7, 'SILO'),
(8, 'MAYANG'),
(9, 'MUMBULSARI'),
(10, 'JENGGAWAH'),
(11, 'AJUNG'),
(12, 'RAMBIPUJI'),
(13, 'BALUNG'),
(14, 'UMBULSARI'),
(15, 'SEMBORO'),
(16, 'JOMBANG'),
(17, 'SUMBERBARU'),
(18, 'TANGGUL'),
(19, 'BANGSALSARI'),
(20, 'PANTI'),
(21, 'SUKORAMBI'),
(22, 'ARJASA'),
(23, 'PAKUSARI'),
(24, 'KALISAT'),
(25, 'LEDOKOMBO'),
(26, 'SUMBERJAMBE'),
(27, 'SUKOWONO'),
(28, 'JELBUK'),
(29, 'KALIWATES'),
(30, 'SUMBERSARI'),
(31, 'PATRANG');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` bigint UNSIGNED NOT NULL,
  `job_seeker_id` bigint UNSIGNED NOT NULL,
  `job_vacancy_id` bigint UNSIGNED NOT NULL,
  `status` enum('process','accepted','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'process',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `confirmed_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `job_seeker_id`, `job_vacancy_id`, `status`, `created_at`, `confirmed_at`) VALUES
(1, 1, 1, 'accepted', '2024-05-21 09:05:44', '2024-05-21 13:20:36'),
(2, 2, 1, 'accepted', '2024-05-21 11:38:26', '2024-05-21 13:27:22'),
(3, 3, 2, 'process', '2024-05-21 12:27:30', NULL),
(4, 3, 1, 'rejected', '2024-05-21 13:55:34', '2024-05-21 13:56:23');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications_files`
--

CREATE TABLE `job_applications_files` (
  `id` bigint UNSIGNED NOT NULL,
  `job_application_id` bigint UNSIGNED NOT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `job_applications_files`
--

INSERT INTO `job_applications_files` (`id`, `job_application_id`, `file`, `created_at`) VALUES
(1, 1, 'uploads/job_applications_files/664c63e8456db5.08365037_213-223.pdf', '2024-05-21 09:05:44'),
(2, 1, 'uploads/job_applications_files/664c63e84599d1.25779192_2-Article Text-18-1-10-20211019.pdf', '2024-05-21 09:05:44'),
(3, 1, 'uploads/job_applications_files/664c63e845b6c4.60960290_178-Article Text-808-1-10-20211101.pdf', '2024-05-21 09:05:44'),
(4, 2, 'uploads/job_applications_files/664c87b2ba46f3.56419568_213-223.pdf', '2024-05-21 11:38:26'),
(5, 2, 'uploads/job_applications_files/664c87b2ba77e0.00848295_template_proposal_pengajuan_alat.pdf', '2024-05-21 11:38:26'),
(6, 2, 'uploads/job_applications_files/664c87b2ba97c7.05896931_ICEEIreserch.pdf', '2024-05-21 11:38:26'),
(7, 3, 'uploads/job_applications_files/664c9332b24cc7.80796222_1-s2.0-S0747563221004544-main (2).pdf', '2024-05-21 12:27:30'),
(8, 3, 'uploads/job_applications_files/664c9332b27575.13209143_A6_SYSTEMATIC REVIEW PAPER.pdf', '2024-05-21 12:27:30'),
(9, 3, 'uploads/job_applications_files/664c9332b295b9.65549853_Critical Factors of Supply Chain Based on Structural Equation Modelling for Industry 4.0.pdf', '2024-05-21 12:27:30'),
(10, 4, 'uploads/job_applications_files/664ca7d655cf74.92581469_664c9332b27575.13209143_A6_SYSTEMATIC REVIEW PAPER.pdf', '2024-05-21 13:55:34'),
(11, 4, 'uploads/job_applications_files/664ca7d655f381.90085519_664c9332b295b9.65549853_Critical Factors of Supply Chain Based on Structural Equation Modelling for Industry 4.0.pdf', '2024-05-21 13:55:34'),
(12, 4, 'uploads/job_applications_files/664ca7d6560c62.37719123_astuti,+679.+Edit+Antonio+Tantra+1909-1917 (1).pdf', '2024-05-21 13:55:34');

-- --------------------------------------------------------

--
-- Table structure for table `job_categories`
--

CREATE TABLE `job_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `job_categories`
--

INSERT INTO `job_categories` (`id`, `name`) VALUES
(1, 'Barista'),
(2, 'Waiter'),
(3, 'Kasir'),
(4, 'Juru Masak'),
(5, 'Cook Helper'),
(6, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `job_creators`
--

CREATE TABLE `job_creators` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `street` varchar(255) NOT NULL,
  `district_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `job_creators`
--

INSERT INTO `job_creators` (`id`, `user_id`, `profile_image`, `name`, `phone`, `lat`, `lng`, `street`, `district_id`, `created_at`) VALUES
(1, 2, 'photo_profile_1.webp', 'Lippo Mall', '082143981626', -8.17383960, 113.68776390, 'Jalan Gajah Mada 68131 Jember Gebang', 29, '2024-05-21 08:06:15');

-- --------------------------------------------------------

--
-- Table structure for table `job_seekers`
--

CREATE TABLE `job_seekers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` enum('L','P') DEFAULT NULL,
  `age` int DEFAULT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `street` varchar(255) NOT NULL,
  `district_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `job_seekers`
--

INSERT INTO `job_seekers` (`id`, `user_id`, `profile_image`, `name`, `phone`, `gender`, `age`, `lat`, `lng`, `street`, `district_id`, `created_at`) VALUES
(1, 3, NULL, 'Valentino Hariyanto', '082143981626', NULL, NULL, -8.17005138, 113.71716633, 'Jalan Jawa nomor 46', 30, '2024-05-21 09:04:05'),
(2, 4, 'photo_profile_2.webp', 'Michie', '082144789956', 'P', 18, -8.16361640, 113.71298990, 'Jalan Kalimantan nomor 15', 30, '2024-05-21 11:28:33'),
(3, 5, NULL, 'Grace Amanda', '082144789956', NULL, NULL, -8.17383960, 113.68776390, 'Jalan Gajah Mada 68131 Jember Gebang', 29, '2024-05-21 12:26:55');

-- --------------------------------------------------------

--
-- Table structure for table `job_vacancy`
--

CREATE TABLE `job_vacancy` (
  `id` bigint UNSIGNED NOT NULL,
  `job_creator_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `requirement` text NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `job_time` enum('Full Time','Part Time') NOT NULL,
  `job_category_id` bigint UNSIGNED NOT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `workplace` enum('WFO','WFH','Hybrid') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `job_vacancy`
--

INSERT INTO `job_vacancy` (`id`, `job_creator_id`, `title`, `requirement`, `photo`, `job_time`, `job_category_id`, `status`, `created_at`, `workplace`) VALUES
(1, 1, 'Dcost Jember lagi cari kasir nih!', '- Cantik\r\n- Mapan\r\n- Bisa membelah laut\r\n- Pengalaman kerja 1000 tahun\r\n- Bisa hidup tanpa makan\r\n- Member JKT48', 'photo_jobvacancy_1.webp', 'Full Time', 3, 'inactive', '2024-05-21 08:07:39', 'WFO'),
(2, 1, 'KFC Lippo Jember mencari kasir', 'Bekerja di KFC Lippo Jember memiliki banyak benefit,\r\n\r\n\r\nBerikut adalah syarat pelamar :\r\n- Minimal pendidikan: SMA\r\n- Makan\r\n- Minum', 'photo_jobvacancy_2.webp', 'Full Time', 3, 'inactive', '2024-05-21 12:25:31', 'WFO');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'JobSeeker'),
(3, 'JobCreator');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'active',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role_id`, `created_at`, `status`, `updated_at`) VALUES
(1, 'admin@JemberFnBLoker', '$2y$10$OuMYmZcf7.WwCAJ5An2Vs.miFR8zNWacp/OD7rcAy3r.2DJwNsTa2', 'aa', 1, '2024-05-13 09:40:23', 'active', NULL),
(2, 'lippo123', '$2y$10$nCKpZh1kUSfFWdR5urTQxOTX8n4JQ/LeBmBl8EEndQF0SwLzpSSOq', 'hariyantovalentino@gmail.com', 3, '2024-05-21 08:06:15', 'inactive', '2024-05-21 21:45:46'),
(3, 'vlnt', '$2y$10$GpEGtPK3MS63zS36Em5CQesigNd4WRpZ/R/y8CkyUYRp7CN079cIK', '222410101023@gmail.com', 2, '2024-05-21 09:04:05', 'inactive', '2024-05-21 22:05:01'),
(4, 'michie', '$2y$10$fm.c0DA4mrM1UwLmewaarOOehAjP8NNlCCXVnD04Ar/jLK7MMwxn2', 'michie@gmail.com', 2, '2024-05-21 11:28:33', 'inactive', '2024-05-21 22:12:00'),
(5, 'graceamnd', '$2y$10$BpOW.R/0UsI9CNGeak0UT.4F.yPwq5UEsSp3LhxdAQxxrP4h8gIJS', 'graceamnd@gmail.com', 2, '2024-05-21 12:26:55', 'active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `user_id`, `token`, `expires_at`, `created_at`) VALUES
(1, 2, 'ac6d23f8aec2330f8c6734e618fd9ec885cf376f74f4d710179fb9b57f6c0d2f', '2024-05-22 01:55:59', '2024-05-21 15:06:25'),
(2, 3, '4d5308bcb9f4dc45287687b1f07f69737af7dc9fa51b10aefb67a49d3c911be8', '2024-05-22 01:55:33', '2024-05-21 16:05:27'),
(3, 4, '14c46ec267c39b8dfba14054a82356db0375a105db45885f92b343ad41fbeaf3', '2024-05-21 21:33:25', '2024-05-21 18:28:44'),
(4, 5, '566d0c9996100aa1897037faa776181902f2cb7199d9ea1af3fd08eecba60154', '2024-05-21 23:11:29', '2024-05-21 19:26:59'),
(5, 1, '8c84e371662864004500021e48070c92ebd685b48436131ba1b4e7a71c2d2f8a', '2024-05-22 06:10:04', '2024-05-21 22:50:39');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_logs`
--

CREATE TABLE `visitor_logs` (
  `id` bigint NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `visitor_logs`
--

INSERT INTO `visitor_logs` (`id`, `ip_address`, `timestamp`) VALUES
(1, '110.136.125.25', '2024-05-21 08:04:26'),
(2, '110.136.125.25', '2024-05-21 08:08:45'),
(3, '110.136.125.25', '2024-05-21 08:09:35'),
(4, '110.136.125.25', '2024-05-21 08:11:16'),
(5, '110.136.125.25', '2024-05-21 08:20:20'),
(6, '110.136.125.25', '2024-05-21 08:25:08'),
(7, '10.132.0.65', '2024-05-21 08:30:01'),
(8, '110.136.125.25', '2024-05-21 08:54:40'),
(9, '110.136.125.25', '2024-05-21 09:05:27'),
(10, '110.136.125.25', '2024-05-21 09:07:42'),
(11, '110.136.125.25', '2024-05-21 09:07:46'),
(12, '110.136.125.25', '2024-05-21 09:07:47'),
(13, '110.136.125.25', '2024-05-21 09:07:47'),
(14, '110.136.125.25', '2024-05-21 09:10:49'),
(15, '110.136.125.25', '2024-05-21 09:10:51'),
(16, '110.136.125.25', '2024-05-21 09:10:56'),
(17, '110.136.125.25', '2024-05-21 09:11:06'),
(18, '110.136.125.25', '2024-05-21 09:11:10'),
(19, '110.136.125.25', '2024-05-21 09:11:35'),
(20, '110.136.125.25', '2024-05-21 09:11:38'),
(21, '110.136.125.25', '2024-05-21 09:11:41'),
(22, '110.136.125.25', '2024-05-21 09:14:33'),
(23, '110.136.125.25', '2024-05-21 09:14:38'),
(24, '110.136.125.25', '2024-05-21 09:14:45'),
(25, '110.136.125.25', '2024-05-21 09:15:05'),
(26, '110.136.125.25', '2024-05-21 09:15:13'),
(27, '110.136.125.25', '2024-05-21 09:16:07'),
(28, '110.136.125.25', '2024-05-21 09:16:13'),
(29, '110.136.125.25', '2024-05-21 09:16:18'),
(30, '110.136.125.25', '2024-05-21 09:18:04'),
(31, '110.136.125.25', '2024-05-21 09:18:28'),
(32, '110.136.125.25', '2024-05-21 09:18:33'),
(33, '110.136.125.25', '2024-05-21 09:18:40'),
(34, '110.136.125.25', '2024-05-21 09:18:44'),
(35, '110.136.125.25', '2024-05-21 10:20:13'),
(36, '110.136.125.25', '2024-05-21 10:32:45'),
(37, '110.136.125.25', '2024-05-21 11:27:08'),
(38, '110.136.125.25', '2024-05-21 11:28:44'),
(39, '110.136.125.25', '2024-05-21 11:37:47'),
(40, '110.136.125.25', '2024-05-21 11:38:41'),
(41, '110.136.125.25', '2024-05-21 12:21:28'),
(42, '110.136.125.25', '2024-05-21 12:23:02'),
(43, '110.136.125.25', '2024-05-21 12:26:59'),
(44, '110.136.125.25', '2024-05-21 12:40:32'),
(45, '110.136.125.25', '2024-05-21 12:40:57'),
(46, '110.136.125.25', '2024-05-21 12:53:48'),
(47, '110.136.125.25', '2024-05-21 13:26:00'),
(48, '110.136.125.25', '2024-05-21 13:33:10'),
(49, '110.136.125.25', '2024-05-21 13:33:15'),
(50, '110.136.125.25', '2024-05-21 13:33:25'),
(51, '110.136.125.25', '2024-05-21 13:39:08'),
(52, '110.136.125.25', '2024-05-21 13:54:36'),
(53, '110.136.125.25', '2024-05-21 15:11:29'),
(54, '110.136.125.25', '2024-05-21 15:48:35'),
(55, '110.136.125.25', '2024-05-21 16:37:19'),
(56, '110.136.125.25', '2024-05-21 16:43:19'),
(57, '110.136.125.25', '2024-05-21 17:14:35'),
(58, '110.136.125.25', '2024-05-21 17:17:33'),
(59, '110.136.125.25', '2024-05-21 17:28:58'),
(60, '110.136.125.25', '2024-05-21 17:55:33'),
(61, '110.136.125.25', '2024-05-21 17:55:50'),
(62, '110.136.125.25', '2024-05-21 18:45:10'),
(63, '110.136.125.25', '2024-05-21 19:32:54'),
(64, '110.136.125.25', '2024-05-21 21:14:12'),
(65, '110.136.125.25', '2024-05-21 21:53:02'),
(66, '110.136.125.25', '2024-05-21 22:08:54'),
(67, '110.136.125.25', '2024-05-21 22:09:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_admin_user_id` (`user_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_job_vacancy_id` (`job_vacancy_id`),
  ADD KEY `fk_job_seeker_id` (`job_seeker_id`);

--
-- Indexes for table `job_applications_files`
--
ALTER TABLE `job_applications_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_job_applications_files_job_application_id` (`job_application_id`);

--
-- Indexes for table `job_categories`
--
ALTER TABLE `job_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_creators`
--
ALTER TABLE `job_creators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_job_creators_district_id` (`district_id`),
  ADD KEY `fk_job_creators_user_id` (`user_id`);

--
-- Indexes for table `job_seekers`
--
ALTER TABLE `job_seekers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_job_seekers_user_id` (`user_id`),
  ADD KEY `fk_job_seekers_district_id` (`district_id`);

--
-- Indexes for table `job_vacancy`
--
ALTER TABLE `job_vacancy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_job_vacancy_job_creators_id` (`job_creator_id`),
  ADD KEY `fk_job_vacancy_job_categories_id` (`job_category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD KEY `fk_users_roles_id` (`role_id`);

--
-- Indexes for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_tokens_users_id` (`user_id`);

--
-- Indexes for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job_applications_files`
--
ALTER TABLE `job_applications_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `job_categories`
--
ALTER TABLE `job_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `job_creators`
--
ALTER TABLE `job_creators`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_seekers`
--
ALTER TABLE `job_seekers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_vacancy`
--
ALTER TABLE `job_vacancy`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `fk_job_seeker_id` FOREIGN KEY (`job_seeker_id`) REFERENCES `job_seekers` (`id`),
  ADD CONSTRAINT `fk_job_vacancy_id` FOREIGN KEY (`job_vacancy_id`) REFERENCES `job_vacancy` (`id`);

--
-- Constraints for table `job_applications_files`
--
ALTER TABLE `job_applications_files`
  ADD CONSTRAINT `fk_job_applications_files_job_application_id` FOREIGN KEY (`job_application_id`) REFERENCES `job_applications` (`id`);

--
-- Constraints for table `job_creators`
--
ALTER TABLE `job_creators`
  ADD CONSTRAINT `fk_district_id` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`),
  ADD CONSTRAINT `fk_job_creators_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `job_seekers`
--
ALTER TABLE `job_seekers`
  ADD CONSTRAINT `fk_job_seekers_district_id` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`),
  ADD CONSTRAINT `fk_job_seekers_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `job_vacancy`
--
ALTER TABLE `job_vacancy`
  ADD CONSTRAINT `fk_job_vacancy_job_categories_id` FOREIGN KEY (`job_category_id`) REFERENCES `job_categories` (`id`),
  ADD CONSTRAINT `fk_job_vacancy_job_creators_id` FOREIGN KEY (`job_creator_id`) REFERENCES `job_creators` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_roles_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `fk_user_tokens_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
