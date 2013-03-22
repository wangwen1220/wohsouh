<?php
/**
 * 保存网页文件到本地(用于采集图片)
 *
 * @param 文件路径 $sUrl
 * @param 保存本地路径 $sSavePath
 * @return boolean
 */
function download_file($sUrl,$sSavePath='')
{
	$sFileName = GetUrlFileExt($sUrl);
	$c = file_get_contents($sUrl);
	return file_put_contents($sSavePath.'/'.$sFileName,$c);
}

/**
 * 获取文件名
 *
 * @param 网页URL $sUrl
 * @return string
 */
function GetUrlFileExt($sUrl)
{
	$aAry = parse_url($sUrl);
	$sFile = basename($aAry['path']);
	$sExt = explode('.',$sFile);
//	return $sExt[0].'.'.$sExt[1];
	return $sFile;
}

$sPath = "data/avatar/pic";
//for($i=1;$i<100;$i++)
//{
//	$sUrl = "http://www.huoshow.com/2012/0711/311627.shtml";
	$sUrl = "http://pnews.huoshow.com/uploadfile/2012/0711/20120711030520493.jpg";
	download_file($sUrl,$sPath);
//}
?>