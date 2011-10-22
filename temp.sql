-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2011 at 07:26 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Assignment`
--

INSERT INTO `Assignment` (`AssnID`, `AssnName`, `GroupWork`, `MaxMark`, `AvgMark`, `MedianMark`, `CourseID`, `DueTime`) VALUES
(1, 'Assignment1', 0, 100, 0, 0, 1, '2011-10-26 05:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Automarking`
--

CREATE TABLE IF NOT EXISTS `Automarking` (
  `AutomarkID` int(11) NOT NULL AUTO_INCREMENT,
  `SampleSoln` varchar(200) NOT NULL COMMENT 'Directory in which the sample solution is stored',
  `Configs` text NOT NULL,
  `AssnID` int(30) NOT NULL,
  PRIMARY KEY (`AutomarkID`),
  KEY `AssnID` (`AssnID`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Course`
--

INSERT INTO `Course` (`CourseID`, `CourseName`, `NumStudents`, `SemesterName`) VALUES
(1, 'CS411', 60, 'Fall 1');

-- --------------------------------------------------------

--
-- Table structure for table `Group`
--

CREATE TABLE IF NOT EXISTS `Group` (
  `GroupName` varchar(100) NOT NULL,
  `CourseID` int(10) NOT NULL,
  `AssnID` int(30) NOT NULL,
  PRIMARY KEY (`GroupName`,`CourseID`,`AssnID`),
  KEY `CourseID` (`CourseID`),
  KEY `AssnID` (`AssnID`)
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

CREATE TABLE IF NOT EXISTS `MemberOf` (
  `GroupName` varchar(20) NOT NULL,
  `StudentID` varchar(20) NOT NULL,
  `AssnID` int(30) NOT NULL,
  `CourseID` int(10) NOT NULL,
  PRIMARY KEY (`GroupName`,`StudentID`,`AssnID`,`CourseID`),
  KEY `StudentID` (`StudentID`),
  KEY `AssnID` (`AssnID`),
  KEY `CourseID` (`CourseID`)
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
  PRIMARY KEY (`AssnID`,`CourseID`,`Student`),
  KEY `CourseID` (`CourseID`),
  KEY `Student` (`Student`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Takes`
--

CREATE TABLE IF NOT EXISTS `Takes` (
  `Student` varchar(20) NOT NULL,
  `Course` int(10) NOT NULL,
  `FinalMark` int(3) NOT NULL,
  PRIMARY KEY (`Student`,`Course`),
  KEY `Course` (`Course`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Teaches`
--

CREATE TABLE IF NOT EXISTS `Teaches` (
  `Instructor` varchar(10) NOT NULL,
  `Course` int(10) NOT NULL,
  PRIMARY KEY (`Instructor`,`Course`),
  KEY `Course` (`Course`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Assignment`
--
ALTER TABLE `Assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `Course` (`CourseID`);

--
-- Constraints for table `Automarking`
--
ALTER TABLE `Automarking`
  ADD CONSTRAINT `automarking_ibfk_1` FOREIGN KEY (`AssnID`) REFERENCES `Assignment` (`AssnID`);

--
-- Constraints for table `Group`
--
ALTER TABLE `Group`
  ADD CONSTRAINT `group_ibfk_2` FOREIGN KEY (`AssnID`) REFERENCES `Assignment` (`AssnID`),
  ADD CONSTRAINT `group_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `Assignment` (`CourseID`);

--
-- Constraints for table `MemberOf`
--
ALTER TABLE `MemberOf`
  ADD CONSTRAINT `memberof_ibfk_3` FOREIGN KEY (`CourseID`) REFERENCES `Assignment` (`CourseID`),
  ADD CONSTRAINT `memberof_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `Student` (`StudentID`),
  ADD CONSTRAINT `memberof_ibfk_2` FOREIGN KEY (`AssnID`) REFERENCES `Assignment` (`AssnID`);

--
-- Constraints for table `Submission`
--
ALTER TABLE `Submission`
  ADD CONSTRAINT `submission_ibfk_2` FOREIGN KEY (`Student`) REFERENCES `Student` (`StudentID`),
  ADD CONSTRAINT `submission_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `Assignment` (`CourseID`);

--
-- Constraints for table `Takes`
--
ALTER TABLE `Takes`
  ADD CONSTRAINT `takes_ibfk_2` FOREIGN KEY (`Course`) REFERENCES `Course` (`CourseID`),
  ADD CONSTRAINT `takes_ibfk_1` FOREIGN KEY (`Student`) REFERENCES `Student` (`StudentID`);

--
-- Constraints for table `Teaches`
--
ALTER TABLE `Teaches`
  ADD CONSTRAINT `teaches_ibfk_2` FOREIGN KEY (`Course`) REFERENCES `Assignment` (`CourseID`),
  ADD CONSTRAINT `teaches_ibfk_1` FOREIGN KEY (`Instructor`) REFERENCES `Instructor` (`NetID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
