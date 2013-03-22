<?php
$member_front_plugin = array();

if(UCENTER == 'ucenter')
{
	$member_front_plugin['ucenter'] = array('before_login', 'after_login', 'before_register', 'after_logout','before_check_email',
		'before_check_username','before_get_photo', 'after_password', 'after_email', 'after_getProfile');
} else if (UCENTER == 'phpwind') 
{
	$member_front_plugin['phpwind'] = array('before_login', 'after_login', 'before_register', 'after_logout','before_check_email',
		'before_check_username','before_get_photo', 'after_password', 'after_email', 'after_getProfile');
}
return $member_front_plugin;