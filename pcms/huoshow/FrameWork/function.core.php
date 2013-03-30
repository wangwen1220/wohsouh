<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/configs/config.php");
//echo $_SERVER['DOCUMENT_ROOT'];

/**
 * 这里存放不好封装为类的函数
 *
 * @author badroom
 * @package defaultPackage
 */


/**
 * 对字符串进行防注入处理
 *
 * @param unknown_type $str 待处理的字符串
 */
function PR($str)
{
	if (!get_magic_quotes_gpc()) {
		$lastname = mysql_real_escape_string($str);
	} else {
		$lastname = $str;
	}
}

/**
 * 弹出消息并跳转
 *
 * @param unknown_type $msg 消息
 * @param unknown_type $url 跳转url
 */
function g($msg,$url)
{
	?>
		<!--<script src="<?php //echo PCMS_URL?>statics/js/artDialog.js"></script>-->
		<script src="<?php echo PCMS_URL?>statics/js/artDialog/artDialog.js?skin=default"></script>
		<script>
		window.onload = function(){
			art.dialog({width:400,height:80,content:'<?php echo $msg?>',ok:function(){location.href="<?php echo $url?>"},close:function(){location.href="<?php echo $url?>"}});
		}
		</script>
	<?php 
//	require $_SERVER['DOCUMENT_ROOT']."/statics/js/artDialog.js";
//	die('<script >
//alert("'.$msg.'");
//if("'.$url.'"=="-1")
//	history.go(-1);
//else
//	location.href="'.$url.'";
//</script>');
//	echo '11';
//	die('
//	<script>
//	art.dialog("'.$msg.'", function(){location.href="'.$url.'"});
//	</script>
//	');
}

/**
 * 构造返回数组
 *
 * @param unknown_type $returnArr 
 * @param unknown_type $return
 * @param unknown_type $msg
 */
function getR($return,$msg="")
{
	$returnArr["-retult-"] = $return;
	$returnArr["-msg-"] = $msg;
	return $returnArr;
}


/**
 * 如果出错，则中断并输出错误信息
 *
 * @param unknown_type $returnArr
 */
function dieErr($returnArr)
{
	if(is_array($returnArr) && array_key_exists("-retult-",$returnArr) && 
			!$returnArr["-retult-"])
		die($returnArr["-msg-"]);
}

/**
 * 判断返回值
 *
 * @param unknown_type $returnArr
 * @return unknown
 */
function checkErr($returnArr)
{
	if(array_key_exists("-retult-",$returnArr) && !$returnArr["-retult-"])
		return false;
	else 
		return true;
}


/**
 * 如果出错，则打印错误信息但不中断
 *
 * @param unknown_type $returnArr
 */
function echoErr($returnArr)
{
	if(!$returnArr["-retult-"])
		echo $returnArr["-msg-"]."<br>";
}

/**
 * 获得当前时间戳
 *
 */
function getCurrentTimeZone()
{
	date_default_timezone_set("Asia/Shanghai");
	return time();
}

/**
 * 根据时间戳获得字符时间 如 2011-10-10 10:10:10
 *
 * @param unknown_type $timestramp
 */
function getLocalTimeStr($timestramp)
{
	date_default_timezone_set("Asia/Shanghai");
	return date("Y-m-d H:i:s",$timestramp);
}


/**
 * 根据ID获取120*120封面
 *	size 图片类型
 * 	avatardir 图片存放目录
 * @param unknown_type $roomid
 */
function getLiveCover($uid, $size = 'big', $avatardir = '',$type = '') {
	if(empty($uid) || !is_numeric($uid) || $uid<1)
		return getR(false,"uid格式错误");
	$size = in_array($size, array('big', 'middle', 'small')) ? $size : 'big';
	$uid = abs(intval($uid));
	$uid = sprintf("%09d", $uid);
	$dir1 = substr($uid, 0, 3);
	$dir2 = substr($uid, 3, 2);
	$dir3 = substr($uid, 5, 2);
	$typeadd = $type == 'real' ? '_real' : '';
	$file = 'huoshow/upload_files/upload_dzflash/'.$avatardir.'/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).$typeadd."_avatar_$size.jpg";
	if(file_exists($file)){
	return  'huoshow/upload_files/upload_dzflash/'.$avatardir.'/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).$typeadd."_avatar_$size.jpg";
	}else {
		return DX_URL.'uc_server/images/noavatar_'.$size.'.gif';
	}
}

/**
 *获取用户头像
 *
 * @param unknown_type $uid
 * @param unknown_type $size
 * @param unknown_type $type
 * @return unknown
 * $livecover 判断普通直播间封面图片
 */
