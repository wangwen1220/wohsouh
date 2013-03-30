<?php

class cache_file {
	
	/*缓存默认配置*/
	protected $_setting = array(
								'suf' => '.cache.php',	/*缓存文件后缀*/
								'type' => 'array',		/*缓存格式：array数组，serialize序列化，null字符串*/
							);
	
	/*缓存路径*/
	protected $filepath = '';

	/**
	 * 构造函数
	 * @param	array	$setting	缓存配置
	 * @return  void
	 */
	public function __construct($setting = '') {
		$this->get_setting($setting);
	}
	
	/**
	 * 写入缓存
	 * @param	string	$name		缓存名称
	 * @param	mixed	$data		缓存数据
	 * @param	array	$setting	缓存配置
	 * @param	string	$type		缓存类型
	 * @param	string	$module		所属模型
	 * @return  mixed				缓存路径/false
	 */

	public function set($name, $data, $setting = '', $type = 'data', $module = ROUTE_M) {
		$this->get_setting($setting);
		if(empty($type)) $type = 'data';
		if(empty($module)) $module = ROUTE_M;
		$filepath = CACHE_PATH.'caches_'.$module.'/caches_'.$type.'/';
		$filename = $name.$this->_setting['suf'];
	    if(!is_dir($filepath)) {
			mkdir($filepath, 0777, true);
	    }
	    
	    //如果是写数据缓存，则先生成一个Lock文件
	    //用于锁定，然后生成一个同名_2的文件，
	    //生成后替换原文件
	    //用于多个进程发现某个pc:content缓存失效，同时去数据库读取信息
	    //如果这个sql耗时，导致性能损耗，经过这样修改后，同一时间只有
	    //一个进程写文件，其他进程发现lock文件，则去读老缓存  by ck
	    if($module=='tpl_data')
	    {
	    	//var_dump($filepath1.$filename);die();
	    	file_put_contents($filepath.$filename.".lock", "");
	    }
	    //var_dump($module);die();
	    if($this->_setting['type'] == 'array') {
	    	$data = "<?php\nreturn ".var_export($data, true).";\n?>";
	    } elseif($this->_setting['type'] == 'serialize') {
	    	$data = serialize($data);
	    }
	    if ($module == 'commons' || ($module == 'commons' && substr($name, 0, 16) != 'category_content')) {
		    $db = pc_base::load_model('cache_model');
		    $datas = new_addslashes($data);
		    if ($db->get_one(array('filename'=>$filename, 'path'=>'caches_'.$module.'/caches_'.$type.'/'), '`filename`')) {
		    	$db->update(array('data'=>$datas), array('filename'=>$filename, 'path'=>'caches_'.$module.'/caches_'.$type.'/'));
		    } else {
		    	$db->insert(array('filename'=>$filename, 'path'=>'caches_'.$module.'/caches_'.$type.'/', 'data'=>$datas));
		    }
	    }
	    
	    //是否开启互斥锁
	    if($module=='tpl_data')
	    	$data_ext_nxt="_2";
	    else
	    	$data_ext_nxt = "";
		if(pc_base::load_config('system', 'lock_ex')) {
			$file_size = file_put_contents($filepath.$filename.$data_ext_nxt, $data, LOCK_EX);
		} else {
			$file_size = file_put_contents($filepath.$filename.$data_ext_nxt, $data);
		}
	    
		if($module=='tpl_data')
		{
			rename($filepath.$filename.$data_ext_nxt, $filepath.$filename);
			unlink($filepath.$filename.".lock");
		}
	    return $file_size ? $file_size : 'false';
	}
	
	/**
	 * 获取缓存
	 * @param	string	$name		缓存名称
	 * @param	array	$setting	缓存配置
	 * @param	string	$type		缓存类型
	 * @param	string	$module		所属模型
	 * @return  mixed	$data		缓存数据
	 */
	public function get($name, $setting = '', $type = 'data', $module = ROUTE_M) {
		$this->get_setting($setting);
		if(empty($type)) $type = 'data';
		if(empty($module)) $module = ROUTE_M;
		$filepath = CACHE_PATH.'caches_'.$module.'/caches_'.$type.'/';
		$filename = $name.$this->_setting['suf'];
		if (!file_exists($filepath.$filename)) {
			return false;
		} else {
		    if($this->_setting['type'] == 'array') {
		    	$data = @require($filepath.$filename);
		    	//$data = string2array(new_stripslashes(file_get_contents($filepath.$filename)));
		    	/*$data = file_get_contents($filepath.$filename);
		    	
		    	$data = str_replace("<?php", "", $data);
		    	$data = str_replace("?>", "", $data);
		    	$start = strpos($data,"array");
		    	$data = substr($data,$start,strrpos($data,";")-$start);
		    	$data = string2array(trim($data));
		    	*/
		    } elseif($this->_setting['type'] == 'serialize') {
		    	$data = unserialize(file_get_contents($filepath.$filename));
		    }
		    
		    return $data;
		}
	}
	
	/**
	 * 删除缓存
	 * @param	string	$name		缓存名称
	 * @param	array	$setting	缓存配置
	 * @param	string	$type		缓存类型
	 * @param	string	$module		所属模型
	 * @return  bool
	 */
	public function delete($name, $setting = '', $type = 'data', $module = ROUTE_M) {
		$this->get_setting($setting);
		if(empty($type)) $type = 'data';
		if(empty($module)) $module = ROUTE_M;	
		$filepath = CACHE_PATH.'caches_'.$module.'/caches_'.$type.'/';
		$filename = $name.$this->_setting['suf'];
		if(file_exists($filepath.$filename)) {
			if ($module == 'commons' && substr($name, 0, 16) != 'category_content') {
				$db = pc_base::load_model('cache_model');
		    	$db->delete(array('filename'=>$filename, 'path'=>'caches_'.$module.'/caches_'.$type.'/'));
			}
			return @unlink($filepath.$filename) ? true : false;
		} else {
			return false;
		}
	}
	
	/**
	 * 和系统缓存配置对比获取自定义缓存配置
	 * @param	array	$setting	自定义缓存配置
	 * @return  array	$setting	缓存配置
	 */
	public function get_setting($setting = '') {
		if($setting) {
			$this->_setting = array_merge($this->_setting, $setting);
		}
	}

	public function cacheinfo($name, $setting = '', $type = 'data', $module = ROUTE_M) {
		$this->get_setting($setting);
		if(empty($type)) $type = 'data';
		if(empty($module)) $module = ROUTE_M;
		$filepath = CACHE_PATH.'caches_'.$module.'/caches_'.$type.'/';
		$filename = $filepath.$name.$this->_setting['suf'];
		
		if(file_exists($filename)) {
			$res['filename'] = $name.$this->_setting['suf'];
			$res['filepath'] = $filepath;
			$res['filectime'] = filectime($filename);
			$res['filemtime'] = filemtime($filename);
			$res['filesize'] = filesize($filename);
			return $res;
		} else {
			return false;
		}
	}

}

?>