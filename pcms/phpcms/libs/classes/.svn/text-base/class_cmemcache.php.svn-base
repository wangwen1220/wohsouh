<?php
/**
 * memcache缓存类
 * @author zhangchengjun 2011.06.21
 *
 */
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/configs/config_global.php";

class cmemcache {
	
	private $obj;
	private $config_host;
	private $config_port;
	private $pconnect = 1;
	private $debug = 0;
	private $log = '/var/www/html/huoshow/dz/data/log/test_memcache.log';

	 function __construct() {
		if (CMEMCACHE_ENABLE) {
			$this->config_host = CMEMCACHE_HOST;
			$this->config_port = CMEMCACHE_PORT;
			$this->pconnect = CMEMCACHE_PCONNECT;
			$this->obj = new Memcache;
			if ($this->pconnect) {
				$connect = @$this->obj->pconnect($this->config_host, $this->config_port);
			} else {
				$connect = @$this->obj->connect($this->config_host, $this->config_port);
			}
		}
	}

	function get($key) {
		if (CMEMCACHE_ENABLE) {
			if ($this->debug) {
				@error_log(date('Y-m-d H:i:s')."[web]__get-$key \r\n", 3, $this->log);
			}
			return $this->obj->get($key);
		} else {
			return false;
		}
	}

	function set($key, $value, $ttl = 0) {
		if (CMEMCACHE_ENABLE) {
			if ($this->debug) {
				@error_log(date('Y-m-d H:i:s')."[web]set-$key \r\n", 3, $this->log);
			}
			return $this->obj->set($key, $value, MEMCACHE_COMPRESSED, $ttl);
		}
	}

	function rm($key) {
		if (CMEMCACHE_ENABLE) {
			if ($this->debug) {
				@error_log(date('Y-m-d H:i:s')."[web]rm-$key \r\n", 3, $this->log);
			}
			return $this->obj->delete($key);
		}
	}
	
	function close(){
		if (CMEMCACHE_ENABLE) {
			$this->obj->close();
		}
	}
	
	function flush() {
		if (CMEMCACHE_ENABLE) {
			$this->obj->flush();
		}
	}
}

?>