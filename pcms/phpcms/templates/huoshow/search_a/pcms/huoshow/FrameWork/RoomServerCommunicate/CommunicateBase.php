<?php

abstract class  CommunicateBase
{
	
	protected $m_cmd_body;
	protected $m_cmd_type;
	protected $m_cmd_post;//保存传递过来的所有POST参数
	public function __construct($cmd_type,$cmd_body,$cmd_post)
	{
		$this->m_cmd_type = $cmd_type;
		$this->m_cmd_body = $cmd_body;
		$this->m_cmd_post = $cmd_post;
		//$dblink = new DataBase("");	$dblink->query("insert into pre_z_test SET ttt='".$this->m_cmd_body."'");die();
		//if(empty($this->m_cmd_body))
		//	return false;
		//$this->cmd_type = $this->m_cmd_body->cmd_type;
		eval('$this->on_'.$this->m_cmd_type.'();');
	}

	abstract public function  on_inroom();
	abstract public function on_send_gift();
	abstract public function on_setup_manager();
	abstract public function on_logout();
	abstract public function on_top_michael();
	abstract public function on_server_start();
	abstract public function on_room_expire();
}

function log_h($msgl,$name="通知",$errlevel=0,$file=__FILE__,$line=__LINE__){
	$log_file = $_SERVER['DOCUMENT_ROOT']."/huoshow/test_log.txt";
	$msg = getLocalTimeStr(time())."\t$name\t".str_replace("\n", "", var_export($msgl,true))."\n";
	file_put_contents($log_file,$msg,FILE_APPEND);
	
}

/*
$obj->cmd_type = "inroom";
$obj_json = json_encode($obj);
$mutil_room = new MutilRoomCommunicate($obj_json);
*/

?>
