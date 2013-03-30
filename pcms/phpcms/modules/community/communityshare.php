<?php
defined('IN_PHPCMS') or exit('No permission resources.');
//模型缓存路径
define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
//定义在单独操作内容的时候，同时更新相关栏目页面
define('RELATION_HTML',true);
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/community/community.php";
require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php";
pc_base::load_app_class('admin','admin',0);
pc_base::load_sys_class('form','',0);
pc_base::load_app_func('util');
pc_base::load_sys_class('format','',0);

class communityshare extends admin {
	protected  $db,$priv_db;
	public $siteid,$categorys;
	public function __construct() {
	}
	
	public function init() {
		//die("22222");
		include $this->admin_tpl('community_list');
	}
	
	/**
	 * 分享列表管理
	 */
	public function community_share_list() {
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		if ($_GET['search'] == "yes") {
			$star_time = $_POST['start_time'];
			$end_time = $_POST['end_time'];
			$tag_name = $_POST['tag_name'];// 标签名称
			$nickname = ($_POST['nickname']);//发布者
			$file_type = $_POST['file_type'];//分享类别
			$file_state = $_POST['file_state'];//来源
			$status = $_POST['status'];//审核状态
			$description = $_POST['description'];//描述
			
			$file_class = $_POST['file_class'];//分享分类
			$likecount = $_POST['likecount'];//喜欢数
			$collectcount = $_POST['collectcount'];//转藏数
			$replycount = $_POST['replycount'];//评论数
			$file_top = $_POST['file_top'];//置顶类型
			$file_recommend = $_POST['file_recommend'];//是否推荐
			
			//这里判断的是搜索筛选之后的分页条件
			if($_GET['start_time'] !=""){
				$start_time = $_GET['start_time'];
			}
			if($_GET['end_time'] !=""){
				$end_time = $_GET['end_time'];
			}
			if($_GET['tag_name'] !=""){
				$tag_name = $_GET['tag_name'];
			}
			if($_GET['nickname'] !=""){
				//$nickname = urlencode($_GET['nickname']);
                $nickname = $_GET['nickname'];
			}
			if($_GET['file_type'] !=""){
				$file_type = $_GET['file_type'];
			}
			if($_GET['file_state'] !=""){
				$file_state = $_GET['file_state'];
			}
			if($_GET['status'] !=""){
				$status = $_GET['status'];
			}
			if($_GET['description'] !=""){
				$description = $_GET['description'];
			}
			if($_GET['file_recommend'] !=""){
				$file_recommend = $_GET['$file_recommend'];
			}
			if($_GET['file_top'] !=""){
				$file_top = $_GET['file_top'];
			}
			if($_GET['file_class'] !=""){
				$file_class = $_GET['file_class'];
			}
			if($_GET['likecount'] !=""){
				$likecount = $_GET['likecount'];
			}
			if($_GET['collectcount'] !=""){
				$collectcount = $_GET['collectcount'];
			}
			if($_GET['replycount'] !=""){
				$replycount = $_GET['replycount'];
			}
			$datas = Community::getShareList(0,1,$page,10,$nickname,$star_time,$end_time,$tag_name,$description,$file_type,$file_state,$status,$file_recommend,$file_top,$file_class,$likecount,$collectcount,$replycount);
			$page_split = new PagerSplit($datas['-msg-']['count'],$page,10,"/index.php?m=community&c=communityshare&a=community_share_list&init&page={#page}&search=yes&start_time=$start_time&end_time=$end_time&nickname=$nickname&file_type=$file_type&file_state=$file_state&status=$status&description=$description&file_recommend=$file_recommend&file_top=$file_top&file_class=$file_class&likecount=$likecount&collectcount=$collectcount&replycount=$replycount");
			$page_str = $page_split->GetPagerContent();
		}else{
			if($_GET['status'] !=""){
				$status = $_GET['status'];
			}
			//$datas = Community::getShareList(0,1,$page);
			//$page_split = new PagerSplit($datas['-msg-']['count'],$page);
			//$page_str = $page_split->GetPagerContent();
			$datas = Community::getShareList(0,1,$page,10,$nickname,$star_time,$end_time,$tag_name,$description,$file_type,$file_state,0);
			$page_split = new PagerSplit($datas['-msg-']['count'],$page,10,"/index.php?m=community&c=communityshare&a=community_share_list&init&page={#page}&start_time=$start_time&end_time=$end_time&nickname=$nickname&file_type=$file_type&file_state=$file_state&status=$status&description=$description");
			$page_str = $page_split->GetPagerContent();
		}
		$count = $datas['-msg-']['count'];
		$content = $datas['-msg-']['arr'];
		if(checkErr($datas)){
		$list_arr = $content;
		$arr = array();
			for($i=0;$i<count($list_arr);$i++){
				$arr[$i]['id'] = $list_arr[$i]['id'];
				$arr[$i]['uid'] = $list_arr[$i]['uid'];
				$arr[$i]['small'] = $list_arr[$i]['small'];
				$arr[$i]['thumb'] = $list_arr[$i]['thumb'];
				$arr[$i]['file_path'] = $list_arr[$i]['file_path'];
				$image = getimagesize($list_arr[$i]['file_path']);
				$arr[$i]['thumb_parameter'] = $image[0];
				$arr[$i]['description'] = htmlentities($list_arr[$i]['description'],ENT_QUOTES,'UTF-8');
				$arr[$i]['nickname'] = $list_arr[$i]['nickname'];
				$arr[$i]['file_name'] = $list_arr[$i]['file_name'];
				$arr[$i]['album_name'] = Community::getAlbumInfo($list_arr[$i]['albumid']);
				$arr[$i]['class_name'] = $list_arr[$i]['class_name'];//所属分类
				$arr[$i]['file_type'] = $list_arr[$i]['file_type'];//类别
				$arr[$i]['file_state'] = $list_arr[$i]['file_state'];//来源
				$arr[$i]['be_like_count'] = $list_arr[$i]['be_like_count'];//喜欢
				$arr[$i]['be_collect_count'] = $list_arr[$i]['be_collect_count'];//被收藏数量
				$arr[$i]['be_reply_count'] = $list_arr[$i]['be_reply_count'];
				$arr[$i]['input_time'] = $list_arr[$i]['input_time'];
				$arr[$i]['status'] = $list_arr[$i]['status'];
				$arr[$i]['file_recommend'] = $list_arr[$i]['file_recommend'];//分享是否推荐
				$arr[$i]['top'] = $list_arr[$i]['top'];//分享置顶状态
				$arr[$i]['top_time'] = $list_arr[$i]['top_time'];//分享置顶有效期
				//$arr[$i]['count'] = Community::GetAlbumCount($content[$i]['id']);
				$arr[$i]['tags'] = Community::getShareTagName($arr[$i]['id']);
				
			}
			$getClassList = Community::getClassListdesc();
			$getClassListcontent = $getClassList['-msg-'][arr];//分享分类
			//print_r($getClassList);
			/*$page_split = new PagerSplit($datas['-msg-']['count'],$page);
			$page_str = $page_split->GetPagerContent();*/
			include $this->admin_tpl('community_share_list');
		}else{
			//echo $datas["-msg-"];
			//die();
			echo "暂无分享内容！";die();
		}
		
	}
	
	
		/**
	 * 删除分享
	 *
	 */
	public function community_delete_share(){
		$share_id = array(intval($_GET['typeid']));
		$uid = $_GET['uid'];
		Community::deleteShare($uid,$share_id[0]);
		echo 1;
	}
	
