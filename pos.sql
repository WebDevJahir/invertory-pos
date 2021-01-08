-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- হোষ্ট: 127.0.0.1
-- তৈরী করতে ব্যবহৃত সময়: ডিসে 05, 2020 at 07:29 AM
-- সার্ভার সংস্করন: 10.1.37-MariaDB
-- পিএইছপির সংস্করন: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- ডাটাবেইজ: `pos`
--

-- --------------------------------------------------------

--
-- টেবলের জন্য টেবলের গঠন `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- টেবলের জন্য তথ্য স্তুপ করছি `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Scale', 1, NULL, '2020-11-02 23:13:08', '2020-11-02 23:13:08'),
(2, 'Grinding Machine', 1, NULL, '2020-11-03 00:14:28', '2020-11-03 00:14:28'),
(3, 'Welding Machine', 1, NULL, '2020-11-03 23:14:11', '2020-11-03 23:14:11');

-- --------------------------------------------------------

--
-- টেবলের জন্য টেবলের গঠন `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- টেবলের জন্য তথ্য স্তুপ করছি `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `email`, `address`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'New Balaka Builder', '01884805662', 'balaka@gmail.com', 'Jubilee road, Chittagong', NULL, '2020-11-01 06:02:57', '2020-11-01 06:03:26'),
(2, 'Four Star Trading', '01828650256', 'fourstar@gmail.com', 'Jubilee road, Chittagong', NULL, '2020-11-03 00:13:00', '2020-11-03 00:13:00'),
(3, 'jahirul islam', '1884805662', 'jahirupa@gmail.com', 'Hazi ashraf Ali road, Chittagong', NULL, '2020-11-12 06:00:35', '2020-11-12 06:00:35');

-- --------------------------------------------------------

--
-- টেবলের জন্য টেবলের গঠন `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- টেবলের জন্য টেবলের গঠন `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- টেবলের জন্য তথ্য স্তুপ করছি `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_no`, `date`, `description`, `status`, `created_by`, `approved_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(35, 35, '2020-11-12', 'this is description', 1, 7, 7, '2020-11-12 05:54:19', '2020-12-02 00:36:28', '2020-11-12 11:54:19'),
(37, 37, '2020-11-12', 'This is a description', 1, 7, 7, '2020-11-12 06:00:35', '2020-12-02 00:30:49', '2020-11-12 12:00:35'),
(38, 38, '2020-11-16', 'Tthis is a description', 1, 7, 7, '2020-11-14 23:46:12', '2020-11-29 03:16:52', '2020-11-15 05:46:12'),
(39, 39, '2020-11-16', 'This is a description', 1, 7, 7, '2020-11-14 23:47:07', '2020-12-04 23:24:36', '2020-11-15 05:47:07');

-- --------------------------------------------------------

--
-- টেবলের জন্য টেবলের গঠন `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `selling_qty` double NOT NULL,
  `unit_price` double NOT NULL,
  `selling_price` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- টেবলের জন্য তথ্য স্তুপ করছি `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `date`, `invoice_id`, `category_id`, `product_id`, `selling_qty`, `unit_price`, `selling_price`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(54, '1970-01-01', 34, 1, 1, 10, 8500, 85000, 1, '2020-11-12 03:28:41', '2020-11-12 03:28:41', '2020-11-12 09:28:41'),
(55, '1970-01-01', 34, 1, 4, 100, 1500, 150000, 1, '2020-11-12 03:28:41', '2020-11-12 03:28:41', '2020-11-12 09:28:41'),
(56, '1970-01-01', 34, 3, 3, 5, 12500, 62500, 1, '2020-11-12 03:28:41', '2020-11-12 03:28:41', '2020-11-12 09:28:41'),
(57, '1970-01-01', 34, 2, 2, 10, 1750, 17500, 1, '2020-11-12 03:28:41', '2020-11-12 03:28:41', '2020-11-12 09:28:41'),
(58, '1970-01-01', 35, 2, 2, 10, 1750, 17500, 1, '2020-11-12 05:54:19', '2020-11-29 03:15:13', '2020-11-12 11:54:19'),
(64, '1970-01-01', 38, 1, 1, 10, 9500, 95000, 1, '2020-11-14 23:46:12', '2020-11-29 03:16:52', '2020-11-15 05:46:12'),
(65, '1970-01-01', 38, 1, 1, 10, 9500, 95000, 1, '2020-11-14 23:46:12', '2020-11-29 04:25:42', '2020-11-15 05:46:12'),
(66, '1970-01-01', 39, 2, 2, 8, 1750, 14000, 1, '2020-11-14 23:47:07', '2020-11-14 23:47:07', '2020-11-15 05:47:07'),
(67, '1970-01-01', 39, 3, 3, 10, 14500, 145000, 1, '2020-11-14 23:47:07', '2020-11-14 23:47:07', '2020-11-15 05:47:07'),
(87, '2020-11-12', 37, 3, 3, 5, 20500, 102500, 1, '2020-12-02 00:30:33', '2020-12-02 00:30:49', '2020-12-02 06:30:33');

-- --------------------------------------------------------

--
-- টেবলের জন্য টেবলের গঠন `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- টেবলের জন্য তথ্য স্তুপ করছি `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_11_01_115705_create_customers_table', 2),
(5, '2020_11_03_050035_create_suppliers_table', 3),
(6, '2020_11_03_050756_create_units_table', 4),
(7, '2020_11_03_051151_create_categories_table', 5),
(8, '2020_11_03_051734_create_products_table', 6),
(9, '2020_11_03_071221_create_purchases_table', 7),
(10, '2020_11_08_051929_create_invoices_table', 8),
(11, '2020_11_08_052032_create_invoice_details_table', 8),
(12, '2020_11_08_052102_create_payments_table', 8),
(13, '2020_11_08_052121_create_payment_details_table', 8);

-- --------------------------------------------------------

--
-- টেবলের জন্য টেবলের গঠন `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- টেবলের জন্য টেবলের গঠন `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `paid_status` varchar(51) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `due_amount` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- টেবলের জন্য তথ্য স্তুপ করছি `payments`
--

INSERT INTO `payments` (`id`, `invoice_id`, `customer_id`, `paid_status`, `paid_amount`, `due_amount`, `total_amount`, `discount_amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(19, 34, 1, 'partial_paid', 250500, 54500, 305000, 10000, '2020-11-12 03:28:41', '2020-11-12 03:28:41', '2020-11-12 09:28:41'),
(20, 35, 2, 'full_paid', 17500, 0, 17500, 0, '2020-11-12 05:54:19', '2020-12-02 03:40:08', '2020-11-12 11:54:19'),
(21, 37, 3, 'full_paid', 101300, 0, 101300, 1200, '2020-11-12 06:00:35', '2020-12-04 23:24:14', '2020-11-12 12:00:35'),
(22, 38, 2, 'full_paid', 189000, 0, 189000, 1000, '2020-11-14 23:46:12', '2020-11-29 04:25:42', '2020-11-15 05:46:12'),
(23, 39, 1, 'partial_paid', 44500, 100000, 144500, 14500, '2020-11-14 23:47:07', '2020-12-04 23:24:36', '2020-11-15 05:47:07');

