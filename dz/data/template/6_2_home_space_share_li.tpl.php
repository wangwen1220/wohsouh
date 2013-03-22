<? if(!defined('IN_DISCUZ')) exit('Access Denied'); if(empty($ajax_edit)) { ?><li id="share_<?=$value['sid']?>_li"><? } ?>
<div class="h">
<div class="y">
<?php if(!empty($_G['setting']['pluginhooks']['space_share_comment_op'][$k])) echo $_G['setting']['pluginhooks']['space_share_comment_op'][$k]; if($value['sid']) { ?><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>&amp;do=share&amp;id=<?=$value['sid']?>">评论</a><? } if($value['uid']==$_G['uid']) { ?>
<span class="pipe">|</span>
<a href="home.php?mod=spacecp&amp;ac=share&amp;op=delete&amp;sid=<?=$value['sid']?>&amp;handlekey=dellshk_<?=$value['sid']?>" id="s_<?=$value['sid']?>_delete" onclick="showWindow(this.id, this.href, 'get', 0);">删除</a>
<? } ?>
</div>
<a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" c="1"><?=$value['nickname']?></a>
<a href="home.php?mod=space&amp;uid=<?=$value['uid']?>&amp;do=share&amp;id=<?=$value['sid']?>"><?=$value['title_template']?></a>
<? if($value['status'] == 1) { ?><span class="xgl">(待审核)<? } ?>
<span class="xg1"><?php echo dgmdate($value[dateline], 'u'); ?></span>
</div>
<div class="ec cl">
<? if($value['image']) { ?>
<a href="<?=$value['image_link']?>"><img src="<?=$value['image']?>" class="tn" alt="" /></a>
<? } ?>
<div class="d">
<?=$value['body_template']?>
</div>
<? if($value['type'] == 'video') { if(!empty($value['body_data']['imgurl'])) { ?>
<table class="mtm" title="点击播放" onclick="javascript:showFlash('<?=$value['body_data']['host']?>', '<?=$value['body_data']['flashvar']?>', this, '<?=$value['sid']?>');"><tr><td class="vdtn hm" style="background: url(<?=$value['body_data']['imgurl']?>) no-repeat">
<img src="<?=IMGDIR?>/vds.png" alt="点击播放" />
</td></tr></table>
<? } else { ?>
<img src="<?=IMGDIR?>/vd.gif" alt="点击播放" onclick="javascript:showFlash('<?=$value['body_data']['host']?>', '<?=$value['body_data']['flashvar']?>', this, '<?=$value['sid']?>');" class="tn" />
<? } } elseif($value['type'] == 'music') { ?>
<img src="<?=IMGDIR?>/music.gif" alt="点击播放" onclick="javascript:showFlash('music', '<?=$value['body_data']['musicvar']?>', this, '<?=$value['sid']?>');" class="tn" />
<? } elseif($value['type'] == 'flash') { ?>
<img src="<?=IMGDIR?>/flash.gif" alt="点击查看" onclick="javascript:showFlash('flash', '<?=$value['body_data']['flashaddr']?>', this, '<?=$value['sid']?>');" class="tn" />
<? } if($value['body_general']) { ?>
<div class="quote<? if($value['image']) { ?> z<? } ?>"><blockquote id="quote_<?=$id?>"><?=$value['body_general']?></blockquote></div>
<? } ?>
</div>
<? if(empty($ajax_edit)) { ?></li><? } ?>