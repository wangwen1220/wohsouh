<?php
require_once("BCPurifyClient.php");
require_once("BCPurifyItem.php");
require_once("BCPurifyResult.php");

class Demo {
	public function run($param, $task) {
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
				print_r($result->getMarkResult());
			}else {
				echo '通知接口返回为空';
			}
		}else {
			//失败时取结果集
			print_r($result->getMarkResult());
		}
	}	
}

$param = array();
$task = 'Purify';	//用户自定义，Purify/Feedback/getNotify/getIndexResult
if ($task == 'Purify') {
	//标引接口

	//单条请求
	/*
	$param['isBatch'] = 0;
	$param['appType'] = "bbs";
	$param['textId'] = "12323".rand();
	$param['threadId'] = "123456";
	$param['class'] = "11";
	$param['ip'] ="23.23.3.3";
	$param['userId'] ="abcd";
	$param['author'] ="";
	$param['title']="01010101010101";
	$param['text'] ="01010101010101 qq 号 123457";
	$param['url'] ="http://test";
	$param['pubDate'] = "2010-12-01 00:00:00";
	$param['authorEx'] = "作者扩展";
	$param['contentEx'] = "内容扩展";
	$param['structureEx'] = "structureEx";
	$param['rules'] = "规则";	
*/
	//批量请求
	
	$param[0]['isBatch'] = 1;
	$param[0]['appType'] = "bbs";
	$param[0]['textId'] = "12323".rand();
	$param[0]['threadId'] = "123456";
	$param[0]['class'] = "11";
	$param[0]['ip'] ="23.23.3.3";
	$param[0]['userId'] ="abcd";
	$param[0]['author'] ="";
	$param[0]['title']="01010101010101";
	$param[0]['text'] ="01010101010101 qq 号 123457";
	$param[0]['url'] ="http://test";
	$param[0]['pubDate'] = "2010-12-01 00:00:00";
	$param[0]['authorEx'] = "作者扩展";
	$param[0]['contentEx'] = "内容扩展";
	$param[0]['structureEx'] = "structureEx";
	$param[0]['rules'] = "规则";
	$param[1]['isBatch'] = 1;
	$param[1]['appType'] = "bbs";
	$param[1]['textId'] = "123231".rand();
	$param[1]['threadId'] = "123456";
	$param[1]['class'] = "11";
	$param[1]['ip'] ="23.23.3.3";
	$param[1]['userId'] ="abcd";
	$param[1]['author'] ="";
	$param[1]['title']="01010101010101";
	$param[1]['text'] ="01010101010101 qq 号 123457";
	$param[1]['url'] ="http://test";
	$param[1]['pubDate'] = "2010-12-01 00:00:00";
	$param[1]['authorEx'] = "作者扩展";
	$param[1]['contentEx'] = "内容扩展";
	$param[1]['structureEx'] = "structureEx";
	$param[1]['rules'] = "规则";
	
}elseif ($task == 'Feedback'){
	//反馈接口
	$param['appType'] = "bbs";
	$param['textId'] = "12323".rand();
	$param['threadId'] = "123456";
	$param['class'] = "11wee0";
	$param['ip'] ="23.23.3.3";
	$param['userId'] ="abcd";
	$param['author'] ="wwww";
	$param['title']="12 ab";
	$param['text'] ="12";
	$param['url'] ="http://test.html";
	$param['pubDate'] = "2010-12-01 00:00:00";
	$param['authorEx'] = "作者扩展";
	$param['contentEx'] = "内容扩展";
	$param['structureEx'] = "structureEx";
	$param['rules'] = "规则";

	$param['status'] = "1"; 
	$param['reason'] = "reason";
}else {
	//通知接口、批量标引通知接口
	$param['appType'] = "bbs";
}

$demo = new Demo();
for($i=0; $i<1; $i++ )
{
	
	$demo->run($param, $task);
	
}
unset($demo);