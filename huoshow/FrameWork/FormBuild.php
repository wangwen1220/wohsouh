<?php
/**
 * 根据输入的json生成表单
 *
 */
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");

class FormBuild
{
	private $mReturnVal;
	private $mValidataReturnVal;
	private $input = '<tr><td width="100">{$zh_name}:</td><td><input name="{$enname}" type="{$inputtype}" id="{$enname}" value="" /></td></tr>
	';
	private $select_button = '<tr><td width="100">{$zh_name}:</td><td><select name="{$enname}" id="{$enname}">{$option_content}</select></td></tr>
	';
	private $option_button = '<option value="{$value}">{$content}</option>
	';
	private $common_button_content = '<tr><td width="100">{$zh_name}:</td><td>{$content}</td></tr>
	';
	private $checkbox_button = '<label><input type="checkbox" id="{$enname}[]" name="{$enname}[]" value="{$value}" />{$content}</label>
	';
	private $text_content = '<textarea name="{$enname}" id="{$enname}" cols="50" rows="8"></textarea>
	';
	private $upload_input = '<input type="file" name="{$enname}" id="{$enname}" />	
	';
	private $validate_fun_head = '
	<script >
	{$smarty}
	function check_auto_build_form()
	{
	';
	private $validate_fun_body = '
		if(!{$patten}.test(document.getElementById("{$enname}").value))
		{
			document.getElementById("{$enname}").select();
			document.getElementById("{$enname}").focus();
			alert("{$error_msg}");
			return false;
		}
	';
	private $validate_fun_foot = '
			return true;
			}
			</script>
	{$smarty_foot}
	';
	//是否存在上传控件
	private $isHaveUploadFile=false;

	public function __construct()
	{
		$this->mReturnVal = '<table width="100%">
		<form action="{$form_action}" methon="post" onsubmit="return check_auto_build_form();" {$upload}>
		';
	}
	public function __destruct(){}
	
	
	/**
	 * 生成表单
	 *
	 * @param unknown_type $json 描述表单的json字符串
	 * @param unknown_type $form_action 表单的提交地址
	 * @param unknown_type $isSmarty 是否生成smarty模板（js用letaral包含起来）
	 * @param unknown_type $php_file 生成的Php文件的地址，false为不生成php
	 * @param unknown_type $table_name 表单入库的表，如果为false，
	 * 						则不自动生成表
	 */
	public function buildForm($json,$form_action="",$isSmarty=false,$php_file=false,$table_name=false)
	{
		$json = str_replace("\\\"","\"",$json);
		
		$str_arr = json_decode($json);
		$this->mValidataReturnVal = $this->validate_fun_head;
		$this->mReturnVal = str_replace('{$form_action}',$form_action,$this->mReturnVal);
		if(!empty($str_arr))
		{
			$arr_count = count($str_arr);
			for($i=0;$i<$arr_count;$i++)
			{
				switch ($str_arr[$i]->x_param_display_type)
				{
					case 1:
						$this->addCheckBox(&$str_arr[$i]);
						break;
					case 2:
					case 3:
						$this->addSelect(&$str_arr[$i]);
						break;
					case 4:
					case 7:
						$this->addInput(&$str_arr[$i]);
						break;
					case 5:
						$this->addTextArea(&$str_arr[$i]);
						break;
					case 6:
						$this->addUploadFile(&$str_arr[$i]);
						$this->isHaveUploadFile = true;
						break;
				}
			}
			$smarty_head = ($isSmarty)?'{literal}':"";
			$smarty_foot = ($isSmarty)?'{/literal}':"";
			$this->mValidataReturnVal .= $this->validate_fun_foot;
			$this->mValidataReturnVal = str_replace('{$smarty}',$smarty_head,$this->mValidataReturnVal);
			$this->mValidataReturnVal = str_replace('{$smarty_foot}',$smarty_foot,$this->mValidataReturnVal);
			$this->mReturnVal .= '
			<tr><td>
			<input type="submit" name="Submit" value="提交" />
			</td></tr>
			</form>
			</table>';
			if($this->isHaveUploadFile)
				$this->mReturnVal = str_replace('{$upload}','enctype="multipart/form-data"',$this->mReturnVal);
			$this->mReturnVal = $this->mValidataReturnVal."<br>".$this->mReturnVal;
		}
		return $this->mReturnVal;
	}
	