	/**
	 * 审核管理
	 *
	 */
	public function community_status_share(){
		//通过审核操作
		if ($_POST['states'] == "通过"){
			$shareid = $_POST['shareid'];
			//print_r($shareid);die();
			if(!empty($shareid)){
			$states = "99";
			Community::updateSharestatusInfo($shareid,$states);
			g('操作成功！','?m=community&c=communityshare&a=community_share_list');
			}else{
				echo "<script>";
				echo "alert('请选择分享再进行操作！');window.location.href='?m=community&c=communityshare&a=community_share_list'";
				echo "</script>";
			}
		}
		//通过审核并推荐
		if ($_POST['states'] == "通过并推荐"){
			$shareid = $_POST['shareid'];
			if(!empty($shareid)){
			$states = "file_recommend";
			Community::updateSharestatusInfo($shareid,$states);
			g('操作成功！','?m=community&c=communityshare&a=community_share_list');
			}else{
				echo "<script>";
				echo "alert('请选择分享再进行操作！');window.location.href='?m=community&c=communityshare&a=community_share_list'";
				echo "</script>";
			}
		}
		
		//取消推荐操作
		if ($_POST['states'] == "取消推荐"){
			$shareid = $_POST['shareid'];
			if(!empty($shareid)){
			$states = "nopass_file_recommend";
			Community::updateSharestatusInfo($shareid,$states);
			g('操作成功！','?m=community&c=communityshare&a=community_share_list');
			}else{
				echo "<script>";
				echo "alert('请选择分享再进行操作！');window.location.href='?m=community&c=communityshare&a=community_share_list'";
				echo "</script>";
			}
		}
		
		
		//取消置顶操作
		if ($_POST['states'] == "取消置顶"){
			$shareid = $_POST['shareid'];
			if(!empty($shareid)){
			$states = "nopass_top";
			Community::updateSharestatusInfo($shareid,$states);
			g('操作成功！','?m=community&c=communityshare&a=community_share_list');
			}else{
				echo "<script>";
				echo "alert('请选择分享再进行操作！');window.location.href='?m=community&c=communityshare&a=community_share_list'";
				echo "</script>";
			}
		}
		
		//单项取消置顶操作
		if ($_GET['onestates'] == "yes"){
			$shareid = array($_GET['shareid']);
			//print_r($shareid);die();
			$states = "nopass_top";
			Community::updateSharestatusInfo($shareid,$states);
			g('操作成功！','?m=community&c=communityshare&a=community_share_list');
		}
		
		//通过置顶操作
		if ($_GET['topshare'] == "yes"){
			$getid = $_POST['id'];
			$shareid = explode(',', $getid);
			//$end_time = $_POST['end_time'];
			$end_time = $_POST['time'];
			if (($end_time == "一天") || $end_time == ""){
				$end_time = date('Y-m-d G:i:s',strtotime("+1 day"));//时间加一天
			}elseif($end_time == "12小时"){
				$end_time = date('Y-m-d G:i:s',strtotime("+12 hour"));//时间12小时
			}elseif($end_time == "1小时"){
				$end_time = date('Y-m-d G:i:s',strtotime("+1 hour"));//时间1小时
			}else{
				$end_time = date('Y-m-d').' '.$end_time.':'.date('s');//自定义时间
			}
			$toptype = $_POST['toptype'];
			$states = "top";
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
				Community::updateSharestatusInfo($shareid,$states,"",$toptype,$end_time);
				echo 1;
			
			//g('操作成功！','?m=community&c=communityshare&a=community_share_list');
			}else{
				Community::updateSharestatusInfo($shareid,$states,"",$toptype,$end_time);
				echo 1;
			}
		}
		
