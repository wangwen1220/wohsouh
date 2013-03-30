<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!-- Header Start -->
<div id="header" class='fn-clear'>
	<div class='title'>
		<a class='logo' href="<?php echo url_change($CATEGORYS[246][url]);?>" title="火秀游戏"><img src='/statics/images/game/logo.png' alt='火秀游戏' width='147' height='66' /></a>
		<h1><a target='_blank' href="<?php echo url_change($CATEGORYS[300][url]);?>">安卓Android</a></h1>
		<h2><?php echo url_change(catpos($catid));?></h2>
	</div>

	<form id="search-form" class='search' name="search" method="get" action="<?php echo APP_PATH;?>index.php" target="_blank">
		<input type="hidden" value="search" name="app" />
		<input type="hidden" name="m" value="search" />
		<input type="hidden" name="c" value="index" />
		<input type="hidden" name="a" value="init" />
		<input type="hidden" name="typeid" value="1" id="typeid" /><!-- 搜索类型 -->
		<fieldset><input type='text' name='q' class='search-wd' value='搜索关键字' /><button type='submit' class='search-submit'>搜索</button></fieldset>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=44fa2e2cb52ee8c9faf396018e94c2fe&action=position&posid=580&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'580','order'=>'listorder DESC','limit'=>'3',));}?>
		<fieldset class='search-hotspot'>热点：<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?><a target='_blank' href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],20,'');?></a> <?php $n++;}unset($n); ?></fieldset>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	</form>

	<ul id="nav" class='nav fn-cb fn-clear'>
		<li class='nav-item <?php if($catid==300) { ?>nav-item-cur<?php } ?>'>
			<a class='nav-item-link' href="<?php echo url_change($CATEGORYS[300][url]);?>">安卓首页</a>
			<div class='nav-item-subnav'>
				<dl class='nav-item-subnav-item fn-clear'>
					<dt>安卓游戏</dt>
					<dd><?php $n=1;if(is_array(subcat(346,0,0,$siteid))) foreach(subcat(346,0,0,$siteid) AS $r) { ?><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo $r['catname'];?></a> | <?php $n++;}unset($n); ?></dd>
				</dl>
				<dl class='nav-item-subnav-item fn-clear'>
					<dt>安卓软件</dt>
					<dd><?php $n=1;if(is_array(subcat(347,0,0,$siteid))) foreach(subcat(347,0,0,$siteid) AS $r) { ?><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo $r['catname'];?></a> | <?php $n++;}unset($n); ?></dd>
				</dl>
				<dl class='nav-item-subnav-item fn-clear'>
					<dt>专题推荐</dt>
					<dd>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=abc39dffbcbe04872cf5c2eb2959706f&action=get_special_pos&posid=42&order=inputtime+DESC&limit=12\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'42','order'=>'inputtime DESC','limit'=>'20',));}?>
   				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<a href='<?php echo $r['url'];?>'><?php echo $r['special_name'];?></a> |
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</dd>
				</dl>
			</div>
		</li>
		<li class='nav-item <?php if($catid==307) { ?>nav-item-cur<?php } ?>'>
			<a class='nav-item-link' href="<?php echo url_change($CATEGORYS[307][url]);?>" target='_blank'>游戏下载</a>
		</li>
		<li class='nav-item <?php if($catid==308) { ?>nav-item-cur<?php } ?>'>
			<a class='nav-item-link' href="<?php echo url_change($CATEGORYS[308][url]);?>" target='_blank'>软件下载</a>
		</li>
		<li class='nav-item <?php if($catid==309) { ?>nav-item-cur<?php } ?>'>
			<a class='nav-item-link' href="<?php echo url_change($CATEGORYS[309][url]);?>" target='_blank'>壁纸下载</a>
		</li>
		<li class='nav-item <?php if($catid==310) { ?>nav-item-cur<?php } ?>'>
			<a class='nav-item-link' href="<?php echo url_change($CATEGORYS[310][url]);?>" target='_blank'>安卓资讯</a>
		</li>
		<li class='nav-item <?php if($catid==335) { ?>nav-item-cur<?php } ?>'>
			<a class='nav-item-link' href="<?php echo url_change($CATEGORYS[335][url]);?>" target='_blank'>安卓攻略</a>
		</li>
		<li class='drop-down'>
			<h3><a href="<?php echo url_change($CATEGORYS[300][url]);?>">Android</a></h3>
			<ul>
				<li><a href="<?php echo url_change($CATEGORYS[299][url]);?>" target='_blank'>iPhone</a></li>
				<li><a href="<?php echo url_change($CATEGORYS[300][url]);?>">Android</a></li>
				<li><a href="<?php echo url_change($CATEGORYS[301][url]);?>" target='_blank'>WP/Win8</a></li>
			</ul>
		</li>
	</ul>
</div>
<!-- Header End -->