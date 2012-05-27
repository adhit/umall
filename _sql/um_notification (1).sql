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
-- Table structure for table `um_notification`
--

CREATE TABLE IF NOT EXISTS `um_notification` (
  `notifID` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(11) NOT NULL,
  `status` varchar(11) NOT NULL,
  `userID` varchar(255) NOT NULL,
  `bidID` int(11) NOT NULL,
  `otherID` varchar(255) DEFAULT NULL,
  `timeCreated` datetime NOT NULL,
  `timeEdited` datetime NOT NULL,
  PRIMARY KEY (`notifID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `um_notification`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
