<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_home');
0
|| checktplrefresh('./template/huoshow/home/space_home.htm', './template/huoshow/common/header.htm', 1361062638, 'diy', './data/template/6_diy_home_space_home.tpl.php', './template/huoshow', 'home/space_home')
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
<base href="<?=$_G['siteurl']?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_common.css?<?=VERHASH?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_home_space.css?<?=VERHASH?>" /><? if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['cookie']['extstyle']?>/style.css" /><? } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['style']['defaultextstyle']?>/style.css" /><? } ?><link href="<?=WWW_URL?>img/templates/huoshow02/css/global.css" rel="stylesheet" type="text/css" />
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

<? if(defined('CURMODULE') && ($_G['basescript'] == 'forum' || $_G['basescript'] == 'group') && (CURMODULE == 'index' || CURMODULE == 'forumdisplay' || CURMODULE == 'group')) { ?><?=$rsshead?><? } if($_G['basescript'] == 'forum') { if(!empty($_G['cookie']['widthauto']) && empty($_G['disabledwidthauto'])) { ?>
<link rel="stylesheet" id="css_widthauto" type="text/css" href="data/cache/style_<?=STYLEID?>_widthauto.css?<?=VERHASH?>" />
<script>HTMLNODE.className += ' widthauto'</script>
<? } ?>
<script src="<?=$_G['setting']['jspath']?>forum.js?<?=VERHASH?>" type="text/javascript"></script>
<? } elseif($_G['basescript'] == 'home' || $_G['basescript'] == 'userapp') { ?>
<script src="<?=$_G['setting']['jspath']?>home.js?<?=VERHASH?>" type="text/javascript"></script>
<? } elseif($_G['basescript'] == 'portal') { ?>
<script src="<?=$_G['setting']['jspath']?>portal.js?<?=VERHASH?>" type="text/javascript"></script>
<? } if($_G['basescript'] != 'portal' && $_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?>
<script src="<?=$_G['setting']['jspath']?>portal.js?<?=VERHASH?>" type="text/javascript"></script>
<? } if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?>
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
<div class="common" style='display:block'> <a target="_blank" href="http://www.huoshow.com/">首页</a>-<a target="_blank" href="http://www.huoshow.com/events/">赛事</a>-<a target="_blank" href="http://www.huoshow.com/star/">明星</a>-<a target="_blank" href="http://www.huoshow.com/movie/">电影</a>-<a target="_blank" href="http://www.huoshow.com/music/">音乐</a>-<a target="_blank" href="http://www.huoshow.com/supermodel/">超模</a>-<a target="_blank" href="http://www.huoshow.com/game/">游戏</a>-<a target="_blank" href="http://www.huoshow.com/pic/">美图</a>-<a target="_blank" href="http://www.huoshow.com/tv/">电视</a>-<a target="_blank" href="http://space.huoshow.com/home.php?mod=space&amp;do=myshow&amp;view=all">My秀</a>-<a target="_blank" href="http://space.huoshow.com/group.php">群组</a>-<a target="_blank" href="http://myshow.huoshow.com/">我秀</a><?php require_once(DISCUZ_ROOT."huoshow/module/commom/test_switch.php"); ?></div>
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
<li><a target="_blank" href="http://www.huoshow.com/">首页</a></li>
<li><a target="_blank" href="http://www.huoshow.com/events/">赛事</a></li>
<li><a target="_blank" href="http://www.huoshow.com/star/">明星</a></li>
<li><a target="_blank" href="http://www.huoshow.com/movie/">电影</a></li>
<li><a target="_blank" href="http://www.huoshow.com/music/">音乐</a></li>
<li><a target="_blank" href="http://www.huoshow.com/supermodel/">超模</a></li>
<li><a target="_blank" href="http://www.huoshow.com/game/">游戏</a></li>
<li><a target="_blank" href="http://www.huoshow.com/pic/">美图</a></li>
<li><a target="_blank" href="http://www.huoshow.com/tv/">电视</a></li>
<li><a target="_blank" href="http://space.huoshow.com/home.php?mod=space&amp;do=myshow&amp;view=all">My秀</a></li>
<li><a target="_blank" href="http://space.huoshow.com/group.php">群组</a></li>
<li><a target="_blank" href="http://myshow.huoshow.com/">我秀</a></li>
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
<a href="./" class="nvhm" title="首页"><?=$_G['setting']['bbname']?></a>
<em>&rsaquo;</em> <a href="home.php"><?=$_G['setting']['navs']['4']['navname']?></a>
</div>
</div>


<style id="diy_style" type="text/css"></style>

<div id="ct" class="ct3_a wp cl">
<div class="appl"><? include template('common/userabout'); ?></div>
<div class="mn" style="float:left;margin-left:5px;"><?php require_once(DISCUZ_ROOT."huoshow/module/home/home_weibo_all_sys_dynamic.php"); ?></div>
<div style="float:right;width:245px;" > 
<!-- 可能感兴趣的人 --><?php require_once(DISCUZ_ROOT."huoshow/module/home/home_weibo_recommend.php"); ?><!-- 人气用户推荐 --><?php require_once(DISCUZ_ROOT."huoshow/module/home/home_weibo_hotrecommend.php"); ?></div>
</div><? include template('common/footer'); ?>