<?php

class plugin_parsevideo extends object 
{
	private $video,$template;
	
	public function __construct(& $video)
	{
		$this->video = $video;
		$this->template = factory::template();
	}
	public function after_get()
	{
		$this->parsevideo();
	}
	public function after_ls()
	{
		$this->parsevideo();
	}
	private function parsevideo()
	{
		$autostart = $this->video->is_backend?'false':'true';
		$this->template->assign('src',$this->video->data['video']);
		$this->template->assign('autostart',$autostart);	
		if(substr($this->video->data['video'],-4)=='.swf')
		{
			$this->video->data['video'] = $this->template->fetch('video/player/flash.html');
		}
		elseif(substr($this->video->data['video'],-4)=='.flv')
		{
			$this->video->data['video'] = $this->template->fetch('video/player/flv.html');
		}
		elseif (substr($this->video->data['video'],-3)=='.rm'||substr($this->video->data['video'],-5)=='.rmvb')
		{
			$this->video->data['video'] = $this->template->fetch('video/player/rmrmvb.html');
		}
		elseif(substr($this->video->data['video'],-4)=='.wmv' ||substr($this->video->data['video'],-4)=='.avi')
		{
			$this->video->data['video'] = $this->template->fetch('video/player/wmv.html');
		}
		elseif (preg_match('/^(\[cc\])([^\[]+)(\[\/cc\])$/i',$this->video->data['video'],$matches))
		{
			$this->template->assign('src',$matches[2]);
			$this->video->data['video'] = $this->template->fetch('video/player/cc.html');
		}
		else 
		{
			$this->video->data['video'] = $this->template->fetch('video/player/flash.html');
		}
	}


}