<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<table cellpadding="0" cellspacing="0" class="atd">
<tr><?php $clicknum = 0; if(is_array($clicks)) foreach($clicks as $key => $value) { ?><?php $clicknum = $clicknum + $value['clicknum']; ?><?php $value['height'] = $maxclicknum?intval($value['clicknum']*50/$maxclicknum):0; if($value['available']) { ?>
<td>
<a href="home.php?mod=spacecp&amp;ac=click&amp;op=add&amp;clickid=<?=$key?>&amp;idtype=<?=$idtype?>&amp;id=<?=$id?>&amp;hash=<?=$hash?>&amp;handlekey=clickhandle" id="click_<?=$idtype?>_<?=$id?>_<?=$key?>" onclick="<? if($_G['uid']) { ?>ajaxmenu(this);<? } else { ?>showWindow(this.id, this.href);<? } ?>doane(event);">
<? if($value['clicknum']) { ?>
<div class="atdc">
<div class="ac<?=$value['classid']?>" style="height:<?=$value['height']?>px;">
<em><?=$value['clicknum']?></em>
</div>
</div>
<? } ?>
<img src="<?=STATICURL?>image/click/<?=$value['icon']?>" alt="" /><br /><?=$value['name']?>
</a>
</td>
<? } } ?>
</tr>
</table>
<script type="text/javascript">
function errorhandle_clickhandle(message, values) {
if(values['id']) {
showCreditPrompt();
show_click(values['idtype'], values['id'], values['clickid']);
}
}
</script>

<? if($clickuserlist) { ?>
<h3 class="mbm xs1">
刚表态过的朋友 (<a href="javascript:;" onclick="show_click('<?=$idtype?>', '<?=$id?>', '<?=$key?>')"><?=$clicknum?> 人</a>)
<? if($_G['magic']['anonymous']) { ?>
<img src="<?=STATICURL?>image/magic/anonymous.small.gif" alt="anonymous" class="vm" />
<a id="a_magic_anonymous" href="home.php?mod=magic&amp;mid=anonymous&amp;idtype=<?=$idtype?>&amp;id=<?=$id?>" onclick="ajaxmenu(event,this.id, 1)" class="xg1"><?=$_G['magic']['anonymous']?></a>
<? } ?>
</h3>
<div id="trace_div" class="xs1">
<ul id="trace_ul" class="ml mls cl"><? if(is_array($clickuserlist)) foreach($clickuserlist as $value) { ?><li>
<? if($value['username']) { ?>
<div class="avt"><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" target="_blank" title="<?=$value['clickname']?>"><?php echo avatar($value[uid], 'small'); ?></a></div>
<p><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>"  title="<?=$value['username']?>" target="_blank"><?=$value['username']?></a></p>
<? } else { ?>
<div class="avt"><img src="<?=STATICURL?>image/magic/hidden.gif" alt="<?=$value['clickname']?>" /></div>
<p>匿名</p>
<? } ?>
</li>
<? } ?>
</ul>
</div>
<? } if($click_multi) { ?><div class="pgs cl mtm"><?=$click_multi?></div><? } ?>
