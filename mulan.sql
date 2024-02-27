-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2024 at 09:52 PM
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
-- Database: `mulan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `member_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `member_id`, `password`, `created_at`) VALUES
(1, 'admin101', '23345', '827ccb0eea8a706c4c34a16891f84e7b', '2024-02-22 13:06:44');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(11) NOT NULL,
  `member_id` varchar(55) NOT NULL,
  `amount_paid` bigint(55) NOT NULL,
  `reference` varchar(55) NOT NULL,
  `status` varchar(55) NOT NULL,
  `message` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_history`
--

INSERT INTO `payment_history` (`id`, `member_id`, `amount_paid`, `reference`, `status`, `message`, `created_at`) VALUES
(1, 'MULANCON20242832', 10000, '', '1', 'Verification successful', '2024-02-22 20:31:24'),
(2, 'MULANCON20245276', 12000, '', '1', 'Verification successful', '2024-02-22 20:34:52'),
(3, 'MULANCON2024612', 10000, '', '1', 'Verification successful', '2024-02-23 14:47:11'),
(4, 'MULANCON20245855', 15000, '', '1', 'Verification successful', '2024-02-23 15:23:46'),
(5, 'MULANCON20249770', 15000, '', '1', 'Verification successful', '2024-02-23 15:45:38'),
(6, 'MULANCON20241443', 20000, '', '1', 'Verification successful', '2024-02-23 15:58:16'),
(7, 'MULANCON20247216', 10000, '', '1', 'Verification successful', '2024-02-25 19:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `reg_category`
--

CREATE TABLE `reg_category` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `color_code` varchar(11) NOT NULL,
  `amount_topay` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reg_category`
--

INSERT INTO `reg_category` (`id`, `category_id`, `category_name`, `status`, `color_code`, `amount_topay`, `created_at`) VALUES
(1, 22324, 'Year 1-7', 1, 'red', 10000, '2024-02-22 14:29:38'),
(2, 46465, 'Year 8-14', 1, 'yellow', 15000, '2024-02-22 14:29:38'),
(3, 26637, 'Year 15 & Above', 1, 'brown', 25000, '2024-02-22 14:29:38'),
(4, 83382, 'SAN & Political Office Holders', 1, 'navy', 50000, '2024-02-22 14:29:38'),
(5, 19324, 'Magistrates', 1, 'blue', 10000, '2024-02-22 14:30:16'),
(6, 48270, 'Registration For State Branch', 1, 'black', 50000, '2024-02-22 14:30:16'),
(7, 19036, 'Judges/Justices', 1, 'lime', 10000, '2024-02-25 19:58:29'),
(8, 10927, 'Non Lawyers', 1, 'indigo', 50000, '2024-02-25 19:58:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `member_reg_no` varchar(55) DEFAULT NULL,
  `othername` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL,
  `phone` bigint(12) NOT NULL,
  `membership_number` varchar(55) NOT NULL,
  `s_court_no` varchar(55) NOT NULL,
  `year_of_call` bigint(55) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `member_reg_no`, `othername`, `lastname`, `email`, `phone`, `membership_number`, `s_court_no`, `year_of_call`, `category`, `branch`, `created_at`) VALUES
(1, NULL, 'dvd', 'fdefdf', 'efd@se.com', 235454, '0', '0', 2024, 'Individual Member - Judge | Justice', 'Bauchi', '2024-02-22 08:30:57'),
(2, NULL, 'gfrhtfht', 'sfdegrhtf', 'sdr@de.com', 23465765, '0', '0', 2345, 'Individual Member - SAN, Political Office Holder, MD/CEO', 'Benue', '2024-02-22 08:33:09'),
(3, NULL, 'frgfrgr', 'fvff', 'rrfvf@der.com', 346878, 'svbfdf465', 'dfbth35454', 2323, 'Individual Member - SAN, Political Office Holder, MD/CEO', 'Borno', '2024-02-22 08:34:20'),
(4, NULL, 'egedged', 'wfede', 'edgre@dfer.com', 1243455, 'dfftthtg354t4', 'fdgt546556', 0, 'Individual Member - Judge | Justice', 'Benue', '2024-02-22 08:35:40'),
(5, 'MULANCON20241822', 'gththt', 'erfhftr', 'dth@de.com', 35887, 'ergtrh', 'dffrd', 2657, 'Individual Member - SAN, Political Office Holder, MD/CEO', 'Cross River', '2024-02-22 14:17:48'),
(6, 'MULANCON20247994', 'grbfrfr', 'dvdgtrfhtf', 'rger3r@de.com', 255676765, 'dfrf543', 'et434', 3455, '46465', 'Delta', '2024-02-22 14:39:06'),
(7, 'MULANCON20242832', 'Nihma', 'Abdulhammed', 'nihma@gmail.com', 9098775645, '89839DE', 'GT242589', 2019, '48270', 'Lagos', '2024-02-22 20:03:46'),
(8, 'MULANCON20245276', 'Hawawu', 'Moruf', 'morufhawawu@gmail.com', 8154220098, 'FR5688', '8789789GT', 5643, '46465', 'Oyo', '2024-02-22 20:34:31'),
(9, 'MULANCON2024612', 'hshsh', 'Absu', 'hab@gmail.com', 989, '98988', '625262', 2022, '22324', 'Ekiti', '2024-02-23 14:46:47'),
(10, 'MULANCON20245855', 'iohih', 'hihio', 'iojoij@gugu.com', 98989, '979', '98998', 3875, '26637', 'Bauchi', '2024-02-23 15:23:34'),
(11, 'MULANCON20249770', 'Akinwale', 'Akinlabi', 'lawpointchambers@gmail.com', 8188882315, '123456', '2222', 2009, '26637', 'Ebonyi', '2024-02-23 15:44:21'),
(12, 'MULANCON20241443', 'Akinlabi', 'Abdulkabeer', 'habeebkabeer@gmail.com', 816564412, '56262526', '233', 2012, '83382', 'Enugu', '2024-02-23 15:58:02'),
(13, 'MULANCON20247216', 'Balkiss', 'Amao', 'balkissamoo@gmail.com', 9098785647, '343DER', '99898089', 2324, '22324', 'Lagos', '2024-02-25 19:42:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg_category`
--
ALTER TABLE `reg_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reg_category`
--
ALTER TABLE `reg_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
