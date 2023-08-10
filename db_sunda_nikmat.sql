-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2023 at 01:19 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sunda_nikmat`
--

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
(59, '2014_10_12_000000_create_users_table', 1),
(60, '2014_10_12_100000_create_password_resets_table', 1),
(61, '2019_08_19_000000_create_failed_jobs_table', 1),
(62, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(63, '2023_07_06_093211_create_produk_table', 1),
(64, '2023_07_06_093347_create_produk_masuk_table', 1),
(65, '2023_07_06_093508_create_users_role_table', 1),
(66, '2023_07_10_080831_create_transaksi_table', 1),
(67, '2023_08_08_142516_create_transaksi_detail_table', 1);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `ID_Produk` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nama_Produk` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Stok_Produk` int(11) DEFAULT NULL,
  `Harga_Satuan_Produk` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`ID_Produk`, `Nama_Produk`, `Stok_Produk`, `Harga_Satuan_Produk`, `created_at`, `updated_at`) VALUES
('IP-0001', 'Ayam', 18, 'Rp. 20.000', NULL, NULL),
('IP-0002', 'Jus Jambu', 7, 'Rp. 15.000', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk_masuk`
--

CREATE TABLE `produk_masuk` (
  `ID_Produk_Masuk` bigint(20) UNSIGNED NOT NULL,
  `ID_Produk` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Jumlah_Produk_Masuk` int(11) DEFAULT NULL,
  `Tanggal_Produk_Masuk` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `ID_Transaksi` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tanggal_Transaksi` date DEFAULT NULL,
  `Nama_Customer` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `No_Meja` int(11) DEFAULT NULL,
  `ID_Produk` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `QTY` int(11) DEFAULT NULL,
  `Sub_Total` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PB1` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Biaya_Service` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Total_Pembayaran` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Jenis_Pembayaran` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Metode_Pembayaran` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`ID_Transaksi`, `Tanggal_Transaksi`, `Nama_Customer`, `No_Meja`, `ID_Produk`, `QTY`, `Sub_Total`, `PB1`, `Biaya_Service`, `Total_Pembayaran`, `Jenis_Pembayaran`, `Metode_Pembayaran`, `created_at`, `updated_at`) VALUES
('IT-0001', '2023-08-10', 'Aden', 1, NULL, NULL, NULL, NULL, NULL, 'Rp. 102.850', 'Cash', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `ID_Transaksi_Detail` bigint(20) UNSIGNED NOT NULL,
  `ID_Transaksi` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ID_Produk` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `QTY` int(11) DEFAULT NULL,
  `Sub_Total` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Tarif_Biaya_Service` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Biaya_Service` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DPP` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BP` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Biaya_BP` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Total` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`ID_Transaksi_Detail`, `ID_Transaksi`, `ID_Produk`, `QTY`, `Sub_Total`, `Tarif_Biaya_Service`, `Biaya_Service`, `DPP`, `BP`, `Biaya_BP`, `Total`, `created_at`, `updated_at`) VALUES
(1, 'IT-0001', 'IP-0001', 2, 'Rp. 40.000', '10', 'Rp. 4.000', 'Rp. 44.000', '10', 'Rp. 4.400', 'Rp. 48.400', NULL, NULL),
(2, 'IT-0001', 'IP-0002', 3, 'Rp. 45.000', '10', 'Rp. 4.500', 'Rp. 49.500', '10', 'Rp. 4.950', 'Rp. 54.450', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID_User` int(10) UNSIGNED NOT NULL,
  `Nama_Users` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email_Users` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Password_Users` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ID_User_Roles` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID_User`, `Nama_Users`, `Email_Users`, `Password_Users`, `ID_User_Roles`, `created_at`, `updated_at`) VALUES
(1, 'Admin Restoran SN', 'admin@gmail.com', 'admin', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_role`
--

CREATE TABLE `users_role` (
  `ID_User_Roles` int(10) UNSIGNED NOT NULL,
  `Role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_role`
--

INSERT INTO `users_role` (`ID_User_Roles`, `Role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'SPV Owner Manager', NULL, NULL),
(3, 'Kasir', NULL, NULL);

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`ID_Produk`);

--
-- Indexes for table `produk_masuk`
--
ALTER TABLE `produk_masuk`
  ADD PRIMARY KEY (`ID_Produk_Masuk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`ID_Transaksi`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`ID_Transaksi_Detail`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_User`);

--
-- Indexes for table `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`ID_User_Roles`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk_masuk`
--
ALTER TABLE `produk_masuk`
  MODIFY `ID_Produk_Masuk` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `ID_Transaksi_Detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID_User` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_role`
--
ALTER TABLE `users_role`
  MODIFY `ID_User_Roles` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
