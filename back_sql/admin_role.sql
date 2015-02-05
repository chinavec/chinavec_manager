-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2014 年 05 月 17 日 15:20
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
-- 表的结构 `admin_role`
--

CREATE TABLE IF NOT EXISTS `admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=424 ;

--
-- 转存表中的数据 `admin_role`
--

INSERT INTO `admin_role` (`id`, `name`) VALUES
(1, '业务管理员323'),
(2, '用户管理员'),
(3, '认证计费管理员'),
(4, '内容管理员'),
(5, '内容分发管理员'),
(6, '媒体流管理员'),
(7, '业务支持管理员'),
(8, '资源管理员'),
(9, '审核管理员'),
(418, '业务123'),
(422, '综合'),
(423, '管理员');
