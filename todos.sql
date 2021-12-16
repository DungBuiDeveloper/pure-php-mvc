-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Dec 16, 2021 at 02:51 PM
-- Server version: 5.7.35
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nals_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `start_task` timestamp NULL DEFAULT NULL,
  `end_task` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=Planning ,2=Doing,3=Complete',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `name`, `start_task`, `end_task`, `status`, `created_at`, `updated_at`) VALUES
(5, 'eee', '2021-12-14 07:30:00', '2021-12-14 08:00:00', 1, '2021-12-16 01:29:59', '2021-12-16 01:29:59'),
(6, 'aa', '2021-12-28 00:00:00', '2021-12-29 00:00:00', 2, '2021-12-16 01:30:21', '2021-12-16 01:30:21'),
(7, 'aaa', '2021-12-23 00:00:00', '2021-12-24 00:00:00', 1, '2021-12-16 01:31:00', '2021-12-16 01:31:00'),
(11, 'aaaa', '2021-12-31 00:00:00', '2022-01-01 00:00:00', 1, '2021-12-16 01:34:41', '2021-12-16 01:34:41'),
(12, 'asdasd', '2022-01-06 00:00:00', '2022-01-07 00:00:00', 3, '2021-12-16 01:35:34', '2021-12-16 01:35:34'),
(13, 'asdasd', '2022-01-07 00:00:00', '2022-01-08 00:00:00', 1, '2021-12-16 01:35:56', '2021-12-16 01:35:56'),
(14, 'aasd', '2022-01-08 00:00:00', '2022-01-09 00:00:00', 1, '2021-12-16 01:36:17', '2021-12-16 01:36:17'),
(15, 'asdasd', '2022-01-04 00:00:00', '2022-01-05 00:00:00', 1, '2021-12-16 01:36:43', '2021-12-16 01:36:43'),
(16, 'asdas', '2021-12-20 00:00:00', '2021-12-21 00:00:00', 1, '2021-12-16 01:36:50', '2021-12-16 01:36:50'),
(17, 'aaa', '2021-12-30 00:00:00', '2021-12-31 00:00:00', 1, '2021-12-16 01:37:31', '2021-12-16 01:37:31'),
(19, 'aaaabbbyyy1111', NULL, NULL, 1, '2021-12-16 01:38:14', '2021-12-16 01:38:14'),
(20, 'as', '2021-12-13 00:00:00', '2021-12-14 00:00:00', 1, '2021-12-16 01:38:26', '2021-12-16 01:38:26'),
(22, 'asdas', '2021-12-07 00:00:00', '2021-12-08 00:00:00', 1, '2021-12-16 01:46:46', '2021-12-16 01:46:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
