/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : lljy

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-06-19 11:37:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbkl_access
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_access`;
CREATE TABLE `tbkl_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Records of tbkl_access
-- ----------------------------
INSERT INTO `tbkl_access` VALUES ('1', '82', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '81', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '75', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '76', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '77', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '78', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '79', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '80', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '74', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '68', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '66', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '67', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '65', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '64', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '62', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '73', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '72', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '71', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '70', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '61', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '60', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '59', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '58', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '57', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '56', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '55', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '54', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '49', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '48', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '47', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '46', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '57', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '55', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '54', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '110', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '16', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '114', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '115', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '112', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '111', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '101', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '45', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '23', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '53', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '52', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '51', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '50', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '22', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '21', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '20', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '19', '0', null);
INSERT INTO `tbkl_access` VALUES ('1', '1', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '99', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '97', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '96', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '94', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '93', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '92', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '104', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '103', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '107', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '106', '0', null);
INSERT INTO `tbkl_access` VALUES ('6', '1', '0', null);

-- ----------------------------
-- Table structure for tbkl_address
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_address`;
CREATE TABLE `tbkl_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL COMMENT '姓名',
  `userphone` varchar(255) DEFAULT NULL COMMENT '电话',
  `province` varchar(255) DEFAULT NULL COMMENT '省',
  `city` varchar(255) DEFAULT NULL COMMENT '市',
  `area` varchar(255) DEFAULT NULL COMMENT '区',
  `details` varchar(255) DEFAULT NULL COMMENT '详情',
  `zipcode` varchar(255) DEFAULT NULL COMMENT '邮政编码',
  `members_id` int(11) DEFAULT NULL COMMENT '会员id',
  `default` int(255) NOT NULL DEFAULT '0' COMMENT '是否默认',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='地址表';

-- ----------------------------
-- Records of tbkl_address
-- ----------------------------

-- ----------------------------
-- Table structure for tbkl_admin
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_admin`;
CREATE TABLE `tbkl_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `password` char(50) NOT NULL,
  `status` int(2) DEFAULT '0' COMMENT '0:正常，1：锁定',
  `create_time` int(11) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `msg` varchar(255) DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '关联角色ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='管理员';

-- ----------------------------
-- Records of tbkl_admin
-- ----------------------------
INSERT INTO `tbkl_admin` VALUES ('1', 'kaili', 'c3b831951baf129b6aaf94e24a278265', '0', '1493711803', '18189554955', '超级管理员', '0');
INSERT INTO `tbkl_admin` VALUES ('10', 'admin11', 'e020590f0e18cd6053d7ae0e0a507609', '0', '1556937608', '15920001031', '', '6');
INSERT INTO `tbkl_admin` VALUES ('9', 'caiwu', '75b87e2556b0e0f04ba5a4a5d746adbd', '0', '1556937608', '18002576380', '', '1');
INSERT INTO `tbkl_admin` VALUES ('16', 'test', '098f6bcd4621d373cade4e832627b4f6', '0', '1556937608', '13111111111', '', '1');

-- ----------------------------
-- Table structure for tbkl_apply
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_apply`;
CREATE TABLE `tbkl_apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `members_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员id/members表主键',
  `banner_id` int(11) NOT NULL DEFAULT '0' COMMENT '轮播图id',
  `banner_name` varchar(100) NOT NULL DEFAULT '' COMMENT '活动名称',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '学员姓名',
  `idcard` varchar(25) NOT NULL DEFAULT '' COMMENT '身份证',
  `height` varchar(6) NOT NULL DEFAULT '' COMMENT '身高',
  `weight` varchar(6) NOT NULL DEFAULT '' COMMENT '体重',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别：0未知；1男；2女',
  `age` int(3) NOT NULL DEFAULT '0' COMMENT '年龄',
  `health` varchar(10) NOT NULL DEFAULT '' COMMENT '身体状况',
  `father` varchar(30) NOT NULL DEFAULT '' COMMENT '学员父亲',
  `pidcard` varchar(25) NOT NULL DEFAULT '' COMMENT '父亲身份证',
  `pphone` varchar(15) NOT NULL DEFAULT '' COMMENT '父亲联系电话',
  `mother` varchar(30) NOT NULL DEFAULT '' COMMENT '学员母亲',
  `midcard` varchar(25) NOT NULL DEFAULT '' COMMENT '母亲身份证',
  `mphone` varchar(15) NOT NULL DEFAULT '' COMMENT '母亲联系电话',
  `address` varchar(200) NOT NULL DEFAULT '' COMMENT '家庭住址',
  `info` varchar(1000) NOT NULL DEFAULT '' COMMENT '学员资料',
  `remarks` varchar(1000) NOT NULL DEFAULT '' COMMENT '备注',
  `is_sign` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0不签名；1签名',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0隐藏；1显示',
  `flag` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0删除；1不删除',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='学员申请表';

-- ----------------------------
-- Records of tbkl_apply
-- ----------------------------
INSERT INTO `tbkl_apply` VALUES ('1', '1', '0', '', '学员姓名q', 'idcard', '170', '50', '1', '20', '良好', 'father', 'pidcard', '13111111111', 'mother', 'midcard', '13111111111', 'address', 'info', 'remarks', '1', '1', '1', '1556102342', '1556102402');
INSERT INTO `tbkl_apply` VALUES ('2', '1', '0', '', '学员姓名', 'idcard', '170', '50', '2', '20', '良好', 'father', 'pidcard', '13111111111', 'mother', 'midcard', '13111111111', 'address', 'info', 'remarks', '0', '1', '1', '1556102379', '1556241889');
INSERT INTO `tbkl_apply` VALUES ('3', '1', '0', '', '学员姓名', 'idcard', '170', '50', '1', '20', '良好', 'father', 'pidcard', '13111111111', 'mother', 'midcard', '13111111111', 'address', 'info', 'remarks', '1', '1', '1', '1556327233', '0');
INSERT INTO `tbkl_apply` VALUES ('4', '1', '0', '', '学员姓名11', 'idcard', '170', '50', '1', '20', '良好', 'father', 'pidcard', '13111111111', 'mother', 'midcard', '13111111111', 'address', 'infoinfoinfo', 'remarks', '1', '1', '1', '1556327243', '1556423948');

-- ----------------------------
-- Table structure for tbkl_banner
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_banner`;
CREATE TABLE `tbkl_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '名称',
  `pic` varchar(200) NOT NULL DEFAULT '' COMMENT '图片',
  `url` varchar(200) NOT NULL DEFAULT '' COMMENT '跳转地址',
  `place` tinyint(2) NOT NULL DEFAULT '1' COMMENT '显示位置：1首页',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0隐藏；1显示',
  `sort` int(11) NOT NULL DEFAULT '99999' COMMENT '排序',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='轮播图';

-- ----------------------------
-- Records of tbkl_banner
-- ----------------------------
INSERT INTO `tbkl_banner` VALUES ('1', '轮播图名称', '/Uploads/Admin/banner/155805913266277.jpg', 'pages/index/info/info?id=16', '1', '1', '0', '1558059133', '1559292314');
INSERT INTO `tbkl_banner` VALUES ('2', '轮播图名称2', '', '/pages/my/register/register', '1', '1', '0', '1559292360', '0');

-- ----------------------------
-- Table structure for tbkl_base
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_base`;
CREATE TABLE `tbkl_base` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `msg_url` varchar(255) DEFAULT NULL COMMENT '短信接口地址',
  `msg_account` varchar(255) DEFAULT NULL COMMENT '短信账号',
  `msg_secret` varchar(255) DEFAULT NULL COMMENT '短信密码',
  `msg_sign` varchar(255) DEFAULT NULL COMMENT '短信签名',
  `appid` varchar(255) DEFAULT NULL COMMENT '微信appid',
  `appsecret` varchar(255) DEFAULT NULL COMMENT '微信appsecret',
  `mchid` int(11) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL COMMENT '配置管理员的ID',
  `logo` varchar(255) DEFAULT NULL,
  `hospital_tel` int(12) DEFAULT '0' COMMENT '咨询电话',
  `help` text,
  `name` varchar(255) DEFAULT NULL COMMENT '网站标题',
  `is_index_product` smallint(255) DEFAULT '0',
  `agent_status` smallint(255) NOT NULL DEFAULT '0' COMMENT '分销状态',
  `agent_one` varchar(25) DEFAULT NULL COMMENT '一级分销占比',
  `agent_two` varchar(25) DEFAULT NULL COMMENT '二级分销占比',
  `agent_three` varchar(25) DEFAULT NULL,
  `cash_date` varchar(50) DEFAULT NULL COMMENT '可提现日期',
  `barcode` varchar(255) DEFAULT NULL,
  `subscribe_txt` varchar(255) DEFAULT NULL COMMENT '关注提醒',
  `subscribe_url` varchar(255) DEFAULT NULL COMMENT '关注链接',
  `service_phone` varchar(255) DEFAULT NULL COMMENT '客服电话',
  `admin_members_id` int(11) DEFAULT NULL COMMENT '管理员会员id',
  `sm_appid` varchar(255) DEFAULT NULL COMMENT '小程序APPID',
  `sm_appsecret` varchar(255) DEFAULT NULL COMMENT '小程序秘钥',
  `agent_one_id` int(11) NOT NULL,
  `welfare_name` varchar(255) DEFAULT NULL,
  `welfare_status` int(11) DEFAULT '0' COMMENT '1:开启 2:关闭',
  `coupon_id` int(11) DEFAULT NULL COMMENT '新人赠送优惠券id',
  `money_msg` varchar(255) DEFAULT '0' COMMENT '充值说明',
  `postage` varchar(255) DEFAULT NULL COMMENT '邮费',
  `group_endtime` int(11) DEFAULT NULL,
  `group_head_status` tinyint(2) DEFAULT NULL COMMENT '团长优惠状态',
  `group_head_full` decimal(2,0) DEFAULT NULL COMMENT '团长满多少可优惠',
  `group_head_discount` decimal(2,0) DEFAULT NULL COMMENT '团长优惠金额',
  `nopay_valid_time` int(11) DEFAULT NULL COMMENT '未支付订单有效期',
  `is_since` int(11) NOT NULL DEFAULT '0' COMMENT '0：支持，1：不支持自提',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='系统配置表';

