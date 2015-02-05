-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 05 月 23 日 23:31
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
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) CHARACTER SET utf8 NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `gender` int(2) NOT NULL COMMENT '0,1分别代表男，女',
  `points` int(10) NOT NULL COMMENT '积分',
  `birth_dt` varchar(10) CHARACTER SET utf8 NOT NULL,
  `idcard_no` varchar(18) CHARACTER SET utf8 NOT NULL,
  `tel` varchar(20) CHARACTER SET utf8 NOT NULL,
  `mp` varchar(20) CHARACTER SET utf8 NOT NULL,
  `mp1` varchar(20) CHARACTER SET utf8 NOT NULL,
  `weibo` varchar(20) CHARACTER SET utf8 NOT NULL,
  `wechat` varchar(20) CHARACTER SET utf8 NOT NULL,
  `qq` varchar(15) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `real_name` varchar(10) CHARACTER SET utf8 NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 NOT NULL,
  `unit` varchar(50) CHARACTER SET utf8 NOT NULL,
  `create_time` int(11) NOT NULL,
  `log_off` tinyint(4) NOT NULL COMMENT '0,1分别代表未注销，已注销',
  `login_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username_password` (`password`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `user_role_id`, `gender`, `points`, `birth_dt`, `idcard_no`, `tel`, `mp`, `mp1`, `weibo`, `wechat`, `qq`, `password`, `email`, `real_name`, `address`, `unit`, `create_time`, `log_off`, `login_time`) VALUES
(1, 'zsa', 0, 0, 0, '', '', '15602324382', '156324611221', '156324611221', '', '73291321', '73291321', '6512bd43d9caa6e02c990b0a82652dca', '12345@126.com', '张三', '北京市朝阳区定福庄1号', '北京市朝阳区定福庄1号', 1400742252, 0, 0),
(5, 'zs', 0, 0, 0, '', '', '156324611221', '15201230604', '', '', '156324611221', '14985330', '6512bd43d9caa6e02c990b0a82652dca', '15201230@163.com', '张三', '北京市朝阳区定福庄1号', '北京市朝阳区定福庄0号', 1400683092, 1, 0),
(7, 'st', 0, 0, 0, '', '', '156324611221', '15201230606', '', '', '156324611221', '14985330', '123456', '15201230@163.com', '孙天', '北京市朝阳区定福庄1号', '北京市朝阳区定福庄0号', 1400683011, 1, 0),
(15, 'tx', 0, 1, 0, '', '', '', '15201230778', '', '', '', '', '12345', '15201230778@163.com', '唐小', '北京市朝阳区定福庄7号', '', 1400683073, 1, 0),
(16, 'zh', 0, 0, 0, '', '', '', '1867790456', '', '', '', '', '123456', '1867790456@163.com', '张海', '北京市海淀区', '', 1400683144, 0, 0),
(17, 'sy', 0, 1, 0, '', '', '', '13699807546', '', '', '', '', '123456', '13699807546@163.com', '孙云', '北京市海淀区', '', 1400683207, 0, 0),
(18, 'hd', 0, 0, 0, '', '', '', '1369876587', '', '', '', '', '123456', '13699807546@163.com', '胡东', '北京市朝阳区定福庄2号', '', 1400683271, 0, 0),
(19, 'zl', 0, 0, 0, '', '', '', '18677985434', '', '', '', '', '123456', '18677985434', '张亮', '北京市朝阳区定福庄4号', '', 1400683329, 0, 0),
(20, 'gt', 0, 0, 0, '', '', '', '18699875639', '', '', '', '', '123456', '18699875639@163.com', '郭涛', '北京市海淀区', '', 1400683405, 0, 0),
(21, 'ly', 0, 0, 0, '', '', '', '15201230613', '', '', '', '', '123456', '15201230613@163.com', '林颖', '北京市丰台区', '', 1400683519, 0, 0),
(22, 'admin', 0, 0, 0, '', '', '15602324382', '15201230600', '', '', '73291321', '73291321', 'e10adc3949ba59abbe56e057f20f883e', '12345@126.com', '张三', '北京市朝阳区定福庄1号', '北京市朝阳区定福庄1号', 1400760577, 0, 1400846820),
(24, 'jiantong', 0, 1, 0, 'null', '371081198809119823', '18810377235', '18810377235', '010-68555555', 'null', '584135445', '584135445', 'e10adc3949ba59abbe56e057f20f883e', 'jiantong@1.com', '于鉴桐', '北京市朝阳区定福庄', '中国传媒大学', 1400832367, 0, 1400832384);
