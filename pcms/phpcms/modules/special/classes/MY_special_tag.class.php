<?php 
class MY_special_tag extends special_tag
{
/**
	 * 测试标签功能,返回最新微博
	 * @param unknown_type $data
	 */
	public function get_sys_weibo($data)
	{
		require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Weibo.php";
		$lastid = empty($data["lastid"])?0:$data["lastid"];
		$record_page = empty($data["record_page"])?10:$data["record_page"];
		$sys_msg_arr = Weibo::getSysAllMsgFront($lastid,$record_page);
		return $sys_msg_arr;
	}
	
	/**
	 *	专题推荐位
	 */
	public function get_special_pos($data){
    	$pos_id = $data['posid'];	//推荐位
    	$limit = $data['limit'];		//数量
    	$order = $data['order'];	//排序
    	$sql = "SELECT * FROM v9_special_position_data WHERE posid=$pos_id ORDER BY $order LIMIT $limit";
    	//echo $sql;
		$pos_arr = $this->db->sselect($sql);
		
		//增加查询游戏发号数量
		for($i=0;$i<count($pos_arr);$i++){
			$special_id[$i] = $pos_arr[$i]['special_id'];
			$sql = "select a.posid,a.special_name,b.special_id,b.gamename,b.id from v9_special_position_data a inner join v9_special_game b
on a.special_id=b.special_id where a.special_id=$special_id[$i] and posid=$pos_id";
			$tmp[$i] = $this->db->sselect($sql);
			$gameid[$i]=$tmp[$i][0]['id'];
			//查询推荐位专题是否与发号系统关联，没有关联默认为0
			if($gameid[$i] !=""){
			$sql = "select count(b.gameid) as nousenum from v9_special_game a 
				inner join v9_special_gamenum b 
				on a.id=b.gameid 
				where b.isuse=0 and a.id=$gameid[$i]";
			$gamenum[$i] = $this->db->sselect($sql);
			$pos_arr[$i]['gamenum'] = $gamenum[$i][0]['nousenum'];//统计还没使用的游戏号
			
			//专题属性
			$sql = "select a.*,b.* from v9_special a inner join v9_special_list_game_tmp b on a.id=b.special_id where a.id=".$pos_arr[$i]['special_id'];
			$game_tmp_data = $this->db->sselect($sql);
			$pos_arr[$i][tmp] = $game_tmp_data;
			$pos_arr[$i][thumb] = $game_tmp_data[$i][thumb];
			}else{
				$pos_arr[$i]['gamenum'] = '0';
			}
		}
//		var_dump($pos_arr);
    	return $pos_arr;		
	}
	
	
	/**
	 *	专题信息相关
	 */
	public function get_special_info($data){
		$specialid = $data['specialid'];	//专题ID
    	$limit = $data['limit'];		//数量
    	$order = $data['order'];	//排序
    	//$sql = "SELECT * FROM v9_special WHERE id=$specialid ";
//    	$sql = "select * from v9_special a inner join v9_special_list_game_tmp b on a.id=b.special_id where a.id=$specialid";
		$sql = "SELECT a.*,b.*,(SELECT catname FROM v9_category d WHERE d.catid=c.cat_id) AS cat_name 
				FROM v9_special a 
				LEFT JOIN v9_special_list_game_tmp b ON a.id=b.special_id
				LEFT JOIN v9_special_category_map c ON a.id=c.special_id
				WHERE a.id=$specialid";
		$special_info = $this->db->sselect($sql);
		return $special_info;
	}
		
	
	/**
	 * 调用相关专题最新信息
	 */
	public function get_special_news($data){
		$specialid = $data['specialid'];	//专题ID
    	$limit = $data['limit'];		//数量
    	//$order = $data['order'];	//排序
    	$sql = "select * from v9_special_content where specialid=$specialid order by inputtime desc limit 0,$limit";
    	$special_news = $this->db->sselect($sql);
		return $special_news;
	}
	

