<?php
class controller_install
{
	private $i;
	function __construct($action)
	{
		$this->view = new view(array('dir'=>INSTALL_DIR.'view'.DS));
		$step = array(
			'start'	=>	'CmsTop 授权协议',
			'step1'	=>	'运行环境检测',
			'step2'	=>	'数据库设置',
			'step3'	=>	'站点设置',
			'step4'	=>	'扩展选择',
			'step5'	=>	'安装完成',
		);
		$this->view->assign('siteTitle', $step[$action]);
		$path = trim(str_replace('\\', '/', dirname(dirname($_SERVER['PHP_SELF']))), '/');
		$host = $_SERVER['HTTP_HOST'];
		if ($path)
		{
			define('ROOT', '/'.$path.'/');
		}
		else
		{
			define('ROOT', '/');
		}
		define('WWW_URL', (self::is_ssl() ? 'https://' : 'http://') . $host . ROOT);
		$this->i = new model_install();
	}
	
	public static function get_env($key)
	{
		return isset($_SERVER[$key]) ? $_SERVER[$key] : (isset($_ENV[$key]) ? $_ENV[$key] : FALSE);
	}
	
	public static function is_ssl()
	{
		return (strtolower(self::get_env('HTTPS')) === 'on' || strtolower(self::get_env('HTTP_SSL_HTTPS')) === 'on' || self::get_env('HTTP_X_FORWARDED_PROTO') == 'https');
	}
	
    function start()
    {
    	include_once CMSTOP_PATH.'version.php';
    	$pars = 'action=install&version='.rawurlencode(CMSTOP_VERSION).'&release='.rawurlencode(CMSTOP_RELEASE);
		$client_url = "http://app.cmstop.com/client.php?$pars";
    	$this->view->assign('client_url', $client_url);
    	$this->view->display('start');
    }
    
    // 环境检测
    function step1()
    {
    	$list = array(
    		ROOT_PATH => array('recommend'=>'必须可写(0777)'),
    		CMSTOP_PATH.'data/' => array('recommend'=>'必须可写(0777)'),
    		CMSTOP_PATH.'config/' => array('recommend'=>'必须可写(0777)'),
    		CMSTOP_PATH.'templates/default/' => array('recommend'=>'必须可写(0777)'),
    		ROOT_PATH.'admin/apps/' => array('recommend'=>'必须可写(0777)'),
    		ROOT_PATH.'img/apps/' => array('recommend'=>'必须可写(0777)'),
    		ROOT_PATH.'img/js/config.js' => array('file'=>1,'recommend'=>'必须可写(0777)')
    	);
    	$pass = 1;
    	
    	foreach ($list as $f=>&$r)
    	{
    		if (! file_exists($f))
    		{
    			if ($r['file'])
    			{
    				$right = (false !== @file_put_contents($f, ''));
    			}
    			else
    			{
    				$right = folder::create($f, 0777);
    			}
    		}
    		else
    		{
    			$right = is_writable($f) && (($r['file'] == 1) ^ is_dir($f));
    		}
    		$r['is_writable'] = $right;
    		$r['pos'] = str_replace(ROOT_PATH, '/', $f);
    		if (!$right) $pass = 0;
    	}
    	$this->view->assign('list', $list);
    	
		$env = $this->i->env();
    	$this->view->assign('env', $env);
    	
    	$this->view->assign('pass', $this->i->pass && $pass);
		$this->view->display('step1');
    }
   
