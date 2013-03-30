<?php
/**
 * 
 * @param 通用数据导入类
 */

defined('IN_PHPCMS') or exit('No permission resources.');

class MY_do_import extends do_import {

	public function __construct() {
		parent::__construct();
		
	}
	

	/**
	 * 
	 * 新闻模型数据导入...
	 * @param 配置 $import_info
	 * @param 开始值 $offset
	 * @param 配置importid值 $importid
	 */
	function add_content($import_info, $offset,$importid){
   		$data = array();
 		$keyid = $import_info['keyid'];
		//$import_info[dbpassword] = GLOBAL_MYSQL_PWD;
		//数据库表里实际字段为paginationtype没有pages,但获取的模型为pages。如不修改则出现表没有发现pages列
		$import_info["paginationtype"] = $import_info["pages"];
		//unset($import_info["pages"]);
  		if(!$keyid){
  			showmessage(L('no_keyid'),HTTP_REFERER);
 		}
		$import_info['defaultcatid'] = intval($import_info['defaultcatid']);
		if(!$import_info['defaultcatid']){
			echo L('no_default_catid');
			return false;
		}
		$number = $import_info['number'];//每次执行条数
		$data['catid'] = $import_info['defaultcatid'];
 		//获取选择的对应字段
		$fields = getcache('model_field_'.$import_info['modelid'], 'model');
		//数据库表里实际字段为paginationtype没有pages,但获取的模型为pages。如不修改则出现表没有发现pages列
		$fields["paginationtype"] = $fields["pages"];
		//unset($fields["pages"]);
 		foreach ($fields as $field=>$val_field){
			if($field == 'contentid') continue;
			$oldfield = trim($import_info[$field]['field']);
			$func = trim($import_info[$field]['func']);
			$value = trim($import_info[$field]['value']);
			if($value){
				$data[$field] = $value;
			}else{
				if($oldfield && $func){
					$oldfields[$oldfield] = $field;//oldfields为被选中，向里面导入数据的字段
					$oldfuncs[$oldfield] = $func;
				}elseif($oldfield ){
					$oldfields[$oldfield] = $field;
				}
			}	
		}
 		//处理没有数据模型而使用系统内置数据库处理程序 
 		//临时构建  数据模型配置表单
		$db_conf = array();
		$db_conf['import_array'] = array();
		$db_conf['import_array']['type']= $import_info['dbtype'];
		$db_conf['import_array']['hostname']= $import_info[dbhost];
		$db_conf['import_array']['username']= $import_info[dbuser];
		$db_conf['import_array']['password']= $import_info[dbpassword];
		$db_conf['import_array']['database']= $import_info[dbname];
		$db_conf['import_array']['charset']= $import_info[dbcharset];
		
		if($import_info['dbtype'] == 'mysql'){
			
			//返回一个当前配置所需要的数据库连接  
			pc_base::load_sys_class('db_factory');
			$this->thisdb = db_factory::get_instance($db_conf)->get_database('import_array');
			
			/*组合本次查询所形成的SQL 相关参数 为数组*/
	      	$result = $this->filter_fields($import_info, $offset, $keyid);
	  		@extract($result);
	  		
	  		if($result['total']==0){//没有新数据不再往下执行
	  			$forward = $forward ? $forward: "?m=import&c=import&a=init";//不需要导入
	 			showmessage(L('no_data_needimport'), $forward);
	  		} 
	  	
	  		$ddata = $data;//暂不知
	   		$sql = "SELECT $selectfield FROM ".$result['dbtables']." ".$result['condition']." order by $orderby asc $limit";//此$limit 为$result 解开的变量

   	   		$data_charset = pc_base::load_config('database');
      	   	$this->thisdb->query('SET NAMES '.$data_charset['default']['charset']); 
	 		$query = $this->thisdb->query($sql); 
	 		$importnum = $this->thisdb->num_rows($sql); 
	 		
			/***
			 * 从返回的数据集，重新组合成多维数组，然后再下面用for循环，一条条插入目标数据库。
			 */ 
	   		while ($r = $this->thisdb->fetch_next()){
	 			$data = $ddata;
	     		foreach ($r as $k=>$v){	//对数据集，循环显示
	     			//强制从CMSTOP中取得ID赋值
	     			if($k=="contentid")
	     				$data["id"] = intval($v);
	 				if(isset($oldfields[$k]) && $v) { 
	 					
						if($oldfuncs[$k]) {//如果有处理函数，则直接用处理函数处理
							//如果配置是GBK编码,需要转码 
							$data[$oldfields[$k]] = $oldfuncs[$k]($v); 
 							if(!$data[$k]) continue;//如果有默认值，
						}else{
							$data[$oldfields[$k]] = $v;//没有处理函数，并且也没有
						}
					}
				}
	  			$maxid = max($maxid, $r[$keyid]);
	 			$s[] = $data;
	 		}
		}elseif($import_info['dbtype'] == 'access'){
			
			pc_base::load_sys_class('access');
  			$this->thisdb = new access();
  			$this->thisdb->connect($import_info[dbhost],$import_info[dbuser],$import_info[dbpassword]);
  			$result = $this->filter_fields_new($import_info, $offset, $keyid);//需要返回SQL语句，供下面使用。因为可能涉及多表联查，使用left join来生成SQL
	  		@extract($result); 
	  		
	  		if($result['total']==0){//没有新数据不再向下执行
	  			$forward = $forward ? $forward: "?m=import&c=import&a=init";//不需要导入
	 			showmessage(L('no_data_needimport'), $forward);
	  		} 
	  	
	  		$ddata = $data;//暂不知
 	 		$sql = $result['return_sql'];
	    	$query = $this->thisdb->query($sql);  
			$importnum = $this->thisdb->num_rows($query);
			/*组合本次查询所形成的SQL 相关参数 为数组*/ 
 			foreach ($query as $array){
				 $data = $ddata;
 				 foreach ($array as $k=>$v){
				 	if(isset($oldfields[$k]) && $v) {
						if($oldfuncs[$k]) {//如果有处理函数，则直接用处理函数处理
							$data[$oldfields[$k]] = $oldfuncs[$k](iconv('GBK','UTF-8',$v));
							if(!$data[$k]) continue;//如果有默认值，
						}else{
							$data[$oldfields[$k]] = iconv('GBK','UTF-8',$v);//没有处理函数，并且也没有
						}
					}
				 }
				$maxid = max($maxid, $array['max_userid']);
	 			$s[] = $data;
			}
		}
 		
    	//循环添加到目标数据库
		foreach ($s as $val){
   			/*在这里对CATID进行替换*/
 			//读取配置里关于catid的设置 
 			
 			$default_catid = $import_info['defaultcatid'];
 			$replace_catids = $import_info['catids'];
  			if(in_array($val['catid'], $replace_catids)){
  				$val['catid'] = array_search($val['catid'], $replace_catids);
 			}else {
  				$val['catid'] = $default_catid;
 			}

 			//echo $val['catid'];
 			/**数据插入目标表中**/
   			$content = pc_base::load_model('content_model');
 			$content->set_model($import_info['modelid']);//设置要导入的模型id
 			
			$contentid = $content->add_content($val, 1);
			//如果是导入组图到新闻模块
			if($import_info['import_name'] == "新闻-组图")
			{
				$sql = "SELECT * FROM `".GLOBAL_CMSTOP_DBNAME."`.cmstop_picture_group
				WHERE contentid='$contentid' order by pictureid asc";
				$dbarr = $content->sselect($sql);
				$count = count($dbarr);
				$arr = array();
				for($ii=0;$ii<$count;$ii++)
				{
				//$img_att_str = empty($dbarr[$ii]["image"])?
					//				"":"/uploadfile/".$dbarr[$ii]["image"];
					$img_att_str = empty($dbarr[$ii]["image"])?
						"":"/upload/".$dbarr[$ii]["image"];
					$alt = $dbarr[$ii]["pictureid"]."_".$dbarr[$ii]["contentid"];
					$arr[] = array("url"=>$img_att_str,"alt"=>$alt,"note"=>$dbarr[$ii]["note"]);
				}
				$pic_att_str = addslashes(var_export($arr,true));
				
				$sql = "update v9_news_data set pictureurls='$pic_att_str'
				where id='$contentid'";
				$content->sselect($sql);
			}
			
			//如果是图片模型，则把附件导入到组图中
			if($import_info['modelid']==3)
			{
				$sql = "SELECT * FROM `".GLOBAL_CMSTOP_DBNAME."`.cmstop_picture_group 
						WHERE contentid='$contentid' order by pictureid asc";
				$dbarr = $content->sselect($sql);
				$count = count($dbarr);
				$arr = array();
				for($ii=0;$ii<$count;$ii++)
				{
					//$img_att_str = empty($dbarr[$ii]["image"])?
					//				"":"/uploadfile/".$dbarr[$ii]["image"];
					$img_att_str = empty($dbarr[$ii]["image"])?
								"":"/upload/".$dbarr[$ii]["image"];
					$alt = $dbarr[$ii]["pictureid"]."_".$dbarr[$ii]["contentid"];
					$arr[] = array("url"=>$img_att_str,"alt"=>$alt,"note"=>$dbarr[$ii]["note"]);
				}
				$pic_att_str = addslashes(var_export($arr,true));
				
				$sql = "update v9_picture_data set pictureurls='$pic_att_str' 
						where id='$contentid'";
				$content->sselect($sql);
			}
			
 		}
 		$finished = 0;
		if($number && ($importnum < $number)){//如果有每次执行多少条，而且当前要插入的条数已经小于设定值，则说明已是最后的执行
			$finished = 1;			
		}
		$import_info['maxid'] = $maxid;
		$import_info['importtime'] = SYS_TIME;
		//更新最近的插入ID，防止重复插入数据
 		$this->setting($import_info);
 		//更新数据库，存入本次执行时间
   		$this->import_db->update(array("lastinputtime"=>SYS_TIME,"last_keyid"=>$maxid),array('id'=>$importid));
 		return $finished.'-'.$total; //$total：为filter_fields()返回的结果解开
 		
	}
}
?>