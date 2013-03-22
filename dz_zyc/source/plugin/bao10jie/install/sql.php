<?php

/**
 * 安装保10洁帖子净化插件
 */
if (!defined('IN_DISCUZ')) exit('Access Denied');
//创建新表的SQL
$sql_purify = "CREATE TABLE IF NOT EXISTS`" . $tb_purify . "` (
		  `pid` INT(10) UNSIGNED NOT NULL COMMENT '帖子ID',
		  `sig` TINYINT(2) NOT NULL DEFAULT '-1' COMMENT '保10洁接口返回的标识',
		  `sendtime` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '调用接口时间',
		  `edittime` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更改帖子状态时间',
		  `updatetime` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '帖子信息被更新时间',
		  `isignore` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '帖子是否忽略或确认,0:未确认 1:已确认 2:已忽略',
		  `applys` TINYINT(2) UNSIGNED NOT NULL DEFAULT '0' COMMENT '数据补发次数，-1：正在补发 0：未补发 N：补发N次',
		  `first` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '是否是首帖',
		  `fid` SMALLINT(6) NOT NULL DEFAULT '0' COMMENT '版块id',
		  `tid` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '主题id',
		  `status` TINYINT(2) NOT NULL DEFAULT '-3' COMMENT '帖子状态字段,-3:未识别;-2:仅识别;-1:删除;0:待审;1:通过',
		  PRIMARY KEY (`pid`),
		  KEY `pid` (`pid`),
		  KEY `sendtime` (`sendtime`),
		  KEY `edittime` (`edittime`),
		  KEY `updatetime` (`updatetime`)
		  ) ENGINE=MYISAM COMMENT='帖子的净化的结果标识'";
$sql_cache = "CREATE TABLE IF NOT EXISTS`" . $tb_cache . "` (
		  `pid` INT(10) UNSIGNED NOT NULL COMMENT '帖子ID',
		  `fid` SMALLINT(6) NOT NULL DEFAULT '0' COMMENT '版块id',
		  `tid` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '主题id',
		  `first` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '是否是首帖',
		  `audit` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '',
		  `title` VARCHAR(80) NULL COMMENT '帖子标题',
		  `message` MEDIUMTEXT NOT NULL COMMENT '帖子内容',
		  `userid` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '作者id',
		  `author` VARCHAR(15) NULL COMMENT '作者姓名',
		  `ip` VARCHAR(15) NULL COMMENT '发帖者ip',
		  `date` VARCHAR(20) NULL COMMENT 'pubdate',
		  `timestamp` INT(10) NOT NULL DEFAULT '0' COMMENT '等待标引时间戳',
		  `locked` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '是否正被发送标引而锁定, 0:未锁定;1:锁定',
		  PRIMARY KEY (`pid`),
		  KEY `pid` (`pid`),
		  KEY `timestamp` (`timestamp`)
		  ) ENGINE=MYISAM COMMENT='帖子内容缓存表'";