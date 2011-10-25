-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2011 at 10:57 PM
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
-- Table structure for table `Assignment`
--

CREATE TABLE IF NOT EXISTS `Assignment` (
  `AssnID` int(30) NOT NULL AUTO_INCREMENT,
  `AssnName` varchar(30) NOT NULL DEFAULT 'Assignment_NOT_NAMED',
  `GroupWork` tinyint(1) NOT NULL DEFAULT '0',
  `MaxMark` int(3) DEFAULT NULL,
  `AvgMark` double DEFAULT NULL,
  `MedianMark` double DEFAULT NULL,
  `CourseID` int(10) DEFAULT NULL,
  `DueTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`AssnID`),
  KEY `CourseID` (`CourseID`),
  KEY `CourseID_2` (`CourseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Assignment`
--

INSERT INTO `Assignment` (`AssnID`, `AssnName`, `GroupWork`, `MaxMark`, `AvgMark`, `MedianMark`, `CourseID`, `DueTime`) VALUES
(1, 'Assignment 2', 0, 100, 0, 0, 1, '2011-10-28 22:18:24'),
(2, 'Java OO Assn1', 0, 100, 0, 0, 2, '2011-10-31 22:18:24'),
(3, 'Assignment 3', 0, 100, 0, 0, 1, '2011-11-22 23:18:24');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Assignment`
--
ALTER TABLE `Assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `Course` (`CourseID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
