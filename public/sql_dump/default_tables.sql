-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2021 at 12:59 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `storak_livedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_types`
--

CREATE TABLE `address_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `address_types`
--

INSERT INTO `address_types` (`id`, `type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Home', 1, NULL, NULL, NULL),
(2, 'Office', 1, NULL, NULL, NULL),
(3, 'Other', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `title`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Color', 1, '2021-08-07 10:08:56', '2021-08-07 10:08:56', NULL),
(2, 'Dimension', 1, '2021-08-07 10:08:56', '2021-08-07 10:08:56', NULL),
(3, 'Weight', 1, '2021-08-07 10:08:56', '2021-08-07 10:08:56', NULL),
(4, 'Mass', 1, '2021-08-07 10:08:56', '2021-08-07 10:08:56', NULL),
(5, 'Length', 1, '2021-08-07 10:08:56', '2021-08-07 10:08:56', NULL),
(6, 'Width', 1, '2021-08-07 10:08:56', '2021-08-07 10:08:56', NULL),
(7, 'Height', 1, '2021-08-07 10:08:56', '2021-08-07 10:08:56', NULL),
(8, 'Storage Capacity', 1, '2021-08-07 10:08:56', '2021-08-07 10:08:56', NULL),
(9, 'Number of Cameras', 1, '2021-08-07 10:08:56', '2021-08-07 10:08:56', NULL),
(10, 'RAM Memory', 1, '2021-08-07 10:08:56', '2021-08-07 10:08:56', NULL),
(11, 'Screen Size', 1, '2021-08-07 10:08:56', '2021-08-07 10:08:56', NULL),
(12, 'Screen Type', 1, '2021-08-07 10:08:56', '2021-08-07 10:08:56', NULL),
(13, 'Number Of Cores', 1, '2021-08-07 10:08:56', '2021-08-07 10:08:56', NULL),
(14, 'Sim Type', 1, '2021-08-07 10:08:56', '2021-08-07 10:08:56', NULL),
(15, 'Sim Slots', 1, '2021-08-07 10:08:56', '2021-08-07 10:08:56', NULL),
(16, 'Model Year', 1, '2021-08-07 10:08:56', '2021-08-07 10:08:56', NULL),
(17, 'Size', 1, '2021-08-07 10:08:56', '2021-08-07 10:08:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_key`
--

CREATE TABLE `attribute_key` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `key_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_key`
--

INSERT INTO `attribute_key` (`id`, `attribute_id`, `key_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 4),
(4, 1, 5),
(5, 1, 8),
(6, 1, 9),
(7, 3, 32),
(8, 3, 33),
(9, 3, 34),
(10, 3, 35),
(11, 3, 36),
(12, 3, 37),
(13, 3, 38),
(14, 3, 39),
(15, 3, 40),
(16, 3, 41),
(17, 3, 42),
(18, 3, 43),
(19, 3, 44),
(20, 3, 45),
(21, 3, 46),
(22, 4, 32),
(23, 4, 33),
(24, 4, 34),
(25, 4, 35),
(26, 4, 36),
(27, 4, 37),
(28, 4, 38),
(29, 4, 39),
(30, 4, 40),
(31, 4, 41),
(32, 4, 42),
(33, 4, 43),
(34, 4, 44),
(35, 4, 45),
(36, 4, 46),
(37, 5, 12),
(38, 5, 13),
(39, 5, 14),
(40, 5, 15),
(41, 5, 16),
(42, 5, 17),
(43, 5, 18),
(44, 5, 19),
(45, 5, 20),
(46, 5, 21),
(47, 5, 22),
(48, 5, 23),
(49, 5, 24),
(50, 5, 25),
(51, 5, 26),
(52, 5, 27),
(53, 5, 28),
(54, 5, 29),
(55, 5, 30),
(56, 5, 31),
(57, 5, 47),
(58, 5, 48),
(59, 5, 49),
(60, 5, 50),
(61, 5, 51),
(62, 7, 12),
(63, 7, 13),
(64, 7, 14),
(65, 7, 15),
(66, 7, 16),
(67, 7, 17),
(68, 7, 18),
(69, 7, 19),
(70, 7, 20),
(71, 7, 21),
(72, 7, 22),
(73, 7, 23),
(74, 7, 24),
(75, 7, 25),
(76, 7, 26),
(77, 7, 27),
(78, 7, 28),
(79, 7, 29),
(80, 7, 30),
(81, 7, 31),
(82, 7, 47),
(83, 7, 48),
(84, 7, 49),
(85, 7, 50),
(86, 7, 51),
(87, 16, 91),
(88, 16, 92),
(89, 16, 93),
(90, 16, 94),
(91, 16, 95),
(92, 16, 96),
(93, 16, 97),
(94, 16, 98),
(95, 16, 99),
(96, 16, 100),
(97, 16, 101),
(98, 15, 89),
(99, 15, 90),
(100, 13, 84),
(101, 13, 85),
(102, 13, 86),
(103, 13, 87),
(104, 13, 88),
(105, 11, 73),
(106, 11, 74),
(107, 11, 75),
(108, 11, 76),
(109, 11, 77),
(110, 12, 78),
(111, 12, 79),
(112, 12, 80),
(113, 12, 81),
(114, 12, 82),
(115, 12, 83),
(116, 10, 52),
(117, 10, 53),
(118, 10, 54),
(119, 10, 55),
(120, 10, 56),
(121, 10, 57),
(122, 10, 58),
(123, 10, 59),
(124, 10, 60),
(125, 8, 52),
(126, 8, 53),
(127, 8, 54),
(128, 8, 55),
(129, 8, 56),
(130, 8, 57),
(131, 8, 58),
(132, 8, 59),
(133, 8, 60),
(134, 8, 61),
(135, 8, 62),
(136, 8, 63),
(137, 8, 64),
(138, 8, 65),
(139, 8, 66),
(140, 8, 67),
(141, 8, 68),
(142, 9, 69),
(143, 9, 70),
(144, 9, 71),
(145, 9, 72),
(146, 17, 103),
(147, 17, 104),
(148, 17, 105),
(149, 17, 106);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_product`
--

CREATE TABLE `attribute_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `key_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attribute_subcategory`
--

CREATE TABLE `attribute_subcategory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_subcategory`
--

INSERT INTO `attribute_subcategory` (`id`, `subcategory_id`, `attribute_id`) VALUES
(2, 11, 1),
(3, 12, 1),
(4, 13, 1),
(5, 14, 1),
(6, 15, 1),
(7, 16, 1),
(8, 17, 1),
(9, 18, 1),
(10, 19, 1),
(11, 20, 1),
(12, 21, 1),
(13, 22, 1),
(14, 23, 1),
(15, 24, 1),
(16, 25, 1),
(17, 26, 1),
(18, 27, 1),
(19, 28, 1),
(20, 29, 1),
(21, 30, 1),
(22, 31, 1),
(23, 32, 1),
(24, 33, 1),
(25, 34, 1),
(26, 35, 1),
(27, 36, 1),
(28, 37, 1),
(29, 38, 1),
(30, 39, 1),
(31, 40, 1),
(32, 41, 1),
(33, 42, 1),
(34, 43, 1),
(35, 44, 1),
(36, 45, 1),
(37, 46, 1),
(38, 47, 1),
(39, 48, 1),
(40, 49, 1),
(41, 50, 1),
(42, 51, 1),
(43, 52, 1),
(44, 53, 1),
(45, 54, 1),
(46, 55, 1),
(47, 56, 1),
(48, 57, 1),
(49, 58, 1),
(50, 59, 1),
(51, 60, 1),
(52, 61, 1),
(53, 62, 1),
(54, 63, 1),
(55, 64, 1),
(56, 65, 1),
(57, 66, 1),
(58, 67, 1),
(59, 69, 1),
(122, 1, 10),
(123, 1, 11),
(124, 1, 12),
(125, 1, 13),
(126, 1, 14),
(127, 1, 15),
(128, 1, 16),
(129, 11, 3),
(130, 11, 8),
(132, 11, 10),
(134, 11, 12),
(136, 11, 14),
(137, 11, 15),
(139, 27, 3),
(140, 27, 8),
(141, 27, 9),
(142, 27, 10),
(143, 27, 11),
(144, 27, 12),
(145, 27, 13),
(146, 27, 14),
(147, 27, 15),
(149, 14, 11),
(150, 14, 12),
(151, 14, 16),
(152, 15, 2),
(153, 15, 3),
(154, 15, 7),
(155, 15, 16),
(157, 11, 16),
(158, 12, 16),
(159, 13, 16),
(162, 16, 16),
(163, 17, 16),
(164, 18, 16),
(165, 19, 16),
(166, 20, 16),
(167, 21, 16),
(168, 22, 16),
(169, 23, 16),
(170, 24, 16),
(171, 25, 16),
(172, 26, 16),
(173, 27, 16),
(174, 28, 16),
(175, 29, 16),
(177, 31, 16),
(178, 32, 16),
(179, 33, 16),
(180, 34, 16),
(181, 35, 16),
(182, 36, 16),
(183, 37, 16),
(184, 38, 16),
(186, 40, 16),
(187, 41, 16),
(188, 42, 16),
(189, 43, 16),
(190, 44, 16),
(191, 45, 16),
(192, 46, 16),
(193, 47, 16),
(194, 48, 16),
(195, 49, 16),
(196, 50, 16),
(197, 51, 16),
(198, 52, 16),
(199, 53, 16),
(200, 54, 16),
(201, 55, 16),
(202, 56, 16),
(203, 57, 16),
(204, 58, 16),
(205, 59, 16),
(206, 60, 16),
(207, 61, 16),
(208, 62, 16),
(209, 63, 16),
(210, 64, 16),
(211, 65, 16),
(212, 66, 16),
(213, 67, 16),
(214, 69, 16),
(215, 1, 1),
(219, 1, 3),
(221, 12, 3),
(222, 13, 3),
(223, 1, 8),
(225, 1, 9),
(233, 11, 9),
(236, 11, 11),
(237, 11, 13),
(239, 30, 17),
(240, 39, 17);

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `account_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iban` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_letter_doc` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `user_id`, `account_title`, `account_no`, `bank_name`, `branch_code`, `iban`, `bank_letter_doc`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, 107, 'Khaalid Maqbool', '1122334455', 'Bank Alflah', '1234', '1122334455', '1635404191.pdf', '2021-10-28 03:56:31', '2021-10-28 03:56:31', NULL),
(14, 2, 'Minhas Kharal', '45215336520202120330251', 'HBL', '5566', 'PK209', '1636964043.pdf', '2021-11-15 06:14:04', '2021-11-15 06:14:04', NULL),
(15, 109, 'qwertyuiopasdfghjklzxvbnm123567890', '123456789', 'abc bank', '123456789', '0000000000!@#$%^&*()_+/*-+abcdefghi', '1636971296.pdf', '2021-11-15 08:14:56', '2021-11-15 08:15:20', NULL),
(16, 80, 'Minhas', '152045841541415848515', 'MCB', '343', 'PK2044', '1636974403.pdf', '2021-11-15 09:06:43', '2021-11-15 09:06:43', NULL),
(17, 124, 'Minhas Kharal', '12154851202145402148', 'HBL', '45487', 'PK2088', '1636978574.pdf', '2021-11-15 10:16:14', '2021-11-15 10:16:14', NULL),
(18, 125, 'Minhas Jutt', '359520810840841845', 'UBL', '4565', 'PK2000', '1637059954.pdf', '2021-11-16 08:52:34', '2021-11-16 08:52:34', NULL),
(19, 126, 'Minhas Kharal21', '0900505100050000000', 'MCB', '9898', '05606352', '1637061563.pdf', '2021-11-16 09:19:23', '2021-11-16 09:19:23', NULL),
(20, 127, 'Minhas Kharal', '055485048154174', 'HBL', '5085151518', '1804480500', '1637063098.pdf', '2021-11-16 09:44:58', '2021-11-16 09:44:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `description`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 'Feel Free to Pay your own', 'Currency & Shop Goods', '1626328863.jpg', 1, '2021-06-15 07:50:15', '2021-07-15 01:01:04', NULL),
(10, 'We Offer Lowest', 'Discounted Prices', '1626328885.jpg', 1, '2021-06-16 05:10:04', '2021-07-15 01:01:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `description`, `logo_image`, `cover_image`, `featured`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Nokia', '<p>Nokia</p>', NULL, NULL, 1, 1, '2021-06-14 05:45:49', '2021-06-14 05:56:14', NULL),
(2, 'Samsung', '<p>samsung</p>', NULL, NULL, 1, 1, '2021-06-14 05:46:42', '2021-06-14 05:46:42', NULL),
(3, 'Sony', '<p>Sony</p>', NULL, NULL, 1, 1, '2021-07-07 05:44:32', '2021-07-07 05:45:11', NULL),
(4, 'LG', '<p>Lg</p>', NULL, NULL, 1, 1, '2021-07-07 07:57:54', '2021-07-07 07:58:13', NULL),
(13, 'Motorola', '<p>Motorola</p>', NULL, NULL, 1, 1, '2021-06-14 05:45:49', '2021-06-14 05:56:14', NULL),
(14, 'Lenovo', '<p>Lenovo</p>', NULL, NULL, 1, 1, '2021-06-14 05:46:42', '2021-06-14 05:46:42', NULL),
(15, 'Google', '<p>Google</p>', NULL, NULL, 1, 1, '2021-07-07 05:44:32', '2021-07-07 05:45:11', NULL),
(16, 'Vivo', '<p>Vivo</p>', NULL, NULL, 1, 1, '2021-07-07 07:57:54', '2021-07-07 07:58:13', NULL),
(17, 'Warda', '<p>Warda</p>', NULL, NULL, 1, 1, '2021-06-14 05:45:49', '2021-06-14 05:56:14', NULL),
(18, 'Khaadi', '<p>Khaadi</p>', NULL, NULL, 1, 1, '2021-06-14 05:46:42', '2021-06-14 05:46:42', NULL),
(19, 'J.', '<p>J.</p>', NULL, NULL, 1, 1, '2021-07-07 05:44:32', '2021-07-07 05:45:11', NULL),
(20, 'Maria B', '<p>Maria B</p>', NULL, NULL, 1, 1, '2021-07-07 07:57:54', '2021-07-07 07:58:13', NULL),
(21, 'Saphire', '<p>Saphire</p>', NULL, NULL, 1, 1, '2021-06-14 05:45:49', '2021-06-14 05:56:14', NULL),
(22, 'Bata', '<p>Bata</p>', NULL, NULL, 1, 1, '2021-06-14 05:46:42', '2021-06-14 05:46:42', NULL),
(23, 'Service', '<p>Service</p>', NULL, NULL, 1, 1, '2021-07-07 05:44:32', '2021-07-07 05:45:11', NULL),
(24, 'Borjan', '<p>Borjan</p>', NULL, NULL, 1, 1, '2021-07-07 07:57:54', '2021-07-07 07:58:13', NULL),
(25, 'Pel', '<p>Pel</p>', NULL, NULL, 1, 1, '2021-06-14 05:45:49', '2021-06-14 05:56:14', NULL),
(26, 'Dawlance', '<p>Dawlance</p>', NULL, NULL, 1, 1, '2021-06-14 05:46:42', '2021-06-14 05:46:42', NULL),
(27, 'Homeage', '<p>Homeage</p>', NULL, NULL, 1, 1, '2021-07-07 05:44:32', '2021-07-07 05:45:11', NULL),
(28, 'Haier', '<p>Haier</p>', NULL, NULL, 1, 1, '2021-07-07 07:57:54', '2021-07-07 07:58:13', NULL),
(29, 'Philips', '<p>Philips</p>', NULL, NULL, 1, 1, '2021-06-14 05:45:49', '2021-06-14 05:56:14', NULL),
(30, 'Dell', '<p>Dell</p>', NULL, NULL, 1, 1, '2021-07-07 05:44:32', '2021-07-07 05:45:11', NULL),
(31, 'Hp', '<p>Hp</p>', NULL, NULL, 1, 1, '2021-07-07 07:57:54', '2021-07-07 07:58:13', NULL),
(32, 'Toshiba', '<p>Toshiba</p>', NULL, NULL, 1, 1, '2021-06-14 05:45:49', '2021-06-14 05:56:14', NULL),
(33, 'No Brand', 'not related to any brand', NULL, NULL, 0, 0, NULL, NULL, NULL),
(34, 'Huawei', '<p>test description</p>', NULL, NULL, 1, 1, '2021-11-15 05:38:36', '2021-11-15 05:39:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brand_category`
--

CREATE TABLE `brand_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand_category`
--

INSERT INTO `brand_category` (`id`, `brand_id`, `category_id`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 4, 1),
(4, 25, 1),
(5, 26, 1),
(6, 27, 1),
(7, 28, 1),
(8, 29, 1),
(9, 1, 9),
(10, 2, 9),
(11, 3, 9),
(12, 4, 9),
(13, 5, 9),
(14, 6, 9),
(15, 7, 9),
(16, 8, 9),
(17, 2, 10),
(18, 3, 10),
(19, 4, 10),
(20, 14, 11),
(21, 28, 11),
(22, 30, 11),
(23, 31, 11),
(24, 32, 11),
(25, 17, 12),
(26, 18, 12),
(27, 19, 12),
(28, 20, 12),
(29, 21, 12),
(30, 22, 13),
(31, 23, 13),
(32, 24, 13),
(33, 34, 10),
(34, 34, 1),
(35, 34, 11),
(36, 34, 9),
(37, 34, 16);

-- --------------------------------------------------------

--
-- Table structure for table `business_documents`
--

CREATE TABLE `business_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_information_id` bigint(20) UNSIGNED NOT NULL,
  `document_input_id` bigint(20) UNSIGNED NOT NULL,
  `document_input_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_documents`
--

INSERT INTO `business_documents` (`id`, `business_information_id`, `document_input_id`, `document_input_value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(151, 13, 2, 'doc2-1636963898.png', '2021-11-15 06:11:39', '2021-11-15 06:11:39', NULL),
(152, 13, 3, 'doc3-1636963898.png', '2021-11-15 06:11:39', '2021-11-15 06:11:39', NULL),
(153, 13, 5, 'doc5-1636963898.png', '2021-11-15 06:11:39', '2021-11-15 06:11:39', NULL),
(154, 13, 7, 'doc7-1636963898.jpg', '2021-11-15 06:11:39', '2021-11-15 06:11:39', NULL),
(155, 13, 9, 'doc9-1636963898.png', '2021-11-15 06:11:39', '2021-11-15 06:11:39', NULL),
(156, 13, 11, 'doc11-1636963898.png', '2021-11-15 06:11:39', '2021-11-15 06:11:39', NULL),
(157, 14, 2, 'doc2-1636969431.png', '2021-11-15 07:43:51', '2021-11-15 07:43:51', NULL),
(158, 14, 3, 'doc3-1636969431.png', '2021-11-15 07:43:51', '2021-11-15 07:43:51', NULL),
(159, 14, 5, 'doc5-1636969431.png', '2021-11-15 07:43:51', '2021-11-15 07:43:51', NULL),
(160, 14, 7, 'doc7-1636969431.png', '2021-11-15 07:43:51', '2021-11-15 07:43:51', NULL),
(161, 14, 9, 'doc9-1636969431.png', '2021-11-15 07:43:51', '2021-11-15 07:43:51', NULL),
(162, 14, 11, 'doc11-1636969431.png', '2021-11-15 07:43:51', '2021-11-15 07:43:51', NULL),
(163, 15, 2, 'doc2-1636974301.png', '2021-11-15 09:05:01', '2021-11-15 09:05:01', NULL),
(164, 15, 3, 'doc3-1636974301.png', '2021-11-15 09:05:01', '2021-11-15 09:05:01', NULL),
(165, 15, 5, 'doc5-1636974301.jpg', '2021-11-15 09:05:01', '2021-11-15 09:05:01', NULL),
(166, 15, 7, 'doc7-1636974301.png', '2021-11-15 09:05:01', '2021-11-15 09:05:01', NULL),
(167, 15, 9, 'doc9-1636974301.jpg', '2021-11-15 09:05:01', '2021-11-15 09:05:01', NULL),
(168, 15, 11, 'doc11-1636974301.jpg', '2021-11-15 09:05:01', '2021-11-15 09:05:01', NULL),
(169, 16, 2, 'doc2-1636978475.jpg', '2021-11-15 10:14:35', '2021-11-15 10:14:35', NULL),
(170, 16, 3, 'doc3-1636978475.png', '2021-11-15 10:14:35', '2021-11-15 10:14:35', NULL),
(171, 16, 5, 'doc5-1636978475.png', '2021-11-15 10:14:35', '2021-11-15 10:14:35', NULL),
(172, 16, 7, 'doc7-1636978475.jpg', '2021-11-15 10:14:35', '2021-11-15 10:14:35', NULL),
(173, 16, 9, 'doc9-1636978475.jpg', '2021-11-15 10:14:35', '2021-11-15 10:14:35', NULL),
(174, 16, 11, 'doc11-1636978475.png', '2021-11-15 10:14:35', '2021-11-15 10:14:35', NULL),
(175, 17, 2, 'doc2-1637059889.jpg', '2021-11-16 08:51:29', '2021-11-16 08:51:29', NULL),
(176, 17, 3, 'doc3-1637059889.jpg', '2021-11-16 08:51:29', '2021-11-16 08:51:29', NULL),
(177, 17, 5, 'doc5-1637059889.jpg', '2021-11-16 08:51:29', '2021-11-16 08:51:29', NULL),
(178, 17, 7, 'doc7-1637059889.jpg', '2021-11-16 08:51:29', '2021-11-16 08:51:29', NULL),
(179, 17, 9, 'doc9-1637059889.jpg', '2021-11-16 08:51:29', '2021-11-16 08:51:29', NULL),
(180, 17, 11, 'doc11-1637059889.jpg', '2021-11-16 08:51:29', '2021-11-16 08:51:29', NULL),
(181, 18, 2, 'doc2-1637061498.png', '2021-11-16 09:18:18', '2021-11-16 09:18:18', NULL),
(182, 18, 3, 'doc3-1637061498.png', '2021-11-16 09:18:18', '2021-11-16 09:18:18', NULL),
(183, 18, 5, 'doc5-1637061498.png', '2021-11-16 09:18:18', '2021-11-16 09:18:18', NULL),
(184, 18, 7, 'doc7-1637061498.png', '2021-11-16 09:18:18', '2021-11-16 09:18:18', NULL),
(185, 18, 9, 'doc9-1637061498.png', '2021-11-16 09:18:18', '2021-11-16 09:18:18', NULL),
(186, 18, 11, 'doc11-1637061498.jpg', '2021-11-16 09:18:18', '2021-11-16 09:18:18', NULL),
(187, 19, 2, 'doc2-1637063054.png', '2021-11-16 09:44:15', '2021-11-16 09:44:15', NULL),
(188, 19, 3, 'doc3-1637063054.png', '2021-11-16 09:44:15', '2021-11-16 09:44:15', NULL),
(189, 19, 5, 'doc5-1637063054.png', '2021-11-16 09:44:15', '2021-11-16 09:44:15', NULL),
(190, 19, 7, 'doc7-1637063054.png', '2021-11-16 09:44:15', '2021-11-16 09:44:15', NULL),
(191, 19, 9, 'doc9-1637063054.png', '2021-11-16 09:44:15', '2021-11-16 09:44:15', NULL),
(192, 19, 11, 'doc11-1637063054.png', '2021-11-16 09:44:15', '2021-11-16 09:44:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `business_information`
--

CREATE TABLE `business_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `company_zone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_street_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_building_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_floor_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_appartment_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_incharge_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_incharge_mobile` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_incharge_email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_id_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cnic',
  `person_id_no` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `person_id_front_image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `person_id_back_image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_information`
--

INSERT INTO `business_information` (`id`, `user_id`, `company_name`, `country_id`, `city_id`, `company_zone_no`, `company_street_no`, `company_building_no`, `company_floor_no`, `company_appartment_no`, `company_address`, `person_incharge_name`, `person_incharge_mobile`, `person_incharge_email`, `person_id_type`, `person_id_no`, `person_id_front_image`, `person_id_back_image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, 2, 'Vendor1', 1, 1, '34', '23', '65', '2', '77', NULL, 'Minhas', '0302451234525', 'minhaskharal.storak@gmail.com', '1', '352028984556215', 'front1636963719.jpg', 'back1636963719.jpg', '2021-11-15 06:08:40', '2021-11-15 06:08:40', NULL),
(14, 109, 'RR Electronics', 1, 1, '00', '00', '00', '00', '00', '00000000', 'Rabail Rana', '0000000000000', 'socialmedia@storakdigital.com', '1', '000000000000000', 'front1636969126.png', 'back1636969126.png', '2021-11-15 07:38:46', '2021-11-15 07:38:46', NULL),
(15, 80, 'Vendor2', 1, 1, '344', '454', '334', '1', '55', NULL, 'Minhas2', '0300448444444', 'minhas.storak@gmail.com', '1', '3520254544151552', 'front1636974258.jpg', 'back1636974258.jpg', '2021-11-15 09:03:58', '2021-11-15 09:04:18', NULL),
(16, 124, 'Storak Digital', 1, 3, '55', '34', '5544', '4', '342', NULL, 'Minhas Kharal', '03024076498', 'minhaskharal.storak@gmail.com', '1', '352028944524555', 'front1636978427.jpg', 'back1636978427.jpg', '2021-11-15 10:13:47', '2021-11-15 10:13:47', NULL),
(17, 125, 'Storak Digital2', 1, 7, '5544', '343', '11', '5', '654', NULL, 'Minhas Jutt', '0305415005080', 'minhas.storak@gmail.com', '1', '352020255484584', 'front1637059770.png', 'back1637059770.png', '2021-11-16 08:49:30', '2021-11-16 08:49:30', NULL),
(18, 126, 'Vendor3', 1, 1, '23', '232', '2312', '6', '3', NULL, 'Minhas Jutt2', '0870444800404', 'minhas.storak@gmail.com', '1', '925508001018157', 'front1637061460.png', 'back1637061460.png', '2021-11-16 09:17:40', '2021-11-16 09:17:40', NULL),
(19, 127, 'Vendor1', 1, 1, '34', 'E1 Johar Town', '65', '1', '77', NULL, 'Minhas Kharal', '0321504848400', 'minhaskharal.storak@gmail.com', '1', '909000595989950', 'front1637062987.png', 'back1637062987.png', '2021-11-16 09:43:07', '2021-11-16 09:43:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_id`, `product_id`, `product_variant_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(70, 128, 236, 260, 1, 10690, '2021-11-17 15:40:35', '2021-11-17 19:25:23'),
(81, 110, 237, 263, 1, 299, '2021-11-25 03:34:00', '2021-11-25 04:41:30'),
(82, 110, 237, 266, 1, 599, '2021-11-25 03:39:35', '2021-11-25 03:39:35'),
(83, 110, 241, 280, 2, 0, '2021-11-25 04:42:49', '2021-11-25 06:25:21'),
(84, 110, 240, 278, 1, 699, '2021-11-25 06:33:00', '2021-11-25 06:33:00'),
(85, 110, 237, 265, 1, 499, '2021-11-25 07:39:40', '2021-11-25 07:39:40'),
(86, 110, 237, 264, 1, 399, '2021-11-26 02:21:40', '2021-11-26 02:21:40'),
(89, 114, 242, 286, 7, 299, '2021-11-30 01:56:41', '2021-11-30 06:51:59'),
(90, 114, 248, 294, 1, 1320, '2021-12-01 00:00:15', '2021-12-01 00:00:15');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `popular` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `logo_image`, `banner_image`, `mobile_image`, `featured`, `status`, `popular`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Electronics', 'this is dumy description for electronics category', '1626355913.jpg', '1624517615.jpg', '1626418162.png', 1, 1, 1, '2021-06-24 01:53:36', '2021-07-16 01:49:22', NULL),
(9, 'Mobile Phone', NULL, '1626497993.png', '1625315106.jpg', '1626418200.png', 1, 1, 1, '2021-06-29 04:54:24', '2021-07-16 23:59:54', NULL),
(10, 'Cameras', NULL, '1626498055.png', '1625315158.jpg', '1626418253.png', 0, 1, 0, '2021-06-29 04:56:14', '2021-07-17 00:00:56', NULL),
(11, 'Laptop & Computers', NULL, '1626498148.png', '1625315183.jpg', '1626418292.png', 1, 1, 1, '2021-06-29 04:56:41', '2021-07-17 00:02:28', NULL),
(12, 'Women`s Store', NULL, '1626498228.png', '1625315240.jpg', '1626418319.png', 1, 1, 1, '2021-06-29 04:57:25', '2021-07-17 00:03:49', NULL),
(13, 'Men`s Store', NULL, '1626498294.png', '1625315286.jpg', '1626418343.png', 1, 1, 1, '2021-06-29 04:57:58', '2021-07-17 00:04:54', NULL),
(14, 'Baby & Toys', NULL, '1626498355.png', NULL, '1626418368.png', 1, 1, 1, '2021-06-29 05:06:55', '2021-07-17 00:05:55', NULL),
(15, 'Health Care', NULL, '1626498433.png', NULL, '1626418396.png', 1, 1, 0, '2021-06-29 05:07:34', '2021-07-17 00:07:14', NULL),
(16, 'Sports & Gamming', NULL, '1626498518.png', '1625315321.jpg', '1626418421.png', 0, 1, 0, '2021-06-29 05:08:12', '2021-07-17 00:08:38', NULL),
(17, 'Kitchen & Home Decor', NULL, '1626498602.png', '1625315354.jpg', '1626418448.png', 0, 1, 0, '2021-06-29 05:08:51', '2021-07-17 00:10:03', NULL),
(18, 'Others', NULL, '1627301085.png', NULL, '1627301146.png', 0, 1, 0, '2021-06-29 05:09:24', '2021-07-26 07:05:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `child_categories`
--

CREATE TABLE `child_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `popular` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `child_categories`
--

INSERT INTO `child_categories` (`id`, `category_id`, `subcategory_id`, `title`, `description`, `image`, `status`, `featured`, `popular`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 9, 1, 'Apple iPhone', NULL, NULL, 1, 0, 0, '2021-06-25 07:51:39', '2021-06-29 06:56:11', NULL),
(2, 9, 1, 'Android Phone', NULL, NULL, 1, 0, 0, '2021-06-25 07:52:26', '2021-06-29 06:57:03', NULL),
(3, 9, 1, 'Others', NULL, NULL, 1, 0, 0, '2021-06-29 06:58:50', '2021-06-29 07:01:04', NULL),
(4, 9, 11, 'Apple ipad', NULL, NULL, 1, 0, 0, '2021-06-29 07:04:15', '2021-06-29 07:04:45', NULL),
(5, 9, 11, 'Others', NULL, NULL, 1, 0, 0, '2021-06-29 07:06:02', '2021-06-29 07:06:02', NULL),
(6, 9, 12, 'Apple ACCY', NULL, NULL, 1, 0, 0, '2021-06-29 07:07:04', '2021-06-29 07:07:04', NULL),
(7, 9, 12, 'Mobile Chargers', NULL, NULL, 1, 0, 0, '2021-06-29 07:07:26', '2021-06-29 07:07:26', NULL),
(8, 9, 12, 'Handfree & Headphones', NULL, NULL, 1, 0, 0, '2021-06-29 07:07:45', '2021-06-29 07:07:45', NULL),
(10, 9, 12, 'Mobile Cases', NULL, NULL, 1, 0, 0, '2021-06-29 07:08:40', '2021-06-29 07:08:40', NULL),
(11, 9, 12, 'Mobile Protectors', NULL, NULL, 1, 0, 0, '2021-06-29 07:09:01', '2021-06-29 07:09:01', NULL),
(12, 9, 12, 'Power Banks', NULL, NULL, 1, 0, 0, '2021-06-29 07:09:20', '2021-06-29 07:09:20', NULL),
(13, 9, 12, 'Memory Cards', NULL, NULL, 1, 0, 0, '2021-06-29 07:09:45', '2021-06-29 07:09:45', NULL),
(14, 9, 12, 'Selfie Sticks', NULL, NULL, 1, 0, 0, '2021-06-29 07:10:04', '2021-06-29 07:10:04', NULL),
(15, 9, 12, 'Mobile Batteries', NULL, NULL, 1, 0, 0, '2021-06-29 07:10:28', '2021-06-29 07:10:28', NULL),
(16, 9, 12, 'Speakers & Docks', NULL, NULL, 1, 0, 0, '2021-06-29 07:10:55', '2021-06-29 07:10:55', NULL),
(17, 9, 12, 'Others Mobile ACCY', NULL, NULL, 1, 0, 0, '2021-06-29 07:11:18', '2021-06-29 07:11:18', NULL),
(18, 9, 13, 'Apple ACCY', NULL, NULL, 1, 0, 0, '2021-06-29 07:11:48', '2021-06-29 07:11:48', NULL),
(19, 9, 13, 'Smart Watches', NULL, NULL, 1, 0, 0, '2021-06-29 07:12:11', '2021-06-29 07:12:11', NULL),
(20, 9, 13, 'Smart VR Glasses', NULL, NULL, 1, 0, 0, '2021-06-29 07:12:28', '2021-06-29 07:12:28', NULL),
(21, 9, 13, 'Smart Bands', NULL, NULL, 1, 0, 0, '2021-06-29 07:12:51', '2021-06-29 07:12:51', NULL),
(22, 9, 13, 'Others Smart ACCY', NULL, NULL, 1, 0, 0, '2021-06-29 07:13:10', '2021-06-29 07:13:10', NULL),
(23, 1, 14, 'QLED', NULL, NULL, 1, 0, 0, '2021-06-29 07:14:08', '2021-06-29 07:14:08', NULL),
(24, 1, 14, '4K & 8K', NULL, NULL, 1, 0, 0, '2021-06-29 07:17:51', '2021-06-29 07:17:51', NULL),
(25, 1, 14, 'Smart TV', NULL, NULL, 1, 0, 0, '2021-06-29 23:55:19', '2021-06-29 23:55:19', NULL),
(26, 1, 14, 'Full HD', NULL, NULL, 1, 0, 0, '2021-06-29 23:55:52', '2021-06-29 23:55:52', NULL),
(27, 1, 14, 'Others', NULL, NULL, 1, 0, 0, '2021-06-29 23:56:14', '2021-06-29 23:56:14', NULL),
(28, 1, 15, 'Room Size Ref', NULL, NULL, 1, 0, 0, '2021-06-29 23:56:53', '2021-06-29 23:56:53', NULL),
(29, 1, 15, 'Inverter Ref', NULL, NULL, 1, 0, 0, '2021-06-29 23:57:16', '2021-06-29 23:57:16', NULL),
(30, 1, 15, 'NO-Frost', NULL, NULL, 1, 0, 0, '2021-06-29 23:57:34', '2021-06-29 23:57:34', NULL),
(31, 1, 15, 'Direct Cool', NULL, NULL, 1, 0, 0, '2021-06-29 23:57:52', '2021-06-29 23:57:52', NULL),
(32, 1, 16, 'Below 1.0 Ton', NULL, NULL, 1, 0, 0, '2021-06-30 00:14:36', '2021-06-30 00:14:36', NULL),
(33, 1, 16, 'Inverter 1.0 Ton', NULL, NULL, 1, 0, 0, '2021-06-30 00:15:02', '2021-06-30 00:15:02', NULL),
(34, 1, 16, 'Inverter 1.5 Ton', NULL, NULL, 1, 0, 0, '2021-06-30 00:15:21', '2021-06-30 00:15:21', NULL),
(35, 1, 16, 'Inverter 2.0 Ton', NULL, NULL, 1, 0, 0, '2021-06-30 00:15:39', '2021-06-30 00:15:39', NULL),
(36, 1, 16, 'Split 1.0 Ton', NULL, NULL, 1, 0, 0, '2021-06-30 00:16:21', '2021-06-30 00:16:21', NULL),
(37, 1, 16, 'Split 1.5 Ton', NULL, NULL, 1, 0, 0, '2021-06-30 00:16:40', '2021-06-30 00:16:40', NULL),
(38, 1, 16, 'Split 2.0 Ton', NULL, NULL, 1, 0, 0, '2021-06-30 00:16:59', '2021-06-30 00:16:59', NULL),
(39, 1, 16, 'Window AC', NULL, NULL, 1, 0, 0, '2021-06-30 00:17:15', '2021-06-30 00:17:15', NULL),
(40, 1, 16, 'Floor Standing & Cassette', NULL, NULL, 1, 0, 0, '2021-06-30 00:17:32', '2021-06-30 00:17:32', NULL),
(41, 1, 17, 'Fully Automatic Front Load', NULL, NULL, 1, 0, 0, '2021-06-30 00:18:05', '2021-06-30 00:18:05', NULL),
(42, 1, 17, 'Fully Automatic Top Load', NULL, NULL, 1, 0, 0, '2021-06-30 00:18:30', '2021-06-30 00:18:30', NULL),
(43, 1, 17, 'Semi-Automatic', NULL, NULL, 1, 0, 0, '2021-06-30 00:18:50', '2021-06-30 00:18:50', NULL),
(44, 1, 17, 'Single Washer', NULL, NULL, 1, 0, 0, '2021-06-30 00:19:15', '2021-06-30 00:19:15', NULL),
(45, 1, 17, 'Single Dryer', NULL, NULL, 1, 0, 0, '2021-06-30 00:19:33', '2021-06-30 00:19:33', NULL),
(46, 1, 18, 'Bottom Load', NULL, NULL, 1, 0, 0, '2021-06-30 00:20:04', '2021-06-30 00:20:04', NULL),
(47, 1, 18, 'Top Load', NULL, NULL, 1, 0, 0, '2021-06-30 00:20:21', '2021-06-30 00:20:21', NULL),
(48, 1, 18, 'Table Top', NULL, NULL, 1, 0, 0, '2021-06-30 00:20:39', '2021-06-30 00:20:39', NULL),
(49, 1, 19, 'Inverter MWO', NULL, NULL, 1, 0, 0, '2021-06-30 00:21:09', '2021-06-30 00:21:09', NULL),
(50, 1, 19, '20 to 23 Liter', NULL, NULL, 1, 0, 0, '2021-06-30 00:21:31', '2021-06-30 00:21:31', NULL),
(51, 1, 19, '24 to 28 Liter', NULL, NULL, 1, 0, 0, '2021-06-30 00:22:49', '2021-06-30 00:22:49', NULL),
(52, 1, 19, '29 to 32 Liter', NULL, NULL, 1, 0, 0, '2021-06-30 00:23:06', '2021-06-30 00:23:06', NULL),
(53, 1, 19, '33 Liter & Above', NULL, NULL, 1, 0, 0, '2021-06-30 00:23:23', '2021-06-30 00:23:23', NULL),
(54, 1, 20, 'Air Fryer', NULL, NULL, 1, 0, 0, '2021-06-30 00:23:59', '2021-06-30 00:23:59', NULL),
(55, 1, 20, 'Deep Fryer', NULL, NULL, 1, 0, 0, '2021-06-30 00:24:19', '2021-06-30 00:24:19', NULL),
(56, 1, 20, 'Coffee Makers', NULL, NULL, 1, 0, 0, '2021-06-30 00:24:36', '2021-06-30 00:24:36', NULL),
(57, 1, 20, 'Induction Cookers', NULL, NULL, 1, 0, 0, '2021-06-30 00:24:58', '2021-06-30 00:24:58', NULL),
(58, 1, 20, 'Oven Toaster', NULL, NULL, 1, 0, 0, '2021-06-30 00:25:20', '2021-06-30 00:25:20', NULL),
(59, 1, 20, 'Food Processor', NULL, NULL, 1, 0, 0, '2021-06-30 00:25:37', '2021-06-30 00:25:37', NULL),
(60, 1, 20, 'Juicers', NULL, NULL, 1, 0, 0, '2021-06-30 00:25:55', '2021-06-30 00:25:55', NULL),
(61, 1, 20, 'Blenders', NULL, NULL, 1, 0, 0, '2021-06-30 00:26:14', '2021-06-30 00:26:14', NULL),
(62, 1, 20, 'Citrus Juicer', NULL, NULL, 1, 0, 0, '2021-06-30 00:26:33', '2021-06-30 00:26:33', NULL),
(63, 1, 20, 'Hand Blenders', NULL, NULL, 1, 0, 0, '2021-06-30 00:26:50', '2021-06-30 00:26:50', NULL),
(64, 1, 20, 'Juice Extractor', NULL, NULL, 1, 0, 0, '2021-06-30 00:27:07', '2021-06-30 00:27:07', NULL),
(65, 1, 20, 'Kettle & Teapots', NULL, NULL, 1, 0, 0, '2021-06-30 00:27:26', '2021-06-30 00:27:26', NULL),
(66, 1, 20, 'Sandwich Maker', NULL, NULL, 1, 0, 0, '2021-06-30 00:27:44', '2021-06-30 00:27:44', NULL),
(67, 1, 20, 'Toaster', NULL, NULL, 1, 0, 0, '2021-06-30 00:28:34', '2021-06-30 00:28:34', NULL),
(68, 1, 20, 'Vacuum Cleaner', NULL, NULL, 1, 0, 0, '2021-06-30 00:29:27', '2021-06-30 00:29:27', NULL),
(69, 1, 20, 'Iron & Laundry', NULL, NULL, 1, 0, 0, '2021-06-30 00:29:46', '2021-06-30 00:29:46', NULL),
(70, 1, 20, 'Others', NULL, NULL, 1, 0, 0, '2021-06-30 00:30:05', '2021-06-30 00:30:05', NULL),
(71, 10, 24, 'Camera Lenses', NULL, NULL, 1, 0, 0, '2021-06-30 00:30:40', '2021-06-30 00:30:40', NULL),
(72, 10, 24, 'Tripod + Remote', NULL, NULL, 1, 0, 0, '2021-06-30 00:30:57', '2021-06-30 00:30:57', NULL),
(73, 10, 24, 'External Flash', NULL, NULL, 1, 0, 0, '2021-06-30 00:31:15', '2021-06-30 00:31:15', NULL),
(74, 10, 24, 'Camera Bags', NULL, NULL, 1, 0, 0, '2021-06-30 00:31:31', '2021-06-30 00:31:31', NULL),
(75, 10, 24, 'Light Reflectors', NULL, NULL, 1, 0, 0, '2021-06-30 00:31:46', '2021-06-30 00:31:46', NULL),
(76, 10, 24, 'UV Filters', NULL, NULL, 1, 0, 0, '2021-06-30 00:32:03', '2021-06-30 00:32:03', NULL),
(77, 10, 24, 'Spare Batteries', NULL, NULL, 1, 0, 0, '2021-06-30 00:32:19', '2021-06-30 00:32:19', NULL),
(78, 10, 24, 'SD Card', NULL, NULL, 1, 0, 0, '2021-06-30 00:32:35', '2021-06-30 00:32:35', NULL),
(79, 11, 27, 'MacBook\'s', NULL, NULL, 1, 0, 0, '2021-06-30 00:32:58', '2021-06-30 00:32:58', NULL),
(80, 11, 27, 'Windows OS', NULL, NULL, 1, 0, 0, '2021-06-30 00:33:19', '2021-06-30 00:33:19', NULL),
(81, 11, 27, 'Tablet Notebooks', NULL, NULL, 1, 0, 0, '2021-06-30 00:33:37', '2021-06-30 00:33:37', NULL),
(82, 11, 28, 'iMac', NULL, NULL, 1, 0, 0, '2021-06-30 00:33:57', '2021-06-30 00:33:57', NULL),
(83, 11, 28, 'Others', NULL, NULL, 1, 0, 0, '2021-06-30 00:34:34', '2021-06-30 00:34:34', NULL),
(84, 11, 29, 'Notebook Bags', NULL, NULL, 1, 0, 0, '2021-06-30 00:34:56', '2021-06-30 00:34:56', NULL),
(85, 11, 29, 'Mouse', NULL, NULL, 1, 0, 0, '2021-06-30 00:35:13', '2021-06-30 00:35:13', NULL),
(86, 11, 29, 'Keyboards', NULL, NULL, 1, 0, 0, '2021-06-30 00:35:31', '2021-06-30 00:35:31', NULL),
(87, 11, 29, 'Headphones', NULL, NULL, 1, 0, 0, '2021-06-30 00:35:49', '2021-06-30 00:35:49', NULL),
(88, 11, 29, 'Speakers', NULL, NULL, 1, 0, 0, '2021-06-30 00:36:07', '2021-06-30 00:36:07', NULL),
(89, 11, 29, 'Microphones', NULL, NULL, 1, 0, 0, '2021-06-30 00:36:23', '2021-06-30 00:36:23', NULL),
(90, 11, 29, 'Web Cams', NULL, NULL, 1, 0, 0, '2021-06-30 00:36:39', '2021-06-30 00:36:39', NULL),
(91, 11, 29, 'External HDD', NULL, NULL, 1, 0, 0, '2021-06-30 00:36:56', '2021-06-30 00:36:56', NULL),
(92, 11, 29, 'USBs', NULL, NULL, 1, 0, 0, '2021-06-30 00:37:11', '2021-06-30 00:37:11', NULL),
(93, 11, 29, 'Printers', NULL, NULL, 1, 0, 0, '2021-06-30 00:37:26', '2021-06-30 00:37:26', NULL),
(94, 11, 29, 'Scanners', NULL, NULL, 1, 0, 0, '2021-06-30 00:37:43', '2021-06-30 00:37:43', NULL),
(95, 11, 29, 'Others', NULL, NULL, 1, 0, 0, '2021-06-30 00:37:59', '2021-06-30 00:37:59', NULL),
(96, 12, 30, 'Upper Wear', NULL, NULL, 1, 0, 0, '2021-06-30 00:38:33', '2021-06-30 00:38:33', NULL),
(97, 12, 30, 'Bottom Wear', NULL, NULL, 1, 0, 0, '2021-06-30 00:38:56', '2021-06-30 00:38:56', NULL),
(98, 12, 30, 'Sports Wear', NULL, NULL, 1, 0, 0, '2021-06-30 00:39:15', '2021-06-30 00:39:15', NULL),
(99, 12, 31, 'Arabic', NULL, NULL, 1, 0, 0, '2021-06-30 00:39:34', '2021-06-30 00:39:34', NULL),
(100, 12, 31, 'Indian', NULL, NULL, 1, 0, 0, '2021-06-30 00:40:01', '2021-06-30 00:40:01', NULL),
(101, 12, 31, 'Semi-Stitched', NULL, NULL, 1, 0, 0, '2021-06-30 00:40:24', '2021-06-30 00:40:24', NULL),
(102, 12, 33, 'Digital', NULL, NULL, 1, 0, 0, '2021-06-30 00:40:49', '2021-06-30 00:40:49', NULL),
(103, 12, 33, 'Analog', NULL, NULL, 1, 0, 0, '2021-06-30 00:41:06', '2021-06-30 00:41:06', NULL),
(104, 12, 34, 'Categories Require', NULL, NULL, 1, 0, 0, '2021-06-30 00:47:16', '2021-06-30 00:47:16', NULL),
(105, 12, 35, 'Deodorants', NULL, NULL, 1, 0, 0, '2021-06-30 00:47:41', '2021-06-30 00:47:41', NULL),
(106, 12, 35, 'Perfumes', NULL, NULL, 1, 0, 0, '2021-06-30 00:47:58', '2021-06-30 00:47:58', NULL),
(107, 12, 36, 'Make Up & Cosmetics', NULL, NULL, 1, 0, 0, '2021-06-30 00:48:34', '2021-06-30 00:48:34', NULL),
(108, 12, 36, 'Skin Care', NULL, NULL, 1, 0, 0, '2021-06-30 00:48:52', '2021-06-30 00:48:52', NULL),
(109, 12, 36, 'Hair Care & Styling', NULL, NULL, 1, 0, 0, '2021-06-30 00:49:09', '2021-06-30 00:49:09', NULL),
(110, 12, 36, 'Bath & Body', NULL, NULL, 1, 0, 0, '2021-06-30 00:49:26', '2021-06-30 00:49:26', NULL),
(111, 12, 36, 'Shaving & Hair Removals', NULL, NULL, 1, 0, 0, '2021-06-30 01:42:41', '2021-06-30 01:42:41', NULL),
(112, 12, 37, 'Glasses', NULL, NULL, 1, 0, 0, '2021-06-30 01:43:31', '2021-06-30 01:43:31', NULL),
(113, 12, 37, 'Jewelry', NULL, NULL, 1, 0, 0, '2021-06-30 01:43:57', '2021-06-30 01:43:57', NULL),
(114, 12, 37, 'Bags & Wallets', NULL, NULL, 1, 0, 0, '2021-06-30 01:44:44', '2021-06-30 01:44:44', NULL),
(115, 12, 37, 'Hat, Caps & Gloves', NULL, NULL, 1, 0, 0, '2021-06-30 01:45:17', '2021-06-30 01:45:17', NULL),
(116, 12, 37, 'Belts & others', NULL, NULL, 1, 0, 0, '2021-06-30 01:47:37', '2021-06-30 01:47:37', NULL),
(117, 13, 38, 'Arabic', NULL, NULL, 1, 0, 0, '2021-06-30 01:48:48', '2021-06-30 01:48:48', NULL),
(118, 13, 38, 'Indian', NULL, NULL, 1, 0, 0, '2021-06-30 01:49:35', '2021-06-30 01:49:35', NULL),
(119, 13, 39, 'Upper Wear', NULL, NULL, 1, 0, 0, '2021-06-30 01:50:11', '2021-06-30 01:50:11', NULL),
(120, 13, 39, 'Bottom wear', NULL, NULL, 1, 0, 0, '2021-06-30 01:50:53', '2021-06-30 01:50:53', NULL),
(121, 13, 39, 'Sports Wear', NULL, NULL, 1, 0, 0, '2021-06-30 01:51:12', '2021-06-30 01:51:12', NULL),
(122, 13, 40, 'Digital', NULL, NULL, 1, 0, 0, '2021-06-30 02:10:05', '2021-06-30 02:10:05', NULL),
(123, 13, 40, 'Analog', NULL, NULL, 1, 0, 0, '2021-06-30 02:10:26', '2021-06-30 02:10:26', NULL),
(124, 13, 43, 'Deodorants', NULL, NULL, 1, 0, 0, '2021-06-30 04:38:45', '2021-06-30 04:38:45', NULL),
(125, 13, 43, 'Perfumes', NULL, NULL, 1, 0, 0, '2021-06-30 04:39:15', '2021-06-30 04:39:15', NULL),
(126, 13, 44, 'Shavers & Trimmers', NULL, NULL, 1, 0, 0, '2021-06-30 04:39:35', '2021-06-30 04:39:35', NULL),
(127, 13, 44, 'Grooming', NULL, NULL, 1, 0, 0, '2021-06-30 04:39:55', '2021-06-30 04:39:55', NULL),
(128, 13, 44, 'Hair Care', NULL, NULL, 1, 0, 0, '2021-06-30 04:40:23', '2021-06-30 04:40:23', NULL),
(129, 13, 44, 'Bathing', NULL, NULL, 1, 0, 0, '2021-06-30 04:40:41', '2021-06-30 04:40:41', NULL),
(130, 13, 45, 'Glasses', NULL, NULL, 1, 0, 0, '2021-06-30 04:41:58', '2021-06-30 04:41:58', NULL),
(131, 13, 45, 'Jewelry', NULL, NULL, 1, 0, 0, '2021-06-30 04:42:42', '2021-06-30 04:42:42', NULL),
(132, 13, 45, 'Wallets', NULL, NULL, 1, 0, 0, '2021-06-30 04:43:05', '2021-06-30 04:43:05', NULL),
(133, 13, 45, 'Belts & others', NULL, NULL, 1, 0, 0, '2021-06-30 04:43:28', '2021-06-30 04:43:28', NULL),
(134, 14, 46, 'Girls Wear', NULL, NULL, 1, 0, 0, '2021-06-30 04:43:54', '2021-06-30 04:43:54', NULL),
(135, 14, 46, 'Boy Wear', NULL, NULL, 1, 0, 0, '2021-06-30 04:44:14', '2021-06-30 04:44:14', NULL),
(136, 14, 47, 'Bathing & Body', NULL, NULL, 1, 0, 0, '2021-06-30 04:44:54', '2021-06-30 04:44:54', NULL),
(137, 14, 47, 'Feeding', NULL, NULL, 1, 0, 0, '2021-06-30 04:45:17', '2021-06-30 04:45:17', NULL),
(138, 14, 47, 'Maternity Care', NULL, NULL, 1, 0, 0, '2021-06-30 04:45:38', '2021-06-30 04:45:38', NULL),
(139, 14, 47, 'Baby Toys', NULL, NULL, 1, 0, 0, '2021-06-30 04:45:56', '2021-06-30 04:45:56', NULL),
(140, 14, 47, 'Strollers & gadgets', NULL, NULL, 1, 0, 0, '2021-06-30 04:46:15', '2021-06-30 04:46:15', NULL),
(141, 14, 47, 'Skin Care', NULL, NULL, 1, 0, 0, '2021-06-30 04:46:36', '2021-06-30 04:46:36', NULL),
(142, 14, 47, 'Diapers & potty Training', NULL, NULL, 1, 0, 0, '2021-06-30 04:46:54', '2021-06-30 04:46:54', NULL),
(143, 14, 47, 'Baby Bedding', NULL, NULL, 1, 0, 0, '2021-06-30 04:47:29', '2021-06-30 04:47:29', NULL),
(144, 14, 47, 'Baby Furniture', NULL, NULL, 1, 0, 0, '2021-06-30 04:48:04', '2021-06-30 04:48:04', NULL),
(145, 16, 53, 'PlayStation', NULL, NULL, 1, 0, 0, '2021-06-30 04:49:22', '2021-06-30 04:49:22', NULL),
(146, 16, 53, 'Xbox', NULL, NULL, 1, 0, 0, '2021-06-30 04:49:43', '2021-06-30 04:49:43', NULL),
(147, 16, 53, 'Nintendo', NULL, NULL, 1, 0, 0, '2021-06-30 04:50:08', '2021-06-30 04:50:08', NULL),
(148, 16, 53, 'Portable Console', NULL, NULL, 1, 0, 0, '2021-06-30 04:50:31', '2021-06-30 04:50:31', NULL),
(149, 16, 54, 'PlayStation', NULL, NULL, 1, 0, 0, '2021-06-30 04:50:53', '2021-06-30 04:50:53', NULL),
(150, 16, 55, 'Controllers', NULL, NULL, 1, 0, 0, '2021-06-30 04:59:08', '2021-06-30 04:59:08', NULL),
(151, 16, 55, 'Headsets', NULL, NULL, 1, 0, 0, '2021-06-30 04:59:41', '2021-06-30 04:59:41', NULL),
(152, 16, 55, 'VR Glasses', NULL, NULL, 1, 0, 0, '2021-06-30 04:59:59', '2021-06-30 04:59:59', NULL),
(153, 16, 55, 'Subscriptions Cards', NULL, NULL, 1, 0, 0, '2021-06-30 05:00:26', '2021-06-30 05:00:26', NULL),
(154, 16, 55, 'Racing Tools', NULL, NULL, 1, 0, 0, '2021-06-30 05:01:00', '2021-06-30 05:01:00', NULL),
(155, 16, 55, 'Camera', NULL, NULL, 1, 0, 0, '2021-06-30 05:01:22', '2021-06-30 05:01:22', NULL),
(156, 16, 55, 'Cables', NULL, NULL, 1, 0, 0, '2021-06-30 05:01:44', '2021-06-30 05:01:44', NULL),
(157, 16, 56, 'Football', NULL, NULL, 1, 0, 0, '2021-06-30 05:02:15', '2021-06-30 05:02:15', NULL),
(158, 16, 56, 'Cricket', NULL, NULL, 1, 0, 0, '2021-06-30 05:02:40', '2021-06-30 05:02:40', NULL),
(159, 16, 56, 'Basket Ball', NULL, NULL, 1, 0, 0, '2021-06-30 05:03:09', '2021-06-30 05:03:09', NULL),
(160, 16, 57, 'Badminton', NULL, NULL, 1, 0, 0, '2021-06-30 05:03:31', '2021-06-30 05:03:31', NULL),
(161, 16, 57, 'Tanis', NULL, NULL, 1, 0, 0, '2021-06-30 05:04:05', '2021-06-30 05:04:05', NULL),
(162, 16, 57, 'Others', NULL, NULL, 1, 0, 0, '2021-06-30 05:04:40', '2021-06-30 05:04:40', NULL),
(163, 16, 58, 'Treadmill others', NULL, NULL, 1, 0, 0, '2021-06-30 05:05:11', '2021-06-30 05:05:11', NULL),
(164, 16, 58, 'Cardio Equipment', NULL, NULL, 1, 0, 0, '2021-06-30 05:05:55', '2021-06-30 05:05:55', NULL),
(165, 16, 58, 'Strength Equipment', NULL, NULL, 1, 0, 0, '2021-06-30 05:06:18', '2021-06-30 05:06:18', NULL),
(166, 16, 58, 'Fitness Accessories', NULL, NULL, 1, 0, 0, '2021-06-30 05:06:44', '2021-06-30 05:06:44', NULL),
(167, 16, 58, 'Boxing', NULL, NULL, 1, 0, 0, '2021-06-30 05:07:14', '2021-06-30 05:07:14', NULL),
(168, 16, 58, 'Weight', NULL, NULL, 1, 0, 0, '2021-06-30 05:07:40', '2021-06-30 05:07:40', NULL),
(169, 16, 58, 'Yoga', NULL, NULL, 1, 0, 0, '2021-06-30 05:08:11', '2021-06-30 05:08:11', NULL),
(170, 16, 58, 'Exercise Bikes', NULL, NULL, 1, 0, 0, '2021-06-30 05:08:31', '2021-06-30 05:08:31', NULL),
(171, 16, 58, 'Exercise Bands', NULL, NULL, 1, 0, 0, '2021-06-30 05:09:16', '2021-06-30 05:09:16', NULL),
(172, 16, 58, 'Outdoor Sports', NULL, NULL, 1, 0, 0, '2021-06-30 05:09:36', '2021-06-30 05:09:36', NULL),
(173, 16, 58, 'Gadgets', NULL, NULL, 1, 0, 0, '2021-06-30 05:10:02', '2021-06-30 05:10:02', NULL),
(174, 16, 58, 'Sports Accessories', NULL, NULL, 1, 0, 0, '2021-06-30 05:10:33', '2021-06-30 05:10:33', NULL),
(175, 16, 59, 'Proteins', NULL, NULL, 1, 0, 0, '2021-06-30 05:11:18', '2021-06-30 05:11:18', NULL),
(176, 16, 59, 'Post Workout & Recovery', NULL, NULL, 1, 0, 0, '2021-06-30 05:11:44', '2021-06-30 05:11:44', NULL),
(177, 16, 59, 'Pre Workout', NULL, NULL, 1, 0, 0, '2021-06-30 05:12:06', '2021-06-30 05:12:06', NULL),
(178, 16, 59, 'Fat Burners', NULL, NULL, 1, 0, 0, '2021-06-30 05:12:32', '2021-06-30 05:12:32', NULL),
(179, 16, 60, 'Men Shoes', NULL, NULL, 1, 0, 0, '2021-06-30 05:13:10', '2021-06-30 05:13:10', NULL),
(180, 16, 60, 'Men Clothing', NULL, NULL, 1, 0, 0, '2021-06-30 05:14:08', '2021-06-30 05:14:08', NULL),
(181, 16, 60, 'Men Accessories', NULL, NULL, 1, 0, 0, '2021-06-30 05:14:30', '2021-06-30 05:14:30', NULL),
(182, 16, 60, 'Women Shoes', NULL, NULL, 1, 0, 0, '2021-06-30 05:14:48', '2021-06-30 05:14:48', NULL),
(183, 16, 60, 'Women Clothing', NULL, NULL, 1, 0, 0, '2021-06-30 05:16:45', '2021-06-30 05:16:45', NULL),
(184, 16, 60, 'Women Accessories', NULL, NULL, 1, 0, 0, '2021-06-30 05:17:19', '2021-06-30 05:17:19', NULL),
(185, 18, 69, 'Car Mats', NULL, NULL, 1, 0, 0, '2021-06-30 05:18:18', '2021-06-30 05:18:18', NULL),
(186, 18, 69, 'Car tool Kits', NULL, NULL, 1, 0, 0, '2021-06-30 05:18:38', '2021-06-30 05:18:38', NULL),
(187, 18, 69, 'Cushions', NULL, NULL, 1, 0, 0, '2021-06-30 05:18:58', '2021-06-30 05:18:58', NULL),
(188, 18, 69, 'Cleaner', NULL, NULL, 1, 0, 0, '2021-06-30 05:19:16', '2021-06-30 05:19:16', NULL),
(189, 18, 69, 'Puncher kit', NULL, NULL, 1, 0, 0, '2021-06-30 05:19:37', '2021-06-30 05:19:37', NULL),
(190, 18, 69, 'Others', NULL, NULL, 1, 0, 0, '2021-06-30 05:20:34', '2021-06-30 05:20:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Doha', 1, '2021-05-31 21:51:23', '2021-06-01 01:32:43', NULL),
(2, 1, 'Al Shamal', 1, '2021-05-31 23:09:34', '2021-06-01 01:45:02', NULL),
(3, 1, 'Al Khor', 1, '2021-05-31 21:52:23', '2021-06-01 02:32:43', NULL),
(4, 1, 'Al-Shahaniya', 1, '2021-06-01 00:09:34', '2021-06-01 02:45:02', NULL),
(5, 1, 'Umm Salal', 1, '2021-05-31 21:51:23', '2021-06-01 01:32:43', NULL),
(6, 1, 'Al Daayen', 1, '2021-05-31 23:09:34', '2021-06-01 01:45:02', NULL),
(7, 1, 'Al Rayyan', 1, '2021-05-31 21:52:23', '2021-06-01 02:32:43', NULL),
(8, 1, 'Al Wakrah', 1, '2021-06-01 00:09:34', '2021-06-01 02:45:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Qatar', 1, '2021-08-07 09:52:02', '2021-08-07 09:52:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apply_to` enum('store','sku') COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `discount_type` enum('percent','amount') COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_value` int(11) NOT NULL,
  `minimum_order_value` int(11) DEFAULT NULL,
  `status` enum('enable','disable') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'enable',
  `remaining_coupons` int(11) NOT NULL,
  `per_user_limit` int(11) NOT NULL DEFAULT 1,
  `start_at` timestamp NULL DEFAULT NULL,
  `expire_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_product_variant`
--

CREATE TABLE `coupon_product_variant` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_variant_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_user`
--

CREATE TABLE `coupon_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `document_title`, `document_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Qatar Id', 1, '2021-07-23 02:42:51', '2021-07-23 03:22:23', NULL),
(2, 'Commercial Registration', 1, '2021-07-23 02:45:33', '2021-07-23 02:45:33', NULL),
(3, 'Municipal License', 1, '2021-07-23 03:22:03', '2021-07-23 03:22:03', NULL),
(4, 'Company Computer Card', 1, '2021-07-24 04:22:42', '2021-07-24 04:22:42', NULL),
(5, 'Tax Card', 1, '2021-07-24 04:23:00', '2021-07-24 04:23:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `document_inputs`
--

CREATE TABLE `document_inputs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document_id` bigint(20) UNSIGNED NOT NULL,
  `input_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_inputs`
--

INSERT INTO `document_inputs` (`id`, `document_id`, `input_name`, `input_type`, `input_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Qatar Id Number', 'text', 0, '2021-07-24 06:13:27', '2021-07-24 06:13:27', NULL),
(2, 1, 'Qatar Id Front Image', 'file', 1, '2021-07-24 06:13:27', '2021-07-24 06:13:27', NULL),
(3, 1, 'Qatar Id Back Image', 'file', 1, '2021-07-24 06:13:27', '2021-07-24 06:13:27', NULL),
(4, 2, 'Commercial Registration Number', 'text', 0, '2021-07-24 06:13:27', '2021-07-24 06:13:27', NULL),
(5, 2, 'Commercial Registration Document', 'file', 1, '2021-07-24 06:13:27', '2021-07-24 06:13:27', NULL),
(6, 3, 'Municipal License Number', 'text', 0, '2021-07-24 06:13:27', '2021-07-24 06:13:27', NULL),
(7, 3, 'Municipal License Document', 'file', 1, '2021-07-24 06:13:27', '2021-07-24 06:13:27', NULL),
(8, 4, 'Company Computer Card Number', 'text', 0, '2021-07-24 06:13:27', '2021-07-24 06:13:27', NULL),
(9, 4, 'Company Computer Card Document', 'file', 1, '2021-07-24 06:13:27', '2021-07-24 06:13:27', NULL),
(10, 5, 'Tax Card Number', 'text', 0, '2021-07-24 06:13:27', '2021-07-24 06:13:27', NULL),
(11, 5, 'Tax Card Document', 'file', 1, '2021-07-24 06:13:27', '2021-07-24 06:13:27', NULL);

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
-- Table structure for table `fulfillments`
--

CREATE TABLE `fulfillments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `background_color` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charges` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fulfillments`
--

INSERT INTO `fulfillments` (`id`, `name`, `background_color`, `description`, `charges`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'free', '#FD8F1F', 'free delivery -- no charges', 0, 1, NULL, NULL, NULL),
(2, 'economy', '#13548D', 'minor deliver charges', 100, 1, NULL, NULL, NULL),
(3, 'standard', '#23B198', 'standard delivery -- normal charges', 200, 1, NULL, NULL, NULL),
(4, 'express', '#CA2C20', 'Fast Delivery -- Charge you more', 400, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fulfillment_product`
--

CREATE TABLE `fulfillment_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `fulfillment_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goods_types`
--

CREATE TABLE `goods_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desccription` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `goods_types`
--

INSERT INTO `goods_types` (`id`, `title`, `desccription`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hazardous', 'it contains hazardous goods.', 1, NULL, NULL, NULL),
(2, 'Poisonous ', 'It contains poisonous goods.', 1, NULL, NULL, NULL),
(3, 'Flammable', 'it contains flammable goods.', 1, NULL, NULL, NULL),
(4, 'Glassy', 'It contains glassy goods.', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '#ffffff', 1, NULL, NULL, NULL),
(3, '#EB1C1C', 1, NULL, NULL, NULL),
(4, '#FFFF00', 1, NULL, NULL, NULL),
(5, '#000000', 1, NULL, NULL, NULL),
(8, '#0000FF', 1, NULL, NULL, NULL),
(9, '#00FF00', 1, NULL, NULL, NULL),
(12, '1cm', 1, NULL, NULL, NULL),
(13, '2cm', 1, NULL, NULL, NULL),
(14, '3cm', 1, NULL, NULL, NULL),
(15, '4cm', 1, NULL, NULL, NULL),
(16, '5cm', 1, NULL, NULL, NULL),
(17, '6cm', 1, NULL, NULL, NULL),
(18, '1feet', 1, NULL, NULL, NULL),
(19, '2feet', 1, NULL, NULL, NULL),
(20, '3feet', 1, NULL, NULL, NULL),
(21, '1inche', 1, NULL, NULL, NULL),
(22, '2inche', 1, NULL, NULL, NULL),
(23, '3inche', 1, NULL, NULL, NULL),
(24, '4inche', 1, NULL, NULL, NULL),
(25, '5inche', 1, NULL, NULL, NULL),
(26, '6inche', 1, NULL, NULL, NULL),
(27, '4feet', 1, NULL, NULL, NULL),
(28, '5feet', 1, NULL, NULL, NULL),
(29, '6feet', 1, NULL, NULL, NULL),
(30, '7cm', 1, NULL, NULL, NULL),
(31, '7feet', 1, NULL, NULL, NULL),
(32, '1(kg)', 1, NULL, NULL, NULL),
(33, '2(kg)', 1, NULL, NULL, NULL),
(34, '3(kg)', 1, NULL, NULL, NULL),
(35, '4(kg)', 1, NULL, NULL, NULL),
(36, '5(kg)', 1, NULL, NULL, NULL),
(37, '1(g)', 1, NULL, NULL, NULL),
(38, '2(g)', 1, NULL, NULL, NULL),
(39, '3(g)', 1, NULL, NULL, NULL),
(40, '4(g)', 1, NULL, NULL, NULL),
(41, '5(g)', 1, NULL, NULL, NULL),
(42, '1(mg)', 1, NULL, NULL, NULL),
(43, '2(mg)', 1, NULL, NULL, NULL),
(44, '3(mg)', 1, NULL, NULL, NULL),
(45, '4(mg)', 1, NULL, NULL, NULL),
(46, '5(mg)', 1, NULL, NULL, NULL),
(47, '1meter', 1, NULL, NULL, NULL),
(48, '2meter', 1, NULL, NULL, NULL),
(49, '3meter', 1, NULL, NULL, NULL),
(50, '4meter', 1, NULL, NULL, NULL),
(51, '5meter', 1, NULL, NULL, NULL),
(52, '8MB', 1, NULL, NULL, NULL),
(53, '16MB', 1, NULL, NULL, NULL),
(54, '32MB', 1, NULL, NULL, NULL),
(55, '128MB', 1, NULL, NULL, NULL),
(56, '64MB', 1, NULL, NULL, NULL),
(57, '8GB', 1, NULL, NULL, NULL),
(58, '16GB', 1, NULL, NULL, NULL),
(59, '32GB', 1, NULL, NULL, NULL),
(60, '64GB', 1, NULL, NULL, NULL),
(61, '128GB', 1, NULL, NULL, NULL),
(62, '1TB', 1, NULL, NULL, NULL),
(63, '8TB', 1, NULL, NULL, NULL),
(64, '16TB', 1, NULL, NULL, NULL),
(65, '2GB', 1, NULL, NULL, NULL),
(66, '6GB', 1, NULL, NULL, NULL),
(67, '1GB', 1, NULL, NULL, NULL),
(68, '8GB', 1, NULL, NULL, NULL),
(69, '3', 1, NULL, NULL, NULL),
(70, '4', 1, NULL, NULL, NULL),
(71, '5', 1, NULL, NULL, NULL),
(72, '6', 1, NULL, NULL, NULL),
(73, '6.5inches', 1, NULL, NULL, NULL),
(74, '5.5inches', 1, NULL, NULL, NULL),
(75, '4.5inches', 1, NULL, NULL, NULL),
(76, '7.5inches', 1, NULL, NULL, NULL),
(77, '8.5inches', 1, NULL, NULL, NULL),
(78, 'TFT LCD', 1, NULL, NULL, NULL),
(79, 'IPS-LCD', 1, NULL, NULL, NULL),
(80, 'Capacitive Touchscreen LCD.', 1, NULL, NULL, NULL),
(81, 'OLED', 1, NULL, NULL, NULL),
(82, 'AMOLED', 1, NULL, NULL, NULL),
(83, 'Super AMOLED', 1, NULL, NULL, NULL),
(84, '4cores', 1, NULL, NULL, NULL),
(85, '6cores', 1, NULL, NULL, NULL),
(86, '8cores', 1, NULL, NULL, NULL),
(87, '10cores', 1, NULL, NULL, NULL),
(88, '12cores', 1, NULL, NULL, NULL),
(89, 'Single Sim', 1, NULL, NULL, NULL),
(90, 'Dual Sim', 0, NULL, NULL, NULL),
(91, '2012', 1, NULL, NULL, NULL),
(92, '2013', 1, NULL, NULL, NULL),
(93, '2014', 1, NULL, NULL, NULL),
(94, '2014', 1, NULL, NULL, NULL),
(95, '2015', 1, NULL, NULL, NULL),
(96, '2016', 1, NULL, NULL, NULL),
(97, '2017', 1, NULL, NULL, NULL),
(98, '2018', 1, NULL, NULL, NULL),
(99, '2019', 1, NULL, NULL, NULL),
(100, '2020', 1, NULL, NULL, NULL),
(101, '2021', 1, NULL, NULL, NULL),
(102, '8', 1, NULL, NULL, NULL),
(103, 'Small', 1, NULL, NULL, NULL),
(104, 'Medium', 1, NULL, NULL, NULL),
(105, 'Large', 1, NULL, NULL, NULL),
(106, 'Extra Large', 1, NULL, NULL, NULL);

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_07_12_030608_create_countries_table', 1),
(5, '2021_07_12_033608_create_cities_table', 1),
(7, '2021_07_13_114613_create_documents_table', 1),
(8, '2021_07_13_141812_create_document_inputs_table', 1),
(9, '2021_07_13_155157_create_business_information_table', 1),
(10, '2021_07_13_163456_create_business_documents_table', 1),
(11, '2021_07_14_073105_create_stores_table', 1),
(12, '2021_07_14_073206_create_bank_accounts_table', 1),
(13, '2021_07_14_073332_create_warehouse_addresses_table', 1),
(14, '2021_07_14_073407_create_return_addresses_table', 1),
(15, '2021_07_24_024841_create_categories_table', 1),
(16, '2021_07_24_024950_create_sub_categories_table', 1),
(17, '2021_07_24_026123_create_child_categories_table', 1),
(18, '2021_07_24_030042_create_brands_table', 1),
(19, '2021_07_24_030527_create_brand_category_table', 1),
(20, '2021_07_24_031616_create_attributes_table', 1),
(21, '2021_07_24_032610_create_keys_table', 1),
(22, '2021_07_24_033852_create_attribute_key_table', 1),
(23, '2021_07_24_033900_create_attribute_subcategory_table', 1),
(24, '2021_07_24_034240_create_fulfillments_table', 1),
(25, '2021_07_24_034503_create_products_table', 1),
(26, '2021_07_24_034537_create_product_attributes_table', 1),
(27, '2021_07_24_034540_create_product_variants_table', 1),
(29, '2021_07_27_045806_create_vendor_requests_table', 1),
(30, '2021_08_05_151530_create_fulfillment_product_table', 1),
(31, '2021_08_06_094852_create_attribute_product_table', 1),
(32, '2021_08_07_034112_create_mobile_cover_table', 1),
(33, '2021_08_07_034231_create_partners_table', 1),
(34, '2021_08_07_34050_create_banners_table', 1),
(38, '2021_08_07_034112_create_mobile_covers_table', 2),
(44, '2021_08_10_083052_create_variant_attributes_table', 3),
(45, '2021_07_24_034553_create_product_images_table', 4),
(87, '2021_08_28_051028_create_order_status_table', 6),
(93, '2014_10_12_000000_create_users_table', 7),
(94, '2021_08_28_063332_create_orders_table', 8),
(95, '2021_08_28_063525_create_order_packages_table', 8),
(96, '2021_08_28_063938_create_order_package_items_table', 8),
(103, '2021_08_28_065352_create_notifications_table', 9),
(105, '2021_08_30_091233_create_order_package_histories_table', 10),
(111, '2021_09_24_120256_create_shipping_companies_table', 12),
(116, '2021_07_24_034240_create_goods_types_table', 13),
(118, '2021_09_24_121427_create_order_shipping_requests_table', 14),
(119, '2021_09_11_115929_create_cart_items_table', 15),
(121, '2021_09_11_120028_create_wishlist_items_table', 16),
(133, '2021_10_01_112144_create_coupons_table', 17),
(134, '2021_10_01_112220_create_coupon_user_table', 17),
(137, '2021_10_05_112220_create_coupon_product_variant_table', 18),
(139, '2021_07_12_094216_create_address_types_table', 19),
(141, '2021_07_23_093108_create_warranty_periods_table', 20),
(142, '2021_07_13_100924_create_user_addresses_table', 21),
(148, '2021_11_29_055121_create_product_reviews_table', 22),
(149, '2021_11_29_055143_create_product_average_ratings_table', 22),
(150, '2021_11_29_055150_create_review_images_table', 22),
(151, '2021_11_29_055704_create_product_questions_table', 22),
(152, '2021_11_23_063500_create_subroles_table', 23),
(153, '2021_11_23_064031_create_store_user_table', 23),
(154, '2021_11_25_045157_add_coloumn_permissions_in_subroles_table', 23),
(155, '2021_11_25_062258_create_subrole_user_table', 23);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_covers`
--

CREATE TABLE `mobile_covers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mobile_covers`
--

INSERT INTO `mobile_covers` (`id`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, '1625297282.jpg', 1, '2021-07-03 02:28:02', '2021-07-03 02:28:02', NULL),
(10, '1625297297.jpg', 1, '2021-07-03 02:28:17', '2021-07-03 02:28:17', NULL),
(11, '1625297312.jpg', 1, '2021-07-03 02:28:32', '2021-07-03 02:28:32', NULL),
(12, '1625297386.jpg', 1, '2021-07-03 02:29:46', '2021-07-03 02:29:46', NULL),
(13, '1625297399.jpg', 1, '2021-07-03 02:29:59', '2021-07-07 05:51:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `store_id`, `message`, `link`, `icon`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(417, 29, 'New Order Received - #00000001', 'vendor/orders/446', 'order', 0, '2021-11-30 01:58:46', '2021-11-30 01:58:46', NULL),
(418, 28, 'New Order Received - #00000001', 'vendor/orders/447', 'order', 0, '2021-11-30 01:58:55', '2021-11-30 01:58:55', NULL),
(419, 29, 'New Order Received - #00000269', 'vendor/orders/448', 'order', 0, '2021-11-30 01:59:13', '2021-11-30 01:59:13', NULL),
(420, 28, 'New Order Received - #00000269', 'vendor/orders/449', 'order', 0, '2021-11-30 01:59:22', '2021-11-30 01:59:22', NULL),
(421, 29, 'New Order Received - #00000270', 'vendor/orders/450', 'order', 0, '2021-11-30 06:52:06', '2021-11-30 06:52:06', NULL),
(422, 28, 'New Order Received - #00000270', 'vendor/orders/451', 'order', 0, '2021-11-30 06:52:16', '2021-11-30 06:52:16', NULL),
(423, 29, 'New Order Received - #00000271', 'vendor/orders/452', 'order', 0, '2021-11-30 06:58:13', '2021-11-30 06:58:13', NULL),
(424, 28, 'New Order Received - #00000271', 'vendor/orders/453', 'order', 0, '2021-11-30 06:58:22', '2021-11-30 06:58:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_no` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `billing_address_id` bigint(20) UNSIGNED NOT NULL,
  `shipping_address_id` bigint(20) UNSIGNED NOT NULL,
  `packages_bill` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `final_bill` int(11) NOT NULL,
  `payment_method` enum('card','cod','bank_transfer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_no`, `user_id`, `billing_address_id`, `shipping_address_id`, `packages_bill`, `discount`, `final_bill`, `payment_method`, `billing_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(269, '#00000001', 114, 26, 26, 4535, 0, 4535, 'cod', 0, '2021-11-30 01:58:46', '2021-11-30 01:58:46', NULL),
(270, '#00000269', 114, 26, 26, 4535, 0, 4535, 'cod', 0, '2021-11-30 01:59:13', '2021-11-30 01:59:13', NULL),
(271, '#00000270', 114, 26, 26, 11300, 0, 11300, 'cod', 0, '2021-11-30 06:52:06', '2021-11-30 06:52:06', NULL),
(272, '#00000271', 114, 26, 26, 22445, 0, 22445, 'cod', 0, '2021-11-30 06:58:13', '2021-11-30 06:58:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_packages`
--

CREATE TABLE `order_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `package_no` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `fulfillment_id` bigint(20) UNSIGNED NOT NULL,
  `order_status_id` bigint(20) UNSIGNED NOT NULL,
  `fulfillment_charges` bigint(20) UNSIGNED NOT NULL,
  `package_bill` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_packages`
--

INSERT INTO `order_packages` (`id`, `order_id`, `package_no`, `store_id`, `fulfillment_id`, `order_status_id`, `fulfillment_charges`, `package_bill`, `created_at`, `updated_at`, `deleted_at`) VALUES
(446, 269, '#00000001', 29, 2, 1, 100, 3715, '2021-11-30 01:58:46', '2021-11-30 01:58:46', NULL),
(447, 269, '#00000446', 28, 2, 1, 100, 620, '2021-11-30 01:58:55', '2021-11-30 01:58:55', NULL),
(448, 270, '#00000447', 29, 2, 1, 100, 3715, '2021-11-30 01:59:13', '2021-11-30 01:59:13', NULL),
(449, 270, '#00000448', 28, 2, 1, 100, 620, '2021-11-30 01:59:22', '2021-11-30 01:59:22', NULL),
(450, 271, '#00000449', 29, 2, 1, 100, 6760, '2021-11-30 06:52:06', '2021-11-30 06:52:06', NULL),
(451, 271, '#00000450', 28, 2, 1, 100, 4340, '2021-11-30 06:52:16', '2021-11-30 06:52:16', NULL),
(452, 272, '#00000451', 29, 2, 1, 100, 17905, '2021-11-30 06:58:13', '2021-11-30 06:58:13', NULL),
(453, 272, '#00000452', 28, 2, 1, 100, 4340, '2021-11-30 06:58:22', '2021-11-30 06:58:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_package_histories`
--

CREATE TABLE `order_package_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_package_id` bigint(20) UNSIGNED NOT NULL,
  `order_status_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_package_histories`
--

INSERT INTO `order_package_histories` (`id`, `order_package_id`, `order_status_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(582, 446, 1, '2021-11-30 01:58:46', '2021-11-30 01:58:46', NULL),
(583, 447, 1, '2021-11-30 01:58:55', '2021-11-30 01:58:55', NULL),
(584, 448, 1, '2021-11-30 01:59:13', '2021-11-30 01:59:13', NULL),
(585, 449, 1, '2021-11-30 01:59:22', '2021-11-30 01:59:22', NULL),
(586, 450, 1, '2021-11-30 06:52:06', '2021-11-30 06:52:06', NULL),
(587, 451, 1, '2021-11-30 06:52:16', '2021-11-30 06:52:16', NULL),
(588, 452, 1, '2021-11-30 06:58:13', '2021-11-30 06:58:13', NULL),
(589, 453, 1, '2021-11-30 06:58:22', '2021-11-30 06:58:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_package_items`
--

CREATE TABLE `order_package_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_package_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_package_items`
--

INSERT INTO `order_package_items` (`id`, `order_package_id`, `product_id`, `product_variant_id`, `quantity`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1266, 446, 248, 294, 2, 2700, '2021-11-30 01:58:46', '2021-11-30 01:58:46', NULL),
(1267, 446, 247, 293, 1, 1015, '2021-11-30 01:58:46', '2021-11-30 01:58:46', NULL),
(1268, 447, 242, 286, 1, 620, '2021-11-30 01:58:55', '2021-11-30 01:58:55', NULL),
(1269, 448, 248, 294, 2, 2700, '2021-11-30 01:59:13', '2021-11-30 01:59:13', NULL),
(1270, 448, 247, 293, 1, 1015, '2021-11-30 01:59:13', '2021-11-30 01:59:13', NULL),
(1271, 449, 242, 286, 1, 620, '2021-11-30 01:59:22', '2021-11-30 01:59:22', NULL),
(1272, 450, 248, 294, 2, 2700, '2021-11-30 06:52:06', '2021-11-30 06:52:06', NULL),
(1273, 450, 247, 293, 4, 4060, '2021-11-30 06:52:06', '2021-11-30 06:52:06', NULL),
(1274, 451, 242, 286, 7, 4340, '2021-11-30 06:52:16', '2021-11-30 06:52:16', NULL),
(1275, 452, 248, 294, 8, 10800, '2021-11-30 06:58:13', '2021-11-30 06:58:13', NULL),
(1276, 452, 247, 293, 7, 7105, '2021-11-30 06:58:13', '2021-11-30 06:58:13', NULL),
(1277, 453, 242, 286, 7, 4340, '2021-11-30 06:58:22', '2021-11-30 06:58:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_shipping_requests`
--

CREATE TABLE `order_shipping_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shipping_company_id` bigint(20) UNSIGNED NOT NULL,
  `order_package_id` bigint(20) UNSIGNED NOT NULL,
  `goods_type_id` bigint(20) UNSIGNED NOT NULL,
  `order_status_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receivable_amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_for` enum('vendors','buyers','shippers') COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `status`, `status_for`, `message`, `description`, `background_color`, `icon`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pending', 'vendors', 'Your order has been placed.', 'Your order placed but it\'s still pending .We’ll inform when it’s confirm. Don’t forget to check out our latest email..\r\nLet us know if you have questions!', '#FFA500', 'https://img.icons8.com/glyph-neue/94/000000/data-pending.png', NULL, NULL, NULL),
(2, 'Accepted', 'vendors', 'Your order has been accepted.', 'we’ve received an update that your order has been accepted by the vendor.', '#008000', 'https://img.icons8.com/clouds/94/000000/checked--v1.png', NULL, NULL, NULL),
(3, 'Rejected', 'vendors', 'Your order has been rejected.', 'we’ve received an update that your order has been rejected by the vendor unfortunately.', '#FF0000', 'https://img.icons8.com/fluency/96/000000/delete-forever.png', NULL, NULL, NULL),
(4, 'Cancelled', 'buyers', 'You have cancelled your order.', 'You have cancelled your order.', '#CA1929', 'https://img.icons8.com/dusk/94/000000/crying--v2.png', NULL, NULL, NULL),
(5, 'Ready to Ship', 'vendors', 'Your order is ready to ship.', 'Your order is ready to Ship at our location. We’ll inform when it’s time for you to pick at your address. Don’t forget to check out our latest email..', '#1A78E6', 'https://img.icons8.com/fluency/94/000000/deliver-food.png', NULL, NULL, NULL),
(6, 'Shipped', 'vendors', 'Your order has been shipped.', 'We’re excited to say that your order\r\n                is on the way ! Right now, they’re estimated to arrive around given time period .\r\n                Check out our website to look up the tracking details.', '#0067EE', 'https://img.icons8.com/ultraviolet/94/000000/shipped.png', NULL, NULL, NULL),
(7, 'Delivered', 'vendors', 'Your order has been delivered.', 'we’ve received an update that your order has been delivered. Let us know how you like your order', '#0FC40F', 'https://img.icons8.com/ultraviolet/94/000000/checked-truck.png', NULL, NULL, NULL),
(8, 'Failed to deliver', 'vendors', 'Delivery Failed', 'Your order delivery has been failed.', '#661212', 'https://img.icons8.com/fluency/94/000000/important-delivery.png', NULL, NULL, NULL),
(9, 'Returned', 'buyers', 'Your order has been returned.', 'we are sorry that you didn’t love your order, but we’re here to make it better!\r\nIf you’d like to place a new order, feel free to text this line for personal advice!\r\nOur team of experts is always happy to help , Thank you.', '#000000', 'https://img.icons8.com/nolan/94/commodity-turnover.png', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `title`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'Acer', '1624878887.jpg', 1, '2021-06-28 02:03:34', '2021-06-28 06:14:47', NULL),
(7, 'Adidas', '1624878922.jpg', 1, '2021-06-28 02:05:09', '2021-06-28 06:15:22', NULL),
(8, 'Haier', '1624878954.jpg', 1, '2021-06-28 02:06:22', '2021-06-28 06:15:54', NULL),
(9, 'Samsung', '1624879047.jpg', 1, '2021-06-28 02:08:11', '2021-06-28 06:17:27', NULL),
(10, 'Sony', '1624879083.jpg', 1, '2021-06-28 02:08:36', '2021-06-28 06:18:03', NULL),
(11, 'Toshiba', '1624879110.jpg', 1, '2021-06-28 02:08:59', '2021-06-28 06:18:30', NULL),
(12, 'Orient', '1624879254.jpg', 0, '2021-06-28 02:10:11', '2021-07-07 05:52:19', NULL);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `childcategory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `detailed_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_contents` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warranty_type` int(11) NOT NULL,
  `warranty_period_id` bigint(20) DEFAULT NULL,
  `warranty_policy` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_weight` int(11) NOT NULL,
  `package_length` int(11) NOT NULL,
  `package_width` int(11) NOT NULL,
  `package_height` int(11) NOT NULL,
  `good_type` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `subcategory_id`, `childcategory_id`, `brand_id`, `store_id`, `video_url`, `short_description`, `detailed_description`, `package_contents`, `primary_image`, `warranty_type`, `warranty_period_id`, `warranty_policy`, `package_weight`, `package_length`, `package_width`, `package_height`, `good_type`, `status`, `featured`, `created_at`, `updated_at`, `deleted_at`) VALUES
(236, 'Winter Coat', 13, 39, 119, 33, 26, NULL, 'High quality Men\'s dark grey melange stand collar hidden placket recycled woolen long parka winter coat pea coat', '<p><span style=\"color: rgb(51, 51, 51); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Tahoma, Arial, &quot;PingFang SC&quot;, &quot;Microsoft YaHei&quot;; font-size: 16px;\">High quality Men\'s dark grey melange stand collar hidden placket recycled woolen long parka winter coat pea coat</span><br></p>', 'Coat', '1636966665.jpg', 2, 1, 'Damage itiem not return', 20, 200, 400, 566, NULL, 1, 0, '2021-11-15 06:57:45', '2021-11-15 06:57:45', NULL),
(237, 'Bindas Colloection Half Sleeves Printed Tshirt For Men', 13, 39, 119, 33, 26, NULL, 'Bindas Colloection Half Sleeves Printed Tshirt For Men', '<p><span style=\"color: rgb(33, 33, 33); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 22px;\">Bindas Colloection Half Sleeves Printed Tshirt For Men</span><br></p>', 'T-Shirts', '1636967450.jpg', 2, 2, 'Damage itiems not return', 1, 15, 55, 45, NULL, 1, 0, '2021-11-15 07:10:51', '2021-11-15 07:10:51', NULL),
(238, 'Jeans', 13, 39, 120, 33, 26, NULL, 'New Men\'s Jeans 2021 Casual Wear Best Quality Jeans Fashion Design Solid Skinny Ripped Denim Jeans', '<p><span style=\"color: rgb(51, 51, 51); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Tahoma, Arial, &quot;PingFang SC&quot;, &quot;Microsoft YaHei&quot;; font-size: 16px;\">New Men\'s Jeans 2021 Casual Wear Best Quality Jeans Fashion Design Solid Skinny Ripped Denim Jeans</span><br></p>', 'Jeans', '1636967954.png', 2, 3, 'Damage item not return', 5, 34, 34, 45, NULL, 1, 0, '2021-11-15 07:19:15', '2021-11-15 07:19:15', NULL),
(239, 'PUBG printed T shirt', 13, 39, 121, 33, 26, NULL, 'High quality imported stylish PUBG printed T shirt for man in wholesale price', '<p><span style=\"color: rgb(33, 33, 33); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 22px;\">High quality imported stylish PUBG printed T shirt for man in wholesale price</span><br></p>', 'T-Shirts', '1636968522.jpg', 2, 2, 'Damage Items not return', 1, 4, 5, 45, NULL, 1, 0, '2021-11-15 07:28:43', '2021-11-15 07:28:43', NULL),
(240, 'T-shirt female loose student top', 12, 30, 96, 33, 28, NULL, 'Summer T-shirt mid long Korean summer tie dyeing trend versatile short sleeve t-shirt female loose student top', '<p><span style=\"color: rgb(51, 51, 51); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Tahoma, Arial, &quot;PingFang SC&quot;, &quot;Microsoft YaHei&quot;; font-size: 16px;\">Summer T-shirt mid long Korean summer tie dyeing trend versatile short sleeve t-shirt female loose student top</span><br></p>', 'T-Shirts', '1636975369.jpg', 2, 1, 'Damage items not return', 2, 3, 43, 5, NULL, 1, 0, '2021-11-15 09:22:50', '2021-11-15 09:22:50', NULL),
(241, 'Removeable Hooded Wholesale Coat', 12, 30, 96, 33, 28, NULL, '2021 Fashion Good Quality Women For Coat with Big Fur Removeable Hooded Wholesale Coat', '<p><span style=\"color: rgb(51, 51, 51); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Tahoma, Arial, &quot;PingFang SC&quot;, &quot;Microsoft YaHei&quot;; font-size: 16px;\">2021 Fashion Good Quality Women For Coat with Big Fur Removeable Hooded Wholesale Coat</span><br></p>', 'Coat', '1636975725.jpg', 2, 1, 'Damage items not return', 2, 4, 3, 4, NULL, 1, 0, '2021-11-15 09:28:45', '2021-11-15 09:28:45', NULL),
(242, 'long sunscreen shirt for women', 12, 30, 96, 33, 28, NULL, 'Large chiffon shirt fashion chain Print Shirt spring summer long sunscreen shirt for women', '<p><span style=\"color: rgb(51, 51, 51); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Tahoma, Arial, &quot;PingFang SC&quot;, &quot;Microsoft YaHei&quot;; font-size: 16px;\">Large chiffon shirt fashion chain Print Shirt spring summer long sunscreen shirt for women</span><br></p>', 'Shirts', '1636976048.jpg', 1, NULL, NULL, 4, 3, 5, 3, NULL, 1, 0, '2021-11-15 09:34:08', '2021-11-15 09:34:08', NULL),
(245, 'Baby play mats carpet', 16, 59, 178, 33, 29, NULL, 'hot sale baby crawling floor mat mat for baby crawling baby play mats carpet', '<p><span style=\"color: rgb(51, 51, 51); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Tahoma, Arial, &quot;PingFang SC&quot;, &quot;Microsoft YaHei&quot;; font-size: 16px;\">hot sale baby crawling floor mat mat for baby crawling baby play mats carpet</span><br></p>', 'Toys', '1636982560.jpg', 1, NULL, NULL, 34, 3, 2, 2, NULL, 1, 0, '2021-11-15 11:22:41', '2021-11-15 11:22:41', NULL);
INSERT INTO `products` (`id`, `name`, `category_id`, `subcategory_id`, `childcategory_id`, `brand_id`, `store_id`, `video_url`, `short_description`, `detailed_description`, `package_contents`, `primary_image`, `warranty_type`, `warranty_period_id`, `warranty_policy`, `package_weight`, `package_length`, `package_width`, `package_height`, `good_type`, `status`, `featured`, `created_at`, `updated_at`, `deleted_at`) VALUES
(246, 'MENS DOUBLE BREASTED WOOL PARKA COAT TRENCH MILITARY LONG COAT PEACOAT .', 13, 39, 119, 33, 26, NULL, 'test short description', '<p style=\"text-align: center; \"><span style=\"background-color: rgb(255, 0, 0);\">test detail description hello&nbsp;</span></p><p style=\"text-align: center; \"><span style=\"background-color: rgb(255, 0, 0);\"><br></span></p><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-weight: 400; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\">What is Lorem Ipsum?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p><p><img src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAgAAAAIACAYAAAD0eNT6AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAADwuSURBVHhe7Z1PyB1Zep+bEBgCDk1Mhs/jKOmJM/ru7W8hLbUJiKwarwTGoEUWvTEIgkEYLwSzkcFBiwnIYLDAGzEQkCEDcsCMZmEsmEWLYAYNA0EBBzowCy1mIQgEkUWg8/6+PjV9u/q996u36lTVOaeeBx7kHn+37p86df685z3nfAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAsAa73e5258cff3zPfJh8bL7M6X6/f2L/Xl7f3u/T7n2vX7++Sx8HAAAApnDt2rVvqXG9uLj4JDW6XYP+xvyiVK2T8M7+7ToNXWfhsqOQvhoAAABYg3nLvKuG0v59kRpOt3FtyF93EKxjcBlJSD8HAABAW5yfn390MJp/Zo39a/vXaxy37Bv7XZ7bv/qN7jC1AAAAVXHjxo0PDxp7jXTfm16Dh8PUb/jIvGOepZ8ZAABgXTS6VyjbRq9PGNkvovIgnpr3iBIAAMBiqMFX42MqlP/W/vUaKVxIuwfvNHVg3qdDAAAAWUkhfWXiF52Fj5d+bp0BLVm8o9UU6RYCAABcTTfK18jS/mUOv2LtHr4gOgAAAEdRA2ENhhL3Pj9sQLApdW8VybmZbjsAAGyRg0af0P72pDMAALAlaPTRkc4AAECLaG2+Ve7K3KfRx6tUEuED+5c9BwAAaiVl7z8zSeTDMT5TGUrFCQAASsYq7bM0giOZD3NJVAAAoFSsgr5ratmeV4Ej5pKoAADA2mijF6uQNbfPaB+XVmXuHpsNAQAsiFW8Z6aO0NX5817ljLiIqQzqsCKmBwAA5iLt0KeDYEjqw9JUmXzKjoMAABnZ7Xa3md/HWrSy+kJlNhVfAACIokrUKlSdB+9WtIiF+5KOAABAAKs4bzLix4akIwAAcAqrKGn4sWXpCAAAHJKS+7Rjn1dpIrYmHQEA2DZWEWrXvie9yhFxEypZkFUDALAptHmKVX4PTNbxI3788WMdWJUeDwCANrHK7o7Jzn2IB6ozbN5PjwkAQDukc/hZ0od42jfkBwBAE6Sz+B/3KjlEPOF+v3+u5Nj0GAEA1IWNZD5lnh9xtO/t+XmQHicAgPKxikvZ/S96lRkijvONPU+30uMFAFAmGrFYhcVhPYj5fcTxwwBQHCnJ71WvwkLEvBINAIAy6Nb0W8XEqB9xOdk7AADWI4363/QqJkRcQOt4vyUaAACLowx/q4QY9SOurCJw6bEEAJgPhfyt0nnar4QQcT2tE6BVN2fpMQUAyAshf8Ry1ZQAuwgCQHYI+SNW48P02AIAjIeQP2KV6twNpgQAYBxWgdw0CfkjVihTAgAwCqtA7pmE/BHr91F6rAEAjpNO73vWq0AQsW61SydTAgDgYxUEIX/ERt3v9+8uLi4+SY87AMCXWAVByB9xGzIlAACE/BE3KlMCAFtGjf9+v3/dqxgQcRt+bt5M1QEAbIXz8/OPUgXgVQyIuAGVF2ByoBDAVrAH/6bWCPcrA0TcpO9JDgTYAHrQ1et3KgFE3LDa7jtVEwDQGtbw37UHnUx/RDwm5wgAtIY92Frm5z3wiIi/1gYKT1K1AQC1Yw/1o/5Djoh4wmc6CCxVIQBQI/Ygc5IfIobd7/cvtFQ4VSUAUAvqvesB9h5sRMQhWh3ymk4AQEWk3f2005f7UCMiBvxc+4ak6gUASiVt8MOBPoiYzf2X+4awayBAqegBNdndDxGza52Ad7vd7naqbgCgFOwB1e5+bPCDiHPKroEAJWEPJY0/Ii4lnQCAEuBQH0Rc2jTgICcAYC1Stj8Jf4i4uOoEsDoAYAW0zt8eQpb6IeKaKvp4lqolAFgC632zyQ8irq7VRWwWBLAU9tCxvS8iFqMGJJwdADAz9rBxsA8iFqd1Ap6nagoAcmMP2H3vwUNELEGrozhKGCA39mDd9R44RMTCfJiqLQCYijbdsIfqfe8hQ0Qs1Xup+gKAsdiDxC5/iFijd1I1BgBRtMmGNf46hct7uBARS5YtgwHGYA/PmckWv4hYrSl6yZbBAEPRphr24LzuP0yIiLWpKCZbBgMMxB6Y596DhIhYqW/YKAjgCqzxZ60/Irbo01TNAUAfa/xv2UPCcj9EbNLdbvdpqu4AoCMd7UvSHyK27Pvr16/vUrUHAIJ5f0TciOQDAHQw74+IG5N8AADm/RFxi5IPAJtGYTB7EJj3R8Qt+p79AWCz2APwtPdAICJuyVfkA8DmUPjLeRgQEbfm41QtArSPlsFYoWfeHxHxSzk5ENonzfu/6RV+RMTNut/v35EPAM1jhZ15f0TEb0o+ALQL8/6IiCclHwDag3l/RMRBkg8A7cC8PyLiMJUPYP+epeoToG6sMD88LOCIiHhcnY2Sqk+AerHCfNMk9I84g//m+//p137vj//U/RusU+sE3E3VKECdWCF+7RVuLF81KP/iP//tF7/9Vz/94p/99H9d+sH//H9f85/8/N3l//6bf/cPl38raYjyev0P/uiLf/mX//XyN9Zv/a1f/O9v3Ie+//S/vb38W92783//H9zrYtla3flWx6SnqhSgLqwAP/AKNpbr/nd/74t/9Rf/5Yvf+Nmv3IZlqP/4v/+fL/753765vBYNUMz9v/13X/zr//iXX/zWX//9ZQfL+32jqvPw3R/80H0/LFpODYT60KYWVngJ/Vfi9/7w+1+c/c3Pv/hH/+P/ug3IVNWQqUFTqNp7f/z4i4/+7JkbZcmpogeKJnjvj2W62+1up2oVoA6s4L7sF2Qs02tPf+w2FnOp6IIaO410vc+zJRVx0e8/JKyf02//5Bf8/vX4hg2CoBqswN7rFWAsUDU+CtN7DcQSappAc9S73//U/Xwtq2mR7/zos9kiLkNUngDTM9X4KFWvAOViBfVs/+U6Vq8QYyEq5J9rfjmHGpFuIXlQCX36rt5vsIbqhJG0WYWaTr2ZqlmAMrHG/0mv4GJhqsJfc+R5SiWrqZH0PnfNKtqiEb/3nddWZaHF37w1rW59kapZgPKwQqo1/27hxTJUQ1TSyP+Yaiz1Wb3vUJtKutNI2/uepai8DHICqpBtgqFMrHC+6hVWLMySws9XqUaz5oz13/mTP5+8nHJJtUrD+x5YlJ+TEAjFYQXzTq+gYmEq896r+EtXjajWxXvfqUQVTtdUhvddSrem33mr7vf7+6naBVgf9UitUL71CiuWoRqlKfP+WqamNeqHu/4pmqD/Xiq8rfcqfa5aS/rmzq/odvnTPVCERHsrqHPX7cSo+zL2M+hesjKgeJUQyGFBUAbW+LPjX+F++Nkv3Qr/lGpEtDnQ0FGhVhZo5785R79qoNTYee+/plrKOOY3HmK3iZLuw9B5euVP6HcaMwXBVED5Ktk6Vb8A62GF8cxkx7+CVcPsVfSnVKOj13nXG+LhdrZzbHKjTkYp+weooc0dBel27Jsa8VBHQNEC7z2OqY7fFvdmqFCWBcK6WCF82iuUWJjRzX40aswdBlYjqdC1935jVaOrRDvv/ZZQjWvuaId+ozkiHIrkeO93TE0leNfBonyZqmGA5bECyLK/wlVD7lXwx9TIc87ld5qvzr37oBq3pZcMquORM7KhjsScnRlFZCJTFJflgGWBNciyQFiH/X7/3CmQWJDRzWeWOjFOHZPoqPSUarCW2tEu+pueUuH5KVMtEaOJoMrn8K6D5Wh18OtUHQMshxU+Rv+Fq3ncSIWvkbl3nTlV4xedoz7lnKHrMfPpx1SOxRpL7tSoe5/HU9MR3jWwOIkCwLIw+i9fJZF5Fbvn2olfagxz7VCoZXC5w9caPefY1Ed5C1oquGZ4PfI9lopO4HiJAsCiWKFj9F+Bkbn2EpZ+qVHUCD4StThmzpPu1DnJkeWv37iE7PpIx7DmnRg3JlEAWAZG/3UYabRKGumpkcyRXZ8jL0AdEu/aES+XVBZ04l5kamiNaSGMSxQAFsEKG6P/ClSD7lXonsoO966xtjnW16uhG5PYqPn+HKsV1lihMMShZ0Lo9/dej0V6L1XTAPPA6L8OIyPXpTL/x6gwfo4d9pS5713fUyPkqXsWKPqw5h4FV6nlmN7n9iQPoA6tbn7LQUEwG1bIGP1XYiRbvcQRat8ce+xrRH/Vd1Wy39RkxMskxMJ/U+VbDP092RSoHq0TwEFBMA+M/uswUrnXtNRL8+hTM/H1fY8l4un6U6Yc9No5dvGby6FRDnUmvddjeZILALNghUt7/ruFDssyEt6t7eAXdW70mb3vMlSN8PsrBBSunxJh0DVLP6mw79ANjfS7eK/HYmVFAOTFCtXjXiHDQtUo1KvIPWsasR4a2dDGU6P1bm57auOvEXIN0yh9tbzR+z6eJSxfxMG+StU2wHSsQHHiX0VGEgBzrZVfQ0U6pobsp+47EEkuLE016t538iQRsDo5KRDyoMQSp4BhoQ7dY7+F0G6OpL0x6rcrefXEUIceaLTGtsU4XuVrpeobYDxaVmKF6a1XyLBMh26io4Q67/W1qfB7zvMErvJyY59GRsRDl1iyI2B9np+ff5SqcYBx7Ha7T73CheU6NLtbHQXv9TWaIzlwiPpta5zvP+bQzY5qnurYsI9TNQ4wDi0rcQoWFuzQsK6mCrzX12xkn/uo6jCpo+G9b60OXQnAlsBVqryts1SVA8S4uLj4pFegsHDVQHkVuGerG7xEVkEMtcXOktQGS9737VvTfhH4lTaAe5Cqc4AYSiTxChWWq7L6vQrcs9YlgEPM2QlotfGXSmT0vnNfRZW812Pxfp6qc4DhWMFh6V+FRjoAWkbnXaMVc3QCWm78ZWTTKO/1WL673e52qtYBhqHQkVeYsGzpAHzdKTkByvZvbc6/b6S8eK/HKnyWqnWAYVih+bxXiLAC6QB8pRrvqcsDW1op4UkHYBO+v3Hjxoepagc4Dcl/9UoH4CtznOcvW54GoAOwDfecEghDIfmvXukAfGnuPQFaXTFBB2AbWp3OKYFwNVZYSP6rWDoAsbMQIuoAIu/9apYOwKbkfAA4Dcl/dbv1DsAcewAc2tqe+HQAtqPV7U9SNQ/gYwWF5L+K3XIHYOqxvkPU9b/3x3/qvn+N0gHYjtYBeKezXVJVD/B1rIDc8goO1uNWOwA6FXDK0cARtSmOfmfvc9QmHYBtaXX83VTdA3wdKyCP+gUG61IH1XiVt2cr4Wx95zFHAn/nR5+N3ifg8lCgBvYI0KmG3vfz9F6P1cmeAOBjhYPwfwMODYO3sBXw2LX+h+v7x64YaOGAHEWBvO/WV9EV7/VYne+ZBoBvQPi/HYeOhltY2jam8fZG7+oQeH97lbX/hkOTJlWmvNdjfTINAN/ACgbh/0b88LNfupV4X4XAvdfX4pjwvRoyb/5eHQJ1DLzXXGXNUylDf0NFWbzXY5UyDQBfxwoF4f9GHDqarXmHO2X8e9/plJcZ/H/4ffd6Uh2DMbkEV123ZIfumdDCdAf+WqYB4CsI/7elGnavEu9b66hODfWYjH91GrzrHaqGfMy11XFQMqJ3zZIdWlZaPxVxazINAL/GCgTh/4YcOqpTyNt7fckqVD90iuNQhbq963mO3U+gxlHy0PMSWsgXwa/JNAB8iRUGwv8NOXRet8bMbuUteN/llGNyHbTtr3etq4x0NEpw6AqK2r4XXinTAPDBB9evX985hQMrVklpXiXuufv9T91rlGjke3VOOc53TGdDkYOaNlgamvPQwpJR/IZ3UjMAW2W/3993CgZWrHbF8ypxzyHz4iU4Zt7/N372q8nz8mP2GNBOgbV0rIZOddRSTnC4VvdzNsDWsYLwsl8wsH6HVuw1hHbHzPurs6COkHe9iGrI1aB773HKGhIsIx3FHL8lFufnqRmALaI5ICsEHP3boEPXtGsjHe/1JTkmFJ9zxKrDf8YkBZaeODd0SkXf3Xs91q+mgFNzAFvDCsCdfoHANvz2T37hVuZ9p8yRL+HQrWoPnSOqMTSxsm/J+QDXnv7Y/cx9NZXivR7rV1PAqTmAraE5IK9QYP0OrdwV3vZeX4Jjwu/q+HjXyuHQTtWh+vyl7g8w9PuwCVDTvkzNAWwNu/ks/2tUhcC9ytyz1AYqmoCnPIH+Hv851bU1Gvbe+5SlNqBDp4l++69+6r4em5DlgFuE5X9tq9GzV5l7ao7bu8aaDt3MqHOpzHslw43ZKVD7CnjXW9OheQ3f/cEP3ddjG15cXHySmgXYCiz/a9+hDVVpKwGi8/5qyJbsxIzZj0CfsaRM+sgKgFrPOcDBPk7NAmwF6wA8dwoCNuTQpXMlLVkbM++v76mIgVS4Wt8nt0qW7N5Djjk06HJfghmnKCJGOjGlfGacR2sLXqdmAbaC3fR3XmHAdhy6fE6j0xIqeY3i1dh6n7EVu46EdtZTpMM7mngJWQGAh964cePD1DRA69gNv9kvANieamS8St1zieVqauD1Pmp81AiqMVSDP3QuumXV0Oq30L4M+m00767faq68hqGHALECYDOyLfBWYP5/G2ru1qvUPdXoeNeISAM/n/0Ogn7nKas3huaHsAJgM5IHsBXsZj/t3Xxs1KGNrxoX7/WeCltrmaEaIo0Qhy4nw/wqX6KbVtC8/pAphUjHUNf0roHNyX4AW8FuNuv/N6IaB69i76uOgvd6ZYtrKkH5BOokeK/FstToXvdKo3dNJfSz+CO7Gq6Vo4CLy34AW+D8/Pwj5+Zjo0bOtdeoXiM+jSYJ3bdnN4UwNGKjlQ5emcI23e12t1MzAa1iN5r9/zekRnBe5Y54lSQAbkvlhqVmAlrFbvTj/o3HtmWOHseoZE6vPGGbam+Y1ExAq2jTB+/mY1sqI19zwGP2rkeUOiwo57HKWLbaGyY1E9AiSvKwG/2+f+OxfrWRj+bvz/7m5+Gd9GpRkQzNYx+q5ETlLByqRkvL5HLb5Ucc2iVHHtpap0u5IJoOUD4JSYFtqxyx1FxAa9gNZgOghtQ6cGXoq3JuOWFPKxm871+66gx436d21RFT56eksw0wm2wI1Cr7/f6uc8OxMjXC1Ui/pkZfGeVjRsf6jrWOOtVARu5Rt6Z/6BkOJajOgCIDpR4pjTGtjXiQmgtoDbvBj/o3HOtQW8IqKWvMITRLqsZLEQmNEC/XoB+c0qeGPNppqT0RTZ/f+17HPJxz1++lqQet2+8OOSp1ekH3lZyBJnyWmgtoDWV5OjccC1aNqBpUr9JdU3VEuoZejdSQcHA0JK7RZQsn0UVWYSgKMGQ0rd+71D0bVDbUYSFfoD6VJJ6aC2gNu7lvvZuOZanRvirQUpL5+o39mHBv5GCizsPoQc1qJ75IA63NerzrXKXeR7+zXl/KNIKmNIgK1CU7AjaIjnv0bjaWoxr+7/zosyJGc/ocYxv7vmPO+B/bCJaqOk/e9zymfnvvOlF1neg0xBwqCsK5AtV4MzUb0Ao2+r/l3GgswJIa/k4ldnmfdYyaG/be45hDw+A1qamMyPy9oi65pj/UCfDeYw31vRSl8D4nlqG1FXdTswGtYDf2Xv9G47pqjrTUbH7NK3ufOarCv971T6m8B+9ataspDe/7HlPTQN51oiqa4l1/TdXJU3JjCzkeDfooNRvQCtare+LcaFxBjfjV8HsV4xxqBK5GVYlj3v//mFOTuKKjXlnrmv+hRhpjdQz7J/mNMTL9orKicqIpiyVWHOiz5Yw24XStrXiRmg1oBd1U72bjsmo+Vse1epVhTpW0p1BrP5QeycSfugQvOvesBq/1zHF1iiIN8tQOUTT834++LNUZUI5ArrwHnOyb1GxAK+im9m4yLqgqt7kr0WON/qGR44H1eb1rDFFRjujUxtQORy0qGc77/seckjwXiTioY3oqJK/OgHJVIh2YqIpAqOx474+L+T41G9AKuqm9m4wLqMosmgQXUY20GvWhlWa0YR4bgo7uXdDKmv+hRn6fKQmBkcZa01LeNTwVKZirXKt8KuqwpfJQoGep6YDa0c3s3VxcwLnC/bqmRnZjG2eFlb3remrE513jlGMS/1pZ8z9UdcQiZWNMdCQa/h8Tgtf30GebI7qljg97CKyjVo2l5gNqRzfTu8k4j6oU59iIRQ13jgz5yKY8GkF61zimRm3RxqC1Nf9DjUzHaFQ8NMrTGQn/R++zpzpxcyS3ajUE0YBltTaDpYCtoJvp3WTMryrB3HOkqlRzJsepMo1MA0RGYVra5V3jmPqtWlvzHzHSUVTI3bvGMSPlcEyk55gqq7peNAfklPqdWk8QLUlrMzgUqBV0M72bjHnViC5XpafrqBKdq9KLzN8OnRtWQx7t/LS65n+o0W2Ch06VRMP/c0zBKGKhufxc02C6ztbLy1Jam/EkNR9QO7qZ3k3GPGpEnSv02TX80XBv1Egmuj7TkBCsPrf3+mOuueZfnRU1knLu3/oqFeL2fh9PJUt61+gb6eBprt27Ri71WytPIFdkTM8aUwLzam0GewG0gm6md5NxuhqhR057O+ZSDX+nKtDIyOyqzVr0uSMjWf3tUiFdvY+mJrQHwqnvrM+kv9GoVUvevGvNoe6FGmHvM3letZVu9F7o+3rXya2+p94r8tmOeblqZMNTRwvIXgCtoJvZu7mYQTUskYr7mBoJL9ngdEaSxK4aeUaX/c295r8bdU7JTte91eh8iU5ZZOXEZd7EiRGwvrf3umMuXfb0e+ZYQkgnYFbZC6AV9vv9O+cG4wRzNP56/ZrLnMLzxEeWHep/9/7+mEPD2GNUw6jRfq5ws1TU4HJd+syNTaQTpWiRdw0Z+e5KrvOusYQqf1OjZ3QC5lMnyKYmBGrGu7k4XlU4U0aWCoFqlHZqFLeUkcbi2HK96JLHuY6FVWcqR0TmmPqt5jzJTiPxoeFx/Z0XmYjuMjh3JGaIml6akihIJ2Aez8/PP0pNCNSKbqJ3c3GcqmimjFrUWC4RUh5qJAFNlXS/0xJtcOYacUaXH07x1Oh7qrq2956e3ueInPUgSymL+hyRDar60gnI7263u52aEagVu5E3+zcWxzm18c91vGtOtfzL+6zH7I+Ao7/H2N0Lj6kOyVxb0p5SDe0cDY6uOTQq048CRKdi9B0O37sEFZEYmyR42QkoIKrWkHdSMwK1ol6cc2NxhGMbGlXomu/0rlmCkUb8cAQfHf1rjvvwfaeqyn7KqHGqc406I9GMwyhAJHog55zOmKI6pWOn2IbuWYFXa23Hp6kZgVrZswtgFrUBiVfhXKUaqJJC/p7R8Hk3io90HDSqy73sL7KKYS7n2stg6G+r31WdEHWGIiNndUpLHi3rs43dW4PNgvJobQe7AdaO3ch7/RuLMdWAR5LlOmsZjUQbD400o6N/b756ipF99Od2jqmdyLJAdeCinbgSp6M8tfrC+/ynVK7KUntMNO6j1IxArdhNfNi7qRg0usZd1haKjISPVcFGRv/6+5xREEUgxs4Tz+UcyzmHljt1TqPRmNKjUoeO6QSsubyxIZ+mZgRqZc82wJOMnJzXWeM8ZDSBLKJGp957jjW67HAJNWedO6QeWRYYMXcuxhKO6QToNd61cJjaQTY1I1ArdiOf9W8sDlMVejT0X3MSUnQJ2RBzzzVHpx6WNHdHR0YiM0Od4+CfJYx2AmqLdBToq9SMQK3YTXzZu6k40Gjin0amuUeBSzpH45q7UYyEupd2jsQ6NWBTNsnpq9/Pe59ajE7H5c492Zifp2YEasVuIh2AkUZGxC0kHo2JeJwyd4MYSYxby6sOTRpjNMHvlHN8viXViofIbo9EASZJB6B27CbSARhhdE5co2fvOrU5Zq71mLlH/2OXhS3pHJvr5OqYzRGhWMNoEmgJ2x1XKh2A2rGbSAdghJG51xqTqo6p0VKOxLM5Qs05oxNzqd9u7c2BjtlSODzyfCpB07sGXikdgNqxm0gHYISRRrDbGKcVxyx77Js7IhI9uXBN59hhL0cUoKVQeLSjyr4Ao6QDUDu6ib2bileoysWrRDxbGv13Tm1s5xj955yamNu5VoJMSdJssZxGogClbntcuqkZgVqxm0gHIGjkgJxal1Rd5ZRs+znyIWqY/++c85Cdsfel5LMoxhrpqNe8PHdNUzMCtWI3kQ5A0MjmPy0kVXmOnXOea5nZmof+RJ1zznlMFGCue1KCQ6dFSjz5sAZTMwK1YjeRDkDQoWfkq/LxXt+C6tiMSQacazXElIjE0mpJqPcdchn9LXKvxijJoR3DljtBc5qaEagVu4l0AIIODTe3PqqIzLHKOUe+kbXfJeh9h1xG8iHUGWk1SiWHllGVH+/1eNrUjECt7Pf7t96NxeMO7QC0PqrQ+mnvex9TEYO5Ms3pAHzpmNUAra1SOfTbP/mF+537cjjQOFMzArViN5EIQNCh58yrwfNe34pjlp1pROZda6qRXRnXds7R5pjcjBZXAHQOnQ4hB2CcqRmBWrGbSAcgaCTEqhPbvGvU7tglZ+oUzbERztCRXgnONdqcshdAq+V0aJ4KqwDGmZoRqBW7iXQAgkYav1YTrKZk3c/xm0TzEdZ0rhH32JUZcq7IzJpGntPaz0BYy9SMQK3YTaQDEDSyvlgjstaSrKLnIPSd4zdRBe69V4lqFYn3HaYY3fmu75z5GWsZWQ3Rch7EnKZmBGrFbuKr/k3Fq40knbUWBcgx2s79m0Q6ZWs7x+ZQOe6Jpra8a9doZPSvDql3DTytEshTMwK1YjeSswBGOHQvANlSFEDfY8pIs3OO36SGRMA5EgCnjv47WyqnkdH/HBGZjchZALVjN5EOwAiVNOVVJsdsZY51yjxz39xRgOiyxDXUChLvs08xZ/5DC9GqaBkl/D9aOgC1YzeRDsBII6MMOdcueEuqzXy87zbG3KPhXCPhOc3d2OgUu5zfufajcaMHVbW+V8fM0gGoHbuJdABGGl0Kp13Xaj529Hf+5M/d7zXF3J2inKPh3M6R/a9reu81xVoPBlIHUNMY3nc6Zgud8hWlA1A7+/3+uXNjcaDRKIDWgNc6zzpHY6MRZ87fo+QoQO7R/9TVGMfUngre+5WsylA0B4Td/6Zpbcfr1IxArdiNfNq/sTjcMaNiraGvrRMwZ5b9FnIB5sgBmesERHWgdL+99yxRbSwVbfz1HVvd/GhBX6ZmBGrFbuKj3k3FoGPOoleFNceOeHMZCa1H9+VX2DZng6POlUZ33nutoX6P3Pc6Ov0U3SlRnSjvfUtTv2s0CifZ+CeLT1MzArWy3+8fODcWA46Ze5SquGroBKhBjXw/NU7RSjn3CHnsPcntXCPNyO97Wc6C93CO5Yq5VT7NmMZfkRPvehj2cWpGoFZ2u92nzo3FoNERWacqsNLDrR/92TP3s3uqkdFror/HHA2lNtxZOx9gjiSz6K6H3WeIJkhqeqv/3qWoshKNNEmVz5qmNwr3YWpGoFbsJt7p3VQcaeSQoENVKZWceR0ZZR2GjqNh+Dmy5NWIrdUJUMfJ+0xTjI7kde+612rE7P3NMec6s2Cq+l3H3tOSOzW1qcFjakagVuwm3vZuLo5zym50JW7FqlG091k9VSkfjq7GZKnPsU2uPseY0eJYtdxzrg5dtJPZj0BEEgf793NtNV025dTHlrY6LsH9fn83NSNQK9evX995NxfHOTYpqVMdiJIq3UjY2BsxRpcOHo5Yc6r7skRioJY1zrXXg8pFZOTr/ZbRqZlSdgZUx3BKJ47GP78aPKZmBGrl/Pz8I+/m4nindgIU4i0hVBkNN3uj3jFRgO/+4IffuE4uNX8e+U5D1ahf0x/6zbz3zWF0Dt/LP4je07V3BtTnnbqsk8Z/HjV4TM0I1Ix3c3GaUzsBUqPnNaMBkdHiqZF7NGyrBmrOhrRrVNRoe+8fUSNyHSaj++29Vy6jHalT9yNykJWcY1pmiOoET526ofGf1bPUhEDN7Pf7d87NxYmqUZiSEyDVwMw9sjxmpOE+FSqOhq7lEhW3flNFG7SPQ6QzoO+i30bJaHM3/J3RTX+80X+n7of3mmPOcYDRKZXhn2OTIxr/eU3NB9SOtnT0bjBOV43MmI2C+ioUu+S0gBq2oY22/u6qhjAavtY1lz43QVMY6sio4dDnVedNqgHU/6aOmP5m6c5YdN7+1Oi/M5Kboc7REt9ZZUjRiWhnsa9eX0ruQsNyDkArWAeA8wBmduo8ZqcqboWDvffIaWSt+ZAR4pgogJdUuDXV8EbD4EPKR7RTMWdehlQ0JUduhn6rtaYsNibbALeC3czHvZuLM6iKKVcC2twdgUjG/NAKV6No7/WnPBXK3oLRjmOk0xQpi3PsnqcRv0bquZ4JfcalpmSQbYCbwW7mvd7NxZlUBZVjfrNTFX7uNeeRDWM04vKu4anRbLSy1/WXDrmX4pioSaRTGE0GzJWQquvovXMkYXaqo+S9F84muwC2wsXFxSfODcYZzTUl0Km56lwdgUj4XxW5d41jRrexlVut3NW5836PY0aT9ZRs513nmLp33nWGqo6lPuPUOf5D1aEk5L+87ALYEGwGtI45pwQ6Fbqfmp0eiVCMqXyjG/Kowcg1+qxFdea83+KYKkdjfqPIUlXdN+8aV6n8gSk7+B1THSRC/uvIJkANce3atW95NxnnVxVYNEN+iGo0tfog2kAr3D50hBYJ/x+qMHV0FBiZ227B6B4SY88d0By8d71jDl2ZoeiCRvu5O7hy6RUx+E21gVxqPqAF9vv9W+9G4zKqUZxrq1o11AqjDxkharTmXcMzGv4/NDr/LLdS6UcbZU3/eNcZospEpDN2ajpG19I0gRpo77VT7XZb9N4blzU1G9AKdlNf9W8yLq8a4DlGTZ0aSZ9a0hXZs2DK3KsiDdGGQqPi1hMC1YhGNyWauhokkmvQ32NA92OuEP+huv6YKQ6cRfYAaA27qU97NxlXUtMCY0bIEdXIqLHvL7Mb2viMDf8fGp3nlq3v7hbdNGpKFKYzuieAIjEa6avjEJ3KiaoOB0l+xckeAK2x3+/vOzcaVzTXlqhX2XUGIisTcjQ8Mtrg5RjxlqoaVu87HzPXEkldIxJ1WEJFh8bmNeDsPk7NBrQCSwHLVQ1eJEy7hLlGZYp2RKc8WpwK0PeJ/g45N0lSwp73HkurPJitb/5UgfdSswGtYDf1rHeTsTDVEZh7rnWIOcL/h0ZHvrK1qYBoA5x7VYRG2977LGXOfSxwXvf7/a3UbEBL2I3lVMAK1FKsaOg8pxqpqsJWI6zRmqYqvM8ZccxUQI73LcFoLoS++5SEOEVvNIev5ae6j957LKU6Mq1O6bTqjRs3PkxNBrSE3dyX/ZuN5dp1BOZOxBqiPoMaEzUqGk1GpwjUoEVD4GM3pilJhf6jqyEiJ911jb0iDHMtM42qfAN9nqF7CmBRsgKgVezmcihQhWoefc7111NUo6NRnqIFarg02j02co/sQdBZ+7rw6GoPL/9B91+/q8qArqeOmKZpvNevqRJadY9by9/Ykjo5NjUX0Bp2gzkUqHK7HdhKy+r27KYSlNegDoIiB2rgvL89Zs1TAQp9e9/plPqdpCI/+u1KiP6cstuEitF+Mz5KzQW0hpI7nBuOFapRlhrUUsK+c1rjVIDuT7SzU4vqlKiDwvr99rQ24m5qLqA1lNzh3XSsW42QNTdfYlh4DhX90Oj40C7KcMxuemKoGtV61+nUtEf/M5Q+Wp9qt3afEH/T3kzNBbSI3eA3vRuODamws+aJtxAZwPlVFEOdSw7n2YTvUzMBrWI3mS2BN2I3TeBV7IhDVDTEK1vYpGwB3Dq73e5T58Zjo9IBwCnm2hIaq/BhaiagVewm3+zddGzYNTcUwjJVrsLQfBHN+3vlCpv0TmomoGXYEXA7Ds1EV2Kd1nFHN+vB8lU+iJaOKhrU7cqnpEjvbz1Z4rcN2QFwI2izB68AYFtqAxmvQvc83HteFb62AO42nWk9u70ldb/U2HerHg7Lw6GRqSEO72lfaxNep+YBWsdu9gOvEGBbquL2KnTPq+Z6NXLULm9aAqdIQYm7Em7Jwx0YlaEf3SxJnQPvup7kAbSvtQlPUvMArbPb7W57hQDbUhW3V6F7jh3laTOYrmOgtfgagba6Ac6SdnsLdPsOqJFXo51rDb7OZvDe1/MwOoRtquTw1DxA61y7du1bdtPf9wsBtqUaEK9C95xrnlcdBDVcCjmrIeumFWQN2xnPoaZU9P0VSdFvok2H9BudCtnP4dDfn0TA9j0/P/8oNQ+wBeymczJgw2qkOHTuXg2Bd42l1Gi0awBbjx6oMS1lJz11QLzP6Mnuf03LCYBbw276w14hwIaMHESjhsC7xhoqEhGNDKijo2mIrhNxqELnXRh9iv3rarrD+yyn1Ocsaf987fDnfU7PbvUANunT1CzAViAPoG1zJgAubeSzdyqkvtQoVY34mJURkXP+l1DHC3uf01MdLO8aWL/M/28U9gNoV80rexW5Z4nLvCKj0069xrtWTrW0csyhSyUm0ik64n1WT1YCtCvr/zcK+wG0a2QHwBLP29dofsyBRko29K6Xy0hiZac6DOo4eNdbU1YCIOv/NwznArTr0MZToWzv9SU4Nh9grnl25QJ473mVyhnwrleCrATYvOz/v1W09MMpENiAQyt2Zd17ry/FMfkAGnFrdOtdb6yRcPmh6jR41yvFSJSFlQDtqVyw1BzAFlEIyCsYWK+RLYCVze5doyQjGxp15kwKHBOJkPoM3vVKMrKagZUAbakcsNQMwFaxgvCoXzCwbhUC9ypwz9JHqJ1j5t5zJAWOzUUodd6/byRZlJUAzfksNQOwVVgO2J6Rg15qqdQV0h9zUuHUpMAxqxFKW+9/ysgUy9wJlrisLP8DtgVu0EjIvKawrpLpvO9wyimNcWSd/KGlrfc/pVaAeN/Bs5ZoEQ72LDUDsGWsIDztFQys2MgSwNoSu8Zk4mv+PnrWgTobYzb70W/vXa9U9bt438Mzx5QKFuPLVP3D1rm4uPjEKSBYqUPny2td2jV2Lf7QlQEaFY9J+itpn/+h6vN638Wzts4NnvReqv5h62gagF0B23FoA1lDlrrn2HwALXm8qoHWtcfs9DcmylCK3vfxrLW8oCvhf/gKKxBMAzTi0AashiWAxxy7H/+pg4/GZvxL7RPgXbMGh3amSt8zAgdL+B++DtMA7Ti0Qv+tv/579/W1OGaTIHkslK3tbr2/v8qakv48h3YY9Xfe67E6Cf/D12EaoB29ytuzhazuyDr2Q/vffcxyP1l7J0oOnTJSxMV7PVYn4X/4JlYwmAao3EhSVyvruiOrHg7tvv/Y5X6aLqgt6c8zklTpvR6rkvA/+DANUL+RZV0lHgM8RjXCkUbs0DHLCmVkVUHpRjpQ3uuxKgn/gw/TAPWrjX28ituz5FPqoo49p3+Ml5sLNbQvPh2ATUn4H45jHYAnTqHBSozsllfrsrVj6vuMWb8ftZXISScdgG1odfuLVM0D+FhBudkvOFiPW+4ASI3M5+wEKF/Ae9+apQOwGe+kah7gONZT5IjgSo2cBNhiB0BqTf6YPQKuUmcseO9Xu5Ejgb3XY/lanf5WU7ypigc4jhWYe/0ChHUYSQJstQMgx+4RcMyaN026SlYBbMJHqXoHOM2NGzc+tALDCYEVGukAtJTI5hk5FvmUaiBbWO53TDoA7Xv9+vVdqt4BrsYKDXsCVGikA9DSKoBjjl3m13l5fsDv/p577VakA9C8rP2HGPv9/pZTkLBw6QB8XTXeYw4O6lRCYeuRkqEdAP0W3uuxbK0uv5uqdYDhWOF50y9MWL5e5e3ZegdAnSGN4L3vHrH1TsDQ/RM4DKg+rfF/R/IfjMIKz32vUGHZepW3Z2vr2Q9Vg51zY6CWOwHe9/XUYUne67FoH6fqHCCGFZ4zk2TAyhy6Dr72U+yOqYZ66G8QUddsLWoSmTL6zo8+c6+BRXszVecAcawAPe4VKCzcoWHvFiv0ufYA6NS1v/uDH7rvXaORjaNa7TC26n6/f56qcYBxnJ+ff+QVLizXoRu7tBbSHXuq3xhbaQwjSyVbnjJq0d1udztV4wDjUU/SK2BYptqxzqvA+7aS1KU1+jqX3/uOc6otdGvfHyCyTPL6H/yRew0sT6uzX6fqG2AaVqA4H6Aih46ENaftvb4mtcwvso79UH1/jYCnLBP88LNfVn0ssKJA3vfybHkzpAZl33/Ih3qUTiHDAo3M6yoJzLtGDU7J9Nfruu+uf3/jZ79y/26I6kDUukJgaLKkvqP3eixPq6vZ9x/yYgXrTr+gYZlGMrs1AvauUbqajx6b6a+pj37HR5EEjea9vx9ijcmB6rR438WTJYD1aB2A+6naBsiHFa7P+4UNy3RoJrzmsb3Xl6rC0JHja/uq8T+2ta+uHTkZz/M7Fa2sUCKj9x08WzwGuVHfM/qHWVDP0ilwWKBD58UVCvdeX6I66nhKqP43/+4fBu3rr0bce/1Q9dvXkBcQmf+veapoY7LxD8yDepaaX3IKHRZmZHRXQ+V+7emP3c8+VK0SiCSxTV1S2CUYetcuQf0WQ6dQauokblxt2naWqmuA/BAFqEMt2fIqc8+S17Tre0yZm5djw9dT8gw6L5cKDog6LK3yFbzP61nbNNGGZfQP80IUoB6HZsiXOMLTCFWj/im7+qnxnrp1rzogQ3/HYyqDXjsUetdfy0inqqWdDxuW0T8sA1GAOoxsjlPSLm9T5/qll+k/1il7DRxaSjQgkv0vS4xg4Ddk9A/LkKIA7AtQuGrUvQrdUwly3jWWVA3NlAz/TiW3Reb7h6jr5dhtUNGAtUfUke+hSIF3DSxHRWRv3LjxYaqeAebHCh77AhSuGq1ICH2tk+7U8GtL2qnz7VLX8d4jl7nOG1DDusbvrdF/pEyw/3/5KiKbqmWA5SAKUL6RJW2a614y3NvN8+do+JecZ9cUxdS8gE5FK5ZahaHfOzK10spZES2r0T/r/mEVrAASBShcrUePjPiWyPhWJ0MNvxpt7zNE1fTF0uvu9R2mbhrUqfujjtrcHYGhh0R1MvovX0b/sCpEAco3EgWQcy0LVPhZHYwpmf2HKnKw9lp7vX+u7yPVqZhjakCf03u/Y5a4MgS/LqN/WB0rhLe8wonlGM36ltGNc46pkbnmzaeu5e+7xqj/mFoqqHC59znHqlC9frcc9yBy5G9nyXtD4Jda3Xs3VcMA62EF8blXQLEcI9u+dmrp25jRqELZarxyLJ3rq9G2pg+8911TNdTREPtQ1dlRgxw9j1+5CmPu+2UuSIaOB86nIq+p+gVYFyuQZ6Y2onALK66vGo+xoWqNbrV0TZ0B2Y28u/9W8p1GmWqocs3re6pDEW0El1afL3e041A1zorO6PdWJ6u7B53qKKgjMjZJUWVEHQfvu2FR3kzVL8D6WIF81CugWJjReeBSVGNWW0KaGuIcqxuWltB/FT5L1S5AGbBFcB1GEwLXVA2oGqRaw9GKlIwJwa+lPqv3PbAo2fIXykRJKb3CioWpxnTOEHUu1VFZck+COVVIfY58iJwq6ZB5//K1OvZBqm4BykPJKV7BxXJUkl6p4WmNQkuf5x+rciVyrxbIofI2Wv3NW1IRVpb9QdFYQb3ZL7hYnuoElBIJUOKZEtu20ggpoXLqYUe5VBkoZTklXumdVM0ClIv1VJ84hRcLUyHfHAfcjFXJfZdr3RsJ9UdVRGDNHAFtOkTYvw6tTn2RqleAsiEhsC41Is25m91VqtEr7Xz8NVU0RjkPS07LkO1fle/Pz88/StUrQPlcXFx84hRkLFQ1QjmO4j2mQt5qdPQ+3vvjl2q5o+7DXJ0BJSOyzr8ubTDFfv9QH1Z4n/YLM5atGmhNC0zd0EcRBW0MpF37SDAbZ9cZmJo4qM6ErqONgrz3waJ9lapTgLqwwnvGVEC96gwBzdFr1zntLqfRo1TnQI1K999qXPQ3Uo2WXuddD6fZ7fSnufvut5fqbB3eD00n6F7ob2n0q1Zr/tnxD+rFOgDsDYCIGPdhqkYB6sU6ARwWhIg43Des+YcmsMKsqYB3vQKOiIiOVl/eStUnQP1Yob7TL+SIiPgNCf1De1jBftwr6IiI+JUvU3UJ0Baa07IC/qpX4BERN29aMcVJf9Au169f31kh1/IW9yFARNyiu93udqomAdrFCvqn3gOAiLhRmfeH7WAFnl0CERGZ94etkfIB3vQeBETEzci8P2wW8gEQccsy7w+bhnwARNyozPsD2INAPgAibknm/QEE+QCIuBWZ9wfoQT4AIm5B5v0BHMgHQMTGZd4f4Bj2gJAPgIgtyrw/wCnIB0DE1mTeH2AgygewB+Zd/yFCRKzQ98z7AwS4uLj4RA9O70FCRKxK5Talag0AhmIPz53+w4SIWIv7/f5+qs4AIIo9RPf6DxUiYgU+StUYAIzFHqSHvQcLEbFkn6bqCwCmogeq94AhIhbnfr9/odVMqeoCgBzYg/Xce+AQEQvxFY0/wAykPQJe9h44RMQSfHPjxo0PU3UFALnRA7bf7187Dx8i4lp+fn5+/lGqpgBgLuxhO9MDd/DwISKuojYt0+ZlqXoCgLlRb1sPnvdAIiIu5Hurh26lagkAlsIevpt6AA8eRkTExdSOpak6AoClYctgRFxDtvgFKID9fn/Xe0AREefQ6pwHqfoBgLVRb9x7UBERM/swVTsAUAqpE8B0ACLOIiN/gIIhJwAR55A5f4AKsIf1JksEETGTGlDcSdULAJSO9gmwh5bNghBxtBpI2Mj/dqpWAKAW7AE+sweYbYMRMazVHW/t35upOgGA2tDZAfYQc4AQIkZkb3+AFkinCD7rPeCIiN9QUUNO9QNoDHuwn3gPPCKitDriBY0/QKPYQ/6w/9AjIprPFC1MVQUAtAi7BiJiz6epegCA1mHDIERMsrUvwNbY7/e3TDYMQtyu91J1AABbwyqAm+abgwoBERtXHX/zbqoGAGCrpL0CWCaIuAGt4X99/fr1XXr8AQAuowH3TPICEBvVGv8nZPoDgItVEkwJIDYmIX8AGARTAojtSMgfAMJY5cGUAGLdPibkDwCjsApEUwIcK4xYkQr527+c4Q8A09CUgFUoz/uVDCIW6StO8gOArFgn4L5VLkwJIJYrIX8AmAfrBNyySoYpAcSCJOQPAIvAlABiUb4yz9LjCQAwP0wJIK7uo/Q4AgAsi9YXWyWkEYhXOSHiPL7RdFx6DAEA1sMqowdWKRENQJzfRyT6AUBRWMV0Zh2BF73KChHzqEjbzfS4AQCUx263+9Q6Am97lRcijvO9Imzp8QIAKJt0nsDTXkWGiAEVUWMffwCokt1ud9sqsdde5YaIvoqgmZzeBwD1Y5XaPavQtFmJW+Eh4qVKpH1Ikh8ANEWaFnh8UNkhYtI6yM/Zwx8AmkZzmlbZsVoA0bRn4bWmytLjAQDQPhcXF59YBfimXyEibkFr+LVS5l56HAAAtoeWDVpFyAFDuAlTLsxDTYmlRwAAYLso6ckqxvtpVORWnIg1S8MPAHACOgLYoMrsf0zDDwAwAHUErNJ8mEZNXqWKWLqXDb/JUb0AAFHS0kF1BIgIYC3S8AMA5EIRgZQsyKoBLFJ1Us0HhPoBAGbCKts75svDyhdxRd+oc8rufQAAC2EV702TA4dwFW20/0J7WaTiCAAAS6PtU61CfkSeAC6g5vfV6eRcfgCAkrBOwF2NzA4qbMQcvlKYn/l9AIDCSVGBhyY7DOIorSP5znzCefwAAJWSzhx41q/gEY94OdonqQ8AoBGsYj8z75msIMCvaSP91+Z9juMFAGgcq/TpDGxcGn0AgI1jjQGdgY1Iow8AAC7WSJylHQefWUPBOQT1+97u43P79x6NPgAADMYaj1vWeGiPgdcHjQqWrbaLfswmPQAAkAVrVA6jA2w6VIiK1DDKBwCAxdD68NQh0M5wHFK0nNrbQcs6lbfBjnwAALAu6ehiHVT0yCShMJ+vzMc2yr9r/3LELgAAlI81WrdSlOCyU8DUwXEVyrd/1XHSWfr37He7nX5GAACA+lGkQI2bNXgPzCep0dMhM27D2Kj6zpo6eajfwv5lZA8AANslRQwuOwdqHO1fHWxUYwdBn1nqPIbLRp4RPQAAwEhS4uFlY2pqauGygT2IJGiaYY4li0py7Br1y5F78jJUL+3/JiEPAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABbigw/+Py2mCMJrs//nAAAAAElFTkSuQmCC\" style=\"width: 512px;\" data-filename=\"design+development+facebook+framework+mobile+react+icon-1320165723839064798.png\"></p><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-weight: 400; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\">What is Lorem Ipsum?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\"><br></p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\"><img src=\"data:image/gif;base64,R0lGODlhGwYbBvcAAAAAACYyNyYyOCk1Oy05PjE6Py88QDI9Qjg/Qy5AQTRCRTlCRzRJRjdCSDpFSjZLSTxKTDtTTT9MUD5TUD5aUUFKTkZKS0RNUUlPU0NSU0pSVkNbVUxVWUxbXEddWVRUVFFXW1NaXUNiVkxjXUpsXUZmWUxwX1RdYVleYU5nYFRkY1xiZVNrY11laVxsak5zYlRzZlJ6Zlt0a1l7a197cGJmaWRqbGlsbmBlZ2ZucmtvcWNzcW1xc2F9cW52eWx9eWl5d3J0dXR3eHV5e3t8fWFwb1mFbVeCa12McV6HcV+Qc2WDdWuMfGqEenCCfmGTdmaaemabe3CRf2mhfnV9gX1/gHWGgX2Bg3qLhnyOiXqGhnOVg3iaiG+RgGylgW6phHGthn2ijXGuiHW0i3i5jnu9kX+mkH7ClIWFhYSKjIeKjIGTjYmOkY2SlImblIaYkpOUlZSZnJ6enpGWmYWslY6hmYGnkZKlnZWon4u0m4+5n4exmJmeoZugo5qtpZeqoZK9oZ6yqKGmqKaqrKK2q6S5rqqvsa6ytKm9s6e6sLa5u7W4uoTMmoDGlojTnofRnZXCpZ3LrJnGqYrWoY3bpJDfpq7Ct67EuLXLvrHGuqPUs6vduqfZt6LArpHgp5LjqZnlrp3msqLnta7ivavpvaXouLDlv7u/wb3Bw7rPwbfNwLzSxbjXw7Lnwbbsxbjtx7zuyq/qwMPHyMrMzcTGx8XbzMLYys7Q0snf0NPV1dnZ2dXY2czP0MHvzsLwzszj08Xv0c3v1tXs3NHo18bw0sry1c7y2NP03Njz39/35d725d325d/35df14N/g4eLk5evs7ebo6PP09P////b59+r37t3f4AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAAAAAIf8LWE1QIERhdGFYTVA8P3hwYWNrZXQgYmVnaW49J++7vycgaWQ9J1c1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCc/Pgo8eDp4bXBtZXRhIHhtbG5zOng9J2Fkb2JlOm5zOm1ldGEvJyB4OnhtcHRrPSdJbWFnZTo6RXhpZlRvb2wgMTIuMTYnPgo8cmRmOlJERiB4bWxuczpyZGY9J2h0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMnPgoKIDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PScnCiAgeG1sbnM6dGlmZj0naHR0cDovL25zLmFkb2JlLmNvbS90aWZmLzEuMC8nPgogIDx0aWZmOk9yaWVudGF0aW9uPjE8L3RpZmY6T3JpZW50YXRpb24+CiA8L3JkZjpEZXNjcmlwdGlvbj4KPC9yZGY6UkRGPgo8L3g6eG1wbWV0YT4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKPD94cGFja2V0IGVuZD0ndyc/PgH//v38+/r5+Pf29fTz8vHw7+7t7Ovq6ejn5uXk4+Lh4N/e3dzb2tnY19bV1NPS0dDPzs3My8rJyMfGxcTDwsHAv769vLu6ubi3trW0s7KxsK+urayrqqmop6alpKOioaCfnp2cm5qZmJeWlZSTkpGQj46NjIuKiYiHhoWEg4KBgH9+fXx7enl4d3Z1dHNycXBvbm1sa2ppaGdmZWRjYmFgX15dXFtaWVhXVlVUU1JRUE9OTUxLSklIR0ZFRENCQUA/Pj08Ozo5ODc2NTQzMjEwLy4tLCsqKSgnJiUkIyIhIB8eHRwbGhkYFxYVFBMSERAPDg0MCwoJCAcGBQQDAgEAACwAAAAAGwYbBgAI/gABCBxIsKDBgwgTKlzIsKHDhxAjSpxIsaLFixgzatzIsaPHjyBDihxJsqTJkyhTqlzJsqXLlzBjypxJs6bNmzhz6tzJs6fPn0CDCh1KtKjRo0iTKl3KtKnTp1CjSp1KtarVq1izat3KtavXr2DDih1LtqzZs2jTql3Ltq3bt3Djyp1Lt67du3jz6t3Lt6/fv4ADCx5MuLDhw4gTK17MuLHjx5AjS55MubLly5gza97MubPnz6BDix5NurTp06hTq17NurXr17Bjy55Nu7bt27hz697Nu7fv38CDCx9OvLjx48iTK1/OvLnz59CjS59Ovbr169iza9/Ovbv37+DD/osfT768+fPo06tfz769+/fw48ufT7++/fv48+vfz7+///8ABijggAQWaOCBCCao4IIMNujggxBGKOGEFFZo4YUYZqjhhhx26OGHIIYo4ogklmjiiSimqOKKLLbo4oswxijjjDTWaOONOOao44489ujjj0AGKeSQRBZp5JFIJqnkkkw26eSTUEYp5ZRUVmnllVhmqeWWXHbp5ZdghinmmGSWaeaZaKap5ppstunmm3DGKeecdNZp55145qnnnnz26eefgAYq6KCEFmrooYgmquiijDbq6KOQRirppJRWaumlmGaq6aacdurpp6CGKuqopJZq6qmopqrqqqy26uqr/rDGKuustNZq66245qrrrrz26uuvwAYr7LDEFmvsscgmq+yyzDbr7LPQRivttNRWa+212Gar7bbcduvtt+CGK+645JZr7rnopqvuuuy26+678MYr77z01mvvvfjmq+++/Pbr778AByzwwAQXbPDBCCes8MIMN+zwwxBHLPHEFFds8cViCaDxxhx37PHGGIfMbAAfl2zyySKn/CvJJ3NMMsstx6zyzLPGrHFFMLdM886p6gySzTwH7SnKKREt9NGUmgxTzh0j7XSjHg8gwE1KP231oB/3VPLVXPOZNVBbdy32nF8TVfbYaKvpsVJnp+12mGs31fbbdGMZN1R31603/pV5R9XxAHsHDqXLWXUcgOCII2n4Vn0n7niPTXvV+OOU1xg5WJdXrrmMmYOV8+agu9h5xqOHbnqIpY+V+umsZ7i66hy3LvuGr5M1+ey4N1i7Wbvn7ruAvfMe++/EH/g5XcEXrzx9G5N81/HLR68fx4Djlbz02KM3vF7NZ+99fNvvFf735J83vvggl68+eefz1f768GMHM2Hvx2+/dPW7n/79/OO/P/0aO1z/Btic/P3FgARMYG8QeMD/KfCBv+neYhgIwQrChoKAwaAFN5gaByrmehwMoWg0mEEPivCEp5lfZEiIwhZexoSNYaELZwgZGQrGhjTMYWJg+Bgc6vCH/jfkYQ+FCMQiIoaIjvGhEZd4FyUOxolMjCJckFhDKkrxinWBIgBvhsUu6m9qnrGiF8eoFqlxsTNaJKMaC3fGMAZwjXB0ixgnk8Y42lFuc5RMHe/IR6TkcTIsE2AfB9mVP9LRkIRMpFH2uMM2KvKRfnPkCBEJyUryhJKHFIAgLcnJozBygpLspCjBFsrRbKx6o0zlTzBZmQCCUZWw1AkrW1nKWNryJZ+M4Swp5kqj3bKKr1xNLg1mM5n9EpTBFGYtQ1bMZu7ymHJ8Ji01STOgLaSY0AxiMlkjzYD5ciLfzCb3lnmaYeIrbB2pmjjxosILdlNfc/sIOteJPHJ20J4I/ounSOZJzynis5zvrNfiWhK1fvrznwDdpsKYJpPbGVR4Cn2NOdkFwpI49KEhcSZCf7bRhEaUYBU1yUUxqhGNlmyTIg2oZlS6rpCmhKEkTadJrWnRjqJmouVy6UoIF9OMhFMhTKMeSVi6UpsKFKcdgV5PJaLOirhsmEid5kf5pVOXVPWh/PTpSJ1q1HtOFZ5ETekbl9qQrWLErBEJa1G76q6ojoSnZEUIWkt6VYK41TJq9dZd37rXQdYVnH8FQF7X+lV69ZWvgyXkXOXpxMNSxrHRguw+JRjXwF7kqondTGatJdnJjnWpltUqWzurx81Oi7SeZesoUWsQG5p2rWBV/q1PQptI1h6EhbYFZmEp+lqWwJWetPUICXsL23vlFrG7heVx5SrG5Q5Rtt9ybmr7Kd3bUrG6SYSuXrUrFOxa0LutJSJ4GTPeW5VXuMTV4Xnt+r7fFie9x4IvTNZ7P/qyN3wDRY59YbVfjvS3fP8VSFD1SRz5DsvA80VwCAM8EJOhNDkK/hWD6cpdL074vhFGY4Z5tWGrdpiAF97Oh3EVYgo/uJIjbk+JR5VilrSTkyvWTotpNeOVvBjFFWZQjD+144zcWJE9zk6N+ZtjPCYXjkNmT5A3leSdNll6SxZykZsV5bM+eXlXVk+VLZVllXT5d1vGzpdLNeaT/PiOZTbf/pSXlWaxHvmKYRZzm3k855q+WYp1Lk+eObVn5Pp1zRCKM6T6jNg+ClrKd6ZWAFh20EQXkdDjga/hqHmopmrEjHI5tH2IUQxOE8MYoDbGMUZN6mUg49TKWMYylJGMVrv61bCOtaxnLWtVq/rUyyD1qENdDGMU49fFAM+ZV2RaZ/7JpHQ9MVsgnR5OA1vUul71Mmgt61RTW9XUzra2tx1rbLt62q/2dqvBbWtd8/rXy2F2pAFtkAHT9E4zraqmKexoCnX619A+BjLE/W1Yszrc3G61ta8d8IIb/OCznja4+73wZNg618jYNbB5o27xTHQA7g4vgdvkMwx7TNkMqXih/jWEb2gPHOAIT7nKV87ylrs84bk+BqjR3Zp5y5jdWWVucPm28XYvtsHsporNZ/PpfMN61eNm9b+P/vKmO/3pUHc50pNhbXJHfObEMGXQJ6TSnut86FyX9/UoOxeRw4bToD5GMxp+8KVH/e1wj7vcmU7wWCtj177ODNjlXOSfa9zsGPL7148M+OniB9+jZvvcF8/4xjs+6qr+d8NNDeqsP/dG0hT84NW2x97tncLwQfuo3f740pv+9KiPuzKu3unDFD48jQ3uzpM0ewS+3vDlQfzClcFqxaf+98APvvBpze9xN0Pmlu/L5xFtEa9zdetDmr1A8rd80H/n16N3+PC3/s/97nt/3NtONeWD3UToV4iSmodI9QeE1PeZsd5nWX9dRO978H///vjPv/B5L3mHq1rm5BdN5kchuCV9fycmbtU+ZGc9A7gavaZv+heBEjiBFPhqx0dz8deABLhRzudft4cge3U5Bsg4HwgXD6hw9leBKriCLNh9uYaBmKOBYZdcHYheMmgjC2hnOceA8OcaJ/ht9deCQjiEROh43pZreUeCNxghBlSDHLWEnENcloY+UAgZPwh+k1eEWriFXDh3KNhqEmcVJbhunwV06SdTVegiw3YSIxiDPQgavbZv2teFdFiHduiFCYcMxpB8RvaGJqJRNSF/9zGGhUSIU/Fp/seAgl94h4zYiI4Yd+UWgH6Uhkz4bjQhiMxjiFyhiUwRh/92co8YiqI4ik23cLm2CW+QAh/nh0NFiTPYhlbmiidShraBiT6BiOTGdkFIirzYi754dMvQDJeABRlgbIHIibOIjPZhi1WhjD5RDIm4i784jdRIjba2Ck5gAPGmYM74h90oH9+IFcwoE9B4hNV4juiIjsuwCi7wMQ5wAj+wBm7gBndwB2sABCtwAVNYNOFIIuO4Hjl4G/3oEqLWe+l4kAhJjcLwA+8nAAdgA3+AC3M4a8hgCWugAgSgSbBoXawoJ/+YHgN5FSF5EtBokBOZkCiZko24DJbgABzTAX6w/nbklm3YJgx+4AINeYMjOSI7qWayqEs/eRVXWHwqWZRGyYXL8AbvpwGIwHKqNgxu0AAcQwBNwIa0eChreCQ92YwVto9aUZK7129HOZZkKYTLAASLJgAEUAdr55Tg1gx/UIwbAwGJoIcjxygfyT5bKXSshE1ZEYfmWJaCOZgtqAw7oJEXsApvtwx/IJVp6QTCcGuSaGKPEpBGspdcCX/IdojGUH/SSJigGZrC5wQbowLCIHfCoAUZqTEZoJj+R3nW5yhZGX1BeXlM9XEcCWnl+Jmi2Zu+OXxusDEt0AxeuAy10AFpOQB3IGvNYJfPFyl5CR7RKYZz5HVnOBMFOYdE/vmb3NmdqLcMmFCaxLl4tpYF72cFoIiFxzCZIVebX4KZ3QGfmekQTriRHmEM+8ab3rmf/Ml4wgABGgMBw2B6mQCgGiMDp1lr5HYMfJgQ8smTDyo/ESoVthdS9okRu6mf/bmhHBp1P6AxA7AKGvp0v9ABG9MBw7CLS+ecBxFISTOh1QGjFLpMZ3ihElGOHZqjOvp4lqCRb/B7yHCYmqQBCTpr6bl6k8loL+qeM2gcMHSdZtiRG7GbKbijVnqlTocMABoAHEB6prcMVnCiRVpr3SZte6gAMoo6aQod08lGbbSDFEFavZaeWFqndrpy06YFIOqawZcFpYkMBWeKtbAx/ktwKWv6HIeKN8bkgcRVDIB6kncaqZIaqKtgRlnAfWEqAAPgAiP6aj+waBqgasZQKW3KTZaJhlJacz9Fb6m6EAXZqZMaq7GqDCOgMRfQlsO3DB+qMWuwncRXC2bkB7w3bXfHnnjJpNJpiRuRqDPafmr1acQJq7I6rZLqBxgXAJcgrXK3DDYAok0ZqEJaAUgHbv8mc5XJrHq3mcuKrMDxSfhJrfAar9mmDMLgkgKwA9+3DMKQASRzALUQcOD5MoSgbSyqKOiKV+h0MiCXVgf7RVJqDOOprfI6sTlqa1qwaATwC/maDLWQkQHQAeOpbcsQAhrTARqaaw1KKA2bSUgE/qcPsbIOaxG9posUW7PyCqwa86P5RwgbAwTcdgcaiQnMcHAvaCil+hkgVKMwS4WO5qhV+rQ2G7WRCgQaIwGPmn96qknLmW21oI0BsAPLMLQGh4LrqbLsGqPo51JLG7MNQQxqJ7Vwa7OpwDJ+IIHLoAKLNgCYwHZDywzM0Ax4KwANoLFShwzGqidHq1mzZKFnW2Dk5LZxG7k22wIkowFe+n3MMAwQ0K8i+mp+ywy6ujGJ8HT/d7jw1rhs+kwg5KL80T6O6quSG7uSegkBZAkSa3qqsJoHcAlVigUb8wNyV7Z7srZH9E4aRLx9wboA8Lq5KLvOK6uqKAAqAKn4p2qJ/mBGA5AG+ZkMw0C1mqQCIQt3pZsniftCa0ZBs1kfecsKV/u87jutPaoxmMCCiWAAL6MAP/AGQHAAixYAHnAMj1e0doK8W9SqUVpWqGscDbBoVgC77/vAO3q3GtMCLKhqqaCPadkxLTAMlwuJtjaqdELATxR0TSjCeQGxyXAHGPsLHQzBLtyhmMAymTCEwpAFB+BKAaAAdXC7KqeLIAwnJlxCW0d9CQwcKOxqyuAAi/YGLfzCTryf7Si9DiyBwkAIVvADWlAIchh8ttYMpmsm5Vta5meZYWwYR3x0b0AyEMDDT9zGKrkKG2MJWgiKU4x6wrsmQax8A6iAefwWnUl8/svwCx77rW5cyN05BBoTqlvIxuT5wXhcxE56lRnlQWUMGJ3ZxK8mpD5ryJwcmn47DMGaf587yqRcyqZ8yqicyqq8yqlcsGSipAFSbP9TyX3xulSHya6WCBpDAO3byb58lKq2BiTjAMggtpjLysiczMq8zKvMoGVCy8hkwO3psubhtg2Hy67WDDcsAKP7y958lEmsMW4wysfMzOZ8zuh8yuP2w3BDaf8hhU74HYlYpSPqvU7wzfiskolAMgMwDOTsfekc0AJtzq3mt6b2xVciyfkBWTC1HsaAzdzmB7aazxR9kMsQxUAQtp/7dsb8z9w20MnsuSC9zCi3DOy8JX1c/n7S/B9n3HS4sDGEW9Ey7YuBbEYz7NFP57cFvdEBN9KsLNLMnAwBTW2GyyUpXRfp+yDEsMVRZ6+EPNNQPYprwJrThtNOp8497dOqDGsELdToLLInXSVHXU8rrR+dWccrF8VuENVsHYrLYKBr7dU6HXVY/dFancpcHdRy3dU0yQx3zHNl7R1jvRjFEL5y56cCsMltvdh2GJ4agwulfNVbndWRLWtW7WqXTW11TWvnPGunLKpiPdhwkdQHArmPJ9EC0AGMvdpduAykKQAtYMqSjdeUTcqezdOxltmcLdvZ1tmWbcoLdwxTQtrvIdqF8cemlwoacwCs3dxF2AxSKQB1/lvZL7fKBbfZQG3MeT3Xdk3du63Xuc3b4FfUgwPJvgHNmgHAaB11g6oxjOzc8G16uqyWp+ndLWfdta3b+o3b24bdvw3e223bed0MYU177rzQ5g0dyP17wrAxYxrfEK5/TkAy+IrZ/L1yyHzd4h3g3L3XHa5t/p3dAC7i/O3RyNAkxt0WKd4X8yxu7020GyORET7j+KcMCywAgZDd1f3T+X3hFo7T9t3bGx7evk3kAr7THQ6bBh7Y2aG8B1IMdDxutkZ3ZGp3CUdtG/OvNL7l3ZcJaTmmul3QEL3XysAMZX7mZv5qpPeJSH7k243mbe63brfmZS62n6vRSU7icm7m/nxe56Rcf3de2R8+hwSuOAm+G81jRgHQkO+Xk1EDovwM6ZKOvSBa6Zrk6JZO6dQz6ZKuqZHu6Zp6Sol+6Zq06Hmbtx+j6TmJvZ+OcaO+6KV+rbJu6al+Sizj6qwe6pYO67wuNXmL6aL+6KCe6wMw6yelADLQBVmw7Mze7M7+7NAe7dI+7cwO01x+7cN3sQEAAfPY7d7+7d3+BuAe7uNe7uZ+7uie7uSu7uze7u7+7ugu7uX+BlgwAkSC3iO8jfq+7/ze7/7+7wAf8P2ewQJfTO62jQ+O7QpfevrYPEF18AHfvwQP8AMWSP1b8Kv4MReP8S0D8Rz/8SAf8iI/8iRf/vLbuLDgY/Iqv/Is3/Ii//AkP/H77gAvvvA2X3D22jwa6fAONmk7f1Ian5YbH0A5M/FGn/E/DzMSzzRFf/BNr/O99HHuJvOG4/EVD/VU7/Jav/Vc3/Ver+/9sekno40fQ/YaY/Ybg/Z/I/Yto/Yc4/Zu//YeE/e0ruttXzJ0f/Ymw+h33zFqD/d7z/bNlPd1fzIJoAI/4ARW4ASM3/iO//iNPwSLr/iMPwSQf/mYn/mYnwW2cPOe73iYAAQ7MPqkX/qmf/o7UASnr/qoT/qsj/o5sAOx7/qtX/ul//q2T/o0IPu4P/q9j/pFEPu/n/ujfwPEP/y3T/ypT/wy0AEE/uDxXx/90j/91C/yBOAvZ41tU07PKfhwDyeW2sn9WQj+M/n55s94gamdG72IYUtwoAvUpljQuV3SWKh9NDuR8W9/g+7jnqtqPt68AJEs2TKCBAUeXCYwoTJmCg8+XNbw4UFlE5dVdJhRoTEAHT1+BBlS5EiSJU2eRJlS5UqWLV2+hBlT5kyaNW3exJlT506ePX3+BBpU6FCRzRJORJo06VGlTZ0+hRpV6lSqVa1exZpV61auXb1+BRtW7FiyZZUyQ5tWLdqHa9OahRsX7jKORO3exZtX716+ff3+BRxY8GDCeY01G8h0q2K5jR0/hhxZ8mTKlS1fDuvWbVvNmD1D/k5It/Bo0qVNn0adWvVq1q1bGzP4WfZs2rVt38adW7dVzWs5b94dPOsx18WNH0eeXPly5s2dHzvKWPh06tWtX8eeXW5vtb99awefmLhz8uXNn0efXv3608hih4cfX/58+vUnv7WfX+l49v39/wcwQAEHNO4whPRDMEEFF2RQu+4azG8ZZAiksEILL8QwQw1Bgg1CDz8EMUQR4XpwxPgk3DBFFVdksUUX+TLGRBlnpLFGGUu08brQ+HuxRx9/BDLIFhHLsUgjj0QySSXDUoxHIZ+EMkopp2zNKOmWxDJLLbfkcsSLnKQyTDHHJLPMmopB7L0u12SzTTffrG4ZMM2k/rNOO++EEk2I4OSzTz//BHSuOfEktFBDD+3PwEAXZbRRRx9NSpm6EKW0UksvVU1PSDfltFNPtSRoUkxHJbVUU32CTaJPV2W1VVc9bEbUU2eltVZbOSxI1Vd35bVXX6trpphbhyW22EM7/DVZZZdl1rMJjYU2WmmfNKYiNZvFNlttt82KoGenBTdccSmEjltzz0U33aXkHLddd991Dll156W3XmULkhVeffflVzDYrrQ3YK1KrAaigmJjzCCABWYYPmWE7TdiiScO6t+GL9YqorSGsQUROdb4YYcWOsgAggMOUECBAxq4oAMVdvjhDT8yqWVhjG8W7iJlvqW4Z59//mapGGWUsRlno2MTBpM7nFhhgQCeDkAAqaem+mmqrxaAgBOs8OOX0Io2OuzPlBkUaLPPnriYa8VmmyBc/HAiA6mhpjtqrO/GW4Coow7BDVzYBvw2a/NFu3DDx9U08KNDE6YQIBzAmu4BCkDAghBauIGHIa5AIw001FADDTS0GIKHG1oA4YIDrK56ABcyOVBx2S9bhpjDb8c9WiJnN/qXO1wYAG8CMECBBzTkQD555Zdnfnk0eAgB8qtDgB1s3q8vq+zct+ce0d2xbxgZP1TA24EThGCjefXXZ18ONWyQfuofhAG//sdE6z5//fG00nr7s02FEw5wtQAcIAREgEP7/hSoQD4w7wpym9oCLPE/CpqFIBDbXwY1GKVjVFBdoUmGMhLRAbtFcAXHW2AKVbg8NcRvAHfwnwdlOBXtbdCGN7yQxWZoroX4AYJTG8AJULhCIhZRB8HTmxViuEMmKoVsOIRiFCkkryZqiyB4qEDVLiCEInbRi2pAwNS0UEUyXmUZGJRiGtVYnsSVMVuY0MDVOKAGOTTQi3dcIRyyKLU1uNGPUCFIDdc4SEK254/ZwgUQppc+PDaSiHHY4wAIcUhKWuQghCtkJjUZGOgssZKbaoYbBji1ECTQkafMI+QKWItPthIhm4RlLGHkSVc+qhYnmFoAKkBHVPZShWwogNQ6/vC9WlISk7JEZjJtojaMFJNXgRilAA4QBF9WU4VDmNodnNnKMyrTm9+UCTK22Stk+IBqJ5iDNdW5wBBEzQC/GOcnBQlOetJTnPHcVS0uYLcBEGGd/2wfHAYYgB/g85PHrGdCk0lFg35qGZeI5gVMCVCKNi8IULNFQw+JIoV2VJnEAKFGVxUIJAqgBhVV3iBQmjwHPG0HFxHpHxHqUZpG8Z4xXdUdgOjPlRJREKfEptRq0UyckpFnNUUqFBla1E3VQW8CMAAv8WjHnhZRek4gKlOZGKqkdnWDQhuIVjv1B70VkJFVRWsdgyA1AtBPrGQkmlfl2j330PKta1pGIObW/oCJpjWtCtBbHe5aRaLhb66HPdtSB8soTAzgaQjoq1/RWoOoacCui1XcURG72X6pDbObqkUD9FaAs0pWfSpdJxzsporPknGmnIWttDrY2kc1I44CKMAQTevXC0itoLRt4jxjO9xaeRa4jvrB1Hi6W8kG1QBuPe4OX0tc6pLqstHFUl6n1gLmMpcAUvvDdbFrNOFW17yGilFWx9unX4yyAt1l7gqkpoK1rbd+3Txvfi2ltoWI175FcoHUBhBZOaAWvihVg91Y+V8Zlle/D55SXRn8J+1KjZoH3q300jBhGS4Dwh+mUzE4HChkSA8DGGZuDqQGgYKM+H+GBXGMOehi/kBlQcBtQPFu4YDERNCYgstohoyFHCTj+phPv0AiDnLMXA7M18g/RuOQpZyiFj8ZTlqQ2gGWzFw0TG0VVr4vu6Y8ZgwpFsxdwgUSdbBl5kLAt2e2n4fJPOcB1RfOXHpDlqnKZr8Kga3wvDP28EtnQqsnRoGG023XzOfdijYAVkA0+BxcaEqvRr2R5pItpoZjRpuWB3/GNO8IUmlSK+fQoW4TIaTmgE4zd5RKRPXsYFxqWqfGzrHGUp4FwIFW7/YGAgY0rhU36VoXGy/p9a+wQ6RIk/batHEY5RiVHbhRG9vagjHI0KbNJRlITQd7djbzfrpOHUTtANDdttGGNuhr/rf72OluUwssHG7TGkBqdUg2vLVFbHf3Wybl0jeXlkE+AXCR3n6twYrzHXBs8dvfD1dJkRkOKhVEzeAHR+uO9RaIW0/cXnKGeMhrAnCPgyrAAlg0xgE6buWFQG8n6HjJ58VVkdf8JUST+ZaWwewcOJLlKk+hGspqi4XnvFcGcbjNH25mox9pGUFdgWQN7OyWPrroTfeVZpW+9Y+4B+ugWoPUQAD0tPIgagq46dcZVjuut70jYFX7kgpCVgFgANxkr2jwAiCIuDeM5m63Ocn7vqRErBrvaMWlAFww+IslHfB0vjrjEaQMTUuN3j9Pa5elNgzJM0zrjzc2fzuPpWZM/o3Ah/8nH0apzdHXKzSgd/dsW48l6VUB9T1FgdRGMHt6EYRoUYY9qSPPe/ugRd4C4MHtKQoHHexx88S3l+ODf14dQv9IaLHC00KgfHXCIQgYwJoDLm19c0l/+sQV5/DJL5+I+CFqDsAD91EZhyqAoKRUM8Df1k8v859/s6LfP6dbhlqwmziQv6lCAxSIJrxRhADsPf+bslNzQCRZhlHSrQP8pRpYwLwRACVSvwlslIsAPgjUr7QDQSMZOG9bH8zbrbtzJD5gAxsIIwLiwAz4wBNclNAYQRKsLp3BQSTBMgEYOwwMqBxwPg7EG3T7QStKhuniwbkSvfFbQhPRKwGw/gAiVB84EILbQkIkRIQpPBcxe0Likj0wNJJamJp0Mi0WtKY4EAIMuL8u5MA1iDkzzLoxHK5jkEI7NJEKlBrbw0IiAIFgksNCFAAgCCs+zJa4wkPEEjFFRBIVEwDuOkA1QIEwYh1D7EINgERtGRplaMS5YrpONBE3kJoL4D41uAEEcKy5KSFNzCWsIYAbJEU+qbZQRCpk2MNaFJFVmBrUYwMdiB9YJEYB8BpexBZ2w8WEQoxdRMYP8UMBWK6D8z7wK8ZrlJpUeMZsccJlzCSQ2kYjsYGoocRwm4MtxMZ0lJpEoMVwbJNZ80ZkGkV3hMZlqIOnea9/YsM7IgIOiEN1/iTGAIAhekwWnem/eNSfMiRIGvFFARgwRuMDNLA/gKRIAaDDdlzILjlIhNwePcxIG1kGVRoCNlODFdjAikxHLcDIj+SSz+PINMI5lqyR5BKA7cMwGKwB0cIaA7ABQ+CFXciFRaCCf0TJu/mBlZTJLOGol1wjuEtKGlE1aTow5ustvJGFacDKrMTKZ+BCinxFrAECpHxKJbkIkGPKKKqWsawRYZgaqaoqPmggLbTG8BulW9DKu4SGYSxKrJEBsWwKHGmKKlMIv5wwZCgGX4AFWHiFxVxMXygGhTySIDtLKOogwlTL2yAIlxMAG/ArN5zLq7mCXLDLJhMARbjLu1yE/r3MmxWwTKTAkfoiCGEQhlr4BdlUwpI7BmJ4BVdwhd3kTd70zd58BV+QQCORzMncIMi8TC/RNQhAKyIIAXu7mguwxj7ISkkUhNO8SwlQzbvpgNacCLSIiERchl+wBD94AyvYgROogO/KJX5qgAxQASBYgz9QBRMUNmOAhd78zf70T/98hWLQRadDTg1yxuWEEMozPZRCAxyYQapBAC3ghWlIA4fUgqwMwjbQTq2sgu7EGk60DI1ZBmHIhKVRgdWxm6+smrkpq6txgB1wA0w4UBqrCGMIzv/EURwNUIyYUQa5xQLdHolDUBqBoJSzJkFIAw3EmgOgAlTQSkGQmhrI/so4kJoh2NCsNASAVFGsYbHJKIha8IMf+CEPlSYX+AOvAU9nOob9zNE2bdNXqJYebRCzBNLDqb4hpZEsiBpUtCbm00uH1IFDkIbTpAWpkQAslZoWuFKsPIW93NIGWEnGqIU72IGq21IyFQAVuIPbpLFicFPg/FQchYU0zQ06rdOzETw8pRFMWFBU8r7e+soVMIRB3dBnmBpqwEpUOMVFnQZFwNSpaQC5KIhmsAQryIBL/dWd/IEv87E1DdVnzVE4RcFTLZxOUtUcUQbpvLg7mgMfgMOvbAFBgAZexUokcgas1AW24lU/+NWnOQC5EIY/cAHpTFZidAHWGjEbhdZ9/sVRX5hWagUa5bxWE1EGmhQAHHDBFBoCf/xQPngGctVKCHLSaZAGuxnXK6WCejWAhSuReFUBAkDWeqXBu7GBBcOuZvKFG+XXlXUFWDgSgPUZUh3Y27AxqTmxLkKDE/hHCEiDCYXYu5RE68RK6dyFReXOZCWAr2AGjYnXFiDKZA1ZJByALMDPz/pEX2DZN33WV6haGYHZiZHTmV0QN4CaC1BDFSrJk2TSq/xZ7axQAbhQrLTGidXOWRDZAfCKgrAEIABZke3ODMCEk2XTrCVc4PzXr9UXYhDbHKE7AXAAAwy6GvjTA/CBU2jbRR2ERM3K4xuEK/00kc23WsACCKAb/r/1UDcI24ZShsEtXMJ12SL5UcRFnMW1kUJAIshaIKrEmgFAgT6IhsvlVVmIGgjIyowVgDnYUGswXWJ6ioOJzT/YgLuJ2nScXop0gbqS2etBBpVt3ZV9RCMBRdkdl+KkXRF5KCQ6gNJqnnP8TAG7gAsIngEYAAfIgT54WOC9S1uVGlydhjaQGirYUBswXU51ioJYBSygV9P1Ww4YhuzFHu7tXmjlWiUR33Ah3/IFEWXABOk8ALdcHvpjWDligzG9mgG4X/zNSunUBazMXAHIAe1sVNMNNqnIKxV4WjJF1uq9xgvgvM/y1Ahe2Vd43SQJ3wqGFq/DYBOxhVEygAtM/p4rCIF/lAA2sAZqIM28oVsUnobbmtgY5oDTpAYSXlHVnOGnWIUs0EkFVmOq0QACZqpjAOIg/l4iNmJjEdgkhpBakJ4BAETlScCTFIAO8NlpoFKp0YIVnoZooIU5WIG41WKsDFqszAW9aYDT9F/pzcSiZFanaIZAIDhD1OE1JkYVYF6xguCtJdwJzq46HpZSxmMI+QU3kxoioKr3edCpOYDEu4CspAbpYYNHJte3jdtomBpaleSnwuTuxFel+IUsYADVDGVRxhoXcODZwdo4htYhXmVWppU7fuUFGQYu9IE6ggP4IaABsAE/QIZfmJpznYZJhipjBuYNbWFFLVe9/nHnaaAGEFjjCToQgiAEFpDmgc6bN8CsH8ZmN13MOV6SneHmU6nmb5aMEU2BqdEB79ujEgqiPxAGprgtoY3hE5jn4DXUrJRltp2GPhBlSEOIM05jgoZpqhmAwB0sZEjoT13Mrk2S43zoS4no8TqYwfzpEWkG+ZIalrmbELiDMhaImn3haXiGAeIDXh7p09RfAeDf3BOAQ8DKaADkeh0AXECGTEgDMY7psxYACHDjmFLMm35TNjHVnjaUOtS3hFEGYfiFWliFvU6FVciEVLCFWhAGnY4dP7mIHajBN6iZprgEhzyArIQGRJ4Gdj2BE67qaVBhrDQnAZjqaTBeUTaA/huG2qKM5mL8rbsiBreO1gvOko2Uax+ha2FrsWFIhUB4AyfYgQ6AAEJk0arRaAfQABegzz/IBFwoLMGEk4LFGwjIAqLrOGFAolwA41HCAHke6dsyTQqVGjRIZNFG6+8eaJp+KzhW7f98hTdx7ddmEcUNOMUY0RJ1ghD46pHNmy0dgAzYATZIBP3jE1O8mgawAvHWCKWoaAEQWq10BqpJg8vGys8VWpV24WloYfCORTksbS1d4wD4zqEOm1O+aW1mk/RW7w0Bx/ZmBlu4gx+oyjVuABd4g0vo6OmI7cYwWAMAAkSwq7ATAB84TeUFot+9bDYwZKxMTQEQ6Uu+cApX/vLu9AMON5prLm/gZG0u6cYRBxKG3rZa+IMcAOQkR0kVWANMMArd+AVr8YxaaAEbIIQxx4rCc9zThIariQMGr2es5IVVS+klh2kvT1YISN1aQugoP+8+2UErzxMn3yaCuAQrkOX6jmme9IOO5vBVcIEAUOtqXjh2lhog18qj1dzLlgU8h+pbhQb31POK3FI+J6C9qVc/uCtliHLgBPE3KXRDv/JExDVkcJxRUnUk7PW7GQAVqAOmpoxaQOyp+UL6OFrLvcvPhioGJ2apGVRqmJrfPQXvPvWYrpt6tay7Yl23llbDtvUpwfJQywQBIm1pVgGOJszYqIUfaMWpCa/5/liGIpCaztbKO6eai61qosVKnfTZWzjWbCd402XHtyoGDwdiV37Hcc8TYRuGN2j0LnxFHf71YnSdQLinSP0FK5BfrBlI9gtCAD5NrZYafh9pCMruxGN2fRaEPxXZiy94WETWxXsrm25dhffXQClih/eRKX8ypqgFJzD1mS9GGycE+qFFYcgC3gZ5RNcKurPnu9QF6TQA/q3qz+3sSNZKaYiDFTd6mg/7vDlGU45yb3aTuPZ5FZlHH0uITACesXd0iieAHYj04ROGN5hvqQkETOgAAnB1+HBzENjQUxigX2bwSyb5IET8u6QGRTg+DJd7vJH5inyDGS+mb0/oEHTJ/rXHkHK3MoLo5K6cfIpsgTsw2YERBlGSww5Aom4PD0sQpiuFBrtk8GnI0knESj6QGh6/0meIA9Iv/dFW4AkYGLbwIxt9BVLQ0cKddcNOBhH3fOYA+ouJOagPzEAAewt3VG23Ggf4gUAg9sA8CluwgtUpxBJSAOynCnY18tsnV7t982k4BKkRaXLdhTbogOHnfyTcZN4ACGbJBhIsaPAgwoQKFzJs6PAhxIgSJ1KU+Oqiq4waN3Ls6NGVsYoiR5IsWXHZsmTGALBs6fIlzJgyZ9KsafMmzpw6d/Ls6fMn0KBChxItavSoT2PKTDJt6vQpVIkoCwobVkuYsGRTo0ZN/omog4CwYscKCED2LNq0ateybev2bQYgbiz9Sklwql1hmLJoCBvA7FuxAbJyLXwQpZOwWqYxbuz4MeTIkh1HEwttGq2wFyZHjjYox4HAotcCHm36NOqzpU1nEcnstUDDsmfTrl0S1quPundnfGX7N3CIxZASL278OPLkypczb+68aLHg0qdTX4gJiAYIocke6ACkTibC1RuqUpH6PPr0qf8KaBBih5Usb9ZkceIiwwCy7EmjrXXY7ngRLQNBWIdwdiCCkhkQ1i7TWBPWAAlCRg0tWlywnnpurZYhh+pp4BpsAYo4IokI+cIbihxdBEuJLUK1DDHPyTgjjTXaeCOO/jkqVwyALvr4I0SsEMDehvuJxYEWiQjTo1bUpYRLER1KOSWV+k0JBBAusHBCByy4AIQWdSgJZEGpWCYhmghyENYi00hzZpqPPXMIGhzkVyWep22Y51v+QQQboLGROSihTCGTW4qJglQoow4poyOkkUo6KaWVWopTdI1qCmQW+xlZ1p4QquDGKndRp4wbd/L5VqgZtrpqep+idUAWvwyaRVgtxLlrZD6ExQdjCwrQIK+QQUMLH1rkkEMLNriQgw8+AHECAbCi9qq1qNURUaAhbvotuAghqihvvoV77jKXqrsuu+26+y5OxJw773h4QFhDEEQQUQUaaBARRA0hOFCt/mBiQWAFIshMl0pf2Yo1wAEOOACBBRdooAEIIISgscYacHAxBhVY4AACBwjrMMqmDfCDrT86ENYgxco8TRthUcFYw6jMjGY0bGynFrZTBp2yam6pwG23gtK7NKEnkssbi0xrqgwy8Fp9NdZZa52c1F3XtowDfznQL9llky3EChcUAFhpBOwQyJK1CWOFqmkNrdYACFjAQQg44CsEEWYLPjjhZBPBww0rhKBBBQgQ/ThaBqyhcIuWQHjZzrseEtYKjLUAc+YH7jIEwWKdDDnqHQ4gXkNJK+017CIa8zRvIcVOJkrLHLM17737/rvvtwsPFSGAcVC44EEIjBYBNsC9/lVUtmTQYQEOgLCCDUHwizz33XuPhhA3oICBAwaw7dfdQKfOlgSXtAhEWDmEvussYTnAGBVhzTF/ZLv4OhYBXjCGTzxgfQZUTyC8tRDXDa+B0xkX7VTElaU40CQrAR4GM6jBDdqISRX8IESWkZi/1OB7hsPBBeoWluYFgnJPuYMKTXOACoAABzwInAlzqMPuVUF8GEDAX2LIofTlaWWsqw4ytqMI/qUJGmeag82Y2Jhd5IAsDHgCJT6hxS8cUD1ERE+ogLCM17QuaSA8o2FgEUGP+MIpy/DFRWyHxooMh4N2vCMe8+gTD86xjwdBRgcAE4Qd9usG+DnLAX5gCeid/iQZwtgBagZggRPcAIeEvCQmkfcvFFTgAF/kT4c+iRYM2GI8KQlEWA5ADSmiaTu5mMYgwuICKUJDC2SJwBe0qMtPeCIBeBIlaWTVxQUoUCEM9OMHjwGLYjSDKcVYY0fkSBJlYsQVr3AhMh+SLj1ys5vexGM2w4mQXzQglZYkJA80UDqxOCALpRTJMobRsMBYzwbnzCQ+81k4IdRAAz/ronoOUIjqoORzAlgMKyUEFgG06RRh0QD/qBGHf1JADLu8aAzaAkyhCXN9fwkAJsjIkGOK83bHuMiKjlGSY0CTIyVRhjFwM66LtLGkDMndN3Oq051ejY82FZ7rXrMMTNxp/mz5vIEGBrAhELRhF8rInTEDZYuXuWUBIdCBPrOqVe8RoQYgcBxA0/PO6QzjTrPgny7mIAs0/S8O09hFKud3i3kKIAIWvehFvyDEsPJVNa0xSFDN+FPY4YYjyyRJNaEZtZMUA4IqwuZgEbI7nlK2spbF0TEoGFkHBjYZfxALBrRqAwuMZUEGaAEhjgjYMTJjGav4J1oQAIIbbLW2tuVhDTBQgL6aJhXV+YNZ7jc/alzIANKQUM0EcDMnhuW4M5NGGsaSACjgtbpn2Ctvu7ghDjAysN3arNRY6pGLMLMicGzpoiiCDKft5hU1Be9hJnvZ+dK3vkhRKXwrSFIriAUF/lutAg7AWtofqMIgAFqGMBABBOyGhba3fTCECxcEFFA1u2k5QAv84NPauCAsaeCfQwUwAOciaHMCUEGwwqKLme2CrkfIYnWrywALX8tVgRnALzSbDO8GKr/0Yu943bthhcyupa/QsaOMAeT2vqKZPjZIjOwr5SlT+Sb4ffLwjokS84QFq7WlwlfPkoE4DGMgy/hFIbSw0I6OhQoR1qEa3pzJKtRAbaFEy0bP0gBLEFQZBDvr/KIkAB+giRdhacA0qEFVWshsEKV7QBliLOkX0LjSYvmDjnkMKCyD61DlsiYsrvwQxz7tvUmWKblMjeVtVrnVrp6yqDkNVMEOowIQ/rqnVnWAAQOcbgA7+MGFQFWWh11gBUE4yyDlrOxlo0EHHzhddgdQhyHLxkwBUOX8cgGYtUqIuQK4DAoWZKBdUSN/YkmCpNM9BUtb+gSZ1rRIZd2o82qE1CqSJkPUuMZXKEUhmlVGY6EpbzO/uuAGpyy+Bw47kr42lRCuAhFsIAH+FKDYQijbWbzM7I1H+Ao64AC0+wqEZlC7K3fgHP9QEJYTxGk7t5iGEMLi1jhJo4phScAA0y3pM7C70gMY647h/TqF/+hQ9tZNbl6RKYY8c9/KQHJBlnIMekNT1Viu2sGzrvU7Jpzo8+pRvINeEEKI5QJyHsIJoH0ADKzg4oPL/jjH4y5nHoDgn3mukgpUO5tlaMEsHw5dLMPC6DSdgE3TYINi4gSNEIhFBI7Qebp72XMaW6EgQh+611uk7337ArIGOenRoQZ1giiDmujtTckHu4wLbr31rt8ajzIvtWVcog5aAIITrLCGP1iiFmO8yzJwFRb/KvsGGOBADXAtOLjLvfkRDoKdwFilDrTsN4k5aOh2QbCbxWkIMp+GH+KXJmmsKSwv8ATkdS6Cydt4LHcXywFwQZDLy/5HzQh9ihDli1gXJLHk6vdBwJQa4V+pDRxK1NHrJaACskv9MQ0mQACRuF8AFMAKaEEg2EJKLEMLCJLzFY4KOVgHhqBt3cCF/rzflEhA9dHGMtQBaDWVzDwDgQiAA2BOmsRBWAzBNChCWHQAmlADlwmAEaQf5CGBCU5eEabFDkwFSTXgoBDD6W0ELHTdkiXKK3gQMjjhE3bEkSncoyygF35hpIweEzLKmYVGACjVagTRRwWAAajAGiQCBApAAShfB0IbCIogHmoVgC3AEWYICqaeScSTApDFBbSBLKwSmjwDBkAIoMWJibHcLdgPmkBSWCCBEEKeGPShpbEZAg3EEo6hj9wfAT4NeTnZQGAhKX5eYWWhR8jLwD0VGMaiLMrIMoghKA7KMrwBYBTAAljAAixAARTAAKDhRwkGAaChUeUhGqhQCSmj/jNmlRCAAIOhjAboXWHUwg+WlgqwASrQoGTcQoUZQrFEogAcwDREw50g4oHwgVjEwCVCHiWwHxhxYnoYgPv8HmuF3S22yBSyotIpDOhFkCvGlP+x4kY0GdHJ1ywuJEMeBf/tI6PwlwAswAdUpEVapAVYwAGsTWmshgY4o4CFRTM+I0nmEw5UWOp0AMn9xi/UQTY+zAAg1ITwgaoIgsww1wBAAzWIxTMgiC7cSQm8Y/oVkDyuR/oA0wC4gV3kI+ZBZICMInq9wiru20wZ5Ee4ogEiYENuJVfyxEM6JS4C1xleJFmSJfkI44bggDLCllqWpFviUzROI6zsQDMBYlO0/mQLhJw4PgYtLJSIjZvMNIBZvBxVNaJkUEPhtQeMCWW6ZVSlaaL7UUkGkEruMBJYBkg/WqU1aSZnHqQtwhdKdKVojmZNfOVlAsmZoaEFlCVrXmRG7hYH4mFICkBbvqVtXtIeqk+VlMYBOEGZSYdr1cEOlFM59mRjhJhm8ELmnIBZGEhitglnBN4A5BxjppsXFCW7EQAEhIAL/JoW3EEirIJdnqYbQWVnnmcWLp2sZSBptqd7GsN4kqcpLQMP/EUBtCZ+YuSdHMD2hCBsrcBtBigm6RrqDIACJEJ8lgRUJcMvbIcNOAY7KgaJzYz3CYBb/U8fcAY1xKA7VqfOXRd2/uqmARWJWRzADvCZfNZG06Eni6Knubxi6bmnjHJldCRoilKHLXzUauYnfpJWWFQAHv6ngKJBnA1pDhGBNBJNEL2BjcIT9KAS6DAGNAiBDxBL6EDRoE2DLQnA30nGIqwQI3go5BFliIKSdrFNAIRAqdyoYZhni75pBJkmfD0dwM2onc6iZbIpmcCPiPFoflqA8YTgFcwm8RmpoZpQFYTAbJ7H3ZTGD+SpbdicAVhDQjHGI04DlvLgZHSYALyAmEIepZWpqEpbk+rpQhjDK7QCnK6qQS4WF94prHohpJqqj9TCkJSjn+KngNVm8xHqof4qotaAgEGmapQGXVIHOYUF/geooxTlQlgYQBqoCg94Y2NIw51E2qdap6hu60HRqlMM4EGyqriukZzmFyzGKrpuned5K5DcAWDsaK6WpVKFRbI1H0oKwAcAq75+jw4E252xhQ2YInAsg+WEBRtU6pukxQUYJmPooAAkQLbq3CTIJbfSmBuw60qNq8aentVx2lKwXrqGbKsdQ6li7G8sQ2IOQLy25p0gAB0qm62NRaHuK81KmI86jAoIrG2khEQKgM4k1D8NQPnJHLOam6dGrKR5wvpVbIgOAIqaLEVkppFtbBZCEKJck+xppchuLX11HdT6iC3kxwDc58qSJaAGl/NVwOmAQM22LfIEQcxmiwuQ/lzJVkQzNIwCGGdERVfZ4cIKlg4K6G2weQHSphsUoA6xbuJZQAAy1K2pLoObuijVKoovfGZ+hSbXZu5lqefXDoobgApFlu1FLkDZNV/chgXbuq3qDk4Q3KyUhEoSOu5ELEMtCEsHMOvOzNVYvIFWoEQq+GsDLJEuiMViFi5e8ZziakjPrUYWyC6bSu3kWmXk8obz9pFCai72ftPTdS6juEAQwavofgBYBcBHxt0ijkXqrq76lg0PnC6fJGFwpEQiiAUOhg5NikUH+ImZLUMz9KxyCUJYRIDxplsEYGfiQo4BWCP3Gtj0jlf0sirnGiDIZi8F49FSVO8CFwYyTM8Z/mJA+Fqk45jF8WzcFZyvWOTr+qYw2fAAadGjegzBdPCdWNjkzDgDCgDGAGTBUxXEVvjByRBnhw5wdRkBQAHTAaPMX2WwQqDiA6NIA3Pmi3odq1UwFW9QuU6QkvmCL8CCFvuCMVxx58qC+fTpB1fk+GJAfyqbCYdFaKmwG6MBD4TNqmhBDP/gKTTaz0BAJjTEL6xZWEyBEMfYJGgX05pGADQASnyXEidDQTaxI+uG165nFU8yBkUyV0zd5gWZFy8yD89vEJVxRcKmACBAvcoZXQlAG7+xG9vAok7JxUrHL1DVAbxSnDyDQYUFECgw8C0DFsyrAJxBIMfY0hYydiaC/mBl8Ow88SNrrKsS3epRMjTDnuWaBAWhav5dLTGs69emhC6aBdmW8W6V3Q2k8YOBAFmksiq7MQpQbGoMACFMhy14kgzqbYIYwsk4QCJMhL2IWPEGsy5dJzFjZxEk8qYpcSYvM0JrIQb3UTQ39NXUBsA1shNfBDFM8+MmgzJgAfyB8geQrvshwAWggA6Qc1aZ81igczqrcKLajXoMgPvEbybcSQZQq2REg6CFxQ78Zggtgx+YhQD7M155woylzBFjZwEogyIv8DIkNFN/RMcaoENHNbssdEIo0xMqnUXTqg+wBwJwtAWEM1oA6H+ZtFhYQEqnNBEsYuIegHhSdUOE/p8I0/RjHAJxluM7V4TwHS1QX9ThBrQ8BoAlJHXnKgMcKXNTr2oUZ971SjVj6wjJGsbTUd0TwoI2m6wycOooc/QHWAAQnQUC2BZZC4ABAOlZp3QQ3CuHOEAK/sbnsjE9O4Yz3LIAuMBqSwQlWuJeXxQlrJMRFjIWCPY2G/ZhI7Yly1qUNTZy3wh8ujVGl55wIx0ALjAybGBYfLNmc7ZfhABok8Vnl/ZZ4wBve1EGCENTysYbsBO3NYZElY4BaJiTNkwu5fZFKYFf09ieqABTlre3Btxw93czS3FyBziNYCUWS/RVV64SI4MM+IV1czRYFUAaFyk+qZzpJKN3p3MV/gytqwRACzB3Q7S2iLWBc80CXbmA385qQ6CEsACzfO8SJYRcEde3+x11jy3wVPZ3U78CGD/ZYgu4jx+Hhw8E9LLif2/zD7CHJGk2BgDGzGoVhbPThXs3EZxtH2oBihsGIajKAWhBzPkFBOSzSQyDWExCi+cVrBQ1u2ELBuajdD83jqsIZz61wh33j9c5cez4SQy5Qeq4EjODRpdFkoOyPPPnbT15WHR3lJ91FazA2nSIe0vHKkwPWlhB4wYiJjxrmeMVCch4zw1UQXeuno+rm4t6VvvYFNs5qg8Fns/uMtx4ixY3u9bBnVxb+GK3WIi1ba0Adyf6hRPBB6hOJgT5/kI0wxrI8w6mAgYHgk9n+kU5gi+xNJWgeayceVgw6ad/7ai/+auPIdalurf/ROwVBhPDaWVDbSZQVQAQAPj2KAKoEAKQdFbhwGogOq+Xtg6EsHo0gP7GrzAUwhokCVWftwCYALNf1BhwumhIe1o86rWbrDVru3+DIp1/O8XjhLAX2aoW+QIPwwZ+VAF4cFlmJGzJLITJe2nQe727pYTr00pniAfo8td0hUQeQcFfVBQkL+JSSQsEnT5i7EGHK8Q3MdY2IOZWvNGX5mwoQ7YnCqybbGutATEKAAH8ImcL47CNxQFIOoSX/K6nfJQHwcijhg0Ie4pT9TJw6hPU/EUR/jERhcoRKvxujkYAbADP6zebQu7SB70WPqGcy1st9vjRB37Tm8TPoycnI4QtmMca+kXBXBsQFEItbEeT11YNkEUBeD2vM556rAHZS8dCEa7a7xISIHx2LQBTgrre43hi11/gt75LhPtsjDt6avzhW4IKoCH6iFgIZIElUNCfGwC8ixZZDADm8zrYx8pdww4EBgAZhH5esfO/kr5aEECNQ23ep35nDv6qub7rd/5AIMNmtmgEH35B1EId2McPZEEcYMJKEsQwCMvk19YNrMYBFD+vV0Foo4YBrGnXLMOdsDhAfBI4kGBBgwcRJhx4RoQAAQEcRpT4EOJEixcxZtS4/pFjR48fOSYTOZJkSZMnUaZUuZJlS5cvYa405opmTZs3cebUuZNnT58/gQbN6StmUaNHkSYtaQxAU6dPoUaVOpVqVatXsWbVupVrV69fwYYVO5ZsWbHHlMZUBkuozVdCX6WVO5duXbsjlyXLm1eZXrxvHA5AM5hwYcOHESe+MVFwYsePIUeWPJlyZcuXMWc+rOMAyIsQft0V/XJYREoKUadWbdALg4oZX3uWPZt2bdsRkY3WvZs3S19tgb4FPpx4cbi5eydXnnKZWefPoUeXPp16devXwRpbnkzZst/GgRLdPp688rwqmzl4iEIzZR2M28eXP59+ffuVL2iMjfGE/rK+5e9axSECVivQQIXEICGBAR6aKID9botQQtognE0YADHMcCXwOOzQLQ87fKUYDUmkqznsUExRxRVZbNFFFP9Tzr9jQOQJrRJxzFGpOwIjAg0hbsjBx/vQeG8iIpFMUsklk6yBwdp+0FGpSxxq4MArsVzIixcYcLDCCcHs6EsxwWxGyjOVm6nGNdlskydY0IyTpWJerNPOO/HMU0+zlvFvPGWEc9OVuOQstNBlLoCIgxUQkAgEInXYj8lJKa3U0sSC6Ky2P84zlKVAHIogy1GzPMOLIygYIIAnHwzT1Vc9GhOjGD2tFSm2BM1VVxCRs/XQPYENVthhibUOLT/H/sNVUPF8bRZDRBo04CIO7gvCokuxzVZb+6rAoLYBLunUWZLwcEgEUtEd9QxTjSDhgQQoglXeeWcb196WAt1V332FIuZeNI8pVuCBCS6Y4GLEHa+YfNm88d+HdXPBogE0yM+hIemzdqIqtu3Y448lc5K2A2x5eJllABPAhHRZRteTdb1A4gURXKPX5pslOgDinUUqht+eGP5ZVzh5xtHgo5FOWunrTk54OWRyJbToqZXC5UmHDGDjmWmo4cAh9uoTwiKOQS7bbJCJaHS2Cy6892QsHDqi5ZY9mftlMZ54IVWc+ZbVswuo/jdooQkn/BWHAy/vxKUZb9zxx6dCHMDB/kNkNvHLW1omC4lU2Hqaz+dwyAL7hNgP47NRT91SDPzmz8x/f3DIiLlpr30hKF6A96PW+Zb3hJMxtxXqwokv3vLgl2MK8uWZb15g7Uj0hXLwDkfeepSWaSAiDD7vfppFHHLAPiIsOl31StU4/2MUaHPiYYkFgML2+W0nw4gue4+I91gjBMLp66VEjOINUGivkBoAk+M8BS6QgS7CkZrYdEAEXo9KEeGD9z53CocgYHzlU98HQXgfHhRgNm74VwoeMgX6rbB2YqBAvCS0v/xpZA0TlNP0CBgUHAJnh8aRnA1FE7AGDpGIRSzL60o0KDYdD4iXW4YVJBINDH4vfB2c/kgQQphFLWpGCGoDyQAQcS8NOEQMLDTj3MbwgBmuMSOcaqKOjtHDHM6xQ9B742iMmEc97rEqdiwRLOTYFj/eMXDN0JQAcjDFaQzCIRW4T6siIoQtTpKSkqmCxUBygFXYSwIOGcMZQZkuSrxAhmyUlyr+R0jyfIeOrXQTrVRpIj7OkpZGTCWAFrYmCcayaJiQyCkUGToBaGB8kHQIFSqZTGUeJgSyaUAtxqUeAZQhlNUk1RFMuTvPtK4Zt+RlcgJJwHC60i0//KZSlEGnWq6TnZAzZ4aGVyMmnvNhbohIA6ihSCo45ATcsggWlxlQZdZANhf4hTfPJC0BnMGaDcWS/ghK6SpZGTOGGqAngOJITo1W7qImUkY7QRrSow0SR+P8yTs76iwoOiQNipzGCRxSg/tYRAcCtWklM+WZDrTNVk9ihEOBWqAzZHONA3BfSsdj0qgJSqk1IhpSlXIyIYqUqlXdU5yI0VSd7BKqzlJBRHbh0icBtD40velZt9hFz6gAiXFixluRURFHBJWuqSFBbSgqr/1EVCKEQGhX6ZLVjQ6WOCgFbOZEYlXFLtZFvZISjUD01MM6y2IncKkuIkIks6JVSenjbHyqIM2PAMFQb2XGMCASgNPUlbUH8QJR8zcAnk52N8oi7G19QlLawmQZyGDsb4FLHd3mSKs5Mexu/tGkPQH0waWKqBKRruaQG3yWuoPxLOq8BRIrwFJHb23GLyJSt9aOVyCgGKrN+AqrFiCXN8gwIG5BVNzhSJa9RVFncPGb37D8NUOADFF9faUpQ7hUmBggEgklMt3qLjh17APJG+RkWlsEhrwV/sR5YYuzPwBYNz6D722DZkDucjhz+jXxibNyXBJ5uDivIMUr5kliKSn0EC7NwdcOHBsFM5jHZcNBdDlSB7+gaRkCEoABLFxh26RXP2KKqGz5K+OYSO/DVR6UiqVcEmUQA8Vd9rJTRmSoeBLHgK8YbpZLRGOXKrem9ylAbGTaYzl/jAdA3kgcokweZVSQAUkmr+52/sfkCT2olFYAHprn4l75WnlfMUb0SbrzZUmfOM/9bUu+3sLVozSjGGF+NFJOptBFKNIZESGbfRQakTjPmdXaUutH7iAnSzjkAX4ebwS2KWhT1qLSn1ZJRmu0aEbfRNO+PonyJp1sxmIZKcg4xoiLIkDwOBomx2AlfY3tklA7ZNRTBJ8ADgAZIhAhCDq4QQ1wgAIQnIADGmh3uzFgAQxoAMg42BYcWj3ntIEk1mgqhEMoYOvWvhAkhN6m/mZog2zPRdo8Efawh1O9ha9kccq2uEiJ0WuYuHdQvnCsUSBLZlec2SXG8K9NSD7xkxDAIYpQJBsccoEg3CDdIMBABRyA/oBUS8gAFgDBjvMd9CVdEiRrYIZ/oE2eZfjBXAKfAhRW21BPNESbGfZMJlSeFkA+HOIgSnnWp3pxsa9T4zA5uQFhwWyUvDfir/g4TIxBOWxnPSUsFwAqpvEMXhyCD1rgwc5naAAMIFPohUcSCECShu4kfTt94pEAzuXn1wYACUD1xAusLpv9WZTuSVF01+k4986TZOylp+XXkwLsmrwFFggzysl5KPqVICOr05P46FNyz8xPxAAgOLXhgS+fFdg5I05AFomWYU8BkMDW2BRADIKK+d2/qoa4P8pMxsl20Mf3+NYnSdhNH/4hMl7rOzEgMdrakriTGfXf37pPio17/mFMHyMGQECbg59/zTiJdwGQwdsBBGUc4gVsTfoqD6icz5R0rSOwzvuMgsrg4sWsjOtuQu2yTvwwsIGQ4dDuQvXML+1eohm0Kv5MwuTGyQKzTfleRaGkZecA7yM+QP+Q5LoYLAjsriNCQBiYoURShgD9jOC8IKiQgP7CJABwwQGNQgS3z3iQECXALwOhsHFGhAPtgpUcblBgof1sSyiobSQ4DfaCQvZGb6Vcxf4QAAFurgIwYA0vQAM04OZecCMQwHxksA7F7ZA4ogKgqezqYnOez9bUSADKCKiegAgbJEICAACbcCU8cAn3RQyRMAol0XH40CU4Di5eAf1WouEE/mn2BIvMUNDXmC6TEEANOQAFVqAGgkAIqoAO0eDUrsAwKmAiKgAFMCAOHeIA8I+S8M0Os4UIFmAjKiIADiARKjGqTsYPoc/PnoShgGoKDHHQQmMRY4LFHFFf3I4aT6LiJrEbCcYYqLAKeWhQMjH9vi/ifu39jAMSs24ZLkIBOuDGHGIFWJFIKmDnHuUVcQAPJ8LefBEyaFA+ApKSMKkjsuAYQe1kVkpukmwSImISguq1ojFCBqABtfElKPAae8LTLpI7/IPLvDEkBYY3Qm4dh0up5qkZ1u/SdiIUD8u0YHIHTcIdHWIOUMEapOFzciEwlGQWHaUwqgDxMMICfu8f/o2yMDggrzJiBzYQQJwgbvzsvAaArsQgmxawI9wgHDsSJS5RI5dlK2dSJMVSWFwSJqyQJkzqvczMJLbwJwaJ07TPQ9ixvmLStGZSGSJCFzDoEKooSXwyIojJMG6AHyPCAYryKI/SwS5iry5gFRDyKJ5SAGYnyapSAPosqMpgIiVEA7QSLEvQK5lKEbXRP+5rLE2zTvxlN0QwI8txJNrSJ5gFGSAwgsoSquryrUjCtGhSAKwBg9LAIQwsSbILMBGjCoLxIhBgCBBzOQfDBojPIipiDR6zKCLzAC0MGgUg4IIKwzTTNhBhOnHvLEGTQwyoNrPOP7jxNNVTRcAzJV6T/jxhrBjAMDh8QT7RMieEDcZ87TZlUiR0MyI8p3vkEWyQZDiPLDgPIyjrbxeZ8x+DAME8wgWmcTliRwCss8KGUAB8EKgcsjuX7AJE0zNJIiPHswup0U9Kcz1V1DpcTzeWgetIlF9uD834kz8jwhkwSJoY1D6Ecnseg6AuYgCArkF9kQgOQIYOwA86UzSA4EGUwM+cjyGDykP7Z0lFVCTiKEYdkQS30rdW9Eurw0rlYjbHsy1MFLlq9Dbz0nugISJckT40YOcQNDGogDAdwh+J9B+JQLQ44kFUgNeSowic1M9KwCHkh64Azequ8iIM7UpVghN1aV9INEQ9M0XB9FLJ/sI8M0dLIW5GpSxN6xKsvIcXsGZJPmAiRkfcvGgi8jFP/9FAYSNa6qA9U0JQA+AJ/AzXBCAI6Qp/ipD+AkALxFRE47JMgYMjHZUkvBRTmXUsaPUkIHWwONUtzpS2QDUmIyIXvIcvBUB8lKRHRUcyrsACMCIwXdUXwdUjOmCTdsMFHuRQLUx3yKCudJVK8SoAXGAYkvUkGlGjpvUmqhUsQbJZCbYrmnI3/hXizJHDrhUmG+QWvCcOgHNJ0tVbJQNWffSzBvJcK2MFZGMArOBg78JdAwBeK6wZ66pQ7TVCDoBThrUj445TE9ZDRIz8RPQJCzZnq+JlkyKXjLU4kJXE/hrWtCKCF7xnnwQgBAZjCDAADYe0PZpJIixWMhQTVQ+TY4HPBmbDAQphNFbgQVTIwjCMtRJwZW9jw/a1JObzZx3u2WxWRHU2bq2CUuXiPbvu4bjUWoeWGVRFAGbBe4DU3ohATq/2MqK2MC0DBzBiDrG2DoPgOTdCQmkVGVQAbJPsvBKAtQqRXhY1TLIgbU3CgEiBbWETdFMCZ+U2blNzN/qVdIOj/QBrb/kWIv62e7xGAGQqXbt1PqpWABbgMhYDOd+0cYPu1TzjAOLgbV+icgUgbCvsC0KFtSrTbG8jjEx3JLLUdbcqb6sNkAJWxlI3fJ1iYemiL+z2Z2a2Leby/iX39klowXukCYv4NCJaVTN693cvQwdeMAAKgKyIF/iMVPMCQAUcczq/qnmTDAqarq64k3pnA8qudyR89j6198pMhJXMjGdJDHXFl1lbdDS6I327TlN5SXafBJi650l8ZH5NLT4UVyI4CDP010v693/zL7RqIwu6CSEP2HnJy/k2NKg61IEdxCNU4DxZj4RdM4dEuCaCFikmGAs7r4Pl9lmhtYKLY327SnY1pcY+hxrcFA101yHMNTNeOCJiGDOoYFUjooZtmEk21mwK0jMyIBN42CF8eLwMsLUS1V6ZrN8mDgJhTHlnb4CauCa0ePbWlnuljIOpeEVh9yj845CH/u0VyHe3ZFeamOtzpKGFg9ci0jgzgBSN28M4g3RH3zjfxqg2hmC2iqKHk4zqTDaoqC5/0usqNWBCsy1onrgoIKiCX4GQU2LLihUtlfiwHrlghfkorJHYgAaLvzelZLeTBGAOuqdNHYIw7FQA4mOUczEWNQOHL+JpU7nVQkApPcIBjLHsYNnCAnEQ66psidgzFCBcsq11QVAppKfMilkjPbUolMHkeiKaOcxSk1lFwdGKS4KSO/VT97YDHEILuicaHCIACMNI4KM9vBnc5oNcx7mcDe+M28eVXaKdK8zunLGuJBJWIsALvgAKkIACcHGNTMjYmplak+KtYMEUXkwC/ss0E5VCNn8ikUksPQ96PZfZKH4ZG7sukjtKdoHAIVrgmiv61HR3ajFjow2gcCtjXDFi1fIvjpfzBiC3IzIAE3rNpMeLEh6ytRhBXhLgNCphICbBCwgOIzrXIkrAC26QKTV4ss53UJx6JN6KRvjZWBmZJJAlintCoTsK2Y56PQf7AbGYeoj6omRX+SSgezr5YgojXRk0CBxgTiHjk0uVPjBWAAYAT0E634SgrDtiCOiWJA44CsQ2vMYrEF0l8ghiri/sBVgurzeCoc4AfwKgAwAV0fr5JmBhtkvCtLLKFJZ7CctSGY4hsHGil33NqCNbLLtPNAClsoOjJYV2b1Uh/jBykmvCuDCCoGkdYEc1BawfA6Oxhqsv41S9hLUzQ6xb+3yMlzY2gF1JojPVurXIwCEyd7xiAFZqTSEmQQl8lV4m8xMmAaIcQgEsAdFK0idWtyjWViO1mzm4QzydGScum8MGtrvHcrJjYhmiVbwvjaDPSXabISJkoXu0JwD8FzJW2QAkSTLoO5t51EsCIAb7O98C2DYGQDpJ4hf01SQKnLWwUztba3pdBSJTwwt0u8lmgwGi7hMo4QgMLgucu6tI3PzWsii6EjRPPKCLq/OWoRlU/DSRjjcYevsSG7P3NhnU5oI+Z5UVDBgN4ATosArwWwDqFzI0RiKI5HAp4kH0/vvI5YyFZQO5LcEJlOsAVOANSkYvatvCNpf5/gxWeFU1wOCuXWVeDeILbvACLJLDlOoVmtuXf1rjrhs8jhmZ51ws3TapNw7GOyTEt3jPDziRPkdrBaAFBmOUBwADcCAIyg0FvAirFd0iwNk+FJPQ+NfIJZ3V5thVOuAPmiHK4xkqf5ilfXs1yOCuwmSWCeIMdDsAnICkaWvMdMiAhN0khLqSyTsmPtE4OlzlIHvXJ7E3Tga7gd0nTpy9kq9KukcLHIJafmSbKzoAiLIyFr2FiUSkf7LbP4a/6wMEhNsiHMBi3L2u2B1XyesM+tZVPulAzuAIXEPbaeNJUeMJAO0B/iKhm9jrptUXBe9cl0gh35cCRnGP4L2R6NPiRROeQ3IdqZYBvBxCL6fBEMJ1MKoABSDX9yxDbDamSTCC2z2+x3pXNgzABxZBGqThFvoApizi5OkKCC2MBG5ZIxr8Ss5ACSLA4DwjAb7gDEAhNc4A1XdAOxw7cc7cTMvcsJdQ1quNTKmnzKVs4JEeAw+fJF686c20HZPB7rz4FngSKG8ABBygAAagACogBIb3MbxeIuy7m8t17Oes7D+CCqRoinRBC3YO7oMKf+B5vFiefz5C5bGEEmI+wiUCnR8gpQX/E6AA0BRASf+akOILdv/9btUu88FD6bPsoyofCrk/KZYB/uE13+F8nb1WmQq+OJKUpPXXO0lMWyLKWPYXTGRAIgRu3KU+BxpgziFsnrwAIoCAAWc+GTyIMKHChQwbMnwhIKLEiRQrWpRI0KHGTwW/kLCYgCKDJxsZnhEh0YCKVc2SuXwJM6bMmTRr2ryJM6dOl8dc+fwJNKjQoa9gIdP5ylXSoUybOn0K1WkxncZeLY2K1aevnVy7ev0KNixNYgDKmj2LNq3atWzbun0LN67cuXTr2r2LN6/evWuXLROrs2fWwYQLGz781BjgxYwbO5apJaKEaZQ1RKyBJrPmzZw7e+ZMpCKRz6RLf74xwKIG06xbu34NO7bs2bRr226N+qKA/gNU2FTRMocX5eHEi0/LEVFJyeXMGz4KIJBS8+nUDVJiIECg7u26I0ivrpAMkhIRQiaAzuCImILgDXoJGdFAFmR/H9u/39UX4qavtuJEZpVPARZ21X6F+XcTMrAUaKBQr+AHYYQSwnQMXxZeiGGGGm7IYYcevlWMXxMm4wuDDZ6IYopNwTJiiy6CVYtEzlAmREQh3FZaaBSNhqNpOlyEQY9CDklkkUYe+RoPqVV0wC7GPQklFREh0V6VJkGXgJVaMiQGdNx9OZF2JXy35UFnnIkQKFZSckYJE2WgyotyNmYiiq8odlNVP9WpomF1vnLUTcXwCRShWOE5Z6KKyvRh/qOOPgpppJJKWp+EyizTZ6aaqgjoop6+6NcyBEQ0yDTU8BFRBUiioeNEQqy62Y8WBQlrrbbeiquRQRRQ0SFQ/lpcFRElUeaWYED3QLHKfvKEdmA+G9ELy06bkBjYSQTEMJ9uWxOAm2oVaE36KUXKt5wec9MxVpEy4KYIcguvhMZMSm+99t6L76NTWaqMMsWYC3DAWO0bb8GN+dVBREJQdkpECKwq7I646rAkRbTminHGGm+8mRAHOKsDsCJTFpkARlALHhTQiYDylkdAC7MAY7RMLSVGGCDRAX9UarCnxiBmaFDE2ORtu0EFLTBQ78qEDDFWPY000Cz2TDVjyyiT/m/WWm/NdddlIaNMi7AkTXbZAlaNNlhrRNQAZc9IpAWSEU8URK4Uz8px3nrvvZkaOBKx5AHRjCxyySfT3JwR0SJupRICOXsR5JFLBAXj054xwUQrpT0nM70IbBW6NKlrtNlZTU3ToKaHy3nrOP1Flteyz0577Xr1O6K3pu9uruiu/z7TLxEF4OQ0B0TEw6oV1Z1rEBVPpCrf0k9PvWlz80G4yFlEdITly0FksvftiXHel5JvR4b4ylYCBc7xZcEz8PcxY7YvrMNEDLu8D+Z7TAryTjD5CZBCtiugAQ9owP5JyGn7e0rUGqi0AUrQfX2gTAsiggPlhSl5GHOeRaJX/r0QipBvFxSAA6iRPePkYhBs0MIFIhID9WnETQIgiQyp8wjwxewiJLihshhBw4hkABMStI9gyvaKAMJkbBCEihJd0jR2PbBPSyui/BCIxSxq0V7xi9AU95SiLzbRKQ+yIvBUEBEbUCYNEVkNkigSAA5iTAfus9gI74hHjL1QAGxIIWWg0YcTPE8iE/AhQx4QETAYkjpn+MgOKRIDMi1SS19QAEZ+IAwzLuZzu4OFApOhuzEOpYrJqArUdldGTcpvXltspStfaSFETYh0oqyln2Spyqr9ISIDkMY0DJEdB6zqeQG4wcaUhLc8KnOZRXJARBaRQkW4gDsUmGRCQhKA/jN4wprNccQTEOklaFFgZtws0yRiMJEE+KGLucwJE1H5xH/ZslD3Q0YvTCHGEzHok+2s2jJgCdCACtQt7MQPMeaJ0MGQsp/waoZEaDGNXPBymGEy5sY8WJGLMXOjfeMoa5wpgFKNbBYnqAgBKBADI9Cwh+WsxPAeUU5GQoEE8HGW5B5gBPbEtFhliIDmVsFQnSwjn326E0x+llClxOSgSiFqn54Y1J4NdKpUBShUIeRUAiU0q0QJW1QLtgyQpsFUS3rVkYhp0YvWcSIa9ehs/OZW6oUAeSLTBXIm8gAkaNMgnoBCREoQ0zMMrxI7Bc+ZoICEI8QgBkdAghfGIMnC/irrCXUcQBZa8tXUidIoLnknQl8hOlPaEnWZ7VmFqora1BqwoPc5YlJf2xRcltZTQGgjZTAQkbQWaa0BsIHe6JjMuAp3uGi4QXYOgMInQaNkEklBGRYyhYiwrJxkiAgDJFulbWLXe4xwpGQsMduYcHKMRSndprLqC8/WMpXhLZhq3wvfrr2oRIPhKmxTtND2vggTEnnGNHwQERQg6XgTwcxvB9lG4irYrUs6xZP8YEmJUCB9DPFCRCIQUwsLAMPb7bCHDTKGa0XEBb8IFWtVqd77qriJ/NTvomIX3xjLOFLHOPFjzPvZ+jbQF151saJGJQBftSHBRyKwRDK4N4xS/sSNC25yHi0jACoU5xR7jMgDyNkQMVw4pn4VAGA/DGbs2mwiBohDqDIbyhXzB2D2JVt+fSyn0854znTe0Itcq2YV3w/OL4LyEH4ZEWEWeXgRWYH0kFkREDh50SOEctsoEw0pSYQAT4jsQqorgOuW82UCiGGYP13YM2xgIhtQhY2tKM88q9pPDSItnxdV51jLWi9XxU+KV41Q2b66RVYo9DRkMdEjIYAihj40ggVwI1ZZ4ADMY7SzMXaDYUtEFtM4hZE7PYnllAFLMTVBckAN7p16Ya1WyGRUx2W2NuOabOzddaKKMet4yxsup3bMrdctSh732N0tcoMQpxENiSAJ/qQSEfD07laREHiMlzx6tsNXFYQKVKQKbByeCHRaEsEKgAAxpUBEphDukHNzEjo0ISL6yYyUqxvfTFl5A3XN7xH9c940r3lZhvaiVLNclFbZd8xHlIiIHIAyowqAWYsk7YJXT1bcAaH04PpwERIByhWpmAG8QB1GSCSm18KyyL/uQzIgMiIE8LkVU46MnavdXG/+OX5mbvO4z7rFEVrQ2sdId7ffZxUSQSEHLnMkggc4hAjfjsGjjnjbVAEEYIoAI6rjCIlY2odLwjjYLy++MywJAiJSZcp1fvfQt1rvoGKl3E8/53o/Rl2ibxBR+0N6FwlDIoMDsABOEHiKHJ56/rmpCBBqG5FmJ374r0HBsStCgcmXhBISccTIJY/56HMXPgaIUztTju7W887lhymQ2WP/dtSLP8YwnyX3tR+VdoM/QhJxEhsiwoEjSXwiuBdhDS7iBwgInfidgTr/M3MD12YRBPYAyrccEvF41qRxHCd9DYgynkAJ+hcRiKB6wINj6IeBibF+IzJ+HahaFWgf9JWBbLZnG2gfy7AkEDUIgSZ/FKFoI2QBFpEBmSARTPZ/N5gZOpB0YSIRDoBoX2AlQGZ5PqRlmeaAR7gslOBTEfEHyQCCrZN2KtZm57dibWeCgGF6HqiFAeUpykCFqGQ65XeFjUFgvgJsu3EkVRYR/i8YQvMXTvGRDGugHQaGg/wXBDE4OQdgTEFAdga4HO4zhDcUXQIwXUhoiFVCCSKgHW/whK4DekAzgiynfmPYGFizhZf4SsbQiI7BepGoKVZIiWJBYIIAcMFWJGooAGw4PVWQdBUAOSpwNWgUEQ1Xh6bhf271AdxxAEiGBrKSLFaCHQFAYZOEBBFhAoeIjNXhCUFkBZl1b54IjT9RgqEoFnCHideIRZv4GE7zhS2ndp1CjfghARExB5RRVkaCWxNhg3xDBEaWA8hwB6kRAA1gC8mgDLVAYIKGI7dYi3xTBR9wfLyUbJrhi1oydmLATegkAN2TjA25HN4WEUCgja3T/o3RuGK1Fo5eoQxZiI0dSTs4ty3PaJH1lXcZGRajJgBjNQ3pqFtCko4S8QHUo2RX8BK1cAd4IAx/kXKFIBGq+HT9eBsosFYWwQG0mBk1MhBasoRYZ00oIQCV45BR2RAvoB0GgAsTmTZ4NpIjCYomiROX4pFhSTvTKCfNMFRbuR8g6ZUHI4sLMw0lxItDQnUR0VZ5g3ADsAad5xI88xdDIBE6AJRNVgVCyR0WYJSbsSTPVSVOCXLWtJRSCZkJUXICoAHmFlSPiJbr9kWTuJZeIZaf2TVY+RhIlZn1xZmdCRbLUAQRkQOUIWkDKZd2xDc4gBGB4ISs5RfIkAFCVwWB/jlcVYADQ1kRPmgaEuhp7UFDUDlJ8DGMkSmVOlRlKoBZDFWRtqQ/pekKZImaN+EXHAma3zkpGJkoIoidUAFa2+kYvSYAKEAZQ5aKRsJ4bMU3HQAdAXAAl8AVqwBkFuCbcRWA3IEALfkZtCkAWVIljqQc1iQRgeichugJVBkRLSAN7ikAEqmXmuSFhFGd37IJa5dV4omeNWGN4EmikCKa97GhO5dEJxqiyvAG/zYNfhAR/Fkk8SkRNJo3VeYAq/CEdzA8xdafy1QDO2gRCIADvdkac6NI7QE+VDJJGreQCdigyQgRAtECySVpArAzLLotyqCVGPgKmkAoKQpBXRmi/jFhiSWqpo6COwWTZuU5FLDApei5DD4qAI+mCA4DnxRxAXlDBAtQg1fpFcswTQMhfEEaQlUQbcJJZiiApK+Rjl8GHgrJkIukYbxEAoo5pUdICUHkAsllQfGRCu2kDNkXiZJApkl1mmdqE/C2pq/KISEyp42BmaaTqlnxChfKqmCBCLxEGbMQH0YyVxOhjxnTjtrRApbZFcswDCB1AIg6QnfIHQYAAoeJGxKhqdTxMgFQqYbUZRQhAs25qZeXiBJhA6D6Rw0gRNopPyLZenoAp9m5q1whZ7BqrxbCrp5id/FaKCU5rzlhCxLhS28TEUaCAhRRrLnCA0AmAE5wKRNp/gkSEX/QKj1VQAUWwKhsZa2vAVKSSh3FKADSMkngkwKZMxEUsKTj+nWUsJvZkQPoOhzAGhFpkEvNcIHaRwfzdJ1JA6L/+hL3CrR8MauPYbNbGTRm6rMzoQzIQHumIhEbWxsHS6wac38SsQaNwVy+RbF6EwQvqRsfALWvYVwCwaAboQSLM0kmu06FkDASEQAPEAXbpF0qG2aPMHZRBizvNxBApUlfCltZFQZYkarumilIO68wFrSJOxdiyC16wq9FMbRn2n6UQWByJCRS24MZg7kDQAiOoQz0GQAFELZbuypC8AEZW4NDMCQOAB0bkDLSZU1LwrfJgAmFKhEKgAR+/ki3gSViWiAy0pCOJxC5clKrGLgF83SzmrKqSfsS9aq4z+sW/rotpoqd58m8YiERs0AZbSugQUkRD5MrL+kAo/oYtkAA0OF0pGsrRHC63LEAVFAkxpUdXsccg1hNi6RxAxA/q7ADFRMABIAEzre720UGDNsGhHOGAnByZrSvtvSFTDBPsFAuZZOvSTui0IvBaeE6zEC4drJVr6CW1/sVS6IIlGEDhVYkK/C9uFIFBJcBv4Afd1CfQLpM/DhcRAACqBsR74skrvi2c8scX7BllhoRG0ATteAEA+AsBBADUjrA5fQFdSRShLMDRdwv3+c6t9pEPQCGDgI1t9qzSZvB/mOcFowLL8wQhdXraiLsFQRmCK4ZEfU3JCrsLM9qKwtXaMOgq41RxQEwAIeqvkSCw9uBMwgAmBBXn1FAHUX4i4akOBVqE8OQBQJoAmX7xOLjOPHhYCm0C0tCCFjcOn6bgTCASibyNFLkZmxME8vgnWQMvdK7LSnHQKpqLq8wnarsFSBVQdPgnuuII1WbM7bSewLwA216H8sgDOp6p4FsJOxrADocoLfCAQKRAALMHGNgXZPklG5gE38hDHcAAfUZESh7yT5ECTqEANrrR9Pgl7eHalKYIiPAO6bgIBO8s0V1NMt7vcjgyq48vPaRcsswXipaGGaMyzUxjgJQjtOA/ioCUJe3ccITYcergrkCwM0S8hcRS2T9x8yxQQQhoMO7caS4AjhoyxwaZ6CGBB/gxZ3L0Ax4cAGQQwEIWc7e4wgeR5czss7TsAsSMbsC1MGh1woe8C2GYspJ8TQUfNCM0s8ZHMJok3JorMX5ttRg0ba+C2gCkL44EtESUQAQU2UHsMAtwlzd29Gv8Y8hjQA18Ki4osIRIa4asYCLNAkSAcM7sQyE0LYS8QBP4MQ1fTl3WwO+tNOUIbVWYMwWONX7swkbMEYLkrzmYtBJ66pN/bywHMtR7bgWqc9cAcrbKYs+QBl5KgDgOyTy69VIEgQfI0T1+CLNAGWie9ayUQUh/jAAAbkbjsoxyuwdzKF1EbFI2HynXRHQlqACkBMAEaAElgzY1eEFFaMFMLvOhxAfwvDZVNOJ0agJGbDYQsEu91w2hsuqrGzZ0PvPAB3VJDKS4MgYxzDZJlnFAtAClEEL+0ckqG2KRPLWaaSsLmK+2bHVs00aixfSBrB7G+MD2pGgJVHXEaG7LXO2AuACX1Ef/LskzsIAOdXcWsJpEeEHhV0c1EBghXDe+FG8GBgJEfDYi50U7LLGB33B5W2vwBPVzJAMHGyRYYwTx8BEL46e6nkClCFRAmAA8UsRA2AkVDcAb+ApPgodNCzgnvGPX2Lgo4srf7dxzH0QzJcd1ixD/uCjBYCxDLWwBhrwhlb2BF6+4csxCShZ2tQG4sUhaT9Q4vcR1B68P68ACSreROANOlBTwT4b4zK+pjre3r7w3kTT3Wbj4569DNlny//6ogJwAZThDNkRAEXCA0d+itrhAJhQ5zdRqANwdFG+GYM8rTFZPdJ2vyWxoIa0hOvUGDZZUkcuAl/gCUC85gxBBvAhAB3gX3FeHNRtQqF+Y4ueKUijBxBQmq+AykqR6Lu6DJVN6LBq7DwRIJ4EGMrAVBloFbcMFpstIIYeirt0p3+E6W2NI3zotpk+JDaqAtqyLc1q37BiwwpGBXN5EQau7tKD2o25EUJoSLI7p37xC3cg/otuawBOuusMgQQVQwXSLezSsCTk+ztph+ymQwfMXr1LAXtVvZfOW+1qeu3qHUGAMdDsBjrRHhPLoCB10uidGXQDQRnUkB0CYOWwwe4T0e+0Acw2UPI30atraOpoIAReexEHcOAhhIcGkG0bAR9aTi35e92pOeZrEM4TseANfxCT4JRETorCDiUlVAerhJZmoAD86gqkIN7jPfKwSu6AYcosDxNvKnptjz98YhX/yncRAQ2U4T6lvu4T1yMl/evgvi3MZbnM3LVfovQ9Xz1EAGQpUBLXEteWo2EeUOfNcAlAUHQE8OCX3OsSIQG5IPa/ordAID/U64lckPaP29nM/vv2r6qJxn6WcRroMyHud1cUYkFLToHZoTh7ERHsEgjItiEEyA35sfFC9lkLPdMMLUsAZ60DGKuLus1M+03TDrGE268+j6z6E1IfySwQNsT1IBsRPkDYp/8kxG7EL1HjVZPxu7MFCaD2PhH880rts/+dewwhJw4Qr3wlI1jQ4EGEvlwtZNjQ4UOIESVOpEjx1TGEGTMug/WqoquBGkWOJFnS5EmUKU0KYJlr2jQNLG+goVnT5k2cOYWw5BmgSk6gQW+wDPBH5VGkyWwNCBDgQlCoUaVOpVrVak0dFXhu5XoAxVWwYaU6YNlg0ie0adV+isDyy1q4ceXOlSuCpZuk/kmzBBDwgO5fwIEFDyY8+BEFngT6vGTc2PFjyJF1DRAwAFlBZpmZ5eVMEtlH0KFFjw7NhABp0h5Rr474SvVEYp1lz6Zdu+QxALl17+bd2/dv4MGFDyde3Phx5MmVL2fenLntkrAqXkTKUeJr1tlRv4qNtBh2irCgjydPfhlPWS9VNK0hFigRrgKIuK9JVoCKZeVlu+E5k/5/AAO86QYE4ovPKwETrGoInmb4yy4BpihsQrkUYMkS/TLChTIByqDwQxBDDJGMBHi64JbIUlQxRWoMYGmVZDTTLMOkjNHuRhxJW+K0HHv0kSHXKhKPRiKLtG0Z55JUckkmm3TySSif/izGSILAaw2Wy1T67EcuH7JyoSFVOqajL1vLkko00XRRAEVeyqEpHBTciSsh/hvqxTRTWkYFAQIoYD4FAxU0qBoKXNNAARBYYVBGgUKBJw/nsisAKESkcBKehkFzT5ZisPRTUEOlxIjKWBpCmhVTVfWlmARIRMYZ8ySJmDK7tHU6h5YY4FZeRfOIlFqBPFNWYotNBskok1V2WWabdZZJjIw8xtdilDFJRlp71da1/FBaZhmFUJvSWHJpW+YAlgZ5iUEBvkoQPq4Adc++Hb4tV6RfDuDLgkb7TbAKFA5FNNH2/DUYjSsKFOACSuYigSUlQh1sjLLspdKPpgioRGKO/jsOjBHEWDLgkFVLXrEFlvyANbN7DwqW15d5pSGA0GLWtlfqWtY5w2WIefZnoIMWemjnrDWSGNJgiXYkWHu5GeZxUfrOZi/D3PnqkpZpgKXFpkmDJRAUhHerOt2rgScYsT4oEL4GCOFguK0iAgSBEV3Av7j7rYIKkZuYKwaWkPD4rydYciFPYQzg663BG29cDAKI0kAXkyuPzIe7YoQVa6qffnoGmj3PsXPSolb79M5wI3p11lt3nVk0SW/Il2WMzghWZGQX/SOrS2qGTNZeQX14hC5gqY2X5mDpAwWriC8I+tAVAAjiCVpmB5YGKDtv7m3a+4O6DXQA7+77xYCl/gMekQtwAY5wXK4XWMKiWzSb4KuE9/MH1RNSedICVcsFsDFakJ/mZHQ1G11nd56DQQBMsUAIfsQUIaleBU+CrNdlUIMb5CBwikE/ImXnFcYQycqmlZoIOqR3swqSdpZmQbVxgCVaeEkfWFKBQD3PPXcSQC0sKAyyBAAB5StfEM43MJ5UAHpENNgQ1mQCuRyhU/pbS1sEEAgQGskSbWsYFb1YGEdASAAGWIQAzcgY5U1vZZvZGdJS6BDdsSYFARjFG+0IR+HBUI8a+VYH/fhHQBLthTRKYHawdLuVheuOo8lZSYwRx4hQcI8645QAfPCSQ7DEATnsSQCWGBbjCUAG/npEBFMCwDwmHoxA4YsPBraXSn/hgChjiIsSWPKCL36CEqa0hayUsbUASCiXw6QLiXgyuTMmMw4sAUKs1NaRRe5uBHS842uAtcBXAOsVzZhkNw1SjECGU5zjbFIWMySdGwnEdgRZozLQGU3QdIckzfAFJCOyQm8W63osacFLTsGSISpoK03hgVjGdok9ErBPn4SloHCgMCQaAANUaGjc7MOAja3FlgIgQS7P0KcBrJNKynBCn/BHTJSuBQocEgAVqJHMZKbxB87kHDxF54EAcKKaD3TFO0X3CjKRMJ/dNAY5jXpUpA4ndjjySCMNGKst2fQ6QDXJd7j0imENlVjL/rAC2F4yC5FxkigCKGhYQMASDZhzeLXLQJ8KUFGx0Y2VXPmAvOBqsCDwRHAqZYkIcumFPmlgq5fI3llSilJKlCAxgoApTNPoBDaeLqpS1dYGBKBTL91MNa7Rpj2Dp01JarWCy1BdUk17WnLKk0gn9JEvsrSyghSDstcZJELG9IpWeDYiQhXtVtfAkgu8RBfZCxRLZRKWKnAID91chSn5dVf37O2ISEwUCn4C3bh9gCUJOMNaACsACuRSitPL07e+BUxhHtajDDCRSxobU5ZIgXiy7ZJutdVWTVTTNUAlBTZhQQpY4LO3p+sjag184A4aQ63kqedVu7NgRc52Ia4x/oZIDaKMBn8kjgIecJH8gL6XRIMnV1CQcQVAvqrUoCkHEIY3+cMSG2AXLDqwAHUBGicZc29NJ03LF1gSgVyKoCl1WHCRnHA/9eZyCizNATTeC1M2sASyLFObIq+p4f0yEp4QEEB+Jby7bG6zwxZEcJnNzLpjFBk6Pv0RlixMkGbYV1sDebMyHnmzMZcXETx5iTR4cl0BFYArKKZKjQPgBDWvlU+VsWuOgVKFh9pYAONzdPdcwBPGoYURkXOfFz1BgKZkwliZYMoADJvk941qK8h7MkwVugbNne41bJ4IZ2n95Yc8YACRwPVPPVLbPF9NGeA8c7GNzaxE12YZc35z/jJYK+FXKEOtY9KsK4AdbP3UgidOngaHGv2fuhVMbmgbar40WWmgCOEEJkYUBhiK7rhpRQAJ6CJaHEGGXDKCKC3WpwP4kl5UD24SIRNAA9LTapjmgCV3IF5DWjgdU2Sz1xNRQAB4vUg5a+eBpsO2sIt6bJCHnElUoi/OeHuQCFP22iXflkA6biRh8MQZL5Heu/8jPZ6IuyohQKtoP8ySRcGbJjqYbkQ1AGih520IHOp0SsUAXHJxta8Bb5wxWXKCaCC8sTJ01fAK2dP+Ypm/GRchaUAtiYl7zjUcfrk+SStyuMc9OR800q1tdciDKIPsP1JtQe68O7a33Vw8ca+8/nWgIJyzBMdWkR6RRbuDpmgP3VVYAUQjCgKkJ517IeCLALqb0iTwZQfS1icm2uYIqncsCix1qdYbKz1MDI/l+937l5mC9rSrXfBYU4bcff974JycRg+3SDp9sU5l5I6yK+RI7UOT1d0fiUMH5/rhE2R5ASyeKncawC96C8Q+bTLHQtDAXLniAJ1rnohbEwCQU6pYAbwh2TRaBgT4UqnUg4oS7KsMH1zfWD9jiWAYHp8KM+ebLZaAhNwTHeiLPmMBPgiMQGRQhmazjWdTuzSjn5SrphfqGeLbHeFzwNqIHAEoo2k4geNKkMTLvqtolVEasD1jibeBLhuQNxtzN/Wr/ige4An8Iyb2EgBLqEAq0QLK2ID8+xRHmACegAAU+T+YsobsEcJysZIrW0DUGAWWAAQrfJoQFEFi8ZkIDMO4q50icSMIOr6CMMOrSo08OhZqc4UDBI3Q8sLZkB51mYZHEYD0+w/sc5eq4BBBGDMG4QubKx8iQAHsQxQDAIFvy0EmaisBIADUGyZH4AnvKxfTY4lJpJAvSAAROLUkG4MS4Sduc8JkyiQB2IDhmawJ+8AtBI1NYAk9eJo4bI3smEM6zJOPE0NePDYqsTvP+SDlk6rYAJda9JVctA0LEQANWAM+OKKgE5AF4Ao/nAodyBh+GzBhCKUGgCUdCCUbW4A9/nREWCICUOMoYqKYgrMYY6k/loiCD1HHvmAEVNsolkiDlzJFmPoaAfgB2ZuqVxQNTpDFgMSZZDSW0upFhSwzKjlG0HDIsrOpBjxIPSEErjCuATgAB7gADkCBGrgBIWjEqLAPnphBqtCAprCByOqtZSCsPjHJvDlEfem8gRkAC7A+csSuFeAJLximjXIBdjQWAgoAv5qQMxCYBIgUxHoYkSEZfWysPDQK1NlAhog4OzpGTWCJPHC4gvyRaKNIWUGGhRzLA+M4/TgGiOzK2TJLsPSWVpG0+ECAjQQBj7yBIBDJGtuKE7AKDiGElRSt/OgqgsoborMxyjCAExDJnKyo/rw0gE2kIhPokyzQGUworMJghFE8FAMQA08gJkZ4AJ6QgF14yvdaE1UgwPriKVyLBJbYA7XUsOnIsoW4trbUDwwiS9w8qi5kMNh8Td9kCFysTZMwP7hURAewAA1AgRUgEK4Im+1jCQLIxjFDBq0IgAM4GCIIAXRpCupCgHFcTOhausrgMSoCTQEoBEqyj54cjEkwzwGgBUUgQQFYzy8aA/lsgVIkzTMaLpaQTqypL1ekLElozd/UDs56jb4TThrJTQY1qokcD2AsUAViKjBTUJVYBpQpzoGhyeJEAOW8AR5QTDTgOqCcvz1aBlXgEOdklBoARxu7SfBMup1kCYBL/jWi8CGdKSkBIM+/oASCc0pZgKi90h9PsKXOYwP9fC9UzIDhQUsJJQ1AYAk6eNLVMMAJCzwLpQ1lAMMG7dI/MtHOWIa0pNI7etAsPYhlWAXi1FA2NRADOIAK0IAQWM67lB48CMoxwwKewMkECQINYDdE8dDMi9GGUoOgkDcCoEf9IQORAdMiiUECqLe/gD8B8D/G0AUuuyX9oQSmFIADaJMkbSzMEYArGB6qrNJXjFIBsAMyTY3/eo02PNPysDMvrdUOctS8cNKAHNO1lNWsSYY3EJkckCEObVNj3VCe6L62a4ZWuU4BEQLtLE4M4FNCTTpz5IuizB8oYAn82Bll/pCeTKOL+Jmhx3gGSNxRSe2YMzBPAcgAygnV12MJRMBVNIlQaOsRPWiKMGhVRpLNhTBTX00dWx3YDKJXpDhVfi1QqgpYkggEEIOGPb0BHDgBDLgABFjBYzXWAICAtvuW5kKr/yCCFSBJG0MAHBjUak06FeOLJ9Af9rECg80QIGAJKPoLJOAJHogMaVg0AZgAUJSYMTiUHAAgeE0mXhAZYYjZIuHV2dqDPtnX0bEVhwQwAGuI3WRYzlgGsSRYriUathwPd0ohpqXSWMVahKhMlqCGXCCu9wgCiQ0BDrCABUjEjEUUjt2930pBsGjR4hwADSirlF1McFTKxgkZqdyZ/kIQmXT1Lp5QgXyEDGnYQZZ4AEUNFU9IgmSNg6J9rzRigVUcWwNVTRyhA77gAtBNu68127y4za5tXWehOxpRhoSd3dlU3Yz4hW0bhHMDCyJw2xqA2wtwAAQAVDbVgL/EtmXgugNAWaH40w5dAeYN3KGzAAsQUViqgu1kgJ/lGE/gkLTZGWRYEzGYi6dDK6JNEYWat8/7FE7lCQM4hc19LxQUALxAHZZLuwBljTBgCS6gXdagTdtFCtcdYGcB4Nr4Ov/1kb2LowS13fNgCWeYkxUVkCoYghuoARTQgOHV0DugKWxbCpCNiiq4Aee1Mb4oABAoROmtCSI4n6aoRhnL/iuW4FGO+ajKIL2rwR4B8JS4KIM1cYCsUxU+SAxaspRHsKJ2fdf4TSYRY4lemsrThScuYIktSODehMPUDeALTQYC7mJlMWDaQFgrVkss9dUHFoBbkIA+IbRASa6aLACWSisPxrYX00OhwABBK84LYOMVtokPMC4Vvqs8FIAe7JjvEiysWQaHnbe4OEqRUWJVQcXKCFcKsToBGNolbiwbWhjisVf/nWIBqOIxrrWmymIt1pNlIDYvXmUmkULaiOJRvpWydeBlWJM2+DODqQHizR6eOATzOt5gW4YO6JPltQkiaNFdvkibPNk+hgoUyGOAAlx0q4DIW1+OYR9/VBth/uAQfFOL9syegzMZVDiUQiYMT9hWnkDSTG4sSIS14aEV0QWzA/XXm+kCluiCaIJl1QAWUz5llVBlVg7o5sDT8Vi2e41l1ADjM/2WNZEeHDoYIaDb+CAEaaMywauFyHEKNBACFLBBuESAECCC6G3mILA8RVE/IigAvmCAxwwVwyWwS2sftaAEJHZKy8kFkoyBziQMSoCBZE2EdW6so60MXCAeZqinKO6siHuFeO4VJmAJJkBoLyllf7ZAgb7q5yASBOZKqd7C4DRb7PtOFpXorXAALfhepbWgOuAJldbQAvjbZpaKD2jryrAuR+SBzgsv7uWQVECdP2AJBtjpTxCj/q4RIGcARxJY3LkYuCV0r6BOplFtAQtSpM2iRdqjZ215agGIaoTGjjDr56pOiWbAatJGjiLx5K5ewDKWVTXmCWfNmyoIgWTmiQzIglQg6N5ChkxYg/ntk2JFlLe+gZGGG0PNm5JuCr44usWc0R3mmDLIFNTBXZb4vHEVgDSAKWjobRFQbLg4gx+8j/x8bAHaBZ5ABBgKl/yVWtdY6iq8mSWA6tQGklcA7dD2ltK+7+H4oLQ2CVjmlaaeXVc+U2U413YhoioAgdleQitAhKTdb+hYIxBahsyQcILQ7TdQARL87ZrEAD6O65sggrdMFGnOSZRkiXIWEXS+DxzGmkUz/oJP6B8BsIH3kgaF+7GWhosvkM/WE2/IRisHRxOkvuzYjE2JkyoaYIkliO8Jo+/6Rgn8fvLfIKEfFwmDJtNNGOWrDVhlSAH3HW5/ie0E584B6IA0QASApRIIN4hvYYZa8AMn6IAENxC/7XAPvwke0BeewLyUJclu/hSf5glEOx3+CIAISHENeNzGSl/ukgv+SVZL5fEzygUOQc89qidtqlqLiBnaoywZQHIln+8mhw4oH/XdyHLauF8JvTgr/mqGLQKe2MuKqgFohssB2IAfuINUuAyLmfJrgRV7EQZVwAMrUIFl9G0NRQAOoNY6h4qz6pNJC2RyJII1SYDKFZEI/qDJAVgutdE2rmiA832vWxYZwkULShCjBpgFSIep+d2AAMcaX4g4YAm7WpP369AmTmcJGiDT9IYjUw/1oyB1gD9z2UDtgFTAq/Sc1c5SvmEJL48b5jZWv/WBNwiEVOC3RDNYEGIGZMAFS7iDNQACFSBZZ+8J6mobFHilZY+KiE5WGE7ZIOCQB7jxCanEsoBODEnkYU6MINY63c2ecF1XnuiAZ0j3ZDIEnkAobwryV51dFsD3iZOdMJsOJvf3k+BSgMdvXhcJsuvvh9jKUW53C/05A4AuHWCJBfCDDCV5Nm2ADgACK3gDP0iEVfgFZDAve7H7brH7Y9n4VbgEQriD/jfQApAX+WNFbgfogM5T9pR3lK1AAJSX3rP5se0tDDBgiT8BNevEhayfDanjiSb8P0VYkwHAPzE4FB/4dqKvHGigF61Camxqb23hclHqalCnetsA6Ksv7c1HCFZ80ikdZYXOUlWwfOiClwAYhmX4hT9wgYzWcDblTgFQAAW4AAnogBNwARXA/g7QgO2HgODN6IFS+7o9ABe4g15ShpwngMUX4aL7gIYHT56lAO4WjPF6ipfniwxI2p1ZBZyzaSecBYBoIGCgESQDBQyIM20hw4YOH0KMKHEixYo+BhrAlWwjx44eP4IMKXIkyY++XKFMqXIly5YuV75C+Srmy5o2/l+OGCjjJs+ePn8CVfnKWMmiRo8iTap0KdOPxgBAjSp1KtWqVq9izap1K9euXr+CDSt2LNmqTY8aoxl0rVC2P7m4jetWLdtXvs7izat3qa2DaP4CDix4MOHChgsfGIioozBCPxwcjCx5MuXKli8HCHB5s+YDLtysWrYs2ehkqwYMBHF4NevWrl/D/isEwUEDN2Ljzq17dYiDJTx9Ci58OHHinh5kxvG3BmoBLkrvZSp6WS3ImudUzJ5dl4TJB1BpDy9+vPhDB/9ET7/0ZF1SP2fCIvXKvdyfGwbCaEm3Pn+b+2++Uox6AxJYYHrLPFWWggsy2KCDD0IYoVfQFche/n8X9rcFhhtyKJOBH4JI0jAHVbGbiYZVoBkWHY0mWi1/AAHBZjNKphmNN86oARB3pKLMdBRutMZAAwRxopFH5sbcQRgQgaSTTw6mwUEmAFeclcSBMWSTf/U2UBYhluSiQAgtQp6ZDEHDQWQZ6HKmm2+G90xiAqgApp3JWOjTTDP9ZMqer8DS4UsZDMSCoIfWN9SdizJa4DESQhqppJNSWmlXIC4TKKKb2sQEp5++p4wyjZIaXXNbQrnbCgNlEJJopNnihxYqFJCZZZnZiKOumx2QwhB3YILMUc1IKcABqSL7ZBVSZjZACMlCeyQGNpZAyZXXUvLAQBgIdsFBfrxa/moytciI0CFwmilNDprZIA2678LLEDVdHvCLuBWCutZ/a0VQaL7/vqTovQMTTNKjliKcsMILM4wViMoADPBOESO670rHjFqwxiVBJoAO0eJGxEH2hrlMM7FmkcMGzR1k664vD+RACEBk8QciGgF5FCYHPQuyz68RQZsAARRQ5M9Hw2bBQSJYe21xMdgoxGBzEqDKveQedG684lEjyCBbgw0nFQcREu7GeeVJ8abICTCC2hQLfLbcAy/TsN134523gsXknJ4xFb+NkqGBU0zM3Id3VKwNSLs25x1FAdniL5ngkcYPLnQAAQEwDz20ZgE0UEEHLvyQxR2I1NIMdH0r/mWFZgOgyrjsaARhwEEWxD677oJVcFAEjDg9nBIDBaDaYERsLkADGpGK9UBahx299NL7cVAWrCOOVNqEb6jAQG5z/2nc2ZMPZt16o5+++ukLaOAy24d/YQfx5wto+XO3MJByuxcGwkAt4KVFy2DGq4SxikxYIhGE+AMe3OCGLEDQgW6Iwx/u8AdCIAITtRjGdEhjNgIJo2MO4B/SVnUQEFyBhCoEDAaIxwAyBM8TRzjIAgwThOZoQFiMwkXvBvK16QExiOhCxUFUgL37FYUY9NuQ7dq2xEOND4lSHND6qmjFK1LKGEfMi6ZYYrEn3mQCYOTUK0SVsSmKCwgDOcEK/gUTBOIN40Nb/KC4CHGQGrQRWv4b0v7yqEIOuCwJTStOGfo1EAXkTjA4OMgOtnigX3jLh0KcJCXFk4s5QeAXjkQjSOA3Rj29Inke+CSGosjJU54Fi6pcJSvHosUCLQNipKxPKx5woS8+8RXHQKW4rDAQDvgRMJsLgB/opjEXYCSRwdxNFXpoLKMtEw1q2F0NIsMAL1TpE4+YwgZc1gBlCmaPAnjDnX7RHUlWMp3qfIgzOnYAW/BSKZ4UFC7704qDbICMQanne4gSz38upZUCHShBp7JLAx2De/x0yygaMMtDtQ+gd3rDQC4QTQ1kBggS3csv5sStaJ5oNgdBQIlA/qrCIMwJIxF4QAI8ZysNpLA1ShsaIXwEomFkwEZ8WCdP1xmNSA5AEZvcKJ7089CXtMJGGThqXHRJ1KeSpKBSnSoWD4ovprKFEwwg3EI5BAuoynEZfxhIBaJpg8woYKhg/cgy7nCQj5k0N7VbUknjqkJxTiYzDvABbKqQmAAQIBVqXcovCKWZPvQ0sZSERgsHUkw6rrUjSsSqTVoxioOIMXCSQJRVIxtZqoI2tHk7xmCT0kXK/iQSBkDtLT1boER0BqQHWYVrk6KMLiHArrFR0kBQoNs8CuEDA8DVAAbQAA1AEzbIG0gmDYTTg+xUsdKdXpoO8rjaimSyc4nfJnz3/jZAMKEVhyJtabF7P2KINr3qtZQOCbSMrrI2JZJYbXz501nz4mUVrwNpx4qJ3zClojm+/S1rTIgQPBLYj0GwwQ2C4IQT6eAgJyhvUYTRgYMoZLoaBhs0iiUAN1CYqPNErSYOAgGKcUIGNBCvoEjLDGY05RjFgEV7/3uvYqw3xzqGkOocVd+fAIIAP65PRG3cFGGQKJqN/ZKRSeIELSXYMOIcAA+ibGXYGFhGVkiPhTG84S/DKxqEGsga/injGi9Fu0Mu8UAc+q9WcMEAnhrvi1+clGYkoxh8csUr8NzkUuF4x4IetFhCnMT4wRcoeRjALBP9nrv8WTpzSm4eUaCT/kiLZBhj+uiVAeNhBEit06JejZoi44a9CEMFB2EDmFv9JmtEcpz/TAufYeFPpuTJ0eGTxEG2CqpWQIJQW2Bxh1xc56MsAxl6hsl9MQ2mQBM62tLGiqFLMuIhq4QOjMb2XJytlGVcQDNwDeYi6VTttY51IFXudBVmKgAHgHPU8v4LAXIlgETkpRnIHAgaXO1v8tyiY+OE7BRhQZcAofkoag5foiFxEAWIbxMzCMAAwsDZOh+bJKM5hsH/EyBvLypB0x45yQHwIV2z1g4C4HZcEg7ykex7BdEstxFfziJ6sVvgFajrvHsOmFg3hwC0bcoyinAQLfw76do5RPIGcN1//lrM1kphxsJRC4jacArOmyPAHqB4DIxnPCSiIgaf9rySr9o8RCIvOdsHjdAhd5ULAiA2y4FS5LS76skCMF4wLS2AHeB9I8s4zdBkHuWg2QgDPPd5zz1MgjMkL5MUXsZFBuIDpWN+IoIIeiDOXTD/FMPlI6k6VvVwECEjChAUGBoB9MDZWIIdxiE5hi8W2ufAG2jtbd/9eg1E+rqrRO6jAD5Q7IL7kbhVALldZiTLHHjR6H0Ai49r0DzHd8b7HAQ2YtonxoCaAHRA9CNZRvRzQI3Mo98hWjjIATBBcDT+7Saw8EWzR1/fPJz+UCk+SAIgwVmOxN5HKIMxnBZP1N/x/uWF7vHeAoKW54WEwRGfS2xBAGwCym2IBTbV++FeLRxEvO3OQSzG8Q3DAWQGMP2WEKTU9WHfvHWJAGzAIEEBI4lG7GHcR2TBQbTA+aVf+qmL51RALRBVMfTTGZEE2bEWHURGh8BZEymPJnAWEYKEqCBD7ena3SGgXhwMA2ohVRkIBlIWEwgAJ0RgqEDhFSZDdwTAgOURvZRh2rnB0MCObs2V/iDLNK0g46yArUTAIH2CJ8SA9QwQDdpZR9zg/7jLDqKfLniYCgjDUxUgT9iF+ElWTXihoCDhQXAIJExAZESAGNITxohdxnCc2b0H2pnhXijgFqoiKxUIMoyhS4Ch/ie+on+4wgEe3zIIibH4kRB8XxqYYTN0jAbY1Q0dRB/dobyVWwBEgCMUhyeIwJDgQSDSYEdQ1C8dIiJi3iKk1A74GVFhICzYIkf83ieFQRJeyP5FxgbIYrFFYTKMijIsm1y8wilGRxau4j2uUoHE3yyqxBIIgBPy401AGj2Sxi98H4KpEBGQIOg0ohlWz0BQmoKxDEIe46jZgIkxo5VQQr9QHCJII9hxRPIJAAdcIzb+GzWgQWSsgQaekjJU4isQQzeCxDiC0RZEBt3VxRJKxggM3yf2zajQ3i2FI0EahT3i41FW0VUFJErQQBgupU2YIlGqkS4m5F8NQCI4oGst/kOxWABIESNC3EZFypsOfB8DAM+1OAIDDERgdUQNJsNDCkAGQINJKl00qNpAHEAhZOXGJFR/0F8bJgNNLpFNHkRPxgUkGFJksABOllLCjQY8VmJLGA5RnoVRIuVl6k2BPOIsNmUkPCUlUuZG1AIOkdANsEw07mVkLYMlHEREnlQBHERYiqWo8UBzJMAZBM8nnEFLKQ8QbgTGLUMhHEQFRANdJp0sCFwHAGFqFoxgBgUsFIPseUQvMJUURIZhrsUmyABl0MCmTKZHTGFMRCZMRGVoJoVlYmZ6NgyByNJnbqdnetFnosRQ4l41CgBFIg0ReJgA3AFzutYJVFQwfaUA/sjmbF5ZECQPAZRBbgaH9w2EBjTkbzJDIjSHAxSncfrbHESGE8gkVF2bWxADmn1o+IDhQazjT+jkZITXphhDxogKAVbMPJrnUqCnetoowhBIX34mCwgAfFLWeKbErRFlM/QGxY3b0aAAyxwAIZgnIhxEqK3QHHqMgYqaECQoDDFocExBEckkJlSoNWCoqz2DgQ2Af3nWZl5IL7QPMgDppvijia6F6lWGhpDRqIQnJfaHU83oed5ony4MgThnooRPCgiAJLRpfA0kZf6CA9jK4vwMCtAGriinf2LXmAljlDbRABQolSaYQg4JGGTpcCCBjWhAHeDZKszJAbRJmILZ/iCk1AXAU22JDwQyVVPC6U+g42RUXP0cHKdY4Z6SRCr66bBKCIGMaN3lBCBA0VHJqHliQkqxEbRUAQqQIPE0QH8C60NK30kx4aZyaqrYoZP41UF4QagOhye8QGQUQS2MiQHwAqt+WTTkQGT8QIR6lo4CDmXZ6kAAZE9wQfLoKh08ZXkCq8EQ68FKCoEc6ix5QAAoq3y+hKhQqms9Kw255olMK2wexABogb3OqDJYh+EJRriCzBxq6rdemdAMQBSYK3E8AsAay5DIArxu2CmMifJg5cRujBBCrE9s50H4aMC4AiBsYmW03mc2a8GWRI0ibNOWxYCwqdASX049LGu1/ikomicz2EKsCcAFXGzIgADLIIQVkIzSJsP6CUBZ7Y6UemuUkewKCtwTtOxwNIJa6ir00GxiQUMVRIYLlC12HWvPugKPAu1N5CplGMBmIS19mq2wOu3jhsWA7ONn9ovrCS5LfCdBgh0yOIG9HcAJfC1r6AAGiO0BZMHfmi0mNMvuEAET4ifK6lasGcHcCsduVgZi5a1ioYKMZAYBYOt/oSmztsWFEOpBKK5LpGhlPEC/PqUpma1TQG70Pq16BC7LaUseXC5LEKwZguRqXthkVAAI1AAPTJ9gDEENaEBKHRIbeOzzCoOtlC/IVIHQ3CfsRtkHHMQL0G6DwmxkYEfu/vZUNFTe0Chnky3sQy1UThjvS8jpZUQA835moj4vSDiu9FowtalH8C4rxQgE9mavUISmIC5DIuRPZOQK0RyAA1TABbBwBSxAtXaOidVB+06wMuCKByLL/A7J69qvSbXgb+zvllZGFgBwT7nqxoJYk7niB9vEMx6E/7HE4eZVXG4CxNJE0k4wiwzgBXNxVzDnAZNSSwnsLdWXJAaeIMreL7jBCmhsyxDPG1fGAMhAzuqss9lwZuAwlLTbQaghtLxtD+eG3wkABfChuQ5PZQxBEa/TM+RPc6iAbzYZzzLxS+wnFAcfE1oGT2bv7WUxW1VwF4MyALDkeYLxhXRcf2zO/hhPsiv8qtIiAybEARB0QPK4jK3kigZYQSCgbiezSAcizR4PRM8Asl1V00BEwCTQricYQWUEgPkpciVRwxwoKbhgWvX2bGIKgOWiBNHeCq7AAH1sMBgxbsFCWyibs1Qgw15K8hjNR3z0x0CYwSqjxPY+b7gMQypYQiDcgQPdwR0EggYJSx3jHZLxG9I01kgOs26R5UAkADLPrScUL2WcQEk+MxChAtf6LWlUMz1hW7kMhOVqJ2dkhgyYwiRnLi9vRDmf8zmPs1FocH2481zsCX/ckwBYnKDCHUqPn0cI9PGxJkIgjThxWkJ7pW3i5txSghNThgZQdEVHjzPM60E4/oBe2nEylDK32e1A5EErbIH6TjHFecpLL6UEo7RKr3Qok1Z0XDWfeeGegLNMrMVl2bQ8o0RP25xdn+K+WdTPtGAFxBRRR5MQNJGC0i4lrF5lXMBcOvX0SEMcAOwAWEEj4vXhiAotfrD3EE8elCgc1wjF0SkZsxY9Z/FZk3ZLlwSbtjUlyocF+smFdJcAwEUuRYxp63Rtu8oqxObP8NYIATZIte5BjAHtTgI2S4YDPMNiT88iCJxzQDLI0RpdswTM0sHPbsYA2EFJyzMWozRpn7WQ4sVz09Mp18WFsFlsy/NJ23Z6I5vRCUAN+QwPjFQe9/bsVIHAlevcOoK2VMYB/uwCckfPLRjYu1Fz2q0zdKeE2NKBB8wIAahyfbXpK5ix0nL3ShcDYCqFWMvjTLz122iCZmzBWmMVbau3eqfCHfkMEWjsAEDpfPuRwEEB7Z5BVk+GAcyCf4PNMwywABhAFgjDZCORNUNsUkWGHXh0ZwOWNrvEK2B34IB4kKb3hJ9zhe8FhsfFajc5T0SCh1/5LLXyiHs5SOwbb0dL9SFE6LK47sgujMu4ZAwAeNg4vEBDGgwXI9WCj0vRlutJ+Mj1QYSB2NaIAlhykpPiU6J3J0O5ORc6Uww6w4GxwwmAFKzyx335pIsEdeQ2yCyAjbTtmfPPmAmA/s4tGfBmZeDt/pu7CTX0wc0KQAhYzRUaeBRLxmZTxvK+ekqIttkqw6Gbc3TUHhgpeYc4OqQzsaRTerF/hC+1t8+EgK0YI6ff1UGQQCEzKBnUWwxLRnSZ+psMwnJDALjY+RQtca2jBCdIxr5OBgScKHTPRG37iK6HcnqIN/2AsekJwJxd7kwkurFPujDMSbMji/YJwAe4LcoKMiHPLRj0r7UjXba7iSJw7QG4QYce3+TWOpsdhIJTxgZUsbjzmSuwO9O6u9NmMJ4Hzh4MxBIwcZfr+4iLRh3sl89Mq787++7cgO9Ie256wWZcHsObCSp8L+t1rEafIpBDbCRIhn7vJHZyvIjTozKA/nzIIyxzaspMz6LJC8ASkDzD5fvKezm4BfPM9/AbaQYDOLS55vxlqIAO8nx4yAKAbiwQMA9R0qq4O/rGTsZicvxK8I1OfzLUE6uFN0WgzAc/voIZnHzdJZrKc/2I7wxCyDfYMx6KY8RRm/1meIBir312yIIgD8QO1Pm3x1PWU9bVmXC5MybHk/XzbrHfWzClxvsrlqMAGAHhu4TiL756I7uY2+8fD7OnUhyWmmsU+HlxX2jmUwQquP1BuMDQmWd7cjwgfA5nX33et8StkzPrWzDTF8XcXyD3yJ0AdKd84vvtc70y/BUPQ35FChyotqzwXwZ/Gz9FnELyD4QKMP+M/uIrJDLcp+BfXg3AZwOEK4EDCRY0eBBhQoULGTZ0OPBVMokTKVa0eBFjRo0bOXb0+LGiMgAjSZY0eRJlSpUrWbZ0+RJmTJkzada0eTOlMZA7YT1saOrVK58EhQ5duEWAABpGmTZNWNRosZ1TqVa1ehVrVq1buXbdmCiAgAFoyJY1exZtWrVr2bZ1+xZuXLlz6cqtEADvk097+fb1yxdKUsGDkw6YNQ1xYsWLGTd2/BhyZMmTI1MzdGFwABmrvHb23LWYU9GjST+kQ7hwGJ9BEb4iVRp27IOfadfmihN3bt27eff2/XumVNo9V0N1BZV1U+OlpSSFIRu67FfEbFe3/n4de3btIH8kvVAXfHjx492qIX++roakAY78de83MGrChyjXt38ff37E0vg4IGwjle0EtM2X6Aw8kKHTMiOAjqGAao04BCX0SacBLbQNuAw13JDDDj2MqZhlaoMlOYRgeU0gU1oLKsKHWERxOaaYcC7GCW08SLgLddyRxx6zU+aApGpAj8gijTwSSbhQEKyE95z8JD75BItDvyqtvJIyaNgIUrABfuDMxzCnapG0GolS7kaDwiCMAD2MCqpEV050LU3okGsoRzH19EikD/38E9BABW1JxBHNFKhEM12jcyhS4ET0QaeaSEqFOi0tKM89Nd2UUzEtKayKJEUdldRS/uGqQTAKKHnSvSekHOwHLGWdFctdtBhgsAGAqGWZQjv9NZlDLx22IS5wFWypN11rEU4y6xQ2OliAnTaZYwa9Fttstd3NOuLiLM7R1RwNatzSlkiKBWItzZTadt191yonkrLAVLrMqxfffNniYYCwHnCE1b+QeFWwFqihFeGEJ5NmCMIaWGMYeDlFRt2Kh0JqsGSHWhZFRDu2+MagJN5TGWu3PRnllFUGIBlfaSuQUaNOJHE1ElmME9qEaEgqBZAnZHfkoIUeGQIh9T0a6aTfEoIAAQJQgJGA/XKVYAE0kEbhrLVWbBYJBpPADWGG3tMYn81OCGPBZGDqFZuJypnt/rMNGrtHZYxZGe+89eYQGZc/Q8aXb1d7M1w4P3ZKhrBGkBu25ICmG/LIxVwlLAFCVRrzzJEmgssBypC6L6oJbuCZrU1PmBo2jhWgA0KU8VvyC4lhnHZXZhzsOcINWhTu2pk6JnYLi9mb+OKNrwn465ydsO3Xxu19IRYURxB66Fpx5fHgtd/+ujeSckDz8MUvdYHCwACdr4GrNiCX092XdZcTunSjV9i5165A38+edDAWqlcITof6n/4GUqH7Xed4CVTgAk1iwG6RgmYEZAgLkuKBS70iUgYKSvYO2EEPYqUDSUHB+EhYQvRkwGkB0Av6oFS1pCzifTGskiEMULkM/oDpgwMaoASj0wPCpIuHGiyNL3KIIQYeEYl646Bn8hdEhYwgKRu44Ld22JolFhGLWbTILwQjBBN+EYxyCcF6YsDCFrqQDzJUo32iYQO8hMUKwrCfFmmjjCo6sTQ76x8efSctOnoliYEU5Mm24wtHFY6PAvFAUjIwLKGoKDrT+eMkKTmRQCTlAGHUZL3udZ4aHEsEnmDhFFwoACqsEZWSOQWXAtAAS7SsktU5xh3xSEsZEKZnzEvkamKJlWWYbJDBFKafBBS4F+1yA0mZwLBMkYdSGChEc+zlNLUHhKRoYJPZ1KYO+iWAB6wKfV5Y3atOcLBUnnMx0tDCYHYwDGlS/lMrZdvlpWBAmMVJ6ETzbEhQlAHPqZRsmAEVaIbeORzBDY5YEUiKBCz1CkCwgBPQ9OdEubcM/wjABtrUaNI6qRYiEAAvCYga+r5QSgdAA50pRcwtMJMUA9SBoi/Tp6VeQBgLSuhRpaGlgY6hjH7GlCN3G+hQiYqT5G0ngk2B5LCKJgAI1GkTMtjAJiJ5RY0coyevOCpQuTqgZaxCMJfb6FjDd4UgBYAAn0OfGMYppQG0T6Xo7MPqOsCrrnqliTO1ERQHc1PqLVWvVrzrRnxRVMMeFiYO/Mgs26ZYkCRVWcRqQFIecCNTcKEAIxiFgRzrkWUUo0V+HOxor1OH75EV/rWau6gAvMBCMjTNhTCMayqfsYIuZeF1pN3KTivGW4cscjBSDCzIiKhbiyAWuclFiVUt4q0NImMqzIDsxoilgKQwwEaQyEAAWADYxhXjpyBpBiycFRHjntczFBRACFIrl462VzwaqJwSWHiGBJSSSrNF5SAMIJgLqKKg6OWIHYdrI/UMppEFrphoBaxcBzs4wBYx0VY9klefBTAhCcCLAiTEiVsKYG1V3UkzjLE8RFFYwCmmCjJgqwP4vrheS0rKC1jIiPu6EAj6XSM0eDAYIIhNxVVhBsUULCGFDmaZRSaWeQUMzAc/uagRpsgyniLJx8otXArpVwAScKBWcKG//gJgwoGi6ZFmFEMowipukNkMkkwkpQAwlvOobpDCDYgSdI5gQOUIVk4dyxAVq21AIqTc5oowQ55KNlBTBfNURV+w0BMVKpQpPVAUbyTRT4HFpTFi4oYeDiFvNICBIHHkAWyBzB8p8UENwmBDvxojbJjXnGltpCDgKgAPmAT6KHHkqh2gdH92HzXSMBgX/ALW0bXwo2GzWsqOBnq+rR2nBzu8Sl97mNTGSGgcAovOXmTZz8qpQkbxRgJAhxMz6JJqoNkrjoAWUXBjcrLpPRHbCmCEtdb3eDiXFAI0gte+JtgAZCFs9+XiwAEwAP0iTW9m9ILZrXGKdQfjaKd41yHS/jbbt++6DGx/PJghuvJqfKFtiXjaRShXyHQPsok3CkA2mK3cABrE2YwU6hiBa4rJ653iZjQtAC7e99DrctEBnA90nihBKQWQRoObjg+rcwAier4TZtxR4zzkkmCwK5qsO3E5az4vyMkeyEj/r1kmD7e4dpjltxGEE3yGTanDEpY2kVman6VZFYvRjKon+1NiOdp7ia65lgogCiyMAdN38PStPaMFqAlABtwQsZY1vM1Ujjh0UHMAaH99n3Jz9WiX0Yyyn56BING8cqYD3U6LBoLQAawmBuN1V3iYMAmQRKov0iti+Hb0fw+y9wRQgcIf/y1jTEoZ0Se6qmUAa45X/pgiJvsqAhQhEHIU/kWOceEgombUm0/TvHXrZNSff288n0j3nfK8kl9EGSoH4NeNE4nBXE+pXAD6ehygCd5bBKtio22279VUQITYgvCQj9ZQxWlEgIXEgOkOQBekL2GgwQfwgmAqxwB2gBBcjwCTIdPEbzRaATXOLZJEsCBeIbxIaxmIAf1ecG+MQcpmJzZggV3YjynczkAkgc82iykAYQJQIwIiKgVLAxZcpvR+j6c+MMiaoQDCggcUUArP4tb8BZykpgxgy4UUgQIRRhYYjekKwwXuIGJ8aiIwT0fQsJhQsDQ2oQQXIssOCfQOYg4PRP0mCgbzMG8+Yu28zhc8/jAEi0NCIIHPqGoooko+NoAINchXco7V3oQomIsJYwoTCmMKLxENiCDMRAp9GCHMXIgNunBWiC0MJS8sBkAF3MAWzvBX3C0ZhGEYgEwNrwPi2HA03BA1FgI52sYWh0ISqalP9FAYCckj5E85bBDNnGLcokMPBsMQHeLLPnEwOsAHEeQPk3FCgm8SR8sNksL4YCwBMfEsHOAUxwB9HOEBmM7PRPFKdEH5SrFqLsAKEgHIeEREfOUXLMENnEAFHOBYAmAATmAN6lFPjLF26hAhaI8wAkAXi+IRj8MgFc3Kym8YK1JbPFAjCIx6oA3jZCMPBmMRGQISglA+WCAWnoV5/shvG0nLBfCCvcQR+eQLIBMPfURgPX7NGdjxSgRBC+GR6VRgDTIBIwVkGXChELJABbaOYA6gEDQFIZWRduwPNfDvKSACgHSwF7WRq6zNIrsyUNQPB3vRIPbAaZIiJBMCEaUkxB7N71ZSt5jhAMLiBmDy+HBAMJgPdI6Az6qGPnRSP6Ih8nxSMAXAAFBgDS5BjlyRKvLuHpfhFwghC1yg+uBxADJhFv8mZIaLB1GjI3MwIl2ERQhIJe/KK0sTUKjj3XjoKV1BQZLC/xQiGvdyMJZg837RLWPJFsLKhMKRLuUiCOqOAvBMaqYAA13olPwyP6hvMJezSzTACf5gFdBQ/jGnrBYgswXikjmTAgIuszPsRixFgxBlsxppiTWyblFADRIPZOxMkz09pCN0TsEwyCjWRDAiQSFKjWBQbfO08jYn6g+SYgF6c+iI4AkFQAEABnTKYMtc6AKiDznrQ52yU0IHgwBCwArwIBVcr378plDcDRcy4Q+wQAY0oCcnNCn8QEz68DsZohlRwwcfkiGeRzoC6DMt5Q6nyfzaU0d9YygvwrdWc59g9CC4YDDs8yBwj2DYLeIGsD8Hy5oEAAQEdN/IESDVKmA8Qc+Y7q0e1D66xkS/NFccoANywAqyYA3c4A7cwA3WIAucYAdO4AKU8iZfpTjh0QVSdEWb4iNR/sMQF0UZg6Iz2QaD5gQrzeYVOG6iPmtHF/U3EFUigFQADSRtBGD3CiIaB67mRJA7m9SDlqGlMkpKae3AEI/XKCAM+4BL62MOwJRVJVQ2S/FVCeMANrUrhDRPx7IsQfIEVVM2xI40GRVYeWMjVu9WBWJSK3UggLBq7o4NHZVTK4mLkoIIQlVfeFM8VKBy2gN9jiAMWyBVJ8MaQihWW5VcyzUMayFMILXAWnMwXrNYYcNXucrjgpVecWMjuO1dbWcwIGEgkJRgDABZURA1n5WiEgGTqFXO+CUpgnOtwtAAcvJbIYO/zJViK5bp8CITfITI8tUh6DMz3JVjvY60kKFe/kvWJrSNBvP1dpICEAQCzFyIAYx0pqqHPwl2kpZhnQTgOxAWvjgnLBIAQaXmEUAqVwkGVSPWMaAhByyWaZtWMPYyABKBR3wqLEPWKgmiFTz2aWXWapWDtLjSZMP2JRCV5eLTTxfiXARDDyDBVBcyMwRgAkCWDWvWZv/IAAVgBWjNWo+vAgrjDNDHE2yS6ToAaR3jFCbTaRPXaQmBVrUiZXe1yCa1Prs24+jwRitJbDMXJjRCXZdMSPUoKfRAvTIwA56xF1+hces2cpYBtqKQZ89ib8VHxgQAClhIfUppSwtXMUhRcXvXaaW2R1SUcl9BcpMiYCnXKJw1lnpFc5uX/iXa0iKIdUlz5sOSIg9QqGo0q6HOphlSV3WH5qss8XVRi1/CogSEk1U8gQxKMb90d6UOz3fjl2JfqUdqtFhfoTlQg1+RtykGlqsmzXkDuCS+rWodiXnQsyDqSTDygOJehQWockVl8HuX9w4AdHxR66wY4AoDhhL2bFwJQwPMyX3noK3k14RZNTp7pHOHa2X3tcBWGCHilaJcUIBreCT8lyIeV4IgqHrIJWdGVwDYVT5kAIJXFIcn+I98ICk44ILHSr6S4m+3tRRpwX2nobZOWHE/uGiZEy8sb0c2ln8PIm0JAxJawUzkMFJ/AoZF9ldt2IYxQnjl5my7jYcZIgUG/qMLCIY285VukdiDMMBomlibbCCFkKC+SjEHqnhisZiR4VGLA2BWe6SAw3ggfAg13CQhSKRsmSKfGMJW5fiuctSNm/fSNpkO1eVmqKshBDcp1E1KuiBkR9OPi0gYjmUIBDmb+k0AKICFPEHgqmYArEF3lbaRi1kwYzUAQsBH8FWfPjmPJA+TVyT2Ps+Zd6lH/QlsR9l5ZbiW5hg6njgpQkg+lJRjvXeW26VXAm8scHmTWmoAGAF9WSVKSkkLdJcWvMaY81lCncBH4liCXiESAhU6FDgz8uAqpY1cNu+a4Umb3RgAqxmVETg9CwJ7tbMEMzVku/ectWgNvJGdNekG/uqOJkGHEUr0gwcg2L41QvW5mGVTi1/FD6bTQkwZj7jgeA8EiAVjD+Yvg3oroWmHSWPqlxrahimMmf95ObLul9kkmmtJQmxzo+lmGQgZ3z46jOIyAO6MhWoqDI/zW3dhVFmaXF+6XHnFnKuiitY4IUyhB5ZAoEuDrwgDo3cnzXyGh+2XeY7YnxSVqAU4U/zZUHdHNtJRSgxgfylXr6O6opahqYTOqktInAcgikHnDOARrlKVJ8VaswcTAsIEsL1PIZYgAloWQYBLrhunIY9DWQznbFjkcv8oGPs6gCsCr5csBd96KBqYMGI2jPtYsSHHMStnWh+bhIJAMJLAjJYu/gxP4Fuv2FzJerPBFC9+wEd86rMlyBSWIAB6oBqhI5lQY65V+016mq4PJ2d8GKIlRIYpal5lO4C3ahn1ZzWlUTAeQG5XJL7F77dzyGAFIJOIm4T61ps2OGAquxSP9kEPQU4tFrqblqwbPAypTkwmWZ9mpAF2OjoqejDMgJI9+bUpCYDdW3MHthnU+mrLhDRKuHQzDoKmmQ0Xer9jh/i+caxi9/h0QDDMUfHgcQKR0wKje6xN2AD6Rk+a4boJCGNgwHRLY6kFgJw73CB8YQW5yqdEvIYnIhDfFTU8oLvnj7Vt8cNjHF4+7CXHwwIGIN8APDwuagPMiBLgUQEeVBbw/hnI67xq+GwHOCXL5wkpuOzJR4OwCYMLoJyulRee2tvKSVkijvpdSXAwRqCIFUJGxRKqxfxdLmouxwMFwuK/1bwuaqByrBR0ogAeVcAvqaENStjOgVyL6XdTlqG2KxehLkYwUuAsJ04+Bn0jlewIzyvEE11shQM+pWOecFEw9pjQ19vS6SZaBWC4w6MKjiVKPb0uGiAsSMCMPoGVmc6ru9Ad9RnCV13ytrMVjcHEY8NjDYALIt0oboww9FO+0zuSDB0PgT2A/S7WH40TCAPZxfJ/fHvZ4QURkgIByAOQCVOsqD0uljYsJht0KkHVCaZ9KZCGxH2LGfy51+Cs/ybf/mX9QLR2BLiWKUo0KeDdd8jbkXodvUTZ3k1WJ86ddhQSWXZpjWU54Idmxsejx5ICB8IHDo7vorDdjMjgVbW4L6UPMC2eTpXev7UPWHxKCfWKXQnA5I3ilQn9FSqdmrK55cWWwm9VKmdeF7e3dmD85kdmB5KizMEDAQhe4elCCARD1EFnnplOthxvlZg+uiE8AKwAXgJQ6mELLzJAEgaoFWJ1zCi5bTYei7o+gBn9XSWBMNaS0On97IHFUwMZPO5NAILg7efi4Hk5240g3AXgFBxvpfVe9dkEXd2FGZhhGY6cdvJgQcWCCczYJ0ZBShKfccoFlbOezVje8eu14xUN/hImf9dnliC0/vL3BBmO5dnpItqv6fPn4li+INs/gaun2HSg4RC0oAUc4AAMQAJUIAsWoRoe4xYOfvWDHFazUwsYvzZe//UBX5/0oK0m4LAbwtgJowkOEiBeCXRFsKDBgwgTKlQI61iyhxAjSpxIsaLFixgzatzIESKAjyBDihxJsqTJkyhTqlzJsqXLlzBjypxJU2WrhK8W6tzJs6fPnwkBCRg6FAbQo0iTKk0Kq6PTp1CjSp1KtarVqxpTCQgwAI3Xr2DDikWjYWiBKmPTql3Ltq3bt3Djxr0x1AClT3jz6t2rV0QAooADB0Y1rbDhw4gTKz58qsUAwYGH7EJM/m0O5MuYM2vezLmz58+gOx8QtgyraYzMUqdG5ivn0tewXekhILjHzZ6aLi+JzfugwFewevv8Tey08ePIHyqryby58+fQo0ufTj2k8OvYgeoJzCK79+8/BSYfT768+fPGl/3Z6kAuWCFEUbifT7++/ftqLQx9wbd//wd/fbbIYgQWaNgpGHymBTSFWXNCaBBGuFmAElZoIWZuoHeaaqolcwx4IBIECG2BPaAHQq4ZFIluISb1CikvtkjQQA1paOONySxjTHU89ujjj0AGGZ2MRPK2B3dFopgkbK/g6OSTUEYJlRZ/aVBfBUMdgN+WXHbp5VdEkeHfmHlFQOGEAvhh/uCaiD1jA4QHnHKIARfWaeedeIKmwTKlSfkUhxwu48uSwkFCYmAybLKTJJAFQAOhw6WIFCwDDeeLn5hexaeQnHbq6aegQgfpqD3REVgKpKaaFDKZturqq8mpMNQK9NE11A1f5qrrrmvZagCZwD4g2JmQxcHmsXPmqSxRBsSw7LPQapYKrBsBqtoyzBgjqapASUKnYArk4cq2BUHS6KPcJgQLKS6+uO5wDlErb0bLIBPqvfjmq++n5KY7ahiBjeDvwAsZM+/BCCcsUQND6UDfAUNVwOvEFOsawl8kAEtmBKFRcayB1FARrbL8jZHAyCgDRuxnAVL4Rp8KS2QtoMv0/kLwT5IocBkMnChkLmQzeNcvUkPr9NtvBRV9acxMJ1PMvlBHLfXUMMVyM5FDAwyYwFd3XUzTYIeN4zLDEEXEfCgQJUTFbLdt3wJ/QaHxmByDxsHHBELTQsp4joGXIyJAuzLfF7IAc9gzB5pt1zu9EonOkCUQBkKtbAeZDEYzvtCLv7FrtMFiI7wc1aSXbrrUsRStOXhcBOaB6qsv2VTotNd+XCZmzVfFYwKA4PbvwL9F1Blz+xc4aANQg3diz2TAO+FoYpaAJ3p5cXKEg0OvrAPD2K5RMzbHBjt2j2OWQs8G5XFZd7F/t7T31O54+vz01w9k+0tuEdgG+Kc7O/wA/gzgRtQzlPa4BwRDGQBagsfABn4lCEMhQPH88wIITWZ5hnmGA7RXpxjwxREVvFD2OCihA9hCgBgpxvhupglhXcYAXLiNK0wFGfb1rzevAB0KM7UM+/nwh0BkzgoHNsSlMCEwGehaEYvUpB068YnJsMJQrCQX+AxFPg7MYvBqMJQITLA/RoBQHzBYmGhcoDMjJMrK0hiavwQgAH7rjxgYcBk2knBZA8AEFCuCjODc0BWccOFlPKAJgphhfX/kzfv2GKVjBPGRkIykSZaYyKQcETATqGTmvvMKVjHyk6Hj094EQCu5nFEACNCiKn/3oABk7It7gQKEbEBGM2Lvjm9U/sBd/FMJIzzvjiT8iwrW4AdMdA+UDyEGJVWlCQhkZgDi0ppgVPDHZRokh8iMEjEkyc1uBlGTIFpCYDIJTkLpMJvoTNgGBYCruPCAKO1cpTwnpoG/GAGWezkDnJSHN2lwAJgW8iCwzkCCrQiuQnas0wE4sIMs3MESv8jRE5FRKUItkxMTyEwEXKE/yHDNokkCjifTeaMeevOkKC2d58rZkyXSIDAQYOmSikPSmlJLGGaTi34EYMB5+lRXWBJAFPCpl0pEaEB4cwFAM2NHMc2NDHVbqlQBc4AONPQOmBBGAJehjNaEyJoKwWhm6NBRwXxUpp+zKY6eltK2ujVfaM3O/ksB8wCsIQ2ci1SrXqO0ir90JS41CJDDfkpYL20wAFMgql4oUMfM5ABvaQBNQvnGgC9WYgp0nGq0KhCEGoQAAw44FBsboIIfuCERtVAGnw6nsD4dA6yQ2oQHMDMBKQwyrjqBRTP2qiGTvvW3wBWSDHEbGxkERgFEIgUsTAFbbv2Pt9C9ESH+0tO3IOAvEiusdrfkgDd+QbF5OUKEonEsRWg2QveEpSegcD0JTfaOQRALETr7WQf8clhv5MoFbJCFP2TimE3ranOTtIkNYMaZkOEfcRHyteieR37BjbCEp8OkBROEBWdCroXB00QHe9g8b9jKBeKStr+cbbsors8C/obyXfB+QgwRagOboIGA80KIeESthBLaK1kbE4VEC3hLFYJwAxSAVmWZWegO1kCIVWjVKanRkDKUoa0BE2kUs/1MEjfsCliM9MPjmbCYx9wcLsNmBMc184yw82Uwu9k0P9iK74RcgKHMOcV4lsuKBQAGF3+iEgl4L1EOwM8CiWxkb3yWF11MiSdkNjCCluoAnLWVeLqHCDxYAQguADHODOACMkhDIFahjIxEGT1TnvKg8DcKNHuGnKmysm8a/ObkOJLMuM51S2S9YFczi6W8/km8ak3sqshKADiAy8UEoMA8Oxsu60ysn0MYGkEY6BQ+NqhnnuBnvHjCC2bKdmco/tAIErwxyF4igg5WoAEHQMyNmamAC7LgB1vsNiIdcpK28NcKX29mo0pKJI2GXWzj6PrgCC9JK4KN2ywTZQBq9g6tC05xp6xzsG0hAu9C8OyOt+WMAeC2n2EMIQdIg0DSkIC4PTMAR3Q7L54Qw/EgFGk7EUBujNhKAGxAsSHfIAQXsO9mBpCBJRPCFthixpOm7MfYtYIFnYkpbl9BjDZX3Cq3TrjWEb5SDieSsYCBuFIYfrOh5fXqaOfjUAJw4raA4I0F8Ljc1cKBNx6h25V4NGiMtZjI5qnmFRLBy/lyBiOcLNErFwAJXP6JCgagAQwUQpExUGPNBOAAIRjCHTJB/prSsLY8xih7Qp6uxgNPneBOOsY50bn11h98XBFPCoIBMyqyE+m5ac+9RGxBlLdo/I3JnrvwwRKCx5ig255QwtqHlRkDPEMx0PhWG6eK2MH3pxJemLlmEU8Bp37CEY8JQPC1KATPcjr8LRtAft9YdDdYAsCfP04zmr464zK1AWh9hS9KbZ57P6QZxlAMreEar+B/yGQvrpeAY9Y/tqcTs0cUsYcdHaZ7FPgQiJAlb1F3AXAWw9eBaMBFAkABL+cIhwIaj5UYbJB4nUEAu2R9/XEGSCBIUhUAEdBnekFpWlJYQoADIVABnaZ+60chEOACa4AIxxR/pkEM+GN/dcQA/jL1CqhHHjpCDLBAKTgxcaDEVgq4hcG1Og3YE3o3FMMVgbFRgWaYDOshANnFFkSgc+PngXMHQVwxeDEAeAKgCIgRfTNYIfzhgsBCBkfAYyREAXGkF+A3FC2QZ1dAXxBAAIi3dogHAUBQB5hgdVhRL/T3ha/RCjSwRlthAK+hiT7hC0pHHgBIhTmRikVDU5+0Wlz4isBVUWTYE4IoAKPASVwWhWdYcWswRW5RFqgEhx7IO43wco9wX6WXGQ3AIIYRB8Bkh5CGY34ILJ4AiADiRo94J4n2GAQQA8UIRhEkfEJgAz3YaToXGAOwAU7gB7XwEHwiUTIDKBqhDMpEMOTS/gOYAYotIou8gU0ckTgWoXq+YIWTkk3LoIWwmJAnNYtHUYJDoSgMySRYuIsUtwxxJgAcxxZWJAA1IIwduGIBMFQvJ14RcoKFcUoqqBkPMI2w9AhQIALPA411RAAl4AUtyBeUQCJY5IFE8HOchhmPtwN1sArvGI8cwhGvFTsyGHb7aArCkRO+YIkXAZAQoXpUOCOpSDQTyEi+pZBeKUldNxwRCBkQGZGvcXYUWWzLoFSk1BYJIgA56JHCp4EC1W2TEGgxVhizkJKcITcsiU+UQAZIIAIOWSEMEAM2ST1k8gRv9Fdy6RVEYAMgIHT4ZQAskAWd4EmpkXSnxhFexTgZ/gUZYndD/ghlzMCZy3AMwdAL4QN7/ZhN2/SVsglJZvkTkIE+takUuJeWanlKljYWG8lzjzl3gRUADKCY3fYEFYKHh8aXmSGNf6len+AJZzAFRlACYbgZCSACRvAFjDBBlKAAb5SRwxkW5acBB/AYQLh2AzAAI7AFmhAMnFmKHZGUXbOUtNdSuPgTXiYVyHAMxNAL9Jcd4gFKXTmbCGo/rpmbCjEKkFFIDOoivIl2nRZfa3FKqVSeclcFRFEGg+cJURUaB7AL6+ScjVIC0emCnvAIZQAGT6AESHAEMXAER6AETzAFY3AGyAlLsjQUbaehYuEEN/ABIDksCsACXMAJ/sQQDAY4j13VNZADGXYFW68wkRmBDMFADJ8JFM2liyh0kAkapvajiaIIIpvwoNxSpgEnoRNKcciQU2phRQHwm0CaZ0GVXi+nTyVkokApBin6py5ICcISAB1Qp27BAz0Yk9i4ADRAB60AC8RgDF9WlMnAf/y3agQjfYIxhtdRKcoVlkBhpRSBDMYwkPyYJKvnRAcqpqxKNRGqE7khGBD6qkfhpW3qYb8QIGzxltWVRWpgqG+RNgIAAS54BDLJp5BRWYC6rN3mBXAKrG4hBCgAAb/EFUPhAVsQCTkBqcWADJ5XqRJRDFeDjETBqU/5GwSpFF6qDMcggAMaUgjBilAU/putWq9TQ6sKsSKCEQn4ehSieqsOphXMthZtOBQdCa3OtpHQ6WeVEKLIeiF3x6wSq1jhRkUIGxc6MJnnqEYQsASAIEOw4AvFcAz89xCYOjCZUZbZASMCASNLoX8QwQztaqqMs5tfaq84GzWqoqZKwSiCIQn9qhD9gpYA62AXKACQpxYIBJdyBweG2l0BEAM76mdnQK4PGxoDsLATu7XAMgYJtDYXOx9EUAMasJ6AkQA0cCK+4QtsezWtkLL9U4WvwFztY7MChJA5m7egYq5eqAmz+h2SsDJAG7Q+Ia9F+2F+UEBqsTuzErbOhgNcwYIuOAVXeyEiyLWYqzGMFQBr/ui49CEEIVCigGEAM5AHfEswZ4oZuNk+qhg7BfpEq6q3sisk4KQHTOCU3wEJKwMJhNtSUnm4vFUHQ2EBahECCSQXv+q5DEQbAeCX1kdtlQshXpC51OsfZbB2Fqq89kEEKGAByKgATcC7msMJmfG3vcskezS76uspC0qaerAB4psdlhMYgHC+m0O0wAtdvSgAFisWdSYAJ6C9eIZANOiHngB20Qsa01O9DKwXJaC4ArwlVWADF3BfAfAATGC+/hKrl7G6R8Gz4FSAT5R161vCPwLC2QEIB7AEuHsd6iMYamu/SSMQqZq/DkYlAcABabECCfSjEUxYBctnfugI2ZnA/o3iV0jQwEqsp+z0w11SBTVQAcg4AnRAt/6ir5dxi9XUPzUMPyb8xfcDTobCADHcGzQUGGUsw12GhDYMXXEWAOQZFp12Z05cWEH1AFPbbWdQmEasbcuXAFqrxFxrAuxRx18ytt4LiQGgAEzgwaTis5dxuowDqk95Hf9aOyQMxpo8HamDwsKRMwOQKMJxSIIhLmo8Ll3cxtEFBFsRx18BggLgw4Y8T3IqbS44BlZLOMcKlBgjyAycc0MhnLOcbivQAEEYyvFLKj9zGZWUrppDdU60ydLMI+CUM4+3B70hTYBhyqSJNbqlysTGlqUUFuuEAcOsXWVhnJUwjV/Qx7wM/ke+XL3OcnnnvCs8ULaIFwAjkMZLIhQvVEku67p2WzsQNs0GLSqnikMf7BM5UxQqqxStozIBsAdkGsKXDM7QxcMCkIjmSRTZmyvJW8/uIQT5JXJ+GAUitHIrGc+Ze4htKdK6cgUokJ6AsQF0MCrzCy5L0lxHgz9b6cUHHdRDUkmRwDACoACT8xplBYl04Mmu22W2itHRdWwHCxYfAMEwLRZO20AfAHePwJLK6c6QYcssvbXiFQAGkNUTUwN7tnYZwM1FciSXUVcMyDnj49Q4gUJ4K9R8TRMLl0iaYNT67Mg/sdQ6ZwctjK9VKtUF1wHBHBYcarBq7VNEUADj+Zdh/p0yu9wZCTCdZb21Odm4k80rQYAlLZMBN401ZywYUie0Zcc5PGHFqdKktdMMfX3bzlFJLTRoMWRJkBYAdmCWRVMjjF1swPibOHC8oz1PkOtdf4nSz6gsSfzZW4sEW0EAV7DcEyMEpxQg8EskdlBHEJDMrpvQOMEtvxs2uL3ezFFJnPCAhIQUTQBpA5DU1yTc0FzcBZfOvxlUdKzdWmQBb5QAN+mC0C3WAhDI1B2d4TmeAE4xQ7BTRMECGpwdEX0Z/Cw0zAVWytXT+JPKYJPJ7D3iL5FI7x12W3AU+CjRXPCyp6ffFGdgTfwVQfzRD+5Alf1GfciSYJDLzJeMmhWx/gvOrFDwRgSwQDdO2kGVQEugxd9x4ZAB1xx2V1oZI5SE1wRx0UxD4lwuE5vTNZzgsBkwuD0xVyrT4lfDswJhuDBea449414hrBma5FqEAgFC1n7Yzmi0LPAmIVk75MzqCcYcAP9N57oSBKKbAL0digph2IGBzVhDyT2hXJWEv02z112e6Skh6YyzCQicQE0gyQUBA8OS4gwKhW1ecW9e1WiwTq5s6Ay0U3/OkmG055bXRtkYGjsO6H9KuVwhy7CeKzfQaexH3r1xSZeR2jICHGPXOF0z0Exj25o+7bt2QwUmGBRA5gtB6oJh6hEpEJae6h9G1V9RBQFi48EePAbw/hcPUOAvF9oCwMcmiqe8nqIu1L/pzisr4IgBIgOE/RrIDhnKvo+czmXQHjPUnvAsQZqyBRk04OQJAXWCIQW1ieriXnGjNM438Bdxl+8OpAO8c3x+aN1wKQtLC2l8udL1Hp0kJwBgyyUhTR8xP8xEkM65NPCxIU6YYQZM9K4Cx6W2I+IKP/QkcUOtBhkQkOEE4W9EQfER6Qu0ffG1tgNDEcBesbTm7PEOZLxbYdLv3mlaoAu6oAPR6+4rb30U8EYjpvVsg+gtMwIVnhQrfhk8XyQFv2EiTDtEv/coYTXt2zWmwPREIcoI4XCAwQRPjUMgLvVg5gRDQZ7r9IZsDzyz/meDL9ejBjALYq8LfODjtxQtSnD2LEkG2Dv5bbMCz0MAaA4bZg4Z9r3s3x7VCIPpfF/7H2HejH4drZACl8EA2CwpGTAsu0GGB8/4YJYFvugVvIPups82RHAARu59fmbUkrH5uqAIlNljJKTyom99DywAxNv8zr/kAtAB/Poa3H4Zq3/KRFMQWi4v0m778i8Sf+10LGC1LLC6wQ9pwx9xpWn8AJFM4ECCBQ0eRJhQ4UKGDR0adCNAwAU0aKpIFFCl4kaOHT1+BBlS5EiSJU2eRJkSJRECAQIkOPNJ5kyaNW3OjCJxAC1dPX3yQoFR6FCiRY0eRZpU4k2mTZ0+hRpV/mrTRhh1qMSaVetWrl1V1iAgMcCALq1cnUWbVu1aFki5vFobV+5cV3Dp3sWbV+9evq/MniX2UPBgwgMBHEacWPFixo0dP4YcWfJkypUtX8acWfNmzp09R65rl+9o0mpbtS064EAYtA8CEF1SWvZs2q5gLSucW/du3r19/wYeXDghiQsqEnktwOty5s2dP+8IJHkESlOZPpAYxOd2Xbu0JE2uVHx48UUDeLGeXv169jJjFIceX/58+hWvXBA6IZLsFEi31C4NLtEAJLDAswb0RTgFEzrmMwcfhDBCCSeksEILKfzLQA3RagUG81xiwSzshgqghw1PpO2VYhZksUUX/l+EMcbgMNGpIiGSqy9HHXfUygaMqGvvCwEGGOAU7rbbRRADymOySScpaC9KKaf8xBGMauAxSy233OiGAzAigInSPPAPxbteecUUM9eUDRYZhWvmQjnnpLNOO+/E0zM0B2RTthlccoko1hIoioY+D5ULTWTeZLRRRx+FlDBcktNICAHG4jJTTXMMAaMNJmEvgtdyOPJIWjBwMlVVU6OyVVejOkIiAjaltdbmPigA0A84OcsXU14hxRdSfgUWTbQ8IG+oLhBlttm90Ix0N2DypLZaa6/FNlvJMnR2tCUAJaoBV8IiaoZuEVUxWnXXZbddBb8UIAiLMNLIVnvvVQkE/owoqC49MHRSpNQjc7loVYNVjelVhRf+hBJyVcA3YolHugGBAAooAIE8XCFlTzSF9RitDJAS81yTT37FXYeWiVNbl1+GOWaZOePzZLqWOIoLo2Sw2cxXFlU5aKGHJroDibBEAyMhJma66YpACFSEfqeiQKIWBEZyl54ESTVZjLw+WKgYGCa7VSVcmtVptSe2IFeXljDFlGCLpZsUtCAguWe9N6z5LKIRWmaZmQcnvHDDXd4bL5yJCoABo1hIvMBXAvu7cssvl/EHiUCoCN4bNFVjbdE50iDqqaEiA6NDsC61jbBfN4o8BsqmvT1KEnAphNF3txVXQDfQxFePYdmz/jWkYqut78gTPwZzgZYp5nDpp6e+egjrWn4tJpqEPPvZXmneefHHJ7+wOyRyoCL8BECBd/e5LF2iCECNqoRLQ2D9yF3Wh91JsI86Xe0ECJWcDIkI70PgloJgMZcUYA3E6ljIzuI4EmEEed7DIG2M4bxlIMN6HwRhCEW4GOVFbgsDKE/39FZCvayofC+EYQwLkgqMVKRTArBAArcSOpXwUHQaEEsEHAGVMmDEEPnjjiHEgr7+NVEs6BngTDwRxZtQkHM6xOKOPgCoAMgggmiSm2iWdJQLZtCMo3Hh5QQ3Qja20Y2DY+HetlCeFOQljjZDU/hkuEc+Yk4ZyvAcGm5Q/qMsFhI6+noNAxrxFPsJoANI5E4NJKKA17AhKE5c4sFEQEVO3sQLlxLAAQ05yvjcwG0B2AAnIGiss5DLKIY645ruaKAEqTF6b8RlLnWJJ2OwEoM6U8oIYomXWj4KN31EZjIT8kcgSEQDFcGIvEg5Ta7cMAAKKENTzoARQUDSJ7RAoQBE4BIt3AJV/fuf/xLQSXbOJAKXwgA15ckcIjAwAAiAhMdEkxQZzHKYsSxm5Ty4S4IW1KAQUgYx/HmuMATzn4nSI4yO2UFj+MIXaVRmRjPqB0JWYHPzBGlKVnCpABAADEwhgTNz4c3ufCcAD5iBRISwCz4oJZ2YFAr92knF/jEMwCXSDGlQsQI1lwyAC9jjED8fulS5uKlygTtoVKU6uAPFwhV0WlEvzWiGo7zGA0xNS0BhdIxi+IJ4SH3FBjW6VmQKowAS+ZwkhyRUuoqkBj59zRNsUhWJdJOluWjApZ7whKPpYhE4hR0UdspJEUikAnWF7ElwwMUZqAkto1AqWDVbF8tBb6qfBe21uKUWUljoGMpYhi8WmigU0SGcRdnAavcGvrGW1ZdreYVY2brbFzZzIhYJ5+ciO1xBkisALzhdSgWAAa2xVA6XIsAkpiCRE+giF4h9HZQWO8AzvCYAVyFueD8ShFMCDy2cSIoKN+ss2aqlcspoUGjlO186/s1FQEhtRYSWoYxkHKO9iNrDa4eSAbD6AmgKIissiHdfurzCqbyFcPkSoRONrI8i4oUsEQ7wO/rxVQB+ZSkHLjU2MUhEArvYH3YPNoDtDvAF6MNwjDlShQoASgGAOAt6kaLe9QLov6M5sNCUQV8iF3lCSH0WxzxTjGM2Q7W/NMoElprW4DTjGMRYcIBSFmEui08ZC4CrIHWyNBkLlQgOEEsDskmC11xgpSxVBEayWUQBHKAncu1q116n0xYzjBEoHADSyrwVOGRRxDphjSaSUscea+jHdlSr0NZoZEpXejMBOtBZWhELzURUq9mjg1Eg4DMNPXg3ZCXGkw/0Y7h0/tnVmNvBpa6IgEs9c9BCFfFrBmAEbrK0JzyQyAZkwgiMaC1pKjaYXvvMME/Eqs63HvRdLSiJRWv20TbDqMria2lud1sy106LsaxqmWMKRBmqTlyoizLqWL4iGLo5RkWzDO617PfV9x7a+QSQPjRI8jVkhjZIR0oe5vp6FniFIiUwMgtd1DRsN2WceLS7bIU5zCUrCHiZg7BhifQHKR1oNFOzrS7coNbbJ0c5Y2QJl/xGxiDFoHeS59LQojwglr1ABjMegowEL5jBKIoovoW+LhrNtSK0Xm7GQ8oDeElEDr7WRRVeo4ApymSMAYszsle1ToorjLBGV3qMiQBm8Xw1/uQP1W209jvplLf95DHfS2kZE+mBFIM0cFcLMMN1RlMfhBnMQIYxUn1bZjH5heUeegyHgRFR1iA5PGCOD3toSMlHjAhvXS6K/6oAiSiBJhQkRHfGqGKIG4XPXZeSJ6wY9jLTuOxnf2jf17UMY7jd9t7G+7PQ1Aq5AyB8/E2GMUxoFAbwHSGBJ0Yv9vSrk1GOgwNBfOIPH5YADGEjDnjNAVgvT+RIhA9QZ4OsTvdOAXxfF/zTupOmUHXUS2m6EhHlxAq9ffpUAT833QDs/yl7dQ309v83stFir7XwBWNYFGWAheErCgOIpfAJPF9QPiTLtJNJO5UJHGXABUsohELA/gRcQK3oe5FyA0HpI4wGcAmACwKMaB/6G6VzwoA386ZcQDMBMIKaaCQ26Ikc0In0EwqI26T2mxLyszUWjLEQuCkpkxz9w4v22rJ2YTsAhEL58h67ILye2Z6iIIDvQZQEbLDQOJE7cjCiucBC2IGmwwgD2AE/EAYXWQU/eAMr+IE0uANEaIbAIcHdwL4AACo00JchATgipI/Ka44h6DVfc7gBeISaeDHl6Ik0mKRVKT1V4TogbI8xwAjrWw5BBMS1wQGkQMIubLTcmw2VuaUoNEXQOhRRNJnFIYosVEKUEcNCkACkeA0DWANhGEHdsAUrwJsFLAJCAL47HIxlgJc//qyCL7mnetnE97mANmsuljqnF2A/mXA2H+iJPpAICkKsSCSKAKJE67CfAHgsLdHEZeSSGxAwoWC3VzSjoDMm+DrFePwsPGIqVhyKAWDHM0GRJlSZVbghobiAE+AAB0hHByCEZMhFwcAFJ0hHo8iAQhDGYQynP0QDYHOJHDJH3iECUDI/lhoEjEgYmlACibCBnqAFjGgsHiyPL/jG9fAwyMtIDOOBhhQAm8vHDKI7SOkgeeTJqCIQVfQeGjAKBrzJbnFHtUuE0RuAITgFaZiGp3xKWUiDGZQIK0hIhyiE0ZMIFaCCNpgDLcgBMxSAH2iGiHSIWqghj8AAQFnBmFyb/nNyM6g7AYkogZt4P/wRPYkoMZW0KRJoSfVYRONwSwwTAqQTCnEpSu8ZOUcZsp50TIJKzA2RAeKLzGY5Sp0MhNfygWeAys6ESmmIg9EDgqtciDUQCg04BGjwzKgkRIwIgWEwS4ZAhOzriCCwAJIKgA8YTLXZSKeDuqwTADK4ib2UAJ8AIgGYAvLjy9hpnL+0DkdAoQAQtN2klfnbESHQSgFAzMpMnApkFGJ4zPDMJUzjTrXwkHUrzz5Jl3ZZBXJBAFpYzfichmeYS4nIAtJEiCzAiAY4BPnszF1oAYzIAFzEzztcg9cYRzSwzaFwgPijTomBy2f0pkESgImriTLI/j6fADYBOILUWc6kqATnlApee7YHFa96EooDOCNNeEXvlJFtE88YFaH0JBDUIBECo9E1cT51EYZedABd8M/4pAY8SwTCCASM0ADODFKopIZjEwAXsMPYPIgTeI0VrAIBswDwMlGJsRTvk9D82YWTlAgosglGSI7mCj8BqEsK4kZkEwMRhQqHuRSM29LwQlGdAEotc4VWoAMa2A8l5EdH8T8ZJdQPytHaGAGjMLtD5Rv+axTc8K0BmIUljU9pODQHKMuHsIVw6gCnpNTOdDgBWIMCdbUoFQhm4IVoqoiC2TctrVORKEf6sLAvBdPWnB2moITkYLhd+EgBmJ33yzPz/sCpF4DTp4AC6LqCV7XTpvuPyIkEJjAAD9gEdgxURnnCQsVW6bEbRh0ToxCmDMrTL3RUa62FcPKDT41PaxijOxAMF0CfaEBXz/QBWfmFLjPVZGiGX1gFSyCEO3hDINgBFdAACOA4idC+LtEAV82UWN3SLi0/qJuF0YsBb5QJcgkYXZAFjAAVQiE9JrnVYr2OS+EAZT3RpoMAFrUZPvU4WKJWnQTPbIVZ6alCbsWLDXgcmnW0an0UJ3AJDaCGeF3NNHWAIFOITMAIVADazpSGGaQCPgocnbND3BAGW8iEfk2DH7CBDoCA7FSKAdAdkl0bj1ouqIu6oVAAMqWJwBIA/kNoLnjJJhL9UKMAWabYy1AC22UFEz0wGU7oAm1s1pv8I0eB0Zgl3JkRQJy9C+UcighA2eRBXJ1tlGNoiQDoz6TtzGgYoyJtCHcVgBaw3M5UIomAzRhCBluwBD9YAyfYgQ5wAFeCHQRw0LuVmBTsK4iFF+MSJ0aoCfIThObqQ8XyhDZtIrAZg7m1icYKgAuT3eGqAq3cgsM1Ez2wUQEwgI0pStpqlJYp3O2VmXBlx14sisZFXAC5zDexBJdogM/1TCqoyoYQhnCSBfWFylkUAD/AnKlFhD9Ygx9wgQwoWLH4n7EgCtVYgArAABAIARTAgRvQgSAgAmVcXqaxgNfQ/oDmolWBKRgCIIIVELCJnYmUnIPm6tKx+QQ2i9tMkggSNl6Z8DCFjWC6ol2MYIFR6BNO2IIRwQgI+NPIEcWclCjuBeKY8V5H6xm1ZRzxHV8NUhcseA0fkF+oDF0NaIhCMNgnfkpHFIAdIFUZWQZcyIQ/yAIg6ACx7MGkOAAEsAANSGAbaODYfeH3SUGXGATbHYuvHQLwFYAEeIIpWkQ06IldcB1xkolJOOGi+NgVjgGXEMw3jqxz+hFJMBNAOM+hGAFeicz1jBGoCuJN1pYk3gvOqyAB2GFPno3FZBQVkIhBsOL51IlMVQgrkAgqWOWMrTO/+7tb/jvfmCiBKN1C/nADK3CBC6BJpBgABHCACwABFKgBHhACCGbkaZpBECBbNHiNAoDgiskPMqhGnwhdA5iJqinkoZhGkJXTABCuZ66rK73H5zUQG8bhoaCBWBhidKELF1WQUuTkfM4T2ZhnDHLdoYBkUqYNXwjGR+nF+LViasCI0VWIWBOAPlhlaMAIVx4IXMZl3pDaVPCDLNiBDBjmQPmaYkaAC+AAFLgBZkbnyNIBI7LdS2nLjagCFBCwCSBJn5gFjBiiT9imcBYK4VzhsxGAtEnpuhqpe6zk5JGEHiCS1DgqtejnbsktLh5cfabq+hJovECKgL7q0hhXiVoGtb2FVZ6GcLIFhrih/sq14nDCBYOw6FsuDGVoQyxoASMGYKMoAAf4AGXmATce6uFCOhSAOu+QCGsGCSLAgHQ8AQsmu+KViXcOZ2JdYRMUgK/t65KwTgQS26EwADqQjVEIA5o+CgPQWxrtauDQ5KpGbTqB3q0+C6SABADhQsQtbRcJnF4M61VW21RgiHNCaCueQd0uiLbOZffFBDcAgpGhxeyzABBYARugyMqOMTXAs9UxOHihbJBYIIC04PpULJkQEp7OxhX+JAOCbroigmGGgWndC0mggX8mCglAYu6EXOG41tS27yN76pDDrKN4bda+O3WR7Nv2bYkAboUA7d5+4hlUhegTbp07iP1K/oU7+IHjDGWdcICSvgG+Lu9bQ7oamGaJMABnBokaeKt72o7eVOFP4Fjwpti/BOch3PCQmixRG2268GybVYoUUO8cnW9dRsj7BnIL+cny3IR0qnH/5guibRTbFuvfZgjQhs9VVnC2Fu6CaAZMeAMXIOOvEYAF0AAU2OsYJ0I8u1iWugV4OYGTsJTX8IldmAOJsNAkAG+JYEmQpbN4EXOhQr8eHAAW2HG1eFauNQoTsaN8pG3aC/JElxAkjwtOMHJGH43yjRGwFmukK/CEgPImlwhVoHJctkNhQIQ1OAH3xogBqAAQqIHnznP6gxdSgbpjGwARD4mCCQCG645DkJWa/hjm5axLkF1Eflv1kCI7EnmNBrBeTaODRC2PATADxC1o+p5qRZf2S0tPcFO0ozhyUv4vH2aUGRTwJ7Z0hlifKB9wAcCETv+7YSAELeCAXb/wGtBwGWPYYO9EiUAFqDtzibjukhALI+mJW8AIn5aJReTpSRTRSQin6Qx27qPJ8GABTtCEJqCkiCuKBMh2HmaW02KR+p72jr+M/A65SOiqPeBxHY0WCHiNb5ff3L7XgliGcdd0AVhw6FsGZrCFP/gB/gEXCw8BF174ZWxemfpwASBslEA66u4JqnwB3f0EQp7z02vJYyV6Wf/5UXK8pNj1o5iA+GZUjVcQjvf4sJcM/nl+xXClttjhbEjfC3t+kQVIebFmeYVYhkyX8k0XCFwohCxogf/9mouxABTYw6p3y0syAJ6obn1XCaTrSF0I0FKPAd3FcZ7ubhHtxX0X/GnqwyZKgdUmT80yZYwW+9C/DLVXC0hAirQn/TOZbRfJQ5VX39xeiGVAbgSX3xkEAhegaxI5AAyA9x2Z98tPoCrAvCoIbPadepUQ2znYDlZ1fA/laQttSTJIDlUHfkPK7Ncpo83CO7YvDHwW/e9/jNRHC0A4ffE/kx6HEZQPAF6AewKPfeQmd8uNhlOIAx2sa6I4AA1YgXiv/oy8oQMAiFu6BhIsaHAgLQMCBKBA4/Ah/sSIEDEs1FIwzkIEBxZyJMDxI8iQIkeSBEngE8qUKleybOnyJUyWLxZakGjzJs6cOnfy7OnzJ9CgQocSFVplY8mkAgYMMOPqKdSoUqdSrWr1KtasWqv6Sub1K9iwYscmW2YMANq0ateybev2Ldy4cufSrWv3Lt68evfy7ev371tXr7YSLvx0sOHEiqfmCUAyzOLIWhFLrqz4lTKymjdzHutg4a1pokeTLm2adIOFqTgvu7BQ1unY06ShatMCKckDF1DoqFL0N/DgwocT96mmOPLiVQYsVHPwuUEdzA34DsphoZCCixwPQLMCt9Lw4ks+imn+PHqXlCYxF1AjOfz4/vLn058vpP14kA0gWV5MuT+ArsDSGYFeKaPMMYApuCCDDTr4IIQRSthggBVaGOAeJUF2IYcdVphZgSGG+JkAocl2YmkkrrbZMhksRAuKsymihQYhOcZRAbvdUB+PPfr4I5BDHSdcjQIgIBB00J3S3gpDobBQDQXlwpEQaFTxXX5ZZolEel16GRMUCxEQJJllmnkmTzdouVAAGWjiIZwevjKgiJsps8yEeeq5J599+vmnXv/FedmghNGhYaGJKlrVMXU6StadqZUYI6WSrqjZMhO8eCItPCgkUgAHYMDbFWiaeiqqqfI4BEdzJJmkDQsdQNQKzJ1gkGsC2ABRDeCt/vkrSBF8OSyxKEUQQAAhqHrTkMs6+2xOIaw5AimLWhvZK49CCii33Xr7LbjhunUtuQCGUdIW5arrYaPaurvMnRCARmmMSF1KVoubnoZKkSAZcMEKOkA7MMEFF5xrBa9CpwhHuw6lw0IYGFSDAMlKtAKwGX80QLEdp1cGm0QYPDLJy1KkJQxvrrtyVe6Ghae4Mcs8M8012/WKoCzrTBUXJXGRWM47r1yMy0U7gKyJ9MpmaWcuCgBbadSwujEGOIhcMo/Nyqc11l0PJQRHfCj83JNGFgWxkbrsQhAaEdt0Mqgai3eGx3XDdASyNXm9N9/0HbXmAEtwIrTOyBS9zDLF/ti8OOONO/5n0IQL3fNIAaQrOVSRY/4UMUW7fPSkSi+t2jKc5QojadCUvdAFAvf9Ouyx94TAQhqMfdAhHLk+FBELDbDL2gP1kZFNy7Ep95pH2L38SpUkEMAA78k+PfU/EVFAxVoOIIPKm1vb7rtnPT4++eWbf1csh3lP+BYkBdDF+vFTRafnj4KetOimMc2i06iP1gJHHFCl6hGwgF6j2EIOcTuDgGAhFfhNFTgyi4IwbCE3IZFSboS8jwiLeR78ArIG4AQDkrCE0tFglgzAPfkJJk7GcNkyEnS+GdKwhuRjIeGY4D4p4BCH9KtfnUiEv/yhRjWskYC+RDO8hYCg/oRn4poTo+gQ2gmgBQssiCA4wgPgtOcUBAEeR4ZgkyBsEFge9CAJkKUBKbJRdtLS2Ay610MLEc1dyLAhHvOox3DFQnNzTJQOScKEVvxxfZgBoqMe4JghElE0+8NU/0YjDaRgoI2WvKSPcMARL15xIAgLDlIMYZCTSU8iviqjeMhwRrtRYgCOKSUmYzmyXGmMBZDwYyEJ84rOPQpxe/wlMIMpoVyuawklYYKciCkZECFyRItspGlUxJpIKnEh1JElNrMZnE9lp5O6mANHghAcKsrBIDlYiLJsgkDkoVA8MVhl3bwQQm3SE1oY1BgFnKLMyHSll8L8J0ADqpd9kqsH/iVZAkElV7pmOjN00BzNIzWTK6hN4wTorCdGM5qTBgrAABPs5C2ouMbgVGAhripI2wRwAZzgB5XiYQA8PSaCim1AozY9ExFaqjEJhIGQCSXMD0MEM4EStahGTctPFyWDgyYVl4kCH0M7o0iHPnQaESWL06AGDSrdtKv1geKyjCcANHhTF1fw3dWAc7I0GCSLApjVTa7j0vzEtFiT4IgPYgkHr+4ErPFBWxkTwAQ5xs+pVsFZnRCnuKMytrHB3JxhyQWDygWABkmFU2Rd8cKoEkheVH2ovY6or1MspAB8PS02i3QkbybkosKR6xCChxDf5SRL7dTYGOo6rCfICrW+/qUPCm4rtxTQAUCZtVa26rRYxzK3uTTEbIeOWyEWUNayl2UZLzlrJ0kxspEqWii+qMkH1v22vFHs3ULaUNZzdpQ4ZcuBbHWRi/aI8yaenWt4XqDbL0XAtWXyq3mlWFL8NqAJhL2uK0RkFucyuMGPqxaC40QC91k3wuR6RT+1CylleLa7RLzqWKipBf8GuMTTG3AFkHTFRXAElsAp260MUiQXQ2QIyDoefkfSgP126QweEcAATSxkouQ0x0uJgR7kJ92ngFczIJKhg6Ms5Zj5NKFLXkwHSiIDC194Thp2sjK4W1WIGpF/+gKgAHAw5PJW4QMfiJ2aFiKIslrUbMSJ/vMFDoK2JuJEAcIVrks9wWP0IGEhDVgzooUCWCMrYAmRMK7OoLrhO0650pbmVvq2cuUIb6AkMOByuZL7ZbKIeczTCC3/kIW6Ojss0XzlqJpfR8UYd1IOuisOGdNmEDU4MCeLNvJIVDlo8zBgISpwNbJ7ogFAu3QDXNiElV0h6bEg6NLWvraeQO0hCpSEBdq+lqhHLRYhmnoa0uQMNQe8u2Tb9AM0eV3ZBrAIb+ZiwHojDtiWEl9dDKK3OfkxsEfCgmHHRAwcKRW7E34T7AWcIwNgAR2qTMw6sgjbFr84hb59IQgw29sal8qmJyNustyv3CB+maaeJhqk1FfhGUVb/nf4VoVP+aCsbPBdkIcTwYV8lCC04Eh1brK6hoPkAASHyYRV6vKlQ0QHzM7xw+kwiomzBuNWvzpfPm6h+4okBVpX1LRHTm5TnxwsrXnNNKjBkbQynZ7MKUDLu8bRA9DCm7dAykiR0x5UGGQXGwlA3G0it6eX5Ogu8fFCdtR2pg+Y6CB5uBmmPscMkwXrlr88XUL+dak04MYiGYHQRhEGQByWhZsdOVg4/lloUvFeY8mXAGC0VQsuvp4WQNabvZZvATjHm1TwXdCL8ykFGqTOscZJv9wnHsKDhG6GX8kMkGXa2i99544fyQi4cODNUf5lxMA8+MO/Fs0Tap9/F64H/nQmiR48ABDkHxrqw7KAZ5K9zJDc1DM4Qn164gBZCNjbyThALngTaS1EQ8AHFfXBQfDAQnCATlhfeHgeRzDfSCjP86XEJBQAsjTJ/rmcXLFTxkjAEuhBpm1OUIHFcomfCl4ezmyeZegUCqWfurQCHXiAAEzA9hUSxcVfMozdmJUdWJzONOQf7QkHgCHaERrM9ThGzo0MAy6E2HhTnf1ffAyYehnEzQmAA+wEFUWgBGYMAUCBI1zgJxiB9HUg0+nU9Y2EAbCA9rXQ+wHICZZFCq6gHWIcKcRhouihZKghmwRAB5RLJDDBp6SA5CXUHIpbh5mc/eFLysGIM+gfGmIT/hUdH8mQyAkMYCctkQAoHnys1UEYgjXtRK55ISoNgAg8wRgS3Bm4UgAc4CQm3NDFzRpyxASMYAmuTLh9hfjcoS9eXGXwYQ+1QlJkgLXQ4Ah8xBJIHEEl4qilRgB4WP4AoVfAHmwQ4VgxXRJakrsJwL2NjCYtxLyBFBU9kHxwFBUcxCwA3U58CgiuSQYoQSPwGCVwWwAgQPDFYrKdUi0mhQGkwBsqSs68QpMlA5T9IkJamwv2xygkBQUoiiYwgQJ8BAHoUy4FjTN+2QLMi6mdG6ZM1DRYA23pIybl2vSNTBUwnA6UVUoZgBjJB6s9BxVtkU7MouMBXMU4xgPEgBdQ/gI8ecJMLMS6kSSy3QAF9mNINEAPRNyFhcVBJiRUTtlCWgYnJEUEFIoeUJe/kB6C7aK4lc4imhqq3Z/KieRSXNI2Mt2tjQwIOEYB1F0nocKnnAB9hCOtFUSdcaBO9GMAOAAPgAA/EkAJQME8Lg9Q5mTuESW7VUEXllE7HWV4tCFTmoIwXgX4PGVUZmaDTWVlaEJSQECA5AwnbAE0ggQFcEJlsoxXjhrilNqYeSS+uEYAwMbsZaNitlFJveLI7F4a7NvYhOM1zUesqNRz/J4A5F1OWEAtQs9DCMEJbKRIKMALRAEjdMwZ9BeymCP1pOVtxkc4ImXGPJwdUOagvEK7/gyVZqYng6VmhP1HJCTFA3SIHkyWwJkCl5knD3qF6kmj6FCjV6QcbKjdQrBdd5ZQcAmAdhYHd/oEimniFfUblNTHfeiaQYCTnekEemUQKhEoEeCABfihAChACSABGfgkejjCDADcFhZowjHcr0AmfhEAxE0dez6FMSxDM6injq4nZ0bGe5ZEA1jIJmwB14UEMk3GRYbdqM3f6jWSfyaDEE6DQgTAS7KoCUkiwazTINCbvfFIvg3Ac7BYe/FEYzoeLEqEDoAAdP6hYzgGA5SAEXgBGTCCiaYEJYzBEbQUn1lpsr0ReMIoSRDADCRZhxQDeu4ooh5Vj0YGICRFkAII/iBM1hduTHFp2yucXvyF5Q82Ilk8omiQCE3yKQmtJbT8jXv4ppQcRBqEE49Yn4oRxC2w40782juSxIrmRBXYAAfwI44JQAIoAAMwAE7KylCKKqIJAaCCZ3hEgBQMjoV8X6JGq6JypnQhRqOWxAFYxiaEAbflpHA5AH982y7lZzK4ZlU9aZQWiSc+y4Iaq0QM2Jk6S1t2FN91Ei3gnY90kUwKZU+4o+PFnE/wAApcQEv92cagAML1lbv61j0pKztBDwvsgYVIK8US1aIuhh74o2Ss37CORAY4q7hmV6YiDSMKQCoUpFiA5DQgkF4uLPWUTYIuyxOOVVnFWXDyCFIQ/p9BwFhP1Nn1BQCB+gQR3EAIaIADEEB7oBABXIAluqyrfafDulQAFBhqkl8rVCzWChMzXuxW5EFSEIBiiJ7ThAcM2OfHeVl+dl40lqzrjYWnTkMWNKDTFkW78sgTAqyzMNwAwOWDckTL1kcCPsfOISeu9uPfFgURBAEP8IAOBEHQzm2iiZWRJavGIEsAEAAMSIJkvMLVZq3n6hHXKsahlMQAGAbH5gcPbd5qjtoDVAx/Ks2TIlHsiYZbxSzk9o31NSGqcNRCOMAioOpz1Bvx/IhyCsAVGgRGXOhOFO/yvShH2O7tFsdeIVvxgmjUronl3kgKEKpidO7nfu9zxUmN/qqLHSjFVrTCHiRjfhBAHujM+GYOzqyudiGOD54rp4aYvqBCxcBV9BZMElIRjZkKBPpOFI7NWS1E4NUHKB6EmOKtTuzeTfbv7ZYNr2Jv1FruR0wAUyYG+Hbw+bwvl51LUmSFJjSBvyaF5T7Aoy2k/GpYyYnl/aKcvkRiEUow33Qj4UpE3QoHFR1AG+CHDzgodKBCe+ypjxRJOh7ELXwKFfhEmaKw3Njw3BLBjVhvrSorA2xIYXgwF4/P1oYuVlBOSXyxK6Cv+o6H5XoAyLpgC2vXC79mDIdFVokGNRwAsoSqFHdNOFJhqqwTH0wDL2DQCfTcc0xhPvLIe0HHgAXw/k1gjAWvCSPncYFCpw1eb8NBQKVORhdvMuOAsIW1T1IcIlRE5ERirwyYLXRtjpK6MEduqsl2hspOA5rFqyTv5kimSntwADWIRjSsDgKI0nOMV+KRiV2qzUGgGV36RC2uVD3tcC3HB0eNAOXSoiWPxAZwL1ZwsjbTjCcnU1R0cyCVhCjrQQoAC/RcDuZ0s7TlZ/0+lH/Cnv8kL/Q+M8FwFarAzSyQBjWMmDWxlUGE1LuRCQJJzHMccCX5BNwQHf/SM4vGWQN0WjUT3QhobjZvs0WHizpfVziTBLSNZrFlTAG0rzeLb2Vg6sip7evSyzvH8jqeJUOTDFK0Gprsnhac/sYh4IcNvOruPa7dZgR02Jry7sQAN9xLW6n1bXRJTHNEOxwLvEkLtiBUXLRUe0tGX1YTKIUZaKXGQEAkVLX37ODI7SfbTlMSUUN74HFRQwu8ogpSIAA0xEYuIMCnaEC9iilDmMnUgOlzFKABAMUTTy5apzVJIgUXWPFSn6IUQFgr/MdUNzbkiOuF0ECv5pgHQBsYiyxrLgM0pnSlxPFXnN3sjsZwOqBgD0ydHTSarM4gnAg0oNlbGcIunAwfk4mrBu+nJHBO2ORcaRBplzZfObNPFEkTZNlhb9DTBQAE6EErLHZUOLZz60kugrFWLFXD0QAZc2b3fRniaKr9vjKm/mRKEk0DhC60b6sKAs12mcwcR9zKiVDDqlrT6uD2j3BEvR7EIgPFGpJ3eaOhI6cAKK+hUlPzmsyAKL/Ccx94hFCFYXk14VA3SAT4R5yzdGcOO5Ns/ZksyppdBjiG/0wDNLSHTO/3qeSaA5MJ71qTIaDIIZwwapvJ8EGHDSiEEfNEwypfFLNRFYDAjIt4kBilAHB19vxp1DKAHZSxKyA4kjvIdU/4VGj1bh8AVzJ5G0eV6vHCWLPIBXB4aUzNPPM4bWNpmUzocX6EEEjDiQivNR1ykFDRnD1HSnX5TcxswwWA7hrQB+Cel5eJjS1ELLSugNu4OUN45QbABCS5oTMI/pMTRjnnGFczOAtNOUO1MzS98xyTBi9oEd8AN3Ajmj2XCYlcQC4MAgLc2AVYuWwI812byoCd1EG4FXrzxAkDWzpFUXBBT2DnOY+4kgBEgkHtdnErxaEHu1+4byGdsUuNgChLOTu3clW1HlmrXGk48q3u96YXB8PVeY+o9trQwglo0B+fRjQghX6XyYD580Ho70KoeU4kdMBNewlVwe3dI64HCcMBwuj+OlIKu77jRaJvRSW7VIX1+1MYTvyh9JVDkpaXRktX0byfCcPdOo8UmQDkgJTAwUesQDSYBnsJQJWiiVwl8UHswm0DRYY2XImTkJgnc8PzCHTmwSagMdEJ/vqfl8S+1/xcCDwujW0ZabGUR8UqcxbHrW1HenY1RumW49zKk8nDl0nxOgAhD8QhyK4WngJp2HUOm0mdUTx0zFhQxLqRqTsBqUE3AlnS18eAccEr+LmN4HvD2bzbj4vAY0V/5aTcJECUx/1TgLWGtSazgxbRl0WllwY0iDvYz221+8jakUkI3FibK/HGC4AWmLk0UFFfp0rZoECSoI3KB/f10XIJ0U4AfGPfTG+B5kq6OLivsz3Nvz3ro8VlVbVnTaqWUEAObi6X6f38LgN3PxRsvh41mYYscMQC8HTZJ0eGFn585BSy6ADwJAkfuCMH6IJxCkCxnkmcEfRz8Jo3/gbFzsl8Uoi+E8UKsqxr8SNHkSCTGAOb9zev3LT+2zt6Qn00oAMaspBAsssJzsDCnOxhhWT3lxk8QEwTOJBgQYMDGwgQkCpZQ4cPG2ZQSOugQD4KBRwQgoZjR48fQYYUOZJkSZMnUaZUuZJlS5cnQyh08JImGgQBAjiYpYtnT588UWHAaADjhZpHQ/JQiOCnz0FLWx7AOJVqVatXqRZAupVrSQdQu4YVO7YrHLJnQ2pQyMSVJKxv4VYNIDduXQFz7eadCoBvX79/AQcWPJhwYcOHESdWvJhxY8ePIUeWPHmyK8uXMWfWvJlzZ8+fQWt+FZo0ZqJ6rQZYUpq151ev/kjBbj2bNuhXviDm1r2bN0QICm9VFF4x4cLeyZZJFEBR+ByFAQjoGFulChEhRKxnR0O9Clrv38GjJYIxRPiPKJ4Parp+V64hVAdcMZ9SiMICudbrooWx+0r0qAHEaD6a1NgqCIxwGFDBBRls0CO1BJDClVYGCNDCCzHMkLINOezQww9BDFHEEUkULJbaUExRxRUzIyDDAexgkbXYYnNlNBlTvLE0WI7r0ceHigtuuCERUoih3pKbaEhBpkKBpiBAqOCAAiqkCie4CijggAMQQMCBCiq44AINNAjhBBRQ4CCEG24IAjsH4YxTJAvs62++8RTSIb89BTlNgBrkBKkK/oxu2RMBhYJgqQo/M4wL0LEKDPQjCA2Q1NJLMR1JKAG2sGyCRkG1C6/UQq2qxFNRTVXVVVltVbJWcIxV1lldyTABSHSkdbPXXtPVV8x4/FHY3r4SQEgihyzuyN4uUHLIU/y8gAiQVrDAyZE0GPWqK+2qMq4BBsAJpwEKcMCBMUEIYQUb2rxOvkzhdSkmhR4d8FABHCh0z/UMwaiCeDE6ZU8IV1D03lK3xSBesoio8tqFIY6YpUhZumCuTl1h4S1tEe7YY6pcDVnkkUku2eTCfk1Z5c8wzICTlWfLFebWXhvWZt0cmOtYZIVTdhkkmxVAFmRzCVoAAurd7i4BBghh/iOPbpCK222vFPfCqTHCGq4BDPCyAgxAQLOGG3i4zk6JLV2hqAX/E0C9fZu6pQKw4C1AoUP2PFAAEFqq4WOrDkC7KxAUMuBswRFP/KW5BQhjNCn+jhw1ji082fLLMc9c88Zm7lzlUS6EwRTPSU/55tMdKnZnng9S9rhlPhWaZ2lymMoB6Ti6aaoDwMbgYHxXaNNNIg73iHjqsBOChyB00OEGG2rAYQU0QwjhAw0usIDRu0b1ttECvLSAzBBQCF4HN4tXvKt5M0rfuyCq9AHu9d5DdOF7BdmzDZlckpwq9WvSMIUUDIAFNOBIikUHy+QhQJTz3wPjsjkJTpCCFXRV/ulihsHObMJKdmECrEons9D0SoOieQXqUAcBnKyOdQVxHZKUwxyeGUIq/pJOFUDgPauUR0E1KBZ8QFADFIAAAxdAwAF02Chucc1rGFBT+XJwPiG474AdIQKdljKtAVXhXvman0920S+FnABixYLDnsRYqZb80H88qCJLCCcABLyRjgasoR4sEwkI7vFqdbHgHwEZSEFyroSFRBEnJjcABWrwFaYQoWccaUjMvAYZKLxZA1bYwp4Z6XUx1GQ0fLA0mdhgOzhgY1GexiAhfMBuVDnACuYgBz7IgZZygEOBqjAEHdgABSHgwAUcgET4lGouW/oSBspUvhpIUYtoc0II/lopx2bOZ1MDMMQuvtgTudEtXptSw572oxAqkuQGe+RAHVOCJwEkCJ3tRFuVIHGZJALIgRaqJx/fMkh97pOfgHykJAHKGU2gpgHxJM1rSIEi2PAqkqVBKAkDapljWNJmQdIkcTgJQ2dp8hYtcCU7iSDEdNVgmgu6AeOw4gAh1JKlsmwpS/kQBzaooQpC0EEOpscBDEgAAdEUVV26Z4ADfKkCGuBA2FYwtiBcp6RkqakPaiBSDNSQe0ZZEA6egwZsZlMXu6iPQlIZLwhVYV/3wh1L9jhHd5oEQoFb61vhVaVIXAYCSbwnPvFKF5D1k6999avI/hnRXwXWM27Ji8tY/sOr2sAiNoolrAkhKlhjUHRYDwDORVuXUd4sI2gyvKgsXAAfFIxzPjzQQJXwMoAcaOF3ChnAOV8aW9m+dJa0lCkubXoDFJyAiBXoEvcwdNe5DGBLCzgmmY6arhCkq5fVSxeZyIQBMAUTAXZF7XOQxiABCiAEXO2JGAVAxoj9xwZ72sUJBugSLD4QriTZbtLaG18HYWQTl9FYXu86lfzm9a/99e9/PySjx15mwILljGHrIoOEtgYWBd5Vg2FRGxo5mHTFoKyPfpYzY2HWIC/crCc5LJBd1A8jAwBBWHt4SgFoYA7PEAg1TpGDJCKgBnGo7WxxnOMcxwEObEADDlor/oAGSMABBNgvULHCsSPHpQE+WBAXFXIAWnhXF7MollojpjYBoGBfVFCIBlyitwfCV74cgRCWy1xFigVKnSB0RQ/yGmdiApjOdbYzYiRJYYBCwi5ScHNnRFgj2ix0wTF7RYM5o2daWfjCr1uGhlmIWQ/vJknLCTFBikMVC7hxPkPIoSup4FmCRIMPRpvKBaqgY1WvuqU3RgOEptKCQgjjF7VIhSUI4Qc3vEELTtiBCzqQgWBS7chLZloDNKCCHDghCzJQwFQ4QFqxxFEA+aNy7ZiG4niVUwAY2Bcc+OeS7f3NrWnuyFcFkChzrxs8oTwaZrYg5+A2sFR3tve972xg/n1rRg91acJBM7PQQkZY37hpdI9+s+FLC2TSulmGBBQytIVPo1hDOOUCyDwWHZhaITZYhDSQJYshJNEAKIADq1GOcjWsYHsQWIMtfuYjWtdiFZm4RCH8gAc3rCELPXeCE4ZgBSf84Ac/d4IWep6FNLjhDn4gBCIykYpa/KKSuhEGiTNyA/NwWwBU2CpXmaSQh0VMB0vZ1yEK95JNPVDd7lwzSIoFZnbP/Sw3wAkEMMPAn8qb76bC998Bz9d9D/4ye6gLW2wzuoArWlay0XewDt4bTCp84Q3XTewkXnmFYKIZf1AOdlHQVKRcYQWtNUAanHFRaQwCvVWpABFSHnsd/seBByrOwBssgYyY/4gZzNj9Q5YR/N//7PcNKT6lk5EJWAtAWt/ZLgbw491ZdBFxXzXAvm6BESq4BN1KfItV2c3t+NCd/GHBAU5GgBkE9x1h+1UyagIff/n/8USE3zcdDv/nxNq/hJCP/G5UiPIuzfKALxlAbOGKRRWMzxI8aolAQPRcogpQQIcyYBBA7tJ2IQ2qCz5CoA1k7wNlCw0+LWuYJgOcYBUoK/iMzyGO73SQ4Q3CxbUI6CwYpwAEZn6+The0bAAgUEHeTiQGBTj2ZQHyxCWWT3IGgPxOY+wWxCzKz4DQKwBgADNGwdgkxwrZTwDmbwu58HL47/4Or5AY/u8L/e//csOiJo4AWbDSRI3DEhAiakELXGQqMKAHUYIIRhAjbAAVJo4gYAx+qgIBdAAECZGl4EAHVIxp/sCShMES7sAJVAACGuAAIEAF3mAYWnBYlqEWPAojEKDtwoLa4oDKdAHc0itxMAIV9uU/mPAkamDcJGcG121e0OwJbbElCEc1WiQL9ctjsNAuujAYhbFVYmEMY8UYSygM6mI1aKahvjDRdIVXzJA3VKcP72VZeCNoMu/SEvD4hmENqEohMGAIWkIITmt32MDF+vAgoiEOOI5pQMADC7EQ4cAGNKAAxCUABgAXMpEFje9nasENXGCeMOIAFrEff2QZ/CAc/vkmLPwmT0iRFk7jXxTnNPBmT6iAKBQmJYIgyB6oFtMM3UDxFkkSJSxGALogMxKOF33xF4FxGGEyJkXkGQ1MGeOCGWkGGWmyNhZqGnejGtNQsygtdtoQs4oFE3ij8ziOA+zwI3iA4xyADy5wHYWDGmSBCpLIAVJtHueRDYTgJgbgBxASOX5GGO6AA/RiB4QBOShqGH5gd0hpK4SgSjBAX7wrjnhQffBnX5xDjlCCCjxyj5ryrbCoIUvyME2iWGIEMzyAJT9GW1wyn2RyMilTMnRyJ2Ul3kjQKnoAM/mvV6rOJx8iZwIg0i5KDVlQG/vwDXmDGZTBD5RjXHiIJIIA/qUU4gIGgRqoknWgodSeoyBrjCsLsX44gNJ+RhmUIRWAwMi05QAuAAWCQAs6wgaoKgN+YSx/xBI+j/kG0ySqoIYOQBZy8IvQACO0Tn2wiA/25RQEpCQ6Ehb56JzmTsvKDTHtMyRqCBAyAwYiJzIdEy4CoDIFdEAT4zI90zIuswvqggYO1KFIh1dCUzQbAtL6EDWNTzm2McSOsjeYwfgCoVlSSxY9Qghsc28UQTd386JoYQd0aABQQDhBsDwFAAIcTvgsQQXw4koqAFBo6cZqCQ7W7gJ+odGaYQ28ZQBEdCWqgHGsicp24RDosoAY55v2ZBZOY/tEoiOzsD7NLQgF/uCs3MkJ7/MonkMTMmMJ5M0/ialRCLRN3fQvMMhAC4kJFrRB+W+iJNQh0FDzjEOjLG3ijrL4em9QBzUZlOEOvgIvBNF41k7s+DBFLy0a5uCUVAtGY++rOoDSAuEIDWAF2EDV+MAGMAICauHgbAFHMcIBRjIl1o4NSPEWrkzaxEohqABuGOc8zyMc2a873QmL5G5MgZUIxkX/NLM/teY/NeRNlZVA7bSQmiDBmpXwJitPGyLhTFOTigUbHa6zVlMhFBAiCJVQjU8Y3iAcLQA7jvAEihJSOWwRWq/ETM5SV631fgD4go8QjvAChiD2yk4hMmAYDm4Z/qCG5uJXU6Jt/nKAFHWhXwWA0wAoBOYiYVdR7DwCh+CT71qxK34wULBKANQIWMe07AZgATTDJo11ydT0b/ZrWVmWMqNVg+AsLqbwZfWN0ah18q61hWpIW3Oj0jLUDTcvN8K1UB2CGX7hLbFCA06BXSGVFx5yd8hIXnHsNPwA+PD1NwUAtj5QKe5CBZQhYIcBCETpADJOJJ4WBaLPuy5CIWYTgFZgLk4AboJwI2sTWVOV7rzUYUEWMR/SA/jNbgEXK1p2cGGSZksnZuGCBQzXwGxWQpfBsgRQQ4XS4YiyWwXgWx9iaHtPaFPhXYtiEZg2dGmhA6xiAC5gEKWWpYJwANYSOfDVagSg/gM+tRBFFSd2ADuFJfgy4SQV4vVMgmErwC65ChVOYyYOSFRXDG7WFgFQIDB5UR/J714ydm9t8QMUQgY0Y/0Cd3sVgnC9dwsbS6EWtzVk4FipQnHHN2UozOColUKDsk97A0MtVxVUsGiJFkkCgVG0ABpCt38VAduswgAuwAbk0aW4svV2QBkwQQtOKQTUAEbZ5w3qt9GU4Q2MjDxIggeqBAFU0UnRkmlkFWK4linWs3C4FyO0rcxQYC4oknoPc1MkJDM4wXxP+D+/94YBL307BwbyKwBSQIcBin3zFGcrdHJ14wC50VvZ0n43t0c2sVEdwBD6t3+hwRCEQFenYgAc/qBghJNxhIkqQOCB5XXtLAF3baYWQktRwfTcTuMAFkFhvRRXL2VjR0II5uL69iUXLtZu29bcxCyEXbjM7mWRqFCUanhy+AiHFdneDFdOW+O+kiwA0k8MgbhxJVSFSrOI4XcoNyqJBQApL8wPGOUEcmGKp3gW2uAEkqhKBgABbKAQO7EqQGB2pRYOikUBcMEMf4YQiqVgz0YITqMA3obKDKFKDNaAvFR416NRT9h4565K5DiQn7BKJGEz+i5lHXORtRnACg2If2UEAFSSVSawXkPxFvcVppVak2FPB9CIIYKzOllyL/fgkMEKqGJ/TXmKoeEU2GACr6IA4gAE4cDU/i4gCAI6dXtUDSokADrga3VZGLQgXOaiAAgImF1LDhR2FrAIAQA5YjBiyvYFeQ+ZS81tUwxTmstPWBViFDYjAQ75gdxPMrd5pv3KRrz5VxpzWzDCb2WksYxRsQ70NXwhndU5GUgzZ1nHZ45DNQE1aCPvF0i3IHMzn01ZGmYhDnJAVx2gEH1MjFXNLLrDgFMO3bTAjE9nFTogRx3gFV1LPUlxF2ogBlfVgCwSbtRgeymH/NSmlVHaFm+gQh6AMyD3pbeXpg27r7r5pmNlA+piA3CEVxL7M0iIFBjLcy6TV3whQovaqDPpfXn2nZFYnjE3YBMh08KrlKk6n6lhFwTh/l1pGaHlIAccYJ5eNPb+YwAswXHvAIsFwK1J0RQDYHoLaC/3RQ4IWwDID936mizo+FJWWADQVzOO8Ljt6W8O+7r7yaYji8ACypFRZDuxwrEFjFcO7aB4BdFEg/DQebNx5rI8+3WYGgGdOvKIz56nIg2mMrWnOBpOIwRgewUIMotXKuWKpQEAVkKHYQewBgVA2rsUYSLpqDuCYL1GsYQJm1fdqUr0drnX7QPmAiczA5xhmrorB7tNXJ/0z7sXdyXfIgOOkbEEDjR8WtC+8NDwlL1zI+F4QZM/G/jkt6k/WUKh2nYOQb/zeYSlFg14+y1AIOUUuuPUeRFMLQAQwNqy/ukWgsYAMHxhbMACdIhK92WPkXWuy4xxhJvD28vLG4czIJnEVbYX8+LE5XyQJmQ0VNxwH0C4BCACJNsZFduhfKEZcJw32DnEdvZ1KhfIR9snCSEcW8AajLx/n0IhLPWvYZdpOIAKBAEVbiEXaEEOoNhHdYxh+2CCfRIZjBS4BGAH0hZuGDaaE+cKmhcrahVuPviQy1a+/mMj0Xzd4IkzZADJCPvS8WnOjT2QbPrPZ0MB9gvvXGO7LYPG969BYYGoB71nrdVye/whQhtogzxPkfMHvMUA2iC/I50qd0FAuHICYddF40CZfYINpgIBUq6thpRamYETtcUBLpInxpMn/vqSuwBICECAt6dGYveFYWuYnebuIUGy19sLTwZA/y7jWb0PglCWhv3n2Dn+jxBU2UfoFS4YLgL72SubwA5tDFW+kHzhxq9dN5RhGYj4vZdaIR5Vvr9dnWthOy/g5s99HaWhSnIABGcJwLkHJyxADRr87A7mAFAODk6jBcyasggBk1KrCnKh1X1CEVrJmdHmCnSgAgK8KrjMrgmb4dmNa5MQ4kFCTNHpISegMxSUVNwca30RLjo+7yuI4sdZ31ph5N+i5DvDpzGDsmtEzxppJ1+hGDT75XMj5gMQqXnGQpHjx3F+0an1DxjFB6Lh56lSOTQABOM6awLgA+RA6+EG/hUOpgJQDt3wgL2FAQuoggOWvieKxj623EGqAAfWSy80YH4mHdfLDyPIEVPcnu2RIo6wlzOKNVQ0Hp+w+UL0fvonaPDu3DOOTAE+o8EiC71nBKgjarsPzdodX/J0hsfhO+IsF5Rhfwd2RxBQ1PMvDdu2Ova4tkn6ncpO4WCanNUo5ToBIpnAgQQLGjyIkOAqDQIaChjQRpfEiTkCNNSBJqPGjRw7evwIMiRHIRoOODyJMuXJCrsmunSJSqXMmTRr2lR5Q6TOnTx7+tSJoGHOn0SLGj2KNKnSpTsdNOTiKqpUqVxuWm0YIKvFq1y7ev16ciuAsWTLmj2LNq3atWzb/rp9Czeu3Ll069q9izev3rqtpvr9Cziw4MGECxsOTCrlVpQKCJN6RQrW1MeHp766TKqy5s1/IUt95etYwtGkS5s+CKHhrWmsW7t+Ddt1g4apSC/L0JBW7N28pzkVgOm0cOGpfjdEkau38uXMm+9m09CAHDl8plu/jh1N0JMrDr38Dv7lKQMOdWA/fx0OeQEulg1/j3DZn/UNV8iaOMdhCKb8ORL5QB9Y0YX3UoACHsjVUP0tyOBGFhzXYIQSTkhhhRkN0BAksQQWBoKKLeZhiCJ6tVeJJp6IYooqrshiiy6aFdUrnM1IY42EbWIVATNedplmPMpoY5CCyfhKMfAd/okkQrMJsJpzvC1Z22jLSJCbk7z9FlySWgrkBoYOaSGNlWKOuZwgDqGHphwVOJTVCYe0RGCcLxnipQBqpHmeEA4VsuWRywjjApsNCKLLIgQ05ICFRtVg0ohMyqkLCI5OmpKCil66E0MCgIBpp55+WiERW40imBl1UooqTVuBmKpNL74Ka6yyzkprrXp9JmSuug7GSY47vmIKkJW9Aktmfgm762bEGtNns/D91iSZrUEp5W1VStvab6o4m+QvHZx0ASrYjkvmKQ7Bgad1K6BUgSBwQgqvLvk1NEAc6V6HQUMLCMPtcMsgcsBiQjgVgAFEgCqSDaeOiAqkQbRKKUYI/k+MBgoNYUBxxhpv/BEODUEw2B4Qj0zygbaejHLKKq/MMlytIJtszEJqYtUAMg8GGcw3++gLMv3+XBoEFkWLLZTuJXSbRbqRq60yQMNXSIA+RENu1c3tstWdafKhRoAHsKHLu/HC+3BDCGyNHRteWrFM20+TpswOrAYQBMcb5ZvqIpBCV3KIPNjdaQ1mA064xmogzFAANAymR1esovR435LL9HgALV+Oeeaab66XsTrvDPpgkVwVOmCwfF46YJcZ+XbrBi0wdNXUSnmB0lVj6fpwzQBxkgGCUGN18LtB45AQacZh8Uk+zCL22PDmoukANdxr3Q0OrZLM0bkXxAwz/pgsgBIKhJ8A8SCQGjI5gnUXbqEODR3AfvzyNwh+AHYMBkj6+u/fEOf+/w/AAGbOFa/oC2dQl7rKSIJ0CWygYS4Tmu1JMBkOyArRpDU7pOFGALK4XUOyNMHSFOckKNiF8E7omvW0AE1oaNSXnBeeXMiJFi5kA/Wms6QQaC+EyejeMpTBOwFoxQFCsNvI4gApWkguclw52PwkVDYDPHGKVCRKFRwSicDIaIEzYSL/vggWAYpxjGQso4oIiMDUpbFGkLiKAR0Ix2OBhocSFFoAeFG17URJgw3pINMasi06luYNdRoAG8KEQuFpigPowVt0zCZDGEqSDw4pwA3lgAaH/gRCkD1kxtFW4QQXCkADVdCYniCmBnhtB4xWcWIV+0MEh7xylrTsiPsE0BgtvmJ0rHRcL69ixmAKc5jEVAsBjxnHm+XPKm90II+MtTNhEasYPuOk66AlO9rYJgO2+yNwrEmaX5DPIRc4RSKDlwNEYacKpwrCLhpVBUnKM51CDMElOWARB/ALnAJZxjB8kJWGEKAGGStbq6gAr3H+sia15E8sG9LQiL5ynCwgDM0WykovCqiYHO2oRwUYizUm8zAwy8NVNpHMyBArdD2KID+vqRoPCmCP8bnAtcaFu5cmhBBSo9o5x6WFhljSOiFYiSJYEwd60UKeMLyFcWxIvTYM/iAra8ieTpORCU0hqogIuyLEciCnllABo10MgESX4pBSnnWt7PtNFwjTK7LKFUEfratd76qyDY00WSKzCkrj+EzQQbCaVwWaMpaxpAuSqVE0PYi1OCjTQBbWIM3YwUkOIIifYstMQpyOGkSpBWi0hhprEoAOmArDQTjkAJesAYYGUIsd8rMZbggQCNT6KQNNCgXwasNcVWJWth7FIa4UrnEz5hBAWPS3zP0KXp8L3ei2aK+6osNVOJFSHu0MFsyabe5+uIzUMEmmjTXIY5eGU0BONiGrMI4ATmBCzYqJFw5Rwy0R5UfXoK8h3kHt2ASXlRtcslE2WG8ycGHZrRQA/gegOmWqPgCpXRyiuWE5blEK0JAhWHjDoLqlAQbTihBTeMQ2sZx0T4zi/2XmZDESKXUB0yGraCKZPbpZz3iojMMaoxi+OF1UfCHBCgZAsWPKYEI2iF5sacvACFHGGgp5SPk6SRpeEqUPRAsbahRVALz1b7xo6BB7Ue+hAkCE2yZrCZs6xAHr61QVVjkpB8DrFiR+CId9EpQB4PbOfKZQCDCUAsMsrLkaZW6KD41ollnGM66Y1Rtd/OKoxPgmMwYspEkKi2I4bXvKQMaOe6xLwrauguMll5Edi+TIMjkhv9hyQ8opZeckb7WH6I0sHNLfGHp5Ir599SVtOoAMHHa9/sug7XoswoHiXkoIpXXUAeLlXuZKsc86IYnEqI1t+mEIKoXRbZ2XaLJEi3vcssKZsGBV40gXZgtXqbS6DygjXzBr086itzKOYQxf+CLdhRFN7khNZDGd+iDcFECSpYWlYa/6IIQ4lEOmFuvlTNghGtDFclrQkBbs+nmSgugN0+CQO8j2qsv4RYLptQKECQEEokTQLeA1a0oV+irwy7bNb64odmZFEoZRAFiYOPNvi4jcRC/6GYclrFawCJqCDRK7rZLFdx/QpT87xjH0LRkiXToq/oZpqcc1cIMU/OBkSvjIF549ZATxfb+LeG+0MIADaAF4y1FiQxSxcUgpwktn/rth8hwg6sm2DRNaFcABbEAxIYQAAYPmylIhNdYS1yToAkIAzi+PeQbdICu5LMwDmEv5Sc28cjMxuulPjxchySgWpEDRy4gk9alI4So8H9LWgwQsZBFrpTHKdOCFQ++B4Fvf2s1Vd133gNiZmjZnH8gy1JxfJasX7aMZoUNOkBy370YaWG7OOMGa9zjtIvICCMIN4YChALih+SS/Q8DW3GaK1eACLZ+53iCV1BFXgMOHy7z/JfQBDQEDLjYBQlcyWhF6NYF6C8iAb6F6aBQjrrAhJYJGt1c6TXAVkDAYwaI60aR7j2Es3LUl98ZjpwMkFlgYrHNNygd22iQlBQhZ/t4kWdQXH4TkEAMAJtpHLopAL6cQfgSyC7OwHgNwSR4TAA2wT2g3DE5wKhigbBQTBCCwAFPFJjJhPpCyCFeRgJPHFRrwf1/4E3Dgf41yP4axQQb4FZFTORaxhaXXgG8Ih2TRdDHSF7GAF830bkuQgSjYQCr1CsTwe6bhaSUIM3z4QCo4aixYNC7IRwYnUyBEg/ExDAolAA5QazqILXjjTj8YHruQSQ1hA+e3Hm/AfpNlC4FyErdVOCtAf0zEB3NGYikHhrNIix5hUH9VGB5wgGg4InHoiw2oVyz1GcgyF7EXFTRwFYDAb8bII4hIGp5GDD1miLkCZLmTfF+3iDO1/k03JX0CMIORaF5tUwiilAPPgIlkMnEDcB+c+B27kAuNQoTUwwdGeABJSIOWwAGXJT7xIwQoUAFwVgNtwAeDcAiLQAuz8HIv0WxaiAAoQATRhipcVYtI0X8TuVYoYBEaUBkjwIto+IsfaXp4GDOX1gqxYIdrYYyuIANXoQeqhzrT6AqP8QpdZxDDt28wGTPV6DriFXBWEnYEcV6PyGTdQ5Td00lFaZTO9wMBJQAGMAd0d47OQQ1qhlDsCB58IwA4UB33EgcYJgBpAI79RAhUcoP7OD+FhxUgggAOgAEcgAJwhhKnUgAVEALxB5GUYpF5OYu/sQWVwQIdOSJtSCIg/kmY4xZ7WjcVSlcWKbmSVtGSD6g604gZ1YgMyFAM0SgZyJSSrqCTb6MMiZVN2kg73Ihw07deSImaSAmUyWAL4tUQHdCTURkbnIUAzWOVunALD9IQl7R5TTkMYSkQzfAGonQADCY/MfcQTJkSp2IABTAABnAA0WkBKCCRHbGQqGJ5eqmdmOcEW1F7htGYXySYBliY5Ylom4megvGXVpEHhcFoWmQKiFF88GaCxYKTDgQLrpNjPBma5VUQQelNmFCKnJSaBcoMBNE9h1VbJ0EF3SebvUFlDdEHkBJJXpZ/pnVJ66EFwDkQw6AFDvc+iBc/KIABF/CPCFAABVBoHFAU/hajnF30FbK4nTOabTVgEQ2gGT0wYuOJUebpoycWjOkppK6QAlfRnra3jEj3ngcULD8ypJaRn62TY6C5fKLZiGQ3Jjl1mgaKmghKlMkwDDFniQ+6HJG3Arf5HbnwG/FIPdYjAARgj2FZckx4EghgKVNUBUQgBEGgAzdgAyiAAieAAldgFDyAAiEAAokKAhqAAY16ASZaARXgAA5gAQvgAAiAqQgQnQdgAM2ZogYgozQqqnxWWj2gGUwAmJPDowLwo636XE/6pBxpFXvAUjljI5hhgrAqFVHqOlTaglZaU30klAbGpcX6pQKRCKJkA85AprwxCw7xeGg6EVhZBefX/ihvwKEFUQs/cCp2umejCq4d8YThymdX4CWPeRhPl6pcsarh5qrv2lG6KqQbcBV0EDrF4mM18iNLCljKsj3YVKX+CZQwGH2l6Y1DaazFShDNYAUnMQBpgEjN+hr5KABaIK0uMQuN0nfUYwOI0gwDSn240LB1ugLfSq6jKikIYLIn6ykV2SA2iksiORiTNjLtKnSr4hDwqrPFdJ/yKjMUcBVmgDMxCXsHlCukAIIo2LP++m+KiEGM6FgAml4HS6wJy6UGYQtq9mpHJbGuQUkCgAAX6xIOJmb3gn4N4QcgS4OrQE8OgQChyrJP5LKd0ijxF7cWVjsCIAObYQbr2ktB/rezgRtMPouermkTQoukxMJ0gHU6+aqrr/CvMRWw1ZJqAYqwVlugCHEHIMoe1tC1rCEN6yEHYisRWXgclzROJ6C2kbgKPIASB2CWd6udXlKdsmtc57oZJuW3rWKz/SO4vytGlyGzhLtXn3cTARAGxEu82yM02CgtemQb0BdZOZatSCIMlnWDUda1Zkq6EoE3rHVDnygAtlC9CVELTkAATDkAITCutvuFxOW+x9WxMbsZbbQ/vUs5cgW8+wtA86m8L7YkMCpEyfu/kQZpwfc0sOO8ZPKTzle5U6sKZ1a+8LEKWmt4fACVD3prTVmhFwtyu3lJpZUFExwfv2AFnDtK/rUbv5nnVQLQvqIqhhamm4uzGbxUZ224qvjLvzu8OQUsdd4mE9x2q4srpEt7GIHYL/w5uaQhvTJIwkkiHwEiAYbQrNTQABYxuu3IjjzYEDxwSfSUAU9sXt3zC1jQchBwpyuMc2Smxv0xt5dyBQ6BrpVxUburhfrDw3l8OUa8K3y8M42nEgPQl/rqvz58M0jMLb6ajQLrfASramJ8JMqwO014CBmMiVRgETagxey4C9uBAZcEBw7xm5DcT1+KDG5guAGAAMbZxjfnYK18VusiADjKGTgiepBjx+6qx7t8Mpfmx4bsClwxyLf6y8DMdbkDO0PWn9voiE5MykjyCyqQ/pYCcAFxYI7nGBNNmZDs2MG7kDzge0PbYWbPfBDKQAjf4rDJBsvYVjYFsM4RpcBMQCOAnMu8yxW8jM+1YszU1QpcIc81IpPFPCTySpNPY0ex6Ry/wcj9pGZYKiZaSs7+kgy1EAIvygFpoDcROw3QkAuGoAU+ANI+MARaIJCCcAiKIAsy9AwarRzU0CjuElYb5wMCdUlt0CiJsLoT3DaZML9YIQAVIKLvvGFlU3NC/UpDwIZRxxk+h1E4PFesks9RHSu39zL7LCSj4M82gq+eI9D/W9D90jaKLC2MxcwFW3YfhMARfRptYwvoHMjRSc82cQAQoAEo4AI+QAVpMAd9/jAIikALvKALM21azdMS72Kb8bILiZ3YGPcQRKAGc0Ad2FEdcYAGNbAeBjDKao2gA4ELoVSFB3ACL2zUtHRLRZ0Ub7wgqN3KW5YBNQKDaVjPvnTPUk3bLXJ7SWrVm2HLVvHPNOKkrsCBuS0kxwc0baPEU7vQ2QODDm0lTZPTmt1P2fMLP9By9KI/DkDXHKACNZADQUAFVZAGbRAHcSAI02EIg2AIBbkIBokKqLDei3DefDAHacADJyBKAWUACFABbQkCJQqRfwDd3HOgA4EMd3CG5PQ3o31Wt5SdCj5FJhEAQswZsgox+IsqFk4Tta3hRyfcDhRXx9sEHZ6Szgg0/kKGR0s8Ghtk1ln6QQGuJctQC1qgAQkgEwfAAT/wA0AABC6gAh2QARXQAApAAHXChmCEgCFyAJvk4qWRCTtAhavFvg5eS27a4FIeP70pALjIGTDwWxjeSxsO5iZitLrS1aljwyW2BCJujCT+M82L0M3RwAPxwN34jUsuHGfWNsKwCpmQCasgam6zQ+7RNnleC5lACHewBlaw4yewARLgAJw6AHFt3T/3okI0AECQAxtQ3WyiyirgBnFq56y2Bq65FQ7Aylb+RFSO6vJTOwFQUTWCjOAW21zIqmFu63hR5moeFWc+eWmur1ZdzJrmdW/OHHGu3KR51t8U6u8hWxIM/sXO13zuIQyY4AduoAVAYAM9ngEQ4AANYAAEMOQP4SX0PFWRHncOsAJZ8AvRnQy/oAqIQAh94AZ1cAeBkAi4sOzMvgyJoDDKOQAcYLerDjiqLvCEE0tZMcecMXu/NHo86tQhcusRXxe6nkD2axVJkJ65nkCd+TQA+6vJ/XzIzuJUm+/Pzi3OXi0o/9wC4TROczQgu/IlD+3u8Qt3oFVaUQAdoMIFTzFumig8bzdbBjI2UhUyF5hV2JESr/QuQ/Gps0xWQcO5ovHESwy5c8XKHLClGPIxOLWQKPNfD/b8lAqejRILEOVAL3+IgvYco6IBMMw0Yl3fphW8uPR1zxZN/p86jWMVAbC3eP9iHA80B73MUjLnBuv1YY/4iT9ByPAH0rwq+YQDor32EkLwkz8xHRsAA4BdNqL3sp0+lZ6/ZGX3o48WROz3u6K7VtH3txqfp88ZgH/yiCW5Hx+9wmq5io/7ub89v1AHFS1EPu0ADmn5isLgwz8x4iUDMMnrBgj64tlFpA/9Y+H6JLUZdEB5AQADLjn9PNM6xj37i1waKv7Iuk/+5V9vOfYLbnDgWHEAIbDzxs8UpQ3/n0JmGhgkWM2LCNj8XuHlKBH90A8QrgQOJFjQ4EGDrxAuZNjQ4UOIBs0IoFjR4kUBLCIefEXq1ceOID8iVBix5EaUKVH6/lKmLNlLmDFlzqQp00GAALem7eTZ0+fPng0opqoJc9kEirSALmU6zQFFVcuWFaVa1epVrFm1buXa1etXsGHFjiVLVdkqLTcxHggRBM1buHHlzqVb1+5dvHn17uXb1+/fuDooHkgD2PBhxIkVL2ZcVwNFBSoPEsBYuXIAy5k1X97c2fNn0JoDACBd2vRp1KlVr2bd2vVr2LFlz6Zd2/Zt3Ll1t451UvJv4MGFDwwTWuPvV7BEgvToezhw588fwipbU63Optl5qiVKdVmGpNrFPxWgKtnU6unVr2ff3v17+PBbnre1BvzFAAQu4LjS2P9/AANkjIfBBDTwQAQT/IuI/gEo4uI5CEKTMDTMJrTwQgwpGm03Djv08EMQQxRxRBJjk+5EFF2J7jkuQksBuuY8IkU5U14xJUUccxyIOvfIw068poQSoDuqLqBIFiCzI8+8+Jp08kkoo5RyyqJqueOEinDCbIAFQOBBQTDD5EsNMIOgyAAx01RzTcRCOLOV50TIcE4667SzsxLz1HNPPvv088/SSNFxUEIj2iK0EaCDZcblQCr00eB4bC9CAX5MEqgDBAiAyJq+C+/SpZakclRSSzX1VFSTwcUNFQao0CIDNKiBCDZrtfU/ISgagDEyb/VVzF4Ry1QAJqST4U5kk81S2cxeFQBQaKOVdlpq94T0/lpsXekiNA9I8ragkBLKdtzpXGqvAcwsBTWooapaxkgBlFr3J1FTtfdefPPVlypmmBEGESfUWouDGqr49WCE7yKiooQbdtg/HCraRLomPHOWWYwznrBajjv2+GOQSYuFoBXJNTklJkALoAOUSk7oxpNdxlZS9tCtdN6fhOSUJk/jxdkn8jDZd2iiiza6yX5jWuUNNy1rgAMdHpba1ioqMnhqrLPGSwGKZDixRY3xC3tsjC62LGS001Z7bQ5Pdlu6JVTeYKMaSZL57ZNpTk8qStXFWeeX0As88KM+/XmnJQU/enHGG3e8qH4jZ2YZZpIRJhAnJMjsAA1woFVr0AOs/ujz0EvHuoaKNDlxD7Jbd31jtmOXfXbaW7kbb9wRivuzADLYaCSOws0d91faa0lIv+cV0go3mnf++eaF1GIQRXSh5uegFX98e+67x1dyyaUSH5c/fBCysgEqQOFL09sHrEEBhHB//oQXoChR6V6BhFmzX/ffM9oFUIADrNbIhnfAh8wgNBT43UcEVZAZIRB3elMPBNJ1OJ6cz0IGaMEgoLGup2zKeyMkYQmfBD4Ugk8mtvhDDhCgGQRgYAXso18N5QI/t/wqWDbU2g0qIgkUceJ/QyRihQh4RCQmcUQSZOJCjgUaCGykOdEBXhNNVjz3LOCCGJyGBnGiof5ZZgBa/njGpYJmQjSmUY1iSWEbK1cTXPjBChuAn2UOkIEV6OBqPGyfBQQwANLxUZAJEtLcUlTHCYWRiIvEkxId+UhIyuaAt0MgC0ITxZZFxyN1s+K4sDgpiiRvXUIJwAZIcEpUplKVJChBBBD5xzlcbzwUEdoabXlLXNLEjSm8yjAQsYYVGEA0BXAACHDAgz0O8mFVWEEOlfnMABGIIkBMEVIypsiyMVJjkeRmN70JgE4WBBKjqGRoGvAc5VQxnAwpGSUN8h7kcbGLFDnDJ+x5T3zm856eIIMRGGARDjhjlgKoZS4NelA07hKFWmmJLQKhBRUIM0uv0lIBIKCBFdhAftDk/mhHOUoeTELnICnQ5v+wyaxvplSlBHQn3kyxhBJwgRO5G4HKGLBOnC7kk+x5QCjlabMy6FOoQ/WEFxjwxQPwQjvZQ2hTnbo9harwK8uoBSEgSkoNZcYADtBACGoQhEA+swpECAIPbnCDFawABzioQQ10IIRkelSubNJBhfSQoyT476QltRA2V/pXwK4tpypyhR6OGgEpROJtHlBZZAb7WIHsdD32uxkXhVTPoWZ2n56ghAIHo9Sm1OupoyXt0KIqubAobhiZuIMTVDAsy3xRUwMggAMuAIIVuHUIcX0YEcyKgxBw4AILgO1nENC5qM1VuWASkmNT9IpD8VW6KA1s/nWtWy3IumIUMvgiBJYACZPd5zPODd7d1Pm77KbkPX37KUWCqln43hMM8EOAQJlyxtLmV7+oOm3k3PMLS9xBCy7IAGVEUyH4DcAACKgABk6AAhzYQAdg5a1/xhqEG9QABSDQgAUccACJhuaVlTGABTy3XBQDCHUUCYOO6DBdGCPrujOmsZ+yqxA6cE1TAjiADPIAp2tRIDQGYGdHGuLAlqb3N+2RCmVFCSryvDe+8SUD/DogS6CIdr9b5vIJ+/vGJjUDF5b4AxZs0AHy0MkAB2BwBdxcAQ1wAAQnAAEIUEBnEISAwxrQAAYw4GYEHADEdjqABDrAgRWwQAUtUAEH/ioQ4spYILkppjRihERkHe3vThTl617JVmNQhzpE580pJ1hwsQTAwAyjUAippUOpHW+GAEoe7HtukpP2CkDKU4bvFyrShvtCpcvDJjaXm1GLTBDiDU44swMMHOuyeVo0FgPjsnicgRYAIQt1CEQmavEL7dFEGKvwAxZahZ8DrKDS6/bLiok1KFNoKcbUbp1sLSRqfOcbN7lLMkHoQBln5WcEMh2UBjszAFq3zGS29qll3ctrXh+BIgSwL72EXWyMZ/yp4ROfMJBdiDuswQk7UIEGLpCpk6acMxUptApy8IM1cBsRq8CFuWKCnnB3airLQAYitFCBai+Ahv/ZIbvb/vfCP5JzUBGStoSaPm/82HvlldF31a3+moQLRBNyykwGpKC6FOkYNEDOehNfYfP1PGCLGLwsxKdMiX8KgAqhomXONX53vHuvjTc3iuL89QtbZAIRhSDEHf7QvDVkwQpOYDzjF++EIWQhC29onuEJYQlMrKIWwmiGVJDWr2VcYgeuqsgFnGB01M8FBRWBQXDMW1M7PR3qzQp4aK5+e9ybpuwC4cKILxIBJkCC7MJ59md230m0q8dHud612zPrBV19MGd1t3verX/9ou39Kij0/HkEh3PxdT9V/p3KL35QxwI4M/VGr0IdqTmo3c2eQpvO5oVyf/+ruzq7kQDPSR9A/oMfE44JGb7jOyBbW7vDEZLmc76hirs+yLKLwz4JnECi0T5+4SV3cZxU6ICKIIAWWD/UA4GK8J1CARuVob9rki78W8F8G75+Q6BWkAJo04weowMCjIhWmD+l47cCFIgDrCwMIg/MYkDNMgKKUAEILA8KXEImtBcLhBwMTCOpcIM64gAQXDchqKMHKRQ94AzZk7/6Q8GzYUEyrDH9uzFXgIQIkDrNGAAWCIOJ2YhRmJAd7EF++8EnuxQFJEL4KgNdwbLtoKUmHERCnJInrIlDTCNMIKUA0IArpDSgq4iZKhQhuiZ5y5AvlK4NKUNOrC47VJFWWALZGwAR2IJJdIhN/rC2zohD4XjBVswRV0SI5EuP62A+PoQvifIb/CpEXuzF9kjEmQBGNBoGDdASR3xE5fKhisCfR4G0ZNGSTARDlelEagSsM3Q9tzGsC4EAKXg/hKjE0DjFT8SdZZjFsmAvh9O1W9SsCKCIQ7A4JfRFeZxHKPkyMEsjYWgaAQgBZJSrKiguO7gWxpLGZpHGTaxGhOymcRyITXiiC3mA70IITZgQcVxItzHHsoindFzAdbynF6CIBwQaQaRHkixJ9rDHWxIGFaiID+xHjlq9ihiAOiSU+CPIguyrOdmrhNxJbrLIgcixOVEAHxu+SJgQsPNJWHwIjCQLtQPCBHy4jhSq/o8UgDmAR0yoPpPMSq3ECpS0pWUQhscIgAFQP5ckOjVhEIs4DkgpDky0SXpLFp6MS0dCSoHYBJKiEzdcNVeQhAlRLLo8GSZbhlpMxyGMSnyaSj6ARybZSsZszO37slz6BUopgAory/nxI4vIA2zRNLcsKdmTS9A8omv8lsFqhTAoPgwRuJr8DL/8S3KBp4ZjO6g0THy6y5DsCS1zTN3czZfoSlxaBVcJAAuwTD6ygYs4gBsclByMrc6Uv9B8zgByTa2DPSLyxpSIRelkOKfEntmkTXvqKQFABavkTfLcTd+8pWW4A00JABwgzhqqAokalh4YF1h7y+a8yYyBTv2M/h3pHAguQM0TzBDr7M9HwcNcK0zanISKsIbxLE8H3crzRE8X0JWwcs/QEcE/qghAwE7JcMgLicYAvU+K2E8STRsCFQj+C1E6Aa8ThRTJUr7YfEp19E57EgOKYIAkXMwH3VF6jNBbGoZhuQALbR8egB8MRc7kHJToElGnG6ISfdKPaVFXiEHfE0MNlVJI8a+0Q8Cf2UMa/YSpHIIcxUoeLVMz9R4/qIgbGNLQqYIXCgAHcJMA8Jpx4UwmlUYozVPswlJIqE9VTJa7wtLhkBktVT4u/ZvuNExGMDDxbNAzfVRIHaGV5DH/KDoUs1Q1gUkBuAID08xxWc47xVM9HVVo/uHQsgtF1wlUQR2UQqVFnMjDJPFS74wBioAAQAzEeIxUXd3VxbEFDakBNs2aXKGIFbiCiZvJaxGvUJ09Um1WG1vVwjI4jPFUNAynV2jV6rCgAAAt2RQABO3IM4AfQaA7guJVcz3XffkBTTmAYMUazDwAOGgBingRk6GB+wTRP81PZ93XPHHRcNouNrQIfKUIaoXW5yLTsEDHbuXIW2xHAciAW8XVq0RXiq3YUsEF+FE3X8FUNnW3IZAD8uACU/2NiVhWgYUxfk3ZETEgg92DBMBJz6ADg4XFe1QPjQxCevJOEqgIJCFXHbVYoA3a+LCCAmnXhoFPiuAAOYAD+GnN/nGZSJPFT2XRSZWtWg9Zp5HdiE2wJIyRWaTMWpV40bJoCYWVUYZlwKkUADYIrZEUWrd9W/XAWIoAVqNFGAwdADiQAyHAjJBip0E9CPCM2hizWsLdDTsc2VcwAwCtEzOYWRx5BYTtipZQhps126h0BK4TgBxQkgiEW8/93K/wAYpwgLrllcQYVgGwATmQgxDACRp4Gw/djIEV3DC8iMK93dtw3ILQhJqa3SxpMd09EQpKj8rt0kRlQC94WYpogYgVyfIQP9CNXumlilSoiI0qXVuxAJxAADngAzkYFq89Gbak3enCXfOdjYcAW8hqhS1Y3A8F3vxx3OGtjuJF1Bm1/idQgDhK+AIhq4ghaF7nNY/InV4ChlsOFIBjRD2OlZob0JIqWF04kMS3KUryVVHqOl8M5o3gLYgUrV3ZrQj43WDhgIWaTY+yNV4BGANKmAQWbmEXfmFGIAMoIAFIM4BxHaiCKmAdLuA0/SPstZU3xYDVlYMhgAzckVaC9N1tymAmVg0RJhkqrZMtfOJIKWH6jVEUxkseKCMgyc0d/uLPRYYDwIw1/eFM1RU0GGKYZEaTSBHPquCSamI5Pg0qHgiFUMMP3owtqOMqTpr1sKDtxJk0wxADoIJdgLK2BWNF9lwgwAwMMGM1KQCKQIEhBlmKeF28eTE41hhpm2NPTlLH/n0FOCGF1ZyQPZ5Z9RUIEvZjQw3keRnk0HCAFciCU5CGV+7cRc7loC2ECoFkMVmBLcnb1Y0D+OkC3EnFtmQkJYZLT5Zjwqrjk9DGCzllPpaMXsDWstAiXOMipLOEYRAGcB6GbxaGb/5meFEEedpFXV7nilWGYbEBXwaTAsAMSh5iNKiIKX6bDWhObFrmOWlmOfaIaiaIhryQYmGiVDaZa2ZlE37VXCMK6JUJa5IXnC1Xdr7oc5UKdRWAR45nBKmBAQhpYV5dwXCQ3JHB+dvkDx1DgM5glnWbhC6Uf5uQgx7oZ4YIX4BNVx6ldqmK++jZiv5ZjB5qSC2EM/FoBBmW/noeYiyhCGqeYNq9xCF6lZZmYtux6YJA4s1YAhSJxZjGm5x2jxO231Qg0/ug6MNRZ6JeazMdButFagFRRgEY6dVNs6d+G62+V6lepKrOYIHG6oEQO4sJAK4G7I0I63M5VOXp6aLoGbTmTotma8ku06bRWLj+D8wEgUpe3Toy5twpZc+E2Tjuawzuatd0RtklbMPeCGJwj2UAT1gFEsDxDs3xGS5S68nObd7UAoroaLla4L0AbgNZGIq4gs2O4IqQguGxU5W2T6nVDNLG4K+mS/fVjPlcbYg4Bnhy6HTcmZlw7HROZN0eb8dEBDS+bP/AUAfYbDm45/VkAlAeF8Fu/m5/3ozoPt/pRuhBBdXQwGTsdgj40NbYHijvlgnwvm1cJm8Fz0pkgJ+hWxM4sMxh0QHvHWI+MBMNYYL8TgnQDtX6hp37vt1x3HDtspAZGBQS76RegA+bGXDtmO3GhhegPhxKEeoFv3F6nFR+RO/FwPC5Zu+IqYglSPGI4MvmdtIQv13sJHImAsfQaL3/bgjtXi8sJmur+Onwjmwc3/J5dIOi5fHEaOoKYG85aGqKKOzhsabX+XAVTPLCZfIedHLQgPIoTwhfmPL1Uux1GZYCv7nafmxBFm8uH3RCxIXRCR3hHqQJJ3MOsIgkQKAl1SY2z6pPc/PbtR04zzqolRC1/qxzFbnzJxnMii5r75jo8A6AHCZ0VW/C+7BsMAeMqqEIuh5ieLlkh8j0UajuIpo3T7P08/1rAk0yCuZ0T4cFYkAGKRF1Ge3zmMByBEf1VY/2JkyD0X31wzBOAeBeMkc6TaHTA4rdIx8bX3dpO95gI5cQerXIr04OYmiGUWnxh3aXsw7vAUh1ab/3vFsFq7F2wMBQpSVz2JpTCTp3z0DtqFXicW9icJlZ5v4MNtap/nSZ5CiGiE72Kp8XPncXGT/1icV3j9c40KMUV+f3vSAPHSBzOUAkOsfGcgcOEahSjDCAAw53+0t4Z75qg+3CCWGZgYYFYxjgJlk+BB+SKzec/rT+I3v/eKXnssnhbQEgXZLvi4pIA5RHpE4fnpL9jKx3uknnHXG3eU9m+azTeQnpFip+hV7Ac1SRCmVHYWYPHHgB9FuG9qWve2LT9z+q0KivC+IWgDhAeUi7+uGZb81oBYPvjL22UkYC+5aO7xEfCNaZEEPS3eS4c4ZOFcG8eJ4m+lI3eu6ke7sP/S27jx3fe7woaW0nc0R6+OExwc7ghLxKpICtYMbv68i66cd6QU2WEBJE5WM3mqZ08eyA8aJw9qAWfeTXrzXADHY1fbwI8gtA+ZS3iHSfpFgI3M3QhE2neRCv/ap+oL8c3wUyWFgohqXMFyHh1mU3a88P9FxN/n74b6pfqAiydH65aOoQkH5I43km2nrNACKA8CBgIMGCBg8iTKhwIcOGDhsCiChxIsWKFi9izKhxI8eOHj+CDClyJMmSJk+i7OjK1auWK1/CjClzJs2aNm/ifMllwMOCEXICDSp0KFFXvowpU5ZsKdOmTp9CjSp1KtVkEAbemqZ1K9euXrk2GJiK6jIJA2l9Tat2moOBmJYtqyp3Lt26du/izat3L9++fv8CDix4MOHChg0razFQA5rGjh9Djix5MuXKli9jzqx5s2QOA1fICS1a9IKCHoqiFvpqpdmGkFyZ6Sl7YADZtWfjlp1yN+/evn8DDy58OPGIrVIjTw50/svs2hCUQ4+O0+Wro0qXXj9MOKyArGu/b+U+duqyDGfBo28r4G1c7e7fw48vfz79+vbv45+vjNDAAVU4AxiggAMSWGBjGgxUw2gLqjfQBtJB+FIeDumxkgK5YZihhgvdhlBxH4IYoogjklhiSa24FKGKQTGHGwMrDrUajC+tVt0x+QXmAE/eobeWeFWZJwBaPa6lnio4Ipmkkksy2aSTT0LplDLIKBBAAC0YmKWWW3J52QUD3bDgaBgUlMGM0cnQ0B4rtbihmwx12ByGJtJZp5134pknRzCleOaMTBwUZ0IN+FnodK8Qg0x7UdrlQG08EvmVeuNJVd55kaZlJKOb/nLaqaefghrqYElZYeUCXaKaqqoCVjAQD2KGxodnBFFgKHKjPMCQGSttYoCGgr4ZrIZ6Elussccii9JxfdoqHaC4ERqUjDNN2+xNr8BSjKKiyuVoAJBiCpZYZGVg5ZDhdqUeJtyy266778Ibr3a1DDBAAEGsmq+++zr2pQA5wBoaCgVJYC1qkviqUBgv0SCsww/jlqzEE1NccbGk8GkwckvkdoDGfmJbjDKLyuuUo92h69WPVJUbwLkpa6VpyTPTXLPNN2+6jAtWVsCvzz9vSaYAOgQsxw0FPSddtRBCkjBCW7wUCcRTU62QxVdjnbXWwaHI7MdA9ZAbAV9DWCMs/kjhbPJAvMDM1QHjkjfBpW2z5Vbad+Odt95754WIlQEQAbTgg3Pmrw1FC1HQAzYtTbYrkFyIUBcwpQAnsBBfXjVDW3Peueefa3Sc40ClidvYoydnI99Lqcc23XULkArJT1kq5Ouwr7u67rvz3vu7y1xgJQiEE7+qGgEiKICCAadRULSo5zRK6QYt/NIeTiOUueZVa18Q6N+DH37WLEFPEwy5DVB+jKonk93e3LlO98pT+SvL7erOfl/+vvPfv/+r18FKBfhP8QpoQA7UBjQBg4OVBvIi9eUkEk2YgAESsIEtiO4lEeBQ97bnQQ+JL4QiHKGeYgHBl7AATgk5IU5g/kGM/fFtGUYYAxRqcbv5RaV2L4OZzJDkC1K0whj/GyIRizgzYSzASiEwIBOJNzABcKBociAAQQzAQmmRLyZcUMjfCNLBQH3wYSQcIxnLGKIM1qRxMxoBhtB4RZZky32+e8Un6vgJWFCDbm+LHVnqdz+74UgZsLDjJ0iBDCMiMpGK3BQbBNjERwKtBgOpgBQbdLo3oqYV2JNTGMMYADOCMpSiTElM1FioVwgkN260lSlnIrKk/O8YhKyjKKrRtkmRa263HMiRcCTLWYJCiIscJjGLSZ9hFMBKOICkqo7HTDQcTQANkCIICHLJGbVyRl3oJDczNMpvgjOcGoHeBjBk/gpMugIW7ZOj70gxyzqGwpYpwyFUyqJLHgIyP6545yeCacx/AjSggCGCI59pUFQlLgADkGIOCoLO1Khik92c6ObEadGLflNjjQsShxCyCUy2BDv/awYo+NlPeYaLnrQL0g5T1kP8lNSkwhQoTWtq06jgIpkBqMFBe6qlKgjASnAo2hW8+NCixCIWLmjIFyk6NYxCNaokzKZyqPqSq+SGEw/tBTKQ0QymwAUuUmInzXxhUnjmMVwIgBv9BmK/1xkJhvEpxlnreKOb4jWvAnVCbRRwBZ8ClkB7rELR4FCQVV7RqjHhhL0aKCzHJqSp3ZQqZSs7MVdgzBUmXInXRper/qw+dGnYggUsfGFaYhTDGMdYbT3l5c66lgJdKn2K3ATwVrqpC0d0rGsoDqnX3wI3kb8ggJVQENjjAsgCAyFa0fYoAMQeNSc9kKxt4kRdp1rJstrd7nCAqNlWmFC01VLs1yKHG61Glyai5WxLRnta1bI2h+2DUijqWkdYpJStUqltS9H1UvuIwr6FDC6BC+y/UgWAAMhFgzMXXJlZoUCKyRMAK9JLFMZiLjfXNciGwcjdD4N4nBgDr4xqRB0aoZhxWLSWRB+iCQvnpHEmlkl7sWVaXxQjtatFBlnxI+A6JgNTs3WKv/obrtziBxk//oQvDOzkJ+9tGBcKwBIdbOXJ/uBgklKMpgAywAImhEEPmoAujF/CMaeiOSEhXjNUNZtUlpBXvak7IU9yE4kyf60lpC0tjnO8Y/jQ9cehSGuPhgzWIv9xPXJ9jzGWDArfQjnSki7ZMtbQHwJeOdON0cFADCBFNCwkARmAAZjFjOeVYLibG+5wxNjs6lCyl7PkewWZaWzrU9ckQ3dWUZzL3F71wuKuhRnkkvFLJFzG7Z4u5WV+zLrkUkw62tJuFzK4wxhNa7oKCVND0eJQ54cQAAIj6MEW6CCJWquvCWlet0Fe7e4xogjXGmtFhiQh7zeq0zCvXTJKwbNHSuWQpYnO3X32/eNiTDvhCudUHQiCL2xn/nqtAhCCFFujIQNsAAZNCPOLswi9TVCR3ex+N8lDSLZel28T9b43C7F1mAAvuZDH1m89BQ5XZuOnFDH/hCgW7vOfL6kZGrCSAyCe6eRFuGiK+RVCwj0CGpT73KN7lsjTXPKrf2+zLLcVJzL0mjeivHz5LszO69iMQtN8pcr2Ly/Fap+YxnzsQJ873eWDCYLw1OgOlqQAENAHok7tchjXOMet1QoGVF1zHcQ64zuX2a0bShMZAgTkDdbK6hjmlzsXBdr5SB5E31wAR1r0YZRcdlDUPfWq184OBjJAvS84cQORohy+reoJbAG9haIDq9nd++w1PvjjI0rYIS95DVcI/nrFb7nICtPos4KBEfw8O3gMvRQdDhw/zzfpGc7AT7mvPvzi18svEjY82CM3YYQtmr86OQEa2GHX1kpl4ikq/PtX7FqVh44kMpT8/aPOTA2Gs/GTJxBADPAT51Vf2jkF9oVeL9kHMdRVBFAAP/XW+GFgBtLFMrwBQegA+h1XqwgADkgRD3gQAXgAE+TBKDhO/xXE73GSyOHfDCZLZwGgdEBChuTBDaKOsA3GbpkUBZrUMixg7Cwa8LhV9t0HsZnUCwSAJ/BTk2ngFFJhAyKD0BwACAbWE1FS0TQSDCYEA6TAFkACulkLDWROA4Eh03kQDbohsfDgjACCF3ERQqxJ/hySzWEY3Du9AAFA4TvFQhECXD3V1m3tkujhxx7O0hQEgPe9UyhUYSRSIVykAkGcnxYeVBAQRBxU0hoKwABMgAyEgfydECeEXKB4om3Y3xuyop3g4YpMCIbQwSt+zWHo3FlBgQA0gkn121dYH1zYHG7lU30oIiGdQQA8gUkhnCQyYwZigcNhYk+pnxStwO+hoAp+1FGFQf2tYit6I4nQYoTsQYbMYjg2S0gZRn2dFRkIwBSYlLGpxS86oDCuB37A3FklgAmYFCk0Yz+KHzIESRZG42Q02OCIYNIFDKjRxkMoAAtsASCYIQuNQCpyY09840WGCPGZI03QQYbsykba/gr4CQbc8RMlDMARmBQoEJovMiCRJWHoEVx9qONZkUACnNVX+WNO1p0qBFUAXOJAPlKW9R3tNQBkJUQojiLLmSI3fRFFOgRGQiVxPB5IpkZsYMhHUqWfSCFhmF5dPYAI3KSPtCRY8VeiQWB9CBgSBIAjvKNOuiXQLcMz1kbeAVZBXhkREEQbSFELGOVAXGMeZGPlbVFFdlJUGmZwLN8NUtU2Ykj1ZOWZEEPmCZgJDMBZBWI8juX1+RFM3ofmnZUYBMAYmBQkvmVpJtwyCF1tDEDgAOUj7RFzMU9BNCQZRiSuiQAdqpDDdJhTHmZv8kZiZmWb4AYXKOaKQYgACsb2/p3VEzTiWa1kV1hfMtSOIeITItqHZ5oUIyDjWSGnaXonlNVC5AhkazJRNQmABoiGIMCKeiwBSEbCKRLm9vjmfJ6EDT4mTgjnbBAncN6nTfigYEigfY2BAIgBd2Km51VKMB7iWc5HoNkXAbzAWb3Cd1KopPHHQHAAeTIRp30iJxYN3yXNRg5mDHLjhtHniYpEfxYF1eEG1Cjf1k2oYRDgWT2CACCBZR7oINIO6NFjTM5HgNqXEI5mhRLpk2kBbSyThhZQAQzE+gVMGxAE5W1kK7BRfLYhimKpSsBoobDobLioipZNjBYGENYVhNbVc4ZHZkpnkFDnstVjfTQDE9ZV/h/W1X8W6Z3ilTKEQFANwMMpKeEcJO0FCQxQJSe0mJWKUZYqKkbUJpiuhLpx2ENMjqMqjUgGxj4JGAVEQF0hQ1pE5zKUJWfaB5melVo+wllZKp6qakAtQy0UpQAYAGv+qeDw3QHQHl4KAAEEpjnGIqJWzaICa0VQalA0DIZM6rBCx1YSRjHy4QD8IT+5QlpInI4+BZsqITH+GCOSwVlB26p6a00tgyWE3AFg2qz6DFANBBrQ3h4RJ1VCauCpUF8WZrDSKwAgK04Ua24wwb1CxzIWBrPOkhIIAFumpKeqaTIoaHX6qHwALCGRQQB8wVmh3rdSLEDBRSAQRNGZK9AE/io1DkSIgmQ5pZlkOaUA1Cu98qtNnA+GeIAZmFoppWxO2Glg3GNdfYEAbOtZ9aJWfGqo0iODMuyPPcJ2npW/VuzRElMHDsQFbCxBosoKDAQC0J5hDUQ5gqQmJICvZpjJnuyispKh8GdNpJCbDIC4Qd0eSAILxqxNQBphzGRdlYEAeEFdGQNLImgO8eghLmx83KKADQACnpUrIO3gKlJYDQFt/GTTrgquCgC3SdGeCsBpZGVHbk/JBkvXem3YhmPlUM3gbZyYNWpWimlhvO1ZTYKN1hUp2C21uqRtDRzpGUbN1hUDlEBd9Rzh4i4iLcP0VJni5otyCcDhSJEaEMTX/lFlvjqE5WaIoJgo5mLpVK7tSlRpGDnd2abtsKYqYJBkmUaoxEqKms7jIbLue5TuWWmqfeVu+hYRMkCuAPSu76bKE0kt7fkLC9wn/WmtwzgvloIM2AkFR6GZAmzAlxVeViorYcTcA9RuXe3sv/XRS/bofcQcCTCAfRmt+mIw7yzDMGhAnb0v/HKJ7AkAG9AeugoAKW4kJ3BH/urv/p6onGnUFVHAhqRhTzjWbQzAAzzdFqDtOUGH5s4ZTFywYHRlplYgp3oFsiUoBOutBC/ZC9hkXY1uBlNxDC3DLyCIlWQoCKOKeixPJQ2EDNzne7Jworqwb9rnvQaP8r7J3wRA/gMsgfGWT0u4UygURUvMLGBgZ12JQAXXFTym6d3WU2sYGab8V3w0Q8wdgQDYFz9W8SPrDhYTxLVx8ZbIL+3JgQjb22NSrq+uYZyc8XxGb0w8gLxWHQTMQFKGLisZHPG9Ak4Wxh6fFRTbV2xBJ/j6bBPXhyyblMAS7JBCcjBHWQfQRgX8VSVnSRXU2RVIER7IgXrYr/oAMU50qSp+kCkPSygf5ijDBAOwsYah4BLQwa6C3SyVAspN8WA4qIAdwRPal8ocrLWKKn3wMj/lovTVFSwL8z7fzDIIgwrcxgHIKjITiAieACabsBxT5dgiKnVJljYbJvSubdYuJEUFwGyW/mFowUTf2lGvudxhrLN9KcFa2lcvfmrCuinQAlrM5aIjFi0/w7TNwEUwnE9tEAAPIJddMlM0DcBQ0Z4ISu5jjgJWYcg346YZQ/RFcvNK2J4nfawoojCM8VMpqEZkHsaM2hcUBAA+h6W4GOHnMbHC2kdI1xUjunRbxnRaz8wyvIIUFIRxETSB1BnF0V5RDcQO3qcmVAkL7yYIJbVSx2y1dNNf6l7GpNcryG4dgcJQdKdgYPVZeYJWc7VJEcMtCzJUoDTbvSl9yKl9eUFz1pXgqvVoxwsstAId1FkAWEC5xvVmJM8F8AEmY4BzrHLl6UEdlvFs/PVFTjMP0ltuAjdC/ijAGGb0/p2VRKdRjwEGqdaVZNtXtHr1+F5fLlenSr9HZ9cVGAiAaNouaXu3uxTDSkhCKdfGAXxga3OGJqYrJrNBne1rf9pBbgvLbnvjUo9C1TwAVMfhK3D0LNkxUKTzD8acWduXAgaydK/p2h3ZMMoHdn9maNrXxH73hIMKMnDWJqRAh2wxemuGeoAAJssB1OZqVIOkW8v3m9A3K2qd/j1m1/2KGxPABmBjyynNK2wvIS02UGQvYDTsIgrAWZuUZSN4+Fa328kHpv4YaHJ3PlN4k3fKMsBEK2wBcQ2EeXN4ZnCZT69rbaQAmJ6ZDb/giQ9Eir9hbwOgi2sIA6gA/m2mGB6+Qo8jtyu5R48T0hT8uICtpBIHnIIbctvB7mDQuR2BAYTbVx47+aEnyTL4QkxEgnncRgUM9JVPhsQhpBQR1EDc4X22wsqKuTeROQ2a+f5JjTXXxgMUdlYmtn8DhaHz+IDfeUlHd1XkrVhj65J5wavX1RAj+q4jiTHIRCswQYcQwAdLOmSI+AB4KO0JjQKcOlW2Av52eqt9+v2Fuv8KxaiTLNKAbcvd+DvF2Hv0d11FAa6fFREeOFkUolnaR7iflZ0DeRTyerwrCVvPhCQgEEEcAF0WO2TU2RdLUXsPxAiA6SZskJsYdUdJ+7Q3Xm2DZA5mCMjC8A22wo/F/jmN7PhfNEP5ntVI/7KBBvIqHOGsu+neki9Lk7tJBbi8q/x8wAJNtEIY7FFtOICf7ntjPFFPg7gPEAQXAGe131qEcMJnHXW0Q4TCB5/SAOAcMlVCLE5/BnqO24RVa0e3m5RaUoKAAYNXz4YCXEAOzIEsoGl64Bx9aLxJ3bOAxcLKq/1Y28QoMAGV18YFRHqx79FBg/isDACJx7DGRIJzWWnJGn3jzfEJ3XaGKICKpjo/rTiNNfZg7FwMBMCPAXKDZEgDaMEz9Lno/flgUD0/IcHACpgjr/3ow0cz4IQmMPRAgMDcczjfCYC6YjIcHEBtZADDVx4kwCfR60bgX90o/vcqbgSAx/Rn4j8i4yg3YBSxgNGygEG3Vvj98g4AFUTDzG22fCSyIjOygHUr6XO/digWJODvACTulUucBYC4HNi1AERzhPi8inSy7us275NcGoOUn7w/blhRf5Y9P8UbtTDazgFECQafCBY0WJDUNIXTEAgQAIZRRIkTKTJqBOZJiQEOHR44tBBkSIUOBATAlAxlSpUrWbZ02fLYQZkHXxCYKTPUS507efb0+RNoUKFDiRY1ehRpUqVLmTZ1+tQpMVdTqVa1SodBAK0BCqxA8xVsWLFjyZY1exZtWrVqdXAUIgduXLlyV3DsYhVvXr17+fb1+/evGY6DCRcuaRhx/mLFixk3FgAAcmTJkylXtnwZc2bNmzl39vwZdGjRo0mX3kwKcGrVq1m3rmrHMWICrmnXto031M2Zovb6grqymO6ZIiIIL1gKZAOHZXR7uumckpcHg7WItE7S5G+dwY0bLPGg+6ec2smXN38efXr169m3d//zWOpXpsJkDdDR61r9+/n39w/2AocKaGOuAuPSgCM6bluQQdZeCSO2CCWckMLCTLsQwww13JDDDj38ULJXWmmQxBJXg7BCAWYzkUWqXnHtxapyuym6g/YyxrxXwivoARHCEyW55XbUDQoDOMqBGuuCFOCk9WAZ8hMKKAgPlPesvBLLLLXckssu01sm/sbURmGCgMEcuOG/NNVcUz8iBtgIAwMNnGMBhwyIpMU8S+QixT79jPA+w0AclNBCDT0U0Q1fWVTPRlncgrFAC9PK0Upbm3EmLwQ4wyDe8lrGPFegHCCGH5dkDsqZGKGAIx+UXIikAZpUT8chGSghvPG83JXXXn39FdhgiVrGl9Y4YWKjww6ogc1mnW0WB450kLNANgq47wBNLN1WtVYg/RPccGNLlNxyzT0XXQy5Xbe2bwEdjN148xJFN0YCQOKgVsKc6hVlzKN3R0oEwLc7IBdSTgBUU5WJEhI4iuPVabCbFb1lShm11O6qFJbjjj3+GOSQl1omPtc0kYEwB3R4/pY/NVh2NkABBmCD2rmq4KgBbeXdmd9XpNhK3KCDlvSxdI0+GumkEY2F56atCtPdCkd0ml2Ab3pgSoNKwcs380AZ8owAoMgVJJI2XVi3EhwaYJZXJ15vma93fGRgKkW+G++89d7bS1D3ZS0SGJK9zwI0Xz4c8bGqMFKAA+CoWa4hOIJAZ6rZfQVlooU2TPMUOx9X6dBFH530zhz923K+mPDTlNS5vfi5IwKgxLmC8MKxvJiGBEOAMche6AAh0Z6JEggc0uDV6QRIBW4oyxDAC7v5np766q2/nqhibZNEhUC1smDlxMU//AaOLogD8riCmLxy1y0FYPP44y+d/vrt/k96Z9QtX8LPUdy3lBTCEUMAvnAQ1FQFVOUhBpSUEIBH/G4kDuHU8GbyPIcYQklmo9h5FjgkTZFhR9gT4QhJWEK8lew2koBBSbQiAJWND4bOQgFHQJC+uPCAIwyAxP/eBz/5/VBcneHI/YhYRCOajoc860ELK7SJJDaqFcKhRAAyZpCqvOI8tdpRDAawI+QcTHgUlEkMHIKBJIkkVphIIHq0GB4lDGCCxtGVCelYRzve0T36cw0kRkCYCgQhhoFMEwc4ggI58MGGbVmbgp7YolZE5nNAlGSEODOYI14Sk5hsZLxoEMnBeNKJm2RRG4czkINsbSrEOI/VwkOB4oTn/osKQVgcxWgQRnBEFtcpiST8lR5WdicGNskVHolZTGMe8yjaaxAkROBHIQgSmvuxAEdCYEO4CCFZAtiCKEs0mXd9cpJA1IyFMllOc5JOj9xkEcr61D51LugVmJrJEwLAiIOAgirHMA8yoFQJUu0oFqeq5UwcJgAr6FIAeVijeZqRqh7taI7IlOhEKWpMZKSTNnrgANEuAMhoftQsVTCbAECAPhuiIXglUQEnGgWZWGC0h5JpDNAW48lwUggzgjrnTnmKLpi+Uy8/tQoL/OTOUf6vFfKUSdieIJMDnscXzhPA2MLTCoEO9CBfcEgDEEoGYiyUPNwJmACMsCNRVBSt/mlVK/aWoQyhrkZEetgAYSzgUZDeFSxVmGZJLEAzG7JhpA3IQ54oMzVXvLVBsahMTWl602+maLGI6elkKVuopwGVRSnwnACMilkYwU43DPDRQULhClicJ4BDesLZwvOKq2K1IJPgyDPQuBxRgFU7qd2RGB6yI1KsFbjBFS7IfIFY1uQhA0RzAA/w2lw0VIAjBSCCNeGAII7AgKUmuoxhjVubyzgWvPOr7HjJqyHP6qmPfcLTeW3zilgYJ5iUcGoxGCq3HZkgAUMixmthSxDloaK2AgAhfesLJSSwtjuxGO6CGdzgLV00T7AgRiE6QLTCOfeuhCzk42zIg2wOgAn+/muQiDKDmjB1NzWP/G54WQyu8r4YxqJhb4s84Kf17gXF3FyUfTMVADHgBBnmiSqURDukY/C3v80UwCACzJxScDBVAhkSFh1cZStfmTzKgIWJYFGMZiQjgZhoAUe0ggDDYRiaNvhwDqzJhgpI6gBbMOyCOGPiF+UYL/tSLGY6Z9MWH+bPMRb0oDPDtBmXKAN+koTr8NyaeEoxAEeYiT7L80vjOKJuO2rGkmjZ3xc4BGIhwQ6qKE0e0O4oASQY0mmx3GpXv3ooyigGg17R5S+zZBnLsMSYtxKAC6NZkERoCEccEARrBiGlDoGAnBv0GUN3c5zx04oPpX1TQl8b25FZ/tScD10b4/Vp0d2mjW5vQgHwyCQWuG2KWHfbuyFVg9P9NcinBTAHkSAMVaRQN1N0B7YAKKF23VElrAlecIOrxK20WVSX980STLig1wJQALOAHcgVZLNxNvBrzeJgA8aV5ABM4ASjbBMa7t5GiJtFTAAg8+dwZRvmg15Uo8VNlW+naIc1d41xDtxpgjRcKacOjxEE4IghnVGWYZS3CRzSh3uXRGFBzm2qvhAAn+um1AfX+tatDAsU19oYtwb6SowhCRYQTQEtqHgMiWDdwVzABmiAHBwu3sIADEAFdOC2g0Zz2JJ7Rn6RcbmfWB5zw5dX5wtiAOdiA4jEX0o4z5vC/kxYDZV+D0kEpoRg0hMm74JQ4D4fCcm3FeaKsRvl8juSXcC7w3XXv37BxzAuLHA3lGBQJXBlYmFX1g5DInwA4x0BAQ/UQC04tKBMTDwADfIgYteURuGgiRROBf+nSPq5QofX/ngP+HjXfLxCegAqzfMi9IN4ItUzCcXpiyKqVBHgBUNKSLw97wnG3SLAICTI+tk/FFKGJwJe6UdgjwALEK22rC/AzihI5m8iQQY2YisIAAWuoPfEhwhWYNgIIwAOQAN0gMPmIg504AA0hwBSYAsgYe/84hUuJAX7IjTEq/oGj5K2jwYni+S8bzV0L0XEDwdVwzhIoItmYuCcAhl4/iw8woaqwgMWQgLfPO8TzoAjpKHJDKIY+i8omkGpukNgJM23DNALv5CYpMJF+OWwfCHrigKF8EITaIAwCCAEiKACxUcIQmCkCgMDis9A0AAEgm9tMoAGtkAPsssvVIwFb3AvRkMDXcybZmrwatAReaoF4ep09ORPBksSE88ID2IKBGwmfusp/q87oADBuuPI6E/elMAhTsA6lCMAFOYTSsEKgeJJUoUMAmDydqTywFAXd/F6Eq5nXsEMlWIZkMEvOGEJdFBmQAAO41B8bgAE6oRoBuAt5GQOhKADkJGFWmgA/DAMOuuwXmRDnk0vSIMP/6QysM/lHlEdzakHWaMV/v6EkdrxL8zPIDAtCW7i1poiC7vjBYJwR+ANyQbKE5TH6abQIKROHxemgR5oRwiMFx8SIvWGGO4sGEcGwv5iE5ggAQhDA5aRGROnCm4gBIbtPq4gfdDABi4g+DQnA+IxLzpEX+6MKi5EaFZMBslpHXPykuRRTOBRnchvL8htJgLwJqiMKYYsVYpsSJ6u8+RNqxwiGhDKFT/BFZyC3YakBPJrR0AhHyPSK7+yY44hFn/iIsVkCxTAIbaioz4ShkRQKxTAmuBCDYRgBTTgAFYyADzAUy7rQ7qPFDCE8Agjp6oNUHTSMC8JKLttE+AxEnnSRTLRIIjO6GQCFMaSJ4Qy/jwc4V7kjymnspYoQXmGIIOU7uea4r1SBf1UDaLAkjVbE4/A5OtMgQsagIkEoAJ8gC3FJwiSxQbiskDQIAhQADuUzfmsYs+KKIgyoxEPkzmNyDH/QhOmTzFc8jn1gh4LggwE4BZlwiGVAm206sd2ZL+YkDRriehkRhdGsykNYgi9c2GYakgUzDXnkz57keZexA4iANACAALOLDdZBgTsxDephQ1CgCNkgC+OCB0ZI+WsrTkf1Dmrcy+i00/CQEL5AjMNghLg7ybkUymucosEoBKGJBk6s7/GgCPWwG0cQv8MQt+WAkTDAwqsbki6sz5vFEc/JtcQcEHowO1KYgHi/u4/n6UKkmVaBlROaoAjbuxpjhM5PecFfwhCpzRCzysxI+FPLHRbEpNFLM07tHImLPMl3M+hsoZKVlGCYOsMGEcDpFA9PfMTuvIoQLE7SCABWM845DRH95RPeWUZvK5E9KDG0rJxcGBInSVAXQhJqcV4AqAHXPCIAE1CTEMRqdRSi4gUDPFCXQESHmswuGBTg1I4RPHqPiEXj+I6hQPTympHrMpEB2oMdO8AdiFizAZOuyYpUrU50s+L+tRXf7VLAJVFIEEFBkD5DPVQ1YQIOAINEGlR50IIHMIB+MK9MmlSNURSF+NSt1WTuBQwvPU2OtVPtgme9ERTTUQ4oFAJ/m7iydwzVTYxPMMDGdB0PYeHEg5sbXKpVsvzFZcCMo0DCpsKF4GVYAu2PbwOXPFChciscVDAI5OVP8xmBZ61QOCAI7yxKsqpMbiVY6dUqO4zTCKDavTgT8i1kYrBX4yhuGRSNWDKSwtCKcM0KVJP9QZAvqgE6UxxYTxBDJSncfR1X+v1IJOioRZmRkt10gxWaZdWO4orzxLWFTThGCVlAJQRYvmjLhSVYufCbPYAo1bwnPqsY8f2QbtPTwgxMsRRXvKgZDepX3oJJY7BaUcsQwuCjG5WJnDVKIwBbYhyR1xBSZoQNc9ACXxWADSAViMmgqDnJk6VKPh2YUyAAPBU/jfalWkvF3MXUAzzQl9YxBiRsWof9mrPYlkdYuO2Vg6sy2SDCmzJ1nVf937ANUZe5C8tI1Obhg7+hAlESZ/gNiWOYSLJ0Db+9RN4J14NKCmQckgoYQC4UF4D1yFIAAZigHqr13qp9wWwlwI2cjAGIA1ydl8j7SZe9ChitDsSAFcGNnPXl319YtbkZROkYAQHQwOeaXTRYtiOFHXlYIYEYAkAA3YDWIBDp0RexEktA2pZI3f9ZHfdtq1wLW6L4cRc42U/QWCqSCYQsihmEUqq7niFAxReBWEIlYkWVAB8IHEVF1ZKwkwzGCk4GGwEYF13REzb14Z/dRmMIYG75Sy7/pcD7Pd+ycJABeAC9hcuFIkFUmOAl5iJzaVB0BYzLAdF+qSB3dZ3XeIYikFYWaNuCSLzdMNGh4JMh0R2JgEXRTgtvac2FWMAToAPaEuFRW1tKJcg2pMo6FQ4NvEM6FgmqvKG//iGjSF1TIF/iKZ+g3gsotUhPnBrS3cC5KOJI1mSQSTH9sUzdpg1+MRP/lfHrvglkEGCu+vRbgIVG2F8kWKMd8RvwwN8l+QHsgCWYRkLYjmW0fKE+cAQZMFN4zjAOLETUXlhXiAB8NY4ag+Qj/lyZQ+TW0Mw7BCIERkNhm0I9pcP0MBO5KN1J1mbt7nvXKN2PeMSWyRqJCRQOJmb/mBBGXLtJ7SYZam1i6EwCe8JKfCYRsQ3PAIKjZcHt9ZoGZJLAGiBlxXXbAKAVWcCmJNytLrDcpGZoQ1W9uQFo9jQMP4ImtEgZgxpfy3WIUJJibnZoz+aM1ZjNM7V79hFChQDHc3ZUhqt1jy5J4yBRzFUONBXN4x5KLr4JgaogMKjRPM5FfY5gZYhZgA6oFdUAB5AAGXCpoUilbsDCgmmO8K4oad6Tx86iTogMSqAue7KZdQkax3AiOUgWZgUgEHarM9aMi7rikiMNPaic9lldfyEBjDLF1y6J5BBZdPpFSq4H4nZIIySKJraOGTHr2/CVX16J/rZIYi6qK1DeT5t/jJlArDFOFWOdpioGrP3VBnKkoc2YYQnhaJHt3QFgJGtSRAKxGwsUaTRmrU/2myN80KoVV6a4E9ooDH/BxiRIq/zrIs1xXdmYqGFohkEWziwJoQUF2GYRycU+58bG3qnSjtv4qyMgrh1w04LWwgzW7tvFExECRLKkYUGoAKe+VAZpwqMOEAGAFThCopb272beHZjJEOSaAlMGDEQ1LO+Kinyel90QzOhWibmFErsMTwAV3EXQCs2qCWSKwAY27nLhkU59CZqGCXoWSbQzwRgKSnsers7/MqWmUTMoLEKYwAsQHRz86KN+AQcoopZ471fvIlj8oBN44kkuk9ggL2q/pDCVQIZ5PbO9pEgVpk7jcLCDyIKAqBFhQMgIwbBA2AVeILBHfzBF5cMshKMjQKGjcMToHA7hWOpY83Dw9zVQLxE6ptoOqdqq+BQo8U2nXVrbcAhcNzR2hvG69zOAaCRVshP5Py8qrAp5LaLZSeyD2KygyLLjaMm+NggllCFaTM7XAIZYKEUHIERpiAVplyOE4aeStWPieLQhQMJaNQ40i0p/rQUQCEUSOEMxZzV0yqmuakVPAAdByAE1Dw3FXkASntRFTkD/u7Of/3F1dZ99LxPkpi9XuHLkYKfbmIMCIhdjUJ5zzd9hcNgGl0rbKElLmomWtm5zYYMkFC6i2IZ/sy33M7NOHYcJYiRMjW41dtdol5dnTbBcBcjzXMzWeQufdw8D69Z4WYc2P/doy9nNVTgT1Tg0F5h1ZPiZZkXgw/CKMh9qQQgCrpjGXgZYZ4c4XzhXw0c0yVGglJTNyicZnVjipxXNxxXKDR+fNHd3Vs+b7YYs747Qg4gP5gRugRAfyk2DjhCEF2DzgEe6Jv4dhspvfpkBLoN4Z0Cj82tptFwSA7MnoSD0eMYYWYlnXE6hDve4zmRBCb3JuwYKJZhSKpup3XDQ4kCGXD6Ezjc5dsee5SJvWADUBbArnovUWtof4fN8RTuFb456P+eiUnadQbV6MUt6Zmig2Yi1Afd/iD0ViiI9yAoQPPYldufu0lyGMgNYsmnfNQ+4chLFeV/YkjuVjhCQU+B4hgyvyAS3u1bv3ret9t64F0GAANOHMPKRwAQAHURKWa0dAzhCvCDf4C3bZPmKjE8yXs8AEYYjfWHRTdqsctd1ChUvyAYHoQ3v9EdAuMT3ziwv9tLAoQaIQAE1qmMQlcNImZvItl9gvu93PXf/3r+NE/InCpaAasnZABqHthGm0BQd8X9FyBcCRxIsKDBga9eAVjIsKHDhxAjSpxIsaLFixgzatzIsaPHjyBDihxJsqRJhgdTqlyZUhMnlikjCJhJs6bNmwICCPAAs6fPn0AJvkKWrKjR/qNIkyoN9amp06aeCLx4+lSU0qtKXVHd2vRLgC9cnTabRras2bNkG8xMtexVWK7U0MqdS9bBzDJNE5QIG2rZMqyAk2l965RRACSEfQW+6rctYapEF0ueTLmy5cuYM2vezLmz58+gQ4seTbr0Zl8Jg6perXpTA504Y9N0IASN7du4c+vezbu37gMzq/CRQ7y48ePIieuYqYL1wZPQo0ufTr269evYs2uf6Lz7JggGPCwxE8knBNnobWbozr69QVjNQJN6K4LB28iYfT1ueiSAo7fF0EWXWgKk4tZ+TYEi4IJl2SUAGU29QIAnYR2jmX77QSHAGW+9otkysCCYoGkk/pZo4okopqjiiiy26GJnyLziHmsyzuiKJASkF1sAA9jg249ABombBTPVkNyRSBIxEwQ2urLdk1BGKeWUVFZpZUc1NulTJDnSFN4SdEiiEoE6oreelmgC9Up8nh3IlRIBMBKWMZoZg+ADFLxFDINyqTUAJyI2RQqfCzqI1ydRbBhWMZohgyAJBLxFymaDiRjKi5hmqummnHbq6aeYGpPmqDDZkVOZOIUg5G1qrOoqCjNhgOSsx7Ex0wCmtCejQlf26uuvwAYr7K9ZkroSHbIlIB4d5Q2kAKroTWDstAYlBMtnIYZFRgBThOWLMpoxRZgjASgRFiyEoqVWFFtBEcNb/r6kS5ddARx6xgBPnLuZKBS+FRUJYU2q2XxUTTFVwKAmrPDCDDfs8MOhwULtxAItAW2qrma86nICHEDrx8QNkFOz3SVEyrAop6zyyiy37BDFLFmsowIpMJFHlxffFAHMMMPXGYZcVTJADP1SJXBmBL8FRQAQbvWKvGc1kC9VZwgAcFjJQC2XoU4lcPVWsVBaNFfbdrvV0Zi56dS9ey0K8dtwxy333HSbpkyxPKPZigew5TzTChoH7lsVNLUBMq0OBBDAHjO67PjjkEcuOUl5r5RC335n/kDlBeE9o2KcAc2VCA+EVcpmdhJWQgJcuaK1WexSRckDCfwX1utoOdj0/iclGBCWVZod81h/tj+F9mVqQ0UBAXJyBQp+dUcv/fTUV6+wMsVwPuomDGRO0w2Ch6+bAcEdPisHikuh6+Tst+/++49rn9J33uOEeWwNyG/sK6Brlm1YRiBA8Z4SCnCF6y2UGNpWXIe7aRSDK0gQgBfeookGmoVrTXmCABoRlr9oRhSEwdPZNpO8piAhAFB4y+msx8IWuvCFMPSMxILiuZLZCEdlul9OBkAE8fkQDRWYiQ3Mh6QVzIQG7TkZ/JbIxCY6MTux0N9BuFQ/vzEAJjWUok8YpZlKcWUM3KrQZv63Fa+MgSqtsGAzuFK1toUFExYsi1rqtTYBxG4rFtJM/i/eYpipOeV4liEGGwkggrFRhYsxTKQiF8nI6iFDKO7J4sTsoMP06ERxDfih+GAlAA0Q8UhBmEkH2vPEUprylKjMiBZTgqwqXowAq2xPLGpIjMwsI2lcoUQAjjAnzoAiLBKiRFUsmIxc0m6AVGGELOJYl7s4hRJScVtSmEHNahalmthcxi+58oQAcNApK8xM6qjiiQgkoHlcuVQj18nOdrrTU9mLpXtk5j1VaTJwN5iJxz6JHDTkJAElS6VAB0rQJ8rTIK1ggiuhRQBJ/sSh0xJXKEhRLURWRhn7iUAEvMUZMj5FL08ZwywaWA1xUeUFAhADYY6wTGZisCn10dc0/q3JjGtik5rJEN1TNmAfcELPMsLjSgzC2KF3GvWoSE2qaGZ4UOe0AmeZ48E9NaakmcCBn8XBgxzmQJOXrOYVsSioWMdK1pZFsakFGcFCb6JDWKL1J7j8BEU7RyfLjPMt/RHmAjtjUqds645lIMAtcEcNEG4lUbxEoAFaGkfdPSWCj2idUrB5lJvWtCiGfYou39WUvjSqr07xggA4+xalmva0qE0tUmL01pRAVGT1O8BUNUY+AaABq8cBjgDy4Jyy+va3wKXSLBHy1lGcZ63oGUBrfQJaueLtFXWljBfDYkauAPIyd22KEQQQ2U8wgnyDfV0r2DgAChiSKhFkrAVf/voJMggALCOcKU6NYlmjZPcTUwjAGT8Rip9aJq5NYQQBHqDXsHhItQhOsIIZKarlBqUmldQRCmbrKiIJIAe4NY4GZrIF1gT3wyAOcXRaAdFY4hC5snEwS8Zr3WrlcTIIesRhuAK8zYCIKhrtbAYUF16oCXIrk2DAOQkDTQHQgpnTYC8lBJBYqtS4spa9aVI8aoIJfeJ5JOSKJx5AgG++hU0LDrOYx1w3X6jYJ6OgSYRlA5sB1IbCQQrBTE6Q4eIYUQBIpKGI98znPmckiiV2TqB/0koU4+TMKgHwHw/y4sD8eD8McONTQNGZv7DYuwJAzPMgwGOtVSMsJRDAfpU2/pMju9SZT4lAnrgy2ShTNimV8oTX+HsMA2Lmvp/whAm+8pgDk/nXwA52wpiK6Pmt1QFwDpINZoKAOhMnlAI4E1Ba4edqW/vag5ZnEwyNk1YU2yCleEsoPDcUySiaKyRgHas/Q7BEcegYy6AXL6BWWK5sFzGPkYkA1NtA9n7iBQEo8FM8CGVXzzcpBANjt4xha8w09xNwajJfwCzsilv84ihi7bcPwokc6qgGyf6REGgynDr7UwBuBcq1V85yEKdmldkmAbdtMteNC+Th4DwILPyblG3uB07ofEqjOaMVEbCuGH4hUI8J5dGmgMFqdyo1kh37lCgEgEN4lK/BsRIi/iP4hxjLUAbBLTPdpoxBACLYT/8wzva2u70zDbY5QTSB3AJUIeS+oYkaPlly49BEEypvueAHX9BpZVs1xl2zK0ch95s/xtvVaszYjeIoEZWNKxalr8Hre5ReDAAG/UucAJbOoGUMMgKViPq+pz6T3TXlDAHw41NqCRpiPEAE19IM9rjSiAFT4rxPCefbh0/84gPGzI0XSCRQ/AG89wYBMxGCs+XgAJHxtie8Irz2t2/Q5LuCijMXAOMbj3OnhOIgCQn7VR69n0oQgLSzb/XmX22URATADkdZwExILyBqNNcRDMA8IvIAM8FvuONvn5AAJsAVa9cZtRAATcAZ2rQV/pQQAQSAdW8BCkNnfBzYgW/XC94nCYYWBM63GxsmADgwfSCgE0zgE2HFfTAYg+7jCod3UHsQfgIAeG8FUT6nQjRoELSnFDqVbxu1FbmHFPMnZUdRCxUAPcfFf3RRdp5AAQMwavtBgEbGeopCFTFlhJO3GcJQAb/Ac5QBYJ4gAqKmdh64hmyIcWJXg/IECYZWASWoG5wkK86GAzMhA1j0gjL4h4DoMpCXfAo1czoodz0YFqBAYkDIdYHyCTEwAALXFL5WcEl4WUZRC1bQcPo3eoRSeVSxa3ekeqbWWDnheibkHwvkF58xDEDAGQ+0FTEgAObyGNfVhriYiwmmDBqn/iZapAfcpgN1iBscYwDTN3ICcAFYFIjM2IwpA4cHlQKGmHyJ+DvVQoY59YhfkIZU4QpfeInWdBRvYAljx2kBAIVoUVJbcUISp3oG+DpzhIqfIAYBoFJG8xnUdAeEsBnHUI3dBH+/o4sCOZAKdgwqVkPAaGgIMIy3QThW5WxqcCuDmBLOWJEW6Ss+AY3UYlzcdog2V42fMAaTeFYDEV1C+IiPQItgI3+XiBQqMHmv4YkMAmBigHaPSAaPgIXvqDUIuGRGEF+dQU0qIAybEW5UAUaF9BiigI0E2ZROuU7xtHGFZhNrpngCAHIMiQa1dQXTB1sk8xwXGZZiCSUTKXfg/pc5OvSVxKVi1Ugu7Xh+A3GEVxGLgRJpWyF8mgeOR8EKQDB5WIiOZtF0Z+B7j8gApCN1zDRHh/IUW5Z29/gZvyADlLIVZ5AADIBMWxEKG/iUnNmZiaQMyPdtU4lcspWVQSQANzB9DkIH6Jd9Y/masEkd3icQN4hcAaCW3/ZwRjeSAlFugBFUgZJud8mSSSiOgUBwfuEggEkWwFkYCZAA3RUo/dE9WchMx7WYT/ECA2BIT8YZboAHF7IVADhkhKGZnnme6AlDygCaGxcGVLlWgMOQIDBnceBs8ykALQiWsbmf/GkSGhlLhbhWYkJ+XxR7VAGXJokVjwhx3HWgrGiJ/uDoFxpAlEghestpelQxCVyGgYHiCAPQJamghdjpFEvDofwFGh3wC5hYGcWQiBXINEq5mek5ozRKN8SmJf+ZEu5ZPxE2AHc3jDUwExbgbHgQpAHAAtVCbf25pEzqESSZfB6AXJBAMTl6EJmFYwxgSKQgl4BhlCKicA6qdRFaCyqgFBZKF9WQiGeYUo+BcyiFmKb4IGwUAKN4op4xDB1wcJRhDGpKAkQlKUxZo4I6qAujDDe6XFvAbbV1AgyJjAIwfUoSAExSEErUpJZ6qRZRljZHA1KafFf6FF4he00howj3iJ7AZGOjTkgIjtW0DHXwBl+onHOhjlQxi6K6QE33/nqwUYrrhWpU4X4HY34Npxl3gAV6KhnH0Fz9gW+SQqjO+qwPY6iI1gVqtlZLoDg+OoxVAFt7V2e2IgADMH4/iKnkWq4R4X2tIAPIpQfJd26fQAG1042TMYRESBWUJqaXuAwqgAmxun9y4X9bAScAyZifcC3sRxUJAKe9SkdcsQGlQxXr2Rk2gAjHGhjJuhXdZALA5xRcCq0e+7GawouHilYBilyS8CwCYE91CH0CUAXT1yVTKhB+aK40a67eBwNrFQDs2njuSgYKRBUJehUY9YhHIAACd6+ryqrMIAwK8IXJ8AA6MW9nQaugGgBJGRaewAlhh2tNgYWooIXyyB8B/kcVlYYMCoAMD4qs1YiUG9sUQQiycBu3LnI3KrZtKHabW6AT2VqHGFAk01cBitNhAlGzhGuzyccCObuzcndpXKGdJtpfkuGl7ZdfHKqqEHqJhOACV3GmZpEMzeWzETCJTuEJlCACqxB2GMoVOsl6V0dd+jVpnmEJKqAMFXsVxtBcgxkBmOkUoJB5cvu7wFsiyDCy8kRP3oM5t7kJzzIAKut8dzh9LaA4fOgkhVu9mJp8I2CVOcQ4yUcYj0AAqPeYgZGrWFs1KWR+xHmJQHAHSfEXsloWdPkUj/Ccu9sUL4oJyfAXIPkJWMir/XaKYdFHRYO0m+EEaxCOgNEMucoI/s8ZdPbqu8EbwRIMGtL6VdTCqYYmJlZwKz/qfDmgT9M3BDoRATNrvSa8pI3HN35zP4tjQ/Kzv02RX+34CQ2oFKm7H54ga8HKX9+otMqgALbQvvHmr9NQDYo2OxeYgWoVAKuQv8vwqU7Rv/23DHxCL2GbFwuIvp0BAZiAwLYLxZ9QgQNgopMGwZuBDGY8wWoMretJvFqkrqiivQIACK4wCiw7YSXokAJwVd56Kyf8x02aJlXKEhmAljdBB5rKM4OsEjWMKUqrtBW3CgbgtGtcyZbsKeyJVjhraIrrfYD8yUs6XN9GAcjFmrOpEh2bKY/MqhX3BjZAyZccy7LsIqEp/k+Iy8mnDMq6zJ82d1wLFQadc8q9qX6dssp6GWzKoAJuMMvM3MxzixqLPCNqdbedvD9o4pq7nM1iyYiIhrK/nHyS9Aqk+iLG3JLITACq4MzqvM4nYgzR7B5oeLfX13jaXM+v+c7TolvfLMwFEbSbUs7FGWyZMAAUx84GfdCecQz43B0naJvcu3EyYs8SLZY/qGK1tVBcwM8EkcaqDNCbJ2xv0AEIPdIkvRkVLEWkbGimXGwJUcIT/dLMuNBpgmJckMjJ97af4tEfHWwtYAWwXNJAHdRHkcn6o28ottLFBtNKbZEq1gootgUyzTn8wzA6vXXA1gwEEAhCvdVcnRTY/hPVP4GFKGYGG7fUZt2M3NxUMpJmyNUFGp3KngLJ6Vu7C4YJAlALXZ3XeT28FoxFLEEmyBUGYF0tgka9Z33Yf/ikNrLIpVBFmKM+qjHYrAELwwoqco2vdK1gb3AAP63Xnm3QtcwzFx3YhU0xiH3agLhcdIdc+TmblO0wl520SvhrKmADn33bQq3Qkn0QsEXTrZUaSorawg2DNXdQq71WrZ18rw3brCzbnEdmy2AAa4Db1F3SyGBmu00QM5fRvz3c3h2DbxUJclwmS4B+iPYKOwcxsR3QZLYKApAI1R3fI+3OFGMKMye4aBXc373fhIdWkqA41koqu53e6t3cNrXT/mT2BwLwC/Ld4AdNDNm9CfeNVtjM3xbecrOU3T4BCQAOYZmTZ3K33AV+zAdu1WO2DFbA2Z3t4CyuxsfgxjPScdzm1k114TauffKkBx3uSiC+cY3cMOs9fycuoS/Z4kbuzPQ9KseNYsmtRTf+5ISn4TBRm6fCo9Pr40eODAKgBUfe5cysDBCeJuLNbU0uP1B+5oO3SqNp5RCN0w5u137g5XIuy6D5cjMigu9ZRWVeOWje54JHIzZiBih25QdFbtBV2Q3uBgLQxHPe6JZc59Esh9xW3mbu55bOchWdNwmxo2uFpOc9zvENBAMQqI5e6nB73YsMCDPX4zxz6a7Ocmmd/jecvlCe/tvWErFefgEZYOq8vsZ0m6M6zm2sbniG/erGbm29qciJilwp4GAkRnuI3uBa/oq9Xu3BuwwMcVZwuAfjHcfDLsiDe+zijm1S3ptSgGIjYOvQ5eh2Pd3W/u5w6xcOQWJ23hN00O2oIgOvYNOR5Ar6Pe4A32eKTS0l60rpTuHoXdBefgcCsI/w/vBsjO0QUdwwEQZyPN4BEAP1PiMtHfAev3I0qOF2u1YbIEWG7uZejuKLvhjCwOAQ//JNeQwUEfIsYfHcBgNp8u8fv/MCr+HG60ol31SwsOIsrq8CQOqFQOowv/TEZwwXkeEpsezV6kq1HtkIxfNYj+nP/qUlMoDvbCZtWpQQKD/ny4AAECAZ7Mv0at+GxbAR9E4QecttzUEjMuLSWX/3fjbwGRlocLxQAQD2UrRz0Z7ytSAAmhsYwpD2a7/4HPgRrQB5TOD1OtLsvugKdo/3mF9t/L4Smz8Qt7xWOxP2/lzq9sflgUEIQcz4qk98I5G9K4weB985G98Kl5/5to/sNNQTn79Qk6o/xbCegz/nbxAAd9DZWkD0q5/8C7aeIxF+ItCbxRILOn/71D94pJAQ7zzNa7U5Ar4S/KP0cw4EAZAJgYEMTrAMK6r86v9rMi8Sd0sTEFD98l+RFM8eUYpc3M8SC43eoG7qHTAAAFEr2UCC/gWTIcLDjJlBhg0dPoQYUeJEihUtXsSYUeNGjh09fgQZUuRIkiVNnkRZ0BgAli1dvoT5UsBMmjVrBrCZM2dMnj19/gQaVOhQokWNHkWaVOlSpk2dPoUaVepUqlWftnKV9VVWrl29fs1KQedYsjQVgEWbVi1aWMdSvoUbV+5cgwYINHuo0IlAun39/gUcWPBgwoUNHzZZzGlZxmUDWIUcWfJkypUtX8acWfNmzixjvQK9Vq1Ymzgb6zwrWrXqrQDcIoYdW3bEXwIgLHu4bFkI3LN9/wYeXPhw4sXpPj2d3GZn5s2dP4ceXfp06pyxbl3d9UFO08ppEsgevit2Vy6N/p9HPzKTgBYRbe1IH1/+fPr17d+X+LS7d8aPq/8HMEABBySwQAOHikW8rBrgryzwFEyLvK5ieg0/C+PT7Q8BfoBoGTfquDBEEUcksUQTL1oGuQZPO7BFF1+EMUYZZwTqOgkjVGDFsQaAMK1WQNuqFZ9OJDK2ZawQ4I0OVViltyKfhDJKKacE7BgVdSyLRi235LJLL7+sCivVCMBSpx69wg60WIKqkEo3U1qmBQECgQgZBZpx8k099+SzTz1XWqxMssAktFBDD0WUxh9dCW08V/bbb8UzHS2PKD8v/egCAVTJ0yBLQsA0VFFHJfU8xQIVNFIBEmW1VVdfhRUzUtBs/kXVMhNUEDSskjKmVF8fUmamXzotCAstfkU2WWWXNQkqHW2tKVZpp6W2Wmt/4moUQXMaRbStQnslljWZYhbZWmYitiAN6Cy3XXffhTcZZ7fV6Vp778U330LpralbtEJrRVypiok31EsEcACiYQbgq2CHH4b4zXn5jVZfiy/GOOPqKJ5pk6+2IkUyvCLWU8MOICqkgXRJZrlll+Oz8kqOV9W4ZptvxrmqmTkj5uUp1wgAvoesUMFno49G2reYUd05Z6efhjpqngbguLM2kybxBwGcyK0DLVbGOmyxxx7pVKarljpttde+GFodmSN7RBWSfEiYAfyIO2+998YoqlR1/vKPbcEHJ7xV5dyumLNe+bYPAgH+eMgSAVhhvHLLK/d75pkK57xzz7UsTdDmRr4cvWaoRuShNQZApnTXX086c80/p7122wHE0tbmCIa9OFxmWoUghRRKZhkVMug9eeUfbkb2pm+HPnrpL3ve6uWDU2UmXIQfvngFhL4+fPF/XfpsiqdHP331J+b3ufFlW6aQmVofaPiFzk3jff3379Ns89tfXwAFOMCfVM96/CvMMu4ggAE4yX7LCMScEDhBChZJKg1CHE0IuEEODpA/GYQO6Srol2WsQQAK0E39uockW4zQhS+sj24uqDmaddCGN7ydATvDOxjOZRlOEIAECmK//mScYAAi7GESlegbGToPbTiEYhQJ55gGRYd+S3zLDgKggSEO73TIw2IYxWiY5jkvg96RYhrVGLXZRWeMKOmAAIrGPYWcywVvxGMe51K+/9HkjINaYyAFmbE2QmdxegyJ42TQRYUQIgBWQGQkJRmSZQCKfdvqziA1uUl7ue2PAtjPdJA4yYxQjUN0ZAbQQERKVrayIlOhYQ05OUtasuqDjaGOKzMijJlAEpU2CEAiwKZLYk4yRTPEIGNquUxmEqqQ0blaMSFiC1DmD5UQCEALpbnNVh7TiedrZjjFKaNnupGbEVmPANzQEGRQDRnDPGc8lcjHPt5kRePEZz4LVE7o/vBQngYhxEzwxpBVCKABxftnQsVIz6bEUp8Pheh0+AmdaMZTNwsUACEYsgxHnkyhH12i/2T2xIiW1KSZmSh0QKobNswkdQZZxhsCcEeQ1vSFyxBpQwG3rZP21KeTGUAAhArA6vgzoViYiSUaojUnpNCmT50gLB36U6pWFSpBJSl1KnrOIcwkERs9Ad0WAlWyvk8ZUqWhVdW6VqRoLnDVASkQvNqQAwQAcmXFq/gYypTG2OqMbAVsYAuY0n5+1AUz6QRDkOHSvDZ2eZa8ZFYFO9nAulVAW5Xm3ARgCacyYxnnEkDwHDva1+VUp2mlbGorS1hz/jOOArgEQpPhWckJ/qBhpMUt46gSS1mq1rdUncknkzMgo3IzAzNRRRf/IFRh5Na5fNvtVH87XZ+i9rL/dADwumjCBj7Xu2Tz5jfBSV3yltS6AoInK+uazS7+IAAPcOp35Xu0vfI1mSwqb371aVkCFbeYoAzA9rjXgi3O18BHg2xkJatfBtfyvNflZjNoIuCB6EYDAfDogTXMMtOe9sENBjEnPxyg9EZyGDQZRkF0o4AAtGfDL4aYzngbYhrPcsQAIkaJ87iM2swkxQTRzUzAB2Miv0vGVAwdfmu85EB655MtOkZ8XQnaATQXyLUJwCmLvGVm1de+0mVymKN4YxLr+I2gFYCVK4wJofqS/stvRpaXl8Lb3orZzhwkc4CkyYuZVFnFiRBqFuA8aF8lWMHjvXOiCZhnABnDzGKshVADcMWBYFRJhMZ0qKxCZ0V32oOsDVCUdRlp5hrEhAJYZaZVzadNz9jTr04fo0k8appQOhlAFIAflLFqXrupjNEFM6yFbbu+VjFGtAalmovnAqESYte9hjaU5DxnVw/b2rR7VpZi1CspIxLNyk6GBpL67GiX20Qdricmr71uz8n6uuSO5LcN4jgBYMLc9y4RMVodbHb3W232pBeNlgFvb9daxWQKLb4VHiLICPeD/ob42tw9oEf3UN4EWexMbrtwjs8HMrx9a8RFnrOJU3yS/mim9C9M84uOt1w+06Y2v0c+c0KC2kCH1KMyUF6QVeAkAKN0edCDY2jx8ivkNEe6xQ6nHC5hNox8nomyazsAoVedOJHhdNK1rnSbH8jpS/wdKCkdUAEcwOpnBw7WY3n0rbedWtzhaZeOoQy647HHaS6IH2YCAbT3PTa/PnLJ3T74fXW9Rbqp+xgzLgBKa0gAYPR75AkD85gLnvCX75LlC0RwMVIN7xWOA04yLHnS/wXdI9Uh5lVvKIplEkwVn2B2P1+8N8xkjqXH/XHULvPV995LTvajtr+UY9jvjwNRL4gJZ5p75stFMln3ffS/pHkD+VeJcpp9MrIASiA03/so/gF84A0vffLvc/wvcnTxxydXxhdECzPh2vflPxLKV/785cf/f6jvdfWLD0nZ/781mL8BBInTQ70Fy78EJJD9478wOjVK+79UI8AJzIjJgD4FxMAFvD8Y+ToKwihlw7WBosARrIjwE7/Uy8AUlA7e+5K5W6IIaj+C0BoBeCkStMGIqD/7Q0EV5MHmgLu4SxRbe6HaUrYZTIUbRMKHMEDUczhl6sEnhA56URVXeackKqgYHIgZ3Lgk5ELKMLp6gcIwZA4WJJQO1J8eA8Fk48I1JAgvrDYxhEPMIMMy7L/XOR0ARBc2XEMTPEEEjMM/3LdiYzpYEUIKyi5ls4IAOCg9/uRCogM2BgTESCyKOSyUKKvDy5kbZXs/Ceg2RqTAyrhASRRFZNpBRClE/pGrHxuI7bs9T7RBUHzDUZTFdCsTahE1CiohAaCwZDAhmnJFEszBL4PEWSRGl/jB4HobasE5BNIQ0RoIN9iaX7TBJTw0ZKzFYsTGpKBERHE0CkKEALA3glggAZTGEbSMUMzGdAyKbeRGCoo0pSKICLqDcjRHWOQY11PHfASKT3I4eymGsdKfZVgsjSKIRBAAYaJHAgxGYdxAfSTG1ksca7G+8HGAuxqI9TjChBxAaqzGgHPIj4wJvxIdfEEgFZDAVAiALdRI5qOeFfkjkIRJYxzG19sf/ie4tIGohe5aye8LLwuMxZh0SHZ8FaBTHjcQNIIQhkXcSe9zxD70Q6DMRqF8lVPsHUQ4loIYvaXEvZ58PnSESnWUylcxQ8upBTfLQq1sPq7cvbD8SkBswuHCmLFknGa4ygqbR7TMvYVkyIZsSzhky1cphk58nXUqiEzAy9zTt3P0yr4sxp/Ml8C8nho8TOZTy7WcScZUQUE0No0RzMsBt8ksPb3cyy+sM8x8yL+MFaqsnEsEzXtrykDMHUAyzWx8S59zDJxBBs5rzd1EFpRazNkUxbXLmWXkzeIkFdEczacETkAUzpyBTNY0zui8EJzKjLdEo+VsTBpiu5rpTOn0/s4oqUzJsM7rxE5ZlELuiJrWgc7vZE/0QE6mGM9BLM9RbE6oucX2xE8i4Ui0csz5jMP+vBnizM8BtZDw7Mrf9M8wvKXT2M6cIUoChdD0WIb3TE7NxKUElcT+wBK2eaf1jNAP/QsDPVAAxdAn3KlUERy5BNEVPQw+rIyhItES5cEYdU4PZdEbNQnc2M9HRE0Zlb579KPCUU0cJdIQFdER7VEf9T0afZr7LNInDYzX9Mm/kU0lVdAkxRgBhdIthYsjRdLLtFLCG4v41CDPGTguRVO4oFBa9MgwhUImlRoVTdM5tQgv/dKZMQA3vVIwxRjITDw6BdSNQAYfpLPS1FMM/lxQJaOdMw3URkURO73TUjxU/IPTtbFER8XUiXBROSzUSe3BSl0byMzUUXWI59DQkfTUFKxP6KlCUnXVZBhU5yhUQ03V8gNVwenGV8XUJpLVTq3VDDzVe0ofG9XV76ykKPTVX1XAWyWcXC3WOT0rZEVQZe09l1RU9CG+Z91S3KBOaWVWat06TBqLAZJTbWVP3YhVb8VScB05siBTWpWeHDPXIoVUxTxGIGRX8gM4oiLXeb3Rbo2OWc1XSl1XwhFVf4VQZVhTp1TOgR28b62dckXYw6zXlpxWh3U7iK2diZzY4qxYi9VYjIW4RL1QHNLSjt1NKe2Mdy1ZkVW9MgGh/iiSV5TdTW5NV+oQWJddvYvtV5oFTbr7WE7lWZ2duaEdoIH7U59dSgHJWaK9PKMdIGNQBmJV2u/b0c24L/l02ocN2fQZ0qrVw4Wd0q7dWliD2g1yVrD9RbEd24It2047Ww6SWLWVv6DF2ths2bfVurjloGJ4ULolQQNpWr3dW7IVoJMF3AlMTA3kW8I1W8Pt2cQlQZVdwWR1XKQj2bylJWL4W8klvd5gW3tFsmS8XMyFXLT13LpVWBcZ3NJt19OV29RNS7sl1MZ13USzXSnqGdndShhp3dsdWdi1IY7l3Zab2hj5XeDtt9xdI8Qt3oVThqsN2ORV3nVj3kByC6p9/t4DA1jWpd7qtbbrDaSZ3V6Oo1zcEVfhA9/lFd40ct7yxTTdOF/0tdz1td72VaO5hd8NC13OYFnNtd9hE19O0t/9la/+5YxZhdcAhlv8FaTONWANGzgETuDvZeAGduBA8tsIhjMKruD6veDHzWBBOlgOfjEP/uABDmHqAmG1el8Txi0UTuExxdcVfrUWXqu0heHnkuEZtkZEs2FPw2G2KuAdPifd6GEf5tMgVq0hBqwiNmJpSmIl5ksmLi8nDiwojuJWmmIlhlF+GQArFmIVhigt3mJEWt3CK43/jUgxtjMspiwzPuM3ml/fPVEgduMwg+PUkuM5DilEUeAFzuMG/ttj1erj6dRePwaO7lXjQh7kK+atMK6xQ8aPRFZk+FmGxT2UQH7kNybjlsgJDjiEaSDlUjblU0blVFblVUblXaACz+szKtAFVjblHAhkx5AGWtZlBhFkAKAJVNDlYJa9cCwI9lMOB4iDXA7mZWbmVH6GNjgAm8gBYG7map6GaIiDaK4JFRAmS75khthUMOFk+q3S2gVDpThnmLAJH6AGayZlabABYbVhR17HnFgBanbnfGblU8A+mnCANoCGZn6/W94RfS5lXq5nAcBngx5mhvg/hzOANIgGg6boU5YGQaA3mgiBQ2jnil7li87omdCAP4Dgb/YI2rVjCzbVcZ3e/pmggkVYhLDaHG2siQswgDKVCZoYAEHQZ5kE4BWmZ5/IiQGQZY/2aGo4BHGraUFQ5maeA4IeCwmoaIQGil/26OwCR4aARndljBy4BaOuaKRWapq4AD5oarA2ZWo4BZmmiQZYg8806Y8QSFgZZ6bVaZydCQQ4AQlYjqOwCQOIA2owhMTJCQ3IhWru5Laame5o0KHIiQOQaLQ2aGiIA9mjCRQ4hY625kGAap04game6cFS6KtmIGImCL0TFMyWbIO+BVuuCcie6NU25db+ayvYxbj2iC6WKAUeHPUlinWO7WnoKrIwAD7QbFpObB2UVNEma7OWbXd2hjS4aZ32aopW/oTOzokcAO1epolTIG1w7JTa2pYMEITjfu5l3gUtgGUG8oHDPu9peIY0WG8DaAFOwW2OONZYqWu2yYk89eua0ABeQOU4mO4+KzuA1uXkZlOYVeya2Oj3rmZe8IH1PgAtsAaPngXstgkq2O6EXmh9zq4BMO2BwASOQeaAhvBlpmxtpgkV+PDVhgY+YPGZCIGvum+MYGRX2e9Fq4kGGIRVjgY+yIEiyIE0yOxVVnBStLyhzgFZSHFmRgUUsIkTB2tr0PCaaIMOr+qZ8O6KbmiDUDk8pYILf3JdvugKWG8OGATzlmxqGAQNWO8JqAO4vvGGCOdEUWBJ5nGd1gIU7+kk/ufR8csJAhjzMjdzQeDrmlBzNqdoabhymvhxiqbqwQqAF3dnrB7xZJAwGhqAHBBwQ6fltZ7yZH5vtdastl4DVaxzO7eWHV8fm2iBWXZnQI9UPI6JnPjn4Ab1VIaGOZhxOepy2V5v7F4ELRdtS7dm2eOUTvn1mTkBjt71VeYF1/6OyH7vXHjlmiCAH2ghb5ZcJL4WV0cfm5CAUUZsWnfDGM0JDGDqaFdlXdCCAhcAAxCCr37vkMbuWTB2oeZy0haAQtCN+DquQsUAPzhrdy/l6Jb3Trf381Z4m3CBTI9r3Khj1uPtV68JwGZ0Vf4JxEF3mu5PnVABRUD4VKbt106D/meA8FvwgUefCVk3aAQIbX4fbS+f6fQjiFMPPs2B7ZI/Zcrm5RYn+feOcQdY7w7wg5I24mUAhnsRd+ixCR5QeeTecrj8+N9GRyZveJ+fBmpQBLaeCWQ++NWOcpenibG35kmneWSvZtlziWLoUGN2q6Euaq4nZbG2iQso71I/hOOrCQmIA6Xn4Dun64ufHpvoAH1HcqHYEQngAA2wbJy++oTWTp8OLgPQAmew+3dGdMSH9vOWBj+oALOnCQPwaLXvie72dwr5P4IegBoIdrtHhRUYdT9/blSI59e2gmFR5IrHc8OH+h7naVT+b5o4gCo4BM03ZWn4esmffOZGLVyf/gO0d/dn/nUbYHuj7vUcIX3jP/2ZT/2ZyH5mdvuYGIErf/bNJ2VXtgmiJvPzxvb1HgBuBzJv19UcD3fgr52aGADMt310BggBAjssojbtIMKE1DoIBODwIcSIEidSrGjxIsaMGjdy7OjxI8iQIkeSLGnyZEeBKleybOny5coAATIIMpjwJs6cOnfy3EVlwMoBVHTxLGr0oC4tBlo+hOn0KdSVF44abdAQo8pTVIs6uDrRZYCoYqE6mCNtK9q0B5+lORA0hyy1aZ+1cbuSRaJkyZbp7ev3L+DAggcTLmz4MOLEihczbuz4MeTIkidTrny4GcrMmkOO7exyM+jQor+u/myxa5pJlQYGHaXWVcDo2LJn065t+zbu3J53l0Yl97dRWTlYHmATDTjVWcOZQuTtvKWBE8gRvs6o0vf0adUphn3ufaWBNMezk4fG57XKEIfI85QmCAJLDYH4Wq5v/z7+/Pr38+/vP/IyyxyTG4EgfTdWgQnexlIDWqCkkgOnGUUNDyopeCGGGWq4IYezHQjVAD7kwl521ByiQUwXCHIWiThRswgHn0n04XM5kGcVbFgJhN1025FGo3PdhXhLi8iZiKJUfthUJEImxriSBG4IE+B/VVp5JZZZarnllQEW02GHQD4FJpkirbTZdUfdwpBXZbr5JpxxyqmZmC0dIB6T/r+Z5wBQKp2wXp4ISeOHBMxRVKdnVNzYZkVpZufjjDB1h6hKP7yhwKQCoKBVoGrJsgNxeHY6jXLEWYELl6mquiqrrbqKH2ZzJkipjLLa6pCFaAok4U6z+MDSrcEKOyyxGdJaFoujUsXWUivtwIuydNl15kW0ipXGojlWKxCnPTLanLVQvZEMMnEUupIGNSm7lU/NCiQUUaPuolRQO6jyKr756rsvv/8tY0yxtoVLbcAFcybQAXPwupYiaVxgqMERSzwxxY3W2QGg6x6Vy0/gUWGNshz3SfC2A8PER7bW7UgepBFlajJLf1C5TCIhsORAHNBofJS0LOXQbaDRzIFj/np59Xs00kkrrXSsFYcGs7ZOSx0RSwM4cIEDBLw0Ndddew2nmC3wuDNPp7TAEgJ86DzqKUXUqjLULQmSso4CAA1cyxC9HLcAiPQV4DKY7DCyAAdo4QzZRbmHnkAcHLJknu6dqxIHfzRjGH2MZd4lf5tL5rlgVBIGOuerek56vqKHjnrmAQ749YMww841grPbfjvustFowMeJ82RiBixh4Eeyeb6IJMkb8d1Sxr8ZhCPcd7eGU94P7R13Kn8DnkwtVrgr0A5E+r7TKSjcbFaRkE+DivkrNZDFMKM7prqV9N+H+vz4+6X/Xo/xn5j9tES/AB7mf4MxYOgKwzr6NONL/rkbCdQeWDGnSLCCFrxgSg6kgTbwoQ8e7EMHPRhCEH4whCMcYQlTaMIPlrCDfKDCtARyASrwoYYnFGENU6jDG7IQhDCEWAaXpxIqiHCHRdQhCG3YLLjR0IYs5GEST9hBu1TkelALhCWymMVLXAIRXCQEEL4nAA3MAYc2PCMSXXjEKJ4xhyQ0Yxv54IMYCsAALZhDHFeIwx6SMI8mfKEYDbCDQHBRi5fYoiG1qMhFIpKRjtQiIixRyEdS0hJe7OIhFXHIQ1Zyi4i45CIvyUlPSrKTl/QiI0dZyk5yUZOWTCUoTbnKUm5SlY48JScjqUguXkIRiMjEL1PpyC4+kpi4/qwkMTeZCU3ycpWRtGUWnwnNRFJzi7UsZiRxuUlJXmKZi7QlJwvJxUJg0ECyKyc606nOkgmxne58JzxVMikrOodwNKKnSuwZz33ys5/4FMjL9CmAeX7nn/2Mm0DrJNCEvus5CWXogfoEUYg6tCUSDddFg7I8itZTTAY9KEhDKtKRkrSk8Vyn7kyq0pWytKUufSlMYwokji7vo7yxqUwBCpac8rSnPv0pUIMq1KFuDaWxcYkYXxJI6CAVJklVjVKb+pSnCoSqBngqVZnq1Kl2JqtVHYtXtVqnpFqVN2H96lm/ylXwOKdZZfXMUtIq1qjIla1djQpQBqBXoBhgAATY/usADNCAC0BAAhKAwAUMq1jDJlYCiXVAX/ca18COLK51BKxeJ1tHt262jmglq1M4G1nM/hWwV+3saVN71bhaNrUOQOxiHavYxso2sbRlbGxtK9vF3ha2uGXsBXTL29zOtrjCLS5vg4tc4u72t8yt7XOdS1vCHte5h53ubJV7WwlUYLGIVa51kbvd2EZ3vL697XibW13fLne62o0ue7FLXe9mgLbfxS55G2vf9Oq3sMGFAAQU0FaoStUz9szqUgkc2gIreK5bXfCAPQthCa8VKm9lyYUnjGG1VljDHW6wXdMqV8uKRcQgPjGHUwwVo7K4xS5+cdeKcbkCgo50AwyQ/jL8oowc74U+p+OxXnacY9HtOMjK4AsBA2NjH+t4GUBOxpQC9IxmBGhKeuFf63zM5P1trnV/GaD2rrzlMP+NzET+y5H39+Ua11jJXV6zmsUs5/5xOc49nvPp3lxnOKMZgQH8s5vtPOcrm3nMg6bznROdZ0Enes+OLjNgAPc6GFO60pa+NKYzrelNZ8YYCJxfkQs9aCc/WciAi4aQjQy4TytQx6EWs+hWfehI2xl/XTY0ocmMaC1/2dFebjSw7WdjADIa0Y3+tZJ9Dek2a+5+xJZfAnPN7FEvW4EGHDZimsbpbXO7297+NrjDTbFiHAPJkH5VAJ+8tHWzu93ufreS/gEm7nnTu972vje+8x0SY8zY2K0CNLwDLvCBE1xVyNA3whOu8IUzvOFG9TSSWV3wiVO84hZ3dwMdrvGNc7zjHv84nDx98ZGTvOQm59e/QK7ylbO85S5/eUcg7u+T07zmNr95Y4o8aZjzvOc+/znQ711unBO96EYvOuCCrvSlM73pTl8nuY8u9alTfeBeejrWs671rXO9WOTeXtXDLvaxm07eXT872tOu9rXTphjIoPOOJU72udO97gfcOdvzrve9873vEiF3qu0u+METfjB49zviE6/4xTP964V/POTFvuqDM77ylr885lUu8shzvvM1j7sDMy/60ZO+9PMu95Hl/u751bP+30FGRuhNL/vZ0772LS6G6luv+9136cjEsD3wgy/84d/OGG/nPfKTn6pl/J74zn8+9KM/rKgrv/rW188xYi/97XO/+95XkMyvL/7xLyZAzf8++tOv/vVrxu3mJj/846+Xw7O//va/P/4pYow0y7//vKcP/eWfAA4gAaKf2/kfAq5eyhUgAzagA25fMUBckiUgBR6dky2D9j2gBm4gB86e8eVeBYZgwfFFAHagCZ4gCjKep6mbCLYgyZVgCsagDM7g2hHD/oGgC+YgvixDM5gdDf4gEAbh2RHD0OmgEa6bgAihEi4hE2Id9R0hFLreXsBeE1ahFV6hzxlD/hFGIRf6x+bsGAxioRiOIRkunA0eXxem4X2E2jH4YBm+IRzGIcJp4fupoR3mjxvKoR7uIR+Gmxb22h0GomAoQx72oSEeIiJm2tfVoSByYawlYSJGoiROYqVFYL/NXCOKYJWdHyV2oid+IjoBA7/hYCYin4BwIiimoiquIu5Y4rmV4vg1wzGgIivWoi3e4tQ4HibCIuv1IC7+IjAGY8VEIDKQIi9OXRsKozIuIzN63TG8Hakdo90pwyw2ozVeIzbOySJKo9ENUPZlIziGoziSiTH8IbBxI8XxWOohQyGOozu+IzziRgRuYa6hI7zF3TfGoz7uIz/ahg2WGyPaI9NU/mM/FqRBHuRoEOMECmTplBk7ZiBCRqRETuRI2KDMRRxD+ouPJSNFdqRHfiRJKGRGds5DgqRJniRKfoRCbk/gjaS19VgPQmRKziRN1uREzCMyDNkrluKrCYYsGoNM2qRQDiVROkQxkNsWYmQg6uRe/GRQFiVURmVU4qQxXt8jZt9TSqVWbiVXziNAfllPSh5iYBuSIQNWciVapqVaZgQxRCAd2hoL0pyfZVkbHuVa3iVe5qVGtKUWHgPqJVtV6svMAKKA+KVd6iViJqZiegRf9iUyUFnFLQMymGU5FgMtLiZmZqZmigQxNGY5+uVkPibYdU4zhKZfliNQHuZmriZr/rama74mbMambM4mbdambd4mbuambu4mb/amb/4mcAancA4ncRancR4ncianci4nczancz4ndEandE4ndVandV4ndmandm4nd3and34neIaneI4neZaneZ4neqaneq4ne7ane74nfManfM4nfdanfd4nfuanfu4nf/anf/4ngAaogA4ogRaogR4ogiaogi4ogzaogz4ohEaohE4ohVaohV4ohmaohm4oh3aoh34oiIaoiI4oiZaoiZ4oiqaoiq4oi7aoi74ojMaojM4ojdaojd4ojuaoju4oj/aoj/4okAapkA4pkRapkR4pkiapki4pkzapkz4plEaplE4plVap/pVeKZZmqZZuKZd2qZd+KZiGqZiOKZmWqZmeKZqmqZquKZu2qZu+KZzGqZzOKZ3WqZ3eKZ7mqZ7uKZ/2qZ/+KaAGqqAOKqEWqqEeKqImqqIuKqM2qqM+KqRGqqROKqVWqqVeKqZmqqZuKqd2qqd+KqiGqqiOKqmWqqmeKqqmqqquKqu2qqu+KqzGqqzOKq3Wqq3eKq7mqq7uKq/2qq/+KrAGq7AOK7EWq7EeK7Imq7IuK7M2q7M+K7RGq7ROK7VWq7VeK7Zmq7ZuK7d2q7d+K7iGq7iOK7mWq7meK7qmq7quK7u2q7u+K7zGq7zOK73Wq73eK77mq77uK7/2q7/+SCvABqzADizBFqzBHizCJqzCLizDNqzDPizERqzETizFVqzFXizGZqzGbizHdqzHfizIhqzIjizJlqzJnizKpqzKrizLFkxAAAA7\" style=\"width: 1041.2px;\" data-filename=\"Equestrian-bro.gif\"><br></p><p><br></p>', 'package content details', '1637049417.jpg', 1, NULL, 'test warranty policy', 1, 10, 15, 10, NULL, 1, 0, '2021-11-16 05:56:57', '2021-11-17 04:00:47', NULL);
INSERT INTO `products` (`id`, `name`, `category_id`, `subcategory_id`, `childcategory_id`, `brand_id`, `store_id`, `video_url`, `short_description`, `detailed_description`, `package_contents`, `primary_image`, `warranty_type`, `warranty_period_id`, `warranty_policy`, `package_weight`, `package_length`, `package_width`, `package_height`, `good_type`, `status`, `featured`, `created_at`, `updated_at`, `deleted_at`) VALUES
(247, 'Black Gym Summer Tracksuit', 16, 60, 180, 33, 29, NULL, 'Black Gym Summer Tracksuit, 2 Pieces Suit, New Collection, GYM.TS-1 ,Suit ,Motercycle /Track Suit, Jogging Complete stitched Suit, Shirt And Trouser/ Ready to Wear )', '<p><span style=\"color: rgb(33, 33, 33); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 22px;\">Black Gym Summer Tracksuit, 2 Pieces Suit, New Collection, GYM.TS-1 ,Suit ,Motercycle /Track Suit, Jogging Complete stitched Suit, Shirt And Trouser/ Ready to Wear )</span><br></p>', 'Tracksuit', '1637068149.jpg', 1, NULL, NULL, 3, 2, 3, 3, NULL, 1, 0, '2021-11-16 11:09:10', '2021-11-16 11:09:10', NULL),
(248, 'Swimming life jacket', 16, 58, 174, 33, 29, NULL, '7 Stars Swimming life jacket Medium', '<p><span style=\"color: rgb(33, 33, 33); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 22px;\">7 Stars Swimming life jacket Medium</span><br></p>', 'Swimming Jacket', '1637068608.webp', 2, 3, 'Damage item not return', 3, 23, 4, 3, NULL, 1, 0, '2021-11-16 11:16:49', '2021-11-16 11:16:49', NULL),
(249, 'Cartoon Kids Plush Backpacks Mini schoolbag', 16, 60, 181, 33, 29, NULL, 'Cartoon Kids Plush Backpacks Mini schoolbag Plush Backpack Children School Bags Girls Boys Backpack Height 9 Inches and Width 8 Inches', '<p><span style=\"color: rgb(33, 33, 33); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 22px;\">Cartoon Kids Plush Backpacks Mini schoolbag Plush Backpack Children School Bags Girls Boys Backpack Height 9 Inches and Width 8 Inches</span><br></p>', 'Schoolbag', '1637069213.jpg', 1, NULL, NULL, 3, 2, 43, 2, NULL, 1, 0, '2021-11-16 11:26:54', '2021-11-16 11:26:54', NULL),
(250, 'Baby Carrying Belt Portable', 16, 60, 184, 33, 29, NULL, 'RSS Hot Flash Sale Baby Carrying Belt Portable Kangaroo Carrier Backpacks', '<p><span style=\"color: rgb(33, 33, 33); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 22px;\">RSS Hot Flash Sale Baby Carrying Belt Portable Kangaroo Carrier Backpacks</span><br></p>', 'Belts', '1637069462.jpg', 1, NULL, NULL, 3, 2, 54, 3, NULL, 1, 0, '2021-11-16 11:31:03', '2021-11-16 11:31:03', NULL),
(251, 'test', 1, 14, 24, 3, 26, NULL, 'some short', '<p><b><font color=\"#ff0000\">detailed description hello&nbsp;</font></b></p><p><br></p><p><br></p><p><br></p>', 'somthing somthing', '1637135104.png', 1, NULL, NULL, 20, 10, 10, 10, NULL, 1, 0, '2021-11-17 05:45:04', '2021-11-17 05:45:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `key_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_id`, `key_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(919, 236, 1, 1, '2021-11-15 06:57:45', '2021-11-15 06:57:45', NULL),
(920, 236, 17, 104, '2021-11-15 06:57:45', '2021-11-15 06:57:45', NULL),
(921, 237, 1, 1, '2021-11-15 07:10:51', '2021-11-15 07:10:51', NULL),
(922, 237, 17, 104, '2021-11-15 07:10:51', '2021-11-15 07:10:51', NULL),
(923, 238, 1, 1, '2021-11-15 07:19:15', '2021-11-15 07:19:15', NULL),
(924, 238, 17, 105, '2021-11-15 07:19:15', '2021-11-15 07:19:15', NULL),
(925, 239, 1, 1, '2021-11-15 07:28:43', '2021-11-15 07:28:43', NULL),
(926, 239, 17, 104, '2021-11-15 07:28:43', '2021-11-15 07:28:43', NULL),
(927, 240, 1, 1, '2021-11-15 09:22:50', '2021-11-15 09:22:50', NULL),
(928, 240, 17, 104, '2021-11-15 09:22:50', '2021-11-15 09:22:50', NULL),
(929, 241, 1, 1, '2021-11-15 09:28:45', '2021-11-15 09:28:45', NULL),
(930, 241, 17, 104, '2021-11-15 09:28:45', '2021-11-15 09:28:45', NULL),
(931, 242, 1, 1, '2021-11-15 09:34:08', '2021-11-15 09:34:08', NULL),
(932, 242, 17, 104, '2021-11-15 09:34:08', '2021-11-15 09:34:08', NULL),
(937, 245, 1, 1, '2021-11-15 11:22:41', '2021-11-15 11:22:41', NULL),
(938, 246, 1, 5, '2021-11-16 05:56:57', '2021-11-16 05:56:57', NULL),
(939, 246, 17, 103, '2021-11-16 05:56:57', '2021-11-16 05:56:57', NULL),
(940, 247, 1, 1, '2021-11-16 11:09:10', '2021-11-16 11:09:10', NULL),
(941, 248, 1, 1, '2021-11-16 11:16:49', '2021-11-16 11:16:49', NULL),
(942, 249, 1, 1, '2021-11-16 11:26:54', '2021-11-16 11:26:54', NULL),
(943, 250, 1, 1, '2021-11-16 11:31:03', '2021-11-16 11:31:03', NULL),
(944, 251, 1, 1, '2021-11-17 05:45:04', '2021-11-17 05:45:04', NULL),
(945, 251, 11, 77, '2021-11-17 05:45:04', '2021-11-17 05:45:04', NULL),
(946, 251, 12, 81, '2021-11-17 05:45:04', '2021-11-17 05:45:04', NULL),
(947, 251, 16, 100, '2021-11-17 05:45:04', '2021-11-17 05:45:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_average_ratings`
--

CREATE TABLE `product_average_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `total_reviews` int(11) NOT NULL,
  `total_rating` int(11) NOT NULL,
  `avg_rating` double(1,1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(126, 236, '11636966665.jpg', '2021-11-15 06:57:45', '2021-11-15 06:57:45', NULL),
(127, 236, '21636966665.jpg', '2021-11-15 06:57:45', '2021-11-15 06:57:45', NULL),
(128, 236, '31636966665.jpg', '2021-11-15 06:57:45', '2021-11-15 06:57:45', NULL),
(129, 237, '11636967450.jpg', '2021-11-15 07:10:51', '2021-11-15 07:10:51', NULL),
(130, 237, '21636967450.jpg', '2021-11-15 07:10:51', '2021-11-15 07:10:51', NULL),
(131, 237, '31636967450.jpg', '2021-11-15 07:10:51', '2021-11-15 07:10:51', NULL),
(132, 238, '11636967954.png', '2021-11-15 07:19:15', '2021-11-15 07:19:15', NULL),
(133, 238, '21636967954.png', '2021-11-15 07:19:15', '2021-11-15 07:19:15', NULL),
(134, 238, '31636967955.png', '2021-11-15 07:19:15', '2021-11-15 07:19:15', NULL),
(135, 239, '11636968522.jpg', '2021-11-15 07:28:43', '2021-11-15 07:28:43', NULL),
(136, 239, '21636968522.jpg', '2021-11-15 07:28:43', '2021-11-15 07:28:43', NULL),
(137, 239, '31636968523.jpg', '2021-11-15 07:28:43', '2021-11-15 07:28:43', NULL),
(138, 240, '11636975369.jpg', '2021-11-15 09:22:50', '2021-11-15 09:22:50', NULL),
(139, 240, '21636975369.jpg', '2021-11-15 09:22:50', '2021-11-15 09:22:50', NULL),
(140, 240, '31636975369.jpg', '2021-11-15 09:22:50', '2021-11-15 09:22:50', NULL),
(141, 241, '11636975725.jpg', '2021-11-15 09:28:45', '2021-11-15 09:28:45', NULL),
(142, 241, '21636975725.jpg', '2021-11-15 09:28:45', '2021-11-15 09:28:45', NULL),
(143, 241, '31636975725.jpg', '2021-11-15 09:28:45', '2021-11-15 09:28:45', NULL),
(144, 242, '11636976048.jpg', '2021-11-15 09:34:08', '2021-11-15 09:34:08', NULL),
(145, 242, '21636976048.jpg', '2021-11-15 09:34:08', '2021-11-15 09:34:08', NULL),
(146, 242, '31636976048.jpg', '2021-11-15 09:34:08', '2021-11-15 09:34:08', NULL),
(150, 245, '11636982560.jpg', '2021-11-15 11:22:41', '2021-11-16 10:53:25', '2021-11-16 10:53:25'),
(151, 245, '21636982560.jpg', '2021-11-15 11:22:41', '2021-11-16 10:53:31', '2021-11-16 10:53:31'),
(152, 245, '31636982560.jpg', '2021-11-15 11:22:41', '2021-11-16 10:53:39', '2021-11-16 10:53:39'),
(153, 246, '11637049417.jpg', '2021-11-16 05:56:57', '2021-11-16 05:56:57', NULL),
(154, 246, '21637049417.jpg', '2021-11-16 05:56:57', '2021-11-16 05:56:57', NULL),
(155, 246, '31637049417.jpg', '2021-11-16 05:56:57', '2021-11-16 05:56:57', NULL),
(156, 247, '11637068149.jpg', '2021-11-16 11:09:10', '2021-11-16 11:09:10', NULL),
(157, 247, '21637068149.jpg', '2021-11-16 11:09:10', '2021-11-16 11:09:10', NULL),
(158, 247, '31637068149.jpg', '2021-11-16 11:09:10', '2021-11-16 11:09:10', NULL),
(159, 248, '11637068608.jpg', '2021-11-16 11:16:49', '2021-11-16 11:16:49', NULL),
(160, 248, '21637068608.jpg', '2021-11-16 11:16:49', '2021-11-16 11:16:49', NULL),
(161, 248, '31637068608.webp', '2021-11-16 11:16:49', '2021-11-16 11:16:49', NULL),
(162, 249, '11637069213.jpg', '2021-11-16 11:26:54', '2021-11-16 11:26:54', NULL),
(163, 249, '21637069213.jpg', '2021-11-16 11:26:54', '2021-11-16 11:26:54', NULL),
(164, 249, '31637069213.webp', '2021-11-16 11:26:54', '2021-11-16 11:26:54', NULL),
(165, 250, '11637069462.jpg', '2021-11-16 11:31:03', '2021-11-16 11:31:03', NULL),
(166, 250, '21637069462.jpg', '2021-11-16 11:31:03', '2021-11-16 11:31:03', NULL),
(167, 250, '31637069462.jpg', '2021-11-16 11:31:03', '2021-11-16 11:31:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_questions`
--

CREATE TABLE `product_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_reply` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_questions`
--

INSERT INTO `product_questions` (`id`, `product_id`, `user_id`, `customer_question`, `vendor_reply`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 239, 1, 'Is it origional or first copy?', NULL, 1, '2021-12-02 01:55:09', '2021-12-02 01:55:09', NULL),
(2, 239, 1, 'Is it origional or first copy?', NULL, 1, '2021-12-02 01:56:52', '2021-12-02 01:56:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_rating` int(11) NOT NULL,
  `customer_review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_reply` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `likes_on_review` int(11) NOT NULL,
  `likes_on_reply` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `product_id`, `user_id`, `customer_rating`, `customer_review`, `vendor_reply`, `status`, `likes_on_review`, `likes_on_reply`, `created_at`, `updated_at`, `deleted_at`) VALUES
(18, 237, 114, 5, 'nice jacket, great stuff', NULL, 1, 0, 0, NULL, '2021-12-01 03:20:02', NULL),
(19, 238, 114, 5, 'nice jacket, great stuff', NULL, 1, 0, 0, NULL, NULL, NULL),
(20, 239, 114, 5, 'nice jacket, great stuff', NULL, 1, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL,
  `special_price` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `seller_sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `availability` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `price`, `special_price`, `quantity`, `seller_sku`, `availability`, `created_at`, `updated_at`, `deleted_at`) VALUES
(259, 236, 10599, 10590, 10, '45212001', 1, '2021-11-15 06:57:45', '2021-11-15 06:57:45', NULL),
(260, 236, 10699, 10690, 10, '452125251', 1, '2021-11-15 06:57:45', '2021-11-15 06:57:45', NULL),
(261, 236, 10799, 10790, 10, '14552114', 1, '2021-11-15 06:57:45', '2021-11-15 06:57:45', NULL),
(262, 236, 10899, 10890, 10, '10055852', 1, '2021-11-15 06:57:45', '2021-11-15 06:57:45', NULL),
(263, 237, 350, 299, 15, '2152536', 1, '2021-11-15 07:10:51', '2021-11-15 07:10:51', NULL),
(264, 237, 450, 399, 15, '524542520', 1, '2021-11-15 07:10:51', '2021-11-15 07:10:51', NULL),
(265, 237, 550, 499, 15, '15215521', 1, '2021-11-15 07:10:51', '2021-11-15 07:10:51', NULL),
(266, 237, 650, 599, 15, '26151252562', 1, '2021-11-15 07:10:51', '2021-11-15 07:10:51', NULL),
(267, 238, 620, 599, 20, '250411211', 1, '2021-11-15 07:19:15', '2021-11-15 07:19:15', NULL),
(268, 238, 720, 699, 52, '2155', 1, '2021-11-15 07:19:15', '2021-11-15 07:19:15', NULL),
(269, 238, 820, 799, 15, '1114514514', 1, '2021-11-15 07:19:15', '2021-11-15 07:19:15', NULL),
(270, 238, 920, 899, 56, '51441515', 1, '2021-11-15 07:19:15', '2021-11-15 07:19:15', NULL),
(271, 239, 300, 299, 23, '346534', 1, '2021-11-15 07:28:43', '2021-11-15 07:28:43', NULL),
(272, 239, 400, 399, 345, '43653456', 1, '2021-11-15 07:28:43', '2021-11-15 07:28:43', NULL),
(273, 239, 500, 499, 46, '435435', 1, '2021-11-15 07:28:43', '2021-11-15 07:28:43', NULL),
(274, 239, 600, 599, 67, '3256356', 1, '2021-11-15 07:28:43', '2021-11-15 07:28:43', NULL),
(275, 240, 420, 399, 12, '25421025', 1, '2021-11-15 09:22:50', '2021-11-15 09:22:50', NULL),
(276, 240, 520, 499, 44, '47854885', 1, '2021-11-15 09:22:50', '2021-11-15 09:22:50', NULL),
(277, 240, 620, 599, 554, '8952148525', 1, '2021-11-15 09:22:50', '2021-11-15 09:22:50', NULL),
(278, 240, 720, 699, 54, '25878451', 1, '2021-11-15 09:22:50', '2021-11-15 09:22:50', NULL),
(279, 241, 1350, 1299, 12, '221525', 1, '2021-11-15 09:28:45', '2021-11-15 09:28:45', NULL),
(280, 241, 1450, 1399, 15, '21251515', 1, '2021-11-15 09:28:45', '2021-11-15 09:28:45', NULL),
(281, 241, 1550, 1499, 55, '1515215', 1, '2021-11-15 09:28:45', '2021-11-15 09:28:45', NULL),
(282, 241, 1650, 1599, 65, '15151515', 1, '2021-11-15 09:28:45', '2021-11-15 09:28:45', NULL),
(283, 242, 320, 299, 54, '5125121', 1, '2021-11-15 09:34:08', '2021-11-15 09:34:08', NULL),
(284, 242, 420, 399, 45, '1254154', 1, '2021-11-15 09:34:08', '2021-11-15 09:34:08', NULL),
(285, 242, 520, 499, 415, '215214545', 1, '2021-11-15 09:34:08', '2021-11-15 09:34:08', NULL),
(286, 242, 620, 599, 454, '454484854', 1, '2021-11-15 09:34:08', '2021-11-15 09:34:08', NULL),
(289, 245, 499, 415, 87, '47854885', 1, '2021-11-15 11:22:41', '2021-11-15 11:22:41', NULL),
(290, 246, 2500, 2000, 250, '121212', 1, '2021-11-16 05:56:57', '2021-11-17 04:00:47', NULL),
(291, 246, 2500, 2000, 250, '232323', 1, '2021-11-16 05:56:57', '2021-11-16 05:56:57', NULL),
(292, 246, 2500, 2000, 250, '343434', 1, '2021-11-16 05:56:57', '2021-11-16 05:56:57', NULL),
(293, 247, 1015, 1000, 45, '214141041', 1, '2021-11-16 11:09:10', '2021-11-16 11:09:10', NULL),
(294, 248, 1350, 1320, 15, '1515151', 1, '2021-11-16 11:16:49', '2021-11-16 11:16:49', NULL),
(295, 249, 698, 668, 15, '47854885', 1, '2021-11-16 11:26:54', '2021-11-16 11:26:54', NULL),
(296, 250, 999, 950, 25, '8952148525', 1, '2021-11-16 11:31:03', '2021-11-16 11:31:03', NULL),
(297, 251, 2000, 1000, 4, '210', 1, '2021-11-17 05:45:04', '2021-11-17 05:45:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `return_addresses`
--

CREATE TABLE `return_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warehouse_phone_no` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warehouse_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_zone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_street_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_building_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_floor_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_appartment_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `return_addresses`
--

INSERT INTO `return_addresses` (`id`, `store_id`, `warehouse_name`, `warehouse_phone_no`, `warehouse_email`, `country_id`, `city_id`, `warehouse_zone_no`, `warehouse_street_no`, `warehouse_building_no`, `warehouse_floor_no`, `warehouse_appartment_no`, `warehouse_address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 26, 'Doha Qatar', '0302145262331', 'test@gmail.com', 1, 1, '2211', '21', '323', '3', '456', NULL, '2021-11-15 06:18:53', '2021-11-15 06:18:53', NULL),
(13, 27, 'RR Electronics', '97400000000', 'socialmedia@storak.digital.com', 1, 1, '00', '00', '00', '00', '00', '00000000', '2021-11-15 08:53:24', '2021-11-15 10:44:57', NULL),
(14, 28, 'Storak', '0315541115521', 'test@gmail.com', 1, 1, '2233', '45', '22', '1', '66', NULL, '2021-11-15 09:11:51', '2021-11-15 09:11:51', NULL),
(15, 29, 'Minu', '0302489156214', 'minhaskhara.storak@gmail.com', 1, 5, '4433', '776', '3322', '5', '454', NULL, '2021-11-15 10:59:41', '2021-11-15 10:59:41', NULL),
(16, 30, 'Storak', '0302525485414', 'minhaskhara.storak@gmail.com', 1, 1, '325', '3212', '12', '5', '34', NULL, '2021-11-16 09:01:40', '2021-11-16 09:01:40', NULL),
(17, 31, 'Multan, Pakistan', '03116311111', 'bzu@gmail.com', 1, 1, '12-DOHA', 'Multan, Pakistan', '12', '2', '22', NULL, '2021-11-16 09:38:25', '2021-11-16 09:38:25', NULL),
(18, 32, 'Multan, Pakistan', '03116311111', 'bzu@gmail.com', 1, 1, '123', 'Multan, Pakistan', '18-A', '2', '5', NULL, '2021-11-16 09:53:36', '2021-11-16 09:53:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review_images`
--

CREATE TABLE `review_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_review_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review_images`
--

INSERT INTO `review_images` (`id`, `product_review_id`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(26, 18, '1638278335.png', 1, '2021-11-30 08:18:55', '2021-11-30 08:18:55', NULL),
(27, 18, '1638278335.jpg', 1, '2021-11-30 08:18:55', '2021-11-30 08:18:55', NULL),
(28, 19, '1638278399.png', 1, '2021-11-30 08:19:59', '2021-11-30 08:19:59', NULL),
(29, 19, '1638278399.jpg', 1, '2021-11-30 08:19:59', '2021-11-30 08:19:59', NULL),
(30, 20, '1638278406.png', 1, '2021-11-30 08:20:06', '2021-11-30 08:20:06', NULL),
(31, 20, '1638278406.jpg', 1, '2021-11-30 08:20:06', '2021-11-30 08:20:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_companies`
--

CREATE TABLE `shipping_companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_companies`
--

INSERT INTO `shipping_companies` (`id`, `name`, `email`, `mobile`, `address`, `logo`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Leopards Courier', 'leopardcourieservices@gmail.com', '+923035190106', 'Model Town Lahore, Pakistan', NULL, 1, '2021-09-25 06:15:34', '2021-09-25 06:15:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_line` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detailed_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holiday_mode` tinyint(1) NOT NULL DEFAULT 0,
  `holiday_start_date` date DEFAULT NULL,
  `holiday_end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `user_id`, `seller_id`, `store_name`, `tag_line`, `category_id`, `short_description`, `detailed_description`, `logo_image`, `cover_image`, `holiday_mode`, `holiday_start_date`, `holiday_end_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(25, 107, NULL, 'Shahzad Store', 'Where You Come First', 13, 'we care about your satisfaction', 'we care about your satisfaction we care about your satisfaction we care about your satisfaction we care about your satisfaction we care about your satisfaction we care about your satisfaction', '1635404270.png', '1635404270.jpg', 1, '2021-10-28', '2021-10-29', '2021-10-28 03:57:50', '2021-10-28 03:57:50', NULL),
(26, 2, NULL, 'Storak', 'Best Seller Store', 1, 'I have best seller store', 'I have best seller store in all over the country', '1636964214.png', '1636964214.png', 0, '1970-01-01', '1970-01-01', '2021-11-15 06:16:54', '2021-11-15 06:16:54', NULL),
(27, 109, NULL, 'RR Electronics', 'For your comfort', 1, 'Electronic Products means products that are dependent on electric currents or electromagnetic fields in order to work properly.', 'Electronic Products means products that are dependent on electric currents or electromagnetic fields in order to work properly.', '1636973356.png', '1636973356.png', 0, '1970-01-01', '1970-01-01', '2021-11-15 08:49:16', '2021-11-15 08:49:16', NULL),
(28, 80, NULL, 'Storak2', 'Best Seller Store', 12, 'I have best seller store', 'I have best seller store', '1636974619.png', '1636974619.jpg', 0, '1970-01-01', '1970-01-01', '2021-11-15 09:10:19', '2021-11-15 09:10:19', NULL),
(29, 124, NULL, 'Minhas Store', 'Best Seller Store', 14, 'I have best seller store', 'I have best seller store in all over the country', '1636978708.png', '1636978708.png', 0, '1970-01-01', '1970-01-01', '2021-11-15 10:18:28', '2021-11-15 10:18:28', NULL),
(30, 125, NULL, 'Minhas Store2', 'Best Seller Store', 9, 'I have best seller store', 'I have best seller store', '1637060193.jpg', '1637060193.png', 0, '1970-01-01', '1970-01-01', '2021-11-16 08:56:33', '2021-11-16 08:56:33', NULL),
(31, 126, NULL, 'Storak4', 'Best Seller Store', 15, 'I have best seller store', 'I have best seller store', '1637061596.png', '1637061596.png', 0, '1970-01-01', '1970-01-01', '2021-11-16 09:19:56', '2021-11-16 09:19:56', NULL),
(32, 127, NULL, 'Storak2', 'Best Seller Store', 9, 'I have best seller store', 'I have best seller store', '1637063130.png', '1637063130.png', 0, '1970-01-01', '1970-01-01', '2021-11-16 09:45:30', '2021-11-16 09:45:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `store_user`
--

CREATE TABLE `store_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subroles`
--

CREATE TABLE `subroles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subroles`
--

INSERT INTO `subroles` (`id`, `name`, `owner_id`, `created_at`, `updated_at`, `permissions`) VALUES
(1, 'Storak Admin', 0, NULL, NULL, '{\"dashboard\":{\"name\":\"dashboard\",\"slug\":\"dashboard\",\"id\":1,\"parent\":false,\"operations\":[\"create\",\"read\",\"update\",\"delete\"]}}'),
(2, 'Vendor Admin', 0, NULL, NULL, '{\"dashboard\":{\"name\":\"Dashboard\",\"slug\":\"dashboard\",\"id\":1,\"parent\":false,\"operations\":[\"create\",\"read\",\"update\",\"delete\"],\"childs\":[]},\"products\":{\"name\":\"Products\",\"slug\":\"products\",\"id\":2,\"parent\":true,\"operations\":[\"create\",\"read\",\"update\",\"delete\"],\"childs\":{\"add_products\":{\"name\":\"Add Products\",\"slug\":\"add_products\",\"id\":1,\"parent\":false,\"operations\":[\"create\",\"read\",\"update\",\"delete\"],\"childs\":[]},\"manage_products\":{\"name\":\"Manage Products\",\"slug\":\"manage_products\",\"id\":2,\"parent\":false,\"operations\":[\"create\",\"read\",\"update\",\"delete\"],\"childs\":[]}}},\"orders\":{\"name\":\"Orders\",\"slug\":\"orders\",\"id\":2,\"parent\":true,\"operations\":[\"create\",\"read\",\"update\",\"delete\"],\"childs\":{\"manage_orders\":{\"name\":\"Manage Orders\",\"slug\":\"manage_orders\",\"id\":1,\"parent\":false,\"operations\":[\"create\",\"read\",\"update\",\"delete\"],\"childs\":[]}}}}');

-- --------------------------------------------------------

--
-- Table structure for table `subrole_user`
--

CREATE TABLE `subrole_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subrole_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `popular` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `title`, `description`, `image`, `status`, `featured`, `popular`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 9, 'Cell Phone', 'mobiles', '1627298115.png', 1, 1, 0, '2021-06-24 04:09:39', '2021-07-26 06:15:15', NULL),
(11, 9, 'Tablet', NULL, '1627298167.png', 1, 0, 0, '2021-06-29 05:30:56', '2021-07-26 06:16:07', NULL),
(12, 9, 'Accessories', NULL, '1627298089.png', 1, 0, 0, '2021-06-29 05:34:43', '2021-07-26 06:14:49', NULL),
(13, 9, 'Smart Accessories', NULL, '1627298145.png', 1, 0, 0, '2021-06-29 05:35:03', '2021-07-26 06:15:45', NULL),
(14, 1, 'LED TVs', NULL, '1627296388.png', 1, 0, 0, '2021-06-29 05:35:33', '2021-07-26 05:46:28', NULL),
(15, 1, 'Refrigerators', NULL, '1627296464.png', 1, 0, 0, '2021-06-29 05:35:57', '2021-07-26 05:47:44', NULL),
(16, 1, 'AC', NULL, '1627295053.png', 1, 0, 0, '2021-06-29 05:38:32', '2021-07-26 05:45:20', NULL),
(17, 1, 'Washing Machine', NULL, '1627296490.png', 1, 0, 0, '2021-06-29 05:39:05', '2021-07-26 05:48:10', NULL),
(18, 1, 'Water Dispenser', NULL, '1627296513.png', 1, 0, 0, '2021-06-29 05:39:33', '2021-07-26 05:48:33', NULL),
(19, 1, 'Microwave Oven', NULL, '1627296435.png', 1, 0, 0, '2021-06-29 05:39:59', '2021-07-26 05:47:15', NULL),
(20, 1, 'Small Appliances', NULL, '1627305623.png', 1, 0, 0, '2021-06-29 05:49:33', '2021-07-26 08:20:23', NULL),
(21, 10, 'Digital Cams', NULL, '1627300683.png', 1, 0, 0, '2021-06-29 05:50:31', '2021-07-26 06:58:03', NULL),
(22, 10, 'DSLR Cams', NULL, '1627300713.png', 1, 0, 0, '2021-06-29 05:51:19', '2021-07-26 06:58:33', NULL),
(23, 10, 'Mirror less Cams', NULL, '1627300734.png', 1, 0, 0, '2021-06-29 05:51:46', '2021-07-26 06:58:54', NULL),
(24, 10, 'Cam ACCY', NULL, '1627300632.png', 1, 0, 0, '2021-06-29 05:52:07', '2021-07-26 06:57:12', NULL),
(25, 10, 'Camcorder', NULL, '1627300605.png', 1, 0, 0, '2021-06-29 05:52:31', '2021-07-26 06:56:45', NULL),
(26, 10, 'CCTV & Commercial Cam', NULL, '1627300659.png', 1, 0, 0, '2021-06-29 05:52:53', '2021-07-26 06:57:39', NULL),
(27, 11, 'Laptops', NULL, '1627300561.png', 1, 0, 0, '2021-06-29 05:53:16', '2021-07-26 06:56:01', NULL),
(28, 11, 'Desktop Computer', NULL, '1627300538.png', 1, 0, 0, '2021-06-29 05:57:53', '2021-07-26 06:55:38', NULL),
(29, 11, 'Computer ACCY', NULL, '1627300513.png', 1, 0, 0, '2021-06-29 05:58:40', '2021-07-26 06:55:13', NULL),
(30, 12, 'Women Western', NULL, '1627287529.png', 1, 0, 0, '2021-06-29 05:59:19', '2021-07-26 03:18:49', NULL),
(31, 12, 'Women Eastern', NULL, '1627287299.png', 1, 0, 0, '2021-06-29 06:01:41', '2021-07-26 03:14:59', NULL),
(32, 12, 'Women lingerie\'s', NULL, '1627287378.png', 1, 0, 0, '2021-06-29 06:02:09', '2021-07-26 03:16:18', NULL),
(33, 12, 'Women Watches', NULL, '1627287489.png', 1, 0, 0, '2021-06-29 06:02:34', '2021-07-26 03:18:09', NULL),
(34, 12, 'Women Shoes', NULL, '1627287649.png', 1, 0, 0, '2021-06-29 06:02:56', '2021-07-26 03:20:49', NULL),
(35, 12, 'Women Fragrances', NULL, '1627287435.png', 1, 0, 0, '2021-06-29 06:03:16', '2021-07-26 03:17:15', NULL),
(36, 12, 'Women Care', NULL, '1627287604.png', 1, 0, 0, '2021-06-29 06:03:38', '2021-07-26 03:20:05', NULL),
(37, 12, 'Women Accessories', NULL, '1627287564.png', 1, 0, 0, '2021-06-29 06:03:57', '2021-07-26 03:19:24', NULL),
(38, 13, 'Men Eastern', NULL, '1627298285.png', 1, 0, 0, '2021-06-29 06:04:15', '2021-07-26 06:18:05', NULL),
(39, 13, 'Men Western', NULL, '1627298459.png', 1, 0, 0, '2021-06-29 06:04:30', '2021-07-26 06:20:59', NULL),
(40, 13, 'Men Watches', NULL, '1627298428.png', 1, 0, 0, '2021-06-29 06:04:45', '2021-07-26 06:20:28', NULL),
(41, 13, 'Men Shoes', NULL, '1627298396.png', 1, 0, 0, '2021-06-29 06:04:59', '2021-07-26 06:19:56', NULL),
(42, 13, 'Men Glasses', NULL, '1627298311.png', 1, 0, 0, '2021-06-29 06:05:16', '2021-07-26 06:18:31', NULL),
(43, 13, 'Men Fragrances', NULL, '1627298370.png', 1, 0, 0, '2021-06-29 06:05:32', '2021-07-26 06:19:30', NULL),
(44, 13, 'Men Care', NULL, '1627298342.png', 1, 0, 0, '2021-06-29 06:05:46', '2021-07-26 06:19:03', NULL),
(45, 13, 'Men Accessories', NULL, '1627298255.png', 1, 0, 0, '2021-06-29 06:06:03', '2021-07-26 06:17:35', NULL),
(46, 14, 'Baby Fashion', NULL, '1627300801.png', 1, 0, 0, '2021-06-29 06:06:26', '2021-07-26 07:00:02', NULL),
(47, 14, 'Baby Care', NULL, '1627300774.png', 1, 0, 0, '2021-06-29 06:06:42', '2021-07-26 06:59:34', NULL),
(48, 14, 'Baby Toys', NULL, '1627300828.png', 1, 0, 0, '2021-06-29 06:07:05', '2021-07-26 07:00:28', NULL),
(49, 15, 'Vision Care', NULL, '1627300430.png', 1, 0, 0, '2021-06-29 06:07:42', '2021-07-26 06:53:50', NULL),
(50, 15, 'Vitamins & Dietary Supplements', NULL, '1627300455.png', 1, 0, 0, '2021-06-29 06:07:59', '2021-07-26 06:54:15', NULL),
(51, 15, 'Oral Care', NULL, '1627300402.png', 1, 0, 0, '2021-06-29 06:08:19', '2021-07-26 06:53:23', NULL),
(52, 15, 'Natural Care', NULL, '1627300374.png', 1, 0, 0, '2021-06-29 06:08:46', '2021-07-26 06:52:54', NULL),
(53, 16, 'Console Gamming', NULL, '1627296587.png', 1, 0, 0, '2021-06-29 06:09:22', '2021-07-26 05:49:47', NULL),
(54, 16, 'Gamming Title', NULL, '1627296667.png', 1, 0, 0, '2021-06-29 06:09:54', '2021-07-26 05:51:07', NULL),
(55, 16, 'Gamming ACCY', NULL, '1627296643.png', 1, 0, 0, '2021-06-29 06:10:12', '2021-07-26 05:50:43', NULL),
(56, 16, 'Team Sports', NULL, '1627296788.png', 1, 0, 0, '2021-06-29 06:10:31', '2021-07-26 05:53:08', NULL),
(57, 16, 'Racket Sports', NULL, '1627296718.png', 1, 0, 0, '2021-06-29 06:10:48', '2021-07-26 05:51:58', NULL),
(58, 16, 'Exercise & Fitness', NULL, '1627296614.png', 1, 0, 0, '2021-06-29 06:11:06', '2021-07-26 05:50:15', NULL),
(59, 16, 'Supplements', NULL, '1627296764.png', 1, 0, 0, '2021-06-29 06:11:23', '2021-07-26 05:52:44', NULL),
(60, 16, 'Shoes & Clothing', NULL, '1627296741.png', 1, 0, 0, '2021-06-29 06:11:42', '2021-07-26 05:52:21', NULL),
(61, 17, 'Furniture', NULL, '1627298703.png', 1, 0, 0, '2021-06-29 06:12:20', '2021-07-26 06:25:03', NULL),
(62, 17, 'Lighting', NULL, '1627298733.png', 1, 0, 0, '2021-06-29 06:12:37', '2021-07-26 06:25:33', NULL),
(63, 17, 'Cookery', NULL, NULL, 1, 0, 0, '2021-06-29 06:12:52', '2021-06-29 06:12:52', NULL),
(64, 17, 'Cutlery', NULL, '1627298642.png', 1, 0, 0, '2021-06-29 06:13:10', '2021-07-26 06:24:02', NULL),
(65, 17, 'Bed sheet', NULL, '1627298509.png', 1, 0, 0, '2021-06-29 06:13:36', '2021-07-26 06:21:49', NULL),
(66, 17, 'Curtain', NULL, '1627298604.png', 1, 0, 0, '2021-06-29 06:14:09', '2021-07-26 06:23:24', NULL),
(67, 17, 'Decoration', NULL, '1627298672.png', 1, 0, 0, '2021-06-29 06:14:27', '2021-07-26 06:24:32', NULL),
(69, 18, 'CAR Accessories', NULL, NULL, 1, 0, 0, '2021-06-30 01:38:55', '2021-06-30 01:38:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `registered_with` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'signup',
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_confirmation_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_mobile_verified` tinyint(1) NOT NULL DEFAULT 0,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `vendor_profile_status` tinyint(4) DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role_id`, `registered_with`, `provider_id`, `email`, `email_confirmation_code`, `is_email_verified`, `email_verified_at`, `password`, `remember_token`, `mobile`, `is_mobile_verified`, `phone`, `profile_image`, `status`, `vendor_profile_status`, `last_login`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 1, 'signup', NULL, 'admin@gmail.com', NULL, 0, NULL, '$2y$10$B31FcVVZrFgw0mER04oVk.grgFcSkG1nzPzbHFCXCm1xp9al2lvvS', NULL, '266445454', 0, NULL, NULL, 1, NULL, NULL, '2021-07-23 02:03:08', '2021-07-23 02:03:08', NULL),
(2, 'Vendor 1', 2, 'signup', NULL, 'vendor1.tester@gmail.com', NULL, 1, '2021-10-26 10:26:34', '$2y$10$B31FcVVZrFgw0mER04oVk.grgFcSkG1nzPzbHFCXCm1xp9al2lvvS', NULL, '+974712345678', 0, NULL, NULL, 1, 2, NULL, '2021-07-23 01:54:15', '2021-11-15 07:27:05', NULL),
(4, 'Buyer 1', 3, 'signup', NULL, 'Buyer1.storak@gmail.com', 'RhAD4q', 0, NULL, '$2y$10$pQD6hTXwxho7GeNICI6LV.Fzq91JU3WizgjyK/Fm/JHWWyz.QXG8e', NULL, '3002656565', 0, NULL, NULL, 1, NULL, NULL, '2021-07-23 07:58:28', '2021-11-19 03:44:04', NULL),
(80, 'Vendor 2', 2, 'signup', NULL, 'vendor2.tester@gmail.com', NULL, 0, NULL, '$2y$10$9n7V45mCPdwgoqmIgCoxF.CemZgjR51yNim5C5XJJN8Mtg5iT6W5K', NULL, '+97411234567', 0, NULL, NULL, 1, 3, NULL, '2021-09-29 07:03:41', '2021-11-15 10:09:56', NULL),
(107, 'Shahzad Mahota', 2, 'signup', NULL, 'dev.shahzadmahota@gmail.com', 'ynFRujoC8pvBZYedRKP7NoEVCldSDV', 0, NULL, '$2y$10$gT6.5AbVl0H42V0SekZqAOE.kP18xU24SQYN0Cq6JTZduQEMJfGwS', NULL, '+97478789898', 0, NULL, NULL, 1, 0, NULL, '2021-10-28 02:07:23', '2021-10-28 04:00:16', NULL),
(108, 'test', 3, 'signup', NULL, 'test2@demo.com', '881Mfl', 0, NULL, '$2y$10$edqrf60QTxlISzmtbc9fXurQ9c8K2F/7TIzFvcLUJMzEfXv8kfQ06', NULL, '03001122333', 0, NULL, NULL, 1, NULL, NULL, '2021-10-30 04:05:35', '2021-11-23 05:27:56', NULL),
(109, 'Rabail test', 2, 'signup', NULL, 'socialmedia@storakdigital.com', NULL, 1, '2021-11-09 10:28:17', '$2y$10$08CH42zXykUtFZiqvkfywe.GvX3HS31J1w5n3eBdOppJO1Vl5lNtu', NULL, '+97400000000', 0, NULL, NULL, 1, 1, NULL, '2021-11-02 08:46:57', '2021-11-15 10:45:06', NULL),
(110, 'Umar', 3, 'signup', NULL, 'umar@email.com', NULL, 0, NULL, '$2y$10$HsoqAPj1lco/X6bwYOxlKOuFkAhcF96RFjiiIq95C5439L1OCciMm', NULL, '03001234567', 0, NULL, NULL, 1, NULL, NULL, '2021-11-04 07:08:36', '2021-11-04 07:08:36', NULL),
(111, 'Wajid', 3, 'signup', NULL, 'wajid@email.com', NULL, 0, NULL, '$2y$10$ZS64vAgRQHJLOMAHzUzFLOrGi.k8pZLxPZ2dBYVdoQQw0/u5TCKV2', NULL, '03007654321', 0, NULL, NULL, 1, NULL, NULL, '2021-11-09 03:10:29', '2021-11-09 03:10:29', NULL),
(112, 'Saim', 3, 'signup', NULL, 'saim@email.com', NULL, 0, NULL, '$2y$10$O1n/Ze7LBH0zbiSdiyTj1Ozf/jZNob7bFBl12viqjIxKTzS6dLm1O', NULL, '03151234567', 0, NULL, NULL, 1, NULL, NULL, '2021-11-09 03:30:14', '2021-11-09 03:30:14', NULL),
(113, 'Fahad', 3, 'signup', NULL, 'fahad@email.com', NULL, 0, NULL, '$2y$10$L6cCPF3TqXbwotjxdbS0AeqJsgGxcFXJ5El62iBQ5t9MbLsDxQA.6', NULL, '03211478523', 0, NULL, NULL, 1, NULL, NULL, '2021-11-09 06:44:10', '2021-11-09 06:44:10', NULL),
(114, 'arslan', 3, 'signup', NULL, 'arslan@gmail.com', NULL, 0, NULL, '$2y$10$deaZyQ4melHRlHu3LOLBXeUFOAedFx0xVU78yts1Dv9s30uYqxJAW', NULL, '03341234567', 0, NULL, NULL, 1, NULL, NULL, '2021-11-11 11:31:44', '2021-11-11 11:31:44', NULL),
(115, 'Hassan', 3, 'signup', NULL, 'hassan@email.com', NULL, 0, NULL, '$2y$10$.Q2L1.nw1ZYYdXnwaVIiEeYtRRfDCz6EZeS6MXuPPVcEAE1SD7q0q', NULL, '03001478526', 0, NULL, NULL, 1, NULL, NULL, '2021-11-12 03:45:07', '2021-11-12 03:45:07', NULL),
(116, 'Ali', 3, 'signup', NULL, 'ali@email.com', NULL, 0, NULL, '$2y$10$95b0Pvwm3ojR1orBD7ObNuxIeboFAOtPmk1PiDbymy.9yecFAvprm', NULL, '03051122336', 0, NULL, NULL, 1, NULL, NULL, '2021-11-12 04:04:03', '2021-11-12 04:04:03', NULL),
(117, 'Karan', 3, 'signup', NULL, 'karan@email.com', NULL, 0, NULL, '$2y$10$MHJWpb0qPTKUH/M4NumQJeZDPE9k3pU2HRpE2K9n4VCVX5E/SpT7a', NULL, '03217895412', 0, NULL, NULL, 1, NULL, NULL, '2021-11-12 05:11:19', '2021-11-12 05:11:19', NULL),
(118, 'Imran', 3, 'signup', NULL, 'imran@email.com', NULL, 0, NULL, '$2y$10$sldEGo83DeAoT3Ayv0Hk3O61GDwVV5IOISzVaNBecycWcB8WV5fzO', NULL, '03337654321', 0, NULL, NULL, 1, NULL, NULL, '2021-11-12 05:18:20', '2021-11-12 05:18:20', NULL),
(119, 'Drake', 3, 'signup', NULL, 'drake@email.com', NULL, 0, NULL, '$2y$10$.xpNnRw40wg10gkfvSU1dOEZlRKECFiAhGxhA.YdabPhghEXGNdF.', NULL, '03007775554', 0, NULL, NULL, 1, NULL, NULL, '2021-11-12 07:28:12', '2021-11-12 07:28:12', NULL),
(120, 'Javed', 3, 'signup', NULL, 'javed@email.com', NULL, 0, NULL, '$2y$10$w/FRQhb7EThBETrOgCimDu3SKgkGUVavtPKHpufpBavr/.sfVnqey', NULL, '03321478526', 0, NULL, NULL, 1, NULL, NULL, '2021-11-15 02:51:02', '2021-11-15 02:51:02', NULL),
(121, 'Khalil', 3, 'signup', NULL, 'khalil@email.com', NULL, 0, NULL, '$2y$10$uXCLORXs3pWIyo2hFii/KOPg9XDzkXNaK63RpY1HgfYen0HMd8Mpa', NULL, '03214125638', 0, NULL, NULL, 1, NULL, NULL, '2021-11-15 02:54:01', '2021-11-15 02:54:01', NULL),
(122, 'Nicole', 3, 'signup', NULL, 'nicole@email.com', NULL, 0, NULL, '$2y$10$2XiSJfVz/vFTbwqREQ8dmOH5nHN6sF9ifWtvSQRvKFYQFZoESEK1W', NULL, '03217413698', 0, NULL, NULL, 1, NULL, NULL, '2021-11-15 02:59:18', '2021-11-15 02:59:18', NULL),
(123, 'Jane', 3, 'signup', NULL, 'jane@email.com', NULL, 0, NULL, '$2y$10$bUg3Q5HsxbMIEPxisnOhke6HHMDbcd3gCdFduilSAamxuq0gqNthO', NULL, '03214569872', 0, NULL, NULL, 1, NULL, NULL, '2021-11-15 06:49:34', '2021-11-15 06:49:34', NULL),
(124, 'Minhas Kharal', 2, 'signup', NULL, 'minhaskharal.storak@gmail.com', NULL, 1, '2021-11-15 10:09:19', '$2y$10$IarZbQKH1PglbP8Fj4P3/eUIvXTVe/x0ZfNdnD/WDmxAFpYc9Qzey', NULL, '+97435254522', 0, NULL, NULL, 1, 1, NULL, '2021-11-15 10:08:46', '2021-11-15 11:00:00', NULL),
(125, 'Minhas Jutt', 2, 'signup', NULL, 'developer1.storak@gmail.com', '19E8an8V8ljLkX0qqPNyCIoOvb4jG6', 0, NULL, '$2y$10$ZWtwlTkREe/Z8pKppc8RHODza1CBycdtE/dcrd3X/9PgSidgA1ZGC', NULL, '+97430254652', 0, NULL, NULL, 1, 1, NULL, '2021-11-16 08:36:30', '2021-11-16 09:01:53', NULL),
(126, 'Minhas123', 2, 'signup', NULL, 'developer3@storakdigital.com', 'JeljalPMkKV233GNRFTNnWs491TZFl', 0, NULL, '$2y$10$7skNPok4oc678AKtc3oJ0.puDK0mUOItkYnUWp8F1HoCmGHEm0NTy', NULL, '+97409500884', 0, NULL, NULL, 1, 1, NULL, '2021-11-16 09:16:23', '2021-11-16 09:38:40', NULL),
(127, 'Minhas', 2, 'signup', NULL, 'minhas@gmail.com', 'xnzetmBzQiLxzMiGXMObwcXE3vojKt', 0, NULL, '$2y$10$S91mX8d0f7uAD03FcyDdy.G3.PP/EQx25uuhWbd1AKMJi7bUklQvm', NULL, '+97405150560', 0, NULL, NULL, 1, 1, NULL, '2021-11-16 09:40:55', '2021-11-16 09:54:02', NULL),
(128, 'test', 3, 'signup', NULL, 'test4@demo.com', NULL, 0, NULL, '$2y$10$336Haz1/w2Vpii0zTlqJouUxCQgfIY.lMYTzOfvmkD5ErFr58Pfr.', NULL, '03000000000', 0, NULL, NULL, 1, NULL, NULL, '2021-11-17 15:38:44', '2021-11-17 15:38:44', NULL),
(129, 'test56', 3, 'signup', NULL, 'test56@gmail.com', NULL, 0, NULL, '$2y$10$PlslaRZ.1xzvdKmdAkeUH.tf6fwO8nvCzjqill.fhRn3anB.egaiC', NULL, '03000000888', 0, NULL, NULL, 1, NULL, NULL, '2021-11-20 20:27:12', '2021-11-20 20:27:12', NULL),
(130, 'Test 43', 3, 'signup', NULL, 'test3@gmail.com', NULL, 0, NULL, '$2y$10$n0QQM3k1tVV9kWEIt7J6mO7cwX/JpRcoxjTpHV98wCGNdXLuVg5Ni', NULL, '03002523000', 0, NULL, NULL, 1, NULL, NULL, '2021-11-23 06:15:34', '2021-11-23 06:15:34', NULL),
(131, 'Hassan', 3, 'signup', NULL, 'ahaah@email.com', NULL, 0, NULL, '$2y$10$o31Pkxxd1gPSAkOt/rVcn.tW3rQ5GWOdMp1B6T0b3Qg0wioVmOYey', NULL, '03214568527', 0, NULL, NULL, 1, NULL, NULL, '2021-11-25 04:07:27', '2021-11-25 04:07:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `address_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_default_address` tinyint(1) NOT NULL DEFAULT 0,
  `user_zone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_street_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_building_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_floor_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_appartment_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `country_id`, `city_id`, `address_type_id`, `user_default_address`, `user_zone_no`, `user_street_no`, `user_building_no`, `user_floor_no`, `user_appartment_no`, `user_address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 114, 1, 1, 1, 1, '54000', '12', '123', '2', '202', NULL, '2021-11-17 04:00:39', '2021-11-19 05:24:48', '2021-11-19 05:24:48'),
(4, 114, 1, 4, 2, 0, '4400', '23', '54', '6', '606', NULL, '2021-11-17 04:04:47', '2021-11-30 01:29:29', '2021-11-30 01:29:29'),
(5, 114, 1, 1, 3, 1, '12121', '12122121212121', '212121', '22121', '12121', NULL, '2021-11-17 05:19:04', '2021-11-30 01:29:29', '2021-11-30 01:29:29'),
(6, 114, 1, 5, 1, 0, '550000', '12', '23', '23', '202', NULL, '2021-11-17 05:27:23', '2021-11-19 05:24:44', '2021-11-19 05:24:44'),
(7, 114, 1, 5, 1, 0, '550000', '12', '23', '23', '202', NULL, '2021-11-17 05:28:29', '2021-11-19 05:24:46', '2021-11-19 05:24:46'),
(8, 114, 1, 1, 1, 0, '12', '12', '12', '12', '12', NULL, '2021-11-17 05:29:15', '2021-11-30 01:29:29', '2021-11-30 01:29:29'),
(9, 114, 1, 1, 1, 0, '12121', '12', '12', '12', '12', NULL, '2021-11-17 06:53:03', '2021-11-19 05:24:42', '2021-11-19 05:24:42'),
(10, 114, 1, 7, 1, 1, '12', '12', '12', '12', '12', NULL, '2021-11-18 02:35:35', '2021-11-19 05:24:53', '2021-11-19 05:24:53'),
(11, 114, 1, 2, 1, 0, '3333', '33', '33', '33', '33', NULL, '2021-11-18 02:46:14', '2021-11-30 01:29:29', '2021-11-30 01:29:29'),
(12, 114, 1, 2, 1, 1, '12', '12', '12', '12', '12', NULL, '2021-11-18 07:52:51', '2021-11-19 05:24:50', '2021-11-19 05:24:50'),
(13, 114, 1, 4, 1, 1, '99', '99', '99', '99', '99', NULL, '2021-11-18 08:47:09', '2021-11-20 03:07:29', '2021-11-20 03:07:29'),
(14, 114, 1, 6, 3, 0, '45', '45', '45', '45', '45', NULL, '2021-11-18 08:47:26', '2021-11-30 01:29:29', '2021-11-30 01:29:29'),
(15, 114, 1, 1, 1, 0, '3434', '3434', '3434', '3434', '3434', NULL, '2021-11-18 09:18:21', '2021-11-19 07:54:31', '2021-11-19 07:54:31'),
(16, 114, 1, 1, 1, 0, '5654', '65', '65', '65', '56', NULL, '2021-11-18 09:23:07', '2021-11-19 05:52:06', '2021-11-19 05:52:06'),
(17, 114, 1, 1, 1, 0, '545', 'te', 'et', 'et', 'et', NULL, '2021-11-18 09:25:50', '2021-11-19 05:24:26', '2021-11-19 05:24:26'),
(18, 114, 1, 1, 1, 0, '545', 'te', 'et', 'et', 'et', NULL, '2021-11-18 09:26:24', '2021-11-19 05:24:25', '2021-11-19 05:24:25'),
(19, 114, 1, 1, 1, 0, '5466', 'rtrt', 'rtrt', 'rtrt', 'rtrt', NULL, '2021-11-18 09:27:56', '2021-11-19 05:24:24', '2021-11-19 05:24:24'),
(20, 114, 1, 6, 1, 0, '23', '23', '23', '23', '23', 'new address', '2021-11-18 09:48:48', '2021-11-19 05:24:04', '2021-11-19 05:24:04'),
(21, 4, 1, 2, 3, 0, '10', '2', '20', '10', '10', NULL, '2021-11-19 03:43:14', '2021-11-19 03:43:14', NULL),
(22, 114, 1, 8, 1, 1, '54000', 'stret number', '21', '2', '102', 'Some Address there', '2021-11-19 08:04:48', '2021-11-30 01:29:29', '2021-11-30 01:29:29'),
(23, 114, 1, 6, 1, 0, '3333', '333', '333', '33', '333', 'new address', '2021-11-20 09:16:39', '2021-11-20 09:16:49', '2021-11-20 09:16:49'),
(24, 114, 1, 3, 2, 0, '2323', '23', '23', '23', '23', '232323', '2021-11-25 06:03:47', '2021-11-30 01:29:29', '2021-11-30 01:29:29'),
(25, 114, 1, 1, 3, 0, '12', '121', '1212', '12', '1212', '21212', '2021-11-25 06:11:56', '2021-11-30 01:29:29', '2021-11-30 01:29:29'),
(26, 114, 1, 3, 1, 0, '54000', '122', '21', '21', '21', 'some Address', '2021-11-30 01:57:21', '2021-11-30 01:57:21', NULL),
(27, 114, 1, 1, 2, 0, '65000', '65', '65', '65', '65', 'address', '2021-11-30 01:58:29', '2021-11-30 01:58:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `variant_attributes`
--

CREATE TABLE `variant_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `key_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variant_attributes`
--

INSERT INTO `variant_attributes` (`id`, `product_variant_id`, `attribute_id`, `key_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(443, 259, 1, 1, '2021-11-15 06:57:45', '2021-11-15 06:57:45', NULL),
(444, 259, 17, 103, '2021-11-15 06:57:45', '2021-11-15 06:57:45', NULL),
(445, 260, 1, 1, '2021-11-15 06:57:45', '2021-11-15 06:57:45', NULL),
(446, 260, 17, 104, '2021-11-15 06:57:45', '2021-11-15 06:57:45', NULL),
(447, 261, 1, 1, '2021-11-15 06:57:45', '2021-11-15 06:57:45', NULL),
(448, 261, 17, 105, '2021-11-15 06:57:45', '2021-11-15 06:57:45', NULL),
(449, 262, 1, 1, '2021-11-15 06:57:45', '2021-11-15 06:57:45', NULL),
(450, 262, 17, 106, '2021-11-15 06:57:45', '2021-11-15 06:57:45', NULL),
(451, 263, 1, 1, '2021-11-15 07:10:51', '2021-11-15 07:10:51', NULL),
(452, 263, 17, 103, '2021-11-15 07:10:51', '2021-11-15 07:10:51', NULL),
(453, 264, 1, 1, '2021-11-15 07:10:51', '2021-11-15 07:10:51', NULL),
(454, 264, 17, 104, '2021-11-15 07:10:51', '2021-11-15 07:10:51', NULL),
(455, 265, 1, 1, '2021-11-15 07:10:51', '2021-11-15 07:10:51', NULL),
(456, 265, 17, 105, '2021-11-15 07:10:51', '2021-11-15 07:10:51', NULL),
(457, 266, 1, 1, '2021-11-15 07:10:51', '2021-11-15 07:10:51', NULL),
(458, 266, 17, 106, '2021-11-15 07:10:51', '2021-11-15 07:10:51', NULL),
(459, 267, 1, 1, '2021-11-15 07:19:15', '2021-11-15 07:19:15', NULL),
(460, 267, 17, 103, '2021-11-15 07:19:15', '2021-11-15 07:19:15', NULL),
(461, 268, 1, 1, '2021-11-15 07:19:15', '2021-11-15 07:19:15', NULL),
(462, 268, 17, 104, '2021-11-15 07:19:15', '2021-11-15 07:19:15', NULL),
(463, 269, 1, 1, '2021-11-15 07:19:15', '2021-11-15 07:19:15', NULL),
(464, 269, 17, 105, '2021-11-15 07:19:15', '2021-11-15 07:19:15', NULL),
(465, 270, 1, 1, '2021-11-15 07:19:15', '2021-11-15 07:19:15', NULL),
(466, 270, 17, 106, '2021-11-15 07:19:15', '2021-11-15 07:19:15', NULL),
(467, 271, 1, 1, '2021-11-15 07:28:43', '2021-11-15 07:28:43', NULL),
(468, 271, 17, 103, '2021-11-15 07:28:43', '2021-11-15 07:28:43', NULL),
(469, 272, 1, 1, '2021-11-15 07:28:43', '2021-11-15 07:28:43', NULL),
(470, 272, 17, 104, '2021-11-15 07:28:43', '2021-11-15 07:28:43', NULL),
(471, 273, 1, 1, '2021-11-15 07:28:43', '2021-11-15 07:28:43', NULL),
(472, 273, 17, 105, '2021-11-15 07:28:43', '2021-11-15 07:28:43', NULL),
(473, 274, 1, 1, '2021-11-15 07:28:43', '2021-11-15 07:28:43', NULL),
(474, 274, 17, 106, '2021-11-15 07:28:43', '2021-11-15 07:28:43', NULL),
(475, 275, 1, 1, '2021-11-15 09:22:50', '2021-11-15 09:22:50', NULL),
(476, 275, 17, 103, '2021-11-15 09:22:50', '2021-11-15 09:22:50', NULL),
(477, 276, 1, 3, '2021-11-15 09:22:50', '2021-11-15 09:22:50', NULL),
(478, 276, 17, 104, '2021-11-15 09:22:50', '2021-11-15 09:22:50', NULL),
(479, 277, 1, 4, '2021-11-15 09:22:50', '2021-11-15 09:22:50', NULL),
(480, 277, 17, 105, '2021-11-15 09:22:50', '2021-11-15 09:22:50', NULL),
(481, 278, 1, 9, '2021-11-15 09:22:50', '2021-11-15 09:22:50', NULL),
(482, 278, 17, 106, '2021-11-15 09:22:50', '2021-11-15 09:22:50', NULL),
(483, 279, 1, 1, '2021-11-15 09:28:45', '2021-11-15 09:28:45', NULL),
(484, 279, 17, 103, '2021-11-15 09:28:45', '2021-11-15 09:28:45', NULL),
(485, 280, 1, 4, '2021-11-15 09:28:45', '2021-11-15 09:28:45', NULL),
(486, 280, 17, 104, '2021-11-15 09:28:45', '2021-11-15 09:28:45', NULL),
(487, 281, 1, 1, '2021-11-15 09:28:45', '2021-11-15 09:28:45', NULL),
(488, 281, 17, 105, '2021-11-15 09:28:45', '2021-11-15 09:28:45', NULL),
(489, 282, 1, 5, '2021-11-15 09:28:45', '2021-11-15 09:28:45', NULL),
(490, 282, 17, 106, '2021-11-15 09:28:45', '2021-11-15 09:28:45', NULL),
(491, 283, 1, 1, '2021-11-15 09:34:08', '2021-11-15 09:34:08', NULL),
(492, 283, 17, 103, '2021-11-15 09:34:08', '2021-11-15 09:34:08', NULL),
(493, 284, 1, 1, '2021-11-15 09:34:08', '2021-11-15 09:34:08', NULL),
(494, 284, 17, 104, '2021-11-15 09:34:08', '2021-11-15 09:34:08', NULL),
(495, 285, 1, 4, '2021-11-15 09:34:08', '2021-11-15 09:34:08', NULL),
(496, 285, 17, 105, '2021-11-15 09:34:08', '2021-11-15 09:34:08', NULL),
(497, 286, 1, 4, '2021-11-15 09:34:08', '2021-11-15 09:34:08', NULL),
(498, 286, 17, 106, '2021-11-15 09:34:08', '2021-11-15 09:34:08', NULL),
(500, 290, 1, 5, '2021-11-16 05:56:57', '2021-11-16 05:56:57', NULL),
(501, 290, 17, 103, '2021-11-16 05:56:57', '2021-11-16 05:56:57', NULL),
(502, 291, 1, 5, '2021-11-16 05:56:57', '2021-11-16 05:56:57', NULL),
(503, 291, 17, 104, '2021-11-16 05:56:57', '2021-11-16 05:56:57', NULL),
(504, 292, 1, 5, '2021-11-16 05:56:57', '2021-11-16 05:56:57', NULL),
(505, 292, 17, 105, '2021-11-16 05:56:57', '2021-11-16 05:56:57', NULL),
(506, 293, 1, 1, '2021-11-16 11:09:10', '2021-11-16 11:09:10', NULL),
(507, 294, 1, 1, '2021-11-16 11:16:49', '2021-11-16 11:16:49', NULL),
(508, 295, 1, 1, '2021-11-16 11:26:54', '2021-11-16 11:26:54', NULL),
(509, 296, 1, 1, '2021-11-16 11:31:03', '2021-11-16 11:31:03', NULL),
(510, 297, 11, 77, '2021-11-17 05:45:04', '2021-11-17 05:45:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_requests`
--

CREATE TABLE `vendor_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_reviewed` tinyint(1) NOT NULL DEFAULT 0,
  `review_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_requests`
--

INSERT INTO `vendor_requests` (`id`, `user_id`, `is_reviewed`, `review_note`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 2, 1, NULL, '2021-11-15 06:21:41', '2021-11-15 07:27:05', NULL),
(11, 80, 1, 'Your Business documents are not clear enough.', '2021-11-15 09:12:20', '2021-11-15 10:09:56', NULL),
(12, 109, 0, NULL, '2021-11-15 10:45:06', '2021-11-15 10:45:06', NULL),
(13, 124, 0, NULL, '2021-11-15 11:00:00', '2021-11-15 11:00:00', NULL),
(14, 125, 0, NULL, '2021-11-16 09:01:53', '2021-11-16 09:01:53', NULL),
(15, 126, 0, NULL, '2021-11-16 09:38:40', '2021-11-16 09:38:40', NULL),
(16, 127, 0, NULL, '2021-11-16 09:54:02', '2021-11-16 09:54:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_addresses`
--

CREATE TABLE `warehouse_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warehouse_phone_no` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warehouse_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_zone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_street_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_building_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_floor_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_appartment_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouse_addresses`
--

INSERT INTO `warehouse_addresses` (`id`, `store_id`, `warehouse_name`, `warehouse_phone_no`, `warehouse_email`, `country_id`, `city_id`, `warehouse_zone_no`, `warehouse_street_no`, `warehouse_building_no`, `warehouse_floor_no`, `warehouse_appartment_no`, `warehouse_address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, 26, 'Doha Qatar', '0302145262331', 'test@gmail.com', 1, 1, '2211', '21', '323', '3', '456', NULL, '2021-11-15 06:18:30', '2021-11-15 06:18:30', NULL),
(14, 28, 'Storak', '0315541115521', 'test@gmail.com', 1, 1, '2233', '45', '22', '1', '66', NULL, '2021-11-15 09:11:20', '2021-11-15 09:11:20', NULL),
(15, 27, 'RR Electronics', '97400000000', 'socialmedia@storak.digital.com', 1, 1, '00', '00', '00', '00', '00', '00000000', '2021-11-15 10:43:38', '2021-11-15 10:44:37', NULL),
(16, 29, 'Minu', '0302489156214', 'minhaskhara.storak@gmail.com', 1, 5, '4433', '776', '3322', '5', '454', NULL, '2021-11-15 10:52:16', '2021-11-15 10:52:16', NULL),
(17, 30, 'Storak', '0302525485414', 'minhaskhara.storak@gmail.com', 1, 1, '325', '3212', '12', '5', '34', NULL, '2021-11-16 09:00:40', '2021-11-16 09:00:40', NULL),
(18, 31, 'Multan, Pakistan', '03116311111', 'bzu@gmail.com', 1, 1, '12-DOHA', 'Multan, Pakistan', '12', '2', '22', NULL, '2021-11-16 09:37:34', '2021-11-16 09:37:34', NULL),
(19, 32, 'Multan, Pakistan', '03116311111', 'bzu@gmail.com', 1, 1, '123', 'Multan, Pakistan', '18-A', '2', '5', NULL, '2021-11-16 09:53:22', '2021-11-16 09:53:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `warranty_periods`
--

CREATE TABLE `warranty_periods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warranty_periods`
--

INSERT INTO `warranty_periods` (`id`, `period`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1 Month', 1, NULL, NULL, NULL),
(2, '2 Months', 1, NULL, NULL, NULL),
(3, '3 Months', 1, NULL, NULL, NULL),
(4, '4 Months', 1, NULL, NULL, NULL),
(5, '5 Month', 1, NULL, NULL, NULL),
(6, '6 Months', 1, NULL, NULL, NULL),
(7, '7 Months', 1, NULL, NULL, NULL),
(8, '8 Months', 1, NULL, NULL, NULL),
(9, '9 Month', 1, NULL, NULL, NULL),
(10, '10 Months', 1, NULL, NULL, NULL),
(11, '11 Months', 1, NULL, NULL, NULL),
(12, '1 Year', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_items`
--

CREATE TABLE `wishlist_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlist_items`
--

INSERT INTO `wishlist_items` (`id`, `user_id`, `product_id`, `product_variant_id`, `created_at`, `updated_at`) VALUES
(16, 129, 236, 260, '2021-11-22 08:57:21', '2021-11-22 08:57:21'),
(17, 129, 237, 263, '2021-11-22 08:58:08', '2021-11-22 08:58:08'),
(23, 108, 236, 259, '2021-11-23 05:29:54', '2021-11-23 05:29:54'),
(24, 108, 237, 263, '2021-11-23 05:33:06', '2021-11-23 05:33:06'),
(27, 110, 238, 267, '2021-11-23 07:21:05', '2021-11-23 07:21:05'),
(28, 110, 237, 265, '2021-11-23 07:27:39', '2021-11-23 07:27:39'),
(29, 110, 241, 280, '2021-11-23 08:04:46', '2021-11-23 08:04:46'),
(30, 114, 248, 294, '2021-11-30 07:07:52', '2021-11-30 07:07:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_types`
--
ALTER TABLE `address_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_key`
--
ALTER TABLE `attribute_key`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_product`
--
ALTER TABLE `attribute_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_product_product_id_foreign` (`product_id`),
  ADD KEY `attribute_product_attribute_id_foreign` (`attribute_id`),
  ADD KEY `attribute_product_key_id_foreign` (`key_id`);

--
-- Indexes for table `attribute_subcategory`
--
ALTER TABLE `attribute_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_accounts_user_id_foreign` (`user_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_category`
--
ALTER TABLE `brand_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_documents`
--
ALTER TABLE `business_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_documents_business_information_id_foreign` (`business_information_id`),
  ADD KEY `business_documents_document_input_id_foreign` (`document_input_id`);

--
-- Indexes for table `business_information`
--
ALTER TABLE `business_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_information_user_id_foreign` (`user_id`),
  ADD KEY `business_information_country_id_foreign` (`country_id`),
  ADD KEY `business_information_city_id_foreign` (`city_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_user_id_foreign` (`user_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`),
  ADD KEY `cart_items_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `child_categories`
--
ALTER TABLE `child_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `child_categories_category_id_foreign` (`category_id`),
  ADD KEY `child_categories_subcategory_id_foreign` (`subcategory_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_foreign` (`country_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`),
  ADD KEY `coupons_store_id_foreign` (`store_id`);

--
-- Indexes for table `coupon_product_variant`
--
ALTER TABLE `coupon_product_variant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_product_variant_coupon_id_foreign` (`coupon_id`),
  ADD KEY `coupon_product_variant_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `coupon_user`
--
ALTER TABLE `coupon_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_user_coupon_id_foreign` (`coupon_id`),
  ADD KEY `coupon_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_inputs`
--
ALTER TABLE `document_inputs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_inputs_document_id_foreign` (`document_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fulfillments`
--
ALTER TABLE `fulfillments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fulfillment_product`
--
ALTER TABLE `fulfillment_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goods_types`
--
ALTER TABLE `goods_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_covers`
--
ALTER TABLE `mobile_covers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_store_id_foreign` (`store_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_billing_address_id_foreign` (`billing_address_id`),
  ADD KEY `orders_shipping_address_id_foreign` (`shipping_address_id`);

--
-- Indexes for table `order_packages`
--
ALTER TABLE `order_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_packages_order_id_foreign` (`order_id`),
  ADD KEY `order_packages_store_id_foreign` (`store_id`),
  ADD KEY `order_packages_fulfillment_id_foreign` (`fulfillment_id`),
  ADD KEY `order_packages_order_status_id_foreign` (`order_status_id`);

--
-- Indexes for table `order_package_histories`
--
ALTER TABLE `order_package_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_package_histories_order_package_id_foreign` (`order_package_id`),
  ADD KEY `order_package_histories_order_status_id_foreign` (`order_status_id`);

--
-- Indexes for table `order_package_items`
--
ALTER TABLE `order_package_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_package_items_order_package_id_foreign` (`order_package_id`),
  ADD KEY `order_package_items_product_id_foreign` (`product_id`),
  ADD KEY `order_package_items_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `order_shipping_requests`
--
ALTER TABLE `order_shipping_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_shipping_requests_shipping_company_id_foreign` (`shipping_company_id`),
  ADD KEY `order_shipping_requests_order_package_id_foreign` (`order_package_id`),
  ADD KEY `order_shipping_requests_goods_type_id_foreign` (`goods_type_id`),
  ADD KEY `order_shipping_requests_order_status_id_foreign` (`order_status_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_subcategory_id_foreign` (`subcategory_id`),
  ADD KEY `products_childcategory_id_foreign` (`childcategory_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_store_id_foreign` (`store_id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attributes_product_id_foreign` (`product_id`),
  ADD KEY `product_attributes_attribute_id_foreign` (`attribute_id`),
  ADD KEY `product_attributes_key_id_foreign` (`key_id`);

--
-- Indexes for table `product_average_ratings`
--
ALTER TABLE `product_average_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_average_ratings_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_questions`
--
ALTER TABLE `product_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_questions_product_id_foreign` (`product_id`),
  ADD KEY `product_questions_user_id_foreign` (`user_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`),
  ADD KEY `product_reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`);

--
-- Indexes for table `return_addresses`
--
ALTER TABLE `return_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `return_addresses_store_id_foreign` (`store_id`),
  ADD KEY `return_addresses_country_id_foreign` (`country_id`),
  ADD KEY `return_addresses_city_id_foreign` (`city_id`);

--
-- Indexes for table `review_images`
--
ALTER TABLE `review_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_images_product_review_id_foreign` (`product_review_id`);

--
-- Indexes for table `shipping_companies`
--
ALTER TABLE `shipping_companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shipping_companies_email_unique` (`email`),
  ADD UNIQUE KEY `shipping_companies_mobile_unique` (`mobile`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stores_user_id_foreign` (`user_id`);

--
-- Indexes for table `store_user`
--
ALTER TABLE `store_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subroles`
--
ALTER TABLE `subroles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subrole_user`
--
ALTER TABLE `subrole_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_addresses_user_id_foreign` (`user_id`),
  ADD KEY `user_addresses_country_id_foreign` (`country_id`),
  ADD KEY `user_addresses_city_id_foreign` (`city_id`),
  ADD KEY `user_addresses_address_type_id_foreign` (`address_type_id`);

--
-- Indexes for table `variant_attributes`
--
ALTER TABLE `variant_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variant_attributes_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `vendor_requests`
--
ALTER TABLE `vendor_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `warehouse_addresses`
--
ALTER TABLE `warehouse_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warehouse_addresses_store_id_foreign` (`store_id`),
  ADD KEY `warehouse_addresses_country_id_foreign` (`country_id`),
  ADD KEY `warehouse_addresses_city_id_foreign` (`city_id`);

--
-- Indexes for table `warranty_periods`
--
ALTER TABLE `warranty_periods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlist_items_user_id_foreign` (`user_id`),
  ADD KEY `wishlist_items_product_id_foreign` (`product_id`),
  ADD KEY `wishlist_items_product_variant_id_foreign` (`product_variant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_types`
--
ALTER TABLE `address_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `attribute_key`
--
ALTER TABLE `attribute_key`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `attribute_product`
--
ALTER TABLE `attribute_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attribute_subcategory`
--
ALTER TABLE `attribute_subcategory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `brand_category`
--
ALTER TABLE `brand_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `business_documents`
--
ALTER TABLE `business_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `business_information`
--
ALTER TABLE `business_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `child_categories`
--
ALTER TABLE `child_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `coupon_product_variant`
--
ALTER TABLE `coupon_product_variant`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_user`
--
ALTER TABLE `coupon_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `document_inputs`
--
ALTER TABLE `document_inputs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fulfillments`
--
ALTER TABLE `fulfillments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fulfillment_product`
--
ALTER TABLE `fulfillment_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goods_types`
--
ALTER TABLE `goods_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `mobile_covers`
--
ALTER TABLE `mobile_covers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=425;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT for table `order_packages`
--
ALTER TABLE `order_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=454;

--
-- AUTO_INCREMENT for table `order_package_histories`
--
ALTER TABLE `order_package_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=590;

--
-- AUTO_INCREMENT for table `order_package_items`
--
ALTER TABLE `order_package_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1278;

--
-- AUTO_INCREMENT for table `order_shipping_requests`
--
ALTER TABLE `order_shipping_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=948;

--
-- AUTO_INCREMENT for table `product_average_ratings`
--
ALTER TABLE `product_average_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `product_questions`
--
ALTER TABLE `product_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT for table `return_addresses`
--
ALTER TABLE `return_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `review_images`
--
ALTER TABLE `review_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `shipping_companies`
--
ALTER TABLE `shipping_companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `store_user`
--
ALTER TABLE `store_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subroles`
--
ALTER TABLE `subroles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subrole_user`
--
ALTER TABLE `subrole_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `variant_attributes`
--
ALTER TABLE `variant_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=511;

--
-- AUTO_INCREMENT for table `vendor_requests`
--
ALTER TABLE `vendor_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `warehouse_addresses`
--
ALTER TABLE `warehouse_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `warranty_periods`
--
ALTER TABLE `warranty_periods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_product`
--
ALTER TABLE `attribute_product`
  ADD CONSTRAINT `attribute_product_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_product_key_id_foreign` FOREIGN KEY (`key_id`) REFERENCES `keys` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD CONSTRAINT `bank_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `business_documents`
--
ALTER TABLE `business_documents`
  ADD CONSTRAINT `business_documents_business_information_id_foreign` FOREIGN KEY (`business_information_id`) REFERENCES `business_information` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `business_documents_document_input_id_foreign` FOREIGN KEY (`document_input_id`) REFERENCES `document_inputs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `business_information`
--
ALTER TABLE `business_information`
  ADD CONSTRAINT `business_information_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `business_information_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `business_information_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `child_categories`
--
ALTER TABLE `child_categories`
  ADD CONSTRAINT `child_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `child_categories_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `coupons_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coupon_product_variant`
--
ALTER TABLE `coupon_product_variant`
  ADD CONSTRAINT `coupon_product_variant_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_product_variant_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coupon_user`
--
ALTER TABLE `coupon_user`
  ADD CONSTRAINT `coupon_user_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `document_inputs`
--
ALTER TABLE `document_inputs`
  ADD CONSTRAINT `document_inputs_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_billing_address_id_foreign` FOREIGN KEY (`billing_address_id`) REFERENCES `user_addresses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_shipping_address_id_foreign` FOREIGN KEY (`shipping_address_id`) REFERENCES `user_addresses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_packages`
--
ALTER TABLE `order_packages`
  ADD CONSTRAINT `order_packages_fulfillment_id_foreign` FOREIGN KEY (`fulfillment_id`) REFERENCES `fulfillments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_packages_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_packages_order_status_id_foreign` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_packages_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_package_histories`
--
ALTER TABLE `order_package_histories`
  ADD CONSTRAINT `order_package_histories_order_package_id_foreign` FOREIGN KEY (`order_package_id`) REFERENCES `order_packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_package_histories_order_status_id_foreign` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_package_items`
--
ALTER TABLE `order_package_items`
  ADD CONSTRAINT `order_package_items_order_package_id_foreign` FOREIGN KEY (`order_package_id`) REFERENCES `order_packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_package_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_package_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_shipping_requests`
--
ALTER TABLE `order_shipping_requests`
  ADD CONSTRAINT `order_shipping_requests_goods_type_id_foreign` FOREIGN KEY (`goods_type_id`) REFERENCES `goods_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_shipping_requests_order_package_id_foreign` FOREIGN KEY (`order_package_id`) REFERENCES `order_packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_shipping_requests_order_status_id_foreign` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_shipping_requests_shipping_company_id_foreign` FOREIGN KEY (`shipping_company_id`) REFERENCES `shipping_companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_childcategory_id_foreign` FOREIGN KEY (`childcategory_id`) REFERENCES `child_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `product_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_average_ratings`
--
ALTER TABLE `product_average_ratings`
  ADD CONSTRAINT `product_average_ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_questions`
--
ALTER TABLE `product_questions`
  ADD CONSTRAINT `product_questions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_questions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `return_addresses`
--
ALTER TABLE `return_addresses`
  ADD CONSTRAINT `return_addresses_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `return_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `return_addresses_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `review_images`
--
ALTER TABLE `review_images`
  ADD CONSTRAINT `review_images_product_review_id_foreign` FOREIGN KEY (`product_review_id`) REFERENCES `product_reviews` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `stores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_address_type_id_foreign` FOREIGN KEY (`address_type_id`) REFERENCES `address_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_addresses_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `variant_attributes`
--
ALTER TABLE `variant_attributes`
  ADD CONSTRAINT `variant_attributes_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vendor_requests`
--
ALTER TABLE `vendor_requests`
  ADD CONSTRAINT `vendor_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `warehouse_addresses`
--
ALTER TABLE `warehouse_addresses`
  ADD CONSTRAINT `warehouse_addresses_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `warehouse_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `warehouse_addresses_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
  ADD CONSTRAINT `wishlist_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
