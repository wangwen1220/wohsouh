<?php
set_time_limit(0);
define('WWW_URL','/');
define(IMG_URL, '/img/');
$limit = 100;
require_once 'Db.class.php';
$dbinc =  require_once '../cmstop/config/db.php';
$db = new Db($dbinc['host'],$dbinc['username'],$dbinc['password'],$dbinc['dbname'],$dbinc['charset']);
$sql = "SELECT contentid,content FROM `cmstop_article` WHERE `content` LIKE '%[flash]http%' ORDER BY contentid DESC LIMIT $limit ";
changeRs($sql,$db);

$sql = "SELECT contentid,content FROM `cmstop_search` WHERE `content` LIKE '%[flash]http%' ORDER BY contentid DESC LIMIT $limit ";
changeRs($sql,$db);

function changeRs($sql,$db){
	$rs = $db->getAll($sql);
	for ($i=0;$i<count($rs);$i++){
		$contentid = $rs[$i]['contentid'];
		$content = $rs[$i]['content'];
		
		$pattern = '/(\[flash\])(http:\/\/)[^\s]*(\[\/flash\])/';
		preg_match($pattern, $content, $matches);
		$replaces = $matches[0];
		if (empty($replaces)){
			$pattern = '/(\[flash\])(http:\/\/)[^\s]* [\w]+[-.][\w]+(\[\/flash\])/';
			preg_match($pattern, $content, $matches);
			
			$replaces = $matches[0];
		}
		if (empty($replaces)){
			$pattern = '/(\[flash\])(http:\/\/)[^\s]* [\w]+\/[\w]+.[\w]+(\[\/flash\])/';
			preg_match($pattern, $content, $matches);			
			$replaces = $matches[0];
		}
		
		$flashUrl = str_replace(array('[flash]','[/flash]'),'',$replaces);
		$trueUrl = trueUrl($flashUrl);
		$endContent = str_replace($replaces, $trueUrl, $content);
		$sql = "UPDATE cmstop_article SET content = '$endContent' WHERE contentid = $contentid ";
		
		$db->query($sql);
		$sql = "UPDATE cmstop_search set content = '$endContent' WHERE contentid = $contentid ";
		
		$db->query($sql);
	}
}
function trueUrl($flashUrl){
	$rs = '<script src="'.IMG_URL.'templates/huoshow_01/js/swfobject.js" type="text/javascript"></script>
	<div id="myFlashContent"></div>
	<script type="text/javascript">
	var flashvars = {};
	var params = {};
	params.wmode = "opaque";
	params.allowfullscreen = "true";
	var attributes = {};			
	swfobject.embedSWF("'.WWW_URL.'VideoPlay.swf?videoUrl='.$flashUrl.'&videoCover=", "myFlashContent", "520", "419", "9.0.0","", flashvars, params, attributes);
	</script>
	';
	return $rs;
}



           		


