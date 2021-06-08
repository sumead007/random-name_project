-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2021 at 01:42 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `random_name`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `tel`, `username`) VALUES
(41, 'ธนพล ปิ้นบัววัน', '0874569231', 'sumead089'),
(44, 'สุเมธ ดวงมาลัย', '0943820909', 'sumead084'),
(45, 'นันทนน ศรีทนนาง', '0943820901', 'nattawut001');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_31_152712_create_customers_table', 1),
(5, '2021_06_01_045831_create_randoms_table', 2),
(6, '2021_06_01_045949_create_random_details_table', 2),
(7, '2021_06_07_085252_edit_colum_table_random_detail', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `randoms`
--

CREATE TABLE `randoms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `random_details`
--

CREATE TABLE `random_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cus_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cus_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cus_username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `random_details`
--

INSERT INTO `random_details` (`id`, `cus_id`, `created_at`, `updated_at`, `cus_name`, `cus_username`, `tel`) VALUES
(522, '44', '2021-06-07 02:07:49', NULL, 'สุเมธ ดวงมาลัย', 'sumead084', '0943820909'),
(523, '46', '2021-06-07 02:07:49', NULL, 'วงวะสั้น ดวงเกตุ', 'wongwason003', '0943820900'),
(524, '41', '2021-06-07 02:07:49', NULL, 'ธนพล ปิ้นบัววัน', 'sumead089', '0874569231'),
(525, '45', '2021-06-07 02:37:31', NULL, 'นันทนน ศรีทนนาง', 'nattawut001', '0943820901'),
(526, '41', '2021-06-07 02:37:31', NULL, 'ธนพล ปิ้นบัววัน', 'sumead089', '0874569231'),
(527, '46', '2021-06-07 02:37:31', NULL, 'วงวะสั้น ดวงเกตุ', 'wongwason003', '0943820900'),
(528, '44', '2021-06-07 02:37:31', NULL, 'สุเมธ ดวงมาลัย', 'sumead084', '0943820909'),
(529, '47', '2021-06-07 02:37:31', NULL, 'วัทนัย ชัยอยุท', 'wattanai001', '0878423215'),
(530, '44', '2021-06-07 02:44:02', NULL, 'สุเมธ ดวงมาลัย', 'sumead084', '0943820909'),
(531, '46', '2021-06-07 02:44:02', NULL, 'วงวะสั้น ดวงเกตุ', 'wongwason003', '0943820900'),
(532, '47', '2021-06-07 02:44:02', NULL, 'วัทนัย ชัยอยุท', 'wattanai001', '0878423215'),
(533, '45', '2021-06-07 02:44:02', NULL, 'นันทนน ศรีทนนาง', 'nattawut001', '0943820901'),
(534, '41', '2021-06-07 02:44:02', NULL, 'ธนพล ปิ้นบัววัน', 'sumead089', '0874569231'),
(535, '45', '2021-06-07 02:50:56', NULL, 'นันทนน ศรีทนนาง', 'nattawut001', '0943820901'),
(536, '41', '2021-06-07 02:50:56', NULL, 'ธนพล ปิ้นบัววัน', 'sumead089', '0874569231'),
(537, '44', '2021-06-07 02:50:56', NULL, 'สุเมธ ดวงมาลัย', 'sumead084', '0943820909'),
(538, '41', '2021-06-07 02:51:20', NULL, 'ธนพล ปิ้นบัววัน', 'sumead089', '0874569231'),
(539, '41', '2021-06-07 02:51:28', NULL, 'ธนพล ปิ้นบัววัน', 'sumead089', '0874569231'),
(540, '44', '2021-06-07 02:51:33', NULL, 'สุเมธ ดวงมาลัย', 'sumead084', '0943820909');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `remember_token`) VALUES
(1, 'sumead007', '$2y$10$p8ZdTdcUp8EALQJ4bKXHuOeGmzWNvuMEJDsH8GEFtC/5ADTisYzEO', 'สุเมธ ดวงมาลัย', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `randoms`
--
ALTER TABLE `randoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `random_details`
--
ALTER TABLE `random_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `randoms`
--
ALTER TABLE `randoms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `random_details`
--
ALTER TABLE `random_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=541;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
