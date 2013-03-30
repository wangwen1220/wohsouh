<?php
defined('IN_PHPCMS') or exit('No permission resources.');
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/community/community.php";
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php";
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php";
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MyshowPager.class.php";
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/weibo.class.php");
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/function.core.php";
pc_base::load_app_class('admin','admin',0);
/**
 * 我的火秀,用户后台
 * @author Administrator
 *
 */
class myhuoshow{

	/**
	 * 我的火秀首页
	 */
	public function index(){
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		print_r($user_info);
		die("1111");
	}
	
	/**
	 * 我的专辑
	 */
	public function myalbum(){	
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$myshowuid = $_GET['myuid'];
		//类型  type为1 自己的专辑，2自己关注的专辑
		if ($user['uid'] == $myshowuid){
			$m_user_uid = $user['uid'];
			$user_info = UserApi::getUserName($m_user_uid);
			$users_total = Community::getUserTotalInfo($m_user_uid);
			//print_r($users_total);
			$user_follow = Weibo::getUserAllFollow($m_user_uid);
			$big_avatar = getLiveHead($m_user_uid,'big');
			$signa = Community::getUserSignature($m_user_uid);
			//自己的专辑
			$m_album = Community::getUserAlbumList($m_user_uid,1,4,"desc",$page,6);
			//自己关注的专辑
			$f_album = Community::getUserAlbumList($m_user_uid,2,1,"desc",$page,6);	
			$is_follow = Community::IsFollowUser($user['uid'], $m_user_uid);
			$user_share_num = Community::getUserShareNum($user['uid']);
			//print_r($f_album);
		}else {
			$m_user_uid = $myshowuid;
			$user_info = UserApi::getUserName($m_user_uid);
			$users_total = Community::getUserTotalInfo($m_user_uid);
			$user_follow = Weibo::getUserAllFollow($m_user_uid);
			$big_avatar = getLiveHead($m_user_uid,'big');
			$signa = Community::getUserSignature($m_user_uid);
			$is_follow = ($user===false) ? 0 : Community::IsFollowUser($user['uid'], $m_user_uid);
			//他的专辑
			$m_album = Community::getUserAlbumList($m_user_uid,1,4,"desc",$page,6);
			for($i=0;$i<count($m_album);$i++){
				$m_album[$i][isfollowalbum] = Community::IsFollowAlbum($m_album[$i]['id'],$user['uid']);//判断专辑是否关注过
			}
			//他关注的专辑
			$f_album = Community::getUserAlbumList($m_user_uid,2,1,"desc",$page,6);	
			for($i=0;$i<count($f_album);$i++){
				$f_album[$i][isfollowalbum] = Community::IsFollowAlbum($f_album[$i]['id'],$user['uid']);//判断专辑是否关注过
			}
		}
		if(empty($users_total[album])){
		$users_total[album]=0;
		}
		if(empty($f_album[0]['numfollow'])){
			$f_album[0]['numfollow'] = 0;
		}
		$page_split = new MyPagerSplit($users_total[album],$page,6,"/index.php?m=community&c=myhuoshow&a=ajax_create_myalbum&myuid=$myshowuid&page={#page}");
 		$page_str = $page_split->MyGetPagerContent($type="album");//创建专辑总数分页
 		$page_split_follow = new MyPagerSplit($f_album[0]['numfollow'],$page,6,"/index.php?m=community&c=myhuoshow&a=ajax_follow_album&myuid=$myshowuid&page={#page}");
 		$page_str_follow = $page_split_follow->MyGetPagerContent($type="album");//关注专辑总数分页
		include template('community','myshow_user_album');
	}
	
	//创建专辑列表接口
	public function ajax_create_myalbum(){
		$user = UserApi::getLoginUserSessionInfo();
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$myshowuid = $_GET['myuid'];
		//类型  type为1 自己的专辑，2自己关注的专辑
		if ($user['uid'] == $myshowuid){
			$m_user_uid = $user['uid'];
			$user_info = UserApi::getUserName($m_user_uid);
			$users_total = Community::getUserTotalInfo($m_user_uid);
			$user_follow = Weibo::getUserAllFollow($m_user_uid);
			$big_avatar = getLiveHead($m_user_uid,'big');
			//自己的专辑
			$m_album = Community::getUserAlbumList($m_user_uid,1,4,"desc",$page,6);
			//自己关注的专辑
			//$f_album = Community::getUserAlbumList($m_user_uid,2,1,"desc",$page,6);	
		}else {
			$m_user_uid = $myshowuid;
			$user_info = UserApi::getUserName($m_user_uid);
			$users_total = Community::getUserTotalInfo($m_user_uid);
			$user_follow = Weibo::getUserAllFollow($m_user_uid);
			$big_avatar = getLiveHead($m_user_uid,'big');
			//他的专辑
			$m_album = Community::getUserAlbumList($m_user_uid,1,4,"desc",$page,6);
			for($i=0;$i<count($m_album);$i++){
				$m_album[$i][isfollowalbum] = Community::IsFollowAlbum($m_album[$i]['id'],$user['uid']);//判断专辑是否关注过
			}
			//他关注的专辑
			//$f_album = Community::getUserAlbumList($m_user_uid,2,1,"desc",$page,6);	
		}
		if(empty($users_total[album])){
		$users_total[album]=0;
		}
		$page_split = new MyPagerSplit($users_total[album],$page,6);
 		$page_str = $page_split->MyGetPagerContent($type="album");
		include template('community','myshow_user_ajax_album');
	}
	
	
	
