<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_ulove{
}


class plugin_ulove_forum extends plugin_ulove{

	function viewthread_sidebottom_output(){
		global $postlist, $_G;
		
		$uidsql = null;
		$sendid = $_G['uid'];

		//先找到所有与自己有关的记录
		$i=0;
		$query = DB::query("SELECT id, sendid, toid FROM hsk_ulove where sendid='$sendid' or toid='$sendid'");
		while($datarow = DB::fetch($query)){
			$lovedata[] = $datarow;
			$i++;
		}

		if($i==0){
			foreach($postlist as $value){
				$return[] = $uidsql.'<div id="ulove_'.$value['pid'].'"><p><em><a href="plugin.php?id=ulove:ulove&tion=sendlove&pid='.$value['pid'].'&uid='.$value['authorid'].'" onclick="showWindow(\'sendlove\', this.href);return false;"><img src="source/plugin/ulove/images/like_1.gif" border="0"></a><center><a href="plugin.php?id=ulove:ulove" class="xi1">什么是暗恋？</a></center></em></div>';
			}
		}else{
			foreach($postlist as $value){

				if($value && $value['authorid'] != $sendid){
					foreach($lovedata as $datarow){
						//先判断发贴者有没有暗恋我
						if($value['authorid'] == $datarow['sendid'] && $datarow['toid'] == $sendid){
							$heloveme = 1;
						//再判断自己有没有发给当前发贴用户暗恋标志
						}elseif($datarow['sendid'] == $sendid && $value['authorid'] == $datarow['toid']){
							$ilovehe = 1;
						}else{
							$heloveme = $ilovehe = 0;
						}
					}
					//得到是否有暗恋发贴人和发贴人是否有暗恋我之后，可以写显示标志的代码了
					if($heloveme == 1 && $ilovehe == 1){//相互暗恋
						$return[] = '<div id="ulove_'.$value['pid'].'"><p><em><a title="你们正在相互暗恋，还不快给TA发消息吗？" onclick="showWindow(\'sendpm\', this.href)" href="home.php?mod=spacecp&ac=pm&op=showmsg&handlekey=showmsg_'.$value['authorid'].'&touid='.$value['authorid'].'&pmid=0&daterange=2&pid='.$value['pid'].'"><img src="source/plugin/ulove/images/like_4.gif" border="0"></a><center><a href="plugin.php?id=ulove:ulove" class="xi1">什么是暗恋？</a></center></em></div>';
					}elseif($ilovehe == 1){//正在暗恋TA
						$return[] = '<div id="ulove_'.$value['pid'].'"><p><em><a title="已经发送了暗恋信息了，不过还要耐心等待哦！"><img src="source/plugin/ulove/images/like_3.gif" border="0"></a><center><a href="plugin.php?id=ulove:ulove" class="xi1">什么是暗恋？</a></center></em></div>';
					}else{//其它情况
						$return[] = '<div id="ulove_'.$value['pid'].'"><p><em><a href="plugin.php?id=ulove:ulove&tion=sendlove&pid='.$value['pid'].'&uid='.$value['authorid'].'" onclick="showWindow(\'sendlove\', this.href);return false;"><img src="source/plugin/ulove/images/like_1.gif" border="0" onmouseover="this.src=\'source/plugin/ulove/images/like_2.gif\';" onmouseout="this.src=\'source/plugin/ulove/images/like_1.gif\';"></a><center><a href="plugin.php?id=ulove:ulove" class="xi1">什么是暗恋？</a></center></em></div>';
					}
				}else{
						$return[] = '<div id="ulove_'.$value['pid'].'"><p><em><a href="plugin.php?id=ulove:ulove&tion=sendlove&pid='.$value['pid'].'&uid='.$value['authorid'].'" onclick="showWindow(\'sendlove\', this.href);return false;"><img src="source/plugin/ulove/images/like_1.gif" border="0" onmouseover="this.src=\'source/plugin/ulove/images/like_2.gif\';" onmouseout="this.src=\'source/plugin/ulove/images/like_1.gif\';"></a><center><a href="plugin.php?id=ulove:ulove" class="xi1">什么是暗恋？</a></center></em></div>';
				}
			}
		}
		return $return;


	}
}

class plugin_ulove_group extends plugin_ulove{

