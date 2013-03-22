<?php
define('CURSCRIPT', 'apidb');
require './../source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();
$act = @$_GET['act'];
if(trim($act)=='') die();
//$dzUrl = 'http://dev.huoshow.com/';
$dzUrl = $_GET['dz_url'];
/**
 * 登陆
 */
if ($act=='login'){
		
	die('1');
}

//今日必看
  /*if($act=='pages'){
		
        $query_news=DB::query("select * from ".DB::table('web_index_news_top')."");
		$rs_news = DB::fetch($query_news);
		if(!empty($rs_news['content']))
		{
			$rs_news['content']=unserialize($rs_news['content']);
			//unset($rs_news['content']['index_top_news_value']);
			//unset($rs_news['content']['saishi_top_news_value']);
			
			foreach ($rs_news['content'] as $key=>$value)
			{
				if($key=='my_today_top_news_value')
				{
					$key="todaylist";
				}
				elseif($key=='my_video_top_news_value')
				{
					$key="autodyne";
				}
				elseif($key=='my_music_top_news_value')
				{
					$key="cover";
				}
				else 
				{
					continue;
				}
				$query=DB::query("select * from ".DB::table('video_list'). "  where  auditstatus=2 and myshowid in (".$value.")");
								
				//echo "select * from ".DB::table('video_list'). "  where  auditstatus=2 and myshowid in $value";
				while($rs = DB::fetch($query)){

					$rs['title']=cutstr($rs['title'],16);
					$rs['image']= cVideoPic($rs, 'middle');
					
					$todaylist[$key][]=$rs;
					$data[$key] = $todaylist;
				die(json_encode($data[$key]));
				}
			}
			
		}
	}*/
	//原创达人
	if($act=='daren'){
	//原创、音频、视频
		$query=DB::query("select count(*) as count from ".DB::table('video_list'). "  where isfanart=1 and auditstatus=2");
		$fanart = DB::fetch($query);
		$data['fanart']=$fanart;
		//echo "select count(*) as count from ".DB::table('video_list'). "  where isfanart=1 and auditstatus=2";
		
		$query=DB::query("select count(*) as count from ".DB::table('video_list'). "  where type=1 and auditstatus=2 ");
		$audionum = DB::fetch($query);
		$data['audionum']=$audionum;
		$query=DB::query("select count(*) as count from ".DB::table('video_list'). "  where type=2 and auditstatus=2");
		$videonum = DB::fetch($query);
		$data['videonum']=$videonum;
		//原创达人
		$dateline = strtotime("-1 month");
		$sql ="select *,count(1) as num FROM ( select v.uid, if(m.nickname!='',m.nickname,m.username) as nickname from ".DB::table('video_list')." v 
		LEFT JOIN ".DB::table('common_member')." m ON m.uid=v.uid 
		where dateline > $dateline and isfanart=1 ) as monthly_data group by uid order by num desc limit 6 ";
		$query = DB::query($sql);
		//$query=DB::query("select uid,count(1) as num, author as username from ".DB::table('video_list'). " where isfanart =1 GROUP BY uid order by num desc limit 6");
		//echo "select uid,username from ".DB::table('video_field'). "  order by fanartnum desc limit 6";
		while($rs = DB::fetch($query)){
		$rs['avatar'] = avatar($rs['uid'], 'small');
			$hotmember[]=$rs;
			
			//print_r($hotmember[]);
			$data['daren']=$hotmember;
			
		}
		die(json_encode($data));
	
	}
	
	//网友视频
	
	if($act=='shipinqu'){
	
	$query=DB::query("select v.*,if(m.nickname!='',m.nickname,m.username) as nickname from ".DB::table('video_list'). " v
	LEFT JOIN ".DB::table('common_member')." m ON m.uid=v.uid
	where type=2  and auditstatus=2 and recommand=1 order by dateline desc limit 20 ");
		while($rs = DB::fetch($query)){
			
			$rs['image']=cVideoPic($rs);
			$rs['title']=cutstr($rs['title'],16);
			$time=explode(":",$rs['timelength']);
			if($time[0]=="00"){
				$rs['timelength']=$time[1].":".$time[2];
			}
			$netvideo[]=$rs;
			$data=$netvideo;
			
		}
		die(json_encode($data));
	}
	
	
	if($act=='yinpinqu'){
	//网友音频
		$query=DB::query("select v.*,if(m.nickname!='',m.nickname,m.username) as nickname from ".DB::table('video_list'). " v 
		LEFT JOIN ".DB::table('common_member')." m ON m.uid=v.uid
		where type=1 and isfanart=1  and auditstatus=2 and recommand=1 order by dateline desc  limit 9 ");
		while($rs = DB::fetch($query)){
			$rs['title']=cutstr($rs['title'],16);
			$rs['avatar'] = avatar($rs['uid'], 'small');
			$hotaudio[]=$rs;
			$data['aa']=$hotaudio;
			//die(json_encode($hotaudio));
		}
		
				//原创热榜
		$query=DB::query("select v.*,if(m.nickname!='',m.nickname,m.username) as nickname from ".DB::table('video_list'). " v
		LEFT JOIN ".DB::table('common_member')." m ON m.uid=v.uid
		where type=1 and auditstatus=2 and recommand=1 order by dateline DESC limit 0,40 ");
		//echo "select * from ".DB::table('video_list'). " where type=1 and auditstatus=2 order by viewnum desc limit 0,10 ";
		while($rs = DB::fetch($query)){
			$rs['title']=cutstr($rs['title'],16);
			$netaudio[]=$rs;
			$data['bb']=$netaudio;
		
		}
	
		die(json_encode($data));
	}
	
	
	if($act=='myshow'){
	//原创、音频、视频
		$query=DB::query("select count(*) as count from ".DB::table('video_list'). "  where isfanart=1 and auditstatus=2");
		$fanart = DB::fetch($query);
		$data['fanart']=$fanart;
		//echo "select count(*) as count from ".DB::table('video_list'). "  where isfanart=1 and auditstatus=2";
		
		$query=DB::query("select count(*) as count from ".DB::table('video_list'). "  where type=1 and auditstatus=2 ");
		$audionum = DB::fetch($query);
		$data['audionum']=$audionum;
		$query=DB::query("select count(*) as count from ".DB::table('video_list'). "  where type=2 and auditstatus=2");
		$videonum = DB::fetch($query);
		$data['videonum']=$videonum;
		
		die(json_encode($data));
	
	}
   ////达人特区
   if($act=='darenqu'){
   	//音乐达人
		$dateline = strtotime("-1 month");
  $sql="select uid,nickname,title, myshowid, FROM_UNIXTIME(dateline) as time, count(1) as num from
  (select v.uid,v.title, v.myshowid,v.dateline,if(m.nickname!='',m.nickname,m.username) as nickname from ".DB::table('video_list'). " v
  LEFT JOIN ".DB::table('common_member')." m ON m.uid=v.uid 
  where dateline > $dateline and type=1 order by dateline desc ) as monthly_data group by uid order by num desc limit 8";
  $query = DB::query($sql);
 
  		while($rs = DB::fetch($query)){
			
			$rs['image']="static2/images/audio_default.png"; 
			$rs['title']=cutstr($rs['title'],16);
			$rs['avatar'] = avatar($rs['uid'], 'small');
			
			$audiomember[]=$rs;
			$data['audiomember']=$audiomember;		
			
		}
		
		//视频达人
		$dateline = strtotime("-1 month");
  $sql="select uid,nickname,title, myshowid, FROM_UNIXTIME(dateline) as time, count(1) as num from
  (select v.uid,v.title, v.myshowid, v.dateline,if(m.nickname!='',m.nickname,m.username) as nickname  from ".DB::table('video_list'). " v
  LEFT JOIN ".DB::table('common_member')." m ON m.uid=v.uid 
  where dateline > $dateline and type=2 order by dateline desc ) as monthly_data group by uid order by num desc limit 8";
  $query = DB::query($sql);
 
  		while($rs = DB::fetch($query)){
		
			
				$rs['title']=cutstr($rs['title'],16);
				$rs['avatar'] = avatar($rs['uid'], 'small');
				$videomember[]=$rs;
				$data['videomember']=$videomember;
		
        
        }
      die(json_encode($data));
   }
   //最新发布视频
   if($act=='fabus'){
		$query=DB::query("select v.*,if(m.nickname!='',m.nickname,m.username) as nickname from ".DB::table('video_list'). "  v	
         LEFT JOIN ".DB::table('common_member')." m ON m.uid=v.uid 
		where auditstatus=2 and type=2 order by dateline desc limit 5");
		while($rs = DB::fetch($query)){
			$rs['image']=ftpimg($rs['type'],$rs['isrecord'],$rs['videourl'],$rs['uid']);
			$rs['dateline']=date("Y-m-d H:i:s",$rs['dateline']);
			$rs['title']=cutstr($rs['title'],16);
			$newlist[]=$rs;
			$data=$newlist;
		} 
		  die(json_encode($data));
   }
	
 //最新发布音频
   if($act=='fabuy'){
		$query=DB::query("select v.*,if(m.nickname!='',m.nickname,m.username) as nickname from ".DB::table('video_list'). "  v
		LEFT JOIN ".DB::table('common_member')." m ON m.uid=v.uid		
		where auditstatus=2 and type=1 order by dateline desc limit 10");
		while($rs = DB::fetch($query)){
			$rs['image']=ftpimg($rs['type'],$rs['isrecord'],$rs['videourl'],$rs['uid']);
			$rs['dateline']=date("Y-m-d H:i:s",$rs['dateline']);
			$rs['title']=cutstr($rs['title'],30);
			$newlist[]=$rs;
			$data=$newlist;
		} 
		  die(json_encode($data));
   }
		
		
 //if($act=='page1'){
 // $query_news=DB::query("select * from ".DB::table('web_index_news_top')." where id=1");
	//	$rs_news = DB::fetch($query_news);
//		$data = $rs_news;
	//die(json_encode($data));
// }
 

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
