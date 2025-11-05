-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2025 at 03:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_presensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'adminsuper@gmail.com', 1, '2025-02-20 15:17:57', 1),
(2, '::1', 'khusni@gmail.com', NULL, '2025-02-20 17:36:00', 0),
(3, '::1', 'khusni@gmail.com', 2, '2025-02-20 17:36:08', 1),
(4, '::1', 'adminsuper@gmail.com', 1, '2025-02-20 19:57:10', 1),
(5, '::1', 'adminsuper@gmail.com', 1, '2025-02-20 20:42:53', 1),
(6, '::1', 'admin', NULL, '2025-02-21 13:45:33', 0),
(7, '::1', 'adminsuper@gmail.com', 1, '2025-02-21 13:46:41', 1),
(8, '::1', 'khusni', NULL, '2025-02-21 13:47:41', 0),
(9, '::1', 'khusni@gmail.com', NULL, '2025-02-21 13:47:52', 0),
(10, '::1', 'khusni@gmail.com', 2, '2025-02-21 13:48:23', 1),
(11, '::1', 'adminsuper@gmail.com', 1, '2025-02-21 18:38:31', 1),
(12, '::1', 'khusni@gmail.com', 2, '2025-02-21 19:15:10', 1),
(13, '::1', 'adminsuper@gmail.com', 1, '2025-02-23 12:03:05', 1),
(14, '::1', 'adminsuper@gmail.com', 1, '2025-02-23 12:47:56', 1),
(15, '::1', 'adminsuper@gmail.com', 1, '2025-02-23 12:59:32', 1),
(16, '::1', 'superadmin@gmail.com', NULL, '2025-02-23 13:03:55', 0),
(17, '::1', 'adminsuper@gmail.com', 1, '2025-02-23 13:04:05', 1),
(18, '::1', 'superadmin@gmail.com', NULL, '2025-02-23 13:04:28', 0),
(19, '::1', 'khusni@gmail.com', 2, '2025-02-23 13:11:33', 1),
(20, '::1', 'khusni', NULL, '2025-02-23 13:15:00', 0),
(21, '::1', 'khusni@gmail.com', 2, '2025-02-23 14:07:51', 1),
(22, '::1', 'adminsuper@gmail.com', 1, '2025-02-24 11:42:39', 1),
(23, '::1', 'khusni@gmail.com', 2, '2025-02-24 14:25:17', 1),
(24, '::1', 'adminsuper@gmail.com', 1, '2025-02-24 21:28:54', 1),
(25, '::1', 'adminsuper@gmail.com', 1, '2025-02-24 22:32:38', 1),
(26, '::1', 'khusni@gmail.com', 2, '2025-02-24 22:34:37', 1),
(27, '::1', 'khusni@gmail.com', 2, '2025-02-24 22:36:26', 1),
(28, '::1', 'khusni@gmail.com', 2, '2025-02-25 10:34:24', 1),
(29, '::1', 'khusni@gmail.com', 2, '2025-02-25 17:04:04', 1),
(30, '::1', 'adminsuper@gmail.com', 1, '2025-03-01 18:58:45', 1),
(31, '::1', 'superadmin@admin.com', NULL, '2025-03-02 13:46:31', 0),
(32, '::1', 'khusni@gmail.com', 2, '2025-03-02 13:46:40', 1),
(33, '::1', 'superadmin@admin.com', NULL, '2025-03-02 17:00:52', 0),
(34, '::1', 'adminsuper@gmail.com', 1, '2025-03-02 17:01:12', 1),
(35, '::1', 'adminsuper@gmail.com', 1, '2025-03-02 10:53:48', 1),
(36, '::1', 'adminsuper@gmail.com', 1, '2025-03-02 11:30:33', 1),
(37, '::1', 'khusni@gmail.com', 2, '2025-03-02 12:04:34', 1),
(38, '::1', 'adminsuper@gmail.com', 1, '2025-03-02 14:25:43', 1),
(39, '::1', 'khusni@gmail.com', 2, '2025-03-02 14:31:42', 1),
(40, '::1', 'superadmin', NULL, '2025-03-05 12:35:49', 0),
(41, '::1', 'adminsuper@gmail.com', 1, '2025-03-05 12:35:55', 1),
(42, '::1', 'adminsuper@gmail.com', 1, '2025-03-05 14:57:57', 1),
(43, '::1', 'adminsuper@gmail.com', 1, '2025-03-08 22:01:42', 1),
(44, '::1', 'adminsuper@gmail.com', 1, '2025-03-08 23:34:19', 1),
(45, '::1', 'adminsuper@gmail.com', 1, '2025-03-09 12:08:27', 1),
(46, '::1', 'adminsuper@gmail.com', 1, '2025-03-09 21:14:24', 1),
(47, '::1', 'adminsuper@gmail.com', 1, '2025-03-09 21:21:42', 1),
(48, '::1', 'adminsuper@gmail.com', 1, '2025-03-09 22:12:19', 1),
(49, '::1', 'adminsuper@gmail.com', 1, '2025-03-09 23:22:30', 1),
(50, '::1', 'adminsuper@gmail.com', 1, '2025-03-10 20:38:44', 1),
(51, '::1', 'adminsuper@gmail.com', 1, '2025-03-12 08:27:28', 1),
(52, '::1', 'adminsuper@gmail.com', 1, '2025-03-12 09:35:21', 1),
(53, '::1', 'adminsuper@gmail.com', 1, '2025-03-12 14:39:09', 1),
(54, '::1', 'adminsuper@gmail.com', 1, '2025-03-14 05:54:02', 1),
(55, '::1', 'adminsuper@gmail.com', 1, '2025-03-14 19:03:00', 1),
(56, '::1', 'adminsuper@gmail.com', 1, '2025-03-15 14:43:19', 1),
(57, '::1', 'adminsuper@gmail.com', 1, '2025-03-16 21:17:00', 1),
(58, '::1', 'adminsuper@gmail.com', 1, '2025-07-21 08:04:48', 1),
(59, '::1', 'adminsuper@gmail.com', 1, '2025-07-21 21:59:20', 1),
(60, '::1', 'mhi1234', NULL, '2025-07-21 22:00:37', 0),
(61, '::1', 'mhi1234', NULL, '2025-07-21 22:00:47', 0),
(62, '::1', 'mhi12345', 6, '2025-07-21 22:01:06', 0),
(63, '::1', 'mhi12345', 6, '2025-07-21 22:01:37', 0),
(64, '::1', 'mhi@gmail.com', 6, '2025-07-21 22:02:29', 0),
(65, '::1', 'mhi12345', NULL, '2025-07-21 22:02:51', 0),
(66, '::1', 'adminsuper@gmail.com', 1, '2025-07-21 22:03:11', 1),
(67, '::1', 'mhi@hmail.com', NULL, '2025-07-21 22:04:11', 0),
(68, '::1', 'adminsuper@gmail.com', 1, '2025-07-21 22:14:14', 1),
(69, '::1', 'mhi12345', 6, '2025-07-21 22:15:08', 0),
(70, '::1', 'adminsuper@gmail.com', 1, '2025-07-21 22:15:25', 1),
(71, '::1', 'fahmi12345@gmail.com', 7, '2025-07-21 22:16:38', 1),
(72, '::1', 'adminsuper@gmail.com', 1, '2025-07-21 22:17:05', 1),
(73, '::1', 'fahmi12345@gmail.com', 7, '2025-07-21 22:18:00', 1),
(74, '::1', 'adminsuper@gmail.com', 1, '2025-07-22 12:15:36', 1),
(75, '::1', 'adminsuper@gmail.com', 1, '2025-07-24 10:55:42', 1),
(76, '::1', 'adminsuper@gmail.com', 1, '2025-08-13 06:16:04', 1),
(77, '::1', 'adminsuper@gmail.com', 1, '2025-08-13 06:16:06', 1),
(78, '::1', 'khusni@gmail.com', 2, '2025-08-13 06:22:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `logo` varchar(225) DEFAULT NULL,
  `school_name` varchar(225) DEFAULT 'SMK 1 Indonesia',
  `school_year` varchar(225) DEFAULT '2024/2025',
  `copyright` varchar(225) DEFAULT '© 2025 All rights reserved.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `logo`, `school_name`, `school_year`, `copyright`) VALUES
(1, 'uploads/logo/logo_67b704000704b5-17579773.jpg', 'SMK Syafii Akrom', '2024/2025', '© 2025 All rights reserved.');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1740039436, 1),
(2, '2023-08-18-000001', 'App\\Database\\Migrations\\CreateJurusanTable', 'default', 'App', 1740039436, 1),
(3, '2023-08-18-000002', 'App\\Database\\Migrations\\CreateKelasTable', 'default', 'App', 1740039436, 1),
(4, '2023-08-18-000003', 'App\\Database\\Migrations\\CreateDB', 'default', 'App', 1740039437, 1),
(5, '2023-08-18-000004', 'App\\Database\\Migrations\\AddSuperadmin', 'default', 'App', 1740039437, 1),
(6, '2024-07-24-083011', 'App\\Database\\Migrations\\GeneralSettings', 'default', 'App', 1740039437, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int(11) NOT NULL,
  `nuptk` varchar(24) NOT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(32) NOT NULL,
  `unique_code` varchar(64) NOT NULL,
  `tgl_lahir` date DEFAULT NULL COMMENT 'Tanggal Lahir Guru'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nuptk`, `nama_guru`, `jenis_kelamin`, `alamat`, `no_hp`, `unique_code`, `tgl_lahir`) VALUES
(2, '9274856312098745', 'Muhammad Zubaidi', 'Laki-laki', 'Wonopringgo Kab. Pekalongan', '085225247134', '0085020146', NULL),
(4, '098765432123455465', 'imam kurniawan', 'Laki-laki', 'medono', '08765433455', '2211334455', '2025-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan`
--

CREATE TABLE `tb_jurusan` (
  `id` int(11) UNSIGNED NOT NULL,
  `jurusan` varchar(32) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`id`, `jurusan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'TKJ', '2025-02-20 08:17:16', '2025-02-20 08:17:16', NULL),
(2, 'TKR', '2025-02-20 08:17:16', '2025-02-20 08:17:16', NULL),
(3, 'TBSM', '2025-02-20 08:17:16', '2025-02-20 08:17:16', NULL),
(4, 'RPL', '2025-02-20 08:17:16', '2025-02-20 08:17:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kehadiran`
--

CREATE TABLE `tb_kehadiran` (
  `id_kehadiran` int(11) NOT NULL,
  `kehadiran` enum('Hadir','Sakit','Izin','Tanpa keterangan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kehadiran`
--

INSERT INTO `tb_kehadiran` (`id_kehadiran`, `kehadiran`) VALUES
(1, 'Hadir'),
(2, 'Sakit'),
(3, 'Izin'),
(4, 'Tanpa keterangan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) UNSIGNED NOT NULL,
  `kelas` varchar(32) NOT NULL,
  `id_jurusan` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `kelas`, `id_jurusan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'X', 1, '2025-02-20 08:17:16', '2025-02-20 08:17:16', NULL),
(2, 'X', 2, '2025-02-20 08:17:16', '2025-02-20 08:17:16', NULL),
(3, 'X', 3, '2025-02-20 08:17:16', '2025-02-20 08:17:16', NULL),
(4, 'X', 4, '2025-02-20 08:17:16', '2025-02-20 08:17:16', NULL),
(5, 'XI', 1, '2025-02-20 08:17:16', '2025-02-20 08:17:16', NULL),
(6, 'XI', 2, '2025-02-20 08:17:16', '2025-02-20 08:17:16', NULL),
(7, 'XI', 3, '2025-02-20 08:17:16', '2025-02-20 08:17:16', NULL),
(8, 'XI', 4, '2025-02-20 08:17:16', '2025-02-20 08:17:16', NULL),
(9, 'XII', 1, '2025-02-20 08:17:16', '2025-02-20 08:17:16', NULL),
(10, 'XII', 2, '2025-02-20 08:17:16', '2025-02-20 08:17:16', NULL),
(11, 'XII', 3, '2025-02-20 08:17:16', '2025-02-20 08:17:16', NULL),
(12, 'XII', 4, '2025-02-20 08:17:16', '2025-02-20 08:17:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_presensi_guru`
--

CREATE TABLE `tb_presensi_guru` (
  `id_presensi` int(11) NOT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `id_kehadiran` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_presensi_guru`
--

INSERT INTO `tb_presensi_guru` (`id_presensi`, `id_guru`, `tanggal`, `jam_masuk`, `jam_keluar`, `id_kehadiran`, `keterangan`) VALUES
(1, NULL, '2025-02-24', '15:52:40', '15:59:28', 1, ''),
(2, NULL, '2025-02-25', '10:34:35', NULL, 1, ''),
(3, NULL, '2025-03-02', '06:55:53', '16:02:15', 1, ''),
(4, NULL, '2025-03-05', '06:56:53', '14:57:26', 1, ''),
(5, NULL, '2025-03-08', '21:57:41', NULL, 1, ''),
(6, 2, '2025-03-09', '00:59:45', NULL, 1, ''),
(7, 4, '2025-03-10', NULL, NULL, 4, ''),
(8, 2, '2025-03-12', '09:37:36', '14:38:45', 1, ''),
(9, 2, '2025-03-14', '20:33:35', NULL, 1, ''),
(10, 2, '2025-03-15', '02:42:37', NULL, 1, ''),
(11, 2, '2025-08-13', '06:15:44', NULL, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_presensi_siswa`
--

CREATE TABLE `tb_presensi_siswa` (
  `id_presensi` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `id_kehadiran` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_presensi_siswa`
--

INSERT INTO `tb_presensi_siswa` (`id_presensi`, `id_siswa`, `id_kelas`, `tanggal`, `jam_masuk`, `jam_keluar`, `id_kehadiran`, `keterangan`) VALUES
(22, 14, 12, '2025-03-10', '00:00:00', NULL, 4, ''),
(23, 7, 12, '2025-03-12', '08:28:37', '14:38:55', 1, ''),
(24, 7, 12, '2025-03-14', '19:10:26', NULL, 1, ''),
(25, 7, 12, '2025-03-15', '02:42:29', NULL, 1, ''),
(26, 7, 12, '2025-03-16', '19:10:31', NULL, 1, ''),
(27, 7, 12, '2025-03-17', '06:00:00', '08:30:00', 1, ''),
(28, 7, 12, '2025-03-18', '06:20:39', '08:30:00', 1, ''),
(29, 7, 12, '2025-03-19', '06:27:38', '15:30:00', 1, ''),
(30, 7, 12, '2025-03-20', '06:26:03', '14:34:55', 1, ''),
(31, 12, 12, '2025-07-21', '08:01:22', NULL, 1, ''),
(32, 7, 12, '2025-07-21', '08:02:33', NULL, 1, ''),
(33, 14, 12, '2025-08-13', '06:15:12', NULL, 1, ''),
(34, 7, 12, '2025-08-13', NULL, NULL, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_settings`
--

CREATE TABLE `tb_settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(50) NOT NULL,
  `setting_value` text NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_settings`
--

INSERT INTO `tb_settings` (`id`, `setting_key`, `setting_value`, `description`) VALUES
(1, 'masuk_start', '06:00', 'Waktu mulai absen masuk (format: HH:MM)'),
(2, 'masuk_end', '08:30', 'Waktu akhir absen masuk (format: HH:MM)'),
(3, 'pulang_start', '14:00', 'Waktu mulai absen pulang (format: HH:MM)'),
(4, 'pulang_end', '15:30', 'Waktu akhir absen pulang (format: HH:MM)');

-- --------------------------------------------------------

--
-- Table structure for table `tb_setting_waktu`
--

CREATE TABLE `tb_setting_waktu` (
  `id` int(11) NOT NULL,
  `tipe` enum('masuk','pulang') NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_setting_waktu`
--

INSERT INTO `tb_setting_waktu` (`id`, `tipe`, `waktu_mulai`, `waktu_selesai`, `updated_at`) VALUES
(1, 'masuk', '06:00:00', '07:30:00', '2025-03-14 00:45:58'),
(2, 'pulang', '14:00:00', '17:00:00', '2025-03-14 00:45:58');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(16) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `id_kelas` int(11) UNSIGNED NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_hp` varchar(32) NOT NULL,
  `alamat` text DEFAULT NULL,
  `unique_code` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nis`, `nama_siswa`, `id_kelas`, `jenis_kelamin`, `tgl_lahir`, `no_hp`, `alamat`, `unique_code`) VALUES
(7, '23.4886', 'Fahmi Al Azzar', 12, 'Laki-laki', '2025-03-04', '085225247126', 'Grogolan Baru Pekalongan', '0084682438'),
(12, '23.4887', 'Mohamad Arian Yusfie', 12, 'Laki-laki', '2003-11-27', '085609785643', 'Kraton Lor Pekalongan', '0084834292'),
(13, '23.4888', 'Vikri Maulana', 12, 'Laki-laki', '2004-09-23', '089734523467', 'Kuripan Lor Pekalongan', '0084585147'),
(14, '23.4889', 'Abib Shofwan', 12, 'Laki-laki', '2003-03-12', '087842132676', 'Pabean Pekalongan', '0084455635');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `is_superadmin` tinyint(1) NOT NULL DEFAULT 0,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `is_superadmin`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`, `id_kelas`) VALUES
(1, 'adminsuper@gmail.com', 'superadmin', 1, '$2y$10$iUSuVHC3ZF69haVTXfduCu2XmFVQZLBCNdeQ.dqKfTlIyfEgUtDNS', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, 0),
(2, 'khusni@gmail.com', 'khusni', 0, '$2y$10$sKm3qbLE6DOhViMbnkRG2.pxg2ndsv.SU5QYVe1d3myvnm53aDo52', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-02-20 17:35:10', '2025-02-20 17:35:10', NULL, 0),
(6, 'mhi@gmail.com', 'mhi12345', 1, '$2y$10$ZXIFzuvGoeTw1oFXXdWHtucfD.kuIDw29J3kBtZymoeIk.u/EyNa6', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0),
(7, 'fahmi12345@gmail.com', 'fahmi12345', 1, '$2y$10$F7A1o0bB3EsbP8uCbf3E5.AIuwZHtBp.8x2DVc/IZf/zYAhbNWPPS', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-07-21 22:16:18', '2025-07-21 22:16:18', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD UNIQUE KEY `unique_code` (`unique_code`);

--
-- Indexes for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jurusan` (`jurusan`);

--
-- Indexes for table `tb_kehadiran`
--
ALTER TABLE `tb_kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `tb_kelas_id_jurusan_foreign` (`id_jurusan`);

--
-- Indexes for table `tb_presensi_guru`
--
ALTER TABLE `tb_presensi_guru`
  ADD PRIMARY KEY (`id_presensi`),
  ADD KEY `id_kehadiran` (`id_kehadiran`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indexes for table `tb_presensi_siswa`
--
ALTER TABLE `tb_presensi_siswa`
  ADD PRIMARY KEY (`id_presensi`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_kehadiran` (`id_kehadiran`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tb_settings`
--
ALTER TABLE `tb_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_key` (`setting_key`);

--
-- Indexes for table `tb_setting_waktu`
--
ALTER TABLE `tb_setting_waktu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `unique_code` (`unique_code`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_kehadiran`
--
ALTER TABLE `tb_kehadiran`
  MODIFY `id_kehadiran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_presensi_guru`
--
ALTER TABLE `tb_presensi_guru`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_presensi_siswa`
--
ALTER TABLE `tb_presensi_siswa`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tb_settings`
--
ALTER TABLE `tb_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_setting_waktu`
--
ALTER TABLE `tb_setting_waktu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD CONSTRAINT `tb_kelas_id_jurusan_foreign` FOREIGN KEY (`id_jurusan`) REFERENCES `tb_jurusan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tb_presensi_guru`
--
ALTER TABLE `tb_presensi_guru`
  ADD CONSTRAINT `tb_presensi_guru_ibfk_2` FOREIGN KEY (`id_kehadiran`) REFERENCES `tb_kehadiran` (`id_kehadiran`),
  ADD CONSTRAINT `tb_presensi_guru_ibfk_3` FOREIGN KEY (`id_guru`) REFERENCES `tb_guru` (`id_guru`) ON DELETE SET NULL;

--
-- Constraints for table `tb_presensi_siswa`
--
ALTER TABLE `tb_presensi_siswa`
  ADD CONSTRAINT `tb_presensi_siswa_ibfk_2` FOREIGN KEY (`id_kehadiran`) REFERENCES `tb_kehadiran` (`id_kehadiran`),
  ADD CONSTRAINT `tb_presensi_siswa_ibfk_3` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa` (`id_siswa`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_presensi_siswa_ibfk_4` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
