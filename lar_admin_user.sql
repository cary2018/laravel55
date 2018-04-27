/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : lar

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-04-27 16:25:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for lar_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `lar_admin_user`;
CREATE TABLE `lar_admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(60) NOT NULL DEFAULT '' COMMENT '用户密码',
  `jurisdiction` varchar(255) NOT NULL DEFAULT '' COMMENT '用户权限',
  `state` int(11) NOT NULL DEFAULT '0' COMMENT '用户状态',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `up_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='//管理员';

-- ----------------------------
-- Records of lar_admin_user
-- ----------------------------
INSERT INTO `lar_admin_user` VALUES ('1', 'admin', '$2y$10$LeVa6unU0.pnj0tgoMZ3We15F1rjjmOY2zovZjCs1Wj/GiOXmKIL6', '', '0', '2147483647', '2147483647');
INSERT INTO `lar_admin_user` VALUES ('2', 'cary', '$2y$10$R2oBW.NjL9w4srpmNJg/hu20v9wIBoNwqFhtsgsewyLYMX0NgeaZ2', '', '0', '2147483647', '2147483647');
