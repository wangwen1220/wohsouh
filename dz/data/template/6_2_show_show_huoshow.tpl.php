<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('show_huoshow');
0
|| checktplrefresh('./template/huoshow/show/show_huoshow.htm', './template/huoshow/show/multilive_header.htm', 1333937878, '2', './data/template/6_2_show_show_huoshow.tpl.php', './template/huoshow', 'show/show_huoshow')
|| checktplrefresh('./template/huoshow/show/show_huoshow.htm', './template/huoshow/common/footer.htm', 1333937878, '2', './data/template/6_2_show_show_huoshow.tpl.php', './template/huoshow', 'show/show_huoshow')
|| checktplrefresh('./template/huoshow/show/show_huoshow.htm', './template/huoshow/show/multilive_footer.htm', 1333937878, '2', './data/template/6_2_show_show_huoshow.tpl.php', './template/huoshow', 'show/show_huoshow')
|| checktplrefresh('./template/huoshow/show/show_huoshow.htm', './template/huoshow/home/space_live_header.htm', 1333937878, '2', './data/template/6_2_show_show_huoshow.tpl.php', './template/huoshow', 'show/show_huoshow')
|| checktplrefresh('./template/huoshow/show/show_huoshow.htm', './template/huoshow/show/notice.htm', 1333937878, '2', './data/template/6_2_show_show_huoshow.tpl.php', './template/huoshow', 'show/show_huoshow')
|| checktplrefresh('./template/huoshow/show/show_huoshow.htm', './template/huoshow/common/footer_1_5.htm', 1333937878, '2', './data/template/6_2_show_show_huoshow.tpl.php', './template/huoshow', 'show/show_huoshow')
|| checktplrefresh('./template/huoshow/show/show_huoshow.htm', './template/huoshow/common/header_space_common.htm', 1333937878, '2', './data/template/6_2_show_show_huoshow.tpl.php', './template/huoshow', 'show/show_huoshow')
|| checktplrefresh('./template/huoshow/show/show_huoshow.htm', './template/huoshow/home/space_diy.htm', 1333937878, '2', './data/template/6_2_show_show_huoshow.tpl.php', './template/huoshow', 'show/show_huoshow')
;?>
<!DOCTYPE html>
<html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?=CHARSET?>" />
        <title><? if(!empty($navtitle)) { ?><?=$navtitle?> - <? } if(empty($nobbname1)) { ?> <?=$_G['setting']['bbname']?>_美女视频<? } ?></title>
        <?=$_G['setting']['seohead']?>
        <meta name="keywords" content="<? if(!empty($metakeywords)) { echo htmlspecialchars($metakeywords); } ?>" />
        <meta name="description" content="<? if(!empty($metadescription)) { echo htmlspecialchars($metadescription); ?> <? } ?>,<?=$_G['setting']['bbname']?>" />
        <base href="<?=$_G['siteurl']?>" />
        <link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_common.css?<?=VERHASH?>" /><? if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['cookie']['extstyle']?>/style.css" /><? } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['style']['defaultextstyle']?>/style.css" /><? } ?>    <link rel="stylesheet" type="text/css" href="static2/space_common.css?<?=VERHASH?>" />    
        <script src="/static2/js/jquery.min.js?<?=VERHASH?>" type="text/javascript"></script>
        
        <script>
          var STYLEID = '<?=STYLEID?>', STATICURL = '<?=STATICURL?>', IMGDIR = '<?=IMGDIR?>', VERHASH = '<?=VERHASH?>', charset = '<?=CHARSET?>', discuz_uid = '<?=$_G['uid']?>', cookiepre = '<?=$_G['config']['cookie']['cookiepre']?>', cookiedomain = '<?=$_G['config']['cookie']['cookiedomain']?>', cookiepath = '<?=$_G['config']['cookie']['cookiepath']?>', showusercard = '<?=$_G['setting']['showusercard']?>', attackevasive = '<?=$_G['config']['security']['attackevasive']?>', disallowfloat = '<?=$_G['setting']['disallowfloat']?>', creditnotice = '<? if($_G['setting']['creditnotice']) { ?><?=$_G['setting']['creditnames']?><? } ?>', defaultstyle = '<?=$_G['style']['defaultextstyle']?>', REPORTURL = '<?=$_G['currenturl_encode']?>', SITEURL = '<?=$_G['siteurl']?>',DXURL = '<?=$_G['siteurl']?>', CMSURL = 'http://www.huoshow.com/';
        </script>
        <script src="<?=$_G['setting']['jspath']?>common.js?<?=VERHASH?>" type="text/javascript"></script>
        <script src="/static2/js/huoshow_common.js?<?=VERHASH?>" type="text/javascript"></script>
