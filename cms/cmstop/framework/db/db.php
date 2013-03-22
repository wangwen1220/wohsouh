<?php

class db extends PDO
{
	static $queries = 0;
	public $options = array(), $charset, $sql;
	private $sth, $error, $errno;
	protected $_transCount = 0;

	public function __construct($dsn, $username = NULL, $password = NULL, $driver_options = array())
	{
		try 
		{
		    $dbh = parent::__construct($dsn, $username, $password, $driver_options);
		} 
		catch (PDOException $e) 
		{
		    echo 'DB connection failed : '.$e->getMessage();exit;
		}
	}

	public function set_charset($charset)
	{
		$this->charset = $charset;
		$version = $this->version();
		if ($version > '4.1') $this->exec("SET character_set_connection='$charset',character_set_results='$charset',character_set_client=binary".($version > '5.0.1' ? ",sql_mode=''" : ''));
	}

	public static function &get_instance($options = array())
	{
		static $instance;
		$key = implode('', $options);
		if (!isset($instance[$key]))
		{
			if(!isset($options['driver'])) $options['driver'] = 'mysql';
			if(!isset($options['host'])) $options['host'] = 'localhost';
			if(!isset($options['port'])) $options['port'] = 3306;
			if(!isset($options['charset'])) $options['charset'] = 'utf8';
			if(!isset($options['dbname'])) $options['dbname'] = 'cmstop';
			if(!isset($options['username'])) $options['username'] = 'root';
			if(!isset($options['password'])) $options['password'] = '';
			if(!isset($options['pconnect'])) $options['pconnect'] = '0';
			if(!isset($options['prefix'])) $options['prefix'] = 'cmstop_';
			
			$instance[$key] = new db($options['driver'].':host='.$options['host'].';port='.$options['port'].';dbname='.$options['dbname'].';charset='.$options['charset'], $options['username'], $options['password'], array(PDO::ATTR_PERSISTENT => ($options['pconnect'] ? true : false)));
			$instance[$key]->options = $options;
			$instance[$key]->set_charset($options['charset']);
		}
		return $instance[$key];
	}

	public function exec($statement)
	{
		return parent::exec($this->_sql($statement));
	}

	public function prepare($statement, $driver_options = array())
	{
		return parent::prepare($this->_sql($statement), $driver_options);
	}

	public function query($statement)
	{
		$num = func_num_args();
		if ($num == 1)
		{
			return parent::query($this->_sql($statement));
		}
		elseif ($num == 2)
		{
			return parent::query($this->_sql($statement), func_get_arg(1));
		}
		elseif ($num == 3)
		{
			return parent::query($this->_sql($statement), func_get_arg(1), func_get_arg(2));
		}
	}

	public function get($sql, $data = array(), $fetch_style = PDO::FETCH_ASSOC)
	{
		$db = $this->prepare($sql);
		if(!$db) return false;
		if ($db->execute($data))
		{
			return $db->fetch($fetch_style);
		}
		else
		{
			$this->errno = $db->errorCode();
			$this->error = $db->errorInfo();
			return false;
		}
	}

	public function select($sql, $data = array(), $fetch_style = PDO::FETCH_ASSOC)
	{
		$db = $this->prepare($sql);
		if(!$db) return false;
		if ($db->execute($data))
		{
			return $db->fetchAll($fetch_style);
		}
		else
		{
			$this->errno = $db->errorCode();
			$this->error = $db->errorInfo();
			return false;
		}
	}

	public function insert($sql, $data = array(), $multiple = false)
	{
		$db = $this->prepare($sql);
		if(!$db) return false;
		if (empty($data))
		{
			if ($db->execute())
			{
				$insertid = $this->lastInsertId();
				return $insertid ? $insertid : true;
			}
			else 
			{
				$this->errno = $db->errorCode();
				$this->error = $db->errorInfo();
				return false;
			}
		}
		if($multiple)
		{
			foreach ($data as $r)
			{
				$this->_bindValue($db, $r);
				if (!$db->execute())
				{
					$this->errno = $db->errorCode();
					$this->error = $db->errorInfo();
					return false;
				}
			}
			return true;
		}
		else
		{
			$this->_bindValue($db, $data);
			if ($db->execute())
			{
				$insertid = $this->lastInsertId();
				return $insertid > 0 ? $insertid : true;
			}
			else 
			{
				$this->errno = $db->errorCode();
				$this->error = $db->errorInfo();
				return false;
			}
		}
	}

