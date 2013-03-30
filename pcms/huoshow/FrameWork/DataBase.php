<?php

/**
 * 数据库操作类
 *
 */

require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/configs/config.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Message.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/function.core.php");

Class DataBase
{
//------------------ This Content Include Private Variable -----------------//
//数据库类型
//DataBase Type
private $dbtype = '1';
private $database = '';
//数据库地址
//DataBase Host
private $dbhost = '192.168.2.172';
//数据库服务所使用端口
//DataBase Service Port
private $dbport = '3306';
//数据库是否允许永久连接
//Allow Physice Connect To DataBase 
private $pconnect = '2';
//转换数据库类型为中文 -----可扩展为语言包形式
//Translate DataBase Type For Chinese ---- It Can Extend Lang
private $dbtocn = '';
//数据库连接资源
//Connect DataBase Resource
private $dblink = '';
//选择数据库返回资源
//Select DataBase Back Resource
private $dbselect = '';
//数据库查询SQL语句
//Query DataBase SQL
private $sql = '';
//返回数据库查询资源
//Back DataBase Query Resource
private $query = '';
//返回数据库查询记录数目
//Back DataBase Query Records Number
private $num = 0;
//以数组形式返回数据库查询结果
//Back DataBase Query Result of Array
private $res_array = array();
//以对象形式返回数据库查询结果
//Back DataBase Query Result of Object
private $res_object = '';
//返回数据库最后一条插入记录操作的ID
//Get Last Insert Record ID
private $res_id = 0;
//访问类的属性时需要用到的两个变量，不可更改
//When Call Class Property Use Two Variable, Don't Modify
private $name = '';
private $value = '';

//设置时间及类型
private $exec_time = 0;
private $timetype = 1;
private $fmt_time = 1;
private $datetype='';
/*-----------------------------------------*/
//错误类型
//Error Type
//private $errortype = '';
//数据库错误
//DataBase Error
//private $dberror = '';
//数据库表错误
//Error DataBase Table
//private $tblerror = '';
//错误信息
//Error Info
private $error = '';
//管理员信息  你可以修改这里
//Administrator Info You Can Modify Here
private $admin = array('mail'=>'admin@huoshow.com','name'=>'Administrator');
//时区  你可以修改这里
//TimeZone You Can Modify Here
private $timezone = 8;
//时区参数  你可以修改这里
//TimeZone Parameter You Can Modify Here
private $time_zone_parameter = "Asia/Shanghai";
//调试
//Debug
private $debug=false;
//终止执行
//Exit exec programe if use Ajax Here will false;  Don't modify here  Use The Function
public $exec=true;
private $message;
/*-----------------------------------------*/
//链接方式
private $db = 1;
//--------------------This Content Include Public Variable --------------//
//数据库帐号名
//DataBase UserName
public $dbuser = 'root';
//数据库密码
//DataBase Password
public $dbpswd = '123456';
//数据库名
//DataBase Name
public $dbname = 'huoshow_beta';

/*//如果数据库名为数组则下面为其键名与值
public $dbaryname = array();
private $dbkey = '';
private $dbval = '';*/
//数据库连接使用字符集
//Charset Of DataBase Connect
public $charset = 'utf8';
//------------------- Function ----------------------//
function __construct($dbinfo)
{
	global $SYSCONFIG;
  $this->db = empty($dbinfo['type'])?$this->db:$dbinfo['type'];
  $this->dbhost = empty($dbinfo['host'])?GLOBAL_MYSQL_IP:$dbinfo['host'];
  $this->dbuser = empty($dbinfo['user'])?GLOBAL_MYSQL_USER:$dbinfo['user'];
  $this->dbport = empty($dbinfo['port'])?$this->dbport:$dbinfo['port'];
  $this->dbpswd = empty($dbinfo['pswd'])?GLOBAL_MYSQL_PWD:$dbinfo['pswd'];
  //die("sss:".$SYSCONFIG["MYsqlDataBase"]);
  
  $this->dbname = empty($dbinfo['name'])?$SYSCONFIG["MYsqlDataBase"]:$dbinfo['name'];
  //$this->pconnect = empty($dbinfo['pcon'])?$this->pconnect:$dbinfo['pcon'];
  
  $this->pconnect = 2;//1,长连接；2，用mysqli
  $this->charset = empty($dbinfo['char'])?$this->charset:$dbinfo['char'];
  $this->database = $this->__get_DataBase();
  $this->message = new CMessage();
}
function __destruct()
{
  switch($this->db)
  {
   case 1:
    if($this->pconnect!=1)
    {
    	
    	if($this->pconnect==2 && !empty($this->dblink))
    		$this->dblink->close();
    	else 
    		@mysql_close();
    }
   break;
   default:
    
   break;
  }
}
//获取数据库类型，私有函数
private function __get_DataBase()
{
  switch($this->db)
  {
   case 1:
    $this->dbtocn = 'MySql';
   break;
   default:
   break;
  }
  return $this->dbtocn;
}
//连接数据库，公有函数
public function connect()
{
  switch($this->db)
  {
   case 1:
    if($this->pconnect==1)
    {
     $this->dblink =mysql_pconnect($this->dbhost.':'.$this->dbport,$this->dbuser,$this->dbpswd) or $this->__get_error(mysql_errno());
    }
    elseif ($this->pconnect==2)
    {
    	$this->dblink = new mysqli($this->dbhost, $this->dbuser, $this->dbpswd, $this->dbname,$this->dbport);
		if (mysqli_connect_errno()) 
		{
			$this->message->showMessage(0,"数据库操作失败:$sql<br>".mysqli_connect_error(),NULL);
		}
    }
    else
    {
     $this->dblink = mysql_connect($this->dbhost.':'.$this->dbport,$this->dbuser,$this->dbpswd) or $this->__get_error(mysql_errno());
    }
   break;
   default:
   break;
  }
  return $this->dblink;
} 

//关闭数据库连接
public function dbclose()
{

  switch($this->db)
  {
   case 1:
    if($this->pconnect!=1)
    {
    	if($this->pconnect==2 && !empty($this->dblink))
    	{
    		 $this->dblink->close();
    		 $this->dblink = null;
    	}
    	else
    		 mysql_close();
    }
   break;
   default:
   break;
  }
  //var_dump($this->dblink);
}
//选择数据库，公有函数
public function select()
{
  switch($this->db)
  {
   case 1:
   		if($this->pconnect==2)
   		{
   			$this->dblink->set_charset($this->charset);
   			$this->dbselect =  $this->dblink->select_db($this->dbname);
   		}
   		else 
   		{
   			  mysql_query("set names '".$this->charset."'");
   			 $this->dbselect = mysql_select_db($this->dbname,$this->dblink) or $this->__get_error(mysql_errno());
   		}
   	 break;
   default;
   break;
  }
  
  return $this->dbselect;
}

public function mysql_escape_string($str)
{
	switch($this->db)
	{
		case 2:
			return $this->dblink->real_escape_string($str);
			break;
		default:
			return mysql_real_escape_string($str);
	}
}

//返回查询数据资源，公有函数
public function query($sql)
{
  $this->sql=$sql;
  if(!$this->dblink)
  {
   $this->connect();
   $this->select();
  }
  switch($this->db)
  {
   case 1:
   	if($this->pconnect==2)
   	{
   		$this->__get_sql();
   		$this->query = $this->dblink->query($sql);
   		//$this->dblink->query("INSERT INTO `pre_run_sql_log` SET `sql`='".addslashes($sql)."'");
   	}
   	else {
	    $this->__get_sql();
	    //dg($this->dbname,"数据库名称");
	    $this->query = mysql_query($sql);
	    //die("sss:".$sql);
   	}
   break;
   default:
   break;
  }
  if(!$this->query)
  	$this->message->showMessage(0,"数据库操作失败","$sql <br>info:".$this->dblink->error);
  return $this->query;
}

//返回数据库查询记录数目，公有函数
public function query_num($query)
{
	switch ($this->pconnect)
	{
		case 2:
			$this->num = $this->dblink->num_rows;
			break;
		default:
			$this->num = mysql_num_rows($query);
			break;
	}
     
 	 return $this->num;
}


/**
 * 返回数据库查询记录数目，公有函数
 *
 * @param unknown_type $sql 查询sql语句
 * @param unknown_type $state 查询状态 0：常规查询；1：第0个数组是统计信息，其中num为查询的结果数
 * @return unknown
 */
public function getRow($sql,$state=0)
{
	
	$res = $this->query($sql);
	$res_array[0]["num"] = 0;
	switch ($state)
	{
		case 0:
			$res_array=$this->query_array($res) or $this->__get_error($this->dblink->errno);
			break;
		case 1:
			$res_array[]=$this->query_array($res) or $this->__get_error($this->dblink->errno);
			$res_array[0]["num"] = $this->query_num($res);
			break;
	}
	//$this->dbclose();
	return $res_array;
}

//以数组的形式返回数据库查询结果
//Query DataBase Record Method Array
public function query_array($query)
{
	$this->res_array = null;
	$i = 0;
  switch($this->db)
  {
   case 1:
   		if($this->pconnect==2)
   		{
   			$query->data_seek(0);
   			while ($temp=$query->fetch_array())
			{
				
			 	$this->res_array[$i]=$temp;$i++;
			}
   		}
   		else 
   		{
   			  while ($temp=mysql_fetch_array($query)) 
			   {
			   		$this->res_array[$i]=$temp;$i++;
			   }
   		}
	 
   break;
   default:
   break;
  }
  return $this->res_array;
}
//以对象形式返回数据库查询结果
//Query DataBase Record Method Object
public function query_object($query)
{
	if($this->pconnect==2)
  	{
  		$this->res_object = $this->dblink->fetch_object();
  		return $this->res_object;
  	}
  switch($this->db)
  {
  	
   case 1:
    if($this->exec)
    {
     $this->res_object = @mysql_fetch_object($query) or $this->__get_error(mysql_errno());
    }
    else
    {
     $this->res_object = @mysql_fetch_object($query);
    }
   break;
   default:
   break;
  }
  return $this->res_object;
}
//获取最后一次数据库插入记录的ID
//Get Last Insert Record ID
public function get_id()
{
	if($this->pconnect==2)
  	{
  		return $this->dblink->insert_id;
  	}
  switch($this->db)
  {
   case 1:
    $this->res_id = mysql_insert_id() or $this->__get_error(mysql_errno());
   break;
   default:
   break;
  }
  return $this->res_id;
}
/**
 * 库中是否存在表
 *
 * @param unknown_type $table_name
 * @return unknown
 */
public function table_exist($table_name)
{
	$sql = "SELECT * FROM `information_schema`.`TABLES` WHERE TABLE_SCHEMA='$this->dbname' AND TABLE_NAME ='$table_name'";
	$result = $this->getRow($sql);
	if ($result)
		return true;
	return false;
}
/**
 * 表中是否存在列
 *
 * @param unknown_type $table_name
 * @param unknown_type $column
 * @return unknown
 */
public function column_exist($table_name,$column)
{
	$sql = "SELECT * FROM `information_schema`.`COLUMNS` WHERE TABLE_SCHEMA='$this->dbname' AND TABLE_NAME ='$table_name' AND COLUMN_NAME='$column'";
	$result = $this->getRow($sql);
	if ($result)
		return true;
	return false;
}
public function free_result($query)
{
	if($this->pconnect==2)
  	{
  		$this->dblink->free();
  		return true;
  	}
  switch($this->db)
  {
   case 1:
    @mysql_free_result($query);
   break;
   default;
   break;
  }
  return true;
}

//跟踪数据库查询，私有函数
private function __get_sql()
{
  if($this->debug)
  {
   print $this->sql."<br />";
  }
}
//获取错误信息
private function __get_error($error)
{
  if(!$error)
  {
   return;
  }
  
  if($this->pconnect==2)
  {
  	$str = $this->dblink->error;
  }
  else
 	 $str = mysql_error();
 	 
  switch($error)
  {
   case 1130:
    $msg='Connect "'.$this->database.'" Failed!  "'.$this->database.'" May Be Not Install at Host:"'.$this->dbhost.'"';
   break;
   case 2003:
    $msg='Connect "'.$this->database.'" Failed!  "'.$this->database.'" May Be Not Install at Host:"'.$this->dbhost.'" Port:"'.$this->dbport.'"';
   break;
   default:
    $msg=$this->database.' '.$str;
   break;
  }
  $this->message->showMessage(0,"数据库错误",$msg);
  //return false;
  //return $this->__format_error($msg);
}
//格式化错误信息
private function __format_error(&$msg)
{
  print "<style type=\"text/css\">\r\n";
  if($this->exec)
  {
   exit;
  }
}
//格式化时间
private function __format_date($fmt_time)
{
  switch($fmt_time)
  {
   case 1:
    $this->datetype = date("D M j G:i:s  Y",$this->__get_date());
   break;
   case 2:
    $this->datetype = date("Y-n-j H:i:s",$this->__get_date());
   break;
   default;
  }
  return $this->datetype;
}
//获取时间
private function __get_date()
{
  switch($this->timetype)
  {
   case 1:
    $this->exec_time = time();
   break;
   case 2:
    $this->exec_time = microtime();
   break;
   default;
  }
  
  //获取时区
  if(date_default_timezone_get()!=$this->time_zone_parameter)
  {
   return $this->exec_time+$this->timezone*3600;
  }
  else
  {
   return $this->exec_time;
  }
}
//读取类的属性
public function __get($name)
{
  return $this->$name;
}
//设置类属性
public function __set($name,$value)
{
  return $this->$name=$value;
}
}



