<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('viewthread');
0
|| checktplrefresh('./template/huoshow/forum/viewthread.htm', './template/huoshow/common/header.htm', 1348645370, 'diy', './data/template/6_diy_forum_viewthread.tpl.php', './template/huoshow', 'forum/viewthread')
|| checktplrefresh('./template/huoshow/forum/viewthread.htm', './template/huoshow/forum/viewthread_node.htm', 1348645370, 'diy', './data/template/6_diy_forum_viewthread.tpl.php', './template/huoshow', 'forum/viewthread')
|| checktplrefresh('./template/huoshow/forum/viewthread.htm', './template/huoshow/forum/viewthread_fastpost.htm', 1348645370, 'diy', './data/template/6_diy_forum_viewthread.tpl.php', './template/huoshow', 'forum/viewthread')
|| checktplrefresh('./template/huoshow/forum/viewthread.htm', './template/huoshow/common/footer.htm', 1348645370, 'diy', './data/template/6_diy_forum_viewthread.tpl.php', './template/huoshow', 'forum/viewthread')
|| checktplrefresh('./template/huoshow/forum/viewthread.htm', './template/huoshow/forum/viewthread_node_body.htm', 1348645370, 'diy', './data/template/6_diy_forum_viewthread.tpl.php', './template/huoshow', 'forum/viewthread')
|| checktplrefresh('./template/huoshow/forum/viewthread.htm', './template/huoshow/common/seditor.htm', 1348645370, 'diy', './data/template/6_diy_forum_viewthread.tpl.php', './template/huoshow', 'forum/viewthread')
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
    <link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_common.css?<?=VERHASH?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_forum_viewthread.css?<?=VERHASH?>" /><? if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['cookie']['extstyle']?>/style.css" /><? } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['style']['defaultextstyle']?>/style.css" /><? } ?>    <link href="<?=WWW_URL?>img/templates/huoshow02/css/global.css" rel="stylesheet" type="text/css" />
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
<script type="text/javascript">var fid = parseInt('<?=$_G['fid']?>'), tid = parseInt('<?=$_G['tid']?>');</script>
<? if($modmenu['thread'] || $modmenu['post']) { ?>
<script src="<?=$_G['setting']['jspath']?>forum_moderate.js?<?=VERHASH?>" type="text/javascript"></script>
<? } ?>

<script src="<?=$_G['setting']['jspath']?>forum_viewthread.js?<?=VERHASH?>" type="text/javascript"></script>
<script type="text/javascript">zoomstatus = parseInt(<?=$_G['setting']['zoomstatus']?>);var imagemaxwidth = '<?=IMAGEMAXWIDTH?>';var aimgcount = new Array();</script>

<div id="pt" class="bm cl"><!-- common/simplesearchform --><div class="z">
<a href="./" id="fjump"<? if($_G['setting']['forumjump'] == 1) { ?> onmouseover="showMenu({'ctrlid':this.id})"<? } ?> class="nvhm" title="首页"><?=$_G['setting']['bbname']?></a><?=$navigation?> <em>&rsaquo;</em> <?=$_G['forum_thread']['short_subject']?>
</div>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_top'])) echo $_G['setting']['pluginhooks']['viewthread_top']; ?><?php echo adshow("text/wp a_t"); ?><style id="diy_style" type="text/css"></style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>

<div id="ct" class="wp cl">
<div id="pgt" class="pgs mbm cl">
<div class="pgt"><?=$multipage?></div>
<span class="y pgb"<? if($_G['setting']['visitedforums']) { ?> id="visitedforums" onmouseover="$('visitedforums').id = 'visitedforumstmp';this.id = 'visitedforums';showMenu({'ctrlid':this.id,'pos':'34'})"<? } ?>><a href="<?=$upnavlink?>">返回列表</a></span>
<? if($_G['forum']['threadsorts'] && $_G['forum']['threadsorts']['templatelist']) { if(is_array($_G['forum']['threadsorts']['types'])) foreach($_G['forum']['threadsorts']['types'] as $id => $name) { ?><button id="newspecial" class="pn pnc" onclick="location.href='forum.php?mod=post&action=newthread&fid=<?=$_G['fid']?>&extra=<?=$extra?>&sortid=<?=$id?>'"><strong>我要<?=$name?></strong></button>
<? } } else { if(!$_G['forum_thread']['is_archived']) { ?><a id="newspecial" onmouseover="$('newspecial').id = 'newspecialtmp';this.id = 'newspecial';showMenu({'ctrlid':this.id})"<? if(!$_G['forum']['allowspecialonly']) { ?> onclick="showWindow('newthread', 'forum.php?mod=post&action=newthread&fid=<?=$_G['fid']?>')"<? } else { ?> onclick="location.href='forum.php?mod=post&action=newthread&fid=<?=$_G['fid']?>'"<? } ?> href="javascript:;" title="发新帖"><img src="<?=IMGDIR?>/pn_post.png" alt="发新帖" /></a><? } } if($allowpostreply && !$_G['forum_thread']['archiveid']) { ?>
<a id="post_reply" onclick="showWindow('reply', 'forum.php?mod=post&action=reply&fid=<?=$_G['fid']?>&tid=<?=$_G['tid']?>')" href="javascript:;" title="回复"><img src="<?=IMGDIR?>/pn_reply.png" alt="回复" /></a>
<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postbutton_top'])) echo $_G['setting']['pluginhooks']['viewthread_postbutton_top']; ?>
</div>

<? if($_G['group']['allowpost'] && ($_G['group']['allowposttrade'] || $_G['group']['allowpostpoll'] || $_G['group']['allowpostreward'] || $_G['group']['allowpostactivity'] || $_G['group']['allowpostdebate'] || $_G['setting']['threadplugins'] || $_G['forum']['threadsorts'])) { ?>
<ul class="p_pop" id="newspecial_menu" style="display: none">
<? if(!$_G['forum']['allowspecialonly']) { ?><li><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?=$_G['fid']?>">发表帖子</a></li><? } if($_G['group']['allowpostpoll']) { ?><li class="poll"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?=$_G['fid']?>&amp;special=1">发起投票</a></li><? } if($_G['group']['allowpostreward']) { ?><li class="reward"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?=$_G['fid']?>&amp;special=3">发布悬赏</a></li><? } if($_G['group']['allowpostdebate']) { ?><li class="debate"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?=$_G['fid']?>&amp;special=5">发起辩论</a></li><? } if($_G['group']['allowpostactivity']) { ?><li class="activity"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?=$_G['fid']?>&amp;special=4">发起活动</a></li><? } if($_G['group']['allowposttrade']) { ?><li class="trade"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?=$_G['fid']?>&amp;special=2">出售商品</a></li><? } if($_G['setting']['threadplugins']) { if(is_array($_G['forum']['threadplugin'])) foreach($_G['forum']['threadplugin'] as $tpid) { if(array_key_exists($tpid, $_G['setting']['threadplugins']) && @in_array($tpid, $_G['group']['allowthreadplugin'])) { ?>
<li class="popupmenu_option"<? if($_G['setting']['threadplugins'][$tpid]['icon']) { ?> style="background-image:url(<?=$_G['setting']['threadplugins'][$tpid]['icon']?>)"<? } ?>><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?=$_G['fid']?>&amp;specialextra=<?=$tpid?>"><?=$_G['setting']['threadplugins'][$tpid]['name']?></a></li>
<? } } } if($_G['forum']['threadsorts'] && !$_G['forum']['allowspecialonly']) { if(is_array($_G['forum']['threadsorts']['types'])) foreach($_G['forum']['threadsorts']['types'] as $id => $threadsorts) { if($_G['forum']['threadsorts']['show'][$id]) { ?>
<li class="popupmenu_option"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?=$_G['fid']?>&amp;extra=<?=$_G['gp_extra']?>&amp;sortid=<?=$id?>"><?=$threadsorts?></a></li>
<? } } } ?>
</ul>
<? } if($modmenu['post']) { ?>
<div id="mdly" class="fwinmask" style="display:none;">
<table cellspacing="0" cellpadding="0" class="fwin">
<tr>
<td class="t_l"></td>
<td class="t_c"></td>
<td class="t_r"></td>
</tr>
<tr>
<td class="m_l">&nbsp;</td>
<td class="m_c">
<div class="f_c">
<div class="c">
<h3>选中&nbsp;<strong id="mdct" class="xi1"></strong>&nbsp;篇: </h3>
<? if($_G['forum']['ismoderator']) { if($_G['group']['allowwarnpost']) { ?><a href="javascript:;" onclick="modaction('warn')">警告</a><span class="pipe">|</span><? } if($_G['group']['allowbanpost']) { ?><a href="javascript:;" onclick="modaction('banpost')">屏蔽</a><span class="pipe">|</span><? } if($_G['group']['allowdelpost']) { ?><a href="javascript:;" onclick="modaction('delpost')">删除</a><span class="pipe">|</span><? } if($_G['group']['allowstickreply']) { ?><a href="javascript:;" onclick="modaction('stickreply')">置顶</a><span class="pipe">|</span><? } } if($_G['forum_thread']['pushedaid'] && $allowpostarticle) { ?><a href="javascript:;" onclick="modaction('pushplus', '', 'aid=<?=$_G['forum_thread']['pushedaid']?>', 'portal.php?mod=portalcp&ac=article&op=pushplus')">文章连载</a><span class="pipe">|</span><? } ?>
</div>
</div>
</td>
<td class="m_r"></td>
</tr>
<tr>
<td class="b_l"></td>
<td class="b_c"></td>
<td class="b_r"></td>
</tr>
</table>
</div>
<? } if($modmenu['thread']) { ?>
<div id="modmenu" class="xi2"><?php $modopt=0; if($_G['forum']['ismoderator']) { if($_G['group']['allowdelpost']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modthreads(3, 'delete')">删除</a><span class="pipe">|</span><? } if($_G['group']['allowbumpthread'] && !$_G['forum_thread']['is_archived']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modthreads(3, 'down')">升降</a><span class="pipe">|</span><? } if($_G['group']['allowstickthread'] && ($_G['forum_thread']['displayorder'] <= 3 || $_G['adminid'] == 1) && !$_G['forum_thread']['is_archived']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modthreads(1, 'stick')">置顶</a><span class="pipe">|</span><? } if($_G['group']['allowhighlightthread'] && !$_G['forum_thread']['is_archived']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modthreads(1, 'highlight')">高亮</a><span class="pipe">|</span><? } if($_G['group']['allowdigestthread'] && !$_G['forum_thread']['is_archived']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modthreads(1, 'digest')">精华</a><span class="pipe">|</span><? } if($_G['group']['allowrecommendthread'] && !empty($_G['forum']['modrecommend']['open']) && $_G['forum']['modrecommend']['sort'] != 1 && !$_G['forum_thread']['is_archived']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modthreads(1, 'recommend')">推荐</a><span class="pipe">|</span><? } if($_G['group']['allowstampthread'] && !$_G['forum_thread']['is_archived']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('stamp')">图章</a><span class="pipe">|</span><? } if($_G['group']['allowstamplist'] && !$_G['forum_thread']['is_archived']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('stamplist')">图标</a><span class="pipe">|</span><? } if($_G['group']['allowclosethread'] && !$_G['forum_thread']['is_archived'] && $_G['forum']['status'] != 3) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modthreads(4)"><? if(!$_G['forum_thread']['closed']) { ?>关闭<? } else { ?>打开<? } ?></a><span class="pipe">|</span><? } if($_G['group']['allowmovethread'] && !$_G['forum_thread']['is_archived'] && $_G['forum']['status'] != 3) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modthreads(2, 'move')">移动</a><span class="pipe">|</span><? } if($_G['group']['allowedittypethread'] && !$_G['forum_thread']['is_archived']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modthreads(2, 'type')">分类</a><span class="pipe">|</span><? } if(!$_G['forum_thread']['special'] && !$_G['forum_thread']['is_archived']) { if($_G['group']['allowcopythread'] && $_G['forum']['status'] != 3) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('copy')">复制</a><span class="pipe">|</span><? } if($_G['group']['allowmergethread'] && $_G['forum']['status'] != 3) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('merge')">合并</a><span class="pipe">|</span><? } if($_G['group']['allowrefund'] && $_G['forum_thread']['price'] > 0) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('refund')">撤销付费</a><span class="pipe">|</span><? } } if($_G['group']['allowsplitthread'] && !$_G['forum_thread']['is_archived'] && $_G['forum']['status'] != 3) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('split')">分割</a><span class="pipe">|</span><? } if($_G['group']['allowrepairthread'] && !$_G['forum_thread']['is_archived']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('repair')">修复</a><span class="pipe">|</span><? } if($_G['forum_thread']['is_archived'] && $_G['adminid'] == 1) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('restore', '', 'archiveid=<?=$_G['forum_thread']['archiveid']?>')">取消存档</a><span class="pipe">|</span><? } if($_G['forum_firstpid']) { if($_G['group']['allowwarnpost']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('warn', '<?=$_G['forum_firstpid']?>')">警告</a><span class="pipe">|</span><? } if($_G['group']['allowbanpost']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('banpost', '<?=$_G['forum_firstpid']?>')">屏蔽</a><span class="pipe">|</span><? } } if($_G['group']['allowremovereward'] && $_G['forum_thread']['special'] == 3 && !$_G['forum_thread']['is_archived']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('removereward')">移除悬赏</a><span class="pipe">|</span><? } if($_G['forum']['status'] == 3 && in_array($_G['adminid'], array('1','2')) && $_G['forum_thread']['closed'] < 1) { ?><a href="javascript:;" onclick="modthreads(5, 'recommend_group');return false;">推到版块</a><span class="pipe">|</span><? } } if($allowblockrecommend) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('recommend', '<?=$_G['forum_firstpid']?>', 'op=recommend&idtype=<? if($_G['forum_thread']['isgroup']) { ?>gtid<? } else { ?>tid<? } ?>&id=<?=$_G['tid']?>', 'portal.php?mod=portalcp&ac=portalblock')">推送</a><span class="pipe">|</span><? } if($allowpusharticle && $allowpostarticle) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('push', '<?=$_G['forum_firstpid']?>', 'op=push&idtype=tid&id=<?=$_G['tid']?>', 'portal.php?mod=portalcp&ac=index')">生成文章</a><span class="pipe">|</span><? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_modoption'])) echo $_G['setting']['pluginhooks']['viewthread_modoption']; ?>
</div>
<? } ?>

