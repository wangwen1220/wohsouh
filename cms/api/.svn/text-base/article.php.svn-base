<?php
/**
 * 
 * 使用$db类操作cmstop数据库
 * 使用$db2类操作discuz数据库
 * 请尽量使用include方式调用api（调用实例：在页面相应位置<!--#include virtual ="{ROOT}api/article.php?act=getlistrollimage"-->）
 * 请尽量减少使用ajax调用api
 */
set_time_limit(0);
error_reporting(0);
session_start();
define('RUN_CMSTOP', true);

require '../cmstop/cmstop.php';
require_once 'Db.class.php';
$dbinc =  require_once '../cmstop/config/db.php';

$db = new Db($dbinc['host'],$dbinc['username'],$dbinc['password'],$dbinc['dbname'],$dbinc['charset']);
$table_pre = 'cmstop_';
$dzUrl = "http://space.beta.huoshow.com/";//内网测试地址
$dzDBName = 'huoshow_beta';//内网测试数据库
$dzPre = 'pre_';
$db2 = new Db($dbinc['host'],$dbinc['username'],$dbinc['password'],$dzDBName,$dbinc['charset']);


$act = $_GET['act'];
$type = $_GET['type'];
$index = $_GET['in'];
/*
 * $index 首页和影视页面排行榜的if
 * 火秀影视栏目-----电影，电视排行榜
 */
if($act=='movie_rank'){
	if ($_GET['type']=='neidi'){
		$id="b.`keys` LIKE 'movie_neidi'";
	}elseif($_GET['type']=='beimei'){
		$id="b.`keys` LIKE 'movie_beimei'";
	}else{
		$id="b.`keys` LIKE 'huoshow_tv'";
	}
	$sql = "SELECT a.* FROM pre_top a LEFT JOIN pre_top_type b ON a.type = b.id WHERE b.isopen='1' and $id ORDER BY a.sort ASC LIMIT 10 ";
	$rs = $db2->getAll($sql);
	foreach ($rs as $key=>$value){
		if($value[liters_drop]==1){
			$drop=rank_retain;
		}else if($value[liters_drop]==2){
			$drop=rank_up;	
		}else{
			$drop=rank_down;	 	
		}
		if($index=='movie'){
			if($key==0){
				echo'<div class="charts_top"><span class="'.$drop.'"></span><div class="charts_top_pic"><img alt="'.$value['title'].'" src="'.DX_URL.$value['image'].'" width="180" height="70" />
					</div><span class="charts_top_text"><a href="'.$value[link].'">'.str_cut($value[key],18,'').'</a></span></div>
					<ul class="charts_others">';
			}else{
				echo'<li><span class="'.$drop.'"></span><span class="charts_number">'.$value[value].'</span>';
				if ($value[link]){
					echo '<a href="'.$value[link].'">'.str_cut($value[key],18,'').'</a>';
				}else {
					echo str_cut($value['key'],18);
				}
				echo '</li>';

			}
		}else{
			echo'<li><span class="'.$drop.'"></span>';
			if ($value[link]){
				echo '<a href="'.$value[link].'">'.str_cut($value[key],18,'').'</a>';
			}else {
				echo str_cut($value['key'],18);
			}
			echo '</li>';
		}
	}
	if($index=='movie'){
		echo'</ul>';
		echo '<div class="clear">&nbsp;</div>';
	}
	die();

}

/*
 * 火秀音乐栏目--内地/日韩/港台/欧美音乐排行榜
 */
if ($act=='neidirank'){
	if($type=='neidi'){
		$type="b.`keys` LIKE 'music_neidi'";
	}else if($type=='rihan'){
		$type="b.`keys` LIKE 'music_rihan'";
	}else if($type=='tai'){
		$type="b.`keys` LIKE 'music_gangtai'";
	}else{
		$type="b.`keys` LIKE 'music_oumei'";
	}
	$sql = "SELECT a.* FROM pre_top a LEFT JOIN pre_top_type b ON a.type = b.id WHERE b.isopen='1' and $type ORDER BY a.sort ASC LIMIT 10 ";
	$rs = $db2->getAll($sql);
	echo '<ul>';
	foreach ($rs as $key=>$value){
		if($value[liters_drop]==1){
			$drop=rank_retain;
		}else if($value[liters_drop]==2){
			$drop=rank_up;	
		}else{
			$drop=rank_down;	 	
		}
		echo '<li><span class="'.$drop.'"></span><span class="charts_number">'.str_cut($value['value'],8,"").' </span>';
		if ($value['link']){
			echo '<a href="'.$value['link'].'">'.str_cut($value['key'],20).'</a>';
		}else {
			echo str_cut($value['key'],20);
		}
		echo '</li>';
	}
	echo '</ul>';
	die();
}

/*
 * 火秀明星栏目--火秀明星/内地/日韩/港台/欧美/明星图库排行榜
 */
if ($act=='starrank'){
	if($type=='huoshowmingxing'){
		$type="b.`keys` LIKE 'star_huoshowmingxing'";
	}else if($type=='starindex'){
		$type="b.`keys` LIKE 'star_indexpaihang'";
	}else if($type=='neidi'){
		$type="b.`keys` LIKE 'star_neidi'";
	}else if($type=='gangtai'){
		$type="b.`keys` LIKE 'star_gangtai'";
	}else if($type=='rihan'){
		$type="b.`keys` LIKE 'star_rihan'";
	}else if($type=='oumei'){
		$type="b.`keys` LIKE 'star_oumei'";
	}else{
		$type=='tuku';
		$type="b.`keys` LIKE 'star_tuku'";
	}
	$sql = "SELECT a.* FROM pre_top a LEFT JOIN pre_top_type b ON a.type = b.id WHERE b.isopen='1' and $type ORDER BY a.sort ASC LIMIT 10 ";
	$rs = $db2->getAll($sql);
	foreach ($rs as $key=>$value){
		//print_r($value);
		if($value[liters_drop]==1){
			$drop=trend1;
		}else if($value[liters_drop]==2){
			$drop=trend2;	
		}else{
			$drop=trend3;	 	
		}
		if ($value['link']){
			echo '<tr><td></td><td><a href="'.$value['link'].'">'.str_cut($value['key'],18).'</a></td>';
		}else {
			echo '<tr><td></td><td>'.str_cut($value['key'],18).'</td>';
		}
		echo '<td>'.str_cut($value['value'],4).'</td><td class="'.$drop.'"></td></tr>';
	}
	die();
}


if ($act=='gethsgameweekwelcome')
{	
	$sql = "SELECT a.* FROM pre_top a LEFT JOIN pre_top_type b ON a.type = b.id WHERE b.`keys` LIKE 'hsgameweekwelcome' ORDER BY a.sort ASC LIMIT 10 ";
	$rs = $db2->getAll($sql);
	foreach ($rs as $key=>$value){
		if ($key==0){
			echo '<div class="charts_top"> <span class="charts_top_text"><a href="'.$value['link'].'" target="_blank">'.$value['key'].'</a></span>
				<div class="charts_top_pic">
				<img alt="'.$value['title'].'" src="'.DX_URL.$value['image'].'" width="109" height="75" /><span class="charts_top_text_briefing">'.$value['key2'].'：'.$value['value2'].'<br/>'.$value['key2'].'：'.$value['value3'].'<br/>'.$value['key4'].'：'.$value['value4'].'<br/>'.$value['key5'].'：'.$value['value5'].'</span>
				</div>
				</div><div class="charts_game_list">
				<ul>';
		}else{
			echo '<li><span class="charts_game_list_text"><a href="'.$value['link'].'" target="_blank">'.$value['key'].'</a></span><span class="charts_number">'.$value['value'].'人关注</span> </li>';
		}
	}
	if ($rs){
		echo '</ul></div>';
	}
	die();
}


