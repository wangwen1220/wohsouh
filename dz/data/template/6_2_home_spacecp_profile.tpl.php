<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_profile');
0
|| checktplrefresh('./template/huoshow/home/spacecp_profile.htm', './template/huoshow/common/header.htm', 1346647907, '2', './data/template/6_2_home_spacecp_profile.tpl.php', './template/huoshow', 'home/spacecp_profile')
|| checktplrefresh('./template/huoshow/home/spacecp_profile.htm', './template/huoshow/home/spacecp_header.htm', 1346647907, '2', './data/template/6_2_home_spacecp_profile.tpl.php', './template/huoshow', 'home/spacecp_profile')
|| checktplrefresh('./template/huoshow/home/spacecp_profile.htm', './template/huoshow/home/spacecp_footer.htm', 1346647907, '2', './data/template/6_2_home_spacecp_profile.tpl.php', './template/huoshow', 'home/spacecp_profile')
|| checktplrefresh('./template/huoshow/home/spacecp_profile.htm', './template/huoshow/home/spacecp_profile_nav.htm', 1346647907, '2', './data/template/6_2_home_spacecp_profile.tpl.php', './template/huoshow', 'home/spacecp_profile')
|| checktplrefresh('./template/huoshow/home/spacecp_profile.htm', './template/huoshow/common/seditor.htm', 1346647907, '2', './data/template/6_2_home_spacecp_profile.tpl.php', './template/huoshow', 'home/spacecp_profile')
|| checktplrefresh('./template/huoshow/home/spacecp_profile.htm', './template/huoshow/home/spacecp_footer.htm', 1346647907, '2', './data/template/6_2_home_spacecp_profile.tpl.php', './template/huoshow', 'home/spacecp_profile')
|| checktplrefresh('./template/huoshow/home/spacecp_profile.htm', './template/huoshow/common/footer.htm', 1346647907, '2', './data/template/6_2_home_spacecp_profile.tpl.php', './template/huoshow', 'home/spacecp_profile')
|| checktplrefresh('./template/huoshow/home/spacecp_profile.htm', './template/huoshow/home/spacecp_header_name.htm', 1346647907, '2', './data/template/6_2_home_spacecp_profile.tpl.php', './template/huoshow', 'home/spacecp_profile')
|| checktplrefresh('./template/huoshow/home/spacecp_profile.htm', './template/huoshow/home/spacecp_header_name.htm', 1346647907, '2', './data/template/6_2_home_spacecp_profile.tpl.php', './template/huoshow', 'home/spacecp_profile')
;?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><? if($liveSeoTitle) { ?><?=$liveSeoTitle?><? } else { if(!empty($navtitle)) { ?><?=$navtitle?>_<? } if(empty($nobbname1)) { ?><?=$_G['setting']['bbname']?><? } } ?></title>
    <?=$_G['setting']['seohead']?> 
    <meta name="keywords" content="<? if(!empty($metakeywords)) { echo htmlspecialchars($metakeywords); } ?>" />
    <meta name="description" content="<? if(!empty($metadescription)) { echo htmlspecialchars($metadescription); ?> <? } ?>,<?=$_G['setting']['bbname']?>" />
    <base href="<?=$_G['siteurl']?>" />              
    <link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_common.css?<?=VERHASH?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_home_spacecp.css?<?=VERHASH?>" /><? if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['cookie']['extstyle']?>/style.css" /><? } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['style']['defaultextstyle']?>/style.css" /><? } ?>    <link href="<?=WWW_URL?>img/templates/huoshow02/css/global.css" rel="stylesheet" type="text/css" />
    <link href="<?=WWW_URL?>img/templates/huoshow02/css/index.css" rel="stylesheet" type="text/css" />
    <script src="static2/js/jquery.min.js" type="text/javascript"></script>
    <script src="static2/js/jquery.tools.min.js?<?=VERHASH?>" type="text/javascript"></script> 
    <script src="<?=IMG_URL?>js/lib/jquery.cookie.js" type="text/javascript"></script>
    <script src="<?=IMG_URL?>templates/huoshow_01/js/basic.js" type="text/javascript"></script>
    <script src="<?=IMG_URL?>js/config.js" type="text/javascript"></script>
    <script>
      var STYLEID = '<?=STYLEID?>', STATICURL = '<?=STATICURL?>', IMGDIR = '<?=IMGDIR?>', VERHASH = '<?=VERHASH?>', charset = '<?=CHARSET?>', discuz_uid = '<?=$_G['uid']?>', cookiepre = '<?=$_G['config']['cookie']['cookiepre']?>', cookiedomain = '<?=$_G['config']['cookie']['cookiedomain']?>', cookiepath = '<?=$_G['config']['cookie']['cookiepath']?>', showusercard = '<?=$_G['setting']['showusercard']?>', attackevasive = '<?=$_G['config']['security']['attackevasive']?>', disallowfloat = '<?=$_G['setting']['disallowfloat']?>', creditnotice = '<? if($_G['setting']['creditnotice']) { ?><?=$_G['setting']['creditnames']?><? } ?>', defaultstyle = '<?=$_G['style']['defaultextstyle']?>', REPORTURL = '<?=$_G['currenturl_encode']?>', SITEURL = '<?=$_G['siteurl']?>', DXURL = '<?=$_G['siteurl']?>', CMSURL = 'http://www.huoshow.com/';
    </script>
    <script src="<?=$_G['setting']['jspath']?>common.js?<?=VERHASH?>" type="text/javascript"></script>
    <script src="<?=DX_URL?>static2/js/huoshow_common.js?<?=VERHASH?>" type="text/javascript"></script>

    <? if(defined('CURMODULE') && ($_G['basescript'] == 'forum' || $_G['basescript'] == 'group') && (CURMODULE == 'index' || CURMODULE == 'forumdisplay' || CURMODULE == 'group')) { ?><?=$rsshead?><? } ?>
    <? if($_G['basescript'] == 'forum') { ?>
    <? if(!empty($_G['cookie']['widthauto']) && empty($_G['disabledwidthauto'])) { ?>
    <link rel="stylesheet" id="css_widthauto" type="text/css" href="data/cache/style_<?=STYLEID?>_widthauto.css?<?=VERHASH?>" />
    <script>HTMLNODE.className += ' widthauto'</script>
    <? } ?>
    <script src="<?=$_G['setting']['jspath']?>forum.js?<?=VERHASH?>" type="text/javascript"></script>
    <? } elseif($_G['basescript'] == 'home' || $_G['basescript'] == 'userapp') { ?>
    <script src="<?=$_G['setting']['jspath']?>home.js?<?=VERHASH?>" type="text/javascript"></script>
    <? } elseif($_G['basescript'] == 'portal') { ?>
    <script src="<?=$_G['setting']['jspath']?>portal.js?<?=VERHASH?>" type="text/javascript"></script>
    <? } ?>
    <? if($_G['basescript'] != 'portal' && $_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?>
    <script src="<?=$_G['setting']['jspath']?>portal.js?<?=VERHASH?>" type="text/javascript"></script>
    <? } ?>
    <? if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?>
    <link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_css_diy.css?<?=VERHASH?>" />
    <? } ?>
  </head>

  <body class="body_bg">
    <div id="append_parent"></div>
    <div id="ajaxwaitid"></div>
    <div class="top_nav">
      <div class="top_nav_bar">
        <div class="top_nav_bg">
          <div class="top_nav_left">
            <div class="common">
              <a target="_blank" href="<?=WWW_URL?>">首页</a>-<a target="_blank" href="<?=DX_HUOSHOW_SHOW_URL?>">直播</a>-<a target="_blank" href="<?=WWW_URL?>events/">赛事</a>-<a target="_blank" href="<?=WWW_URL?>star/">明星</a>-<a target="_blank" href="<?=WWW_URL?>movie/">影视</a>-<a target="_blank" href="<?=WWW_URL?>music/">音乐</a>-<a target="_blank" href="<?=WWW_URL?>supermodel/">超模</a>-<a target="_blank" href="<?=WWW_URL?>game/">游戏</a>-<a target="_blank" href="<?=WWW_URL?>pic/">美图</a>-<a target="_blank" href="<?=WWW_URL?>myshow/">My秀</a>-<a target="_blank" href="<?=DX_URL?>group.php">群组</a>-<a target="_blank" href="<?=DX_URL?>home.php">空间</a>-<a target="_blank" href="<?=DX_HUOSHOW_BBS_URL?>">论坛</a>
              <?php require_once(DISCUZ_ROOT."huoshow/module/commom/test_switch.php"); ?>            </div>
          </div>

          <div class="top_nav_right" id="login_bar">&nbsp;</div>

          <script>
            (function($){
              $(function(){
                $.getJSON('<?=DX_URL?>api/login.php?jsoncallback=?', function(d){
                  $("#login_bar").html(d.html);
                });
              });
            })(jQuery);
          </script>

        </div>
      </div>
    </div>    

    <div class="nav_bg">
      <h1 class="channel_logo"><a target="_blank" href="<?=WWW_URL?>">火秀网</a></h1>
      <div id="sub_channel">
        <ul>
          <li><a target="_blank" href="<?=WWW_URL?>">首页</a></li>
          <li><a target="_blank" href="<?=DX_HUOSHOW_SHOW_URL?>">直播大厅</a></li>
          <li><a target="_blank" href="<?=WWW_URL?>events/">赛事</a></li>
          <li><a target="_blank" href="<?=WWW_URL?>star/">明星</a></li>
          <li><a target="_blank" href="<?=WWW_URL?>movie/">影视</a></li>
          <li><a target="_blank" href="<?=WWW_URL?>music/">音乐</a></li>
          <li><a target="_blank" href="<?=WWW_URL?>supermodel/">超模</a></li>
          <li><a target="_blank" href="<?=WWW_URL?>game/">游戏</a></li>
          <li><a target="_blank" href="<?=WWW_URL?>pic/">美图</a></li>
          <!--<li><a href="#">排行榜</a></li>-->
          <li><a target="_blank" href="<?=WWW_URL?>myshow/">MY秀</a></li>
          <li><a target="_blank" href="<?=DX_URL?>group.php">群组</a></li>
          <li><a target="_blank" href="<?=DX_URL?>home.php">空间</a></li>
          <li><a target="_blank" href="<?=DX_HUOSHOW_BBS_URL?>">论坛</a></li>
        </ul>
      </div>
      <div class="clear"></div>
    </div>

    <div class="red_bar">
      <div class="red_bar_text">
        <div class="red_bar_today"><span class="red_bar_today_bg"></span><?=DATE_YMD?> 星期<?=DATE_WEEK?></div>
        <div id="header_rollnews_keywords" >                           
        </div>
        <div class="shuru_suosou">
          <script>
            (function($){
              $(function(){

                window.clearKeyword = function(){
                  var search_wd = $.trim($("#search_wd").val());
                  if(search_wd=='请输入关键字'){
                    $("#search_wd").val('');
                  }
                  if(search_wd==''){
                    $("#search_wd").val('请输入关键字');
                  }
                }

                window.checkSForm = function() {
                  var search_wd = $.trim($("#search_wd").val());
                  if(search_wd=='请输入关键字' || search_wd==''){
                    alert('请输入关键字');
                    return false;
                  }
                }

              });
            })(jQuery);
          </script>
          <form method="get" name="search" id="search" action="<?=WWW_URL?>app/" target="_blank" onSubmit="return checkSForm()">
            <input type="hidden" value="search" name="app"/>
            <input type="hidden" value="index" name="controller"/>
            <input type="hidden" value="search" name="action"/>
            <input type="hidden" value="all" name="type"/>
            <input type="text" class="shuru_k" id="search_wd" name="wd" value="请输入关键字"  onclick = "clearKeyword()" onblur = "clearKeyword()" /><div class="s_suo">
              <input type="submit" class="search_submit_index" value=" " width="57" height="20"/></div>
          </form>
        </div>
        <script>
          (function($){
            $(function(){
              $.getJSON('<?=WWW_URL?>api/article.php?act=get_header_rollnews_keywords&do=ajax&jsoncallback=?', function(d){
                $("#header_rollnews_keywords").html(d.html);

              });
            });
          })(jQuery);
        </script>
      </div>
    </div>
    <div class="clear"></div>
    <div class="main_body">
