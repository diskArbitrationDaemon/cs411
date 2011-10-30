-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2011 at 03:02 PM
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
CREATE DATABASE `assignments_uiuc` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `assignments_uiuc`;

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
  `CourseID` int(10) NOT NULL,
  `DueTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`AssnID`),
  KEY `CourseID` (`CourseID`),
  KEY `CourseID_2` (`CourseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Assignment`
--

INSERT INTO `Assignment` (`AssnID`, `AssnName`, `GroupWork`, `MaxMark`, `AvgMark`, `MedianMark`, `CourseID`, `DueTime`) VALUES
(1, 'Assignment 2', 0, 100, 0, 0, 1, '2011-10-28 22:18:24'),
(2, 'Java OO Assn1', 0, 100, 0, 0, 2, '2011-10-31 22:18:24'),
(3, 'Assignment 3', 0, 100, 0, 0, 1, '2011-11-22 23:18:24');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Course`
--

INSERT INTO `Course` (`CourseID`, `CourseName`, `NumStudents`, `SemesterName`) VALUES
(1, 'CS411', 60, 'Fall11'),
(2, 'CS455', 59, 'Fall11');

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

-- --------------------------------------------------------

--
-- Table structure for table `Instructor`
--

CREATE TABLE IF NOT EXISTS `Instructor` (
  `NetID` varchar(10) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `OfficeLocatio` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  PRIMARY KEY (`NetID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Instructor`
--

INSERT INTO `Instructor` (`NetID`, `FirstName`, `LastName`, `PhoneNumber`, `OfficeLocatio`, `Email`) VALUES
('bryanplum', 'Bryan', 'Plummer', '1561887154', 'Siebel2', 'bryanplum@illinois.edu'),
('cwu19', 'Chengzhe', 'Wu', '2147483647', 'Somewhere ... here', 'cwu19@illinois.edu'),
('hnrkssn2', 'Manne', 'Henriksson', '2488492345', 'Siebel', 'hnrkssn2@illinois.edu');

-- --------------------------------------------------------

--
-- Table structure for table `MemberOf`
--

CREATE TABLE IF NOT EXISTS `MemberOf` (
  `GroupName` varchar(20) NOT NULL,
  `StudentID` varchar(20) NOT NULL,
  `AssnID` int(30) NOT NULL,
  PRIMARY KEY (`GroupName`,`StudentID`,`AssnID`),
  KEY `StudentID` (`StudentID`),
  KEY `AssnID` (`AssnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Questions`
--

CREATE TABLE IF NOT EXISTS `Questions` (
  `QuestionID` int(11) NOT NULL AUTO_INCREMENT,
  `QuestionName` varchar(20) NOT NULL,
  `FullMark` int(11) NOT NULL,
  `AssnID` int(11) NOT NULL,
  PRIMARY KEY (`QuestionID`),
  KEY `AssnID` (`AssnID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Questions`
--

INSERT INTO `Questions` (`QuestionID`, `QuestionName`, `FullMark`, `AssnID`) VALUES
(1, 'Q1', 5, 1),
(2, 'Q2', 10, 1),
(3, 'Qn 1', 5, 2),
(4, 'Qn2', 5, 2),
(5, 'Qn3', 15, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Results`
--

CREATE TABLE IF NOT EXISTS `Results` (
  `StudentID` int(11) NOT NULL,
  `QuestionID` int(11) NOT NULL,
  `Mark` int(11) DEFAULT NULL,
  PRIMARY KEY (`StudentID`,`QuestionID`)
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
  `Student` varchar(20) NOT NULL,
  `Files` varchar(200) NOT NULL COMMENT 'The directory where the submission files are locatedt',
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`AssnID`,`Student`),
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
  `NetID` varchar(10) NOT NULL,
  `CourseID` int(10) NOT NULL,
  PRIMARY KEY (`NetID`,`CourseID`),
  KEY `CourseID` (`CourseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Teaches`
--

INSERT INTO `Teaches` (`NetID`, `CourseID`) VALUES
('cwu19', 1),
('bryanplum', 2);

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
  ADD CONSTRAINT `group_ibfk_1` FOREIGN KEY (`AssnID`) REFERENCES `Assignment` (`AssnID`);

--
-- Constraints for table `MemberOf`
--
ALTER TABLE `MemberOf`
  ADD CONSTRAINT `memberof_ibfk_4` FOREIGN KEY (`StudentID`) REFERENCES `Student` (`StudentID`),
  ADD CONSTRAINT `memberof_ibfk_5` FOREIGN KEY (`AssnID`) REFERENCES `Assignment` (`AssnID`);

--
-- Constraints for table `Questions`
--
ALTER TABLE `Questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`AssnID`) REFERENCES `Assignment` (`AssnID`) ON UPDATE CASCADE;

--
-- Constraints for table `Submission`
--
ALTER TABLE `Submission`
  ADD CONSTRAINT `submission_ibfk_2` FOREIGN KEY (`AssnID`) REFERENCES `Assignment` (`AssnID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `submission_ibfk_3` FOREIGN KEY (`Student`) REFERENCES `Student` (`StudentID`) ON UPDATE CASCADE;

--
-- Constraints for table `Takes`
--
ALTER TABLE `Takes`
  ADD CONSTRAINT `takes_ibfk_1` FOREIGN KEY (`Student`) REFERENCES `Student` (`StudentID`),
  ADD CONSTRAINT `takes_ibfk_2` FOREIGN KEY (`Course`) REFERENCES `Course` (`CourseID`);

--
-- Constraints for table `Teaches`
--
ALTER TABLE `Teaches`
  ADD CONSTRAINT `teaches_ibfk_2` FOREIGN KEY (`NetID`) REFERENCES `Instructor` (`NetID`),
  ADD CONSTRAINT `teaches_ibfk_3` FOREIGN KEY (`CourseID`) REFERENCES `Course` (`CourseID`);
--
-- Database: `assignments_users_uiuc`
--
CREATE DATABASE `assignments_users_uiuc` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `assignments_users_uiuc`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Username` varchar(20) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `UserType` int(1) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Password`, `UserType`) VALUES
('administrator', '5d41402abc4b2a76b9719d911017c592', 1),
('cwu17', '5d41402abc4b2a76b9719d911017c592', 2),
('cwu19', '5d41402abc4b2a76b9719d911017c592', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
