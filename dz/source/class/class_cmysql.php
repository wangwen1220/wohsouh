<?php
/**
 * MYSQL类
 * 
 * 注意：要求mysql > 5.0.1 
 * @author ZhangChengJun
 */

class cmysql {

	public $debug = false;
	
	private $tablePre;
	private $queryNum = 0;
	private $link = null;
	private $config = array();
	private $sqlDebug = array();
	
	function __construct($config = array()) {
		if(!empty($config)) {
			$this->setConfig($config);
		}
	}

	/**
	 * 设置配置
	 * @param $config array
	 */
	public function setConfig($config) {
		$this->config = $config;
		$this->tablePre = $config['tablepre'];
	}

	/**
	 * 连接数据库
	 * @return resource
	 */
	public function connect() {

		if(empty($this->config)) {
			$this->halt('config_db_not_found');
		}

		$this->link = $this->dbconnect(
			$this->config['host'],
			$this->config['user'],
			$this->config['password'],
			$this->config['charset'],
			$this->config['dbname'],
			$this->config['pconnect']
		);
		
		return $this->link;
	}

	/**
	 * 选择数据库
	 * @param $dbname string
	 * @return bool
	 */
	public function selectDB($dbname) {
		return mysql_select_db($dbname, $this->link);
	}

	/**
	 * 表名
	 * @param $tableName string
	 */
	public function tableName($tableName) {
		return $this->tablePre.$tableName;
	}

	public function fetchArray($query, $result_type = MYSQL_ASSOC) {
		return mysql_fetch_array($query, $result_type);
	}

	public function fetchFirst($sql) {
		return $this->fetchArray($this->query($sql));
	}

	public function resultFirst($sql) {
		return $this->result($this->query($sql), 0);
	}

	public function query($sql, $type = '') {

		if($this->debug) {
			$starttime = dmicrotime();
		}
		$func = $type == 'UNBUFFERED' && @function_exists('mysql_unbuffered_query') ?
		'mysql_unbuffered_query' : 'mysql_query';
		if(!($query = $func($sql, $this->link))) {
			if(in_array($this->errNo(), array(2006, 2013)) && substr($type, 0, 5) != 'RETRY') {
				$this->connect();
				return $this->query($sql, 'RETRY'.$type);
			}
			if($type != 'SILENT' && substr($type, 5) != 'SILENT') {
				$this->halt('query_error', $sql);
			}
		}

		if($this->debug) {
			$this->sqlDebug[] = array($sql, number_format((dmicrotime() - $starttime), 6), debug_backtrace());
		}

		$this->queryNum++;
		return $query;
	}

	public function affectedRows() {
		return mysql_affected_rows($this->link);
	}

	public function error() {
		return (($this->link) ? mysql_error($this->link) : mysql_error());
	}

	public function errNo() {
		return intval(($this->link) ? mysql_errno($this->link) : mysql_errno());
	}

	public function result($query, $row = 0) {
		$query = @mysql_result($query, $row);
		return $query;
	}

	public function numRows($query) {
		$query = mysql_num_rows($query);
		return $query;
	}

	public function numFields($query) {
		return mysql_num_fields($query);
	}

	public function freeResult($query) {
		return mysql_free_result($query);
	}

	public function insertID() {
		return ($id = mysql_insert_id($this->link)) >= 0 ? $id : $this->result($this->query("SELECT last_insert_id()"), 0);
	}

	public function fetchRow($query) {
		$query = mysql_fetch_row($query);
		return $query;
	}

	public function fetchFields($query) {
		return mysql_fetch_field($query);
	}

	public function close() {
		return mysql_close($this->link);
	}

	/**
	 * 连接数据库
	 * @param $host string
	 * @param $user string
	 * @param $password string
	 * @param $charset string
	 * @param $dbname string
	 * @param $pconnect int
	 * @return resource
	 */
	private function dbconnect($host, $user, $password, $charset, $dbname, $pconnect) {
		$link = null;
		$func = empty($pconnect) ? 'mysql_connect' : 'mysql_pconnect';
		if(!$link = @$func($host, $user, $password, 1)) {
			$this->halt('notconnect');
		} else {
			$serverset = $charset ? 'character_set_connection='.$charset.', character_set_results='.$charset.', character_set_client=binary' : '';
			$serverset .= ((empty($serverset) ? '' : ',').'sql_mode=\'\'');
			$serverset && mysql_query("SET $serverset", $link);
			
			$dbname && @mysql_select_db($dbname, $link);
		}
		return $link;
	}

	private function halt($message = '', $sql = '') {
		die($message.'-'.$sql);
	}	
}

class CDB
{
	function table($table) {
		$a = & CDB::object();
		return $a->tableName($table);
	}

	function delete($table, $condition, $limit = 0, $unbuffered = true) {
		if(empty($condition)) {
			$where = '1';
		} elseif(is_array($condition)) {
			$where = DB::implode_field_value($condition, ' AND ');
		} else {
			$where = $condition;
		}
		$sql = "DELETE FROM ".DB::table($table)." WHERE $where ".($limit ? "LIMIT $limit" : '');
		return DB::query($sql, ($unbuffered ? 'UNBUFFERED' : ''));
	}

	function insert($table, $data, $return_insert_id = false, $replace = true, $silent = false) {

		$sql = DB::implode_field_value($data);

		$cmd = $replace ? 'REPLACE INTO' : 'INSERT IGNORE INTO';

		$table = DB::table($table);
		$silent = $silent ? 'SILENT' : '';

		$return = DB::query("$cmd $table SET $sql", $silent);

		return $return_insert_id ? DB::insert_id() : $return;

	}

	function update($table, $data, $condition, $unbuffered = false, $low_priority = false) {
		$sql = DB::implode_field_value($data);
		$cmd = "UPDATE ".($low_priority ? 'LOW_PRIORITY' : '');
		$table = DB::table($table);
		$where = '';
		if(empty($condition)) {
			$where = '1';
		} elseif(is_array($condition)) {
			$where = DB::implode_field_value($condition, ' AND ');
		} else {
			$where = $condition;
		}
		
		$res = DB::query("$cmd $table SET $sql WHERE $where", $unbuffered ? 'UNBUFFERED' : '');
		return $res;
	}

	function implode_field_value($array, $glue = ',') {
		$sql = $comma = '';
		foreach ($array as $k => $v) {
			$sql .= $comma."`$k`='$v'";
			$comma = $glue;
		}
		return $sql;
	}

	function insert_id() {
		$db = & DB::object();
		return $db->insertID();
	}

	function fetch($resourceid) {
		$db = & DB::object();
		return $db->fetchArray($resourceid);
	}

	function fetch_first($sql) {
		$db = & DB::object();
		return $db->fetchFirst($sql);
	}

	function result($resourceid, $row = 0) {
		$db = & DB::object();
		return $db->result($resourceid, $row);
	}

	function result_first($sql) {
		$db = & DB::object();
		return $db->resultFirst($sql);
	}

	function query($sql, $type = '') {
		$db = & DB::object();
		return $db->query($sql, $type);
	}

	function num_rows($resourceid) {
		$db = & DB::object();
		return $db->numRows($resourceid);
	}

	function affected_rows() {
		$db = & DB::object();
		return $db->affectedRows();
	}

	function free_result($query) {
		$db = & DB::object();
		return $db->freeResult($query);
	}

	function error() {
		$db = & DB::object();
		return $db->error();
	}

	function errno() {
		$db = & DB::object();
		return $db->errNo();
	}

	function &object() {
		static $db;
		if(empty($db)) {
			$db = new cmysql();
		}
		return $db;
	}
}
?>