<?php
//zhangchengjun 2010.11.02

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$page = empty($_GET['page'])?1:intval($_GET['page']);
if($page<1) $page=1;
$id = empty($_GET['id'])?0:intval($_GET['id']);
$classify = empty($_GET['classify'])?0:intval($_GET['classify']);
$dateline = empty($_G['gp_time'])?0:$_G['gp_time'];
$type = empty($_G['gp_type'])?0:$_G['gp_type'];
if (empty($_G['gp_view'])) {
	if (empty($id)) {
		$_GET['view'] = 'me';
	} else {		
		if ($myshowInfo['uid'] == $_G['uid']) {
			$_GET['view'] = 'me';
		} else {
			$_GET['view'] = 'all';
		}
	}
} else {
	$_GET['view'] = $_G['gp_view'];
}
if (empty($_G['uid']) || !empty($classify) || !empty($dateline) || (!empty($_G['gp_uid']) && $_G['gp_uid'] != $_G['uid'])) {
	$_GET['view'] = 'all';
}

$actives = array($_GET['view'] =>' class="a"');

if($id) {#详细页
	$myshowInfo = DB::fetch_first("SELECT * FROM ".DB::table('video_list')." WHERE myshowid=$id");
	
	if (!empty($myshowInfo)) {
		$uid = $_G['gp_uid'] = $_GET['uid'] = $myshowInfo['uid'];
		if($uid) {
			$space = getspace($uid);
			if(empty($space)) {
				showmessage('space_does_not_exist');
			}
		}
		if (!empty($_G['gp_uid']) && $_G['gp_uid'] != $_G['uid']) {
			$_GET['view'] = 'all';
		}		
		
		$hash = md5($myshowInfo['uid']."\t".$myshowInfo['dateline']);
		$myshowInfo['dateline'] = date("Y-m-d H:i:s", $myshowInfo['dateline']);
		$myshowInfo['image'] = cVideoPic($myshowInfo, 'big');
		$myshowInfo['url'] = cVideoUrl($myshowInfo);
		$myshowInfo['language'] = lang('home/template', 'myshow_language_'.$myshowInfo['language']);
		//观看数
		if(!$space['self'] && $_G['cookie']['view_myshowid'] != $myshowInfo['myshowid']) {
			if($myshowInfo['auditstatus']==2){
				DB::query("UPDATE ".DB::table('video_list')." SET viewnum=viewnum+1 WHERE myshowid=".$myshowInfo['myshowid']);
				dsetcookie('view_myshowid', $myshowInfo['myshowid']);
			}
		}
		
		//收藏
		$query=DB::query("SELECT a.*,b.username FROM ".DB::table('home_favorite')." a LEFT JOIN ".DB::table('common_member')." b ON a.uid= b.uid WHERE a.idtype='myshowid' AND a.id='$id'");
		while($rs = DB::fetch($query)){
			$rs['dateline'] = date("Y-m-d H:i:s", $rs['dateline']);
			$favorites[]=$rs;
		};
		
		//该用户其他MY秀
		if($myshowInfo['uid'] == $_G['uid']){
			$query = DB::query("SELECT * FROM ".DB::table('video_list')." WHERE  myshowid!=$id AND uid=".$myshowInfo['uid']." LIMIT 4");
		}else{
			$query = DB::query("SELECT * FROM ".DB::table('video_list')." WHERE auditstatus=2 AND myshowid!=$id AND uid=".$myshowInfo['uid']." LIMIT 4");
		}
		while ($rs = DB::fetch($query)) {
			$rs['image'] = cVideoPic($rs, 'small');
			$rs['dateline'] = date("Y-m-d H:i:s", $rs['dateline']);
			$myshowOther[] = $rs;
		}
		
		//热门MY秀
		$query = DB::query("SELECT * FROM ".DB::table('video_list')." WHERE auditstatus=2 ORDER BY viewnum DESC LIMIT 4");
		while($rs = DB::fetch($query)){
			$rs['image'] = cVideoPic($rs, 'small');
			$rs['dateline'] = date("Y-m-d H:i:s", $rs['dateline']);
			$myshowHot[] = $rs;
		}
		
		//回复
		$perpage = 20;
		$perpage = mob_perpage($perpage);	
		$start = ($page-1)*$perpage;	
		ckstart($start, $perpage);
		
		$count = $myshowInfo['reply'];
		$replyList = array();
		if($count) {
			if($_GET['goto']) {
				$page = ceil($count/$perpage);
				$start = ($page-1)*$perpage;
			} else {
				$cid = empty($_GET['cid'])?0:intval($_GET['cid']);
				$csql = $cid?"cid='$cid' AND":'';
			}
			$query = DB::query("SELECT * FROM ".DB::table('home_comment')." WHERE $csql id='$id' AND idtype='myshowid' ORDER BY dateline LIMIT $start,$perpage");
			while ($value = DB::fetch($query)) {
				$replyList[] = $value;
			}
	
			if(empty($replyList) && empty($cid)) {
				$count = getcount('home_comment', array('id'=>$id, 'idtype'=>'myshowid'));
				db::update('video_list', array('reply'=>$count), array('myshowid'=>$blog['myshowid']));
			}
		}
		$multi = multi($count, $perpage, $page, "home.php?mod=space&do=myshow&view=$_GET[view]&id=$id#comment");
		
		//表态
		$idtype = 'myshowid';	
		$maxclicknum = 0;
		loadcache('click');
		$clicks = empty($_G['cache']['click']['myshowid'])?array():$_G['cache']['click']['myshowid'];
		
		foreach ($clicks as $key => $value) {
			$value['clicknum'] = $myshowInfo["click{$key}"];
			$value['classid'] = mt_rand(1, 4);
			if($value['clicknum'] > $maxclicknum) $maxclicknum = $value['clicknum'];
			$clicks[$key] = $value;
		}
		
		//表态人
		$clickuserlist = array();
		$query = DB::query("SELECT * FROM ".DB::table('home_clickuser')."
			WHERE id='$id' AND idtype='$idtype'
			ORDER BY dateline DESC
			LIMIT 0,24");
		while ($rs = DB::fetch($query)) {
			$rs['clickname'] = $clicks[$rs['clickid']]['name'];
			$clickuserlist[] = $rs;
		}
		
		include_once template("home/space_myshow_view");
	} else {
		showmessage(lang("home/template",'myshow_no_exist'), '');
	}
} else {#列表页
	
	$perpage = 10;
	$perpage = mob_perpage($perpage);
	$start = ($page-1)*$perpage;
	ckstart($start, $perpage);
	
	$list = array();
	$count = 0;
	
	if ($_GET['view'] == 'all') {//随便看看
		
		$sql = '';
		if (!empty($classify)) {#type
			$classifyInfo = DB::fetch_first("SELECT * FROM ".DB::table('video_classify')." WHERE id=$classify");
			if ($classifyInfo['type_id'] == 1) {
				$perpage = 36;
			} else {
				$perpage = 18;
			}
			$sql = " AND classify=$classify";
		}
		if (!empty($dateline)) {#dateline
			$perpage = 18;
			
			$tmp = explode(',', $dateline);
			$startTime = empty($tmp[0]) ? 0 : strtotime($tmp[0].' 00:00:00');
			if (empty($tmp[1])) {
				$sql = " AND dateline>$startTime";
			} else {
				$endTime = strtotime($tmp[1].' 23:59:59');
				$sql = " AND dateline>$startTime AND dateline<$endTime";
			}
		}
		if(!empty($type)){
			$sql .= " AND type=$type";
		}
		if ($_G['gp_uid']) {
			$sql .= " AND v.uid='".intval($_G['gp_uid'])."'";
		}
		
		$order = empty($_G['order']) ? 'dateline' : $_G['order'];
		$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('video_list')." v WHERE 1 AND auditstatus=2$sql");
		$query = DB::query("SELECT v.*,if(m.nickname!='',m.nickname,m.username) as nickname FROM ".DB::table('video_list')." 	v
        LEFT JOIN ".DB::table('common_member')." m ON m.uid=v.uid 
		WHERE 1 AND auditstatus=2$sql ORDER BY $order DESC LIMIT $start,$perpage");
		while ($rs = DB::fetch($query)) {
			$rs['image'] = cVideoPic ( $rs, 'big' );
			$list[] = $rs;
		}
	} elseif ($_GET['view'] == 'me') {//我的MY秀
		//搜索条件
		$type = empty($_G['gp_type']) ? 0 : $_G['gp_type'];
		$audit = empty($_G['gp_audit']) ? 0 : $_G['gp_audit'];
		$fanart = empty($_G['gp_fanart']) ? 0 : $_G['gp_fanart'];
		
		$sql = '';
		if ($type) {
			$sql .= " AND type=$type";
		}
		if ($audit) {
			$sql .= " AND auditstatus=$audit";
		}
		if ($fanart) {
			$sql .= " AND isfanart=$fanart";
		}
				
		$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('video_list')." WHERE 1$sql AND uid=".$_G['uid']);
		$query = DB::query("SELECT * FROM ".DB::table('video_list')." WHERE 1$sql AND uid=".$_G['uid']." ORDER BY dateline DESC LIMIT $start,$perpage");
		while ($rs = DB::fetch($query)) {
			$rs['image'] = cVideoPic ( $rs, 'big' );
			$list[] = $rs;
		}
	} elseif ($_GET['view'] == 'we') {//好友的MY秀
		$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('video_list')." WHERE 1 AND auditstatus=2 AND uid IN (SELECT fuid FROM ".DB::table('home_friend')." WHERE uid=".$_G['uid'].")");
		$query = DB::query("SELECT v.*,if(m.nickname!='',m.nickname,m.username) as nickname FROM ".DB::table('video_list')." v
		LEFT JOIN ".DB::table('common_member')." m ON m.uid=v.uid 
		WHERE 1 AND auditstatus=2 AND v.uid IN (SELECT fuid FROM ".DB::table('home_friend')." WHERE uid=".$_G['uid'].") ORDER BY dateline DESC LIMIT $start,$perpage");
		while ($rs = DB::fetch($query)) {
			$rs['image'] = cVideoPic ( $rs, 'big' );
			$list[] = $rs;
		}
	}
	
	$url = "home.php?mod=space&do=myshow";
	if ($_G['gp_uid']) {
		$url .= "&uid=".$_G['gp_uid'];
	}
	if (!empty($classify)) {
		$url .= "&classify=$classify";
	} elseif (!empty($dateline)) {
		$url .= "&time=$dateline";
	} elseif (!empty($type)) {
		$url .= "&view=all&type=$type";
	} else {
		if (isset($_GET['view'])) {
			$url .= "&view=".$_GET['view'];
		}
		if (isset($_GET['order'])) {
			$url .= "&order=".$_GET['order'];
		}
	}
	
	$multi = multi($count, $perpage, $page, $url);
	
	if (!empty($classify)) {
		include_once template("home/space_myshow_classify");
	}elseif (!empty($dateline)) {
		include_once template("home/space_myshow_campaign");
	} else {
		include_once template("home/space_myshow_list");
	}
}