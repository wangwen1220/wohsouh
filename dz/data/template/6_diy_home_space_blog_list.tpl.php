<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_blog_list');
0
|| checktplrefresh('./template/huoshow/home/space_blog_list.htm', './template/huoshow/home/space_header.htm', 1333602171, 'diy', './data/template/6_diy_home_space_blog_list.tpl.php', './template/huoshow', 'home/space_blog_list')
|| checktplrefresh('./template/huoshow/home/space_blog_list.htm', './template/huoshow/common/userabout.htm', 1333602171, 'diy', './data/template/6_diy_home_space_blog_list.tpl.php', './template/huoshow', 'home/space_blog_list')
|| checktplrefresh('./template/huoshow/home/space_blog_list.htm', './template/huoshow/home/space_userabout.htm', 1333602171, 'diy', './data/template/6_diy_home_space_blog_list.tpl.php', './template/huoshow', 'home/space_blog_list')
|| checktplrefresh('./template/huoshow/home/space_blog_list.htm', './template/huoshow/common/header_space_common.htm', 1333602171, 'diy', './data/template/6_diy_home_space_blog_list.tpl.php', './template/huoshow', 'home/space_blog_list')
|| checktplrefresh('./template/huoshow/home/space_blog_list.htm', './template/huoshow/home/space_diy.htm', 1333602171, 'diy', './data/template/6_diy_home_space_blog_list.tpl.php', './template/huoshow', 'home/space_blog_list')
;?>
<?php $_G[home_tpl_spacemenus][] = "<a href=\"home.php?mod=space&amp;uid=$space[uid]&amp;do=blog&amp;view=me\">TA的所有日志</a>";
$friendsname = array(1 => '仅好友可见',2 => '指定好友可见',3 => '仅自己可见',4 => '凭密码可见'); if(empty($diymode)) { include template('common/header'); ?><div id="pt" class="bm cl"><!-- common/simplesearchform --><div class="z">
<a href="./" class="nvhm" title="首页"><?=$_G['setting']['bbname']?></a> <em>&rsaquo;</em>
<a href="home.php"><?=$_G['setting']['navs']['4']['navname']?></a> <em>&rsaquo;</em> 
<a href="home.php?mod=space&amp;do=blog">日志</a>
<? if($_GET['view']=='me') { ?>
 <em>&rsaquo;</em> <a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=blog&amp;view=me"><?=$space['nickname']?>的日志</a>
<? } ?>
</div>
</div>

<style id="diy_style" type="text/css"></style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>

<div id="ct" class="ct2_a wp cl">
<div class="mn">
<!--[diy=diycontenttop]--><div id="diycontenttop" class="area"></div><!--[/diy]-->
<div class="bm bw0">
<? if((!$_G['uid'] && !$space['uid']) || $space['self']) { ?>
<h1 class="mt"><img alt="blog" src="<?=STATICURL?>image/feed/blog.gif" class="vm" /> 日志</h1>
<? } if($space['self']) { ?>
<ul class="tb cl">
<li<?=$actives['we']?>><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=blog&amp;view=we">好友的日志</a></li>
<li<?=$actives['me']?>><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=blog&amp;view=me">我的日志</a></li>
<li<?=$actives['all']?>><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=blog&amp;view=all">随便看看</a></li>
<li class="o"><a href="home.php?mod=spacecp&amp;ac=blog">发表新日志</a></li>
</ul>
<? } else { include template('home/space_menu'); } if($_GET['view'] == 'all') { ?>
<p class="tbmu">
<a href="home.php?mod=space&amp;do=blog&amp;view=all&amp;order=dateline" <?=$orderactives['dateline']?>>最新发表的日志</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=blog&amp;view=all&amp;order=hot" <?=$orderactives['hot']?>>推荐阅读的日志</a>
</p>
<? } if($userlist) { ?>
<p class="tbmu">
按好友筛选
<select name="fuidsel" onchange="fuidgoto(this.value);" class="ps">
<option value="">全部好友</option><? if(is_array($userlist)) foreach($userlist as $value) { ?><option value="<?=$value['fuid']?>"<?=$fuid_actives[$value['fuid']]?>><?=$value['nickname']?></option>
<? } ?>
</select>
</p>
<? } if($searchkey) { ?>
<p class="tbmu">以下是搜索日志 <span style="color: red; font-weight: 700;"><?=$searchkey?></span> 结果列表</p>
<? } if($_GET['view'] != 'we' && ($category || $classarr) ) { if($_GET['view']=='all' && $category) { ?>
<div class="tbmu"><? if(is_array($category)) foreach($category as $value) { ?><a href="home.php?mod=space&amp;do=blog&amp;catid=<?=$value['catid']?>&amp;view=all&amp;order=<?=$_GET['order']?>"<? if($_GET['catid']==$value['catid']) { ?> class="a"<? } ?>><?=$value['catname']?></a><span class="pipe">|</span>
<? } ?>
</div>
<? } if($classarr) { ?>
<div class="tbmu"><? if(is_array($classarr)) foreach($classarr as $classid => $classname) { ?><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=blog&amp;classid=<?=$classid?>&amp;view=me" id="classid<?=$classid?>" onmouseover="showMenu(this.id);"<? if($_GET['classid']==$classid) { ?> class="a"<? } ?>><?=$classname?></a><span class="pipe">|</span>
<? if($space['self']) { ?>
<div id="classid<?=$classid?>_menu" class="p_pop" style="display: none; zoom: 1;">
<a href="home.php?mod=spacecp&amp;ac=class&amp;op=edit&amp;classid=<?=$classid?>" id="c_edit_<?=$classid?>" onclick="showWindow(this.id, this.href, 'get', 0);">编辑</a>
<a href="home.php?mod=spacecp&amp;ac=class&amp;op=delete&amp;classid=<?=$classid?>" id="c_delete_<?=$classid?>" onclick="showWindow(this.id, this.href, 'get', 0);">删除</a>
</div>
<? } } ?>
</div>
<? } } } else { ?><!DOCTYPE html>
<html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?=CHARSET?>" />
        <title><? if(!empty($navtitle)) { ?><?=$navtitle?> - <? } if(empty($nobbname1)) { ?> <?=$_G['setting']['bbname']?>_美女视频<? } ?></title>
        <?=$_G['setting']['seohead']?>
        <meta name="keywords" content="<? if(!empty($metakeywords)) { echo htmlspecialchars($metakeywords); } ?>" />
        <meta name="description" content="<? if(!empty($metadescription)) { echo htmlspecialchars($metadescription); ?> <? } ?>,<?=$_G['setting']['bbname']?>" />
        <base href="<?=$_G['siteurl']?>" />
        <link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_common.css?<?=VERHASH?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_home_space.css?<?=VERHASH?>" /><? if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['cookie']['extstyle']?>/style.css" /><? } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['style']['defaultextstyle']?>/style.css" /><? } ?>    <link rel="stylesheet" type="text/css" href="static2/space_common.css?<?=VERHASH?>" />    
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

