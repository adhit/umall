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
-- Table structure for table `um_tag`
--

CREATE TABLE IF NOT EXISTS `um_tag` (
  `tagID` int(11) NOT NULL AUTO_INCREMENT,
  `tagname` varchar(32) NOT NULL,
  `special` varchar(3) NOT NULL,
  `timeCreated` datetime NOT NULL,
  PRIMARY KEY (`tagID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `um_tag`
--

INSERT INTO `um_tag` (`tagID`, `tagname`, `special`, `timeCreated`) VALUES
(1, 'appliances', 'no', '2011-12-11 00:00:00'),
(2, 'arts', 'no', '2011-12-11 00:00:00'),
(3, 'beauty accessories', 'no', '2012-01-11 00:00:00'),
(4, 'books', 'no', '2011-12-11 00:00:00'),
(5, 'CD/DVD', 'no', '2012-01-11 00:00:00'),
(6, 'clothings', 'no', '2011-12-11 00:00:00'),
(7, 'computers', 'no', '2011-12-11 00:00:00'),
(8, 'electronics', 'no', '2011-12-11 00:00:00'),
(9, 'electronic accessories', 'no', '2012-01-11 00:00:00'),
(10, 'handphones', 'no', '2011-12-11 00:00:00'),
(11, 'jewelries', 'no', '2011-12-11 00:00:00'),
(12, 'kitchen utensils', 'no', '2012-01-11 00:00:00'),
(13, 'NBS', 'yes', '2011-12-11 00:00:00'),
(14, 'religion', 'no', '2012-01-11 00:00:00'),
(15, 'SCE', 'yes', '2011-12-11 00:00:00'),
(16, 'shoes', 'no', '2011-12-11 00:00:00'),
(17, 'sports', 'no', '2011-12-11 00:00:00'),
(18, 'stationaries', 'no', '2012-01-11 00:00:00'),
(19, 'watches', 'no', '2011-12-11 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
