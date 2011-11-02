-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2011 at 09:36 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `assignments_users_uiuc`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Username` varchar(20) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `UserType` int(1) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Password`, `UserType`) VALUES
('amburg', '1f50893f80d6830d62765ffad7721742', 3),
('degrand1', 'c8263c3c3e94f884e140388ef15584b3', 3),
('garbarz', 'ebe6941ee8a10c14dc933ae37a0f43fc', 3),
('krahn', '5f4dcc3b5aa765d61d8327deb882cf99', 3),
('loboda.tom', 'c726698620762d88f738be4a294fae79', 1),
('loboda1', 'c726698620762d88f738be4a294fae79', 3),
('newman', '6c63212ab48e8401eaf6b59b95d816a9', 3),
('ramakrishna', 'bda9643ac6601722a28f238714274da4', 3),
('smith', 'd2171f22e27924e923b7ac8bf8c2e427', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
