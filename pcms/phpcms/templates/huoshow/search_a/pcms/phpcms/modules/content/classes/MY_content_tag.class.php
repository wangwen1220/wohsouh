<?php
class MY_content_tag extends content_tag
{
	//注意，content_tag把$db设置成private，要改为protected
	function __construct() 
    {         
    	parent::__construct();
    } 
    
    /**
     * 获取论坛点击最高的信息
     */
    public function get_click_high($data){
		global $SYSCONFIG;
    	require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php";
    	$dblink = new DataBase("");
    	$limit = $data['order'];
    	if ($data['img'] == '1'){
    		$sql = "SELECT * FROM pre_forum_thread a INNER JOIN pre_forum_attachment b ON a.tid=b.tid WHERE a.closed=0 AND a.attachment!=0 ORDER BY views DESC $limit";
    	}else {
    		$sql = "SELECT * FROM pre_forum_thread WHERE closed=0 ORDER BY views DESC $limit";
    	}
    	$high_arr = $dblink->getRow($sql);
    	for ($i=0;$i<count($high_arr);$i++){
    		$high_arr[$i]["url"] = "http://".$SYSCONFIG["BbsSiteRoot"]."/thread-".$high_arr[$i]['tid']."-1-1.html";
    		$high_arr[$i]["img"] = "http://res1.netwaymedia.com/forum/".$high_arr[$i]['attachment'];
    	}
    	return $high_arr;
    }
    
	/**
     * 获取论坛晒图点击最高的信息
     */
    public function get_click_pic_high($data){
		global $SYSCONFIG;
    	require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php";
    	$dblink = new DataBase("");
    	$limit = $data['order'];
    	$bbs_id = empty($data['id']) ? "":$data['id'];
    	if ($data['img'] == '1'){
    		$sql = "SELECT * FROM pre_forum_thread a INNER JOIN pre_forum_attachment b ON a.tid=b.tid WHERE a.closed=0 AND a.attachment!=0 AND a.fid=$bbs_id ORDER BY views DESC $limit";
    	}else {
    		$sql = "SELECT * FROM pre_forum_thread WHERE closed=0 AND fid=$bbs_id ORDER BY views DESC $limit";
    	}
    	$high_arr = $dblink->getRow($sql);
    	for ($i=0;$i<count($high_arr);$i++){
    		$high_arr[$i]["url"] = "http://".$SYSCONFIG["BbsSiteRoot"]."/thread-".$high_arr[$i]['tid']."-1-1.html";
    		$high_arr[$i]["img"] = "http://res1.netwaymedia.com/forum/".$high_arr[$i]['attachment'];
    	}
    	return $high_arr;
    }
    
    public function get_index_group($data){
    	require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php";
    	$dblink = new DataBase("");
    	$limit = $data['order'];
    	$sql = "SELECT fid,name,lastpost,icon,description FROM
    	(SELECT f.fid,f.name,f.lastpost,ff.membernum,ff.icon,ff.description FROM pre_forum_forumfield ff
    	LEFT JOIN pre_forum_forum f ON f.fid=ff.fid WHERE founderuid>0) t ORDER BY membernum DESC $limit";
    	$group_arr = $dblink->getRow($sql);
    	for($i=0;$i<count($group_arr);$i++){
    		$group_arr[$i]["img"] = DX_URL."data/attachment/group/".$group_arr[$i]["icon"];
    		$group_arr[$i]["url"] = DX_URL."forum.php?mod=group&fid=".$group_arr[$i]["fid"];
    	
    	}
    	return $group_arr;
    }
    
    /**
     * 获取最新分享
     * @param unknown_type $data
     * @return unknown
     */
    public function get_my_show_share($data){
    	require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php";
    	$dblink = new DataBase("");
    	$limit = $data['order'];
    	$sql = "SELECT * FROM pre_community_file WHERE `status`=99 ORDER BY input_time DESC $limit";
    	$arr = $dblink->getRow($sql);
    	return $arr;
    }
    
    /**
     * 获取社区推荐位列表
     * @param unknown_type $data
     */
    public function get_share_pos($data){
    	require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php";
    	require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/community/community.php";
    	$dblink = new DataBase("");
    	$dbarr =array();
		$sql = "SELECT posid,`name` FROM pre_community_position WHERE posid IN(21,22,23,24,25,26) ORDER BY posid";
		$pos_name = $dblink->getRow($sql);
		for ($i = 0; $i < count($pos_name); $i++) {
			$dbarr[$i][pos_name] = $pos_name[$i][name];
			$pos_arr = Community::getPosList($pos_name[$i][posid]);
			for ($j = 0; $j < count($pos_arr); $j++) {
				$dbarr[$i][data][$j] = $pos_arr[$j];
			}
		}
//		print_r($dbarr);
		return $dbarr;
    	
    }
    
    /**
     * 获取达人
     * @param unknown_type $data
     */
    public function get_talent_list($data){
    	require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php";
    	require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/community/community.php";
    	$dblink = new DataBase("");
    	$sql = "SELECT * FROM pre_community_user_stat WHERE share_count>0 ORDER BY share_count DESC LIMIT 6";
    	$dbarr = $dblink->getRow($sql);
		for ($i = 0; $i < count($dbarr); $i++) {
			$dbarr[$i][avatar] =getLiveHead($dbarr[$i]["uid"],"middle");
			$user_arr = Community::getTotalUserInfo($dbarr[$i][uid]);
			$user_data = $user_arr["arr"];
			$dbarr[$i][fans] = empty($user_data[0][fans]) ? 0:$user_data[0][fans];
			$dbarr[$i][name] = empty($user_data[0][nickname]) ? $user_data[0][username]:$user_data[0][nickname];
		}
//		print_r($dbarr);
		return $dbarr;
    }
    
    public function get_album_list($data){
    	require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php";
    	require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/community/community.php";
    	$dblink = new DataBase("");
    	$dbarr =array();
		$r = Community::getPosList(27);
    	for ($i = 0; $i < count($r); $i++) {
			$r2 = Community::getAlbumClassId($r[$i][classid]);
			$r3 = $r2["-msg-"];
			for ($j = 0; $j < count($r3); $j++) {
				$dbarr[$i][id] = $r3[$j][id];
				$dbarr[$i][album_name] = $r3[$j][album_name];
				$dbarr[$i][uid] = $r3[$j][uid];
				$dbarr[$i][description] = $r3[$j][description];
				$r4 = Community::getShareListFromAlbumPic($r3[$j][id],1,"desc",1,1);
				$r5 = $r4["-msg-"]["arr"];
				for ($k = 0; $k < count($r5); $k++) {
					$dbarr[$i][img][] = $r5[$k]['small'];
				}
			}
		}
//		print_r($dbarr);
		return $dbarr;
    }
        
    
    /**
     * 获取论坛赛事版块信息
     */
    public function get_events_bbs($data){
    	require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php";
    	//$dbinfo['name'] = "pnews_huoshow";
		global $SYSCONFIG;
    	$dblink = new DataBase("");
    	if ($data['img'] == '1'){
    		$sql = "SELECT * FROM pre_forum_thread a LEFT JOIN pre_forum_attachment b ON a.tid=b.tid
    		WHERE a.author='rhcling1986' AND a.authorid = '106123' AND a.attachment!=0
    		ORDER BY a.dateline DESC LIMIT 1";
    	}else {
    		$sql ="SELECT * FROM pre_forum_thread WHERE author='rhcling1986' AND authorid = '106123' 
    		ORDER BY dateline DESC LIMIT 5";
    	}
    	$bbs_arr = $dblink->getRow($sql);
    	for ($i=0;$i<count($bbs_arr);$i++){
    		$bbs_arr[$i]["url"] = "http://".$SYSCONFIG["BbsSiteRoot"]."thread-".$bbs_arr[$i]['tid']."-1-1.html";
    		$bbs_arr[$i]["img"] = "http://res1.netwaymedia.com/forum/".$bbs_arr[$i]['attachment'];
    	}
    	return $bbs_arr;
    }
    