<style>
  .textinput, .textarea {
    background-color: #FFFFFF;
    border-color: #B7D2E2;
    color: #A2A2A2 !important;
  }
  .input_focus {
    border-color: #FFCF5C;
    color: #4A4A4A !important;
  }	
  .bg2{
    background-color: #E4EFF4;
  }
  .mod_comment .mod_comment_post {
    margin: 0 0 2px;
    padding: 8px;
  }
  .mod_comment ol li .mod_comment_cont {
    min-height: 36px;
    padding: 0 0 7px 51px;
    position: relative;
  }

  .mod_comment_default_input {
    border-style: solid;
    border-width: 1px;
    cursor: text;
    font-family: Simsun;
    font-size: 12px;
    height: 21px;
    line-height: 23px;
    margin: 0;
    overflow: hidden;
    padding-left: 4px;
  }	
  .mod_comment_post p textarea {
    border-style: solid;
    border-width: 1px;
    font-size: 12px;
    height: 38px;
    margin: 1px;
    overflow: auto;
    width: 415px;
  }	
  .mod_comment_post p textarea.input_focus {
    border-width: 2px;
    margin: 0;
  }
  .mod_comment_post p.hint {
    margin-top: -3px;
    padding: 4px 8px 1px 28px;
  }
  .mod_comment_cont {
    padding: 10px 0 9px 61px;
  }
  .mod_comment_cont .mod_comment_avatar {
    font-size: 0;
    height: 48px;
    left: 3px;
    line-height: 0;
    overflow: hidden;
    position: absolute;
    top: 0;
    padding-top:3px;
    width: 48px;
  }
  .mod_comment li {
    list-style-type: none;
    margin-bottom: 5px;
    position: relative;
    padding:0px;
    z-index: 1;
  }	
  .comment_cont p{
    color:#000000;
  }			
