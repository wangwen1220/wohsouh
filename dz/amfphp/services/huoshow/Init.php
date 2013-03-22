<?php
include("inc.php");
class Init{
	private $CONN;
	public function __construct(){
		try {
			$conn = mysql_connect(ServerName,UserName,PassWord);		
		}catch(Exception $e){
			$msg = $e;
			include(ERR);
		}
		try{
			mysql_select_db(DBName,$conn);
			mysql_query("set names utf8");
		}catch(Exception $e){
			$msg = $e;
			include(ERR);
		}
		
		$this->CONN = $conn;
	}
	
	//查询
	public function select($sql=""){
		if(empty($sql)) return 1;
		if(empty($this->CONN)) return 2;
		try{
			$result = mysql_query($sql);
		}catch(Exception $e){
			$msg = $e;
			include(ERR);
		}
		if((!$result) or empty($result)){
			@mysql_free_result($result);
			echo mysql_error();
			return mysql_error();
		}
		
		$cont = 0;
		$array = array();
	   
		while($row = @mysql_fetch_array($result)){
			$array[$cont]=$row;
			$cont++;
		}
		for($i=0;$i<count($array);$i++){
			//$array[$i]['uid']=$i;
			//array_push($array,$array[$i]['uid']);
		}
		@mysql_free_result($result);
		return $array;	
	}
	//添加
	public function insert($sql=""){
		if(empty($sql)) return false;
		if(empty($this->CONN)) return false;
		try{
			$result = mysql_query($sql);
			
		}catch(Expction $e){
			
			$msg = $e;
			include(ERR);
		}
		
		if(!$result){
			return mysql_error();
		}else{
		    $id = @mysql_insert_id($this->CONN);
			return $id;
		}
	}
	
	
    //修改
	
	public function update($sql=""){
		if(empty($sql)) return false;
		if(empty($this->CONN)) return false;
		try{
			$result = mysql_query($sql,$this->CONN);
			//echo 11;
		}catch(Exception $e){
			$msg = $e;
			include(ERR);
		}
		if($result){
			return 1;
		}else{
			echo "2";
		    return mysql_error();
		}
		
	}
	
	
	//删除
	
	public function delete($sql=""){
		if(empty($sql)) return false;
		if(empty($this->CONN)) return false;
		try{
			$result = mysql_query($sql,$this->CONN);
		}catch(Exception $e){
			$msg = $e;
			include(ERR);
		}
	    if($result){
			return 1;
		}else{
		    return mysql_error();
		}
		
	}
	
	//定义事物
	public function Things(){
		mysql_query("SET AUTOCOMMIT=0");//设置为不自动提交，因为MYSQL默认是自动提
		mysql_query("BENIG");//开始事务定义
	}
	
	//定义回滚
	public function roolback(){
		mysql_query("ROOLBACK");
	}
	
	//提交执行
	public function commit(){
		mysql_query("COMMIT");
	}
	
	//向指定表查询数据
	public function selectInit($name,$tiaojian,$id){
		$sql = "select * from " .$name. " where " .$tiaojian. " = '$id'";
		//echo $sql;
		$r = $this->select($sql);
		return $r;
	}
	
	//向指定表查询数据
	public function twoselectInit($name,$tiaojian,$id,$tiaojian1,$id1){
		$sql = "select * from " .$name. " where " .$tiaojian. " = '$id' and " .$tiaojian1. "
		= '$id1' order by id desc";
		//echo $sql;
		$r = $this->select($sql);
		return $r;
	}
	//向指定表查询数据
	public function sanselectInit($name,$tiaojian,$id,$tiaojian1,$id1,$tiaojian2,$id2){
		$sql = "select * from " .$name. " where " .$tiaojian. " = '$id' and " .$tiaojian1. "
		= '$id1' and " .$tiaojian2. "= '$id2'  order by id desc" ;
		//echo $sql;
		$r = $this->select($sql);
		return $r;
	}
	
	//向指定表添加数据
	public function insertInit($name,$date){
		$field = implode(",",array_keys($date));
		$i=0;
		$values = "";
		foreach($date as $keys => $val){
			$values.= "'" .$val. "'";
			if($i< count($date) -1){
				$values.= ",";
				$i++;
			}
		}
		 $sql = "insert into ".$name."(" .$field. ") values (" .$values. ")";
		// echo $sql;
		return $this->insert($sql);
		
	}
	
	//向指定的表修改数据
	public function updateInit($id,$name,$date){
		$r = array();
		foreach($date as $keys => $val){
			$r[] = $keys."='" .$val. "'";
		}
		$sql = " update " .$name. " set " .implode(",",$r). " where id = $id";
		
		//echo $sql;
		
		return $this->update($sql);
	}
	
	//向指定的表修改数据升级
	public function twoupdateInit($name,$date,$tiaojian,$id){
		$r = array();
		foreach($date as $keys => $val){
			$r[] = $keys."='" .$val. "'";
		}
		$sql = " update " .$name. " set " .implode(",",$r). " where ".$tiaojian." = '$id'";
		
		//echo $sql;
		
		return $this->update($sql);
	}
	
	//向指定的表删除数据
	public function deleteInit($name,$tiaojian,$id){
		
		$sql = "delete from " .$name. " where " .$tiaojian. " = '$id'";
		
		return $this->delete($sql);
	}
}


?>