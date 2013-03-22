<?php
require_once '../cmstop/config/define.php';
$act          = @$_GET['act'];

//$dzUrl        = $_GET['dz_url'];
$dzUrl=DX_URL;
$dzApiUrl     = $dzUrl.'api/star.php?act='.$act.'&time='.time().'&dz_url='.$dzUrl;
$wwwUrl       = "http://www.huoshow.com/";
$rs           = @file_get_contents($dzApiUrl); 
$jsonRs       = json_decode($rs,true);
if(!is_array($jsonRs)) die('');
$jsonCounts   = count($jsonRs);
error_reporting(0);
$group="group/";
if ($act == 'star'){
		 for ($i=0;$i<4;$i++){
			 $c = $i+1;
			 echo ' <div class="fan1">
        <div class="fan1_1">
        <dl>
        <dd><img src="'.$dzUrl.''.$jsonRs['recommend'][$i]['icon'].'" onerror="this.onerror=null;this.src='."'".$dzUrl.'static/image/common/groupicon.gif'."'".'"/></dd>
        <dt><span>'.mb_strcut($jsonRs['recommend'][$i]['name'],0,20,'utf-8').'</span></dt>
		
        
        <ul>
        <li>已有 '.$jsonRs['numfensi'.$i][$i]['num'].' 粉丝</li>
		<li>已有'.$jsonRs['num'.$i].'个粉丝圈</li>
        </ul>
        
        </dl>
        <div class="clear"></div></div>
        <Div class="form_height">     
		
   <table>
     <tr><td><a href="'.$dzUrl.'forum.php?mod=group&fid='.$jsonRs['recommend'][$i]['fid'].'" target="_blank" class="fans_inputbg"></td>
    <td>本周排名<span> '.$c.' </span></td>
    </tr></table>

  </Div>';
		
		echo '<h4 class="fans_bg">粉丝圈</h4>';
		for ($b=0;$b<3;$b++) {
    	echo '<div class="fansgroup">
        <dl>';
        if ($i==0){
        echo '<dd><img src="'.$dzUrl.$group.''.$jsonRs['fensi1'][$b]['icon'].'" onerror="this.onerror=null;this.src='."'".$dzUrl.'static/image/common/groupicon.gif'."'".'"/></dd>
        <dt><span>'.$jsonRs['fensi1'][$b]['name'].'</span></dt>
        <dd class="span_no"> 
        <span>'.$jsonRs['fensi1'][$b]['membernum'].'</span><span>'.$jsonRs['fensi1'][$b]['posts'].'</span>
       </dd>';
		} elseif ($i==1) {
		echo '<dd><img src="'.$dzUrl.$group.''.$jsonRs['fensi2'][$b]['icon'].'" onerror="this.onerror=null;this.src='."'".$dzUrl.'static/image/common/groupicon.gif'."'".'"/></dd>
        <dt><span>'.$jsonRs['fensi2'][$b]['name'].'</span></dt>
        <dd class="span_no"> 
        <span>'.$jsonRs['fensi2'][$b]['membernum'].'</span><span>'.$jsonRs['fensi2'][$b]['posts'].'</span>
       </dd>';
		}elseif ($i==2) {
		echo '<dd><img src="'.$dzUrl.$group.''.$jsonRs['fensi3'][$b]['icon'].'" onerror="this.onerror=null;this.src='."'".$dzUrl.'static/image/common/groupicon.gif'."'".'"/></dd>
        <dt><span>'.$jsonRs['fensi3'][$b]['name'].'</span></dt>
        <dd class="span_no"> 
        <span>'.$jsonRs['fensi3'][$b]['membernum'].'</span><span>'.$jsonRs['fensi3'][$b]['posts'].'</span>
       </dd>';
		} else {
		echo '<dd><img src="'.$dzUrl.$group.''.$jsonRs['fensi4'][$b]['icon'].'" onerror="this.onerror=null;this.src='."'".$dzUrl.'static/image/common/groupicon.gif'."'".'"/></dd>
        <dt><span>'.$jsonRs['fensi4'][$b]['name'].'</span></dt>
        <dd class="span_no"> 
        <span>'.$jsonRs['fensi4'][$b]['membernum'].'</span><span>'.$jsonRs['fensi4'][$b]['posts'].'</span>
       </dd>';
		}
        echo '</dl>
        <div class="clear"></div>
        </div>';
		}
   echo '</div>';
		
 }
}


?>
