<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?> 火秀网</title>
	<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
	<meta name="description" content="<?php echo $SEO['description'];?>">
	<meta name='author' content='火秀网' />
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
	<link href='<?php echo CSS_PATH;?>hs-game-gallery.css' rel='stylesheet' />
	<link href='http://www.huoshow.com/favicon.ico' rel='icon' />
</head>

<body class='game-gallery'>
	<?php include template('content', 'hs_topbar'); ?>
	<?php include template('content', 'game_header_product'); ?>

	<!-- 主内容 -->
	<div id='gallery-main' class='ui-layout fn-clear'>
		<div id='myfocus-gallery' class='ui-myfocus'><!--焦点图盒子-->
			<div class="loading"></div><!--载入画面(可删除)-->
			<div class="pic"><!--图片列表-->
				<ul>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=3b76a00717932908cc3b18bbbbbd52c0&action=position&posid=487&order=listorder+DESC&num=10&return=data\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'487','order'=>'listorder DESC','limit'=>'10',));}?>
						<?php $n=1; if(is_array($data)) foreach($data AS $key => $val) { ?>
								<?php if($n % 2 == 0) { ?>
								<a target='_blank' class='img' href="<?php echo url_change($val[url]);?>" >
									<img src='<?php echo thumb($val[thumb],325,305);?>' width='325' height='305' />
									<span><?php echo str_cut($val['title'],50,'');?></span>
								</a>
								</li>
								<?php } else { ?>
								<li>
								<a target='_blank' href='<?php echo url_change($val[url]);?>'>
									<img src='<?php echo thumb($val[thumb],325,305);?>' width='325' height='305' />
									<span><?php echo str_cut($val['title'],50,'');?></span>
								</a>
								<?php } ?>
						<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ul>
			</div>
		</div>

		<div class='ui-tab ui-tab-sd'>
			<ul class='ui-tab-nav fn-clear'>
				<li class='ui-tab-nav-item ui-tab-nav-item-cur'>焦点</li>
				<li class='ui-tab-nav-item'>热图</li>
			</ul>
			<div class='ui-tab-cnt'>
				<div class='ui-tab-cnt-item ui-tab-cnt-item-cur'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ebdf788e05d4cfe98f0e5afbac581d0d&action=picmorecatids&catids=246%2C255%2C265%2C266%2C267%2C268%2C269%2C271%2C277%2C278%2C279&newsnum=7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'picmorecatids')) {$data = $content_tag->picmorecatids(array('catids'=>'246,255,265,266,267,268,269,271,277,278,279','newsnum'=>'7','limit'=>'20',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<?php if($n==1) { ?>
					<div class='ui-art fn-clear'>
						<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],102,78);?>' alt='' width='102' height='78' /></a>
						<h3 class='title'><a target='_blank' href="<?php echo url_change($r[url]);?>"> <?php echo str_cut($r['title'],48,'');?></a></h3>
						<p class='content'> <?php echo str_cut($r['description'],168,'');?><a target='_blank' class='more' href="<?php echo url_change($r[url]);?>">[详情]</a></p>
					</div>
				<?php } else { ?>
					<?php if($n==2) { ?><ul class='ui-list'><?php } ?>
						<li class='ui-list-item'><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],78,'');?></a></li>
					<?php if($n==7) { ?></ul><?php } ?>
				<?php } ?>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
				<div class='ui-tab-cnt-item'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e3dd6f4cced71fab8de28357be253a9e&action=picmorecatids&catids=283%2C288%2C289%2C290%2C252%2C319%2C320%2C321%2C322%2C357%2C358%2C359%2C365&newsnum=7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'picmorecatids')) {$data = $content_tag->picmorecatids(array('catids'=>'283,288,289,290,252,319,320,321,322,357,358,359,365','newsnum'=>'7','limit'=>'20',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<?php if($n==1) { ?>
					<div class='ui-art fn-clear'>
						<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],102,78);?>' alt='' width='102' height='78' /></a>
						<h3 class='title'><a target='_blank' href="<?php echo url_change($r[url]);?>"> <?php echo str_cut($r['title'],48,'');?></a></h3>
						<p class='content'> <?php echo str_cut($r['description'],168,'');?><a target='_blank' class='more' href="<?php echo url_change($r[url]);?>">[详情]</a></p>
					</div>
				<?php } else { ?>
					<?php if($n==2) { ?><ul class='ui-list'><?php } ?>
						<li class='ui-list-item'><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],78,'');?></a></li>
					<?php if($n==7) { ?></ul><?php } ?>
				<?php } ?>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
			</div>
		</div>
	</div>

	<!-- 本周推荐 -->
	<div id='gallery-recommend' class='ui-layout fn-clear'>
		<div class='ui-gallery fn-clear'>
			<div class='ui-gallery-header'>
				<h2 class='title'><em>本周推荐</em> <span>Recommend</span></h2>
				<div class='link'><!--<a target='_blank' class='more' href='#'>更多&gt;&gt;</a>--></div>
			</div>

			<div class='ui-gallery-item-main'>
				<ul class='ui-img-list ui-img-list-plus'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=109f834791c2ec4e24452d665398adb5&action=position&posid=488&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'488','order'=>'listorder DESC','limit'=>'8',));}?>
   				 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-img-list-item'>
						<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],142,106);?>' width='142' height='106' /></a>
						<a target='_blank' class='title' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],49,'');?></a>
					</li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ul>
			</div>
		</div>

		<div class='ui-gallery-box'>
			<h2 class='ui-gallery-box-header'>美图排行</h2>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=35c56cb47bca61cb6b6b073cd33193fe&action=pic_hothits&catids=246%2C247%2C260%2C261%2C262%2C263%2C212%2C199%2C190&newsnum=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'pic_hothits')) {$data = $content_tag->pic_hothits(array('catids'=>'246,247,260,261,262,263,212,199,190','newsnum'=>'6','limit'=>'20',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php if($n<4) { ?>
			<?php if($n==1) { ?><ol class='ui-img-list ui-fimg-list fn-clear'><?php } ?>
				<?php if($n==1) { ?>
				<li class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src="<?php echo thumb($r[thumb],128,152);?>" width="128" height="152"/></a>
					<h4 class='header'><span class='num'><?php echo $n;?></span> <a target='_blank' href="<?php echo url_change($r[url]);?>"> <?php echo str_cut($r['title'],24,'');?></a></h4>
				</li>
				<?php } ?>
				<?php if($n>1) { ?>
				<li class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src="<?php echo thumb($r[thumb],108,72);?>" width="108" height="72"/></a>
					<h4 class='header'><span class='num'><?php echo $n;?></span> <a target='_blank' href="<?php echo url_change($r[url]);?>"> <?php echo str_cut($r['title'],24,'');?></a></h4>
				</li>
				<?php } ?>
			<?php if($n==3) { ?></ol><?php } ?>
			<?php } else { ?>
			<?php if($n==4) { ?><ol class='ui-list-plus'><?php } ?>
				<li class='ui-list-plus-item'><span class='num'><?php echo $n;?></span><a target='_blank' class='title' href="<?php echo url_change($r[url]);?>"> <?php echo str_cut($r['title'],55,'');?></a></li>
			<?php if($n==6) { ?></ol><?php } ?>
			<?php } ?>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>
	</div>

	<!-- 游戏美女 -->
	<div id='gallery-beauty' class='ui-gallery fn-clear'>
		<div class='ui-gallery-header'>
			<h2 class='title'><em>游戏美女</em> <span>Beauty</span></h2>
			<div class='link'><a target='_blank' class='more' href="<?php echo url_change($CATEGORYS[365][url]);?>">更多&gt;&gt;</a></div>
		</div>

		<div id='myfocus-hsgallery' class='ui-myfocus'><!--焦点图盒子-->
			<div class="loading"></div><!--载入画面(可删除)-->
			<div class="pic"><!--图片列表-->
				<ul>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=13b3f24d0da5defab7f11979dd399eda&action=position&posid=489&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'489','order'=>'listorder DESC','limit'=>'5',));}?>
   				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li><a target='_blank' href="<?php echo url_change($r[url]);?>"><img src="<?php echo thumb($r[thumb],318,388);?>"  alt="<?php echo $r['title'];?>"  width='318' height='388' /></a></li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ul>
			</div>
		</div>

		<ul class='ui-img-list ui-img-list-plus'>
			<li class='ui-img-list-item-wrapper'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7c71a09644f6916a89c52f2c3ebb3ed0&action=position&posid=490&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'490','order'=>'listorder DESC','limit'=>'3',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<?php if($n==1) { ?>
				<div class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src="<?php echo thumb($r[thumb],223,106);?>" width='223' height="106" /></a>
					<h3 class='header'><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],49,'');?></a></h3>
				</div>
				<?php } elseif ($n==2) { ?>
				<div class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src="<?php echo thumb($r[thumb],223,118);?>" width='223' height="118" /></a>
					<h3 class='header'><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],49,'');?></a></h3>
				</div>
				<?php } else { ?>
				<div class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src="<?php echo thumb($r[thumb],223,182);?>" width='223' height="182" /></a>
					<h3 class='header'><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],49,'');?></a></h3>
				</div>
				<?php } ?>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</li>
			<li class='ui-img-list-item-wrapper'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=df82ae23f903d3a331c2319d07c2eb11&action=position&posid=490&order=listorder+DESC+limit+3%2C2--&num=2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'490','order'=>'listorder DESC limit 3,2--','limit'=>'2',));}?>
   			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
   				<?php if($n==1) { ?>
				<div class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src="<?php echo thumb($r[thumb],214,266);?>" width='214' height="266" /></a>
					<h3 class='header'><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],49,'');?></a></h3>
				</div>
				<?php } else { ?>
				<div class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src="<?php echo thumb($r[thumb],214,146);?>" width='214' height="146" /></a>
					<h3 class='header'><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],49,'');?></a></h3>
				</div>
				<?php } ?>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</li>
			<li class='ui-img-list-item-wrapper'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4209056685bf4bfa09cb6bad8c0735cc&action=position&posid=490&order=listorder+DESC+limit+5%2C2--&num=2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'490','order'=>'listorder DESC limit 5,2--','limit'=>'2',));}?>
   			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<div class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src="<?php echo thumb($r[thumb],181,206);?>" width='181' height="206" /></a>
					<h3 class='header'><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],49,'');?></a></h3>
				</div>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</li>
		</ul>
	</div>

	<!-- Cosplay -->
	<div id='gallery-beauty' class='ui-gallery fn-clear'>
		<div class='ui-gallery-header'>
			<h2 class='title'><em>Cosplay</em></h2>
			<div class='link'><a target='_blank' class='more' href="<?php echo url_change($CATEGORYS[320][url]);?>">更多&gt;&gt;</a></div>
		</div>

		<div id='myfocus-hsgallery-two' class='ui-myfocus'><!--焦点图盒子-->
			<div class="loading"></div><!--载入画面(可删除)-->
			<div class="pic"><!--图片列表-->
				<ul>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=660b5c36e72e7760eac83c18cef2abe1&action=position&posid=491&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'491','order'=>'listorder DESC','limit'=>'5',));}?>
   				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li><a target='_blank' href="<?php echo url_change($r[url]);?>"><img src="<?php echo thumb($r[thumb],318,388);?>"  alt="<?php echo $r['title'];?>" width='318' height='388' /></a></li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ul>
			</div>
		</div>

		<ul class='ui-img-list ui-img-list-plus'>
			<li class='ui-img-list-item-wrapper'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=dbd144c0c14c6a8f724a6885cc994f62&action=position&posid=492&order=listorder+DESC+limit+0%2C3--\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'492','order'=>'listorder DESC limit 0,3--','limit'=>'20',));}?>
   			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<?php if($n==1) { ?>
				<div class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src="<?php echo thumb($r[thumb],223,106);?>" width='223' height="106" /></a>
					<h3 class='header'><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],49,'');?></a></h3>
				</div>
				<?php } elseif ($n==2) { ?>
				<div class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src="<?php echo thumb($r[thumb],223,118);?>" width='223' height="118" /></a>
					<h3 class='header'><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],49,'');?></a></h3>
				</div>
				<?php } else { ?>
				<div class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src="<?php echo thumb($r[thumb],223,182);?>" width='223' height="182" /></a>
					<h3 class='header'><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],49,'');?></a></h3>
				</div>
				<?php } ?>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</li>
			<li class='ui-img-list-item-wrapper'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=da526d9c0b9033f65af8ad57c429954c&action=position&posid=492&order=listorder+DESC+limit+3%2C2--\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'492','order'=>'listorder DESC limit 3,2--','limit'=>'20',));}?>
   			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<?php if($n==1) { ?>
				<div class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src="<?php echo thumb($r[thumb],214,266);?>" width='214' height="266" /></a>
					<h3 class='header'><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],49,'');?></a></h3>
				</div>
				<?php } else { ?>
				<div class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src="<?php echo thumb($r[thumb],214,146);?>" width='214' height="146" /></a>
					<h3 class='header'><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],49,'');?></a></h3>
				</div>
				<?php } ?>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</li>
			<li class='ui-img-list-item-wrapper'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7a520dd55150eb0e9397a08c1c58533f&action=position&posid=492&order=listorder+DESC+limit+5%2C2--\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'492','order'=>'listorder DESC limit 5,2--','limit'=>'20',));}?>
   			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<div class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src="<?php echo thumb($r[thumb],181,206);?>" width='181' height="206" /></a>
					<h3 class='header'><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],49,'');?></a></h3>
				</div>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</li>
		</ul>
	</div>

	<!-- 网络红人 -->
	<div id='gallery-network' class='ui-gallery'>
		<div class='ui-gallery-header'>
			<h2 class='title'><em>网络红人</em> <span>Network</span></h2>
			<div class='link'><a target='_blank' class='more' href="<?php echo url_change($CATEGORYS[319][url]);?>">更多&gt;&gt;</a></div>
		</div>

		<ul class='ui-img-list ui-img-list-plus'>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e285e7bc0937cc8c306aaa0e4d3d01b7&action=position&posid=493&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'493','order'=>'listorder DESC','limit'=>'4',));}?>
   		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<li class='ui-img-list-item'>
				<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],223,298);?>' width='223' height='298' /></a>
				<h3 class='header'><a target='_blank' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],20,'');?></a></h3>
			</li>
		<?php $n++;}unset($n); ?>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</ul>
	</div>

	<!-- 动漫 -->
	<div id='gallery-animation' class='ui-layout fn-clear'>
		<div class='ui-gallery ui-gallery-animation'>
			<div class='ui-gallery-header'>
				<h2 class='title'><em>动漫</em> <span>Animation</span></h2>
			</div>
			<ul class='ui-img-list ui-img-list-plus'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4ca5483e13761774cc76cdb1f5c01f1c&action=lists&catid=321&order=id+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'321','order'=>'id DESC','limit'=>'4',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],142,106);?>' width='142' height='106' /></a>
					<a target='_blank' class='title' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],49,'');?></a>
				</li>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
		</div>

		<div class='ui-gallery'>
			<div class='ui-gallery-header'>
				<h2 class='title'><em>原画欣赏</em> <span>Original painting</span></h2>
			</div>
			<ul class='ui-img-list ui-img-list-plus'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=f9400ed858c0301cc842468b668c91ba&action=lists&catid=357&order=id+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'357','order'=>'id DESC','limit'=>'4',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],142,106);?>' width='142' height='106' /></a>
					<a target='_blank' class='title' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],49,'');?></a>
				</li>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
		</div>

		<div class='ui-gallery ui-gallery-atlas'>
			<div class='ui-gallery-header'>
				<h2 class='title'><em>囧图集</em> <span>Atlas</span></h2>
			</div>
			<ul class='ui-img-list ui-img-list-plus'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=41befc259fa1dee057427d0595c3e2cc&action=lists&catid=358&order=id+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'358','order'=>'id DESC','limit'=>'4',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],142,106);?>' width='142' height='106' /></a>
					<a target='_blank' class='title' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],49,'');?></a>
				</li>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
		</div>
	</div>

	<!-- 游戏壁纸 -->
	<div id='gallery-wallpaper' class='ui-layout fn-clear'>
		<div class='ui-gallery ui-gallery-wallpaper'>
			<div class='ui-gallery-header'>
				<h2 class='title'><em>游戏壁纸</em> <span>Animation</span></h2>
			</div>
			<div id='myfocus-mygallery' class='ui-myfocus'><!--焦点图盒子-->
				<div class="loading"></div><!--载入画面(可删除)-->
				<div class="pic"><!--图片列表-->
					<ul>
						<li>
							<div class='ui-img-list ui-img-list-plus'>
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=fd7f65fc035178908b2ce6365cfd184f&action=lists&catid=359&order=id+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'359','order'=>'id DESC','limit'=>'4',));}?>
   						    <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
								<span class='ui-img-list-item'>
									<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],142,106);?>' width='142' height='106' /></a>
									<a target='_blank' class='title' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],49,'');?></a>
								</span>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
							</div>
						</li>
						<li>
							<div class='ui-img-list ui-img-list-plus'>
								<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=aa59d2db0e65ed767351a489091efd8f&action=lists&catid=359&order=id+DESC+limit+4%2C4--&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'359','order'=>'id DESC limit 4,4--','limit'=>'4',));}?>
   						    	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
								<span class='ui-img-list-item'>
									<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],142,106);?>' width='142' height='106' /></a>
									<a target='_blank' class='title' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],49,'');?></a>
								</span>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
							</div>
						</li>
						<li>
							<div class='ui-img-list ui-img-list-plus'>
								<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4bc1b70b872ea252e2b1decc53e94004&action=lists&catid=359&order=id+DESC+limit+8%2C4--&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'359','order'=>'id DESC limit 8,4--','limit'=>'4',));}?>
   						    	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
								<span class='ui-img-list-item'>
									<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],142,106);?>' width='142' height='106' /></a>
									<a target='_blank' class='title' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],49,'');?></a>
								</span>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class='ui-gallery ui-gallery-creative'>
			<div class='ui-gallery-header'>
				<h2 class='title'><em>创意趣图</em> <span>Creative</span></h2>
			</div>
			<ul class='ui-img-list ui-img-list-plus' style="text-align:left;">
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=dcba4a2daec7c8e3c47c730c6413901e&action=lists&catid=322&order=id+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'322','order'=>'id DESC','limit'=>'8',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-img-list-item'>
					<a target='_blank' class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],142,106);?>' width='142' height='106' /></a>
					<a target='_blank' class='title' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],49,'');?></a>
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