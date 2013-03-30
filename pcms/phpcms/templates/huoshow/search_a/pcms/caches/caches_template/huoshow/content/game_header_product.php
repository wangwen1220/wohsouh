<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!-- Header Start -->
<div id="header" class='fn-clear'>
	<div class='title'>
		<a class='logo' target='_blank' href="<?php echo url_change($CATEGORYS[246][url]);?>" title="火秀游戏"><img src='/statics/images/game/logo.png' alt='火秀游戏' width='147' height='66' /></a>
		<h1><?php if(($catid==250 || $parentid==250 || $top2_parentid==250)) { ?><a target='_blank' href="<?php echo url_change($CATEGORYS[250][url]);?>">新游戏</a>
			<?php } elseif (($catid==247 || $parentid==247 || $top2_parentid==247)) { ?><a target='_blank' href="<?php echo url_change($CATEGORYS[247][url]);?>">网络游戏</a>
			<?php } elseif (($catid==248 || $parentid==248 || $top2_parentid==248)) { ?><a target='_blank' href="<?php echo url_change($CATEGORYS[248][url]);?>">网页游戏</a>
			<?php } elseif (($catid==249 || $parentid==249 || $top2_parentid==249 || $_GET[c]==search_yxk)) { ?><a target='_blank' href="<?php echo url_change($CATEGORYS[249][url]);?>">单机游戏</a>
			<?php } elseif (($catid==251 || $parentid==251 || $top2_parentid==251)) { ?><a target='_blank' href="<?php echo url_change($CATEGORYS[251][url]);?>">手机游戏</a>
			<?php } elseif (($catid==252 || $parentid==252 || $top2_parentid==252)) { ?><a target='_blank' href="<?php echo url_change($CATEGORYS[252][url]);?>">游戏图库</a>
			<?php } ?>
		</h1>
		<!-- <h2><a target='_blank' href='<?php echo $CATEGORYS['246']['url'];?>'>火秀游戏</a>  &gt;
			<?php if(($catid==250 || $parentid==250 || $top2_parentid==250)) { ?>新游戏
			<?php } elseif (($catid==247 || $parentid==247 || $top2_parentid==247)) { ?>网络游戏
			<?php } elseif (($catid==248 || $parentid==248 || $top2_parentid==248)) { ?>网页游戏
			<?php } elseif (($catid==249 || $parentid==249 || $top2_parentid==249)) { ?>单机游戏
			<?php } elseif (($catid==251 || $parentid==251 || $top2_parentid==251)) { ?>手机游戏
			<?php } elseif (($catid==252 || $parentid==252 || $top2_parentid==252)) { ?>游戏图库
			<?php } ?></h2>-->
			<?php if($_GET[c]==search_yxk) { ?>
			<h2><a href="<?php echo url_change($CATEGORYS[249][url]);?>" target='_blank'>单击游戏</a>  &gt; <a href="<?php echo url_change($CATEGORYS[282][url]);?>" target='_blank'>游戏库</a> &gt; 搜索 </h2>
			<?php } else { ?>
			<h2><?php echo url_change(catpos($catid));?></h2>
			<?php } ?>

	</div>
	<form id="search-form" class='search game-search' name="search" method="get" action="<?php echo APP_PATH;?>index.php" target="_blank">
		<input type="hidden" value="search" name="app" />
		<input type="hidden" name="m" value="search" />
		<input type="hidden" name="c" value="index" />
		<input type="hidden" name="a" value="init" />
		<input type="hidden" name="typeid" value="1" id="typeid" /><!-- 搜索类型 -->
		<fieldset><input type='text' name='q' class='search-wd' value='请输入关键字' /><button type='submit' class='search-submit'>搜索</button></fieldset>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=44fa2e2cb52ee8c9faf396018e94c2fe&action=position&posid=580&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'580','order'=>'listorder DESC','limit'=>'3',));}?>
		<fieldset class='search-hotspot'>热点：<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?><a target='_blank' href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],20,'');?></a> <?php $n++;}unset($n); ?></fieldset>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	</form>
	<ul id="nav" class='nav fn-cb fn-clear'>
		<li class='nav-item'>
			<a class='nav-item-link' href="<?php echo url_change($CATEGORYS[246][url]);?>">首页</a>
			<!--/*** <div class='nav-item-subnav'><a href='#'>最新资讯</a> | <a href='#'>最新评测</a> | <a href='#'>最新游戏</a> | <a href='#'>最新攻略</a></div> ***/-->
		</li>
		<li class='nav-item <?php if($catid==250 || $parentid==250 || $top2_parentid==250) { ?>nav-item-cur<?php } ?>'>
			<a class='nav-item-link' href="<?php echo url_change($CATEGORYS[250][url]);?>">新游首页</a>
			<!--/*** <div class='nav-item-subnav'><a href='#'>新游资讯</a> | <a href='#'>新游评测</a> | <a href='#'>新游游戏</a> | <a href='#'>新游攻略</a></div> ***/-->
		</li>
		<li class='nav-item <?php if($catid==247 || $parentid==247 || $top2_parentid==247) { ?>nav-item-cur<?php } ?>'>
			<a class='nav-item-link' href="<?php echo url_change($CATEGORYS[247][url]);?>">网络游戏</a>
			<div class='nav-item-subnav'><!--<?php $n=1;if(is_array(subcat(247,0,0,$siteid))) foreach(subcat(247,0,0,$siteid) AS $r) { ?><a target='_blank' href='<?php echo $r['url'];?>'><?php echo $r['catname'];?></a>|<?php $n++;}unset($n); ?>--><a target='_blank' href="<?php echo url_change($CATEGORYS[258][url]);?>"><?php echo getCatNameFromCatid(258);?></a>|<a target='_blank' href="<?php echo url_change($CATEGORYS[253][url]);?>"><?php echo getCatNameFromCatid(253);?></a>|<a target='_blank' href="<?php echo url_change($CATEGORYS[254][url]);?>"><?php echo getCatNameFromCatid(254);?></a>|<a target='_blank' href="<?php echo url_change($CATEGORYS[255][url]);?>"><?php echo getCatNameFromCatid(255);?></a><!-- |<a target='_blank' href="<?php echo url_change($CATEGORYS[256][url]);?>"><?php echo getCatNameFromCatid(256);?></a> -->|<a target='_blank' href="<?php echo url_change($CATEGORYS[257][url]);?>"><?php echo getCatNameFromCatid(257);?></a>|<a target='_blank' href="<?php echo url_change($CATEGORYS[259][url]);?>"><?php echo getCatNameFromCatid(259);?></a></div>
		</li>
		<li class='nav-item <?php if($catid==248 || $parentid==248 || $top2_parentid==248) { ?>nav-item-cur<?php } ?>'>
			<a class='nav-item-link' href="<?php echo url_change($CATEGORYS[248][url]);?>">网页游戏</a>
			<div class='nav-item-subnav'><?php $n=1;if(is_array(subcat(248,0,0,$siteid))) foreach(subcat(248,0,0,$siteid) AS $r) { ?><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo $r['catname'];?></a>|<?php $n++;}unset($n); ?></div>
		</li>
		<li class='nav-item <?php if($catid==249 || $parentid==249 || $top2_parentid==249 || $_GET[c]==search_yxk) { ?>nav-item-cur<?php } ?>'>
			<a class='nav-item-link' href="<?php echo url_change($CATEGORYS[249][url]);?>">单机游戏</a>
			<div class='nav-item-subnav'><?php $n=1;if(is_array(subcat(249,0,0,$siteid))) foreach(subcat(249,0,0,$siteid) AS $r) { ?><?php if($r[catid]!=284) { ?><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo $r['catname'];?></a>|<?php } ?><?php $n++;}unset($n); ?></div>
		</li>
		<li class='nav-item <?php if($catid==251 || $parentid==251 || $top2_parentid==251) { ?>nav-item-cur<?php } ?>'>
			<a class='nav-item-link' href="<?php echo url_change($CATEGORYS[251][url]);?>">手机游戏</a>
			<div class='nav-item-subnav'><?php $n=1;if(is_array(subcat(251,0,0,$siteid))) foreach(subcat(251,0,0,$siteid) AS $r) { ?><a target='_blank' href="<?php echo url_change($r[url]);?>" ><?php echo $r['catname'];?></a>|<?php $n++;}unset($n); ?></div>
		</li>
		<li class='nav-item <?php if($catid==252 || $parentid==252 || $top2_parentid==252) { ?>nav-item-cur<?php } ?>'>
			<a class='nav-item-link' href="<?php echo url_change($CATEGORYS[252][url]);?>">游戏图库</a>
			<div class='nav-item-subnav'><?php $n=1;if(is_array(subcat(252,0,0,$siteid))) foreach(subcat(252,0,0,$siteid) AS $r) { ?><a target='_blank' href="<?php echo url_change($r[url]);?>" <?php if($catid==$r[catid]) { ?> class='cur'<?php } ?>><?php echo $r['catname'];?></a>|<?php $n++;}unset($n); ?></div>
		</li>
	</ul>
</div>
<!-- Header End -->