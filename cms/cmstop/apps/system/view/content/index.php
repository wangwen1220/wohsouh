<?php $this->display('header','system');?>

<style type="text/css">
#search_f {padding-left: 8px;width: 650px;float: left;}
.selectDiv {float: left;margin: 1px 8px 0 0;}
#changemodel {margin-left: 90px;}
#changemodel, #changestatus, #changedate {width: 70px;}

.ct_selector {float: left;	padding-left: 6px;}
#info {	padding: 6px 12px;	text-align: center;	color: #666;width: 360px;margin: 6px auto 3px auto;}
#info span {color: #d00;}
#pup_model li {	cursor: pointer;background: url(<?php echo IMG_URL?>js/lib/dropdown/bg.gif) no-repeat scroll 3px -46px transparent;}
#pup_model li.over {color: #d00;}
#pup_model li.picture {background-position: 3px -332px;}
#pup_model li.link {background-position: 3px -96px;}
#pup_model li.video {background-position: 3px -120px;}
#pup_model li.activity {background-position: 3px -248px;}
#pup_model li.vote {background-position: 3px -167px;}

/* 文章标题前的图片 */
td div.icon {background: url(<?php echo IMG_URL?>js/lib/dropdown/bg.gif) no-repeat scroll 0 -50px transparent;	margin-right: 3px;	width: 16px;height: 20px;float: left;}
td div.picture {background-position: 0 -336px;}
td div.link {background-position: 0 -100px;}
td div.video {background-position: 0 -125px;}
td div.activity {background-position: 0 -252px;}
td div.vote {background-position: 0 -171px;}
/** 下拉菜单 **/
div.dropmenu {position: relative;}
div.dropmenu h3 {background: url(css/images/bg.gif) no-repeat scroll 0 -481px transparent;height: 22px;	line-height: 24px;	padding-left: 14px;	cursor: pointer;width: 42px;color: #fff;}
div.dropmenu h3 a {color: #fff;}
div.dropmenu ul {display: none;	position: absolute;	left: 0;top: 24;background: #fff;border:1px solid #9EC6DD;	z-index:999;}
div.dropmenu li {border-bottom:1px solid #D0E6EC;line-height:24px;	text-align:right;padding-right:6px;}
div.wide li{text-align:left;padding-left:6px;}
/** 下拉菜单结束 **/
</style>
<!--treeview-->
<link href="<?=IMG_URL?>js/lib/treeview/treeview.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/jquery.treeview.js"></script>

<!--tablesorter-->
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/tablesorter/style.css" />
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/jquery.tablesorter.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.table.js"></script>
<!--contextmenu-->
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/contextMenu/style.css" />
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/cmstop.contextMenu.js"></script>
<!--pagination-->
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/pagination/style.css" />
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/jquery.pagination.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/dropdown/style.css"/>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.dropdown.js"></script>
<script type="text/javascript">
var catid = <?=$catid?>;
var childids = '<?=table('category', $catid, 'childids')?>';
var isEnd = (catid != 0 && !childids) ? true : false;	//是否终极栏目
</script>
<script type="text/javascript" src="apps/system/js/content.js"></script>
<?php
$js = array('activity', 'picture', 'video', 'vote');
foreach ($js as $r)
{
	if(!$_GET['modelid'] || $model == $r)
	{
		echo '<script type="text/javascript" src="apps/'.$r.'/js/'.$r.'.js"></script>'."\n";
	}
}
?>
	<div class="bk_8"></div>
	<form method="GET" name="search_f" id="search_f" action="" onsubmit="tableApp.load($('#search_f'));return false;">
      	<div id="pup_model" class="dropmenu" style="float: left;padding-right: 5px;">
			<h3 style="padding-left: 28px;">发布</h3>
			<ul>
			<?php foreach (table('model') as $k=>$v):?>
				<li class="<?=$v['alias']?>" modelid="<?=$v['modelid']?>">发<?=$v['name']?></li>
			<?php endforeach;?>
			</ul>
	  	</div>
		<div class="selectDiv">
		<select id="changemodel" style="width:70px">
			<option value="0">全部</option>
			<?php foreach (table('model') as $m) {?>
				<option ico="<?=$m['alias']?>" value="<?=$m['modelid']?>" <?=$m['modelid'] == $modelid ? 'selected' : ''?>><?=$m['name']?></option>
			<?php } ?>
		</select>
		</div>
		<div class="selectDiv">
		<select id="changestatus" style="width:60px">
			<option value="6"<?php if(empty($_GET['status']) || $_GET['status'] == 6) echo 'selected'?>>已发</option>
			<option value="3"<?php if($_GET['status'] == 3) echo 'selected'?>>待审</option>
			<option value="2"<?php if($_GET['status'] == 2) echo 'selected'?>>退稿</option>
			<option value="1"<?php if($_GET['status'] == 1) echo 'selected'?>>草稿</option>
			<option value="0"<?php if(isset($_GET['status']) && $_GET['status'] == 0) echo 'selected'?>>回收站</option>
		</select>
		</div>
		<div class="selectDiv">
		<select name="date" id="changedate" style="width:50px;">
			<option value="none" selected>日期</option>
			<option value="today">今日</option>
			<option value="yesterday">昨日</option>
			<option value="week">本周</option>
			<option value="month">本月</option>
		</select>
		</div>
		<div style="float: left;margin-right:8px;line-height:20px;">
			<input type="checkbox" name="note" value="1"/> 批注
		</div>
		<div style="float: left;margin-right:8px;line-height:20px;">
			<input type="checkbox" name="iscontribute" value="1"/> 投稿
		</div>
		<div class="search_icon search">
			<input type="text" name="keywords" id="keywords" value="<?=$keywords?>" size="15"/>
			<a id="submit" href="javascript:;" onclick="tableApp.load($('#search_f'));">搜素</a>
			<a href="javascript:;" class="more_search" onclick="content.search('<?=$catid?>', '<?=$modelid?>', <?=$status?>);" title="高级搜索">高级搜素</a>
		</div>
	</form>	
	<a class="button_style_1" id="Digg" onclick="Digg('<?WWW_URL?>/api/article.php?act=digg');"  href="javascript:;">顶文章</a>
	<?php 
	if($_GET['catid'] > 0) $urlend = '&catid='.$_GET['catid'];
	?>
	<div id="data_btn">
		<h3><a href="javascript:;">快捷操作</a></h3>
		<ul>
			<li><a href="javascript:ct.assoc.open('?app=spider&controller=spider<?php echo $urlend?>', 'newtab');">采集文章</a></li>
			<li><a href="javascript:ct.assoc.open('?app=push&controller=push<?php echo $urlend?>', 'newtab');">推送文章</a></li>
			<li><a href="javascript:html.createIndex();">生成首页</a></li>
			<li><a href="javascript:html.createCate(<?php echo $catid?>);">生成栏目页</a></li>
			<li><a href="javascript:html.createShow(<?php echo $catid?>);">生成内容页</a></li>
			<li><a href="javascript:ct.assoc.open('?app=system&controller=rank_pv&action=category<?php echo $urlend?>', 'newtab');">点击排行</a></li>
			<li><a href="javascript:ct.assoc.open('?app=system&controller=rank_comment&action=category<?php echo $urlend?>', 'newtab');">评论排行</a></li>
			<li><a href="javascript:ct.assoc.open('?app=digg&controller=digg&action=index<?php echo $urlend?>', 'newtab');">Digg排行</a></li>
			<li><a href="javascript:ct.assoc.open('?app=mood&controller=data&action=index<?php echo $urlend?>', 'newtab');">心情排行</a></li>
			<li><a href="javascript:ct.assoc.open('?app=system&controller=content_log&action=index<?php echo $urlend?>', 'newtab');">操作日志</a></li>
			<li><a href="javascript:ct.assoc.open('?app=system&controller=content_note&action=index<?php echo $urlend?>', 'newtab');">批注管理</a></li>
		</ul>
  	</div>
	<div class="bk_8" style="height:4px;"></div>

<?php
//输出右键菜单
if($model)
{
	echo right_menu($model, $status, $catid);
}
else
{
	$models = table('model');
	foreach($models as $m)
	{
		echo right_menu($m['alias'], $status, $catid);
	}
}
?>

<?php $this->display("content/status/$status");?>
<div id="info">
	已发(<span id="totalNum"><?php echo $total['published']?></span>) &nbsp;&nbsp;
	待审(<span id="waitNum"><?php echo $total['wait']?></span>) &nbsp;&nbsp;
	投稿(<span id="contributeNum"><?php echo $total['contribute']?></span>) &nbsp;&nbsp;
	批注(<span id="noteNum"><?php echo $total['note']?></span>)
</div>
<script type="text/javascript">
var tableApp = new ct.table('#item_list', {
    rowIdPrefix : 'row_',
    rightMenuId : 'right_menu',
    pageField : 'page',
    pageSize : 15,
    dblclickHandler : 'content.edit',
    rowCallback     : 'init_row_event',
    template : row_template,
    baseUrl  : '?app=<?=$app?>&controller=<?=$controller?>&action=page&catid=<?=$catid?>&modelid=<?=$modelid?>&status=<?=$status?>&createdby=<?=$createdby?>'
});

function init_row_event(id, tr)
{
	tr.find('img.edit').click(function(){
		content.edit(id);
	});
	tr.find('img.delete').click(function(){
		<?php if ($status) { ?>
		content.remove(id);
		<?php }else{ ?>
		content.del(id);
		<?php } ?>
	});
    tr.find('a.title_list').attrTips('tips');
    tr.find('img.thumb').attrTips('tips');
}

$('#changemodel, #changestatus, #changedate').dropdown({
	changemodel:{
		onchange:function(modelid, name){
			var url = '?app=system&controller=content&action=index&catid=<?=$catid?>&modelid='+modelid;
			if('<?=$_GET['status']?>') url += '&status=' + '<?=$_GET['status']?>';
			window.location.href = url;
		}
	},
	changestatus: {
		onchange:function(status){
			window.location.href = '?app=<?=$app?>&controller=<?=$controller?>&action=index&catid=<?=$catid?>&modelid=<?=$modelid?>&status='+status;
		}
	},
	date: {
		onchange:function(type){
			$('#submit').click();
		}
	},
	shortcut: {
		onchange:function(url){
			if(url) ct.assoc.open(url, 'newtab');
			$('#shortcut option:first').click();
		}
	}
});

tableApp.load();
$.fn.dd = function (action){
	p = $.extend({
		width: 70
	}, action || {});
	this.each(function (i, e){
		$(this).find('ul').width(p.width);
		$(e).mouseover(function (){
			$(this).find('ul').show();
			$(document).one('click', function (){
				$('div.dropmenu ul').hide();
			});
			$(this).mouseout(function (){
				$(this).find('ul').hide();
			});
		});
	});
	return this;
}
$(function (){
	$('#keywords').keyup(function(e){
		if(e.keyCode == 13) tableApp.load($('#search_f'));
	})
	$('#pup_model li, #pup_model h3').click(function (){
		if(this.tagName == 'LI'){
			var modelid = $(this).attr('modelid');
			var model = this.className;
		}else {
			var modelid = $('#changemodel').val();
			if(modelid == 0) {
				modelid = 1;
				var model = 'article';
			}else {
				var model = $('#changemodel').next('.ct_selector').find('span').attr('className');
			}
		}
		if(isEnd) {
			ct.assoc.open('?app='+model+'&controller='+model+'&action=add&catid='+catid, 'newtab');
		}else {
			ct.assoc.open('?app='+model+'&controller='+model+'&action=add', 'newtab');
		}
	});
	$('#pup_model li').mouseover(function (){
		$('#pup_model li').css('color', '#000');
		$(this).css('color', '#d00');
	});
	$('strong.add_data_btn').mouseover(function (){
		$('#pub_model').show();
		$(document).one('click', function (){
			$('#pub_model').hide();
		});
	});
	$('input[name=note], input[name=iscontribute]').click(function (){
		$('#submit').click();
	});
	
	$('div.dropmenu').dd({
		width: 65
	});
	$('#data_btn').dd({
		width: 68
	});
});

var interval = setInterval(function(){tableApp.load();}, 180000);
window.onunload = function ()
{
	clearInterval(interval);
}

var html = {
	modelmap : {'article':'文章','picture':'组图','video':'视频','activity':'活动','vote':'投票'},
	loadingBox : null,
	maxlimit : null,
	where : null,
	limit : 0,
	total : 0,
	models : [],
	appname : null,
	number : 0,
	createIndex : function(){
		$.getJSON('?app=system&controller=html&action=createIndex',function(response){
			if(response.state) ct.tips('操作成功', 'ok');
			else ct.tips('生成失败！','error');
		});
	},
	createCate : function(catid){
		ct.form('生成栏目页','?app=system&controller=html&action=createCate&catid='+catid,280,100,function(response){
			html.maxlimit = $('#maxlimit').val();
			html.ls_submit(response);
			return true;
		},function(){
			return true;
		});
	},
	ls_submit: function (response){
		if (response.state){
			if (response.catids){
				if (response.percent == 0)
				{
					html.startLoading('center', '开始生成...', '200px');
	                setTimeout('html.ls_create()', 1000);
				}
				else if (response.percent < 1)
				{
					html.loadingBox.html('已经生成'+Math.floor((response.percent)*100)+'%');
					setTimeout('html.ls_create()', 1000);
				}
				else if (response.percent == 1)
				{
					html.endLoading();
					ct.tips('全部生成完毕', 'ok');
				}
			}
			else{
				ct.tips('操作成功', 'ok');
			}
		}
		else{
			ct.tips(response.error, 'error');
		}
	},
	
	ls_create : function(){
		$.getJSON('?app=system&controller=html&action=ls&maxlimit='+html.maxlimit+'&catids=true', function(response){
			html.ls_submit(response);
		});
	},

	createShow : function(){
		ct.form('生成内容页','?app=system&controller=html&action=createShow&catid='+catid,280,100,function(response){
			html.limit = $('#limit').val();
			html.show_submit(response);
			return true;
		},function(){
			return true;
		},function(f, a, opts){
			var time = f.find('select')[0].value;
			if (time) opts.url += ('&'+time);
		});
	},
	
	show_submit: function (response) {
		if (response.state)
		{
			html.where = response.where;
			html.total = response.total;
			html.models = response.models;
			
	        html.startLoading('center', '开始生成...', '200px');
	        setTimeout(function() {
	        	html.show_create(response);
	        }, 1000);
		}
		else {
			ct.tips(response.error, 'error');
		}
	},
	show_create: function (response) {
		if (response.finished && html.models.length === 0) {
			html.where = null;
			html.limit = 0;
			html.total = 0;
			html.models = [];
			html.appname = null;
			html.number = 0;
			
			setTimeout(function() {
				html.endLoading();
			}, 2000);
			
			ct.tips('全部生成完毕', 'ok');
		}else{		
			if (response.finished){
				html.number += response.offset;
				percent = Math.floor(html.number/html.total*100);
				html.appname = html.models.shift();
				html.offset = 0;
				html.count = '';
			}else{
				percent = Math.floor((html.number + response.offset)/html.total*100);
				html.offset = response.offset;
				html.count = response.count;
			}
			if (percent == '0') percent = '1';
			
			html.loadingBox.html('正在生成'+html.modelmap[html.appname]+'&nbsp;'+percent+'%...');
			setTimeout(function(){
				$.getJSON('?app='+html.appname+'&controller=html&action=show_batch&where='+html.where+'&limit='+html.limit+'&count='+html.count+'&offset='+html.offset, function(response) {
					if (response.state){
						html.show_create(response);
					}else{
						ct.tips(response.error, 'error');
					}
				});
			},1000);
		}
	},
	startLoading:function(pos, msg, width) {
		msg || (msg = '载入中……');
		html.loadingBox = $('<div class="loading" style="position:fixed;visibility:hidden"><sub></sub> '+msg+'</div>')
		.appendTo(document.body);
		if (!isNaN(width = parseFloat(width)) && width)
		{
			html.loadingBox.css('width', width);
		}
		var style = cmstop.pos(pos,html.loadingBox.outerWidth(true), html.loadingBox.outerHeight(true));
		style.visibility = 'visible';
		html.loadingBox.css(style);
	},
	
	endLoading:function() {
		html.loadingBox.remove();
		html.loadingBox = null;
	}
}

function Digg(href)
{
//	ct.tips('操作成功', 'ok');
	if (!confirm("确定顶文章？")) {
		return false;
	}else{
		window.location.href= href;
	}
}
</script>
<?php $this->display('footer');?>