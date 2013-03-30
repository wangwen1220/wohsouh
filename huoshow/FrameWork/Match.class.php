<?php

/**
 * 比赛操作类
 *
 * @author Administrator
 * @package defaultPackage
 */
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
class Match
{
	
	 /**
	  * 获得比赛类型
	  *
	  * @return unknown
	  */
	 static public function GetMatchType() {
		$dblink = new DataBase("");
		$matchtype = array();
		$matchtype = $dblink->getRow("SELECT Id,type_name FROM pre_match_type ORDER BY Id");
		$dblink->dbclose();
		return $matchtype;
	}
	
	/**
	 * 根据ID得到类型
	 *
	 * @param unknown_type $id
	 */
	static public function GetMatchTypeId($id) {
		$dblink = new DataBase("");
		$matchtypid = array();
		$matchtypid = $dblink->getRow("SELECT b.* FROM pre_match a LEFT JOIN pre_match_type b ON a.match_type= b.Id WHERE a.id=$id");
		$dblink->dbclose();
		return $matchtypid;
	}
	
	/*
	* 根据ID得到奖项设置
	*/
	static public function GetAwards($id) {
		$dblink = new DataBase("");
		$awards = array();
		$awards = $dblink->getRow("SELECT * FROM pre_match_awards WHERE match_id=$id");
		$dblink->dbclose();
		return $awards;
	}
	
	/**
	 * *获得组件
	 */
	static public function GetPlugin() {
		$dblink = new DataBase("");
		$plugin = array();
		$plugin = $dblink->getRow("SELECT * FROM pre_match_plugin ORDER BY id");
		$dblink->dbclose();
		return $plugin;
	}
	/**
	 * 根据ID得到组件名称
	 */
	static public function GetPluginName($id) {
		$dblink1 = new DataBase("");
		$plugin_name = array();
		$plugin_name = $dblink1->getRow("SELECT id,plugin_name FROM pre_match_plugin WHERE id = $id");
		$dblink1->dbclose();
		return $plugin_name;
	}
	
	/**
	 * 获得规则
	 */
	static public function GetRules() {
		$dblink = new DataBase("");
		$rules = array();
		$rules = $dblink->getRow("SELECT * FROM pre_match_regular_base ORDER BY id");
		$dblink->dbclose();
		return $rules;
	}
	
	/**
	 * 根据ID得到规则名称
	 */
	static public function GetRulesName($id) {
		$dblink = new DataBase("");
		$rules_name = array();
		$rules_name = $dblink->getRow("SELECT id,regular_descript FROM pre_match_regular_base WHERE id = $id");
		$dblink->dbclose();
		return $rules_name;
	}
	
	/**
	 * 验证名称是否存在
	 */
	static public function CheckingName($name){
		$dblink = new DataBase("");
		$check_name = array();
		$check_name = $dblink->getRow("SELECT * FROM pre_match WHERE match_name_zh = '$name'");
		if (is_numeric($check_name[0]['match_name_zh'])) {
			echo '已存在！！！';
			exit;
		}else {
			echo '';
			exit;
		}
		$dblink->dbclose();
		//return $check_name;
	}
}
?>