/*------------ Example For This Class ------------------
//$dbinfo类型数组，数据库信息

//You Can Modify This File If It Have Flag
//You Can Modify This
$dbinfo['type'] = '1';     //数据库类型  1为mysql 2为pgsql
//You Can Modify This
//$dbinfo['host'] = '192.168.3.107';   //数据库地址
//You Can Modify This
$dbinfo['port'] = '3306';    //数据库使用端口
//You Can Modify This
$dbinfo['pcon'] = '0';     //是否允许永久连接 0为不允许1为允许
//Please Don't Modify This
$dbinfo['char'] = 'utf8';    //数据库连接类型
//You Can Modify This
//$dbinfo['user'] = 'db_count';    //数据库帐号
$dbinfo['user'] = '';    //数据库帐号
//You Can Modify This
$dbinfo['pswd'] = '';    //数据库密码
//You Can Modify This
//数据库名称
$dbinfo['name'] = 'db_count';
//以上可以写入某个config文件中


$db=new DataBase($dbinfo);
//发出查询请求
$que=$db->query("select * from db_user where 1");
//以数组的形式返回查询结果，需要循环显示
$array=$db->query_array($que);
//以对象的形式返回查询结果，需要循环显示
$object=$db->query_object($que);
//获取查询记录的数目
$num=$db->query_num($que);
//获取最后操作插入的ID
$num=$db->get_id();
*/


?>