-- ----------------------------
-- Records of tbkl_base
-- ----------------------------
INSERT INTO `tbkl_base` VALUES ('1', 'http://120.55.248.18/smsSend.do?', 'guofenghui', 'mM9kR1zP', '国枫会', 'wx8a5c6814473c1f1e', '82fe28b873d8cf239235af04eba6be66', '1535238051', 'a123456789b123456789c123456789de', '1557978728', '1', '/Uploads/Admin/base/153001151221769.jpg', '1818955495', '<h3 title=\"点击查看\" class=\"\" style=\"white-space: normal; margin: 0px; padding: 7px 10px 8px; font-size: 12px; color: rgb(204, 0, 0); word-wrap: break-word; cursor: pointer; line-height: 24px; text-align: center;\"><span style=\"font-size: 20px;\">如何申请代理商？</span></h3><h3 title=\"点击查看\" class=\"\" style=\"white-space: normal; margin: 0px; padding: 7px 10px 8px; font-size: 12px; color: rgb(204, 0, 0); word-wrap: break-word; cursor: pointer; line-height: 24px; text-align: center;\">大迈微信公众号</h3><p style=\"margin-top: 0px; margin-bottom: 0px; white-space: normal; padding: 0px 0px 0px 10px; word-wrap: break-word; line-height: 26px;\"><br/></p><p style=\"margin-top: 0px; margin-bottom: 0px; white-space: normal; padding: 0px 0px 0px 10px; word-wrap: break-word; line-height: 26px; text-align: center;\"><strong>首先跟大迈公司总部洽谈好并签合同后，</strong></p><p style=\"margin-top: 0px; margin-bottom: 0px; white-space: normal; padding: 0px 0px 0px 10px; word-wrap: break-word; line-height: 26px; text-align: center;\"><strong>在明确代理区域的情况下操作以下步骤：</strong></p><p style=\"margin-top: 0px; margin-bottom: 0px; white-space: normal; padding: 0px 0px 0px 10px; word-wrap: break-word; line-height: 26px; text-align: center;\"><strong><br/></strong></p><p style=\"margin-top: 0px; margin-bottom: 0px; white-space: normal; padding: 0px 0px 0px 10px; word-wrap: break-word; line-height: 26px; text-indent: 2em; text-align: left;\">1.用微信扫一扫以上二维码关注大迈公众号；</p><p style=\"margin-top: 0px; margin-bottom: 0px; white-space: normal; padding: 0px 0px 0px 10px; word-wrap: break-word; line-height: 26px; text-indent: 2em; text-align: left;\">2.点击进入“健康商城”，再点击右下角“我的”按键；</p><p style=\"margin-top: 0px; margin-bottom: 0px; white-space: normal; padding: 0px 0px 0px 10px; word-wrap: break-word; line-height: 26px; text-indent: 2em; text-align: left;\">3.再点击“代理中心”，按合同授权的区域填写代理资料并提交；</p><p style=\"margin-top: 0px; margin-bottom: 0px; white-space: normal; padding: 0px 0px 0px 10px; word-wrap: break-word; line-height: 26px; text-indent: 2em; text-align: left;\">4.总部在2个工作日内完成审核；</p><p style=\"margin-top: 0px; margin-bottom: 0px; white-space: normal; padding: 0px 0px 0px 10px; word-wrap: break-word; line-height: 26px; text-indent: 2em; text-align: left;\">5.审核<span style=\"text-indent: 32px;\">通过后正式成为公司代理商；</span></p><p style=\"margin-top: 0px; margin-bottom: 0px; white-space: normal; padding: 0px 0px 0px 10px; word-wrap: break-word; line-height: 26px; text-indent: 2em; text-align: left;\"><span style=\"text-indent: 32px;\">6.<span style=\"text-indent: 32px;\">总部将在7个工作日内完成专属二维码制作；并应用到产品上。</span></span></p><p style=\"margin-top: 0px; margin-bottom: 0px; white-space: normal; padding: 0px 0px 0px 10px; word-wrap: break-word; line-height: 26px; text-indent: 2em;\"><br/></p><p><br/></p><p style=\"display:none;\" data-background=\"background-repeat:no-repeat; background-position:center center; background-color:#DBE5F1;\"><br/></p>', '力麒智能', '1', '0', '3%', '2%', '1%', '周三', '/Uploads/Admin/base/151376802673119.jpg', '关注完善信息，享5年免费包换服务', 'https://mp.weixin.qq.com/mp/profile_ext?action=home&amp;__biz=MzAwMDE2NTQ1MA==&amp;scene=126#wechat_redirect', '18189554955', '1', 'wx5d8c7e4e4ba2b223', 'a22be772b68edc6a74c7f0eff5f2fc80', '1', '新用户专享', '1', '3', '1、充值成功后余额随即增加<br/>2、充值余额不可提现<br/>3、余额可再商城购买商品', '', '23', '1', '20', '5', '0', '0');

-- ----------------------------
-- Table structure for tbkl_buyinfo
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_buyinfo`;
CREATE TABLE `tbkl_buyinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `members_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员id',
  `pro_id` int(11) NOT NULL DEFAULT '0' COMMENT '视频id/vip id',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0视频；1vip',
  `term` int(3) NOT NULL DEFAULT '0' COMMENT '付费使用有效期/月',
  `expire_time` int(11) NOT NULL DEFAULT '0' COMMENT '到期时间',
  `is_pay` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付；1已支付',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='购买信息表';

-- ----------------------------
-- Records of tbkl_buyinfo
-- ----------------------------

-- ----------------------------
-- Table structure for tbkl_collect
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_collect`;
CREATE TABLE `tbkl_collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `members_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `video_id` int(11) NOT NULL DEFAULT '0' COMMENT '视频id',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='视频收藏记录表';

-- ----------------------------
-- Records of tbkl_collect
-- ----------------------------

-- ----------------------------
-- Table structure for tbkl_formid
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_formid`;
CREATE TABLE `tbkl_formid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` int(11) DEFAULT NULL COMMENT '生成时间',
  `status` int(11) DEFAULT '0' COMMENT '0：有效，1：无效',
  `formid` varchar(255) NOT NULL COMMENT 'formid',
  `members_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='小程序formid';

-- ----------------------------
-- Records of tbkl_formid
-- ----------------------------

