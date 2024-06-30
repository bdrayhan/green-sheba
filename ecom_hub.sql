-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 07:58 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `analytics`
--

CREATE TABLE `analytics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `google_analytic` text DEFAULT NULL,
  `facebook_pixel` text DEFAULT NULL,
  `bing_analytic` text DEFAULT NULL,
  `google_site_verification` varchar(255) DEFAULT NULL,
  `facebook_site_verification` varchar(255) DEFAULT NULL,
  `bing_site_verification` varchar(255) DEFAULT NULL,
  `custom_header_script` text DEFAULT NULL,
  `custom_footer_script` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `analytics`
--

INSERT INTO `analytics` (`id`, `google_analytic`, `facebook_pixel`, `bing_analytic`, `google_site_verification`, `facebook_site_verification`, `bing_site_verification`, `custom_header_script`, `custom_footer_script`, `created_at`, `updated_at`) VALUES
(1, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-19 14:07:01', '2024-01-19 14:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banner_title` varchar(255) DEFAULT NULL,
  `banner_slug` varchar(255) DEFAULT NULL,
  `banner_mid_title` varchar(255) DEFAULT NULL,
  `banner_sub_title` varchar(255) DEFAULT NULL,
  `banner_button` varchar(255) DEFAULT NULL,
  `banner_url` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `banner_sorting` int(11) DEFAULT NULL,
  `banner_publish` int(11) NOT NULL DEFAULT 0,
  `banner_creator` int(11) DEFAULT NULL,
  `banner_editor` int(11) DEFAULT NULL,
  `banner_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `banner_title`, `banner_slug`, `banner_mid_title`, `banner_sub_title`, `banner_button`, `banner_url`, `banner_image`, `banner_sorting`, `banner_publish`, `banner_creator`, `banner_editor`, `banner_status`, `created_at`, `updated_at`) VALUES
(1, 'Consectetur quis.', '65aa821ad9a5b', 'Non aut molestias.', 'Nesciunt quidem dolore voluptatum.', 'Shop Now', 'consectetur-quis', 'media/banner/1788804797095362.jpg', NULL, 1, NULL, 1, 1, '2024-01-19 14:07:22', '2024-01-22 15:26:32'),
(2, 'Repellendus quos.', '65aa821ad9b9b', 'Expedita recusandae at.', 'Delectus temporibus id.', 'Shop Now', 'repellendus-quos', 'media/banner/1788804812475519.jpg', NULL, 1, NULL, 1, 1, '2024-01-19 14:07:23', '2024-01-22 15:26:46'),
(3, 'Banner 03', '65ae894d83db7', NULL, NULL, NULL, NULL, 'media/banner/1788804836376054.jpg', NULL, 0, 1, NULL, 1, '2024-01-22 15:27:09', NULL),
(4, 'Banner 04', '65ae898ca1185', NULL, NULL, NULL, NULL, 'media/banner/1788804902556100.jpg', NULL, 0, 1, NULL, 1, '2024-01-22 15:28:12', NULL),
(5, 'Banner 05', '65ae89a09bdff', NULL, NULL, NULL, NULL, 'media/banner/1788804923506238.jpg', NULL, 0, 1, NULL, 1, '2024-01-22 15:28:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `basic_settings`
--

CREATE TABLE `basic_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `basic_company` varchar(150) DEFAULT NULL,
  `basic_title` varchar(190) DEFAULT NULL,
  `basic_url` varchar(100) DEFAULT NULL,
  `invoice_code` varchar(10) DEFAULT NULL,
  `basic_logo` varchar(100) DEFAULT NULL,
  `basic_flogo` varchar(100) DEFAULT NULL,
  `basic_favicon` varchar(100) DEFAULT NULL,
  `thanks_notes` longtext DEFAULT NULL,
  `invoice_note` mediumtext DEFAULT NULL,
  `invoice_additional` mediumtext DEFAULT NULL,
  `basic_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `basic_settings`
--

INSERT INTO `basic_settings` (`id`, `basic_company`, `basic_title`, `basic_url`, `invoice_code`, `basic_logo`, `basic_flogo`, `basic_favicon`, `thanks_notes`, `invoice_note`, `invoice_additional`, `basic_status`, `created_at`, `updated_at`) VALUES
(1, 'eCom Hub', 'eCom Hub', NULL, 'ADAP', 'media/setting/1.2292333181711E+26.png', 'media/setting/1.229070292707E+26.png', NULL, NULL, NULL, NULL, 1, '2024-01-19 14:07:01', '2024-01-22 06:11:55');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `bc_id` bigint(20) UNSIGNED NOT NULL,
  `bc_name` varchar(255) NOT NULL,
  `bc_icon` varchar(255) DEFAULT NULL,
  `bc_remark` varchar(255) DEFAULT NULL,
  `bc_url` varchar(255) DEFAULT NULL,
  `bc_orderby` int(11) DEFAULT NULL,
  `bc_creator` int(11) DEFAULT NULL,
  `bc_editor` int(11) DEFAULT NULL,
  `bc_active` int(11) NOT NULL DEFAULT 1,
  `bc_slug` varchar(255) DEFAULT NULL,
  `bc_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`bc_id`, `bc_name`, `bc_icon`, `bc_remark`, `bc_url`, `bc_orderby`, `bc_creator`, `bc_editor`, `bc_active`, `bc_slug`, `bc_status`, `created_at`, `updated_at`) VALUES
