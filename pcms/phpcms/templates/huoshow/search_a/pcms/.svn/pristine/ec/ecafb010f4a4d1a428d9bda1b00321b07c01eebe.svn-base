<?php
defined('IN_PHPCMS') or exit('No permission resources.');
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/community/community.php";
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php";
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php";
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/weibo.class.php");

/**
 * 首次登录,以后的流程
 * @author Administrator
 *
 */
class firstlogshow{
	
	public function myregist(){
		$space = DX_URL;
		$formhash = formhash_huo();
		$ip = getIp();
		$data_id = Community::getUserRegIp($ip);
		if ($data_id == 1){
			g('您的IP地址0.5小时内已注册了1 次,请稍后再试！', '/index.php?m=community&c=index&a=index');
		}else {
			include template('community','myshow_reg');	
		}
	}
	
	/**
	 * 关注专辑
	 */
	public function follow_album(){
		$user = UserApi::getLoginUserSessionInfo();
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		if ($user===false){
			g("请登录再进行此操作！","/index.php?m=community&c=index&a=index");
//			header("Location: /index.php?m=community&c=index&a=index");
		}else {
			if (isset($_GET['dosubmit'])) {
				$data = $_POST['dataid'];
				for ($k2 = 0; $k2 < count($data); $k2++) {
					$arr = Community::watchAlbum($user['uid'],$data[$k2]);
				}
				if (checkErr($arr)){
					echo "/index.php?m=community&c=firstlogshow&a=follow_user";	
				}else {
					echo 0;
				}
//				
			}else {
				$user_info = UserApi::getUserName($user['uid']);
				//$spaceurl = DX_URL;
				$dbarr =array();
				//获取推荐位
				$r1 = Community::getLogPositionInfo();
				for ($i = 0; $i < count($r1); $i++) {
					$dbarr[$i][pos_name] = $r1[$i][name];
					$r2 = Community::getPosList($r1[$i][posid]);
					for ($j = 0; $j < count($r2); $j++) {
						$r3 = Community::getAlbumClassId($r2[$j][classid]);
						$r4 = $r3["-msg-"];
						for ($j2 = 0; $j2 < count($r4); $j2++) {
							$dbarr[$i][pos_data][$j][arr][id] = $r4[$j2][id];
							$dbarr[$i][pos_data][$j][arr][album_name] = $r4[$j2][album_name]; 
							$r5 = Community::getShareListFromAlbum($r4[$j2][id],1,"desc",1,9);
							$r6 = $r5["-msg-"]["arr"];
							for ($k = 0; $k < count($r6); $k++) {
								$dbarr[$i][pos_data][$j][arr][img][] = $r6[$k]['small'];
							}
						}
					}
				}
				include template('community','myshow_follow_album');	
			}
		}
		
		
	}
	
	/**
	 * 关注用户
	 */
	public function follow_user(){
		$user = UserApi::getLoginUserSessionInfo();
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		if ($user===false){
			g("请登录再进行此操作！","/index.php?m=community&c=index&a=index");
//			header("Location: /index.php?m=community&c=index&a=index");
		}else {
			if (isset($_GET['dosubmit'])) {
				$data = $_POST['dataid'];
				for ($i = 0; $i < count($data); $i++) {
					$arr = Weibo::followUser($user[uid],$data[$i]);
				}
				if (checkErr($arr)) {
					echo "/index.php?m=community&c=firstlogshow&a=create_album";
				}else {
					echo 0;
				}
			}else {
				$datas = Community::getRecommendedUsers();
				include template('community','myshow_follow_pinner');
			}	
		}
	}
	
	
	/**
	 * 创建专辑页
	 */
	public function create_album(){
		$user = UserApi::getLoginUserSessionInfo();
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		if ($user===false){
			g("请登录再进行此操作！","/index.php?m=community&c=index&a=index");
//			header("Location: /index.php?m=community&c=index&a=index");
		}else {
			if (isset($_GET['dosubmit'])) {
				$arr = $_POST['data'];
				$user_info = UserApi::getUserName($user['uid']);
				$r = Community::UserCreateAlbum($arr,$user_info[0][uid],$user_info[0][nickname]);
				if (checkErr($r)){
					echo "/index.php?m=community&c=index&a=myshow_show_album&album_id=".$r["-msg-"];
//					echo "/index.php?m=community&c=firstlogshow&a=create_album2&id=".$r["-msg-"];
				}else {
					echo 0;
				}
			}else {
				
				include template('community','myshow_create_album_logged1');
			}	
		}
	}
	
	public function create_album2(){
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		$album_id = $_GET['id'];
		if ($user===false){
			g("请登录再进行此操作！","/index.php?m=community&c=index&a=index");
//			header("Location: /index.php?m=community&c=index&a=index");
		}else {
			$datas = Community::getUserAlbumInfo($album_id,$user['uid']);
			include template('community','myshow_create_album_logged2');
		}
	}
	
	
	
}

?>