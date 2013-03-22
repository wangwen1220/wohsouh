<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('function/live');
$roomid=trim($_G['gp_roomid']);

include_once template("show/show_user_dynamic");
?>