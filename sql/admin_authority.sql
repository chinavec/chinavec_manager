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
(1, '用户管理'),
(2, '授权管理'),
(3, '门户管理'),
(4, '媒体分发'),
(5, '业务支持');
