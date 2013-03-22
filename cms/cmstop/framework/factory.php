<?php
defined('RUN_CMSTOP') or exit('Access Denied');

class factory
{
	private static $objects;
	
	public static function &config()
	{
		if (!isset(self::$objects['config']))
		{
			import('core.config');
			self::$objects['config'] = new config();
		}
		return self::$objects['config'];
	}

	public static function &setting()
	{
		if (!isset(self::$objects['setting']))
		{
			import('core.setting');
			self::$objects['setting'] = new setting();
		}
		return self::$objects['setting'];
	}
	
	public static function &acl()
	{
		if (!isset(self::$objects['acl']))
		{
			import('acl.acl');
			$db = & factory::db();
			self::$objects['acl'] = new acl(array('db'=>$db, 'db_table_prefix'=>'cmstop_'));
		}
		return self::$objects['acl'];
	}
	
	public static function &cache()
	{
		if (!isset(self::$objects['cache']))
		{
			import('cache.cache');
			$config = config('cache');
            $config['path'] = CACHE_PATH;
			if ($config['storage'] == 'memcache') $config['memcache'] = config('memcache');
			self::$objects['cache'] = new cache($config);
		}
		return self::$objects['cache'];
	}

	public static function &db($config = 'db')
	{
		import('db.db');
		if (!is_array($config)) $config = config($config);
		return db::get_instance($config);
	}

	public static function &dbkv()
	{
		if (!isset(self::$objects['dbkv']))
		{
			import('dbkv.dbkv');
			$config = config('config');
			self::$objects['dbkv'] = new dbkv($config['dbkv_storage'], $config['dbkv_handler']);
		}
		return self::$objects['dbkv'];
	}
	
	public static function &db_cache()
	{
		if (!isset(self::$objects['db_cache']))
		{
			import('db.db_cache');
			self::$objects['db_cache'] = new db_cache(CACHE_PATH.'table'.DS);
		}
		return self::$objects['db_cache'];
	}

	public static function &log()
	{
		if (!isset(self::$objects['log']))
		{
			import('core.log');
			self::$objects['log'] = new log(config('log'));
		}
		return self::$objects['log'];
	}
	
	public static function &cookie()
	{
		if (!isset(self::$objects['cookie']))
		{
			import('core.cookie');
			$config = config('cookie');
			self::$objects['cookie'] = new cookie($config['prefix'], $config['path'], $config['domain']);
		}
		return self::$objects['cookie'];
	}
	
	public static function &session()
	{
		if (!isset(self::$objects['session']))
		{
			import('session.session');
			self::$objects['session'] = new session(config('session'));
		}
		return self::$objects['session'];
	}
	
	public static function &router()
	{
		if (!isset(self::$objects['router']))
		{
			import('core.router');
			$urlmode = config('config', 'urlmode');
			$router = config('router');
			self::$objects['router'] = new router($urlmode, $router);
		}
		return self::$objects['router'];
	}
	
	public static function &template($app = 'system')
	{
		if (!isset(self::$objects['template']))
		{
			import('core.view');
			import('core.template');
			$config = config('template');
			$config['app'] = $app;
			$config['dir'] = CMSTOP_PATH.'templates/';
			$config['compile_dir'] = CACHE_PATH.'templates/';
			self::$objects['template'] = new template($config);
		}
		return self::$objects['template'];
	}

	public static function &view($app = 'system')
	{
		if (!isset(self::$objects['view']))
		{
			import('core.view');
			self::$objects['view'] = new view(array('dir'=>CMSTOP_PATH.'apps'.DS.$app.DS.'view'.DS));
		}
		return self::$objects['view'];
	}
	
	public static function &form()
	{
		if (!isset(self::$objects['form']))
		{
			import('form.form');
			self::$objects['form'] = new form();
		}
		return self::$objects['form'];
	}
	
	public static function &element()
	{
		if (!isset(self::$objects['element']))
		{
			import('form.form_element');
			import('form.element');
			self::$objects['element'] = new element();
		}
		return self::$objects['element'];
	}
	
	public static function &validator()
	{
		if (!isset(self::$objects['validator']))
		{
			import('core.validator');
			self::$objects['validator'] = new validator();
		}
		return self::$objects['validator'];
	}
	
	public static function &json($charset = null)
	{
		if (!isset(self::$objects['json']))
		{
			import('helper.json');
			if (!$charset) $charset = config('config', 'charset');
			self::$objects['json'] = new json($charset);
		}
		return self::$objects['json'];
	}
	
	public static function &image()
	{
		if (!isset(self::$objects['image']))
		{
			$setting = setting('system');
			import('helper.image');
			self::$objects['image'] = new image();
			if ($setting['thumb_enabled'])
			{
				self::$objects['image']->set_thumb($setting['thumb_width'], $setting['thumb_height'], $setting['thumb_quality']);
			}
			if ($setting['watermark_enabled'])
			{
				$watermark = WATERMARK_DIR.'watermark.'.$setting['watermark_ext'];
				self::$objects['image']->set_watermark($watermark, $setting['watermark_minwidth'], $setting['watermark_minheight'], $setting['watermark_position'], $setting['watermark_trans'], $setting['watermark_quality']);
			}
		}
		return self::$objects['image'];
	}
	
	public static function &sendmail()
	{
		if (!isset(self::$objects['sendmail']))
		{
			$setting = setting('mail');
			import('helper.sendmail');
			self::$objects['sendmail'] = new sendmail($setting['mailer'], $setting['delimiter'], config('config', 'charset'), $setting['from'], $setting['sign'], $setting['smtp_host'], $setting['smtp_port'], $setting['smtp_auth'], $setting['smtp_username'], $setting['smtp_password']);
		}
		return self::$objects['sendmail'];
	}
}