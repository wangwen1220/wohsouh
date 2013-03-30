<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/weibo.class.php");
$dblink = new DataBase("");
$user = UserApi::getLoginUserSessionInfo();
$uid = $user['uid'];
$userinfo = UserApi::getUserName($uid);
$tab = $_GET['tab'];
if($user===false){
	die('<a href="/member.php?mod=logging&action=login">没有权限，请登陆</a>');
}else {
	//发布动态
	if ($tab == 'ajax_user_dynamic'){
		$msg = $_POST['content'];
		$img_arr = empty($_POST['pictures']) ? array() : $_POST['pictures'];
		$music = explode(",", $_POST['music_url']);
		$music_arr = empty($_POST['music_url']) ? array() : $music;
		$vedio_arr = array();
		if (!empty($msg)){
			if (utf8_strlen($msg) > '140'){
				echo '';
			}else {
				$dynamic = Weibo::senDynamic($userinfo[0]['uid'],$userinfo[0]['nickname'],$msg,$img_arr,$vedio_arr,$music_arr);
				if (checkErr($dynamic)) {
					require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/module/weibo/weibo_return_user_dynamic.php");
				}else {
					echo '';
				}	
			}
		}else {
			echo '';
		}
		return;
	}elseif ($tab == 'ajax_user_forwarding'){//转发微薄
		if($user===false){
			die('<a href="/member.php?mod=logging&action=login">没有权限，请登陆</a>');
		}else {
		$reply_msg_id = $_GET['msg_id'];
		$retransmit_msg_id = $_GET['reply_msg_id'];
		header("Content-Type: text/xml; charset=utf-8");
		echo '<?xml version="1.0" encoding="utf-8"?>
		<root><![CDATA[';
		include_once($_SERVER['DOCUMENT_ROOT']."/huoshow/smarty/templates/weibo/weibo_user_forwarding.html");
		echo ']]></root>';
		}
	}elseif ($tab == 'ajax_user_add_forwarding'){
// 		if (!empty($_POST['name'])){
			$msg = $_POST['name'];
			$uid = $_GET['uid'];
			$reply_msg_id = $_GET['reply_msg_id']; //回复的消息ID
			$retransmit_msg_id = $_GET['retransmit_msg_id']; //转发的消息ID
			$retransmitmsg = Weibo::retransmitMsg($userinfo[0]['uid'],$userinfo[0]['nickname'],$reply_msg_id,$retransmit_msg_id,$msg);
			if (checkErr($retransmitmsg)) {
				echo 1;
			}else {
				echo 0;
			}
// 		}else {
// 			echo 0;
// 		}
		return;
	}elseif ($tab == 'ajax_user_comments'){//评论微薄
		$msg_id = $_POST['msgid'];
		$msg = $_POST['content'];
		if (!empty($msg)){
			$replymsg = Weibo::replyMsg($userinfo[0]['uid'],$userinfo[0]['nickname'],$msg_id,$msg);
			if(checkErr($replymsg)){
				$count_msg = Weibo::getFullMsgReply($msg_id);
				$count_data = count($count_msg);
				echo $count_data;
			}else {
				echo 'null';
			}
		}else {
			echo 'null';
		}
		
	}elseif ($tab == 'ajax_user_follow'){//关注
		$dst_uid = $_GET['dst_uid'];
		$live = $_GET['type'];
		$user_info = UserApi::getUserName($dst_uid);
		header("Content-Type: text/xml; charset=utf-8");
		echo '<?xml version="1.0" encoding="utf-8"?>
		<root><![CDATA[';
		include_once($_SERVER['DOCUMENT_ROOT']."/huoshow/smarty/templates/weibo/weibo_user_ajax_follow.html");
		echo ']]></root>';
	}elseif ($tab == 'ajax_user_add_follow'){
		$dst_uid = $_GET['dst_uid'];
		$src_uid = $_GET['src_uid'];
		$live = $_GET['type'];
		$follow_arr = Weibo::followUser($src_uid,$dst_uid);
		if(empty($live)){
			if (checkErr($follow_arr)) {
				echo 1;
			}else {
				echo 0;
			}
		}else {
			if (checkErr($follow_arr)) {
				echo 2;
			}else {
				echo 0;
			}	
		}
	}elseif ($tab == 'ajax_user_message'){
		$reply_uid = $_GET['reply_uid'];
		$msg_id = $_GET['msg_id'];
		$msg = $_GET['msg'];
		$src_nickname = $_GET['src_name'];
		header("Content-Type: text/xml; charset=utf-8");
		echo '<?xml version="1.0" encoding="utf-8"?>
		<root><![CDATA[';
		include_once($_SERVER['DOCUMENT_ROOT']."/huoshow/smarty/templates/weibo/weibo_user_ajax_message.html");
		echo ']]></root>';
	}elseif ($tab == 'ajax_user_reply_message'){
		if (!empty($_POST['name'])){
			$reply_uid = $_GET['reply_uid'];
			$msg_id = $_GET['msg_id'];
			$msg = $_POST['name'];
			$reply_msg = Weibo::replyPrivateMail($reply_uid,$msg_id,$msg);
			if (checkErr($reply_msg)){
				echo 1;
			}else {
				echo 0;
			}
		}else {
			echo 0;
		}
	}elseif ($tab == 'ajax_user_del_message'){
		$msg_id = $_GET['msg_id'];
		$delmsg = Weibo::deletePrivateMail($msg_id);
		if (checkErr($delmsg)){
			header("Content-Type: text/html; charset=utf-8");
			g('删除私信成功',"/home.php?mod=huoshow&do=weibo&list=3&msg=2");
		}else {
			header("Content-Type: text/html; charset=utf-8");
			g('删除私信失败!',"/home.php?mod=huoshow&do=weibo&list=3&msg=2");
		}
		
	}elseif ($tab == 'ajax_user_send_message'){
		$src_uid = $_GET['src_uid'];
		$dst_uid = $_GET['dst_uid'];
		header("Content-Type: text/xml; charset=utf-8");
		echo '<?xml version="1.0" encoding="utf-8"?>
		<root><![CDATA[';
		include_once($_SERVER['DOCUMENT_ROOT']."/huoshow/smarty/templates/weibo/weibo_user_send_message.html");
		echo ']]></root>';
	}elseif ($tab == 'ajax_user_add_send_message'){
		if (!empty($_POST['name'])){
			if (trim($_POST['name']))
			{
				$src_uid = $_GET['src_uid'];
				$dst_uid = $_GET['dst_uid'];
				$mail_content = $_POST['name'];
				$mail_data = Weibo::SendPrivateMail($src_uid,$dst_uid,$mail_content);
				if (checkErr($mail_data)){
					echo 1;
				}else {
					echo 0;
				}
			}else {
				echo 0;
			}
		}else {
			echo 0;
		}
	}elseif($tab == 'ajax_user_del_dynamic'){
		$manager_uid = $_GET['manager_uid'];
		$msg_id = $_GET['msg_id'];
		$del_msg_data = Weibo::delMsg($manager_uid, $msg_id);
		if (checkErr($del_msg_data)){
			echo json_encode(true);
		}else {
			echo json_encode(false);
		}
	}

}
?>