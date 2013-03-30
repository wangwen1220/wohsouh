<?php
/**
 * 采集相关操作封装

 */
require_once $_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/DataBase.php"; 
class CProduct
{
	/*** 
	 * 
	 * @param string $data  返回获取内容数组
	 * @param string $url   抓取网站地址
	 * 
	 */
	
	public static function process($url){
	//获取网站URL链接
	//从URL中获取主机名称
	preg_match('@^(?:http://)?([^/]+)@i',$url, $matches);
	$host = $matches[1];
	//获取主机名称的后面两部分
	preg_match('/[^.]+\.[^.]+$/', $host, $matches);
	//echo $matches[0];
	$data = array();
	
	//判断网站域名,京东
	if ($matches[0] == "360buy.com") {
		/*$start = '<div class="right-extra">';
		$end   = '<!--right-extra end-->';
		$content= CProduct::cut_html(@file_get_contents($url),$start,$end);*/
		$content= @file_get_contents($url);
		//$data['title'] = iconv('gb2312','utf8',$data['title']);
		$data['title'] = iconv('gb2312','utf-8',CProduct::cut_html($content,"<h1>","</h1>"));
		$data['title'] = strip_tags($data['title']);//过滤HTML标签
		$data['price'] = CProduct::cut_html($content,'<strong class="price">','</strong>');//价格方案一
		if($data['price'] == ""){
			$data['price'] = CProduct::cut_html($content,'<strong class="p-price">','</strong>');//价格方案二
		}
		 /*preg_match_all("/<[img|IMG].*?src=[\'|\"]([^\']*?)[\'|\"].*?[\/]?>/", CProduct::cut_html($content,'<strong class="price">','</strong>'), $price);*/
		 //$data['price']=$price[1][0];
		 //var_dump($price);
		 /*preg_match_all("/<[img|IMG].*?src=[\'|\"]([^\']*?)[\'|\"].*?[\/]?>/", CProduct::cut_html($content,'<div class="content">','</div>'), $img);*/
		preg_match_all("/<[img|IMG].*?jqimg=[\'|\"]([^\']*?)[\'|\"].*?[\/]?>/",$content, $img);//获取图片方案一
		if(empty($img[1])){
		    preg_match_all("/<[img|IMG].*?src=[\'|\"]([^\']*?)[\'|\"].*?[\/]?>/", CProduct::cut_html($content,'<div id="preview">','</div>'), $img);//获取图片方案二
		}
		for($i=0;$i<count($img[1]);$i++){
			list($width[$i], $height[$i]) = getimagesize($img[1][$i]);
			if($width[$i]>=280 && $height[$i]>=280){
				$tempimg = $img[1][$i];
			}
		}
		$data['img'] = $tempimg;
		 //$data['img'] = $img[1][0];
		//$data['description'] = iconv('gb2312','utf-8',CProduct::cut_html($content,'<div class="content">','</div>'));
		$data['description'] = $data['title'];
		if($data['price'] == false){
			$data['price'] = "";
		 }
		if($data['img'] == null)
		{
			$data['img'] = "";
		}
		if($data['description'] == null){
			$data['description'] = "";
		}
	}
	
	//判断网站域名,淘宝
	if ($matches[0] == "taobao.com") {
		/*$start = '<div id="content" class="eshop tb-shop " data-cat="J_Cat" >';
		$end   = '<!--serverDctestone-->';
		$content= CProduct::cut_html(@file_get_contents($url),$start,$end);*/
		$content= @file_get_contents($url);
		$title = iconv('gb2312','utf-8',CProduct::cut_html($content,"<h3>","</h3>"));
		if($title==""){
			$title = iconv('gb2312','utf-8',CProduct::cut_html($content,'<title>','</title>'));//方案1,定位获取不到，则获取title
		}
		$title = strip_tags($title);
		$data['title'] = $title;
		$price = CProduct::cut_html($content,'<strong id="J_StrPrice" >','</strong>');//默认方案
		if($price == ""){
			$price = CProduct::cut_html($content,'<strong class="del" id="J_StrPrice">','</strong>');//方案1，抓取不到则定位这里
		}
		$data['price'] = $price;
		preg_match_all("/<[img|IMG].*?src=[\'|\"]([^\']*?)[\'|\"].*?[\/]?>/", CProduct::cut_html($content,'<div class="tb-booth tb-pic tb-s310">','</div>'), $img);
		//如果图片定位不到，则获取这个页面所有图片
		if(empty($img[1])){
		   preg_match_all("/<[img|IMG].*?src=[\'|\"]([^\']*?)[\'|\"].*?[\/]?>/", $content, $img);
		}
		for($i=0;$i<count($img[1]);$i++){
			list($width[$i], $height[$i]) = getimagesize($img[1][$i]);
			if($width[$i]>200 && $height[$i]>200){
				$tempimg = $img[1][$i];
			}
		}
		$data['img'] = $tempimg;
		//$data['img'] = $img[1][0];
		$data['description'] = $title;
		if($data['price'] == false){
			$data['price'] = "";
		 }
		if($data['img'] == null)
		{
			$data['img'] = "";
		}
		if($data['description'] == null){
			$data['description'] = "";
		}
		 //print_r($data);
		//$data['description'] = '';
		
	}
	
	//判断网站域名,天猫
	if ($matches[0] == "tmall.com") {
		/*$start = '<div class="main-wrap J_TRegion">';
		$end   = '<div class="col-sub J_TRegion">';
		$content= CProduct::cut_html(@file_get_contents($url),$start,$end);*/
		$content= @file_get_contents($url);
		$title = iconv('gb2312','utf-8',CProduct::cut_html($content,'<h3 class="tb-tit">','</h3>'));//默认方案
		if($title==""){
			$title = iconv('gb2312','utf-8',CProduct::cut_html($content,'<title>','</title>'));//方案1,定位获取不到，则获取title
		}
		//$title = preg_replace("/(?=href=)([^>]*)(?=>)/i","",$data['title']);
		$title = strip_tags($title);
		$data['title'] = $title;
		$data['price'] = CProduct::cut_html($content,'<strong id="J_StrPrice" >','</strong>');
		preg_match_all("/<[img|IMG].*?src=[\'|\"]([^\']*?)[\'|\"].*?[\/]?>/", CProduct::cut_html($content,'<div class="tb-gallery">','</div>'), $img);
		//如果图片定位不到，则获取这个页面所有图片
		if(empty($img[1])){
		   preg_match_all("/<[img|IMG].*?src=[\'|\"]([^\']*?)[\'|\"].*?[\/]?>/", $content, $img);
		}
		for($i=0;$i<count($img[1]);$i++){
			list($width[$i], $height[$i]) = getimagesize($img[1][$i]);
			if($width[$i]>200 && $height[$i]>200){
				$tempimg = $img[1][$i];
			}
		}
		$data['img'] = $tempimg;
		/*$data['description'] = iconv('gb2312','utf-8',CProduct::cut_html($content,'<ul class="attributes-list">','</ul>'));
		$description = strip_tags($data['description']);
		$data['description'] = $description;*/
		$data['description'] = $title;
		if($data['price'] == false){
			$data['price'] = "";
		 }
		if($data['img'] == null)
		{
			$data['img'] = "";
		}
		if($data['description'] == null){
			$data['description'] = "";
		}
	}
	
	//判断网站域名,拍拍
	if ($matches[0] == "paipai.com") {
		//$start = '<div class="pfhlkd_main">';
		//$end   = '<div class="bd pfhlkd_bd_01">';
		//$content= CProduct::cut_html(@file_get_contents($url),$start,$end);
		$content= @file_get_contents($url);
		$data['title'] = iconv('gb2312','utf-8',CProduct::cut_html($content,"<h1>","</h1>"));
		$title = strip_tags($data['title']);
		$data['title'] = $title;
		$price = CProduct::cut_html($content,'<span class="p  c3 " ftag="price"><b>&yen;</b>','</em>');//默认价格方案
		//print_r($price);
		$price = strip_tags($price);
		if($price == ""){
			$price = CProduct::cut_html($content,'<span class="p">','</span>');//方案一,价格定位不到则取这里
		}
		$price = strip_tags($price);
		$data['price'] = $price;
		 preg_match_all("/<[img|IMG].*?src=[\'|\"]([^\']*?)[\'|\"].*?[\/]?>/", CProduct::cut_html($content,'<div class="picture">','</div>'), $img);//默认方案
		 //如果图片定位不到，则获取这个页面所有图片
		if(empty($img[1])){
		   preg_match_all("/<[img|IMG].*?src=[\'|\"]([^\']*?)[\'|\"].*?[\/]?>/", $content, $img);
		}
		for($i=0;$i<count($img[1]);$i++){
			list($width[$i], $height[$i]) = getimagesize($img[1][$i]);
			if($width[$i]>200 && $height[$i]>200){
				$tempimg = $img[1][$i];
			}
		}
		$data['img'] = $tempimg;
		// $data['img'] = $img[1][0];
		//$data['description'] = iconv('gb2312','utf-8',CProduct::cut_html($content,'<p align="left">','</p>'));
		$data['description'] = $title;
		if($data['price'] == false){
			$data['price'] = "";
		 }
		if($data['img'] == null)
		{
			$data['img'] = "";
		}
		if($data['description'] == null){
			$data['description'] = "";
		}
	}
	
	/*//判断网站域名,当当
	if ($matches[0] == "dangdang.com") {
		//$start = '<div class="dp_main">';
		//$end   = '<ul class="tab_title clearfix">';
		//$content= CProduct::cut_html(@file_get_contents($url),$start,$end);
		$content= @file_get_contents($url);
		$data['title'] = iconv('gb2312','utf-8',CProduct::cut_html($content,"<h1>","</h1>"));
		$title = strip_tags($data['title']);
		$data['title'] = $title;
		$data['price'] = CProduct::cut_html($content,'<span id="salePriceTag" class="num promotions_price_d">','</span>');
		 preg_match_all("/<[img|IMG].*?src=[\'|\"]([^\']*?)[\'|\"].*?[\/]?>/", CProduct::cut_html($content,'<div class="pic">','</div>'), $img);
		 $data['img'] = $img[1][0];
		//$data['description'] = iconv('gb2312','utf-8',CProduct::cut_html($content,'<p align="left">','</p>'));
		$data['description'] = $title;
	}
	
	//判断网站域名,凡客
	if ($matches[0] == "vancl.com") {
		//$start = '<div class="dp_main">';
		//$end   = '<ul class="tab_title clearfix">';
		//$content= CProduct::cut_html(@file_get_contents($url),$start,$end);
		$content= @file_get_contents($url);
		$data['title'] = iconv('gb2312','utf-8',CProduct::cut_html($content,"<h1>","</h1>"));
		$title = strip_tags($data['title']);
		$data['title'] = $title;
		$data['price'] = CProduct::cut_html($content,'<span id="salePriceTag" class="num promotions_price_d">','</span>');
		 preg_match_all("/<[img|IMG].*?src=[\'|\"]([^\']*?)[\'|\"].*?[\/]?>/", CProduct::cut_html($content,'<div class="pic">','</div>'), $img);
		 $data['img'] = $img[1][0];
		//$data['description'] = iconv('gb2312','utf-8',CProduct::cut_html($content,'<p align="left">','</p>'));
		$data['description'] = $title;
	}*/
	
	
		//$content = json_encode($data);//json数据返回
		//print_r($data);
		return $data;	
		//return $content;
	}
/**
 *
	 * 
	 * HTML切取
	 * @param string $html    要进入切取的HTML代码
	 * @param string $start   开始
	 * @param string $end     结束
	 */
	public  static function cut_html($html, $start, $end) {
		if (empty($html)) return false;
		$html = str_replace(array("\r", "\n"), "", $html);
		$start = str_replace(array("\r", "\n"), "", $start);
		$end = str_replace(array("\r", "\n"), "", $end);
		$html = explode(trim($start), $html);
		if(is_array($html)) $html = explode(trim($end), $html[1]);
		return $html[0];
	}
} 
?>