-- ----------------------------
-- Table structure for tbkl_keys
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_keys`;
CREATE TABLE `tbkl_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keys` varchar(50) NOT NULL DEFAULT '' COMMENT '搜索词',
  `num` int(11) NOT NULL DEFAULT '1' COMMENT '搜索次数',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='搜索记录表';

-- ----------------------------
-- Records of tbkl_keys
-- ----------------------------
INSERT INTO `tbkl_keys` VALUES ('1', '视频名称1', '3', '1557801658', '0');
INSERT INTO `tbkl_keys` VALUES ('2', '视频名称2', '4', '1557801702', '1557801746');

-- ----------------------------
-- Table structure for tbkl_keywords
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_keywords`;
CREATE TABLE `tbkl_keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL COMMENT '链接名称',
  `url` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `sort` smallint(5) DEFAULT NULL,
  `type` smallint(2) DEFAULT '1' COMMENT '1公众号，2：小程序',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='链接管理';

-- ----------------------------
-- Records of tbkl_keywords
-- ----------------------------
INSERT INTO `tbkl_keywords` VALUES ('1', '韩版', '/pages/index/index', '1513441094', '1', '2', '0', '1532511249');
INSERT INTO `tbkl_keywords` VALUES ('2', '高腰', '/pages/members/myPw/myPw', '1529500757', '1', '2', '0', '1532511253');
INSERT INTO `tbkl_keywords` VALUES ('3', '半身裙', '/pages/members/myPrize/myPrize', '1529500779', '3', '2', '0', '1532511246');
INSERT INTO `tbkl_keywords` VALUES ('4', '简约优雅', '/pages/agent/index/index', '1529500799', '19', '2', '0', '1532511243');

-- ----------------------------
-- Table structure for tbkl_members
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_members`;
CREATE TABLE `tbkl_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `headimgurl` varchar(255) DEFAULT NULL COMMENT '微信头像',
  `headimg` varchar(255) DEFAULT NULL COMMENT '图片真实路径',
  `nickname` varchar(255) NOT NULL COMMENT '微信昵称',
  `username` varchar(10) DEFAULT NULL COMMENT '会员姓名',
  `userphone` varchar(15) DEFAULT NULL COMMENT '会员电话',
  `sex` tinyint(255) NOT NULL DEFAULT '0' COMMENT '性别',
  `openid` varchar(50) NOT NULL COMMENT '微信openid',
  `subscribe` tinyint(2) DEFAULT NULL COMMENT '是否关注',
  `age` int(11) DEFAULT NULL COMMENT '年龄',
  `create_time` int(11) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL COMMENT '省',
  `city` varchar(255) DEFAULT NULL COMMENT '市',
  `area` varchar(255) DEFAULT '' COMMENT '县',
  `details` varchar(255) DEFAULT NULL,
  `is_vip` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0不是vip；1vip',
  `level` int(255) DEFAULT '4',
  `update_time` int(11) DEFAULT NULL,
  `top_id` int(11) NOT NULL DEFAULT '0',
  `money` decimal(50,2) NOT NULL DEFAULT '0.00' COMMENT '余额',
  `barcode` varchar(255) DEFAULT NULL COMMENT '个人二维码',
  `point` int(11) NOT NULL DEFAULT '0',
  `type` int(255) DEFAULT '0' COMMENT '1:微信公众号用户，2：微信小程序用户',
  `commission` decimal(50,2) NOT NULL DEFAULT '0.00' COMMENT '佣金',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COMMENT='会员表';

-- ----------------------------
-- Records of tbkl_members
-- ----------------------------
INSERT INTO `tbkl_members` VALUES ('1', 'https://wx.qlogo.cn/mmopen/vi_32/f6Npusia1ltfH3ArhzYL1DDqpE5lWeIKtR4rhbSkZCpB65el1Ib7cDGKQnPqtEtQJswzu2BBCZHrh6CVROHg6rw/132', 'Uploads/Index/headimg/oKuqO4s6TG6GWksyUsrXrXYz14JM.jpg', '6I+g6JCd6I+g6JCdTWU=', '韩全涛', '18189554955', '1', 'oKuqO4s6TG6GWksyUsrXrXYz14JM', null, null, '1545736920', '山西省', '长治市', '城区', '测试奇偶的', '0', '4', '1547266685', '1', '371.00', '', '0', '2', '106.98');
INSERT INTO `tbkl_members` VALUES ('2', 'https://wx.qlogo.cn/mmopen/vi_32/fbP3gC6PHxmYK29Ly7GLa8bUZIErlk5CkOoQ0vavfruIuuNA1KKZzIDluGnvkRtEt77XS7oQGYU1ZbmmckC3YA/132', null, 'fHzpo5jokL3nmoTmnqvlj7bvvZ4=', null, '13188888888', '1', 'oKuqO4hEs9kHvGJX-PAW1C3Nyp3U', null, null, '1542979462', 'Guangdong', 'Zhaoqing', '', null, '0', '4', '1556000337', '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('3', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIBbzAcSichRgQ7bmORuziaicUoibHaaQwP9s3DK1w9aIQ2k3LPNkicJNWknrEQxvNLCzs13sjGkh9QQjA/132', null, '5oeC6ZKm5paH', null, null, '1', 'oKuqO4sIAwVri1BjwyVHLg3yHuwM', null, null, '1543228802', 'Guangdong', 'Guangzhou', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('4', 'http://thirdwx.qlogo.cn/mmopen/vi_32/RdcLe3hDBz53VT7fvGpseRkLoiczfVIHpjnQbDic6kKLtAB2XOibMjJaSNr6GzWKUm9Ez9DsnyDCPutyDfZFIyefg/132', null, '6I+g6JCd6I+g6JCdTWU=', null, null, '1', 'oSuTSslAjDj0zcV18HIb11qAEtQY', null, null, '1543317568', '广东', '广州', '天河区', null, '0', '4', '1548039889', '0', '620.00', null, '0', '1', '0.00');
INSERT INTO `tbkl_members` VALUES ('5', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83erHKudIBPolHZ2A9IoaKOicAzsQEXNm6HrvG08ZKc5ZCYG2LibwLtXb4NV99kg3oWCPdfVZm2iaKGKCw/132', null, '5bCP5b2s', null, null, '1', 'oSuTSsqsNVYGeJvslNEYo1xrxVsY', null, null, '1543373864', '广东', '广州', '', null, '0', '4', null, '0', '0.00', null, '0', '1', '0.00');
INSERT INTO `tbkl_members` VALUES ('6', 'https://wx.qlogo.cn/mmopen/vi_32/TNV5cElot3v4hTicSnNmsKf1qyKTcP6FV9GjKG4vrLZ4ZHw1RHPoxaEgFIHnBtV3lcyibLfYeVGCTVbw5Cc5YMMg/132', null, 'a2FvcmnorJvlkaJE', null, null, '2', 'oKuqO4j83C3vcbp5WgOeh9K5zl0g', null, null, '1544757491', 'Guangdong', 'Guangzhou', '', null, '0', '4', null, '2', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('7', 'http://thirdwx.qlogo.cn/mmopen/vi_32/clk4aYsSQfgMvPboR48m226FwA0VIAMgjcMdBWGWU6O6hAZiamSrOiafZZja0cpxlDyHT4suCM499s1KScESszNg/132', null, 'VElN', null, null, '1', 'oSuTSskbC-_uPFLTVCOmSy6wy_mc', null, null, '1543384043', '广东', '广州', '', null, '0', '4', null, '0', '0.00', null, '0', '1', '0.00');
INSERT INTO `tbkl_members` VALUES ('8', 'https://wx.qlogo.cn/mmopen/vi_32/vrnibxFVjh20kD34tz0AYNsia6RNbH2DhiaZ1LOjRtCGciby6pqVQ9R3R2jtkbB5AOy0jIf7gic9luo1fgOqNfYfW1Q/132', null, '5paH5bOw', null, null, '1', 'oKuqO4oBfXbDB-diu3WyLihM5i84', null, null, '1543399514', '广东', '广州', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('9', 'http://thirdwx.qlogo.cn/mmopen/vi_32/mYswn9DzRMv9y6c5zHkAtYiawNDbiarricgXJFhkayBJ1tDs6k0FVfLiceerxzp1b3icBSuHoHU40ViadLNJconahK2A/132', null, '5paH5bOw', null, null, '1', 'oSuTSsp7OCelOTS2OAoO82JjPMSs', null, null, '1543399536', '广东', '广州', '', null, '0', '4', null, '0', '0.00', null, '0', '1', '0.00');
INSERT INTO `tbkl_members` VALUES ('10', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKnQ62M6hBEdzdKQTpJCLs6pS1sewCwR9iaLia1JeF8sPZlDQB05nvPWkaY86W1icaicKrI8MUyicXKfjA/132', null, 'SWYgdGhpcyBpcyB0aGUgcmVhbGl0eQ==', null, null, '1', 'oKuqO4pvRf7lfjZiDfR5mKfSMAbo', null, null, '1543890766', '广东', '韶关', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('11', 'https://wx.qlogo.cn/mmopen/vi_32/Z8DQouPCMRYKPmdfa7cic016xJlgmjodjcxSsgGyWmBnUMd59unJJMf6CQGjHDaVpU8rUz1ibWYWzREiaiaD4DnUlg/132', null, '6IWU5qOY6bG87pSi', null, null, '1', 'oKuqO4vW-SADsVzTRklWWkrPre6U', null, null, '1544002751', '广西', '南宁', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('12', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKGh3EB6CjzoWgZc3r2ibaKuPDD3VG8OCfMI83togHwkjG9VD6bqKwiaW0n5p7tUeibg9mrw5sX9w8Pw/132', null, 'U3VtbWVy', null, null, '1', 'oKuqO4pp8CLkLxs5yGkRefpIwkjE', null, null, '1544013960', null, null, '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('13', 'https://wx.qlogo.cn/mmopen/vi_32/Vb4IiaTFKq3iaxuTv3ohc8ania9zM14IUQnjia5BibTcaTHLU6FTic8diaArBkM2yx6kcLrAPf77UuYkh6vcziafKraibUA/132', null, '44CC', null, null, '2', 'oKuqO4ihL1Itp9cANxst6KvMX4PE', null, null, '1544056770', '四川', '达州', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('14', 'https://wx.qlogo.cn/mmopen/vi_32/uuc4eCsxJLcotVls2ea5olic0H2d5W9KcvcmfpPRuKPd5JTk0GojxWdPyAkR47qHVqjE0xUe2jv1asD3Qz3PGkA/132', null, '5LiA5Lmd5Lmd5LiA', null, null, '1', 'oKuqO4vuHhIsRt4BvtDqvqqAlH3A', null, null, '1544092298', '广东', '广州', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('15', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eocFR9BoTPZAhxxUo8rvDm6PuCQlDRGCo1z462oOh4VOBocIDhe6dtJWTCBqKC0JVnfIibUW19WZWA/132', null, '5Lq65r2u5pOB5pOg77yM5ZSv5oiR5b+D6YW444CC', null, null, '1', 'oKuqO4oxZ0XNAHgfg2PfY97QyW0o', null, null, '1544277596', null, null, '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('16', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLjrkr0T5eOSaKgjYskoA6KkSNKIagHiamoQTs4pqbicA41e9yvcWuHGL8H46zMFGZDm0ndm6LYLicZg/132', null, '5b6u56yR', null, null, '2', 'oKuqO4lF9-REIaOGY_fNhtBWm5XQ', null, null, '1544351648', '吉林', '吉林', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('17', 'https://wx.qlogo.cn/mmopen/vi_32/1seOCeOkibic6CmmUoZiajqtp9WT1ctaSK3Jh9gEuXaqV6ePDbmiaghhHgWvG6ZHAe4Jmsia23Tfxcb41I8UeP6vq4w/132', null, '6aKC5q2M', null, null, '1', 'oKuqO4loxNjB4lKJLoEVHDJSLDwo', null, null, '1544425021', 'Guangdong', 'Guangzhou', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('18', 'https://wx.qlogo.cn/mmopen/vi_32/9evWut6LiaTZTwiab3AxYZhBtcKxyDUyaxd9ZLt9FLRbAiaZ7icRBlZsO8cvWHITAmRy5Jxdnsk3bMtexPSm3XT5aA/132', null, '8J+Nkw==', null, null, '2', 'oKuqO4k6-lMBIXFDxsIp4w6tquj0', null, null, '1544426241', null, null, '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('19', 'https://wx.qlogo.cn/mmopen/vi_32/noMvdVzjouy3H8BqJCamia7vf23dJ9ib5pyblAjRqWcqErIleS8muScaxOTTCcIsFxbTlgYpZVD7JmQV2F0szoPA/132', null, '5Li/54GP54Gs54Gd5Lio', null, null, '1', 'oKuqO4v0XP8T8Xa5SpAOvnpPPDkM', null, null, '1544494718', '广东', '珠海', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('20', 'https://wx.qlogo.cn/mmopen/vi_32/5WUROQOnAmkEzcTxb0XbMtXxglKHP3kBxhWlB6QcQLTQrNVkUnD3L0pdKbGZdVhZcugTyM3D8lnPOyaduhO07A/132', null, '5LuY56uL5Yab', null, null, '1', 'oKuqO4gWuz_oELynhu0SodaJUQFI', null, null, '1544523214', 'Guangdong', 'Guangzhou', '', null, '0', '4', null, '0', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('21', 'https://wx.qlogo.cn/mmopen/vi_32/GhXBVPIdJ8DBYB0K46VYTBrO4MGUBvkvkHicYEjc2v1MXkCcwAgiclUwHNBE4E78ibZqoiarKyzbpRamSaBiaDhTiaYA/132', null, 'U2Vlc2F3', null, null, '2', 'oKuqO4hJI5Ef6kBTEavWpvtok2aU', null, null, '1544766194', '吉林', '长春', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('22', 'https://wx.qlogo.cn/mmopen/vi_32/0IiaLfRZtekic4Yw2bP5jUEnVkDJBP1PRcTps7m6rjP42ra73yo4nD21kPSdUsCicxGIqcfr5iaiaHmUjKpBCUOichFw/132', null, '55GL55GL', null, null, '2', 'oKuqO4mrLGkKY8U8m6ecN4UGNu-4', null, null, '1544776908', 'Hunan', 'Hengyang', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('23', 'http://thirdwx.qlogo.cn/mmopen/vi_32/19ItTFRzOhgibRvpDqHLm1HeCw5cuqMKg52nI8cDMicRtg3YCtx9AibRqrtyrJckneOa4tmw4K1kQW9MevdIDgsmA/132', null, '5Li/54GP54Gs54Gd5Lio', null, null, '1', 'oSuTSslmkpMRawQedbqUu6K9GXms', null, null, '1545036092', '广东', '珠海', '', null, '0', '4', null, '19', '241.80', null, '0', '1', '0.00');
INSERT INTO `tbkl_members` VALUES ('24', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83erjlJn8mx9micK1TrWnyql8Rul7HzTgic3glcITeU7ibF4J8oNJCicQowrLG7K3LG4XyToibqSbqLf9ymg/132', null, '6ZmG5bCP5YWtICDjgaTjgII=', null, null, '2', 'oKuqO4kVDxicrn2sydhIXLyAMank', null, null, '1545726936', 'Guangdong', 'Guangzhou', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('25', 'https://wx.qlogo.cn/mmhead/CFXASgaDibqN9xgdmARjSDU55LoSBvYOzqOAvfzjTadQ/132', null, '6ZmI5aak5bOw', null, null, '0', 'oKuqO4u0HOSWJi93zDFbna_qZAhs', null, null, '1545410224', null, null, '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('26', 'https://wx.qlogo.cn/mmhead/cneZJxkw3TJzBtSWAfWak12TKwxrbLDDQ1fsqrjwamI/132', null, '6ZmI5L2z6ZyW', null, null, '0', 'oKuqO4t67hUzMOgFVVPl9fLODJFI', null, null, '1545413767', null, null, '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('27', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLx75UEzW5HO7ztk6WIIxM6XjoyynCQTjVAX7pTbGdAC0yABDVeEueEXLUHibiciaZqjdBSzXjzWWNHQ/132', null, '5beo5YiS566X5peF5ri46ZmILnM=', null, null, '2', 'oKuqO4uvFfRtRYPziPiBkvqv598w', null, null, '1545447241', 'Guangxi', 'Wuzhou', '', null, '0', '4', null, '2', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('28', 'https://wx.qlogo.cn/mmopen/vi_32/JZC4wT8hPVa03jOUhHUpa6cTOkfO03OZPjAwFrdEicJCOrBTiaXEVCyfZmBvxw0ic4fYcqM9CRU8vKlQaNGWYkuzw/132', null, 'U2lyaQ==', null, null, '1', 'oKuqO4ifNsKGwCTENrrFZHrYSBPI', null, null, '1545894515', '广东', '珠海', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('29', 'https://wx.qlogo.cn/mmhead/2K78s7d8KV30engiadM0MFNibRRcLiaVVYZgPmhlNRbYQE/132', null, '5p2o55CH5a6P', null, null, '0', 'oKuqO4j4gWTSSzR5WsFuZduRJQk8', null, null, '1545917402', null, null, '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('30', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJw4EMxz5bgcsQmRTt5OxCHGKWI8SsNnCHrSqfmY7X1UfjiaQtRYRgBSHeib5C5pHvbo2Fe0icaLDAgg/132', null, '5qWe5Lil', null, null, '1', 'oKuqO4lA01wyYPWv3djlErsjSVyc', null, null, '1545977080', '广东', '广州', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('31', 'https://wx.qlogo.cn/mmopen/vi_32/XwibQHw1zZuNGgB8sRAB4vmoeibLUINI68zHFuAenpHRibPo7X9aMoJonibA5IlKyKWsXbmicCU8ntel55JsYxiatC8Q/132', null, '5rGq5aSn6ZSk', null, null, '1', 'oKuqO4hoRziBBbkSycp38zbh8m5I', null, null, '1546166184', 'Guangdong', 'Guangzhou', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('32', 'https://wx.qlogo.cn/mmhead/qUVp3XMOFJBuWkxZsefibf7GNVC3wk08dnk6bkOALQNY/132', null, '6buE6Iq45qyi', null, null, '0', 'oKuqO4oVhlkX2DSo9oItNMzpRtDw', null, null, '1546169547', null, null, '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('33', 'https://wx.qlogo.cn/mmhead/taibXl8HAvyKGMiaJgKicuONmEkynLzmZcHMTKCTonsdjk/132', null, '5ZC05paH54+N', null, null, '0', 'oKuqO4jhxRXQYnvW5HxVKbRX36_8', null, null, '1546336877', null, null, '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('34', 'https://wx.qlogo.cn/mmhead/WWkkwvhBJfZ3x41B7dHdN8gdyRFCGlwT3G676AKqb3w/132', null, '6buE5ZiJ55Cq', null, null, '0', 'oKuqO4uE4t0_UoOq0Gt5poRX7yXc', null, null, '1546529026', null, null, '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('35', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLDBFTMZ8ibI2uGXgu5hffC8RYVyvZ39eTyRk3BFicqesQSyqV2hRu8eNMe9yBaqpe4Vjp3vPSc3jYg/132', null, '5ouJ54Gv', null, null, '1', 'oKuqO4kRROjczwDDecGJzSEFNuoc', null, null, '1546583394', '福建', '厦门', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('36', 'https://wx.qlogo.cn/mmopen/vi_32/Hico11V8zNWib09nS4R4V1V1wL2Hw4vYjuVuX17XVjibSaD1EQnyOWBZuQw39t4AicTuTca0K49iaTHCdxSAg0gB9wA/132', null, '5byA5Yip5a6i5pyNLeWwj+mbhQ==', null, null, '2', 'oKuqO4nxpnzTemZ0NOxy6kZaFe-A', null, null, '1546593110', null, null, '', null, '0', '4', null, '2', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('37', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKGtIx9oQGEAAa3LLTOZlucHBHdJBKLJGCZ8nau1hibIXCMpJVoic1mjemnC6Gia1IYBy8SGyUZztGUQ/132', null, '44CM5oiQ5YOP5b2x6KeG44CN5piO', null, null, '1', 'oKuqO4jyDAiBm3zFdOzSL87ofRhM', null, null, '1546593177', '广东', '广州', '', null, '0', '4', null, '36', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('38', 'https://wx.qlogo.cn/mmopen/vi_32/Nd5NA82DD3XPwnDr4xfQibicm8Tmn7x0eJsqAhJPNWCXAkdYc6ZVno4Iem1ruxXS5n6cxj42FGBlqh0ajxWE1sHg/132', null, '8J+HsiDwn4e3IMK38J+HtSDwn4ev8J+Zgw==', null, null, '1', 'oKuqO4lLwsy3sg8sKBvWRI3sPmRU', null, null, '1546669426', '贵州', '六盘水', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('39', 'https://wx.qlogo.cn/mmhead/ia0CgdyibMhZ9t4xq9wicTVSz4dnMRoLgr2FnIicPpY4Iibo/132', 'Uploads/Index/headimg/oKuqO4phHFAws-SYzHZbIt4qMOGA.jpg', '6YOR6K+a5Yeh', null, null, '0', 'oKuqO4phHFAws-SYzHZbIt4qMOGA', null, null, '1546834981', null, null, '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('40', 'http://thirdwx.qlogo.cn/mmopen/vi_32/icZkpcQSIbAzPibDLdu9lxKBxib2HxEuoYwwkV3IHIUFP8iaePM4xuTDgpiboM0hzdicn4CGB5NHpmorfqxPLiazJVFeQ/132', null, 'a2FvcmnorJvlkaJE', null, null, '2', 'oSuTSsoTEvoU0U1cAsb-Kffr3GYs', null, null, '1546848803', '广东', '广州', '', null, '0', '4', null, '0', '0.00', null, '0', '1', '0.00');
INSERT INTO `tbkl_members` VALUES ('41', 'http://thirdwx.qlogo.cn/mmopen/vi_32/ZQCI2xm58sdoUXaTH1pFsRCuvBGdxUia8tElNL1zMcib4ghzJUbTdGCtenJB1P5s6vPe7wJfaP1wOcrTibicqryy7A/132', null, '5rKJ5rWu772e5Y2a772e', null, null, '1', 'oSuTSsqtc-h7g1MVWlEvEZxz7VrQ', null, null, '1546848824', '广东', '广州', '', null, '0', '4', null, '0', '0.00', null, '0', '1', '0.00');
INSERT INTO `tbkl_members` VALUES ('42', 'http://thirdwx.qlogo.cn/mmopen/vi_32/A8RNTepHjEpK9sIIgickZILJ7hFMiaouIZxeXiaLiamU2lKAr1jcianbyyo9felV6JTc28SqdDJp6X2AIg2attRBibQw/132', null, '5p2O5a2Q6LGq8J+RivCfj7vwn5GK8J+Pu/CfkYrwn4+7', null, null, '1', 'oSuTSsoLi2zwGfAj2xZu7m_GYSZc', null, null, '1546849626', '广东', '珠海', '南山区', null, '0', '4', '1546850431', '0', '0.00', null, '0', '1', '0.00');
INSERT INTO `tbkl_members` VALUES ('43', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJbvksMyvYuaHHWib7gHZA9JLKhZujrX0kcd8Rx5RSJRwVzoBJMUkMhrq54v88EHJPRy0lsC8ibVARQ/132', null, '5pit5ZCb', null, null, '2', 'oSuTSssT1OQGq7oj4DDQZiZTkDcA', null, null, '1546854290', '广东', '深圳', '', null, '0', '4', null, '0', '0.00', null, '0', '1', '0.00');
INSERT INTO `tbkl_members` VALUES ('44', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqU60N4fdag8AaibKJSwN8RABB3WAIyslibYY3Svqdyyib6YWdCZhDLsu01EOK8wsRKb0DFFPNRVC9Mw/132', null, '8J+MumJldHRlciBEIOOAgg==', null, null, '2', 'oSuTSspebvB_GHFObDlOLmllYZyI', null, null, '1546855239', '', '', '', null, '0', '4', null, '0', '0.00', null, '0', '1', '0.00');
INSERT INTO `tbkl_members` VALUES ('45', 'http://thirdwx.qlogo.cn/mmopen/vi_32/x5gNDFHFHKlNwzDec6YicCUNrE1llJAbTeqUhx3VtOzouyvVVY4uaVicXKD8SUmcXrPsEFQgyqpaqxYXibNPeSnGQ/132', null, 'fHzpo5jokL3nmoTmnqvlj7bvvZ4=', null, null, '1', 'oSuTSsqegIcE32PCGq3NZZPYi2hw', null, null, '1546855913', '广东', '肇庆', '', null, '0', '4', null, '0', '0.00', null, '0', '1', '0.00');
INSERT INTO `tbkl_members` VALUES ('46', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLZKY5Hxthjzuxf9XkfeH8cbCV3noPAtalFCreibjhdWNNHbtkbpNndhJgnicZ1diczcgbUR0pGIHtqg/132', null, '54y05a2Q', null, null, '1', 'oSuTSssaPlhzF9kHvdk4GPgGZ9fY', null, null, '1546857503', '广东', '广州', '', null, '0', '4', null, '0', '0.00', null, '0', '1', '0.00');
INSERT INTO `tbkl_members` VALUES ('47', 'https://wx.qlogo.cn/mmopen/vi_32/yicCH4S5evKV6NicYptMwicUraQp2eGsicgs4JicCribpGTMAB8EbXEZrfnWLywIpvose7kEVjqBkyjaBnXhAvolU4Yw/132', 'Uploads/Index/headimg/oKuqO4qdEdbe1rya2uhKSO5chiKo.jpg', 'SVTlsI/nu7Xnvoo=', null, null, '1', 'oKuqO4qdEdbe1rya2uhKSO5chiKo', null, null, '1546908387', '广东', '广州', '', null, '0', '4', null, '2', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('48', 'https://wx.qlogo.cn/mmopen/vi_32/MrhVJ2JvibYRQShJcqFUMmuLexfEjFFniaTchibCfwiaVgaVpOUZaxurPxaz7SKkkf7WBjiblR4EjY1wwNXibgb252Rg/132', 'Uploads/Index/headimg/oKuqO4izJAqKiU-b0w19Sv0yRoUY.jpg', '5rOV5ouJ5Yip', null, null, '1', 'oKuqO4izJAqKiU-b0w19Sv0yRoUY', null, null, '1546927082', '广东', '广州', '', null, '0', '4', null, '47', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('49', 'https://wx.qlogo.cn/mmopen/vi_32/98TAiaTqdibfpJ5XocoM04U7gHS3tMbVulib5Tln8OMm71yYYwia63uiaunPRrQdFZibiaibELHtynUyorh0ibdcgMX7mhA/132', 'Uploads/Index/headimg/oKuqO4kGjPx9dn_I57zfDSfW1O_4.jpg', '6ZOd5aSp6Iqx6ZOd5bmV5aKZ5Y6C5a62IOaWueeUnzEzOTI1MTE5NTQ3', null, null, '1', 'oKuqO4kGjPx9dn_I57zfDSfW1O_4', null, null, '1547019144', '广东', '广州', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('50', 'https://wx.qlogo.cn/mmopen/vi_32/5mPpCdibXFNUMeB7jg7WSpNnZqly2p2n6aYkfUAic4tZzTnWkLBXA1pXjibmfOedS0jDFd345PoKhyVbSnTVvEtXQ/132', 'Uploads/Index/headimg/oKuqO4vqBFfu1oFOSklVoelWX-_E.jpg', '5p6X54GPWmVybw==', null, null, '1', 'oKuqO4vqBFfu1oFOSklVoelWX-_E', null, null, '1547118128', '广东', '广州', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('51', 'https://wx.qlogo.cn/mmhead/X7FlGkBzmS5PUgmGLtJ4rqZQYibia1HjnabgwjJKibvo7Y/132', 'Uploads/Index/headimg/oKuqO4py8ejz35otfHJZmBZqC1tk.jpg', '6K64576O546y', null, null, '0', 'oKuqO4py8ejz35otfHJZmBZqC1tk', null, null, '1547185148', null, null, '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('52', 'https://wx.qlogo.cn/mmopen/vi_32/eVNGRicWheNu6PPUiaibcomnWxfcW3xzGwa0zuGg1CzprWd1QGwmib0PIAf8deqrfI7rkgwIWRGyW8W31Q1iaMvt0VQ/132', 'Uploads/Index/headimg/oKuqO4iI87wk-aUxfkmV4j45ORV4.jpg', '5Ymn57uI5Li35puy5LiN5pWj', null, null, '1', 'oKuqO4iI87wk-aUxfkmV4j45ORV4', null, null, '1547946532', '广东', '广州', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('53', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJ2nd0H9DVmzktvMb8ttjdNK79g1amDwAdP3JsEIpfxanXPL4pt139xpMSliaJYmXo5bEyvho49w4w/132', 'Uploads/Index/headimg/oKuqO4mrfhtjo9RRylHFXulV9Kgg.jpg', '54y05a2Q', null, null, '1', 'oKuqO4mrfhtjo9RRylHFXulV9Kgg', null, null, '1548028873', 'Guangdong', 'Guangzhou', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('54', 'https://wx.qlogo.cn/mmopen/vi_32/FwYmFukIy7IANhicvbe2L7yuYAFPBjlxVDNOvwJ2QXH0YLct7gdJ5QYPSLWTia5wtMYabCMiakU4654eQiciaxlqWpw/132', 'Uploads/Index/headimg/oKuqO4rBn8VniPa22RWpdv-Tl4Es.jpg', '44K144K544Kx', null, null, '1', 'oKuqO4rBn8VniPa22RWpdv-Tl4Es', null, null, '1548122015', '广东', '广州', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('55', 'https://wx.qlogo.cn/mmhead/6UK0GZRiabqFBaDiaMRqiaGhszbAfHInBYzZeQutlRpYO0/132', 'Uploads/Index/headimg/oKuqO4khgsj09ORZaWoC-8NEAV8U.jpg', '6K645bCa6L6+', null, null, '0', 'oKuqO4khgsj09ORZaWoC-8NEAV8U', null, null, '1548137907', null, null, '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('56', 'http://thirdwx.qlogo.cn/mmopen/vi_32/8Hhgy5FwcPYolvkJ3cibcRpmgYXmCZCjKAGUVJicJyzVAIRfqfzdxYgribFiaeYna2tsqcG2iavmibgjpTp6HnleicwHg/132', null, 'QUNFIOmZiOaXpeS4sCAo5Lit5Zu955S15L+hIO+8iQ==', null, null, '1', 'oSuTSspS9w47BgIUrCmuT_k4hFo4', null, null, '1548233616', '广东', '广州', '', null, '0', '4', null, '0', '0.00', null, '0', '1', '0.00');
INSERT INTO `tbkl_members` VALUES ('57', 'https://wx.qlogo.cn/mmopen/vi_32/ia9w3tFtngQIn5fcXrxuEczmgujAvUSIiaaK0Eksg8ibv7CAib3Lwp5g5mKHicy44L0FqkrK2Y3NMXwKpUVr1JtS6kQ/132', 'Uploads/Index/headimg/oKuqO4uAHA9Bd7kMZWJkPaTCQPXE.jpg', 'KOuIiF/riIgp5ZCb', null, null, '2', 'oKuqO4uAHA9Bd7kMZWJkPaTCQPXE', null, null, '1548638513', '广东', '广州', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('58', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLoFiahGXh02CG1lcqsSHQWy85pYEoDdqib4riaLMYTq0TQiaEyJGW7oKpVUVWgbELfPvWicgxm9NdgLjQ/132', 'Uploads/Index/headimg/oKuqO4tkgRoLLw9K6llaf6tvq66Y.jpg', '6Iqx', null, null, '0', 'oKuqO4tkgRoLLw9K6llaf6tvq66Y', null, null, '1548764557', null, null, '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('59', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJH5aePJFledYVY9LbdfOSP2Z72MI36IGy8hqh9pic7hIEUvY3LOLuRCRQFjHsJOBlNgNJaSQzFCsQ/132', 'Uploads/Index/headimg/oKuqO4nPscU8dfvHo1TiVZAUGeEo.jpg', '5byA5Yip572R57uc56eR5oqAQOW+ruS/oeWwj+eoi+W6jw==', null, null, '1', 'oKuqO4nPscU8dfvHo1TiVZAUGeEo', null, null, '1551101760', '广东', '广州', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('60', 'https://wx.qlogo.cn/mmopen/vi_32/iaWmxyYXa4PIJaCsKT00w1V5C473pxz1qkqK4PG7cnJJFJSjQDKicunF2HIgNtdOQGodT0qcH8HZSjHSOnYUKGKQ/132', 'Uploads/Index/headimg/oKuqO4vTd1f9URxhc_rlrAm6xVrE.jpg', '5pmf5rO9', null, null, '1', 'oKuqO4vTd1f9URxhc_rlrAm6xVrE', null, null, '1551144125', '吉林', '长春', '', null, '0', '4', null, '59', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('61', 'https://wx.qlogo.cn/mmhead/oMflPnnEmnnTWESsu3FmHq7ib2oLp2YUIeibZ6pGyGoTw/132', 'Uploads/Index/headimg/oKuqO4h_a-gDV72i5S-mZDgN8d1I.jpg', '5p6X5aiB5Y+L', null, null, '0', 'oKuqO4h_a-gDV72i5S-mZDgN8d1I', null, null, '1551328954', null, null, '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('62', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIy8a7Qv45Jv11J01iac663cJxpRRia9wPJR0acQNiaJyULkFdY30Af5jmTROVupSHWP4MtaT0DN2wibg/132', 'Uploads/Index/headimg/oKuqO4gHnmLRVQv4EautEezyNZfY.jpg', 'SmVycnle5puJ6Lyd', null, null, '1', 'oKuqO4gHnmLRVQv4EautEezyNZfY', null, null, '1551336879', '广东', '广州', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('63', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqBBBL1vUoTFS3CapkibmjkDre4oibYiaeVPmial6jGuliawUMUMmZbriceeN3KAzjvFu1FIbuyibEW1oQXA/132', 'Uploads/Index/headimg/oKuqO4tKwL1mJD6x7gaPoBrEmBXQ.jpg', '576O5oCd5YaF6KGj', null, null, '0', 'oKuqO4tKwL1mJD6x7gaPoBrEmBXQ', null, null, '1551406627', null, null, '', null, '0', '4', null, '59', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('64', 'https://wx.qlogo.cn/mmopen/vi_32/fSYicicbTt2QQUaXxKO71puDOhBPp7LMxXhgKJPiayRDByPKGGgDGdqVtT5G5ibTae74I2obkPDAY0Y9RsZdHlSh6A/132', 'Uploads/Index/headimg/oKuqO4t6a1VmWbWVrecUltUviqGM.jpg', 'yo/JqiDSk8mqc8qc', null, null, '2', 'oKuqO4t6a1VmWbWVrecUltUviqGM', null, null, '1551678584', '广东', '广州', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('65', 'https://wx.qlogo.cn/mmopen/vi_32/99U6LEL8nPN5P9xsLQTbQN4L8gmxAS5BWrU8x4r1ZYtlSIwsoKWwEZiasCuPCJibnhppLYIpc4981n0miahbP43Xg/132', 'Uploads/Index/headimg/oKuqO4sCQjEnK4zWqRcIekmZ5NTk.jpg', '5p2O55Ge5piO', null, null, '1', 'oKuqO4sCQjEnK4zWqRcIekmZ5NTk', null, null, '1551683601', '广东', '广州', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('66', 'https://wx.qlogo.cn/mmopen/vi_32/yTZKficyjictTWJ10T1B3lTBIjGorcTB4nZ8heicGsiaGtuiaqaLvMQyuv0QpFrF7Z93Jfzp95vN1MA28XJWXVibPPww/132', 'Uploads/Index/headimg/oKuqO4jafKeBD1WGDtMQSio-QUQQ.jpg', 'QS3nvqTohb7nvZHnu5wt5LqS6IGU572RKyDkuIDnq5nlvI/mnI3liqE=', null, null, '1', 'oKuqO4jafKeBD1WGDtMQSio-QUQQ', null, null, '1551746848', '广东', '广州', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('67', 'https://wx.qlogo.cn/mmhead/OVJEDAwWWKkGrzcSZt1ZK5PqrPqUYlwlNjFhBJllRjk/132', 'Uploads/Index/headimg/oKuqO4ttDWXkj-MsSSy3o0cQpEow.jpg', '5p2O54+u5b+D', null, null, '0', 'oKuqO4ttDWXkj-MsSSy3o0cQpEow', null, null, '1551851441', null, null, '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('68', 'https://wx.qlogo.cn/mmhead/TGulGgFcoB8jLXx2ibFfDzrheZRWREEbjrkY1XmokQnU/132', 'Uploads/Index/headimg/oKuqO4vSeJiz7v56PmBwsIHKFNzo.jpg', '6ZmI5oyv5a6H', null, null, '0', 'oKuqO4vSeJiz7v56PmBwsIHKFNzo', null, null, '1551873573', null, null, '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('69', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIicjATGCPgp0ibqhy0lbGW9SUwNzfSM9maZAUIvouXYZYWzSlYygI41vv6HDwSuVXxpV95pThdbbNA/132', 'Uploads/Index/headimg/oKuqO4shAXYmjeGudWbBiplEv_f0.jpg', '5aiD5aiD', null, null, '2', 'oKuqO4shAXYmjeGudWbBiplEv_f0', null, null, '1551923905', '北京', null, '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('70', 'https://wx.qlogo.cn/mmhead/3goR2WbHur0DVz8PWmQ18U20icalqlX6KXociadiaicF8G8/132', 'Uploads/Index/headimg/oKuqO4lFj0QW1TNq4DRnnRlMkyc0.jpg', '5ZC05a625L2p', null, null, '0', 'oKuqO4lFj0QW1TNq4DRnnRlMkyc0', null, null, '1551942686', null, null, '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('71', 'https://wx.qlogo.cn/mmopen/vi_32/pEKBDcQGwHHXbuBgd3mKweuF8pdg3XTNG6AxELYErY7IfOEofJsXlCgnD6dsAB2Xa9ticic4bTBEFjnVn2ceqxCw/132', 'Uploads/Index/headimg/oKuqO4quO_2hosp-y9s45djOG7ow.jpg', '5ZCO6Z2S5pil5pyf55qE6K+X', null, null, '1', 'oKuqO4quO_2hosp-y9s45djOG7ow', null, null, '1551956972', '广东', '广州', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('72', 'https://wx.qlogo.cn/mmhead/66CydP2XaWI2I47WwRF1ibDnh3OOpjULoHelZo4cap9E/132', 'Uploads/Index/headimg/oKuqO4pTUjLDtRCCkJx8ZcQzChFA.jpg', '6buE5L2p54+K', null, null, '0', 'oKuqO4pTUjLDtRCCkJx8ZcQzChFA', null, null, '1551960660', null, null, '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('73', 'https://wx.qlogo.cn/mmhead/L8VcYzUV9ekI8sPWKaWSDy7wOAzGicokrXN2lUL0V8dE/132', 'Uploads/Index/headimg/oKuqO4h4agcVuegJYpfBMPQ3qu0s.jpg', '6YKT5Zyj5paH', null, null, '0', 'oKuqO4h4agcVuegJYpfBMPQ3qu0s', null, null, '1552044151', null, null, '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');
INSERT INTO `tbkl_members` VALUES ('74', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLCbzuoGvE6TInxicAcq00qrFbPtibJVrEDwUkiastrC0RWjVtrDmE15gIoibmOoP0v1ZENteqJThLHDw/132', 'Uploads/Index/headimg/oKuqO4j34fGRHGWMzliMs6QZsBEY.jpg', 'U0lOR1JFTEE=', null, null, '2', 'oKuqO4j34fGRHGWMzliMs6QZsBEY', null, null, '1552102814', '广东', '广州', '', null, '0', '4', null, '1', '0.00', null, '0', '2', '0.00');

-- ----------------------------
-- Table structure for tbkl_messages
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_messages`;
CREATE TABLE `tbkl_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) DEFAULT NULL COMMENT '反馈内容',
  `members_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员id',
  `headimgurl` varchar(255) DEFAULT '' COMMENT '会员头像',
  `nickname` varchar(255) DEFAULT '' COMMENT '会员昵称',
  `username` varchar(100) DEFAULT '' COMMENT '会员姓名',
  `contact` varchar(50) DEFAULT '' COMMENT '联系方式',
  `ip` varchar(20) NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '反馈时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='反馈表';

