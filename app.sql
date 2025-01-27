-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 07, 2013 at 10:31 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `app`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_tb_forms`
--

CREATE TABLE IF NOT EXISTS `app_tb_forms` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `_name` varchar(32) NOT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `app_tb_forms`
--

INSERT INTO `app_tb_forms` (`_id`, `_name`) VALUES
(1, 'Form'),
(2, 'Form'),
(3, 'Form'),
(4, 'Form'),
(5, 'Form'),
(6, 'Form');

-- --------------------------------------------------------

--
-- Table structure for table `app_tb_items`
--

CREATE TABLE IF NOT EXISTS `app_tb_items` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `_text` varchar(512) NOT NULL,
  `_required` tinyint(4) NOT NULL,
  `_form` int(11) NOT NULL,
  PRIMARY KEY (`_id`),
  KEY `_form` (`_form`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `app_tb_items`
--

INSERT INTO `app_tb_items` (`_id`, `_text`, `_required`, `_form`) VALUES
(1, '11', 1, 1),
(2, '22', 0, 1),
(3, '33', 1, 2),
(4, '44', 0, 2),
(5, '55', 1, 3),
(6, '66', 0, 3),
(7, '77', 1, 4),
(8, '88', 0, 4),
(9, '77', 1, 5),
(10, '88', 0, 5),
(11, '99', 0, 5),
(12, '77', 1, 6),
(13, '88', 0, 6),
(14, '99', 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `app_tb_plugins`
--

CREATE TABLE IF NOT EXISTS `app_tb_plugins` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `_url` varchar(32) NOT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `app_tb_plugins`
--

INSERT INTO `app_tb_plugins` (`_id`, `_url`) VALUES
(1, 'test.txt'),
(2, 'test2.txt'),
(3, 'test3.txt'),
(4, 'test4.txt'),
(5, 'index.htm'),
(6, 'index.php');

-- --------------------------------------------------------

--
-- Table structure for table `app_tb_settings`
--

CREATE TABLE IF NOT EXISTS `app_tb_settings` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `_key` varchar(32) NOT NULL,
  `_value` varchar(256) NOT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `app_tb_settings`
--

INSERT INTO `app_tb_settings` (`_id`, `_key`, `_value`) VALUES
(1, 'home', '7');

-- --------------------------------------------------------

--
-- Stand-in structure for view `app_vw_plugins`
--
CREATE TABLE IF NOT EXISTS `app_vw_plugins` (
`_id` int(11)
,`_url` varchar(32)
,`_enabled` int(0)
);
-- --------------------------------------------------------

--
-- Structure for view `app_vw_plugins`
--
DROP TABLE IF EXISTS `app_vw_plugins`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `app_vw_plugins` AS select `p`.`_id` AS `_id`,`p`.`_url` AS `_url`,(case when isnull(`s`.`_value`) then 0 else 1 end) AS `_enabled` from (`app_tb_plugins` `p` left join `app_tb_settings` `s` on(((`s`.`_key` = 'home') and (`s`.`_value` = `p`.`_id`))));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
