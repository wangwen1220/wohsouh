<?php
class model_install
{
	public $pass = 1;
	private $store;
	
	function __construct()
	{
		$this->store = CMSTOP_PATH.'data/store.txt';
		if (!is_file($this->store))
		{
			@file_put_contents($this->store, serialize(array()));
		}
	}

	// 一.环境检测
	public function env()
	{
		$exts = get_loaded_extensions();
		$needExts = array('PDO','pdo_mysql','mysql','mbstring','curl');
		
		foreach ($needExts AS & $e) $info[$e] = in_array($e, $exts);
		
		$info['short_open_tag'] = ini_get('short_open_tag');
		$info['magic_quotes_gpc'] = get_magic_quotes_gpc();
		$info['allow_url_fopen'] = ini_get('allow_url_fopen');
		
		foreach ($info AS $k => & $v)
		{
			$rs = $v ? '<font color="green">&#x221A;</font>' : '<font color="red">&#x00D7;</font>';
			$recommend = '必须开启';
			if ($k == 'magic_quotes_gpc') 
			{
				$rs = $v ? '<font color="red">开启</font>' : '<font color="green">关闭</font>';
				$recommend = '建议关闭';
			}
			if (in_array($k, $needExts))
			{
				if($k != 'Zend Optimizer') $k .= '扩展';
			}
			
			$v = array(
				'text'		=>	$k,
				'current' 	=>	$rs,
				'recommend'	=>	$recommend,
				'rs' 		=>  $rs,
				'pass'		=>	$v,
			);
		}
		
		$info2['server'] = $this->server();
		$info2['phpversion'] = $this->php();
		$info2['optimizer'] = $this->optimizer();
		$info2['gd'] = $this->gd();
		
		$info = array_merge($info2, $info);
		
		// 判断是否能够安装
		$needPass = array('phpversion', 'optimizer', 'gd', 'PDO', 'pdo_mysql', 'mysql');
		foreach ($info AS $k => $r)
		{
			if (!$r['pass'] && in_array($k, $needPass)) {
				$this->pass = 0;
			}
		}
		return $info;
	}
	
	
	private function optimizer()
	{
		ob_start();
		phpinfo(INFO_GENERAL);
		$phpinfo = ob_get_contents();
		ob_end_clean();
		preg_match('#Optimizer\&nbsp\;v([\d\.]+)#', $phpinfo, $temp);
		$version = $temp[1] ? $temp[1] : 0;
		$pass = version_compare($version, '2.6.0') >= 0;
		$rs = $pass ? '<font color="green">&#x221A;</font>' : '<font color="red">&#x00D7;</font>';
		return array(
			'text'		=>	'Optimizer',
			'current' 	=>	$version,
			'recommend'	=>	'3.3.x',
			'rs' 		=> 	$rs,
			'pass'		=>	$pass
		);
	}
	
	private function gd()
	{
		extension_loaded('gd') && $gd = 1;
		if ($gd) {
			function_exists('imagepng') && $gd = 'png';
			function_exists('imagejpeg') && $gd .= ' jpg';
			function_exists('imagegif') && $gd .= ' gif';
		}
		$rs = $gd ? '<font color="green">&#x221A;</font>' : '<font color="red">&#x00D7;</font>';
		$current = $gd ? $gd : '不支持';
		return array(
			'text'		=>	'GD扩展',
			'current' 	=> 	$current,
			'recommend'	=>	'png jpg gif',
			'rs'		=>	$rs,
			'pass'		=>	$gd,
		);
	}
	
	private function php()
	{
		$version = phpversion();
		$pass = version_compare(phpversion(), '5.1.2') >= 0;
		$rs = $pass ? '<font color="green">&#x221A;</font>' : '<font color="red">&#x00D7;</font>';
		return array(
			'text'		=>	'PHP版本',
			'current' 	=> 	$version,
			'recommend'	=>	'5.2.x',
			'rs'		=>	$rs,
			'pass'		=>	$pass
		);
	}
	
	private function server()
	{
		$server = $_SERVER['SERVER_SOFTWARE'];
		$server = trim(preg_replace(array('#PHP\/[\d\.]+#', '#\([\w]+\)#'), '', $server)).'-'.PHP_OS;
		return array(
			'text'		=>	'服务器',
			'current' 	=>	$server,
			'recommend'	=>	'Apache/2.2.x-Linux',
			'rs' 		=>	'<font color="green">&#x221A;</font>',
			'pass'		=>	1,
		);
	}
	
	// 二.安装
	public function install()
	{
		set_time_limit(0);
		$config = $this->get('config');
		$siteinfo = $this->get('siteinfo');
		if(!$config || !$siteinfo)
		{
			echo '<script>
				alert("配置没有填写完整");
				top.location = "?action=step1";
			</script>';
			exit;
		}
		try {
			$this->writeConfig($config, $siteinfo);
			$this->core($config, $siteinfo);
			$this->apps();
		} catch (Exception $e) {
			echo $e->getMessage();
			exit;
		}
		
		$lockfile = CMSTOP_PATH.'data/install.lock';
		file_put_contents($lockfile, 1);
		chmod($lockfile, 0444);
		folder::delete(CACHE_PATH);
		return true;
	}
	
	// 1.写配置文件
	private function writeConfig($config, $siteinfo)
	{
		$this->flush('安装开始……<br/><br/>正在生成配置文件……<br/>');
		$this->config_define();
		$this->config($siteinfo);
		$this->db_session($config);
		$this->config_define();
	}
	
