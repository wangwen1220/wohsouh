<?php
/**
 * ftp类
 * @author ZhangChengJun
 *
 */
defined('FTP_ERR_SERVER_DISABLED') or define('FTP_ERR_SERVER_DISABLED', -100);
defined('FTP_ERR_CONFIG_OFF') or define('FTP_ERR_CONFIG_OFF', -101);#配置出错
defined('FTP_ERR_CONNECT_TO_SERVER') or define('FTP_ERR_CONNECT_TO_SERVER', -102);
defined('FTP_ERR_USER_NO_LOGGIN') or define('FTP_ERR_USER_NO_LOGGIN', -103);
defined('FTP_ERR_CHDIR') or define('FTP_ERR_CHDIR', -104);
defined('FTP_ERR_MKDIR') or define('FTP_ERR_MKDIR', -105);
defined('FTP_ERR_SOURCE_READ') or define('FTP_ERR_SOURCE_READ', -106);
defined('FTP_ERR_TARGET_WRITE') or define('FTP_ERR_TARGET_WRITE', -107);
defined('FTP_ERR_CHMOD') or define('FTP_ERR_CHMOD', -108);

class cftp {
	
	protected $_curErrCode = 0;
	
	private $connectid;
	private $enabled = false;
	private $config = array();
	
	function __construct($config = array()) {
		//验证参数
		if (!isset($config['on']) || !isset($config['host']) || !isset($config['username'])
			 || !isset($config['password']) || !isset($config['dir'])
			 || !isset($config['port']) || !isset($config['timeout'])
			 || !isset($config['ssl']) || !isset($config['pasv'])) {
			$this->setError(FTP_ERR_CONFIG_OFF);
		}

		$this->enabled = false;
		
		if (empty($config['on']) || empty($config['host'])) {#ftp开关，主机名
			$this->setError(FTP_ERR_CONFIG_OFF);
		} else {
			$this->config['on'] = intval($config['on']);
			$this->config['host'] = $this->clear($config['host']);
			$this->config['port'] = intval($config['port']);
			$this->config['ssl'] = intval($config['ssl']);
			$this->config['username'] = $this->clear($config['username']);
			$this->config['password'] = $this->clear($config['password']);
			$this->config['timeout'] = intval($config['timeout']);
			$this->config['dir'] = $this->clear($config['dir']);
			$this->config['pasv'] = $config['pasv'];
			$this->enabled = true;
		}
	}

	/**
	 * 上传文件
	 * @param $source string
	 * @param $target string
	 * @return bool
	 */
	public function upload($source, $target) {
		$this->setError(0);
		if(!$this->enabled || (!$this->connectid && $this->connect() <= 0)) {
			return 0;
		}
		if($this->getCurError()) {
			return 0;
		}
		$oldDir = $this->ftp_pwd();
		$dirname = dirname($target);
		$filename = basename($target);
		if(!$this->ftp_chdir($dirname)) {//更改目录失败
			if($this->ftp_mkdir($dirname)) {//创建目录
				//$this->ftp_chmod($dirname, '0755') or die(FTP_ERR_CHMOD);
				if(!$this->ftp_chdir($dirname)) {//更改目录
					$this->setError(FTP_ERR_CHDIR);
				}
			} else {
				$this->setError(FTP_ERR_MKDIR);
			}
		}

		$res = 0;
		if(!$this->getCurError()) {
			if($fp = @fopen($source, 'rb')) {//打开文件
				$res = $this->ftp_fput($filename, $fp, FTP_BINARY);#上传文件
				@fclose($fp);
				!$res && $this->setError(FTP_ERR_TARGET_WRITE);
			} else {
				$this->setError(FTP_ERR_SOURCE_READ);
			}
		}

		$this->ftp_chdir($oldDir);

		return $res ? 1 : 0;
	}
	
	/**
	 * 获得当前错误代码
	 * @return int
	 */
	public function getCurError() {
		return $this->_curErrCode;
	}

	/**
	 * 连接ftp服务器
	 * @return recourse
	 */
	public function connect() {
		if($this->enabled) {
			return $this->ftp_connect(
				$this->config['host'],
				$this->config['username'],
				$this->config['password'],
				$this->config['dir'],
				$this->config['port'],
				$this->config['timeout'],
				$this->config['ssl'],
				$this->config['pasv']
				);
		} else {
			return 0;
		}
	}

	/**
	 * 连接ftp服务器
	 * @param $host string
	 * @param $username string
	 * @param $password string
	 * @param $path string
	 * @param $port int
	 * @param $timeout int
	 * @param $ssl int
	 * @param $pasv int
	 * @return recourse
	 */
	private function ftp_connect($host, $username, $password, $path, $port = 21, $timeout = 30, $ssl = 0, $pasv = 0) {
		$res = 0;
		$fun = $ssl && function_exists('ftp_ssl_connect') ? 'ftp_ssl_connect' : 'ftp_connect';
		if($this->connectid = $fun($host, $port, 20)) {#连接ftp服务器

			$timeout && $this->ftp_set_option(FTP_TIMEOUT_SEC, $timeout);

			if($this->ftp_login($username, $password)) {#登录
				$this->ftp_pasv($pasv);
				if($this->ftp_chdir($path)) {#更改目录
					$res = $this->connectid;
				} else {
					$this->setError(FTP_ERR_CHDIR);
				}
			} else {
				$this->setError(FTP_ERR_USER_NO_LOGGIN);
			}

		} else {
			$this->setError(FTP_ERR_CONNECT_TO_SERVER);
		}

		if($res > 0) {
			$this->setError(0);
			$this->enabled = 1;
		} else {
			$this->enabled = 0;
			$this->ftp_close();
		}

		return $res;
	}
	
