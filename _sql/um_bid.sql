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
-- Table structure for table `um_bid`
--

CREATE TABLE IF NOT EXISTS `um_bid` (
  `bidID` int(11) NOT NULL AUTO_INCREMENT,
  `itemID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `approved_qty` int(11) NOT NULL,
  `partial` varchar(8) NOT NULL,
  `approved` varchar(8) NOT NULL,
  `timeCreated` datetime NOT NULL,
  `timeEdited` datetime NOT NULL,
  PRIMARY KEY (`bidID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `um_bid`
--

INSERT INTO `um_bid` (`bidID`, `itemID`, `userID`, `price`, `qty`, `approved_qty`, `partial`, `approved`, `timeCreated`, `timeEdited`) VALUES
(53, 2, 7, 40, 1, 1, 'no', 'yes', '2012-03-09 18:40:19', '2012-03-09 18:40:19'),
(54, 3, 7, 80, 1, 1, 'no', 'yes', '2012-03-09 18:40:25', '2012-03-09 18:40:25'),
(55, 4, 7, 9, 3, 0, 'no', 'no', '2012-03-09 18:40:31', '2012-03-09 18:40:31'),
(56, 5, 7, 3, 2, 0, 'no', 'no', '2012-03-09 18:40:40', '2012-03-09 18:40:40'),
(57, 1, 8, 80, 2, 2, 'no', 'yes', '2012-03-09 18:42:51', '2012-03-09 18:42:51'),
(58, 3, 8, 79, 2, 0, 'no', 'no', '2012-03-09 18:43:30', '2012-03-09 18:43:30'),
(59, 4, 8, 11, 2, 0, 'no', 'no', '2012-03-09 18:43:39', '2012-03-09 18:43:39'),
(60, 5, 8, 3, 3, 0, 'no', 'no', '2012-03-09 18:43:47', '2012-03-09 18:43:47'),
(61, 1, 9, 82, 2, 2, 'no', 'yes', '2012-03-09 18:44:26', '2012-03-09 18:44:26'),
(62, 2, 9, 39, 2, 0, 'no', 'no', '2012-03-09 18:46:10', '2012-03-09 18:46:10'),
(63, 4, 9, 12, 1, 0, 'no', 'no', '2012-03-09 18:46:51', '2012-03-09 18:46:51'),
(64, 5, 9, 4, 3, 0, 'no', 'no', '2012-03-09 18:47:01', '2012-03-09 18:47:01'),
(65, 1, 10, 83, 1, 0, 'no', 'no', '2012-03-09 18:47:35', '2012-03-09 18:47:35'),
(66, 2, 10, 40, 2, 0, 'no', 'no', '2012-03-09 18:47:49', '2012-03-09 18:47:49'),
(67, 3, 10, 81, 2, 0, 'no', 'no', '2012-03-09 18:47:58', '2012-03-09 18:47:58'),
(68, 5, 10, 5, 1, 0, 'no', 'no', '2012-03-09 18:48:25', '2012-03-09 18:48:25'),
(69, 10, 7, 72, 1, 1, 'no', 'yes', '2012-03-13 20:59:00', '2012-03-13 20:59:00'),
(70, 31, 8, 110, 1, 1, 'no', 'yes', '2012-05-16 17:02:17', '2012-05-16 17:02:17');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
