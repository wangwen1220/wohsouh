<?php
class plugin_section extends object 
{
	private $vote;
	
	public function __construct(& $vote)
	{
		$this->vote = $vote;
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
		if($action == 'add' && empty($_POST['sectionids'])) return true;
	
		$section = loader::model('section', 'section');
		$rs = $section->saveCommend($this->vote->contentid, $_POST['sectionids'], 'vote');
		if(!$rs) echo $section->error();
	}
}