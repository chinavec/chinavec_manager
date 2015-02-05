-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2014 年 05 月 17 日 15:21
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

-- --------------------------------------------------------

--
-- 表的结构 `admin_access`
--

CREATE TABLE IF NOT EXISTS `admin_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_role_id` int(11) NOT NULL,
  `access` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_role_id` (`admin_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- 转存表中的数据 `admin_access`
--

INSERT INTO `admin_access` (`id`, `admin_role_id`, `access`) VALUES
(2, 2, '2'),
(3, 3, '3'),
(4, 4, '4'),
(5, 5, '5'),
(6, 6, '6'),
(7, 7, '7'),
(8, 8, '8'),
(9, 9, '401'),
(16, 418, '1'),
(17, 418, '2'),
(18, 418, '3'),
(41, 422, '3'),
(42, 422, '6'),
(43, 422, '401'),
(44, 1, '5'),
(45, 1, '8'),
(46, 1, '401'),
(49, 423, '1'),
(50, 423, '2'),
(51, 423, '3'),
(52, 423, '4');

--
-- 限制导出的表
--

--
-- 限制表 `admin_access`
--
ALTER TABLE `admin_access`
  ADD CONSTRAINT `admin_access_ibfk_1` FOREIGN KEY (`admin_role_id`) REFERENCES `admin_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