-- ----------------------------
-- Records of tbkl_messages
-- ----------------------------
INSERT INTO `tbkl_messages` VALUES ('1', '反馈内容', '1', 'https://wx.qlogo.cn/mmopen/vi_32/f6Npusia1ltfH3ArhzYL1DDqpE5lWeIKtR4rhbSkZCpB65el1Ib7cDGKQnPqtEtQJswzu2BBCZHrh6CVROHg6rw/132', '6I+g6JCd6I+g6JCdTWU=', '韩全涛', '365897@qq.com/13111111111', '127.0.0.1', '1556265286');
INSERT INTO `tbkl_messages` VALUES ('3', '反馈内容', '1', 'https://wx.qlogo.cn/mmopen/vi_32/f6Npusia1ltfH3ArhzYL1DDqpE5lWeIKtR4rhbSkZCpB65el1Ib7cDGKQnPqtEtQJswzu2BBCZHrh6CVROHg6rw/132', '6I+g6JCd6I+g6JCdTWU=', '韩全涛', '365897@qq.com/13111111111', '127.0.0.1', '1556360223');

-- ----------------------------
-- Table structure for tbkl_newyear
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_newyear`;
CREATE TABLE `tbkl_newyear` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_name` varchar(255) DEFAULT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `content` text,
  `tpl` smallint(2) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbkl_newyear
