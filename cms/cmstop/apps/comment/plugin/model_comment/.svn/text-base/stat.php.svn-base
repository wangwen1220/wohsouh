<?php

class plugin_stat extends object 
{
	private $comment;
	
	public function __construct(& $comment)
	{
		$this->comment = $comment;
	}
	
	public function after_add()
	{
		if ($this->comment->data['disabled'] == 0)
		{
			$contentid = $this->comment->data['contentid'];
			$c = table('content', $contentid);
			if (!$c)
			{
				$this->error = '内容不存在';
				return false;
			}
			
			$db = & factory::db();
			
			//更新内容表
			$result = $db->update("UPDATE `#table_content` SET `comments`=`comments`+1 WHERE `contentid`=?", array($contentid));
			if (!$result)
			{
				$this->error = '更新内容表失败';
				return false;
			}
			
			//更新会员表
			if ($this->comment->_userid)
			{
				$result = $db->update("UPDATE `#table_member` SET `comments`=`comments`+1 WHERE userid=?", array($this->comment->_userid));
				if (!$result)
				{
					$this->error = '更新会员表失败';
					return false;
				}
			}
			//更新专栏的
			if ($c['spaceid'])
			{
				$result = $db->update("UPDATE `#table_space` SET comments=comments+1 WHERE `spaceid`=?", array($c['spaceid']));
				if (!$result)
				{
					$this->error = '更新专栏表失败';
					return false;
				}
			}
			
			//更新cache
			$cache = & factory::cache();
			$pv = $cache->get('pv');
			$pv[$contentid]['comments']++;
			$cache->set('pv', $pv);
		}
	}
}