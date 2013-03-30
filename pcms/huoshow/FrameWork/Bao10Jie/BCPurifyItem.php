<?php
/*
 * this template use File | Settings | File Templates.
 * 要求1： PurreifyItem 自己提供方法检查字段
 * 要求2： PurreifyItem检查字段的方法名称为check+字段名， 参数为purify， feedback， notify之一
 * 要求3： PurreifyItem检查字段的方法检查方法返回空表示成功， 否则返回错误描述字符串
 * 要求4： PurreifyItem 字段对应的方法不存在表示不需要检查该字段
 */
class BCPurifyItem
{
	function __construct(){}
	function __destruct(){}
	
	public function checkstatus($task,$status) 
	{
		if ($task != "feedback")
			return null;
		return ($status == null) ? "status cannot be empty"
				: null;
	}


	public function checktextId($task,$textId) 
	{
		if ($task == "notify" || $task == "getIndexResult")
			return null;

		return ($textId == null) ? "textId cannot be empty"
				: null;
	}
	
	public function checkclass($task,$class) 
	{
		if ($task == "notify" || $task == "getIndexResult")
			return null;

		return ($class == null) ? "class cannot be empty"
				: null;
	}
	
	public function checkpubDate($task,$pubDate) 
	{
		if ($task == "notify" || $task == "getIndexResult")
			return null;
		if($pubDate == null)
			return "pubDate cannot be empty";
		if (!$this->is_date($pubDate)) 
		{
			return "pubDate must be format";
		}
		return null;
	}

	/**
	 * 公有参数，不能放到xml中
	 * @param name
	 * @return
	 */
	private function isPublicField($name) 
	{
		return $name == "appType";

	}
	
	private function strlen_utf8($str) 
	{   
		$i = 0;   
		$count = 0;   
		$len = strlen ($str);   
		while ($i < $len) {   
			$chr = ord ($str[$i]);   
			$count++;   
			$i++;   
			if($i >= $len) break;   
			if($chr & 0x80) {   
				$chr <<= 1;   
				while ($chr & 0x80) {   
					$i++;   
					$chr <<= 1;   
				}   
			}   
		}   
		return $count;   
	}
	
	private function is_date($str,$format="Y-m-d H:i:s")
	{
        $str = trim($str);
        $unixTime = strtotime($str);
        $checkDate = date($format,$unixTime);
        if(strcmp($checkDate,$str) == 0){ 
                return true;
        }else{
                return false;
        }
	}  
	
	public $m_hlParmas;	//将所有参数放置到数组中去
}
