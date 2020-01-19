-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 30, 2012 at 04:35 PM
-- Server version: 5.5.22
-- PHP Version: 5.3.16-pl1-gentoo

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Web`
--
CREATE DATABASE `Web` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `Web`;

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE IF NOT EXISTS `Comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `comment` varchar(255) NOT NULL DEFAULT 'comment not found',
  `user` varchar(16) NOT NULL DEFAULT 'uknown',
  `photo_id` bigint(11) NOT NULL,
  `com_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `photo_id` (`photo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

-- --------------------------------------------------------

--
-- Table structure for table `Likes`
--

CREATE TABLE IF NOT EXISTS `Likes` (
  `user_id` bigint(20) NOT NULL,
  `photo_id` bigint(20) NOT NULL,
  `likes` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`,`photo_id`),
  KEY `photo_id` (`photo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Photos`
--

CREATE TABLE IF NOT EXISTS `Photos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `user` varchar(16) NOT NULL,
  `description` text NOT NULL,
  `privacy` tinyint(1) NOT NULL,
  `tags` varchar(200) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `dislikes` int(11) NOT NULL DEFAULT '0',
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `upload_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=225 ;

-- --------------------------------------------------------

--
-- Table structure for table `Tagged`
--

CREATE TABLE IF NOT EXISTS `Tagged` (
  `tag_id` bigint(20) NOT NULL,
  `photo_id` bigint(20) NOT NULL,
  PRIMARY KEY (`tag_id`,`photo_id`),
  KEY `photo_id` (`photo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Tags`
--

CREATE TABLE IF NOT EXISTS `Tags` (
  `t_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tag` varchar(30) NOT NULL DEFAULT 'TagMe',
  `count` int(11) NOT NULL,
  PRIMARY KEY (`t_id`),
  UNIQUE KEY `tag` (`tag`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=176 ;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` char(40) NOT NULL,
  `email` varchar(80) NOT NULL,
  `space` float NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
