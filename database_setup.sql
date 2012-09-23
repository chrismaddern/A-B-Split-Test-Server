-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 23, 2012 at 02:46 PM
-- Server version: 5.1.63
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chrincom_abtest`
--
CREATE DATABASE `chrincom_abtest` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `chrincom_abtest`;

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE IF NOT EXISTS `applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `token`, `name`) VALUES
(1, 1, 'com.chrismaddern.abtestsampleapp', 'ABSampleApp');

-- --------------------------------------------------------

--
-- Table structure for table `test_case_responses`
--

CREATE TABLE IF NOT EXISTS `test_case_responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test_case_id` int(11) NOT NULL,
  `device_token` varchar(250) NOT NULL,
  `outcome` int(11) NOT NULL,
  `value` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;


-- --------------------------------------------------------

--
-- Table structure for table `test_case_values`
--

CREATE TABLE IF NOT EXISTS `test_case_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test_case_id` int(11) NOT NULL,
  `value` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `test_case_values`
--

INSERT INTO `test_case_values` (`id`, `test_case_id`, `value`) VALUES
(1, 1, 'Button Text Case 1'),
(2, 1, 'Button Text Case 2'),
(7, 3, 'http://chrismaddern.com/abtest/images/green_button.png'),
(4, 1, 'Button Text Case 3'),
(6, 3, 'http://chrismaddern.com/abtest/images/blue_button.png');

-- --------------------------------------------------------

--
-- Table structure for table `test_cases`
--

CREATE TABLE IF NOT EXISTS `test_cases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `token` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `test_cases`
--

INSERT INTO `test_cases` (`id`, `application_id`, `name`, `token`) VALUES
(1, 1, 'Next Button Text', 'next_button_text'),
(2, 1, 'Next Button Color', 'next_button_color'),
(3, 1, 'Image Switcher', 'image_test');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password_hash`) VALUES
(1, 'you@user.com', '1234');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
