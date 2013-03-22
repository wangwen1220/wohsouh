<?php

/*
 * 截获发贴数据，转发到调用文件
 * lsj 2010-06-02
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

function purifySend($pid, $message) {
    global $db,$tablepre,$tid, $fid, $discuz_uid, $discuz_user;
    require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'common.php';
    //初始化工作类
    $HL_Purify = & Purify::singleton();
    //log start
    $log_date = $HL_Purify->cur_date . " " . $HL_Purify->cur_time;
    $HL_Purify->log('/*******' . $log_date . '*******/');
    $HL_Purify->log("purifySend function start");
    if (!$pid) {
        $HL_Purify->log('error for pid null');
        return false;
    }
    if (empty($message)) {
        $HL_Purify->log('error for message null');
        return false;
    }
    
    #获取帖子信息
    $post = $HL_Purify->get_post_pid($pid, "posts");
    if (!$post) {
    	$HL_Purify->log("error for get post data from database!");
    	return false;
    }
    $post['author'] = $discuz_user;
    $post['authorid'] = intval($discuz_uid);
    $post['useip'] = hl_getIp();
	//编辑权限（含时间段）判断
	$mod = $HL_Purify->modCheck($post['fid']);
    $post['audit'] = bindec($mod['thread'] * 10 + $mod['reply']);
	//准备发送数据
    $HL_Purify->log("prepare to run", true);
    $HL_Purify->run($post, false);
    $HL_Purify->log("complete!");

    return false;
}

