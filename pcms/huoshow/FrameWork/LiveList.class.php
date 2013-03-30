<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/HuoshowSys.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoomSocketApi.class.php");

/**
 * 火秀各排行榜类
 *
 */
class LiveList
{
	
	/**
	 * 直播大厅魅力值排行榜
	 *
	 * @param unknown_type $type  有三种类型
	 * 			daynum  =>  天值
	 * 			weeknum  =>  周值
	 * 			monthnum  => 月值
	 * @param unknown_type $num		数量
	 * @param unknown_type $page    分页
	 * @param unknown_type $all_num   总条数
	 */
	static public function Charm_Value_List($type, $num, $page=1,$all_num=120){
		$dblink = new DataBase("");
		$start_limit = ($page - 1) * $num;
		$sql = "SELECT count(*) as count FROM pre_live_top as t left join pre_live_member_count as c on t.uid=c.uid 
				LEFT JOIN pre_common_member m ON m.uid=c.uid
				WHERE t.uid NOT IN(SELECT uid FROM pre_common_member WHERE groupid=1) AND t.uid 
				NOT IN(SELECT uid FROM pre_live_room WHERE stat<0) AND t.cate='charm' ORDER BY t.$type DESC";
		$charm_count = $dblink->getRow($sql);
		if ($charm_count[0]['count'] >$all_num){
			$charm_count[0]['count']=$all_num;
		}
		$sql = "SELECT t.uid,t.$type as value,c.charm as ch,m.username,if(m.nickname!='',m.nickname,m.username) as nickname 
				FROM pre_live_top as t left join pre_live_member_count as c on t.uid=c.uid 
				LEFT JOIN pre_common_member m ON m.uid=c.uid
				WHERE t.uid NOT IN(SELECT uid FROM pre_common_member WHERE groupid=1) AND t.uid 
				NOT IN(SELECT uid FROM pre_live_room WHERE stat<0) AND t.cate='charm' ORDER BY t.$type DESC LIMIT $start_limit,$num";
		$charm_data = $dblink->getRow($sql);
		$charm_arr = array();
		for ($i=0;$i<count($charm_data);$i++){
			//得到魅力值等级
			$levelInfo = MutilLiveRoomSocketApi::getUserLevel($charm_data[$i]['ch'],2);
			$charm_data[$i]['level'] = empty($levelInfo[0]["level"]) ? '1' : $levelInfo[0]["level"];
			$charm_arr[] = $charm_data[$i];
		}
		$returnV["charm_count"] = $charm_count;
		$returnV["charm_data"] = $charm_arr;
		return $returnV;
	}
	
