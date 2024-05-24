-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 09:28 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_seleksiatlet`
--

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
-- Table structure for table `fasilitas_olahragas`
--

CREATE TABLE `fasilitas_olahragas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_fasilitas` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fasilitas_olahragas`
--

INSERT INTO `fasilitas_olahragas` (`id`, `nama_fasilitas`, `lokasi`, `kapasitas`, `created_at`, `updated_at`) VALUES
(1, 'Lapangan Voly', 'ITN 1 Sigura gura', 1000, '2024-05-23 12:24:46', '2024-05-23 12:24:46');

-- --------------------------------------------------------

--
-- Table structure for table `kriterias`
--

CREATE TABLE `kriterias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `bobot_kriteria` int(11) NOT NULL,
  `kategori` enum('Benefit','Cost') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kriterias`
--

INSERT INTO `kriterias` (`id`, `nama_kriteria`, `bobot_kriteria`, `kategori`, `created_at`, `updated_at`) VALUES
(2, 'Adminsitrasi', 50, 'Benefit', '2024-05-23 10:30:43', '2024-05-23 10:30:43'),
(3, 'Psikologi', 30, 'Benefit', '2024-05-23 10:31:34', '2024-05-23 10:31:34'),
(4, 'Wawancara', 20, 'Benefit', '2024-05-23 10:31:50', '2024-05-23 10:31:50');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswas`
--

CREATE TABLE `mahasiswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ttl` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `agama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswas`
--

INSERT INTO `mahasiswas` (`id`, `nama`, `jurusan`, `no_telp`, `email`, `ttl`, `jenis_kelamin`, `alamat`, `agama`, `created_at`, `updated_at`) VALUES
(1, 'pelamar 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'pelamar 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'pelamar 3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'pelamar 4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'pelamar 5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'pelamar 6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_23_063040_create_mahasiswas_table', 1),
(6, '2024_05_23_063557_create_pelatihs_table', 1),
(7, '2024_05_23_064332_create_fasilitas_olahragas_table', 1),
(8, '2024_05_23_064804_create_pendaftarans_table', 1),
(9, '2024_05_23_070323_create_kriterias_table', 1),
(10, '2024_05_23_070526_create_sub_kriterias_table', 1),
(11, '2024_05_23_070832_create_penilaian_atlets_table', 1),
(12, '2024_05_23_071032_create_perankingans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelatihs`
--

CREATE TABLE `pelatihs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pelatih` varchar(255) NOT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `spesialis_olahraga` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelatihs`
--

INSERT INTO `pelatihs` (`id`, `nama_pelatih`, `no_telp`, `jenis_kelamin`, `spesialis_olahraga`, `created_at`, `updated_at`) VALUES
(1, 'rachmanullah45', '085967162714', 'Laki-Laki', 'Tarung', '2024-05-23 12:23:05', '2024-05-23 12:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftarans`
--

CREATE TABLE `pendaftarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `tgl_pendaftaran` date NOT NULL,
  `status` enum('Proses','Diterima','Tidak Diterima') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_atlets`
--

CREATE TABLE `penilaian_atlets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `kriteria_id` bigint(20) UNSIGNED NOT NULL,
  `nilai` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penilaian_atlets`
--

