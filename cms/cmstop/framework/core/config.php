<?php
define('CONFIG_PATH', CMSTOP_PATH.'config/');

class config
{
	private static $_file = null, $_config = array();

	public static function set_file($file)
	{
		if (!preg_match("/^[0-9a-z_\-]+$/i", $file)) throw new ct_exception("$file is not valid");
		self::$_file = CONFIG_PATH.$file.'.php';
	}
	
	public static function load($file)
	{
		if (!isset(self::$_config[$file])) 
		{
			self::set_file($file);
			$config = @include(self::$_file);
			if ($config)
			{
				self::$_config[$file] = $config;
			}
			else
			{
				throw new ct_exception(self::$_file." is not exists");
			}
		}
		return self::$_config[$file];
	}
	
	public static function get($file, $key = null, $default = null)
	{
		$config = self::load($file);
		return is_null($key) ? $config : (isset($config[$key]) ? $config[$key] : $default);
	}
	
	public static function set($file, $data = array())
	{
		$config = self::load($file);
		$config = array_merge($config, $data);
		return self::_write(self::$_file, $config);
	}

	public static function create($file, $data = array())
	{
		self::set_file($file);
		return self::_write(self::$_file, $data);
	}
	
    private static function _write($file, $array = array())
    {
    	$data = "<?php\nreturn ".var_export($array, true).';';
    	if (!@file_put_contents($file, $data)) throw new ct_exception("$file is not exists or not writable");
    	return true;
    }
    
    private static function _set_cache()
    {
    	$config = array();
    	$files = glob(CONFIG_PATH.'*.php');
    	foreach ($files as $path)
    	{
    		$file = basename($path, '.php');
    		$config[$file] = require($path);
    	}
    	$cache = & factory::cache();
    	$cache->set('config', $config);
    	return $config;
    }
    
    private static function _get_cache()
    {
    	$cache = & factory::cache();
    	return $cache->get('config');
    }
}