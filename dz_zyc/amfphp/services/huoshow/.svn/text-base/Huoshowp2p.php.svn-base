<?php
include "Init.php";

class Huoshowp2p extends Init
{	
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 
	 * 获取用户资料
	 * @param Array $arr
	 * @return Void
	 */
	public function login($arr)
    {	
    	$uid = $arr[0];
		$zbuid = $arr[1];		
   		self::logWrite('---------------------------GET USERINFO'.'ZBUID:'.$zbuid.'  UID:'.$uid.' Client Ip:'.$_SERVER['REMOTE_ADDR'].' --login()');   		  		
		$sql = "SELECT a.uid,a.username,b.showcoin,d.resideprovince,d.residecity "
			 . " FROM pre_common_member a "
			 . " LEFT JOIN `pre_ucenter_showcoin` b ON a.uid = b.uid "				
			 . " LEFT JOIN `pre_common_member_profile` d ON a.uid = d.uid "
			 . " WHERE a.uid = '$uid'";				
		$rs = $this->select($sql);			
		if ($rs){
			if($uid==$zbuid){//如果用户ID=主播ID，则该用户是主播
				$rs[0]['admin'] = 2;
			}else{
				$rs[0]['admin'] = 0;
			}			
			$rs[0]['user_name'] = $rs[0]['username'];
			$rs[0]['head'] = DX_URL.'uc_server/avatar.php?uid='.$uid;
			$rs[0]['city'] = $rs[0]['resideprovince'].'-'.$rs[0]['residecity'];
			$rs[0]['zonelink'] = DX_URL.'home.php?mod=space&uid='.$uid;
			
			if($rs[0]['showcoin']==null) $rs[0]['showcoin'] = 0;
			$rs[0]['hxb'] = $rs[0]['showcoin'];
			$rs[0][5]='';
			$rs[0][6]='';
			$rs[0][7]='';
			$rs[0][8]='';
			$rs[0][9]='';
			$rs[0][10]='';
			unset($rs[0]['username']);
			unset($rs[0]['residecity']);
			unset($rs[0]['resideprovince']);
			unset($rs[0]['level']);
			unset($rs[0]['showcoin']);
			$sql = "SELECT charm FROM pre_live_member_count WHERE uid = ".$rs[0]['uid'];
			$charm = @mysql_fetch_array(mysql_query($sql));
			$charm = $charm['charm'];
			$sql = "SELECT level FROM pre_live_level_config WHERE `type` =2 AND $charm >= `valuelower` AND $charm <= `valuehigher`";
			$lev = @mysql_fetch_array(mysql_query($sql));
			if ($lev){
				$rs[0]['zblevel']=$lev['level'];
				if ($rs[0]['zblevel']=='' and $charm>0){
					$l =@mysql_fetch_array(mysql_query("SELECT MAX(`level`) AS level FROM pre_live_level_config WHERE `type` =2 "));
					$rs[0]['zblevel'] = $l['level'];
				}
			}else{
				$rs[0]['zblevel'] = 1;
			}
			$rs[0]['zblevelicon'] = DX_URL.'static2/images/charmlevel/'.$rs[0]['zblevel'].'.png';
			
			$sql = "SELECT showcoin FROM pre_ucenter_showcoin WHERE uid= ".$rs[0]['uid'];
			$coin = @mysql_fetch_array(mysql_query($sql));
			$coin = $coin['showcoin'];
			if ($coin){
				$sql = "SELECT level FROM pre_live_level_config WHERE `type` =1 AND $coin >= `valuelower` AND $coin <= `valuehigher`";
				$lev = @mysql_fetch_array(mysql_query($sql));
				$rs[0]['coinlevel']=$lev['level'];
				if ($rs[0]['coinlevel']=='' and $charm>0){
					$l =mysql_fetch_array(mysql_query("SELECT MAX(`level`) AS level FROM pre_live_level_config WHERE `type` =1 "));
					$rs[0]['coinlevel'] = $l['level'];
				}
			}else{
				$rs[0]['coinlevel'] = 1;
			}
			$rs[0]['coinlevelicon'] = DX_URL.'static2/images/huoshowlevel/'.$rs[0]['coinlevel'].'.png';
			
			return $rs[0];
		}else{
			return 0;
		}
   	
	}
	public function getGift(){
		$sql = "SELECT * FROM `pre_live_gift_type` order by displayorder ASC";
   		$query = mysql_query($sql);
   		$i=0;
   		$arr=array();
   		
   		while ($rs = mysql_fetch_array($query)){
   			
   			$sql = "SELECT a.name as lwname ,a.giftid, a.identifier as lwurl,a.price as price,b.name as level 
					FROM pre_live_gift a 
					LEFT JOIN pre_live_gift_type b ON a.typeid = b.typeid WHERE a.typeid=".$rs['typeid'];
   			$arr[$i][0]='';
			$list = $this->select($sql);
			$arr[$i]['name'][0]=$list;
			$arr[$i]['name'][$rs['name']]=$list;
   			
   			$i++;
   		}
   		return $arr;
   		//return $this->array2xml($arr);
	}
	