-- ----------------------------
INSERT INTO `tbkl_newyear` VALUES ('1', '浩浩', '韩全涛', '1546134874', '风柔雨润好月圆,良辰美景年年盼,幸福生活天天随,冬去春来似水如烟,流年不复返,人生须尽欢,说一声珍重 道一声平安,祝您新年快乐!', '4', null);
INSERT INTO `tbkl_newyear` VALUES ('2', '套子', '猴子', '1546135980', '一路走来，感谢您对我们的支持，值此节日之际祝您万事如意，幸福美满。', '1', null);
INSERT INTO `tbkl_newyear` VALUES ('3', '智良', '开利网络', '1546137479', '随着新年的钟声，伴着新春的第一抹朝阳，让祝福和希望随春天的绿色成长，带给你满岁的丰硕和芬芳，收获快乐，收获健康，收获如意和吉祥!祝新年快乐', '1', null);

-- ----------------------------
-- Table structure for tbkl_node
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_node`;
CREATE TABLE `tbkl_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=utf8 COMMENT='节点表';

-- ----------------------------
-- Records of tbkl_node
-- ----------------------------
INSERT INTO `tbkl_node` VALUES ('1', 'Admin', '后台管理', '0', null, '1', '0', '1');
INSERT INTO `tbkl_node` VALUES ('3', 'agent', '代理商列表', '0', null, '1', '2', '3');
INSERT INTO `tbkl_node` VALUES ('4', 'agent_edit', '代理商编辑', '0', null, '2', '2', '3');
INSERT INTO `tbkl_node` VALUES ('8', 'agent_delete', '代理商删除', '0', null, '2', '2', '3');
INSERT INTO `tbkl_node` VALUES ('6', 'apply', '代理商审核', '0', null, '4', '2', '3');
INSERT INTO `tbkl_node` VALUES ('7', 'cash', '代理商提现', '0', null, '5', '2', '3');
INSERT INTO `tbkl_node` VALUES ('9', 'config', '代理商配置', '0', null, '7', '2', '3');
INSERT INTO `tbkl_node` VALUES ('10', 'agent_level', '代理商下级', '0', null, '8', '2', '3');
INSERT INTO `tbkl_node` VALUES ('11', 'downcode', '下载代理商二维码', '0', null, '8', '2', '3');
INSERT INTO `tbkl_node` VALUES ('111', 'Banner', '轮播图管理', '0', null, '1', '1', '2');
INSERT INTO `tbkl_node` VALUES ('13', 'index', '轮播图列表', '0', null, '1', '12', '3');
INSERT INTO `tbkl_node` VALUES ('14', 'edit', '轮播图编辑', '0', null, '2', '12', '3');
INSERT INTO `tbkl_node` VALUES ('15', 'banner_delete', '轮播图删除', '0', null, '3', '12', '3');
INSERT INTO `tbkl_node` VALUES ('16', 'Base', '系统配置', '0', null, '3', '1', '2');
INSERT INTO `tbkl_node` VALUES ('17', 'index', '系统配置项', '0', null, '1', '16', '3');
INSERT INTO `tbkl_node` VALUES ('18', 'help', '帮助中心', '0', null, '2', '16', '3');
INSERT INTO `tbkl_node` VALUES ('20', 'logistics', '快递列表', '0', null, '1', '19', '3');
INSERT INTO `tbkl_node` VALUES ('90', 'notice_delete', '公告删除', '0', null, '3', '86', '3');
INSERT INTO `tbkl_node` VALUES ('91', 'notice_editHandle', '公告编辑处理', '0', null, '4', '86', '3');
INSERT INTO `tbkl_node` VALUES ('89', 'notice_edit', '公告编辑', '0', null, '2', '86', '3');
INSERT INTO `tbkl_node` VALUES ('24', 'goods', '商品管理', '0', null, '1', '23', '3');
INSERT INTO `tbkl_node` VALUES ('25', 'goods_edit', '商品编辑', '0', null, '2', '23', '3');
INSERT INTO `tbkl_node` VALUES ('26', 'goods_delete', '商品删除', '0', null, '3', '23', '3');
INSERT INTO `tbkl_node` VALUES ('27', 'goods_cate', '商品分类', '0', null, '4', '23', '3');
INSERT INTO `tbkl_node` VALUES ('28', 'goods_cate_edit', '商品分类编辑', '0', null, '5', '23', '3');
INSERT INTO `tbkl_node` VALUES ('29', 'goods_cate_delete', '商品分类删除', '0', null, '6', '23', '3');
INSERT INTO `tbkl_node` VALUES ('30', 'goods_label', '商品标签', '0', null, '7', '23', '3');
INSERT INTO `tbkl_node` VALUES ('31', 'goods_label_edit', '商品标签编辑', '0', null, '8', '23', '3');
INSERT INTO `tbkl_node` VALUES ('32', 'goods_label_delete', '商品标签删除', '0', null, '9', '23', '3');
INSERT INTO `tbkl_node` VALUES ('33', 'nav', '首页头部导航', '0', null, '9', '23', '3');
INSERT INTO `tbkl_node` VALUES ('34', 'nav_edit', '首页头部导航编辑', '0', null, '9', '23', '3');
INSERT INTO `tbkl_node` VALUES ('35', 'nav_delete', '首页头部导航删除', '0', null, '10', '23', '3');
INSERT INTO `tbkl_node` VALUES ('36', 'index_nav', '首页模块管理', '0', null, '12', '23', '3');
INSERT INTO `tbkl_node` VALUES ('37', 'index_nav_edit', '首页模块编辑', '0', null, '13', '23', '3');
INSERT INTO `tbkl_node` VALUES ('38', 'index_nav_delete', '首页模块删除', '0', null, '14', '23', '3');
INSERT INTO `tbkl_node` VALUES ('39', 'index_adv', '首页广告位列表', '0', null, '15', '23', '3');
INSERT INTO `tbkl_node` VALUES ('40', 'index_adv_edit', '首页广告位编辑', '0', null, '16', '23', '3');
INSERT INTO `tbkl_node` VALUES ('41', 'index_adv_delete', '首页广告位删除', '0', null, '17', '23', '3');
INSERT INTO `tbkl_node` VALUES ('42', 'index_product', '首页产品专区', '0', null, '19', '23', '3');
INSERT INTO `tbkl_node` VALUES ('43', 'index_product_edit', '首页产品专区修改', '0', null, '20', '23', '3');
INSERT INTO `tbkl_node` VALUES ('44', 'index_product_delete', '首页产品专区删除', '0', null, '21', '23', '3');
INSERT INTO `tbkl_node` VALUES ('45', 'order', '订单表', '0', null, '22', '23', '3');
INSERT INTO `tbkl_node` VALUES ('46', 'order_search', '订单查询', '0', null, '23', '23', '3');
INSERT INTO `tbkl_node` VALUES ('47', 'order_edit', '订单处理', '0', null, '24', '23', '3');
INSERT INTO `tbkl_node` VALUES ('48', 'evaluate', '评价列表', '0', null, '26', '23', '3');
INSERT INTO `tbkl_node` VALUES ('49', 'evaluate_delete', '评价删除', '0', null, '27', '23', '3');
INSERT INTO `tbkl_node` VALUES ('51', 'index', '消息列表', '0', null, '1', '50', '3');
INSERT INTO `tbkl_node` VALUES ('52', 'edit', '消息编辑', '0', null, '2', '50', '3');
INSERT INTO `tbkl_node` VALUES ('54', 'Members', '会员管理', '0', null, '7', '1', '2');
INSERT INTO `tbkl_node` VALUES ('55', 'index', '会员列表', '0', null, '1', '54', '3');
INSERT INTO `tbkl_node` VALUES ('56', 'search', '会员查看', '0', null, '2', '54', '3');
INSERT INTO `tbkl_node` VALUES ('57', 'messages', '会员反馈', '0', null, '3', '54', '3');
INSERT INTO `tbkl_node` VALUES ('58', 'address', '会员地址管理', '0', null, '5', '54', '3');
INSERT INTO `tbkl_node` VALUES ('59', 'address_edit', '会员地址编辑', '0', null, '6', '54', '3');
INSERT INTO `tbkl_node` VALUES ('60', 'address_delete', '会员地址删除', '0', null, '7', '54', '3');
INSERT INTO `tbkl_node` VALUES ('61', 'barcode', '定制个人二维码', '0', null, '7', '54', '3');
INSERT INTO `tbkl_node` VALUES ('64', 'bank_cate', '银行类型', '0', null, '1', '62', '3');
INSERT INTO `tbkl_node` VALUES ('65', 'bank_cate_edit', '银行类型编辑', '0', null, '2', '62', '3');
INSERT INTO `tbkl_node` VALUES ('66', 'bank_cate_delete', '银行类型删除', '0', null, '3', '62', '3');
INSERT INTO `tbkl_node` VALUES ('67', 'change', '财务记录表', '0', null, '2', '62', '3');
INSERT INTO `tbkl_node` VALUES ('68', 'change_search', '财务详情', '0', null, '6', '62', '3');
INSERT INTO `tbkl_node` VALUES ('87', 'notice', '公告列表', '0', null, '1', '86', '3');
INSERT INTO `tbkl_node` VALUES ('71', 'share', '分享列表', '0', null, '1', '70', '3');
INSERT INTO `tbkl_node` VALUES ('72', 'share_edit', '分享编辑', '0', null, '2', '70', '3');
INSERT INTO `tbkl_node` VALUES ('73', 'share_delete', '分享删除', '0', null, '3', '70', '3');
INSERT INTO `tbkl_node` VALUES ('92', 'Video', '视频管理', '0', null, '1', '1', '2');
INSERT INTO `tbkl_node` VALUES ('75', 'email', '邮件管理', '0', null, '1', '74', '3');
INSERT INTO `tbkl_node` VALUES ('76', 'emailConfig', '邮件配置', '0', null, '2', '74', '3');
INSERT INTO `tbkl_node` VALUES ('77', 'email_edit', '邮件发送', '0', null, '2', '74', '3');
INSERT INTO `tbkl_node` VALUES ('78', 'email_search', '邮件查看', '0', null, '3', '74', '3');
INSERT INTO `tbkl_node` VALUES ('79', 'email_delete', '邮件删除', '0', null, '5', '74', '3');
INSERT INTO `tbkl_node` VALUES ('80', 'messages', '电信管理', '0', null, '7', '74', '3');
INSERT INTO `tbkl_node` VALUES ('81', 'messages_edit', '短信编辑', '0', null, '8', '74', '3');
INSERT INTO `tbkl_node` VALUES ('82', 'messages_delete', '电信删除', '0', null, '10', '74', '3');
INSERT INTO `tbkl_node` VALUES ('83', 'Rbac', '权限管理', '0', null, '10', '1', '2');
INSERT INTO `tbkl_node` VALUES ('84', 'index', '管理员', '0', null, '1', '83', '3');
INSERT INTO `tbkl_node` VALUES ('93', 'video', '视频列表', '0', null, '1', '92', '3');
INSERT INTO `tbkl_node` VALUES ('94', 'video_edit', '视频编辑', '0', null, '2', '92', '3');
INSERT INTO `tbkl_node` VALUES ('95', 'video_delete', '视频删除', '0', null, '3', '92', '3');
INSERT INTO `tbkl_node` VALUES ('96', 'video_cate', '视频分类', '0', null, '4', '92', '3');
INSERT INTO `tbkl_node` VALUES ('97', 'cate_edit', '分类编辑', '0', null, '5', '92', '3');
INSERT INTO `tbkl_node` VALUES ('98', 'cate_delete', '分类删除', '0', null, '6', '92', '3');
INSERT INTO `tbkl_node` VALUES ('99', 'vip', 'vip列表', '0', null, '7', '92', '3');
INSERT INTO `tbkl_node` VALUES ('101', 'vip_edit', 'vip添加/编辑', '0', null, '8', '92', '3');
INSERT INTO `tbkl_node` VALUES ('102', 'vip_delete', 'vip删除', '0', null, '9', '92', '3');
INSERT INTO `tbkl_node` VALUES ('103', 'order', '订单管理', '0', null, '1', '1', '2');
INSERT INTO `tbkl_node` VALUES ('104', 'order', '订单列表', '0', null, '1', '103', '3');
INSERT INTO `tbkl_node` VALUES ('105', 'order_delete', '订单删除', '0', null, '2', '103', '3');
INSERT INTO `tbkl_node` VALUES ('106', 'apply', '学员管理', '0', null, '1', '1', '2');
INSERT INTO `tbkl_node` VALUES ('107', 'apply', '学员列表', '0', null, '1', '106', '3');
INSERT INTO `tbkl_node` VALUES ('108', 'apply_edit', '添加/编辑', '0', null, '1', '106', '3');
INSERT INTO `tbkl_node` VALUES ('109', 'apply_delete', '删除', '0', null, '3', '106', '3');
INSERT INTO `tbkl_node` VALUES ('110', 'other', '关于平台/报名说明/特权说明', '0', null, '3', '16', '3');
INSERT INTO `tbkl_node` VALUES ('112', 'banner', '轮播图列表', '0', null, '1', '111', '3');
INSERT INTO `tbkl_node` VALUES ('115', 'banner_edit', '添加/编辑', '0', null, '2', '111', '3');
INSERT INTO `tbkl_node` VALUES ('114', 'banner_delete', '轮播图删除', '0', null, '3', '111', '3');