	public function update($sql, $data = array(), $multiple = false)
	{
		$db = $this->prepare($sql);
		if(!$db) return false;
		if (empty($data))
		{
			if ($db->execute())
			{
				$rowcount = $db->rowCount();
				return $rowcount ? $rowcount : true;
			}
			else 
			{
				$this->errno = $db->errorCode();
				$this->error = $db->errorInfo();
				return false;
			}
		}
		if($multiple)
		{
			foreach ($data as $r)
			{
				$this->_bindValue($db, $r);
				if (!$db->execute())
				{
					$this->errno = $db->errorCode();
					$this->error = $db->errorInfo();
					return false;
				}
			}
			return true;
		}
		else
		{
			$this->_bindValue($db, $data);
			if ($db->execute())
			{
				$rowcount = $db->rowCount();
				return $rowcount ? $rowcount : true;
			}
			else 
			{
				$this->errno = $db->errorCode();
				$this->error = $db->errorInfo();
				return false;
			}
		}
	}

	public function replace($sql, $data = array(), $multiple = false)
	{
		return $this->update($sql, $data = array(), $multiple = false);
	}

	public function delete($sql, $data = array())
	{
		$db = $this->prepare($sql);
		if(!$db) return false;
		if ($db->execute($data))
		{
			$rowcount = $db->rowCount();
			return $rowcount ? $rowcount : true;
		}
		else
		{
			$this->errno = $db->errorCode();
			$this->error = $db->errorInfo();
			return false;
		}
	}

	public function limit($sql, $limit = 0, $offset = 0, $data = array(), $fetch_style = PDO::FETCH_ASSOC)
	{
		if ($limit > 0) $sql .= $offset > 0 ? " LIMIT $offset, $limit" : " LIMIT $limit";
		return $this->select($sql, $data, $fetch_style);
	}

	public function page($sql, $page = 1, $size = 20, $data = array(), $fetch_style = PDO::FETCH_ASSOC)
	{
		$page = isset($page) ? max(intval($page), 1) : 1;
		$size = max(intval($size), 1);
		$offset = ($page-1)*$size;
		return $this->limit($sql, $size, $offset, $data, $fetch_style);
	}

	public function select_db($dbname)
	{
		return $this->exec("USE $dbname");
	}

	public function list_fields($table, $field = null)
	{
		$sql = "SHOW COLUMNS FROM `$table`";
		if ($field) $sql .= " LIKE '$field'";
		return $this->select($sql);
	}

	public function list_tables($dbname = null)
	{
		$tables = array();
		$sql = $dbname ? "SHOW TABLES FROM `$dbname`" : "SHOW TABLES";
		$result = $this->select($sql);
		foreach ($result as $r)
		{
			foreach ($r as $table) $tables[] = $table;
		}
		return $tables;
	}

	public function list_dbs()
	{
		$dbs = array();
		$result = $this->select("SHOW DATABASES");
		foreach ($result as $r)
		{
			foreach ($r as $db) $dbs[] = $db;
		}
		return $dbs;
	}

	public function get_primary($table)
	{
		$primary = array();
		$result = $this->query("SHOW COLUMNS FROM `$table`");
		foreach ($result as $r)
		{
			if($r['Key'] == 'PRI') $primary[] = $r['Field'];
		}
		return count($primary) == 1 ? $primary[0] : (empty($primary) ? null : $primary);
	}

	public function get_var($var = null)
	{
		$variables = array();
		$sql = is_null($var) ? '' : " LIKE '$var'";
		$result = $this->query("SHOW VARIABLES $sql");
		foreach ($result as $r)
		{
			if(!is_null($var) && isset($r['Value'])) return $r['Value'];
			$variables[$r['Variable_name']] = $r['Value'];
		}
		return $variables;
	}

	public function version()
	{
		$db = $this->query("SELECT version()");
		return $db ? $db->fetchColumn(0) : false;
	}

	public function prefix()
	{
		return $this->options['prefix'];
	}
	
	public function errno()
	{
		return is_null($this->errno) ? parent::errorCode() : $this->errno;
	}

	public function error()
	{
		if (is_null($this->error))
		{
			return parent::errorInfo();
		}
		else 
		{
			$this->error['sql'] = $this->sql;
			return $this->error;
		}
	}

	private function _sql($sql)
	{
		self::$queries++;
		$this->sql = str_replace('#table_', $this->options['prefix'], $sql);
		return $this->sql;
	}

	private function _bindValue(& $db, $data)
	{
		if (!is_array($data)) return false;
		foreach ($data as $k=>$v)
		{
			$k = is_numeric($k) ? $k+1 : ':'.$k;
			$db->bindValue($k, $v);
		}
		return true;
	}
	
	public function beginTransaction()
	{
		if ($this->_transCount == 0)
		{
			parent::beginTransaction();
		}
		$this->_transCount++;
	}
	
	public function commit()
	{
		if ($this->_transCount == 0) return;
		$this->_transCount--;
		if ($this->_transCount == 0)
		{
			parent::commit();
		}
	}
	
	public function rollBack()
	{
		if ($this->_transCount == 0) return;
		$this->_transCount--;
		if ($this->_transCount == 0)
		{
			parent::rollBack();
		}
	}
}
