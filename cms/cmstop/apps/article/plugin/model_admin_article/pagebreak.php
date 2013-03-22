<?php

class plugin_pagebreak extends object 
{
	private $article;
	
	public function __construct(& $article)
	{
		$this->article = $article;
	}
	
	public function before_add()
	{
		$this->pagecount();
	}

	public function before_edit()
	{
		$this->pagecount();
	}
	
	public function after_get()
	{
		if ($this->article->action == 'show' && $this->article->data['pagecount'] > 0)
		{
			$this->article->data['pages'] = $this->pages($this->article->contentid, $this->article->data['title'], $this->article->data['content']);
		}
	}
	
	private function pagecount()
	{
		$this->article->data['pagecount'] = 0;
		if (strpos($this->article->data['content'], 'PageBreak') !== false)
		{
			$this->article->data['pagecount'] = strpos($this->article->data['content'], '<p class="mcePageBreak">&nbsp;</p>') === false ? preg_match_all("/<p class\=\"mcePageBreak\">(.*?)<\/p>/", $this->article->data['content'], $matches) : substr_count($this->article->data['content'], '<p class="mcePageBreak">&nbsp;</p>');
		}
	}
	
	private function pages($contentid, $title, $content)
	{
		$uri = loader::lib('uri', 'system');
		$pages = array();
		if (strpos($content, '<p class="mcePageBreak">&nbsp;</p>') === false)
		{
			$pagecount = preg_match_all("/<p class\=\"mcePageBreak\">(.*?)<\/p>/", $content, $matches);
			$contents = explode('[page]', preg_replace("/<p class\=\"mcePageBreak\">(.*?)<\/p>/", '[page]', $content));
			$hastitles = 1;
			$titles = & $matches[1];
			$titles[0] = $title;
		}
		else 
		{
			$pagecount = substr_count($content, '<p class="mcePageBreak">&nbsp;</p>');
			$contents = explode('<p class="mcePageBreak">&nbsp;</p>', $content);
			$hastitles = 0;
		}
		
		for ($page = 1; $page <= $pagecount; $page++)
		{
			$prevpage = $page == 1 ? '' : $page-1;
			$nextpage = $page == $pagecount ? '' : $page+1;
			$u = $uri->content($contentid, $page);
			$pages[$page] = array('hastitles'=>$hastitles, 'content'=>$contents[$page], 'path'=>$u['path'], 'url'=>$u['url'], 'prevpage'=>$prevpage, 'nextpage'=>$nextpage);
			if ($hastitles) $pages[$page]['title'] = $titles[$page-1];
		}
		return $pages;
	}
}