	public function getgifts(){
		$sql = "SELECT * FROM `pre_live_gift_type` order by displayorder ASC";
   		$query = mysql_query($sql);
   		$i=0;
   		$arr=array();
   		
   		while ($rs = mysql_fetch_array($query)){
   			
   			$sql = "SELECT a.name as lwname ,a.giftid, a.image as lwurl,a.price as price,b.name as level 
					FROM pre_live_gift a 
					LEFT JOIN pre_live_gift_type b ON a.typeid = b.typeid WHERE a.typeid=".$rs['typeid']." ORDER BY a.giftid ASC";
   			$arr[$i][0]='';
			$list = $this->select($sql);
			for ($u=0;$u<count($list);$u++){
				$list[$u]['lwurl'] = DX_URL.'static2/images/gift/'.$list[$u]['lwurl'];				
			}
			$arr[$i]['name']=$rs['name'];
			$arr[$i]['list']=$list;   			
   			$i++;
   		}
   		return $arr;
		
	}
   /**
    * 
    * 获取礼物列表
    * @return Array
    * array(2=>array('name'=>'高级',list=>array('lwname'=>'金杯')))
    */
	public function giftList()
	{
		self::logWrite('---------------------------GET PUBLIC INFO:GIFT LIST --giftList()');
		return self::getgifts();
	
	
//		$sql = "SELECT a.name as lwname ,a.giftid, a.image as lwurl,a.price as price,b.name as level 
//				FROM pre_live_gift a 
//				LEFT JOIN pre_live_gift_type b ON a.typeid = b.typeid WHERE a.giftid<=26";
//		$rs = $this->select($sql);
//		for ($i=0;$i<count($rs);$i++){
//			$rs[$i]['lwurl'] = DX_URL.'static2/images/gift/'.$rs[$i]['lwurl'];
//		}
//		return $rs;
 		
	}
	
	
	/**
	 * 
	 * 购买礼物
	 * @param Array $arr
	 */
	public function buyGift($arr)
	{
		self::logWrite('---------------------------USER BUY GIFT--buyGift()');
		$buyer = $arr[0];//购买者ID
		$owner = $arr[1];//获得者ID
		if ($buyer == $owner) return 0;
		$giftid = $arr[2];//礼物ID
		$nums = $arr[3];//礼物数量		
		$zbuid = $arr[4];//主播ID
		self::logWrite('BUYER UID:'.$buyer.' OWNER UID:'.$owner.' GIFT ID:'.$giftid.' GIFT NUMS:'.$nums.' ZHUBO ID:'.$zbuid);
		//礼物信息
		$sql = "SELECT * FROM pre_live_gift  WHERE giftid='$giftid'";			
		$giftInfo = mysql_fetch_array(mysql_query($sql));
		$dprice = $giftInfo['price'];//礼物单价
		//消费的火秀币
		$amount = $dprice * $nums;//礼物总价
		
		if($buyer=='' or $buyer==0 or $owner=='' or $owner==0 or $giftid=='' or $giftid==0 or $nums=='' or $nums==0 or $dprice=='') {
			self::logWrite('Buy Fail! Some of Got Data Was Empty!');
			return 0;
		}
		$this->cContributionAndCharm($buyer, $owner,$amount);
		$array = array(0=>$buyer,1=>$amount,2=>'购买礼物:礼物ID:'.$giftid.' 数量:'.$nums.' 单价:'.$dprice);
		if($this->buy($array)){
			
			//主播信息
			$sql = "SELECT * FROM pre_common_member WHERE uid='$owner'";			
			$anchorInfo = mysql_fetch_array(mysql_query($sql));
			$anchorInfo['zbuid'] = $zbuid;						
			if($this->cGiftLogAndUpdateData($buyer, $anchorInfo, $giftInfo, $nums, $amount)==true){
				self::logWrite('Buy Gift Suss,Process Completed!');
				return 1;
			}else{
				return 0;
			}
		}else{
			return 0;
		}	 
	}
	
	
	/**
	 * 写礼物日志，及更新用户数据
	 * @param $user int/array
	 * @param $targetuser int/array
	 * @param $gift int/array
	 * @param $num int
	 * @param $amount int
	 */
	private function cGiftLogAndUpdateData($user, $targetuser, $gift, $num, $amount) 
	{	
		self::logWrite('Start : Write Gift Log AND Update User Gift Nums');
		if (!is_array($user)) {
			
			$user = mysql_fetch_array(mysql_query("SELECT * FROM pre_common_member WHERE uid=$user"));
			
		}
		if (!is_array($targetuser)) {
			$targetuser = mysql_fetch_array(mysql_query("SELECT * FROM pre_common_member WHERE uid=$targetuser"));
		}
		if (!is_array($gift)) {
			$gift = mysql_fetch_array(mysql_query("SELECT * FROM pre_live_gift WHERE giftid=$gift"));
		}	
		
		if (is_array($user) && is_array($targetuser) && is_array($gift) && $num>0 && $amount > 0) {
			
			$roomid = $this->cGetRoomid($targetuser['zbuid']);//房间ID	
			
			//赠送日志
			$data = array(
				'uid'=>$user['uid'],
				'username'=>$user['username'],
				'roomid'=>$roomid,
				'action'=>1,
				'giftid'=>$gift['giftid'],
				'giftname'=>$gift['name'],
				'giftprice'=>$gift['price'],
				'num'=>$num,
				'weight'=>1,
				'value'=>$amount,
				'targetuid'=>$targetuser['uid'],
				'targetusername'=>$targetuser['username'],
				'dateline'=>time(),
			);
			$this->inserts('pre_live_gift_log', $data);
			
			//接受日志
			$data = array(
				'uid'=>$targetuser['uid'],
				'username'=>$targetuser['username'],
				'roomid'=>$roomid,
				'action'=>2,
				'giftid'=>$gift['giftid'],
				'giftname'=>$gift['name'],
				'giftprice'=>$gift['price'],
				'num'=>$num,
				'weight'=>1,
				'value'=>$amount,
				'targetuid'=>$user['uid'],
				'targetusername'=>$user['username'],
				'dateline'=>time(),
			);
			$this->inserts('pre_live_gift_log', $data);			
			//用户礼物数
			$sql = "SELECT * FROM pre_live_member_gift_count WHERE uid=".$targetuser['uid']." AND giftid='".$gift['giftid']."'";			
			$userGift = mysql_fetch_array(mysql_query($sql));
			if (empty($userGift)) {
				$data = array(
					'uid'=>$targetuser['uid'],
					'giftid'=>$gift['giftid'],
					'num'=>$num,
				);
				
				if($this->inserts('pre_live_member_gift_count', $data)){
					self::logWrite('Write Gift Log AND Update User Gift Nums Suss!');
					return true;
				}else{
					self::logWrite('Write Gift Log AND Update User Gift Nums Fail!');
					return false;
				}
			} else {
				
				if(mysql_query("UPDATE pre_live_member_gift_count SET num=num+$num WHERE uid=".$targetuser['uid']." AND giftid='".$gift['giftid']."'")){
					self::logWrite('Write Gift Log AND Update User Gift Nums Suss!');
					return true;
				}else{
					self::logWrite('Write Gift Log AND Update User Gift Nums Fail!');
					return false;
				}
			}			
			
		}
	}
	/**
	 * 
	 * 获取房间ID
	 * @param Array $uid
	 */
	private function cGetRoomid($uid) 
	{
		self::logWrite('Get Room ID--cGetRoomid()');
		$uid= $uid ? $uid :0;
		$sql = "SELECT roomid FROM pre_live_room  WHERE available=1 AND uid=$uid";		
		$roomInfo = mysql_fetch_array(mysql_query($sql));
		if (!empty($roomInfo)) {
			self::logWrite('Get Room ID Suss !ID:'.$roomInfo['roomid']);
			return $roomInfo['roomid'];
		} else {
			self::logWrite('Get Room ID Fail !');
			return 0;
		}
	}
	/**
	 * 用户A增加对用户B增加的贡献度
	 * Enter description here ...
	 * @param unknown_type $uid
	 * @param unknown_type $targetuid
	 * @param unknown_type $value
	 */
	private function  cContributionAndCharm($uid, $targetuid, $value = 0) 
	{
		$roomid = $uid;
		
		//A对B的贡献度
		$sql = "SELECT * FROM pre_live_contribution WHERE uid=$uid AND targetuid=$targetuid";
		
		$rs = mysql_fetch_array(mysql_query($sql));
		
		if (empty($rs)) {
			$userInfo = mysql_fetch_array(mysql_query("SELECT uid,username FROM pre_common_member WHERE uid=$uid"));		
			$data = array(
				'uid'=>$uid,
				'username'=>$userInfo['username'],
				'targetuid'=>$targetuid,
				'contribution'=>0
			);			
			$this->inserts('pre_live_contribution', $data);		
		}
		$sql = "UPDATE pre_live_contribution SET contribution=contribution+$value WHERE uid=$uid AND targetuid=$targetuid";		
		mysql_query($sql);		
		//A对房间的贡献度
		mysql_query("UPDATE pre_live_room_member SET contribution=contribution+$value WHERE uid=$uid AND roomid=$roomid");		
		//A的贡献度和B的魅力值
		mysql_query("UPDATE pre_live_member_count SET contribution=contribution+$value WHERE uid=$uid");
		mysql_query("UPDATE pre_live_member_count SET charm=charm+$value WHERE uid=$targetuid");		
		if ($value) {
			//魅力值排行数据
			$sql = "SELECT * FROM pre_live_top WHERE uid=$targetuid AND cate='charm' AND uid=$targetuid";
			$rs = mysql_fetch_array(mysql_query($sql));
			if (!empty($rs)) {
				$sql = "UPDATE pre_live_top SET daynum=daynum+$value,weeknum=weeknum+$value,monthnum=monthnum+$value WHERE uid=$targetuid AND cate='charm'";				
				mysql_query($sql);
			} else {
				$sql = "SELECT uid,username FROM pre_common_member WHERE uid=$targetuid";
				$targetuserInfo = mysql_fetch_array(mysql_query($sql));
				$username = $targetuserInfo['username'];
				$data = array(
					'cate'=>'charm',
					'uid'=>$targetuid,
					'username'=>$username,
					'daynum'=>$value,
					'weeknum'=>$value,
					'monthnum'=>$value
				);				
				$this->inserts('pre_live_top', $data);
			}
		}
	}
	
