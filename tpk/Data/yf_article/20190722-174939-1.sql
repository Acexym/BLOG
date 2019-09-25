
-- -----------------------------
-- Table structure for `yf_article`
-- -----------------------------
DROP TABLE IF EXISTS `yf_article`;
CREATE TABLE `yf_article` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL COMMENT '标题',
  `keyword` varchar(100) DEFAULT NULL COMMENT '关键字',
  `desc` varchar(150) DEFAULT NULL COMMENT '描述',
  `remark` varchar(150) DEFAULT NULL COMMENT '摘要',
  `content` text COMMENT '内容',
  `cid` int(11) NOT NULL COMMENT '分类ID',
  `pic` varchar(150) DEFAULT NULL COMMENT '图片',
  `source` varchar(45) DEFAULT NULL COMMENT '来源',
  `addtime` int(10) DEFAULT NULL COMMENT '发布时间',
  `views` int(11) DEFAULT '0' COMMENT '浏览次数',
  `ischeck` tinyint(1) DEFAULT '0' COMMENT '0：审核不通过，1：审核通过',
  `isnominate` tinyint(1) DEFAULT '0' COMMENT '0：不推荐 ，1：推荐',
  `istop` tinyint(1) DEFAULT '0' COMMENT '0：不置项，1：置顶',
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- -----------------------------
-- Records of `yf_article`
-- -----------------------------
INSERT INTO `yf_article` VALUES ('5', '基于HTML5的云虚拟主机配置界面', 'HTML5', '云计算大行其道，上期开源中国的原创会就有好几位云计算专家演讲，从底层的虚拟化技术，到上', '云计算大行其道，上期开源中国的原创会就有好几位云计算专家演讲，从底层的虚拟化技术，到上层的云存储和应用API，耳濡目染，也受益匪浅，算是大势所趋，回头看看Qunee组件，借这个趋势，可以在云计算可视化上发挥作用', '<p>云计算大行其道，上期开源中国的原创会就有好几位云计算专家演讲，从底层的虚拟化技术，到上层的云存储和应用API，耳濡目染，也受益匪浅，算是大势所趋，回头看看Qunee组件，借这个趋势，可以在云计算可视化上发挥作用，最近就有客户用Qunee实现VPC配置图，并对交互做了定制，细节不便多说，本文主要介绍Qunee交互扩展方面的思路</p><p>云计算大行其道，上期开源中国的原创会就有好几位云计算专家演讲，从底层的虚拟化技术，到上层的云存储和应用API，耳濡目染，也受益匪浅，算是大势所趋，回头看看Qunee组件，借这个趋势，可以在云计算可视化上发挥作用，最近就有客户用Qunee实现VPC配置图，并对交互做了定制，细节不便多说，本文主要介绍Qunee交互扩展方面的思路</p><p><br/></p>', '2', 'uploads\\20180915\\de745e1dd252517d4557ae18e34bbf60.jpg', '原创', '1537023128', '0', '0', '1', '0');
INSERT INTO `yf_article` VALUES ('6', 'HTML5简介及HTML5的发展前景', 'HTML5', 'HTML5是最新一代的HTML标准，它不仅拥有HTML中所有的特性，而且增加了许多实用的特性，如视频、音频、画布（canvas）等。2012年12月17日，万维网联盟（W3C）', 'HTML5是最新一代的HTML标准，它不仅拥有HTML中所有的特性，而且增加了许多实用的特性，如视频、音频、画布（canvas）等。2012年12月17日，万维网联盟（W3C）', '<h2 style=\"margin: 1.71429rem 0px; padding: 0px; border: 0px; font-size: 1.28571rem; vertical-align: baseline; clear: both; line-height: 1.6; color: rgb(68, 68, 68); font-family: Helvetica, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">什么是HTML5</h2><p style=\"margin-top: 0px; margin-bottom: 1.71429rem; padding: 0px; border: 0px; font-size: 14px; vertical-align: baseline; line-height: 1.71429; color: rgb(68, 68, 68); font-family: Helvetica, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">HTML5是最新一代的HTML标准，它不仅拥有HTML中所有的特性，而且增加了许多实用的特性，如视频、音频、画布（canvas）等。2012年12月17日，万维网联盟（W3C）正式宣布凝结了大量网络工作者心血的HTML5规范已经正式定稿。根据W3C的发言稿称：“HTML5是开放的Web网络平台的奠基石。”</p><h2 style=\"margin: 1.71429rem 0px; padding: 0px; border: 0px; font-size: 1.28571rem; vertical-align: baseline; clear: both; line-height: 1.6; color: rgb(68, 68, 68); font-family: Helvetica, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">HTML5可以做什么</h2><p style=\"margin-top: 0px; margin-bottom: 1.71429rem; padding: 0px; border: 0px; font-size: 14px; vertical-align: baseline; line-height: 1.71429; color: rgb(68, 68, 68); font-family: Helvetica, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">HTML5作为HTML标准，你当然可以用它来实现之前HTML可以实现的功能，除此之外，我们还可以用HTML5做以下特别的事情：</p><h3 style=\"margin: 1.71429rem 0px; padding: 0px; border: 0px; font-size: 1.14286rem; vertical-align: baseline; clear: both; line-height: 1.84615; color: rgb(68, 68, 68); font-family: Helvetica, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">1、本地存储</h3><p style=\"margin-top: 0px; margin-bottom: 1.71429rem; padding: 0px; border: 0px; font-size: 14px; vertical-align: baseline; line-height: 1.71429; color: rgb(68, 68, 68); font-family: Helvetica, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">基于HTML5开发的网页APP拥有更短的启动时间，更快的联网速度，这些全得益于HTML5 APP Cache，以及本地存储功能。Indexed DB（html5本地存储最重要的技术之一）和API说明文档。</p><h3 style=\"margin: 1.71429rem 0px; padding: 0px; border: 0px; font-size: 1.14286rem; vertical-align: baseline; clear: both; line-height: 1.84615; color: rgb(68, 68, 68); font-family: Helvetica, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">2、实现多媒体更加简单</h3><p style=\"margin-top: 0px; margin-bottom: 1.71429rem; padding: 0px; border: 0px; font-size: 14px; vertical-align: baseline; line-height: 1.71429; color: rgb(68, 68, 68); font-family: Helvetica, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">我们可以利用HTML5的&lt;video&gt;和&amp;[......]</p><p><br/></p>', '2', '', '原创', '1537023174', '0', '0', '1', '0');
INSERT INTO `yf_article` VALUES ('7', 'PHP能做什么', 'PHP', 'HP 可以生成动态页面内容  PHP 可以创建、打开、读取、写入、关闭服务器上的文件', 'HP 可以生成动态页面内容  PHP 可以创建、打开、读取、写入、关闭服务器上的文件  PHP 可以收集表单数据', '<ul style=\"list-style-type: none;\" class=\" list-paddingleft-2\"><li><p>PHP 可以生成动态页面内容<br/></p></li><li><p>PHP 可以创建、打开、读取、写入、关闭服务器上的文件<br/></p></li><li><p>PHP 可以收集表单数据<br/></p></li><li><p>PHP 可以发送和接收 cookies<br/></p></li><li><p>PHP 可以添加、删除、修改您的数据库中的数据<br/></p></li><li><p>PHP 可以限制用户访问您的网站上的一些页面<br/></p></li><li><p>PHP 可以加密数据</p></li></ul><p><br/></p>', '1', 'uploads\\20180915\\c719f3c16887442774d7cdb5ea96c280.jpg', '原创', '1537023238', '0', '0', '1', '0');
INSERT INTO `yf_article` VALUES ('8', 'PHP局部和全局作用域', 'PHP作用域', '在所有函数外部定义的变量，拥有全局作用域。除了函数外，全局变量可以被脚本中的任何部分访问，要在一个函数中访问一个全局变量，需要使用 global 关键字。  在 PHP 函数内部声明的变量是局部变量，仅能在函数内部访问：', '在所有函数外部定义的变量，拥有全局作用域。除了函数外，全局变量可以被脚本中的任何部分访问，要在一个函数中访问一个全局变量，需要使用 global 关键字。  在 PHP 函数内部声明的变量是局部变量，仅能在函数内部访问：', '<p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; word-wrap: break-word; word-break: break-all; font-size: 14px; font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;Microsoft YaHei&quot;, &quot;Noto Sans CJK SC&quot;, &quot;WenQuanYi Micro Hei&quot;, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">在所有函数外部定义的变量，拥有全局作用域。除了函数外，全局变量可以被脚本中的任何部分访问，要在一个函数中访问一个全局变量，需要使用 global 关键字。</p><p style=\"border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 2em; word-wrap: break-word; word-break: break-all; font-size: 14px; font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;Microsoft YaHei&quot;, &quot;Noto Sans CJK SC&quot;, &quot;WenQuanYi Micro Hei&quot;, Arial, sans-serif; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">在 PHP 函数内部声明的变量是局部变量，仅能在函数内部访问：</p><pre class=\"brush:php;toolbar:false\">&lt;?php\r\n$x=5;&nbsp;//&nbsp;全局变量\r\nfunction&nbsp;myTest(){&nbsp;\r\n&nbsp;&nbsp;&nbsp;&nbsp;$y=10;&nbsp;//&nbsp;局部变量\r\n&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;&lt;p&gt;测试变量在函数内部:&lt;p&gt;&quot;;&nbsp;&nbsp;&nbsp;&nbsp;\r\n&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;变量&nbsp;x&nbsp;为:&nbsp;$x&quot;;&nbsp;&nbsp;&nbsp;&nbsp;\r\n&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;&lt;br&gt;&quot;;&nbsp;&nbsp;&nbsp;\r\n&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;变量&nbsp;y&nbsp;为:&nbsp;$y&quot;;\r\n&nbsp;&nbsp;&nbsp;&nbsp;}\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;myTest();\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;&lt;p&gt;测试变量在函数外部:&lt;p&gt;&quot;;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;变量&nbsp;x&nbsp;为:&nbsp;$x&quot;;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;&lt;br&gt;&quot;;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&quot;变量&nbsp;y&nbsp;为:&nbsp;$y&quot;;\r\n?&gt;</pre><p><br/></p>', '1', 'uploads\\20180915\\e39974eaac7b837ded99831090f22576.jpg', '原创', '1537023415', '7', '0', '1', '0');
INSERT INTO `yf_article` VALUES ('9', ' ThinkPHP5.1.24版本发布——命令行增强，增加查看路由列表指令', 'ThinkPHP5', '该版本主要增加了命令行的表格输出功能，并增加了查看路由定义以及快速生成命令行类的指令，以及修正了社区的一些反馈问题。支持上一个版本无缝升级！', '该版本主要增加了命令行的表格输出功能，并增加了查看路由定义以及快速生成命令行类的指令，以及修正了社区的一些反馈问题。支持上一个版本无缝升级！', '<p><span style=\"color: rgb(50, 50, 50); font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; background-color: rgb(255, 255, 255);\">该版本主要增加了命令行的表格输出功能，并增加了查看路由定义以及快速生成命令行类的指令，以及修正了社区的一些反馈问题。支持上一个版本无缝升级！</span></p><h2 style=\"margin: 0px; padding: 0px; color: rgb(50, 50, 50); font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; white-space: normal; background-color: rgb(255, 255, 255);\">【主要更新日志】</h2><p><span style=\"color: rgb(50, 50, 50); font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; background-color: rgb(255, 255, 255);\">* 修正`Request`类的`file`方法</span><br/><span style=\"color: rgb(50, 50, 50); font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; background-color: rgb(255, 255, 255);\">* 修正路由的`cache`方法</span><br/><span style=\"color: rgb(50, 50, 50); font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; background-color: rgb(255, 255, 255);\">* 修正路由缓存的一处问题</span><br/><span style=\"color: rgb(50, 50, 50); font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; background-color: rgb(255, 255, 255);\">* 改进上传文件获取的异常处理</span><br/><span style=\"color: rgb(50, 50, 50); font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; background-color: rgb(255, 255, 255);\">* 改进`fetchCollection`方法支持传入数据集类名</span><br/><span style=\"color: rgb(50, 50, 50); font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; background-color: rgb(255, 255, 255);\">* 修正多级控制器的注解路由生成</span><br/><span style=\"color: rgb(50, 50, 50); font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; background-color: rgb(255, 255, 255);\">* 改进`Middleware`类`clear`方法</span><br/><span style=\"color: rgb(50, 50, 50); font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; background-color: rgb(255, 255, 255);\">* 增加`route:list`指令用于</span><a href=\"https://www.kancloud.cn/manual/thinkphp5_1/752690\" target=\"_blank\" style=\"color: rgb(114, 185, 57); text-decoration-line: none; font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; white-space: normal; background-color: rgb(255, 255, 255);\">查看定义的路由</a><span style=\"color: rgb(50, 50, 50); font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; background-color: rgb(255, 255, 255);\">&nbsp;并支持排序</span><br/><span style=\"color: rgb(50, 50, 50); font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; background-color: rgb(255, 255, 255);\">* 命令行增加`Table`输出类</span><br/><span style=\"color: rgb(50, 50, 50); font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; background-color: rgb(255, 255, 255);\">* `Command`类增加`table`方法用于输出表格</span><br/><span style=\"color: rgb(50, 50, 50); font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; background-color: rgb(255, 255, 255);\">* 改进搜索器查询方法支持别名定义</span><br/><span style=\"color: rgb(50, 50, 50); font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; background-color: rgb(255, 255, 255);\">* 命令行配置增加`auto_path`参数用于定义自动载入的命令类路径</span><br/><span style=\"color: rgb(50, 50, 50); font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; background-color: rgb(255, 255, 255);\">* 增加`make:command`指令用于</span><a href=\"https://www.kancloud.cn/manual/thinkphp5_1/354146\" target=\"_blank\" style=\"color: rgb(114, 185, 57); text-decoration-line: none; font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; white-space: normal; background-color: rgb(255, 255, 255);\">快速生成指令</a><br/><span style=\"color: rgb(50, 50, 50); font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; background-color: rgb(255, 255, 255);\">* 改进`make:controller`指令对操作方法后缀的支持</span><br/><span style=\"color: rgb(50, 50, 50); font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; background-color: rgb(255, 255, 255);\">* 改进命令行的定义文件支持索引数组 用于指令对象的惰性加载</span><br/><span style=\"color: rgb(50, 50, 50); font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; background-color: rgb(255, 255, 255);\">* 改进`value`和`column`方法对后续查询结果的影响</span><br/><span style=\"color: rgb(50, 50, 50); font-family: &quot;Century Gothic&quot;, &quot;Microsoft yahei&quot;; background-color: rgb(255, 255, 255);\">* 改进`RuleName`类的`setRule`方法</span></p><p><br/></p>', '3', 'uploads\\20180915\\708d523e55cd1dc9b440ad5c7c8b2f50.jpg', '原创', '1537023486', '15', '0', '1', '0');
INSERT INTO `yf_article` VALUES ('10', '测试博文', '', '', '', '<p>5765757</p>', '25', 'uploads\\20180928\\029cb42ce853ca20d4b532d053b22771.jpg', '原创', '1538066871', '35', '0', '1', '0');
INSERT INTO `yf_article` VALUES ('11', 'en', '111', '111', '111', '<p>safafaf</p>', '28', 'uploads\\20190711\\69882792f256c98d5dd5d8de9d18a58c.jpg', '原创', '1562808791', '2', '0', '1', '0');
INSERT INTO `yf_article` VALUES ('12', 'safaf', 'asfaf', 'asags', 'asfaf', '', '33', '', '原创a', '1562900757', '135', '0', '1', '0');
INSERT INTO `yf_article` VALUES ('13', 'fffffff', 'saaaaaaaf', 'fsasafaf', 'afafaf', '<p>fffffffffffffffssssssssssssssssafffffffffffffffffffffffffff</p>', '28', 'uploads\\20190712\\a71e08e3e7ccf7760a17ab4c4b34fb12.jpg', '原创', '1562908572', '137', '0', '1', '0');
