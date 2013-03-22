<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: task_myshow.php 2011-02-28 autor:lanlan
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class task_myshow {

	var $version = '1.0';
	var $name = 'myshow_name';
	var $description = 'myshow_desc';
	var $copyright = '<a href="http://www.comsenz.com" target="_blank">Comsenz Inc.</a>';
	var $icon = '';
	var $period = '';
	var $periodtype = 0;
	var $conditions = array(
		'act' => array(
			'title' => 'post_complete_var_act',
			'type' => 'mradio',
			'value' => array(
				array('myshow', 'post_complete_var_act_myshow'),
			),
			'default' => 'myshow',
			'sort' => 'complete',
		),
		'forumid' => array(
			'title' => 'post_complate_var_forumid',
			'type' => 'select',
			'value' => array(),
			'sort' => 'complete',
		),
		'num' => array(
			'title' => 'post_complete_var_num',
			'type' => 'text',
			'value' => '',
			'sort' => 'complete',
		),
		'time' => array(
			'title' => 'post_complete_var_time',
			'type' => 'text',
			'value' => '',
			'sort' => 'complete',
		)
	);
	
    function task_myshow() {
		global $_G;
	    $v_type=videoType();   
		$this->conditions['forumid']['value'][] = array(0, '&nbsp;');
		foreach($v_type as $id => $type) {
			$this->conditions['forumid']['value'][] = array('t'.$type['id'], $type['name']);
			foreach(videoClassify($type['id']) as $fid => $forum) {
			$this->conditions['forumid']['value'][] = array($forum['id'], ($forum['type_id'] == '1' ? str_repeat('&nbsp;', 4) : ($forum['type_id'] == '2' ? str_repeat('&nbsp;', 4) : '')).$forum['name']);
			    }
			}
	}
	function csc($task = array()) {
		global $_G;
		$taskvars = array('num' => 0);
		$query = DB::query("SELECT variable, value FROM ".DB::table('common_taskvar')." WHERE taskid='$task[taskid]'");
		while($taskvar = DB::fetch($query)) {
			if($taskvar['value']) {
				$taskvars[$taskvar['variable']] = $taskvar['value'];
			}
		}
		$tbladd = $sqladd = '';
		if(!empty($taskvars[forumid])){
		     if(substr($taskvars['forumid'],0,1) == 't') {
			      $ty=substr($taskvars[forumid],1);
			      $sqladd .= " AND v.type='$ty'";
		      }else{
			      $sqladd .= " AND v.classify='$taskvars[forumid]'";
		      }
		}	
		$sqladd .= ($taskvars['time'] = floatval($taskvars['time'])) ? " AND v.dateline BETWEEN $task[applytime] AND $task[applytime]+3600*$taskvars[time]" : " AND v.dateline>$task[applytime]";

		if($taskvars['act']) {
			if($taskvars['act'] == 'myshow') {
				$sqladd .= " AND auditstatus=2 AND v.recommand='1'";
			} 
		}
	$num = DB::result_first("SELECT COUNT(*) FROM ".DB::table('video_list')." v where v.uid='$_G[uid]' $sqladd");
	
	if($num && $num >= $taskvars['num']) {
			return TRUE;
		} elseif($taskvars['time'] && TIMESTAMP >= $task['applytime'] + 3600 * $taskvars['time'] && (!$num || $num < $taskvars['num'])) {
			return FALSE;
		} else {
			return array('csc' => $num > 0 && $taskvars['num'] ? sprintf("%01.2f", $num / $taskvars['num'] * 100) : 0, 'remaintime' => $taskvars['time'] ? $task['applytime'] + $taskvars['time'] * 3600 - TIMESTAMP : 0);
		}
	}

	function view($task, $taskvars) {
		global $_G;
		$return = $value = "";		
		if(!empty($taskvars['complete']['forumid'])) {
			if(substr($taskvars['complete']['forumid']['value'],0,1)=='t'){
				$forumid=substr($taskvars['complete']['forumid']['value'],1);
				$forumid=='1' ? $value="音频" : $value="视频";
				
			}else{
				$forumid=$taskvars['complete']['forumid']['value'];
				$value=videoname($forumid);
			}
			
			//$value = intval($forumid);
			//$value = '<a href="home.php?mod=spacecp&ac=myshow" target="_blank"><strong>上传MY秀      '.$zs.'</strong></a>';
		} 
		$taskvars['complete']['num']['value'] = intval($taskvars['complete']['num']['value']);
		if($taskvars['complete']['act']['value'] == 'myshow') {
				$return .= lang('task/myshow', 'myshow_view', array('value' => $value, 'num' => $taskvars['complete']['num']['value']));
		} 
		return $return;
	}

}

?>