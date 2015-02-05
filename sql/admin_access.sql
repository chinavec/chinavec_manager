-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 05 月 23 日 14:11
-- 服务器版本: 5.1.73
-- PHP 版本: 5.3.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `chinavec`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100 ;

--
-- 转存表中的数据 `admin_access`
--

INSERT INTO `admin_access` (`id`, `admin_role_id`, `access`) VALUES
(66, 430, '4'),
(67, 432, '5'),
(70, 434, '3'),
(71, 433, '1'),
(83, 2, '1'),
(84, 4, '3'),
(85, 3, '2'),
(86, 5, '4'),
(87, 6, '5'),
(88, 425, '1'),
(89, 425, '2'),
(90, 425, '3'),
(91, 425, '4'),
(92, 425, '5'),
(93, 1, '2'),
(94, 1, '4'),
(95, 1, '5');

--
-- 限制导出的表
--

--
-- 限制表 `admin_access`
--
ALTER TABLE `admin_access`
  ADD CONSTRAINT `admin_access_ibfk_1` FOREIGN KEY (`admin_role_id`) REFERENCES `admin_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
