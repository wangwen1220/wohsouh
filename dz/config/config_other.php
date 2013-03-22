<?php
####内网配置##############################################
//---------转换服务器FTP--------
$ftpConvertConfig = array(
	'on' => 1,
	'host' => '192.168.2.172',
	'port' => 21,
	'username' => 'huoshow',
	'password' => '123456',
	'ssl' => 0,
	'timeout' => 7200,
	'pasv' => 1,
	'dir' => '.',
	'uploadDir' => 'pub/huoshow/source/',
	'convertDir' => 'pub/huoshow/convert/'
);
//---------资源服务器FTP--------
$ftpResourceConfig = array(
	1=>array(
		'on' => 1,
		'host' => '192.168.2.172',
		'port' => 21,
		'username' => 'huoshow',
		'password' => '123456',
		'ssl' => 0,
		'timeout' => 7200,
		'pasv' => 1,
		'dir' => '.',
		'uploadDir' => 'pub/huoshow/resource/',
		'recordTempDir' => 'pub/huoshow/record/temp',
		'recordDir' => 'pub/huoshow/record/'
	)
);
#end


####外网配置##############################################
//----------转换服务器FTP-------
$ftpConvertConfig = array(
	'on' => 1,
	'host' => '121.14.211.35',
	'port' => 21,
	'username' => 'huoshow',
	'password' => 'huoshow#1234',
	'ssl' => 0,
	'timeout' => 7200,
	'pasv' => 1,
	'dir' => '.',
	'uploadDir' => 'huoshow/video/source/',
	'convertDir' => 'huoshow/video/convert/'
);
//---------资源服务器FTP--------
$ftpResourceConfig = array(
	1=>array(
		'on' => 1,
		'host' => 'res1.netwaymedia.com',
		'port' => 21,
		'username' => 'huoshow',
		'password' => 'huoshow!ab!789',
		'ssl' => 0,
		'timeout' => 7200,
		'pasv' => 1,
		'dir' => '.',
		'uploadDir' => 'pub/huoshow/video/',
		'recordTempDir' => 'pub/tmp/',
		'recordDir' => 'pub/saishi/'
	)
);
#end
?>