-- ----------------------------
-- Table structure for tbkl_order
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_order`;
CREATE TABLE `tbkl_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ordercode` varchar(50) NOT NULL DEFAULT '' COMMENT '订单号',
  `members_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员id',
  `vip_id` int(11) NOT NULL DEFAULT '0' COMMENT 'vip表主键id',
  `vip_name` varchar(50) NOT NULL DEFAULT '' COMMENT 'vip名称',
  `video_id` int(11) NOT NULL DEFAULT '0' COMMENT '视频id/video表主键',
  `pay_money` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '订单类型：0购买视频；1购买vip',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未支付；1已支付',
  `flag` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0删除；1不删除',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of tbkl_order
-- ----------------------------
INSERT INTO `tbkl_order` VALUES ('8', '2019042809552135281294', '1', '1', '', '0', '6.00', '1', '0', '1', '0', '1556416521', '0');
INSERT INTO `tbkl_order` VALUES ('9', '2019042809573588229181', '1', '0', '', '2', '10.00', '0', '0', '1', '0', '1556416655', '0');
INSERT INTO `tbkl_order` VALUES ('10', '2019042811281336238115', '1', '0', '', '2', '10.00', '0', '0', '1', '0', '1556422093', '0');

-- ----------------------------
-- Table structure for tbkl_order_info
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_order_info`;
CREATE TABLE `tbkl_order_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ordercode` varchar(50) NOT NULL DEFAULT '' COMMENT '订单号',
  `members_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员id',
  `vip_id` int(11) NOT NULL DEFAULT '0' COMMENT 'vip表主键id',
  `vip_name` varchar(50) NOT NULL DEFAULT '' COMMENT 'vip名称',
  `vip_price` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT 'vip费用',
  `video_id` int(11) NOT NULL DEFAULT '0' COMMENT '视频id/video表主键',
  `cate_id` int(11) NOT NULL DEFAULT '0' COMMENT '视频分类id',
  `cate_name` varchar(50) NOT NULL DEFAULT '' COMMENT '视频分类名称',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '视频标题',
  `pic` varchar(200) NOT NULL DEFAULT '' COMMENT '视频封面图',
  `video` varchar(200) NOT NULL DEFAULT '' COMMENT '视频',
  `video_price` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '视频价格',
  `show_time` int(11) NOT NULL DEFAULT '0' COMMENT '上映时间',
  `desp` varchar(200) NOT NULL DEFAULT '' COMMENT '视频简介',
  `content` text COMMENT '视频内容介绍',
  `is_pay` tinyint(1) NOT NULL DEFAULT '0' COMMENT '视频是否免费：0免费；1付费',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='订单信息表';