</style>

<script>
  //回复操作 begin
  function comment_reply_hidden(v1,v2,cid){
    document.getElementById(v1).style.display='none';
    document.getElementById(v2).style.display='block';
    //内容置空
    var cid="comment_reply_"+cid;
    document.getElementById(cid).value='';
  }
  var ajax={
    //ajax初始化
    init:function(){
      if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
        }else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      return xmlhttp;
    },
    //ajax提交回复并获取回复列表
    reply_ajax_submit:function(cid){
      var reply_id='comment_reply_'+cid;
      var reply_value=document.getElementById(reply_id).value;
      if(reply_value==''){
        alert('请输入回复内容');
        return;
      }
      var xmlhttp=this.init();
      if(xmlhttp==null){
        return;
      }
      var url='home.php?mod=spacecp&ac=comment&op=ajaxreply&cid='+cid+'&time='+(new Date()).getTime()+'&rpv='+reply_value;
      xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState==4&&xmlhttp.status==200){
          var responseText=xmlhttp.responseText;
          if(responseText!=-1&&responseText!=-2){
            var arr=eval('('+responseText+')');
            var html='';
            for(var k in arr){
              html+='<li class="bg2"  id="comment_reply_li_'+arr[k]['reply_id']+'"><div class="mod_comment_cont"><p class="mod_comment_avatar">';
                if(arr[k]['reply_user']){
                  html+='<a class="q_namecard" href="home.php?mod=space&amp;uid='+arr[k]['reply_uid']+'" c="1" target="_blank">'+arr[k]['pic_str']+'</a>';
                  }else{
                  html+=arr[k]['reply_user'];
                }
                html+='</p><div class="bg2 comment_cont"><p><span class="mod_comment_authorname">';
                    html+=arr[k]['user_show'];                   
                    html+='</span> '+arr[k]['reply_content'];
                  html+='</p><p class="mod_comment_last"><span class="c_tx3 mod_comment_time">'+arr[k]['reply_dateline']+' '+arr[k]['delete_str']+'</span></p></div></div></li>';																	
            }
            var reply_list_id='comment_reply_list_'+cid;
            document.getElementById(reply_list_id).innerHTML=html;
            document.getElementById(reply_id).value='';
            }else if(responseText==-2){
            alert('非法操作!');
            }else if(responseText==-1){
            alert('请先登录...');
          }				  
        }
      }
      xmlhttp.open("GET",url,true);
      xmlhttp.send();		
    },
    //ajax删除回复
    delelte_reply:function(rpid){
      if(!confirm('确定删除吗?')){
        return;
      }
      var xmlhttp=this.init();
      if(xmlhttp==null){
        return;
      }
      var url='home.php?mod=spacecp&ac=comment&op=delreplyajax&rpid='+rpid+'&time='+(new Date()).getTime();
      xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState==4&&xmlhttp.status==200){
          if(xmlhttp.responseText==1){
            var reply_list_id='comment_reply_li_'+rpid;
            document.getElementById(reply_list_id).innerHTML='';										
            }else if(xmlhttp.responseText==-1){
            alert('请先登录...');
            }else if(xmlhttp.responseText==-2||xmlhttp.responseText==-3){
            alert('非法操作!');
          }						  
        }
      }
      xmlhttp.open("GET",url,true);
      xmlhttp.send();							
    }					
  };	
  //end		
