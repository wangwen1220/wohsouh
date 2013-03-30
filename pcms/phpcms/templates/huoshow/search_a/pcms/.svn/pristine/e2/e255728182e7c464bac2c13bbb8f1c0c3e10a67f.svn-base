<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_sys_class('model', '', 0);
class position_data_model extends model {
	public $table_name = '';
	public function __construct() {
		$this->db_config = pc_base::load_config('database');
		$this->db_setting = 'default';
		$this->table_name = 'position_data';
		parent::__construct();
	}
	
	public function insert($data)
	{
		//插入数据
		parent::insert($data);
		//根据配置，删除多余的数据
		$posid = $data[posid];
		$sql = "SELECT maxnum FROM v9_position WHERE posid='$posid'";
		$max_num_arr = $this->sselect($sql);
		$max_num = $max_num_arr[0][maxnum];
		if($max_num>0)
		{
			$sql = "SELECT id FROM v9_position_data WHERE posid='$posid'
			ORDER BY listorder DESC LIMIT 0,$max_num";
			$tmp_arr = $this->sselect($sql);
			$tmp_str = '';
			for($i=0;$i<count($tmp_arr);$i++)
			{
				$tmp_str .= $tmp_arr[$i][id].',';
			}
			$tmp_str = trim($tmp_str,',');
				
			$sql = "DELETE FROM v9_position_data WHERE posid='$posid' and id NOT IN
			($tmp_str)";
			$this->sselect($sql);
		}
	}
}
?>