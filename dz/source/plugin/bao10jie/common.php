<?php
/**
 * 通用声明文件
 */
#all discuz version that we support
$hl_all_version = array(0=>'X2',1=>'X1.5',2=>'6.0.0',3 =>'6.1.0',4=>'7.0.0',5 =>'7.1',6=>'7.2');
$hl_all_key = array(0=>'X2',1=>'X1.5',2=>'6',3=>'6',4=>'7',5=>'7',6=>'7');#插件版本key
$HL_VERSIONS = array('X2','X1.5','6','7');#代码内部版本区分

define('HL_DS', DIRECTORY_SEPARATOR);#路径分隔符
#discuz root path select array
$hl_roots = array(
	'dz' => dirname(dirname(dirname(__FILE__))),
	'x' => dirname(dirname(dirname(dirname(__FILE__))))
);
#引入核心文件
if(file_exists($hl_roots['x'].HL_DS.'source'.HL_DS.'discuz_version.php')){#discuz x1.5 x2
	$hl_root = $hl_roots['x'];#根目录
	require_once $hl_root.HL_DS.'source'.HL_DS.'class'.HL_DS.'class_core.php';
	//引进版本信息
	require_once $hl_root.HL_DS.'source'.HL_DS.'discuz_version.php';
}elseif(file_exists($hl_roots['dz'].HL_DS.'discuz_version.php')){//discuz 6.0 6.1 7.0 7.1 7.2
	$hl_root = $hl_roots['dz'];#根目录
	require_once $hl_root.HL_DS.'include'.HL_DS.'common.inc.php';
	//引进版本信息
	require_once $hl_root.HL_DS.'discuz_version.php';
}

#确定论坛根目录
define('HL_DISCUZ_ROOT', $hl_root);
#版本信息不存在或不正确
if(!defined('DISCUZ_VERSION') || !in_array(DISCUZ_VERSION, $hl_all_version)){
	exit('Access Denied, DISCUZ_VERSION not exists!');
}

#确定插件版本
$hl_key = array_search(trim(DISCUZ_VERSION), $hl_all_version);
define('HL_VERSION', $hl_all_key[$hl_key]);
#插件的根目录
define('HL_PLUGIN_ROOT', dirname(__FILE__));

if(HL_VERSION == "X2" || HL_VERSION == "X1.5"){
	require_once $hl_root.HL_DS.'source'.HL_DS.'function'.HL_DS.'function_misc.php';
	require_once $hl_root.HL_DS.'source'.HL_DS.'function'.HL_DS.'function_core.php';
	require_once $hl_root.HL_DS.'source'.HL_DS.'function'.HL_DS.'function_post.php';
	require_once $hl_root.HL_DS.'source'.HL_DS.'function'.HL_DS.'function_forum.php';
	require_once $hl_root.HL_DS.'source'.HL_DS.'function'.HL_DS.'function_cache.php';
	require $hl_root.HL_DS.'config'.HL_DS.'config_global.php';
	#插件web根路径
	define('HL_PLUGIN_PATH', 'source/plugin');
	#插件的缓存目录
	define('HL_CACHE_ROOT', HL_DISCUZ_ROOT.HL_DS.'data'.HL_DS.'plugindata');
	#字符集
	define('HL_CHARSET', $_config['output']['charset']);
	#call文件路径
	define('HL_CALL_PATH', 'source/plugin/bao10jie/call.php');
	#帖子URL路径
	define('HL_POST_PATH', 'forum.php?mod=viewthread&tid=');
}else{#discuz 6 7
	//require_once $hl_root.HL_DS.'include'.HL_DS.'global.func.php';
	require_once $hl_root.HL_DS.'include'.HL_DS.'discuzcode.func.php';
	require_once $hl_root.HL_DS.'include'.HL_DS.'forum.func.php';
	require_once $hl_root.HL_DS.'include'.HL_DS.'post.func.php';
	require_once $hl_root.HL_DS.'include'.HL_DS.'misc.func.php';
	require $hl_root.HL_DS.'config.inc.php';
	#插件web根路径
	define('HL_PLUGIN_PATH', 'plugins');
	#补全缓存目录
	if(!is_dir(HL_DISCUZ_ROOT.HL_DS.'forumdata'.HL_DS.'plugins')){
		mkdir(HL_DISCUZ_ROOT.HL_DS.'forumdata'.HL_DS.'plugins', 0777);
	}
	#插件的缓存目录
	define('HL_CACHE_ROOT', HL_DISCUZ_ROOT.HL_DS.'forumdata'.HL_DS.'plugins');
	define('HL_CHARSET', $charset);
	#call文件路径
	define('HL_CALL_PATH', 'plugins/bao10jie/call.php');
	#帖子URL路径
	define('HL_POST_PATH', 'viewthread.php?tid=');
	#discuz 7.0以下版本补发安装文件
	if(floatval(DISCUZ_VERSION) <= 7.0 && !file_exists(HL_CACHE_ROOT.HL_DS.'bao10jie'.HL_DS.'install.lock')){
		require_once HL_PLUGIN_ROOT.HL_DS.'install'.HL_DS.'excute.php';
	}
}

//plugin file included
require_once HL_PLUGIN_ROOT.HL_DS.'function'.HL_DS.'function_common.php';
require_once HL_PLUGIN_ROOT.HL_DS.'class'.HL_DS.'json.class.php';
require_once HL_PLUGIN_ROOT.HL_DS.'class'.HL_DS.'purify.class.php';