		//不通过审核操作
		if ($_POST['states'] == "不通过"){
			$shareid = $_POST['shareid'];
			if(!empty($shareid)){
			$isdel = Community::getsharestates($shareid);//判断是否需要减1
			$states = "98";
			Community::updateSharestatusInfo($shareid,$states,$isdel);
//			for($i=0;$i<count($shareid);$i++){
//				$uidinfo=Community::getShareInfo($shareid[$i]);
//				$uid=$uidinfo['-msg-'][0]['uid'];
//				Community::deleteShare($uid,$shareid[$i]);
//			}
			g('操作成功！','?m=community&c=communityshare&a=community_share_list');
			}else{
				echo "<script>";
				echo "alert('请选择分享再进行操作！');window.location.href='?m=community&c=communityshare&a=community_share_list'";
				echo "</script>";
			}
		}
		//删除分享
		if ($_POST['states'] == "删除"){
			
			$shareid = $_POST['shareid'];
			if(!empty($shareid)){
			for($i=0;$i<count($shareid);$i++){
			$uidinfo=Community::getShareInfo($shareid[$i]);
			$uid=$uidinfo['-msg-'][0]['uid'];
			Community::deleteShare($uid,$shareid[$i]);
			}
			g('删除分享成功','?m=community&c=communityshare&a=community_share_list');
			}else{
				echo "<script>";
				echo "alert('请选择分享再进行操作！');window.location.href='?m=community&c=communityshare&a=community_share_list'";
				echo "</script>";
			}

		}

	}
	
	/**
	 * 分享评论列表
	 *
	 */
	public function community_reply_share(){
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$shareid = $_GET['shareid'];//转递过来的分享ID
		if ($_GET['search'] == "yes") {
			$shareid = $_POST['shareid'];//获取分享ID
			$star_time = $_POST['start_time'];
			$end_time = $_POST['end_time'];
			$nickname = $_POST['nickname'];//用户名
			$description = $_POST['description'];//描述
			$datas = Community::getShareReplyList($shareid,$page,10,$nickname,$star_time,$end_time,$description);
		}else{
			$datas = Community::getShareReplyList($shareid);
		}

		$arr = $datas['-msg-']['arr'];
		$page_split = new PagerSplit($datas['-msg-']['num'],$page);
		$page_str = $page_split->GetPagerContent();
			include $this->admin_tpl('community_share_reply');
		}
		
		/**
	 * 删除分享评论
	 *
	 */
	public function community_del_share_reply(){
		$rid = $_GET['typeid'];
		Community::deleteShareReply($rid);
		echo 1;
	}
	
	/**
	 * 推荐分享
	 */
	public function community_file_recommend(){
		$file_recommend=$_GET['file_recommend'];//分享推荐信息
		$fileid=$_GET['id'];//分享ID
		Community::FileRecommend($file_recommend,$fileid);
		echo "1";
	}	
	
	
	/**
	 * 单项分享置顶操作
	 */
	public function community_top_share(){
		$id = $_GET['typeid'];//分享ID
		/*if (isset($_POST['dosubmit'])) {
		$top_type=$_POST['toptype'];//置顶类型
		$end_time = $_POST['end_time'];//置顶日期
		$id = $_POST['id'];//分享ID
		Community::topshare($id,$top_type,$end_time);
		showmessage(L('update_success'), '', '', 'edit');
		}else{*/
		include $this->admin_tpl('community_top_share');
		//}
	}
	
}