//最受关注游戏榜单
if($act == 'getMostAttentionGame')
{
	$sql = "SELECT * FROM pre_top WHERE TYPE IN(SELECT id FROM pre_top_type WHERE `keys`='mostattentiongame') LIMIT 10";
	$rs = $db2->getAll($sql);
	foreach ($rs as $key=>$value){
		if($value[liters_drop]==1){
			$drop=rank_up;
		}else if($value[liters_drop]==2){
			$drop=rank_retain;	
		}else{
			$drop=rank_down;	 	
		}
		echo '<li><span class="'.$drop.'"></span>';
		if ($value[link]){
			echo '<a href="'.$value[link].'">'.$value['key'].'</a>';
		}else {
			echo $value['key'];
		}
		echo '</li>';
	}
	die();
}

//赛事排行榜
if($act == 'getEventsList')
{
	$sql = "SELECT * FROM pre_top WHERE TYPE IN(SELECT id FROM pre_top_type WHERE `keys`='eventslist') LIMIT 10";
	$rs = $db2->getAll($sql);
	foreach ($rs as $key=>$value){
		if($value[liters_drop]==1){
			$drop=rank_retain;
		}else if($value[liters_drop]==2){
			$drop=rank_up;	
		}else{
			$drop=rank_down;	 	
		}
		echo '<li><span class="'.$drop.'"></span>';
		if ($value[link]){
			echo '<a href="'.$value[link].'">'.$value['key'].'</a>';
		}else {
			echo $value['key'];
		}
		echo '</li>';
	}
	die();
}

//首页音乐榜单
if ($act == 'getMusicList')
{
	if ($_GET['type'] == 'music_gangtai'){
		$type="`keys` LIKE 'music_gangtai'";
	}else if ($_GET['type'] == 'music_rihan'){
		$type="`keys` LIKE 'music_rihan'";
	}else if ($_GET['type'] == 'music_oumei'){
		$type="`keys` LIKE 'music_oumei'";
	}else {
		$type="`keys` LIKE 'music_neidi'";
	}
	$sql = "SELECT * FROM pre_top WHERE TYPE IN(SELECT id FROM pre_top_type WHERE $type ) LIMIT 10";
	//echo $sql;
	$rs = $db2->getAll($sql);
	foreach ($rs as $key=>$value){
		if($value[liters_drop]==1){
			$drop=rank_up;
		}else if($value[liters_drop]==2){
			$drop=rank_retain;	
		}else{
			$drop=rank_down;	 	
		}
		echo '<li><span class="'.$drop.'"></span>';
		if ($value[link]){
			echo '<a href="'.$value[link].'">'.str_cut($value[key],18,'').'</a>';
		}else {
			echo str_cut($value['key'],18);
		}
		echo '</li>';
	}
	die();
}

//$clientIp = getClientIp();
/**
 * 文章页今日焦点
 */
if ($act=='gettodayfocus'){
	//$sql = "SELECT * FROM cmstop_section  WHERE memo LIKE 'huoshow_other_today_focus_news' ";
	//$r = $db->getRow($sql);		
	//$showNums = $r[num];
	//$sectionId = $r[sectionid];
	//$sql = "select * from cmstop_section_data  where sectionid = $sectionId  order by sort  desc limit 4";
	//$rs = $db->getAll($sql);
	$sql = "select a.*,b.* from cmstop_section a left join cmstop_section_data b on a.sectionid = b.sectionid where a.memo like 'huoshow_other_today_focus_news' and b.thumb!=''  order by b.created desc limit 4";
    $rs = $db->getAll($sql);
	foreach ($rs as $key=>$value){
		//echo '<li><a href="'.$r[url].'" target="_blank">'.$r['title'].' </a></li>';	
		echo '<li><a href="'.$value[url].'" target="_blank"><img alt="'.$value['title'].'" src="'.WWW_URL.'upload/'.$value['thumb'].'" width="120" height="90" "/></a><a href="'.$value[url].'" target="_blank">'.str_cut($value[title],12,'').' </a></li>';
	}
	die();
}




/**
 * 列表页滚动图片
 */
