-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 04, 2025 at 11:51 PM
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
-- Database: `point_pelanggaran`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

CREATE TABLE `detail` (
  `id_detail` int NOT NULL,
  `id_point` int NOT NULL,
  `id_jenis` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail`
--

INSERT INTO `detail` (`id_detail`, `id_point`, `id_jenis`) VALUES
(99, 39, 13),
(100, 39, 11),
(101, 38, 11),
(103, 42, 11),
(104, 42, 13);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pelanggaran`
--

CREATE TABLE `jenis_pelanggaran` (
  `id_jenis` int NOT NULL,
  `id_kategori` int NOT NULL,
  `nama_pelanggaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jenis_pelanggaran`
--

INSERT INTO `jenis_pelanggaran` (`id_jenis`, `id_kategori`, `nama_pelanggaran`) VALUES
(11, 1, 'Tidak Membawa SIM'),
(12, 5, 'Laka'),
(13, 2, 'Melanggar Lampu Lalu Lintas');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pelanggaran`
--

CREATE TABLE `kategori_pelanggaran` (
  `id_kategori` int NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `bobot_point` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori_pelanggaran`
--

INSERT INTO `kategori_pelanggaran` (`id_kategori`, `kategori`, `bobot_point`) VALUES
(1, 'Ringan', 1),
(2, 'Sedang', 3),
(5, 'Berat', 5);

-- --------------------------------------------------------

--
-- Table structure for table `lupa_password`
--

CREATE TABLE `lupa_password` (
  `id_forgot` int NOT NULL,
  `id_user` int NOT NULL,
  `kode` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lupa_password`
--

INSERT INTO `lupa_password` (`id_forgot`, `id_user`, `kode`) VALUES
(3, 10, 'ea4fv');

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `id_notif` int NOT NULL,
  `notif` varchar(100) NOT NULL,
  `pesan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `is_active` tinyint NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notif`
--

INSERT INTO `notif` (`id_notif`, `notif`, `pesan`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 'Pengumuman', 'halo gess', 1, '2025-02-11 08:16:01', '2025-02-19 03:59:20', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pengendara`
--

CREATE TABLE `pengendara` (
  `id_pengendara` int NOT NULL,
  `nik` varchar(20) NOT NULL,
  `no_sim` varchar(20) NOT NULL,
  `tipe_sim` varchar(5) NOT NULL,
  `nama_pengendara` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `pekerjaan` varchar(10) NOT NULL,
  `provinsi` varchar(20) NOT NULL,
  `tanggal_berlaku` date NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengendara`
--

INSERT INTO `pengendara` (`id_pengendara`, `nik`, `no_sim`, `tipe_sim`, `nama_pengendara`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `pekerjaan`, `provinsi`, `tanggal_berlaku`, `email`) VALUES
(30, '3323276788760983', '2343-0978-221334', 'C', 'Firman Ferdiansyah', '2003-05-10', 'Pria', 'Pemalang', 'Swasta', 'Jateng', '2026-05-21', ''),
(32, '63528392054597', '6774-0020-912991', 'C', 'Joko Setiawan', '1996-02-24', 'Pria', 'Pemalang', 'Swasta', 'Jateng', '2027-11-17', ''),
(42, '', '4382-8343-910857', 'C', 'Boni Anggara', '2000-08-05', 'Pria', 'Pemalang', 'Swasta', 'Jateng', '0000-00-00', ''),
(43, '', '5466-0292-030922', 'C', 'Beben Hermansyah', '1997-10-21', 'Pria', 'Pemalang', 'Swasta', 'Jateng', '0000-00-00', ''),
(44, '', '4543-2019-950594', 'C', 'Bima Erlangga', '1990-10-22', 'Pria', 'Pemalang', 'Swasta', 'Jateng', '0000-00-00', ''),
(47, '', '1462-7789-776587', 'A', 'Juan', '2002-07-23', 'Pria', 'Pemalang', 'Swasta', 'Jateng', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `point`
--

CREATE TABLE `point` (
  `id_point` int NOT NULL,
  `id_user` int NOT NULL,
  `id_pengendara` int NOT NULL,
  `tanggal_sidang` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `point`
--

INSERT INTO `point` (`id_point`, `id_user`, `id_pengendara`, `tanggal_sidang`, `created_at`, `updated_at`, `deleted_at`) VALUES
(38, 10, 31, '2025-02-18', '2025-02-11 14:56:05', '2025-02-11 14:56:05', '0000-00-00 00:00:00'),
(39, 10, 30, '2025-02-19', '2025-02-12 02:00:44', '2025-02-12 02:00:44', '0000-00-00 00:00:00'),
(40, 18, 32, '2025-02-27', '2025-02-20 09:45:17', '2025-02-20 09:45:17', '0000-00-00 00:00:00'),
(41, 0, 30, '2025-02-28', '2025-02-21 06:27:08', '2025-02-21 06:27:08', '0000-00-00 00:00:00'),
(42, 0, 30, '2025-08-19', '2025-08-04 19:43:15', '2025-08-04 19:43:15', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sim`
--

CREATE TABLE `sim` (
  `id_sim` int NOT NULL,
  `id_pengendara` int NOT NULL,
  `no_sim` varchar(50) NOT NULL,
  `tanggal_berlaku` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` varchar(15) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `verification_code` varchar(20) NOT NULL,
  `is_verified` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`, `email`, `verification_code`, `is_verified`) VALUES
(10, 'polres', '$2y$10$mEh8oklhsoJAHAS4nJy7UOrr0K8Tc0u/PFYInd1sabqjd0dQ9x4Si', 'superadmin', 'rambupatuh@gmail.com', '', 1),
(11, 'firman', '$2y$10$YcLH4DpDYMgh4Jw0iWBwRuehBm4reMREGR274yko.XKBdEJ1Wuimq', 'satlantas', 'firmannnsyah10@gmail.com', '', 1),
(15, 'Akmal', '$2y$10$05Goboy4WerIoxvV.MpJ6O7RORv4EA6cXqfGrg0r74mV5txFhhl9u', 'satlantas', 'akmalstark7@gmail.com', '', 1),
(18, 'Polsek Kajen', '$2y$10$3KZ93J7xQjd1UsRgjky3NeyzEisfYZ1obhQyiI.UP5ahBr9aDmw1a', 'satlantas', 'firmannn32@gmail.com', '', 1),
(19, 'polsek', '$2y$10$8zv5bSzwAR7kRuNs7OggTemuJ17ZnHOu5Drr5lyb35s1lGcOnolBW', 'satlantas', 'dynamicrven@gmail.com', 'yyl9gwagex', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `id_user_log` int NOT NULL,
  `id_user` int NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `device` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id_user_log`, `id_user`, `ip_address`, `device`, `created_at`, `updated_at`, `deleted_at`) VALUES
(48, 11, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Sa', '2025-08-04 19:41:28', '2025-08-04 19:41:28', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_jenis` (`id_jenis`),
  ADD KEY `id_point` (`id_point`);

--
-- Indexes for table `jenis_pelanggaran`
--
ALTER TABLE `jenis_pelanggaran`
  ADD PRIMARY KEY (`id_jenis`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori_pelanggaran`
--
ALTER TABLE `kategori_pelanggaran`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `lupa_password`
--
ALTER TABLE `lupa_password`
  ADD PRIMARY KEY (`id_forgot`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`id_notif`);

--
-- Indexes for table `pengendara`
--
ALTER TABLE `pengendara`
  ADD PRIMARY KEY (`id_pengendara`),
  ADD UNIQUE KEY `no_sim` (`no_sim`);

--
-- Indexes for table `point`
--
ALTER TABLE `point`
  ADD PRIMARY KEY (`id_point`),
  ADD KEY `id_pengendara` (`id_pengendara`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `sim`
--
ALTER TABLE `sim`
  ADD PRIMARY KEY (`id_sim`),
  ADD KEY `id_pengendara` (`id_pengendara`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`id_user_log`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail`
--
ALTER TABLE `detail`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `jenis_pelanggaran`
--
ALTER TABLE `jenis_pelanggaran`
  MODIFY `id_jenis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kategori_pelanggaran`
--
ALTER TABLE `kategori_pelanggaran`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lupa_password`
--
ALTER TABLE `lupa_password`
  MODIFY `id_forgot` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notif`
--
ALTER TABLE `notif`
  MODIFY `id_notif` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pengendara`
--
ALTER TABLE `pengendara`
  MODIFY `id_pengendara` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `point`
--
ALTER TABLE `point`
  MODIFY `id_point` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `sim`
--
ALTER TABLE `sim`
  MODIFY `id_sim` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id_user_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
