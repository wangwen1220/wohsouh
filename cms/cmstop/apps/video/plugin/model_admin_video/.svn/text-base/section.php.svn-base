<?php
class plugin_section extends object 
{
	private $video;
	
	public function __construct(& $video)
	{
		$this->video = $video;
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
		$rs = $section->saveCommend($this->video->contentid, $_POST['sectionids'], 'video');
		if(!$rs) echo $section->error();
	}
}