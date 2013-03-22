<?php
/*
 php多图片上传程序
 */

//为建立一个会话工作因为不发闪光播放器的饼乾
if (isset($_POST["PHPSESSID"])) {
	session_id($_POST["PHPSESSID"]);
} else if (isset($_GET["PHPSESSID"])) {
	session_id($_GET["PHPSESSID"]);
}
session_start();

//检验post的最大上传的大小
$POST_MAX_SIZE = ini_get('post_max_size');
$unit = strtoupper(substr($POST_MAX_SIZE, -1));
$multiplier = ($unit == 'M' ? 1048576 : ($unit == 'K' ? 1024 : ($unit == 'G' ? 1073741824 : 1)));

if ((int)$_SERVER['CONTENT_LENGTH'] > $multiplier*(int)$POST_MAX_SIZE && $POST_MAX_SIZE) {
	header("HTTP/1.1 500 Internal Server Error"); // This will trigger an uploadError event in SWFUpload
	echo "fai:超过最大允许后的尺寸";
	exit(0);
}

// 设置
$dir_file=date("Ymd");  //获取当前时间
$wpf=date('YmdHis');
$save_path = getcwd() . '/upload/image/'.$dir_file.'/';				// 保存的路径
$upload_name = "Filedata";
$max_file_size_in_bytes = 2147483647;				// 2GB in bytes 最大上传的文件大小为2G
$extension_whitelist = array("jpg", "gif", "png");	// 上传允许的文件扩展名称
$valid_chars_regex = '.A-Z0-9_ !@#$%^&()+={}\[\]\',~`-'; //允许在文件名字符(在一个正则表达式格式)

//其他的验证
$MAX_FILENAME_LENGTH = 260;
$file_name = "";
$file_extension = "";
$uploadErrors = array(
0=>"没有错误,文件上传有成效",
1=>"上传的文件的upload_max_filesize指令在你只有超过",
2=>"上传的文件的超过MAX_FILE_SIZE指示那个没有被指定在HTML表单",
3=>"未竟的上传的文件上传",
4=>"没有文件被上传",
6=>"错过一个临时文件夹"
);

//验证上传
if (!isset($_FILES[$upload_name])) {
	HandleError("fai:没有发现上传 \$_FILES for " . $upload_name);
	exit(0);
} else if (isset($_FILES[$upload_name]["error"]) && $_FILES[$upload_name]["error"] != 0) {
	HandleError($uploadErrors[$_FILES[$upload_name]["error"]]);
	exit(0);
} else if (!isset($_FILES[$upload_name]["tmp_name"]) || !@is_uploaded_file($_FILES[$upload_name]["tmp_name"])) {
	HandleError("fai:Upload failed is_uploaded_file test.");
	exit(0);
} else if (!isset($_FILES[$upload_name]['name'])) {
	HandleError("fai:文件没有名字.");
	exit(0);
}

// 验证这个文件的大小(警告:最大的文件支持这个代码2 GB)
$file_size = @filesize($_FILES[$upload_name]["tmp_name"]);
if (!$file_size || $file_size > $max_file_size_in_bytes) {
	HandleError("fai:超过最高允许的文件的大小");
	exit(0);
}

if ($file_size <= 0) {
	HandleError("fai:超出文件的最小大小");
	exit(0);
}

// 验证文件名称(对于我们而言我们只会删除无效字符)
$file_name = preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', "", basename($_FILES[$upload_name]['name']));
if (strlen($file_name) == 0 || strlen($file_name) > $MAX_FILENAME_LENGTH) {
	HandleError("fai:无效的文件");
	exit(0);
}

//确认我们不会地盖写现有的一个文件
if (file_exists($save_path . $file_name)) {
	HandleError("fai:这个名字的文件已经存在");
	exit(0);
}

//验证文件扩展名
$path_info = pathinfo($_FILES[$upload_name]['name']);
$file_extension = $path_info["extension"];
$is_valid_extension = false;
foreach ($extension_whitelist as $extension) {
	if (strcasecmp($file_extension, $extension) == 0) {
		$is_valid_extension = true;
		break;
	}
}

if (!$is_valid_extension) {
	HandleError("fai:无效的扩展名");
	exit(0);
}

if (file_exists($save_path . $file_name)) {
	HandleError("fai:这个文件的名称已经存在");
	exit(0);
}


if(is_dir('upload/image/'.$dir_file)){
	$fileName=CreateNextName($file_extension,$save_path);
	if(!move_uploaded_file($_FILES[$upload_name]["tmp_name"], $save_path.$fileName)) {
		HandleError("fai:文件移动失败");
		exit(0);
	}
	else {
		HandleError("suc:upfile/upload/image/".$dir_file."/,".$fileName.",".$file_size);
		exit(0);
	}
}else{
	if(mkdir('upload/image/'.$dir_file)){
		$fileName=CreateFirstName($file_extension );
		if(!move_uploaded_file($_FILES[$upload_name]["tmp_name"], $save_path.$fileName)) {
			HandleError("fai:文件移动失败");
			exit(0);
		}
		else {
			HandleError("suc:upfile/upload/image/".$dir_file."/,".$fileName.",".$file_size);
			exit(0);
		}
	}
	else {
		HandleError("fai:创建目录失败");
		exit(0);
	}
}
exit(0);

//错误
function HandleError($message) {
	echo $message;
}
//参数是文件的扩展名称
function CreateFirstName($file_extension ){
	$num=13755211047;
	$fileName=$num.".".$file_extension;
	return $fileName;
}

//参数是文件的扩展名称
function CreateNextName($file_extension,$file_dir){
	//在文件的目录下找最大的;
	$fileName_arr = scandir($file_dir,1);
	$fileName=$fileName_arr[0];
	$aa=explode('.',$fileName);
	$num=$aa[0]+1;
	if(empty($aa[0]))
	{
		$num = 13755211047;
	}
	return $num.".".$file_extension;

}
?>
