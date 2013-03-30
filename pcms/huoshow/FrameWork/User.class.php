<?php
/**
 * 用户相关操作封装
 *
 * @author badroom
 * @package defaultPackage
 */
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/configs/config.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/HuoshowSys.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MutilLiveRoom.class.php");
class UserApi
{
	public function __construct()
	{}
	public function __destruct()
	{}
	
	static public function getcookie($skey) 	
	{
		$cookiepre = GLOBAL_COOKIE_PRE.substr(md5(GLOBAL_COOKIE_PATH."|".'.'.GLOBAL_SITEDOMAIN),0,4)."_";
		//$this->var['config']['cookie']['cookiepre'].substr(md5($this->var['config']['cookie']['cookiepath'].'|'.$this->var['config']['cookie']['cookiedomain']), 0, 4).'_';
		$prelength = strlen($cookiepre);
			
		foreach($_COOKIE as $key => $val) {
			if(substr($key, 0, $prelength) == $cookiepre) {
				$key_tmp = substr($key, $prelength);
				if($key_tmp == $skey)
					return $val;
			}
		}
		return false;
	}
	
	/**
	 * 获得已登录的用户相关信息
	 *
	 */
	static public function getLoginUserSessionInfo()
	{
		global $SYSCONFIG;
		if(HuoshowSys::getEmbedEnv()=="dz") //如果是系统管理员后台是嵌入DZ，则直接取
		{
			global $_G;
			require_once($_SERVER['DOCUMENT_ROOT']."/source/function/function_member.php");
			$user_info = authcode(getcookie("auth"),'DECODE');
			
			if(!empty($user_info))
			{
				$user_info = explode("\t",$user_info);;
				$returnVal["pwd"] = $user_info[0];
				$returnVal["uid"] = $user_info[1];
			}
			else 	
				$returnVal = false;
			return $returnVal;
		}
		else 						//如果取消了嵌入，则需要自行判断，暂不实现 
		{

			$user_info = UserApi::authcode(UserApi::getcookie("auth"),'DECODE');
			
			if(!empty($user_info))
			{
				$user_info = explode("\t",$user_info);;
				$returnVal["pwd"] = $user_info[0];
				$returnVal["uid"] = $user_info[1];
			}
			else
				$returnVal = false;
			return $returnVal;
		}
		return false;
	}
	
