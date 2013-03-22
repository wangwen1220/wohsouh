<?php

class cookie extends object 
{
	private $prefix = '';
	private $path = '/';
	private $domain = '';
	
	function __construct($prefix = 'cmstop_', $path = '/', $domain = '')
	{
		$this->prefix = $prefix;
		$this->path = $path;
		$this->domain = $domain;
	}
	
	function set($var, $value = null, $time = 0)
	{
		if (is_null($value)) $time = time() - 3600;
		elseif ($time > 0 && $time < 31536000) $time += time();
		$s = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0;
		$var = $this->prefix.$var;
		$_COOKIE[$var] = $value;
		if(is_array($value))
		{
			foreach($value as $k=>$v)
			{
				setcookie($var.'['.$k.']', $v, $time, $this->path, $this->domain, $s);
			}
		}
		else
		{
			setcookie($var, $value, $time, $this->path, $this->domain, $s);
		}
	}
	
    function get($var)
    {
    	$var = $this->prefix.$var;
    	return isset($_COOKIE[$var]) ? $_COOKIE[$var] : false;
    }
}