-- ----------------------------
-- Records of tbkl_order_info
-- ----------------------------
INSERT INTO `tbkl_order_info` VALUES ('4', '2019042809552135281294', '1', '1', 'vip1', '10.00', '0', '0', '', '', '', '', '0.00', '0', '', null, '0', '1556416521', '0');
INSERT INTO `tbkl_order_info` VALUES ('5', '2019042809573588229181', '1', '0', '', '0.00', '2', '1', '娱乐', '视频名称2', '/Uploads/Admin/video/155641605738817.jpg', '/Uploads/Admin/video/2019-04-28/5cc5063bb3cd5.mp4', '10.00', '1556416065', '简介简介', '<p><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span></p>', '1', '1556416655', '0');
INSERT INTO `tbkl_order_info` VALUES ('6', '2019042811281336238115', '1', '0', '', '0.00', '2', '1', '娱乐', '视频名称2', '/Uploads/Admin/video/155641605738817.jpg', '/Uploads/Admin/video/2019-04-28/5cc5063bb3cd5.mp4', '10.00', '1556416065', '简介简介', '<p><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span></p>', '1', '1556422093', '0');

-- ----------------------------
-- Table structure for tbkl_other
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_other`;
CREATE TABLE `tbkl_other` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text COMMENT '内容',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型：0关于本平台；1报名说明/报名同意条款；2会员特权说明',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbkl_other
-- ----------------------------
INSERT INTO `tbkl_other` VALUES ('1', '关于本平台', '<p>关于本平台关于本平台关于本平台关于本平台1111</p>', '0', '1556173877', '1557909485');
INSERT INTO `tbkl_other` VALUES ('2', '报名说明', '<p>1.报名后龙领天下客服部，致电您进行资料确认，请您务必在2018年9月15日前将资料填写好告知客服部老师望积极配合。</p><p>2.学员在集训期间原则上不准离开营地，经批准外出后[未成年营员必须由成人（监护人）陪同]，在离营期间发生的一切问题由学员自行负责。请假外出期间所缺课程不补，费用不退。</p><p>3.如果学员在入营前隐瞒病史，在集训期间隐瞒身体不适的情况。为保障营地内其他人员的身体健康及安全，集训营管理部门将视情况安排其退学或给予相应处理，且所收学费不予退还。</p><p>4.学员入营后须服从集训期间的统一管理，遵守集训营的各项规章制度。在营地期间严禁赌博、打牌、喝酒、打架斗殴、谈恋爱等，否则集训营管理部门有权安排其退学。学费不予退还。</p><p>5.学员在营地期间必须爱护公共财物，如人为故意损坏，需照价赔偿。</p><p>6.学员不允许在营地期间抽烟，营地设有烟雾报警器，如违反一切责任自行承担。&nbsp;</p><p>7.学员不允许打架斗殴，如有打架斗殴，下课期间玩耍，因自身原因导致的后果由学员自行承担。</p><p>8.以上信息家长需如实填写，我们将根据您提供的信息，因材施教。</p>', '1', '1556173877', '1557909481');
INSERT INTO `tbkl_other` VALUES ('3', '特权说明', '<p>购买VIP可免费观看所有视频</p><p><br/></p>', '2', '0', '1557911017');

-- ----------------------------
-- Table structure for tbkl_paylog
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_paylog`;
CREATE TABLE `tbkl_paylog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` varchar(255) NOT NULL DEFAULT '',
  `cash_fee` varchar(255) NOT NULL DEFAULT '',
  `is_subscribe` varchar(255) NOT NULL DEFAULT '',
  `mch_id` varchar(255) NOT NULL DEFAULT '',
  `openid` varchar(255) NOT NULL DEFAULT '',
  `transaction_id` varchar(255) NOT NULL DEFAULT '',
  `total_fee` varchar(255) NOT NULL DEFAULT '',
  `time_end` varchar(255) NOT NULL DEFAULT '',
  `result_code` varchar(255) NOT NULL DEFAULT '',
  `table` varchar(255) NOT NULL DEFAULT '',
  `ordercode` varchar(255) NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='支付日志表';

-- ----------------------------
-- Records of tbkl_paylog
-- ----------------------------