	static public function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) 
	{
		$ckey_length = 4;
		$authkey = md5(GLOBAL_COOKIE_AUTHKEY.$_SERVER['HTTP_USER_AGENT']);
		$key = md5($key != '' ? $key : $authkey);
		$keya = md5(substr($key, 0, 16));
		$keyb = md5(substr($key, 16, 16));
		$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
	
		$cryptkey = $keya.md5($keya.$keyc);
		$key_length = strlen($cryptkey);
	
		$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
		$string_length = strlen($string);
	
		$result = '';
		$box = range(0, 255);
	
		$rndkey = array();
		for($i = 0; $i <= 255; $i++) {
			$rndkey[$i] = ord($cryptkey[$i % $key_length]);
		}
	
		for($j = $i = 0; $i < 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}
	
		for($a = $j = $i = 0; $i < $string_length; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
		}
	
		if($operation == 'DECODE') {
			if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
				return substr($result, 26);
			} else {
				return '';
			}
		} else {
			return $keyc.str_replace('=', '', base64_encode($result));
		}
	
	}
	
	static public function UserLogin($username,$userpwd)
	{
		
	}
	
	
	/**
	 * 得到用户多音频房间信息和用户信息
	 *
	 */
	static public function getUserInfo($userid){
		if(empty($userid) || !is_numeric($userid) || $userid<1)
			return getR(false,"userid格式错误");
		$dblink = new DataBase("");
		$sql = "SELECT b.*,IF(m.nickname!='',m.nickname,m.username) AS nickname,(SELECT COUNT(*) FROM pre_mutilive_room_manager a WHERE a.roomid=b.roomid) AS manage,
				(SELECT SUM(c.giftprice * c.num) FROM pre_multilive_gift_log c WHERE c.roomid=b.uid AND ACTION=1) AS huo,
				(SELECT pointticket_totalprice FROM pre_mutilive_ticket_stat d WHERE d.uid=b.uid) AS total,
				(SELECT room_type_name FROM pre_mutilive_room_type t WHERE t.id=b.room_class_id ) AS room_type_name,
				(SELECT mic_count FROM pre_mutilive_room_type t WHERE t.id=b.room_class_id ) AS mic_count,
				(SELECT people_limit FROM pre_mutilive_room_type t WHERE t.id=b.room_class_id ) AS people_limit
				FROM pre_multilive_room b LEFT JOIN pre_common_member m ON m.uid=b.uid WHERE b.available=1 AND b.uid=$userid";
		$mutilinfo = $dblink->getRow($sql);
		//如果没有多音频房间则查询用户信息表
		if (count($mutilinfo) == '0'){
			$sql = "SELECT uid,username,IF(nickname!='',nickname,username) AS nickname FROM pre_ucenter_members WHERE uid=$userid";
			$mutilinfo = $dblink->getRow($sql);
		}
		return $mutilinfo;
		$dblink->dbclose();
	}
	
	/**
	 * 获取用户好友列表
	 *
	 * @param unknown_type $userid
	 */
	static public function getUserFriendsList($userid){
		if(empty($userid) || !is_numeric($userid) || $userid<1)
			return getR(false,"userid格式错误");
		$dblink = new DataBase("");
		$sql = "SELECT f.fuid AS uid, f.fusername AS username,f.num,m.username AS name, IF(m.nickname!='',m.nickname,m.username) AS nickname FROM pre_home_friend f LEFT JOIN pre_common_member m ON m.uid=f.uid WHERE f.uid='$userid' ORDER BY num DESC,dateline DESC";
		$friendslist = $dblink->getRow($sql);
		$dblink->dbclose();
		return  empty($friendslist) ? 0 : $friendslist;
	}
	
	/**
	 * 获得主播单音频房间的直播总时长
	 *
	 * @param unknown_type $roomid
	 */
	static public function getUserLiveTime($roomid){
		if(empty($roomid) || !is_numeric($roomid) || $roomid<1)
			return getR(false,"roomid格式错误");
		$dblink = new DataBase("");
		$usertime = $dblink->getRow("SELECT SUM(totaltime) totaltime FROM pre_live_room_log WHERE uid=$roomid");
		$usertime = MutiliveRoom::getTotalTimeShow($usertime[0]['totaltime']);
		$dblink->dbclose();
		return $usertime;
	}
	
	/**
	 * 获取用户姓名和UID
	 *
	 * @param unknown_type $uid
	 * @return unknown
	 */
	static public function getUserName($uid){
		if(empty($uid) || !is_numeric($uid) || $uid<1)
			return getR(false,"uid格式错误");
		$dblink = new DataBase("");
		$sql = "SELECT uid,IF(nickname!='',nickname,username) AS nickname FROM pre_common_member WHERE uid = $uid";
		$username = $dblink->getRow($sql);
		for ($i=0;$i<count($username);$i++){
			$username[$i]["head_img_url"] = getLiveHead($username[$i]["uid"],"middle");
		}
		return $username;
		$dblink->dbclose();
	}
	
	/**
	 * 根据房主id得到UID
	 *
	 * @param unknown_type $roomid
	 */
	static public function getRenterUid($roomid){
		if(empty($roomid) || !is_numeric($roomid) || $roomid<1)
			return getR(false,"roomid格式错误");
		$dblink = new DataBase("");
		$sql = "SELECT uid FROM pre_live_room WHERE roomid=$roomid";
		$data = $dblink->getRow($sql);
		if (count($data)>0){
			$renter_uid = $data;
		}else {
			$sql ="SELECT uid FROM pre_ucenter_members WHERE uid =$roomid";
			$renter_uid = $dblink->getRow($sql);
		}
		return $renter_uid;
		$dblink->dbclose();
	}
	
	static public function getUserIsFollow($myshowuid){
		if(empty($myshowuid) || !is_numeric($myshowuid) || $myshowuid<1)
			return getR(false,"myshowuid格式错误");
		$dblink = new DataBase("");
		$sql = "SELECT COUNT(*) as num FROM pre_community_album_watch_map WHERE uid=$myshowuid";
		$album_arr = $dblink->getRow($sql);
		$sql = "SELECT COUNT(*) as num FROM pre_weibo_follow WHERE src_uid=$myshowuid";
		$follow_arr = $dblink->getRow($sql);
		$sql = "SELECT COUNT(*) as num FROM pre_community_album WHERE uid=$myshowuid";
		$arr = $dblink->getRow($sql);
		$v[album] = $album_arr[0]['num'];
		$v[follow] = $follow_arr[0]['num'];
		$v[arr] = $arr[0]['num'];
		return getR(true,$v);
	}
	
	/**
	 * 社区用户是否已存在
	 * @param unknown_type $uid
	 * @return unknown_type|unknown
	 */
	static public function getCommunityUser($uid){
		if(empty($uid) || !is_numeric($uid) || $uid<1)
			return getR(false,"uid格式错误");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_community_user_stat WHERE uid=$uid";
		$arr = $dblink->getRow($sql);
		return $arr;
	}

}
?>