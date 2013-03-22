<?php
define('CURSCRIPT', 'apidb');
require './../source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();
$act = @$_GET['act'];
if(trim($act)=='') die();
//$dzUrl = 'http://dev.huoshow.com/';
$dzUrl = $_GET['dz_url'];

	//影视栏目-----电影，电视排行榜
	if($act=='movie_rank'){
		if ($_GET['type']=='neidi'){
			$id="m.id='6'";
		}elseif($_GET['type']=='beimei'){
			$id="m.id='7'";
		}else{
			$id="m.id='9'";
		}
		$sql ="select t.* from ".DB::table('top')." t LEFT JOIN ".DB::table('top_type')." m ON m.id=t.type
		where $id order by sort limit 10 ";
		$query = DB::query($sql);
		while($rs = DB::fetch($query)){
			
			$rs['title']=cutstr($rs['title'],8);
			$movie_rank[]=$rs;
			$data=$movie_rank;
			
		}
		die(json_encode($data));
	
	}
	