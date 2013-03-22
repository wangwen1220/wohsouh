<?php

/**
 * 缓存类
 *
 * @author chengkui
 * @package defaultPackage
 */
class Cache {
	
	private $obj=false;
	private $config_host;
	private $config_port;
	private $pconnect;

	/**
	 * 构造函数
	 *
	 * @param unknown_type $host	缓存ip
	 * @param unknown_type $port    端口
	 * @param unknown_type $pconnect 是否长链接
	 */
	public function __construct($host="127.0.0.1",$port=11211,$pconnect=true)
	{
		$this->config_host = $host;
		$this->config_port = $port;
		$this->pconnect = $pconnect;

		$this->obj = new Memcache;
		if ($this->pconnect) {
			$connect = @$this->obj->pconnect($this->config_host, $this->config_port);
		} else {
			$connect = @$this->obj->connect($this->config_host, $this->config_port);
		}
	}
	

	/**
	 * 取得一个键值的值
	 *
	 * @param unknown_type $key
	 * @return unknown
	 */
	public function get($key) 
	{
		if(!$this->obj)
			return false;
		else 
			return $this->obj->get($key);
	}

	
	/**
	 * 设置键值
	 *
	 * @param unknown_type $key
	 * @param unknown_type $value
	 * @param unknown_type $ttl
	 * @return unknown
	 */
	public function set($key, $value, $ttl = 0) 
	{
		if(!$this->obj)
			return false;
		else 
			return $this->obj->set($key, $value, MEMCACHE_COMPRESSED, $ttl);
			
	}

	/**
	 * 删除一个键值的值
	 *
	 * @param unknown_type $key
	 * @return unknown
	 */
	public function rm($key)
	{
		if(!$this->obj)
			return false;
		else
			return $this->obj->delete($key);
	}
	
	/**
	 * 关闭链接
	 *
	 * @return unknown
	 */
	function close(){
		if (!$this->obj)
			return false;
		else 	
			$this->obj->close();
	}
	
	
	/**
	 * 使服务器上所有资源失效
	 *
	 * @return unknown
	 */
	function flush() 
	{
		if (!$this->obj)
			return false;
		else
			$this->obj->flush();
	}
}