if ($act=='getrollimg'){
	$sql = "SELECT * FROM  cmstop_section WHERE memo = '".$_GET['memo']."' ";	
	$row = $db->getRow($sql);
	$showNums = $row['num'];
	$sectionId = $row['sectionid'];	
	$sql = "SELECT * FROM cmstop_section_data WHERE `sectionid` = $sectionId AND `thumb` !='' ORDER  BY `sort`  DESC LIMIT $showNums ";	
	$rs = $db->getAll($sql);	
	$totalWidth = $_GET['width'];	
	$totalHeight = $_GET['height'];
	$dem = $_GET['dem'];
	$imgHeight = $totalHeight -$dem;
	$navOnImg = $_GET['navon'];
	if($navOnImg=='1'){
		$navHeight = 22;
		$navStyle="padding-bottom:".$navHeight.'px;bottom:0px;';
		$totalStyle='height:'.$totalHeight.'px;';

	}else{
		$navStyle = 'bottom:0px;';
		$navHeight = 0;
		$totalStyle='';
	}

	echo '<div class="common-roll-slide" id="'.$_GET['memo'].'">
		<div class="common-roll-slide-body">
		<div class="common-roll-slide-pages">';
	$count = 1;
	foreach ($rs as $k=>$r){
		echo '<div class="common-roll-slide-page">
			<div>
			<a href="'.$r[url].'" target="_blank"><img alt="'.$r['title'].'" src="'.WWW_URL.'upload/'.$r[thumb].'"/></a>
			</div>
			<div class="common-roll-slide-page-info" ';
		if ($showNums==1){
			echo ' style="padding-bottom:0;" ';
		}
		echo '>
			<div class="common-roll-slide-page-info-text">
			<h3><a href="'.$r[url].'" target="_blank">'.str_cut($r[title],40,"").'</a></h3>
			<p><a href="'.$r[url].'" target="_blank">'.str_cut($r[description],80).'</a></p>
			</div>
			</div>
			</div>';
		$count++;         
	}
	echo ' </div> ';
	if ($showNums>1){
		echo ' <div class="common-roll-slide-nav">
			<span class="common-roll-slide-nav-right">
			<a href="#" class="common-roll-slide-prev">&nbsp;</a>
			<a href="#" class="common-roll-slide-next">&nbsp;</a>
			</span>
			<span class="common-roll-slide-nav-links">';
		for($i=1; $i<$count; $i++) {
			echo '<a href="#">'.$i.'</a>';
		}
		echo ' </span>
			</div>';
	}
	echo '</div>
		</div>';
	if ($showNums>1){
		echo "
			<script>
window.slide_".$_GET['memo']." = make_pagebox('".$_GET['memo']."', {
	links_selector: '.common-roll-slide-nav-links a',
		pages_selector: '.common-roll-slide-page',
		prev_selector: '.common-roll-slide-prev',
		next_selector: '.common-roll-slide-next',
		current_class: 'common-roll-slide-curr',
		interval: 5,
		effect: 1
	});
		</script>
	";}
	die();             
}

/**
 * *排行榜
 */
if ($act == 'ranking_list'){
	if ($_GET['type']=='day'){
		$rs = getNewsDayClick();
	}
	if ($_GET['type']=='week'){
		$rs = getNewsWeekClick();
	}
	if ($_GET['type']=='month'){
		$rs = getNewsMonthClick();
	}
	echo $rs;
	die(); 	

}
//影视排行榜
if ($act == 'moive_rank'){
    $sql = "SELECT title,url,pv,thumb FROM ".$table_pre."content WHERE  catid  = 39 order by pv desc limit 1 ";
	$row = $db->getRow($sql);
	$row['title']=str_cut($row[title],10);	

	$sql2 = "SELECT title,url,pv,thumb FROM ".$table_pre."content WHERE  catid  = 39 order by pv desc limit 1,10 ";
	$row2 = $db->getAll($sql2);

	$i=0;
	foreach ($row2 as $k=>$v){
		$row2[$i]=$v;
		$row2[$i]['title']=str_cut($v[title],8);
		$i++;
	}
	$array = array('rs1'=>$row,'rs2'=>$row2);
	die(json_encode($array));
}
//影视栏目--正在热眏电影电视
if ($act == 'movie_tv'){
	if ($_GET['type']=='movie'){
		$type="s.memo = 'huoshow_movie_index_hot_film'";
	}else{
		$type="s.memo = 'huoshow_movie_index_hot_tv'";
	}
    $sql = "SELECT d.title,d.url,d.thumb FROM cmstop_section s LEFT JOIN cmstop_section_data d ON d.sectionid=s.sectionid WHERE $type and d.thumb!='' ORDER BY d.sort desc limit 4 ";
    $row = $db->getAll($sql);
	$i=0;
	echo '<ul class="hot_movie_ul">';
	foreach ($row as $k=>$v){
		$row[$i]=$v;
		$row[$i]['title']=str_cut($v[title],8);
		$i++;
		echo '<li><div class="hot_movie_block"><a href="'.$v[url].'"><span class="hot_movie_text">'.str_cut($v['title'],14,'').'</span></a></div><a href="'.$v[url].'"><img alt="'.$v['title'].'" src="'.WWW_URL.'upload/'.$v[thumb].'" width="105" height="142" /></a></li>';
	 }
	 echo '</ul>';
	 die();
	}
	//$array = array('rs'=>$row);
	//die(json_encode($array));
/**
 * 增加PV获取内容
 */
if ($act=='getContentInfo'){
	$contentId = $_GET['id'];
	//echo $_SESSION['getContentInfo'.$contentId];
	if ($_SESSION['getContentInfo'.$contentId]){
		$cookieTime = $_SESSION['getContentInfo'.$contentId];
		if (time()-$cookieTime>3600){
			$_SESSION['getContentInfo'.$contentId]=time();
			addPv($contentId);
		}
	}else{
		$_SESSION['getContentInfo'.$contentId]=time();
		addPv($contentId);
	}	
	$sql = "SELECT pv,comments  FROM ".$table_pre."content WHERE  contentid  = $contentId ";	
	$row = $db->getRow($sql);
	if ($row){
		echo '<script type="text/javascript">(function($){';
		echo '$("#commentnums").html('.$row['comments'].');
		$("#pvnums").html('.$row['pv'].');';
		echo '})(jQuery);</script>';
		//$array = array('status'=>1,'rs'=>$row);
	} else {
		//$array = array('status'=>0);
	}
	die();

}

/**
 * 
 * 获取下一个图集
 */
if ($act=='getPictureNextNews'){
	$contentId = $_GET['contentid'];
	$catid = $_GET['catid'];
	$sql = "SELECT a.contentid,b.title,b.url,b.thumb FROM ".$table_pre."picture  a LEFT JOIN ".$table_pre."content b ON a.contentid = b.contentid WHERE a.contentid > $contentId AND b.catid = $catid limit 1";
	$nextPic = $db->getRow($sql);
	if (!$nextPic){
		echo '<div class="no-photos">没有找到下一个图集</div>';

	}else{
		if ($nextPic['thumb']){		
			$thumbImg = $nextPic['thumb'];
			$thumbImg = '<img src="'.thumb($thumbImg,110,74).'"  />';
		}else{
			$thumbImg = IMG_URL.'images/nopic.gif';
			$thumbImg = '<img src="'.$thumbImg.'" width="110" height="74" />';
		}

		$nextHtml = '
			<div class="pic_left_list_pic">
			<table>
			<tr>
			<td class="imgre" >
			<a href="'.$nextPic['url'].'">'.$thumbImg.'</a>
			</td>
			</tr>
			</table>
			</div>
			<span class="pic_left_list_pic_text"><a href="'.$nextPic['url'].'">'.str_cut($nextPic['title'],16,'').'</a></span><br>
			<span class="pic_left_list_pic_text_01"><a href="'.$nextPic['url'].'">下一图集 ></a></span>';

		echo $nextHtml;	
	}
}
/**
 * 
 * 获取上一个图集
 */
if ($act=='getPicturePreNews'){
	$contentId = $_GET['contentid'];	
	$catid = $_GET['catid'];
	$sql = "SELECT a.contentid,b.title,b.url,b.thumb FROM ".$table_pre."picture  a LEFT JOIN ".$table_pre."content b ON a.contentid = b.contentid WHERE a.contentid < $contentId  AND b.catid = $catid order BY a.contentid DESC limit 1";
	//echo $sql;die();
	$prePic = $db->getRow($sql);
	if (!$prePic){
		echo '<div class="no-photos">没有找到上一个图集</div>';

	}else{
		if ($prePic['thumb']){		
			$thumbImg = $prePic['thumb'];
			$thumbImg = '<img src="'.thumb($thumbImg,110,74).'"  />';
		}else{
			$thumbImg = IMG_URL.'images/nopic.gif';
			$thumbImg = '<img src="'.$thumbImg.'" width="110" height="74" />';
		}
		$preHtml = '
			<div class="pic_left_list_pic">
			<table>
			<tr>
			<td class="imgre" >
			<a href="'.$prePic['url'].'">'.$thumbImg.'</a>
			</td>
			</tr>
			</table>
			</div>
			<span class="pic_left_list_pic_text"><a href="'.$prePic['url'].'">'.str_cut($prePic['title'],16,'').'</a></span><br>
			<span class="pic_left_list_pic_text_01"><a href="'.$prePic['url'].'">< 上一图集</a></span>';
		echo $preHtml;	
	}
}

/**
 * 
 * 获取火秀排行榜首页左边导航条
 */
if ($act=='getChartsIndexLeftNav'){
	echo '<div id="menu">
		<h1 class="top_xian"><a href="/huoshow_charts" class="d"><img src="/img/templates/huoshow02/images/12.png" width="3" height="5" /> 榜单首页</a></a></h1>';
	$sql = "SELECT id , name FROM pre_top_type WHERE parentid = 0 AND categories = 1 AND isopen = 1 ORDER BY id ASC";
	$row = $db2->getAll($sql);
	$i = 0;
	foreach ($row as $k=>$v){
		$sql2 = "SELECT id,name FROM pre_top_type WHERE parentid = ".$v['id']." AND categories = 0 AND isopen = 1";
		$row2 = $db2->getAll($sql2);
		if(!empty($row2)){
			echo '<h1 onClick="javascript:ShowMenu(this,'.$i.');ShowChartsList('.$v['id'].')"><a href="javascript:void(0)"><img src="/img/templates/huoshow02/images/+.png" width="9" height="9" /> '.$v['name'].'</a></h1>
				<span class="no">';
			$j = 0;
			foreach ($row2 as $k2=>$v2){
				echo '<h2><a href="javascript:void(0)"><img src="/img/templates/huoshow02/images/12.png" width="3" height="5" /> '.$v2['name'].'</a></h2>';
				$j = $j + 1;
			}
			echo '</span>';
		}else{
			echo   '<h1 onclick="javascript:ShowChartsList('.$v['id'].')"><a href="#" class="d"><img src="/img/templates/huoshow02/images/12.png" width="3" height="5" /> '.$v['name'].'</a></h1>';
		}
		$i= $i + 1;
	}

	echo   '</div>';
}

/*
 ** 获取火秀排行榜首页排行榜列表
 */
if ($act=='getChartsIndexChartsList'){
	/*
	**查询推荐的排行榜
	*/
	//查询所有非一级栏目的栏目
	$sql = "SELECT id , parentid , name FROM pre_top_type WHERE parentid <> 0 AND categories = 0 AND isopen = 1 AND isrecommend = 1 ORDER BY parentid ASC";
	$row = $db2->getAll($sql);
	$i = 1;
	echo '<dt id="isrecommend">';
	foreach ($row as $k=>$v){
		//查询本栏目所属于的父栏目
		$sql2 = "SELECT id,name FROM pre_top_type WHERE id = ".$v['parentid'];
		$row2 = $db2->getRow($sql2);
		//查询本栏目下的排行清单
		$sql3 = "SELECT * FROM pre_top WHERE type = ".$v['id']." ORDER BY sort ASC LIMIT 0,10";
		$row3 = $db2->getAll($sql3);
		//查询结果不为空并且父栏目存在则显示排行列表
		if(!empty($row3) && !empty($row2)){
			echo '<div class="index_Chartslist_0'.$i.'">
				<div class="index_Chartslist_01_bt">'.$row2['name'].' - '.$v['name'].'</div>
				<div class="index_Chartslist_others">
				<ul>';
			foreach ($row3 as $k3=>$v3){
				if($v3['liters_drop']==1){
					//排行上升
					$css_style = 'rank_up';	
				}elseif($v3['liters_drop']==2){
					//排行不变
					$css_style = 'rank_retain';
				}elseif($v3['liters_drop']==3){
					//排行下降
					$css_style = 'rank_down';
				}
				//判断是否有链接
				if(!empty($v3['link'])){
					echo '<li><span class="index_Chartslist_text"><a href="'.$v3['link'].'">'.$v3['key'].'</a></span><span class="x"></span><span class="'.$css_style.'"></span></li>';
				}else{
					echo '<li><span class="index_Chartslist_text">'.$v3['key'].'</span><span class="x"></span><span class="'.$css_style.'"></span></li>';
				}
			}
			echo '</ul>
				</div>
				<div class=" clear"></div>
				<!--
				<p class="index_Chartslist_01_wenzi" style="display:none;">来源：新浪网<br>时间：2011-5-2</p>
				<span class="index_Chartslist_01_anniu_more" style="display:none;"><a href=""><span class="Best_Member_anniu_sanxiao"><<</span> 查看更多</a></span>
				-->

				</div>';
			if($i < 3){
				$i = $i + 1;
			}else{
				$i = 1;	
				//输出行间距
				echo '<div style="width:745px; height:8px; float:left;"></div>';
			}
		}
	}
	echo '</dt>';
	
	/*
	**查询各个分类的排行榜，但默认隐藏显示。
	*/
	//查询所有的父栏目
	$sql = "SELECT id , name FROM pre_top_type WHERE parentid = 0 AND categories = 1 AND isopen = 1 ORDER BY id ASC";
	$row = $db2->getAll($sql);
	foreach ($row as $k=>$v){
		echo '<dd id="parentid_'.$v['id'].'" style="display:none;">';
		//查询所有父栏目下的子栏目
		$sql2 = "SELECT id,name FROM pre_top_type WHERE parentid = ".$v['id']." AND categories = 0 AND isopen = 1";
		$row2 = $db2->getAll($sql2);
		$i = 1;
		foreach ($row2 as $k2=>$v2){
			//查询本栏目下的排行清单
			$sql3 = "SELECT * FROM pre_top WHERE type = ".$v2['id']." ORDER BY sort ASC LIMIT 0,10";
			$row3 = $db2->getAll($sql3);
			//查询结果不为空并且父栏目存在则显示排行列表
			echo '<div class="index_Chartslist_0'.$i.'">
				<div class="index_Chartslist_01_bt">'.$v['name'].' - '.$v2['name'].'</div>
				<div class="index_Chartslist_others">
				<ul>';
			foreach ($row3 as $k3=>$v3){
				if($v3['liters_drop']==1){
					//排行上升
					$css_style = 'rank_up';	
				}elseif($v3['liters_drop']==2){
					//排行不变
					$css_style = 'rank_retain';
				}elseif($v3['liters_drop']==3){
					//排行下降
					$css_style = 'rank_down';
				}
				//判断是否有链接
				if(!empty($v3['link'])){
					echo '<li><span class="index_Chartslist_text"><a href="'.$v3['link'].'">'.$v3['key'].'</a></span><span class="x"></span><span class="'.$css_style.'"></span></li>';
				}else{
					echo '<li><span class="index_Chartslist_text">'.$v3['key'].'</span><span class="x"></span><span class="'.$css_style.'"></span></li>';
				}
			}
			echo '</ul>
				</div>
				<div class=" clear"></div>
				<!--
				<p class="index_Chartslist_01_wenzi" style="display:none;">来源：新浪网<br>时间：2011-5-2</p>
				<span class="index_Chartslist_01_anniu_more" style="display:none;"><a href=""><span class="Best_Member_anniu_sanxiao"><<</span> 查看更多</a></span>
				-->

				</div>';
			if($i < 3){
				$i = $i + 1;
			}else{
				$i = 1;	
				//输出行间距
				echo '<div style="width:745px; height:8px; float:left;"></div>';
			}
			
		}
		echo '</dd>';
	}
}


if ($act=='get_col_list'){
	$pid = $_GET['pid'];
	$alias='';
	$finalAlias = getAlias($pid);	
	$sql = "SELECT catid,alias,name  FROM ".$table_pre."category WHERE parentid = '$pid'";
	$pidlist = $db->getAll($sql);
	foreach ($pidlist as $k=>$v){
		echo '<div class="subpage_news_bt"><a href="'.WWW_URL.$finalAlias.$v['alias'].'" class="bt1" style="float:right;padding-right:20px;">更多</a><h2 class="bt1">'.$v['name'].'</h2></div>';
		echo '<ul>';
		$sql = "SELECT title,url,published FROM ".$table_pre."content WHERE catid = ".$v['catid']." ORDER BY contentid DESC LIMIT 10 ";
		$conList = $db->getAll($sql);
		$i=0;
		foreach ($conList as $key=>$value)
		{
			if ($i%5==0 and $i!=0){
				echo '</ul><ul>';
			}
			echo '<li><span class="date_011"><a href="'.$value[url].'" target="_blank">'.$value[title].'</a>
				</span><span class="date_01">'.date("Y-m-d", $value[published]).'</span></li>';
			$i++;

		}
		echo '</ul>';
		echo '<div class="clear"></div>';
	}

}

if ($act=='get_header_rollnews_keywords'){
	$sql="SELECT * FROM ".$table_pre."section s LEFT JOIN ".$table_pre."section_data d ON d.sectionid=s.sectionid WHERE s.memo = 'huoshow_index_top_roll_news'  ORDER BY d.sort desc limit 10";

	$rst = $db->getAll($sql);
	$rollnews = ' <h1 class="rolling_news_title">滚动新闻：</h1>
		<div class="rolling_news_bd" id="top_roll_news">
		<span class="rolling_news_nav">
		<a class="rolling-news-up">&nbsp;</a>
		<a class="rolling-news-down">&nbsp;</a>
		</span>';
	foreach ($rst as $k=>$r){
		$rollnews.= ' <div class="rolling-news-item">
			<span class="rolling_news_text"><a href="'.$r[url].'" target="_blank">'.$r[title].'</a></span>
			<span class="rolling_news_date">'.date("m-d",$r[created]).'</span>
			</div>';
	}
	$rollnews.="  </div><script>
		var top_roll_news = make_scrollbox('top_roll_news', {
			item: '.rolling-news-item',
				prev: '.rolling-news-up',
				next: '.rolling-news-down',
				type: 'y',
				interval: 5
});
</script>";
	//huoshow_index_top_keywords
	$sql="SELECT * FROM ".$table_pre."section_data  d LEFT JOIN ".$table_pre."section s ON d.sectionid=s.sectionid WHERE s.memo = 'huoshow_index_top_keywords'  ORDER BY d.sort desc limit 4";


	$rst = $db->getAll($sql);
	$keywords = '';
	if ($rst){
		foreach ($rst as $k=>$r){
			$keywords .= '<a target="_blank" href="'.WWW_URL.'app/?app=search&controller=index&action=search&type=all&wd='.urlencode($r['title']).'">'.$r['title'].'</a> ';
		}
	}	
	$html = '<div class="rolling_news" >'.$rollnews.'</div>';	
	if($_GET['do']=='ajax'){
		echo $_GET['jsoncallback'].'('.json_encode(array('html'=>$html)).')';  
	}else{		
		echo $html;           
	}

}

if ($act=='getParentColumnName'){
	$catid= $_GET['catid'];
	
	$pname='';
	$finalPname = getPcname($catid);
	echo $finalPname;
	
}
function getPcname($pid){
	global $pname,$db,$table_pre;
	$sql = "SELECT catid,parentid,name FROM ".$table_pre."category WHERE catid = '$pid'";	
	$row = $db->getRow($sql);
	
	if (!empty($row['parentid']))
	{
		
		getPcname($row['parentid']);
	}
	$pname =$row['name'].'_'.$pname;
	return $pname;
}

function getAlias($catid){
	global $db,$table_pre,$alias;
	$sql = "SELECT alias,parentid FROM ".$table_pre."category WHERE catid = '$catid'";
	$pinfo = $db->getRow($sql);

	if (!empty($pinfo['parentid'])){
		getAlias($pinfo['parentid']);
	}
	$alias .= $pinfo['alias'].'/';
	return $alias;
}
function getNewsDayClick(){
	global $db,$table_pre;
	$stime =strtotime(date("Y-m-d").'00:00:00');
	$sql = "select * from ".$table_pre."content where published >UNIX_TIMESTAMP()-24*3600 and thumb!='' ORDER BY pv DESC limit 2";
	$rs = $db->getAll($sql);
	echo '<div class="zixun_pic_right">';
	echo '<ul>';
	foreach ($rs as $k=>$v){
		$thumbDay = $v['thumb'];
		$thumbDay = '<img src="'.thumb($thumbDay,120,120).'"  />';
	echo '<li><table><tbody><tr><td class="xx_imgre"><a href="'.$v[url].'" target="_blank">'.$thumbDay.'</a></td></tr></tbody></table><a href="'.$v[url].'" target="_blank">'.str_cut($v[title],12,'').' </a></li>';
	}
	echo '</ul>';
	echo '</div>';
	echo '<div class="clear"></div>';
	$sql = "select * from ".$table_pre."content where published >UNIX_TIMESTAMP()-24*3600 ORDER BY pv DESC limit 2,8";
	$rs = $db->getAll($sql);
	echo '<div class="right_newslist_ph">';
	echo '<ul>';
	//$i=0;
	//$html = '<ul>';                              
	foreach ($rs as $k=>$v){
		//$html.='<li><span class="icon'.($i+1).'"></span><a href="'.$v['url'].'" target="_blank" >'.str_cut($v['title'], 38,'').'</a></li>';
		//$i++;
		echo '<li><a href="'.$v[url].'" target="_blank">'.str_cut($v[title],34,'').' </a></li>';
	}
	echo '</ul>';
	echo '</div>';
	//return $html.'</ul>';
}

function getNewsWeekClick(){
	global $db,$table_pre;
	$stime = mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y"));
	$sql = "select * from ".$table_pre."content where published >UNIX_TIMESTAMP()-7*24*3600 and thumb!='' ORDER BY pv DESC limit 2";
	$rs = $db->getAll($sql);
	echo '<div class="zixun_pic_right">';
	echo '<ul>';
	foreach ($rs as $k=>$v){
		$thumbWeek = $v['thumb'];
		$thumbWeek = '<img src="'.thumb($thumbWeek,120,120).'"  />';
	echo '<li><table><tbody><tr><td class="xx_imgre"><a href="'.$v[url].'" target="_blank">'.$thumbWeek.'</a></td></tr></tbody></table><a href="'.$v[url].'" target="_blank">'.str_cut($v[title],12,'').' </a></li>';
	}
	echo '</ul>';
	echo '</div>';
	echo '<div class="clear"></div>';
	//$i=0;

	//$html = '<ul>';
	$sql = "select * from ".$table_pre."content where published >UNIX_TIMESTAMP()-7*24*3600 ORDER BY pv DESC limit 2,8";
	$rs = $db->getAll($sql);
	echo '<div class="right_newslist_ph">';
	echo '<ul>';
	foreach ($rs as $k=>$v){
		//$html.='<li><span class="icon'.($i+1).'"></span><a href="'.$v['url'].'" target="_blank" >'.str_cut($v['title'], 38,'').'</a></li>';
		//$i++;
		echo '<li><a href="'.$v[url].'" target="_blank">'.str_cut($v[title],34,'').' </a></li>';
	}
	echo '</ul>';
	echo '</div>';
	//return $html.'</ul>';
}

function getNewsMonthClick(){
	global $db,$table_pre;
	//$stime = strtotime(date("Y-m").'-01 00:00:00');
	$sql = "select * from ".$table_pre."content where published >UNIX_TIMESTAMP()-30*24*3600 and thumb!='' ORDER BY pv DESC limit 2";
	$rs = $db->getAll($sql);
	echo '<div class="zixun_pic_right">';
	echo '<ul>';
	foreach ($rs as $k=>$v){
		$thumbMoth = $v['thumb'];
		$thumbMoth = '<img src="'.thumb($thumbMoth,120,120).'"  />';
	//echo '<li><a href="'.$v[url].'" target="_blank"><img alt="'.$v['title'].'" src="'.WWW_URL.'upload/'.$v['thumb'].'" width="120" height="90" "/></a><a href="'.$v[url].'" target="_blank">'.str_cut($v[title],12,'').' </a></li>';
	echo '<li><table><tbody><tr><td class="xx_imgre"><a href="'.$v[url].'" target="_blank">'.$thumbMoth.'</a></td></tr></tbody></table><a href="'.$v[url].'" target="_blank">'.str_cut($v[title],12,'').' </a></li>';
	}
	echo '</ul>';
	echo '</div>';
	echo '<div class="clear"></div>';
	$sql = "select * from ".$table_pre."content where published >UNIX_TIMESTAMP()-30*24*3600 ORDER BY pv DESC limit 2,8";
	$rs = $db->getAll($sql);
	//$i=0;
	//$html = '<ul>';
	echo '<div class="right_newslist_ph">';
	echo '<ul>';
	foreach ($rs as $k=>$v){
		//$html.='<li><span class="icon'.($i+1).'"></span><a href="'.$v['url'].'" target="_blank" >'.str_cut($v['title'], 38,'').'</a></li>';
		//$i++;
		echo '<li><a href="'.$v[url].'" target="_blank">'.str_cut($v[title],34,'').' </a></li>';
	}
	echo '</ul>';
	echo '</div>';
	//return $html.'</ul>';
}

function addPv($contentId){
	global $db,$table_pre;
	$sql = "update ".$table_pre."content set pv = pv+1 where contentid  = $contentId ";
	$db->query($sql);
}

//内容页热门频道图片
if ($act == 'getContentPictures') {
	$description = $_GET['description'];
	$sql = "SELECT * FROM cmstop_section s LEFT JOIN cmstop_section_data d ON d.sectionid=s.sectionid WHERE s.memo = '$description' and d.thumb!='' ORDER BY d.sort desc limit 6";
	$rs = $db->getAll($sql);
	echo '<ul>';
	foreach ($rs as $k=>$v){
		echo '<li><a href="'.$v['url'].'" target="_blank"><img alt="'.$v['title'].'" src="'.WWW_URL.'upload/'.$v['thumb'].'" width="120" height="90" />'.str_cut($v['title'], 18,'').'</a></li>';
	}
	echo '</ul>';
}

//内容页精彩推荐
if ($act == 'getWonderfulRecommend'){
	$recommend = $_GET['recommend'];
	//echo '<div class="xss_text_texttu">';
	//$sql = "SELECT * FROM cmstop_section s LEFT JOIN cmstop_section_data d ON d.sectionid=s.sectionid WHERE s.memo = '$recommend' ORDER BY d.sort desc limit 2" ;
	//$rs = $db->getAll($sql);
	//echo '<ul>';
	//foreach ($rs as $k=>$v){
	//echo '<li><span class="icon1"></span><a href="'.$v['url'].'" target="_blank">'.str_cut($v['title'],22,'').'</a></li>';
	//}
	//echo '</ul>';
	//echo '</div>';
	$sql = "SELECT * FROM cmstop_section s LEFT JOIN cmstop_section_data d ON d.sectionid=s.sectionid WHERE s.memo = '$recommend' ORDER BY d.sort desc limit 2" ;
	$rs = $db->getAll($sql);
	echo '<ul class="xss_text_texttu">';
	foreach ($rs as $k=>$v){
		echo '<li><a href="'.$v['url'].'" target="_blank"><img alt="'.$v['title'].'" src="'.WWW_URL.'upload/'.$v['thumb'].'" width="100" height="120" /></a><a href="'.$v['url'].'" target="_blank">'.str_cut($v['title'],16,'').'</a></li>';
	}
	echo '</ul>';
	$sql = "SELECT * FROM cmstop_section s LEFT JOIN cmstop_section_data d ON d.sectionid=s.sectionid WHERE s.memo = '$recommend' ORDER BY d.sort desc limit 2,10" ;
	$rs = $db->getAll($sql);
	echo '<ul class="xss_textwen">';
	foreach ($rs as $k=>$v){
		//echo 'test';
		echo '<li><a href="'.$v['url'].'" target="_blank">'.str_cut($v['title'],20,'').'</a></li>';
	}
	echo '</ul>';
}

//内容页资讯切换
if ($act == 'getInformationSwitching') {
	$zixun = $_GET['zixun'];
	$sql = "SELECT * FROM cmstop_section s LEFT JOIN cmstop_section_data d ON d.sectionid=s.sectionid WHERE s.memo = '$zixun' and d.thumb!='' ORDER BY d.sort desc limit 1";
	$rs = $db->getAll($sql);
	$sql2 = "SELECT * FROM cmstop_section s LEFT JOIN cmstop_section_data d ON d.sectionid=s.sectionid WHERE s.memo = '$zixun' ORDER BY d.sort desc limit 1,1";
	$rs2 = $db->getAll($sql2);
	$sql3 = "SELECT * FROM cmstop_section s LEFT JOIN cmstop_section_data d ON d.sectionid=s.sectionid WHERE s.memo = '$zixun' ORDER BY d.sort desc limit 2,7";
	$rs3 = $db->getAll($sql3);
	echo '<div class="huayu_oumei_rhan_texttu">';
	foreach ($rs as $k=>$v){
		echo '<a href="'.$v['url'].'" target="_blank"><img alt="'.$v['title'].'" src="'.WWW_URL.'./upload/'.$v['thumb'].'" width="190" height="260" /></a>';
		echo '<div class="hot_zixun_block">';
		echo '<span class="hot_zixun_text"><a href="'.$v['url'].'" target="_blank">'.str_cut($v['title'],24,'...').'</a></span>';
		echo '</div>';
	}
	echo '</div>';
	echo '<div class="huayu_oumei_rhan_textwen">';
	foreach ($rs2 as $k2=>$v2){
		echo '<h3><a href="'.$v2['url'].'" target="_blank">'.$v2['title'].'</a></h3>';
	}
		echo '<ul>';
		foreach ($rs3 as $k3=>$v3){
			echo '<li><span class="zixun_news_shijian">'.date('Y.n.j', $v3['published']).'</span><a target="_blank" href="'.$v3['url'].'">'.$v3['title'].'</a></li>';
		}
		echo '</ul>';
	echo '</div>';
}

// 小游戏

if ($act == 'getLittleGame') {
	if ($_GET['type'] == 'huoshow_littlegame_dongzuo'){
		$type="s.memo = 'huoshow_littlegame_dongzuo'";
		$href="dongzuo";
	}else if ($_GET['type'] == 'huoshow_littlegame_zhuangban'){
		$type="s.memo = 'huoshow_littlegame_zhuangban'";
		$href="zhuangban";
	}else if ($_GET['type'] == 'huoshow_littlegame_sheji'){
		$type="s.memo = 'huoshow_littlegame_sheji'";
		$href="sheji";
	}else {
		$type="s.memo = 'huoshow_little_game_tiyu'";
		$href="tiyu";
	}
	$sql = " SELECT * FROM cmstop_section s LEFT JOIN cmstop_section_data d ON d.sectionid=s.sectionid WHERE $type and d.thumb!='' ORDER BY d.sort desc limit 45 " ;
	$row = $db->getAll($sql);
	echo '<ul>';
	foreach ($row as $key=>$val){
		echo '<li>';
		echo '<a target="_blank" href="'.$val['url'].'"><img alt="'.$val['title'].'" src="'.WWW_URL.'upload/'.$val['thumb'].'" width="90" height="80" /></a>';
		echo '<a target="_blank" href="'.$val['url'].'">'.str_cut($val['title'],12,'').'</a>';
		echo '</li>';
	}
	echo '</ul>';
	echo '<div class="xiaogame01_more">';
	echo '<a target="_blank" href="'.$href.'"><img src="/img/templates/huoshow02/images/more.jpg" width="172" height="37" /></a>';
	echo '</div>';
	die();
}
//火秀赛事
if ($act == 'huoshowsaishi') {
	
	if ($_GET['type'] == 'huoshow_events_index_tuijiansaishi'){
		$type="s.memo = 'huoshow_events_index_tuijiansaishi'";
		$href="tuijiansaishi";
		$sql = " SELECT * FROM cmstop_section s LEFT JOIN cmstop_section_data d ON d.sectionid=s.sectionid WHERE $type and d.thumb!='' ORDER BY d.sort desc limit 6 " ;
	$row = $db->getAll($sql);
	echo '<div id="box_1">';
	echo '<div class="events_zt_list_left_01"></div>';
	echo '<div class="events_zt_list_right_01"></div>';
	echo '<ul>';
	foreach ($row as $key=>$val){
		echo '<li>';
		echo '<a target="_blank" href="'.$val['url'].'"><img alt="'.$val['title'].'" src="'.WWW_URL.'upload/'.$val['thumb'].'" width="120" height="165" /></a>';
		echo '<a target="_blank" href="'.$val['url'].'">'.str_cut($val['title'],16,'').'</a>';
		echo '</li>';
	}
	echo '</ul>';
	echo '</div>';
	}else if ($_GET['type'] == 'huoshow_events_index_neidisaishi'){
		$type="s.memo = 'huoshow_events_index_neidisaishi'";
		$href="neidisaishi";
		$sql = " SELECT * FROM cmstop_section s LEFT JOIN cmstop_section_data d ON d.sectionid=s.sectionid WHERE $type and d.thumb!='' ORDER BY d.sort desc limit 6 " ;
	$row = $db->getAll($sql);
	echo '<div id="box_2">';
	echo '<div class="events_zt_list_left_01"></div>';
	echo '<div class="events_zt_list_right_01"></div>';
	echo '<ul>';
	foreach ($row as $key=>$val){
		echo '<li>';
		echo '<a target="_blank" href="'.$val['url'].'"><img alt="'.$val['title'].'" src="'.WWW_URL.'upload/'.$val['thumb'].'" width="120" height="165" /></a>';
		echo '<a target="_blank" href="'.$val['url'].'">'.str_cut($val['title'],16,'').'</a>';
		echo '</li>';
	}
	echo '</ul>';
	echo '</div>';
	}else if ($_GET['type'] == 'huoshow_events_index_gangtaisaishi'){
		$type="s.memo = 'huoshow_events_index_gangtaisaishi'";
		$href="gangtaisaishi";
		$sql = " SELECT * FROM cmstop_section s LEFT JOIN cmstop_section_data d ON d.sectionid=s.sectionid WHERE $type and d.thumb!='' ORDER BY d.sort desc limit 6 " ;
	$row = $db->getAll($sql);
	echo '<div id="box_3">';
	echo '<div class="events_zt_list_left_01"></div>';
	echo '<div class="events_zt_list_right_01"></div>';
	echo '<ul>';
	foreach ($row as $key=>$val){
		echo '<li>';
		echo '<a target="_blank" href="'.$val['url'].'"><img alt="'.$val['title'].'" src="'.WWW_URL.'upload/'.$val['thumb'].'" width="120" height="165" /></a>';
		echo '<a target="_blank" href="'.$val['url'].'">'.str_cut($val['title'],16,'').'</a>';
		echo '</li>';
	}
	echo '</ul>';
	echo '</div>';
	}else {
		$type="s.memo = 'huoshow_events_index_haiwaisaishi'";
		$href="haiwaisaishi";
		$sql = " SELECT * FROM cmstop_section s LEFT JOIN cmstop_section_data d ON d.sectionid=s.sectionid WHERE $type and d.thumb!='' ORDER BY d.sort desc limit 6 " ;
	$row = $db->getAll($sql);
	echo '<div id="box_4">';
	echo '<div class="events_zt_list_left_01"></div>';
	echo '<div class="events_zt_list_right_01"></div>';
	echo '<ul>';
	foreach ($row as $key=>$val){
		echo '<li>';
		echo '<a target="_blank" href="'.$val['url'].'"><img alt="'.$val['title'].'" src="'.WWW_URL.'upload/'.$val['thumb'].'" width="120" height="165" /></a>';
		echo '<a target="_blank" href="'.$val['url'].'">'.str_cut($val['title'],16,'').'</a>';
		echo '</li>';
	}
	echo '</ul>';
	echo '</div>';
	}
	die();
}
// 赛事时间表

if ($act == 'saishishijianbiao') {
	if ($_GET['type'] == 'huoshow_events_schedule_saishiricheng'){
		$type="'huoshow_events_schedule_saishiricheng'";
		$href="benzhou";
	}else if ($_GET['type'] == 'huoshow_events_schedule_saishirichengyue'){
		$type="'huoshow_events_schedule_saishirichengyue'";
		$href="benyue";
	}else {
		$type="'huoshow_events_schedule_saishirichengnian'";
		$href="bennian";
	}
	$sql = " SELECT * FROM cmstop_section where memo=".$type;
	$row = $db->getAll($sql);
	
	foreach ($row as $key=>$val){
		echo $val[data];
		
	}
	
	die();
}
//火秀赛事群组
if ($act=='huoshowgroup')
{	
	//$sql = "SELECT a.* FROM pre_top a LEFT JOIN pre_top_type b ON a.type = b.id WHERE b.`keys` LIKE 'hsgameweekwelcome' ORDER BY a.sort ASC LIMIT 10 ";
	$sql = "SELECT fid,name,lastpost,icon,description FROM (SELECT f.fid,f.name,f.lastpost,ff.membernum,ff.icon,ff.description FROM pre_forum_forumfield ff LEFT JOIN pre_forum_forum f ON f.fid=ff.fid WHERE founderuid>0) t ORDER BY membernum DESC LIMIT 6";
	$rs = $db2->getAllCached($sql);
	//var_dump($rs);
	echo '<ul>';
	foreach ($rs as $key=>$value){
		//var_dump($rs)
		echo '<li>';
		echo '<span class="events_quenzu_pic">';
		echo '<img src="'.$dzUrl.''."data/attachment/group/".$value['icon'].'" onerror="this.onerror=null;this.src='."'".$dzUrl.'static/image/common/groupicon.gif'."'".'" width="48" height="48" /></span>
		<span class="events_quenzu_wz">
		<span class="events_quenzu_wz_c"><a href="'.$dzUrl.'forum.php?mod=group&fid='.$value['fid'].'" target="_blank">'.str_cut($value['name'],12).'</a></span><br>';
		if ($value['description']){
			echo str_cut($value['description'],24);	
			//{str_cut($r[description],90)}

			}
		echo '</span>';
		echo '</li>';				
	}
	echo '</ul>';
	
	die();
}

//火秀赛事首页排行榜
if ($act=='indexhuoshowgrouptop10')
{	
	$sql = "SELECT fid,name,lastpost,icon,description FROM (SELECT f.fid,f.name,f.lastpost,ff.membernum,ff.icon,ff.description FROM pre_forum_forumfield ff LEFT JOIN pre_forum_forum f ON f.fid=ff.fid WHERE founderuid>0) t ORDER BY membernum DESC LIMIT 10";
	$rs = $db2->getAllCached($sql);
	//var_dump($rs);
	echo '<ul>';
	foreach ($rs as $key=>$value){	
		echo '<li><a href="'.$dzUrl.'forum.php?mod=group&fid='.$value['fid'].'" target="_blank">'.str_cut($value['name'],32).'</a><li>';				
	}
	echo '<ul>';
	
	die();
}
//火秀赛事快报排行榜
if ($act=='wholeeventshuoshowgrouptop10')
{	
	$sql = "SELECT fid,name,lastpost,icon,description FROM (SELECT f.fid,f.name,f.lastpost,ff.membernum,ff.icon,ff.description FROM pre_forum_forumfield ff LEFT JOIN pre_forum_forum f ON f.fid=ff.fid WHERE founderuid>0) t ORDER BY membernum DESC LIMIT 1";
	$rs = $db2->getAllCached($sql);

	foreach ($rs as $key=>$value){
	echo '<div class="charts_top"><div class="charts_top_pic"><span class="charts_top_text"><a href="'.$dzUrl.'forum.php?mod=group&fid='.$value['fid'].'" target="_blank">'.str_cut($value['description'],50).'</a></span><img src="'.$dzUrl.''."data/attachment/group/".$value['icon'].'" onerror="this.onerror=null;this.src='."'".$dzUrl.'static/image/common/groupicon.gif'."'".'" width="48" height="48" /></div></div>';
	}

	echo '<div class="charts_others">';
	echo '<ul>';
	$sql = "SELECT fid,name,lastpost,icon,description FROM (SELECT f.fid,f.name,f.lastpost,ff.membernum,ff.icon,ff.description FROM pre_forum_forumfield ff LEFT JOIN pre_forum_forum f ON f.fid=ff.fid WHERE founderuid>0 and ff.description!='') t ORDER BY membernum DESC LIMIT 1,9";
	$rs = $db2->getAllCached($sql);
	foreach ($rs as $key=>$value){	
		echo '<li><span class="charts_text"><a href="'.$dzUrl.'forum.php?mod=group&fid='.$value['fid'].'" target="_blank">'.str_cut($value['description'],65).'</a></span></li>';				
	}
	echo '</ul>';
	echo '</div>';
	
	die();
}
//火秀赛事排行榜页面
if ($act=='indexhuoshowgrouptop12')
{	
	$sql = "SELECT fid,name,lastpost,icon,description,membernum FROM (SELECT f.fid,f.name,f.lastpost,ff.membernum,ff.icon,ff.description FROM pre_forum_forumfield ff LEFT JOIN pre_forum_forum f ON f.fid=ff.fid WHERE founderuid>0) t ORDER BY membernum DESC LIMIT 12";
	$rs = $db2->getAllCached($sql);
	$i = 1;
	foreach ($rs as $key=>$value){
		echo '<div class="subpage_ph_sub">';
		echo '<div class="sub_topno"><img src="'.WWW_URL.'img/templates/huoshow02/images/events/ph-top'.$i.'.jpg" height="95" width="93"/></div>';
		echo ' <div class="sub_topimg"><a href="'.$dzUrl.'forum.php?mod=group&fid='.$value['fid'].'" target="_blank">
			  <img src="'.$dzUrl.''."data/attachment/group/".$value['icon'].'" onerror="this.onerror=null;this.src='."'".$dzUrl.'static/image/common/groupicon.gif'."'".'" width="95" height="102" /></a></div>';
		echo '<div class="sub_toppara">';
		echo '<h3><a href="'.$dzUrl.'forum.php?mod=group&fid='.$value['fid'].'" target="_blank">'.str_cut($value['name'],10).'</a>';
		if ($value['membernum']>50&&$value['membernum']<=100){
			//echo "2";
			echo '<span>火秀指数:<img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar2.gif"  width="18" height="12"/><img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar2.gif" /><img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar1.gif" /><img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar1.gif" /><img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar1.gif" /></span>';
		}elseif($value['membernum']>100&&$value['membernum']<=200){
			//echo "3";
			echo '<span>火秀指数:<img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar2.gif"  width="18" height="12"/><img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar2.gif" /><img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar2.gif" /><img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar1.gif" /><img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar1.gif" /></span>';
		}elseif($value['membernum']>200&&$value['membernum']<=400){
			//echo "4";
			echo '<span>火秀指数:<img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar2.gif"  width="18" height="12"/><img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar2.gif" /><img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar2.gif" /><img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar2.gif" /><img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar1.gif" /></span>';	
		}elseif($value['membernum']>400){
			//echo "5";
			echo '<span>火秀指数:<img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar2.gif"  width="18" height="12"/><img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar2.gif" /><img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar2.gif" /><img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar2.gif" /><img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar2.gif" /></span>';
		}else{
			//echo "1";
			echo '<span>火秀指数:<img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar2.gif"  width="18" height="12"/><img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar1.gif" /><img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar1.gif" /><img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar1.gif" /><img src="'.WWW_URL.'img/templates/huoshow02/images/events/Chart-Bar1.gif" /></span>';
		}
		echo '</h3>';
		echo '<p>'.str_cut($value['description'],100).'</p>
					<p class="guzhu"><a href="'.$dzUrl.'forum.php?mod=group&action=join&fid='.$value['fid'].'"><img src="'.WWW_URL.'img/templates/huoshow02/images/events/plus.jpg" width="14"; height="14"/>加入该群组</a></p>';	
		echo '</div>';		
		echo '<div class="clearboth"></div>';
		echo '</div>';
		$i = $i+1;
	}
	die();
}

if($act=='indexhuoshowsaishitime'){
	//echo date("Y年m月d日").'&nbsp;'.'星期';
	echo '<p class="showtext2">';
	echo date("m");
	echo '<br>月</p>';
	echo '<p class="showtext1">';
	echo date("d");
	echo '</p>';
}

if($act=='index_time'){
	echo date("Y年m月d日").'&nbsp;'.'星期';
	if(date("w")==1) echo '一';
	if(date("w")==2) echo '二';
	if(date("w")==3) echo '三';
	if(date("w")==4) echo '四';
	if(date("w")==5) echo '五';
	if(date("w")==6) echo '六';
	if(date("w")==0) echo '日';
}

if ($act == 'digg'){
	$top = rand(1,100);
	$sql = "SELECT contentid FROM cmstop_article ORDER BY contentid DESC LIMIT 1";
	$rs = $db->getRow($sql);
	$teid = $rs['contentid'];
	$sql = "INSERT INTO cmstop_digg (`contentid` ,`supports`) VALUES ($teid , $top)";
	$db->query($sql);
	echo'
	<script language="javascript">
	//alert("操作成功");
	window.history.back(-1);
	</script>
	';

}

if ($act == 'get_happygirl_group'){	
	$sql = "SELECT * FROM pre_forum_thread WHERE fid=303 ORDER BY lastpost DESC LIMIT 4 ";
	$rs = $db2->getAll($sql);
	foreach ($rs as $key=>$value){
		echo '<li><a target="_blank" href="'.$dzUrl.'forum.php?mod=viewthread&tid='.$value['tid'].'" title="'.$value['subject'].'">'.str_cut($value['subject'],40).'</a></li>';
	}
	die();
}

if ($act == 'get_happygirl_bbs'){	
	$sql = "SELECT * FROM pre_forum_thread WHERE fid=323 ORDER BY lastpost DESC LIMIT 6";
	$rs = $db2->getAll($sql);
	foreach ($rs as $key=>$value){
		echo '<li><a target="_blank" href="'.$dzUrl.'forum.php?mod=viewthread&tid='.$value['tid'].'" title="'.$value['subject'].'">'.str_cut($value['subject'],40).'</a></li>';
	}
	die();
}

function getClientIp(){
		$ip=false;
	if(!empty($_SERVER["HTTP_CLIENT_IP"])){
		$ip = $_SERVER["HTTP_CLIENT_IP"];
	}
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
		if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
		for ($i = 0; $i < count($ips); $i++) {
			if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i])) {
				$ip = $ips[$i];
				break;
			}
		}
	}
	$cip = $ip ? $ip : $_SERVER['REMOTE_ADDR'];
	return $cip;  
}
