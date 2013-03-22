<?php
$act          = @$_GET['act'];
$dzUrl        = $_GET['dz_url'];
$dzApiUrl     = $dzUrl.'api/dz.php?act='.$act.'&time='.time().'&dz_url='.$dzUrl;
$dzImgUrl     = 'http://res1.netwaymedia.com/';
$rs           = @file_get_contents($dzApiUrl); 
if (trim($rs)=='') die('');

$jsonRs       = json_decode($rs,true);
if(!is_array($jsonRs)) die('');
$jsonCounts   = count($jsonRs);
error_reporting(0);
if ($act=='login'){
	
	$url = 'http://dz.huoshow.com/member.php?mod=logging&action=login';
	echo file_get_contents($url);
	die();
}
/**
 * 热门群组
 */
if($act=='remenqunzu'){	
	echo ' <ol><p>热门群组</p></ol><div class="re" style="overflow:hidden;">';
	//for ($i=0;$i<$jsonCounts;$i++){
	$i=1;
	foreach ($jsonRs['recomm'] as $key => $value):	
		echo '<div class="vihotgif-item" style="height:50px;">
              	<div class="vihotgif-item-l">
              		<img src="'.$dzUrl.''.$value['icon'].'" onerror="this.onerror=null;this.src='."'".$dzUrl.'static/image/common/groupicon.gif'."'".'"/></div>
                    <div class="vihotgif-item-r">
                        <p><a href="'.$dzUrl.'forum.php?mod=group&fid='.$value['fid'].'" target="_blank" class="cGray">
                        <strong>'.$value['name'].'</strong></a></p>
                        <p>';
		if ($value['description']){
			echo '<a href="'.$dzUrl.'forum.php?mod=group&fid='.$value['fid'].'" target="_blank">
			<font class="cGg">'.$value['description'].'</font></a>';
			}
			echo '</p>
                    </div>
                    <div class="clear">&nbsp;</div>
                </div>';
			$i++;
			if($i>4){
				break;
			}
	endforeach;
	echo '</div>';
    die();
}

/**
 * 群组热帖
 */
if($act=='qunzurementie'){
	$qunzuUrl = $dzUrl.'forum.php?mod=group&fid=';
	$subUrl = $dzUrl.'forum.php?mod=viewthread&tid=';
	echo '<ol><p>群组热门帖</p></ol>';
	echo '<ul>';
	for ($i=0;$i<$jsonCounts;$i++){
		echo '<li><a href='.$qunzuUrl.$jsonRs[$i]['fid'].' target="_blank">'.$jsonRs[$i]['name'].'</a> <a href="'.$subUrl.$jsonRs[$i]['tid'].'" target="_blank">'.$jsonRs[$i]['subject'].'</a></li>';
	}	
	echo '</ul>';
    die();
}

/**
 * 明星秀
 */
if($act=='mingxingxiu'){
	                       
	foreach ($jsonRs as $key=>$value):
		echo '<dl><dt><a href="'.$dzUrl.'home.php?mod=space&uid='.$value[uid].'" target="_blank">'.$value['avater'].'</a></dt><dd>
		<a href="'.$dzUrl.'home.php?mod=space&uid='.$value[uid].'" target="_blank">';
		if ($value['nickname']){
			echo $value['nickname'];
		}else {
			echo $value['username'];
		}
		echo '</a></dd></dl>';
		if (($key+1)%4 == 0){
			echo '<div class="clear">&nbsp;</div>';
		}
	endforeach;	
	
	die();	
}
/**
 * 才艺秀
 */

if($act=='caiyixiu'){
	echo '<div class="ShowTalent"><ol>才艺秀</ol><ul>';
	foreach ($jsonRs['video']['part1'] as $key => $value):
		echo '<li class="ShowTalent01">
						<div class="ShowTalent01_pic">
							<a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$value['myshowid'].'" target="_blank"><img src="'.$value['pic'].'" onerror="this.onerror=null;this.src='."'".$dzUrl.'static2/images/video_default.gif'."'".'" /></a>
						</div><a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$value['myshowid'].'" target="_blank" class="cDyell">'.str_cut($value['title'],20,'').'</a></li>';
	endforeach;
	echo '  </ul></div>';
	
	
	echo '<div class="ShowTalent04"><ul><li>';
	foreach ($jsonRs['video']['part2'] as $key => $value):
		echo '<p><a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$value['myshowid'].'" target="_blank">'.cutstr($value['title'],20,'').'</a></p>';
                       
   	endforeach;
	echo '</li><li>';
	foreach ($jsonRs['audio'] as $key => $value):
		echo '<dt><a href="'.$dzUrl.'home.php?mod=space&do=myshow&view=me&id='.$value['myshowid'].'" target="_blank">'.cutstr($value['title'],20,'').'</a></dt>';                       
   	endforeach;
	echo '</li></ul></div>';
	die();	
}



