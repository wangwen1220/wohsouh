<?php

class plugin_stat extends object 
{
	private $comment, $db;
	
	public function __construct(& $comment)
	{
		$this->comment = $comment;
		$this->db = & factory::db();
	}
	
	public function after_check()
	{
		$this->update($this->comment->ids);
	}
	
	//删除前先设为禁用，再刷新统计值
	public function before_delete()
	{
		$ids = $this->comment->ids;
		$sql = "UPDATE #table_comment SET disabled = 1 WHERE commentid IN ($ids)";
		$this->db->update($sql);
		$this->update($ids);
	}
	
	/**
	 * 评论审核通过
	 * @param  mix $ids 是单id或数组，或者多id字符串
	 */
	private function update($ids)
	{
		$sql = "SELECT createdby AS userid, contentid FROM #table_comment WHERE commentid IN ($ids)";
		$data = $this->db->select($sql);
		foreach ($data AS $v)
		{
			$userids[$v['userid']]++;
			$contentids[$v['contentid']]++;
		}
		//1.修改内容表
		if($contentids)
		{
			$contentids = array_keys($contentids);
			$contentids = implode(',', $contentids);
			$sql = "SELECT contentid, COUNT(*) AS comments FROM #table_comment WHERE disabled = 0 AND contentid IN ($contentids) GROUP BY contentid";
			$data = $this->db->select($sql);
			foreach ($data AS $v)
			{
				$cid = intval($v['contentid']);
				$comments = intval($v['comments']);
				$this->db->exec("UPDATE #table_content SET comments = $comments WHERE contentid = $cid");
			}
			//2.更新cache
			$this->updateCache($contentids);
		}
		//3.修改会员表、专栏表
		if($userids)
		{
			$userids = array_keys($userids);
			$userids = implode(',', $userids);
			$sql = "SELECT createdby AS userid, COUNT(*) AS comments FROM #table_comment WHERE disabled = 0 AND createdby IN ($userids) GROUP BY createdby";
			$data = $this->db->select($sql);
			foreach ($data AS $v)
			{
				$userid = intval($v['userid']);
				$comments = intval($v['comments']);
				$this->db->exec("UPDATE #table_member SET comments = $comments WHERE userid = $userid");
				$this->db->exec("UPDATE #table_space SET comments = $comments WHERE userid = $userid");
			}
		}
		return true;
	}
	
	//更新cache
	private function updateCache($contentids)
	{
		if(!is_array($contentids)) $contentids = explode(',', $contentids);
		$cache = & factory::cache();
		$pv = $cache->get('pv');
		if(!$pv) return ;
		foreach ($pv AS $cid => $item)
		{
			if(in_array($cid, $contentids))
			{
				$upCid[] = $cid;	//需要更新的contentid
			}
		}
		if(!$upCid) return ;
		$upCid = implode(',', $upCid);
		$sql = "SELECT COUNT(*) AS comments, contentid FROM #table_comment WHERE contentid IN ($upCid) AND disabled = 0 GROUP BY contentid";
		$data = $this->db->select($sql);
		foreach ($data AS $item)
		{
			$cid = intval($item['contentid']);
			if($pv[$cid]) $pv[$cid]['comments'] = intval($item['comments']);
		}
		$cache->set('pv', $pv);
	}
}