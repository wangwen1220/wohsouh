<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/function.core.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/weibo.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
$dblink = new DataBase("");
$userinfo = UserApi::getLoginUserSessionInfo();
$uid = $userinfo['uid'];
if ($_GET['savegroup']=='group') {
	$sql = "select group_name from pre_weibo_group where uid = $uid";
	$iscreatename = $dblink->getRow($sql);//判断分组名是否已经存在
	$count = count($iscreatename);
	$groupname = $_POST['groupname'];
	if (empty($groupname)) {
		echo '{"status":"0", "value":"分组名不能为空"}';
					die();

	}
	if($groupname =='相互关注') {
		echo '{"status":"0", "value":"分组名不能为相互关注"}';
					die();
	
	}
	if ($groupname == '未分组') {
		echo '{"status":"0", "value":"分组名不能为未分组"}';
					die();
	}
	if (strlen($groupname)>20) {
		echo '{"status":"0", "value":"分组名长度太长"}';
					die();
	}
	if ($groupname == '全部') {
		echo '{"status":"0", "value":"分组名不能为全部"}';
					die();
	}
	 $guestexp = '\xA1\xA1|\xAC\xA3|^Guest|^\xD3\xCE\xBF\xCD|\xB9\x43\xAB\xC8';
	 if (preg_match('/\s+|^c:\\con\\con|[%,\*\"\s\<\>\&]|$guestexp/is', $groupname) )
        {
             echo '{"status":"0", "value":"非法字符，请重新输入！"}';
			 die();
         }else {
                  $groupname;
          }
          for($i=0;$i<$count;$i++) {
          	if ($groupname == $iscreatename[$i]['group_name']){
          		echo '{"status":"0", "value":"分组名已经存在！"}';
			 	die();
          	}else {
          		$groupname;
          	} 
          }                  
		weibo::createGroup($uid,$groupname);
		echo '{"status":"1", "value":"分组创建成功"}';
					die();
	
}
if ($_GET['tab']=='creategroup') {
	header("Content-Type: text/xml; charset=utf-8");
				echo '<?xml version="1.0" encoding="utf-8"?>
				<root><![CDATA[';
				include_once($_SERVER['DOCUMENT_ROOT']."/huoshow/module/home/home_weibo_setgroup.php");
				echo ']]></root>';
}
?>