	/**
	 * 增加一个上传框
	 *
	 * @param unknown_type $obj
	 */
	private function addUploadFile($obj)
	{
		$tmp_str = str_replace('{$zh_name}',$obj->x_param_zh_name,$this->common_button_content);
		$tmp_content = str_replace('{$enname}',$obj->x_param_en_name,$this->upload_input);
		$this->mReturnVal .= str_replace('{$content}',$tmp_content,$tmp_str);
		return true;
	}
	
	/**
	 * 增加一个文本区域
	 *
	 * @param unknown_type $obj
	 * @return unknown
	 */
	private function addTextArea($obj)
	{
		$tmp_str = str_replace('{$zh_name}',$obj->x_param_zh_name,$this->common_button_content);
		$tmp_content = str_replace('{$enname}',$obj->x_param_en_name,$this->text_content);
		$this->mReturnVal .= str_replace('{$content}',$tmp_content,$tmp_str);
		return true;
	}
	
	/**
	 * 增加复选框
	 *
	 */
	private function addCheckBox($obj)
	{
		
		$tmp_str = str_replace('{$zh_name}',$obj->x_param_zh_name,$this->common_button_content);
		$checkbox_arr = explode("|",$obj->x_param_option_value);
		$checkbox_str = "";

		for($i=0;$i<count($checkbox_arr);$i++)
		{
			$tmp = explode(",",$checkbox_arr[$i]);
			$tmp_check_str = str_replace('{$value}',$tmp[1],$this->checkbox_button);
			$tmp_check_str = str_replace('{$content}',$tmp[0],$tmp_check_str);
			$tmp_check_str = str_replace('{$enname}',$obj->x_param_en_name,$tmp_check_str);
			
			if($i % 4 ==0)
				$checkbox_str .= "<br>".$tmp_check_str."&nbsp;&nbsp;";
			else 
				$checkbox_str .= $tmp_check_str."&nbsp;&nbsp;";
		}
		$this->mReturnVal .= str_replace('{$content}',$checkbox_str,$tmp_str);
		return true;
	}
	
	/**
	 * 增加列表框
	 *
	 * @param unknown_type $obj
	 */
	private function addSelect($obj)
	{
		$tmp_str = str_replace('{$zh_name}',$obj->x_param_zh_name,$this->select_button);
		$tmp_str = str_replace('{$enname}',$obj->x_param_en_name,$tmp_str);
		$option_arr = explode("|",$obj->x_param_option_value);
		$opton_str = "";
		for($i=0;$i<count($option_arr);$i++)
		{
			$tmp = explode(",",$option_arr[$i]);
			$tmp_option_str = str_replace('{$value}',$tmp[1],$this->option_button);
			$tmp_option_str = str_replace('{$content}',$tmp[0],$tmp_option_str);
			$opton_str .= $tmp_option_str;
		}
		$this->mReturnVal .= str_replace('{$option_content}',$opton_str,$tmp_str);
		return true;
	}
	
	/**
	 * 增加输入框类型
	 *
	 * @param unknown_type $obj
	 */
	private function addInput($obj)
	{
		$input_type = ($obj->x_param_display_type==7)?"password":"text";
		$tmp_str = str_replace('{$zh_name}',$obj->x_param_zh_name,$this->input);
		$tmp_str = str_replace('{$enname}',$obj->x_param_en_name,$tmp_str);
		$tmp_str = str_replace('{$inputtype}',$input_type,$tmp_str);
		
		$this->mReturnVal .= $tmp_str;
		
		if(!empty($obj->x_param_verify_patten_js))
		{
			$validate_body = str_replace('{$patten}',$obj->x_param_verify_patten_js,$this->validate_fun_body);
			$validate_body = str_replace('{$enname}',$obj->x_param_en_name,$validate_body);
			$validate_body = str_replace('{$error_msg}',$obj->x_param_verify_error_msg,$validate_body);
			$this->mValidataReturnVal .= $validate_body;
		}
	}
	