    /**
     * 获取赛事群组
     */
    public function get_events_group(){
    	require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php";
    	$dblink = new DataBase("");
    	$sql = "SELECT fid,name,lastpost,icon,description FROM 
(SELECT f.fid,f.name,f.lastpost,ff.membernum,ff.icon,ff.description FROM pre_forum_forumfield ff 
LEFT JOIN pre_forum_forum f ON f.fid=ff.fid WHERE founderuid>0) t ORDER BY membernum DESC LIMIT 6";
		$group_arr = $dblink->getRow($sql);
    	for($i=0;$i<count($group_arr);$i++){
    		$group_arr[$i]["img"] = DX_URL."data/attachment/group/".$group_arr[$i]["icon"];
    		$group_arr[$i]["url"] = DX_URL."forum.php?mod=group&fid=".$group_arr[$i]["fid"];
    		
    	}
    	return $group_arr;
    }
    
    /**
     * 获取下一图集
     */
    public function get_next_page($data){
    	$id = $data["id"];
    	
    	$tmparr = $this->db->sselect("SELECT modeid FROM v9_global_id WHERE id='$id'");
    	$modelid = $tmparr[0][modeid];
    	
    	$catid = $data["catid"];
    	if(empty($catid) || empty($modelid))
    		return 0;
    	if($modelid==3)
    		$sql = "SELECT * FROM v9_picture WHERE id >$id AND thumb!='' AND status=99 AND catid=$catid ORDER BY id ASC limit 1";
    	elseif ($modelid==1)
    		$sql = "SELECT a.* FROM v9_news a,v9_news_data b 
				WHERE a.id=b.id AND a.catid = '$catid' AND a.`id`>'$id' 
				AND a.`status`=99 AND b.pictureurls!='' 
				AND img_attachment_mode=1 ORDER BY id asc LIMIT 0,1";
    	if(empty($sql))
    		return 0;
    		
    	$result = $this->db->sselect($sql);
    	return empty($result) ? 0 : $result;
    }
    

	//游戏列表页获取今日数据
	public function get_day_recomment($data){
		$catid = intval($data['catid']);
		$time = strtotime(DATE("Y-m-d"));
		if(!$this->set_modelid($catid)) return false;
		if(isset($data['where'])) {
			$sql = $data['where'];
		} else {
			$day_time = " AND inputtime >= ".$time;
			if($this->category[$catid]['child']) {
				$catids_str = $this->category[$catid]['arrchildid'];
				$pos = strpos($catids_str,',')+1;
				$catids_str = substr($catids_str, $pos);
				$sql = "status=99 AND catid IN ($catids_str)".$day_time;
			} else {
				$sql = "status=99 AND catid='$catid'".$day_time;
			}
		}
		$order = $data['order'];
		$result = $this->db->select($sql, '*', $data['limit'], $order, '', 'id');
		return $result;
	}
    
    
    
    
    
    
    
    
    
    
    
    
    /**
     * 获得整个系统点击率最高的100条记录，在其中随机抽取N条
     * @param unknown_type $data
     */
    public function hits_all_channel($data)
    {
    	/*
    	require_once $_SERVER["DOCUMENT_ROOT"].'/phpcms/libs/classes/class_cmemcache.php';
    	$memcache = new cmemcache();
    	$data2 = $memcache->get("pnews_top_hot_news");
    	if ($data2 !== false) {
    		$return1 = $data2;
    	} else {
*/
    		$this->hits_db = pc_base::load_model ( 'hits_model' );
			$sql = $desc = $ids = '';
			$array = $ids_array = array ();
			// $order = $data['order'];
			$order = "views desc";
			$num = $data['limit'];
			
			// 全部资讯
			$hitsid = 'c-1-%';
			$sql = "SELECT a.title,a.url,a.thumb,tmp.views FROM
    		(SELECT hitsid,views,SUBSTRING(hitsid,5) AS id
    		FROM v9_hits WHERE hitsid LIKE 'c-1%' ORDER BY views desc LIMIT 0,200) tmp
    		INNER JOIN v9_news a ON tmp.id=a.id
    		WHERE a.thumb!='' ORDER BY views DESC LIMIT 0,100";
			$result = $this->hits_db->sselect ( $sql );
			$j = 1;
			$circle_count = count ( $result ) >= 100 ? 100 : count ( $result );
			if ($circle_count < $num)
				return $result;
			for($i = 0; $i < $circle_count; $i ++) {
				$tmp_id = rand ( 0, $circle_count - 1 );
				if ($result [$tmp_id] ["isdel"] == 1) {
					continue;
				} else {
					$result [$tmp_id] ["title"] = htmlspecialchars ( $result [$tmp_id] ["title"] );
					$j ++;
					$return1 [] = $result [$tmp_id];
					$result [$tmp_id]["isdel"] = 1;
					if ($j > $num)
						break;
				}
			}
			
    		//$memcache->set("pnews_top_hot_news", $return1, 600);
    	//}
    	//$memcache->close();
    	
    	
    	
    	return $return1;
    }

    /**
     * 获得微博评论数和转发数最多的动态
     * @param unknown_type $data
     */
    public function weibo_hit_dynamic($data)
    {
    	require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/weibo.class.php";
    	$num = $data["limit"];
    	$arr = Weibo::getMuchReplyRouteMsg($num);
    	return $arr;
    }
    
