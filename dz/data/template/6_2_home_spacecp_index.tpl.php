<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_index');
0
|| checktplrefresh('./template/huoshow/home/spacecp_index.htm', './template/huoshow/common/seditor.htm', 1333942193, '2', './data/template/6_2_home_spacecp_index.tpl.php', './template/huoshow', 'home/spacecp_index')
;?><? include template('common/header'); if($_GET['op'] == 'start') { ?>
<ul id="contentstart" class="content">
<li><a href="javascript:;" onclick="spaceDiy.getdiy('layout');return false;"><img src="<?=STATICURL?>image/diy/layout.png" />版式</a></li>
<li><a href="javascript:;" onclick="spaceDiy.getdiy('style');return false;"><img src="<?=STATICURL?>image/diy/style.png" />风格</a></li>
<li><a href="javascript:;" onclick="spaceDiy.getdiy('block');return false;"><img src="<?=STATICURL?>image/diy/module.png" />添加模块</a></li>
<li><a href="javascript:;" onclick="spaceDiy.getdiy('diy', 'topicid', '<?=$topic['topicid']?>');return false;"><img src="<?=STATICURL?>image/diy/diy.png" />自定义</a></li>
</ul>
<? } elseif($_GET['op'] == 'layout') { ?>
<ul id="contentframe" class="content selector"><? if(is_array($layoutarr)) foreach($layoutarr as $key => $value) { ?><?php $widthstr = implode(' ',$value); ?><li id="layout<?=$key?>" data="<?=$widthstr?>"><a href="javascript:;" onclick="spaceDiy.changeLayout('<?=$key?>');this.blur();return false;"><?=$key?></a></li>
<? } ?>
</ul>

<? } elseif($_GET['op'] == 'style') { ?>
<ul class="content" style="overflow-y: auto; height: 90px;"><? if(is_array($themes)) foreach($themes as $value) { ?>  <li><a href="javascript:;" onclick="spaceDiy.changeStyle('<?=$value['dir']?>');this.blur();return false;"><img src="<?=STATICURL?><?=$value['dir']?>/preview.jpg" /><?=$value['name']?></a></li>
<? } ?>
</ul>
<? } elseif($_GET['op'] == 'block') { ?>
<ul class="blocks content selector"><? if(is_array($block)) foreach($block as $key => $value) { ?><?php if($_G['setting']['allowviewuserthread'] === false && $key == 'thread') continue; ?><?php if(!$_G['setting']['groupstatus'] && $key == 'group') continue; ?><li id="chk<?=$key?>"><a href="javascript:;" onclick="drag.toggleBlock('<?=$key?>');this.blur();return false;"><?=$value?></a></li>
<? } ?>
</ul>
<? } elseif($_GET['op'] == 'image') { ?><?php $friendsname = array(1 => '仅好友可见',2 => '指定好友可见',3 => '仅自己可见',4 => '凭密码可见'); ?><div id="diyimg_prev" class="z"><?=$multi?></div>
<ul id="imagebody"><? if(is_array($list)) foreach($list as $key => $value) { ?><li class="thumb"><a href="javascript:;" onclick="return false;"><img src="<?=$value['pic']?>" alt="" onclick="spaceDiy.setBgImage(this);"/></a></li>
<? } ?>
</ul>
<div id="diyimg_next" class="z"><?=$multi?></div>
<? if($albumlist[$albumid]['friend']) { ?>
<script type="text/javascript">showDialog('该相册中的图片<?=$friendsname[$albumlist[$albumid]['friend']]?>','alert');</script>
<? } } elseif($_GET['op'] == 'diy') { ?>
<dl class='diy'>
<dt class="cl pns">
<div class="y">
<button type="button" id="uploadmsg_button" onclick="Util.toggleEle('upload');" class="pn pnc z <? if(!$list) { ?> hide<? } ?>"><span>上传新图片</span></button>
<div id="upload" class="z<? if($list) { ?> hide<? } ?>"><iframe id="uploadframe" name="uploadframe" width="0" height="0" marginwidth="0" frameborder="0" src="about:blank"></iframe>
<form method="post" autocomplete="off" name="uploadpic" id="uploadpic" action="home.php?mod=spacecp&amp;ac=index" enctype="multipart/form-data" target="uploadframe" onsubmit="return spaceDiy.uploadSubmit();">
<input type="file" class="t_input" name="attach" size="15">
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<input type="hidden" name="albumid" value="<?=$albumid?>" />
<button type="submit" name="uploadsubmit" id="btnupload" class="pn" value="true"><span>开始上传</span></button>
</form>
</div>
<span id="uploadmsg" class="z"></span>
</div>
<span style="margin-right: 40px;">
<select name="selectalbum" id="selectalbum" onchange="spaceDiy.getdiy('image', 'albumid', this.value);"><? if(is_array($albumlist)) foreach($albumlist as $album) { ?><option value="<?=$album['albumid']?>" <?php echo $album[albumid] == $albumid ? 'selected' : ''; ?> ><?=$album['albumname']?> - (<?=$album['picnum']?> 张)</option>
<? } ?>
</select>
</span> 
<span>正在编辑:</span>
<a id="diy_tag_space_body" href="javascript:;" onclick="spaceDiy.setCurrentDiy('space_body');return false;">����</a>
<span class="pipe">|</span><a id="diy_tag_hd" href="javascript:;" onclick="spaceDiy.setCurrentDiy('hd');return false;">头部</a>
<span class="pipe">|</span><a id="diy_tag_blocktitle" href="javascript:;" onclick="spaceDiy.setCurrentDiy('blocktitle');return false;">标题栏</a>
<span class="pipe">|</span><a id="diy_tag_ct" href="javascript:;" onclick="spaceDiy.setCurrentDiy('ct');return false;">内容区</a>

<a style="margin-left: 40px;" id="bg_button" href="javascript:;" onclick="spaceDiy.hideBg();return false;">取消背景图</a>
<span class="pipe">|</span><a id="recover_button" href="javascript:;" onclick="spaceDiy.recoverStyle();return false;">恢复原装皮肤</a>
</dt>
<dd>
<div class="photo_list cl">
<div id="currentimgdiv" class="z" style="width:446px;">
<center><ul><li class="thumb" style="border:1px solid #ccc; padding:2px;"><img id="currentimg" alt="" src=""/></li></ul>
<div class="z" style="cursor:pointer" onclick="spaceDiy.changeBgImgDiv();">更换</div></center>
</div>
<div id="diyimages" class="z" style="width:446px;display:none;">
<div id="diyimg_prev" class="z"><?=$multi?></div>
<ul id="imagebody"><? if(is_array($list)) foreach($list as $key => $value) { ?><li class="thumb"><a href="javascript:;" ><img src="<?=$value['pic']?>" alt="" onclick="spaceDiy.setBgImage(this);return false;"/></a></li>
<? } ?>
</ul>
<div id="diyimg_next" class="z"><?=$multi?></div>
</div>
<div class="z" style="padding-left: 7px; width: 160px; border: solid #CCC; border-width: 0 1px;">
<table cellpadding="0" cellspacing="0">
<tr>
<td><label for="repeat_mode">图片平铺:</label></td>
<td>
<select id="repeat_mode" name="repeat_mode" onclick="spaceDiy.setBgRepeat(this.value);">
<option value="0" selected="selected">平铺</option>
<option value="1">直接使用</option>
<option value="2">横向平铺</option>
<option value="3">纵向平铺</option>
</select>
</td>
</tr>
<tr>
<td>图片位置:</td>
<td>
<table cellpadding="0" cellspacing="0" id="positiontable">
<tr>
<td id="bgimgposition0" onclick="spaceDiy.setBgPosition(this.id)">&nbsp;</td>
<td id="bgimgposition1" onclick="spaceDiy.setBgPosition(this.id)">&nbsp;</td>
<td id="bgimgposition2" onclick="spaceDiy.setBgPosition(this.id)">&nbsp;</td>
</tr>
<tr>
<td id="bgimgposition3" onclick="spaceDiy.setBgPosition(this.id)">&nbsp;</td>
<td id="bgimgposition4" onclick="spaceDiy.setBgPosition(this.id)">&nbsp;</td>
<td id="bgimgposition5" onclick="spaceDiy.setBgPosition(this.id)">&nbsp;</td>
</tr>
<tr>
<td id="bgimgposition6" onclick="spaceDiy.setBgPosition(this.id)">&nbsp;</td>
<td id="bgimgposition7" onclick="spaceDiy.setBgPosition(this.id)">&nbsp;</td>
<td id="bgimgposition8" onclick="spaceDiy.setBgPosition(this.id)">&nbsp;</td>
</tr>
</table>
</td>
</tr>
</table>
</div>
<div class="z diywin" style="padding-left: 7px; width: 160px;">
<table cellpadding="0" cellspacing="0">
<tr>
<td>背景滚动:</td>
<td>
<label for="rabga0"><input type="radio" id="rabga0" name="attachment_mode" onclick="spaceDiy.setBgAttachment(0);" class="pr" />滚动</label>
<label for="rabga1"><input type="radio" id="rabga1" name="attachment_mode" onclick="spaceDiy.setBgAttachment(1);" class="pr" />固定</label>
</td>
</tr>
<tr>
<td>背景颜色:</td>
<td><input type="text" id="colorValue" value="" size="6" onchange="spaceDiy.setBgColor(this.value);" class="px vm" style="font-size: 12px; padding: 2px;" /><?php echo getcolorpalette('bpb', 'colorValue', 'white', 'spaceDiy.setBgColor'); ?></td>
</tr>
</table>
</div>
<div class="z diywin" style="padding-left: 7px; width: 160px;">
<table cellpadding="0" cellspacing="0">
<tr>
<td>文字颜色:</td>
<td><input type="text" id="textColorValue" value="" size="6" onchange="spaceDiy.setTextColor(this.value);" class="px vm" style="font-size: 12px; padding: 2px;" /><?php echo getcolorpalette('tpb', 'textColorValue', 'white', 'spaceDiy.setTextColor'); ?></td>
</tr>
<tr>
<td>链接颜色:</td>
<td><input type="text" id="linkColorValue" value="" size="6" onchange="spaceDiy.setLinkColor(this.value);" class="px vm" style="font-size: 12px; padding: 2px;" /><?php echo getcolorpalette('lpb', 'linkColorValue', 'white', 'spaceDiy.setLinkColor'); ?></td>
</tr>
</table>
</div>
</div>
</dd>
</dl>
<? } elseif($_GET['op'] == 'getblock') { ?>
<?=$blockhtml?>
<? } elseif($_GET['op'] == 'edit') { ?>
<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">编辑模块</em>
<span>
<? if($_G['inajax']) { ?><a href="javascript:;" class="flbc" onclick="spaceDiy.delIframe();hideWindow('<?=$_G['gp_handlekey']?>');return false;" title="关闭">关闭</a><? } ?>
</span>
</h3>
<? if(($blockname != 'music')) { ?>
<form id="blockformsetting" name="blockformsetting" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=index&amp;blockname=<?=$blockname?>" onsubmit="ajaxpost('blockformsetting','return_<?=$_G['gp_handlekey']?>','return_<?=$_G['gp_handlekey']?>','onerror');" class="fdiy">
<div class="c diywin" style="max-height:350px;width:420px;height:auto !important;height:320px;_margin-right:20px;overflow-y:auto;">
<div id="block_setting">
<table class="tfm">
<? if(($blockname == 'profile')) { ?>
<tr>
<th>头像大小</th>
<td>
<label><input type="radio" name="avatar" value="big"<? if($para['banavatar'] == 'big') { ?> checked="checked"<? } ?>>大</label>
<label><input type="radio" name="avatar" value="middle"<? if($para['banavatar'] == 'middle') { ?> checked="checked"<? } ?>>中</label>
<label><input type="radio" name="avatar" value="small"<? if($para['banavatar'] == 'small') { ?> checked="checked"<? } ?>>小</label>
</td>
</tr>

<? } elseif(($blockname == 'statistic')) { ?>
<tr>
<th>显示统计内容</th>
<td>
<label><input type="checkbox" name="credits" value="1" class="px"<? if(empty($para['bancredits'])) { ?> checked="checked"<? } ?> />积分</label>
<label><input type="checkbox" name="friends" value="1" class="px"<? if(empty($para['banfriends'])) { ?> checked="checked"<? } ?> />好友数</label>
<label><input type="checkbox" name="threads" value="1" class="px"<? if(empty($para['banthreads'])) { ?> checked="checked"<? } ?> />主题数</label>
<label><input type="checkbox" name="blogs" value="1" class="px"<? if(empty($para['banblogs'])) { ?> checked="checked"<? } ?> />日志数</label>
<label><input type="checkbox" name="albums" value="1" class="px"<? if(empty($para['banalbums'])) { ?> checked="checked"<? } ?> />相册数</label>
<label><input type="checkbox" name="sharings" value="1" class="px"<? if(empty($para['bansharings'])) { ?> checked="checked"<? } ?> />分享数</label>
<label><input type="checkbox" name="views" value="1" class="px"<? if(empty($para['banviews'])) { ?> checked="checked"<? } ?> />空间查看数</label>
</td>
</tr>
<? } elseif(in_array($blockname, array('block1', 'block2', 'block3', 'block4', 'block5'))) { ?>
<tr>
<th>模块标题</th>
<td><input type="text" name="blocktitle" value="<?=$para['title']?>" class="px" /></td>
</tr>
<tr><?php $msg .= $_G['group']['allowspacediyhtml'] ? 'HTML ' : '' ?><?php $msg .= $_G['group']['allowspacediybbcode'] ? 'BBCODE ' : '' ?><?php $msg .= $_G['group']['allowspacediyimgcode'] ? 'IMG ' : '' ?><?php $msg = $msg ? lang('spacecp', 'spacecp_message_prompt', array('msg' => $msg)) : '' ?><th>自定义内容<br><span style=" font-weight: 400; "><?=$msg?></span></th>
<td>
<div class="tedt">
<div class="bar"><?php $editicons = array(); ?><?php if($_G['group']['allowspacediybbcode']) $editicons = array('bold', 'color', 'link', 'quote', 'code', 'smilies'); ?><?php if($_G['group']['allowspacediyimgcode']) $editicons[] = 'img'; ?><?php $seditor = array('content', $editicons); ?><div class="fpd">
<? if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="文字加粗" class="fbld"<? if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?=$seditor['0']?>', '[b]', '[/b]')"<? } ?>>B</a>
<? } if(in_array('color', $seditor['1'])) { ?>
<a href="javascript:;" title="设置文字颜色" class="fclr" id="<?=$seditor['0']?>forecolor"<? if(empty($seditor['2'])) { ?> onclick="showColorBox(this.id, 2, '<?=$seditor['0']?>');doane(event)"<? } ?>>Color</a>
<? } if(in_array('img', $seditor['1'])) { ?>
<a id="<?=$seditor['0']?>img" href="javascript:;" title="图片" class="fmg"<? if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?=$seditor['0']?>', 'img')"<? } ?>>Image</a>
<? } if(in_array('link', $seditor['1'])) { ?>
<a id="<?=$seditor['0']?>url" href="javascript:;" title="添加链接" class="flnk"<? if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?=$seditor['0']?>', 'url')"<? } ?>>Link</a>
<? } if(in_array('quote', $seditor['1'])) { ?>
<a id="<?=$seditor['0']?>quote" href="javascript:;" title="引用" class="fqt"<? if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?=$seditor['0']?>', 'quote')"<? } ?>>Quote</a>
<? } if(in_array('code', $seditor['1'])) { ?>
<a id="<?=$seditor['0']?>code" href="javascript:;" title="代码" class="fcd"<? if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?=$seditor['0']?>', 'code')"<? } ?>>Code</a>
<? } if(in_array('smilies', $seditor['1'])) { ?>
<a href="javascript:;" class="fsml" id="<?=$seditor['0']?>sml"<? if(empty($seditor['2'])) { ?> onclick="showMenu({'ctrlid':this.id,'evt':'click','layer':2});return false;"<? } ?>>Smilies</a>
<? if(empty($seditor['2'])) { ?>
<script src="data/cache/common_smilies_var.js?<?=VERHASH?>" type="text/javascript" reload="1"></script>
<script type="text/javascript" reload="1">smilies_show('<?=$seditor['0']?>smiliesdiv', <?=$_G['setting']['smcols']?>, '<?=$seditor['0']?>');</script>
<? } } ?>
</div></div>
<div class="area">
<textarea name="content" id="contentmessage" style="width: 100%;"cols="40" rows="3" class="pt" onkeydown="ctrlEnter(event, 'blocksubmitbtn');"><?=$para['content']?></textarea>
</div>
</div>
<script src="<?=$_G['setting']['jspath']?>bbcode.js?<?=VERHASH?>" type="text/javascript"></script>
<script type="text/javascript">var forumallowhtml = 0,allowhtml = parseInt('<?=$_G['group']['allowspacediyhtml']?>'),allowsmilies = 0,allowbbcode = parseInt('<?=$_G['group']['allowspacediybbcode']?>'),allowimgcode = parseInt('<?=$_G['group']['allowspacediyimgcode']?>');var DISCUZCODE = [];DISCUZCODE['num'] = '-1';DISCUZCODE['html'] = [];
</script>
</td>
</tr>
<? } else { ?>
<tr>
<th>模块名称</th>
<td><input type="text" name="blocktitle" value="<?=$para['title']?>" class="px" /></td>
</tr>
<tr>
<th>显示条数</th>
<td><input type="text" name="shownum" value="<?=$para['shownum']?>" class="px" /></td>
</tr>
<? } ?>
</table>
</div>
</div>
<div class="o pns">
<input type="hidden" name="blocksubmit" value="true" />
<input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" />
<input type="hidden" name="eleid" value="<?=$_GET['eleid']?>" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<button type="submit" class="pn pnc" id="blocksubmitbtn"><strong>确定</strong></button>
</div>
</form>
<? } else { ?><?php $musicmsgs = $userdiy['parameters']['music'];$config = $musicmsgs['config']; if(empty($musicmsgs['mp3list']) ) { ?><?php $addshow = 'block';$addtabshow = 'class="a"';$listshow = 'none';$listtabshow = ''; } else { ?><?php $addshow = 'none';$addtabshow = '';$listshow = 'block';$listtabshow = 'class="a"'; } ?>
<ul id="menutabs" class="tb cl">
<li id="musicadd"<?=$addtabshow?>><a href="javascript:;" onclick="spaceDiy.menuChange('menutabs' ,'musicadd');this.blur();return false;">添加音乐</a></li>
<li id="musiclist"<?=$listtabshow?>><a href="javascript:;" onclick="spaceDiy.menuChange('menutabs' ,'musiclist');this.blur();return false;">当前播放列表</a></li>
<li id="musicconfig"><a href="javascript:;" onclick="spaceDiy.menuChange('menutabs' ,'musicconfig');this.blur();return false;">播放器配置</a></li>
</ul>
<div id="musicconfig_content" style="display:none">
<form method="post" name="musicconfigform" id="musicconfigform" autocomplete="off" action="home.php?mod=spacecp&amp;ac=index&amp;blockname=<?=$blockname?>" onsubmit="spaceDiy.delIframe();ajaxpost('musicconfigform','return_<?=$_G['gp_handlekey']?>','return_<?=$_G['gp_handlekey']?>','onerror');">
<div class="c diywin" style="max-height:350px;width:480px;height:auto !important;height:320px;_margin-right:20px;overflow-y:auto;">
<table class="tfm">
<tr>
<th>模块名称</th>
<td><input type="text" name="blocktitle" value="<?=$para['title']?>" class="px" /></td>
</tr>
<tr>
<th>显示模式</th><?php $bigmod = $config['showmod'] == 'big' ? ' checked' : ''; $defaultmod = $config['showmod'] == 'default' ? ' checked' : ''; ?><td> <input type="radio" value="big" name="showmod"<?=$bigmod?>>完整 <input type="radio" value="default" name="showmod"<?=$defaultmod?>>列表</td>
</tr>
<tr>
<th>开始模式</th><?php $autorun1 = $config['autorun'] == 'true' ? ' checked' : ''; $autorun2 = $config['autorun'] == 'false' ? ' checked' : ''; ?><td> <input type="radio" value="true" name="autorun"<?=$autorun1?>>自动 <input type="radio" value="false" name="autorun"<?=$autorun2?>>手动</td>
</tr>
<tr>
<th>播放模式</th><?php $shuffle1 = $config['shuffle'] == 'true' ? ' checked' : ''; $shuffle2 = $config['shuffle'] == 'false' ? ' checked' : ''; ?><td> <input type="radio" value="true" name="shuffle"<?=$shuffle1?>>随机顺序 <input type="radio" value="false" name="shuffle"<?=$shuffle2?>>列表顺序</td>
</tr>
<tr>
<th>界面颜色</th>
<td>
<p class="mbn">
面板背景颜色
<input type="text" name="crontabcolor" id="usercrontabcolor_v" value="<?=$config['crontabcolor']?>" size="7" class="px p_fre" />
<input id="cm_ctc" onclick="createPalette('m_ctc', 'usercrontabcolor_v');" type="button" class="colorwd" value="" style="background: <?=$config['crontabcolor']?>">
</p>
<p class="mbn">
字体按钮颜色
<input type="text" name="buttoncolor" id="userbuttoncolor_v" value="<?=$config['buttoncolor']?>" size="7" class="px p_fre" />
<input id="cm_bc" onclick="createPalette('m_bc', 'userbuttoncolor_v');" type="button" class="colorwd" value="" style="background: <?=$config['buttoncolor']?>">
</p>
<p class="mbn">
播放曲目颜色
<input type="text" name="fontcolor" id="userfontcolor_v" value="<?=$config['fontcolor']?>" size="7" class="px p_fre" />
<input id="cm_fc" onclick="createPalette('m_fc', 'userfontcolor_v');" type="button" class="colorwd" value="" style="background: <?=$config['fontcolor']?>">
</p>
</td>
</tr>
<tr>
<th>面板背景</th>
<td><input type="text" name="crontabbj" value="<?=$config['crontabbj']?>" size="40" maxlength="200" class="px" />
<br />完整模式才有效果，建议选择200*180的jpg图片</td>
</tr>
<tr>
<th>高度</th><?php $config['height'] = empty($config['height']) && $config['height'] !== 0 ? 200 : $config['height']; ?><td><input type="text" name="height" value="<?=$config['height']?>" size="10" maxlength="10" class="px p_fre" />px
<br />设置音乐盒的高度</td>
</tr>
</table>
</div>
<div class="o pns">
<input type="hidden" name="musicsubmit" value="true" />
<input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" />
<input type="hidden" name="act" value="config" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<button type="submit" class="pn pnc" id="musicsubmitbtn"><strong>确定</strong></button>
</div>
</form>
</div>

<div id="musicadd_content" style="display:<?=$addshow?>;">
<script type="text/javascript">
function addMenu() {
newnode = $("tb_menu_new").rows[0].cloneNode(true);
tags = newnode.getElementsByTagName('input');
for(i in tags) {
tags[i].value = '';
}
$("tb_menu_new").appendChild(newnode);
}

function exchangeNode(obj, opId) {
var currentlyNode = obj.parentNode.parentNode.parentNode;
var opIndex = parseInt(currentlyNode.id);
var opNode = aimNode = '';
var aimId = 0;
if(opId == 1) {
aimId = opIndex+1;
if($('thetable').rows[aimId] == undefined) {
alert("已到最后一个");
return false;
}
} else {
aimId = opIndex-1;
if(aimId == 0) {
alert("已是第一个");
return false;
}
}
opNode = currentlyNode.rows[0].cloneNode(true);
aimNode = $('thetable').rows[aimId].parentNode;
var caimNode = aimNode.rows[0].cloneNode(true);
aimNode.removeChild(aimNode.rows[0]);
aimNode.appendChild(opNode);
currentlyNode.removeChild(currentlyNode.rows[0]);
currentlyNode.appendChild(caimNode);
}

function delMenu(obj) {
if($("tb_menu_new").rows.length > 1) {
$("tb_menu_new").removeChild(obj.parentNode.parentNode);
} else {
alert('最后一行不允许删除');
}
}
function delList() {
 var inputs = $('musiclistform').getElementsByTagName('input');
 var ids = [];
 for (var i=0;i<inputs.length;i++){
 if (inputs[i].type == 'checkbox') ids.push(inputs[i]);
 }
 var id = '';
 for (var i in ids) {
 if (typeof ids[i] == 'object' && ids[i].checked) {
id = parseInt(ids[i].value)+1;
$(id).parentNode.removeChild($(id));
 }
 }
}
</script>

<form method="post" name="musicaddform" id="musicaddform" autocomplete="off" action="home.php?mod=spacecp&amp;ac=index&amp;blockname=<?=$blockname?>" onsubmit="spaceDiy.delIframe();ajaxpost('musicaddform','return_<?=$_G['gp_handlekey']?>','return_<?=$_G['gp_handlekey']?>','onerror');">
<div class="c diywin" style="max-height:260px;width:480px;height:auto !important;height:260px;_margin-right:20px;overflow-y:auto;">
<table class="tfm">
<tr><td colspan="2" align="center">注意:仅支持mp3格式添加,即:必须是以http://开始，以.mp3结尾</td></tr>
<tr><td colspan="2"><hr size="1" color="#EEEEEE" /></td></tr>
<tbody id="tb_menu_new">
<tr>
<td>
<table width="95%" align="center" border="0" cellspacing="0" cellpadding="0">
<tr>
<th>mp3地址</th>
<td><input type="text" name="mp3url[]" value="" size="40" maxlength="200" class="px" /></td>
</tr>
<tr>
<th>曲目名</th>
<td><input type="text" name="mp3name[]" size="20" maxlength="30" class="px" style="width:150px;" />
   为空则自动生成名字</td>
</tr>
<tr>
<th>封面</th>
<td><input type="text" name="cdbj[]" value="" size="40" maxlength="200" class="px" />
<br />
   完整模式才有效果，建议选择60*60的jpg图片</td>
</tr>
</table></td>
<td><a href="javascript:;" onclick="delMenu(this)"> 删除</a></td>
</tr>
</tbody>
</table>
</div>

<div class="o pns">
<input type="hidden" name="musicsubmit" value="true" />
<input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" />
<input type="hidden" name="act" value="addmusic" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<button type="button" name="addone" onclick="addMenu();return false;" class="pn"><em>增加</em></button>&nbsp;
<button type="submit" class="pn pnc" id="musicsubmitbtn"><strong>确定</strong></button>
</div>
</form>
</div>
<div id="musiclist_content" style="display:<?=$listshow?>;">

<? if((!empty($musicmsgs['mp3list']))) { ?>
<form method="post" name="musiclistform" id="musiclistform" autocomplete="off" action="home.php?mod=spacecp&amp;ac=index&amp;blockname=<?=$blockname?>" onsubmit="delList();spaceDiy.delIframe();ajaxpost('musiclistform','return_<?=$_G['gp_handlekey']?>','return_<?=$_G['gp_handlekey']?>','onerror');">
<div class="c diywin" style="max-height:350px;width:480px;height:auto !important;height:320px;_margin-right:20px;overflow-y:auto;">
<table width="100%" align="center" border="0" cellspacing="2" cellpadding="2">
<tr>
<td colspan="2">唱片集封面和文件地址<br/>(不能播放的时候请确定该地址mp3文件是否存在)</td>
<td><div align="right">全选删除
<input id="chkall" name="chkall" onclick="checkall(this.form, 'id')" type="checkbox">
</div></td>
</tr>
<tr><td colspan="3">
<table width="100%" align="center" border="0" cellspacing="1" cellpadding="1" id="thetable">
<tbody style="display:none;"><tr><td colspan="2"><hr size="0" /></td></tr></tbody><? if(is_array($musicmsgs['mp3list'])) foreach($musicmsgs['mp3list'] as $key => $list) { ?><?php $list['cdbj'] = empty($list['cdbj']) ? IMGDIR.'/nophotosmall.gif' : $list['cdbj']; ?><?php $list['mp3name'] = dhtmlspecialchars($list['mp3name']);$list['mp3url'] = dhtmlspecialchars($list['mp3url']);$list['cdbj'] = dhtmlspecialchars($list['cdbj']); ?><?php $index_ = $key+1; ?><tbody id="<?=$index_?>">
      		   <tr>
      		     <td>
      		       <table class="tfm">
      		         <tbody><tr>
      		           <th>mp3地址</th>
      		           <td><input type="text" value="<?=$list['mp3url']?>" maxlength="200" size="40" name="mp3url[]" class="px" ></td>
      		         </tr>
      		         <tr>
      		           <th>曲目名</th>
      		           <td><input type="text" value="<?=$list['mp3name']?>" maxlength="30" size="20" name="mp3name[]" class="px" >
      		             </td>
      		         </tr>
      		         <tr>
      		           <th>封面</th>
      		           <td><input type="text" value="<?=$list['cdbj']?>" maxlength="200" size="40" name="cdbj[]" class="px" >
   <p><img border="0" class="musicbj mtn" src="<?=$list['cdbj']?>"></p>
      		            </td>
      		         </tr>
      		     </tbody></table></td>
      		     <td width="50px"><input type="checkbox" value="<?=$key?>" id="id_<?=$key?>" name="ids"><a onclick="exchangeNode(this, -1)" href="javascript:;"><img width="11" height="12" border="0" src="<?=IMGDIR?>/icon_top.gif"></a><a onclick="exchangeNode(this, 1)" href="javascript:;"><img width="11" height="12" border="0" src="<?=IMGDIR?>/icon_down.gif"></a></td>
      		   </tr>
      		</tbody>
<? } ?>
</table>
</td>
</tr>
</table>
</div>
<div class="o pns">
<input type="hidden" name="musicsubmit" value="true" />
<input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" />
<input type="hidden" name="act" value="editlist" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<button type="submit" class="pn pnc" id="musicsubmitbtn"><strong>更新当前音乐列表</strong></button>
</div>
</form>
<? } else { ?>
<div class="c diywin" style="max-height:350px;width:420px;height:auto !important;height:320px;_margin-right:20px;overflow-y:auto;">
<div style="line-height:40px;text-align:center;">暂无音乐播放列表
<button onclick="spaceDiy.menuChange('menutabs' ,'musicadd');;" class="pn"><em>添加音乐</em></button>
</div>
</div>
<? } ?>
</div>
<? } ?>
<script type="text/javascript" reload="1">
function succeedhandle_<?=$_G['gp_handlekey']?> (url, message, values) {
var x = new Ajax();
x.get('home.php?mod=spacecp&ac=index&op=getblock&blockname='+values['blockname']+'&inajax=1', function(s) {
s = s.replace(/\<script.*\<\/script\>/ig,'<font color="red"> [javascript脚本保存后显示] </font>');
$(values['blockname']).innerHTML = s;
drag.initPosition();
});
hideWindow('<?=$_G['gp_handlekey']?>');}
</script>
<? } elseif($_GET['op'] == 'savespaceinfo') { ?><?php $space[domainurl] = space_domain($space); ?><strong id="spacename"><? if($space['spacename']) { ?><?=$space['spacename']?><? } else { ?><?=$space['nickname']?>的个人空间<? } ?></strong>
<a id="domainurl" href="<?=$space['domainurl']?>" onclick="javascript:setCopy('<?=$space['domainurl']?>', '空间地址已经复制到剪贴板');return false;" class="xs0 xw0"><?=$space['domainurl']?></a>
<span id="spacedescription" class="xw0"><?=$space['spacedescription']?></span>
<script type="text/javascript" reload="1">spaceDiy.initSpaceInfo();</script>

<? } elseif($_GET['op'] == 'getspaceinfo') { ?><?php $space[domainurl] = space_domain($space); ?><form id="savespaceinfo" action="home.php?mod=spacecp&amp;ac=index&amp;op=savespaceinfo" method="post">
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<input type="hidden" name="savespaceinfosubmit" value="true" />
<strong class="pns mbm">
<em class="xw0 xs1">我的空间名称: </em><input type="text" class="px vm" value="<? if($space['spacename']) { ?><?=$space['spacename']?><? } else { ?><?=$space['username']?>的个人空间<? } ?>" name="spacename" />&nbsp;
<button type="submit" class="pn pnc vm" onclick="spaceDiy.spaceInfoSave();"><em>保存</em></button>
<button type="button" class="pn vm" onclick="spaceDiy.spaceInfoCancel();"><em>取消</em></button>
</strong>
<a id="domainurledit" style="display: none;"><?=$space['domainurl']?></a>
<span><em class="xw0 xs1">我的空间描述: </em><input type="text" class="px" style="width:600px" value="<?=$space['spacedescription']?>" name="spacedescription" /></span>
</form>

<? } else { ?>
<ul>
  <li> NONE </li>
</ul>
<? } include template('common/footer'); ?>