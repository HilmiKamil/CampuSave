-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Waktu pembuatan: 21 Jun 2025 pada 23.50
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtabung`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `budgets`
--

CREATE TABLE `budgets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `year` year(4) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `income_target` decimal(12,2) DEFAULT NULL,
  `expense_limit` decimal(12,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `budgets`
--

INSERT INTO `budgets` (`id`, `user_id`, `name`, `year`, `month`, `income_target`, `expense_limit`, `created_at`, `updated_at`) VALUES
(2, 5, NULL, '2005', 6, 3535353.00, 535666.00, '2025-06-08 19:08:27', '2025-06-08 19:08:27'),
(3, 6, NULL, '2005', 2, 131313131.00, 13131.00, NULL, NULL),
(6, 8, NULL, '2025', 6, 100000.00, 100000.00, '2025-06-15 09:16:03', '2025-06-15 09:16:03'),
(7, 9, NULL, '2025', 6, 1000000.00, 500000.00, '2025-06-21 01:33:01', '2025-06-21 01:33:01'),
(8, 2, NULL, '2005', 2, 100000.00, 100000.00, '2025-06-21 05:18:25', '2025-06-21 05:20:32'),
(9, 2, NULL, '2025', 6, 10000000.00, 1000000.00, '2025-06-21 05:21:44', '2025-06-21 05:21:44'),
(10, 6, NULL, '2025', 6, 100000.00, 1000000.00, '2025-06-21 05:23:33', '2025-06-21 05:23:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `budget_categories`
--

CREATE TABLE `budget_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `budget_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `budget_categories`
--

INSERT INTO `budget_categories` (`id`, `budget_id`, `name`, `amount`, `created_at`, `updated_at`, `user_id`) VALUES
(5, 6, 'Transportasi', 1000000.00, '2025-06-15 09:16:24', '2025-06-15 09:16:24', NULL),
(9, 7, 'transportasi', 100000.00, '2025-06-21 05:04:34', '2025-06-21 05:04:34', NULL),
(10, 10, 'Transportasi', 100000.00, '2025-06-21 05:24:17', '2025-06-21 05:24:17', NULL),
(11, 10, 'Makanan', 20000.00, '2025-06-21 05:24:51', '2025-06-21 05:24:51', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_hilmi@gmail.com|127.0.0.1', 'i:2;', 1750504845),
('laravel_cache_hilmi@gmail.com|127.0.0.1:timer', 'i:1750504845;', 1750504845),
('laravel_cache_kamil@gmail.com|127.0.0.1', 'i:1;', 1750504831),
('laravel_cache_kamil@gmail.com|127.0.0.1:timer', 'i:1750504831;', 1750504831);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `financial_records`
--

CREATE TABLE `financial_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('pemasukan','pengeluaran') NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `budget_category_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `financial_records`
--

INSERT INTO `financial_records` (`id`, `user_id`, `type`, `amount`, `category`, `description`, `date`, `created_at`, `updated_at`, `budget_category_id`) VALUES
(2, 4, 'pemasukan', 100000.00, 'Makanan', 'Makan Bakso', '2025-06-07', '2025-06-05 18:50:24', '2025-06-05 18:50:24', NULL),
(3, 5, 'pengeluaran', 100000.00, 'Makanan', 'Sedang buat olahraga gym', '2025-06-07', '2025-06-05 18:51:04', '2025-06-08 17:23:47', NULL),
(4, 6, 'pemasukan', 2424242.00, 'sfsfs', 'sfsfsfs', '2025-06-12', NULL, NULL, NULL),
(5, 6, 'pengeluaran', 110000.00, 'ss', 'sfsfs', '2025-06-12', NULL, NULL, NULL),
(6, 6, 'pengeluaran', 1000000.00, 'makan bakso', 'makan bakso', '2025-06-11', NULL, NULL, NULL),
(7, 6, 'pengeluaran', 2424242424.00, 'wdwdwdw', 'dwdwdw', '2025-06-13', '2025-06-12 20:36:27', '2025-06-12 20:36:27', NULL),
(9, 6, 'pemasukan', 242424.00, 'adada', 'dada', '2025-06-13', '2025-06-13 00:35:24', '2025-06-13 00:35:24', NULL),
(10, 6, 'pengeluaran', 100000.00, 'susu', 'adada', '2025-06-13', '2025-06-13 00:36:52', '2025-06-13 00:36:52', NULL),
(11, 6, 'pengeluaran', 100000.00, 'Transportasi', 'adada', '2025-06-14', '2025-06-14 01:38:29', '2025-06-14 01:38:29', NULL),
(12, 6, 'pemasukan', 50000.00, 'Transportasi', 'adada', '2025-06-14', '2025-06-14 03:50:21', '2025-06-14 03:50:21', NULL),
(13, 6, 'pengeluaran', 42424.00, 'Makanan', 'adada', '2025-06-14', '2025-06-14 03:51:09', '2025-06-14 03:51:09', NULL),
(25, 8, 'pemasukan', 1000000.00, NULL, 'Pemasukan dari Mana', '2025-06-15', '2025-06-15 09:17:47', '2025-06-15 09:17:47', 5),
(27, 8, 'pengeluaran', 131312.00, NULL, 'fsfs', '2025-06-15', '2025-06-15 09:42:58', '2025-06-15 09:42:58', 5),
(35, 6, 'pengeluaran', 10000.00, NULL, 'Makan Seblak dan Siomay', '2025-06-21', '2025-06-21 05:31:20', '2025-06-21 05:31:20', 11),
(36, 6, 'pengeluaran', 5000.00, NULL, 'Naik TJ', '2025-06-21', '2025-06-21 05:32:08', '2025-06-21 05:32:08', 10),
(37, 6, 'pengeluaran', 5000.00, NULL, 'Naik TJ', '2025-06-21', '2025-06-21 05:32:39', '2025-06-21 05:32:39', 10),
(38, 6, 'pemasukan', 50000.00, NULL, 'Ada apa', '2025-06-21', '2025-06-21 05:36:23', '2025-06-21 05:36:23', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_03_124528_financial_records', 1),
(5, '2025_06_03_124557_budgets', 1),
(6, '2025_06_03_124606_savings', 1),
(7, '2025_06_14_092229_create_budget_categories_table', 2),
(8, '2025_06_14_104501_add_budget_category_id_to_financial_records', 3),
(9, '2025_06_15_113655_remove_saving', 4),
(10, '2025_06_15_113936_create_saving_target', 4),
(11, '2025_06_15_115246_add_user_id_to_budget_categories_table', 5),
(12, '2025_06_15_120816_add_name_to_budgets_table', 6),
(13, '2025_06_15_150729_remove_saving_targets', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `savings`
--

CREATE TABLE `savings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `saved_at` date NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `savings`
--

INSERT INTO `savings` (`id`, `user_id`, `amount`, `saved_at`, `description`, `created_at`, `updated_at`) VALUES
(2, 5, 100000.00, '2025-06-01', 'aku', '2025-06-08 22:52:44', '2025-06-08 22:55:22'),
(3, 6, 2244242.00, '2025-06-03', 'wdwdwdw', NULL, NULL),
(4, 6, 20000000.00, '2025-06-15', 'sdsdsds', '2025-06-15 03:38:01', '2025-06-15 03:38:01'),
(5, 6, 42000.00, '2025-06-15', 'a', '2025-06-15 05:10:37', '2025-06-15 05:10:37'),
(6, 6, 500000.00, '2025-06-15', 'adada', '2025-06-15 05:10:55', '2025-06-15 05:10:55'),
(7, 6, 420000.00, '2025-06-15', 'ada', '2025-06-15 05:17:45', '2025-06-15 05:17:45'),
(8, 6, 41000.00, '2025-06-15', 'adada', '2025-06-15 05:54:38', '2025-06-15 05:54:38'),
(9, 6, 220000.00, '2025-06-13', 'adada', '2025-06-15 06:00:21', '2025-06-15 06:00:21'),
(10, 6, 420000.00, '2025-06-15', 'sfs', '2025-06-15 06:44:09', '2025-06-15 06:44:09'),
(11, 6, 40000.00, '2025-06-15', 'afa', '2025-06-15 07:53:38', '2025-06-15 07:53:38'),
(12, 6, 100000.00, '2025-06-15', 'Makanan', '2025-06-15 07:54:14', '2025-06-15 07:54:14'),
(13, 8, 10000.00, '2025-06-15', 'Tabungan untuk beli HP', '2025-06-15 09:19:11', '2025-06-15 09:19:11'),
(14, 6, 10000.00, '2025-06-16', 'jajan', '2025-06-15 23:13:53', '2025-06-15 23:13:53'),
(15, 6, 10000.00, '2025-06-16', 'jajan', '2025-06-15 23:13:54', '2025-06-15 23:13:54'),
(16, 6, 10000.00, '2025-06-16', 'jajan', '2025-06-15 23:13:54', '2025-06-15 23:13:54'),
(17, 6, 10000.00, '2025-06-16', 'jajan', '2025-06-15 23:13:55', '2025-06-15 23:13:55'),
(18, 6, 10000.00, '2025-06-16', 'jajan', '2025-06-15 23:13:55', '2025-06-15 23:13:55'),
(19, 6, 10000.00, '2025-06-16', 'jajan', '2025-06-15 23:13:56', '2025-06-15 23:13:56'),
(20, 6, 10000.00, '2025-06-16', 'jajan', '2025-06-15 23:13:56', '2025-06-15 23:13:56'),
(23, 2, 10000000.00, '2025-06-21', 'Tabungan untuk masa depan kami semua', '2025-06-21 04:20:33', '2025-06-21 04:20:59'),
(24, 6, 5000.00, '2025-06-21', 'a', '2025-06-21 05:33:18', '2025-06-21 05:33:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FyZVFuGPwn2Vk4SeJBqefw2laPMMa8zeFfrr3Q9c', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiemhYMGM1RkU4T3N6cENNMldkQkRrQUlSODF6TzZOZ0FTR0hPUE91USI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL21haGFzaXN3YS9yaXdheWF0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Njt9', 1750509387);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `role` enum('mahasiswa','admin') NOT NULL DEFAULT 'mahasiswa',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Hilmi Kamil', 'k@gmail.com', NULL, 'admin', NULL, '$2y$12$nWDAQSokwwDjYSw9a7EY4OU9cQzEXeBxUp5rwYuNUr9pprvuCOD.6', NULL, '2025-06-03 17:56:55', '2025-06-03 17:56:55'),
(4, 'adada', 'adadada@gmail.com', '131313131', 'mahasiswa', NULL, '$2y$12$Q3h177P8aGgsvxC62S15QehEYUd4G/kN0aK8yBsG7ZrGLy18HYMse', NULL, '2025-06-04 19:57:12', '2025-06-04 21:49:09'),
(5, 'Halayuda', 'hala@gmail.com', '101010', 'mahasiswa', NULL, '$2y$12$RH8dDp4YHLkh.ao2O2rSfuNwejxm7wD9OlvmjjotkI1t87em9DJFy', NULL, '2025-06-04 21:57:36', '2025-06-04 21:57:36'),
(6, 'Zaidan kamil', 'zaidan@gmail.com', '242424242', 'mahasiswa', NULL, '$2y$12$5cfiOPSE0hTTwcbK.W2nGOni5Oty3G4TsuID8mHiTRBfanD4BJorO', NULL, '2025-06-10 17:59:20', '2025-06-10 17:59:20'),
(8, 'Ilyas Aziz', 'il@gmail.com', '0877364578395', 'mahasiswa', NULL, '$2y$12$ABlyUInSdlcath5jM1Q.bOM3yM1xeFGRzxeZXrEhjSI0spLYBpz4G', NULL, '2025-06-15 09:04:22', '2025-06-15 09:04:22'),
(9, 'Hilmi Kamil', 'kamilh@gmail.com', '085933519783', 'mahasiswa', NULL, '$2y$12$IblMidQ3hIz7ahjCHEBjS.FRoe/nCE2frCcq9sJ9I88Z.xUgoJwDK', NULL, '2025-06-21 01:32:34', '2025-06-21 01:32:34'),
(10, 'Jaka Tarub 1', 'jaka1@gmail.com', '0911', 'admin', NULL, '$2y$12$J6ViKWvoKM74sv3od9Xx.OOZiffgdAuSvBj3Z.Zb60FA//IQN/uHe', NULL, '2025-06-21 01:37:07', '2025-06-21 01:37:37');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budgets_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `budget_categories`
--
ALTER TABLE `budget_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budget_categories_budget_id_foreign` (`budget_id`),
  ADD KEY `budget_categories_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `financial_records`
--
ALTER TABLE `financial_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `financial_records_user_id_foreign` (`user_id`),
  ADD KEY `financial_records_budget_category_id_foreign` (`budget_category_id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `savings`
--
ALTER TABLE `savings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `savings_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `budgets`
--
ALTER TABLE `budgets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `budget_categories`
--
ALTER TABLE `budget_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `financial_records`
--
ALTER TABLE `financial_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `savings`
--
ALTER TABLE `savings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `budgets`
--
ALTER TABLE `budgets`
  ADD CONSTRAINT `budgets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `budget_categories`
--
ALTER TABLE `budget_categories`
  ADD CONSTRAINT `budget_categories_budget_id_foreign` FOREIGN KEY (`budget_id`) REFERENCES `budgets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `budget_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `financial_records`
--
ALTER TABLE `financial_records`
  ADD CONSTRAINT `financial_records_budget_category_id_foreign` FOREIGN KEY (`budget_category_id`) REFERENCES `budget_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `financial_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `savings`
--
ALTER TABLE `savings`
  ADD CONSTRAINT `savings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
