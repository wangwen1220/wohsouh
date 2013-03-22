<?php
class plugin_pv extends object 
{
	private $content, $cache;
	
	public function __construct(& $content)
	{
		$this->content = $content;
		$this->cache = & factory::cache();
	}
	
	public function after_get()
	{
		$contentid = $this->content->contentid;
		$pv = $this->cache->get('pv');
		if(isset($pv[$contentid]))
		{
			$this->content->data['pv'] = $pv[$contentid][2];
		}
	}
	
	public function after_ls()
	{
		$pv = $this->cache->get('pv');
		foreach ($this->content->data AS & $v)
		{
			if(isset($pv[$v['contentid']]))
			{
				$v['pv'] = $pv[$v['contentid']][2];
			}
		}
	}
}