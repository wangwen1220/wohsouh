<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('show_index');
0
|| checktplrefresh('./template/huoshow/show/show_index.htm', './template/huoshow/common/header.htm', 1342761864, '2', './data/template/6_2_show_show_index.tpl.php', './template/huoshow', 'show/show_index')
|| checktplrefresh('./template/huoshow/show/show_index.htm', './template/huoshow/common/footer.htm', 1342761864, '2', './data/template/6_2_show_show_index.tpl.php', './template/huoshow', 'show/show_index')
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
    <link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_common.css?<?=VERHASH?>" /><? if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['cookie']['extstyle']?>/style.css" /><? } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['style']['defaultextstyle']?>/style.css" /><? } ?>    <link href="<?=WWW_URL?>img/templates/huoshow02/css/global.css" rel="stylesheet" type="text/css" />
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
<style>
  .live-entrances{height:60px; overflow:hidden;}
  .mutilive-entrance{display:none;white-space:nowrap;}
  .hover .live-entrance{display:none!important;}
  .hover .mutilive-entrance{display:block!important;}
</style>

<link href="static2/live.css" rel="stylesheet" type="text/css" />
<div class="live" id="live">
  <div class="live_left">
    <div class="studio"> <?=$focusImges?></div>
    <div class="hotanchor">
      <div class="hotanchor_matches">
        <div class="hotanchor_new_btt_wz">
          <ul>
            <li class="voiced">共有<span id="ajax_activeonlineMember" class="red">[<?=$activeonlineMember?>]</span>位观众</li>
            <li class="zheg">参赛直播<span id="ajax_activeonlineAnchors" class="cheng">[<?=$activeonlineAnchors?>]</span>人</li>
          </ul>
        </div>
        <div class="hotanchor_s">
          <form action="show.php" method="GET" target="_blank">
            <input type="hidden" name="operation" value="SearchMatchAnchor" />
            <span>
              <select name="type" class="hotanchor_s_01">
                <option value="2">&nbsp;昵　称&nbsp;</option>
                <option value="1">&nbsp;火秀号&nbsp;</option>
              </select>
            </span>
            <span>
              <input type="text" name="keyword" class="hotanchor_s_02" />
            </span>
            <span>
              <input type="submit" class="search-button" />
            </span>
          </form>
        </div>
      </div>
      <div class="hotanchor_text" >
        <div id="activesearch_frd_msg" style="text-align:center; margin-bottom:5px;"></div>
        <div id="ajax_activeanchors">&nbsp;</div>
        <div id="ajax_pageHtml1" class="pgs cl">&nbsp;</div>
      </div>
    </div>
    <!-- 多人房列表列表 begin-->
    <? if($allow == 1) { ?>
    <div class="hotanchor">
      <div class="mutilroom_btt">
      </div>
      <div class="hotanchor_text" >
        <div id="search_frd_msg" style="text-align:center; margin-bottom:5px;"></div>
        <div id="ajax_multianchors"><div class="loading"><span>&nbsp;</span></div></div>
        <div id="ajax_pageHtml2" class="pgs cl">&nbsp;</div>
      </div>
    </div>
    <? } ?>
    <!-- 多人房列表 end-->

    <!-- 主播列表 begin-->
    <div class="hotanchor">
      <div class="hotanchor_btt">
        <div class="hotanchor_new_btt_wz">
          <ul>
            <li class="voiced">共有<span id="ajax_onlineMember" class="red">[<?=$onlineMember?>]</span>位观众</li>
            <li class="zheg">正在直播<span id="ajax_onlineAnchors" class="cheng">[<?=$onlineAnchors?>]</span>人</li>
          </ul>
        </div>
        <div class="hotanchor_s">
          <form action="show.php" method="GET" target="_blank">
            <input type="hidden" name="operation" value="SearchAnchor" />
            <span>
              <select name="type" class="hotanchor_s_01">
                <option value="2">&nbsp;昵　称&nbsp;</option>
                <option value="1">&nbsp;火秀号&nbsp;</option>
              </select>
            </span>
            <span>
              <input type="text" name="keyword" class="hotanchor_s_02" />
            </span>
            <span>
              <input type="submit" class="search-button" />
            </span>
          </form>
        </div>
      </div>
      <div class="hotanchor_text" >
        <div id="search_frd_msg" style="text-align:center; margin-bottom:5px;"></div>
        <div id="ajax_anchors"><div class="loading"><span>&nbsp;</span></div></div>
        <div id="ajax_pageHtml" class="pgs cl">&nbsp;</div>
      </div>
    </div>
    <!-- 主播列表 end-->
  </div>

  <div class="live_right">
    <div>
    	<a target="_blank" href="/<?=$_G['uid']?>" onclick="<? if($_G['uid']) { } else { ?>hideWindow('register');showWindow('login', 'member.php?mod=logging&action=login');<? } ?>"><img src="static2/images/live1.gif" /></a>
    	<? if($is_room_colse ==1) { ?>
    		<a target="_blank" href="http://www.huoshow.com/2012/0217/114067.shtml" onclick="<? if($_G['uid']) { } else { ?>hideWindow('register');showWindow('login', 'member.php?mod=logging&action=login');<? } ?>"><img src="static2/images/live2.gif" /></a>
    	<? } elseif($is_room_colse ==2) { ?>
    		<a target="_blank" href="/home.php?mod=huoshow&amp;do=apply_room&amp;room_id=<?=$_G['uid']?>" onclick="<? if($_G['uid']) { } else { ?>hideWindow('register');showWindow('login', 'member.php?mod=logging&action=login');<? } ?>"><img src="static2/images/live2.gif" /></a>
    	<? } else { ?>
    		<a target="_blank" href="/mv<?=$_G['uid']?>" onclick="<? if($_G['uid']) { } else { ?>hideWindow('register');showWindow('login', 'member.php?mod=logging&action=login');<? } ?>"><img src="static2/images/live2.gif" /></a>
    	<? } ?>
    </div>
    <div class="gftg">
      <div class="gftg_zi"><span class="gftg_title"><img src="static2/images/guanfang.gif" width="64" height="19" /></span><span class="gftg_more"><a href="<?=PCMS_URL?>huoshowzhibo/livepartynotice/" target="_blank">更多>></a></span></div>
      <? if(empty($OffNotice)) { ?><div>暂无官方公告</div><? } ?><?=$OffNotice?>
    </div>
