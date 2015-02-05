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
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `real_name` text NOT NULL,
  `password` varchar(32) NOT NULL,
  `admin_role_id` int(11) DEFAULT NULL,
  `contact` text NOT NULL,
  `department` text NOT NULL,
  `position` text NOT NULL,
  `work_permit` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `group_status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_role_id` (`admin_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `username`, `real_name`, `password`, `admin_role_id`, `contact`, `department`, `position`, `work_permit`, `create_time`, `group_id`, `group_status`) VALUES
(2, 'admin', '张力', '123456', 1, '13301220512', '', '', 0, 1366983009, 0, 0),
(3, 'corrine11', '李斯', 'zhangsan', 1, '13301220565', '', '', 0, 1367893439, 0, 0),
(4, 'she11', '王五', 'zhangsan', 1, '13301220512', '新媒体', '主任', 110, 1371525390, 0, 0),
(7, 'admin7', '杨光', 'zhangsan', 3, '13301220501', '', '', 0, 1366958089, 0, 0),
(8, 'admin8', '王芳', 'admina', 3, '13009876789', '', '', 0, 1366958089, 0, 0),
(9, 'admin9', '孙静', 'zhangsan', 4, '13301220554', '', '', 0, 1366958089, 0, 0),
(10, 'admin10', '孙云', 'adminsun', 4, '13009876712', '', '', 0, 1366958089, 0, 0),
(14, 'admin14', '李悦', 'zhangsan', 5, '13301220546', '', '', 0, 1366958089, 0, 0),
(15, 'admin15', '张勇', 'adminc', 5, '13009876789', '', '', 0, 1366958089, 0, 0),
(16, 'admin16', '张勇', 'zhangsan', 5, '13301220587', '', '', 0, 1366958089, 0, 0),
(17, 'admin17', '李白', 'zhangsan', 1, '13301220546', '', '', 0, 1400331365, 0, 0),
(18, 'admin18', '王九', 'zhangsan', 6, '13301220546', '', '', 0, 1366958089, 0, 0),
(19, 'admin19', '王六', 'zhangsan', 6, '13301220506', '', '', 0, 1366958089, 0, 0),
(20, 'admin20', '杜牧', 'zhangsan', 7, '13301220546', '', '', 0, 1366958089, 0, 0),
(21, 'admin21', '张罗', 'adminb', 7, '13009876789', '', '', 0, 1366958089, 0, 0),
(22, 'admin22', '李璐', 'admind', 7, '13009876789', '', '', 0, 1366958089, 0, 0),
(23, 'admin23', '王晴', 'adminf', 7, '13009876712', '', '', 0, 1366941377, 0, 0),
(24, 'admin24', '王亚', 'zhangsan', 7, '13301220532', '', '', 0, 1366958089, 0, 0),
(25, 'admin25', '李月', 'zhangsan', 7, '13301220546', '', '', 0, 1366958089, 0, 0),
(26, 'admin26', '赵丹', 'zhangsan', 8, '13301220553', '', '', 0, 1366958089, 0, 0),
(27, 'admin27', '李丽', 'zhangsan', 8, '13301220509', '', '', 0, 1366958089, 0, 0),
(28, 'admin28', '王敏', 'zhangsan', 8, '13301220546', '', '', 0, 1366958089, 0, 0),
(29, 'admin29', '李然', 'zhangsan', 8, '13301220546', '', '', 0, 1366958089, 0, 0),
(30, 'admin30', '何娜', 'zhangsan', 9, '13301220567', '', '', 0, 1366958089, 0, 0),
(31, 'admin31', '王娜', 'zhangsan', 9, '13301220546', '', '', 0, 1366958089, 0, 0),
(32, 'admin32', '王维', 'zhangsan', 9, '13301220546', '', '', 0, 1366958089, 0, 0),
(34, 'admin91', '王涛', 'admin99', 1, '13009876781', '', '', 0, 1366984790, 0, 0),
(36, 'pinqy12', '王月', 'sagetsjuk', 10, '12343215678', '', '', 0, 1368890091, 0, 0),
(37, 'adminabc', '王月', 'adminabc', 10, '12343215678', '', '', 0, 1368890148, 0, 0),
(38, 'flynn-77', '王月', 'xgrtkyi;loi&#039;', 10, '12343215678', '', '', 0, 1368890341, 0, 0),
(39, 'adminaaaa', '张三', 'xuleim', 10, '13009874567', '', '', 0, 1368890657, 0, 0),
(40, 'test3', '王月', 'xzhtdkygfik', 10, '13301220508', '', '', 0, 1368890981, 0, 0);