	//关注专辑列表接口
	public function ajax_follow_album(){
		$user = UserApi::getLoginUserSessionInfo();
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$myshowuid = $_GET['myuid'];
		//类型  type为1 自己的专辑，2自己关注的专辑
		if ($user['uid'] == $myshowuid){
			$m_user_uid = $user['uid'];
			$user_info = UserApi::getUserName($m_user_uid);
			$users_total = Community::getUserTotalInfo($m_user_uid);
			$user_follow = Weibo::getUserAllFollow($m_user_uid);
			$big_avatar = getLiveHead($m_user_uid,'big');
			//自己的专辑
			//$m_album = Community::getUserAlbumList($m_user_uid,1,4,"desc",$page,6);
			//自己关注的专辑
			$f_album = Community::getUserAlbumList($m_user_uid,2,1,"desc",$page,6);	
			
		}else {
			$m_user_uid = $myshowuid;
			$user_info = UserApi::getUserName($m_user_uid);
			$users_total = Community::getUserTotalInfo($m_user_uid);
			$user_follow = Weibo::getUserAllFollow($m_user_uid);
			$big_avatar = getLiveHead($m_user_uid,'big');
			//他的专辑
			//$m_album = Community::getUserAlbumList($m_user_uid,1,4,"desc",$page,6);
			//for($i=0;$i<count($m_album);$i++){
				//$m_album[$i][isfollowalbum] = Community::IsFollowAlbum($m_album[$i]['id'],$user['uid']);//判断专辑是否关注过
			//}
			//他关注的专辑
			$f_album = Community::getUserAlbumList($m_user_uid,2,1,"desc",$page,6);	
			for($i=0;$i<count($f_album);$i++){
				$f_album[$i][isfollowalbum] = Community::IsFollowAlbum($f_album[$i]['id'],$user['uid']);//判断专辑是否关注过
			}
			
		}
		if(empty($f_album[0]['numfollow'])){
			$f_album[0]['numfollow'] = 0;
		}
		$page_split_follow = new MyPagerSplit($f_album[0]['numfollow'],$page,6);
 		$page_str_follow = $page_split_follow->MyGetPagerContent($type="album");//关注专辑总数分页
		include template('community','myshow_ajax_follow_album');
	}
	
	
	/**
	 * 我的分享
	 */
	public function myshare(){
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$prepage = empty($_GET['perpage']) ? '21':$_GET['perpage'];
		$myshowuid = $_GET['myuid'];
		$status = ($user['uid']==$myshowuid) ? 0:99;
		$lists = empty($_GET['list']) ? '0' : $_GET['list'];
		if ($lists == 1) { //lists为1请求json数据
			$datas = Community::getUserShareList($myshowuid,3,$status,"desc",$page,$prepage);
			$count_num = $datas["-msg-"][num];
			$datas = $datas["-msg-"][arr];
			$arr = array();
			for ($i=0;$i<count($datas);$i++) {
				$arr[$i]['id'] = $datas[$i]['id'];
				$arr[$i]['like'] = ($user===false) ? 0 : Community::IsLikeShare($datas[$i]['id'], $user[uid]);
				$arr[$i]['edit'] = ($user[uid] == $datas[$i]['uid']) ? 1:0;
				$arr[$i]['description'] = $datas[$i]['description'];
				$arr[$i]['tags'] = Community::getShareTagName($datas[$i]['id']);//标签暂时为空
				$arr[$i]['image_url'] = $datas[$i]['thumb'];
				$image = getimagesize($datas[$i]['thumb']);
				$arr[$i]['image_width'] = ($datas[$i]['file_type'] == 2) ? 208:$image[0];
				$arr[$i]['image_height'] = ($datas[$i]['file_type'] == 2) ? 150:$image[1];
				if ($datas[$i]['file_type'] == 1){ //图片
					$image_meta = ($arr[$i]['image_height']>800) ? "<span class='image-overlay'></span>":"";
				}elseif ($datas[$i]['file_type'] ==2){ //视频 
					$image_meta = "<span class='meta video'></span>";
				}elseif ($datas[$i]['file_type'] ==3){ //商品
					//$image_meta = urlencode("<span class='meta price'>￥".$datas[$i]['price']."</span>");
					if($datas[$i]['priceimg']!= ""){
						$image_meta = "<span class='meta price img-price'>".$datas[$i]['priceimg']."</span>";
					}else{
						if($datas[$i]['price']!=0){
						$image_meta = urlencode("<span class='meta price'>￥".$datas[$i]['price']."</span>");
						}
					}
				}
				$arr[$i]['image_meta'] = $image_meta;
				$arr[$i]['isgoods'] = ($datas[$i]['file_type'] ==3) ? 1:0;
				$arr[$i]['like_num'] = $datas[$i]['be_like_count'];
				$arr[$i]['repin_num'] = $datas[$i]['be_collect_count'];
				$arr[$i]['comment_num'] = $datas[$i]['be_reply_count'];
				$arr[$i]['owner_id'] = $datas[$i]['uid'];//用户ID
				$arr[$i]['owner_name'] = urlencode($datas[$i]['nickname']);//用户名称
				$arr[$i]['owner_url'] = "/m".$datas[$i]['uid'].".html";//用户信息链接
				$arr[$i]['owner_avatar'] = getLiveHead($datas[$i]["uid"],"small");//用户图像
				$arr[$i]['owner_signature'] = Community::getUserSignature($datas[$i]["uid"]);//用户签名
//				$arr[$i]['owner_stats'] = urlencode("分享 <em>(".$datas[$i][user_arr][share].")</em> 专辑 <em>(".$datas[$i][user_arr][album].")</em> 粉丝 <em>(".$datas[$i][user_arr][fans].")</em>");//用户名片信息
				$arr[$i]['owner_stats'] = urlencode("分享 <em>(<a target='_blank' href='/m".$datas[$i][uid].".html'>".$datas[$i][user_arr][share]."</a>)</em> 专辑 <em>(<a target='_blank' href='/zj".$datas[$i][uid].".html'>".$datas[$i][user_arr][album]."</a>)</em> 粉丝 <em>(<a target='_blank' href='/fs".$datas[$i][uid].".html'>".$datas[$i][user_arr][fans]."</a>)</em>");//用户名片信息
				$arr[$i]['album_name'] = $datas[$i]['album_name'];
				$arr[$i]['album_id'] = $datas[$i]['albumid'];//专辑ID
				$arr[$i]['album_url'] = "/zj-".$datas[$i]['albumid'].".html";//专辑页URL
				$arr[$i]['follow'] = ($user===false) ? 0 : Community::IsFollowUser($user['uid'], $datas[$i]['uid']);
				$arr[$i]['comment_action'] = "/index.php?m=community&c=index&a=add_comment&share_id=".$datas[$i]['id']; //评论提交路径
				$arr[$i]['pin_url'] = "/show-".$datas[$i]['id'].".html"; //详细页路径
				$arr[$i]['letter_url'] = "/index.php?m=community&c=index&a=send_message&src_uid=$user[uid]&dst_uid=".$datas[$i]['uid'];//私信  
				
			}
			$totalpage = ceil($count_num/$prepage);
			$content->admin = ($user===false) ? 0 : Community::SystemUserDelShare($user[uid]);
			$content->success = true;
			$content->login = ($user===false) ? 0 : 1;
			$content->data = $arr;
			$content->totalpage = $totalpage; //总页数
			$content->page = $page; //第几页
			$content->prepage = intval($prepage); //一页多少条
			$content->stat = "ok";
			echo urldecode(json_encode($content));
		}else {
			if ($user['uid'] == $myshowuid){
				$m_user_uid = $user['uid'];
				$user_info = UserApi::getUserName($m_user_uid);
				$users_total = Community::getUserTotalInfo($m_user_uid);
				$user_follow = Weibo::getUserAllFollow($m_user_uid);
				$big_avatar = getLiveHead($m_user_uid,"big");
				$signa = Community::getUserSignature($m_user_uid);
				$is_follow = Community::IsFollowUser($user['uid'], $m_user_uid);
				$user_share_num = Community::getUserShareNum($user['uid']);
			}else {
				$m_user_uid = $myshowuid;
				$user_info = UserApi::getUserName($m_user_uid);
				$users_total = Community::getUserTotalInfo($m_user_uid);
				$user_follow = Weibo::getUserAllFollow($m_user_uid);
				$big_avatar = getLiveHead($m_user_uid,"big");
				$signa = Community::getUserSignature($m_user_uid);
				$is_follow = ($user===false) ? 0 : Community::IsFollowUser($user['uid'], $m_user_uid);
			}
			include template('community','myshow_user_pin');
		}
	}
	
