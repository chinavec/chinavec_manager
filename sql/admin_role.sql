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
-- 表的结构 `admin_role`
--

CREATE TABLE IF NOT EXISTS `admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=436 ;

--
-- 转存表中的数据 `admin_role`
--

INSERT INTO `admin_role` (`id`, `name`) VALUES
(1, '审核管理员'),
(2, '用户管理员'),
(3, '微视频授权管理员'),
(4, '门户管理员'),
(5, '媒体分发管理员'),
(6, '业务支持管理员'),
(425, '综合业务管理员'),
(430, '媒体分发管理员1'),
(432, '业务支持管理员1'),
(433, '用户管理员2'),
(434, '门户用户管理员2');
