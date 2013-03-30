<?php 
class cache_shm {

	private $shm = null;

	public function __construct() {
		$this->shm = shm_attach(ftok('/tmp','huoshow'),100*1024*1024,0777);
		//$this->memcache->connect(MEMCACHE_HOST, MEMCACHE_PORT, MEMCACHE_TIMEOUT);
	}

	public function shm() {
		$this->__construct();
	}

	public function get($name) {
		//$value = $this->memcache->get($name);
		
		$value = shm_get_var($this->shm,crc32($name));
		return $value;
	}

	public function set($name, $value, $ttl = 0, $ext1='', $ext2='') {
		//return $this->memcache->set($name, $value, false, $ttl);
		return shm_put_var($this->shm,crc32($name),$value);
	}

	public function delete($name) {
		//return $this->memcache->delete($name);
		return shm_remove_var($this->shm,crc32($name));
	}

	public function flush() {
		//return $this->memcache->flush();
	}
}
?>