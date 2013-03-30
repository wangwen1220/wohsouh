<?php
/**
 * BCPurifyClient——用于调用净化服务接口
 */
require_once("config/Cfg.php");
require_once("BCPurifyItem.php");
require_once("BCPurifyResult.php");
require_once("lib/BCLogger.php");
require_once("lib/BCClientProxy.php");
date_default_timezone_set("PRC");

class BCPurifyClient 
{
	function __construct()
	{
		$this->m_params['appid'] = HL_APPID;
		$this->m_params['format'] = "json";
		$this->m_params['v'] = HL_VERSION;
		$this->m_params['sdkversion'] = 'BCSPHPCLIENT1.0.20110823';
		$this->m_errCode = "";
		$this->m_errMsg = "";
	}
	function  __destruct(){}
	
	/**
	 * 调用净化服务内容净化接口
	 *
	 * @param BCPurifyItem item
	 * @return BCPurifyResult result
	 */
	public function Purify($item)
	{	
		$time_start = $this->MicrotimeFloat();
		$task = "purify";
		$log = new BCLogger();
		$paramsAry = (array)$item->m_hlParmas;
		if ($paramsAry[0]['isBatch'] == 1) {
			$this->m_params['transId'] = $this->GenerateTransID($paramsAry[0]['appType'].$paramsAry[0]['textId']);
			$isBatch = $paramsAry[0]['isBatch'];
			$appType = $paramsAry[0]['appType'];
			
		}else{
			$this->m_params['transId'] = $this->GenerateTransID($paramsAry['appType'].$paramsAry['textId']);
			//合法性校验
			$rc = $this->CheckParam($task,$paramsAry);
			if ($rc != null) {
				$log->LogBusiness($time_start,$task,$this->m_params['transId'],$paramsAry,-1,0,100,100,$rc);
				$this->SetError(100,$rc);
				return false;
			}
			$isBatch = $paramsAry['isBatch'];
			$appType = $paramsAry['appType'];
		}
		
		
		$this->m_params['time'] = time();
		if ($isBatch != 1) {
			unset($paramsAry['isBatch']);
			unset($paramsAry['appType']);
			$this->m_params['param'] =  $this->GenerateXmlData($paramsAry);
		}else {
			foreach ($paramsAry as $key=>$value) {
				unset($paramsAry[$key]['isBatch']);
				unset($paramsAry[$key]['appType']);
			}
			$this->m_params['param'] =  $this->GenerateXmlData($paramsAry,true);
		}
		
		$this->m_params['appType'] = $appType;
		$this->m_params['isBatch'] = $isBatch;
		$this->m_params['sig'] = $this->GetSig($this->m_params);
		$this->m_params['param'] = urlencode($this->m_params['param']);
		
		$paramsTmp = array();
		foreach ($this->m_params as $k => $v) 
		{
			$paramsTmp[] = "$k=$v";
		}
		
		$strJson = "";
		$retries = -1;
		$proxy = new BCClientProxy();
		do {
			++$retries;
			$strJson = $proxy->HttpPostData(implode("&", $paramsTmp),HL_URLPRE);
			if ($strJson) {
				break;
			}
		}while ($retries < HL_RETRIES);
	
		$paramsAry['appType'] = $appType;
		if (!$strJson) {
			$error = $proxy->getError();
			$log->LogBusiness($time_start,$task,$this->m_params['transId'],$paramsAry,-1,$retries,400,400,"http code:".$error['netcode']);
			$this->SetError(400,"http code:".$error['netcode']);
			return false;
		}else 
		{
			$ret = $this->ParseParam($strJson);
			$result = $this->GetRet($ret,$task);
			if ($result->isBusinessSuccess()) {
				$log->LogBusiness($time_start,$task,$this->m_params['transId'],$paramsAry,0,$retries,1000,0,$strJson);
			}else {
				$record = $result->getMarkResult();
				$log->LogBusiness($time_start,$task,$this->m_params['transId'],$paramsAry,-1,$retries,500,$record->errorCode,$record->errorMsg);
			}
			return $result; 
		}
	}
	
