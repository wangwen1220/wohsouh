<?php
//数据库IP
define('GLOBAL_MYSQL_IP','192.168.2.172');
//默认数据库
define('GLOBAL_MYSQLBASE','huoshow_beta');
//数据库用户名
define('GLOBAL_MYSQL_USER','root');
//数据库密码
define('GLOBAL_MYSQL_PWD','123456');
//根域名
define('GLOBAL_SITEDOMAIN','zyc.huoshow.com');

define('GLOBAL_MAGIC_GIFT_ID',185);


define('GLOBAL_COOKIE_PRE','eIdP_');
define('GLOBAL_COOKIE_PATH','/');
define('GLOBAL_COOKIE_AUTHKEY','c3bea7Ala8uV7Hz3');

//多人直播间IP、端口设置
define('MUTIL_ROOM_SERVER_P_HOST', '192.168.2.172');//消息服务器(多人远程)所在IP
define('MUTIL_ROOM_SERVER_P_PORT', '10006');        //消息服务器(多人远程)所在端口
define('MUTIL_ROOM_SERVER_S_HOST', '192.168.2.172');//消息服务器(多人本地)所在端口
define('MUTIL_ROOM_SERVER_S_PORT', '10007');        //消息服务器(多人本地)所在端口

define('DX_URL', 'http://space.'.GLOBAL_SITEDOMAIN."/");
?>