-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 04 月 07 日 14:39
-- 服务器版本: 5.5.8
-- PHP 版本: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `cloudmedia`
--
CREATE DATABASE `cloudmedia` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cloudmedia`;

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `admin_role_id` int(11) DEFAULT NULL,
  `contact` int(50) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_role_id` (`admin_role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `admin`
--


-- --------------------------------------------------------

--
-- 表的结构 `admin_access`
--

CREATE TABLE IF NOT EXISTS `admin_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_role_id` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_role_id` (`admin_role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `admin_access`
--


-- --------------------------------------------------------

--
-- 表的结构 `admin_role`
--

CREATE TABLE IF NOT EXISTS `admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `admin_role`
--


-- --------------------------------------------------------

--
-- 表的结构 `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `abstract` varchar(200) NOT NULL,
  `image` varchar(50) NOT NULL,
  `click_to_url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `banner`
--


-- --------------------------------------------------------

--
-- 表的结构 `billing`
--

CREATE TABLE IF NOT EXISTS `billing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `system_coding` tinyint(4) DEFAULT NULL,
  `times` smallint(6) DEFAULT NULL,
  `start_time` int(11) DEFAULT NULL,
  `end_time` int(11) DEFAULT NULL,
  `can_modify` tinyint(4) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `billing`
--


-- --------------------------------------------------------

--
-- 表的结构 `business`
--

CREATE TABLE IF NOT EXISTS `business` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `system_coding` tinyint(4) DEFAULT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '0',
  `can_modify` tinyint(4) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL,
  `start_time` int(11) DEFAULT NULL,
  `end_time` int(11) DEFAULT NULL,
  `business_cat` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `business`
--


-- --------------------------------------------------------

--
-- 表的结构 `business_billing`
--

CREATE TABLE IF NOT EXISTS `business_billing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `billing_id` int(11) NOT NULL,
  `cost` float NOT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `business_id` (`business_id`),
  KEY `billing_id` (`billing_id`),
  KEY `discount_id` (`discount_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `business_billing`
--


-- --------------------------------------------------------

--
-- 表的结构 `business_statistics`
--

CREATE TABLE IF NOT EXISTS `business_statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `order_times` int(11) NOT NULL,
  `income` int(11) NOT NULL,
  `year` smallint(4) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `day` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `month` (`month`),
  KEY `day` (`day`),
  KEY `business_id` (`business_id`),
  KEY `year` (`year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `business_statistics`
--


-- --------------------------------------------------------

--
-- 表的结构 `cloud_manage_group_user`
--

CREATE TABLE IF NOT EXISTS `cloud_manage_group_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `cloud_manage_group_user`
--


-- --------------------------------------------------------

--
-- 表的结构 `cloud_manage_service`
--

CREATE TABLE IF NOT EXISTS `cloud_manage_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `state` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `cloud_manage_service`
--


-- --------------------------------------------------------

--
-- 表的结构 `cloud_manage_service_business`
--

CREATE TABLE IF NOT EXISTS `cloud_manage_service_business` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `capacity` varchar(100) NOT NULL,
  `cloud_manage_service_id` int(11) DEFAULT NULL,
  `limit_concurrent` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cloud_manage_service_id` (`cloud_manage_service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `cloud_manage_service_business`
--


-- --------------------------------------------------------

--
-- 表的结构 `content_distribution`
--

CREATE TABLE IF NOT EXISTS `content_distribution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) NOT NULL,
  `video_type` tinyint(4) NOT NULL,
  `server` varchar(20) NOT NULL,
  `distribution­_time` int(11) NOT NULL,
  `delete_time` int(11) NOT NULL,
  `is_center` tinyint(4) NOT NULL DEFAULT '1',
  `distribution_status` tinyint(4) NOT NULL,
  `guid` varchar(50) NOT NULL,
  `video_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `video_id` (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `content_distribution`
--


-- --------------------------------------------------------

--
-- 表的结构 `discount`
--

CREATE TABLE IF NOT EXISTS `discount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `discount` float NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `discount`
--


-- --------------------------------------------------------

--
-- 表的结构 `epg_business`
--

CREATE TABLE IF NOT EXISTS `epg_business` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `cost` float NOT NULL,
  `business_cat` tinyint(4) NOT NULL,
  `release` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `epg_business`
--


-- --------------------------------------------------------

--
-- 表的结构 `epg_group`
--

CREATE TABLE IF NOT EXISTS `epg_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL,
  `author` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `epg_group`
--


-- --------------------------------------------------------

--
-- 表的结构 `epg_live_channel`
--

CREATE TABLE IF NOT EXISTS `epg_live_channel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `abstract` varchar(200) NOT NULL,
  `guid` varchar(50) NOT NULL,
  `live_url` varchar(200) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `release` tinyint(4) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL,
  `logo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `epg_live_channel`
--


-- --------------------------------------------------------

--
-- 表的结构 `epg_live_programme`
--

CREATE TABLE IF NOT EXISTS `epg_live_programme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `epg_live_channel_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `abstract` varchar(200) NOT NULL,
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `picture` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `epg_live_programme`
--


-- --------------------------------------------------------

--
-- 表的结构 `epg_recording_video`
--

CREATE TABLE IF NOT EXISTS `epg_recording_video` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(50) NOT NULL,
  `epg_live_programme_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  `release` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `live_channel_id` (`epg_live_programme_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `epg_recording_video`
--


-- --------------------------------------------------------

--
-- 表的结构 `epg_video`
--

CREATE TABLE IF NOT EXISTS `epg_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(100) NOT NULL,
  `actor` varchar(100) NOT NULL,
  `abstract` varchar(200) NOT NULL,
  `poster` varchar(50) NOT NULL,
  `label` varchar(20) NOT NULL,
  `video_create_time` int(11) NOT NULL,
  `video_url` varchar(100) NOT NULL,
  `release` tinyint(4) NOT NULL DEFAULT '0',
  `video_id` int(11) NOT NULL,
  `business_ids` varchar(100) NOT NULL,
  `group_id` int(11) NOT NULL,
  `is_free` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `video_id` (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `epg_video`
--


-- --------------------------------------------------------

--
-- 表的结构 `epg_video_rank`
--

CREATE TABLE IF NOT EXISTS `epg_video_rank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) NOT NULL,
  `label_id` tinyint(4) NOT NULL,
  `view_total` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `epg_video_rank`
--


-- --------------------------------------------------------

--
-- 表的结构 `financial_statistics`
--

CREATE TABLE IF NOT EXISTS `financial_statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL,
  `total_fee` int(11) NOT NULL,
  `year` smallint(6) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `day` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `financial_statistics`
--


-- --------------------------------------------------------

--
-- 表的结构 `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL,
  `author` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `group`
--


-- --------------------------------------------------------

--
-- 表的结构 `group_service_resource`
--

CREATE TABLE IF NOT EXISTS `group_service_resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `on_demand` int(50) NOT NULL,
  `live_telecast` int(50) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `group_service_resource`
--


-- --------------------------------------------------------

--
-- 表的结构 `label`
--

CREATE TABLE IF NOT EXISTS `label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `label`
--


-- --------------------------------------------------------

--
-- 表的结构 `live_channel`
--

CREATE TABLE IF NOT EXISTS `live_channel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `abstract` varchar(200) NOT NULL,
  `live_url` varchar(100) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `interrupt` tinyint(4) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL,
  `logo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `live_channel`
--


-- --------------------------------------------------------

--
-- 表的结构 `live_programme`
--

CREATE TABLE IF NOT EXISTS `live_programme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `live_channel_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `abstract` varchar(200) NOT NULL,
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `record` tinyint(4) NOT NULL DEFAULT '1',
  `date` int(11) NOT NULL,
  `picture` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `live_channel_id` (`live_channel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `live_programme`
--


-- --------------------------------------------------------

--
-- 表的结构 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_type_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `content` longtext NOT NULL,
  `create_time` int(11) NOT NULL,
  `portal_admin_id` int(4) NOT NULL,
  `picture` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `news_type_id` (`news_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `news`
--


-- --------------------------------------------------------

--
-- 表的结构 `news_type`
--

CREATE TABLE IF NOT EXISTS `news_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `news_type`
--


-- --------------------------------------------------------

--
-- 表的结构 `portal_admin`
--

CREATE TABLE IF NOT EXISTS `portal_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `realname` varchar(5) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `portal_admin`
--


-- --------------------------------------------------------

--
-- 表的结构 `recording_video`
--

CREATE TABLE IF NOT EXISTS `recording_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(50) NOT NULL,
  `live_programme_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `file_size` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `live_channel_id` (`live_programme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `recording_video`
--


-- --------------------------------------------------------

--
-- 表的结构 `resource`
--

CREATE TABLE IF NOT EXISTS `resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `register_type` tinyint(4) NOT NULL,
  `distribute_type` tinyint(4) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `resource`
--


-- --------------------------------------------------------

--
-- 表的结构 `resource_distribute`
--

CREATE TABLE IF NOT EXISTS `resource_distribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `limit_volume` int(11) NOT NULL,
  `distribute_time` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `server_id` int(11) NOT NULL,
  `business_name` varchar(20) NOT NULL,
  `business_type` tinyint(4) NOT NULL,
  `limit_concurrent` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `resource_id` (`resource_id`),
  KEY `server_id` (`server_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `resource_distribute`
--


-- --------------------------------------------------------

--
-- 表的结构 `resource_register`
--

CREATE TABLE IF NOT EXISTS `resource_register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `register_time` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `server_id` int(11) NOT NULL,
  `register_description` varchar(200) NOT NULL,
  `volume` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `resource_id` (`resource_id`),
  KEY `server_id` (`server_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `resource_register`
--


-- --------------------------------------------------------

--
-- 表的结构 `server`
--

CREATE TABLE IF NOT EXISTS `server` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `state` tinyint(4) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `server`
--


-- --------------------------------------------------------

--
-- 表的结构 `server_operatioing_info`
--

CREATE TABLE IF NOT EXISTS `server_operatioing_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server_id` int(11) NOT NULL,
  `cpu_usage_rate` float NOT NULL,
  `memory_usage_rate` float NOT NULL,
  `operating_state` tinyint(4) NOT NULL,
  `thread` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `server_id` (`server_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `server_operatioing_info`
--


-- --------------------------------------------------------

--
-- 表的结构 `site_visit_record`
--

CREATE TABLE IF NOT EXISTS `site_visit_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_ip` varchar(20) NOT NULL,
  `page` varchar(50) NOT NULL,
  `video_id` int(11) NOT NULL,
  `visit_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `video_id` (`video_id`),
  KEY `visit_time` (`visit_time`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `site_visit_record`
--

INSERT INTO `site_visit_record` (`id`, `user_ip`, `page`, `video_id`, `visit_time`) VALUES
(1, '1.2.3.4', 'http://www.123.com', 1, 0),
(2, '1.2.3.4', 'http://www.123.com', 1, 0),
(3, '1.2.3.5', 'http://www.123.com', 0, 0),
(4, '1.2.3.6', 'http://www.123.com', 2, 0);

-- --------------------------------------------------------

--
-- 表的结构 `site_visit_statistics`
--

CREATE TABLE IF NOT EXISTS `site_visit_statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_total` int(11) NOT NULL,
  `year` smallint(6) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `day` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `site_visit_statistics`
--


-- --------------------------------------------------------

--
-- 表的结构 `system_log`
--

CREATE TABLE IF NOT EXISTS `system_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` tinyint(4) NOT NULL,
  `messages` varchar(200) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `system_log`
--


-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL COMMENT '单位',
  `real_name` varchar(10) DEFAULT NULL,
  `nick_name` varchar(10) DEFAULT NULL,
  `gender` tinyint(4) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  `log_off` tinyint(4) NOT NULL DEFAULT '0',
  `token` varchar(32) NOT NULL,
  `login_time` int(11) DEFAULT NULL,
  `group_status` tinyint(4) NOT NULL,
  `group_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username_password` (`username`,`password`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `user`
--


-- --------------------------------------------------------

--
-- 表的结构 `user_account`
--

CREATE TABLE IF NOT EXISTS `user_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `user_account`
--


-- --------------------------------------------------------

--
-- 表的结构 `user_business`
--

CREATE TABLE IF NOT EXISTS `user_business` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `times` smallint(6) DEFAULT '0',
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `cost` float NOT NULL DEFAULT '0',
  `discount` float DEFAULT NULL,
  `subscribe_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `business_id` (`business_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `user_business`
--


-- --------------------------------------------------------

--
-- 表的结构 `user_financial`
--

CREATE TABLE IF NOT EXISTS `user_financial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '0为充值，1为消费',
  `fee` float NOT NULL,
  `consumer_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `user_financial`
--


-- --------------------------------------------------------

--
-- 表的结构 `user_statistics`
--

CREATE TABLE IF NOT EXISTS `user_statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_total` int(11) NOT NULL,
  `year` smallint(6) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `day` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `user_statistics`
--


-- --------------------------------------------------------

--
-- 表的结构 `user_video`
--

CREATE TABLE IF NOT EXISTS `user_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `video_type` tinyint(4) NOT NULL,
  `subscribe_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `video_id` (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `user_video`
--


-- --------------------------------------------------------

--
-- 表的结构 `user_view_history`
--

CREATE TABLE IF NOT EXISTS `user_view_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `video_position` smallint(6) NOT NULL,
  `view_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `video_id` (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `user_view_history`
--


-- --------------------------------------------------------

--
-- 表的结构 `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(50) NOT NULL,
  `label_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `title` varchar(50) NOT NULL,
  `poster` varchar(50) NOT NULL,
  `author` varchar(100) NOT NULL,
  `actor` varchar(100) NOT NULL,
  `abstract` varchar(200) NOT NULL,
  `file_url` varchar(100) NOT NULL,
  `file_size` int(11) NOT NULL,
  `is_free` tinyint(4) NOT NULL DEFAULT '1',
  `business_ids` varchar(100) NOT NULL,
  `insert_complete` tinyint(4) NOT NULL DEFAULT '0' COMMENT '标记是否注入到视频服务器',
  `recommend` tinyint(4) DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `label_id` (`label_id`,`is_free`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `video`
--


-- --------------------------------------------------------

--
-- 表的结构 `video_view_statistics`
--

CREATE TABLE IF NOT EXISTS `video_view_statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) NOT NULL,
  `label_id` tinyint(4) NOT NULL,
  `view_total` int(11) NOT NULL,
  `year` smallint(6) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `day` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `video_id` (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `video_view_statistics`
--


--
-- 限制导出的表
--

--
-- 限制表 `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`admin_role_id`) REFERENCES `admin_role` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- 限制表 `admin_access`
--
ALTER TABLE `admin_access`
  ADD CONSTRAINT `admin_access_ibfk_1` FOREIGN KEY (`admin_role_id`) REFERENCES `admin_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `business_billing`
--
ALTER TABLE `business_billing`
  ADD CONSTRAINT `business_billing_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `business_billing_ibfk_2` FOREIGN KEY (`billing_id`) REFERENCES `billing` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `business_billing_ibfk_3` FOREIGN KEY (`discount_id`) REFERENCES `discount` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- 限制表 `business_statistics`
--
ALTER TABLE `business_statistics`
  ADD CONSTRAINT `business_statistics_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `cloud_manage_group_user`
--
ALTER TABLE `cloud_manage_group_user`
  ADD CONSTRAINT `cloud_manage_group_user_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- 限制表 `cloud_manage_service_business`
--
ALTER TABLE `cloud_manage_service_business`
  ADD CONSTRAINT `cloud_manage_service_business_ibfk_1` FOREIGN KEY (`cloud_manage_service_id`) REFERENCES `cloud_manage_service` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- 限制表 `content_distribution`
--
ALTER TABLE `content_distribution`
  ADD CONSTRAINT `content_distribution_ibfk_1` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `epg_live_channel`
--
ALTER TABLE `epg_live_channel`
  ADD CONSTRAINT `epg_live_channel_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- 限制表 `group_service_resource`
--
ALTER TABLE `group_service_resource`
  ADD CONSTRAINT `group_service_resource_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- 限制表 `live_channel`
--
ALTER TABLE `live_channel`
  ADD CONSTRAINT `live_channel_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- 限制表 `live_programme`
--
ALTER TABLE `live_programme`
  ADD CONSTRAINT `live_programme_ibfk_1` FOREIGN KEY (`live_channel_id`) REFERENCES `live_channel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`news_type_id`) REFERENCES `news_type` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- 限制表 `resource_distribute`
--
ALTER TABLE `resource_distribute`
  ADD CONSTRAINT `resource_distribute_ibfk_1` FOREIGN KEY (`resource_id`) REFERENCES `resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resource_distribute_ibfk_2` FOREIGN KEY (`server_id`) REFERENCES `server` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `resource_register`
--
ALTER TABLE `resource_register`
  ADD CONSTRAINT `resource_register_ibfk_1` FOREIGN KEY (`resource_id`) REFERENCES `resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resource_register_ibfk_2` FOREIGN KEY (`server_id`) REFERENCES `server` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `server_operatioing_info`
--
ALTER TABLE `server_operatioing_info`
  ADD CONSTRAINT `server_operatioing_info_ibfk_1` FOREIGN KEY (`server_id`) REFERENCES `server` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- 限制表 `user_account`
--
ALTER TABLE `user_account`
  ADD CONSTRAINT `user_account_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `user_business`
--
ALTER TABLE `user_business`
  ADD CONSTRAINT `user_business_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_business_ibfk_2` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `user_financial`
--
ALTER TABLE `user_financial`
  ADD CONSTRAINT `user_financial_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `user_video`
--
ALTER TABLE `user_video`
  ADD CONSTRAINT `user_video_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_video_ibfk_2` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `user_view_history`
--
ALTER TABLE `user_view_history`
  ADD CONSTRAINT `user_view_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_view_history_ibfk_2` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`label_id`) REFERENCES `label` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