INSERT INTO `penilaian_atlets` (`id`, `mahasiswa_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 62.50, '2024-05-23 10:32:28', '2024-05-23 10:32:28'),
(2, 1, 3, 50.00, '2024-05-23 10:32:28', '2024-05-23 10:32:28'),
(3, 1, 4, 50.00, '2024-05-23 10:32:28', '2024-05-23 10:32:28'),
(4, 2, 2, 64.50, '2024-05-23 10:33:11', '2024-05-23 10:33:11'),
(5, 2, 3, 55.00, '2024-05-23 10:33:11', '2024-05-23 10:33:11'),
(6, 2, 4, 55.00, '2024-05-23 10:33:11', '2024-05-23 10:33:11'),
(7, 3, 2, 60.50, '2024-05-23 10:33:41', '2024-05-23 10:33:41'),
(8, 3, 3, 60.00, '2024-05-23 10:33:41', '2024-05-23 10:33:41'),
(9, 3, 4, 50.00, '2024-05-23 10:33:41', '2024-05-23 10:33:41'),
(10, 4, 2, 43.50, '2024-05-23 10:34:04', '2024-05-23 10:34:04'),
(11, 4, 3, 75.00, '2024-05-23 10:34:04', '2024-05-23 10:34:04'),
(12, 4, 4, 70.00, '2024-05-23 10:34:04', '2024-05-23 10:34:04'),
(13, 5, 2, 46.50, '2024-05-23 10:34:24', '2024-05-23 10:34:24'),
(14, 5, 3, 90.00, '2024-05-23 10:34:24', '2024-05-23 10:34:24'),
(15, 5, 4, 80.00, '2024-05-23 10:34:24', '2024-05-23 10:34:24'),
(16, 6, 2, 43.50, '2024-05-23 10:34:48', '2024-05-23 10:34:48'),
(17, 6, 3, 75.00, '2024-05-23 10:34:48', '2024-05-23 10:34:48'),
(18, 6, 4, 65.00, '2024-05-23 10:34:48', '2024-05-23 10:34:48');

-- --------------------------------------------------------

--
-- Table structure for table `perankingans`
--

CREATE TABLE `perankingans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `nilai_hasil` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perankingans`
--

INSERT INTO `perankingans` (`id`, `mahasiswa_id`, `nilai_hasil`, `created_at`, `updated_at`) VALUES
(1, 1, 77.90, '2024-05-23 10:55:07', '2024-05-23 10:55:07'),
(2, 2, 82.10, '2024-05-23 10:55:07', '2024-05-23 10:55:07'),
(3, 3, 79.70, '2024-05-23 10:55:07', '2024-05-23 10:55:07'),
(4, 4, 76.00, '2024-05-23 10:55:07', '2024-05-23 10:55:07'),
(5, 5, 86.00, '2024-05-23 10:55:07', '2024-05-23 10:55:07'),
(6, 6, 74.60, '2024-05-23 10:55:07', '2024-05-23 10:55:07');

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriterias`
--

CREATE TABLE `sub_kriterias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kriteria_id` bigint(20) UNSIGNED NOT NULL,
  `nama_sub` varchar(255) NOT NULL,
  `bobot_sub` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_kriterias`
--

INSERT INTO `sub_kriterias` (`id`, `kriteria_id`, `nama_sub`, `bobot_sub`, `created_at`, `updated_at`) VALUES
(1, 2, 'Pendidikan Terakhir', 30, '2024-05-23 10:30:43', '2024-05-23 10:30:43'),
(2, 2, 'Jurusan Pendidikan', 20, '2024-05-23 10:30:43', '2024-05-23 10:30:43'),
(3, 2, 'Pengalaman Kerja', 20, '2024-05-23 10:30:43', '2024-05-23 10:30:43'),
(4, 2, 'Posisi Kerja', 20, '2024-05-23 10:30:43', '2024-05-23 10:30:43'),
(5, 2, 'Lama Bekerja', 10, '2024-05-23 10:30:43', '2024-05-23 10:30:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$Yef3BWgwsTJFwWMc7oaNpe5PlAnsjV2HRV4b4jqhCTJA/Dud5XtKm', 'Admin', NULL, '2024-05-23 12:01:12', '2024-05-23 12:01:12'),
(2, 'Rachman', '$2y$12$9Qn20SIc5x3dbW3g5gBQ2.rRGwr941dA60EgrtaM9g0Hfm653LgZ2', 'Admin', NULL, '2024-05-23 12:22:05', '2024-05-23 12:22:05');

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
-- Indexes for table `fasilitas_olahragas`
--
ALTER TABLE `fasilitas_olahragas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriterias`
--
ALTER TABLE `kriterias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `pelatihs`
--
ALTER TABLE `pelatihs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendaftarans`
--
ALTER TABLE `pendaftarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pendaftarans_mahasiswa_id_foreign` (`mahasiswa_id`);

--
-- Indexes for table `penilaian_atlets`
--
ALTER TABLE `penilaian_atlets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaian_atlets_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `penilaian_atlets_kriteria_id_foreign` (`kriteria_id`);

--
-- Indexes for table `perankingans`
--
ALTER TABLE `perankingans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perankingans_mahasiswa_id_foreign` (`mahasiswa_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sub_kriterias`
--
ALTER TABLE `sub_kriterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_kriterias_kriteria_id_foreign` (`kriteria_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fasilitas_olahragas`
--
ALTER TABLE `fasilitas_olahragas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kriterias`
--
ALTER TABLE `kriterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pelatihs`
--
ALTER TABLE `pelatihs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pendaftarans`
--
ALTER TABLE `pendaftarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penilaian_atlets`
--
ALTER TABLE `penilaian_atlets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `perankingans`
--
ALTER TABLE `perankingans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_kriterias`
--
ALTER TABLE `sub_kriterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pendaftarans`
--
ALTER TABLE `pendaftarans`
  ADD CONSTRAINT `pendaftarans_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penilaian_atlets`
--
ALTER TABLE `penilaian_atlets`
  ADD CONSTRAINT `penilaian_atlets_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_atlets_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `perankingans`
--
ALTER TABLE `perankingans`
  ADD CONSTRAINT `perankingans_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_kriterias`
--
ALTER TABLE `sub_kriterias`
  ADD CONSTRAINT `sub_kriterias_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
