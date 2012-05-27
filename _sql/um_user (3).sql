-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 27, 2012 at 01:18 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ntusu2_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `um_user`
--

CREATE TABLE IF NOT EXISTS `um_user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `timeCreated` datetime NOT NULL,
  `timeEdited` datetime NOT NULL,
  `email` varchar(64) NOT NULL,
  `enabled` varchar(3) NOT NULL,
  `contactNumber` varchar(32) DEFAULT NULL,
  `type` varchar(7) NOT NULL,
  `tagID` varchar(32) DEFAULT NULL,
  `show` varchar(3) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`userID`),
  UNIQUE KEY `username` (`username`),
  KEY `tagID` (`tagID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `um_user`
--

INSERT INTO `um_user` (`userID`, `username`, `pass`, `name`, `timeCreated`, `timeEdited`, `email`, `enabled`, `contactNumber`, `type`, `tagID`, `show`) VALUES
(1, 'adhit', 'f117b1c43ff2a7aa7883c193b14c8c8b', NULL, '2012-01-17 13:44:49', '2012-01-17 13:44:49', 'rein0002@ntu.edu.sg', 'yes', '87654321', 'student', NULL, 'yes'),
(2, 'admin', 'f117b1c43ff2a7aa7883c193b14c8c8b', 'Administrator', '2011-12-11 00:00:00', '2011-12-11 00:00:00', 's.pradhitya@gmail.com', 'yes', '87654320', 'admin', NULL, 'yes'),
(3, 'ichope', '44a482a4f1209449d893a62d3df8408f', NULL, '2012-01-16 12:53:03', '2012-01-16 12:53:03', 'reza0008@ntu.edu.sg', 'yes', '96449608', 'student', NULL, 'yes'),
(4, 'nbsclub', 'f117b1c43ff2a7aa7883c193b14c8c8b', 'NBS Club', '2011-12-11 00:00:00', '2011-12-11 00:00:00', 'nbs@ntu.edu.sg', 'yes', '88888888', 'special', '13', 'yes'),
(5, 'otherclub', 'f117b1c43ff2a7aa7883c193b14c8c8b', 'Other Club', '2011-12-11 00:00:00', '2011-12-11 00:00:00', 'otherclub@ntu.edu.sg', 'no', '66666666', 'special', NULL, 'yes'),
(6, 'sceclub', 'f117b1c43ff2a7aa7883c193b14c8c8b', 'SCE Club', '2011-12-11 00:00:00', '2011-12-11 00:00:00', 'sceclub@ntu.edu.sg', 'yes', '77777777', 'special', '15', 'yes'),
(7, 'user0001', 'f117b1c43ff2a7aa7883c193b14c8c8b', 'User One', '2011-12-11 00:00:00', '2011-12-11 00:00:00', 'user0001@ntu.edu.sg', 'yes', '11111111', 'student', NULL, 'yes'),
(8, 'user0002', 'f117b1c43ff2a7aa7883c193b14c8c8b', 'User Two', '2011-12-11 00:00:00', '2011-12-11 00:00:00', 'user0002@ntu.edu.sg', 'yes', '22222222', 'student', NULL, 'yes'),
(9, 'user0003', 'f117b1c43ff2a7aa7883c193b14c8c8b', 'User Three', '2011-12-11 00:00:00', '2011-12-11 00:00:00', 'user0003@ntu.edu.sg', 'yes', '33333332', 'student', NULL, 'yes'),
(10, 'user0004', 'f117b1c43ff2a7aa7883c193b14c8c8b', 'User Four', '2011-12-11 00:00:00', '2011-12-11 00:00:00', 'user0004@ntu.edu.sg', 'yes', '44444444', 'student', NULL, 'yes'),
(11, 'user0005', 'f117b1c43ff2a7aa7883c193b14c8c8b', 'User Five', '2011-12-11 00:00:00', '2011-12-11 00:00:00', 'user0005@ntu.edu.sg', 'no', '55555555', 'student', NULL, 'yes');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
