<?php
header("Content-Type: text/xml; charset=UTF-8");
require './../source/class/class_core.php';
require_once './../source/function/function_home.php';

$discuz = & discuz_core::instance();

$discuz->init();
define('WWW_HOST','http://'.$_SERVER['HTTP_HOST'].'/');

runhooks();
$res=array();
$user_money=array();
//$uid=$_GET['uid'];

$html = '';
if($_G['uid'])
{
	$notice=$_G['member']['newprompt'] ? $_G['member']['newprompt'] :0;
	//消息
	$newpm=$_G['member']['newpm'] ? $_G['member']['newpm'] :0;
	//网站管理权限门户
	if ($_G['group']['allowmanagearticle'] || $_G['group']['allowdiy'] || $_G['group']['allowauthorizedblock'] || $_G['group']['allowauthorizedarticle'])
	{
		$portalcp=1;
	}
	else 
	{
	    $portalcp=0;
	}
	//论坛管理权限
	if($_G['group']['radminid'] > 1)
	{
		$forum=array('fid'=>$_G['fid'],'name'=>"{$_G['setting']['navs'][2]['navname']}管理");
	}
	else 
	{
		$forum=array();
	}
	//网站管理权限管理中心
	if($_G['group']['radminid'] == 1 || $_G['member']['allowadmincp'])
	{
		$admin=1;
	}
	else 
	{
		$admin=0;
	}
	//积分
	$credits=$_G['member']['credits'] ? $_G['member']['credits'] : 0 ;
	//
	$user_money[]=array(
        "title" =>"积分" ,
        "value"=>$credits,
        "unit"=>"",
        "img"=>"",
	);
	//威望金钱贡献相关
	if(!empty($_G['setting']['extcredits']))
	{
		foreach ( $_G['setting']['extcredits'] as $k=>$v)
		{
			if (empty($v['hiddeninheader']))
       	  	{
       	  		$user_money[]=array(
       	  		"title" =>$v['title'],
       	  		"value"=>getuserprofile('extcredits'.$k),
       	  		"unit"=>$v['unit'],
       	  		"img"=>$v['img'],
       	  		);
       	  	}
		}
	}
	if ($_G['member']['nickname']) {
		$username= $_G['member']['nickname'].'('.$_G['uid'].')';	
	}else {
		$username= $_G['username'].'('.$_G['uid'].')';	
	}
	//用户组
	$usergroup=$_G['group']['grouptitle'] ? $_G['group']['grouptitle'] : "";
	$user_money[]=array(
        "title" =>"用户组" ,
        "value"=>$usergroup,
        "unit"=>"",
        "img"=>"",
	);
	$res=array(
        'notice'=>$notice,
        'newpm'=>$newpm,
        'portalcp'=>$portalcp,
        'forum'=>$forum,
        'admin'=>$admin,
        'money'=>$user_money,
        'formhash'=>FORMHASH,
        'huoshowbi'=>SIPHuoShowGetBalance($_G['uid']),
        'huobi'=>SIPHuoCoinGetBalance($_G['uid']),
        'uid'=>$_G['uid'],
        'username'=>$username
	); 
	//echo $notice;die();      
?>

<?php 
$avatar = avatar1($res['uid'], 'small',true,false,true);
$html .='<div class="userinfo">';
if (!empty($notice)){
	$html.='
	<script> noticeTitle(); </script>
	<span class="top_notice_info"><a target="_blank" href="'.WWW_HOST.'home.php?mod=space&do=notice'.'">提醒('.$notice.')</a></span>';
}	
if (!empty($newpm)){
	$html.='<span class="top_pm_info"><a target="_blank" href="'.WWW_HOST.'home.php?mod=space&do=pm'.'">消息('.$newpm.')</a></span> ';
}
$html.='欢迎你：<span><a target="_blank" href="'.WWW_HOST.'home.php?mod=space&do=home">'.$res['username'].'</a>
		&nbsp;&nbsp;<a target="_blank" href="'.WWW_HOST.'home.php?mod=spacecp" class="top_uc_setting">设置</a></span></div>
        <script>(function($){$(function(){make_hoverbox("user_setting");});})(jQuery);</script>
        <div class="setting" id="user_setting">
          <a href="javascript:;" id="setting_panel_tirgger">&nbsp;</a>
          <div id="panel" class="">
	  <iframe src="about:blank" frameborder="0" scrolling="no"
	   style="position:absolute;width:100%;height:200px;left:0;top:0;"></iframe>
	   <div style="position:relative;">
            <p class="panel_top"></p>
            <div class="panel_center">
              <div class="panel_content">
                <div class="panel_info_img">
                  <img src="'.$avatar.'" class="avatar" style="height:40px;"/>
                </div>
                <div class="panel_info">
                  <ul>
                    <li class="number"><strong>火秀号：</strong>'.$res['uid'].'</li>
                    <li class="usergroup"><strong>用户组：</strong>'.$usergroup.'</li>
		    <li class="coin">
		    <a target="_blank" href="'.WWW_HOST.'home.php?mod=space&do=pay&view=me'.'" class="recharge"></a>
		    <strong>火币：</strong>'.$res['huoshowbi'].'
		    </li>
		    <li class="coin">
		    <a target="_blank" href="'.WWW_HOST.'home.php?mod=space&do=withdraw'.'" class="withdraw"></a>
		    <strong>秀币：</strong>'.$res['huobi'].'
		    </li>
                  </ul>
                </div>
                <div style="clear:both"></div>
                <p class="my_huoshow_top"></p>
                <div class="my_huoshow_top_box">
                  <div class="menu">
                    <span class="panel_content_blog"><a target="_blank" href="'. WWW_HOST.'home.php?mod=space&do=blog&view=me'.'">我的日志</a></span>
                    <span class="panel_content_photo"><a target="_blank" href="'.WWW_HOST.'home.php?mod=space&do=album&view=me'.'">我的相册</a></span>
                    <span class="panel_content_myshow"><a target="_blank" href="'.WWW_HOST.'home.php?mod=space&do=myshow&view=me'.'">MY秀</a></span>
                    <span class="panel_content_topic"><a target="_blank" href="'.WWW_HOST.'home.php?mod=space&do=thread&view=me'.'">帖子</a></span>
                    <span class="panel_content_gift"><a target="_blank" href="'.WWW_HOST.'home.php?mod=space&do=gifts'.'">礼物</a></span>
                  </div>
                  <div class="manage">';
				if (!empty($notice)){
					$html.='<span class="panel_content_notice_nums"><img src="'.WWW_HOST.'static/image/common/notice.gif"/> <a target="_blank" href="'.WWW_HOST.'home.php?mod=space&do=notice'.'">提醒('.$notice.')</a></span>';
				}else {
					$html.='<span class="panel_content_notice"><img src="'.WWW_HOST.'static/image/common/notice.gif"/> <a target="_blank" href="'.WWW_HOST.'home.php?mod=space&do=notice'.'">提醒</a></span>';
				}	
				if (!empty($newpm)){
					$html.='<span class="panel_content_newpm_nums"><img src="'.WWW_HOST.'static/image/common/new_pm.gif"/> <a target="_blank" href="'.WWW_HOST.'home.php?mod=space&do=pm'.'">消息('.$newpm.')</a></span>';
				}else {
					$html.='<span class="panel_content_newpm"><img src="'.WWW_HOST.'static/image/common/new_pm.gif"/> <a target="_blank" href="'.WWW_HOST.'home.php?mod=space&do=pm'.'">消息</a></span>';
				}
                  $html.='<span class="panel_content_friend"><a target="_blank" href="'.WWW_HOST.'home.php?mod=space&do=friend'.'">好友</a></span>
                    <span class="panel_content_task"><a target="_blank" href="'.WWW_HOST.'home.php?mod=task&item=new'.'">任务</a></span>';
                 	if($res['admin']==1){
                 		$html .='<span class="panel_content_config"><a target="_blank" href="'.WWW_HOST.'admin.php'.'" target="_blank">管理中心</a></span>';
                 	}
                  $html .='</div>
                </div>
                 <a class="panel_center_quit" href="'.WWW_HOST.'member.php?mod=logging&action=logout&formhash='.FORMHASH.'">退出</a>
                <div style="clear:both"></div>
              </div>
            </div>
	    </div>
          </div>
        </div>';
} else 
{
	$html .='<div class="reg"><a target="_blank" href="'.WWW_HOST.'member.php?mod=register">注册</a></div>
        <div class="signin" id="user_login"><a onclick="showWindow(\'login\', this.href);hideWindow(\'register\');" href="'.WWW_HOST.'member.php?mod=logging&amp;action=login" id="login_popup_trigger">登录</a></div>';
}

$login = array('html'=>$html);
//echo $html;die();
echo $_GET['jsoncallback'].'('.json_encode($login).')';
?>


