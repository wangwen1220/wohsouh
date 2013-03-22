<?php

class plugin_tags extends object 
{
	private $content;
	
	public function __construct(& $content)
	{
		$this->content = $content;
	}
	
	public function after_add()
	{
		$this->tags();
	}
	
	public function after_edit()
	{
		$this->tags();
	}
	
	public function after_get()
	{
		$this->output($this->content->data);
	}
	
	private function tags()
	{
		$this->content->data['tags'] = trim($this->content->data['tags']);
		if ($_GET['action'] == 'add' && empty($this->content->data['tags'])) return false;
		
		$tagids = loader::model('admin/tag', 'system')->update($this->content->data['tags']);
		if ($tagids)
		{
			$this->content->data['tags'] = loader::model('admin/content_tag', 'system')->update($this->content->contentid, $tagids);
		}
	}
	
	private function output(& $r)
	{
		if (isset($r['tags']) && $r['tags'])
		{
			$uri = loader::lib('uri', 'system');
			if ($this->content->action == 'show')
			{
				$tags = explode(' ', $r['tags']);
				foreach ($tags as $k=>$tag)
				{
					$tags[$k] = array('tag'=>$tag, 'url'=>$uri->tag($tag));
				}
				$r['keywords'] = $tags;
			}
			elseif ($this->content->action == 'view')
			{
				$html = '';
				$tags = explode(' ', $r['tags']);
				foreach ($tags as $tag)
				{
					$html .= '<a href="'.$uri->tag($tag).'" target="_blank">'.$tag.'</a> ';
				}
				$r['tags_view'] = $html;
			}
		}
	}
}