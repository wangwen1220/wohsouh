<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_wall');
0
|| checktplrefresh('./template/huoshow/home/space_wall.htm', './template/huoshow/home/space_userabout.htm', 1332118762, '2', './data/template/6_2_home_space_wall.tpl.php', './template/huoshow', 'home/space_wall')
;?>
<?php $_G['home_tpl_titles'] = array('留言板'); include template('home/space_header'); ?><div id="ct" class="ct2 wp n cl">
<div class="mn">
<div class="bm">
<div class="bm_h">
<h1 class="mt">留言板</h1>
</div>
<div class="bm_c">
<form id="quickcommentform_<?=$space['uid']?>" action="home.php?mod=spacecp&amp;ac=comment" method="post" autocomplete="off" onsubmit="ajaxpost('quickcommentform_<?=$space['uid']?>', 'return_qcwall_<?=$space['uid']?>');doane(event);">
<p>
<span id="comment_face" title="插入表情" onclick="showFace(this.id, 'comment_message');return false;" style="cursor: pointer;"><img src="<?=IMGDIR?>/facelist.gif" alt="facelist" class="vm" /></span>
<?php if(!empty($_G['setting']['pluginhooks']['space_wall_face_extra'])) echo $_G['setting']['pluginhooks']['space_wall_face_extra']; if($_G['setting']['magicstatus'] && $_G['setting']['magics']['doodle']) { ?>
<a id="a_magic_doodle" href="home.php?mod=magic&amp;mid=doodle&amp;showid=comment_doodle&amp;target=comment_message" onclick="showWindow(this.id, this.href, 'get', '0')"><img src="<?=STATICURL?>image/magic/doodle.small.gif" alt="doodle" class="vm" /><?=$_G['setting']['magics']['doodle']?></a>
<? } ?>
</p>
<div class="tedt mtn mbn">
<div class="area">
<? if($_G['uid']) { ?>
<textarea id="comment_message" onkeydown="ctrlEnter(event, 'commentsubmit_btn');" name="message" rows="5" class="pt"></textarea>
<? } else { ?>
<div class="pt hm">你需要登录后才可以留言 <a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)" class="xi2">登录</a> | <a href="member.php?mod=<?=$_G['setting']['regname']?>" onclick="showWindow('register', this.href)" class="xi2"><?=$_G['setting']['reglinkname']?></a></div>
<? } ?>
</div>
</div>
<p>
<input type="hidden" name="referer" value="home.php?mod=space&amp;uid=<?=$wall['uid']?>&amp;do=wall" />
<input type="hidden" name="id" value="<?=$space['uid']?>" />
<input type="hidden" name="idtype" value="uid" />
<input type="hidden" name="handlekey" value="qcwall_<?=$space['uid']?>" />
<input type="hidden" name="commentsubmit" value="true" />
<input type="hidden" name="quickcomment" value="true" />
<button type="submit" name="commentsubmit_btn"value="true" id="commentsubmit_btn" class="pn"><strong>留言</strong></button>
<span id="return_qcwall_<?=$space['uid']?>"></span>
</p>
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
</form>
                <hr class="da mtm m0" />
<div id="div_main_content" class="mtm mbm">
<div id="comment">
<? if($cid) { ?>
<div class="i">
当前只显示与你操作相关的单个留言,<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=wall">点击此处查看全部留言</a>
</div>
<? } ?>
<div id="comment_ul" class="xld xlda"><? if(is_array($list)) foreach($list as $value) { include template('home/space_comment_li'); } ?>
</div>
</div>
<div class="pgs cl mtm"><?=$multi?></div>
</div>
<script type="text/javascript">
var elems = selector('dd[class~=magicflicker]'); 
for(var i=0; i<elems.length; i++){
magicColor(elems[i]);
}
function succeedhandle_qcwall_<?=$space['uid']?>(url, msg, values) {
wall_add(values['cid']);
}
</script>
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
</div><? include template('common/footer_1_5'); ?>