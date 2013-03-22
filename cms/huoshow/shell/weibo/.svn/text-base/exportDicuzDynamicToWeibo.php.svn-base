<?php
/**
 * @author chengkui
 * @remark	把DZ中现存的空间中的动态导入到微博中
 *
 */
set_time_limit(360);
$root_path = realpath(dirname(__FILE__)."/../../..");
$_SERVER['DOCUMENT_ROOT'] = $root_path;

require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/weibo.class.php");
ini_set("error_reporting",E_ALL);
ini_set("display_errors","On");

$exprtRecordPer = 500; //每次导出500条

$tmp_database = 'huoshow_beta_test';
$real_database = 'huoshow_beta';

$SYSCONFIG["MYsqlDataBase"] = $tmp_database;
$dblink = new DataBase("");

$dblink->query("delete from pre_weibo_msg");
$dblink->query("delete from pre_weibo_user_stat");
$dblink->query("delete from pre_weibo_attachment");
$dblink->query("delete from pre_weibo_follow");
$dblink->query("delete from pre_weibo_tmp");
//$dblink->query("delete from pre_weibo_follow");

$dblink->query("alter table pre_weibo_msg AUTO_INCREMENT=1");
$dblink->query("alter table pre_weibo_attachment AUTO_INCREMENT=1");
$dblink->query("alter table pre_weibo_follow AUTO_INCREMENT=1");
//$dblink->query("alter table pre_weibo_follow AUTO_INCREMENT=1");

//导入好友信息
$sql = "SELECT count(*) as num FROM pre_home_friend";
$dbarr = $dblink->getRow($sql);
$count = $dbarr[0]["num"];
$i=0;
while ($i<$count)
{
	$sql = "SELECT uid,fuid,dateline FROM pre_home_friend 
		ORDER BY dateline ASC LIMIT $i,$exprtRecordPer";
	$i+=$exprtRecordPer;
	$dbarr = $dblink->getRow($sql);
	$dbarr_count = count($dbarr);
	for($j=0;$j<$dbarr_count;$j++)
	{
		$date = date("Y-m-d H:i:s",$dbarr[$j]["dateline"]);
		Weibo::followUser($dbarr[$j]["uid"], $dbarr[$j]["fuid"],$date);
	}
}


//doing
$sql = "select count(*) as num from pre_home_doing";
$dbarr = $dblink->getRow($sql);
$count = $dbarr[0]["num"];

