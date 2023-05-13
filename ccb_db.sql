-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2023 at 02:11 PM
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
-- Database: `ccb_db`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `best_sellers`
-- (See below for the actual view)
--
CREATE TABLE `best_sellers` (
`item_id` int(255)
,`item_name` varchar(255)
,`item_imgdir` varchar(255)
,`order_ct` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `item_id` int(255) NOT NULL,
  `cart_qty` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `item_id`, `cart_qty`) VALUES
(8, 14, 9, 3),
(9, 14, 6, 1),
(10, 14, 10, 12),
(11, 5, 5, 1),
(12, 5, 10, 12),
(13, 5, 8, 2),
(14, 6, 1, 24),
(15, 6, 5, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `cart_section`
-- (See below for the actual view)
--
CREATE TABLE `cart_section` (
`order_id` varchar(10)
,`user_id` int(16)
,`item_id` int(255)
,`item_name` varchar(255)
,`item_imgdir` varchar(255)
,`item_price` decimal(11,2)
,`order_qty` int(255)
,`subtotal` decimal(65,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(255) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Cake'),
(2, 'Cake Roll'),
(3, 'Cupcake'),
(4, 'Pie');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `order_id` int(255) NOT NULL,
  `delivery_status` char(1) NOT NULL DEFAULT 'P' COMMENT 'P = Pending / D = Delivered'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discount_id` int(255) NOT NULL,
  `discount_name` varchar(255) NOT NULL,
  `discount_perc` decimal(2,2) NOT NULL,
  `start_eff_date` date NOT NULL,
  `end_eff_date` date NOT NULL,
  `discount_status` char(1) NOT NULL DEFAULT 'I' COMMENT 'A = Active / I = Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_id`, `discount_name`, `discount_perc`, `start_eff_date`, `end_eff_date`, `discount_status`) VALUES
(4, 'New Year\'s Sale 2023', '0.02', '2022-12-31', '2023-01-01', 'I'),
(5, 'Valentine\'s Sale 2023', '0.01', '2023-02-14', '2023-02-16', 'I'),
(6, 'Angelo\'s Birthday Sale 2023', '0.03', '2023-03-15', '2023-03-17', 'I'),
(7, 'Araw ng Kagitingan 2023', '0.02', '2023-04-10', '2023-04-12', 'I');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `discount_id` int(255) DEFAULT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` decimal(11,2) NOT NULL,
  `item_imgdir` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `item_status` char(1) NOT NULL DEFAULT 'A' COMMENT 'A = Active / I = Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `category_id`, `discount_id`, `item_name`, `item_price`, `item_imgdir`, `date_added`, `item_status`) VALUES
(1, 3, NULL, 'Chocolate Cupcakes', '15.00', 'products/Chocolate Cupcakes.jpg', '2023-03-24 23:17:22', 'A'),
(2, 4, NULL, 'Mocha Cream Pie', '480.00', 'products/Mocha Cream Pie.jpg', '2023-03-24 23:28:29', 'I'),
(3, 3, NULL, 'Unicorn Cupcakes', '18.00', 'products/Unicorn Cupcakes.jpg', '2023-03-24 23:28:29', 'A'),
(4, 1, NULL, 'Black Drip Cake', '540.00', 'products/Black Drip Cake.jpg', '2023-03-24 23:38:03', 'I'),
(5, 1, NULL, 'Red Velvet Cake', '480.00', 'products/Red Velvet Cake.jpg', '2023-03-24 23:38:03', 'A'),
(6, 2, NULL, 'Black Forest Cake Roll', '480.00', 'products/Black Forest Cake Roll.jpg', '2023-03-24 23:38:03', 'A'),
(7, 2, NULL, 'Strawberry Cake Roll', '480.00', 'products/Strawberry Cake Roll.jpg', '2023-03-26 17:05:52', 'A'),
(8, 4, NULL, 'Strawberry-Rhubarb Pie', '210.00', 'products/Strawberry-Rhubarb Pie.jpg', '2023-03-26 17:05:52', 'A'),
(9, 1, NULL, 'Mango Bravo Cake', '450.00', 'products/Mango Bravo Cake.jpg', '2023-03-26 17:05:52', 'A'),
(10, 3, NULL, 'Galaxy Cupcakes', '18.00', 'products/Galaxy Cupcakes.jpg', '2023-03-26 17:05:52', 'A'),
(11, 4, NULL, 'Mocha Cream Pie', '210.00', 'products/Mocha Cream Pie.jpg', '2023-03-26 17:05:52', 'I'),
(12, 4, NULL, 'Egg Pie', '150.00', 'products/Egg Pie.jpg', '2023-03-26 17:05:52', 'A'),
(13, 1, NULL, 'Chocolate Coffee Cake', '480.00', 'products/Chocolate Coffee Cake.jpg', '2023-03-31 18:12:23', 'A'),
(14, 3, NULL, 'Pink, White, & Gold Cupcake Set', '60.00', 'products/Pink, White, & Gold Cupcake Set.jpg', '2023-04-02 02:10:42', 'A'),
(15, 3, NULL, 'Red Velvet Cupcakes', '18.00', 'products/Red Velvet Cupcakes.jpg', '2023-04-02 14:37:13', 'A'),
(16, 1, NULL, 'LGBT Cake Roll', '520.00', 'products/LGBT Cake Roll.jpg', '2023-04-08 16:31:03', 'A'),
(17, 2, NULL, 'Vanilla Swiss Cake Roll', '450.00', 'products/Vanilla Swiss Cake Roll.jpg', '2023-04-08 16:33:49', 'A'),
(19, 1, NULL, 'Pink Drip Cake', '480.00', 'products/Pink Drip Cake.jpg', '2023-05-10 16:58:34', 'A'),
(20, 2, NULL, 'Happy Birthday Cake', '99.00', 'products/Happy Birthday Cake.jpg', '2023-05-10 18:52:09', 'A'),
(21, 3, NULL, 'Matcha Cupcakes', '18.00', 'products/Matcha Cupcakes.jpg', '2023-05-10 19:20:11', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(10) NOT NULL,
  `user_id` int(255) NOT NULL,
  `item_id` int(255) NOT NULL,
  `order_ref_num` varchar(16) NOT NULL,
  `order_qty` int(255) NOT NULL,
  `last_update` datetime NOT NULL DEFAULT current_timestamp(),
  `order_status` char(1) NOT NULL DEFAULT 'C' COMMENT 'C = Cart / P = Pending / D = Delivered / X = Cancelled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `item_id`, `order_ref_num`, `order_qty`, `last_update`, `order_status`) VALUES
('', 22, 12, '', 1, '2023-05-11 00:26:36', 'C'),
('1', 8, 6, '81D5S4C2A7C3H8J1', 2, '2023-05-08 15:29:47', 'X'),
('10', 9, 12, '79I3S0Z6C2L6H3D1', 4, '2023-02-15 17:28:10', 'D'),
('100', 19, 6, '29R1I9X4U1B2E6A6', 2, '2023-05-09 19:39:45', 'X'),
('101', 19, 16, '', 2, '2023-05-10 01:34:18', 'X'),
('102', 19, 10, '20Y6E3J8X4P0Y0S9', 36, '2023-05-09 19:48:17', 'X'),
('103', 19, 1, '20Y6E3J8X4P0Y0S9', 12, '2023-05-09 19:48:17', 'X'),
('104', 19, 1, '25N9A3L0V6N7M2Y7', 12, '2023-05-09 20:26:01', 'X'),
('105', 19, 5, '25N9A3L0V6N7M2Y7', 2, '2023-05-09 20:26:01', 'X'),
('106', 19, 17, '25N9A3L0V6N7M2Y7', 1, '2023-05-09 20:26:01', 'X'),
('107', 19, 4, '25N9A3L0V6N7M2Y7', 1, '2023-05-09 20:26:01', 'X'),
('108', 19, 4, '26O0Q4F6D1B8W6T0', 1, '2023-05-09 20:17:46', 'B'),
('109', 19, 17, '33V7S0X9S7R9S7N4', 1, '2023-05-10 10:37:10', 'D'),
('11', 5, 10, '', 60, '2023-05-07 07:57:37', 'X'),
('110', 19, 7, '33V7S0X9S7R9S7N4', 1, '2023-05-10 10:37:10', 'D'),
('111', 19, 15, '26O0Q4F6D1B8W6T0', 36, '2023-05-09 20:17:46', 'B'),
('112', 19, 12, '65M8R1K6B5K8X4N1', 1, '2023-05-09 20:24:14', 'D'),
('113', 19, 3, '92U0X0B3O3S7I8R6', 24, '2023-05-10 02:10:23', 'P'),
('114', 19, 6, '69R9Q0S8U2Z0I0J0', 1, '2023-05-10 10:34:12', 'X'),
('115', 19, 8, '65M8R1K6B5K8X4N1', 1, '2023-05-09 20:24:14', 'D'),
('116', 19, 17, '31M2F9B4U6A8X9K3', 1, '2023-05-10 02:11:16', 'P'),
('117', 20, 4, '99C6Q3Y9T1T0D1M3', 1, '2023-05-10 06:05:27', 'D'),
('118', 20, 4, '', 1, '2023-05-10 12:15:29', 'X'),
('119', 20, 15, '', 24, '2023-05-10 12:15:46', 'X'),
('12', 7, 2, '', 3, '2023-05-09 18:55:15', 'X'),
('120', 20, 15, '58O1R1N7R0D8R0W1', 12, '2023-05-10 06:17:15', 'X'),
('121', 19, 5, '69R9Q0S8U2Z0I0J0', 4, '2023-05-10 10:34:12', 'X'),
('122', 19, 12, '', 6, '2023-05-10 16:34:52', 'X'),
('123', 22, 13, '93O0Z6P0P0N0S7V5', 2, '2023-05-10 12:45:24', 'D'),
('124', 22, 7, '93O0Z6P0P0N0S7V5', 24, '2023-05-10 12:45:24', 'D'),
('125', 22, 3, '', 12, '2023-05-10 18:55:27', 'X'),
('126', 22, 20, '11D5N7O2O0U3P1M2', 1, '2023-05-10 18:55:34', 'P'),
('14', 11, 11, '', 5, '2023-05-09 18:55:15', 'X'),
('15', 7, 4, '', 3, '2023-05-07 07:52:52', 'X'),
('18', 10, 7, '', 3, '2023-05-09 18:55:15', 'X'),
('19', 9, 3, '02V7O5K0W6J3X2M9', 36, '2023-05-10 04:29:32', 'S'),
('2', 11, 7, '', 1, '2023-05-09 18:55:15', 'X'),
('20', 8, 5, '65K9L2C5S3M7L2Y9', 2, '2023-05-10 04:29:31', 'S'),
('21', 6, 13, '90L1V4U1R5J3K0T7', 4, '2023-05-08 12:18:11', 'B'),
('22', 14, 12, '', 2, '2023-05-07 07:51:31', 'X'),
('23', 14, 15, '83L7Y6H4W3B0S3D1', 19, '2023-05-01 17:28:19', 'D'),
('24', 5, 13, '69C7Y2O3H1Z6A0N7', 5, '2023-05-07 19:15:27', 'X'),
('25', 14, 13, '83L7Y6H4W3B0S3D1', 2, '2023-05-09 17:28:19', 'D'),
('26', 6, 15, '88P3Q2W3D0D9N6X9', 6, '2023-05-08 12:14:55', 'X'),
('27', 7, 7, '', 1, '2023-05-07 17:58:03', 'X'),
('28', 7, 14, '29U3K9N4G0V1T2V0', 12, '2023-05-08 12:14:33', 'X'),
('29', 5, 8, '01M7I2I3M2L1O0X4', 1, '2023-05-07 19:15:24', 'X'),
('3', 11, 9, '', 1, '2023-05-09 18:55:15', 'X'),
('30', 5, 6, '76U8B2W1H0V7Z1P1', 1, '2023-05-07 19:15:20', 'X'),
('31', 5, 9, '01M7I2I3M2L1O0X4', 1, '2023-05-07 19:15:24', 'X'),
('32', 5, 17, '37F1P5R1U5T0W3X0', 1, '2023-05-07 19:15:13', 'X'),
('33', 5, 1, '', 6, '2023-05-07 08:02:53', 'X'),
('34', 14, 5, '39Z1R5B7B0Y2W5X0', 1, '2023-05-07 19:15:47', 'X'),
('35', 7, 15, '29U3K9N4G0V1T2V0', 18, '2023-05-08 12:14:33', 'X'),
('36', 6, 9, '', 1, '2023-05-09 18:55:15', 'X'),
('37', 8, 10, '81D5S4C2A7C3H8J1', 12, '2023-05-08 15:29:47', 'X'),
('38', 7, 12, '', 1, '2023-05-07 07:52:32', 'X'),
('39', 7, 3, '', 6, '2023-05-07 17:57:09', 'X'),
('4', 6, 1, '', 30, '2023-05-09 18:55:15', 'X'),
('40', 15, 12, '50Y1Z0N7G6S8H6O4', 3, '2023-05-08 12:24:06', 'X'),
('41', 15, 5, '25I7D9N6Y8P9W9C7', 1, '2023-05-08 17:49:00', 'B'),
('42', 15, 10, '47X0J4M3E4U9E2X4', 5, '2023-05-09 20:21:37', 'D'),
('43', 15, 15, '47X0J4M3E4U9E2X4', 5, '2023-05-09 20:21:37', 'D'),
('44', 15, 16, '25I7D9N6Y8P9W9C7', 1, '2023-05-08 17:49:00', 'B'),
('45', 15, 17, '25I7D9N6Y8P9W9C7', 1, '2023-05-08 17:49:00', 'B'),
('46', 7, 15, '74L9X1R3F0J9N7V8', 6, '2023-05-07 19:14:18', 'X'),
('47', 7, 1, '', 12, '2023-05-07 18:10:52', 'X'),
('48', 7, 11, '', 2, '2023-05-07 18:20:46', 'X'),
('49', 16, 12, '63P7Y0P6P2B6A2M1', 3, '2023-05-07 19:47:05', 'X'),
('5', 5, 5, '40Z0X0H8T1U9K6D9', 3, '2023-05-08 15:29:55', 'X'),
('50', 16, 10, '63P7Y0P6P2B6A2M1', 6, '2023-05-07 19:47:05', 'X'),
('51', 16, 15, '63P7Y0P6P2B6A2M1', 6, '2023-05-07 19:47:05', 'X'),
('52', 16, 1, '63P7Y0P6P2B6A2M1', 12, '2023-05-07 19:47:05', 'X'),
('53', 16, 5, '63P7Y0P6P2B6A2M1', 1, '2023-05-07 19:47:05', 'X'),
('54', 16, 4, '63P7Y0P6P2B6A2M1', 1, '2023-05-07 19:47:05', 'X'),
('55', 16, 12, '', 6, '2023-05-07 19:47:44', 'X'),
('56', 16, 12, '30J3C9M5F1W2F7E2', 2, '2023-05-08 12:24:02', 'X'),
('57', 16, 13, '76R7D0W0H2W9Z0N9', 1, '2023-05-08 12:15:04', 'X'),
('58', 16, 15, '76R7D0W0H2W9Z0N9', 30, '2023-05-08 12:15:04', 'X'),
('59', 16, 4, '90G0B3U0C6X6R5X6', 1, '2023-05-08 15:30:14', 'X'),
('6', 10, 12, '', 4, '2023-05-09 18:55:15', 'X'),
('60', 7, 5, '07J2Q7V8T0J6Q4I8', 3, '2023-05-08 15:50:39', 'B'),
('61', 7, 7, '19T9K0K6J6X0I9S1', 2, '2023-05-08 15:45:34', 'X'),
('62', 7, 15, '07J2Q7V8T0J6Q4I8', 60, '2023-05-08 15:50:39', 'B'),
('63', 14, 3, '21U9E3Q8V8I9V0C0', 48, '2023-05-09 20:20:43', 'D'),
('64', 14, 11, '21U9E3Q8V8I9V0C0', 1, '2023-05-09 20:20:43', 'D'),
('65', 14, 9, '', 2, '2023-05-09 18:55:15', 'X'),
('66', 9, 5, '74P0P3W2P6N0D7N1', 3, '2023-05-08 16:14:16', 'B'),
('67', 9, 8, '58Y9W5M1O2I1J5I8', 4, '2023-05-10 04:29:13', 'D'),
('68', 15, 1, '36Z8L8D0F0F6X0W4', 36, '2023-05-08 16:14:42', 'X'),
('69', 15, 3, '36Z8L8D0F0F6X0W4', 24, '2023-05-08 16:14:42', 'X'),
('7', 9, 8, '', 10, '2023-05-08 16:06:18', 'X'),
('70', 15, 17, '', 2, '2023-05-08 16:21:53', 'X'),
('71', 15, 11, '82Y3N3G6T1Y0J6C2', 2, '2023-05-08 16:14:57', 'X'),
('72', 15, 12, '', 3, '2023-05-09 18:55:15', 'X'),
('73', 15, 14, '', 30, '2023-05-09 18:55:15', 'X'),
('74', 16, 10, '81V6F7U5P1P5K7X8', 24, '2023-05-08 16:26:47', 'X'),
('75', 16, 6, '81V6F7U5P1P5K7X8', 2, '2023-05-08 16:26:47', 'X'),
('76', 16, 16, '32A3U3G2G9X0F4C1', 2, '2023-05-09 20:19:40', 'D'),
('77', 16, 1, '87U8O6Q0P5S9P8E0', 12, '2023-05-09 16:07:09', 'D'),
('78', 16, 3, '59F3C7D6Y6K1O6O6', 40, '2023-05-08 17:42:36', 'X'),
('79', 16, 15, '20S2F9G1Y9Z1I8U7', 30, '2023-05-08 18:37:11', 'B'),
('8', 7, 10, '48L1K4F5T7P0U4X1', 12, '2023-05-09 16:35:28', 'B'),
('80', 16, 5, '20S2F9G1Y9Z1I8U7', 2, '2023-05-08 18:37:11', 'B'),
('81', 16, 13, '', 3, '2023-05-09 18:55:15', 'X'),
('82', 16, 15, '40V4P8P4U4Q2M6J9', 48, '2023-05-09 17:27:44', 'P'),
('83', 16, 6, '40V4P8P4U4Q2M6J9', 1, '2023-05-09 17:27:44', 'P'),
('84', 16, 10, '40V4P8P4U4Q2M6J9', 36, '2023-05-09 17:27:44', 'P'),
('85', 17, 16, '90B6M6U7K6X3H9V5', 2, '2023-05-08 21:47:22', 'X'),
('86', 17, 15, '90B6M6U7K6X3H9V5', 120, '2023-05-08 21:47:22', 'X'),
('87', 17, 12, '90B6M6U7K6X3H9V5', 6, '2023-05-08 21:47:22', 'X'),
('88', 17, 1, '30Z0N9X3S6H1G3Q5', 12, '2023-05-09 17:27:34', 'B'),
('89', 17, 16, '30Z0N9X3S6H1G3Q5', 2, '2023-05-09 17:27:34', 'B'),
('9', 7, 1, '48L1K4F5T7P0U4X1', 12, '2023-05-09 16:35:28', 'B'),
('90', 17, 15, '', 120, '2023-05-09 18:55:15', 'X'),
('91', 17, 12, '30Z0N9X3S6H1G3Q5', 6, '2023-05-09 17:27:34', 'B'),
('92', 17, 4, '', 3, '2023-05-09 18:55:15', 'X'),
('93', 19, 13, '39Y8J1P2Y0D3X8K0', 2, '2023-05-10 03:02:10', 'D'),
('94', 19, 1, '39Y8J1P2Y0D3X8K0', 36, '2023-05-10 03:02:10', 'D'),
('95', 19, 8, '', 1, '2023-05-09 02:33:22', 'X'),
('96', 19, 3, '', 12, '2023-05-09 18:55:15', 'X'),
('97', 19, 13, '', 2, '2023-05-09 18:55:15', 'X'),
('98', 19, 6, '', 2, '2023-05-09 18:55:15', 'X'),
('99', 19, 10, '', 48, '2023-05-09 18:55:15', 'X');

-- --------------------------------------------------------

--
-- Stand-in structure for view `pending_orders`
-- (See below for the actual view)
--
CREATE TABLE `pending_orders` (
`order_id` varchar(10)
,`order_ref_num` varchar(16)
,`user_id` int(16)
,`item_id` int(255)
,`item_name` varchar(255)
,`item_imgdir` varchar(255)
,`item_price` decimal(11,2)
,`order_qty` int(255)
,`subtotal` decimal(65,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `price_id` int(255) NOT NULL,
  `price_value` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`price_id`, `price_value`) VALUES
(1, '420.00'),
(2, '480.00'),
(3, '540.00');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `size_id` int(16) NOT NULL,
  `size_name` varchar(64) NOT NULL,
  `size_descr` varchar(64) NOT NULL,
  `size_value` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`size_id`, `size_name`, `size_descr`, `size_value`) VALUES
(1, 'Round-Small', '6-inch, serves 4-6 people', '1.00'),
(2, 'Round-Medium', '8-inch, serves 8-10 people', '1.20'),
(3, 'Round-Large', '10-inch, serves 20-24 people', '1.40'),
(4, 'Rectangle-Small', '7\" x 11\", serves 12-15 people', '1.30'),
(5, 'Rectangle-Medium', '9\" x 13\", serves 20-24 people', '1.60'),
(6, 'Rectangle-Large', '11\" x 15\", serves 35-40 people', '1.90');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(16) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_fullname` varchar(255) NOT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_contactno` varchar(11) DEFAULT NULL,
  `user_emailadd` varchar(255) NOT NULL,
  `user_pwdhash` varchar(255) NOT NULL,
  `user_type` char(1) NOT NULL DEFAULT 'C' COMMENT 'C = Customer / A = Admin / D = Delivery',
  `user_status` char(1) NOT NULL DEFAULT 'A' COMMENT 'A = Active / I = Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_fullname`, `user_address`, `user_contactno`, `user_emailadd`, `user_pwdhash`, `user_type`, `user_status`) VALUES
(1, 'leterelle', 'Edmarielle Bernaldez', 'Morera, Guinobatan', '09748234884', 'edmariellenocedal.bernaldez@bicol-u.edu.ph', '$argon2id$v=19$m=65536,t=4,p=1$ZTZ6clJOLk1LMnEzdlZiNg$xw1d52t87mvYiBCI+OfWJpNkuwybOmyz3/LaN391r0M', 'A', 'A'),
(2, 'basketball_nette', 'Anjanette Bercilla', 'Nabonton, Ligao City', '09369934892', 'anjanettetugade.bercilla@bicol-u.edu.ph', '$argon2id$v=19$m=65536,t=4,p=1$SUZyTTU0c1lMenJYYVM3Sg$qviQJ+9tXYNIuDjW5uizJutXF+5/9a7dYFU/5FcS+I8', 'A', 'A'),
(3, 'kim.paulboron', 'Kim Paul Ondes', 'Iraya Norte, Oas', '09453272884', 'kimpaulmaquiniana.ondes@bicol-u.edu.ph', '$argon2id$v=19$m=65536,t=4,p=1$NzJUWi5jNWtXbkk1YUUuNg$DG+8mbNFZ33Ne7ZgK2dePH78m6bupLIAblVYB80PkEY', 'D', 'A'),
(4, 'triple_j', 'Jasper John Javier', 'Tuburan, Ligao City', '09584492319', 'jasperjohnpolidario.javier@bicol-u.edu.ph', '$argon2id$v=19$m=65536,t=4,p=1$VXE0MmpnSEw3ZFB0MlUyeQ$tx3CqWjFyd1HWJWqCg2dyOTm2hIxf5rxcPCFrwgQHr4', 'D', 'I'),
(5, 'shawk.74', 'Janette Shaw', 'Poblacion, Guinobatan', '09564748184', 'shawk.74@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$WWhJT2E0dUxrWnBnd1NEUg$nitXh0zWfflebGgDoze7Z3M/I5JkPvjnYLjWYvkSdw8', 'C', 'I'),
(6, 'sphere_55', 'Lance Lyons', 'Binatagan, Ligao City', '09587982713', 'sphere_55@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$dVlIeFBFaGZaS0kzbVF5WQ$/OTl+tk9uNoliUCD/NVEF29g6dLtmUB/FczTRIaXWOY', 'C', 'I'),
(7, 'phoebe1607', 'Phoebe Gould', 'Ilaor Sur, Oas', '09432381392', 'phoebe1607@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$RFh4T1pJZkJONjBGL1dHZA$nLAmE2hRsLHcb4Z9XWGfdYkXr70Dgr1fAFCEaGQikg8', 'C', 'A'),
(8, '__malcolm__', 'Dominic Avila', NULL, NULL, 'domino_fourone@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$aTBLcjh6WGVFVEZhWklKNA$oDCjiylxYZr2xvKGhHma8No/zavDvW20D3/fOsj5fGs', 'C', 'A'),
(9, 'it', 'Taya Padilla', NULL, NULL, 'padillata47@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$Z1hDRHp4MElkRExza0FVQg$jC4yF7dFJI2vY/2SeYgTTQMlInShTUStps95ZKFJwg8', 'C', 'A'),
(10, 'salazar.allen', 'Allen Salazar', NULL, NULL, 'salazar.allen@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$T1ZPMFVoWlNtRUhnQy44RA$Y4jMRI9FTpboI5tuhWUzBcwzx2pJMWd/lh6J+H2P+eQ', 'C', 'A'),
(11, 'maggie_protecc', 'Margaret Shields', NULL, NULL, 'maggie_protecc@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$d1VvSUxYcFlzYzlubWhYTw$pehvRr7zt34VjS7jUm4qYqnrFvKUxX05x1A0YCNyUI4', 'C', 'A'),
(12, 'd.juarez', 'Douglas Juarez', NULL, NULL, 'd.juarez@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$MlBVbU9lQVpJQkJ3ZjZxNg$j4CSgiOshtMFiSehovRUvzmTdfzdsK98+tGdsuDw6oM', 'C', 'A'),
(13, 'tarnaz_r', 'Reah Tarnaz', NULL, NULL, 'tarnaz_r@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$MXNCdDZ2TnZkd0t1RDZDNg$1RcY1xTZBPuDntoKTLSby6k5IfDKCnVD+m3hCam3I64', 'C', 'A'),
(14, 'its-a-me.mario', 'Mario Mccarthy', NULL, NULL, 'mario.mccarthy@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$bWxacC9VdTVZZ2R3Mjd0Lg$lVuEQMU3m2jkDsJ+ripMUXQZr+YdoTFegZ7wuC0ZZYA', 'C', 'A'),
(15, 'london.scotchtape', 'Lyndon Scott', NULL, NULL, 'scottlyndon1912@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$eHRWQ2IvRHNUYjFvY3RsZA$0bmjk0qFwiWAxbUqi2FNZAhOwFz59rZtWmxUaR08kkA', 'C', 'A'),
(16, 'Muzan', 'Michael Jackson', NULL, NULL, 'michelleJ@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$ODF6UU02VGxoY1F2M010VQ$ERe+I7g0mvjYhvO3twcsqw0mt5nczmuYgpbHWWXgXLQ', 'C', 'A'),
(17, 'rolan', 'Rolando Valdez', NULL, NULL, 'rolan_valdez@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$TS8xa0ZxYnNRYndrVk03eA$hHUJiD29DdbYBRSs60PLlXinfCBi6BFSTgiEsC4CkH0', 'C', 'A'),
(19, 'yhelle', 'Mayhelle Nocedal', NULL, NULL, 'mayhelle.nocedal@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$YmlGUzVOenRhdHNPellnWQ$Qr+kwTRwb8ZWUdfJQ0SDn43RpgzPGOdT0s7p621Rj7s', 'C', 'A'),
(20, 'username', 'FirstName LastName', NULL, NULL, 'fname.lname@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$R0dnQ25HVzFkdXhKTTVhRA$oAcMep+IaTNt8fYuSJn/suwC3ou5Xg05D42P+X5Au8M', 'C', 'A'),
(21, 'flabulous', 'Flabio Rodriguez', 'Poblacion, Guinobatan, Albay', '09234576896', 'flabby.rodriguez@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$aXJ2ZDNjTlo5RS80TVdieg$VOMncAGo9IfOCwZ/d4/zuIBCyscKOG4WaQCvPwDXrxI', 'C', 'A'),
(22, 'cardo', 'Ricardo Dalisay', 'probinsya', '09234756854', 'cardo.dalisay@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$Uld3MVR2WEpyMjN2aHRINg$TpWsbPSN4zO86bJbhfuw+1lbL9z3Qgr54V4Bp16+wZw', 'C', 'A');

-- --------------------------------------------------------

--
-- Structure for view `best_sellers`
--
DROP TABLE IF EXISTS `best_sellers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `best_sellers`  AS SELECT `i`.`item_id` AS `item_id`, `i`.`item_name` AS `item_name`, `i`.`item_imgdir` AS `item_imgdir`, count(`o`.`order_id`) AS `order_ct` FROM (`orders` `o` join `items` `i` on(`i`.`item_id` = `o`.`item_id`)) WHERE `o`.`order_status` = 'D' GROUP BY `i`.`item_id`, `i`.`item_name`, `i`.`item_imgdir` ORDER BY count(`o`.`order_id`) AS `DESCdesc` ASC  ;

-- --------------------------------------------------------

--
-- Structure for view `cart_section`
--
DROP TABLE IF EXISTS `cart_section`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cart_section`  AS SELECT `o`.`order_id` AS `order_id`, `u`.`user_id` AS `user_id`, `i`.`item_id` AS `item_id`, `i`.`item_name` AS `item_name`, `i`.`item_imgdir` AS `item_imgdir`, `i`.`item_price` AS `item_price`, `o`.`order_qty` AS `order_qty`, `i`.`item_price`* `o`.`order_qty` AS `subtotal` FROM ((`orders` `o` join `users` `u` on(`o`.`user_id` = `u`.`user_id`)) join `items` `i` on(`o`.`item_id` = `i`.`item_id`)) WHERE `i`.`item_status` <> 'I' AND `o`.`order_status` = 'C' ORDER BY `o`.`order_id` ASC  ;

-- --------------------------------------------------------

--
-- Structure for view `pending_orders`
--
DROP TABLE IF EXISTS `pending_orders`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pending_orders`  AS SELECT `o`.`order_id` AS `order_id`, `o`.`order_ref_num` AS `order_ref_num`, `u`.`user_id` AS `user_id`, `i`.`item_id` AS `item_id`, `i`.`item_name` AS `item_name`, `i`.`item_imgdir` AS `item_imgdir`, `i`.`item_price` AS `item_price`, `o`.`order_qty` AS `order_qty`, `i`.`item_price`* `o`.`order_qty` AS `subtotal` FROM ((`orders` `o` join `users` `u` on(`o`.`user_id` = `u`.`user_id`)) join `items` `i` on(`o`.`item_id` = `i`.`item_id`)) WHERE `i`.`item_status` <> 'I' AND `o`.`order_status` = 'P' ORDER BY `o`.`order_id` ASC  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `discount_id` (`discount_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `orders_ibfk_2` (`item_id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `price_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `size_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`discount_id`) REFERENCES `discount` (`discount_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `items_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
