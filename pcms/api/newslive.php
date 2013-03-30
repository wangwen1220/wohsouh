<?php
$act = $_GET["p"];
if($act == "get_OfHelp") //官方帮助
	news_OfHelp();
elseif($act == "get_cGetFocusImages") //获取直播焦点图
	news_cGetFocusImages();
elseif($act == "get_getShowRightAd1") //获取直播首页右侧广告区块
	news_getShowRightAd1();
elseif($act =="get_OfNotice") //官方公告
	news_OfNotice();
elseif($act =="get_ofContact") //联系方式
	news_ofContact();
	
/**
 * 获得直播首页官方帮助
 */
function news_OfHelp() {
	include template('content','content_news_ofhelp');
}


/**
 * 获取直播首页轮换图片
 */
function news_cGetFocusImages() {
	include template('content','content_news_cgetfocusimages');
}


/**
 * 获得获取直播首页右侧广告区块
 */
function news_getShowRightAd1() {
	include template('content','content_news_getshowrightad1');
}


/**
 * 获得直播首页官方公告
 */
function news_OfNotice() {
	include template('content','content_news_ofnotice');
}

/**
 * 获得直播首页QQ联系方式
 */
function news_ofContact() {
	include template('content','content_news_ofcontact');
}


?>