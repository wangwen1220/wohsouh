<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: task_friend.php 6752 2010-03-25 08:47:54Z cnteacher $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class task_friend {

	var $version = '1.0';
	var $name = 'friend_name';
	var $description = 'friend_desc';
	var $copyright = '<a href="http://www.comsenz.com" target="_blank">Comsenz Inc.</a>';
	var $icon = '';
	var $period = '';
	var $periodtype = 0;
	var $conditions = array();

	function csc($task = array()) {
		global $_G;
		
		$num = getuserprofile('friends');
		if( $num >= 5 ) {
			return true;
		}
		return array('csc' => $num > 0 ? sprintf("%01.2f", $num / 5 * 100) : 0, 'remaintime' => 0);
	}

	function view() {
		return lang('task/friend', 'friend_view');
	}

}

?>