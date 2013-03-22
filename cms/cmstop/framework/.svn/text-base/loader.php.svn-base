<?php
defined('DS') or define('DS', '/');
define('APPS_DIR', CMSTOP_PATH.'apps/');

class loader
{
	private static $app, $app_path, $paths = array(), $classes = array(), $instances = array();
	
	static function set_app($app)
	{
		self::$app = $app;
		self::$app_path = APPS_DIR.$app.DS;
	}
	
	static function import($filepath, $base = null, $key = null)
	{
		$keypath = $key ? $key.$filepath : $filepath;
		
		if (!isset(self::$paths[$keypath]))
		{
			if (is_null($base)) $base = FW_PATH;
			$parts = explode('.', $filepath);
			$classname = array_pop($parts);
			$path  = str_replace('.', DS, $filepath);
			self::$paths[$keypath] = include $base.$path.'.php';	
		}
		return self::$paths[$keypath];
	}

	static function register($class = null, $file = null)
	{
		if($class && is_file($file))
		{
			$class = strtolower($class);
			self::$classes[$class] = $file;
		}
	}

	static function load($class)
	{
		$class = strtolower($class);
		if(class_exists($class)) return;
		return isset(self::$classes[$class]) ? include(self::$classes[$class]) : false;
	}
	
	static function controller($controller, $app = null)
	{
		if (!is_null($app)) self::set_app($app);
		return self::_load_class($controller, 'controller');
	}
	
	static function model($model, $app = null)
	{
        return self::_load_class($model, 'model', $app);
	}
	
	static function helper($helper, $app = null)
	{
		return self::_load_class($helper, 'helper', $app);
	}
	
	static function lib($lib, $app = null)
	{
		return self::_load_class($lib, 'lib', $app);
	}
	
	static function _load($path, $dir = 'view')
	{
		return include(self::_file($path, $dir));
	}
	
	static function &_load_class($path, $dir = 'model', $app = null)
	{
		$key = $dir.$path;
		if (!isset(self::$instances[$key]))
		{
			$class = (in_array($dir, array('controller', 'model')) ? $dir.'_' : '').str_replace('/', '_', $path);
			require(self::_file($path, $dir, $app));
			self::$instances[$key] = new $class;
			if (self::$instances[$key] instanceof SplSubject)
			{
				$plugin_dir = (is_null($app) ? self::$app_path : APPS_DIR.$app.DS).'plugin'.DS.$class.DS;
				self::$instances[$key]->attach(new observer($plugin_dir));
			}
		}
		return self::$instances[$key];
	}
	
	static function _file($path, $dir = 'view', $app = null)
	{
		$app_path = is_null($app) ? self::$app_path : APPS_DIR.$app.DS;
		$file = $app_path.$dir.DS.$path.'.php';
		if (!file_exists($file)) throw new ct_exception("file $file is not exists");
		return $file;
	}
}


function __autoload($class)
{
	return loader::load($class);
}

function import($path)
{
	return loader::import($path);
}