<?php
defined('IN_PHPCMS') or exit('No permission resources.');
if(!defined('CACHE_MODEL_PATH')) define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);


class MY_content_model extends content_model {
	
	public function __construct() {
		parent::__construct();
	}

	/**
	 * 添加内容
	 * 
	 * @param $datas
	 * @param $isimport 是否为外部接口导入
	 */
	public function add_content($data,$isimport = 0) {
		if($isimport) $data = new_addslashes($data);
		
		$this->search_db = pc_base::load_model('search_model');
		$modelid = $this->modelid;
		require_once CACHE_MODEL_PATH.'content_input.class.php';
        require_once CACHE_MODEL_PATH.'content_update.class.php';
		$content_input = new content_input($this->modelid);
		$inputinfo = $content_input->get($data,$isimport);

		
		
		$systeminfo = $inputinfo['system'];
		$modelinfo = $inputinfo['model'];

		if($data['inputtime'] && !is_numeric($data['inputtime'])) {
			$systeminfo['inputtime'] = strtotime($data['inputtime']);
		} elseif(!$data['inputtime']) {
			$systeminfo['inputtime'] = SYS_TIME;
		} else {
			$systeminfo['inputtime'] = $data['inputtime'];
		}
		
		//读取模型字段配置中，关于日期配置格式，来组合日期数据
		$this->fields = getcache('model_field_'.$modelid,'model');
		$setting = string2array($this->fields['inputtime']['setting']);
		extract($setting);
		if($fieldtype=='date') {
			$systeminfo['inputtime'] = date('Y-m-d');
		}elseif($fieldtype=='datetime'){
 			$systeminfo['inputtime'] = date('Y-m-d H:i:s');
		}

		if($data['updatetime'] && !is_numeric($data['updatetime'])) {
			$systeminfo['updatetime'] = strtotime($data['updatetime']);
		} elseif(!$data['updatetime']) {
			$systeminfo['updatetime'] = SYS_TIME;
		} else {
			$systeminfo['updatetime'] = $data['updatetime'];
		}
		$systeminfo['username'] = $data['username'] ? $data['username'] : param::get_cookie('admin_username');
		$systeminfo['sysadd'] = defined('IN_ADMIN') ? 1 : 0;
		
		//获得title
		$titlename = string2array($this->fields['title']['field']);
		//获得catid
		$catidname = string2array($this->fields['catid']['field']);
		//extract($setting);
		
		
		
		//处理截图
		$modelinfo['content'] = $this->processInterceptImage($modelinfo['content']);
		
		//自动提取摘要
		if(isset($_POST['add_introduce']) && $systeminfo['description'] == '' && isset($modelinfo['content'])) {
			$content = stripslashes($modelinfo['content']);
			$introcude_length = intval($_POST['introcude_length']);
			$systeminfo['description'] = str_cut(str_replace(array("\r\n","\t",'[page]','[/page]','&ldquo;','&rdquo;','&nbsp;'), '', strip_tags($content)),$introcude_length);
			$inputinfo['system']['description'] = $systeminfo['description'] = addslashes($systeminfo['description']);
		}
		//自动提取缩略图
		if(isset($_POST['auto_thumb']) && $systeminfo['thumb'] == '' && isset($modelinfo['content'])) {
			$content = $content ? $content : stripslashes($modelinfo['content']);
			$auto_thumb_no = intval($_POST['auto_thumb_no'])-1;
			if(preg_match_all("/(src)=([\"|']?)([^ \"'>]+\.(gif|jpg|jpeg|bmp|png))\\2/i", $content, $matches)) {
				$systeminfo['thumb'] = $matches[3][$auto_thumb_no];
			}
		}
		
		//图片模型组图第一张做自动缩略图
		$tmparr = string2array(new_stripslashes($inputinfo[model]['pictureurls']));
		/*
		if($this->modelid==3 && $_POST['auto_thumb'] && $systeminfo['thumb'] == '' &&
				count( $tmparr)>0)
		{
			$systeminfo['thumb'] = $tmparr[0]['url'];
		}
		*/
		//资讯也可能有组图，只要有组图，第一张作为自动缩略图
		if($_POST['auto_thumb'] && $systeminfo['thumb'] == '' &&
				count( $tmparr)>0)
		{
			$systeminfo['thumb'] = $tmparr[0]['url'];
		}
		
		
		/*解决cmstop导入时ID要求完全一致的问题*/
		$current_time = time ();
		if (! empty ( $data ["id"] )) {
			$inputinfo ['system'] ["id"] = $data ["id"];
			$this->sselect ( "insert into v9_global_id (id,modeid,input_time,
					last_update_time,title,catid,username,thumb,description,status)
					VALUES ('" . $data ["id"] . "','$modelid',
					'" . $systeminfo ['inputtime'] . "','" . $systeminfo ['updatetime'] . "',
					'" . $systeminfo [$titlename] . "',
					'" . $systeminfo [$catidname] . "',
					'" . $systeminfo ['username'] . "',
					'" . $systeminfo ['thumb'] . "',
					'" . $systeminfo ['description'] . "',
					'" . $data['status'] . "'
			)" );
		} else {
			$this->sselect ( "insert into v9_global_id (modeid,input_time,title,catid,
					username,last_update_time,thumb,description,status)
					VALUES ('$modelid','" . $systeminfo ['inputtime'] . "',
					'" . $systeminfo [$titlename] . "',
					'" . $systeminfo [$catidname] . "',
					'" . $systeminfo ['username'] . "',
					'" . $systeminfo ['inputtime'] . "',
					'" . $systeminfo ['thumb'] . "',
					'" . $systeminfo ['description'] . "',
					'" . $data['status'] . "'
					)" );
			$inputinfo ['system'] ["id"] = $this->insert_id ();
		}
		$systeminfo ['id'] = $inputinfo ['system'] ["id"];
		
		//主表
		$tablename = $this->table_name = $this->db_tablepre.$this->model_tablename;
		//添加内容时把标题和摘要的特殊字符处理
// 		$systeminfo['title'] = safe_replace($systeminfo['title']);
// 		$systeminfo['description'] = safe_replace($systeminfo['description']);
		$id = $modelinfo['id'] = $this->insert($systeminfo,true);
		$this->update($systeminfo,array('id'=>$id));
		//更新URL地址
		if($data['islink']==1) {
			$urls[0] = $_POST['linkurl'];
		} else {
			$urls = $this->url->show($id, 0, $systeminfo['catid'], $systeminfo['inputtime'], $data['prefix'],$inputinfo,'add');
		}
		$this->table_name = $tablename;
		$this->update(array('url'=>$urls[0]),array('id'=>$id));
		$this->sselect("update v9_global_id set url='".$urls[0]."' where id='$id'");
		//附属表
		$this->table_name = $this->table_name.'_data';
		$this->insert($modelinfo);
		//添加统计
		$this->hits_db = pc_base::load_model('hits_model');
		$hitsid = 'c-'.$modelid.'-'.$id;
		$this->hits_db->insert(array('hitsid'=>$hitsid,'catid'=>$systeminfo['catid'],'updatetime'=>SYS_TIME));
		//更新到全站搜索
		$this->search_api($id,$inputinfo);
		//更新栏目统计数据
		$this->update_category_items($systeminfo['catid'],'add',1);
		//调用 update
		$content_update = new content_update($this->modelid,$id);
		//合并后，调用update
		$merge_data = array_merge($systeminfo,$modelinfo);
		$merge_data['posids'] = $data['posids'];
		$content_update->update($merge_data);
		
		//发布到审核列表中
		if(!defined('IN_ADMIN') || $data['status']!=99) {
			$this->content_check_db = pc_base::load_model('content_check_model');
			$check_data = array(
				'checkid'=>'c-'.$id.'-'.$modelid,
				'catid'=>$systeminfo['catid'],
				'siteid'=>$this->siteid,
				'title'=>$systeminfo['title'],
				'username'=>$systeminfo['username'],
				'inputtime'=>$systeminfo['inputtime'],
				'status'=>$data['status'],
				);
			$this->content_check_db->insert($check_data);
		}
		//END发布到审核列表中
		if(!$isimport) {
			$html = pc_base::load_app_class('html', 'content');
			if($urls['content_ishtml'] && $data['status']==99) $html->show($urls[1],$urls['data']);
			$catid = $systeminfo['catid'];
		}
		//发布到其他栏目
		if($id && isset($_POST['othor_catid']) && is_array($_POST['othor_catid'])) {
			$linkurl = $urls[0];
			$r = $this->get_one(array('id'=>$id));
			foreach ($_POST['othor_catid'] as $cid=>$_v) {
				$this->set_catid($cid);
				$mid = $this->category[$cid]['modelid'];
				if($modelid==$mid) {
					//相同模型的栏目插入新的数据
					$inputinfo['system']['catid'] = $systeminfo['catid'] = $cid;
					$newid = $modelinfo['id'] = $this->insert($systeminfo,true);
					$this->table_name = $tablename.'_data';
					$this->insert($modelinfo);
					if($data['islink']==1) {
						$urls = $_POST['linkurl'];
					} else {
						$urls = $this->url->show($newid, 0, $cid, $systeminfo['inputtime'], $data['prefix'],$inputinfo,'add');
					}
					$this->table_name = $tablename;
					$this->update(array('url'=>$urls[0]),array('id'=>$newid));
					//发布到审核列表中
					if($data['status']!=99) {
						$check_data = array(
							'checkid'=>'c-'.$newid.'-'.$mid,
							'catid'=>$cid,
							'siteid'=>$this->siteid,
							'title'=>$systeminfo['title'],
							'username'=>$systeminfo['username'],
							'inputtime'=>$systeminfo['inputtime'],
							'status'=>1,
							);
						$this->content_check_db->insert($check_data);
					}
					if($urls['content_ishtml'] && $data['status']==99) $html->show($urls[1],$urls['data']);
				} else {
					//不同模型插入转向链接地址
					$newid = $this->insert(
					array('title'=>$systeminfo['title'],
						'style'=>$systeminfo['style'],
						'thumb'=>$systeminfo['thumb'],
						'keywords'=>$systeminfo['keywords'],
						'description'=>$systeminfo['description'],
						'status'=>$systeminfo['status'],
						'catid'=>$cid,'url'=>$linkurl,
						'sysadd'=>1,
						'username'=>$systeminfo['username'],
						'inputtime'=>$systeminfo['inputtime'],
						'updatetime'=>$systeminfo['updatetime'],
						'islink'=>1
					),true);
					$this->table_name = $this->table_name.'_data';
					$this->insert(array('id'=>$newid));
					//发布到审核列表中
					if($data['status']!=99) {
						$check_data = array(
							'checkid'=>'c-'.$newid.'-'.$mid,
							'catid'=>$systeminfo['catid'],
							'siteid'=>$this->siteid,
							'title'=>$systeminfo['title'],
							'username'=>$systeminfo['username'],
							'inputtime'=>$systeminfo['inputtime'],
							'status'=>1,
							);
						$this->content_check_db->insert($check_data);
					}
				}
				$hitsid = 'c-'.$mid.'-'.$newid;
				$this->hits_db->insert(array('hitsid'=>$hitsid,'catid'=>$cid,'updatetime'=>SYS_TIME));
			}
		}
		//END 发布到其他栏目
		//更新附件状态
		if(pc_base::load_config('system','attachment_stat')) {
			$this->attachment_db = pc_base::load_model('attachment_model');
			$this->attachment_db->api_update('','c-'.$systeminfo['catid'].'-'.$id,2);
		}
		//生成静态
		if(!$isimport && $data['status']==99) {
			//在添加和修改内容处定义了 INDEX_HTML
			if(defined('INDEX_HTML')) $html->index();
			if(defined('RELATION_HTML')) $html->create_relation_html($catid);
		}
		return $id;
	}

