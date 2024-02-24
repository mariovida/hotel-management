-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2022 at 02:19 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `checked`
--

CREATE TABLE `checked` (
  `id` int(30) NOT NULL,
  `ref_no` varchar(100) NOT NULL,
  `room_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `date_in` date NOT NULL,
  `date_out` date NOT NULL,
  `booked_cid` int(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1=checked in , 2 = checked out',
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checked`
--

INSERT INTO `checked` (`id`, `ref_no`, `room_id`, `name`, `contact_no`, `date_in`, `date_out`, `booked_cid`, `status`, `date_updated`) VALUES
(5, '9564082520\n', 1, 'John Smith', '+14526-5455-44', '2020-09-19', '2020-09-22', 0, 2, '2020-09-19 13:12:19'),
(7, '4392831400\n', 3, 'Sample', '5205525544', '2020-09-19', '2020-09-23', 0, 2, '2020-09-19 16:00:55'),
(10, '1237870166\n', 1, 'John Smith', '+14526-5455-44', '2021-11-23', '2021-11-28', 3, 1, '2021-11-10 20:29:55'),
(11, '8412962278\n', 0, 'Draco Lux', '+385917324270', '2021-12-05', '2021-12-08', 2, 0, '2021-11-10 20:27:15'),
(12, '1894343400\n', 0, 'Bruno Paster', '+3875123356', '2021-11-22', '2021-11-26', 3, 0, '2021-11-10 20:28:39');

-- --------------------------------------------------------

--
-- Table structure for table `check_in`
--

CREATE TABLE `check_in` (
  `id` int(30) NOT NULL,
  `ref` int(30) NOT NULL,
  `room_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `contact` varchar(20) NOT NULL,
  `date_in` varchar(32) NOT NULL,
  `date_out` varchar(32) NOT NULL,
  `room` varchar(30) NOT NULL,
  `card_num` varchar(32) NOT NULL,
  `ex_month` varchar(32) NOT NULL,
  `ex_year` varchar(32) NOT NULL,
  `cvv` int(30) NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `check_in`
--

INSERT INTO `check_in` (`id`, `ref`, `room_id`, `name`, `contact`, `date_in`, `date_out`, `room`, `card_num`, `ex_month`, `ex_year`, `cvv`, `date_updated`) VALUES
(9, 241303851, 10, 'Peter Parker', '+1-512-6803', '02.12.2021.', '06.12.2021.', 'Room 301', '5428118404638392', '12', '2025', 512, '2021-11-13 18:41:34'),
(11, 855907428, 13, 'Erik Paris', '+385917324270', '01.01.2021.', '01.0.1.2022.', 'Room 402', '', '', '', 0, '2021-12-05 01:00:37');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(30) NOT NULL,
  `room` varchar(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `status` int(30) NOT NULL DEFAULT 0 COMMENT '0 = Available , 1= Unvailables'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room`, `category_id`, `status`) VALUES
(1, 'Room 101', 1, 0),
(2, 'Room 102', 1, 0),
(3, 'Room 103', 1, 0),
(4, 'Room 104', 2, 0),
(5, 'Room 105', 2, 0),
(6, 'Room 106', 2, 0),
(7, 'Room 201', 4, 1),
(8, 'Room 202', 4, 0),
(9, 'Room 203', 4, 0),
(10, 'Room 301', 3, 1),
(11, 'Room 302', 3, 1),
(12, 'Room 401', 5, 0),
(13, 'Room 402 (S Room)', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `room_categories`
--

CREATE TABLE `room_categories` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `price` float NOT NULL,
  `cover_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_categories`
--

INSERT INTO `room_categories` (`id`, `name`, `price`, `cover_img`) VALUES
(1, 'Single Room', 120, 'room_single.jpg'),
(2, 'Twin Room', 200, 'room_twin.jpg'),
(3, 'Deluxe Room', 350, 'room_deluxe.jpg'),
(4, 'Family Room', 400, 'room_family.jpg'),
(5, 'Suite', 650, 'room_suite.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`) VALUES
(31583, 'Administrator', 'admin', '$2y$10$bw1OJisCjehKM4lBuZiLIO9TFH43tf6wlHP9HCou2n91uYmls1.sG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checked`
--
ALTER TABLE `checked`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_in`
--
ALTER TABLE `check_in`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_categories`
--
ALTER TABLE `room_categories`
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
-- AUTO_INCREMENT for table `checked`
--
ALTER TABLE `checked`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `check_in`
--
ALTER TABLE `check_in`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `room_categories`
--
ALTER TABLE `room_categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56280;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
