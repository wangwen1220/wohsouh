<?php
define('CURSCRIPT', 'apidb');
require './../source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();
$act = @$_GET['act'];
if(trim($act)=='') die();
$dzUrl = $_GET['dz_url'];
$query = DB::query("SELECT fid FROM ".DB::table('forum_forum')." WHERE fup=".$_G['config']['HS_bbsMap']['a'][0]);
$bbsMapAFid = $_G['config']['HS_bbsMap']['a'][0];
while ($rs = DB::fetch($query)) {$bbsMapAFid.=",".$rs['fid'];}

$query = DB::query("SELECT fid FROM ".DB::table('forum_forum')." WHERE fup=".$_G['config']['HS_bbsMap']['b'][0]);
$bbsMapBFid = $_G['config']['HS_bbsMap']['b'][0];
while ($rs = DB::fetch($query)) {$bbsMapBFid.=",".$rs['fid'];}

$query = DB::query("SELECT fid FROM ".DB::table('forum_forum')." WHERE fup=".$_G['config']['HS_bbsMap']['c'][0]);
$bbsMapCFid = $_G['config']['HS_bbsMap']['c'][0];
while ($rs = DB::fetch($query)) {$bbsMapCFid.=",".$rs['fid'];}

/**
 * 登陆
 */
if ($act=='login'){
	
	
	die('1');
}

/**
 * 热门群组
 */
if($act=='remenqunzu'){
	$sql = "SELECT fid,name,lastpost,icon FROM (SELECT f.fid,f.name,f.lastpost,ff.membernum,ff.icon FROM ".DB::table('forum_forumfield')." ff LEFT JOIN ".DB::table('forum_forum')." f ON f.fid=ff.fid WHERE founderuid>0) t ORDER BY membernum DESC LIMIT 3";
	$query = DB::query($sql);
	$i = 0;
	while ($rs = DB::fetch($query)) {
		if (! empty($rs['lastpost'])) {
			$temp = $rs['lastpost'];
			$rs['lastpost'] = '';
			$rs['lastpost'] = explode("\t", $temp);	
			$rs['lastpost'][2] = dgmdate($rs['lastpost'][2], 'u');
		}
		if (empty($rs['icon'])) {
			$rs['icon'] = $dzUrl.'static/image/common/groupicon.gif';
		}else {
			$rs['icon'] = $dzUrl.'data/attachment/group/'.$rs['icon'];
		}
		$data['group'][$i] = $rs;		
		$i++;
	}
	$data['recomm']=unserialize($_G['setting']['group_recommend']);
	die(json_encode($data));
}
/**
 * 群组热门贴
 */
if ($act=='qunzurementie'){
	$tfid=unserialize($_G['setting']['group_recommend']);
		foreach($tfid as $key => $value) {
		$fid=$value[fid];
		$s.=$fid.',';
	}
	$ss=substr($s,0,-1);
	$query = DB::query("SELECT t.tid,t.subject,f.fid,f.name FROM ".DB::table('forum_thread')." t LEFT JOIN ".DB::table('forum_forum')." f ON t.fid=f.fid WHERE t.displayorder>=0 AND t.fid IN(SELECT fid FROM ".DB::table('forum_forumfield')." WHERE founderuid>0) and t.fid in ($ss) ORDER BY t.views DESC LIMIT 5");
	while ($rs = DB::fetch($query)) 
	{
		$rs['subject'] = cutstr($rs['subject'], 30, '');
		$data['thread'][] = $rs;
	}	
	die(json_encode($data['thread']));
}
/**
 * 明星秀
 */
if ($act=='mingxingxiu'){
	$query = DB::query("SELECT a.uid,a.username,m.username,if(m.nickname!='',m.nickname,m.username) as nickname FROM ".DB::table('home_specialuser')." a LEFT JOIN ".DB::table('common_member')." m on m.uid=a.uid ORDER BY displayorder ASC LIMIT 8");
	
	$i = 0;
	while ($rs = DB::fetch($query)) {
		$data['specialuser'][$i] = $rs;
		$data['specialuser'][$i]['avater'] = str_replace('uc_server/images',$dzUrl.'uc_server/images',avatar($rs['uid'], 'small'));
		$i++;
	}
	die(json_encode($data['specialuser']));
}	
/**
 * 才艺秀
 */

