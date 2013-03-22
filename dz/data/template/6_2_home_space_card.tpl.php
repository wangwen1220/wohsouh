<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_card');?><? include template('common/header'); ?><?php if(!empty($_G['setting']['pluginhooks']['space_card_top'])) echo $_G['setting']['pluginhooks']['space_card_top']; ?>
<div class="cl">
<div class="avt">
<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>" target="_blank" title="进入<?=$space['username']?>的空间"><?php echo avatar($space[uid],small); ?></a>
</div>
<div class="c cl">
<p class="pbn cl">
<span class="y xg1" style="color:<?=$space['group']['color']?>"<? if($upgradecredit !== false) { ?> title="积分 <?=$space['credits']?>, 距离下一级还需 <?=$upgradecredit?> 积分"<? } ?>><?=$space['group']['grouptitle']?></span>
<strong><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>"><?=$space['nickname']?></a></strong>
<? if(TIMESTAMP - $space['lastactivitydb'] <= 10800) { ?>
<img src="<?=IMGDIR?>/ol.gif" alt="online" title="在线" class="vm" />&nbsp;
<? } if($_G['setting']['verify']['enabled']) { if(is_array($_G['setting']['verify'])) foreach($_G['setting']['verify'] as $vid => $verify) { if($verify['available'] && $space['verify'.$vid] == 1) { ?>
<a href="home.php?mod=spacecp&amp;ac=profile&amp;op=verify&amp;vid=<?=$vid?>" target="_blank"><? if($verify['icon']) { ?><img src="<?=$verify['icon']?>" class="vm" alt="<?=$verify['title']?>" title="<?=$verify['title']?>" /><? } else { ?><?=$verify['title']?><? } ?></a>&nbsp;
<? } } } ?>
</p>
<?php if(!empty($_G['setting']['pluginhooks']['space_card_baseinfo_middle'])) echo $_G['setting']['pluginhooks']['space_card_baseinfo_middle']; ?>
<div<? if($allowupdatedoing) { ?><?php $scdoingid='scdoing'.random(4); ?> id="return_<?=$scdoingid?>" onclick="cardUpdatedoing('<?=$scdoingid?>', 0)"<? } ?>><?=$space['spacenote']?><? if($allowupdatedoing) { ?> <a href="javascript:;" class="xi2">[更新记录]</a><? } ?></div>
<? if($allowupdatedoing) { ?>
<form id="<?=$scdoingid?>" method="post" action="home.php?mod=spacecp&amp;ac=doing&amp;inajax=1" onsubmit="return false;" style="display:none">
<input type="hidden" name="addsubmit" value="true" />
<input type="hidden" name="fromcard" value="1" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<textarea name="message" class="card_msg pt xs1"><? echo strip_tags($space['spacenote']); ?></textarea>
<p class="ptn pns cl">
<button type="button" onclick="cardSubmitdoing('<?=$scdoingid?>');" class="pn"><span>保存</span></button>
<span class="pipe">|</span>
<a href="javascript:;" onclick="cardUpdatedoing('<?=$scdoingid?>', 1)">取消</a>
</p>
</form>
<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['space_card_baseinfo_bottom'])) echo $_G['setting']['pluginhooks']['space_card_baseinfo_bottom']; ?>
</div>
</div>
<div class="o cl">
<? if($space['self']) { ?>
<a href="home.php?mod=space&amp;diy=yes" class="xi2">装扮空间</a>
<a href="home.php?mod=space&amp;do=wall" class="xi2">查看留言</a>
<a href="home.php?mod=spacecp&amp;ac=avatar" class="xi2">编辑头像</a>
<a href="home.php?mod=spacecp&amp;ac=profile" class="xi2">更新资料</a>
<? } else { ?><?php require_once libfile('function/friend');$isfriend=friend_check($space[uid]); if(!$isfriend) { ?>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?=$space['uid']?>&amp;handlekey=addfriendhk_<?=$space['uid']?>" id="a_friend_li_<?=$space['uid']?>" onclick="showWindow(this.id, this.href, 'get', 0);" class="xi2">加为好友</a>
<? } else { ?>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid=<?=$space['uid']?>&amp;handlekey=ignorefriendhk_<?=$space['uid']?>" id="a_ignore_<?=$space['uid']?>" onclick="showWindow(this.id, this.href, 'get', 0);" class="xi2">解除好友</a>
<? } ?>
<a href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?=$space['uid']?>&amp;touid=<?=$space['uid']?>&amp;pmid=0&amp;daterange=2" id="a_sendpm_<?=$space['uid']?>" onclick="showWindow('showMsgBox', this.href, 'get', 0)" class="xi2">发送消息</a>
<a href="home.php?mod=spacecp&amp;ac=poke&amp;op=send&amp;uid=<?=$space['uid']?>&amp;handlekey=propokehk_<?=$space['uid']?>" id="a_poke_<?=$space['uid']?>" onclick="showWindow(this.id, this.href, 'get', 0);" class="xi2">打个招呼</a>
<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=wall" class="xi2">给我留言</a>
<? } if(checkperm('allowbanuser') || checkperm('allowedituser')) { if(checkperm('allowedituser')) { ?>
<a href="<? if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=search&username=<?=$space['username']?>&submit=yes&frames=yes<? } else { ?>forum.php?mod=modcp&action=member&op=edit&uid=<?=$space['uid']?><? } ?>" target="_blank" class="xi1">编辑用户</a>
<? } if(checkperm('allowbanuser')) { ?>
<a href="<? if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=ban&username=<?=$space['username']?>&frames=yes<? } else { ?>forum.php?mod=modcp&action=member&op=ban&uid=<?=$space['uid']?><? } ?>" target="_blank" class="xi1">禁止用户</a>
<? } ?>			
<a href="forum.php?mod=modcp&amp;action=thread&amp;op=post&amp;do=search&amp;searchsubmit=1&amp;users=<?=$space['username']?>" target="_blank" class="xi1">管理帖子</a>
<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['space_card_option'])) echo $_G['setting']['pluginhooks']['space_card_option']; ?>
</div>
<? if($_G['setting']['magicstatus']) { ?>
<div class="mgc">
<? if(!empty($_G['setting']['magics']['showip'])) { ?>
<a href="home.php?mod=magic&amp;mid=showip&amp;idtype=user&amp;id=<? echo rawurlencode($space['username']); ?>" id="a_showip_li_<?=$space['pid']?>" onclick="showWindow(this.id, this.href)"><img src="<?=STATICURL?>/image/magic/showip.small.gif" class="vm" title="<?=$_G['setting']['magics']['showip']?>" /> <?=$_G['setting']['magics']['showip']?></a>
<? } if(!empty($_G['setting']['magics']['checkonline']) && $space['uid'] != $_G['uid']) { ?>
<a href="home.php?mod=magic&amp;mid=checkonline&amp;idtype=user&amp;id=<? echo rawurlencode($space['username']); ?>" id="a_repent_<?=$space['pid']?>" onclick="showWindow(this.id, this.href)"><img src="<?=STATICURL?>/image/magic/checkonline.small.gif" class="vm" title="<?=$_G['setting']['magics']['checkonline']?>" /> <?=$_G['setting']['magics']['checkonline']?></a>
<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['space_card_magic_user'])) echo $_G['setting']['pluginhooks']['space_card_magic_user']; ?>
</div>
<? } ?>
<div class="f cl">
<ul><? if(is_array($profiles)) foreach($profiles as $value) { ?><li><em class="xg1"><?=$value['title']?>&nbsp;</em><?=$value['value']?></li>
<? } ?>
</ul>
<?php if(!empty($_G['setting']['pluginhooks']['space_card_bottom'])) echo $_G['setting']['pluginhooks']['space_card_bottom']; ?>
</div><? include template('common/footer'); ?>