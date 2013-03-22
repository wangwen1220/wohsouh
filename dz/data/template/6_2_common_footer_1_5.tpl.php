<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
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