	/**
	 * 修改内容
	 *
	 * @param $datas
	 */
	public function edit_content($data,$id) {
		$model_tablename = $this->model_tablename;
		//前台权限判断
		if(!defined('IN_ADMIN')) {
			$_username = param::get_cookie('_username');
			$us = $this->get_one(array('id'=>$id,'username'=>$_username));
			if(!$us) return false;
		}
	
		$this->search_db = pc_base::load_model('search_model');
			
		require_once CACHE_MODEL_PATH.'content_input.class.php';
		require_once CACHE_MODEL_PATH.'content_update.class.php';
		$content_input = new content_input($this->modelid);
		$inputinfo = $content_input->get($data);
	
		
		$systeminfo = $inputinfo['system'];
		$modelinfo = $inputinfo['model'];
		if($data['inputtime'] && !is_numeric($data['inputtime'])) {
			$systeminfo['inputtime'] = strtotime($data['inputtime']);
		} elseif(!$data['inputtime']) {
			$systeminfo['inputtime'] = SYS_TIME;
		} else {
			$systeminfo['inputtime'] = $data['inputtime'];
		}
	
		if($data['updatetime'] && !is_numeric($data['updatetime'])) {
			$systeminfo['updatetime'] = strtotime($data['updatetime']);
		} elseif(!$data['updatetime']) {
			$systeminfo['updatetime'] = SYS_TIME;
		} else {
			$systeminfo['updatetime'] = $data['updatetime'];
		}
		
		
		
		//处理截图
		$modelinfo['content'] = $this->processInterceptImage($modelinfo['content']);
		//自动提取摘要
		if(isset($_POST['add_introduce']) && $systeminfo['description'] == '' && isset($modelinfo['content'])) {
			$content = stripslashes($modelinfo['content']);
			$introcude_length = intval($_POST['introcude_length']);
			$systeminfo['description'] = str_cut(str_replace(array("\r\n","\t",'[page]','[/page]','&ldquo;','&rdquo;','&nbsp;'), '', strip_tags($content)),$introcude_length);
			$inputinfo['system']['description'] = $systeminfo['description'] = addslashes($systeminfo['description']);
		}
		//自动提取缩略图
		if(isset($_POST['auto_thumb']) && $systeminfo['thumb'] == '' && isset($modelinfo['content'])) {
			$content = $content ? $content : stripslashes($modelinfo['content']);
			$auto_thumb_no = intval($_POST['auto_thumb_no'])-1;
			if(preg_match_all("/(src)=([\"|']?)([^ \"'>]+\.(gif|jpg|jpeg|bmp|png))\\2/i", $content, $matches)) {
				$systeminfo['thumb'] = $matches[3][$auto_thumb_no];
			}
		}
		
		//图片模型组图第一张做自动缩略图
		$tmparr = string2array(new_stripslashes($inputinfo[model]['pictureurls']));
		//资讯也可能有组图，只要有组图，第一张作为自动缩略图
		//if($this->modelid==3 && $_POST['auto_thumb'] && $systeminfo['thumb'] == '' &&
		//		count( $tmparr)>0)
		if($_POST['auto_thumb'] && $systeminfo['thumb'] == '' &&
				count( $tmparr)>0)
		{
			$systeminfo['thumb'] = $tmparr[0]['url'];
		}
		//var_dump($systeminfo['thumb']);die();
		
		
		
		if($data['islink']==1) {
			$systeminfo['url'] = $_POST['linkurl'];
		} else {
			//更新URL地址
			$urls = $this->url->show($id, 0, $systeminfo['catid'], $systeminfo['inputtime'], $data['prefix'],$inputinfo,'edit');
			$systeminfo['url'] = $urls[0];
		}
		
		//修改global_id的信息
		//获得title
		$this->fields = getcache('model_field_'.$this->modelid,'model');
		$titlename = string2array($this->fields['title']['field']);
		//$catidname = string2array($this->fields['catid']['field']);
		
		$sql = "UPDATE v9_global_id SET title='".$systeminfo[$titlename]."',
		last_update_time='".$systeminfo['updatetime']."',
		url='".$urls[0]."',
		thumb='".$systeminfo['thumb']."',
		status='".$data['status']."'
		where id='".$id."'";
		//var_dump($sql);die();
		$this->sselect($sql);
		
		//主表
		$this->table_name = $this->db_tablepre.$model_tablename;
		$this->update($systeminfo,array('id'=>$id));
		$this->sselect("update v9_global_id set url='".$urls[0]."' where id='$id'");
		
		//附属表
		$this->table_name = $this->table_name.'_data';
		$this->update($modelinfo,array('id'=>$id));
		$this->search_api($id,$inputinfo);
		//调用 update
		$content_update = new content_update($this->modelid,$id);
		$content_update->update($data);
		//更新附件状态
		if(pc_base::load_config('system','attachment_stat')) {
			$this->attachment_db = pc_base::load_model('attachment_model');
			$this->attachment_db->api_update('','c-'.$systeminfo['catid'].'-'.$id,2);
		}
		//更新审核列表
		$this->content_check_db = pc_base::load_model('content_check_model');
		$check_data = array(
				'catid'=>$systeminfo['catid'],
				'siteid'=>$this->siteid,
				'title'=>$systeminfo['title'],
				'status'=>$systeminfo['status'],
		);
		if(!isset($systeminfo['status'])) unset($check_data['status']);
		$this->content_check_db->update($check_data,array('checkid'=>'c-'.$id.'-'.$this->modelid));
		//生成静态
		$html = pc_base::load_app_class('html', 'content');
		if($urls['content_ishtml']) {
			$html->show($urls[1],$urls['data']);
		}
		//在添加和修改内容处定义了 INDEX_HTML
		if(defined('INDEX_HTML')) $html->index();
		if(defined('RELATION_HTML')) $html->create_relation_html($systeminfo['catid']);
		return true;
	}
	
	
	/**
	 * 删除内容
	 * @param $id 内容id
	 * @param $file 文件路径
	 * @param $catid 栏目id
	 */
	public function delete_content($id,$file,$catid = 0) {
		//删除主表数据
		$this->delete(array('id'=>$id));
		//删除global_id数据
		$this->db->sselect("delete from v9_global_id where id='$id'");
		//删除从表数据
		$this->table_name = $this->table_name.'_data';
		$this->delete(array('id'=>$id));
		//重置默认表
		$this->table_name = $this->db_tablepre.$this->model_tablename;
		//更新栏目统计
		$this->update_category_items($catid,'delete');
	}
	
