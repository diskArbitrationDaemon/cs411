-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2011 at 09:35 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

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
-- Table structure for table `assignment`
--

CREATE TABLE IF NOT EXISTS `assignment` (
  `AssnID` int(30) NOT NULL AUTO_INCREMENT,
  `AssnName` varchar(30) NOT NULL DEFAULT 'Assignment_NOT_NAMED',
  `GroupWork` tinyint(1) NOT NULL DEFAULT '0',
  `MaxMark` int(3) DEFAULT NULL,
  `AvgMark` double DEFAULT NULL,
  `MedianMark` double DEFAULT NULL,
  `CourseID` int(10) NOT NULL,
  `DueTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`AssnID`),
  KEY `CourseID` (`CourseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`AssnID`, `AssnName`, `GroupWork`, `MaxMark`, `AvgMark`, `MedianMark`, `CourseID`, `DueTime`) VALUES
(1, 'MP1 - Practice with pointers', 0, 30, 28.6, 29, 32, '2011-09-01 14:59:59'),
(2, 'MP2 - Constructors and Stuff', 1, 50, 42.55, 44, 32, '2011-09-13 15:59:59'),
(3, 'MP3 - Linked Lists', 1, 50, 46.7, 47, 32, '2011-09-30 15:59:59'),
(4, 'MP4 - Quadtrees', 1, 50, 41.1, 42, 32, '2011-10-09 15:59:59'),
(5, 'MP5 - Photomosaics', 1, 50, 38.1, 44, 32, '2011-10-28 15:59:59'),
(6, 'MP6 - Making Mazes', 1, 50, 45.55, 48, 32, '2011-11-01 17:59:59'),
(7, 'Assignment 1', 0, 100, 83.2, 87, 33, '2011-09-03 15:59:59'),
(8, 'Assignment 2', 0, 100, 76.9, 82, 33, '2011-09-18 15:59:59'),
(9, 'Assignment 3', 0, 100, 84.1, 86, 33, '2011-10-03 15:59:59'),
(10, 'Assignment 4', 0, 100, 77.9, 80, 33, '2011-10-30 17:59:59'),
(11, 'C Dictionary', 0, 100, 94.7, 95, 35, '2011-09-04 15:59:59'),
(12, 'Threads', 1, 100, 80.5, 83, 35, '2011-09-30 15:59:59'),
(13, 'Scheduling', 1, 100, 91.8, 93, 35, '2011-10-13 15:59:59'),
(14, 'Deadlock', 1, 100, 74.13, 71, 35, '2011-10-31 06:00:00'),
(15, 'MapReduce', 1, 200, 155.8, 181, 35, '2011-11-13 04:00:00'),
(16, 'Networking TCP ', 1, 100, 82.3, 81.5, 35, '2011-11-29 04:00:00'),
(17, 'Malloc', 1, 100, 92.4, 88.5, 35, '2011-12-05 16:00:00'),
(18, 'HW1', 2, 50, 44, 47, 36, '2011-07-01 15:59:59'),
(19, 'HW2', 2, 50, 45.5, 46.5, 36, '2011-07-15 16:00:00'),
(20, 'HW3', 2, 50, 41.8, 43, 36, '2011-07-30 15:59:59'),
(21, 'HW4', 2, 50, 47.5, 49, 36, '2011-08-06 15:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `automarking`
--

CREATE TABLE IF NOT EXISTS `automarking` (
  `AutomarkID` int(11) NOT NULL AUTO_INCREMENT,
  `SampleSoln` varchar(200) NOT NULL COMMENT 'Directory in which the sample solution is stored',
  `Configs` text NOT NULL,
  `AssnID` int(30) NOT NULL,
  PRIMARY KEY (`AutomarkID`),
  KEY `AssnID` (`AssnID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `automarking`
--

INSERT INTO `automarking` (`AutomarkID`, `SampleSoln`, `Configs`, `AssnID`) VALUES
(1, 'C:/xampp/htdocs/cs411', 'These are the configs for the file', 1),
(2, 'C:/xampp/htdocs/cs412', 'Something should be here', 2),
(3, 'C:/xampp/htdocs/cs413', 'Same thing here', 3),
(4, 'C:/xampp/htdocs/cs410', 'Am I allowed to type a /?  How about a ?', 3);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `CourseID` int(4) NOT NULL AUTO_INCREMENT COMMENT 'CourseID specifically in the DB',
  `CourseName` varchar(10) NOT NULL,
  `NumStudents` int(4) NOT NULL,
  `SemesterName` varchar(8) NOT NULL,
  PRIMARY KEY (`CourseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`CourseID`, `CourseName`, `NumStudents`, `SemesterName`) VALUES
(1, 'CS 103', 31, 'Spring12'),
(2, 'CS 105', 216, 'Spring12'),
(3, 'CS 125', 200, 'Spring12'),
(4, 'CS 173', 100, 'Spring12'),
(5, 'CS 210', 24, 'Spring12'),
(6, 'CS 225', 200, 'Spring12'),
(7, 'CS 231', 200, 'Spring12'),
(8, 'CS 232', 200, 'Spring12'),
(9, 'CS 241', 180, 'Spring12'),
(10, 'CS 242', 150, 'Spring12'),
(11, 'CS 357', 200, 'Spring12'),
(12, 'CS 373', 150, 'Spring12'),
(13, 'CS 411', 200, 'Spring12'),
(14, 'CS 410', 75, 'Spring12'),
(15, 'CS 414', 48, 'Spring12'),
(16, 'CS 418', 72, 'Spring12'),
(17, 'CS 425', 48, 'Spring12'),
(18, 'CS 431', 48, 'Spring12'),
(19, 'CS 433', 49, 'Spring12'),
(20, 'CS 438', 48, 'Spring12'),
(21, 'CS 440', 125, 'Spring12'),
(22, 'CS 461', 90, 'Spring12'),
(23, 'CS 473', 200, 'Spring12'),
(24, 'CS 467', 43, 'Spring12'),
(25, 'CS 439', 35, 'Spring12'),
(26, 'CS 482', 49, 'Spring12'),
(27, 'CS 512', 43, 'Spring12'),
(28, 'CS 523', 42, 'Spring12'),
(29, 'CS 533', 43, 'Spring12'),
(30, 'CS 102', 81, 'Fall11'),
(31, 'CS 125', 200, 'Fall11'),
(32, 'CS 225', 200, 'Fall11'),
(33, 'CS 231', 200, 'Fall11'),
(34, 'CS 232', 160, 'Fall11'),
(35, 'CS 241', 150, 'Fall11'),
(36, 'CS 425', 48, 'Summer11'),
(37, 'CS 231', 200, 'Summer11');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `GroupName` varchar(100) NOT NULL,
  `AssnID` int(30) NOT NULL,
  PRIMARY KEY (`GroupName`,`AssnID`),
  KEY `AssnID` (`AssnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`GroupName`, `AssnID`) VALUES
('ABC', 2),
('Anime Girls', 2),
('Gamer Girlz', 2),
('Giraffe and Cake', 2),
('Homework Ragers', 2),
('Jack and Jill', 2),
('Jocks and Socks', 2),
('Noobs', 2),
('Nose Goes', 2),
('Pootsy and Wootsy', 2),
('Sick Puppies', 2),
('Team Awesome', 2),
('Team Cool Cats', 2),
('The Lovers', 2),
('We Hate This MP!!!!', 2),
('Headphone Here', 3),
('Hyperspace', 3),
('Mortal Kombat Glory', 3),
('Perfect Score', 3),
('Profs', 3),
('Roger and Sam', 3),
('Team Amazing', 3),
('Team Fun', 3),
('Team Good Time', 3),
('The Hornets Nest', 3),
('Zzzzzz', 3),
('Beer and Queer', 12),
('Blink182', 12),
('Da Playas', 12),
('Go Go Go Go', 12),
('Stew and Stew', 12),
('Team Office', 12),
('ERAN', 13),
('Heroes and Zeros', 13),
('LL', 13),
('No Win For Us', 13),
('Socket Joint', 13),
('Team Robotron', 13),
('Hymn Dance', 14),
('Me and Fred', 14),
('Team A', 14),
('Team B', 14),
('Team C', 14),
('Team D', 14),
('Team E', 14),
('Team F', 14),
('Team G', 14),
('Team H', 14),
('Team I', 14),
('Team J', 14),
('Team K', 14),
('Team L', 14),
('Team M', 14),
('Team N', 14),
('Bananarama and Split', 15),
('Bowser and Mario', 15),
('Cutie Patooties', 15),
('Malloc is Dumb', 15),
('Team Boom Boom', 15),
('The Nerds', 15),
('Whos Dat Creepin?', 15),
('Group 1', 16),
('I Love School', 16),
('Me and This Guy', 16),
('No Hope', 16),
('School Sucks', 16),
('Walla Walla', 16),
('Win/Fail', 16);

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE IF NOT EXISTS `instructor` (
  `InstructorID` varchar(20) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `PhoneNumber` varchar(10) NOT NULL,
  `OfficeLocation` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  PRIMARY KEY (`InstructorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`InstructorID`, `FirstName`, `LastName`, `PhoneNumber`, `OfficeLocation`, `Email`) VALUES
('armstc', 'Christopher', 'Armstrong', '8476988804', '2642 Siebel Center', 'armstc@illinois.edu'),
('brownp2', 'Paul', 'Brown', '2173347756', '2731 Siebel Center', 'brownp2@illinois.edu'),
('bullock', 'Sandy', 'Bullock', '2177569032', '4111 Siebel Center', 'bullock@illinois.edu'),
('dragonia1', 'Glenn', 'Dragonia', '2244217767', '2402 Siebel Center', 'dragonia1@illinois.edu'),
('faaadi', 'Aadi', 'Fa', '8477346789', '2108 Siebel Center', 'faaadi@illinois.edu'),
('gleeter3', 'Lisa', 'Gleeter', '2172090029', '1204 Digital Computing Lab', 'gleeter3@illinois.edu'),
('heeren', 'Cinda', 'Heeren', '8476677782', '3257 Siebel Center', 'heeren@illinois.edu'),
('hushev', 'Marco', 'Hushev', '8479000081', '4432 Siebel Center', 'hushev@illinois.edu'),
('junipe2', 'Eric', 'Juniper', '8473098872', '4145 Siebel Center', 'junipe2@illinois.edu'),
('krankj1', 'Joseph', 'Krank', '8473208843', '3311 Siebel Center', 'krankj@illinois.edu'),
('linguo', 'Guoliang', 'Lin', '8474100099', '4103 Siebel Center', 'linguo@illinois.edu'),
('markova', 'Alexander', 'Markov', '2172334751', '136 Engineering Hall', 'markova@illinois.edu'),
('ragnia', 'Ryu', 'Ragnia', '8473319082', '2701 Siebel Center', 'ragnia@illinois.edu'),
('rynsti', 'Aimee', 'Rynsti', '8475529004', '2439 Siebel Center', 'rynsti@illinois.edu'),
('smith2', 'Bart', 'Smith', '8474417732', '3309 Siebel Center', 'smith2@illinois.edu'),
('tuckr1', 'Ryan', 'Tucker', '8476554500', '4242 Siebel Center', 'tuckr1@illinois.edu'),
('vishnu1', 'Mohammad', 'Vishnu', '8474114177', '2414 Siebel Center', 'vishnu1@illinois.edu'),
('wuchen3', 'Chen', 'Wu', '8477708888', '2110 Siebel Center', 'wuchen3@illinois.edu');

-- --------------------------------------------------------

--
-- Table structure for table `memberof`
--

CREATE TABLE IF NOT EXISTS `memberof` (
  `GroupName` varchar(20) NOT NULL,
  `StudentID` varchar(20) NOT NULL,
  `AssnID` int(30) NOT NULL,
  PRIMARY KEY (`GroupName`,`StudentID`,`AssnID`),
  KEY `StudentID` (`StudentID`),
  KEY `AssnID` (`AssnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `memberof`
--

INSERT INTO `memberof` (`GroupName`, `StudentID`, `AssnID`) VALUES
('ABC', 'bakit4', 1),
('ABC', 'butley7', 1),
('Profs', 'hingr1', 1),
('Profs', 'mertck1', 1),
('ABC', 'amburg1', 2),
('ABC', 'hingr1', 2),
('Beer and Queer', 'degrand1', 3),
('Beer and Queer', 'loboda1', 3),
('Anime Girls', 'cwu19', 8),
('Anime Girls', 'margov3', 8),
('Me and Fred', 'newp3', 8),
('Bowser and Mario', 'freund3', 10),
('Bowser and Mario', 'garba2', 10),
('Team Cool Cats', 'krahna3', 14),
('Team Cool Cats', 'wilry2', 14),
('Team Awesome', 'arias1', 15),
('Team Awesome', 'mertck1', 15),
('Perfect Score', 'karakus1', 19),
('Perfect Score', 'romex2', 19),
('Mortal Kombat Glory', 'damar4', 20),
('Mortal Kombat Glory', 'deeliz2', 20);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `QuestionID` int(11) NOT NULL AUTO_INCREMENT,
  `QuestionName` varchar(20) NOT NULL,
  `FullMark` int(11) NOT NULL,
  `AssnID` int(30) NOT NULL,
  PRIMARY KEY (`QuestionID`),
  KEY `AssnID` (`AssnID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`QuestionID`, `QuestionName`, `FullMark`, `AssnID`) VALUES
(1, '1', 10, 7),
(2, '2', 10, 7),
(3, '2', 10, 7),
(4, '4', 10, 7),
(5, 'Problem 1', 20, 8),
(6, 'Problem 2', 10, 8),
(7, 'Power of Powers', 20, 9),
(8, 'Fibonacci Returns', 20, 9),
(9, 'Bits and Bytes', 15, 9),
(10, 'Quantum Wells', 10, 10),
(11, 'Rhinos Left Binary', 40, 10),
(12, 'Problem 1', 20, 18),
(13, 'Problem 2', 10, 18),
(14, 'Problem 3', 20, 18),
(15, 'Problem 1', 20, 19),
(16, 'Problem 2', 20, 19),
(17, 'Problem 3', 30, 19),
(18, 'Point Do Matter', 30, 20),
(19, 'C vs Java', 25, 20),
(20, 'Graph Traversal', 20, 20),
(21, 'Socket Programming', 20, 21),
(22, 'Deadlock Concepts', 30, 21),
(23, 'Threads vs Processes', 20, 21),
(24, 'Ternary Trees', 20, 21);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `StudentID` varchar(20) NOT NULL,
  `QuestionID` int(11) NOT NULL,
  `Mark` int(11) DEFAULT NULL,
  PRIMARY KEY (`StudentID`,`QuestionID`),
  KEY `QuestionID` (`QuestionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `StudentID` varchar(20) NOT NULL,
  `Major` varchar(50) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  PRIMARY KEY (`StudentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`StudentID`, `Major`, `LastName`, `FirstName`) VALUES
('amburg1', 'Computer Science', 'Amburg', 'Luba'),
('arias1', 'Physics', 'Arias', 'Kennith'),
('bakit4', 'Computer Science', 'Bakalashu', 'Virkit'),
('butley7', 'Computer Science', 'Butler', 'Ashley'),
('carlsc2', 'Computer Science', 'Carlson', 'Carl'),
('cwu19', 'Computer Science', 'Wu', 'ChengZhe'),
('damar4', 'Computer Engineering', 'Ramakrishna', 'Damaraju'),
('deeliz2', 'Computer Science', 'Deja', 'Elizabeth'),
('degrand1', 'Computer Science', 'DeGrand', 'Nathan'),
('freeman2', 'Computer Engineering', 'Freeman', 'Morgan'),
('freund3', 'Computer Science', 'Freund', 'Christopher'),
('garba2', 'Computer Science', 'Garbarz', 'Jennifer'),
('hingr1', 'Computer Science', 'Hinder', 'Grant'),
('karakus1', 'Computer Science', 'Karakus', 'Efe'),
('kovak4', 'Computer Engineering', 'Kovak', 'Natalie'),
('krahna3', 'Computer Science', 'Krahn', 'Adam'),
('loboda1', 'Computer Science', 'Loboda', 'Thomas'),
('margov3', 'Physics', 'Margovsky', 'Alexander'),
('mertck1', 'Computer Science', 'Mertes', 'Jack'),
('mushl5', 'Computer Science', 'Lee', 'Mushu'),
('newp3', 'Computer Engineering', 'Newman', 'Paul'),
('paam3', 'Computer Science', 'Martini', 'Paul'),
('pinkja3', 'Mathematics', 'Pinka', 'Jasmine'),
('pjha2', 'Computer Science', 'Jha', 'Prabhakar'),
('romex2', 'Computer Science', 'Romich', 'Alexander'),
('smithh9', 'Astronomy', 'Smith', 'Harry'),
('tuckc5', 'Computer Science', 'Tucker', 'Christopher'),
('wilry2', 'Economics', 'Kerry', 'Wilson');

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE IF NOT EXISTS `submission` (
  `AssnID` int(30) NOT NULL,
  `StudentID` varchar(20) NOT NULL,
  `Files` varchar(200) NOT NULL COMMENT 'The directory where the submission files are locatedt',
  `AssnFinalMark` double DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`AssnID`,`StudentID`),
  KEY `Student` (`StudentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`AssnID`, `StudentID`, `Files`, `AssnFinalMark`, `Timestamp`) VALUES
(1, 'degrand1', 'C:/xampp/htdocs/cs411', NULL, '2011-11-02 08:32:27'),
(2, 'arias1', 'C:/homework/myclass/thisone', 96, '2011-11-02 08:33:41'),
(2, 'butley7', 'C:/homework/myotherclass/coolClass', 78, '2011-11-02 08:34:17');

-- --------------------------------------------------------

--
-- Table structure for table `takes`
--

CREATE TABLE IF NOT EXISTS `takes` (
  `StudentID` varchar(20) NOT NULL,
  `CourseID` int(10) NOT NULL,
  `FinalMark` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`StudentID`,`CourseID`),
  KEY `Course` (`CourseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `takes`
--

INSERT INTO `takes` (`StudentID`, `CourseID`, `FinalMark`) VALUES
('amburg1', 1, ''),
('amburg1', 5, ''),
('amburg1', 10, ''),
('amburg1', 16, ''),
('arias1', 15, ''),
('arias1', 34, 'B+'),
('arias1', 37, 'A-'),
('bakit4', 3, ''),
('bakit4', 15, ''),
('bakit4', 19, ''),
('butley7', 4, ''),
('carlsc2', 28, ''),
('cwu19', 33, 'A'),
('cwu19', 37, 'A'),
('damar4', 33, 'D'),
('damar4', 34, 'C-'),
('deeliz2', 8, ''),
('degrand1', 13, ''),
('degrand1', 33, 'B'),
('freeman2', 28, ''),
('freund3', 35, 'A+'),
('garba2', 3, ''),
('hingr1', 25, ''),
('karakus1', 32, ''),
('kovak4', 6, ''),
('kovak4', 10, ''),
('krahna3', 30, ''),
('loboda1', 13, ''),
('loboda1', 34, 'A'),
('loboda1', 36, 'A'),
('margov3', 1, ''),
('mertck1', 22, ''),
('mushl5', 35, 'F'),
('mushl5', 37, 'F'),
('newp3', 9, ''),
('paam3', 27, ''),
('pinkja3', 6, ''),
('pjha2', 25, ''),
('romex2', 35, 'B+'),
('smithh9', 36, 'B+'),
('tuckc5', 24, ''),
('wilry2', 21, '');

-- --------------------------------------------------------

--
-- Table structure for table `teaches`
--

CREATE TABLE IF NOT EXISTS `teaches` (
  `InstructorID` varchar(20) NOT NULL,
  `CourseID` int(10) NOT NULL,
  PRIMARY KEY (`InstructorID`,`CourseID`),
  KEY `CourseID` (`CourseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teaches`
--

INSERT INTO `teaches` (`InstructorID`, `CourseID`) VALUES
('faaadi', 1),
('tuckr1', 2),
('bullock', 3),
('hushev', 4),
('brownp2', 5),
('linguo', 6),
('heeren', 7),
('rynsti', 8),
('krankj1', 9),
('armstc', 10),
('tuckr1', 11),
('markova', 12),
('armstc', 13),
('krankj1', 14),
('brownp2', 15),
('heeren', 17),
('vishnu1', 18),
('dragonia1', 19),
('junipe2', 20),
('junipe2', 21),
('ragnia', 22),
('markova', 23),
('hushev', 24),
('rynsti', 25),
('linguo', 31),
('smith2', 33),
('wuchen3', 34),
('wuchen3', 35),
('gleeter3', 36),
('linguo', 37);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `course` (`CourseID`) ON UPDATE CASCADE;

--
-- Constraints for table `automarking`
--
ALTER TABLE `automarking`
  ADD CONSTRAINT `automarking_ibfk_1` FOREIGN KEY (`AssnID`) REFERENCES `assignment` (`AssnID`) ON UPDATE CASCADE;

--
-- Constraints for table `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `group_ibfk_1` FOREIGN KEY (`AssnID`) REFERENCES `assignment` (`AssnID`) ON UPDATE CASCADE;

--
-- Constraints for table `memberof`
--
ALTER TABLE `memberof`
  ADD CONSTRAINT `memberof_ibfk_3` FOREIGN KEY (`AssnID`) REFERENCES `assignment` (`AssnID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `memberof_ibfk_1` FOREIGN KEY (`GroupName`) REFERENCES `group` (`GroupName`) ON UPDATE CASCADE,
  ADD CONSTRAINT `memberof_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`) ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`AssnID`) REFERENCES `assignment` (`AssnID`) ON UPDATE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`QuestionID`) REFERENCES `questions` (`QuestionID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`) ON UPDATE CASCADE;

--
-- Constraints for table `submission`
--
ALTER TABLE `submission`
  ADD CONSTRAINT `submission_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `submission_ibfk_1` FOREIGN KEY (`AssnID`) REFERENCES `assignment` (`AssnID`) ON UPDATE CASCADE;

--
-- Constraints for table `takes`
--
ALTER TABLE `takes`
  ADD CONSTRAINT `takes_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `course` (`CourseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `takes_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`) ON UPDATE CASCADE;

--
-- Constraints for table `teaches`
--
ALTER TABLE `teaches`
  ADD CONSTRAINT `teaches_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `course` (`CourseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `teaches_ibfk_1` FOREIGN KEY (`InstructorID`) REFERENCES `instructor` (`InstructorID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
