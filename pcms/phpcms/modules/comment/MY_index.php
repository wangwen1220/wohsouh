<?php
defined('IN_PHPCMS') or exit('No permission resources.'); 
class MY_index extends index {
	function __construct() {
		parent::__construct();
	}
	
	public function init() {
		$hot = isset($_GET['hot']) && intval($_GET['hot']) ? intval($_GET['hot']) : 0;
		
		pc_base::load_sys_class('form');
		$commentid =& $this->commentid;
		$modules =& $this->modules;
		$contentid =& $this->contentid;
		$siteid =& $this->siteid;
		$username = param::get_cookie('_username',L('phpcms_friends'));
		$userid = param::get_cookie('_userid');
		
		$comment_setting_db = pc_base::load_model('comment_setting_model');
		$setting = $comment_setting_db->get_one(array('siteid'=>$this->siteid));
		//SEO
		$SEO = seo($siteid, '', $title);
		
		//通过API接口调用数据的标题、URL地址
		if (!$data = get_comment_api($commentid)) {
			$this->_show_msg(L('illegal_parameters'));
		} else {
			$title = $data['title'];
			$url = $data['url'];
			if (isset($data['allow_comment']) && empty($data['allow_comment'])) {
				showmessage(L('canot_allow_comment'));
			}
			unset($data);
		} 		
		
		
		$CATEGORYS = getcache('category_content_'.$siteid,'commons');
		$catidarr = explode("-", $commentid);
		$catid = str_replace("content_", "", $catidarr[0]);
		
		if(strpos($catidarr[0],"content_")===false)//不是内容评论
		{
			$is_content_comment = false;
		}
		else
		{
			$is_content_comment = true;
			if(!is_numeric($catid))
				showmessage(('栏目ID异常'));
			$CAT = $CATEGORYS[$catid];
			$arrparentid = explode(',', $CAT['arrparentid']);
			$top_parentid = $arrparentid[1] ? $arrparentid[1] : $catid;
		}
		if (isset($_GET['iframe'])) {
			if (strpos($url,APP_PATH) === 0) {
				$domain = APP_PATH;
			} else {
				$urls = parse_url($url);
				$domain = $urls['scheme'].'://'.$urls['host'].(isset($urls['port']) && !empty($urls['port']) ? ":".$urls['port'] : '').'/';
			}
			//include template('comment', 'show_list');
			include template('comment', 'huoshow_show_list');
			
		} else {
			if($top_parentid == 12)
				include template('comment', 'huoshow_list_movie');
			else
				include template('comment', 'huoshow_list');
		}
	}
	
	
}