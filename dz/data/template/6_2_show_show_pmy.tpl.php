<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('show_pmy');
0
|| checktplrefresh('./template/huoshow/show/show_pmy.htm', './template/huoshow/show/live_header.htm', 1333610318, '2', './data/template/6_2_show_show_pmy.tpl.php', './template/huoshow', 'show/show_pmy')
|| checktplrefresh('./template/huoshow/show/show_pmy.htm', './template/huoshow/show/player.htm', 1333610318, '2', './data/template/6_2_show_show_pmy.tpl.php', './template/huoshow', 'show/show_pmy')
|| checktplrefresh('./template/huoshow/show/show_pmy.htm', './template/huoshow/show/shareto.htm', 1333610318, '2', './data/template/6_2_show_show_pmy.tpl.php', './template/huoshow', 'show/show_pmy')
|| checktplrefresh('./template/huoshow/show/show_pmy.htm', './template/huoshow/show/gift.htm', 1333610318, '2', './data/template/6_2_show_show_pmy.tpl.php', './template/huoshow', 'show/show_pmy')
|| checktplrefresh('./template/huoshow/show/show_pmy.htm', './template/huoshow/show/personalinfo.htm', 1333610318, '2', './data/template/6_2_show_show_pmy.tpl.php', './template/huoshow', 'show/show_pmy')
|| checktplrefresh('./template/huoshow/show/show_pmy.htm', './template/huoshow/show/chat.htm', 1333610318, '2', './data/template/6_2_show_show_pmy.tpl.php', './template/huoshow', 'show/show_pmy')
|| checktplrefresh('./template/huoshow/show/show_pmy.htm', './template/huoshow/show/fans_rank.htm', 1333610318, '2', './data/template/6_2_show_show_pmy.tpl.php', './template/huoshow', 'show/show_pmy')
|| checktplrefresh('./template/huoshow/show/show_pmy.htm', './template/huoshow/show/live_footer.htm', 1333610318, '2', './data/template/6_2_show_show_pmy.tpl.php', './template/huoshow', 'show/show_pmy')
|| checktplrefresh('./template/huoshow/show/show_pmy.htm', './template/huoshow/home/space_live_header.htm', 1333610318, '2', './data/template/6_2_show_show_pmy.tpl.php', './template/huoshow', 'show/show_pmy')
|| checktplrefresh('./template/huoshow/show/show_pmy.htm', './template/huoshow/show/notice.htm', 1333610318, '2', './data/template/6_2_show_show_pmy.tpl.php', './template/huoshow', 'show/show_pmy')
|| checktplrefresh('./template/huoshow/show/show_pmy.htm', './template/huoshow/common/footer_1_5.htm', 1333610318, '2', './data/template/6_2_show_show_pmy.tpl.php', './template/huoshow', 'show/show_pmy')
|| checktplrefresh('./template/huoshow/show/show_pmy.htm', './template/huoshow/common/header_space_common.htm', 1333610318, '2', './data/template/6_2_show_show_pmy.tpl.php', './template/huoshow', 'show/show_pmy')
|| checktplrefresh('./template/huoshow/show/show_pmy.htm', './template/huoshow/home/space_diy.htm', 1333610318, '2', './data/template/6_2_show_show_pmy.tpl.php', './template/huoshow', 'show/show_pmy')
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
  <? if($space['self']) { ?><a id="diy-tg" href="<?=DX_URL?>home.php?mod=space&diy=yes&roomid=<?=$_G['uid']?>" title="装扮空间"><img src="<?=STATICURL?>image/diy/panel-toggle-space.png" alt="DIY" /></a><? } ?>
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
<link href="/static2/live_room.css?<?=VERHASH?>" rel="stylesheet" type="text/css" />
<link href="/static2/chat.css?<?=VERHASH?>" rel="stylesheet" type="text/css" />