</script>        
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
<span id="button_redo" class="unusable"><a href="javascript:;" onclick="spaceDiy.redo();return false;" title="重做" onfocus="this.blur();">重做</a></span>
<span id="button_undo" class="unusable"><a href="javascript:;" onclick="spaceDiy.undo();return false;" title="撤销" onfocus="this.blur();">撤销</a></span>
</p>
<ul id="controlnav">
<li id="navstart" class="current"><a href="javascript:" onclick="spaceDiy.getdiy('start');this.blur();return false;">开始</a></li>
<li id="navlayout"><a href="javascript:;" onclick="spaceDiy.getdiy('layout');this.blur();return false;">版式/布局</a></li>
<li id="navstyle"><a href="javascript:;" onclick="spaceDiy.getdiy('style');this.blur();return false;">风格</a></li>
<li id="navblock"><a href="javascript:;" onclick="spaceDiy.getdiy('block');this.blur();return false;">模块</a></li>
<li id="navdiy"><a href="javascript:;" onclick="spaceDiy.getdiy('diy');this.blur();return false;">自定义装扮</a></li>
</ul>
</div>
<div id="controlcontent" class="cl">
<ul id="contentstart" class="content">
  <li><a href="javascript:;" onclick="spaceDiy.getdiy('layout');return false;"><img src="<?=STATICURL?>image/diy/layout.png" />版式</a></li>
  <li><a href="javascript:;" onclick="spaceDiy.getdiy('style');return false;"><img src="<?=STATICURL?>image/diy/style.png" />风格</a></li>
  <li><a href="javascript:;" onclick="spaceDiy.getdiy('block');return false;"><img src="<?=STATICURL?>image/diy/module.png" />添加模块</a></li>
  <li><a href="javascript:;" onclick="spaceDiy.getdiy('diy', 'topicid', '<?=$topic['topicid']?>');return false;"><img src="<?=STATICURL?>image/diy/diy.png" />自定义</a></li>
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
      <strong><a href="<?=DX_URL?>home.php?mod=space&uid=<?=$_G['uid']?>" class="vwmy" target="_blank" title="访问我的空间"><? if($_G['member']['nickname']) { ?><?=$_G['member']['nickname']?><? } else { ?><?=$_G['member']['username']?><? } ?>(<?=$_G['uid']?>)</a></strong>
      <? if($_G['group']['allowinvisible']) { ?><span id="loginstatus" class="xg1"><a href="<?=DX_URL?>member.php?mod=switchstatus" title="切换在线状态" onClick="ajaxget(this.href, 'loginstatus');doane(event);"><? if($_G['session']['invisible']) { ?>隐身<? } else { ?>在线<? } ?></a></span><? } ?>
      <span class="pipe">|</span><span id="myspace" class="xg1 showmenu" onMouseOver="showMenu(this.id);"><a target="_blank" href="<?=DX_URL?>/<?=$_G['uid']?>">我的中心</a></span>
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
            <? if($space['spacename']) { ?><?=$space['spacename']?><? } else { if($space['nickname']) { ?><?=$space['nickname']?><? } else { ?><?=$space['username']?><? } ?>的个人主页<? } ?>
            <? if(!$space['self']) { ?><a class="oshr xs1 xw0" onClick="showWindow(this.id, this.href, 'get', 0);" id="share_space" href="<?=DX_URL?>home.php?mod=spacecp&ac=share&type=space&id=<?=$space['uid']?>">分享</a><? } ?>
          </strong>
          <a id="domainurl" href=<?=DX_URL?><?=$space['uid']?> onClick="javascript:setCopy('<?=DX_URL?><?=$space['uid']?>', '复制');return false;" class="xs0 xw0"><?=DX_URL?><?=$space['uid']?></a> <? if($space['self']) { ?>&nbsp;&nbsp;<a id="domainurl" href="<?=DX_URL?><?=$space['uid']?>" onClick="javascript:setCopy('<?=DX_URL?><?=$space['uid']?>', '复制');return false;" class="xs0 xw0">[复制]</a><? } ?>
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
        <li><a target="_blank" href="<?=DX_URL?><?=$_G['uid']?>">我的空间</a></li>
      </ul>



