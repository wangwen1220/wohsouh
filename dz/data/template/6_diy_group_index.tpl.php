<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('index');
0
|| checktplrefresh('data/diy/group/index.htm', './template/huoshow/common/header.htm', 1332813960, 'diy', './data/template/6_diy_group_index.tpl.php', 'data/diy', 'group/index')
|| checktplrefresh('data/diy/group/index.htm', './template/huoshow/common/footer.htm', 1332813960, 'diy', './data/template/6_diy_group_index.tpl.php', 'data/diy', 'group/index')
;
block_get('1,2');?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><? if($liveSeoTitle) { ?><?=$liveSeoTitle?><? } else { if(!empty($navtitle)) { ?><?=$navtitle?>_<? } if(empty($nobbname1)) { ?><?=$_G['setting']['bbname']?><? } } ?></title>
    <?=$_G['setting']['seohead']?> 
    <meta name="keywords" content="<? if(!empty($metakeywords)) { echo htmlspecialchars($metakeywords); } ?>" />
    <meta name="description" content="<? if(!empty($metadescription)) { echo htmlspecialchars($metadescription); ?> <? } ?>,<?=$_G['setting']['bbname']?>" />
    <base href="<?=$_G['siteurl']?>" />              
    <link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_common.css?<?=VERHASH?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_group_index.css?<?=VERHASH?>" /><? if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['cookie']['extstyle']?>/style.css" /><? } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['style']['defaultextstyle']?>/style.css" /><? } ?>    <link href="<?=WWW_URL?>img/templates/huoshow02/css/global.css" rel="stylesheet" type="text/css" />
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
            </div>
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
<a href="./" class="nvhm" title="首页"><?=$_G['setting']['bbname']?></a><em>&rsaquo;</em><a href="group.php"><?=$_G['setting']['navs']['3']['navname']?></a><? if($groupnav) { ?><?=$groupnav?><? } elseif($action == 'create') { ?><em>&rsaquo;</em>创建<?=$_G['setting']['navs']['3']['navname']?><? } ?>
</div>
    </div><?php echo adshow("text/wp a_t"); ?><style id="diy_style" type="text/css">#portal_block_1 .content {margin-left:0px !important;}#portal_block_2 .content {margin-left:10px !important;font-size:14px !important;}</style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>
<div id="ct" class="ct2 wp cl">
<div class="mn">
<!--[diy=diycontenttop]--><div id="diycontenttop" class="area"></div><!--[/diy]-->
<div class="bm bmw">
<div class="bm_h cl">
<span class="y xw1"><a href="group.php?mod=my">我的<?=$_G['setting']['navs']['3']['navname']?> &rsaquo;</a></span>
<h2><?=$_G['setting']['navs']['3']['navname']?>焦点</h2>
</div>
<!--[diy=diy5]--><div id="diy5" class="area"><div id="framesvGJIM" class="frame move-span cl frame-1-1"><div id="framesvGJIM_left" class="column frame-1-1-l"><div id="framesvGJIM_left_temp" class="move-span temp"></div><?php block_display('1'); ?></div><div id="framesvGJIM_center" class="column frame-1-1-r"><div id="framesvGJIM_center_temp" class="move-span temp"></div><?php block_display('2'); ?></div></div></div><!--[/diy]-->
</div>
<!--[diy=diycommendtop]--><div id="diycommendtop" class="area"></div><!--[/diy]-->
<?php if(!empty($_G['setting']['pluginhooks']['index_header'])) echo $_G['setting']['pluginhooks']['index_header']; ?>
<div id="g_commend" class="bm">
<div class="bm_h cl">
<h2>推荐<?=$_G['setting']['navs']['3']['navname']?></h2>
</div>
<div class="bm_c cl"><? if(is_array(unserialize($_G['setting']['group_recommend']))) foreach(unserialize($_G['setting']['group_recommend']) as $val) { ?><dl class="xld">
<dd class="m"><a href="forum.php?mod=group&amp;fid=<?=$val['fid']?>"><img src="<?=$val['icon']?>" alt="<?=$val['name']?>" width="48" height="48" /></a></dd>
<dt><a href="forum.php?mod=group&amp;fid=<?=$val['fid']?>"><?=$val['name']?></a></dt>
<dd class="xg1"><?=$val['description']?></dd>
</dl>
<? } ?>
</div>
</div>