	/**
	 * 
	 * 插入数据库
	 * @param unknown_type $table
	 * @param unknown_type $data
	 */
	private function inserts($table, $data) 
	{
		$sql = $this->implode_field_value($data);
		$cmd = 'INSERT INTO';
		$sql = "$cmd $table SET $sql";
		$return = mysql_query($sql);
		return $return;

	}
	/**
	 * 
	 * 拆分插入数据数组
	 * @param unknown_type $array
	 * @param unknown_type $glue
	 */
	private function implode_field_value($array, $glue = ',') 
	{		
		$sql = $comma = '';
		foreach ($array as $k => $v) {
			$sql .= $comma."`$k`='$v'";
			$comma = $glue;
		}
		return $sql;
	}
	
	
	/**
	 * 
	 * 设置配置信息
	 * @param array $arr
	 * @return Integer
	 */
	public function setConfig($arr){
		
		self::logWrite('---------------------------Set Config Info Uid'.$arr[0]['9'].' --setConfig()');	
		
		$roomcolor = $arr[0]['0'];//房间主体颜色
		$roomcontentcolor = $arr[0]['1'];//房间内容背景颜色
		$roomfontcolor = $arr[0]['2'];//房间字体颜色
		$roomtitle = $arr[0]['3'];//用户昵称+房间
		$roominfo = $arr[0]['4'];//房间公告
		$quality = $arr[0]['5'];//视频质量 默认 流畅1流畅 2高清
		$starts = $arr[0]['6'];//离开时候显示的信息
		$pass = $arr[0]['7'];//默认为0,0是不要密码
		$password = $arr[0]['8'];//密码
		$uid = $arr[0]['9'];
		$sql = "SELECT count(*) as count FROM pre_live_room_config WHERE uid = '$uid'";		
		$count = $this->select($sql);
		$nums = $count[0]['count'];
		if($nums==0){
			$sql = "INSERT INTO `pre_live_room_config` (`uid`, `roomtitle`, `roominfo`, `quality`, `pass`, `starts`,`roomcolor`,`roomcontentcolor`,`roomfontcolor`) 
					VALUES
					('$uid', '$roomtitle', '$roominfo', '$quality', '$pass', '$starts', '$roomcolor','$roomcontentcolor','$roomfontcolor')";			
		}else{
			$sql = "UPDATE pre_live_room_config SET 
					roomtitle = '$roomtitle',
					roominfo='$roominfo',
					quality='$quality',
					pass='$pass',
					password='$password',
					starts='$starts',					
					roomcolor = '$roomcolor',
					roomcontentcolor = '$roomcontentcolor',
					roomfontcolor = '$roomfontcolor'
					WHERE uid = $uid";
			
		}		
		if(mysql_query($sql)){
			self::logWrite('SET USER CONFIG INFO:SQL'.$sql);
			return 1;
		}else{
			return 0;
		}				
	}
	