function getLiveHead($uid, $size = 'big', $type = '',$livecover = '') {
	if(empty($uid) || !is_numeric($uid) || $uid<1)
		return getR(false,"uid格式错误");
	$size = in_array($size, array('big', 'middle', 'small')) ? $size : 'big';
	$uid = abs(intval($uid));
	$uid = sprintf("%09d", $uid);
	$dir1 = substr($uid, 0, 3);
	$dir2 = substr($uid, 3, 2);
	$dir3 = substr($uid, 5, 2);
	$typeadd = $type == 'real' ? '_real' : '';
	$filelivecover = $_SERVER['DOCUMENT_ROOT'].'/uc_server/data/avatar/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).$typeadd."_$livecover.jpg";
	$filecover = $_SERVER['DOCUMENT_ROOT'].'/uc_server/data/avatar/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).$typeadd."_avatar_$size.jpg";
	if(!empty($livecover)&&file_exists($filelivecover)) {
		return  DX_URL.'uc_server/data/avatar/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).$typeadd."_$livecover.jpg";
	} elseif(file_exists($filecover)) {
		return  DX_URL.'uc_server/data/avatar/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).$typeadd."_avatar_$size.jpg";
	} else {
		return  DX_URL.'uc_server/images/noavatar_'.$size.'.gif';
	}
}

/**
 * 用户进入直播间获得IP
 *
 * @return unknown
 */
function getIp(){
	if (getenv('HTTP_CLIENT_IP')){
		$ip = getenv('HTTP_CLIENT_IP');
	} elseif (getenv('HTTP_X_FORWARDED_FOR')) {
		list($ip) = explode(',', getenv('HTTP_X_FORWARDED_FOR'));
	} elseif (getenv('REMOTE_ADDR')) {
		$ip = getenv('REMOTE_ADDR');
	}else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}


/**
 * @param 计算中文字符串长度
 * @return number
 */
function utf8_strlen($string = null) {
	// 将字符串分解为单元
	preg_match_all("/./us", $string, $match);
	// 返回单元个数
	return count($match[0]);
}

/**
 * @param 对新功能做测试开关
 * @param unknown_type $uid
 * @param unknown_type $type_name
 */
function test_switch($uid,$type_name){
	if(empty($uid) || !is_numeric($uid) || $uid<1)
			return getR(false,"uid格式错误");
	$dblink = new DataBase("");
	$sql = "SELECT config_value FROM pre_mutilive_config WHERE config_name = '$type_name'";
	$mutilive_config = $dblink->getRow($sql);
	if(!empty($uid)) {
		if (!is_numeric($uid) || $uid<1) {
			return getR(false,"uid格式错误");
		}
		$sql = "SELECT uid FROM pre_mutilive_allow_user_list WHERE uid=$uid";
		$mutilive_allowuser = $dblink->getRow($sql);
	}
	//判断是否开启测试
	if ($mutilive_config[0]['config_value'] == 0 || ($mutilive_config[0]['config_value'] == 1 && $mutilive_allowuser[0]['uid'] != "")) {
		return 1;//1为开放测试
	}else {
		return 0;
	}
	$dblink->dbclose();
}


/**
 * 生成图片缩略图
 * $srcFile - 图形文件
 * $pixel - 尺寸大小，如：400*300
 * $_quality - 图片质量，默认75
 * $cut - 是否裁剪，默认1，当$cut=0的时候，将不进行裁剪
 * $cache - 如果有缓存，是否直接用缓存，默认true
 * 示例："< img src=\"".MiniImg('images/image.jpg','300*180',72,0)."\">"
 * */
