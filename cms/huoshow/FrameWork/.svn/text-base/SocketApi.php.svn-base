<?php
class SockProcess
{
	private $m_sock_fp = null;		//socket 描述符
	private $m_recv_data="";		//返回数据
	private $m_buffer_size=1024;	//buffer size
	
	/**
	 * 连接套接字
	 *
	 * @param unknown_type $ip      
	 * @param unknown_type $port
	 * @return unknown true 成功；false 失败
	 */
	public function open($ip,$port)
	{
		
		if(!($this->m_sock_fp=socket_create(AF_INET,SOCK_STREAM,SOL_TCP)))
		{
			//die("ss");
			$this->print_error();
			return false;
		}
		socket_set_option($this->m_sock_fp, SOL_SOCKET, SO_RCVTIMEO, array("sec" => 2, "usec" => 0));
		if(!socket_connect($this->m_sock_fp,$ip,$port))
		{
			$this->print_error();
			return false;
		}
		return true;
	}
		
	/**
	 * 发送并返回结果
	 *
	 * @param unknown_type $string 查询字符串
	 * @return unknown 失败返回false,否则返回服务端返回结果
	 */
	public function send($string)
	{
		if(!socket_write ($this->m_sock_fp, $string, strlen ($string)))
		{
			$this->print_error();
			return false;
		}
		//$this->m_recv_data=@socket_read($this->m_sock_fp,  20*8*1024,PHP_BINARY_READ );
		//var_dump($this->m_recv_data);die();
		while($buf=socket_read($this->m_sock_fp,  $this->m_buffer_size))
		{
			if(strlen($buf)==0||!$buf)
				break;
			$recv_data .= $buf;
			if(strlen($buf)<$this->m_buffer_size)
				break;
		}
		
		//$this->close();
		return $recv_data;
	}
	
	public function close()
	{
		socket_close($this->m_sock_fp);
	}
	
	/**
	 * 打印socket错误
	 *
	 */
	private function print_error()
	{
		print_r(socket_strerror(socket_last_error($m_sock_fp)));
	}
	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $ip
	 * @param unknown_type $port
	 * @param unknown_type $sendStr
	 * @return unknown
	 */
	static public function sendAndReturn($ip,$port,$sendStr)
	{
		$sock = new SockProcess();
		$sock->open($ip,$port);
		return $sock->send($sendStr);
	}
}

/*
$sock = new SockProcess();
$sock->open("192.168.0.133",1500);
var_dump($sock->send("sssss"));
$sock->close();
*/
?>