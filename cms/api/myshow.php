<?php
$act          = @$_GET['act'];
$dzUrl        = $_GET['dz_url'];
$dzApiUrl     = $dzUrl.'api/myshow.php?act='.$act.'&time='.time().'&dz_url='.$dzUrl;
$wwwUrl       = "http://www.huoshow.com/";
//echo $dzApiUrl;
$rs           = @file_get_contents($dzApiUrl); 
if (trim($rs)=='') die('');

$jsonRs       = json_decode($rs,true);
//print_r($jsonRs);die;
if(!is_array($jsonRs)) die('');
$jsonCounts   = count($jsonRs);
error_reporting(0);
if ($act=='login'){
	
	$url = 'http://dz.huoshow.com/member.php?mod=logging&action=login';
	echo file_get_contents($url);
	die();
}
//今日必看
/*if($act=='pages'){
echo '<div class="page"><div class="page-body">';
 if ($jsonRs['todaylist']){
 echo '<ul>';
  foreach ($jsonRs['todaylist'] as $key => $value): 
echo '<li> <div class="container_img">
<a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$value[myshowid].'" title="'.$value[title].'">
<a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$value[myshowid].'" title="'.$value[title].'">
<img src="'.$dzUrl.'static2/images/videotop.png" width="148" height="108" /></a>
<img src="'.$value[image].'" alt="'.$value[title].'" height="120" width="180" />
</div>
<span class="linktext">
 <a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$value[myshowid].'">'.$value[title].'</a></span>
<span class="membertext">会员：<a href="home.php?mod=space&uid='.$value[uid].'" target="_blank">'.$value[author].'</a>
</span></li>';
 endforeach;
 echo '</ul>';
 }
 echo ' </div></div> <div class="page"> <div class="page-body">';
 if ($jsonRs['autodyne']){
 echo '<ul>';
foreach ($jsonRs['autodyne'] as $key => $value):  
echo '<li><div class="container_img"><a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$value[myshowid].'" title="'.$value[title].'">
<a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$value[myshowid].'" title="'.$value[title].'">
<img src="'.$dzUrl.'static2/images/videotop.png" width="148" height="108" /></a>
<img src="'.$value[image].'" alt="'.$value[title].'" height="120" width="180" />
</div> <span class="linktext">
<a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$value[myshowid].'">'.$value[title].'</a></span>
<span class="membertext">会员：<a href="'.$dzUrl.'home.php?mod=space&uid='.$value[uid].'" target="_blank">'.$value[author].'</a>
</span></li>';
endforeach;
echo'</ul>';
}
echo'</div></div><div class="page"><div class="page-body">';
 if ($jsonRs['cover']){
echo'<ul>';
foreach ($jsonRs['cover'] as $key => $value):  
echo'<li><div class="container_img">
<a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$value[myshowid].'" title="'.$value[title].'">
<a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$value[myshowid].'" title="'.$value[title].'">
<img src="'.$dzUrl.'static2/images/videotop.png" width="148" height="108" /> </a>
<img src="'.$value[image].'" alt="'.$value[title].'" height="120" width="180" /></div><span class="linktext">
<a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$value[myshowid].'">'.$value[title].'</a></span>
<span class="membertext">会员：<a href="'.$dzUrl.'home.php?mod=space&uid='.$value[uid].'" target="_blank">'.$value[author].'</a>
</span></li>';
endforeach;
echo '</ul>';
}
echo'</div></div>';
 die(); 
}
*/
//原创达人
if($act=='daren'){
if(count($jsonRs['daren'])>0){
echo '<ul>';
for ($i=0;$i<count($jsonRs['daren']);$i++){
//foreach ($jsonRs['hotmember'] as $key => $value):  
echo'<li>
<a href="'.$dzUrl.'home.php?mod=space&uid='.$jsonRs['daren'][$i][uid].'" target="_blank">'.$jsonRs['daren'][$i][avatar].'</a><br>
<a href="'.$dzUrl.'home.php?mod=space&uid='.$jsonRs['daren'][$i][uid].'" target="_blank">'.$jsonRs['daren'][$i][nickname].'</a>
</li>';
}
echo'</ul>';
die();
  }
}
//网友视频
if($act=='shipinqu'){
 echo'<div class="shipintop">
<h3><span class="dalei"><img src="'.$dzUrl.'static2/images/yellowdot.jpg" width="12" height="13" /><strong>网友视频</strong></span><span class="zilei">
<a href="'.$dzUrl.'home.php?mod=space&do=myshow&classify=10" target="_blank">我的音乐</a> | 
<a href="'.$dzUrl.'home.php?mod=space&do=myshow&classify=11" target="_blank">酷炫热舞</a>  | 
<a href="'.$dzUrl.'home.php?mod=space&do=myshow&classify=12" target="_blank">演出现场</a> | 
<a href="'.$dzUrl.'home.php?mod=space&do=myshow&classify=13" target="_blank">精彩推荐</a>
</span></h3> </div><div class="shipininner pub"><div class="topvideo">';

							if($jsonCounts>0){
                              echo '<ul>';
							  for ($i=0;$i<$jsonCounts;$i++){
							  //'.$jsonRs[$i]['name']
							//  foreach ($jsonRs['netvideo'] as $key => $value):  
                                   if ($i%4 == 0){
                            echo'<li class="clear">&nbsp;</li>';
                                    }
                                    echo '<li><div class="topvideo-pic"><a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$jsonRs[$i][myshowid].'">
                                    <img src="'.$jsonRs[$i][image].'" onerror="this.onerror=null;this.src='."'".$dzUrl.'./static2/images/video_default.png'."'".'" /></a>
                                    <div class="label">
                                            <div>&nbsp;'.$jsonRs[$i][timelength].'&nbsp;&nbsp;&nbsp;&nbsp;';
											if($jsonRs[$i][isfanart]){
                                          echo '原创';
                                           }
                                        echo '</div></div>
                                    </div>
                                    <a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$jsonRs[$i][myshowid].'">
                                        <img src="'.$dzUrl.'static2/images/myshowshipin.gif" />&nbsp;'.$jsonRs[$i][title].'
                                    </a>
                                    <div class="videouploader">会员：
                                        <a href="'.$dzUrl.'home.php?mod=space&uid='.$jsonRs[$i][uid].'" target="_blank">'.$jsonRs[$i][nickname].'</a>
                                    </div>
                                    </li>';
                                   }
                                echo'</ul>
                                <div class="clear">&nbsp;</div>';
                                }
                            echo '<a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=all&type=2" target="_blank" style="float:right; padding-right:20px;">更多...</a></div>
                            <div class="clear">&nbsp;</div>
                        </div>
                        <div class="shipinbottom">&nbsp;</div>';
						die();

}

