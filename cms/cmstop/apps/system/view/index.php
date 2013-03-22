<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$CONFIG['charset']?>" />
<title>CmsTop 后台管理首页</title>
<link rel="stylesheet" type="text/css" href="css/backend.css" />
<script type="text/javascript" src="<?=IMG_URL?>js/lib/jquery.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/cmstop.js"></script>
<link rel="stylesheet" type="text/css" href="<?=IMG_URL?>js/lib/tree/style.css" />
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.tree.js"></script>
<script type="text/javascript" src="js/cmstop.tabview.js"></script>
<script type="text/javascript" src="js/cmstop.superassoc.js"></script>
<script type="text/javascript">
function cronQuery(){
	$.getJSON('<?=ADMIN_URL?>?app=system&controller=cron&action=interval');
}
function ceateIndex(){
	$.getJSON('?app=system&controller=html&action=createIndex',function(json){
		json.state ? ct.ok('生成首页成功') : ct.error('生成失败！');
	});
}
$(function(){
	if (window.top != self) {
		window.open(location, '_blank');
		ct.assoc.close();
	} else {
		superAssoc.init();
	}
	$('#logout').click(function(){
		$.getJSON('?app=system&controller=admin&action=logout', function(json){
			if (json.state == true) {
				if (json.synclogout) {
					for(k in json.synclogout) {
						$.getScript(json.synclogout[k]);
					}
					setTimeout(function (){
						location.href = '<?=WWW_URL?>';
					}, 500);
				} else {
					location.href = '<?=WWW_URL?>';
				}
			}
		});
	});
	var cronTask = setInterval(cronQuery, 60000);
	$.event.add(window,'unload',function(){
		clearInterval(cronTask);
	});
});
</script>
</head>
<body scroll="no">
<!--头部开始-->
<div id="head">
  <h1>CmsTop</h1>
  <div id="menu_position">
    <ul id="menu">
      <?php foreach ($topmenus as $m):?>
      <li id="menu<?=$m['menuid']?>" url="<?php echo $m['url'];?>"><a href="javascript:;"><?php echo $m['name'];?></a>
        <?php if($submenus[$m['menuid']]):?>
        <ul>
          <?php foreach ($submenus[$m['menuid']] as $menu):?>
          <li id="menu<?php echo $menu['menuid'];?>"><a href="javascript:;"><?php echo $menu['name'];?></a></li>
          <?php endforeach; ?>
          <li class="menubtm"></li>
        </ul>
        <?php endif; ?>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <!--账户信息-->
  <div class="user">
    <?php echo $_username;?>（<?php echo table('role', $_roleid, 'name');?>），<a id="logout" href="javascript:;">退出</a></div>
</div>
<!--头部结束-->
<div id="main">
  <!--左侧开始-->
  <div id="left">
    <h2>
      <span style="float:right;"><a href="javascript:superAssoc.refresh();" onfocus="this.blur()" class="refresh"><img src="images/space.gif" alt="刷新菜单" title="刷新菜单" height="18" width="16" /></a></span>
      <label id='root_menu_name'></label>
    </h2>
    <div id="browser"></div>
  </div>
  <!--左侧结束-->
  <!--右侧开始-->
  <div id="right">
    <div id="tab_container" target="#frame_container"></div>
    <div>
    	<div id="shortcut">
    		<span title="更新首页" onclick="ceateIndex()">
    			<img width="16" height="16" src="images/ref.gif" />
    		</span>
    		<span target="shortcut" title="添加常用操作" callback="fillData">
    			<img width="16" height="16" src="images/add.gif" />
    		</span>
    		<span target="note" title="编辑便笺" callback="getNote">
    			<img width="16" height="16" src="images/notepaper.gif" />
    		</span>
    		<span title="网站首页" onclick="window.open('<?=WWW_URL?>')">
    			<img width="16" height="16" src="images/home.gif" />
    		</span>
    	</div>
    	<div id="position"></div>
    </div>
    <div id="frame_container" style="width:100%;"></div>
  </div>
</div>
<div name="shortcut" class="popup">
	<div class="title">添加常用操作</div>
	<div class="poparea">
	<form action="?app=system&controller=index&action=addtab" method="POST">
		<label>标题：<input name="name" style="width:200px" type="text" class="bdr"/></label>
	    <label>网址：<input name="url" style="width:200px" type="text" class="bdr"/></label>
		<p><input type="submit" value="保存" class="button_style_1 mar-l-40" /><button type="button" class="button_style_1 closer">取消</button></p></form>
	</div>
</div>
<div name="note" class="popup">
	<div class="title"><span class="time"></span>编辑便签</div>
	<div class="poparea">
		<form action="?app=system&controller=my&action=note" method="POST">
			<textarea name="note"></textarea>
			<p><input type="submit" value="保存" class="button_style_1" /><button type="button" class="button_style_1 closer">取消</button></p>
		</form>
	</div>
</div>
<script type="text/javascript">
// stat
$.event.add(window,'load',function(){
	$.getScript('<?=$client_url?>');
});
</script>
</body>
</html>
