<?php

class template extends view 
{
	public $app,
	       $name,
	       $compile_dir, 
	       $compile_file,
	       $compile_force = false, 
	       $compile_check = true;

	protected 
	       $funcs = null,
	       $tags = null,
	       $rules = array(
						'/([\n\r]+)\t+/s' => '$1',
						'/\<\!\-\-#.+?#\-\-\>/s' => '',
						'/\<\!\-\-\{(.+?)\}\-\-\>/s' => '{$1}',
						'/\{template\s+(.+)\}/' => '<?php $this->display($1); ?>',
						'/\{if\s+(.+?)\}/' => '<?php if($1) { ?>',
						'/\{else\}/' => '<?php } else { ?>',
						'/\{elseif\s+(.+?)\}/' => '<?php } elseif ($1) { ?>',
						'/\{\/if\}/' => '<?php } ?>',
						'/\{loop\s+(\S+)\s+(\S+)\}/' => '<?php if(is_array($1)) foreach($1 as $2) { ?>',
						'/\{loop\s+(\S+)\s+(\S+)\s+(\S+)\}/' => '<?php if(is_array($1)) foreach($1 as $2 => $3) { ?>',
						'/\{\/loop\}/' => '<?php } ?>',
						'/\{(\((.*?)\))\}/' => '<?php echo $1;?>',
						'/\{(\\$[a-zA-Z0-9_\[\]\'\"\$\x7f-\xff]+)\}/es' => 'self::_addquote(\'<?php echo $1;?>\')',
						'/\{([0-9a-zA-Z_]+)\((.+?)\)->([0-9a-zA-Z_]+)\}/' => '<?php echo table(\'$1\', $2, \'$3\');?>',
						'/\{([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff:]*\(.*?\))\}/' => '<?php echo $1;?>',
						'/\{([A-Z_\x7f-\xff][A-Z0-9_\x7f-\xff]*)\}/s' => '<?php echo $1;?>',
						);
	       
    function __construct($config = null)
    {
        parent::__construct($config);
        if (!defined('TEMPLATE')) define('TEMPLATE', $this->name);
        $this->dir .= $this->name.DS;
		$this->set_rule('/\{\/('.$this->tags.')\}/', '<?php } unset(\$_$1); ?>');
		$this->set_rule('/\{('.$this->tags.')(\s+[^}]+?)(\/?)\}/e', 'self::_tag_parse(\'$1\', \'$2\', \'$3\')');
    }

	public function set_rule($pattern, $replacement)
	{
		$this->rules[$pattern] = $replacement;
	}
    
	public function set_view($view, $app = null)
    {
    	if (is_null($app)) $app = $this->app;
    	$this->file = $this->dir.$view;
		$view = str_replace(array(':','*','?','"','<','>','|'), '-', $view);
    	$this->compile_file = $this->compile_dir.str_replace(array('/', '\\'), ',', $view).'.php';
        return $this;
    }
    
	public function set_app($app)
    {
    	$this->app = $app;
        return $this;
    }
    
	public function dir_compile($dir = null)
	{
		if (is_null($dir)) $dir = $this->dir;
		$files = glob($dir.'*');
		foreach ($files as $file)
		{
			if (is_dir($file))
			{
				$this->dir_compile($file);
			}
			else
			{
		        $this->_compile(substr($file, strlen($this->dir)));
			}
		}
	}
	
	public function clear_compile()
	{
		$files = glob($this->compile_dir.'*');
		foreach ($files as $file)
		{
			if (is_file($file)) @unlink($file);
		}
	}
	
    protected function _file()
    {
		if ($this->compile_force || ($this->compile_check && (!file_exists($this->compile_file) || @filemtime($this->file) > @filemtime($this->compile_file))))
		{
			$this->_compile();
		}
		return $this->compile_file;
    }
    
    protected function _compile($view = null)
    {
    	if ($view) $this->set_view($view);
    	$data = file_get_contents($this->file);
    	if ($data === false) return false;
    	$data = $this->_parse($data);
    	
    	if (false === @file_put_contents($this->compile_file, $data)) throw new ct_Exception("$this->compile_file file is not writable");
    	@chmod($this->compile_file, 0774);
    	return true;
    }
    
	private function _parse($string)
	{
		return preg_replace(array_keys($this->rules), $this->rules, $string);
	}
	
	private static function _addquote($var)
	{
		return str_replace('\\"', '"', preg_replace('/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\]/s', '["\1"]', $var));
	}

	private static function _tag_parse($tag, $str, $end)
	{
		$return = 'r';
		$array = '';
		preg_match_all('/\s+([a-z_]+)\s*\=\s*([\"\'])(.*?)\2/i', stripslashes($str), $matches, PREG_SET_ORDER);
		foreach($matches as $k=>$v)
		{
			if ($v[1] == 'return')
			{
				$return = $v[3];
				continue;
			}
			$array .= ($k ? ',' : '')."'".$v[1]."'".' => '.$v[2].$v[3].$v[2];
		}
		$string = '<?php'."\n\$_$tag = tag_$tag(array($array));\n";
		$string .= $end ? ("$$return = & \$_$tag;\n".'?>') : ("if(isset(\$_{$tag}['total'])){ extract(\$_$tag); \$_$tag = \$data;}\nforeach(\$_$tag as \$i=>\$$return){\$i++;\n".'?>');
		return $string;
	}
}