<?php
require_once("simpletest/autorun.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoom.class.php");

class TestMutiliveRoom extends UnitTestCase
{
	//测试帐号用户名
	private $test_usernmae='huoshow_test';
	public function __construct()
	{
		parent::__construct();
	}
	
	
	/**
	 * 测试免费申请
	 *
	 */
	public function test_createMutiliveRoomFree()
	{
		$dblink = new DataBase("");
		$sql = "SELECT uid,username FROM pre_ucenter_members WHERE username='".$this->test_usernmae."'";
		$dbarr = $dblink->getRow($sql);
		$this->assertTrue(count($dbarr)>0);
		$returnArr = MutiliveRoom::createMutiliveRoomFree($dbarr[0]["uid"],1,$dbarr[0]["username"]);
		header("Content-type: text/html; charset=utf-8");
		echoErr($returnArr);
		$this->assertTrue($returnArr["-retult-"]!==false);
			
		//$dblink
		$dblink->dbclose();
	}
}
?>