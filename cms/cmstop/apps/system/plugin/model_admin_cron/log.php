<?php

class plugin_log extends object 
{
	private $model;
	private $log;
	
	public function __construct(& $model)
	{
		$this->model = $model;
		$this->log = loader::model('admin/cron_log', 'system');
	}
	
	//添加日志$this->model->runRs可能是true/string或array('state'=>true,'info'=>string)形式
	public function after_interval()
	{
		$data = array('cronid'=>$this->model->cronid,'runtime'=>TIME);
		$rs = & $this->model->runRs;
		if($this->model->updateSuccess)
		{
			$data['success'] = 1;
		}
		else
		{
			$data['success'] = 0;
			$data['error'] = $this->model->error().'任务数据:'.var_export($task, 1);
		}
		
		if($rs === true || $rs['state'])
		{
			$data['runSuccess'] = 1;
		}
		else
		{
			$data['runSuccess'] = 0;
		}
		if($rs['info']) $data['info'] = $rs['info'];
		if($rs['message']) $data['info'] = $rs['message'];
		$this->log->insert($data);
	}
	
	//删除任务后附带删除日志
	public function after_delete()
	{
		$where = $this->model->where;
		if(is_int($where))
		{
			$where = "cronid = $where";
		}
		else
		{
			!is_array($where) || $where = implode(',', $where);
			$where = "cronid IN ($where)";
		}
		$this->log->delete($where);
	}
}