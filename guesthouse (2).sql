-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 06, 2019 at 02:06 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
(1, 'admin', '12345', 'jyothsnashaji99@gmail.com'),
(2, 'jyothsnashaji', 'jyothsnashaji', 'jyothsnashaji99@gmail.com'),
(3, 'admin2', 'admin2', 'jyothsnashaji99@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `booked`
--

CREATE TABLE `booked` (
  `booking_id` int(255) NOT NULL,
  `booked_by` int(255) NOT NULL,
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
(25, 0, 'Personal', 'CANCELLED', 'Self', 2, 2, 1, '2019-10-06 03:57:46'),
(27, 0, 'Personal', 'REJECTED', 'Self', 1, 1, 1, '2019-10-06 03:56:22'),
(28, 0, 'Personal', 'CANCELLED', 'Self', 2, 1, 1, '2019-10-06 04:13:55'),
(29, 0, 'Personal', 'CANCELLED', 'Self', 3, 2, 1, '2019-10-06 04:13:49'),
(30, 0, 'Personal', 'CANCELLED', 'Self', 2, 2, 1, '2019-10-06 03:55:46'),
(31, 0, 'Personal', 'CANCELLED', 'Self', 2, 2, 1, '2019-10-03 17:03:57'),
(32, 0, 'Official - ljkhkjgjhg', 'REJECTED', 'Self', 1, 1, 1, '2019-10-06 03:55:06'),
(33, 0, 'Personal - ', 'REJECTED', 'Self', 2, 2, 1, '2019-10-06 04:36:52'),
(34, 0, 'Personal - ', '(1) ROOM ALLOTED', 'Self', 1, 1, 1, '2019-10-06 10:40:12'),
(35, 0, 'Personal - ', 'REJECTED', 'Self', 1, 1, 1, '2019-10-06 10:40:24'),
(36, 0, 'Personal - ', 'WAITING APPROVAL', 'Self', 1, 1, 1, '2019-10-06 10:39:53'),
(37, 0, 'Personal - ', 'WAITING APPROVAL', 'Self', 3, 2, 1, '2019-10-06 10:41:09'),
(38, 0, 'Personal - ', 'WAITING APPROVAL', 'Self', 1, 1, 1, '2019-10-06 11:59:50');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `guest_id` bigint(20) NOT NULL,
  `booking_id` int(255) NOT NULL,
  `checkin` datetime NOT NULL,
  `checkout` datetime NOT NULL,
  `room_id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `relation` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`guest_id`, `booking_id`, `checkin`, `checkout`, `room_id`, `name`, `relation`, `contact`) VALUES
(21, 25, '2019-10-07 00:00:00', '2019-10-10 00:00:00', -1, 'Ann', 'Guest', '63'),
(22, 25, '2019-10-07 00:00:00', '2019-10-10 00:00:00', -1, 'Britta', 'Guest', '66'),
(26, 27, '2019-10-07 00:00:00', '2019-10-08 00:00:00', -1, 'Niveditha', 'Guest', '78'),
(27, 28, '2019-10-16 00:00:00', '2019-10-18 00:00:00', -1, 'Pavitra', 'Guest', '81'),
(28, 28, '2019-10-16 00:00:00', '2019-10-18 00:00:00', -1, 'Jessy', 'Guest', '84'),
(29, 29, '2019-10-10 00:00:00', '2019-10-11 00:00:00', -1, 'Jyothsna Shaji', 'guest', '9207746246'),
(30, 29, '2019-10-10 00:00:00', '2019-10-11 00:00:00', -1, 'aa', 'a', 'a'),
(31, 29, '2019-10-10 00:00:00', '2019-10-11 00:00:00', -1, 'b', 'b', 'b'),
(32, 30, '2019-10-17 00:00:00', '2019-10-18 00:00:00', -1, 'aAa', 'A', 'A'),
(33, 30, '2019-10-17 00:00:00', '2019-10-18 00:00:00', -1, 'B', 'B', 'B'),
(34, 31, '2019-10-17 00:00:00', '2019-10-18 00:00:00', -1, 'm', 'm', 'm'),
(35, 31, '2019-10-17 00:00:00', '2019-10-18 00:00:00', -1, 'k', 'k', 'k'),
(36, 0, '2019-10-17 00:00:00', '2019-10-18 00:00:00', -1, 'b', 'b', 'bb'),
(37, 0, '2019-10-17 00:00:00', '2019-10-18 00:00:00', -1, 'b', 'b', 'bb'),
(38, 32, '2019-10-17 00:00:00', '2019-10-18 00:00:00', -1, 'b', 'b', 'bb'),
(39, 33, '2019-10-07 00:00:00', '2019-10-09 00:00:00', -1, 'a', 'a', 'a'),
(40, 33, '2019-10-07 00:00:00', '2019-10-09 00:00:00', -1, 'b', 'b', 'b'),
(41, 34, '2019-10-22 00:00:00', '2019-10-23 00:00:00', 4, 's', 's', 's'),
(42, 35, '2019-10-25 00:00:00', '2019-10-26 00:00:00', -1, 'Jyothsna Shaji', 'Guest', '9207746246'),
(43, 36, '2019-10-17 00:00:00', '2019-10-18 00:00:00', 0, 'p', 'p', 'p'),
(44, 37, '2019-10-18 00:00:00', '2019-10-19 00:00:00', 0, 'a', 'a', 'a'),
(45, 37, '2019-10-18 00:00:00', '2019-10-19 00:00:00', 0, 'b', 'b', 'b'),
(46, 37, '2019-10-18 00:00:00', '2019-10-19 00:00:00', 0, 'c', 'c', 'c'),
(47, 38, '2019-10-10 00:00:00', '2019-10-11 00:00:00', 0, 'l', 'l', 'l');

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
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(255) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mailid` varchar(100) NOT NULL,
  `dept` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booked`
--
ALTER TABLE `booked`
  MODIFY `booking_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guest_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
