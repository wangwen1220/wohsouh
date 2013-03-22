<? if(!defined('IN_DISCUZ')) exit('Access Denied'); if($list) { ?>
<ul><? if(is_array($list)) foreach($list as $value) { if($value['uid']) { ?>
<li class="ptn pbn<?=$value['class']?>" style="<?=$value['style']?>">
<a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" class="lit"><?=$value['nickname']?></a>: <?=$value['message']?> <span class="xg1">(<?php echo dgmdate($value['dateline'], 'n-j H:i'); ?>)</span>
<? if($_G['uid']) { ?>
<a href="javascript:;" onclick="docomment_form(<?=$value['doid']?>, <?=$value['id']?>, '<?=$_G['gp_key']?>');">回复</a>
<? } if($value['uid']==$_G['uid'] || $dv['uid']==$_G['uid'] || checkperm('managedoing')) { ?>
 <a href="home.php?mod=spacecp&amp;ac=doing&amp;op=delete&amp;doid=<?=$value['doid']?>&amp;id=<?=$value['id']?>&amp;handlekey=doinghk_<?=$value['doid']?>_<?=$value['id']?>" id="<?=$_G['gp_key']?>_doing_delete_<?=$value['doid']?>_<?=$value['id']?>" onclick="showWindow(this.id, this.href, 'get', 0);">删除</a>
<? } if(checkperm('managedoing')) { ?>
<span class="xg1 xw0">IP: <?=$value['ip']?></span>
<? } ?>
<div id="<?=$_G['gp_key']?>_form_<?=$value['doid']?>_<?=$value['id']?>"></div>
</li>
<? } } ?>
</ul>
<? } ?>
<div class="tri"></div>