-- --------------------------------------------------------

--
-- টেবলের জন্য টেবলের গঠন `payment_details`
--

CREATE TABLE `payment_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `current_paid_amount` double DEFAULT NULL,
  `current_due_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- টেবলের জন্য তথ্য স্তুপ করছি `payment_details`
--

INSERT INTO `payment_details` (`id`, `invoice_id`, `current_paid_amount`, `current_due_amount`, `date`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 34, 250500, '54500', '2020-11-12', NULL, '2020-11-12 03:28:42', '2020-11-12 03:28:42', '2020-11-12 09:28:42'),
(9, 35, 17500, '0', '2020-11-12', NULL, '2020-11-12 05:54:19', '2020-11-29 03:15:13', '2020-11-12 11:54:19'),
(10, 37, 101300, '0', '2020-11-12', NULL, '2020-11-12 06:00:35', '2020-12-04 23:24:14', '2020-11-12 12:00:35'),
(11, 38, 189000, '0', '2020-11-16', NULL, '2020-11-14 23:46:12', '2020-11-29 04:25:42', '2020-11-15 05:46:12'),
(12, 39, 44500, '100000', '2020-11-16', NULL, '2020-11-14 23:47:07', '2020-12-04 23:24:36', '2020-11-15 05:47:07');

-- --------------------------------------------------------

