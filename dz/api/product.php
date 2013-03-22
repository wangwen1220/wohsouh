<?php
define('CURSCRIPT', 'apidb');
require './../source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();

$arr = $_REQUEST;

$act = $arr['act'];
if ($act == 'install') {
	      $id=trim($arr['id']);
	      $time=time();
	      $uid= trim($arr['uid']);
	      $ver=trim($arr['ver']);
          $ip = $_SERVER['REMOTE_ADDR'];
 
         if(!empty($id) && is_numeric($id) && !empty($ver) && !empty($uid)){
         	 DB::insert('product_setup_i_stat', array('id' => $id, 'ip' => $ip,'ver' => $ver,'createtime' => $time,'uid' => $uid));
         	 echo 1;
            }else {
		   echo -1;
	}
	
} elseif ($act == 'uninstall') {
          $id=trim($arr['id']);
	      $time=time();
	      $cause=trim($arr['cause']);
	      $ver=trim($arr['ver']);
          $uid = trim($arr['uid']);
          $ip = $_SERVER['REMOTE_ADDR'];
    
         if (!empty($id) && is_numeric($id) && !empty($ver) && !empty($uid)){
         	 DB::insert('product_setup_u_stat', array('id' => $id, 'ip' => $ip,'ver' => $ver,'createtime' => $time,'uid' => $uid,'cause' => $cause));
             echo 1;
         }else {
		  echo -1;
	}
}

/**
 * 检查是否存在uid
 * @param 0/int
 * @return int
 */
function cCheckUid($uid){
	if(!empty($uid)){
	$query = DB::query("SELECT uid FROM ".DB::table('common_member')." WHERE uid='$uid'");
	  while($rs = DB::fetch($query)) {
			$usid = $rs['uid'];
		}
	    return $usid;
	}else{
		return false;
}
}

