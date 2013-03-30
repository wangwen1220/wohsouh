<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE HTML>
<html>
<head>
	<meta charset='utf-8' />
	<title>火秀网 - 中国娱乐门户,我秀我火!我火我秀!</title>
	<meta name='keywords' content='娱乐网站,娱乐门户,娱乐新闻,赛事直播,明星八卦,音乐网站,游戏,火秀网' />
	<meta name='description' content='火秀网致力打造国内最专业娱乐门户网站,以报道时下最 新内地、港台、日韩、欧美娱乐新闻和游戏资讯,涵盖电影、电视、音乐、游戏、视频、图片、明星、演 艺、原创及翻唱集中展示、个人博客、论坛等娱乐相关领域,结合多种娱乐与互动为主题的功能与应用,结 合线上线下活动,是年轻时尚的各类达人在线互动的娱乐门户平台。' />
	<meta name='author' content='火秀网' />
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
	<link href='<?php echo CSS_PATH;?>base.css?v=20130220' rel='stylesheet' />
	<link href='<?php echo CSS_PATH;?>hs-global.css?v=20130223' rel='stylesheet' />
	<link href='<?php echo CSS_PATH;?>hs-index.css?v=201300308' rel='stylesheet' />
	<link href='/favicon.ico' rel='icon' />
	<?php if($index_page==1) echo "<base target='_blank' />";?>
</head>

