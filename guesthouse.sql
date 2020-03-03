-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 04, 2020 at 12:16 AM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guesthouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(4, 'vishnu', '$2y$10$PFV8r8g9jPHmZrFw9Dcsj.oABuRq0SdESmukBqRNtojnz5l4TJ7rm', 'vishnupoothery@gmail.com'),
(6, 'admin', '$2y$10$X031HEH9duvd68SWai/xP.ZDedUV4fLc4U50lcsAR3R9sI/vMtr4q', 'jyothsnashaji99@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `booked`
--

CREATE TABLE `booked` (
  `booking_id` int(255) NOT NULL,
  `booked_by` varchar(500) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `booking_status` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `no_guests` int(255) NOT NULL,
  `no_rooms` int(255) NOT NULL,
  `no_groups` int(255) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booked`
--

INSERT INTO `booked` (`booking_id`, `booked_by`, `purpose`, `booking_status`, `payment_status`, `no_guests`, `no_rooms`, `no_groups`, `booking_date`) VALUES
(63, 'jyothsna_b160901cs@nitc.ac.in', 'Personal  ', 'CHECKED OUT', 'Self', 1, 1, 1, '2019-12-28 10:03:46'),
(64, 'nirmal_b160094cs@nitc.ac.in', 'Personal  ', 'WAITING APPROVAL', 'Guest', 2, 2, 1, '2020-02-27 18:54:46'),
(65, 'nirmal_b160094cs@nitc.ac.in', 'Personal  ', 'WAITING APPROVAL', 'Self', 1, 1, 1, '2020-02-27 18:55:33'),
(66, 'vishnu_b160688cs@nitc.ac.in', 'Personal  ', 'WAITING APPROVAL', 'Self', 1, 1, 1, '2020-02-27 19:02:12'),
(67, 'vishnu_b160688cs@nitc.ac.in', 'Personal  ', 'WAITING APPROVAL', 'Self', 1, 1, 1, '2020-02-27 19:08:10'),
(68, 'vishnu_b160688cs@nitc.ac.in', 'Personal  ', 'WAITING APPROVAL', 'Self', 1, 1, 1, '2020-02-27 19:11:58'),
(69, 'vishnu_b160688cs@nitc.ac.in', 'Personal  ', 'WAITING APPROVAL', 'Self', 1, 1, 1, '2020-02-27 19:12:44'),
(70, 'vishnu_b160688cs@nitc.ac.in', 'Personal  ', '1 ROOM ALLOTED', 'Self', 1, 1, 1, '2020-02-27 19:27:01'),
(71, 'jyothsna_b160901cs@nitc.ac.in', 'Personal  ', 'REJECTED', 'Self', 1, 1, 1, '2020-02-29 07:54:08'),
(72, 'jimmy@nitc.ac.in', 'Personal  ', 'WAITING APPROVAL', 'Self', 1, 1, 1, '2020-02-29 06:39:54'),
(73, 'jimmy@nitc.ac.in', 'Personal  ', 'WAITING APPROVAL', 'Self', 1, 1, 1, '2020-02-29 06:42:09'),
(74, 'jyothsna_b160901cs@nitc.ac.in', 'Personal  ', 'CANCELLED', 'Self', 1, 1, 1, '2020-02-29 08:15:38'),
(75, 'jyothsna_b160901cs@nitc.ac.in', 'Personal  ', 'CANCELLED', 'Self', 1, 1, 1, '2020-02-29 08:28:52'),
(76, 'jyothsna_b160901cs@nitc.ac.in', 'Personal  ', 'REJECTED', 'Self', 1, 1, 1, '2020-02-29 08:47:13'),
(77, 'jyothsna_b160901cs@nitc.ac.in', 'Personal  ', 'CHECKED OUT', 'Self', 1, 1, 1, '2020-02-29 09:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `email_otp`
--

CREATE TABLE `email_otp` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `otp` varchar(250) NOT NULL,
  `used` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password`
--

CREATE TABLE `forgot_password` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(100) NOT NULL,
  `used` int(11) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `guest_id` bigint(20) NOT NULL,
  `booking_id` int(255) NOT NULL,
  `expected_checkin` datetime NOT NULL,
  `expected_checkout` datetime NOT NULL,
  `actual_checkin` datetime DEFAULT NULL,
  `actual_checkout` datetime DEFAULT NULL,
  `room_id` int(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `relation` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`guest_id`, `booking_id`, `expected_checkin`, `expected_checkout`, `actual_checkin`, `actual_checkout`, `room_id`, `name`, `relation`, `contact`) VALUES
(85, 63, '2020-01-10 00:00:00', '2020-01-11 00:00:00', '2019-12-28 15:33:00', '2019-12-28 15:33:00', 4, 'Niranjana Shaji', 'Guest', '9447210468'),
(86, 70, '2020-03-11 00:00:00', '2020-03-12 00:00:00', NULL, NULL, 2, 'Vishnu', 'Me', '123456789'),
(87, 71, '2020-03-11 00:00:00', '2020-03-12 00:00:00', NULL, NULL, -1, 'Jyothsna', 'Guest', '09207746246'),
(88, 72, '2020-03-03 00:00:00', '2020-02-05 00:00:00', NULL, NULL, NULL, 'Jimmy Jose', 'self', 'gidd'),
(89, 73, '2020-02-29 00:00:00', '2020-03-01 00:00:00', NULL, NULL, NULL, 'vishnu', 'Student', '9495872548'),
(90, 74, '2020-03-12 00:00:00', '2020-03-13 00:00:00', NULL, NULL, -1, 'Jyothsna Shaji', 'Guest', '09207746246'),
(91, 75, '2020-03-12 00:00:00', '2020-03-13 00:00:00', NULL, NULL, -1, 'Jyothsna Shaji', 'fsf', '09207746246'),
(92, 76, '2020-03-12 00:00:00', '2020-03-13 00:00:00', NULL, NULL, -1, 'p', 'p', 'p'),
(93, 77, '2020-03-12 00:00:00', '2020-03-13 00:00:00', '2020-02-29 14:45:00', '2020-02-29 14:45:00', 3, 'p', 'l', 't');

-- --------------------------------------------------------

--
-- Table structure for table `login_hash`
--

CREATE TABLE `login_hash` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `hash` varchar(100) NOT NULL,
  `loggedin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registrar`
--

CREATE TABLE `registrar` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registrar`
--

INSERT INTO `registrar` (`id`, `username`, `password`, `email`) VALUES
(1, 'registrar', '$2y$10$PFV8r8g9jPHmZrFw9Dcsj.oABuRq0SdESmukBqRNtojnz5l4TJ7rm', 'jyothsna_b160901cs@nitc.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `rejectedBookings`
--

CREATE TABLE `rejectedBookings` (
  `booking_id` int(11) NOT NULL,
  `rejectedBy` varchar(255) NOT NULL,
  `remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rejectedBookings`
--

INSERT INTO `rejectedBookings` (`booking_id`, `rejectedBy`, `remark`) VALUES
(71, 'registrar', 'fjhfgfhf'),
(76, 'registrar', 'kjgjgh');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(255) NOT NULL,
  `location` varchar(100) NOT NULL,
  `room_num` int(255) NOT NULL,
  `ac` char(10) NOT NULL,
  `rent` float NOT NULL,
  `type` varchar(100) NOT NULL,
  `capacity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `location`, `room_num`, `ac`, `rent`, `type`, `capacity`) VALUES
(2, 'GH', 101, 'ac', 200, 'deluxe', 2),
(3, 'GH', 301, 'ac', 200, 'deluxe', 2),
(4, 'GH', 222, 'ac', 300, 'super deluxe', 3),
(5, 'GH', 402, 'ac', 500, 'vip', 2),
(6, 'GH', 212, 'ac', 200, 'deluxe', 2),
(9, 'GH', 201, 'ac', 200, 'deluxe', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `oauth_pro` varchar(50) NOT NULL,
  `oauthid` varchar(100) NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `l_name` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `locale` varchar(20) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_pro`, `oauthid`, `f_name`, `l_name`, `email_id`, `gender`, `locale`, `cover`, `picture`, `url`, `created_date`) VALUES
(10, 'google', '103896781460951110112', 'NITC', 'Registration', 'nitcreg@gmail.com', '', 'en', '', 'https://lh4.googleusercontent.com/-K_LqxE4-Mxw/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rfo2U9hLc515cs6slauboAfOyMaIA/photo.jpg', '', '2019-10-30 12:54:02'),
(11, 'google', '102708584282695286112', 'vishnu', 'poothery', 'vishnu_b160688cs@nitc.ac.in', '', 'en', '', 'https://lh3.googleusercontent.com/a-/AAuE7mA9L4IgF2mBiV0H-8MQglDKKBoA-O6ud01vgTDcgQ', '', '2019-10-30 13:39:01'),
(12, 'google', '103755823348649827444', 'Jyothsna', 'Shaji', 'jyothsnashaji99@gmail.com', '', 'en', '', 'https://lh3.googleusercontent.com/a-/AAuE7mCiDcAr8-a5lAPoZ9U4KyebxFMkesZHec5LPf3GEg', '', '2019-12-02 13:19:05'),
(13, 'google', '107164954560604754533', 'jyothsna', 'shaji', 'jyothsna_b160901cs@nitc.ac.in', '', 'en', '', 'https://lh4.googleusercontent.com/-Nez6x6IA_AY/AAAAAAAAAAI/AAAAAAAAAAA/AKF05nC5-gp6Z8K-zVZT1HX1O4yyulIv9w/photo.jpg', '', '2019-12-02 13:19:24'),
(14, 'google', '105261940015103566206', 'nirmal', 'k.v', 'nirmal_b160094cs@nitc.ac.in', '', 'en', '', 'https://lh3.googleusercontent.com/-0PycGXd9X4Y/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rdbNU56YIG2OKlLkokI_u0wTdL2ug/photo.jpg', '', '2020-02-28 00:23:03'),
(15, 'google', '115220272722684022726', 'Jimmy', 'Jose', 'jimmy@nitc.ac.in', '', 'en-GB', '', 'https://lh4.googleusercontent.com/-_pPSARK3T_U/AAAAAAAAAAI/AAAAAAAAAAA/AKF05nBHGf2M1LPDxuI9hHuhRccLyMFwJA/photo.jpg', '', '2020-02-29 12:08:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booked`
--
ALTER TABLE `booked`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `email_otp`
--
ALTER TABLE `email_otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `login_hash`
--
ALTER TABLE `login_hash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrar`
--
ALTER TABLE `registrar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rejectedBookings`
--
ALTER TABLE `rejectedBookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `booked`
--
ALTER TABLE `booked`
  MODIFY `booking_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `email_otp`
--
ALTER TABLE `email_otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forgot_password`
--
ALTER TABLE `forgot_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guest_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `login_hash`
--
ALTER TABLE `login_hash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `registrar`
--
ALTER TABLE `registrar`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
