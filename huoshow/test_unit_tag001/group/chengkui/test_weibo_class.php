<?php
require_once("simpletest/autorun.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/weibo.class.php");

class TestWeibo extends UnitTestCase
{
	//测试帐号用户名
	private $test_usernmae='huoshow_test';
	private $m_dblink;
	public function __construct()
	{
		global $SYSCONFIG;
		parent::__construct();
		$SYSCONFIG["MYsqlDataBase"] = 'huoshow_beta_test';
		$this->m_dblink = new DataBase("");
		
		$this->m_dblink->query("delete from pre_weibo_msg");
		$this->m_dblink->query("delete from pre_weibo_user_stat");
		$this->m_dblink->query("delete from pre_weibo_attachment");
		$this->m_dblink->query("delete from pre_weibo_follow");
		$this->m_dblink->query("delete from pre_weibo_group");
		$this->m_dblink->query("delete from pre_weibo_group_info");
		$this->m_dblink->query("delete from pre_weibo_private_msg");
		
		$this->m_dblink->query("alter table pre_weibo_msg AUTO_INCREMENT=1");
		$this->m_dblink->query("alter table pre_weibo_attachment AUTO_INCREMENT=1");
		$this->m_dblink->query("alter table pre_weibo_follow AUTO_INCREMENT=1");
		$this->m_dblink->query("alter table pre_weibo_group AUTO_INCREMENT=1");
		$this->m_dblink->query("alter table pre_weibo_group_info AUTO_INCREMENT=1");
		$this->m_dblink->query("alter table pre_weibo_private_msg AUTO_INCREMENT=1");
	}
	
	public function __destruct()
	{
		$this->m_dblink->dbclose();
	}
	
	private function getCallPosition($arr)
	{
		$str = "line:".$arr[0]["line"];
		return $str;
	}
	