--
-- টেবলের জন্য টেবলের গঠন `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- টেবলের জন্য তথ্য স্তুপ করছি `products`
--

INSERT INTO `products` (`id`, `supplier_id`, `category_id`, `product_name`, `unit_id`, `quantity`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Digital scale-150kg-camry', 1, 135, 1, NULL, '2020-11-02 23:38:06', '2020-11-19 00:15:07'),
(2, 2, 2, 'Angle Grinder-710w-ingco', 2, 173, 1, NULL, '2020-11-03 00:31:44', '2020-12-02 00:36:28'),
(3, 3, 3, 'Welding Machine-BX6-315C-Rilond', 2, 140, 0, NULL, '2020-11-03 23:28:39', '2020-11-19 00:15:13'),
(4, 1, 1, 'Digital Bathroom Scale-200kg-Mega', 2, 1400, 1, NULL, '2020-11-04 00:18:38', '2020-11-14 06:51:27');

-- --------------------------------------------------------

--
-- টেবলের জন্য টেবলের গঠন `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buying_qty` double NOT NULL,
  `unit_price` double NOT NULL,
  `buying_price` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=Pending,1=Approved',
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- টেবলের জন্য তথ্য স্তুপ করছি `purchases`
--

INSERT INTO `purchases` (`id`, `supplier_id`, `category_id`, `product_id`, `purchase_no`, `date`, `description`, `buying_qty`, `unit_price`, `buying_price`, `status`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '1', '2020-11-05', 'total er mal', 80, 80, 6400, 1, '7', NULL, '2020-11-05 00:44:58', '2020-11-07 06:56:58'),
(2, 1, 1, 1, '2', '2020-11-05', 'total er mal', 50, 1000, 50000, 1, '7', NULL, '2020-11-05 00:50:37', '2020-11-07 06:58:17'),
(3, 1, 1, 4, '2', '2020-11-05', 'total er mal', 60, 1780, 106800, 0, '7', '2020-11-07 03:04:55', '2020-11-05 00:50:37', '2020-11-07 03:04:55'),
(4, 2, 2, 2, '485', '2020-11-05', 'total er mal', 450, 1000, 450000, 1, '7', NULL, '2020-11-07 22:24:10', '2020-11-08 04:45:47');

-- --------------------------------------------------------

--
-- টেবলের জন্য টেবলের গঠন `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- টেবলের জন্য তথ্য স্তুপ করছি `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `phone`, `email`, `address`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Gausia International', '019225523407', 'gausia@gmail.com', 'Nawabpur, Dhaka', 1, NULL, '2020-11-02 23:06:26', '2020-11-02 23:06:26'),
(2, 'Madina Scale', '018265486325', 'madina@gmail.com', '124, Apple tower, Nawabpur, Dhaka', 1, NULL, '2020-11-03 00:13:51', '2020-11-03 00:13:51'),
(3, 'Saify Steel Company', '01884805662', 'saifysteelcompany@gmail.com', 'Majirghat, chattogram', 1, NULL, '2020-11-03 23:15:31', '2020-11-03 23:15:31');

-- --------------------------------------------------------

--
-- টেবলের জন্য টেবলের গঠন `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- টেবলের জন্য তথ্য স্তুপ করছি `units`
--

INSERT INTO `units` (`id`, `unit`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'KGS', 1, NULL, '2020-11-02 23:10:16', '2020-11-02 23:10:16'),
(2, 'PCS', 1, NULL, '2020-11-03 00:14:11', '2020-11-03 00:14:11');

-- --------------------------------------------------------

--
-- টেবলের জন্য টেবলের গঠন `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- টেবলের জন্য তথ্য স্তুপ করছি `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 'jahirul islam', 'jahirupa@gmail.com', '$2y$10$wPkRPIWz5nSY2XGRWDRds.G0pVRxGOUvLsOg81y127YvSfsbqv20G', '2020-11-01 05:40:49', '2020-11-01 05:40:49', '2020-11-01 11:40:49');

--
-- স্তুপকৃত টেবলের ইনডেক্স
--

--
-- টেবিলের ইনডেক্সসমুহ `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- টেবিলের ইনডেক্সসমুহ `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- টেবিলের ইনডেক্সসমুহ `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- টেবিলের ইনডেক্সসমুহ `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- টেবিলের ইনডেক্সসমুহ `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- টেবিলের ইনডেক্সসমুহ `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- টেবিলের ইনডেক্সসমুহ `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- টেবিলের ইনডেক্সসমুহ `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- টেবিলের ইনডেক্সসমুহ `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`);

--
-- টেবিলের ইনডেক্সসমুহ `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- টেবিলের ইনডেক্সসমুহ `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- টেবিলের ইনডেক্সসমুহ `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- টেবিলের ইনডেক্সসমুহ `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- টেবিলের ইনডেক্সসমুহ `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- স্তুপকৃত টেবলের জন্য স্বয়ক্রীয় বর্দ্ধিত মান (AUTO_INCREMENT)
--

--
-- টেবলের জন্য স্বয়ক্রীয় বর্দ্ধিত মান (AUTO_INCREMENT) `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- টেবলের জন্য স্বয়ক্রীয় বর্দ্ধিত মান (AUTO_INCREMENT) `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- টেবলের জন্য স্বয়ক্রীয় বর্দ্ধিত মান (AUTO_INCREMENT) `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- টেবলের জন্য স্বয়ক্রীয় বর্দ্ধিত মান (AUTO_INCREMENT) `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- টেবলের জন্য স্বয়ক্রীয় বর্দ্ধিত মান (AUTO_INCREMENT) `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- টেবলের জন্য স্বয়ক্রীয় বর্দ্ধিত মান (AUTO_INCREMENT) `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- টেবলের জন্য স্বয়ক্রীয় বর্দ্ধিত মান (AUTO_INCREMENT) `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- টেবলের জন্য স্বয়ক্রীয় বর্দ্ধিত মান (AUTO_INCREMENT) `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- টেবলের জন্য স্বয়ক্রীয় বর্দ্ধিত মান (AUTO_INCREMENT) `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- টেবলের জন্য স্বয়ক্রীয় বর্দ্ধিত মান (AUTO_INCREMENT) `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- টেবলের জন্য স্বয়ক্রীয় বর্দ্ধিত মান (AUTO_INCREMENT) `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- টেবলের জন্য স্বয়ক্রীয় বর্দ্ধিত মান (AUTO_INCREMENT) `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- টেবলের জন্য স্বয়ক্রীয় বর্দ্ধিত মান (AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
