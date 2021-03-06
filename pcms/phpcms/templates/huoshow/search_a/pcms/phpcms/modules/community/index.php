<?php 
//火秀社区入口文件

defined('IN_PHPCMS') or exit('No permission resources.');
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/community/community.php";
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php";
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php";
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/MyshowPager.class.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/CProduct.class.php";
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/function.core.php";

class index 
{
	public function __construct()
	{
		
	}
	
		
	/**
	 * 首页
	 */
	public function index() 
	{
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		$spaceurl = DX_URL;
		//推荐位
		$p_data_On = Community::getPosList(1); //上
		$p_data_In = Community::getPosList(2); //中
		$p_data_Un = Community::getPosList(3); //下
		
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		
		include	template('community','myshow_index');
	}
	
	/**
	 * 分类页
	 */
	public function lists(){
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		$class_id = $_GET['classid'];
		$class_info = Community::getClassInfo($class_id);
		$class_name = $class_info["-msg-"]["arr"][0][name];
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		
		$list_class_arr = Community::getClassList3(0,6);
		$list_class_data = $list_class_arr["-msg-"][arr];

		$list_class_arr1 = Community::getClassList3(6,50);
		$list_class_data1 = $list_class_arr1["-msg-"][arr];
		
		
		
//		$class_name = $class_info["-msg-"]["arr"][0][name];
		$r = Community::getClassTagMapList($class_id);
		if (checkErr($r)){
			$datas = $r["-msg-"];
		}else {
			echo $r["-msg-"];
			die();
		}
		include template('community','myshow_category_page');		
	}
	
	/**
	 * 标签页
	 */
	public function tag_lists(){
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		$tag_id = $_GET['tag_id'];
		$tag_arr = Community::getTagInfo($tag_id);
		$tag_name = $tag_arr["-msg-"]["arr"];
		$r = Community::getAboutTagList($tag_id);
		if (checkErr($r)){
			$datas = $r["-msg-"];
		}else {
			echo $r["-msg-"];
			die();
		}
		include template('community','myshow_tags_page');
	}
	
	
	/**
	 *  详细页
	 */
	public function show(){
		$user = UserApi::getLoginUserSessionInfo();
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		//print_r($user['uid']);
		$loginavatar = getLiveHead($user['uid'],"small");
		$morenavatar = DX_URL.'uc_server/images/noavatar_small.gif';
		$user_info = UserApi::getUserName($user['uid']);
		$share_id = $_GET['share_id'];
		$r = Community::getShareInfo($share_id);
		$isshow = $r['-msg-'][0]['status'];
//		if ($r["-msg-"][0][status] == 99){
			$thumb_arr = Community::getShowAlbumShare($r["-msg-"][0][albumid],$share_id);
			if (checkErr($thumb_arr)){
				$thumb_r = $thumb_arr["-msg-"];
				$total_r = $thumb_arr["-msg-"][num];
				$first_r = $thumb_arr["-msg-"][first];
				$thumb_data = $thumb_r["arr"];
			}else {
				g('该分享不存在或未通过审核',"/index.php?m=community&c=index&a=index");
				//echo $thumb_arr["-msg-"];
				die();
			}
			
			if (checkErr($r)){
				$data = $r["-msg-"];
				$tag_name = Community::getShareTagName($data[0][id],5);
				$avatar = getLiveHead($data[0]["uid"],"small");
				$rr = Community::getAlbumClassId($data[0][albumid]);
				$album_datas = $rr["-msg-"];
				//是否已关注了专辑
				$follow_r = Community::IsFollowAlbum($data[0][albumid],$user[uid]);
			}else {
				//echo $r["-msg-"];
				g('该分享不存在或未通过审核',"/index.php?m=community&c=index&a=index");
				die();
			}
			$same_r = Community::getSameSouceAlbumFromId($share_id);
			$same_data = $same_r["-msg-"];
			//上一个，下一个
			$Previous = Community::GetPreviousNext($share_id);
			$Next = Community::GetPreviousNext($share_id,2);
			//同一专辑里的上一个，下一个分享
			$AlbumPrevious = Community::GetAlbumPreviousNext($share_id);
			$AlbumNext = Community::GetAlbumPreviousNext($share_id,2);
			//喜欢
			$like_r = Community::getLikeShareList("",$share_id);
			$like_data = $like_r["-msg-"]["arr"];
			
			//$like_count = count($like_data);
			$like_count = $like_r["-msg-"]["num"];//获取该分享总的喜欢数量
			if($like_count>0){
				for($i=0;$i<$like_count;$i++){
					$like_data[$i]['nickname']=UserApi::getUserName($like_data[$i][uid]);//获取喜欢用户昵称
				}
			}
			$is_like = ($user===false) ? 0 : Community::IsLikeShare($share_id,$user[uid]);
			
			
			//转藏
			$shareinfo = Community::getShareInfo($share_id);
			$source_id = $shareinfo['-msg-'][0]['source_id'];
			//如果分享是转藏，则查找分享根ID
			if($source_id !=0){
				$collect_r = Community::getCollectList($source_id,3);
			}else{
				$collect_r = Community::getCollectList($share_id,3);
			}
			$collect_data = $collect_r["-msg-"]["arr"];
			//$collect_count = count($collect_data);
			  $collect_count = $collect_r ["-msg-"]["num"];//转藏总数
			$page = empty($_GET['page']) ? '1':$_GET['page'];
			
			//$reply_r = Community::getShareReplyList($share_id,$page,10);
			//$reply_data = $reply_r["-msg-"]["arr"];
			//$page_split = new PagerSplit($reply_r["-msg-"]["num"],$page,10);
			//$page_str = $page_split->GetPagerContent();
			//分享评论相关
			$reply_content = Community::getShareReplyList($share_id,$page,"5");//分享评论信息
			$reply_num = $reply_content['-msg-']['num'];//分享评论总数
			$page_split = new MyPagerSplit($reply_num,$page,"5","/index.php?m=community&c=index&a=share_comment_list&share_id=$share_id&page={#page}");
			$type = "share";
			$page_reply = $page_split->MyGetPagerContent($type);//分享评论分页
			$reply_info = $reply_content['-msg-']['arr'];//获取分享评论相关信息
			//获取评论人头像
			for($i=0;$i<count($reply_info);$i++){
				$reply_info[$i]['reply_avatar'] = getLiveHead($reply_info[$i]['uid'],"small");
			}
			//分享评论结束
			$albumid = $r['-msg-'][0]['albumid'];//活动分享的专辑ID
			$albumshareimg = Community::getalbumsharelistimg($albumid);//显示该专辑下分享图片
			include template('community','myshow_show_upload');
//		}else {
//			g('此分享审核未通过或已被删除,请查看其它分享！', '/index.php?m=community&c=index&a=index');
//		}
		
	}
	
	
	/**
	 * 广场页
	 */
	public function square(){
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		//人气专辑
//		$r = Community::getAlbumList(0, 0, 4, 1, 8);
//		$datas = $r["-msg-"][arr];
//		for ($i = 0; $i < count($datas); $i++) {
//			$datas[$i][isfollow] = ($user===false) ? 0 :Community::IsFollowAlbum($datas[$i][id],$user[uid]);
//		}
		$dbarr =array();
		$r = Community::getPosList(20);
		for ($i = 0; $i < count($r); $i++) {
			$r2 = Community::getAlbumClassId($r[$i][classid]);
			$r3 = $r2["-msg-"];
			for ($j = 0; $j < count($r3); $j++) {
				$dbarr[$i][isfollow] = ($user===false) ? 0 :Community::IsFollowAlbum($r3[$j][id],$user[uid]);
				$dbarr[$i][id] = $r3[$j][id];
				$dbarr[$i][album_name] = $r3[$j][album_name];
				$dbarr[$i][uid] = $r3[$j][uid];
				$dbarr[$i][description] = $r3[$j][description];
				
				if ($dbarr[$i][front_cover]==2){//如果设置了封面，则取封面
					$c = Community::getCoverList($r3[$j][id],$user[uid]);
					$c_arr = $c["-msg-"];
					$dbarr[$i][img] = $c_arr[0]['small'];
				}elseif ($dbarr[$i][front_cover]==1){//取九宫格
					$r4 = Community::getShareListFromAlbumPic($r3[$j][id],1,"desc",1,9);
					$r5 = $r4["-msg-"]["arr"];
					for ($k = 0; $k < count($r5); $k++) {
						$dbarr[$i][img][] = $r5[$k]['small'];
					}
				}else {
					$d = Community::getShareListFromAlbumPic($r3[$j][id],3,"ASC",1,1);
					$arr = $d["-msg-"]["arr"];
					$dbarr[$i][img] = $arr[0]['small'];
				}
			}
		}
		$square_datas = Community::getShareSquare();
		include template('community','myshow_square');
	}
	
	/**
	 * 达人页
	 */
	public function talent(){
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		$lists = empty($_GET['list']) ? '1':$_GET['list'];
		if ($lists ==1){
			$datas = Community::getTalentList($lists);	
		}else {
			$datas = Community::getTalentList($lists);
		}
		for ($i = 0; $i < count($datas); $i++) {
			$datas[$i][isfollow] = ($user===false) ? 0 :Community::getUserIsFollow($user[uid],$datas[$i][uid]);
		}
//		print_r($datas);
		include template('community','myshow_daren');
	}
	
	/**
	 * 搜索页
	 */
	public function search(){
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		$keyword = $_POST['q'];
		$total = Community::getSearchToal($keyword);		
		include template('community','myshow_search');
	}
	
