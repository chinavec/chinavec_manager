-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2014 年 05 月 20 日 22:24
-- 服务器版本: 5.5.27
-- PHP 版本: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `chinavec`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_authority`
--

CREATE TABLE IF NOT EXISTS `admin_authority` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authority_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=402 ;

--
-- 转存表中的数据 `admin_authority`
--

INSERT INTO `admin_authority` (`id`, `authority_name`) VALUES
(1, '业务管理'),
(2, '内容管理'),
(3, '媒体流管理'),
(4, '计费优惠'),
(5, '用户管理'),
(6, '媒体分发'),
(7, '业务支持'),
(8, '云服务支持'),
(9, '资源管理'),
(401, '内容审核');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
