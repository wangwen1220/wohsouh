<?php

class plugin_workflow extends object
{
	private $content;
	
	public function __construct(& $content)
	{
		$this->content = $content;
	}
	
	public function before_add()
	{
		if ($this->content->data['status'] == 3 && $this->content->category[$this->content->data['catid']]['workflowid'])
		{
			$this->content->data['workflow_step'] = 1;
			$this->content->data['workflow_roleid'] = loader::model('admin/workflow_step', 'system')->roleid($this->content->category[$this->content->data['catid']]['workflowid'], 1);
		}
	}
	
	public function before_approve()
	{
		$workflowid = $this->content->category[$this->content->data['catid']]['workflowid'];
		if ($workflowid)
		{
			$workflow_roleid = loader::model('admin/workflow_step', 'system')->roleid($workflowid, 1);
			$this->content->approve = array('status'=>3, 'checked'=>null, 'checkedby'=>null, 'published'=>null, 'publishedby'=>null, 'workflow_step'=>1, 'workflow_roleid'=>$workflow_roleid);
		}
	}
	
	public function before_pass()
	{
		$workflowid = $this->content->category[$this->content->data['catid']]['workflowid'];
		if ($workflowid)
		{
			if ($this->content->data['workflow_step'] == table('workflow', $workflowid, 'steps'))
			{
				$this->content->workflow_step = null;
				$this->content->pass = array('status'=>6, 'checked'=>TIME, 'checkedby'=>$this->content->_userid, 'published'=>TIME, 'publishedby'=>$this->content->_userid, 'workflow_step'=>null, 'workflow_roleid'=>null);
			}
			else
			{
				$this->content->workflow_step = $this->content->data['workflow_step']+1;
				$workflow_roleid = loader::model('admin/workflow_step', 'system')->roleid($workflowid, $this->content->workflow_step);
				$this->content->pass = array('status'=>3, 'checked'=>TIME, 'checkedby'=>$this->content->_userid, 'workflow_step'=>$this->content->workflow_step, 'workflow_roleid'=>$workflow_roleid);
			}
		}
	}
	
	public function after_pass()
	{
		loader::model('admin/workflow_log', 'system')->add($this->content->contentid, 'pass', $this->content->data['workflow_step'], $this->content->workflow_step);
	}
	
	public function before_reject()
	{
		$workflowid = $this->content->category[$this->content->data['catid']]['workflowid'];
		if ($workflowid)
		{
			if ($this->content->data['workflow_step'] == 1)
			{
				$this->content->workflow_step = null;
				$this->content->reject = array('status'=>2, 'workflow_step'=>null, 'workflow_roleid'=>null);
			}
			else 
			{
				$this->content->workflow_step = $this->content->data['workflow_step']-1;
				$workflow_roleid = loader::model('admin/workflow_step', 'system')->roleid($workflowid, $this->content->workflow_step);
				$this->content->reject = array('status'=>2, 'workflow_step'=>$this->content->workflow_step, 'workflow_roleid'=>$workflow_roleid);
			}
		}
	}

	public function after_reject()
	{
		loader::model('admin/workflow_log', 'system')->add($this->content->contentid, 'reject', $this->content->data['workflow_step'], $this->content->workflow_step);
	}
}