//推荐音频
if($act=='yinpinqu'){
   echo'<div class="shipintop">
          <h3><span class="dalei">
		  <img src="'.$dzUrl.'static2/images/yellowdot.jpg" width="12" height="13" /><strong>推荐音频</strong></span><span class="zilei">
		  <a href="'.$dzUrl.'home.php?mod=space&do=myshow&classify=1" target="_blank">流行</a> | <a href="'.$dzUrl.'home.php?mod=space&do=myshow&classify=2" target="_blank">摇滚</a>  |
		   <a href="'.$dzUrl.'home.php?mod=space&do=myshow&classify=3" target="_blank">民谣</a> | <a href="'.$dzUrl.'home.php?mod=space&do=myshow&classify=9" target="_blank">古典</a></span></h3>
                        </div>
                        <div class="shipininner pr">
                            <div class="leftarea">';
							//print_r($jsonRs);
                               if(count($jsonRs['aa'])>0){
                               echo'<ul>';
                                 for ($i=0;$i<count($jsonRs['aa']);$i++){
                                   echo'<li><span class="imgarea"><a href="'.$dzUrl.'home.php?mod=space&uid='.$jsonRs['aa'][$i][uid].'" target="_blank">'.$jsonRs['aa'][$i][avatar].'</a></span>
                                    <span class="mname"><a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$jsonRs['aa'][$i][myshowid].'" target="_blank">'.$jsonRs['aa'][$i][title].'</a></span>
                                    <span class="minfo"><a href="'.$dzUrl.'home.php?mod=space&uid='.$jsonRs['aa'][$i][uid].'" target="_blank">'.$jsonRs['aa'][$i][nickname].'</a></span>
                                    </li>';
                                    }
                               echo'</ul>';
                                }
							
								
//原创热榜								

                                echo '<h3>原创热榜</h3>
                            </div>
                            <!--音频列表1-->
                            <div class="musiclist">';
							  if(count($jsonRs['bb']) >0){
                               echo '<ul>';
							    for ($i=0;$i<count($jsonRs['bb']);$i++){
                                    echo '<li><span class="musicname"><a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$jsonRs['bb'][$i][myshowid].'" target="_blank">'.$jsonRs['bb'][$i][title].'</a></span><span class="singer"><a href="'.$dzUrl.'home.php?mod=space&uid='.$jsonRs['bb'][$i][uid].'" target="_blank">'.$jsonRs['bb'][$i][nickname].'</a></span></li>';
                                    }
                                echo '</ul>';
                                }
                            echo '<a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=all&type=1" target="_blank" style="float:right; padding-right:20px; padding-top:10px;">更多...</a></div>
                      </div>
                        <div class="shipinbottom">&nbsp;</div>';
						die();


}