<!--[diy=diycategorytop]--><div id="diycategorytop" class="area"></div><!--[/diy]-->
<?php if(!empty($_G['setting']['pluginhooks']['index_top'])) echo $_G['setting']['pluginhooks']['index_top']; ?>
<div class="bm">
<div class="bm_h cl">
<h2><?=$_G['setting']['navs']['3']['navname']?>分类</h2>
</div>
<div class="bm_c"><? if(is_array($first)) foreach($first as $groupid => $group) { if($group['secondlist']) { ?>
<dl class="mbm pbm bbda">
<dt class="pbn">
<span class="y xi2"><? if(is_array($group['secondlist'])) foreach($group['secondlist'] as $fid) { ?><a href="group.php?sgid=<?=$fid?>"><?=$second[$fid]['name']?></a> <? } ?><a href="group.php?gid=<?=$groupid?>">更多 &rsaquo;</a></span>
<strong class="xs2"><a href="group.php?gid=<?=$groupid?>"><?=$group['name']?></a></strong><? if($group['groupnum']) { ?><span class="xg1">(<?=$group['groupnum']?>)</span><? } ?>
</dt>
<dd><? if(is_array($lastupdategroup[$groupid])) foreach($lastupdategroup[$groupid] as $val) { ?><a href="forum.php?mod=group&amp;fid=<?=$val['fid']?>"><?=$val['name']?></a> &nbsp;&nbsp;
<? } ?>
</dd>
</dl>
<? } } ?>
</div>
</div>
<!--[diy=diycontentbottom]--><div id="diycontentbottom" class="area"></div><!--[/diy]-->
<?php if(!empty($_G['setting']['pluginhooks']['index_bottom'])) echo $_G['setting']['pluginhooks']['index_bottom']; ?>
</div>

<div class="sd">
<div class="drag">
<!--[diy=diysidetop]--><div id="diysidetop" class="area"></div><!--[/diy]-->
</div>
<?php if(!empty($_G['setting']['pluginhooks']['index_side_top'])) echo $_G['setting']['pluginhooks']['index_side_top']; if(empty($gid) && empty($sgid)) { ?>
<div class="bm">
<div class="bm_h cl">
<h2>创建<?=$_G['setting']['navs']['3']['navname']?>步骤</h2>
</div>
<div class="bm_c">
<ul id="g_guide" class="mbm">
<li><label><strong class="xi1">创建<?=$_G['setting']['navs']['3']['navname']?></strong><span class="xg1">创建自己的地盘</span></label></li>
<li><label><strong class="xi1">个性设置</strong><span class="xg1">精心打造<?=$_G['setting']['navs']['3']['navname']?>空间</span></label></li>
<li><label><strong class="xi1">邀请好友</strong><span class="xg1">邀请好友加入我的<?=$_G['setting']['navs']['3']['navname']?></span></label></li>
<li><label><strong class="xi1"><?=$_G['setting']['navs']['3']['navname']?>升级</strong><span class="xg1"><?=$_G['setting']['navs']['3']['navname']?>积分升级赢得社区推荐</span></label></li>
</ul>
<a href="forum.php?mod=group&amp;action=create" id="create_group_btn"><img src="<?=IMGDIR?>/create_group.png" alt="创建<?=$_G['setting']['navs']['3']['navname']?>" /></a>
</div>
</div>
<? } else { ?>
<div class="bm bw0">
<div class="bm_c">
<a href="forum.php?mod=group&amp;action=create&amp;fupid=<?=$fup?>&amp;groupid=<?=$sgid?>" id="create_group_btn"><img src="<?=IMGDIR?>/create_group.png" alt="创建<?=$_G['setting']['navs']['3']['navname']?>" /></a>
</div>
</div>
<? } ?>
<div class="drag">
<!--[diy=diysidemiddle]--><div id="diysidemiddle" class="area"></div><!--[/diy]-->
</div>
<? if($topgrouplist) { ?>
<div id="g_top" class="bm">
<div class="bm_h cl">
<h2><?=$_G['setting']['navs']['3']['navname']?>积分排行</h2>
</div>
<div class="bm_c">
<ol class="xl"><? if(is_array($topgrouplist)) foreach($topgrouplist as $fid => $group) { ?><li class="top1"><span class="y xi2 xg1"> <?=$group['commoncredits']?></span><a href="forum.php?mod=group&amp;fid=<?=$group['fid']?>" title="<?=$group['name']?>"><?=$group['name']?></a></li>
<? } ?>
</ol>
</div>
</div>
<? } ?>
<div class="drag">
<!--[diy=diysidebottom]--><div id="diysidebottom" class="area"></div><!--[/diy]-->
</div>
<?php if(!empty($_G['setting']['pluginhooks']['index_side_bottom'])) echo $_G['setting']['pluginhooks']['index_side_bottom']; ?>
</div>
</div>

<div class="wp mtn">
<!--[diy=diy4]--><div id="diy4" class="area"></div><!--[/diy]-->
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
<span style="display:none;"><script src="http://s16.cnzz.com/stat.php?id=2692090&web_id=2692090" type="text/javascript"></script></span>

</body><?php output(); ?></html>

