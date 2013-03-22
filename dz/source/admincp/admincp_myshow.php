<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: admincp_share.php 6948 2010-03-27 03:55:01Z chenchunshao $
 */
@session_start();
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

###################
//纠正录制的状态
//DB::update("video_list", array('status'=>4), "isrecord=1 AND status=5");
###################

$detail = $_G['gp_detail'];
$uid = $_G['gp_uid'];
$users = $_G['gp_users'];
$title=$_G['gp_title'];
$sid = $_G['gp_sid'];
$type = isset($_G['gp_type']) ? $_G['gp_type'] : 'all';
$isfanart = isset($_G['gp_isfanart']) ? $_G['gp_isfanart'] : 'all';
$recommand = isset($_G['gp_recommand']) ? $_G['gp_recommand'] : 'all';
$feifa = isset($_G['gp_feifa']) ? $_G['gp_feifa'] : 'all';
$hot1 = $_G['gp_hot1'];
$hot2 = $_G['gp_hot2'];
$reply1= $_G['gp_reply1'];
$reply2= $_G['gp_reply2'];
$starttime = $_G['gp_starttime'];
$endtime = $_G['gp_endtime'];
$searchsubmit = $_G['gp_searchsubmit'];
$sids = $_G['gp_sids'];
$ppp = $_G['ppp'];