	/**
	 * 根据json字符串，自动建表
	 *
	 * @param unknown_type $jsonstr 表单描述json字符串
	 * @param unknown_type $tablename 希望建立的表名
	 */
	static public function createTable($jsonstr,$tablename)
	{
		$sql_head = '
		CREATE TABLE `'.$tablename.'` (
			`id` BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
		';
		if(empty($jsonstr) || empty($tablename))
			return false;
		$jsonstr = str_replace("\\\"","\"",$jsonstr);
		$str_arr = json_decode($jsonstr);
		if(empty($str_arr))
			return false;
		for($i=0;$i<count($str_arr);$i++)
		{
			$tmp_obj = $str_arr[$i];
			var_dump($tmp_obj->x_param_type);
			switch ($tmp_obj->x_param_type)
			{
				case 2:
					$sql = "`".$tmp_obj->x_param_en_name."` BIGINT(10) COMMENT '".$tmp_obj->x_param_zh_name."' ,";
					break;
				case 1:
					$varchar_count = ($tmp_obj->x_param_display_type==5)?5120:512;
					$sql = "`".$tmp_obj->x_param_en_name."` VARCHAR($varchar_count) COMMENT '".$tmp_obj->x_param_zh_name."' ,";
					break;
			}
			$sql_head .= $sql;
		}
		$sql_head .= 'PRIMARY KEY (`id`)
			) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ';	
		$dblink = new DataBase("");
		$dblink->query($sql_head);
		$dblink->dbclose();
		return true;
	}
	
	/**
	 * 根据json字符串，对表结构进行修改
	 *
	 * @param unknown_type $jsonstr
	 * @param unknown_type $tablename
	 */
	static public function alterTable($jsonstr,$tablename)
	{
		if(empty($jsonstr) || empty($tablename))
			return false;
		$jsonstr = str_replace("\\\"","\"",$jsonstr);
		$str_arr = json_decode($jsonstr);

		if(empty($str_arr))
			return false;
		$dblink = new DataBase("");
		$sql = "SELECT  COLUMN_NAME,DATA_TYPE FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='".GLOBAL_MYSQLBASE."' AND TABLE_NAME='$tablename'";
		$table_arr = $dblink->getRow($sql);
		$count = count($table_arr);
		for($i=0;$i<$count;$i++)
		{
			if($table_arr[$i]["COLUMN_NAME"]=="id")
				continue;
			if($table_arr[$i]["DATA_TYPE"]=="bigint" || $table_arr[$i]["DATA_TYPE"]=="int" ||
				$table_arr[$i]["DATA_TYPE"]=="float")
				$table_arr[$i]["DATA_TYPE"]=2;
			else
				$table_arr[$i]["DATA_TYPE"]=1;
			$table_map[$table_arr[$i]["COLUMN_NAME"]] = $table_arr[$i]["DATA_TYPE"];
		}
		$count = count($str_arr);
		for($i=0;$i<$count;$i++)
		{
			$obj = $str_arr[$i];
			$json_map[$obj->x_param_en_name] = array("x_param_type"=>$obj->x_param_type,
				"x_param_display_type"=>$obj->x_param_display_type);
		}
		//数据库中有而json中没有的，数据库删除该列	
		foreach ($table_map as $key=>$value)
		{
			if(!array_key_exists($key,$json_map))
			{
				$dblink->query("ALTER TABLE $tablename DROP $key");
			}
			else 
			{
				$datatype = ($json_map[$key]["x_param_type"]==2)?"bigint(10)":($json_map[$key]["x_param_display_type"]==5?"varchar(5120)":"varchar(512)");
				if($value!=$json_map[$key]["x_param_type"]) //如果数据类型不一致，则修改为json描述的数据类型
					$dblink->query("ALTER TABLE $tablename CHANGE $key $key $datatype");
			}
		}
		//对json数据进行遍历，如果json有而数据库没有的，则新增
		foreach ($json_map as $key=>$value)
		{
			$datatype = ($value["x_param_type"]==2)?"bigint(10)":($value["x_param_display_type"]==5?"varchar(5120)":"varchar(512)");
			if(!array_key_exists($key,$table_map))
				$dblink->query("ALTER TABLE $tablename ADD $key $datatype");
		}
		$dblink->dbclose();
		return true;
	}


