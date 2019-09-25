
-- -----------------------------
-- Table structure for `td_message`
-- -----------------------------
DROP TABLE IF EXISTS `td_message`;
CREATE TABLE `td_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0' COMMENT '姓名',
  `phone` varchar(11) NOT NULL DEFAULT '0' COMMENT '手机号',
  `content` varchar(200) NOT NULL DEFAULT '0' COMMENT '留言内容',
  `create_time` int(10) NOT NULL DEFAULT '0',
  `update_time` int(10) NOT NULL DEFAULT '0',
  `touid` int(10) NOT NULL DEFAULT '0' COMMENT '留言对象',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=gbk COMMENT='留言表';

-- -----------------------------
-- Records of `td_message`
-- -----------------------------
INSERT INTO `td_message` VALUES ('2', 'safafaf', 'safafss', 'fasfafaf', '1563267581', '1563267581', '87');
INSERT INTO `td_message` VALUES ('4', 'safaf', 'sadaf', '<figure class=\"table\"><table><tbody><tr><td colspan=\"2\">ff</td></tr><tr><td>ff</td><td>ff</td></tr></tbody></table></figure>', '1563268692', '1563268692', '83');