	/**
	 * 处理正文中截图传上来的图片
	 * @param unknown_type $str
	 */
	protected function processInterceptImage($str)
	{
		//自动把截图中的图片保存并替换URL
		$modelinfo['content'] = $str;
		$pos = 0;
		$tmp_result = "";
		$count = strlen("src=\\\"data:image/");
		while(1)
		{
			if(($start = strpos($modelinfo['content'],"src=\\\"data:image/",$pos))!==false)
			{
				$start1 = $start +$count;
				$end = strpos($modelinfo['content'],'\"',$start1);
				$tmp_result .= substr($modelinfo['content'], $pos,$start-$pos);
				$tmp_str = substr($modelinfo['content'], $start1,$end-$start1);
				$tmp_arr = explode(';', $tmp_str);
				$ext_name = $tmp_arr[0];
				$img_str_tmp = explode(',', $tmp_arr[1]);
				$img_str = $img_str_tmp[1];
				//$base_name = "/uploadfiles/aaa.$ext_name";
				$upload_url = pc_base::load_config('system','upload_url');
				$upload_root = pc_base::load_config('system','upload_path');
				$dir = date('Y/md/');
				$uploadpath = $upload_url.$dir;
				$uploaddir = $upload_root.$dir;
				$basename = date('Ymdhis').rand(100, 999).'.'.$ext_name;
				$file_name = $uploaddir.$basename;
				dir_create($uploaddir);
				if($img_str_tmp[0]=='base64')
					file_put_contents($file_name,base64_decode($img_str));
				$pos = $end+1;
				$tmp_result .= " src=\"".$uploadpath.$basename;
			}
			else
			{
				$tmp_result .= substr($modelinfo['content'], $pos);
				break;
			}
		}
		return $tmp_result;
	}  
	
}
?>