	/**
	 * 设置错误代码
	 */
	private function setError($errCode = 0) {
		$this->_curErrCode = $errCode;
	}

	/**
	 * 清楚字符串中回车符
	 * @param string
	 * @return string
	 */
	private function clear($str) {
		return str_replace(array( "\n", "\r", '..'), '', $str);
	}

	/**
	 * 设置ftp运行是选项
	 * return bool
	 */
	private function ftp_set_option($cmd, $value) {
		return @ftp_set_option($this->connectid, $cmd, $value);
	}

	/**
	 * 建立新目录
	 * @param string
	 * return bool
	 */
	public function ftp_mkdir($directory) {
		$directory = $this->clear($directory);
		$epath = explode('/', $directory);
		$dir = '';$comma = '';
		foreach($epath as $path) {
			$dir .= $comma.$path;
			$comma = '/';
			$return = @ftp_mkdir($this->connectid, $dir);
		}
		return $return;
	}

	/**
	 * 删除目录
	 * @param string
	 * return bool
	 */
	public function ftp_rmdir($directory) {
		$directory = $this->clear($directory);
		return @ftp_rmdir($this->connectid, $directory);
	}

	/**
	 * 上传文件
	 * @param $remoteFile string
	 * @param $localFile string
	 * @param $mode int
	 * return bool
	 */
	private function ftp_put($remoteFile, $localFile, $mode = FTP_BINARY) {
		$remoteFile = $this->clear($remoteFile);
		$localFile = $this->clear($localFile);
		$mode = intval($mode);
		return @ftp_put($this->connectid, $remoteFile, $localFile, $mode);
	}

	/**
	 * 上传文件
	 * @param $remoteFile string
	 * @param $sourcefp recourse
	 * @param $mode int
	 * return bool
	 */
	private function ftp_fput($remoteFile, $sourcefp, $mode = FTP_BINARY) {
		$remoteFile = $this->clear($remoteFile);
		$mode = intval($mode);
		return @ftp_fput($this->connectid, $remoteFile, $sourcefp, $mode);
	}

	/**
	 * 文件大小
	 * @param $remoteFile string
	 * return int
	 */
	public function ftp_size($remoteFile) {
		$remoteFile = $this->clear($remoteFile);
		return @ftp_size($this->connectid, $remoteFile);
	}

	/**
	 * 关闭ftp
	 * return bool
	 */
	public function ftp_close() {
		return @ftp_close($this->connectid);
	}

	/**
	 * 删除文件
	 * @param $path string
	 * return bool
	 */
	public function ftp_delete($path) {
		$path = $this->clear($path);
		return @ftp_delete($this->connectid, $path);
	}

	/**
	 * 下载文件
	 * @param $localFile string
	 * @param $remoteFile string
	 * @param $mode int
	 * @param $resumepos int
	 * return bool
	 */
	private function ftp_get($localFile, $remoteFile, $mode, $resumepos = 0) {
		$remoteFile = $this->clear($remoteFile);
		$localFile = $this->clear($localFile);
		$mode = intval($mode);
		$resumepos = intval($resumepos);
		return @ftp_get($this->connectid, $localFile, $remoteFile, $mode, $resumepos);
	}

	/**
	 * 登录
	 * @param $username string
	 * @param $password string
	 * return bool
	 */
	private function ftp_login($username, $password) {
		$username = $this->clear($username);
		$password = str_replace(array("\n", "\r"), array('', ''), $password);
		return @ftp_login($this->connectid, $username, $password);
	}

	/**
	 * 被动模式开关
	 * @param $pasv int
	 * return bool
	 */
	private function ftp_pasv($pasv) {
		return @ftp_pasv($this->connectid, $pasv ? true : false);
	}

	/**
	 * 改变路径
	 * @param $directory string
	 * return bool
	 */
	private function ftp_chdir($directory) {
		$directory = $this->clear($directory);
		return @ftp_chdir($this->connectid, $directory);
	}

	/**
	 * 发送site命令
	 * @param $cmd string
	 * return bool
	 */
	private function ftp_site($cmd) {
		$cmd = $this->clear($cmd);
		return @ftp_site($this->connectid, $cmd);
	}

	/**
	 * 设置权限
	 * @param $filename string
	 * @param $mod string
	 * return bool
	 */
	private function ftp_chmod($filename, $mod = '0777') {
		$filename = $this->clear($filename);
		if(function_exists('ftp_chmod')) {
			return @ftp_chmod($this->connectid, $mod, $filename);
		} else {
			return @ftp_site($this->connectid, 'CHMOD '.$mod.' '.$filename);
		}
	}

	/**
	 * 返回当前目录
	 * return string
	 */
	public function ftp_pwd() {
		return @ftp_pwd($this->connectid);
	}
	
	/**
	 * 把文件A移到文件B
	 * @param string $from
	 * @param string $to
	 * @return bool
	 */
	public function ftp_rename($from, $to) {
		return @ftp_rename($this->connectid, $from, $to);
	}
}
