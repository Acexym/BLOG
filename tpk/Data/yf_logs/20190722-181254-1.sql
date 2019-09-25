
-- -----------------------------
-- Table structure for `yf_logs`
-- -----------------------------
DROP TABLE IF EXISTS `yf_logs`;
CREATE TABLE `yf_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` char(30) NOT NULL COMMENT '操作节点-控制器和方法',
  `operator` int(11) NOT NULL DEFAULT '0' COMMENT '操作员，管理员id',
  `description` char(60) NOT NULL COMMENT '描述',
  `operate_time` int(10) NOT NULL COMMENT '操作时间',
  `operate_ip` varchar(20) NOT NULL COMMENT '操作IP',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=utf8;