    /**
     * 获得指定频道的热门图片
     * @param unknown_type $data
     */
    public function channel_hot_img($data)
    {
    	$this->hits_db = pc_base::load_model ( 'hits_model' );
    	$num = $data["imgcount"];
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "SELECT tmp.id,tmp.views,b.title,b.url,b.thumb FROM
				(SELECT SUBSTRING(hitsid,5) AS id,views FROM v9_hits 
  				WHERE hitsid LIKE 'c-3%' AND catid IN($catids) 
  				ORDER BY views DESC LIMIT 0,100) tmp,v9_picture b
  			   WHERE tmp.id=b.id";
    	
    	$result = $this->db->sselect($sql);
    	$circle_count = count($result)>=100?100:count($result);
    	if($circle_count<$num)
    		return $result;
    	$j=1;
    	for($i=0;$i<$circle_count;$i++)
    	{
    		$tmp_id = rand(0, $circle_count-1);
    		
    		if($result[$tmp_id]["isdel"]==1)
	    	{
	    		continue;
	    	}
	    	else
	    	{
	    		$result[$tmp_id]["title"] = htmlspecialchars($result[$tmp_id]["title"]);
	    		$j++;
	    		$return1[] = $result[$tmp_id];
	    		$result[$tmp_id]["isdel"]=1;
	    		if($j>$num)
	    			break;
	    	}
    	}
    	return $return1;
    }

    
    /**
     * 热点视频100条，随机4条
     */
    public function site_all_hot_vedio($data)
    {
    	$num = 4;
    	$sql = "SELECT tmp.id,tmp.catid,tmp.views,b.title,b.url,b.thumb FROM
				(SELECT SUBSTRING(hitsid,5) AS id,views,catid FROM v9_hits 
  				WHERE hitsid LIKE 'c-1%' AND catid IN(19,47,51,60,70,141,140,148,236) 
  				ORDER BY views DESC LIMIT 0,100) tmp,v9_news b
  			   WHERE tmp.id=b.id AND b.thumb!=''";
    	$result = $this->db->sselect($sql);
    	//随机
    	$circle_count = count($result)>=100?100:count($result);
    	if($circle_count<$num)
    		return $result;
    	$j=1;
    	for($i=0;$i<$circle_count;$i++){
    		$tmp_id = rand(0, $circle_count-1);    		
    		if($result[$tmp_id]["isdel"]==1){
	    		continue;
	    	}else{
	    		$result[$tmp_id]["title"] = htmlspecialchars($result[$tmp_id]["title"]);
	    		$j++;
	    		$return1[] = $result[$tmp_id];
	    		$result[$tmp_id]["isdel"]=1;
	    		if($j>$num)
	    			break;
	    	}
    	}
    	return $return1;
    	//不做随机数据
//    	for($i=0;$i<count($result);$i++)
//    	{
//    		$result[$i]["title"] = htmlspecialchars($result[$i]["title"]);
//    	}
//    	return $result;
    }
    
    /**
     * 获得专访信息
     * @param unknown_type $data
     */
    public function movie_exclusive_interview($data)
    {
    	//if(!$this->set_modelid(12)) return false;
    	$sql = "SELECT id,url,title,thumb FROM v9_news 
    			WHERE catid='135' AND thumb!='' 
    			ORDER BY inputtime DESC LIMIT 0,3";
    	$result1 = $this->db->sselect($sql);
    	$num = count($result1);
    	
    	require_once CACHE_MODEL_PATH.'content_output.class.php';
    	$content_output = new content_output(1);
    	for($i=0;$i<$num;$i++)
    	{
    		$result1[$i] = $content_output->get($result1[$i]);
    		
    		$result_img[] = $result1[$i];
    		$tmp[$result1[$i]["id"]] = 1;
    	}
    	$sql = "SELECT id,url,title,thumb FROM v9_news
    	WHERE catid='135'
    	ORDER BY inputtime DESC LIMIT 0,10";
    	$result1 = $this->db->sselect($sql);
    	$j=1;
    	for($i=0;$i<count($result1);$i++)
    	{
    		$result1[$i] = $content_output->get($result1[$i]);
    		if(array_key_exists($result1[$i]["id"], $tmp))
    			continue;
    		else 
    		{
    			$result_news[] = $result1[$i];
    			$j++;
    			if($j>6)
    				break;
    		}
    	}
    	$result["img"] = $result_img;
    	$result["news"] = $result_news;
		return $result;
    }
    
    /**
     * 电影首页专题
     * @param unknown_type $data
     */
    public function movie_index_topic($data)
    {
    	$result = $this->movie_index_auto_data($data,71,3,5,10);
    	return $result;
    }
    
    /**
     * 自动获取按时间排序的数据，img为指定条目的带图片的数据
     * news为img之外的资讯记录
     * @param unknown_type $data
     * @param unknown_type $catid 栏目ID
     * @param unknown_type $lnum 需要的图片数
     * @param unknown_type $rnum 需要的新闻数
     * @param unknown_type $tnum 临时去的资讯数
     * 
     */
    public function movie_index_auto_data($data,$catid='',$lnum='',$rnum='',$tnum='')
    {
    	require_once CACHE_MODEL_PATH.'content_output.class.php';
    	$content_output = new content_output(1);
    	$catid = empty($catid)?$data['catid']:$catid;
    	$lnum = empty($lnum)?$data['lnum']:$lnum;
    	$rnum = empty($rnum)?$data['rnum']:$rnum;
    	$tnum = empty($tnum)?$data['tnum']:$tnum;
    	
    	$sql = "SELECT id,url,title,thumb,description FROM v9_news
    	WHERE catid='$catid' AND thumb!=''
    	ORDER BY inputtime DESC LIMIT 0,$lnum"; 
    	$result1 = $this->db->sselect($sql);
    	$num = count($result1);
    	for($i=0;$i<$num;$i++)
    	{
    		$result1[$i] = $content_output->get($result1[$i]);
    		
    		$result_img[] = $result1[$i];
    		$tmp[$result1[$i]["id"]] = 1;
    	}
    	//var_dump($result_img);
    	$sql = "SELECT id,url,title,thumb,description FROM v9_news
    	WHERE catid='$catid'
    	ORDER BY inputtime DESC LIMIT $tnum";
    	$result1 = $this->db->sselect($sql);
    	$j=1;
    	for($i=0;$i<count($result1);$i++)
    	{
	    	if(array_key_exists($result1[$i]["id"], $tmp))
	    		continue;
	    	else
	    	{
	    		$result1[$i] = $content_output->get($result1[$i]);
	    		$result_news[] = $result1[$i];
	    		$j++;
	    		if($j>$rnum)
	    			break;
	    	}
    	}
    	$result["img"] = $result_img;
    	$result["news"] = $result_news;
    	return $result;
    }
    
    /**
     * 剧照自动推送内容
     * @param unknown_type $data
     * @return unknown
     */
    public function movie_index_juzhao($data)
    {
    	$sql = "SELECT title,thumb,url FROM v9_picture WHERE catid='69' order by inputtime desc limit 0,9";
    	$arr = $this->db->sselect($sql);
    	for($i=0;$i<count($arr);$i++)
    	{
    		$arr[$i]["title"] = safe_replace($arr[$i]["title"]);
    	}
    	return $arr;
    }
    
