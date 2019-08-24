-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 16, 2019 at 08:16 AM
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
-- Table structure for table `booked`
--

CREATE TABLE `booked` (
  `id` bigint(20) NOT NULL,
  `roomid` bigint(20) NOT NULL,
  `dateofbooking` date NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booked`
--

INSERT INTO `booked` (`id`, `roomid`, `dateofbooking`, `checkin`, `checkout`) VALUES
(1, 1, '2019-08-01', '2019-08-02', '2019-08-03'),
(2, 2, '2019-07-31', '2019-08-02', '2019-08-05'),
(3, 1, '2019-08-15', '2019-08-29', '2019-08-31'),
(3, 2, '2019-08-15', '2019-08-29', '2019-08-31'),
(3, 3, '2019-08-15', '2019-08-29', '2019-08-31'),
(3, 2, '2019-08-15', '2019-08-25', '2019-08-27'),
(3, 2, '2019-08-15', '2019-08-25', '2019-08-28'),
(3, 4, '2019-08-15', '2019-08-30', '2019-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) NOT NULL,
  `roomno` bigint(20) NOT NULL,
  `hostel` mediumtext NOT NULL,
  `capacity` int(11) NOT NULL,
  `ac` tinyint(1) NOT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `roomno`, `hostel`, `capacity`, `ac`, `rate`) VALUES
(1, 1, 'a', 2, 1, 100),
(2, 202, 'a', 2, 1, 100),
(3, 303, 'a', 3, 1, 200),
(4, 404, 'b', 4, 1, 400),
(5, 505, 'b', 2, 0, 100);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