(1, 'Arizona', NULL, 'Facilis nemo iure.', 'arizona', NULL, NULL, NULL, 1, '65aa821b1e04d5.81770754', 1, '2024-01-19 14:07:23', '2024-01-19 14:07:23'),
(2, 'Maryland', NULL, 'Reprehenderit sed architecto iure.', 'maryland', NULL, NULL, NULL, 1, '65aa821b1e0cb4.96263172', 1, '2024-01-19 14:07:23', '2024-01-19 14:07:23'),
(3, 'Mississippi', NULL, 'Consequatur ea dolor itaque reiciendis.', 'mississippi', NULL, NULL, NULL, 1, '65aa821b1e11a8.81059971', 1, '2024-01-19 14:07:23', '2024-01-19 14:07:23'),
(4, 'Hawaii', NULL, 'Deleniti quas vitae.', 'hawaii', NULL, NULL, NULL, 1, '65aa821b1e1654.88876020', 1, '2024-01-19 14:07:23', '2024-01-19 14:07:23'),
(5, 'Texas', NULL, 'Qui commodi labore mollitia quibusdam autem.', 'texas', NULL, NULL, NULL, 1, '65aa821b1e1b16.00886329', 1, '2024-01-19 14:07:23', '2024-01-19 14:07:23'),
(6, 'New Hampshire', NULL, 'Tempore illum quia.', 'new-hampshire', NULL, NULL, NULL, 1, '65aa821b1e1fa4.12052121', 1, '2024-01-19 14:07:23', '2024-01-19 14:07:23'),
(7, 'Delaware', NULL, 'Deleniti a odio rem.', 'delaware', NULL, NULL, NULL, 1, '65aa821b1e23f3.69863719', 1, '2024-01-19 14:07:23', '2024-01-19 14:07:23'),
(8, 'Michigan', NULL, 'Quia officia corrupti est.', 'michigan', NULL, NULL, NULL, 1, '65aa821b1e2845.36297901', 1, '2024-01-19 14:07:23', '2024-01-19 14:07:23'),
(9, 'Florida', NULL, 'Fuga enim minima.', 'florida', NULL, NULL, NULL, 1, '65aa821b1e2c89.47442184', 1, '2024-01-19 14:07:23', '2024-01-19 14:07:23'),
(10, 'Virginia', NULL, 'Ducimus rerum nostrum eum.', 'virginia', NULL, NULL, NULL, 1, '65aa821b1e30f5.13954860', 1, '2024-01-19 14:07:23', '2024-01-19 14:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_slug` varchar(255) DEFAULT NULL,
  `brand_url` varchar(255) DEFAULT NULL,
  `brand_image` varchar(255) DEFAULT NULL,
  `brand_orderby` int(11) DEFAULT NULL,
  `brand_remarks` varchar(255) DEFAULT NULL,
  `brand_feature` int(11) DEFAULT NULL COMMENT '1 For Active 0 For Inactive',
  `brand_active` int(11) NOT NULL DEFAULT 1 COMMENT '1 For Active 0 For Inactive',
  `brand_creator` int(11) DEFAULT NULL,
  `brand_editor` int(11) DEFAULT NULL,
  `brand_status` int(11) NOT NULL DEFAULT 1 COMMENT '1 For Product Active/Restore 0 For Soft Delete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `brand_slug`, `brand_url`, `brand_image`, `brand_orderby`, `brand_remarks`, `brand_feature`, `brand_active`, `brand_creator`, `brand_editor`, `brand_status`, `created_at`, `updated_at`) VALUES
(1, 'sequi', '65aa8219caf3c', 'sequi', 'https://via.placeholder.com/330x88.png/00ff66?text=Brand+et', NULL, NULL, 1, 1, NULL, NULL, 1, '2024-01-19 14:07:21', '2024-01-19 14:07:21'),
(2, 'enim', '65aa8219cb045', 'enim', 'https://via.placeholder.com/330x88.png/009933?text=Brand+et', NULL, NULL, 1, 1, NULL, NULL, 1, '2024-01-19 14:07:21', '2024-01-19 14:07:21'),
(3, 'eligendi', '65aa8219cb0fd', 'eligendi', 'https://via.placeholder.com/330x88.png/00cc66?text=Brand+odio', NULL, NULL, 1, 1, NULL, NULL, 1, '2024-01-19 14:07:21', '2024-01-19 14:07:21'),
(4, 'rerum', '65aa8219cb1b0', 'rerum', 'https://via.placeholder.com/330x88.png/000088?text=Brand+consectetur', NULL, NULL, 1, 1, NULL, NULL, 1, '2024-01-19 14:07:22', '2024-01-19 14:07:22'),
(5, 'quasi', '65aa8219cb262', 'quasi', 'https://via.placeholder.com/330x88.png/000099?text=Brand+ut', NULL, NULL, 1, 1, NULL, NULL, 1, '2024-01-19 14:07:22', '2024-01-19 14:07:22'),
(6, 'ab', '65aa8219cb316', 'ab', 'https://via.placeholder.com/330x88.png/0077ff?text=Brand+nostrum', NULL, NULL, 1, 1, NULL, NULL, 1, '2024-01-19 14:07:22', '2024-01-19 14:07:22'),
(7, 'rem', '65aa8219cb3c7', 'rem', 'https://via.placeholder.com/330x88.png/00ff55?text=Brand+dolorem', NULL, NULL, 1, 1, NULL, NULL, 1, '2024-01-19 14:07:22', '2024-01-19 14:07:22'),
(8, 'accusamus', '65aa8219cb479', 'accusamus', 'https://via.placeholder.com/330x88.png/003377?text=Brand+nostrum', NULL, NULL, 1, 1, NULL, NULL, 1, '2024-01-19 14:07:22', '2024-01-19 14:07:22'),
(9, 'fuga', '65aa8219cb528', 'fuga', 'https://via.placeholder.com/330x88.png/000077?text=Brand+saepe', NULL, NULL, 1, 1, NULL, NULL, 1, '2024-01-19 14:07:22', '2024-01-19 14:07:22'),
(10, 'perspiciatis', '65aa8219cb5da', 'perspiciatis', 'https://via.placeholder.com/330x88.png/00aa44?text=Brand+libero', NULL, NULL, 1, 1, NULL, NULL, 1, '2024-01-19 14:07:22', '2024-01-19 14:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pc_name` varchar(255) NOT NULL,
  `pc_url` varchar(255) DEFAULT NULL,
  `pc_remarks` text DEFAULT NULL,
  `pc_image` varchar(255) DEFAULT NULL,
  `pc_feature` int(11) NOT NULL DEFAULT 0,
  `pc_orderby` int(11) DEFAULT NULL,
  `pc_active` int(11) NOT NULL DEFAULT 1,
  `pc_creator` int(11) DEFAULT NULL,
  `pc_editor` int(11) DEFAULT NULL,
  `pc_slug` varchar(255) DEFAULT NULL,
  `pc_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `pc_name`, `pc_url`, `pc_remarks`, `pc_image`, `pc_feature`, `pc_orderby`, `pc_active`, `pc_creator`, `pc_editor`, `pc_slug`, `pc_status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Kristina', 'kristina', 'Consequatur laborum non at nam omnis.', 'https://via.placeholder.com/400x400.png/00ee55?text=Category+perspiciatis', 0, 4, 1, 1, 1, '65aa821e9bf72', 1, '2024-01-19 14:07:26', '2024-01-19 14:07:26'),
(2, NULL, 'Libby', 'libby', 'Et molestias reiciendis laborum veniam.', 'https://via.placeholder.com/400x400.png/0055aa?text=Category+aperiam', 1, 7, 1, 1, 1, '65aa821e9c093', 1, '2024-01-19 14:07:26', '2024-01-19 14:07:26'),
(3, NULL, 'Laurence', 'laurence', 'Qui quod qui quis.', 'https://via.placeholder.com/400x400.png/002200?text=Category+consequatur', 0, 2, 1, 1, 1, '65aa821e9c196', 1, '2024-01-19 14:07:26', '2024-01-19 14:07:26'),
(4, NULL, 'Shea', 'shea', 'Sit et nemo nam.', 'https://via.placeholder.com/400x400.png/00bb55?text=Category+suscipit', 0, 2, 1, 1, 1, '65aa821e9c275', 1, '2024-01-19 14:07:26', '2024-01-19 14:07:26'),
(5, NULL, 'Carli', 'carli', 'Numquam ut provident incidunt.', 'https://via.placeholder.com/400x400.png/0088ff?text=Category+illo', 0, 3, 1, 1, 1, '65aa821e9c34e', 1, '2024-01-19 14:07:26', '2024-01-19 14:07:26'),
(6, NULL, 'Henriette', 'henriette', 'Aut enim est aut laudantium.', 'https://via.placeholder.com/400x400.png/006611?text=Category+velit', 0, 7, 1, 1, 1, '65aa821e9c426', 1, '2024-01-19 14:07:27', '2024-01-19 14:07:27'),
(7, NULL, 'Alanis', 'alanis', 'Illum quibusdam libero odit.', 'https://via.placeholder.com/400x400.png/00bbdd?text=Category+vitae', 1, 8, 1, 1, 1, '65aa821e9c4ff', 1, '2024-01-19 14:07:27', '2024-01-19 14:07:27'),
(8, NULL, 'Martine', 'martine', 'Veritatis velit modi pariatur a.', 'https://via.placeholder.com/400x400.png/00aabb?text=Category+sunt', 0, 6, 1, 1, 1, '65aa821e9c5da', 1, '2024-01-19 14:07:27', '2024-01-19 14:07:27'),
(9, NULL, 'Ethelyn', 'ethelyn', 'Aliquid esse suscipit voluptas sunt sit.', 'https://via.placeholder.com/400x400.png/00aa22?text=Category+iusto', 0, 4, 1, 1, 1, '65aa821e9c6b0', 1, '2024-01-19 14:07:27', '2024-01-19 14:07:27'),
(10, NULL, 'Pink', 'pink', 'Itaque eos reprehenderit ut.', 'https://via.placeholder.com/400x400.png/0088ee?text=Category+saepe', 1, 9, 1, 1, 1, '65aa821e9c787', 1, '2024-01-19 14:07:27', '2024-01-19 14:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `city_remarks` varchar(255) DEFAULT NULL,
  `city_creator` int(11) DEFAULT NULL,
  `city_editor` int(11) DEFAULT NULL,
  `city_slug` varchar(255) NOT NULL,
  `city_orderby` int(11) DEFAULT NULL,
  `city_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city_name`, `city_remarks`, `city_creator`, `city_editor`, `city_slug`, `city_orderby`, `city_status`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka', NULL, NULL, NULL, '65aa8216a4029', NULL, 1, '2024-01-19 14:07:18', '2024-01-19 14:07:18'),
(2, 'Narayangonj', NULL, NULL, NULL, '65aa8216b0800', NULL, 1, '2024-01-19 14:07:18', '2024-01-19 14:07:18'),
(3, 'Gazipur', NULL, NULL, NULL, '65aa8216bc8bc', NULL, 1, '2024-01-19 14:07:18', '2024-01-19 14:07:18'),
(4, 'Chattogram', NULL, NULL, NULL, '65aa8216d4c62', NULL, 1, '2024-01-19 14:07:18', '2024-01-19 14:07:18'),
(5, 'Khulna', NULL, NULL, NULL, '65aa8216e1008', NULL, 1, '2024-01-19 14:07:18', '2024-01-19 14:07:18'),
(6, 'Sylhet', NULL, NULL, NULL, '65aa8216e707f', NULL, 1, '2024-01-19 14:07:18', '2024-01-19 14:07:18'),
(7, 'Mymensingh', NULL, NULL, NULL, '65aa8216ed2f2', NULL, 1, '2024-01-19 14:07:18', '2024-01-19 14:07:18');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color_name` varchar(255) NOT NULL,
  `color_code` varchar(255) DEFAULT NULL,
  `color_url` varchar(255) DEFAULT NULL,
  `color_active` int(11) NOT NULL DEFAULT 1,
  `color_creator` int(11) DEFAULT NULL,
  `color_editor` int(11) DEFAULT NULL,
  `color_orderby` int(11) DEFAULT NULL,
  `color_slug` varchar(255) DEFAULT NULL,
  `color_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color_name`, `color_code`, `color_url`, `color_active`, `color_creator`, `color_editor`, `color_orderby`, `color_slug`, `color_status`, `created_at`, `updated_at`) VALUES
(1, 'Teal', '#053a2b', 'teal', 1, NULL, NULL, NULL, '65aa821db8472', 1, '2024-01-19 14:07:25', '2024-01-19 14:07:25'),
(2, 'LightCyan', '#b5fe1b', 'lightcyan', 1, NULL, NULL, NULL, '65aa821db84df', 1, '2024-01-19 14:07:25', '2024-01-19 14:07:25'),
(3, 'LightSeaGreen', '#ef91f6', 'lightseagreen', 1, NULL, NULL, NULL, '65aa821db8525', 1, '2024-01-19 14:07:25', '2024-01-19 14:07:25'),
(4, 'DodgerBlue', '#816aa9', 'dodgerblue', 1, NULL, NULL, NULL, '65aa821db8567', 1, '2024-01-19 14:07:26', '2024-01-19 14:07:26'),
(5, 'BlanchedAlmond', '#48bd3f', 'blanchedalmond', 1, NULL, NULL, NULL, '65aa821db85a6', 1, '2024-01-19 14:07:26', '2024-01-19 14:07:26'),
(6, 'AntiqueWhite', '#63752f', 'antiquewhite', 1, NULL, NULL, NULL, '65aa821db85e5', 1, '2024-01-19 14:07:26', '2024-01-19 14:07:26'),
(7, 'BlueViolet', '#76fe77', 'blueviolet', 1, NULL, NULL, NULL, '65aa821db8626', 1, '2024-01-19 14:07:26', '2024-01-19 14:07:26'),
(8, 'Darkorange', '#c02178', 'darkorange', 1, NULL, NULL, NULL, '65aa821db8663', 1, '2024-01-19 14:07:26', '2024-01-19 14:07:26'),
(9, 'White', '#f0d318', 'white', 1, NULL, NULL, NULL, '65aa821db86a3', 1, '2024-01-19 14:07:26', '2024-01-19 14:07:26'),
(10, 'MediumSlateBlue', '#9ffd5f', 'mediumslateblue', 1, NULL, NULL, NULL, '65aa821db86fd', 1, '2024-01-19 14:07:26', '2024-01-19 14:07:26');

-- --------------------------------------------------------

--
-- Table structure for table `contact_infos`
--

CREATE TABLE `contact_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ci_phone1` varchar(255) DEFAULT NULL,
  `ci_phone2` varchar(255) DEFAULT NULL,
  `ci_email1` varchar(255) DEFAULT NULL,
  `ci_email2` varchar(255) DEFAULT NULL,
  `ci_address1` varchar(255) DEFAULT NULL,
  `ci_working_info` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_infos`
--

INSERT INTO `contact_infos` (`id`, `ci_phone1`, `ci_phone2`, `ci_email1`, `ci_email2`, `ci_address1`, `ci_working_info`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, 'Mon - FRI / 9:30 AM - 6:30 PM', '2024-01-19 14:07:01', '2024-01-19 14:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_name` varchar(255) NOT NULL,
  `coupon_discount` int(11) NOT NULL,
  `coupon_creator` int(11) DEFAULT NULL,
  `coupon_editor` int(11) DEFAULT NULL,
  `coupon_slug` varchar(255) DEFAULT NULL,
  `coupon_active` int(11) NOT NULL DEFAULT 0,
  `coupon_status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_name`, `coupon_discount`, `coupon_creator`, `coupon_editor`, `coupon_slug`, `coupon_active`, `coupon_status`, `created_at`, `updated_at`) VALUES
(1, 'ATQUE', 289, 1, NULL, 'atque', 1, '1', '2024-01-19 14:07:21', '2024-01-19 14:07:21'),
(2, 'QUI', 306, 1, NULL, 'qui', 1, '1', '2024-01-19 14:07:21', '2024-01-19 14:07:21'),
(3, 'REPREHENDERIT', 322, 1, NULL, 'reprehenderit', 1, '1', '2024-01-19 14:07:21', '2024-01-19 14:07:21'),
(4, 'ET', 444, 1, NULL, 'et', 1, '1', '2024-01-19 14:07:21', '2024-01-19 14:07:21'),
(5, 'TOTAM', 155, 1, NULL, 'totam', 1, '1', '2024-01-19 14:07:21', '2024-01-19 14:07:21');

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE `couriers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `courier_name` varchar(255) NOT NULL,
  `courier_slug` varchar(255) DEFAULT NULL,
  `courier_charge` varchar(255) DEFAULT NULL,
  `courier_city` int(11) DEFAULT NULL,
  `courier_zone` int(11) DEFAULT NULL,
  `courier_active` int(11) NOT NULL DEFAULT 1,
  `courier_orderby` int(11) DEFAULT NULL,
  `courier_creator` int(11) DEFAULT NULL,
  `courier_editor` int(11) DEFAULT NULL,
  `courier_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `couriers`
--

INSERT INTO `couriers` (`id`, `courier_name`, `courier_slug`, `courier_charge`, `courier_city`, `courier_zone`, `courier_active`, `courier_orderby`, `courier_creator`, `courier_editor`, `courier_status`, `created_at`, `updated_at`) VALUES
(1, 'Steadfast Courier', '65aa82167969b', '150', 1, 1, 1, NULL, 1, NULL, 1, '2024-01-19 14:07:18', '2024-01-19 14:07:18'),
(2, 'REDX BD', '65aa821697c9f', '150', 1, 1, 1, NULL, 1, NULL, 1, '2024-01-19 14:07:18', '2024-01-19 14:07:18'),
(3, 'Sundarban Courier', '65aa82169dcfa', '150', 1, 1, 1, NULL, 1, NULL, 1, '2024-01-19 14:07:18', '2024-01-19 14:07:18');

-- --------------------------------------------------------

--
-- Table structure for table `courier_cities`
--

CREATE TABLE `courier_cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `courier_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `cc_slug` varchar(255) DEFAULT NULL,
  `cc_active` varchar(255) NOT NULL DEFAULT '1',
  `cc_orderby` int(11) DEFAULT NULL,
  `cc_creator` int(11) DEFAULT NULL,
  `cc_editor` int(11) DEFAULT NULL,
  `cc_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courier_zones`
--

CREATE TABLE `courier_zones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `courier_id` int(11) NOT NULL,
  `cc_id` int(11) NOT NULL,
  `zone_name` varchar(255) NOT NULL,
  `zone_slug` varchar(255) DEFAULT NULL,
  `zone_active` int(11) NOT NULL DEFAULT 1,
  `zone_orderby` int(11) DEFAULT NULL,
  `zone_creator` int(11) DEFAULT NULL,
  `zone_editor` int(11) DEFAULT NULL,
  `zone_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `feature_categories`
--

CREATE TABLE `feature_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0: inactive, 1: active',
  `order_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `pg_image` varchar(255) NOT NULL,
  `pg_slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `media_title` varchar(255) NOT NULL,
  `media_url` varchar(255) NOT NULL,
  `media_creator` int(11) DEFAULT NULL,
  `media_editor` int(11) DEFAULT NULL,
  `media_slug` varchar(255) DEFAULT NULL,
  `media_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_bars`
--

CREATE TABLE `menu_bars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_link` varchar(255) DEFAULT NULL,
  `menu__color` varchar(255) DEFAULT NULL,
  `menu__bg_color` varchar(255) DEFAULT NULL,
  `menu_order` int(11) DEFAULT NULL,
  `menu_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_bars`
--

INSERT INTO `menu_bars` (`id`, `menu_name`, `menu_link`, `menu__color`, `menu__bg_color`, `menu_order`, `menu_status`, `created_at`, `updated_at`) VALUES
(1, 'Home', '/', NULL, NULL, 1, 1, '2024-01-19 14:07:17', '2024-01-19 14:07:17'),
(2, 'Categories', '/category', NULL, NULL, 2, 1, '2024-01-19 14:07:17', '2024-01-19 14:07:17'),
(3, 'Offers', '/offer', NULL, NULL, 3, 1, '2024-01-19 14:07:17', '2024-01-19 14:07:17');

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
(5, '2022_10_18_054105_create_brands_table', 1),
(6, '2022_10_18_093403_create_banners_table', 1),
(7, '2022_10_19_064907_create_partners_table', 1),
(8, '2022_10_19_095558_create_couriers_table', 1),
(9, '2022_10_20_074055_create_courier_cities_table', 1),
(10, '2022_10_22_041428_create_courier_zones_table', 1),
(11, '2022_10_23_081758_create_pages_table', 1),
(12, '2022_10_25_071313_create_blog_categories_table', 1),
(13, '2022_10_26_141223_create_permission_tables', 1),
(14, '2022_10_30_042826_create_theme_colors_table', 1),
(15, '2022_10_31_055127_create_basic_settings_table', 1),
(16, '2022_10_31_155315_create_social_settings_table', 1),
(17, '2022_11_06_043018_create_cities_table', 1),
(18, '2022_11_21_053816_create_categories_table', 1),
(19, '2022_11_21_053836_create_sub_categories_table', 1),
(20, '2022_11_27_071947_create_colors_table', 1),
(21, '2022_11_27_071948_create_size_table', 1),
(22, '2022_12_03_103317_create_posts_table', 1),
(23, '2022_12_05_042424_create_media_table', 1),
(24, '2022_12_07_072430_create_tags_table', 1),
(25, '2022_12_07_195038_create_contact_infos_table', 1),
(26, '2022_12_14_041030_create_analytics_table', 1),
(27, '2022_12_24_040426_create_coupons_table', 1),
(28, '2022_12_29_063505_create_subscribers_table', 1),
(29, '2022_12_30_072449_create_products_table', 1),
(30, '2022_12_30_072450_create_galleries_table', 1),
(31, '2023_01_05_083145_create_order_statuses_table', 1),
(32, '2023_01_05_083146_create_orders_table', 1),
(33, '2023_01_08_113123_create_order_details_table', 1),
(34, '2023_01_08_113225_create_shippings_table', 1),
(35, '2023_01_29_181032_create_support_messages_table', 1),
(36, '2023_01_30_172447_create_suppliers_table', 1),
(37, '2023_01_30_172448_create_product_purchases_table', 1),
(38, '2023_02_01_110612_create_service_ads_table', 1),
(39, '2023_02_01_132536_create_static_banners_table', 1),
(40, '2023_02_04_044109_create_wishlists_table', 1),
(41, '2023_02_09_095605_create_returns_table', 1),
(42, '2023_05_10_120619_create_menu_bars_table', 1),
(43, '2023_06_06_172156_create_s_m_s_settings_table', 1),
(44, '2023_06_14_171640_create_feature_categories_table', 1),
(45, '2024_01_07_142948_drop_sub_categories_table', 1),
(46, '2024_01_07_143600_add_parent_id_to_categories_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 2),
(5, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assign_id` int(11) DEFAULT NULL,
  `courier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `guest_id` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `coupon_amount` int(11) DEFAULT NULL,
  `paying_amount` int(11) NOT NULL DEFAULT 0,
  `order_subtotal` int(11) DEFAULT NULL,
  `shipping_charge` int(11) DEFAULT NULL,
  `order_vat` int(11) DEFAULT NULL,
  `order_total` int(11) DEFAULT NULL,
  `order_status` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `order_date` varchar(255) DEFAULT NULL,
  `order_month` varchar(255) DEFAULT NULL,
  `order_year` varchar(255) DEFAULT NULL,
  `complected_date` varchar(255) DEFAULT NULL,
  `invoice_date` varchar(255) DEFAULT NULL,
  `delivery_date` varchar(255) DEFAULT NULL,
  `collected_date` varchar(255) DEFAULT NULL,
  `return_date` varchar(255) DEFAULT NULL,
  `order_slug` varchar(255) DEFAULT NULL,
  `order_notes` text DEFAULT NULL,
  `return_notes` text DEFAULT NULL,
  `store_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_color` bigint(20) UNSIGNED DEFAULT NULL,
  `product_size` bigint(20) UNSIGNED DEFAULT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `single_price` int(11) DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `os_name` varchar(255) NOT NULL,
  `os_color` varchar(255) DEFAULT NULL,
  `os_orderby` int(11) DEFAULT NULL,
  `os_slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `os_name`, `os_color`, `os_orderby`, `os_slug`, `created_at`, `updated_at`) VALUES
(1, 'Pending', '#000', 1, '65aa821793bc8', '2024-01-19 14:07:19', '2024-01-19 14:07:19'),
(2, 'Processing', '#000', 2, '65aa8217a20b1', '2024-01-19 14:07:19', '2024-01-19 14:07:19'),
(3, 'Holding', '#000', 3, '65aa8217a8010', '2024-01-19 14:07:19', '2024-01-19 14:07:19'),
(4, 'Canceled', '#000', 4, '65aa8217d0ac2', '2024-01-19 14:07:19', '2024-01-19 14:07:19'),
(5, 'Complected', '#000', 5, '65aa8217d6b74', '2024-01-19 14:07:19', '2024-01-19 14:07:19'),
(6, 'Invoice', '#000', 6, '65aa8217dcea9', '2024-01-19 14:07:19', '2024-01-19 14:07:19'),
(7, 'Stock Out', '#000', 7, '65aa8217e2efe', '2024-01-19 14:07:19', '2024-01-19 14:07:19'),
(8, 'Delivery', '#000', 8, '65aa8217e93e4', '2024-01-19 14:07:19', '2024-01-19 14:07:19'),
(9, 'Lost', '#000', 9, '65aa8217ef269', '2024-01-19 14:07:19', '2024-01-19 14:07:19'),
(10, 'Return', '#000', 10, '65aa8218199b7', '2024-01-19 14:07:20', '2024-01-19 14:07:20'),
(11, 'Delivered', '#000', 11, '65aa821828085', '2024-01-19 14:07:20', '2024-01-19 14:07:20'),
(12, 'Payment Collected', '#000', 12, '65aa82184472f', '2024-01-19 14:07:20', '2024-01-19 14:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `page_content` longtext DEFAULT NULL,
  `page_slug` varchar(255) DEFAULT NULL,
  `page_url` varchar(255) NOT NULL,
  `page_creator` int(11) DEFAULT NULL,
  `page_editor` int(11) DEFAULT NULL,
  `page_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `partner_title` varchar(100) DEFAULT NULL,
  `partner_url` varchar(190) DEFAULT NULL,
  `partner_logo` varchar(255) DEFAULT NULL,
  `partner_sorting` int(11) DEFAULT NULL,
  `partner_creator` int(11) DEFAULT NULL,
  `partner_editor` int(11) DEFAULT NULL,
  `partner_slug` varchar(40) DEFAULT NULL,
  `partner_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `group`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user list', 'User', 'web', '2024-01-19 14:07:02', '2024-01-19 14:07:02'),
(2, 'user create', 'User', 'web', '2024-01-19 14:07:02', '2024-01-19 14:07:02'),
(3, 'user edit', 'User', 'web', '2024-01-19 14:07:02', '2024-01-19 14:07:02'),
(4, 'user delete', 'User', 'web', '2024-01-19 14:07:02', '2024-01-19 14:07:02'),
(5, 'customer list', 'Customer', 'web', '2024-01-19 14:07:02', '2024-01-19 14:07:02'),
(6, 'customer create', 'Customer', 'web', '2024-01-19 14:07:02', '2024-01-19 14:07:02'),
(7, 'customer edit', 'Customer', 'web', '2024-01-19 14:07:03', '2024-01-19 14:07:03'),
(8, 'customer delete', 'Customer', 'web', '2024-01-19 14:07:03', '2024-01-19 14:07:03'),
(9, 'courier list', 'Courier', 'web', '2024-01-19 14:07:03', '2024-01-19 14:07:03'),
(10, 'courier create', 'Courier', 'web', '2024-01-19 14:07:03', '2024-01-19 14:07:03'),
(11, 'courier edit', 'Courier', 'web', '2024-01-19 14:07:03', '2024-01-19 14:07:03'),
(12, 'courier delete', 'Courier', 'web', '2024-01-19 14:07:03', '2024-01-19 14:07:03'),
(13, 'product list', 'Product', 'web', '2024-01-19 14:07:03', '2024-01-19 14:07:03'),
(14, 'product create', 'Product', 'web', '2024-01-19 14:07:03', '2024-01-19 14:07:03'),
(15, 'product edit', 'Product', 'web', '2024-01-19 14:07:03', '2024-01-19 14:07:03'),
(16, 'product delete', 'Product', 'web', '2024-01-19 14:07:04', '2024-01-19 14:07:04'),
(17, 'category list', 'Category', 'web', '2024-01-19 14:07:04', '2024-01-19 14:07:04'),
(18, 'category create', 'Category', 'web', '2024-01-19 14:07:04', '2024-01-19 14:07:04'),
(19, 'category edit', 'Category', 'web', '2024-01-19 14:07:04', '2024-01-19 14:07:04'),
(20, 'category delete', 'Category', 'web', '2024-01-19 14:07:04', '2024-01-19 14:07:04'),
(21, 'subCategory list', 'SubCategory', 'web', '2024-01-19 14:07:04', '2024-01-19 14:07:04'),
(22, 'subCategory create', 'SubCategory', 'web', '2024-01-19 14:07:04', '2024-01-19 14:07:04'),
(23, 'subCategory edit', 'SubCategory', 'web', '2024-01-19 14:07:04', '2024-01-19 14:07:04'),
(24, 'subCategory delete', 'SubCategory', 'web', '2024-01-19 14:07:05', '2024-01-19 14:07:05'),
(25, 'brand list', 'Brand', 'web', '2024-01-19 14:07:05', '2024-01-19 14:07:05'),
(26, 'brand create', 'Brand', 'web', '2024-01-19 14:07:05', '2024-01-19 14:07:05'),
(27, 'brand edit', 'Brand', 'web', '2024-01-19 14:07:05', '2024-01-19 14:07:05'),
(28, 'brand delete', 'Brand', 'web', '2024-01-19 14:07:05', '2024-01-19 14:07:05'),
(29, 'color list', 'Color', 'web', '2024-01-19 14:07:05', '2024-01-19 14:07:05'),
(30, 'color create', 'Color', 'web', '2024-01-19 14:07:05', '2024-01-19 14:07:05'),
(31, 'color edit', 'Color', 'web', '2024-01-19 14:07:05', '2024-01-19 14:07:05'),
(32, 'color delete', 'Color', 'web', '2024-01-19 14:07:05', '2024-01-19 14:07:05'),
(33, 'size list', 'Size', 'web', '2024-01-19 14:07:06', '2024-01-19 14:07:06'),
(34, 'size create', 'Size', 'web', '2024-01-19 14:07:06', '2024-01-19 14:07:06'),
(35, 'size edit', 'Size', 'web', '2024-01-19 14:07:06', '2024-01-19 14:07:06'),
(36, 'size delete', 'Size', 'web', '2024-01-19 14:07:06', '2024-01-19 14:07:06'),
(37, 'banner list', 'Banner', 'web', '2024-01-19 14:07:06', '2024-01-19 14:07:06'),
(38, 'banner create', 'Banner', 'web', '2024-01-19 14:07:06', '2024-01-19 14:07:06'),
(39, 'banner edit', 'Banner', 'web', '2024-01-19 14:07:07', '2024-01-19 14:07:07'),
(40, 'banner delete', 'Banner', 'web', '2024-01-19 14:07:07', '2024-01-19 14:07:07'),
(41, 'partner list', 'Partner', 'web', '2024-01-19 14:07:07', '2024-01-19 14:07:07'),
(42, 'partner create', 'Partner', 'web', '2024-01-19 14:07:07', '2024-01-19 14:07:07'),
(43, 'partner edit', 'Partner', 'web', '2024-01-19 14:07:07', '2024-01-19 14:07:07'),
(44, 'partner delete', 'Partner', 'web', '2024-01-19 14:07:07', '2024-01-19 14:07:07'),
(45, 'report list', 'Report', 'web', '2024-01-19 14:07:07', '2024-01-19 14:07:07'),
(46, 'report create', 'Report', 'web', '2024-01-19 14:07:07', '2024-01-19 14:07:07'),
(47, 'report edit', 'Report', 'web', '2024-01-19 14:07:08', '2024-01-19 14:07:08'),
(48, 'report delete', 'Report', 'web', '2024-01-19 14:07:08', '2024-01-19 14:07:08'),
(49, 'stock list', 'Stock', 'web', '2024-01-19 14:07:08', '2024-01-19 14:07:08'),
(50, 'stock create', 'Stock', 'web', '2024-01-19 14:07:08', '2024-01-19 14:07:08'),
(51, 'stock edit', 'Stock', 'web', '2024-01-19 14:07:08', '2024-01-19 14:07:08'),
(52, 'stock delete', 'Stock', 'web', '2024-01-19 14:07:09', '2024-01-19 14:07:09'),
(53, 'coupon list', 'Coupon', 'web', '2024-01-19 14:07:09', '2024-01-19 14:07:09'),
(54, 'coupon create', 'Coupon', 'web', '2024-01-19 14:07:09', '2024-01-19 14:07:09'),
(55, 'coupon edit', 'Coupon', 'web', '2024-01-19 14:07:09', '2024-01-19 14:07:09'),
(56, 'coupon delete', 'Coupon', 'web', '2024-01-19 14:07:09', '2024-01-19 14:07:09'),
(57, 'subscriber list', 'Subscriber', 'web', '2024-01-19 14:07:09', '2024-01-19 14:07:09'),
(58, 'subscriber create', 'Subscriber', 'web', '2024-01-19 14:07:09', '2024-01-19 14:07:09'),
(59, 'subscriber edit', 'Subscriber', 'web', '2024-01-19 14:07:09', '2024-01-19 14:07:09'),
(60, 'subscriber delete', 'Subscriber', 'web', '2024-01-19 14:07:10', '2024-01-19 14:07:10'),
(61, 'supportMessage list', 'SupportMessage', 'web', '2024-01-19 14:07:10', '2024-01-19 14:07:10'),
(62, 'supportMessage create', 'SupportMessage', 'web', '2024-01-19 14:07:10', '2024-01-19 14:07:10'),
(63, 'supportMessage edit', 'SupportMessage', 'web', '2024-01-19 14:07:10', '2024-01-19 14:07:10'),
(64, 'supportMessage delete', 'SupportMessage', 'web', '2024-01-19 14:07:10', '2024-01-19 14:07:10'),
(65, 'setting list', 'Setting', 'web', '2024-01-19 14:07:10', '2024-01-19 14:07:10'),
(66, 'setting create', 'Setting', 'web', '2024-01-19 14:07:10', '2024-01-19 14:07:10'),
(67, 'setting edit', 'Setting', 'web', '2024-01-19 14:07:10', '2024-01-19 14:07:10'),
(68, 'setting delete', 'Setting', 'web', '2024-01-19 14:07:11', '2024-01-19 14:07:11'),
(69, 'fileManager list', 'FileManager', 'web', '2024-01-19 14:07:11', '2024-01-19 14:07:11'),
(70, 'fileManager create', 'FileManager', 'web', '2024-01-19 14:07:11', '2024-01-19 14:07:11'),
(71, 'fileManager edit', 'FileManager', 'web', '2024-01-19 14:07:11', '2024-01-19 14:07:11'),
(72, 'fileManager delete', 'FileManager', 'web', '2024-01-19 14:07:11', '2024-01-19 14:07:11'),
(73, 'blog list', 'Blog', 'web', '2024-01-19 14:07:11', '2024-01-19 14:07:11'),
(74, 'blog create', 'Blog', 'web', '2024-01-19 14:07:12', '2024-01-19 14:07:12'),
(75, 'blog edit', 'Blog', 'web', '2024-01-19 14:07:12', '2024-01-19 14:07:12'),
(76, 'blog delete', 'Blog', 'web', '2024-01-19 14:07:12', '2024-01-19 14:07:12'),
(77, 'tag list', 'Tag', 'web', '2024-01-19 14:07:12', '2024-01-19 14:07:12'),
(78, 'tag create', 'Tag', 'web', '2024-01-19 14:07:12', '2024-01-19 14:07:12'),
(79, 'tag edit', 'Tag', 'web', '2024-01-19 14:07:13', '2024-01-19 14:07:13'),
(80, 'tag delete', 'Tag', 'web', '2024-01-19 14:07:13', '2024-01-19 14:07:13'),
(81, 'page list', 'Page', 'web', '2024-01-19 14:07:13', '2024-01-19 14:07:13'),
(82, 'page create', 'Page', 'web', '2024-01-19 14:07:13', '2024-01-19 14:07:13'),
(83, 'page edit', 'Page', 'web', '2024-01-19 14:07:13', '2024-01-19 14:07:13'),
(84, 'page delete', 'Page', 'web', '2024-01-19 14:07:14', '2024-01-19 14:07:14'),
(85, 'order list', 'Order', 'web', '2024-01-19 14:07:14', '2024-01-19 14:07:14'),
(86, 'order create', 'Order', 'web', '2024-01-19 14:07:14', '2024-01-19 14:07:14'),
(87, 'order edit', 'Order', 'web', '2024-01-19 14:07:14', '2024-01-19 14:07:14'),
(88, 'order delete', 'Order', 'web', '2024-01-19 14:07:14', '2024-01-19 14:07:14'),
(89, 'pending Order', 'Order', 'web', '2024-01-19 14:07:15', '2024-01-19 14:07:15'),
(90, 'processing Order', 'Order', 'web', '2024-01-19 14:07:15', '2024-01-19 14:07:15'),
(91, 'holding Order', 'Order', 'web', '2024-01-19 14:07:15', '2024-01-19 14:07:15'),
(92, 'canceled Order', 'Order', 'web', '2024-01-19 14:07:15', '2024-01-19 14:07:15'),
(93, 'complected Order', 'Order', 'web', '2024-01-19 14:07:15', '2024-01-19 14:07:15'),
(94, 'pendingInvoice Order', 'Order', 'web', '2024-01-19 14:07:16', '2024-01-19 14:07:16'),
(95, 'invoice Order', 'Order', 'web', '2024-01-19 14:07:16', '2024-01-19 14:07:16'),
(96, 'invoicePrint Order', 'Order', 'web', '2024-01-19 14:07:16', '2024-01-19 14:07:16'),
(97, 'stockOut Order', 'Order', 'web', '2024-01-19 14:07:16', '2024-01-19 14:07:16'),
(98, 'delivered Order', 'Order', 'web', '2024-01-19 14:07:16', '2024-01-19 14:07:16'),
(99, 'return Order', 'Order', 'web', '2024-01-19 14:07:17', '2024-01-19 14:07:17'),
(100, 'lost Order', 'Order', 'web', '2024-01-19 14:07:17', '2024-01-19 14:07:17');

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `bc_id` int(11) NOT NULL,
  `tag_id` bigint(20) UNSIGNED DEFAULT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_short_details` text DEFAULT NULL,
  `post_details` longtext DEFAULT NULL,
  `post_feature_image` varchar(255) DEFAULT NULL,
  `post_url` varchar(255) DEFAULT NULL,
  `post_slug` varchar(255) DEFAULT NULL,
  `post_active` int(11) NOT NULL DEFAULT 0,
  `post_status` int(11) NOT NULL DEFAULT 1,
  `blog_meta_title` varchar(255) DEFAULT NULL,
  `blog_meta_details` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `bc_id`, `tag_id`, `post_title`, `post_short_details`, `post_details`, `post_feature_image`, `post_url`, `post_slug`, `post_active`, `post_status`, `blog_meta_title`, `blog_meta_details`, `created_at`, `updated_at`) VALUES
(1, 7, 5, 'Voluptatum ut voluptas qui.', 'Quos rerum nulla dolorem consequatur omnis quisquam alias facilis quod.', 'Consequatur non corporis nam libero tempora rem. Enim minima nemo voluptatem ratione tempore et eos. Consequatur modi eveniet est enim. Facilis ipsa veniam earum eius placeat maiores et maxime. Vel aut officiis explicabo quo unde aliquam. Qui tempore earum totam tempora. Similique porro cumque maxime nihil.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+ut', 'voluptatum-ut-voluptas-qui', '65aa821bcb045', 1, 1, 'voluptatum ut voluptas qui.', 'Enim impedit ex assumenda deserunt aut asperiores.', '2024-01-19 14:07:23', '2024-01-19 14:07:23'),
(2, 10, 5, 'Autem id quisquam quisquam et.', 'Officiis omnis voluptas sint iusto voluptatem commodi et.', 'Hic et nam iure sequi reiciendis tempore. Praesentium omnis et omnis in. Ut a consectetur atque est modi reprehenderit tenetur. Sint vel molestiae nisi delectus et eum. Amet ad autem corporis temporibus. Porro consequatur sed dignissimos excepturi harum dicta dolore. Magni cupiditate voluptatibus qui quia. Molestiae dolorem ducimus ex quia facilis cum enim.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+asperiores', 'autem-id-quisquam-quisquam-et', '65aa821bcb44c', 1, 1, 'autem id quisquam quisquam et.', 'Totam natus nihil sunt eum quisquam odio et earum incidunt.', '2024-01-19 14:07:24', '2024-01-19 14:07:24'),
(3, 9, 6, 'Accusamus pariatur modi rerum commodi.', 'Iste et impedit illo et et eligendi voluptas.', 'Officiis vel voluptas placeat harum sint. Quos quos iusto est fugit. Reiciendis earum deserunt placeat sunt. Numquam et amet est laborum maiores. Aliquam vel iusto est porro voluptas exercitationem saepe illo. Porro aut a perspiciatis nihil ullam. Quia vero adipisci est beatae corrupti at.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+deleniti', 'accusamus-pariatur-modi-rerum-commodi', '65aa821bcb7fb', 1, 1, 'accusamus pariatur modi rerum commodi.', 'Cupiditate ut et aliquid suscipit debitis animi occaecati quod porro aut.', '2024-01-19 14:07:24', '2024-01-19 14:07:24'),
(4, 8, 5, 'Et sed quod odio dolores.', 'Nemo tempore qui est quod quod nisi.', 'Odio rem vitae fuga eum laudantium. Quia consequuntur voluptas ut velit porro praesentium neque sed. Distinctio quo possimus non quo ipsa qui. Et accusamus et ex quaerat minima ut. Alias aspernatur sunt explicabo dolorum ipsa. Rerum sapiente et odio mollitia. Error aliquam est sunt saepe illo in quod. Neque autem sit molestias voluptates facere architecto neque. Eos odio aut possimus quibusdam ut. Minus reprehenderit rem repudiandae dicta. Suscipit quaerat laboriosam quas assumenda omnis. Quibusdam ea est aut est beatae aut molestiae est.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+aut', 'et-sed-quod-odio-dolores', '65aa821bcbbb8', 1, 1, 'et sed quod odio dolores.', 'Facere mollitia placeat soluta provident vel dicta.', '2024-01-19 14:07:24', '2024-01-19 14:07:24'),
(5, 3, 8, 'Quaerat voluptatibus et veritatis velit.', 'Omnis molestiae voluptatem laudantium quis commodi voluptatem quas sint non quae rerum.', 'Consectetur eveniet suscipit nesciunt quisquam. Sed consequatur perferendis quisquam consequatur sint facere quo unde. Necessitatibus maiores id repellendus adipisci vel facere. Repudiandae aperiam neque perspiciatis deserunt qui cum dolorum. Deleniti in vel et consequatur soluta autem. Enim consequatur sint iusto nobis cumque laborum. Odit consectetur pariatur molestiae. Unde quas est voluptas. Optio sed quod libero nulla. Ipsum ullam eos voluptas totam minima aut accusamus. Et qui natus in et sint. Quaerat aut sunt consectetur beatae eveniet eum. Tempora odit a ipsum.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+quaerat', 'quaerat-voluptatibus-et-veritatis-velit', '65aa821bcbf76', 1, 1, 'quaerat voluptatibus et veritatis velit.', 'Tempora fugit minima fuga nihil aliquam eius voluptate consequatur non neque alias molestiae totam.', '2024-01-19 14:07:24', '2024-01-19 14:07:24'),
(6, 2, 7, 'Consequatur sint harum soluta omnis explicabo.', 'Aliquid exercitationem facilis velit et eius quas ut facere aliquid quasi soluta similique.', 'Excepturi natus quam et. Eum deserunt ea adipisci consequatur. Et repellat quia non. Dolores aut porro officiis est. Aperiam non atque quasi perferendis et voluptas. Ut qui iure autem magni voluptates. Suscipit iure culpa facilis perspiciatis tenetur. Aut architecto error in laborum nisi voluptatem. Aspernatur est in expedita nulla dolorem deleniti autem. Labore quis est eos tempora. Asperiores id consequatur dolore et omnis exercitationem recusandae. Esse quod molestias earum quia temporibus et nam. Dignissimos occaecati inventore necessitatibus sit.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+minus', 'consequatur-sint-harum-soluta-omnis-explicabo', '65aa821bcc33c', 1, 1, 'consequatur sint harum soluta omnis explicabo.', 'Accusantium qui alias quia hic corporis dicta minus architecto perferendis.', '2024-01-19 14:07:24', '2024-01-19 14:07:24'),
(7, 7, 1, 'Maxime sunt non qui nostrum necessitatibus dolor vel.', 'Enim et sed consequuntur accusamus amet nobis quas possimus distinctio repellendus eligendi quidem repudiandae.', 'Dignissimos pariatur et ut quia aspernatur debitis occaecati. Et ut sunt dolores error. Culpa occaecati vero et sit quidem repudiandae nihil. Quis natus blanditiis dolorum natus. Sed eum quaerat consectetur velit in facere tenetur. Dolorem ipsa voluptatem ullam nihil a. Et quisquam eligendi dolores veritatis eos maiores asperiores consectetur. Sit beatae eaque corporis quos. Doloremque ullam iste dicta deleniti id quos inventore. Similique dolor rerum facilis tempora excepturi aut.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+esse', 'maxime-sunt-non-qui-nostrum-necessitatibus-dolor-vel', '65aa821bcc6ee', 1, 1, 'maxime sunt non qui nostrum necessitatibus dolor vel.', 'Voluptate et omnis error illo voluptas facere ex dolorem similique quisquam qui.', '2024-01-19 14:07:24', '2024-01-19 14:07:24'),
(8, 7, 9, 'Tenetur neque aliquam sit porro et molestias sed.', 'Quibusdam aut illum nam et consequatur delectus velit.', 'Autem architecto magnam similique libero quis accusamus ex. Et voluptas accusamus aut quis provident accusantium est. Voluptatem sed dignissimos non modi. Nobis rerum sed aut aut ut quia. Recusandae explicabo reiciendis distinctio eligendi eos nemo voluptate rerum. Provident voluptas voluptates at cupiditate. Sed fugit quisquam magni quidem qui voluptates. Sed dolores et explicabo earum non autem fuga dolor. Iusto et placeat ut magni magnam qui dolorem.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+non', 'tenetur-neque-aliquam-sit-porro-et-molestias-sed', '65aa821bcca95', 1, 1, 'tenetur neque aliquam sit porro et molestias sed.', 'Veniam autem omnis voluptatem quos quos consectetur harum unde est et ratione laudantium.', '2024-01-19 14:07:24', '2024-01-19 14:07:24'),
(9, 3, 10, 'Aut temporibus quia dolor neque quo.', 'Libero architecto ut ut et nisi quas deserunt id aspernatur deleniti quidem.', 'Id eos dolore voluptas voluptate. Officiis quo officia veritatis. Dolorum molestiae inventore et illum. Sunt dolor mollitia et modi ea. Molestias similique qui aut. Sequi magnam deleniti ea quibusdam ut aut quaerat. Minus sint sed tempore sint autem dolor totam voluptatibus. Consequuntur dolores architecto impedit nihil.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+et', 'aut-temporibus-quia-dolor-neque-quo', '65aa821bcce2f', 1, 1, 'aut temporibus quia dolor neque quo.', 'Ea tenetur vel et ducimus sed debitis provident molestias voluptatem quidem culpa.', '2024-01-19 14:07:24', '2024-01-19 14:07:24'),
(10, 1, 1, 'Numquam explicabo aut est assumenda praesentium ut explicabo ea.', 'Debitis facere aliquam esse nihil aut porro voluptates assumenda.', 'Quia et quam tenetur quibusdam sed accusamus. Eaque sint enim facilis neque sed. Labore dicta eos et est quia quibusdam dolorem. Unde dolorem qui totam veritatis id repellendus laborum. Et eligendi quod tempora est distinctio. Esse ut qui eveniet facilis commodi omnis voluptatibus. Aliquam accusantium animi earum voluptatibus ipsa deserunt. Et officia possimus necessitatibus debitis consequatur aut provident. Et est autem quaerat sunt. Minus nam molestiae blanditiis nihil ab. Aperiam sint et aut voluptatum. Nihil eveniet non voluptatem quia eum aut.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+tenetur', 'numquam-explicabo-aut-est-assumenda-praesentium-ut-explicabo-ea', '65aa821bcd258', 1, 1, 'numquam explicabo aut est assumenda praesentium ut explicabo ea.', 'Non quaerat sequi qui est natus saepe et est consequatur rem.', '2024-01-19 14:07:24', '2024-01-19 14:07:24'),
(11, 3, 2, 'Ducimus aut at magnam.', 'Ea ut molestias nihil eos enim enim architecto voluptatibus qui.', 'Et est enim voluptatem eum dignissimos. Dolores tempora nemo consectetur ratione nihil. Laborum ut provident et sapiente nostrum magni totam impedit. At occaecati et molestiae. Vitae ipsum nostrum aut non necessitatibus velit. Eveniet necessitatibus cum similique deleniti itaque praesentium nulla. Dolor illo ea velit et aut soluta labore. Deserunt autem illo ex dignissimos. Deleniti velit dolorum laboriosam architecto. Ut provident hic voluptates harum. Praesentium et ipsam nemo quia quo et est. Ut velit occaecati quod labore magni quia beatae. Iste eligendi officia voluptates iusto explicabo minima.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+quo', 'ducimus-aut-at-magnam', '65aa821bcd68f', 1, 1, 'ducimus aut at magnam.', 'Voluptatem dolorem aliquam occaecati sit laborum eius accusantium est.', '2024-01-19 14:07:24', '2024-01-19 14:07:24'),
(12, 6, 9, 'Et nihil repudiandae inventore voluptas vel dolores.', 'Voluptatem est eligendi non corporis id minima aut vero mollitia fuga qui.', 'Et officia debitis omnis eligendi. Quas eos sit commodi. Praesentium necessitatibus non fugit delectus molestias voluptatem et. Vel vitae quo nesciunt optio non. Illum consequatur quae reprehenderit autem at quia. Ad numquam quidem corrupti vel. Dolore harum aut eaque eum. Amet velit doloremque rem dolores quae. Et deleniti perferendis incidunt fugit eaque error corrupti. Velit ducimus libero deserunt deserunt qui repellendus. Vel rerum doloribus unde eligendi voluptatum architecto eius. Voluptates quia debitis architecto qui.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+ut', 'et-nihil-repudiandae-inventore-voluptas-vel-dolores', '65aa821bcdcec', 1, 1, 'et nihil repudiandae inventore voluptas vel dolores.', 'Quidem qui et ut cumque aut totam praesentium veritatis ipsam odio qui.', '2024-01-19 14:07:24', '2024-01-19 14:07:24'),
(13, 6, 6, 'Distinctio quae totam est.', 'Suscipit distinctio labore maxime deleniti ut accusamus.', 'Atque et voluptatum vel aut deleniti. Aut autem nihil eligendi sequi tempora asperiores perferendis. Quod libero eum ut ea voluptatum minus aliquam. Dolores autem fugiat tempora veritatis. Placeat nemo itaque debitis saepe. Quas veritatis rerum ut rerum et incidunt. Inventore dignissimos sed qui modi mollitia consequatur. Id aperiam itaque dignissimos repellendus labore vitae sit. Ipsum in tempore quibusdam adipisci ipsum. Et enim non dolores adipisci quia adipisci debitis. Eos corrupti animi consequatur ut dolorum labore sed. Beatae vel minus non aperiam aperiam eligendi velit. Et velit in harum dolor vero sed quasi.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+et', 'distinctio-quae-totam-est', '65aa821bce1a5', 1, 1, 'distinctio quae totam est.', 'Et nisi voluptatem eos sit consectetur modi.', '2024-01-19 14:07:24', '2024-01-19 14:07:24'),
(14, 9, 9, 'Doloribus voluptatum reiciendis facilis sint.', 'Blanditiis accusamus est quia id qui dolorem occaecati maxime corrupti ut.', 'Eum vel vel eligendi labore. Voluptatem magnam quis et placeat. Et rerum quibusdam non itaque iusto iusto. Quo qui et doloribus aut aspernatur. Officia debitis non non commodi quia. Quaerat enim porro at officiis tempore qui quia. Voluptatem sequi odio vero necessitatibus magni. Minima eaque rerum error quo modi quia.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+natus', 'doloribus-voluptatum-reiciendis-facilis-sint', '65aa821bce54a', 1, 1, 'doloribus voluptatum reiciendis facilis sint.', 'A aut minima molestias recusandae facere delectus exercitationem quaerat.', '2024-01-19 14:07:24', '2024-01-19 14:07:24'),
(15, 4, 5, 'Magni nobis officia nostrum sunt sit.', 'Eius ad fugiat ullam architecto vel nostrum dolorum neque aut odit eum placeat.', 'Suscipit reiciendis iure nam quia quia voluptate. Dolor illum officiis eveniet. Quisquam dignissimos mollitia officiis incidunt. Eos officiis qui quidem rerum et. Quia sit qui laborum est. Fugiat deleniti quos quas quo repellendus atque nisi. Eum officiis consequatur possimus expedita sint libero quia. Vel in rerum fuga fuga eaque. Non recusandae culpa nobis dolore. Nihil omnis nostrum culpa hic. Provident consequatur iste explicabo repellat et molestias ea eum. Est dignissimos dolorem autem accusamus velit a cupiditate. Aut impedit sed nobis sint.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+similique', 'magni-nobis-officia-nostrum-sunt-sit', '65aa821bce901', 1, 1, 'magni nobis officia nostrum sunt sit.', 'Maiores et itaque eos et unde voluptas.', '2024-01-19 14:07:24', '2024-01-19 14:07:24'),
(16, 10, 9, 'Non aut ea nobis blanditiis asperiores sunt voluptas.', 'Est corrupti doloribus ipsa optio amet dignissimos est quas distinctio non aspernatur.', 'Reiciendis consequatur minima ipsam molestias. Non quo qui sint pariatur et architecto voluptas eaque. Fugiat temporibus occaecati qui repellendus voluptate. Tempore nihil quas et at. Omnis veniam autem vel eum. Sed esse a necessitatibus debitis similique quibusdam. Repellendus eos amet nesciunt totam corrupti. Dignissimos ut et alias velit. Vero provident nemo cum necessitatibus reprehenderit. Sed numquam voluptas saepe et enim et nobis quo. Quia est et esse occaecati et ratione.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+possimus', 'non-aut-ea-nobis-blanditiis-asperiores-sunt-voluptas', '65aa821bced18', 1, 1, 'non aut ea nobis blanditiis asperiores sunt voluptas.', 'Enim asperiores illo omnis nihil ut consequatur provident officiis provident perspiciatis vel.', '2024-01-19 14:07:24', '2024-01-19 14:07:24'),
(17, 1, 9, 'Magni non eos perspiciatis laboriosam saepe.', 'Quibusdam in aut molestiae est deleniti eaque et voluptatem aut cumque impedit.', 'Et ab incidunt exercitationem dolor similique. Iste aliquid rerum omnis ut et. Repellat nostrum repudiandae in dolores ratione pariatur. Quis aperiam molestias dolorem rerum. Quo ad vitae voluptas ratione molestiae sunt. Expedita quaerat ut sit quia. Saepe sed explicabo laborum animi qui aut. Laboriosam eos atque tempore a quibusdam non et eaque. Dolore velit quam quasi sapiente est. Aut velit aut qui ut enim maiores modi. Et sequi labore ut et quos molestias ut. Eligendi numquam officiis sed nihil perferendis qui est. Similique tenetur modi dolores omnis quisquam. Facilis velit consequatur ipsa cupiditate eaque eos veritatis et.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+dicta', 'magni-non-eos-perspiciatis-laboriosam-saepe', '65aa821bcf170', 1, 1, 'magni non eos perspiciatis laboriosam saepe.', 'Perferendis modi sed veniam quae beatae at ut voluptas accusamus aspernatur.', '2024-01-19 14:07:25', '2024-01-19 14:07:25'),
(18, 1, 3, 'Eum aut laudantium voluptas ipsam quia natus.', 'Ut quas aliquam fuga sed cumque commodi minima ea a eius omnis dolores et.', 'Deserunt debitis voluptate sed et saepe quisquam fugiat nam. Corporis sunt impedit rem. Quasi optio illum nihil ipsam natus non. Aut labore nesciunt doloremque omnis quasi. Error harum voluptas quod quia similique qui. Provident omnis autem autem est. Numquam ipsum praesentium est eaque quis necessitatibus.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+facilis', 'eum-aut-laudantium-voluptas-ipsam-quia-natus', '65aa821bcf4e1', 1, 1, 'eum aut laudantium voluptas ipsam quia natus.', 'Eum enim nesciunt iste aut occaecati sed alias a eligendi praesentium neque rerum commodi.', '2024-01-19 14:07:25', '2024-01-19 14:07:25'),
(19, 1, 9, 'Distinctio numquam nobis ut numquam neque eveniet iusto.', 'Eos ducimus et maiores ad eligendi quae quasi repellendus quae sint similique.', 'Illo occaecati voluptas vero impedit unde quo. Beatae consequatur et sit illum earum aliquid. Omnis non harum unde deserunt officiis. Id accusamus ex quam inventore unde blanditiis quidem. Impedit nobis reiciendis dolorem iusto et veritatis qui. Laudantium consectetur commodi voluptate. Aliquid possimus reiciendis distinctio modi rem. Ea doloremque rerum eaque deserunt est. In maiores amet velit error laudantium quia nihil. Expedita ut ut fugit. In placeat illo ab reprehenderit. Ipsam facilis eum eveniet temporibus libero reprehenderit ea. Cupiditate dicta voluptas sit aperiam.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+rem', 'distinctio-numquam-nobis-ut-numquam-neque-eveniet-iusto', '65aa821bcf917', 1, 1, 'distinctio numquam nobis ut numquam neque eveniet iusto.', 'Impedit inventore perferendis ea quis culpa dolor porro.', '2024-01-19 14:07:25', '2024-01-19 14:07:25'),
(20, 7, 1, 'Velit sequi harum architecto soluta odit debitis.', 'Porro dignissimos laborum optio qui quisquam dolor ullam.', 'Vel voluptatem est dolorem voluptatem omnis commodi aspernatur ut. Consectetur animi debitis ducimus adipisci aspernatur sit. Et neque consequatur possimus exercitationem. Necessitatibus facilis veniam velit nulla voluptatem quaerat. Enim expedita eaque occaecati officia vel non ex. Sunt voluptatibus rerum ullam sit. Harum fuga quae aspernatur tempora ea.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+consequatur', 'velit-sequi-harum-architecto-soluta-odit-debitis', '65aa821bcfc68', 1, 1, 'velit sequi harum architecto soluta odit debitis.', 'Maiores eum et molestias vel qui quo voluptatem aspernatur quis reprehenderit vel.', '2024-01-19 14:07:25', '2024-01-19 14:07:25'),
(21, 4, 3, 'Illum consequatur ad est rem eveniet.', 'Voluptatem similique facere consequatur amet illo omnis omnis occaecati qui.', 'Saepe atque consequatur sed ut doloribus porro nulla iste. Aut at deleniti quisquam quia. Voluptas in provident mollitia aut. Et molestiae rerum error qui esse. Dolorem illo ipsam odio. Esse nam sint et magnam distinctio harum tenetur quod. Doloribus quis repudiandae consequatur rerum. Ducimus sit odit temporibus. Aut iste et sed error vero. Magnam mollitia repellendus commodi fugit totam aspernatur. Vel dignissimos architecto totam ea ea at. Aperiam et voluptatum aspernatur enim ipsum dolores cumque. Similique ut blanditiis et nisi voluptatibus provident.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+repudiandae', 'illum-consequatur-ad-est-rem-eveniet', '65aa821bcffe2', 1, 1, 'illum consequatur ad est rem eveniet.', 'Laborum qui repellat sit magni et minus ipsa itaque tempora et eligendi deleniti.', '2024-01-19 14:07:25', '2024-01-19 14:07:25'),
(22, 8, 10, 'Non eaque architecto dolorem ipsum.', 'Qui fugiat impedit quia quas sint quis repellat atque officiis dolor sequi et a.', 'Ut dicta enim aspernatur veritatis aut molestiae. Est porro deserunt est. Omnis sed iusto laborum culpa. Velit numquam pariatur nobis. Autem eius deserunt amet occaecati laboriosam qui. Assumenda ad cumque consectetur doloribus accusamus. Fuga ipsa harum corrupti cumque eveniet sint unde. Excepturi sapiente id totam aperiam.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+culpa', 'non-eaque-architecto-dolorem-ipsum', '65aa821bd0331', 1, 1, 'non eaque architecto dolorem ipsum.', 'Minus alias id voluptatem ea enim blanditiis et et recusandae asperiores veritatis expedita ut.', '2024-01-19 14:07:25', '2024-01-19 14:07:25'),
(23, 9, 9, 'Minus unde enim repudiandae officiis.', 'Quam architecto suscipit aut iusto eveniet et exercitationem nihil sit commodi.', 'Dolor tempore consequatur odio voluptatem iusto dolorum. Ullam velit dolores magnam earum. Occaecati et unde voluptatem neque. In exercitationem qui beatae rerum voluptas et. Vel numquam id nesciunt dolores voluptatem ad. Repellendus et et nihil minus. Accusamus quis aspernatur et nihil animi. Nam aut adipisci veritatis pariatur vitae aliquam. Veritatis eius similique pariatur esse fugiat. Sunt et nemo occaecati maiores animi deleniti ullam unde. Voluptatem perspiciatis dolores vero distinctio dolorum ut qui quia.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+dignissimos', 'minus-unde-enim-repudiandae-officiis', '65aa821bd06b8', 1, 1, 'minus unde enim repudiandae officiis.', 'Reiciendis consequatur quia deleniti ipsa excepturi veritatis ea.', '2024-01-19 14:07:25', '2024-01-19 14:07:25'),
(24, 7, 10, 'Sunt nihil dolorem consequatur occaecati dolorem pariatur veniam.', 'Ut quidem rerum quam rem quas qui rerum ut officiis tenetur rem nemo eius.', 'A necessitatibus eius eos. Esse quia tempora sint sunt nihil voluptas. Tenetur aut aut quod sunt non. Inventore dicta voluptas tempora labore. Eos deserunt repellat nobis eum voluptatem nam voluptas. Nam voluptatem voluptas cumque voluptate magnam. Aut occaecati id minus et. Quia consectetur ex minima quia. Quis unde optio labore accusamus. Est sed qui et omnis placeat.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+et', 'sunt-nihil-dolorem-consequatur-occaecati-dolorem-pariatur-veniam', '65aa821bd0a37', 1, 1, 'sunt nihil dolorem consequatur occaecati dolorem pariatur veniam.', 'Numquam unde debitis quam omnis culpa praesentium temporibus minus aliquam deserunt nisi.', '2024-01-19 14:07:25', '2024-01-19 14:07:25'),
(25, 4, 1, 'Ea corporis magni est nam facilis blanditiis fugit.', 'Quia nam esse repellat aperiam qui ipsa accusantium qui voluptatem occaecati ipsa ad.', 'Est voluptas quia consequatur ad repudiandae ea. Dolore error sapiente est enim itaque maxime nemo. Ea dolores molestias ut est dolor et. Omnis earum voluptatem hic. Expedita autem illo placeat voluptatem reiciendis quia eum. Deserunt corporis quae inventore labore consequatur sit. Et omnis quasi aut nobis suscipit. Vitae inventore repellendus reiciendis possimus. Commodi voluptas iusto nisi. Omnis ducimus autem facilis culpa delectus nisi. Eius qui asperiores quia numquam reprehenderit. Veniam hic aliquid magnam atque sint sint dolores reiciendis. Quam quas nisi et esse iusto aut.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+voluptatem', 'ea-corporis-magni-est-nam-facilis-blanditiis-fugit', '65aa821bd0dc7', 1, 1, 'ea corporis magni est nam facilis blanditiis fugit.', 'Aliquid ullam nesciunt iusto doloribus perferendis id ut excepturi.', '2024-01-19 14:07:25', '2024-01-19 14:07:25'),
(26, 4, 1, 'Nostrum vel nihil necessitatibus.', 'Provident dicta at error eos velit excepturi.', 'Nesciunt reprehenderit ducimus atque qui. Ipsum vero nemo velit ut laborum delectus. Quidem doloribus et unde illo odio cum eveniet vitae. Sed dolores totam ducimus. Odio exercitationem est omnis dicta sed. Aliquam laudantium ratione dolores accusamus aperiam ducimus. Est ea consequatur rerum placeat odit. Suscipit non quaerat at ut labore dicta est id. Sunt doloremque reprehenderit ea esse ut. Itaque repudiandae vero iste et. Error et sed est voluptatibus et aspernatur voluptas. Illo tempore id autem consequuntur. Et error voluptatem perspiciatis illo.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+sit', 'nostrum-vel-nihil-necessitatibus', '65aa821bd1172', 1, 1, 'nostrum vel nihil necessitatibus.', 'Reiciendis aut sapiente eligendi quia quo in quisquam.', '2024-01-19 14:07:25', '2024-01-19 14:07:25'),
(27, 9, 9, 'Eius voluptas labore ut perferendis.', 'Cupiditate unde ratione non nihil perspiciatis qui placeat numquam.', 'Libero odit maiores officiis. Minima nobis delectus harum saepe tempore incidunt voluptatum illo. Incidunt consectetur voluptates odio non ratione corrupti. Delectus qui ratione placeat consequatur. Sunt voluptatem et perspiciatis facilis accusamus. Dolorem et nostrum sit corporis est consequatur. Sapiente molestias temporibus itaque nesciunt. Autem eveniet doloribus hic alias aut quia libero. Distinctio fugit sed quas beatae qui magnam dolor. Rem cumque voluptatem aut quam illum quia. Nihil voluptatem omnis incidunt autem sit expedita. Consequuntur sunt quam ut.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+sint', 'eius-voluptas-labore-ut-perferendis', '65aa821bd14f2', 1, 1, 'eius voluptas labore ut perferendis.', 'Consequatur aut saepe rerum qui error qui dolor quia et amet eveniet.', '2024-01-19 14:07:25', '2024-01-19 14:07:25'),
(28, 10, 2, 'Sequi quis quis rem.', 'Atque quia sit quaerat quaerat sequi perferendis odit aut ut optio aut odio.', 'Explicabo earum voluptatem laborum laudantium et officia. Saepe laborum quaerat voluptatem beatae ab. Qui sed id quo eos atque. Sit similique possimus id fugit vel tenetur voluptatem maxime. Dicta cumque mollitia id tempore quas. Tempora quod ratione aut corporis. Quidem possimus dolor aspernatur quia non laboriosam. Excepturi et recusandae occaecati voluptatem cupiditate laboriosam. Consequatur non nihil nesciunt debitis. Non accusantium animi esse iste debitis quis porro. Explicabo qui quo mollitia id numquam sit. Aliquid qui eligendi quae earum qui. Et tempora officia quod et inventore molestiae. Aut nemo sint aspernatur vel. Quidem aut quasi aut rem quas sunt.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+officiis', 'sequi-quis-quis-rem', '65aa821bd1941', 1, 1, 'sequi quis quis rem.', 'Aliquam fuga dolore mollitia incidunt velit ut dolores quas similique non distinctio accusamus.', '2024-01-19 14:07:25', '2024-01-19 14:07:25'),
(29, 4, 5, 'Dolor quia architecto saepe earum.', 'Nostrum aut eos nihil quod eligendi quae officiis sit autem eveniet facere qui.', 'Reiciendis quasi non omnis praesentium ut. Aut et commodi maiores amet doloribus veritatis. Aperiam beatae reprehenderit debitis est. Sit dolor autem voluptatem. Unde voluptatem in aperiam commodi. Quos nihil asperiores odio dolorum magni quo consequuntur. Quam quae cum dolores aliquam odit consequuntur molestiae. Distinctio quis consequuntur et ea qui nostrum. Et est facilis sed ea molestias eum. Consequuntur molestias eos quos.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+cupiditate', 'dolor-quia-architecto-saepe-earum', '65aa821bd1db9', 1, 1, 'dolor quia architecto saepe earum.', 'Aspernatur et a omnis totam rerum aut odit nihil sed et.', '2024-01-19 14:07:25', '2024-01-19 14:07:25'),
(30, 7, 3, 'Tempore molestiae molestias reiciendis odio.', 'Ut similique et itaque vel et occaecati voluptatem inventore accusantium harum dolorem suscipit sunt.', 'Porro consectetur officiis fugit quasi dolores. Cum quam sint sit ad. Autem soluta ipsum sint blanditiis possimus quas. Cumque velit iusto assumenda nostrum fuga fugiat est. Deserunt autem voluptatem minima reiciendis numquam nam. Autem voluptas voluptas dolore rem consectetur quia odit. Qui voluptatem beatae sapiente. Quo commodi nisi et delectus. Quaerat ea in vel incidunt quas velit qui. Et vel nostrum quasi qui.', 'https://via.placeholder.com/1200x520.png/CCCCCC?text=cats+Faker+exercitationem', 'tempore-molestiae-molestias-reiciendis-odio', '65aa821bd213f', 1, 1, 'tempore molestiae molestias reiciendis odio.', 'Ea commodi quia eaque officia numquam officia vel aut nihil et in amet.', '2024-01-19 14:07:25', '2024-01-19 14:07:25');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_url` varchar(255) DEFAULT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `product_thumbnail` varchar(255) DEFAULT NULL,
  `product_featured` int(11) DEFAULT NULL,
  `product_hotDeal` int(11) DEFAULT NULL,
  `product_best_rated` int(11) DEFAULT NULL,
  `product_trending` int(11) DEFAULT NULL,
  `product_warranty` int(11) DEFAULT NULL,
  `product_back_order` int(11) DEFAULT NULL,
  `product_regular_price` int(11) NOT NULL,
  `product_discount_price` int(11) DEFAULT NULL,
  `product_quantity` int(11) NOT NULL DEFAULT 1,
  `product_purchase_quantity` int(11) DEFAULT NULL,
  `min_quantity` int(11) NOT NULL DEFAULT 1,
  `product_stock_status` int(11) NOT NULL DEFAULT 1,
  `delivery_location` varchar(255) NOT NULL DEFAULT 'bangladesh',
  `return_count` int(11) NOT NULL DEFAULT 0,
  `product_active` int(11) NOT NULL DEFAULT 1,
  `product_short_details` mediumtext NOT NULL,
  `product_details` longtext NOT NULL,
  `product_slug` varchar(255) DEFAULT NULL,
  `product_video_link` varchar(255) DEFAULT NULL,
  `product_meta_title` varchar(255) DEFAULT NULL,
  `product_meta_keyword` varchar(255) DEFAULT NULL,
  `product_meta_details` mediumtext DEFAULT NULL,
  `product_order_by` int(11) NOT NULL DEFAULT 0,
  `product_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_url`, `product_code`, `product_thumbnail`, `product_featured`, `product_hotDeal`, `product_best_rated`, `product_trending`, `product_warranty`, `product_back_order`, `product_regular_price`, `product_discount_price`, `product_quantity`, `product_purchase_quantity`, `min_quantity`, `product_stock_status`, `delivery_location`, `return_count`, `product_active`, `product_short_details`, `product_details`, `product_slug`, `product_video_link`, `product_meta_title`, `product_meta_keyword`, `product_meta_details`, `product_order_by`, `product_status`, `created_at`, `updated_at`) VALUES
(1, 'Sit repellendus aut at.', 'sit-repellendus-aut-at', '15402', '/frontend/assets/images/products/01.png', 1, 1, 1, 1, 0, 1, 2207, 1239, 43, NULL, 1, 1, 'bangladesh', 0, 1, 'Maiores et aut culpa dolores similique quo est unde. Necessitatibus et recusandae et corporis.', 'Tempore consequatur quia esse. Rerum ad laudantium fuga nesciunt nihil error commodi quos. Quia exercitationem ipsam tenetur aut rem. Veniam nesciunt esse sunt laboriosam ut nulla cum. Cum nobis quis itaque est. Doloremque cumque tenetur voluptatem voluptate quia facilis id aut. Placeat nisi nisi est doloremque architecto harum aut dolores. Sunt quisquam doloremque repudiandae pariatur voluptatem. Sunt non sed molestiae quam numquam. Aut at et mollitia eligendi corporis. Voluptate magni alias magnam quaerat ut est.', '65aa821f8646c', 'http://nienow.com/', NULL, NULL, NULL, 0, 1, '2024-01-19 14:07:27', '2024-01-19 14:07:27'),
(2, 'Est earum ullam distinctio.', 'est-earum-ullam-distinctio', '42740', '/frontend/assets/images/products/02.png', 1, 1, 1, 1, 1, 1, 1586, 1185, 31, NULL, 1, 1, 'bangladesh', 0, 1, 'Quidem non nostrum consequuntur. Tempora aut ut libero dolorem ut tempora. Dolorem quia architecto vel.', 'Consequuntur aut dolore facere beatae. Deleniti natus est in perspiciatis voluptas. Autem assumenda quia quo. Voluptatibus unde saepe doloribus eaque ratione. Et inventore illum error asperiores dolorum reprehenderit nesciunt. Officia sed facilis consequatur esse perspiciatis. Nostrum quia et quo pariatur fuga.', '65ab91b164dc7', 'https://www.erdman.com/totam-nihil-voluptatibus-et-perspiciatis-expedita-similique', 'Saied Rahman', 'Saied', 'ewewew', 0, 1, '2024-01-19 14:07:27', '2024-01-20 09:26:09'),
(3, 'Sit cum in aut.', 'sit-cum-in-aut', '55608', '/frontend/assets/images/products/06.png', 1, 1, 1, 1, 0, 0, 2204, 1300, 97, NULL, 1, 1, 'bangladesh', 0, 1, 'Quia eligendi quas ea vitae illo voluptatem omnis. Placeat aut veritatis voluptatum omnis explicabo ratione ullam.', 'Ut quas harum quasi sit. Assumenda aut magni dolores aliquam dolor distinctio molestias. Dolor repudiandae molestias corrupti molestiae itaque. Sapiente cumque a explicabo nihil laborum neque quasi. Consectetur enim vel quibusdam assumenda temporibus eveniet non. Et libero est laborum ullam cupiditate quia assumenda. Aut vitae aspernatur id atque voluptatem cupiditate dignissimos vero.', '65aa821f86760', 'https://www.carroll.com/voluptas-provident-hic-et-officiis-iusto', NULL, NULL, NULL, 0, 1, '2024-01-19 14:07:27', '2024-01-19 14:07:27'),
(4, 'Voluptatem soluta et adipisci quis.', 'voluptatem-soluta-et-adipisci-quis', '27677', '/frontend/assets/images/products/09.png', 1, 1, 1, 1, 1, 0, 2060, 1076, 30, NULL, 1, 1, 'bangladesh', 0, 1, 'Quasi praesentium autem alias natus et sint magnam. Eligendi eum quos recusandae dolore itaque optio dignissimos. Ut non sequi incidunt perspiciatis excepturi earum molestias explicabo.', 'Provident at et consequatur deserunt temporibus. Distinctio asperiores aut autem illum rerum pariatur ratione. Optio quibusdam laboriosam est eius rem non eaque. Ut rerum et voluptate qui ipsum dignissimos ut. Autem fugiat dolorem at dolorum ullam aut atque. Blanditiis odio et ut qui natus quod. Sit at dignissimos ut. Ipsa ea error incidunt eaque.', '65aa821f86891', 'http://senger.com/inventore-doloremque-minus-voluptatibus-ducimus-laudantium-tempore-non-quia', NULL, NULL, NULL, 0, 1, '2024-01-19 14:07:27', '2024-01-19 14:07:27'),
(5, 'Saepe ducimus repellendus magni sequi.', 'saepe-ducimus-repellendus-magni-sequi', '16784', '/frontend/assets/images/products/08.png', 1, 1, 1, 1, 1, 1, 2259, 1195, 31, NULL, 1, 1, 'bangladesh', 0, 1, 'Quo et earum neque recusandae in aliquam. Nemo odio accusamus aliquid sint sint quia ipsa ab.', 'Incidunt et libero quibusdam culpa. Expedita ea qui et tenetur. Id fuga et rem sit in voluptas. Sint eveniet tempora eligendi enim. Doloribus esse aliquam debitis quibusdam consequatur explicabo. Et quaerat ratione minus id similique ea. Tenetur quo et delectus quod dolores dolorem. Sit magni dolore atque dolorem. Vero porro nostrum cum. Deleniti beatae doloremque dolor id quia. Nobis eveniet praesentium debitis quaerat facere ducimus.', '65aa821f869c1', 'http://www.koepp.com/', NULL, NULL, NULL, 0, 1, '2024-01-19 14:07:27', '2024-01-19 14:07:27'),
(6, 'Adipisci in hic blanditiis laboriosam vero.', 'adipisci-in-hic-blanditiis-laboriosam-vero', '17535', '/frontend/assets/images/products/09.png', 1, 1, 1, 1, 0, 0, 2402, 1038, 37, NULL, 1, 1, 'bangladesh', 0, 1, 'Rerum eos earum eveniet natus. Est sint nisi sed dignissimos aut porro quod. Neque quibusdam reprehenderit totam vitae recusandae.', 'Quis in est minus repellat vel atque. Dolorem iste et nulla ex laborum. In architecto vel at omnis. Rerum consequatur voluptas libero harum quo. Est quasi eum eos soluta. Quia non quos illum nobis sit. Et deserunt iusto enim quis. Sequi omnis repellat voluptates ullam et fugiat rerum. Molestiae corporis suscipit sed in quae aliquam. Sed qui est et eligendi. Ipsum cupiditate quis magnam quis impedit. Omnis voluptatibus aspernatur enim voluptas enim libero. Quia saepe exercitationem et vero. Harum tenetur quia doloremque cupiditate eos necessitatibus harum.', '65aa821f86ae6', 'https://swift.com/saepe-non-ut-minima-voluptatem-laboriosam.html', NULL, NULL, NULL, 0, 1, '2024-01-19 14:07:27', '2024-01-19 14:07:27'),
(7, 'Natus harum quibusdam soluta.', 'natus-harum-quibusdam-soluta', '34378', '/frontend/assets/images/products/01.png', 1, 1, 1, 1, 1, 0, 1882, 1017, 99, NULL, 1, 1, 'bangladesh', 0, 1, 'Veniam fugiat qui corporis rerum voluptas fuga pariatur. Voluptatem rem cum numquam dignissimos ex aspernatur et.', 'Quia enim et dolorem aut eveniet. Doloremque deleniti libero molestias voluptatibus nihil quia. Eaque odit quibusdam qui voluptas sit dolore qui. Perspiciatis corporis animi aspernatur quasi aut qui ipsam. Dolores sit non nobis quo dolorum eos unde. Qui voluptas est earum cumque inventore dolorem. Et explicabo est vitae cum. Illo voluptas officiis molestiae quia. Possimus suscipit unde deserunt earum. Voluptatibus qui quia nisi vitae nulla. Qui impedit impedit placeat.', '65aa821f86c57', 'http://www.sauer.com/', NULL, NULL, NULL, 0, 1, '2024-01-19 14:07:27', '2024-01-19 14:07:27'),
(8, 'Et consequatur similique fuga sit maiores.', 'et-consequatur-similique-fuga-sit-maiores', '18131', '/frontend/assets/images/products/04.png', 1, 1, 1, 1, 1, 0, 1594, 1453, 83, NULL, 1, 1, 'bangladesh', 0, 1, 'Sed illum est nihil maxime. Et quidem est dolore suscipit vel non. Distinctio aliquid quam minima dolorem eos.', 'Velit ut magnam id sunt qui veniam. Enim qui qui corporis tempora dolorum. Hic nostrum voluptatem architecto quod. Architecto molestiae amet recusandae quas facere. Nulla rerum asperiores at animi. Et ex qui natus recusandae atque rerum. Ullam explicabo voluptas optio ut. Quidem delectus enim inventore sit.', '65aa821f86d7f', 'http://nikolaus.org/voluptatibus-quos-sit-molestiae-soluta-sint', NULL, NULL, NULL, 0, 1, '2024-01-19 14:07:27', '2024-01-19 14:07:27'),
(9, 'Dolorem fugiat sunt debitis.', 'dolorem-fugiat-sunt-debitis', '16514', '/frontend/assets/images/products/06.png', 1, 1, 1, 1, 0, 0, 2078, 1240, 78, NULL, 1, 1, 'bangladesh', 0, 1, 'Ut autem nam odio aliquid. Sint commodi voluptates voluptatem libero velit. Omnis ullam qui esse.', 'Dolorum ducimus distinctio doloremque maxime. Nesciunt incidunt laudantium enim adipisci. Recusandae minus pariatur magni eligendi adipisci dicta. Ut itaque et a molestiae illum dolorum. Illo omnis id laboriosam harum mollitia aut. Labore corrupti voluptatem dignissimos ducimus et. Qui quam eum rem ratione alias eum. Ratione itaque nam dolorem doloremque et nostrum animi vitae. Blanditiis omnis accusamus sunt necessitatibus saepe esse est. Odit quia cumque nostrum sunt temporibus doloremque. Vero molestiae exercitationem tenetur.', '65aa821f86e92', 'http://www.wilderman.net/sed-necessitatibus-ut-et-vero', NULL, NULL, NULL, 0, 1, '2024-01-19 14:07:28', '2024-01-19 14:07:28'),
(10, 'Ut dolorem dolores voluptatem quos sequi.', 'ut-dolorem-dolores-voluptatem-quos-sequi', '27922', '/frontend/assets/images/products/07.png', 1, 1, 1, 1, 0, 1, 1513, 1193, 60, NULL, 1, 1, 'bangladesh', 0, 1, 'Officia accusantium explicabo tempore minima dolores voluptatem debitis. Necessitatibus ullam itaque repellat qui. Nesciunt explicabo ea cum aperiam quia ut nisi.', 'Laudantium cupiditate consectetur culpa. Vitae sit ea natus nesciunt officia commodi. Ipsam dolor animi accusamus. Amet magni quaerat ex aut deserunt sed quod. Rerum nulla ratione illum dignissimos. Aliquid labore sunt natus quam nobis. Dolore accusamus provident exercitationem est mollitia sunt iure. Neque reiciendis fuga tempora asperiores magnam. Tempora qui veniam perspiciatis est illo deleniti aut. Omnis et ipsum corporis doloribus. Tenetur harum quaerat corporis similique similique. Ipsum dolor qui cum sed et. Deleniti nulla molestias eius aperiam eos vitae. Sit cum placeat eum enim tempora eum maiores. Sed dicta dolores id sit nihil.', '65aa821f86fc7', 'http://prohaska.com/et-sequi-ad-laboriosam-iste', NULL, NULL, NULL, 0, 1, '2024-01-19 14:07:28', '2024-01-19 14:07:28');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 8, NULL, NULL),
(2, 1, 10, NULL, NULL),
(3, 2, 2, NULL, NULL),
(4, 2, 5, NULL, NULL),
(5, 2, 6, NULL, NULL),
(6, 3, 3, NULL, NULL),
(7, 3, 4, NULL, NULL),
(8, 3, 5, NULL, NULL),
(9, 3, 7, NULL, NULL),
(10, 4, 7, NULL, NULL),
(11, 5, 4, NULL, NULL),
(12, 6, 3, NULL, NULL),
(13, 6, 4, NULL, NULL),
(14, 6, 6, NULL, NULL),
(15, 6, 7, NULL, NULL),
(16, 6, 8, NULL, NULL),
(17, 7, 2, NULL, NULL),
(18, 7, 3, NULL, NULL),
(19, 7, 6, NULL, NULL),
(20, 8, 6, NULL, NULL),
(21, 9, 3, NULL, NULL),
(22, 9, 5, NULL, NULL),
(23, 9, 7, NULL, NULL),
(24, 9, 9, NULL, NULL),
(25, 9, 10, NULL, NULL),
(26, 10, 4, NULL, NULL),
(27, 10, 5, NULL, NULL),
(28, 10, 6, NULL, NULL),
(29, 10, 8, NULL, NULL),
(30, 10, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE `product_colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_colors`
--

INSERT INTO `product_colors` (`id`, `product_id`, `color_id`, `created_at`, `updated_at`) VALUES
(1, 1, 5, NULL, NULL),
(2, 2, 3, NULL, NULL),
(3, 2, 5, NULL, NULL),
(4, 2, 9, NULL, NULL),
(5, 3, 5, NULL, NULL),
(6, 3, 6, NULL, NULL),
(7, 4, 4, NULL, NULL),
(8, 4, 6, NULL, NULL),
(9, 4, 7, NULL, NULL),
(10, 4, 9, NULL, NULL),
(11, 5, 4, NULL, NULL),
(12, 5, 8, NULL, NULL),
(13, 6, 2, NULL, NULL),
(14, 6, 3, NULL, NULL),
(15, 6, 5, NULL, NULL),
(16, 6, 7, NULL, NULL),
(17, 7, 2, NULL, NULL),
(18, 7, 10, NULL, NULL),
(19, 8, 1, NULL, NULL),
(20, 8, 3, NULL, NULL),
(21, 8, 9, NULL, NULL),
(22, 9, 1, NULL, NULL),
(23, 10, 1, NULL, NULL),
(24, 10, 3, NULL, NULL),
(25, 10, 8, NULL, NULL),
(26, 10, 9, NULL, NULL),
(27, 10, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_purchases`
--

CREATE TABLE `product_purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `pp_date` varchar(255) NOT NULL,
  `pp_memo_no` varchar(255) DEFAULT NULL,
  `pp_slug` varchar(255) DEFAULT NULL,
  `pp_quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`id`, `product_id`, `size_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 1, 5, NULL, NULL),
(6, 2, 3, NULL, NULL),
(7, 2, 5, NULL, NULL),
(8, 3, 2, NULL, NULL),
(9, 3, 3, NULL, NULL),
(10, 3, 5, NULL, NULL),
(11, 4, 2, NULL, NULL),
(12, 4, 3, NULL, NULL),
(13, 5, 4, NULL, NULL),
(14, 5, 5, NULL, NULL),
(15, 6, 1, NULL, NULL),
(16, 6, 2, NULL, NULL),
(17, 6, 3, NULL, NULL),
(18, 6, 4, NULL, NULL),
(19, 7, 1, NULL, NULL),
(20, 7, 2, NULL, NULL),
(21, 7, 3, NULL, NULL),
(22, 7, 4, NULL, NULL),
(23, 7, 5, NULL, NULL),
(24, 8, 1, NULL, NULL),
(25, 8, 2, NULL, NULL),
(26, 8, 3, NULL, NULL),
(27, 8, 5, NULL, NULL),
(28, 9, 1, NULL, NULL),
(29, 9, 2, NULL, NULL),
(30, 9, 3, NULL, NULL),
(31, 9, 5, NULL, NULL),
(32, 10, 1, NULL, NULL),
(33, 10, 2, NULL, NULL),
(34, 10, 3, NULL, NULL),
(35, 10, 4, NULL, NULL),
(36, 10, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `courier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `customer_address` text DEFAULT NULL,
  `or_return_date` date DEFAULT NULL,
  `or_return_reason` text DEFAULT NULL,
  `or_return_note` text DEFAULT NULL,
  `or_slug` varchar(255) DEFAULT NULL,
  `or_return_status` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2024-01-19 14:07:02', '2024-01-19 14:07:02'),
(2, 'Admin', 'web', '2024-01-19 14:07:02', '2024-01-19 14:07:02'),
(3, 'Manager', 'web', '2024-01-19 14:07:02', '2024-01-19 14:07:02'),
(4, 'User', 'web', '2024-01-19 14:07:02', '2024-01-19 14:07:02'),
(5, 'Customer', 'web', '2024-01-19 14:07:02', '2024-01-19 14:07:02');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_ads`
--

CREATE TABLE `service_ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sa_icon` varchar(255) NOT NULL,
  `sa_title` varchar(255) NOT NULL,
  `sa_sub_title` varchar(255) NOT NULL,
  `sa_slug` varchar(255) NOT NULL,
  `sa_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `shipping_name` varchar(255) DEFAULT NULL,
  `shipping_email` varchar(255) DEFAULT NULL,
  `shipping_phone` varchar(255) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `shipping_country` varchar(255) DEFAULT NULL,
  `shipping_area` varchar(255) DEFAULT NULL,
  `shipping_note` varchar(255) DEFAULT NULL,
  `shipping_status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size_name` varchar(255) NOT NULL,
  `size_remarks` varchar(255) DEFAULT NULL,
  `size_active` int(11) NOT NULL DEFAULT 1,
  `size_orderby` int(11) DEFAULT NULL,
  `size_slug` varchar(255) DEFAULT NULL,
  `size_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size_name`, `size_remarks`, `size_active`, `size_orderby`, `size_slug`, `size_status`, `created_at`, `updated_at`) VALUES
(1, 'S', NULL, 1, NULL, '65aa82171bb1f', 1, '2024-01-19 14:07:19', '2024-01-19 14:07:19'),
(2, 'M', NULL, 1, NULL, '65aa821758a0d', 1, '2024-01-19 14:07:19', '2024-01-19 14:07:19'),
(3, 'L', NULL, 1, NULL, '65aa821765062', 1, '2024-01-19 14:07:19', '2024-01-19 14:07:19'),
(4, 'XL', NULL, 1, NULL, '65aa8217713ce', 1, '2024-01-19 14:07:19', '2024-01-19 14:07:19'),
(5, 'XXL', NULL, 1, NULL, '65aa82178d8f4', 1, '2024-01-19 14:07:19', '2024-01-19 14:07:19');

-- --------------------------------------------------------

--
-- Table structure for table `social_settings`
--

CREATE TABLE `social_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sm_facebook` varchar(255) DEFAULT NULL,
  `sm_twitter` varchar(255) DEFAULT NULL,
  `sm_linkedin` varchar(255) DEFAULT NULL,
  `sm_youtube` varchar(255) DEFAULT NULL,
  `sm_pinterest` varchar(255) DEFAULT NULL,
  `sm_instagram` varchar(255) DEFAULT NULL,
  `sm_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_settings`
--

INSERT INTO `social_settings` (`id`, `sm_facebook`, `sm_twitter`, `sm_linkedin`, `sm_youtube`, `sm_pinterest`, `sm_instagram`, `sm_status`, `created_at`, `updated_at`) VALUES
(1, '', NULL, NULL, NULL, NULL, NULL, 1, '2024-01-19 14:07:01', '2024-01-19 14:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `static_banners`
--

CREATE TABLE `static_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sb_title` varchar(255) NOT NULL,
  `sb_sub_title` varchar(255) NOT NULL,
  `sb_button_url` varchar(255) DEFAULT NULL,
  `sb_bg_color` varchar(255) DEFAULT NULL,
  `sb_image` varchar(255) DEFAULT NULL,
  `sb_banner_type` varchar(255) NOT NULL COMMENT '1: Top Banner, 2: Footer Banner',
  `sb_slug` varchar(255) NOT NULL,
  `sb_status` int(11) NOT NULL DEFAULT 1 COMMENT '1: Active, 0: Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subscribe_email` varchar(255) NOT NULL,
  `subscribe_status` int(11) NOT NULL DEFAULT 1,
  `subscribe_ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_phone` varchar(255) NOT NULL,
  `supplier_email` varchar(255) DEFAULT NULL,
  `wireHouse_address` varchar(255) NOT NULL,
  `supplier_slug` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `supplier_phone`, `supplier_email`, `wireHouse_address`, `supplier_slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Prof. Enid Collier', '1-608-308-0805', 'emurray@example.com', '333 Dedric Center Suite 683\nAdrienville, HI 86889', '65aa82202c4aa', '1', '2024-01-19 14:07:28', '2024-01-19 14:07:28'),
(2, 'Amie Jaskolski', '458-697-8262', 'iparisian@example.org', '683 Guadalupe Isle\nWest Anderson, HI 62818', '65aa82202c62b', '1', '2024-01-19 14:07:28', '2024-01-19 14:07:28'),
(3, 'Alda Koch', '+1 (216) 475-2960', 'prince.kohler@example.com', '979 Ashlynn Orchard\nSouth Bryceport, KY 09764', '65aa82202c77b', '1', '2024-01-19 14:07:28', '2024-01-19 14:07:28'),
(4, 'Prof. Ressie Bashirian IV', '+1-424-888-1590', 'runolfsdottir.angelita@example.net', '66919 Larissa Divide Suite 069\nLake Gregville, WV 12475-0413', '65aa82202c8c8', '1', '2024-01-19 14:07:28', '2024-01-19 14:07:28'),
(5, 'Luisa White', '+18323933235', 'tremblay.josiah@example.com', '61549 Barrows Lodge Apt. 913\nAbshireland, MO 19853', '65aa82202ca07', '1', '2024-01-19 14:07:28', '2024-01-19 14:07:28');

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_name` varchar(255) NOT NULL,
  `support_email` varchar(255) NOT NULL,
  `support_phone` varchar(255) NOT NULL,
  `support_message` longtext NOT NULL,
  `support_slug` varchar(255) NOT NULL,
  `support_seen` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s_m_s_settings`
--

CREATE TABLE `s_m_s_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sms_api_key` varchar(255) DEFAULT NULL,
  `sms_sender_id` varchar(255) DEFAULT NULL,
  `sms_type` int(11) DEFAULT NULL COMMENT '1=Text, 2=Unicode',
  `sms_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s_m_s_settings`
--

INSERT INTO `s_m_s_settings` (`id`, `sms_api_key`, `sms_sender_id`, `sms_type`, `sms_status`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 1, 0, '2024-01-19 14:07:01', '2024-01-19 14:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tag_name` varchar(100) NOT NULL,
  `tag_creator` varchar(255) DEFAULT NULL,
  `tag_editor` varchar(255) DEFAULT NULL,
  `tag_slug` varchar(255) DEFAULT NULL,
  `tag_order` int(11) DEFAULT NULL,
  `tag_status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag_name`, `tag_creator`, `tag_editor`, `tag_slug`, `tag_order`, `tag_status`, `created_at`, `updated_at`) VALUES
(1, 'Nyah Herzog', NULL, NULL, 'nyah-herzog', NULL, '1', '2024-01-19 14:07:20', '2024-01-19 14:07:20'),
(2, 'Xander Treutel I', NULL, NULL, 'xander-treutel-i', NULL, '1', '2024-01-19 14:07:20', '2024-01-19 14:07:20'),
(3, 'Mrs. Helen Miller DDS', NULL, NULL, 'mrs-helen-miller-dds', NULL, '1', '2024-01-19 14:07:20', '2024-01-19 14:07:20'),
(4, 'Dr. Linnea Ward Sr.', NULL, NULL, 'dr-linnea-ward-sr', NULL, '1', '2024-01-19 14:07:20', '2024-01-19 14:07:20'),
(5, 'Wilma McClure', NULL, NULL, 'wilma-mcclure', NULL, '1', '2024-01-19 14:07:20', '2024-01-19 14:07:20'),
(6, 'Darrin Gibson DDS', NULL, NULL, 'darrin-gibson-dds', NULL, '1', '2024-01-19 14:07:20', '2024-01-19 14:07:20'),
(7, 'Baby Roberts Sr.', NULL, NULL, 'baby-roberts-sr', NULL, '1', '2024-01-19 14:07:20', '2024-01-19 14:07:20'),
(8, 'Marc Schmitt Sr.', NULL, NULL, 'marc-schmitt-sr', NULL, '1', '2024-01-19 14:07:21', '2024-01-19 14:07:21'),
(9, 'Dr. Dock Grimes II', NULL, NULL, 'dr-dock-grimes-ii', NULL, '1', '2024-01-19 14:07:21', '2024-01-19 14:07:21'),
(10, 'Bethel Rippin', NULL, NULL, 'bethel-rippin', NULL, '1', '2024-01-19 14:07:21', '2024-01-19 14:07:21');

-- --------------------------------------------------------

--
-- Table structure for table `theme_colors`
--

CREATE TABLE `theme_colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `theme_vision` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `post_code` int(11) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `editor` int(11) DEFAULT NULL,
  `online_status` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `email`, `phone`, `email_verified_at`, `password`, `address`, `city`, `post_code`, `country`, `image`, `slug`, `creator`, `editor`, `online_status`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', NULL, NULL, 'superadmin@mail.com', NULL, NULL, '$2a$12$yoaB807ULfe2CxjLcfrZ/uFIl45tiO3OX7VDkCruxWRMfwhQaJImK', NULL, NULL, NULL, NULL, NULL, '65aa8205ec6427.73303108', NULL, NULL, 0, 1, NULL, '2024-01-19 14:07:01', '2024-01-19 14:07:01'),
(2, 'Mrs. Rachael Reichel', NULL, NULL, 'staff@mail.com', NULL, NULL, '$2y$10$Fa53v9.DrFIq7K/71HfkOONQ/nJS.BVFcDBY/5JYib/oSYuiWwFyq', NULL, NULL, NULL, NULL, NULL, '65aa82159d1a88.33055163', NULL, NULL, 1, 1, NULL, '2024-01-19 14:07:17', '2024-01-19 14:07:17'),
(3, 'Titus Barrows', NULL, NULL, 'manager@mail.com', NULL, NULL, '$2y$10$0TaN5wsbwDJexHl8TEanMeQZo6GoVHjLU2y9AsisTZe2Igez1XYCu', NULL, NULL, NULL, NULL, NULL, '65aa82161818f8.03558066', NULL, NULL, 0, 1, NULL, '2024-01-19 14:07:18', '2024-01-19 14:07:18'),
(4, 'Dr. Jesus Crooks DVM', NULL, NULL, 'customer@mail.com', NULL, NULL, '$2y$10$9eb8dRPrHIGDpCpe5oE.IOV60KecWDXoNJDJZ2sARURqvS4JklFvS', NULL, NULL, NULL, NULL, NULL, '65aa82166dbb10.53099382', NULL, NULL, 0, 1, NULL, '2024-01-19 14:07:18', '2024-01-19 14:07:18');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `wishlist_date` varchar(255) DEFAULT NULL,
  `wishlist_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analytics`
--
ALTER TABLE `analytics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basic_settings`
--
ALTER TABLE `basic_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`bc_id`),
  ADD UNIQUE KEY `blog_categories_bc_name_unique` (`bc_name`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_brand_name_unique` (`brand_name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_pc_name_unique` (`pc_name`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cities_city_name_unique` (`city_name`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `colors_color_name_unique` (`color_name`);

--
-- Indexes for table `contact_infos`
--
ALTER TABLE `contact_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `couriers_courier_name_unique` (`courier_name`);

--
-- Indexes for table `courier_cities`
--
ALTER TABLE `courier_cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courier_zones`
--
ALTER TABLE `courier_zones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feature_categories`
--
ALTER TABLE `feature_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feature_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_product_id_foreign` (`product_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_bars`
--
ALTER TABLE `menu_bars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu_bars_menu_name_unique` (`menu_name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_courier_id_foreign` (`courier_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_order_status_foreign` (`order_status`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`),
  ADD KEY `order_details_product_color_foreign` (`product_color`),
  ADD KEY `order_details_product_size_foreign` (`product_size`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_page_url_unique` (`page_url`);

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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_category_product_id_category_id_unique` (`product_id`,`category_id`),
  ADD KEY `product_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_colors_product_id_color_id_unique` (`product_id`,`color_id`),
  ADD KEY `product_colors_color_id_foreign` (`color_id`);

--
-- Indexes for table `product_purchases`
--
ALTER TABLE `product_purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_purchases_user_id_foreign` (`user_id`),
  ADD KEY `product_purchases_product_id_foreign` (`product_id`),
  ADD KEY `product_purchases_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_size_product_id_size_id_unique` (`product_id`,`size_id`),
  ADD KEY `product_size_size_id_foreign` (`size_id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `returns_order_id_foreign` (`order_id`),
  ADD KEY `returns_courier_id_foreign` (`courier_id`),
  ADD KEY `returns_product_id_foreign` (`product_id`),
  ADD KEY `returns_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `service_ads`
--
ALTER TABLE `service_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shippings_order_id_foreign` (`order_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sizes_size_name_unique` (`size_name`);

--
-- Indexes for table `social_settings`
--
ALTER TABLE `social_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_banners`
--
ALTER TABLE `static_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscribers_subscribe_email_unique` (`subscribe_email`),
  ADD KEY `subscribers_user_id_foreign` (`user_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_supplier_phone_unique` (`supplier_phone`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_m_s_settings`
--
ALTER TABLE `s_m_s_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_tag_name_unique` (`tag_name`);

--
-- Indexes for table `theme_colors`
--
ALTER TABLE `theme_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analytics`
--
ALTER TABLE `analytics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `basic_settings`
--
ALTER TABLE `basic_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `bc_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_infos`
--
ALTER TABLE `contact_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courier_cities`
--
ALTER TABLE `courier_cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courier_zones`
--
ALTER TABLE `courier_zones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feature_categories`
--
ALTER TABLE `feature_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_bars`
--
ALTER TABLE `menu_bars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product_purchases`
--
ALTER TABLE `product_purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `service_ads`
--
ALTER TABLE `service_ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `social_settings`
--
ALTER TABLE `social_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `static_banners`
--
ALTER TABLE `static_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_m_s_settings`
--
ALTER TABLE `s_m_s_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `theme_colors`
--
ALTER TABLE `theme_colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feature_categories`
--
ALTER TABLE `feature_categories`
  ADD CONSTRAINT `feature_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_courier_id_foreign` FOREIGN KEY (`courier_id`) REFERENCES `couriers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_order_status_foreign` FOREIGN KEY (`order_status`) REFERENCES `order_statuses` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_color_foreign` FOREIGN KEY (`product_color`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_size_foreign` FOREIGN KEY (`product_size`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `product_category_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD CONSTRAINT `product_colors_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`),
  ADD CONSTRAINT `product_colors_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_purchases`
--
ALTER TABLE `product_purchases`
  ADD CONSTRAINT `product_purchases_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_purchases_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_purchases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product_size_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_size_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`);

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_courier_id_foreign` FOREIGN KEY (`courier_id`) REFERENCES `couriers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `returns_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `returns_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `returns_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `shippings_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD CONSTRAINT `subscribers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
