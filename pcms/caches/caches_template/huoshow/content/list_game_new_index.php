<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?> 火秀网</title>
	<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
	<meta name="description" content="<?php echo $SEO['description'];?>">
	<meta name='author' content='火秀网' />
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
	<link href='<?php echo CSS_PATH;?>hs-game-global.css' rel='stylesheet' />
	<link href='http://www.huoshow.com/favicon.ico' rel='icon' />
</head>

<body class='game-newgame game-gallery'>

	<?php include template('content', 'hs_topbar'); ?>
	<?php include template('content', 'game_header_newgame'); ?>

	<div id='content'>
		<div class='ad'>
			<a href='#'><img src='http://pnews.huoshow.com/statics/images/common/middle_anner.png' alt='' width='960' height='60' /></a>
		</div>
		<!-- 主内容 -->
		<div id='main'>
			<div class='ui-content-box'>
				<div class='ui-content-list'>
				<?php if($catid ==293) { ?>		<!--//网络游戏-->
					<?php $cat_cid = 247;?>
				<?php } elseif ($catid ==294) { ?>	<!--//单机游戏-->
					<?php $cat_cid = 249;?>
				<?php } elseif ($catid ==295) { ?>	<!--//网页游戏-->
					<?php $cat_cid = 248;?>
				<?php } elseif ($catid ==296) { ?>	<!--//游戏图库-->
					<?php $cat_cid = 252;?>
				<?php } elseif ($catid ==297) { ?>	<!--//评测-->
					<?php $cat_cid = 259;?>
				<?php } elseif ($catid ==298) { ?>	<!--//手机游戏-->
					<?php $cat_cid = 251;?>
				<?php } ?>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=436ad705843f4efe29b1914c1a8f1565&action=lists&catid=%24cat_cid&num=13&order=id+DESC&page=%24page\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 13;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$cat_cid,'order'=>'id DESC','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$data = $content_tag->lists(array('catid'=>$cat_cid,'order'=>'id DESC','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
		        <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<div class='ui-content-item'>
						<a target="_blank" class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],138,103);?>' alt='<?php echo $r['title'];?>' width='138' height='103' /></a>
						<h2 class='title'><a href="<?php echo url_change($r[url]);?>" target="_blank"><?php echo $r['title'];?></a></h2>
						<div class='info'><em><?php echo $CATEGORYS[$r['catid']]['catname'];?></em> 发表时间：<?php echo date($r['inputtime']);?></div>
						<p class='cnt'><?php echo str_cut($r['description'],200,'');?><a class='detail' href='<?php echo url_change($r[url]);?>' target="_blank">[详细]</a></p>
					</div>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
				<div id='pager' class="pager ui-pager"><?php echo $pages;?></div>
			</div>
		</div>

		<div id='side'>
			<div class='ui-box-side ui-box-rdtj'>
				<h2 class='ui-box-side-title'>热点推荐</h2>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b1eef1aaa456147d9504d086a080d80f&action=rand_news_hothits&catids=260%2C261%2C262%2C263%2C257%2C258%2C259%2C272%2C291%2C286%2C304%2C310%2C311%2C313&newsnum=12\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'rand_news_hothits')) {$data = $content_tag->rand_news_hothits(array('catids'=>'260,261,262,263,257,258,259,272,291,286,304,310,311,313','newsnum'=>'12','limit'=>'20',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<?php if($n==1 || $n==7) { ?>
				<h3 class='subtitle'><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],70,'');?></a></h3>
				<?php } else { ?>
				<?php if($n==2) { ?><ul class='ui-list'><?php } ?>
					<li class='ui-list-item'><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],70,'');?></a></li>
				<?php if($n==12) { ?></ul><?php } ?>
				<?php } ?>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>

			<div class='ad'><a href='#'><img src='http://i3.17173.itc.cn/2012/newgame/bigeyes/c1110hg04.jpg' alt='' width='280' height='248' /></a></div>

			<div class='ui-box-side ui-box-xyx'>
				<h2 class='ui-box-side-title'>新游戏</h2>
				<ul class='ui-img-list ui-img-list-plus'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=d3818e0167710451dacdded5234beb93&action=get_special_pos&posid=15&order=inputtime+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'15','order'=>'inputtime DESC','limit'=>'3',));}?>
   				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-img-list-item'>
						<a class='img' href="<?php echo $r['url'];?>"  target="_blank"><img src='<?php echo thumb($r[thumb],73,73);?>' width='73' height='73' /></a>
						<a class='title' href="<?php echo $r['url'];?>"  target="_blank"><?php echo $r['special_name'];?></a>
					</li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ul>
				<ul class='ui-list ui-list-float hr'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=4f652fb289e3c86bcbd5277648d2785b&action=get_special_pos&posid=43&order=inputtime+DESC&num=24\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'43','order'=>'inputtime DESC','limit'=>'24',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-list-item'><a href="<?php echo $r['url'];?>"  target="_blank"><?php echo $r['special_name'];?></a></li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ul>
			</div>

			<div class='ui-box-side ui-box-sptj'>
				<h2 class='ui-box-side-title'><!--视频推荐-->推荐新闻</h2>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a5e262be4bf969582c523a08a9224a73&action=position&posid=484&order=listorder+DESC&num=7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'484','order'=>'listorder DESC','limit'=>'7',));}?>
   				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<?php if($n<3) { ?>
				<?php if($n==1) { ?><ul class='ui-img-list ui-img-list-plus'><?php } ?>
					<li class='ui-img-list-item'>
						<a class='img' href="<?php echo url_change($r[url]);?>" target='_blank'><img src='<?php echo thumb($r[thumb],122,91);?>' width='122' height='91' /></a>
						<a class='title' href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],40,'');?></a>
					</li>
				<?php if($n==2) { ?></ul><?php } ?>
				<?php } else { ?>
				<?php if($n==3) { ?><ul class='ui-list ui-list-float'><?php } ?>
				<li class='ui-list-item'><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],60,'');?></a></li>
				<?php if($n==7) { ?></ul><?php } ?>
				<?php } ?>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>

			<div class='ui-box-side ui-box-wydg'>
				<h2 class='ui-box-side-title'>网游大观</h2>
				<ul class='ui-img-list ui-img-list-plus'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4fa9544aa96261dcdce02e7f9f6fa160&action=position&posid=485&order=listorder+DESC&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'485','order'=>'listorder DESC','limit'=>'6',));}?>
   				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-img-list-item'>
						<a class='img' href="<?php echo url_change($r[url]);?>" target='_blank'><img src='<?php echo thumb($r[thumb],122,91);?>' width='122' height='91' /></a>
						<a style="text-align:left;" class='title' href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],80,'');?></a>
					</li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ul>
			</div>

			<div class='ui-box-side ui-box-zxphb'>
				<h2 class='ui-box-side-title'>资讯排行榜</h2>
				<ol class='ui-list-plus'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=43db320c2636e18d094d7009fcb6f0b0&action=rand_news_hothits&catids=253%2C263%2C272%2C286%2C304%2C310%2C311%2C313&newsnum=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'rand_news_hothits')) {$data = $content_tag->rand_news_hothits(array('catids'=>'253,263,272,286,304,310,311,313','newsnum'=>'10','limit'=>'20',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-list-plus-item'><span class='num num-hot'><?php echo $n;?></span><a class='title' href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],60,'');?></a></li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ol>
			</div>
		</div>
	</div>

	<script src='<?php echo JS_PATH;?>seajs/sea.js' id='seajsnode' data-main='hs-game-main'></script>
	<?php include template('content', 'hs_footer'); ?>
</body>
</html>