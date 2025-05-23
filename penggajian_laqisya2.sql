-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2025 at 01:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penggajian_laqisya2`
--

-- --------------------------------------------------------

--
-- Table structure for table `averages`
--

CREATE TABLE `averages` (
  `id` int(11) NOT NULL,
  `ptkp_status` varchar(10) NOT NULL,
  `bruto_min` decimal(15,2) NOT NULL,
  `bruto_max` decimal(15,2) NOT NULL,
  `tarik_pct` decimal(5,2) NOT NULL,
  `golongan` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `averages`
--

INSERT INTO `averages` (`id`, `ptkp_status`, `bruto_min`, `bruto_max`, `tarik_pct`, `golongan`, `created_at`, `updated_at`) VALUES
(1, 'TK-2', 6000000.00, 6500000.00, 2.50, 'A', '2025-05-22 15:31:08', '2025-05-22 15:31:13'),
(2, 'TK/0', 6200000.00, 6500000.00, 0.25, 'A', '2025-05-22 08:30:04', '2025-05-22 08:30:04'),
(3, 'TK/1', 6200000.00, 6500000.00, 0.25, 'A', '2025-05-22 08:30:28', '2025-05-22 08:30:28'),
(4, 'K/0', 0.00, 5400000.00, 0.00, 'A', '2025-05-22 08:40:27', '2025-05-22 08:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_accounts`
--

CREATE TABLE `chart_of_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_akun` varchar(255) NOT NULL,
  `nama_akun` varchar(255) NOT NULL,
  `tipe_akun` enum('Aset','Kewajiban','Ekuitas','Pendapatan','Beban') NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chart_of_accounts`
--

INSERT INTO `chart_of_accounts` (`id`, `kode_akun`, `nama_akun`, `tipe_akun`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, '1001', 'Kas', 'Aset', 'Uang tunai di tangan', '2025-05-20 03:56:42', '2025-05-20 03:56:42'),
(2, '2001', 'Hutang Usaha', 'Kewajiban', 'Utang kepada pemasok', '2025-05-20 03:56:42', '2025-05-20 03:56:42'),
(3, '4001', 'Pendapatan Jasa', 'Pendapatan', 'Pendapatan dari penjualan jasa', '2025-05-20 03:56:42', '2025-05-20 03:56:42'),
(4, '5001', 'Beban Gaji', 'Beban', 'Pengeluaran untuk gaji pegawai', '2025-05-20 03:56:42', '2025-05-20 03:56:42'),
(5, '21111', 'Hutang', 'Ekuitas', 'e21321 eqw', '2025-05-20 04:07:55', '2025-05-20 04:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `posisi` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `id_number`, `name`, `posisi`, `alamat`, `jenis_kelamin`, `no_telp`, `created_at`, `updated_at`) VALUES
(1, 'NIP-001', 'Ikhsan', 'Chef', 'Jl. Sukapura', 'Laki-Laki', '081904050707', '2025-05-20 03:31:33', '2025-05-20 03:31:33'),
(2, 'NIP-002', 'Rama', 'Chef', 'Jl. Sukapura', 'Laki-Laki', '081904050709', '2025-05-22 07:47:00', '2025-05-22 07:47:00');

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
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `basic_salary` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `id_number`, `nama_pegawai`, `basic_salary`, `created_at`, `updated_at`) VALUES
(6, 'NIP-001', 'Ikhsan', 100000.00, '2025-05-20 03:31:46', '2025-05-20 03:31:46'),
(7, 'NIP-002', 'Rama', 500000.00, '2025-05-22 09:18:32', '2025-05-22 09:18:32');

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
(5, '2021_09_06_115952_create_groups_table', 1),
(6, '2021_09_08_083613_create_positions_table', 1),
(7, '2021_09_08_112415_create_employees_table', 1),
(8, '2024_12_23_091159_create_presensis_table', 1),
(9, '2024_12_23_091306_create_pembayaran_gajis_table', 1),
(10, '2025_01_14_154822_add_role_to_users_table', 2),
(11, '2025_05_20_105534_create_chart_of_accounts_table', 3);

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
-- Table structure for table `pembayaran_gajis`
--

CREATE TABLE `pembayaran_gajis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` int(10) UNSIGNED NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `jumlah_gaji` int(10) NOT NULL,
  `jumlah_hadir` int(10) NOT NULL,
  `potongan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bonus` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('paid','unpaid') DEFAULT 'unpaid',
  `grand_total` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran_gajis`
