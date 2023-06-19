-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2023 at 05:28 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wristwatches`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_of_origin` varchar(255) NOT NULL,
  `year_established` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `country_of_origin`, `year_established`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Rolex', 'Switzerland', 1905, 'public/brands/xNscl0Ggwf3S46LmMoWRtRhRGT1nzMcxetKZf86G.png', '2023-06-19 09:06:39', '2023-06-19 09:06:39'),
(2, 'Omege', 'Switzerland', 1848, 'public/brands/IsX8TduU30hF7HjLh43tRd1POnV2lpSQQaIzFO7g.png', '2023-06-19 09:06:53', '2023-06-19 09:06:53'),
(3, 'Seiko', 'Japan', 1881, 'public/brands/FTbjTPMe0KuzxlDxSU5jLT6y0bTMhiSuPJ5LoMDG.webp', '2023-06-19 09:07:15', '2023-06-19 09:07:15'),
(4, 'Casio', 'Japan', 1946, 'public/brands/rgpqWQD3m694lHHsMRUAMGwvGlHsCExnNzmpPqbh.png', '2023-06-19 09:07:34', '2023-06-19 09:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `watch_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Sports', NULL, NULL),
(2, 'Luxury', NULL, NULL),
(3, 'Fashion', NULL, NULL),
(4, 'Smartwatches', NULL, NULL),
(5, 'Diving', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `release_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `brand_id`, `name`, `release_date`, `created_at`, `updated_at`) VALUES
(1, 1, 'Oyster Perpetual', '1926-01-01', '2023-06-19 09:08:03', '2023-06-19 09:08:03'),
(2, 1, 'Submariner', '1953-03-01', '2023-06-19 09:08:20', '2023-06-19 09:08:20'),
(3, 2, 'Speedmaster', '1957-04-01', '2023-06-19 09:08:35', '2023-06-19 09:08:35'),
(4, 2, 'Seamaster', '1948-07-01', '2023-06-19 09:08:58', '2023-06-19 09:08:58'),
(5, 3, 'Prospex', '1965-09-01', '2023-06-19 09:09:16', '2023-06-19 09:09:16'),
(6, 3, 'Carrera', '1963-01-01', '2023-06-19 09:09:40', '2023-06-19 09:09:40'),
(7, 4, 'G-Shock', '1983-04-01', '2023-06-19 09:10:04', '2023-06-19 09:10:04');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `reply` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `watch_id` bigint(20) UNSIGNED NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `watch_id`, `image_url`, `created_at`, `updated_at`) VALUES
(1, 11, 'public/images/YJ3Pmy08hi2Cb28U54QGR3z3pBcf5EnYtdRoTKNN.png', '2023-06-19 14:45:20', '2023-06-19 14:45:20'),
(2, 11, 'public/images/jxIeEXZbqQRMfWbARSaBWnW5WZKRbgHinzut4P5a.png', '2023-06-19 14:45:29', '2023-06-19 14:45:29'),
(3, 11, 'public/images/CpwT252peKkpqx8GQlh3r9qlZl8FmLAOQJWDdtEA.png', '2023-06-19 14:45:37', '2023-06-19 14:45:37'),
(4, 8, 'public/images/VNoKtYRTCRKCiettXQ6Tx3Z9pJS2NzpAdDnws3UW.png', '2023-06-19 14:46:39', '2023-06-19 14:46:39'),
(5, 8, 'public/images/GppMSyDsSwBXFi2da5JbzuYK6enzUKTxdWC2Tn5P.png', '2023-06-19 14:46:48', '2023-06-19 14:46:48'),
(6, 8, 'public/images/7UJ0ooNTsWItwGGmo2toVeA1iBT5gbnNciNQ8cji.png', '2023-06-19 14:46:56', '2023-06-19 14:46:56'),
(7, 8, 'public/images/RG1cdJg3bMWimCAK2yQ43yWYGFzHXuU3y3A0qaWz.png', '2023-06-19 14:47:03', '2023-06-19 14:47:03'),
(8, 1, 'public/images/F1UFp46sDsz4Au0wEMPQEQpYn6O6GUE8FGrpvSdj.png', '2023-06-19 14:48:21', '2023-06-19 14:48:21'),
(9, 1, 'public/images/nf6x23DSVkHWB1NUBhNdUrKQQ4i5zmlsNlizUtOr.jpg', '2023-06-19 14:48:31', '2023-06-19 14:48:31'),
(10, 1, 'public/images/aRxBa2UwDHV042BvnNp9o6MVYnoDXNJoMONgEkmy.png', '2023-06-19 14:48:38', '2023-06-19 14:48:38'),
(11, 7, 'public/images/DvpD515yErISOPFKRPSXpbPh5Q2dM2omwFg3GzNZ.jpg', '2023-06-19 14:51:20', '2023-06-19 14:51:20'),
(12, 7, 'public/images/sGfyUeDLfYxcrbFn30HM5Uhvb5gznWIp8roMHGlW.webp', '2023-06-19 14:51:28', '2023-06-19 14:51:28'),
(13, 7, 'public/images/4gj5AZ9mkLneAh93Vi8F5NwWdcSuls41fJmHcvVT.webp', '2023-06-19 14:51:34', '2023-06-19 14:51:34'),
(14, 10, 'public/images/HGSiwMcEGh93u4Zy8JSpgJ5ePiYDltoi63NYwHuH.png', '2023-06-19 14:52:29', '2023-06-19 14:52:29'),
(15, 10, 'public/images/1dKoukLHMag2RfYyLWOZcLQCnGxd9Iuw5gPfjExp.png', '2023-06-19 14:52:36', '2023-06-19 14:52:36'),
(16, 4, 'public/images/TmB6eVRnQaw1yKQ8N0QZKKRo27xY3zATzUVJUcEk.png', '2023-06-19 14:53:26', '2023-06-19 14:53:26'),
(17, 4, 'public/images/UlMxrNEd1jBmzvpzSattbW9CThFTqwXVEnXvfGBC.jpg', '2023-06-19 14:53:35', '2023-06-19 14:53:35'),
(18, 4, 'public/images/cxisRl9e51Q50qU9z1P5Wd5ziFhpjZn2JN45tU9x.jpg', '2023-06-19 14:53:42', '2023-06-19 14:53:42'),
(19, 13, 'public/images/AUdp1nCHwK49jdFRg7Fpo79Jor0OZTka7K5xaWLk.webp', '2023-06-19 14:54:16', '2023-06-19 14:54:16'),
(20, 13, 'public/images/1afZs6lc7YtFQcaU7viCCg1NQA4I821inRfRJPZa.png', '2023-06-19 14:54:25', '2023-06-19 14:54:25'),
(21, 13, 'public/images/nVj4R72binixXZyyGz4LHjO0D1kWoOZCbWOZyZQp.png', '2023-06-19 14:54:32', '2023-06-19 14:54:32'),
(22, 12, 'public/images/jvxAFhzPJIXJ5PIrDCFDhJMXoVmwBteJXQLBOVle.png', '2023-06-19 14:55:22', '2023-06-19 14:55:22'),
(23, 12, 'public/images/fqA6mr5o3KWMcEd5r4szVQYZu6n6pjHef0FHHl4P.png', '2023-06-19 14:55:30', '2023-06-19 14:55:30'),
(24, 12, 'public/images/SZm37bZVKEPNvkd8M6WspPzEczCE4S8wsZaKtLlL.png', '2023-06-19 14:55:37', '2023-06-19 14:55:37'),
(25, 12, 'public/images/u1748efkCgOD1YNwc61q2OBZx2xSiSMFQQhTel7t.png', '2023-06-19 14:55:45', '2023-06-19 14:55:45'),
(26, 6, 'public/images/7PJFh5W7u9ALW0AQXptHD3RXBTyQwawWp1RLRL1r.png', '2023-06-19 14:59:01', '2023-06-19 14:59:01'),
(27, 6, 'public/images/Towqsp8qA0sSDGEmUJeZv20PjbPOOO6MTUg2tjVH.png', '2023-06-19 14:59:09', '2023-06-19 14:59:09'),
(28, 6, 'public/images/e5llgiRjjWucztL2S1tdxAdcyeyxT86d8S4C4fG1.webp', '2023-06-19 14:59:16', '2023-06-19 14:59:16'),
(29, 9, 'public/images/FVwYviSleMzSDQxoaZ2iogmkNTxjQbLuc2ASdbBC.png', '2023-06-19 15:00:08', '2023-06-19 15:00:08'),
(30, 9, 'public/images/HefyBOSekbmy4NHTJfOXTa3DlXsaAkqWVx7Tch1T.webp', '2023-06-19 15:00:14', '2023-06-19 15:00:14'),
(31, 3, 'public/images/toUu63wdElCag1N8Xq4UlMFyc6qAhMTHavRVhgvh.png', '2023-06-19 15:01:07', '2023-06-19 15:01:07'),
(32, 3, 'public/images/hMEN4DmKClmnQchW72wrSpW5jfBR4QYHjikRbHj5.webp', '2023-06-19 15:01:14', '2023-06-19 15:01:14'),
(33, 3, 'public/images/sY8OqTs2Y0kSftNHgq2DcKi0MC0jmSZmzXKpR6UO.webp', '2023-06-19 15:01:22', '2023-06-19 15:01:22'),
(34, 5, 'public/images/5B0zSG2bhIwcWgQ5DshaObjo2PSgANno8IT7RfPN.png', '2023-06-19 15:02:30', '2023-06-19 15:02:30'),
(35, 5, 'public/images/KFud70nF0pwbWP0RXzuo3cL3TS2shW4ElRNpdX0D.png', '2023-06-19 15:02:36', '2023-06-19 15:02:36'),
(36, 2, 'public/images/Z1Tm67KtXuemeZyVylM1uIJvMjzbpqmrS1zUD8jm.png', '2023-06-19 15:04:10', '2023-06-19 15:04:10'),
(37, 2, 'public/images/oaf1mpzlUImRe3CVw3UegcJcmtmmbUZxxdP8drkb.png', '2023-06-19 15:04:17', '2023-06-19 15:04:17');

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
(231, '2014_10_12_000000_create_users_table', 1),
(232, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(233, '2014_10_12_100000_create_password_resets_table', 1),
(234, '2019_08_19_000000_create_failed_jobs_table', 1),
(235, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(236, '2023_06_07_163136_create_categories_table', 1),
(237, '2023_06_07_172431_create_brands_table', 1),
(238, '2023_06_07_173214_create_collections_table', 1),
(239, '2023_06_07_174716_create_watches_table', 1),
(240, '2023_06_07_175728_create_watch_category_table', 1),
(241, '2023_06_07_181622_create_receivers_table', 1),
(242, '2023_06_07_182058_create_orders_table', 1),
(243, '2023_06_07_182432_create_order_details_table', 1),
(244, '2023_06_07_184532_create_images_table', 1),
(245, '2023_06_07_185351_create_carts_table', 1),
(246, '2023_06_07_185826_create_reviews_table', 1),
(247, '2023_06_12_224628_create_contacts_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `order_date` datetime NOT NULL,
  `delivery_date` datetime NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `total_price` decimal(8,2) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `watch_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receivers`
--

CREATE TABLE `receivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `watch_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `email_verified_at`, `password`, `gender`, `birthday`, `telephone`, `address`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nguyen Duy Quang', '(FGW CT)', 'quangndgcc200030@fpt.edu.vn', '2023-06-19 08:53:59', '$2y$10$GooQvvFGHn9taanw96.Ile6A2DhDQ3F3GSf5kRjG3/zYqMPeb6Ap6', NULL, NULL, NULL, NULL, 1, NULL, '2023-06-19 08:53:59', '2023-06-19 08:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `watches`
--

CREATE TABLE `watches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `collection_id` bigint(20) UNSIGNED NOT NULL,
  `model` varchar(255) NOT NULL,
  `original_price` decimal(8,2) NOT NULL,
  `selling_price` decimal(8,2) NOT NULL,
  `discount` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `case_material` varchar(255) NOT NULL,
  `case_diameter` int(11) NOT NULL,
  `case_thickness` int(11) NOT NULL,
  `strap_material` varchar(255) NOT NULL,
  `dial_color` varchar(255) NOT NULL,
  `crystal_material` varchar(255) NOT NULL,
  `water_resistance` int(11) NOT NULL,
  `movement_type` varchar(255) NOT NULL,
  `power_reserve` int(11) NOT NULL,
  `complications` varchar(255) NOT NULL,
  `availability` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `watches`
--

INSERT INTO `watches` (`id`, `collection_id`, `model`, `original_price`, `selling_price`, `discount`, `stock`, `gender`, `case_material`, `case_diameter`, `case_thickness`, `strap_material`, `dial_color`, `crystal_material`, `water_resistance`, `movement_type`, `power_reserve`, `complications`, `availability`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rolex Datejust 36', '9800.00', '10000.00', 0, 12, 'Unisex', 'Stainless', 36, 11, 'Leather', 'Black', 'Sapphire', 100, 'Automatic', 48, 'Date', 1, NULL, '2023-06-19 14:48:04'),
(2, 2, 'Omega Speedmaster Anniversary Series 42mm', '4800.00', '5000.00', 0, 11, 'Men', 'Stainless', 42, 14, 'Steel', 'Blue', 'Sapphire', 50, 'Automatic', 60, 'Chronograph', 1, NULL, '2023-06-19 15:03:58'),
(3, 3, 'Seiko Prospex SNJ039P1', '1300.00', '1500.00', 0, 10, 'Men', 'Stainless', 44, 13, 'Rubber', 'Black', 'Hardlex', 200, 'Automatic', 50, 'Date, Rotating Bezel', 1, NULL, '2023-06-19 15:00:51'),
(4, 1, 'Rolex Explorer II', '8300.00', '8500.00', 0, 5, 'Men', 'Stainless', 42, 12, 'Steel', 'White', 'Sapphire', 100, 'Automatic', 70, 'Date, GMT', 1, NULL, '2023-06-19 14:52:58'),
(5, 2, 'Omega Seamaster Aqua Terra 150m', '4000.00', '4200.00', 0, 4, 'Women', 'Stainless', 36, 10, 'Leather', 'Blue', 'Sapphire', 150, 'Automatic', 48, 'Date', 1, NULL, '2023-06-19 15:02:12'),
(6, 3, 'Seiko Presage Limited Edition', '1000.00', '1200.00', 0, 9, 'Men', 'Stainless', 40, 11, 'Steel', 'Ivory', 'Sapphire', 50, 'Automatic', 41, 'None', 1, NULL, '2023-06-19 14:58:25'),
(7, 1, 'Rolex Datejust II', '10300.00', '10500.00', 0, 3, 'Men', 'Yellow Gold', 41, 12, 'Leather', 'Silver', 'Sapphire', 100, 'Automatic', 70, 'Date', 1, NULL, '2023-06-19 14:49:05'),
(8, 4, 'Tag Heuer Connected Calibre E4', '3000.00', '3200.00', 0, 8, 'Unisex', 'Titanium', 45, 13, 'Rubber', 'Black', 'Sapphire', 50, 'Quartz', 0, 'Smartwatch', 1, NULL, '2023-06-19 14:46:20'),
(9, 5, 'Casio G-Shock GMA S2100BS 7A', '500.00', '800.00', 0, 7, 'Men', 'Resin', 50, 15, 'Resin', 'Black', 'Mineral', 100, 'Quartz', 0, 'Altimeter, Compass', 1, NULL, '2023-06-19 15:11:25'),
(10, 2, 'Omega De Ville Tresor', '6500.00', '6700.00', 0, 5, 'Women', 'Rose Gold', 36, 9, 'Leather', 'Champagne', 'Sapphire', 30, 'Quartz', 0, 'None', 1, NULL, '2023-06-19 14:52:15'),
(11, 3, 'Cocktail Time Presage SRP837J1', '700.00', '900.00', 0, 9, 'Women', 'Stainless', 34, 11, 'Steel', 'Blue', 'Sapphire', 50, 'Automatic', 41, 'None', 1, NULL, '2023-06-19 14:45:04'),
(12, 4, 'Tag Heuer Monaco', '5600.00', '5900.00', 0, 7, 'Men', 'Stainless', 39, 12, 'Leather', 'Black', 'Sapphire', 100, 'Automatic', 40, 'Chronograph', 1, NULL, '2023-06-19 14:55:08'),
(13, 1, 'Rolex Milgauss Stainless Steel Green Anniversary', '8700.00', '8900.00', 0, 10, 'Men', 'Stainless', 40, 13, 'Steel', 'Black', 'Sapphire', 100, 'Automatic', 48, 'None', 1, NULL, '2023-06-19 14:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `watch_categories`
--

CREATE TABLE `watch_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `watch_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `watch_categories`
--

INSERT INTO `watch_categories` (`id`, `watch_id`, `category_id`, `created_at`, `updated_at`) VALUES
(2, 1, 1, NULL, NULL),
(3, 2, 1, NULL, NULL),
(4, 2, 2, NULL, NULL),
(5, 3, 1, NULL, NULL),
(6, 3, 5, NULL, NULL),
(7, 4, 1, NULL, NULL),
(8, 4, 2, NULL, NULL),
(9, 5, 2, NULL, NULL),
(10, 5, 5, NULL, NULL),
(11, 6, 3, NULL, NULL),
(12, 7, 1, NULL, NULL),
(13, 8, 4, NULL, NULL),
(14, 9, 5, NULL, NULL),
(15, 10, 2, NULL, NULL),
(16, 10, 3, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_watch_id_foreign` (`watch_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `collections_name_unique` (`name`),
  ADD KEY `collections_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_watch_id_foreign` (`watch_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`,`watch_id`),
  ADD KEY `order_details_watch_id_foreign` (`watch_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `receivers`
--
ALTER TABLE `receivers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `receivers_telephone_unique` (`telephone`),
  ADD KEY `receivers_user_id_foreign` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_watch_id_foreign` (`watch_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `watches`
--
ALTER TABLE `watches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `watches_model_unique` (`model`),
  ADD KEY `watches_collection_id_foreign` (`collection_id`);

--
-- Indexes for table `watch_categories`
--
ALTER TABLE `watch_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `watch_categories_category_id_foreign` (`category_id`),
  ADD KEY `watch_categories_watch_id_foreign` (`watch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receivers`
--
ALTER TABLE `receivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `watches`
--
ALTER TABLE `watches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `watch_categories`
--
ALTER TABLE `watch_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_watch_id_foreign` FOREIGN KEY (`watch_id`) REFERENCES `watches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `collections_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_watch_id_foreign` FOREIGN KEY (`watch_id`) REFERENCES `watches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `receivers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_watch_id_foreign` FOREIGN KEY (`watch_id`) REFERENCES `watches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `receivers`
--
ALTER TABLE `receivers`
  ADD CONSTRAINT `receivers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_watch_id_foreign` FOREIGN KEY (`watch_id`) REFERENCES `watches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `watches`
--
ALTER TABLE `watches`
  ADD CONSTRAINT `watches_collection_id_foreign` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `watch_categories`
--
ALTER TABLE `watch_categories`
  ADD CONSTRAINT `watch_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `watch_categories_watch_id_foreign` FOREIGN KEY (`watch_id`) REFERENCES `watches` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