	/**
	 * 我的喜欢
	 */
	public function mylike(){
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$prepage = empty($_GET['perpage']) ? '21':$_GET['perpage'];
		$myshowuid = $_GET['myuid'];
		$lists = empty($_GET['list']) ? '0' : $_GET['list'];
		if ($lists == 1) { //lists为1请求json数据
			$datas = Community::getUserLikeList($myshowuid,3,'desc',$page,$prepage);
//			$count_num = count($datas);
			$count_num = $datas["-msg-"][num];
			$datas = $datas["-msg-"][arr];
			$arr = array();
			for ($i=0;$i<count($datas);$i++) {
				$arr[$i]['id'] = $datas[$i]['id'];
				$arr[$i]['like'] = ($user===false) ? 0 : Community::IsLikeShare($datas[$i]['id'], $user[uid]);
				$arr[$i]['edit'] = ($user[uid] == $datas[$i]['uid']) ? 1:0;
				$arr[$i]['description'] = $datas[$i]['description'];
				$arr[$i]['tags'] = Community::getShareTagName($datas[$i]['id']);//标签暂时为空
				$arr[$i]['image_url'] = $datas[$i]['thumb'];
				$image = getimagesize($datas[$i]['thumb']);
				$arr[$i]['image_width'] = ($datas[$i]['file_type'] == 2) ? 208:$image[0];
				$arr[$i]['image_height'] = ($datas[$i]['file_type'] == 2) ? 150:$image[1];
				if ($datas[$i]['file_type'] == 1){ //图片
					$image_meta = ($arr[$i]['image_height']>800) ? "<span class='image-overlay'></span>":"";
				}elseif ($datas[$i]['file_type'] ==2){ //视频 
					$image_meta = "<span class='meta video'></span>";
				}elseif ($datas[$i]['file_type'] ==3){ //商品
					//$image_meta = urlencode("<span class='meta price'>￥".$datas[$i]['price']."</span>");
					if($datas[$i]['priceimg']!= ""){
						$image_meta = "<span class='meta price img-price'>".$datas[$i]['priceimg']."</span>";
					}else{
						if($datas[$i]['price']!=0){
						$image_meta = urlencode("<span class='meta price'>￥".$datas[$i]['price']."</span>");
						}
					}
				}
				$arr[$i]['image_meta'] = $image_meta;
				$arr[$i]['isgoods'] = ($datas[$i]['file_type'] ==3) ? 1:0;
				$arr[$i]['like_num'] = $datas[$i]['be_like_count'];
				$arr[$i]['repin_num'] = $datas[$i]['be_collect_count'];
				$arr[$i]['comment_num'] = $datas[$i]['be_reply_count'];
				$arr[$i]['owner_id'] = $datas[$i]['uid'];//用户ID
				$arr[$i]['owner_name'] = urlencode($datas[$i]['nickname']);//用户名称
				$arr[$i]['owner_url'] = "/m".$datas[$i]['uid'].".html";//用户信息链接
				$arr[$i]['owner_avatar'] = getLiveHead($datas[$i]["uid"],"small");//用户图像
				$arr[$i]['owner_signature'] = Community::getUserSignature($datas[$i]["uid"]);//用户签名
//				$arr[$i]['owner_stats'] = urlencode("分享 <em>(".$datas[$i][user_arr][share].")</em> 专辑 <em>(".$datas[$i][user_arr][album].")</em> 粉丝 <em>(".$datas[$i][user_arr][fans].")</em>");//用户名片信息
				$arr[$i]['owner_stats'] = urlencode("分享 <em>(<a target='_blank' href='/m".$datas[$i][uid].".html'>".$datas[$i][user_arr][share]."</a>)</em> 专辑 <em>(<a target='_blank' href='/zj".$datas[$i][uid].".html'>".$datas[$i][user_arr][album]."</a>)</em> 粉丝 <em>(<a target='_blank' href='/fs".$datas[$i][uid].".html'>".$datas[$i][user_arr][fans]."</a>)</em>");//用户名片信息
				$arr[$i]['album_name'] = $datas[$i]['album_name'];
				$arr[$i]['album_id'] = $datas[$i]['albumid'];//专辑ID
				$arr[$i]['album_url'] = "/zj-".$datas[$i]['albumid'].".html";//专辑页URL
				$arr[$i]['follow'] = ($user===false) ? 0 : Community::IsFollowUser($user['uid'], $datas[$i]['uid']);
				$arr[$i]['comment_action'] = "/index.php?m=community&c=index&a=add_comment&share_id=".$datas[$i]['id']; //评论提交路径
				$arr[$i]['pin_url'] = "/show-".$datas[$i]['id'].".html"; //详细页路径
				$arr[$i]['letter_url'] = "/index.php?m=community&c=index&a=send_message&src_uid=$user[uid]&dst_uid=".$datas[$i]['uid'];//私信  
				
			}
//			print_r($arr);
			$totalpage = ceil($count_num/$prepage);
			$content->success = true;
			$content->login = ($user===false) ? 0 : 1;
			$content->data = $arr;
			$content->totalpage = $totalpage; //总页数
			$content->page = $page; //第几页
			$content->prepage = intval($prepage); //一页多少条
			$content->stat = "ok";
			echo urldecode(json_encode($content));
		}else {
			if ($user['uid'] == $myshowuid){
				$m_user_uid = $user['uid'];
				$user_info = UserApi::getUserName($m_user_uid);
				$users_total = Community::getUserTotalInfo($m_user_uid);
				$user_follow = Weibo::getUserAllFollow($m_user_uid);
				$big_avatar = getLiveHead($m_user_uid,"big");
				$signa = Community::getUserSignature($m_user_uid);
				$is_follow = Community::IsFollowUser($user['uid'], $m_user_uid);
				$user_share_num = Community::getUserShareNum($user['uid']);
			}else {
				
				$m_user_uid = $myshowuid;
				$user_info = UserApi::getUserName($m_user_uid);
				$users_total = Community::getUserTotalInfo($m_user_uid);
				$user_follow = Weibo::getUserAllFollow($m_user_uid);
				$big_avatar = getLiveHead($m_user_uid,"big");
				$signa = Community::getUserSignature($m_user_uid);
				$is_follow = ($user===false) ? 0 : Community::IsFollowUser($user['uid'], $m_user_uid);
			}
//			include template('community','myshow_user_like');
			include template('community','myshow_user_pin');
		}		
	}
	
