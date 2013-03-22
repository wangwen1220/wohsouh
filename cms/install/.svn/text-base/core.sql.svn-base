SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `cmstop_aca`;
CREATE TABLE `cmstop_aca` (
  `acaid` smallint(5) unsigned NOT NULL auto_increment,
  `parentid` smallint(5) unsigned default NULL,
  `app` varchar(15) NOT NULL,
  `controller` varchar(30) default NULL,
  `action` varchar(255) default NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY  (`acaid`),
  UNIQUE KEY `app` (`app`,`controller`,`action`),
  KEY `parentid` (`parentid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2001;

DROP TABLE IF EXISTS `cmstop_admin`;
CREATE TABLE `cmstop_admin` (
  `userid` mediumint(8) unsigned NOT NULL,
  `roleid` tinyint(3) unsigned default NULL,
  `departmentid` tinyint(3) unsigned default NULL,
  `name` char(20) NOT NULL,
  `sex` tinyint(1) unsigned default NULL,
  `birthday` date default NULL,
  `photo` varchar(100) default NULL,
  `qq` char(15) default NULL,
  `msn` char(40) default NULL,
  `telephone` char(18) default NULL,
  `mobile` char(11) default NULL,
  `address` char(100) default NULL,
  `zipcode` char(6) default NULL,
  `created` int(10) unsigned NOT NULL,
  `createdby` mediumint(8) unsigned NOT NULL,
  `updated` int(10) unsigned default NULL,
  `updatedby` mediumint(8) unsigned default NULL,
  `disabled` tinyint(1) unsigned NOT NULL default '0',
  `pv` int(10) unsigned NOT NULL default '0',
  `posts` mediumint(8) unsigned NOT NULL default '0',
  `comments` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`userid`),
  KEY `roleid` (`roleid`),
  KEY `departmentid` (`departmentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_admin_log`;
CREATE TABLE `cmstop_admin_log` (
  `logid` int(10) unsigned NOT NULL auto_increment,
  `aca` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `userid` mediumint(8) unsigned default NULL,
  `ip` varchar(15) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY  (`logid`),
  KEY `userid` (`userid`,`logid`),
  KEY `time` (`time`,`logid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_admin_stat`;
CREATE TABLE `cmstop_admin_stat` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `userid` mediumint(8) unsigned NOT NULL,
  `date` date NOT NULL,
  `posts` mediumint(8) unsigned NOT NULL default '0',
  `comments` mediumint(8) unsigned NOT NULL default '0',
  `pv` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `userid` (`userid`,`date`),
  KEY `date` (`date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_app`;
CREATE TABLE `cmstop_app` (
  `app` varchar(15) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(100) NOT NULL,
  `version` varchar(5) NOT NULL,
  `author` varchar(40) NOT NULL,
  `author_url` varchar(50) NOT NULL,
  `author_email` varchar(40) NOT NULL,
  `install_time` int(10) unsigned NOT NULL default '0',
  `update_time` int(10) unsigned NOT NULL default '0',
  `disabled` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`app`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_article`;
CREATE TABLE `cmstop_article` (
  `contentid` mediumint(8) unsigned NOT NULL,
  `subtitle` varchar(120) default NULL,
  `author` varchar(50) default NULL,
  `editor` varchar(15) default NULL,
  `description` varchar(255) default NULL,
  `content` mediumtext,
  `pagecount` tinyint(2) unsigned NOT NULL default '0',
  `saveremoteimage` tinyint(1) unsigned NOT NULL default '1',
  `words_count` smallint(5) unsigned NOT NULL default '0',
  `payment` decimal(6,2) unsigned NOT NULL default '0.00',
  `payment_price` decimal(4,2) unsigned NOT NULL default '0.00',
  PRIMARY KEY  (`contentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_attachment`;
CREATE TABLE `cmstop_attachment` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contentid` mediumint(8) unsigned DEFAULT NULL,
  `filename` varchar(100) NOT NULL,
  `filepath` varchar(100) NOT NULL,
  `alias` varchar(50) DEFAULT NULL,
  `filemime` varchar(50) NOT NULL,
  `fileext` varchar(10) NOT NULL,
  `filesize` int(10) unsigned NOT NULL DEFAULT '0',
  `isimage` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `thumb` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `downloads` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `created` int(10) unsigned NOT NULL DEFAULT '0',
  `createdby` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL,
  `fid` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`aid`),
  KEY `fid` (`fid`,`aid`),
  KEY `createdby` (`createdby`,`aid`),
  KEY `contentid` (`contentid`,`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_attachment_folder`;
CREATE TABLE `cmstop_attachment_folder` (
  `fid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `parent` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` varchar(200) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `createdby` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`fid`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_attachment_folder_recent`;
CREATE TABLE `cmstop_attachment_folder_recent` (
  `rid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL,
  `fid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `uid` (`uid`,`time`),
  KEY `fid` (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

DROP TABLE IF EXISTS `cmstop_cache`;
CREATE TABLE `cmstop_cache` (
  `tablename` varchar(30) NOT NULL,
  `primary` varchar(20) NOT NULL,
  `allcache` tinyint(1) unsigned NOT NULL default '1',
  `allfields` varchar(255) NOT NULL default '*',
  `rowcache` tinyint(1) unsigned NOT NULL default '0',
  `rowfields` varchar(255) NOT NULL default '*',
  PRIMARY KEY  (`tablename`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_category`;
CREATE TABLE IF NOT EXISTS `cmstop_category` (
  `catid` smallint(5) unsigned NOT NULL auto_increment,
  `parentid` smallint(5) unsigned default NULL,
  `name` varchar(20) NOT NULL,
  `alias` varchar(20) NOT NULL,
  `parentids` varchar(255) default NULL,
  `childids` text,
  `workflowid` tinyint(3) unsigned default NULL,
  `model` text,
  `template_index` varchar(100) NOT NULL,
  `template_list` varchar(100) NOT NULL,
  `template_date` varchar(100) NOT NULL,
  `path` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `iscreateindex` tinyint(1) unsigned NOT NULL default '1',
  `urlrule_index` varchar(100) NOT NULL,
  `urlrule_list` varchar(100) NOT NULL,
  `urlrule_show` varchar(100) NOT NULL,
  `enablecontribute` tinyint(1) unsigned NOT NULL default '0',
  `keywords` varchar(255) default NULL,
  `description` varchar(255) default NULL,
  `posts` mediumint(8) unsigned NOT NULL default '0',
  `comments` mediumint(8) unsigned NOT NULL default '0',
  `pv` int(10) unsigned NOT NULL default '0',
  `sort` tinyint(3) unsigned NOT NULL default '0',
  `disabled` tinyint(1) unsigned NOT NULL default '0',
  `htmlcreated` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`catid`),
  KEY `parentid` (`parentid`,`disabled`,`sort`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_category_priv`;
CREATE TABLE `cmstop_category_priv`(
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  KEY `catid` (`catid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_category_stat`;
CREATE TABLE `cmstop_category_stat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL,
  `date` date NOT NULL,
  `posts` smallint(5) unsigned NOT NULL DEFAULT '0',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `pv` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `catid` (`catid`,`date`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_content`;
CREATE TABLE `cmstop_content` (
  `contentid` mediumint(8) unsigned NOT NULL auto_increment,
  `catid` smallint(5) unsigned NOT NULL,
  `modelid` tinyint(2) unsigned NOT NULL,
  `title` char(80) NOT NULL,
  `color` char(7) default NULL,
  `thumb` char(60) default NULL,
  `tags` char(60) default NULL,
  `sourceid` smallint(5) unsigned default NULL,
  `url` char(100) default NULL,
  `weight` tinyint(3) unsigned NOT NULL default '60',
  `status` tinyint(1) unsigned NOT NULL default '6',
  `created` int(10) unsigned NOT NULL,
  `createdby` mediumint(8) unsigned NOT NULL,
  `published` int(10) unsigned default NULL,
  `publishedby` mediumint(8) unsigned default NULL,
  `unpublished` int(10) unsigned default NULL,
  `unpublishedby` mediumint(8) unsigned default NULL,
  `modified` int(10) unsigned default NULL,
  `modifiedby` mediumint(8) unsigned default NULL,
  `checked` int(10) unsigned default NULL,
  `checkedby` mediumint(8) unsigned default NULL,
  `locked` int(10) unsigned default NULL,
  `lockedby` mediumint(8) unsigned default NULL,
  `noted` int(10) unsigned default NULL,
  `notedby` mediumint(8) unsigned default NULL,
  `note` tinyint(1) unsigned NOT NULL default '0',
  `workflow_step` tinyint(1) unsigned default NULL,
  `workflow_roleid` tinyint(3) unsigned default NULL,
  `iscontribute` tinyint(1) unsigned NOT NULL default '0',
  `spaceid` mediumint(8) unsigned default NULL,
  `related` tinyint(3) unsigned NOT NULL default '0',
  `pv` mediumint(8) unsigned NOT NULL default '0',
  `allowcomment` tinyint(1) unsigned NOT NULL default '0',
  `comments` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`contentid`),
  KEY `catid` (`catid`,`status`,`modelid`,`published`),
  KEY `modelid` (`modelid`,`status`,`catid`,`published`),
  KEY `status` (`status`,`modelid`,`published`),
  KEY `createdby` (`createdby`,`status`,`published`),
  KEY `weight` (`weight`,`status`,`catid`,`published`),
  KEY `spaceid` (`spaceid`,`status`,`published`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_content_log`;
CREATE TABLE `cmstop_content_log` (
  `logid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contentid` mediumint(8) unsigned NOT NULL,
  `action` varchar(10) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `createdby` mediumint(8) unsigned NOT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`logid`),
  KEY `createdby` (`createdby`),
  KEY `contentid` (`contentid`,`created`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_content_note`;
CREATE TABLE `cmstop_content_note` (
  `noteid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contentid` mediumint(8) unsigned NOT NULL,
  `note` varchar(255) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `createdby` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`noteid`),
  KEY `createdby` (`createdby`),
  KEY `contentid` (`contentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_content_tag`;
CREATE TABLE `cmstop_content_tag` (
  `contentid` mediumint(8) unsigned NOT NULL,
  `tagid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`tagid`,`contentid`),
  KEY `contentid` (`contentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_content_version`;
CREATE TABLE `cmstop_content_version` (
  `versionid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contentid` mediumint(8) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `data` longtext NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `createdby` mediumint(8) unsigned NOT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`versionid`),
  KEY `contentid` (`contentid`),
  KEY `createdby` (`createdby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_cron`;
CREATE TABLE `cmstop_cron` (
  `cronid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('system','special') DEFAULT 'system',
  `name` varchar(50) NOT NULL,
  `app` varchar(20) NOT NULL,
  `param` varchar(100) DEFAULT NULL,
  `controller` varchar(20) NOT NULL,
  `action` varchar(20) NOT NULL,
  `lastrun` int(10) unsigned DEFAULT NULL,
  `nextrun` int(10) unsigned DEFAULT NULL,
  `mode` tinyint(1) unsigned DEFAULT '1',
  `time` int(10) unsigned DEFAULT NULL,
  `starttime` int(10) unsigned DEFAULT NULL,
  `interval` smallint(5) unsigned DEFAULT NULL,
  `times` smallint(5) unsigned DEFAULT NULL,
  `already` smallint(5) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned DEFAULT NULL,
  `day` varchar(90) DEFAULT NULL,
  `weekday` varchar(15) DEFAULT NULL,
  `hour` varchar(64) DEFAULT NULL,
  `minute` varchar(20) DEFAULT NULL,
  `disabled` tinyint(1) unsigned DEFAULT '0',
  `hidden` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`cronid`),
  KEY `nextrun` (`nextrun`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_cron_log`;
CREATE TABLE `cmstop_cron_log` (
  `logid` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `cronid` smallint(5) unsigned DEFAULT NULL,
  `runtime` int(10) unsigned DEFAULT NULL,
  `runSuccess` tinyint(1) unsigned DEFAULT '1',
  `info` varchar(255) DEFAULT NULL,
  `success` tinyint(1) unsigned DEFAULT '1',
  `error` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`logid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_department`;
CREATE TABLE `cmstop_department` (
  `departmentid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` tinyint(3) unsigned DEFAULT NULL,
  `parentids` varchar(255) DEFAULT NULL,
  `childids` text,
  `name` varchar(20) NOT NULL,
  `sort` tinyint(3) unsigned DEFAULT '0',
  `leaderid` tinyint(3) unsigned DEFAULT NULL,
  `posts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `pv` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`departmentid`),
  KEY `parentid` (`parentid`),
  KEY `leaderid` (`leaderid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_department_role`;
CREATE TABLE `cmstop_department_role` (
  `departmentid` tinyint(3) unsigned NOT NULL,
  `roleid` tinyint(3) unsigned NOT NULL,
  KEY `roleid` (`roleid`),
  KEY `departmentid` (`departmentid`,`roleid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_department_stat`;
CREATE TABLE `cmstop_department_stat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `departmentid` smallint(5) unsigned NOT NULL,
  `date` date NOT NULL,
  `posts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `pv` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `departmentid` (`departmentid`,`date`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_dsn`;
CREATE TABLE `cmstop_dsn` (
  `dsnid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `driver` varchar(10) NOT NULL,
  `host` varchar(100) NOT NULL DEFAULT '',
  `port` smallint(6) DEFAULT NULL,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(30) DEFAULT NULL,
  `dbname` varchar(20) NOT NULL,
  `pconnect` tinyint(1) NOT NULL DEFAULT '0',
  `charset` varchar(20) DEFAULT NULL,
  `created` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`dsnid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_filterword`;
CREATE TABLE `cmstop_filterword` (
  `filterwordid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `pattern` varchar(100) NOT NULL,
  `replacement` varchar(100) NOT NULL,
  PRIMARY KEY (`filterwordid`),
  UNIQUE KEY `pattern` (`pattern`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_ipbanned`;
CREATE TABLE `cmstop_ipbanned` (
  `ip` char(15) NOT NULL,
  `expires` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_keyword`;
CREATE TABLE `cmstop_keyword` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `createdby` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_member`;
CREATE TABLE `cmstop_member` (
  `userid` mediumint(8) unsigned NOT NULL auto_increment,
  `username` char(15) NOT NULL,
  `password` char(32) NOT NULL,
  `email` char(40) NOT NULL,
  `groupid` tinyint(3) unsigned NOT NULL default '5',
  `avatar` tinyint(1) unsigned NOT NULL default '0',
  `regip` char(15) NOT NULL,
  `regtime` int(10) unsigned NOT NULL default '0',
  `lastloginip` char(15) NOT NULL,
  `lastlogintime` int(10) unsigned NOT NULL default '0',
  `logintimes` smallint(5) unsigned NOT NULL default '0',
  `posts` smallint(5) unsigned NOT NULL default '0',
  `comments` smallint(5) unsigned NOT NULL default '0',
  `pv` mediumint(8) unsigned NOT NULL default '0',
  `credits` smallint(5) unsigned NOT NULL default '0',
  `salt` char(6) default NULL,
  PRIMARY KEY  (`userid`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `groupid` (`groupid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_member_detail`;
CREATE TABLE `cmstop_member_detail` (
  `userid` mediumint(8) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `sex` tinyint(1) unsigned NOT NULL default '1',
  `birthday` date default NULL,
  `telephone` varchar(15) default NULL,
  `mobile` varchar(11) default NULL,
  `job` varchar(32) default NULL,
  `address` varchar(100) default NULL,
  `zipcode` varchar(6) default NULL,
  `qq` varchar(15) default NULL,
  `msn` varchar(40) default NULL,
  `authstr` varchar(32) default NULL,
  `remarks` varchar(255) default NULL,
  PRIMARY KEY  (`userid`),
  KEY `birthday` (`birthday`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_member_group`;
CREATE TABLE `cmstop_member_group` (
  `groupid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `allowlogin` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `column` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allowcontribute` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `allowcomment` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `issystem` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `tabview` tinyint(1) NOT NULL DEFAULT '0',
  `remarks` varchar(255) NOT NULL,
  PRIMARY KEY (`groupid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_member_login_log`;
CREATE TABLE `cmstop_member_login_log` (
  `logid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(15) NOT NULL,
  `ip` char(15) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `succeed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`logid`),
  KEY `username` (`username`,`succeed`,`time`),
  KEY `ip` (`ip`,`succeed`,`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_menu`;
CREATE TABLE `cmstop_menu` (
  `menuid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` smallint(5) unsigned DEFAULT NULL,
  `parentids` varchar(255) DEFAULT NULL,
  `childids` text,
  `name` varchar(20) NOT NULL,
  `url` varchar(100) NOT NULL,
  `target` enum('_self','_blank','right') DEFAULT NULL,
  `sort` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`menuid`),
  KEY `parentid` (`parentid`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_model`;
CREATE TABLE `cmstop_model` (
  `modelid` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `alias` varchar(15) NOT NULL,
  `description` varchar(255) NOT NULL,
  `template_list` varchar(100) NOT NULL,
  `template_show` varchar(100) NOT NULL,
  `posts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `pv` int(10) unsigned NOT NULL DEFAULT '0',
  `sort` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`modelid`)
) ENGINE=InnoDB  AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_model_stat`;
CREATE TABLE `cmstop_model_stat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modelid` tinyint(2) unsigned NOT NULL,
  `date` date NOT NULL,
  `posts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `pv` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `modelid` (`modelid`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_mymenu`;
CREATE TABLE `cmstop_mymenu` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `url` varchar(100) NOT NULL,
  `userid` mediumint(8) unsigned NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_note`;
CREATE TABLE `cmstop_note` (
  `userid` mediumint(8) NOT NULL,
  `note` text NOT NULL,
  `lastmodified` int(10) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_online`;
CREATE TABLE `cmstop_online` (
  `onlineid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` mediumint(8) unsigned DEFAULT NULL,
  `groupid` tinyint(3) unsigned DEFAULT NULL,
  `roleid` tinyint(3) unsigned DEFAULT NULL,
  `ip` int(10) unsigned NOT NULL,
  `time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`onlineid`),
  KEY `time` (`time`,`ip`,`userid`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_psn`;
CREATE TABLE `cmstop_psn` (
  `psnid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `path` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`psnid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101;

DROP TABLE IF EXISTS `cmstop_related`;
CREATE TABLE `cmstop_related` (
  `relatedid` int(10) unsigned NOT NULL auto_increment,
  `contentid` mediumint(8) unsigned default NULL,
  `title` varchar(80) NOT NULL,
  `thumb` varchar(100) default NULL,
  `url` varchar(255) NOT NULL,
  `time` date default NULL,
  `sort` tinyint(2) unsigned NOT NULL default '0',
  PRIMARY KEY  (`relatedid`),
  KEY `contentid` (`contentid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_role`;
CREATE TABLE `cmstop_role` (
  `roleid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  PRIMARY KEY (`roleid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_role_aca`;
CREATE TABLE `cmstop_role_aca` (
  `roleid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `acaid` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`roleid`,`acaid`),
  KEY `acaid` (`acaid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_section`;
CREATE TABLE `cmstop_section` (
  `sectionid` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `type` enum('commend','auto','html') NOT NULL default 'auto',
  `data` text,
  `frequency` smallint(5) unsigned NOT NULL default '0',
  `updated` int(10) unsigned default NULL,
  `sort` tinyint(3) unsigned NOT NULL default '0',
  `created` int(10) unsigned NOT NULL,
  `createdby` mediumint(8) unsigned NOT NULL,
  `modified` int(10) unsigned default NULL,
  `modifiedby` mediumint(8) unsigned default NULL,
  `published` int(10) unsigned default NULL,
  `publishedby` mediumint(8) unsigned default NULL,
  `memo` text,
  `num` smallint(5) unsigned default '0',
  `classid` smallint(5) unsigned default '1',
  PRIMARY KEY  (`sectionid`),
  KEY `classid` (`classid`,`sort`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_section_class`;
CREATE TABLE `cmstop_section_class` (
  `classid` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `sort` tinyint(3) unsigned NOT NULL default '0',
  `memo` text,
  PRIMARY KEY  (`classid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_section_data`;
CREATE TABLE `cmstop_section_data` (
  `dataid` int(10) unsigned NOT NULL auto_increment,
  `sectionid` smallint(5) unsigned NOT NULL,
  `contentid` mediumint(8) unsigned default NULL,
  `title` varchar(100) NOT NULL,
  `color` varchar(7) default NULL,
  `url` varchar(100) default NULL,
  `thumb` varchar(100) default NULL,
  `description` text,
  `sort` tinyint(3) unsigned NOT NULL default '0',
  `created` int(10) unsigned NOT NULL,
  `createdby` mediumint(8) unsigned NOT NULL,
  `commended` int(10) unsigned default NULL,
  `commendedby` mediumint(8) unsigned default NULL,
  PRIMARY KEY  (`dataid`),
  KEY `sectionid` (`sectionid`,`sort`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_section_priv`;
CREATE TABLE `cmstop_section_priv` (
  `sectionid` smallint(5) unsigned NOT NULL default '0',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`sectionid`,`userid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_session`;
CREATE TABLE `cmstop_session` (
  `sessionid` varchar(32) NOT NULL,
  `lastvisit` int(10) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  PRIMARY KEY (`sessionid`),
  KEY `lastvisit` (`lastvisit`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_setting`;
CREATE TABLE `cmstop_setting` (
  `app` varchar(15) NOT NULL DEFAULT 'system',
  `var` varchar(32) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`app`,`var`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_source`;
CREATE TABLE `cmstop_source` (
  `sourceid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `logo` char(100) DEFAULT NULL,
  `url` char(100) NOT NULL,
  `initial` char(10) NOT NULL,
  `count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`sourceid`),
  UNIQUE KEY `name` (`name`),
  KEY `initial` (`initial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_status`;
CREATE TABLE `cmstop_status` (
  `status` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_tag`;
CREATE TABLE `cmstop_tag` (
  `tagid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag` char(16) NOT NULL,
  `initial` char(1) NOT NULL,
  `style` char(7) NOT NULL,
  `usetimes` smallint(5) unsigned NOT NULL DEFAULT '0',
  `pv` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tagid`),
  UNIQUE KEY `tag` (`tag`),
  KEY `initial` (`initial`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_template_clip`;
CREATE TABLE `cmstop_template_clip` (
  `clipid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `code` text NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `createdby` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`clipid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_tweets`;
CREATE TABLE `cmstop_tweets` (
  `tweetid` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(80) NOT NULL default '',
  `driver` enum('qq','renren','kaixin','sina') NOT NULL,
  `username` varchar(80) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `key` varchar(32) default NULL,
  `secret` varchar(32) default NULL,
  `sina_key` char(32) default NULL,
  `sina_secret` char(32) default NULL,
  `status` tinyint(3) NOT NULL default '0',
  `updated` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY  (`tweetid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_workflow`;
CREATE TABLE `cmstop_workflow` (
  `workflowid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `steps` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`workflowid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_workflow_log`;
CREATE TABLE `cmstop_workflow_log` (
  `logid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contentid` mediumint(8) unsigned NOT NULL,
  `before` tinyint(1) unsigned DEFAULT NULL,
  `after` tinyint(1) unsigned DEFAULT NULL,
  `action` enum('pass','reject') NOT NULL,
  `reason` char(255) DEFAULT NULL,
  `created` int(10) unsigned NOT NULL,
  `createdby` mediumint(8) unsigned NOT NULL,
  `ip` char(15) NOT NULL,
  PRIMARY KEY (`logid`),
  KEY `contentid` (`contentid`),
  KEY `created` (`created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cmstop_workflow_step`;
CREATE TABLE `cmstop_workflow_step` (
  `workflowid` tinyint(3) unsigned NOT NULL,
  `step` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `roleid` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`workflowid`,`step`),
  KEY `roleid` (`roleid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `cmstop_aca` (`acaid`, `parentid`, `app`, `controller`, `action`, `name`) VALUES
(1, NULL, 'system', NULL, NULL, '系统'),
(2, 1, 'system', 'setting', NULL, '全局设置'),
(3, 1, 'system', 'administrator', NULL, '管理员'),
(4, 1, 'system', 'role', NULL, '角色'),
(5, 1, 'system', 'aca', NULL, '权限'),
(6, 1, 'system', 'department', NULL, '部门'),
(7, 1, 'system', 'category', NULL, '栏目设置'),
(8, 1, 'system', 'psn', NULL, '发布点设置'),
(9, 1, 'system', 'model', NULL, '内容模型'),
(10, 1, 'system', 'workflow', NULL, '工作流'),
(11, 1, 'system', 'dsn', NULL, '数据源'),
(12, 1, 'system', 'menu', NULL, '菜单'),
(13, 1, 'system', 'filterword', NULL, '词语过滤'),
(14, 1, 'system', 'keylink', NULL, '关键词链接'),
(15, 1, 'system', 'source', NULL, '来源'),
(16, 1, 'system', 'tags', NULL, 'Tags'),
(17, 1, 'system', 'template', NULL, '模板'),
(18, 1, 'system', 'database', NULL, '数据库'),
(19, 1, 'system', 'cron', NULL, '计划任务'),
(20, 1, 'system', 'attachment', NULL, '附件管理'),
(21, 1, 'system', 'import', NULL, '数据导入'),
(22, 1, 'system', 'ipbanned', NULL, 'IP禁止'),
(23, 1, 'system', 'adminlog', NULL, '操作日志'),
(24, 1, 'system', 'file', NULL, '木马扫描'),
(25, 1, 'system', 'html', NULL, '发布网页'),
(26, 1, 'system', 'content_note', NULL, '批注管理'),
(27, 1, 'system', 'content_log', NULL, '内容操作日志'),
(28, 1, 'system', 'rank_pv', NULL, '点击排行'),
(29, 1, 'system', 'rank_comment', NULL, '评论排行'),
(30, 1, 'system', 'sitemaps', NULL, '网站地图'),
(31, 1, 'system', 'baidunews', NULL, '百度新闻源'),
(32, 1, 'system', 'content', NULL, '内容管理'),
(33, NULL, 'member', NULL, NULL, '会员'),
(34, 33, 'member', 'setting', NULL, '设置'),
(35, 33, 'member', 'index', NULL, '会员管理'),
(36, 33, 'member', 'audit', NULL, '会员审核'),
(37, 33, 'member', 'group', NULL, '用户组管理'),
(38, 33, 'member', 'log', NULL, '登录日志'),
(100, NULL, 'article', NULL, NULL, '文章'),
(101, 100, 'article', 'article', NULL, '文章管理'),
(102, 100, 'article', 'html', NULL, '文章生成'),
(103, 100, 'article', 'contribute', NULL, '投稿管理'),
(104, 100, 'article', 'article', 'index', '浏览'),
(105, 100, 'article', 'article', 'add,approve,related', '添加'),
(106, 100, 'article', 'article', 'edit,approve,related', '修改'),
(107, 100, 'article', 'article', 'view', '查看'),
(108, 100, 'article', 'article', 'remove', '删除'),
(109, 100, 'article', 'article', 'publish', '发布'),
(110, 100, 'article', 'article', 'unpublish', '撤稿'),
(111, 100, 'article', 'article', 'copy', '复制'),
(112, 100, 'article', 'article', 'reference', '引用'),
(113, 100, 'article', 'article', 'move', '移动'),
(114, 100, 'article', 'article', 'search', '搜索'),
(115, 100, 'article', 'article', 'pass,reject', '审核'),
(116, 100, 'article', 'article', 'delete,clear,restore,restores', '回收站'),
(150, NULL, 'section', NULL, NULL, '区块'),
(151, 150, 'section', 'section', NULL, '区块管理'),
(152, 150, 'section', 'data', NULL, '内容维护'),
(153, 150, 'section', 'classify', NULL, '分类管理');


INSERT INTO `cmstop_app` (`app`, `name`, `description`, `url`, `version`, `author`, `author_url`, `author_email`, `install_time`, `update_time`, `disabled`) VALUES
('article', '文章', '', '', '', 'CmsTop', 'http://www.cmstop.com/', '', 0, 0, 0),
('editor', '编辑器', '', '', '', 'CmsTop', 'http://www.cmstop.com/', '', 0, 0, 0),
('member', '会员', '', '', '', 'CmsTop', 'http://www.cmstop.com/', '', 0, 0, 0),
('section', '区块', '', '', '', 'CmsTop', 'http://www.cmstop.com/', '', 0, 0, 0),
('system', '系统', '', '', '', 'CmsTop', 'http://www.cmstop.com/', '', 0, 0, 0);

INSERT INTO `cmstop_cache` (`tablename`, `primary`, `allcache`, `allfields`, `rowcache`, `rowfields`) VALUES
('app', 'app', 1, 'app,name', 1, '*'),
('category', 'catid', 1, '*', 1, '*'),
('member_group', 'groupid', 1, '*', 0, '*'),
('status', 'status', 1, 'status,name', 0, '*'),
('role', 'roleid', 1, '*', 0, '*'),
('psn', 'psnid', 1, '*', 0, '*'),
('model', 'modelid', 1, '*', 0, '*'),
('keyword', 'id', 1, '*', 0, '*'),
('workflow', 'workflowid', 1, '*', 0, '*'),
('menu', 'menuid', 1, '*', 0, '*'),
('source', 'sourceid', 1, '*', 0, '*'),
('filterword', 'filterwordid', 1, '*', 0, '*'),
('ipbanned', 'ip', 1, '*', 0, '*'),
('dsn', 'dsnid', 1, '*', 0, '*'),
('department', 'departmentid', 1, '*', 0, '*'),
('admin', 'userid', 1, '*', 0, '*'),
('cron', 'cronid', 1, '*', 0, '*');


INSERT INTO `cmstop_category` (`catid`, `parentid`, `name`, `alias`, `parentids`, `childids`, `workflowid`, `model`, `template_index`, `template_list`, `template_date`, `path`, `url`, `iscreateindex`, `urlrule_index`, `urlrule_list`, `urlrule_show`, `enablecontribute`, `keywords`, `description`, `posts`, `comments`, `pv`, `sort`, `disabled`, `htmlcreated`) VALUES
(1, NULL, '新闻', 'news', NULL, '4,5,6', 0, 'a:5:{i:1;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"article/show.html";}i:2;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"picture/show.html";}i:4;a:2:{s:4:"show";s:1:"1";s:8:"template";s:15:"video/show.html";}i:7;a:2:{s:4:"show";s:1:"1";s:8:"template";s:18:"activity/show.html";}i:8;a:2:{s:4:"show";s:1:"1";s:8:"template";s:14:"vote/show.html";}}', 'system/category.html', 'system/list.html', 'system/date.html', '{PSN:1}', '{WWW_URL}news/index.shtml', 1, '{$parentdir}/{$alias}/index.shtml', '{$parentdir}/{$alias}/{$model}{$page}.shtml', '{$year}/{$month}{$day}/{$contentid}{$page}.shtml', 1, '', '', 0, 0, 0, 0, 0, 0),
(2, NULL, '娱乐', 'ent', NULL, '7,8,9,10', 0, 'a:5:{i:1;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"article/show.html";}i:2;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"picture/show.html";}i:4;a:2:{s:4:"show";s:1:"1";s:8:"template";s:15:"video/show.html";}i:7;a:2:{s:4:"show";s:1:"1";s:8:"template";s:18:"activity/show.html";}i:8;a:2:{s:4:"show";s:1:"1";s:8:"template";s:14:"vote/show.html";}}', 'system/category.html', 'system/list.html', 'system/date.html', '{PSN:1}', '{WWW_URL}ent/index.shtml', 1, '{$parentdir}/{$alias}/index.shtml', '{$parentdir}/{$alias}/{$model}{$page}.shtml', '{$year}/{$month}{$day}/{$contentid}{$page}.shtml', 1, '', '', 0, 0, 0, 0, 0, 0),
(3, NULL, '科技', 'tech', NULL, '11,12,13', 0, 'a:5:{i:1;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"article/show.html";}i:2;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"picture/show.html";}i:4;a:2:{s:4:"show";s:1:"1";s:8:"template";s:15:"video/show.html";}i:7;a:2:{s:4:"show";s:1:"1";s:8:"template";s:18:"activity/show.html";}i:8;a:2:{s:4:"show";s:1:"1";s:8:"template";s:14:"vote/show.html";}}', 'system/category.html', 'system/list.html', 'system/date.html', '{PSN:1}', '{WWW_URL}tech/index.shtml', 1, '{$parentdir}/{$alias}/index.shtml', '{$parentdir}/{$alias}/{$model}{$page}.shtml', '{$year}/{$month}{$day}/{$contentid}{$page}.shtml', 1, '', '', 0, 0, 0, 0, 0, 0),
(4, 1, '国内', 'guonei', '1', NULL, 0, 'a:5:{i:1;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"article/show.html";}i:2;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"picture/show.html";}i:4;a:2:{s:4:"show";s:1:"1";s:8:"template";s:15:"video/show.html";}i:7;a:2:{s:4:"show";s:1:"1";s:8:"template";s:18:"activity/show.html";}i:8;a:2:{s:4:"show";s:1:"1";s:8:"template";s:14:"vote/show.html";}}', 'system/category.html', 'system/list.html', 'system/date.html', '{PSN:1}', '{WWW_URL}news/guonei/index.shtml', 1, '{$parentdir}/{$alias}/index.shtml', '{$parentdir}/{$alias}/{$model}{$page}.shtml', '{$year}/{$month}{$day}/{$contentid}{$page}.shtml', 1, '', '', 0, 0, 0, 0, 0, 0),
(5, 1, '国际', 'guoji', '1', NULL, 0, 'a:5:{i:1;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"article/show.html";}i:2;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"picture/show.html";}i:4;a:2:{s:4:"show";s:1:"1";s:8:"template";s:15:"video/show.html";}i:7;a:2:{s:4:"show";s:1:"1";s:8:"template";s:18:"activity/show.html";}i:8;a:2:{s:4:"show";s:1:"1";s:8:"template";s:14:"vote/show.html";}}', 'system/category.html', 'system/list.html', 'system/date.html', '{PSN:1}', '{WWW_URL}news/guoji/index.shtml', 1, '{$parentdir}/{$alias}/index.shtml', '{$parentdir}/{$alias}/{$model}{$page}.shtml', '{$year}/{$month}{$day}/{$contentid}{$page}.shtml', 1, '', '', 0, 0, 0, 0, 0, 0),
(6, 1, '社会', 'shehui', '1', NULL, 0, 'a:5:{i:1;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"article/show.html";}i:2;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"picture/show.html";}i:4;a:2:{s:4:"show";s:1:"1";s:8:"template";s:15:"video/show.html";}i:7;a:2:{s:4:"show";s:1:"1";s:8:"template";s:18:"activity/show.html";}i:8;a:2:{s:4:"show";s:1:"1";s:8:"template";s:14:"vote/show.html";}}', 'system/category.html', 'system/list.html', 'system/date.html', '{PSN:1}', '{WWW_URL}news/shehui/index.shtml', 1, '{$parentdir}/{$alias}/index.shtml', '{$parentdir}/{$alias}/{$model}{$page}.shtml', '{$year}/{$month}{$day}/{$contentid}{$page}.shtml', 1, '', '', 0, 0, 0, 0, 0, 0),
(7, 2, '明星', 'star', '2', NULL, 0, 'a:5:{i:1;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"article/show.html";}i:2;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"picture/show.html";}i:4;a:2:{s:4:"show";s:1:"1";s:8:"template";s:15:"video/show.html";}i:7;a:2:{s:4:"show";s:1:"1";s:8:"template";s:18:"activity/show.html";}i:8;a:2:{s:4:"show";s:1:"1";s:8:"template";s:14:"vote/show.html";}}', 'system/category.html', 'system/list.html', 'system/date.html', '{PSN:1}', '{WWW_URL}star/index.shtml', 1, '{$parentdir}/{$alias}/index.shtml', '{$parentdir}/{$alias}/{$model}{$page}.shtml', '{$year}/{$month}{$day}/{$contentid}{$page}.shtml', 1, '', '', 0, 0, 0, 0, 0, 0),
(8, 2, '电影', 'movie', '2', NULL, 0, 'a:5:{i:1;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"article/show.html";}i:2;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"picture/show.html";}i:4;a:2:{s:4:"show";s:1:"1";s:8:"template";s:15:"video/show.html";}i:7;a:2:{s:4:"show";s:1:"1";s:8:"template";s:18:"activity/show.html";}i:8;a:2:{s:4:"show";s:1:"1";s:8:"template";s:14:"vote/show.html";}}', 'system/category.html', 'system/list.html', 'system/date.html', '{PSN:1}', '{WWW_URL}movie/index.shtml', 1, '{$parentdir}/{$alias}/index.shtml', '{$parentdir}/{$alias}/{$model}{$page}.shtml', '{$year}/{$month}{$day}/{$contentid}{$page}.shtml', 1, '', '', 0, 0, 0, 0, 0, 0),
(9, 2, '电视', 'tv', '2', NULL, 0, 'a:5:{i:1;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"article/show.html";}i:2;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"picture/show.html";}i:4;a:2:{s:4:"show";s:1:"1";s:8:"template";s:15:"video/show.html";}i:7;a:2:{s:4:"show";s:1:"1";s:8:"template";s:18:"activity/show.html";}i:8;a:2:{s:4:"show";s:1:"1";s:8:"template";s:14:"vote/show.html";}}', 'system/category.html', 'system/list.html', 'system/date.html', '{PSN:1}', '{WWW_URL}tv/index.shtml', 1, '{$parentdir}/{$alias}/index.shtml', '{$parentdir}/{$alias}/{$model}{$page}.shtml', '{$year}/{$month}{$day}/{$contentid}{$page}.shtml', 1, '', '', 0, 0, 0, 0, 0, 0),
(10, 2, '音乐', 'music', '2', NULL, 0, 'a:5:{i:1;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"article/show.html";}i:2;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"picture/show.html";}i:4;a:2:{s:4:"show";s:1:"1";s:8:"template";s:15:"video/show.html";}i:7;a:2:{s:4:"show";s:1:"1";s:8:"template";s:18:"activity/show.html";}i:8;a:2:{s:4:"show";s:1:"1";s:8:"template";s:14:"vote/show.html";}}', 'system/category.html', 'system/list.html', 'system/date.html', '{PSN:1}', '{WWW_URL}music/index.shtml', 1, '{$parentdir}/{$alias}/index.shtml', '{$parentdir}/{$alias}/{$model}{$page}.shtml', '{$year}/{$month}{$day}/{$contentid}{$page}.shtml', 1, '', '', 0, 0, 0, 0, 0, 0),
(11, 3, '互联网', 'internet', '3', NULL, 0, 'a:5:{i:1;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"article/show.html";}i:2;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"picture/show.html";}i:4;a:2:{s:4:"show";s:1:"1";s:8:"template";s:15:"video/show.html";}i:7;a:2:{s:4:"show";s:1:"1";s:8:"template";s:18:"activity/show.html";}i:8;a:2:{s:4:"show";s:1:"1";s:8:"template";s:14:"vote/show.html";}}', 'system/category.html', 'system/list.html', 'system/date.html', '{PSN:1}', '{WWW_URL}internet/index.shtml', 1, '{$parentdir}/{$alias}/index.shtml', '{$parentdir}/{$alias}/{$model}{$page}.shtml', '{$year}/{$month}{$day}/{$contentid}{$page}.shtml', 1, '', '', 0, 0, 0, 0, 0, 0),
(12, 3, '通信', 'telecom', '3', NULL, 0, 'a:5:{i:1;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"article/show.html";}i:2;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"picture/show.html";}i:4;a:2:{s:4:"show";s:1:"1";s:8:"template";s:15:"video/show.html";}i:7;a:2:{s:4:"show";s:1:"1";s:8:"template";s:18:"activity/show.html";}i:8;a:2:{s:4:"show";s:1:"1";s:8:"template";s:14:"vote/show.html";}}', 'system/category.html', 'system/list.html', 'system/date.html', '{PSN:1}', '{WWW_URL}telecom/index.shtml', 1, '{$parentdir}/{$alias}/index.shtml', '{$parentdir}/{$alias}/{$model}{$page}.shtml', '{$year}/{$month}{$day}/{$contentid}{$page}.shtml', 1, '', '', 0, 0, 0, 0, 0, 0),
(13, 3, '业界', 'it', '3', NULL, 0, 'a:5:{i:1;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"article/show.html";}i:2;a:2:{s:4:"show";s:1:"1";s:8:"template";s:17:"picture/show.html";}i:4;a:2:{s:4:"show";s:1:"1";s:8:"template";s:15:"video/show.html";}i:7;a:2:{s:4:"show";s:1:"1";s:8:"template";s:18:"activity/show.html";}i:8;a:2:{s:4:"show";s:1:"1";s:8:"template";s:14:"vote/show.html";}}', 'system/category.html', 'system/list.html', 'system/date.html', '{PSN:1}', '{WWW_URL}it/index.shtml', 1, '{$parentdir}/{$alias}/index.shtml', '{$parentdir}/{$alias}/{$model}{$page}.shtml', '{$year}/{$month}{$day}/{$contentid}{$page}.shtml', 1, '', '', 0, 0, 0, 0, 0, 0);

INSERT INTO `cmstop_department` (`departmentid`, `parentid`, `parentids`, `childids`, `name`, `sort`, `leaderid`, `posts`, `comments`, `pv`) VALUES
(1, NULL, NULL, NULL, '技术部', 0, 1, 0, 0, 0),
(2, NULL, NULL, NULL, '编辑部', 0, 2, 0, 0, 0);

INSERT INTO `cmstop_department_role` (`departmentid`, `roleid`) VALUES
(1, 1),
(2, 2);

INSERT INTO `cmstop_filterword` (`filterwordid`, `pattern`, `replacement`) VALUES
(1, '法轮功', ''),
(2, '六合彩', '');


INSERT INTO `cmstop_menu` (`menuid`, `parentid`, `parentids`, `childids`, `name`, `url`, `target`, `sort`) VALUES
(1, NULL, NULL, '9,10,11,12,13,14,15', '我的', '?app=system&controller=index&action=right', NULL, 1),
(2, NULL, NULL, NULL, '内容', '?app=system&controller=content&action=index', NULL, 2),
(3, NULL, NULL, NULL, '区块', '?app=section&controller=section&action=index', NULL, 3),
(4, NULL, NULL, '16,17,18,19,20', '会员', '?app=member&controller=index&action=index', NULL, 4),
(5, NULL, NULL, '60', '扩展', '?app=system&controller=app&action=index', NULL, 5),
(6, NULL, NULL, '21,22,23,24,25,26,27,28,29,30,47,48,49', '工具', '', NULL, 6),
(7, NULL, NULL, '31,32,73', '模板', '?app=system&controller=template', NULL, 7),
(8, NULL, NULL, '33,34,35,36,37,38,39,40,41,42,43,44,45,46,50,51,52,53,54,55,56,57,58,59,61', '设置', '', NULL, 8),
(9, 1, '1', NULL, '我的便笺', '?app=system&controller=my&action=note', NULL, 1),
(10, 1, '1', NULL, '我的内容', '?app=system&controller=my&action=content', NULL, 2),
(11, 1, '1', NULL, '我的部门', '?app=system&controller=my&action=department', NULL, 3),
(12, 1, '1', NULL, '我的权限', '?app=system&controller=my&action=priv', NULL, 4),
(13, 1, '1', NULL, '常用操作', '?app=system&controller=my&action=menu', NULL, 5),
(14, 1, '1', NULL, '个人资料', '?app=system&controller=my&action=profile', NULL, 6),
(15, 1, '1', NULL, '修改密码', '?app=system&controller=my&action=password', NULL, 7),
(16, 4, '4', NULL, '管理用户', '?app=member&controller=index&action=index', NULL, 1),
(17, 4, '4', NULL, '审核用户', '?app=member&controller=audit&action=index', NULL, 2),
(18, 4, '4', NULL, '用户组设置', '?app=member&controller=group&action=index', NULL, 3),
(19, 4, '4', NULL, '登录日志', '?app=member&controller=log&action=index', NULL, 4),
(20, 4, '4', NULL, '相关设置', '?app=member&controller=setting&action=index', NULL, 5),
(21, 6, '6', '47,48,49', '数据库', '?app=system&controller=database&action=backup', NULL, 1),
(22, 6, '6', NULL, '计划任务', '?app=system&controller=cron&action=index', NULL, 2),
(23, 6, '6', NULL, '附件管理', '?app=system&controller=attachment&action=index', NULL, 3),
(24, 6, '6', NULL, '数据导入', '?app=system&controller=import&action=index', NULL, 4),
(25, 6, '6', NULL, '更新缓存', '?app=system&controller=cache&action=update', NULL, 5),
(26, 6, '6', NULL, 'IP 禁止', '?app=system&controller=ipbanned&action=index', NULL, 6),
(27, 6, '6', NULL, '操作日志', '?app=system&controller=adminlog&action=index', NULL, 7),
(28, 6, '6', NULL, '木马扫描', '?app=system&controller=file&action=index', NULL, 8),
(29, 6, '6', NULL, '文件校验', '?app=system&controller=file&action=filecheck', NULL, 9),
(30, 6, '6', NULL, '文件权限', '?app=system&controller=file&action=permission', NULL, 10),
(31, 7, '7', NULL, '新建模板', '?app=system&controller=template&action=add&path=root', NULL, 1),
(32, 7, '7', NULL, '管理模板', '?app=system&controller=template', NULL, 2),
(33, 8, '8', '50,51,52,53,54,55', '全局配置', '?app=system&controller=setting&action=basic', NULL, 1),
(34, 8, '8', '56,57,58,59', '权限设置', '?app=system&controller=administrator&action=index', NULL, 2),
(35, 8, '8', NULL, '栏目设置', '?app=system&controller=category&action=index', NULL, 3),
(36, 8, '8', NULL, '发布点设置', '?app=system&controller=psn&action=index', NULL, 4),
(37, 8, '8', NULL, '内容模型', '?app=system&controller=model&action=index', NULL, 5),
(38, 8, '8', NULL, '工作流', '?app=system&controller=workflow&action=index', NULL, 6),
(39, 8, '8', NULL, '数据源管理', '?app=system&controller=dsn&action=index', NULL, 7),
(40, 8, '8', NULL, '菜单管理', '?app=system&controller=menu&action=index', NULL, 8),
(41, 8, '8', NULL, '词语过滤', '?app=system&controller=filterword&action=index', NULL, 9),
(42, 8, '8', NULL, '关键词链接', '?app=system&controller=keylink&action=index', NULL, 10),
(43, 8, '8', NULL, '来源管理', '?app=system&controller=source&action=index', NULL, 11),
(44, 8, '8', NULL, 'Tags管理', '?app=system&controller=tag&action=index', NULL, 12),
(45, 8, '8', NULL, '网站地图', '?app=system&controller=sitemaps', NULL, 13),
(46, 8, '8', NULL, '百度新闻源', '?app=system&controller=baidunews', NULL, 14),
(47, 21, '6,21', NULL, '数据修复优化', '?app=system&controller=database&action=repair', NULL, 1),
(48, 21, '6,21', NULL, '数据备份', '?app=system&controller=database&action=backup', NULL, 2),
(49, 21, '6,21', NULL, '数据恢复', '?app=system&controller=database&action=restore', NULL, 3),
(50, 33, '8,33', NULL, '站点信息', '?app=system&controller=setting&action=basic', NULL, 1),
(51, 33, '8,33', NULL, '安全设置', '?app=system&controller=setting&action=safe', NULL, 2),
(52, 33, '8,33', NULL, '性能优化', '?app=system&controller=setting&action=optimize', NULL, 3),
(53, 33, '8,33', NULL, '附件设置', '?app=system&controller=setting&action=attachment', NULL, 4),
(54, 33, '8,33', NULL, '邮件设置', '?app=system&controller=setting&action=mail', NULL, 5),
(55, 33, '8,33', NULL, 'SEO设置', '?app=system&controller=setting&action=seo', NULL, 6),
(56, 34, '8,34', NULL, '管理员', '?app=system&controller=administrator&action=index', NULL, 1),
(57, 34, '8,34', NULL, '角色', '?app=system&controller=role&action=index', NULL, 2),
(58, 34, '8,34', NULL, '部门', '?app=system&controller=department&action=index', NULL, 3),
(59, 34, '8,34', NULL, '权限', '?app=system&controller=aca&action=index', NULL, 4),
(60, 5, '5', NULL, '编辑器', '?app=editor&controller=setting&action=index', NULL, 11),
(61, 8, '8', NULL, '转发设置', '?app=system&controller=tweets&action=index', NULL, 15),
(73, 7, '7', NULL, '更换模板', '?app=system&controller=template&action=showTpl', NULL, 3);


INSERT INTO `cmstop_model` (`modelid`, `name`, `alias`, `description`, `template_list`, `template_show`, `posts`, `comments`, `pv`, `sort`, `disabled`) VALUES
(1, '文章', 'article', '', 'article/list.html', 'article/show.html', 0, 0, 0, 0, 0);

INSERT INTO `cmstop_cron` (`cronid`, `type`, `name`, `app`, `param`, `controller`, `action`, `lastrun`, `nextrun`, `mode`, `time`, `starttime`, `interval`, `times`, `already`, `endtime`, `day`, `weekday`, `hour`, `minute`, `disabled`, `hidden`) VALUES
(1, 'system', '生成自动区块', 'section', '', 'section', 'cron', 1284122525, 1284122640, 2, 0, 0, 5, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0),
(2, 'system', '生成首页', 'system', '', 'html', 'index_cron', 1284122525, 1284122640, 2, 0, 0, 3, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0),
(3, 'system', '生成栏目页', 'system', '', 'html', 'category_cron', 1284122525, 1284122640, 2, 0, 0, 10, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0);

INSERT INTO `cmstop_member_group` (`groupid`, `name`, `status`, `allowlogin`, `column`, `allowcontribute`, `allowcomment`, `issystem`, `sort`, `tabview`, `remarks`) VALUES
(1, '管理员', 1, 1, 1, 1, 1, 1, 0, 1, ''),
(2, '游客', 1, 1, 0, 0, 0, 1, 0, 1, ''),
(3, '待验证', 1, 1, 0, 0, 0, 1, 0, 1, ''),
(4, '待审核', 1, 1, 0, 0, 0, 1, 0, 1, ''),
(5, '禁用', 1, 0, 0, 0, 0, 1, 0, 1, ''),
(6, '注册用户', 1, 1, 0, 1, 1, 1, 0, 1, '');


INSERT INTO `cmstop_psn` (`psnid`, `name`, `path`, `url`, `sort`) VALUES
(1, '网站首页', '', '{WWW_URL}', 0);

INSERT INTO `cmstop_role` (`roleid`, `name`) VALUES
(1, '超级管理员'),
(2, '总编辑');

INSERT INTO `cmstop_status` (`status`, `name`, `description`) VALUES
(0, '回收站', '回收站'),
(1, '草稿', '草稿'),
(2, '退稿', '已退稿'),
(3, '待审', '待审核'),
(6, '已发', '已发布');

INSERT INTO `cmstop_workflow` (`workflowid`, `name`, `description`, `steps`) VALUES
(1, '一级审核', '', 1),
(2, '二级审核', '', 2);

INSERT INTO `cmstop_workflow_step` (`workflowid`, `step`, `roleid`) VALUES
(1, 1, 2),
(2, 2, 1),
(2, 1, 2);


INSERT INTO `cmstop_setting` (`app`, `var`, `value`) VALUES
('article', 'payment_price', '0.20'),
('article', 'source', ''),
('article', 'thumb_height', '0'),
('article', 'thumb_width', '600'),
('article', 'watermark', '1'),
('article', 'tag', '0'),
('article', 'weight', '60'),
('editor', 'thumb_height', '0'),
('editor', 'thumb_width', '600'),
('editor', 'watermark', '1'),
('member', 'agreement', '请在这里输入注册协议内容'),
('member', 'allowreg', '1'),
('member', 'ban_name', '管理员\r\nadmin'),
('member', 'closereason', '注册已关闭'),
('member', 'default_group', '6'),
('member', 'groupid', '6'),
('member', 'lock_minute', '60'),
('member', 'log_max', '5'),
('member', 'pw_api', ''),
('member', 'pw_appid', ''),
('member', 'pw_charset', 'utf8'),
('member', 'pw_connect', 'mysql'),
('member', 'pw_dbcharset', 'utf8'),
('member', 'pw_dbconnect', '0'),
('member', 'pw_dbhost', 'localhost'),
('member', 'pw_dbname', ''),
('member', 'pw_dbpw', ''),
('member', 'pw_dbtablepre', 'pw_'),
('member', 'pw_dbuser', ''),
('member', 'pw_ip', ''),
('member', 'pw_key', ''),
('member', 'uc', '0'),
('member', 'uc_api', ''),
('member', 'uc_appid', ''),
('member', 'uc_charset', 'utf8'),
('member', 'uc_connect', 'mysql'),
('member', 'uc_dbcharset', 'utf8'),
('member', 'uc_dbconnect', '0'),
('member', 'uc_dbhost', 'localhost'),
('member', 'uc_dbname', ''),
('member', 'uc_dbpw', ''),
('member', 'uc_dbtablepre', 'uc_'),
('member', 'uc_dbuser', 'root'),
('member', 'uc_ip', ''),
('member', 'uc_key', ''),
('system', 'attachexts', 'gif|jpg|jpeg|bmp|png|txt|zip|rar|doc|docx|xls|ppt|pdf|swf|flv'),
('system', 'baidunews', 'array (''open'' => ''1'',''url'' => ''{PSN:1}baidunews.xml'',''category'' => \n  array (0 => ''1'',1 => ''4'',2 => ''5'',3 => ''6'',4 => ''2'',5 => ''7'',6 => ''8'',7 => ''9'',8 => ''10'',9 => ''3'',10 => ''11'',11 => ''12'',12 => ''13'',\n  ),\n  ''article'' => ''1'',\n  ''picture'' => ''1'',\n  ''number'' => ''10000'',\n  ''frequency'' => ''10'',\n  ''webname'' => ''{WWW_URL}'',\n  ''adminemail'' => ''admin@cmstop.com'',\n  ''updatetime'' => ''10'',\n)'),
('system', 'closed', '0'),
('system', 'closedreason', '网站维护，请稍后访问。'),
('system', 'enableadminlog', '0'),
('system', 'gzip', '1'),
('system', 'ipaccess', ''),
('system', 'ipbanned', ''),
('system', 'listpages', '10'),
('system', 'lockedhours', '1'),
('system', 'pv_interval', '60'),
('system', 'pv_total', '1000'),
('system', 'pv_cachetime', '3600'),
('system', 'mail', 'array (''mailer'' => ''2'',''smtp_host'' => ''smtp.163.com'',''smtp_port'' => ''25'',''smtp_auth'' => ''1'',''smtp_username'' => ''cmstop@163.com'', ''smtp_password'' => '''', ''from'' => ''cmstop@163.com'', ''delimiter'' => ''2'', ''sign'' => ''邮件签名'',)'),
('system', 'maxloginfailedtimes', '5'),
('system', 'minrefreshsecond', '0'),
('system', 'onlinehold', '30'),
('system', 'pagecached', '0'),
('system', 'pagecachettl', '3600'),
('system', 'pagesize', '50'),
('system', 'rolldays', '7'),
('system', 'seodescription', 'CmsTop 是一款基于PHP+MYSQL架构的内容管理系统，专注于资讯领域，主要给网络媒体、传统媒体（电视台、广播电台、报社、杂志社）、政府门户和大中型企业提供Web技术解决方案。'),
('system', 'seokeywords', 'php,cms,内容管理系统,cmstop,思拓合众,新闻发布系统,网站管理系统,在线访谈,电子报纸,电子杂志,问卷调查'),
('system', 'seotitle', 'CmsTop内容管理系统'),
('system', 'sitemaps', 'array (''open'' => ''1'',''url'' => ''{PSN:1}sitemap.xml'',''category'' =>array (0 => ''1'',1 => ''4'',2 => ''5'',3 => ''6'',4 => ''2'',5 => ''7'',6 => ''8'',7 => ''9'',8 => ''10'',9 => ''3'',10 => ''11'',11 => ''12'',12 =>''13'',),''modelid'' =>array (0 => ''1'',1 => ''2'',2 => ''3'',3 => ''4'',4 => ''5'',5 => ''7'',6 => ''8'',7 => ''9'',8 => ''10''),''number'' => ''10000'',''frequency'' => ''10'')'),
('system', 'sitename', 'CmsTop'),
('system', 'siteurl', '{WWW_URL}'),
('system', 'statcode', ''),
('system', 'thumb_enabled', '1'),
('system', 'thumb_height', '600'),
('system', 'thumb_quality', '100'),
('system', 'thumb_width', '800'),
('system', 'watermark_enabled', '1'),
('system', 'watermark_ext', 'png'),
('system', 'watermark_minheight', '150'),
('system', 'watermark_minwidth', '300'),
('system', 'watermark_position', '9'),
('system', 'watermark_quality', '100'),
('system', 'watermark_trans', '65'),
('system', 'weight', '80|上首页频道滚动列表、专栏首页推荐文章\r\n85|上首页图片速读、视频新闻、活动\r\n90|上首页频道头条推荐');

INSERT INTO `cmstop_role_aca` (`roleid`, `acaid`) VALUES
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 10),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 20),
(2, 22),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 31),
(2, 32),
(2, 33),
(2, 100);


INSERT INTO `cmstop_section` (`sectionid`, `name`, `type`, `data`, `frequency`, `updated`, `sort`, `created`, `createdby`, `modified`, `modifiedby`, `published`, `publishedby`, `memo`, `num`, `classid`) VALUES
(1, '今日头条', 'commend', '{loop $data $i $r}\r\n<h2><a href="{$r[url]}" target="_blank" class="cor-c00 bold">{$r[title]}</a></h2>\r\n{/loop}', 3600, NULL, 35, 1282865316, 1, 1283826527, 1, 1283834406, 1, '标题最多18个汉字', 1, 2),
(2, '今日头条-相关2', 'commend', '<ul class="mode-txtlink line-h20">\r\n{loop $data $i $r}\r\n<li><a href="{$r[url]}">{$r[title]}</a></li>\r\n{/loop}\r\n</ul>', 3600, NULL, 34, 1282865454, 1, 1283761612, 1, 1283830476, 1, '标题最多32个汉字', 2, 2),
(3, '幻灯片', 'commend', '<style type="text/css">\r\n<!--\r\n	#container {position:relative;width:320px;background:#EBEBEB;}\r\n	#container .image {clear:both;height:240px;overflow:hidden;}\r\n	#container .number {bottom:30px;height:20px;overflow:hidden;position:absolute;right:5px;text-align:center;}\r\n	#container .number span{margin:0 1px;color:#fff;cursor:pointer;display:block;float:left;height:20px;line-height:20px;background:#000;opacity:0.5;filter:Alpha(Opacity="50");text-decoration:none;width:20px;}\r\n	#container .number span:hover{background:#ff0;color:#000;}\r\n	#container .number span.this{background:#EBEBEB;color:#000;font-weight:bold;}\r\n	#container .title {padding-left: 6px; line-height: 28px; background-color: #000; }\r\n	#container .title a {height:24px;line-height:24px;font-size:14px; font-weight:bold; text-decoration:none;color:#fff}\r\n	#container .title a:hover {color:#ff0;}\r\n-->\r\n</style>\r\n<div id="container">\r\n	<div class="image"></div>\r\n	<div class="number"></div>\r\n	<div class="title"></div>\r\n</div>\r\n<ul id="slide" style="display:none">\r\n<!--{loop $data $k $r}-->\r\n	<li><a href="{$r[url]}"><img src="{thumb($r[thumb], 320, 240)}" width="320" height="240"/></a><a href="{$r[url]}">{$r[title]}</a></li>\r\n<!--{/loop}-->\r\n</ul>\r\n<script type="text/javascript" src="{IMG_URL}js/lib/cmstop.slider.js"></script>\r\n<script type="text/javascript">\r\n$(''#container'').imgSlide({\r\n	data: ''slide'',\r\n	auto: true,\r\n	type: ''mouseover'',\r\n	speed: 3000\r\n});\r\n</script>', 3600, NULL, 32, 1282866017, 1, 1283861497, 1, 1283861497, 1, '图片规格 320*240， 标题最多20个汉字', 5, 2),
(4, '推荐', 'commend', '<ul class="mode-txtlink fs-14 cor-06c">\r\n{loop $data $i $r}\r\n{if $i%5==0 && $i}<li class="hr-h10"></li>{/if}\r\n<li>{if $r[color]}<a href="{$r[url]}" style="color:{$r[color]}">{$r[title]}</a>{else}<a href="{$r[url]}">{$r[title]}</a>{/if}</li>\r\n{/loop}\r\n</ul>', 3600, NULL, 31, 1282867281, 1, 1283827723, 1, NULL, NULL, '标题最多27个汉字', 15, 2),
(5, '专栏-头条', 'commend', '		<ul>\n{loop $data $i $r}\n<li>\n<div class="imgtxt" style="margin-bottom:10px;"><a href="{$r[url]}"><img src="{thumb($r[thumb], 64, 64)}" width="64" height="64" alt="{$r[title]}" /></a></div>\n<h3 class="summary-h3 spe-h3" style="height: auto;"><a href="{$r[url]}" target="_blank" class="cor-06c bold">{$r[title]}</a></h3>\n<p class="summary-no2em" style="height:auto;">{$r[description]}</p>\n</li>\n{/loop}\n</ul>', 3600, NULL, 30, 1282868503, 1, 1283832558, 1, 1283832561, 1, '图片规格 64*64，标题最多18个汉字，摘要最多50个汉字', 1, 2),
(6, '专栏-推荐', 'commend', '<ul class="mode-txtlink cor-06c">\r\n{loop $data $i $r}\r\n<li><a href="{$r[url]}" target="_blank">{$r[title]}</a></li>\r\n{/loop}\r\n</ul>', 3600, NULL, 29, 1282869026, 1, 1283821491, 1, 1283841033, 1, '标题最多23个汉字', 5, 2),
(7, '热点专题', 'commend', '{loop $data $i $r}\r\n<a href="{$r[url]}"><img src="{thumb($r[thumb], 210, 120)}" width="210" height="120" alt="{$r[title]}" /></a>\r\n<p class="ad-summary bold"><a href="{$r[url]}">{str_cut($r[title], 28)}</a></p>\r\n{/loop}', 3600, NULL, 8, 1282870520, 1, 1283483437, 1, NULL, NULL, '图片规格 210*120，标题最多14个汉字', 1, 2),
(8, '投票', 'html', '<form id="vote_1" action="app/?app=vote&amp;controller=vote&amp;action=vote" enctype="application/x-www-form-urlencoded" method="post"><input name="contentid" type="hidden" value="1" /> <dl><dt>你认为网站改版怎么样？</dt><dd><label><input name="optionid" type="radio" value="1" />很好</label></dd><dd><label><input name="optionid" type="radio" value="2" />还不错</label></dd><dd><label><input name="optionid" type="radio" value="3" />一般</label></dd><dd><label><input name="optionid" type="radio" value="4" />很差</label></dd><dd><input class="submit" name="submit" type="submit" value="投票" />　<a href="app/?app=vote&amp;controller=vote&amp;action=result&amp;contentid=1">查看结果</a></dd></dl></form>\n<script type="text/javascript">// <![CDATA[\r\n//验证投票选项\r\n$(''#vote_1'').submit(function(){\r\nvar checkeds = $(''#vote_1 input:checked'').length;\r\nif(checkeds == 0){\r\nalert(''请选择投票选项'');\r\nreturn false;\r\n}\r\n});\r\n// ]]></script>', 3600, NULL, 7, 1282871159, 1, 1283925516, 1, 1283925516, 1, '', 10, 2),
(9, '幻灯片', 'commend', '<!-- 幻灯片数据 -->\r\n<div id="slide-box" class="col-l-main w-600 slide-imgs bor-ccc">\r\n				<!-- 幻灯片数据 -->\r\n				<ul rel="slide-data" style="display: none;">\r\n                {loop $data $i $r}\r\n				<li>\r\n					<p class=''data-title''>{$r[title]}</p>\r\n					<p class=''data-url''>{$r[url]}</p>\r\n					<p class=''data-description''>{$r[description]}</p>\r\n					<p class=''data-thumb''>{thumb($r[thumb],600,385)}</p>\r\n				</li>\r\n				\r\n               {/loop}\r\n			</ul>\r\n				<div class="thumb-wrap">\r\n					<div><a href=""><img rel="thumb" src="" width="600" height="365" alt="" /></a></div>\r\n					<div class="shadow" rel="shadow"></div>\r\n					<p class="description" rel="description"></p>\r\n				</div>\r\n			<div class="tit-ctrl">\r\n				<p class="title"><a href="" rel="title"></a></p>\r\n				<div class="ctrl" rel="ctrl">\r\n					<img class="tl" rel="tl" alt="" src="{IMG_URL}templates/default/images/turn-l.gif" title="点击切换到上一张" /> \r\n					<img class="tr" rel="tr"  alt="" src="{IMG_URL}templates/default/images/turn-r.gif" title="点击切换到下一张" />\r\n					<span class="num" rel="num"><strong>0</strong>/<em>4</em></span>\r\n				</div>\r\n			</div>\r\n			</div>\r\n<script type="text/javascript" src="{IMG_URL}templates/default/js/slideObject.js"></script>', 3600, NULL, 19, 1282877036, 1, 1283864681, 1, 1283867137, 1, '图片规格 600*365，标题最多30个汉字，摘要最多96个汉字', 10, 3),
(10, '头图', 'commend', '<ul>\r\n{loop $data $i $r}\r\n<li>\r\n<div class="imgtxt">\r\n<a href="{$r[url]}"><img src="{thumb($r[thumb], 120, 90)}" width="120" height="90" alt="" /></a>\r\n</div>\r\n<h3 class="summary-h3 title-h32"><a href="{$r[url]}" class="fs-14 bold">{$r[title]}</a></h3>\r\n<p class="summary" style="text-indent:0;">{$r[description]}</p>\r\n</li>\r\n{/loop}\r\n</ul>', 3600, NULL, 13, 1282889787, 1, 1283234355, 1, NULL, NULL, '图片规格 120*90，标题最多24个汉字，摘要最多45个汉字', 1, 3),
(11, '推荐标题', 'commend', '<ul class="mode-txtlink cor-06c mar-l-10 ">\r\n{loop $data $i $r}\r\n	<li><a href="{$r[url]}" target="_blank">{$r[title]}</a></li>\r\n{/loop}\r\n</ul>', 3600, NULL, 12, 1282889912, 1, 1283234355, 1, NULL, NULL, '标题最多25个汉字', 5, 3),
(12, '推荐图片', 'commend', '<ul class="per-33">\r\n{loop $data $i $r}\r\n	<li><a href="{$r[url]}"><img src="{thumb($r[thumb], 100, 75)}" width="100" height="75" alt="{$r[title]}"/></a><p><a href="{$r[url]}">{$r[title]}</a></p></li>\r\n{/loop}\r\n</ul>', 3600, NULL, 11, 1282890086, 1, 1283234355, 1, NULL, NULL, '图片规格 100*75，标题最多16个汉字', 3, 3),
(13, '图片速读', 'commend', '<ul class="per-25">\r\n{loop $data $i $r}\r\n<li>\r\n	<a href="{$r[url]}" target="_blank"><img src="{thumb($r[title], 160, 120)}" width="160" height="120" alt="{$r[title]}" /></a>\r\n	<p class="fix-h36"><a href="{$r[url]}" target="_blank">{$r[title]}</a></p>\r\n</li>\r\n{/loop}\r\n</ul>', 3600, NULL, 10, 1282890546, 1, 1283337449, 1, NULL, NULL, '图片规格 160*120，标题最多26个汉字', 4, 3),
(14, '头条', 'commend', '{loop $data $i $r}\n<ul id="{$i}">\n<li>\n<div class="imgtxt">\n<a href="{$r[url]}"><img src="{thumb($r[thumb],100,75)}" width="100" height="75" alt="" /></a>\n</div>\n<h3><a href="{$r[url]}" class="bold">{$r[title]}</a></h3>\n<p class="summary">{$r[description]}[<a href="{$r[url]}" class="detail">详细</a>]</p>\n</li>\n</ul>\n{/loop}', 3600, NULL, 18, 1282896306, 1, 1283234355, 1, NULL, NULL, '图片规格 100*75，标题最多17个汉字，摘要最多48个汉字', 1, 4),
(15, '推荐视频', 'commend', '<ul>\r\n{loop $data $i $r}\r\n    <li>\r\n    {if $r[color]}\r\n    	<a href="{$r[url]}" style="color:{$r[color]};">{$r[title]}</a>\r\n    {else}\r\n    	<a href="{$r[url]}">{$r[title]}</a>\r\n    {/if} \r\n   </li>\r\n{/loop}\r\n</ul>', 3600, NULL, 17, 1282896638, 1, 1283234355, 1, NULL, NULL, '标题最多11个汉字', 6, 4),
(16, '每日推荐', 'commend', '<ul>\r\n{content modelid="1" orderby="pv desc" size="10"}\r\n<li><a href="{$r[url]}">{$r[title]}</a></li>\r\n{/content}\r\n</ul>', 3600, NULL, 28, 1282894957, 1, 1283234355, 1, NULL, NULL, '标题最多22个汉字', 10, 5),
(17, '焦点图片', 'commend', '<ul class="per-50">\r\n{content modelid="2" orderby="pv desc" size="6"}\r\n    <li>\r\n        <a href="{$r[url]}"><img src="{thumb($r[thumb],120,90)}" width="120" height="90" alt="{$r[title]}" /></a>\r\n        <p><a href="{$r[url]}">{$r[title]}</a></p>\r\n    </li>\r\n{/content}\r\n</ul>\r\n						\r\n					', 3600, NULL, 27, 1282895146, 1, 1283234355, 1, NULL, NULL, '图片规格 120*90，标题最多22个汉字', 6, 5),
(18, '幻灯片', 'commend', '<div class="big-pic">\n	{loop $data $i $r}\n		<a href="{$r[url]}" class="cur" {if $i==1} style="display: block;" {/if}><img src="{thumb($r[thumb],370,248)}" width="370" height="248" /></a>\n	{/loop}\n</div>\n<div class="thumb" style="width: 190px;">\n	<ul>\n		{loop $data $i $r}\n		<li>\n			<a href="{$r[url]}" class="cur"><img src="{thumb($r[thumb],60,40)}" width="60" height="40" /></a>\n			<p><a href="{$r[url]}">{$r[title]}</a></p>\n		</li>\n		{/loop}\n	</ul>\n</div>', 3600, NULL, 16, 1282896229, 1, 1283775726, 1, NULL, NULL, '图片规格 370*248，标题最多27个汉字', 4, 4),
(19, '点击排行', 'auto', '<ol>\r\n<!--{content published="7" orderby="pv desc" size="10"}-->\r\n    <li><em<!--{if $i<=3}--> class="front"<!--{/if}-->>{$i}</em><a href="{$r[url]}" title="{$r[title]}">{str_cut($r[title], 40,'''')}</a></li>\r\n<!--{/content}-->\r\n</ol>', 3600, 1283866524, 9, 1282912555, 1, 1283856649, 1, 1283866524, 1, '标题最多20个汉字', 10, 5),
(20, '评论排行', 'auto', '<ol>\r\n<!--{content published="7" orderby="comments desc" size="10"}-->\r\n    <li><em<!--{if $i<=3}--> class="front"<!--{/if}-->>{$i}</em><a href="{$r[url]}" title="{$r[title]}">{str_cut($r[title], 40,'''')}</a></li>\r\n<!--{/content}-->\r\n</ol>', 3600, 1283866524, 15, 1282912577, 1, 1283856850, 1, 1283866524, 1, '标题最多20个汉字', 10, 5),
(21, 'Digg排行', 'auto', '<ol>\r\n<!--{db sql="SELECT * FROM `cmstop_content` AS c, `cmstop_digg` AS d WHERE c.contentid=d.contentid AND c.published>=UNIX_TIMESTAMP()-7*24*3600 AND c.status=6 ORDER BY d.supports DESC" size="10"}-->\r\n    <li><em<!--{if $i<=3}--> class="front"<!--{/if}-->>{$i}</em><a href="{$r[url]}" title="{$r[title]}">{str_cut($r[title], 40, '''')}</a></li>\r\n<!--{/db}-->\r\n</ol>', 3600, 1283866524, 14, 1282912604, 1, 1283856864, 1, 1283866524, 1, '标题最多20个汉字', 10, 5),
(22, '组图页精选', 'auto', '<ul>\r\n<!--{content modelid="2" weight="80," orderby="published DESC" size="6"}-->\r\n  <li>\r\n     <a href="{$r[url]}"><img src="{thumb($r[thumb], 140, 105)}" alt="{$r[title]}" /></a>\r\n     <p><a href="{$r[url]}">{$r[title]}</a></p>\r\n  </li>\r\n<!--{/content}-->\r\n</ul>', 3600, 1283864964, 26, 1282897055, 1, 1283864787, 1, 1283864964, 1, '标题最多24个汉字', 6, 5),
(23, '频道页顶部banner1', 'html', '<a href="http://www.cmstop.com" target="_blank"><img src="{WWW_URL}img/templates/default/images/ads/01.gif" /></a>', 3600, NULL, 21, 1282897588, 1, 1283857242, 1, 1283857242, 1, '', 10, 6),
(24, '频道页顶部banner2', 'html', '<a href="http://www.cmstop.com" target="_blank"><img src="{WWW_URL}img/templates/default/images/ads/02.gif" /></a>', 3600, NULL, 20, 1282897636, 1, 1283857234, 1, 1283857234, 1, '', 10, 6),
(25, '首页文字链', 'commend', '<ul class="mode-txtlink line-h20 no-point">\r\n{loop $data $i $r}\r\n	<li>\r\n	{if $r[color]}\r\n	<a href="{$r[url]}">{str_cut($r[title], 26)}</a>\r\n	{else}\r\n	<a href="{$r[url]}" style="color:{$r[color]}">{str_cut($r[title], 26)}</a>\r\n	{/if}\r\n	</li>\r\n{/loop}\r\n</ul>', 3600, NULL, 33, 1282897671, 1, 1283483265, 1, NULL, NULL, '', 10, 6),
(26, '首页右侧banner1', 'html', '<a href="http://www.cmstop.com" target="_blank"><img src="{WWW_URL}img/templates/default/images/ads/08.gif" alt="" /></a>', 3600, NULL, 25, 1282898345, 1, 1283857202, 1, 1283857202, 1, '', 10, 6),
(27, '首页右侧banner2', 'html', '<a href="http://www.cmstop.com" target="_blank"><img src="{WWW_URL}img/templates/default/images/ads/09.gif" alt="" /></a>', 3600, NULL, 24, 1282898355, 1, 1283857220, 1, 1283857220, 1, '', 10, 6),
(28, '内容页右侧banner', 'html', '<a href="http://www.cmstop.com" target="_blank"><img src="{WWW_URL}img/templates/default/images/ads/05.gif" border="0" alt="广告" /></a>', 3600, NULL, 22, 1282898408, 1, 1283857188, 1, 1283857188, 1, '', 10, 6),
(29, '首页通栏banner', 'html', '<p><a href="http://www.cmstop.com" target="_blank"><img src="{WWW_URL}img/templates/default/images/ads/07.gif" border="0" width="960" height="80" /></a></p>', 3600, NULL, 23, 1282898453, 1, 1283861090, 1, 1283861090, 1, '', 10, 6),
(30, '内容页顶部banner1', 'html', '<p><a href="http://www.cmstop.com" target="_blank"><img src="{WWW_URL}img/templates/default/images/ads/03.gif" border="0" width="650" height="80" /></a></p>', 3600, NULL, 36, 1283854893, 1, 1283855236, 1, 1283855236, 1, '', 10, 6),
(31, '内容页顶部banner2', 'html', '<p><a href="http://www.cmstop.com" target="_blank"><img src="{WWW_URL}img/templates/default/images/ads/04.gif" border="0" width="300" height="80" /></a></p>', 3600, NULL, 37, 1283854938, 1, 1283855255, 1, 1283855255, 1, '', 10, 6),
(32, '友情链接', 'commend', '<ul class="bor-gray">\r\n{loop $data $i $r}\r\n	{if $r[thumb]}\r\n	<li><a href="{$r[url]}" target="_blank"><img src="{thumb($r[thumb], 88, 31)}"  alt="{$r[title]}" title="{$r[title]}"/></a></li>\r\n	{else}\r\n	<li>{if $r[color]}<a href="{$r[url]}" target="_blank" style="color:{$r[color]}">{$r[title]}</a>{else}<a href="{$r[url]}" target="_blank">{$r[title]}</a>{/if}</li>\r\n	{/if}\r\n{/loop}\r\n</ul>', 3600, NULL, 6, 1282876895, 1, 1283234355, 1, NULL, NULL, '同时支持logo和文字链接，logo规格 88*31，', 20, 2),
(33, '关于我们', 'html', '<p>请在这里输入内容</p>', 3600, NULL, 5, 1283845978, 1, 1283846391, 1, 1283846391, 1, '', 10, 7),
(34, '联系我们', 'html', '<p>公司地址：北京市海淀区上地三街嘉华大厦E座407室</p>\n<p>热线电话：010-62961030</p>\n<p>邮政编码：100085</p>\n<p>电子邮箱：webmaster@cmstop.com</p>', 3600, NULL, 4, 1283846026, 1, 1283846754, 1, 1283846754, 1, '', 10, 7),
(35, '加入我们', 'html', '<p>招聘信息</p>', 3600, NULL, 3, 1283846057, 1, 1283846773, 1, 1283846773, 1, '', 10, 7),
(36, '版权声明', 'html', '<p>版权声明</p>', 3600, NULL, 2, 1283846072, 1, 1283846786, 1, 1283846786, 1, '', 10, 7),
(37, '手机访问', 'html', '<p>请通过手机访问：http://www.***.com/wap/</p>', 3600, NULL, 1, 1283846126, 1, 1283846792, 1, 1283846792, 1, '', 10, 7);

INSERT INTO `cmstop_section_data` (`dataid`, `sectionid`, `contentid`, `title`, `color`, `url`, `thumb`, `description`, `sort`, `created`, `createdby`, `commended`, `commendedby`) VALUES
(1, 32, 0, 'CmsTop', '', 'http://www.cmstop.com', 'link_logo.gif', '', 1, 1282881944, 1, 1282881944, 1);

INSERT INTO `cmstop_section_class` (`classid`, `name`, `sort`, `memo`) VALUES
(1, '其它', 0, '默认分类'),
(2, '首页', 6, ''),
(3, '图片频道', 5, ''),
(4, '视频频道', 4, ''),
(5, '内容页推荐', 3, ''),
(6, '广告', 2, ''),
(7, '关于', 1, '关于我们、联系我们、加入我们、版权声明');

ALTER TABLE `cmstop_aca`
  ADD CONSTRAINT `cmstop_aca_ibfk_1` FOREIGN KEY (`parentid`) REFERENCES `cmstop_aca` (`acaid`) ON DELETE CASCADE;

ALTER TABLE `cmstop_admin`
  ADD CONSTRAINT `cmstop_admin_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `cmstop_member` (`userid`) ON DELETE CASCADE,
  ADD CONSTRAINT `cmstop_admin_ibfk_2` FOREIGN KEY (`roleid`) REFERENCES `cmstop_role` (`roleid`) ON DELETE SET NULL;

ALTER TABLE `cmstop_admin_stat`
  ADD CONSTRAINT `cmstop_admin_stat_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `cmstop_admin` (`userid`) ON DELETE CASCADE;

ALTER TABLE `cmstop_article`
  ADD CONSTRAINT `cmstop_article_ibfk_1` FOREIGN KEY (`contentid`) REFERENCES `cmstop_content` (`contentid`) ON DELETE CASCADE;
  
ALTER TABLE `cmstop_attachment_folder_recent`
  ADD CONSTRAINT `cmstop_attachment_folder_recent_ibfk_1` FOREIGN KEY (`fid`) REFERENCES `cmstop_attachment_folder` (`fid`) ON DELETE CASCADE;
  
ALTER TABLE `cmstop_category`
  ADD CONSTRAINT `cmstop_category_ibfk_1` FOREIGN KEY (`parentid`) REFERENCES `cmstop_category` (`catid`) ON DELETE CASCADE;

ALTER TABLE `cmstop_category_priv`
  ADD CONSTRAINT `cmstop_category_priv_ibfk_1` FOREIGN KEY (`catid`) REFERENCES `cmstop_category` (`catid`) ON DELETE CASCADE,
  ADD CONSTRAINT `cmstop_category_priv_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `cmstop_admin` (`userid`) ON DELETE CASCADE;

ALTER TABLE `cmstop_category_stat`
  ADD CONSTRAINT `cmstop_category_stat_ibfk_1` FOREIGN KEY (`catid`) REFERENCES `cmstop_category` (`catid`) ON DELETE CASCADE;

ALTER TABLE `cmstop_content_log`
  ADD CONSTRAINT `cmstop_content_log_ibfk_1` FOREIGN KEY (`contentid`) REFERENCES `cmstop_content` (`contentid`) ON DELETE CASCADE;

ALTER TABLE `cmstop_content_note`
  ADD CONSTRAINT `cmstop_content_note_ibfk_1` FOREIGN KEY (`contentid`) REFERENCES `cmstop_content` (`contentid`) ON DELETE CASCADE;

ALTER TABLE `cmstop_content_tag`
  ADD CONSTRAINT `cmstop_content_tag_ibfk_3` FOREIGN KEY (`contentid`) REFERENCES `cmstop_content` (`contentid`) ON DELETE CASCADE,
  ADD CONSTRAINT `cmstop_content_tag_ibfk_4` FOREIGN KEY (`tagid`) REFERENCES `cmstop_tag` (`tagid`) ON DELETE CASCADE;

ALTER TABLE `cmstop_content_version`
  ADD CONSTRAINT `cmstop_content_version_ibfk_1` FOREIGN KEY (`contentid`) REFERENCES `cmstop_content` (`contentid`) ON DELETE CASCADE;

ALTER TABLE `cmstop_department`
  ADD CONSTRAINT `cmstop_department_ibfk_2` FOREIGN KEY (`leaderid`) REFERENCES `cmstop_role` (`roleid`) ON DELETE SET NULL;
  
ALTER TABLE `cmstop_department_role`
  ADD CONSTRAINT `cmstop_department_role_ibfk_1` FOREIGN KEY (`departmentid`) REFERENCES `cmstop_department` (`departmentid`) ON DELETE CASCADE,
  ADD CONSTRAINT `cmstop_department_role_ibfk_2` FOREIGN KEY (`roleid`) REFERENCES `cmstop_role` (`roleid`) ON DELETE CASCADE;

ALTER TABLE `cmstop_menu`
  ADD CONSTRAINT `cmstop_menu_ibfk_1` FOREIGN KEY (`parentid`) REFERENCES `cmstop_menu` (`menuid`) ON DELETE CASCADE;

ALTER TABLE `cmstop_model_stat`
  ADD CONSTRAINT `cmstop_model_stat_ibfk_1` FOREIGN KEY (`modelid`) REFERENCES `cmstop_model` (`modelid`) ON DELETE CASCADE;

ALTER TABLE `cmstop_related`
  ADD CONSTRAINT `cmstop_related_ibfk_1` FOREIGN KEY (`contentid`) REFERENCES `cmstop_content` (`contentid`) ON DELETE CASCADE;

ALTER TABLE `cmstop_role_aca`
  ADD CONSTRAINT `cmstop_role_aca_ibfk_1` FOREIGN KEY (`acaid`) REFERENCES `cmstop_aca` (`acaid`) ON DELETE CASCADE,
  ADD CONSTRAINT `cmstop_role_aca_ibfk_2` FOREIGN KEY (`roleid`) REFERENCES `cmstop_role` (`roleid`) ON DELETE CASCADE;

ALTER TABLE `cmstop_section_data`
  ADD CONSTRAINT `cmstop_section_data_ibfk_1` FOREIGN KEY (`sectionid`) REFERENCES `cmstop_section` (`sectionid`) ON DELETE CASCADE;

ALTER TABLE `cmstop_section_priv`
  ADD CONSTRAINT `cmstop_section_priv_ibfk_1` FOREIGN KEY (`sectionid`) REFERENCES `cmstop_section` (`sectionid`) ON DELETE CASCADE,
  ADD CONSTRAINT `cmstop_section_priv_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `cmstop_admin` (`userid`) ON DELETE CASCADE;

ALTER TABLE `cmstop_workflow_step`
  ADD CONSTRAINT `cmstop_workflow_step_ibfk_1` FOREIGN KEY (`workflowid`) REFERENCES `cmstop_workflow` (`workflowid`) ON DELETE CASCADE;

ALTER TABLE `cmstop_member_detail`
  ADD CONSTRAINT `cmstop_member_detail_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `cmstop_member` (`userid`) ON DELETE CASCADE;