<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('admin','admin',0);
pc_base::load_app_class('gamenum','gamenum',0);
pc_base::load_sys_class('form', '', 0);
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/function.core.php";
require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php";
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/phpExcelReader/Excel/reader.php";
class gamenum extends admin {
	protected  $db;
	public function __construct() {
		//parent::__construct();
		$this->db=pc_base::load_model('gamenum_model');
	}
	public function init() {
		die();
	}
	
	
	public function gamenum_list(){
		//查询游戏列表
		$sql = "SELECT id,gamename,inputtime FROM v9_special_game";
		$result = $this->db->sselect($sql);
		for($i=0;$i<count($result);$i++){
			$id= $result[$i]['id'];
			//查询游戏已发号
		$sql = "select count(b.gameid) as usenum from v9_special_game a 
				inner join v9_special_gamenum b 
				on a.id=b.gameid 
				where b.isuse=1 and a.id=$id";
		$temp = $this->db->sselect($sql);
		$result[$i]['usenum']=$temp[0]['usenum'];
		//查询游戏未发号
		$sql = "select count(b.gameid) as nousenum from v9_special_game a 
				inner join v9_special_gamenum b 
				on a.id=b.gameid 
				where b.isuse=0 and a.id=$id";
		$temp = $this->db->sselect($sql);
		$result[$i]['nousenum']=$temp[0]['nousenum'];
		}
		$page = empty($_GET['page']) ? '1':$_GET['page'];
		$page_split = new PagerSplit(count($result),$page);
		$page_str = $page_split->GetPagerContent();
		include $this->admin_tpl('gamenum_list');
	}
	public function addgame(){
		if($_GET['add']=="yes"){
			$gamename= $_POST['gamename'];
			$specilaid = $_POST['specialid'];
			if($gamename == ""){
				echo "<script>";
 				echo "alert('游戏名称不能为空！');window.location.href='/?m=gamenum&c=gamenum&a=gamenum_list'";
				echo "</script>";
				die();
			}
			$time = date('Y-m-d H:i:s');
			$sql = "INSERT INTO v9_special_game (`gamename`,`inputtime`,`special_id`)VALUE('$gamename','$time','$specilaid')";
			$this->db->sselect($sql);
			//g("添加游戏成功","?m=gamenum&c=gamenum&a=gamenum_list");
			header('Location: /?m=gamenum&c=gamenum&a=gamenum_list');
		}
		$specilainfo = $this->db->sselect("select id,title from v9_special");
			include $this->admin_tpl('add_game');
		
	}
	
	public function addgamenum(){
	 $gameid = $_GET['typeid'];//获取游戏ID
	 if($_GET['add']=="yes"){
		if($_FILES['myfile']['name'] != '') {
			
			/*if ((($_FILES["myfile"]["type"] == "image/gif")
				|| ($_FILES["myfile"]["type"] == "image/jpeg")
				|| ($_FILES["myfile"]["type"] == "image/pjpeg"))
				&& ($_FILES["myfile"]["size"] < 20000))*/
			if ($_FILES["myfile"]["size"] < 20000)
				  {
				  if ($_FILES["myfile"]["error"] > 0)
				    {
				    echo "Return Code: " . $_FILES["myfile"]["error"] . "<br />";
				    }
				  else
				    {
				    move_uploaded_file($_FILES["myfile"]["tmp_name"],
				    $_SERVER['DOCUMENT_ROOT']."/uploadfile/gamenum/" . $_FILES["myfile"]["name"]);
				    $data = new Spreadsheet_Excel_Reader();
					$data->setOutputEncoding('gbk');
				    $data->read($_SERVER['DOCUMENT_ROOT']."/uploadfile/gamenum/" . $_FILES["myfile"]["name"]);
				    $content = $_SERVER['DOCUMENT_ROOT']."/uploadfile/gamenum/" . $_FILES["myfile"]["name"];
				    $numRows = $data->sheets[0]['numRows'];//行数
				    $numCols = $data->sheets[0]['numCols'];//列数
				    $gameid = $_POST['gameid'];
					for($i=1;$i<=$numRows;$i++){
						//打印excel表数据,调试用
						/*for($j=1;$j<=$numCols;$j++){
							echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
						}*/
						//echo "\n";
						/*$sql = "INSERT INTO TEST VALUES('".
						$data->sheets[0]['cells'][$i][1]."','".
						$data->sheets[0]['cells'][$i][2]."','". 
						$data->sheets[0]['cells'][$i][3]."')"; 
						echo $sql.'<br />';*/
						$sql = "INSERT INTO v9_special_gamenum (`gamenum`,`gameid`,`isuse`) VALUES('".$data->sheets[0]['cells'][$i][1]."',$gameid,0)";
						$this->db->sselect($sql);
					 }
					 //g("导入数据成功","?m=gamenum&c=gamenum&a=gamenum_list");
					 header('Location: /?m=gamenum&c=gamenum&a=gamenum_list');
				    }
				  }
				else
				  {
				  echo "请上传Excel格式文件！";
				  }
		}
	}
			include $this->admin_tpl('add_gamenum');
		
	}
  }

?>