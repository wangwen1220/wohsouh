<?php

class plugin_source extends object 
{
	private $content;
	
	public function __construct(& $content)
	{
		$this->content = $content;
	}
	
	public function before_add()
	{
		$this->sourceid();
	}
	
	public function before_edit()
	{
		$this->sourceid();
	}

	public function before_ls()
	{
		if (isset($this->content->where['source']) && $this->content->where['source'])
		{
			$source = loader::model('admin/source', 'system')->get_by('name', $this->content->where['source'], 'sourceid');
			if ($source) $this->content->where['sourceid'] = $source['sourceid'];
		}
	}
	
	public function after_ls()
	{
		array_map(array($this, 'output'), & $this->content->data);
	}
	
	public function after_get()
	{
		$this->output($this->content->data);
	}
	
	private function sourceid()
	{
		//if (isset($this->content->data['source']) && $this->content->data['source'])
		//{
			$this->content->data['sourceid'] = loader::model('admin/source', 'system')->sourceid($this->content->data['source']);
		//}
	}
	
	private function output(& $r)
	{
		$r['source_url'] = '';
		$r['source_name'] = '';
		if (isset($r['sourceid']) && $r['sourceid'])
		{
			$source = table('source', $r['sourceid']);
			$r['source_url'] = $source['url'];
			$r['source_name'] = $r['source'] = $source['name'];
			$r['source_logo'] = $source['logo'];
		}
	}
}