<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!-- Header Start -->
<div id="header" class='fn-clear'>
	<div class='title'>
		<a class='logo' href="<?php echo url_change($CATEGORYS[246][url]);?>" title="火秀游戏" target='_blank'><img src='/statics/images/game/logo.png' alt='火秀游戏' width='147' height='66' /></a>
		<h1><a href="<?php echo url_change($CATEGORYS[250][url]);?>" target='_blank'>新游戏</a></h1>
		<h2><a href="<?php echo url_change($CATEGORYS[246][url]);?>" target='_blank'>火秀游戏</a> &gt; 新游戏</h2>
	</div>

	<form id="search-form" class='search' name="search" method="get" action="<?php echo APP_PATH;?>index.php" target="_blank">
		<input type="hidden" value="search" name="app" />
		<input type="hidden" name="m" value="search" />
		<input type="hidden" name="c" value="index" />
		<input type="hidden" name="a" value="init" />
		<input type="hidden" name="typeid" value="1" id="typeid" /><!-- 搜索类型 -->
		<fieldset><input type='text' name='q' class='search-wd' value='搜索关键字游戏名' /><button type='submit' class='search-submit'>搜索</button></fieldset>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=44fa2e2cb52ee8c9faf396018e94c2fe&action=position&posid=580&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'580','order'=>'listorder DESC','limit'=>'3',));}?>
		<fieldset class='search-hotspot'>热点：<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?><a target='_blank' href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],20,'');?></a> <?php $n++;}unset($n); ?></fieldset>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	</form>

	<ul id="nav" class='nav fn-cb fn-clear'>
		<li class='nav-item <?php if($catid==250) { ?> nav-item-cur<?php } ?>'><a target='_blank' class='nav-item-link' href="<?php echo url_change($CATEGORYS[250][url]);?>">新游首页</a></li>
		<li class='nav-item <?php if($catid==293) { ?> nav-item-cur<?php } ?>'><a target='_blank' class='nav-item-link' href="<?php echo url_change($CATEGORYS[293][url]);?>">网络游戏</a></li>
		<li class='nav-item <?php if($catid==295) { ?> nav-item-cur<?php } ?>'><a target='_blank' class='nav-item-link' href="<?php echo url_change($CATEGORYS[295][url]);?>">网页游戏</a></li>
		<li class='nav-item <?php if($catid==294) { ?> nav-item-cur<?php } ?>'><a target='_blank' class='nav-item-link' href="<?php echo url_change($CATEGORYS[294][url]);?>">单机游戏</a></li>
		<li class='nav-item <?php if($catid==298) { ?> nav-item-cur<?php } ?>'><a target='_blank' class='nav-item-link' href="<?php echo url_change($CATEGORYS[298][url]);?>">手机游戏</a></li>
		<li class='nav-item <?php if($catid==296) { ?> nav-item-cur<?php } ?>'><a target='_blank' class='nav-item-link' href="<?php echo url_change($CATEGORYS[296][url]);?>">游戏图库</a></li>
		<li class='nav-item <?php if($catid==297) { ?> nav-item-cur<?php } ?>'><a target='_blank' class='nav-item-link' href="<?php echo url_change($CATEGORYS[297][url]);?>">评测</a></li>
	</ul>
</div>
<!-- Header End -->