CREATE TABLE IF NOT EXISTS `b2bbuilder_user_correct` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(8) DEFAULT NULL,
  `fromuser` int(8) DEFAULT NULL,
  `position` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mobile` varchar(18) CHARACTER SET utf8 DEFAULT NULL,
  `contact` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `province` char(20) CHARACTER SET utf8 DEFAULT NULL,
  `city` char(20) CHARACTER SET utf8 DEFAULT NULL,
  `addr` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `tel` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `zip` varchar(6) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  `statu` tinyint(1) DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=MYISAM  DEFAULT CHARSET=utf8 COMMENT='用户信息纠错　' AUTO_INCREMENT=0 ;