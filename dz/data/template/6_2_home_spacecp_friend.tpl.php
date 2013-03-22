<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_friend');
0
|| checktplrefresh('./template/huoshow/home/spacecp_friend.htm', './template/huoshow/common/userabout.htm', 1331861300, '2', './data/template/6_2_home_spacecp_friend.tpl.php', './template/huoshow', 'home/spacecp_friend')
;?><? include template('common/header'); if(!$_G['inajax']) { ?>
<div id="pt" class="bm cl"><!-- common/simplesearchform --><div class="z">
<a href="./" class="nvhm" title="首页"><?=$_G['setting']['bbname']?></a> <em>&rsaquo;</em> <a href="home.php"><?=$_G['setting']['navs']['4']['navname']?></a> <em>&rsaquo;</em> 好友
</div>
</div>

<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<? } if(!$_G['inajax'] && ($op == 'syn' || $op == 'find' || $op == 'search' || $op == 'group' || $op == 'request')) { ?>
<h1 class="mt"><img alt="friend" src="<?=STATICURL?>image/feed/friend.gif" class="vm" /> 好友</h1>
<ul class="tb cl">
<li><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=friend">好友列表</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=search">查找好友</a></li>
<li<?=$actives['find']?>><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=find">可能认识的人</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=invite">邀请好友</a></li>
<li<?=$actives['request']?>><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=request">好友请求</a></li>
<? if($op=='group') { ?>
<li<?=$actives['group']?>><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=group">好友分组</a></li>
<? } ?>
</ul>
<? } if($op =='ignore') { ?>
<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">忽略好友</em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<form method="post" autocomplete="off" id="friendform_<?=$uid?>" name="friendform_<?=$uid?>" action="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid=<?=$uid?>&amp;confirm=1" <? if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?=$_G['gp_handlekey']?>');"<? } ?>>
<input type="hidden" name="referer" value="<?=$_G['referer']?>">
<input type="hidden" name="friendsubmit" value="true" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<input type="hidden" name="from" value="<?=$_G['gp_from']?>" />
<? if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" /><? } ?>
<div class="c">确定忽略好友关系吗？</div>
<p class="o pns">
<button type="submit" name="friendsubmit_btn" class="pn pnc" value="true"><strong>确定</strong></button>
</p>
</form>
<script type="text/javascript">
function succeedhandle_<?=$_G['gp_handlekey']?>(url, msg, values) {
if(values['from'] == 'notice') {
getNewFriendQuery(values['uid']);
} else if(typeof friend_delete == 'function') {
friend_delete(values['uid']);
}
}
</script>
<? } elseif($op == 'find') { if(!empty($recommenduser)) { ?>
<h2 class="mtm pbm bbs">站长推荐用户</h2>
<ul class="buddy cl"><? if(is_array($recommenduser)) foreach($recommenduser as $key => $value) { ?><li>
<div class="avt"><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" title="<?=$value['username']?>" target="_blank" c="1"><?php echo avatar($value[uid],small); ?></a></div>
<h4><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" title="<?=$value['username']?>"><?=$value['username']?></a></h4>
<p title="<?=$value['reason']?>" class="maxh"><?=$value['reason']?></p>
<p class="xg1"><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?=$value['uid']?>" id="a_near_friend_<?=$key?>" onclick="showWindow(this.id, this.href, 'get', 0);">加为好友</a></p>
</li>
<? } ?>
</ul>
<? } if($nearlist) { ?>
<h2 class="mtm pbm bbs">惊喜，他们就在你的附近</h2>
<ul class="buddy cl"><? if(is_array($nearlist)) foreach($nearlist as $key => $value) { ?><li>
<div class="avt"><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" title="<?=$value['username']?>" target="_blank" c="1"><?php echo avatar($value[uid],small); ?></a></div>
<h4><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" title="<?=$value['username']?>"><?=$value['username']?></a></h4>
<p class="xg1"><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?=$value['uid']?>" id="a_near_friend_<?=$key?>" onclick="showWindow(this.id, this.href, 'get', 0);">加为好友</a></p>
</li>
<? } ?>
</ul>
<? } if($friendlist) { ?>
<h2 class="mtm pbm bbs">他们是你的好友的好友，你也可能认识</h2>
<ul class="buddy cl"><? if(is_array($friendlist)) foreach($friendlist as $key => $value) { ?><li>
<div class="avt"><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" title="<?=$value['username']?>" target="_blank" c="1"><?php echo avatar($value[uid],small); ?></a></div>
<h4><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" title="<?=$value['username']?>"><?=$value['username']?></a></h4>
<p class="xg1"><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?=$value['uid']?>&amp;handlekey=friendhk_<?=$value['uid']?>" id="a_friend_friend_<?=$key?>" onclick="showWindow(this.id, this.href, 'get', 0);">加为好友</a></p>
</li>
<? } ?>
</ul>
<? } if($onlinelist) { ?>
<h2 class="mtm pbm bbs">他们当前正在线，加为好友就可以互动啦</h2>
<ul class="buddy cl"><? if(is_array($onlinelist)) foreach($onlinelist as $key => $value) { ?><li>
<div class="avt"><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" title="<?=$value['username']?>" target="_blank" c="1"><?php echo avatar($value[uid],small); ?></a></div>
<h4><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" title="<?=$value['username']?>"><?=$value['username']?></a></h4>
<p class="xg1"><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?=$value['uid']?>&amp;handlekey=onlinehk_<?=$value['uid']?>" id="a_online_friend_<?=$key?>" onclick="showWindow(this.id, this.href, 'get', 0);">加为好友</a></p>
</li>
<? } ?>
</ul>
<? } } elseif($op == 'search') { ?>

<h3 class="tbmu">搜索用户结果:</h3><? include template('home/space_list'); } elseif($op=='changenum') { ?>
<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">好友热度</em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<form method="post" autocomplete="off" id="changenumform_<?=$uid?>" name="changenumform_<?=$uid?>" action="home.php?mod=spacecp&amp;ac=friend&amp;op=changenum&amp;uid=<?=$uid?>">
<input type="hidden" name="referer" value="<?=$_G['referer']?>">
<? if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" /><? } ?>
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<div class="c">
<p>调整好友的热度</p>
<p>新的热度:<input type="text" name="num" value="<?=$friend['num']?>" size="5" class="px" /> (0~9999之间的一个数字)</p>
</div>
<p class="o pns">
<button type="submit" name="changenumsubmit" class="pn pnc" value="true"><strong>确定</strong></button>
</p>
</form>
<script type="text/javascript" reload="1">
function succeedhandle_<?=$_G['gp_handlekey']?>(url, msg, values) {
friend_delete(values['uid']);
$('spannum_'+values['fid']).innerHTML = values['num'];
hideWindow('<?=$_G['gp_handlekey']?>');
}
</script>
<? } elseif($op=='changegroup') { ?>
<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">好友分组</em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<form method="post" autocomplete="off" id="changegroupform_<?=$uid?>" name="changegroupform_<?=$uid?>" action="home.php?mod=spacecp&amp;ac=friend&amp;op=changegroup&amp;uid=<?=$uid?>">
<input type="hidden" name="referer" value="<?=$_G['referer']?>">
<input type="hidden" name="changegroupsubmit" value="true" />
<? if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" /><? } ?>
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<div class="c">
<p>好友分组</p>
<table><tr><?php $i=0; if(is_array($groups)) foreach($groups as $key => $value) { ?><td style="padding:8px 8px 0 0;"><label><input type="radio" name="group" value="<?=$key?>"<?=$groupselect[$key]?>> <?=$value?></label></td>
<? if($i%2==1) { ?></tr><tr><? } ?><?php $i++; } ?>
</tr></table>
</div>
<p class="o pns">
<button type="submit" name="changegroupsubmit_btn" class="pn pnc" value="true"><strong>确定</strong></button>
</p>
</form>
<script type="text/javascript">
function succeedhandle_<?=$_G['gp_handlekey']?>(url, msg, values) {
friend_changegroup(values['gid']);
}
</script>

<? } elseif($op=='editnote') { ?>

<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">好友备注</em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<form method="post" autocomplete="off" id="editnoteform_<?=$uid?>" name="editnoteform_<?=$uid?>" action="home.php?mod=spacecp&amp;ac=friend&amp;op=editnote&amp;uid=<?=$uid?>" <? if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?=$_G['gp_handlekey']?>');"<? } ?>>
<input type="hidden" name="referer" value="<?=$_G['referer']?>">
<input type="hidden" name="editnotesubmit" value="true" />
<? if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" /><? } ?>
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<div class="c">
<p>为当前好友填写一句话备注，便于自己识别</p>
<input type="text" name="note" class="px mtn" value="<?=$friend['note']?>" size="50" />
</div>
<p class="o pns">
<button type="submit" name="editnotesubmit_btn" class="pn pnc" value="true"><strong>确定</strong></button>
</p>
</form>
<script type="text/javascript">
function succeedhandle_<?=$_G['gp_handlekey']?>(url, msg, values) {
var uid=values['uid'];
var elem = $('friend_note_'+uid);
if(elem) {
elem.innerHTML = values['note'];
}
}
</script>