	/**
	 * 我的粉丝
	 */
	public function myfans(){
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$myshowuid = $_GET['myuid'];
		if ($user['uid'] == $myshowuid){  //自己的粉丝页面
			$m_user_uid = $user['uid'];
			$user_info = UserApi::getUserName($m_user_uid);
			$my_fans_arr = Weibo::getUserSelfFollow($m_user_uid,$page,20);
			$my_fans_data = $my_fans_arr["record_arr"];
			for ($i = 0; $i < count($my_fans_data); $i++) {
				$my_fans_data[$i][is_arr] = Community::getUserIsFollow($user['uid'], $my_fans_data[$i][uid]);
				$my_fans_data[$i][signa] = Community::getUserSignature($my_fans_data[$i]['uid']);
				$my_fans_data[$i][user_arr] = Community::getUserTotalInfo($my_fans_data[$i]["uid"]);
			}
		}else {
			$m_user_uid = $myshowuid;
			$user_info = UserApi::getUserName($m_user_uid);
			$my_fans_arr = Weibo::getUserSelfFollow($m_user_uid,$page,20);
			$my_fans_data = $my_fans_arr["record_arr"];
			for ($i = 0; $i < count($my_fans_data); $i++) {
				$my_fans_data[$i][is_arr] = ($user===false) ? 0 :Community::getUserIsFollow($user['uid'], $my_fans_data[$i][uid]);
				$my_fans_data[$i][signa] = Community::getUserSignature($my_fans_data[$i][uid]);
				$my_fans_data[$i][user_arr] = Community::getUserTotalInfo($my_fans_data[$i]["uid"]);
			}
		}
		$count = $my_fans_arr["record_count"];
		$datas = $my_fans_data;
		$page_split = new PagerSplit($count,$page,20);
		$page_str = $page_split->GetPagerContent();

		include template('community','myshow_my_fans');
	}
	
	/**
	 * 我的关注
	 */
	public function myfollow(){
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$myshowuid = $_GET['myuid'];
		if ($user['uid'] == $myshowuid){  //自己的关注页面
			$m_user_uid = $user['uid'];
			$user_info = UserApi::getUserName($m_user_uid);
			$follow_tol = Weibo::getUserFollowTotal($m_user_uid);
			$my_follow = weibo::getUserAllFollow($m_user_uid,0,$page,20);
			for ($i = 0; $i < count($my_follow); $i++) {
				$my_follow[$i][is_arr] = Community::getUserIsFollow($user['uid'], $my_follow[$i][uid]);
				$my_follow[$i][signa] = Community::getUserSignature($my_follow[$i][uid]);
				$my_follow[$i][user_arr] = Community::getUserTotalInfo($my_follow[$i]["uid"]);
			}
		}else {
			$m_user_uid = $myshowuid;
			$user_info = UserApi::getUserName($m_user_uid);
			$follow_tol = Weibo::getUserFollowTotal($m_user_uid);
			$my_follow = Weibo::getUserAllFollow($m_user_uid,0,$page,20);
			for ($i = 0; $i < count($my_follow); $i++) {
				$my_follow[$i][is_arr] = Community::getUserIsFollow($user['uid'], $my_follow[$i][uid]);
				$my_follow[$i][signa] = Community::getUserSignature($my_follow[$i][uid]);
				$my_follow[$i][user_arr] = Community::getUserTotalInfo($my_follow[$i]["uid"]);
			}
		}
		$count = $follow_tol;
		$datas = $my_follow;
		$page_split = new PagerSplit($count,$page,20);
		$page_str = $page_split->GetPagerContent();
		include template('community','myshow_my_follow');
		
	}
	
	
	/**
	 *	喜欢分享
	 */
	public function mylikeshare(){
		$user = UserApi::getLoginUserSessionInfo();
		$lists = empty($_GET['list']) ? 1 : 2;
		if ($user===false){
			g("请登录再进行此操作！","/index.php?m=community&c=index&a=index");
//			header("Location: /index.php?m=community&c=index&a=index");
		}else {
			$uid = $user['uid'];
			$share_id = $_GET['shareid'];
			if ($lists == 1){//喜欢
				$r = Community::likeShare($uid,$share_id);
			}else {//取消
				$r = Community::CancelLikeShare($uid,$share_id);
			}
			if (checkErr($r)){
				echo 1;	
			}else {
				echo 0;
			}
			
		}
	}
	
