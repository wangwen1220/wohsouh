<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

require_once DISCUZ_ROOT . '/source/plugin/bao10jie/common.php';

class plugin_bao10jie {

    function plugin_bao10jie() {
        
    }

}

class plugin_bao10jie_forum extends plugin_bao10jie {

    //var $log_open = false;#默认关闭log
    var $purify; #工作类变量
    var $log_date = ""; #log date,etc 2011-04-12
    var $isAudit = 0;
    /*
     * 功能:构造函数,发帖或编辑贴权限初始化及工作类初始化
     */

    function plugin_bao10jie_forum() {
        global $_G, $post, $postlist;
        $modnewthreads = 0; #新主题帖权限
        $modnewreplies = 0; #新回复贴权限
        //发帖或编辑贴权限判断
        if (periodscheck('postmodperiods', 0)) {#时间段判断
            $modnewthreads = $modnewreplies = 1;
        } else {#版块和用户组权限判断
            $censormod = censormod($post['subject'] . "\t" . $post['message']);
            $modnewthreads = (!$_G['group']['allowdirectpost'] || $_G['group']['allowdirectpost'] == 1) && $_G['forum']['modnewposts'] || $censormod ? 1 : 0;
            $modnewreplies = (!$_G['group']['allowdirectpost'] || $_G['group']['allowdirectpost'] == 2) && $_G['forum']['modnewposts'] == 2 || $censormod ? 1 : 0;
        }
        $this->isAudit = bindec($modnewthreads * 10 + $modnewreplies);
        //初始化工作类
        $this->purify = & Purify::singleton();
        //log start
        $this->log_date = $this->purify->cur_date . " " . $this->purify->cur_time;
    }

    /**
     * 功能:临时改变设置,不允许快速跳转
     * 位置:post脚本之前执行,即forum脚本中执行,或提交后跳转前执行
     */
    function post_bao10jie_aftersubmit() {
        $config = (array) @unserialize($GLOBALS['_G']['setting']['msgforward']);
        $config['refreshtime'] = 3;  //只能是大于0的整数
        $config['quick'] = 0;
        $GLOBALS['_G']['setting']['msgforward'] = serialize($config);
    }

    /**
     * 功能:编辑或发布帖子后,转发数据到bao10jie
     * 位置:在帖子发布到服务器上后，被显示到浏览器之前嵌入,模板加载第一行前执行
     * 需审核,对版块设置了需审核的很灵。对不需审核而被插件命中待审的快速回帖会报错??
     */
    function post_bao10jie_submit_output() {
        global $_G, $pid, $tid;
        //主题id,用于获得帖子分表名
        $tid = $tid ? $tid : $_G['tid'];
        if (!$pid || !$tid) {
            return array();
        }
        //file_put_contents("E:\log.txt", $tid);
        $this->purify->log("/*****" . $this->log_date . "*****/");
        $this->purify->log("post_bao10jie_submit_output function start");
        #保存草稿
        if ($_POST && $_POST['save']) {
            $this->purify->log("skip for draft"); #normal mode
            return array();
        }
        #获取帖子分表名
        $posttable = getposttablebytid($tid);
        $this->purify->log("post table : ".$posttable, true);
        #获取帖子信息
        $post = $this->purify->get_post_pid($pid, $posttable);
        if (!$post) {
            $this->purify->log("error for get post data from database!");
            return array();
        }
        
        if ($_G['uid'])
            $post['authorid'] = $_G['uid'];
        if ($_G['username'])
            $post['author'] = $_G['username'];
            
        $post['audit'] = $this->isAudit;

        #管理人员编辑别人帖子或自己编辑自己帖子
        if ($_POST['modthreadkey'] != '' || ($_G['gp_action'] == 'edit')) {
            $this->purify->log("edit post on pid:" . $pid);
            $post['useip'] = hl_getIp();
        } else {#发新帖子
            $this->purify->log("new post on pid:" . $pid);
        }

        $this->purify->log("prepare to run", true);
        $this->purify->run($post);
        $this->purify->log("complete!");
        return array();
    }

//    function log($content, $debug = false) {
//        $this->purify->log($content, $debug);
//        return true;
//    }

//	/**
//     * 浏览帖子详细内容时，在加载页面底部时嵌入。在快速回复时也会被触发
//     */
//    function viewthread_bottom_output() {
//		
//		return array();
//    }
//    
//	/**
//     * 浏览帖子详细内容时，在加载页面底部时嵌入。在快速回复时也会被触发
//     * 不需审核
//     * 对不需审核而被插件命中待审的回帖很灵。但对版块设置了需审核的帖子没有发送到接口
//     * 
//     * $_G['perm']['allowdirectpost']    
//	 * 3 全部需要审核 1 发新回复不需要审核 2 发新主题不需要审核 0 全部不需要审核   
//     */
//    function viewthread_postbottom_output() {
//		
//		return array();
//    }
//
//	/**
//	 * 帖子发布成功，被显示到浏览器之前嵌入， 在快速回复时，最先被调用。
//	 */
//    function post_bottom() {
//        return array();
//    }
//    
//	/**
//     * 浏览版块列表，在加载页面底部时嵌入。暂时无用
//     */
//    function index_bottom_output() {
//        return array();
//    }	    
//
//    /**
//     * 浏览主帖列表，在加载页面底部时嵌入。暂时无用
//     */
//    function forumdisplay_bottom_output() {
//        return array();
//    }
}
