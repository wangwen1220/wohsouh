<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<!--<title>游戏首页 - 火秀网</title>-->
	<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?> 火秀网</title>
	<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
	<meta name="description" content="<?php echo $SEO['description'];?>">
	<meta name='author' content='火秀网' />
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
	<link href='<?php echo CSS_PATH;?>hs-game-index.css?v=201300308' rel='stylesheet' />
	<link href='http://www.huoshow.com/favicon.ico' rel='icon' />
</head>

<body class='game-index'>
	<?php include template('content', 'hs_topbar'); ?>

	<!-- Header -->
	<div id="header" class='fn-clear'>
		<h1 class='logo'><a href="<?php echo url_change($CATEGORYS[246][url]);?>" title="火秀游戏"><img src='/statics/images/game/logo.png' alt='火秀游戏' width='147' height='66' /></a></h1>

		<ul class='menu fn-clear'>
			<li class='menu-item menu-item-first'>
				<strong><a href="<?php echo url_change($CATEGORYS[250][url]);?>" target='_blank'>新游戏</a></strong>
				<a href="<?php echo url_change($CATEGORYS[297][url]);?>" target='_blank'>评测</a>
				<a href="<?php echo url_change($CATEGORYS[296][url]);?>" target='_blank'>截图</a>
				<a href="<?php echo url_change($CATEGORYS[296][url]);?>" target='_blank'>新游图库</a>
			</li>
			<li class='menu-item'>
				<strong><a href="<?php echo url_change($CATEGORYS[247][url]);?>" target='_blank'>网络游戏</a></strong>
				<a href="<?php echo url_change($CATEGORYS[253][url]);?>" target='_blank'>资讯</a>
				<a href="<?php echo url_change($CATEGORYS[254][url]);?>" target='_blank'>攻略</a>
				<a href="<?php echo url_change($CATEGORYS[255][url]);?>" target='_blank'>网游大观</a>
			</li>
			<li class='menu-item'>
				<strong><a href="<?php echo url_change($CATEGORYS[248][url]);?>" target='_blank'>网页游戏</a></strong>
				<a href="<?php echo url_change($CATEGORYS[272][url]);?>" target='_blank'>资讯</a>
				<a href="<?php echo url_change($CATEGORYS[257][url]);?>" target='_blank'>测试表</a>
				<a href="<?php echo url_change($CATEGORYS[366][url]);?>" target='_blank'>新服</a>
				<a href="<?php echo url_change($CATEGORYS[278][url]);?>" target='_blank'>图片</a>
			</li>
			<li class='menu-item'>
				<strong><a href="<?php echo url_change($CATEGORYS[249][url]);?>" target='_blank'>单机游戏</a></strong>
				<a href="<?php echo url_change($CATEGORYS[282][url]);?>" target='_blank'>游戏库</a>
				<a href="<?php echo url_change($CATEGORYS[280][url]);?>" target='_blank'>下载</a>
				<a href="<?php echo url_change($CATEGORYS[285][url]);?>" target='_blank'>攻略</a>
			</li>
			<li class='menu-item'>
				<strong><a href="<?php echo url_change($CATEGORYS[251][url]);?>" target='_blank'>手机游戏</a></strong>
				<a href="<?php echo url_change($CATEGORYS[299][url]);?>" target='_blank'>iPhone</a>
				<a href="<?php echo url_change($CATEGORYS[300][url]);?>" target='_blank'>安卓游戏</a>
				<a href="<?php echo url_change($CATEGORYS[301][url]);?>" target='_blank'>Windows Phone</a>
			</li>
			<li class='menu-item menu-item-last'>
				<strong><a href="<?php echo url_change($CATEGORYS[252][url]);?>" target='_blank'>游戏图库</a></strong>
				<a href="<?php echo url_change($CATEGORYS[365][url]);?>" target='_blank'>美女</a>
				<a href="<?php echo url_change($CATEGORYS[359][url]);?>" target='_blank'>八卦</a>
				<a href="<?php echo url_change($CATEGORYS[358][url]);?>" target='_blank'>囧图</a>
				<a href="<?php echo url_change($CATEGORYS[357][url]);?>" target='_blank'>漫画</a>
			</li>
		</ul>
	</div>

	<div class='ui-layout ad'><a href='#'><img src='http://pnews.huoshow.com/statics/images/common/middle_anner.png' width='960' height='60' /></a></div>

	<!-- 游戏列表 -->
	<div id='js-tab-game' class='ui-box ui-tab-game fn-clear'>
		<ul class='ui-tab-game-nav fn-clear'>
			<li class='ui-tab-game-nav-item ui-tab-game-nav-item-cur'><a class='online-game' href='javascript:;' hidefocus='true'>网络游戏</a></li>
			<li class='ui-tab-game-nav-item'><a class='web-game' href='javascript:;' hidefocus='true'>网页游戏</a></li>
			<li class='ui-tab-game-nav-item'><a class='pc-game' href='javascript:;' hidefocus='true'>单机游戏</a></li>
			<li class='ui-tab-game-nav-item'><a class='mobile-game' href='javascript:;' hidefocus='true'>手机游戏</a></li>
		</ul>
		<div class='ui-tab-game-cnt'>
			<div class='ui-tab-game-cnt-item ui-tab-game-cnt-item-cur'>
				<div class='ui-tab'>
					<div class='ui-tab-header fn-clear'>
						<ul class='ui-tab-nav fn-clear'>
							<li class='ui-tab-nav-item ui-tab-nav-item-hot ui-tab-nav-item-cur'>热门</li>
							<li class='ui-tab-nav-item'>ABCD</li>
							<li class='ui-tab-nav-item'>EFGH</li>
							<li class='ui-tab-nav-item'>IJKL</li>
							<li class='ui-tab-nav-item'>MNOP</li>
							<li class='ui-tab-nav-item'>QRST</li>
							<li class='ui-tab-nav-item'>WXYZ</li>
							<li class='ui-tab-nav-item'>新网游</li>
						</ul>
						<form id="search-form" class='search game-search' name="search" method="get" action="<?php echo APP_PATH;?>index.php" target="_blank">
							<input type="hidden" value="search" name="app" />
							<input type="hidden" name="m" value="search" />
							<input type="hidden" name="c" value="index" />
							<input type="hidden" name="a" value="init" />
							<input type="hidden" name="typeid" value="1" id="typeid" /><!-- 搜索类型 -->
							<input type='text' name='q' class='search-wd' value='搜索关键字' />
							<button type='submit' class='search-submit'>搜索</button>
						</form>
					</div>
					<div class='ui-tab-cnt'>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=decbc58a2073c7e54831c178d9408c7a&action=get_special_pos&posid=35&order=inputtime+DESC&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'35','order'=>'inputtime DESC','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list ui-tab-cnt-item-cur'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php echo $r['special_name'];?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=c6590f8620ff99a1419aa53684d2fb96&action=get_see_letter_list&catid=247&worda=a&wordb=b&wordc=c&wordd=d&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'247','worda'=>'a','wordb'=>'b','wordc'=>'c','wordd'=>'d','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=d647aadad886b3229014e7c748ec4829&action=get_see_letter_list&catid=247&worda=e&wordb=f&wordc=g&wordd=h&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'247','worda'=>'e','wordb'=>'f','wordc'=>'g','wordd'=>'h','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=e8516a7f86d68127aca26bf6ecb45f20&action=get_see_letter_list&catid=247&worda=i&wordb=j&wordc=k&wordd=l&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'247','worda'=>'i','wordb'=>'j','wordc'=>'k','wordd'=>'l','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=7fd0020518974eaa8baf62a845ce3ec7&action=get_see_letter_list&catid=247&worda=m&wordb=n&wordc=o&wordd=p&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'247','worda'=>'m','wordb'=>'n','wordc'=>'o','wordd'=>'p','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=447aab5493c1ee197c1f16e41250dc27&action=get_see_letter_list&catid=247&worda=q&wordb=r&wordc=s&wordd=t&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'247','worda'=>'q','wordb'=>'r','wordc'=>'s','wordd'=>'t','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=cfff91a1c482218a69331bdd12e5643d&action=get_see_letter_list&catid=247&worda=w&wordb=x&wordc=y&wordd=z&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'247','worda'=>'w','wordb'=>'x','wordc'=>'y','wordd'=>'z','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=57634e8732d3285d0efd44d0babe84eb&action=get_special_pos&posid=27&order=inputtime+DESC&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'27','order'=>'inputtime DESC','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['special_name'];?></em><?php } else { ?><?php echo $r['special_name'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
				</div>
				<div class='new-game'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=55e60ffa91c941fdc032e7ce43bc39bf&action=get_special_pos&posid=28&order=inputtime+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'28','order'=>'inputtime DESC','limit'=>'10',));}?>
				<strong>新游戏：</strong>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<a href='<?php echo $r['url'];?>' target='_blank'><?php echo $r['special_name'];?></a> |
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
			</div>

			<div class='ui-tab-game-cnt-item'>
				<div class='ui-tab'>
					<div class='ui-tab-header fn-clear'>
						<ul class='ui-tab-nav fn-clear'>
							<li class='ui-tab-nav-item ui-tab-nav-item-hot ui-tab-nav-item-cur'>网页</li>
							<li class='ui-tab-nav-item'>ABCD</li>
							<li class='ui-tab-nav-item'>EFGH</li>
							<li class='ui-tab-nav-item'>IJKL</li>
							<li class='ui-tab-nav-item'>MNOP</li>
							<li class='ui-tab-nav-item'>QRST</li>
							<li class='ui-tab-nav-item'>WXYZ</li>
							<li class='ui-tab-nav-item'>新网游</li>
						</ul>
						<form class="search" action=''><input type='text' name='q' class='search-wd' value='请输入游戏名' /><a class='mic' href='javascript:;'></a><button type='submit' class='search-submit'>搜索</button></form>
					</div>
					<div class='ui-tab-cnt'>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=58a1438f96133cd2d2c954fbecd2cada&action=get_special_pos&posid=36&order=inputtime+DESC&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'36','order'=>'inputtime DESC','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list ui-tab-cnt-item-cur'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php echo $r['special_name'];?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=218e9f10b4a575e2f905c22d0355447c&action=get_see_letter_list&catid=248&worda=a&wordb=b&wordc=c&wordd=d&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'248','worda'=>'a','wordb'=>'b','wordc'=>'c','wordd'=>'d','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=2b07539e4fa4468baede13b5f852ab94&action=get_see_letter_list&catid=248&worda=e&wordb=f&wordc=g&wordd=h&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'248','worda'=>'e','wordb'=>'f','wordc'=>'g','wordd'=>'h','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=9eedefbb3160492a0be6de04e79a4d6b&action=get_see_letter_list&catid=248&worda=i&wordb=j&wordc=k&wordd=l&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'248','worda'=>'i','wordb'=>'j','wordc'=>'k','wordd'=>'l','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=00262659dcc08684b89116271ae80950&action=get_see_letter_list&catid=248&worda=m&wordb=n&wordc=o&wordd=p&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'248','worda'=>'m','wordb'=>'n','wordc'=>'o','wordd'=>'p','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=72e24ba02321b95254ad6690a432b97e&action=get_see_letter_list&catid=248&worda=q&wordb=r&wordc=s&wordd=t&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'248','worda'=>'q','wordb'=>'r','wordc'=>'s','wordd'=>'t','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=da1b37c191d2d39c34d510625dac079b&action=get_see_letter_list&catid=248&worda=w&wordb=x&wordc=y&wordd=z&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'248','worda'=>'w','wordb'=>'x','wordc'=>'y','wordd'=>'z','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=a12d2b3adb1a4d6a674096811c81f623&action=get_special_pos&posid=29&order=inputtime+DESC&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'29','order'=>'inputtime DESC','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php echo $r['special_name'];?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
				</div>

				<div class='new-game'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=ef80ca129db2a1fe43eec70cb8630b6a&action=get_special_pos&posid=30&order=inputtime+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'30','order'=>'inputtime DESC','limit'=>'10',));}?>
				<strong>新游戏：</strong>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<a href='<?php echo $r['url'];?>' target='_blank'><?php echo $r['special_name'];?></a> |
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
			</div>

			<div class='ui-tab-game-cnt-item'>
				<div class='ui-tab'>
					<div class='ui-tab-header fn-clear'>
						<ul class='ui-tab-nav fn-clear'>
							<li class='ui-tab-nav-item ui-tab-nav-item-hot ui-tab-nav-item-cur'>单机</li>
							<li class='ui-tab-nav-item'>ABCD</li>
							<li class='ui-tab-nav-item'>EFGH</li>
							<li class='ui-tab-nav-item'>IJKL</li>
							<li class='ui-tab-nav-item'>MNOP</li>
							<li class='ui-tab-nav-item'>QRST</li>
							<li class='ui-tab-nav-item'>WXYZ</li>
							<li class='ui-tab-nav-item'>新网游</li>
						</ul>
						<form class="search" action=''><input type='text' name='q' class='search-wd' value='请输入游戏名' /><a class='mic' href='javascript:;'></a><button type='submit' class='search-submit'>搜索</button></form>
					</div>
					<div class='ui-tab-cnt'>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=c31c58687ccdcc13d4387c3130aff35e&action=get_special_pos&posid=37&order=inputtime+DESC&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'37','order'=>'inputtime DESC','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list ui-tab-cnt-item-cur'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php echo $r['special_name'];?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=3c0ca30b6a579068ebfaedebf22a8174&action=get_see_letter_list&catid=249&worda=a&wordb=b&wordc=c&wordd=d&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'249','worda'=>'a','wordb'=>'b','wordc'=>'c','wordd'=>'d','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=c7f6405faca2c6c464741fdc2ea6129d&action=get_see_letter_list&catid=249&worda=e&wordb=f&wordc=g&wordd=h&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'249','worda'=>'e','wordb'=>'f','wordc'=>'g','wordd'=>'h','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=a32cc01528bc9aa9397859036188b095&action=get_see_letter_list&catid=249&worda=i&wordb=j&wordc=k&wordd=l&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'249','worda'=>'i','wordb'=>'j','wordc'=>'k','wordd'=>'l','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=2569ef17ba666168657b64e2f89e89fa&action=get_see_letter_list&catid=249&worda=m&wordb=n&wordc=o&wordd=p&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'249','worda'=>'m','wordb'=>'n','wordc'=>'o','wordd'=>'p','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=fd251698dd308aa48079b13d7d28d65d&action=get_see_letter_list&catid=249&worda=q&wordb=r&wordc=s&wordd=t&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'249','worda'=>'q','wordb'=>'r','wordc'=>'s','wordd'=>'t','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=cfd31be19cb723e00a73a096a433f6a5&action=get_see_letter_list&catid=249&worda=w&wordb=x&wordc=y&wordd=z&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'249','worda'=>'w','wordb'=>'x','wordc'=>'y','wordd'=>'z','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=4a31e8bbeb11b436119e81ba8fd2b8a5&action=get_special_pos&posid=31&order=inputtime+DESC&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'31','order'=>'inputtime DESC','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php echo $r['special_name'];?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
				</div>
				<div class='new-game'>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=418dfd59563cecc5dc5bd671f7e93f1b&action=get_special_pos&posid=32&order=inputtime+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'32','order'=>'inputtime DESC','limit'=>'10',));}?>
					<strong>新游戏：</strong>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<a href='<?php echo $r['url'];?>' target='_blank'><?php echo $r['special_name'];?></a> |
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
			</div>

			<div class='ui-tab-game-cnt-item'>
				<div class='ui-tab'>
					<div class='ui-tab-header fn-clear'>
						<ul class='ui-tab-nav fn-clear'>
							<li class='ui-tab-nav-item ui-tab-nav-item-hot ui-tab-nav-item-cur'>手机</li>
							<li class='ui-tab-nav-item'>ABCD</li>
							<li class='ui-tab-nav-item'>EFGH</li>
							<li class='ui-tab-nav-item'>IJKL</li>
							<li class='ui-tab-nav-item'>MNOP</li>
							<li class='ui-tab-nav-item'>QRST</li>
							<li class='ui-tab-nav-item'>WXYZ</li>
							<li class='ui-tab-nav-item'>新网游</li>
						</ul>
						<form class="search" action=''><input type='text' name='q' class='search-wd' value='请输入游戏名' /><a class='mic' href='javascript:;'></a><button type='submit' class='search-submit'>搜索</button></form>
					</div>
					<div class='ui-tab-cnt'>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=abb40072d04963fda453a29dfc3635e3&action=get_special_pos&posid=38&order=inputtime+DESC&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'38','order'=>'inputtime DESC','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list ui-tab-cnt-item-cur'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php echo $r['special_name'];?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=60170864215e0bfe3149eb2f8c0f2376&action=get_see_letter_list&catid=251&worda=a&wordb=b&wordc=c&wordd=d&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'251','worda'=>'a','wordb'=>'b','wordc'=>'c','wordd'=>'d','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=a04717379675e55d3c3b1b07d73713dc&action=get_see_letter_list&catid=251&worda=e&wordb=f&wordc=g&wordd=h&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'251','worda'=>'e','wordb'=>'f','wordc'=>'g','wordd'=>'h','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=38916d184a40793fbe051decd3accdcf&action=get_see_letter_list&catid=251&worda=i&wordb=j&wordc=k&wordd=l&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'251','worda'=>'i','wordb'=>'j','wordc'=>'k','wordd'=>'l','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=eb3e60e0423e451150bfb011d6285d57&action=get_see_letter_list&catid=251&worda=m&wordb=n&wordc=o&wordd=p&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'251','worda'=>'m','wordb'=>'n','wordc'=>'o','wordd'=>'p','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=8d4d6a3e23755381d1ff6c1f79c62ab3&action=get_see_letter_list&catid=251&worda=q&wordb=r&wordc=s&wordd=t&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'251','worda'=>'q','wordb'=>'r','wordc'=>'s','wordd'=>'t','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=7eb557ba250c3b660a42a149d3102d08&action=get_see_letter_list&catid=251&worda=w&wordb=x&wordc=y&wordd=z&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>'251','worda'=>'w','wordb'=>'x','wordc'=>'y','wordd'=>'z','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php if($n%5==0) { ?><em><?php echo $r['title'];?></em><?php } else { ?><?php echo $r['title'];?><?php } ?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=f3169d468dc81306c0e34fe6f95b974e&action=get_special_pos&posid=33&order=inputtime+DESC&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'33','order'=>'inputtime DESC','limit'=>'60',));}?>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php echo $r['special_name'];?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
				</div>
				<div class='new-game'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=138557e8635742645678e502b311766c&action=get_special_pos&posid=34&order=inputtime+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'34','order'=>'inputtime DESC','limit'=>'10',));}?>
				<strong>新游戏：</strong>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<a href='<?php echo $r['url'];?>' target='_blank'><?php echo $r['special_name'];?></a> |
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
			</div>
		</div>
	</div>

	<!-- 主内容 -->
	<div id='content-main' class='ui-layout fn-clear'>
		<div class='ui-layout-item ui-layout-item-side'>
			<div class='ui-box ui-box-game'>
				<div class='ui-header'>
					<h3 class='title'>新游测试表</h3>
					<!-- <div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div> -->
				</div>
				<table class='ui-game-table'>
					<thead>
						<tr>
							<th class='time'>时间</th>
							<th class='name'>游戏名</th>
							<th class='status'>状态</th>
							<th class='btn'>拿号</th>
						</tr>
					</thead>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=4b923d734eebf9b67ab93c6524efc40a&action=get_special_pos&posid=16&order=inputtime+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'16','order'=>'inputtime DESC','limit'=>'8',));}?>
					<tbody>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<tr>
							<td class='time'><?php echo date('m-d',time($r[inputtime]));?></td>
							<td class='name'><a href='<?php echo $r['url'];?>' target='_blank'><?php echo $r['special_name'];?></a></td>
							<?php if($r[tmp]) { ?>
								<?php $n=1;if(is_array($r[tmp])) foreach($r[tmp] AS $v) { ?>
									<td class='status'><?php echo $v['game_state'];?></td>
								<?php $n++;}unset($n); ?>
							<?php } else { ?>
								<td class='status'>——</td>
							<?php } ?>
							<?php if($r[gamenum] >0) { ?>
								<td class='btn btn-get'><a href='<?php echo $r['url'];?> target='_blank'' target='_blank'>领</a></td>
							<?php } else { ?>
								<td class='btn btn-order'><a href='<?php echo $r['url'];?>' target='_blank'>订</a></td>
							<?php } ?>
						</tr>
						<?php $n++;}unset($n); ?>
					</tbody>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</table>
			</div>
			<div class='ui-box ui-box-game'>
				<div class='ui-header'>
					<h3 class='title'>网页游戏测试表</h3>
					<!-- <div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div> -->
				</div>
				<table class='ui-game-table'>
					<thead>
						<tr>
							<th class='time'>时间</th>
							<th class='name'>游戏名</th>
							<th class='status'>状态</th>
							<th class='btn'>拿号</th>
						</tr>
					</thead>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=059578a15f9d1e82367367685e9362d8&action=get_special_pos&posid=17&order=inputtime+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'17','order'=>'inputtime DESC','limit'=>'5',));}?>
					<tbody>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<tr>
							<td class='time'><?php echo date('m-d',time($r[inputtime]));?></td>
							<td class='name'><a href='<?php echo $r['url'];?>' target='_blank'><?php echo $r['special_name'];?></a></td>
							<?php if($r[tmp]) { ?>
								<?php $n=1;if(is_array($r[tmp])) foreach($r[tmp] AS $v) { ?>
								<td class='status'><?php echo $v['game_state'];?></td>
								<?php $n++;}unset($n); ?>
							<?php } else { ?>
								<td class='status'>——</td>
							<?php } ?>
							<?php if($r[gamenum] >0) { ?>
								<td class='btn btn-get'><a href='<?php echo $r['url'];?>' target='_blank'>领</a></td>
							<?php } else { ?>
								<td class='btn btn-order'><a href='<?php echo $r['url'];?>' target='_blank'>订</a></td>
							<?php } ?>
						</tr>
						<?php $n++;}unset($n); ?>
					</tbody>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</table>
			</div>
			<div class='ui-box ui-box-game'>
				<div class='ui-header'>
					<h3 class='title'>趣闻热榜</h3>
					<!-- <div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div> -->
				</div>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=0888f8cd5a961a02282e4f9ddb567f7e&action=position&posid=518&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'518','order'=>'listorder DESC','limit'=>'8',));}?>
				<ol class='ui-list-plus'>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-list-plus-item'><span class='num <?php if($n<4) { ?>num-hot<?php } ?>'><?php echo $n;?></span><a target='_blank' title='<?php echo $r['title'];?>' class='title' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r[title], 60,'');?></a></li>
					<?php $n++;}unset($n); ?>
				</ol>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>
		</div>

		<div class='ui-layout-item ui-layout-item-main'>
			<div id='myfocus-kiki-top' class='ui-myfocus'>
				<div class="loading"></div>
				<div class="pic">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7184592b72997435da0b9257288554be&action=position&posid=511&thumb=1&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'511','thumb'=>'1','order'=>'listorder DESC','limit'=>'5',));}?>
					<ul>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li><a target='_blank' href="<?php echo url_change($r[url]);?>"><img src="<?php echo thumb($r[thumb],440,200);?>" alt="<?php echo $r['title'];?>" width='440' height='200' /></a></li>
						<?php $n++;}unset($n); ?>
					</ul>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
			</div>

			<div class='ui-tab ui-tab-easy'>
				<div class='ui-tab-header fn-clear'>
					<ul class='ui-tab-nav fn-clear'>
						<li class='ui-tab-nav-item ui-tab-nav-item-cur'>今日要闻</li>
						<li class='ui-tab-nav-item'>图片推荐</li>
					</ul>
					<!-- <div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div> -->
				</div>
				<div class='ui-tab-cnt'>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b60329698a47ed6b589e9ab3db24b167&action=position&posid=512&order=listorder+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'512','order'=>'listorder DESC','limit'=>'10',));}?>
					<div class='ui-tab-cnt-item ui-tab-cnt-item-cur'>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==1) { ?>
							<h2 class='ui-newgame-title'><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r[title], 60,'');?></a></h2>
						<?php } ?>
						<?php $n++;}unset($n); ?>
						<div class='ui-newgame-link'>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n!=1) { ?>
							<a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>">[<?php echo str_cut($r[title], 48,'');?>]</a>
						<?php } ?>
                        <?php if($n==3) break;?>
						<?php $n++;}unset($n); ?>
						</div>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==4) { ?>
							<h2 class='ui-newgame-title'><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r[title], 60,'');?></a></h2>
						<?php } ?>
						<?php $n++;}unset($n); ?>
						<div class='ui-newgame-link'>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n>4) { ?>
							<a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>">[<?php echo str_cut($r[title], 45,'');?>]</a>
						<?php } ?>
                        <?php if($n==6) break;?>
						<?php $n++;}unset($n); ?>
						</div>
					</div>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=8f3b6b8922db88ca2ea492f0be05c758&action=position&posid=513&order=listorder+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'513','order'=>'listorder DESC','limit'=>'10',));}?>
					<div class='ui-tab-cnt-item'>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==1) { ?>
							<h2 class='ui-newgame-title'><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r[title], 60,'');?></a></h2>
						<?php } ?>
						<?php $n++;}unset($n); ?>
						<div class='ui-newgame-link'>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n!=1) { ?>
							<a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>">[<?php echo str_cut($r[title], 60,'');?>]</a>
						<?php } ?>
                        <?php if($n==3) break;?>
						<?php $n++;}unset($n); ?>
						</div>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==4) { ?>
							<h2 class='ui-newgame-title'><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r[title], 60,'');?></a></h2>
						<?php } ?>
						<?php $n++;}unset($n); ?>
						<div class='ui-newgame-link'>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n>4) { ?>
							<a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>">[<?php echo str_cut($r[title], 45,'');?>]</a>
						<?php } ?>
                        <?php if($n==6) break;?>
						<?php $n++;}unset($n); ?>
						</div>
					</div>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
			</div>

			<div class='ui-art ui-art-hr fn-clear'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=644bd575430aae50e200aa07ebd7f333&action=position&posid=514&thumb=1&order=listorder+DESC&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'514','thumb'=>'1','order'=>'listorder DESC','limit'=>'1',));}?>
				<div class='img'>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<a target='_blank' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],106,90);?>' alt='' width='106' height='90' /></a>
					<h4><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r[title], 15,'');?></a></h4>
					<?php $n++;}unset($n); ?>
				</div>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=979d0b3c81543e0a74b94940ce359058&action=position&posid=516&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'516','order'=>'listorder DESC','limit'=>'4',));}?>
				<ul class='ui-list ui-list-main'>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-list-item'><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><!--[<?php echo $CATEGORYS[$r['catid']]['catname'];?>]--> <?php echo str_cut($r[title], 60,'');?></a></li>
					<?php $n++;}unset($n); ?>
				</ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>

			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=1656b160befb6321dd7f715e2dccaf3c&action=position&posid=515&order=listorder+DESC&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'515','order'=>'listorder DESC','limit'=>'1',));}?>
			<h2 class='ui-newgame-title ui-newgame-title-recommend'>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r[title], 60,'');?></a>
			<?php $n++;}unset($n); ?>
			</h2>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

			<div class='ui-art fn-clear'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a97cd281de1af3292a78f24c7ad97152&action=position&posid=514&thumb=1&order=listorder+DESC&num=2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'514','thumb'=>'1','order'=>'listorder DESC','limit'=>'2',));}?>
				<div class='img'>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n>1) { ?>
							<a target='_blank' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],106,90);?>' alt='' width='106' height='90' /></a>
							<h4><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r[title], 15,'');?></a></h4>
						<?php } ?>
					<?php $n++;}unset($n); ?>
				</div>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=44247f42e81ce3bd7164da3d8b2758fb&action=position&posid=516&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'516','order'=>'listorder DESC','limit'=>'8',));}?>
				<ul class='ui-list ui-list-main'>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n>4) { ?>
							<li class='ui-list-item'><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><!--[<?php echo $CATEGORYS[$r['catid']]['catname'];?>]--> <?php echo str_cut($r[title], 60,'');?></a></li>
						<?php } ?>
					<?php $n++;}unset($n); ?>
				</ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>

			<div class='ui-tab ui-tab-easy'>
				<div class='ui-tab-header fn-clear'>
					<ul class='ui-tab-nav fn-clear'>
						<li class='ui-tab-nav-item ui-tab-nav-item-cur'><!-- 热门视频 -->热门新闻</li>
					</ul>
					<!-- <div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div> -->
				</div>
				<div class='ui-tab-cnt'>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4d09e673d7163108d52275854074c257&action=position&posid=517&thumb=1&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'517','thumb'=>'1','order'=>'listorder DESC','limit'=>'4',));}?>
					<ul class='ui-tab-cnt-item ui-tab-cnt-item-cur ui-img-list ui-img-list-plus'>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class='ui-img-list-item'>
							<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],102,76);?>' width='102' height='76' /><span class='icon-play'></span></a>
							<a target='_blank' title='<?php echo $r['title'];?>' class='title' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r[title], 30,'');?></a>
						</li>
						<?php $n++;}unset($n); ?>
					</ul>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
			</div>
		</div>

		<div class='ui-layout-item ui-layout-item-sub'>
			<div class='ui-tab ui-tab-sd'>
				<ul class='ui-tab-nav fn-clear'>
					<li class='ui-tab-nav-item ui-tab-nav-item-cur'>推荐</li>
					<li class='ui-tab-nav-item'>预定</li>
					<li class='ui-tab-nav-item'>发号</li>
				</ul>
				<div class='ui-tab-cnt'>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=160637e1d3b142c343a7d1d0c959f940&action=get_special_pos&posid=19&order=inputtime+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'19','order'=>'inputtime DESC','limit'=>'3',));}?>
					<ul class='ui-tab-cnt-item ui-tab-cnt-item-cur ui-gamenum-list'>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class='ui-gamenum'>
							<a target='_blank' class='img' href='<?php echo $r['url'];?>'><img src='<?php echo thumb($r[thumb],80,60);?>' width='80' height='60'/></a>
							<h4 class='title'><a target='_blank' href='<?php echo $r['url'];?>'><?php echo $r['special_name'];?></a></h4>
							<p class='status'>剩余：<?php echo $r['gamenum'];?> 号</p>
							<p class='content'><a target='_blank' href='<?php echo $r['url'];?>'>游戏库</a> | <a target='_blank' href='<?php echo $r['url'];?>'>图片</a><em><?php echo $r['pic_total'];?></em> | <a target='_blank' href='<?php echo $r['url'];?>'>新闻</a><em><?php echo $r['news_total'];?></em></p>
							<?php if($r[gamenum] >0) { ?><a target='_blank' class='button' href='<?php echo $r['url'];?>'>领号</a><?php } ?>
						</li>
						<?php $n++;}unset($n); ?>
					</ul>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=29ee2731552e65a35b8f91782463d02b&action=get_special_pos&posid=20&order=inputtime+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'20','order'=>'inputtime DESC','limit'=>'3',));}?>
					<ul class='ui-tab-cnt-item ui-gamenum-list'>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class='ui-gamenum'>
							<a target='_blank' class='img' href='<?php echo $r['url'];?>'><img src='<?php echo thumb($r[thumb],80,60);?>' width='80' height='60'/></a>
							<h4 class='title'><a target='_blank' href='<?php echo $r['url'];?>'><?php echo $r['special_name'];?></a></h4>
							<p class='status'>剩余：<?php echo $r['gamenum'];?> 号</p>
							<p class='content'><a target='_blank' href='<?php echo $r['url'];?>'>游戏库</a> | <a target='_blank' href='<?php echo $r['url'];?>'>图片</a><em><?php echo $r['pic_total'];?></em> | <a target='_blank' href='<?php echo $r['url'];?>'>新闻</a><em><?php echo $r['news_total'];?></em></p>
							<?php if($r[gamenum] >0) { ?><a target='_blank' class='button' href='<?php echo $r['url'];?>'>领号</a><?php } ?>
						</li>
						<?php $n++;}unset($n); ?>
					</ul>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=0f7894f861ce3ca8628df693877ffad3&action=get_special_pos&posid=21&order=inputtime+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'21','order'=>'inputtime DESC','limit'=>'3',));}?>
					<ul class='ui-tab-cnt-item ui-gamenum-list'>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class='ui-gamenum'>
							<a target='_blank' class='img' href='<?php echo $r['url'];?>'><img src='<?php echo thumb($r[thumb],80,60);?>' width='80' height='60'/></a>
							<h4 class='title'><a target='_blank' href='<?php echo $r['url'];?>'><?php echo $r['special_name'];?></a></h4>
							<p class='status'>剩余：<?php echo $r['gamenum'];?> 号</p>
							<p class='content'><a target='_blank' href='<?php echo $r['url'];?>'>游戏库</a> | <a target='_blank' href='<?php echo $r['url'];?>'>图片</a><em><?php echo $r['pic_total'];?></em> | <a target='_blank' href='<?php echo $r['url'];?>'>新闻</a><em><?php echo $r['news_total'];?></em></p>
							<?php if($r[gamenum] >0) { ?><a target='_blank' class='button' href='<?php echo $r['url'];?>'>领号</a><?php } ?>
						</li>
						<?php $n++;}unset($n); ?>
					</ul>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
			</div>

			<div class='ui-tab ui-tab-sd'>
				<ul class='ui-tab-nav fn-clear'>
					<li class='ui-tab-nav-item ui-tab-nav-item-cur'>预定排行榜</li>
					<li class='ui-tab-nav-item'>一周特权榜</li>
					<li class='ui-tab-nav-item'>一周发号榜</li>
				</ul>
				<div class='ui-tab-cnt'>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=148d7ecb4eb3ff7040429f5411f1837a&action=get_special_pos&posid=22&order=inputtime+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'22','order'=>'inputtime DESC','limit'=>'8',));}?>
					<ol class='ui-tab-cnt-item ui-tab-cnt-item-cur ui-list-plus'>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class='ui-list-plus-item'><span class='num <?php if($n<4) { ?>num-hot<?php } ?>'><?php echo $n;?></span><a target='_blank' class='title' href='<?php echo $r['url'];?>'><?php echo $r['special_name'];?></a><a target='_blank' class='video' href='<?php echo $r['url'];?>'>(<?php echo $r['news_total'];?>)</a><span class='status'><?php echo $r['gamenum'];?></span><?php if($r[gamenum]>0) { ?><a target='_blank' class='btn btn-get' href='<?php echo $r['url'];?>'>领</a><?php } ?></li>
						<?php $n++;}unset($n); ?>
					</ol>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=9808176874f3ae4a22b0023eb83f687a&action=get_special_pos&posid=23&order=inputtime+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'23','order'=>'inputtime DESC','limit'=>'8',));}?>
					<ol class='ui-tab-cnt-item ui-list-plus'>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class='ui-list-plus-item'><span class='num <?php if($n<4) { ?>num-hot<?php } ?>'><?php echo $n;?></span><a target='_blank' class='title' href='<?php echo $r['url'];?>'><?php echo $r['special_name'];?></a><a target='_blank' class='video' href='<?php echo $r['url'];?>'>(<?php echo $r['news_total'];?>)</a><span class='status'><?php echo $r['gamenum'];?></span><?php if($r[gamenum]>0) { ?><a target='_blank' class='btn btn-get' href='<?php echo $r['url'];?>'>领</a><?php } ?></li>
						<?php $n++;}unset($n); ?>
					</ol>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=16d7ac5d814195fa0a2eb33b84329093&action=get_special_pos&posid=24&order=inputtime+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'24','order'=>'inputtime DESC','limit'=>'8',));}?>
					<ol class='ui-tab-cnt-item ui-list-plus'>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class='ui-list-plus-item'><span class='num <?php if($n<4) { ?>num-hot<?php } ?>'><?php echo $n;?></span><a target='_blank' class='title' href='<?php echo $r['url'];?>'><?php echo $r['special_name'];?></a><a target='_blank' class='video' href='<?php echo $r['url'];?>'>(<?php echo $r['news_total'];?>)</a><span class='status'><?php echo $r['gamenum'];?></span><?php if($r[gamenum]>0) { ?><a target='_blank' class='btn btn-get' href='<?php echo $r['url'];?>'>领</a><?php } ?></li>
						<?php $n++;}unset($n); ?>
					</ol>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
			</div>

			<div class='ad'><a href='#'><img src='http://pnews.huoshow.com/statics/images/common/ad7.jpg' width='280' height='250' /></a></div>
		</div>
	</div>

	<!-- 网络游戏 -->
	<div id='content-online-game' class='ui-game fn-clear'>
		<div class='ui-game-header'>
			<h2 class='title'>网络游戏</h2>
			<div class='link'><?php $n=1;if(is_array(subcat(247,0,0,$siteid))) foreach(subcat(247,0,0,$siteid) AS $r) { ?><?php if($r[catid]!=256) { ?><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo $r['catname'];?></a><?php } ?> | <?php $n++;}unset($n); ?> <a target='_blank' class='more' href="<?php echo url_change($CATEGORYS[247][url]);?>">进入频道&gt;&gt;</a></div>
		</div>

		<div class='ui-game-item ui-game-item-side'>
			<div class='ui-header'>
				<h2 class='title'>热门网游</h2>
			</div>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=803d3b736ecff898f30bb0f558251590&action=get_special_pos&posid=18&order=inputtime+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'18','order'=>'inputtime DESC','limit'=>'10',));}?>
			<ol class='ui-list-plus'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-list-plus-item'><span class='num <?php if($n<4) { ?>num-hot<?php } ?>'><?php echo $n;?></span><a target='_blank' class='title' href='<?php echo $r['url'];?>'><?php echo $r['special_name'];?></a><a target='_blank' class='name' href='<?php echo $r['url'];?>'>专题</a></li>
				<?php $n++;}unset($n); ?>
			</ol>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<div class='ad'><a href='#'><img src='http://pnews.huoshow.com/statics/images/common/ad7.jpg' width='198' height='148' /></a></div>
		</div>

		<div class='ui-game-item ui-game-item-main fn-clear'>
			<div class='ui-header'>
				<h2 class='title'>专区推荐</h2>
				<!-- <div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>-->
			</div>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=2a851aaf8ba7b3bf9074a65919647969&action=position&posid=520&thumb=1&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'520','thumb'=>'1','order'=>'listorder DESC','limit'=>'3',));}?>
			<ul class='ui-img-list'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-img-list-item'>
					<a target='_blank' class='img img-game' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],106,90);?>' width='106' height='90' /></a>
					<h4 class='title'><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a></h4>
				</li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=6f31d5896e22752dce38ffa2cfb11f8d&action=position&posid=519&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'519','order'=>'listorder DESC','limit'=>'3',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php if($n==1) { ?>
			<h2 class='ui-newgame-title'><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a></h2>
			<?php } ?>
			<?php $n++;}unset($n); ?>
			<div class='ui-newgame-link'>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php if($n>1) { ?>
			<a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>">[<?php echo str_cut($r[title],35,'');?>]</a>
			<?php } ?>
			<?php $n++;}unset($n); ?>
			</div>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=6bba0af9b5558e1614ca08006388925e&action=lists&catid=247&order=updatetime+DESC&num=14\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'247','order'=>'updatetime DESC','limit'=>'14',));}?>
			<ul class='ui-list ui-list-main hr'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li <?php if($n==8) { ?> class='ui-list-item bk' <?php } else { ?>class='ui-list-item' <?php } ?>>
				<?php if($n==1 || $n==8) { ?>
				<strong><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a></strong>
				<?php } else { ?>
				<a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a>
				<?php } ?>
				</li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>

		<div class='ui-game-item ui-game-item-sub'>
			<div class='ui-header'>
				<h2 class='title'>最热发号推荐</h2>
			</div>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=7941d949a782046939a680c5845cc00f&action=get_special_pos&posid=26&order=inputtime+DESC&num=2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'26','order'=>'inputtime DESC','limit'=>'2',));}?>
			<ul class='ui-gamenum-list'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-gamenum'>
						<a target='_blank' class='img' href='<?php echo $r['url'];?>'><img src='<?php echo thumb($r[thumb],80,60);?>' width='80' height='60'/></a>
						<h4 class='title'><a target='_blank' href='<?php echo $r['url'];?>'><?php echo $r['special_name'];?></a></h4>
						<p class='status'>剩余：<?php echo $r['gamenum'];?> 号</p>
						<p class='content'><a href="<?php echo $r['url'];?>" target='_blank'>游戏库</a> | <a href="<?php echo $r['url'];?>" target='_blank'> 图片</a><em><?php echo $r['pic_total'];?></em> | <a target='_blank' href="<?php echo $r['url'];?>">新闻</a><em><?php echo $r['news_total'];?></em></p>
						<?php if($r[gamenum] >0) { ?><a target='_blank' class='button button-lh' href='<?php echo $r['url'];?>'>领号</a><?php } ?>
					</li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

			<div class='ui-header'>
				<h2 class='title'>热点活动</h2>
			</div>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=456d436df5c4b68d6d8782ce10ed7760&action=position&posid=521&thumb=1&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'521','thumb'=>'1','order'=>'listorder DESC','limit'=>'4',));}?>
			<ul class='ui-img-list ui-img-list-plus'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],122,90);?>' width='122' height='90' /></a>
					<a target='_blank' title='<?php echo $r['title'];?>' class='title' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a>
				</li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>
	</div>

	<!-- 网页游戏 -->
	<div id='content-web-game' class='ui-game fn-clear'>
		<div class='ui-game-header'>
			<h2 class='title'>网页游戏</h2>
			<div class='link'><?php $n=1;if(is_array(subcat(248,0,0,$siteid))) foreach(subcat(248,0,0,$siteid) AS $r) { ?><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo $r['catname'];?></a> | <?php $n++;}unset($n); ?><a class='more' href="<?php echo url_change($CATEGORYS[248][url]);?>" target='_blank'>进入网页频道&gt;&gt;</a></div>
		</div>

		<div class='ui-game-item ui-game-item-side'>
			<div class='ui-header'>
				<h2 class='title'>热门攻略</h2>
			</div>
			<div id='js_accordion' class='abox-list'>
				<div class='abox abox-cur'>
					<h3 class='abox-title'><a href='javascript:;'><?php echo getCatNameFromCatid(274);?></a></h3>
					<ul class='ui-list hr'>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=5903b4a3cbeb07233f0480ea94348b7e&action=position&posid=447&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'447','order'=>'listorder DESC','limit'=>'4',));}?>
   					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class='ui-list-item'><a target="_blank" href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a></li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</div>
				<div class='abox'>
					<h3 class='abox-title'><a href='javascript:;'><?php echo getCatNameFromCatid(275);?></a></h3>
					<ul class='ui-list hr'>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=8d9e967bf4d83e6b6d55f91749f98b75&action=position&posid=448&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'448','order'=>'listorder DESC','limit'=>'4',));}?>
   					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class='ui-list-item'><a target="_blank" href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a></li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</div>
				<div class='abox'>
					<h3 class='abox-title'><a href='javascript:;'><?php echo getCatNameFromCatid(276);?></a></h3>
					<ul class='ui-list hr'>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=df5a5fe40fe2d584818a3a7c74b87f4c&action=position&posid=449&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'449','order'=>'listorder DESC','limit'=>'4',));}?>
   					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class='ui-list-item'><a target="_blank" href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a></li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</div>
				<div class='abox'>
					<h3 class='abox-title'><a href='javascript:;'><?php echo getCatNameFromCatid(339);?></a></h3>
					<ul class='ui-list hr'>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=2b33c4bcb8a55a2d9247a35ffe8b230a&action=position&posid=450&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'450','order'=>'listorder DESC','limit'=>'4',));}?>
   					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class='ui-list-item'><a target="_blank" href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a></li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</div>
				<div class='abox'>
					<h3 class='abox-title'><a href='javascript:;'><?php echo getCatNameFromCatid(340);?></a></h3>
					<ul class='ui-list hr'>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=1739cafa376ddd420ad4d418d13caa34&action=position&posid=451&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'451','order'=>'listorder DESC','limit'=>'4',));}?>
   					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class='ui-list-item'><a target="_blank" href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a></li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</div>
			</div>
			<!-- <ul class='alist'>注释内容可删除
				<li><a target='_blank' href='#'>测试文字</a></li>
				<li><a href='#'>测试文字</a></li>
				<li><a href='#'>测试文字</a></li>
				<li><a href='#'>测试文字</a></li>
			</ul> -->
			<!-- <div class='abox'>
				<h3><a href='#'>测试文字</a></h3>
				<ul class='ui-list hr'>
					<li target='_blank' class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
					<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
					<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
					<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
				</ul>
			</div> -->
		</div>

		<div class='ui-game-item ui-game-item-main fn-clear'>
			<div class='ui-header'>
				<h2 class='title'>热点资讯</h2>
				<!-- <div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>-->
			</div>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=2dbbbc052042c602850361679d9e4ee8&action=position&posid=523&thumb=1&order=listorder+DESC&num=2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'523','thumb'=>'1','order'=>'listorder DESC','limit'=>'2',));}?>
			<ul class='ui-img-list'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-img-list-item'>
					<a target='_blank' class='img img-game' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],106,90);?>' width='106' height='90' /></a>
					<h4 class='title'><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a></h4>
				</li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a51abfc4d085eeeb0a01f58487bd6783&action=position&posid=522&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'522','order'=>'listorder DESC','limit'=>'3',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php if($n==1) { ?>
			<h2 class='ui-newgame-title'><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a></h2>
			<?php } ?>
			<?php $n++;}unset($n); ?>
			<div class='ui-newgame-link'>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php if($n>1) { ?>
			<a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>">[<?php echo str_cut($r[title],35,'');?>]</a>
			<?php } ?>
			<?php $n++;}unset($n); ?>
			</div>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=0047134cb20c6d933166106323bbbd63&action=lists&catid=248&order=updatetime+DESC&num=7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'248','order'=>'updatetime DESC','limit'=>'7',));}?>
			<ul class='ui-list ui-list-main hr'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-list-item'>
				<?php if($n==1) { ?>
				<strong><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a></strong>
				<?php } else { ?>
				<a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a>
				<?php } ?>
				</li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>

		<div class='ui-game-item ui-game-item-sub'>
			<div class='ui-header'>
				<h2 class='title'>网页游戏热点</h2>
			</div>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=fa0e0c8b65b9b689747330641c9b1dd4&action=position&posid=524&thumb=1&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'524','thumb'=>'1','order'=>'listorder DESC','limit'=>'4',));}?>
			<ul class='ui-img-list ui-img-list-plus'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],122,90);?>' width='122' height='90' /></a>
					<a target='_blank' title='<?php echo $r['title'];?>' class='title' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r[title],30,'');?></a>
				</li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>
	</div>

	<div class='ui-layout ad'><a href='#'><img src='http://pnews.huoshow.com/statics/images/common/middle_anner.png' width='960' height='60' /></a></div>

	<!-- 单机游戏 -->
	<div id='content-pc-game' class='ui-game fn-clear'>
		<div class='ui-game-header'>
			<h2 class='title'>单机游戏</h2>
			<div class='link'><?php $n=1;if(is_array(subcat(249,0,0,$siteid))) foreach(subcat(249,0,0,$siteid) AS $r) { ?><?php if($r[catid]!=284) { ?><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo $r['catname'];?></a><?php } ?> | <?php $n++;}unset($n); ?><a target='_blank' class='more' href="<?php echo url_change($CATEGORYS[249][url]);?>">进入单机频道&gt;&gt;</a></div>
		</div>

		<div class='ui-game-item ui-game-item-side'>
			<div class='ui-header'>
				<h2 class='title'>最新单机游戏</h2>
			</div>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=62562bd44849d79082b77863270be13b&action=get_special_pos&posid=25&order=inputtime+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'25','order'=>'inputtime DESC','limit'=>'10',));}?>
			<ol class='ui-list-plus'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-list-plus-item'><span class='num <?php if($n<4) { ?>num-hot<?php } ?>'><?php echo $n;?></span><a target='_blank' class='title' href='<?php echo $r['url'];?>'><?php echo $r['special_name'];?></a><a target='_blank' class='name' href='<?php echo $r['url'];?>'>专题</a></li>
				<?php $n++;}unset($n); ?>
			</ol>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>

		<div class='ui-game-item ui-game-item-main fn-clear'>
			<div class='ui-header'>
				<h2 class='title'>热点资讯</h2>
				<!-- <div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>-->
			</div>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=bb9f06662e9af2fc188ee0325b25b323&action=position&posid=526&thumb=1&order=listorder+DESC&num=2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'526','thumb'=>'1','order'=>'listorder DESC','limit'=>'2',));}?>
			<ul class='ui-img-list'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-img-list-item'>
					<a target='_blank' class='img img-game' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],106,90);?>' width='106' height='90' /></a>
					<h4 class='title'><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a></h4>
				</li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=2eb9faa9e43c4e8de657e9d2ecfd3e2c&action=position&posid=525&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'525','order'=>'listorder DESC','limit'=>'5',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php if($n==1) { ?>
			<h2 class='ui-newgame-title'><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a></h2>
			<?php } ?>
			<?php $n++;}unset($n); ?>
			<div class='ui-newgame-link'>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php if($n>1) { ?>
			<a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>">[<?php echo str_cut($r[title],35,'');?>]</a>
            <?php if($n==3) break;?>
            <?php } ?>
			<?php $n++;}unset($n); ?>
			</div>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=faf944b008fa8081c81c812dcabffe76&action=lists&catid=249&order=updatetime+DESC&num=7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'249','order'=>'updatetime DESC','limit'=>'7',));}?>
			<ul class='ui-list ui-list-main hr'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-list-item'>
				<?php if($n==1) { ?>
				<strong><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a></strong>
				<?php } else { ?>
				<a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a>
				<?php } ?>
				</li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>

		<div class='ui-game-item ui-game-item-sub'>
			<div class='ui-header'>
				<h2 class='title'>单机图集</h2>
			</div>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=cfa80f634cfc1bebe13133b281c23de0&action=position&posid=527&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'527','order'=>'listorder DESC','limit'=>'5',));}?>
			<ul class='ui-img-list ui-img-list-plus'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],122,90);?>' width='122' height='90' /></a>
					<a target='_blank' title='<?php echo $r['title'];?>' class='title' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r[title],30,'');?></a>
				</li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ac308b015c03835d68e09be32c0f23ba&action=lists&catid=283&order=updatetime+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'283','order'=>'updatetime DESC','limit'=>'5',));}?>
			<ul class='ui-list'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-list-item'><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a></li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>
	</div>

	<!-- 手机游戏 -->
	<div id='content-phone-game' class='ui-game fn-clear'>
		<div class='ui-game-header'>
			<h2 class='title'>手机游戏</h2>
			<div class='link'><?php $n=1;if(is_array(subcat(251,0,0,$siteid))) foreach(subcat(251,0,0,$siteid) AS $r) { ?><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo $r['catname'];?></a> | <?php $n++;}unset($n); ?><a class='more' href="<?php echo url_change($CATEGORYS[251][url]);?>" target='_blank'>进入手机频道&gt;&gt;</a></div>
		</div>

		<div class='ui-game-item ui-game-item-side'>
			<h2 class='game-title game-title-iphone'><a target='_blank' href="<?php echo url_change($CATEGORYS[302][url]);?>">iPhone 应用排行 &gt;&gt;</a></h2>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=1d787ddcc95855ba3e06f2281cdeccbc&action=position&posid=528&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'528','order'=>'listorder DESC','limit'=>'3',));}?>
			<ol class='ui-list-plus ui-ranking ui-ranking-game'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<?php if($n==1) { ?>
				<li class='ui-ranking-item ui-ranking-item-cur'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],50,50);?>' alt='' width='50' height='50' /></a>
					<span class='num num-hot'><?php echo $n;?></span>
					<h3 class='title'><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a></h3>
					<!--<p class="content">3521</p>-->
					<div class='star star3'></div>
				</li>
				<?php } ?>
				<?php $n++;}unset($n); ?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<?php if($n>1) { ?>
				<li class='ui-list-plus-item'><span class='num'><?php echo $n;?></span><a target='_blank' title='<?php echo $r['title'];?>' class='title' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a></li>
				<?php } ?>
				<?php $n++;}unset($n); ?>
			</ol>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<h2 class='game-title game-title-android'><a target='_blank' href="<?php echo url_change($CATEGORYS[307][url]);?>">安卓 试玩下载 &gt;&gt;</a></h2>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=1f328bc4e9a37b5c6bb35d53e3801504&action=position&posid=529&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'529','order'=>'listorder DESC','limit'=>'3',));}?>
			<ol class='ui-list-plus ui-ranking ui-ranking-game'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-list-plus-item'><span class='num <?php if($n==1) { ?>num-hot<?php } ?>'><?php echo $n;?></span><a target='_blank' title='<?php echo $r['title'];?>' class='title' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a><!--<span>1688</span>--></li>
				<?php $n++;}unset($n); ?>
			</ol>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<h2 class='game-title game-title-wp'><a target='_blank' href='<?php echo $CATEGORYS['314']['url'];?>'>WP 应用下载 &gt;&gt;</a></h2>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4d521968567222b0177e0c8c8e31b75e&action=position&posid=530&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'530','order'=>'listorder DESC','limit'=>'3',));}?>
			<ol class='ui-list-plus ui-ranking ui-ranking-game'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-list-plus-item'><span class='num <?php if($n==1) { ?>num-hot<?php } ?>'><?php echo $n;?></span><a target='_blank' title='<?php echo $r['title'];?>' class='title' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a><!--a class='name' href='#'>1688</a> --></li>
				<?php $n++;}unset($n); ?>
			</ol>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>

		<div class='ui-game-item ui-game-item-main fn-clear'>
			<div class='ui-header'>
				<h2 class='title'>热点资讯</h2>
				<!-- <div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>-->
			</div>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=27c2ca6869f660a4491df3fdb26e2a22&action=position&posid=532&thumb=1&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'532','thumb'=>'1','order'=>'listorder DESC','limit'=>'3',));}?>
			<ul class='ui-img-list'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-img-list-item'>
					<a target='_blank' class='img img-game' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],106,90);?>' width='106' height='90' /></a>
					<h4 class='title'><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a></h4>
				</li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=84c4f22590f106edcb2b9d31b57f08f9&action=position&posid=531&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'531','order'=>'listorder DESC','limit'=>'5',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php if($n==1) { ?>
			<h2 class='ui-newgame-title'><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a></h2>
			<?php } ?>
			<?php $n++;}unset($n); ?>
			<div class='ui-newgame-link'>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php if($n>1) { ?>
			<a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>">[<?php echo str_cut($r[title],35,'');?>]</a>
            <?php if($n==3) break;?>
            <?php } ?>
			<?php $n++;}unset($n); ?>
			</div>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e3dfd76cb7cb3be94709f06da552249e&action=lists&catid=251&order=updatetime+DESC&num=12\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'251','order'=>'updatetime DESC','limit'=>'12',));}?>
			<ul class='ui-list ui-list-main hr'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li <?php if($n==7) { ?> class='ui-list-item bk' <?php } else { ?>class='ui-list-item' <?php } ?>>
				<?php if($n==1 || $n==7) { ?>
				<strong><a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a></strong>
				<?php } else { ?>
				<a target='_blank' title='<?php echo $r['title'];?>' href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a>
				<?php } ?>
				</li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>

		<div class='ui-game-item ui-game-item-sub'>
			<div class='ui-header'>
				<h2 class='title'>推荐应用</h2>
				<!-- <div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>-->
			</div>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=5fc63ab4510cc1d1377af8dc991677a4&action=position&posid=533&thumb=1&order=listorder+DESC&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'533','thumb'=>'1','order'=>'listorder DESC','limit'=>'6',));}?>
			<ul class='ui-img-list ui-img-list-plus ahr'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],75,75);?>' width='75' height='75' /></a>
					<a target='_blank' title='<?php echo $r['title'];?>' class='title' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r[title],15,'');?></a>
				</li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<div class='ui-header'>
				<h2 class='title'>推荐壁纸</h2>
				<!-- <div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>-->
			</div>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=053d0dc6c9627e5961a221309411f33b&action=position&posid=534&thumb=1&order=listorder+DESC&num=2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'534','thumb'=>'1','order'=>'listorder DESC','limit'=>'2',));}?>
			<ul class='ui-img-list ui-img-list-plus ui-img-list-x'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],122,90);?>' width='122' height='90' /></a>
					<a target='_blank' title='<?php echo $r['title'];?>' class='title' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r[title],30,'');?></a>
				</li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>
	</div>

	<!-- 游戏图库 -->
	<div id='content-pic-game' class='ui-game fn-clear'>
		<div class='ui-game-header'>
			<h2 class='title'>游戏图库</h2>
			<div class='link'><?php $n=1;if(is_array(subcat(252,0,0,$siteid))) foreach(subcat(252,0,0,$siteid) AS $r) { ?><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo $r['catname'];?></a> | <?php $n++;}unset($n); ?><a class='more' href="<?php echo url_change($CATEGORYS[252][url]);?>" target='_blank'>进入图片频道&gt;&gt;</a></div>
		</div>

		<div class='ui-game-item ui-game-item-main fn-clear'>
			<div id='myfocus-kiki-index' class='ui-myfocus'>
				<div class="loading"></div>
				<div class="pic">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d12c43ad7a1299328a451b94f87e83a6&action=position&posid=535&thumb=1&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'535','thumb'=>'1','order'=>'listorder DESC','limit'=>'5',));}?>
					<ul>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li><a target='_blank' href="<?php echo url_change($r[url]);?>"><img src="<?php echo thumb($r[thumb],255,334);?>"  width='255' height='334' /></a></li>
						<?php $n++;}unset($n); ?>
					</ul>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
			</div>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=19f1ae57e33085e173d739c2b5185da8&action=position&posid=536&thumb=1&order=listorder+DESC&num=9\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'536','thumb'=>'1','order'=>'listorder DESC','limit'=>'9',));}?>
			<ul class='ui-img-list ui-img-list-plus'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],122,90);?>' width='122' height='90' /></a>
					<a target='_blank' title='<?php echo $r['title'];?>' class='title' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r[title],30,'');?></a>
				</li>
				<?php $n++;}unset($n); ?>

			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>

		<div class='ui-game-item ui-game-item-sub'>
			<div class='ui-header'>
				<h2 class='title'>热图排行</h2>
				<!-- <div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>-->
			</div>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7f5d94888ab2845b50977b0d174c2c83&action=lists&num=10&catid=252&order=id+DESC&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>'252','order'=>'id DESC',)).'7f5d94888ab2845b50977b0d174c2c83');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'252','order'=>'id DESC','limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
			<ol class='ui-list-plus'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				    <li class='ui-list-plus-item'><span class='num <?php if($n<4) { ?>num-hot<?php } ?>'><?php echo $n;?></span><a target='_blank' title='<?php echo $r['title'];?>' class='title' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r[title],60,'');?></a></li>
				<?php $n++;}unset($n); ?>
			</ol>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>
	</div>

	<script src='<?php echo JS_PATH;?>seajs/sea.js' id='seajsnode' data-main='hs-game-main'></script>
	<?php include template('content', 'hs_footer'); ?>
</body>
</html>