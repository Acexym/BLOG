
-- -----------------------------
-- Table structure for `yf_auth_group_access`
-- -----------------------------
DROP TABLE IF EXISTS `yf_auth_group_access`;
CREATE TABLE `yf_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `yf_auth_group_access`
-- -----------------------------
INSERT INTO `yf_auth_group_access` VALUES ('9', '1');
INSERT INTO `yf_auth_group_access` VALUES ('31', '1');
INSERT INTO `yf_auth_group_access` VALUES ('39', '1');
INSERT INTO `yf_auth_group_access` VALUES ('40', '1');
