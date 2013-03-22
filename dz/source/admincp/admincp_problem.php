<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: admincp_tasks.php 9116 2010-04-27 03:09:21Z monkey $
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

cpheader();
shownav('extended', 'menu_problem');
showsubmenu('menu_problem', array());
showformheader('problem');
showtableheader();
if(!($operation)){
      $_G['setting']['memberperpage'] = 20;
      $page = max(1, $_G['page']);
      $start_limit = ($page - 1) * $_G['setting']['memberperpage'];
      $search_condition = array_merge($_GET, $_POST);
      foreach($search_condition as $k => $v) {
      	if(in_array($k, array('action', 'operation', 'formhash', 'submit', 'page')) || $v === '') {
      		unset($search_condition[$k]);
      	}
      }

		
		//showsetting('tasks_on', 'taskonnew', $_G['setting']['taskon'], 'radio');
		//showtablefooter();
		showtableheader('tasks_list', 'fixpadding');
		showsubtitle(array('misc_focus_topic_subject', 'members_edit_email', 'admin_problem_username', 'admin_problem_more'));

		$problem_res = array();
		$problem_res_count=DB::result_first("SELECT COUNT(*) AS count FROM ".DB::table('web_problem')."");
		if($problem_res_count > 0) {
			$multipage = multi($problem_res_count, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=problem");
			$query = DB::query("SELECT * FROM ".DB::table('web_problem')." ORDER BY id DESC");
			while($problem_res = DB::fetch($query)) {
				$problem_res['username'] ? $problem_res['username']=$problem_res['username'] :  $problem_res['username']="[匿名]";
				showtablerow('', array('', ''), array(
				$problem_res['title'],
				$problem_res['email'],
				$problem_res['username'],
				'<a href="admin.php?action=problem&operation=view&id='.$problem_res['id'].'">查看</a>'
				));

			}
			showsubmit('', '', '', '', $multipage);
		}
}
else 
{
	$id=$_GET['id'];
	empty($id) ? $id=0 : $id=$id;
	$query = DB::query("SELECT * FROM ".DB::table('web_problem')." WHERE id ='{$id}' LIMIT 1");
	$problem_res=DB::fetch($query);
	if($problem_res)
	{
			$problem_res['username'] ? $problem_res['username']=$problem_res['username'] :  $problem_res['username']="[匿名]";
			showsubtitle(array('misc_focus_topic_subject'));
			showtablerow('', array('', ''), array(
			$problem_res['title']

			));
			showsubtitle(array('members_edit_email'));
			showtablerow('', array('', ''), array(

			$problem_res['email']

			));
			showsubtitle(array('admin_problem_username'));
			showtablerow('', array('', ''), array(

			$problem_res['username']

			));
			showsubtitle(array('admin_problem_content'));
			showtablerow('', array('', ''), array(

			$problem_res['content']

			));
			showsubtitle(array('admin_problem_url'));
			showtablerow('', array('', ''), array(
			$problem_res['url']

			));
			showsubtitle(array('admin_problem_time'));
			showtablerow('', array('', ''), array(
			date('Y-m-d H:i:s',$problem_res['dateline'])

			));
			showtablerow('', array('', ''), array(
			'<button type="button" name="problemsubmit_btn" class="pn pnc" onclick="history.back();"><strong>返回</strong></button>'
			));
	}

}
		

//showsubmit('tasksubmit', 'submit');
showtablefooter();
showformfooter();