/**
 * 精彩日志
 */

if($act=='jingcairizhi'){	
	
	foreach ($jsonRs as $key=>$value):
    	if ($key == 0 && $value['picflag'] == 1){
        	echo '<p><a href="'.$dzUrl.'home.php?mod=space&uid='.$value['uid'].'&do=blog&id='.$value['blogid'].'"><img src="'.$dzUrl.'data/attachment/album/'.$value['pic'].'" align="left" width="120" height="90" /></a>
	              <a href="'.$dzUrl.'home.php?mod=space&uid='.$value['uid'].'&do=blog&id='.$value['blogid'].'" class="cGray"><strong>'.$value['subject'].'</strong></a><br />
	              <a href="'.$dzUrl.'home.php?mod=space&uid='.$value['uid'].'&do=blog&id='.$value['blogid'].'" class="cGg">'.cutstr($value['message'],32,'<font class="cDRed">..[详细]</font>').'</a>
	              </p>';
    	}else{
        	echo '<p><a href="'.$dzUrl.'home.php?mod=space&uid='.$value['uid'].'&do=blog&id='.$value['blogid'].'">·'.cutstr($value['subject'],32,'').'</a></p>';
    	}
    endforeach;
   
    die();
}



/**
 * 火秀达人
 */
if($act=='huoxiudaren'){
//print_r($jsonRs);
	echo '<div class="block1-body">
                            <h3>火秀达人</h3>
                            <div  class="star_show">';
    foreach  ($jsonRs as  $key=> $value):
		echo '<dl>
				<dt>
					<a href="'.$dzUrl.'home.php?mod=space&uid='.$value[uid].'" target="_blank">'.$value['avater'].'</a>
				</dt>
			    <dd>
		 			<a href="'.$dzUrl.'home.php?mod=space&uid='.$value[uid].'" target="_blank">'.$value['username'].'</a>
		 		</dd>
		 	</dl>';
		if (($key+1)%4 == 0){
			echo '<div class="clear">&nbsp;</div>';
		}
	
	endforeach;
	
	echo '<div class="clear">&nbsp;</div>';
	echo '</div> </div>';
	die();	
}

/**
 * 赛事专区
 */
if($act=='saishizhuanqu'){	
	echo '<h3><a href="'.$dzUrl.'forum.php?mod=forumdisplay&fid='.$jsonRs['sszq_HS_bbsMap0'].'" target="_blank">'.$jsonRs['sszq_HS_bbsMap1'].'</a></h3>';
	
	if(!empty($jsonRs['bbs_a'][0]['attachment'])){	
	$value = $jsonRs['bbs_a'][0];
	echo '<div>
					<a href="'.$dzUrl.'forum.php?mod=viewthread&tid='.$value['tid'].'&extra=page=1"><img src="'.$dzImgUrl.'forum/'.$value['attachment'].'" width="120" height="90" align="left" class="thumb" /></a>
					<a href="'.$dzUrl.'forum.php?mod=viewthread&tid='.$value['tid'].'&extra=page=1" class="cGray" title="'.$value['subject'].'"><strong>'.$value['subject'].'</strong></a><br />
					<a href="'.$dzUrl.'forum.php?mod=viewthread&tid='.$value['tid'].'&extra=page=1" class="cGg">'.$value['message'].'<font class="cDRed">[详细]</font></a>
				</div>';
}
            echo   '<ul style="padding-top:10px;"> ' ;              	
	foreach ($jsonRs['bbs_a'] as $key=>$value):
		if ($key > 0 or empty($jsonRs['bbs_a'][0]['attachment'])){
			echo '<li><p><a href="'.$dzUrl.'forum.php?mod=viewthread&tid='.$value['tid'].'&extra=page=1" target="_blank">·'.$value['subject'].'</a></p></li>';
		}
	endforeach;
    echo '</ul>';
	die();	
}


/**
 * 专业交流区
 */