$i=0;
while ($i<$count)
{
	$sql = "SELECT a.doid as id,a.uid,a.dateline,a.message as body_data,a.ip,
				if(b.nickname='',b.username,b.nickname) as nickname
			FROM pre_home_doing a
			INNER JOIN pre_common_member b ON a.uid=b.uid 
			ORDER BY a.dateline ASC LIMIT $i,$exprtRecordPer";
	$i+=$exprtRecordPer;
	$dbarr = $dblink->getRow($sql);
	$dbarr_count = count($dbarr);
	for($j=0;$j<$dbarr_count;$j++)
	{
		$msg_id = false;
		//$msg = unserialize($dbarr[$j]["body_data"]);
		$msg = process_msg($dbarr[$j]["body_data"]);
		$date = date("Y-m-d H:i:s",$dbarr[$j]["dateline"]);
		$r = Weibo::senDynamic($dbarr[$j]["uid"], $dbarr[$j]["nickname"],
				$msg,array(),array(),array(),$date);
		if($r["-retult-"])
		{
			$msg_id = $r["-msg-"];
			$dblink->query("update pre_weibo_msg set source=3,
					source_id='".$dbarr[$j]["id"]."'
					where id='".$r["-msg-"]."'");
			importReplyFromBlogOrAlbum($r["-msg-"],"doing",
					$dbarr[$j]["id"]);
		}
	}
}

$sql = "SELECT COUNT(*) AS num FROM pre_home_feed a,pre_common_member b 
	WHERE a.uid=b.uid AND (icon='blog' OR icon='album')";

$dbarr = $dblink->getRow($sql);
$count = $dbarr[0]["num"];
$i=0;
while($i<$count)
{

	$sql = "SELECT a.uid,a.dateline,a.icon,b.username,
				if(b.nickname is null,b.username,b.nickname) as nickname,
				a.body_data,a.id,a.image_1,a.image_2,a.image_3
			FROM `pre_home_feed` a ,pre_common_member b 
			WHERE a.uid=b.uid and (icon='blog' OR icon='album' OR icon='doing')
			ORDER BY dateline ASC LIMIT ".$i.",$exprtRecordPer";
	$dbarr = $dblink->getRow($sql);
	$dbarr_count = count($dbarr);
	for($j=0;$j<$dbarr_count;$j++)
	{
		$msg_id = false;
		
		//发动态
		if($dbarr[$j]["icon"] == 'blog')
		{
			$msg = unserialize($dbarr[$j]["body_data"]);
			$date = date("Y-m-d H:i:s",$dbarr[$j]["dateline"]);
			$r = Weibo::senDynamic($dbarr[$j]["uid"], $dbarr[$j]["nickname"], 
					process_msg($msg["summary"]),array(),array(),array(),$date);
			if($r["-retult-"]) 
			{
				$msg_id = $r["-msg-"];
				$dblink->query("update pre_weibo_msg set source=3,
						source_id='".$dbarr[$j]["id"]."' 
						where id='".$r["-msg-"]."'");
				importReplyFromBlogOrAlbum($r["-msg-"],$dbarr[$j]["icon"],
						$dbarr[$j]["id"]);
			}
		}
		//发照片
		if($dbarr[$j]["icon"] == 'album')
		{
			$img_arr = array();
			for($k=1;$k<4;$k++)
			{
				if(!empty($dbarr[$j]["image_".$k]))
				{
					$img_arr[] = $dbarr[$j]["image_".$k];
				}
			}
			$msg = unserialize($dbarr[$j]["body_data"]);
			$msg["summary"] = (isset($msg["summary"]))?$msg["summary"]:"";
			$date = date("Y-m-d H:i:s",$dbarr[$j]["dateline"]);
			$r = Weibo::senDynamic($dbarr[$j]["uid"], $dbarr[$j]["nickname"],
					process_msg($msg["summary"]),$img_arr,array(),array(),$date);
			if($r["-retult-"])
			{
				$msg_id = $r["-msg-"];
				$dblink->query("update pre_weibo_msg set source=4,
						source_id='".$dbarr[$j]["id"]."'
						where id='".$r["-msg-"]."'");
				importReplyFromBlogOrAlbum($r["-msg-"],$dbarr[$j]["icon"],
						$dbarr[$j]["id"]);
			}
		}
	}
	$i += $exprtRecordPer;
}
//现有的微博信息导入到临时表中，同时修改导入后的msg_id对应关系
/*
$sql = "select * `$real_database`.from pre_weibo_msg 
		where source='1' order by id asc";
$dbarr = $dblink->getRow($sql);
$count = count($dbarr);
for($j=0;$j<$count;$j++)
{
	$old_id = $dbarr[$j]["id"];
	$sql = "insert into `$tmp_database`.pre_weibo_msg 
				(uid,nicename,msg,msg_type,reply_parent_msg_id,
				route_parent_msg_id,route_count,reply_count,append_time,
				attachment_img_count,attachment_vedio_count,
				attachment_music_count,ip,source,source_id,is_del,
				del_reason,del_uid)
			values ('".$dbarr[$j]["uid"]."',
				"."'".$dbarr[$j]["nicename"]."',"."'".$dbarr[$j]["msg"]."',
				"."'".$dbarr[$j]["msg_type"]."',
				"."'".$dbarr[$j]["reply_parent_msg_id"]."',
				"."'".$dbarr[$j]["route_parent_msg_id"]."',
				"."'".$dbarr[$j]["route_count"]."',
				"."'".$dbarr[$j]["reply_count"]."',
				"."'".$dbarr[$j]["append_time"]."',
				"."'".$dbarr[$j]["attachment_img_count"]."',
				"."'".$dbarr[$j]["attachment_vedio_count"]."',
				"."'".$dbarr[$j]["attachment_music_count"]."',
				"."'".$dbarr[$j]["ip"]."',"."'".$dbarr[$j]["source"]."',
				"."'".$dbarr[$j]["source_id"]."',"."'".$dbarr[$j]["is_del"]."',
				"."'".$dbarr[$j]["del_reason"]."',
				"."'".$dbarr[$j]["del_uid"]."')";
	$dblink->query($sql);
	$msg_id = $dblink->get_id();
	$sql = "insert into `$tmp_database`.pre_weibo_tmp 
				(old_id,new_id) 
			values('$old_id','$msg_id')";
	$dblink->query($sql);
}
$sql = "select old_id,new_id from `$tmp_database`.pre_weibo_tmp";
$dbarr = $dblink->getRow($sql);
$count = count($dbarr);
for($i=0;$i<$count;$i++)
{
	$old_id = $dbarr[$i]["old_id"];
	$msg_id = $dbarr[$i]["new_id"];
	if($old_id!=$msg_id)
	{
		$dblink->query("UPDATE pre_weibo_msg SET reply_parent_msg_id='$msg_id' WHERE reply_parent_msg_id='$old_id'");
		$dblink->query("UPDATE pre_weibo_msg SET route_parent_msg_id='$msg_id' WHERE route_parent_msg_id='$old_id'");
		$dblink->query("UPDATE pre_weibo_attachment SET msg_id='$msg_id' WHERE msg_id='$old_id'");
	}
}
*/
$dblink->dbclose();
//在测试环境下填入数据后
//导入到正式表，同时把msg、attachment中的msg_id替换为正确的ID
$SYSCONFIG["MYsqlDataBase"] = $real_database;

$dblink = new DataBase("");
$dblink->query("delete from pre_weibo_msg");
$dblink->query("delete from pre_weibo_msg1");
$dblink->query("delete from pre_weibo_user_stat");
$dblink->query("delete from pre_weibo_attachment");
$dblink->query("delete from pre_weibo_follow");
$dblink->query("delete from pre_weibo_tmp");
//$dblink->query("delete from pre_weibo_follow");
$dblink->query("alter table pre_weibo_msg AUTO_INCREMENT=1");
$dblink->query("alter table pre_weibo_msg1 AUTO_INCREMENT=1");
$dblink->query("alter table pre_weibo_attachment AUTO_INCREMENT=1");
$dblink->query("alter table pre_weibo_follow AUTO_INCREMENT=1"); 

//导入用户统计信息
$sql = "insert into `$real_database`.pre_weibo_user_stat select * from `$tmp_database`.pre_weibo_user_stat";
$dblink->query($sql);

//导入关注信息
$sql = "insert into `$real_database`.pre_weibo_follow select * from `$tmp_database`.pre_weibo_follow";
$dblink->query($sql);

//导入附件信息
$sql = "insert into `$real_database`.pre_weibo_attachment select * from `$tmp_database`.pre_weibo_attachment";
$dblink->query($sql);

//导入消息信息
$sql = "insert into `$real_database`.pre_weibo_msg1(id,uid,nicename,msg,msg_type,reply_parent_msg_id,route_parent_msg_id,route_count,reply_count,append_time,attachment_img_count,attachment_vedio_count,attachment_music_count,ip,source,source_id,is_del,del_reason,del_uid) select id,uid,nicename,msg,msg_type,reply_parent_msg_id,route_parent_msg_id,route_count,reply_count,append_time,attachment_img_count,attachment_vedio_count,attachment_music_count,ip,source,source_id,is_del,del_reason,del_uid from `$tmp_database`.pre_weibo_msg order by id asc";
$dblink->query($sql);

//开始配对，由于现在微博内容的翻页是小于最后一个ID，那么就需要排序条件与ID出现次序
//一致，这对于微博中出现的新内容是成立的，但是对于导入的内容，因为来自多张表，
//因此会出现消息id的次序和时间的次序并不匹配，从而导致翻页时出现重复记录
$tmp_count = 500;
$db_count_arr = $dblink->getRow("select count(*) as count from `$real_database`.pre_weibo_msg1 ");
$db_count = $db_count_arr[0]["count"];
$i=0;
while (true)
{

	$dbarr = $dblink->getRow("select * from `$real_database`.pre_weibo_msg1 order by append_time asc limit $i,$tmp_count");
	$count = count($dbarr);
	if($count==0)
		break;
	for($j=0;$j<$count;$j++)
	{
		$old_id = $dbarr[$j]["id"];
		$sql = "insert into `$real_database`.pre_weibo_msg (uid,nicename,msg,msg_type,reply_parent_msg_id,route_parent_msg_id,route_count,reply_count,append_time,attachment_img_count,attachment_vedio_count,attachment_music_count,ip,source,source_id,is_del,del_reason,del_uid) 
			values ('".$dbarr[$j]["uid"]."',"."'".$dbarr[$j]["nicename"]."',"."'".$dbarr[$j]["msg"]."',"."'".$dbarr[$j]["msg_type"]."',"."'".$dbarr[$j]["reply_parent_msg_id"]."',"."'".$dbarr[$j]["route_parent_msg_id"]."',"."'".$dbarr[$j]["route_count"]."',"."'".$dbarr[$j]["reply_count"]."',"."'".$dbarr[$j]["append_time"]."',"."'".$dbarr[$j]["attachment_img_count"]."',"."'".$dbarr[$j]["attachment_vedio_count"]."',"."'".$dbarr[$j]["attachment_music_count"]."',"."'".$dbarr[$j]["ip"]."',"."'".$dbarr[$j]["source"]."',"."'".$dbarr[$j]["source_id"]."',"."'".$dbarr[$j]["is_del"]."',"."'".$dbarr[$j]["del_reason"]."',"."'".$dbarr[$j]["del_uid"]."')";
		$dblink->query($sql);
		$msg_id = $dblink->get_id();
		$sql = "insert into `$real_database`.pre_weibo_tmp (old_id,new_id) values('$old_id','$msg_id')";
		$dblink->query($sql);
	}
	$i += $tmp_count;
}

$sql = "select old_id,new_id from `$real_database`.pre_weibo_tmp";
$dbarr = $dblink->getRow($sql);
$count = count($dbarr);
for($i=0;$i<$count;$i++)
{
	$old_id = $dbarr[$i]["old_id"];
	$msg_id = $dbarr[$i]["new_id"];
	if($old_id!=$msg_id)
	{
		$dblink->query("UPDATE pre_weibo_msg SET reply_parent_msg_id='$msg_id',
							be_process='1' 
						WHERE reply_parent_msg_id='$old_id'  
							and be_process='0'");
		$dblink->query("UPDATE pre_weibo_msg SET route_parent_msg_id='$msg_id',
							be_process='1' 
						WHERE route_parent_msg_id='$old_id' 
							and be_process='0'");
		$dblink->query("UPDATE pre_weibo_attachment SET msg_id='$msg_id',
							 be_process='1' 
						WHERE msg_id='$old_id' 
							and be_process='0'");
	}
}


die("ok\t".getLocalTimeStr(time()));

/**
 * 对指定博客或者图库ID获得其所有回复信息，作为微博的回复内容，导入到微博中
 * @param unknown_type $msg_id		博客或图库指定ID
 * @param unknown_type $type		$dbarr[$j]["icon"]
 * @param unknown_type $source_id	这条消息的原始ID，比如：博客中的一条信息的ID是
 * 									表pre_home_blog中的blogid，这个就是原始ID
 * 									导入微博表后会产生一个msg_id,这个就是msg_id
 */
function importReplyFromBlogOrAlbum($msg_id,$type,$source_id)
{
	global $dblink;
	if($type == 'blog')
	{
		$sql = "SELECT a.authorid as uid,
					IF(c.nickname='',c.username,c.nickname) AS nicename,
					a.ip,a.dateline,a.message AS msg,b.blogid AS msg_id 
				FROM pre_home_comment a 
					INNER JOIN pre_home_blog b ON a.id=b.blogid
					INNER JOIN pre_common_member c ON a.authorid=c.uid
				WHERE a.id='$source_id' and a.idtype='blogid' and 
					a.status='0'";
		$idtype=5;
	}
	elseif ($type == 'album')
	{
		$sql = "SELECT a.authorid as uid,
					IF(c.nickname='',c.username,c.nickname) AS nicename,
					a.ip,a.dateline,a.message AS msg,b.albumid AS msg_id 
				FROM pre_home_comment a 
					INNER JOIN pre_home_pic b ON a.id=b.picid
					INNER JOIN pre_common_member c ON a.authorid=c.uid
				WHERE a.id='$source_id' AND a.idtype='picid' AND a.status='0'";
		$idtype=6;
	}
	elseif($type == 'doing')
	{
		$sql = "SELECT a.id as msg_id,a.uid,a.dateline,
					IF(b.nickname='',b.username,b.nickname) AS nicename,
					a.message as msg,a.ip 
				FROM pre_home_docomment a
				INNER JOIN pre_common_member b ON a.uid=b.uid
				WHERE a.doid='$source_id'";
		/*
		$sql = "SELECT a.reply_id as msg_id,a.reply_content as msg,a.reply_uid as uid,
					a.reply_ip as ip,a.reply_dateline as dateline,
					IF(b.nickname='',b.username,b.nickname) AS nicename
				FROM pre_home_comment_reply a
				INNER JOIN pre_common_member b ON a.reply_uid=b.uid 
				WHERE a.cid='$source_id'";
		*/
		$idtype=7;
	}
	$dbarr = $dblink->getRow($sql);
	$count = count($dbarr);

	for($i=0;$i<$count;$i++)
	{
		$r = Weibo::replyMsg($dbarr[$i]["uid"], $dbarr[$i]["nicename"], 
				$msg_id, process_msg($dbarr[$i]["msg"]),
				getLocalTimeStr($dbarr[$i]["dateline"]),$dbarr[$i]["ip"]);
		$current_msg_id = $r["-msg-"];
		$dblink->query("update pre_weibo_msg set source=$idtype,
				source_id='".$dbarr[$i]["msg_id"]."'
				where id='$current_msg_id'");
	}
}

function process_msg($msg)
{
	$patten = "/\<img src=\"static\/image\/smiley\/comcom\/([\d]+)\.gif\" class=\"vm\"\>/i";
	$patten_html = "/\<[^<]+\>/i";
	$msg = preg_replace($patten, "[$1]", $msg);
	$msg = preg_replace($patten_html, "", $msg);
	return $msg;
}
?>