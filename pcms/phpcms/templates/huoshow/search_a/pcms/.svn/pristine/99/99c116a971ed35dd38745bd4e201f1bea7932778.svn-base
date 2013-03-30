<?php 
defined('IN_PHPCMS') or exit('No permission resources.');

class MY_index extends index {
	
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * 专题首页
	 */
	public function init() {
		$specialid = $_GET['id'] ? $_GET['id'] : ($_GET['specialid'] ? $_GET['specialid'] : 0);
		if (!$specialid) showmessage(L('illegal_action'));
		$info = $this->db->get_one(array('id'=>$specialid, 'disabled'=>0));
		if(!$info) showmessage(L('special_not_exist'), 'back');
		extract($info);
		$link_arr = $this->db->sselect("SELECT navigation_name,link
				FROM v9_special_navigation
				WHERE special_id='$specialid'
				ORDER BY `order` DESC");
		//获取子分类为导航
		$nav_arr = $this->db->sselect("SELECT typeid,parentid,`name`,url,listorder FROM v9_type WHERE parentid=$specialid AND navigation=1 ORDER BY listorder");
		$css = get_css(unserialize($css));
		if(!$ispage) {
			$type_db = pc_base::load_model('type_model');
			$types = $type_db->select(array('module'=>'special', 'parentid'=>$specialid), '*', '', '`listorder` ASC, `typeid` ASC', '', 'listorder');
		}
		if ($pics) {
			$pic_data = get_pic_content($pics);
			unset($pics);
		}
		if ($voteid) {
			$vote_info = explode('|', $voteid);
			$voteid = $vote_info[1];
		}
		$siteid =  $_GET['siteid'] ? $_GET['siteid'] : get_siteid();
		$SEO = seo($siteid, '', $title, $description);
		$commentid = id_encode('special', $id, $siteid);
		$template = $info['index_template'] ? $info['index_template'] : 'index';
		include template('special', $template);
	}
	
	
}
?>