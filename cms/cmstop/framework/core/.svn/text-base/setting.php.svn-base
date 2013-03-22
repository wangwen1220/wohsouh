<?php
define('SETTING_PATH', CACHE_PATH.'setting'.DS);

class setting extends object 
{
	private $db, $table;
	private static $objInstance; 
	function __construct()
	{
		$this->db = & factory::db();
		$this->table = '#table_setting';
	}
	
	static function getInstance() {
		if(!self::$objInstance){
			$objInstance = new setting();
		}
		return $objInstance;
	}

	static function get($app, $var = null)
	{
		static $settings;
		if (!isset($settings[$app]))
		{
			$path = self::_cache_file($app);
			if(!file_exists($path))
			{
				self::getInstance()->cache($app);
			}
			$settings[$app] = include($path);
		}
		return is_null($var) ? $settings[$app] : (isset($settings[$app][$var]) ? $settings[$app][$var] : null);
	}
	
	function set($app, $var, $value)
	{
		if (is_array($value)) $value = var_export($value, true);
		$db = $this->db->prepare("REPLACE INTO `$this->table`(`app`, `var`, `value`) VALUES(?,?,?)");
		return $db->execute(array($app, $var, $value));
	}
	
    function set_array($app, $data)
    {
    	if (!is_array($data)) return false;
    	array_map(array($this, 'set'), array_fill(0, count($data), $app), array_keys($data), $data);
    	$this->cache($app);
    	return true;
    }
	
	function cache($app = null)
	{
		if (is_null($app))
		{
			$db_cache = & factory::db_cache();
			$arrapp = $db_cache->get('app');
			$apps = array_keys($arrapp);
			return array_map(array($this, 'cache'), $apps);
		}
		else 
		{
			$setting = array();
		    $data = $this->db->select("SELECT `var`,`value` FROM `$this->table` WHERE `app`=?", array($app));
		    foreach ($data as $r)
		    {
		    	if (substr($r['value'], 0, 5) === 'array')
		    	{
		    		eval("\$value = {$r['value']};");
		    	    $setting[$r['var']] = $value;
		    	}
		    	else 
		    	{
		    		$setting[$r['var']] = $r['value'];
		    	}
		    }
            self::_write($app, $setting);
		}
	}
	
	private static function _cache_file($app)
	{
		return SETTING_PATH.$app.'.php';
	}
	
	private static function _write($app, $setting)
	{
		if (!is_dir(SETTING_PATH))
		{
			import('helper.folder');
			folder::create(SETTING_PATH);
		}
		$setting = "<?php\nreturn ".var_export($setting, true).';';
		return file_put_contents(self::_cache_file($app), $setting);
	}
}