if($act=='caiyixiu'){
	$query = DB::query("SELECT myshowid,title FROM ".DB::table('video_list')." WHERE type=1 && auditstatus=2 ORDER BY viewnum DESC LIMIT 5");
	while ($rs = DB::fetch($query)) {$data['myshow']['audio'][] = $rs;}
	$query = DB::query("SELECT myshowid,title,isrecord,videourl,temp_uid FROM ".DB::table('video_list')." WHERE type=2 && auditstatus=2 ORDER BY viewnum DESC LIMIT 7");
	$i = 0;
	while ($rs = DB::fetch($query)) {
	if ($i <= 1) {
			$rs['pic'] = cVideoPic($rs);
			$data['myshow']['video']['part1'][] = $rs;;
		} else {
			$data['myshow']['video']['part2'][] = $rs;;
		}
		$i++;
	}
	die(json_encode($data['myshow']));
}
/**
 * 精彩日志
 */
if ($act=='jingcairizhi'){
	$rs = DB::fetch_first("SELECT b.blogid,b.subject,b.picflag,b.uid,bf.message,bf.pic FROM ".DB::table('home_blog')." b LEFT JOIN ".DB::table('home_blogfield')." bf ON bf.blogid=b.blogid WHERE picflag=1 AND dateline>".(strtotime("-1 day"))." ORDER BY viewnum DESC LIMIT 1");
	if (!empty($rs)) {
		$rs['message'] = cFilter($rs['message']);
		$data['blog'][] = $rs;
		$notinsql = " AND blogid NOT IN(".$rs['blogid'].")";
	}else {
		$notinsql = '';
	}
	$query = DB::query("SELECT blogid,subject,picflag,uid FROM ".DB::table('home_blog')." WHERE 1".$notinsql." AND dateline>".strtotime("-1 day")." ORDER BY viewnum DESC LIMIT 10");
	while ($rs = DB::fetch($query)) {
		$data['blog'][] = $rs;
	}
	
	die(json_encode($data['blog']));
}
/**
 * 火秀达人
 */

if ($act=='huoxiudaren'){
	$query = DB::query("SELECT m.uid,m.username FROM ".DB::table('common_member_count')." mc LEFT JOIN ".DB::table('common_member')." m ON mc.uid=m.uid ORDER BY mc.threads DESC,mc.posts DESC LIMIT 8");
	$i = 0;
	while ($rs = DB::fetch($query)) {
		$data['member'][$i] = $rs;
		$data['member'][$i]['avater'] = str_replace('uc_server/images',$dzUrl.'uc_server/images',avatar($rs['uid'], 'small'));
		$i++;
	}
	die(json_encode($data['member']));
}

/**
 * 赛事专区--火秀论坛
 */
