-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2011 at 11:12 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `assignments_uiuc`
--

-- --------------------------------------------------------

--
-- Table structure for table `Group`
--

CREATE TABLE IF NOT EXISTS `Group` (
  `GroupName` varchar(100) NOT NULL,
  `AssnID` int(30) NOT NULL,
  PRIMARY KEY (`GroupName`,`AssnID`),
  KEY `AssnID` (`AssnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Group`
--
ALTER TABLE `Group`
  ADD CONSTRAINT `group_ibfk_1` FOREIGN KEY (`AssnID`) REFERENCES `Assignment` (`AssnID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