<script src="<?=$_G['setting']['jspath']?>home.js?<?=VERHASH?>" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?=$_G['setting']['csspath']?>data/cache/style_<?=STYLEID?>_css_space.css?<?=VERHASH?>" />
<link id="style_css" rel="stylesheet" type="text/css" href="<?=STATICURL?>space/<? if($space['theme']) { ?><?=$space['theme']?><? } else { ?>t1<? } ?>/style.css?<?=VERHASH?>">
<style id="diy_style"><?=$space['spacecss']?></style>
</head>

<body id="space" onkeydown="if(event.keyCode==27) return false;">
  <? if($space['self']) { ?><a id="diy-tg" href="<?=DX_URL?>home.php?mod=space&diy=yes" title="装扮空间"><img src="<?=STATICURL?>image/diy/panel-toggle-space.png" alt="DIY" /></a><? } ?>
  <div id="append_parent"></div>
  <div id="ajaxwaitid"></div>

  <? if($space['self'] && $_GET['diy'] == 'yes' && $do == 'index' ) { ?>
  <link rel="stylesheet" type="text/css" href="<?=$_G['setting']['csspath']?>data/cache/style_<?=STYLEID?>_css_diy.css?<?=VERHASH?>" />
  <div id="controlpanel" class="cl">
<div id="controlheader" class="cl">
<p class="y">
<span id="navcancel"><a href="javascript:;" onclick="spaceDiy.cancel();return false;">关闭</a></span>
<span id="navsave"><a href="javascript:;" onclick="javascript:spaceDiy.save();return false;">保存</a></span>
<span id="button_redo" class="unusable"><a href="javascript:;" onclick="spaceDiy.redo();return false;" title="!diy_redo!" onfocus="this.blur();">!diy_redo!</a></span>
<span id="button_undo" class="unusable"><a href="javascript:;" onclick="spaceDiy.undo();return false;" title="!diy_revocation!" onfocus="this.blur();">!diy_revocation!</a></span>
</p>
<ul id="controlnav">
<li id="navstart" class="current"><a href="javascript:" onclick="spaceDiy.getdiy('start');this.blur();return false;">!diy_start!</a></li>
<li id="navlayout"><a href="javascript:;" onclick="spaceDiy.getdiy('layout');this.blur();return false;">!diy_layout!</a></li>
<li id="navstyle"><a href="javascript:;" onclick="spaceDiy.getdiy('style');this.blur();return false;">!diy_style!</a></li>
<li id="navblock"><a href="javascript:;" onclick="spaceDiy.getdiy('block');this.blur();return false;">!diy_block!</a></li>
<li id="navdiy"><a href="javascript:;" onclick="spaceDiy.getdiy('diy');this.blur();return false;">!diy_dress!</a></li>
</ul>
</div>
<div id="controlcontent" class="cl">
<ul id="contentstart" class="content">
  <li><a href="javascript:;" onclick="spaceDiy.getdiy('layout');return false;"><img src="<?=STATICURL?>image/diy/layout.png" />!diy_layout_1!</a></li>
  <li><a href="javascript:;" onclick="spaceDiy.getdiy('style');return false;"><img src="<?=STATICURL?>image/diy/style.png" />!diy_style!</a></li>
  <li><a href="javascript:;" onclick="spaceDiy.getdiy('block');return false;"><img src="<?=STATICURL?>image/diy/module.png" />!diy_add_block!</a></li>
  <li><a href="javascript:;" onclick="spaceDiy.getdiy('diy', 'topicid', '<?=$topic['topicid']?>');return false;"><img src="<?=STATICURL?>image/diy/diy.png" />!do_it_yourself!</a></li>
</ul>
</div>
<div id="cpfooter"><table cellpadding="0" cellspacing="0" width="100%"><tr><td class="l">&nbsp;</td><td class="c">&nbsp;</td><td class="r">&nbsp;</td></tr></table></div>
</div>
<form method="post" autocomplete="off" name="diyform" action="home.php?mod=spacecp&amp;ac=index">
<input type="hidden" name="spacecss" value="" />
<input type="hidden" name="style" value="<?=$space['theme']?>" />
<input type="hidden" name="layoutdata" value="" />
<input type="hidden" name="currentlayout" value="<?=$userdiy['currentlayout']?>" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<input type="hidden" name="diysubmit" value="true"/>
</form>  <? } ?>
  <div id="virtual_body">
    <div class="topnav cl">
      <p class="y navinf">
      <? if($_G['uid']) { ?>
      <strong><a href="<?=DX_URL?>home.php?mod=space&uid=<?=$_G['uid']?>" class="vwmy" target="_blank" title="访问我的空间"><span class="user-bar-nick"><? if($_G['member']['nickname']) { ?><?=$_G['member']['nickname']?><? } else { ?><?=$_G['member']['username']?><? } ?></span>(<?=$_G['uid']?>)</a></strong>
      <? if($_G['group']['allowinvisible']) { ?><span id="loginstatus" class="xg1"><a href="<?=DX_URL?>member.php?mod=switchstatus" title="切换在线状态" onClick="ajaxget(this.href, 'loginstatus');doane(event);"><? if($_G['session']['invisible']) { ?>隐身<? } else { ?>在线<? } ?></a></span><? } ?>
      <span class="pipe">|</span><span id="myspace" class="xg1 showmenu" onMouseOver="showMenu(this.id);"><a target="_blank" href="<?=DX_URL?>home.php?mod=space&do=home">我的中心</a></span>
      <span class="pipe">|</span><span id="usersetup" class="xg1 showmenu" onMouseOver="showMenu(this.id);"><a target="_blank" href="<?=DX_URL?>home.php?mod=spacecp">设置</a></span>
      <span class="pipe">|</span><a target="_blank" href="<?=DX_URL?>home.php?mod=space&do=notice" id="myprompt"<? if($_G['member']['newprompt']) { ?> class="new"<? } ?>>提醒<? if($_G['member']['newprompt']) { ?>(<?=$_G['member']['newprompt']?>)<? } ?></a><span id="myprompt_check"></span>
      <span class="pipe">|</span><a target="_blank" href="<?=DX_URL?>home.php?mod=space&do=pm" id="pm_ntc"<? if($_G['member']['newpm']) { ?> class="new"<? } ?>>短消息<? if($_G['member']['newpm']) { ?>(<?=$_G['member']['newpm']?>)<? } ?></a>
      <? if($_G['group']['allowmanagearticle'] || $_G['group']['allowdiy'] || in_array($_G['uid'], $_G['setting']['ext_portalmanager'])) { ?><span class="pipe">|</span><a target="_blank" href="<?=DX_URL?>portal.php?mod=portalcp">门户管理</a><? } ?>
      <? if($_G['uid'] && $_G['group']['radminid'] > 1) { ?><span class="pipe">|</span><a href="<?=DX_URL?>forum.php?mod=modcp&fid=<?=$_G['fid']?>" target="_blank"><?=$_G['setting']['navs']['2']['navname']?>管理</a><? } ?>
      <? if($_G['uid'] && ($_G['group']['radminid'] == 1 || $_G['member']['allowadmincp'])) { ?><span class="pipe">|</span><a href="<?=DX_URL?>admin.php" target="_blank">管理中心</a><? } ?>
      <span class="pipe">|</span><a href="<?=DX_URL?>member.php?mod=logging&action=logout&formhash=<?=FORMHASH?>">退出</a>
      <? } elseif(!empty($_G['cookie']['loginuser'])) { ?>
      <strong><a id="loginuser"><?=$_G['cookie']['loginuser']?></a></strong>
      <span class="pipe">|</span><a href="<?=DX_URL?>member.php?mod=logging&action=login" onClick="showWindow('login', this.href);hideWindow('register');">激活</a>
      <span class="pipe">|</span><a href="<?=DX_URL?>member.php?mod=logging&action=logout&formhash=<?=FORMHASH?>">退出</a>
      <? } else { ?>
      <a href="<?=DX_URL?>member.php?mod=<?=$_G['setting']['regname']?>" onClick="showWindow('register', this.href);hideWindow('login');"><?=$_G['setting']['reglinkname']?></a>
      <span class="pipe">|</span><a href="<?=DX_URL?>member.php?mod=logging&action=login" onClick="showWindow('login', this.href);hideWindow('register');">登录</a>
      <? } ?>
      </p>
      <ul class="cl">
        <li class="navlogo"><a target="_blank" href="http://www.huoshow.com/" title="<?=$_G['setting']['bbname']?>"><?=$_G['setting']['bbname']?></a></li>
        <li><span id="navs" class="xg1 showmenu" onMouseOver="showMenu(this.id);"><a target="_blank" href="<?=DX_URL?>home.php?mod=space&do=home">返回首页</a></span></li>
      </ul>
    </div>

    <div id="space_body">
      <div id="hd" class="wp cl">
        <h2 id="spaceinfoshow">
          <?php space_merge($space, 'field_home'); $space[domainurl] = space_domain($space); ?>          <strong id="spacename" class="mbn">
          <? if($_GET['module'] == 'weibo') { ?>
          	<em class="nick_<?=$space['uid']?>">
          	<? if($space['spacename']) { ?><?=$space['spacename']?><? } else { ?>
              	<? if($space['nickname']) { ?><?=$space['nickname']?><? } else { ?><?=$space['username']?><? } ?></em>的个人主页
              <? } ?>
          <? } else { ?>
          	<? if($_G['mod'] == 'huoshow') { ?>
          	<em class="nick_<?=$space['uid']?>">
          	<? if($space['spacename']) { ?><?=$space['spacename']?><? } else { ?>
              	<? if($space['nickname']) { ?><?=$space['nickname']?><? } else { ?><?=$space['username']?><? } ?></em>的直播房间
              <? } ?>
          <? } else { ?>
          	<em class="owner-nick">
              <? if($space['spacename']) { ?><?=$space['spacename']?><? } else { ?>
              	<? if($space['nickname']) { ?><?=$space['nickname']?><? } else { ?><?=$space['username']?><? } ?></em>的直播房间
              <? } ?>
          <? } ?>
          <? } ?>
            <? if(!$space['self']) { ?><a class="oshr xs1 xw0" onClick="showWindow(this.id, this.href, 'get', 0);" id="share_space" href="<?=DX_URL?>home.php?mod=spacecp&ac=share&type=space&id=<?=$space['uid']?>">分享</a><? } ?>
          </strong>
          <? if($_GET['module'] == 'weibo') { ?>
          	<a id="domainurl" href=<?=DX_URL?><?=$space['uid']?> onClick="javascript:setCopy('<?=DX_URL?><?=$space['uid']?>', '复制');return false;" class="xs0 xw0"><?=DX_URL?><?=$space['uid']?></a> 
          <? if($space['self']) { ?>&nbsp;&nbsp;<a id="domainurl" href="<?=DX_URL?><?=$space['uid']?>" onClick="javascript:setCopy('<?=DX_URL?><?=$space['uid']?>', '复制');return false;" class="xs0 xw0">[复制]</a><? } ?>
          <? } else { ?>
          	<? if($_G['mod'] == 'huoshow') { ?>
          <a id="domainurl" href=<?=DX_HUOSHOW_SHOW_URL?>mv<?=$space['uid']?> onClick="javascript:setCopy('<?=DX_HUOSHOW_SHOW_URL?>mv<?=$space['uid']?>', '复制');return false;" class="xs0 xw0"><?=DX_HUOSHOW_SHOW_URL?>mv<?=$space['uid']?></a> 
          <? if($space['self']) { ?>&nbsp;&nbsp;<a id="domainurl" href="<?=DX_HUOSHOW_SHOW_URL?>mv<?=$space['uid']?>" onClick="javascript:setCopy('<?=DX_HUOSHOW_SHOW_URL?>mv<?=$space['uid']?>', '复制');return false;" class="xs0 xw0">[复制]</a><? } ?>
          <? } else { ?>
          <a id="domainurl" href=<?=DX_HUOSHOW_SHOW_URL?><?=$space['uid']?> onClick="javascript:setCopy('<?=DX_HUOSHOW_SHOW_URL?><?=$space['uid']?>', '复制');return false;" class="xs0 xw0"><?=DX_HUOSHOW_SHOW_URL?><?=$space['uid']?></a> 
          <? if($space['self']) { ?>&nbsp;&nbsp;<a id="domainurl" href="<?=DX_HUOSHOW_SHOW_URL?><?=$space['uid']?>" onClick="javascript:setCopy('<?=DX_HUOSHOW_SHOW_URL?><?=$space['uid']?>', '复制');return false;" class="xs0 xw0">[复制]</a><? } ?>
          <? } ?>
          <? } ?>
         	
          <span id="spacedescription" class="xs1 xw0 mtn"><?=$space['spacedescription']?></span>
        </h2>
        <div id="nv" style="overflow:visible;">
          <ul >
            <li id="zhibostatus"><img src="/static2/images/live_online.gif" /><a href="<?=DX_HUOSHOW_SHOW_URL?><?=$space['uid']?>" target="_blank">直播房间</a></li>
            <li><a href="<?=DX_URL?><?=$space['uid']?>" target="_blank">个人微博</a></li>
            <li><a href="<?=DX_URL?>home.php?mod=space&uid=<?=$space['uid']?>&do=blog&view=me&from=space" target="_blank">日志</a></li>
            <li><a href="<?=DX_URL?>home.php?mod=space&uid=<?=$space['uid']?>&do=album&view=me&from=space" target="_blank">相册</a></li>
            <? if($_G['setting']['allowviewuserthread'] !== false) { ?>
            <li><a href="<?=DX_URL?>home.php?mod=space&uid=<?=$space['uid']?>&do=thread&view=me&from=space" target="_blank">主题</a></li>
            <? } ?>
            <li><a href="<?=DX_URL?>home.php?mod=space&uid=<?=$space['uid']?>&do=share&view=me&from=space" target="_blank">分享</a></li>
            <li><a href="<?=DX_URL?>home.php?mod=space&uid=<?=$space['uid']?>&do=friend&view=me&from=space" target="_blank">好友</a></li>
            <li><a href="<?=DX_URL?>home.php?mod=space&uid=<?=$space['uid']?>&do=wall" target="_blank">留言板</a></li>    
          </ul>
        </div>
      </div>

      <? if(!empty($_G['setting']['plugins']['jsmenu'])) { ?>
      <ul class="p_pop h_pop" id="plugin_menu" style="display: none">
        <? if(is_array($_G['setting']['plugins']['jsmenu'])) foreach($_G['setting']['plugins']['jsmenu'] as $module) { ?>        <? if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?>
        <li><?=$module['url']?></li>
        <? } ?>
        <? } ?>
      </ul>
      <? } ?>
      <?=$_G['setting']['menunavs']?>

      <?php $mnid = getcurrentnav(); ?>      <ul id="navs_menu" class="p_pop topnav_pop" style="display:none;">
        <? if(is_array($_G['setting']['navs'])) foreach($_G['setting']['navs'] as $nav) { ?>        <?php $nav_showmenu = strpos($nav['nav'], 'onmouseover="showMenu('); ?>        <?php $nav_navshow = strpos($nav['nav'], 'onmouseover="navShow(') ?>        <? if($nav_hidden !== false || $nav_navshow !== false) { ?>
        <?php $nav['nav'] = preg_replace("/onmouseover\=\"(.*?)\"/i", '',$nav['nav']) ?>        <? } ?>
        <? if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { ?><li target="_blank" <?=$nav['nav']?>></li><? } ?>
        <? } ?>
      </ul>
      <ul id="myspace_menu" class="p_pop" style="display:none;">
        <li><a target="_blank" href="<?=DX_URL?><?=$_G['uid']?>">我的中心</a></li>
      </ul>



