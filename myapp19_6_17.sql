-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 19, 2017 at 05:16 PM
-- Server version: 5.5.54-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `created_date` datetime NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `created_date` datetime NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `relationships`
--

CREATE TABLE IF NOT EXISTS `relationships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `relation` varchar(255) NOT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `created_date` datetime NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `relationships`
--

INSERT INTO `relationships` (`id`, `relation`, `status`, `created_date`, `modified_date`) VALUES
(1, 'Father', 'ACTIVE', '2017-05-04 06:40:06', '2017-05-04 06:40:06'),
(2, 'Mother', 'ACTIVE', '2017-05-04 06:49:35', '2017-05-04 06:49:35'),
(3, 'Brother', 'INACTIVE', '2017-05-04 06:49:58', '2017-05-04 06:49:58');

-- --------------------------------------------------------

--
-- Table structure for table `relation_events`
--

CREATE TABLE IF NOT EXISTS `relation_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `relation_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `relation_id` (`relation_id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `request_log`
--

CREATE TABLE IF NOT EXISTS `request_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_path` varchar(200) DEFAULT NULL,
  `get_data` text,
  `post_data` text,
  `return_data` text,
  `request_time` datetime DEFAULT NULL,
  `return_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `profile_picture` varchar(200) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `access_token` varchar(200) DEFAULT NULL,
  `fb_token` varchar(200) DEFAULT NULL,
  `user_type` enum('ADMIN','CUSTOMER','','') DEFAULT 'CUSTOMER',
  `timezone` varchar(255) NOT NULL,
  `user_status` enum('ACTIVE','INACTIVE','','') NOT NULL DEFAULT 'INACTIVE' COMMENT 'To identyfy the user is dead or alive',
  `profile_status` enum('ACTIVE','INACTIVE','','') NOT NULL DEFAULT 'INACTIVE' COMMENT 'only active user can login ',
  `created_date` datetime NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `full_name`, `password`, `profile_picture`, `dob`, `access_token`, `fb_token`, `user_type`, `timezone`, `user_status`, `profile_status`, `created_date`, `modified_date`) VALUES
(1, 'anishpali1@gmail.com', 'Admin admin22', '$2y$13$SZfyKuvQSn1aKdgbzunsquYplPij24gNdJkgc9oJ4eCEtVj8LURWK', '1844427410.jpg', NULL, '06D4C20FFDB53EECE6D9F48D4C90E22F', '', 'ADMIN', 'Asia/Kolkata', 'INACTIVE', 'ACTIVE', '2017-04-21 00:00:00', '2017-06-19 11:41:17');

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE IF NOT EXISTS `user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Token to varify user email' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `webservice`
--

CREATE TABLE IF NOT EXISTS `webservice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `device_type` enum('Android','IOS','Web') NOT NULL,
  `device_token` varchar(200) NOT NULL,
  `push_token` varchar(200) NOT NULL,
  `access_token` varchar(200) DEFAULT NULL,
  `login_status` enum('LoggedIn','LoggedOut') NOT NULL DEFAULT 'LoggedIn',
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `created_date` datetime NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `relation_events`
--
ALTER TABLE `relation_events`
  ADD CONSTRAINT `relation_events_ibfk_1` FOREIGN KEY (`relation_id`) REFERENCES `relationships` (`id`),
  ADD CONSTRAINT `relation_events_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `webservice`
--
ALTER TABLE `webservice`
  ADD CONSTRAINT `webservice_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
