<?php
error_reporting(0);	//如果要打开错误提示，设为1

// 只需修改WWW_URL参数
define('WWW_URL', '{WWW_URL}');				// 域名
define('ROOT', '{ROOT}');					// url根目录，如果是放在test目录下就是/test/
define('ADMIN_URL', WWW_URL.'admin/');		// 后台网址
define('APP_URL', WWW_URL.'app/');			// 前台动态访问网址
define('IMG_URL', WWW_URL.'img/');			// 前台JS、CSS网址
define('UPLOAD_URL', WWW_URL.'upload/');	// 所有上传文件URL
define('WAP_URL', WWW_URL.'wap/');			// WAP网址
define('SPACE_URL', WWW_URL.'space/');		// 专栏网址

define('FW_PATH', CMSTOP_PATH.'framework'.DS);
define('CACHE_PATH', CMSTOP_PATH.'data'.DS.'cache'.DS);
define('WWW_PATH', ROOT_PATH);
define('PUBLIC_PATH', ROOT_PATH);
define('ADMIN_PATH', WWW_PATH.'admin/');
define('SPACE_PATH', WWW_PATH.'space/');
define('UPLOAD_PATH', WWW_PATH.'upload'.DS);
define('WAP_PATH', WWW_PATH.'wap'.DS);
define('IMG_PATH', WWW_PATH.'img'.DS);

//constants
define('MALE',			1);
define('FEMALE',		2);