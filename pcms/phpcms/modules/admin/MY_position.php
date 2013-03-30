<?php
defined('IN_PHPCMS') or exit('No permission resources.');

class MY_position extends position {

	public function __construct() {
		parent::__construct();
	}
	
	public function init() {
			$infos = array();
			//增加搜索条件
			$pas_name = $_GET['keyword'];
			if (empty($pas_name)){
				$sql_pasname= '';
			}else {
				$sql_pasname= " AND `name` LIKE '%$pas_name%'";
			}
			$where = '';
			$current_siteid = self::get_siteid();
			$category = getcache('category_content_'.$current_siteid,'commons');
			$model = getcache('model','commons');
			$where = "(`siteid`='$current_siteid' OR `siteid`='0')".$sql_pasname;
			$page = $_GET['page'] ? $_GET['page'] : '1';
			$infos = $this->db->listinfo($where, $order = 'listorder ASC,posid ASC', $page, $pagesize = 20);
			$pages = $this->db->pages;
			$show_dialog = true;
			$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?m=admin&c=position&a=add\', title:\''.L('posid_add').'\', width:\'500\', height:\'360\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);', L('posid_add'));
			include $this->admin_tpl('position_list');
	}
	
	/**
	 * 推荐位添加
	 */
	public function add() {
		if(isset($_POST['dosubmit'])) {
			if(!is_array($_POST['info']) || empty($_POST['info']['name'])){
				showmessage(L('operation_failure'));
			}
			$_POST['info']['siteid'] = intval($_POST['info']['modelid']) ? get_siteid() : 0;
			$_POST['info']['listorder'] = intval($_POST['info']['listorder']);
			$_POST['info']['maxnum'] = intval($_POST['info']['maxnum']);
			$insert_id = $this->db->insert($_POST['info'],true);
			$this->_set_cache();
			if($insert_id){
				showmessage(L('operation_success'), '', '', 'add');
			}
		} else {
			pc_base::load_sys_class('form');
			$this->sitemodel_db = pc_base::load_model('sitemodel_model');
			$sitemodel = $sitemodel = array();
			$sitemodel = getcache('model','commons');
			foreach($sitemodel as $value){
				if($value['siteid'] == get_siteid())$modelinfo[$value['modelid']]=$value['name'];
			}			
			$show_header = $show_validator = true;
			include $this->admin_tpl('position_add');
		}
		
	}
	
	/**
	 * 推荐位编辑
	 */
	public function edit() {
		if(isset($_POST['dosubmit'])) {
			$_POST['posid'] = intval($_POST['posid']);
			if(!is_array($_POST['info']) || empty($_POST['info']['name'])){
				showmessage(L('operation_failure'));
			}
			$_POST['info']['siteid'] = intval($_POST['info']['modelid']) ? get_siteid() : 0;
			$_POST['info']['listorder'] = intval($_POST['info']['listorder']);
			$_POST['info']['maxnum'] = intval($_POST['info']['maxnum']);
			$this->db->update($_POST['info'],array('posid'=>$_POST['posid']));
			$this->_set_cache();
			showmessage(L('operation_success'), '', '', 'edit');
			//showmessage(L('operation_success'));
		} else {
			$info = $this->db->get_one(array('posid'=>intval($_GET['posid'])));
			extract($info);
			pc_base::load_sys_class('form');
			$this->sitemodel_db = pc_base::load_model('sitemodel_model');
			$sitemodel = $sitemodel = array();
			$sitemodel = getcache('model','commons');
			foreach($sitemodel as $value){
				if($value['siteid'] == get_siteid())$modelinfo[$value['modelid']]=$value['name'];
			}
			$show_validator = $show_header = $show_scroll = true;
			include $this->admin_tpl('position_edit');
		}
	
	}
	
	
	/**
	 * 根据推荐位显示符合条件的信息
	 * 
	 */
	public function selectInfoToRecommend()
	{
		$pid = $_GET["pid"];
		if(empty($pid) || !is_numeric($pid) || $pid<=0)
		{
			echo "推荐位信息异常";
			return false;
		}
		$page = $_GET["page"];
		if(empty($page) || !is_numeric($page) || $page<0)
			$page = 1;
		$ajax = $_POST["ajax"];
		$keyinfo = $_POST["key"];
		if(!empty($_POST["key"]))
			$keysql = "and a.title like '%".$_POST["key"]."%'";
		else
			$keysql = "";
		
		$catinfo = $_POST["catinfo"];
		if(!empty($_POST["catinfo"]))
			$catsql = "and a.catid='".$_POST["catinfo"]."'";
		else
			$catsql = "";
		
		$modelinfo = $_POST["modelinfo"];
		if(!empty($_POST["modelinfo"]))
			$modelsql = "and a.modeid='".$_POST["modelinfo"]."'";
		else
			$modelsql = "";
		
		$article_type = $_POST["article_type"];
		$article_sql = "";
		//新闻模型的图片方式过滤
		if($modelinfo==1 && !empty($article_type) && $article_type>0)
		{
			switch ($article_type)
			{
				case 1://文章
					$article_sql = "and c.pictureurls =''";
					break;
				case 2://组图
					$article_sql = "and c.pictureurls !='' and c.img_attachment_mode='2'";
					break;
				case 3://图库
					$article_sql = "and c.pictureurls !='' and c.img_attachment_mode='1'";
					break;
			}
			/*
			$sql = "SELECT a.id,a.title,a.url,a.username,b.catname 
					FROM v9_global_id a
					inner join v9_category b on a.catid=b.catid 
					inner join v9_news_data c on a.id=c.id
					WHERE a.id not in(select id from v9_position_data where posid='$pid')
					 $keysql $catsql $modelsql $article_sql 
					ORDER BY a.input_time desc limit 0,100";
			
			var_dump($sql);
			*/
			$sql = "SELECT tmp.id,tmp.title,tmp.url,tmp.username,tmp.catname,tmp.input_time FROM 
						(SELECT a.id,a.title,a.url,a.username,b.catname,a.input_time 
						FROM v9_global_id a 
						INNER JOIN v9_category b ON a.catid=b.catid 
						inner join v9_news_data c on a.id=c.id
						WHERE a.status='99' $keysql $catsql $modelsql $article_sql
						ORDER BY a.input_time DESC LIMIT 0,150) tmp
					WHERE tmp.id NOT IN (SELECT id FROM v9_position_data WHERE posid='$pid')";
					
//			var_dump($sql);
			
		}
		else 
		{
			/*
			$sql = "SELECT a.id,a.title,a.url,a.username,b.catname 
				FROM v9_global_id a
				inner join v9_category b on a.catid=b.catid 
				WHERE a.id not in(select id from v9_position_data where posid='$pid') $keysql $catsql $modelsql 
				ORDER BY a.input_time desc limit 0,100";	
				
			var_dump($sql);
			*/
			//先把前150条做临时表，然后在临时表中150条数据做not in，提高效率
			$sql = "SELECT tmp.id,tmp.title,tmp.url,tmp.username,tmp.catname,tmp.input_time FROM 
						(SELECT a.id,a.title,a.url,a.username,b.catname,a.input_time FROM v9_global_id a 
						INNER JOIN v9_category b ON a.catid=b.catid 
						WHERE a.status='99' $keysql $catsql $modelsql
						ORDER BY a.input_time DESC LIMIT 0,150) tmp
					WHERE tmp.id NOT IN (SELECT id FROM v9_position_data WHERE posid='$pid')";
			//var_dump($sql);
			
		}	
//		var_dump($sql);
//		die();	
		$dataarr = $this->db->sselect($sql);
		
		$this->siteid = $this->get_siteid();
		$this->categorys = getcache('category_content_'.$this->siteid,'commons');
		
		$this->models = getcache('model','commons');
		$model_arr = array();
		foreach ($this->models as $k=>$v)
		{
			if($v[disabled] != 1)
			{
				$tmp["id"] = $v[modelid];
				$tmp["name"] = $v[name];
				$model_arr[] = $tmp;
			}
		}
		
		$tree = pc_base::load_sys_class('tree');
		$tree->icon = array('&nbsp;&nbsp;│ ','&nbsp;&nbsp;├─ ','&nbsp;&nbsp;└─ ');
		$tree->nbsp = '&nbsp;&nbsp;';
		$categorys = array();
		foreach($this->categorys as $cid=>$r) {
			if($this->siteid != $r['siteid'] || $r['type']) continue;
			//if($modelid && $modelid != $r['modelid']) continue;
			if($r['child'])
				$r['disabled'] = 'disabled';
			else
			{
				if($modelid && $modelid != $r['modelid'])
					$r['disabled'] = 'disabled';
				else
					$r['disabled'] = '';
			}
			//$r['disabled'] = $r['child'] ? 'disabled' : '';
			$r['selected'] = $cid == $catid ? 'selected' : '';
			$categorys[$cid] = $r;
		}
		$str  = "<option value='\$catid' \$selected \$disabled>\$spacer \$catname</option>";
		$tree->init($categorys);
		$string .= $tree->get_tree(0, $str);
		//var_dump($sql);
		if($ajax!="yes")
			include $this->admin_tpl('position_select_recommend');
	}
	
	public function batch_send_recommend()
	{
		$news_ids = $_POST["select_id"];
		if(empty($news_ids) || !is_array($news_ids))
			showmessage("没有选择需要推送的信息");
		$pos_id = $_POST["pos_id"];
		$position_data_db = pc_base::load_model('position_data_model');
		$news_id_str = implode(',',$news_ids);
		$sql = "select a.id,a.modeid,a.title,a.username,
				a.url,a.input_time,a.catid,a.thumb,a.description,
				IF(thumb='',0,1) AS isthumb
				from v9_global_id a
				where a.id in($news_id_str)";
		
		$dbarr = $position_data_db->sselect($sql);
		
		$sql = "select listorder from v9_position_data where posid='$pos_id' 
				order by listorder desc limit 0,1";
//		echo $sql;
//		die("die");
		$dbarr_pos = $position_data_db->sselect($sql);
		$max_listorder = $dbarr_pos[0][listorder];
		for($i=0;$i<count($dbarr);$i++)
		{
			$max_listorder+=1;
			$tmparr = array(
							'title' => $dbarr[$i][title],
							'description' => $dbarr[$i][description],
							'thumb' => $dbarr[$i][thumb],
							'inputtime' => $dbarr[$i][input_time],
					); 
			$position_data_db->insert(array('id'=>$dbarr[$i][id],'catid'=>$dbarr[$i][catid],
					'posid'=>$pos_id,'thumb'=>$dbarr[$i][isthumb],'module'=>'content',
					'modelid'=>$dbarr[$i][modeid],'data'=>array2string($tmparr),
					'listorder'=>$max_listorder));
		}
		showmessage(L('operation_success'), '', '', 'torecommend');
	}
	
	
	/**
	 * 设置推荐位新闻新的排序
	 * 
	 */
	public function setPositionListOrder()
	{
		$posid = $_GET["posid"];//推荐位id
		$op = $_GET["op"];//1代表置顶，2代表移动
		$cid = $_GET["cid"];//当前信息id
		$down_pid = $_GET["did"];//应该在cid下方的信息id,为0代表下方没有信息
		if(empty($posid) || !is_numeric($posid) || $posid<0)
			showmessage("推荐位信息错误");
		if(empty($op) || !is_numeric($op) || $op<0)
			showmessage("操作方式错误");
		if(empty($cid) || !is_numeric($cid) || $cid<0)
			showmessage("当前信息错误");
		if($op==2 && (!is_numeric($down_pid) || $down_pid<0))
			showmessage("下方信息错误");
		
		if($op==1)
		{
			$sql = "select listorder FROM v9_position_data 
					where posid='$posid' order by listorder desc limit 0,1";
			$listorderarr = $this->db->sselect($sql);
			$old_order = $listorderarr[0][listorder];
			$sql = "UPDATE v9_position_data SET listorder=$old_order+1 WHERE id='$cid' and posid='$posid'";
			$this->db->sselect($sql);
		}
		else 
		{
			if($down_pid==0)
			{
				$sql="SELECT listorder FROM v9_position_data WHERE posid='$posid' order by listorder asc LIMIT 0,1";
				$listorderarr = $this->db->sselect($sql);
				$old_order = $listorderarr[0][listorder];
				$new_order = !is_numeric($old_order)?0:($old_order-1);
			}
			else
			{
				//找下方id的排序
				$sql = "select listorder FROM v9_position_data 
						where id='$down_pid' and posid='$posid' limit 0,1";
				$listorderarr = $this->db->sselect($sql);
				$old_order = $listorderarr[0][listorder];
				
				//找下方id的上一个id的排序
				$sql = "select listorder FROM v9_position_data
						where posid='$posid' and listorder>='$old_order' and id not in ($cid,$down_pid)
				 		order by listorder asc limit 0,1";
				$listorderarr = $this->db->sselect($sql);
				$up_order = $listorderarr[0][listorder];
				//如果排序位之间有空位，则直接利用空位
				if($up_order-$old_order>1)
					$new_order = $old_order+1;
				else 
				{
					//把大于下方id排序的所有信息的排序全部+2
					$sql = "update v9_position_data set listorder=listorder+2 where posid='$posid'
							and listorder>=$old_order and id!='$down_pid'";
					$this->db->sselect($sql);
					$new_order = $old_order+1;
				}
			}
			$sql = "UPDATE v9_position_data SET listorder=$new_order WHERE id='$cid' and posid='$posid'";
			$this->db->sselect($sql);
		}
		showmessage(L('operation_success'), '', '', '');
		
	}
	
}
?>