<?php
$act          = @$_GET['act'];
$type= $_GET['type'];
$dzUrl        = $_GET['dz_url'];
$dzApiUrl     = $dzUrl.'api/movie_rank.php?act='.$act.'&type='.$type.'&time='.time().'&dz_url='.$dzUrl;
$wwwUrl       = "http://www.huoshow.com/";
//echo $dzApiUrl;
$rs           = @file_get_contents($dzApiUrl); 
if (trim($rs)=='') die('');

$jsonRs       = json_decode($rs,true);
//print_r($jsonRs);die;
if(!is_array($jsonRs)) die('');
$jsonCounts   = count($jsonRs);
error_reporting(0);

////影视栏目-----电影，电视排行榜
if($act=='movie_rank'){
   	if($jsonCounts>0){
        
        for ($i=0;$i<$jsonCounts;$i++){
            if($jsonRs[$i][liters_drop]==1){
						$drop=rank_up;
		       }elseif($jsonRs[$i][liters_drop]==2){
		            	$drop=rank_retain;	
			   }else{
				        $drop=rank_down;	 	
			   }
			   if($i==0){
			   	echo'<div class="charts_top"><div class="charts_top_pic"><img src="'.$dzUrl.$jsonRs[$i][image].'" width="180" height="70" />
        <span class="'.$drop.'"></span></div><span class="charts_top_text"><a href="'.$jsonRs[$i][link].'">'.$jsonRs[$i][key].'</a></span></div>
        <div class="charts_others"><ul>';
			   }else{
                  echo'<li><span class="charts_text"><a href="'.$jsonRs[$i][link].'">'.$jsonRs[$i][key].'</a></span>
                  <span class="charts_number">'.$jsonRs[$i][value].'</span> <span class="'.$drop.'"></span></li>';
						
                }
           }
                 echo'</ul></div>';
                           }
                 echo '<div class="clear">&nbsp;</div>';
       }