--

INSERT INTO `pembayaran_gajis` (`id`, `id_pegawai`, `nama_pegawai`, `jumlah_gaji`, `jumlah_hadir`, `potongan`, `bonus`, `total`, `created_at`, `updated_at`, `status`, `grand_total`) VALUES
(14, 6, 'Ikhsan', 10000000, 10, 90000.00, 1000000.00, '10910000', '2025-04-23 03:32:15', '2025-04-23 03:35:03', 'paid', 10882725),
(15, 6, 'Ikhsan', 1000000, 0, 1200.00, 1900000.00, '1898800', '2025-04-25 07:10:34', '2025-04-24 03:35:10', 'paid', 1894053),
(19, 7, 'Rama', 10000000, 2, 700000.00, 500000.00, '9800000', '2025-05-22 09:18:55', '2025-05-22 09:34:37', 'paid', 9775500),
(21, 7, 'Rama', 50000000, 10, 100000.00, 100000.00, '50000000', '2025-05-22 09:35:57', '2025-05-22 09:36:09', 'paid', 49875000),
(22, 7, 'Rama', 50000000, 10, 0.00, 1000000.00, '51000000', '2025-05-22 09:41:34', '2025-05-23 03:15:53', 'paid', 49725000),
(23, 7, 'Rama', 100000000, 20, 10000000.00, 7000000.00, '97000000', '2025-05-22 09:56:01', '2025-05-23 03:15:45', 'paid', 94575000),
(24, 7, 'Rama', 10000000, 20, 1000000.00, 500000.00, '9500000', '2025-05-23 03:23:12', '2025-05-23 03:23:12', 'unpaid', NULL);

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
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grade` varchar(255) NOT NULL,
  `positional_allowance` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `presensis`
--

CREATE TABLE `presensis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(10) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `presensis`
--

INSERT INTO `presensis` (`id`, `id_pegawai`, `status`, `tanggal`, `created_at`, `updated_at`, `id_number`) VALUES
(48, 1, 'Hadir', '2025-05-22 00:00:00', '2025-05-22 02:37:48', '2025-05-22 02:37:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `created_at`, `updated_at`, `role`) VALUES
(1, 'ADMIN', 'adm', 'adm@mail.com', '$2y$10$qHhrCqDVxEnxb6D7Hhpt9.w6/0MPk2cW0DOA7NQaCy/Ky5DgITw7m', '2025-05-20 03:27:32', '2025-05-20 03:27:32', 1),
(2, 'Ikhsan', 'Ikhsan', 'ik@mail.com', '$2y$10$/BUzT.iBluxZYMWstaHxP.7m45pCP0n/v8yHDOFDjOGUnr6W7nCly', '2025-05-22 02:37:38', '2025-05-22 02:37:38', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `averages`
--
ALTER TABLE `averages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chart_of_accounts_kode_akun_unique` (`kode_akun`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_id_number_unique` (`id_number`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `groups_id_number_unique` (`id_number`),
  ADD UNIQUE KEY `unique_id_number` (`id_number`);

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
-- Indexes for table `pembayaran_gajis`
--
ALTER TABLE `pembayaran_gajis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pembayaran_id_pegawai` (`id_pegawai`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `positions_grade_unique` (`grade`);

--
-- Indexes for table `presensis`
--
ALTER TABLE `presensis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_id_pegawai` (`id_pegawai`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `averages`
--
ALTER TABLE `averages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pembayaran_gajis`
--
ALTER TABLE `pembayaran_gajis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presensis`
--
ALTER TABLE `presensis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `presensis`
--
ALTER TABLE `presensis`
  ADD CONSTRAINT `fk_presensi_user` FOREIGN KEY (`id_pegawai`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
