-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 07 Eki 2024, 00:44:59
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `laravel`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `assigned_users`
--

CREATE TABLE `assigned_users` (
  `id` int(11) NOT NULL,
  `table_rows_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `assigned_type` int(1) NOT NULL COMMENT '1: Personel\r\n2: Customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `assigned_users`
--

INSERT INTO `assigned_users` (`id`, `table_rows_id`, `user_id`, `assigned_type`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2024-08-11 11:32:47', '2024-08-11 11:32:47'),
(2, 1, 1, 2, '2024-08-11 11:32:47', '2024-08-11 11:32:47');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('0a780d0e6477811417620701f4767224', 'i:1;', 1724189593),
('0a780d0e6477811417620701f4767224:timer', 'i:1724189593;', 1724189593),
('194cab481f76358e8bca7af60beb8d24', 'i:1;', 1721348083),
('194cab481f76358e8bca7af60beb8d24:timer', 'i:1721348083;', 1721348083),
('2408d2bb6406347d857939a530633f51', 'i:1;', 1724189886),
('2408d2bb6406347d857939a530633f51:timer', 'i:1724189886;', 1724189886),
('42ea71c225682b3dc582486d707a7259', 'i:1;', 1724189450),
('42ea71c225682b3dc582486d707a7259:timer', 'i:1724189450;', 1724189450),
('5651125e1c36ea3b460265af4bc52d30', 'i:1;', 1725954555),
('5651125e1c36ea3b460265af4bc52d30:timer', 'i:1725954555;', 1725954555),
('a3216393bd01c0a6bfb133a0f58543c3', 'i:1;', 1720915025),
('a3216393bd01c0a6bfb133a0f58543c3:timer', 'i:1720915025;', 1720915025),
('as@a.com|127.0.0.1', 'i:1;', 1720915025),
('as@a.com|127.0.0.1:timer', 'i:1720915025;', 1720915025),
('as@ga.com|127.0.0.1', 'i:1;', 1721348083),
('as@ga.com|127.0.0.1:timer', 'i:1721348083;', 1721348083),
('deneme|127.0.0.1', 'i:1;', 1724189450),
('deneme|127.0.0.1:timer', 'i:1724189450;', 1724189450),
('fd511721057c1b0036425da926f32001', 'i:1;', 1728253374),
('fd511721057c1b0036425da926f32001:timer', 'i:1728253374;', 1728253374),
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:3:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";}s:11:\"permissions\";a:8:{i:0;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:18:\"İnsan Kaynakları\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:6;s:1:\"b\";s:7:\"deneme1\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:7;s:1:\"b\";s:7:\"deneme2\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:8;s:1:\"b\";s:14:\"SOC Rule Table\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:9;s:1:\"b\";s:9:\"Kanbanlar\";s:1:\"c\";s:3:\"web\";}i:5;a:3:{s:1:\"a\";i:10;s:1:\"b\";s:15:\"Proje Yönetimi\";s:1:\"c\";s:3:\"web\";}i:6;a:3:{s:1:\"a\";i:12;s:1:\"b\";s:24:\"Deneme Kanban Kategorisi\";s:1:\"c\";s:3:\"web\";}i:7;a:3:{s:1:\"a\";i:17;s:1:\"b\";s:14:\"Denemeeeeeeeee\";s:1:\"c\";s:3:\"web\";}}s:5:\"roles\";a:0:{}}', 1728334958);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `calls`
--

CREATE TABLE `calls` (
  `call_id` int(11) NOT NULL,
  `caller_no` varchar(30) DEFAULT NULL,
  `called_no` varchar(30) NOT NULL,
  `representative_id` int(11) DEFAULT NULL,
  `isresponded` int(1) DEFAULT NULL COMMENT '0: Cevaplanmadı,\r\n1: Cevaplandı,\r\n2: Meşgul',
  `call_start_time` datetime NOT NULL,
  `call_end_time` datetime NOT NULL,
  `call_duration` varchar(255) NOT NULL,
  `call_type` varchar(80) NOT NULL,
  `call_reason` varchar(100) DEFAULT NULL,
  `call_summary` text DEFAULT NULL,
  `call_notes` varchar(255) DEFAULT NULL,
  `personel_evaluation` varchar(10) DEFAULT NULL,
  `resolution_status` varchar(100) DEFAULT NULL,
  `related_calls` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `calls`
--

INSERT INTO `calls` (`call_id`, `caller_no`, `called_no`, `representative_id`, `isresponded`, `call_start_time`, `call_end_time`, `call_duration`, `call_type`, `call_reason`, `call_summary`, `call_notes`, `personel_evaluation`, `resolution_status`, `related_calls`) VALUES
(1, '+905554443322', '+905994883726', 16, 1, '2024-08-03 21:51:16', '2024-08-03 21:55:16', '4 dakika 0 saniye', '<span class=\"badge rounded-pill bg-label-primary\">Giden</span>', 'Üründe çıkan problem', 'Ali beyin ürününde çıkan sorun çözüldü.', 'Ali beyin ürününde çıkan sorun çözüldü.', '5', '<span class=\"badge rounded-pill bg-label-warning\">Meşgul</span>', '[2,3,4]'),
(2, '+905554443322', '+905994883726', 3, 1, '2024-08-03 21:53:28', '2024-08-03 21:59:30', '6 dakika 2 saniye', '<span class=\"badge rounded-pill bg-label-primary\">Giden</span>', 'Fırsat bildirimi.', 'Laptop satışlarımızda olan 1 haftaık %30 indirim müşteriye bildirildi.', 'İndirim fırsati müşteriye bildirildi.', '5', '<span class=\"badge rounded-pill bg-label-danger\">Olumsuz</span>', NULL),
(4, '+901111111111', '+902222222222', 1, 1, '2024-08-04 12:00:00', '2024-08-04 12:30:00', '30 dakika 0 saniye', '<span class=\"badge rounded-pill bg-label-primary\">Giden</span>', 'Sohbet için aramış :/', 'Summary of the call.', 'Müşteri ile sohbet edildi.', '5', '<span class=\"badge rounded-pill bg-label-success\">Olumlu</span>', NULL),
(5, '+905554443322', '+905994883726', 1, 1, '2024-08-03 21:51:16', '2024-08-03 21:55:16', '4 dakika 19 saniye', '<span class=\"badge rounded-pill bg-label-info\">Gelen</span>', 'Buda sohbet etmek için aramış.', 'Ali beyin ürününde çıkan sorun tekrar çözüldü.', 'Bu müşteriylede sohbet edildi 😬', '3', '<span class=\"badge rounded-pill bg-label-primary\">Stabil</span>', NULL),
(10, '+905554443322', '+905994883726', 1, NULL, '2024-08-03 21:51:16', '2024-08-03 21:51:30', '14 saniye', '<span class=\"badge rounded-pill bg-label-primary\">Giden</span>', 'Arama sebebi', NULL, 'Personel arama notu', '5', '<span class=\"badge rounded-pill bg-label-success\">Olumlu</span>', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cell_contents`
--

CREATE TABLE `cell_contents` (
  `id` int(99) NOT NULL,
  `table_rows_id` int(11) DEFAULT NULL,
  `column_id` int(11) DEFAULT NULL,
  `contents` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `cell_contents`
--

INSERT INTO `cell_contents` (`id`, `table_rows_id`, `column_id`, `contents`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Ali', '2024-07-25 10:06:01', '2024-09-26 20:53:20'),
(2, 1, 2, 'Karakaya', '2024-07-25 10:06:01', '2024-08-25 19:26:57'),
(3, 1, 3, '24', '2024-07-25 10:06:01', '2024-09-28 16:20:18'),
(4, 2, 1, 'Ali', '2024-07-26 08:09:56', '2024-09-23 08:01:38'),
(5, 2, 2, 'taş', '2024-07-26 08:09:56', '2024-07-26 08:09:56'),
(6, 2, 3, '100', '2024-07-26 08:09:56', '2024-07-26 08:09:56'),
(7, 3, 9, 'Kenan', '2024-07-27 09:40:39', '2024-07-27 09:40:39'),
(8, 3, 10, '50.000₺', '2024-07-27 09:40:39', '2024-07-27 09:40:39'),
(10, 3, 11, 'Ankara', '2024-07-27 09:40:39', '2024-07-27 15:58:42'),
(11, 4, 9, 'Arda', '2024-07-27 14:17:37', '2024-07-27 14:17:37'),
(12, 4, 10, '100.000₺', '2024-07-27 14:17:37', '2024-07-27 14:17:37'),
(13, 4, 11, 'İstanbul', '2024-07-27 14:17:37', '2024-07-27 14:17:37'),
(19, 1, 16, '4,5,10', '2024-08-10 20:06:38', '2024-09-28 16:20:18'),
(20, 1, 17, '1,2', '2024-08-10 20:06:38', '2024-08-23 18:15:22'),
(28, 1, 15, '2024-08-31 23:13:00', '2024-08-15 22:43:45', '2024-09-26 20:36:55'),
(30, 2, 15, '2024-08-31 23:08:19', '2024-08-15 23:23:06', '2024-09-25 15:04:11'),
(32, 7, 9, 'deneme', '2024-08-21 13:56:58', '2024-08-21 13:56:58'),
(33, 7, 10, '30.000', '2024-08-21 13:56:58', '2024-08-21 13:56:58'),
(34, 7, 11, 'istanbul', '2024-08-21 13:56:58', '2024-08-21 13:56:58'),
(42, 2, 16, '1,2,4,5,9,10', '2024-09-08 13:44:34', '2024-09-08 13:44:34'),
(43, 1, 24, '1,5,10', '2024-09-10 20:54:09', '2024-09-28 16:20:52'),
(44, 2, 17, '1', '2024-09-23 07:38:19', '2024-09-24 23:07:39'),
(45, 2, 24, '4,10', '2024-09-23 07:40:40', '2024-09-23 07:40:40'),
(76, 1, 27, '2026-01-28 18:06:00', '2024-09-25 15:36:27', '2024-09-28 16:21:30'),
(103, 1, 31, 'Örnek string veri', '2024-09-28 16:22:15', '2024-10-03 20:59:07'),
(104, 16, 1, 'İsim', '2024-09-28 16:22:40', '2024-09-28 16:22:40'),
(105, 16, 2, 'Soyisim', '2024-09-28 16:22:40', '2024-09-28 16:22:40'),
(106, 16, 3, '40', '2024-09-28 16:22:40', '2024-09-28 16:22:40'),
(107, 16, 31, 'Veri', '2024-09-28 16:22:40', '2024-09-28 16:22:40'),
(108, 16, 16, '2', '2024-09-28 16:22:40', '2024-09-28 16:22:40'),
(109, 16, 24, '2,10', '2024-09-28 16:22:40', '2024-09-28 16:23:08'),
(110, 16, 22, '3', '2024-09-28 16:22:40', '2024-09-28 16:22:40'),
(111, 16, 23, '5', '2024-09-28 16:22:40', '2024-09-28 16:22:40'),
(112, 16, 17, '2', '2024-09-28 16:22:40', '2024-09-28 16:22:40'),
(113, 16, 15, '2027-08-20 21:13:00', '2024-09-28 16:23:08', '2024-09-28 16:23:08'),
(114, 16, 27, '2026-01-30 18:06:00', '2024-09-28 16:23:08', '2024-09-28 16:23:08');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `change_logs`
--

CREATE TABLE `change_logs` (
  `id` int(11) NOT NULL,
  `table_rows_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `change_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `columns`
--

CREATE TABLE `columns` (
  `id` int(11) NOT NULL,
  `table_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `columns`
--

INSERT INTO `columns` (`id`, `table_id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 'İsim', 'text', '2024-07-22 19:39:06', '2024-08-21 14:40:58'),
(2, 1, 'Soyisim', 'text', '2024-07-22 19:55:49', '2024-08-10 13:27:04'),
(3, 1, 'Yaş', 'text', '2024-07-25 09:07:09', '2024-08-10 13:27:06'),
(9, 2, 'İsim', 'text', '2024-07-27 09:39:54', '2024-08-10 13:27:07'),
(10, 2, 'Maaş', 'text', '2024-07-27 09:40:03', '2024-07-27 13:05:13'),
(11, 2, 'İl', 'text', '2024-07-27 10:10:19', '2024-08-10 13:27:11'),
(15, 1, 'Doğum Günü', 'datetime', '2024-08-10 09:20:43', '2024-09-25 15:02:38'),
(16, 1, 'İlgili Arama(lar)', 'calls', '2024-08-10 17:02:28', '2024-08-11 10:36:50'),
(17, 1, 'İlgili Kişi(ler)', 'assigned', '2024-08-11 07:36:17', '2024-08-12 16:59:34'),
(18, 1, 'Dosyalar', 'file', '2024-08-19 09:39:27', '2024-08-19 13:47:12'),
(22, 1, 'status', 'status', '2024-08-25 12:10:03', '2024-08-25 12:10:11'),
(23, 1, 'statusiki', 'status', '2024-08-25 18:42:59', '2024-08-25 18:42:59'),
(24, 1, 'İlgili Aramalar 2', 'calls', '2024-09-10 17:53:53', '2024-09-10 17:53:53'),
(25, 3, 'Rule Name', 'text', '2024-09-10 18:27:56', '2024-09-10 18:27:56'),
(26, 3, 'Rule ID', 'text', '2024-09-10 18:28:14', '2024-09-10 18:28:14'),
(27, 1, 'Örnek Datetime', 'datetime', '2024-09-25 15:33:03', '2024-09-25 15:33:16'),
(28, 2, 'Filelar', 'File', '2024-09-25 16:32:48', '2024-09-25 16:32:48'),
(31, 1, 'Örnek Text Kolonu', 'text', '2024-09-28 16:22:03', '2024-09-28 16:22:03');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `table_rows_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`id`, `table_rows_id`, `user_id`, `comment`, `created_at`) VALUES
(1, 6, 1, 'Deneme Yorumdr. Lorem ipsum felan degil bu İşe tam bir çorumlu. kahraman maraş ve kahraman çorum tarihi Milattan önce 54444 lara dayanmaktadır ve uzayda uzaylıar yaşadığına dair bir bilgi varmı kim bliir', '2024-08-19 14:10:38'),
(5, 6, 1, 'ilgili aramayı gerekli personel düzenleyebilir.', '2024-08-19 14:45:30'),
(6, 1, 1, 'deneme', '2024-08-19 18:50:53'),
(8, 2, 2, 'Ali taşçı 1234', '2024-09-10 21:29:36'),
(9, 5, 1, 'Denem ASDASDASDSA', '2024-09-24 22:56:12');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `county` varchar(50) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `registration_date` datetime DEFAULT current_timestamp(),
  `last_purchase_date` datetime DEFAULT NULL,
  `customer_status` enum('aktif','pasif','beklemede') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `customers`
--

INSERT INTO `customers` (`customer_id`, `username`, `full_name`, `email`, `phone_number`, `address`, `city`, `county`, `postal_code`, `country`, `date_of_birth`, `registration_date`, `last_purchase_date`, `customer_status`) VALUES
(1, 'alidero', 'ali dero', 'alidero@gmail.com', '+905554443322', 'Türkiye/Çorum', 'Çorum', 'aaaaa', '010000', 'Türkiye', '1994-12-19', '2024-08-01 16:18:39', NULL, 'aktif');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `failed_jobs`
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
-- Tablo için tablo yapısı `institutions`
--

CREATE TABLE `institutions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `jobs`
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
-- Tablo için tablo yapısı `job_batches`
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
-- Tablo için tablo yapısı `kanban_boards`
--

CREATE TABLE `kanban_boards` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `main` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kanban_boards`
--

INSERT INTO `kanban_boards` (`id`, `name`, `main`, `created_at`, `updated_at`) VALUES
(1, 'Proje Yönetimi', 1, '2024-08-27 20:33:50', '2024-08-29 21:39:51'),
(2, 'Denemeeeeeeeee', 2, '2024-09-27 23:17:42', '2024-09-27 23:17:42');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kanban_comments`
--

CREATE TABLE `kanban_comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `kanban_task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kanban_comments`
--

INSERT INTO `kanban_comments` (`id`, `kanban_task_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 12, 2, 'Deneme yorumu 111 merhaba', '2024-09-02 13:47:38', '2024-09-07 23:38:31'),
(22, 12, 1, 'Deneme yorumu', '2024-09-23 08:18:55', '2024-09-23 08:18:55'),
(23, 13, 1, 'Merhaba', '2024-09-24 23:03:28', '2024-09-24 23:03:28'),
(24, 13, 2, 'Merhaba', '2024-09-24 23:03:38', '2024-09-24 23:04:11');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kanban_lists`
--

CREATE TABLE `kanban_lists` (
  `id` int(11) NOT NULL,
  `board_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kanban_lists`
--

INSERT INTO `kanban_lists` (`id`, `board_id`, `name`, `order`, `created_at`, `updated_at`) VALUES
(2, 1, 'Devam Edenler', 3, '2024-08-27 20:37:43', '2024-10-02 19:11:04'),
(3, 1, 'Tamamlananlar', 1, '2024-08-27 20:37:43', '2024-10-02 19:11:04'),
(7, 1, 'Yapılacaklar', 2, '2024-08-31 09:33:01', '2024-10-02 19:11:04'),
(9, 2, 'Yapılmış Görevler', NULL, '2024-09-27 23:18:02', '2024-09-27 23:18:02'),
(12, 1, 'Table\'dan Gelenler', 4, '2024-10-02 19:10:59', '2024-10-02 19:11:04');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kanban_main_categories`
--

CREATE TABLE `kanban_main_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kanban_main_categories`
--

INSERT INTO `kanban_main_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Kanbanlar', '2024-08-29 21:31:33', '2024-08-29 21:31:33'),
(2, 'Deneme Kanban Kategorisi', '2024-09-27 23:14:50', '2024-09-27 23:14:50');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kanban_tasks`
--

CREATE TABLE `kanban_tasks` (
  `id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `table_rows` longtext DEFAULT NULL,
  `due_date` timestamp NULL DEFAULT current_timestamp(),
  `label` varchar(50) DEFAULT NULL,
  `badge` varchar(50) DEFAULT NULL,
  `assigned_user` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kanban_tasks`
--

INSERT INTO `kanban_tasks` (`id`, `list_id`, `name`, `description`, `type`, `table_rows`, `due_date`, `label`, `badge`, `assigned_user`, `created_at`, `updated_at`) VALUES
(5, 2, 'Task 5', 'Description for Task 5', NULL, NULL, '2024-10-06 09:00:00', 'Süresi doldu', '', NULL, '2024-08-27 20:43:57', '2024-10-05 21:07:01'),
(8, 2, 'Task 6', 'Description for Task 6', NULL, NULL, '2024-10-01 16:26:51', 'App', '', NULL, '2024-08-29 20:29:11', '2024-10-01 16:26:51'),
(12, 3, 'Task 1', 'Description for Task 1', NULL, NULL, '2024-10-04 05:25:00', NULL, 'secondary', NULL, '2024-08-30 17:01:12', '2024-10-03 16:08:42'),
(14, 7, 'Task 3', 'Description for Task 3', NULL, NULL, '2024-10-08 09:00:00', NULL, '', NULL, '2024-08-31 10:55:16', '2024-10-05 21:04:12'),
(15, 3, 'Task 4', 'Description for Task 4', NULL, NULL, '2024-10-01 16:26:56', NULL, '', NULL, '2024-08-31 10:55:20', '2024-10-01 16:26:56'),
(18, 9, 'Deneme Task for 2 id li kanban', 'Hobbalalasdsad a sdas', NULL, NULL, '2024-10-01 16:27:00', 'Images', NULL, NULL, '2024-09-27 23:18:35', '2024-10-01 16:27:00'),
(21, 7, 'Task 2', 'Description for Task 2', NULL, NULL, '2024-10-04 05:40:00', NULL, NULL, NULL, '2024-09-28 17:24:18', '2024-10-03 16:07:57'),
(26, 12, 'Task from Table Rows', 'Hobbala', 'sendedfromtable', '[\n    {\n        \"\\u0130sim\": \"Ali\",\n        \"Soyisim\": \"Karakaya\",\n        \"Ya\\u015f\": \"24\",\n        \"\\u0130lgili Arama(lar)\": \"4,5,10\",\n        \"\\u0130lgili Ki\\u015fi(ler)\": \"1,2\",\n        \"Do\\u011fum G\\u00fcn\\u00fc\": \"2024-08-31 23:13:00\",\n        \"\\u0130lgili Aramalar 2\": \"1,5,10\",\n        \"\\u00d6rnek Datetime\": \"2026-01-28 18:06:00\",\n        \"\\u00d6rnek Text Kolonu\": \"\\u00d6rnek string veri\"\n    },\n    {\n        \"\\u0130sim\": \"Ali\",\n        \"Soyisim\": \"ta\\u015f\",\n        \"Ya\\u015f\": \"100\",\n        \"Do\\u011fum G\\u00fcn\\u00fc\": \"2024-08-31 23:08:19\",\n        \"\\u0130lgili Arama(lar)\": \"1,2,4,5,9,10\",\n        \"\\u0130lgili Ki\\u015fi(ler)\": \"1\",\n        \"\\u0130lgili Aramalar 2\": \"4,10\"\n    }\n]', '2024-10-04 09:00:00', NULL, NULL, NULL, '2024-10-02 19:11:17', '2024-10-03 16:05:13'),
(27, 12, 'Task from Table Rows', 'This task contains data from selected table rows', 'sendedfromtable', '[\n    {\n        \"\\u0130sim\": \"Ali\",\n        \"Soyisim\": \"ta\\u015f\",\n        \"Ya\\u015f\": \"100\",\n        \"Do\\u011fum G\\u00fcn\\u00fc\": \"2024-08-31 23:08:19\",\n        \"\\u0130lgili Arama(lar)\": \"1,2,4,5,9,10\",\n        \"\\u0130lgili Ki\\u015fi(ler)\": \"1\",\n        \"\\u0130lgili Aramalar 2\": \"4,10\"\n    },\n    {\n        \"\\u0130sim\": \"\\u0130sim\",\n        \"Soyisim\": \"Soyisim\",\n        \"Ya\\u015f\": \"40\",\n        \"\\u00d6rnek Text Kolonu\": \"Veri\",\n        \"\\u0130lgili Arama(lar)\": \"2\",\n        \"\\u0130lgili Aramalar 2\": \"2,10\",\n        \"status\": \"3\",\n        \"statusiki\": \"5\",\n        \"\\u0130lgili Ki\\u015fi(ler)\": \"2\",\n        \"Do\\u011fum G\\u00fcn\\u00fc\": \"2027-08-20 21:13:00\",\n        \"\\u00d6rnek Datetime\": \"2026-01-30 18:06:00\"\n    }\n]', '2024-10-12 21:12:08', NULL, NULL, NULL, '2024-10-05 21:12:08', '2024-10-05 21:12:08');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kanban_task_users`
--

CREATE TABLE `kanban_task_users` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kanban_task_users`
--

INSERT INTO `kanban_task_users` (`id`, `task_id`, `user_id`, `assigned_at`) VALUES
(14, 12, 1, '2024-09-10 18:06:42'),
(15, 12, 2, '2024-09-10 18:06:42'),
(18, 16, 1, '2024-09-23 16:56:42'),
(19, 15, 2, '2024-09-24 23:05:44'),
(20, 13, 2, '2024-09-28 17:17:51'),
(21, 19, 2, '2024-09-28 17:19:10'),
(22, 21, 2, '2024-09-28 17:25:36'),
(23, 22, 1, '2024-09-28 17:26:32'),
(24, 22, 2, '2024-09-28 17:26:32'),
(25, 14, 1, '2024-09-30 17:25:01'),
(26, 5, 1, '2024-10-05 21:09:37');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `main_categories`
--

CREATE TABLE `main_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `main_categories`
--

INSERT INTO `main_categories` (`id`, `title`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'İnsan Kaynakları', 1, '2024-08-19 18:03:40', '2024-09-24 22:13:18');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_07_12_223953_add_two_factor_columns_to_users_table', 1),
(5, '2024_07_12_224015_create_personal_access_tokens_table', 1),
(6, '2024_08_20_210047_add_two_factor_columns_to_users_table', 2),
(7, '2024_08_20_210110_create_personal_access_tokens_table', 3),
(8, '2024_09_09_192258_create_permission_tables', 3),
(11, '2024_09_22_202105_add_two_factor_columns_to_users_table', 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(4, 'App\\Models\\User', 2),
(9, 'App\\Models\\User', 1),
(10, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Notifications\\TaskDueSoonNotification', 'App\\Models\\User', 1, '{\"message\":\"Task 3 \\u0130simli task\\u0131n\\u0131z\\u0131n son tarihine 3 g\\u00fcnden az kald\\u0131!\",\"due_date\":\"2024-10-08 12:00:00\"}', NULL, '2024-10-05 21:04:35', '2024-10-05 21:04:35'),
(2, 'App\\Notifications\\TaskDueSoonNotification', 'App\\Models\\User', 1, '{\"message\":\"Task 3 \\u0130simli task\\u0131n\\u0131z\\u0131n son tarihine 3 g\\u00fcnden az kald\\u0131!\",\"due_date\":\"2024-10-08 12:00:00\"}', NULL, '2024-10-05 21:05:08', '2024-10-05 21:05:08');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('louisee0357@gmail.com', '$2y$12$TVeWxz96PVpmzFbESxg3wexObyJD9ZId6BypqYFJfK6jO6Bp6AYG6', '2024-10-06 21:03:47');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(4, 'İnsan Kaynakları', 'web', '2024-09-23 20:19:30', '2024-09-23 20:19:30'),
(6, 'deneme1', 'web', '2024-09-24 19:59:00', '2024-09-24 19:59:00'),
(7, 'deneme2', 'web', '2024-09-24 19:59:00', '2024-09-24 19:59:00'),
(8, 'SOC Rule Table', 'web', '2024-09-24 19:59:00', '2024-09-24 19:59:00'),
(9, 'Kanbanlar', 'web', '2024-09-24 20:09:07', '2024-09-24 20:09:07'),
(10, 'Proje Yönetimi', 'web', '2024-09-24 20:09:50', '2024-09-24 20:09:50'),
(12, 'Deneme Kanban Kategorisi', 'web', '2024-09-24 20:09:50', '2024-09-24 20:09:50'),
(17, 'Denemeeeeeeeee', 'web', '2024-09-27 23:17:42', '2024-09-27 23:17:42');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `personal_access_tokens`
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

--
-- Tablo döküm verisi `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(5, 'App\\Models\\User', 1, 'Call Add Api', '2680089c737e677e2b89e2cb12c79fda1cbf2abcc8cf95a40f3ae448e768f05c', '[\"*\"]', NULL, NULL, '2024-08-06 07:18:33', '2024-08-06 07:18:33');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-09-09 18:03:22', '2024-09-09 18:03:22'),
(2, 'personel', 'web', '2024-09-09 18:06:55', '2024-09-09 18:06:55'),
(3, 'calls_yetkilisi', 'web', '2024-09-09 18:06:55', '2024-09-09 18:06:55');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(182, 1, 1, '2024-10-05 21:31:48', '2024-10-05 21:31:48'),
(183, 1, 2, '2024-10-05 21:31:48', '2024-10-05 21:31:48'),
(184, 1, 3, '2024-10-05 21:31:48', '2024-10-05 21:31:48');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rule_tables`
--

CREATE TABLE `rule_tables` (
  `id` int(11) NOT NULL,
  `table_id` int(11) DEFAULT NULL,
  `main_category_id` int(11) DEFAULT NULL,
  `rule_name` varchar(255) NOT NULL,
  `rule_description` text NOT NULL,
  `rule_creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `rule_last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rule_type` varchar(255) NOT NULL,
  `rule_threat_level` int(1) NOT NULL,
  `rule_source` text NOT NULL,
  `rule_destination` text NOT NULL,
  `rule_conditions` text NOT NULL,
  `rule_related` text NOT NULL,
  `rule_status` varchar(50) NOT NULL,
  `rule_created_by` varchar(40) NOT NULL,
  `rule_updated_by` varchar(40) NOT NULL,
  `rule_category` text NOT NULL,
  `rule_tags` text NOT NULL,
  `rule_applicability` varchar(255) NOT NULL,
  `rule_risk_score` int(2) NOT NULL,
  `rule_test_status` varchar(255) NOT NULL,
  `rule_test_date` date NOT NULL,
  `rule_tested_by` varchar(40) NOT NULL,
  `rule_alert_level` varchar(50) NOT NULL,
  `rule_documentation` varchar(255) NOT NULL,
  `rule_related_policies` text NOT NULL,
  `rule_audit_log` text NOT NULL,
  `rule_incident_logs` text NOT NULL,
  `rule_requirements` text NOT NULL,
  `rule_priority` varchar(50) NOT NULL,
  `rule_related_assets` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `rule_tables`
--

INSERT INTO `rule_tables` (`id`, `table_id`, `main_category_id`, `rule_name`, `rule_description`, `rule_creation_date`, `rule_last_update`, `rule_type`, `rule_threat_level`, `rule_source`, `rule_destination`, `rule_conditions`, `rule_related`, `rule_status`, `rule_created_by`, `rule_updated_by`, `rule_category`, `rule_tags`, `rule_applicability`, `rule_risk_score`, `rule_test_status`, `rule_test_date`, `rule_tested_by`, `rule_alert_level`, `rule_documentation`, `rule_related_policies`, `rule_audit_log`, `rule_incident_logs`, `rule_requirements`, `rule_priority`, `rule_related_assets`) VALUES
(1, 1, 1, 'example rule name', 'rule description', '2024-09-17 16:08:18', '2024-09-27 11:46:03', 'Example Type', 3, 'Source Example', 'Destination Example', 'Condition Example', 'Related Example', 'Active', '1', '1', 'Category Example', 'Tag1, Tag2', 'Applicable Example', 85, 'Tested', '2024-09-17', 'Tester Name', 'High', 'Documentation Example', 'Related Policies Example', 'Audit Log Exampleeee', 'Deneme', 'Requirements Example', 'Low Prority', 'Related Assets Example'),
(2, 1, 1, 'Example Rule Name', 'rule desc', '2024-09-17 16:08:18', '2024-09-27 11:46:06', 'Example Type', 3, 'Source Example', 'Destination Example', 'Condition Example', 'Related Example', 'Active', '1', 'Updater Name', 'Category Example', 'Tag1, Tag2', 'Applicable Example', 85, 'Tested', '2024-09-17', 'Tester Name', 'High', 'Documentation Example', 'Related Policies Example', 'Audit Log Example', 'Incident Logs Example', 'Requirements Example', 'High Priority', 'Related Assets Example');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rule_tables_main_categories`
--

CREATE TABLE `rule_tables_main_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `rule_tables_main_categories`
--

INSERT INTO `rule_tables_main_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Security Rules', '2024-09-27 12:05:29', '2024-09-27 12:05:29'),
(2, 'Network Rules', '2024-09-27 13:59:44', '2024-09-27 13:59:44');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rule_tables_sb`
--

CREATE TABLE `rule_tables_sb` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `rule_tables_sb`
--

INSERT INTO `rule_tables_sb` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Security Table 1', '2024-09-27 13:50:32', '2024-09-27 13:50:32'),
(2, 'Merhaba', '2024-09-27 13:58:58', '2024-09-27 13:58:58');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sessions`
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
-- Tablo döküm verisi `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0RcUK2IXcmMaVTMqyD7foME9dyLinEYOrWmyYGHf', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:131.0) Gecko/20100101 Firefox/131.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibkpialRva1VaU202WXlvYUZwSGNqVnNKZTZsb3BsYURsdGZVTnR3SyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBwL3VzZXIvdmlldy9hY2NvdW50LzEiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1728163908),
('BbgxgScFWxsLRXjea8oFHQ2w7qTwZnRL7GK5qBM8', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:131.0) Gecko/20100101 Firefox/131.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQXBXWHJXWmJydGhyeUw3dFdkYUpPMFNZMmFrYXdlbGFScWJuek5BUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL21haW4tY2F0ZWdvcmllcy9rYW5iYW4iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1728254181),
('g0yzQH3XSdUPhmyF1aHaySbSOzht8pNhVffm1krB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:131.0) Gecko/20100101 Firefox/131.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYWs3MktmUVZnSTI0UFRCdVJENlBnb0dGbWx3blhYdHdYWFFMdTlOVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90YWJsZXMvMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1728162728);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `status`
--

CREATE TABLE `status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_id` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `status`
--

INSERT INTO `status` (`id`, `table_id`, `status`, `class`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pending', 'bg-label-warning', '2024-08-25 21:07:12', '2024-08-25 21:50:06'),
(2, 1, 'Completed', 'bg-label-success', '2024-08-25 21:07:12', '2024-08-25 21:49:47'),
(3, 1, 'In Progress', 'bg-label-info', '2024-08-25 21:07:12', '2024-08-25 21:50:17'),
(4, 1, 'Danger st', 'bg-label-danger', '2024-09-23 08:45:11', '2024-09-23 08:45:11'),
(5, 1, 'deneme status', 'bg-label-secondary', '2024-09-23 12:06:50', '2024-09-23 12:06:50'),
(6, 1, 'Örnek Status', 'bg-label-success', '2024-09-27 23:02:03', '2024-09-27 23:02:03'),
(7, 1, 'Kargoda', 'bg-label-info', '2024-09-28 16:23:46', '2024-09-28 16:23:46');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `status_details`
--

CREATE TABLE `status_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_id` int(11) DEFAULT NULL,
  `column_id` int(11) DEFAULT NULL,
  `row_id` varchar(255) DEFAULT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `status_details`
--

INSERT INTO `status_details` (`id`, `table_id`, `column_id`, `row_id`, `status_id`, `created_at`, `updated_at`) VALUES
(17, 1, 17, '1', 2, '2024-09-23 04:34:16', '2024-09-23 04:34:16'),
(100, 1, 22, '2', 1, '2024-09-24 23:07:57', '2024-09-24 23:07:57'),
(101, 1, 22, '2', 2, '2024-09-24 23:07:57', '2024-09-24 23:07:57'),
(102, 1, 22, '2', 4, '2024-09-24 23:07:57', '2024-09-24 23:07:57'),
(103, 1, 22, '2', 5, '2024-09-24 23:07:57', '2024-09-24 23:07:57'),
(104, 1, 23, '2', 3, '2024-09-24 23:07:57', '2024-09-24 23:07:57'),
(147, 1, 22, '5', 2, '2024-09-26 20:53:58', '2024-09-26 20:53:58'),
(148, 1, 23, '5', 1, '2024-09-26 20:53:58', '2024-09-26 20:53:58'),
(163, 1, 22, '16', 3, '2024-09-28 16:23:08', '2024-09-28 16:23:08'),
(164, 1, 23, '16', 1, '2024-09-28 16:23:08', '2024-09-28 16:23:08'),
(195, 1, 22, '1', 1, '2024-10-03 20:59:07', '2024-10-03 20:59:07'),
(196, 1, 22, '1', 6, '2024-10-03 20:59:07', '2024-10-03 20:59:07'),
(197, 1, 22, '1', 7, '2024-10-03 20:59:07', '2024-10-03 20:59:07'),
(198, 1, 23, '1', 3, '2024-10-03 20:59:07', '2024-10-03 20:59:07'),
(199, 1, 23, '1', 5, '2024-10-03 20:59:07', '2024-10-03 20:59:07');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `institution_id` int(11) DEFAULT NULL,
  `main_category_id` int(11) DEFAULT NULL,
  `position_ids` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `tables`
--

INSERT INTO `tables` (`id`, `name`, `created_by`, `institution_id`, `main_category_id`, `position_ids`, `created_at`, `updated_at`) VALUES
(1, 'deneme1', 1, NULL, 1, NULL, '2024-07-22 19:33:25', '2024-08-19 18:04:23'),
(2, 'deneme2', 1, NULL, 1, NULL, '2024-07-27 09:39:00', '2024-08-19 18:04:26'),
(3, 'SOC Rule Table', 1, NULL, 1, NULL, '2024-07-27 09:39:00', '2024-09-10 21:26:10');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `table_rows`
--

CREATE TABLE `table_rows` (
  `id` int(11) NOT NULL,
  `table_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `table_rows`
--

INSERT INTO `table_rows` (`id`, `table_id`, `created_at`, `updated_at`, `last_modified_by`) VALUES
(1, 1, '2024-07-25 10:06:01', '2024-07-25 10:06:01', NULL),
(2, 1, '2024-07-26 08:09:56', '2024-07-26 08:09:56', NULL),
(3, 2, '2024-07-27 09:40:39', '2024-07-27 09:40:39', NULL),
(4, 2, '2024-07-27 14:17:37', '2024-07-27 14:17:37', NULL),
(7, 2, '2024-08-21 10:56:58', '2024-08-21 10:56:58', NULL),
(16, 1, '2024-09-28 16:22:40', '2024-09-28 16:22:40', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `position_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `institution_id` int(11) DEFAULT NULL,
  `api_key` varchar(50) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `phone`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `position_id`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `institution_id`, `api_key`, `user_type`) VALUES
(1, 'deneme', 'deneme', 'louisee0357@gmail.com', NULL, '+905994883726 ', '$2y$12$3TsbQqhc1So11yPHCEL.7OH1l4C17VXTSvN.tWzThFTDpRzct/LuC', NULL, NULL, NULL, NULL, 'x4YXJx7Vb1avK7bCdHSo9vZyDiPr0HukKrxohw8QGGwtNmQDnkqzkem6vW4U', NULL, NULL, '2024-09-09 17:15:30', '2024-09-29 10:37:07', NULL, NULL, NULL),
(2, 'deneme2', 'deneme2', 'deneme2@ga.tr', NULL, '+902222222222', '$2y$12$DG11GO0hZLYFB1uHLo/hNubGTzchqYNwGAgvffJX8iJQKqR0.tKLK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-09 17:15:30', '2024-09-09 17:15:30', NULL, NULL, 'customer');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `assigned_users`
--
ALTER TABLE `assigned_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_rows_id` (`table_rows_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Tablo için indeksler `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Tablo için indeksler `calls`
--
ALTER TABLE `calls`
  ADD PRIMARY KEY (`call_id`);

--
-- Tablo için indeksler `cell_contents`
--
ALTER TABLE `cell_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_rows_id` (`table_rows_id`),
  ADD KEY `column_id` (`column_id`);

--
-- Tablo için indeksler `change_logs`
--
ALTER TABLE `change_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_rows_id` (`table_rows_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `columns`
--
ALTER TABLE `columns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_id` (`table_id`);

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_rows_id` (`table_rows_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Tablo için indeksler `institutions`
--
ALTER TABLE `institutions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Tablo için indeksler `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Tablo için indeksler `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kanban_boards`
--
ALTER TABLE `kanban_boards`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kanban_comments`
--
ALTER TABLE `kanban_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`kanban_task_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `kanban_lists`
--
ALTER TABLE `kanban_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `board_id` (`board_id`);

--
-- Tablo için indeksler `kanban_main_categories`
--
ALTER TABLE `kanban_main_categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kanban_tasks`
--
ALTER TABLE `kanban_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list_id` (`list_id`);

--
-- Tablo için indeksler `kanban_task_users`
--
ALTER TABLE `kanban_task_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `main_categories`
--
ALTER TABLE `main_categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Tablo için indeksler `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Tablo için indeksler `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`),
  ADD KEY `notifications_created_at_index` (`created_at`);

--
-- Tablo için indeksler `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Tablo için indeksler `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Tablo için indeksler `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Tablo için indeksler `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Tablo için indeksler `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Tablo için indeksler `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `rule_tables`
--
ALTER TABLE `rule_tables`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `rule_tables_main_categories`
--
ALTER TABLE `rule_tables_main_categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `rule_tables_sb`
--
ALTER TABLE `rule_tables_sb`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Tablo için indeksler `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `status_details`
--
ALTER TABLE `status_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`);

--
-- Tablo için indeksler `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `institution_id` (`institution_id`),
  ADD KEY `main_category_id` (`main_category_id`);

--
-- Tablo için indeksler `table_rows`
--
ALTER TABLE `table_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_id` (`table_id`),
  ADD KEY `last_modified_by` (`last_modified_by`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `assigned_users`
--
ALTER TABLE `assigned_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `calls`
--
ALTER TABLE `calls`
  MODIFY `call_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `cell_contents`
--
ALTER TABLE `cell_contents`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- Tablo için AUTO_INCREMENT değeri `change_logs`
--
ALTER TABLE `change_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `columns`
--
ALTER TABLE `columns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `kanban_boards`
--
ALTER TABLE `kanban_boards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `kanban_comments`
--
ALTER TABLE `kanban_comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Tablo için AUTO_INCREMENT değeri `kanban_lists`
--
ALTER TABLE `kanban_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `kanban_main_categories`
--
ALTER TABLE `kanban_main_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `kanban_tasks`
--
ALTER TABLE `kanban_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Tablo için AUTO_INCREMENT değeri `kanban_task_users`
--
ALTER TABLE `kanban_task_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Tablo için AUTO_INCREMENT değeri `main_categories`
--
ALTER TABLE `main_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- Tablo için AUTO_INCREMENT değeri `rule_tables`
--
ALTER TABLE `rule_tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `rule_tables_main_categories`
--
ALTER TABLE `rule_tables_main_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `rule_tables_sb`
--
ALTER TABLE `rule_tables_sb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `status`
--
ALTER TABLE `status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `status_details`
--
ALTER TABLE `status_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- Tablo için AUTO_INCREMENT değeri `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `table_rows`
--
ALTER TABLE `table_rows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `cell_contents`
--
ALTER TABLE `cell_contents`
  ADD CONSTRAINT `cell_contents_ibfk_1` FOREIGN KEY (`table_rows_id`) REFERENCES `table_rows` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cell_contents_ibfk_2` FOREIGN KEY (`column_id`) REFERENCES `columns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