    /**
     * 根据专题首页模版获得对应的可选css列表
     * @param unknown_type $templatename
     * @return unknown
     */
    public function getCssfileFromSpecialname($templatename)
    {
//    	$css_base  = str_replace('http://pnews.'.GLOBAL_SITEDOMAIN,'',CSS_PATH);
//    	$css_config_arr = include $_SERVER['DOCUMENT_ROOT'].$css_base.'special/config.inc';
    	$css_config_arr = include $_SERVER['DOCUMENT_ROOT'].$css_base.'/statics/css/special/config.inc';
    	return $css_config_arr[$templatename];
    }
    
    
    /**
     * 根据专题ID获得专题对应的模版的可选css列表
     * @param unknown_type $id
     */
    public function getSpecialCssfile($data)
    {
    	$template_name = $data["templatename"];
    	$spicial_id = $data["specialid"];
    	//$css_file = "";
    	if(!empty($spicial_id))
    	{
    		$dbarr = $this->db->sselect("select index_template
    				from v9_special where id='$spicial_id'");
    		$template_name = $dbarr[0]["index_template"];
    		//$css_file = $dbarr[0]["css_file"];
    	}
    
    	$arr = $this->getCssfileFromSpecialname($template_name);
    	return $arr;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
     /**
     * 获得超模频道精彩回顾信息
     * @param unknown_type $data
     */
    public function supermodel_splendid_review($data)
    {
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "SELECT a.title,a.url,a.thumb,a.inputtime,tmp.views FROM 
					(SELECT hitsid,views,SUBSTRING(hitsid,5) AS id 
					FROM v9_hits WHERE hitsid LIKE 'c-1%' AND catid IN($catids) ORDER BY views LIMIT 0,1000) tmp
				INNER JOIN v9_news a ON tmp.id=a.id
				WHERE a.thumb!='' ORDER BY views DESC,a.inputtime DESC LIMIT 0,2";
    	$result1 = $this->db->sselect($sql);
    	$num = count($result1);
    	for($i=0;$i<$num;$i++)
    	{
    		$result_img[] = $result1[$i];
    	}
    	$sql = "SELECT a.title,a.url,a.thumb,a.inputtime,tmp.views FROM 
					(SELECT hitsid,views,SUBSTRING(hitsid,5) AS id 
					FROM v9_hits WHERE hitsid LIKE 'c-1%' AND catid IN($catids) ORDER BY views LIMIT 0,1000) tmp
				INNER JOIN v9_news a ON tmp.id=a.id
				 ORDER BY views DESC,a.inputtime DESC LIMIT 2,8";
    	$result1 = $this->db->sselect($sql);
    	for($i=0;$i<count($result1);$i++)
    	{
    		$result_news[] = $result1[$i];
    	}
    	$result["img"] = $result_img;
    	$result["news"] = $result_news;
		return $result;
    }

      /**
     * 获得超模频道国内名模，国际信息
     * @param unknown_type $data
     */
    public function supermodel_inland_review($data)
    {
    	//国内名模资讯
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "SELECT a.title,a.url,a.thumb,a.inputtime,tmp.views FROM 
					(SELECT hitsid,views,SUBSTRING(hitsid,5) AS id 
					FROM v9_hits WHERE hitsid LIKE 'c-1%' AND catid IN($catids) ORDER BY views LIMIT 0,1000) tmp
				INNER JOIN v9_news a ON tmp.id=a.id
				WHERE a.thumb!='' ORDER BY views DESC,a.inputtime DESC LIMIT 0,2";
    	$result1 = $this->db->sselect($sql);
    	$num = count($result1);
    	for($i=0;$i<$num;$i++)
    	{	 
    		$result1[$i]["title"] = htmlspecialchars($result1[$i]["title"]);
    		$result_inland_img[] = $result1[$i];
    	}
    	$sql = "SELECT a.title,a.url,a.thumb,a.inputtime,tmp.views FROM 
					(SELECT hitsid,views,SUBSTRING(hitsid,5) AS id 
					FROM v9_hits WHERE hitsid LIKE 'c-1%' AND catid IN($catids) ORDER BY views LIMIT 0,1000) tmp
				INNER JOIN v9_news a ON tmp.id=a.id
				 ORDER BY views DESC,a.inputtime DESC LIMIT 2,8";
    	$result1 = $this->db->sselect($sql);
    	for($i=0;$i<count($result1);$i++)
    	{	
    		$result1[$i]["title"] = htmlspecialchars($result1[$i]["title"]);
    		$result_inland_news[] = $result1[$i];
    	}
    	
    	$result["inlandimg"] = $result_inland_img;
    	$result["inlandnews"] = $result_inland_news;
    	
		return $result;
    }
     
     public function supermodel_international_review($data)
    { 
    	//国际名模资讯
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "SELECT a.title,a.url,a.thumb,a.inputtime,tmp.views FROM 
					(SELECT hitsid,views,SUBSTRING(hitsid,5) AS id 
					FROM v9_hits WHERE hitsid LIKE 'c-1%' AND catid IN($catids) ORDER BY views LIMIT 0,1000) tmp
				INNER JOIN v9_news a ON tmp.id=a.id
				WHERE a.thumb!='' ORDER BY views DESC,a.inputtime DESC LIMIT 0,2";
    	$result1 = $this->db->sselect($sql);
    	$num = count($result1);
    	for($i=0;$i<$num;$i++)
    	{
    		$result_img[] = $result1[$i];
    	}
    	$sql = "SELECT a.title,a.url,a.thumb,a.inputtime,tmp.views FROM 
					(SELECT hitsid,views,SUBSTRING(hitsid,5) AS id 
					FROM v9_hits WHERE hitsid LIKE 'c-1%' AND catid IN($catids) ORDER BY views LIMIT 0,1000) tmp
				INNER JOIN v9_news a ON tmp.id=a.id
				ORDER BY views DESC,a.inputtime DESC LIMIT 2,8";
    	$result1 = $this->db->sselect($sql);
    	for($i=0;$i<count($result1);$i++)
    	{
    		$result_news[] = $result1[$i];
    	}
    	$result["img"] = $result_img;
    	$result["news"] = $result_news;
		return $result;
    }
          /**
     * 获得超模频道T台秀场，T台展示
     * @param unknown_type $data
     */
    
       public function supermodel_Tshow_review($data)
	    { 
	    	$catids = $data["catids"];
	    	$cat_arr = explode(",",$catids);
	    	$count = count($cat_arr);
	    	for($i=0;$i<$count;$i++)
	    	{
	    		if(!is_numeric($cat_arr[$i]))
	    			return false;
	    	}
	    	$sql = "SELECT a.title,a.url,a.thumb,a.inputtime,tmp.views FROM 
					(SELECT hitsid,views,SUBSTRING(hitsid,5) AS id 
					FROM v9_hits WHERE hitsid LIKE 'c-1%' AND catid IN($catids) ORDER BY views LIMIT 0,1000) tmp
				INNER JOIN v9_news a ON tmp.id=a.id
				WHERE a.thumb!='' ORDER BY views DESC,a.inputtime DESC LIMIT 0,6";
	    	$result1 = $this->db->sselect($sql);
	    	$num = count($result1);
	    	for($i=0;$i<$num;$i++)
	    	{
	    		$result_Tshow_img[] = $result1[$i];
	    	}
	    
	    	$result["Tshowimg"] = $result_Tshow_img;
	    	return $result;
	    }
	    
	     /**
     * 获得超模频道精彩视频信息
     * @param unknown_type $data
     */
    public function supermodel_video_review($data)
    {	
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "SELECT id,url,title,thumb FROM v9_news 
    			WHERE catid=$catids AND thumb!='' 
    			ORDER BY inputtime DESC LIMIT 0,2";
    	$result1 = $this->db->sselect($sql);
    	$num = count($result1);
    	for($i=0;$i<$num;$i++)
    	{
    		$result_img[] = $result1[$i];
    		$tmp[$result1[$i]["id"]] = 1;
    	}
    	$sql = "SELECT id,url,title,thumb FROM v9_news
    	WHERE catid=$catids 
    	ORDER BY inputtime DESC LIMIT 0,8";
    	$result1 = $this->db->sselect($sql);
    	$j=1;
    	for($i=0;$i<count($result1);$i++)
    	{
    		if(array_key_exists($result1[$i]["id"], $tmp))
    			continue;
    		else 
    		{
    			$result_news[] = $result1[$i];
    			$j++;
    		}
    	}
    	$result["img"] = $result_img;
    	$result["news"] = $result_news;
		return $result;
    }
    
       /**
     * 获得超模频道名模专访信息
     * @param unknown_type $data
     */
    public function supermodel_interview_review($data)
    {	
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "SELECT id,url,title,thumb FROM v9_news 
    			WHERE catid=$catids  
    			ORDER BY inputtime DESC LIMIT 0,3";
    	$result1 = $this->db->sselect($sql);
    	$num = count($result1);
    	for($i=0;$i<$num;$i++)
    	{
    		$result_news[] = $result1[$i];
    	}
    	$result["news"] = $result_news;
		return $result;
    }
    
     /**
     * 获得超模频道首页各个栏目，广告位下方信息
     * @param unknown_type $data
     */
    public function supermodel_indexcatids_review($data)
    {	
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "SELECT id,url,title,thumb FROM v9_news 
    			WHERE catid IN($catids) AND thumb!='' 
    			ORDER BY inputtime DESC LIMIT 0,2";
    	$result1 = $this->db->sselect($sql);
    	$num = count($result1);
    	for($i=0;$i<$num;$i++)
    	{
    		$result_news[] = $result1[$i];
    	}
    	$result["news"] = $result_news;
		return $result;
    }

    
     /**
     * 获得超模频道热点排行
     * @param unknown_type $data
     */
    public function hits_all_supermodel($data)
    {
    	$num = $data["newsnum"];
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	//超模频道，热点排行资讯
    	$sql = "SELECT a.title,a.url,a.thumb,a.inputtime,tmp.views FROM 
					(SELECT hitsid,views,SUBSTRING(hitsid,5) AS id 
					FROM v9_hits WHERE hitsid LIKE 'c-1%' AND catid IN($catids) ORDER BY views LIMIT 0,1000) tmp
				INNER JOIN v9_news a ON tmp.id=a.id
				WHERE a.thumb!='' ORDER BY views DESC,a.inputtime DESC LIMIT 0,$num";
    	$result = $this->db->sselect($sql);
    	for($i=0;$i<count($result);$i++)
    	{
    		$result[$i]["title"] = htmlspecialchars($result[$i]["title"]);
    	}
    	return  $result;
    } 
    
    /**
     * 获得图片频道热点排行
     * @param unknown_type $data
     */
    public function hits_all_picture($data)
    {
    	$num = $data["newsnum"];
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	//图片频道，热点排行资讯
    	$sql = "SELECT a.title,a.url,a.thumb,a.inputtime,a.status,tmp.views FROM 
					(SELECT hitsid,views,SUBSTRING(hitsid,5) AS id 
					FROM v9_hits WHERE hitsid LIKE 'c-3%' AND catid IN($catids) ORDER BY views) tmp
				INNER JOIN v9_picture a ON tmp.id=a.id
				WHERE a.thumb!='' and a.status=99 ORDER BY views DESC,a.inputtime DESC LIMIT 0,$num";
    	$result = $this->db->sselect($sql);
    	return  $result;
    }
    
    /**
     * 获得图片首页各个栏目，中间6个图片
     * @param unknown_type $data
     */
    public function picture_indexcatids_img($data)
    {	
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "SELECT id,url,title,thumb FROM v9_picture 
    			WHERE catid IN($catids) AND thumb!='' 
    			ORDER BY inputtime DESC LIMIT 0,6";
    	$result = $this->db->sselect($sql);
    	return  $result;
    }
    
    /**
     * 获得电视首页各个栏目，文章模型中间新闻
     * @param unknown_type $data
     */
    public function tv_indexcatids_news($data)
    {	
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "SELECT id,url,title,thumb FROM v9_news 
    			WHERE catid IN($catids) 
    			ORDER BY inputtime DESC LIMIT 0,12";
    	$result = $this->db->sselect($sql);
    	return  $result;
    } 
    
    /**
     * 获得电视首页精彩片花,高清剧照栏目图片
     * @param unknown_type $data
     */
    public function tv_indexcatids_img($data)
    {	
    	$nums =$data["nums"];
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "SELECT id,url,title,thumb FROM v9_picture 
    			WHERE catid IN($catids) AND thumb!='' 
    			ORDER BY inputtime DESC LIMIT 0,$nums";
    	$result = $this->db->sselect($sql);
    	return  $result;
    }
    
    /**
     * 获得电视首页电视焦点
     * @param unknown_type $data
     */
    public function tv_hot_point($data)
    {	
    	$nums =$data["newnum"];
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "SELECT a.title,a.url,a.thumb,a.inputtime,tmp.views FROM 
					(SELECT hitsid,views,SUBSTRING(hitsid,5) AS id 
					FROM v9_hits WHERE hitsid LIKE 'c-1%' AND catid IN($catids) ORDER BY views) tmp
				INNER JOIN v9_news a ON tmp.id=a.id
				ORDER BY views DESC,a.inputtime DESC LIMIT 0,$nums";
    	$result = $this->db->sselect($sql);
    	return  $result;
    }
    
       /**
     * 获得电视频道独家报道信息
     * @param unknown_type $data
     */
    public function tv_exclusives($data)
    {	
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "SELECT id,url,title,thumb FROM v9_news 
    			WHERE catid=$catids AND thumb!='' 
    			ORDER BY inputtime DESC LIMIT 0,2";
    	$result1 = $this->db->sselect($sql);
    	$num = count($result1);
    	for($i=0;$i<$num;$i++)
    	{
    		$result_img[] = $result1[$i];
    		$tmp[$result1[$i]["id"]] = 1;
    	}
    	$sql = "SELECT id,url,title,thumb FROM v9_news
    	WHERE catid=$catids 
    	ORDER BY inputtime DESC LIMIT 0,10";
    	$result1 = $this->db->sselect($sql);
    	$j=1;
    	for($i=0;$i<count($result1);$i++)
    	{
    		if(array_key_exists($result1[$i]["id"], $tmp))
    			continue;
    		else 
    		{
    			$result_news[] = $result1[$i];
    			$j++;
    			if($j>8)
    				break;
    		}
    	}
    	$result["img"] = $result_img;
    	$result["news"] = $result_news;
		return $result;
    }
    
     /**
     * 获得单机游戏图集热点排行
     * @param unknown_type $data
     */
    public function hits_pcgame_hotpic($data)
    {
    	$num = $data["newsnum"];
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	//单机游戏图集热点排行
    	$sql = "SELECT a.title,a.url,a.thumb,a.inputtime,tmp.views FROM 
					(SELECT hitsid,views,SUBSTRING(hitsid,5) AS id 
					FROM v9_hits WHERE hitsid LIKE 'c-1%' AND catid IN($catids) ORDER BY views ) tmp
				INNER JOIN v9_news a ON tmp.id=a.id
				 ORDER BY views DESC,a.inputtime DESC LIMIT 0,$num";
    	$result = $this->db->sselect($sql);
    	return  $result;
    }
    
     /**
     * 获得单机游戏精华攻略一周点击排行
     * @param unknown_type $data
     */
    /*public function hits_pcgame_hotweekstrategy($data)
    {
    	$num = $data["newsnum"];
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	//单机游戏精华攻略一周点击排行
    	$sql = "SELECT a.title,a.url,a.thumb,a.inputtime,p.weekviews FROM `v9_news` a, `v9_hits` p WHERE a.catid IN($catids) and a.status=99 ORDER BY p.weekviews DESC,a.inputtime DESC LIMIT 0,$num";
    	$result = $this->db->sselect($sql);
    	return  $result;
    }*/
    
    /**
     * 获得单机游戏资讯一周点击排行
     * @param unknown_type $data
     */
    public function hits_pcgame_hotweeknews($data)
    {
    	$num = $data["newsnum"];
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "SELECT tmp.id,tmp.weekviews,b.title,b.url,b.thumb FROM
				(SELECT SUBSTRING(hitsid,5) AS id,weekviews FROM v9_hits 
  				WHERE hitsid LIKE 'c-1%' AND catid IN($catids) 
  				ORDER BY weekviews DESC LIMIT 0,100) tmp,v9_news b
  			   WHERE tmp.id=b.id";
    	$result = $this->db->sselect($sql);
    	return  $result;
    }

    /**
     * 获得游戏首页精彩图集周,月点击排行
     * @param unknown_type $data
     */
    public function picgame_hothits($data)
    {
    	$num = $data["newsnum"];
    	$hits =$data["hits"];
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "SELECT a.title,a.url,a.thumb,a.inputtime,p.$hits FROM `v9_picture` a, `v9_hits` p WHERE a.catid IN($catids) and a.status=99 ORDER BY p.$hits DESC LIMIT 0,$num";
    	//$result = $this->db->sselect($sql);
    	return  $result;
    }

    /**
     * 获得游戏频道小游戏热点排行
     * @param unknown_type $data
     */
    /*public function hits_all_smallgame($data)
    {
    	$num = $data["newsnum"];
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "SELECT a.title,a.url,a.thumb,a.inputtime,tmp.views,a.id FROM 
					(SELECT hitsid,views,SUBSTRING(hitsid,6) AS id 
					FROM v9_hits WHERE hitsid LIKE 'c-12%' AND catid IN($catids) ORDER BY views) tmp
				INNER JOIN v9_smallgame a ON tmp.id=a.id
				 ORDER BY views DESC LIMIT 0,$num";
    	$result = $this->db->sselect($sql);

    	for ($i=0;$i<count($result);$i++){
    		$id = $result[$i][id];
    		$sql = "select a.id,a.catid as smallgamecatid,b.catid,b.catname from v9_smallgame a,v9_category b where a.catid=b.catid and a.id=$id";
    		$result1 = $this->db->sselect($sql);
    		$result[$i][catname] = $result1[0][catname];
    	}
    	return  $result;
    }*/
    
    /**
     * 获得火秀首页，娱乐访谈/独家策划
     * @param unknown_type $data
     */
    public function index_yule_dujia($data)
    {
    	$num = $data["newsnum"];
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "select a.id,a.catid,a.title,a.thumb,a.description,a.url,a.listorder,a.inputtime,a.updatetime,b.catid from v9_news a,v9_category b where a.catid=b.catid and b.catid in($catids) order by a.id desc limit 0,$num";
    	$result = $this->db->sselect($sql);
    	return  $result;
    }
    
    /**
     * 获得火秀首页焦点视频
     * @param unknown_type $data
     */
    public function index_hotvideo($data)
    {
    	$num = $data["newsnum"];
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "select a.id,a.catid,a.title,a.thumb,a.description,a.url,a.listorder,a.inputtime,a.updatetime,b.catid from v9_news a,v9_category b where a.catid=b.catid and b.catid in($catids) AND `status`=99 order by a.id desc limit 0,$num";
    	$result = $this->db->sselect($sql);
    	return  $result;
    }
    
     /**
     * 获取首页MY秀
     */
    public function get_myshow(){
    	require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php";
    	require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/function.core.php";
    	$dblink = new DataBase("");
    	$sql = "select v.*,if(m.nickname!='',m.nickname,m.username) as nickname from pre_video_list v	
         LEFT JOIN pre_common_member m ON m.uid=v.uid 
		where auditstatus=2  order by dateline desc limit 0,19";
		$myshow_arr = $dblink->getRow($sql);
    	for($i=0;$i<count($myshow_arr);$i++){
    		$myshow_arr[$i]['image']=huoshowftpimg($myshow_arr[$i]['type'],$myshow_arr[$i]['isrecord'],$myshow_arr[$i]['videourl'],$myshow_arr[$i]['uid']);
    		
    	}
    	return $myshow_arr;
    }
    
    /**
     * 首页热点排行，整个系统点击率最高的100条记录，在其中随机抽取N条
     * @param unknown_type $data
     */
    public function hits_index_channel($data)
    {
    		$this->hits_db = pc_base::load_model ( 'hits_model' );
			$sql = $desc = $ids = '';
			$array = $ids_array = array ();
			// $order = $data['order'];
			$order = "views desc";
			$num = $data['limit'];
			
			// 全部资讯
			$hitsid = 'c-1-%';
			$sql = "SELECT a.title,a.url,a.thumb,a.description,tmp.views FROM
    		(SELECT hitsid,views,SUBSTRING(hitsid,5) AS id
    		FROM v9_hits WHERE hitsid LIKE 'c-1%' ORDER BY views DESC LIMIT 0,500) tmp
    		INNER JOIN v9_news a ON tmp.id=a.id
    		INNER JOIN v9_news_data c ON a.id=c.id
    		WHERE a.thumb!='' AND c.pictureurls='' ORDER BY views DESC LIMIT 0,100";
			$result = $this->hits_db->sselect ( $sql );
			$j = 1;
			$circle_count = count ( $result ) >= 100 ? 100 : count ( $result );
			if ($circle_count < $num)
				return $result;
			for($i = 0; $i < $circle_count; $i ++) {
				$tmp_id = rand ( 0, $circle_count - 1 );
				if ($result [$tmp_id] ["isdel"] == 1) {
					continue;
				} else {
					$result [$tmp_id] ["title"] = htmlspecialchars ( $result [$tmp_id] ["title"] );
					$j ++;
					$return1 [] = $result [$tmp_id];
					$result [$tmp_id]["isdel"] = 1;
					if ($j > $num)
						break;
				}
			}

    	return $return1;
    }
    
     /**
     * 获得电影首页热点排行，过滤组图
     * @param unknown_type $data
     */
    public function hits_movie($data)
    {
    	$num = $data["newsnum"];
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "SELECT a.title,a.url,a.thumb,tmp.views FROM
    		(SELECT hitsid,views,SUBSTRING(hitsid,5) AS id
    		FROM v9_hits WHERE hitsid LIKE 'c-1%' ORDER BY views DESC LIMIT 0,500) tmp
    		INNER JOIN v9_news a ON tmp.id=a.id
    		INNER JOIN v9_news_data c ON a.id=c.id
    		WHERE  c.pictureurls='' and a.catid in($catids) ORDER BY views DESC LIMIT 0,$num";
    	$result = $this->db->sselect($sql);
    	return  $result;
    }
    
    /**
     * 资讯多栏目数据调用 
     * @param unknown_type $data
     */
    public function morecatids($data)
    {
         $num = $data["newsnum"];
         $catids = $data["catids"];
         $cat_arr = explode(",",$catids);
         $count = count($cat_arr);
         for($i=0;$i<$count;$i++)
         {
              if(!is_numeric($cat_arr[$i]))
                   return false;
         }
    	if ($data['img'] == '1'){
    		$sql = "select a.id,a.catid,a.title,a.thumb,a.description,a.url,a.listorder,a.inputtime,
         	a.updatetime,b.catid from v9_news a,v9_category b where a.catid=b.catid and b.catid in($catids) and 
         	a.status=99 AND a.thumb!='' order by a.id desc limit 0,$num";
    	}else {
    		$sql = "select a.id,a.catid,a.title,a.thumb,a.description,a.url,a.listorder,a.inputtime,
         	a.updatetime,b.catid from v9_news a,v9_category b where a.catid=b.catid and b.catid in($catids) and 
         	a.status=99 order by a.id desc limit 0,$num";
    	}
         $result = $this->db->sselect($sql);
         return  $result;
    }
    
    
    /**
     * 图片模型多栏目数据调用 
     * @param unknown_type $data
     */
    public function picmorecatids($data)
    {
         $num = $data["newsnum"];
         $catids = $data["catids"];
         $order = empty($data["order"]) ? "a.id desc" : "a.".$data["order"]; 
         $cat_arr = explode(",",$catids);
         $count = count($cat_arr);
         for($i=0;$i<$count;$i++)
         {
              if(!is_numeric($cat_arr[$i]))
                   return false;
         }
    	if ($data['img'] == '1'){
    		$sql = "select a.id,a.catid,a.title,a.thumb,a.description,a.url,a.listorder,a.inputtime,
         	a.updatetime,b.catid from v9_picture a,v9_category b where a.catid=b.catid and b.catid in($catids) and 
         	a.status=99 AND a.thumb!='' order by a.id desc limit 0,$num";
    	}else {
    		$sql = "select a.id,a.catid,a.title,a.thumb,a.description,a.url,a.listorder,a.inputtime,
         	a.updatetime,b.catid from v9_picture a,v9_category b where a.catid=b.catid and b.catid in($catids) and 
         	a.status=99 order by $order limit 0,$num";
    	}
        $result = $this->db->sselect($sql);
        return  $result;
    }
    
    /**
     * 获得指定栏目图片点击排行
     * @param unknown_type $data
     */
    public function pic_hothits($data)
    {
    	$num = $data["newsnum"];
    	$hits =$data["hits"];
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "SELECT a.title,a.url,a.thumb,a.inputtime,a.description,tmp.views FROM 
					(SELECT hitsid,views,SUBSTRING(hitsid,5) AS id 
					FROM v9_hits WHERE hitsid LIKE 'c-3%' AND catid IN($catids) ORDER BY views ) tmp
				INNER JOIN v9_picture a ON tmp.id=a.id where a.status=99 and a.thumb!=''
				 ORDER BY views DESC,a.inputtime DESC LIMIT 0,$num";
    	$result = $this->db->sselect($sql);
    	return  $result;
    }
   
    /**
     * 获得指定栏目图片前100条随机点击排行
     * @param unknown_type $data
     */
    public function rand_pic_hothits($data)
    {
    	$this->hits_db = pc_base::load_model ( 'hits_model' );
    	$num = $data["newsnum"];
    	$hits =$data["hits"];
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "SELECT a.title,a.url,a.thumb,a.description,a.listorder,a.inputtime,tmp.views FROM 
					(SELECT hitsid,views,SUBSTRING(hitsid,5) AS id 
					FROM v9_hits WHERE hitsid LIKE 'c-3%' AND catid IN($catids) ORDER BY views ) tmp
				INNER JOIN v9_picture a ON tmp.id=a.id where a.status=99 AND DATE_SUB(CURDATE(),INTERVAL 1 MONTH) <=DATE(FROM_UNIXTIME(a.inputtime)) and a.thumb!=''
				 ORDER BY views DESC,a.inputtime DESC LIMIT 0,100";
		$result = $this->hits_db->sselect ( $sql );
		$j = 1;
		$circle_count = count ( $result ) >= 100 ? 100 : count ( $result );
		if ($circle_count < $num)
			return $result;
		for($i = 0; $i < $circle_count; $i ++) {
			$tmp_id = rand ( 0, $circle_count - 1 );
			if ($result [$tmp_id] ["isdel"] == 1) {
				continue;
			} else {
				$result [$tmp_id] ["title"] = htmlspecialchars ( $result [$tmp_id] ["title"] );
				$j ++;
				$return1 [] = $result [$tmp_id];
				$result [$tmp_id]["isdel"] = 1;
				if ($j > $num)
					break;
			}
		}

    	return $return1;
    }
    
    /**
     * 获得指定栏目资讯前100条随机点击排行
     * @param unknown_type $data
     */
    public function rand_news_hothits($data)
    {
    	$this->hits_db = pc_base::load_model ( 'hits_model' );
    	$num = $data["newsnum"];
    	$hits =$data["hits"];
    	$catids = $data["catids"];
        $order  = isset($data["newsorder"]) && !empty($data["newsorder"]) ? $data["newsorder"] : "views";
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "SELECT a.title,a.url,a.thumb,a.inputtime,a.description,tmp.views,tmp.weekviews,tmp.monthviews FROM 
					(SELECT hitsid,weekviews,monthviews,views,SUBSTRING(hitsid,5) AS id 
					FROM v9_hits WHERE hitsid LIKE 'c-1%' AND catid IN($catids) ORDER BY views ) tmp
				INNER JOIN v9_news a ON tmp.id=a.id where a.status=99 
				 ORDER BY $order DESC,a.inputtime DESC LIMIT 0,100";
		$result = $this->hits_db->sselect ( $sql );
		$j = 1;
		$circle_count = count ( $result ) >= 100 ? 100 : count ( $result );
		if ($circle_count < $num)
			return $result;
		for($i = 0; $i < $circle_count; $i ++) {
			$tmp_id = rand ( 0, $circle_count - 1 );
			if ($result [$tmp_id] ["isdel"] == 1) {
				continue;
			} else {
				$result [$tmp_id] ["title"] = htmlspecialchars ( $result [$tmp_id] ["title"] );
				$j ++;
				$return1 [] = $result [$tmp_id];
				$result [$tmp_id]["isdel"] = 1;
				if ($j > $num)
					break;
			}
		}

    	return $return1;
    }
    
	/**
     * 获得页面关键字匹配
     * @param unknown_type $data
     */
    public function key_news($data)
    {
    	$num = $data["newsnum"];
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
		$id = $data["id"];
		$sql = "SELECT * FROM v9_news WHERE id=".$id;
		$temp = $this->db->sselect($sql);//根据页面ID查询关键词
		$keywords = $temp[0]['keywords'];
    	$sql = "SELECT * FROM v9_news WHERE status=99 and keywords like '%$keywords%' AND catid IN($catids) ORDER BY inputtime DESC LIMIT 0,$num";
    	$result = $this->db->sselect($sql);
    	return  $result;
    }
    
    
/**
	 * 相关文章标签
	 * @param $data
	 */
	public function relation($data) {
		$catid = intval($data['catid']);
		if(!$this->set_modelid($catid)) return false;
		$order = $data['order'];
//		$sql = "`status`=99";
		$limit = $data['id'] ? $data['limit']+1 : $data['limit'];
		if($this->category[$catid]['child']) {
			$catids_str = $this->category[$catid]['arrchildid'];
			$pos = strpos($catids_str,',')+1;
			$catids_str = substr($catids_str, $pos);
			$sql = "status=99 AND catid IN ($catids_str)";
		} else {
			$sql = "`status`=99 AND `catid`='$catid'";
		}
		if($data['relation']) {
			echo '111';
			$relations = explode('|',trim($data['relation'],'|'));
			$relations = array_diff($relations, array(null));
			$relations = implode(',',$relations);
			$sql = " `id` IN ($relations) ";
			$key_array = $this->db->select($sql, '*', $limit, $order,'','id');
		} elseif($data['keywords']) {
			$keywords = str_replace('%', '',$data['keywords']);
			$keywords_arr = explode(' ',$keywords);
			$key_array = array();
			$number = 0;
			$i =1;
			foreach ($keywords_arr as $_k) {
				$sql2 = $sql." AND `keywords` LIKE '%$_k%'".(isset($data['id']) && intval($data['id']) ? " AND `id` != '".abs(intval($data['id']))."'" : '');
				$r = $this->db->select($sql2, '*', $limit, '','','id');
				$number += count($r);
				foreach ($r as $id=>$v) {
					if($i<= $data['limit'] && !in_array($id, $key_array)) $key_array[$id] = $v;
					$i++;
				}
				if($data['limit']<$number) break;
			}
		}
		if($data['id']) unset($key_array[$data['id']]);
		return $key_array;
	}
	
	/**
     * 电视频道首页相关排行榜
     * @param unknown_type $data
     */
    public function tv_area_hits($data)
    {
    	$num = $data["newsnum"];
    	$catids = $data["catids"];
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	$area = $data['area'];
    	if($area != ''){
    		$area = "and a.area=$area";
    	}else{
    		$area = "";
    	}
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	//电视频道首页相关排行榜
    	$sql = "SELECT a.title,a.url,a.thumb,a.inputtime,a.status,a.area,a.protagonist,a.score,a.amount,a.age,a.director,tmp.views FROM 
					(SELECT hitsid,views,SUBSTRING(hitsid,6) AS id 
					FROM v9_hits WHERE hitsid LIKE 'c-19%' AND catid IN($catids) ORDER BY views) tmp
				INNER JOIN v9_tv a ON tmp.id=a.id
				WHERE a.status=99 $area ORDER BY views DESC,a.inputtime DESC LIMIT 0,$num";
    	$result = $this->db->sselect($sql);
    	return  $result;
    }

	/**
     * 电视频道前100条随机排行榜
     * @param unknown_type $data
     */

 public function tv_area_rand_hits($data)
   {
    	$this->hits_db = pc_base::load_model ( 'hits_model' );
    	$num = $data["newsnum"];
    	$hits =$data["hits"];
    	$catids = $data["catids"];
        $order  = isset($data["newsorder"]) && !empty($data["newsorder"]) ? $data["newsorder"] : "views";
    	$cat_arr = explode(",",$catids);
    	$count = count($cat_arr);
    	for($i=0;$i<$count;$i++)
    	{
    		if(!is_numeric($cat_arr[$i]))
    			return false;
    	}
    	$sql = "SELECT a.title,a.url,a.thumb,a.inputtime,a.description,a.area,a.protagonist,a.score,a.amount,a.age,a.director,tmp.views,tmp.weekviews,tmp.monthviews FROM 
					(SELECT hitsid,weekviews,monthviews,views,SUBSTRING(hitsid,6) AS id 
					FROM v9_hits WHERE hitsid LIKE 'c-19%' AND catid IN($catids) ORDER BY views ) tmp
				INNER JOIN v9_tv a ON tmp.id=a.id where a.status=99 
				 ORDER BY $order DESC,a.inputtime DESC LIMIT 0,100";
		$result = $this->hits_db->sselect ( $sql );
		$j = 1;
		$circle_count = count ( $result ) >= 100 ? 100 : count ( $result );
		if ($circle_count < $num)
			return $result;
		for($i = 0; $i < $circle_count; $i ++) {
			$tmp_id = rand ( 0, $circle_count - 1 );
			if ($result [$tmp_id] ["isdel"] == 1) {
				continue;
			} else {
				$result [$tmp_id] ["title"] = htmlspecialchars ( $result [$tmp_id] ["title"] );
				$j ++;
				$return1 [] = $result [$tmp_id];
				$result [$tmp_id]["isdel"] = 1;
				if ($j > $num)
					break;
			}
		}
    	return $return1;
    }

/**
     * 电视多栏目数据调用 
     * @param unknown_type $data
     */
    public function tv_morecatids($data)
    {
         $num = $data["newsnum"];
         $catids = $data["catids"];
         $cat_arr = explode(",",$catids);
         $count = count($cat_arr);
         for($i=0;$i<$count;$i++)
         {
              if(!is_numeric($cat_arr[$i]))
                   return false;
         }
    	if ($data['img'] == '1'){
    		$sql = "select a.id,a.catid,a.title,a.thumb,a.description,a.url,a.listorder,a.inputtime,
         	a.updatetime,a.area,a.protagonist,a.score,a.amount,a.age,a.director,b.catid from v9_tv a,v9_category b where a.catid=b.catid and b.catid in($catids) and 
         	a.status=99 AND a.thumb!='' order by a.id desc limit 0,$num";
    	}else {
    		$sql = "select a.id,a.catid,a.title,a.thumb,a.description,a.url,a.listorder,a.inputtime,
         	a.updatetime,a.area,a.protagonist,a.score,a.amount,a.age,a.director,b.catid from v9_tv a,v9_category b where a.catid=b.catid and b.catid in($catids) and 
         	a.status=99 order by a.id desc limit 0,$num";
    	}
         $result = $this->db->sselect($sql);
         return  $result;
    }
	
	 /**
     * 获得电影频道指定栏目前100条随机点击排行
     * @param unknown_type $data
     */
    public function rand_movie_hothits($data)
    {
        $this->hits_db = pc_base::load_model ( 'hits_model' );
        $num = $data["newsnum"];
        $hits =$data["hits"];
        $catids = $data["catids"];
        if($this->category[$catids]['child']) {
            $catids_str = $this->category[$catids]['arrchildid'];
        } else {
            $catids_str = $catids;
        }
        $order  = isset($data["newsorder"]) && !empty($data["newsorder"]) ? $data["newsorder"] : "views";
        $cat_arr = explode(",",$catids);
        $count = count($cat_arr);
        for($i=0;$i<$count;$i++)
        {
            if(!is_numeric($cat_arr[$i]))
                return false;
        }
        $sql = "SELECT a.title,a.url,a.thumb,a.inputtime,a.description,tmp.views,tmp.weekviews,tmp.monthviews FROM
					(SELECT hitsid,weekviews,monthviews,views,SUBSTRING(hitsid,5) AS id
					FROM v9_hits WHERE hitsid LIKE 'c-1%' AND catid IN($catids_str) ORDER BY views ) tmp
				INNER JOIN v9_news a ON tmp.id=a.id where a.status=99
				 ORDER BY $order DESC,a.inputtime DESC LIMIT 0,100";
        $result = $this->hits_db->sselect ( $sql );
        $j = 1;
        $circle_count = count ( $result ) >= 100 ? 100 : count ( $result );
        if ($circle_count < $num)
            return $result;
        for($i = 0; $i < $circle_count; $i ++) {
            $tmp_id = rand ( 0, $circle_count - 1 );
            if ($result [$tmp_id] ["isdel"] == 1) {
                continue;
            } else {
                $result [$tmp_id] ["title"] = htmlspecialchars ( $result [$tmp_id] ["title"] );
                $j ++;
                $return1 [] = $result [$tmp_id];
                $result [$tmp_id]["isdel"] = 1;
                if ($j > $num)
                    break;
            }
        }
        return $return1;
    }
       
}
?>