if ($operation == 'recommand') {
	$myshowid = $_G['gp_myshowid'];
	$v = $_G['gp_v'];
	if ($myshowid > 0 && ($v == 0 || $v == 1)) {
		$myshowInfo = DB::fetch_first("SELECT * FROM ".DB::table('video_list')." WHERE myshowid=$myshowid");
		if (! empty($myshowInfo)) {
			$back = DB::update('video_list', array('recommand'=>$v), "myshowid=$myshowid");
			//加积分
			if ($v == 0) {//取消
				updatecreditbyaction('myshow_cancel', $myshowInfo['uid']);
			} elseif ($v == 1) {
				updatecreditbyaction('myshow_recommand', $myshowInfo['uid']);
			}
			echo $v+1;
		}
	}
	die;
}
?>
<script src="static2/js/jquery.min.js" type="text/javascript"></script>
<?php
cpheader();
if($operation == 'verification'){ 

	if(!submitcheck('modsubmit')) {

		require_once libfile('function/discuzcode');

		$tpp = 10;
		$start_limit = ($page - 1) * $tpp;
		
		
		
		$filteroptions = '<option value="0" >'.$lang['video_none'].'</option>';
		$videotype=DB::query("select * from ".DB::table('video_type'));
		//if($_GET['filter']==1){
		//	$check1="checked";
		//}elseif($_GET['filter']==2){
		//	$check2="checked";
		//}
		$checkfilter=$_GET['filter'];
		while($rideorow=DB::fetch($videotype)){
			if($checkfilter==$rideorow['id']){
				$checked="selected";
			}
			$filteroptions.='<option value="'.$rideorow[id].'" '.$checked.'>'.$rideorow[name].'</option>';
			unset($checked);
		}
		
		if($checkfilter){
			$modcount = DB::num_rows(DB::query("SELECT a.*,b.name as tname,c.name as cname 
				FROM ".DB::table('video_list')." a
				LEFT JOIN ".DB::table('video_type')." b ON a.type=b.id
				LEFT JOIN ".DB::table('video_classify')." c ON c.id=a.classify
				WHERE isrecord!=3 and auditstatus=1 and a.type= ".$checkfilter));
			$sql="SELECT a.*,b.name as tname,c.name as cname 
				FROM ".DB::table('video_list')." a
				LEFT JOIN ".DB::table('video_type')." b ON a.type=b.id
				LEFT JOIN ".DB::table('video_classify')." c ON c.id=a.classify
				WHERE isrecord!=3 and auditstatus=1 and a.type= ".$checkfilter." ORDER BY a.dateline DESC LIMIT $start_limit, $tpp";
		}
		else{
			$modcount = DB::num_rows(DB::query("SELECT a.*,b.name as tname,c.name as cname 
				FROM ".DB::table('video_list')." a
				LEFT JOIN ".DB::table('video_type')." b ON a.type=b.id
				LEFT JOIN ".DB::table('video_classify')." c ON c.id=a.classify
				WHERE isrecord!=3 and auditstatus=1 "));
			$sql="SELECT a.*,b.name as tname,c.name as cname 
				FROM ".DB::table('video_list')." a
				LEFT JOIN ".DB::table('video_type')." b ON a.type=b.id
				LEFT JOIN ".DB::table('video_classify')." c ON c.id=a.classify
				WHERE isrecord!=3 and auditstatus=1 ORDER BY a.dateline DESC LIMIT $start_limit, $tpp";
		}
		$multipage = multi($modcount, $tpp, $page, ADMINSCRIPT."?action=myshow&operation=verification&filter=$checkfilter&modfid=$modfid");
		
		shownav('topic', $lang['myshow_threads']);
		showsubmenu('myshow_threads', array(
			array('nav_moderate_users_mod', 'myshow&operation=verification', 1),
			array('nav_myshow_threads', 'myshow&operation=threads', 0)
		));
		showformheader("myshow&operation=verification&page=$page");
		showhiddenfields(array('ignore' => $ignore, 'filter' => $filter, 'modfid' => $modfid));
		showtableheader("$lang[video_select_list]: <select style=\"margin: 0px;\" onchange=\"if(this.options[this.selectedIndex].value != '') {window.location='".ADMINSCRIPT."?action=myshow&operation=verification&modfid=$modfid&filter='+this.options[this.selectedIndex].value;}\">$filteroptions</select>
		");
		$query = DB::query($sql);
		while($thread = DB::fetch($query)) {
			$status=$thread['status'];
			
			$convert_status = 'convert_'.$status;
			$thread['status'] = $lang[$convert_status];
			
			switch ($thread['isfanart']){
				case "0":
					$thread[isfanart]=$lang[no];
					break;
				case "1":
					$thread[isfanart]=$lang[yes];
					break;	
			}
			switch ($thread['language']){
				case "9":
					$thread[language]=$lang[language9];
					break;
				case "1":
					$thread[language]=$lang[language1];
					break;	
				case "2":
					$thread[language]=$lang[language2];
					break;
				case "3":
					$thread[language]=$lang[language3];
					break;
				case "4":
					$thread[language]=$lang[language4];
					break;
				case "5":
					$thread[language]=$lang[language5];
					break;
			}
			//$thread[dateline]=date("Y-m-d H:i:j",$thread[dateline]);
			$thread[dateline] = dgmdate($thread[dateline]);
			if($status==4){
				showtablerow("id=\"mod_$thread[myshowid]_row1\"", array('rowspan="3" class="rowform threadopt" style="width:80px;"', 'class="threadtitle"'), array(
					"<ul class=\"nofloat\"><li><label for=\"mod_$thread[myshowid]_1\">$thread[status]</label></li><li><input class=\"radio\" type=\"radio\" name=\"moderate[$thread[myshowid]]\" id=\"mod_$thread[myshowid]_1\" value=\"validate\" checked=\"checked\" onclick=\"mod_setbg($thread[myshowid], 'validate');\"><label for=\"mod_$thread[myshowid]_1\">$lang[validate]</label></li><li><input class=\"radio\" type=\"radio\" name=\"moderate[$thread[myshowid]]\" id=\"mod_$thread[myshowid]_2\" value=\"delete\" onclick=\"mod_setbg($thread[myshowid], 'delete');\"><label for=\"mod_$thread[myshowid]_2\">$lang[delete]</label></li></ul>",
					"<h3><a href=\"home.php?mod=space&do=myshow&id=$thread[myshowid]\" target=\"_blank\">$thread[title]</a> &raquo;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href=\"home.php?mod=space&do=myshow&id=$thread[myshowid]\" target=\"_blank\">$lang[lookvideo]</a></h3><p><span class=\"bold\">$lang[author]:</span> $thread[author] ($thread[ip]) &nbsp;&nbsp; <span class=\"bold\">$lang[time]:</span> $thread[dateline]&nbsp;&nbsp; <span class=\"bold\">$lang[type]:</span> $thread[tname]</p>"
				));
			}else{
				showtablerow("id=\"mod_$thread[myshowid]_row1\"", array('rowspan="3" class="rowform threadopt" style="width:80px;"', 'class="threadtitle"'), array(
					"<ul class=\"nofloat\"><li><label for=\"mod_$thread[myshowid]_1\">$thread[status]</label></li></ul>",
					"<h3><a href=\"home.php?mod=space&do=myshow&id=$thread[myshowid]\" target=\"_blank\">$thread[title]</a> &raquo;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3><p><span class=\"bold\">$lang[author]:</span> $thread[author] ($thread[ip]) &nbsp;&nbsp; <span class=\"bold\">$lang[time]:</span> $thread[dateline]&nbsp;&nbsp; <span class=\"bold\">$lang[type]:</span> $thread[tname]</p>"
				));
			}
			showtablerow("id=\"mod_$thread[myshowid]_row2\"", 'colspan="2" style="padding: 10px; line-height: 180%;"', '<div style="overflow: auto; overflow-x: hidden; max-height:120px; height:auto !important; height:120px; word-break: break-all;"><p><span class="bold">'.$lang[videoclassify].':</span>'. $thread[cname].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="bold">'.$lang[videolang].':</span> '.$thread[language].'</p><p><span class="bold">'.$lang[videofanart].':</span>'. $thread[isfanart].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="bold">'.$lang[videoformat].':</span> '.$thread[format].'('.$thread[size].')</p></div>');
			showtablerow("id=\"mod_$thread[myshowid]_row3\"", 'class="threadopt threadtitle" colspan="2"', "<a href=\"forum.php?mod=post&action=edit&fid=$thread[myshowid]&tid=$thread[myshowid]&pid=$thread[myshowid]&page=1&modthreadkey=$thread[modthreadkey]\" target=\"_blank\"></a> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; <input type=\"hidden\" class=\"txt\" name=\"pm_$thread[myshowid]\" id=\"pm_$thread[myshowid]\" style=\"margin: 0px;\"> &nbsp;");
			
			
		}

		showsubmit('modsubmit', 'submit', '', '', $multipage);
		showtablefooter();
		showformfooter();

	} else {
			$vcount=0;
			$dcount=0;
			$moderate=$_POST['moderate'];
			$time=strtotime("now");
			$timeweek=$time-7*86400;
			foreach ($moderate as $key => $value){
				if($value=="validate"){					
					DB::update('video_list', array('auditstatus' => 2), array('myshowid' => $key));
					
					#增加积分
					$myshowInfo = DB::fetch_first("SELECT * FROM ".DB::table('video_list')." WHERE myshowid=$key"); 
					if (!empty($myshowInfo)) {
						updatecreditbyaction('myshow', $myshowInfo['uid']);
					}
					
					require_once libfile('function/feed');
					feed_publish($key, "myshowid", $add=0);
					$query=DB::query("select * from ".DB::table('video_list')." where isrecord!=3 and myshowid='$key'");
					$rs=DB::fetch($query);
					$query=DB::query("select * from ".DB::table('video_field')." where uid='$rs[uid]'");
					if($row=DB::fetch($query)){
						$querycount=DB::query("select count(*) as count from ".DB::table('video_list')." where isrecord!=3 and uid='$rs[uid]' and type='$rs[type]' and dateline>'$timeweek' and dateline<'$time'");
						$weekcount=DB::fetch($querycount);
						if($rs['type']==1){
							if($rs['isfanart']==1){
								DB::query("UPDATE ".DB::table('video_field')." SET myshowid='$key', weekaudio='$weekcount[count]' ,audioid='$key',totalnum=totalnum+1,audionum=audionum+1,fanartnum=fanartnum+1 WHERE uid='$row[uid]'");
							}else{
								DB::query("UPDATE ".DB::table('video_field')." SET myshowid='$key', weekaudio='$weekcount[count]' ,audioid='$key',totalnum=totalnum+1,audionum=audionum+1 WHERE uid='$row[uid]'");
							}
							
						}else{
							if($rs['isfanart']==1){
								DB::query("UPDATE ".DB::table('video_field')." SET myshowid='$key', weekvideo='$weekcount[count]', videoid='$key',totalnum=totalnum+1,videonum=videonum+1,fanartnum=fanartnum+1 WHERE uid='$row[uid]'");
							}else{
								DB::query("UPDATE ".DB::table('video_field')." SET myshowid='$key', weekvideo='$weekcount[count]' ,videoid='$key',totalnum=totalnum+1,videonum=videonum+1 WHERE uid='$row[uid]'");
							}
						}
					}else{
						if($rs['type']==1){
							if($rs['isfanart']==1){
								DB::insert('video_field', array('uid' => $rs[uid], 'username' => $rs[author], 'myshowid' => $key, 'weekaudio' => 1, 'audioid' => $key,'totalnum' => 1,'audionum' => 1,'fanartnum' => 1));
							}else{
								DB::insert('video_field', array('uid' => $rs[uid], 'username' => $rs[author], 'myshowid' => $key, 'weekaudio' => 1, 'audioid' => $key,'totalnum' => 1,'audionum' => 1));
							}
						}else{
							if($rs['isfanart']==1){
								DB::insert('video_field', array('uid' => $rs[uid], 'username' => $rs[author], 'myshowid' => $key, 'weekvideo' => 1, 'videoid' => $key,'totalnum' => 1,'videonum' => 1,'fanartnum' => 1));
							}else{
								DB::insert('video_field', array('uid' => $rs[uid], 'username' => $rs[author], 'myshowid' => $key, 'weekvideo' => 1, 'videoid' => $key,'totalnum' => 1,'videonum' => 1));
							}
						}
					}
					
					$vcount++;
				}else{
					DB::delete('video_list', "myshowid='$key'");
					
					#删除积分
					$myshowInfo = DB::fetch_first("SELECT * FROM ".DB::table('video_list')." WHERE myshowid=$key"); 
					if (!empty($myshowInfo) && $myshowInfo['auditstatus']==2) {
						updatecreditbyaction('delmyshow', $myshowInfo['uid']);
					}
					$ftphost="res1.netwaymedia.com";
					$ftpport=21;
					$ftpusername="huoshow";
					$ftppassword="huoshow!ab!789";
					$conn = ftp_connect("res1.netwaymedia.com") or die("Could not connect");
					ftp_login($conn,$ftpusername,$ftppassword);
				
					ftp_delete($conn,"pub/saishi/".$myshowInfo['uid']."/".$myshowInfo['videourl']);
					
					ftp_close($conn);
					
					$dcount++;
				}
			}
			cpmsg('moderate_threads_succeed', 'action=myshow&operation=verification', 'succeed', array('validates' => $vcount, 'ignores' => 0, 'recycles' => 0, 'deletes' => $dcount));

	}
}
if($operation == 'delete'){
	$delete=$_POST['delete'];
	$id=implode(",",$delete);
	
	$query = DB::query("SELECT * FROM ".DB::table('video_list')." WHERE myshowid IN($id)");
	while($rs = DB::fetch($query)) {
		#删除积分
		if ($rs['auditstatus']==2) {
			updatecreditbyaction('delmyshow', $rs['uid']);
		}
	}
	
	DB::delete('video_list', "myshowid in ($id) ");
	
	//cpmsg('moderate_threads_succeed', 'action=myshow&operation=threads', 'succeed');
	cpmsg('founder_perm_member_update_succeed', 'action=myshow&operation=threads', 'succeed');
}
if($operation == 'threads'){
	
if(!submitcheck('sharesubmit')) {

	$starttime = !preg_match("/^(0|\d{4}\-\d{1,2}\-\d{1,2})$/", $starttime) ? dgmdate(TIMESTAMP - 86400 * 7, 'Y-n-j') : $starttime;
	$endtime = $_G['adminid'] == 3 || !preg_match("/^(0|\d{4}\-\d{1,2}\-\d{1,2})$/", $endtime) ? dgmdate(TIMESTAMP, 'Y-n-j') : $endtime;

	
	shownav('topic', $lang['myshow_threads']);
		showsubmenu('myshow_threads', array(
			array('nav_moderate_users_mod', 'myshow&operation=verification', 1),
			array('nav_myshow_threads', 'myshow&operation=threads', 0)
		));
	showsubmenusteps('', array(

		array('share_search', !$searchsubmit),
		array('nav_share', $searchsubmit)
	));
	//showtips('share_tips');
	echo <<<EOT
<script type="text/javascript" src="static/js/calendar.js"></script>
<script type="text/JavaScript">
function page(number) {
	$('shareforum').page.value=number;
	$('shareforum').searchsubmit.click();
}
</script>
EOT;
	showtagheader('div', 'searchposts', !$searchsubmit);
	showformheader("myshow&operation=threads", '', 'shareforum');
	showhiddenfields(array('page' => $page));
	showtableheader();
	//showsetting('share_search_detail', 'detail', $detail, 'radio');
	showsetting('share_search_uid', 'uid', $uid, 'text');
	showsetting('myshow_search_title', 'title', $title, 'text');
	showsetting('myshow_search_type', array('type', array( array('all','全部'), array('1', '音频'), array('2', '视频') ) ), $type, 'mradio');
	showsetting('myshow_search_isfanart', array('isfanart', array( array('all','全部'), array('1', '原创'), array('0', '非原创') ) ), $isfanart, 'mradio');
	showsetting('myshow_search_recommand', array('recommand', array( array('all','全部'), array('1', '推荐'), array('0', '未推荐') ) ), $recommand, 'mradio');
	showsetting('myshow_search_feifa', array('feifa', array( array('all','全部'), array('1', '是'), array('0', '否') ) ), $feifa, 'mradio');
	//showsetting('myshow_search_sid', 'sid', $sid, 'text');
	//showsetting('share_search_icon', 'type', $type, 'text');
	showsetting('myshow_search_hits', array('hot1', 'hot2'), array($hot1, $hot2), 'range');
	showsetting('myshow_search_reply', array('reply1', 'reply2'), array($reply1, $reply2), 'range');
	showsetting('share_search_time', array('starttime', 'endtime'), array($starttime, $endtime), 'daterange');
	showsubmit('searchsubmit');
	showtablefooter();
	showformfooter();
	showtagfooter('div');

} else {
	$sids = authcode($sids, 'DECODE');
	echo $sids;
	$sidsadd = $sids ? explode(',', $sids) : $_G['gp_delete'];
	include_once libfile('function/delete');
	$deletecount = count(deleteshares($sidsadd));
	$cpmsg = cplang('share_succeed', array('deletecount' => $deletecount));

?>
<script type="text/JavaScript">alert('<?=$cpmsg?>');parent.$('shareforum').searchsubmit.click();</script>
<?php

}

if(submitcheck('searchsubmit')) {
?>
<script type="text/javascript">
(function($){
	myshowrcommand = function (myshowid, v){
		$.get("admin.php?action=myshow&operation=recommand&myshowid="+myshowid+"&v="+v,function(data){
			if(data == 1) {$("#myshowid_"+myshowid).html("未推荐");}
			else if(data == 2) {$("#myshowid_"+myshowid).html("已推荐");}
		});
	}
})(jQuery);
</script>
<?php
	//$myshowtype=$_GET['type'];
	//echo $myshowtype;
	$sids = $sharecount = '0';
	$sql = $error = '';
	$users = trim($users);
	
	if($type && $type != 'all') {
		$sql .= " AND s.type='$type'";
	}

	//原创，推荐，非法数据
	if ($isfanart && $isfanart != 'all') {
		$sql .= " AND s.isfanart='1'";
	}
	if ($recommand && $recommand != 'all') {
		$sql .= " AND s.recommand='1'";
	}
	if ($feifa != 'all') {
		$sql .= $feifa==1 ? " AND s.status='-1'" : " AND s.status!='-1'";
	}
	
	if($starttime != '0') {
		$starttime = strtotime($starttime);
		$sql .= " AND s.dateline>'$starttime'";
	}

	//if($_G['adminid'] == 1 && $endtime != dgmdate(TIMESTAMP, 'Y-n-j')) {
		if($endtime != '0') {
			$endtime = strtotime($endtime);
			$sql .= " AND s.dateline<'$endtime'";
		}
	//} else {
	//	$endtime = TIMESTAMP;
	//}

	if($sid != '') {
		$sids = '-1';
		$query = DB::query("SELECT id FROM ".DB::table('video_list')." WHERE id IN ('".str_replace(',', '\',\'', str_replace(' ', '', $sid))."')");
		while($arr = DB::fetch($query)) {
			$sids .= ",$fidarr[id]";
		}
		$sql .= " AND  s.id IN ($sids)";
	}

	if($uid != '') {
		$uids = '-1';
		$query = DB::query("SELECT uid FROM ".DB::table('video_list')." WHERE uid IN ('".str_replace(',', '\',\'', str_replace(' ', '', $uid))."')");
		while($uidarr = DB::fetch($query)) {
			$uids .= ",$uidarr[uid]";
		}
		$sql .= " AND s.uid IN ($uids)";
	}

	$sql .= $hot1 ? " AND s.hits >= '$hot1'" : '';
	$sql .= $hot2 ? " AND s.hits <= '$hot2'" : '';

	$sql .= $reply1 ? " AND s.reply >= '$reply1'" : '';
	$sql .= $reply2 ? " AND s.reply <= '$reply2'" : '';
	if(($_G['adminid'] == 2 && $endtime - $starttime > 86400 * 16) || ($_G['adminid'] == 3 && $endtime - $starttime > 86400 * 8)) {
		$error = 'share_mod_range_illegal';
	}
	if(!$error) {	
		//echo 	"SELECT s.*,b.name as tname FROM ".DB::table('video_list')." s  LEFT JOIN ".DB::table('video_type')." b ON s.type=b.id WHERE 1 $sql ORDER BY s.dateline DESC LIMIT ".(($pagetmp - 1) * $ppp).",{$ppp}";
			$pagetmp = $page;
			do{
				$query = DB::query("SELECT s.*,b.name as tname FROM ".DB::table('video_list')." s  LEFT JOIN ".DB::table('video_type')." b ON s.type=b.id WHERE 1 $sql ORDER BY s.dateline DESC LIMIT ".(($pagetmp - 1) * $ppp).",{$ppp}");
				$pagetmp--;
			} while(!DB::num_rows($query) && $pagetmp);
			$shares = '';

			require_once libfile('function/share');
			$sids='-1';
			while($share = DB::fetch($query)) {
				if ($share['recommand']) {
					$recommandStr = '<span id="myshowid_'.$share['myshowid'].'">已推荐</span>';
				} else {
					$recommandStr = '<span id="myshowid_'.$share['myshowid'].'">未推荐</span>';
				}
				if ($share['isfanart']) {
					$isfanartStr = '是';
				} else {
					$isfanartStr = '否';
				}
				if ($share['status'] == -1) {
					$optStr = '非法数据';
				} elseif ($share['auditstatus']==2 && $share['status'] == 4) {
					$optStr = '<a href="#." onclick="myshowrcommand('.$share['myshowid'].',1)">推荐</a>  <a href="#." onclick="myshowrcommand('.$share['myshowid'].',0)">取消推荐</a>';
				} else {
					$optStr = '待审中';
				}
				$share['dateline'] = dgmdate($share['dateline']);
				$share = mkshare($share);
				$sids .= ','.$share['myshowid'];
				$shares .= showtablerow('', '', array(
					"<input class=\"checkbox\" type=\"checkbox\" name=\"delete[]\" value=\"$share[myshowid]\" />",
					$share['tname'],
					"<a href=\"home.php?mod=space&uid=$share[uid]\" target=\"_blank\">".$share['author']."</a>",
					"<a href=\"home.php?mod=space&uid=$share[uid]&do=myshow&id=$share[myshowid]\" target=\"_blank\">".$share['title']."</a>",
					$share['viewnum'],
					$share['reply'],
					$share['dateline'],
					$isfanartStr,
					$recommandStr,
					$optStr
				), TRUE);
				
			}
			//echo $sids;
			$sharecount = DB::result_first("SELECT count(*) FROM ".DB::table('video_list')." s WHERE 1 $sql");
			$multi = multi($sharecount, $_G['ppp'], $page, ADMINSCRIPT."?action=myshow");
			$multi = preg_replace("/href=\"".ADMINSCRIPT."\?action=myshow&amp;page=(\d+)\"/", "href=\"javascript:page(\\1)\"", $multi);
			$multi = str_replace("window.location='".ADMINSCRIPT."?action=myshow&amp;page='+this.value", "page(this.value)", $multi);

		if(!$sharecount) {
			$error = 'share_post_nonexistence';
		}
	}

	showtagheader('div', 'postlist', $searchsubmit);
	showformheader('myshow&operation=delete', '');
	showhiddenfields(array('sids' => authcode($sids, 'ENCODE')));
	showtableheader(cplang('share_result').' '.$sharecount.' <a href="###" onclick="$(\'searchposts\').style.display=\'\';$(\'postlist\').style.display=\'none\';" class="act lightlink normal">'.cplang('research').'</a>', 'fixpadding');

	if($error) {
		echo "<tr><td class=\"lineheight\" colspan=\"15\">$lang[$error]</td></tr>";
	} else {
		
		showsubtitle(array('', 'myshow_search_type','author', 'myshow_title', 'myshow_search_hits', 'myshow_search_reply', 'time', 'myshow_search_isfanart', 'myshow_search_recommand',''));
		echo $shares;
	
	}
	showsubmit('myshowsubmit', 'delete', 'del', '', $multi);
	showtablefooter();
	showformfooter();
	echo '<iframe name="shareframe" style="display:none"></iframe>';
	showtagfooter('div');

}
}
?>