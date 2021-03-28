-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2021 at 09:05 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `datetime` text NOT NULL,
  `location` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `name`, `datetime`, `location`, `status`) VALUES
(7, 'Shaolin 2021', 'March 11 2021 05:03', 'Tarlac City', 'Show'),
(10, 'Lantern Parade ', 'June 10 2021 07:30', 'Zamboanga', 'Show'),
(11, 'Film Review #4', 'August 05 2021 06:30', 'Baguio City', 'Hide'),
(12, 'Oscar 2021', 'March 24 2021 06:30', 'Dagupan City', 'Show');

-- --------------------------------------------------------

--
-- Table structure for table `eventguest`
--

CREATE TABLE `eventguest` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `guest_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eventguest`
--

INSERT INTO `eventguest` (`id`, `event_id`, `guest_id`) VALUES
(29, 7, 1),
(30, 10, 1),
(31, 7, 26),
(32, 12, 26),
(33, 7, 34),
(34, 10, 34),
(35, 10, 38),
(36, 12, 38);

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `events` text DEFAULT NULL,
  `gender` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0:deleted,1:active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`id`, `first_name`, `last_name`, `email`, `address`, `phone`, `events`, `gender`, `status`) VALUES
(1, 'John', 'Yao', 'john@gmail.com', 'paras street', 2147483647, '1,2,3', 'Male', 1),
(3, 'Lucky', 'Yao', 'denise@gmail.com', 'baguio city', 9567472, '1,2,3', 'Female', 1),
(26, 'james', 'gordon', 'james@yahoo.com', 'benguet', 954612, '2,4,5', 'Male', 1),
(27, 'kenneth', 'de guzman', 'kendg@yahoo.com', 'isabela', 78954621, '1,3,4', 'Male', 1),
(28, 'Lauren', 'Legazpi', 'lauLegazpi@hotmail.com', 'manila', 88845136, '2', 'Male', 1),
(29, 'kim', 'bauzon', 'bauzon@yahoo.com', 'malued', 7884615, '3,4,5', 'Female', 1),
(30, 'adrian', 'dela pena', 'adrian20@gmail.com', 'davao', 556415, '2', 'Male', 1),
(31, 'ryan', 'paras', 'parasryan@hotmail.com', 'palawan', 554621, '5', 'Male', 1),
(32, 'christine', 'paragas', 'paragasch@yahoo.com', 'cebu', 55684216, '3', 'Female', 1),
(33, 'maria', 'florante', 'maria@gmail.com', 'bataan', 4575212, '3,5', 'Female', 1),
(34, 'ali', 'bartolome', 'ali@gmail.com', 'cavite', 546654, '1', 'Male', 1),
(35, 'harry', 'pangalinan', 'harry@gmail.com', 'karanglaan', 456755, '1', 'Male', 1),
(36, 'Blue', 'Smith', 'lbs@gmail.com', 'tugegarao', 1545412, '1,5', 'Male', 1),
(37, 'Lebron', 'James', 'Ljames@yahoo.com', 'batangas', 56846, '4', 'Male', 1),
(38, 'john paolo', 'yao', 'johnpaoloyao94@gmail.com', 'bonuan gueset', 2147483647, '2,4,5', 'Male', 1),
(50, 'james', 'duncan', 'james@gmail.com', 'carolina', 7789466, NULL, 'Male', 1),
(51, 'charles', 'canluan', 'paras', 'charles@gmail.com', 76465, NULL, 'Male', 1),
(52, 'david', 'geldof', 'david@gmail.com', 'usa', 56546, NULL, 'Male', 1),
(56, 'johnny', 'freenwood', 'green@gmail.com', 'england', 45662, NULL, 'Female', 1),
(57, 'tom', 'yorke', 't@yahoo.com', 'burmingham', 46546, NULL, 'Male', 1),
(58, 'paolo', 'yao', 'johnpaoloyao94@gmail.com', 'bonuan gueset', 2147483647, NULL, 'Male', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1616194383),
('m130524_201442_init', 1616194409),
('m190124_110200_add_verification_token_column_to_user_table', 1616194409);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'test', 'GeJTbjAkgv3UhCdFxIK-0-KHbFae5n3I', '$2y$13$rosH63U7q3UP8zK.bkEigeEDYRxgFptywmgOi9KtA.Iz9ZpuSErNC', NULL, 'test@gmail.com', 10, 1616223562, 1616223963, 'JYQLrrSIgvqnqi3g-LxHnYOa1cuGvNtY_1616223562');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventguest`
--
ALTER TABLE `eventguest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `eventguest`
--
ALTER TABLE `eventguest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