	/**
	 * 直播大厅魅力之星排行榜
	 *
	 * @param unknown_type $type	类型
	 * @param unknown_type $num		数量
	 * @param unknown_type $page    分页
	 * @param unknown_type $all_num   总条数
	 */
	static public function Charm_Vote_List($type, $num, $page=1,$all_num=120){
		$dblink = new DataBase("");
		$start_limit = ($page - 1) * $num;
		$sql = "SELECT count(*) as count FROM pre_live_top t 
				LEFT JOIN pre_common_member m ON t.uid=m.uid WHERE t.uid NOT IN(SELECT uid FROM pre_common_member WHERE groupid=1) 
				AND t.uid NOT IN(SELECT uid FROM pre_live_room WHERE stat<0) 
				AND t.cate='vote' ORDER BY t.$type DESC";
		$vote_count = $dblink->getRow($sql);
		if ($vote_count[0]['count'] >$all_num){
			$vote_count[0]['count']=$all_num;
		}
		$sql = "SELECT t.uid,t.$type as value,if(m.nickname!='',m.nickname,m.username) as nickname FROM pre_live_top t 
				LEFT JOIN pre_common_member m ON t.uid=m.uid WHERE t.uid NOT IN(SELECT uid FROM pre_common_member WHERE groupid=1) 
				AND t.uid NOT IN(SELECT uid FROM pre_live_room WHERE stat<0) 
				AND t.cate='vote' ORDER BY t.$type DESC limit $start_limit,$num ";
		$vote_data = $dblink->getRow($sql);
		$returnV["vote_count"] = $vote_count;
		$returnV["vote_data"] = $vote_data;
		return $returnV;
	}
	
	
	/**
	 * 直播大厅魅力指数排行榜
	 *
	 * @param unknown_type $type
	 * @param unknown_type $num
	 * @param unknown_type $page    分页
	 */
	static public function Charm_Score_List($type, $num, $uid='', $page=1,$all_num=120){
		//当查询个人数据时
		$uidsql = '';
		if (!empty($uid)){
			$uidsql .= "WHERE tmp.uid=$uid";
		}
		$dblink = new DataBase("");
		$start_limit = ($page - 1) * $num;
		$sql = "SELECT $type FROM pre_live_top WHERE uid NOT IN(SELECT uid FROM pre_common_member WHERE groupid=1) 
				AND uid NOT IN(SELECT uid FROM pre_live_room WHERE stat<0) AND cate like 'charm' ORDER BY $type DESC LIMIT 1";
		$maxCharm = $dblink->getRow($sql);
		$maxCharm = $maxCharm[0][$type];
		$sql = "SELECT $type FROM pre_live_top WHERE cate='vote' AND uid NOT IN(SELECT uid FROM pre_common_member WHERE groupid=1) 
				AND uid NOT IN(SELECT uid FROM pre_live_room WHERE stat<0) ORDER BY $type DESC LIMIT 1";
		$maxVote = $dblink->getRow($sql);
		$maxVote = $maxVote[0][$type];
		//总数
		$sql = "SELECT COUNT(*) as count FROM 
				(SELECT DISTINCT a.uid,IF(m.nickname!='',m.nickname,m.username) AS nickname, 
				(SELECT $type FROM pre_live_top b WHERE b.cate='charm' AND b.uid=a.uid) AS c_monthnum, 
				(SELECT totalnum FROM pre_live_top d WHERE d.cate='charm' AND d.uid=a.uid) AS totalnum, 
				(SELECT $type FROM pre_live_top c WHERE c.cate='vote' AND c.uid=a.uid) AS b_monthnum FROM pre_live_top a,
				pre_common_member m WHERE a.uid=m.uid AND a.cate!='huoshow') tmp";
		$score_count = $dblink->getRow($sql);
		if ($score_count[0]['count'] >$all_num){
			$score_count[0]['count']=$all_num;
		}
		$addSql = '';
		if ($maxCharm >0) {
			$addSql .= ",(IF(tmp.c_monthnum IS NULL,0,tmp.c_monthnum)*6000/$maxCharm) AS value";
		}
		if ($maxVote >0) {
			$addSql = !empty($addSql) ? ",(IF(tmp.c_monthnum IS NULL,0,tmp.c_monthnum)*6000/$maxCharm+IF(tmp.b_monthnum IS NULL,0,tmp.b_monthnum)*4000/$maxVote) AS value" : 
			",(IF(tmp.b_monthnum IS NULL,0,tmp.b_monthnum)*4000/$maxVote) AS value";
		}
		$desc = '';
		if($maxVote==0 && $maxCharm==0)
		{
			$desc = "LIMIT $start_limit,$num";
		}else {
			$desc = "ORDER BY value DESC LIMIT $start_limit,$num";
		}
//		$addSql = $addSql ? "($addSql) AS value" : 'tmp.vote AS value';
		$sql = "SELECT  tmp.uid,tmp.totalnum,tmp.nickname,IF(tmp.c_monthnum IS NULL,0,tmp.c_monthnum) AS charm,
				IF(tmp.b_monthnum IS NULL,0,tmp.b_monthnum) AS vote
				$addSql FROM
				(SELECT DISTINCT a.uid,IF(m.nickname!='',m.nickname,m.username) AS nickname,
				(SELECT $type FROM pre_live_top b WHERE  b.cate='charm' AND b.uid=a.uid) AS c_monthnum,
				(SELECT totalnum FROM pre_live_top d WHERE  d.cate='charm' AND d.uid=a.uid) AS totalnum,
				(SELECT $type FROM pre_live_top c WHERE  c.cate='vote' AND c.uid=a.uid) AS b_monthnum
				FROM pre_live_top a,pre_common_member m WHERE a.uid=m.uid  AND a.cate!='huoshow') tmp $uidsql $desc";
//		echo $sql;
//		$sql = "SELECT tmp.uid,tmp.charm,tmp.vote,tmp.totalnum,if(m.nickname!='',m.nickname,m.username) as nickname,$addSql FROM 
//				(SELECT a.uid,a.charm,b.vote,a.totalnum FROM (SELECT uid,totalnum,$type AS charm FROM pre_live_top WHERE cate='charm') a,
//				(SELECT uid,$type AS vote FROM pre_live_top WHERE cate='vote') b WHERE a.uid=b.uid) tmp 
//				LEFT JOIN pre_common_member m ON m.uid=tmp.uid $uidsql ORDER BY value DESC LIMIT $start_limit,$num";
		$vote_data = $dblink->getRow($sql);
		$vote_arr = array();
		for ($i=0;$i<count($vote_data);$i++){
			//得到魅力值等级
			$levelInfo = MutilLiveRoomSocketApi::getUserLevel($vote_data[$i]['totalnum'],2);
			//echo $levelInfo[0]["level"];
			$vote_data[$i]['level'] = empty($levelInfo[0]["level"]) ? '1' : $levelInfo[0]["level"];
			$vote_data[$i]["value"] = floor($vote_data[$i]["value"]);
			$vote_arr[] = $vote_data[$i];
		}
		$returnV["score_count"] = $score_count;
		$returnV["score_data"] = $vote_arr;
		return $returnV;
	}
	
