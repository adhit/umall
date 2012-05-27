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
-- Table structure for table `um_item_tag`
--

CREATE TABLE IF NOT EXISTS `um_item_tag` (
  `itemID` int(10) NOT NULL,
  `tagID` varchar(32) NOT NULL,
  KEY `itemID` (`itemID`,`tagID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `um_item_tag`
--

INSERT INTO `um_item_tag` (`itemID`, `tagID`) VALUES
(1, '1'),
(1, '13'),
(2, '15'),
(2, '3'),
(3, '1'),
(3, '4'),
(4, '18'),
(4, '2'),
(5, '13'),
(5, '8'),
(6, '3'),
(7, '9'),
(8, '12'),
(9, '1'),
(9, '15'),
(10, '5'),
(10, '7'),
(11, '17'),
(12, '12'),
(12, '5'),
(13, '4'),
(14, '14'),
(14, '4'),
(15, '5'),
(15, '8'),
(16, '4'),
(17, '5'),
(17, '8'),
(18, '6'),
(19, '8'),
(20, ''),
(20, '11'),
(21, '1'),
(21, '8'),
(22, ''),
(22, '11'),
(23, ''),
(23, '19'),
(24, '17'),
(25, '7'),
(25, '8'),
(26, '7'),
(26, '7'),
(26, '8'),
(26, '8'),
(27, '7'),
(27, '8'),
(28, '7'),
(28, '8'),
(29, '7'),
(29, '8'),
(30, '7'),
(30, '8'),
(31, ''),
(31, '8'),
(32, '2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
