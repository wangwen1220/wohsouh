<?php
defined('IN_PHPCMS') or exit('No permission resources.');
class index {
	function __construct() {
		$this->guestbook_db = pc_base::load_model('guestbook_model');
		$this->_username = param::get_cookie('_username');
		$this->_userid = param::get_cookie('_userid');
		//定义站点ID常量，选择模版使用
		$siteid = isset($_GET['siteid']) ? intval($_GET['siteid']) : get_siteid();
  		define("SITEID",$siteid);
  		//读取配置，设置分页条数
		$setting = new_html_special_chars(getcache('guestbook', 'commons'));
		$this->set = $setting[SITEID];
	}
	
	public function init() { 
		//读取配置，设置分页条数
		$setting = new_html_special_chars(getcache('guestbook', 'commons'));
		$set = $setting[SITEID];
  		$pagesize = $setting[SITEID]['pagesize'];
  		$where = array('passed'=>1,'siteid'=>SITEID);
		$page = isset($_GET['page']) && intval($_GET['page']) ? intval($_GET['page']) : 1;
		$infos = $this->guestbook_db->listinfo($where, 'gid DESC',$page, $pages = $pagesize); 
  		$infos = new_html_special_chars($infos); 
		$pages = $this->guestbook_db->pages;
		pc_base::load_sys_class('form', '', 0);
 		include template('guestbook', 'index');
	}
	/**
	 *	在线留言
	 */
	public function ly()  {
		if(isset($_POST['dosubmit'])){
			if(isset($_POST['code'])){
				$code = isset($_POST['code']) && trim($_POST['code']) ?
				trim($_POST['code']) : showmessage(L('input_code'), HTTP_REFERER);
				if ($_SESSION['code'] != strtolower($code)) {
					showmessage(L('code_error'), HTTP_REFERER);
				}
			}
			$set = $this->set;
			$link_db = pc_base::load_model(guestbook_model);
			$_POST['ly']['addtime'] = SYS_TIME;
			$_POST['ly']['userid'] = $this->_userid;
			$_POST['ly']['username'] = $this->_username;
			$_POST['ly']['siteid'] = SITEID;
			$_POST['ly']['passed'] = $set['check_pass'];
			$link_db->insert($_POST['ly']);
			showmessage(L('add_success'), "?m=guestbook&c=index&siteid=$siteid");
		}  else  {
			echo $siteid.'adsf';exit;
			$setting = getcache('guestbook', 'commons');
			pc_base::load_sys_class('form', '', 0);
			$SEO = seo(SITEID, '', L('application_links'), '', '');
			include template('guestbook', 'ly');
		}
	}
	
	}
	?>
		