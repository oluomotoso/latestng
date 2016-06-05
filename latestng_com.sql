-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2015 at 09:23 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `latestng_com`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `feed_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_feed_comment` (`feed_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `content_categories`
--

CREATE TABLE IF NOT EXISTS `content_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `tags` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Table structure for table `content_source`
--

CREATE TABLE IF NOT EXISTS `content_source` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url_UNIQUE` (`url`),
  KEY `FK_source_created_by` (`created_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `facebook_accounts`
--

CREATE TABLE IF NOT EXISTS `facebook_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facebook_id` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `refresh_token` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_info` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `facebook_id` (`facebook_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `facebook_edges`
--

CREATE TABLE IF NOT EXISTS `facebook_edges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `facebook_id` varchar(255) NOT NULL,
  `facebook_account_owner` int(11) NOT NULL,
  `edge_type` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `response` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `facebook_id` (`facebook_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news_feed`
--

CREATE TABLE IF NOT EXISTS `news_feed` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `feed_title` varchar(255) NOT NULL,
  `feed_url` varchar(200) DEFAULT NULL,
  `feed_category` varchar(255) DEFAULT NULL,
  `feed_description` text,
  `feed_content` text,
  `created_at` datetime NOT NULL,
  `feed_source_date` datetime DEFAULT NULL,
  `content_source` int(10) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `music_url` varchar(100) DEFAULT NULL,
  `video_url` varchar(100) DEFAULT NULL,
  `site_url` varchar(100) DEFAULT NULL,
  `facebook` int(11) unsigned NOT NULL DEFAULT '0',
  `twitter` int(11) unsigned NOT NULL DEFAULT '0',
  `read_counter` int(11) unsigned NOT NULL DEFAULT '0',
  `updated_at` datetime NOT NULL,
  `approved_by` int(10) unsigned DEFAULT NULL,
  `publish_status` int(10) unsigned NOT NULL DEFAULT '1',
  `thumb_image` varchar(255) DEFAULT NULL,
  `shares` int(10) NOT NULL DEFAULT '0',
  `image_upload_url` varchar(255) DEFAULT NULL,
  `perm_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `feed_url` (`feed_url`),
  KEY `FK_feed_source` (`content_source`),
  KEY `FK_publish_approved` (`approved_by`),
  KEY `FK_publish_status` (`publish_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

-- --------------------------------------------------------

--
-- Table structure for table `pending_feed`
--

CREATE TABLE IF NOT EXISTS `pending_feed` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `feed_title` varchar(255) NOT NULL,
  `feed_url` varchar(200) DEFAULT NULL,
  `feed_category` varchar(255) DEFAULT NULL,
  `feed_description` text,
  `feed_content` text,
  `created_at` datetime NOT NULL,
  `feed_source_date` datetime DEFAULT NULL,
  `content_source` int(10) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `music_url` varchar(100) DEFAULT NULL,
  `video_url` varchar(100) DEFAULT NULL,
  `site_url` varchar(100) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `publish_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `feed_url` (`feed_url`),
  KEY `FK_feed_source` (`content_source`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=130 ;

-- --------------------------------------------------------

--
-- Table structure for table `publish_status`
--

CREATE TABLE IF NOT EXISTS `publish_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `twitter_accounts`
--

CREATE TABLE IF NOT EXISTS `twitter_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `refresh_token` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `remember_token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_role` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `content_source`
--
ALTER TABLE `content_source`
  ADD CONSTRAINT `FK_source_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `news_feed`
--
ALTER TABLE `news_feed`
  ADD CONSTRAINT `FK_publish_approved` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_publish_status` FOREIGN KEY (`publish_status`) REFERENCES `publish_status` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user_role` FOREIGN KEY (`role`) REFERENCES `user_role` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