if($act=='myshow'){

                    echo '     <div class="tns">
                            <table cellspacing="0" cellpadding="4" border="0">
                                <tbody><tr>
                                        <th><p>'.$jsonRs['fanart'][count].'</p>原创</th>
                                        <th><p>'.$jsonRs['audionum'][count].'</p>音乐</th>
                                        <td><p>'.$jsonRs['videonum'][count].'</p>视频</td>
                                    </tr>
                            </tbody></table>
                        </div>
                        <hr class="l" />
                        <div class="bn">
                            <p>想要成为火秀的人气王吗？大胆的秀出来吧！赶快发布你的视频和音乐作品，只要你够潮，够牛，今年最IN的网络明星就是你！你可以立即点击上传MY秀</p>
                            <p class="ptn cl"><a class="bac y" href="'.$dzUrl.'home.php?mod=spacecp&ac=myshow">上传MY秀</a></p>
                        </div>';
						die();
}
////达人特区
if($act=='darenqu'){

  echo' <div id="gtab1" style="display:block">
                            <div class="darenlist">';
							if(count($jsonRs['audiomember'])>0){
                               
                               echo' <ul>';
                                  for ($i=0;$i<count($jsonRs['audiomember']);$i++){
                                  	if(!empty($jsonRs['audiomember'][$i][uid])){
                                    echo'<li>

                                    <div class="dareninfo"><p><a href="'.$dzUrl.'home.php?mod=space&uid='.$jsonRs['audiomember'][$i][uid].'" target="_blank">'.$jsonRs['audiomember'][$i][nickname].'</a> 最近上传了 <strong>'.$jsonRs['audiomember'][$i][num].'</strong> 个音频<br />
                                        最近上传的是：<a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$jsonRs['audiomember'][$i][myshowid].'" target="_blank" class="yinpin">'.cutstr($jsonRs['audiomember'][$i][title],16).'</a></p>
                                    </div><a href="'.$dzUrl.'home.php?mod=space&uid='.$jsonRs['audiomember'][$i][uid].'" target="_blank">'.$jsonRs['audiomember'][$i][avatar].'</a>
                                    </li>';
                                    }
                                  }
                                echo'</ul>';
                                }
                               echo' <div class="clear"></div>
                            </div>
                        </div>
                        <div id="gtab2" style="display:none">
                            <div class="darenlist">';
                                if(count($jsonRs['videomember'])>0){
                               echo' <ul>';
                                  for ($i=0;$i<count($jsonRs['videomember']);$i++){
                                  	if(!empty($jsonRs['videomember'][$i][uid])){
                                  echo'  <li>
                                    <div class="dareninfo"><p><a href="'.$dzUrl.'home.php?mod=space&uid='.$jsonRs['videomember'][$i][uid].'" target="_blank">'.$jsonRs['videomember'][$i][nickname].'</a> 最近上传了 <strong>'.$jsonRs['videomember'][$i][num].'</strong> 个视频<br />
                                        最近上传的是：<span class="darenvideo"><a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$jsonRs['videomember'][$i][myshowid].'" target="_blank">'.cutstr($jsonRs['videomember'][$i][title],16).'</a></span></p>
                                    </div><a href="'.$dzUrl.'home.php?mod=space&uid='.$jsonRs['videomember'][$i][uid].'" target="_blank">'.$jsonRs['videomember'][$i][avatar].'</a>
                                    </li>';
                                    }
                                  }
                                echo'</ul>';
                                }
                               echo' <div class="clear"></div>
                            </div>
                        </div>';
						die();

}