	/**
	 * 关注用户
	 */
	public function myfollowuser(){
		$user = UserApi::getLoginUserSessionInfo();
		if ($user===false){
			g("请登录再进行此操作！","/index.php?m=community&c=index&a=index");
//			header("Location: /index.php?m=community&c=index&a=index");
		}else {
			$src_uid = $_GET['src_uid'];
			$dst_uid = $_GET['dst_uid'];
			$lists = empty($_GET['list']) ? 1:2;
			if ($lists == 1) {
				$r = Weibo::followUser($src_uid,$dst_uid);
			}else {
				$r = Weibo::cancelFollowUser($src_uid,$dst_uid);
			}
			if (checkErr($r)){
				echo 1;	
			}else {
				echo 0;
			}
		}
	}
	
	/**
	 * ajax上传并生成缩略图
	 */
	public function ajaxmyupload(){
		if ($_FILES['image']['name']){
			//获取传递过来的专辑id
			$getalbum_id = $_GET['album_id'];
			//根据专辑ID获取专辑名称
			if($getalbum_id!=""){
				$getalbum_info = Community::getAlbumInfo($getalbum_id);
				$getalbum_name = $getalbum_info['-msg-']['arr'][0]['album_name'];
			}
			$upload_size = $_FILES["image"]["size"];
			$upload_filetype = $_FILES["image"]["type"]; //获取文件类型
			$max_size = 2048; //限制上传大小
//			if ($upload_size>$max_size){
//				g('您上传的图片超过2M,请您重新上传', '/index.php?m=community&c=index&a=myshow_collect_all');
//			}
			$uploaddir = "myshowpic"; //指定文件存储路径
			if (!file_exists($uploaddir)) mkdir($uploaddir, 0777, 1 );
			$image = $uploaddir.'/'.time().$_FILES['image']['name'];
			if(!copy($_FILES['image']['tmp_name'], $image)) {	
				die('上传失败');
			}
			   
			//生成缩略图
//			$thumb = MiniImg($image,"208**",72,0,true);
			$thumb = CommunityImg($image,"208**",100,0,'big',true);
			//生成60*60小图
			$small = CommunityImg($image,"165*165",100,1,'small',true);

			//取默认数据
			$user = UserApi::getLoginUserSessionInfo();
			//获取默认专辑
			$a_arr = Community::getDefaultAlbum();
			$a_arr_t = Community::getClassTagMap($a_arr[0][class_id]);
			if (empty($getalbum_id)){
				$a_arr_tag = $a_arr_t["-msg-"];
			}else{
				$a_arr_tag = Community::getalbumtap($getalbum_id);//根据专辑获取对应标签
			}
			//获取默认类别
			$c_arr = Community::getDefaultClass();
			//获取类别列表
			$c_arr_t = Community::getClassList();
			$c_arr_class = $c_arr_t['-msg-']['arr'];
			//获取专辑类别
			$r = Community::getAlbumList(0,$user['uid'],1,1,50);
			if(checkErr($r)){
				$albumlist = $r["-msg-"];
				$list_arr = $albumlist["arr"];
			}else{
				echo $r["-msg-"];
				die();
			}
			include template('community','myshow_upload');
		}else {
			echo '上传失败！';
		}		
//		Community::createClass($_POST['name'],$image);
	}
	
	/**
	 * 上传并发布分享
	 */
	public function myupload(){
		$act_submit = $_GET["act_submit"];
		$user = UserApi::getLoginUserSessionInfo();
		if (!empty($user['uid'])) {
			if ($act_submit == "yes"){
				//获取用户
				$user_info = UserApi::getUserName($user['uid']);
				$uid = $user_info[0]['uid'];//用户UID
				$nickname = $user_info[0]['nickname'];//用户姓名
				
				$tags_arr = $_POST['tags_arr']; //选择标签
				$input_tags_arr =  $_POST['input_tags_arr']; //写入标签
				//检查是否为空
				$is_tags_arr = implode(',',$tags_arr);
				$is_input_tags_arr = implode(',',$input_tags_arr);
				
				if (empty($is_tags_arr)){
					$tags_arr = array();	
				}
				if (empty($is_input_tags_arr)){
					$tag_id_arr = array();	
				}
				//查找标签是否已存在
				if ($is_input_tags_arr){
					$da = Community::getTagIsPresence($input_tags_arr,$user_info[0]['uid']);
					if (checkErr($da)) {
						$tag_id_arr = $da["-msg-"];
					}else {
						echo $da["-msg-"];
						die();
					}	
				}
				//合并标签数组
				$cards = array_merge($tags_arr, $tag_id_arr);
				//标签数组
				$tag_arr = $cards;
				//分享名称
				$share_name = "上传图片分享";
				$file_path = $_GET['original_pic'];//图片
				$remote_url = "";//远程采集地址
				$file_thumb = $_GET['thumb'];//缩略图
				$file_small = $_GET['small'];
				$descrition = $_GET['description'];//描述
								
				//默认专辑
				$a_arr = Community::getDefaultAlbum();
				//专辑ID
				$albumid = ($_GET['album_id'] == 'default_id') ? $a_arr[0][id]:$_GET['album_id'];
				$albumname = Community::getAlbumName($albumid);
				//创建分享
				$add_img = Community::createShare($uid,$nickname,$share_name,$file_path,
				$remote_url,$file_thumb,$file_small,$tag_arr,$albumid,$descrition,1,0);
				//成功跳转
				if (checkErr($add_img)) {
					$transfer_type = 1;
					include template('community','myshow_repin_success');
				}else {
					echo false;
				}
			}
		}else {
			g("请登录再进行此操作！","/index.php?m=community&c=index&a=index");	
		}
	}
	
