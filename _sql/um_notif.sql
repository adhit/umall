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
-- Table structure for table `um_notif`
--

CREATE TABLE IF NOT EXISTS `um_notif` (
  `notifID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `otherID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `bidID` int(11) NOT NULL,
  `type` varchar(16) NOT NULL,
  `status` varchar(8) NOT NULL,
  `timeCreated` datetime NOT NULL,
  `timeEdited` datetime NOT NULL,
  PRIMARY KEY (`notifID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `um_notif`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