<div class="clean" id="clean"></div>

<object type="application/x-shockwave-flash" style="position:absolute; width:200px; height:200px; left:-99999em;" 
  data="/huoshow/flash/chat.swf?<?=VERHASH?>" name="chat_client" id="chat_client">
  <param value="/huoshow/flash/chat.swf?<?=VERHASH?>" name="movie">
  <param value="always" name="allowScriptAccess">
  <param name="flashvars" value="roomId=<?=$space['uid']?>">
</object>

<script>
  var ENV = {
    chatServerHost: '<?=MUTIL_ROOM_SERVER_P_HOST?>',
    chatServerPort: '<?=MUTIL_ROOM_SERVER_P_PORT?>',

    roomType: "<?=$roomType?>",
    roomId: '<?=$space['uid']?>',

    ownerId: '<?=$space['uid']?>',
    ownerName: '<? if($space['nickname']) { ?><?=$space['nickname']?><? } else { ?><?=$space['username']?><? } ?>',

    userId: '<?=$_G['uid']?>',
    userType: '<?=$usertype?>',
    userName: '<? if($_G['member']['nickname']) { ?><?=$_G['member']['nickname']?><? } else { ?><?=$_G['username']?><? } ?>',

    liveServer: '<?=FMS_SERVER?>',
    liveId: '<?=$live_uid?>'
  };
  ENV.giftFiles = {};
  <? if(is_array($giftType)) foreach($giftType as $key => $value) { ?>  <? if(is_array($giftList[$value['typeid']])) foreach($giftList[$value['typeid']] as $k => $v) { ?>  ENV.giftFiles["<?=$v['giftid']?>"] = "<?=$v['image']?>";
  <? } ?>
  <? } ?>