if($act=='zhuanyejiaoliuqu'){
	echo '<h3><a href="'.$dzUrl.'forum.php?mod=forumdisplay&fid='.$jsonRs['sszq_HS_bbsMap0'].'" target="_blank">'.$jsonRs['sszq_HS_bbsMap1'].'</a></h3>';
	if(!empty($jsonRs['bbs_b'][0]['attachment'])){
	
	$value = $jsonRs['bbs_b'][0];
	echo '<div>
					<a href="'.$dzUrl.'forum.php?mod=viewthread&tid='.$value['tid'].'&extra=page=1"><img src="'.$dzImgUrl.'forum/'.$value['attachment'].'" width="120" height="90" align="left" class="thumb" /></a>
					<a href="'.$dzUrl.'forum.php?mod=viewthread&tid='.$value['tid'].'&extra=page=1" class="cGray" title="'.$value['subject'].'"><strong>'.cutstr($value['subject'],12,'..').'</strong></a><br />
					<a href="'.$dzUrl.'forum.php?mod=viewthread&tid='.$value['tid'].'&extra=page=1" class="cGg">'.$value['message'].'<font class="cDRed">[详细]</font></a>
				</div>';
	}
         echo  '<ul style="padding-top:10px;"> ' ;              	
	foreach ($jsonRs['bbs_b'] as $key=>$value):
	if ($key > 0 or empty($jsonRs['bbs_b'][0]['attachment'])){
			echo '<li><p><a href="'.$dzUrl.'forum.php?mod=viewthread&tid='.$value['tid'].'&extra=page=1" target="_blank">·'.$value['subject'].'</a></p></li>';
		}
	endforeach;
    echo '</ul>';
	die();	
}


/**
 * 休闲娱乐区
 */
if($act=='xiuxianyulequ'){
	echo '<h3><a href="'.$dzUrl.'forum.php?mod=forumdisplay&fid='.$jsonRs['sszq_HS_bbsMap0'].'" target="_blank">'.$jsonRs['sszq_HS_bbsMap1'].'</a></h3>';
	
	if(!empty($jsonRs['bbs_c'][0]['attachment'])){
	$value = $jsonRs['bbs_c'][0];
	echo '<div>
					<a href="'.$dzUrl.'forum.php?mod=viewthread&tid='.$value['tid'].'&extra=page=1"><img src="'.$dzImgUrl.'forum/'.$value['attachment'].'" width="120" height="90" align="left" class="thumb" /></a>
					<a href="'.$dzUrl.'forum.php?mod=viewthread&tid='.$value['tid'].'&extra=page=1" class="cGray" title="'.$value['subject'].'"><strong>'.cutstr($value['subject'],12,'..').'</strong></a><br />
					<a href="'.$dzUrl.'forum.php?mod=viewthread&tid='.$value['tid'].'&extra=page=1" class="cGg">'.$value['message'].'<font class="cDRed">[详细]</font></a>
				</div>';
      }   
    echo  '<ul style="padding-top:10px;"> ' ;              	
	foreach ($jsonRs['bbs_c'] as $key=>$value):
		if ($key > 0 or empty($jsonRs['bbs_c'][0]['attachment'])){
			echo '<li><p><a href="'.$dzUrl.'forum.php?mod=viewthread&tid='.$value['tid'].'&extra=page=1" target="_blank">·'.$value['subject'].'</a></p></li>';
		}
	endforeach;
    echo '</ul>';
	die();
}



/**
 * 大家在做什么
 */
if ($act=='dajiazaizuoshenme'){
	$url  = $dzUrl.'member.php?mod=activities&channel=home';
	
	$rs = file_get_contents($url);
	$arr = json_decode($rs,true);
	for ($i=0;$i<count($arr);$i++){
		$arr[$i]['avater'] = str_replace('uc_server/images',$dzUrl.'uc_server/images',$arr[$i]['avater']);
		$arr[$i]['act_html'] = str_replace('home.php?',$dzUrl.'home.php?',$arr[$i]['act_html']);
		
		echo '<li>';
		echo '<a href="'.$dzUrl.'home.php?mod=space&uid='.$arr[$i]['uid'].'" target="_blank">';
		echo $arr[$i]['avater'];
		echo $arr[$i]['act_html'].'<br /><span class="act_time">';
		echo $arr[$i]['dateline_str'].'</span>';
		echo '</a>';
		echo '</li>';
	}
	echo '<div class="clear">&nbsp;</div><div class="clear">&nbsp;</div>';
	die();
}
/**
 * 火秀人气榜
 */