	/**
	 * 粉丝页、关注页，关注和取消关注
	 */
	public function userfowllow(){
		$user = UserApi::getLoginUserSessionInfo();
		if ($user===false){
			g("请登录再进行此操作！","/index.php?m=community&c=index&a=index");	
//			header("Location: /index.php?m=community&c=index&a=index");
		}else {
			//1为关注，否则为取消
			$list = empty($_GET['list']) ? 1 : $_GET['list'];
			//跳转页面
			$a = ($_GET['url'] == 'myfans') ? 'myfans':'myfollow';
			$url_uid = $_GET['myuid'];
			$src_uid = $_GET['src_uid'];
			$dst_uid = $_GET['dst_uid'];
			if ($list == 1) {  //关注
				$r = Weibo::followUser($src_uid,$dst_uid);
				$list_name = "关注成功！";
			}else {			   //取消
				$r = Weibo::cancelFollowUser($src_uid,$dst_uid);
				$list_name = "取消关注！";
			}
			if (checkErr($r)){
				g($list_name,'/index.php?m=community&c=myhuoshow&a='.$a.'&myuid='.$url_uid);
			}else {
				g('失败！','/index.php?m=community&c=myhuoshow&a='.$a.'&myuid='.$url_uid);
			}
		}
	}
	
	/**
	 * 删除自己分享
	 */
	public function userdelshare(){
		$user = UserApi::getLoginUserSessionInfo();
		if ($user===false){
			g("请登录再进行此操作！","/index.php?m=community&c=index&a=index");	
//			header("Location: /index.php?m=community&c=index&a=index");
		}else {
			$share_id = $_GET['id'];
			$r = Community::deleteShare($user['uid'],$share_id);
			if (checkErr($r)) {
				g('删除分享成功，此操作不能恢复！', '/index.php?m=community&c=index&a=index');
			}else {
				g('删除分享失败！', '/index.php?m=community&c=index&a=index');
			}
		}
	}
	
	
	/**
	 * 删除自己专辑
	 */
	public function userdelalbum(){
		$album_id = $_GET['id'];
		$user = UserApi::getLoginUserSessionInfo();
		$isuseralbum = Community::GetAlbumUid($user['uid'],$album_id);
		if ($user===false){
			g("请登录再进行此操作！","/index.php?m=community&c=index&a=index");	
//			header("Location: /index.php?m=community&c=index&a=index");
		}elseif($isuseralbum == 1) {//增加验证删除专辑是否属于自己的专辑
			
			$r = Community::deleteAlbum($album_id);
			if (checkErr($r)) {
				//g('删除专辑成功，此操作不能恢复！', '/index.php?m=community&c=index&a=index');
				header("Location: /index.php?m=community&c=myhuoshow&a=myalbum&myuid=".$user['uid']);
			}else {
				g('删除专辑失败！', '/index.php?m=community&c=index&a=index');
			}
		}else{
			g('非法操作！','/index.php?m=community&c=index&a=index');
		}
	}
	
	
	/**
	 * 修改用户资料
	 */
	
	public function  accountsettings(){
		$user = UserApi::getLoginUserSessionInfo();
		$uid = $user['uid'];
		$avatar = getLiveHead($uid,'big');
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		//print_r($avatar);
		if(!empty($uid)){
		$userinfo = Community::GetMyShowInof($uid);//获取用户相关信息
			if($_GET['save'] =="yes"){
				$email = $_POST['mail'];//邮箱
				$nickname = $_POST['nickname'];//昵称
				$sightml = $_POST['signature'];//个人签名
				$residecity = $_POST['city'];//城市
				$site = $_POST['website'];//个人主页
				Community::UpdateMyshowInfo($uid,$email,$nickname,$sightml,$residecity,$site);
				g("修改成功！","/index.php?m=community&c=index&a=index");die();
			}
			include template('community','myshow_account_settings');
		}else{
				//g("请登录再进行修改！","/index.php?m=community&c=index&a=index");
				header('Location: /index.php?m=community&c=index&a=index');
		}
		
	}
	
	/**
	 * 请求用户名是否被注册
	 */
	public function ajax_username(){
		$username = $_GET['username'];
		$r = Community::IsUserNameExist($username);
		echo json_encode($r);
	}
	
	/**
	 * 请求邮箱是否被注册
	 */
	public function ajax_email(){
		$email = $_GET['email'];
		$r = Community::IsUserEmailExist($email);
		echo json_encode($r);
	}
	
	/**
	 * 私信
	 */
	public function myshowmsg(){
		$user = UserApi::getLoginUserSessionInfo();
		$uid = $user['uid'];
		if (!empty($uid)){
			$notification = Community::getnotification($uid);//获取通知
			//include template('community','myshow_msg');
		}else {
			//g("请登录再进行操作","/index.php?m=community&c=index&a=index");die();
			header('Location: /index.php?m=community&c=index&a=index');
		}
		
		include template('community','myshow_msg');
	}
	
	
	/**
	 * 私信回复
	 */
	public function myshowmsgreply(){
		$user = UserApi::getLoginUserSessionInfo();
		$uid = $user['uid'];
		$name = UserApi::getUserName($uid);
		//print_r($name[0]['nickname']);die();
		$msg_id = $_GET['msg_id'];
		$mail_content = $_POST['mail_content'];
		$avatar=getLiveHead($uid,"small");//发信用户图像;
		$replytime = date('Y-m-d H:i:s');
		//print_r($replytime);die();
		if(!empty($uid) && !empty($mail_content)) {
			
			Weibo::replyPrivateMail($uid,$msg_id,$mail_content);
			$newmsg = Community::getnewmsg();
			echo '<li data-id="159" class="content-item fn-clear"><a href='.DX_URL.$uid.' class="avatar"><img width="45" height="45" src="'.$avatar.'"></a><div class="content"><h2><a href="'.DX_URL.$uid.'" class="name">'.$name[0]['nickname'].'</a> <span class="time">'.$replytime.'</span></h2><p>'.$mail_content.'</p></div><div class="action-drop"><div class="drop-arrow"></div><div class="wrapper fn-hide"><!--<a href="" class="report">举报</a>--><a href='."/index.php?m=community&c=myhuoshow&a=delmymsg&msg_id=".$newmsg[0]["id"].' class="del">删除</a></div></div></li>';
		}else{
			g("请登录再进行私信回复！",'/index.php?m=community&c=index&a=index');
		}
		
	}
	
