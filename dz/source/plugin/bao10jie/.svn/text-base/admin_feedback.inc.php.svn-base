<?php
/*
* 帖子净化插件——后台审核
*/

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) exit('Access Denied');

set_time_limit(0);

require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'common.php';
//初始化工作类
$HL_Purify = & Purify::singleton();
#导入插件的配置文件
require HL_CACHE_ROOT.HL_DS.'bao10jie'.HL_DS.'config.inc.php';
require_once HL_PLUGIN_ROOT.HL_DS.'class'.HL_DS.'pager.class.php';

#查询参数
$pg = abs(intval($_REQUEST['page']));#当前页码
$pn = abs(intval($_REQUEST['sel_page']));#每页显示条数
$selTime = abs(intval($_REQUEST['sel_time']));#发帖时间
$selType = abs(intval($_REQUEST['sel_type']));#是否为主帖
$selBoard = abs(intval($_REQUEST['sel_board']));#版块ID
$selState = abs(intval($_REQUEST['sel_state']));#帖子的状态
$selDoer = abs(intval($_REQUEST['sel_doer']));#帖子的处理状态
$selMode = abs(intval($_REQUEST['sel_mode']));#海量标引状态[正常&疑似&垃圾]

$it = strip_tags(trim($_REQUEST['it']));#标识是否从搜索而来。
$selWord = trim($_REQUEST['sel_word']);
$selAuthor = trim($_REQUEST['sel_author']);
$selPid = abs(intval(trim($_REQUEST['sel_pid'])));
$selIp = strip_tags(trim($_REQUEST['sel_ip']));
$selFtime = strip_tags(trim($_REQUEST['sel_ftime']));
$selTtime = strip_tags(trim($_REQUEST['sel_ttime']));

$pids = $_POST['pids'];#提交处理的PID们
$thepid = abs(intval($_POST['thepid']));#单条处理的PID
$thests = abs(intval($_POST['thests']));#单条处理状态值

if(HL_VERSION == "X2" || HL_VERSION == "X1.5"){
    require_once HL_PLUGIN_ROOT.HL_DS.'admin_list.new.php';
}else{
    require_once HL_PLUGIN_ROOT.HL_DS.'admin_list.old.php';
}
