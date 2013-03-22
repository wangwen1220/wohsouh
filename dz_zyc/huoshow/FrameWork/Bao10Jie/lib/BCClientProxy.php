<?php
/**
 * 发送请求的类， 目前采用HTTP POST
 */
class BCClientProxy
{
	
	function __construct()
	{
		$this->m_netcode = 0;
		$this->m_errorcode = 0;
		$this->m_errormsg = "";
	}
	/**
	 * 向http服务以pos方式提交数据
	 *
	 * @param string $sCmd	 数据字段，示例: key1=value1&key2=value2
	 * @param string $sUrl	 请求服务器地址
	 * @return http服务返回的结果数据
	 */
	private function SetError($netcode, $errorcode, $errormsg)
	{
		$this->m_netcode = $netcode;
		$this->m_errorcode = $errorcode;
		$this->m_errormsg = $errormsg;
	}
	
	public function HttpPostData($sCmd, $sUrl)
	{		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $sUrl);
		curl_setopt( $ch, CURLOPT_TIMEOUT, HL_TIMEOUT);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $sCmd);
		$retContent = curl_exec($ch);
		if (!$retContent) {
			$this->SetError(curl_getinfo($ch,CURLINFO_HTTP_CODE), curl_errno($ch), curl_error($ch));
		}
		curl_close($ch);
		return $retContent;
	}
	
	public function getError()
	{
		$ret = array();
		$ret['netcode'] = $this->m_netcode!='0'?$this->m_netcode:$this->m_errormsg;
		$ret['errorcode'] = $this->m_errorcode;
		$ret['errormsg'] = $this->m_errormsg;
		return $ret;
	} 
	private $m_netcode;  // HTTP 网络返回的状态码
	private $m_errorcode; //程序的错误码
	private $m_errormsg; //错误原因描述 
		
}