function MiniImg($srcFile, $pixel, $_quality = 75, $cut=0, $cache=true){
	$_type = strtolower(substr(strrchr($srcFile,"."),1));
	$pixelInfo = explode('*', $pixel);
	$pathInfo = pathinfo($srcFile);
	$_cut = intval($cut);
	$searchFileName = preg_replace("/\.([A-Za-z0-9]+)$/isU", "_small".".\\1", $pathInfo['basename']);
	$miniFile = $pathInfo['dirname'].'/'.$searchFileName;
	//if($cache and file_exists($miniFile)) return $miniFile;
	$data = GetImageSize($srcFile);
	$FuncExists = 1;
	switch ($data[2]) {
		case 1:			//gif
			if(function_exists('ImageCreateFromGIF')) $_im = ImageCreateFromGIF($srcFile);
			break;
		case 2:			//jpg
			if(function_exists('imagecreatefromjpeg')) $_im = imagecreatefromjpeg($srcFile);
			break;
		case 3:			//png
			if(function_exists('ImageCreateFromPNG')) $_im = ImageCreateFromPNG($srcFile);
			break;
		case 6:			//bmp，这里需要用到ImageCreateFromBMP
			$_im = ImageCreateFromBMP($srcFile);
			break;
	}
	if(!$_im) return $srcFile;
	$sizeInfo['width'] = @imagesx($_im);
	$sizeInfo['height'] = @imagesy($_im);
	if(!$sizeInfo['width'] or !$sizeInfo['height']) return $srcFile;
	if($sizeInfo['width'] == $pixelInfo[0] && $sizeInfo['height'] == $pixelInfo[1] ) {
		return $srcFile;
	}elseif($sizeInfo['width'] < $pixelInfo[0] && $sizeInfo['height'] < $pixelInfo[1]/* && $miniMode=='2'*/){
		return $srcFile;
	}else{
		$resize_ratio = ($pixelInfo[0])/($pixelInfo[1]);
		$ratio = ($sizeInfo['width'])/($sizeInfo['height']);
		if($cut==1){
			$newimg = imagecreatetruecolor($pixelInfo[0],$pixelInfo[1]);
			if($ratio>=$resize_ratio){										//高度优先
				imagecopyresampled($newimg, $_im, 0, 0, 0, 0, $pixelInfo[0],$pixelInfo[1], (($sizeInfo['height'])*$resize_ratio), $sizeInfo['height']);
				$_result = ImageJpeg ($newimg,$miniFile, $_quality);
			}else{															//宽度优先
				imagecopyresampled($newimg, $_im, 0, 0, 0, 0, $pixelInfo[0], $pixelInfo[1], $sizeInfo['width'], (($sizeInfo['width'])/$resize_ratio));
				$_result = ImageJpeg ($newimg,$miniFile, $_quality);
			}
		}else{																//不裁图
			if($ratio>=$resize_ratio){
				$newimg = imagecreatetruecolor($pixelInfo[0],($pixelInfo[0])/$ratio);
				imagecopyresampled($newimg, $_im, 0, 0, 0, 0, $pixelInfo[0], ($pixelInfo[0])/$ratio, $sizeInfo['width'], $sizeInfo['height']);
				$_result = ImageJpeg ($newimg,$miniFile, $_quality);
			}else{
				$newimg = imagecreatetruecolor(($pixelInfo[1])*$ratio,$pixelInfo[1]);
				imagecopyresampled($newimg, $_im, 0, 0, 0, 0, ($pixelInfo[1])*$ratio, $pixelInfo[1], $sizeInfo['width'], $sizeInfo['height']);
				$_result = ImageJpeg ($newimg,$miniFile, $_quality);
			}
		}
		ImageDestroy($_im);
		ImageDestroy($newimg);
		if($_result) return $miniFile;
		return $srcFile;
	}
}


/**
 * ImageCreateFromBMP() - 支持BMP图片函数
 * $filename - BMP图形文件
 * */