	/**
	 * 调用净化服务训练(反馈)接口
	 *
	 * @param BCPurifyItem item
	 * @return BCPurifyResult result
	 */
	public function Feedback($item)
	{
		$time_start = $this->MicrotimeFloat();
		$task = "feedback";
		$log = new BCLogger();
		$paramsAry = (array)$item->m_hlParmas;
		$this->m_params['transId'] = $this->GenerateTransID($paramsAry['appType'].$paramsAry['textId']);
		
		//合法性校验
		$rc = $this->CheckParam($task,$paramsAry);
		if ($rc != null) {
			$log->LogBusiness($time_start,$task,$this->m_params['transId'],$paramsAry,-1,0,100,100,$rc);
			$this->SetError(100,$rc);
			return false;
		}
		$appType = $paramsAry['appType'];
		unset($paramsAry['appType']);
		
		$this->m_params['time'] = time();
		$this->m_params['param'] =  $this->GenerateXmlData($paramsAry);
		$this->m_params['appType'] = $appType;
		$this->m_params['sig'] = $this->GetSig($this->m_params);
		$this->m_params['param'] = urlencode($this->m_params['param']);
		
		$paramsTmp = array();
		foreach ($this->m_params as $k => $v) 
		{
			$paramsTmp[] = "$k=$v";
		}
		
		$strJson = "";
		$retries = -1;
		$proxy = new BCClientProxy();
		do {
			++$retries;
			$strJson = $proxy->HttpPostData(implode("&", $paramsTmp),HL_URLTRA);
			if ($strJson) {
				break;
			}
		}while ($retries < HL_RETRIES);
		
		$paramsAry['appType'] = $appType;
		if (!$strJson) {
			$error = $proxy->getError();
			$log->LogBusiness($time_start,$task,$this->m_params['transId'],$paramsAry,-1,$retries,400,400,"http code:".$error['netcode']);
			$this->SetError(400,"http code:".$error['netcode']);
			return false;
		}else 
		{
			$ret = $this->ParseParam($strJson);
			$result = $this->GetRet($ret,$task);
			if ($result->isBusinessSuccess()) {
				$log->LogBusiness($time_start,$task,$this->m_params['transId'],$paramsAry,0,$retries,1000,0,$strJson);
			}else {
				$record = $result->getMarkResult();
				$log->LogBusiness($time_start,$task,$this->m_params['transId'],$paramsAry,-1,$retries,500,$record->errorCode,$record->errorMsg);
			}
			return $result; 
		}
	}
	/**
	 * 调用净化服务通知接口
	 *
	 * @param BCPurifyItem item
	 * @return BCPurifyResult result
	 */
	public function getNotify($item)
	{
		$time_start = $this->MicrotimeFloat();
		$task = "notify";
		$log = new BCLogger();
		$paramsAry = (array)$item->m_hlParmas;
		$this->m_params['transId'] = $this->GenerateTransID($paramsAry['appType']);
		
		//合法性校验
		$rc = $this->CheckParam($task,$paramsAry);
		if ($rc != null) {
			$log->LogBusiness($time_start,$task,$this->m_params['transId'],$paramsAry,-1,0,100,100,$rc);
			$this->SetError(100,$rc);
			return false;
		}
		
		$appType = $paramsAry['appType'];
		unset($paramsAry);
	
		$this->m_params['time'] = time();
		$this->m_params['appType'] = $appType;
		$this->m_params['sig'] = $this->GetSig($this->m_params);
		
		$paramsTmp = array();
		foreach ($this->m_params as $k => $v) 
		{
			$paramsTmp[] = "$k=$v";
		}
		
		$strJson = "";
		$retries = -1;
		$proxy = new BCClientProxy();
		do {
			++$retries;
			$strJson = $proxy->HttpPostData(implode("&", $paramsTmp),HL_URLNTC);
			if ($strJson) {
				break;
			}
		}while ($retries < HL_RETRIES);
		
		$paramsAry['appType'] = $appType;
		if (!$strJson) {
			$error = $proxy->getError();
			$log->LogBusiness($time_start,$task,$this->m_params['transId'],$paramsAry,-1,$retries,400,400,"http code:".$error['netcode']);
			$this->SetError(400,"http code:".$error['netcode']);
			return false;
		}else 
		{
			$ret = $this->ParseParam($strJson);
			$result = $this->GetRet($ret,$task);
			if ($result->isBusinessSuccess()) {
				$log->LogBusiness($time_start,$task,$this->m_params['transId'],$paramsAry,0,$retries,1000,0,$strJson);
			}else {
				$record = $result->getMarkResult();
				$log->LogBusiness($time_start,$task,$this->m_params['transId'],$paramsAry,-1,$retries,500,$record->errorCode,$record->errorMsg);
			}
			return $result; 
		}
	}
	
