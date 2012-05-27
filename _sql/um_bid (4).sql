-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 27, 2012 at 01:49 PM
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
-- Table structure for table `um_bid`
--

CREATE TABLE IF NOT EXISTS `um_bid` (
  `bidID` int(10) NOT NULL AUTO_INCREMENT,
  `itemID` int(10) NOT NULL,
  `userID` varchar(32) NOT NULL,
  `timeCreated` datetime NOT NULL,
  `timeEdited` datetime NOT NULL,
  `price` float NOT NULL,
  `approved` varchar(3) NOT NULL DEFAULT 'no',
  `qty` int(11) NOT NULL DEFAULT '1',
  `approved_qty` int(11) NOT NULL DEFAULT '0',
  `partial` varchar(3) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`bidID`),
  KEY `itemID` (`itemID`,`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `um_bid`
--

INSERT INTO `um_bid` (`bidID`, `itemID`, `userID`, `timeCreated`, `timeEdited`, `price`, `approved`, `qty`, `approved_qty`, `partial`) VALUES
(53, 2, '7', '2012-03-09 18:40:19', '2012-03-09 18:40:19', 40, 'yes', 1, 1, 'no'),
(54, 3, '7', '2012-03-09 18:40:25', '2012-03-09 18:40:25', 80, 'yes', 1, 1, 'no'),
(55, 4, '7', '2012-03-09 18:40:31', '2012-03-09 18:40:31', 9, 'no', 3, 0, 'no'),
(56, 5, '7', '2012-03-09 18:40:40', '2012-03-09 18:40:40', 3, 'no', 2, 0, 'no'),
(57, 1, '8', '2012-03-09 18:42:51', '2012-03-09 18:42:51', 80, 'yes', 2, 2, 'no'),
(58, 3, '8', '2012-03-09 18:43:30', '2012-03-09 18:43:30', 79, 'no', 2, 0, 'no'),
(59, 4, '8', '2012-03-09 18:43:39', '2012-03-09 18:43:39', 11, 'no', 2, 0, 'no'),
(60, 5, '8', '2012-03-09 18:43:47', '2012-03-09 18:43:47', 3, 'no', 3, 0, 'no'),
(61, 1, '9', '2012-03-09 18:44:26', '2012-03-09 18:44:26', 82, 'yes', 2, 2, 'no'),
(62, 2, '9', '2012-03-09 18:46:10', '2012-03-09 18:46:10', 39, 'no', 2, 0, 'no'),
(63, 4, '9', '2012-03-09 18:46:51', '2012-03-09 18:46:51', 12, 'no', 1, 0, 'no'),
(64, 5, '9', '2012-03-09 18:47:01', '2012-03-09 18:47:01', 4, 'no', 3, 0, 'no'),
(65, 1, '10', '2012-03-09 18:47:35', '2012-03-09 18:47:35', 83, 'no', 1, 0, 'no'),
(66, 2, '10', '2012-03-09 18:47:49', '2012-03-09 18:47:49', 40, 'no', 2, 0, 'no'),
(67, 3, '10', '2012-03-09 18:47:58', '2012-03-09 18:47:58', 81, 'no', 2, 0, 'no'),
(68, 5, '10', '2012-03-09 18:48:25', '2012-03-09 18:48:25', 5, 'no', 1, 0, 'no'),
(69, 10, '7', '2012-03-13 20:59:00', '2012-03-13 20:59:00', 72, 'yes', 1, 1, 'no'),
(70, 31, '8', '2012-05-16 17:02:17', '2012-05-16 17:02:17', 110, 'yes', 1, 1, 'no');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
