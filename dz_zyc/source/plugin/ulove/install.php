<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$sql = <<<EOF
CREATE TABLE IF NOT EXISTS `hsk_ulove` (
  `id` mediumint(12) unsigned NOT NULL auto_increment,
  `sendid` mediumint(15) NOT NULL default '0',
  `toid` mediumint(15) NOT NULL default '0',
  `dateline` int(15) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `sendid` (`sendid`,`toid`,`dateline`)
) ENGINE=MyISAM;

EOF;

runquery($sql);
$finish = TRUE;
?>