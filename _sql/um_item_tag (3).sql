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
(1, 'appliances'),
(1, 'electronic'),
(2, 'applicances'),
(2, 'electronic'),
(3, 'appliances'),
(3, 'books'),
(4, 'arts'),
(4, 'stationaries'),
(5, 'electronics'),
(5, 'electronic_accessories'),
(6, 'electronic_accessories'),
(7, 'electronic_accessories'),
(8, 'electronic_accessories'),
(9, 'appliances'),
(9, 'kitchen_utensils'),
(10, 'CD/DVD'),
(10, 'computers'),
(11, 'sports'),
(12, 'CD/DVD'),
(12, 'electronic'),
(13, 'books'),
(14, 'books'),
(14, 'religion'),
(15, 'CD/DVD'),
(15, 'electronics'),
(16, 'books'),
(17, 'CD/DVD'),
(17, 'electronics'),
(18, 'clothings'),
(19, 'electronics'),
(20, 'beauty_accessories'),
(20, 'jewelries'),
(21, 'appliances'),
(21, 'electronics'),
(22, 'beauty_accessories'),
(22, 'jewelries'),
(23, 'beauty_accessories'),
(23, 'watches'),
(24, 'sports'),
(25, 'computers'),
(25, 'electronics'),
(26, 'computers'),
(26, 'computers'),
(26, 'electronics'),
(26, 'electronics'),
(27, 'computers'),
(27, 'electronics'),
(28, 'computers'),
(28, 'electronics'),
(29, 'computers'),
(29, 'electronics'),
(30, 'computers'),
(30, 'electronics'),
(31, 'electronics'),
(31, 'kitchen_utensils'),
(32, 'arts');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
