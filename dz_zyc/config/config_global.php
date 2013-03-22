<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/huoshow/configs/config_dynamic.php');

$_config = array();

// ----------------------------  CONFIG DB  ----------------------------- //
$_config['db']['1']['dbhost'] = '192.168.2.172';
$_config['db']['1']['dbuser'] = 'root';
$_config['db']['1']['dbpw'] = '123456';
$_config['db']['1']['dbcharset'] = 'utf8';
$_config['db']['1']['pconnect'] = '0';
$_config['db']['1']['dbname'] = GLOBAL_MYSQLBASE;
$_config['db']['1']['tablepre'] = 'pre_';

// --------------------------  CONFIG MEMORY  --------------------------- //
$_config['memory']['prefix'] = 'VYch1i_';
$_config['memory']['eaccelerator'] = 1;
$_config['memory']['xcache'] = 1;
$_config['memory']['memcache']['server'] = '';
$_config['memory']['memcache']['port'] = 11211;
$_config['memory']['memcache']['pconnect'] = 1;
$_config['memory']['memcache']['timeout'] = 1;

// --------------------------  CONFIG SERVER  --------------------------- //
$_config['server']['id'] = 1;

// -------------------------  CONFIG DOWNLOAD  -------------------------- //
$_config['download']['readmod'] = 2;
$_config['download']['xsendfile']['type'] = '0';
$_config['download']['xsendfile']['dir'] = '/down/';

// ---------------------------  CONFIG CACHE  --------------------------- //
$_config['cache']['type'] = 'sql';

// --------------------------  CONFIG OUTPUT  --------------------------- //
$_config['output']['charset'] = 'utf-8';
$_config['output']['forceheader'] = 1;
$_config['output']['gzip'] = '0';
$_config['output']['tplrefresh'] = 1;
$_config['output']['language'] = 'zh_cn';
$_config['output']['staticurl'] = 'static/';
$_config['output']['ajaxvalidate'] = '0';

// --------------------------  CONFIG COOKIE  --------------------------- //
$_config['cookie']['cookiepre'] = GLOBAL_COOKIE_PRE;
$_config['cookie']['cookiedomain'] = '.'.GLOBAL_SITEDOMAIN;
$_config['cookie']['cookiepath'] = GLOBAL_COOKIE_PATH;

// -------------------------  CONFIG SECURITY  -------------------------- //
//$_config['security']['authkey'] = 'c3bea7Ala8uV7Hz3';
$_config['security']['authkey'] = GLOBAL_COOKIE_AUTHKEY;
$_config['security']['urlxssdefend'] = 1;
$_config['security']['attackevasive'] = '0';
$_config['security']['querysafe']['status'] = 0;
$_config['security']['querysafe']['dfunction']['0'] = 'load_file';
$_config['security']['querysafe']['dfunction']['1'] = 'hex';
$_config['security']['querysafe']['dfunction']['2'] = 'substring';
$_config['security']['querysafe']['dfunction']['3'] = 'if';
$_config['security']['querysafe']['dfunction']['4'] = 'ord';
$_config['security']['querysafe']['dfunction']['5'] = 'char';
$_config['security']['querysafe']['daction']['0'] = 'intooutfile';
$_config['security']['querysafe']['daction']['1'] = 'intodumpfile';
$_config['security']['querysafe']['daction']['2'] = 'unionselect';
$_config['security']['querysafe']['daction']['3'] = '(select';
$_config['security']['querysafe']['dnote']['0'] = '/*';
$_config['security']['querysafe']['dnote']['1'] = '*/';
$_config['security']['querysafe']['dnote']['2'] = '#';
$_config['security']['querysafe']['dnote']['3'] = '--';
$_config['security']['querysafe']['dnote']['4'] = '"';
$_config['security']['querysafe']['dlikehex'] = 1;
$_config['security']['querysafe']['afullnote'] = 1;

// --------------------------  CONFIG ADMINCP  -------------------------- //
// -------- Founders: $_config['admincp']['founder'] = '1,2,3'; --------- //
$_config['admincp']['founder'] = '1';
$_config['admincp']['forcesecques'] = '0';
$_config['admincp']['checkip'] = 1;
$_config['admincp']['runquery'] = 1;
$_config['admincp']['dbimport'] = 1;

$_config['plugindeveloper'] = 1;

define('MSN_HOST', '192.168.2.172');//消息服务器外网用live.huoshow.com
define('API_SOCKET_HOST', '192.168.2.172');//api发送
define('MSN_PORT', 10000);//消息服务器端口
define('CMSTOP_HOST', GLOBAL_SITEDOMAIN);#CMSTOP
define('FILE_HOST', 'res1.netwaymedia.com');//资源服务器
define('HUOSHOW_MONEY', 100);//充值1元兑换火秀币率
define("PERID", 2);//设置PK赛时段ID
define('WWW_URL', 'http://pnews.'.GLOBAL_SITEDOMAIN."/");

define('MYSHOW_URL', 'http://myshow.'.GLOBAL_SITEDOMAIN."/");
define('DX_HUOSHOW_SHOW_URL', 'http://live.'.GLOBAL_SITEDOMAIN."/");
define('DX_HUOSHOW_BBS_URL', 'http://bbs.'.GLOBAL_SITEDOMAIN."/");
define('IMG_URL', 'http://news.'.GLOBAL_SITEDOMAIN."/");
define('PNWS_URL', 'http://pnews.'.GLOBAL_SITEDOMAIN."/");
define('LOCAL_PORT', '10001');//本地发消息端口
define('LOCAL_HOST', '192.168.2.172');//本地发消息主机

// -------------------  THE END  -------------------- //
define('DATE_YMD',date("Y年m月d日"));
if (date('w')==0) define('DATE_WEEK','日');
if (date('w')==1) define('DATE_WEEK','一');
if (date('w')==2) define('DATE_WEEK','二');
if (date('w')==3) define('DATE_WEEK','三');
if (date('w')==4) define('DATE_WEEK','四');
if (date('w')==5) define('DATE_WEEK','五');
if (date('w')==6) define('DATE_WEEK','六');

//FMS配置
define('FMS_SERVER', 'fms.huoshow.com:8081');

//迎新年活动礼物ID配置
define('DZ_GIFT_BAG_ID', 185);

//直播memcache配置
define('CMEMCACHE_ENABLE', 0);
define('CMEMCACHE_HOST', '127.0.0.1');
define('CMEMCACHE_PORT', 11211);
define('CMEMCACHE_PCONNECT', 1);
define('CMEMCACHE_LIVE_USERLIST', 60);
define('CMEMCACHE_LIVE_GIFTLIST', 60);
define('CMEMCACHE_LIVE_NEW_NOTICE', 60);
define('CMEMCACHE_LIVE_ROOMSTATUS', 60);
define('CMEMCACHE_LIVE_FANS', 600);
define('CMEMCACHE_LIVE_GIFTHOT', 3600);
define('CMEMCACHE_LIVE_HALL', 3);
define('CMEMCACHE_LIVE_HALL_ACTIVE', 3);

include  dirname(dirname(__FILE__)).'/source/class/class_cmemcache.php';
//end
?>
