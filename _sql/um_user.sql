-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 10, 2012 at 03:20 AM
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
  `pass` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `enabled` varchar(8) NOT NULL,
  `contactNumber` varchar(32) NOT NULL,
  `show` varchar(8) NOT NULL,
  `type` varchar(8) NOT NULL,
  `tagID` int(11) NOT NULL,
  `timeCreated` datetime NOT NULL,
  `timeEdited` datetime NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `um_user`
--

INSERT INTO `um_user` (`userID`, `username`, `pass`, `name`, `email`, `enabled`, `contactNumber`, `show`, `type`, `tagID`, `timeCreated`, `timeEdited`) VALUES
(2, 'admin', 'f117b1c43ff2a7aa7883c193b14c8c8b', 'Administrator', 's.pradhitya@gmail.com', 'yes', '87654320', 'yes', 'admin', 0, '2011-12-11 00:00:00', '2011-12-11 00:00:00'),
(3, 'ichope', '44a482a4f1209449d893a62d3df8408f', '', 'reza0008@ntu.edu.sg', 'yes', '96449608', 'yes', 'student', 0, '2012-01-16 12:53:03', '2012-01-16 12:53:03'),
(4, 'nbsclub', 'f117b1c43ff2a7aa7883c193b14c8c8b', 'NBS Club', 'nbs@ntu.edu.sg', 'yes', '88888888', 'yes', 'special', 13, '2011-12-11 00:00:00', '2011-12-11 00:00:00'),
(5, 'otherclub', 'f117b1c43ff2a7aa7883c193b14c8c8b', 'Other Club', 'otherclub@ntu.edu.sg', 'no', '66666666', 'yes', 'special', 0, '2011-12-11 00:00:00', '2011-12-11 00:00:00'),
(6, 'sceclub', 'f117b1c43ff2a7aa7883c193b14c8c8b', 'SCE Club', 'sceclub@ntu.edu.sg', 'yes', '77777777', 'yes', 'special', 15, '2011-12-11 00:00:00', '2011-12-11 00:00:00'),
(7, 'user0001', 'f117b1c43ff2a7aa7883c193b14c8c8b', 'User One', 'user0001@ntu.edu.sg', 'yes', '11111111', 'yes', 'student', 0, '2011-12-11 00:00:00', '2011-12-11 00:00:00'),
(8, 'user0002', 'f117b1c43ff2a7aa7883c193b14c8c8b', 'User Two', 'user0002@ntu.edu.sg', 'yes', '22222222', 'yes', 'student', 0, '2011-12-11 00:00:00', '2011-12-11 00:00:00'),
(9, 'user0003', 'f117b1c43ff2a7aa7883c193b14c8c8b', 'User Three', 'user0003@ntu.edu.sg', 'yes', '33333332', 'yes', 'student', 0, '2011-12-11 00:00:00', '2011-12-11 00:00:00'),
(10, 'user0004', 'f117b1c43ff2a7aa7883c193b14c8c8b', 'User Four', 'user0004@ntu.edu.sg', 'yes', '44444444', 'yes', 'student', 0, '2011-12-11 00:00:00', '2011-12-11 00:00:00'),
(11, 'user0005', 'f117b1c43ff2a7aa7883c193b14c8c8b', 'User Five', 'user0005@ntu.edu.sg', 'no', '55555555', 'yes', 'student', 0, '2011-12-11 00:00:00', '2011-12-11 00:00:00'),
(12, 'rein0002', '6bb00b2b72300e103b04b25d77ff9993', 'Reinardus Pradhitya', 'rein0002@ntu.edu.sg', 'yes', '83612737', 'yes', 'student', 0, '2012-06-10 03:06:57', '2012-06-10 03:06:58'),
(13, 'rein0002', 'f117b1c43ff2a7aa7883c193b14c8c8b', 'Reinardus Pradhitya', 'rein0002@ntu.edu.sg', 'pending', '87654321', 'yes', 'student', 0, '2012-06-10 03:06:15', '2012-06-10 03:06:15');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
