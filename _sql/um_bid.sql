-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 03, 2012 at 08:56 PM
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
  `approved` varchar(8) NOT NULL,
  `timeCreated` datetime NOT NULL,
  `timeEdited` datetime NOT NULL,
  PRIMARY KEY (`bidID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

--
-- Dumping data for table `um_bid`
--

INSERT INTO `um_bid` (`bidID`, `itemID`, `userID`, `price`, `approved`, `timeCreated`, `timeEdited`) VALUES
(53, 2, 7, 40, 'yes', '2012-03-09 18:40:19', '2012-03-09 18:40:19'),
(54, 3, 7, 80, 'yes', '2012-03-09 18:40:25', '2012-03-09 18:40:25'),
(55, 4, 7, 8, 'no', '2012-03-09 18:40:31', '2012-06-17 09:06:57'),
(56, 5, 7, 3, 'no', '2012-03-09 18:40:40', '2012-03-09 18:40:40'),
(57, 1, 8, 80, 'yes', '2012-03-09 18:42:51', '2012-03-09 18:42:51'),
(58, 3, 8, 79, 'no', '2012-03-09 18:43:30', '2012-03-09 18:43:30'),
(59, 4, 8, 11, 'yes', '2012-03-09 18:43:39', '2012-03-09 18:43:39'),
(60, 5, 8, 3, 'no', '2012-03-09 18:43:47', '2012-03-09 18:43:47'),
(61, 1, 9, 82, 'yes', '2012-03-09 18:44:26', '2012-03-09 18:44:26'),
(62, 2, 9, 39, 'no', '2012-03-09 18:46:10', '2012-03-09 18:46:10'),
(63, 4, 9, 12, 'yes', '2012-03-09 18:46:51', '2012-03-09 18:46:51'),
(64, 5, 9, 4, 'no', '2012-03-09 18:47:01', '2012-03-09 18:47:01'),
(65, 1, 10, 83, 'yes', '2012-03-09 18:47:35', '2012-06-17 11:06:57'),
(66, 2, 10, 40, 'no', '2012-03-09 18:47:49', '2012-03-09 18:47:49'),
(67, 3, 10, 82, 'yes', '2012-03-09 18:47:58', '2012-07-03 08:07:48'),
(68, 5, 10, 5, 'no', '2012-03-09 18:48:25', '2012-03-09 18:48:25'),
(69, 10, 7, 72, 'yes', '2012-03-13 20:59:00', '2012-03-13 20:59:00'),
(70, 31, 8, 110, 'yes', '2012-05-16 17:02:17', '2012-05-16 17:02:17'),
(75, 7, 7, 20, 'no', '2012-06-17 09:06:27', '2012-06-17 09:06:26'),
(76, 18, 7, 150, 'no', '2012-07-01 14:07:14', '2012-07-01 14:07:20'),
(77, 6, 7, 43, 'yes', '2012-07-01 16:07:06', '2012-07-01 16:07:06'),
(78, 19, 7, 190, 'no', '2012-07-02 04:07:19', '2012-07-02 04:07:19'),
(79, 19, 10, 195, 'no', '2012-07-03 07:07:35', '2012-07-03 07:07:56'),
(80, 6, 10, 43, 'yes', '2012-07-03 07:07:19', '2012-07-03 07:07:19'),
(81, 50, 7, 90, 'no', '2012-07-03 11:07:57', '2012-07-03 11:07:57');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