	// config.js, define.php, cookie.php session.php
	private function config_define()
	{
		$files = array('config.js', 'define.php', 'cookie.php', 'session.php');
		foreach ($files AS $file)
		{
			$text = file_get_contents("config/$file");
			$text = str_replace('{WWW_URL}', WWW_URL, $text);
			$text = str_replace('{ROOT}', ROOT, $text);
			if ($file == 'config.js')
			{
				file_put_contents(ROOT_PATH.'img/js/config.js', $text);
			}
			else
			{
				file_put_contents(CMSTOP_PATH."config/$file", $text);
			}
		}
	}
	 
	private function config($siteinfo)
	{
		$text = file_get_contents('config/config.php');
		$text = str_replace('{authkey}', $siteinfo['authkey'], $text);
		file_put_contents(CMSTOP_PATH.'config/config.php', $text);
	}
	
	// db.php, db_session.php
	private function db_session($config)
	{
		$config['session_table'] = $config['prefix'].'session';
		$keys = array_keys($config);
		foreach ($keys as & $k) $k = '{'.$k.'}';
		$values = array_values($config);
		
		$text = file_get_contents('config/db.php');
		$text = str_replace($keys, $values, $text);
		file_put_contents(CMSTOP_PATH.'config/db.php', $text);
		
		$text = file_get_contents('config/db_session.php');
		$text = str_replace($keys, $values, $text);
		file_put_contents(CMSTOP_PATH.'config/db_session.php', $text);
	}
	
	// 2.安装核心功能
	private function core($config, $siteinfo)
	{
		if(!get_magic_quotes_gpc()) 
		{
			$siteinfo = addslashes_deep($siteinfo);
			$config = addslashes_deep($config);
		}
		$link = mysql_connect($config['host'], $config['username'], $config['password']) OR exit('无法连接数据库');
		if(!mysql_select_db($config['dbname'], $link))
		{
			mysql_query('CREATE DATABASE '.$config['dbname']) OR exit('无法创建数据库');
		}
		
		loader::import('db.db');
		$db = db::get_instance($config);
		$db->exec("SET FOREIGN_KEY_CHECKS=0");
		$this->sqlfile(INSTALL_DIR.'core.sql', $db);
		
		$this->flush('<br/>正在添加管理员帐号……<br/>');
		// 加入管理员帐号
		extract($siteinfo);
		$password = md5($password);
		$db->exec("INSERT INTO `#table_admin` SET userid = 1, roleid = 1, departmentid = 1, `name` = '$username', sex = 1, created = ".TIME.", createdby = 1;");
		$db->exec("INSERT INTO `#table_member` SET userid = 1, username = '$username', `password` = '$password', email = '$email',
				groupid = 1, regip = '".IP."', regtime = ".TIME.", lastloginip = '".IP."', lastlogintime = ".TIME);
		$db->exec("INSERT INTO `#table_member_detail` SET userid = 1, name = '$username', sex = 1");
		
		return true;
	}
	
	// 运行sql文件
	private function sqlfile($filename, & $db)
	{
		if(!is_file($filename)) return false;
    	
		$code = file($filename);
		
		$sqls = array();
		$i = 0;
		foreach ($code AS $r)
		{
			$r = trim($r);
			if(substr($r, 0, 2) == '--' || substr($r, 0, 2) == '/*') continue;
			$sqls[$i] .= $r;
			substr($r, -1) == ';' && $i++;
		}
		$this->flush('<br/>创建数据表……<hr/>');
		$insertStart = $forceStart = 0;
		
		foreach ($sqls AS $sql)
		{
    		$sql = str_replace('cmstop_', $db->options['prefix'], $sql);
    		$sql = str_replace('{WWW_URL}', WWW_URL, $sql);
			$db->exec($sql);
			preg_match('#CREATE\s+TABLE\s+(?:[\w\s]+\s)?`([\w]+)`#', $sql, $temp);
			if($temp[1]) 
			{
				$this->flush($temp[1].'<br/>');
			}
			preg_match('#INSERT\s+INTO\s+`([\w]+)`#', $sql, $temp);
			if($temp[1])
			{
				if(!$insertStart) $this->flush('<br/>添加必要数据……<hr/>');
				$insertStart = 1;
				$this->flush($temp[1].'<br/>');
			}
			preg_match('#ALTER\s+TABLE\s+`([\w]+)`#', $sql, $temp);
			if($temp[1])
			{
				if(!$forceStart) $this->flush('<br/>添加外键约束……<hr/>');
				$forceStart = 1;
				$this->flush($temp[1].'<br/>');
			}
		}
		return true;
	}
	
	// 3.安装可选apps
	private function apps()
	{
		$apps = $this->get('apps');
		$appConfig = include 'apps.php';
		$config = array();
		foreach ($appConfig AS $v)
		{
			$config[$v['app']] = $v['name'];
		}
		if(!$apps) return true;
		include_once CMSTOP_PATH.'apps/system/model/admin/app.php';
		$app = new model_admin_app();
		$this->flush('<br/>开始安装APP……<hr/>');
		foreach ($apps as $appname)
		{
			$rs = $app->install($appname);
			if($rs === false)
			{
				$this->flush($config[$appname].'安装失败，你可以稍后进后台再尝试添加……<br/>');
			}
			else
			{
				$this->flush($config[$appname].'安装成功……<br/>');
			}
		}
		return true;
	}
	
	// 配置临时存取
	public function set($key, $value)
	{
		$data = unserialize(file_get_contents($this->store));
		$data[$key] = $value;
		file_put_contents($this->store, serialize($data));
	}
	
	public function get($key)
	{
		$data = unserialize(file_get_contents($this->store));
		return $data[$key];
	}
	
	public function finish()
	{
		@unlink($this->store);
		@unlink(WWW_PATH.'index.php');
	}
	
	private function flush($str)
	{
		echo $str;
		echo '<script>
				document.body.scrollTop = 99999;
			</script>';
		flush();
	}
}