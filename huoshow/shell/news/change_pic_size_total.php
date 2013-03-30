<?php
/**
 * 对图库的图片进行处理，生成一张很小的图片。
 * 主要用于搜索引擎显示时降低流量
 * @author chengkui
 *
 */

ini_set("max_execution_time", "0");
//ini_set("display_errors","Off");
//$root_path = realpath(dirname(__FILE__)."/../..");
//var_dump(dirname(__FILE__));die();
/*
$root_path = "/local/ck_files/project/huoshow/huoshow_web/trunk/cms";//外网需要更改
$dbinfo["name"] = "huoshow_cmstop";//外网需要改
*/

$root_path = "/var/www/html/huoshow/cms";//外网需要更改
$dbinfo["name"] = "cmstop_1_5";//外网需要改

$_SERVER['DOCUMENT_ROOT'] = $root_path;
require_once($root_path."/huoshow/FrameWork/DataBase.php");

$dblink = new DataBase($dbinfo);

$count_arr = $dblink->getRow("select count(*) as count from cmstop_picture_group");
$count = $count_arr[0]["count"];
$per_record = 200;
$page = 0;
$pre_path = $root_path."/upload/";
$last_nid=0;
while(1)
{
	$sql = "SELECT pictureid,image FROM cmstop_picture_group where pictureid>'$last_nid' ORDER BY pictureid ASC LIMIT 0,$per_record";
	$page += $per_record;
	$dbarr = $dblink->getRow($sql);
	$tcount = count($dbarr);
	if($tcount==0)
		break;
	else
	{
		
		for($i=0;$i<$tcount;$i++)
		{
			$pos = strrpos($dbarr[$i]["image"], '.');
			$file = substr($dbarr[$i]["image"],0,$pos);//带目录的文件名
			$path_pre = substr($file,0,strrpos($file, '/'));//目录
			$file_pre = substr($file,strrpos($file, '/')+1);//不带路径名和扩展名的文件名
			$ext = substr($dbarr[$i]["image"],$pos+1);
			$path = $pre_path.$dbarr[$i]["image"];//文件的全路径
			$last_nid = $dbarr[$i]["pictureid"];
			//对大图进行处理
			//var_dump($path);
			if(file_exists($path))
			{
				MiniImg2($path,"600*600",65,0,true);
			}
			//var_dump($pre_path.$path_pre."/thumb_941_627_$file_pre.$ext");
			if(file_exists($pre_path.$path_pre."/thumb_941_627_$file_pre.$ext"))//thumb_941_627_1315986259580
			{
				MiniImg2($pre_path.$path_pre."/thumb_941_627_$file_pre.$ext","600*600",65,0,true);
			}
		}
	}
	echo "$page / $count\n";
}

$dblink->dbclose();
die("ok");



/**
 * 生成图片缩略图
 * $srcFile - 图形文件
 * $pixel - 尺寸大小，如：400*300
 * $_quality - 图片质量，默认75
 * $cut - 是否裁剪，默认1，当$cut=0的时候，将不进行裁剪
 * $cache - 如果有缓存，是否直接用缓存，默认true
 * 示例："< img src=\"".MiniImg('images/image.jpg','300*180',72,0)."\">"
 * */
function MiniImg2($srcFile, $pixel, $_quality = 75, $cut=0, $cache=true){
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
	$pixelInfo[0] = $sizeInfo['width'];
	$pixelInfo[1] = $sizeInfo['height'];
	if(1==2) 
	{
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
/*
$pic_path = "1319592810561.jpg";

copy($pic_path,"22.jpg");
MiniImg($pic_path,"600*600",72,0,true);
*/
?>