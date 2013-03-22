<?php
class plugin_section extends object 
{
	private $article;
	
	public function __construct(& $article)
	{
		$this->article = $article;
	}
	
	public function after_add()
	{
		$this->section('add');
	}
	
	public function after_edit()
	{
		$this->section('edit');
	}
	
	private function section($action)
	{
		//添加时，无ids不改
		if($action=='add' && empty($_POST['sectionids'])) return true;
	
		$section = loader::model('section', 'section');
		$rs = $section->saveCommend($this->article->contentid, $_POST['sectionids'], 'article');
		if(!$rs) echo $section->error();
	}
}