-- ----------------------------
-- Table structure for tbkl_role
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_role`;
CREATE TABLE `tbkl_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `sort` smallint(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of tbkl_role
-- ----------------------------
INSERT INTO `tbkl_role` VALUES ('1', 'admin', null, '0', 'admin', null, '1557475731', '1', '0');
INSERT INTO `tbkl_role` VALUES ('6', 'kefu', null, '0', '客服', '1514249468', '1515377570', '1', '2');
INSERT INTO `tbkl_role` VALUES ('7', '销售', null, '0', '销售', '1556937166', null, '1', '1');

-- ----------------------------
-- Table structure for tbkl_role_user
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_role_user`;
CREATE TABLE `tbkl_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色和用户的中间表';

-- ----------------------------
-- Records of tbkl_role_user
-- ----------------------------
INSERT INTO `tbkl_role_user` VALUES ('1', '9');
INSERT INTO `tbkl_role_user` VALUES ('6', '10');
INSERT INTO `tbkl_role_user` VALUES ('1', '16');

-- ----------------------------
-- Table structure for tbkl_sendemail
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_sendemail`;
CREATE TABLE `tbkl_sendemail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `send` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `status` int(2) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `admin` varchar(255) DEFAULT NULL COMMENT '管理员',
  `name` varchar(255) DEFAULT NULL COMMENT '收件人姓名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='邮件';

-- ----------------------------
-- Records of tbkl_sendemail
-- ----------------------------

-- ----------------------------
-- Table structure for tbkl_sendmsg
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_sendmsg`;
CREATE TABLE `tbkl_sendmsg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '0' COMMENT '0:正常，1：失败',
  `msg` varchar(255) DEFAULT NULL COMMENT '发送描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='发送短信';

-- ----------------------------
-- Records of tbkl_sendmsg
-- ----------------------------

-- ----------------------------
-- Table structure for tbkl_share
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_share`;
CREATE TABLE `tbkl_share` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '分享名称',
  `place` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` smallint(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='分享配置表';

-- ----------------------------
-- Records of tbkl_share
-- ----------------------------

-- ----------------------------
-- Table structure for tbkl_share_config
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_share_config`;
CREATE TABLE `tbkl_share_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sharebg` varchar(255) DEFAULT NULL,
  `head_x` varchar(255) DEFAULT NULL,
  `head_y` varchar(255) DEFAULT NULL,
  `nick_x` varchar(255) DEFAULT NULL,
  `nick_y` varchar(255) DEFAULT NULL,
  `erweima_x` varchar(255) DEFAULT NULL,
  `erweima_y` varchar(255) DEFAULT NULL,
  `nick_color` varchar(255) DEFAULT NULL COMMENT '昵称字体的颜色',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='分享配置表';

-- ----------------------------
-- Records of tbkl_share_config
-- ----------------------------
INSERT INTO `tbkl_share_config` VALUES ('1', '/Uploads/Admin/share/152310482249677.jpg', '10', '11.5', '10', '15', '2', '10.5', '#00f');
INSERT INTO `tbkl_share_config` VALUES ('2', '/Uploads/Admin/share/152310482249677.jpg', '110', '450', '245', '495', '108', '275', '#fff');

-- ----------------------------
-- Table structure for tbkl_url
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_url`;
CREATE TABLE `tbkl_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL COMMENT '链接名称',
  `url` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `sort` smallint(5) DEFAULT NULL,
  `type` smallint(2) DEFAULT '1' COMMENT '1公众号，2：小程序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='链接管理';

-- ----------------------------
-- Records of tbkl_url
-- ----------------------------
INSERT INTO `tbkl_url` VALUES ('1', '首页', '/Index/Index/index.html', '1513441094', '1', '1');
INSERT INTO `tbkl_url` VALUES ('2', '全部商品', '/Index/Mall/goodslist', '1513441117', '2', '1');
INSERT INTO `tbkl_url` VALUES ('3', '推荐商品', '/Index/Mall/goodslist/type/is_red', '1513440990', '3', '1');
INSERT INTO `tbkl_url` VALUES ('4', '推荐新品', '/Index/Mall/goodslist/type/is_new', '1522812022', '3', '1');
INSERT INTO `tbkl_url` VALUES ('5', '购物车', '/Index/Mall/shopcart.html', '1522812043', '5', '1');
INSERT INTO `tbkl_url` VALUES ('6', '个人中心', '/Index/Members/index.html', '1523158031', '6', '1');
INSERT INTO `tbkl_url` VALUES ('7', '我的资料', '/Index/Members/members_info.html', '1523158083', '7', '1');
INSERT INTO `tbkl_url` VALUES ('8', '最新消息', '/Index/MallNews/index.html', '1523158104', '8', '1');
INSERT INTO `tbkl_url` VALUES ('9', '我的收藏', '/Index/Members/collect.html', '1523158120', '9', '1');
INSERT INTO `tbkl_url` VALUES ('10', '我的优惠券', '/Index/Members/coupon.html', '1523158164', '10', '1');
INSERT INTO `tbkl_url` VALUES ('11', '收货地址', '/Index/Members/address.html', '1523158185', '11', '1');
INSERT INTO `tbkl_url` VALUES ('12', '帮助中心', '/Index/Members/help.html', '1523158212', '12', '1');
INSERT INTO `tbkl_url` VALUES ('13', '我要反馈', '/Index/Members/messages.html', '1523158230', '13', '1');
INSERT INTO `tbkl_url` VALUES ('14', '全部订单', '/Index/Members/order.html', '1523158284', '14', '1');
INSERT INTO `tbkl_url` VALUES ('15', '小程序首页', '/pages/index/index', '1524643783', '1', '2');
INSERT INTO `tbkl_url` VALUES ('16', '我要反馈', '/pages/messages/messages', '1528944647', '6', '2');
INSERT INTO `tbkl_url` VALUES ('17', '我的购物车', '/pages/cart/cart', '1528944686', '2', '2');
INSERT INTO `tbkl_url` VALUES ('18', '商品分类', '/pages/category/category', '1528944750', '3', '2');
INSERT INTO `tbkl_url` VALUES ('19', '全部商品', '/pages/goodsList/goodsList', '1528944779', '5', '2');
INSERT INTO `tbkl_url` VALUES ('20', '领取优惠券', '/pages/getCoupon/getCoupon', '1528944805', '7', '2');
INSERT INTO `tbkl_url` VALUES ('21', '会员中心', '/pages/members/members/members', '1528945079', '8', '2');
INSERT INTO `tbkl_url` VALUES ('22', '最新消息', '/pages/members/news/news', '1528945104', '10', '2');
INSERT INTO `tbkl_url` VALUES ('23', '我的收藏', '/pages/members/collect/collect', '1528945125', '11', '2');
INSERT INTO `tbkl_url` VALUES ('24', '我的资料', '/pages/members/membersInfo/membersInfo', '1528945144', '12', '2');
INSERT INTO `tbkl_url` VALUES ('25', '我的优惠券', '/pages/members/coupon/coupon', '1528945163', '13', '2');
INSERT INTO `tbkl_url` VALUES ('26', '收货地址', '/pages/members/address/address', '1528945183', '15', '2');
INSERT INTO `tbkl_url` VALUES ('27', '帮助中心', '/pages/members/help/help', '1528945201', '16', '2');
INSERT INTO `tbkl_url` VALUES ('28', '全部订单', '/pages/members/order/order', '1528945222', '17', '2');
INSERT INTO `tbkl_url` VALUES ('29', '积分明细', '/pages/members/point/point', '1528945242', '18', '2');
INSERT INTO `tbkl_url` VALUES ('30', '我要充值', '/pages/members/rechange/rechange', '1528945266', '20', '2');
INSERT INTO `tbkl_url` VALUES ('31', '代理商申请', '/pages/agentApply/agentApply', '1528945285', '16', '2');
INSERT INTO `tbkl_url` VALUES ('32', '代理商主页', '/pages/agent/index/index', '1528945315', '19', '2');

-- ----------------------------
-- Table structure for tbkl_video
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_video`;
CREATE TABLE `tbkl_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_id` int(11) NOT NULL DEFAULT '0' COMMENT '视频分类id',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `pic` varchar(200) NOT NULL DEFAULT '' COMMENT '封面图',
  `video` varchar(200) NOT NULL DEFAULT '' COMMENT '视频',
  `price` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `show_time` int(11) NOT NULL DEFAULT '0' COMMENT '上映时间',
  `desp` varchar(200) NOT NULL DEFAULT '' COMMENT '视频简介',
  `content` text COMMENT '视频内容介绍',
  `is_pay` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0免费；1付费',
  `is_red` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0不推荐；1推荐',
  `sort` int(11) NOT NULL DEFAULT '9999' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0隐藏；1显示',
  `look` int(7) NOT NULL DEFAULT '0' COMMENT '浏览量',
  `collect` int(7) NOT NULL DEFAULT '0' COMMENT '收藏量',
  `buy_num` int(7) NOT NULL DEFAULT '0' COMMENT '购买人数',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='视频表';

-- ----------------------------
-- Records of tbkl_video
-- ----------------------------
INSERT INTO `tbkl_video` VALUES ('1', '1', '视频名称1', '/Uploads/Admin/video/155641602820601.jpg', '/Uploads/Admin/video/2019-04-28/5cc5061fac94a.mp4', '0.00', '1556416039', '简介简介简介简介简介', '<p><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span></p>', '0', '1', '1', '1', '0', '0', '0', '1556416039', '0');
INSERT INTO `tbkl_video` VALUES ('2', '1', '视频名称2', '/Uploads/Admin/video/155641605738817.jpg', '/Uploads/Admin/video/2019-04-28/5cc5063bb3cd5.mp4', '10.00', '1556416065', '简介简介', '<p><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span></p>', '1', '1', '2', '1', '0', '0', '0', '1556416065', '0');
INSERT INTO `tbkl_video` VALUES ('3', '1', '视频名称2', '/Uploads/Admin/video/155641605738817.jpg', '/Uploads/Admin/video/2019-04-28/5cc5063bb3cd5.mp4', '10.00', '1556416065', '简介简介', '<p><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span></p>', '1', '1', '2', '1', '0', '0', '0', '1556416065', '0');
INSERT INTO `tbkl_video` VALUES ('4', '1', '视频名称2', '/Uploads/Admin/video/155641605738817.jpg', '/Uploads/Admin/video/2019-04-28/5cc5063bb3cd5.mp4', '10.00', '1556416065', '简介简介', '<p><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span></p>', '1', '1', '2', '1', '0', '0', '0', '1556416065', '0');
INSERT INTO `tbkl_video` VALUES ('5', '1', '视频名称2', '/Uploads/Admin/video/155641605738817.jpg', '/Uploads/Admin/video/2019-04-28/5cc5063bb3cd5.mp4', '10.00', '1556416065', '简介简介', '<p><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span></p>', '1', '1', '2', '1', '0', '0', '0', '1556416065', '0');
INSERT INTO `tbkl_video` VALUES ('6', '1', '视频名称2', '/Uploads/Admin/video/155641605738817.jpg', '/Uploads/Admin/video/2019-04-28/5cc5063bb3cd5.mp4', '10.00', '1556416065', '简介简介', '<p><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span></p>', '1', '1', '2', '1', '0', '0', '0', '1556416065', '0');
INSERT INTO `tbkl_video` VALUES ('7', '1', '视频名称2', '/Uploads/Admin/video/155641605738817.jpg', '/Uploads/Admin/video/2019-04-28/5cc5063bb3cd5.mp4', '10.00', '1556416065', '简介简介', '<p><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span></p>', '1', '1', '2', '1', '0', '0', '0', '1556416065', '0');
INSERT INTO `tbkl_video` VALUES ('8', '1', '视频名称2', '/Uploads/Admin/video/155641605738817.jpg', '/Uploads/Admin/video/2019-04-28/5cc5063bb3cd5.mp4', '10.00', '1556416065', '简介简介', '<p><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span></p>', '1', '1', '2', '1', '0', '0', '0', '1556416065', '0');
INSERT INTO `tbkl_video` VALUES ('9', '1', '视频名称2', '/Uploads/Admin/video/155641605738817.jpg', '/Uploads/Admin/video/2019-04-28/5cc5063bb3cd5.mp4', '10.00', '1556416065', '简介简介', '<p><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span></p>', '1', '1', '2', '1', '0', '0', '0', '1556416065', '0');
INSERT INTO `tbkl_video` VALUES ('10', '1', '视频名称2', '/Uploads/Admin/video/155641605738817.jpg', '/Uploads/Admin/video/2019-04-28/5cc5063bb3cd5.mp4', '10.00', '1556416065', '简介简介', '<p><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span></p>', '1', '1', '2', '1', '0', '0', '0', '1556416065', '0');
INSERT INTO `tbkl_video` VALUES ('11', '1', '视频名称2', '/Uploads/Admin/video/155641605738817.jpg', '/Uploads/Admin/video/2019-04-28/5cc5063bb3cd5.mp4', '10.00', '1556416065', '简介简介', '<p><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span></p>', '1', '1', '2', '1', '0', '0', '0', '1556416065', '0');
INSERT INTO `tbkl_video` VALUES ('12', '1', '视频名称2', '/Uploads/Admin/video/155641605738817.jpg', '/Uploads/Admin/video/2019-04-28/5cc5063bb3cd5.mp4', '10.00', '1556416065', '简介简介', '<p><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span></p>', '1', '1', '2', '1', '0', '0', '0', '1556416065', '0');
INSERT INTO `tbkl_video` VALUES ('13', '1', '视频名称2', '/Uploads/Admin/video/155641605738817.jpg', '/Uploads/Admin/video/2019-04-28/5cc5063bb3cd5.mp4', '10.00', '1556416065', '简介简介', '<p><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span></p>', '1', '1', '2', '1', '0', '0', '0', '1556416065', '0');
INSERT INTO `tbkl_video` VALUES ('14', '1', '视频名称2', '/Uploads/Admin/video/155641605738817.jpg', '/Uploads/Admin/video/2019-04-28/5cc5063bb3cd5.mp4', '10.00', '1556416065', '简介简介', '<p><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span></p>', '1', '1', '2', '1', '0', '0', '0', '1556416065', '0');
INSERT INTO `tbkl_video` VALUES ('15', '1', '视频名称2', '/Uploads/Admin/video/155641605738817.jpg', '/Uploads/Admin/video/2019-04-28/5cc5063bb3cd5.mp4', '10.00', '1556416065', '简介简介', '<p><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Helvetica Neue\", Helvetica, tahoma, arial, Verdana, sans-serif, 宋体; font-size: 14px; text-align: right; background-color: rgb(255, 255, 255);\">内容</span></p>', '1', '1', '2', '1', '1', '0', '0', '1556416065', '0');
INSERT INTO `tbkl_video` VALUES ('16', '0', '水电费第三方', '', '/Uploads/Admin/video/2019-05-17/5cde60920b6e1.mp4', '0.00', '1558077591', '大范甘迪', '<p>胜多负少史蒂夫</p>', '0', '1', '0', '1', '0', '0', '0', '1558077591', '0');

-- ----------------------------
-- Table structure for tbkl_video_cate
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_video_cate`;
CREATE TABLE `tbkl_video_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT '0',
  `name` varchar(25) NOT NULL DEFAULT '' COMMENT '分类名称',
  `pic` varchar(200) NOT NULL DEFAULT '' COMMENT '分类图片',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0不显示；1显示',
  `sort` smallint(5) NOT NULL DEFAULT '9999',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='视频分类表';

-- ----------------------------
-- Records of tbkl_video_cate
-- ----------------------------
INSERT INTO `tbkl_video_cate` VALUES ('1', '0', '娱乐', '', '1', '9999', '1556416004', '0');

-- ----------------------------
-- Table structure for tbkl_video_look
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_video_look`;
CREATE TABLE `tbkl_video_look` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `members_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `video_id` int(11) NOT NULL DEFAULT '0' COMMENT '视频id',
  `num` int(11) DEFAULT '1' COMMENT '观看次数',
  `look_time` int(11) NOT NULL DEFAULT '0' COMMENT '观看时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='视频观看记录表';

-- ----------------------------
-- Records of tbkl_video_look
-- ----------------------------

-- ----------------------------
-- Table structure for tbkl_vip
-- ----------------------------
DROP TABLE IF EXISTS `tbkl_vip`;
CREATE TABLE `tbkl_vip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT 'vip名称',
  `price` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '费用',
  `is_red` int(1) NOT NULL DEFAULT '0' COMMENT '0不推荐；1推荐',
  `term` int(5) NOT NULL DEFAULT '0' COMMENT '有效期/月',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0隐藏；1显示',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='vip费用表';

-- ----------------------------
-- Records of tbkl_vip
-- ----------------------------
INSERT INTO `tbkl_vip` VALUES ('1', 'vip1', '10.00', '0', '1', '1', '1556415990', '0');
DROP TRIGGER IF EXISTS `del_address`;
DELIMITER ;;
CREATE TRIGGER `del_address` AFTER DELETE ON `tbkl_members` FOR EACH ROW begin
     delete from tbkl_address where members_id = old.id;
     delete from tbkl_agent where members_id = old.id;
     delete from tbkl_bank where members_id = old.id;
     delete from tbkl_cash where members_id = old.id;
     delete from tbkl_collect where members_id = old.id;
     delete from tbkl_commission_change where members_id = old.id;
     delete from tbkl_get_coupon where members_id = old.id;
     delete from tbkl_group_order where members_id = old.id;
     delete from tbkl_mall_order where members_id = old.id;
     delete from tbkl_messages where members_id = old.id;
     delete from tbkl_money_change where members_id = old.id;
     delete from tbkl_money_recharge where members_id = old.id;
     delete from tbkl_point_change where members_id = old.id;
     delete from tbkl_order_evaluate where members_id = old.id;
end
;;
DELIMITER ;