function ImageCreateFromBMP( $filename ) {
	// Ouverture du fichier en mode binaire
	if ( ! $f1 = @fopen ($filename, "rb")) return FALSE ;
	// 1 : Chargement des ent?tes FICHIER
	$FILE = unpack ( "vfile_type/Vfile_size/Vreserved/Vbitmap_offset" , fread($f1 ,14));
	if ( $FILE ['file_type'] != 19778 ) return FALSE ;
	// 2 : Chargement des ent?tes BMP
	$BMP = unpack ( 'Vheader_size/Vwidth/Vheight/vplanes/vbits_per_pixel' .
			'/Vcompression/Vsize_bitmap/Vhoriz_resolution' .
			'/Vvert_resolution/Vcolors_used/Vcolors_important' , fread ( $f1 , 40 ));
	$BMP [ 'colors' ] = pow ( 2 , $BMP['bits_per_pixel ' ]);
	if ( $BMP ['size_bitmap'] == 0 ) $BMP ['size_bitmap']=$FILE ['file_size']-$FILE ['bitmap_offset'];
	$BMP ['bytes_per_pixel'] = $BMP ['bits_per_pixel'] / 8 ;
	$BMP ['bytes_per_pixel2'] = ceil ( $BMP ['bytes_per_pixel']);
	$BMP ['decal'] = ( $BMP ['width']*$BMP ['bytes_per_pixel'] / 4 );
	$BMP ['decal'] -= floor ( $BMP ['width'] * $BMP ['bytes_per_pixel'] / 4 );
	$BMP ['decal'] = 4 - ( 4 * $BMP ['decal']);
	if ( $BMP ['decal'] == 4 ) $BMP ['decal'] = 0 ;
	// 3 : Chargement des couleurs de la palette
	$PALETTE = array ();
	if ( $BMP ['colors'] < 16777216 ){
		$PALETTE = unpack ( 'V' . $BMP ['colors'] , fread ( $f1 , $BMP ['colors'] * 4 ));
	}
	// 4 : Cr?ation de l'image
	$IMG = fread ( $f1 , $BMP ['size_bitmap']);
	$VIDE = chr ( 0 );
	$res = imagecreatetruecolor( $BMP ['width'] , $BMP ['height']);
	$P = 0 ;
	$Y = $BMP ['height'] - 1 ;
	while ( $Y >= 0 ){
		$X = 0 ;
		while ( $X < $BMP ['width']){
			if ( $BMP ['bits_per_pixel'] == 24 )
				$COLOR = @unpack ( "V" , substr($IMG,$P,3).$VIDE );
			elseif ( $BMP['bits_per_pixel']== 16 ){
				$COLOR = unpack ( "n" , substr ( $IMG , $P , 2 ));
				$COLOR [1] = $PALETTE [ $COLOR [ 1 ] + 1 ];
			}elseif ( $BMP['bits_per_pixel']== 8 ){
				$COLOR = unpack ( "n" , $VIDE . substr ( $IMG , $P , 1 ));
				$COLOR [1] = $PALETTE [ $COLOR [ 1 ] + 1 ];
			}elseif ( $BMP['bits_per_pixel']== 4 ){
				$COLOR = unpack ( "n" , $VIDE . substr ( $IMG , floor ( $P ) , 1 ));
				if (( $P * 2 ) % 2 == 0 )
					$COLOR [1] = ( $COLOR [1] >> 4 ) ;
				else
					$COLOR [1] = ( $COLOR [1] & 0x0F );
				$COLOR [1] = $PALETTE [ $COLOR [1] + 1 ];
			}elseif ( $BMP['bits_per_pixel']== 1 ){
				$COLOR = unpack ( "n" , $VIDE . substr ( $IMG , floor ( $P ) , 1 ));
				if (( $P * 8 ) % 8 == 0 ) $COLOR [ 1 ] = $COLOR [ 1 ] >> 7 ;
				elseif (( $P * 8 ) % 8 == 1 ) $COLOR [1] = ( $COLOR [1] & 0x40 ) >> 6 ;
				elseif (( $P * 8 ) % 8 == 2 ) $COLOR [1] = ( $COLOR [1] & 0x20 ) >> 5 ;
				elseif (( $P * 8 ) % 8 == 3 ) $COLOR [1] = ( $COLOR [1] & 0x10 ) >> 4 ;
				elseif (( $P * 8 ) % 8 == 4 ) $COLOR [1] = ( $COLOR [1] & 0x8 ) >> 3 ;
				elseif (( $P * 8 ) % 8 == 5 ) $COLOR [1] = ( $COLOR [1] & 0x4 ) >> 2 ;
				elseif (( $P * 8 ) % 8 == 6 ) $COLOR [1] = ( $COLOR [1] & 0x2 ) >> 1 ;
				elseif (( $P * 8 ) % 8 == 7 ) $COLOR [1] = ( $COLOR [1] & 0x1 );
				$COLOR [1] = $PALETTE [ $COLOR [1] + 1 ];
			}else return FALSE ;
			imagesetpixel( $res , $X , $Y , $COLOR [ 1 ]);
			$X ++ ;
			$P += $BMP['bytes_per_pixel'];
		}
		$Y -- ;
		$P += $BMP['decal'];
	}
	// Fermeture du fichier
	fclose ( $f1 );
	return $res ;
}

function url_exists($url)
{
	$handle = @fopen($url, "r");
	if ($handle === false)
		return false;
	fclose($handle);
	return true;
}


 function huoshowftpimg($type=null,$record=null,$value=null,$id=null){
 	define('FILE_HOST', 'res1.netwaymedia.com');//资源服务器
	if($type==1){
		$image=DX_URL."static2/images/audio_default.png"; 
	}else{
		if($record==1){
			$img=substr($value,0,-4)."_small.jpg";
			$image="http://".FILE_HOST."/saishi/".$id."/".$img;
		}else{
			$img=$value."_small.jpg";
			$image="http://".FILE_HOST."/huoshow/video/".$img;
		}
	}
	return $image;
	
}

function formhash_huo($specialadd = '') {
	global $_G;
	$hashadd = defined('IN_ADMINCP') ? 'Only For Discuz! Admin Control Panel' : '';
	return substr(md5(substr($_G['timestamp'], 0, -7).$_G['username'].$_G['uid'].$_G['authkey'].$hashadd.$specialadd), 8, 8);
}