<div id="pt" class="bm cl"><!-- common/simplesearchform --><div class="z">
<a href="./" class="nvhm" title="首页"><?=$_G['setting']['bbname']?></a> <em>&rsaquo;</em>
<a href="home.php"><?=$_G['setting']['navs']['4']['navname']?></a> <em>&rsaquo;</em>
<a href="home.php?mod=spacecp">设置</a> <em>&rsaquo;</em><? if($actives['profile']) { ?>
个人资料
<? } elseif($actives['verify']) { ?>
认证
<? } elseif($actives['avatar']) { ?>
修改头像
<? } elseif($actives['credit']) { ?>
积分
<? } elseif($actives['usergroup']) { ?>
用户组
<? } elseif($actives['privacy']) { ?>
隐私筛选
<? } elseif($actives['sendmail']) { ?>
邮件提醒
<? } elseif($actives['password']) { ?>
密码安全
<? } elseif($actives['plugin']) { ?>
<?=$_G['setting']['plugins'][$pluginkey][$_G['gp_id']]['name']?>
<? } ?></div>
</div>
<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<h1 class="mt"><? if($actives['profile']) { ?>
个人资料
<? } elseif($actives['verify']) { ?>
认证
<? } elseif($actives['avatar']) { ?>
修改头像
<? } elseif($actives['credit']) { ?>
积分
<? } elseif($actives['usergroup']) { ?>
用户组
<? } elseif($actives['privacy']) { ?>
隐私筛选
<? } elseif($actives['sendmail']) { ?>
邮件提醒
<? } elseif($actives['password']) { ?>
密码安全
<? } elseif($actives['plugin']) { ?>
<?=$_G['setting']['plugins'][$pluginkey][$_G['gp_id']]['name']?>
<? } ?></h1>
<!--don't close the div here--><? if($validate) { ?>
<p class="tbmu mbm">管理员否决了你的注册申请，请完善注册原因，重新提交申请</p>
<form action="member.php?mod=regverify" method="post" autocomplete="off">
<input type="hidden" value="<?=FORMHASH?>" name="formhash" />
<table summary="个人资料" cellspacing="0" cellpadding="0" class="tfm">
<tr>
<th>否决原因</th>
<td><?=$validate['remark']?></td>
<td>&nbsp;</td>
</tr>
<tr>
<th>注册原因</th>
<td><input type="text" class="px" name="regmessagenew" value="" /></td>
<td>&nbsp;</td>
</tr>
<tr>
<th>&nbsp;</th>
<td colspan="2">
<button type="submit" name="verifysubmit" value="true" class="pn pnp" /><strong>重新提交申请</strong></button>
</td>
</tr>
</table>
</div></div>
<div class="appl"><div class="tbn">
<h2 class="mt bbda">设置</h2>
<ul>
<li<?=$actives['avatar']?>><a href="home.php?mod=spacecp&amp;ac=avatar">修改头像</a></li>
<li<?=$actives['profile']?>><a href="home.php?mod=spacecp&amp;ac=profile">个人资料</a></li>
<? if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li<?=$actives['verify']?>><a href="<? if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<? } else { ?>home.php?mod=spacecp&ac=videophoto<? } ?>">认证</a></li>
<? } ?>
<li<?=$actives['credit']?>><a href="home.php?mod=spacecp&amp;ac=credit">积分</a></li>
<li<?=$actives['usergroup']?>><a href="home.php?mod=spacecp&amp;ac=usergroup">用户组</a></li>
<li<?=$actives['privacy']?>><a href="home.php?mod=spacecp&amp;ac=privacy">隐私筛选</a></li>
<? if($_G['setting']['sendmailday']) { ?><li<?=$actives['sendmail']?>><a href="home.php?mod=spacecp&amp;ac=sendmail">邮件提醒</a></li><? } ?>
<li<?=$actives['password']?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">密码安全</a></li>
<? if(!empty($_G['setting']['plugins']['spacecp'])) { if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<? if($_G['gp_id'] == $id) { ?> class="a"<? } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?=$id?>"><?=$module['name']?></a></li><? } } } ?>
</ul>
</div></div>
<? } else { if($operation == 'password') { ?>
<p class="tbmu mbm">你必须填写原密码才能修改下面的资料</p>
<form action="home.php?mod=spacecp&amp;ac=profile" method="post" autocomplete="off" onsubmit="return profilecheck()">
<input type="hidden" value="<?=FORMHASH?>" name="formhash" />
<table summary="个人资料" cellspacing="0" cellpadding="0" class="tfm">
<tr>
<th><strong class="rq" title="必填">*</strong>旧密码</th>
<td><input type="password" name="oldpassword" id="oldpassword" class="px" /></td>
</tr>
<tr>
<th>新密码</th>
<td>
<input type="password" name="newpassword" id="newpassword" class="px" />
<p class="d">如不需要更改密码，此处请留空</p>
</td>
</tr>
<tr>
<th>确认新密码</th>
<td>
<input type="password" name="newpassword2" id="newpassword2"class="px" />
<p class="d">如不需要更改密码，此处请留空</p>
</td>
</tr>
<tr id="contact"<? if($_G['gp_from'] == 'contact') { ?> style="background-color: <?=SPECIALBG?>;"<? } ?>>
<th>Email</th>
<td>
<input type="text" name="emailnew" id="emailnew" value="<?=$space['email']?>" class="px" />
<p class="d">
<? if($space['emailstatus']) { ?>
<img src="<?=IMGDIR?>/mail_active.png" alt="已验证" class="vm" /> <span class="xi1">当前邮箱已经验证激活</span>
<? } else { ?>
<img src="<?=IMGDIR?>/mail_inactive.png" alt="未验证" class="vm" /> <span class="xi1">邮箱等待验证中...</span><br />
								系统已经向该邮箱发送了一封验证激活邮件，请查收邮件，进行验证激活。<br>
								如果没有收到验证邮件，你可以更换一个邮箱，或者<a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password&amp;resend=1" class="xi2">重新接收验证邮件</a>
<? } ?>
</p>
<? if($_G['setting']['regverify'] == 1 && (($_G['group']['grouptype'] == 'member' && $_G['adminid'] == 0) || $_G['groupid'] == 8)) { ?><p class="d">!如更改地址，系统将修改你的密码并重新验证其有效性，请慎用</p><? } ?>
</td>
</tr>

<tr>
<th>安全提问</th>
<td>
<select name="questionidnew" id="questionidnew">
<option value="" selected>保持原有的安全提问和答案</option>
<option value="0">无安全提问</option>
<option value="1">母亲的名字</option>
<option value="2">爷爷的名字</option>
<option value="3">父亲出生的城市</option>
<option value="4">你其中一位老师的名字</option>
<option value="5">你个人计算机的型号</option>
<option value="6">你最喜欢的餐馆名称</option>
<option value="7">驾驶执照最后四位数字</option>
</select>
<p class="d">如果你启用安全提问，登录时需填入相应的项目才能登录</p>
</td>
</tr>

<tr>
<th>回答</th>
<td>
<input type="text" name="answernew" id="answernew" class="px" />
<p class="d">如你设置新的安全提问，请在此输入答案</p>
</td>
</tr>
<? if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php $sectpl = '<tr><th><sec></th><td><sec><p class="d"><sec></p></td>'; include template('common/seccheck'); } ?>
<tr>
<th>&nbsp;</th>
<td><button type="submit" name="pwdsubmit" value="true" class="pn pnp" /><strong>保存</strong></button></td>
</tr>
</table>
<input type="hidden" name="passwordsubmit" value="true" />
</form>
<? } else { ?>
<?php if(!empty($_G['setting']['pluginhooks']['spacecp_profile_top'])) echo $_G['setting']['pluginhooks']['spacecp_profile_top']; ?><ul class="tb cl">
<? if($operation != 'verify') { ?>
<li <?=$opactives['base']?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=base">基本资料</a></li>
<li <?=$opactives['contact']?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=contact">联系方式</a></li>
<li <?=$opactives['edu']?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=edu">教育情况</a></li>
<li <?=$opactives['work']?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=work">工作情况</a></li>
<li <?=$opactives['info']?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=info">个人信息</a></li>
<li <?=$opactives['bbs']?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=bbs"><?=$_G['setting']['navs']['2']['navname']?>信息</a></li>
<? if($_G['setting']['allowspacedomain'] && $_G['setting']['domain']['root']['home'] && checkperm('domainlength')) { ?>
<li <?=$opactives['domain']?>><a href="home.php?mod=spacecp&amp;ac=domain">我的空间域名</a></li>
<? } } else { if($_G['setting']['verify']) { if(is_array($_G['setting']['verify'])) foreach($_G['setting']['verify'] as $vid => $verify) { if($verify['available']) { ?>
<li <?=$opactives['verify'.$vid]?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=verify&amp;vid=<?=$vid?>"><?=$verify['title']?></a></li>
<? } } } if($_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li <?=$opactives['videophoto']?>><a href="home.php?mod=spacecp&amp;ac=videophoto">视频认证</a></li>
<? } } if(!empty($_G['setting']['plugins']['spacecp_profile'])) { if(is_array($_G['setting']['plugins']['spacecp_profile'])) foreach($_G['setting']['plugins']['spacecp_profile'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<? if($_G['gp_id'] == $id) { ?> class="a"<? } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;op=profile&amp;id=<?=$id?>"><?=$module['name']?></a></li><? } } } ?>
</ul><? if($vid) { ?>
<p class="tbms mtm"><? if($showbtn) { ?>以下信息通过审核后将不能再次修改,提交后请耐心等待核查！<? } else { ?>恭喜您，您的认证审核通过，您已不能对下面的资料做相关修改。<? } ?></p>
<? } ?>
<iframe id="frame_profile" name="frame_profile" style="display: none"></iframe>
                        <form <? if($operation == 'base') { ?>onsubmit="return checkNickName()"<? } ?> action="<? if($operation != 'plugin') { ?>home.php?mod=spacecp&ac=profile&op=<?=$operation?><? } else { ?>home.php?mod=spacecp&ac=plugin&op=profile&id=<?=$_G['gp_id']?><? } ?>" method="post" enctype="multipart/form-data" autocomplete="off"<? if($operation != 'plugin') { ?> target="frame_profile"<? } ?>>
<input type="hidden" value="<?=FORMHASH?>" name="formhash" />
<? if($_G['gp_vid']) { ?>
<input type="hidden" value="<?=$_G['gp_vid']?>" name="vid" />
<? } if($operation == 'base') { ?>
<script type="text/javascript">
window.checkNickName = function(){
var name = document.getElementById('nickname').value;
var len1 = name.length;
var len2= name.replace(/[^\x00-\xff]/g, '**').length;
if(len1!=len2){
var len = len2;
max = 20;
}else{
var len = len1;
max = 24;
}
if(len>max){
document.getElementById('errornk').innerHTML='昵称长度过长，请控制在25个字符以内';
return false;
}else{
var txt = new RegExp("[\\*,\\&,\\\\,\\/,\\?,\\|,\\:,\\<,\\>,\",\',\\!,\\@,\\#,\\$,\\%,\\^,\\(,\\,\{,\})]");
if (txt.test(name)) {
document.getElementById('errornk').innerHTML='不能包含下列:\n \\ / : * ? \" < > | & ,...等字符';
return false;
}
document.getElementById('errornk').innerHTML='';
}

}
</script>
<? } ?>
<table cellspacing="0" cellpadding="0" class="tfm">
<tr>
<th>用户名</th>
<td><?=$_G['username']?></td>
<td>&nbsp;</td>
</tr>	
<? if($operation == 'base') { ?>
<tr>
<th>昵称</th>
<td><input type="text" class="px" name="nickname" id="nickname" tabindex="1" value="<?=$_G['member']['nickname']?>" onkeyup="checkNickName(this);">
<span id="errornk" style="color:red"></span></td>
<td>&nbsp;</td>
</tr>	
<? } if(is_array($settings)) foreach($settings as $key => $value) { if($value['available']) { ?>
<tr>
<th id="th_<?=$key?>"><? if($value['required']) { ?><strong class="rq" title="必填">*</strong><? } ?><?=$value['title']?></th>
<td id="td_<?=$key?>">
<?=$htmls[$key]?>
</td>
<td class="p">
<? if($value['showinthread'] || $vid) { ?>
<input type="hidden" name="privacy[<?=$key?>]" value="3" />
<? } else { ?>
<select name="privacy[<?=$key?>]">
<option value="0"<? if($privacy[$key] == "0") { ?> selected="selected"<? } ?>>公开</option>
<option value="1"<? if($privacy[$key] == "1") { ?> selected="selected"<? } ?>>好友可见</option>
<option value="3"<? if($privacy[$key] == "3") { ?> selected="selected"<? } ?>>保密</option>
</select>
<? } ?>
</td>
</tr>
<? } } if($operation == 'bbs') { if($allowcstatus) { ?>
<tr>
<th id="th_customstatus">自定义头衔</th>
<td id="td_customstatus"><input type="text" value="<?=$space['customstatus']?>" name="customstatus" id="customstatus" class="px" /></td>
<td>&nbsp;</td>
</tr>
<? } if($_G['group']['maxsigsize']) { ?>
<tr>
<th id="th_sightml">个人签名</th>
<td id="td_sightml">
<div class="tedt">
<div class="bar">
<span class="y"><a href="javascript:;" onclick="$('signhtmlpreview').innerHTML = bbcode2html($('sightmlmessage').value)">预览</a></span>
<? if($_G['group']['allowsigbbcode']) { if($_G['group']['allowsigimgcode']) { ?><?php $seditor = array('sightml', array('bold', 'color', 'img', 'link', 'smilies')); } else { ?><?php $seditor = array('sightml', array('bold', 'color', 'link', 'smilies')); } ?><div class="fpd">
<? if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="文字加粗" class="fbld"<? if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?=$seditor['0']?>', '[b]', '[/b]')"<? } ?>>B</a>
<? } if(in_array('color', $seditor['1'])) { ?>
<a href="javascript:;" title="设置文字颜色" class="fclr" id="<?=$seditor['0']?>forecolor"<? if(empty($seditor['2'])) { ?> onclick="showColorBox(this.id, 2, '<?=$seditor['0']?>');doane(event)"<? } ?>>Color</a>
<? } if(in_array('img', $seditor['1'])) { ?>
<a id="<?=$seditor['0']?>img" href="javascript:;" title="图片" class="fmg"<? if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?=$seditor['0']?>', 'img')"<? } ?>>Image</a>
<? } if(in_array('link', $seditor['1'])) { ?>
<a id="<?=$seditor['0']?>url" href="javascript:;" title="添加链接" class="flnk"<? if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?=$seditor['0']?>', 'url')"<? } ?>>Link</a>
<? } if(in_array('quote', $seditor['1'])) { ?>
<a id="<?=$seditor['0']?>quote" href="javascript:;" title="引用" class="fqt"<? if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?=$seditor['0']?>', 'quote')"<? } ?>>Quote</a>
<? } if(in_array('code', $seditor['1'])) { ?>
<a id="<?=$seditor['0']?>code" href="javascript:;" title="代码" class="fcd"<? if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?=$seditor['0']?>', 'code')"<? } ?>>Code</a>
<? } if(in_array('smilies', $seditor['1'])) { ?>
<a href="javascript:;" class="fsml" id="<?=$seditor['0']?>sml"<? if(empty($seditor['2'])) { ?> onclick="showMenu({'ctrlid':this.id,'evt':'click','layer':2});return false;"<? } ?>>Smilies</a>
<? if(empty($seditor['2'])) { ?>
<script src="data/cache/common_smilies_var.js?<?=VERHASH?>" type="text/javascript" reload="1"></script>
<script type="text/javascript" reload="1">smilies_show('<?=$seditor['0']?>smiliesdiv', <?=$_G['setting']['smcols']?>, '<?=$seditor['0']?>');</script>
<? } } ?>
</div><? } ?>
</div>
<div class="area">
<textarea rows="3" cols="80" name="sightml" id="sightmlmessage" class="pt" onkeydown="ctrlEnter(event, 'profilesubmitbtn');"><?=$space['sightml']?></textarea>
</div>
</div>
<div id="signhtmlpreview"></div>
<script src="<?=$_G['setting']['jspath']?>bbcode.js?<?=VERHASH?>" type="text/javascript"></script>
<script type="text/javascript">var forumallowhtml = 0,allowhtml = 0,allowsmilies = 0,allowbbcode = parseInt('<?=$_G['group']['allowsigbbcode']?>'),allowimgcode = parseInt('<?=$_G['group']['allowsigimgcode']?>');var DISCUZCODE = [];DISCUZCODE['num'] = '-1';DISCUZCODE['html'] = [];</script>
</td>
<td>&nbsp;</td>
</tr>
<? } ?>
<tr>
<th id="th_timeoffset">时区</th>
<td id="td_timeoffset"><?php $timeoffset = array(
		'9999' => '使用系统默认',
		'-12' => '(GMT -12:00) 埃尼威托克岛, 夸贾林环礁',
		'-11' => '(GMT -11:00) 中途岛, 萨摩亚群岛',
		'-10' => '(GMT -10:00) 夏威夷',
		'-9' => '(GMT -09:00) 阿拉斯加',
		'-8' => '(GMT -08:00) 太平洋时间(美国和加拿大), 提华纳',
		'-7' => '(GMT -07:00) 山区时间(美国和加拿大), 亚利桑那',
		'-6' => '(GMT -06:00) 中部时间(美国和加拿大), 墨西哥城',
		'-5' => '(GMT -05:00) 东部时间(美国和加拿大), 波哥大, 利马, 基多',
		'-4' => '(GMT -04:00) 大西洋时间(加拿大), 加拉加斯, 拉巴斯',
		'-3.5' => '(GMT -03:30) 纽芬兰',
		'-3' => '(GMT -03:00) 巴西利亚, 布宜诺斯艾利斯, 乔治敦, 福克兰群岛',
		'-2' => '(GMT -02:00) 中大西洋, 阿森松群岛, 圣赫勒拿岛',
		'-1' => '(GMT -01:00) 亚速群岛, 佛得角群岛 [格林尼治标准时间] 都柏林, 伦敦, 里斯本, 卡萨布兰卡',
		'0' => '(GMT) 卡萨布兰卡，都柏林，爱丁堡，伦敦，里斯本，蒙罗维亚',
		'1' => '(GMT +01:00) 柏林, 布鲁塞尔, 哥本哈根, 马德里, 巴黎, 罗马',
		'2' => '(GMT +02:00) 赫尔辛基, 加里宁格勒, 南非, 华沙',
		'3' => '(GMT +03:00) 巴格达, 利雅得, 莫斯科, 奈洛比',
		'3.5' => '(GMT +03:30) 德黑兰',
		'4' => '(GMT +04:00) 阿布扎比, 巴库, 马斯喀特, 特比利斯',
		'4.5' => '(GMT +04:30) 坎布尔',
		'5' => '(GMT +05:00) 叶卡特琳堡, 伊斯兰堡, 卡拉奇, 塔什干',
		'5.5' => '(GMT +05:30) 孟买, 加尔各答, 马德拉斯, 新德里',
		'5.75' => '(GMT +05:45) 加德满都',
		'6' => '(GMT +06:00) 阿拉木图, 科伦坡, 达卡, 新西伯利亚',
		'6.5' => '(GMT +06:30) 仰光',
		'7' => '(GMT +07:00) 曼谷, 河内, 雅加达',
		'8' => '(GMT +08:00) 北京, 香港, 帕斯, 新加坡, 台北',
		'9' => '(GMT +09:00) 大阪, 札幌, 首尔, 东京, 雅库茨克',
		'9.5' => '(GMT +09:30) 阿德莱德, 达尔文',
		'10' => '(GMT +10:00) 堪培拉, 关岛, 墨尔本, 悉尼, 海参崴',
		'11' => '(GMT +11:00) 马加丹, 新喀里多尼亚, 所罗门群岛',
		'12' => '(GMT +12:00) 奥克兰, 惠灵顿, 斐济, 马绍尔群岛'); ?><select name="timeoffset"><? if(is_array($timeoffset)) foreach($timeoffset as $key => $desc) { ?><option value="<?=$key?>"<? if($key==$space['timeoffset']) { ?> selected="selected"<? } ?>><?=$desc?></option>
<? } ?>
</select>
<p class="mtn">当前时间 : <?php echo dgmdate($_G[timestamp]); ?></p>
<p class="d">如果发现当前显示的时间与你本地时间相差几个小时，那么你需要更改自己的时区设置。</p>
</td>
<td>&nbsp;</td>
</tr>
<? } elseif($operation == 'contact') { ?>
<tr>
<th id="th_sightml">Email</th>
<td id="td_sightml"><?=$space['email']?>&nbsp;(<a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password&amp;from=contact#contact">修改</a>)</td>
<td>&nbsp;</td>
</tr>
<? } if($operation == 'plugin') { ?><?php include(template($_G['gp_id'])); } if($showbtn) { ?>
<tr>
<th>&nbsp;</th>
<td colspan="2">
<input type="hidden" name="profilesubmit" value="true" />
<button type="submit" name="profilesubmitbtn" id="profilesubmitbtn" value="true" class="pn pnp" /><strong>保存</strong></button>
<span id="submit_result" class="rq"></span>						
</td>
</tr>
<? } ?>
</table>
<?php if(!empty($_G['setting']['pluginhooks']['spacecp_profile_bottom'])) echo $_G['setting']['pluginhooks']['spacecp_profile_bottom']; ?>
</form>
<script type="text/javascript">
function show_error(fieldid, extrainfo) {
var elem = $('th_'+fieldid);
if(elem) {
elem.className = "rq";
fieldname = elem.innerHTML;
extrainfo = (typeof extrainfo == "string") ? extrainfo : "";
$('submit_result').innerHTML = " 请检查资料项 " + fieldname + extrainfo;
}
}
function show_success() {
showDialog('资料更新成功!', 'notice', '提示信息', null, 0);
setTimeout(function(){
top.window.location.href = top.window.location.href;
}, 3000);
}
</script>
<? } ?>
</div>
</div>
<div class="appl"><div class="tbn">
<h2 class="mt bbda">设置</h2>
<ul>
<li<?=$actives['avatar']?>><a href="home.php?mod=spacecp&amp;ac=avatar">修改头像</a></li>
<li<?=$actives['profile']?>><a href="home.php?mod=spacecp&amp;ac=profile">个人资料</a></li>
<? if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li<?=$actives['verify']?>><a href="<? if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<? } else { ?>home.php?mod=spacecp&ac=videophoto<? } ?>">认证</a></li>
<? } ?>
<li<?=$actives['credit']?>><a href="home.php?mod=spacecp&amp;ac=credit">积分</a></li>
<li<?=$actives['usergroup']?>><a href="home.php?mod=spacecp&amp;ac=usergroup">用户组</a></li>
<li<?=$actives['privacy']?>><a href="home.php?mod=spacecp&amp;ac=privacy">隐私筛选</a></li>
<? if($_G['setting']['sendmailday']) { ?><li<?=$actives['sendmail']?>><a href="home.php?mod=spacecp&amp;ac=sendmail">邮件提醒</a></li><? } ?>
<li<?=$actives['password']?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">密码安全</a></li>
<? if(!empty($_G['setting']['plugins']['spacecp'])) { if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<? if($_G['gp_id'] == $id) { ?> class="a"<? } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?=$id?>"><?=$module['name']?></a></li><? } } } ?>
</ul>
</div></div>
<? } ?>
</div>﻿</div>
<div class="clear"></div>
<div id="footer_bg">
  <div id="footer">
    <div class="footer_logo"></div>
    <div class="footer_txt"> <a target="_blank" href="<?=WWW_URL?>about/about.shtml">关于火秀</a> | <a target="_blank" href="<?=WWW_URL?>about/advertising.shtml">广告服务</a> | <a target="_blank" href="<?=WWW_URL?>about/contact.shtml">联系我们</a> |  <a target="_blank" href="<?=WWW_URL?>about/partners.shtml">合作伙伴</a> | <a target="_blank" href="<?=WWW_URL?>about/joinus.shtml">诚聘英才</a>
      <p>www.huoshow.com 版权所有 粤ICP备06087881号</p>
    </div>
  </div>
</div>
<script>
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-19568132-1']);
  _gaq.push(['_addOrganic', 'baidu', 'word']);
  _gaq.push(['_addOrganic', 'soso', 'w']);
  _gaq.push(['_addOrganic', '3721', 'name']);
  _gaq.push(['_addOrganic', 'yodao', 'q']);
  _gaq.push(['_addOrganic', 'vnet', 'kw']);
  _gaq.push(['_addOrganic', 'sogou', 'query']);
  _gaq.push(['_addIgnoredOrganic', '火秀']);
  _gaq.push(['_addIgnoredOrganic', '火秀网']);
  _gaq.push(['_addIgnoredOrganic', 'huoshow']);
  _gaq.push(['_addIgnoredOrganic', 'www.huoshow.com']);
  _gaq.push(['_setDomainName', '.huoshow.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F0995e0e09b1668037f4dcf601d094e68' type='text/javascript'%3E%3C/script%3E"));
</script>
<span style="display:none;"><script src="http://s16.cnzz.com/stat.php?id=2692090&web_id=2692090" type="text/javascript"></script></span>

</body><?php output(); ?></html>