	/**
	 * 同风格游戏推荐
	 */
	public function get_thesame_gamestyle($data){
		$specialid = $data['specialid'];	//专题ID
		//查询此专题游戏风格
		$sql = "select game_style from v9_special_list_game_tmp where special_id=$specialid";
		$tmp = $this->db->sselect($sql);
		$key = $tmp[0][game_style];//获取游戏风格
		//查找匹配专题
		$sql = "select * from v9_special_list_game_tmp where game_style like "."'$key'"."order by special_id desc limit 0,4";
		$thesame_gamestyle = $this->db->sselect($sql);
		for($i=0;$i<count($thesame_gamestyle);$i++){
			$sql = "select title,thumb,url from v9_special where id=".$thesame_gamestyle[$i][special_id];
			$tmp[$i] = $this->db->sselect($sql);
			$thesame_gamestyle[$i][title]=$tmp[$i][0][title];//专题标题
			$thesame_gamestyle[$i][thumb]=$tmp[$i][0][thumb];//专题缩列图
			$thesame_gamestyle[$i][url]=$tmp[$i][0][url];//专题链接
		}
		return $thesame_gamestyle;
	}
	
	/**
	 * 查询游戏专题评分
	 */
	public function get_rated_number_special($data){
		$specialid = $data['specialid'];	//专题ID
		$sql = "SELECT id,title,thumb,description,url,createtime,rated_number FROM v9_special WHERE id=$specialid";
		$result_special = $this->db->sselect($sql);
		return $result_special;
	}
	
	/**
	 * 按分类，字母查出专题
	 */
	public function get_see_letter_list($data){
		$catid = intval($data['catid']);
		$letter_a = $data['worda'];
		$letter_b = $data['wordb'];
		$letter_c = $data['wordc'];
		$letter_d = $data['wordd'];
		$limit = $data['limit'];		//数量
		if($catid) {
			$siteids = getcache('category_content','commons');
			if(!$siteids[$catid]) return false;
			$siteid = $siteids[$catid];
			$this->category = getcache('category_content_'.$siteid,'commons');
		}
		if($catid && $this->category[$catid]['child']) {
			$catids_str = $this->category[$catid]['arrchildid'];
			$pos = strpos($catids_str,',')+1;
			$catids_str = substr($catids_str, $pos);
			$sql = "b.`cat_id` IN ($catid,$catids_str) AND ";
		} else {
			$sql = "b.`cat_id` = '$catid' AND ";
		}
		
		$sql = "SELECT a.id,a.title,a.thumb,a.username,a.url,b.cat_id FROM v9_special a 
		LEFT JOIN v9_special_category_map b ON a.id=b.special_id
		WHERE $sql (a.letters = '$letter_a' OR a.letters = '$letter_b' OR a.letters = '$letter_c' OR a.letters = '$letter_d')
		ORDER BY a.letters asc LIMIT $limit";
		$letter_arr = $this->db->sselect($sql);
		return $letter_arr;
	}
	
	/**
	 * 按分类查出专题
	 */
	public function get_see_class_letter_list($data){
		$catid = intval($data['catid']);
		$limit = $data['limit'];		//数量
		if($catid) {
			$siteids = getcache('category_content','commons');
			if(!$siteids[$catid]) return false;
			$siteid = $siteids[$catid];
			$this->category = getcache('category_content_'.$siteid,'commons');
		}
		if($catid && $this->category[$catid]['child']) {
			$catids_str = $this->category[$catid]['arrchildid'];
			$pos = strpos($catids_str,',')+1;
			$catids_str = substr($catids_str, $pos);
			$sql = "b.`cat_id` IN ($catid,$catids_str) ";
		} else {
			$sql = "b.`cat_id` = '$catid' ";
		}
		
		$sql = "SELECT a.id,a.title,a.thumb,a.username,a.url,b.cat_id FROM v9_special a 
		LEFT JOIN v9_special_category_map b ON a.id=b.special_id
		WHERE $sql ORDER BY a.letters asc LIMIT $limit";
		$letter_arr = $this->db->sselect($sql);
		return $letter_arr;
	}
}
?>