	/**
	 * 
	 * 获取配置信息
	 * @param array $uid
	 * @return Array
	 */
	public function getConfig($uid){
		self::logWrite('---------------------------GET CONFIG INFO :UID:'.$uid[0].' --getConfig()');
		$uid = $uid[0];
		$sql = "SELECT * FROM pre_live_room_config WHERE uid = $uid";
		$rs = $this->select($sql);	
		if ($rs){			
			if($rs[0]['starts']==null){			
				$rs[0]['starts']='接个电话，离开一会';
			}
			return $rs;
		}else{
			return null;
		}		
	}
	
	/**
	 * 
	 * 修改密码
	 * @param array $arr
	 * @return Integer
	 */
	public function updatePassword($arr){
		$uid = $arr[0];
		$password = $arr[1];
		self::logWrite('---------------------------RESET PASSWORD --updatePassword()');
		self::logWrite('UID:'.$uid.'PASSWORD:'.$password);
		$sql = "SELECT * FROM pre_live_room_config WHERE uid = $uid";
		$rs = $this->select($sql);
		if (sizeof($rs)){
			$sql  = "UPDATE pre_live_room_config SET password = '$password' WHERE uid = '$uid'";
		}else{
			$sql = "INSERT INTO pre_live_room_config (uid,password) VALUE ('$uid','$password')";
		}		
		if (mysql_query($sql)) {
			self::logWrite('RESET PASSWORD SUSS！SQL:'.$sql);
			return 1;
		}else{
			self::logWrite('RESET PASSWORD FAIL！SQL:'.$sql);
			return 0;
		}
	}
	