<body>
	<?php include template('content', 'hs_topbar'); ?>

	<!-- Header -->
	<div id='header' class='fn-clear'>
		<a class='logo' href='http://www.huoshow.com/' title='火秀网'><img src='/statics/images/home/logo-home.png' alt='火秀网' width='200' height='35' /></a>
		<ul id='nav' class='fn_right'>
		<li class='first'>
			<a href='<?php echo $CATEGORYS['11']['url'];?>'><strong>明星</strong></a>
			<!-- <a href='<?php echo $CATEGORYS['39']['url'];?>'>视频</a> -->
			<a href='<?php echo $CATEGORYS['38']['url'];?>'>图集</a>
			<a href='<?php echo $CATEGORYS['34']['url'];?>'>八卦</a>
			<a href='<?php echo $CATEGORYS['34']['url'];?>'>内地</a>
			<br />
			<a href='<?php echo url_change($CATEGORYS[246][url]);?>'><strong>游戏</strong></a>
			<a href='<?php echo url_change($CATEGORYS[247][url]);?>'>网游</a>
			<a href='<?php echo url_change($CATEGORYS[249][url]);?>'>单机</a>
			<a href='<?php echo url_change($CATEGORYS[251][url]);?>'>手机</a>
		</li>
		<li>
			<a href='<?php echo $CATEGORYS['12']['url'];?>'><strong>电影</strong></a>
			<!--<a href='<?php echo $CATEGORYS['141']['url'];?>'>预告</a> -->
			<a href='<?php echo $CATEGORYS['69']['url'];?>'>剧照</a>
			<a href='<?php echo $CATEGORYS['135']['url'];?>'>专访</a>
			<a href='<?php echo $CATEGORYS['64']['url'];?>'>华语</a>
			<br />
			<a href='<?php echo $CATEGORYS['109']['url'];?>'><strong>超模</strong></a>
			<a href='<?php echo $CATEGORYS['111']['url'];?>'>大赛</a>
			<a href='<?php echo $CATEGORYS['114']['url'];?>'>写真</a>
			<a href='<?php echo $CATEGORYS['112']['url'];?>'>名模</a>
		</li>
		<li>
			<a href='<?php echo $CATEGORYS['131']['url'];?>'><strong>电视</strong></a>
			<a href='<?php echo $CATEGORYS['147']['url'];?>'>综艺</a>
			<!--<a href='<?php echo $CATEGORYS['148']['url'];?>'>片花</a>-->
			<a href='<?php echo $CATEGORYS['236']['url'];?>'>热播</a>
			<a href='<?php echo $CATEGORYS['144']['url'];?>'>港台</a>
			<br />
			<a href='http://myshow.huoshow.com/'><strong>我秀</strong></a>
			<a href='http://myshow.huoshow.com/fxgc.html'>广场</a>
			<a href='http://myshow.huoshow.com/dr.html'>达人</a>
			<a href='http://myshow.huoshow.com/gw.html'>购物</a>
			<!--a href='http://space.huoshow.com/home.php?mod=space&do=myshow&view=all'><strong>MY秀</strong></a>
			<a href='http://space.huoshow.com/home.php?mod=space&do=myshow&view=all&type=2'>视频</a>
			<a href='http://space.huoshow.com/home.php?mod=space&do=myshow&view=all&type=1'>音频</a-->
		</li>
		<li>
			<a href='<?php echo $CATEGORYS['13']['url'];?>'><strong>音乐</strong></a>
			<!--<a href='<?php echo $CATEGORYS['78']['url'];?>'>MV</a>-->
			<a href='<?php echo $CATEGORYS['73']['url'];?>'>试听</a>
			<a href='<?php echo $CATEGORYS['81']['url'];?>'>碟报</a>
			<br />
			<a href='<?php echo $CATEGORYS['10']['url'];?>'><strong>美图</strong></a>
			<a href='http://bbs.huoshow.com/forum-66-1.html'>相册</a>
			<!--<a href='http://bbs.huoshow.com/'><strong>论坛</strong></a>
			<a href='http://space.huoshow.com/home.php'>微博</a>-->
		</li>
		<li>
			<a href='<?php echo $CATEGORYS['9']['url'];?>'><strong>赛事</strong></a>
			<a href='<?php echo $CATEGORYS['17']['url'];?>'>日程</a>
			<a href='<?php echo $CATEGORYS['16']['url'];?>'>排行</a>
			<a href='<?php echo $CATEGORYS['15']['url'];?>'>快报</a>
			<br />
			<a></a>
			<a></a>
		</li>
	</ul>
	</div>
	<!-- Header End -->

	<!-- Search bar -->
	<div id='search-bar'>
		<div class='wrapper fn-clear'>
			<div id='weather' class='fn_left'></div>
			<div id='search'>
				<form id='search-form' class='search-form' name='search' method='get' action='<?php echo APP_PATH;?>index.php' target='_blank'>
					<input type='hidden' value='search' name='app' />
					<input type='hidden' value='index' name='controller' />
					<input type='hidden' value='search' name='action' />
					<input type='hidden' name='m' value='search' />
					<input type='hidden' name='c' value='index' />
					<input type='hidden' name='a' value='init' />
					<input type='hidden' name='typeid' value='1' id='typeid' />
					<label for='search-wd'>站内搜索</label>
					<div id='jselect' class='jselect'>
						<cite class='selected'>全部</cite>
						<?php $search_model = getcache('search_model_'.$siteid,'search');?>
						<ul class='options'>
							<li><a class='option' hidefocus='true' href='javascript:;' selectid='1'>全部</a></li>
							<?php $n=1;if(is_array($search_model)) foreach($search_model AS $k=>$v) { ?>
							<li><a class='option' hidefocus='true' href='javascript:;' selectid='<?php echo $v['typeid'];?>'><?php echo $v['name'];?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
					</div><input type='text' id='search-wd' name='q' /><button type='submit' id='search-submit'>搜 索</button>
				</form>
				<div class='hot-word'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4bc11a1a5c9819ac9a9069d649a80f5f&action=position&posid=418&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'418','order'=>'listorder DESC','limit'=>'3',));}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<a href='<?php echo url_change($r[url]);?>' hidefocus='true'> <?php echo str_cut($r['title'],20,'');?></a>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
			</div>
		</div>
	</div>
	<!-- Search bar End -->

	<!-- ui-content main -->
	<div class='ui-content ui-content-main fn-clear'>
		<div class="ui-content-item-side">
			<div class='ad-side ad-top'>
			<a href='http://myshow.huoshow.com' target="_blank"><img src='<?php echo IMG_PATH;?>common/show.png' width="200" height='200' /></a>
			</div>
			<div class="ui-tab ui-tab-lite">
				<h3 class='ui-tab-lite-header'>专题</h3>
				<ul class="ui-tab-nav fn-clear">
					<li class="ui-tab-nav-item ui-tab-nav-item-cur">电影</li>
					<li class='ui-tab-nav-item'>音乐</li>
					<li class='ui-tab-nav-item'>游戏</li>
				</ul>
				<div class="ui-tab-cnt">
					<div class="ui-tab-cnt-item">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4a5972c4186242694979c9b85ee61ac9&action=position&posid=366&order=listorder+DESC&num=13\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'366','order'=>'listorder DESC','limit'=>'13',));}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<?php if($n==1) { ?>
						<ul class="ui-gallery">
							<li class="ui-gallery-item">
								<a target="_blank" class='ui-gallery-item-img' href='<?php echo url_change($r[url]);?>'><img src='<?php echo thumb($r[thumb],180,85);?>' alt='' width='180' height='85' /></a>
								<h3 class="ui-gallery-item-header"><a target="_blank" href='<?php echo url_change($r[url]);?>'> <?php echo str_cut($r['title'],30,'');?></a></h3>
							</li>
						</ul>
					<?php } else { ?>
						<?php if($n==2) { ?><ul class="ui-list"><?php } ?>
							<li class="ui-list-item"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],40,'');?></a></li>
						<?php if($n==13) { ?></ul><?php } ?>
					<?php } ?>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
					<div class="ui-tab-cnt-item fn-hide">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=405ec8ea4f2c3369060f355fdb44b485&action=position&posid=367&order=listorder+DESC&num=13\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'367','order'=>'listorder DESC','limit'=>'13',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==1) { ?>
						<ul class="ui-gallery">
							<li class="ui-gallery-item">
								<a target="_blank" class='ui-gallery-item-img' href='<?php echo url_change($r[url]);?>'><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],180,85);?>' alt='' width='180' height='85' /></a>
								<h3 class="ui-gallery-item-header"><a target="_blank" href='<?php echo url_change($r[url]);?>'> <?php echo str_cut($r['title'],30,'');?></a></h3>
							</li>
						</ul>
						<?php } else { ?>
						<?php if($n==2) { ?><ul class="ui-list"><?php } ?>
							<li class="ui-list-item"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],40,'');?></a></li>
						<?php if($n==13) { ?></ul><?php } ?>
					<?php } ?>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
					<div class="ui-tab-cnt-item fn-hide">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ed4080035a20598aa8e4fb9b4874b6dd&action=position&posid=368&order=listorder+DESC&num=13\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'368','order'=>'listorder DESC','limit'=>'13',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==1) { ?>
						<ul class="ui-gallery">
							<li class="ui-gallery-item">
								<a target="_blank" class='ui-gallery-item-img' href='<?php echo url_change($r[url]);?>'><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],180,85);?>' alt='' width='180' height='85' /></a>
								<h3 class="ui-gallery-item-header"><a target="_blank" href='<?php echo url_change($r[url]);?>'> <?php echo str_cut($r['title'],30,'');?></a></h3>
							</li>
						</ul>
					<?php } else { ?>
						<?php if($n==2) { ?><ul class="ui-list"><?php } ?>
							<li class="ui-list-item"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],40,'');?></a></li>
						<?php if($n==13) { ?></ul><?php } ?>
					<?php } ?>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
				</div>
			</div>
		</div>

		<div class="ui-content-item-left ui-tab">
			<ul class="ui-tab-nav fn-clear">
				<li class="ui-tab-nav-item ui-tab-nav-item-cur">最新</li>
				<li class='ui-tab-nav-item'>图片</li>
				<!-- <li class='ui-tab-nav-item'>视频</li> -->
			</ul>
			<div class="ui-tab-cnt">
				<div class="ui-tab-cnt-item">
					<div class='ui-art fn-clear'>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=cf78d595ca4a8f582709315c64cce5d9&action=position&posid=347&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'347','order'=>'listorder DESC','limit'=>'5',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<?php if($n==1) { ?>
						<div class='ui-art-album'>
							<a target="_blank" href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],120,90);?>' alt='' width='120' height='90' /></a>
							<h3><a href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],24,'');?></a></h3>
						</div>
						<?php } else { ?>
						<?php if($n==2) { ?><ul class="ui-list"><?php } ?>
							<li class="ui-list-item"><a href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],60,'');?></a></li>
						<?php if($n==5) { ?></ul><?php } ?>
						<?php } ?>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>

					<ul class="ui-list">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b7654710cf1f7732bded1727fa7cf6ef&action=position&posid=397&order=listorder+DESC&num=20\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'397','order'=>'listorder DESC','limit'=>'20',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class="ui-list-item"><?php if($n%5==0) { ?><h3><?php } ?><a target="_blank" <?php if($n%5==0) { ?>class='hot'<?php } ?> href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],70,'');?></a><?php if($n%5==0) { ?></h3><?php } ?></li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>


				</div>
				<div class="ui-tab-cnt-item fn-hide">
					<ul class="ui-gallery fn-clear">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4f6b5c850f4a754cfd668f32eb38760f&action=position&posid=348&order=listorder+DESC&num=15\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'348','order'=>'listorder DESC','limit'=>'15',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class="ui-gallery-item">
							<a target="_blank" class='ui-gallery-item-img' href='<?php echo url_change($r[url]);?>'><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],120,90);?>' alt='' width='120' height='90' /></a>
							<h3 class="ui-gallery-item-title"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],30,'');?></a></h3>
						</li>
					<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</div>
				<div class="ui-tab-cnt-item fn-hide">
					<ul class="ui-gallery fn-clear">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4fcdc550e08c717a31123b2de4734f2e&action=position&posid=349&order=listorder+DESC&num=15\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'349','order'=>'listorder DESC','limit'=>'15',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class="ui-gallery-item">
							<a target="_blank" class='ui-gallery-item-img' href='<?php echo url_change($r[url]);?>'><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],120,90);?>' alt='' width='120' height='90' /></a>
							<div class="ui-gallery-item-status"><!--25:88--></div>
							<h3 class="ui-gallery-item-title"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],30,'');?></a></h3>
						</li>
					<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</div>
			</div>
		</div>

		<div class="ui-content-item-center ui-tab">
			<ul class="ui-tab-nav fn-clear">
				<li class="ui-tab-nav-item ui-tab-nav-item-cur"><a href="<?php echo url_change($CATEGORYS[246][url]);?>" target="_blank">游戏</a></li>
				<li class='ui-tab-nav-item'><a href="<?php echo url_change($CATEGORYS[247][url]);?>" target="_blank">网络游戏</a></li>
				<li class='ui-tab-nav-item'><a href="<?php echo url_change($CATEGORYS[248][url]);?>" target="_blank">网页游戏</a></li>
				<li class='ui-tab-nav-item'><a href="<?php echo url_change($CATEGORYS[249][url]);?>" target="_blank">单机游戏</a></li>
			</ul>
			<div class="ui-tab-cnt">
				<div class="ui-tab-cnt-item">
					<div class='ui-header'>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=1eb00a7b2aa03918cf204b1094386853&action=position&posid=350&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'350','order'=>'listorder DESC','limit'=>'5',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<?php if($n==1) { ?>
						<h2 class="ui-header-title" ><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r[title],54,'');?></a></h2>
					<?php } else { ?>
						<?php if($n==2) { ?><ul class="ui-header-cnt"><?php } ?>
							<?php if($n>1 && $n<8) { ?><?php if($n%2==0) { ?><li class="ui-header-cnt-item"><?php } ?><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r[title],40,'');?></a> <?php if($n%2==0) { ?>|<?php } ?> <?php if(($n-1)%2==0) { ?></li><?php } ?><?php } ?>
						<?php if($n==5) { ?></ul><?php } ?>
					<?php } ?>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
					<div class='ui-header hr'>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=828d886f92c2e821d3f6931594a1027f&action=position&posid=351&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'351','order'=>'listorder DESC','limit'=>'5',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<?php if($n==1) { ?>
						<h2 class="ui-header-title"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r[title],54,'');?></a></h2>
					<?php } else { ?>
						<?php if($n==2) { ?><ul class="ui-header-cnt"><?php } ?>
							<?php if($n>1 && $n<8) { ?><?php if($n%2==0) { ?><li class="ui-header-cnt-item"><?php } ?><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r[title],40,'');?></a> <?php if($n%2==0) { ?>|<?php } ?> <?php if(($n-1)%2==0) { ?></li><?php } ?><?php } ?>
						<?php if($n==5) { ?></ul><?php } ?>
					<?php } ?>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
					<ul class="ui-list">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=34ffdc6a225abf0b93fd113fa60c6b5d&action=position&posid=352&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'352','order'=>'listorder DESC','limit'=>'8',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class="ui-list-item"><?php if($n==5) { ?><h3><?php } ?><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r[title],60,'');?></a><?php if($n==5) { ?></h3><?php } ?></li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
					<ul class="ui-game-list fn-clear">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a50ebb96fabc81779cd0d9f03ff38338&action=position&posid=353&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'353','order'=>'listorder DESC','limit'=>'8',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class="ui-game-list-item">
							<a target="_blank" class='ui-game-list-item-img' href='<?php echo url_change($r[url]);?>'><img src='<?php echo thumb($r[thumb],76,76);?>' alt='' width='76' height='76' /></a>
							<?php if($n%2==0) { ?><div <?php if($n==2) { ?>class="hot"<?php } elseif ($n==4) { ?>class="hot hot-green"<?php } elseif ($n==6) { ?>class="hot hot-blue"<?php } else { ?>class="hot"<?php } ?>>Hot</div><?php } ?>
							<h3 class="ui-game-list-item-title"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],20,'');?></a></h3>
						</li>
					<?php $n++;}unset($n); ?>
					</ul>
				</div>
				<div class="ui-tab-cnt-item fn-hide">
					<div class='ui-header'>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a140d5d56bb067a6702fe64542089133&action=position&posid=354&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'354','order'=>'listorder DESC','limit'=>'5',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<?php if($n==1) { ?>
						<h2 class="ui-header-title"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r[title],54,'');?></a></h2>
					<?php } else { ?>
						<?php if($n==2) { ?><ul class="ui-header-cnt"><?php } ?>
							<?php if($n>1 && $n<8) { ?><?php if($n%2==0) { ?><li class="ui-header-cnt-item"><?php } ?><a target="_blank"  href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r[title],40,'');?></a> <?php if($n%2==0) { ?>|<?php } ?> <?php if(($n-1)%2==0) { ?></li><?php } ?><?php } ?>
						<?php if($n==5) { ?></ul><?php } ?>
					<?php } ?>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
					<div class='ui-header hr'>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=5468b84c76e868b71bb826422a4677be&action=position&posid=355&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'355','order'=>'listorder DESC','limit'=>'5',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<?php if($n==1) { ?>
						<h2 class="ui-header-title"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r[title],54,'');?></a></h2>
					<?php } else { ?>
						<?php if($n==2) { ?><ul class="ui-header-cnt"><?php } ?>
							<?php if($n>1 && $n<8) { ?><?php if($n%2==0) { ?><li class="ui-header-cnt-item"><?php } ?><a target="_blank"  href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r[title],40,'');?></a> <?php if($n%2==0) { ?>|<?php } ?> <?php if(($n-1)%2==0) { ?></li><?php } ?><?php } ?>
						<?php if($n==5) { ?></ul><?php } ?>
					<?php } ?>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
					<ul class="ui-list">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=3f2fc61c48039786236a338e1c1bcaef&action=position&posid=356&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'356','order'=>'listorder DESC','limit'=>'8',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class="ui-list-item"><?php if($n==5) { ?><h3><?php } ?><a target="_blank"  href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r[title],60,'');?></a><?php if($n==5) { ?></h3><?php } ?></li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
					<ul class="ui-game-list fn-clear">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b04a2aaaed49f0a4c64cf700b7e27b50&action=position&posid=357&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'357','order'=>'listorder DESC','limit'=>'8',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class="ui-game-list-item">
							<a target="_blank" class='ui-game-list-item-img' href='<?php echo url_change($r[url]);?>'><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],76,76);?>' alt='' width='76' height='76' /></a>
							<?php if($n%2==0) { ?><div <?php if($n==2) { ?>class="hot"<?php } elseif ($n==4) { ?>class="hot hot-green"<?php } elseif ($n==6) { ?>class="hot hot-blue"<?php } else { ?>class="hot"<?php } ?>>Hot</div><?php } ?>
							<h3 class="ui-game-list-item-title"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],20,'');?></a></h3>
						</li>
					<?php $n++;}unset($n); ?>
					</ul>
				</div>
				<div class="ui-tab-cnt-item fn-hide">
					<div class='ui-header'>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=c2ce30c6dd37e41931192143793142e2&action=position&posid=358&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'358','order'=>'listorder DESC','limit'=>'5',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<?php if($n==1) { ?>
						<h2 class="ui-header-title"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r[title],54,'');?></a></h2>
					<?php } else { ?>
						<?php if($n==2) { ?><ul class="ui-header-cnt"><?php } ?>
							<?php if($n>1 && $n<8) { ?><?php if($n%2==0) { ?><li class="ui-header-cnt-item"><?php } ?><a target="_blank"  href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r[title],40,'');?></a> <?php if($n%2==0) { ?>|<?php } ?> <?php if(($n-1)%2==0) { ?></li><?php } ?><?php } ?>
						<?php if($n==5) { ?></ul><?php } ?>
					<?php } ?>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
					<div class='ui-header hr'>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b1f58ed072a7d69216c465b395c11ff9&action=position&posid=359&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'359','order'=>'listorder DESC','limit'=>'5',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<?php if($n==1) { ?>
						<h2 class="ui-header-title"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r[title],54,'');?></a></h2>
					<?php } else { ?>
						<?php if($n==2) { ?><ul class="ui-header-cnt"><?php } ?>
							<?php if($n>1 && $n<8) { ?><?php if($n%2==0) { ?><li class="ui-header-cnt-item"><?php } ?><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r[title],40,'');?></a> <?php if($n%2==0) { ?>|<?php } ?> <?php if(($n-1)%2==0) { ?></li><?php } ?><?php } ?>
						<?php if($n==5) { ?></ul><?php } ?>
					<?php } ?>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
					<ul class="ui-list">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b31820eb0417e24db2dbdb6ffd9c586f&action=position&posid=360&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'360','order'=>'listorder DESC','limit'=>'8',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class="ui-list-item"><?php if($n==5) { ?><h3><?php } ?><a target="_blank"  href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r[title],60,'');?></a><?php if($n==5) { ?></h3><?php } ?></li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
					<ul class="ui-game-list fn-clear">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e1a9a4e591653bb8370cb15a54104075&action=position&posid=361&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'361','order'=>'listorder DESC','limit'=>'8',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class="ui-game-list-item">
							<a target="_blank" class='ui-game-list-item-img' href='<?php echo url_change($r[url]);?>'><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],76,76);?>' alt='' width='76' height='76' /></a>
							<?php if($n%2==0) { ?><div <?php if($n==2) { ?>class="hot"<?php } elseif ($n==4) { ?>class="hot hot-green"<?php } elseif ($n==6) { ?>class="hot hot-blue"<?php } else { ?>class="hot"<?php } ?>>Hot</div><?php } ?>
							<h3 class="ui-game-list-item-title"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],20,'');?></a></h3>
						</li>
					<?php $n++;}unset($n); ?>
					</ul>
				</div>
				<div class="ui-tab-cnt-item fn-hide">
					<div class='ui-header'>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=306d6ee5d705cab24acbf1a1be29fe5b&action=position&posid=362&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'362','order'=>'listorder DESC','limit'=>'5',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<?php if($n==1) { ?>
						<h2 class="ui-header-title"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r[title],54,'');?></a></h2>
					<?php } else { ?>
						<?php if($n==2) { ?><ul class="ui-header-cnt"><?php } ?>
							<?php if($n>1 && $n<8) { ?><?php if($n%2==0) { ?><li class="ui-header-cnt-item"><?php } ?><a target="_blank"  href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r[title],40,'');?></a> <?php if($n%2==0) { ?>|<?php } ?> <?php if(($n-1)%2==0) { ?></li><?php } ?><?php } ?>
						<?php if($n==5) { ?></ul><?php } ?>
					<?php } ?>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
					<div class='ui-header hr'>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=5714ef27813ccb6d6815d8e98a0eb9c3&action=position&posid=363&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'363','order'=>'listorder DESC','limit'=>'5',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<?php if($n==1) { ?>
						<h2 class="ui-header-title"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r[title],54,'');?></a></h2>
					<?php } else { ?>
						<?php if($n==2) { ?><ul class="ui-header-cnt"><?php } ?>
							<?php if($n>1 && $n<8) { ?><?php if($n%2==0) { ?><li class="ui-header-cnt-item"><?php } ?><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r[title],40,'');?></a> <?php if($n%2==0) { ?>|<?php } ?> <?php if(($n-1)%2==0) { ?></li><?php } ?><?php } ?>
						<?php if($n==5) { ?></ul><?php } ?>
					<?php } ?>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
					<ul class="ui-list">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=85ceada3ab06cb15040b4116b0c496ad&action=position&posid=364&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'364','order'=>'listorder DESC','limit'=>'8',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class="ui-list-item"><?php if($n==5) { ?><h3><?php } ?><a target="_blank"  href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r[title],60,'');?></a><?php if($n==5) { ?></h3><?php } ?></li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
					<ul class="ui-game-list fn-clear">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=3de061775f54821bb4120ce720b87502&action=position&posid=365&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'365','order'=>'listorder DESC','limit'=>'8',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class="ui-game-list-item">
							<a target="_blank" class='ui-game-list-item-img' href='<?php echo url_change($r[url]);?>'><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],76,76);?>' alt='' width='76' height='76' /></a>
							<?php if($n%2==0) { ?><div <?php if($n==2) { ?>class="hot"<?php } elseif ($n==4) { ?>class="hot hot-green"<?php } elseif ($n==6) { ?>class="hot hot-blue"<?php } else { ?>class="hot"<?php } ?>>Hot</div><?php } ?>
							<h3 class="ui-game-list-item-title"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],20,'');?></a></h3>
						</li>
					<?php $n++;}unset($n); ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- ui-content main end -->

	<!-- ui-content sub -->
	<div class='ui-content ui-content-sub fn-clear'>
		<div class="ui-content-item-side">
			<div class="ui-goods-box">
				<h3 class="ui-goods-box-header">购物</h3>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b095c346755d04beaef580540792d2dd&action=get_share_pos\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'get_share_pos')) {$data = $content_tag->get_share_pos(array('limit'=>'20',));}?>
				<?php $i=0?>
				<ul class='ui-goods-list'>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<?php $i++?>
					<?php if($i==1) { ?>
					<li class="ui-goods-list-item clothing">
					<?php } elseif ($i==2) { ?>
					<li class="ui-goods-list-item shoe">
					<?php } elseif ($i==3) { ?>
					<li class="ui-goods-list-item sport">
					<?php } elseif ($i==4) { ?>
					<li class="ui-goods-list-item beauty">
					<?php } elseif ($i==5) { ?>
					<li class="ui-goods-list-item house">
					<?php } else { ?>
					<li class="ui-goods-list-item mais">
					<?php } ?>
					<span class='wrapper'><em><?php echo $r['pos_name'];?></em>
						<?php $n=1;if(is_array($r[data])) foreach($r[data] AS $v) { ?>
							<?php if((strpos($v[url], "lists"))) { ?>
							<?php $my_url = "http://myshow.huoshow.com/fl-$v[classid].html"?>
							<?php } ?>
							<?php if((strpos($v[url], "tag_lists"))) { ?>
							<?php $my_url = "http://myshow.huoshow.com/tag-$v[classid].html"?>
							<?php } ?>
							<?php if((strpos($v[url], "myshow_show_album"))) { ?>
							<?php $my_url = "http://myshow.huoshow.com/zj-$v[classid].html"?>
							<?php } ?>
							<a target="_blank" href='<?php echo $my_url;?>'><?php echo $v['name'];?></a>
						<?php $n++;}unset($n); ?>
					</span>
					</li>
					<?php $n++;}unset($n); ?>
				</ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>

			<div id='js-box-lite' class="ui-box-lite">
				<h3 class="ui-box-lite-header">最新分享</h3>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=70a6cfa3708aa3d2a33fcd4b02b1a5c0&action=get_my_show_share&order=LIMIT+6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'get_my_show_share')) {$data = $content_tag->get_my_show_share(array('order'=>'LIMIT 6','limit'=>'20',));}?>
				<ul class='ui-arts'>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-art'>
						<a class='ui-art-img' href='http://myshow.huoshow.com/show-<?php echo $r['id'];?>.html' target="_blank"><img src='<?php echo $r['small'];?>' alt='' width='58' height='58' /></a>
						<p class="ui-art-cnt"><?php echo str_cut($r['description'],80,'');?></p>
					</li>
					<?php $n++;}unset($n); ?>
				</ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>

			<div class="ui-tab ui-tab-lite">
				<h3 class='ui-tab-lite-header'>排行榜</h3>
				<ul class="ui-tab-nav fn-clear">
					<li class="ui-tab-nav-item ui-tab-nav-item-cur">电影</li>
					<li class='ui-tab-nav-item'>电视</li>
					<li class='ui-tab-nav-item'>音乐</li>
				</ul>
				<div class="ui-tab-cnt">
					<div class="ui-tab-cnt-item">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=86fd05e9a60ee3369e3fa4d3b04c2d0b&action=position&posid=393&order=listorder+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'393','order'=>'listorder DESC','limit'=>'10',));}?>
						<ul class="ui-rank">
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='<?php if($n==1 || $n==2 || $n==3 || $n==6 || $n==9) { ?>ui-rank-item ui-rank-item-up<?php } elseif ($n==4 || $n==7 || $n==8) { ?>ui-rank-item ui-rank-item-down<?php } else { ?>ui-rank-item<?php } ?> <?php if($n==1) { ?>ui-rank-item-cur<?php } ?>'>
								<a target="_blank" class='ui-rank-item-img' href='<?php echo url_change($r[url]);?>'><img src='<?php echo thumb($r[thumb],90,62);?>' alt='' width='90' height='62' /></a>
								<span class='ui-rank-item-num ui-rank-item-hotnum'><?php echo $n;?></span>
								<a target="_blank" class='ui-rank-item-title' href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],30,'');?></a>
								<p class="ui-rank-item-desc"><?php echo str_cut($r['description'],25,'');?></p>
								<!--p class='ui-rank-item-count'>65458798</p-->
							</li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
					<div class="ui-tab-cnt-item fn-hide">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d3870cc6d336444e4f637364959039bb&action=position&posid=394&order=listorder+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'394','order'=>'listorder DESC','limit'=>'10',));}?>
						<ul class="ui-rank">
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='<?php if($n==1 || $n==2 || $n==3 || $n==7 || $n==10) { ?>ui-rank-item ui-rank-item-up<?php } elseif ($n==5 || $n==8) { ?>ui-rank-item ui-rank-item-down<?php } else { ?>ui-rank-item<?php } ?> <?php if($n==1) { ?>ui-rank-item-cur<?php } ?>'>
								<a target="_blank" class='ui-rank-item-img' href='<?php echo url_change($r[url]);?>'><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],90,62);?>' alt='' width='90' height='62' /></a>
								<span class='ui-rank-item-num ui-rank-item-hotnum'><?php echo $n;?></span>
								<a target="_blank" class='ui-rank-item-title' href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],30,'');?></a>
								<p class="ui-rank-item-desc"><?php echo str_cut($r['description'],25,'');?></p>
								<!--p class='ui-rank-item-count'>65458798</p-->
							</li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
					<div class="ui-tab-cnt-item fn-hide">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d275d331b76d5121c9f885f3bb378a83&action=position&posid=395&order=listorder+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'395','order'=>'listorder DESC','limit'=>'10',));}?>
						<ul class="ui-rank">
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class='<?php if($n==1 || $n==2 || $n==3 || $n==6 || $n==8) { ?>ui-rank-item ui-rank-item-up<?php } elseif ($n==4 || $n==7 || $n==9) { ?>ui-rank-item ui-rank-item-down<?php } else { ?>ui-rank-item<?php } ?> <?php if($n==1) { ?>ui-rank-item-cur<?php } ?>'>
								<a target="_blank" class='ui-rank-item-img' href='<?php echo url_change($r[url]);?>'><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],90,62);?>' alt='' width='90' height='62' /></a>
								<span class='ui-rank-item-num ui-rank-item-hotnum'><?php echo $n;?></span>
								<a target="_blank" class='ui-rank-item-title' href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],30,'');?></a>
								<p class="ui-rank-item-desc"><?php echo str_cut($r['description'],25,'');?></p>
								<!--p class='ui-rank-item-count'>65458798</p-->
							</li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
				</div>
			</div>
		</div>

		<div class='ad'><a href='http://myshow.huoshow.com' target="_blank"><img src='<?php echo IMG_PATH;?>common/index_middle_anner.jpg' width='752' height='100' /></a></div>
		<div class='ui-content-item-wrapper'>
			<div class="ui-content-item-left ui-tab">
				<ul class="ui-tab-nav fn-clear">
					<li class="ui-tab-nav-item ui-tab-nav-item-cur"><a href="<?php echo $CATEGORYS['11']['url'];?>" target="_blank">明星</a></li>
					<li class='ui-tab-nav-item'><a href="<?php echo $CATEGORYS['34']['url'];?>" target="_blank">内地</a></li>
					<li class='ui-tab-nav-item'><a href="<?php echo $CATEGORYS['35']['url'];?>" target="_blank">港台</a></li>
					<li class='ui-tab-nav-item'><a href="<?php echo $CATEGORYS['28']['url'];?>" target="_blank">写真</a></li>
				</ul>
				<div class="ui-tab-cnt">
					<div class="ui-tab-cnt-item">
						<div class='ui-art fn-clear'>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a6c3c5f9811ff0d96f74c9183f136cd0&action=position&posid=369&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'369','order'=>'listorder DESC','limit'=>'5',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==1) { ?>
							<div class='ui-art-album'>
								<a target="_blank" href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],120,90);?>' alt='<?php echo $r['title'];?>' width='120' height='90' /></a>
								<h3><a href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],28,'');?></a></h3>
							</div>
						<?php } else { ?>
							<?php if($n==2) { ?><ul class="ui-list"><?php } ?>
								<li class="ui-list-item"><a href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],60,'');?></a></li>
							<?php if($n==5) { ?></ul><?php } ?>
						<?php } ?>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</div>

						<ul class="ui-list">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=db6fbb2dbff294001756c51f8b461ff4&action=position&posid=399&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'399','order'=>'listorder DESC','limit'=>'8',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-list-item"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],70,'');?></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>
					<div class="ui-tab-cnt-item fn-hide">

						<div class='ui-art fn-clear'>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=9f079f64745e48e8297e498c1b28bad1&action=position&posid=400&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'400','order'=>'listorder DESC','limit'=>'5',));}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==1) { ?>
							<div class='ui-art-album'>
								<a target="_blank" href="<?php echo url_change($r[url]);?>"><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],120,90);?>' alt='' width='120' height='90' /></a>
								<h3><a href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],28,'');?></a></h3>
							</div>
						<?php } else { ?>
							<?php if($n==2) { ?><ul class="ui-list"><?php } ?>
								<li class="ui-list-item"><a href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],60,'');?></a></li>
							<?php if($n==5) { ?></ul><?php } ?>
						<?php } ?>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</div>

						<ul class="ui-list">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=1e39a2e98fafc64875174e78b9da8200&action=morecatids&catids=44%2C45%2C46%2C47%2C48&newsnum=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'morecatids')) {$data = $content_tag->morecatids(array('catids'=>'44,45,46,47,48','newsnum'=>'8','limit'=>'20',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-list-item"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],70,'');?></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>
					<div class="ui-tab-cnt-item fn-hide">
						<div class='ui-art fn-clear'>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=9921e95fff9647b460c881ffa3f0575e&action=position&posid=401&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'401','order'=>'listorder DESC','limit'=>'5',));}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==1) { ?>
							<div class='ui-art-album'>
								<a target="_blank" href="<?php echo url_change($r[url]);?>"><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],120,90);?>' alt='<?php echo $r['title'];?>' width='120' height='90' /></a>
								<h3><a href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],28,'');?></a></h3>
							</div>
						<?php } else { ?>
							<?php if($n==2) { ?><ul class="ui-list"><?php } ?>
								<li class="ui-list-item"><a href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],60,'');?></a></li>
							<?php if($n==5) { ?></ul><?php } ?>
						<?php } ?>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</div>
						<ul class="ui-list">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d6ab992390edf1d4946d46f2df3d2d60&action=morecatids&catids=49%2C50%2C51&newsnum=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'morecatids')) {$data = $content_tag->morecatids(array('catids'=>'49,50,51','newsnum'=>'8','limit'=>'20',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-list-item"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],70,'');?></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>

					</div>
					<div class="ui-tab-cnt-item fn-hide">
						<ul class="ui-gallery fn-clear">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=3a9bd4fbb1441ea01eb1aa52a0f1777d&action=position&posid=370&order=listorder+DESC&num=9\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'370','order'=>'listorder DESC','limit'=>'9',));}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-gallery-item">
								<a target="_blank" class='ui-gallery-item-img' href='<?php echo url_change($r[url]);?>'><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],120,90);?>' alt='' width='120' height='90' /></a>
								<h3 class="ui-gallery-item-header"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],30,'');?></a></h3>
							</li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>
				</div>
			</div>

			<div class="ui-content-item-center ui-tab">
				<ul class="ui-tab-nav fn-clear">
					<li class="ui-tab-nav-item ui-tab-nav-item-cur"><a href="<?php echo $CATEGORYS['12']['url'];?>" target="_blank">电影</a></li>
					<li class='ui-tab-nav-item'><a href="<?php echo $CATEGORYS['64']['url'];?>" target="_blank">华语</a></li>
					<!-- <li class='ui-tab-nav-item'><a href="<?php echo $CATEGORYS['141']['url'];?>" target="_blank">预告</a></li> -->
					<li class='ui-tab-nav-item'><a href="<?php echo $CATEGORYS['69']['url'];?>" target="_blank">剧照</a></li>
				</ul>
				<div class="ui-tab-cnt">
					<div class="ui-tab-cnt-item">
						<ul class="ui-ilist fn-clear">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=f14317174e1c21098e11c655688fff25&action=position&posid=373&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'373','order'=>'listorder DESC','limit'=>'3',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-ilist-item">
								<a class='ui-ilist-item-img' href='<?php echo url_change($r[url]);?>'><img src='<?php echo thumb($r[thumb],104,72);?>' alt='' width='104' height='72' /></a>
								<h3 class="ui-ilist-item-title"><a href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],20,'');?></a></h3>
							</li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
						<ul class="ui-list">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=1590a5ca4152726b5634156ae02e6226&action=position&posid=402&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'402','order'=>'listorder DESC','limit'=>'8',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-list-item"><a href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],70,'');?></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>
					<div class="ui-tab-cnt-item fn-hide">
						<ul class="ui-ilist fn-clear">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=5101cf007a29154f439322160aa14376&action=position&posid=403&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'403','order'=>'listorder DESC','limit'=>'3',));}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-ilist-item">
								<a class='ui-ilist-item-img' href='<?php echo url_change($r[url]);?>'><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],104,72);?>' alt='' width='104' height='72' /></a>
								<h3 class="ui-ilist-item-title"><a href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],20,'');?></a></h3>
							</li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
						<ul class="ui-list">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=cdd87b9e94167b92ffb2426ee0f33907&action=lists&catid=64&order=id+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'64','order'=>'id DESC','limit'=>'8',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-list-item"><a href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],70,'');?></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>

					<div class="ui-tab-cnt-item fn-hide">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=56d6220eaf1725e2c9b031319fd65eff&action=position&posid=420&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'420','order'=>'listorder DESC','limit'=>'4',));}?>
						<ul class="ui-gallery fn-clear">
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-gallery-item">
								<a target="_blank" class='ui-gallery-item-img' href='<?php echo url_change($r[url]);?>'><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],160,158);?>' alt='' width='160' height='158' /></a>
								<h3 class="ui-gallery-item-header"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],35,'');?></a></h3>
							</li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
				</div>
			</div>
		</div>

		<div class="ui-content-item-wrapper">
			<div class="ui-content-item-left ui-tab">
				<ul class="ui-tab-nav fn-clear">
					<li class="ui-tab-nav-item ui-tab-nav-item-cur"><a href="<?php echo $CATEGORYS['131']['url'];?>" target="_blank">电视</a></li>
					<li class='ui-tab-nav-item'><a href="<?php echo $CATEGORYS['147']['url'];?>" target="_blank">综艺</a></li>
					<!-- <li class='ui-tab-nav-item'><a href="<?php echo $CATEGORYS['236']['url'];?>" target="_blank">热播</a></li> -->
					<li class='ui-tab-nav-item'><a href="<?php echo $CATEGORYS['143']['url'];?>" target="_blank">内地</a></li>
				</ul>
				<div class="ui-tab-cnt">
					<div class="ui-tab-cnt-item">
						<div class='ui-art fn-clear'>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ef62bf1b0cc243e0451a6d403878a95e&action=position&posid=374&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'374','order'=>'listorder DESC','limit'=>'5',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==1) { ?>
							<div class='ui-art-album'>
								<a target="_blank" href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],120,90);?>' alt='<?php echo $r['title'];?>' width='120' height='90' /></a>
								<h3><a href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],28,'');?></a></h3>
							</div>
						<?php } else { ?>
							<?php if($n==2) { ?><ul class="ui-list"><?php } ?>
								<li class="ui-list-item"><a href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],60,'');?></a></li>
							<?php if($n==5) { ?></ul><?php } ?>
						<?php } ?>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</div>
						<ul class="ui-list">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=1d5f5e9dde0fac8998dc7d723bc1db4a&action=position&posid=405&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'405','order'=>'listorder DESC','limit'=>'8',));}?>
   						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-list-item"><a href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],70,'');?></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>
					<div class="ui-tab-cnt-item fn-hide">
						<div class='ui-art fn-clear'>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=24937aed02e6586cc9c7384e9e637bb5&action=position&posid=406&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'406','order'=>'listorder DESC','limit'=>'5',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==1) { ?>
							<div class='ui-art-album'>
								<a target="_blank" href="<?php echo url_change($r[url]);?>"><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],120,90);?>' alt='<?php echo $r['title'];?>' width='120' height='90' /></a>
								<h3><a href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],28,'');?></a></h3>
							</div>
						<?php } else { ?>
							<?php if($n==2) { ?><ul class="ui-list"><?php } ?>
								<li class="ui-list-item"><a href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],60,'');?></a></li>
							<?php if($n==5) { ?></ul><?php } ?>
						<?php } ?>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</div>

						<ul class="ui-list">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=2a334e5f8c72a7140c9d056b78694339&action=lists&catid=147&order=id+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'147','order'=>'id DESC','limit'=>'8',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-list-item"><a href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],70,'');?></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>

					<div class="ui-tab-cnt-item fn-hide">
						<div class='ui-art fn-clear'>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ef1315d21d251bb577a782de32db0af0&action=position&posid=419&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'419','order'=>'listorder DESC','limit'=>'5',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==1) { ?>
							<div class='ui-art-album'>
								<a target="_blank" href="<?php echo url_change($r[url]);?>"><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],120,90);?>' alt='<?php echo $r['title'];?>' width='120' height='90' /></a>
								<h3><a href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],24,'');?></a></h3>
							</div>
						<?php } else { ?>
							<?php if($n==2) { ?><ul class="ui-list"><?php } ?>
								<li class="ui-list-item"><a href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],60,'');?></a></li>
							<?php if($n==5) { ?></ul><?php } ?>
						<?php } ?>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</div>
						<ul class="ui-list">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=f8d792389fe381139255e6ab66807a3a&action=lists&catid=143&order=id+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'143','order'=>'id DESC','limit'=>'8',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-list-item"><a href='<?php echo url_change($r[url]);?>'> <?php echo str_cut($r['title'],70,'');?></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>
				</div>
			</div>

			<div class="ui-content-item-center ui-tab">
				<ul class="ui-tab-nav fn-clear">
					<li class="ui-tab-nav-item ui-tab-nav-item-cur"><a href="<?php echo $CATEGORYS['9']['url'];?>" target="_blank">赛事</a></li>
					<li class='ui-tab-nav-item'><a href="<?php echo $CATEGORYS['15']['url'];?>" target="_blank">快报</a></li>
					<!-- <li class='ui-tab-nav-item'><a href="<?php echo $CATEGORYS['19']['url'];?>" target="_blank">视频</a></li> -->
					<li class='ui-tab-nav-item'><a href="<?php echo $CATEGORYS['139']['url'];?>" target="_blank">图集</a></li>
				</ul>
				<div class="ui-tab-cnt">
					<div class="ui-tab-cnt-item">
						<ul class="ui-ilist fn-clear">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=de3008350b2fca9bd725661a47f1efb6&action=position&posid=376&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'376','order'=>'listorder DESC','limit'=>'3',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-ilist-item">
								<a target="_blank" class='ui-ilist-item-img' href='<?php echo url_change($r[url]);?>'><img src='<?php echo thumb($r[thumb],104,72);?>' alt='' width='104' height='72' /></a>
								<h3 class="ui-ilist-item-title"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],30,'');?></a></h3>
							</li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
						<ul class="ui-list">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=561f81eecb3f69fc9f262a3a18a3b024&action=position&posid=408&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'408','order'=>'listorder DESC','limit'=>'8',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-list-item"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],70,'');?></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>
					<div class="ui-tab-cnt-item fn-hide">

					<ul class="ui-ilist fn-clear">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=c5356f5abc8bf4a7b3bcc2946f6c7c76&action=position&posid=409&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'409','order'=>'listorder DESC','limit'=>'3',));}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-ilist-item">
								<a target="_blank" class='ui-ilist-item-img' href='<?php echo url_change($r[url]);?>'><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],104,72);?>' alt='' width='104' height='72' /></a>
								<h3 class="ui-ilist-item-title"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],30,'');?></a></h3>
							</li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
						<ul class="ui-list">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=22bf44554da1c4c9afc1ffa324225104&action=morecatids&catids=23%2C24%2C25%2C26&newsnum=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'morecatids')) {$data = $content_tag->morecatids(array('catids'=>'23,24,25,26','newsnum'=>'8','limit'=>'20',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-list-item"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],70,'');?></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>

					<div class="ui-tab-cnt-item fn-hide">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=1dbcb48b6a211fb1f23e955b021d7dac&action=position&posid=377&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'377','order'=>'listorder DESC','limit'=>'4',));}?>
						<ul class="ui-gallery fn-clear">
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-gallery-item">
								<a target="_blank" class='ui-gallery-item-img' href='<?php echo url_change($r[url]);?>'><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],160,158);?>' alt='' width='160' height='158' /></a>
								<h3 class="ui-gallery-item-header"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],35,'');?></a></h3>
							</li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- ui-content sub end -->

	<!-- ui-content thr -->
	<div class='ui-content ui-content-thr fn-clear'>
		<div class="ui-content-item-side">
			<div class="ui-box-lite">
				<h3 class="ui-box-lite-header">热点排行</h3>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b5d54befa8d1a6bdf95485b9d657e0e0&action=hits_index_channel&siteid=1&order=views+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits_index_channel')) {$data = $content_tag->hits_index_channel(array('siteid'=>'1','order'=>'views DESC','limit'=>'10',));}?>
				<ul class="ui-rank">
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='<?php if($n==1 || $n==2 || $n==3 || $n==5 || $n==8) { ?>ui-rank-item ui-rank-item-up<?php } elseif ($n==4 || $n==7 || $n==9) { ?>ui-rank-item ui-rank-item-down<?php } else { ?>ui-rank-item<?php } ?> <?php if($n==1) { ?>ui-rank-item-cur<?php } ?>'>
						<a target="_blank" class='ui-rank-item-img' href='<?php echo url_change($r[url]);?>'><img src='<?php echo thumb($r[thumb],90,62);?>' alt='' width='90' height='62' /></a>
						<?php if($n<3) { ?>
							<span class='ui-rank-item-num ui-rank-item-hotnum'><?php echo $n;?></span>
						<?php } else { ?>
							<span class='ui-rank-item-num'><?php echo $n;?></span>
						<?php } ?>
						<a target="_blank" class='ui-rank-item-title' href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],30,'');?></a>
						<p class="ui-rank-item-desc"><?php echo str_cut($r['description'],35,'');?></p>
						<!--p class='ui-rank-item-count'><?php echo $r['views'];?></p-->
					</li>
					<?php $n++;}unset($n); ?>
				</ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>

			<div class="ui-tab ui-tab-lite">
				<h3 class='ui-tab-lite-header'>下载专区</h3>
				<ul class="ui-tab-nav fn-clear">
					<li class="ui-tab-nav-item ui-tab-nav-item-cur">单机</li>
					<li class='ui-tab-nav-item'>手机</li>
					<li class='ui-tab-nav-item'>壁纸</li>
				</ul>
				<div class="ui-tab-cnt">
					<div class="ui-tab-cnt-item">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a6bf2ba9276b758da3bc420fbd9fc16c&action=position&posid=378&order=listorder+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'378','order'=>'listorder DESC','limit'=>'10',));}?>
						<ul class="ui-list ui-list-download">
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-list-item"><a target="_blank" class='link' href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],40,'');?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
					<div class="ui-tab-cnt-item fn-hide">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7fc052ff28ec1d2b1fc3727499c2b44a&action=position&posid=379&order=listorder+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'379','order'=>'listorder DESC','limit'=>'10',));}?>
						<ul class="ui-list ui-list-download">
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-list-item"><a target="_blank" class='link' href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],40,'');?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
					<div class="ui-tab-cnt-item fn-hide">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d181509ffdb399e1d10c2594c25cf4c7&action=position&posid=380&order=listorder+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'380','order'=>'listorder DESC','limit'=>'10',));}?>
						<ul class="ui-list ui-list-download">
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-list-item"><a target="_blank" class='link' href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],40,'');?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
				</div>
			</div>

			<div class="ui-tab-side ui-tab">
				<ul class="ui-tab-nav fn-cf">
					<li class="ui-tab-nav-item ui-tab-nav-item-cur">电影影评</li>
					<li class='ui-tab-nav-item'>音乐乐评</li>
				</ul>
				<div class="ui-tab-cnt">
					<div class="ui-tab-cnt-item">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=821d2bc5e7c5d08202839cef1d8c47e0&action=lists&catid=68&order=id+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'68','order'=>'id DESC','limit'=>'10',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==1) { ?>
						<div class='ui-art fn-clear'>
							<a target="_blank" class='ui-art-img' href='<?php echo $r['url'];?>'><img src='<?php echo thumb($r[thumb],85,60);?>' alt='' width='85' height='60' /></a>
							<h2 class='ui-art-title'><?php echo str_cut($r[title],20,'');?></h2>
							<p class="ui-art-cnt"><?php echo str_cut($r[description],100,'');?><a target="_blank" class='detail' href='<?php echo $r['url'];?>'>[详细]</a></p>
						</div>
						<?php } ?>
						<?php $n++;}unset($n); ?>
						<ul class="ui-list">
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<?php if($n>1) { ?>
							<li class="ui-list-item"><a target="_blank" href='<?php echo $r['url'];?>'><?php echo str_cut($r[title],40,'');?></a></li>
							<?php } ?>
						<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
					<div class="ui-tab-cnt-item fn-hide">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=3f06c7a638c28f8b82de2eb3c3a93d01&action=lists&catid=79&order=id+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'79','order'=>'id DESC','limit'=>'10',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==1) { ?>
						<div class='ui-art fn-clear'>
							<a target="_blank" class='ui-art-img' href='<?php echo $r['url'];?>'><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],85,60);?>' alt='' width='85' height='60' /></a>
							<h2 class='ui-art-title'><?php echo str_cut($r[title],20,'');?></h2>
							<p class="ui-art-cnt"><?php echo str_cut($r[description],100,'');?><a target="_blank" class='detail' href='<?php echo $r['url'];?>'>[详细]</a></p>
						</div>
						<?php } ?>
						<?php $n++;}unset($n); ?>
						<ul class="ui-list">
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<?php if($n>1) { ?>
							<li class="ui-list-item"><a target="_blank" href='<?php echo $r['url'];?>'><?php echo str_cut($r[title],40,'');?></a></li>
							<?php } ?>
						<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
				</div>
			</div>
		</div>

		<div class='ad ad-left'><a href='http://game.huoshow.com/' target="_blank"><img src='<?php echo IMG_PATH;?>common/index_ad2.jpg' width='392' height='100' /></a></div>
		<div class='ad ad-center'><a href='http://www.huoshow.com/movie/' target="_blank"><img src='<?php echo IMG_PATH;?>common/index_ad3.jpg' width='352' height='100' /></a></div>

		<div class='ui-content-item-wrapper'>
			<div class="ui-content-item-left ui-tab">
				<ul class="ui-tab-nav fn-clear">
					<li class="ui-tab-nav-item ui-tab-nav-item-cur"><a href="<?php echo $CATEGORYS['13']['url'];?>" target="_blank">音乐</a></li>
					<!-- <li class='ui-tab-nav-item'><a href="<?php echo $CATEGORYS['78']['url'];?>" target="_blank">MV</a></li> -->
					<li class='ui-tab-nav-item'><a href="<?php echo $CATEGORYS['81']['url'];?>" target="_blank">碟报</a></li>
					<li class='ui-tab-nav-item'><a href="<?php echo $CATEGORYS['171']['url'];?>" target="_blank">演唱会</a></li>
				</ul>
				<div class="ui-tab-cnt">
					<div class="ui-tab-cnt-item">

						<div class='ui-art fn-clear'>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=f0b700ed10378bbde9f618d71cd9fa19&action=position&posid=375&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'375','order'=>'listorder DESC','limit'=>'5',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==1) { ?>
							<div class='ui-art-album'>
								<a target="_blank" href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],120,90);?>' alt='<?php echo $r['title'];?>' width='120' height='90' /></a>
								<h3><a href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],28,'');?></a></h3>
							</div>
							<?php } else { ?>
							<?php if($n==2) { ?><ul class="ui-list"><?php } ?>
								<li class="ui-list-item"><a href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],60,'');?></a></li>
							<?php if($n==5) { ?></ul><?php } ?>
							<?php } ?>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</div>

						<ul class="ui-list">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=98751b040bcc4ea22f9918be33a7daf1&action=position&posid=398&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'398','order'=>'listorder DESC','limit'=>'8',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-list-item"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],70,'');?></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>

					<div class="ui-tab-cnt-item fn-hide">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d65269b2b4b8a351bb29d8db0ea3f81a&action=position&posid=391&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'391','order'=>'listorder DESC','limit'=>'4',));}?>
						<ul class="ui-ilist fn-clear">
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-ilist-item">
								<a target="_blank" class='ui-ilist-item-img' href='<?php echo url_change($r[url]);?>'><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],85,72);?>' alt='' width='85' height='72' /></a>
								<h3 class="ui-ilist-item-title"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],60,'');?></a></h3>
							</li>
							<?php $n++;}unset($n); ?>
						</ul>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=f009ad92b08137ed1e6f9fc97ae57b51&action=lists&catid=81&order=id+DESC&num=16\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'81','order'=>'id DESC','limit'=>'16',));}?>
						<ul class="ui-music-list fn-clear">
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-music-list-item"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],30,'');?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>

					<div class="ui-tab-cnt-item fn-hide">
						<div class='ui-art fn-clear'>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=13a03c9b2d6462d9414210309eee4b03&action=position&posid=411&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'411','order'=>'listorder DESC','limit'=>'5',));}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==1) { ?>
							<div class='ui-art-album'>
								<a target="_blank" href="<?php echo url_change($r[url]);?>"><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],120,90);?>' alt='' width='120' height='90' /></a>
								<h3><a href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],28,'');?></a></h3>
							</div>
							<?php } else { ?>
							<?php if($n==2) { ?><ul class="ui-list"><?php } ?>
								<li class="ui-list-item"><a href='<?php echo url_change($r[url]);?>'> <?php echo str_cut($r['title'],54,'');?></a></li>
							<?php if($n==5) { ?></ul><?php } ?>
							<?php } ?>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</div>

						<ul class="ui-list">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=6583a3c8469403dd4a5c1596e34cb0ad&action=lists&catid=171&order=id+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'171','order'=>'id DESC','limit'=>'8',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-list-item"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],70,'');?></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>
				</div>
			</div>

			<div class="ui-content-item-center ui-tab">
				<ul class="ui-tab-nav fn-clear">
					<li class="ui-tab-nav-item ui-tab-nav-item-cur"><a href="<?php echo $CATEGORYS['109']['url'];?>" target="_blank">超模</a></li>
					<li class='ui-tab-nav-item'><a href="<?php echo $CATEGORYS['112']['url'];?>" target="_blank">名模专区</a></li>
					<li class='ui-tab-nav-item'><a href="<?php echo $CATEGORYS['111']['url'];?>" target="_blank">模特大赛</a></li>
					<li class='ui-tab-nav-item'><a href="<?php echo $CATEGORYS['114']['url'];?>" target="_blank">模特写真</a></li>
				</ul>
				<div class="ui-tab-cnt">
					<div class="ui-tab-cnt-item">
						<div class='ui-art fn-clear'>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=5cbf0ec29075747ef9b1c032bdd426eb&action=position&posid=371&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'371','order'=>'listorder DESC','limit'=>'5',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==1) { ?>
							<div class='ui-art-album'>
								<a target="_blank" href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],120,90);?>' alt='<?php echo url_change($r[url]);?>' width='120' height='90' /></a>
								<h3><a href="<?php echo url_change($r[url]);?>"> <?php echo str_cut($r['title'],28,'');?></a></h3>
							</div>
							<?php } else { ?>
							<?php if($n==2) { ?><ul class="ui-list"><?php } ?>
								<li class="ui-list-item"><a href='<?php echo url_change($r[url]);?>'> <?php echo str_cut($r['title'],70,'');?></a></li>
							<?php if($n==5) { ?></ul><?php } ?>
							<?php } ?>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</div>

						<ul class="ui-list">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=f3532dce1cbb1e435692153e19a44a31&action=position&posid=412&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'412','order'=>'listorder DESC','limit'=>'8',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-list-item"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],70,'');?></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>
					<div class="ui-tab-cnt-item fn-hide">
						<div class='ui-art fn-clear'>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=783177cce1299e5ccbb18cee4f220294&action=position&posid=413&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'413','order'=>'listorder DESC','limit'=>'5',));}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==1) { ?>
							<div class='ui-art-album'>
								<a target="_blank" href="<?php echo url_change($r[url]);?>"><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],120,90);?>' alt='<?php echo $r['title'];?>' width='120' height='90' /></a>
								<h3><a href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],28,'');?></a></h3>
							</div>
						<?php } else { ?>
							<?php if($n==2) { ?><ul class="ui-list"><?php } ?>
								<li class="ui-list-item"><a href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],70,'');?></a></li>
							<?php if($n==5) { ?></ul><?php } ?>
						<?php } ?>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</div>

						<ul class="ui-list">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=544178f45599b1d99dc5c72319edf8a4&action=morecatids&catids=137%2C138&newsnum=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'morecatids')) {$data = $content_tag->morecatids(array('catids'=>'137,138','newsnum'=>'8','limit'=>'20',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-list-item"><a target="_blank" href='<?php echo url_change($r[url]);?>'> <?php echo str_cut($r['title'],70,'');?></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>
					<div class="ui-tab-cnt-item fn-hide">
						<div class='ui-art fn-clear'>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=6cc45d52fc3c3f8d604b156b1babe648&action=position&posid=414&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'414','order'=>'listorder DESC','limit'=>'5',));}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==1) { ?>
							<div class='ui-art-album'>
								<a target="_blank" href="<?php echo url_change($r[url]);?>"><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],120,90);?>' alt='<?php echo url_change($r[url]);?>' width='120' height='90' /></a>
								<h3><a href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],28,'');?></a></h3>
							</div>
						<?php } else { ?>
							<?php if($n==2) { ?><ul class="ui-list"><?php } ?>
								<li class="ui-list-item"><a href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],70,'');?></a></li>
							<?php if($n==5) { ?></ul><?php } ?>
						<?php } ?>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</div>

						<ul class="ui-list">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=3fafd75456c11ae9124fa9a9ca717580&action=lists&catid=111&order=id+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'111','order'=>'id DESC','limit'=>'8',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-list-item"><a target="_blank" href='<?php echo url_change($r[url]);?>'> <?php echo str_cut($r['title'],70,'');?></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>

					</div>
					<div class="ui-tab-cnt-item fn-hide">
						<ul class="ui-gallery fn-clear">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b6e6274a97731b29270a6b0b83f9a19d&action=position&posid=372&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'372','order'=>'listorder DESC','limit'=>'4',));}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-gallery-item">
								<a target="_blank" class='ui-gallery-item-img' href='<?php echo url_change($r[url]);?>'><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],160,158);?>' alt='' width='160' height='158' /></a>
								<h3 class="ui-gallery-item-header"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],40,'');?></a></h3>
							</li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="ui-content-item-wrapper">
			<div class="ui-content-item-left ui-tab">
				<ul class="ui-tab-nav fn-clear">
					<li class="ui-tab-nav-item ui-tab-nav-item-cur"><a href="<?php echo $CATEGORYS['83']['url'];?>" target="_blank">访谈</a></li>
					<li class='ui-tab-nav-item'><a href="<?php echo $CATEGORYS['83']['url'];?>" target="_blank">独家策划</a></li>
				</ul>
				<div class="ui-tab-cnt">
					<div class="ui-tab-cnt-item">
						<div class='ui-art fn-clear'>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=aa4a4ccc739061de1891fa79518a49a0&action=position&posid=415&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'415','order'=>'listorder DESC','limit'=>'5',));}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==1) { ?>
							<div class='ui-art-album'>
								<a target="_blank" href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],120,90);?>' alt='<?php echo $r['title'];?>' width='120' height='90' /></a>
								<h3><a href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],28,'');?></a></h3>
							</div>
						<?php } else { ?>
							<?php if($n==2) { ?><ul class="ui-list"><?php } ?>
								<li class="ui-list-item"><a href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],70,'');?></a></li>
							<?php if($n==5) { ?></ul><?php } ?>
						<?php } ?>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</div>

						<ul class="ui-list">
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=0278c1758688f2956962e4c7eb3849b6&action=position&posid=416&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'416','order'=>'listorder DESC','limit'=>'8',));}?>
								<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-list-item"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],70,'');?></a></li>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>
					<div class="ui-tab-cnt-item fn-hide">
						<div class='ui-art fn-clear'>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=0c90799aa12f96c649d4d6bcc87b914c&action=position&posid=417&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'417','order'=>'listorder DESC','limit'=>'5',));}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<?php if($n==1) { ?>
							<div class='ui-art-album'>
								<a target="_blank" href="<?php echo url_change($r[url]);?>"><img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[thumb],120,90);?>' alt='<?php echo $r['title'];?>' width='120' height='90' /></a>
								<h3><a href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],28,'');?></a></h3>
							</div>
						<?php } else { ?>
							<?php if($n==2) { ?><ul class="ui-list"><?php } ?>
								<li class="ui-list-item"><a href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],70,'');?></a></li>
							<?php if($n==5) { ?></ul><?php } ?>
						<?php } ?>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</div>

						<?php $i=0?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=f10956aa5eafad80da1f8427e4302f57&action=morecatids&catids=68%2C79%2C152%2C154&newsnum=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'morecatids')) {$data = $content_tag->morecatids(array('catids'=>'68,79,152,154','newsnum'=>'8','limit'=>'20',));}?>
						<ul class="ui-list">
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<?php $i++?>
							<?php if($i!=1) { ?>
							<li class="ui-list-item"><a target="_blank" href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],70,'');?></a></li>
							<?php } ?>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
				</div>
			</div>

			<div class="ui-content-item-center ui-tab">
				<ul class="ui-tab-nav fn-clear">
					<li class="ui-tab-nav-item ui-tab-nav-item-cur"><a href="http://myshow.huoshow.com/zj.html" target="_blank">专辑</a></li>
					<li class='ui-tab-nav-item'><a href="http://myshow.huoshow.com/dr.html" target="_blank">达人</a></li>
				</ul>
				<div class="ui-tab-cnt">

					<div class="ui-tab-cnt-item">
						<?php $i=0?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=f61784665b200ecc21225c0ad8f67be4&action=get_album_list&order=LIMIT+3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'get_album_list')) {$data = $content_tag->get_album_list(array('order'=>'LIMIT 3','limit'=>'20',));}?>
						<ul class="ui-ilist ui-ilist-plus fn-clear">
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<?php $i++?>
							<li class="ui-ilist-item">
								<a target="_blank" class='ui-ilist-item-img' href='http://myshow.huoshow.com/zj-<?php echo $r['id'];?>.html'>
								<img src='<?php echo $r['img']['0'];?>' alt='' width='104' height='88' /></a>
								<h3 class="ui-ilist-item-title"><a target="_blank" href='http://myshow.huoshow.com/zj-<?php echo $r['id'];?>.html'><?php echo $r['album_name'];?></a></h3>
							</li>
							<?php if($i==9) break;?>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
					<div class="ui-tab-cnt-item fn-hide">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ab654321f6b7614a5e3877d94aab4ec0&action=get_talent_list\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'get_talent_list')) {$data = $content_tag->get_talent_list(array('limit'=>'20',));}?>
						<ul class="ui-user-list fn-clear">
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li class="ui-user-list-item">
								<a target="_blank" class='avatar' href='http://myshow.huoshow.com/m<?php echo $r['uid'];?>.html'>
								<img src='/statics/images/common/transparent.gif' data-src='<?php echo thumb($r[avatar],80,80);?>' alt='' width='80' height='80' /></a>
								<h3 class="name boy"><a target="_blank" href='http://myshow.huoshow.com/m<?php echo $r['uid'];?>.html'><?php echo $r['name'];?></a></h3>
								<div class="status">
									<span>分享：<?php echo $r['share_count'];?></span>
									<span>粉丝：<?php echo $r['fans'];?></span>
									<span>专辑：<?php echo $r['album_count'];?></span>
								</div>
							</li>
							<?php $n++;}unset($n); ?>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
				</div>
			</div>
		</div>

		<div class='ad ad-bottom'>
			<a class='ad ad-left' href='http://myshow.huoshow.com/zj-1846.html' target="_blank"><img src='<?php echo IMG_PATH;?>common/index_ad4.jpg' width='392' height='100' /></a>
			<a class='ad ad-right' href='http://myshow.huoshow.com/fl-5.html' target="_blank"><img src='<?php echo IMG_PATH;?>common/index_ad5.jpg' width='352' height='100' /></a>
		</div>
	</div>
	<!-- ui-content thr end -->

	<!-- ui-content footer -->
	<div class='ui-content ui-content-footer fn-clear'>
		<div class="ui-content-item-side">
			<div class='ad-side'><a href='<?php echo $CATEGORYS['9']['url'];?>' target="_blank"><img src='<?php echo IMG_PATH;?>common/index_ad6.png' width='200' height='80' /></a></div>
			<div class='ad-side ad-side-footer'><a href='http://www.xtep.com/index.html' target="_blank"><img src='<?php echo IMG_PATH;?>common/bottom_ad7_banner.png' width='200' height='210' /></a></div>
		</div>

		<div id='js-tab-gallery' class='ui-tab-gallery'>
			<ul class="ui-tab-nav fn-clear">
					<li class="ui-tab-nav-item ui-tab-nav-item-cur"><a href='javascript:;'>美图</a></li>
					<li class='ui-tab-nav-item'><a href='<?php echo $CATEGORYS['38']['url'];?>'>明星写真</a></li>
					<li class='ui-tab-nav-item'><a href='<?php echo $CATEGORYS['69']['url'];?>'>电影剧照</a></li>
					<li class='ui-tab-nav-item'><a href='<?php echo $CATEGORYS['149']['url'];?>'>电视剧照</a></li>
					<li class='ui-tab-nav-item'><a href='<?php echo $CATEGORYS['173']['url'];?>'>音乐美图</a></li>
					<li class='ui-tab-nav-item'><a href='<?php echo $CATEGORYS['114']['url'];?>'>超模写真</a></li>
					<li class='ui-tab-nav-item'><a href='<?php echo $CATEGORYS['139']['url'];?>'>赛事图集</a></li>
					<li class='ui-tab-nav-item'><a href='<?php echo url_change($CATEGORYS[252][url]);?>'>游戏图集</a></li>
				</ul>
				<div class="ui-tab-cnt">
					<div class="ui-tab-cnt-item">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a61ff33f61b5dfd87bfe050be45b5305&action=position&posid=384&order=listorder+DESC&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'384','order'=>'listorder DESC','limit'=>'6',));}?>
						<ul class="ui-img-list fn-clear">
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
								<?php if($n==1) { ?>
								<li class="ui-img-list-item">
									<a target="_blank" class='wrapper' href='<?php echo url_change($r[url]);?>'>
										<img src='<?php echo thumb($r[thumb],181,240);?>' alt='' width='181' height='240' />
										<span class='title'><?php echo str_cut($r['title'],40,'');?></span>
									</a>
								</li>
								<?php } ?>
							<?php $n++;}unset($n); ?>
							<li class="ui-img-list-item">
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
								<?php if($n==2 || $n==3) { ?>
								<a target="_blank" class='wrapper' href='<?php echo url_change($r[url]);?>'>
									<img src='<?php echo thumb($r[thumb],181,119);?>' alt='' width='181' height='119' />
									<span class='title'><?php echo str_cut($r['title'],40,'');?></span>
								</a>
								<?php } ?>
							<?php $n++;}unset($n); ?>
							</li>
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
								<?php if($n==4) { ?>
								<li class="ui-img-list-item">
									<a target="_blank" class='wrapper' href='<?php echo url_change($r[url]);?>'>
										<img src='<?php echo thumb($r[thumb],181,240);?>' alt='' width='181' height='240' />
										<span class='title'><?php echo str_cut($r['title'],40,'');?></span>
									</a>
								</li>
								<?php } ?>
							<?php $n++;}unset($n); ?>
							<li class="ui-img-list-item">
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
								<?php if($n==5 || $n==6) { ?>
								<a target="_blank" class='wrapper' href='<?php echo url_change($r[url]);?>'>
									<img src='<?php echo thumb($r[thumb],181,119);?>' alt='' width='181' height='119' />
									<span class='title'><?php echo str_cut($r['title'],40,'');?></span>
								</a>
								<?php } ?>
							<?php $n++;}unset($n); ?>
							</li>
						</ul>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
				</div>
		</div>
	</div>
	<!-- ui-content footer end -->

	<!-- 友情链接 -->
	<div id="partners" class='fn-clear'>
		<h4 class="header">友情链接</h4>
		<div class="content">
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"link\" data=\"op=link&tag_md5=8239132dc65dc6804dd060c6b1616bd2&action=type_list&typeid=255&siteid=%24siteid&linktype=0&order=listorder+asc&num=29\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$link_tag = pc_base::load_app_class("link_tag", "link");if (method_exists($link_tag, 'type_list')) {$data = $link_tag->type_list(array('typeid'=>'255','siteid'=>$siteid,'linktype'=>'0','order'=>'listorder asc','limit'=>'29',));}?>
			<p>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<a href="<?php echo $r['url'];?>" target="_blank"><?php echo $r['name'];?></a><?php if($n<count($data)) { ?> |<?php } ?>
				<?php $n++;}unset($n); ?>
			</p>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>
	</div>
	<!-- 友情链接结束 -->

	<script src='<?php echo JS_PATH;?>jquery-1.8.3.min.js?v=20130220'></script>
	<script src='<?php echo JS_PATH;?>jquery.tabs.js?v=20130220'></script>
	<script src='<?php echo JS_PATH;?>jquery.divselect.js?v=20130220'></script>
	<script src='<?php echo JS_PATH;?>jquery.imglazyload.js?v=20130220'></script>
	<script src='<?php echo JS_PATH;?>hs-index.js?v=20130306'></script>

	<?php include template('content', 'hs_footer'); ?>
</body>
</html>