//最新发布视频
    if($act=='fabus'){
    	
                       	if($jsonCounts>0){
                                echo' <ul class="lst_main"> ';
                                    for ($i=0;$i<$jsonCounts;$i++){
                                    echo' <li class="items">
                                     <ul> 
                                         <li>
                                        <a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$jsonRs[$i][myshowid].'" target="_blank" 
										 class="';
										 if($jsonRs[$i][type]==1){
										     echo 'yinpin';
										 }else{
										     echo 'darenvideo';
										 }
										 
										 echo '">'.$jsonRs[$i][title].'</a>
                                         </li>
                                         <li>会员:<a href="'.$dzUrl.'home.php?mod=space&uid='.$jsonRs[$i][uid].'" target="_blank">'.$jsonRs[$i][nickname].'</a></li>
                                         <li class="details_c">上传'.$jsonRs[$i][dateline].'</li>
                                     </ul>
                                         <a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$jsonRs[$i][myshowid].'" target="_blank" title="'.$jsonRs[$i][title].'" class="container_img" style="background:url('.$jsonRs[$i][image].') center center no-repeat;"><img src="'.$wwwUrl.'img/images/videotop.png" /></a>
                                     </li>';
                                    }
                                 echo'<a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=all&type=2" target="_blank" style="float:right; padding:8px;">更多...</a></ul>';
                                 }
                                 echo '<div class="clear">&nbsp;</div>';
                                 
   
   }
//最新发布音频
    if($act=='fabuy'){
                       	if($jsonCounts>0){
                                echo' <ul class="lst_main"> ';
                                    for ($i=0;$i<$jsonCounts;$i++){
                                    echo' <li class="items_y">
                                     <span class="musi">
                                        <a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$jsonRs[$i][myshowid].'" target="_blank" 
										 class="';
										 if($jsonRs[$i][type]==1){
										     echo 'yinpin';
										 }else{
										     echo 'darenvideo';
										 }
										 
										 echo '">'.$jsonRs[$i][title].'</a></span><span class="aut">
                                        <a href="'.$dzUrl.'home.php?mod=space&uid='.$jsonRs[$i][uid].'" target="_blank">'.$jsonRs[$i][nickname].'</a></span>
                                        </li>';
                                    }
                                 echo'<li><a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=all&type=1" target="_blank" style="float:right; padding:8px;">更多...</a></li></ul>';
                                 }
                                 echo '<div class="clear">&nbsp;</div>';
                                 
   
   }

//if($act=='page1'){
//$value = $jsonRs['username'];
//echo '<p>'.$value.'</p>';
//die();
//}








/**
 * 
 * Enter description here ...
 * @param unknown_type $str
 * @param unknown_type $length
 * @param unknown_type $after
 */
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