<object type="application/x-shockwave-flash" style="position:absolute; width:200px; height:200px; left:-99999em;" 
  data="/static2/live/chat.swf?<?=VERHASH?>" name="chat_client" id="chat_client">
  <param value="/static2/live/chat.swf?<?=VERHASH?>" name="movie">
  <param value="always" name="allowScriptAccess">
  <param name="flashvars" value="roomId=<?=$space['uid']?>">
</object>

<script>
  var ENV = {
    chatServerHost: '<?=MSN_HOST?>',
    chatServerPort: '<?=MSN_PORT?>',

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
    <div id="live_body">
<div id="leftbf">
  <div id="dakuang">
    <div id="video_area">
      <div class="live-object-box">
  <object type="application/x-shockwave-flash" id="live_object"
    data="/static2/live/live_<? if($roomType == 0) { ?>s<? } else { ?>c<? } ?>.swf?<?=VERHASH?>">
    <param name="movie" value="/static2/live/live_<? if($roomType == 0) { ?>s<? } else { ?>c<? } ?>.swf?<?=VERHASH?>">
    <param name="quality" value="high">
    <param name="allowScriptAccess" value="always">
    <param value="true" name="allowFullScreen">
    <param name="wmode" value="Opaque">
    <param name="flashvars" value="liveUrl=rtmp://<?=FMS_SERVER?>/live&mediaName=<?=$live_uid?>&roomId=<?=$space['uid']?>">
  </object>
</div>

<div class="room-list">
  <div class="room-list-head"><span class="owner-nick"><? if($space['nickname']) { ?><?=$space['nickname']?><? } else { ?><?=$space['username']?><? } ?></span>：表演已结束，您可以到其他地方看看</div>
  <div class="room-list-body">
    <div class="items" id="room_list">&nbsp;</div>
  </div>
  <div class="room-list-foot">
    <a href="/"><img src="/static2/images/back.png" /></a>
  </div>
</div>
    </div>
    <div class="owner-toolbar">		
      <span style="float:right;">	
        <a href="javascript:;" onclick="setRoomBg()"><img src="/static2/images/setbg.gif"></a> 
        <a href="javascript:;" onclick="setNotice()"><img src="/static2/images/setnotice.gif"></a>			
      </span>
      <div class="shareto-bar">
  <span>分享到：</span>
  <script>
    (function(){
      var url=location.href;
      var title='大家好，我正在火秀直播上观看 ['+ ENV.ownerName +'] 的精彩直播，邀请大家强势围观。';

      var shareList = [];
      shareList.push([['http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=', url,
      '&title=', encodeURIComponent(title)].join(''), 'static2/images/share/qzone.gif']);
      shareList.push([['http://service.weibo.com/share/share.php?url=', url,
      '&title=', encodeURIComponent(title)].join(''), 'static2/images/share/sina.gif']);
      shareList.push([['http://v.t.qq.com/share/share.php?url=', url,
      '&title=', encodeURIComponent(title)].join(''), 'static2/images/share/qqmblog.gif']);
      shareList.push([['http://www.douban.com/recommend/?url=', url,
      '&title=', encodeURIComponent(title)].join(''), 'static2/images/share/douban.gif']);
      shareList.push([['http://share.renren.com/share/buttonshare.do?url=', url,
      '&title=', encodeURIComponent(title)].join(''), 'static2/images/share/renren.gif']);
      shareList.push([['http://www.kaixin001.com/repaste/share.php?url=', url,
      '&title=', encodeURIComponent(title)].join(''), 'static2/images/share/kaixin.gif']);
      shareList.push([['http://t.163.com/article/user/checkLogin.do?link=', url,
      '&info=', encodeURIComponent(title)].join(''), 'static2/images/share/163.gif']);
      shareList.push([['http://t.sohu.com/third/post.jsp?url=', url,
      '&content=UTF-8&title=', encodeURIComponent(title)].join(''), 'static2/images/share/sohu.gif']);
      shareList.push([['http://cang.baidu.com/do/add?iu=', url,
      '&it=', encodeURIComponent(title)].join(''), 'static2/images/share/baidu.gif']);
      var html = [];
      for(var i=0, l=shareList.length; i<l; i++){
        html.push('<a target="_blank" href="');
          html.push(shareList[i][0]);
          html.push('"><img src="');
          html.push(shareList[i][1]);
          html.push('"/></a>\n');
      }
      document.write(html.join(''));
    })();
  </script>
</div>
    </div>
    <a href="http://get.adobe.com/cn/flashplayer/" target="_blank" id="flash_update_link">让直播更清晰，更流畅？点击升级Flash播放器</a>
    <div id="gift_bar">
  <div id="gift_box">
    <iframe src="javascript:'';" style="width:100%; height:100%;position:absolute;" frameborder="0" scrolling="no"></iframe>
    <div class="gift-box-bg">
      <div class="gift-box-body" id="gift_box_body">
        <div class="loading"><span>&nbsp;</span></div>
      </div>
      <div class="gift-box-foot">
        <span class="coin">火币：<em id="hcoin">0</em></span>
      </div>
    </div>
  </div>

  <div id="gift_bar_b">
    <input id="giftid" type="hidden" name="giftid" value="" />
    <input id="targetuid" name="targetuid" type="hidden" value="<?=$space['uid']?>" />
    挑选&nbsp;
    <input type="button" id="imageField2" value="礼物盒子" onclick="showGiftBox('<?=$space['uid']?>');" />
    数量&nbsp;<input id="giftnum" name="giftnum" type="text" class="shurkuang" size="1" maxlength="2" value="1" />
    赠给&nbsp;<input type="text" id="target_name" value="<? if($space['nickname']) { ?><?=$space['nickname']?><? } else { ?><?=$space['username']?><? } ?>" readonly="true" />&nbsp;<button onclick="givegift();" class="send">&nbsp;</button>
    &nbsp;<a href="home.php?mod=space&amp;do=pay" target="_blank" class="pay">充值</a>
  </div>

</div>
    <div class="owner-vote-bar">
      <div class="set-vote-button">
        <a href="javascript:;" id="canVoteStatus"><img src="/static2/images/vote_start.gif" onclick="startVote();"></a>
      </div>
      <div class="vote-values">
        <table>
          <tr>
            <td>魅力值：</td><td><span id="charm_value">－</span></td>
            <td>魅力之星：</td><td><span id="vote_value">－</span></td>
          </tr>
          <tr>
            <td>魅力指数：</td><td><span id="score_value">－</span></td>
            <td>当前排名：</td><td><span id="paiming_value">－</span></td>
          </tr>
        </table>
      </div>
    </div>

    <? if($_G['uid'] == $space['uid'] || $usertype == 1) { ?>
<div style="margin-top:10px;">
  <span style="color:#FF1063;margin-left:7px;">活跃天数：</span>
 <? if($active['active'] == '') { ?>0天
 <? } else { ?><?=$active['active']?>&nbsp;天&nbsp;
  <? } ?>
  <span style="color:#FF1063;padding-left:10px;">比赛时长：</span>
  <? if($month_time == '') { ?>00:00:00
  <? } else { ?><?=$month_time?>
  <? } ?>
</div>
<? } ?>

<div style="clear:both;"></div>

<div id="owner_info">
  <div id="grxingxkuang">
<div class='xunzhang'>
<span>勋章：</span>
<? if($hoormedal) { if(is_array($hoormedal)) foreach($hoormedal as $key => $value) { if($value['medalid'] > 10) { ?>
<img title="<?=$value['description']?>" src="static/image/common/<?=$value['image']?>" width="38px" height="52px"/>
<? } } } else { ?>
您没有获得勋章
<? } ?>
</div>
    <div class="jiangbt">个人简介</div>
    <div class="mykuang">
      <div class="mykuang-l">
        <a target="_blank" href=<?=DX_URL?><?=$space['uid']?> class="avatar"><img src="<?=$avatar?>" class="avatar"/></a>
        <p>
        <img src="static/image/common/pt_icn.png"/>
        <a href="<?=DX_URL?><?=$space['uid']?>" target="_blank">访问Ta的空间</a>
        </p>
      </div>
      <ul>
        <li style="width:350px;">
        <span class="text5 owner-nick"><? if($space['nickname']) { ?><?=$space['nickname']?><? } else { ?><?=$space['username']?><? } ?></span>
        </li>
        <li>
        <span class="textm">明星等级：</span>
          <? if($charl[$chartmLevel['level']]['valuelower'] < $anchorInfo['charm']) { ?>
          	<span onmouseout="this.className=''" onmouseover="this.className='hover'" style="position:relative;">
          	<strong> <span style="width:100%;" class="column" id="col1">100%</span> </strong>
          	<span class="col_tips">魅力值:<?=$anchorInfo['charm']?></span>
          	</span>
          	<img src="static2/images/charmlevel/<? echo $chartmLevel['level']; ?>.png" />
          <? } else { ?>
          	<img src="static2/images/charmlevel/<?=$chartmLevel['level']?>.png"/>
        	<span onmouseout="this.className=''" onmouseover="this.className='hover'" style="position:relative;">
          	<strong> <span style="width:<?=$charzhi?>%;" class="column" id="col1"><?=$charzhi?>%</span> </strong>
          	<span class="col_tips">魅力值:<?=$anchorInfo['charm']?> 距离升级还需 <?=$char?> 魅力值</span>
          	</span>
          	<img src="static2/images/charmlevel/<? echo $chartmLevel['level']+1; ?>.png" style="opacity:<? echo 0.2+(1-0.2)*($charzhi/100); ?>;filter:alpha(opacity=<? echo 20+(1-0.2)*$charzhi; ?>);" />
          <? } ?>
        </li>
        <li>
        <span class="textm"> 富豪等级：</span>
          <? if($huol[$huoshowlevel['level']]['valuelower'] < $anchorInfo['huoshow']) { ?>
          	<span onmouseout="this.className=''" onmouseover="this.className='hover'" style="position:relative;">
          	<strong> <span style="width: 100%;" class="column" id="col1">100%</span> </strong>
          	<span class="col_tips">豪爽度:<?=$anchorInfo['huoshow']?></span>
          	</span>
        	<img src="static2/images/huoshowlevel/<? echo $huoshowlevel['level']; ?>.png" />
          <? } else { ?>
          	<img src="static2/images/huoshowlevel/<?=$huoshowlevel['level']?>.png"/>
        	<span onmouseout="this.className=''" onmouseover="this.className='hover'" style="position:relative;">
          	<strong> <span style="width: <?=$huozhi?>%;" class="column" id="col1"><?=$huozhi?>%</span> </strong>
          	<span class="col_tips">豪爽度:<?=$anchorInfo['huoshow']?> 距离升级还需消费  <?=$huoshow?> 火币</span>
          	</span>
        	<img src="static2/images/huoshowlevel/<? echo $huoshowlevel['level']+1; ?>.png" style="opacity:<? echo 0.2+(1-0.2)*($huozhi/100); ?>;filter:alpha(opacity=<? echo 20+(1-0.2)*$huozhi; ?>);" />
          <? } ?>
        </li>

        <li style="float:left; width:80px;">
        性别：<? if($space['gender']==0) { ?>保密<? } if($space['gender']==1) { ?>男<? } if($space['gender']==2) { ?>女<? } ?>
        <? if(!empty($space['resideprovince'])) { ?>
        </li>
        <li style="float:left;">
        居住城市：<?=$space['resideprovince']?><? if(!empty($space['residecity'])) { ?>--<?=$space['residecity']?><? } } ?>
        </li>
      </ul>
    </div>

  </div>

  <? if(!empty($space['spacenote'])) { ?>
  <div>
    <div class="jiangbt">个性签名</div>
    <div class="text6"><?=$space['spacenote']?>&nbsp;</div>
  </div>
  <? } ?>
</div>


<div class="gift">
  <? if($isGiftBag > 0) { ?>
  <div class="jiangbt">神秘礼物排名</div>
  <div>
  	<ul>
  <? if(is_array($openmysticalgift)) foreach($openmysticalgift as $k => $value) { ?>  <li>
  <img src="/static2/images/gift/<? echo $value['img']; ?>" title="价格：<?=$value['giftprice']?>火币/个"/>
  		<span class="tming">
<?=$value['party_gift_name']?></span><br>
  		<span class="dming"><?=$value['gift_num']?>(第<?=$value['top']?>名)</span>
  </li>
  <? } ?>
</ul>
  </div>
  <? } ?>
  <div style="clear:both;"></div>
  <div class="jiangbt">普通礼物排名</div>
  <div id="mod_gift_body">
    <div class="loading"><span>&nbsp;</span></div>
  </div>
  <div style="clear:both;">&nbsp;</div>
</div>

<div style="display:none">
  <p class="jiangbt">我的动态</p>
  <? if(is_array($list)) foreach($list as $day => $values) { ?>  <? if($_GET['view']!='hot') { ?>
  <h4 class="et">
    <? if($day=='yesterday') { ?>!yesterday!
    <? } elseif($day=='today') { ?>!today!
    <? } else { ?><?=$day?>
    <? } ?>
  </h4>
  <? } ?>
  <ul class="el">
    <? if(is_array($values)) foreach($values as $value) { ?>    <? include template('home/space_feed_li'); ?>    <? } ?>
  </ul>
  <? } ?>
</div>
<!--动态信息--><? include template('show/show_user_dynamic'); ?>  </div>

</div>

<div id="rightlt">
  <div class="chat" id="chat">
  <table width="100%">
    <tr style="vertical-align: top;">
      <td width="100%">
        <div id="chat_msgbox">
          <div style="position:relative;">
            <a href="<?=DX_HUOSHOW_SHOW_URL?>" target='_blank'
              style="position:absolute;top:5px;right:5px;"><img src='/static2/images/gohome_1.gif' /></a>
          </div>
          <h3 class="tab-a">聊天</h3>

          <div class="room-notice-bar">
            <div class="room-notice-label">【直播间公告】：</div>

            <div class="room-notice-message">
              <marquee scrolldelay="98" scrollamount="1" onmouseover="this.stop();" onmouseout="this.start();">
              <span id="room_notice">
              <? if($notice) { ?>
                <? if($notice['roomnotice_link']) { ?>
                <a href="<?=$notice['roomnotice_link']?>" target="_blank">
                  <? } ?>

                  <? if($notice['roomnotice']) { ?> <?=$notice['roomnotice']?>
                  <? } else { ?> 欢迎来到 <? if($space['nickname']) { ?> <?=$space['nickname']?> <? } else { ?> <?=$space['username']?> <? } ?> 的直播间 <? } ?>

                  <? if($notice['roomnotice_link']) { ?>
                </a>
                <? } ?>
              <? } ?>
              </span>
              </marquee>
            </div>

          </div>
          <div id="chat_log_box" class="tab-b">

            <div id="chat_log1_w">
              <div id="message_list"></div>
            </div>

            <div id="chat_log2_w">
              <div id="my_message_list">

                <div class="mt-sys">
                  <p><? if(!$_G['uid']) { ?>欢迎来到<? if($space['nickname']) { ?><?=$space['nickname']?><? } else { ?><?=$space['username']?><? } ?>的直播间。 请&nbsp;<a onclick="showWindow('login', this.href);hideWindow('register');" href="<?=DX_URL?>member.php?mod=logging&amp;action=login">登录</a>&nbsp;或&nbsp;<a onclick="showWindow('register', this.href);hideWindow('login');" href="<?=DX_URL?>member.php?mod=register">注册</a>&nbsp;，与<? if($space['nickname']) { ?><?=$space['nickname']?><? } else { ?><?=$space['username']?><? } ?>进行交流和互动。<? } ?></p>
                  <? if($notice['s_roomnotice']) { ?>
                  <p><? if($space['nickname']) { ?><?=$space['nickname']?><? } else { ?><?=$space['username']?><? } ?>:
                  <a href="
                    <? if($notice['s_roomnotice_link']) { ?><?=$notice['s_roomnotice_link']?>" target="_blank" 
                    <? } else { ?>javascript:;"
                    <? } ?> >
                    <?=$notice['s_roomnotice']?> <?=$notice['s_roomnotice_link']?>
                  </a>
                  <? } else { ?>
                  <? if($space['nickname']) { ?><?=$space['nickname']?><? } else { ?><?=$space['username']?><? } ?>:
                  记得送我礼物哦，火币不足的话可以点这里
                  <a href="<?=DX_URL?>home.php?mod=space&do=pay&view=me" target="_blank">充值</a>
                  或者完成简单
                  <a href="<?=DX_URL?>home.php?mod=task&item=new" target="_blank">任务</a>
                  免费挣火币。谢谢哦！
                  </p>
                  <? } ?>
                </div>

              </div>
            </div>
          </div>

        </div>
      </td>
      <td class="splitter-v">
        <a href="javascript:;" onclick="chat.onlineListShowHide();return false;">&nbsp;</a>
      </td>
      <td id="online_box">
        <div id="online_box_w">
          <div id="online_box_w_b">
            <h3>观众(<span id="onlineNum">0</span>)</h3>
            <div id="onlineUsers"></div>
          </div>
        </div>
      </td>
    </tr>
  </table>

  <div id="chat-form-w">
    <div id="chat-form">
      <div class="chat-form-tools">
        <table width="100%">
          <tr>
            <td class="tool-item" id="btn_audience-list">
              <div id="users_label">所有人</div>
              <div class="pop-b" id="audience-list"></div>
            </td>
            <td class="tool-item" style="display:none;">
              <div>
                <label for="isPrivate"><input type="checkbox" value="false" id="isPrivate" />&nbsp;悄悄话</label>
              </div>
            </td>
            <td class="tool-item" id="btn_face">
              <div>
                <a href="javascript:;" onclick="return false;" class="btn-face">&nbsp;</a>
                <div class="pop-b" id="face_box">
                  <div class="loading"><span>&nbsp;</span></div>
                </div>
              </div>
            </td>
            <td width="100%">
              <a href="javascript:;" onclick="chat.clap();return false;">喝彩</a>
            </td>
            <td>
              <div style="white-space:nowrap;">
                <a href="javascript:;" onclick="chat.setAutoScroll(this);return false;">停止滚屏</a>&nbsp;|&nbsp;
                <a href="javascript:;" onclick="chat.clearLog();return false;">清屏</a>
              </div>
            </td>
          </tr>
        </table>
      </div>

      <div class="chat-form-input">
        <table width="100%">
          <tr>
            <td width="100%">
              <div class="input-message">
                <input type="text" id="inputMessage" />
              </div>
            </td>
            <td style="padding-left:5px;">
              <a href="javascript:;" onclick="chat.send();return false;" class="hs-button"><span>发送消息</span></a>
            </td>
          </tr>
        </table>
      </div>

    </div>
  </div>
</div> 
  <div class="jianju"></div>
  <div class="room-mod" id="fans_rank">
  <div class="room-mod-head">
    <ul class="fans-rank-tabs">
      <li onclick="getFansRankDay();">本场粉丝榜</li>
      <li onclick="getFansRankMonth();" class="curr">最近30天粉丝榜</li>
      <li onclick="getFansRankAll();">总粉丝榜</li>
    </ul>
  </div>
  <div class="room-mod-body">
    <div id="fans_list_day" class="fans-rank-list">&nbsp;</div>
    <div id="fans_list_month" class="fans-rank-list"><div class="loading"><span></span></div></div>
    <div id="fans_list_total" class="fans-rank-list"><div class="loading"><span></span></div></div>
  </div>
</div>
</div>

<div class="clear"></div>
    </div>
    ﻿</div>
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
<script src="/static2/js/jquery-ui.min.js?<?=VERHASH?>" type="text/javascript"></script>
<script src="/static2/js/hui.js?<?=VERHASH?>" type="text/javascript"></script>
<script src="/static2/live/chat.js?<?=VERHASH?>" type="text/javascript"></script>