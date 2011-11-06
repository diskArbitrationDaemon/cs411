-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2011 at 05:13 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.4

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
('amburg1', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('arias1', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('armstc', 'f30aa7a662c728b7407c54ae6bfd27d1', 2),
('bakit4', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('brownp2', 'f30aa7a662c728b7407c54ae6bfd27d1', 2),
('bullock', 'f30aa7a662c728b7407c54ae6bfd27d1', 2),
('butley7', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('carlsc2', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('cwu19', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('damar4', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('deeliz2', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('degrand1', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('dragonia1', 'f30aa7a662c728b7407c54ae6bfd27d1', 2),
('faaadi', 'f30aa7a662c728b7407c54ae6bfd27d1', 2),
('freeman2', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('freund3', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('garba2', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('gleeter3', 'f30aa7a662c728b7407c54ae6bfd27d1', 2),
('heeren', 'f30aa7a662c728b7407c54ae6bfd27d1', 2),
('hingr1', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('hushev', 'f30aa7a662c728b7407c54ae6bfd27d1', 2),
('junipe2', 'f30aa7a662c728b7407c54ae6bfd27d1', 2),
('karakus1', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('kovak4', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('krahna3', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('krankj1', 'f30aa7a662c728b7407c54ae6bfd27d1', 2),
('linguo', 'f30aa7a662c728b7407c54ae6bfd27d1', 2),
('loboda1', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('margov3', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('markova', 'f30aa7a662c728b7407c54ae6bfd27d1', 2),
('mertck1', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('mushl5', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('newp3', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('paam3', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('pinkja3', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('pjha2', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('ragnia', 'f30aa7a662c728b7407c54ae6bfd27d1', 2),
('romex2', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('rynsti', 'f30aa7a662c728b7407c54ae6bfd27d1', 2),
('smith2', 'f30aa7a662c728b7407c54ae6bfd27d1', 2),
('smithh9', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('tuckc5', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('tuckr1', 'f30aa7a662c728b7407c54ae6bfd27d1', 2),
('vishnu1', 'f30aa7a662c728b7407c54ae6bfd27d1', 2),
('wilry2', 'f30aa7a662c728b7407c54ae6bfd27d1', 4),
('wuchen3', 'f30aa7a662c728b7407c54ae6bfd27d1', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
