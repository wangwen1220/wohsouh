<?php
/**
 * 微博相关操作封装
 * @author chengkui
 *
 */
require_once $_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/DataBase.php";
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/community/community.php"; 
class Weibo
{
	/**
	 * 发布动态
	 * 
	 * @param unknown_type $uid				发布动态的用户ID
	 * @param unknown_type $nicename		发布动态的用户昵称
	 * @param unknown_type $msg				发布的动态消息内容
	 * @param unknown_type $img_arr			图片url数组
	 * @param unknown_type $vedio_arr		视频url数组
	 * @param unknown_type $music_arr		音乐url数组
	 * @param $datetime 发送时间
	 * @param $ip 发送IP
	 * 
	 * return 成功返回true,失败返回false
	 */
	static public function senDynamic($uid,$nicename,$msg,$img_arr=array(),
			$vedio_arr=array(),$music_arr=array(),$datetime=false,$ip=false)
	{
		if(empty($uid))
			return getR(false,"UID异常");
		if(empty($nicename))
			return getR(false,"昵称不能为空");
		if(!is_numeric($uid))
			return getR(false,"UID必须是数字");
		if(!is_array($img_arr)|| !is_array($vedio_arr)||!is_array($music_arr))
			return getR(false,"图片、视频、音频地址必须是数组");
		$date_sql = getLocalTimeStr(time());
		if($datetime!==false)
			$date_sql = $datetime;
		
		if(!$ip)
			$ip = getIp();
		$dblink = new DataBase("");
		//$msg = mysql_real_escape_string($msg);
		//if (get_magic_quotes_gpc()==0)
			$msg = Weibo::process_injection($msg);
		//消息入`pre_weibo_msg`
		$dblink->query("INSERT INTO `pre_weibo_msg` (`uid`,`nicename`,`msg`,
							`msg_type`,`reply_parent_msg_id`,
							`route_parent_msg_id`,`route_count`,`reply_count`,
							`attachment_img_count`,
							`attachment_vedio_count`,`attachment_music_count`,
							append_time,ip) 
						values ('$uid','$nicename','$msg','1',
							'0','0','0','0','".count($img_arr)."',
							'".count($vedio_arr)."',
							'".count($music_arr)."','$date_sql','$ip')");
		$msg_id = $dblink->get_id();
		//分别遍历$img_arr、$vedio_arr、$music_arr，在pre_weibo_attachment中添加相应数据
		if(is_array($img_arr))
		{
			for($i=0;$i<count($img_arr);$i++)
			{
				$dblink->query("insert into pre_weibo_attachment (`msg_id`,`type`,`url`) 
						values ('$msg_id','1','".$img_arr[$i]."')");
			}
		}
		if(is_array($vedio_arr))
		{
			for ($i=0;$i<count($vedio_arr);$i++)
			{
				$dblink->query("insert into pre_weibo_attachment (`msg_id`,`type`,`url`)
						values ('$msg_id','2','".$vedio_arr[$i]."')");
			}
		}
		if(is_array($music_arr))
		{
			for ($i=0;$i<count($music_arr);$i++)
			{
				$dblink->query("insert into pre_weibo_attachment (`msg_id`,`type`,`url`)
					values ('$msg_id','3','".$music_arr[$i]."')");
			}
		}
		
		$sql = "SELECT uid FROM pre_weibo_user_stat WHERE uid='$uid'";
		$dbarr = $dblink->getRow($sql);
		if(count($dbarr)<=0)
		{
			$sql = "INSERT INTO pre_weibo_user_stat (uid,is_watched_count,watch_count,transmit_count,
				is_transmitd_count,reply_count,is_replyd_count,last_publish_time,signature,dymic_count,
				img_attachment_count,vedio_attachment_count,music_attachment_count) VALUES
				('$uid','0','0','0','0','0','0','$date_sql','','1',
				'".count($img_arr)."','".count($vedio_arr)."','".count($music_arr)."')";
			$dblink->query($sql);
		}
		else
		{
			$sql = "update pre_weibo_user_stat set dymic_count=dymic_count+1, 
						last_publish_time='$date_sql',
					img_attachment_count=img_attachment_count+".count($img_arr).",
					vedio_attachment_count=vedio_attachment_count+".count($vedio_arr).",
					music_attachment_count=music_attachment_count+".count($music_arr)."
					 where uid='$uid'
					";
			$dblink->query($sql);
		}
		$dblink->dbclose();
		return getR(true,$msg_id);
	}
	
	/**
	 * 对某条动态进行回复
	 * @param unknown_type $uid			回复人的UID
	 * @param unknown_type $nicename	回复人的昵称
	 * @param unknown_type $msg_id		回复的消息ID
	 * @param unknown_type $msg			回复的消息
	 * @param $datetime 发送时间
	 * @param $ip 发送IP
	 * return	成功返回true,失败返回false
	 */
	static public function replyMsg($uid,$nicename,$msg_id,$msg,$datetime=false,$ip=false)
	{
		if(empty($uid))
			return getR(false,"UID异常");
		if(empty($nicename))
			return getR(false,"昵称不能为空");
		if(!is_numeric($uid))
			return getR(false,"UID必须是数字");
		if(empty($msg_id) || !is_numeric($msg_id))
			return getR(false,"msg_id异常");
		
		if($datetime===false)
			$datetime = getLocalTimeStr(time());
		if($ip===false)
			$ip = getIp();
		$dblink = new DataBase("");
		//if (get_magic_quotes_gpc()==0) 
			$msg = Weibo::process_injection($msg);
			//$msg = mysql_real_escape_string($msg);
		//入表 pre_weibo_msg msg_type=2 reply_parent_msg_id=$msg_id
		$dblink->query("INSERT INTO `pre_weibo_msg` (`uid`,`nicename`,`msg`,`msg_type`,`reply_parent_msg_id`,
				`route_parent_msg_id`,`route_count`,`reply_count`,`attachment_img_count`,
				`attachment_vedio_count`,`attachment_music_count`,append_time,ip) values 
				('$uid','$nicename','$msg','2',
				'$msg_id','0','0','0','0','0','0','$datetime','$ip')");
		$reply_msg_id = $dblink->get_id();
		//根据$msg_id获得消息主人的uid=>msg_uid.
		$sql = "SELECT `id`,`uid`,`nicename` FROM `pre_weibo_msg` WHERE id='$msg_id'";
		$dbarr = $dblink->getRow($sql);
		if (count($dbarr)>0)
		{
			//修改表pre_weibo_msg，设置$msg_id的reply_count+1
			$dblink->query("update pre_weibo_msg set reply_count=reply_count+1 where id='$msg_id'");
			//对pre_weibo_user_stat进行处理
			//如果`pre_weibo_user_stat`中没有msg_uid则新增，否则修改
			//修改msg_uid的pre_weibo_user_stat的is_replyd_count+1
			$sql = "SELECT uid FROM `pre_weibo_user_stat` WHERE uid='".$dbarr[0]["uid"]."'";
			$user_arr = $dblink->getRow($sql);
			if(count($user_arr)>0)
			{
				$dblink->query("update pre_weibo_user_stat set is_replyd_count=is_replyd_count+1 where uid='".$dbarr[0]["uid"]."'");
			}
			else 
			{
				$dblink->query("insert into pre_weibo_user_stat (`uid`,`is_watched_count`,`watch_count`,
						`transmit_count`,`is_transmitd_count`,`reply_count`,`is_replyd_count`,
						`signature`) values ('".$dbarr[0]["uid"]."','0','0','0','0','0','1','')");
			}
		}
		
		//修改uid的pre_weibo_user_stat的reply_count+1
		$sql = "SELECT uid FROM `pre_weibo_user_stat` WHERE uid='$uid'";
		$user_arr = $dblink->getRow($sql);
		if(count($user_arr)>0)
		{
			$dblink->query("update pre_weibo_user_stat set reply_count=reply_count+1,last_publish_time='$datetime' where uid='$uid'");
		}
		else
		{
			$dblink->query("insert into pre_weibo_user_stat (`uid`,`is_watched_count`,`watch_count`,
					`transmit_count`,`is_transmitd_count`,`reply_count`,`is_replyd_count`,
					`signature`,last_publish_time) values ('$uid','0','0','0','0','1','0','','$datetime')");
		}
		$dblink->dbclose();
		return getR(true,$reply_msg_id);
	}
	
	
	/**
	 * 转发消息
	 * 
	 * @param int $uid							转发人的UID
	 * @param string $nicename					转发人的昵称
	 * @param int $reply_msg_id					回复的消息ID
	 * 											比如：a转b，c转a c的$reply_msg_id是a
	 * 											c的内容就是$msg+a的$msg
	 * @param int $retransmit_msg_id			转发的消息ID
	 * 											注意：转发的消息ID是最开始的消息，比如a转b，c转a，c的$msg_id是a的ID
	 * @param string $msg						消息体
	 * @param $datetime 						发送时间
	 * @param $ip 								发送IP 
	 * return	成功返回true,失败返回false
	 * remark	转发消息的格式是类似于aaa:hello//@bbb:msgb//@ccc:msgc
	 * 			在层层转发的过程中，数据库中实际存储的是类似于
	 * 			{"uid":1,"nicename":"aa"}hello{"uid":2,"nicename":"bbb"}msgb{"uid":3,"nicename":"ccc"}msgc
	 * 			这样的格式，如果有新的转发，则在头部增加就可以了
	 * 			当在前台展示的时候，替换成类似与:
	 * 			<a onclick='click(1)' onmouseover='over(1)'>aa</a>:hello//<a onclick='click(2)' onmouseover='over(2)'>@bb</a>:msgb
	 * 			点击和鼠标移上去的动作可以由js异步完成
	 */
	static public function retransmitMsg($uid,$nicename,$reply_msg_id,$retransmit_msg_id,$msg,
			$datetime=false,$ip=false)
	{
		if(empty($uid))
			return getR(false,"UID异常");
		$dblink = new DataBase("");
		//对消息体进行处理
		$msg = str_replace("{", "&#123;", $msg);
		$msg = str_replace("}", "&#125;", $msg);
		//$arr = array("uid"=>$uid,"nicename"=>$nicename);
		//根据$reply_msg_id获得回复的内容
		//如果$retransmit_msg_id == $reply_msg_id，说明是第一次转发
		if($retransmit_msg_id != $reply_msg_id)
		{
			$sql = "select `uid`,`nicename`,`msg` from `pre_weibo_msg` where id='$reply_msg_id'";
			$dbarr = $dblink->getRow($sql);
			if(count($dbarr)>0)
			{
				$arr = array("uid"=>$dbarr[0]["uid"],"nicename"=>urlencode($dbarr[0]["nicename"]));
				$msg .= json_encode($arr).$dbarr[0]["msg"];
			}
		}
		if($datetime===false)
			$datetime = getLocalTimeStr(time());
		if($ip===false)
			$ip = getIp();
		//入表 pre_weibo_msg msg_type=3 route_parent_msg_id=$retransmit_msg_id
		$dblink->query("INSERT INTO `pre_weibo_msg` (`uid`,`nicename`,`msg`,`msg_type`,`reply_parent_msg_id`,
				`route_parent_msg_id`,`route_count`,`reply_count`,`attachment_img_count`,
				`attachment_vedio_count`,`attachment_music_count`,append_time,ip) values ('$uid','$nicename','$msg','3',
				'$reply_msg_id','$retransmit_msg_id','0','0','0','0','0','$datetime','$ip')");
		//$msg_id = $dblink->get_id();
		//根据$retransmit_msg_id获得被转发原始消息主人的uid
		$sql = "select uid,nicename from pre_weibo_msg where id='$retransmit_msg_id'";
		$beRetransmitUserInfoArr = $dblink->getRow($sql);
		//修改表pre_weibo_msg，设置$retransmit_msg_id的route_count+1
		if(count($beRetransmitUserInfoArr)>0)
		{
			$dblink->query("update pre_weibo_msg set route_count=route_count+1 where id='$retransmit_msg_id'");
			//对pre_weibo_user_stat进行处理
			//如果`pre_weibo_user_stat`中没有msg_uid则新增，否则修改
			//修改msg_uid的pre_weibo_user_stat的is_transmitd_count+1
			$sql = "SELECT uid FROM `pre_weibo_user_stat` WHERE uid='".$beRetransmitUserInfoArr[0]["uid"]."'";
			$tmp_arr = $dblink->getRow($sql);
			if(count($tmp_arr)>0)
			{
				$dblink->query("update pre_weibo_user_stat set is_transmitd_count=is_transmitd_count+1 where uid='".$beRetransmitUserInfoArr[0]["uid"]."'");
			}
			else 
			{
				$dblink->query("insert into pre_weibo_user_stat (uid,`is_watched_count`,`watch_count`,
						`transmit_count`,`is_transmitd_count`,`reply_count`,
						`is_replyd_count`,`signature`) values ('".$beRetransmitUserInfoArr[0]["uid"]."','0','0','0','1','0','0','')");
			}
		}
		//修改uid的pre_weibo_user_stat的transmitd_count+1
		$sql = "SELECT uid FROM `pre_weibo_user_stat` WHERE uid='$uid'";
		$tmp_arr = $dblink->getRow($sql);
		if(count($tmp_arr)>0)
		{
			$dblink->query("update pre_weibo_user_stat set transmit_count=transmit_count+1,
					last_publish_time='$datetime' where uid='$uid'");
		}
		else
		{
			$dblink->query("insert into pre_weibo_user_stat (uid,`is_watched_count`,`watch_count`,
					`transmit_count`,`is_transmitd_count`,`reply_count`,
					`is_replyd_count`,`signature`,last_publish_time) values ('$uid','0','0','1','0','0','0','','$datetime')");
		}
		
		//根据$reply_msg_id获得被转发上一级消息的主人相关信息
		if($reply_msg_id!=$retransmit_msg_id)
		{
			$sql = "select uid,nicename from pre_weibo_msg where id='$reply_msg_id'";
			$beParentRetransmitUserInfoArr = $dblink->getRow($sql);
			if(count($beParentRetransmitUserInfoArr)>0)
			{
				//因为是转发，因此被转发的上一级消息的转发数也要加1
				$dblink->query("update pre_weibo_msg set route_count=route_count+1 where id='$reply_msg_id'");
				//对pre_weibo_user_stat进行处理，增加上一级消息主人的is_transmitd_count(被转发消息数)
				$sql = "SELECT uid FROM `pre_weibo_user_stat` WHERE uid='".$beParentRetransmitUserInfoArr[0]["uid"]."'";
				$tmp_arr = $dblink->getRow($sql);
				if(count($tmp_arr)>0)
				{
					$dblink->query("update pre_weibo_user_stat set is_transmitd_count=is_transmitd_count+1 where uid='".$beParentRetransmitUserInfoArr[0]["uid"]."'");
				}
				else
				{
					$dblink->query("insert into pre_weibo_user_stat (uid,`is_watched_count`,`watch_count`,
							`transmit_count`,`is_transmitd_count`,`reply_count`,
							`is_replyd_count`,`signature`) values ('".$beParentRetransmitUserInfoArr[0]["uid"]."','0','0','0','1','0','0','')");
				}
			}
		}
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 获得某条动态的所有回复信息
	 * @param unknown_type $msg_id	消息ID
	 * reuturn		失败返回false(checkErr判断)，成功返回array(n)
	 * 				id 消息ID
	 * 				uid 发送消息的UID
	 * 				nicename 发送消息的昵称
	 * 				msg		消息体
	 * 				append_time 消息发布的时间
	 * 				head_img_url 发送消息者的头像
	 */
	static public function getFullMsgReply($msg_id)
	{
		if(!is_numeric($msg_id) || $msg_id<0)
			return getR(false,"msg_id异常");
		$dblink = new DataBase("");
		$sql = "SELECT `id`,`uid`,`nicename`,`msg`,`append_time` 
				FROM `pre_weibo_msg` 
				WHERE msg_type='2' AND reply_parent_msg_id='$msg_id'
				order by append_time desc";
		$dbarr = $dblink->getRow($sql);
		for($i=0;$i<count($dbarr);$i++)
		{
			$dbarr[$i]["head_img_url"] = getLiveHead($dbarr[$i]["uid"],"small");
			$dbarr[$i]["msg1"] = Weibo::process_injection($dbarr[$i]["msg"]);
			
			$dbarr[$i]["msg"] = Weibo::process_face($dbarr[$i]["msg"]);
			//$dbarr[$i]["msg1"] = str_replace("\"", "&quot;", $dbarr[$i]["msg"]);
		}
		$dblink->dbclose();
		return $dbarr;
	}
	
	/**
	 * 获得某用户的所有动态
	 * @param unknown_type $uid					用户ID
	 * @param unknown_type $current_page		当前页
	 * @param unknown_type $record_per_page		每页记录数
	 * @param unknown_type $lastMsgId           当前页最后的MSGID,用于翻页
	 * 											在翻页时可以利用where列的索引
	 * 											使翻页的速度很快
	 * @param int          $group_id            分组ID，默认为0，如果大于0，则
	 * 											返回当前分组下的动态
	 * remark	包括自己发的动态、自己的转发、关注人发的动态、关注人发的转发
	 * return	失败返回(checkErr判断)，成功返回array(n)
	 * 			id	消息ID
	 * 			uid	消息所属用户的用户ID
	 * 			nicename 消息所属用户的昵称
	 * 			msg			消息体
	 * 			msg_type	消息类型  1,动态；2,回复；3:转发
	 * 			append_time	消息发布的时间
	 * 			route_count	转发数
	 * 			reply_count	回复数
	 * 			is_del		是否被删除 1:被删除；0:没有被删除
	 * 			route_parent_msg_id 转发的是哪条消息
	 * 			attachment_img_count 图片附件数量
	 * 			attachment_vedio_count 视频附件数量
	 * 			attachment_music_count	音频附件数量
	 * 			head_img_url	头像
	 * 			attachment		附件 (数组(n))
	 * 				id	附件	ID
	 * 				type	附件类型
	 * 				url  附件URL
	 * 			["route_msg"]["msginfo"] 转发信息(数组(1))
	 * 				id		信息ID
	 * 				uid		用户ID
	 * 				nicename 用户昵称
	 * 				msg		消息体
	 *				append_time 增加时间
	 *				route_count  转发数
	 *				reply_count  回复数
	 *				`attachment_img_count`,`attachment_vedio_count`,`attachment_music_count` 
	 *		   ["route_msg"]["attachment"] 转发信息的附件(数组(n))
	 *		   		id	附件	ID
	 * 				type	附件类型
	 * 				url  附件URL
	 * 				
	 */
	static public function getUserAllMsg($uid,$current_page=1,
			$record_per_page=20,$lastMsgId=0,$group_id=0)
	{
		if(empty($uid) || !is_numeric($uid) || $uid<1)
			return getR(false,"uid格式错误");
		$dblink = new DataBase("");
		
		if($group_id==0)
		{//查找所有关注人的uid
			$sql = "SELECT dst_uid FROM `pre_weibo_follow` WHERE src_uid='$uid'";
			$follow_user_arr = $dblink->getRow($sql);
			$sql_in = "'$uid'";
			if(count($follow_user_arr)>0)
			{
				for($i=0;$i<count($follow_user_arr);$i++)
				{
					$sql_in .= ",'".$follow_user_arr[$i]["dst_uid"]."'";
				}
			}
		}
		else 
		{//查找某分组下的所有用户发的微博
			$sql = "SELECT uid FROM pre_weibo_group_info 
						WHERE group_id='$group_id'";
			$follow_user_arr = $dblink->getRow($sql);
			$sql_in = "";
			if(count($follow_user_arr)>0)
			{
				for($i=0;$i<count($follow_user_arr);$i++)
				{
					$sql_in .= ",'".$follow_user_arr[$i]["uid"]."'";
				}
			}
			$sql_in = trim($sql_in,",");
		}
		if($lastMsgId==0)
			$wheresql = "";
		else
		{
			//$date_sql = "SELECT append_time FROM pre_weibo_msg 
			//				WHERE id='$lastMsgId'";
			//$time_arr = $dblink->getRow($date_sql);
			//if(count($time_arr)>0)
				$wheresql = "and id<'$lastMsgId'";
			//else
			//	$wheresql = "";
		}
		/*
		$sql = "SELECT `id`,`uid`,`nicename`,msg_type,`msg`,`append_time`,`route_count`,`reply_count`,
			`route_parent_msg_id`,reply_parent_msg_id,is_del,
			`attachment_img_count`,`attachment_vedio_count`,`attachment_music_count` 
			FROM `pre_weibo_msg` WHERE (msg_type='1' or msg_type='3') AND uid in ($sql_in) 
			order by append_time desc,id desc
			limit ".($current_page-1)*$record_per_page.",$record_per_page";
		*/
		$sql = "SELECT `id`,`uid`,`nicename`,msg_type,`msg`,`append_time`,
					`route_count`,`reply_count`,
					`route_parent_msg_id`,reply_parent_msg_id,is_del,
					`attachment_img_count`,`attachment_vedio_count`,
					`attachment_music_count`
				FROM `pre_weibo_msg` WHERE (msg_type='1' or msg_type='3') 
					AND uid in ($sql_in) $wheresql
				order by append_time desc,id desc
				limit $record_per_page";
		$dbarr = $dblink->getRow($sql);
		$count = count($dbarr);
		for($i=0;$i<$count;$i++)
		{
			//头像
			$dbarr[$i]["head_img_url"] = getLiveHead($dbarr[$i]["uid"],"small");
			if($dbarr[$i]["is_del"]==1)
			{
				$dbarr[$i]["msg"] = "";
				$dbarr[$i]["route_msg"]["msginfo"] = array();
				continue;
			}
			$dbarr[$i]["msg"] = Weibo::process_face($dbarr[$i]["msg"]);
			//消息处理
			if($dbarr[$i]["msg_type"] == 3)
			{
				//$tmp_arr["uid"] = $dbarr[$i]["uid"];
				//$tmp_arr["nicename"] = $dbarr[$i]["nicename"];
				if($dbarr[$i]["route_parent_msg_id"] != $dbarr[$i]["reply_parent_msg_id"])
				{
					$pos = strpos($dbarr[$i]["msg"],"{");
					$msg_start = substr($dbarr[$i]["msg"], 0,$pos);
					$msg_end = substr($dbarr[$i]["msg"], $pos);
					//var_dump($msg_start);die();
					$dbarr[$i]["msg"] = $msg_start.Weibo::process_msg($msg_end);
				}
				
				//$dbarr[$i]["msg"] = Weibo::process_msg(json_encode($tmp_arr).$dbarr[$i]["msg"]);
			}
			//$dbarr[$i]["msg"] = Weibo::process_msg($dbarr[$i]["msg"]);
			
			//附件
			if($dbarr[$i]["attachment_img_count"] >0 ||
					$dbarr[$i]["attachment_vedio_count"] >0 ||
					$dbarr[$i]["attachment_music_count"] >0)
			{
				$tmp_arr = $dblink->getRow("SELECT id,type,url FROM `pre_weibo_attachment` WHERE msg_id='".$dbarr[$i]["id"]."' order by `type` asc");
				$tmp_arr = Weibo::processAttachmentArr($tmp_arr);
				$dbarr[$i]["attachment"] = $tmp_arr;
			}
			//转发
			if(!empty($dbarr[$i]["route_parent_msg_id"]))
			{
				$tmp_arr = $dblink->getRow("SELECT `id`,`uid`,`nicename`,`msg`,`append_time`,
					`route_count`,`reply_count`,`route_parent_msg_id`,is_del,
					`attachment_img_count`,`attachment_vedio_count`,`attachment_music_count` 
					FROM `pre_weibo_msg` WHERE id='".$dbarr[$i]["route_parent_msg_id"]."'");
				$tmp_arr[0]["head_img_url"] = getLiveHead($tmp_arr[0]["uid"],"small");
				if($tmp_arr[0]["is_del"]==1)
				{
					$dbarr[$i]["route_msg"]["msginfo"] = array();
				}
				else 
				{
					$tmp_arr[0]["msg"] = Weibo::process_face($tmp_arr[0]["msg"]);
					$dbarr[$i]["route_msg"]["msginfo"] = $tmp_arr;
					//附件
					if($tmp_arr[0]["attachment_img_count"] >0 ||
							$tmp_arr[0]["attachment_vedio_count"] >0 ||
							$tmp_arr[0]["attachment_music_count"] >0)
					{
						$attment_arr = $dblink->getRow("SELECT id,type,url FROM `pre_weibo_attachment` WHERE msg_id='".$tmp_arr[0]["id"]."' order by `type` asc");
						$attment_arr = Weibo::processAttachmentArr($attment_arr);
						$dbarr[$i]["route_msg"]["attachment"] = $attment_arr;
					}
				}
			}
		}
		$dblink->dbclose();
		return $dbarr;
	}
	
	
	/**
	 * 在前端获得所有的消息
	 * @param unknown_type $lastMsgId		   最后一个消息ID
	 * @param unknown_type $record_per_page  每页记录数
	 */
	static public function getSysAllMsgFront($lastMsgId=0,$record_per_page=20)
	{
		if(!is_numeric($lastMsgId) || $lastMsgId<0)
			return getR(false,"lastMsgId格式错误");
		if(empty($record_per_page) || !is_numeric($record_per_page) 
				|| $record_per_page<1)
			return getR(false,"record_per_page格式错误");
		$dblink = new DataBase("");
	
	
		if($lastMsgId==0)
			$wheresql = "";
		else
			$wheresql = "and id<'$lastMsgId'";

			$sql = "SELECT `id`,`uid`,`nicename`,msg_type,`msg`,`append_time`,
						`route_count`,`reply_count`,
						`route_parent_msg_id`,reply_parent_msg_id,is_del,
						`attachment_img_count`,`attachment_vedio_count`,
						`attachment_music_count`
					FROM `pre_weibo_msg` WHERE (msg_type='1' or msg_type='3')
						AND 1=1  $wheresql
					order by append_time desc,id desc
					limit $record_per_page";
			$dbarr = $dblink->getRow($sql);
			$count = count($dbarr);
			for($i=0;$i<$count;$i++)
			{
					//头像
				$dbarr[$i]["head_img_url"] = getLiveHead($dbarr[$i]["uid"],"small");
				if($dbarr[$i]["is_del"]==1)
				{
					$dbarr[$i]["msg"] = "";
					$dbarr[$i]["route_msg"]["msginfo"] = array();
					continue;
				}
				$dbarr[$i]["msg"] = Weibo::process_face($dbarr[$i]["msg"]);
				//消息处理
				if($dbarr[$i]["msg_type"] == 3)
				{
						//$tmp_arr["uid"] = $dbarr[$i]["uid"];
						//$tmp_arr["nicename"] = $dbarr[$i]["nicename"];
					if($dbarr[$i]["route_parent_msg_id"] != $dbarr[$i]["reply_parent_msg_id"])
					{
						$pos = strpos($dbarr[$i]["msg"],"{");
						$msg_start = substr($dbarr[$i]["msg"], 0,$pos);
						$msg_end = substr($dbarr[$i]["msg"], $pos);
							//var_dump($msg_start);die();
						$dbarr[$i]["msg"] = $msg_start.Weibo::process_msg($msg_end);
					}
	
						//$dbarr[$i]["msg"] = Weibo::process_msg(json_encode($tmp_arr).$dbarr[$i]["msg"]);
				}
					//$dbarr[$i]["msg"] = Weibo::process_msg($dbarr[$i]["msg"]);
						
					//附件
					if($dbarr[$i]["attachment_img_count"] >0 ||
							$dbarr[$i]["attachment_vedio_count"] >0 ||
							$dbarr[$i]["attachment_music_count"] >0)
					{
						$tmp_arr = $dblink->getRow("SELECT id,type,url FROM `pre_weibo_attachment` WHERE msg_id='".$dbarr[$i]["id"]."' order by `type` asc");
						$tmp_arr = Weibo::processAttachmentArr($tmp_arr);
						$dbarr[$i]["attachment"] = $tmp_arr;
					}
					//转发
					if(!empty($dbarr[$i]["route_parent_msg_id"]))
					{
						$tmp_arr = $dblink->getRow("SELECT `id`,`uid`,`nicename`,`msg`,`append_time`,
								`route_count`,`reply_count`,`route_parent_msg_id`,is_del,
								`attachment_img_count`,`attachment_vedio_count`,`attachment_music_count`
								FROM `pre_weibo_msg` WHERE id='".$dbarr[$i]["route_parent_msg_id"]."'");
						$tmp_arr[0]["head_img_url"] = getLiveHead($tmp_arr[0]["uid"],"small");
						if($tmp_arr[0]["is_del"]==1)
						{
							$dbarr[$i]["route_msg"]["msginfo"] = array();
						}
						else
						{
							$tmp_arr[0]["msg"] = Weibo::process_face($tmp_arr[0]["msg"]);
							$dbarr[$i]["route_msg"]["msginfo"] = $tmp_arr;
							//附件
							if($tmp_arr[0]["attachment_img_count"] >0 ||
									$tmp_arr[0]["attachment_vedio_count"] >0 ||
									$tmp_arr[0]["attachment_music_count"] >0)
							{
								$attment_arr = $dblink->getRow("SELECT id,type,url FROM `pre_weibo_attachment` WHERE msg_id='".$tmp_arr[0]["id"]."' order by `type` asc");
								$attment_arr = Weibo::processAttachmentArr($attment_arr);
								$dbarr[$i]["route_msg"]["attachment"] = $attment_arr;
							}
						}
					}
					}
					$dblink->dbclose();
					return $dbarr;
	}
	
	/**
	 * 对一个附件数据进行若干处理
	 * @param unknown_type $tmparr
	 * @return 返回后
	 */
	static public function processAttachmentArr($tmp_arr)
	{
		for($k=0;$k<count($tmp_arr);$k++)
		{
			//var_dump($tmp_arr[$k]["url"]);
			//var_dump(file_exists($_SERVER['DOCUMENT_ROOT'].$tmp_arr[$k]["url"]));
			if($tmp_arr[$k]["type"] == '1'
				&& strstr($tmp_arr[$k]["url"], "http://")===false
				&& !file_exists($_SERVER['DOCUMENT_ROOT'].$tmp_arr[$k]["url"]))
			{
				$tmp_arr[$k]["url"] = "/huoshow/img/weibo/noimg.jpg";
				$tmp_arr[$k]["small_url"] = "/huoshow/img/weibo/noimg.jpg";
				continue;
			}
			if($tmp_arr[$k]["type"] == '1'
				&& strstr($tmp_arr[$k]["url"], "http://")===false)
			{
				$point = strrpos($tmp_arr[$k]["url"], ".");
				$start = substr($tmp_arr[$k]["url"], 0,$point);
				$end = substr($tmp_arr[$k]["url"], $point);
				$tmp_arr[$k]["small_url"] = $start."_small".$end;
			}
			else
				$tmp_arr[$k]["small_url"] = $tmp_arr[$k]["url"];
		}
		return $tmp_arr;
	}
	
	/**
	 * 获得某用户的所有动态
	 * @param unknown_type $uid
	 * @param unknown_type $current_page
	 * @param unknown_type $record_per_page
	 * @param unknown_type $lastMsgId           当前页最后的MSGID,用于翻页
	 * 											在翻页时可以利用where列的索引
	 * 											使翻页的速度很快
	 * remark 类似getUserAllMsg获得自己的动态、自己转发的动态
	 */
	static public function getUserSelfMsg($uid,$current_page=1,
			$record_per_page=20,$lastMsgId=0)
	{
		if(empty($uid) || !is_numeric($uid) || $uid<1)
			return getR(false,"uid格式错误");
		if($lastMsgId==0)
			$wheresql = "";
		else
			$wheresql = "and id<'$lastMsgId'";
		$dblink = new DataBase("");
/*
		$sql = "SELECT `id`,`uid`,`nicename`,msg_type,`msg`,`append_time`,`route_count`,`reply_count`,
		`route_parent_msg_id`,reply_parent_msg_id,is_del,
		`attachment_img_count`,`attachment_vedio_count`,`attachment_music_count`
		FROM `pre_weibo_msg` WHERE (msg_type='1' or msg_type='3') AND uid='$uid' order by append_time desc,id desc limit ".($current_page-1)*$record_per_page.",$record_per_page";
		*/
		$sql = "SELECT `id`,`uid`,`nicename`,msg_type,`msg`,
					`append_time`,`route_count`,`reply_count`,
					`route_parent_msg_id`,reply_parent_msg_id,is_del,
					`attachment_img_count`,`attachment_vedio_count`,
					`attachment_music_count`
				FROM `pre_weibo_msg` WHERE (msg_type='1' or msg_type='3') 
					AND uid='$uid' $wheresql
				order by append_time desc,id desc 
				limit $record_per_page";
		$dbarr = $dblink->getRow($sql);
		$count = count($dbarr);
		for($i = 0; $i < $count; $i ++) {
			$dbarr [$i] ["head_img_url"] = getLiveHead( $dbarr [$i] ["uid"], "small" );
			if($dbarr[$i]["is_del"]==1)
			{
				$dbarr[$i]["msg"] = "";
				$dbarr[$i]["route_msg"]["msginfo"] = array();
				continue;
			}
			// 消息处理
			$dbarr[$i]["msg"] = Weibo::process_face($dbarr[$i]["msg"]);
			if ($dbarr [$i] ["msg_type"] == 3) {
				// $tmp_arr["uid"] = $dbarr[$i]["uid"];
				// $tmp_arr["nicename"] = $dbarr[$i]["nicename"];
				if ($dbarr [$i] ["route_parent_msg_id"] != $dbarr [$i] ["reply_parent_msg_id"]) {
					$pos = strpos ( $dbarr [$i] ["msg"], "{" );
					$msg_start = substr ( $dbarr [$i] ["msg"], 0, $pos );
					$msg_end = substr ( $dbarr [$i] ["msg"], $pos );
					// var_dump($msg_start);die();
					$dbarr [$i] ["msg"] = $msg_start . Weibo::process_msg ( $msg_end );
				}
				
				// $dbarr[$i]["msg"] =
			// Weibo::process_msg(json_encode($tmp_arr).$dbarr[$i]["msg"]);
			}
			// $dbarr[$i]["msg"] = Weibo::process_msg($dbarr[$i]["msg"]);
			// 头像
			
			// 附件
			if ($dbarr [$i] ["attachment_img_count"] > 0 || $dbarr [$i] ["attachment_vedio_count"] > 0 || $dbarr [$i] ["attachment_music_count"] > 0) {
				$tmp_arr = $dblink->getRow ( "SELECT id,type,url FROM `pre_weibo_attachment` WHERE msg_id='" . $dbarr [$i] ["id"] . "' order by `type` asc" );
				$tmp_arr = Weibo::processAttachmentArr($tmp_arr);
			
				$dbarr [$i] ["attachment"] = $tmp_arr;
			}
			// 转发
			if (! empty ( $dbarr [$i] ["route_parent_msg_id"] )) 
			{
				$tmp_arr = $dblink->getRow ( "SELECT `id`,`uid`,`nicename`,`msg`,`append_time`,
			`route_count`,`reply_count`,`route_parent_msg_id`,is_del,
			`attachment_img_count`,`attachment_vedio_count`,`attachment_music_count`
			FROM `pre_weibo_msg` WHERE id='" . $dbarr [$i] ["route_parent_msg_id"] . "'" );
				$tmp_arr[0]["head_img_url"] = getLiveHead($tmp_arr[0]["uid"],"small");
				if($tmp_arr[0]["is_del"]==1)
				{
					$dbarr [$i] ["route_msg"] ["msginfo"] = array();
				}
				else
				{
					$tmp_arr[0]["msg"] = Weibo::process_face($tmp_arr[0]["msg"]);
					$dbarr [$i] ["route_msg"] ["msginfo"] = $tmp_arr;
					// 附件
					
					if ($tmp_arr [0] ["attachment_img_count"] > 0 || 
							$tmp_arr [0] ["attachment_vedio_count"] > 0 || 
							$tmp_arr [0] ["attachment_music_count"] > 0) 
					{
						$attment_arr = $dblink->getRow ( "SELECT id,type,url FROM `pre_weibo_attachment` WHERE msg_id='" . $tmp_arr [0] ["id"] . "' order by `type` asc" );
						$attment_arr = Weibo::processAttachmentArr($attment_arr);
						$dbarr [$i] ["route_msg"] ["attachment"] = $attment_arr;
					}
				}
				
			}
		}
		$dblink->dbclose ();
		return $dbarr;
	}
	
	/**
	 * 对消息体进行处理,把消息体中的{}转换为链接形式
	 * @param unknown_type $msg	待处理的原始消息
	 * return	成功返回处理后的消息，失败返回false
	 * remark	由于火秀的昵称是可以不唯一的，而在消息正文中，需要用户可以点击@昵称 
	 * 			因此需要做特殊处理
	 * 			对于用户(@昵称)地方在数据库中有json存储，保存昵称和UID
	 * 			消息体中的{}分别用&#123;  &#125（这样，消息体中的{}就代表是json数据）; 表示, 
	 * 			从数据取出后，直接把所有json数据替换为需要的格式。
	 */
	static public function process_msg($msg)
	{
		//$arr = preg_split("/(\{[^{]*\})([^{^}]*)/",  trim($msg));
		//$str = "<img width=\"24\" height=\"24\" src=\"/static2/images/face/face$1.gif\">";
		//$msg = preg_replace("/\[([\d]+)\]/i", $str, $msg);
		//var_dump($msg);
		preg_match_all("/(\{[^{]*\})([^{^}]*)/",  trim($msg),$arr);
		
		//var_dump($arr);
		$count = count($arr[1]);
		$num = 0;
		$retuanV = "";
		if(count($arr[1])==0)
			return $msg;
		for($i=0;$i<$count;$i++)
		{
			$tmp_arr = json_decode($arr[1][$i],true);
			//if ($i==0)
			//	$value = "<a href='javascript:void();' onclick='hs_wb_click(".$tmp_arr["uid"].")' onmouseover='hs_wb_over(".$tmp_arr["uid"].")'>".$tmp_arr["nicename"]."</a>:".$arr[2][$i];
			//else
			    $value = "//<a href='javascript:void();' onclick='hs_wb_click(".$tmp_arr["uid"].")' onmouseover='hs_wb_over(".$tmp_arr["uid"].")'>@".urldecode($tmp_arr["nicename"])."</a>:".$arr[2][$i];
			
			$retuanV .= $value;
		}
		return $retuanV;
	}
	
	static public function process_injection($msg)
	{
		$msg_arr = preg_split('|(\{[^\}]*\})|',$msg,-1,PREG_SPLIT_DELIM_CAPTURE);
		$msg = "";
		for($i=0;$i<count($msg_arr);$i++)
		{
			if(strpos($msg_arr[$i], "{")===false)
			{
				$msg .= Weibo::process_injection_real($msg_arr[$i]);
			}
			else
			{
				$msg .= $msg_arr[$i];
			}
		}
		
		return $msg;
	}
	
	static public function process_injection_real($msg)
	{
		$msg = str_replace("\"", "&quot;", $msg);
		$msg = str_replace("'", "&acute;", $msg);
		$msg = str_replace('<', '&lt;', $msg);
		$msg = str_replace('>', '&gt;', $msg);
		return $msg;
	}
	
	/**
	 * 对消息正文中的表情进行处理
	 * @param unknown_type $msg	消息体
	 * @return mixed
	 */
	static public function process_face($msg)
	{
		$msg = Weibo::process_injection($msg);
		$str = "<img width=\"24\" height=\"24\" src=\"/static2/images/face/face$1.gif\">";
		$msg = preg_replace("/\[([\d]+)\]/i", $str, $msg);
		return $msg;
		
	}
	
	/**
	 * 对文本中的{ } 进行处理
	 * @param unknown_type $msg
	 */
	static public function processBrackets($msg)
	{
		$msg = str_replace("{", "&#123;", $msg);
		$msg = str_replace("}", "&#125;", $msg);
		
		return $msg;
	}
	
	/**
	 * 关注某人
	 * @param unknown_type $src_uid		源用户
	 * @param unknown_type $dst_uid		目标用户
	 */
	static public function followUser($src_uid,$dst_uid,$date=false)
	{
		if(empty($src_uid))
			return getR(false,"源UID异常");
		if(!is_numeric($src_uid))
			return getR(false,"源UID必须是数字");
		if(empty($dst_uid))
			return getR(false,"目标UID异常");
		if(!is_numeric($dst_uid))
			return getR(false,"目标UID必须是数字");
		if($src_uid==$dst_uid)
			return getR(false,"用户不能关注自己");
		$dblink =new DataBase("");
		$sql = "SELECT id FROM pre_weibo_follow 
				WHERE src_uid='$src_uid' AND dst_uid='$dst_uid'";
		$dbarr = $dblink->getRow($sql);
		if(count($dbarr)>0)
			return getR(false,"已经关注了该用户");
		if(!$date)
			$date = getLocalTimeStr(time());
		$sql = "INSERT INTO `pre_weibo_follow` (`src_uid`,`dst_uid`,
					`follow_date`) 
				VALUES ('$src_uid','$dst_uid','$date')";
		$dblink->query($sql);
		//用户统计表中源用户的关注数+1
		$sql = "SELECT `uid` FROM `pre_weibo_user_stat` WHERE uid='$src_uid' limit 0,1";
		$dbarr = $dblink->getRow($sql);
		if(count($dbarr)>0)
			$dblink->query("update pre_weibo_user_stat set watch_count=watch_count+1 where uid='$src_uid'");
		else
			$dblink->query("insert into pre_weibo_user_stat
					(`uid`,`is_watched_count`,`watch_count`,`transmit_count`,`is_transmitd_count`,`reply_count`,`is_replyd_count`,`signature`) 
					values ('$src_uid','0','1','0','0','0','0','')");
		
		//用户统计表中目标用户的被关注数+1
		$sql = "SELECT `uid` FROM `pre_weibo_user_stat` WHERE uid='$dst_uid' limit 0,1";
		$dbarr = $dblink->getRow($sql);
		if(count($dbarr)>0)
			$dblink->query("update pre_weibo_user_stat set is_watched_count=is_watched_count+1 
					where uid='$dst_uid'");
		else
			$dblink->query("insert into pre_weibo_user_stat
					(`uid`,`is_watched_count`,`watch_count`,`transmit_count`,`is_transmitd_count`,`reply_count`,`is_replyd_count`,`signature`)
					values ('$dst_uid','1','0','0','0','0','0','')");
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 取消关注某人
	 * @param unknown_type $src_uid	源用户ID 自己
	 * @param unknown_type $dst_uid	目标用户ID  关注
	 */
	static public function cancelFollowUser($src_uid,$dst_uid)
	{
		if(empty($src_uid))
			return getR(false,"源UID异常");
		if(!is_numeric($src_uid))
			return getR(false,"源UID必须是数字");
		if(empty($dst_uid))
			return getR(false,"目标UID异常");
		if(!is_numeric($dst_uid))
			return getR(false,"目标UID必须是数字");
		$dblink =new DataBase("");
		$sql = "delete from pre_weibo_follow where src_uid='$src_uid' and dst_uid='$dst_uid'";
		$dblink->query($sql);
		$dblink->query("update pre_weibo_user_stat set watch_count=watch_count-1 where uid='$src_uid'");
		$dblink->query("update pre_weibo_user_stat set is_watched_count=is_watched_count-1 where uid='$dst_uid'");
		//在分组记录中删除相关信息
		Weibo::delUserFromGroup($src_uid,$dst_uid);
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 获得某用户的微博统计信息
	 * @param unknown_type $uid	用户ID
	 * reutrn 如果失败返回false(checkErr判断),如果成功返回数组(n)
	 * 		  followCount 			跟随数
	 * 		  beFollowCount			被跟随数
	 * 		  transmit_count 		转发数
	 * 		  is_transmitd_count 	被转发数
	 * 		  reply_count			回复数
	 *   	  is_replyd_count		被回复数
	 *   	  last_publish_time		最后一次发送动态或者转发的时间
	 */
	static public function getUserStatInfo($uid)
	{
		if(empty($uid) || !is_numeric($uid) || $uid<1)
			return getR(false,"uid格式错误");
		$dblink =new DataBase("");
		$dbarr = $dblink->getRow("SELECT `watch_count` AS followCount,
									`is_watched_count` AS beFollowCount,
									`transmit_count`,`is_transmitd_count`,
									`reply_count`,`is_replyd_count`,
									`dymic_count` 
								  from `pre_weibo_user_stat` 
				  				  where uid='$uid'");
		$dblink->dbclose();
		return $dbarr;
	}
	
	/**
	 * 获得用户拥有的所有分组
	 * @param unknown_type $uid
	 */
	static public function getUserGroup($uid)
	{
		if(empty($uid) || !is_numeric($uid))
			return getR(false,"UID异常");
		$dblink =new DataBase("");
		$sql = "SELECT id,group_name FROM pre_weibo_group  WHERE uid='$uid'";
		$dbarr = $dblink->getRow($sql);
		$dblink->dbclose();
		return $dbarr;
	}

	
	/**
	 * 添加分组
	 * @param  $uid	添加分组的用户ID
	 * @param  $groupname 分组名称
	 */
	static public function createGroup($uid,$groupname)
	{
		if(empty($uid) || !is_numeric($uid))
			return getR(false,"UID异常");
		if(empty($groupname))
			return getR(false,"groupname异常");
		$dblink =new DataBase("");
		$sql = "INSERT INTO `pre_weibo_group` (`uid`,`group_name`) VALUES ('$uid','$groupname')";
		$dblink->query($sql);
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 修改分组名称
	 * @param int  $group_id	待修改的组ID
	 * @param string $groupname	修改后的组名
	 * @return unknown_type
	 */
	static public function changeGroupName($group_id,$groupname)
	{
		if(empty($group_id) || !is_numeric($group_id))
			return getR(false,"group_id异常");
		if(empty($groupname))
			return getR(false,"groupname异常");
		$dblink =new DataBase("");
		$sql = "UPDATE `pre_weibo_group` SET `group_name`='$groupname' WHERE id='$group_id'";
		$dblink->query($sql);
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 删除组 
	 * @param int $group_id	希望删除的组ID
	 */
	static public function deleteGroup($group_id)
	{
		if(empty($group_id) || !is_numeric($group_id))
			return getR(false,"group_id异常");
		$dblink =new DataBase("");
		$sql = "DELETE FROM `pre_weibo_group` WHERE id='$group_id'";
		$dblink->query($sql);
		$sql = "DELETE FROM `pre_weibo_group_info` WHERE group_id='$group_id'";
		$dblink->query($sql);
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 把某用户放入到某分组中
	 * @param int $src_uid		源UID(是谁操作的)
	 * @param int $dst_uid		目标UID
	 * @param int $group_id		需要放入的组ID
	 */
	static public function putUserToGroup($src_uid,$dst_uid,$group_id)
	{
		if(empty($src_uid) || !is_numeric($src_uid))
			return getR(false,"源uid异常");
		if(empty($dst_uid) || !is_numeric($dst_uid))
			return getR(false,"目标uid异常");
		if(empty($group_id) || !is_numeric($group_id))
			return getR(false,"group_id异常");
		$dblink =new DataBase("");
		$sql = "select count(*) as num from `pre_weibo_group` WHERE id='$group_id'";
		$dbarr = $dblink->getRow($sql);
		if($dbarr[0]["num"]<=0)
			return getR(false,"不存在这个组");
		//查看$src_uid是否有关注$dst_uid
		$sql = "SELECT `id` FROM `pre_weibo_follow` 
			WHERE `src_uid`='$src_uid' AND `dst_uid`='$dst_uid' LIMIT 0,1";
		$dbarr = $dblink->getRow($sql);
		if(count($dbarr)<=0)
		{
			return getR(false,"对于没有关注的用户不能对其分组");
		}
		//删除$dst_uid在$src_uid中属于的原有组
		//每个用户在某用户的分组中只能在一个组中
		$dblink->query("DELETE FROM `pre_weibo_group_info` WHERE uid='$dst_uid' AND 
				group_id IN (SELECT id FROM `pre_weibo_group` WHERE uid='$src_uid')");
		$dblink->query("insert into pre_weibo_group_info (`uid`,`group_id`) values ('$dst_uid','$group_id')");
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 把$dst_uid从$src_uid的分组中删除
	 * @param unknown_type $src_uid	源UID
	 * @param unknown_type $dst_uid	目标UID
	 */
	static public function delUserFromGroup($src_uid,$dst_uid)
	{
		if(empty($src_uid) || !is_numeric($src_uid))
			return getR(false,"源uid异常");
		if(empty($dst_uid) || !is_numeric($dst_uid))
			return getR(false,"目标uid异常");
		$dblink =new DataBase("");
		$sql = "DELETE FROM  `pre_weibo_group_info` WHERE uid='$dst_uid' AND 
			group_id IN ( SELECT `id` FROM `pre_weibo_group` WHERE `uid`='$src_uid' )";
		$dblink->query($sql);
		$dblink->dbclose();
		
	}
	
	/**
	 * 获得某用户关注的所有用户信息
	 * @param unknown_type $uid				用户ID
	 * @param unknown_type $ordertype		排序种类
	 * 										1:按关注时间
	 * 										2:按最近更新时间
	 * 										3:按昵称首字母(去掉此功能)
	 * 										4:按粉丝数
	 * @param unknown_type $oderAD			排序方式
	 * 										asc 升序
	 * 										desc 倒序
	 * @param unknown_type $group_id		组ID，如果为0，则返回所有
	 * 										如果为-1，则返回没有分组的
	 * 										如果为-2，则返回所有互相关注的
	 * 										如果大于0，则返回某分组下的
	 * @param unknown_type $page			当前页
	 * @param unknown_type $recordPerPage	每页显示条数
	 * @param unknown_type $sourceuid		$sourceuid 如果不等于0，为用户ID，
	 * 							比如28154去107291的微博
	 * 							，这里$sourceuid==28154，$uid=107291
	 * 							返回结果中的
	 * 							isfollow代表$sourceuid是否有关注其中的任何一个粉丝
	 * 							follow代表这些粉丝中的任何用户是否有关注$sourceuid
	 * @param unknown_type $displaygroup 是否显示这些用户的分组信息，如果为true,则
	 * 									 在最终返回结果中会出现一个group_info的数组
	 * 									成员，如果这个数组为空数组，则说明没有被分组
	 * @return unknown_type 失败返回false（checkErr判断），成功返回数组(n)
	 * 		   uid 用户ID
	 * 	       nickname 昵称
	 *         beFollowCount 被关注数
	 *         head_img_url  头像
	 *         each_other_follow 是否互相关注
	 */
	static public function getUserAllFollow($uid,$group_id=0,$page=1,
			$recordPerPage=20,$ordertype=1,$oderAD='desc',$sourceuid=0,
			$displaygroup=false)
	{
		if(empty($uid) || !is_numeric($uid) || $uid<1)
			return getR(false,"uid格式错误");
		if(!is_numeric($group_id))
			return getR(false,"group_id异常");
		$dblink =new DataBase("");
		switch ($ordertype)
		{
			case 2:
				/*
				$select_sql = ",IF(ps.last_publish_time IS NULL,0,ps.last_publish_time) AS last_publish_time";
				$left_sql = "LEFT JOIN pre_weibo_user_stat ps ON a.uid=ps.uid";
				$order_sql = "last_publish_time";
				$where_sql = "";
				*/
				$select_sql = "";
				$left_sql = "";
				$order_sql = "last_publish_time";
				$where_sql = "";
				break;
			case 4:
				$select_sql = "";
				$left_sql = "";
				$order_sql = "is_watched_count";
				$where_sql = "";
				break;
			case 3:
				//按昵称的先不要
			case 1:
			default:
				$select_sql = ",pf.follow_date as follow_date";
				$left_sql = "LEFT JOIN pre_weibo_follow pf ON pf.dst_uid=a.uid";
				$order_sql = "follow_date";
				$where_sql = "AND pf.src_uid='$uid'";
				break;
		}
		if($group_id ==-2)
		{
			//获得所有互相关注的用户
			$sql = "SELECT tmp.dst_uid AS uid,tmp.each_other,
						IF(c.nickname='',c.username,c.nickname) AS nickname,
						d.watch_count,d.is_watched_count,
						d.dymic_count,d.transmit_count,
						d.last_publish_time,tmp.follow_date
 					FROM 
						(SELECT dst_uid,follow_date,
							(SELECT COUNT(*) FROM pre_weibo_follow b 
							WHERE  b.src_uid=a.dst_uid AND b.dst_uid='$uid' 
							LIMIT 1) AS each_other
 						FROM pre_weibo_follow a 
 						WHERE a.src_uid='$uid') tmp
					INNER JOIN pre_common_member c ON tmp.dst_uid=c.uid
					INNER JOIN pre_weibo_user_stat d ON tmp.dst_uid=d.uid
					WHERE tmp.each_other=1
					ORDER BY $order_sql $oderAD
					LIMIT ".($page-1)*$recordPerPage.",$recordPerPage";
		}
		elseif($group_id ==-1)
		{
			//获得$uid关注列表中所有没有分组的用户
			$sql = "SELECT a.dst_uid as uid,c.watch_count,c.is_watched_count,
						c.dymic_count,c.transmit_count,
						IF(b.nickname='',b.username,b.nickname) AS nickname,
						c.last_publish_time,a.follow_date
					FROM pre_weibo_follow a
					INNER JOIN pre_common_member b ON b.uid=a.dst_uid
					INNER JOIN pre_weibo_user_stat c ON a.dst_uid=c.uid
					WHERE a.src_uid='$uid' AND a.dst_uid NOT IN 
						(SELECT uid  FROM pre_weibo_group_info 
							WHERE  group_id IN
								(SELECT id FROM pre_weibo_group 
								WHERE uid='$uid'))
					ORDER BY $order_sql $oderAD
					LIMIT ".($page-1)*$recordPerPage.",$recordPerPage";
		}
		elseif($group_id >0)
		{
			$sql = "SELECT a.uid,a.group_id,IF(b.nickname='',b.username,b.nickname) AS nickname,
					IF(d.is_watched_count IS NULL,0,d.is_watched_count) AS is_watched_count,
					IF(d.watch_count IS NULL,0,d.watch_count) AS watch_counta,
					IF(d.transmit_count IS NULL,0,d.transmit_count) AS transmit_count,
					IF(d.is_transmitd_count IS NULL,0,d.is_transmitd_count) AS is_transmitd_count,
					IF(d.reply_count IS NULL,0,d.reply_count) AS reply_count,
					IF(d.last_publish_time IS NULL,0,d.last_publish_time) AS last_publish_time,
					IF(d.is_replyd_count IS NULL,0,d.is_replyd_count) AS is_replyd_count $select_sql
					FROM (pre_weibo_group_info a INNER JOIN pre_common_member b ON a.uid=b.uid) 
					LEFT JOIN pre_weibo_user_stat d ON a.uid=d.uid
					 $left_sql WHERE a.group_id='$group_id' $where_sql
					ORDER BY $order_sql $oderAD LIMIT ".($page-1)*$recordPerPage.",$recordPerPage";
		}
		elseif($group_id==0)
		{
			if($group_id==0 && $ordertype!=4 && $ordertype!=2)
			{
				$select_sql = "";
				$left_sql = "";
				$order_sql = "follow_date";
				$where_sql = "";
			}
			if($sourceuid==0)
			{
				$add_sql = "0 as isfollow,0 as follow";
			}
			else
			{
				$add_sql = "(SELECT COUNT(*) FROM pre_weibo_follow c
				WHERE c.dst_uid=a.dst_uid AND c.src_uid='$sourceuid'
				LIMIT 1) AS isfollow,
				(SELECT COUNT(*) FROM pre_weibo_follow d
				WHERE d.src_uid=a.dst_uid AND d.dst_uid='$sourceuid'
				LIMIT 1) AS follow";
			}
			$sql = "SELECT a.dst_uid as uid,IF(b.nickname='',b.username,b.nickname) AS nickname,
				IF(d.is_watched_count IS NULL,0,d.is_watched_count) AS is_watched_count,
				IF(d.watch_count IS NULL,0,d.watch_count) AS watch_counta,
				IF(d.transmit_count IS NULL,0,d.transmit_count) AS transmit_count,
				IF(d.is_transmitd_count IS NULL,0,d.is_transmitd_count) AS is_transmitd_count,
				IF(d.reply_count IS NULL,0,d.reply_count) AS reply_count,
				IF(d.is_replyd_count IS NULL,0,d.is_replyd_count) AS is_replyd_count,
				$add_sql,
				IF(d.last_publish_time IS NULL,0,d.last_publish_time) AS last_publish_time
				FROM (pre_weibo_follow a INNER JOIN pre_common_member b ON a.dst_uid=b.uid) 
				LEFT JOIN pre_weibo_user_stat d ON a.dst_uid=d.uid
		        $left_sql  WHERE a.src_uid='$uid' 
				ORDER BY $order_sql $oderAD  LIMIT ".($page-1)*$recordPerPage.",$recordPerPage";
		}
		$dbarr = $dblink->getRow($sql);
		$num = count($dbarr);
		$group_sql = "";
		for($i=0;$i<$num;$i++)
		{
			//if($displaygroup)
			//	$group_sql .= "'".$dbarr[$i]["uid"]."',";
			//新增加,根据用户ID获取分享
			$r = Community::getUserShare($dbarr[$i]["uid"]);
			for ($j=0;$j<count($r);$j++){
				$dbarr[$i][share_img][thumb][$j] = $r[$j]['small'];
				$dbarr[$i][share_img][s_id][$j] = $r[$j]['id'];
			}
			$dbarr[$i]["head_img_url"] = getLiveHead($dbarr[$i]["uid"],"small");
			if($sourceuid==$dbarr[$i]["uid"])
				$dbarr[$i]["isfollow"] = 1;
			$sql = "select id from pre_weibo_follow 
					where `src_uid`='".$dbarr[$i]["uid"]."' 
						and `dst_uid`='$uid'";
			$eachOtherFollowArray = $dblink->getRow($sql);
			if(count($eachOtherFollowArray)>0)
				$dbarr[$i]["each_other_follow"] = 1;
			else
				$dbarr[$i]["each_other_follow"] = 0;
		}
		if($displaygroup)
		{
			
			$sql = "SELECT a.group_name,b.uid,b.group_id 
					FROM pre_weibo_group a
					INNER JOIN pre_weibo_group_info b ON a.id=b.group_id
				    WHERE a.uid='$uid'";
			$group_arr = $dblink->getRow($sql);
			$count_group_arr = count($group_arr);
			for($k=0;$k<$count_group_arr;$k++)
			{
				$group_map[$group_arr[$k]["uid"]] = $group_arr[$k];
			}
			for($i=0;$i<$num;$i++)
			{
				if(isset($group_map[$dbarr[$i]["uid"]]))
					$dbarr[$i]["group_info"] = $group_map[$dbarr[$i]["uid"]];
				else 
					$dbarr[$i]["group_info"] = array();
			}
		}
		$dblink->dbclose();
		return $dbarr;
	}

	
	/**
	 * 获得提及某用户的消息
	 * @param unknown_type $uid	用户UID
	 * @param unknown_type $lastMsgId           当前页最后的MSGID,用于翻页
	 * 											在翻页时可以利用where列的索引
	 * 											使翻页的速度很快 
	 * @return 		id：消息ID
	 * 				uid：发消息的用户ID
	 * 
	 * 				msg_type:发送消息的类型，定义在表pre_weibo_msg,msg_type
	 * 				msg：消息体
	 * 				be_reply_uid：回复的是哪个用户的消息
	 * 				be_reply_msg:被回复的消息内容
	 *              be_route_uid：被转发的用户ID
	 *              be_route_msg:被转发的消息体
	 */
	static public function getReferUserMsg($uid,$page=1,$recordPerPage=20,
			$lastMsgId=0)
	{
		if(!is_numeric($uid) || $uid<0)
			return getR(false,"uid异常");
		$dblink =new DataBase("");
		if($lastMsgId==0)
			$wheresql = "";
		else
			$wheresql = "AND a.id<'$lastMsgId'";
		$sql = "SELECT a.id,a.uid,a.nicename,a.msg_type,a.msg,a.append_time,
					b.uid AS be_reply_uid,b.nicename AS be_reply_nicename,
					b.msg  AS be_reply_msg,c.uid AS be_route_uid,
					c.msg as be_route_msg,b.msg_type as be_reply_type
				FROM pre_weibo_msg  a
				LEFT JOIN pre_weibo_msg b ON a.reply_parent_msg_id=b.id
				LEFT JOIN pre_weibo_msg c ON a.route_parent_msg_id=c.id
				WHERE (a.uid!='$uid' AND a.msg_type!='1') 
					AND (b.uid='$uid' OR c.uid='$uid') 
					$wheresql
				order by a.append_time desc,id desc
				limit $recordPerPage";
		//var_dump($sql);
		$dbarr = $dblink->getRow($sql);
		$count = count($dbarr);
		
		for($i=0;$i<$count;$i++)
		{
			
			$dbarr[$i]["head_img_url"] = getLiveHead($dbarr[$i]["uid"],
				"small");
			$dbarr[$i]["be_reply_msg"] = Weibo::process_face($dbarr[$i]["be_reply_msg"]);
			if($dbarr[$i]["be_reply_type"]==3)
			{
				$pos = strpos($dbarr[$i]["be_reply_msg"],"{");
				$msg_start = substr($dbarr[$i]["be_reply_msg"], 0,$pos);
				$msg_end = substr($dbarr[$i]["be_reply_msg"], $pos);
				$dbarr[$i]["be_reply_msg"] = $msg_start.Weibo::process_msg($msg_end);
			}
			
			$dbarr[$i]["be_route_msg"] = Weibo::process_face($dbarr[$i]["be_route_msg"]);
			
			if($dbarr[$i]["msg_type"]==3)
			{
				$pos = strpos($dbarr[$i]["msg"],"{");
				$msg_start = substr($dbarr[$i]["msg"], 0,$pos);
				$msg_end = substr($dbarr[$i]["msg"], $pos);
				$dbarr[$i]["msg"] = $msg_start.Weibo::process_msg($msg_end);
			}
			
				//$dbarr[$i]["msg"] = Weibo::process_msg(json_encode($tmp_arr).$dbarr[$i]["msg"]);

		}
		$dblink->dbclose();
		//var_dump($dbarr);
		return $dbarr;
	}
	
	/**
	 * 删除某条动态、回复、转发
	 * @param unknown_type $manager_uid	操作的UID
	 * @param unknown_type $msg_id		消息ID
	 * @param unknown_type $reason		删除原因
	 * @return unknown_type	成功返回true,否则false(checkErr判断)
	 * @remark 注意在调用现要判断权限。$manager_uid要么是用户自己，要么是管理员
	 */
	static public function delMsg($manager_uid,$msg_id,$reason="")
	{
		if(!is_numeric($manager_uid) || $manager_uid<0)
			return getR(false,"manager_uid异常");
		if(!is_numeric($msg_id) || $msg_id<0)
			return getR(false,"msg_id异常");
		
		$dblink =new DataBase("");
		$dblink->query("update pre_weibo_msg set is_del='1',
							del_reason='$reason',del_uid='$manager_uid'
						where id='$msg_id'");
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 删除某个用户的所有微博
	 * @param unknown_type $manager_uid
	 * @param unknown_type $uid
	 * @param unknown_type $reason
	 */
	static public function delUserAllMsg($manager_uid,$uid,$reason="")
	{
		if(!is_numeric($manager_uid) || $manager_uid<0)
			return getR(false,"manager_uid异常");
		if(!is_numeric($uid) || $uid<0)
			return getR(false,"uid异常");
		$dblink =new DataBase("");
		$dblink->query("update pre_weibo_msg set is_del='1',
				del_reason='$reason',del_uid='$manager_uid'
				where uid='$uid'");
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 获得用户的粉丝详细列表信息(被关注)
	 * @param unknown_type $uid
	 * @param unknown_type $page
	 * @param unknown_type $recordPerPage
	 * @param unknown_type $sourceuid 如果不等于0，为用户ID，
	 * 								   比如28154去107291的微博
	 * 							            ，这里$sourceuid==28154，$uid=107291
	 * 								返回结果中的
	 * 								isfollow代表$sourceuid是否有
	 * 									关注其中的任何一个粉丝
	 * 								follow代表这些粉丝中的任何用户是否
	 * 									有关注$sourceuid
	 * @param return 失败返回false,
	 * 				成功返回结果数组，其中 record_count为总结果数
	 * 				 record_arr为详细的结果数组
	 */
	static public function getUserSelfFollow($uid,$page=1,$recordPerPage=20,
			$sourceuid=0,$ordertype=1,$oderAD='desc')
	{
		if(empty($uid) || !is_numeric($uid))
			return getR(false,"uid异常");
		if(!is_numeric($page) || $page<=0)
			return getR(false,"page异常");
		if(!is_numeric($recordPerPage) || $recordPerPage<=0)
			return getR(false,"每页记录数异常");
		
	switch ($ordertype)
		{
			case 2:
				$order_sql = "last_publish_time";
				break;
			case 4:
				$order_sql = "is_watched_count";
				break;
			case 3:
				//按昵称的先不要
			case 1:
			default:
				$order_sql = "follow_date";
				break;
		}
		$dblink =new DataBase("");
		//获得总数
		$sql = "select count(*) as num from pre_weibo_follow 
				WHERE dst_uid='$uid'";
		$count_arr = $dblink->getRow($sql);
		$num = $count_arr[0]["num"];
		if($sourceuid==0)
		{
			$add_sql = "0 as isfollow,0 as follow";
		}
		else
		{
			$add_sql = "(SELECT COUNT(*) FROM pre_weibo_follow c 
					WHERE c.dst_uid=a.src_uid AND c.src_uid='$sourceuid' 
					LIMIT 1) AS isfollow,
					(SELECT COUNT(*) FROM pre_weibo_follow d 
					WHERE d.src_uid=a.src_uid AND d.dst_uid='$sourceuid' 
					LIMIT 1) AS follow";
		}
		//获得$uid的所有粉丝，同时看$sourceuid是否有关注其中的任何一个粉丝,
		//同时看看这些粉丝中的任何用户是否有关注$sourceuid
		
		//用户$uid的所有粉丝，
		//数据包括粉丝的统计数据、关注时间、以及$uid是否反向关注了粉丝
		$sql = "SELECT a.src_uid AS uid,a.follow_date,
					c.watch_count,c.is_watched_count,
					c.transmit_count,c.reply_count,c.last_publish_time,
					c.dymic_count,a.follow_date,
					IF(b.nickname='',b.username,b.nickname) AS nickname,
					(SELECT COUNT(*) FROM pre_weibo_follow d 
					WHERE  d.dst_uid=a.src_uid AND 
						d.src_uid='$uid' LIMIT 1) AS each_other,
					$add_sql
					FROM pre_weibo_follow a
					INNER JOIN pre_common_member b ON b.uid=a.src_uid
					INNER JOIN pre_weibo_user_stat c ON a.src_uid=c.uid
					WHERE a.dst_uid='$uid' ORDER BY $order_sql $oderAD
					limit ".($page-1)*$recordPerPage.",$recordPerPage";
		/*$sql = "SELECT a.src_uid AS uid,a.follow_date,
					IF(b.nickname='',b.username,b.nickname) AS nickname,
					$add_sql
				FROM pre_weibo_follow a
				INNER JOIN pre_common_member b ON b.uid=a.src_uid
				WHERE a.dst_uid='$uid' order by a.follow_date desc 
				limit ".($page-1)*$recordPerPage.",$recordPerPage";
				
		$sql = "SELECT a.src_uid as uid,a.follow_date,
					if(b.nickname='',b.username,b.nickname) as nickname
				FROM pre_weibo_follow a
				inner join pre_common_member b on b.uid=a.src_uid
				WHERE a.dst_uid='$uid' order by a.follow_date desc 
				limit ".($page-1)*$recordPerPage.",$recordPerPage";
				*/
		$dbarr = $dblink->getRow($sql);
		$count = count($dbarr);
		for($i=0;$i<$count;$i++)
		{
			//新增加,根据用户ID获取分享
			$r = Community::getUserShare($dbarr[$i]["uid"]);
			for ($j=0;$j<count($r);$j++){
//				$dbarr[$i]["share_img"][] = $r[$j]['remote_url'];
				$dbarr[$i][share_img][thumb][$j] = $r[$j]['small'];
				$dbarr[$i][share_img][s_id][$j] = $r[$j]['id'];
			}
			$dbarr[$i]["head_img_url"] = getLiveHead($dbarr[$i]["uid"],"small");
			if($sourceuid==$dbarr[$i]["uid"])
				$dbarr[$i]["isfollow"] = 1;
		}
		$dblink->dbclose(); 
		$return_arr["record_count"] = $num;
		$return_arr["record_arr"] = $dbarr;
		//return getR(true,$return_arr);
		return $return_arr;
	}
	
	/**
	 * 发送私信
	 * @param unknown_type $src_uid
	 * @param unknown_type $dst_uid
	 * @param unknown_type $mail_content
	 * @param unknown_type $msg_type 
	 * @param unknown_type $myshare_id
	 */
	static public function SendPrivateMail($src_uid,$dst_uid,$mail_content,$msg_type="0",$myshare_id="0")
	{
		if(empty($src_uid) || !is_numeric($src_uid))
			return getR(false,"src_uid异常");
		if(empty($dst_uid) || !is_numeric($dst_uid))
			return getR(false,"dst_uid异常");
		$dblink =new DataBase("");
		$sql = "INSERT INTO pre_weibo_private_msg (src_uid,dst_uid,msg,msg_type,myshare_id) 
				VALUES ('$src_uid','$dst_uid','$mail_content','$msg_type',$myshare_id)";
		$dblink->query($sql);
		$msg_id = $dblink->get_id();
		$dblink->query("update pre_weibo_private_msg 
						set root_msg_id='$msg_id'
						where id='$msg_id'");
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 获得某用户收到的所有私信
	 * @param unknown_type $uid					用户ID
	 * @param unknown_type $page				当前页
	 * @param unknown_type $recordPayPage		每页记录数
	 * @return unknown_type 失败返回false（checkErr判断）
	 * 						成功返回数组：
	 * 						num：记录总数
	 * 						arr: src_uid：发信人UID
	 * 							 src_nickname：发信人昵称
	 *                           reply_msg_id：回复的哪条消息
	 *                           root_msg_id：根消息（具体看数据库定义）
	 */
	static public function getPrivateMail($uid,$page=1,$recordPayPage=20)
	{
		if(empty($uid) || !is_numeric($uid))
			return getR(false,"uid异常");
		if(empty($page) || !is_numeric($page))
			return getR(false,"page异常");
		if(empty($recordPayPage) || !is_numeric($recordPayPage))
			return getR(false,"recordPayPage异常");
		$dblink =new DataBase("");
		$count_sql = "select count(*) as num from pre_weibo_private_msg 
					  where dst_uid='$uid' ";
		$count_arr = $dblink->getRow($count_sql);
		$num = $count_arr[0]["num"];
		
		$sql = "SELECT a.id,a.append_time,a.src_uid,a.dst_uid,a.msg,
					IF(b.nickname='',b.username,b.nickname) AS src_nickname,
					a.reply_msg_id,a.root_msg_id FROM pre_weibo_private_msg a
				INNER JOIN pre_common_member b ON a.src_uid = b.uid
				WHERE a.dst_uid='$uid' 
				order by a.append_time desc
				limit ".($page-1)*$recordPayPage.",$recordPayPage";
		$dbarr = $dblink->getRow($sql);
		$count = count($dbarr);
		for($i=0;$i<$count;$i++)
		{
			$dbarr[$i]["head_img_url"] = getLiveHead($dbarr[$i]["src_uid"],
											"small");
		}
		$dblink->dbclose();
		$returnV["num"] = $num;
		$returnV["arr"] = $dbarr;
		return $returnV;
	}
	
	/**
	 * 回复私信
	 * @param unknown_type $uid		发送私信的UID
	 * @param unknown_type $msg_id	回复的私信的ID
	 * @param unknown_type $msg		回复内容
	 */
	static public function replyPrivateMail($uid,$msg_id,$msg)
	{
		if(empty($uid) || !is_numeric($uid))
			return getR(false,"uid异常");
		if(empty($msg_id) || !is_numeric($msg_id))
			return getR(false,"msg_id异常");
		$dblink =new DataBase("");
		$sql = "SELECT src_uid as uid,root_msg_id FROM pre_weibo_private_msg 
				WHERE id='$msg_id'";
		$dbarr = $dblink->getRow($sql);
		if(count($dbarr)==0)
			return getR(false,"不存在这个消息");
		$dst_uid = $dbarr[0]["uid"];
		$sql = "INSERT INTO pre_weibo_private_msg (src_uid,dst_uid,
					msg,reply_msg_id,root_msg_id)
				VALUES ('$uid','$dst_uid','$msg','$msg_id',
					'".$dbarr[0]["root_msg_id"]."')";
		$dblink->query($sql);
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 删除私信
	 * @param unknown_type $msg_id
	 */
	static public function deletePrivateMail($msg_id)
	{
		if(empty($msg_id) || !is_numeric($msg_id))
			return getR(false,"msg_id异常");
		$dblink =new DataBase("");
		$sql = "DELETE FROM pre_weibo_private_msg WHERE id='$msg_id'";
		$dblink->query($sql);
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 获得实时动态
	 * @param unknown_type $page		当前第几页
	 * @param unknown_type $recordpage	每页记录数
	 * @param unknown_type $uid			如果为0则为系统所有动态，否则显示某个人的
	 * 									动态
	 */
	static public function getRealtimeDymic($page=1,$recordpage=15,$uid=0)
	{
		if(empty($page) || !is_numeric($page))
			return getR(false,"page异常");
		if(empty($recordpage) || !is_numeric($recordpage))
			return getR(false,"recordpage异常");
		if(!is_numeric($uid))
			return getR(false,"uid异常");
		
		if ($uid==0)
			$add_sql = "";
		else 
			$add_sql = "and a.uid='$uid'";
		$dblink =new DataBase("");
		$count_arr = $dblink->getRow("select count(*) as num 
									  from pre_weibo_msg a 
									  where 1=1 $add_sql");
		$num = $count_arr[0]["num"];
		
		$sql = "SELECT a.id,a.uid,a.msg,a.msg_type,a.ip,a.is_del,a.append_time,
				 b.username
				FROM pre_weibo_msg a
				INNER JOIN pre_common_member b ON a.uid=b.uid
				where 1=1 $add_sql
				ORDER BY a.append_time DESC
				limit ".($page-1)*$recordpage.",$recordpage";
		$dbarr = $dblink->getRow($sql);
		$dbarr_count = count($dbarr);
		for($i=0;$i<$dbarr_count;$i++)
		{
			$dbarr[$i]["msg"] = Weibo::process_face($dbarr[$i]["msg"]);
			if($dbarr[$i]["msg_type"] == 1)
				$dbarr[$i]["msg_type_str"] = "动态";
			elseif ($dbarr[$i]["msg_type"] == 2)
				$dbarr[$i]["msg_type_str"] = "回复";
			elseif ($dbarr[$i]["msg_type"] == 3)
				$dbarr[$i]["msg_type_str"] = "转发";
			
			if($dbarr[$i]["is_del"] == 1)
				$dbarr[$i]["msg_is_del"] = "已被删除";
			else 
				$dbarr[$i]["msg_is_del"] = "正常";
		}
		$returnV["num"] = $num;
		$returnV["arr"] = $dbarr;
		$dblink->dbclose();
		return $returnV;
	}
	
	/**
	 * 获得全部用户的统计信息，也可以指定UID或者用户名
	 * @param unknown_type $page		当前第几页
	 * @param unknown_type $recordpage	每页记录数
	 * @param unknown_type $uid			筛选的用户ID
	 * @param unknown_type $username	筛选的用户名
	 */
	static public function getAllUserStatInfo($page=1,$recordpage=50,
			$uid=0,$username="")
	{
		if(empty($page) || !is_numeric($page))
			return getR(false,"page异常");
		if(empty($recordpage) || !is_numeric($recordpage))
			return getR(false,"recordpage异常");
		$dblink =new DataBase("");
		$add_sql = "";
		if($uid>0)
			$add_sql .= "and b.uid='$uid'";
		if(!empty($username))
			$add_sql .= "and b.username='$username'";
		//获得总数
		$sql = "select count(*) as num from pre_weibo_user_stat a
				inner join pre_common_member b 
				where a.uid=b.uid $add_sql";
		$count_arr = $dblink->getRow($sql);
		$count = $count_arr[0]["num"];
		$sql = "SELECT b.uid,b.is_watch_count,b.dymic_count,b.username,
					b.transmit_count,b.reply_count,b.sum_num,
					b.img_attachment_count,b.vedio_attachment_count,
					b.music_attachment_count,
					b.last_publish_time 
				FROM 
					(SELECT c.uid,is_watched_count as is_watch_count,
						dymic_count,transmit_count,reply_count,
						img_attachment_count,vedio_attachment_count,
						music_attachment_count,last_publish_time,
						d.username,
						(transmit_count+reply_count+dymic_count) AS sum_num 
	 				FROM pre_weibo_user_stat c,pre_common_member d 
	 				where c.uid=d.uid) b 
	 			where 1=1 $add_sql
	 			ORDER BY sum_num DESC 
				LIMIT ".($page-1)*$recordpage.",$recordpage";
		$dbarr = $dblink->getRow($sql);
		$returnv["num"] = $count;
		$returnv["arr"] = $dbarr;
		return $returnv;
	}
	
	
	/**
	 * 添加用户个性签名
	 * @param unknown_type $uid    用户UID
	 * @param unknown_type $signature	签名信息
	 * @return unknown_type
	 */
	static public function AddUserSignature($uid,$signature){
		if(empty($uid) || !is_numeric($uid) || $uid<1)
			return getR(false,"uid格式错误");
		$dblink =new DataBase("");
		$sql = "SELECT uid,signature FROM pre_weibo_user_stat WHERE uid=$uid";
		$data = $dblink->getRow($sql);
		if (count($data)>0) {
			$sql = "UPDATE pre_weibo_user_stat SET signature='$signature' 
					WHERE uid=$uid";
			$dblink->query($sql);
		}else {
			$sql = "INSERT INTO pre_weibo_user_stat (uid,signature) V
					ALUES ('$uid','$signature')";
			$dblink->query($sql);
		}
	}
	
	
	/**
	 * wjy
	 * 微博开放测试开关
	 * $uid得到用户uid
	 */
	static public function WeiboUidAllow($uid){
		$dblink = new DataBase("");
		$sql = "SELECT config_value FROM pre_mutilive_config WHERE config_name LIKE 'wei_test'";
		$weibo_config = $dblink->getRow($sql);
		if(!empty($uid)) {	
			if (!is_numeric($uid) || $uid<1) {
				return getR(false,"uid格式错误");
			}
			$sql = "SELECT uid FROM pre_mutilive_allow_user_list WHERE uid=$uid";
			$weibo_allowuser = $dblink->getRow($sql);
		}		
		//判断是否开启测试
		if ($weibo_config[0]['config_value'] == 0 || ($weibo_config[0]['config_value'] == 1 && $weibo_allowuser[0]['uid'] != "")) {
			return 1;//判断上，返回1则显示微博相关内容
		}else {
			return 0;
		}
		$dblink->dbclose();
		
	}
	
	/**
	 * 获得回复数和转发数最多的动态信息
	 * @param unknown_type $num	取多少条
	 */
	static public function getMuchReplyRouteMsg($num)
	{
		$dblink = new DataBase("");
		$num = (!is_numeric($num) || $num <0 ) ? '10' : $num;
		$sql = "SELECT tmp.uid,tmp.nicename,tmp.msg FROM (
					SELECT a.uid,IF(b.nickname!='',b.nickname,b.username) AS nicename,
					a.msg,reply_count+route_count AS allcount FROM pre_weibo_msg a
				INNER JOIN pre_common_member b ON a.uid=b.uid
 				WHERE a.msg_type='1' AND msg!='' ) tmp ORDER BY tmp.allcount DESC LIMIT $num";
		$arr = $dblink->getRow($sql);
		$count = count($arr);
		for($i=0;$i<$count;$i++)
		{
			$arr[$i]["head_img_url"] = getLiveHead($arr[$i]["uid"],"small");
			$arr[$i]["msg"] = Weibo::process_face($arr[$i]["msg"]);
		}
		return $arr;
	}
	
	/**
	 * 获取用户关注总数
	 */
	static public function getUserFollowTotal($uid){
		$dblink = new DataBase("");
		$sql = "SELECT COUNT(*) num FROM pre_weibo_follow WHERE src_uid=$uid";
		$arr = $dblink->getRow($sql);
		$count = $arr[0]["num"];
		return $count;
	}
}

/*
$r = Weibo::getSysAllMsgFront(696);
var_dump($r);

$r = Weibo::process_injection('aa{"sd"}');
var_dump($r);

//$r = Weibo::getReferUserMsg("107297");
//var_dump($r);



$r = Weibo::getUserAllFollow('107298',0,1,20,1,'desc',0,true);
var_dump($r);


$tmp_arr["uid"] = "107291";
$tmp_arr["nicename"] = "redwood";
$aaa = Weibo::process_msg(json_encode($tmp_arr).'aaa[20]{"uid":2,"nicename":"bbb"}msgb{"uid":3,"nicename":"ccc"}msgc');
var_dump($aaa);
//$str = 'aaa{"uid":2,"nicename":"bbb"}msgb{"uid":3,"nicename":"ccc"}msgc';
//$str = 'sdfsdfsf';
//$aaa = Weibo::process_msg($str);
echo $aaa;


$r = Weibo::getUserAllFollow('107291',27384,1,20,1);
var_dump($r);

$r = Weibo::getUserSelfMsg("28154");
var_dump($r);


$r = Weibo::getUserAllFollow('107298',-2,1,100,1,'desc');
var_dump($r);

$ss = Weibo::process_face('"');
var_dump($ss);
*/
?>