	/**
	 * 调用净化服务批量标引通知接口
	 *
	 * @param BCPurifyItem item
	 * @return BCPurifyResult result
	 */
	public function getIndexResult($item)
	{
		$time_start = $this->MicrotimeFloat();
		$task = "getIndexResult";
		$log = new BCLogger();
		$paramsAry = (array)$item->m_hlParmas;
		$this->m_params['transId'] = $this->GenerateTransID($paramsAry['appType']);
		
		//合法性校验
		$rc = $this->CheckParam($task,$paramsAry);
		if ($rc != null) {
			$log->LogBusiness($time_start,$task,$this->m_params['transId'],$paramsAry,-1,0,100,100,$rc);
			$this->SetError(100,$rc);
			return false;
		}
		
		$appType = $paramsAry['appType'];
		unset($paramsAry);
	
		$this->m_params['time'] = time();
		$this->m_params['appType'] = $appType;
		$this->m_params['sig'] = $this->GetSig($this->m_params);
		
		$paramsTmp = array();
		foreach ($this->m_params as $k => $v) 
		{
			$paramsTmp[] = "$k=$v";
		}
		
		$strJson = "";
		$retries = -1;
		$proxy = new BCClientProxy();
		do {
			++$retries;
			$strJson = $proxy->HttpPostData(implode("&", $paramsTmp),HL_URLGIR);
			if ($strJson) {
				break;
			}
		}while ($retries < HL_RETRIES);
		
		$paramsAry['appType'] = $appType;
		if (!$strJson) {
			$error = $proxy->getError();
			$log->LogBusiness($time_start,$task,$this->m_params['transId'],$paramsAry,-1,$retries,400,400,"http code:".$error['netcode']);
			$this->SetError(400,"http code:".$error['netcode']);
			return false;
		}else 
		{
			$ret = $this->ParseParam($strJson);
			$result = $this->GetRet($ret,$task);
			if ($result->isBusinessSuccess()) {
				$log->LogBusiness($time_start,$task,$this->m_params['transId'],$paramsAry,0,$retries,1000,0,$strJson);
			}else {
				$record = $result->getMarkResult();
				$log->LogBusiness($time_start,$task,$this->m_params['transId'],$paramsAry,-1,$retries,500,$record->errorCode,$record->errorMsg);
			}
			return $result; 
		}
	}
	
	/**
	 * 计算加密字段sig
	 *
	 * @param array $paramAry
	 * @return string $sig
	 */
	private function GetSig($paramAry)
	{
		ksort($paramAry); 
		$paramsTmp=array();
		foreach ($paramAry as $k => $v) {
			$paramsTmp[] = "$k=$v";
		}
		return md5(implode("&", $paramsTmp).HL_UKEY);
		
	}
	