</script>

<div class="wrap wp w cl">
    <div id="live_body"><?php require_once(DISCUZ_ROOT."huoshow/module/".$module."/".$module."_".$op.".php"); if($module==weibo) { ?>﻿</div>
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

<? } else { ?>﻿</div>
<div id="gift_price_box">&nbsp;</div><div id="notice_box">
  <iframe src="javascript:'';" frameborder="0" scrolling="no" style="width:100%;height:100%;position:absolute;"></iframe>
  <div class="notice-box-body">
    <div id="notices_t">
      <div id="notices_ex">
        <iframe id="notices_ex_if" src="javascript:'';" frameborder="0" scrolling="no" style="width:100%;position:absolute;"></iframe>
        <ul id="notices"></ul>
      </div>
      <div class="notices-ex-button">
        <iframe src="javascript:'';" frameborder="0" scrolling="no" style="width:100%;height:100%;position:absolute;"></iframe>
        <em>&nbsp;</em>
      </div>
    </div>
    <label>公告</label>
    <p id="notice_first">暂无公告</p>
  </div>
</div>
﻿</div>
<div class="clear"></div>
<? if(empty($topic) || ($topic['usefooter'])) { ?><?php $focusid = getfocus_rand($_G[basescript]); if($focusid !== null) { ?><?php $focus = $_G['cache']['focus']['data'][$focusid]; ?><div class="focus" id="sitefocus">
  <h3 class="flb">
    <em><? if($_G['cache']['focus']['title']) { ?><?=$_G['cache']['focus']['title']?><? } else { ?>站长推荐<? } ?></em>
    <span><a href="javascript:;" onclick="setcookie('nofocus_<?=$focusid?>', 1, 86400);$('sitefocus').style.display='none'" class="flbc" title="关闭">关闭</a></span>
  </h3>
  <hr class="l" />
  <div class="detail">
    <h4><a href="<?=$focus['url']?>" target="_blank"><?=$focus['subject']?></a></h4>
    <p>
    <? if($focus['image']) { ?>
    <a href="<?=$focus['url']?>" target="_blank"><img src="<?=$focus['image']?>" onload="thumbImg(this, 1)" _width="58" _height="58" /></a>
    <? } ?>
    <?=$focus['summary']?>
    </p>
  </div>
  <hr class="l" />
  <a href="<?=$focus['url']?>" class="moreinfo" target="_blank">查看</a>
</div>
<? } ?><?php echo adshow("footerbanner/wp a_f/1"); ?><?php echo adshow("footerbanner/wp a_f/2"); ?><?php echo adshow("footerbanner/wp a_f/3"); ?><?php echo adshow("float/a_fl/1"); ?><?php echo adshow("float/a_fr/2"); ?><?php echo adshow("couplebanner/a_fl a_cb/1"); ?><?php echo adshow("couplebanner/a_fr a_cb/2"); ?><?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; ?>
<style>
  .footer_txt{color: #999999;}
  .footer_txt a{color: #999999;}
</style>
<div class="footer">
  <div id="footer_bg">		
    <div class="footer_txt"> <a target="_blank" href="<?=WWW_URL?>about/about.shtml">关于火秀</a> | <a target="_blank" href="<?=WWW_URL?>about/advertising.shtml">广告服务</a> | <a target="_blank" href="<?=WWW_URL?>about/contact.shtml">联系我们</a> |  <a target="_blank" href="<?=WWW_URL?>about/partners.shtml">合作伙伴</a> | <a target="_blank" href="<?=WWW_URL?>about/joinus.shtml">诚聘英才</a>
      <p>www.huoshow.com 版权所有 粤ICP备06087881号</p>
    </div>
  </div>
</div>

<? } ?>

<ul id="usersetup_menu" class="p_pop" style="display:none;">
  <li><a target="_blank" href="<?=DX_URL?>home.php?mod=spacecp&ac=avatar">修改头像</a></li>
  <li><a target="_blank" href="<?=DX_URL?>home.php?mod=spacecp&ac=profile">个人资料</a></li>
  <? if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
  <li><a target="_blank" href="<?=DX_URL?><? if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<? } else { ?>home.php?mod=spacecp&ac=videophoto<? } ?>">认证</a></li>
  <? } ?>
  <li><a target="_blank" href="<?=DX_URL?>home.php?mod=spacecp&ac=credit">积分</a></li>
  <li><a target="_blank" href="<?=DX_URL?>home.php?mod=spacecp&ac=usergroup">用户组</a></li>
  <li><a target="_blank" href="<?=DX_URL?>home.php?mod=spacecp&ac=privacy">隐私筛选</a></li>
  <? if($_G['setting']['sendmailday']) { ?>
  <li><a target="_blank" href="<?=DX_URL?>home.php?mod=spacecp&ac=sendmail">邮件提醒</a></li>
  <? } ?>
  <li><a target="_blank" href="<?=DX_URL?>home.php?mod=spacecp&ac=profile&op=password">密码安全</a></li>
  <? if(!empty($_G['setting']['plugins']['spacecp'])) { ?>
  <? if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { ?>  <? if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<? if($_G['gp_id'] == $id) { ?> class="a"<? } ?>><a target="_blank" href="<?=DX_URL?>home.php?mod=spacecp&ac=plugin&id=<?=$id?>"><?=$module['name']?></a></li><? } ?>
  <? } ?>
  <? } ?>
</ul>

<? if($upgradecredit !== false) { ?>
<div id="g_upmine_menu" class="g_up" style="display:none;">
  <div class="crly">
    积分 <?=$_G['member']['credits']?>, 距离下一级还需 <?=$upgradecredit?> 积分
  </div>
  <div class="mncr"></div>
</div>
<? } if(!$_G['setting']['bbclosed']) { if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?>
<script src="home.php?mod=spacecp&ac=pm&op=checknewpm&rand=<?=$_G['timestamp']?>" type="text/javascript"></script>
<? } if(!isset($_G['cookie']['sendmail'])) { ?>
<script src="home.php?mod=misc&ac=sendmail&rand=<?=$_G['timestamp']?>" type="text/javascript"></script>
<? } } if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && (empty($do) || $do != 'index') && !empty($_G['style']['tplfile'])) { ?>
<script src="<?=$_G['setting']['jspath']?>common_diy.js?<?=VERHASH?>" type="text/javascript"></script>
<script src="<?=$_G['setting']['jspath']?>portal_diy.js?<?=VERHASH?>" type="text/javascript"></script>
<? } if($_GET['diy'] == 'yes' && $space['self'] && $_G['mod'] == 'space' && $do == 'index') { ?>
<script src="<?=$_G['setting']['jspath']?>common_diy.js?<?=VERHASH?>" type="text/javascript"></script>
<script src="<?=$_G['setting']['jspath']?>space_diy.js?<?=VERHASH?>" type="text/javascript"></script>
<? } if($_G['member']['newprompt'] && (empty($_G['cookie']['promptstate_'.$_G['uid']]) || $_G['cookie']['promptstate_'.$_G['uid']] != $_G['member']['newprompt']) && $_G['gp_do'] != 'notice') { ?>
<script>noticeTitle();</script>
<? } ?><?php output(); ?></div>

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

  hs.addListener(window, 'load', function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
  });
</script>
<span style="display:none;">
  <script src="http://s16.cnzz.com/stat.php?id=2692090&web_id=2692090" type="text/javascript"></script>
</span>

</div>
</body>
</html>
<? } ?>