<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: member_lostpasswd.php 8189 2010-04-19 02:39:59Z wangjinbo $
 */



define('NOROBOT', TRUE);

//$discuz_action = 141;

if(submitcheck('problemsubmit', 1)) {
	
   if(trim($_POST['problem_title'])=='' || trim($_POST['problem_content'])=='' || trim($_POST['problem_email'])=='')
   {
   	  showmessage('problem_send_err',dreferer(), array(), array('showdialog'=>1, 'showmsg' => true, 'closetime' =>  8));
   }
   $data=array(
   'title'=>htmlspecialchars($_POST['problem_title'],ENT_QUOTES),
   'content'=>htmlspecialchars($_POST['problem_content'],ENT_QUOTES),
   'email'=>htmlspecialchars($_POST['problem_email'],ENT_QUOTES),
   'url'=>htmlspecialchars($_SERVER['HTTP_REFERER'],ENT_QUOTES),
   'ip'=>$_SERVER['REMOTE_ADDR'],
   'dateline'=>time()
   );
   !empty($_G['username']) ? $data['username']=$_G['username'] : "";
   $res=DB::insert('web_problem', $data,1);
   if($res)
   {
   	   showmessage('problem_send_succeed',dreferer(), array(), array('showdialog'=>1, 'showmsg' => true, 'closetime' =>  8));
   	   
   }
   else 
   {
   	  showmessage('problem_send_false',dreferer(), array(), array('showdialog'=>1, 'showmsg' => true, 'closetime' =>  1));
   }
   
}
else 
{
	include template('member/problem');
}

?>