	/**
	 * 搜索json数据
	 */
	public function json_search(){
		$user = UserApi::getLoginUserSessionInfo();
		$lists = empty($_GET['list']) ? '1':$_GET['list'];
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$prepage = empty($_GET['perpage']) ? '21':$_GET['perpage'];
		$isie = is_ie();
		if ($isie==1){
			$keyword = array_iconv($_GET['q']);
		}else {
			$keyword = $_GET['q'];
		}
		
		$total = Community::getSearchToal($keyword);
		$arr = array();
		if ($lists ==1 ){//分享
			$datas = Community::getSearchList(1,$keyword,$page,$prepage);
			$count = $total[file_num];
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
//				$arr[$i]['owner_stats'] = urlencode("分享 <em>(<a target='_blank' href='/m".$datas[$i][uid].".html'>".$datas[$i][user_arr][share]."</a>)</em> 专辑 <em>(<a target='_blank' href='/zj".$datas[$i][uid].".html'>".$datas[$i][user_arr][album]."</a>)</em> 粉丝 <em>(<a target='_blank' href='/fs".$datas[$i][uid].".html'>".$datas[$i][user_arr][fans]."</a>)</em>");//用户名片信息
				$arr[$i]['album_name'] = $datas[$i]['album_name'];
				$arr[$i]['album_id'] = $datas[$i]['albumid'];//专辑ID
				$arr[$i]['album_url'] = "/zj-".$datas[$i]['albumid'].".html";//专辑页URL
				$arr[$i]['follow'] = ($user===false) ? 0 : Community::IsFollowUser($user['uid'], $datas[$i]['uid']);
				$arr[$i]['comment_action'] = "/index.php?m=community&c=index&a=add_comment&share_id=".$datas[$i]['id']; //评论提交路径
				$arr[$i]['pin_url'] = "/show-".$datas[$i]['id'].".html"; //详细页路径
				$arr[$i]['letter_url'] = "/index.php?m=community&c=index&a=send_message&src_uid=$user[uid]&dst_uid=".$datas[$i]['uid'];//私信
				
			}
			$totalpage = ceil($count/$prepage);
			$content->admin = ($user===false) ? 0 : Community::SystemUserDelShare($user[uid]);
			$content->success = true;
			$content->login = ($user===false) ? 0 : 1;
			$content->data = $arr;
			$content->totalpage = $totalpage; //总页数
			$content->page = $page; //第几页
			$content->prepage = intval($prepage); //一页多少条
			$content->stat = "ok";
			echo urldecode(json_encode($content));
		}elseif ($lists ==2){//专辑
			$datas = Community::getSearchList(2,$keyword,$page,$prepage);
			$count = $total[album_num];
			for ($i=0;$i<count($datas);$i++){
				$arr[$i]['album_id'] = $datas[$i]['id'];
				$arr[$i]['owner_id'] = $datas[$i]['uid'];
				$arr[$i]['owner_name'] = urlencode($datas[$i]['nickname']);//用户名称
				$arr[$i]["owner_avatar"] = getLiveHead($datas[$i]["uid"],"small");
				$arr[$i]['album_name'] = $datas[$i]['album_name'];
				$arr[$i]['input_time'] = $datas[$i]['input_time'];
				$arr[$i]['description'] = $datas[$i]['description'];
				$arr[$i]['image_url'] = $datas[$i]['img'];
				if(!empty($uid)){
					$arr[$i]['follow'] = Community::IsFollowAlbum($datas[$i]['id'],$uid);//判断专辑是否关注过 1为已关注
					$arr[$i]['edit'] = Community::GetAlbumUid($uid,$datas[$i]['id']);//判断专辑是否属于自己的专辑 1为自己的专辑
				}else{
					$arr[$i]['follow'] = 0;//未登录为0
					$arr[$i]['edit'] = 0;//未登录为0
				}
				$arr[$i]['edit_url'] = '/index.php?m=community&c=index&a=myshow_modify_album&album_id='.$datas[$i]['id'];//编辑专辑地址
				$arr[$i]['follow_url'] = '/index.php?m=community&c=index&a=create_watchAlbum&album_id='.$datas[$i]['id'];
				$arr[$i]['album_url'] = "/zj-".$datas[$i]['id'].".html";
				$arr[$i]['owner_url'] = "/m".$datas[$i]['uid'];
			}
			$totalpage = ceil($count/$prepage);
			$content->totalpage = $totalpage; //总页数
			$content->page = $page; //第几页
			$content->prepage = intval($prepage); //一页多少条
			$content->success = true;
			$content->login = ($user===false) ? 0 : 1;
			$content->data = $arr;
			$content->stat = "ok";
			echo urldecode(json_encode($content));
		}elseif ($lists ==3){//用户
			$datas = Community::getSearchList(3,$keyword,$page,$prepage);
			$count = $total[user_num];
			for ($i = 0; $i < count($datas); $i++) {
				$arr[$i]['id'] = $datas[$i]['uid'];
				$arr[$i]['owner'] = ($user[uid] == $datas[$i]['uid']) ? 1:0; 
				$arr[$i]['follow'] = ($user===false) ? 0:Community::getUserIsFollow($user[uid],$datas[$i]['uid']);
				$arr[$i]['avatar'] = $datas[$i]['avatar'];
				$arr[$i]['name'] = !empty($datas[$i]['nickname']) ? urlencode($datas[$i]['nickname']):urlencode($datas[$i]['username']);
				$arr[$i]['url'] = "/m".$datas[$i]['uid'].".html";
				$arr[$i]['letter_url'] = "/index.php?m=community&c=index&a=send_message&src_uid=$user[uid]&dst_uid=".$datas[$i]['uid'];
			}
			$totalpage = ceil($count/$prepage);
			$content->totalpage = $totalpage; //总页数
			$content->page = $page; //第几页
			$content->prepage = intval($prepage); //一页多少条
			$content->success = true;
			$content->login = ($user===false) ? 0 : 1;
			$content->data = $arr;
			$content->stat = "ok";
			echo urldecode(json_encode($content));
		}
	}
	
	/**
	 * 添加评论
	 */
	public function add_comment(){
		$share_id = $_GET['share_id'];
		$user = UserApi::getLoginUserSessionInfo();
		$content = $_POST[data];
		if (!empty($user['uid'])){
			$user_info = UserApi::getUserName($user['uid']);
			$uid = $user_info[0]['uid'];
			$nickname = $user_info[0]['nickname'];
			$at_uid_arr = array();
			$r = Community::replyShare($uid,$nickname,$share_id,$content);
			if ($r){
				echo 1;
			}else {
				echo 0;
			}
		}else {
			g("请登录再进行操作","/index.php?m=community&c=index&a=show&share_id=$share_id");
		}
				
	}
	
		
	/**
	 * 转藏
	 */
	public function ajax_transfer(){
		$act_submit = $_GET["act_submit"];
		$user = UserApi::getLoginUserSessionInfo();
		if (!empty($user['uid'])) {
			if ($act_submit == "yes"){
				$user_info = UserApi::getUserName($user['uid']);
				$tags_arr = $_POST['tags_arr']; //选择标签
				$input_tags_arr =  $_POST['input_tags_arr']; //写入标签
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
				
				//合并
				$cards = array_merge($tags_arr, $tag_id_arr);
				$uid = $user_info[0]['uid'];
				$nickname = $user_info[0]['nickname'];
				$share_id = $_GET['share_id'];
				$tag_arr = $cards;
				$a_arr = Community::getDefaultAlbum();
				$albumid = ($_GET['album'] == 'default_id') ? $a_arr[0][id]:$_GET['album'];
				$albumname = Community::getAlbumName($albumid);//获取选择用户专辑名称
				$share_name=Community::getShareInfo($share_id);//获取该分享用户名称 
				$descrition = $_GET['desc'];
				$data = Community::collectShare($uid,$nickname,$share_id,$albumid,$tag_arr,$descrition);
				if (checkErr($data)){//成功跳转到成功页面
					$r = Community::getShareInfo($share_id);
					$s_info = $r["-msg-"];
					$transfer_type = 3;
					include template('community','myshow_repin_success');
					//发送私信
					Weibo::SendPrivateMail($user['uid'],$share_name['-msg-'][0]['uid'],'转藏了'.$share_name['-msg-'][0]['nickname'].'的分享:'.$share_name['-msg-'][0]['file_name'].'到专辑'.'<<'.$albumname[0]['album_name'].'>>','2',$share_id);
				}else {
					echo $da["-msg-"];
					die();
				}

			}else {
				$share_id = $_GET['share_id'];
				//标签
				$tag_name = Community::getShareTagName($share_id);
				foreach ($tag_name as $v){
					$tag_name_arr .= $v[name]." ";
				}
				$share_arr = Community::getShareInfo($share_id);
				$share_info = $share_arr["-msg-"];
				$a_arr = Community::getDefaultAlbum();
				$a_arr_t = Community::getClassTagMap($a_arr[0][class_id]);
				$a_arr_tag = $a_arr_t["-msg-"];
				//获取专辑类别
				$r = Community::getAlbumList(0,$user['uid'],1,1,20);
				if(checkErr($r)){
					$albumlist = $r["-msg-"];
					$list_arr = $albumlist["arr"];
				}else{
					echo $r["-msg-"];
					die();
				}
				include template('community','myshow_repin');
			}	
		}else {
			g("请登录再进行此操作","/index.php?m=community&c=index&a=index");	
		}	
		
	} 
	
	/**
	 * 转藏页ajax添加专辑名称
	 */
	public function ajax_add_album(){
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		$arr = array($_POST['album_text']);
		$isalbumname=Community::getCreateAlbumName($arr);//判断要创建专辑名称是否存在
//		$numuser = Community::getUserTotalInfo($user['uid']);
//		if ($numuser['album'] >=5){
//			echo 5;//已经创建超过5个专辑
//		}else{
		if (($isalbumname!=1) && ($arr[0]!="")){
			$tag_arr = Community::UserCreateAlbum($arr, $user_info[0]['uid'], $user_info[0]['nickname']);
			//echo 1;
			echo "selectid=".$tag_arr["-msg-"];
		}elseif($isalbumname==1){
			echo 2;
		}else{
			echo 0;
		}
		//$tag_arr = Community::UserCreateAlbum($arr, $user_info[0]['uid'], $user_info[0]['nickname']);
		/*if (checkErr($tag_arr)) {
//				echo 1;//成功
			echo "selectid=".$tag_arr["-msg-"];
		}else {
			//echo 0;//失败
		}*/
	}
	
	/**
	 * 发送私信给好友
	 */
	public function send_message(){
		$src_uid = $_GET['src_uid'];
		$dst_uid = $_GET['dst_uid'];
		$msg = $_POST['msg'];
		$r = Weibo::SendPrivateMail($src_uid,$dst_uid,$msg);
		if (checkErr($r)) {
			echo true;
		}else{
			echo false;
		}
	}
	
	
	/**
	 * 根据标签得到分享json
	 */
	public function json_tag_list(){
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		$tag_id = $_GET['tag_id'];
		$lists = empty($_GET['list']) ? '1':$_GET['list'];
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$prepage = empty($_GET['perpage']) ? '21':$_GET['perpage'];
		if ($lists == 1){ //人气
			$r = Community::getTagShareList($tag_id,$lists,0,$page,$prepage);
		}elseif ($lists == 3) { //最新
			$r = Community::getTagShareList($tag_id,$lists,0,$page,$prepage);
		}elseif ($lists == 2){  //商品
			$r = Community::getTagShareList($tag_id,$lists,3,$page,$prepage);
		}
		if (checkErr($r)){
			$datas = $r["-msg-"]["arr"];
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
					//var_dump($datas[$i]['priceimg']);
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
//				$arr[$i]['owner_stats'] = urlencode("分享 <em>(<a target='_blank' href='/m".$datas[$i][uid].".html'>".$datas[$i][user_arr][share]."</a>)</em> 专辑 <em>(<a target='_blank' href='/zj".$datas[$i][uid].".html'>".$datas[$i][user_arr][album]."</a>)</em> 粉丝 <em>(<a target='_blank' href='/fs".$datas[$i][uid].".html'>".$datas[$i][user_arr][fans]."</a>)</em>");//用户名片信息
				$arr[$i]['album_name'] = $datas[$i]['album_name'];
				$arr[$i]['album_id'] = $datas[$i]['albumid'];//专辑ID
				$arr[$i]['album_url'] = "/zj-".$datas[$i]['albumid'].".html";//专辑页URL
				$arr[$i]['follow'] = ($user===false) ? 0 : Community::IsFollowUser($user['uid'], $datas[$i]['uid']);
				$arr[$i]['comment_action'] = "/index.php?m=community&c=index&a=add_comment&share_id=".$datas[$i]['id']; //评论提交路径
				$arr[$i]['pin_url'] = "/show-".$datas[$i]['id'].".html"; //详细页路径
				$arr[$i]['letter_url'] = "/index.php?m=community&c=index&a=send_message&src_uid=$user[uid]&dst_uid=".$datas[$i]['uid'];//私信
				
			}
//			print_r($arr);
			$totalpage = ceil($r["-msg-"]["num"]/$prepage);
			$content->admin = ($user===false) ? 0 : Community::SystemUserDelShare($user[uid]);
			$content->success = true;
			$content->login = ($user===false) ? 0 : 1;
			$content->data = $arr;
			$content->totalpage = $totalpage; //总页数
			$content->page = $page; //第几页
			$content->prepage = intval($prepage); //一页多少条
			$content->stat = "ok";
			echo urldecode(json_encode($content));
		}else{
			echo $r["-msg-"];
			die();
		}
	}
	
	/**
	 * 分享json数据
	 */
	public function json_share_list(){
		$user = UserApi::getLoginUserSessionInfo();
		$star_time = "";
		$end_time = "";
		//类型
		$lists = empty($_GET['list']) ? '1':$_GET['list'];
		$class_id = empty($_GET['class_id']) ? '0':$_GET['class_id'];
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$prepage = empty($_GET['perpage']) ? '21':$_GET['perpage'];
		$order_asc = "desc";
		//获得所有
		if ($lists == 1){ //最近
			$r = Community::getShareListFromClass($class_id,$lists,0,$star_time,$end_time,$order_asc,$page,$prepage);
		}elseif ($lists == 2){ //热度
			$r = Community::getShareListFromClass($class_id,$lists,0,$star_time,$end_time,$order_asc,$page,$prepage);
		}elseif ($lists == 3) {  //购物
			$r = Community::getShareListFromClass($class_id,$lists,3,$star_time,$end_time,$order_asc,$page,$prepage);
		}
		if (checkErr($r)){
			$share_arr = $r["-msg-"];
			$datas = $share_arr["arr"];
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
//				$arr[$i]['owner_stats'] = urlencode("分享 <em>(<a target='_blank' href='/m".$datas[$i][uid].".html'>".$datas[$i][user_arr][share]."</a>)</em> 专辑 <em>(<a target='_blank' href='/zj".$datas[$i][uid].".html'>".$datas[$i][user_arr][album]."</a>)</em> 粉丝 <em>(<a target='_blank' href='/fs".$datas[$i][uid].".html'>".$datas[$i][user_arr][fans]."</a>)</em>");//用户名片信息
				$arr[$i]['album_name'] = $datas[$i]['album_name'];
				$arr[$i]['album_id'] = $datas[$i]['albumid'];//专辑ID
				$arr[$i]['album_url'] = "/zj-".$datas[$i]['albumid'].".html";//专辑页URL
				$arr[$i]['follow'] = ($user===false) ? 0 : Community::IsFollowUser($user['uid'], $datas[$i]['uid']);
				$arr[$i]['comment_action'] = "/index.php?m=community&c=index&a=add_comment&share_id=".$datas[$i]['id']; //评论提交路径
				$arr[$i]['pin_url'] = "/show-".$datas[$i]['id'].".html"; //详细页路径
				$arr[$i]['letter_url'] = "/index.php?m=community&c=index&a=send_message&src_uid=$user[uid]&dst_uid=".$datas[$i]['uid'];//私信 
				if (Community::SystemUserDelShare($user[uid])==1){
				//$arr[$i]['action_top_url'] = ($datas[$i]['top']==0) ? "/index.php?m=community&c=index&a=showtop&toptype=0&share_id=".$datas[$i]['id']: "/index.php?m=community&c=index&a=showtop&toptype=other&share_id=".$datas[$i]['id'];
				//$arr[$i]['action_top_text'] = ($datas[$i]['top']==0) ? "置顶": "取消置顶";
				/*if(($_GET['class_id']=="") && ( $datas[$i]['top']==3 || $datas[$i]['top']==1)){
						$arr[$i]['action_top_url'] = "/index.php?m=community&c=index&a=showtop&toptype=other&share_id=".$datas[$i]['id'];
						$arr[$i]['action_top_text'] = "取消置顶";
					}elseif(($_GET['class_id']!="") && ($datas[$i]['top']==2 || $datas[$i]['top']==1)){
						$arr[$i]['action_top_url'] = "/index.php?m=community&c=index&a=showtop&toptype=other&share_id=".$datas[$i]['id'];
						$arr[$i]['action_top_text'] = "取消置顶";
					}else {
						$arr[$i]['action_top_text'] = "置顶";
						$arr[$i]['action_top_url'] = "/index.php?m=community&c=index&a=showtop&toptype=0&share_id=".$datas[$i]['id'];
					}*/
				$arr[$i]['action_shield_url'] = ($datas[$i]['file_recommend']==0) ? "/index.php?m=community&c=index&a=showrecommend&recommendtype=0&share_id=".$datas[$i]['id']: "/index.php?m=community&c=index&a=showrecommend&recommendtype=other&share_id=".$datas[$i]['id'];
				$arr[$i]['action_shield_text'] = ($datas[$i]['file_recommend']==0) ? "推荐": "屏蔽";
				}
			}
			$totalpage = ceil($r["-msg-"]["num"]/$prepage);
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
			echo $r["-msg-"];
			die();
		}
	}
	
	
	/**
	 * 专辑json数据
	 */
	public function json_album_list(){
		$lists = empty($_GET['list']) ? '1':$_GET['list'];
		$class_id = empty($_GET['class_id']) ? '0':$_GET['class_id'];
		$album_uid = empty($_GET['album_uid']) ? '0':$_GET['album_uid'];
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$prepage = empty($_GET['perpage']) ? '21':$_GET['perpage'];
		if ($lists == 1){ //时间
			$r = Community::getAlbumListJson($class_id,$album_uid,$lists,$page,$prepage);
		}else {
			$r = Community::getAlbumListJson($class_id,$album_uid,$lists,$page,$prepage);	
		}
//		print_r($r["-msg-"]["arr"]);
//		die("111");
		if (checkErr($r)) {
			$album_arr = $r["-msg-"];
			$datas = $album_arr["arr"];
			$arr = array();
			$userinfo = UserApi::getLoginUserSessionInfo();
          	$uid = $userinfo['uid'];//登录用户uid
			for ($i=0;$i<count($datas);$i++){
//				$is_tags_arr = implode(',',$datas[$i]['img']);
//				if ($is_tags_arr){
//					if (count($datas[$i]['img'])>=8){
						$arr[$i]['album_id'] = $datas[$i]['id'];
						$arr[$i]['owner_id'] = $datas[$i]['uid'];
						$arr[$i]['owner_name'] = urlencode($datas[$i]['nickname']);//用户名称
						$arr[$i]["owner_avatar"] = getLiveHead($datas[$i]["uid"],"small");
						$arr[$i]['album_name'] = $datas[$i]['album_name'];
						$arr[$i]['input_time'] = $datas[$i]['input_time'];
						$arr[$i]['description'] = $datas[$i]['description'];
						$arr[$i]['image_url'] = empty($datas[$i]['img']) ? "":$datas[$i]['img'];
						if(!empty($uid)){
							$arr[$i]['follow'] = Community::IsFollowAlbum($datas[$i]['id'],$uid);//判断专辑是否关注过 1为已关注
							$arr[$i]['edit'] = Community::GetAlbumUid($uid,$datas[$i]['id']);//判断专辑是否属于自己的专辑 1为自己的专辑
						}else{
							$arr[$i]['follow'] = 0;//未登录为0
							$arr[$i]['edit'] = 0;//未登录为0
						}
						$arr[$i]['edit_url'] = '/index.php?m=community&c=index&a=myshow_modify_album&album_id='.$datas[$i]['id'];//编辑专辑地址
						$arr[$i]['follow_url'] = '/index.php?m=community&c=index&a=create_watchAlbum&album_id='.$datas[$i]['id'];
						$arr[$i]['album_url'] = "/zj-".$datas[$i]['id'].".html";
						$arr[$i]['owner_url'] = "/m".$datas[$i]['uid'].".html";
//					}
//				}
			}
			$totalpage = ceil($r["-msg-"]["count"]/$prepage);
			$content->totalpage = $totalpage; //总页数
			$content->page = $page; //第几页
			$content->prepage = intval($prepage); //一页多少条
			$content->success = true;
			$content->login = ($user===false) ? 0 : 1;
			$content->data = $arr;
			$content->stat = "ok";
			echo urldecode(json_encode($content));
		}else {
			echo $r["-msg-"];
			die();
		}
	}
	
	/**
	 * 根据URL抓取图片API
	 * retrun json
	 */
	public function myshow_get_img_api(){
		$url = $_GET['s_url'];
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		curl_close($ch);
		$pattern_src = '/<[img|IMG].*?src=[\'|\"]([^\']*?)[\'|\"].*?[\/]?>/';
		$num = preg_match_all($pattern_src, $result, $match_src);
		$arr_src = $match_src[1];//获得图片数组
		$tmp->img = $arr_src;
		echo json_encode($tmp);
	}
	
	
	/**
	 * ajax提交，根据专辑ID获取类别的相关标签
	 */
	public function myshow_ajax_album(){
		$album_id = $_POST['album_id'];
		$album_arr = Community::getAlbumClassId($album_id);
		if (checkErr($album_arr)){
			$datas = $album_arr["-msg-"];
			$class_arr = Community::getClassTagMap($datas[0][class_id]);
			if (checkErr($class_arr)){
				$class_data = $class_arr["-msg-"];
				foreach ($class_data as $k=>$v){
					if($k==0 || $k%19==0){
					echo '<ul class="tag-list-item fn-clear">';
					}
					echo '<li><a href="#" id='.$v[tag_id].'>'.$v[tag_name].'</a></li>';
					if(($k+1)%19==0){
					echo '</ul>';
					}
				}
			}else {
				echo $class_arr["-msg-"];
				die();
			}
			
		}else {
			echo $album_arr["-msg-"];
			die();
		}
	}
	
	/**
	 * 抓取图片入库
	 */
	public function myshow_collect_img()
	{
		$act_submit = $_GET["act_submit"];
		$user = UserApi::getLoginUserSessionInfo();
		if (!empty($user['uid'])) {
			if ($act_submit == "yes"){
				$user_info = UserApi::getUserName($user['uid']);
				//print_r($_POST);
				$tags_arr = $_POST['tags_arr']; //选择标签
				$input_tags_arr =  $_POST['input_tags_arr']; //写入标签
				$is_tags_arr = implode(',',$tags_arr);
				$is_input_tags_arr = implode(',',$input_tags_arr);
				if (empty($is_tags_arr)){
					$tags_arr = array();	
				}
				if (empty($is_input_tags_arr)){
					$tag_id_arr = array();	
				}
				//print_r($input_tags_arr);
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
				//合并
				$cards = array_merge($tags_arr, $tag_id_arr);
				$uid = $user_info[0]['uid'];
				$nickname = $user_info[0]['nickname'];
				$share_name = '采集图片分享';
				$remote_url = $_GET['local_path'];
				$file_arr = Community::get_photo($_GET['thumb']);
				$file_path = $file_arr[pic];
				$file_thumb = $file_arr[thumb];
				$file_small = $file_arr[small];	
				$tag_arr = $cards;
				$a_arr = Community::getDefaultAlbum();
				$albumid = ($_GET['album'] == 'default_id') ? $a_arr[0][id]:$_GET['album'];
				$descrition = $_GET['desc'];
				if (Community::Getcensor($descrition) == "0" ) {
					$status = "97";
				}else {
					$status = "0";
				}
				//创建分享
				$add_img = Community::createShare($uid,$nickname,$share_name,$file_path,$remote_url,$file_thumb,$file_small,$tag_arr,$albumid,$descrition,2,0,1,1,0,"",$status);
				if (checkErr($add_img)) {
					$albumname = Community::getAlbumName($albumid);//获取选择用户专辑名称
					$transfer_type = 2;
					include template('community','myshow_repin_success');
				}else {
					echo false;
				}
//				print_r($add_img);	
			}else {
			}	
		}else {
			g("请登录再进行此操作","/index.php?m=community&c=index&a=index");
		}
			
	}
	
	
	
	/**
	 * 抓取视频入库
	 */
	public function myshow_collect_video()
	{
		$act_submit = $_GET["act_submit"];
		$user = UserApi::getLoginUserSessionInfo();
		if (!empty($user['uid'])) {
			if ($act_submit == "yes"){
				$user_info = UserApi::getUserName($user['uid']);
				//print_r($_POST);
				$tags_arr = $_POST['tags_arr']; //选择标签
				$input_tags_arr =  $_POST['input_tags_arr']; //写入标签
				$is_tags_arr = implode(',',$tags_arr);
				$is_input_tags_arr = implode(',',$input_tags_arr);
				if (empty($is_tags_arr)){
					$tags_arr = array();	
				}
				if (empty($is_input_tags_arr)){
					$tag_id_arr = array();	
				}
				//print_r($input_tags_arr);
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
				//合并
				$cards = array_merge($tags_arr, $tag_id_arr);
				$uid = $user_info[0]['uid'];
				$nickname = $user_info[0]['nickname'];
				$share_name = $_GET['title'];
				$remote_url = $_GET['local_path'];
				$file_path = $_GET['thumb'];
				//swf路径
				$file_swf = $_GET['swf'];
				//保存本地
//				$file_path = Community::get_photo($_GET['thumb']);
				$tag_arr = $cards;
				$a_arr = Community::getDefaultAlbum();
				$albumid = ($_GET['album'] == 'default_id') ? $a_arr[0][id]:$_GET['album'];
				$descrition = $_GET['desc'];
				if (Community::Getcensor($descrition) == "0" ) {
					$status = "97";
				}else {
					$status = "0";
				}
				//创建分享
				$add_img = Community::createShare($uid,$nickname,$share_name,$file_path,$remote_url,$file_path,$file_path,$tag_arr,$albumid,$descrition,2,0,2,1,0,$file_swf,$status);
				if (checkErr($add_img)) {
					$albumname = Community::getAlbumName($albumid);//获取选择用户专辑名称
					$transfer_type = 2;
					include template('community','myshow_repin_success');
				}else {
					echo false;
				}
			}else {
				
//				include	template('community','myshow_collect_video');
			}	
		}else {
			g("请登录再进行此操作","/index.php?m=community&c=index&a=index");	
		}
		
	}
	
	
	
	/**
	 * 抓取商品信息入库
	 */
	public function myshow_collect_goods()
	{	
		$user = UserApi::getLoginUserSessionInfo();
		//获取我的专辑类别
		if (!empty($user['uid'])) {
				$r = Community::getAlbumList(0,$user['uid']);
				$tags_arr = $_POST['tags_arr']; //选择标签
				$input_tags_arr =  $_POST['input_tags_arr']; //写入标签
				$is_tags_arr = implode(',',$tags_arr);
				$is_input_tags_arr = implode(',',$input_tags_arr);
				//var_dump($is_input_tags_arr);die();
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
				//合并
			$cards = array_merge($tags_arr, $tag_id_arr);
	
			$tag_arr = $cards;
			//print_r($tag_arr);die();
			$user_thumb = $_GET['i'];
			//入库
			if ($user_thumb != "") {
				$user_info = UserApi::getUserName($user['uid']);
				$user_url = $_GET['local_path'];//产品链接
				$user_title =$_GET['desc'];//获取产品标题
				$descrition =$_GET['desc'];//获取产品描述
				if ((Community::Getcensor($user_title) == "0") && (Community::Getcensor($descrition) =="0")) {
					$status = "97";
				}else {
					$status = "0";
				}
				$user_thumb = $_GET['i'];//获取产品图片
				$user_price = $_GET['p'];//获取产品价格
				$user_priceimg = "";
				/*if(!is_numeric($user_price)) {
					$user_priceimg = $user_price;
					$user_price = 0;
				}*/
				preg_match("/<[img|IMG].*?[\/]?>/",$user_price,$isimg);//判断价格是否为IMG标签，空则不是
				if(!empty($isimg)){
					$user_priceimg = $user_price;
					$user_price = 0;
				}
				$albumid = $_GET['album'];
				//处理当专辑为默认专辑时
				if ($albumid == "default_id"){
					$albumid = 1;
				}
				//图片保存到本地
//				$thumb = Community::get_photo($_GET['i']);	
				$file_arr = Community::get_photo($_GET['i']);
				$file_path = $file_arr[pic];
				$file_thumb = $file_arr[thumb];
				$file_small = $file_arr[small];	
				//创建分享
				//$add_goods = Community::createShare();
				$add_goods = Community::createShare($user_info[0]['uid'],$user_info[0]['nickname'],$user_title,$file_path,$user_url,$file_thumb,$file_small,$tag_arr,$albumid,$descrition,2,0,3,1,$user_price,$user_priceimg,$status);
				if (checkErr($add_goods)) {
					$albumname = Community::getAlbumName($albumid);//获取选择用户专辑名称
					$transfer_type = 2;
					include template('community','myshow_repin_success');
				}else {
					echo false;
				}	
		}else {
			echo 0;
			/*$a_arr = Community::getDefaultAlbum();
			if(checkErr($r)){
			$albumlist = $r["-msg-"];
			$list_arr = $albumlist["arr"];
			}else{
				echo $r["-msg-"];
				die();
				}*/
				//获取默认专辑
		/*$a_arr = Community::getDefaultAlbum();
		$a_arr_t = Community::getClassTagMap($a_arr[0][class_id]);
		$a_arr_tag = $a_arr_t["-msg-"];
		//获取专辑类别
		$r = Community::getAlbumList(0,$user['uid']);
		if(checkErr($r)){
			$albumlist = $r["-msg-"];
			$list_arr = $albumlist["arr"];
		}else{
			echo $r["-msg-"];
			die();
		}
		include	template('community','myshow_collect_goods');*/
			}	
	 }else {
				g("请登录再进行此操作！","/index.php?m=community&c=index&a=index");	
			}
}
	
	//采集商品
	public function myshow_collect_commodity() {
		$url = $_POST['url'];
		//$url = "http://www.360buy.com/product/1003055964.html";
		//$url = "http://detail.tmall.com/item.htm?spm=a2106.m874.1000384.d11&id=17781144546&source=dou&scm=1029.0.1.0";
		$process = new CProduct();
		$arr = $process->process("$url");
    	$arr['title'] = $arr['title']; 
    	$arr['description'] = $arr['description']; 
    	$arr['price'] =  $arr['price'];
    	$arr['img'] =  $arr['img'];
    	if(empty($arr['title'])){
    		$arr['title'] = ""; 
    	}
    	if(empty($arr['description'])){
    		$arr['description'] = ""; 
    	}
    	if(empty($arr['price'])){
    		$arr['price'] = ""; 
    	}
    	if(empty($arr['img'])){
    		$arr['img'] = ""; 
    	}
    	echo urldecode(json_encode($arr));
	}
	
	/**
	 * 购物首页数据API
	 */
	public function myshow_shopping_api()
	{	
		$user = UserApi::getLoginUserSessionInfo();
		date_default_timezone_set("Asia/Shanghai");
		if ($_GET['filter'] == "new-goods") {
		$order_type = "1";
		$star_time  = "";
		$end_time   = "";
		}
		if ($_GET['filter'] == "hot-24-hour"){
		$order_type = "2";
		$star_time = date('Y-m-d H:m:s',mktime(0,0,0,date("m"),date("d")-1,date("Y")));//24小时  
		$end_time = date('Y-m-d H:m:s');
		}
		if ($_GET['filter'] == "hot-30-hour"){
		$order_type = "2";
		$star_time = date('Y-m-d H:m:s',mktime(0,0,0,date("m"),date("d")-30,date("Y")));//30天热卖
		$end_time = date('Y-m-d H:m:s');
		}
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$prepage = empty($_GET['perpage']) ? '21':$_GET['perpage'];
		//$end_time = time();
		$order_asc= "desc";
		$shopping_content = Community::getShareListFromClass(0,$order_type,3,$star_time,$end_time,$order_asc,$page,$prepage);
		$num = count($shopping_content['-msg-']['arr']);
		//获取数据总数
		$shopping_num = $shopping_content['-msg-']['num'];
		$arr = array();
		for ($i=0;$i<$num;$i++) {
			$arr[$i]['id'] = $shopping_content['-msg-']['arr'][$i]['id'];
			$arr[$i]['like'] = ($user===false) ? 0 : Community::IsLikeShare($shopping_content['-msg-']['arr'][$i]['id'], $user[uid]);
			$arr[$i]['edit'] = ($user[uid] == $shopping_content['-msg-']['arr'][$i]['uid']) ? 1:0;
			//$arr[$i]['follow'] = 0;
			$arr[$i]['isgoods'] = ($shopping_content['-msg-']['arr'][$i]['file_type'] == 3) ? 1:0;
			$arr[$i]['description'] = $shopping_content['-msg-']['arr'][$i]['description'];
			$arr[$i]['tags'] = Community::getShareTagName($shopping_content['-msg-']['arr'][$i]['id']);
			$arr[$i]['image_url'] = $shopping_content['-msg-']['arr'][$i]['thumb'];
			$image = getimagesize($shopping_content['-msg-']['arr'][$i]['thumb']);
			$arr[$i]['image_width'] = ($shopping_content['-msg-']['arr'][$i]['file_type'] == 2) ? 208:$image[0];
			$arr[$i]['image_height'] = ($shopping_content['-msg-']['arr'][$i]['file_type'] == 2) ? 150:$image[1];
			//if ($shopping_content['-msg-']['arr'][$i]['file_type'] == 1 && $image[1] >= 800){ //图片
			if ($shopping_content['-msg-']['arr'][$i]['file_type'] == 1){ 
				$image_meta = ($arr[$i]['image_height']>800) ? "<span class='image-overlay'></span>":"";
			}elseif($shopping_content['-msg-']['arr'][$i]['file_type'] == 2){//视频
				$image_meta = "<span class='meta video'></span>";
			}elseif($shopping_content['-msg-']['arr'][$i]['file_type'] == 3){//商品
				if($shopping_content['-msg-']['arr'][$i]['priceimg']!= ""){
					$image_meta = "<span class='meta price img-price'>".$shopping_content['-msg-']['arr'][$i]['priceimg']."</span>";
				}else{
					if($shopping_content['-msg-']['arr'][$i]['price']!=0){
					$image_meta = urlencode("<span class='meta price'>￥".$shopping_content['-msg-']['arr'][$i]['price']."</span>");
					}
				}
			}
			$arr[$i]['image_meta'] = $image_meta;
			$arr[$i]['like_num'] = $shopping_content['-msg-']['arr'][$i]['be_like_count'];//喜欢
			$arr[$i]['repin_num'] = $shopping_content['-msg-']['arr'][$i]['be_collect_count'];//被收藏数
			$arr[$i]['comment_num'] = $shopping_content['-msg-']['arr'][$i]['be_views'];//评论
			$arr[$i]['owner_id'] = $shopping_content['-msg-']['arr'][$i]['uid'];//用户ID
			$arr[$i]['owner_name'] = urlencode($shopping_content['-msg-']['arr'][$i]['nickname']);//用户名称
			$arr[$i]['owner_url'] = "/m".$shopping_content['-msg-']['arr'][$i]['uid'].".html";//用户信息链接
			$arr[$i]['owner_avatar'] = getLiveHead($shopping_content['-msg-']['arr'][$i]['uid'],"small");//用户图像
			$arr[$i]['owner_signature'] = Community::getUserSignature($shopping_content['-msg-']['arr'][$i]["uid"]);//用户签名
//			$arr[$i]['owner_stats'] = urlencode("分享 <em>(".$shopping_content['-msg-']['arr'][$i][user_arr][share].")</em> 专辑 <em>(".$shopping_content['-msg-']['arr'][$i][user_arr][album].")</em> 粉丝 <em>(".$shopping_content['-msg-']['arr'][$i][user_arr][fans].")</em>");//用户名片信息
//			$arr[$i]['owner_stats'] = urlencode("分享 <em>(<a target='_blank' href='/m".$shopping_content['-msg-']['arr'][$i][uid].".html'>".$shopping_content['-msg-']['arr'][$i][user_arr][share]."</a>)</em> 专辑 <em>(<a target='_blank' href='/zj".$shopping_content['-msg-']['arr'][$i][uid].".html'>".$shopping_content['-msg-']['arr'][$i][user_arr][album]."</a>)</em> 粉丝 <em>(<a href='/fs".$shopping_content['-msg-']['arr'][$i][uid].".html'>".$shopping_content['-msg-']['arr'][$i][user_arr][fans]."</a>)</em>");//用户名片信息
			$arr[$i]['album_name'] = urlencode($shopping_content['-msg-']['arr'][$i]['album_name']);
			$arr[$i]['album_id'] = $shopping_content['-msg-']['arr'][$i]['albumid'];//专辑ID
			$arr[$i]['album_url'] = "/zj-".$shopping_content['-msg-']['arr'][$i]['albumid'].".html";//专辑URL
			$arr[$i]['pin_url'] = "/show-".$shopping_content['-msg-']['arr'][$i]['id'].".html"; //详细页路径
			$arr[$i]['letter_url'] = "/index.php?m=community&c=index&a=send_message&src_uid=$user[uid]&dst_uid=".$datas[$i]['uid'];//私信  
			//$arr[$i]['comments'] = "/index.php?m=community&c=index&a=add_comment&share_id=".$datas[$i]['id'];  //评论
			//$arr[$i]['nickname']= urlencode($shopping_content['-msg-']['arr'][$i]['description']);
			
		}
		$totalpage = ceil($shopping_num/$prepage);
		$content->success = true;
		$content->login = ($user===false) ? 0 : 1;
		$content->data = $arr;
		$content->totalpage = $totalpage; //总页数
		$content->page = $page; //第几页
		$content->prepage = intval($prepage); //一页多少条
		$content->stat = "ok";
		echo urldecode(json_encode($content));
	}
	
	//购物首页
	public function myshow_shopping_index(){
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		$p_data_On1 = Community::getPosList(8); //购物首页左侧时尚女装
		$p_data_On2 = Community::getPosList(9); //购物首页左侧品牌男装
		$p_data_On3 = Community::getPosList(10);//购物首页左侧鞋包配饰
		$p_data_On4 = Community::getPosList(11);//购物首页左侧美容护肤
		$p_data_On5 = Community::getPosList(12);//购物首页左侧家电数码
		$p_data_On6 = Community::getPosList(13);//购物首页左侧家居日用
		$p_data_On7 = Community::getPosList(14);//购物首页左侧母婴用品
		$p_data_On8 = Community::getPosList(15);//购物首页左侧美食保健
		$p_data_On9 = Community::getPosList(16);//购物首页左侧文体用品
		$p_data_On10 = Community::getPosList(17);//购物首页左侧虚拟物品
		include	template('community','myshow_shopping_index');
	}
	
	
	//购物详细页API
	public function myshow_show_goods_api(){
		$content = Community::getShareListFromAlbum(4,1);
		return $content['-msg-'];
		//include	template('community','myshow_show_goods');
	}
	
	//购物详细页
	public function myshow_show_goods(){
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		$share_id = $_GET['share_id'];
		if(!empty($share_id)) {
		$share = Community::getShareInfo($share_id);//获取分享信息
		$share['-msg-'][0]['owner_avatar']= getLiveHead($share['-msg-'][0]['uid'],"small");//获取用户图像
		$share_info = $share['-msg-'][0];
		//出自专辑数量
		$thumb_arr = Community::getShowAlbumShare($share_info[albumid],$share_id);
		if (checkErr($thumb_arr)){
			$thumb_r = $thumb_arr["-msg-"];
			$total_r = $thumb_arr["-msg-"][num];
			$first_r = $thumb_arr["-msg-"][first];
			$thumb_data = $thumb_r["arr"];
		}else {
			echo $thumb_arr["-msg-"];
			die();
		}
		
		//获取出自专辑
		$album = Community::getAlbumClassId($share_info[albumid]);
		$album_datas = $album["-msg-"];
		//获取同出自专辑
		$same_r = Community::getSameSouceAlbumFromId($share_id);
		$same_data = $same_r["-msg-"];
		//$content = Community::getCollectList(1,1);
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$reply_r = Community::getShareReplyList($share_id,$page,10);
		$reply_data = $reply_r["-msg-"]["arr"];
		$page_split = new PagerSplit($reply_r["-msg-"]["num"],$page,10);
		$page_str = $page_split->GetPagerContent();
		}
		include	template('community','myshow_show_goods');
		
	}
	
	//专辑首页
	public function myshow_album_index(){
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		$url = $_SERVER["HTTP_REFERER"];//获取来源网址URL，用来返回页面
		$p_data_album = Community::getPosList(18);//专辑首页推荐位
		
		for($i=0;$i<count($p_data_album);$i++){
			$p_data_album[$i][recommend]=Community::getAlbumrecommend($p_data_album[$i][classid]);
		}
		 $r = Community::getClassList();
		 $p_data_class = $r['-msg-']['arr'];
		 //获取分类，去除系统默认分类
		 for($i=1;$i<18;$i++){
		 	$classname[$i]['id']= $p_data_class[$i]['id'];
		 	$classname[$i]['name']= $p_data_class[$i]['name'];
		 }
		// print_r($classname);
		include	template('community','myshow_album_index');
	}
	
	
	//专辑详细页
	public function myshow_show_album(){
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		$album_id = $_GET['album_id'];//获取专辑ID
		$album = Community::getAlbumInfo($album_id);
		if (!empty($album['-msg-']['arr'])) {
			$album['-msg-']['arr'][0][owner_avatar] = getLiveHead($album['-msg-']['arr'][0]['uid'],"small");//获取用户图像
			//获取专辑详细页右侧相关信息
			$album_info = $album['-msg-']['arr'][0];
			$uid = $album_info['uid'];
			$user_num = Community::getUserTotalInfo($uid);
			$share_num = $user_num[share];//用户的分享总数
			$album_num = $user_num[album];//用户的专辑总数
			$fans_num = $user_num[fans];//用户的粉丝数
			$user_share_num = Community::getUserShareNum($user['uid']);
			
			$page = empty($_GET['page']) ? '1':$_GET['page'];
			$reply_content = Community::getAlbumReply($album_id,$page,"5");//专辑评论信息
			$reply_num = $reply_content['-msg-']['num'];//专辑评论总数
			$page_split = new MyPagerSplit($reply_num,$page,"5","/index.php?m=community&c=index&a=album_comment_list&album_id=$album_id&page={#page}");
			$type = 'sharepage';
 			$page_reply = $page_split->MyGetPagerContent($type);//专辑评论分页
			$reply_info = $reply_content['-msg-']['arr'];//获取专辑评论相关信息
			//获取评论人头像
			for($i=0;$i<count($reply_info);$i++){
				$reply_info[$i]['reply_avatar'] = getLiveHead($reply_info[$i]['uid'],"small");
			}
			
			//作者其它专辑
			$otheralbum = Community::getOtherAlbum($uid,$album_id);
			//关注者
			$user_follow = Weibo::getUserAllFollow($album['-msg-']['arr'][0]['uid']);
			$follow_count = count($user_follow);
			//获取关注者头像
			for($i=0;$i<count($user_follow);$i++){
				$user_follow[$i]['follow_avatar'] = getLiveHead($user_follow[$i]['uid'],"small");
			}
			$album_watch = Community::getUserAlbumInfo($album_id,$uid);
			$album_class = Community::getAlbumClassId($album_id);
			$class_id = $album_class['-msg-'][0][class_id];//类别名称
			$class_name = $album_class['-msg-'][0][class_name];//类别名称
			//登录用户信息
			$userinfo = UserApi::getLoginUserSessionInfo();
			$logouser = $userinfo[uid];
			//$url = DX_URL;
			$isalbum = Community::GetAlbumUid($logouser,$album_id);//判断专辑是否属于登录用户
			//判断专辑是否被关注过
			$isfollowalbum = Community::IsFollowAlbum($album_id,$logouser);
		}else{
			g("找不到该专辑！","/index.php?m=community&c=index&a=index");	
//			echo "找不到该专辑！";die();
		}
		
		include	template('community','myshow_show_album');
	}
	
	
	//专辑评论列表
	public function album_comment_list(){
		$album_id = $_GET['album_id'];//获取专辑ID
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$reply_content = Community::getAlbumReply($album_id,$page,"5");//专辑评论信息
		$reply_num = $reply_content['-msg-']['num'];//专辑评论总数
		$type = 'sharepage';
		$page_split = new MyPagerSplit($reply_num,$page,"5");
		$page_reply = $page_split->MyGetPagerContent($type);//专辑评论分页
			//var_dump($page_reply);
		$reply_info = $reply_content['-msg-']['arr'];//获取专辑评论相关信息
		//获取评论人头像
		for($i=0;$i<count($reply_info);$i++){
			$reply_info[$i]['reply_avatar'] = getLiveHead($reply_info[$i]['uid'],"small");
		}
			//登录用户信息
               $userinfo = UserApi::getLoginUserSessionInfo();
               $logouser = $userinfo[uid];
			//$url = DX_URL;
		include	template('community','myshow_album_comment');
	}
	
	//专辑首页提交评论
	
	public function create_album_comment(){
		$album_comment = $_POST['album_comment'];
		//print_r($album_comment);
		$album_id = $_GET['album_id'];
		$userinfo = UserApi::getLoginUserSessionInfo();
		$uid = $userinfo['uid'];
		$username = UserApi::getUserName($uid);
		//获取用户昵称
		$nickname = $username[0]['nickname'];
		if ($uid == "") {
			echo "<script>alert('请登录之后再进行评论！');</script>";die();
		}
		if($album_comment =="") {
			echo "<script>alert('评论内容为空！');</script>";die();
		}
		if(Community::Getcensor($album_comment) == "0") {
			echo "<script>alert('评论内容不合法！');</script>";die();
		}
		//json需要分页
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$reply_content = Community::getAlbumReply($album_id,$page,"5");//分享评论信息
		$reply_num = $reply_content['-msg-']['num'];//专辑评论总数
		$page_split = new MyPagerSplit($reply_num,$page,"5","/index.php?m=community&c=index&a=album_comment_list&album_id=$album_id&page={#page}");
		$type = "sharepage";
		$page_reply = $page_split->MyGetPagerContent($type);//分享评论分页
		if (($uid != "") && ($album_comment !="")) {
		$date= date("Y-m-d H:i:s");
		$user_avatar=getLiveHead($uid,"small");
		Community::replyAlbum($uid,$nickname,$album_id,$album_comment);
		$id = Community::getnewalbumcomment();//获取评论之后的评论ID
		$commentid = $id[0]['id'];
		/*echo '<li class="comment-item">
						<a href="'."/index.php?m=community&c=myhuoshow&a=mylike&myuid=".$uid.'" class="avatar"><img width="30" height="30" src="'.$user_avatar.'"></a>
						<p class="comment"><span class="user"><a href="'."/index.php?m=community&c=myhuoshow&a=mylike&myuid=".$uid.'" class="name">'.$nickname.'</a> </span> '.$album_comment.'<span class="time">'.$date.'</span></p>
					</li>';*/
		$comment[comment] ='<li class="comment-item">
						<a href="'."/m".$uid.'.html" class="avatar"><img width="30" height="30" src="'.$user_avatar.'"></a>
						<p class="comment"><span class="user"><a href="'."/m".$uid.'.html" class="name">'.urlencode($nickname).'</a> </span> '.$album_comment.'<span class="time">'.$date.'</span><a class="del" href="/index.php?m=community&c=index&a=delete_album_comment&comment_id='.$commentid.'&album_id='.$album_id.'">删除</a></p>
					</li>';
		$comment[page]=$page_reply;
		 $content->data = $comment;
		echo urldecode(json_encode($content));
			//echo "评论成功！";
		}else {
			echo "评论失败！";
		}
		//g("评论成功","?m=community&c=index&a=myshow_show_album&album_id=$album_id");
	}
	
	
	//分享评论列表
	public function share_comment_list(){
		$userinfo = UserApi::getLoginUserSessionInfo();
		$uid=$userinfo['uid'];
		//print_r($uid);
		$share_id = $_GET['share_id'];//获取分享ID
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$reply_content = Community::getShareReplyList($share_id,$page,"5");//分享评论信息
		$reply_num = $reply_content['-msg-']['num'];//分享评论总数
		$page_split = new MyPagerSplit($reply_num,$page,"5");
		$type = "sharepage";
		$page_reply = $page_split->MyGetPagerContent($type);//分享评论分页
		$reply_info = $reply_content['-msg-']['arr'];//获取分享评论相关信息
		//print_r($reply_info);
		//获取评论人头像
		for($i=0;$i<count($reply_info);$i++){
			$reply_info[$i]['reply_avatar'] = getLiveHead($reply_info[$i]['uid'],"small");
		}
		include	template('community','myshow_comment');
	}
	
	
	//分享详细页提交评论
	
	public function create_share_comment(){
		$share_comment = $_POST['share_comment'];
		$share_id = $_GET['share_id'];
		$userinfo = UserApi::getLoginUserSessionInfo();
		$uid = $userinfo['uid'];
		$username = UserApi::getUserName($uid);
		//JS需要分页
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$reply_content = Community::getShareReplyList($share_id,$page,"5");//分享评论信息
		$reply_num = $reply_content['-msg-']['num'];//分享评论总数
		$page_split = new MyPagerSplit($reply_num,$page,"5","/index.php?m=community&c=index&a=share_comment_list&share_id=$share_id&page={#page}");
		$type = "sharepage";
		$page_reply = $page_split->MyGetPagerContent($type);//分享评论分页
		
		//获取用户昵称
		$nickname = $username[0]['nickname'];
		if ($uid == "") {
			echo "<script>alert('请登录之后再进行评论！');</script>";die();
		}
		/*if($share_comment =="") {
			echo "<script>alert('评论内容为空！');</script>";die();
		}*/
		if(Community::Getcensor($share_comment) == "0") {
			echo "<div id='comment'><script>alert('评论内容不合法！');</script></div>";die();
		}
		if (($uid != "") && ($share_comment !="")) {
		$date= date("Y-m-d H:i:s");
		$user_avatar=getLiveHead($uid,"small");
		Community::replyShare($uid,$nickname,$share_id,$share_comment);
		$id = Community::getnewcomment();//获取评论之后的评论ID
		$commentid = $id[0]['id'];
		/*echo "<div id='comment'><li class='comment-item fn-clear'>
			<a class='img fn-left' title=".$nickname." href='/index.php?m=community&c=myhuoshow&a=mylike&myuid=$uid'>
			<img src=".$user_avatar." width='32' height='32' /></a>
			<p class='meta fn-left'><a class='author' href='/index.php?m=community&c=myhuoshow&a=mylike&myuid=$uid'>$nickname</a>
			<span class='text'>$share_comment</span></p>
			<p class='stats fn-right'><span class='time'>$date</span></p>
			<div class='actions fn-right' id='comment-actions'>
				<a class='report' href='index.php?m=community&c=index&a=myshow_report&uid=$uid&report_type=3&reply_type=2&comment_id=$commentid' title='举报' data-url=''>举报</a><a class='del' href='/index.php?m=community&c=index&a=delete_share_comment&comment_id=$commentid' title='删除' data-url='/pins/10002993/comments/189741/'>删除</a> 
			</div>
		</li></div>";*/
		$comment[comment] = "<li class='comment-item fn-clear'>
			<a class='img fn-left' title=".urlencode($nickname)." href='/m$uid.html'>
			<img src=".urlencode($user_avatar)." width='32' height='32' /></a>
			<p class='meta fn-left'><a class='author' href='/m$uid.html'>".urlencode($nickname)."</a>
			<span class='text'>".$share_comment."</span></p>
			<p class='stats fn-right'><span class='time'>$date</span></p>
			<div class='actions fn-right'>
				<!--<a class='report' href='index.php?m=community&c=index&a=myshow_report&uid=$uid&report_type=3&reply_type=2&comment_id=$commentid'  data-url=''>举报</a>--><a class='del' href='/index.php?m=community&c=index&a=delete_share_comment&share_id=$share_id&comment_id=$commentid'  data-url='/pins/10002993/comments/189741/'>删除</a> 
			</div>
		</li>";
		$comment[page]=$page_reply;
		 $content->data = $comment;
		echo urldecode(json_encode($content));
			
		}else {
			echo "评论失败！";
		}
		//echo $page_reply;//提交评论带上分页内容
		//g("评论成功","?m=community&c=index&a=myshow_show_album&album_id=$album_id");
	}
	
	//分享详细页删除评论
	
	public function delete_share_comment(){
		$userinfo = UserApi::getLoginUserSessionInfo();
		$uid = $userinfo['uid'];
		$commentid= $_GET['comment_id'];
		$commentinfo = Community::GetCommentReply($commentid);
		$commentuid = $commentinfo[0]['uid'];//评论所属uid
		$share_id = $_GET['share_id'];
		if(($uid != "") && ($uid==$commentuid)){
			Community::deleteShareReply($commentid);//删除评论
			$page = empty($_GET['page']) ? '1':$_GET['page'];
			$reply_content = Community::getShareReplyList($share_id,$page,"5");//分享评论信息
			$reply_num = $reply_content['-msg-']['num'];//分享评论总数
			$page_split = new MyPagerSplit($reply_num,$page,"5","/index.php?m=community&c=index&a=share_comment_list&share_id=$share_id&page={#page}");
			$type = "sharepage";
			$page_reply = $page_split->MyGetPagerContent($type);//分享评论分页
			//print_r($page_reply);die();
			$reply_info = $reply_content['-msg-']['arr'];//获取分享评论相关信息
			//获取评论人头像
			for($i=0;$i<count($reply_info);$i++){
				$reply_info[$i]['reply_avatar'] = getLiveHead($reply_info[$i]['uid'],"small");
			}
			include	template('community','myshow_comment');
		}else{
			//g("非法操作!","/index.php?m=community&c=index&a=index");
			echo 0;
		}
	}
	
	//专辑详细页删除评论
	
	public function delete_album_comment(){
		//$userinfo = UserApi::getLoginUserSessionInfo();
		//$uid = $userinfo['uid'];
		//登录用户信息
        $userinfo = UserApi::getLoginUserSessionInfo();
        $logouser = $userinfo[uid];
		$commentid= $_GET['comment_id'];
		$album_id = $_GET['album_id'];
		$commentinfo = Community::GetAlbumComment($album_id,$commentid);
		$commentuid = $commentinfo[0]['uid'];//评论所属uid
		if(($logouser != "") && ($logouser==$commentuid)){
			Community::deleteAlbumReply($commentid);//删除专辑评论
			$page = empty($_GET['page']) ? '1':$_GET['page'];
			$reply_content = Community::getAlbumReply($album_id,$page,"5");//专辑评论信息
			$reply_num = $reply_content['-msg-']['num'];//专辑评论总数
			$page_split = new MyPagerSplit($reply_num,$page,"5","/index.php?m=community&c=index&a=album_comment_list&album_id=$album_id&page={#page}");
			$type = "sharepage";
			$page_reply = $page_split->MyGetPagerContent($type);//专辑评论分页
			$reply_info = $reply_content['-msg-']['arr'];//获取专辑评论相关信息
			//获取评论人头像
			for($i=0;$i<count($reply_info);$i++){
				$reply_info[$i]['reply_avatar'] = getLiveHead($reply_info[$i]['uid'],"small");
			}
			include	template('community','myshow_album_comment');
		}else{
			//g("非法操作!","/index.php?m=community&c=index&a=index");
			echo 0;
		}
	}
	
	//专辑详细页json数据
	public function json_myshow_show_album(){
		$user = UserApi::getLoginUserSessionInfo();
		$album_id = $_GET['album_id'];//获取专辑ID
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$prepage = empty($_GET['perpage']) ? '21':$_GET['perpage'];
		$r = Community::getShareListFromAlbum($album_id,1,"desc",$page,$prepage);//获取专辑所有分享列表
		$share_arr = $r["-msg-"];
		$datas = $share_arr["arr"];
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
				//$image_meta = urlencode("<span class='metaal price'>￥".$datas[$i]['price']."</span>");
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
//			$arr[$i]['owner_stats'] = urlencode("分享 <em>(".$datas[$i][user_arr][share].")</em> 专辑 <em>(".$datas[$i][user_arr][album].")</em> 粉丝 <em>(".$datas[$i][user_arr][fans].")</em>");//用户名片信息
//			$arr[$i]['owner_stats'] = urlencode("分享 <em>(<a target='_blank' href='/m".$datas[$i][uid].".html'>".$datas[$i][user_arr][share]."</a>)</em> 专辑 <em>(<a target='_blank' href='/zj".$datas[$i][uid]."'>".$datas[$i][user_arr][album]."</a>)</em> 粉丝 <em>(<a target='_blank' href='/fs".$datas[$i][uid].".html'>".$datas[$i][user_arr][fans]."</a>)</em>");//用户名片信息
			$arr[$i]['album_name'] = $datas[$i]['album_name'];
			$arr[$i]['album_id'] = $datas[$i]['albumid'];//专辑ID
			$arr[$i]['album_url'] = "/zj-".$datas[$i]['albumid'].".html";//专辑页URL
			$arr[$i]['follow'] = ($user===false) ? 0 : Community::IsFollowUser($user['uid'], $datas[$i]['uid']);
			$arr[$i]['comment_action'] = "/index.php?m=community&c=index&a=add_comment&share_id=".$datas[$i]['id']; //评论提交路径
			$arr[$i]['pin_url'] = "/show-".$datas[$i]['id'].".html"; //详细页路径
			$arr[$i]['letter_url'] = "/index.php?m=community&c=index&a=send_message&src_uid=$user[uid]&dst_uid=".$datas[$i]['uid'];//私信
		}
		
		$totalpage = ceil($r["-msg-"]["num"]/$prepage);
		$content->admin = ($user===false) ? 0 : Community::SystemUserDelShare($user[uid]);
		$content->success = true;
		$content->login = ($user===false) ? 0 : 1;
		$content->data = $arr;
		$content->totalpage = $totalpage; //总页数
		$content->page = $page; //第几页
		$content->prepage = intval($prepage); //一页多少条
		$content->stat = "ok";
		echo urldecode(json_encode($content));
	}
	
	
	//创建专辑
	public function myshow_create_album(){
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		$uid = $user['uid'];
		$userinfo = UserApi::getUserName($uid);
		$nickname = $userinfo[0]['nickname'];
		
		if ($_POST['album_name']!="" && $uid!= "") {
			/*if($_POST['album_name'] == ""){
				echo "<script>alert('请输入专辑名称！');</script>";die();
			}
			if ($uid==""){
				echo "<script>alert('请登录再进行操作！');</script>";die();
			}*/
			$album_name = $_POST['album_name'];//专辑名称
			$typeid = $_POST['typeid'];//专辑类型
			if ($typeid=="default_id") {
				$typeid="1";
			}
			$album_description = $_POST['album_description'];//专辑描述
			$numuser = Community::getUserTotalInfo($uid);
			//if ($numuser['album'] >=5){
				//g('您创建的专辑已超过5个，请您选择其它专辑！',"/index.php?m=community&c=myhuoshow&a=myalbum&myuid=$uid");
			//}else{
				$create_album = Community::createAlbum($uid,$nickname,$album_name,$album_description,$typeid);
				$get_album_id = Community::getnewalbumid();//获取最新创建专辑ID
				$album_id = $get_album_id[0]['id'];
				//g('创建专辑成功','/index.php?m=community&c=index&a=myshow_show_album&album_id='.$album_id);
				header("Location: /zj-$album_id.html");
				die();
			//}
		}
		//include	template('community','myshow_create_album');
	}
	
	//修改专辑
	public function myshow_modify_album(){
		$url = $_SERVER["HTTP_REFERER"];//获取来源网址URL，用来返回页面
		$user = UserApi::getLoginUserSessionInfo();
		$userinfo=UserApi::getLoginUserSessionInfo();
		//导航分类
		$class_arr = Community::getClassList(1,24);
		$class_data = $class_arr["-msg-"][arr];
		$uid = $userinfo['uid'];
		$album_id = $_GET['album_id'];//获取专辑ID
		$album_info = Community::getAlbumInfo($album_id);
		$album_name = $album_info['-msg-']['arr'][0]['album_name'];
		$album_description = $album_info['-msg-']['arr'][0]['description'];
		$isalbum = Community::GetAlbumUid($uid,$album_id);//判断专辑归属
		$class=Community::getAlbumClassId($album_id);
		$album_class= $class['-msg-'][0]['class_name'];//获取专辑归属分类
		$album_class_id = $class['-msg-'][0]['class_id'];//获取专辑归属分类ID
		$allclass = Community::getClassList(1,100);
		$all_calss = $allclass['-msg-']['arr'];
		//取出分享
		$share_arr = Community::getalbumsharelistimg($album_id);
		
		//修改
		if(!empty($uid) && $isalbum==1) {
			if ($_POST['album_name']!= "" && $_POST['album_id'] != "") {
				$url = $_POST['url'];
				$album_id = $_POST['album_id'];//获取专辑ID
				$album_name = $_POST['album_name'];//专辑名称
				$typeid = $_POST['typeid'];//专辑类型
				$album_description = $_POST['pin_description'];//专辑描述
				$cover = $_POST['cover'];//封面 1,九格，2,自定义
				$imgid = $_POST['imgid'];
				$create_album = Community::updateAlbum($album_id,$album_name,$album_description,$typeid,$cover,$imgid,$uid);
				g('修改专辑成功',$url);die();
			}
			include	template('community','myshow_modify_album');
		}else{
			//g('修改专辑失败','/index.php?m=community&c=index&a=myshow_album_index');
			header('Location: /index.php?m=community&c=index&a=index');
		}
		
		
	}
	
	
	//举报用户/分享/评论/私信
	public function myshow_report() {
		$url = $_SERVER["HTTP_REFERER"];//获取来源网址URL，用来返回页面
		//举报用户
		if ($_GET['uid'] != "" && $_GET['report_type'] == "1") {
			$uid = $_GET['uid'];
			$user_info = UserApi::getUserName($uid);//获取昵称，头像
			$report_type = "1";
		}
		//举报分享
		if ($_GET['uid'] != "" && $_GET['report_type'] == "2"){
			$share_id = $_GET['share_id'];
			$uid = $_GET['uid'];
			$user_info = UserApi::getUserName($uid);//获取昵称，头像
			$share_info = Community::getShareInfo($share_id);//根据分享获取相关信息
			$share_file_name = $share_info['-msg-'][0][file_name];//分享名称
			$report_type = "2";
		}
		//举报评论
		if($_GET['uid'] != "" && $_GET['report_type'] == "3") {
			$uid = $_GET['uid'];
			$user_info = UserApi::getUserName($uid);//获取昵称，头像
			//$album_id = $_GET['album_id'];//评论专辑ID
			$share_id = $_GET['share_id'];//评论分享ID
			//$reply_id = $_GET['reply_id'];
			$reply_type = $_GET['reply_type'];//1为专辑评论,2为分享评论
			$comment_id = $_GET['comment_id'];//举报评论ID
			if($reply_type==1){
				$content = Community::GetAlbumReply($album_id,$reply_id);
				$share_file_name =$content;
			}else{
				$content = Community::GetCommentReply($comment_id);

				$share_file_name = $content[0]['content'];
			}
			$report_type = "3";
		}  
		//举报私信
		if($_GET['uid'] != "" && $_GET['report_type'] == "4") {
			$uid = $_GET['uid'];
			$msg_id = $_GET['msg_id'];//私信ID
			$report_type = "4";//举报类型
			$content = Community::getmsgidcontent($msg_id);
			$share_file_name = $content[0]['msg'];//举报内容
			$user_info = UserApi::getUserName($uid);//获取昵称，头像
		}
		include	template('community','myshow_report');
	}
	
	
	//创建举报用户/分享/评论/私信
	public function addmyshow_report() {
		$report_uid = UserApi::getLoginUserSessionInfo();//获取登录用户信息
		if($report_uid['uid']!=""){
		$uid = $_POST['uid'];
		$report_type = $_POST['report_type'];
		$report_content = $_POST['is_content'];//选择举报类型
		$report_reason = $_POST['other_explain'];
		$reply_type = $_POST['reply_type'];
		$url = $_POST['url'];//跳转举报前页面
		$content = Community::CreateReport($uid,$report_type,$report_content,$report_uid['uid'],$report_reason,$reply_type,$url);
		g("操作成功",$url);
		}else{
			g("请登录再进行举报操作",'/index.php?m=community&c=index&a=index');
			die();
		}
	}
	
	
	/**
	 * 框架：集合图片、视频、商品采集
	 */
	public function myshow_collect_all(){
		$user = UserApi::getLoginUserSessionInfo();
		$user_info = UserApi::getUserName($user['uid']);
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
		$c_arr_p = Community::getClassList2();
		$c_arr_num = $c_arr_p['-msg-']['num'];//获取类别总数
		$c_arr_t = Community::getClassList2(1,$c_arr_num);
		
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
		include	template('community','myshow_collect_all');
	}
	
	//不良信息过滤判断
	public function is_censor(){
		$content = $_GET['content'];
		$content = array($content);
		$isalbumname=Community::getCreateAlbumName($content);//判断要创建专辑名称是否存在
		if($isalbumname==1){
			echo 2;
		}else{
			$is_censor = Community::Getcensor($content[0]);
			echo $is_censor;
		}
	}
	
	
	//关注专辑
	public function create_watchAlbum(){
		$userinfo = UserApi::getLoginUserSessionInfo();
		$uid = $userinfo['uid'];
		$album_id = $_GET['album_id'];
		$albumname = Community::getAlbumName($album_id);
		//print_r($albumname);die();
		$isfollowalbum = Community::IsFollowAlbum($album_id,$uid);//判断专辑是否关注过
		if(empty($uid)) {
			echo "<script>alert('请登录再进行操作！');</script>";
		}
		$isalbum = Community::GetAlbumUid($uid,$album_id);//判断专辑是否属于自己
		if($_GET[action] =="follow"){//添加关注
			if (!empty($uid) && ($isfollowalbum == 0) && ($isalbum ==0)){
				Community::watchAlbum($uid,$album_id);
				echo "1";
				//发送私信
				Weibo::SendPrivateMail($uid,$albumname[0]['uid'],'关注了我的专辑:'.'<<'.$albumname[0]['album_name'].'>>','3',$album_id);
			}else{
				echo "<script>alert('关注专辑失败！');</script>";
				}
		}
		if($_GET[action] =="cancel"){//取消关注专辑
			if (!empty($uid) && ($isfollowalbum == 1) && ($isalbum ==0)){
				Community::delwatchAlbum($uid,$album_id);
				echo "1";
			}else{
				echo "<script>alert('取消关注专辑失败！');</script>";
				}
		}
	}
	
	/**
	 * 分享大图
	 */
	public function bigimgcontent(){
		$share_id = $_GET['share_id'];
		//获取分享相关信息
		$shareinfo = Community::getShareInfo($share_id);
		//获取图片相关
		$bigimg = $shareinfo['-msg-'][0]['file_path'];
		$bigimginfo=getimagesize($bigimg);
		$bigimg_width = $bigimginfo[0];
		$bigimg_height = $bigimginfo[1];
		//获取分享喜欢数
		$be_like_count = $shareinfo['-msg-'][0]['be_like_count'];
		//分享用户UID
		$shareuid = $shareinfo['-msg-'][0]['uid'];
		//获取收藏数
		$be_collect_count = $shareinfo['-msg-'][0]['be_collect_count'];
		//被评论数
		$be_reply_count = $shareinfo['-msg-'][0]['be_reply_count'];
		//发布时间
		$input_time = $shareinfo['-msg-'][0]['input_time'];
		//图片用户名称
		$nickname = $shareinfo['-msg-'][0]['nickname'];
		//获取分享描述
		$description = $shareinfo['-msg-'][0]['description'];
		//获取图片归属用户图片
		$bigimgavatar = getLiveHead($shareinfo['-msg-'][0]['uid'],"small");
		$userinfo = UserApi::getLoginUserSessionInfo();
		//$uid= $userinfo['uid'];
		$user = $userinfo;
		//print_r($user);
		//登录用户头像
		$avatar = getLiveHead($user['uid'],"small");
		$morenavatar = DX_URL.'uc_server/images/noavatar_small.gif';
		//源自专辑
		$album_name = $shareinfo['-msg-'][0]['album_name'];
		$album_id = $shareinfo['-msg-'][0]['albumid'];
		//评论相关
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$reply_content = Community::getShareReplyList($share_id,$page,"6");//分享评论信息
		$reply_num = $reply_content['-msg-']['num'];//分享评论总数
		$page_split = new MyPagerSplit($reply_num,$page,"6");
		$type = "sharepage";
		$page_reply = $page_split->MyGetPagerContent($type);//分享评论分页
		$reply_info = $reply_content['-msg-']['arr'];//获取分享评论相关信息
		//获取评论人头像
		for($i=0;$i<count($reply_info);$i++){
			$reply_info[$i]['reply_avatar'] = getLiveHead($reply_info[$i]['uid'],"small");
		}
		
		include template('community','myshow_show_zoomer');
	}
	
	
	//分享大图提交评论
	
	public function create_bigimg_share_comment(){
		$share_comment = $_POST['share_comment'];
		$share_id = $_GET['share_id'];
		$userinfo = UserApi::getLoginUserSessionInfo();
		$uid = $userinfo['uid'];
		$username = UserApi::getUserName($uid);
		//JS需要分页
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$reply_content = Community::getShareReplyList($share_id,$page,"6");//分享评论信息
		$reply_num = $reply_content['-msg-']['num'];//分享评论总数
		$page_split = new MyPagerSplit($reply_num,$page,"6","/index.php?m=community&c=index&a=bigimgcontent&share_id=$share_id&page={#page}");
		$type = "sharepage";
		$page_reply = $page_split->MyGetPagerContent($type);//分享评论分页
		
		//获取用户昵称
		$nickname = $username[0]['nickname'];
		if ($uid == "") {
			echo "<script>alert('请登录之后再进行评论！');</script>";die();
		}
		if(Community::Getcensor($share_comment) == "0") {
			echo "<div id='comment'><script>alert('评论内容不合法！');</script></div>";die();
		}
		if (($uid != "") && ($share_comment !="")) {
		$date= date("Y-m-d H:i:s");
		$user_avatar=getLiveHead($uid,"small");
		Community::replyShare($uid,$nickname,$share_id,$share_comment);
		$id = Community::getnewcomment();//获取评论之后的评论ID
		$commentid = $id[0]['id'];
		$comment[comment] = "<li>
					<a class='avatar' href='/m$uid.html'><img src=".urlencode($user_avatar)." width='30' height='30' /></a>
					<p><a href='/m$uid.html'>".urlencode($nickname)."</a>".$share_comment."</p>
					<div class='meta'><span>$date</span><a class='del' href='/index.php?m=community&c=index&a=delete_bigimgshare_comment&share_id=$share_id&comment_id=$commentid'  data-url='/pins/10002993/comments/189741/'>删除</a></div>
				</li>";
		$comment[page]=$page_reply;
		 $content->data = $comment;
		echo urldecode(json_encode($content));
			
		}else {
			echo "评论失败！";
		}
	}
	
	
	//分享大图评论列表
	public function share_bigimgcomment_list(){
		$userinfo = UserApi::getLoginUserSessionInfo();
		$uid=$userinfo['uid'];
		$share_id = $_GET['share_id'];//获取分享ID
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$reply_content = Community::getShareReplyList($share_id,$page,"6");//分享评论信息
		$reply_num = $reply_content['-msg-']['num'];//分享评论总数
		$page_split = new MyPagerSplit($reply_num,$page,"6");
		$type = "sharepage";
		$page_reply = $page_split->MyGetPagerContent($type);//分享评论分页
		$reply_info = $reply_content['-msg-']['arr'];//获取分享评论相关信息
		//获取评论人头像
		for($i=0;$i<count($reply_info);$i++){
			$reply_info[$i]['reply_avatar'] = getLiveHead($reply_info[$i]['uid'],"small");
		}
		include	template('community','myshow_bigimg_comment');
	}
	
	
	//分享大图删除评论
	
	public function delete_bigimgshare_comment(){
		$userinfo = UserApi::getLoginUserSessionInfo();
		$uid = $userinfo['uid'];
		$commentid= $_GET['comment_id'];
		$commentinfo = Community::GetCommentReply($commentid);
		$commentuid = $commentinfo[0]['uid'];//评论所属uid
		$share_id = $_GET['share_id'];
		$shareinfo = Community::getShareInfo($share_id);
		$be_reply_count = $shareinfo['-msg-'][0]['be_reply_count'];
		if(($uid != "") && ($uid==$commentuid)){
			Community::deleteShareReply($commentid);//删除评论
			$page = empty($_GET['page']) ? '1':$_GET['page'];
			$reply_content = Community::getShareReplyList($share_id,$page,"6");//分享评论信息
			$reply_num = $reply_content['-msg-']['num'];//分享评论总数
			$page_split = new MyPagerSplit($reply_num,$page,"6","/index.php?m=community&c=index&a=bigimgcontent&share_id=$share_id&page={#page}");
			$type = "sharepage";
			$page_reply = $page_split->MyGetPagerContent($type);//分享评论分页
			$reply_info = $reply_content['-msg-']['arr'];//获取分享评论相关信息
			//获取评论人头像
			for($i=0;$i<count($reply_info);$i++){
				$reply_info[$i]['reply_avatar'] = getLiveHead($reply_info[$i]['uid'],"small");
			}
			include	template('community','myshow_bigimg_comment');
		}else{
			echo 0;
		}
	}
	//分享置顶、取消置顶
	public function showtop(){
		$shareid = array($_GET["share_id"]);
		if($_GET["toptype"]==0){
		//$status = "top";
		//Community::updateSharestatusInfo($shareid,$status);
		//include $this->admin_tpl('community_top_share');
		include	template('community','myshow_top_share');
		}
		if ($_GET["toptype"]=="other"){
		   $status = "top";
		   $toptype = 0;
		   $end_time = "";
		   Community::updateSharestatusInfo($shareid,$status,"",$toptype,$end_time);
		   //echo 1;
		   $url = $_SERVER["HTTP_REFERER"];
		   header("Location: $url");

		}
		/*if ($_GET['topshare'] =="yes"){
			//die();
			$status = "top";
			$toptype = $_POST['toptype'];
			$shareid = array($_POST['id']);
			$end_time = date('Y-m-d g:i:s',strtotime("+1 day"));//时间加一天
			Community::updateSharestatusInfo($shareid,$status,"",$toptype,$end_time);
			echo 1;
		}*/
	
	}
	//分享置顶、取消置顶
	public function showtop2(){
		//$shareid = array($_GET["share_id"]);
		if ($_GET['topshare'] =="yes"){
				$status = "top";
				$toptype = $_POST['toptype'];
				$shareid = array($_POST['id']);
				$end_time = date('Y-m-d g:i:s',strtotime("+1 day"));//时间加一天
				$topindexnum = Community::gettoptypeindex();//查询首页置顶数量
				/*if(($shareid!="") && ($toptype!=2) && (count($shareid) + $topindexnum)<4){
					$end_time = date('Y-m-d g:i:s',strtotime("+1 day"));//时间加一天
					Community::updateSharestatusInfo($shareid,$status,"",$toptype,$end_time);
					echo 1;
				}elseif(($shareid!="") && ($toptype==2)){
					$end_time = date('Y-m-d g:i:s',strtotime("+1 day"));//时间加一天
					Community::updateSharestatusInfo($shareid,$status,"",$toptype,$end_time);
					echo 1;
				}*/
			$topindexnum = Community::gettoptypeindex();//查询首页置顶数量
			$toptypeclassnum = Community::gettoptypeclass($shareid[0]);//查询分类置顶数量
			if(($toptype == 3 ) && (count($shareid) + $topindexnum['num'])>3){
				echo "置顶个数超过3个，请先取消置顶";
			}elseif(($toptype == 2) && (count($shareid) + $toptypeclassnum['num']>3)){
				echo "置顶个数超过3个，请先取消置顶";
			}elseif($toptype == 1){
				if ($topindexnum['num']>=3){
					Community::gettoptypeindex(1);
				}
				if ($toptypeclassnum['num']>=3){
					Community::gettoptypeindex($shareid[0],1);
				}
				//include $this->admin_tpl('community_top_share');
				Community::updateSharestatusInfo($shareid,$status,"",$toptype,$end_time);
				echo 1;
			
			//g('操作成功！','?m=community&c=communityshare&a=community_share_list');
			}else{
				Community::updateSharestatusInfo($shareid,$status,"",$toptype,$end_time);
				echo 1;
			}

			}
	}

	//分享推荐、取消推荐
	public function showrecommend(){
		$shareid = array($_GET["share_id"]);
		if ($_GET["recommendtype"]=="0"){
			$status = "file_recommend";
			Community::updateSharestatusInfo($shareid,$status);
			//echo 1;
		   $url = $_SERVER["HTTP_REFERER"];
		   header("Location: $url");
		}else{
			$status = "nopass_file_recommend";
			Community::updateSharestatusInfo($shareid,$status);
			//echo 1;
			$url = $_SERVER["HTTP_REFERER"];
		    header("Location: $url");
		}
	}
	//获取分享右侧内容
	public function showsharecontent() {
		$share_id = $_GET['share_id'];
		$url =$_SERVER['SERVER_NAME'].'/index.php?m=community&c=index&a=show&share_id='.$share_id;
		//$content = @file_get_contents("$url");
		$ch = curl_init();
		$timeout = 10; 
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$content = curl_exec($ch);
		curl_close($ch);
		$star ="<div id='main' class='pin-upload'>";
		$end = '<div id="pin-toolbar">';
		$data = Community::communitycut_html($content,$star,$end);
		echo '<div id="name">'.$data;
	}
}
?>