	/**
	 * 检查某条动态的个字段状态
	 * @param unknown_type $msg_id							动态ID
	 * @param unknown_type $route_count						转发数
	 * @param unknown_type $reply_count						回复数
	 * @param unknown_type $attachment_img_count 			图片附件数
	 * @param unknown_type $attachment_vedio_count			视频附件数
	 * @param unknown_type $attachment_music_count 			音频附件数
	 * @param unknown_type $reply_parent_msg_id				上一级回复ID
	 * @param unknown_type $route_parent_msg_id				转发根动态ID
	 * remark	由于调用者调用这个函数时，出错信息全部是集中在这个函数内，导致
	 * 			出问题时不能知道是哪里调用的这个函数，因此这里利用debug_backtrace
	 * 			获得调用堆栈信息，或者是在哪里被调用。
	 */
	private function checkMsgState($msg_id,$route_count,$reply_count,$attachment_img_count,
			$attachment_vedio_count,$attachment_music_count,$reply_parent_msg_id,
			$route_parent_msg_id )
	{
		//$this->fail("hello");
		$bt_arr = debug_backtrace();
		$str = $this->getCallPosition($bt_arr);
		$dbarr = $this->m_dblink->getRow("select * from pre_weibo_msg where id='$msg_id'");
		if(!(count($dbarr)>0))
			$this->fail('count($dbarr)>0 fail '.$str);
		if(!($dbarr[0]["route_count"]==$route_count))
			$this->fail('route count fail '.$str);
		if(!($dbarr[0]["reply_count"]==$reply_count))
			$this->fail('reply_count count fail '.$str);
		if(!($dbarr[0]["attachment_img_count"]==$attachment_img_count))
			$this->fail('attachment_img_count fail '.$str);
		if(!($dbarr[0]["attachment_vedio_count"]==$attachment_vedio_count))
			$this->fail('attachment_vedio_count fail '.$str);
		if(!($dbarr[0]["attachment_music_count"]==$attachment_music_count))
			$this->fail('attachment_music_count fail '.$str);
		if(!($dbarr[0]["reply_parent_msg_id"]==$reply_parent_msg_id))
			$this->fail('reply_parent_msg_id fail '.$str);
		if(!($dbarr[0]["route_parent_msg_id"]==$route_parent_msg_id))
			$this->fail('route_parent_msg_id fail '.$str);
		//$this->assertTrue(count($dbarr)>0);
		//$this->assertTrue($dbarr[0]["route_count"]==$route_count);
		//$this->assertTrue($dbarr[0]["route_count"]==$route_count,"sdf");
		//$this->assertTrue($dbarr[0]["reply_count"]==$reply_count);
		//$this->assertTrue($dbarr[0]["attachment_img_count"]==$attachment_img_count);
		//$this->assertTrue($dbarr[0]["attachment_vedio_count"]==$attachment_vedio_count);
		//$this->assertTrue($dbarr[0]["attachment_music_count"]==$attachment_music_count);
		//$this->assertTrue($dbarr[0]["reply_parent_msg_id"]==$reply_parent_msg_id);
		//$this->assertTrue($dbarr[0]["route_parent_msg_id"]==$route_parent_msg_id);
	}
	
	
	/**
	 * 检查用户状态
	 * @param unknown_type $uid							希望检查的用户ID
	 * @param unknown_type $is_watched_count			这个用户被关注的次数
	 * @param unknown_type $watch_count					这个用户关注他人的次数
	 * @param unknown_type $transmit_count				这个用户转发的动态数
	 * @param unknown_type $is_transmitd_count			这个用户的动态被转发数
	 * @param unknown_type $reply_count 				这个用户回复动态的数量
	 * @param unknown_type $is_replyd_count				这个用户的动态被回复的数量
	 */
	private function checkUserState($uid,$is_watched_count,$watch_count,$transmit_count,
			$is_transmitd_count,$reply_count,$is_replyd_count)
	{
		$bt_arr = debug_backtrace();
		$str = $this->getCallPosition($bt_arr);
		$dbarr = $this->m_dblink->getRow("SELECT `is_watched_count`,`watch_count`,`transmit_count`,
				`is_transmitd_count`,`reply_count`,`is_replyd_count` FROM `pre_weibo_user_stat` 
				WHERE uid='$uid'");
		if(!(count($dbarr)==1))
			$this->fail('count($dbarr)==1 fail '.$str);
		if(!($dbarr[0]["is_watched_count"]==$is_watched_count))
			$this->fail('is_watched_count fail '.$str);
		if(!($dbarr[0]["watch_count"]==$watch_count))
			$this->fail('watch_count fail '.$str);
		if(!($dbarr[0]["transmit_count"]==$transmit_count))
			$this->fail('transmit_count fail '.$str);
		if(!($dbarr[0]["is_transmitd_count"]==$is_transmitd_count))
			$this->fail('is_transmitd_count fail '.$str);
		if(!($dbarr[0]["reply_count"]==$reply_count))
			$this->fail('reply_count fail '.$str);
		if(!($dbarr[0]["is_replyd_count"]==$is_replyd_count))
			$this->fail('is_replyd_count fail '.$str);
		//$this->assertTrue(count($dbarr)==1);
		//$this->assertTrue($dbarr[0]["is_watched_count"]==$is_watched_count);
		//$this->assertTrue($dbarr[0]["watch_count"]==$watch_count);
		//$this->assertTrue($dbarr[0]["transmit_count"]==$transmit_count);
		//$this->assertTrue($dbarr[0]["is_transmitd_count"]==$is_transmitd_count);
		//$this->assertTrue($dbarr[0]["reply_count"]==$reply_count);
		//$this->assertTrue($dbarr[0]["is_replyd_count"]==$is_replyd_count);
	}
	
	/**
	 * 测试发动态、回复动态、转发动态
	 *
	 */
	public function test_send_dynamic_msg()
	{
		
		$r = Weibo::senDynamic("107291", "redwood9", "hello");
		echoErr($r);
		$this->assertTrue($r["-retult-"]!==false);
		//发动态时,`route_count`,`reply_count`,
		//因为没有发附件，因此`attachment_img_count`,`attachment_vedio_count`,`attachment_music_count`应都为0
		$this->checkMsgState(1,0,0,0,0,0,0,0);
		
		//pre_weibo_user_stat `transmit_count`,`is_transmitd_count`,`reply_count`,`is_replyd_count`
		//die();
		//sleep(1);
		//有附件，因此附件数应该都对得上
		$r = Weibo::senDynamic("107291", "redwood9", "hello",array("/upload/test/ttt.jpg",
				"/upload/test/ttt2.jpg","/upload/test/ttt3.jpg"),
				array("/upload/test/ttt.flv"),
				array("/upload/test/ttt.mp3"));
		echoErr($r);
		$this->assertTrue($r["-retult-"]!==false);
		$this->checkMsgState(2,0,0,3,1,1,0,0);
		//sleep(1);
		//测试回复
		$r=Weibo::replyMsg("17241", "zhouyc03", "1", "不错");
		echoErr($r);
		$this->assertTrue($r["-retult-"]!==false);
		$this->checkMsgState(3,0,0,0,0,0,1,0);
		$this->checkMsgState(1,0,1,0,0,0,0,0);
		$dbarr = $this->m_dblink->getRow("select uid from pre_weibo_msg where id='1'");
		$this->checkUserState($dbarr[0]["uid"], 0, 0, 0, 0, 0, 1);
		//sleep(1);
		$r=Weibo::replyMsg("17242", "zhouyc04", "1", "是不错");
		echoErr($r);
		$this->assertTrue($r["-retult-"]!==false);
		$this->checkMsgState(4,0,0,0,0,0,1,0);
		$this->checkMsgState(1,0,2,0,0,0,0,0);
		$dbarr = $this->m_dblink->getRow("select uid from pre_weibo_msg where id='1'");
		$this->checkUserState($dbarr[0]["uid"], 0, 0, 0, 0, 0, 2);
		//sleep(1);
		//测试转发
		$r=Weibo::retransmitMsg("17241", "zhouyc03","1","1","你说的有点道理");
		echoErr($r);
		$this->assertTrue($r["-retult-"]!==false);
		//1的转发数应该为1
		$this->checkMsgState(5,0,0,0,0,0,1,1);
		$this->checkMsgState(1,1,2,0,0,0,0,0);
		$this->checkUserState(17241, 0, 0, 1, 0, 1, 0);
		$this->checkUserState($dbarr[0]["uid"], 0, 0, 0, 1, 0, 2);
		
		//sleep(1);
		$r=Weibo::retransmitMsg("17243", "zhouyc05","5","1","嗯，赞同");
		echoErr($r);
		$this->assertTrue($r["-retult-"]!==false);
		$this->checkMsgState(6,0,0,0,0,0,5,1);
		$this->checkMsgState(5,1,0,0,0,0,1,1);
		$this->checkUserState(17243, 0, 0, 1, 0, 0, 0);
		$this->checkUserState(17241, 0, 0, 1, 1, 1, 0);
		$this->checkMsgState(1,2,2,0,0,0,0,0);
		$this->checkUserState($dbarr[0]["uid"], 0, 0, 0, 2, 0, 2);
		
		//sleep(1);
		$r=Weibo::retransmitMsg("17244", "zhouyc06","6","1","好吧，算你说{}对了");
		echoErr($r);
		$this->assertTrue($r["-retult-"]!==false);
		$this->checkMsgState(7,0,0,0,0,0,6,1);
		$this->checkMsgState(6,1,0,0,0,0,5,1);
		$this->checkMsgState(1,3,2,0,0,0,0,0);
		$this->checkMsgState(5,1,0,0,0,0,1,1);
		$this->checkUserState(17244, 0, 0, 1, 0, 0, 0);
		$this->checkUserState($dbarr[0]["uid"], 0, 0, 0, 3, 0, 2);
		$this->checkUserState(17243, 0, 0, 1, 1, 0, 0);
		$this->checkUserState(17241, 0, 0, 1, 1, 1, 0);
		//sleep(1);
		$r=Weibo::retransmitMsg("17245", "zhouyc07","7","1","");
		echoErr($r);
		$this->assertTrue($r["-retult-"]!==false);
		//die();
	}

	public function test_GetUserReplyMsg()
	{
		$r = Weibo::getFullMsgReply("1");
		if(!checkErr($r))
		{
			dieErr($r);
			$this->assertTrue($r["-retult-"]!==false);
		}

		$this->assertTrue(count($r) == 2);
	}
	
	public function test_getUserMsg()
	{
		$r = Weibo::getUserAllMsg(107291);
		if(!checkErr($r))
		{
			dieErr($r);
			$this->assertTrue($r["-retult-"]!==false);
		}
		$this->assertTrue(count($r) == 2);
		//var_dump($r);
	}

	public function test_aboutFollow()
	{
		//测试关注某人
		$r = Weibo::followUser("107291","17241");
		if(!checkErr($r))
		{
			$this->fail('follow user fail'.echoErr($r));
		}
		$r = Weibo::followUser("107291","17241");
		if(checkErr($r))
		{
			$this->fail('follow user fail'.echoErr($r));
		}
		//被关注的次数,关注他人的次数,转发的动态数,动态被转发数,回复动态的数量,动态被回复的数量
		$this->checkUserState(107291, 0, 1, 0, 4, 0, 2);
		$this->checkUserState(17241, 1, 0, 1, 1, 1, 0);
		
		$r = Weibo::cancelFollowUser("107291","17241");
		if(!checkErr($r))
		{
			$this->fail('cancel Follow user fail'.echoErr($r));
		}
		
		$dbarr = $this->m_dblink->getRow("select watch_count from pre_weibo_user_stat where uid='107291'");
		if($dbarr[0]["watch_count"]!=0)
		{
			$this->fail('watch_count fail'.echoErr($r));
		}
		$dbarr = Weibo::getUserStatInfo(17241);
		if($dbarr[0]["beFollowCount"]!=0)
		{
			$this->fail('is_watch_count fail'.echoErr($r));
		}
	}
	
	public function testAboutGroup()
	{
		$r = Weibo::followUser("107291","17241");
		$r = Weibo::followUser("107291","28154");
		$r = Weibo::createGroup("107291","朋友");
		if(!checkErr($r))
		{
			$this->fail('create group fail'.echoErr($r));
		}
		
		$r = Weibo::putUserToGroup(107291,17241,1);
		$r = Weibo::putUserToGroup(107291,28154,1);
		if(!checkErr($r))
		{
			$this->fail('put user to group fail'.echoErr($r));
		}
		Weibo::delUserFromGroup(107291,17241);
		$r = Weibo::changeGroupName(1,"朋友-修改后");
		if(!checkErr($r))
		{
			$this->fail('change group fail'.echoErr($r));
		}
		$r = Weibo::deleteGroup(1);
		if(!checkErr($r))
		{
			$this->fail('delete group fail'.echoErr($r));
		}
		
		
	}
	
	public function testDisplayDynamic()
	{
		global $SYSCONFIG;
		//$SYSCONFIG["MYsqlDataBase"] = 'huoshow_beta';
		$r = Weibo::getUserAllMsg('28154');
		//var_dump($r);
		
	}
	
	public function testGetAllUserFollow()
	{
		//global $SYSCONFIG;
		//$SYSCONFIG["MYsqlDataBase"] = 'huoshow_beta';
		$r = Weibo::getUserAllFollow('107298',-1,1,100,1,'desc');
	}

	public function testDelMsg()
	{
		$r = Weibo::delMsg("107293", 1,"非法信息");
		if(!checkErr($r))
		{
			$this->fail('delete msg fail'.echoErr($r));
		}
	}
	
	public function testAboutPrivateMail()
	{
		//发送私信
		$r = Weibo::SendPrivateMail("107291", "28154", "hello");
		if(!checkErr($r))
		{
			$this->fail('send private mail fail'.echoErr($r));
		}
		
		//回复私信
		$r = Weibo::replyPrivateMail("28154",1 , "hello too");
		if(!checkErr($r))
		{
			$this->fail('reply private mail fail'.echoErr($r));
		}
		//回复一个不存在的消息ID，如果没有错误，则是不正确的。
		$r = Weibo::replyPrivateMail("28154",4 , "hello too");
		if(checkErr($r))
		{
			$this->fail('reply private mail fail'.echoErr($r));
		}
		
		//删除私信
		$r = Weibo::deletePrivateMail(1);
		if(!checkErr($r))
		{
			$this->fail('delete private mail fail'.echoErr($r));
		}
		//删除私信
		$r = Weibo::deletePrivateMail(2);
		if(!checkErr($r))
		{
			$this->fail('delete private mail fail'.echoErr($r));
		}
	}
}
?>