    function step2()
    {
    	if($config = $this->i->get('config'))
    	{
    		$this->view->assign($config);
    	}else{
    		$this->view->assign(array(
    			'driver'	=> 	'mysql',
    			'username'	=>	'root',
    			'host'		=>	'localhost',
    			'port'		=>	3306,
    			'dbname'	=>	'cmstop',
    			'prefix'	=>	'cmstop_',
    			'pconnect'	=>	0,
    			'charset'	=>	'utf8',
    		));
    	}
    	$this->view->display('step2');
    }
    /**
     * 配置测试，返回代码：
     * 1。测试通过
     * 2。连接不上mysql
     * 3。无此数据库
     */
    function test()
    {
    	if ( !$_POST)
    	{
    		exit('0');
    	}
    	if ( !get_magic_quotes_gpc()) $_POST = addslashes_deep($_POST);
    	extract($_POST);
    	@$link = mysql_connect($host, $username, $password) OR die('2');
		
    	$this->i->set('config', $_POST);
    	$res = @mysql_query("show variables like 'have_innodb'", $link);
    	if (!$res)
    	{
    		exit ('7');
    	}
    	$row = mysql_fetch_row($res);
    	if (strtoupper($row[1]) != 'YES')
    	{
    		exit ('7');
    	}
    	
    	if (!mysql_select_db($dbname, $link))
    	{
    		if (false !== @mysql_query("create database `$dbname`", $link))
    		{
    			@mysql_query("drop database `$dbname`", $link);
    			exit('3');
    		}
    		else
    		{
    			exit('5');
    		}
    	}
    	
    	$res = mysql_list_tables($dbname, $link);
    	
    	$prefix = $_POST['prefix'];
    	if ($res)
    	{
    		$hasTable = array();
    		while ($row = mysql_fetch_row($res))
    		{
				$hasTable[] = $row[0];
		    }
		    mysql_free_result($res);
		    
		    $contents = file_get_contents(INSTALL_DIR.'core.sql');
		    preg_match_all('/CREATE\s+TABLE\s+(?:[\w\s]+\s)?`(.+)`/iU',$contents,$m);
		    $insTable = $m[1];
		    foreach($insTable as &$t)
		    {
		    	$t = str_replace('cmstop_', $prefix, $t);
		    }
			if (count(array_intersect($hasTable, $insTable)))
			{
				exit('4');
			}
    	}
    	if (false !== @mysql_query("create table `{$prefix}admin`(`testfield` int(1) default null)", $link))
    	{
    		@mysql_query("drop table `{$prefix}admin`", $link);
    	}
    	else
    	{
    		exit('6');
    	}
    	exit('1');
    }
    
    function step3()
    {
    	if($siteinfo = $this->i->get('siteinfo'))
    	{
    		$this->view->assign($siteinfo);
    	}else{
    		$this->view->assign(array(
    			'seotitle'	=> 'CmsTop内容管理系统',
    			'username'	=> 'cmstop',
    			'password'  => '123456',
    			'email'     => 'admin@cmstop.com',
    			'authkey'	=> $this->authkey(),
    		));
    	}
    	$this->view->display('step3');
    }
    
    function authkey()
    {
    	$keys = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
		$max = count($keys) - 1;
		$authkey = '';
		for($i = 0; $i < 24; $i++)
		{
			$authkey .= $keys[mt_rand(0, $max)];
		}
		if($_SERVER['HTTP_X_REQUESTED_WITH'])
		{
			echo $authkey;
		}
		else
		{
			return $authkey;
		}
    }
    
    function siteinfo()
    {
    	if(!$_POST)
    	{
    		exit('0');
    	}
    	$this->i->set('siteinfo', $_POST);
    	echo 1;
    }
    
    function step4()
    {
    	if(is_array($appArray = $this->i->get('apps')))
    	{
    		$selected = $appArray;
    	}
    	$apps = include 'apps.php';
    	foreach ($apps AS $v)
    	{
    		$v['description'] || $v['description'] = $v['name'];
    		if(isset($selected) && !in_array($v['app'], $selected))
    		{
    			$v['selected'] = '';
    		}
    		else 
    		{
    			$v['selected'] = ' checked';
    		}
    		if($v['is_core'])
    		{
    			$core[] = $v;
    		}
    		else if($v['is_model'])
    		{
    			$model[] = $v;
    		}
    		else 
    		{
    			$app[] = $v;
    		}
    	}
    	
    	$this->view->assign('core', $core);
    	$this->view->assign('model', $model);
    	$this->view->assign('app', $app);
    	$this->view->display('step4');
    }
    
    function apps()
    {
    	$_POST['apps'] || $_POST['apps'] = array();
    	$this->i->set('apps', $_POST['apps']);
    	echo 1;
    }
    
    function step5()
    {
    	$this->view->display('step5');
    }
    
    // step5的iframe
    function install()
    {
    	ob_end_flush();
		ini_set('output_buffering', 0);
		$rs = $this->i->install();
		if($rs !== true)
		{
			$this->view->assign('error', 1);
		}
		else
		{
			$siteinfo = $this->i->get('siteinfo');
			$this->view->assign(array(
	    		'username' => $siteinfo['username'],
	    		'password' => $siteinfo['password'],
	    		'url'	 	=> WWW_URL.'admin/',
	    	));
	    	$this->i->finish();
		}
		$this->view->display('install');
    }
}