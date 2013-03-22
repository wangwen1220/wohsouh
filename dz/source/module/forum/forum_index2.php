<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: forum_index.php 16973 2010-09-17 09:28:06Z monkey $
 */
//图片
require_once libfile('class/forumupload');
/*
if(empty($_G['gp_simple'])) {
	$_FILES['Filedata']['name'] = addslashes(diconv(urldecode($_FILES['Filedata']['name']), 'UTF-8'));
}
$upload = new forum_upload();
die();
*/

$sql = "SELECT a.*,t.tid,t.author,t.authorid,t.subject
FROM pre_forum_attachment a
INNER JOIN pre_forum_thread t
ON t.tid=a.`tid` AND displayorder>='0'
WHERE  a.readperm='0' AND a.price='0'
AND t.isgroup='0'AND a.isimage IN ('1', '-1')
and a.remote='0'
ORDER BY a.dateline DESC
LIMIT 0,20";
//$sql = "SELECT a.aid,a.tid,a.dateline,a.attachment,b.subject FROM ".DB::table('forum_attachment')." a LEFT JOIN ".DB::table('forum_thread')." b ON a.tid = b.tid WHERE b.attachment != 0 ORDER BY a.dateline DESC LIMIT 8";
$query = DB::query($sql);
$pic = array();
while ($res = DB::fetch($query)) {
	$res['url'] = "thread-".$res['tid']."-1-1.html";
	$pic[] = $res;
}
$iii=0;
foreach ($pic as $key=>$value) {
	//图片下载并保存
	$remotedir = "http://res1.netwaymedia.com/forum/".$value['attachment'];
	var_dump($remotedir);
	$rawdir = $newImgDir.'raw_'.$value['aid'].'.jpg';
	$uploaddir = $newImgDir.$value['aid'].'.jpg';
	$imgContent = file_get_contents($remotedir);
	$fh = fopen($rawdir, "w");
	if ($fh) {
		fwrite($fh, $imgContent);
		$iii++;
	}
	else
		continue;
	fclose($fh);
	if (file_exists($rawdir)) {
		//指定生成缩缩略图文件存储路径
		$aaa = resizeImgForForum($rawdir, 313, 234, $uploaddir);
		@unlink($rawdir);
	}
	$pic[$key]['imgurl'] = 'data/attachment/forum/newimg/'.$value['aid'].'.jpg';
	if($iii>8)
		break;
}
//$memcache->set("forum_newimg", $pic, 10*60);
?>