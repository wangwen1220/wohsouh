<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?> 火秀网</title>
	<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
	<meta name="description" content="<?php echo $SEO['description'];?>">
	<meta name='author' content='火秀网' />
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
	<link href='<?php echo CSS_PATH;?>hs-game-online.css' rel='stylesheet' />
	<link href='http://www.huoshow.com/favicon.ico' rel='icon' />
</head>

<body class='game-online'>
	<?php include template('content', 'hs_topbar'); ?>
	<?php include template('content', 'game_header_product'); ?>

	<div class='ui-layout ad'><a href='#' target='_blank'><img src='http://pnews.huoshow.com/statics/images/common/middle_anner.png' width='960' height='60' /></a></div>

	<!-- 游戏列表 -->
	<div id='game-tab' class='ui-layout ui-layout-box ui-tab'>
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
			<div class='link'><a href="<?php echo url_change($CATEGORYS[257][url]);?>" target='_blank'>测试表</a> <a href="<?php echo url_change($CATEGORYS[258][url]);?>" target='_blank'>找游戏</a></div>
		</div>
		<div class='ui-tab-cnt'>
			<ul class='ui-tab-cnt-item ui-game-list ui-tab-cnt-item-cur'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=f816b0c0c4fbb45ce9fe8aa929c219ae&action=get_special_pos&posid=1&order=inputtime+DESC&limit=120\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'1','order'=>'inputtime DESC','limit'=>'20',));}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php echo $r['special_name'];?></a></li>
					<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
			<ul class='ui-tab-cnt-item ui-game-list'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=754a90c4881ce711fba415ae557fb652&action=get_see_letter_list&catid=%24catid&worda=a&wordb=b&wordc=c&wordd=d&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>$catid,'worda'=>'a','wordb'=>'b','wordc'=>'c','wordd'=>'d','limit'=>'60',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php echo str_cut($r['title'],20,'');?></a></li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
			<ul class='ui-tab-cnt-item ui-game-list'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=51becfbc8d3edc53820cb018c1d2d2a9&action=get_see_letter_list&catid=%24catid&worda=e&wordb=f&wordc=g&wordd=h&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>$catid,'worda'=>'e','wordb'=>'f','wordc'=>'g','wordd'=>'h','limit'=>'60',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php echo str_cut($r['title'],20,'');?></a></li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
			<ul class='ui-tab-cnt-item ui-game-list'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=e00d5b6b17ac3554ee87bea622ec635c&action=get_see_letter_list&catid=%24catid&worda=i&wordb=j&wordc=k&wordd=l&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>$catid,'worda'=>'i','wordb'=>'j','wordc'=>'k','wordd'=>'l','limit'=>'60',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php echo str_cut($r['title'],20,'');?></a></li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
			<ul class='ui-tab-cnt-item ui-game-list'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=212a16e8b3edc4c4887cfc60384f74de&action=get_see_letter_list&catid=%24catid&worda=m&wordb=n&wordc=o&wordd=p&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>$catid,'worda'=>'m','wordb'=>'n','wordc'=>'o','wordd'=>'p','limit'=>'60',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php echo str_cut($r['title'],20,'');?></a></li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
			<ul class='ui-tab-cnt-item ui-game-list'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=358b5629e685a3f4e1b86bdde1e276f6&action=get_see_letter_list&catid=%24catid&worda=q&wordb=r&wordc=s&wordd=t&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>$catid,'worda'=>'q','wordb'=>'r','wordc'=>'s','wordd'=>'t','limit'=>'60',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php echo str_cut($r['title'],20,'');?></a></li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
			<ul class='ui-tab-cnt-item ui-game-list'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=7e1e31e8d429e9b7b52df0ae4ea6a4da&action=get_see_letter_list&catid=%24catid&worda=w&wordb=x&wordc=y&wordd=z&num=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_see_letter_list')) {$data = $special_tag->get_see_letter_list(array('catid'=>$catid,'worda'=>'w','wordb'=>'x','wordc'=>'y','wordd'=>'z','limit'=>'60',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php echo str_cut($r['title'],20,'');?></a></li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
			<ul class='ui-tab-cnt-item ui-game-list'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=1a7c5aed67b229fbf5aa045233421071&action=get_special_pos&posid=2&order=inputtime+DESC&num=120\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'2','order'=>'inputtime DESC','limit'=>'120',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<li class='ui-game-list-item'><a href='<?php echo $r['url'];?>' target='_blank'><?php echo str_cut($r['special_name'],20,'');?></a></li>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>
	</div>

	<!-- 主内容 -->
	<div id='content-main' class='ui-layout fn-clear'>
		<div class='ui-layout-item ui-layout-item-left'>
			<div id='myfocus-games' class='ui-myfocus'><!--焦点图盒子-->
				<div class="loading"></div><!--载入画面(可删除)-->
				<div class="pic"><!--图片列表-->
					<ul>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=90e71bbca5b182a2443598584d15159c&action=position&posid=425&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'425','order'=>'listorder DESC','limit'=>'5',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li><a href="<?php echo url_change($r[url]);?>" target='_blank'><img src="<?php echo thumb($r[thumb],308,231);?>"  alt="<?php echo $r['title'];?>"  width='308' height='231' /></a></li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</div>
			</div>
			<div class='ui-box'>
				<div class='ui-header'>
					<h3 class='title'>热门网游</h3>
					<div class='link'>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=0a7c8ed9c2f54fde7398767a2edeca7d&action=position&posid=426&order=listorder+DESC&num=2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'426','order'=>'listorder DESC','limit'=>'2',));}?>
   					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],16,'');?></a> |
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
				</div>
				<ul class='ui-img-list'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b838db76005f3499453d2995ffd0c173&action=position&posid=427&order=listorder+DESC&num=2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'427','order'=>'listorder DESC','limit'=>'2',));}?>
   				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-img-list-item'>
						<a class='img' href="<?php echo url_change($r[url]);?>" target='_blank'><img src='<?php echo thumb($r[thumb],138,103);?>' width='138' height='103'/></a>
						<!-- <div class='desc'>
							<h4><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],20,'');?></a></h4>
							<p><?php echo str_cut($r['description'],40,'');?></p>
						</div> -->
					</li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ul>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ad790ec93ff06b324b4fc24b8c6a227a&action=position&posid=428&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'428','order'=>'listorder DESC','limit'=>'5',));}?>
   				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<?php if($n==1) { ?>
				<h3 class='atitle'><?php echo str_cut($r['title'],60,'');?></h3>
				<?php } else { ?>
				<?php if($n==2) { ?><ul class='ui-list fn-clear hr'><?php } ?>
					<li class='ui-list-item'><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],30,'');?></a></li>
				<?php if($n==5) { ?></ul><?php } ?>
				<?php } ?>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				<!--<form class='search' name='' action=''>
					<fieldset>
						<span>数据库：</span>
						<select>
							<option>神仙传</option>
							<option>巫师之怒</option>
							<option>跑跑卡丁车</option>
						</select>
						<input type='text' class='search-wd' value='请输入关键字' /><button type='submit' class='search-submit'>搜索</button>
					</fieldset>
				</form>-->
				<form id="search-form" class='search' name="" method="get" action="<?php echo APP_PATH;?>index.php" target="_blank">			<span>数据库：</span>
					<input type="hidden" value="search" name="app" />
					<input type="hidden" name="m" value="search" />
					<input type="hidden" name="c" value="index" />
					<input type="hidden" name="a" value="init" />
					<input type="hidden" name="typeid" value="1" id="typeid" /><!-- 搜索类型 -->
					<input type='text' name='q' class='search-wd' value='搜索新闻' /><button type='submit' class='search-submit'>搜索</button>
				</form>
			</div>
		</div>

		<div class='ui-layout-item ui-layout-item-center'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=9793ad77f19856b167aaa3812834a6da&action=position&posid=421&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'421','order'=>'listorder DESC','limit'=>'3',));}?>
   			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php if($n==1) { ?>
			<h2 class='ui-newgame-title'><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],56,'');?></a></h2>
			<?php } else { ?>
			<?php if($n==2) { ?><div class='ui-newgame-link'><?php } ?><a href="<?php echo url_change($r[url]);?>" target='_blank'>[<?php echo str_cut($r['title'],38,'');?>]</a><?php if($n==3 ) { ?></div><?php } ?>
            <?php } ?>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=1cac5c53d17819a78ea39ff7a49dc8d1&action=position&posid=422&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'422','order'=>'listorder DESC','limit'=>'3',));}?>
   			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php if($n==1) { ?>
			<h2 class='ui-newgame-title'><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],60,'');?></a></h2>
			<?php } else { ?>
			<?php if($n==2) { ?><div class='ui-newgame-link'><?php } ?><a href="<?php echo url_change($r[url]);?>" target='_blank'>[<?php echo str_cut($r['title'],38,'');?>]</a><?php if($n==3) { ?></div><?php } ?>
			<?php } ?>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7ab8101691ac6803676934688d361521&action=position&posid=423&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'423','order'=>'listorder DESC','limit'=>'3',));}?>
   			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php if($n==1) { ?>
			<h2 class='ui-newgame-title'><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],60,'');?></a></h2>
			<?php } else { ?>
			<?php if($n==2) { ?><div class='ui-newgame-link'><?php } ?><a href="<?php echo url_change($r[url]);?>" target='_blank'>[<?php echo str_cut($r['title'],38,'');?>]</a><?php if($n==3) { ?></div><?php } ?>
			<?php } ?>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<ul class='ui-list ui-list-main hr'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=74f7a25fe510e459058a166a250dbb08&action=position&posid=424&order=listorder+DESC&num=15\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'424','order'=>'listorder DESC','limit'=>'15',));}?>
   			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-list-item <?php if($n%6==0 || $n==1) { ?>bk<?php } ?>'><a href="<?php echo url_change($CATEGORYS[$r[catid]][url]);?>" target='_blank'><?php echo getCatNameFromCatid($r[catid]);?></a> | <?php if($n%6==0 || $n==1) { ?><strong><?php } ?><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],55,'');?></a><?php if($n%6==0 || $n==1) { ?></strong><?php } ?></li>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
		</div>

		<div class='ui-layout-item ui-layout-item-right'>
			<div class='ad'><a href='#' target='_blank'><img src='http://i3.17173.itc.cn/2012/newgame/bigeyes/c1110hg04.jpg' alt='' width='240' height='206' /></a></div>
			<div class='ui-box-lite'>
				<div class='ui-box-lite-header'>
					<h3 class='title'><!-- 网游视频 -->热门新闻</h3>
					<div class='link'><!--<a class='more' href='#'>更多&gt;&gt;</a>--></div>
				</div>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=93b807376bdc4544da48c00ccd948675&action=position&posid=429&order=listorder+DESC&num=7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'429','order'=>'listorder DESC','limit'=>'7',));}?>
   				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<?php if($n<=4) { ?>
				<?php if($n==1) { ?><ul class='ui-img-list'><?php } ?>
					<li class='ui-img-list-item'>
						<a class='img' href="<?php echo url_change($r[url]);?>" target='_blank'><img src="<?php echo thumb($r[thumb],102,76);?>" width='102' height='76'/></a>
						<h4 class='title'><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],50,'');?></a></h4>
					</li>
				<?php if($n==4) { ?></ul><?php } ?>
				<?php } else { ?>
				<?php if($n==5) { ?><ul class='ui-list'><?php } ?>
					<li class='ui-list-item'><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],60,'');?></a></li>
				<?php if($n==7) { ?></ul><?php } ?>
				<?php } ?>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

			</div>
		</div>
	</div>

	<!-- 攻略专区 -->
	<div id='content-glzq' class='ui-box fn-clear'>
		<div class='ui-box-header'>
			<h2 class='title'>攻略专区</h2>
			<div class='link'>
			<?php $n=1;if(is_array(subcat(254,0,0,$siteid))) foreach(subcat(254,0,0,$siteid) AS $r) { ?>
				<?php $num++?>
				<?php if($r[catid]!=264) { ?><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo $r['catname'];?> </a> |<?php } ?>
			<?php $n++;}unset($n); ?><a class='more' href="<?php echo url_change($CATEGORYS[254][url]);?>" target='_blank'>更多&gt;&gt;</a></div>
		</div>

		<div class='ui-box-item ui-box-item-left'>
			<div id='myfocus-qiyi' class='ui-myfocus'>
				<div class="loading"></div>
				<div class="pic">
					<ul>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=271f5621a50d9ef930bb97d81f0f90bb&action=position&posid=430&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'430','order'=>'listorder DESC','limit'=>'5',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li><a href="<?php echo url_change($r[url]);?>" target='_blank'><img src="<?php echo thumb($r[thumb],288,200);?>" alt="<?php echo $r['title'];?>" text='' width='288' height='200' /></a></li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</div>
			</div>
			<ul class='ui-list ui-list-main'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=6520d9f51a8ecbbe10e6dcdd3c28f6ab&action=position&posid=431&order=listorder+DESC&num=9\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'431','order'=>'listorder DESC','limit'=>'9',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-list-item <?php if($n==5) { ?>hr<?php } ?>'><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],60,'');?></a></li>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
		</div>

		<div class='ui-box-item ui-box-item-center'>
			<h2 class='ui-newgame-title'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e023bbbdd72a5449d73695648563bbfc&action=position&posid=432&order=listorder+DESC&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'432','order'=>'listorder DESC','limit'=>'1',));}?>
   			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],60,'');?></a>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</h2>
			<ul class='ui-list ui-list-main hr-bottom'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=526cb27a97cfc96cb9f54b3245839a81&action=lists&catid=254&order=id+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'254','order'=>'id DESC','limit'=>'10',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-list-item <?php if($n==1 || $n==6) { ?>bk<?php } ?>'><a href="<?php echo url_change($CATEGORYS[$r[catid]][url]);?>" target='_blank'><?php echo $CATEGORYS[$r['catid']]['catname'];?></a> | <?php if($n==1 || $n==6) { ?><strong><?php } ?><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],60,'');?></a><?php if($n==1 || $n==6) { ?></strong><?php } ?></li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
			<div class='ui-header'>
				<h2 class='title'>推荐专区</h2>
				<div class='link'><!--<a href='#'>更多&gt;&gt;</a>--></div>
			</div>
			<ul class='ui-img-list'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=1106cc1685dbd59e9a8318784b6bc50e&action=get_special_pos&posid=40&order=inputtime+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'40','order'=>'inputtime DESC','limit'=>'3',));}?>
   			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-img-list-item'>
					<a class='img' href="<?php echo url_change($r[url]);?>" target='_blank'><img src='<?php echo thumb($r[thumb],104,104);?>' width='104' height='104'/></a>
					<h4 class='title'><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo $r['special_name'];?></a></h4>
				</li>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
		</div>

		<div class='ui-box-item ui-box-item-right'>
			<div class='ui-header'>
				<h2 class='title'>精华攻略</h2>
				<div class='link'><!--<a class='more' href='#'>更多&gt;&gt;</a>--></div>
			</div>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=665145950831b06d1e729148ebb827c5&action=position&posid=434&order=listorder+DESC&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'434','order'=>'listorder DESC','limit'=>'6',));}?>
   			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php if($n==1) { ?>
			<div class='ui-img'>
				<a class='img' href="<?php echo url_change($r[url]);?>" target='_blank'><img src='<?php echo thumb($r[thumb],216,108);?>' alt='' width='216' height='108' /></a>
				<h4 class='title'><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],40,'');?></a></h4>
			</div>
			<?php } else { ?>
			<?php if($n==2) { ?><ul class='ui-list'><?php } ?>
				<li class='ui-list-item'><a href="<?php echo url_change($r[url]);?>" target='_blank'> <?php echo str_cut($r['title'],60,'');?></a></li>
			<?php if($n==6) { ?></ul><?php } ?>
			<?php } ?>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<div class='ad'>
				<a href='#' target='_blank'><img src='http://i3.17173.itc.cn/2012/newgame/bigeyes/c1110hg04.jpg' alt='' width='238' height='220' /></a>
			</div>
		</div>
	</div>

	<div class='ui-layout ad'>
		<a href='#' target='_blank'><img src='http://pnews.huoshow.com/statics/images/common/middle_anner.png' alt='' width='960' height='60' /></a>
	</div>

	<!-- 网游资讯 -->
	<div id='content-wyzx' class='ui-box fn-clear'>
		<div class='ui-box-header'>
			<h2 class='title'>网游资讯</h2>
			<div class='link'><?php $n=1;if(is_array(subcat(253,0,0,$siteid))) foreach(subcat(253,0,0,$siteid) AS $r) { ?>
                    <?php $num++?>
                    <a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo $r['catname'];?> </a> |
               		<?php $n++;}unset($n); ?><a class='more' href="<?php echo url_change($CATEGORYS[253][url]);?>" target='_blank'>更多&gt;&gt;</a></div>
		</div>

		<div class='ui-box-item ui-box-item-left'>
			<div class='ui-header'>
				<h2 class='title'>产业新闻</h2>
			</div>
			<div class="ui-art-list-box">
				<ul id='js-scroll-news' class='ui-art-list'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e6cc9a904e2c98626e95bcb56b87e9c4&action=lists&catid=260&order=id+DESC&num=20\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'260','order'=>'id DESC','limit'=>'20',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-art-item'>
						<a class='img' href="<?php echo url_change($r[url]);?>" target='_blank'><img src='<?php echo thumb($r[thumb],90,66);?>' alt='<?php echo $r['title'];?>' width='90' height='66' /></a>
						<h3 class='title'><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],40,'');?></a></h3>
						<p class="content"<a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['description'],70,'');?></a><a class='more' href="<?php echo url_change($r[url]);?>" target='_blank'>[详情]</a></p>
					</li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ul>
			</div>
		</div>

		<div class='ui-box-item ui-box-item-center'>
			<div class='ui-header ui-header-hr'>
				<h2 class='title'>国内网游动态</h2>
				<div class='link'><a class='more' href="<?php echo url_change($CATEGORYS[261][url]);?>" target='_blank'>更多&gt;&gt;</a></div>
			</div>
			<h2 class='ui-newgame-title'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=9b9586641b8256807ca65f930d848258&action=position&posid=435&order=listorder+DESC&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'435','order'=>'listorder DESC','limit'=>'1',));}?>
   			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],50,'');?></a>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</h2>
			<ul class='ui-list ui-list-main'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=5216ae46dffa5a4dfc90b54ebe163f0b&action=lists&catid=261&order=id+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'261','order'=>'id DESC','limit'=>'5',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-list-item'><a href="<?php echo url_change($CATEGORYS[$r[catid]][url]);?>" target='_blank'><?php echo getCatNameFromCatid($r[catid]);?></a> | <a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],75,'');?></a></li>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>

			<div class='ui-header ui-header-hr'>
				<h2 class='title'>全球网游动态</h2>
				<div class='link'><a class='more' href="<?php echo url_change($CATEGORYS[262][url]);?>" target='_blank'>更多&gt;&gt;</a></div>
			</div>
			<h2 class='ui-newgame-title'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a048d45a4e723a64bb98f66e3076730c&action=position&posid=436&order=listorder+DESC&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'436','order'=>'listorder DESC','limit'=>'1',));}?>
   			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],50,'');?></a>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</h2>
			<ul class='ui-list ui-list-main'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4741b01b7712e63e2e98b6eeeb532e8b&action=lists&catid=262&order=id+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'262','order'=>'id DESC','limit'=>'5',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-list-item'><a href="<?php echo url_change($CATEGORYS[$r[catid]][url]);?>" target='_blank'><?php echo getCatNameFromCatid($r[catid]);?></a> | <a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],75,'');?></a></li>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
		</div>

		<div class='ui-box-item ui-box-item-right'>
			<div class='ui-header'>
				<h2 class='title'>热点资讯排行</h2>
			</div>
			<ul class='ui-ranking'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=c978022c85a65bff26ca42bb65bb7676&action=hits&catid=247&num=10&order=views+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'247','order'=>'views DESC','limit'=>'10',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-ranking-item <?php if($n==1) { ?>ui-ranking-item-cur<?php } ?>'>
					<a class='img' href="<?php echo url_change($r[url]);?>" target='_blank'><img src='<?php echo thumb($r[thumb],88,66);?>' alt='<?php echo $r['title'];?>' width='88' height='66' /></a>
					<span class='num <?php if($n<4) { ?>num-hot<?php } ?>'><?php echo $n;?></span>
					<h3 class='title'><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],40,'');?></a></h3>
					<p class="content"><?php echo str_cut($r['description'],28,'');?><a class='more' href="<?php echo url_change($r[url]);?>" target='_blank'>[详情]</a></p>
				</li>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
		</div>
	</div>

	<!-- 网游大观 -->
	<div id='content-wydg' class='ui-box ui-box-gallery fn-clear'>
		<div class='ui-box-header'>
			<h2 class='title'>网游大观</h2>
			<div class='link'><?php $n=1;if(is_array(subcat(255,0,0,$siteid))) foreach(subcat(255,0,0,$siteid) AS $r) { ?>
                    <?php $num++?>
                    <a href="<?php echo url_change($r[url]);?>" target="_blank"><?php echo $r['catname'];?></a> |
                    <?php $n++;}unset($n); ?> <a class='more' href="<?php echo url_change($CATEGORYS[255][url]);?>" target="_blank">更多&gt;&gt;</a></div>
		</div>

		<div class='ui-box-item ui-box-item-left'>
			<div class='ui-header'>
				<h2 class='title'>搞笑囧图</h2>
				<div class='link'><a class='more' href="<?php echo url_change($CATEGORYS[265][url]);?>" target='_blank'>更多&gt;&gt;</a></div>
			</div>
			<ul class='ui-img-box'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=79170fb1adb5953edd227c92dcade08e&action=picmorecatids&catids=265%2C267%2C269&newsnum=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'picmorecatids')) {$data = $content_tag->picmorecatids(array('catids'=>'265,267,269','newsnum'=>'6','limit'=>'20',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-img'>
					<a class='img' href="<?php echo url_change($r[url]);?>" target='_blank'><img src='<?php echo thumb($r[thumb],138,105);?>' alt='<?php echo $r['title'];?>' width='138' height='105' /></a>
					<h4 class='title'><a href="<?php echo url_change($r[url]);?>" target='_blank'> <?php echo str_cut($r['title'],40,'');?></a></h4>
				</li>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
		</div>

		<div class='ui-box-item ui-box-item-center'>
			<div class='ui-header'>
				<h2 class='title'>八卦图片</h2>
				<div class='link'><a href="<?php echo url_change($CATEGORYS[266][url]);?>" target='_blank'>非主流自拍</a> | <a class='more' href="<?php echo url_change($CATEGORYS[255][url]);?>" target='_blank'>更多&gt;&gt;</a></div>
			</div>
			<ul class='ui-img-list'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=51a71d0b01626bc5784eefe2b86c051b&action=picmorecatids&catids=266%2C268&newsnum=9\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'picmorecatids')) {$data = $content_tag->picmorecatids(array('catids'=>'266,268','newsnum'=>'9','limit'=>'20',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-img-list-item'>
					<a class='img' href="<?php echo url_change($r[url]);?>" target='_blank'><img src='<?php echo thumb($r[thumb],110,84);?>' width='110' height='84'/></a>
					<h4 class='title'><a href="<?php echo url_change($r[url]);?>" target='_blank'> <?php echo str_cut($r['title'],30,'');?></a></h4>
				</li>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
		</div>

		<div class='ui-box-item ui-box-item-right'>
			<div class='ui-header'>
				<h2 class='title'>焦点回顾</h2>
				<div class='link'><!--<a class='more' href='#'>更多&gt;&gt;</a>--></div>
			</div>
			<ul class='ui-img-list'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=94002bac9aa30902a35a4635aad4f311&action=picmorecatids&catids=268%2C269&newsnum=6&order=updatetime+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'picmorecatids')) {$data = $content_tag->picmorecatids(array('catids'=>'268,269','newsnum'=>'6','order'=>'updatetime DESC','limit'=>'20',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-img-list-item'>
					<a class='img' href="<?php echo url_change($r[url]);?>" target='_blank'><img src='<?php echo thumb($r[thumb],104,78);?>' width='104' height='78'/></a>
					<h4 class='title'><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],20,'');?></a></h4>
				</li>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
		</div>
	</div>

	<script src='<?php echo JS_PATH;?>seajs/sea.js' id='seajsnode' data-main='hs-game-main'></script>
	<?php include template('content', 'hs_footer'); ?>
</body>
</html>