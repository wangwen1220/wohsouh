<?php

/* * ***********
  # 帖子搜索，只对已自动处理的帖子搜索
  # lsj 2010-11-18
 * *********** */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'common.php';
#导入插件的配置文件
require HL_CACHE_ROOT.HL_DS.'bao10jie'.HL_DS.'config.inc.php';

$selBoard = intval($_REQUEST['sel_board']);
$selWord = base64_decode(trim($_REQUEST['sel_word']));
$selAuthor = base64_decode(trim($_REQUEST['sel_author']));
$selPid = intval(trim($_REQUEST['sel_pid']));
$selIp = base64_decode(trim($_REQUEST['sel_ip']));
$selFtime = trim($_REQUEST['sel_ftime']);
$selTtime = trim($_REQUEST['sel_ttime']);

if ($selTtime == '')
    $selTtime = date('Y-m-d');
if ($selFtime == '')
    $selFtime = date('Y-m-d', strtotime($selTtime) - 86400);

#查询出版块
if (HL_VERSION == "X2" || HL_VERSION == "X1.5") {
    $sql = "SELECT `fid`, `name` FROM " . DB::table('forum_forum') . " WHERE 1 and type<>'group' and status=1";
    $query = DB::query($sql);
    while ($row = DB::fetch($query)) {
        $boards[$row['fid']] = $row;
    }
    $submit_url = "admin.php?action=plugins&operation=config&identifier=bao10jie&pmod=admin_feedback&it=psel";
} else {
    $sql = "SELECT `fid`, `name` FROM {$tablepre}forums WHERE 1 and type<>'group' and status=1";
    $qy = $db->query($sql);
    while ($row = $db->fetch_array($qy)) {
        $boards[$row['fid']] = $row;
    }
    $submit_url = "admincp.php?action=plugins&operation=config&identifier=bao10jie&mod=admin_feedback&it=psel";
}
#解析到模板
include HL_PLUGIN_ROOT . HL_DS . 'template' . HL_DS . 'psearch.tpl.php';