	function viewthread_sidebottom_output(){
		global $postlist, $_G;
		
		$uidsql = null;
		$sendid = $_G['uid'];

		//先找到所有与自己有关的记录
		$i=0;
		$query = DB::query("SELECT id, sendid, toid FROM hsk_ulove where sendid='$sendid' or toid='$sendid'");
		while($datarow = DB::fetch($query)){
			$lovedata[] = $datarow;
			$i++;
		}

		if($i==0){
			foreach($postlist as $value){
				$return[] = $uidsql.'<div id="ulove_'.$value['pid'].'"><p><em><a href="plugin.php?id=ulove:ulove&tion=sendlove&pid='.$value['pid'].'&uid='.$value['authorid'].'" onclick="showWindow(\'sendlove\', this.href);return false;"><img src="source/plugin/ulove/images/like_1.gif" border="0"></a><center><a href="plugin.php?id=ulove:ulove" class="xi1">什么是暗恋？</a></center></em></div>';
			}
		}else{
			foreach($postlist as $value){

				if($value && $value['authorid'] != $sendid){
					foreach($lovedata as $datarow){
						//先判断发贴者有没有暗恋我
						if($value['authorid'] == $datarow['sendid'] && $datarow['toid'] == $sendid){
							$heloveme = 1;
						//再判断自己有没有发给当前发贴用户暗恋标志
						}elseif($datarow['sendid'] == $sendid && $value['authorid'] == $datarow['toid']){
							$ilovehe = 1;
						}else{
							$heloveme = $ilovehe = 0;
						}
					}
					//得到是否有暗恋发贴人和发贴人是否有暗恋我之后，可以写显示标志的代码了
					if($heloveme == 1 && $ilovehe == 1){//相互暗恋
						$return[] = '<div id="ulove_'.$value['pid'].'"><p><em><a title="你们正在相互暗恋，还不快给TA发消息吗？" onclick="showWindow(\'sendpm\', this.href)" href="home.php?mod=spacecp&ac=pm&op=showmsg&handlekey=showmsg_'.$value['authorid'].'&touid='.$value['authorid'].'&pmid=0&daterange=2&pid='.$value['pid'].'"><img src="source/plugin/ulove/images/like_4.gif" border="0"></a><center><a href="plugin.php?id=ulove:ulove" class="xi1">什么是暗恋？</a></center></em></div>';
					}elseif($ilovehe == 1){//正在暗恋TA
						$return[] = '<div id="ulove_'.$value['pid'].'"><p><em><a title="已经发送了暗恋信息了，不过还要耐心等待哦！"><img src="source/plugin/ulove/images/like_3.gif" border="0"></a><center><a href="plugin.php?id=ulove:ulove" class="xi1">什么是暗恋？</a></center></em></div>';
					}else{//其它情况
						$return[] = '<div id="ulove_'.$value['pid'].'"><p><em><a href="plugin.php?id=ulove:ulove&tion=sendlove&pid='.$value['pid'].'&uid='.$value['authorid'].'" onclick="showWindow(\'sendlove\', this.href);return false;"><img src="source/plugin/ulove/images/like_1.gif" border="0" onmouseover="this.src=\'source/plugin/ulove/images/like_2.gif\';" onmouseout="this.src=\'source/plugin/ulove/images/like_1.gif\';"></a><center><a href="plugin.php?id=ulove:ulove" class="xi1">什么是暗恋？</a></center></em></div>';
					}
				}else{
						$return[] = '<div id="ulove_'.$value['pid'].'"><p><em><a href="plugin.php?id=ulove:ulove&tion=sendlove&pid='.$value['pid'].'&uid='.$value['authorid'].'" onclick="showWindow(\'sendlove\', this.href);return false;"><img src="source/plugin/ulove/images/like_1.gif" border="0" onmouseover="this.src=\'source/plugin/ulove/images/like_2.gif\';" onmouseout="this.src=\'source/plugin/ulove/images/like_1.gif\';"></a><center><a href="plugin.php?id=ulove:ulove" class="xi1">什么是暗恋？</a></center></em></div>';
				}
			}
		}
		return $return;


	}
}


class plugin_ulove_home extends plugin_ulove{

	function space_profile_baseinfo_top_output(){
		global $_G, $space;
		
		$uidsql = null;
		$sendid = $_G['uid'];
		$hisid = $space['uid'];

		//先找到所有与自己有关的记录
		$i=0;
		//检查 我有没有暗恋他 的标志
		$query = DB::query("SELECT id, sendid, toid FROM hsk_ulove where sendid='$sendid' and toid='$hisid'");
		if($datarow = DB::fetch($query)){
			//检查 有没有 他暗恋过我 的标志
			$query = DB::query("SELECT id, sendid, toid FROM hsk_ulove where sendid='$hisid' and toid='$sendid'");
			if($datarow = DB::fetch($query)){
				//如果有的话，显示已经发送过暗恋了；
				$return = '<div id="ulove_'.$hisid.'"><p><em><a title="你们正在相互暗恋，还不快给TA发消息吗？" onclick="showWindow(\'sendpm\', this.href)" href="home.php?mod=spacecp&ac=pm&op=showmsg&handlekey=showmsg_'.$hisid.'&touid='.$hisid.'&pmid=0&daterange=2&pid='.$hisid.'"><img src="source/plugin/ulove/images/like_4.gif" border="0" class="vm"></a> <a href="plugin.php?id=ulove:ulove" class="xi1">什么是暗恋？</a></em></div>';
			}else{
				//显示已经已暗恋标志
				$return = '<div id="ulove_'.$hisid.'"><p><em><a title="已经发送了暗恋信息了，不过还要耐心等待哦！"><img src="source/plugin/ulove/images/like_3.gif" border="0" class="vm"></a> <a href="plugin.php?id=ulove:ulove" class="xi1">什么是暗恋？</a></em></div>';
			}
		}else{
			//没有暗恋标志
			$return = '<div id="ulove_'.$hisid.'"><p><em><a href="plugin.php?id=ulove:ulove&tion=sendlove&pid=1&uid='.$hisid.'" onclick="showWindow(\'sendlove\', this.href);return false;"><img src="source/plugin/ulove/images/like_1.gif" border="0" onmouseover="this.src=\'source/plugin/ulove/images/like_2.gif\';" onmouseout="this.src=\'source/plugin/ulove/images/like_1.gif\';" class="vm"></a> <a href="plugin.php?id=ulove:ulove" class="xi1">什么是暗恋？</a></em></div>';
		}
		return $return;
	}
}



?>