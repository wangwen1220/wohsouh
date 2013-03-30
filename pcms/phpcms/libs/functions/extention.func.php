<?php
/**
 *  extention.func.php 用户自定义函数库
 *
 * @copyright			(C) 2005-2010 PHPCMS
 * @license				http://www.phpcms.cn/license/
 * @lastmodify			2010-10-27
 */
 

/**
 * 获得catid的栏目名
 * @param $catid 栏目id
 */
function getCatNameFromCatid($catid){
	$category_arr = array();
	$siteids = getcache('category_content','commons');
	$siteid = $siteids[$catid];
	$category_arr = getcache('category_content_'.$siteid,'commons');
	if(!isset($category_arr[$catid])) return '';
	return $category_arr[$catid]["catname"];
}

/**
 * 用于处理数据导入时的图片处理
 * @param unknown_type $str	附件路径
 */
function process_thumb_hs($str)
{
	return "/upload/".$str;
	//return "/uploadfile/$str";
}

/**
 * 文本内容替换
 * @param unknown_type $content
 * @return unknown
 */
function getContet($content){
	// 	var_dump($content);die();
	$con_data = trim(str_replace('<p class="mcePageBreak">&nbsp;</p>',"[page]",$content));
	if(strpos($con_data,"[page]",0)===0)
		$con_data = substr($con_data, 6);
	$con_data = str_replace('<img src="http://www.huoshow.com/upload','<img src="/upload',$con_data);
	$con_data = str_replace('href="http://www.huoshow.com/upload','href="/upload',$con_data);
	return $con_data;
}





?>