<div id="ct" class="ct2 wp cl">
<div class="mn">
<div class="bm">
<div class="bm_h cl">
<h1 class="mt"><span class="z">日志</span> <? if($space['self']) { ?><span class="xs1 xw0 y"> <a href="home.php?mod=spacecp&amp;ac=blog">发表新日志</a> </span><? } ?></h1>
</div>
<? if($classarr) { ?>
<div class="tbmu">
<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=blog&amp;view=me&amp;from=<?=$_GET['from']?>"<? if(!$_GET['classid']) { ?> class="a"<? } ?>>全部日志</a><span class="pipe">|</span><? if(is_array($classarr)) foreach($classarr as $classid => $classname) { if($space['self']) { ?>
<div id="classid<?=$classid?>_menu" class="p_pop" style="display: none; zoom: 1;">
<a href="home.php?mod=spacecp&amp;ac=class&amp;op=edit&amp;classid=<?=$classid?>" id="c_edit_<?=$classid?>" onclick="showWindow(this.id, this.href, 'get', 0);">编辑</a>
<a href="home.php?mod=spacecp&amp;ac=class&amp;op=delete&amp;classid=<?=$classid?>" id="c_delete_<?=$classid?>" onclick="showWindow(this.id, this.href, 'get', 0);">删除</a>
</div>
<? } ?>
<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=blog&amp;classid=<?=$classid?>&amp;view=me&amp;from=<?=$_GET['from']?>" id="classid<?=$classid?>" onmouseover="showMenu(this.id);"<? if($_GET['classid']==$classid) { ?> class="a"<? } ?>><?=$classname?></a><span class="pipe">|</span>
<? } ?>
</div>
<? } ?>
<div class="bm_c">
<? } if($count) { ?>
<div class="xld <? if(empty($diymode)) { ?>xlda<? } ?>"><? if(is_array($list)) foreach($list as $k => $value) { ?><dl class="bbda">
<? if(empty($diymode)) { ?>
<dd class="m">
<div class="avt"><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" c="1"><?php echo avatar($value[uid],small); ?></a></div>
</dd>
<? } ?>

<dt class="xs2">
<a href="home.php?mod=spacecp&amp;ac=share&amp;type=blog&amp;id=<?=$value['blogid']?>&amp;handlekey=lsbloghk_<?=$value['blogid']?>" id="a_share_<?=$value['blogid']?>" onclick="showWindow(this.id, this.href, 'get', 0);" class="oshr xs1 xw0">分享</a>
<a href="home.php?mod=space&amp;uid=<?=$value['uid']?>&amp;do=blog&amp;id=<?=$value['blogid']?>"<? if($value['magiccolor']) { ?> class="magiccolor<?=$value['magiccolor']?>"<? } ?>><?=$value['subject']?></a>
<? if($value['status'] == 1) { ?> (待审核)<? } ?>
</dt>
<dd>
<? if($value['friend']) { ?>
<span class="y"><a href="<?=$theurl?>&friend=<?=$value['friend']?>" class="xg1"><?=$friendsname[$value['friend']]?></a></span>
<? } if($value['hot']) { ?><span class="hot">热度 <em><?=$value['hot']?></em> </span><? } if(empty($diymode)) { ?><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>"><?=$value['nickname']?></a> <? } ?><span class="xg1"><?=$value['dateline']?></span>
</dd>
<dd class="cl" id="blog_article_<?=$value['blogid']?>">
<? if($value['pic']) { ?><div class="atc"><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>&amp;do=blog&amp;id=<?=$value['blogid']?>"><img src="<?=$value['pic']?>" alt="<?=$value['subject']?>" class="tn" /></a></div><? } ?>
<?=$value['message']?>
</dd>
<dd class="xg1">
<? if($classarr[$value['classid']]) { ?>个人分类: <a href="home.php?mod=space&amp;uid=<?=$value['uid']?>&amp;do=blog&amp;classid=<?=$value['classid']?>&amp;view=me"><?=$classarr[$value['classid']]?></a><span class="pipe">|</span><? } if($value['viewnum']) { ?><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>&amp;do=blog&amp;id=<?=$value['blogid']?>"><?=$value['viewnum']?> 次阅读</a><span class="pipe">|</span><? } if($value['replynum']) { ?><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>&amp;do=blog&amp;id=<?=$value['blogid']?>#comment"><?=$value['replynum']?> 个评论</a><? } else { ?>没有评论<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['space_blog_list_status'][$k])) echo $_G['setting']['pluginhooks']['space_blog_list_status'][$k]; ?>
</dd>
</dl>
<? } if($pricount) { ?>
<p class="mtm">本页有 <?=$pricount?> 篇日志因作者的隐私设置或未通过审核而隐藏</p>
<? } ?>
</div>
<? if($multi) { ?><div class="pgs cl mtm"><?=$multi?></div><? } } else { ?>
<div class="emp">还没有相关的日志。</div>
<? } if(empty($diymode)) { ?>
</div>
<!--[diy=diycontentbottom]--><div id="diycontentbottom" class="area"></div><!--[/diy]-->
</div>

<div class="appl"><?php if(!empty($_G['setting']['pluginhooks']['global_userabout_top'][$_G['basescript'].'::'.CURMODULE])) echo $_G['setting']['pluginhooks']['global_userabout_top'][$_G['basescript'].'::'.CURMODULE]; ?><?php getuserapp(1); ?><ul><? if(is_array($_G['setting']['spacenavs'])) foreach($_G['setting']['spacenavs'] as $nav) { if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { if(in_array($nav['code'], array('userpanelarea1', 'userpanelarea2'))) { if(!empty($_G['my_panelapp']) && $_G['setting']['my_app_status']) { if($nav['code']=='userpanelarea1' && !empty($_G['my_panelapp']['1'])) { if(is_array($_G['my_panelapp']['1'])) foreach($_G['my_panelapp']['1'] as $appid => $app) { ?><li>
<a href="userapp.php?mod=app&amp;id=<?=$app['appid']?>" title="<?=$app['appname']?>"><img <? if($app['icon']) { ?>src="<?=$app['icon']?>" onerror="this.onerror=null;this.src='http://appicon.manyou.com/icons/<?=$app['appid']?>'"<? } else { ?> src="http://appicon.manyou.com/icons/<?=$app['appid']?>"<? } ?> name="<?=$appid?>" alt="<?=$app['appname']?>" /><?=$app['appname']?></a>
</li>
<? } } elseif($nav['code']=='userpanelarea2' && !empty($_G['my_panelapp']['2'])) { if(is_array($_G['my_panelapp']['2'])) foreach($_G['my_panelapp']['2'] as $appid => $app) { ?><li>
<a href="userapp.php?mod=app&amp;id=<?=$app['appid']?>" title="<?=$app['appname']?>"><img <? if($app['icon']) { ?>src="<?=$app['icon']?>" onerror="this.onerror=null;this.src='http://appicon.manyou.com/icons/<?=$app['appid']?>'"<? } else { ?> src="http://appicon.manyou.com/icons/<?=$app['appid']?>"<? } ?> name="<?=$appid?>" alt="<?=$app['appname']?>" /><?=$app['appname']?></a>
</li>
<? } } } } else { ?>
<?=$nav['code']?>
<? } } } ?>
</ul>
<? if($_G['setting']['my_app_status']) { if(!empty($_G['cache']['userapp'])) { ?>
<ul id="my_defaultapp"><? if(is_array($_G['cache']['userapp'])) foreach($_G['cache']['userapp'] as $value) { ?><li><a href="userapp.php?mod=app&amp;id=<?=$value['appid']?>"><img <? if($value['icon']) { ?>src="<?=$value['icon']?>" onerror="this.onerror=null;this.src='http://appicon.manyou.com/icons/<?=$value['appid']?>'"<? } else { ?> src="http://appicon.manyou.com/icons/<?=$value['appid']?>"<? } ?> alt="<?=$value['appname']?>" /><?=$value['appname']?></a></li>
<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['userapp_menu_top'])) echo $_G['setting']['pluginhooks']['userapp_menu_top']; ?>
</ul>
<? } if($_G['my_menu']) { ?>
<ul id="my_userapp"><? if(is_array($_G['my_menu'])) foreach($_G['my_menu'] as $value) { ?><li id="userapp_li_<?=$value['appid']?>"><a href="userapp.php?mod=app&amp;id=<?=$value['appid']?>" title="<?=$value['appname']?>"><img <? if($value['icon']) { ?>src="<?=$value['icon']?>" onerror="this.onerror=null;this.src='http://appicon.manyou.com/icons/<?=$value['appid']?>'"<? } else { ?> src="http://appicon.manyou.com/icons/<?=$value['appid']?>"<? } ?> alt="<?=$value['appname']?>" /><?=$value['appname']?></a></li>
<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['userapp_menu_middle'])) echo $_G['setting']['pluginhooks']['userapp_menu_middle']; ?>
</ul>
<? } if($_G['my_menu_more']) { ?>
<p class="pbm bbda xg1 cl"><a href="javascript:;" class="unfold" id="a_app_more" onclick="userapp_open();">展开</a></p>
<? } if(checkperm('allowmyop')) { ?>
<ul class="myo mtm">
<li><a href="userapp.php?mod=manage&amp;my_suffix=%2Fapp%2Flist"><img src="<?=IMGDIR?>/app_add.gif" alt="app_add" />添加<?=$_G['setting']['navs']['5']['navname']?></a></li>
<li><a href="userapp.php?mod=manage&amp;ac=menu"><img src="<?=IMGDIR?>/app_set.gif" alt="app_set" />管理<?=$_G['setting']['navs']['5']['navname']?></a></li>
</ul>
<? } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_userabout_bottom'][$_G['basescript'].'::'.CURMODULE])) echo $_G['setting']['pluginhooks']['global_userabout_bottom'][$_G['basescript'].'::'.CURMODULE]; ?>
<script type="text/javascript">inituserabout();</script></div>
</div>

<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div>

<script type="text/javascript">
function fuidgoto(fuid) {
window.location.href = 'home.php?mod=space&do=blog&view=we&fuid='+fuid;
}
</script>

<? } else { ?>
</div>
</div>
</div>
<div class="sd"><div id="pcd" class="bm cl">
<div class="hm">
<p><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>"><?php echo avatar($space[uid],middle); ?></a></p>
<h2 class="xs2"><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>"><?=$space['nickname']?></a></h2>
</div>
<ul class="xl xl2 cl ul_list">
<? if($space['self']) { ?>
<li class="ul_diy"><a href="home.php?mod=space&amp;diy=yes">装扮空间</a></li>
<li class="ul_msg"><a href="home.php?mod=space&amp;do=wall">查看留言</a></li>
<li class="ul_avt"><a href="home.php?mod=spacecp&amp;ac=avatar">编辑头像</a></li>
<li class="ul_profile"><a href="home.php?mod=spacecp&amp;ac=profile">更新资料</a></li>
<? } else { ?><?php require_once libfile('function/friend');$isfriend=friend_check($space[uid]); if(!$isfriend) { ?>
<li class="ul_add"><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?=$space['uid']?>&amp;handlekey=addfriendhk_<?=$space['uid']?>" id="a_friend_li_<?=$space['uid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">加为好友</a></li>
<? } else { ?>
<li class="ul_ignore"><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid=<?=$space['uid']?>&amp;handlekey=ignorefriendhk_<?=$space['uid']?>" id="a_ignore_<?=$space['uid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">解除好友</a></li>
<? } ?>
<li class="ul_contect"><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=wall">给我留言</a></li>
<li class="ul_poke"><a href="home.php?mod=spacecp&amp;ac=poke&amp;op=send&amp;uid=<?=$space['uid']?>&amp;handlekey=propokehk_<?=$space['uid']?>" id="a_poke_<?=$space['uid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">打个招呼</a></li>
<li class="ul_pm"><a href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?=$space['uid']?>&amp;touid=<?=$space['uid']?>&amp;pmid=0&amp;daterange=2" id="a_sendpm_<?=$space['uid']?>" onclick="showWindow('showMsgBox', this.href, 'get', 0)">发送消息</a></li>
<? } ?>
</ul>
<? if(checkperm('allowbanuser') || checkperm('allowedituser') || $_G['adminid'] == 1) { ?>
<hr class="da mtn m0">
<ul class="ptn xl xl2 cl">
<? if(checkperm('allowbanuser') || checkperm('allowedituser')) { ?>
<li>
<? if(checkperm('allowbanuser')) { ?>
<a href="<? if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=ban&username=<?=$space['username']?>&frames=yes<? } else { ?>forum.php?mod=modcp&action=member&op=ban&uid=<?=$space['uid']?><? } ?>" id="usermanageli" onmouseover="showMenu(this.id)" class="showmenu" target="_blank">用户管理</a>
<? } else { ?>
<a href="<? if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=search&username=<?=$space['username']?>&submit=yes&frames=yes<? } else { ?>forum.php?mod=modcp&action=member&op=edit&uid=<?=$space['uid']?><? } ?>" id="usermanageli" onmouseover="showMenu(this.id)" class="showmenu" target="_blank">用户管理</a>
<? } ?>
</li>
<? } if($_G['adminid'] == 1) { ?>
<li><a href="forum.php?mod=modcp&amp;action=thread&amp;op=post&amp;do=search&amp;searchsubmit=1&amp;users=<?=$space['username']?>" id="umanageli" onmouseover="showMenu(this.id)" class="showmenu">内容管理</a></li>
<? } ?>
</ul>
<? if(checkperm('allowbanuser') || checkperm('allowedituser')) { ?>
<ul id="usermanageli_menu" class="p_pop" style="width: 80px; display:none;">
<? if(checkperm('allowbanuser')) { ?>
<li><a href="<? if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=ban&username=<?=$space['username']?>&frames=yes<? } else { ?>forum.php?mod=modcp&action=member&op=ban&uid=<?=$space['uid']?><? } ?>" target="_blank">禁止用户</a></li>
<? } if(checkperm('allowedituser')) { ?>
<li><a href="<? if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=search&username=<?=$space['username']?>&submit=yes&frames=yes<? } else { ?>forum.php?mod=modcp&action=member&op=edit&uid=<?=$space['uid']?><? } ?>" target="_blank">编辑用户</a></li>
<? } ?>
</ul>
<? } if($_G['adminid'] == 1) { ?>
<ul id="umanageli_menu" class="p_pop" style="width: 80px; display:none;">
<li><a href="admin.php?action=threads&amp;users=<?=$space['username']?>" target="_blank">管理帖子</a></li>
<li><a href="admin.php?action=doing&amp;searchsubmit=1&amp;users=<?=$space['username']?>" target="_blank">管理记录</a></li>
<li><a href="admin.php?action=blog&amp;searchsubmit=1&amp;uid=<?=$space['uid']?>" target="_blank">管理日志</a></li>
<li><a href="admin.php?action=feed&amp;searchsubmit=1&amp;uid=<?=$space['uid']?>" target="_blank">管理动态</a></li>
<li><a href="admin.php?action=album&amp;searchsubmit=1&amp;uid=<?=$space['uid']?>" target="_blank">管理相册</a></li>
<li><a href="admin.php?action=pic&amp;searchsubmit=1&amp;users=<?=$space['username']?>" target="_blank">管理图片</a></li>
<li><a href="admin.php?action=comment&amp;searchsubmit=1&amp;authorid=<?=$space['uid']?>" target="_blank">管理评论</a></li>
<li><a href="admin.php?action=share&amp;searchsubmit=1&amp;uid=<?=$space['uid']?>" target="_blank">管理分享</a></li>
<li><a href="admin.php?action=threads&amp;operation=group&amp;users=<?=$space['username']?>" target="_blank">群组主题</a></li>
<li><a href="admin.php?action=prune&amp;searchsubmit=1&amp;operation=group&amp;users=<?=$space['username']?>" target="_blank">群组帖子</a></li>
</ul>
<? } } ?>
</div>
</div></div>
</div>
<? } if($_GET['from']=='space') { include template('common/footer_1_5'); } else { include template('common/footer'); } ?>