<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_search');
0
|| checktplrefresh('./template/huoshow/home/spacecp_search.htm', './template/huoshow/common/userabout.htm', 1331868579, '2', './data/template/6_2_home_spacecp_search.tpl.php', './template/huoshow', 'home/spacecp_search')
;?><? include template('common/header'); ?><div id="pt" class="bm cl"><!-- common/simplesearchform --><div class="z"><a href="./" class="nvhm" title="首页"><?=$_G['setting']['bbname']?></a> <em>&rsaquo;</em> <a href="home.php"><?=$_G['setting']['navs']['4']['navname']?></a> <em>&rsaquo;</em> 好友</div>
</div>
<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<h1 class="mt"><img alt="friend" src="<?=STATICURL?>image/feed/friend.gif" class="vm" /> 好友</h1>
<ul class="tb cl">
<li><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=friend">好友列表</a></li>
<li class="a"><a href="home.php?mod=spacecp&amp;ac=search">查找好友</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=find">可能认识的人</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=invite">邀请好友</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=request">好友请求</a></li>
</ul>
<div class="tbmu">
<a href="home.php?mod=spacecp&amp;ac=search&amp;op=sex"<? if($_GET['op'] == 'sex') { ?> class="a"<? } ?>>查找男女朋友</a><span class="pipe">|</span>
<a href="home.php?mod=spacecp&amp;ac=search&amp;op=reside"<? if($_GET['op'] == 'reside') { ?> class="a"<? } ?>>查找同城的人</a><span class="pipe">|</span>
<a href="home.php?mod=spacecp&amp;ac=search&amp;op=birth"<? if($_GET['op'] == 'birth') { ?> class="a"<? } ?>>查找老乡</a><span class="pipe">|</span>
<a href="home.php?mod=spacecp&amp;ac=search&amp;op=birthyear"<? if($_GET['op'] == 'birthyear') { ?> class="a"<? } ?>>查找同年同月同日生的人</a><span class="pipe">|</span>
<? if($fields['graduateschool'] || $fields['education']) { ?>
<a href="home.php?mod=spacecp&amp;ac=search&amp;op=edu"<? if($_GET['op'] == 'edu') { ?> class="a"<? } ?>>查找你的同学</a><span class="pipe">|</span>
<? } if($fields['occupation'] || $fields['title']) { ?>
<a href="home.php?mod=spacecp&amp;ac=search&amp;op=work"<? if($_GET['op'] == 'work') { ?> class="a"<? } ?>>查找你的同事</a><span class="pipe">|</span>
<? } ?>
<a href="home.php?mod=spacecp&amp;ac=search&amp;op=name"<? if($_GET['op'] == 'name') { ?> class="a"<? } ?>>精确查找</a><span class="pipe">|</span>
<a href="home.php?mod=spacecp&amp;ac=search"<? if($_GET['op'] == '') { ?> class="a"<? } ?>>高级方式查找</a>
</div>
<? if(!empty($_GET['searchsubmit'])) { if(empty($list)) { ?>
<div class="emp">没有找到相关用户。<a href="home.php?mod=spacecp&amp;ac=search">换个搜索条件试试</a></div>
<? } else { ?>
<div class="tbmu">以下是查找到的用户列表(最多显示100个)，你还可以<a href="home.php?mod=spacecp&amp;ac=search">换个搜索条件试试</a>。</div><? include template('home/space_list'); } } else { ?>
<div class="ptm scf">
<? if($_GET['op'] == 'sex') { ?>
<h2>查找男女朋友</h2>
<div id="s_sex" class="bm bmn">
<form action="home.php" method="get">
<table cellpadding="0" cellspacing="0" class="tfm"><? if(is_array(array('affectivestatus','lookingfor','zodiac','constellation'))) foreach(array('affectivestatus','lookingfor','zodiac','constellation') as $key) { if($fields[$key]) { ?>
<tr>
<th><?=$fields[$key]['title']?></th>
<td><?=$fields[$key]['html']?></td>
</tr>
<? } } ?>
<tr>
<th>性别:</th>
<td>
<select id="gender" name="gender">
<option value="0">任意</option>
<option value="1">男</option>
<option value="2">女</option>
</select>
</td>
</tr>
<tr>
<th>年龄段</th>
<td><input type="text" name="startage" value="" size="10" class="px" style="width: 114px;" /> ~ <input type="text" name="endage" value="" size="10" class="px" style="width: 114px;" /></td>
</tr>
<tr>
<th>上传头像</th>
<td class="pcl"><label><input type="checkbox" name="avatarstatus" value="1" class="pc" />已经上传头像</label></td>
</tr>
<tr>
<th>用户名</th>
<td><input type="text" name="username" value="" class="px" /></td>
</tr>
<tr>
<th>&nbsp;</th>
<td>
<input type="hidden" name="searchsubmit" value="true" />
<button type="submit" class="pn"><em>查找</em></button>
</td>
</tr>
</table>
<input type="hidden" name="op" value="<?=$_G['gp_op']?>" />
<input type="hidden" name="mod" value="spacecp" />
<input type="hidden" name="ac" value="search" />
<input type="hidden" name="type" value="base" />
</form>
</div>
<? } elseif($_GET['op'] == 'reside' ) { ?>
<h2>查找同城的人</h2>
<div id="s_reside" class="bm bmn">
<form action="home.php" method="get">
<table cellpadding="0" cellspacing="0" class="tfm">
<tr>
<th>居住地</th>
<td id="residecitybox"><?=$residecityhtml?></td>
</tr>
<tr>
<th>用户名</th>
<td><input type="text" name="username" value="" class="px" /></td>
</tr>
<tr>
<th>&nbsp;</th>
<td>
<input type="hidden" name="searchsubmit" value="true" />
<button type="submit" class="pn"><em>查找</em></button>
</td>
</tr>
</table>
<input type="hidden" name="op" value="<?=$_G['gp_op']?>" />
<input type="hidden" name="mod" value="spacecp">
<input type="hidden" name="ac" value="search">
<input type="hidden" name="type" value="base">
</form>
</div>
<? } elseif($_GET['op'] == 'birth' ) { ?>
<h2>查找老乡</h2>
<div id="s_birth" class="bm bmn">
<form action="home.php" method="get">
<table cellpadding="0" cellspacing="0" class="tfm">
<tr>
<th>出生地</th>
<td id="birthcitybox"><?=$birthcityhtml?></td>
</tr>
<tr>
<th>用户名</th>
<td><input type="text" name="username" value="" class="px" /></td>
</tr>
<tr>
<th>&nbsp;</th>
<td>
<input type="hidden" name="searchsubmit" value="true" />
<button type="submit" class="pn"><em>查找</em></button>
</td>
</tr>
</table>
<input type="hidden" name="op" value="<?=$_G['gp_op']?>" />
<input type="hidden" name="mod" value="spacecp" />
<input type="hidden" name="ac" value="search" />
<input type="hidden" name="type" value="base" />
</form>
</div>
<? } elseif($_GET['op'] == 'birthyear' ) { ?>
<h2>查找同年同月同日生的人</h2>
<div id="s_birthyear" class="bm bmn">
<form action="home.php" method="get">
<table cellpadding="0" cellspacing="0" class="tfm">
<tr>
<th>生日</th>
<td>
<select id="birthyear" name="birthyear" onchange="showbirthday();" class="ps">
<option value="0">&nbsp;</option>
<?=$birthyeayhtml?>
</select> 年
<select id="birthmonth" name="birthmonth" onchange="showbirthday();" class="ps">
<option value="0">&nbsp;</option>
<?=$birthmonthhtml?>
</select> 月
<select id="birthday" name="birthday" class="ps">
<option value="0">&nbsp;</option>
<?=$birthdayhtml?>
</select> 日
</td>
</tr>
<tr>
<th>用户名</th>
<td><input type="text" name="username" value="" class="px" /></td>
</tr>
<tr>
<th>&nbsp;</th>
<td>
<input type="hidden" name="searchsubmit" value="true" />
<button type="submit" class="pn"><em>查找</em></button>
</td>
</tr>
</table>
<input type="hidden" name="op" value="<?=$_G['gp_op']?>" />
<input type="hidden" name="mod" value="spacecp" />
<input type="hidden" name="ac" value="search" />
<input type="hidden" name="type" value="base" />
</form>
</div>
<? } elseif($_GET['op'] == 'edu' ) { if($fields['graduateschool'] || $fields['education']) { ?>
<h2>查找你的同学</h2>
<div id="s_edu" class="bm bmn">
<form action="home.php" method="get">
<table cellpadding="0" cellspacing="0" class="tfm"><? if(is_array(array('graduateschool','education'))) foreach(array('graduateschool','education') as $key) { if($fields[$key]) { ?>
<tr>
<th><?=$fields[$key]['title']?></th>
<td><?=$fields[$key]['html']?></td>
</tr>
<? } } ?>
<tr>
<th>用户名</th>
<td><input type="text" name="username" value="" class="px"></td>
</tr>
<tr>
<th>&nbsp;</th>
<td>
<input type="hidden" name="searchsubmit" value="true" />
<button type="submit" class="pn"><em>查找</em></button>
</td>
</tr>
</table>
<input type="hidden" name="op" value="<?=$_G['gp_op']?>" />
<input type="hidden" name="mod" value="spacecp" />
<input type="hidden" name="ac" value="search" />
<input type="hidden" name="type" value="edu" />
</form>
</div>
<? } } elseif($_GET['op'] == 'work' ) { if($fields['occupation'] || $fields['title']) { ?>
<h2>查找你的同事</h2>
<div id="s_work" class="bm bmn">
<form action="home.php" method="get">
<table cellpadding="0" cellspacing="0" class="tfm"><? if(is_array(array('occupation','title'))) foreach(array('occupation','title') as $key) { if($fields[$key]) { ?>
<tr>
<th><?=$fields[$key]['title']?></th>
<td><?=$fields[$key]['html']?></td>
</tr>
<? } } ?>
<tr>
<th>用户名</th>
<td><input type="text" name="username" value="" class="px" /></td>
</tr>
<tr>
<th>&nbsp;</th>
<td>
<input type="hidden" name="searchsubmit" value="true" />
<button type="submit" class="pn"><em>查找</em></button>
</td>
</tr>
</table>
<input type="hidden" name="op" value="<?=$_G['gp_op']?>" />
<input type="hidden" name="mod" value="spacecp" />
<input type="hidden" name="ac" value="search" />
<input type="hidden" name="type" value="work" />
</form>
</div>
<? } } elseif($_GET['op'] == 'name' ) { ?>
<h2>精确查找</h2>
<div id="s_name" class="bm bmn">
<form action="home.php" method="get">
<table cellpadding="0" cellspacing="0" class="tfm">
<tr>
<th>用户名</th>
<td><input type="text" name="username" value="" class="px" /></td>
</tr>
<tr>
<th>用户UID</th>
<td><input type="text" name="uid" value="" class="px" /></td>
</tr>
<tr>
<th>&nbsp;</th>
<td>
<input type="hidden" name="searchsubmit" value="true" />
<button type="submit" class="pn"><em>查找</em></button>
</td>
</tr>
</table>
<input type="hidden" name="op" value="<?=$_G['gp_op']?>" />
<input type="hidden" name="mod" value="spacecp" />
<input type="hidden" name="ac" value="search" />
<input type="hidden" name="type" value="base" />
</form>
</div>
<? } else { ?>
<h2>高级方式查找</h2>
<div class="bm bmn">
<form action="home.php" method="get">
<table cellpadding="0" cellspacing="0" class="tfm">
<tr>
<th>用户名</th>
<td><input type="text" name="username" value="" class="px" /></td>
</tr>
<tr>
<th>用户UID</th>
<td><input type="text" name="uid" value="" class="px" /></td>
</tr>
<tr>
<th>性别:</th>
<td>
<select id="gender" name="gender">
<option value="0">任意</option>
<option value="1">男</option>
<option value="2">女</option>
</select>
</td>
</tr>
<tr>
<th>年龄段</th>
<td><input type="text" name="startage" value="" size="10" class="px" style="width: 114px;" /> ~ <input type="text" name="endage" value="" size="10" class="px" style="width: 114px;" /></td>
</tr>
<tr>
<th>上传头像</th>
<td class="pcl"><label><input type="checkbox" name="avatarstatus" value="1" class="pc" />已经上传头像</label></td>
</tr>
<tr>
<th>居住地</th>
<td id="residecitybox"><?=$residecityhtml?></td>
</tr>
<tr>
<th>出生地</th>
<td id="birthcitybox"><?=$birthcityhtml?></td>
</tr>
<tr>
<th>生日</th>
<td>
<select id="birthyear" name="birthyear" onchange="showbirthday();" class="ps">
<option value="0">&nbsp;</option>
<?=$birthyeayhtml?>
</select> 年
<select id="birthmonth" name="birthmonth" onchange="showbirthday();" class="ps">
<option value="0">&nbsp;</option>
<?=$birthmonthhtml?>
</select> 月
<select id="birthday" name="birthday" class="ps">
<option value="0">&nbsp;</option>
<?=$birthdayhtml?>
</select> 日
</td>
</tr><? if(is_array($fields)) foreach($fields as $fkey => $fvalue) { ?><tr>
<th><?=$fvalue['title']?></th>
<td><?=$fvalue['html']?></td>
</tr>
<? } ?>
<tr>
<th>&nbsp;</th>
<td>
<input type="hidden" name="searchsubmit" value="true" />
<button type="submit" class="pn"><em>查找</em></button>
</td>
</tr>
</table>
<input type="hidden" name="op" value="<?=$_G['gp_op']?>" />
<input type="hidden" name="mod" value="spacecp" />
<input type="hidden" name="ac" value="search" />
<input type="hidden" name="type" value="all" />
</form>
</div>
<? } ?>
</div>
<? } ?>
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
</div><? include template('common/footer'); ?>