<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoom.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoomSocketApi.class.php");
//$smarty = smarty_init();
$dblink = new DataBase("");
$roomid= $_GET['roomid'];
if ($_GET['tab']=='setNotice')
	{

		if($_GET['act']=='save'){
			$roomnotice=trim($_POST['roomnotice']);
			$roomnotice_link=trim($_POST['roomnotice_link']);
			if(empty($roomnotice)) {
				echo '{"status":"-3"}';
					die();
			}
			if (!empty($roomnotice_link)){
				if (!preg_match('/http:\/\/[\w]+[-.]+huoshow+[-.]+com+[^\s]*/', $roomnotice_link) )
				{
					echo '{"status":"-2"}';
					die();
					}else {
						$roomnotice_link;
					}		
				}
			if (strlen($roomnotice)>150 or strlen($roomnotice_link)>100)
				{
					
					echo '{"status":"-1"}';
					die();
				}
			$sql = "select uid,roominfo from pre_multilive_setting_away_config where uid='$roomid'";
			$isNotice=$dblink->getRow($sql);
			if (empty($isNotice)) {
				$sql = "insert into pre_multilive_setting_away_config (`uid`,`roominfo`,`roominfourl`) values ('$roomid','$roomnotice','$roomnotice_link')";
				$dblink->query($sql);
				echo '{"status":1}';
				//die();
			}else{
				$dblink->query("update pre_multilive_setting_away_config set roominfo='$roomnotice',roominfourl='$roomnotice_link' where uid='$roomid'");
				echo '{"status":1}';
				//die();
			}
			//发送020命令，公告更新
			$data = array(
					'act'=>'3',
					'dstroomid'=>$roomid,
					'type'=>'1'
				);
			MutilLiveRoomSocketApi::sendMutilLiveSystemMessages($data);
			$dblink->dbclose();die();
			}
				header("Content-Type: text/xml; charset=utf-8");
				echo '<?xml version="1.0" encoding="utf-8"?>
				<root><![CDATA[';
				include_once($_SERVER['DOCUMENT_ROOT']."/huoshow/module/show/ajax/show_setnotice.php");
				echo ']]></root>';
		
	 }
if ($_GET['act']=='getNotice'){
	
  //$roomid = $_GET['roomid'];
  if(!empty($roomid)) {
  $sql = "select uid,roominfo,roominfourl from pre_multilive_setting_away_config where uid='$roomid'";
  $MultiliveNotice=$dblink->getRow($sql);
  $roomnotice = $MultiliveNotice[0]['roominfo'];
  $roomnotice_link = $MultiliveNotice[0]['roominfourl'];
  if ($roomnotice){
    	if ($roomnotice_link){
    		echo '<a href="'.$roomnotice_link.'" target="_blank" >';
    	}
    	echo $roomnotice;
    	if ($roomnotice_link){
			echo '</a>';
    	}
      }/*else {
    	//echo $roomcfg[nickname] ? '欢迎来到'.$roomcfg[nickname].'的直播间': '欢迎来到'.$roomcfg[roomtitle].'的直播间';
    	echo "测试失败";
    }*/
  }
}
?>