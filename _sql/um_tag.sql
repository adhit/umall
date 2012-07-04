-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 03, 2012 at 09:17 PM
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
-- Table structure for table `um_tag`
--

CREATE TABLE IF NOT EXISTS `um_tag` (
  `tagID` int(11) NOT NULL AUTO_INCREMENT,
  `tagname` varchar(64) NOT NULL,
  `special` varchar(8) NOT NULL,
  `timeCreated` datetime NOT NULL,
  PRIMARY KEY (`tagID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `um_tag`
--

INSERT INTO `um_tag` (`tagID`, `tagname`, `special`, `timeCreated`) VALUES
(1, 'book', 'no', '2011-12-11 00:00:00'),
(2, 'PC', 'no', '2011-12-11 00:00:00'),
(3, 'electronics', 'no', '2012-01-11 00:00:00'),
(4, 'CD/DVD', 'no', '2011-12-11 00:00:00'),
(5, 'bike', 'no', '2012-01-11 00:00:00'),
(6, 'mobile', 'no', '2011-12-11 00:00:00'),
(7, 'phone acc', 'no', '2011-12-11 00:00:00'),
(8, 'music', 'no', '2011-12-11 00:00:00'),
(9, 'sport', 'no', '2012-01-11 00:00:00'),
(10, 'bulk-sized', 'no', '2011-12-11 00:00:00'),
(11, 'appliances', 'no', '2011-12-11 00:00:00'),
(12, 'room rent', 'no', '2012-01-11 00:00:00'),
(14, 'service', 'no', '2012-07-01 00:00:00'),
(13, 'game', 'no', '2012-07-02 00:00:00'),
(18, 'NBS', 'yes', '2012-01-11 00:00:00'),
(19, 'SCE', 'yes', '2011-12-11 00:00:00'),
(20, 'SBS', 'yes', '2012-06-08 06:40:27'),
(21, 'ABC', 'yes', '2012-06-08 06:40:27'),
(22, 'ADM', 'yes', '2012-06-08 06:40:27'),
(23, 'CEE', 'yes', '2012-06-08 06:40:27'),
(24, 'EEE', 'yes', '2012-06-08 06:40:27'),
(25, 'HSS', 'yes', '2012-06-08 06:40:27'),
(26, 'MAE', 'yes', '2012-06-08 06:40:27'),
(27, 'MSE', 'yes', '2012-06-08 06:40:27'),
(28, 'SCBE', 'yes', '2012-06-08 06:40:27'),
(29, 'SCI', 'yes', '2012-06-08 06:40:27'),
(30, 'SPMS', 'yes', '2012-06-08 06:40:27'),
(31, 'NIE', 'yes', '2012-06-08 06:40:27'),
(32, 'CAC', 'yes', '2012-06-08 06:40:27'),
(33, 'Sports Club', 'yes', '2012-06-08 06:40:27'),
(34, 'WSC', 'yes', '2012-06-08 06:40:27'),
(15, 'luxury', 'no', '2012-07-02 05:13:31'),
(16, 'clothing', 'no', '2012-07-01 05:13:36');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
