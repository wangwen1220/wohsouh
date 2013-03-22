<?php
/**
 * 火秀配置文件
 *
 * @author chengkui
 * @package defaultPackage
 */
require_once('Smarty.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/huoshow/configs/config_dynamic.php');

//站点根目录，方便定位
//使用$_SERVER['DOCUMENT_ROOT']，只要站点根目录做 到Huoshow的
//静态符号链接，则路径不会出问题
//$SYSCONFIG["ROOTPATH"] = "/local/ck_files/dz1.5/upload";


//是否调试模式
$SYSCONFIG["DEBUG"] = true;
//默认数据库
$SYSCONFIG["MYsqlDataBase"] = GLOBAL_MYSQLBASE;

/*===域名设置===*/
//站点根域
$SYSCONFIG["SiteRoot"] = GLOBAL_SITEDOMAIN;
//站点根cookie域
$SYSCONFIG["SiteRootCookieDomain"] = ".".$SYSCONFIG["SiteRoot"];
//space域名
$SYSCONFIG["SpaceSiteRoot"] = "space.".$SYSCONFIG["SiteRoot"];
//live域名
$SYSCONFIG["LiveSiteRoot"] = "live.".$SYSCONFIG["SiteRoot"];
//bbs域名
$SYSCONFIG["BbsSiteRoot"] = "bbs.".$SYSCONFIG["SiteRoot"];
//news域名
$SYSCONFIG["NewsSiteRoot"] = "news.".$SYSCONFIG["SiteRoot"];
//pnews域名
define('PCMS_URL', 'http://pnews.'.GLOBAL_SITEDOMAIN."/");
/*
当前系统管理员后台是使用的哪个平台
dz:说明现在的系统管理员是直接使用的discuz的后台
huoshow:如果以后全部抛弃discuz，则这里写成huoshow,系统中
		留出接口用于重写诸如权限判断之类的功能。
*/
$SYSCONFIG["CurrentAdminSys"] = 'dz';

//缓存时间
define('CACHEVALUES',"100");



function smarty_init()
{
	global $SYSCONFIG;
	$smarty = new Smarty();

	$smarty->template_dir = $_SERVER['DOCUMENT_ROOT'].'/huoshow/smarty/templates/';
	$smarty->compile_dir  = $_SERVER['DOCUMENT_ROOT'].'/huoshow/smarty/templates_c/';
	$smarty->config_dir   = $_SERVER['DOCUMENT_ROOT'].'/huoshow/smarty/configs/';
	$smarty->cache_dir    = $_SERVER['DOCUMENT_ROOT'].'/huoshow/smarty/cache/';
	$smarty->trusted_dir = $_SERVER['DOCUMENT_ROOT'];
	//$smarty->security = true;
	$smarty->assign("SPACE_URL",$SYSCONFIG["SpaceSiteRoot"]);
	$smarty->assign("LIVE_URL",$SYSCONFIG["LiveSiteRoot"]);
	$smarty->assign("BBS_URL",$SYSCONFIG["BbsSiteRoot"]);
	$smarty->assign("NEWS_URL",$SYSCONFIG["NewsSiteRoot"]);
	$smarty->assign("SPACE_URL","http://".$SYSCONFIG["SpaceSiteRoot"]);
	$smarty->assign("LIVE_URL","http://".$SYSCONFIG["LiveSiteRoot"]);
	$smarty->assign("BBS_URL","http://".$SYSCONFIG["BbsSiteRoot"]);
	$smarty->assign("NEWS_URL","http://".$SYSCONFIG["NewsSiteRoot"]);
	//** 解除下面一行的注释以打开调试控制台
	//$smarty->debugging = true;
	$smarty->debugging = false;
	return $smarty;
}

/*
 * 在phpcms中,某些情况下$SYSCONFIG会失效，比如guestbook_tag的get_sys_weibo
 * 把其作为全局变量
 * */
$GLOBALS["SYSCONFIG"] = $SYSCONFIG;
?>