<? if($show_right_ad1) { ?>
    <div id="show_right_ad1">
      <?=$show_right_ad1?>
    </div>
    <? } ?>
    <!--//魅力指数-->
    <?=$Charm_Score?>
    <!--//魅力值-->
    <?=$Charm_Value?>
    <!--//魅力之星-->
    <?=$Charm_Vote?>

    <!--友谊榜-->
    <?=$friend?>
<div class="gftg">
          <div class="gftg_zi"><span class="gftg_title"><img src="static2/images/bangzu.gif" width="64" height="19" /></span><span class="gftg_more"><a target="_blank" href="<?=PCMS_URL?>huoshowzhibo/livenewerhelp/">更多>></a></span></div>
          <? if(empty($OffHelp)) { ?><div>暂无官方帮助</div><? } ?><?=$OffHelp?>
        </div>
<div class="gftg">
          <div class="gftg_zi"> <img src="static2/images/kefu.gif" width="64" height="19" /></div>
          <? if(empty($OffContact)) { ?><div>暂无官方联系</div><? } ?><?=$OffContact?>
        </div>
  </div>
</div>
<script>
  (function($) {

    $(function(){
      make_pagebox("show_charm_list", {
        links_selector: ".anchor_paihang_tab li",
        pages_selector: ".anchor_paihang_text",
        current_class: "anchor_paihang_on",
        current: 1,
        event_type: "mouseover"
      });

      make_pagebox("show_huoshow_list", {
        links_selector: ".anchor_paihang_tab li",
        pages_selector: ".anchor_paihang_text",
        current_class: "anchor_paihang_on",
        current: 1,
        event_type: "mouseover"
      });

      make_pagebox("show_friend_list", {
        links_selector: ".anchor_paihang_tab li",
        pages_selector: ".anchor_paihang_text",
        current_class: "anchor_paihang_on",
        current: 1,
        event_type: "mouseover"
      });

      make_pagebox("show_zhishu_list", {
        links_selector: ".anchor_paihang_tab li",
        pages_selector: ".anchor_paihang_text",
        current_class: "anchor_paihang_on",
        current: 1,
        event_type: "mouseover"
      });

      make_pagebox("top2banner", {
        links_selector: ".top2banner-nav a",
        pages_selector: ".top2banner-item",
        current_class: "tab-on",
        interval: 3
      });

      setTimeout(showRooms, 15);
    });

  })(jQuery);

  /*主播列表*/
  var HOTPAGE = 1;
  var MATCHPAGE = 1;
  var MULTIPAGE = 1;
  var T1 = null;

  function showRooms() {
    var url=encodeURI(['show.php?operation=ajax&tab=anchors', '&hotpage=', HOTPAGE, '&matchpage=', MATCHPAGE, '&mutilpag=', MULTIPAGE, '&t=', (new Date()).getTime()].join(''));
    hs.ajax({
      url: url,
      onsuccess: function(data){
data = data.replace('SuccessSuccess', '');
alert(data);
        data = hs.parseJSON(data);
        if(data.list1) {
          hs.$("ajax_anchors").innerHTML = data.list1.anchors;
          hs.$("ajax_pageHtml").innerHTML = data.list1.pageHtml;
          hs.$("ajax_onlineAnchors").innerHTML = data.list1.onlineAnchors;
          hs.$("ajax_onlineMember").innerHTML = data.list1.onlineMember;
        }
        if(data.list2) {
          hs.$("ajax_activeanchors").innerHTML = data.list2.anchors;
          hs.$("ajax_pageHtml1").innerHTML = data.list2.pageHtml;
          hs.$("ajax_activeonlineAnchors").innerHTML = data.list2.onlineAnchors;
          hs.$("ajax_activeonlineMember").innerHTML = data.list2.onlineMember;
        }
        if(data.list3) {
          if(hs.$("ajax_multianchors") != null) hs.$("ajax_multianchors").innerHTML = data.list3.multianchors;
          if(hs.$("ajax_pageHtml2") != null) hs.$("ajax_pageHtml2").innerHTML = data.list3.pageHtml;
          /*
          hs.$("ajax_multionlineAnchors").innerHTML = data.list3.multionlineAnchors;
          hs.$("ajax_multionlineMember").innerHTML = data.list3.multionlineMember;
          */
        }
        },
        oncomplete: function(data){
          clearTimeout(T1);
          T1 = setTimeout(showRooms, 60000);
        }
      });
  }

  function setHotPage(page) {
    HOTPAGE = page;
    showRooms();
  }

  function setMatchPage(page) {
    MATCHPAGE = page;
    showRooms();
  }

  function setMutilPage(page) {
    MULTIPAGE = page;
    showRooms();
  }
</script>﻿</div>
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

