<?php
/*
	微博附件上传处理
*/
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/function.core.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php");
//$userinfo = UserApi::getLoginUserSessionInfo();

// Code for Session Cookie workaround
/*
	if (isset($_POST["PHPSESSID"])) {
		session_id($_POST["PHPSESSID"]);
	} else if (isset($_GET["PHPSESSID"])) {
		session_id($_GET["PHPSESSID"]);
	}

	session_start();
	//获得登录的用户信息
*/
//	$uid = $userinfo["uid"];
	$uid = $_POST["uid"];
	if(!is_numeric($uid) && $uid<=0)
	{
		HandleError("uid fomat error");
		exit(0);
	}
	//文件上传后存放的文件夹
	$root_path = "/huoshow/upload_files/weibo/";
	//图片最大上传尺寸
	$IMGMAXUPLOADSIZE = "600K";
	//视频最大上传尺寸
	$VEDIOMAXUPLOADSIZE = "2M";
	//允许的图片后缀
	$extension_whitelist_img = array("jpg"=>1, "gif"=>1, "png"=>1,"jpeg"=>1);	
	//允许的视频后缀
	$extension_whitelist_vedio = array("mpeg"=>1,"avi"=>1,"mp4"=>1,"3gp"=>1,"rm"=>1,
										"rmvb"=>1,"mov"=>1,"wmv"=>1,"flv"=>1);
	
	$path_info = pathinfo($_FILES["Filedata"]['name']);
	$file_extension = strtolower($path_info["extension"]);
	if(!empty($file_extension) && 
			isset($extension_whitelist_img[$file_extension]))
	{
		$POST_MAX_SIZE = $IMGMAXUPLOADSIZE;
		$extension_whitelist = $extension_whitelist_img;
		$file_type = "img";
	}
	if(!empty($file_extension) &&
			isset($extension_whitelist_vedio[$file_extension]))
	{
		$POST_MAX_SIZE = $VEDIOMAXUPLOADSIZE;
		$extension_whitelist = $extension_whitelist_vedio;
		$file_type = "vedio";
	}
	
	//$POST_MAX_SIZE = ini_get('post_max_size');
	$unit = strtoupper(substr($POST_MAX_SIZE, -1));
	$multiplier = ($unit == 'M' ? 1048576 : ($unit == 'K' ? 1024 : ($unit == 'G' ? 1073741824 : 1)));
	
	if ((int)$_SERVER['CONTENT_LENGTH'] > $multiplier*(int)$POST_MAX_SIZE && $POST_MAX_SIZE) {
		//header("HTTP/1.1 500 Internal Server Error"); // This will trigger an uploadError event in SWFUpload
		HandleError("您上传的文件过大,请控制在".$POST_MAX_SIZE."之内");
		exit(0);
	}

// Settings
	//$save_path = $_SERVER['DOCUMENT_ROOT']."/huoshow/upload_files/weibo/";				// The path were we will save the file (getcwd() may not be reliable and should be tested in your environment)
	$upload_name = "Filedata";
	$max_file_size_in_bytes = 2147483647;				// 2GB in bytes
	//$extension_whitelist = array("jpg", "gif", "png");	// Allowed file extensions
	$valid_chars_regex = '.A-Z0-9_ !@#$%^&()+={}\[\]\',~`-';				// Characters allowed in the file name (in a Regular Expression format)
	
// Other variables	
	$MAX_FILENAME_LENGTH = 260;
	$file_name = "";
	$file_extension = "";
	$uploadErrors = array(
        0=>"There is no error, the file uploaded with success",
        1=>"The uploaded file exceeds the upload_max_filesize directive in php.ini",
        2=>"The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
        3=>"The uploaded file was only partially uploaded",
        4=>"No file was uploaded",
        6=>"Missing a temporary folder"
	);