	/**
	 * 
	 * 购买
	 * @param array $arr
	 * @return Integer
	 */
	public function buy($arr){
		$uid = $arr[0];
		$price = $arr[1];		
		if($price<0){
			return 0;			
		}else{
			$type = 'out';
		}
		$remark = $arr[2];
		$dateline = time();
		
		$sql = "SELECT * FROM pre_ucenter_showcoin WHERE uid = $uid ";
		$row = mysql_fetch_array(mysql_query($sql));	
		$balance = $row['showcoin']-$price;
		if($row){
			//return $type;
			if ($type=='out'){
				if($row['showcoin']<$price or $row['showcoin']<=0){
					self::logWrite('Chargeback UID:'.$uid.'  Fee :'.$price.'  FAIL:USER:'.$uid.' Have Not Enough Money');
					return 0;
				}				
			}
			$sql = "UPDATE pre_ucenter_showcoin SET showcoin = showcoin-$price WHERE uid = $uid AND showcoin>=$price";
			if(mysql_query($sql)){
				self::logWrite('Chargeback SQL:'.$sql);
				$sql1 = "INSERT INTO pre_ucenter_showcoin_log (uid,operation,type,remark,amount,dateline,balance) VALUES ('$uid','AFD','$type','$remark','-$price','$dateline','$balance')";
				mysql_query($sql1);
				self::logWrite('Buy Record SQL:'.$sql1);				
				return 1;
			}else{
				self::logWrite('Chargeback:UID:'.$uid.' Fee:'.$price.' Fail!System Error');
				return 0;
			}
		}else{
			self::logWrite('Chargeback:UID:'.$uid.' Fee:'.$price.' FAIL:USER:'.$uid.' Have Not Enough Money');
			return 0;
		}
	}
	
