<?php
class BCLogger
{
	function __construct(){}
	function __destruct(){}
	
	public function LogBusiness($time_start, $task, $serialNo, $param, $result, $retries, $step, $errcode, $msg)
	{
		$usetime = round(($this->MicrotimeFloat() - $time_start)*1000,2); 
		
		if ($task != 'notify' && $task != 'getIndexResult') {
			$in = implode('	',array(date('Y-m-d H:i:s'),$serialNo,$param['appType'],$param['class'],$param['textId'],$result,$retries,$usetime,$step,$errcode,($result != '0')?$msg:'ok'));
		}else {
			$in = implode('	',array(date('Y-m-d H:i:s'),$serialNo,$param['appType'],$result,$retries,$usetime,$step,$errcode,($result != '0')?$msg:'ok'));
		}
		$this->createFolders(HL_LPATH);
		$fp = fopen(HL_LPATH.$task.date('Ymd').'.txt','a+b');
		fwrite($fp,$in."\n");
		fclose($fp);
		
		if (HL_DEBUG) {
			$this->LogDEBUG($time_start, $task, $serialNo, $param, $result, $retries, $step, $errcode, $msg);
		}
	}
	
	public function LogDEBUG($time_start, $task, $serialNo, $param, $result, $retries, $step, $errcode, $msg)
	{
		$usetime = round(($this->MicrotimeFloat() - $time_start)*1000,2); 
		if ($task != 'notify' && $task != 'getIndexResult') {
			$in = implode('	',array(date('Y-m-d H:i:s'),$serialNo,$task,$param['appType'],$param['class'],$param['textId'],$result,$retries,$usetime,$step,$errcode,$msg));
		}else {
			$in = implode('	',array(date('Y-m-d H:i:s'),$serialNo,$task,$param['appType'],'ignore','ignore',$result,$retries,$usetime,$step,$errcode,$msg));
		}
		$this->createFolders(HL_LPATH);
		$fp = fopen(HL_LPATH.'debug'.date('Ymd').'.txt','a+b');
		fwrite($fp,$in."\n");
		fclose($fp);
	}
	
	private function MicrotimeFloat()
	{
	    list($usec, $sec) = explode(" ", microtime());
	    return ((float)$usec + (float)$sec);
	}
	
	private function createFolders($path)   
  	{   
    //递归创建   
	    if (!file_exists($path)&&$path!='')//如果文件夹不存在   
	    {   
	        $this->createFolders(dirname($path));//取得最后一个文件夹的全路径返回开始的地方   
	        mkdir($path, 0777);   
	    }   
	}  
}