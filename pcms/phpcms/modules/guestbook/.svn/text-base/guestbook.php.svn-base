<?php 
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('admin','admin',0);

class guestbook extends admin {
	function __construct() {
		parent::__construct();//继承父类构造函数
		$this->M = new_html_special_chars(getcache('guestbook', 'commons'));//读取留言本配置缓存文件
		$this->guestbook_db = pc_base::load_model('guestbook_model');
	}
	
	public function init() {
		if($_GET['reply']=='no'){//显示未回复
			$where = array('reply'=>'','siteid'=>$this->get_siteid());
		}else{//默认显示全部
			$where = array('siteid'=>$this->get_siteid());
		}
		$page = isset($_GET['page']) && intval($_GET['page']) ? intval($_GET['page']) : 1;
		$infos = $this->guestbook_db->listinfo($where,$order = 'gid DESC',$page,
				$pages = '10');
		$pages = $this->guestbook_db->pages;
		include $this->admin_tpl('guestbook_list');
	
	}
}