if ($act=='huoxiurenqibang'){
	$value = $jsonRs['member_credit'][0];
	echo '<div class="rank_one"><ul><li class="fbnum">one</li><li><p>用户名：</p><p>积分：</p><p>性别：</p></li><li><p>
		<a href="'.$dzUrl.'home.php?mod=space&uid='.$value[uid].'" target="_blank">';
	if ($value['nickname']!='')
	{
		echo $value['nickname'];
	}else{
		echo $value['username'];
	}
	echo'</a></p><p>'.$value['credits'].'</p><p>';
	if ($value['gender']==1){
		echo '男';
	}elseif ($value['gender']==2){ 
		echo '女';
	}else{
		echo '保密';
	}
	echo '</p></li><li class="rank_ts"><a href="'.$dzUrl.'home.php?mod=space&uid='.$value[uid].'" target="_blank">'.$value['avatar'].'</a></li></ul></div>';		
	echo '<div class="rank_num"><ul>';
	foreach ($jsonRs['member_credit'] as $key => $value):
		if ($key > 0){
			echo '<li ';
			if ($key%2 == 0){ 
				echo 'class="rank_bgray"';
			}
			echo '>';
			echo '<p class="num01">'.($key+1).'</p><p class="num02"><a href="'.$dzUrl.'home.php?mod=space&uid='.$value[uid].'" target="_blank">'.$value['username'].'</a></p>
				<p class="num03">'.$value['credits'].'</p><p class="num04">';
			if ($value['gender']==1){
				echo '男';
		    }elseif ($value['gender']==2){
		    	echo '女';
		    } else{
		   		echo '保密';
		    }
		    echo '</p></li>	';
		}
	endforeach;
	echo '</ul></div>';
	die();
	
}

/**
 * **************************************************新闻版块********************************************
 */
/**
 * 论坛热帖
 */
if($act=='luntanretie'){
	//print_r($jsonRs);
	$value = $jsonRs['bbs_c'][0];	
	echo '<div id="kuangzi" class="bgse2"><div class="title3"><p class="titlehh2">论坛热帖</p><p class="moer"><a href="'.$dzUrl.'forum.php">更多 >></a></p></div>
          <div class="tuwen2"><a href="'.$dzUrl.'forum.php?mod=viewthread&tid='.$value['tid'].'&extra=page=1" target="_blank">';
    echo '<img src="'.$dzImgUrl.'forum/'.$value['attachment'].'"   width="90" height="65" align="left" class="tuwentu" /></a>
                    <p><a href="'.$dzUrl.'forum.php?mod=viewthread&tid='.$value['tid'].'&extra=page=1" target="_blank"><span class="text3">'.cutstr($value['subject'],12).'</span><br />'. cutstr( preg_replace('/(\[)(\/)*[\w+]*(=)*[\w+]*(\])/', '', $value['message']),23,'...').'</a></p>
              </div>
               <ul class="pailiebg">';
    foreach ($jsonRs['bbs_c'] as $key =>$value):   
    	if ($key>0){        	 
    		echo '<li class="pailie"><a href="'.$dzUrl.'forum.php?mod=viewthread&tid='.$value['tid'].'&extra=page=1" target="_blank">'.cutstr($value['subject'],20).'</a></li>';
    	}
    endforeach;                    
    echo '</ul> </div><!--[if !IE]>kuangziend<![endif]--><div class="kongge"></div>';
	die();
}

if($act=='saishiqunzu'){
	
	echo '<div id="kuangzi" class="bgse2">
               <div class="title3"><p class="titlehh2">赛事群组</p><p class="moer"><a href="'.$dzUrl.'group.php">更多 >></a></p></div>
               <div class="nrrwu">';
    if ($jsonRs['topgrouplist']){
    	$ii=1;
    	foreach ($jsonRs['topgrouplist'] as $fid => $group):
    		$group[icon] = $dzUrl.$group[icon];
            echo '<dl><dt>
            <a href="'.$dzUrl.'forum.php?mod=group&fid='.$group[fid].'"><img src="'.$group[icon].'" title="'.$group[name].'" width="48" height="48" /></a>
            </dt><dd><a href="'.$dzUrl.'forum.php?mod=group&fid='.$group[fid].'" title="'.$group[name].'">'.str_cut($group[name],4,'').'</a></dd></dl>';
        
	        if ($ii%4 == 0){
	        	 echo '<div class="clear">&nbsp;</div>';
	        }
        	$ii++;
        endforeach;  
        echo '<div class="clear">&nbsp;</div>';
        } 
        echo '</div><ul><div class="kongge"></div>';
        if ($jsonRs['hotbbsfungroup'])
        foreach ($jsonRs['hotbbsfungroup'] as $groupid =>$group): 
        echo '<li class="pailie2"><a href="'.$dzUrl.'forum.php?mod=viewthread&tid='.$group[tid].'" target="_blank">'.str_cut($group[subject],12,'').'</a> 
        <a href="'.$dzUrl.'forum.php?mod=group&fid='.$group[fid].'" target="_blank"  style="font-size:12px;color:#888888">['.$group[name].']</a></li>';
        endforeach;
        echo ' </ul><div class="kongge"></div></div>';
	die();
}


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
