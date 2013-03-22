<? if(!defined('IN_DISCUZ')) exit('Access Denied'); if($list) { if($select_form) { ?>
<p class="tbmu">
排序:
<select id="mySelect" onchange="select_form()">
  <option value="uid" <?=$order_selected['uid']?>>按注册时间</option>
  <option value="posts" <?=$order_selected['posts']?>>按发帖总数</option>
  <option value="blogs" <?=$order_selected['blogs']?>>按日志总数</option>
  <option value="credits" <?=$order_selected['credits']?>>按积分总数</option>
</select>
<script type="text/javascript">
function select_form() {
x = $('mySelect');
y = x.options[x.options.selectedIndex].value;
location.href = location.href.replace(/\&select.*/, '') +  '&select=' + y;
}
</script>
</p>
<? } if($postsrank_change) { ?>
<p id="orderby" class="tbmu">
<a href="javascript:;" id="posts"<? if($now_choose == 'posts') { ?> class="a"<? } ?>>发帖数</a><span class="pipe">|</span>
<a href="javascript:;" id="digestposts"<? if($now_choose == 'digestposts') { ?> class="a"<? } ?>>精华数</a><span class="pipe">|</span>
<a href="javascript:;" id="thismonth"<? if($now_choose == 'thismonth') { ?> class="a"<? } ?>>最近30天发帖数</a><span class="pipe">|</span>
<a href="javascript:;" id="today"<? if($now_choose == 'today') { ?> class="a"<? } ?>>最近24小时发帖数</a>
</p>
<script type="text/javascript">changeOrderRange('orderby');</script>
<? } ?>
<div class="xld xlda"><? if(is_array($list)) foreach($list as $key => $value) { ?><dl class="bbda cl">
<dd class="m avt"><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" target="_blank" c="1"><?php echo avatar($value[uid],small); ?></a></dd>
<dt class="y">
<p class="xw0"><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" target="_blank">去串个门</a></p>
<p class="xw0"><a href="home.php?mod=spacecp&amp;ac=poke&amp;op=send&amp;uid=<?=$value['uid']?>" id="a_poke_<?=$key?>" onclick="showWindow(this.id, this.href, 'get', 0);" title="打个招呼">打个招呼</a></p>
<p class="xw0"><a href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?=$value['uid']?>&amp;touid=<?=$value['uid']?>&amp;pmid=0&amp;daterange=2" id="a_sendpm_<?=$key?>" onclick="showWindow('showMsgBox', this.href, 'get', 0)">发送消息</a></p>
<? if(isset($value['isfriend']) && !$value['isfriend']) { ?><p class="xw0"><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?=$value['uid']?>" id="a_friend_<?=$key?>" onclick="showWindow('friend_<?=$key?>', this.href, 'get', 0)" title="加为好友">加为好友</a></p><? } ?>
</dt>
<dt>
<a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" title="<?=$value['username']?>" target="_blank"<?php g_color($value[groupid]); ?>><?=$value['nickname']?></a>
<? if($ols[$value['uid']]) { ?><img src="<?=IMGDIR?>/ol.gif" alt="online" title="在线" class="vm" /> <? } ?> <? if($value['videophotostatus']) { ?>&nbsp;<img src="<?=IMGDIR?>/videophoto.gif" style="vertical-align:middle;" title="视频认证 已认证" /><? } ?>
</dt>
<dd>
<p>
<?=$_G['cache']['usergroups'][$value['groupid']]['grouptitle']?> <?php g_icon($value[groupid]); if($value['credits']) { ?>&nbsp;积分数: <?=$value['credits']?><? } if($value['posts']) { ?>&nbsp;帖子数: <?=$value['posts']?><? } if($value['blogs']) { ?>&nbsp;日志数: <?=$value['blogs']?><? } if($value['views']) { ?>&nbsp;人气: <?=$value['views']?><? } ?>
</p>

<? if($value['friends']) { ?><p>好友数: <?=$value['friends']?></p><? } if($value['lastactivity']) { ?><p>最后活跃: <?=$value['lastactivity']?></p><? } if($value['show_credit']) { ?><p>竞价<?=$extcredits[$creditid]['title']?>: <?=$value['show_credit']?> <?=$extcredits[$creditid]['unit']?></p><? } if($value['show_note']) { ?><p>竞价宣言: <?=$value['show_note']?></p><? } if($value['spacenote']) { ?><p><?=$value['spacenote']?></p><? } ?>
</dd>
</dl>
<? } if($multi) { ?><div class="bm bw0 pgs cl"><?=$multi?></div><? } ?>
</div>
<? } else { ?>
<div class="emp">没有相关成员。</div>
<? } ?>