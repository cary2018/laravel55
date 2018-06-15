/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : lar

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-06-15 15:58:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for lar_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `lar_admin_role`;
CREATE TABLE `lar_admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '对应admin_user表的id字段',
  `role_id` int(11) NOT NULL COMMENT '对应role表中的id字段',
  `created_time` int(11) NOT NULL COMMENT '插入时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COMMENT='用户角色关系表';

-- ----------------------------
-- Records of lar_admin_role
-- ----------------------------
INSERT INTO `lar_admin_role` VALUES ('3', '4', '3', '1528853993');
INSERT INTO `lar_admin_role` VALUES ('8', '5', '1', '1528854056');
INSERT INTO `lar_admin_role` VALUES ('9', '5', '3', '1528854056');
INSERT INTO `lar_admin_role` VALUES ('12', '4', '1', '1528856194');
INSERT INTO `lar_admin_role` VALUES ('26', '12', '1', '1528857061');
INSERT INTO `lar_admin_role` VALUES ('28', '12', '3', '1528857061');
INSERT INTO `lar_admin_role` VALUES ('30', '3', '2', '1528857218');
INSERT INTO `lar_admin_role` VALUES ('31', '3', '3', '1528857218');
INSERT INTO `lar_admin_role` VALUES ('32', '3', '1', '1528857253');
INSERT INTO `lar_admin_role` VALUES ('34', '2', '2', '1529031201');

-- ----------------------------
-- Table structure for lar_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `lar_admin_user`;
CREATE TABLE `lar_admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `user_alias` varchar(30) NOT NULL DEFAULT '' COMMENT '别名',
  `password` varchar(60) NOT NULL DEFAULT '' COMMENT '用户密码',
  `is_admin` tinyint(1) unsigned zerofill NOT NULL DEFAULT '0' COMMENT '是否为超级管理员，1是，0否',
  `state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户状态：1正常，0禁用',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `up_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='//管理员';

-- ----------------------------
-- Records of lar_admin_user
-- ----------------------------
INSERT INTO `lar_admin_user` VALUES ('1', 'admin', 'Cary.He', '$2y$10$LeVa6unU0.pnj0tgoMZ3We15F1rjjmOY2zovZjCs1Wj/GiOXmKIL6', '1', '1', '127', '1528784250');
INSERT INTO `lar_admin_user` VALUES ('2', 'cary', 'himi', '$2y$10$R2oBW.NjL9w4srpmNJg/hu20v9wIBoNwqFhtsgsewyLYMX0NgeaZ2', '0', '1', '127', '1529048355');
INSERT INTO `lar_admin_user` VALUES ('3', '栽植', '磊', '$2y$10$.a6nGupgAerDG3nzbtf3.eVAboa5vp85IOfQfySOSYsoY0W9ajWEm', '0', '0', '1528351896', '1528857253');
INSERT INTO `lar_admin_user` VALUES ('4', '发达', '阿斯蒂芬', '$2y$10$.XCDkMyGEKDPeTkRxs62R.zxgdG3GucMRPWMOiqd24KRgmZHfGEyq', '0', '0', '1528351944', '1528857159');
INSERT INTO `lar_admin_user` VALUES ('5', '发达在', '阿斯蒂芬在', '$2y$10$z.qOxyFBDyTVtVFPr0ZbXu2O.5sTRVSgHKu91gi5gXvU1MrCnzHmG', '0', '0', '1528352006', '1528854056');
INSERT INTO `lar_admin_user` VALUES ('12', '发要 要', '无可奈何花落去工', '$2y$10$h4PcT6B2VADn8llkFyFG9e4DJSOhxqwvYoWNkaVI1W3i6s3F5S09O', '0', '0', '1528355769', '1528857181');

-- ----------------------------
-- Table structure for lar_jurisdiction
-- ----------------------------
DROP TABLE IF EXISTS `lar_jurisdiction`;
CREATE TABLE `lar_jurisdiction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '权限标题',
  `urls` varchar(150) NOT NULL COMMENT '权限的url',
  `status` tinyint(1) NOT NULL COMMENT '权限状态：0无效，1有效',
  `update_time` int(11) NOT NULL COMMENT '最后更新时间',
  `created_time` int(11) NOT NULL COMMENT '插入时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Records of lar_jurisdiction
-- ----------------------------
INSERT INTO `lar_jurisdiction` VALUES ('1', '添加文章', '[\"admin\\/config\\r\",\"admin\\/article\\r\",\"admin\\/users\"]', '1', '1529049056', '0');
INSERT INTO `lar_jurisdiction` VALUES ('2', '删除文章', '[\"admin\\/jurisdiction\\/destroy\"]', '0', '1528966127', '0');
INSERT INTO `lar_jurisdiction` VALUES ('3', '多条权限', '[\"admin\\/user\",\"\\nadmin\\/role\"]', '1', '1529045298', '1528958822');

-- ----------------------------
-- Table structure for lar_role
-- ----------------------------
DROP TABLE IF EXISTS `lar_role`;
CREATE TABLE `lar_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '角色名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1-有效 |  0-无效',
  `update_time` int(11) NOT NULL COMMENT '最后一次更新时间',
  `created_time` int(11) NOT NULL COMMENT '插入时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of lar_role
-- ----------------------------
INSERT INTO `lar_role` VALUES ('1', '文章列表', '1', '0', '0');
INSERT INTO `lar_role` VALUES ('2', '文案', '1', '1529048304', '0');
INSERT INTO `lar_role` VALUES ('3', '文章栏目', '0', '1528940857', '0');
INSERT INTO `lar_role` VALUES ('4', '自定义菜单', '0', '1528940864', '1528876782');
INSERT INTO `lar_role` VALUES ('6', '用户管理', '0', '1528940874', '1528878590');
INSERT INTO `lar_role` VALUES ('7', '角色管理', '0', '1528878598', '1528878598');

-- ----------------------------
-- Table structure for lar_role_access
-- ----------------------------
DROP TABLE IF EXISTS `lar_role_access`;
CREATE TABLE `lar_role_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL COMMENT '对应角色表中的角色id',
  `access_id` int(11) NOT NULL COMMENT '对应权限表中的权限id',
  `created_time` int(11) NOT NULL COMMENT '插入时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='角色权限关系表';

-- ----------------------------
-- Records of lar_role_access
-- ----------------------------
INSERT INTO `lar_role_access` VALUES ('7', '6', '2', '1528940085');
INSERT INTO `lar_role_access` VALUES ('10', '4', '2', '1528940141');
INSERT INTO `lar_role_access` VALUES ('11', '4', '1', '1528940161');
INSERT INTO `lar_role_access` VALUES ('12', '2', '1', '1528940786');
