-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2011 at 05:42 PM
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
-- Table structure for table `automarking`
--

CREATE TABLE IF NOT EXISTS `automarking` (
  `SampleSolnFile` varchar(200) NOT NULL COMMENT 'Directory in which the sample solution is stored',
  `ScriptFile` varchar(200) NOT NULL,
  `QuestionID` int(30) NOT NULL,
  `MarksLostPerDiff` int(11) NOT NULL,
  PRIMARY KEY (`QuestionID`),
  KEY `AssnID` (`QuestionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `automarking`
--

INSERT INTO `automarking` (`SampleSolnFile`, `ScriptFile`, `QuestionID`, `MarksLostPerDiff`) VALUES
('Submissions/Spring12/CS 173/AutomarkingAssignments/_automark/Shell Scripts/sample.txt', 'Submissions/Spring12/CS 173/AutomarkingAssignments/_automark/Shell Scripts/runGcc.sh', 48, 6),
('Submissions/Spring12/CS 173/AutomarkingAssignments/_automark/Perl Scripts/sample.txt', 'Submissions/Spring12/CS 173/AutomarkingAssignments/_automark/Perl Scripts/runGcc.sh', 49, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `automarking`
--
ALTER TABLE `automarking`
  ADD CONSTRAINT `automarking_ibfk_1` FOREIGN KEY (`QuestionID`) REFERENCES `questions` (`QuestionID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
