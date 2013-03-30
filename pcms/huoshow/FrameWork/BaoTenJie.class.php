<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Bao10Jie/BCPurifyClient.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Bao10Jie/BCPurifyItem.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Bao10Jie/BCPurifyResult.php");

class BaoTenJie
{
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $param  文本
	 * @param unknown_type $task   文本验证接口
	 */
	public function textCheck($param, $task) {
		// TODO Auto-generated method stub
		$item = new BCPurifyItem();
		$item->m_hlParmas = $param;	
		$client = new BCPurifyClient();
		$result = $client->{$task}($item);		//	Purify/Feedback/getNotify/getIndexResult
		if (!$result) {
			//客户端内部错误,返回字段校验错误(例:appType cannot be empty)或网络请求错误(例:http code:404)
			print_r($client->getError());
		}elseif ($result->isBusinessSuccess()){
			//成功时取结果集,返回数组对象
			if ($result->getMarkResult() != null) {
//				print_r($result->getMarkResult());
				return $result->getMarkResult();
			}else {
				echo '通知接口返回为空';
			}
		}else {
			//失败时取结果集
//			print_r($result->getMarkResult());
			return $result->getMarkResult();
		}
	}
}

?>