	/**
	 * 
	 * 关闭房间
	 * @param unknown_type $arr
	 * @return Integer
	 */
	public function leaveRoom($arr){		
		$uid = $arr[0];
		$sql = "UPDATE pre_live_room SET available = 0 WHERE uid = $uid";
		if(mysql_query($sql)){
			self::logWrite('关闭房间：主播 UID：'.$uid);
			return 1;
		}else{
			return 0;
		}
	}
	
	/**
	 * 
	 * 统计房间人数
	 * arr[0]主播UID
	 * arr[1]房间人数
	 * arr[2]房间状态 0表示主播不在，1直播中
	 * @param array $arr
	 * @return Integer
	 */
	public function roomStat($arr){
		$uid = $arr[0];
		$members = $arr[1];
		$stat = $arr[2];
		$sql = "UPDATE pre_live_room SET members = $members ,`stat` ='$stat' WHERE uid = $uid";
		if(mysql_query($sql)){
			self::logWrite('---------------------------STAT ROOM MEMBERS:ZHUBO UID:'.$uid.' Members:'.$members.' Stat:'.$stat.' --roomStat()');
			return 1;
		}else{
			return 0;
		}
	}
	
	/**
	 * 
	 * 写日志
	 * @param string $msg
	 */
	public function logWrite($msg){
		$logDir = 'logs/'.date("Ymd");
		if (!file_exists($logDir)){
			mkdir($logDir,0777,1);
		}
		file_put_contents($logDir.'/'.date("H").'logs.txt',date("Y-m-d H:i:s ")."\t".$msg." \r\n",FILE_APPEND);			
	}
	private function array2xml($arr, $htmlon = TRUE, $isnormal = FALSE, $level = 1) {
		//return 1;
		$s = $level == 1 ? "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\r\n<root>\r\n" : '';
		$space = str_repeat("\t", $level);
		foreach($arr as $k => $v) {
			if(!is_array($v)) {
				$s .= $space."<item id=\"$k\">".($htmlon ? '<![CDATA[' : '').$v.($htmlon ? ']]>' : '')."</item>\r\n";
			} else {
				$s .= $space."<item id=\"$k\">\r\n".self::array2xml($v, $htmlon, $isnormal, $level + 1).$space."</item>\r\n";
			}
		}
		$s = preg_replace("/([\x01-\x08\x0b-\x0c\x0e-\x1f])+/", ' ', $s);
		return $level == 1 ? $s."</root>" : $s;
	}
}
?>