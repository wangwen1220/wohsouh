<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!-- Header Start -->
<div id="header" class='fn-clear'>
	<div class='title'>
		<a class='logo' href="<?php echo url_change($CATEGORYS[246][url]);?>" title="火秀游戏"><img src='/statics/images/game/logo.png' alt='火秀游戏' width='147' height='66' /></a>
		<h1><a href="<?php echo url_change($CATEGORYS[299][url]);?>">苹果<span>&bull;</span><em>iPhone专区</em></a></h1>
		<h2><?php echo url_change(catpos($catid));?></h2>
	</div>

	<form id="search-form" class='search' name="search" method="get" action="<?php echo APP_PATH;?>index.php" target="_blank">
		<input type="hidden" value="search" name="app" />
		<input type="hidden" name="m" value="search" />
		<input type="hidden" name="c" value="index" />
		<input type="hidden" name="a" value="init" />
		<input type="hidden" name="typeid" value="1" id="typeid" /><!-- 搜索类型 -->
		<fieldset><input type='text' name='q' class='search-wd' value='搜索关键字' /><button type='submit' class='search-submit'>搜索</button></fieldset>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=44fa2e2cb52ee8c9faf396018e94c2fe&action=position&posid=580&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'580','order'=>'listorder DESC','limit'=>'3',));}?>
		<fieldset class='search-hotspot'>热点：<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?><a target='_blank' href='<?php echo $r['url'];?>'><?php echo str_cut($r['title'],20,'');?></a> <?php $n++;}unset($n); ?></fieldset>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	</form>

	<ul id="nav" class='nav fn-cb fn-clear'>
		<li class='nav-item<?php if($catid==299) { ?> nav-item-cur<?php } ?>'>
			<a class='nav-item-link' href="<?php echo url_change($CATEGORYS[299][url]);?>">苹果首页</a>
		</li>
		<li class='nav-item<?php if($catid==303) { ?> nav-item-cur<?php } ?>'>
			<a class='nav-item-link' href="<?php echo url_change($CATEGORYS[303][url]);?>">游戏下载</a>
		</li>
		<li class='nav-item<?php if($catid==302) { ?> nav-item-cur<?php } ?>'>
			<a class='nav-item-link' href="<?php echo url_change($CATEGORYS[302][url]);?>">软件下载</a>
		</li>
		<li class='nav-item<?php if($catid==304) { ?> nav-item-cur<?php } ?>'>
			<a class='nav-item-link' href="<?php echo url_change($CATEGORYS[304][url]);?>">苹果资讯</a>
		</li>
		<li class='nav-item<?php if($catid==305) { ?> nav-item-cur<?php } ?>'>
			<a class='nav-item-link' href="<?php echo url_change($CATEGORYS[305][url]);?>">焦点内容</a>
		</li>
		<li class='nav-item<?php if($catid==306) { ?> nav-item-cur<?php } ?>'>
			<a class='nav-item-link' href="<?php echo url_change($CATEGORYS[306][url]);?>">壁纸</a>
		</li>
		<li class='drop-down'>
			<h3><a href="<?php echo url_change($CATEGORYS[299][url]);?>">iPhone</a></h3>
			<ul>
				<li><a href="<?php echo url_change($CATEGORYS[299][url]);?>" target='_blank'>iPhone</a></li>
				<li><a href="<?php echo url_change($CATEGORYS[300][url]);?>">Android</a></li>
				<li><a href="<?php echo url_change($CATEGORYS[301][url]);?>" target='_blank'>WP/Win8</a></li>
			</ul>
		</li>
	</ul>
</div>
<!-- Header End -->