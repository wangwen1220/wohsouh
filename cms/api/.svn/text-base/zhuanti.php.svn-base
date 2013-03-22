<?php
require_once '../cmstop/config/define.php';
$act          = @$_GET['act'];
//$dzUrl        = $_GET['dz_url'];
$dzUrl=DX_URL;
$dzliveUrl=DX_HUOSHOW_SHOW_URL;
$dzApiUrl     = $dzUrl.'api/zhuanti.php?act='.$act.'&time='.time().'&dz_url='.$dzUrl;
$wwwUrl       = "http://www.huoshow.com/";

$rs           = @file_get_contents($dzApiUrl); 
$jsonRs       = json_decode($rs,true);

//print_r($jsonRs);die;
if(!is_array($jsonRs)) die('');
$jsonCounts   = count($jsonRs);
error_reporting(0);

if ($act == 'zhuanti'){
	if($jsonCounts>0){
		 for ($i=0;$i<$jsonCounts;$i++){
		 	//for ($a =1; $a = 10; $a++){
		 	echo '<div class="paihang_cons">';
		    echo '<div class="area1"><img src="/img/templates/zhuanti/images/'.($i+1).'.gif" width="37" height="30" /></div>';
		    
		    echo '<div class="area2"><a href="'.$dzUrl.$jsonRs[$i][uid].'">
		    <img src="'.$dzliveUrl.'/uc_server/avatar.php?uid='.$jsonRs[$i]['uid'].'&size=middle" width="60" height="60" /></a><br />';
		 	echo '</div>';
			echo '<div class="area3"><p>';
			if ($jsonRs[$i]['nickname']){
			    echo '<span class="jifen"><a style="color:#FFFFFF" href="'.$dzUrl.$jsonRs[$i][uid].'">'.$jsonRs[$i]['nickname'].'</a></span>';
			}else{
			   	echo '<span class="jifen"><a style="color:#FFFFFF" href="'.$dzUrl.$jsonRs[$i][uid].'">'.$jsonRs[$i]['username'].'</a></span>';
			}
			echo '<span class="piaoshu">魅力值：'.$jsonRs[$i]['monthnum'].'</span></p>';
			
			if ($jsonRs[$i]['show']){
				echo '<p>上传了才艺<a class="zise" href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$jsonRs[$i]['show'][0]['myshowid'].'">
				《'.str_cut($jsonRs[$i]['show'][0]['title'],10,'').'》</a>
				<a href="'.$dzUrl.'home.php?mod=space&uid='.$jsonRs[$i]['uid'].'&do=myshow&view=me" class="huise">更多>></a></p>';
			}
			
			echo '<p><a class="huangse" href="'.$dzUrl.$jsonRs[$i][uid].'">进入空间>></a></p><p>&nbsp;</p><p>&nbsp;</p></div>';
			
			echo '<div class="area4"><p>';
			if ($jsonRs[$i]['stat'] == 1){
				echo '<a target="_blank" href="'.$dzliveUrl.$jsonRs[$i][uid].'"><img src="/img/templates/zhuanti/images/zhibo.gif" width="44" height="61" /></a>';
			}else {
				echo '<img src="/img/templates/zhuanti/images/offline.gif" width="44" height="61" />';
			}
			echo '</p></div>';
			echo '</div>';
		 	}
		//}
		die();
	}
}

if ($act == 'anchors'){	
	if ($jsonCounts>0){
			//echo '<div id="ajax_anchors">';
			for ($i=0;$i<$jsonCounts;$i++){
				echo '<div class="hotanchor_pk_Race_shenma_pic">';
			
				echo '<ul id="hotanchor_nav">';
				echo '<li>';
				
				echo '<div class="hotanchor_info">';
				echo '<span class="hotanchor_sha">';
				echo '<img src="'.$dzUrl.'static2/images/charmlevel/'.$jsonRs[$i]['charmLevel'].'.png" width="16" height="16" style="padding-left: 5px;" /> 
					 <img src="'.$dzUrl.'static2/images/huoshowlevel/'.$jsonRs[$i]['huoshowLevel'].'.png" width="16" height="16" style="padding-right: 10px;" />';
				echo '</span>';
				echo '<span class="hotanchor_D_2">';
				if ($jsonRs[$i][online]==1){
					echo '<img src="/img/templates/zhuanti/images/zaixian.png" width="31" height="14" />';
				}else {
					echo '<img src="/img/templates/zhuanti/images/lixian.png" width="31" height="14" />';
				}
				echo '</span>';
				echo '</div>';
				
				echo '<div class="hotanchor_info_01">';
				echo '<span class="hotanchor_D_on">['.$jsonRs[$i]['onlineMember'].'/50]</span>';
				echo '</div>';
				
				echo '<a href="'.$dzliveUrl.$jsonRs[$i][uid].'" target="_blank"><img src="'.$dzliveUrl.'/uc_server/avatar.php?uid='.$jsonRs[$i]['uid'].'&size=middle" width="60" height="60" /></a>';
				

				if ($jsonRs[$i]['nickname']){
					echo '<p class="hotanchor_ben"><a target="_blank" href="'.$dzliveUrl.$jsonRs[$i][uid].'">'.$jsonRs[$i]['nickname'].'<br>'.$jsonRs[$i]['uid'].'</a></p>';
				}else {
					echo '<p class="hotanchor_ben"><a target="_blank" href="'.$dzliveUrl.$jsonRs[$i][uid].'">'.$jsonRs[$i]['username'].'<br>'.$jsonRs[$i]['uid'].'</a></p>';
				}
				
				echo '</li>';
				echo '</ul>';
				echo '</div>';
			}
			//echo '</div>';
		
	}
	die();
}



function str_cut($str, $length,$after='')
{
	$start=0;
	$charset="utf-8";
	$suffix=true;
    if(function_exists("mb_substr"))
    {
    	if(mb_strlen($str, $charset) <= $length) return $str;
        	$slice = mb_substr($str, $start, $length, $charset);
    } else {
		$re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']          = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']          = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        if(count($match[0]) <= $length) return $str;
            $slice = join("",array_slice($match[0], $start, $length));
		}
        if($suffix) return $slice.$after;
        return $slice;
}
function cutstr($str, $length,$after='')
{
	$start=0;
	$charset="utf-8";
	$suffix=true;
    if(function_exists("mb_substr"))
    {
    	if(mb_strlen($str, $charset) <= $length) return $str;
        	$slice = mb_substr($str, $start, $length, $charset);
    } else {
		$re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']          = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']          = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        if(count($match[0]) <= $length) return $str;
            $slice = join("",array_slice($match[0], $start, $length));
		}
        if($suffix) return $slice.$after;
        return $slice;
}