// Validate the upload
	if (!isset($_FILES[$upload_name])) {
		HandleError("No upload found in \$_FILES for " . $upload_name);
		exit(0);
	} else if (isset($_FILES[$upload_name]["error"]) && $_FILES[$upload_name]["error"] != 0) {
		HandleError($uploadErrors[$_FILES[$upload_name]["error"]]);
		exit(0);
	} else if (!isset($_FILES[$upload_name]["tmp_name"]) || !@is_uploaded_file($_FILES[$upload_name]["tmp_name"])) {
		HandleError("Upload failed is_uploaded_file test.");
		exit(0);
	} else if (!isset($_FILES[$upload_name]['name'])) {
		HandleError("File has no name.");
		exit(0);
	}
	
// Validate the file size (Warning: the largest files supported by this code is 2GB)
	$file_size = @filesize($_FILES[$upload_name]["tmp_name"]);
	if (!$file_size || $file_size > $max_file_size_in_bytes) {
		HandleError("File exceeds the maximum allowed size");
		exit(0);
	}
	
	if ($file_size <= 0) {
		HandleError("File size outside allowed lower bound");
		exit(0);
	}


// Validate file name (for our purposes we'll just remove invalid characters)
/*
	$file_name = preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', "", basename($_FILES[$upload_name]['name']));
	if (strlen($file_name) == 0 || strlen($file_name) > $MAX_FILENAME_LENGTH) {
		HandleError("Invalid file name");
		exit(0);
	}
*/

// Validate that we won't over-write an existing file
/*
	if (file_exists($save_path . $file_name)) {
		HandleError("File with this name already exists");
		exit(0);
	}
*/
	
// Validate file extension
	$path_info = pathinfo($_FILES[$upload_name]['name']);
	$file_extension = $path_info["extension"];
	$is_valid_extension = false;
	
	//echo $extension_whitelist[1];
	foreach ($extension_whitelist as $extension=>$value) {
		if (strcasecmp($file_extension, $extension) == 0) {
			$is_valid_extension = true;
			break;
		}
	}
	if (!$is_valid_extension) {
		HandleError("Invalid file extension");
		exit(0);
	}
	
	//开始保存
	if($file_type == "vedio")
	{
		//通过FTP上传视频
	}
	else 
	{
		$time_str = getLocalTimeStr(getCurrentTimeZone());
		preg_match_all('/([\d]{4})-([\d]{2})-([\d]{2}) /',
					 $time_str, $match_arr);
		
		
		$base_path = $_SERVER["DOCUMENT_ROOT"].$root_path;
		if(!file_exists($base_path))
		{
			mkdir($base_path,0777,true);
			chmod($base_path, 0777);
		}
		
		$l_path = $uid."/".$match_arr[1][0]."/".$match_arr[2][0]."/".$match_arr[3][0]."/";
		$total_path = $base_path.$l_path;
		if(!file_exists($total_path))
		{
			mkdir($total_path,0777,true);
			chmod($total_path, 0777);
		}
		$file_base_name = time().rand(1000, 9999);
		$filename = $file_base_name.".".$file_extension;
		//上传图片
		if (!move_uploaded_file($_FILES[$upload_name]["tmp_name"], $total_path.$filename)) {
			HandleError("File could not be saved.");
			exit(0);
		}
		copy($total_path.$filename, $total_path.$file_base_name."_small".".".$file_extension);
		MiniImg($total_path.$filename,"80*80",72,0,true);
	}
	HandleError($root_path.$l_path."/$filename","1");
	exit(0);


/* Handles the error output. This error message will be sent to the uploadSuccess event handler.  The event handler
will have to check for any error messages and react as needed. */
function HandleError($msg,$mid=-1) {
	$returnV["mid"] = $mid;
	$returnV["msg"] = $msg;
	echo json_encode($returnV);
}

function dg($msg)
{
	file_put_contents($_SERVER["DOCUMENT_ROOT"]."/huoshow/test/test.log", $msg);
}


?>