	/**
	 * 删除私信
	 */
	
	public function delmymsg(){
		$msg_id= $_GET['msg_id'];
		Weibo::deletePrivateMail($msg_id);
		echo "1";
	}
	
	/**
	 * 私信页面json数据
	 */
	
	public function json_myshowmsg(){
		$user = UserApi::getLoginUserSessionInfo();
		$uid = $user['uid'];
		if(!empty($uid)){
			$msgcontent = Community::getPrivateMsg($uid);//获取用户所有私信
			$datas = $msgcontent["arr"];
			//print_r($datas);
			//$test =  Community::getalbumsharelist(1);
			//print_r($test);
			$page = empty($_GET['page']) ? '1':$_GET['page'];
			$arr = array();
			for ($i=0;$i<count($datas);$i++) {
			//公共数据,发送私信的用户相关信息
			$arr[$i]['id'] = $datas[$i]['id'];
			$arr[$i]['msg'] = $datas[$i]['msg'];
			$arr[$i]['isnew'] = true;
			$arr[$i]['time'] = $datas[$i]['append_time'];
			$arr[$i]['uid'] = $datas[$i]['src_uid'];
			//$arr[$i]['avatar'] = getLiveHead($datas[$i]["src_uid"],"small");//用户图像
			$arr[$i]['avatar'] = getLiveHead($uid,"small");//用户图像
			$arr[$i]['name'] = urlencode($datas[$i]['src_nickname']);
			$arr[$i]['url'] = DX_URL.$uid;
			$arr[$i]['msg_type'] = $datas[$i]['msg_type'];//我秀相关动作 0 默认私信 1 喜欢分享 2 转藏分享 3 关注专辑
			$arr[$i]['del_url'] = '/index.php?m=community&c=myhuoshow&a=delmymsg&msg_id='.$datas[$i]['id'];
			$arr[$i]['report_url'] = '/index.php?m=community&c=index&a=myshow_report&uid='.$datas[$i]['src_uid'].'&report_type=4&msg_id='.$datas[$i]['id'];
			//$arr[$i]['isletter'] = true;
			$arr[$i]['sender_uid'] = $datas[$i]['src_uid'];//发信者UID
			$arr[$i]['sender_avatar'] = getLiveHead($datas[$i]["src_uid"],"small");//发信用户图像;
			$arr[$i]['sender_name'] = urlencode($datas[$i]['src_nickname']);// 发信者用户名
			$arr[$i]['sender_url'] = DX_URL.$datas[$i]['src_uid'];// 发信者路径
			if(($datas[$i]['myshare_id'] != 0) && ($datas[$i]['msg_type'] != 3)){
				//分享链接
				$arr[$i]['pin_url'] = "/index.php?m=community&c=index&a=show&share_id=".$datas[$i]['myshare_id'];
			}elseif(($datas[$i]['myshare_id'] != 0) && ($datas[$i]['msg_type'] == 3)){
				//专辑链接
				$arr[$i]['pin_url'] = "/zj-".$datas[$i]['myshare_id'].".html";
			}else{
				$arr[$i]['pin_url'] = '';
			}
			
			if(($datas[$i]['myshare_id'] != 0) && ($datas[$i]['msg_type'] != 3)){
				//获取分享信息
				$img = Community::getShareInfo($datas[$i]['myshare_id']);
				$arr[$i]['pin_img'] = $img['-msg-'][0]['small'];
			}elseif(($datas[$i]['myshare_id'] != 0) && ($datas[$i]['msg_type'] == 3)){
				//获取专辑信息
				//$arr[$i]['pin_img'] = Community::getalbumsharelist($datas[$i]['myshare_id']);
			}else{
				$arr[$i]['pin_img'] = '';
			}
			$arr[$i]['album_img'] = '';
			if(($datas[$i]['myshare_id'] != 0) && ($datas[$i]['msg_type'] == 3)){
				$share_count = Community::getAlbumName($datas[$i]['myshare_id']);
				$arr[$i]['share_count'] = $share_count[0]['file_count'];
			}
			$arr[$i]['refer'] = Community::getmsgreply($uid,$datas[$i]['id']);
			$arr[$i]['refer_url'] = "/index.php?m=community&c=myhuoshow&a=myshowmsgreply&msg_id=".$datas[$i]['id'];//回复私信提交路径
				if(!empty($arr[$i]['refer'])) {
					$arr[$i]['hasrefer'] = true;
				}else{
					$arr[$i]['hasrefer'] = false;
				}
			}
			$content->data = $arr;
			$prepage = empty($_GET['perpage']) ? '20':$_GET['perpage'];
			$totalpage = ceil($msgcontent["num"]/$prepage);
			
			$content->login = ($user===false) ? 0 : 1;
			$content->totalpage = $totalpage; //总页数
			$content->page = $page; //第几页
			$content->prepage = intval($prepage); //一页多少条
			$content->stat = "ok";
			echo urldecode(json_encode($content));
		}
	}
	
	/**
	 * 系统管理员删除分享
	 */
	public function system_del_share(){
		$user = UserApi::getLoginUserSessionInfo();
		if ($user===false){
			g("请登录再进行此操作！","/index.php?m=community&c=index&a=index");
		}else {
			$share_id = $_GET['id'];	//删除分享
			$user_uid = $_GET['uid'];	//删除用户UID
			$r = Community::deleteShare($user_uid,$share_id);
			if (checkErr($r)) {
				echo 1;
			}else {
				echo 0;
			}
		}
	}
	
