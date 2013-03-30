<?php 
/**
 *  special_api.class.php 专题接口类
 *
 * @copyright			(C) 2005-2010 PHPCMS
 * @license				http://www.phpcms.cn/license/
 * @lastmodify			2010-8-3
 */

defined('IN_PHPCMS') or exit('No permission resources.');

class MY_special_api extends special_api {
	
	protected $navigate_db;
	public function __construct() {
		parent::__construct();
		$this->navigate_db = pc_base::load_model('special_navigate_model'); //专题数据模型
	}
	
	public function _update_navigate($specialid,$linkarr,$a='add')
	{
		if(empty($specialid) || !is_numeric($specialid))
		{
			return false;
		}
		//表示新增
		foreach ($linkarr as $k => $v) 
		{
			if($a=="add")
			{
				$listorder = (empty($v['order'])
								||!is_numeric($v['order'])
								||$v['order']<0)?0:$v['order'];
				$this->navigate_db->insert(array('special_id'=>$specialid,
							"navigation_name"=>$v['navigation_name'],
							'order'=>$listorder,
							'link'=>$v['link']),true);
			}
			elseif ($a == 'edit')
			{
				$link_id = $v['linkid'];
				$is_del = $v['del'];
				
				if(empty($is_del)) //修改 而不是删除
				{
					$listorder = (empty($v['order'])
							||!is_numeric($v['order'])
							||$v['order']<0)?0:$v['order'];
					if(empty($v['linkid'])) //在修改时新增的选项
					{
						
						$this->navigate_db->insert(array('special_id'=>$specialid,
								"navigation_name"=>$v['navigation_name'],
								'order'=>$listorder,
								'link'=>$v['link']),true);
					}
					else
						$this->navigate_db->update(array('special_id'=>$specialid,
								"navigation_name"=>$v['navigation_name'],
								'order'=>$listorder,
								'link'=>$v['link']), array('id'=>$link_id));
				}
				else
				{
					$this->navigate_db->delete(array('id'=>$link_id));
				}
			}
		}
		return true;
	}
	
	public function _del_special_link($special_id)
	{
		if(empty($special_id) || !is_numeric($special_id) || $special_id<=0)
			return false;
		$this->navigate_db->delete(array('special_id'=>$special_id));
		return true;
	}
	
	/**
	 * 更新分类
	 * @param intval $pid 专题ID
	 * @param string $type 分类字符串 每行一个分类。格式为：分类名|分类目录，例:最新新闻|news last
	 * @param string $a 添加时直接加入到数据库，修改是需要判断。
	 * @return boolen
	 */
	public function _update_type($specialid, $type, $a = 'add') {
		$specialid = intval($specialid);
		if (!$specialid) return false;
		$special_info = $this->db->get_one(array('id'=>$specialid));
		$app_path = substr(APP_PATH, 0, -1);
		foreach ($type as $k => $v) {
//			if (!$v['name'] || !$v['typedir']) continue;
			//添加时，无需判断直接加到数据表中，修改时应判断是否为新添加、修改还是删除
			$siteid = get_siteid();
			if ($a == 'add' && !$v['del']) {
				$typeid = $this->type_db->insert(array('siteid'=>$siteid, 'module'=>'special', 'name'=>$v['name'], 'listorder'=>$v['listorder'], 'typedir'=>$v['typedir'], 'parentid'=>$specialid, 'listorder'=>$k), true);
				if ($siteid>1) {
					$site = pc_base::load_app_class('sites', 'admin');
					$site_info = $site->get_by_id($siteid);
					if ($special_info['ishtml']) {
						$url = $site_info['domain'].'special/'.$special_info['filename'].'/'.$v['typedir'].'/'.'type-'.$typeid.'.html';
					} else {
						$url = $site_info['domain'].'index.php?m=special&c=index&a=type&specialid='.$specialid.'&typeid='.$typeid;
					}
				} else {
					if($special_info['ishtml']) $url = addslashes($app_path.pc_base::load_config('system', 'html_root').'/special/'.$special_info['filename'].'/'.$v['typedir'].'/'.'type-'.$typeid.'.html');
					else $url = APP_PATH.'index.php?m=special&c=index&a=type&specialid='.$specialid.'&typeid='.$typeid;
				}
				$this->type_db->update(array('url'=>$url), array('typeid'=>$typeid));
			} elseif ($a == 'edit') {
				if ((!isset($v['typeid']) || empty($v['typeid'])) && (!isset($v['del']) || empty($v['del']))) {
					$typeid = $this->type_db->insert(array('siteid'=>$siteid, 'module'=>'special', 'name'=>$v['name'], 'listorder'=>$v['listorder'], 'typedir'=>$v['typedir'], 'parentid'=>$specialid, 'listorder'=>$k), true);
					if ($siteid>1) {
						$site = pc_base::load_app_class('sites', 'admin');
						$site_info = $site->get_by_id($siteid);
						if ($special_info['ishtml']) {
							$url = $site_info['domain'].'special/'.$special_info['filename'].'/'.$v['typedir'].'/'.'type-'.$typeid.'.html';
						} else {
							$url = $site_info['domain'].'index.php?m=special&c=index&a=type&specialid='.$specialid.'&typeid='.$typeid;
						}
					} else {
						if($special_info['ishtml']) $url = addslashes($app_path.pc_base::load_config('system', 'html_root').'/special/'.$special_info['filename'].'/'.$v['typedir'].'/'.'type-'.$typeid.'.html');
						else $url = APP_PATH.'index.php?m=special&c=index&a=type&specialid='.$specialid.'&typeid='.$typeid;
					}
					$v['url'] = $url;
					$this->type_db->update($v, array('typeid'=>$typeid));
				} 
				if ((!isset($v['del']) || empty($v['del'])) && $v['typeid']) {
					$this->type_db->update(array('name'=>$v['name'], 'typedir'=>$v['typedir'], 'listorder'=>$v['listorder']), array('typeid'=>$r['typeid']));
					if ($siteid>1) {
						$site = pc_base::load_app_class('sites', 'admin');
						$site_info = $site->get_by_id($siteid);
						if ($special_info['ishtml']) {
							$url = $site_info['domain'].'special/'.$special_info['filename'].'/'.$v['typedir'].'/'.'type-'.$v['typeid'].'.html';
						} else {
							$url = $site_info['domain'].'index.php?m=special&c=index&a=type&specialid='.$specialid.'&typeid='.$v['typeid'];
						}
					} else {
						if($special_info['ishtml']) $url = addslashes($app_path.pc_base::load_config('system', 'html_root').'/special/'.$special_info['filename'].'/'.$v['typedir'].'/'.'type-'.$v['typeid'].'.html');
						else $url = APP_PATH.'index.php?m=special&c=index&a=type&specialid='.$specialid.'&typeid='.$v['typeid'];
					}
					$v['url'] = $url;
					$typeid = $v['typeid'];
					unset($v['typeid']);
					$this->type_db->update($v, array('typeid'=>$typeid));
				} 
				if ($v['typeid'] && $v['del']) {
					$this->delete_type($v['typeid'], $siteid, $special_info['ishtml']);
				}
			}
		}
//		die("4444");
		return true;
	}
	
	
}
?>