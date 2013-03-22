<?php

abstract class controller extends object 
{	
	function __construct()
	{
		parent::__construct();
	}

	public static function is_get()
	{
		return $_SERVER['REQUEST_METHOD'] == 'GET';
	}
	
	public static function is_post()
	{
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}
	
	function is_head()
	{
		return $_SERVER['REQUEST_METHOD'] == 'HEAD';
	}
	
	public static function is_put()
	{
		return $_SERVER['REQUEST_METHOD'] == 'PUT';
	}
	
	public static function is_delete()
	{
		return $_SERVER['REQUEST_METHOD'] == 'DELETE';
	}
	
	public static function is_ajax()
	{
		return $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
	}
	
	public static function set_token()
	{
		$_SESSION['token'] = md5(microtime(true));
	}
	
	public static function valid_token()
	{
		$return = $_REQUEST['token'] === $_SESSION['token'] ? true : false;
		self::set_token();
		return $return;
	}
	
	public function forward($app, $controller, $action, $args = array())
	{
		return $this->app->execute($app, $controller, $action, $args);
	}
	
	protected function redirect($url)
	{
		header("location:$url");
	}

    protected function action_exists($action)
    {
        return (substr($action, 0, 1) !== '_' && method_exists($this, $action)) || method_exists($this, '__call');
    }
	
    function showmessage($message, $url = null, $ms = 2000, $success = false)
	{
		if ($this->app->client === 'admin')
		{
			$handler = $this->view;
			$template = 'showmessage';
		}
		else 
		{
			$handler = $this->template;
			$template = 'system/showmessage.html';
		}
		if (is_array($message)) $message = implode('<br />', $message);
		$handler->assign('message', $message);
		$handler->assign('url', $url);
		$handler->assign('ms', $ms);
		$handler->assign('success', $success);
		$handler->display($template, 'system');
		exit;
	}
	
	protected function encode($state, $info='')
	{
		if($state) exit($this->json->encode(array('state' => true, 'message' => $info)));
		exit($this->json->encode(array('state' => false, 'error' => $info)));
	}
	
	function privar($key, $value = null)
	{
		static $privar;
				
		if (!$this->_userid) return false;
		if (is_null($privar)) $privar = cache_read('privar/'.$this->_userid.'.php');
		if (is_null($value))
		{
			return $privar && isset($privar[$key]) ? $privar[$key] : false;
		}
		else 
		{
			if ($privar)
			{
				$privar[$key] = $value;
			}
			else
			{
				$privar = array($key=>$value);
			}
			return cache_write('privar/'.$this->_userid.'.php', $privar);
		}
	}
}