-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2011 at 06:12 PM
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
  `CourseID` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`AssnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Automarking`
--

CREATE TABLE IF NOT EXISTS `Automarking` (
  `AutomarkID` int(11) NOT NULL AUTO_INCREMENT,
  `SampleSoln` varchar(200) NOT NULL COMMENT 'Directory in which the sample solution is stored',
  `Configs` text NOT NULL,
  `AssnID` int(30) NOT NULL,
  PRIMARY KEY (`AutomarkID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Course`
--

CREATE TABLE IF NOT EXISTS `Course` (
  `CourseID` int(4) NOT NULL AUTO_INCREMENT COMMENT 'CourseID specifically in the DB',
  `CourseName` varchar(10) NOT NULL,
  `NumStudents` int(4) NOT NULL,
  `SemesterName` varchar(6) NOT NULL,
  PRIMARY KEY (`CourseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Group`
--

CREATE TABLE `Group` (
  `GroupName` varchar(100) NOT NULL,
  `CourseID` int(10) NOT NULL,
  `AssnID` int(30) NOT NULL,
  PRIMARY KEY (`GroupName`,`CourseID`,`AssnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Instructor`
--

CREATE TABLE IF NOT EXISTS `Instructor` (
  `NetID` varchar(10) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `PhoneNumber` int(15) NOT NULL,
  `OfficeLocatio` varchar(100) NOT NULL,
  PRIMARY KEY (`NetID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `MemberOf`
--

CREATE TABLE `MemberOf` (
  `GroupName` varchar(20) NOT NULL,
  `StudentID` varchar(20) NOT NULL,
  `AssnID` int(30) NOT NULL,
  `CourseID` int(10) NOT NULL,
  PRIMARY KEY (`GroupName`,`StudentID`,`AssnID`,`CourseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE IF NOT EXISTS `Student` (
  `StudentID` varchar(20) NOT NULL,
  `Degree/Year` varchar(30) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  PRIMARY KEY (`StudentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Submission`
--

CREATE TABLE IF NOT EXISTS `Submission` (
  `AssnID` int(30) NOT NULL,
  `CourseID` int(10) NOT NULL,
  `Student` varchar(20) NOT NULL,
  `Files` varchar(200) NOT NULL COMMENT 'The directory where the submission files are locatedt',
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `AssnMark` int(3) NOT NULL,
  PRIMARY KEY (`AssnID`,`CourseID`,`Student`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Takes`
--

CREATE TABLE IF NOT EXISTS `Takes` (
  `Student` varchar(20) NOT NULL,
  `Course` int(10) NOT NULL,
  `FinalMark` int(3) NOT NULL,
  PRIMARY KEY (`Student`,`Course`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Teaches`
--

CREATE TABLE IF NOT EXISTS `Teaches` (
  `Instructor` varchar(10) NOT NULL,
  `Course` int(10) NOT NULL,
  PRIMARY KEY (`Instructor`,`Course`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
