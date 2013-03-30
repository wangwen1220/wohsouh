<?php

class guestbook_tag
{
	
	/**
	 * 测试标签功能,返回最新微博
	 * @param unknown_type $data
	 */
	public function get_sys_weibo($data)
	{
		require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/weibo.class.php";
		$lastid = empty($data["lastid"])?0:$data["lastid"];
		$record_page = empty($data["record_page"])?10:$data["record_page"];
		$sys_msg_arr = Weibo::getSysAllMsgFront($lastid,$record_page);
		return $sys_msg_arr;
	}
}
?>