if ($act=='saishizhuanqu'){
	
	$weektime = strtotime("-14 day");
	
	$i = 0;
	$rs = DB::fetch_first("SELECT tmp.* 
		FROM (
			SELECT p.tid,p.subject,p.message,p.dateline,a.attachment,a.thumb,a.remote FROM ".DB::table('forum_post')." p
			LEFT JOIN ( SELECT tid,attachment,thumb,remote FROM ".DB::table('forum_attachment')." WHERE isimage=1 AND dateline>$weektime GROUP BY tid ORDER BY dateline ASC ) a ON p.tid=a.tid 
			WHERE first=1 AND fid IN(".$bbsMapAFid.") 
			) tmp
		WHERE tmp.attachment != '' 
		ORDER BY tmp.dateline DESC 
		LIMIT 1");
	
	if (!empty($rs)) {
		$rs['message'] = cFilter($rs['message']);
		$rs['message'] = cutstr($rs['message'], 60, '...');
		$data['bbs_a'][$i] = $rs;
		$i++;
		$notinSql = " tid NOT IN(".$rs['tid'].") AND";
	} else {
		$notinSql='';
	}
	#文字
	$query = DB::query("SELECT tid,subject FROM ".DB::table('forum_thread')." WHERE".$notinSql." displayorder>=0 AND fid IN(".$bbsMapAFid.") ORDER BY dateline DESC LIMIT 5");
	while ($rs = DB::fetch($query)) {$data['bbs_a'][$i] = $rs;$i++;}
	$data['sszq_HS_bbsMap0'] = $_G[config][HS_bbsMap]['a'][0];
	$data['sszq_HS_bbsMap1'] = $_G[config][HS_bbsMap]['a'][1];
	die(json_encode($data));
}

/**
 * 专业交流群
 */
if ($act=='zhuanyejiaoliuqu'){
	
	$weektime = strtotime("-14 day");
	
	$i = 0;
	$rs = DB::fetch_first("SELECT tmp.* 
		FROM (
			SELECT p.tid,p.subject,p.message,p.dateline,a.attachment,a.thumb,a.remote FROM ".DB::table('forum_post')." p
			LEFT JOIN ( SELECT tid,attachment,thumb,remote FROM ".DB::table('forum_attachment')." WHERE isimage=1 AND dateline>$weektime GROUP BY tid ORDER BY dateline ASC ) a ON p.tid=a.tid 
			WHERE first=1 AND fid IN(".$bbsMapBFid.") 
			) tmp
		WHERE tmp.attachment != '' 
		ORDER BY tmp.dateline DESC 
		LIMIT 1");
	
	if (!empty($rs)) {
		$rs['message'] = cFilter($rs['message']);
		$rs['message'] = cutstr($rs['message'], 60, '...');
		$data['bbs_b'][$i] = $rs;
		$i++;
		$notinSql = " tid NOT IN(".$rs['tid'].") AND";
	} else {
		$notinSql = '';
	}
	$query = DB::query("SELECT tid,subject FROM ".DB::table('forum_thread')." WHERE".$notinSql." displayorder>=0 AND fid IN(".$bbsMapBFid.") ORDER BY dateline DESC LIMIT 5");
	while ($rs = DB::fetch($query)) {$data['bbs_b'][$i] = $rs;$i++;}
	$data['sszq_HS_bbsMap0'] = $_G[config][HS_bbsMap]['b'][0];
	$data['sszq_HS_bbsMap1'] = $_G[config][HS_bbsMap]['b'][1];
	
	die(json_encode($data));
}
/**
 * 休闲娱乐区
 */
if ($act=='xiuxianyulequ'){
	
	$weektime = strtotime("-14 day");
	
	$i = 0;
	$rs = DB::fetch_first("SELECT tmp.* 
		FROM (
			SELECT p.tid,p.subject,p.message,p.dateline,a.attachment,a.thumb,a.remote FROM ".DB::table('forum_post')." p
			LEFT JOIN ( SELECT tid,attachment,thumb,remote FROM ".DB::table('forum_attachment')." WHERE isimage=1 AND dateline>$weektime GROUP BY tid ORDER BY dateline ASC ) a ON p.tid=a.tid 
			WHERE first=1 AND fid IN(".$bbsMapCFid.") 
			) tmp
		WHERE tmp.attachment != '' 
		ORDER BY tmp.dateline DESC 
		LIMIT 1");
	
	if (!empty($rs)) {
		$rs['message'] = cFilter($rs['message']);
		$rs['message'] = cutstr($rs['message'], 60, '...');
		$data['bbs_c'][$i] = $rs;
		$i++;
		$notinSql = " tid NOT IN(".$rs['tid'].") AND";
	} else {
		$notinSql = '';
	}
	$query = DB::query("SELECT tid,subject FROM ".DB::table('forum_thread')." WHERE".$notinSql." displayorder>=0 AND fid IN(".$bbsMapCFid.") ORDER BY dateline DESC LIMIT 5");
	while ($rs = DB::fetch($query)) {$data['bbs_c'][$i] = $rs;$i++;}
	$data['sszq_HS_bbsMap0'] = $_G[config][HS_bbsMap]['c'][0];
	$data['sszq_HS_bbsMap1'] = $_G[config][HS_bbsMap]['c'][1];
	
	die(json_encode($data));
}
/**
 * 火秀人气榜
 */
if ($act=='huoxiurenqibang'){
	$query = DB::query("SELECT m.uid,m.username,m.credits,mp.gender FROM ".DB::table('common_member')." m LEFT JOIN ".DB::table('common_member_profile')." mp ON m.uid=mp.uid ORDER BY m.credits DESC LIMIT 10");
	while ($rs = DB::fetch($query)) {
		$rs['avatar'] = str_replace('uc_server/images',$dzUrl.'uc_server/images',avatar($rs['uid'], 'small'));
		$data['member_credit'][] = $rs;
	}
	die(json_encode($data));
}
/**
 * 大家在做什么--不要了
 */
if ($act=='dajiazaizuoshenme'){
	die('1');
}
/**
 * 论坛热帖
 */
if ($act=='luntanretie'){
	$i = 0;
	
	$dateline =strtotime("last month");
	$sql = " SELECT a.tid,b.attachment, a.subject,c.message 
	FROM ".DB::table('forum_thread')."  a 
	LEFT JOIN ".DB::table('forum_attachment')." b ON a.tid = b.tid 
	LEFT JOIN ".DB::table('forum_post')." c ON a.tid = c.tid 
	WHERE b.isimage =1 and displayorder>=0 and a.dateline > $dateline and c.message not like '%attach]%'
	ORDER BY `a`.`views` DESC 
	limit 1 ";	
	
	$rs = DB::fetch_first($sql);
	$rs['message'] = strip_tags($rs['message']);
	if (!empty($rs)) {
		$data['bbs_c'][0]=$rs;
		$tid = $rs['tid'];
		$i++;
	}
	
	$sql = "SELECT a.tid, a.subject   
	FROM ".DB::table('forum_thread')."  a 	
	WHERE   displayorder>=0  and a.tid != $tid and a.dateline > $dateline
	ORDER BY `a`.`views` DESC 
	limit 10 ";
	
	$query = DB::query($sql);
	while ($rs = DB::fetch($query)) {$data['bbs_c'][$i] = $rs;$i++;}
	die(json_encode($data));
}
/**
 * 赛事群组
 */

if ($act=='saishiqunzu'){
	
	$topgrouplist = grouplist('activity', array('f.fid', 'f.name', 'ff.membernum', 'ff.icon'), 8);
	
	$hotbbsfungroup=get_hotbbs_fungroup();
	$data['topgrouplist']=$topgrouplist;
	$data['hotbbsfungroup']=$hotbbsfungroup;	
	die(json_encode($data));
}




function get_newbbs_forum() {
	$groupviewed_list = $list = array();
	
	$query = DB::query("SELECT f.fid,f.name,ff.subject,ff.tid FROM ".DB::table('forum_forum')." as f LEFT JOIN ".DB::table('forum_thread')." as ff ON ff.fid=f.fid  where ff.isgroup=0 and f.fid in (57,58,59,60) and ff.displayorder>=0 order by  ff.dateline  desc limit 10");
	//echo "SELECT f.fid,f.name,ff.subject,ff.tid FROM ".DB::table('forum_forum')." as f LEFT JOIN ".DB::table('forum_thread')." as ff ON ff.fid=f.fid  where ff.isgroup=1 order by  ff.dateline  desc limit 10";
	
	while($row = DB::fetch($query)) {
		//if(strlen($row['name'])>12){
		//	$row['name'] =cutstr($row['name'], 12);
		//}
		//if(strlen($row['subject'])>24){
		$row['name']="[".$row['name']."]";
		if(strlen($row['subject'])>32){
			$row['subject'] =cutstr($row['subject'], 22);
		}
		$list[] = $row;
	}
	
	
	return $list;
}

function get_hotbbs_fungroup() {	
	$groupviewed_list = $list = array();
	
	$query = DB::query("SELECT f.fid,f.name,ff.subject,ff.tid FROM ".DB::table('forum_forum')." as f LEFT JOIN ".DB::table('forum_thread')." as ff ON ff.fid=f.fid  where ff.isgroup=1  and ff.displayorder>=0 order by  ff.replies  desc limit 8");
	while($row = DB::fetch($query)) {
		if(strlen($row['name'])>15){
			$row['name'] =cutstr($row['name'], 10);
		}
		if(strlen($row['subject'])>36){
			$row['subject'] =cutstr($row['subject'], 36);
		}
		$list[] = $row;
	}

	
	return $list;
}

function grouplist($orderby = 'displayorder', $fieldarray = array(), $num = 1, $fids = array(), $sort = 0, $getcount = 0, $grouplevel = array()) {

	if($fieldarray && is_array($fieldarray)) {
		$fieldadd = '';
		foreach($fieldarray as $field) {
			$fieldadd .= ' ,'.$field;
		}
	} else {
		$fieldadd = ' ,ff.*';
	}
	$start = 0;
	if(is_array($num)) {
		list($start, $snum) = $num;
	} else {
		$snum = $num;
	}
	$orderbyarray = array('displayorder' => 'f.displayorder DESC', 'dateline' => 'ff.dateline DESC', 'lastupdate' => 'ff.lastupdate DESC', 'membernum' => 'ff.membernum DESC', 'thread' => 'f.threads DESC', 'activity' => 'f.commoncredits DESC');
	$useindex = $orderby == 'displayorder' ? 'USE INDEX(fup_type)' : '';
	$orderby = !empty($orderby) && $orderbyarray[$orderby] ? "ORDER BY ".$orderbyarray[$orderby] : '';
	$limitsql = $num ? "LIMIT $start, $snum " : '';
	$field = $sort ? 'fup' : 'fid';
	$fids = $fids && is_array($fids) ? 'f.'.$field.' IN ('.dimplode($fids).')' : '';

	$grouplist = array();
	if(empty($getcount)) {
		$fieldsql = 'f.fid, f.name, f.threads, f.posts, f.todayposts '.$fieldadd;
	} else {
		$fieldsql = 'count(*)';
		$orderby  = $limitsql = '';
	}
	$query = DB::query("SELECT $fieldsql FROM ".DB::table('forum_forum')." f $useindex ".(empty($getcount) ? " LEFT JOIN ".DB::table("forum_forumfield")." ff ON ff.fid=f.fid" : '' )." WHERE".($fids ? " $fids AND " : '')." f.type='sub' AND f.status=3 $orderby $limitsql");
	$orderid = 0;
	if($getcount) {
		return DB::result($query, 0);
	}
	while($group = DB::fetch($query)) {
		$group['iconstatus'] = $group['icon'] ? 1 : 0;
		isset($group['icon']) && $group['icon'] = get_groupimg($group['icon'], 'icon');
		isset($group['banner']) && $group['banner'] = get_groupimg($group['banner']);
		$group['orderid'] = $orderid ? intval($orderid) : '';
		isset($group['dateline']) && $group['dateline'] = $group['dateline'] ? dgmdate($group['dateline'], 'd') : '';
		isset($group['lastupdate']) && $group['lastupdate'] = $group['lastupdate'] ? dgmdate($group['lastupdate'], 'd') : '';
		$group['level'] = !empty($grouplevel) ? intval($grouplevel[$group['fid']]) : 0;
		isset($group['description']) && $group['description'] = cutstr($group['description'], 130);
		if(strlen($group['name'])>15)
		{
			$group['name']=$group['name'];
		}
		$grouplist[$group['fid']] = $group;
		$orderid ++;
	}

	return $grouplist;
}
function get_groupimg($imgname, $imgtype = '') {
	global $_G;
	$imgpath = $_G['setting']['attachurl'].'group/'.$imgname;
	if($imgname) {
		return $imgpath;
	} else {
		if($imgtype == 'icon') {
			return 'static/image/common/groupicon.gif';
		} else {
			return '';
		}
	}
}