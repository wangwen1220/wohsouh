<?php
class plugin_section extends object 
{
	private $activity;
	
	public function __construct(& $activity)
	{
		$this->activity = $activity;
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
		$rs = $section->saveCommend($this->activity->contentid, $_POST['sectionids'], 'activity');
		if(!$rs) echo $section->error();
	}
}