	/**
	 * 豪富榜
	 *
	 * @param unknown_type $type  有三种类型
	 * 			daynum  =>  天值
	 * 			weeknum  =>  周值
	 * 			monthnum  => 月值
	 * @param unknown_type $num		数量
	 * @param unknown_type $page    分页
	 */
	function cGetHaselgroveList($type, $num, $page=1){
		$dblink = new DataBase("");
		$start_limit = ($page - 1) * $num;
		$sql = "SELECT t.uid,t.$type as value,m.username,if(m.nickname!='',m.nickname,m.username) as nickname 
				FROM pre_live_top as t LEFT JOIN pre_common_member m ON m.uid=t.uid
				WHERE t.uid NOT IN(SELECT uid FROM pre_common_member WHERE groupid=1) AND t.uid 
				NOT IN(SELECT uid FROM pre_live_room WHERE stat<0) AND t.cate='huoshow' ORDER BY t.$type DESC LIMIT $start_limit,$num";
		$huoshow_data = $dblink->getRow($sql);
		$huoshow_arr = array();
		for ($i=0;$i<count($huoshow_data);$i++){
			//得到豪富等级
			$levelInfo = MutilLiveRoomSocketApi::getUserLevel($huoshow_data[$i]['ch'],1);
			$huoshow_data[$i]['level'] = empty($levelInfo[0]["level"]) ? '1' : $levelInfo[0]["level"];
			$huoshow_arr[] = $huoshow_data[$i];
		}
		return $huoshow_arr;
	}
	
	/**
	 * 单人房，主播,月魅力值，月魅力之星，月魅力指数，及月排名
	 * 返回Json数据
	 *
	 * @param unknown_type $uid
	 */
	function cGetUserCharmRanking($uid){
		$dblink = new DataBase("");
		$sql ="SELECT *,(SELECT COUNT(*) FROM pre_live_top_month_current c WHERE c.exponent > a.exponent )+1 AS rank 
		FROM pre_live_top_month_current a WHERE a.uid=$uid";
		$UserCharmRanking = $dblink->getRow($sql);
		if (empty($UserCharmRanking)){
			$UserCharmRanking = LiveList::Charm_Score_List('monthnum',1,$uid);
			$UserCharmRanking[0]['rank'] = '－';
		}
		return $UserCharmRanking;
	}
}