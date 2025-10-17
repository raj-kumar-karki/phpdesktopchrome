-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2025 at 02:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `churchsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `believer`
--

CREATE TABLE `believer` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `baptism_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `believer`
--

INSERT INTO `believer` (`id`, `name`, `dob`, `address`, `address2`, `contact`, `baptism_date`, `created_at`) VALUES
(2, 'Raj Kumar Karki', '2025-09-25', 'Jupitar Marga', 'talchhikhel', '9863777488', '2025-09-18', '2025-09-01 10:50:34');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `baptism_date` date NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `dob`, `address`, `contact`, `baptism_date`, `photo`, `created_at`) VALUES
(6, 'raj', '2025-09-24', 'tal', '9823564', '2025-09-26', '', '2025-09-01 15:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `monthly_service`
--

CREATE TABLE `monthly_service` (
  `id` int(11) NOT NULL,
  `date_label` varchar(10) DEFAULT NULL,
  `bible_study` text DEFAULT NULL,
  `prayer_leader` text DEFAULT NULL,
  `worship_leader` text DEFAULT NULL,
  `prayer_meeting` text DEFAULT NULL,
  `preaching_leader` text DEFAULT NULL,
  `preacher` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offerrecords`
--

CREATE TABLE `offerrecords` (
  `id` int(11) NOT NULL,
  `record_date` date NOT NULL,
  `particular` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offerrecords`
--

INSERT INTO `offerrecords` (`id`, `record_date`, `particular`, `amount`) VALUES
(2, '2082-08-03', 'मंसिर', 12125.00),
(3, '2082-05-19', 'श्रावण', 450000.00),
(5, '2082-05-18', 'भाद्र', 10000.00),
(9, '2082-05-18', 'कार्तिक', 2000.00),
(11, '2025-07-29', 'अश्विन', 7000.00),
(12, '2082-05-16', 'भाद्र', 30000.00),
(13, '2082-05-21', 'भाद्र', 1780.00);

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `record_date` text NOT NULL,
  `particular` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `record_date`, `particular`, `amount`) VALUES
(16, '2082-05-20', 'two months', 100.00),
(17, '2082-05-25', 'MOTOR', 1000.00),
(18, '2082-05-31', 'tools', 1000.00),
(19, '2082-05-30', 'dsl', 15000.00),
(20, '2082-05-16', '3 months rent ', 155000.01),
(21, '2082-05-21', 'pane', 80.00);

-- --------------------------------------------------------

--
-- Table structure for table `titherecords`
--

CREATE TABLE `titherecords` (
  `id` int(11) NOT NULL,
  `record_date` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `titherecords`
--

INSERT INTO `titherecords` (`id`, `record_date`, `name`, `amount`) VALUES
(1, '2025-07-23', 'ram bahadur rai', 50000.00),
(4, '2082-05-16', 'Ram', 15000.00),
(5, '2082-05-16', 'Ram', 15000.00),
(6, '2082-05-23', 'Shyam', 15000.00),
(7, '2082-05-21', 'krishna', 10000.00),
(9, '2082-05-28', 'Rupa', 5000.02);

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `password`, `user_type`) VALUES
(4, 'raj', '202cb962ac59075b964b07152d234b70', 'admin'),
(7, 'kiran', '202cb962ac59075b964b07152d234b70', 'admin'),
(8, 'krishna', '202cb962ac59075b964b07152d234b70', 'user'),
(9, 'Rupa', '202cb962ac59075b964b07152d234b70', 'user'),
(10, 'raju', '202cb962ac59075b964b07152d234b70', 'user'),
(11, 'जवजव', '202cb962ac59075b964b07152d234b70', 'user'),
(12, 'sudan', '202cb962ac59075b964b07152d234b70', 'user'),
(13, 'ram', '202cb962ac59075b964b07152d234b70', 'admin'),
(14, 'shyam', '202cb962ac59075b964b07152d234b70', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `believer`
--
ALTER TABLE `believer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_service`
--
ALTER TABLE `monthly_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offerrecords`
--
ALTER TABLE `offerrecords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `titherecords`
--
ALTER TABLE `titherecords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `believer`
--
ALTER TABLE `believer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `monthly_service`
--
ALTER TABLE `monthly_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `offerrecords`
--
ALTER TABLE `offerrecords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `titherecords`
--
ALTER TABLE `titherecords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