<div id="postlist" class="pl bm bmw">
<table cellspacing="0" cellpadding="0" class="plh">
<tr>
<td class="pls">
<? if($_G['page'] > 1) { ?>
<div id="tath" class="cl">
<? if($_G['forum_thread']['authorid'] && $_G['forum_thread']['author']) { ?>
<a href="<?=DX_URL?><?=$_G['forum_thread']['authorid']?>" title="<?=$_G['forum_thread']['author']?>"><?php echo avatar($_G[forum_thread][authorid],small); ?></a>
楼主: <a href="<?=DX_URL?><?=$_G['forum_thread']['authorid']?>" title="<?=$_G['forum_thread']['author']?>"><?=$_G['forum_thread']['author']?></a>
<? } else { ?>
楼主:
<? if($_G['forum']['ismoderator']) { ?>
<a href="<?=DX_URL?><?=$_G['forum_thread']['authorid']?>">匿名</a>
<? } else { ?>
匿名
<? } } ?>
</div>
<? } else { ?>
<div class="hm">
<span class="xg1">查看:</span> <?=$_G['forum_thread']['views']?><span class="pipe">|</span><span class="xg1">回复:</span> <?=$_G['forum_thread']['replies']?>
</div>
<? } ?>
</td>
<td class="plc">
<? if(!$postcount && !$_G['forum_thread']['archiveid']) { ?>
<a id="jfl_link" href="javascript:;" title="跳转到指定楼层">go</a>
<input type="text" class="jfl_px" size="1" onkeyup="$('jfl_link').href='forum.php?mod=redirect&ptid=<?=$_G['tid']?>&authorid=<?=$_G['gp_authorid']?>&postno='+this.value" onkeydown="if(event.keyCode==13) {window.location=$('jfl_link').href;return false;}" />
<? } ?>
<h1 class="ts">
<? if($_G['forum_thread']['typeid'] && $_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']]) { if(!IS_ROBOT && ($_G['forum']['threadtypes']['listable'] || $_G['forum']['status'] == 3)) { ?>
<a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;filter=typeid&amp;typeid=<?=$_G['forum_thread']['typeid']?>">[<?=$_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']]?>]</a>
<? } else { ?>
[<?=$_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']]?>]
<? } } if($threadsorts && $_G['forum_thread']['sortid']) { ?>
<a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;filter=sortid&amp;sortid=<?=$_G['forum_thread']['sortid']?>">[<?=$_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']]?>]</a>
<? } ?>
<a href="forum.php?mod=viewthread&amp;tid=<?=$_G['tid']?>&amp;extra=<?=$_G['gp_extra']?>" id="thread_subject"><?=$_G['forum_thread']['subject']?></a>
<? if($_G['forum_thread']['displayorder'] == -2) { ?> <span class="xg1">(审核中)</span>
<? } elseif($_G['forum_thread']['displayorder'] == -3) { ?> <span class="xg1">(已忽略)</span>
<? } elseif($_G['forum_thread']['displayorder'] == -4) { ?> <span class="xg1">(草稿)</span>
<? } if($_G['forum_thread']['recommendlevel']) { ?>
&nbsp;<img src="<?=IMGDIR?>/recommend_<?=$_G['forum_thread']['recommendlevel']?>.gif" alt="" title="评价指数 <?=$_G['forum_thread']['recommends']?>" />
<? } if($_G['forum_thread']['heatlevel']) { ?>
&nbsp;<img src="<?=IMGDIR?>/hot_<?=$_G['forum_thread']['heatlevel']?>.gif" alt="" title="<?=$_G['forum_thread']['heatlevel']?> 级热门" />
<? } if(!IS_ROBOT) { ?>
<!--<a href="javascript:;" class="xg1 xs0 xw0" title="复制本帖链接" onclick="setCopy('\r\n<?=$_G['siteurl']?>forum.php?mod=viewthread&tid=<?=$_G['tid']?>\r\n', '帖子地址已经复制到剪贴板');return false;">[复制链接]</a>-->
<!--<a href="<?=$_G['siteurl']?>forum.php?mod=viewthread&tid=<?=$_G['tid']?>" class="xg1 xs0 xw0" title="复制本帖链接" onclick="return copyThreadUrl(this)">[复制链接]</a>-->
<a href="<?=$_G['siteurl']?>forum.php?mod=viewthread&tid=<?=$_G['tid']?>" class="xg1 xs0 xw0" title="复制本帖链接" onclick="setCopy(this.href , '帖子地址已经复制到剪贴板');return false;">[复制链接]</a>
<? } ?>
</h1>
</td>
</tr>
<tr class="ad">
<td class="pls"></td>
<td class="plc"></td>
</tr>
</table><?php $postcount = 0; if(is_array($postlist)) foreach($postlist as $post) { ?><div id="post_<?=$post['pid']?>"><?php $needhiddenreply = ($hiddenreplies && $_G['uid'] != $post['authorid'] && $_G['uid'] != $_G['forum_thread']['authorid'] && !$post['first'] && !$_G['forum']['ismoderator']); ?><?
$authorverifys = <<<EOF


EOF;
 if($_G['setting']['verify']['enabled']) { if(is_array($_G['setting']['verify'])) foreach($_G['setting']['verify'] as $vid => $verify) { if($verify['available'] && $post['verify'.$vid] == 1) { 
$authorverifys .= <<<EOF

<a href="home.php?mod=spacecp&amp;ac=profile&amp;op=verify&amp;vid={$vid}" target="_blank">
EOF;
 if($verify['icon']) { 
$authorverifys .= <<<EOF
<img src="{$verify['icon']}" class="vm" alt="{$verify['title']}" title="{$verify['title']}" />
EOF;
 } else { 
$authorverifys .= <<<EOF
{$verify['title']}
EOF;
 } 
$authorverifys .= <<<EOF
</a>&nbsp;

EOF;
 } } } 
$authorverifys .= <<<EOF


EOF;
?>
<table id="pid<?=$post['pid']?>" <? if($post['first']) { ?>class="fo"<? } ?> summary="pid<?=$post['pid']?>" cellspacing="0" cellpadding="0">
<tr>
<td class="pls" rowspan="2">

<? if($post['authorid'] && $post['username'] && !$post['anonymous']) { if($_G['setting']['authoronleft']) { ?>
<div class="pi">
<div class="authi"><a href="<?=DX_URL?><?=$post['authorid']?>" target="_blank" class="xw1"><?=$post['author']?></a><?=$authorverifys?></div>
</div>
<? } ?>
<div class="p_pop blk bui" id="userinfo<?=$post['pid']?>" style="display: none; <? if($_G['setting']['authoronleft']) { ?>margin-top: -11px;<? } ?>">
<div class="m z">
<div id="userinfo<?=$post['pid']?>_ma"></div>
<ul>
<li class="pm2"><a href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?=$post['authorid']?>&amp;touid=<?=$post['authorid']?>&amp;pmid=0&amp;daterange=2&amp;pid=<?=$post['pid']?>" onclick="hideMenu('userinfo<?=$post['pid']?>');showWindow('sendpm', this.href)" title="发短消息">发短消息</a></li>
<? if($post['authorid'] != $_G['uid']) { ?>
<li class="buddy"><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?=$post['authorid']?>&amp;handlekey=addfriendhk_<?=$post['authorid']?>" id="a_friend_li_<?=$post['pid']?>" onclick="showWindow(this.id, this.href, 'get', 1, {'ctrlid':this.id,'pos':'00'});">加为好友</a></li>
<? } ?>
</ul>
<? if($_G['setting']['magicstatus']) { if(!empty($_G['setting']['magics']['showip'])) { ?>
<img src="<?=STATICURL?>/image/magic/showip.small.gif" class="vm" /> <a href="home.php?mod=magic&amp;mid=showip&amp;idtype=user&amp;id=<? echo rawurlencode($post['author']); ?>" id="a_showip_li_<?=$post['pid']?>" onclick="showWindow(this.id, this.href)"><?=$_G['setting']['magics']['showip']?></a><br />
<? } if(!empty($_G['setting']['magics']['checkonline']) && $post['authorid'] != $_G['uid']) { ?>
<img src="<?=STATICURL?>/image/magic/checkonline.small.gif" class="vm" /> <a href="home.php?mod=magic&amp;mid=checkonline&amp;idtype=user&amp;id=<? echo rawurlencode($post['author']); ?>" id="a_repent_<?=$post['pid']?>" onclick="showWindow(this.id, this.href)"><?=$_G['setting']['magics']['checkonline']?></a><br />
<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_magic_user'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_magic_user'][$postcount]; } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_profileside'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_profileside'][$postcount]; ?>
</div>
<div class="i y">
<div>
<strong><a href="<?=DX_URL?><?=$post['authorid']?>" target="_blank"><?=$post['author']?></a></strong>
<? if($_G['setting']['vtonlinestatus'] && $post['authorid']) { if(($_G['setting']['vtonlinestatus'] == 2 && $_G['forum_onlineauthors'][$post['authorid']]) || ($_G['setting']['vtonlinestatus'] == 1 && (TIMESTAMP - $post['lastactivity'] <= 10800) && !$post['authorinvisible'])) { ?>
<em>当前在线
<? } else { ?>
<em>当前离线
<? } ?>
</em>
<? } ?>
</div>
<dl class="cl"><?php @eval('echo "'.$customauthorinfo[2].'";'); ?></dl>
<div class="imicn">
<? if($post['qq']) { ?><a href="http://wpa.qq.com/msgrd?V=1&amp;Uin=<?=$post['qq']?>&amp;Site=<?=$_G['setting']['bbname']?>&amp;Menu=yes" target="_blank" title="QQ"><img src="<?=IMGDIR?>/qq.gif" alt="QQ" /></a><? } if($post['icq']) { ?><a href="http://wwp.icq.com/scripts/search.dll?to=<?=$post['icq']?>" target="_blank" title="ICQ"><img src="<?=IMGDIR?>/icq.gif" alt="ICQ" /></a><? } if($post['yahoo']) { ?><a href="http://edit.yahoo.com/config/send_webmesg?.target=<?=$post['yahoo']?>&amp;.src=pg" target="_blank" title="Yahoo"><img src="<?=IMGDIR?>/yahoo.gif" alt="Yahoo!"  /></a><? } if($post['taobao']) { ?><a href="javascript:;" onclick="window.open('http://amos.im.alisoft.com/msg.aw?v=2&uid='+encodeURIComponent('<?=$post['taobaoas']?>')+'&site=cntaobao&s=2&charset=utf-8')" title="阿里旺旺"><img src="<?=IMGDIR?>/taobao.gif" alt="阿里旺旺" /></a><? } if($post['site']) { ?><a href="<?=$post['site']?>" target="_blank" title="查看个人网站"><img src="<?=IMGDIR?>/forumlink.gif" alt="查看个人网站"  /></a><? } ?>
<a href="home.php?mod=space&amp;uid=<?=$post['authorid']?>&amp;do=profile" target="_blank" title="查看详细资料"><img src="<?=IMGDIR?>/userinfo.gif" alt="查看详细资料"  /></a>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_imicons'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_imicons'][$postcount]; ?>
</div>
<div id="avatarfeed"><span id="threadsortswait"></span></div>
</div>
</div>
<? } if($post['authorid'] && $post['username'] && !$post['anonymous']) { ?>
<div>
<? if($_G['setting']['bannedmessages'] & 2 && (($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || ($post['status'] & 1))) { ?>
<div class="avatar">头像被屏蔽</div>
<? } elseif($post['avatar'] && $showavatars) { ?>
<div class="avatar" onmouseover="showauthor(this, 'userinfo<?=$post['pid']?>')"><a href="<?=DX_URL?><?=$post['authorid']?>" target="_blank"><?=$post['avatar']?></a></div>
<? } if($post['groupicon']) { ?><p><?=$post['groupicon']?></p><? } ?>
<p><em><a href="home.php?mod=spacecp&amp;ac=usergroup&amp;gid=<?=$post['groupid']?>" target="_blank"><?=$post['authortitle']?></a></em></p>
<? if($post['customstatus'] && $_G['group']['allowcstatus']) { ?><p class="xg1"><?=$post['customstatus']?></p><? } ?>
</div>
<p<? if($post['upgradecredit'] !== false) { ?> id="g_up<?=$post['pid']?>" onmouseover="showMenu({'ctrlid':this.id, 'pos':'12'});"<? } ?>><?php showstars($post['stars']); ?></p>
<? if($post['upgradecredit'] !== false) { ?>
<div id="g_up<?=$post['pid']?>_menu" class="g_up" style="display:none">
<div class="crly">
<?=$post['authortitle']?>, 积分 <?=$post['credits']?>, 距离下一级还需 <?=$post['upgradecredit']?> 积分
</div>
<div class="mncr"></div>
</div>
<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_sidetop'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_sidetop'][$postcount]; if($customauthorinfo['1']) { ?><dl class="pil cl"><?php @eval('echo "'.$customauthorinfo[1].'";'); ?></dl><? } if($post['medals']) { ?><p><? if(is_array($post['medals'])) foreach($post['medals'] as $medal) { ?><img src="<?=STATICURL?>image/common/<?=$medal['image']?>" alt="<?=$medal['name']?>" title="<?=$medal['name']?>" />
<? } ?></p>
<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_sidebottom'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_sidebottom'][$postcount]; } else { ?>
<div class="pi">
<? if(!$post['authorid']) { ?>
<a href="javascript:;">游客 <em><?=$post['useip']?></em></a>
<? } elseif($post['authorid'] && $post['username'] && $post['anonymous']) { if($_G['forum']['ismoderator']) { ?><a href="home.php?mod=space&amp;uid=<?=$post['authorid']?>" target="_blank">匿名</a><? } else { ?>匿名<? } } else { ?>
<?=$post['author']?> <em>该用户已被删除</em>
<? } ?>
</div>
<? } if($_G['group']['allowedituser'] || $_G['group']['allowbanuser'] || ($_G['forum']['ismoderator'] && $_G['group']['allowviewip'] && !$post['first'])) { ?>
<p>
<? if($_G['forum']['ismoderator'] && $_G['group']['allowviewip']) { ?>
<a href="forum.php?mod=topicadmin&amp;action=getip&amp;fid=<?=$_G['fid']?>&amp;tid=<?=$_G['tid']?>&amp;pid=<?=$post['pid']?>" onclick="ajaxmenu(this, 0, 0, 2);doane(event)">IP</a>&nbsp;
<? } if($_G['group']['allowedituser']) { ?>
<a href="<? if($_G['adminid'] == 1) { ?>admin.php?frames=yes&action=members&operation=search&uid=<?=$post['authorid']?>&submit=yes<? } else { ?>forum.php?mod=modcp&action=member&op=edit&uid=<?=$post['authorid']?><? } ?>" target="_blank">编辑</a>&nbsp;
<? } if($_G['group']['allowbanuser']) { if($_G['adminid'] == 1) { ?>
<a href="admin.php?action=members&amp;operation=ban&amp;username=<?=$post['usernameenc']?>&amp;frames=yes" target="_blank">禁止</a>&nbsp;
<? } else { ?>
<a href="forum.php?mod=modcp&amp;action=member&amp;op=ban&amp;uid=<?=$post['authorid']?>" target="_blank">禁止</a>&nbsp;
<? } } ?>
<a href="forum.php?mod=modcp&amp;action=thread&amp;op=post&amp;do=search&amp;searchsubmit=1&amp;users=<?=$post['usernameenc']?>" target="_blank">帖子</a>
</p>
<? } ?>
</td>
<td class="plc">
<? if($post['first']) { ?>
<div id="threadstamp"><? if($_G['forum_threadstamp']) { ?><img src="<?=STATICURL?>image/stamp/<?=$_G['forum_threadstamp']['url']?>" title="<?=$_G['forum_threadstamp']['text']?>" /><? } ?></div>
<? } ?>
<div class="pi">
<? if(!IS_ROBOT) { ?>
<strong>
<a href="<?=$_G['siteurl']?><? if($post['first']) { ?>forum.php?mod=viewthread&tid=<?=$_G['tid']?><?=$fromuid?><? } else { ?>forum.php?mod=redirect&goto=findpost&ptid=<?=$_G['tid']?>&pid=<?=$post['pid']?><?=$fromuid?><? } ?>" class="brm" title="复制本帖链接" id="postnum<?=$post['pid']?>" onclick="setCopy(this.href, '帖子地址已经复制到剪贴板');return false;"><? if(!empty($postno[$post['number']])) { ?><?=$postno[$post['number']]?><? } else { ?><em><?=$post['number']?></em><?=$postno['0']?><? } ?></a>
</strong>
<? } ?>
<div class="pti">
<div class="pdbt">
<? if(!$post['first'] && $_G['forum_thread']['special'] == 5) { ?>
<label class="pdbts pdbts_<? echo intval($post['stand']); ?>">
<? if($post['stand'] == 1) { ?><a class="v" href="forum.php?mod=viewthread&amp;tid=<?=$_G['tid']?>&amp;extra=<?=$_G['gp_extra']?>&amp;filter=debate&amp;stand=1" title="只看正方">正方</a>
<? } elseif($post['stand'] == 2) { ?><a class="v" href="forum.php?mod=viewthread&amp;tid=<?=$_G['tid']?>&amp;extra=<?=$_G['gp_extra']?>&amp;filter=debate&amp;stand=2" title="只看反方">反方</a>
<? } else { ?><a href="forum.php?mod=viewthread&amp;tid=<?=$_G['tid']?>&amp;extra=<?=$_G['gp_extra']?>&amp;filter=debate&amp;stand=0" title="只看中立">中立</a><? } if($post['stand']) { ?>
<a class="b" href="forum.php?mod=misc&amp;action=debatevote&amp;tid=<?=$_G['tid']?>&amp;pid=<?=$post['pid']?>" id="voterdebate_<?=$post['pid']?>" onclick="ajaxmenu(this);doane(event);">支持 <?=$post['voters']?></a>
<? } ?>
</label>
<? } ?>
</div>
<div class="authi">
<? if(!$post['anonymous'] && $_G['cache']['groupicon'][$post['groupid']]) { ?>
<img class="authicn vm" id="authicon<?=$post['pid']?>" src="<?=$_G['cache']['groupicon'][$post['groupid']]?>" />
<? } else { ?>
<img class="authicn vm" id="authicon<?=$post['pid']?>" src="<?=$_G['cache']['groupicon']['0']?>" />
<? } if($post['authorid'] && !$post['anonymous']) { if(!$_G['setting']['authoronleft']) { ?><a href="home.php?mod=space&amp;uid=<?=$post['authorid']?>" target="_blank" class="xi2"><?=$post['author']?></a><?=$authorverifys?><? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postheader'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postheader'][$postcount]; ?>
<em id="authorposton<?=$post['pid']?>">发表于 <?=$post['dateline']?></em>
<? if($post['invisible'] == 0) { if(!IS_ROBOT && !$_G['gp_authorid'] && !$_G['forum_thread']['archiveid']) { ?>
<span class="pipe">|</span><a href="forum.php?mod=viewthread&amp;tid=<?=$post['tid']?>&amp;page=<?=$page?>&amp;authorid=<?=$post['authorid']?>" rel="nofollow">只看该作者</a>
<? } elseif(!$_G['forum_thread']['archiveid']) { ?>
<span class="pipe">|</span><a href="forum.php?mod=viewthread&amp;tid=<?=$post['tid']?>&amp;page=<?=$page?>" rel="nofollow">显示全部帖子</a>
<? } } } elseif($post['authorid'] && $post['username'] && $post['anonymous']) { ?>
匿名
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postheader'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postheader'][$postcount]; ?>
<em id="authorposton<?=$post['pid']?>">发表于 <?=$post['dateline']?></em>
<? } elseif(!$post['authorid'] && !$post['username']) { ?>
游客
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postheader'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postheader'][$postcount]; ?>
<em id="authorposton<?=$post['pid']?>">发表于 <?=$post['dateline']?></em>
<? } if(!IS_ROBOT && $post['first'] && !$_G['forum_thread']['archiveid']) { if($ordertype != 1) { ?>
<span class="pipe">|</span><a href="forum.php?mod=viewthread&amp;tid=<?=$_G['tid']?>&amp;extra=<?=$_G['gp_extra']?>&amp;ordertype=1">倒序浏览</a>
<? } else { ?>
<span class="pipe">|</span><a href="forum.php?mod=viewthread&amp;tid=<?=$_G['tid']?>&amp;extra=<?=$_G['gp_extra']?>&amp;ordertype=2">正序浏览</a>
<? } if($post['invisible'] == 0) { ?>
<span class="pipe">|</span><a href="forum.php?mod=viewthread&amp;action=printable&amp;tid=<?=$_G['tid']?>" target="_blank">打印</a>
<? } if($_G['forum_thread']['readperm']) { ?>| <em class="xg2">阅读权限 <?=$_G['forum_thread']['readperm']?></em><? } ?>					
<? } ?>
</div>
</div>
</div><?php $ad_a_pr=adshow("thread/a_pr/3/$postcount"); ?><div class="pct"><?php echo adshow("thread/a_pt/2/$postcount"); if(!$_G['inajax']) { if($ad_a_pr) { if(!empty($_G['thread']['contentmr']) && empty($ad_a_pr_css)) { ?>
<style type="text/css">.pcb{margin-right:<? echo $_G['thread']['contentmr']+10; ?>px}</style><?php $ad_a_pr_css=1; } ?>
<?=$ad_a_pr?>
<? } elseif(empty($ad_a_pr_css)) { ?>
<style type="text/css">.pcb{margin-right:0}</style><?php $ad_a_pr_css=1; } } if($post['first']) { if($post['tags'] || $relatedkeywords) { ?>
<div class="ptg">
<? if($post['tags']) { ?><?=$post['tags']?><? } if($relatedkeywords) { ?><span><?=$relatedkeywords?></span><? } ?>
</div>
<? } } ?><div class="pcb">
<? if($post['warned']) { ?>
<span class="y"><a href="forum.php?mod=misc&amp;action=viewwarning&amp;tid=<?=$_G['tid']?>&amp;uid=<?=$post['authorid']?>" title="受到警告" onclick="showWindow('viewwarning', this.href)"><img src="<?=IMGDIR?>/warning.gif" alt="受到警告" /></a></span>
<? } if(!$post['first'] && !empty($post['subject'])) { ?>
<h2><?=$post['subject']?></h2>
<? } if($_G['adminid'] != 1 && $_G['setting']['bannedmessages'] & 1 && (($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || $post['status'] == -1 || $post['memberstatus'])) { ?>
<div class="locked">提示: <em>作者被禁止或删除 内容自动屏蔽</em></div>
<? } elseif($_G['adminid'] != 1 && $post['status'] & 1) { ?>
<div class="locked">提示: <em>该帖被管理员或版主屏蔽</em></div>
<? } elseif($needhiddenreply) { ?>
<div class="locked">此帖仅作者可见</div>
<? } elseif($post['first'] && $_G['forum_threadpay']) { include template('forum/viewthread_pay'); } else { ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_posttop'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_posttop'][$postcount]; if($_G['setting']['bannedmessages'] & 1 && (($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5))) { ?>
<div class="locked">提示: <em>作者被禁止或删除 内容自动屏蔽，只有管理员可见</em></div>
<? } elseif($post['status'] & 1) { ?>
<div class="locked">提示: <em>该帖被管理员或版主屏蔽，只有管理员可见</em></div>
<? } if($post['first']) { if($_G['forum_thread']['price'] > 0 && $_G['forum_thread']['special'] == 0) { ?>
<div class="locked"><em class="y"><a href="forum.php?mod=misc&amp;action=viewpayments&amp;tid=<?=$_G['tid']?>" onclick="showWindow('pay', this.href)">记录</a></em>付费主题, 价格: <strong><?=$_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title']?> <?=$_G['forum_thread']['price']?> <?=$_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit']?> </strong></div>
<? } if($threadsort && $threadsortshow) { if($threadsortshow['typetemplate']) { ?>
<?=$threadsortshow['typetemplate']?>
<? } elseif($threadsortshow['optionlist'] && !($post['status'] & 1) && !$_G['forum_threadpay']) { ?>
<div class="typeoption">
<? if($threadsortshow['optionlist'] == 'expire') { ?>
该信息已经过期
<? } else { ?>
<table summary="分类信息" cellpadding="0" cellspacing="0" class="cgtl mbm">
<caption><?=$_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']]?></caption>
<tbody><? if(is_array($threadsortshow['optionlist'])) foreach($threadsortshow['optionlist'] as $option) { if($option['type'] != 'info') { ?>
<tr>
<th><?=$option['title']?>:</th>
<td><? if($option['value']) { ?><?=$option['value']?> <?=$option['unit']?><? } else { ?>-<? } ?></td>
</tr>
<? } } ?>
</tbody>
</table>
<? } ?>
</div>
<? } } } ?>
<div class="<? if(!$_G['forum_thread']['special']) { ?>t_fsz<? } else { ?>pcbs<? } ?>">
<? if($post['first']) { if(!$_G['forum_thread']['special']) { ?>
<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?=$post['pid']?>"><?=$post['message']?></td></tr></table>
<? } elseif($_G['forum_thread']['special'] == 1) { include template('forum/viewthread_poll'); } elseif($_G['forum_thread']['special'] == 2) { include template('forum/viewthread_trade'); } elseif($_G['forum_thread']['special'] == 3) { include template('forum/viewthread_reward'); } elseif($_G['forum_thread']['special'] == 4) { include template('forum/viewthread_activity'); } elseif($_G['forum_thread']['special'] == 5) { include template('forum/viewthread_debate'); } elseif($threadplughtml) { ?>
<?=$threadplughtml?>
<? } } else { ?>
<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?=$post['pid']?>"><?=$post['message']?></td></tr></table>
<? } if($post['attachment']) { ?>
<div class="locked">附件: <em><? if($_G['uid']) { ?>你所在的用户组无法下载或查看附件<? } else { ?>你需要<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href);return false;">登录</a>才可以下载或查看附件。没有帐号？<a href="member.php?mod=<?=$_G['setting']['regname']?>" onclick="hideWindow('login');showWindow('register', this.href);return false;" title="注册帐号"><?=$_G['setting']['reglinkname']?></a><? } ?></em></div>
<? } elseif($post['imagelist'] || $post['attachlist']) { ?>
<div class="pattl">
<? if($post['imagelist']) { ?>
<?=$post['imagelist']?>
<? } if($post['attachlist']) { ?>
<?=$post['attachlist']?>
<? } ?>
</div>
<? } ?>
</div>
<? if($post['first'] && $sticklist) { ?>
<div>
<h3 class="psth xs1">回帖推荐</h3><? if(is_array($sticklist)) foreach($sticklist as $rpost) { ?><div class="pstl xs1">
<div class="psta"><a href="home.php?mod=space&amp;uid=<?=$rpost['authorid']?>" c="1"><?=$rpost['avatar']?></a></div>
<div class="psti">
<p>
<a href="home.php?mod=space&amp;uid=<?=$rpost['authorid']?>" class="xi2 xw1"><?=$rpost['author']?></a> 发表于<?=$rpost['position']?>楼
<span class="xi2">
&nbsp;<a href="javascript:;" onclick="window.open('forum.php?mod=redirect&goto=findpost&ptid=<?=$rpost['tid']?>&pid=<?=$rpost['pid']?>')" class="xi2">查看完整内容</a>
<? if($_G['group']['allowstickreply']) { ?>&nbsp;<a href="javascript:;" onclick="modaction('stickreply', <?=$rpost['pid']?>, '&undo=yes')" class="xi2">解除置顶</a><? } ?>
</span>
</p>
<div class="mtn"><?=$rpost['message']?></div>
</div>
</div>
<? } ?>
</div>
<? } ?>
<div id="comment_<?=$post['pid']?>" class="cm">
<? if($_G['setting']['commentnumber'] && !empty($comments[$post['pid']])) { ?>
<h3 class="psth xs1">点评</h3>
<? if($totalcomment[$post['pid']]) { ?><div class="pstl"><?=$totalcomment[$post['pid']]?></div><? } if(is_array($comments[$post['pid']])) foreach($comments[$post['pid']] as $comment) { ?><div class="pstl xs1">
<div class="psta"><a href="home.php?mod=space&amp;uid=<?=$comment['authorid']?>" c="1"><?=$comment['avatar']?></a></div>
<div class="psti">
<a href="home.php?mod=space&amp;uid=<?=$comment['authorid']?>" class="xi2 xw1"><?=$comment['author']?></a>
&nbsp;<?=$comment['comment']?>&nbsp;
<span class="xg1">
发表于 <?=$comment['dateline']?>
<? if($_G['forum']['ismoderator'] && $_G['group']['allowdelpost']) { ?>&nbsp;<a href="javascript:;" onclick="modaction('delcomment', <?=$comment['id']?>)">删除</a><? } ?>
</span>
</div>
</div>
<? } if($commentcount[$post['pid']] > $_G['setting']['commentnumber']) { ?><div class="pgs mbm cl"><div class="pg"><a href="javascript:;" class="nxt" onclick="ajaxget('forum.php?mod=misc&action=commentmore&tid=<?=$post['tid']?>&pid=<?=$post['pid']?>&page=2', 'comment_<?=$post['pid']?>')">下一页</a></div></div><? } } ?>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postbottom'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postbottom'][$postcount]; if(!empty($post['ratelog'])) { ?>
<dl id="ratelog_<?=$post['pid']?>" class="rate<? if(!empty($_G['cookie']['ratecollapse'])) { ?> rate_collapse<? } ?>">
<? if($_G['setting']['ratelogon']) { ?>
<dd style="margin:0">
<? } else { ?>
<dt>
<? if(!empty($postlist[$post['pid']]['totalrate'])) { ?>
<strong><a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?=$_G['tid']?>&amp;pid=<?=$post['pid']?>" onclick="showWindow('viewratings', this.href)" title="已有<? echo count($postlist[$post['pid']]['totalrate']);; ?>人评分, 查看全部评分"><? echo count($postlist[$post['pid']]['totalrate']);; ?></a></strong>
<p><a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?=$_G['tid']?>&amp;pid=<?=$post['pid']?>" onclick="showWindow('viewratings', this.href)">查看全部评分</a></p>
<? } ?>
</dt>
<dd>
<? } ?>
<div id="post_rate_<?=$post['pid']?>"></div>
<? if($_G['setting']['ratelogon']) { ?>
<table class="ratl">
<tr>
<th class="xw1" width="120"><a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?=$_G['tid']?>&amp;pid=<?=$post['pid']?>" onclick="showWindow('viewratings', this.href)" title="查看全部评分">已有 <span class="xi1"><? echo count($postlist[$post['pid']]['totalrate']);; ?></span> 人评分</a></th><? if(is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { ?><th width="50"><i><?=$_G['setting']['extcredits'][$id]['title']?></i></th>
<? } ?>
<th>
<a href="javascript:;" onclick="toggleRatelogCollapse('ratelog_<?=$post['pid']?>', this);" class="y xi2 op"><? if(!empty($_G['cookie']['ratecollapse'])) { ?>展开<? } else { ?>收起<? } ?></a>
<i>理由</i>
</th>
</tr>
<tbody class="ratl_l"><? if(is_array($post['ratelog'])) foreach($post['ratelog'] as $uid => $ratelog) { ?><tr id="rate_<?=$post['pid']?>_<?=$uid?>">
<td>
<a href="home.php?mod=space&amp;uid=<?=$uid?>" target="_blank" c="1"><? echo avatar($uid, 'small');; ?></a> <a href="home.php?mod=space&amp;uid=<?=$uid?>" target="_blank"><?=$ratelog['username']?></a>
</td><? if(is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { if($ratelog['score'][$id] > 0) { ?>
<td class="xi1"> + <?=$ratelog['score'][$id]?></td>
<? } else { ?>
<td class="xg1"><?=$ratelog['score'][$id]?></td>
<? } } ?>
<td class="xg1"><?=$ratelog['reason']?></td>
</tr>
<? } ?>
</tbody>
</table>
<p class="ratc">
总评分:&nbsp;<? if(is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { if($score > 0) { ?>
<span class="xi1"><?=$_G['setting']['extcredits'][$id]['title']?> + <?=$score?></span>&nbsp;
<? } else { ?>
<span class="xg1"><?=$_G['setting']['extcredits'][$id]['title']?> <?=$score?></span>&nbsp;
<? } } ?>
&nbsp;<a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?=$_G['tid']?>&amp;pid=<?=$post['pid']?>" onclick="showWindow('viewratings', this.href)" title="查看全部评分" class="xi2">查看全部评分</a>
</p>
<? } else { ?>
<ul class="cl"><? if(is_array($post['ratelog'])) foreach($post['ratelog'] as $uid => $ratelog) { ?><li>
<div id="rate_<?=$post['pid']?>_<?=$uid?>_menu" class="attp" style="display: none;">
<p class="crly"><?=$ratelog['reason']?> &nbsp;&nbsp;<? if(is_array($ratelog['score'])) foreach($ratelog['score'] as $id => $score) { if($score > 0) { ?>
<em><?=$_G['setting']['extcredits'][$id]['title']?> + <?=$score?> <?=$_G['setting']['extcredits'][$id]['unit']?></em>
<? } else { ?>
<span><?=$_G['setting']['extcredits'][$id]['title']?> <?=$score?> <?=$_G['setting']['extcredits'][$id]['unit']?></span>
<? } } ?>
</p>
<p class="mncr"></p>
</div>
<p id="rate_<?=$post['pid']?>_<?=$uid?>" onmouseover="showMenu({'ctrlid':this.id,'pos':'12'})" class="mtn mbn"><a href="home.php?mod=space&amp;uid=<?=$uid?>" target="_blank" class="avt" c="1"><? echo avatar($uid, 'small');; ?></a></p>
<p><a href="home.php?mod=space&amp;uid=<?=$uid?>" target="_blank"><?=$ratelog['username']?></a></p>
</li>
<? } ?>
</ul>
<? } ?>
</dd>
</dl>
<? } else { ?>
<div id="post_rate_div_<?=$post['pid']?>"></div>
<? } } ?>
</div></div>
</td></tr>
<tr><td class="plc plm">
<? if(!IS_ROBOT && $post['first'] && !$_G['forum_thread']['archiveid']) { if(!empty($lastmod['modaction'])) { ?><div class="modact"><a href="forum.php?mod=misc&amp;action=viewthreadmod&amp;tid=<?=$_G['tid']?>" title="帖子模式" onclick="showWindow('viewthreadmod', this.href)">本主题由 <?=$lastmod['modusername']?> 于 <?=$lastmod['moddateline']?> <?=$lastmod['modaction']?></a></div><? } ?>
<div class="uo<? if($_G['group']['allowrecommend'] && $_G['setting']['recommendthread']['status']) { ?> nrate<? } ?>">
<? if($post['invisible'] == 0) { if($_G['group']['raterange'] && $post['authorid']) { ?>
<a id="k_rate" href="javascript:;" onclick="showWindow('rate', 'forum.php?mod=misc&action=rate&tid=<?=$_G['tid']?>&pid=<?=$post['pid']?>', 'get', -1);return false;" title="<? echo count($postlist[$post['pid']]['totalrate']);; ?> 人评分">评分&nbsp;</a>
<? } ?>
<a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=thread&amp;id=<?=$_G['tid']?>" id="k_favorite" onclick="showWindow(this.id, this.href, 'get', 0);" onmouseover="this.title = $('favoritenumber').innerHTML + ' 人收藏'">收藏<span id="favoritenumber"><?=$_G['forum_thread']['favtimes']?></span></a>
<a href="home.php?mod=spacecp&amp;ac=share&amp;type=thread&amp;id=<?=$_G['tid']?>" id="k_share" onclick="showWindow(this.id, this.href, 'get', 0);" onmouseover="this.title = $('sharenumber').innerHTML + ' 人分享'">分享<span id="sharenumber"><?=$_G['forum_thread']['sharetimes']?></span></a>
<? if($_G['perm']['allowrecommend'] && $_G['setting']['recommendthread']['status']) { ?>
<a id="recommend_add" href="forum.php?mod=misc&amp;action=recommend&amp;do=add&amp;tid=<?=$_G['tid']?>" <? if($_G['uid']) { ?>onclick="ajaxmenu(this, 3000, 1, 0, '43', 'recommendupdate(<?=$_G['group']['allowrecommend']?>)');return false;"<? } else { ?> onclick="showWindow('login', this.href)"<? } ?> onmouseover="this.title = $('recommendv_add').innerHTML + ' 人<?=$_G['setting']['recommendthread']['addtext']?>'"><?=$_G['setting']['recommendthread']['addtext']?><span id="recommendv_add"><?=$_G['forum_thread']['recommend_add']?></span></a>
<a id="recommend_subtract" href="forum.php?mod=misc&amp;action=recommend&amp;do=subtract&amp;tid=<?=$_G['tid']?>" <? if($_G['uid']) { ?>onclick="ajaxmenu(this, 3000, 1, 0, '43', 'recommendupdate(-<?=$_G['group']['allowrecommend']?>)');return false;"<? } else { ?> onclick="showWindow('login', this.href)"<? } ?> onmouseover="this.title = $('recommendv_subtract').innerHTML + ' 人<?=$_G['setting']['recommendthread']['subtracttext']?>'"><?=$_G['setting']['recommendthread']['subtracttext']?><span id="recommendv_subtract"><?=$_G['forum_thread']['recommend_sub']?></span></a>
<? } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_useraction'])) echo $_G['setting']['pluginhooks']['viewthread_useraction']; ?>
</div>
<? } if($post['signature'] && ($_G['setting']['bannedmessages'] & 4 && (($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || ($post['status'] & 1)))) { ?>
<div class="sign">签名被屏蔽</div>
<? } elseif($post['signature'] && !$post['anonymous'] && $showsignatures) { ?>
<div class="sign" style="max-height:<?=$_G['setting']['maxsigrows']?>px;maxHeightIE:<?=$_G['setting']['maxsigrows']?>px;"><?=$post['signature']?></div>
<? } ?><?php echo adshow("thread/a_pb/1/$postcount"); ?></td>
</tr>
<? if(!$_G['forum_thread']['archiveid']) { ?>
<tr>
<td class="pls"></td>
<td class="plc">
<div class="po">
<? if(!$post['first'] && $modmenu['post']) { ?>
<span class="y">
<label for="manage<?=$post['pid']?>">
<input type="checkbox" id="manage<?=$post['pid']?>" class="pc" <? if(!empty($modclick)) { ?>checked="checked" <? } ?>onclick="pidchecked(this);modclick(this, <?=$post['pid']?>)" value="<?=$post['pid']?>" autocomplete="off" />
管理
</label>
</span>
<? } ?>
<div class="pob cl">
<em>
<? if($post['invisible'] == 0) { if($allowpostreply) { if($post['allowcomment']) { ?><a class="cmmnt" href="forum.php?mod=misc&amp;action=comment&amp;tid=<?=$post['tid']?>&amp;pid=<?=$post['pid']?>&amp;extra=<?=$_G['gp_extra']?>&amp;page=<?=$page?><? if($_G['forum_thread']['special'] == 127) { ?>&amp;special=<?=$specialextra?><? } ?>" onclick="showPostWin('comment', this.href)">点评</a><? } ?>
<a class="fastre" href="forum.php?mod=post&amp;action=reply&amp;fid=<?=$_G['fid']?>&amp;tid=<?=$_G['tid']?>&amp;reppost=<?=$post['pid']?>&amp;extra=<?=$_G['gp_extra']?>&amp;page=<?=$page?>" onclick="showWindow('reply', this.href)">回复</a>
<? if(!$needhiddenreply) { ?>
<a class="req" href="forum.php?mod=post&amp;action=reply&amp;fid=<?=$_G['fid']?>&amp;tid=<?=$_G['tid']?>&amp;repquote=<?=$post['pid']?>&amp;extra=<?=$_G['gp_extra']?>&amp;page=<?=$page?>" onclick="showWindow('reply', this.href)">引用</a>
<? } } } if((($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && $post['authorid'] == $_G['uid']))) { ?>
<a class="editp" href="forum.php?mod=post&amp;action=edit&amp;fid=<?=$_G['fid']?>&amp;tid=<?=$_G['tid']?>&amp;pid=<?=$post['pid']?><? if(!empty($_G['gp_modthreadkey'])) { ?>&amp;modthreadkey=<?=$_G['gp_modthreadkey']?><? } ?>&amp;page=<?=$page?>"><? if($_G['forum_thread']['special'] == 2 && !$post['message']) { ?>添加柜台介绍<? } else { ?>编辑</a><? } } if(!(($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'])) && $_G['uid'] && $post['authorid'] == $_G['uid']) { ?><a class="appendp" href="forum.php?mod=misc&amp;action=postappend&amp;tid=<?=$post['tid']?>&amp;pid=<?=$post['pid']?>&amp;extra=<?=$_G['gp_extra']?>&amp;page=<?=$page?>" onClick="showPostWin('postappend', this.href)">补充</a><? } if($post['first'] && $post['invisible'] == -3) { ?>
<a class="psave" href="forum.php?mod=misc&amp;action=pubsave&amp;tid=<?=$_G['tid']?>">发表</a>
<? } if($post['invisible'] == -2 && !$post['first']) { ?>
<span class="xg1">(待审核)</span>
<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postfooter'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postfooter'][$postcount]; ?>
</em>

<p>
<? if($post['invisible'] == 0) { if($post['first'] && $_G['uid'] && $_G['uid'] == $post['authorid']) { ?>
<a href="misc.php?mod=invite&amp;action=thread&amp;id=<?=$_G['tid']?>" onclick="showWindow('invite', this.href, 'get', 0);">邀请</a>
<? } if($_G['setting']['magicstatus']) { ?>
<a href="javascript:;" id="mgc_post_<?=$post['pid']?>" onmouseover="showMenu(this.id)" class="mgc">使用道具</a>
<? } if($_G['forum_thread']['special'] == 3 && ($_G['forum']['ismoderator'] && (!$_G['setting']['rewardexpiration'] || $_G['setting']['rewardexpiration'] > 0 && ($_G['timestamp'] - $_G['forum_thread']['dateline']) / 86400 > $_G['setting']['rewardexpiration']) || $_G['forum_thread']['authorid'] == $_G['uid']) && $post['authorid'] != $_G['forum_thread']['authorid'] && $post['first'] == 0 && $_G['uid'] != $post['authorid'] && $_G['forum_thread']['price'] > 0) { ?>
<a href="javascript:;" onclick="setanswer(<?=$post['pid']?>, '<?=$_G['gp_from']?>')">最佳答案</a>
<? } if(!$post['first'] && $_G['group']['raterange'] && $post['authorid']) { ?>
<a href="javascript:;" onclick="showWindow('rate', 'forum.php?mod=misc&action=rate&tid=<?=$_G['tid']?>&pid=<?=$post['pid']?>', 'get', -1);return false;">评分</a>
<? } if($post['rate'] && $_G['forum']['ismoderator']) { ?>
<a href="forum.php?mod=misc&amp;action=removerate&amp;tid=<?=$_G['tid']?>&amp;pid=<?=$post['pid']?>&amp;page=<?=$page?>" onclick="showWindow('rate', this.href, 'get', -1)">撤销评分</a>
<? } if($post['authorid'] != $_G['uid']) { ?>
<a href="javascript:;" onclick="showWindow('miscreport<?=$post['pid']?>', 'misc.php?mod=report&rtype=post&rid=<?=$post['pid']?>', 'get', -1);return false;">举报</a>
<? } } ?>
<a href="javascript:;" onclick="scrollTo(0,0);">返回顶部</a>
</p>

<? if($_G['setting']['magicstatus']) { ?>
<ul id="mgc_post_<?=$post['pid']?>_menu" class="p_pop mgcmn" style="display: none;">
<? if($post['first']) { if(!empty($_G['setting']['magics']['bump'])) { ?>
<li><a href="home.php?mod=magic&amp;mid=bump&amp;idtype=tid&amp;id=<?=$_G['tid']?>" id="a_bump" onclick="showWindow(this.id, this.href)"><img src="<?=STATICURL?>image/magic/bump.small.gif" /><?=$_G['setting']['magics']['bump']?></a></li>
<? } if(!empty($_G['setting']['magics']['stick'])) { ?>
<li><a href="home.php?mod=magic&amp;mid=stick&amp;idtype=tid&amp;id=<?=$_G['tid']?>" id="a_stick" onclick="showWindow(this.id, this.href)"><img src="<?=STATICURL?>image/magic/stick.small.gif" /><?=$_G['setting']['magics']['stick']?></a></li>
<? } if(!empty($_G['setting']['magics']['close'])) { ?>
<li><a href="home.php?mod=magic&amp;mid=close&amp;idtype=tid&amp;id=<?=$_G['tid']?>" id="a_stick" onclick="showWindow(this.id, this.href)"><img src="<?=STATICURL?>image/magic/close.small.gif" /><?=$_G['setting']['magics']['close']?></a></li>
<? } if(!empty($_G['setting']['magics']['open'])) { ?>
<li><a href="home.php?mod=magic&amp;mid=open&amp;idtype=tid&amp;id=<?=$_G['tid']?>" id="a_stick" onclick="showWindow(this.id, this.href)"><img src="<?=STATICURL?>image/magic/open.small.gif" /><?=$_G['setting']['magics']['open']?></a></li>
<? } if(!empty($_G['setting']['magics']['highlight'])) { ?>
<li><a href="home.php?mod=magic&amp;mid=highlight&amp;idtype=tid&amp;id=<?=$_G['tid']?>" id="a_stick" onclick="showWindow(this.id, this.href)"><img src="<?=STATICURL?>image/magic/highlight.small.gif" /><?=$_G['setting']['magics']['highlight']?></a></li>
<? } if(!empty($_G['setting']['magics']['sofa'])) { ?>
<li><a href="home.php?mod=magic&amp;mid=sofa&amp;idtype=tid&amp;id=<?=$_G['tid']?>" id="a_stick" onclick="showWindow(this.id, this.href)"><img src="<?=STATICURL?>image/magic/sofa.small.gif" /><?=$_G['setting']['magics']['sofa']?></a></li>
<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_magic_thread'])) echo $_G['setting']['pluginhooks']['viewthread_magic_thread']; } if(!empty($_G['setting']['magics']['repent']) && $post['authorid'] == $_G['uid']) { ?>
<li><a href="home.php?mod=magic&amp;mid=repent&amp;idtype=pid&amp;id=<?=$post['pid']?>:<?=$_G['tid']?>" id="a_repent_<?=$post['pid']?>" onclick="showWindow(this.id, this.href)"><img src="<?=STATICURL?>image/magic/bump.small.gif" /><?=$_G['setting']['magics']['repent']?></a></li>
<? } if(!empty($_G['setting']['magics']['anonymouspost']) && $post['authorid'] == $_G['uid']) { ?>
<li><a href="home.php?mod=magic&amp;mid=anonymouspost&amp;idtype=pid&amp;id=<?=$post['pid']?>:<?=$_G['tid']?>" id="a_anonymouspost_<?=$post['pid']?>" onclick="showWindow(this.id, this.href)"><img src="<?=STATICURL?>image/magic/anonymouspost.small.gif" /><?=$_G['setting']['magics']['anonymouspost']?></a><li>
<? } if(!empty($_G['setting']['magics']['namepost'])) { ?>
<li><a href="home.php?mod=magic&amp;mid=namepost&amp;idtype=pid&amp;id=<?=$post['pid']?>:<?=$_G['tid']?>" id="a_namepost_<?=$post['pid']?>" onclick="showWindow(this.id, this.href)"><img src="<?=STATICURL?>image/magic/namepost.small.gif" /><?=$_G['setting']['magics']['namepost']?></a><li>
<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_magic_post'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_magic_post'][$postcount]; ?>
</ul>
<script type="text/javascript" reload="1">checkmgcmn('post_<?=$post['pid']?>')</script>
<? } ?>
</div>
</div>

</td>
</tr>
<? } ?>
<tr class="ad">
<td class="pls"></td>
<td class="plc">
<? if($post['first'] && $_G['forum_thread']['replies']) { ?><?php echo adshow("interthread/a_p"); } if($post['first'] && $_G['forum_thread']['special'] == 5 && $_G['forum_thread']['displayorder'] >= 0) { ?>
<ul class="ttp cl">
<li style="display:inline;margin-left:12px"><strong class="bw0">按立场筛选: </strong></li>
<li<? if(!isset($_G['gp_stand'])) { ?> class="xw1 a"<? } ?>><a href="forum.php?mod=viewthread&amp;tid=<?=$_G['tid']?>&amp;extra=<?=$_G['gp_extra']?>" hidefocus="true">全部</a></li>
<li<? if($_G['gp_stand'] == 1) { ?> class="xw1 a"<? } ?>><a href="forum.php?mod=viewthread&amp;tid=<?=$_G['tid']?>&amp;extra=<?=$_G['gp_extra']?>&amp;stand=1" hidefocus="true">正方</a></li>
<li<? if($_G['gp_stand'] == 2) { ?> class="xw1 a"<? } ?>><a href="forum.php?mod=viewthread&amp;tid=<?=$_G['tid']?>&amp;extra=<?=$_G['gp_extra']?>&amp;stand=2" hidefocus="true">反方</a></li>
<li<? if(isset($_G['gp_stand']) && $_G['gp_stand'] == 0) { ?> class="xw1 a"<? } ?>><a href="forum.php?mod=viewthread&amp;tid=<?=$_G['tid']?>&amp;extra=<?=$_G['gp_extra']?>&amp;stand=0" hidefocus="true">中立</a></li>
</ul>
<? } ?>
</td>
</tr>
</table>
<? if(!empty($aimgs[$post['pid']])) { ?>
<script type="text/javascript" reload="1">aimgcount[<?=$post['pid']?>] = [<? echo implode(',', $aimgs[$post['pid']]);; ?>];attachimgshow(<?=$post['pid']?>);</script>
<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_endline'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_endline'][$postcount]; ?></div><?php $postcount++; } ?>

<div id="postlistreply" class="pl"><div id="post_new" class="viewthread_table" style="display: none"></div></div>

<table cellspacing="0" cellpadding="0">
<tr class="modmenu">
<td class="pls hm ptm pbm">
<? if(!IS_ROBOT) { ?><a href="forum.php?mod=redirect&amp;goto=nextoldset&amp;tid=<?=$_G['tid']?>">&lsaquo; 上一主题</a><span class="pipe">|</span><a href="forum.php?mod=redirect&amp;goto=nextnewset&amp;tid=<?=$_G['tid']?>">下一主题 <em>&rsaquo;</em></a><? } ?>
</td>
<td class="modmenu plc ptm pbm xi2">
<? if($modmenu['thread']) { ?>
<script type="text/javascript">
$('modmenu').lastChild.style.visibility = 'hidden';
document.write($('modmenu').innerHTML);
</script>
<? } ?>
</td>
</tr>
</table>

</div>

<form method="post" autocomplete="off" name="modactions" id="modactions">
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<input type="hidden" name="optgroup" />
<input type="hidden" name="operation" />
<input type="hidden" name="listextra" value="<?=$_G['gp_extra']?>" />
</form>

<?=$_G['forum_tagscript']?>

<div class="pgs mtm mbm cl">
<?=$multipage?>
<span class="pgb y"<? if($_G['setting']['visitedforums']) { ?> id="visitedforumstmp" onmouseover="$('visitedforums').id = 'visitedforumstmp';this.id = 'visitedforums';showMenu({'ctrlid':this.id,'pos':'21'})"<? } ?>><a href="<?=$upnavlink?>">返回列表</a></span>
<? if(!$_G['forum_thread']['is_archived']) { ?>
<a id="newspecialtmp" onmouseover="$('newspecial').id = 'newspecialtmp';this.id = 'newspecial';showMenu({'ctrlid':this.id})"<? if(!$_G['forum']['allowspecialonly']) { ?> onclick="showWindow('newthread', 'forum.php?mod=post&action=newthread&fid=<?=$_G['fid']?>')"<? } else { ?> onclick="location.href='forum.php?mod=post&action=newthread&fid=<?=$_G['fid']?>'"<? } ?> href="javascript:;" title ="发新帖"><img src="<?=IMGDIR?>/pn_post.png" alt="发新帖" /></a>
<? } if($allowpostreply && !$_G['forum_thread']['archiveid']) { ?>
<a id="post_replytmp" onclick="showWindow('reply', 'forum.php?mod=post&action=reply&fid=<?=$_G['fid']?>&tid=<?=$_G['tid']?>')" href="javascript:;" title="回复"><img src="<?=IMGDIR?>/pn_reply.png" alt="回复" /></a>
<? } ?>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_middle'])) echo $_G['setting']['pluginhooks']['viewthread_middle']; ?>
<!--[diy=diyfastposttop]--><div id="diyfastposttop" class="area"></div><!--[/diy]-->
<? if($_G['setting']['fastpost'] && $allowpostreply && !$_G['forum_thread']['archiveid'] && ($_G['forum']['status'] != 3 || $_G['isgroupuser'])) { ?><script type="text/javascript">
var postminchars = parseInt('<?=$_G['setting']['minpostsize']?>');
var postmaxchars = parseInt('<?=$_G['setting']['maxpostsize']?>');
var disablepostctrl = parseInt('<?=$_G['group']['disablepostctrl']?>');
</script>

<div id="f_pst" class="pl<? if(empty($_G['gp_from'])) { ?> bm bmw<? } ?>">
<form method="post" autocomplete="off" id="fastpostform" action="forum.php?mod=post&amp;action=reply&amp;fid=<?=$_G['fid']?>&amp;tid=<?=$_G['tid']?>&amp;extra=<?=$_G['gp_extra']?>&amp;replysubmit=yes<? if($_G['gp_ordertype'] != 1) { ?>&amp;infloat=yes&amp;handlekey=fastpost<? } if($_G['gp_from']) { ?>&amp;from=<?=$_G['gp_from']?><? } ?>"<? if($_G['gp_ordertype'] != 1) { ?> onSubmit="return fastpostvalidate(this)"<? } ?>>
<? if(empty($_G['gp_from'])) { ?>
<table cellspacing="0" cellpadding="0">
<tr>
<td class="pls">
<? if($_G['uid']) { ?><div class="avatar"><? echo avatar($_G['uid']); ?></div><? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_fastpost_side'])) echo $_G['setting']['pluginhooks']['viewthread_fastpost_side']; ?>
</td>
<td class="plc">
<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_fastpost_content'])) echo $_G['setting']['pluginhooks']['viewthread_fastpost_content']; ?>

<span id="fastpostreturn"></span>

<? if($_G['forum_thread']['special'] == 5 && empty($firststand)) { ?>
<div class="pbt cl">
<div class="ftid sslt">
<select id="stand" name="stand">
<option value="">选择观点</option>
<option value="0">中立</option>
<option value="1">正方</option>
<option value="2">反方</option>
</select>
</div>
<script type="text/javascript">simulateSelect('stand');</script>
</div>
<? } ?>

<div class="cl">
<? if(empty($_G['gp_from']) && $_G['setting']['fastsmilies']) { ?><div id="fastsmiliesdiv" class="y"><div id="fastsmiliesdiv_data"><div id="fastsmilies"></div></div></div><? } ?>
<div<? if(empty($_G['gp_from']) && $_G['setting']['fastsmilies']) { ?> class="hasfsl"<? } ?>>
<div class="tedt<? if(!($_G['forum_thread']['special'] == 5 && empty($firststand))) { ?> mtn<? } ?>">
<div class="bar">
<span class="y">
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_fastpost_func_extra'])) echo $_G['setting']['pluginhooks']['viewthread_fastpost_func_extra']; if($_G['setting']['magicstatus'] && !empty($_G['setting']['magics']['doodle'])) { ?>
<a id="a_magic_doodle" href="home.php?mod=magic&amp;mid=doodle&amp;showid=comment_doodle&amp;target=fastpostmessage&amp;from=fastpost" onclick="showWindow(this.id, this.href, 'get', 0)"><?=$_G['setting']['magics']['doodle']?></a>
<span class="pipe">|</span>
<? } ?>
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?=$_G['fid']?>&amp;tid=<?=$_G['tid']?><? if($_G['gp_from']) { ?>&amp;from=<?=$_G['gp_from']?><? } ?>" onclick="return switchAdvanceMode(this.href)">高级模式</a>
<? if(empty($_G['gp_from'])) { ?>
<span class="pipe">|</span>
<span id="newspecialtmp" onmouseover="$('newspecial').id = 'newspecialtmp';this.id = 'newspecial';showMenu({'ctrlid':this.id})"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?=$_G['fid']?><? if($_G['gp_from']) { ?>&amp;from=<?=$_G['gp_from']?><? } ?>"<? if(!$_G['forum']['allowspecialonly']) { ?> onclick="showWindow('newthread', this.href)"<? } ?>>发表帖子</a></span>
<? } ?>
</span><?php $seditor = array('fastpost', array('bold', 'color', 'img', 'link', 'quote', 'code', 'smilies'), $guestreply ? 1 : 0); ?><?php if(!empty($_G['setting']['pluginhooks']['viewthread_fastpost_ctrl_extra'])) echo $_G['setting']['pluginhooks']['viewthread_fastpost_ctrl_extra']; ?><div class="fpd">
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
</div></div>
<div class="area">
<? if(!$guestreply) { ?>
<textarea rows="5" cols="80" name="message" id="fastpostmessage" onKeyDown="seditor_ctlent(event, <? if($_G['gp_ordertype'] != 1) { ?>'fastpostvalidate($(\'fastpostform\'))'<? } else { ?>'$(\'fastpostform\').submit()'<? } ?>);" tabindex="4" class="pt"></textarea>
<? } else { ?>
<div class="pt hm">你需要登录后才可以回帖 <a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)" class="xi2">登录</a> | <a href="member.php?mod=<?=$_G['setting']['regname']?>" onclick="showWindow('register', this.href)" class="xi2"><?=$_G['setting']['reglinkname']?></a></div>
<? } ?>
</div>
</div>
<? if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?
$sectpl = <<<EOF
<sec> <span id="sec<hash>" onclick="showMenu(this.id)"><sec></span><div id="sec<hash>_menu" class="p_pop p_opt" style="display:none"><sec></div>
EOF;
?>
<div class="mtm sec"><? include template('common/seccheck'); ?></div>
<? } ?>
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<input type="hidden" name="subject" value="" />
<p class="ptm">
<button <? if(!$guestreply) { ?>type="submit" <? } else { ?>type="button" onclick="showWindow('login', 'member.php?mod=logging&action=login&guestmessage=yes')" <? } ?>name="replysubmit" id="fastpostsubmit" class="pn vm" value="replysubmit" tabindex="5"><strong>发表回复</strong></button>
<? if($_G['gp_ordertype'] != 1 && empty($_G['gp_from'])) { ?>
<input id="fastpostrefresh" type="checkbox" class="pc" /> <label for="fastpostrefresh">回帖后跳转到最后一页</label>
<script type="text/javascript">if(getcookie('fastpostrefresh') == 1) {$('fastpostrefresh').checked=true;}</script>
<? } ?>
</p>
</div>
</div>
<? if(empty($_G['gp_from'])) { ?>
</td>
</tr>
</table>
<? } ?>
</form>
</div><? } ?>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_bottom'])) echo $_G['setting']['pluginhooks']['viewthread_bottom']; if($_G['setting']['visitedforums'] || $oldthreads) { ?>
<div id="visitedforums_menu" class="<? if($oldthreads) { ?>visited_w <? } ?>p_pop blk cl" style="display: none;">
<table cellspacing="0" cellpadding="0">
<tr>
<? if($_G['setting']['visitedforums']) { ?>
<td id="v_forums">
<h3 class="mbn pbn bbda xg1">浏览过的版块</h3>
<ul>
<?=$_G['setting']['visitedforums']?>
</ul>
</td>
<? } if($oldthreads) { ?>
<td id="v_threads">
<h3 class="mbn pbn bbda xg1">浏览过的帖子</h3>
<ul class="xl"><? if(is_array($oldthreads)) foreach($oldthreads as $oldtid => $oldsubject) { ?><li><a href="forum.php?mod=viewthread&amp;tid=<?=$oldtid?>"><?=$oldsubject?></a></li>
<? } ?>
</ul>
</td>
<? } ?>
</tr>
</table>
</div>
<? } if($_G['setting']['forumjump']) { ?>
<div class="p_pop" id="fjump_menu" style="display: none">
<?=$forummenu?>
</div>
<? } if(!IS_ROBOT && $_G['setting']['threadmaxpages'] > 1) { ?>
<script type="text/javascript">document.onkeyup = function(e){keyPageScroll(e, <? if($page > 1) { ?>1<? } else { ?>0<? } ?>, <? if($page < $_G['setting']['threadmaxpages'] && $page < $_G['page_next']) { ?>1<? } else { ?>0<? } ?>, 'forum.php?mod=viewthread&tid=<?=$_G['tid']?><? if($_G['gp_authorid']) { ?>&authorid=<?=$_G['gp_authorid']?><? } ?>', <?=$page?>);}</script>
<? } ?>
</div>

<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div><?php output(); ?>﻿</div>
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