<? } elseif($op=='group') { ?>

<p class="tbmu">
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=group"<? if(!isset($_GET['group'])) { ?> class="a"<? } ?>>全部好友</a><? if(is_array($groups)) foreach($groups as $key => $value) { ?><span class="pipe">|</span><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=group&amp;group=<?=$key?>"<? if(isset($_GET['group']) && $_GET['group']==$key) { ?> class="a"<? } ?>><?=$value?></a>
<? } ?>
</p>
<p class="tbmu">对选定的好友进行分组，热度表示的是你跟好友互动的次数。</p>

<? if($list) { ?>
<form method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=friend&amp;op=group&amp;ref">
<div id="friend_ul">
<ul class="buddy cl"><? if(is_array($list)) foreach($list as $key => $value) { ?><li>
<div class="avt"><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>"><?php echo avatar($value[uid],small); ?></a></div>
<h4><input type="checkbox" name="fuids[]" value="<?=$value['uid']?>" class="pc" /> <a href="home.php?mod=space&amp;uid=<?=$value['uid']?>"><?=$value['username']?></a></h4>
<p class="xg1">热度:<?=$value['num']?></p>
<p class="xg1"><?=$value['group']?></p>
</li>
<? } ?>
</ul>
</div>
<div class="mtn">
<input type="checkbox" id="chkall" name="chkall" onclick="checkAll(this.form, 'fuids')" class="pc" />
<label for="chkall">全选</label>
设置用户组:
<select name="group" class="ps vm"><? if(is_array($groups)) foreach($groups as $key => $value) { ?><option value="<?=$key?>"><?=$value?></option>
<? } ?>
</select>&nbsp;
<button type="submit" name="btnsubmit" value="true" class="pn pnp vm"><strong>确定</strong></button>
</div>
<? if($multi) { ?><div class="pgs cl mtm"><?=$multi?></div><? } ?>
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<input type="hidden" name="groupsubmin" value="true" />
</form>
<? } else { ?>
<div class="emp">没有相关用户列表。</div>
<? } } elseif($op=='groupname') { ?>
<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">好友组</em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<div id="__groupnameform_<?=$group?>">
<form method="post" autocomplete="off" id="groupnameform_<?=$group?>" name="groupnameform_<?=$group?>" action="home.php?mod=spacecp&amp;ac=friend&amp;op=groupname&amp;group=<?=$group?>" <? if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?=$_G['gp_handlekey']?>');"<? } ?>>
<input type="hidden" name="referer" value="<?=$_G['referer']?>">
<input type="hidden" name="groupnamesubmit" value="true" />
<? if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" /><? } ?>
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<div class="c">
<p>设置新好友分组名</p>
<p class="mtm">新名称:<input type="text" name="groupname" value="<?=$groups[$group]?>" size="15" class="px" /></p>
</div>
<p class="o pns">
<button type="submit" name="groupnamesubmit_btn" value="true" class="pn pnc"><strong>确定</strong></button>
</p>
</form>
<script type="text/javascript">
function succeedhandle_<?=$_G['gp_handlekey']?>(url, msg, values) {
friend_changegroupname(values['gid']);
}
</script>
</div>

<? } elseif($op=='groupignore') { ?>
<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">调整用户组动态</em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<div id="<?=$group?>">
<form method="post" autocomplete="off" id="groupignoreform" name="groupignoreform" action="home.php?mod=spacecp&amp;ac=friend&amp;op=groupignore&amp;group=<?=$group?>" <? if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?=$_G['gp_handlekey']?>');"<? } ?>>
<input type="hidden" name="referer" value="<?=$_G['referer']?>">
<input type="hidden" name="groupignoresubmit" value="true" />
<? if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" /><? } ?>
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<div class="c">
<? if(!isset($space['privacy']['filter_gid'][$group])) { ?>
<p>在首页不显示该用户组的好友动态</p>
<? } else { ?>
<p>在首页显示该用户组的好友动态</p>
<? } ?>
</div>
<p class="o pns">
<button type="submit" name="groupignoresubmit_btn" class="pn pnc" value="true"><strong>确定</strong></button>
</p>
</form>
</div>
<? } elseif($op=='request') { ?>

<div class="tbmu">
<? if($list) { ?>
<div class="y">
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=addconfirm&amp;key=<?=$space['key']?>">批准全部申请</a><span class="pipe">|</span><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;confirm=1&amp;key=<?=$space['key']?>" onclick="return confirm('你确定要忽略所有的好友申请吗？');">忽略所有好友申请(慎用)</a>
</div>
<? } ?>
<span id="add_friend_div">请选定好友的申请进行批准或忽略</span>
<? if($maxfriendnum) { ?>
(最多可以添加 <?=$maxfriendnum?> 个好友)
<p>
<? if($_G['magic']['friendnum']) { ?>
<img src="<?=STATICURL?>image/magic/friendnum.small.gif" alt="friendnum" class="vm" />
<a id="a_magic_friendnum" href="home.php?mod=magic&amp;mid=friendnum" onclick="showWindow(this.id, this.href, 'get', '0')">我要扩容好友数</a>
(你可以购买道具“<?=$_G['setting']['magics']['friendnum']?>”来扩容，让自己可以添加更多的好友。)
<? } ?>
</p>
<? } ?>
</div>
<? if($list) { ?>
<ul id="friend_ul"><? if(is_array($list)) foreach($list as $key => $value) { ?><li id="friend_tbody_<?=$value['fuid']?>">
<table cellpadding="0" cellspacing="0" class="tfm">
<tr>
<td width="140">
<div class="avt avtm"><a href="home.php?mod=space&amp;uid=<?=$value['fuid']?>" c="1"><?php echo avatar($value[fuid],middle); ?></a></div>
</td>
<td>
<h4>
<a href="home.php?mod=space&amp;uid=<?=$value['fuid']?>"><?=$value['fusername']?></a>
<? if($ols[$value['fuid']]) { ?><img src="<?=IMGDIR?>/ol.gif" alt="online" title="在线" class="vm" /> <? } if($value['videostatus']) { ?>
<img src="<?=IMGDIR?>/videophoto.gif" alt="videophoto" class="vm" /> <span class="xg1">已通过视频认证</span>
<? } ?>
</h4>
<div id="friend_<?=$value['fuid']?>">
<? if($value['note']) { ?><div class="quote"><blockquote id="quote"><?=$value['note']?></blockquote></div><? } ?>
<p><?php echo dgmdate($value[dateline], 'n-j H:i'); ?></p>
<p><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=getcfriend&amp;fuid=<?=$value['fuid']?>&amp;handlekey=cfrfriendhk_<?=$value['uid']?>" id="a_cfriend_<?=$key?>" onclick="showWindow(this.id, this.href, 'get', 0);" class="xi2">查看你们的共同好友</a></p>
<p class="mtm cl pns">
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?=$value['fuid']?>&amp;handlekey=afrfriendhk_<?=$value['uid']?>" id="afr_<?=$value['fuid']?>" onclick="showWindow(this.id, this.href, 'get', 0);" class="pn z"><em class="z">批准申请</em></a>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid=<?=$value['fuid']?>&amp;confirm=1&amp;handlekey=afifriendhk_<?=$value['uid']?>" id="afi_<?=$value['fuid']?>" onclick="showWindow(this.id, this.href, 'get', 0);" class="z ptn">忽略</a>
</p>
</div>
</td>
</tr>
<tbody id="cf_<?=$value['fuid']?>"></tbody>
</table>
</li>
<? } ?>
</ul>
<? if($multi) { ?><div class="pgs cl mtm"><?=$multi?></div><? } } else { ?>
<div class="emp">没有新的好友请求。</div>
<? } } elseif($op=='getcfriend') { ?>

<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">共同好友</em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<div class="c" style="width: 370px;">
<? if($list) { if(count($list)>14) { ?>
<p>当前最多显示 15 位共同的好友</p>
<? } else { ?>
<p>你们目前有 <?php echo count($list) ?> 位共同的好友</p>
<? } ?>
<ul class="mtm ml mls cl"><? if(is_array($list)) foreach($list as $key => $value) { ?><li>
<div class="avt"><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>"><?php echo avatar($value[uid],small); ?></a></div>
<p><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" title="<?=$value['username']?>"><?=$value['username']?></a></p>
</li>
<? } ?>
</ul>
<? } else { ?>
<p>你们目前还没有共同的好友</p>
<? } ?>
</div>

<? } elseif($op=='add') { ?>
<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">加为好友</em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<form method="post" autocomplete="off" id="addform_<?=$tospace['uid']?>" name="addform_<?=$tospace['uid']?>" action="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?=$tospace['uid']?>" <? if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?=$_G['gp_handlekey']?>');"<? } ?>>
<input type="hidden" name="referer" value="<?=$_G['referer']?>" />
<input type="hidden" name="addsubmit" value="true" />
<? if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" /><? } ?>
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<div class="c">
<table>
<tr>
<th valign="top" width="60" class="avt"><a href="home.php?mod=space&amp;uid=<?=$tospace['uid']?>"><?php echo avatar($tospace[uid],small); ?></th>
<td valign="top">添加 <strong><?=$tospace['username']?></strong> 为好友，附言:<br />
<input type="text" name="note" value="" size="35" class="px"  onkeydown="ctrlEnter(event, 'addsubmit_btn', 1);" />
<p class="mtn xg1">(附言为可选，<?=$tospace['username']?> 会看到这条附言，最多50个字符)</p>
<p class="mtm">
分组: <select name="gid" class="ps"><? if(is_array($groups)) foreach($groups as $key => $value) { ?><option value="<?=$key?>" <? if(empty($space['privacy']['groupname']) && $key==1) { ?> selected="selected"<? } ?>><?=$value?></option>
<? } ?>
</select>
</p>
</td>
</tr>
</table>
</div>
<p class="o pns">
<button type="submit" name="addsubmit_btn" id="addsubmit_btn" value="true" class="pn pnc"><strong>确定</strong></button>
</p>
</form>
<? } elseif($op=='add2') { ?>

<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">批准请求</em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<form method="post" autocomplete="off" id="addratifyform_<?=$tospace['uid']?>" name="addratifyform_<?=$tospace['uid']?>" action="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?=$tospace['uid']?>" <? if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?=$_G['gp_handlekey']?>');"<? } ?>>
<input type="hidden" name="referer" value="<?=$_G['referer']?>" />
<input type="hidden" name="add2submit" value="true" />
<input type="hidden" name="from" value="<?=$_G['gp_from']?>" />
<? if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" /><? } ?>
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<div class="c">
<table cellspacing="0" cellpadding="0">
<tr>
<th valign="top" width="60" class="avt"><a href="home.php?mod=space&amp;uid=<?=$tospace['uid']?>"><?php echo avatar($tospace[uid],small); ?></th>
<td valign="top">
<p>批准 <strong><?=$tospace['username']?></strong> 的好友请求，并分组:</p>
<table><tr><?php $i=0; if(is_array($groups)) foreach($groups as $key => $value) { ?><td style="padding:8px 8px 0 0;"><input type="radio" name="gid" id="group_<?=$key?>" value="<?=$key?>"<?=$groupselect[$key]?>> <label for="group_<?=$key?>"><?=$value?></label></td>
<? if($i%2==1) { ?></tr><tr><? } ?><?php $i++; } ?>
</tr></table>
</td>
</tr>
</table>
</div>
<p class="o pns">
<button type="submit" name="add2submit_btn" value="true" class="pn pnc"><strong>批准</strong></button>
</p>
</form>
<script type="text/javascript">
function succeedhandle_<?=$_G['gp_handlekey']?>(url, msg, values) {
if(values['from'] == 'notice') {
getNewFriendQuery(values['uid']);
} else {
myfriend_post(values['uid']);
}
}
</script>
<? } elseif($op=='getonequery') { ?>

<dd class="m avt"><a href="home.php?mod=space&amp;uid=<?=$friendquery['fuid']?>" c="1"><?php echo avatar($friendquery[fuid],middle); ?></a></dd>
<dt id="pendingfriend_<?=$friendquery['fuid']?>">
<p class="mbm">
<a href="home.php?mod=space&amp;uid=<?=$friendquery['fuid']?>" class="xi2"><?=$friendquery['fusername']?></a>:
<span class="xw0">
请求加您为好友<? if($friendquery['note']) { ?>,&nbsp;理由:<?=$friendquery['note']?><? } ?>
&nbsp; <span class="xg1"><?php echo dgmdate($friendquery[dateline], 'n-j H:i'); ?></span>
</span>
</p>
<div class="pbn ptm xg1 xw0 cl">
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?=$friendquery['fuid']?>&amp;from=notice" id="afr_<?=$friendquery['fuid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">批准申请</a><span class="pipe">|</span>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid=<?=$friendquery['fuid']?>&amp;confirm=1&amp;from=notice" id="afi_<?=$friendquery['fuid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">忽略</a>	
</div>
</dt>

<? } elseif($op=='getinviteuser') { ?>
<?=$jsstr?>
<? } if(!$_G['inajax']) { ?>
</div>
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
<? } include template('common/footer'); ?>