/**
 * 生成图片缩略图
 * $srcFile - 图形文件
 * $pixel - 尺寸大小，如：400*300
 * $_quality - 图片质量，默认75
 * $cut - 是否裁剪，默认1，当$cut=0的时候，将不进行裁剪
 * $size  图片大小类型
 * $cache - 如果有缓存，是否直接用缓存，默认true
 * 示例："< img src=\"".MiniImg('images/image.jpg','300*180',72,0)."\">"
 * */
function CommunityImg($srcFile, $pixel, $_quality = 100, $cut=0, $size='big', $cache=true ){
	$_type = strtolower(substr(strrchr($srcFile,"."),1));
	$pixelInfo = explode('*', $pixel);
	$pathInfo = pathinfo($srcFile);
	$_cut = intval($cut);
	$size = in_array($size, array('big', 'middle', 'small')) ? $size : 'big';
//	echo $size;
//	die();
	$searchFileName = preg_replace("/\.([A-Za-z0-9]+)$/isU", "_$size".".\\1", $pathInfo['basename']);
	$miniFile = $pathInfo['dirname'].'/'.$searchFileName;
	//if($cache and file_exists($miniFile)) return $miniFile;
	$data = GetImageSize($srcFile);
	$FuncExists = 1;
	switch ($data[2]) {
		case 1:			//gif
			if(function_exists('ImageCreateFromGIF')) $_im = ImageCreateFromGIF($srcFile);
			break;
		case 2:			//jpg
			if(function_exists('imagecreatefromjpeg')) $_im = imagecreatefromjpeg($srcFile);
			break;
		case 3:			//png
			if(function_exists('ImageCreateFromPNG')) $_im = ImageCreateFromPNG($srcFile);
			break;
		case 6:			//bmp，这里需要用到ImageCreateFromBMP
			$_im = ImageCreateFromBMP($srcFile);
			break;
	}
	if(!$_im) return $srcFile;
	$sizeInfo['width'] = @imagesx($_im);
	$sizeInfo['height'] = @imagesy($_im);
	if(!$sizeInfo['width'] or !$sizeInfo['height']) return $srcFile;
	if($sizeInfo['width'] == $pixelInfo[0] && $sizeInfo['height'] == $pixelInfo[1] ) {
		return $srcFile;
	}elseif($sizeInfo['width'] < $pixelInfo[0] && $sizeInfo['height'] < $pixelInfo[1]/* && $miniMode=='2'*/){
		return $srcFile;
	}else{
		$resize_ratio = ($pixelInfo[0])/($pixelInfo[1]);
		$ratio = ($sizeInfo['width'])/($sizeInfo['height']);
		if($cut==1){
			$newimg = imagecreatetruecolor($pixelInfo[0],$pixelInfo[1]);
			if($ratio>=$resize_ratio){										//高度优先
				imagecopyresampled($newimg, $_im, 0, 0, 0, 0, $pixelInfo[0],$pixelInfo[1], (($sizeInfo['height'])*$resize_ratio), $sizeInfo['height']);
				$_result = ImageJpeg ($newimg,$miniFile, $_quality);
			}else{															//宽度优先
				imagecopyresampled($newimg, $_im, 0, 0, 0, 0, $pixelInfo[0], $pixelInfo[1], $sizeInfo['width'], (($sizeInfo['width'])/$resize_ratio));
				$_result = ImageJpeg ($newimg,$miniFile, $_quality);
			}
		}else{																//不裁图
			if($ratio>=$resize_ratio){
				$newimg = imagecreatetruecolor($pixelInfo[0],($pixelInfo[0])/$ratio);
				imagecopyresampled($newimg, $_im, 0, 0, 0, 0, $pixelInfo[0], ($pixelInfo[0])/$ratio, $sizeInfo['width'], $sizeInfo['height']);
				$_result = ImageJpeg ($newimg,$miniFile, $_quality);
			}else{
				$newimg = imagecreatetruecolor(($pixelInfo[1])*$ratio,$pixelInfo[1]);
				imagecopyresampled($newimg, $_im, 0, 0, 0, 0, ($pixelInfo[1])*$ratio, $pixelInfo[1], $sizeInfo['width'], $sizeInfo['height']);
				$_result = ImageJpeg ($newimg,$miniFile, $_quality);
			}
		}
		ImageDestroy($_im);
		ImageDestroy($newimg);
		if($_result) return $miniFile;
		return $srcFile;
	}
}


?>