	/**
	 * 对生成的表单提交的内容入表
	 *
	 * @param unknown_type $data	表单内容
	 * @param unknown_type $table	表名
	 * @param unknown_type $jsonstr	表结构的json字符串
	 */
	static public function dataInTable($data,$table,$jsonstr)
	{
		if(empty($jsonstr) || empty($table) || empty($data))
			return false;
		$jsonstr = str_replace("\\\"","\"",$jsonstr);
		$str_arr = json_decode($jsonstr);
		$sql_hear = "insert into $table ({fieldlist}) values ({valuelist})";
		$fieldCount = count($data);
		$jsonArrCount = count($str_arr);
		$jsonMap = array();
		for($i=0;$i<$jsonArrCount;$i++)
		{
			$jsonMap[$str_arr[$i]->x_param_en_name] = $str_arr[$i];
			if(array_key_exists($str_arr[$i]->x_param_en_name,$data)) //如果表单中有值
			{
				$fieldList .= $str_arr[$i]->x_param_en_name.",";
				$valueList .= "'".$data[$str_arr[$i]->x_param_en_name]."',";
			}
		}
		$sql = str_replace("{fieldlist}",trim($fieldList,","),$sql_hear);
		$sql = str_replace("{valuelist}",trim($valueList,","),$sql);
		$dblink = new DataBase("");
		$dblink->query($sql);
		$dblink->dbclose();
	}
}

if($_GET["test"]=="yes")
{
$json_str = '
[
	{
		"x_param_zh_name":"用户",
		"x_param_en_name":"username",
		"x_param_display_type":4,
		"x_param_type":1,
		"x_param_verify_patten_js":"/[a-zA-Z0-9]+/",
		"x_param_verify_error_msg":"用户名只能包含大小写字母和数字"
	},
	{
		"x_param_zh_name":"密码",
		"x_param_en_name":"password",
		"x_param_display_type":7,
		"x_param_type":1,
		"x_param_verify_patten_js":"/.+/gi",
		"x_param_verify_error_msg":"密码不能为空"		
	},
	{
		"x_param_zh_name":"性别",
		"x_param_en_name":"sex",
		"x_param_display_type":3,
		"x_param_type":2,
		"x_param_option_value":"男,1|女,2"
	},
	{
		"x_param_zh_name":"兴趣爱好",
		"x_param_en_name":"interest",
		"x_param_display_type":1,
		"x_param_type":1,
		"x_param_option_value":"聊天,聊天|唱歌,唱歌|登山,登山|旅游,旅游|吃东西,吃东西"
	},
	{
		"x_param_zh_name":"bbbb",
		"x_param_en_name":"bbb",
		"x_param_display_type":4,
		"x_param_type":1
	},
	{
		"x_param_zh_name":"照片",
		"x_param_en_name":"img",
		"x_param_display_type":6,
		"x_param_type":1
	}
]
';

header("Content-type: text/html; charset=utf-8"); 
//print_r($json_str);
//print_r("<br><br><br>");
$test = new FormBuild();
//$tt = $test->buildForm($json_str);
//$tt=$test->createTable($json_str,"pre_match_autotable_2");
//$tt=$test->alterTable($json_str,"pre_match_autotable_2");
$tt = $test->dataInTable(array("username"=>"safasf","img"=>"/var/sdf.jpg"),"test",$json_str);
var_dump($tt);
}
?>