	public function ajax_del_tag(){
		$share_id = $_GET[id];
		$tag_name = $_GET[tag_name];
	}
	
	
	/**
	 * 修改分享
	 */
	public function myeditshare(){
		$act_submit = $_GET["act_submit"];
		$user = UserApi::getLoginUserSessionInfo();
		if ($user===false){
			g("请登录再进行此操作！","/index.php?m=community&c=index&a=index");
		}else {
			if ($act_submit == "yes"){
				$uid = $user['uid'];		//用户UID
				$s_id= $_GET['id'];		//分享ID
				$description = $_POST['desc'];	//描述
				$album_id = $_POST['typeid'];	//专辑ID
				$default_album_id = $_GET['album_id'];	//默认专辑ID
				$status = $_POST["status"];		//状态
				$tag_arr = $_POST["tags"];		//新增加标签
				$tags_default = $_POST["tags_default"];		//默认标签
				//去掉的标签
				$deltag = array_diff($tags_default,$tag_arr);
				//增加的标签
				$addtag = array_diff($tag_arr,$tags_default);
				
				//是否没有标签，如果去掉了所有标签则把分享和标签的关联关系给删除
				$is_deltag = implode(',',$deltag);
				if (empty($is_deltag)){
					$deltag = array();	
				}
				$is_addtag = implode(',',$addtag);
				if (empty($is_addtag)){
					$addtag = array();	
				}
				$r = Community::updateShareBaseInfo($uid, $s_id, $album_id,$default_album_id, $description, $status, $addtag, $deltag);
				header('Location: /index.php?m=community&c=index&a=show&share_id='.$s_id);
				
			}
			else {
				//导航分类
				$class_arr = Community::getClassList(1,24);
				$class_data = $class_arr["-msg-"][arr];
				$share_id = $_GET['share_id'];
				//分享信息
				$r = Community::getShareInfo($share_id);
				$data = $r["-msg-"];
				//专辑名称
				$rr = Community::getAlbumClassId($data[0][albumid]);
				$album_datas = $rr["-msg-"];
				//标签
				$tag_name = Community::getShareTagName($data[0][id],5);
				foreach ($tag_name as $v){
					$tag_name_arr .= $v[name]." ";
				}
				//我的专辑列表
				$albumlist = Community::getAlbumList(0,$user['uid']);
				$list_arr = $albumlist["-msg-"]["arr"];
				
				include template('community','myshow_edit_share');
			}
		}
	}
	
	/**
	 *批量上传
	 */
	public function batch_upload(){
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		if ($user===false){
			g("请登录再进行此操作！","/index.php?m=community&c=index&a=index");
		}else {
			//获取传递过来的专辑id
			$getalbum_id = $_GET['album_id'];
			//根据专辑ID获取专辑名称
			if($getalbum_id!=""){
				$getalbum_info = Community::getAlbumInfo($getalbum_id);
				$getalbum_name = $getalbum_info['-msg-']['arr'][0]['album_name'];
			}

			//获取默认专辑
			$a_arr = Community::getDefaultAlbum();
			$a_arr_t = Community::getClassTagMap($a_arr[0][class_id]);
			if (empty($getalbum_id)){
			   $a_arr_tag = $a_arr_t["-msg-"];
			}else{
			   $a_arr_tag = Community::getalbumtap($getalbum_id);//根据专辑获取对应标签
			}
			//获取默认类别
			$c_arr = Community::getDefaultClass();
			//获取类别列表
			$c_arr_t = Community::getClassList();
			$c_arr_class = $c_arr_t['-msg-']['arr'];
			//获取专辑类别
			$r = Community::getAlbumList(0,$user['uid'],1,1,50);
			if(checkErr($r)){
				$albumlist = $r["-msg-"];
				$list_arr = $albumlist["arr"];
			}else{
				echo $r["-msg-"];
				die();
			}
			include template('community','myshow_upload_batch');
		}
	}
	
	/**
	 *批量上传并发布分享
	 */
	public function add_batch_upload(){
		$user = UserApi::getLoginUserSessionInfo();
		if ($user===false){
			g("请登录再进行此操作！","/index.php?m=community&c=index&a=index");	
//			header("Location: /index.php?m=community&c=index&a=index");
		}else {
			//获取用户
			$user_info = UserApi::getUserName($user['uid']);
			$uid = $user_info[0]['uid'];//用户UID
			$nickname = $user_info[0]['nickname'];//用户姓名
			$info_data = $_POST['info'];
			//默认专辑
			$a_arr = Community::getDefaultAlbum();
			//专辑ID
			$albumid = ($_GET['album_id'] == 'default_id') ? $a_arr[0][id]:$_GET['album_id'];
			$albumname = Community::getAlbumName($albumid);
			$info_arr = array();
			for ($i = 0; $i < count($info_data); $i++) {
//				$info_arr[$i][img] = $info_data[$i][img];
				$info_arr[$i][img]  = str_replace("/myshowpic",'myshowpic',$info_data[$i][img]);
				//生成缩略图
				$thumb = CommunityImg($info_arr[$i][img],"208**",100,0,'big',true);
				$info_arr[$i][thumb] = $thumb;
				//生成60*60小图
				$small = CommunityImg($info_arr[$i][img],"165*165",100,1,'small',true);
				$info_arr[$i][small] = $small;
				$info_arr[$i][desc] = $info_data[$i][desc];
				
				//判断tags数组是否为空
				$is_input_tags_arr = implode(',',$info_data[$i][tags]);
				if (empty($is_input_tags_arr)){
					$info_arr[$i][tag_arr] = array();	
				}else {
					$da = Community::getTagIsPresence($info_data[$i][tags],$uid);
					$info_arr[$i][tag_arr] = $da["-msg-"];
				}
				//创建分享
				$add_img = Community::createShare($uid,$nickname,"上传图片分享",$info_arr[$i][img],
				"",$info_arr[$i][thumb],$info_arr[$i][small],$info_arr[$i][tag_arr],$albumid,$info_arr[$i][desc],1,0);
			}
//			print_r($info_arr);
			//成功跳转
			if ($i==$i){
				$transfer_type = 1;
				include template('community','myshow_repin_success');
			}else {
				echo "0";
			}

		}
	}
	
	
}


?>