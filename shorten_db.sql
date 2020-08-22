-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 22, 2020 at 01:14 PM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.3.21-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shorten_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `shorturls`
--

CREATE TABLE `shorturls` (
  `id` int(10) NOT NULL,
  `longurl` varchar(100) NOT NULL,
  `shorturl` varbinary(100) NOT NULL,
  `date` datetime NOT NULL,
  `counter` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shorturls`
--

INSERT INTO `shorturls` (`id`, `longurl`, `shorturl`, `date`, `counter`, `created_at`, `updated_at`) VALUES
(1, 'https://www.facebook.com/', 0x323834326331, '2020-07-27 16:10:32', 6, '2020-07-27 10:40:32', '2020-07-27 11:42:05'),
(2, 'https://www.itsolutionstuff.com/post/how-to-create-url-shortener-using-laravelexample.html', 0x383637393239, '2020-07-27 17:30:58', 1, '2020-07-27 12:00:58', '2020-07-27 12:00:58'),
(3, 'https://stackoverflow.com/', 0x643236393463, '2020-07-28 08:13:10', 5, '2020-07-28 02:43:10', '2020-07-31 15:35:57'),
(4, 'https://laravel.com/docs/7.x/queries#aggregates', 0x353364306562, '2020-07-28 11:37:51', 1, '2020-07-28 06:07:51', '2020-07-28 06:07:51');

-- --------------------------------------------------------

--
-- Table structure for table `visitregisters`
--

CREATE TABLE `visitregisters` (
  `id` int(10) NOT NULL,
  `url_id` int(10) NOT NULL,
  `date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitregisters`
--

INSERT INTO `visitregisters` (`id`, `url_id`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-07-27 17:11:01', '2020-07-27 17:11:01', '2020-07-27 17:11:01'),
(2, 1, '2020-07-27 17:29:38', '2020-07-27 17:29:38', '2020-07-27 17:29:38'),
(3, 1, '2020-07-27 17:30:35', '2020-07-27 17:30:35', '2020-07-27 17:30:35'),
(4, 2, '2020-07-27 17:31:45', '2020-07-27 17:31:45', '2020-07-27 17:31:45'),
(5, 2, '2020-07-27 17:33:20', '2020-07-27 17:33:20', '2020-07-27 17:33:20'),
(6, 3, '2020-07-28 09:05:15', '2020-07-28 09:05:15', '2020-07-28 09:05:15'),
(7, 3, '2020-07-28 09:06:21', '2020-07-28 09:06:21', '2020-07-28 09:06:21'),
(8, 4, '2020-07-28 11:37:53', '2020-07-28 11:37:53', '2020-07-28 11:37:53'),
(9, 3, '2020-07-28 16:49:48', '2020-07-28 16:49:48', '2020-07-28 16:49:48'),
(10, 3, '2020-07-31 21:06:18', '2020-07-31 21:06:18', '2020-07-31 21:06:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shorturls`
--
ALTER TABLE `shorturls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitregisters`
--
ALTER TABLE `visitregisters`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shorturls`
--
ALTER TABLE `shorturls`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `visitregisters`
--
ALTER TABLE `visitregisters`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
