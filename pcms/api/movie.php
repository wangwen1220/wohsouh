<?php
$act = $_GET["p"];
if($act == "content_click_hot")
	getMovieContentClickHot();
elseif($act == "get_recommend_day_news")
	getRecommendDayNews($_GET["siteid"],$_GET["catid"],$_GET["other_catids"]);
elseif ($act == "get_all_hot_news_rand")
	getAllHotNewsRand($_GET["siteid"]);
elseif ($act == "test")
	include template('content',$_GET["file"]);
elseif ($act == "get_muchweibo_dynamic")
	getMuchWeiboDynamic();
elseif( $act=="get_channel_hot_img" )
	getChannelHotImages($_GET["catids"],$_GET["num"]);
elseif($act=="get_site_hot_vedio")
	getSiteHotVedio();
elseif ($act == "get_readings_article")
	getReadingsArticle($_GET["relation"],$_GET["id"],$_GET["catid"],$_GET["keywords"]);
elseif ($act == "get_new_readings_article")
	getnewReadingsArticle($_GET["relation"],$_GET["id"],$_GET["catid"],$_GET["keywords"]);
elseif ($act == "get_hot_recommend_content")
	getHotRecommendContent($_GET["catid"],$_GET["posidimg"],$_GET["posid"]);
elseif ($act =="get_search_huoshow")
	getSearchHuoshow($_GET["siteid"]);
elseif ($act == "get_tags") //明星频道-标签
	getTags();
elseif ($act == "get_next_album") // 下一图集
	getNextAlbum($_GET["id"],$_GET["catid"]);
elseif ($act == "get_related_hot") //游戏列表-相关热点
	getRelatedHot($_GET["catid"]);
elseif ($act == "get_day_recommended") //游戏列表-今日推荐
	getDayRecommended($_GET["catid"]);
elseif ($act == "get_hot_news_ranking") //游戏列表-热点资讯排行
	getHotNewsRanking($_GET["catid"]);
elseif ($act == "get_tab_cutover") //游戏列表-tab切换
	getTabCutover($_GET["catid"]);
elseif ($act == "get_hot_video") //热点视频
	getHotVideo($_GET["catid"]);
elseif ($act == "get_game_grand_view") //游戏大观
	getGameGrandView($_GET["catid"]);
elseif ($act == "get_test") //测试
	getTest();

function getSiteHotVedio()
{
	include template('content','content_siteall_hot_vedio');
}

/**
 * 获得电影频道点击数排行榜
 */
function getMovieContentClickHot()
{
	$catid = $_GET["catid"];
	include template('content','content_movie_click_hot_news');
}

/**
 * 获得频道当天推荐新闻
 * @param unknown_type $current_catid 当前栏目ID形如 60
 * @param unknown_type $other_catids 其他需要显示的栏目列表形如：10,20|电视,30
 * 									  |后面接需要显示的中文名，不填则自动取
 */
function getRecommendDayNews($siteid,$current_catid,$other_catids)
{
	$other_catids_arr = explode(",", $other_catids);
	$sites = getcache('sitelist', 'commons');
	$site = $sites[$siteid];
	$categorys = getcache('category_content_'.$siteid,'commons');
	$cat_arr = array();
	for($i=0;$i<4;$i++)
	{
		if($i==0)
		{
			$cat_arr[$i]["cat_name"] = "本频道";
			$cat_arr[$i]["cat_id"] = $current_catid;
		}
		else
		{
			$tmp_cat_arr = explode("|", $other_catids_arr[$i-1]);
			$cat_arr[$i]["cat_name"] = count($tmp_cat_arr)>1?$tmp_cat_arr[1]:$categorys[$tmp_cat_arr[0]]["catname"];
			$cat_arr[$i]["cat_id"] = $tmp_cat_arr[0];
		}
	}
	include template('content','content_movie_get_recommend_daynews');
}

/**
 * 获得当前站点热点最高的新闻，随机输出
 * @param unknown_type $siteid
 */
function getAllHotNewsRand($siteid)
{
	include template('content','content_hot_news_rand');
}


/**
 * 获得指定频道的热点图片列表
 * @param unknown_type $catid	栏目ID 多个栏目用逗号分隔
 * @param unknown_type $num	取多少条 
 */
function getChannelHotImages($catids,$num)
{
	$img_count = $num;
	include template('content','content_channle_hot_images');
}

function getMuchWeiboDynamic()
{
	include template('content','content_much_weibo_dynamic');
}

/**
 * 相关阅读
 * @param unknown_type $relation
 * @param unknown_type $id
 * @param unknown_type $catid
 * @param unknown_type $keywords
 */
function getReadingsArticle($relation,$id,$catid,$keywords)
{
	include template('content','content_readings_article');
}


/**
 * 新版相关阅读
 * @param unknown_type $relation
 * @param unknown_type $id
 * @param unknown_type $catid
 * @param unknown_type $keywords
 */
function getnewReadingsArticle($relation,$id,$catid,$keywords)
{
	include template('content','content_new_readings_article');
}

/**
 * 热点推荐
 * @param unknown_type $catid
 * @param unknown_type $posidimg
 * @param unknown_type $posid
 */
function getHotRecommendContent($catid,$posidimg,$posid)
{
	include template('content','content_hot_recommend_content');
}

/**
 * @param 搜索
 */
function getSearchHuoshow($siteid)
{
	include template('content','search_header');
}

function getTags()
{
	include template('content','content_tages');
}

function getNextAlbum($id,$catid)
{
	include template('content','content_next_album');
}

function getTest()
{
	include template('content','index-test');
}

function getRelatedHot($catid)
{
	include template('content','content_related_hot');
}

function getDayRecommended($catid)
{
	include template('content','content_day_recommended');
}

function getHotNewsRanking($catid)
{
	include template('content','content_hot_news_ranking');
}

function getTabCutover($catid)
{
	include template('content','content_tab_cutover');
}

function getHotVideo($catid)
{
	include template('content','content_hot_video');
}

function getGameGrandView($catid)
{
	include template('content','content_game_grand_view');
}

?>