	/**
	 * 生成XML
	 *
	 * @param array $paramsAry
	 * @return string $strXml
	 */
	private function GenerateXmlData($paramsAry, $isBatch=false)
	{		
		$strXml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n";
		$strXml .= "<contents>\r\n";
		if ($isBatch) {
			foreach ($paramsAry as $arrays) {
				$strXml .= "<content>\r\n";
				foreach ($arrays as $key=>$value) {
					$strXml .= "<$key><![CDATA[".trim($value)."]]></$key>\r\n";
				}
				$strXml .= "</content>\r\n";
			}	
		}else {
			$strXml .= "<content>\r\n";
			foreach ($paramsAry as $key=>$value) {
				$strXml .= "<$key><![CDATA[".trim($value)."]]></$key>\r\n";
			}
			$strXml .= "</content>\r\n";
		}
		$strXml .= "</contents>\r\n";
		return $strXml;
	}
	
	/**
	 * 解析XML
	 *
	 * @param string $strJson
	 * @return array $resultArr
	 */
	private function ParseParam($strJson)
	{
		return json_decode(str_replace("\n", "", $strJson));
		
	}

	private  function GenerateTransID($param) 
	{
		 if (function_exists('com_create_guid')){
	       return str_replace('-','0',com_create_guid());
   		}else{
	       //mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
	       $charid = strtoupper(md5(uniqid(rand().'param'.$param, true)));
	       //$hyphen = chr(45);// "-"
	       $hyphen = 0;
	       $uuid = chr(123)// "{"
	               .substr($charid, 0, 8).$hyphen
	               .substr($charid, 8, 4).$hyphen
	               .substr($charid,12, 4).$hyphen
	               .substr($charid,16, 4).$hyphen
	               .substr($charid,20,12)
	               .chr(125);// "}"
	       return $uuid;
	   }
	}
	
	private  function GetRet($ret,$method)
	{
		//print_r($ret);
		$result = new BCPurifyResult();
		if (isset($ret->error_purifyPredictResponse) || isset($ret->error_purifyTrainResponse) || isset($ret->error_purifyNoticeResponse) || isset($ret->error_purifyGetIndexResultResponse))
		{
			$result->setBusinessSuccess(false);
			if ($method =='purify') {
				$result->setMarkresults($ret->error_purifyPredictResponse);
			}elseif ($method =='feedback'){
				$result->setMarkresults($ret->error_purifyTrainResponse);
			}elseif ($method =='notify'){
				$result->setMarkresults($ret->error_purifyNoticeResponse);
			}
			
		}else {
			$result->setBusinessSuccess(true);
			if ($method =='purify') {
				$result->setMarkresults($ret->purifyPredictResponse->contents->content);
			}elseif ($method =='feedback'){
				$result->setMarkresults($ret->purifyTrainResponse->contents->content);
			}elseif ($method =='notify'){
				$result->setMarkresults(@$ret->purifyNoticeResponse->contents->content);
			}elseif ($method =='getIndexResult'){
				$result->setMarkresults(@$ret->purifyGetIndexResultResponse->contents->content);
			}
		}
		return $result;
	}
	
	private  function CheckParam($task, $param) 
	{
		$ret = null;
		$paramCheck = array();
		//$paramCheck['appType'] = $param['appType'];
		if ($task != 'notify' && $task != 'getIndexResult') {
			$paramCheck['class'] = $param['class'];
			$paramCheck['textId'] = $param['textId'];
			//$paramCheck['ip'] = $param['ip'];
			$paramCheck['pubDate'] = $param['pubDate'];
		}
		if ($task == 'feedback') {
			$paramCheck['status'] = $param['status'];
		}
		$item = new BCPurifyItem();
		foreach ($paramCheck as $key=>$value) {
			$ret = $item->{'check'.$key}($task, $value);
			if ($ret != null) {
				return $ret; 
			}
		}
		return $ret;
	}
	
	private function MicrotimeFloat()
	{
	    list($usec, $sec) = explode(" ", microtime());
	    return ((float)$usec + (float)$sec);
	}

	private function SetError($errCode,$errMsg)
	{
	   $this->m_errCode = $errCode;
	   $this->m_errMsg = $errMsg;
	}
	public function getError()
	{
	  return  $this->m_errMsg;
	}
	
	private $m_params = array();
	private $m_errCode;
	private $m_errMsg;
}
